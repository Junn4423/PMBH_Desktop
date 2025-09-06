import React, { useState } from 'react';
import { Form, Input, Button, Card, Typography, Space, message } from 'antd';
import { UserOutlined, LockOutlined } from '@ant-design/icons';
import { useAuth } from '../../contexts/AuthContext';

const { Title, Text } = Typography;

const FormDangNhap = () => {
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
    <Card className="form-dang-nhap" style={{ maxWidth: 400, margin: '0 auto' }}>
      <Space direction="vertical" align="center" style={{ width: '100%', marginBottom: 24 }}>
        <Title level={3}>Đăng nhập hệ thống</Title>
        <Text type="secondary">Nhập thông tin để truy cập</Text>
      </Space>

      <Form
        name="dangNhap"
        onFinish={onFinish}
        layout="vertical"
        size="large"
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
          />
        </Form.Item>

        <Form.Item>
          <Button
            type="primary"
            htmlType="submit"
            loading={loading}
            block
          >
            Đăng nhập
          </Button>
        </Form.Item>

        <div style={{ textAlign: 'center' }}>
          <Text type="secondary" style={{ fontSize: '12px' }}>
            Demo: admin / 123456
          </Text>
        </div>
      </Form>
    </Card>
  );
};

export default FormDangNhap;
