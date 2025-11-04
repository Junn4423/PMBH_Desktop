
import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Table,
  Space,
  Typography,
  Button,
  Select,
  DatePicker,
  message
} from 'antd';
import { FileBarChart, RefreshCw } from 'lucide-react';
import dayjs from 'dayjs';
import isBetween from 'dayjs/plugin/isBetween';
import {
  listPhieuNhap,
  getDanhSachKho
} from '../../services/apiServices';
import './BcChiTienNhapKho.css';

const { Text } = Typography;
const { RangePicker } = DatePicker;

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

const formatCurrency = (value) =>
  Number(value || 0).toLocaleString('vi-VN', {
    style: 'currency',
    currency: 'VND',
    maximumFractionDigits: 0
  });

const normalizeReceipt = (item) => ({
  maPhieu: item?.maPhieuNhap ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  tongTien: Number(item?.tongTien ?? item?.lv008 ?? 0),
  ngayNhap: item?.ngayNhap ?? item?.lv009 ?? ''
});

const BcChiTienNhapKho = () => {
  const [loading, setLoading] = useState(false);
  const [receipts, setReceipts] = useState([]);
  const [warehouses, setWarehouses] = useState([]);
  const [filters, setFilters] = useState({
    maKho: undefined,
    dateRange: [dayjs().startOf('month'), dayjs().endOf('month')]
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
      message.error('Khong the tai du lieu chi tien.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
    fetchReceipts();
  }, [fetchWarehouses, fetchReceipts]);

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
    [warehouses]
  );

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
  }, [receipts, filters]);

  const aggregatedDaily = useMemo(() => {
    const groups = new Map();

    filteredReceipts.forEach((item) => {
      const date = parseDateValue(item.ngayNhap);
      const key = date ? date.format('YYYY-MM-DD') : 'Chua xac dinh';
      if (!groups.has(key)) {
        groups.set(key, {
          key,
          ngay: key,
          totalAmount: 0,
          receiptCount: 0,
          warehouses: new Set()
        });
      }
      const group = groups.get(key);
      group.totalAmount += item.tongTien || 0;
      group.receiptCount += 1;
      if (item.maKho) {
        group.warehouses.add(item.maKho);
      }
    });

    return Array.from(groups.values())
      .map((group) => ({
        ...group,
        warehouseCount: group.warehouses.size,
        averageAmount: group.receiptCount ? group.totalAmount / group.receiptCount : 0
      }))
      .sort((a, b) => (a.ngay < b.ngay ? 1 : -1));
  }, [filteredReceipts]);

  const totals = useMemo(() => {
    return aggregatedDaily.reduce(
      (acc, item) => {
        acc.totalAmount += item.totalAmount;
        acc.totalReceipts += item.receiptCount;
        acc.totalDays += 1;
        return acc;
      },
      { totalAmount: 0, totalReceipts: 0, totalDays: 0 }
    );
  }, [aggregatedDaily]);

  const columns = [
    {
      title: 'Ngay',
      dataIndex: 'ngay',
      key: 'ngay',
      render: (value) => (value === 'Chua xac dinh' ? value : dayjs(value).format('DD/MM/YYYY'))
    },
    {
      title: 'So phieu',
      dataIndex: 'receiptCount',
      key: 'receiptCount',
      align: 'center'
    },
    {
      title: 'Kho tham gia',
      dataIndex: 'warehouseCount',
      key: 'warehouseCount',
      align: 'center'
    },
    {
      title: 'Tong chi',
      dataIndex: 'totalAmount',
      key: 'totalAmount',
      align: 'right',
      render: (value) => formatCurrency(value)
    },
    {
      title: 'Chi trung binh',
      dataIndex: 'averageAmount',
      key: 'averageAmount',
      align: 'right',
      render: (value) => formatCurrency(value)
    }
  ];

  return (
    <div className="bc-chi-tien-nhap-kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chu</Breadcrumb.Item>
        <Breadcrumb.Item>Muc chung</Breadcrumb.Item>
        <Breadcrumb.Item>Giao dien MB</Breadcrumb.Item>
        <Breadcrumb.Item>Chi tien & nhap kho</Breadcrumb.Item>
      </Breadcrumb>

      <Card
        className="main-card"
        title={
          <Space size={8}>
            <FileBarChart size={18} />
            <Text strong>Thong ke chi tien nhap kho</Text>
          </Space>
        }
        extra={
          <Button
            size="small"
            icon={<RefreshCw size={16} />}
            onClick={fetchReceipts}
          >
            Tai lai
          </Button>
        }
      >
        <Space direction="vertical" size={16} style={{ width: '100%' }}>
          <Space wrap size={12}>
            <Select
              allowClear
              placeholder="Chon kho"
              style={{ minWidth: 220 }}
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
            <Button onClick={() => setFilters({ maKho: undefined, dateRange: null })}>
              Dat lai loc
            </Button>
          </Space>

          <Table
            loading={loading}
            dataSource={aggregatedDaily}
            columns={columns}
            pagination={{ pageSize: 10, showSizeChanger: false }}
            locale={{ emptyText: loading ? 'Dang tai du lieu...' : 'Khong co du lieu phu hop' }}
            summary={() => (
              <Table.Summary.Row>
                <Table.Summary.Cell index={0} colSpan={2}>
                  <Text strong>Tong cong</Text>
                </Table.Summary.Cell>
                <Table.Summary.Cell index={2} align="center">
                  <Text strong>{totals.totalReceipts}</Text>
                </Table.Summary.Cell>
                <Table.Summary.Cell index={3} align="right">
                  <Text strong>{formatCurrency(totals.totalAmount)}</Text>
                </Table.Summary.Cell>
                <Table.Summary.Cell index={4} align="right">
                  <Text strong>
                    {formatCurrency(
                      totals.totalReceipts
                        ? totals.totalAmount / totals.totalReceipts
                        : 0
                    )}
                  </Text>
                </Table.Summary.Cell>
              </Table.Summary.Row>
            )}
            rowKey={(record) => record.key}
          />
        </Space>
      </Card>
    </div>
  );
};

export default BcChiTienNhapKho;
