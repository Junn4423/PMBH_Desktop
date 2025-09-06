import React, { useState } from 'react';
import { 
  Card, Form, Input, Button, Checkbox, Alert, 
  Row, Col, Typography, Space, message 
} from 'antd';
import { 
  UserOutlined, 
  LockOutlined, 
  SafetyOutlined,
  LoginOutlined 
} from '@ant-design/icons';

const { Title, Text } = Typography;

const DangNhap = ({ onLogin }) => {
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const [showError, setShowError] = useState(false);

  // Demo accounts
  const taiKhoanDemo = [
    { tenDangNhap: 'admin', matKhau: 'admin123', vaiTro: 'Quản lý' },
    { tenDangNhap: 'thungan', matKhau: 'thungan123', vaiTro: 'Thu ngân' },
    { tenDangNhap: 'phache', matKhau: 'phache123', vaiTro: 'Pha chế' }
  ];

  const xuLyDangNhap = async (values) => {
    setLoading(true);
    setShowError(false);

    try {
      // Simulate API call delay
      await new Promise(resolve => setTimeout(resolve, 1000));

      const { tenDangNhap, matKhau, ghi_nho } = values;
      
      // Check demo accounts
      const taiKhoan = taiKhoanDemo.find(
        tk => tk.tenDangNhap === tenDangNhap && tk.matKhau === matKhau
      );

      if (taiKhoan) {
        // Save login info if remember is checked
        if (ghi_nho) {
          localStorage.setItem('remembered_user', tenDangNhap);
        } else {
          localStorage.removeItem('remembered_user');
        }

        // Save user session
        const thongTinNguoiDung = {
          tenDangNhap: taiKhoan.tenDangNhap,
          vaiTro: taiKhoan.vaiTro,
          thoiGianDangNhap: new Date().toISOString()
        };
        
        localStorage.setItem('user_session', JSON.stringify(thongTinNguoiDung));
        
        message.success(`Chào mừng ${taiKhoan.vaiTro} ${taiKhoan.tenDangNhap}!`);
        
        // Call parent login handler
        if (onLogin) {
          onLogin(thongTinNguoiDung);
        }
      } else {
        setShowError(true);
        message.error('Tên đăng nhập hoặc mật khẩu không đúng');
      }
    } catch (error) {
      console.error('Lỗi đăng nhập:', error);
      message.error('Có lỗi xảy ra khi đăng nhập');
    } finally {
      setLoading(false);
    }
  };

  const dienTaiKhoanDemo = (taiKhoan) => {
    form.setFieldsValue({
      tenDangNhap: taiKhoan.tenDangNhap,
      matKhau: taiKhoan.matKhau
    });
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
    <div style={{
      minHeight: '100vh',
      background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      padding: '20px'
    }}>
      <div style={{ width: '100%', maxWidth: '1000px' }}>
        <Row gutter={24} align="middle">
          {/* Left side - Login form */}
          <Col xs={24} md={12}>
            <Card
              style={{
                borderRadius: '12px',
                boxShadow: '0 20px 40px rgba(0,0,0,0.1)',
                border: 'none'
              }}
              bodyStyle={{ padding: '40px' }}
            >
              <div style={{ textAlign: 'center', marginBottom: '32px' }}>
                <div style={{
                  width: '80px',
                  height: '80px',
                  backgroundColor: '#1890ff',
                  borderRadius: '50%',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  margin: '0 auto 16px',
                  fontSize: '32px',
                  color: 'white'
                }}>
                  <SafetyOutlined />
                </div>
                <Title level={2} style={{ margin: 0, color: '#1890ff' }}>
                  Café POS System
                </Title>
                <Text type="secondary">
                  Hệ thống quản lý quán cà phê
                </Text>
              </div>

              {showError && (
                <Alert
                  message="Đăng nhập thất bại"
                  description="Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại."
                  type="error"
                  showIcon
                  style={{ marginBottom: '24px' }}
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
                >
                  <Input
                    prefix={<UserOutlined />}
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
                >
                  <Input.Password
                    prefix={<LockOutlined />}
                    placeholder="Nhập mật khẩu"
                    autoComplete="current-password"
                  />
                </Form.Item>

                <Form.Item>
                  <Form.Item name="ghi_nho" valuePropName="checked" noStyle>
                    <Checkbox>Ghi nhớ đăng nhập</Checkbox>
                  </Form.Item>
                </Form.Item>

                <Form.Item>
                  <Button
                    type="primary"
                    htmlType="submit"
                    loading={loading}
                    block
                    icon={<LoginOutlined />}
                    style={{ height: '48px', borderRadius: '8px' }}
                  >
                    Đăng nhập
                  </Button>
                </Form.Item>
              </Form>

              <div style={{ textAlign: 'center', marginTop: '24px' }}>
                <Text type="secondary" style={{ fontSize: '12px' }}>
                  Phiên bản 1.0.0 | © 2024 Café POS System
                </Text>
              </div>
            </Card>
          </Col>

          {/* Right side - Demo accounts */}
          <Col xs={24} md={12}>
            <Card
              title={
                <Space>
                  <UserOutlined />
                  Tài khoản demo
                </Space>
              }
              style={{
                borderRadius: '12px',
                backgroundColor: 'rgba(255,255,255,0.95)',
                border: 'none'
              }}
              headStyle={{
                borderBottom: '1px solid #f0f0f0',
                fontSize: '16px'
              }}
            >
              <Space direction="vertical" style={{ width: '100%' }} size="middle">
                <Alert
                  message="Thông tin đăng nhập demo"
                  description="Sử dụng các tài khoản dưới đây để trải nghiệm hệ thống"
                  type="info"
                  showIcon
                />

                {taiKhoanDemo.map((taiKhoan, index) => (
                  <Card
                    key={index}
                    size="small"
                    style={{
                      cursor: 'pointer',
                      transition: 'all 0.3s',
                      border: '1px solid #d9d9d9'
                    }}
                    hoverable
                    onClick={() => dienTaiKhoanDemo(taiKhoan)}
                  >
                    <Row align="middle" justify="space-between">
                      <Col>
                        <Space direction="vertical" size={0}>
                          <Text strong>{taiKhoan.vaiTro}</Text>
                          <Text type="secondary" style={{ fontSize: '12px' }}>
                            {taiKhoan.tenDangNhap} / {taiKhoan.matKhau}
                          </Text>
                        </Space>
                      </Col>
                      <Col>
                        <Button size="small" type="link">
                          Chọn
                        </Button>
                      </Col>
                    </Row>
                  </Card>
                ))}

                <div style={{ marginTop: '16px', padding: '12px', backgroundColor: '#f6f6f6', borderRadius: '6px' }}>
                  <Text style={{ fontSize: '12px', color: '#666' }}>
                    💡 <strong>Hướng dẫn:</strong> Click vào tài khoản để tự động điền thông tin đăng nhập
                  </Text>
                </div>
              </Space>
            </Card>
          </Col>
        </Row>
      </div>
    </div>
  );
};

export default DangNhap;
