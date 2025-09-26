import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Button, Typography, Input, message, Spin, Modal, Upload, Form, Select } from 'antd';
import { Package2, Search, Grid, Filter, Edit, Upload as UploadIcon, Link } from 'lucide-react';
import { getLoaiSanPham, getSanPhamTheoIdLoai, getAllSanPham, loadProductImage, getFullImageUrl, updateProductImageUrl, uploadProductImage } from '../../services/apiServices';
import ProductCard from '../../components/common/ProductCard';
import { DEFAULT_IMAGES } from '../../constants';
import './SanPham.css';

const { Title, Text } = Typography;
const { Search: SearchInput } = Input;
const { Option } = Select;

const SanPham = () => {
  const [categories, setCategories] = useState([]);
  const [products, setProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [loading, setLoading] = useState(false);
  const [searchText, setSearchText] = useState('');
  
  // Image edit modal states
  const [editModalVisible, setEditModalVisible] = useState(false);
  const [selectedProduct, setSelectedProduct] = useState(null);
  const [imageUpdateType, setImageUpdateType] = useState('url'); // 'url' or 'file'
  const [imageUrl, setImageUrl] = useState('');
  const [fileList, setFileList] = useState([]);
  const [updatingImage, setUpdatingImage] = useState(false);
  const [renderKey, setRenderKey] = useState(0);
  const [form] = Form.useForm();

  // Load categories and products on mount
  useEffect(() => {
    loadCategoriesAndProducts();
  }, []);

  // Filter products when category or search changes
  useEffect(() => {
    let filtered = products;
    
    // Filter by category
    if (selectedCategory !== 'all') {
      filtered = filtered.filter(product => product.danhMuc === selectedCategory);
    }
    
    setFilteredProducts(filtered);
  }, [selectedCategory, products]);

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

      setProducts([...formattedProducts]); // Force new array reference
      setFilteredProducts([...formattedProducts]); // Force new array reference
      setRenderKey(prev => prev + 1); // Force re-render
      console.log('Loaded', formattedProducts.length, 'products for management');
    } catch (error) {
      console.error('Error loading categories and products:', error);
      message.error('Không thể tải danh sách sản phẩm');
      setCategories([]);
      setProducts([]);
      setFilteredProducts([]);
    } finally {
      setLoading(false);
    }
  };








  // Image editing functions
  const handleEditImage = (product) => {
    setSelectedProduct(product);
    setEditModalVisible(true);
    setImageUrl('');
    setFileList([]);
    setImageUpdateType('url');
  };

  const handleImageUpdate = async () => {
    if (!selectedProduct) return;

    try {
      setUpdatingImage(true);
      let success = false;
      let result;

      if (imageUpdateType === 'url' && imageUrl.trim()) {
        // Update with URL
        console.log('Updating image URL for product:', selectedProduct.id, 'URL:', imageUrl.trim());
        result = await updateProductImageUrl(selectedProduct.id, imageUrl.trim());
        console.log('Update URL result:', result);
        success = result.success;
      } else if (imageUpdateType === 'upload' && fileList.length > 0) {
        // Upload file
        console.log('Uploading image file for product:', selectedProduct.id, 'File:', fileList[0]);
        const file = fileList[0].originFileObj || fileList[0];
        result = await uploadProductImage(selectedProduct.id, file);
        console.log('Upload result:', result);
        success = result.success;
      }

      if (success) {
        message.success('Cập nhật ảnh sản phẩm thành công');
        setEditModalVisible(false);
        // Reload products to show updated image
        loadCategoriesAndProducts();
      } else {
        console.error('Image update failed:', result);
        message.error('Không thể cập nhật ảnh sản phẩm');
      }
    } catch (error) {
      console.error('Error updating product image:', error);
      message.error('Lỗi khi cập nhật ảnh: ' + error.message);
    } finally {
      setUpdatingImage(false);
    }
  };

  const handleFileChange = ({ fileList: newFileList }) => {
    setFileList(newFileList);
  };

  const displayProducts = filteredProducts.filter(product => {
    if (!searchText) return true;
    const searchLower = searchText.toLowerCase();
    return (
      (product.ten && product.ten.toLowerCase().includes(searchLower)) ||
      (product.id && product.id.toString().toLowerCase().includes(searchLower))
    );
  });

  console.log('SanPham render:', { products: products.length, filtered: filteredProducts.length, display: displayProducts.length, loading });
  
  return (
    <div key={renderKey} className="san-pham-container">
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
                className={`category-item ${selectedCategory === 'all' ? 'active' : ''}`}
                onClick={() => setSelectedCategory('all')}
              >
                <Grid size={14} />
                <span>Tất cả sản phẩm</span>
                <span className="category-count">({products.length})</span>
              </div>
              
              {/* Show categories with product counts */}
              {categories.filter(c => c.value !== 'all').map(category => {
                const categoryCount = products.filter(p => p.danhMuc === category.value).length;
                return (
                  <div
                    key={category.value}
                    className={`category-item ${selectedCategory === category.value ? 'active' : ''}`}
                    onClick={() => setSelectedCategory(category.value)}
                  >
                    <Package2 size={14} />
                    <span>{category.label}</span>
                    <span className="category-count">({categoryCount})</span>
                  </div>
                );
              })}
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
            {loading ? (
              <div className="loading-container">
                <Spin size="large" />
                <div className="loading-text">
                  <Text>Đang tải sản phẩm...</Text>
                </div>
              </div>
            ) : displayProducts.length === 0 ? (
              <div className="empty-container">
                <Text type="secondary">Không tìm thấy sản phẩm nào</Text>
              </div>
            ) : (
              <div className="products-grid">
                {displayProducts.map(product => (
                  <ProductCard
                    key={product.id}
                    product={product}
                    onClick={() => handleEditImage(product)}
                    loading={loading}
                    showBadge={false}
                    extraActions={[
                      <Button 
                        key="edit" 
                        type="link" 
                        size="small"
                        onClick={(e) => {
                          e.stopPropagation();
                          handleEditImage(product);
                        }}
                      >
                        Sửa ảnh
                      </Button>
                    ]}
                  />
                ))}
              </div>
            )}
          </Card>
        </div>
      </div>

      {/* Image Edit Modal */}
      <Modal
        title="Chỉnh sửa ảnh sản phẩm"
        open={editModalVisible}
        onCancel={() => setEditModalVisible(false)}
        onOk={handleImageUpdate}
        confirmLoading={updatingImage}
        width={600}
      >
        {selectedProduct && (
          <div>
            <div style={{ marginBottom: 16 }}>
              <strong>Sản phẩm:</strong> {selectedProduct.ten}
            </div>
            
            <div style={{ marginBottom: 16 }}>
              <strong>Ảnh hiện tại:</strong>
              <div style={{ marginTop: 8 }}>
                {selectedProduct.hinhAnh ? (
                  <img 
                    src={selectedProduct.hinhAnh} 
                    alt="Current"
                    style={{ maxWidth: 200, maxHeight: 200, objectFit: 'cover' }}
                  />
                ) : (
                  <div style={{ 
                    width: 200, 
                    height: 200, 
                    border: '1px dashed #d9d9d9',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    color: '#999'
                  }}>
                    Chưa có ảnh
                  </div>
                )}
              </div>
            </div>

            <Form layout="vertical">
              <Form.Item label="Phương thức cập nhật">
                <Select 
                  value={imageUpdateType}
                  onChange={setImageUpdateType}
                  style={{ width: '100%' }}
                >
                  <Select.Option value="url">Nhập URL ảnh</Select.Option>
                  <Select.Option value="upload">Tải ảnh lên</Select.Option>
                </Select>
              </Form.Item>

              {imageUpdateType === 'url' ? (
                <Form.Item label="URL ảnh">
                  <Input
                    value={imageUrl}
                    onChange={(e) => setImageUrl(e.target.value)}
                    placeholder="Nhập URL ảnh..."
                  />
                </Form.Item>
              ) : (
                <Form.Item label="Chọn ảnh">
                  <Upload
                    listType="picture-card"
                    fileList={fileList}
                    onChange={handleFileChange}
                    beforeUpload={() => false} // Prevent auto upload
                    accept="image/*"
                    maxCount={1}
                  >
                    {fileList.length < 1 && (
                      <div>
                        <div style={{ marginTop: 8 }}>Chọn ảnh</div>
                      </div>
                    )}
                  </Upload>
                </Form.Item>
              )}
            </Form>
          </div>
        )}
      </Modal>
    </div>
  );
};

export default SanPham;