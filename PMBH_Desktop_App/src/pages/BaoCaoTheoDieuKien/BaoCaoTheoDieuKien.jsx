import React, { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Row,
  Col,
  Statistic,
  Typography,
  Select,
  DatePicker,
  Button,
  Table,
  Space,
  Tag,
  message,
  Spin
} from 'antd';
import { FileBarChart2, ArrowDownCircle, ArrowUpCircle, TrendingUp } from 'lucide-react';
import dayjs from 'dayjs';
import { getDanhSachKho, baoCaoKhoTheoDieuKien } from '../../services/apiServices';
import './BaoCaoTheoDieuKien.css';

const { RangePicker } = DatePicker;

const parseDate = (value) => {
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

const formatDate = (value) => {
  const parsed = parseDate(value);
  return parsed ? parsed.format('DD/MM/YYYY HH:mm') : '';
};

const normalizeNhap = (item) => ({
  maPhieu: item?.maPhieuNhap ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  ghiChu: item?.ghiChu ?? item?.lv004 ?? '',
  loaiPhieu: item?.loaiPhieu ?? item?.lv005 ?? '',
  maThamChieu: item?.maThamChieu ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? '',
  tongTien: Number(item?.tongTien ?? item?.lv008 ?? 0),
  ngay: item?.ngayNhap ?? item?.lv009 ?? ''
});

const normalizeXuat = (item) => ({
  maPhieu: item?.maPhieuXuat ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  chuDe: item?.chuDe ?? item?.lv004 ?? '',
  nguonXuat: item?.nguonXuat ?? item?.lv005 ?? '',
  maThamChieu: item?.maThamChieu ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? '',
  ngay: item?.ngayXuat ?? item?.lv009 ?? ''
});

const normalizeTopSanPham = (item) => ({
  maSanPham: item?.maSanPham ?? '',
  tenSanPham: item?.tenSanPham ?? '-',
  soLuong: Number(item?.soLuong ?? 0),
  giaTri: Number(item?.giaTri ?? 0)
});

const BaoCaoTheoDieuKien = () => {
  const [loading, setLoading] = useState(false);
  const [warehouses, setWarehouses] = useState([]);
  const [filters, setFilters] = useState({
    maKho: undefined,
    dateRange: [dayjs().subtract(7, 'day'), dayjs()]
  });
  const [report, setReport] = useState({
    nhap: [],
    xuat: [],
    summary: {
      tongNhap: 0,
      tongXuat: 0,
      soPhieuNhap: 0,
      soPhieuXuat: 0
    },
    topNhap: [],
    topXuat: []
  });
  const initialReportRef = useRef(false);

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
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

  const buildReport = useCallback(async () => {
    setLoading(true);
    try {
      const [start, end] = filters.dateRange || [];
      const dateFrom = start ? start.startOf('day').format('YYYY-MM-DD HH:mm:ss') : null;
      const dateTo = end ? end.endOf('day').format('YYYY-MM-DD HH:mm:ss') : null;

      const payload = {
        maKho: filters.maKho || '',
        dateFrom,
        dateTo,
        topLimit: 5
      };

      const data = await baoCaoKhoTheoDieuKien(payload);
      const nhap = Array.isArray(data?.nhap) ? data.nhap.map(normalizeNhap) : [];
      const xuatSource = Array.isArray(data?.xuat) ? data.xuat : [];
      const xuat = xuatSource.map((item) => ({
        ...normalizeXuat(item),
        tongTien: Number(item?.tongTien ?? 0)
      }));
      const summary = data?.summary || {};
      const topNhap = Array.isArray(data?.topNhap) ? data.topNhap.map(normalizeTopSanPham) : [];
      const topXuat = Array.isArray(data?.topXuat) ? data.topXuat.map(normalizeTopSanPham) : [];

      setReport({
        nhap,
        xuat,
        summary: {
          tongNhap: Number(summary.tongNhap ?? 0),
          tongXuat: Number(summary.tongXuat ?? 0),
          soPhieuNhap: Number(summary.soPhieuNhap ?? nhap.length),
          soPhieuXuat: Number(summary.soPhieuXuat ?? xuat.length)
        },
        topNhap,
        topXuat
      });
    } catch (error) {
      console.error(error);
      message.error('Khong the tong hop bao cao kho.');
    } finally {
      setLoading(false);
    }
  }, [filters]);

  useEffect(() => {
    if (!initialReportRef.current) {
      initialReportRef.current = true;
      buildReport();
    }
  }, [buildReport]);

  const summaryData = useMemo(() => {
    const summary = report.summary || {};
    const tongNhap = Number(summary.tongNhap || 0);
    const tongXuat = Number(summary.tongXuat || 0);
    const chenhlech = tongNhap - tongXuat;
    return [
      {
        title: 'Phieu nhap',
        value: Number(summary.soPhieuNhap || 0),
        prefix: <ArrowDownCircle size={18} color="#52c41a" />
      },
      {
        title: 'Gia tri nhap',
        value: tongNhap,
        prefix: <ArrowDownCircle size={18} color="#389e0d" />,
        currency: true
      },
      {
        title: 'Phieu xuat',
        value: Number(summary.soPhieuXuat || 0),
        prefix: <ArrowUpCircle size={18} color="#fa541c" />
      },
      {
        title: 'Gia tri xuat',
        value: tongXuat,
        prefix: <ArrowUpCircle size={18} color="#d4380d" />,
        currency: true
      },
      {
        title: 'Chenh lech ton',
        value: chenhlech,
        prefix: <TrendingUp size={18} color={chenhlech >= 0 ? '#237804' : '#cf1322'} />,
        currency: true
      }
    ];
  }, [report]);
  const nhapColumns = [
    {
      title: 'Mã phiếu',
      dataIndex: 'maPhieu',
      key: 'maPhieu',
      render: (value) => <Tag color="blue">{value}</Tag>
    },
    {
      title: 'Kho',
      dataIndex: 'maKho',
      key: 'maKho'
    },
    {
      title: 'Ngày nhập',
      dataIndex: 'ngay',
      key: 'ngay',
      render: (value) => formatDate(value)
    },
    {
      title: 'Loại phiếu',
      dataIndex: 'loaiPhieu',
      key: 'loaiPhieu'
    },
    {
      title: 'Tổng tiền',
      dataIndex: 'tongTien',
      key: 'tongTien',
      align: 'right',
      render: (value) =>
        Number(value || 0).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        })
    }
  ];

  const xuatColumns = [
    {
      title: 'Mã phiếu',
      dataIndex: 'maPhieu',
      key: 'maPhieu',
      render: (value) => <Tag color="volcano">{value}</Tag>
    },
    {
      title: 'Kho',
      dataIndex: 'maKho',
      key: 'maKho'
    },
    {
      title: 'Ngày xuất',
      dataIndex: 'ngay',
      key: 'ngay',
      render: (value) => formatDate(value)
    },
    {
      title: 'Nguồn xuất',
      dataIndex: 'nguonXuat',
      key: 'nguonXuat'
    },
    {
      title: 'Giá trị xuất',
      dataIndex: 'tongTien',
      key: 'tongTien',
      align: 'right',
      render: (value) =>
        Number(value || 0).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        })
    }
  ];

  const productColumns = [
    {
      title: 'Mã sản phẩm',
      dataIndex: 'maSanPham',
      key: 'maSanPham'
    },
    {
      title: 'Tên sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham'
    },
    {
      title: 'Số lượng',
      dataIndex: 'soLuong',
      key: 'soLuong',
      align: 'right',
      render: (value) => Number(value || 0).toLocaleString('vi-VN')
    },
    {
      title: 'Giá trị',
      dataIndex: 'giaTri',
      key: 'giaTri',
      align: 'right',
      render: (value) =>
        Number(value || 0).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        })
    }
  ];

  return (
    <div className="bao-cao-theo-dieu-kien-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Quản lý kho</Breadcrumb.Item>
        <Breadcrumb.Item>Báo cáo theo điều kiện</Breadcrumb.Item>
      </Breadcrumb>

      <div className="bao-cao-header">
        <div className="bao-cao-title">
          <FileBarChart2 size={28} />
          <div>
            <Typography.Title level={3} className="bao-cao-title-text">
              Báo cáo nhập - xuất theo điều kiện
            </Typography.Title>
            <Typography.Text type="secondary">
              Phân tích biến động kho theo khoảng thời gian và theo kho cụ thể.
            </Typography.Text>
          </div>
        </div>
        <Space className="bao-cao-actions" wrap>
          <Select
            allowClear
            placeholder="Chọn kho"
            className="bao-cao-select"
            options={warehouseOptions}
            value={filters.maKho}
            onChange={(value) => setFilters((prev) => ({ ...prev, maKho: value }))}
          />
          <RangePicker
            allowClear
            className="bao-cao-range"
            value={filters.dateRange}
            onChange={(value) => setFilters((prev) => ({ ...prev, dateRange: value }))}
          />
          <Button onClick={buildReport}>Áp dụng</Button>
        </Space>
      </div>

      <Spin spinning={loading}>
        <Row gutter={16} className="bao-cao-summary">
          {summaryData.map((item) => (
            <Col xs={24} sm={12} md={8} lg={4} key={item.title}>
              <Card className="bao-cao-stat-card">
                <Statistic
                  title={item.title}
                  value={item.value}
                  prefix={item.prefix}
                  precision={item.currency ? 0 : undefined}
                  formatter={(value) =>
                    item.currency
                      ? Number(value || 0).toLocaleString('vi-VN', {
                          style: 'currency',
                          currency: 'VND',
                          maximumFractionDigits: 0
                        })
                      : value
                  }
                />
              </Card>
            </Col>
          ))}
        </Row>

        <Row gutter={16}>
          <Col xs={24} lg={14}>
            <Card title="Phiếu nhập" className="bao-cao-card">
              <Table
                rowKey={(record) => record.maPhieu}
                columns={nhapColumns}
                dataSource={report.nhap}
                pagination={{ pageSize: 6 }}
                size="small"
              />
            </Card>
          </Col>
          <Col xs={24} lg={10}>
            <Card title="Top sản phẩm nhập" className="bao-cao-card">
              <Table
                rowKey={(record) => record.maSanPham}
                columns={productColumns}
                dataSource={report.topNhap}
                pagination={false}
                size="small"
              />
            </Card>
          </Col>
        </Row>

        <Row gutter={16}>
          <Col xs={24} lg={14}>
            <Card title="Phiếu xuất" className="bao-cao-card">
              <Table
                rowKey={(record) => record.maPhieu}
                columns={xuatColumns}
                dataSource={report.xuat}
                pagination={{ pageSize: 6 }}
                size="small"
              />
            </Card>
          </Col>
          <Col xs={24} lg={10}>
            <Card title="Top sản phẩm xuất" className="bao-cao-card">
              <Table
                rowKey={(record) => record.maSanPham}
                columns={productColumns}
                dataSource={report.topXuat}
                pagination={false}
                size="small"
              />
            </Card>
          </Col>
        </Row>
      </Spin>
    </div>
  );
};

export default BaoCaoTheoDieuKien;
