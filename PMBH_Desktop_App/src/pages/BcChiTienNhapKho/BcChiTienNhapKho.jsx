import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { FileBarChart } from 'lucide-react';
import './BcChiTienNhapKho.css';

const BcChiTienNhapKho = () => {
  return (
    <div className="bc-chi-tien-nhap-kho-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'BC chi tiền + nhập kho' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <FileBarChart size={20} />
            <span>BC chi tiền + nhập kho</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình BC chi tiền + nhập kho đang được phát triển</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BcChiTienNhapKho;
