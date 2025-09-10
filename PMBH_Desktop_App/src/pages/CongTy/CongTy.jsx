import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { Building2 } from 'lucide-react';

const { Title } = Typography;

const CongTy = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Mục chung</Breadcrumb.Item>
        <Breadcrumb.Item>Công ty</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <Building2 size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Thông tin công ty</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng quản lý thông tin công ty cần gói premium để sử dụng...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default CongTy;
