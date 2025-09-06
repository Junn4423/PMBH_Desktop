import React from 'react';
import { Button, Modal, message } from 'antd';
import { LogoutOutlined, ExclamationCircleOutlined } from '@ant-design/icons';
import { useAuth } from '../contexts/AuthContext';

const { confirm } = Modal;

const DangXuat = () => {
  const { logout, user } = useAuth();

  const handleLogout = () => {
    confirm({
      title: 'Xác nhận đăng xuất',
      icon: <ExclamationCircleOutlined />,
      content: `Bạn có chắc chắn muốn đăng xuất khỏi tài khoản "${user?.username}"?`,
      okText: 'Đăng xuất',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          await logout();
          message.success('Đăng xuất thành công!');
        } catch (error) {
          message.error('Có lỗi xảy ra khi đăng xuất!');
        }
      },
    });
  };

  return (
    <Button
      type="text"
      icon={<LogoutOutlined />}
      onClick={handleLogout}
      className="dang-xuat-button"
    >
      Đăng xuất
    </Button>
  );
};

export default DangXuat;
