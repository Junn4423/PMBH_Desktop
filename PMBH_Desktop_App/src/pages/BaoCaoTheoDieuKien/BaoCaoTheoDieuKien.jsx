import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Row,
  Col,
  Typography,
  Select,
  DatePicker,
  Button,
  Input,
  Checkbox,
  Table,
  Tag,
  message,
  Space,
  Spin
} from 'antd';
import { FileBarChart2, TrendingUp, ArrowDownCircle, ArrowUpCircle } from 'lucide-react';
import dayjs from 'dayjs';
import { getDanhSachKho, baoCaoXuatNhapTon } from '../../services/apiServices';
import './BaoCaoTheoDieuKien.css';

const { RangePicker } = DatePicker;
const { Title, Text } = Typography;

const createDefaultRange = () => [dayjs().subtract(7, 'day').startOf('day'), dayjs().endOf('day')];
const createEmptySummary = () => ({
  tonDau: 0,
  tonNhap: 0,
  tonXuat: 0,
  tonCuoi: 0,
  giaTriTonDau: 0,
  giaTriNhap: 0,
  giaTriXuat: 0,
  giaTriTonCuoi: 0
});

const formatNumber = (value, fraction = 2) =>
  Number(value || 0).toLocaleString('vi-VN', { maximumFractionDigits: fraction });

const formatCurrency = (value) =>
  Number(value || 0).toLocaleString('vi-VN', {
    style: 'currency',
    currency: 'VND',
    maximumFractionDigits: 0
  });

