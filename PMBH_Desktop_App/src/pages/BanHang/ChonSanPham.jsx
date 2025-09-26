import React, { useState, useEffect } from 'react';
import { Input, Typography, Spin, message } from 'antd';
import { Search } from 'lucide-react';
import { getAllSanPham, getLoaiSanPham, getSanPhamTheoIdLoai, loadProductImage, getFullImageUrl } from '../../services/apiServices';
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
    
    // Filter by search term
    if (searchTerm) {
      filtered = filtered.filter(product =>
        product.ten && product.ten.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }
    
    // Filter by category
    if (selectedCategory !== 'all') {
      const beforeFilter = filtered.length;
      filtered = filtered.filter(product => {
        const productCategory = product.danhMuc;
        const match = productCategory === selectedCategory;
        if (!match && productCategory) {
          console.log(`Category mismatch: product ${product.id} has category '${productCategory}', looking for '${selectedCategory}'`);
        }
        return match;
      });
      console.log(`Category filter: ${selectedCategory}, Before: ${beforeFilter}, After: ${filtered.length}`);
      if (filtered.length === 0 && beforeFilter > 0) {
        console.log('No products matched. Available product categories:', [...new Set(products.map(p => p.danhMuc).filter(Boolean))]);
      }
      console.log('Sample filtered products:', filtered.slice(0, 2).map(p => ({ 
        id: p.id, 
        ten: p.ten, 
        danhMuc: p.danhMuc 
      })));
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
        ...categoriesData
          .filter(cat => {
            // Filter out categories with "NVL" in name or ID (Nguyên vật liệu)
            const categoryName = cat.tenLoaiSp || cat.ten || cat.tenLoai || '';
            const categoryId = cat.idLoaiSp || cat.id || cat.maLoai || '';
            return !categoryName.toUpperCase().includes('NVL') && 
                   !categoryId.toUpperCase().includes('NVL');
          })
          .map(cat => ({
            value: cat.idLoaiSp || cat.id || cat.maLoai,
            label: cat.tenLoaiSp || cat.ten || cat.tenLoai
          }))
      ];
      setCategories(allCategories);
      console.log('Filtered categories (excluding NVL):', allCategories);

      // Load tất cả sản phẩm với category mapping
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

      // Load products by category to get proper category mapping
      const productsByCategory = {};
      for (const category of categoriesData) {
        const categoryId = category.idLoaiSp || category.id || category.maLoai;
        try {
          const categoryProducts = await getSanPhamTheoIdLoai(categoryId);
          let categoryProductsData = [];
          if (Array.isArray(categoryProducts)) {
            categoryProductsData = categoryProducts;
          } else if (categoryProducts && typeof categoryProducts === 'object') {
            categoryProductsData = Object.values(categoryProducts);
          }
          
          // Map each product to its category
          categoryProductsData.forEach(product => {
            const productId = product.idSp || product.maSp || product.id;
            productsByCategory[productId] = categoryId;
          });
        } catch (error) {
          console.warn(`Failed to load products for category ${categoryId}:`, error);
        }
      }

      console.log('Category mapping:', productsByCategory);

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

          const productId = product.maSp || product.id || product.maSP || product.idSp;
          const categoryId = productsByCategory[productId] || null;

          return {
            id: productId,
            ten: product.tenSp || product.ten || product.tenSP,
            gia: product.giaBan || product.gia || product.donGia || 0,
            danhMuc: categoryId, // Use mapped category from getSanPhamTheoIdLoai
            moTa: product.moTa || product.ghiChu || '',
            hinhAnh: imageUrl, // Will be null if no valid image found, ProductCard will use placeholder
            originalProduct: product // Keep reference for debugging if needed
          };
        }));

      setProducts(formattedProducts);
      setFilteredProducts(formattedProducts);
      console.log('Loaded products with proper category mapping:', formattedProducts.slice(0, 5).map(p => ({ 
        id: p.id, 
        ten: p.ten, 
        danhMuc: p.danhMuc 
      })));
      console.log('Available categories for filtering:', allCategories.map(c => ({ value: c.value, label: c.label })));
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
            <span>Tất cả</span>
            <span className="category-count">({products.length})</span>
          </div>
          {categories.filter(c => c.value !== 'all').map(category => {
            const categoryCount = products.filter(p => p.danhMuc === category.value).length;
            return (
              <div
                key={category.value}
                className={`category-item ${selectedCategory === category.value ? 'active' : ''}`}
                onClick={() => setSelectedCategory(category.value)}
              >
                <span>{category.label}</span>
                <span className="category-count">({categoryCount})</span>
              </div>
            );
          })}
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
