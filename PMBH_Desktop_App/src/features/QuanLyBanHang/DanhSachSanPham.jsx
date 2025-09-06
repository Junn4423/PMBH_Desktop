import React, { useState } from 'react';
import { Card, Row, Col, Button, Modal, Form, Input, Select, Space, Typography, message } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, CoffeeOutlined } from '@ant-design/icons';
import { useCart } from '../../contexts/CartContext';

const { Title, Text } = Typography;
const { Option } = Select;

const DanhSachSanPham = ({ products = [], onProductSelect }) => {
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('all');
  const { addToCart } = useCart();

  const categories = [
    { value: 'all', label: 'Tất cả' },
    { value: 'coffee', label: 'Cà phê' },
    { value: 'tea', label: 'Trà' },
    { value: 'juice', label: 'Nước ép' },
    { value: 'cake', label: 'Bánh ngọt' },
    { value: 'other', label: 'Khác' }
  ];

  const filteredProducts = products.filter(product => {
    const matchesSearch = product.ten.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesCategory = selectedCategory === 'all' || product.danhMuc === selectedCategory;
    return matchesSearch && matchesCategory;
  });

  const handleProductClick = (product) => {
    addToCart(product);
    message.success(`Đã thêm ${product.ten} vào giỏ hàng`);
    if (onProductSelect) {
      onProductSelect(product);
    }
  };

  return (
    <Card title="Danh sách sản phẩm" className="danh-sach-san-pham">
      <div style={{ marginBottom: 16 }}>
        <Row gutter={[12, 12]}>
          <Col xs={24} md={12}>
            <Input
              placeholder="Tìm kiếm sản phẩm..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              allowClear
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

      <Row gutter={[12, 12]}>
        {filteredProducts.map(product => (
          <Col xs={12} sm={8} md={6} lg={4} key={product.id}>
            <Card
              size="small"
              className="product-card"
              onClick={() => handleProductClick(product)}
              hoverable
              style={{ 
                cursor: 'pointer',
                textAlign: 'center',
                height: '140px'
              }}
            >
              <div style={{ 
                height: '60px', 
                display: 'flex', 
                alignItems: 'center', 
                justifyContent: 'center',
                marginBottom: '8px'
              }}>
                <div style={{
                  width: '50px',
                  height: '50px',
                  borderRadius: '50%',
                  background: 'linear-gradient(135deg, #1890ff, #096dd9)',
                  color: 'white',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontWeight: 'bold',
                  fontSize: '18px'
                }}>
                  {product.ten.charAt(0)}
                </div>
              </div>
              <Text strong style={{ display: 'block', fontSize: '12px', marginBottom: '4px' }}>
                {product.ten}
              </Text>
              <Text style={{ color: '#1890ff', fontWeight: 'bold', fontSize: '14px' }}>
                {product.gia.toLocaleString()}đ
              </Text>
            </Card>
          </Col>
        ))}
      </Row>

      {filteredProducts.length === 0 && (
        <div style={{ textAlign: 'center', padding: '40px', color: '#999' }}>
          <CoffeeOutlined style={{ fontSize: '48px', marginBottom: '16px' }} />
          <div>Không tìm thấy sản phẩm nào</div>
        </div>
      )}
    </Card>
  );
};

export default DanhSachSanPham;
