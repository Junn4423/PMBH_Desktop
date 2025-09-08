import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { Users } from 'lucide-react';

const { Title } = Typography;

const BangDieuKhienNguoiDung = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Mục chung</Breadcrumb.Item>
        <Breadcrumb.Item>Bảng điều khiển người dùng</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <Users size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Bảng điều khiển người dùng</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng quản lý người dùng đang được phát triển...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default BangDieuKhienNguoiDung;
