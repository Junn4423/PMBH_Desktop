import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Package2 } from 'lucide-react';
import './SanPham.css';

const SanPham = () => {
  return (
    <div className="san-pham-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Điều khiển sản phẩm' },
          { title: 'Sản phẩm' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Package2 size={20} />
            <span>Sản phẩm</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Sản phẩm đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default SanPham;
