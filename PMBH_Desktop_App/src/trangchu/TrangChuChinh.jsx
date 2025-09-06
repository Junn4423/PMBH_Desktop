import React, { useState, useEffect } from 'react';
import { Row, Col, Card, Statistic, Table, Button, Space, Tag } from 'antd';
import {
  ShoppingCartOutlined,
  DollarOutlined,
  UserOutlined,
  AreaChartOutlined,
  EyeOutlined,
  EditOutlined
} from '@ant-design/icons';

const TrangChuChinh = () => {
  const [thongKeTongQuan, setThongKeTongQuan] = useState({
    doanhThuHomNay: 0,
    soDonHang: 0,
    soKhachHang: 0,
    sanPhamBanChay: 0
  });

  const [donHangGanDay, setDonHangGanDay] = useState([]);

  useEffect(() => {
    taiThongKe();
    taiDonHangGanDay();
  }, []);

  const taiThongKe = async () => {
    try {
      // Gọi API lấy thống kê tổng quan
      // const response = await api.get('/thong-ke/tong-quan');
      // setThongKeTongQuan(response.data);
      
      // Demo data
      setThongKeTongQuan({
        doanhThuHomNay: 2450000,
        soDonHang: 28,
        soKhachHang: 15,
        sanPhamBanChay: 12
      });
    } catch (error) {
      console.error('Lỗi tải thống kê:', error);
    }
  };

  const taiDonHangGanDay = async () => {
    try {
      // Demo data
      setDonHangGanDay([
        {
          key: '1',
          maDon: 'HD001',
          tenKhach: 'Nguyễn Văn A',
          soMon: 3,
          tongTien: 125000,
          trangThai: 'hoan_thanh',
          thoiGian: '10:30'
        },
        {
          key: '2', 
          maDon: 'HD002',
          tenKhach: 'Trần Thị B',
          soMon: 2,
          tongTien: 85000,
          trangThai: 'dang_xu_ly',
          thoiGian: '11:15'
        }
      ]);
    } catch (error) {
      console.error('Lỗi tải đơn hàng:', error);
    }
  };

  const cotBangDonHang = [
    {
      title: 'Mã đơn',
      dataIndex: 'maDon',
      key: 'maDon',
    },
    {
      title: 'Tên khách',
      dataIndex: 'tenKhach', 
      key: 'tenKhach',
    },
    {
      title: 'Số món',
      dataIndex: 'soMon',
      key: 'soMon',
    },
    {
      title: 'Tổng tiền',
      dataIndex: 'tongTien',
      key: 'tongTien',
      render: (text) => `${text.toLocaleString()}đ`
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: (trangThai) => {
        const mauTrang = {
          'hoan_thanh': 'green',
          'dang_xu_ly': 'blue',
          'huy': 'red'
        };
        const nhanTrang = {
          'hoan_thanh': 'Hoàn thành',
          'dang_xu_ly': 'Đang xử lý', 
          'huy': 'Đã hủy'
        };
        return <Tag color={mauTrang[trangThai]}>{nhanTrang[trangThai]}</Tag>;
      }
    },
    {
      title: 'Thời gian',
      dataIndex: 'thoiGian',
      key: 'thoiGian',
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      render: (_, record) => (
        <Space size="middle">
          <Button type="link" icon={<EyeOutlined />} size="small">
            Xem
          </Button>
          <Button type="link" icon={<EditOutlined />} size="small">
            Sửa
          </Button>
        </Space>
      ),
    },
  ];

  return (
    <div style={{ padding: '24px' }}>
      <h2>Trang chủ - Tổng quan hệ thống</h2>
      
      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: '24px' }}>
        <Col span={6}>
          <Card>
            <Statistic
              title="Doanh thu hôm nay"
              value={thongKeTongQuan.doanhThuHomNay}
              precision={0}
              valueStyle={{ color: '#3f8600' }}
              prefix={<DollarOutlined />}
              suffix="đ"
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Số đơn hàng"
              value={thongKeTongQuan.soDonHang}
              prefix={<ShoppingCartOutlined />}
              valueStyle={{ color: '#1890ff' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Số khách hàng"
              value={thongKeTongQuan.soKhachHang}
              prefix={<UserOutlined />}
              valueStyle={{ color: '#722ed1' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Sản phẩm bán chạy"
              value={thongKeTongQuan.sanPhamBanChay}
              prefix={<AreaChartOutlined />}
              valueStyle={{ color: '#eb2f96' }}
            />
          </Card>
        </Col>
      </Row>

      {/* Đơn hàng gần đây */}
      <Card title="Đơn hàng gần đây" style={{ marginBottom: '24px' }}>
        <Table
          columns={cotBangDonHang}
          dataSource={donHangGanDay}
          pagination={false}
          size="small"
        />
      </Card>

      {/* Thông tin nhanh */}
      <Row gutter={16}>
        <Col span={12}>
          <Card title="Trạng thái bàn" size="small">
            <p>Tổng số bàn: 20</p>
            <p>Bàn đang sử dụng: 8</p>
            <p>Bàn trống: 12</p>
          </Card>
        </Col>
        <Col span={12}>
          <Card title="Nhân viên trực" size="small">
            <p>Thu ngân: Nguyễn Văn A</p>
            <p>Pha chế: Trần Thị B</p>
            <p>Phục vụ: Lê Văn C</p>
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default TrangChuChinh;
