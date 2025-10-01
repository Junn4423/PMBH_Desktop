import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Button, Typography, Input, message, Spin, Modal, Upload, Form, Select, InputNumber, Popconfirm } from 'antd';
import { Package2, Search, Grid, Filter, Edit, Upload as UploadIcon, Link, Plus, Trash2 } from 'lucide-react';
import { getLoaiSanPham, getSanPhamTheoIdLoai, getAllSanPham, loadProductImage, getFullImageUrl, updateProductImageUrl, uploadProductImage, themSanPham, capNhatSanPham, xoaSanPham, loadDonVi } from '../../services/apiServices';
import ProductCard from '../../components/common/ProductCard';
import { DEFAULT_IMAGES } from '../../constants';
import './SanPham.css';

const { Title, Text } = Typography;
const { Search: SearchInput } = Input;
const { Option } = Select;

const SanPham = () => {
  const [categories, setCategories] = useState([]);
  const [donViList, setDonViList] = useState([]);
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
  
  // Product CRUD modal states
  const [isProductModalVisible, setIsProductModalVisible] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [productForm] = Form.useForm();

  // Load categories and don vi immediately, products with delay (lazy load)
  useEffect(() => {
    // Load categories and don vi first (fast)
    loadCategoriesOnly();
    loadDonViData();
    
    // Then load products with a small delay for better UX
    const timer = setTimeout(() => {
      loadProductsOnly();
    }, 100);
    
    return () => clearTimeout(timer);
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

  const loadDonViData = async () => {
    try {
      const data = await loadDonVi();
      console.log('Don vi for product:', data);
      if (data && Array.isArray(data)) {
        setDonViList(data);
      }
    } catch (error) {
      console.error('Error loading don vi:', error);
    }
  };

  const loadCategoriesOnly = async () => {
    try {
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
    } catch (error) {
      console.error('Error loading categories:', error);
      message.error('Không thể tải danh mục sản phẩm');
      setCategories([{ value: 'all', label: 'Tất cả' }]);
    }
  };

  const loadProductsOnly = async () => {
    try {
      setLoading(true);

      // Get categories for mapping
      const categoriesResponse = await getLoaiSanPham();
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

      // Enhanced product mapping - Lazy load images (only load URL, not fetch from DB)
      const formattedProducts = productsData
        .filter(product => {
          // Filter out products with codes starting with "NL" (Nguyên liệu)
          const productCode = product.maSp || product.id || product.maSP || '';
          return !productCode.toString().startsWith('NL');
        })
        .map((product) => {
          let imageUrl = null;
          
          // Only check if product has valid image URL (no async DB call)
          if (product.hinhAnh && product.hinhAnh !== DEFAULT_IMAGES.PRODUCT) {
            imageUrl = getFullImageUrl(product.hinhAnh);
          }
          // Note: Database image loading is removed for performance
          // Images can be added/updated via the image edit modal

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
        });

      setProducts([...formattedProducts]); // Force new array reference
      setFilteredProducts([...formattedProducts]); // Force new array reference
      setRenderKey(prev => prev + 1); // Force re-render
      console.log('Loaded', formattedProducts.length, 'products for management');
    } catch (error) {
      console.error('Error loading products:', error);
      message.error('Không thể tải danh sách sản phẩm');
      setProducts([]);
      setFilteredProducts([]);
    } finally {
      setLoading(false);
    }
  };

  // Combined function for reload (used after add/edit/delete)
  const loadCategoriesAndProducts = async () => {
    await loadCategoriesOnly();
    await loadProductsOnly();
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

      if (imageUpdateType === 'url' && imageUrl.trim()) {
        // Update with URL
        const result = await updateProductImageUrl(selectedProduct.id, imageUrl.trim());
        success = result.success;
      } else if (imageUpdateType === 'upload' && fileList.length > 0) {
        // Upload file
        const file = fileList[0].originFileObj || fileList[0];
        const result = await uploadProductImage(selectedProduct.id, file);
        success = result.success;
      }

      if (success) {
        message.success('Cập nhật ảnh sản phẩm thành công');
        setEditModalVisible(false);
        // Reload products to show updated image
        loadCategoriesAndProducts();
      } else {
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

  // Product CRUD handlers
  const handleAddProduct = () => {
    setEditingProduct(null);
    productForm.resetFields();
    setIsProductModalVisible(true);
  };

  const handleEditProduct = (product) => {
    console.log('Editing product data:', product);
    console.log('Product gia:', product.gia);
    console.log('Original product:', product.originalProduct);
    
    setEditingProduct(product);
    
    // Get original data if available
    const original = product.originalProduct || {};
    
    // Parse giá bán to ensure it's a number for the form - FIX: better parsing
    let giaBan = product.gia || original.giaBan || original.gia || original.donGia || 0;
    
    // Convert string to number properly
    if (typeof giaBan === 'string') {
      giaBan = giaBan.replace(/[,\.]/g, ''); // Remove commas and dots
      giaBan = parseInt(giaBan, 10);
    }
    
    // Ensure it's a valid number
    const giaBanNumber = (!isNaN(giaBan) && giaBan >= 0) ? giaBan : 0;
    
    console.log('Parsed giaBan:', giaBanNumber);
    
    const formValues = {
      lv001: product.id || original.maSp || product.maSp || '',
      lv002: product.ten || original.tenSp || product.tenSp || '',
      lv003: product.danhMuc || original.maLoai || product.maLoai || '',
      lv004: giaBanNumber,
      lv005: original.donVi || original.lv005 || product.donVi || '',
      lv006: product.moTa || original.moTa || original.ghiChu || product.ghiChu || '',
      lv007: product.hinhAnh || original.hinhAnh || '',
      lv008: typeof original.lv008 === 'number' ? original.lv008 : (parseInt(original.lv008, 10) || 0),
      lv009: typeof original.lv009 === 'number' ? original.lv009 : (parseInt(original.lv009, 10) || 0),
      lv010: typeof original.lv010 === 'number' ? original.lv010 : (parseInt(original.lv010, 10) || 0)
    };
    
    console.log('Form values to set:', formValues);
    productForm.setFieldsValue(formValues);
    setIsProductModalVisible(true);
  };

  const handleDeleteProduct = async (product) => {
    try {
      const id = product.id || product.lv001 || product.maSp;
      await xoaSanPham(id);
      message.success('Xóa sản phẩm thành công');
      loadCategoriesAndProducts();
    } catch (error) {
      message.error('Không thể xóa sản phẩm');
      console.error('Error deleting product:', error);
    }
  };

  const handleProductSubmit = async (values) => {
    try {
      console.log('Form values submitted:', values);
      console.log('Editing product:', editingProduct);
      
      // Parse giá bán to ensure it's a number - FIX: Better validation
      let giaBan = values.lv004;
      
      // Handle different input formats
      if (typeof giaBan === 'string') {
        giaBan = giaBan.replace(/[,\.]/g, ''); // Remove commas and dots
        giaBan = parseInt(giaBan, 10);
      }
      
      // Validate the price
      if (isNaN(giaBan) || giaBan < 0) {
        message.error('Giá bán không hợp lệ. Vui lòng nhập giá bán hợp lệ.');
        return;
      }
      
      console.log('Parsed giaBan:', giaBan);
      
      // When editing, get original product data to preserve fields
      let originalData = {};
      if (editingProduct && editingProduct.originalProduct) {
        originalData = editingProduct.originalProduct;
      }
      
      // Đảm bảo có đầy đủ 10 field bắt buộc, giữ nguyên giá trị cũ nếu không có giá trị mới
      const payload = {
        lv001: (values.lv001 || '').toString().trim(),
        lv002: (values.lv002 || '').toString().trim(),
        lv003: (values.lv003 || '').toString().trim(),
        lv004: giaBan, // Must be a valid number
        lv005: (values.lv005 || originalData.donVi || originalData.lv005 || '').toString().trim(),
        lv006: (values.lv006 || originalData.moTa || originalData.ghiChu || originalData.lv006 || '').toString().trim(),
        lv007: (values.lv007 || originalData.hinhAnh || originalData.lv007 || '').toString().trim(),
        lv008: typeof values.lv008 === 'number' ? values.lv008 : (
          typeof originalData.lv008 === 'number' ? originalData.lv008 : (parseInt(values.lv008 || originalData.lv008, 10) || 0)
        ),
        lv009: typeof values.lv009 === 'number' ? values.lv009 : (
          typeof originalData.lv009 === 'number' ? originalData.lv009 : (parseInt(values.lv009 || originalData.lv009, 10) || 0)
        ),
        lv010: typeof values.lv010 === 'number' ? values.lv010 : (
          typeof originalData.lv010 === 'number' ? originalData.lv010 : (parseInt(values.lv010 || originalData.lv010, 10) || 0)
        )
      };
      
      console.log('Payload to send:', payload);
      console.log('Price in payload (lv004):', payload.lv004, typeof payload.lv004);
      
      let result;
      if (editingProduct) {
        result = await capNhatSanPham(payload);
        console.log('Update result:', result);
        message.success('Cập nhật sản phẩm thành công');
      } else {
        result = await themSanPham(payload);
        console.log('Add result:', result);
        
        if (result && result.success) {
          message.success('Thêm sản phẩm thành công');
        } else if (result && result.Message) {
          message.warning(result.Message);
        } else {
          message.success('Thêm sản phẩm thành công');
        }
      }
      
      setIsProductModalVisible(false);
      productForm.resetFields();
      setEditingProduct(null);
      await loadCategoriesAndProducts();
    } catch (error) {
      const errorMsg = error.message || 'Lỗi không xác định';
      message.error(editingProduct ? `Không thể cập nhật sản phẩm: ${errorMsg}` : `Không thể thêm sản phẩm: ${errorMsg}`);
      console.error('Error saving product:', error);
    }
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
              <div style={{ display: 'flex', gap: 12 }}>
                <SearchInput
                  placeholder="Tìm kiếm sản phẩm..."
                  allowClear
                  value={searchText}
                  onChange={(e) => setSearchText(e.target.value)}
                  style={{ width: 250 }}
                  prefix={<Search size={16} />}
                />
                <Button
                  type="primary"
                  icon={<Plus size={16} />}
                  onClick={handleAddProduct}
                >
                  Thêm sản phẩm
                </Button>
              </div>
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
                        icon={<Edit size={14} />}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleEditProduct(product);
                        }}
                      >
                        Sửa
                      </Button>,
                      <Popconfirm
                        key="delete"
                        title="Xác nhận xóa"
                        description="Bạn có chắc chắn muốn xóa sản phẩm này?"
                        onConfirm={(e) => {
                          e.stopPropagation();
                          handleDeleteProduct(product);
                        }}
                        okText="Xóa"
                        cancelText="Hủy"
                      >
                        <Button 
                          type="link" 
                          danger
                          size="small"
                          icon={<Trash2 size={14} />}
                          onClick={(e) => e.stopPropagation()}
                        >
                          Xóa
                        </Button>
                      </Popconfirm>
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

      {/* Product CRUD Modal */}
      <Modal
        title={editingProduct ? 'Sửa sản phẩm' : 'Thêm sản phẩm'}
        open={isProductModalVisible}
        onCancel={() => {
          setIsProductModalVisible(false);
          productForm.resetFields();
        }}
        onOk={() => productForm.submit()}
        okText={editingProduct ? 'Cập nhật' : 'Thêm'}
        cancelText="Hủy"
        width={600}
      >
        <Form
          form={productForm}
          layout="vertical"
          onFinish={handleProductSubmit}
        >
          <Form.Item
            name="lv001"
            label="Mã sản phẩm"
            rules={[{ required: true, message: 'Vui lòng nhập mã sản phẩm' }]}
          >
            <Input disabled={!!editingProduct} placeholder="Nhập mã sản phẩm" />
          </Form.Item>
          
          <Form.Item
            name="lv002"
            label="Tên sản phẩm"
            rules={[{ required: true, message: 'Vui lòng nhập tên sản phẩm' }]}
          >
            <Input placeholder="Nhập tên sản phẩm" />
          </Form.Item>
          
          <Form.Item
            name="lv003"
            label="Loại sản phẩm"
            rules={[{ required: true, message: 'Vui lòng chọn loại sản phẩm' }]}
          >
            <Select placeholder="Chọn loại sản phẩm">
              {categories.filter(c => c.value !== 'all').map(cat => (
                <Select.Option key={cat.value} value={cat.value}>
                  {cat.label}
                </Select.Option>
              ))}
            </Select>
          </Form.Item>
          
          <Form.Item
            name="lv004"
            label="Giá bán"
            rules={[
              { required: true, message: 'Vui lòng nhập giá bán' },
              { type: 'number', min: 0, message: 'Giá bán phải lớn hơn hoặc bằng 0' }
            ]}
          >
            <InputNumber
              style={{ width: '100%' }}
              min={0}
              precision={0}
              formatter={value => {
                if (!value && value !== 0) return '';
                return `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
              }}
              parser={value => {
                if (!value) return '';
                // Remove all non-digits
                const cleaned = value.replace(/[^\d]/g, '');
                const num = parseInt(cleaned, 10);
                return isNaN(num) ? '' : num;
              }}
              placeholder="Nhập giá bán (VD: 50000)"
              onChange={(value) => {
                console.log('Price changed:', value, typeof value);
              }}
            />
          </Form.Item>
          
          <Form.Item
            name="lv005"
            label="Đơn vị"
          >
            <Select placeholder="Chọn đơn vị" showSearch optionFilterProp="children">
              {donViList.map(dv => (
                <Select.Option key={dv.maDonVi} value={dv.maDonVi}>
                  {dv.tenDonVi} {dv.tenDonViRutGon ? `(${dv.tenDonViRutGon})` : ''}
                </Select.Option>
              ))}
            </Select>
          </Form.Item>
          
          <Form.Item
            name="lv006"
            label="Mô tả"
          >
            <Input.TextArea rows={3} placeholder="Nhập mô tả sản phẩm" />
          </Form.Item>
          
          <Form.Item
            name="lv007"
            label="URL hình ảnh"
          >
            <Input placeholder="Nhập URL hình ảnh" />
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default SanPham;