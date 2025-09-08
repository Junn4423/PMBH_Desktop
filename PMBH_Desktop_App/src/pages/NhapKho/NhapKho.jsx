import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { TruckIcon } from 'lucide-react';
import './NhapKho.css';

const NhapKho = () => {
  return (
    <div className="nhap-kho-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Quản lí kho' },
          { title: 'Nhập kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <TruckIcon size={20} />
            <span>Nhập kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Nhập kho đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default NhapKho;
