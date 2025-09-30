import React, { useState, useEffect } from 'react';
import { Modal, Typography, List, Checkbox, Card, Space, Button, Divider, Alert } from 'antd';
import { Split, ArrowRight, CheckCircle } from 'lucide-react';

const { Text, Title } = Typography;

const TableSplitModal = ({
  visible,
  onCancel,
  onConfirm,
  selectedTable,
  invoiceDetails = [],
  loading,
  selectedItemsForSplit = [],
  setSelectedItemsForSplit,
  splitTargetTable,
  setSplitTargetTable,
  availableTablesForSplit = []
}) => {
  const [currentStep, setCurrentStep] = useState(1); // 1: Chọn món, 2: Chọn bàn

  // Reset khi đóng modal
  useEffect(() => {
    if (!visible) {
      setCurrentStep(1);
    }
  }, [visible]);

  const handleItemSelect = (item, checked) => {
    if (checked) {
      setSelectedItemsForSplit([...selectedItemsForSplit, item]);
    } else {
      setSelectedItemsForSplit(selectedItemsForSplit.filter(selectedItem =>
        (selectedItem.maCt || selectedItem.cthd || selectedItem.idCthd) !==
        (item.maCt || item.cthd || item.idCthd)
      ));
    }
  };

  const handleNextStep = () => {
    if (selectedItemsForSplit.length > 0) {
      setCurrentStep(2);
    }
  };

  const handlePrevStep = () => {
    setCurrentStep(1);
  };

  const remainingItems = invoiceDetails.filter(item =>
    !selectedItemsForSplit.some(selectedItem =>
      (selectedItem.maCt || selectedItem.cthd || selectedItem.idCthd) ===
      (item.maCt || item.cthd || item.idCthd)
    )
  );

  const canProceed = selectedItemsForSplit.length > 0 && remainingItems.length > 0;

  return (
    <Modal
      title={
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <Split size={20} style={{ color: '#197dd3' }} />
          <span>Tách bàn {selectedTable?.tenBan || ''}</span>
        </div>
      }
      open={visible}
      onCancel={onCancel}
      width={700}
      footer={
        <div style={{ display: 'flex', justifyContent: 'space-between' }}>
          <Button onClick={onCancel}>
            Hủy
          </Button>
          <Space>
            {currentStep === 2 && (
              <Button onClick={handlePrevStep}>
                Quay lại
              </Button>
            )}
            {currentStep === 1 ? (
              <Button
                type="primary"
                onClick={handleNextStep}
                disabled={!canProceed}
              >
                Tiếp theo ({selectedItemsForSplit.length} món)
              </Button>
            ) : (
              <Button
                type="primary"
                danger
                onClick={onConfirm}
                loading={loading}
                disabled={!splitTargetTable}
              >
                Tách bàn
              </Button>
            )}
          </Space>
        </div>
      }
    >
      <div style={{ padding: '20px 0' }}>
        {/* Step Indicator */}
        <div style={{ display: 'flex', alignItems: 'center', marginBottom: 24 }}>
          <div style={{
            width: 32,
            height: 32,
            borderRadius: '50%',
            background: currentStep >= 1 ? '#197dd3' : '#d9d9d9',
            color: 'white',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            fontWeight: 'bold'
          }}>
            1
          </div>
          <div style={{
            height: 2,
            flex: 1,
            background: currentStep >= 2 ? '#197dd3' : '#d9d9d9',
            margin: '0 12px'
          }} />
          <div style={{
            width: 32,
            height: 32,
            borderRadius: '50%',
            background: currentStep >= 2 ? '#197dd3' : '#d9d9d9',
            color: 'white',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            fontWeight: 'bold'
          }}>
            2
          </div>
        </div>

        <div style={{ marginBottom: 16 }}>
          <Text strong>
            Bước {currentStep}: {currentStep === 1 ? 'Chọn món để tách' : 'Chọn bàn đích'}
          </Text>
        </div>

        {currentStep === 1 ? (
          // Bước 1: Chọn món
          <div>
            <Alert
              message="Chọn món để tách"
              description="Chọn 1 hoặc nhiều món để chuyển sang bàn khác. Phải chừa lại ít nhất 1 món ở bàn hiện tại."
              type="info"
              showIcon
              style={{ marginBottom: 16 }}
            />

            <List
              dataSource={invoiceDetails}
              renderItem={(item) => {
                const isSelected = selectedItemsForSplit.some(selectedItem =>
                  (selectedItem.maCt || selectedItem.cthd || selectedItem.idCthd) ===
                  (item.maCt || item.cthd || item.idCthd)
                );

                return (
                  <List.Item style={{ padding: '12px 0' }}>
                    <div style={{ display: 'flex', alignItems: 'center', width: '100%' }}>
                      <Checkbox
                        checked={isSelected}
                        onChange={(e) => handleItemSelect(item, e.target.checked)}
                        style={{ marginRight: 12 }}
                      />
                      <div style={{ flex: 1 }}>
                        <Text strong>{item.tenSp || item.ten || item.tensp || item.name}</Text>
                        <br />
                        <Text type="secondary" style={{ fontSize: 12 }}>
                          SL: {item.sl || item.soLuong} × {parseFloat(item.gia || item.giaBan || item.donGia || 0).toLocaleString()}đ
                        </Text>
                      </div>
                      <Text strong style={{ color: '#197dd3' }}>
                        {(parseFloat(item.gia || item.giaBan || item.donGia || 0) * parseInt(item.sl || item.soLuong)).toLocaleString()}đ
                      </Text>
                    </div>
                  </List.Item>
                );
              }}
            />

            {selectedItemsForSplit.length > 0 && (
              <Card size="small" style={{ marginTop: 16, background: '#f6ffed', borderColor: '#b7eb8f' }}>
                <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
                  <CheckCircle size={16} style={{ color: '#52c41a' }} />
                  <Text strong style={{ color: '#52c41a' }}>
                    Đã chọn {selectedItemsForSplit.length} món để tách
                  </Text>
                </div>
                <div style={{ marginTop: 8 }}>
                  <Text type="secondary" style={{ fontSize: 12 }}>
                    Còn lại {remainingItems.length} món ở bàn hiện tại
                  </Text>
                </div>
              </Card>
            )}

            {!canProceed && selectedItemsForSplit.length > 0 && (
              <Alert
                message="Không thể tách"
                description="Phải chừa lại ít nhất 1 món ở bàn hiện tại."
                type="warning"
                showIcon
                style={{ marginTop: 16 }}
              />
            )}
          </div>
        ) : (
          // Bước 2: Chọn bàn
          <div>
            <Alert
              message="Chọn bàn đích"
              description={`Chọn bàn trống cùng khu vực (${selectedTable?.idKhuVuc}) để chuyển ${selectedItemsForSplit.length} món đã chọn.`}
              type="info"
              showIcon
              style={{ marginBottom: 16 }}
            />

            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fill, minmax(120px, 1fr))', gap: 12 }}>
              {availableTablesForSplit.map((table) => (
                <Card
                  key={table.id}
                  size="small"
                  style={{
                    cursor: 'pointer',
                    border: splitTargetTable?.id === table.id ? '2px solid #197dd3' : '1px solid #d9d9d9',
                    background: splitTargetTable?.id === table.id ? '#f0f8ff' : 'white'
                  }}
                  onClick={() => setSplitTargetTable(table)}
                >
                  <div style={{ textAlign: 'center' }}>
                    <Text strong>{table.tenBan || table.name}</Text>
                    <br />
                    <Text type="secondary" style={{ fontSize: 12 }}>
                      {table.status === 'available' ? 'Trống' : 'Có khách'}
                    </Text>
                  </div>
                </Card>
              ))}
            </div>

            {availableTablesForSplit.length === 0 && (
              <Alert
                message="Không có bàn trống"
                description="Không có bàn trống cùng khu vực để tách món."
                type="warning"
                showIcon
                style={{ marginTop: 16 }}
              />
            )}

            {splitTargetTable && (
              <Card size="small" style={{ marginTop: 16, background: '#f6ffed', borderColor: '#b7eb8f' }}>
                <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
                  <ArrowRight size={16} style={{ color: '#52c41a' }} />
                  <Text strong style={{ color: '#52c41a' }}>
                    Chuyển {selectedItemsForSplit.length} món sang bàn {splitTargetTable.tenBan}
                  </Text>
                </div>
              </Card>
            )}
          </div>
        )}
      </div>
    </Modal>
  );
};

export default TableSplitModal;