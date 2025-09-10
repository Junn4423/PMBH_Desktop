import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { FileBarChart2 } from 'lucide-react';
import './BaoCaoTheoDieuKien.css';

const BaoCaoTheoDieuKien = () => {
  return (
    <div className="bao-cao-theo-dieu-kien-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Quản lí kho' },
          { title: 'Báo cáo theo điều kiện' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <FileBarChart2 size={20} />
            <span>Báo cáo theo điều kiện</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Báo cáo theo điều kiện cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BaoCaoTheoDieuKien;
