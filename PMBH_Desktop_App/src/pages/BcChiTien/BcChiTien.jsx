import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { FileText } from 'lucide-react';
import './BcChiTien.css';

const BcChiTien = () => {
  return (
    <div className="bc-chi-tien-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'BC chi tiền' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <FileText size={20} />
            <span>BC chi tiền</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình BC chi tiền cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BcChiTien;
