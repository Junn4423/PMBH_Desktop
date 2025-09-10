import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { FileSpreadsheet } from 'lucide-react';
import './BcNhapKho.css';

const BcNhapKho = () => {
  return (
    <div className="bc-nhap-kho-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'BC nhập kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <FileSpreadsheet size={20} />
            <span>BC nhập kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình BC nhập kho cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BcNhapKho;
