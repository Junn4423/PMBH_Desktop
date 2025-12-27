import React, { useState } from 'react';
import { 
  Form, Input, Button, Checkbox, Alert, 
  Typography, message, Modal 
} from 'antd';
import { 
  User, 
  Lock,
  LogIn,
  X,
  Coffee,
  ShoppingCart,
  BarChart,
  Clock
} from 'lucide-react';
import { useAuth } from '../contexts/AuthContext';
import { getElectronAPI } from '../utils/environment';
import logoImg from '../assets/Logo/logo.png';
import '../styles/pages/DangNhap.css';

const { Title, Text } = Typography;

const DangNhap = () => {
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const [showError, setShowError] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');
  const { login: authLogin } = useAuth();
  const electronAPI = getElectronAPI();
  const isElectronRuntime = Boolean(electronAPI);

  const handleExitApp = () => {
    electronAPI?.exitApp?.();
  };

  const confirmForceLogout = () => new Promise((resolve) => {
    Modal.confirm({
      title: 'Phiên đăng nhập đang được sử dụng',
      content: 'Đã đăng nhập tài khoản ở một nơi khác, bạn muốn đăng xuất tài khoản đó ra không?',
      okText: 'Đăng xuất thiết bị kia',
      cancelText: 'Giữ phiên cũ',
      centered: true,
      onOk: () => resolve(true),
      onCancel: () => resolve(false),
    });
  });

  const xuLyDangNhap = async (values) => {
    setLoading(true);
    setShowError(false);
    setErrorMessage('');

    try {
      const { tenDangNhap, matKhau, ghi_nho } = values;
      
      // Call auth login
      let result = await authLogin(tenDangNhap, matKhau);

      if (result.requiresForceLogout) {
        setLoading(false);
        const shouldForceLogout = await confirmForceLogout();

        if (!shouldForceLogout) {
          message.info('Bạn đã hủy yêu cầu đăng nhập.');
          return;
        }

        setLoading(true);
        result = await authLogin(tenDangNhap, matKhau, { forceLogout: true });
      }

      if (result.success) {
        // Clear any previous errors
        setShowError(false);
        setErrorMessage('');
        
        // Save/clear login credentials if remember is checked
        if (ghi_nho) {
          localStorage.setItem('remembered_user', tenDangNhap);
          localStorage.setItem('remembered_password', matKhau);
        } else {
          localStorage.removeItem('remembered_user');
          localStorage.removeItem('remembered_password');
        }

        message.success(`Đăng nhập thành công! Chào mừng bạn!`);
        
        // Login successful, AuthContext will handle the redirect
        // by changing isAuthenticated to true
      } else {
        // Customize error message based on error_code
        let displayMessage = result.message || 'Tên đăng nhập hoặc mật khẩu không đúng';
        
        if (result.error_code === 'service_unavailable' || result.error_code === 'service_connection_failed') {
          displayMessage = result.message || 'Không thể kết nối đến máy chủ dịch vụ. Vui lòng liên hệ quản trị viên.';
        } else if (result.error_code === 'unauthorized_service') {
          displayMessage = result.message || 'Tài khoản không được phép truy cập dịch vụ này';
        } else if (result.error_code === 'service_validation_failed') {
          displayMessage = 'Không thể xác minh quyền truy cập dịch vụ. Vui lòng thử lại sau.';
        }
        
        setShowError(true);
        setErrorMessage(displayMessage);
        message.error(displayMessage);
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
    // Load remembered credentials
    const rememberedUser = localStorage.getItem('remembered_user');
    const rememberedPassword = localStorage.getItem('remembered_password');
    
    if (rememberedUser && rememberedPassword) {
      form.setFieldsValue({
        tenDangNhap: rememberedUser,
        matKhau: rememberedPassword,
        ghi_nho: true
      });
    } else if (rememberedUser) {
      // Chỉ có username, không có password
      form.setFieldsValue({
        tenDangNhap: rememberedUser,
        ghi_nho: true
      });
    }
  }, [form]);

  return (
    <div className="login-container">
      {/* Exit Button */}
      {isElectronRuntime && (
        <Button
        className="login-exit-btn"
        type="text"
        icon={<X size={20} />}
        onClick={handleExitApp}
        title="Thoát ứng dụng"
      />
      )}
      
      {/* Left Side - Introduction */}
      <div className="login-intro-section">
        <div className="login-intro-content">
          <div className="login-intro-header">
            <div className="login-intro-logo">
              <Coffee size={48} />
            </div>
            <h1 className="login-intro-title">Café Management</h1>
            <p className="login-intro-subtitle">Hệ thống quản lý quán cà phê chuyên nghiệp</p>
          </div>
          
          <div className="login-intro-features">
            <div className="feature-item">
              <ShoppingCart size={24} />
              <div className="feature-content">
                <h3>Bán hàng thông minh</h3>
                <p>Quản lý đơn hàng và thanh toán dễ dàng</p>
              </div>
            </div>
            
            <div className="feature-item">
              <BarChart size={24} />
              <div className="feature-content">
                <h3>Báo cáo chi tiết</h3>
                <p>Thống kê doanh thu và hiệu suất kinh doanh</p>
              </div>
            </div>
            
            <div className="feature-item">
              <Clock size={24} />
              <div className="feature-content">
                <h3>Theo dõi thời gian thực</h3>
                <p>Cập nhật trạng thái đơn hàng ngay lập tức</p>
              </div>
            </div>
          </div>
          
          <div className="login-intro-footer">
            <Text>© 2024 Café Management System</Text>
          </div>
        </div>
      </div>

      {/* Right Side - Login Form - Tách ra ngoài không có Card wrapper */}
      <div className="login-form-section">
        <div className="login-form-container">
          {/* Login Header - Tách ra ngoài */}
          <div className="login-header">
            <div className="login-logo">
              <img src={logoImg} alt="Logo" className="login-logo-image" />
            </div>
            <Title level={2} className="login-title">Đăng nhập</Title>
            <Text className="login-subtitle">
              Vui lòng đăng nhập để tiếp tục sử dụng hệ thống
            </Text>
          </div>

          {/* Error Alert - Tách ra ngoài */}
          {showError && (
            <Alert
              message="Đăng nhập thất bại"
              description={errorMessage || "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại."}
              type="error"
              showIcon
              className="login-error-alert"
            />
          )}

          {/* Login Form - Tách ra ngoài */}
          <Form
            form={form}
            name="login"
            onFinish={xuLyDangNhap}
            layout="vertical"
            size="large"
            className="login-form"
          >
            {/* Username Input - Component riêng */}
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
                className="login-input"
              />
            </Form.Item>

            {/* Password Input - Component riêng */}
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
                className="login-input"
              />
            </Form.Item>

            {/* Remember Checkbox - Component riêng */}
            <div className="login-remember-section">
              <Form.Item name="ghi_nho" valuePropName="checked" noStyle>
                <Checkbox className="login-checkbox">Ghi nhớ đăng nhập</Checkbox>
              </Form.Item>
            </div>

            {/* Login Button - Component riêng */}
            <div className="login-button-section">
              <Button
                type="primary"
                htmlType="submit"
                loading={loading}
                block
                icon={<LogIn size={16} />}
                className="login-button"
              >
                Đăng nhập
              </Button>
            </div>
          </Form>

          {/* Footer - Component riêng */}
          <div className="login-footer">
            <Text className="login-footer-text">
              Phiên bản 1.0.0
            </Text>
          </div>
        </div>
      </div>
    </div>
  );
}
export default DangNhap;
