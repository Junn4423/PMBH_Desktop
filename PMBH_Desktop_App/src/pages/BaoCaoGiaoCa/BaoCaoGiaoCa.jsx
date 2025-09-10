import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Clock } from 'lucide-react';
import './BaoCaoGiaoCa.css';

const BaoCaoGiaoCa = () => {
  return (
    <div className="bao-cao-giao-ca-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'Báo cáo giao ca' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Clock size={20} />
            <span>Báo cáo giao ca</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Báo cáo giao ca cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BaoCaoGiaoCa;
