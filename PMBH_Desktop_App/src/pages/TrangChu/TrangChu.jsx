import React, { useState, useEffect } from 'react';
import { Row, Col, Card, Statistic, Typography, List, Avatar, Tag, Space } from 'antd';
import {
  DollarOutlined,
  ShoppingCartOutlined,
  UserOutlined,
  CoffeeOutlined,
  TrophyOutlined,
  ClockCircleOutlined
} from '@ant-design/icons';
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, LineChart, Line } from 'recharts';
import './TrangChu.css';

const { Title, Text } = Typography;

const TrangChu = () => {
  const [statistics, setStatistics] = useState({
    doanhThuHômnay: 2450000,
    donHangHômnay: 45,
    khachHangMoi: 12,
    monBanChay: 28
  });

  const [recentOrders, setRecentOrders] = useState([
    {
      id: 1,
      ban: 'Bàn 5',
      khachHang: 'Nguyễn Văn A',
      tongTien: 150000,
      thoiGian: '10:30',
      trangThai: 'completed'
    },
    {
      id: 2,
      ban: 'Bàn 12',
      khachHang: 'Trần Thị B',
      tongTien: 280000,
      thoiGian: '10:15',
      trangThai: 'pending'
    },
    {
      id: 3,
      ban: 'Bàn 3',
      khachHang: 'Lê Văn C',
      tongTien: 95000,
      thoiGian: '09:45',
      trangThai: 'completed'
    }
  ]);

  const [topProducts, setTopProducts] = useState([
    { name: 'Cà phê đen', soLuong: 45, doanhThu: 450000 },
    { name: 'Cà phê sữa', soLuong: 38, doanhThu: 570000 },
    { name: 'Trà sữa', soLuong: 32, doanhThu: 480000 },
    { name: 'Bánh ngọt', soLuong: 28, doanhThu: 420000 },
    { name: 'Nước ép', soLuong: 25, doanhThu: 375000 }
  ]);

  const salesData = [
    { name: 'T2', doanhThu: 2400 },
    { name: 'T3', doanhThu: 1398 },
    { name: 'T4', doanhThu: 9800 },
    { name: 'T5', doanhThu: 3908 },
    { name: 'T6', doanhThu: 4800 },
    { name: 'T7', doanhThu: 3800 },
    { name: 'CN', doanhThu: 4300 }
  ];

  const getStatusColor = (status) => {
    switch (status) {
      case 'completed':
        return 'success';
      case 'pending':
        return 'processing';
      case 'cancelled':
        return 'error';
      default:
        return 'default';
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'completed':
        return 'Hoàn thành';
      case 'pending':
        return 'Đang xử lý';
      case 'cancelled':
        return 'Đã hủy';
      default:
        return 'Không xác định';
    }
  };

  return (
    <div className="trang-chu">
      <div className="page-header">
        <Title level={2}>Trang chủ</Title>
        <Text type="secondary">
          Chào mừng bạn quay trở lại! Đây là tổng quan hoạt động hôm nay.
        </Text>
      </div>

      {/* Thống kê tổng quan */}
      <Row gutter={[16, 16]} className="statistics-row">
        <Col xs={24} sm={12} lg={6}>
          <Card>
            <Statistic
              title="Doanh thu hôm nay"
              value={statistics.doanhThuHômnay}
              precision={0}
              valueStyle={{ color: '#3f8600' }}
              prefix={<DollarOutlined />}
              suffix="đ"
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} lg={6}>
          <Card>
            <Statistic
              title="Đơn hàng hôm nay"
              value={statistics.donHangHômnay}
              valueStyle={{ color: '#1890ff' }}
              prefix={<ShoppingCartOutlined />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} lg={6}>
          <Card>
            <Statistic
              title="Khách hàng mới"
              value={statistics.khachHangMoi}
              valueStyle={{ color: '#722ed1' }}
              prefix={<UserOutlined />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} lg={6}>
          <Card>
            <Statistic
              title="Món bán chạy"
              value={statistics.monBanChay}
              valueStyle={{ color: '#fa8c16' }}
              prefix={<CoffeeOutlined />}
            />
          </Card>
        </Col>
      </Row>

      <Row gutter={[16, 16]} className="content-row">
        {/* Biểu đồ doanh thu */}
        <Col xs={24} lg={16}>
          <Card title="Doanh thu 7 ngày qua" className="chart-card">
            <ResponsiveContainer width="100%" height={300}>
              <BarChart data={salesData}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="name" />
                <YAxis />
                <Tooltip formatter={(value) => [`${value}k đ`, 'Doanh thu']} />
                <Bar dataKey="doanhThu" fill="#1890ff" />
              </BarChart>
            </ResponsiveContainer>
          </Card>
        </Col>

        {/* Đơn hàng gần đây */}
        <Col xs={24} lg={8}>
          <Card title="Đơn hàng gần đây" className="recent-orders-card">
            <List
              dataSource={recentOrders}
              renderItem={(item) => (
                <List.Item>
                  <List.Item.Meta
                    avatar={<Avatar icon={<ClockCircleOutlined />} />}
                    title={
                      <Space>
                        <Text strong>{item.ban}</Text>
                        <Tag color={getStatusColor(item.trangThai)}>
                          {getStatusText(item.trangThai)}
                        </Tag>
                      </Space>
                    }
                    description={
                      <div>
                        <div>{item.khachHang}</div>
                        <div>
                          <Text strong>{item.tongTien.toLocaleString()}đ</Text>
                          <Text type="secondary" style={{ marginLeft: 8 }}>
                            {item.thoiGian}
                          </Text>
                        </div>
                      </div>
                    }
                  />
                </List.Item>
              )}
            />
          </Card>
        </Col>
      </Row>

      {/* Món bán chạy */}
      <Row gutter={[16, 16]} className="content-row">
        <Col xs={24}>
          <Card title="Top món bán chạy hôm nay" className="top-products-card">
            <Row gutter={[16, 16]}>
              {topProducts.map((product, index) => (
                <Col xs={24} sm={12} md={8} lg={4.8} key={index}>
                  <Card size="small" className="product-card">
                    <div className="product-rank">
                      <TrophyOutlined style={{ 
                        color: index === 0 ? '#faad14' : index === 1 ? '#d9d9d9' : '#faad14',
                        fontSize: '16px'
                      }} />
                      <Text strong style={{ marginLeft: 4 }}>#{index + 1}</Text>
                    </div>
                    <div className="product-info">
                      <Text strong>{product.name}</Text>
                      <div className="product-stats">
                        <Text type="secondary">Số lượng: {product.soLuong}</Text>
                        <br />
                        <Text type="secondary">Doanh thu: {product.doanhThu.toLocaleString()}đ</Text>
                      </div>
                    </div>
                  </Card>
                </Col>
              ))}
            </Row>
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default TrangChu;
