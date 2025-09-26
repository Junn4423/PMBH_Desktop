import React, { useState, useEffect } from 'react';
import { Input, Typography, Spin, message } from 'antd';
import { Search } from 'lucide-react';
import { getAllSanPham, getLoaiSanPham, loadProductImage, getFullImageUrl } from '../../services/apiServices';
import ProductCard from '../../components/common/ProductCard';
import { DEFAULT_IMAGES } from '../../constants';
import './ChonSanPham.css';

const { Text } = Typography;

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

      // Enhanced product mapping with database image loading - Exclude "NL" products
      const formattedProducts = await Promise.all(productsData
        .filter(product => {
          // Filter out products with codes starting with "NL" (Nguyên liệu)
          const productCode = product.maSp || product.id || product.maSP || '';
          return !productCode.toString().startsWith('NL');
        })
        .map(async (product) => {
          let imageUrl = null;
          
          // First check if product has valid image URL
          if (product.hinhAnh && product.hinhAnh !== DEFAULT_IMAGES.PRODUCT) {
            imageUrl = getFullImageUrl(product.hinhAnh);
          } else {
            // Try to load image from database
            try {
              const imageData = await loadProductImage(product.maSp || product.id);
              if (imageData && imageData.imagePath) {
                imageUrl = getFullImageUrl(imageData.imagePath);
              }
            } catch (error) {
              // Ignore individual image load errors
            }
          }

          return {
            id: product.maSp || product.id || product.maSP,
            ten: product.tenSp || product.ten || product.tenSP,
            gia: product.giaBan || product.gia || product.donGia || 0,
            danhMuc: product.danhMuc || product.maLoai,
            moTa: product.moTa || product.ghiChu || '',
            hinhAnh: imageUrl // Will be null if no valid image found, ProductCard will use placeholder
          };
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
    <div className="chonsp-layout">
      {/* Sidebar categories */}
      <aside className="categories-sidebar">
        <div className="sidebar-header">
          <h4>Danh mục</h4>
        </div>
        <div className="categories-list">
          <div
            className={`category-item ${selectedCategory === 'all' ? 'active' : ''}`}
            onClick={() => setSelectedCategory('all')}
          >
            Tất cả
          </div>
          {categories.filter(c => c.value !== 'all').map(category => (
            <div
              key={category.value}
              className={`category-item ${selectedCategory === category.value ? 'active' : ''}`}
              onClick={() => setSelectedCategory(category.value)}
            >
              {category.label}
            </div>
          ))}
        </div>
      </aside>

      {/* Right pane */}
      <section className="products-pane">
        <div className="products-header">
          <div className="products-title">
            <span>{selectedCategory === 'all' ? 'Tất cả' : (categories.find(c => c.value === selectedCategory)?.label || '')}</span>
          </div>
          <div className="products-search">
            <Input
              placeholder="Tìm kiếm sản phẩm..."
              prefix={<Search size={16} />}
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
          </div>
        </div>

        {loading ? (
          <div className="loading-container">
            <Spin size="large" />
            <div className="loading-text">
              <Text>Đang tải sản phẩm...</Text>
            </div>
          </div>
        ) : filteredProducts.length === 0 ? (
          <div className="empty-container">
            <Text type="secondary">Không tìm thấy sản phẩm nào</Text>
          </div>
        ) : (
          <div className="products-grid">
            {filteredProducts.map(product => (
              <ProductCard
                key={product.id}
                product={product}
                onClick={handleAddToCart}
                loading={loading}
                showBadge={false}
              />
            ))}
          </div>
        )}
      </section>
    </div>
  );
};

export default ChonSanPham;
