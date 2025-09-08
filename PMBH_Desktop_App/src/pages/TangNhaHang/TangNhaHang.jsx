import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Building } from 'lucide-react';
import './TangNhaHang.css';

const TangNhaHang = () => {
  return (
    <div className="tang-nha-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Thiết lập tầng và bàn' },
          { title: 'Tầng nhà hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Building size={20} />
            <span>Tầng nhà hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Tầng nhà hàng đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default TangNhaHang;
