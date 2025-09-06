import React, { useState, useEffect } from 'react';
import { 
  Card, Row, Col, Table, Button, Select, DatePicker,
  Space, Statistic, Tooltip, message 
} from 'antd';
import {
  BarChartOutlined,
  DollarOutlined,
  ShoppingCartOutlined,
  TrophyOutlined,
  DownloadOutlined,
  FileExcelOutlined,
  FilePdfOutlined,
  PrinterOutlined
} from '@ant-design/icons';
import { Line, Bar, Pie } from '@ant-design/charts';
import moment from 'moment';

const { Option } = Select;
const { RangePicker } = DatePicker;

const BaoCaoThongKe = () => {
  const [duLieuThongKe, setDuLieuThongKe] = useState({});
  const [doanhThuTheoNgay, setDoanhThuTheoNgay] = useState([]);
  const [sanPhamBanChay, setSanPhamBanChay] = useState([]);
  const [doanhThuTheoDanhMuc, setDoanhThuTheoDanhMuc] = useState([]);
  const [loading, setLoading] = useState(false);
  const [khoangThoiGian, setKhoangThoiGian] = useState([
    moment().subtract(7, 'days'),
    moment()
  ]);

  useEffect(() => {
    taiDuLieuThongKe();
  }, [khoangThoiGian]);

  const taiDuLieuThongKe = async () => {
    setLoading(true);
    try {
      // Demo data
      const thongKeTongQuat = {
        tongDoanhThu: 156500000,
        tongDonHang: 1247,
        giaTriTrungBinh: 125500,
        khachHangMoi: 89,
        tileHoanThanh: 96.5,
        soSanPham: 156,
        soNhanVien: 8,
        soBan: 24
      };

      const doanhThuHangNgay = [];
      for (let i = 7; i >= 0; i--) {
        const ngay = moment().subtract(i, 'days');
        doanhThuHangNgay.push({
          ngay: ngay.format('DD/MM'),
          doanhThu: Math.floor(Math.random() * 5000000) + 15000000,
          donHang: Math.floor(Math.random() * 50) + 80
        });
      }

      const topSanPham = [
        { tenSanPham: 'Cà phê đen đá', soLuong: 245, doanhThu: 6125000 },
        { tenSanPham: 'Cà phê sữa', soLuong: 198, doanhThu: 5940000 },
        { tenSanPham: 'Trà sữa thái', soLuong: 156, doanhThu: 7800000 },
        { tenSanPham: 'Sinh tố bơ', soLuong: 132, doanhThu: 5280000 },
        { tenSanPham: 'Bánh mì thịt', soLuong: 98, doanhThu: 2940000 },
        { tenSanPham: 'Nước ép cam', soLuong: 87, doanhThu: 2610000 },
        { tenSanPham: 'Chè ba màu', soLuong: 76, doanhThu: 2280000 }
      ];

      const doanhThuDanhMuc = [
        { danhMuc: 'Cà phê', doanhThu: 45200000, tiLe: 28.9 },
        { danhMuc: 'Trà & Trà sữa', doanhThu: 38500000, tiLe: 24.6 },
        { danhMuc: 'Sinh tố & Nước ép', doanhThu: 29800000, tiLe: 19.0 },
        { danhMuc: 'Đồ ăn nhẹ', doanhThu: 25300000, tiLe: 16.2 },
        { danhMuc: 'Chè & Dessert', doanhThu: 17700000, tiLe: 11.3 }
      ];

      setDuLieuThongKe(thongKeTongQuat);
      setDoanhThuTheoNgay(doanhThuHangNgay);
      setSanPhamBanChay(topSanPham);
      setDoanhThuTheoDanhMuc(doanhThuDanhMuc);
    } catch (error) {
      console.error('Lỗi tải dữ liệu thống kê:', error);
      message.error('Không thể tải dữ liệu thống kê');
    } finally {
      setLoading(false);
    }
  };

  const xuatBaoCao = (loai) => {
    message.success(`Đang xuất báo cáo ${loai}...`);
  };

  const inBaoCao = () => {
    window.print();
    message.success('Đang in báo cáo...');
  };

  // Cấu hình biểu đồ doanh thu theo ngày
  const configDoanhThu = {
    data: doanhThuTheoNgay,
    xField: 'ngay',
    yField: 'doanhThu',
    point: {
      size: 5,
      shape: 'diamond',
    },
    label: {
      style: {
        fill: '#aaa',
      },
    },
    color: '#1890ff',
    tooltip: {
      formatter: (datum) => ({
        name: 'Doanh thu',
        value: datum.doanhThu.toLocaleString() + 'đ'
      })
    }
  };

  // Cấu hình biểu đồ sản phẩm bán chạy
  const configSanPham = {
    data: sanPhamBanChay.slice(0, 5),
    xField: 'soLuong',
    yField: 'tenSanPham',
    seriesField: 'tenSanPham',
    color: ['#1890ff', '#52c41a', '#faad14', '#f5222d', '#722ed1'],
    tooltip: {
      formatter: (datum) => ({
        name: datum.tenSanPham,
        value: `${datum.soLuong} ly - ${datum.doanhThu.toLocaleString()}đ`
      })
    }
  };

  // Cấu hình biểu đồ doanh thu theo danh mục
  const configDanhMuc = {
    appendPadding: 10,
    data: doanhThuTheoDanhMuc,
    angleField: 'doanhThu',
    colorField: 'danhMuc',
    radius: 0.8,
    label: {
      type: 'outer',
      content: '{name} {percentage}',
    },
    interactions: [
      {
        type: 'element-active',
      },
    ],
    tooltip: {
      formatter: (datum) => ({
        name: datum.danhMuc,
        value: datum.doanhThu.toLocaleString() + 'đ'
      })
    }
  };

  const cotSanPham = [
    {
      title: 'STT',
      dataIndex: 'stt',
      key: 'stt',
      width: 60,
      render: (_, __, index) => index + 1
    },
    {
      title: 'Tên sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
    },
    {
      title: 'Số lượng bán',
      dataIndex: 'soLuong',
      key: 'soLuong',
      render: (soLuong) => soLuong.toLocaleString(),
      sorter: (a, b) => a.soLuong - b.soLuong,
    },
    {
      title: 'Doanh thu',
      dataIndex: 'doanhThu',
      key: 'doanhThu',
      render: (doanhThu) => `${doanhThu.toLocaleString()}đ`,
      sorter: (a, b) => a.doanhThu - b.doanhThu,
    },
  ];

  return (
    <div style={{ padding: '24px' }}>
      <Row justify="space-between" align="middle" style={{ marginBottom: '24px' }}>
        <Col>
          <h2>Báo cáo & Thống kê</h2>
        </Col>
        <Col>
          <Space>
            <RangePicker
              value={khoangThoiGian}
              onChange={setKhoangThoiGian}
              format="DD/MM/YYYY"
            />
            <Button icon={<FileExcelOutlined />} onClick={() => xuatBaoCao('Excel')}>
              Xuất Excel
            </Button>
            <Button icon={<FilePdfOutlined />} onClick={() => xuatBaoCao('PDF')}>
              Xuất PDF
            </Button>
            <Button icon={<PrinterOutlined />} onClick={inBaoCao}>
              In báo cáo
            </Button>
          </Space>
        </Col>
      </Row>

      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: '24px' }}>
        <Col span={6}>
          <Card>
            <Statistic
              title="Tổng doanh thu"
              value={duLieuThongKe.tongDoanhThu}
              precision={0}
              valueStyle={{ color: '#3f8600' }}
              prefix={<DollarOutlined />}
              suffix="đ"
              formatter={(value) => value?.toLocaleString()}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Tổng đơn hàng"
              value={duLieuThongKe.tongDonHang}
              valueStyle={{ color: '#1890ff' }}
              prefix={<ShoppingCartOutlined />}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Giá trị TB/đơn"
              value={duLieuThongKe.giaTriTrungBinh}
              precision={0}
              valueStyle={{ color: '#722ed1' }}
              prefix={<BarChartOutlined />}
              suffix="đ"
              formatter={(value) => value?.toLocaleString()}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Tỷ lệ hoàn thành"
              value={duLieuThongKe.tileHoanThanh}
              precision={1}
              valueStyle={{ color: '#cf1322' }}
              prefix={<TrophyOutlined />}
              suffix="%"
            />
          </Card>
        </Col>
      </Row>

      {/* Biểu đồ doanh thu theo ngày */}
      <Row gutter={16} style={{ marginBottom: '24px' }}>
        <Col span={16}>
          <Card title="Doanh thu theo ngày" loading={loading}>
            <Line {...configDoanhThu} height={300} />
          </Card>
        </Col>
        <Col span={8}>
          <Card title="Doanh thu theo danh mục" loading={loading}>
            <Pie {...configDanhMuc} height={300} />
          </Card>
        </Col>
      </Row>

      {/* Top sản phẩm bán chạy */}
      <Row gutter={16} style={{ marginBottom: '24px' }}>
        <Col span={12}>
          <Card title="Top 5 sản phẩm bán chạy" loading={loading}>
            <Bar {...configSanPham} height={300} />
          </Card>
        </Col>
        <Col span={12}>
          <Card 
            title="Chi tiết sản phẩm bán chạy"
            extra={
              <Tooltip title="Dữ liệu được cập nhật theo thời gian thực">
                <Button type="link" icon={<DownloadOutlined />} size="small">
                  Tải chi tiết
                </Button>
              </Tooltip>
            }
            loading={loading}
          >
            <Table
              columns={cotSanPham}
              dataSource={sanPhamBanChay}
              pagination={false}
              size="small"
              scroll={{ y: 240 }}
            />
          </Card>
        </Col>
      </Row>

      {/* Thống kê chi tiết */}
      <Row gutter={16}>
        <Col span={8}>
          <Card title="Thống kê khách hàng" loading={loading}>
            <div style={{ textAlign: 'center' }}>
              <Statistic
                title="Khách hàng mới"
                value={duLieuThongKe.khachHangMoi}
                valueStyle={{ color: '#52c41a', fontSize: '36px' }}
              />
              <div style={{ marginTop: '16px', color: '#666' }}>
                Trong 7 ngày qua
              </div>
            </div>
          </Card>
        </Col>
        <Col span={8}>
          <Card title="Quản lý cửa hàng" loading={loading}>
            <Space direction="vertical" style={{ width: '100%' }}>
              <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                <span>Số sản phẩm:</span>
                <strong>{duLieuThongKe.soSanPham}</strong>
              </div>
              <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                <span>Số nhân viên:</span>
                <strong>{duLieuThongKe.soNhanVien}</strong>
              </div>
              <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                <span>Số bàn:</span>
                <strong>{duLieuThongKe.soBan}</strong>
              </div>
            </Space>
          </Card>
        </Col>
        <Col span={8}>
          <Card title="Hiệu suất hoạt động" loading={loading}>
            <div style={{ textAlign: 'center' }}>
              <div style={{ 
                fontSize: '48px', 
                fontWeight: 'bold',
                color: duLieuThongKe.tileHoanThanh >= 95 ? '#52c41a' : 
                       duLieuThongKe.tileHoanThanh >= 85 ? '#faad14' : '#f5222d'
              }}>
                {duLieuThongKe.tileHoanThanh}%
              </div>
              <div style={{ color: '#666', marginTop: '8px' }}>
                Tỷ lệ hoàn thành đơn hàng
              </div>
            </div>
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default BaoCaoThongKe;
