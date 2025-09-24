import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, List, Button, Row, Col, Typography, Input, message, Spin } from 'antd';
import { Package2, Search, Grid, Filter } from 'lucide-react';
import { getLoaiSanPham, getSanPhamTheoIdLoai, getAllSanPham } from '../../services/apiServices';
import './SanPham.css';

const { Title, Text } = Typography;
const { Search: SearchInput } = Input;

const SanPham = () => {
  const [categories, setCategories] = useState([]);
  const [products, setProducts] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [loading, setLoading] = useState(false);
  const [searchText, setSearchText] = useState('');

  // Load categories on mount
  useEffect(() => {
    loadCategories();
    loadAllProducts();
  }, []);

  const loadCategories = async () => {
    try {
  // Silent console
      const data = await getLoaiSanPham();
  // Silent console
      
      // Enhanced data processing with fallback patterns
      let processedCategories = [];
      
      if (Array.isArray(data)) {
        processedCategories = data;
  // Silent console
      } else if (data && data.success && Array.isArray(data.data)) {
        processedCategories = data.data;
  // Silent console
      } else if (data && typeof data === 'object') {
        // Try to convert object values to array
        processedCategories = Object.values(data);
  // Silent console
      } else {
  // Silent console
        processedCategories = [];
      }
      
      // Final validation and mapping
      const mappedCategories = processedCategories
        .filter(cat => cat && (cat.maLoai || cat.id || cat.idLoai))
        .map(cat => ({
          ...cat, // Keep original properties
          // Standardized properties for consistent access
          id: cat.maLoai || cat.id || cat.idLoai,
          name: cat.tenLoai || cat.moTa || cat.ten || 'Không có tên',
          // Original properties with fallbacks
          maLoai: cat.maLoai || cat.id || cat.idLoai,
          tenLoai: cat.tenLoai || cat.moTa || cat.ten || 'Không có tên'
        }));
      
      setCategories(mappedCategories);
  // Silent console
      
      // Show user-friendly message if no categories
      if (mappedCategories.length === 0) {
        message.warning('Không tìm thấy danh mục nào. Vui lòng kiểm tra kết nối API.');
      }
    } catch (error) {
  // Silent console
      console.error('Error details:', {
        message: error.message,
        stack: error.stack,
        response: error.response?.data
      });
      message.error('Không thể tải danh sách danh mục. Chi tiết: ' + error.message);
      setCategories([]);
    }
  };

  const loadAllProducts = async () => {
    setLoading(true);
    try {
  // Silent console
      const data = await getAllSanPham();
  // Silent console
      
      // Enhanced data processing with fallback patterns
      let processedProducts = [];
      
      if (Array.isArray(data)) {
        processedProducts = data;
  // Silent console
      } else if (data && data.success && Array.isArray(data.data)) {
        processedProducts = data.data;
  // Silent console
      } else if (data && typeof data === 'object') {
        // Try to convert object values to array
        processedProducts = Object.values(data);
  // Silent console
      } else {
  // Silent console
        processedProducts = [];
      }
      
      // Map and validate products
      const mappedProducts = processedProducts
        .filter(product => product && (product.maSanPham || product.id))
        .map(product => ({
          ...product, // Keep all original properties
          // Standardized properties for consistent access
          id: product.maSanPham || product.id,
          name: product.tenSanPham || product.ten || 'Sản phẩm không tên',
          // Enhanced properties
          displayName: product.tenSanPham || product.ten || 'Sản phẩm không tên',
          displayPrice: product.donGiaBan || product.gia || 0,
          displayImage: product.hinhAnh || product.image || null
        }));
      
      setProducts(mappedProducts);
  // Silent console
      
      // Show user-friendly message if no products
      if (mappedProducts.length === 0) {
        message.warning('Không tìm thấy sản phẩm nào. Vui lòng kiểm tra kết nối API.');
      }
    } catch (error) {
  // Silent console
      console.error('Error details:', {
        message: error.message,
        stack: error.stack,
        response: error.response?.data
      });
      message.error('Không thể tải danh sách sản phẩm. Chi tiết: ' + error.message);
      setProducts([]);
    } finally {
      setLoading(false);
    }
  };

  const loadProductsByCategory = async (categoryId) => {
    setLoading(true);
    try {
  // Silent console
      const data = await getSanPhamTheoIdLoai(categoryId);
  // Silent console
      
      // Enhanced data processing similar to loadAllProducts
      let processedProducts = [];
      
      if (Array.isArray(data)) {
        processedProducts = data;
  // Silent console
      } else if (data && data.success && Array.isArray(data.data)) {
        processedProducts = data.data;
  // Silent console
      } else if (data && typeof data === 'object') {
        processedProducts = Object.values(data);
  // Silent console
      } else {
  // Silent console
        processedProducts = [];
      }
      
      // Map and validate products
      const mappedProducts = processedProducts
        .filter(product => product && (product.maSanPham || product.id))
        .map(product => ({
          ...product,
          id: product.maSanPham || product.id,
          name: product.tenSanPham || product.ten || 'Sản phẩm không tên',
          displayName: product.tenSanPham || product.ten || 'Sản phẩm không tên',
          displayPrice: product.donGiaBan || product.gia || 0,
          displayImage: product.hinhAnh || product.image || null
        }));
      
      setProducts(mappedProducts);
  // Silent console
      
      if (mappedProducts.length === 0) {
        message.info(`Không có sản phẩm nào trong danh mục này.`);
      }
    } catch (error) {
  // Silent console
      console.error('Error details:', {
        message: error.message,
        categoryId: categoryId,
        response: error.response?.data
      });
      message.error('Không thể tải sản phẩm theo danh mục. Chi tiết: ' + error.message);
      setProducts([]);
    } finally {
      setLoading(false);
    }
  };

  const handleCategorySelect = (categoryId) => {
  // Silent console
    setSelectedCategory(categoryId);
    
    if (categoryId === null) {
  // Silent console
      loadAllProducts();
    } else {
  // Silent console
      loadProductsByCategory(categoryId);
    }
  };

  const filteredProducts = products.filter(product => {
    if (!searchText) return true;
    const searchLower = searchText.toLowerCase();
    return (
      (product.tenSanPham && product.tenSanPham.toLowerCase().includes(searchLower)) ||
      (product.maSanPham && product.maSanPham.toLowerCase().includes(searchLower))
    );
  });

  return (
    <div className="san-pham-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Điều khiển sản phẩm' },
          { title: 'Sản phẩm' }
        ]}
        className="page-breadcrumb"
      />
      
      <div className="san-pham-layout">
        {/* Left Sidebar - Categories */}
        <div className="category-sidebar">
          <Card 
            title={
              <div className="sidebar-title">
                <Filter size={16} />
                <span>Danh mục sản phẩm</span>
              </div>
            }
            className="category-card"
          >
            <div className="category-list">
              {/* Always show "All Products" option */}
              <div 
                className={`category-item ${selectedCategory === null ? 'active' : ''}`}
                onClick={() => handleCategorySelect(null)}
              >
                <Grid size={14} />
                <span>Tất cả sản phẩm</span>
                <span className="category-count">({products.length})</span>
              </div>
              
              {/* Show loading state for categories */}
              {loading && categories.length === 0 ? (
                <div className="category-loading">
                  <Spin size="small" />
                  <span style={{ marginLeft: 8 }}>Đang tải danh mục...</span>
                </div>
              ) : categories.length === 0 ? (
                <div className="category-empty">
                  <Text type="secondary" style={{ fontSize: 12 }}>
                    Chưa có danh mục nào
                  </Text>
                </div>
              ) : (
                categories.map(category => (
                  <div 
                    key={category.id || category.maLoai}
                    className={`category-item ${selectedCategory === (category.id || category.maLoai) ? 'active' : ''}`}
                    onClick={() => handleCategorySelect(category.id || category.maLoai)}
                    title={`Danh mục: ${category.name || category.tenLoai}`}
                  >
                    <Package2 size={14} />
                    <span>{category.name || category.tenLoai || 'Không có tên'}</span>
                  </div>
                ))
              )}
            </div>
          </Card>
        </div>

        {/* Main Content */}
        <div className="products-content">
          <Card 
            title={
              <div className="page-title">
                <Package2 size={20} />
                <span>Danh sách sản phẩm</span>
              </div>
            }
            extra={
              <SearchInput
                placeholder="Tìm kiếm sản phẩm..."
                allowClear
                value={searchText}
                onChange={(e) => setSearchText(e.target.value)}
                style={{ width: 300 }}
                prefix={<Search size={16} />}
              />
            }
            className="main-card"
          >
            <Spin spinning={loading}>
              {filteredProducts.length > 0 ? (
                <List
                  grid={{
                    gutter: 16,
                    xs: 1,
                    sm: 2,
                    md: 3,
                    lg: 4,
                    xl: 4,
                    xxl: 5,
                  }}
                  dataSource={filteredProducts}
                  renderItem={product => (
                    <List.Item>
                      <Card 
                        hoverable
                        className="product-card"
                        cover={
                          product.displayImage || product.hinhAnh ? (
                            <img 
                              alt={product.displayName || product.tenSanPham} 
                              src={product.displayImage || product.hinhAnh}
                              style={{ height: 200, objectFit: 'cover' }}
                              onError={(e) => {
                                e.target.style.display = 'none';
                                const fallback = e.target.parentNode.querySelector('.product-no-image');
                                if (fallback) fallback.style.display = 'flex';
                              }}
                            />
                          ) : (
                            <div className="product-no-image">
                              <Package2 size={48} />
                            </div>
                          )
                        }
                        actions={[
                          <Button type="link" size="small">Xem chi tiết</Button>,
                          <Button type="link" size="small">Chỉnh sửa</Button>
                        ]}
                      >
                        <Card.Meta 
                          title={product.displayName || product.tenSanPham || 'Không có tên'}
                          description={
                            <div className="product-info">
                              <Text type="secondary">
                                Mã: {product.maSanPham || product.id || 'N/A'}
                              </Text>
                              <br />
                              <Text strong>
                                Giá: {product.displayPrice || product.donGiaBan 
                                  ? `${Number(product.displayPrice || product.donGiaBan).toLocaleString('vi-VN')}đ` 
                                  : 'Chưa có giá'
                                }
                              </Text>
                            </div>
                          }
                        />
                      </Card>
                    </List.Item>
                  )}
                />
              ) : (
                <div className="empty-state">
                  <Package2 size={48} />
                  <Title level={4}>Không có sản phẩm</Title>
                  <Text type="secondary">
                    {searchText ? 'Không tìm thấy sản phẩm phù hợp với từ khóa tìm kiếm' : 'Chưa có sản phẩm nào trong danh mục này'}
                  </Text>
                </div>
              )}
            </Spin>
          </Card>
        </div>
      </div>
    </div>
  );
};

export default SanPham;
