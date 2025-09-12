import React, { createContext, useContext, useState, useEffect } from 'react';
import { login as apiLogin } from '../services/apiLogin';

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
    // Clear session trước, không restore từ localStorage
    // App yêu cầu logout mỗi lần restart
    localStorage.removeItem('pmbh_user');
    localStorage.removeItem('pmbh_token');
    
    setLoading(false);
  }, []);

  const login = async (taiKhoan, matKhau) => {
    try {
      // Demo accounts for testing
      const demoAccounts = [
        { username: 'admin', password: 'admin', role: 'Admin', chiNhanh: 'Chi nhánh chính' },
        { username: 'manager', password: '123', role: 'Manager', chiNhanh: 'Chi nhánh 1' },
        { username: 'user', password: '123', role: 'User', chiNhanh: 'Chi nhánh 2' },
        { username: 'demo', password: 'demo', role: 'Demo', chiNhanh: 'Chi nhánh demo' }
      ];

      // Check demo accounts first
      const demoAccount = demoAccounts.find(
        acc => acc.username === taiKhoan && acc.password === matKhau
      );

      if (demoAccount) {
        const userData = {
          id: demoAccount.username,
          taiKhoan: demoAccount.username,
          hoTen: demoAccount.username,
          vaiTro: demoAccount.role,
          email: `${demoAccount.username}@demo.com`,
          token: `demo_token_${Date.now()}`,
          chiNhanh: demoAccount.chiNhanh
        };
        
        setUser(userData);
        setIsAuthenticated(true);
        
        localStorage.setItem('pmbh_user', JSON.stringify(userData));
        localStorage.setItem('pmbh_token', userData.token);
        
        return { success: true };
      }

      // If not demo account, try real API
      const result = await apiLogin(taiKhoan, matKhau);
      
      console.log('AuthContext received result:', result);
      
      if (result.success && result.userCode && result.token) {
        const userData = {
          id: result.userCode,
          taiKhoan: result.userCode,
          hoTen: result.userCode,
          vaiTro: result.role || 'user',
          email: '',
          token: result.token,
          chiNhanh: result.chiNhanh
        };
        
        setUser(userData);
        setIsAuthenticated(true);
        
        localStorage.setItem('pmbh_user', JSON.stringify(userData));
        localStorage.setItem('pmbh_token', result.token);
        
        return { success: true };
      } else {
        return { 
          success: false, 
          message: result.message || 'Đăng nhập thất bại' 
        };
      }
    } catch (error) {
      return { 
        success: false, 
        message: error.message || 'Đã xảy ra lỗi khi đăng nhập' 
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
