import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Users } from 'lucide-react';
import './NhanVienCongTy.css';

const NhanVienCongTy = () => {
  return (
    <div className="nhan-vien-cong-ty-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Công ty' },
          { title: 'Nhân viên' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Users size={20} />
            <span>Nhân viên công ty</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Nhân viên công ty đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default NhanVienCongTy;
