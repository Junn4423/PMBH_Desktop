import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Store } from 'lucide-react';
import './QuanLyBanNhaHang.css';

const QuanLyBanNhaHang = () => {
  return (
    <div className="quan-ly-ban-nha-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Quản lý bán nhà hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Store size={20} />
            <span>Quản lý bán nhà hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Quản lý bán nhà hàng cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default QuanLyBanNhaHang;
