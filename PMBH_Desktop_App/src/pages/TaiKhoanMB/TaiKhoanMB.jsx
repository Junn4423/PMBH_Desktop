import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { User } from 'lucide-react';

const { Title } = Typography;

const TaiKhoanMB = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Mục chung</Breadcrumb.Item>
        <Breadcrumb.Item>Giao diện MB</Breadcrumb.Item>
        <Breadcrumb.Item>Tài khoản</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <User size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Màn hình Tài khoản cần gói premium để sử dụng</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng này sẽ sớm có mặt trong phiên bản tiếp theo...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default TaiKhoanMB;
