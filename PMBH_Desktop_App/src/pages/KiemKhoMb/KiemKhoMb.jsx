
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
  Empty,
  message
} from 'antd';
import { Search, RefreshCw, ClipboardList, CheckCircle2 } from 'lucide-react';
import dayjs from 'dayjs';
import {
  listPhieuKiemKho,
  getDanhSachKho
} from '../../services/apiServices';
import './KiemKhoMb.css';

const { Text } = Typography;

const statusMap = {
  '0': { text: 'Nhap', color: 'default' },
  '1': { text: 'Da duyet', color: 'green' },
  '2': { text: 'Hoan tat', color: 'blue' }
};

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

const normalizeRecord = (item) => ({
  id: item?.maKiemKho ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  chuDe: item?.chuDe ?? item?.lv004 ?? '',
  ngayKiem: item?.ngayKiem ?? item?.lv005 ?? '',
  ghiNhan: item?.ghiNhan ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? ''
});

const KiemKhoMb = () => {
  const [loading, setLoading] = useState(false);
  const [records, setRecords] = useState([]);
  const [warehouses, setWarehouses] = useState([]);
  const [filters, setFilters] = useState({
    maKho: undefined,
    trangThai: undefined
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

  const fetchRecords = useCallback(async () => {
    setLoading(true);
    try {
      const data = await listPhieuKiemKho();
      const list = Array.isArray(data) ? data.map(normalizeRecord) : [];
      setRecords(list);
    } catch (error) {
      console.error(error);
      message.error('Khong the tai danh sach phieu kiem.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
    fetchRecords();
  }, [fetchWarehouses, fetchRecords]);

  const filteredRecords = useMemo(() => {
    return records.filter((item) => {
      if (filters.maKho && item.maKho !== filters.maKho) {
        return false;
      }
      if (filters.trangThai && item.trangThai !== filters.trangThai) {
        return false;
      }
      return true;
    });
  }, [records, filters]);

  const stats = useMemo(() => {
    const total = filteredRecords.length;
    const approved = filteredRecords.filter((item) => item.trangThai === '1').length;
    const completed = filteredRecords.filter((item) => item.trangThai === '2').length;
    return {
      total,
      approved,
      completed
    };
  }, [filteredRecords]);

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
    [warehouses]
  );

  return (
    <div className="kiem-kho-mb-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chu</Breadcrumb.Item>
        <Breadcrumb.Item>Muc chung</Breadcrumb.Item>
        <Breadcrumb.Item>Giao dien MB</Breadcrumb.Item>
        <Breadcrumb.Item>Kiem kho</Breadcrumb.Item>
      </Breadcrumb>

      <Card className="summary-card">
        <Space direction="vertical" size={8}>
          <Space size={8}>
            <Search size={20} />
            <Text strong>Tong quan phieu kiem kho</Text>
          </Space>
          <Space size="large" wrap>
            <div>
              <Text type="secondary">Tong so phieu</Text>
              <div className="summary-value">{stats.total}</div>
            </div>
            <div>
              <Text type="secondary">Da duyet</Text>
              <div className="summary-value">{stats.approved}</div>
            </div>
            <div>
              <Text type="secondary">Hoan tat</Text>
              <div className="summary-value">{stats.completed}</div>
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
            <Select
              allowClear
              placeholder="Trang thai"
              style={{ minWidth: 160 }}
              options={Object.entries(statusMap).map(([value, info]) => ({
                value,
                label: info.text
              }))}
              value={filters.trangThai}
              onChange={(value) => setFilters((prev) => ({ ...prev, trangThai: value }))}
            />
            <Button
              icon={<RefreshCw size={16} />}
              onClick={() => setFilters({ maKho: undefined, trangThai: undefined })}
            >
              Dat lai loc
            </Button>
          </Space>

          <List
            loading={loading}
            dataSource={filteredRecords}
            locale={{
              emptyText: loading ? null : <Empty description="Khong co phieu kiem" />
            }}
            renderItem={(item) => {
              const status = statusMap[item.trangThai] || statusMap['0'];
              return (
                <List.Item className="record-list-item">
                  <Card size="small" className="record-card">
                    <Space direction="vertical" size={8} style={{ width: '100%' }}>
                      <Space align="start" style={{ width: '100%', justifyContent: 'space-between' }}>
                        <Space size={6}>
                          <Text strong>{item.id || '---'}</Text>
                        </Space>
                        <Tag color={status.color}>{status.text}</Tag>
                      </Space>
                      <Space size={6}>
                        <Search size={14} />
                        <span>{item.maKho || 'Kho khong xac dinh'}</span>
                      </Space>
                      <Space size={6}>
                        <ClipboardList size={14} />
                        <span>{item.chuDe || 'Khong co chu de'}</span>
                      </Space>
                      <Space size={6}>
                        <CheckCircle2 size={14} />
                        <span>{formatDateTime(item.ngayKiem)}</span>
                      </Space>
                      {item.maNguoiDung ? (
                        <Text type="secondary">Nguoi kiem: {item.maNguoiDung}</Text>
                      ) : null}
                      {item.ghiNhan ? (
                        <Text type="secondary">Ghi nhan: {item.ghiNhan}</Text>
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

export default KiemKhoMb;
