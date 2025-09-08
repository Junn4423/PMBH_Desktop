import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Card, Row, Col, Typography } from 'antd';
import { 
  ShoppingCart, 
  ChefHat, 
  Package, 
  Receipt, 
  BarChart, 
  Users, 
  Settings 
} from 'lucide-react';
import './TrangChu.css';

const { Title } = Typography;

const TrangChu = () => {
  const navigate = useNavigate();

  const workingAreas = [
    {
      id: 'ban-hang',
      title: 'Bán hàng',
      description: 'Quản lý bán hàng và thanh toán',
      icon: <ShoppingCart size={48} />,
      path: '/ban-hang',
      color: '#197dd3'
    },
    {
      id: 'bep-bar',
      title: 'Bếp/Bar',
      description: 'Quản lý bếp và khu vực bar',
      icon: <ChefHat size={48} />,
      path: '/bep-bar',
      color: '#77d4fb'
    },
    {
      id: 'kho',
      title: 'Kho',
      description: 'Quản lý kho hàng và tồn kho',
      icon: <Package size={48} />,
      path: '/kho',
      color: '#197dd3'
    },
    {
      id: 'chi-khac',
      title: 'Chi khác',
      description: 'Quản lý các chi phí khác',
      icon: <Receipt size={48} />,
      path: '/chi-khac',
      color: '#77d4fb'
    },
    {
      id: 'bao-cao',
      title: 'Báo cáo',
      description: 'Xem báo cáo và thống kê',
      icon: <BarChart size={48} />,
      path: '/bao-cao',
      color: '#197dd3'
    },
    {
      id: 'nhan-su',
      title: 'Nhân sự',
      description: 'Quản lý nhân viên và lương',
      icon: <Users size={48} />,
      path: '/nhan-vien',
      color: '#77d4fb'
    },
    {
      id: 'quan-tri',
      title: 'Quản trị',
      description: 'Cài đặt và quản trị hệ thống',
      icon: <Settings size={48} />,
      path: '/cai-dat',
      color: '#197dd3'
    }
  ];

  const handleAreaClick = (path) => {
    navigate(path);
  };

  return (
    <div className="trang-chu-container">
      <div className="trang-chu-header">
        <Title level={2} className="trang-chu-title">
          Chọn khu vực làm việc
        </Title>
      </div>
      
      <Row gutter={[24, 24]} className="working-areas-grid">
        {workingAreas.map((area) => (
          <Col xs={24} sm={12} md={8} lg={8} key={area.id}>
            <Card
              className="working-area-card"
              hoverable
              onClick={() => handleAreaClick(area.path)}
              styles={{
                body: { 
                  padding: '32px',
                  textAlign: 'center',
                  height: '200px',
                  display: 'flex',
                  flexDirection: 'column',
                  justifyContent: 'center',
                  alignItems: 'center'
                }
              }}
            >
              <div 
                className="area-icon" 
                style={{ color: area.color }}
              >
                {area.icon}
              </div>
              <Title level={4} className="area-title">
                {area.title}
              </Title>
              <p className="area-description">
                {area.description}
              </p>
            </Card>
          </Col>
        ))}
      </Row>
    </div>
  );
};

export default TrangChu;
