import React from 'react';
import { Modal, Typography } from 'antd';
import { Split } from 'lucide-react';

const { Text } = Typography;

const TableSplitModal = ({ 
  visible, 
  onCancel, 
  onConfirm, 
  selectedTable, 
  loading 
}) => {
  return (
    <Modal
      title={
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <Split size={20} style={{ color: '#197dd3' }} />
          <span>Tách bàn {selectedTable?.tenBan || ''}</span>
        </div>
      }
      open={visible}
      onOk={onConfirm}
      onCancel={onCancel}
      confirmLoading={loading}
      okText="Tách bàn"
      cancelText="Hủy"
      okType="danger"
    >
      <div style={{ padding: '20px 0' }}>
        <Text>
          Bạn có chắc chắn muốn tách bàn <strong>{selectedTable?.tenBan}</strong> không?
        </Text>
        <br />
        <br />
        <Text type="secondary" style={{ fontSize: 12 }}>
          Thao tác này sẽ hủy việc gộp bàn và tách các món ăn trong hóa đơn ra thành các hóa đơn riêng biệt.
        </Text>
      </div>
    </Modal>
  );
};

export default TableSplitModal;