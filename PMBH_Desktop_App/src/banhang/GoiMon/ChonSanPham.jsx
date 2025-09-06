import React, { useState, useEffect } from 'react';
import { 
  Row, Col, Card, Input, Select, Button, Badge, Typography, 
  Space, Image, Tag, Spin, Empty, message, InputNumber 
} from 'antd';
import {
  SearchOutlined, PlusOutlined, MinusOutlined, ShoppingCartOutlined,
  FilterOutlined, AppstoreOutlined, BarsOutlined
} from '@ant-design/icons';
import { useSanPham } from '../../hooks/useSanPham';
import { useGoiMon } from '../../hooks/useGoiMon';

const { Title, Text } = Typography;
const { Option } = Select;

const ChonSanPham = ({ banId, onProductSelect }) => {
  const [searchText, setSearchText] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [viewMode, setViewMode] = useState('grid'); // 'grid' or 'list'
  const [sortBy, setSortBy] = useState('name');
  
  const {
    danhSachSanPham,
    danhSachDanhMuc,
    loading,
    getDanhSachSanPham,
    getDanhSachDanhMuc
  } = useSanPham();

  const {
    gioHang,
    themVaoGioHang,
    capNhatSoLuong,
    xoaKhoiGioHang
  } = useGoiMon();

  useEffect(() => {
    getDanhSachSanPham();
    getDanhSachDanhMuc();
  }, []);

  // Filter và sort sản phẩm
  const filteredProducts = danhSachSanPham?.filter(product => {
    const matchSearch = product.tenSanPham.toLowerCase().includes(searchText.toLowerCase()) ||
                       product.maSanPham?.toLowerCase().includes(searchText.toLowerCase());
    
    const matchCategory = selectedCategory === 'all' || product.danhMucId === selectedCategory;
    
    const isAvailable = product.trangThai === 'hoat_dong' && product.soLuongTon > 0;
    
    return matchSearch && matchCategory && isAvailable;
  }).sort((a, b) => {
    switch (sortBy) {
      case 'name':
        return a.tenSanPham.localeCompare(b.tenSanPham);
      case 'price_asc':
        return a.giaBan - b.giaBan;
      case 'price_desc':
        return b.giaBan - a.giaBan;
      case 'popular':
        return (b.soLuongDaBan || 0) - (a.soLuongDaBan || 0);
      default:
        return 0;
    }
  });

  const handleAddToCart = (product) => {
    const cartItem = {
      sanPhamId: product.id,
      tenSanPham: product.tenSanPham,
      giaBan: product.giaBan,
      soLuong: 1,
      ghiChu: '',
      hinhAnh: product.hinhAnh
    };
    
    themVaoGioHang(cartItem);
    message.success(`Đã thêm ${product.tenSanPham} vào giỏ hàng`);
    onProductSelect?.(cartItem);
  };

  const handleQuantityChange = (productId, newQuantity) => {
    if (newQuantity <= 0) {
      xoaKhoiGioHang(productId);
    } else {
      capNhatSoLuong(productId, newQuantity);
    }
  };

  const getProductQuantityInCart = (productId) => {
    const cartItem = gioHang.find(item => item.sanPhamId === productId);
    return cartItem ? cartItem.soLuong : 0;
  };

  const renderProductCard = (product) => {
    const quantityInCart = getProductQuantityInCart(product.id);
    
    return (
      <Card
        key={product.id}
        className="product-card"
        hoverable
        cover={
          <div className="product-image-container">
            <Image
              src={product.hinhAnh || '/images/no-image.png'}
              alt={product.tenSanPham}
              height={200}
              preview={false}
              fallback="/images/no-image.png"
            />
            {product.isNew && (
              <Tag color="red" className="product-tag-new">Mới</Tag>
            )}
            {product.khuyenMai && (
              <Tag color="orange" className="product-tag-sale">
                -{product.khuyenMai}%
              </Tag>
            )}
          </div>
        }
        actions={[
          quantityInCart > 0 ? (
            <Space key="quantity-control">
              <Button 
                size="small" 
                icon={<MinusOutlined />}
                onClick={() => handleQuantityChange(product.id, quantityInCart - 1)}
              />
              <span style={{ minWidth: 20, textAlign: 'center' }}>{quantityInCart}</span>
              <Button 
                size="small" 
                icon={<PlusOutlined />}
                onClick={() => handleQuantityChange(product.id, quantityInCart + 1)}
              />
            </Space>
          ) : (
            <Button 
              key="add"
              type="primary" 
              icon={<PlusOutlined />}
              onClick={() => handleAddToCart(product)}
              disabled={product.soLuongTon <= 0}
            >
              Thêm
            </Button>
          )
        ]}
      >
        <Card.Meta
          title={
            <div className="product-title">
              <Text strong ellipsis>{product.tenSanPham}</Text>
              {quantityInCart > 0 && (
                <Badge count={quantityInCart} showZero />
              )}
            </div>
          }
          description={
            <Space direction="vertical" size="small" style={{ width: '100%' }}>
              <Text type="secondary" ellipsis>
                {product.moTa}
              </Text>
              <div className="product-price">
                {product.giaKhuyenMai ? (
                  <>
                    <Text delete type="secondary">
                      {product.giaBan?.toLocaleString()} VNĐ
                    </Text>
                    <Text strong style={{ color: '#ff4d4f', marginLeft: 8 }}>
                      {product.giaKhuyenMai?.toLocaleString()} VNĐ
                    </Text>
                  </>
                ) : (
                  <Text strong style={{ color: '#1890ff' }}>
                    {product.giaBan?.toLocaleString()} VNĐ
                  </Text>
                )}
              </div>
              <Text type="secondary" style={{ fontSize: 12 }}>
                Còn lại: {product.soLuongTon}
              </Text>
            </Space>
          }
        />
      </Card>
    );
  };

  const renderProductList = (product) => {
    const quantityInCart = getProductQuantityInCart(product.id);
    
    return (
      <Card key={product.id} className="product-list-item" size="small">
        <Row align="middle" gutter={16}>
          <Col span={4}>
            <Image
              src={product.hinhAnh || '/images/no-image.png'}
              alt={product.tenSanPham}
              height={80}
              preview={false}
              fallback="/images/no-image.png"
            />
          </Col>
          <Col span={12}>
            <Space direction="vertical" size="small">
              <Text strong>{product.tenSanPham}</Text>
              <Text type="secondary" ellipsis>
                {product.moTa}
              </Text>
              <div className="product-price">
                {product.giaKhuyenMai ? (
                  <>
                    <Text delete type="secondary">
                      {product.giaBan?.toLocaleString()} VNĐ
                    </Text>
                    <Text strong style={{ color: '#ff4d4f', marginLeft: 8 }}>
                      {product.giaKhuyenMai?.toLocaleString()} VNĐ
                    </Text>
                  </>
                ) : (
                  <Text strong style={{ color: '#1890ff' }}>
                    {product.giaBan?.toLocaleString()} VNĐ
                  </Text>
                )}
              </div>
            </Space>
          </Col>
          <Col span={4}>
            <Text type="secondary">Còn: {product.soLuongTon}</Text>
          </Col>
          <Col span={4}>
            {quantityInCart > 0 ? (
              <Space>
                <Button 
                  size="small" 
                  icon={<MinusOutlined />}
                  onClick={() => handleQuantityChange(product.id, quantityInCart - 1)}
                />
                <span>{quantityInCart}</span>
                <Button 
                  size="small" 
                  icon={<PlusOutlined />}
                  onClick={() => handleQuantityChange(product.id, quantityInCart + 1)}
                />
              </Space>
            ) : (
              <Button 
                type="primary" 
                icon={<PlusOutlined />}
                onClick={() => handleAddToCart(product)}
                disabled={product.soLuongTon <= 0}
              >
                Thêm
              </Button>
            )}
          </Col>
        </Row>
      </Card>
    );
  };

  return (
    <div className="chon-san-pham">
      {/* Header filters */}
      <Card className="filter-card">
        <Row gutter={16} align="middle">
          <Col span={8}>
            <Input
              placeholder="Tìm kiếm sản phẩm..."
              prefix={<SearchOutlined />}
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
              allowClear
            />
          </Col>
          <Col span={6}>
            <Select
              style={{ width: '100%' }}
              placeholder="Chọn danh mục"
              value={selectedCategory}
              onChange={setSelectedCategory}
              allowClear
            >
              <Option value="all">Tất cả danh mục</Option>
              {danhSachDanhMuc?.map(category => (
                <Option key={category.id} value={category.id}>
                  {category.tenDanhMuc}
                </Option>
              ))}
            </Select>
          </Col>
          <Col span={6}>
            <Select
              style={{ width: '100%' }}
              placeholder="Sắp xếp theo"
              value={sortBy}
              onChange={setSortBy}
            >
              <Option value="name">Tên A-Z</Option>
              <Option value="price_asc">Giá thấp đến cao</Option>
              <Option value="price_desc">Giá cao đến thấp</Option>
              <Option value="popular">Bán chạy</Option>
            </Select>
          </Col>
          <Col span={4}>
            <Space>
              <Button
                type={viewMode === 'grid' ? 'primary' : 'default'}
                icon={<AppstoreOutlined />}
                onClick={() => setViewMode('grid')}
              />
              <Button
                type={viewMode === 'list' ? 'primary' : 'default'}
                icon={<BarsOutlined />}
                onClick={() => setViewMode('list')}
              />
            </Space>
          </Col>
        </Row>
      </Card>

      {/* Products display */}
      <div className="products-container">
        {loading ? (
          <div style={{ textAlign: 'center', padding: '60px 0' }}>
            <Spin size="large" />
          </div>
        ) : filteredProducts?.length > 0 ? (
          viewMode === 'grid' ? (
            <Row gutter={[16, 16]}>
              {filteredProducts.map(product => (
                <Col key={product.id} xs={24} sm={12} md={8} lg={6} xl={4}>
                  {renderProductCard(product)}
                </Col>
              ))}
            </Row>
          ) : (
            <Space direction="vertical" style={{ width: '100%' }} size="small">
              {filteredProducts.map(product => renderProductList(product))}
            </Space>
          )
        ) : (
          <Empty 
            description="Không tìm thấy sản phẩm nào"
            image={Empty.PRESENTED_IMAGE_SIMPLE}
          />
        )}
      </div>

      {/* Cart summary */}
      {gioHang.length > 0 && (
        <div className="cart-summary-fixed">
          <Badge count={gioHang.reduce((total, item) => total + item.soLuong, 0)}>
            <Button 
              type="primary" 
              size="large" 
              icon={<ShoppingCartOutlined />}
              onClick={() => {
                // TODO: Open cart detail
                console.log('Open cart detail');
              }}
            >
              Giỏ hàng ({gioHang.reduce((total, item) => total + (item.giaBan * item.soLuong), 0).toLocaleString()} VNĐ)
            </Button>
          </Badge>
        </div>
      )}
    </div>
  );
};

export default ChonSanPham;
