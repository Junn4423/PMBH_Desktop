import React from 'react';
import { Card, List, Button, InputNumber, Typography, Space, Divider } from 'antd';
import { PlusOutlined, MinusOutlined, DeleteOutlined } from '@ant-design/icons';
import { useCart } from '../../contexts/CartContext';

const { Title, Text } = Typography;

const GioHang = () => {
  const {
    cartItems,
    total,
    finalTotal,
    discount,
    selectedTable,
    updateQuantity,
    removeFromCart,
    clearCart,
    setDiscount
  } = useCart();

  const handleQuantityChange = (cartId, newQuantity) => {
    if (newQuantity <= 0) {
      removeFromCart(cartId);
    } else {
      updateQuantity(cartId, newQuantity);
    }
  };

  return (
    <Card 
      title="Giỏ hàng"
      className="gio-hang"
      extra={
        cartItems.length > 0 && (
          <Button 
            type="text" 
            danger 
            size="small"
            onClick={clearCart}
          >
            Xóa tất cả
          </Button>
        )
      }
    >
      {selectedTable && (
        <div style={{ 
          background: '#f0f2f5', 
          padding: '8px 12px', 
          borderRadius: '6px',
          marginBottom: '16px'
        }}>
          <Text strong>Bàn: {selectedTable.ten}</Text>
        </div>
      )}

      {cartItems.length === 0 ? (
        <div style={{ 
          textAlign: 'center', 
          padding: '40px 20px',
          color: '#999'
        }}>
          <Text>Giỏ hàng trống</Text>
        </div>
      ) : (
        <>
          <List
            dataSource={cartItems}
            renderItem={(item) => (
              <List.Item
                style={{
                  padding: '12px 0',
                  borderBottom: '1px solid #f0f0f0',
                  flexDirection: 'column',
                  alignItems: 'stretch'
                }}
              >
                <div style={{ 
                  display: 'flex', 
                  justifyContent: 'space-between',
                  alignItems: 'center',
                  marginBottom: '8px'
                }}>
                  <div style={{ flex: 1 }}>
                    <Text strong>{item.ten}</Text>
                    <div style={{ color: '#666', fontSize: '12px' }}>
                      {item.gia.toLocaleString()}đ
                    </div>
                  </div>
                  
                  <Space>
                    <Button
                      size="small"
                      icon={<MinusOutlined />}
                      onClick={() => handleQuantityChange(item.cartId, item.soLuong - 1)}
                    />
                    <InputNumber
                      size="small"
                      min={1}
                      value={item.soLuong}
                      onChange={(value) => handleQuantityChange(item.cartId, value)}
                      style={{ width: '60px' }}
                    />
                    <Button
                      size="small"
                      icon={<PlusOutlined />}
                      onClick={() => handleQuantityChange(item.cartId, item.soLuong + 1)}
                    />
                    <Button
                      size="small"
                      type="text"
                      danger
                      icon={<DeleteOutlined />}
                      onClick={() => removeFromCart(item.cartId)}
                    />
                  </Space>
                </div>
                
                <div style={{ 
                  textAlign: 'right',
                  fontWeight: 'bold',
                  color: '#1890ff'
                }}>
                  {(item.gia * item.soLuong).toLocaleString()}đ
                </div>
              </List.Item>
            )}
          />

          <Divider />

          <div className="cart-summary">
            <div style={{ 
              display: 'flex', 
              justifyContent: 'space-between',
              marginBottom: '8px'
            }}>
              <Text>Tổng tiền:</Text>
              <Text strong>{total.toLocaleString()}đ</Text>
            </div>
            
            <div style={{ 
              display: 'flex', 
              justifyContent: 'space-between',
              alignItems: 'center',
              marginBottom: '12px'
            }}>
              <Text>Giảm giá:</Text>
              <InputNumber
                size="small"
                min={0}
                max={100}
                value={discount}
                onChange={setDiscount}
                formatter={value => `${value}%`}
                parser={value => value.replace('%', '')}
                style={{ width: '80px' }}
              />
            </div>

            <Divider style={{ margin: '12px 0' }} />

            <div style={{ 
              display: 'flex', 
              justifyContent: 'space-between',
              alignItems: 'center'
            }}>
              <Title level={4} style={{ margin: 0 }}>Thành tiền:</Title>
              <Title level={4} style={{ margin: 0, color: '#1890ff' }}>
                {finalTotal.toLocaleString()}đ
              </Title>
            </div>
          </div>
        </>
      )}
    </Card>
  );
};

export default GioHang;
