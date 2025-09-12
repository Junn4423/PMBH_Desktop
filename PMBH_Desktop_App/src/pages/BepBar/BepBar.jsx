import React, { useState, useEffect } from 'react';
import { 
  Card, 
  Row, 
  Col, 
  Typography, 
  Button, 
  Badge, 
  Modal, 
  Select, 
  message, 
  Space,
  Divider,
  List,
  Tag
} from 'antd';
import { 
  ChefHat, 
  Clock, 
  Coffee, 
  ArrowRight, 
  CheckCircle, 
  RefreshCw,
  AlertCircle
} from 'lucide-react';

// Import API services
import {
  layDsMonCho,
  layDsMonAn,
  layDsMonNuoc,
  chuyenMon,
  loadBanBanhang
} from '../../services/apiServices';

import './BepBar.css';

const { Title, Text } = Typography;
const { Option } = Select;

const KitchenSystem = () => {
  // State quản lý đơn hàng bếp
  const [waitingOrders, setWaitingOrders] = useState([]);
  const [foodOrders, setFoodOrders] = useState([]);
  const [beverageOrders, setBeverageOrders] = useState([]);
  const [tables, setTables] = useState([]);
  
  // State UI
  const [loading, setLoading] = useState(false);
  const [refreshInterval, setRefreshInterval] = useState(null);
  const [transferModalVisible, setTransferModalVisible] = useState(false);
  const [selectedItems, setSelectedItems] = useState([]);
  const [targetTable, setTargetTable] = useState(null);

  // Load dữ liệu ban đầu
  useEffect(() => {
    loadKitchenData();
    loadTables();
    
    // Tự động refresh mỗi 30 giây
    const interval = setInterval(() => {
      loadKitchenData();
    }, 30000);
    
    setRefreshInterval(interval);
    
    return () => {
      if (interval) clearInterval(interval);
    };
  }, []);

  // Load dữ liệu bếp
  const loadKitchenData = async () => {
    try {
      setLoading(true);
      const [waitingResponse, foodResponse, beverageResponse] = await Promise.all([
        layDsMonCho(),
        layDsMonAn(),
        layDsMonNuoc()
      ]);

      if (Array.isArray(waitingResponse)) {
        setWaitingOrders(waitingResponse);
      }
      
      if (Array.isArray(foodResponse)) {
        setFoodOrders(foodResponse);
      }
      
      if (Array.isArray(beverageResponse)) {
        setBeverageOrders(beverageResponse);
      }
    } catch (error) {
      console.error('Error loading kitchen data:', error);
      message.error('Không thể tải dữ liệu bếp');
    } finally {
      setLoading(false);
    }
  };

  // Load danh sách bàn
  const loadTables = async () => {
    try {
      const response = await loadBanBanhang();
      if (Array.isArray(response)) {
        setTables(response.map(table => ({
          id: table.idBan,
          name: table.tenBan,
          areaId: table.idKhuVuc
        })));
      }
    } catch (error) {
      console.error('Error loading tables:', error);
    }
  };

  // Refresh thủ công
  const handleRefresh = () => {
    loadKitchenData();
    message.success('Đã cập nhật dữ liệu');
  };

  // Chuyển món
  const handleTransferDishes = async () => {
    if (selectedItems.length === 0 || !targetTable) {
      message.error('Vui lòng chọn món và bàn đích');
      return;
    }

    try {
      await chuyenMon(selectedItems, targetTable.id);
      message.success(`Đã chuyển ${selectedItems.length} món sang ${targetTable.name}`);
      
      setTransferModalVisible(false);
      setSelectedItems([]);
      setTargetTable(null);
      
      // Reload dữ liệu
      loadKitchenData();
    } catch (error) {
      console.error('Error transferring dishes:', error);
      message.error('Không thể chuyển món');
    }
  };

  // Format thời gian
  const formatTime = (timeString) => {
    if (!timeString) return '';
    const time = new Date(timeString);
    return time.toLocaleTimeString('vi-VN', { 
      hour: '2-digit', 
      minute: '2-digit' 
    });
  };

  // Tính thời gian chờ
  const getWaitingTime = (orderTime) => {
    if (!orderTime) return 0;
    const now = new Date();
    const order = new Date(orderTime);
    return Math.floor((now - order) / (1000 * 60)); // phút
  };

  // Render order card
  const renderOrderCard = (order, type) => {
    const waitingMinutes = getWaitingTime(order.thoiGianDat);
    const isUrgent = waitingMinutes > 15;
    
    return (
      <Card
        key={`${type}-${order.id || order.maCt}`}
        className={`kitchen-order-card ${isUrgent ? 'urgent' : ''}`}
        size="small"
      >
        <div className="order-header">
          <div className="table-info">
            <Coffee size={16} />
            <Text strong>{order.tenBan || order.ban}</Text>
          </div>
          <div className="time-info">
            <Clock size={14} />
            <Text type="secondary">{formatTime(order.thoiGianDat)}</Text>
          </div>
        </div>

        <div className="order-content">
          <Text strong className="dish-name">{order.tenMon || order.ten}</Text>
          <div className="order-details">
            <Tag color={type === 'food' ? 'orange' : 'blue'}>
              {type === 'food' ? 'Món ăn' : 'Đồ uống'}
            </Tag>
            <Text>SL: {order.soLuong}</Text>
          </div>
        </div>

        <div className="order-footer">
          <Badge 
            status={isUrgent ? 'error' : 'processing'} 
            text={`${waitingMinutes} phút`} 
          />
          {order.ghiChu && (
            <Text type="secondary" className="note">
              {order.ghiChu}
            </Text>
          )}
        </div>
      </Card>
    );
  };

  return (
    <div className="kitchen-system">
      {/* Header */}
      <div className="kitchen-header">
        <div>
          <Title level={3} style={{ margin: 0, color: '#4b4344' }}>
            Hệ thống bếp
          </Title>
          <Text type="secondary">
            {waitingOrders.length + foodOrders.length + beverageOrders.length} đơn hàng đang xử lý
          </Text>
        </div>
        
        <Space>
          <Button 
            icon={<ArrowRight size={16} />}
            onClick={() => setTransferModalVisible(true)}
            disabled={selectedItems.length === 0}
          >
            Chuyển món ({selectedItems.length})
          </Button>
          <Button 
            icon={<RefreshCw size={16} />}
            onClick={handleRefresh}
            loading={loading}
          >
            Cập nhật
          </Button>
        </Space>
      </div>

      {/* Kitchen Sections */}
      <Row gutter={16} className="kitchen-content">
        {/* Món đang chờ */}
        <Col span={8}>
          <Card 
            title={
              <div className="section-title">
                <AlertCircle size={20} />
                <span>Món đang chờ ({waitingOrders.length})</span>
              </div>
            }
            className="kitchen-section waiting-section"
          >
            <div className="orders-list">
              {waitingOrders.map(order => renderOrderCard(order, 'waiting'))}
              {waitingOrders.length === 0 && (
                <div className="empty-state">
                  <Text type="secondary">Không có món đang chờ</Text>
                </div>
              )}
            </div>
          </Card>
        </Col>

        {/* Món ăn */}
        <Col span={8}>
          <Card 
            title={
              <div className="section-title">
                <ChefHat size={20} />
                <span>Món ăn ({foodOrders.length})</span>
              </div>
            }
            className="kitchen-section food-section"
          >
            <div className="orders-list">
              {foodOrders.map(order => renderOrderCard(order, 'food'))}
              {foodOrders.length === 0 && (
                <div className="empty-state">
                  <Text type="secondary">Không có món ăn</Text>
                </div>
              )}
            </div>
          </Card>
        </Col>

        {/* Đồ uống */}
        <Col span={8}>
          <Card 
            title={
              <div className="section-title">
                <Coffee size={20} />
                <span>Đồ uống ({beverageOrders.length})</span>
              </div>
            }
            className="kitchen-section beverage-section"
          >
            <div className="orders-list">
              {beverageOrders.map(order => renderOrderCard(order, 'beverage'))}
              {beverageOrders.length === 0 && (
                <div className="empty-state">
                  <Text type="secondary">Không có đồ uống</Text>
                </div>
              )}
            </div>
          </Card>
        </Col>
      </Row>

      {/* Transfer Dishes Modal */}
      <Modal
        title="Chuyển món"
        open={transferModalVisible}
        onCancel={() => {
          setTransferModalVisible(false);
          setSelectedItems([]);
          setTargetTable(null);
        }}
        footer={[
          <Button key="cancel" onClick={() => {
            setTransferModalVisible(false);
            setSelectedItems([]);
            setTargetTable(null);
          }}>
            Hủy
          </Button>,
          <Button 
            key="transfer" 
            type="primary" 
            onClick={handleTransferDishes}
            disabled={selectedItems.length === 0 || !targetTable}
          >
            Chuyển món
          </Button>
        ]}
      >
        <div className="transfer-content">
          <div className="selected-items">
            <Text strong>Món đã chọn ({selectedItems.length}):</Text>
            <List
              size="small"
              dataSource={selectedItems}
              renderItem={item => (
                <List.Item>
                  <Text>{item.tenMon || item.ten} - SL: {item.soLuong}</Text>
                </List.Item>
              )}
            />
          </div>

          <Divider />

          <div className="table-selection">
            <Text strong>Chọn bàn đích:</Text>
            <Select
              style={{ width: '100%', marginTop: 8 }}
              placeholder="Chọn bàn"
              value={targetTable?.id}
              onChange={(value) => {
                const table = tables.find(t => t.id === value);
                setTargetTable(table);
              }}
            >
              {tables.map(table => (
                <Option key={table.id} value={table.id}>
                  {table.name}
                </Option>
              ))}
            </Select>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default KitchenSystem;
