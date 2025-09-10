import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Warehouse } from 'lucide-react';
import './NhapKhoMb.css';

const NhapKhoMb = () => {
  return (
    <div className="nhap-kho-mb-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'Nhập kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Warehouse size={20} />
            <span>Nhập kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Nhập kho cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default NhapKhoMb;
