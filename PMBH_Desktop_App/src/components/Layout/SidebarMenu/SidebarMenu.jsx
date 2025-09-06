import React, { useState } from 'react';
import { Menu } from 'antd';
import { useNavigate, useLocation } from 'react-router-dom';
import {
  HomeOutlined,
  ShoppingCartOutlined,
  TableOutlined,
  MenuOutlined,
  UserOutlined,
  TeamOutlined,
  BarChartOutlined,
  SettingOutlined,
  CoffeeOutlined
} from '@ant-design/icons';
import './SidebarMenu.css';

const SidebarMenu = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [collapsed, setCollapsed] = useState(false);

  const menuItems = [
    {
      key: '/trang-chu',
      icon: <HomeOutlined />,
      label: 'Trang chủ',
    },
    {
      key: '/ban-hang',
      icon: <ShoppingCartOutlined />,
      label: 'Bán hàng',
    },
    {
      key: '/quan-ly-ban',
      icon: <TableOutlined />,
      label: 'Quản lý bàn',
    },
    {
      key: '/thuc-don',
      icon: <MenuOutlined />,
      label: 'Thực đơn',
    },
    {
      key: '/khach-hang',
      icon: <UserOutlined />,
      label: 'Khách hàng',
    },
    {
      key: '/nhan-vien',
      icon: <TeamOutlined />,
      label: 'Nhân viên',
    },
    {
      key: '/bao-cao',
      icon: <BarChartOutlined />,
      label: 'Báo cáo',
    },
    {
      key: '/cai-dat',
      icon: <SettingOutlined />,
      label: 'Cài đặt',
    },
  ];

  const handleMenuClick = ({ key }) => {
    navigate(key);
  };

  return (
    <div className="sidebar-menu">
      <div className="logo-section">
        <CoffeeOutlined style={{ fontSize: '24px', color: '#1890ff' }} />
        <span className="logo-text">PMBH Cafe</span>
      </div>
      
      <Menu
        mode="inline"
        selectedKeys={[location.pathname]}
        onClick={handleMenuClick}
        items={menuItems}
        style={{ border: 'none' }}
      />
    </div>
  );
};

export default SidebarMenu;
