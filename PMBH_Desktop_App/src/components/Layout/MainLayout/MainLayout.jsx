import React from 'react';
import { Layout } from 'antd';
import { Outlet } from 'react-router-dom';
import SidebarMenu from '../SidebarMenu/SidebarMenu';
import HeaderBar from '../HeaderBar/HeaderBar';
import './MainLayout.css';

const { Content } = Layout;

const MainLayout = () => {
  return (
    <Layout className="main-layout">
      <SidebarMenu />
      <Layout className="main-layout__shell">
        <HeaderBar />
        <Content className="main-layout__content">
          <div className="main-layout__content-inner">
            <Outlet />
          </div>
        </Content>
      </Layout>
    </Layout>
  );
};

export default MainLayout;
