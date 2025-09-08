import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { ShoppingCart } from 'lucide-react';
import './NhapBanHang.css';

const NhapBanHang = () => {
  return (
    <div className="nhap-ban-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'Nhập bán hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <ShoppingCart size={20} />
            <span>Nhập bán hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Nhập bán hàng đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default NhapBanHang;
