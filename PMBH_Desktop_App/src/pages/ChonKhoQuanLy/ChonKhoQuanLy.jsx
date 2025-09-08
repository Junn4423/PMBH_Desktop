import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { Package } from 'lucide-react';

const { Title } = Typography;

const ChonKhoQuanLy = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Mục chung</Breadcrumb.Item>
        <Breadcrumb.Item>Bảng điều khiển người dùng</Breadcrumb.Item>
        <Breadcrumb.Item>Chọn kho quản lý</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <Package size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Màn hình Chọn kho quản lý đang được phát triển</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng này sẽ sớm có mặt trong phiên bản tiếp theo...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default ChonKhoQuanLy;
