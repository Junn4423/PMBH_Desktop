import React, { useState, useEffect } from 'react';
import { Modal, Row, Col, Card, Typography, Badge, message, Spin } from 'antd';
import { Merge } from 'lucide-react';

const { Text } = Typography;

const TableMergeModal = ({ 
  visible, 
  onCancel, 
  onConfirm, 
  selectedTable, 
  tables, 
  loading 
}) => {
  const [selectedTargetTable, setSelectedTargetTable] = useState(null);

  useEffect(() => {
    if (!visible) {
      setSelectedTargetTable(null);
    }
  }, [visible]);

  const getTableBadgeStatus = (status) => {
    switch (status) {
      case 'occupied':
        return 'error';
      case 'available':
        return 'success';
      case 'reserved':
        return 'warning';
      default:
        return 'default';
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'occupied':
        return 'Có khách';
      case 'available':
        return 'Trống';
      case 'reserved':
        return 'Đã đặt';
      default:
        return 'Không xác định';
    }
  };

  const availableTables = tables.filter(table => 
    table.maBan !== selectedTable?.maBan && table.status === 'occupied'
  );

  // Debug logging
  React.useEffect(() => {
    if (visible) {
      console.log('TableMergeModal - All tables:', tables);
      console.log('TableMergeModal - Selected table:', selectedTable);
      console.log('TableMergeModal - Available tables:', availableTables);
      console.log('TableMergeModal - Tables length:', tables.length);
      console.log('TableMergeModal - Occupied tables:', tables.filter(t => t.status === 'occupied'));
    }
  }, [visible, tables, selectedTable, availableTables]);

  const handleMerge = () => {
    if (!selectedTargetTable) {
      message.error('Vui lòng chọn bàn đích để gộp');
      return;
    }
    onConfirm(selectedTargetTable);
  };

  return (
    <Modal
      title={
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <Merge size={20} style={{ color: '#197dd3' }} />
          <span>Gộp bàn {selectedTable?.tenBan || ''}</span>
        </div>
      }
      open={visible}
      onOk={handleMerge}
      onCancel={onCancel}
      confirmLoading={loading}
      okText="Gộp bàn"
      cancelText="Hủy"
      width={800}
      okButtonProps={{
        disabled: !selectedTargetTable
      }}
    >
      <div style={{ marginBottom: 16 }}>
        <Text>
          Chọn bàn đích để gộp bàn <strong>{selectedTable?.tenBan}</strong> vào:
        </Text>
        <br />
        <Text type="secondary" style={{ fontSize: 12 }}>
          Tất cả món ăn từ bàn {selectedTable?.tenBan} sẽ được chuyển vào bàn được chọn và hóa đơn bàn {selectedTable?.tenBan} sẽ bị xóa.
        </Text>
      </div>
      
      {loading ? (
        <div style={{ textAlign: 'center', padding: '40px 0' }}>
          <Spin size="large" />
        </div>
      ) : (
        <Row gutter={[12, 12]}>
          {availableTables.map(table => (
            <Col span={8} key={table.maBan}>
              <Card
                hoverable
                className={`table-select-card ${selectedTargetTable?.maBan === table.maBan ? 'selected' : ''}`}
                onClick={() => setSelectedTargetTable(table)}
                style={{
                  border: selectedTargetTable?.maBan === table.maBan ? '2px solid #197dd3' : '1px solid #d9d9d9',
                  backgroundColor: selectedTargetTable?.maBan === table.maBan ? '#f0f8ff' : 'white',
                  cursor: 'pointer'
                }}
                bodyStyle={{ padding: '12px', textAlign: 'center' }}
              >
                <Badge 
                  status={getTableBadgeStatus(table.status)} 
                  text={
                    <div>
                      <div style={{ fontWeight: 'bold', fontSize: 14 }}>
                        {table.tenBan}
                      </div>
                      <div style={{ fontSize: 12, color: '#666' }}>
                        {getStatusText(table.status)}
                      </div>
                      {table.customerCount && (
                        <div style={{ fontSize: 11, color: '#999' }}>
                          {table.customerCount} khách
                        </div>
                      )}
                    </div>
                  }
                />
              </Card>
            </Col>
          ))}
        </Row>
      )}

      {availableTables.length === 0 && !loading && (
        <div style={{ textAlign: 'center', padding: '40px 20px', color: '#999' }}>
          <div style={{ marginBottom: 8 }}>
            Không có bàn nào khác có khách để gộp
          </div>
          <div style={{ fontSize: 12 }}>
            (Cần có ít nhất 2 bàn có khách để thực hiện gộp bàn)
          </div>
        </div>
      )}
    </Modal>
  );
};

export default TableMergeModal;