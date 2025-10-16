import React from 'react';
import { Layout, Dropdown, Avatar, Space, Typography, Button } from 'antd';
import {
  Minimize2,
  Maximize2,
  X,
  Bell,
  Settings,
  LogOut,
  User
} from 'lucide-react';
import { useAuth } from '../../../contexts/AuthContext';
import { getElectronAPI } from '../../../utils/environment';
import './HeaderBar.css';

const { Header } = Layout;
const { Text } = Typography;

const HeaderBar = () => {
  const { user, logout } = useAuth();
  const electronAPI = getElectronAPI();
  const isElectronRuntime = Boolean(electronAPI);

  const handleMinimize = () => {
    electronAPI?.windowMinimize?.();
  };

  const handleMaximize = () => {
    electronAPI?.windowMaximize?.();
  };

  const handleClose = () => {
    electronAPI?.appQuit?.();
  };

  const userMenuItems = [
    {
      key: 'profile',
      icon: <User size={16} />,
      label: 'Thông tin cá nhân',
    },
    {
      key: 'settings',
      icon: <Settings size={16} />,
      label: 'Cài đặt',
    },
    {
      type: 'divider',
    },
    {
      key: 'logout',
      icon: <LogOut size={16} />,
      label: 'Đăng xuất',
      onClick: logout,
    },
  ];

  return (
    <Header className="header-bar">
      <div className="header-left">
        <div className="drag-region">
          <Text strong style={{ fontSize: '16px' }}>
            Hệ thống quản lý quán cafe PMBH
          </Text>
        </div>
      </div>
      
      <div className="header-center">
        <Space size="middle">
          <Button type="text" icon={<Bell size={16} />} className="notification-btn" />
          
          <Dropdown
            menu={{ items: userMenuItems }}
            placement="bottomRight"
            trigger={['click']}
          >
            <Space className="user-info" style={{ cursor: 'pointer' }}>
              <Avatar icon={<User size={14} />} />
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

      <div className="header-right">
        {isElectronRuntime && (
          <div className="window-controls">
            <Button
              type="text"
              icon={<Minimize2 size={14} />}
              className="window-control-btn minimize-btn"
              onClick={handleMinimize}
            />
            <Button
              type="text"
              icon={<Maximize2 size={14} />}
              className="window-control-btn maximize-btn"
              onClick={handleMaximize}
            />
            <Button
              type="text"
              icon={<X size={14} />}
              className="window-control-btn close-btn"
              onClick={handleClose}
            />
          </div>
        )}
      </div>
    </Header>
  );
};

export default HeaderBar;
