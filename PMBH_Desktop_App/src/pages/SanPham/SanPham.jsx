import React, { useState, useEffect, useMemo, useCallback, useRef } from 'react';
import { Card, Breadcrumb, Button, Typography, Input, message, Spin, Modal, Upload, Form, Select, InputNumber, Popconfirm, Space } from 'antd';
import { Package2, Search, Grid, Filter, Edit, Plus, Trash2, UploadCloud, Layers } from 'lucide-react';
import { getLoaiSanPham, getSanPhamTheoIdLoai, getAllSanPham, uploadImageBlob, loadProductImageBlob, themSanPham, capNhatSanPham, xoaSanPham, loadDonVi, getProductBom, saveProductBom } from '../../services/apiServices';
import ProductCard from '../../components/common/ProductCard';
import './SanPham.css';

const { Text } = Typography;
const { Search: SearchInput } = Input;

const DEFAULT_CURRENCY = 'VND';
const DEFAULT_CONVERSION_VALUE = 1;
const COMBO_PREFIX = 'CBO';

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

  const normalizedProductId = productId ? productId.toString() : '';
  const isComboProduct = normalizedProductId.toUpperCase().startsWith(COMBO_PREFIX);
  const categoryId =
    productsByCategory[normalizedProductId] ??
    product.danhMuc ??
    product.maLoai ??
    product.maDanhMucSp ??
    null;

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
    isCombo: isComboProduct,
    originalProduct: normalizedOriginalProduct,
    needLoadImage: true // Flag để biết cần load ảnh
  };
};

