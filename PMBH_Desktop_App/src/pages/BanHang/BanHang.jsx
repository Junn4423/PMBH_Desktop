import React, { useState, useEffect } from 'react';
import { Row, Col, Card, Input, Select, Button, List, Typography, InputNumber, Space, Tag, Divider, message } from 'antd';
import { SearchOutlined, PlusOutlined, MinusOutlined, DeleteOutlined, PrinterOutlined } from '@ant-design/icons';
import { useCart } from '../../contexts/CartContext';
import ChonBan from '../../components/BanHang/ChonBan/ChonBan';
import './BanHang.css';

const { Title, Text } = Typography;
const { Option } = Select;

const BanHang = () => {
  const {
    cartItems,
    selectedTable,
    customer,
    discount,
    total,
    finalTotal,
    addToCart,
    updateQuantity,
    removeFromCart,
    clearCart,
    setCustomer,
    setDiscount,
    saveOrder
  } = useCart();

  const [products, setProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [showTableSelection, setShowTableSelection] = useState(false);

  const categories = [
    { value: 'all', label: 'Tất cả' },
    { value: 'coffee', label: 'Cà phê' },
    { value: 'tea', label: 'Trà' },
    { value: 'juice', label: 'Nước ép' },
    { value: 'cake', label: 'Bánh ngọt' },
    { value: 'other', label: 'Khác' }
  ];

  // Dữ liệu mẫu sản phẩm
  useEffect(() => {
    const sampleProducts = [
      {
        id: 1,
        ten: 'Cà phê đen',
        gia: 15000,
        danhMuc: 'coffee',
        moTa: 'Cà phê đen truyền thống',
        hinhAnh: '/images/coffee-black.jpg'
      },
      {
        id: 2,
        ten: 'Cà phê sữa',
        gia: 18000,
        danhMuc: 'coffee',
        moTa: 'Cà phê sữa đậm đà',
        hinhAnh: '/images/coffee-milk.jpg'
      },
      {
        id: 3,
        ten: 'Trà sữa',
        gia: 25000,
        danhMuc: 'tea',
        moTa: 'Trà sữa thơm ngon',
        hinhAnh: '/images/milk-tea.jpg'
      },
      {
        id: 4,
        ten: 'Nước ép cam',
        gia: 20000,
        danhMuc: 'juice',
        moTa: 'Nước ép cam tươi',
        hinhAnh: '/images/orange-juice.jpg'
      },
      {
        id: 5,
        ten: 'Bánh tiramisu',
        gia: 35000,
        danhMuc: 'cake',
        moTa: 'Bánh tiramisu Italy',
        hinhAnh: '/images/tiramisu.jpg'
      },
      {
        id: 6,
        ten: 'Cappuccino',
        gia: 22000,
        danhMuc: 'coffee',
        moTa: 'Cappuccino Italy',
        hinhAnh: '/images/cappuccino.jpg'
      }
    ];
    
    setProducts(sampleProducts);
    setFilteredProducts(sampleProducts);
  }, []);

  // Lọc sản phẩm
  useEffect(() => {
    let filtered = products;

    // Lọc theo danh mục
    if (selectedCategory !== 'all') {
      filtered = filtered.filter(product => product.danhMuc === selectedCategory);
    }

    // Lọc theo từ khóa tìm kiếm
    if (searchTerm) {
      filtered = filtered.filter(product =>
        product.ten.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }

    setFilteredProducts(filtered);
  }, [products, selectedCategory, searchTerm]);

  const handleAddToCart = (product) => {
    addToCart(product);
    message.success(`Đã thêm ${product.ten} vào giỏ hàng`);
  };

  const handleQuantityChange = (cartId, newQuantity) => {
    updateQuantity(cartId, newQuantity);
  };

  const handleRemoveItem = (cartId) => {
    removeFromCart(cartId);
    message.success('Đã xóa món khỏi giỏ hàng');
  };

  const handleSaveOrder = async () => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn');
      return;
    }

    if (cartItems.length === 0) {
      message.error('Giỏ hàng trống');
      return;
    }

    try {
      await saveOrder();
      message.success('Đã lưu đơn hàng thành công');
    } catch (error) {
      message.error(error.message);
    }
  };

  const handlePrintOrder = () => {
    // Logic in hóa đơn
    message.info('Chức năng in hóa đơn đang được phát triển');
  };

  return (
    <div className="ban-hang">
      <Row gutter={[16, 16]} style={{ height: '100%' }}>
        {/* Danh sách sản phẩm */}
        <Col xs={24} lg={14}>
          <Card title="Thực đơn" className="products-card">
            <div className="products-filter">
              <Row gutter={[12, 12]}>
                <Col xs={24} md={12}>
                  <Input
                    placeholder="Tìm kiếm món..."
                    prefix={<SearchOutlined />}
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                  />
                </Col>
                <Col xs={24} md={12}>
                  <Select
                    value={selectedCategory}
                    onChange={setSelectedCategory}
                    style={{ width: '100%' }}
                  >
                    {categories.map(category => (
                      <Option key={category.value} value={category.value}>
                        {category.label}
                      </Option>
                    ))}
                  </Select>
                </Col>
              </Row>
            </div>

            <div className="products-grid">
              <Row gutter={[12, 12]}>
                {filteredProducts.map(product => (
                  <Col xs={12} sm={8} md={6} key={product.id}>
                    <Card
                      size="small"
                      className="product-item"
                      onClick={() => handleAddToCart(product)}
                      hoverable
                    >
                      <div className="product-image">
                        <div className="product-placeholder">
                          {product.ten.charAt(0)}
                        </div>
                      </div>
                      <div className="product-info">
                        <Text strong className="product-name">
                          {product.ten}
                        </Text>
                        <div className="product-price">
                          {product.gia.toLocaleString()}đ
                        </div>
                      </div>
                    </Card>
                  </Col>
                ))}
              </Row>
            </div>
          </Card>
        </Col>

        {/* Giỏ hàng */}
        <Col xs={24} lg={10}>
          <Card title="Giỏ hàng" className="cart-card">
            <div className="cart-header">
              <Space style={{ width: '100%', justifyContent: 'space-between' }}>
                <Button
                  type="primary"
                  ghost
                  onClick={() => setShowTableSelection(true)}
                >
                  {selectedTable ? `${selectedTable.ten}` : 'Chọn bàn'}
                </Button>
                {cartItems.length > 0 && (
                  <Button
                    type="text"
                    danger
                    onClick={clearCart}
                    icon={<DeleteOutlined />}
                  >
                    Xóa tất cả
                  </Button>
                )}
              </Space>
            </div>

            <Divider />

            <div className="cart-items">
              {cartItems.length === 0 ? (
                <div className="empty-cart">
                  <Text type="secondary">Giỏ hàng trống</Text>
                </div>
              ) : (
                <List
                  dataSource={cartItems}
                  renderItem={(item) => (
                    <List.Item className="cart-item">
                      <div className="cart-item-content">
                        <div className="cart-item-info">
                          <Text strong>{item.ten}</Text>
                          <div className="cart-item-price">
                            {item.gia.toLocaleString()}đ
                          </div>
                        </div>
                        <div className="cart-item-controls">
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
                            style={{ width: '60px', margin: '0 8px' }}
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
                            onClick={() => handleRemoveItem(item.cartId)}
                            style={{ marginLeft: 8 }}
                          />
                        </div>
                      </div>
                      <div className="cart-item-total">
                        {(item.gia * item.soLuong).toLocaleString()}đ
                      </div>
                    </List.Item>
                  )}
                />
              )}
            </div>

            {cartItems.length > 0 && (
              <>
                <Divider />
                <div className="cart-summary">
                  <div className="summary-row">
                    <Text>Tổng tiền:</Text>
                    <Text strong>{total.toLocaleString()}đ</Text>
                  </div>
                  
                  <div className="summary-row">
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

                  <div className="summary-row total-row">
                    <Title level={4} style={{ margin: 0 }}>Thành tiền:</Title>
                    <Title level={4} style={{ margin: 0, color: '#1890ff' }}>
                      {finalTotal.toLocaleString()}đ
                    </Title>
                  </div>

                  <div className="cart-actions">
                    <Space style={{ width: '100%' }} direction="vertical">
                      <Button
                        type="primary"
                        size="large"
                        block
                        onClick={handleSaveOrder}
                        disabled={!selectedTable || cartItems.length === 0}
                      >
                        Lưu đơn hàng
                      </Button>
                      <Button
                        type="default"
                        size="large"
                        block
                        icon={<PrinterOutlined />}
                        onClick={handlePrintOrder}
                        disabled={cartItems.length === 0}
                      >
                        In hóa đơn
                      </Button>
                    </Space>
                  </div>
                </div>
              </>
            )}
          </Card>
        </Col>
      </Row>

      {/* Modal chọn bàn */}
      <ChonBan
        visible={showTableSelection}
        onClose={() => setShowTableSelection(false)}
      />
    </div>
  );
};

export default BanHang;
