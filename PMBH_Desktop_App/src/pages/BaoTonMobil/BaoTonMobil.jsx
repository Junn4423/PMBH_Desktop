import React from 'react';
import { Card, Breadcrumb } from 'antd';
import { Database } from 'lucide-react';
import './BaoTonMobil.css';

const BaoTonMobil = () => {
  return (
    <div className="bao-ton-mobil-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Giao diện MB' },
          { title: 'Báo tồn Mobil' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Database size={20} />
            <span>Báo tồn Mobil</span>
          </div>
        }
        className="main-card"
      >
        <div className="development-notice">
          <h3>Màn hình Báo tồn Mobil cần gói premium để sử dụng</h3>
          <p>Chức năng này sẽ sớm được hoàn thiện.</p>
        </div>
      </Card>
    </div>
  );
};

export default BaoTonMobil;
