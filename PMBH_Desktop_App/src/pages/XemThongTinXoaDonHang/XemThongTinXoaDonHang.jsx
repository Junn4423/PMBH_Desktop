import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Trash2 } from 'lucide-react';
import './XemThongTinXoaDonHang.css';

const XemThongTinXoaDonHang = () => {
  return (
    <div className="xem-thong-tin-xoa-don-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Quản lý bán nhà hàng' },
          { title: 'Xem thông tin xóa đơn hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Trash2 size={20} />
            <span>Xem thông tin xóa đơn hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Xem thông tin xóa đơn hàng đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default XemThongTinXoaDonHang;
