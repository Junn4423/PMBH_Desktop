import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { BarChart } from 'lucide-react';
import './BcBanHang.css';

const BcBanHang = () => {
  return (
    <div className="bc-ban-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'BC bán hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <BarChart size={20} />
            <span>BC bán hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình BC bán hàng đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BcBanHang;
