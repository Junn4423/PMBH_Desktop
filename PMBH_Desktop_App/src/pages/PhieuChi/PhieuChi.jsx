import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { Receipt } from 'lucide-react';

const { Title } = Typography;

const PhieuChi = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Kế toán</Breadcrumb.Item>
        <Breadcrumb.Item>Phiếu chi</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <Receipt size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Quản lý phiếu chi</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng quản lý phiếu chi đang được phát triển...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default PhieuChi;
