import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  List,
  Tag,
  Space,
  Typography,
  Button,
  Select,
  DatePicker,
  Empty,
  message
} from 'antd';
import {
  Warehouse,
  RefreshCw,
  Calendar,
  DollarSign
} from 'lucide-react';
import dayjs from 'dayjs';
import isBetween from 'dayjs/plugin/isBetween';
import {
  listPhieuNhap,
  getDanhSachKho
} from '../../services/apiServices';
import './NhapKhoMb.css';

const { Text } = Typography;
const { RangePicker } = DatePicker;

const statusMap = {
  '0': { text: 'Nhap', color: 'default' },
  '1': { text: 'Da duyet', color: 'green' },
  '2': { text: 'Hoan tat', color: 'blue' }
};

dayjs.extend(isBetween);

const parseDateValue = (value) => {
  if (!value) {
    return null;
  }
  if (dayjs.isDayjs(value)) {
    return value;
  }
  if (value instanceof Date) {
    return dayjs(value);
  }
  const str = String(value);
  if (/^\d{14}$/.test(str)) {
    return dayjs(str, 'YYYYMMDDHHmmss');
  }
  if (/^\d{8}$/.test(str)) {
    return dayjs(str, 'YYYYMMDD');
  }
  const parsed = dayjs(str);
  return parsed.isValid() ? parsed : null;
};

const formatDateTime = (value) => {
  const parsed = parseDateValue(value);
  return parsed ? parsed.format('DD/MM/YYYY HH:mm') : '--';
};

const formatCurrency = (value) =>
  Number(value || 0).toLocaleString('vi-VN', {
    style: 'currency',
    currency: 'VND',
    maximumFractionDigits: 0
  });

const normalizeReceipt = (item) => ({
  id: item?.maPhieuNhap ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  ghiChu: item?.ghiChu ?? item?.lv004 ?? '',
  loaiPhieu: item?.loaiPhieu ?? item?.lv005 ?? '',
  maThamChieu: item?.maThamChieu ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? '',
  tongTien: Number(item?.tongTien ?? item?.lv008 ?? 0),
  ngayNhap: item?.ngayNhap ?? item?.lv009 ?? ''
});

