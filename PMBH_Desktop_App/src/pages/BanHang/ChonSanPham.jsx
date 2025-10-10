import React, { useState, useEffect, useMemo, useCallback } from 'react';
import { Input, Typography, Spin, message } from 'antd';
import { Search } from 'lucide-react';
import { getAllSanPham, getLoaiSanPham, getSanPhamTheoIdLoai, loadProductImage, getFullImageUrl } from '../../services/apiServices';
import ProductCard from '../../components/common/ProductCard';
import { DEFAULT_IMAGES } from '../../constants';
import { useText } from '../../components/common/Text';
import './ChonSanPham.css';

const { Text } = Typography;

const ChonSanPham = ({ onAddToCart }) => {
  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [loading, setLoading] = useState(false);
  const { translate } = useText();
  const __ = (key, values, fallback) => translate(key, { values, defaultText: fallback ?? key });

  // Memoized filtered products to prevent unnecessary re-renders
  const filteredProducts = useMemo(() => {
    let filtered = products;
    
    // Filter by search term
    if (searchTerm) {
      filtered = filtered.filter(product =>
        product.ten && product.ten.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }
    
    // Filter by category
    if (selectedCategory !== 'all') {
      filtered = filtered.filter(product => {
        return product.danhMuc === selectedCategory;
      });
    }
    
    return filtered;
  }, [products, searchTerm, selectedCategory]);

  useEffect(() => {
    loadCategoriesAndProducts();
  }, []);

  const loadCategoriesAndProducts = useCallback(async () => {
    try {
      setLoading(true);

      // Load categories and products in parallel to improve performance
      const [categoriesResponse, productsResponse] = await Promise.all([
        getLoaiSanPham(),
        getAllSanPham()
      ]);
      
      // Process categories
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

      // Process products data
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

      // Optimized category mapping - load only when needed and cache results
      const productsByCategory = {};
      const categoryPromises = categoriesData.map(async (category) => {
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
          // Silently handle category load errors to prevent blocking
          console.warn(`Failed to load products for category ${categoryId}`);
        }
      });

      await Promise.all(categoryPromises);

      // Enhanced product mapping without loading all images upfront
      const formattedProducts = productsData
        .filter(product => {
          // Filter out products with codes starting with "NL" (Nguyên liệu)
          const productCode = product.maSp || product.id || product.maSP || '';
          return !productCode.toString().startsWith('NL');
        })
        .map((product) => {
          const productId = product.maSp || product.id || product.maSP || product.idSp;
          const categoryId = productsByCategory[productId] || null;

          // Use existing image URL if available, otherwise null (lazy load in ProductCard)
          let imageUrl = null;
          const imageValue = product.lv014 || product.hinhAnh;
          if (imageValue && imageValue !== DEFAULT_IMAGES.PRODUCT) {
            imageUrl = getFullImageUrl(imageValue);
          }

          const rawGiaBan =
            product.giaBan ??
            product.lv007 ??
            product.gia ??
            product.donGia ??
            0;

          const gia =
            typeof rawGiaBan === 'number'
              ? rawGiaBan
              : parseInt(String(rawGiaBan).replace(/[^\d]/g, ''), 10) || 0;

          return {
            id: productId,
            ten: product.tenSp || product.ten || product.tenSP,
            gia,
            danhMuc: categoryId,
            moTa: product.moTa || product.ghiChu || '',
            hinhAnh: imageUrl,
            donVi: product.donVi || product.dvt || product.dvtGia || product.dvTinh || product.donViTinh || product.lv004 || product.lv005 || '',
            originalProduct: {
              ...product,
              imageValue
            }
          };
        });

      setProducts(formattedProducts);
    } catch (error) {
      console.error('Error loading products:', error);
      message.error(__('Không thể tải danh sách sản phẩm'));
    } finally {
      setLoading(false);
    }
  }, []);

  const handleAddToCart = useCallback((product) => {
    onAddToCart({
      id: product.id,
      ten: product.ten,
      gia: product.gia,
      quantity: 1
    });
    message.success(__('pages.banhang.item_added_to_cart', { name: product.ten }, `Đã thêm ${product.ten} vào giỏ hàng`));
  }, [onAddToCart]);

  return (
    <div className="chonsp-layout">
      {/* Sidebar categories */}
      <aside className="categories-sidebar">
        <div className="sidebar-header">
          <h4>{__('Danh mục')}</h4>
        </div>
        <div className="categories-list">
          <div
            className={`category-item ${selectedCategory === 'all' ? 'active' : ''}`}
            onClick={() => setSelectedCategory('all')}
          >
            <span>{__('Tất cả')}</span>
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
            <span>
              {selectedCategory === 'all'
                ? __('Tất cả')
                : (categories.find(c => c.value === selectedCategory)?.label || '')}
            </span>
          </div>
          <div className="products-search">
            <Input
              placeholder={__('Tìm kiếm sản phẩm...', {}, 'Tìm kiếm sản phẩm...')}
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
              <Text>{__('Đang tải sản phẩm...')}</Text>
            </div>
          </div>
        ) : filteredProducts.length === 0 ? (
          <div className="empty-container">
            <Text type="secondary">{__('Không tìm thấy sản phẩm nào')}</Text>
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