const BaoCaoTheoDieuKien = () => {
  const [loading, setLoading] = useState(false);
  const [warehouses, setWarehouses] = useState([]);
  const [filters, setFilters] = useState({
    maKho: undefined,
    dateRange: createDefaultRange(),
    keyword: '',
    includeZero: false
  });
  const [report, setReport] = useState({
    summary: createEmptySummary(),
    items: [],
    warehouses: [],
    filters: null,
    generatedAt: null
  });

  const warehouseOptions = useMemo(
    () =>
      warehouses
        .map((item) => ({
          value: item?.maKho || item?.lv001,
          label: item?.tenKho || item?.lv003 || item?.lv002 || item?.maKho || item?.lv001
        }))
        .filter((opt) => opt.value),
    [warehouses]
  );

  const fetchWarehouses = useCallback(async () => {
    try {
      const data = await getDanhSachKho();
      setWarehouses(Array.isArray(data) ? data : []);
    } catch (error) {
      console.error(error);
      message.error('Khong the tai danh sach kho.');
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
  }, [fetchWarehouses]);

  const handleReport = useCallback(async () => {
    const [start, end] = filters.dateRange || [];

    if (!start || !end) {
      message.warning('Vui long chon khoang thoi gian.');
      return;
    }

    const payload = {
      maKho: filters.maKho,
      dateFrom: start.startOf('day').format('YYYY-MM-DD HH:mm:ss'),
      dateTo: end.endOf('day').format('YYYY-MM-DD HH:mm:ss'),
      keyword: filters.keyword?.trim() || undefined,
      includeZero: filters.includeZero ? 1 : 0,
      limit: 1000
    };

    setLoading(true);
    try {
      const data = await baoCaoXuatNhapTon(payload);
      if (!data || data.success === false) {
        throw new Error(data?.message || 'Khong the tai bao cao.');
      }

      setReport({
        summary: data.summary || createEmptySummary(),
        items: Array.isArray(data.items) ? data.items : [],
        warehouses: data.warehouses || [],
        filters: data.filters || payload,
        generatedAt: data.generatedAt || null
      });
    } catch (error) {
      console.error(error);
      message.error(error.message || 'Khong the tai bao cao.');
    } finally {
      setLoading(false);
    }
  }, [filters]);

  const handleReset = useCallback(() => {
    setFilters({
      maKho: undefined,
      dateRange: createDefaultRange(),
      keyword: '',
      includeZero: false
    });
    setReport({
      summary: createEmptySummary(),
      items: [],
      warehouses: [],
      filters: null,
      generatedAt: null
    });
  }, []);

  const summaryCards = useMemo(
    () => [
      {
        key: 'tonDau',
        title: 'Ton dau ky',
        quantity: report.summary.tonDau,
        amount: report.summary.giaTriTonDau,
        icon: <ArrowDownCircle size={22} className="summary-icon icon-blue" />
      },
      {
        key: 'tonNhap',
        title: 'Tong nhap',
        quantity: report.summary.tonNhap,
        amount: report.summary.giaTriNhap,
        icon: <ArrowDownCircle size={22} className="summary-icon icon-green" />
      },
      {
        key: 'tonXuat',
        title: 'Tong xuat',
        quantity: report.summary.tonXuat,
        amount: report.summary.giaTriXuat,
        icon: <ArrowUpCircle size={22} className="summary-icon icon-red" />
      },
      {
        key: 'tonCuoi',
        title: 'Ton cuoi ky',
        quantity: report.summary.tonCuoi,
        amount: report.summary.giaTriTonCuoi,
        icon: <TrendingUp size={22} className="summary-icon icon-purple" />
      }
    ],
    [report.summary]
  );

  const columns = useMemo(
    () => [
      {
        title: 'STT',
        dataIndex: 'index',
        width: 70,
        align: 'center',
        fixed: 'left',
        render: (_value, _record, index) => index + 1
      },
      {
        title: 'Ma hang',
        dataIndex: 'maSanPham',
        width: 140,
        fixed: 'left'
      },
      {
        title: 'Ten hang',
        dataIndex: 'tenSanPham',
        width: 220
      },
      {
        title: 'DVT',
        dataIndex: 'donViTinh',
        width: 90,
        align: 'center'
      },
      {
        title: 'Ton dau',
        dataIndex: 'tonDau',
        align: 'right',
        render: (value) => formatNumber(value)
      },
      {
        title: 'Nhap',
        dataIndex: 'nhap',
        align: 'right',
        render: (value) => formatNumber(value)
      },
      {
        title: 'Xuat',
        dataIndex: 'xuat',
        align: 'right',
        render: (value) => formatNumber(value)
      },
      {
        title: 'Ton cuoi',
        dataIndex: 'tonCuoi',
        align: 'right',
        render: (value) => formatNumber(value)
      },
      {
        title: 'Gia binh quan',
        dataIndex: 'giaBinhQuan',
        align: 'right',
        render: (value) => formatCurrency(value)
      },
      {
        title: 'Tien ton dau',
        dataIndex: 'tienTonDau',
        align: 'right',
        render: (value) => formatCurrency(value)
      },
      {
        title: 'Tien nhap',
        dataIndex: 'tienNhap',
        align: 'right',
        render: (value) => formatCurrency(value)
      },
      {
        title: 'Tien xuat',
        dataIndex: 'tienXuat',
        align: 'right',
        render: (value) => formatCurrency(value)
      },
      {
        title: 'Tien ton cuoi',
        dataIndex: 'tienTonCuoi',
        align: 'right',
        render: (value) => formatCurrency(value)
      }
    ],
    []
  );

  const appliedRange = useMemo(() => {
    if (!report.filters?.dateFrom || !report.filters?.dateTo) {
      return null;
    }
    return {
      from: dayjs(report.filters.dateFrom),
      to: dayjs(report.filters.dateTo)
    };
  }, [report.filters]);

  return (
    <div className="bao-cao-theo-dieu-kien-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Quan ly kho</Breadcrumb.Item>
        <Breadcrumb.Item>Bao cao theo dieu kien</Breadcrumb.Item>
      </Breadcrumb>

      <Card className="bao-cao-header-card" bordered={false}>
        <div className="bao-cao-header">
          <div className="bao-cao-title">
            <FileBarChart2 size={32} />
            <div>
              <Title level={3} className="bao-cao-title-text">
                Bao cao xuat nhap ton
              </Title>
              <Text type="secondary">
                Nhap dieu kien loc, nhan &quot;Bao cao&quot; de xem ton dau, nhap, xuat va ton cuoi theo tung ma hang.
              </Text>
            </div>
          </div>
        </div>
      </Card>

      <Card className="bao-cao-filter-card" bordered={false}>
        <Row gutter={[16, 16]} align="middle">
          <Col xs={24} md={6}>
            <Text className="bao-cao-filter-label">Kho</Text>
            <Select
              allowClear
              placeholder="Chon kho"
              options={warehouseOptions}
              value={filters.maKho}
              onChange={(value) => setFilters((prev) => ({ ...prev, maKho: value }))}
              className="bao-cao-filter-control"
            />
          </Col>
          <Col xs={24} md={8}>
            <Text className="bao-cao-filter-label">Khoang thoi gian</Text>
            <RangePicker
              allowClear={false}
              format="DD/MM/YYYY"
              value={filters.dateRange}
              onChange={(value) => setFilters((prev) => ({ ...prev, dateRange: value }))}
              className="bao-cao-filter-control"
            />
          </Col>
          <Col xs={24} md={6}>
            <Text className="bao-cao-filter-label">Ma/Ten hang</Text>
            <Input
              placeholder="Nhap tu khoa"
              value={filters.keyword}
              onChange={(event) => setFilters((prev) => ({ ...prev, keyword: event.target.value }))}
              className="bao-cao-filter-control"
              allowClear
            />
          </Col>
          <Col xs={24} md={4}>
            <Checkbox
              checked={filters.includeZero}
              onChange={(event) => setFilters((prev) => ({ ...prev, includeZero: event.target.checked }))}
            >
              Hien ca dong khong phat sinh
            </Checkbox>
          </Col>
          <Col xs={24} className="bao-cao-filter-actions">
            <Space size="middle">
              <Button type="primary" onClick={handleReport}>
                Bao cao
              </Button>
              <Button onClick={handleReset}>Dat lai</Button>
            </Space>
          </Col>
        </Row>
      </Card>

      <Spin spinning={loading}>
        <Row gutter={[16, 16]} className="bao-cao-summary-grid">
          {summaryCards.map((card) => (
            <Col xs={24} sm={12} xl={6} key={card.key}>
              <Card className="bao-cao-summary-card" bordered={false}>
                <div className="bao-cao-summary-card-header">
                  {card.icon}
                  <Text className="bao-cao-summary-title">{card.title}</Text>
                </div>
                <div className="bao-cao-summary-values">
                  <div className="bao-cao-summary-quantity">{formatNumber(card.quantity)}</div>
                  <div className="bao-cao-summary-amount">{formatCurrency(card.amount)}</div>
                </div>
              </Card>
            </Col>
          ))}
        </Row>

        <Card className="bao-cao-table-card" bordered={false}>
          <div className="bao-cao-table-header">
            <div>
              <Title level={4}>Chi tiet xuat nhap ton</Title>
              <Text type="secondary">
                Tong so dong: {report.items.length.toLocaleString('vi-VN')}
              </Text>
            </div>
            <div className="bao-cao-meta-info">
              <Space wrap>
                {report.warehouses && report.warehouses.length > 0 ? (
                  report.warehouses.map((item) => (
                    <Tag key={item.maKho || item.tenKho} color="geekblue">
                      {item.tenKho || item.maKho}
                    </Tag>
                  ))
                ) : (
                  <Tag>Tat ca kho</Tag>
                )}
                {filters.includeZero && <Tag color="cyan">Da bao gom dong khong phat sinh</Tag>}
              </Space>
              {appliedRange && (
                <Text type="secondary">
                  Tu {appliedRange.from.format('DD/MM/YYYY')} den {appliedRange.to.format('DD/MM/YYYY')}
                </Text>
              )}
              {report.generatedAt && (
                <Text type="secondary">
                  Cap nhat luc {dayjs(report.generatedAt).format('DD/MM/YYYY HH:mm')}
                </Text>
              )}
            </div>
          </div>

          <Table
            rowKey={(record, index) => record.maSanPham || `${record.tenSanPham}-${index}`}
            columns={columns}
            dataSource={report.items}
            pagination={{ pageSize: 20, showSizeChanger: true }}
            scroll={{ x: 1400 }}
            size="middle"
          />
        </Card>
      </Spin>
    </div>
  );
};

export default BaoCaoTheoDieuKien;

