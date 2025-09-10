import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { ChefHat } from 'lucide-react';
import './ChoNhaBep.css';

const ChoNhaBep = () => {
  return (
    <div className="cho-nha-bep-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
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

export default ChoNhaBep;
