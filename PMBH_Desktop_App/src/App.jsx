import React, { Suspense } from 'react';
import { Routes, Route, Navigate, Outlet } from 'react-router-dom';
import { Spin } from 'antd';
import { useAuth } from './contexts/AuthContext';
import { LanguageProvider } from './contexts/LanguageContext';
import DangNhap from './auth/DangNhap';
import MainLayout from './components/Layout/MainLayout/MainLayout';
import {
  protectedRoutes,
  standaloneRoutes,
  paymentRoutes
} from './routes/config';

const SuspenseFallback = (
  <div
    style={{
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      height: '100vh'
    }}
  >
    <Spin size="large" />
  </div>
);

const ProtectedRoute = () => {
  const { isAuthenticated, loading } = useAuth();

  if (loading) {
    return SuspenseFallback;
  }

  if (!isAuthenticated) {
    return <DangNhap />;
  }

  return <Outlet />;
};

const renderRoutes = (routes) =>
  routes.map(({ path, Component }) => (
    <Route key={path} path={path} element={<Component />} />
  ));

function App() {
  return (
    <LanguageProvider>
      <Suspense fallback={SuspenseFallback}>
        <Routes>
          {renderRoutes(standaloneRoutes)}
          {renderRoutes(paymentRoutes)}

          <Route element={<ProtectedRoute />}>
            <Route element={<MainLayout />}>
              <Route index element={<Navigate to="/trang-chu" replace />} />
              {renderRoutes(protectedRoutes)}
            </Route>
          </Route>

          <Route path="*" element={<Navigate to="/trang-chu" replace />} />
        </Routes>
      </Suspense>
    </LanguageProvider>
  );
}

export default App;


