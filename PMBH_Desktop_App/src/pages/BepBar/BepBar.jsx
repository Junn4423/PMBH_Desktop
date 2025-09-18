import React, { useState, useEffect } from 'react';
import { 
  Card, 
  Typography, 
  Button, 
  Badge, 
  message, 
  Space,
  Tabs,
  Modal
} from 'antd';
import { 
  ChefHat, 
  Clock, 
  Users,
  CheckCircle, 
  RefreshCw,
  RotateCcw,
  Timer
} from 'lucide-react';

// Import API services
import {
  layDsMonCho,
  layDsMonDaXong,
  updateTrangThaiMon
} from '../../services/apiServices';

import './BepBar.css';

const { Title, Text } = Typography;
const { TabPane } = Tabs;

const BepBar = () => {
  // State quản lý đơn hàng bếp
  const [pendingOrders, setPendingOrders] = useState([]);
  const [completedOrders, setCompletedOrders] = useState([]);
  const [activeTab, setActiveTab] = useState('pending');
  
  // State UI
  const [loading, setLoading] = useState(false);
  const [autoRefresh, setAutoRefresh] = useState(true);

  // Load danh sách món đang chờ làm
  const loadPendingOrders = async () => {
    try {
      console.log('Loading pending orders...');
      const response = await layDsMonCho();
      
      if (Array.isArray(response)) {
        setPendingOrders(response);
        console.log(`Pending orders loaded: ${response.length} items`);
        if (response.length > 0) {
          console.log('First pending order structure:', response[0]);
          console.log('Available fields:', Object.keys(response[0]));
        }
      } else {
        console.log('Pending orders response not array:', response);
        setPendingOrders([]);
      }
    } catch (error) {
      console.error('Error loading pending orders:', error);
      message.error('Không thể tải danh sách món chờ làm');
      setPendingOrders([]);
    }
  };

  // Load danh sách món đã xong
  const loadCompletedOrders = async () => {
    try {
      console.log('Loading completed orders...');
      const response = await layDsMonDaXong();
      
      if (Array.isArray(response)) {
        setCompletedOrders(response);
        console.log(`Completed orders loaded: ${response.length} items`);
        if (response.length > 0) {
          console.log('First completed order structure:', response[0]);
          console.log('Available fields:', Object.keys(response[0]));
        }
      } else {
        console.log('Completed orders response not array:', response);
        setCompletedOrders([]);
      }
    } catch (error) {
      console.error('Error loading completed orders:', error);
      message.error('Không thể tải danh sách món đã xong');
      setCompletedOrders([]);
    }
  };

  // Load tất cả dữ liệu
  const loadAllData = async () => {
    console.log('=== LOADING ALL KITCHEN DATA ===');
    setLoading(true);
    
    try {
      // Clear existing data first to avoid stale state
      setPendingOrders([]);
      setCompletedOrders([]);
      
      // Force reload both lists
      await Promise.all([
        loadPendingOrders(),
        loadCompletedOrders()
      ]);
      
      console.log('All kitchen data loaded successfully');
    } catch (error) {
      console.error('Error loading kitchen data:', error);
    } finally {
      setLoading(false);
    }
  };

  // Hoàn thành món - Mark dish as completed
  const completeOrder = async (idCthd, dishName) => {
    try {
      console.log('=== COMPLETING ORDER ===');
      console.log('Attempting to complete order with idCthd:', idCthd);
      console.log('Dish name:', dishName);
      
      setLoading(true);
      const result = await updateTrangThaiMon(idCthd);
      console.log('API response for complete:', result);
      
      message.success(`Đã hoàn thành món: ${dishName} (ID: ${idCthd})`);
      
      // Hot reload hệ thống ngay sau khi tương tác
      setTimeout(async () => {
        await loadAllData();
      }, 500);
      
    } catch (error) {
      console.error('Error completing order:', error);
      message.error('Không thể hoàn thành món');
    } finally {
      setLoading(false);
    }
  };

  // Hoàn lại món - Revert order back to pending
  const revertOrder = async (idCthd, dishName) => {
    Modal.confirm({
      title: 'Xác nhận hoàn lại món',
      content: `Bạn có chắc muốn hoàn lại món "${dishName}" về trạng thái chờ làm?`,
      onOk: async () => {
        try {
          console.log('=== REVERTING ORDER ===');
          console.log('Attempting to revert order with idCthd:', idCthd);
          console.log('Dish name:', dishName);
          
          setLoading(true);
          const result = await updateTrangThaiMon(idCthd);
          console.log('API response for revert:', result);
          
          message.success(`Đã hoàn lại món: ${dishName} (ID: ${idCthd})`);
          
          // Hot reload hệ thống ngay sau khi tương tác
          setTimeout(async () => {
            console.log('Hot reloading after revert action...');
            await loadAllData();
          }, 500);
          
        } catch (error) {
          console.error('Error reverting order:', error);
          message.error('Không thể hoàn lại món');
        } finally {
          setLoading(false);
        }
      }
    });
  };

  // Auto refresh
  useEffect(() => {
    let intervalId;
    
    if (autoRefresh) {
      // Auto refresh mỗi 15 giây
      intervalId = setInterval(() => {
        console.log('Auto refreshing kitchen data...');
        loadAllData();
      }, 15000); // 15 seconds
    }

    return () => {
      if (intervalId) {
        clearInterval(intervalId);
      }
    };
  }, [autoRefresh]);

  // Load initial data
  useEffect(() => {
    loadAllData();
  }, []);

  // Render Order Item
  const renderOrderItem = (order, isPending = true) => (
    <Card
      key={`${order.idCthd}-${order.banOrder}`}
      className="kitchen-order-item"
      style={{
        borderLeft: `4px solid ${isPending ? '#197dd3' : '#77d4fb'}`,
        marginBottom: '12px'
      }}
    >
      <div className="order-row">
        <div className="order-main-info">
          <div className="order-header-info">
            <div className="table-info">
              <Users size={16} style={{ color: '#197dd3' }} />
              <Text strong style={{ color: '#197dd3' }}>
                {order.banOrder}
              </Text>
            </div>
            <div className="time-info">
              <Clock size={14} style={{ color: '#bdbcc4' }} />
              <Text type="secondary" style={{ fontSize: '12px' }}>
                {order.thoiGian}
              </Text>
            </div>
          </div>
          
          <div className="dish-info">
            <Title level={4} style={{ margin: '8px 0 4px 0', color: '#4b4344' }}>
              {order.tenNuoc}
            </Title>
            <div className="dish-details">
              <Text><strong>Số lượng:</strong> {order.soLuong}</Text>
              <Text style={{ marginLeft: '16px' }}>
                <strong>Giá:</strong> {parseInt(order.gia).toLocaleString('vi-VN')}đ
              </Text>
              <Text style={{ marginLeft: '16px' }}>
                <strong>Thành tiền:</strong> {(parseInt(order.gia) * parseInt(order.soLuong)).toLocaleString('vi-VN')}đ
              </Text>
            </div>
          </div>
        </div>
        
        <div className="order-actions">
          {isPending ? (
            <Button
              type="primary"
              size="large"
              icon={<CheckCircle size={16} />}
              onClick={() => {
                console.log('Complete button clicked for order:', order);
                console.log('idCthd:', order.idCthd, 'tenNuoc:', order.tenNuoc);
                completeOrder(order.idCthd, order.tenNuoc);
              }}
              style={{
                backgroundColor: '#77d4fb',
                borderColor: '#77d4fb',
                color: '#4b4344',
                fontWeight: 'bold'
              }}
            >
              Hoàn thành
            </Button>
          ) : (
            <Button
              type="default"
              size="large"
              icon={<RotateCcw size={16} />}
              onClick={() => revertOrder(order.idCthd, order.tenNuoc)}
              style={{
                borderColor: '#197dd3',
                color: '#197dd3',
                fontWeight: 'bold'
              }}
            >
              Hoàn lại
            </Button>
          )}
        </div>
      </div>
    </Card>
  );

  return (
    <div className="bep-bar-container">
      <div className="view-header">
        <div className="header-left">
          <Title level={2} style={{ margin: '0', color: '#4b4344' }}>
            <ChefHat size={32} style={{ marginRight: 12 }} />
            Bếp & Bar
          </Title>
          <Text type="secondary">Quản lý đơn hàng nhà bếp</Text>
        </div>
        
        <div className="header-right">
          <Space>
            <Button
              icon={<Timer size={16} />}
              onClick={() => setAutoRefresh(!autoRefresh)}
              type={autoRefresh ? 'primary' : 'default'}
            >
              {autoRefresh ? 'Tắt tự động' : 'Bật tự động'}
            </Button>
            
            <Button 
              onClick={loadAllData}
              loading={loading}
              icon={<RefreshCw size={16} />}
              type="primary"
            >
              Làm mới
            </Button>
          </Space>
        </div>
      </div>

      <div className="kitchen-content">
        <Tabs 
          activeKey={activeTab} 
          onChange={setActiveTab}
          size="large"
          className="kitchen-tabs"
        >
          <TabPane 
            tab={
              <span>
                <Clock size={16} style={{ marginRight: 6 }} />
                Món chờ làm
                <Badge count={pendingOrders.length} style={{ marginLeft: 8, backgroundColor: '#197dd3' }} />
              </span>
            } 
            key="pending"
          >
            <div className="orders-container">
              {loading && pendingOrders.length === 0 ? (
                <div className="loading-container">
                  <Clock size={48} />
                  <Text>Đang tải danh sách món chờ làm...</Text>
                </div>
              ) : pendingOrders.length === 0 ? (
                <div className="empty-container">
                  <ChefHat size={48} />
                  <Text>Không có món nào cần làm</Text>
                  <Text type="secondary">Tất cả món đã được hoàn thành</Text>
                </div>
              ) : (
                <div className="orders-list">
                  {pendingOrders.map(order => renderOrderItem(order, true))}
                </div>
              )}
            </div>
          </TabPane>

          <TabPane 
            tab={
              <span>
                <CheckCircle size={16} style={{ marginRight: 6 }} />
                Món đã xong
                <Badge count={completedOrders.length} style={{ marginLeft: 8, backgroundColor: '#77d4fb' }} />
              </span>
            } 
            key="completed"
          >
            <div className="orders-container">
              {loading && completedOrders.length === 0 ? (
                <div className="loading-container">
                  <Clock size={48} />
                  <Text>Đang tải danh sách món đã xong...</Text>
                </div>
              ) : completedOrders.length === 0 ? (
                <div className="empty-container">
                  <CheckCircle size={48} />
                  <Text>Chưa có món nào hoàn thành</Text>
                  <Text type="secondary">Các món đã hoàn thành sẽ xuất hiện ở đây</Text>
                </div>
              ) : (
                <div className="orders-list">
                  {completedOrders.map(order => renderOrderItem(order, false))}
                </div>
              )}
            </div>
          </TabPane>
        </Tabs>
      </div>
    </div>
  );
};

export default BepBar;
