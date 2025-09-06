import React, { useState } from 'react';
import { Card, Form, Input, Button, Typography, message, Space } from 'antd';
import { UserOutlined, LockOutlined, CoffeeOutlined } from '@ant-design/icons';
import { useAuth } from '../../contexts/AuthContext';
import './DangNhap.css';

const { Title, Text } = Typography;

const DangNhap = () => {
  const [loading, setLoading] = useState(false);
  const { login } = useAuth();

  const onFinish = async (values) => {
    setLoading(true);
    try {
      const result = await login(values.taiKhoan, values.matKhau);
      if (result.success) {
        message.success('Đăng nhập thành công!');
      } else {
        message.error(result.message);
      }
    } catch (error) {
      message.error('Đã xảy ra lỗi khi đăng nhập');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="login-container">
      <div className="login-background">
        <div className="coffee-overlay"></div>
      </div>
      
      <Card className="login-card">
        <div className="login-header">
          <Space direction="vertical" align="center" size="small">
            <CoffeeOutlined className="login-icon" />
            <Title level={2} className="login-title">
              PMBH Cafe POS
            </Title>
            <Text type="secondary">
              Hệ thống quản lý quán cafe
            </Text>
          </Space>
        </div>

        <Form
          name="login"
          onFinish={onFinish}
          layout="vertical"
          size="large"
          className="login-form"
        >
          <Form.Item
            name="taiKhoan"
            label="Tài khoản"
            rules={[
              {
                required: true,
                message: 'Vui lòng nhập tài khoản!',
              },
            ]}
          >
            <Input
              prefix={<UserOutlined />}
              placeholder="Nhập tài khoản"
              autoComplete="username"
            />
          </Form.Item>

          <Form.Item
            name="matKhau"
            label="Mật khẩu"
            rules={[
              {
                required: true,
                message: 'Vui lòng nhập mật khẩu!',
              },
            ]}
          >
            <Input.Password
              prefix={<LockOutlined />}
              placeholder="Nhập mật khẩu"
              autoComplete="current-password"
            />
          </Form.Item>

          <Form.Item>
            <Button
              type="primary"
              htmlType="submit"
              loading={loading}
              block
              className="login-button"
            >
              Đăng nhập
            </Button>
          </Form.Item>

          <div className="login-demo">
            <Text type="secondary" style={{ fontSize: '12px' }}>
              Demo: admin / 123456
            </Text>
          </div>
        </Form>
      </Card>
    </div>
  );
};

export default DangNhap;
