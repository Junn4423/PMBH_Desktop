import React from 'react';
import { Card, Typography, Breadcrumb } from 'antd';
import { ClipboardCheck } from 'lucide-react';

const { Title } = Typography;

const KiemKho = () => {
  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Quản lí kho</Breadcrumb.Item>
        <Breadcrumb.Item>Kiểm kho</Breadcrumb.Item>
      </Breadcrumb>
      
      <Card>
        <div style={{ textAlign: 'center', padding: '40px 20px' }}>
          <ClipboardCheck size={64} style={{ color: '#197dd3', marginBottom: 16 }} />
          <Title level={3}>Kiểm kho</Title>
          <p style={{ color: '#bdbcc4', fontSize: '16px' }}>
            Tính năng kiểm kho đang được phát triển...
          </p>
        </div>
      </Card>
    </div>
  );
};

export default KiemKho;
