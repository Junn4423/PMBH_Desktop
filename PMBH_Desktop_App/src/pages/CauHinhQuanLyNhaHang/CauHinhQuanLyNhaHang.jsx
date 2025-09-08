import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Settings } from 'lucide-react';
import './CauHinhQuanLyNhaHang.css';

const CauHinhQuanLyNhaHang = () => {
  return (
    <div className="cau-hinh-quan-ly-nha-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Quản lý bán nhà hàng' },
          { title: 'Cấu hình quản lý nhà hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Settings size={20} />
            <span>Cấu hình quản lý nhà hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Cấu hình quản lý nhà hàng đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default CauHinhQuanLyNhaHang;
