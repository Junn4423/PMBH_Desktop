
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
  Tag,
  message
} from 'antd';
import { FileSpreadsheet, RefreshCw } from 'lucide-react';
import dayjs from 'dayjs';
import isBetween from 'dayjs/plugin/isBetween';
import {
  listPhieuNhap,
  getDanhSachKho
} from '../../services/apiServices';
import './BcNhapKho.css';

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
  maPhieu: item?.maPhieuNhap ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  tongTien: Number(item?.tongTien ?? item?.lv008 ?? 0),
  ngayNhap: item?.ngayNhap ?? item?.lv009 ?? ''
});

const BcNhapKho = () => {
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
      message.error('Khong the tai du lieu bao cao.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
    fetchReceipts();
  }, [fetchWarehouses, fetchReceipts]);

  const warehouseMap = useMemo(() => {
    const map = new Map();
    warehouses.forEach((item) => {
      const key = item?.maKho || item?.lv001;
      if (key) {
        map.set(key, item);
      }
    });
    return map;
  }, [warehouses]);

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

  const aggregatedData = useMemo(() => {
    const groups = new Map();

    filteredReceipts.forEach((item) => {
      const key = item.maKho || 'UNKNOWN';
      if (!groups.has(key)) {
        groups.set(key, {
          key,
          maKho: key,
          totalAmount: 0,
          receiptCount: 0,
          latest: null,
          earliest: null
        });
      }
      const group = groups.get(key);
      group.totalAmount += item.tongTien || 0;
      group.receiptCount += 1;
      const date = parseDateValue(item.ngayNhap);
      if (date) {
        group.latest = !group.latest || date.isAfter(group.latest) ? date : group.latest;
        group.earliest = !group.earliest || date.isBefore(group.earliest) ? date : group.earliest;
      }
    });

    return Array.from(groups.values()).map((group) => {
      const warehouseInfo = warehouseMap.get(group.maKho);
      return {
        ...group,
        tenKho: warehouseInfo?.tenKho || warehouseInfo?.lv003 || group.maKho,
        avgAmount: group.receiptCount ? group.totalAmount / group.receiptCount : 0
      };
    });
  }, [filteredReceipts, warehouseMap]);

  const totalSummary = useMemo(() => {
    return aggregatedData.reduce(
      (acc, item) => {
        acc.totalAmount += item.totalAmount;
        acc.totalCount += item.receiptCount;
        return acc;
      },
      { totalAmount: 0, totalCount: 0 }
    );
  }, [aggregatedData]);

  const columns = [
    {
      title: 'Kho',
      dataIndex: 'tenKho',
      key: 'tenKho',
      render: (value, record) => (
        <Space size={6}>
          <Text strong>{value}</Text>
          <Tag>{record.maKho}</Tag>
        </Space>
      )
    },
    {
      title: 'So phieu',
      dataIndex: 'receiptCount',
      key: 'receiptCount',
      align: 'center'
    },
    {
      title: 'Tong gia tri',
      dataIndex: 'totalAmount',
      key: 'totalAmount',
      align: 'right',
      render: (value) => formatCurrency(value)
    },
    {
      title: 'Gia tri trung binh',
      dataIndex: 'avgAmount',
      key: 'avgAmount',
      align: 'right',
      render: (value) => formatCurrency(value)
    },
    {
      title: 'Lan nhap dau tien',
      dataIndex: 'earliest',
      key: 'earliest',
      render: (value) => formatDateTime(value)
    },
    {
      title: 'Lan nhap gan nhat',
      dataIndex: 'latest',
      key: 'latest',
      render: (value) => formatDateTime(value)
    }
  ];

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
    [warehouses]
  );

  return (
    <div className="bc-nhap-kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chu</Breadcrumb.Item>
        <Breadcrumb.Item>Muc chung</Breadcrumb.Item>
        <Breadcrumb.Item>Giao dien MB</Breadcrumb.Item>
        <Breadcrumb.Item>Bao cao nhap kho</Breadcrumb.Item>
      </Breadcrumb>

      <Card
        className="main-card"
        title={
          <Space size={8}>
            <FileSpreadsheet size={18} />
            <Text strong>Bao cao tong hop nhap kho</Text>
          </Space>
        }
        extra={
          <Space>
            <Button
              size="small"
              icon={<RefreshCw size={16} />}
              onClick={fetchReceipts}
            >
              Tai lai
            </Button>
          </Space>
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
            <Button
              onClick={() => setFilters({ maKho: undefined, dateRange: null })}
            >
              Dat lai loc
            </Button>
          </Space>

          <Table
            loading={loading}
            dataSource={aggregatedData}
            columns={columns}
            pagination={{ pageSize: 8, showSizeChanger: false }}
            locale={{ emptyText: loading ? 'Dang tai du lieu...' : 'Khong co du lieu phu hop' }}
            summary={() => (
              <Table.Summary.Row>
                <Table.Summary.Cell index={0} colSpan={2}>
                  <Text strong>Tong cong</Text>
                </Table.Summary.Cell>
                <Table.Summary.Cell index={2} align="right">
                  <Text strong>{formatCurrency(totalSummary.totalAmount)}</Text>
                </Table.Summary.Cell>
                <Table.Summary.Cell index={3} align="right">
                  <Text strong>
                    {formatCurrency(
                      totalSummary.totalCount
                        ? totalSummary.totalAmount / totalSummary.totalCount
                        : 0
                    )}
                  </Text>
                </Table.Summary.Cell>
                <Table.Summary.Cell index={4} colSpan={2}>
                  <Text type="secondary">
                    Tong so phieu: {totalSummary.totalCount}
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

export default BcNhapKho;
