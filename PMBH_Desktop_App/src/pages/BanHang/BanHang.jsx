import React, { useState, useEffect } from 'react';
import { 
  Layout, 
  Row, 
  Col, 
  Card, 
  Button, 
  Select, 
  Typography, 
  message, 
  Badge, 
  Space,
  Divider,
  InputNumber,
  Input,
  Popconfirm,
  Modal,
  Table
} from 'antd';
import { 
  Coffee, 
  Users, 
  Clock, 
  ShoppingCart, 
  CreditCard, 
  Trash2, 
  Plus, 
  Minus,
  Search,
  ArrowLeft,
  CheckCircle,
  Edit3,
  X,
  Printer,
  History,
  Save,
  FileText,
  Copy
} from 'lucide-react';

// Import API services
import {
  loadBan,
  loadKhuVuc,
  getAllSanPham,
  getLoaiSanPham,
  taoHoaDon,
  taoCthd,
  loadDsCthd,
  loadHoaDonTheoBan,
  thanhToanHoaDonBanhang,
  chuyenXuongBep,
  xoaCtHd,
  capNhatCtHd,
  loadTrangThaiBanTheoHoaDon,
  loadDanhMucSp,
  loadSanPhamTheoMaDanhMucSp,
  huyHoaDon,
  tinhTongTienHoaDon,
  layLichSuHoaDonTheoBan,
  taoHoaDonTam,
  chuyenHoaDonTamThanhChinhThuc,
  saoChepHoaDon,
  loadDsCthdV3
} from '../../services/apiServices';

import './BanHang.css';

const { Title, Text } = Typography;
const { Content, Sider } = Layout;
const { Option } = Select;

// View states based on flow requirements
const VIEW_STATES = {
  TABLES: 'tables',      // Initial view - show table grid
  INVOICE: 'invoice',    // Show invoice UI after selecting table  
  PRODUCTS: 'products'   // Show product grid after clicking "select items"
};

