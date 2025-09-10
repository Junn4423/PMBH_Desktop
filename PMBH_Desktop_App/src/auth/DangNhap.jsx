import React, { useState } from 'react';
import { 
  Card, Form, Input, Button, Checkbox, Alert, 
  Row, Col, Typography, Space, message 
} from 'antd';
import { 
  User, 
  Lock, 
  Shield,
  LogIn 
} from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import '../styles/pages/DangNhap.css';

const { Title, Text } = Typography;

const DangNhap = () => {
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const [showError, setShowError] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');
  const { login: authLogin } = useAuth();

  const xuLyDangNhap = async (values) => {
    setLoading(true);
    setShowError(false);
    setErrorMessage('');

    try {
      const { tenDangNhap, matKhau, ghi_nho } = values;
      
      // Call auth login
      const result = await authLogin(tenDangNhap, matKhau);

      if (result.success) {
        // Clear any previous errors
        setShowError(false);
        setErrorMessage('');
        
        // Save login info if remember is checked
        if (ghi_nho) {
          localStorage.setItem('remembered_user', tenDangNhap);
        } else {
          localStorage.removeItem('remembered_user');
        }

        message.success(`Đăng nhập thành công! Chào mừng bạn!`);
        
        // Login successful, AuthContext will handle the redirect
        // by changing isAuthenticated to true
      } else {
        setShowError(true);
        setErrorMessage(result.message || 'Tên đăng nhập hoặc mật khẩu không đúng');
        message.error(result.message || 'Tên đăng nhập hoặc mật khẩu không đúng');
      }
    } catch (error) {
      console.error('Lỗi đăng nhập:', error);
      setShowError(true);
      setErrorMessage(error.message || 'Có lỗi xảy ra khi đăng nhập');
      message.error(error.message || 'Có lỗi xảy ra khi đăng nhập');
    } finally {
      setLoading(false);
    }
  };

  React.useEffect(() => {
    // Load remembered username
    const rememberedUser = localStorage.getItem('remembered_user');
    if (rememberedUser) {
      form.setFieldsValue({
        tenDangNhap: rememberedUser,
        ghi_nho: true
      });
    }
  }, [form]);

  return (
    <div className="login-container">
      <div className="login-content">
        <Card className="login-card" styles={{ body: { padding: '50px 40px' } }}>
          <div className="login-header">
            <div className="login-logo">
              <Shield size={36} />
            </div>
            <Title level={2} className="login-title">
              Café POS System
            </Title>
            <Text className="login-subtitle">
              Hệ thống quản lý quán cà phê
            </Text>
          </div>

          {showError && (
            <Alert
              message="Đăng nhập thất bại"
              description={errorMessage || "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại."}
              type="error"
              showIcon
              className="login-error-alert"
            />
          )}

          <Form
            form={form}
            name="login"
            onFinish={xuLyDangNhap}
            layout="vertical"
            size="large"
          >
            <Form.Item
              name="tenDangNhap"
              label="Tên đăng nhập"
              rules={[
                { required: true, message: 'Vui lòng nhập tên đăng nhập!' }
              ]}
              className="login-form-item"
            >
              <Input
                prefix={<User size={16} className="login-input-prefix" />}
                placeholder="Nhập tên đăng nhập"
                autoComplete="username"
              />
            </Form.Item>

            <Form.Item
              name="matKhau"
              label="Mật khẩu"
              rules={[
                { required: true, message: 'Vui lòng nhập mật khẩu!' }
              ]}
              className="login-form-item"
            >
              <Input.Password
                prefix={<Lock size={16} className="login-input-prefix" />}
                placeholder="Nhập mật khẩu"
                autoComplete="current-password"
              />
            </Form.Item>

            <Form.Item className="login-form-item">
              <Form.Item name="ghi_nho" valuePropName="checked" noStyle>
                <Checkbox className="login-checkbox">Ghi nhớ đăng nhập</Checkbox>
              </Form.Item>
            </Form.Item>

            <Form.Item className="login-form-item">
              <Button
                type="primary"
                htmlType="submit"
                loading={loading}
                block
                icon={<LogIn size={16} />}
                className={`login-button ${loading ? 'login-loading' : ''}`}
              >
                Đăng nhập
              </Button>
            </Form.Item>
          </Form>

          <div className="login-footer">
            <Text className="login-footer-text">
              Phiên bản 1.0.0 | © 2024 Café POS System
            </Text>
          </div>
        </Card>
      </div>
    </div>
  );
}
export default DangNhap;
