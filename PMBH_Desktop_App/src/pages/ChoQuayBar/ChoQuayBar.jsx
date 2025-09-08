import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Coffee } from 'lucide-react';
import './ChoQuayBar.css';

const ChoQuayBar = () => {
  return (
    <div className="cho-quay-bar-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
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
          <h3>Màn hình Cho quầy bar đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default ChoQuayBar;
