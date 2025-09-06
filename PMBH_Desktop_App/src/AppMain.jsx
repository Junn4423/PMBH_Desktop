import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { Layout, Menu, Avatar, Dropdown, Space, Button, message } from 'antd';
import {
  HomeOutlined,
  ShoppingCartOutlined,
  AppstoreOutlined,
  TableOutlined,
  UserOutlined,
  TeamOutlined,
  BarChartOutlined,
  SettingOutlined,
  LogoutOutlined,
  MenuFoldOutlined,
  MenuUnfoldOutlined,
  CoffeeOutlined
} from '@ant-design/icons';

// Import components
import DangNhap from './auth/DangNhap';
import TrangChuChinh from './trangchu/TrangChuChinh';
import BanHang from './banhang/BanHang';
import QuanLySanPham from './sanpham/QuanLySanPham/QuanLySanPham';
import QuanLyBan from './ban/QuanLyBan';
import QuanLyKhachHang from './khachhang/QuanLyKhachHang';
import QuanLyNhanVien from './nhanvien/QuanLyNhanVien';
import BaoCaoThongKe from './baocao/BaoCaoThongKe';
import CaiDatHeThong from './caidat/CaiDatHeThong';

const { Header, Sider, Content } = Layout;

function App() {
  const [collapsed, setCollapsed] = useState(false);
  const [currentUser, setCurrentUser] = useState(null);
  const [selectedKey, setSelectedKey] = useState('1');

  useEffect(() => {
    // Check if user is already logged in
    const userSession = localStorage.getItem('user_session');
    if (userSession) {
      try {
        const userData = JSON.parse(userSession);
        setCurrentUser(userData);
      } catch (error) {
        console.error('Error parsing user session:', error);
        localStorage.removeItem('user_session');
      }
    }
  }, []);

  const handleLogin = (userData) => {
    setCurrentUser(userData);
  };

  const handleLogout = () => {
    localStorage.removeItem('user_session');
    localStorage.removeItem('remembered_user');
    setCurrentUser(null);
    setSelectedKey('1');
    message.success('Đăng xuất thành công');
  };

  const menuItems = [
    {
      key: '1',
      icon: <HomeOutlined />,
      label: 'Trang chủ',
      path: '/dashboard'
    },
    {
      key: '2',
      icon: <ShoppingCartOutlined />,
      label: 'Bán hàng',
      path: '/sales'
    },
    {
      key: '3',
      icon: <AppstoreOutlined />,
      label: 'Sản phẩm',
      path: '/products'
    },
    {
      key: '4',
      icon: <TableOutlined />,
      label: 'Quản lý bàn',
      path: '/tables'
    },
    {
      key: '5',
      icon: <UserOutlined />,
      label: 'Khách hàng',
      path: '/customers'
    },
    {
      key: '6',
      icon: <TeamOutlined />,
      label: 'Nhân viên',
      path: '/employees'
    },
    {
      key: '7',
      icon: <BarChartOutlined />,
      label: 'Báo cáo',
      path: '/reports'
    },
    {
      key: '8',
      icon: <SettingOutlined />,
      label: 'Cài đặt',
      path: '/settings'
    }
  ];

  const userMenuItems = [
    {
      key: 'profile',
      icon: <UserOutlined />,
      label: 'Thông tin cá nhân'
    },
    {
      key: 'settings',
      icon: <SettingOutlined />,
      label: 'Cài đặt tài khoản'
    },
    {
      type: 'divider'
    },
    {
      key: 'logout',
      icon: <LogoutOutlined />,
      label: 'Đăng xuất',
      onClick: handleLogout
    }
  ];

  // If not logged in, show login page
  if (!currentUser) {
    return <DangNhap onLogin={handleLogin} />;
  }

  return (
    <Router>
      <Layout style={{ minHeight: '100vh' }}>
        <Sider 
          trigger={null} 
          collapsible 
          collapsed={collapsed}
          style={{
            background: '#001529',
            boxShadow: '2px 0 8px rgba(0,0,0,0.15)'
          }}
        >
          <div style={{
            height: '64px',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            background: 'rgba(255,255,255,0.1)',
            margin: '16px',
            borderRadius: '8px',
            color: 'white'
          }}>
            <CoffeeOutlined style={{ fontSize: '24px', marginRight: collapsed ? 0 : '8px' }} />
            {!collapsed && <span style={{ fontWeight: 'bold' }}>Café POS</span>}
          </div>
          
          <Menu
            theme="dark"
            mode="inline"
            selectedKeys={[selectedKey]}
            items={menuItems}
            onSelect={({ key }) => setSelectedKey(key)}
            style={{ border: 'none' }}
          />
        </Sider>

        <Layout>
          <Header style={{
            padding: '0 24px',
            background: '#fff',
            display: 'flex',
            justifyContent: 'space-between',
            alignItems: 'center',
            boxShadow: '0 2px 8px rgba(0,0,0,0.1)'
          }}>
            <Button
              type="text"
              icon={collapsed ? <MenuUnfoldOutlined /> : <MenuFoldOutlined />}
              onClick={() => setCollapsed(!collapsed)}
              style={{ fontSize: '16px', width: '64px', height: '64px' }}
            />

            <Space>
              <span>Xin chào, </span>
              <Dropdown
                menu={{ items: userMenuItems }}
                trigger={['click']}
                placement="bottomRight"
              >
                <Space style={{ cursor: 'pointer' }}>
                  <Avatar icon={<UserOutlined />} />
                  <span>{currentUser.vaiTro} {currentUser.tenDangNhap}</span>
                </Space>
              </Dropdown>
            </Space>
          </Header>

          <Content style={{
            margin: '0',
            padding: '0',
            background: '#f0f2f5',
            minHeight: 'calc(100vh - 64px)',
            overflow: 'auto'
          }}>
            <Routes>
              <Route path="/" element={<Navigate to="/dashboard" replace />} />
              <Route path="/dashboard" element={<TrangChuChinh />} />
              <Route path="/sales" element={<BanHang />} />
              <Route path="/products" element={<QuanLySanPham />} />
              <Route path="/tables" element={<QuanLyBan />} />
              <Route path="/customers" element={<QuanLyKhachHang />} />
              <Route path="/employees" element={<QuanLyNhanVien />} />
              <Route path="/reports" element={<BaoCaoThongKe />} />
              <Route path="/settings" element={<CaiDatHeThong />} />
            </Routes>
          </Content>
        </Layout>
      </Layout>
    </Router>
  );
}

export default App;
