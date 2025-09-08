import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { UserCheck } from 'lucide-react';

const { Title } = Typography;

const NguoiDangKy = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Kinh doanh</Breadcrumb.Item>
        <Breadcrumb.Item>Quản lý bán nhà hàng</Breadcrumb.Item>
        <Breadcrumb.Item>Người đăng ký</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <UserCheck size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Màn hình Người đăng ký đang được phát triển</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng này sẽ sớm có mặt trong phiên bản tiếp theo...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default NguoiDangKy;