const BanHang = () => {
  // View state management
  const [currentView, setCurrentView] = useState(VIEW_STATES.TABLES);
  
  // State quản lý bàn
  const [tables, setTables] = useState([]);
  const [areas, setAreas] = useState([]);
  const [selectedTable, setSelectedTable] = useState(null);
  const [selectedArea, setSelectedArea] = useState('all');
  
  // State quản lý sản phẩm
  const [categories, setCategories] = useState([]);
  const [products, setProducts] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [searchTerm, setSearchTerm] = useState('');
  
  // State quản lý đơn hàng
  const [currentInvoice, setCurrentInvoice] = useState(null);
  const [invoiceDetails, setInvoiceDetails] = useState([]);
  const [orderTotal, setOrderTotal] = useState(0);
  
  // State cho modal chọn số lượng
  const [showQuantityModal, setShowQuantityModal] = useState(false);
  const [selectedProductForAdd, setSelectedProductForAdd] = useState(null);
  const [quantityToAdd, setQuantityToAdd] = useState(1);
  
  // State cho modal update số lượng
  const [showUpdateQuantityModal, setShowUpdateQuantityModal] = useState(false);
  const [selectedItemForUpdate, setSelectedItemForUpdate] = useState(null);
  const [newQuantityForUpdate, setNewQuantityForUpdate] = useState(1);
  
  // State cho Enhanced Invoice Management
  const [invoiceHistory, setInvoiceHistory] = useState([]);
  const [showInvoiceHistory, setShowInvoiceHistory] = useState(false);
  const [editingInvoice, setEditingInvoice] = useState(false);
  const [draftInvoices, setDraftInvoices] = useState([]);
  const [invoiceSummary, setInvoiceSummary] = useState({
    subtotal: 0,
    tax: 0,
    discount: 0,
    total: 0
  });
  
  // State UI
  const [loading, setLoading] = useState(false);
  const [lastRefresh, setLastRefresh] = useState(null);
  const [autoRefreshEnabled, setAutoRefreshEnabled] = useState(true);
  const [lastAction, setLastAction] = useState(null); // Track last user action
  const [quickRefreshEnabled, setQuickRefreshEnabled] = useState(false); // For post-action refresh

  // Helper functions cho table status
  const getTableBadgeStatus = (status) => {
    switch (status) {
      case 'available': return 'success';
      case 'occupied': return 'error';
      case 'serving': return 'warning';
      case 'checkout': return 'processing';
      default: return 'default';
    }
  };

  // Helper function để lấy màu sắc theo theme cho table status
  const getTableStatusColor = (status) => {
    switch (status) {
      case 'available': return '#77d4fb';  // Light blue - available
      case 'occupied': return '#197dd3';   // Main blue - occupied
      case 'serving': return '#bdbcc4';    // Gray - serving
      case 'checkout': return '#4b4344';   // Dark - checkout
      default: return '#bdbcc4';
    }
  };

  // Helper function để lấy text màu
  const getTableStatusTextColor = (status) => {
    switch (status) {
      case 'available': return '#4b4344';
      case 'occupied': return '#ffffff';
      case 'serving': return '#4b4344';
      case 'checkout': return '#ffffff';
      default: return '#4b4344';
    }
  };

  // Helper function để lấy text trạng thái
  const getTableStatusText = (status) => {
    switch (status) {
      case 'available': return 'Trống';
      case 'occupied': return 'Có khách';
      case 'serving': return 'Đang phục vụ';
      case 'checkout': return 'Chờ thanh toán';
      default: return 'Không xác định';
    }
  };

  // Load dữ liệu ban đầu
  useEffect(() => {
    loadInitialData();
  }, []);

  // Auto refresh effect cho real-time table status
  useEffect(() => {
    let intervalId;
    
    if (autoRefreshEnabled && currentView === VIEW_STATES.TABLES) {
      // Auto refresh mỗi 30 giây khi đang ở view TABLES
      intervalId = setInterval(() => {
        console.log('Auto refreshing table status...');
        refreshTableStatusOnly();
      }, 30000); // 30 seconds
    }

    return () => {
      if (intervalId) {
        clearInterval(intervalId);
      }
    };
  }, [autoRefreshEnabled, currentView]);

  // Quick refresh effect sau khi có action
  useEffect(() => {
    let quickIntervalId;
    
    if (quickRefreshEnabled && currentView === VIEW_STATES.TABLES) {
      // Quick refresh mỗi 2 giây trong 10 giây sau action
      quickIntervalId = setInterval(() => {
        console.log('Quick refreshing after action...');
        refreshTableStatusOnly();
      }, 2000); // 2 seconds
    }

    return () => {
      if (quickIntervalId) {
        clearInterval(quickIntervalId);
      }
    };
  }, [quickRefreshEnabled, currentView]);

  // Manual refresh handler
  const handleManualRefresh = async () => {
    setLastRefresh(new Date());
    await loadTables();
    message.success('Đã cập nhật trạng thái bàn');
  };

  // Refresh chỉ trạng thái bàn (không reload toàn bộ)
  const refreshTableStatusOnly = async () => {
    if (tables.length === 0) return;
    
    try {
      setLoading(true);
      await loadTableStatuses(tables);
      setLastRefresh(new Date());
      console.log('Table status refreshed at:', new Date().toLocaleTimeString());
    } catch (error) {
      console.error('Error refreshing table status:', error);
    } finally {
      setLoading(false);
    }
  };

  // Trigger quick refresh sau khi có action
  const triggerQuickRefresh = (actionType) => {
    console.log(`Action triggered: ${actionType}, starting quick refresh...`);
    setLastAction({ type: actionType, timestamp: new Date() });
    setQuickRefreshEnabled(true);
    
    // Refresh ngay lập tức
    setTimeout(() => {
      refreshTableStatusOnly();
    }, 500); // 0.5 giây

    // Refresh lần 2 sau 2 giây để đảm bảo
    setTimeout(() => {
      refreshTableStatusOnly();
    }, 2000); // 2 giây

    // Tắt quick refresh sau 10 giây
    setTimeout(() => {
      setQuickRefreshEnabled(false);
    }, 10000);
  };

  // Auto-refresh table statuses trong Tables view
  useEffect(() => {
    let interval;
    if (currentView === VIEW_STATES.TABLES && tables.length > 0) {
      // Refresh mỗi 30 giây
      interval = setInterval(() => {
        loadTableStatuses(tables);
      }, 30000);
    }
    
    return () => {
      if (interval) clearInterval(interval);
    };
  }, [currentView, tables]);
  
  // Tính toán tổng tiền khi invoice details thay đổi
  useEffect(() => {
    if (invoiceDetails.length > 0) {
      const total = invoiceDetails.reduce((sum, item) => {
        // API trả về field 'gia' hoặc 'giaBan' tùy endpoint, không phải 'donGia'
        const price = parseFloat(item.gia || item.giaBan || item.donGia || 0);
        const quantity = parseInt(item.soLuong || 0);
        return sum + (price * quantity);
      }, 0);
      setOrderTotal(total);
    } else {
      setOrderTotal(0);
    }
  }, [invoiceDetails]);

  // Load dữ liệu ban đầu - chỉ tables và areas
  const loadInitialData = async () => {
    await Promise.all([
      loadTables(),
      loadAreas()
    ]);
  };

  // Load danh sách bàn với trạng thái
  const loadTables = async () => {
    try {
      setLoading(true);
      const tablesResponse = await loadBan();
      console.log('Tables response:', tablesResponse);
      
      // Xử lý dữ liệu bàn - format: {"idBan":"1","tenBan":"Quầy 1","idKhuVuc":"NGOAI"}
      let tablesData = [];
      if (Array.isArray(tablesResponse)) {
        tablesData = tablesResponse.map(table => ({
          id: table.idBan,
          name: table.tenBan,
          areaId: table.idKhuVuc,
          status: 'available' // Sẽ được cập nhật từ loadTableStatuses
        }));
      } else {
        console.warn('Tables data is not in expected format:', tablesResponse);
        tablesData = [];
      }

      setTables(tablesData);

      // Load trạng thái bàn riêng biệt
      await loadTableStatuses(tablesData);
    } catch (error) {
      console.error('Error loading tables:', error);
      message.error('Không thể tải danh sách bàn');
    } finally {
      setLoading(false);
    }
  };

  // Load trạng thái bàn theo hóa đơn
  // Load trạng thái chi tiết cho từng bàn  
  const loadTableStatuses = async (currentTables) => {
    if (!currentTables || currentTables.length === 0) return;
    
    try {
      const statusResponse = await loadTrangThaiBanTheoHoaDon();
      console.log('=== DEBUG TABLE STATUS ===');
      console.log('Table status response:', statusResponse);
      console.log('Current tables:', currentTables);
      
      if (Array.isArray(statusResponse)) {
        console.log('Processing', statusResponse.length, 'status records');
        
        // Debug: Log first few items to see structure
        if (statusResponse.length > 0) {
          console.log('Sample status record:', statusResponse[0]);
        }
        
        // Xử lý song song để load thông tin chi tiết cho từng bàn
        const updatedTables = await Promise.all(
          currentTables.map(async (table) => {
            console.log(`Processing table ${table.id} (${table.name})`);
            
            // Try multiple field combinations to find table status
            const tableStatus = statusResponse.find(status => {
              const matches = status.maBan === table.id || 
                             status.idBan === table.id ||
                             status.ban_id === table.id ||
                             status.table_id === table.id ||
                             parseInt(status.maBan) === parseInt(table.id) ||
                             parseInt(status.idBan) === parseInt(table.id);
              if (matches) {
                console.log(`Found status for table ${table.id}:`, status);
              }
              return matches;
            });
            
            if (tableStatus) {
              console.log(`Table ${table.id} has status record:`, tableStatus);
              
              // Check if table has active invoice
              const hasActiveInvoice = tableStatus.maHoaDon || 
                                     tableStatus.maHd || 
                                     tableStatus.invoice_id ||
                                     tableStatus.hoa_don_id;
              
              if (hasActiveInvoice) {
                try {
                  const invoiceId = tableStatus.maHoaDon || 
                                  tableStatus.maHd || 
                                  tableStatus.invoice_id ||
                                  tableStatus.hoa_don_id;
                  
                  console.log(`Loading details for invoice ${invoiceId}`);
                  
                  // Load chi tiết hóa đơn để tính tổng tiền và lấy danh sách món
                  const [invoiceDetails, totalAmountResponse] = await Promise.all([
                    loadDsCthd(invoiceId),
                    tinhTongTienHoaDon({ maHd: invoiceId }).catch(() => null)
                  ]);

                  // Determine status based on invoice state - FIXED LOGIC
                  let status = 'occupied'; // Default to occupied if has active invoice
                  const statusValue = tableStatus.trangThai || 
                                    tableStatus.status || 
                                    tableStatus.state ||
                                    tableStatus.trang_thai;
                  
                  console.log(`Status value for table ${table.id}:`, statusValue);
                  
                  // CORRECTED LOGIC: If table has invoice, it cannot be available
                  if (statusValue === '0' || statusValue === 0) {
                    status = 'occupied'; // Có invoice nhưng chưa thanh toán
                  } else if (statusValue === '1' || statusValue === 1 || statusValue === 'active') {
                    status = 'occupied'; // Đang có khách
                  } else if (statusValue === '2' || statusValue === 2) {
                    status = 'serving'; // Đang phục vụ
                  } else if (statusValue === '3' || statusValue === 3) {
                    status = 'checkout'; // Chuẩn bị thanh toán
                  } else {
                    status = 'occupied'; // Default cho bất kỳ case nào có invoice
                  }

                  // Tính thời gian ngồi
                  let sittingTime = '';
                  const orderTime = tableStatus.gioVao || 
                                  tableStatus.gio_vao || 
                                  tableStatus.order_time ||
                                  tableStatus.created_at;
                                  
                  if (orderTime) {
                    try {
                      const startTime = new Date(orderTime);
                      const now = new Date();
                      const diffMinutes = Math.floor((now - startTime) / 60000);
                      const hours = Math.floor(diffMinutes / 60);
                      const minutes = diffMinutes % 60;
                      sittingTime = hours > 0 ? `${hours}h ${minutes}m` : `${minutes}m`;
                    } catch (timeError) {
                      console.error('Error calculating sitting time:', timeError);
                      sittingTime = '';
                    }
                  }

                  const result = {
                    ...table,
                    status,
                    invoiceId,
                    customerCount: tableStatus.soKhach || tableStatus.so_khach || 0,
                    orderTime: orderTime || null,
                    sittingTime,
                    totalAmount: totalAmountResponse || 0,
                    itemCount: Array.isArray(invoiceDetails) ? invoiceDetails.length : 0,
                    orderItems: Array.isArray(invoiceDetails) ? invoiceDetails.slice(0, 3) : []
                  };
                  
                  console.log(`Final result for table ${table.id}:`, result);
                  return result;
                } catch (error) {
                  console.error(`Error loading details for table ${table.id}:`, error);
                  return {
                    ...table,
                    status: 'occupied',
                    invoiceId: hasActiveInvoice,
                    customerCount: tableStatus.soKhach || tableStatus.so_khach || 0,
                    orderTime: tableStatus.gioVao || tableStatus.gio_vao || null,
                    sittingTime: '',
                    totalAmount: 0,
                    itemCount: 0,
                    orderItems: []
                  };
                }
              } else {
                // Has status record but no active invoice - table might be reserved or cleaned
                const statusValue = tableStatus.trangThai || 
                                  tableStatus.status || 
                                  tableStatus.state ||
                                  tableStatus.trang_thai;
                
                let status = 'available'; // Default available if no invoice
                console.log(`Table ${table.id} no invoice, status value: ${statusValue}`);
                
                // Only set occupied if explicitly marked as occupied without invoice
                if (statusValue === '1' || statusValue === 1 || statusValue === 'occupied') {
                  status = 'occupied'; // Bàn được đặt trước hoặc đang dọn dẹp
                } else if (statusValue === '2' || statusValue === 2) {
                  status = 'serving'; // Rare case
                } else if (statusValue === '3' || statusValue === 3) {
                  status = 'checkout'; // Rare case
                } // else remains available
                
                console.log(`Table ${table.id} no invoice, final status: ${status}`);
                
                return {
                  ...table,
                  status,
                  invoiceId: null,
                  customerCount: 0,
                  orderTime: null,
                  sittingTime: '',
                  totalAmount: 0,
                  itemCount: 0,
                  orderItems: []
                };
              }
            } else {
              console.log(`No status record found for table ${table.id}, marking as available`);
            }
            
            return {
              ...table,
              status: 'available',
              invoiceId: null,
              customerCount: 0,
              orderTime: null,
              sittingTime: '',
              totalAmount: 0,
              itemCount: 0,
              orderItems: []
            };
          })
        );
        
        console.log('=== FINAL UPDATED TABLES ===');
        console.log(updatedTables);
        setTables(updatedTables);
      } else {
        console.warn('Status response is not an array:', statusResponse);
      }
    } catch (error) {
      console.error('Error loading table statuses:', error);
      // Don't show error message for status loading failure
    }
  };

  // Load danh sách khu vực
  const loadAreas = async () => {
    try {
      const areasResponse = await loadKhuVuc();
      console.log('Areas response:', areasResponse);
      
      // Xử lý dữ liệu areas tương tự như BanHangOld
      let areasData = [];
      if (Array.isArray(areasResponse)) {
        areasData = areasResponse;
      } else if (areasResponse && areasResponse.success && areasResponse.data) {
        if (Array.isArray(areasResponse.data)) {
          areasData = areasResponse.data;
        } else if (typeof areasResponse.data === 'object') {
          areasData = Object.values(areasResponse.data);
        }
      } else if (areasResponse && typeof areasResponse === 'object') {
        areasData = Object.values(areasResponse);
      }

      setAreas(areasData);
    } catch (error) {
      console.error('Error loading areas:', error);
      message.error('Không thể tải danh sách khu vực');
    }
  };

  // Load danh mục sản phẩm (chỉ khi cần)
  const loadProductCategories = async () => {
    try {
      // Sử dụng API mới loadDanhMucSp thay vì getLoaiSanPham
      const categoriesResponse = await loadDanhMucSp();
      console.log('Categories response:', categoriesResponse);
      
      // Xử lý dữ liệu categories theo mobile logic pattern
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

      // Map categories to consistent format following mobile logic
      const mappedCategories = categoriesData.map(cat => ({
        value: cat.maDanhMucSp || cat.idLoaiSp || cat.id || cat.maLoai,
        label: cat.tenDanhMucSp || cat.tenLoaiSp || cat.ten || cat.tenLoai,
        // Keep original fields for backward compatibility
        maDm: cat.maDanhMucSp || cat.idLoaiSp || cat.id || cat.maLoai,
        ten: cat.tenDanhMucSp || cat.tenLoaiSp || cat.ten || cat.tenLoai
      }));

      setCategories(mappedCategories);
    } catch (error) {
      console.error('Error loading categories:', error);
      // Fallback to old API if new one fails
      try {
        const fallbackResponse = await getLoaiSanPham();
        console.log('Fallback categories response:', fallbackResponse);
        // Process fallback response with same logic
        let categoriesData = [];
        if (Array.isArray(fallbackResponse)) {
          categoriesData = fallbackResponse;
        } else if (fallbackResponse && typeof fallbackResponse === 'object') {
          categoriesData = Object.values(fallbackResponse);
        }
        
        const mappedCategories = categoriesData.map(cat => ({
          value: cat.idLoaiSp || cat.id || cat.maLoai,
          label: cat.tenLoaiSp || cat.ten || cat.tenLoai,
          maDm: cat.idLoaiSp || cat.id || cat.maLoai,
          ten: cat.tenLoaiSp || cat.ten || cat.tenLoai
        }));
        
        setCategories(mappedCategories);
      } catch (fallbackError) {
        console.error('Error loading categories (fallback):', fallbackError);
      }
    }
  };

  // Load sản phẩm (chỉ khi cần)
  const loadProducts = async () => {
    try {
      const productsResponse = await getAllSanPham();
      console.log('Products response:', productsResponse);

      // Xử lý dữ liệu products tương tự như categories
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

      // Map products to consistent format like ChonSanPham
      const mappedProducts = productsData.map(product => ({
        id: product.maSp || product.id || product.maSP,
        ten: product.tenSp || product.ten || product.tenSP,
        gia: product.giaBan || product.gia || product.donGia || 0,
        danhMuc: product.danhMuc || product.maLoai,
        moTa: product.moTa || product.ghiChu || '',
        hinhAnh: product.hinhAnh || '/images/default-product.jpg'
      }));

      setProducts(mappedProducts);
    } catch (error) {
      console.error('Error loading products:', error);
    }
  };

  // FLOW 1: Chọn bàn và chuyển sang view hóa đơn
  const handleTableSelect = async (table) => {
    try {
      setSelectedTable(table);
      setLoading(true);
      
      // Ưu tiên sử dụng dữ liệu đã có từ table object
      if (table.invoiceId && table.status !== 'available') {
        console.log(`Using existing invoice data for table ${table.id}:`, table.invoiceId);
        
        // Tạo invoice object từ dữ liệu có sẵn
        const invoice = {
          maHd: table.invoiceId,
          maBan: table.id,
          tenBan: table.name
        };
        setCurrentInvoice(invoice);
        
        // Load chi tiết hóa đơn
        const detailsResponse = await loadDsCthd(table.invoiceId);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse);
        }
        
        message.success(`Đã chọn bàn ${table.name} - Hóa đơn #${table.invoiceId}`);
      } else {
        // Fallback: Load hóa đơn từ API nếu không có dữ liệu sẵn
        console.log(`Loading invoice from API for table ${table.id}`);
        const invoiceResponse = await loadHoaDonTheoBan({ maBan: table.id });
        
        if (invoiceResponse && invoiceResponse.length > 0) {
          const invoice = invoiceResponse[0];
          setCurrentInvoice(invoice);
          
          // Load chi tiết hóa đơn
          const detailsResponse = await loadDsCthd(invoice.maHd);
          if (Array.isArray(detailsResponse)) {
            setInvoiceDetails(detailsResponse);
          }
          
          message.success(`Đã chọn bàn ${table.name} - Hóa đơn #${invoice.maHd}`);
        } else {
          setCurrentInvoice(null);
          setInvoiceDetails([]);
          message.info(`Bàn ${table.name} trống - Sẵn sàng tạo đơn mới`);
        }
      }
      
      // Chuyển sang view hóa đơn
      setCurrentView(VIEW_STATES.INVOICE);
      
      // Trigger quick refresh sau khi chọn bàn
      triggerQuickRefresh('TABLE_SELECT');
    } catch (error) {
      console.error('Error selecting table:', error);
      message.error('Không thể tải thông tin bàn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // FLOW 2: Chuyển sang view chọn sản phẩm
  const handleSelectItems = async () => {
    try {
      setLoading(true);
      // Load categories và products khi cần
      await Promise.all([
        loadProductCategories(),
        loadProducts()
      ]);
      
      setCurrentView(VIEW_STATES.PRODUCTS);
    } catch (error) {
      console.error('Error loading products:', error);
      message.error('Không thể tải danh sách sản phẩm');
    } finally {
      setLoading(false);
    }
  };

  // Tạo hóa đơn mới cho bàn
  const createNewInvoice = async () => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn');
      return;
    }

    try {
      setLoading(true);
      const response = await taoHoaDon(selectedTable.id);
      
      if (response && response.success && response.message) {
        // API trả về mã hóa đơn trong message
        const newInvoice = {
          maHd: response.message,
          maBan: selectedTable.id,
          tenBan: selectedTable.name
        };
        setCurrentInvoice(newInvoice);
        setInvoiceDetails([]);
        message.success(`Đã tạo hóa đơn mới: ${response.message}`);
        
        // Trigger quick refresh sau khi tạo hóa đơn mới
        triggerQuickRefresh('CREATE_INVOICE');
      } else {
        throw new Error('Không thể tạo hóa đơn');
      }
    } catch (error) {
      console.error('Error creating invoice:', error);
      message.error('Không thể tạo hóa đơn mới: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Thêm sản phẩm vào hóa đơn với modal chọn số lượng
  const addProductToOrder = (product) => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn trước');
      return;
    }

    // Mở modal chọn số lượng
    setSelectedProductForAdd(product);
    setQuantityToAdd(1);
    setShowQuantityModal(true);
  };

  // Xác nhận thêm sản phẩm với số lượng đã chọn
  const confirmAddProduct = async () => {
    if (!selectedProductForAdd || !selectedTable) {
      return;
    }

    // Nếu chưa có hóa đơn, tạo mới
    if (!currentInvoice) {
      await createNewInvoice();
      // Đợi một chút để đảm bảo state đã cập nhật
      await new Promise(resolve => setTimeout(resolve, 100));
    }

    // Kiểm tra lại sau khi tạo hóa đơn
    if (!currentInvoice || !currentInvoice.maHd) {
      message.error('Không thể tạo hóa đơn, vui lòng thử lại');
      return;
    }

    try {
      setLoading(true);
      const response = await taoCthd(currentInvoice.maHd, selectedProductForAdd.id, quantityToAdd);
      
      if (response) {
        // Reload chi tiết hóa đơn
        const detailsResponse = await loadDsCthd(currentInvoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse);
        }
        message.success(`Đã thêm ${selectedProductForAdd.ten} (x${quantityToAdd}) vào đơn hàng`);
        
        // Trigger quick refresh sau khi thêm sản phẩm
        triggerQuickRefresh('ADD_PRODUCT');
        
        // Quay lại view hóa đơn sau khi thêm sản phẩm
        setCurrentView(VIEW_STATES.INVOICE);
        
        // Đóng modal
        setShowQuantityModal(false);
        setSelectedProductForAdd(null);
        setQuantityToAdd(1);
      }
    } catch (error) {
      console.error('Error adding product:', error);
      message.error('Không thể thêm sản phẩm: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Cập nhật số lượng sản phẩm - mở modal
  const updateProductQuantity = (item, newQuantity) => {
    if (newQuantity <= 0) {
      removeProductFromOrder(item.maCt);
      return;
    }

    // Mở modal để nhập số lượng mới
    setSelectedItemForUpdate(item);
    setNewQuantityForUpdate(newQuantity);
    setShowUpdateQuantityModal(true);
  };

  // Xác nhận update số lượng bằng cách xóa và thêm lại
  const confirmUpdateQuantity = async () => {
    if (!selectedItemForUpdate || !currentInvoice) {
      return;
    }

    try {
      setLoading(true);
      
      // Bước 1: Xóa item hiện tại
      await xoaCtHd({ maCt: selectedItemForUpdate.maCt });
      
      // Bước 2: Tìm sản phẩm gốc để lấy mã sản phẩm
      const foundProduct = products.find(p => p.ten === selectedItemForUpdate.tenSp);
      if (!foundProduct) {
        throw new Error('Không tìm thấy thông tin sản phẩm');
      }
      
      // Bước 3: Thêm lại với số lượng mới
      await taoCthd(currentInvoice.maHd, foundProduct.id, newQuantityForUpdate);
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await loadDsCthd(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
      
      message.success('Đã cập nhật số lượng');
      
      // Trigger quick refresh sau khi cập nhật số lượng
      triggerQuickRefresh('UPDATE_QUANTITY');
      
      // Đóng modal
      setShowUpdateQuantityModal(false);
      setSelectedItemForUpdate(null);
      setNewQuantityForUpdate(1);
    } catch (error) {
      console.error('Error updating quantity:', error);
      message.error('Không thể cập nhật số lượng: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Xóa sản phẩm khỏi đơn hàng
  const removeProductFromOrder = async (maCt) => {
    try {
      setLoading(true);
      
      console.log('=== REMOVING PRODUCT ===');
      console.log('maCt to remove:', maCt);
      console.log('currentInvoice:', currentInvoice);
      
      // Sử dụng API mới xoaCtHd với object parameter
      const deleteResponse = await xoaCtHd({ maCt });
      console.log('Delete response:', deleteResponse);
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await loadDsCthd(currentInvoice.maHd);
      console.log('Reloaded invoice details:', detailsResponse);
      
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
      
      message.success('Đã xóa sản phẩm khỏi hóa đơn');
      
      // Trigger quick refresh sau khi xóa sản phẩm
      triggerQuickRefresh('REMOVE_PRODUCT');
    } catch (error) {
      console.error('Error removing product:', error);
      message.error('Không thể xóa sản phẩm: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Chuyển xuống bếp
  const sendToKitchen = async () => {
    if (!currentInvoice) {
      message.error('Không có hóa đơn để chuyển xuống bếp');
      return;
    }

    try {
      setLoading(true);
      
      // Sử dụng API mới chuyenXuongBep với object parameter
      await chuyenXuongBep({ maHd: currentInvoice.maHd });
      message.success('Đã chuyển đơn hàng xuống bếp');
      
      // Trigger quick refresh sau khi chuyển xuống bếp
      triggerQuickRefresh('SEND_TO_KITCHEN');
      
      // Refresh invoice details để cập nhật trạng thái
      const detailsResponse = await loadDsCthd(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
    } catch (error) {
      console.error('Error sending to kitchen:', error);
      message.error('Không thể chuyển xuống bếp: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Thanh toán hóa đơn
  const processPayment = async () => {
    if (!currentInvoice || invoiceDetails.length === 0) {
      message.error('Không có đơn hàng để thanh toán');
      return;
    }

    try {
      setLoading(true);
      
      // Tính toán tổng tiền từ server để đảm bảo chính xác
      const totalResponse = await tinhTongTienHoaDon(currentInvoice.maHd);
      const serverTotal = totalResponse && totalResponse.tongTien ? 
        parseFloat(totalResponse.tongTien) : orderTotal;

      // Thanh toán với số tiền chính xác
      await thanhToanHoaDonBanhang({
        maHd: currentInvoice.maHd,
        tongTien: serverTotal,
        tienKhachDua: serverTotal, // Simplified payment - customer pays exact amount
        tienThua: 0
      });

      message.success('Thanh toán thành công');
      
      // Trigger quick refresh sau khi thanh toán
      triggerQuickRefresh('PAYMENT_COMPLETE');
      
      // Reset và quay về trang chọn bàn
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      setSelectedTable(null);
      setCurrentView(VIEW_STATES.TABLES);
      
      // Refresh table data to update status
      await loadTables();
      
    } catch (error) {
      console.error('Error processing payment:', error);
      message.error('Không thể xử lý thanh toán: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // ===== ENHANCED INVOICE MANAGEMENT FUNCTIONS =====
  
  // Copy invoice
  const copyInvoice = async (maHd) => {
    try {
      const result = await api.saoChepHoaDon(maHd, selectedTable.name);
      if (result.success) {
        message.success('Sao chép hóa đơn thành công!');
        // Refresh current invoice data
        await loadInvoiceData();
        await triggerTableRefresh();
      } else {
        message.error('Không thể sao chép hóa đơn: ' + (result.message || 'Lỗi không xác định'));
      }
    } catch (error) {
      console.error('Error copying invoice:', error);
      message.error('Lỗi khi sao chép hóa đơn');
    }
  };

  // Reprint invoice
  const reprintInvoice = async (invoice) => {
    try {
      // Here you would integrate with your printing system
      console.log('Reprinting invoice:', invoice);
      message.success('Đang chuẩn bị in hóa đơn...');
      
      // Example print action - replace with actual print implementation
      window.print();
    } catch (error) {
      console.error('Error reprinting invoice:', error);
      message.error('Lỗi khi in lại hóa đơn');
    }
  };

  // Edit invoice details
  const editInvoiceDetails = () => {
    if (!selectedTable?.currentInvoice) {
      message.error('Không có hóa đơn để chỉnh sửa');
      return;
    }
    
    setEditingInvoice(true);
    message.info('Chế độ chỉnh sửa hóa đơn đã được kích hoạt');
  };

  // Save invoice edits
  const saveInvoiceEdits = async () => {
    try {
      setLoading(true);
      
      // Calculate updated summary
      const updatedSummary = calculateInvoiceSummary();
      
      // Update invoice with new data
      await api.capNhatHoaDon(selectedTable.currentInvoice.maHd, {
        chiTietMon: invoiceItems,
        tongTien: updatedSummary.total,
        thue: updatedSummary.tax,
        giamGia: updatedSummary.discount
      });
      
      setEditingInvoice(false);
      message.success('Đã lưu thay đổi hóa đơn');
      
      // Refresh data
      await loadInvoiceData();
      await triggerTableRefresh();
      
    } catch (error) {
      console.error('Error saving invoice edits:', error);
      message.error('Lỗi khi lưu thay đổi hóa đơn');
    } finally {
      setLoading(false);
    }
  };

  // Cancel invoice edits
  const cancelInvoiceEdits = () => {
    setEditingInvoice(false);
    // Reload original invoice data
    loadInvoiceData();
    message.info('Đã hủy chỉnh sửa hóa đơn');
  };

  // Cancel/Hủy hóa đơn
  const cancelInvoice = async () => {
    if (!currentInvoice) {
      message.error('Không có hóa đơn để hủy');
      return;
    }

    try {
      setLoading(true);
      await huyHoaDon(currentInvoice.maHd);
      message.success('Đã hủy hóa đơn thành công');
      
      // Trigger quick refresh sau khi hủy hóa đơn
      triggerQuickRefresh('CANCEL_INVOICE');
      
      // Reset và quay về trang chọn bàn
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      setSelectedTable(null);
      setCurrentView(VIEW_STATES.TABLES);
      
      // Refresh table data to update status
      await loadTables();
      
    } catch (error) {
      console.error('Error canceling invoice:', error);
      message.error('Không thể hủy hóa đơn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Load lịch sử hóa đơn theo bàn
  const loadInvoiceHistory = async () => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn');
      return;
    }

    try {
      setLoading(true);
      const today = new Date();
      const fromDate = new Date(today.setDate(today.getDate() - 30)); // 30 ngày trước
      const toDate = new Date(); // Hôm nay

      const historyResponse = await layLichSuHoaDonTheoBan(
        selectedTable.id, 
        fromDate.toISOString().split('T')[0], 
        toDate.toISOString().split('T')[0]
      );

      if (Array.isArray(historyResponse)) {
        setInvoiceHistory(historyResponse);
        setShowInvoiceHistory(true);
        message.success(`Đã tải ${historyResponse.length} hóa đơn trong 30 ngày qua`);
      } else {
        setInvoiceHistory([]);
        message.info('Không có lịch sử hóa đơn');
      }
    } catch (error) {
      console.error('Error loading invoice history:', error);
      message.error('Không thể tải lịch sử hóa đơn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Tạo hóa đơn tạm (draft)
  const createDraftInvoice = async () => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn');
      return;
    }

    try {
      setLoading(true);
      const draftResponse = await taoHoaDonTam(selectedTable.id);
      
      if (draftResponse && draftResponse.success) {
        const newDraft = {
          maHd: draftResponse.message,
          maBan: selectedTable.id,
          tenBan: selectedTable.name,
          isDraft: true
        };
        setCurrentInvoice(newDraft);
        setInvoiceDetails([]);
        message.success(`Đã tạo hóa đơn tạm: ${draftResponse.message}`);
        
        // Trigger quick refresh sau khi tạo draft
        triggerQuickRefresh('CREATE_DRAFT');
      } else {
        throw new Error('Không thể tạo hóa đơn tạm');
      }
    } catch (error) {
      console.error('Error creating draft invoice:', error);
      message.error('Không thể tạo hóa đơn tạm: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Chuyển hóa đơn tạm thành chính thức
  const convertDraftToOfficial = async () => {
    if (!currentInvoice || !currentInvoice.isDraft) {
      message.error('Không có hóa đơn tạm để chuyển đổi');
      return;
    }

    try {
      setLoading(true);
      await chuyenHoaDonTamThanhChinhThuc(currentInvoice.maHd);
      
      // Update current invoice to remove draft status
      setCurrentInvoice(prev => ({ ...prev, isDraft: false }));
      message.success('Đã chuyển hóa đơn tạm thành chính thức');
      
      // Trigger quick refresh sau khi chuyển đổi
      triggerQuickRefresh('CONVERT_DRAFT');
      
    } catch (error) {
      console.error('Error converting draft to official:', error);
      message.error('Không thể chuyển đổi hóa đơn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Tính toán invoice summary với thuế, giảm giá
  const calculateInvoiceSummary = () => {
    if (!invoiceDetails || invoiceDetails.length === 0) {
      setInvoiceSummary({ subtotal: 0, tax: 0, discount: 0, total: 0 });
      return;
    }

    const subtotal = invoiceDetails.reduce((sum, item) => {
      // API trả về field 'gia' hoặc 'giaBan' tùy endpoint, không phải 'donGia'
      const price = parseFloat(item.gia || item.giaBan || item.donGia || 0);
      const quantity = parseInt(item.soLuong || 0);
      return sum + (price * quantity);
    }, 0);

    // Tính thuế VAT 10% (có thể config sau)
    const tax = subtotal * 0.1;
    
    // Giảm giá mặc định 0% (có thể config sau)
    const discount = 0;
    
    const total = subtotal + tax - discount;

    setInvoiceSummary({
      subtotal,
      tax,
      discount,
      total
    });
  };

  // In hóa đơn
  const printInvoice = () => {
    if (!currentInvoice || invoiceDetails.length === 0) {
      message.error('Không có hóa đơn để in');
      return;
    }

    // Tạo content để in
    const printContent = `
      <div style="font-family: Arial; padding: 20px;">
        <h2 style="text-align: center;">HÓA ĐƠN BÁN HÀNG</h2>
        <p><strong>Bàn:</strong> ${selectedTable?.name}</p>
        <p><strong>Mã hóa đơn:</strong> ${currentInvoice.maHd}</p>
        <p><strong>Thời gian:</strong> ${new Date().toLocaleString()}</p>
        <hr>
        <table style="width: 100%; border-collapse: collapse;">
          <tr style="background: #f5f5f5;">
            <th style="border: 1px solid #ddd; padding: 8px;">Tên món</th>
            <th style="border: 1px solid #ddd; padding: 8px;">SL</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Đơn giá</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Thành tiền</th>
          </tr>
          ${invoiceDetails.map(item => `
            <tr>
              <td style="border: 1px solid #ddd; padding: 8px;">${item.tenSp || item.ten}</td>
              <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">${item.soLuong}</td>
              <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">${(parseFloat(item.gia || item.giaBan || item.donGia || 0)).toLocaleString()}đ</td>
              <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">${(parseFloat(item.gia || item.giaBan || item.donGia || 0) * parseInt(item.soLuong)).toLocaleString()}đ</td>
            </tr>
          `).join('')}
        </table>
        <hr>
        <div style="text-align: right; margin-top: 20px;">
          <p><strong>Tạm tính:</strong> ${invoiceSummary.subtotal.toLocaleString()}đ</p>
          <p><strong>Thuế VAT (10%):</strong> ${invoiceSummary.tax.toLocaleString()}đ</p>
          <p><strong>Giảm giá:</strong> ${invoiceSummary.discount.toLocaleString()}đ</p>
          <h3><strong>Tổng cộng:</strong> ${invoiceSummary.total.toLocaleString()}đ</h3>
        </div>
      </div>
    `;

    // Mở window mới để in
    const printWindow = window.open('', '_blank');
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.print();
    
    message.success('Đã gửi hóa đơn đến máy in');
  };

  // Effect để tính toán invoice summary khi invoiceDetails thay đổi
  useEffect(() => {
    calculateInvoiceSummary();
  }, [invoiceDetails]);

  // Quay lại view trước
  const handleGoBack = () => {
    if (currentView === VIEW_STATES.INVOICE) {
      setCurrentView(VIEW_STATES.TABLES);
      setSelectedTable(null);
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      
      // Trigger quick refresh khi quay về tables view
      triggerQuickRefresh('BACK_TO_TABLES');
    } else if (currentView === VIEW_STATES.PRODUCTS) {
      setCurrentView(VIEW_STATES.INVOICE);
      setSelectedCategory('all');
      setSearchTerm('');
    }
  };

  // Filter dữ liệu
  const filteredTables = tables.filter(table => {
    const matchesArea = selectedArea === 'all' || table.areaId === selectedArea;
    return matchesArea;
  });

  const filteredProducts = products.filter(product => {
    const matchesSearch = product.ten?.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesCategory = selectedCategory === 'all' || product.danhMuc === selectedCategory;
    return matchesSearch && matchesCategory;
  });

  // RENDER VIEWS BASED ON FLOW
  const renderTablesView = () => (
    <div className="tables-view">
      <div className="view-header">
        <div className="header-left">
          <Title level={3}>Chọn bàn để bán hàng</Title>
          <div style={{ display: 'flex', gap: '8px', alignItems: 'center' }}>
            {lastRefresh && (
              <Text type="secondary" style={{ fontSize: '12px' }}>
                Cập nhật lần cuối: {lastRefresh.toLocaleTimeString()}
              </Text>
            )}
            {quickRefreshEnabled && (
              <Text
                type="primary"
                icon={<refresh-ccw size={8} />}
                onClick={processPayment}
                disabled={invoiceDetails.length === 0}
                style={{ fontSize: '11px', fontWeight: 'bold' }}>
                Đang cập nhật real-time...
              </Text>
            )}
            {lastAction && (
              <Text type="info" style={{ fontSize: '10px' }}>
                Hành động: {lastAction.type}
              </Text>
            )}
          </div>
        </div>
        <div className="header-right">
          <Button 
            onClick={handleManualRefresh}
            loading={loading}
            style={{ marginRight: 8 }}
          >
            Làm mới
          </Button>
          <Select
            value={selectedArea}
            onChange={setSelectedArea}
            style={{ width: 200 }}
            placeholder="Chọn khu vực"
          >
            <Option value="all">Tất cả khu vực</Option>
            {areas.map(area => (
              <Option key={area.idKhuVuc} value={area.idKhuVuc}>
                {area.ten}
              </Option>
            ))}
          </Select>
        </div>
      </div>
      
      <div className="tables-grid">
        {filteredTables.map(table => (
          <Card
            key={table.id}
            className={`table-card ${table.status}`}
            onClick={() => handleTableSelect(table)}
            hoverable={false}
            bodyStyle={{ 
              padding: 0, 
              height: '100%',
              backgroundColor: getTableStatusColor(table.status),
              color: getTableStatusTextColor(table.status)
            }}
            style={{
              backgroundColor: getTableStatusColor(table.status),
              borderColor: getTableStatusColor(table.status),
              cursor: 'pointer'
            }}
          >
            <div className="table-header" style={{ 
              backgroundColor: 'rgba(0,0,0,0.1)', 
              padding: '8px',
              textAlign: 'center'
            }}>
              <div className="table-icon">
                <Coffee 
                  size={24} 
                  color={getTableStatusTextColor(table.status)}
                />
              </div>
            </div>
            
            <div className="table-info" style={{ 
              padding: '12px',
              color: getTableStatusTextColor(table.status)
            }}>
              <Title 
                level={5} 
                style={{ 
                  margin: '0 0 8px 0', 
                  color: getTableStatusTextColor(table.status),
                  textAlign: 'center'
                }}
              >
                {table.name}
              </Title>
              <div className="table-status" style={{ textAlign: 'center', marginBottom: '8px' }}>
                <Text style={{ 
                  color: getTableStatusTextColor(table.status),
                  fontWeight: 'bold',
                  fontSize: '13px'
                }}>
                  {getTableStatusText(table.status)}
                </Text>
              </div>
              
              {/* Hiển thị thông tin chi tiết nếu bàn có khách */}
              {table.status !== 'available' && (
                <div className="table-details" style={{ 
                  fontSize: '12px',
                  color: getTableStatusTextColor(table.status),
                  background: 'rgba(255,255,255,0.1)',
                  padding: '8px',
                  borderRadius: '4px',
                  marginTop: '8px'
                }}>
                  {table.sittingTime && (
                    <div style={{ 
                      display: 'flex', 
                      justifyContent: 'space-between',
                      marginBottom: '4px'
                    }}>
                      <span>Thời gian:</span>
                      <span style={{ fontWeight: 'bold' }}>
                        {table.sittingTime}
                      </span>
                    </div>
                  )}
                  {table.totalAmount > 0 && (
                    <div style={{ 
                      display: 'flex', 
                      justifyContent: 'space-between',
                      marginBottom: '4px'
                    }}>
                      <span>Tổng tiền:</span>
                      <span style={{ fontWeight: 'bold' }}>
                        {table.totalAmount.toLocaleString()}đ
                      </span>
                    </div>
                  )}
                  {table.itemCount > 0 && (
                    <div style={{ 
                      display: 'flex', 
                      justifyContent: 'space-between',
                      marginBottom: '4px'
                    }}>
                      <span>Số món:</span>
                      <span style={{ fontWeight: 'bold' }}>
                        {table.itemCount}
                      </span>
                    </div>
                  )}
                  {table.orderItems && table.orderItems.length > 0 && (
                    <div style={{ 
                      marginTop: '8px',
                      fontSize: '11px',
                      opacity: 0.9
                    }}>
                      {table.orderItems.map((item, index) => (
                        <div key={index} style={{ marginBottom: '2px' }}>
                          • {item.tenSp || item.ten} ({item.soLuong})
                        </div>
                      ))}
                      {table.itemCount > 3 && (
                        <div style={{ 
                          fontStyle: 'italic',
                          marginTop: '4px'
                        }}>
                          ...và {table.itemCount - 3} món khác
                        </div>
                      )}
                    </div>
                  )}
                </div>
              )}
            </div>
          </Card>
        ))}
      </div>
    </div>
  );

  const renderInvoiceView = () => {
    console.log('=== INVOICE VIEW DEBUG ===');
    console.log('currentInvoice:', currentInvoice);
    console.log('invoiceDetails:', invoiceDetails);
    console.log('selectedTable:', selectedTable);
    
    return (
      <div className="invoice-view">
        <div className="view-header">
          <div className="header-left">
            <Button 
              icon={<ArrowLeft size={16} />}
              onClick={handleGoBack}
            >
              Quay lại
            </Button>
            <Title level={3} style={{ margin: '0 16px' }}>
              Hóa đơn - {selectedTable?.name}
              {currentInvoice && ` (#${currentInvoice.maHd})`}
              {currentInvoice?.isDraft && <Text type="warning"> (Tạm)</Text>}
              {editingInvoice && <Text type="danger"> - ĐANG CHỈNH SỬA</Text>}
            </Title>
          </div>
          
          <div className="header-right">
            <Space>
              {/* Enhanced Invoice Management Buttons */}
              <Button 
                icon={<History size={16} />}
                onClick={loadInvoiceHistory}
                title="Lịch sử hóa đơn"
              >
                Lịch sử
              </Button>
              
              {currentInvoice && (
                <>
                  {editingInvoice ? (
                    <>
                      <Button 
                        type="primary"
                        icon={<Save size={16} />}
                        onClick={saveInvoiceEdits}
                        title="Lưu chỉnh sửa"
                      >
                        Lưu
                      </Button>
                      
                      <Button 
                        icon={<X size={16} />}
                        onClick={cancelInvoiceEdits}
                        title="Hủy chỉnh sửa"
                      >
                        Hủy sửa
                      </Button>
                    </>
                  ) : (
                    <Button 
                      icon={<Edit3 size={16} />}
                      onClick={editInvoiceDetails}
                      title="Chỉnh sửa hóa đơn"
                    >
                      Sửa
                    </Button>
                  )}
                  
                  <Button 
                    icon={<Printer size={16} />}
                    onClick={printInvoice}
                    disabled={invoiceDetails.length === 0}
                    title="In hóa đơn"
                  >
                    In
                  </Button>
                  
                  {currentInvoice.isDraft && (
                    <Button 
                      type="default"
                      icon={<CheckCircle size={16} />}
                      onClick={convertDraftToOfficial}
                      title="Chuyển thành chính thức"
                    >
                      Chính thức
                    </Button>
                  )}
                  
                  {!editingInvoice && (
                    <Button 
                      danger
                      icon={<X size={16} />}
                      onClick={cancelInvoice}
                      title="Hủy hóa đơn"
                    >
                      Hủy HĐ
                    </Button>
                  )}
                </>
              )}
              
              <Button 
                type="primary"
                icon={<ShoppingCart size={16} />}
                onClick={handleSelectItems}
                disabled={editingInvoice}
              >
                Chọn món
              </Button>
            </Space>
          </div>
        </div>

        {!currentInvoice ? (
          <div className="empty-invoice">
            <Users size={48} />
            <Text>Chưa có hóa đơn cho bàn này</Text>
            <Space>
              <Button type="primary" onClick={createNewInvoice}>
                Tạo hóa đơn mới
              </Button>
              <Button 
                icon={<Save size={16} />}
                onClick={createDraftInvoice}
              >
                Tạo hóa đơn tạm
              </Button>
            </Space>
          </div>
        ) : (
          <div className="invoice-content">
            <div className="invoice-info">
              <Text strong>Mã hóa đơn: {currentInvoice.maHd}</Text>
              <br />
              <Text>Bàn: {selectedTable?.name}</Text>
            </div>
            
            <div className="invoice-items">
              {invoiceDetails.length === 0 ? (
                <div className="empty-items">
                  <ShoppingCart size={48} />
                  <Text>Chưa có món nào trong đơn hàng</Text>
                </div>
              ) : (
              invoiceDetails.map(item => (
                <div key={item.maCt} className="invoice-item">
                  <div className="item-info">
                    <Title level={5}>{item.tenSp}</Title>
                    <Text type="secondary">
                      {parseFloat(item.gia || item.giaBan || item.donGia || 0).toLocaleString('vi-VN')} đ
                    </Text>
                  </div>
                  
                  <div className="item-controls">
                    <Button
                      size="small"
                      icon={<Minus size={12} />}
                      onClick={() => updateProductQuantity(item, parseInt(item.soLuong) - 1)}
                    />
                    <Button
                      size="small"
                      style={{ width: 80, margin: '0 8px' }}
                      onClick={() => {
                        setSelectedItemForUpdate(item);
                        setNewQuantityForUpdate(parseInt(item.soLuong));
                        setShowUpdateQuantityModal(true);
                      }}
                    >
                      {item.soLuong}
                    </Button>
                    <Button
                      size="small"
                      icon={<Plus size={12} />}
                      onClick={() => updateProductQuantity(item, parseInt(item.soLuong) + 1)}
                    />
                    <Popconfirm
                      title="Xác nhận xóa món này?"
                      onConfirm={() => removeProductFromOrder(item.maCt)}
                    >
                      <Button
                        size="small"
                        danger
                        icon={<Trash2 size={12} />}
                        style={{ marginLeft: 8 }}
                      />
                    </Popconfirm>
                  </div>
                </div>
              ))
            )}
          </div>

          <Divider />

          <div className="invoice-summary">
            {/* Enhanced Invoice Summary với thuế, giảm giá */}
            <div className="summary-details">
              <div className="summary-row">
                <Text>Tạm tính:</Text>
                <Text>{invoiceSummary.subtotal.toLocaleString('vi-VN')} đ</Text>
              </div>
              
              <div className="summary-row">
                <Text>Thuế VAT (10%):</Text>
                <Text>{invoiceSummary.tax.toLocaleString('vi-VN')} đ</Text>
              </div>
              
              {invoiceSummary.discount > 0 && (
                <div className="summary-row">
                  <Text type="success">Giảm giá:</Text>
                  <Text type="success">-{invoiceSummary.discount.toLocaleString('vi-VN')} đ</Text>
                </div>
              )}
            </div>
            
            <Divider style={{ margin: '12px 0' }} />
            
            <div className="total-row">
              <Text strong style={{ fontSize: '16px' }}>Tổng cộng: </Text>
              <Text strong className="total-amount" style={{ fontSize: '18px', color: '#197dd3' }}>
                {invoiceSummary.total.toLocaleString('vi-VN')} đ
              </Text>
            </div>
            
            {/* Thông tin thêm */}
            <div className="invoice-meta">
              <Space split={<Divider type="vertical" />}>
                <Text type="secondary">Số món: {invoiceDetails.length}</Text>
                <Text type="secondary">
                  Thời gian: {new Date().toLocaleTimeString()}
                </Text>
                {currentInvoice?.isDraft && (
                  <Text type="warning">Hóa đơn tạm</Text>
                )}
              </Space>
            </div>
          </div>

          <div className="invoice-actions">
            <Button
              icon={<Clock size={16} />}
              onClick={sendToKitchen}
              style={{ marginBottom: 8 }}
              block
            >
              Chuyển xuống bếp
            </Button>
            
            <Button
              type="primary"
              icon={<CreditCard size={16} />}
              onClick={processPayment}
              disabled={invoiceDetails.length === 0}
              block
            >
              Thanh toán
            </Button>
          </div>
        </div>
      )}
    </div>
  );
};

  const renderProductsView = () => (
    <Layout className="products-view">
      {/* Sidebar categories */}
      <Sider width={250} className="categories-sidebar">
        <div className="sidebar-header">
          <Title level={4}>Danh mục</Title>
        </div>
        <div className="categories-list">
          <div 
            className={`category-item ${selectedCategory === 'all' ? 'active' : ''}`}
            onClick={() => setSelectedCategory('all')}
          >
            Tất cả món
          </div>
          {categories.map(category => (
            <div
              key={category.maDm}
              className={`category-item ${selectedCategory === category.maDm ? 'active' : ''}`}
              onClick={() => setSelectedCategory(category.maDm)}
            >
              {category.ten}
            </div>
          ))}
        </div>
      </Sider>

      {/* Main products grid */}
      <Content className="products-content">
        <div className="view-header">
          <Button 
            icon={<ArrowLeft size={16} />}
            onClick={handleGoBack}
          >
            Quay lại hóa đơn
          </Button>
          <Title level={3}>Chọn món - {selectedTable?.name}</Title>
          <Input
            placeholder="Tìm món..."
            prefix={<Search size={16} />}
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            style={{ width: 300 }}
          />
        </div>

        <div className="products-grid">
          {filteredProducts.map(product => (
            <Card
              key={product.id}
              className="product-card"
              onClick={() => addProductToOrder(product)}
              hoverable
            >
              <div className="product-icon">
                <Coffee size={32} />
              </div>
              <div className="product-info">
                <Title level={5}>{product.ten}</Title>
                <Text className="product-price">
                  {parseFloat(product.gia || 0).toLocaleString('vi-VN')} đ
                </Text>
              </div>
            </Card>
          ))}
        </div>
      </Content>
    </Layout>
  );

  // Main render
  return (
    <div className="banhang-container">
      {currentView === VIEW_STATES.TABLES && renderTablesView()}
      {currentView === VIEW_STATES.INVOICE && renderInvoiceView()}
      {currentView === VIEW_STATES.PRODUCTS && renderProductsView()}
      
      {/* Enhanced Invoice Management Modals */}
      
      {/* Invoice History Modal */}
      <Modal
        title={`Lịch sử hóa đơn - ${selectedTable?.name}`}
        open={showInvoiceHistory}
        onCancel={() => setShowInvoiceHistory(false)}
        width={800}
        footer={[
          <Button key="close" onClick={() => setShowInvoiceHistory(false)}>
            Đóng
          </Button>
        ]}
      >
        <Table
          dataSource={invoiceHistory}
          columns={[
            {
              title: 'Mã HĐ',
              dataIndex: 'maHd',
              key: 'maHd',
              width: 100
            },
            {
              title: 'Ngày',
              dataIndex: 'ngayTao',
              key: 'ngayTao',
              width: 120,
              render: (date) => new Date(date).toLocaleDateString('vi-VN')
            },
            {
              title: 'Thời gian',
              dataIndex: 'gioTao',
              key: 'gioTao',
              width: 100,
              render: (time) => time ? new Date(time).toLocaleTimeString('vi-VN') : ''
            },
            {
              title: 'Tổng tiền',
              dataIndex: 'tongTien',
              key: 'tongTien',
              width: 120,
              render: (amount) => `${parseFloat(amount || 0).toLocaleString('vi-VN')} đ`
            },
            {
              title: 'Trạng thái',
              dataIndex: 'trangThai',
              key: 'trangThai',
              width: 100,
              render: (status) => {
                const statusMap = {
                  '0': 'Tạm',
                  '1': 'Hoàn thành',
                  '2': 'Đã hủy'
                };
                return statusMap[status] || status;
              }
            },
            {
              title: 'Thao tác',
              key: 'actions',
              width: 120,
              render: (_, record) => (
                <Space>
                  <Button 
                    size="small" 
                    icon={<Copy size={12} />}
                    title="Sao chép"
                    onClick={() => copyInvoice(record.maHd)}
                  />
                  <Button 
                    size="small" 
                    icon={<Printer size={12} />}
                    title="In lại"
                    onClick={() => reprintInvoice(record)}
                  />
                </Space>
              )
            }
          ]}
          pagination={{
            pageSize: 10,
            showSizeChanger: false,
            showTotal: (total) => `Tổng ${total} hóa đơn`
          }}
          rowKey="maHd"
          size="small"
        />
      </Modal>

      {/* Modal chọn số lượng khi thêm sản phẩm */}
      <Modal
        title={`Thêm ${selectedProductForAdd?.ten || ''}`}
        open={showQuantityModal}
        onOk={confirmAddProduct}
        onCancel={() => {
          setShowQuantityModal(false);
          setSelectedProductForAdd(null);
          setQuantityToAdd(1);
        }}
        okText="Thêm vào đơn"
        cancelText="Hủy"
        width={400}
      >
        <div style={{ textAlign: 'center', padding: '20px 0' }}>
          <div style={{ marginBottom: 16 }}>
            <Text strong style={{ fontSize: 16 }}>
              {selectedProductForAdd?.ten}
            </Text>
            <br />
            <Text type="secondary">
              Giá: {selectedProductForAdd?.gia?.toLocaleString('vi-VN')} đ
            </Text>
          </div>
          
          <div style={{ marginBottom: 20 }}>
            <Text>Số lượng:</Text>
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', marginTop: 8 }}>
              <Button
                icon={<Minus size={16} />}
                onClick={() => setQuantityToAdd(Math.max(1, quantityToAdd - 1))}
                disabled={quantityToAdd <= 1}
              />
              <InputNumber
                value={quantityToAdd}
                min={1}
                style={{ width: 80, margin: '0 12px' }}
                onChange={(value) => setQuantityToAdd(value || 1)}
              />
              <Button
                icon={<Plus size={16} />}
                onClick={() => setQuantityToAdd(quantityToAdd + 1)}
              />
            </div>
          </div>
          
          <div>
            <Text strong>
              Tổng: {((selectedProductForAdd?.gia || 0) * quantityToAdd).toLocaleString('vi-VN')} đ
            </Text>
          </div>
        </div>
      </Modal>

      {/* Modal cập nhật số lượng */}
      <Modal
        title={`Cập nhật số lượng: ${selectedItemForUpdate?.tenSp || ''}`}
        open={showUpdateQuantityModal}
        onOk={confirmUpdateQuantity}
        onCancel={() => {
          setShowUpdateQuantityModal(false);
          setSelectedItemForUpdate(null);
          setNewQuantityForUpdate(1);
        }}
        okText="Cập nhật"
        cancelText="Hủy"
        width={400}
      >
        <div style={{ textAlign: 'center', padding: '20px 0' }}>
          <div style={{ marginBottom: 16 }}>
            <Text strong style={{ fontSize: 16 }}>
              {selectedItemForUpdate?.tenSp}
            </Text>
            <br />
            <Text type="secondary">
              Giá: {parseFloat(selectedItemForUpdate?.gia || selectedItemForUpdate?.giaBan || 0).toLocaleString('vi-VN')} đ
            </Text>
          </div>
          
          <div style={{ marginBottom: 20 }}>
            <Text>Số lượng mới:</Text>
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', marginTop: 8 }}>
              <Button
                icon={<Minus size={16} />}
                onClick={() => setNewQuantityForUpdate(Math.max(1, newQuantityForUpdate - 1))}
                disabled={newQuantityForUpdate <= 1}
              />
              <InputNumber
                value={newQuantityForUpdate}
                min={1}
                style={{ width: 80, margin: '0 12px' }}
                onChange={(value) => setNewQuantityForUpdate(value || 1)}
              />
              <Button
                icon={<Plus size={16} />}
                onClick={() => setNewQuantityForUpdate(newQuantityForUpdate + 1)}
              />
            </div>
          </div>
          
          <div>
            <Text strong>
              Tổng mới: {(parseFloat(selectedItemForUpdate?.gia || selectedItemForUpdate?.giaBan || 0) * newQuantityForUpdate).toLocaleString('vi-VN')} đ
            </Text>
          </div>
          
          <div style={{ marginTop: 16, padding: 12, backgroundColor: '#fff2e8', borderRadius: 6 }}>
            <Text type="warning" style={{ fontSize: 12 }}>
              ⚠️ Món sẽ được xóa và thêm lại với số lượng mới
            </Text>
          </div>
        </div>
      </Modal>
    </div>
  );
};

export default BanHang;
