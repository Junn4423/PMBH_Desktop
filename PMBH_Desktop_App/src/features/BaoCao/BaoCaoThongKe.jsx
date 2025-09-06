import React, { useState, useEffect } from 'react';
import { Row, Col, Card, Statistic, Table, DatePicker, Select, Button, Space, Progress } from 'antd';
import { 
  DollarOutlined, 
  ShoppingCartOutlined, 
  UserOutlined, 
  TrophyOutlined,
  RiseOutlined,
  FallOutlined,
  FileTextOutlined,
  BarChartOutlined
} from '@ant-design/icons';
import dayjs from 'dayjs';

const { RangePicker } = DatePicker;
const { Option } = Select;

const BaoCaoThongKe = () => {
  const [tuNgay, setTuNgay] = useState(dayjs().startOf('month'));
  const [denNgay, setDenNgay] = useState(dayjs());
  const [loaiBaoCao, setLoaiBaoCao] = useState('doanh_thu');

  // Dữ liệu mẫu thống kê
  const thongKeDoanhThu = {
    doanhThuHomNay: 2500000,
    doanhThuThangTruoc: 45000000,
    doanhThuThangNay: 52000000,
    tangTruong: 15.6,
    soHoaDonHomNay: 45,
    giaTriTrungBinh: 125000,
    khachHangMoi: 8,
    tyLeTraHang: 2.3
  };

  const sanPhamBanChay = [
    { id: 1, tenSanPham: 'Cà phê đen', soLuongBan: 234, doanhThu: 5850000, tyLe: 15.2 },
    { id: 2, tenSanPham: 'Trà sữa trân châu', soLuongBan: 189, doanhThu: 6615000, tyLe: 17.1 },
    { id: 3, tenSanPham: 'Bánh mì thịt nướng', soLuongBan: 156, doanhThu: 3120000, tyLe: 8.1 },
    { id: 4, tenSanPham: 'Cà phê sữa', soLuongBan: 143, doanhThu: 4290000, tyLe: 11.1 },
    { id: 5, tenSanPham: 'Bánh ngọt chocolate', soLuongBan: 98, doanhThu: 4410000, tyLe: 11.4 }
  ];

  const doanhThuTheoNgay = [
    { ngay: '2024-12-16', doanhThu: 2200000, soHoaDon: 42 },
    { ngay: '2024-12-17', doanhThu: 2800000, soHoaDon: 51 },
    { ngay: '2024-12-18', doanhThu: 1950000, soHoaDon: 38 },
    { ngay: '2024-12-19', doanhThu: 2650000, soHoaDon: 48 },
    { ngay: '2024-12-20', doanhThu: 2500000, soHoaDon: 45 }
  ];

  const nhanVienBanHang = [
    { id: 1, tenNhanVien: 'Nguyễn Văn A', soHoaDon: 89, doanhThu: 12500000, hoa: 375000 },
    { id: 2, tenNhanVien: 'Trần Thị B', soHoaDon: 76, doanhThu: 9800000, hoa: 294000 },
    { id: 3, tenNhanVien: 'Lê Văn C', soHoaDon: 92, doanhThu: 13200000, hoa: 396000 },
    { id: 4, tenNhanVien: 'Phạm Thị D', soHoaDon: 65, doanhThu: 8100000, hoa: 243000 }
  ];

  const cotSanPhamBanChay = [
    {
      title: 'STT',
      dataIndex: 'id',
      key: 'id',
      width: 60,
      render: (_, __, index) => index + 1
    },
    {
      title: 'Tên sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
      width: 200,
    },
    {
      title: 'Số lượng bán',
      dataIndex: 'soLuongBan',
      key: 'soLuongBan',
      width: 120,
      render: (soLuong) => new Intl.NumberFormat('vi-VN').format(soLuong)
    },
    {
      title: 'Doanh thu',
      dataIndex: 'doanhThu',
      key: 'doanhThu',
      width: 150,
      render: (doanhThu) => new Intl.NumberFormat('vi-VN').format(doanhThu) + ' đ'
    },
    {
      title: 'Tỷ lệ',
      dataIndex: 'tyLe',
      key: 'tyLe',
      width: 120,
      render: (tyLe) => (
        <div>
          <Progress percent={tyLe} size="small" />
          <span style={{ fontSize: '12px' }}>{tyLe}%</span>
        </div>
      )
    }
  ];

  const cotDoanhThuTheoNgay = [
    {
      title: 'Ngày',
      dataIndex: 'ngay',
      key: 'ngay',
      width: 120,
      render: (ngay) => dayjs(ngay).format('DD/MM/YYYY')
    },
    {
      title: 'Doanh thu',
      dataIndex: 'doanhThu',
      key: 'doanhThu',
      width: 150,
      render: (doanhThu) => new Intl.NumberFormat('vi-VN').format(doanhThu) + ' đ'
    },
    {
      title: 'Số hóa đơn',
      dataIndex: 'soHoaDon',
      key: 'soHoaDon',
      width: 120,
      render: (soHoaDon) => new Intl.NumberFormat('vi-VN').format(soHoaDon)
    },
    {
      title: 'TB/Hóa đơn',
      key: 'trungBinh',
      width: 150,
      render: (_, record) => {
        const trungBinh = record.doanhThu / record.soHoaDon;
        return new Intl.NumberFormat('vi-VN').format(trungBinh) + ' đ';
      }
    }
  ];

  const cotNhanVien = [
    {
      title: 'STT',
      dataIndex: 'id',
      key: 'id',
      width: 60,
      render: (_, __, index) => index + 1
    },
    {
      title: 'Tên nhân viên',
      dataIndex: 'tenNhanVien',
      key: 'tenNhanVien',
      width: 150,
    },
    {
      title: 'Số hóa đơn',
      dataIndex: 'soHoaDon',
      key: 'soHoaDon',
      width: 120,
      render: (soHoaDon) => new Intl.NumberFormat('vi-VN').format(soHoaDon)
    },
    {
      title: 'Doanh thu',
      dataIndex: 'doanhThu',
      key: 'doanhThu',
      width: 150,
      render: (doanhThu) => new Intl.NumberFormat('vi-VN').format(doanhThu) + ' đ'
    },
    {
      title: 'Hoa hồng',
      dataIndex: 'hoa',
      key: 'hoa',
      width: 120,
      render: (hoa) => new Intl.NumberFormat('vi-VN').format(hoa) + ' đ'
    }
  ];

  const xuatBaoCao = () => {
    // Logic xuất báo cáo
    console.log('Xuất báo cáo từ', tuNgay.format('DD/MM/YYYY'), 'đến', denNgay.format('DD/MM/YYYY'));
  };

  return (
    <div style={{ padding: 24 }}>
      {/* Bộ lọc */}
      <Card style={{ marginBottom: 24 }}>
        <Row gutter={16} align="middle">
          <Col span={8}>
            <RangePicker
              value={[tuNgay, denNgay]}
              onChange={(dates) => {
                setTuNgay(dates[0]);
                setDenNgay(dates[1]);
              }}
              format="DD/MM/YYYY"
              style={{ width: '100%' }}
            />
          </Col>
          <Col span={6}>
            <Select
              value={loaiBaoCao}
              onChange={setLoaiBaoCao}
              style={{ width: '100%' }}
            >
              <Option value="doanh_thu">Báo cáo doanh thu</Option>
              <Option value="san_pham">Báo cáo sản phẩm</Option>
              <Option value="nhan_vien">Báo cáo nhân viên</Option>
              <Option value="khach_hang">Báo cáo khách hàng</Option>
            </Select>
          </Col>
          <Col span={6}>
            <Space>
              <Button type="primary" icon={<BarChartOutlined />}>
                Xem báo cáo
              </Button>
              <Button icon={<FileTextOutlined />} onClick={xuatBaoCao}>
                Xuất Excel
              </Button>
            </Space>
          </Col>
        </Row>
      </Card>

      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: 24 }}>
        <Col span={6}>
          <Card>
            <Statistic
              title="Doanh thu hôm nay"
              value={thongKeDoanhThu.doanhThuHomNay}
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              prefix={<DollarOutlined />}
              valueStyle={{ color: '#3f8600' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Doanh thu tháng này"
              value={thongKeDoanhThu.doanhThuThangNay}
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              prefix={<RiseOutlined />}
              suffix={
                <span style={{ fontSize: '14px', color: '#3f8600' }}>
                  ↑{thongKeDoanhThu.tangTruong}%
                </span>
              }
              valueStyle={{ color: '#1890ff' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Số hóa đơn hôm nay"
              value={thongKeDoanhThu.soHoaDonHomNay}
              prefix={<ShoppingCartOutlined />}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Khách hàng mới"
              value={thongKeDoanhThu.khachHangMoi}
              prefix={<UserOutlined />}
              valueStyle={{ color: '#722ed1' }}
            />
          </Card>
        </Col>
      </Row>

      <Row gutter={16} style={{ marginBottom: 24 }}>
        <Col span={6}>
          <Card>
            <Statistic
              title="Giá trị TB/Hóa đơn"
              value={thongKeDoanhThu.giaTriTrungBinh}
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              prefix={<TrophyOutlined />}
              valueStyle={{ color: '#fa541c' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Tỷ lệ trả hàng"
              value={thongKeDoanhThu.tyLeTraHang}
              suffix="%"
              prefix={<FallOutlined />}
              valueStyle={{ color: '#cf1322' }}
            />
          </Card>
        </Col>
        <Col span={12}>
          <Card title="So sánh doanh thu">
            <Row gutter={16}>
              <Col span={12}>
                <Statistic
                  title="Tháng trước"
                  value={thongKeDoanhThu.doanhThuThangTruoc}
                  formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
                  valueStyle={{ color: '#8c8c8c' }}
                />
              </Col>
              <Col span={12}>
                <Statistic
                  title="Tháng này"
                  value={thongKeDoanhThu.doanhThuThangNay}
                  formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
                  valueStyle={{ color: '#3f8600' }}
                />
              </Col>
            </Row>
            <Progress 
              percent={thongKeDoanhThu.tangTruong} 
              status="active" 
              style={{ marginTop: 16 }}
            />
          </Card>
        </Col>
      </Row>

      {/* Bảng chi tiết */}
      <Row gutter={16}>
        <Col span={12}>
          <Card title="Top sản phẩm bán chạy" className="bao-cao-san-pham">
            <Table
              columns={cotSanPhamBanChay}
              dataSource={sanPhamBanChay}
              rowKey="id"
              pagination={false}
              size="small"
            />
          </Card>
        </Col>
        <Col span={12}>
          <Card title="Doanh thu theo ngày" className="bao-cao-doanh-thu">
            <Table
              columns={cotDoanhThuTheoNgay}
              dataSource={doanhThuTheoNgay}
              rowKey="ngay"
              pagination={false}
              size="small"
            />
          </Card>
        </Col>
      </Row>

      <Row gutter={16} style={{ marginTop: 16 }}>
        <Col span={24}>
          <Card title="Hiệu suất nhân viên bán hàng" className="bao-cao-nhan-vien">
            <Table
              columns={cotNhanVien}
              dataSource={nhanVienBanHang}
              rowKey="id"
              pagination={false}
              size="small"
            />
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default BaoCaoThongKe;
