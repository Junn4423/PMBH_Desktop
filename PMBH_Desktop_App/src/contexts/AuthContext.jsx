import React, { createContext, useContext, useState, useEffect } from 'react';
import { login as apiLogin, clearAuthCache, startTokenAutoRefresh } from '../services/apiLogin';

const AuthContext = createContext();

const SESSION_TTL_MS = 60 * 60 * 1000; // 1 hour
const STORAGE_KEYS = {
  user: 'pmbh_user',
  token: 'pmbh_token',
  expiresAt: 'pmbh_token_expires_at',
};

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
    const restoreSession = () => {
      try {
        const rawUser = localStorage.getItem(STORAGE_KEYS.user);
        const token = localStorage.getItem(STORAGE_KEYS.token);
        const expiresRaw = localStorage.getItem(STORAGE_KEYS.expiresAt);

        if (!rawUser || !token || !expiresRaw) {
          clearSessionStorage();
          return;
        }

        const expiresAt = Number(expiresRaw);
        if (!Number.isFinite(expiresAt) || Date.now() >= expiresAt) {
          clearSessionStorage();
          return;
        }

        const parsedUser = JSON.parse(rawUser);
        setUser(parsedUser);
        setIsAuthenticated(true);
      } catch (error) {
        console.error('Failed to restore session:', error);
        clearSessionStorage();
      }
    };

    restoreSession();
    setLoading(false);
  }, []);

  const persistSession = (userData, token) => {
    try {
      const expiresAt = Date.now() + SESSION_TTL_MS;
      localStorage.setItem(STORAGE_KEYS.user, JSON.stringify(userData));
      localStorage.setItem(STORAGE_KEYS.token, token);
      localStorage.setItem(STORAGE_KEYS.expiresAt, String(expiresAt));
    } catch (error) {
      console.error('Failed to persist session:', error);
    }
  };

  const clearSessionStorage = () => {
    localStorage.removeItem(STORAGE_KEYS.user);
    localStorage.removeItem(STORAGE_KEYS.token);
    localStorage.removeItem(STORAGE_KEYS.expiresAt);
  };

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
        persistSession(userData, userData.token);
        
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
  persistSession(userData, result.token);

        startTokenAutoRefresh();
        
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
    clearAuthCache();
    clearSessionStorage();
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
