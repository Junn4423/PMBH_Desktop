import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Button, Typography, Input, message, Spin, Modal, Upload, Form, Select, InputNumber, Popconfirm } from 'antd';
import { Package2, Search, Grid, Filter, Edit, Plus, Trash2, UploadCloud } from 'lucide-react';
import { getLoaiSanPham, getSanPhamTheoIdLoai, getAllSanPham, getFullImageUrl, uploadImageBlob, loadProductImageBlob, themSanPham, capNhatSanPham, xoaSanPham, loadDonVi } from '../../services/apiServices';
import ProductCard from '../../components/common/ProductCard';
import './SanPham.css';

const { Text } = Typography;
const { Search: SearchInput } = Input;
const { Option } = Select;

const DEFAULT_CURRENCY = 'VND';
const DEFAULT_CONVERSION_VALUE = 1;

const parseGiaBanToNumber = (value) => {
  if (value === null || value === undefined || value === '') {
    return 0;
  }

  if (typeof value === 'number') {
    return Number.isNaN(value) ? 0 : value;
  }

  if (typeof value === 'string') {
    const cleaned = value.replace(/[^\d]/g, '');
    const parsed = parseInt(cleaned, 10);
    return Number.isNaN(parsed) ? 0 : parsed;
  }

  if (typeof value === 'object' && value !== null && 'value' in value) {
    return parseGiaBanToNumber(value.value);
  }

  return 0;
};

const extractDonViFromProduct = (product = {}) => {
  const candidate =
    product.donVi ||
    product.dvt ||
    product.dvtGia ||
    product.dvTinh ||
    product.donViTinh ||
    product.donvi ||
    product.lv004 ||
    product.lv005;

  return candidate ? candidate.toString().trim() : '';
};

const extractImageValueFromProduct = (product = {}) => {
  const rawValue =
    product.imageValue !== undefined ? product.imageValue :
    product.lv014 !== undefined ? product.lv014 :
    product.imageUrl !== undefined ? product.imageUrl :
    product.hinhAnh !== undefined ? product.hinhAnh : '';

  if (!rawValue) {
    return '';
  }

  return typeof rawValue === 'string' ? rawValue.trim() : rawValue;
};

const mapSanPhamFromApi = (product, productsByCategory = {}) => {
  const productId =
    product.maSp ||
    product.id ||
    product.maSP ||
    product.idSp ||
    product.lv001 || '';

  const categoryId = productsByCategory[productId] ?? product.danhMuc ?? product.maLoai ?? product.maDanhMucSp ?? null;

  const rawGiaBan =
    product.giaBan ??
    product.gia ??
    product.donGia ??
    product.lv007 ??
    product.giaBanLe ??
    product.giaBan1 ??
    0;

  const giaBanNumber = parseGiaBanToNumber(rawGiaBan);
  const donVi = extractDonViFromProduct(product);
  const imageValue = extractImageValueFromProduct(product);
  // Không dùng imageValue từ database cũ nữa, sẽ load từ all_gmac_documents_v3_0
  const moTa = product.moTa || product.ghiChu || product.lv006 || '';

  const normalizedOriginalProduct = {
    ...product,
    giaBan: rawGiaBan,
    donVi,
    imageValue
  };

  return {
    id: productId,
    ten: product.tenSp || product.ten || product.tenSP || '',
    gia: giaBanNumber,
    donVi,
    danhMuc: categoryId,
    moTa,
    hinhAnh: null, // Sẽ được load sau từ database
    imageValue,
    originalProduct: normalizedOriginalProduct,
    needLoadImage: true // Flag để biết cần load ảnh
  };
};

