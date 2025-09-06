import React, { useState, useEffect } from 'react';
import { Modal, Row, Col, Card, Typography, Tag, Button, Space } from 'antd';
import { TableOutlined, CheckOutlined } from '@ant-design/icons';
import { useCart } from '../../../contexts/CartContext';
import './ChonBan.css';

const { Text } = Typography;

const ChonBan = ({ visible, onClose }) => {
  const { selectedTable, setSelectedTable } = useCart();
  const [tables, setTables] = useState([]);
  const getStatusColor = (status) => {
    switch (status) {
      case 'available':
        return 'success';
      case 'occupied':
        return 'error';
      case 'reserved':
        return 'warning';
      default:
        return 'default';
    }
  };

  const getStatusText = (status) => {
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

  const handleSelectTable = (table) => {
    if (table.trangThai === 'available') {
      setSelectedTable(table);
      onClose();
    }
  };

  // Nhóm bàn theo khu vực
  const tablesByArea = tables.reduce((acc, table) => {
    if (!acc[table.khuVuc]) {
      acc[table.khuVuc] = [];
    }
    acc[table.khuVuc].push(table);
    return acc;
  }, {});

  return (
    <Modal
      title="Chọn bàn"
      open={visible}
      onCancel={onClose}
      footer={null}
      width={800}
      className="chon-ban-modal"
    >
      <div className="tables-container">
        {Object.entries(tablesByArea).map(([area, areaTables]) => (
          <div key={area} className="area-section">
            <h3 className="area-title">{area}</h3>
            <Row gutter={[12, 12]}>
              {areaTables.map(table => (
                <Col xs={12} sm={8} md={6} key={table.id}>
                  <Card
                    size="small"
                    className={`table-card ${table.trangThai} ${
                      selectedTable?.id === table.id ? 'selected' : ''
                    }`}
                    onClick={() => handleSelectTable(table)}
                    style={{
                      cursor: table.trangThai === 'available' ? 'pointer' : 'not-allowed',
                      opacity: table.trangThai === 'available' ? 1 : 0.6
                    }}
                  >
                    <div className="table-content">
                      <div className="table-icon">
                        <TableOutlined style={{ fontSize: '24px' }} />
                        {selectedTable?.id === table.id && (
                          <CheckOutlined className="check-icon" />
                        )}
                      </div>
                      
                      <div className="table-info">
                        <Text strong className="table-name">
                          {table.ten}
                        </Text>
                        <div className="table-details">
                          <Text type="secondary" style={{ fontSize: '12px' }}>
                            {table.soGhe} ghế
                          </Text>
                        </div>
                        <Tag 
                          color={getStatusColor(table.trangThai)}
                          size="small"
                          className="table-status"
                        >
                          {getStatusText(table.trangThai)}
                        </Tag>
                      </div>
                    </div>
                  </Card>
                </Col>
              ))}
            </Row>
          </div>
        ))}
      </div>

      <div className="modal-footer">
        <Space>
          <div className="legend">
            <Space wrap>
              <div className="legend-item">
                <Tag color="success">Trống</Tag>
                <Text style={{ fontSize: '12px' }}>Có thể chọn</Text>
              </div>
              <div className="legend-item">
                <Tag color="error">Có khách</Tag>
                <Text style={{ fontSize: '12px' }}>Không thể chọn</Text>
              </div>
              <div className="legend-item">
                <Tag color="warning">Đã đặt</Tag>
                <Text style={{ fontSize: '12px' }}>Không thể chọn</Text>
              </div>
            </Space>
          </div>
        </Space>
      </div>
    </Modal>
  );
};

export default ChonBan;
