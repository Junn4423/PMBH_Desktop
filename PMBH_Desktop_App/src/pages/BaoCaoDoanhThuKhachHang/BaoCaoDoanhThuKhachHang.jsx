import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { DollarSign } from 'lucide-react';
import './BaoCaoDoanhThuKhachHang.css';

const BaoCaoDoanhThuKhachHang = () => {
  return (
    <div className="bao-cao-doanh-thu-khach-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Báo cáo doanh thu khách hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <DollarSign size={20} />
            <span>Báo cáo doanh thu khách hàng</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Báo cáo doanh thu khách hàng cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BaoCaoDoanhThuKhachHang;
