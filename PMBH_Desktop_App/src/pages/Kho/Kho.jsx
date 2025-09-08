import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Warehouse } from 'lucide-react';
import './Kho.css';

const Kho = () => {
  return (
    <div className="kho-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Quản lí kho' },
          { title: 'Kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Warehouse size={20} />
            <span>Kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Kho đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default Kho;
