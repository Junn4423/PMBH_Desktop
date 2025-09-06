import React from 'react';
import { Layout, Dropdown, Avatar, Space, Typography, Button } from 'antd';
import { 
  UserOutlined, 
  LogoutOutlined, 
  SettingOutlined,
  BellOutlined 
} from '@ant-design/icons';
import { useAuth } from '../../../contexts/AuthContext';
import './HeaderBar.css';

const { Header } = Layout;
const { Text } = Typography;

const HeaderBar = () => {
  const { user, logout } = useAuth();

  const userMenuItems = [
    {
      key: 'profile',
      icon: <UserOutlined />,
      label: 'Thông tin cá nhân',
    },
    {
      key: 'settings',
      icon: <SettingOutlined />,
      label: 'Cài đặt',
    },
    {
      type: 'divider',
    },
    {
      key: 'logout',
      icon: <LogoutOutlined />,
      label: 'Đăng xuất',
      onClick: logout,
    },
  ];

  return (
    <Header className="header-bar">
      <div className="header-left">
        <Text strong style={{ fontSize: '16px' }}>
          Hệ thống quản lý quán cafe PMBH
        </Text>
      </div>
      
      <div className="header-right">
        <Space size="middle">
          <Button 
            type="text" 
            icon={<BellOutlined />} 
            className="notification-btn"
          />
          
          <Dropdown
            menu={{ items: userMenuItems }}
            placement="bottomRight"
            trigger={['click']}
          >
            <Space className="user-info" style={{ cursor: 'pointer' }}>
              <Avatar icon={<UserOutlined />} />
              <div className="user-details">
                <Text strong>{user?.hoTen || 'Người dùng'}</Text>
                <br />
                <Text type="secondary" style={{ fontSize: '12px' }}>
                  {user?.vaiTro || 'Nhân viên'}
                </Text>
              </div>
            </Space>
          </Dropdown>
        </Space>
      </div>
    </Header>
  );
};

export default HeaderBar;
