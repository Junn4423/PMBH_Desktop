import React, { useState, useEffect } from 'react';
import { Card, Row, Col, Button, Badge, Typography, Space, Tag } from 'antd';
import { Table, Plus, Check, Users } from 'lucide-react';
import './ChonBan.css';

const { Title, Text } = Typography;

const ChonBan = ({ selectedTable, onTableSelect, tables = [] }) => {
  const [availableTables, setAvailableTables] = useState([]);

  useEffect(() => {
    // Mock data cho các bàn
    const mockTables = [
      { id: 'B01', name: 'Bàn 01', seats: 4, status: 'available', customer: null },
      { id: 'B02', name: 'Bàn 02', seats: 2, status: 'occupied', customer: 'Nguyễn Văn A' },
      { id: 'B03', name: 'Bàn 03', seats: 6, status: 'available', customer: null },
      { id: 'B04', name: 'Bàn 04', seats: 4, status: 'reserved', customer: 'Trần Thị B' },
      { id: 'B05', name: 'Bàn 05', seats: 2, status: 'available', customer: null },
      { id: 'B06', name: 'Bàn 06', seats: 8, status: 'occupied', customer: 'Lê Văn C' },
      { id: 'B07', name: 'Bàn 07', seats: 4, status: 'available', customer: null },
      { id: 'B08', name: 'Bàn 08', seats: 6, status: 'available', customer: null },
    ];

    setAvailableTables(tables.length > 0 ? tables : mockTables);
  }, [tables]);

  const getTableStatusColor = (status) => {
    switch (status) {
      case 'available':
        return '#52c41a';
      case 'occupied':
        return '#f5222d';
      case 'reserved':
        return '#faad14';
      default:
        return '#d9d9d9';
    }
  };

  const getTableStatusText = (status) => {
    switch (status) {
      case 'available':
        return 'Trống';
      case 'occupied':
        return 'Có khách';
      case 'reserved':
        return 'Đã đặt';
      default:
        return 'Không xác định';
    }
  };

  const getTableStatusIcon = (status) => {
    switch (status) {
      case 'available':
        return <Plus size={16} />;
      case 'occupied':
        return <Users size={16} />;
      case 'reserved':
        return <Check size={16} />;
      default:
        return <Table size={16} />;
    }
  };

  const handleTableClick = (table) => {
    if (table.status === 'available' || table.id === selectedTable?.id) {
      onTableSelect?.(table);
    }
  };

  return (
    <div className="chon-ban-container">
      <div className="chon-ban-header">
        <Title level={4}>Chọn bàn</Title>
        <div className="status-legend">
          <Space>
            <Tag color="#52c41a">Trống</Tag>
            <Tag color="#f5222d">Có khách</Tag>
            <Tag color="#faad14">Đã đặt</Tag>
          </Space>
        </div>
      </div>

      <Row gutter={[16, 16]} className="tables-grid">
        {availableTables.map((table) => (
          <Col xs={12} sm={8} md={6} lg={4} key={table.id}>
            <Card
              className={`table-card ${table.id === selectedTable?.id ? 'selected' : ''} ${table.status}`}
              hoverable={table.status === 'available'}
              onClick={() => handleTableClick(table)}
              bodyStyle={{ padding: '16px' }}
            >
              <div className="table-content">
                <div className="table-header">
                  <div className="table-icon">
                    <Table size={24} color={getTableStatusColor(table.status)} />
                  </div>
                  <Badge 
                    status={table.status === 'available' ? 'success' : 
                           table.status === 'occupied' ? 'error' : 'warning'} 
                    dot 
                  />
                </div>
                
                <div className="table-info">
                  <Text strong className="table-name">{table.name}</Text>
                  <Text className="table-seats">{table.seats} chỗ ngồi</Text>
                </div>

                <div className="table-status">
                  <Tag 
                    color={getTableStatusColor(table.status)}
                    icon={getTableStatusIcon(table.status)}
                  >
                    {getTableStatusText(table.status)}
                  </Tag>
                </div>

                {table.customer && (
                  <div className="table-customer">
                    <Text type="secondary" className="customer-label">Khách:</Text>
                    <Text className="customer-name">{table.customer}</Text>
                  </div>
                )}
              </div>
            </Card>
          </Col>
        ))}
      </Row>

      {selectedTable && (
        <Card className="selected-table-info" size="small">
          <div className="selected-info">
            <Text strong>Đã chọn: </Text>
            <Text>{selectedTable.name}</Text>
            <Text type="secondary"> - {selectedTable.seats} chỗ ngồi</Text>
          </div>
        </Card>
      )}
    </div>
  );
};

export default ChonBan;
