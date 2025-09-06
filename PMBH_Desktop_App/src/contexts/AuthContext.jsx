import React, { createContext, useContext, useState, useEffect } from 'react';

const AuthContext = createContext();

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth phải được sử dụng trong AuthProvider');
  }
  return context;
};

export const AuthProvider = ({ children }) => {
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Kiểm tra xem có token đã lưu không
    const savedUser = localStorage.getItem('pmbh_user');
    const savedToken = localStorage.getItem('pmbh_token');
    
    if (savedUser && savedToken) {
      setUser(JSON.parse(savedUser));
      setIsAuthenticated(true);
    }
    
    setLoading(false);
  }, []);

  const login = async (taiKhoan, matKhau) => {
    try {
      // Giả lập API call
      if (taiKhoan === 'admin' && matKhau === '123456') {
        const userData = {
          id: 1,
          taiKhoan: 'admin',
          hoTen: 'Quản trị viên',
          vaiTro: 'admin',
          email: 'admin@pmbh.com'
        };
        
        setUser(userData);
        setIsAuthenticated(true);
        
        localStorage.setItem('pmbh_user', JSON.stringify(userData));
        localStorage.setItem('pmbh_token', 'fake-jwt-token');
        
        return { success: true };
      } else {
        return { 
          success: false, 
          message: 'Tài khoản hoặc mật khẩu không đúng' 
        };
      }
    } catch (error) {
      return { 
        success: false, 
        message: 'Đã xảy ra lỗi khi đăng nhập' 
      };
    }
  };

  const logout = () => {
    setUser(null);
    setIsAuthenticated(false);
    localStorage.removeItem('pmbh_user');
    localStorage.removeItem('pmbh_token');
  };

  const value = {
    user,
    isAuthenticated,
    loading,
    login,
    logout
  };

  return (
    <AuthContext.Provider value={value}>
      {children}
    </AuthContext.Provider>
  );
};
