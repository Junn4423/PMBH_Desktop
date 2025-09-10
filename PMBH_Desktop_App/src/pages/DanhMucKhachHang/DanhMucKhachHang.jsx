import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Users } from 'lucide-react';
import './DanhMucKhachHang.css';

const DanhMucKhachHang = () => {
  return (
    <div className="danh-muc-khach-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Danh mục khách hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Users size={20} />
            <span>Danh mục khách hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Danh mục khách hàng cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default DanhMucKhachHang;
