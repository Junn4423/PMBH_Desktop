import React, { useState, useEffect } from 'react';
import { 
  Card, List, Button, InputNumber, Input, Space, Typography, 
  Row, Col, Image, Tag, Modal, message, Divider, Empty,
  Tooltip, Popconfirm
} from 'antd';
import {
  DeleteOutlined, EditOutlined, PlusOutlined, MinusOutlined,
  ShoppingCartOutlined, ClearOutlined, CommentOutlined
} from '@ant-design/icons';
import { useGoiMon } from '../../hooks/useGoiMon';

const { Title, Text } = Typography;
const { TextArea } = Input;

const GioHang = ({ banId, visible, onClose, onCheckout }) => {
  const [editingItem, setEditingItem] = useState(null);
  const [noteModalVisible, setNoteModalVisible] = useState(false);
  const [tempNote, setTempNote] = useState('');
  
  const {
    gioHang,
    tongTien,
    soLuongMon,
    capNhatSoLuong,
    capNhatGhiChu,
    xoaKhoiGioHang,
    xoaGioHang,
    tinhTongTien
  } = useGoiMon();

  useEffect(() => {
    tinhTongTien();
  }, [gioHang]);

  const handleQuantityChange = (itemId, newQuantity) => {
    if (newQuantity <= 0) {
      handleDeleteItem(itemId);
    } else {
      capNhatSoLuong(itemId, newQuantity);
    }
  };

  const handleDeleteItem = (itemId) => {
    xoaKhoiGioHang(itemId);
    message.success('Đã xóa món khỏi giỏ hàng');
  };

  const handleClearCart = () => {
    Modal.confirm({
      title: 'Xóa toàn bộ giỏ hàng',
      content: 'Bạn có chắc chắn muốn xóa tất cả món trong giỏ hàng?',
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: () => {
        xoaGioHang();
        message.success('Đã xóa toàn bộ giỏ hàng');
      }
    });
  };

  const handleAddNote = (item) => {
    setEditingItem(item);
    setTempNote(item.ghiChu || '');
    setNoteModalVisible(true);
  };

  const handleSaveNote = () => {
    if (editingItem) {
      capNhatGhiChu(editingItem.sanPhamId, tempNote);
      message.success('Đã cập nhật ghi chú');
    }
    setNoteModalVisible(false);
    setEditingItem(null);
    setTempNote('');
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const renderCartItem = (item) => (
    <List.Item
      key={item.sanPhamId}
      className="cart-item"
      actions={[
        <Tooltip title="Thêm ghi chú">
          <Button 
            type="text" 
            icon={<CommentOutlined />}
            onClick={() => handleAddNote(item)}
            style={{ color: item.ghiChu ? '#1890ff' : '#d9d9d9' }}
          />
        </Tooltip>,
        <Popconfirm
          title="Xóa món này khỏi giỏ hàng?"
          onConfirm={() => handleDeleteItem(item.sanPhamId)}
          okText="Xóa"
          cancelText="Hủy"
        >
          <Button 
            type="text" 
            danger 
            icon={<DeleteOutlined />}
          />
        </Popconfirm>
      ]}
    >
      <List.Item.Meta
        avatar={
          <Image
            src={item.hinhAnh || '/images/no-image.png'}
            alt={item.tenSanPham}
            width={60}
            height={60}
            preview={false}
            fallback="/images/no-image.png"
            style={{ borderRadius: 8 }}
          />
        }
        title={
          <Space direction="vertical" size="small" style={{ width: '100%' }}>
            <Text strong>{item.tenSanPham}</Text>
            {item.ghiChu && (
              <Text type="secondary" style={{ fontSize: 12 }}>
                <CommentOutlined /> {item.ghiChu}
              </Text>
            )}
          </Space>
        }
        description={
          <Space direction="vertical" size="small" style={{ width: '100%' }}>
            <Row justify="space-between" align="middle">
              <Col>
                <Text style={{ color: '#1890ff' }}>
                  {formatPrice(item.giaBan)} VNĐ
                </Text>
              </Col>
              <Col>
                <Space>
                  <Button
                    size="small"
                    icon={<MinusOutlined />}
                    onClick={() => handleQuantityChange(item.sanPhamId, item.soLuong - 1)}
                  />
                  <InputNumber
                    size="small"
                    min={1}
                    value={item.soLuong}
                    onChange={(value) => handleQuantityChange(item.sanPhamId, value)}
                    style={{ width: 60 }}
                  />
                  <Button
                    size="small"
                    icon={<PlusOutlined />}
                    onClick={() => handleQuantityChange(item.sanPhamId, item.soLuong + 1)}
                  />
                </Space>
              </Col>
            </Row>
            <Row justify="space-between" align="middle">
              <Col>
                <Text type="secondary">Thành tiền:</Text>
              </Col>
              <Col>
                <Text strong style={{ color: '#f5222d' }}>
                  {formatPrice(item.giaBan * item.soLuong)} VNĐ
                </Text>
              </Col>
            </Row>
          </Space>
        }
      />
    </List.Item>
  );

  return (
    <>
      <Modal
        title={
          <Space>
            <ShoppingCartOutlined />
            Giỏ hàng
            {soLuongMon > 0 && (
              <Tag color="blue">{soLuongMon} món</Tag>
            )}
          </Space>
        }
        open={visible}
        onCancel={onClose}
        width={700}
        footer={null}
        destroyOnClose
      >
        <div className="gio-hang-content">
          {gioHang.length > 0 ? (
            <>
              {/* Header actions */}
              <Row justify="space-between" align="middle" style={{ marginBottom: 16 }}>
                <Col>
                  <Text type="secondary">
                    {soLuongMon} món • {formatPrice(tongTien)} VNĐ
                  </Text>
                </Col>
                <Col>
                  <Button 
                    danger 
                    icon={<ClearOutlined />}
                    onClick={handleClearCart}
                    disabled={gioHang.length === 0}
                  >
                    Xóa tất cả
                  </Button>
                </Col>
              </Row>

              {/* Cart items */}
              <div className="cart-items" style={{ maxHeight: 400, overflowY: 'auto' }}>
                <List
                  dataSource={gioHang}
                  renderItem={renderCartItem}
                  split={false}
                />
              </div>

              <Divider />

              {/* Summary */}
              <div className="cart-summary">
                <Row justify="space-between" align="middle" style={{ marginBottom: 8 }}>
                  <Col>
                    <Text>Tạm tính:</Text>
                  </Col>
                  <Col>
                    <Text>{formatPrice(tongTien)} VNĐ</Text>
                  </Col>
                </Row>
                
                <Row justify="space-between" align="middle" style={{ marginBottom: 8 }}>
                  <Col>
                    <Text>Thuế VAT (10%):</Text>
                  </Col>
                  <Col>
                    <Text>{formatPrice(tongTien * 0.1)} VNĐ</Text>
                  </Col>
                </Row>

                <Divider style={{ margin: '8px 0' }} />

                <Row justify="space-between" align="middle" style={{ marginBottom: 16 }}>
                  <Col>
                    <Text strong style={{ fontSize: 16 }}>Tổng cộng:</Text>
                  </Col>
                  <Col>
                    <Text strong style={{ fontSize: 16, color: '#f5222d' }}>
                      {formatPrice(tongTien * 1.1)} VNĐ
                    </Text>
                  </Col>
                </Row>

                {/* Actions */}
                <Row gutter={16}>
                  <Col span={12}>
                    <Button 
                      block 
                      onClick={onClose}
                    >
                      Tiếp tục gọi món
                    </Button>
                  </Col>
                  <Col span={12}>
                    <Button 
                      type="primary" 
                      block
                      onClick={() => {
                        onCheckout?.(gioHang, tongTien * 1.1);
                        onClose?.();
                      }}
                    >
                      Xác nhận đơn hàng
                    </Button>
                  </Col>
                </Row>
              </div>
            </>
          ) : (
            <div style={{ textAlign: 'center', padding: '60px 0' }}>
              <Empty 
                image={Empty.PRESENTED_IMAGE_SIMPLE}
                description="Giỏ hàng trống"
              >
                <Button type="primary" onClick={onClose}>
                  Bắt đầu gọi món
                </Button>
              </Empty>
            </div>
          )}
        </div>
      </Modal>

      {/* Note Modal */}
      <Modal
        title="Thêm ghi chú"
        open={noteModalVisible}
        onOk={handleSaveNote}
        onCancel={() => {
          setNoteModalVisible(false);
          setEditingItem(null);
          setTempNote('');
        }}
        okText="Lưu"
        cancelText="Hủy"
      >
        <div>
          <Text strong>{editingItem?.tenSanPham}</Text>
          <TextArea
            rows={3}
            value={tempNote}
            onChange={(e) => setTempNote(e.target.value)}
            placeholder="Nhập ghi chú cho món này..."
            maxLength={200}
            showCount
            style={{ marginTop: 8 }}
          />
        </div>
      </Modal>
    </>
  );
};

export default GioHang;