const NhapKhoMb = () => {
  const [loading, setLoading] = useState(false);
  const [receipts, setReceipts] = useState([]);
  const [warehouses, setWarehouses] = useState([]);
  const [filters, setFilters] = useState({
    maKho: undefined,
    dateRange: null
  });

  const fetchWarehouses = useCallback(async () => {
    try {
      const data = await getDanhSachKho();
      setWarehouses(Array.isArray(data) ? data : []);
    } catch (error) {
      console.error(error);
      message.error('Khong the tai danh sach kho.');
    }
  }, []);

  const fetchReceipts = useCallback(async () => {
    setLoading(true);
    try {
      const data = await listPhieuNhap();
      const list = Array.isArray(data) ? data.map(normalizeReceipt) : [];
      setReceipts(list);
    } catch (error) {
      console.error(error);
      message.error('Khong the tai danh sach phieu nhap.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
    fetchReceipts();
  }, [fetchWarehouses, fetchReceipts]);

  const filteredReceipts = useMemo(() => {
    let data = [...receipts];

    if (filters.maKho) {
      data = data.filter((item) => item.maKho === filters.maKho);
    }

    if (filters.dateRange && filters.dateRange.length === 2) {
      const [start, end] = filters.dateRange;
      data = data.filter((item) => {
        const date = parseDateValue(item.ngayNhap);
        if (!date) {
          return false;
        }
        const endInclusive = end ? end.endOf('day') : end;
        return date.isBetween(start.startOf('day'), endInclusive, null, '[]');
      });
    }

    return data;
  }, [filters, receipts]);

  const stats = useMemo(() => {
    const totalAmount = filteredReceipts.reduce(
      (sum, item) => sum + (item.tongTien || 0),
      0
    );
    const totalCount = filteredReceipts.length;
    const uniqueWarehouses = new Set(filteredReceipts.map((item) => item.maKho)).size;

    return {
      totalAmount,
      totalCount,
      uniqueWarehouses
    };
  }, [filteredReceipts]);

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
    [warehouses]
  );

  return (
    <div className="nhap-kho-mb-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chu</Breadcrumb.Item>
        <Breadcrumb.Item>Muc chung</Breadcrumb.Item>
        <Breadcrumb.Item>Giao dien MB</Breadcrumb.Item>
        <Breadcrumb.Item>Nhap kho</Breadcrumb.Item>
      </Breadcrumb>

      <Card className="summary-card">
        <Space direction="vertical" size={8}>
          <Space size={8}>
            <Warehouse size={20} />
            <Text strong>Tong quan phieu nhap</Text>
          </Space>
          <Space size="large" wrap>
            <div>
              <Text type="secondary">Tong so phieu</Text>
              <div className="summary-value">{stats.totalCount}</div>
            </div>
            <div>
              <Text type="secondary">Tong gia tri</Text>
              <div className="summary-value">{formatCurrency(stats.totalAmount)}</div>
            </div>
            <div>
              <Text type="secondary">So kho lien quan</Text>
              <div className="summary-value">{stats.uniqueWarehouses}</div>
            </div>
          </Space>
        </Space>
      </Card>

      <Card className="main-card">
        <Space direction="vertical" size={16} style={{ width: '100%' }}>
          <Space wrap size={12}>
            <Select
              allowClear
              placeholder="Chon kho"
              style={{ minWidth: 200 }}
              options={warehouseOptions}
              value={filters.maKho}
              onChange={(value) => setFilters((prev) => ({ ...prev, maKho: value }))}
            />
            <RangePicker
              value={filters.dateRange}
              onChange={(range) => setFilters((prev) => ({ ...prev, dateRange: range }))}
              format="DD/MM/YYYY"
              allowClear
            />
            <Button
              icon={<RefreshCw size={16} />}
              onClick={() => setFilters({ maKho: undefined, dateRange: null })}
            >
              Dat lai loc
            </Button>
          </Space>

          <List
            loading={loading}
            dataSource={filteredReceipts}
            locale={{
              emptyText: loading ? null : <Empty description="Khong co phieu nhap phu hop" />
            }}
            renderItem={(item) => {
              const status = statusMap[item.trangThai] || statusMap['0'];
              return (
                <List.Item className="receipt-list-item">
                  <Card size="small" className="receipt-card">
                    <Space direction="vertical" size={8} style={{ width: '100%' }}>
                      <Space align="start" style={{ width: '100%', justifyContent: 'space-between' }}>
                        <Space size={6}>
                          <Text strong>{item.id || '---'}</Text>
                          {item.loaiPhieu ? <Tag>{item.loaiPhieu}</Tag> : null}
                        </Space>
                        <Tag color={status.color}>{status.text}</Tag>
                      </Space>
                      <Space size={6}>
                        <Warehouse size={14} />
                        <span>{item.maKho || 'Kho khong xac dinh'}</span>
                      </Space>
                      <Space size={6}>
                        <Calendar size={14} />
                        <span>{formatDateTime(item.ngayNhap)}</span>
                      </Space>
                      <Space size={6}>
                        <DollarSign size={14} />
                        <Text strong>{formatCurrency(item.tongTien)}</Text>
                      </Space>
                      {item.maNguoiDung ? (
                        <Text type="secondary">Nguoi lap: {item.maNguoiDung}</Text>
                      ) : null}
                      {item.maThamChieu ? (
                        <Text type="secondary">Tham chieu: {item.maThamChieu}</Text>
                      ) : null}
                      {item.ghiChu ? (
                        <Text type="secondary">Ghi chu: {item.ghiChu}</Text>
                      ) : null}
                    </Space>
                  </Card>
                </List.Item>
              );
            }}
          />
        </Space>
      </Card>
    </div>
  );
};

export default NhapKhoMb;
