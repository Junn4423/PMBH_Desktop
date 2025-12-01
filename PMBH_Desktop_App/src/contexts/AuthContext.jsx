import React, { createContext, useContext, useState, useEffect, useCallback } from 'react';
import { message } from 'antd';
import { login as apiLogin, clearAuthCache, setSessionConflictHandler, verifySession } from '../services/apiLogin';

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

  const handleForcedLogout = useCallback((conflictMessage) => {
    setUser(null);
    setIsAuthenticated(false);
    clearAuthCache();
    localStorage.removeItem('pmbh_user');
    localStorage.removeItem('pmbh_token');
    if (conflictMessage) {
      message.warning(conflictMessage);
    }
  }, []);

  useEffect(() => {
    // Clear session trước, không restore từ localStorage
    // App yêu cầu logout mỗi lần restart
    localStorage.removeItem('pmbh_user');
    localStorage.removeItem('pmbh_token');

    setLoading(false);
  }, []);

  useEffect(() => {
    setSessionConflictHandler(handleForcedLogout);
    return () => setSessionConflictHandler(null);
  }, [handleForcedLogout]);

  useEffect(() => {
    if (!user?.taiKhoan || !user?.token) {
      return undefined;
    }

    let cancelled = false;
    const pollIntervalMs = 5000;

    const pollSession = async () => {
      try {
        const status = await verifySession(user.taiKhoan, user.token);
        if (!status?.valid && !cancelled) {
          const reason = status?.message === 'session_conflict'
            ? 'Tài khoản của bạn đã được đăng nhập ở nơi khác. Vui lòng đăng nhập lại.'
            : 'Phiên đăng nhập không còn hợp lệ. Vui lòng đăng nhập lại.';
          handleForcedLogout(reason);
        }
      } catch (error) {
        if (cancelled) {
          return;
        }
        const rawMessage = error?.response?.data?.message || error?.message;
        if (rawMessage === 'session_conflict') {
          handleForcedLogout('Tài khoản của bạn đã được đăng nhập ở nơi khác. Vui lòng đăng nhập lại.');
        }
      }
    };

    pollSession();
    const intervalId = setInterval(pollSession, pollIntervalMs);
    return () => {
      cancelled = true;
      clearInterval(intervalId);
    };
  }, [user?.taiKhoan, user?.token, handleForcedLogout]);

  const login = async (taiKhoan, matKhau, options = {}) => {
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
      const result = await apiLogin(taiKhoan, matKhau, options);
      
      console.log('AuthContext received result:', result);
      
      if (result.requiresForceLogout) {
        return {
          success: false,
          requiresForceLogout: true,
          message: result.message || 'Tài khoản đang đăng nhập ở thiết bị khác',
        };
      }

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
    handleForcedLogout();
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
