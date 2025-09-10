import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Truck } from 'lucide-react';
import './XuatKho.css';

const XuatKho = () => {
  return (
    <div className="xuat-kho-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Quản lí kho' },
          { title: 'Xuất kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Truck size={20} />
            <span>Xuất kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Xuất kho cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default XuatKho;
