import React, { useState, useEffect } from 'react';
import { Modal, Row, Col, Card, Typography, Badge, message, Spin } from 'antd';
import { ArrowRight } from 'lucide-react';

const { Text } = Typography;

const TableTransferModal = ({ 
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
    table.maBan !== selectedTable?.maBan && table.status === 'available'
  );

  // Silent debug logs for performance

  const handleTransfer = () => {
    if (!selectedTargetTable) {
      message.error('Vui lòng chọn bàn đích để chuyển');
      return;
    }
    onConfirm(selectedTargetTable);
  };

  return (
    <Modal
      title={
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <ArrowRight size={20} style={{ color: '#197dd3' }} />
          <span>Chuyển từ bàn {selectedTable?.tenBan || ''}</span>
        </div>
      }
      open={visible}
      onOk={handleTransfer}
      onCancel={onCancel}
      confirmLoading={loading}
      okText="Chuyển bàn"
      cancelText="Hủy"
      width={800}
      okButtonProps={{
        disabled: !selectedTargetTable
      }}
    >
      <div style={{ marginBottom: 16 }}>
        <Text>
          Chọn bàn đích để chuyển hóa đơn từ bàn <strong>{selectedTable?.tenBan}</strong>:
        </Text>
        <br />
        <Text type="secondary" style={{ fontSize: 12 }}>
          Toàn bộ hóa đơn và món ăn từ bàn {selectedTable?.tenBan} sẽ được chuyển sang bàn được chọn.
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
                      <div style={{ fontSize: 11, color: '#28a745' }}>
                        Bàn trống
                      </div>
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
            Không có bàn trống để chuyển
          </div>
          <div style={{ fontSize: 12 }}>
            (Cần có ít nhất 1 bàn trống để thực hiện chuyển bàn)
          </div>
        </div>
      )}
    </Modal>
  );
};

export default TableTransferModal;