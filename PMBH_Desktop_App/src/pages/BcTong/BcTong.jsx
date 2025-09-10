import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { PieChart } from 'lucide-react';
import './BcTong.css';

const BcTong = () => {
  return (
    <div className="bc-tong-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'BC tổng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <PieChart size={20} />
            <span>BC tổng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình BC tổng cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BcTong;
