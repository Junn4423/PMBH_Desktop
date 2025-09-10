import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Coffee } from 'lucide-react';
import './ChoQuayBarQl.css';

const ChoQuayBarQl = () => {
  return (
    <div className="cho-quay-bar-ql-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Quản lý bán nhà hàng' },
          { title: 'Cho quầy bar' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Coffee size={20} />
            <span>Cho quầy bar</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Cho quầy bar cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default ChoQuayBarQl;
