import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Table } from 'lucide-react';
import './BanNhaHang.css';

const BanNhaHang = () => {
  return (
    <div className="ban-nha-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Thiết lập tầng và bàn' },
          { title: 'Bàn nhà hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Table size={20} />
            <span>Bàn nhà hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Bàn nhà hàng cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BanNhaHang;
