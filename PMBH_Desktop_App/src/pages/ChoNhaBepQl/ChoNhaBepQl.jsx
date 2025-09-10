import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { ChefHat } from 'lucide-react';
import './ChoNhaBepQl.css';

const ChoNhaBepQl = () => {
  return (
    <div className="cho-nha-bep-ql-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Quản lý bán nhà hàng' },
          { title: 'Cho nhà bếp' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <ChefHat size={20} />
            <span>Cho nhà bếp</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Cho nhà bếp cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default ChoNhaBepQl;
