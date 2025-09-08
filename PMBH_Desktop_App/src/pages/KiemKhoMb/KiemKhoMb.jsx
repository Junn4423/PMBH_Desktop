import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Search } from 'lucide-react';
import './KiemKhoMb.css';

const KiemKhoMb = () => {
  return (
    <div className="kiem-kho-mb-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'Kiểm kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Search size={20} />
            <span>Kiểm kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Kiểm kho đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default KiemKhoMb;
