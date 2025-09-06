import React, { useState } from 'react';
import { Row, Col, Card, Typography, Tag, Button, Space, Modal } from 'antd';
import { TableOutlined, CheckOutlined, PlusOutlined } from '@ant-design/icons';

const { Title, Text } = Typography;

const SoDoQuanLyBan = ({ 
  tables = [], 
  selectedTable, 
  onTableSelect, 
  onTableAdd,
  onTableEdit,
  groupByArea = true 
}) => {
  const [showAddModal, setShowAddModal] = useState(false);

  const getStatusColor = (status) => {
    switch (status) {
      case 'available': return 'success';
      case 'occupied': return 'error';
      case 'reserved': return 'warning';
      case 'maintenance': return 'default';
      default: return 'default';
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'available': return 'Trống';
      case 'occupied': return 'Có khách';
      case 'reserved': return 'Đã đặt';
      case 'maintenance': return 'Bảo trì';
      default: return 'Không xác định';
    }
  };

  const handleTableClick = (table) => {
    if (table.trangThai === 'available' && onTableSelect) {
      onTableSelect(table);
    } else if (onTableEdit) {
      onTableEdit(table);
    }
  };

  // Nhóm bàn theo khu vực nếu được yêu cầu
  const groupedTables = groupByArea 
    ? tables.reduce((acc, table) => {
        const area = table.khuVuc || 'Chưa phân loại';
        if (!acc[area]) acc[area] = [];
        acc[area].push(table);
        return acc;
      }, {})
    : { 'Tất cả bàn': tables };

  return (
    <div className="so-do-quan-ly-ban">
      <div style={{ 
        display: 'flex', 
        justifyContent: 'space-between', 
        alignItems: 'center',
        marginBottom: '16px'
      }}>
        <Title level={4} style={{ margin: 0 }}>Sơ đồ bàn</Title>
        {onTableAdd && (
          <Button 
            type="primary" 
            icon={<PlusOutlined />}
            onClick={onTableAdd}
            size="small"
          >
            Thêm bàn
          </Button>
        )}
      </div>

      {Object.entries(groupedTables).map(([area, areaTables]) => (
        <Card 
          key={area} 
          title={area} 
          size="small"
          style={{ marginBottom: '16px' }}
        >
          <Row gutter={[8, 8]}>
            {areaTables.map(table => (
              <Col xs={6} sm={4} md={3} lg={2} key={table.id}>
                <Card
                  size="small"
                  className={`table-card ${table.trangThai} ${
                    selectedTable?.id === table.id ? 'selected' : ''
                  }`}
                  onClick={() => handleTableClick(table)}
                  style={{
                    cursor: 'pointer',
                    border: `2px solid ${
                      selectedTable?.id === table.id 
                        ? '#1890ff' 
                        : table.trangThai === 'available' 
                          ? '#52c41a'
                          : table.trangThai === 'occupied'
                            ? '#ff4d4f'
                            : '#faad14'
                    }`,
                    borderRadius: '8px',
                    textAlign: 'center',
                    height: '80px',
                    transition: 'all 0.3s',
                    background: selectedTable?.id === table.id ? '#e6f7ff' : 'white'
                  }}
                  bodyStyle={{ 
                    padding: '8px',
                    display: 'flex',
                    flexDirection: 'column',
                    justifyContent: 'center',
                    alignItems: 'center',
                    height: '100%'
                  }}
                >
                  <div style={{ position: 'relative' }}>
                    <TableOutlined 
                      style={{ 
                        fontSize: '16px',
                        color: table.trangThai === 'available' 
                          ? '#52c41a'
                          : table.trangThai === 'occupied'
                            ? '#ff4d4f'
                            : '#faad14'
                      }} 
                    />
                    {selectedTable?.id === table.id && (
                      <CheckOutlined 
                        style={{
                          position: 'absolute',
                          top: '-4px',
                          right: '-4px',
                          background: '#1890ff',
                          color: 'white',
                          borderRadius: '50%',
                          padding: '1px',
                          fontSize: '8px'
                        }}
                      />
                    )}
                  </div>
                  
                  <Text 
                    strong 
                    style={{ 
                      fontSize: '10px',
                      lineHeight: '1.2',
                      marginTop: '2px'
                    }}
                  >
                    {table.ten}
                  </Text>
                  
                  <Tag 
                    color={getStatusColor(table.trangThai)}
                    size="small"
                    style={{ 
                      fontSize: '8px',
                      margin: '2px 0 0 0',
                      padding: '0 4px',
                      lineHeight: '14px'
                    }}
                  >
                    {getStatusText(table.trangThai)}
                  </Tag>
                </Card>
              </Col>
            ))}
          </Row>
        </Card>
      ))}

      {tables.length === 0 && (
        <Card>
          <div style={{ 
            textAlign: 'center', 
            padding: '40px',
            color: '#999'
          }}>
            <TableOutlined style={{ fontSize: '48px', marginBottom: '16px' }} />
            <div>Chưa có bàn nào</div>
            {onTableAdd && (
              <Button 
                type="primary" 
                icon={<PlusOutlined />}
                onClick={onTableAdd}
                style={{ marginTop: '16px' }}
              >
                Thêm bàn đầu tiên
              </Button>
            )}
          </div>
        </Card>
      )}
    </div>
  );
};

export default SoDoQuanLyBan;