const SanPham = () => {
  const [categories, setCategories] = useState([]);
  const [donViList, setDonViList] = useState([]);
  const [products, setProducts] = useState([]);
  const [allProducts, setAllProducts] = useState([]);
  const [filteredProducts, setFilteredProducts] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [loading, setLoading] = useState(false);
  const [searchText, setSearchText] = useState('');
  const [imageReloadTrigger, setImageReloadTrigger] = useState(0); // Trigger để reload images
  
  const [renderKey, setRenderKey] = useState(0);
  
  // Product CRUD modal states
  const [isProductModalVisible, setIsProductModalVisible] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [productForm] = Form.useForm();
  const [productImageFileList, setProductImageFileList] = useState([]);

  // BOM modal states
  const [isBomModalVisible, setIsBomModalVisible] = useState(false);
  const [selectedBomProduct, setSelectedBomProduct] = useState(null);
  const [bomLoading, setBomLoading] = useState(false);
  const [bomSaving, setBomSaving] = useState(false);
  const [bomForm] = Form.useForm();
  const [currentBomComponents, setCurrentBomComponents] = useState([]);
  const [bomExtraOptions, setBomExtraOptions] = useState([]);

  const productsRef = useRef([]);

  useEffect(() => {
    productsRef.current = products;
  }, [products]);

  const productLookup = useMemo(() => {
    const map = new Map();
    allProducts.forEach((product) => {
      if (!product?.id) {
        return;
      }
      map.set(product.id.toString(), product);
    });
    return map;
  }, [allProducts]);

  const bomComponentOptions = useMemo(() => {
    const currentProductId = selectedBomProduct?.id
      ? selectedBomProduct.id.toString()
      : '';

    const optionMap = new Map();

    allProducts.forEach((product) => {
      if (!product?.id) {
        return;
      }
      const productId = product.id.toString();
      if (productId === currentProductId) {
        return;
      }
      if (!optionMap.has(productId)) {
        optionMap.set(productId, {
          value: product.id,
          label: `${product.ten || product.id} (${product.id})`
        });
      }
    });

    bomExtraOptions.forEach((option) => {
      if (!option?.value) {
        return;
      }
      const optionId = option.value.toString();
      if (optionId === currentProductId) {
        return;
      }
      if (!optionMap.has(optionId)) {
        optionMap.set(optionId, {
          value: option.value,
          label: option.label || option.value
        });
      }
    });

    return Array.from(optionMap.values());
  }, [allProducts, bomExtraOptions, selectedBomProduct]);

  const createDefaultBomRows = useCallback(
    () => [
      { componentId: null, quantity: 1, unitCode: '', wastePercent: 0, note: '' },
      { componentId: null, quantity: 1, unitCode: '', wastePercent: 0, note: '' }
    ],
    []
  );

  const bomInitialValues = useMemo(
    () => ({ components: createDefaultBomRows() }),
    [createDefaultBomRows]
  );

  const getUnitFromProduct = useCallback(
    (componentId) => {
      if (!componentId) {
        return '';
      }
      const lookupKey = componentId.toString();
      const targetProduct = productLookup.get(lookupKey);
      if (!targetProduct) {
        const fallback = currentBomComponents.find(
          (item) => item?.componentId?.toString() === lookupKey
        );
        if (!fallback) {
          return '';
        }
        return fallback.unitCode || '';
      }
      const candidate =
        targetProduct.donVi ||
        targetProduct.originalProduct?.donVi ||
        targetProduct.originalProduct?.lv004 ||
        targetProduct.originalProduct?.lv005;
      return candidate ? candidate.toString() : '';
    },
    [currentBomComponents, productLookup]
  );

  const normalizeBomItemsForForm = useCallback(
    (sourceItems = []) => {
      if (!Array.isArray(sourceItems)) {
        return [];
      }
      return sourceItems
        .map((item) => {
          const componentId =
            item?.componentId || item?.componentCode || item?.id || '';
          if (!componentId) {
            return null;
          }
          const quantityRaw = Number(item?.quantity);
          const normalizedQuantity =
            Number.isFinite(quantityRaw) && quantityRaw > 0 ? quantityRaw : 1;
          const normalizedUnit =
            item?.unitCode ||
            item?.unitName ||
            getUnitFromProduct(componentId) ||
            '';
          return {
            componentId,
            quantity: normalizedQuantity,
            unitCode: normalizedUnit,
            wastePercent:
              item?.wastePercent !== undefined
                ? Number(item.wastePercent) || 0
                : 0,
            note: item?.note ? item.note.toString() : ''
          };
        })
        .filter(Boolean);
    },
    [getUnitFromProduct]
  );

  const handleBomComponentChange = useCallback(
    (componentId, fieldIndex) => {
      const components = [...(bomForm.getFieldValue('components') || [])];
      if (!components[fieldIndex]) {
        components[fieldIndex] = {
          componentId: null,
          quantity: 1,
          unitCode: '',
          wastePercent: 0,
          note: ''
        };
      }
      components[fieldIndex] = {
        ...components[fieldIndex],
        componentId,
        unitCode:
          components[fieldIndex].unitCode ||
          getUnitFromProduct(componentId) ||
          ''
      };
      if (
        !components[fieldIndex].quantity ||
        components[fieldIndex].quantity <= 0
      ) {
        components[fieldIndex].quantity = 1;
      }
      bomForm.setFieldsValue({ components });
      setCurrentBomComponents(components);
    },
    [bomForm, getUnitFromProduct]
  );

  const handleOpenBomModal = useCallback(
    async (product) => {
      if (!product?.id) {
        message.warning('Không xác định được sản phẩm để cấu hình BOM');
        return;
      }

      setSelectedBomProduct(product);
      setIsBomModalVisible(true);
      setBomLoading(true);

      try {
        bomForm.resetFields();
        setBomExtraOptions([]);
        setCurrentBomComponents([]);
        const response = await getProductBom(product.id);

        if (response?.success === false && response?.message) {
          message.warning(response.message);
        }

        const rawItems = Array.isArray(response?.items)
          ? response.items
          : Array.isArray(response)
            ? response
            : [];

        const normalized = normalizeBomItemsForForm(rawItems);
        const rows = normalized.length >= 1 ? normalized : createDefaultBomRows();

        const responseOptions = rawItems
          .map((item) => {
            const componentId = item?.componentId || item?.componentCode || item?.id;
            if (!componentId) {
              return null;
            }
            const optionId = componentId.toString();
            const optionLabel = item?.componentName || componentId;
            return {
              value: optionId,
              label: `${optionLabel} (${optionId})`
            };
          })
          .filter(Boolean);

        setBomExtraOptions(responseOptions);
        setCurrentBomComponents(rows);
        bomForm.setFieldsValue({ components: rows });
      } catch (error) {
        console.error('Error loading BOM structure:', error);
        message.error('Không thể tải cấu trúc BOM của sản phẩm');
        const fallbackRows = createDefaultBomRows();
        setCurrentBomComponents(fallbackRows);
        bomForm.setFieldsValue({ components: fallbackRows });
      } finally {
        setBomLoading(false);
      }
    },
    [
      bomForm,
      createDefaultBomRows,
      normalizeBomItemsForForm
    ]
  );

  const handleCloseBomModal = useCallback(() => {
    setIsBomModalVisible(false);
    setSelectedBomProduct(null);
    setBomLoading(false);
    bomForm.resetFields();
    setBomExtraOptions([]);
    setCurrentBomComponents([]);
  }, [bomForm]);

  const handleBomSubmit = useCallback(
    async (values) => {
      if (!selectedBomProduct?.id) {
        message.warning('Chưa chọn sản phẩm để lưu cấu trúc BOM');
        return;
      }

      const rawComponents = Array.isArray(values?.components)
        ? values.components
        : [];

      const normalizedComponents = rawComponents
        .map((component) => {
          const componentId = component?.componentId || component?.id || '';
          if (!componentId) {
            return null;
          }

          const quantityValue = Number(component?.quantity);
          const normalizedQuantity =
            Number.isFinite(quantityValue) && quantityValue > 0
              ? quantityValue
              : 0;

          const unitCode =
            (component?.unitCode || getUnitFromProduct(componentId) || '')
              .toString()
              .trim();

          return {
            componentId: componentId.toString(),
            quantity: normalizedQuantity,
            unitCode,
            wastePercent:
              component?.wastePercent !== undefined
                ? Number(component.wastePercent) || 0
                : 0,
            note: component?.note ? component.note.toString().trim() : ''
          };
        })
        .filter(
          (item) =>
            item &&
            item.componentId &&
            item.componentId !== selectedBomProduct.id &&
            item.quantity > 0
        );

      const duplicateCheck = normalizedComponents.reduce((acc, item) => {
        acc[item.componentId] = (acc[item.componentId] || 0) + 1;
        return acc;
      }, {});

      const duplicatedIds = Object.keys(duplicateCheck).filter(
        (id) => duplicateCheck[id] > 1
      );

      if (duplicatedIds.length > 0) {
        message.warning(
          `Thành phần bị trùng: ${duplicatedIds.join(', ')}. Vui lòng điều chỉnh.`
        );
        return;
      }

      setBomSaving(true);

      try {
        const result = await saveProductBom(
          selectedBomProduct.id,
          normalizedComponents
        );

        const success =
          result?.success === true ||
          result === true ||
          result === 1 ||
          result === '1';

        if (!success) {
          const errorMessage =
            (result && result.message) || 'Không thể lưu cấu trúc BOM';
          message.error(errorMessage);
          return;
        }

        message.success(result?.message || 'Đã lưu cấu trúc BOM');

        const updatedItems = Array.isArray(result?.items)
          ? result.items
          : normalizedComponents;

        const normalized = normalizeBomItemsForForm(updatedItems);
        const responseOptions = updatedItems
          .map((item) => {
            const componentId = item?.componentId || item?.componentCode || item?.id;
            if (!componentId) {
              return null;
            }
            const optionId = componentId.toString();
            const optionLabel = item?.componentName || componentId;
            return {
              value: optionId,
              label: `${optionLabel} (${optionId})`
            };
          })
          .filter(Boolean);

        setBomExtraOptions(responseOptions);
        setCurrentBomComponents(normalized);
        bomForm.setFieldsValue({
          components:
            normalized.length >= 1 ? normalized : createDefaultBomRows()
        });
      } catch (error) {
        console.error('Error saving BOM structure:', error);
        message.error(error?.message || 'Không thể lưu cấu trúc BOM');
      } finally {
        setBomSaving(false);
      }
    },
    [
      bomForm,
      createDefaultBomRows,
      getUnitFromProduct,
      normalizeBomItemsForForm,
      selectedBomProduct
    ]
  );

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
      const snapshot = productsRef.current;
      if (!Array.isArray(snapshot) || snapshot.length === 0) {
        return;
      }

      const updatedProducts = await Promise.all(
        snapshot.map(async (product) => {
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
  }, [products]);

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
          categoryProductsData.forEach(productItem => {
            const mappedId =
              productItem.idSp ||
              productItem.maSp ||
              productItem.id;
            const normalizedId = mappedId ? mappedId.toString() : '';
            if (normalizedId) {
              productsByCategory[normalizedId] = categoryId;
            }
          });
        } catch (error) {
          console.warn(`Failed to load products for category ${categoryId}:`, error);
        }
      }

      console.log('Category mapping:', productsByCategory);

      // Chuẩn hóa dữ liệu sản phẩm để tái sử dụng (bao gồm cả nguyên vật liệu)
      const normalizedProducts = productsData.map((product) =>
        mapSanPhamFromApi(product, productsByCategory)
      );

      setAllProducts(normalizedProducts);

      // Lọc danh sách hiển thị (ẩn nguyên vật liệu khỏi danh sách quản lý sản phẩm)
      const filteredForDisplay = normalizedProducts.filter((product) => {
        const productCode = product?.id ? product.id.toString().toUpperCase() : '';
        return !productCode.startsWith('NL');
      });

      setProducts([...filteredForDisplay]); // Force new array reference
      setFilteredProducts([...filteredForDisplay]); // Force new array reference
      setRenderKey(prev => prev + 1); // Force re-render
      console.log('Loaded', filteredForDisplay.length, 'products for management');
    } catch (error) {
      console.error('Error loading products:', error);
      message.error('Không thể tải danh sách sản phẩm');
      setAllProducts([]);
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
                    onClick={() => handleOpenBomModal(product)}
                    extraActions={[
                      <Button
                        key="bom"
                        type="link"
                        size="small"
                        icon={<Layers size={14} />}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleOpenBomModal(product);
                        }}
                      >
                        BOM
                      </Button>,
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

        {/* BOM Modal */}
        <Modal
          title={
            selectedBomProduct
              ? `Cấu hình BOM - ${selectedBomProduct.ten || selectedBomProduct.id}`
              : 'Cấu hình BOM'
          }
          open={isBomModalVisible}
          onCancel={handleCloseBomModal}
          onOk={() => bomForm.submit()}
          okText="Lưu cấu trúc"
          cancelText="Đóng"
          confirmLoading={bomSaving}
          width={920}
          className="bom-modal"
          destroyOnClose
        >
          <Spin spinning={bomLoading}>
            <Space direction="vertical" size={4} className="bom-modal-header">
              <Text strong>Mã sản phẩm: {selectedBomProduct?.id || '—'}</Text>
              <Text type="secondary">
                Cần tối thiểu 2 thành phần. Chọn sản phẩm, số lượng và các thông tin liên quan.
              </Text>
            </Space>

            <Form
              form={bomForm}
              layout="vertical"
              onFinish={handleBomSubmit}
              onValuesChange={(_, allValues) => {
                const nextComponents = Array.isArray(allValues?.components)
                  ? allValues.components
                  : [];
                setCurrentBomComponents(nextComponents);
              }}
              initialValues={bomInitialValues}
            >
              <Form.List name="components">
                {(fields, { add, remove }) => (
                  <>
                    <div className="bom-components-list">
                      {fields.map((field, index) => (
                        <div key={field.key} className="bom-component-row">
                          <div className="bom-component-col col-component">
                            <Form.Item
                              label={index === 0 ? 'Thành phần' : ''}
                              name={[field.name, 'componentId']}
                              rules={[{ required: true, message: 'Chọn sản phẩm thành phần' }]}
                            >
                              <Select
                                placeholder="Chọn sản phẩm"
                                showSearch
                                options={bomComponentOptions}
                                optionFilterProp="label"
                                allowClear
                                onChange={(value) => handleBomComponentChange(value, field.name)}
                              />
                            </Form.Item>
                          </div>

                          <div className="bom-component-col col-quantity">
                            <Form.Item
                              label={index === 0 ? 'Số lượng' : ''}
                              name={[field.name, 'quantity']}
                              rules={[
                                {
                                  required: true,
                                  message: 'Nhập số lượng'
                                },
                                {
                                  validator: (_, value) => {
                                    if (value && value > 0) {
                                      return Promise.resolve();
                                    }
                                    return Promise.reject(new Error('Số lượng phải lớn hơn 0'));
                                  }
                                }
                              ]}
                            >
                              <InputNumber min={0.0001} step={0.1} style={{ width: '100%' }} />
                            </Form.Item>
                          </div>

                          <div className="bom-component-col col-unit">
                            <Form.Item label={index === 0 ? 'Đơn vị' : ''} name={[field.name, 'unitCode']}>
                              <Input placeholder="VD: Ly, Phần..." />
                            </Form.Item>
                          </div>

                          <div className="bom-component-col col-waste">
                            <Form.Item label={index === 0 ? '% hao hụt' : ''} name={[field.name, 'wastePercent']}>
                              <InputNumber min={0} max={100} step={0.1} style={{ width: '100%' }} />
                            </Form.Item>
                          </div>

                          <div className="bom-component-col col-note">
                            <Form.Item label={index === 0 ? 'Ghi chú' : ''} name={[field.name, 'note']}>
                              <Input placeholder="Ghi chú (tuỳ chọn)" />
                            </Form.Item>
                          </div>

                          <div className="bom-component-col col-action">
                            <Button
                              danger
                              type="text"
                              icon={<Trash2 size={14} />}
                              onClick={() => remove(field.name)}
                            />
                          </div>
                        </div>
                      ))}
                    </div>

                    <Button
                      type="dashed"
                      block
                      icon={<Plus size={14} />}
                      onClick={() =>
                        add({ componentId: null, quantity: 1, unitCode: '', wastePercent: 0, note: '' })
                      }
                    >
                      Thêm thành phần
                    </Button>
                  </>
                )}
              </Form.List>
            </Form>

            <Text type="secondary" className="bom-modal-footer-note">
              Sau khi lưu, mở lại sản phẩm để xem danh sách thành phần đã cấu hình.
            </Text>
          </Spin>
        </Modal>

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
            extra={`Nhập mã bắt đầu bằng '${COMBO_PREFIX}' (ví dụ: ${COMBO_PREFIX}001) để hệ thống tự nhận diện Combo BOM.`}
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
                {categories
                  .filter(c => c.value !== 'all')
                  .map(cat => (
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