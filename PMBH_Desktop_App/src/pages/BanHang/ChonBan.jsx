import React, { useState, useEffect } from 'react';
import { Card, Row, Col, Badge, Typography, Space, Tag, Spin, Button } from 'antd';
import { Table, Plus, Check, Users } from 'lucide-react';
import './ChonBan.css';

const { Title, Text } = Typography;

const ChonBan = ({ selectedTable, onTableSelect, tables = [], loading = false }) => {
  const [filteredTables, setFilteredTables] = useState([]);
  const [selectedViTri, setSelectedViTri] = useState('all');

  // Filter tables theo vị trí
  useEffect(() => {
    if (selectedViTri === 'all') {
      setFilteredTables(tables);
    } else {
      setFilteredTables(tables.filter(table => table.viTri?.toLowerCase() === selectedViTri));
    }
  }, [tables, selectedViTri]);

  // Lấy danh sách vị trí unique
  const viTriList = ['all', ...Array.from(new Set(tables.map(table => table.viTri?.toLowerCase()).filter(Boolean)))];

  const getTableStatusColor = (status) => {
    switch (status?.toLowerCase()) {
      case 'trống':
      case 'trong':
        return '#52c41a';
      case 'đang bán':
      case 'dang ban':
        return '#f5222d';
      case 'đã đặt':
      case 'da dat':
        return '#faad14';
      case 'huỷ do gộp bàn':
      case 'huy do gop ban':
        return '#d9d9d9';
      default:
        return '#d9d9d9';
    }
  };

  const getTableStatusText = (status) => {
    switch (status?.toLowerCase()) {
      case 'trống':
      case 'trong':
        return 'Trống';
      case 'đang bán':
      case 'đang bán':
      case 'dang ban':
        return 'Có khách';
      case 'đã đặt':
      case 'da dat':
        return 'Đã đặt';
      case 'huỷ do gộp bàn':
      case 'huy do gop ban':
        return 'Gộp bàn';
      default:
        return status || 'Không rõ';
    }
  };

  const getTableStatusIcon = (status) => {
    switch (status?.toLowerCase()) {
      case 'trống':
      case 'trong':
        return <Plus size={16} />;
      case 'đang bán':
      case 'dang ban':
        return <Users size={16} />;
      case 'đã đặt':
      case 'da dat':
        return <Check size={16} />;
      default:
        return <Table size={16} />;
    }
  };

  const handleViTriClick = (viTri) => {
    setSelectedViTri(viTri);
  };

  const handleTableClick = (table) => {
    if (table.trangThai?.toLowerCase() === 'trống' || table.trangThai?.toLowerCase() === 'trong' || table.id === selectedTable?.id) {
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
            <Tag color="#d9d9d9">Gộp bàn</Tag>
          </Space>
        </div>
      </div>

      {/* Filter theo vị trí */}
      <div className="vi-tri-filter">
        <Title level={5}>Chọn vị trí:</Title>
        <Row gutter={[8, 8]}>
          <Col>
            <Button
              type={selectedViTri === 'all' ? 'primary' : 'default'}
              onClick={() => handleViTriClick('all')}
            >
              Tất cả
            </Button>
          </Col>
          {viTriList.filter(vt => vt !== 'all').map((viTri) => (
            <Col key={viTri}>
              <Button
                type={selectedViTri === viTri ? 'primary' : 'default'}
                onClick={() => handleViTriClick(viTri)}
              >
                {viTri.toUpperCase()}
              </Button>
            </Col>
          ))}
        </Row>
      </div>

      {/* Danh sách bàn */}
      <div className="ban-list">
        {loading ? (
          <div style={{ textAlign: 'center', padding: '20px' }}>
            <Spin size="large" />
            <div style={{ marginTop: '10px' }}>
              <Text>Đang tải danh sách bàn...</Text>
            </div>
          </div>
        ) : (
          <>
            <Title level={5}>
              Danh sách bàn ({filteredTables.length} bàn)
            </Title>
            {filteredTables.length === 0 ? (
              <div style={{ textAlign: 'center', padding: '40px' }}>
                <Text type="secondary">Không có bàn nào</Text>
              </div>
            ) : (
              <Row gutter={[16, 16]} className="tables-grid">
                {filteredTables.map((table) => (
                  <Col xs={12} sm={8} md={6} lg={4} key={table.id}>
                    <Card
                      className={`table-card ${table.id === selectedTable?.id ? 'selected' : ''} ${table.trangThai?.toLowerCase().replace(/\s+/g, '_')}`}
                      hoverable={table.trangThai?.toLowerCase() === 'trống' || table.trangThai?.toLowerCase() === 'trong'}
                      onClick={() => handleTableClick(table)}
                      styles={{ body: { padding: '16px' } }}
                    >
                      <div className="table-content">
                        <div className="table-header">
                          <div className="table-icon">
                            <Table size={24} color={getTableStatusColor(table.trangThai)} />
                          </div>
                          <Badge
                            status={table.trangThai?.toLowerCase() === 'trống' || table.trangThai?.toLowerCase() === 'trong' ? 'success' :
                                   table.trangThai?.toLowerCase() === 'đang bán' ? 'error' : 'warning'}
                            dot
                          />
                        </div>

                        <div className="table-info">
                          <Text strong className="table-name">{table.tenBan}</Text>
                          <Text className="table-location">{table.viTri}</Text>
                        </div>

                        <div className="table-status">
                          <Tag
                            color={getTableStatusColor(table.trangThai)}
                            icon={getTableStatusIcon(table.trangThai)}
                          >
                            {getTableStatusText(table.trangThai)}
                          </Tag>
                        </div>

                        {table.maHoaDon && (
                          <div className="table-order-id">
                            <Text type="secondary" className="order-id">HĐ: {table.maHoaDon}</Text>
                          </div>
                        )}
                      </div>
                    </Card>
                  </Col>
                ))}
              </Row>
            )}
          </>
        )}
      </div>
    </div>
  );
};

export default ChonBan;