const SanPham = () => {
  const [categories, setCategories] = useState([]);
  const [donViList, setDonViList] = useState([]);
  const [products, setProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [loading, setLoading] = useState(false);
  const [searchText, setSearchText] = useState('');
  const [imageReloadTrigger, setImageReloadTrigger] = useState(0); // Trigger để reload images
  
  const [renderKey, setRenderKey] = useState(0);
  const [form] = Form.useForm();
  
  // Product CRUD modal states
  const [isProductModalVisible, setIsProductModalVisible] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [productForm] = Form.useForm();
  const [productImageFileList, setProductImageFileList] = useState([]);

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

  // Load images from database after products are loaded or when trigger changes
  useEffect(() => {
    const loadImages = async () => {
      if (products.length === 0) return;
      
      const productsSnapshot = [...products]; // Snapshot để tránh dependency issues
      
      // Load images cho tất cả products
      const updatedProducts = await Promise.all(
        productsSnapshot.map(async (product) => {
          try {
            const imageResult = await loadProductImageBlob(product.id);
            if (imageResult.success && imageResult.imageUrl) {
              return { ...product, hinhAnh: imageResult.imageUrl, needLoadImage: false };
            }
          } catch (error) {
            console.warn(`Failed to load image for product ${product.id}:`, error);
          }
          return { ...product, hinhAnh: null, needLoadImage: false };
        })
      );
      
      setProducts(updatedProducts);
      setFilteredProducts(updatedProducts);
    };
    
    if (imageReloadTrigger > 0) {
      loadImages();
    }
  }, [imageReloadTrigger]); // Chỉ chạy khi trigger thay đổi
  
  // Load images lần đầu khi products được load
  useEffect(() => {
    if (products.length > 0 && products.some(p => p.needLoadImage)) {
      setImageReloadTrigger(prev => prev + 1);
    }
  }, [products.length]);

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
        .map((product) => mapSanPhamFromApi(product, productsByCategory));

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

  // Product CRUD handlers
  const handleAddProduct = () => {
    setEditingProduct(null);
    productForm.resetFields();
    setProductImageFileList([]);
    setIsProductModalVisible(true);
  };

  const handleEditProduct = (product) => {
    console.log('Editing product data:', product);
    console.log('Product gia:', product.gia);
    console.log('Original product:', product.originalProduct);

    setEditingProduct(product);
    setProductImageFileList([]);

    const original = product.originalProduct || {};

    const giaBanNumber = (() => {
      if (typeof product.gia === 'number') {
        return !Number.isNaN(product.gia) && product.gia >= 0 ? product.gia : 0;
      }
      return parseGiaBanToNumber(product.gia || original.giaBan || original.gia || original.donGia);
    })();

    const formValues = {
      maSanPham: product.id || original.maSp || original.lv001 || '',
      tenSanPham: product.ten || original.tenSp || original.lv002 || '',
      maLoai: product.danhMuc || original.maLoai || original.lv003 || '',
      giaBan: giaBanNumber,
      donViTinh: product.donVi || original.donVi || original.lv004 || original.lv005 || '',
      moTa: product.moTa || original.moTa || original.ghiChu || original.lv006 || ''
    };

    console.log('Form values to set:', formValues);
    productForm.setFieldsValue(formValues);
    setIsProductModalVisible(true);
  };

  const handleDeleteProduct = async (product) => {
    try {
      const id = product.id || product.lv001 || product.maSp;
      console.log('Deleting product with ID:', id);
      const result = await xoaSanPham(id);
      console.log('Delete result:', result);
      
      // Kiểm tra kết quả trả về từ backend
      if (result && typeof result === 'object' && result.success === false) {
        message.error(result.message || 'Không thể xóa sản phẩm này vì đã được sử dụng trong hóa đơn/phiếu xuất');
        return;
      }
      
      // Kiểm tra các trường hợp khác
      if (result === false || result === 0 || result === '0' || !result) {
        message.error('Không thể xóa sản phẩm này vì đã được sử dụng trong hóa đơn/phiếu xuất');
        return;
      }
      
      message.success('Xóa sản phẩm thành công');
      loadCategoriesAndProducts();
    } catch (error) {
      console.error('Error deleting product:', error);
      message.error('Không thể xóa sản phẩm này vì đã được sử dụng trong hóa đơn/phiếu xuất');
    }
  };

  const handleProductSubmit = async (values) => {
    try {
      console.log('Form values submitted:', values);
      console.log('Editing product:', editingProduct);

      const {
        maSanPham,
        tenSanPham,
        maLoai,
        giaBan,
        donViTinh,
        moTa
      } = values;

      const originalData = editingProduct?.originalProduct || editingProduct || {};
      console.log('Original data:', originalData);

      const giaBanNumber = parseGiaBanToNumber(giaBan);

      if (Number.isNaN(giaBanNumber) || giaBanNumber < 0) {
        message.error('Giá bán không hợp lệ. Vui lòng nhập giá bán hợp lệ.');
        return;
      }

      console.log('Parsed giaBan:', giaBanNumber);

      const normalizedMaSp = (maSanPham || '').toString().trim();
      const normalizedTenSp = (tenSanPham || '').toString().trim();
      const normalizedMaLoai = (maLoai || '').toString().trim();
      const normalizedDonVi = (donViTinh || originalData.donVi || originalData.lv004 || originalData.lv005 || '').toString().trim();

      const payload = {
        maSanPham: normalizedMaSp,
        tenSanPham: normalizedTenSp,
        maLoai: normalizedMaLoai,
        donViTinh: normalizedDonVi,
        donViQuyDoi: originalData.donViQuyDoi || originalData.lv005 || normalizedDonVi,
        giaTriQuyDoi: originalData.giaTriQuyDoi || originalData.lv006 || DEFAULT_CONVERSION_VALUE,
        giaBan: giaBanNumber,
        donViGia: originalData.donViGia || originalData.lv008 || DEFAULT_CURRENCY,
        trangThai: originalData.trangThai ?? originalData.trangThai_HienThiSP ?? originalData.lv009 ?? 0,
        soLuongTonToiThieu: originalData.soLuongTonToiThieu ?? originalData.lv010 ?? 0,
        ghiChu: moTa ? moTa.toString().trim() : '',
        imageUrl: '' // Không dùng URL nữa
      };

      console.log('Payload to send:', payload);

      let result;
      if (editingProduct) {
        result = await capNhatSanPham(payload);
        console.log('Update result:', result, typeof result);
        if (typeof result === 'object') {
          console.log('Update result details:', JSON.stringify(result, null, 2));
        }

        // Xử lý upload ảnh BLOB nếu có file được chọn
        if (productImageFileList.length > 0) {
          const imageFile = productImageFileList[0].originFileObj || productImageFileList[0];
          console.log('Uploading image blob for product:', normalizedMaSp);
          const imageResult = await uploadImageBlob(normalizedMaSp, imageFile);
          console.log('Image blob upload result:', imageResult);
          if (!imageResult.success) {
            message.warning('Cập nhật sản phẩm thành công nhưng không thể lưu ảnh vào database.');
          } else {
            message.success('Cập nhật sản phẩm và ảnh thành công');
            // Trigger reload images
            setImageReloadTrigger(prev => prev + 1);
          }
        } else {
          message.success('Cập nhật sản phẩm thành công');
        }
      } else {
        result = await themSanPham(payload);
        console.log('Add result:', result);

        const addSuccess =
          result === true ||
          result === 1 ||
          result === '1' ||
          (typeof result === 'object' && result !== null && result.success === true);

        if (addSuccess) {
          // Xử lý upload ảnh BLOB nếu có file được chọn
          if (productImageFileList.length > 0) {
            const imageFile = productImageFileList[0].originFileObj || productImageFileList[0];
            console.log('Uploading image blob for new product:', normalizedMaSp);
            const imageResult = await uploadImageBlob(normalizedMaSp, imageFile);
            console.log('Image blob upload result:', imageResult);
            if (!imageResult || !imageResult.success) {
              message.warning('Thêm sản phẩm thành công nhưng không thể lưu ảnh vào database.');
            } else {
              message.success('Thêm sản phẩm và ảnh thành công');
              // Trigger reload images
              setImageReloadTrigger(prev => prev + 1);
            }
          } else {
            message.success('Thêm sản phẩm thành công');
          }
        } else if (result && result.Message) {
          message.warning(result.Message);
        } else {
          message.success('Thêm sản phẩm thành công');
        }
      }

      setIsProductModalVisible(false);
      productForm.resetFields();
      setProductImageFileList([]);
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

      {/* Product CRUD Modal */}
      <Modal
        title={editingProduct ? 'Sửa sản phẩm' : 'Thêm sản phẩm'}
        open={isProductModalVisible}
        onCancel={() => {
          setIsProductModalVisible(false);
          productForm.resetFields();
          setProductImageFileList([]);
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
            name="maSanPham"
            label="Mã sản phẩm"
            rules={[{ required: true, message: 'Vui lòng nhập mã sản phẩm' }]}
          >
            <Input disabled={!!editingProduct} placeholder="Nhập mã sản phẩm" />
          </Form.Item>
          
          <Form.Item
            name="tenSanPham"
            label="Tên sản phẩm"
            rules={[{ required: true, message: 'Vui lòng nhập tên sản phẩm' }]}
          >
            <Input placeholder="Nhập tên sản phẩm" />
          </Form.Item>
          
          <Form.Item
            name="maLoai"
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
            name="giaBan"
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
            name="donViTinh"
            label="Đơn vị tính"
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
            name="moTa"
            label="Mô tả"
          >
            <Input.TextArea rows={3} placeholder="Nhập mô tả sản phẩm" />
          </Form.Item>
          
          <Form.Item
            label="Hình ảnh sản phẩm"
            tooltip="Tải ảnh từ máy lên database"
          >
            <Upload
              listType="picture-card"
              fileList={productImageFileList}
              onChange={({ fileList: newFileList }) => setProductImageFileList(newFileList)}
              beforeUpload={() => false}
              accept="image/*"
              maxCount={1}
            >
              {productImageFileList.length < 1 && (
                <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                  <UploadCloud size={24} />
                  <div style={{ marginTop: 8 }}>Chọn ảnh</div>
                </div>
              )}
            </Upload>
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default SanPham;