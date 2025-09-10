import React from 'react';
import { Card, Typography } from 'antd';
import { ChefHat } from 'lucide-react';

const { Title, Text } = Typography;

const BepBar = () => {
  return (
    <div style={{ padding: '24px' }}>
      <Card>
        <div style={{ textAlign: 'center', padding: '40px' }}>
          <ChefHat size={64} style={{ color: '#77d4fb', marginBottom: '16px' }} />
          <Title level={2} style={{ color: '#197dd3' }}>
            Bếp/Bar
          </Title>
          <Text type="secondary">
            Trang quản lý bếp và bar cần gói premium để sử dụng
          </Text>
        </div>
      </Card>
    </div>
  );
};

export default BepBar;
