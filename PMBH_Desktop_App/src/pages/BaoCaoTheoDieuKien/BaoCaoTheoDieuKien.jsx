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
import {
  listPhieuNhap,
  listPhieuXuat,
  listChiTietPhieuNhap,
  listChiTietPhieuXuat,
  getDanhSachKho,
  listTatCaNguyenLieu
} from '../../services/apiServices';
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

const normalizeDetail = (item) => ({
  maSanPham: item?.maSanPham ?? item?.maSp ?? item?.lv003 ?? '',
  soLuong: Number(item?.soLuong ?? item?.lv004 ?? 0),
  gia: Number(item?.gia ?? item?.lv008 ?? 0)
});

const buildTopList = (map, productMap) => {
  return Object.entries(map)
    .map(([maSanPham, value]) => ({
      maSanPham,
      tenSanPham: productMap[maSanPham]?.tenSp || productMap[maSanPham]?.lv002 || '—',
      soLuong: value.soLuong,
      giaTri: value.giaTri
    }))
    .sort((a, b) => b.soLuong - a.soLuong)
    .slice(0, 5);
};

const BaoCaoTheoDieuKien = () => {
  const [loading, setLoading] = useState(false);
  const [warehouses, setWarehouses] = useState([]);
  const [products, setProducts] = useState([]);
  const [receiptsNhap, setReceiptsNhap] = useState([]);
  const [receiptsXuat, setReceiptsXuat] = useState([]);
  const [filters, setFilters] = useState({
    maKho: undefined,
    dateRange: [dayjs().subtract(7, 'day'), dayjs()]
  });
  const [report, setReport] = useState({
    nhap: [],
    xuat: [],
    tongNhap: 0,
    tongXuat: 0,
    soPhieuNhap: 0,
    soPhieuXuat: 0
  });
  const [productReport, setProductReport] = useState({ nhap: [], xuat: [] });

  const detailNhapCache = useRef({});
  const detailXuatCache = useRef({});

  const productMap = useMemo(() => {
    const map = {};
    products.forEach((item) => {
      const code = item?.maSp || item?.maSP || item?.lv001;
      if (code) {
        map[code] = item;
      }
    });
    return map;
  }, [products]);

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
    [warehouses]
  );

  const fetchBaseData = useCallback(async () => {
    try {
      const [warehouseData, productData, nhapData, xuatData] = await Promise.all([
        getDanhSachKho(),
        listTatCaNguyenLieu(),
        listPhieuNhap(),
        listPhieuXuat()
      ]);

      setWarehouses(Array.isArray(warehouseData) ? warehouseData : []);
      setProducts(Array.isArray(productData) ? productData : []);
      setReceiptsNhap(Array.isArray(nhapData) ? nhapData.map(normalizeNhap) : []);
      setReceiptsXuat(Array.isArray(xuatData) ? xuatData.map(normalizeXuat) : []);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải dữ liệu báo cáo.');
    }
  }, []);

  useEffect(() => {
    fetchBaseData();
  }, [fetchBaseData]);

  const buildReport = useCallback(async () => {
    if (!receiptsNhap.length && !receiptsXuat.length) {
      return;
    }

    setLoading(true);
    try {
      const [start, end] = filters.dateRange || [];
      const startDate = start ? start.startOf('day') : null;
      const endDate = end ? end.endOf('day') : null;

      const filterByRange = (item) => {
        const date = parseDate(item.ngay);
        if (!date) {
          return false;
        }
        if (startDate && date.isBefore(startDate)) {
          return false;
        }
        if (endDate && date.isAfter(endDate)) {
          return false;
        }
        return true;
      };

      const filteredNhap = receiptsNhap
        .filter((item) => (filters.maKho ? item.maKho === filters.maKho : true))
        .filter(filterByRange);
      const filteredXuat = receiptsXuat
        .filter((item) => (filters.maKho ? item.maKho === filters.maKho : true))
        .filter(filterByRange);

      const tongNhap = filteredNhap.reduce((sum, item) => sum + Number(item.tongTien || 0), 0);

      const nhapDetails = await Promise.all(
        filteredNhap.map(async (item) => {
          if (!detailNhapCache.current[item.maPhieu]) {
            const detail = await listChiTietPhieuNhap(item.maPhieu);
            detailNhapCache.current[item.maPhieu] = Array.isArray(detail)
              ? detail.map(normalizeDetail)
              : [];
          }
          return detailNhapCache.current[item.maPhieu];
        })
      );

      const nhapProductMap = {};
      nhapDetails.forEach((list) => {
        list.forEach((detail) => {
          if (!nhapProductMap[detail.maSanPham]) {
            nhapProductMap[detail.maSanPham] = { soLuong: 0, giaTri: 0 };
          }
          nhapProductMap[detail.maSanPham].soLuong += detail.soLuong;
          nhapProductMap[detail.maSanPham].giaTri += detail.soLuong * detail.gia;
        });
      });

      let tongXuat = 0;
      const xuatDetails = await Promise.all(
        filteredXuat.map(async (item) => {
          if (!detailXuatCache.current[item.maPhieu]) {
            const detail = await listChiTietPhieuXuat(item.maPhieu);
            detailXuatCache.current[item.maPhieu] = Array.isArray(detail)
              ? detail.map(normalizeDetail)
              : [];
          }
          return detailXuatCache.current[item.maPhieu];
        })
      );

      const xuatProductMap = {};
      xuatDetails.forEach((list) => {
        list.forEach((detail) => {
          if (!xuatProductMap[detail.maSanPham]) {
            xuatProductMap[detail.maSanPham] = { soLuong: 0, giaTri: 0 };
          }
          xuatProductMap[detail.maSanPham].soLuong += detail.soLuong;
          xuatProductMap[detail.maSanPham].giaTri += detail.soLuong * detail.gia;
        });
        const total = list.reduce((sum, detail) => sum + detail.soLuong * detail.gia, 0);
        tongXuat += total;
      });

      setReport({
        nhap: filteredNhap,
        xuat: filteredXuat.map((item, index) => ({
          ...item,
          tongTien: xuatDetails[index].reduce(
            (sum, detail) => sum + detail.soLuong * detail.gia,
            0
          )
        })),
        tongNhap,
        tongXuat,
        soPhieuNhap: filteredNhap.length,
        soPhieuXuat: filteredXuat.length
      });

      setProductReport({
        nhap: buildTopList(nhapProductMap, productMap),
        xuat: buildTopList(xuatProductMap, productMap)
      });
    } catch (error) {
      console.error(error);
      message.error('Không thể tổng hợp báo cáo.');
    } finally {
      setLoading(false);
    }
  }, [filters, productMap, receiptsNhap, receiptsXuat]);

  useEffect(() => {
    buildReport();
  }, [buildReport]);

  const summaryData = useMemo(() => {
    const chenhlech = report.tongNhap - report.tongXuat;
    return [
      {
        title: 'Phiếu nhập',
        value: report.soPhieuNhap,
        prefix: <ArrowDownCircle size={18} color="#52c41a" />
      },
      {
        title: 'Giá trị nhập',
        value: report.tongNhap,
        prefix: <ArrowDownCircle size={18} color="#389e0d" />,
        currency: true
      },
      {
        title: 'Phiếu xuất',
        value: report.soPhieuXuat,
        prefix: <ArrowUpCircle size={18} color="#fa541c" />
      },
      {
        title: 'Giá trị xuất',
        value: report.tongXuat,
        prefix: <ArrowUpCircle size={18} color="#d4380d" />,
        currency: true
      },
      {
        title: 'Chênh lệch tồn',
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
                dataSource={productReport.nhap}
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
                dataSource={productReport.xuat}
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