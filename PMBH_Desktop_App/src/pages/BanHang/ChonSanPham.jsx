import React, { useState, useEffect } from 'react';
import { Card, Row, Col, Input, Select, Typography, Spin, message } from 'antd';
import { Search } from 'lucide-react';
import { getAllSanPham, getLoaiSanPham } from '../../services/apiServices';

const { Text } = Typography;
const { Option } = Select;

const ChonSanPham = ({ onAddToCart }) => {
  const [products, setProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [categories, setCategories] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    loadCategoriesAndProducts();
  }, []);

  // Filter sản phẩm khi thay đổi search term hoặc category
  useEffect(() => {
    let filtered = products;
    
    if (searchTerm) {
      filtered = filtered.filter(product =>
        product.ten && product.ten.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }
    
    if (selectedCategory !== 'all') {
      filtered = filtered.filter(product => 
        product.danhMuc === selectedCategory
      );
    }
    
    setFilteredProducts(filtered);
  }, [searchTerm, selectedCategory, products]);

  const loadCategoriesAndProducts = async () => {
    try {
      setLoading(true);

      // Load danh mục sản phẩm
      const categoriesResponse = await getLoaiSanPham();
      console.log('Categories response:', categoriesResponse);
      
      // Xử lý dữ liệu categories
      let categoriesData = [];
      if (Array.isArray(categoriesResponse)) {
        categoriesData = categoriesResponse;
      } else if (categoriesResponse && categoriesResponse.success && categoriesResponse.data) {
        if (Array.isArray(categoriesResponse.data)) {
          categoriesData = categoriesResponse.data;
        } else if (typeof categoriesResponse.data === 'object') {
          categoriesData = Object.values(categoriesResponse.data);
        }
      } else if (categoriesResponse && typeof categoriesResponse === 'object') {
        categoriesData = Object.values(categoriesResponse);
      }

      const allCategories = [
        { value: 'all', label: 'Tất cả' },
        ...categoriesData.map(cat => ({
          value: cat.idLoaiSp || cat.id || cat.maLoai,
          label: cat.tenLoaiSp || cat.ten || cat.tenLoai
        }))
      ];
      setCategories(allCategories);

      // Load tất cả sản phẩm
      const productsResponse = await getAllSanPham();
      console.log('Products response:', productsResponse);
      
      // Xử lý dữ liệu products
      let productsData = [];
      if (Array.isArray(productsResponse)) {
        productsData = productsResponse;
      } else if (productsResponse && productsResponse.success && productsResponse.data) {
        if (Array.isArray(productsResponse.data)) {
          productsData = productsResponse.data;
        } else if (typeof productsResponse.data === 'object') {
          productsData = Object.values(productsResponse.data);
        }
      } else if (productsResponse && typeof productsResponse === 'object') {
        productsData = Object.values(productsResponse);
      }

      const formattedProducts = productsData.map(product => ({
        id: product.maSp || product.id || product.maSP,
        ten: product.tenSp || product.ten || product.tenSP,
        gia: product.giaBan || product.gia || product.donGia || 0,
        danhMuc: product.danhMuc || product.maLoai,
        moTa: product.moTa || product.ghiChu || '',
        hinhAnh: product.hinhAnh || '/images/default-product.jpg'
      }));

      setProducts(formattedProducts);
      setFilteredProducts(formattedProducts);
    } catch (error) {
      console.error('Error loading products:', error);
      message.error('Không thể tải danh sách sản phẩm');
    } finally {
      setLoading(false);
    }
  };

  const handleAddToCart = (product) => {
    onAddToCart({
      id: product.id,
      ten: product.ten,
      gia: product.gia,
      quantity: 1
    });
    message.success(`Đã thêm ${product.ten} vào giỏ hàng`);
  };

  return (
    <div style={{ padding: '20px' }}>
      {/* Filter */}
      <div style={{ marginBottom: '20px' }}>
        <Row gutter={[16, 16]}>
          <Col xs={24} sm={12}>
            <Input
              placeholder="Tìm kiếm sản phẩm..."
              prefix={<Search size={16} />}
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
          </Col>
          <Col xs={24} sm={12}>
            <Select
              style={{ width: '100%' }}
              placeholder="Chọn danh mục"
              value={selectedCategory}
              onChange={setSelectedCategory}
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

      {/* Products */}
      {loading ? (
        <div style={{ textAlign: 'center', padding: '40px' }}>
          <Spin size="large" />
          <div style={{ marginTop: '16px' }}>
            <Text>Đang tải sản phẩm...</Text>
          </div>
        </div>
      ) : filteredProducts.length === 0 ? (
        <div style={{ textAlign: 'center', padding: '40px' }}>
          <Text type="secondary">Không tìm thấy sản phẩm nào</Text>
        </div>
      ) : (
        <Row gutter={[16, 16]}>
          {filteredProducts.map(product => (
            <Col xs={12} sm={8} md={6} lg={4} key={product.id}>
              <Card
                size="small"
                hoverable
                onClick={() => handleAddToCart(product)}
                style={{ 
                  height: '100%',
                  borderRadius: '8px',
                  overflow: 'hidden'
                }}
              >
                <div style={{ textAlign: 'center' }}>
                  <div style={{
                    width: '60px',
                    height: '60px',
                    borderRadius: '50%',
                    background: '#197dd3',
                    color: '#fff',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '24px',
                    fontWeight: 'bold',
                    margin: '0 auto 12px'
                  }}>
                    {product.ten && product.ten.charAt ? product.ten.charAt(0) : '?'}
                  </div>
                  <Text strong style={{ display: 'block', marginBottom: '8px' }}>
                    {product.ten || 'Không có tên'}
                  </Text>
                  <Text style={{ 
                    color: '#197dd3', 
                    fontSize: '16px', 
                    fontWeight: 'bold' 
                  }}>
                    {product.gia?.toLocaleString('vi-VN')}đ
                  </Text>
                </div>
              </Card>
            </Col>
          ))}
        </Row>
      )}
    </div>
  );
};

export default ChonSanPham;
