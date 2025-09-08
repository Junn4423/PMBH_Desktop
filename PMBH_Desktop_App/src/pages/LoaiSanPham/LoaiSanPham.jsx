import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Tags } from 'lucide-react';
import './LoaiSanPham.css';

const LoaiSanPham = () => {
  return (
    <div className="loai-san-pham-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Điều khiển sản phẩm' },
          { title: 'Loại sản phẩm' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Tags size={20} />
            <span>Loại sản phẩm</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Loại sản phẩm đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default LoaiSanPham;
