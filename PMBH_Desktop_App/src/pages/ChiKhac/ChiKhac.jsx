import React from 'react';
import { Card, Typography } from 'antd';
import { DollarSign } from 'lucide-react';

const { Title, Text } = Typography;

const ChiKhac = () => {
  return (
    <div style={{ padding: '24px' }}>
      <Card>
        <div style={{ textAlign: 'center', padding: '40px' }}>
          <DollarSign size={64} style={{ color: '#77d4fb', marginBottom: '16px' }} />
          <Title level={2} style={{ color: '#197dd3' }}>
            Chi khác
          </Title>
          <Text type="secondary">
            Trang quản lý chi phí khác cần gói premium để sử dụng
          </Text>
        </div>
      </Card>
    </div>
  );
};

export default ChiKhac;
