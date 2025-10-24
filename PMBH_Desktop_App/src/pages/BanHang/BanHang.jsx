import React, { useState, useEffect, useMemo, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
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
  Table,
  Checkbox
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
  Copy,
  Merge,
  Split,
  ArrowRight
} from 'lucide-react';

// Import constants
import { DEFAULT_IMAGES, PLACEHOLDER_CONFIG } from '../../constants';

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
  thanhToanHoaDonChiTiet,
  tratien,
  ajaxBangId,
  capNhatHd,
  capNhatHdV2,
  chuyenXuongBep,
  xoaCtHd,
  capNhatCtHd,
  getChiTietHoaDonRong,
  getChiTietHoaDonTheoMaHD,
  loadDanhMucSp,
  loadSanPhamTheoMaDanhMucSp,
  huyHoaDon,
  tinhTongTienHoaDon,
  layLichSuHoaDonTheoBan,
  taoHoaDonTam,
  chuyenHoaDonTamThanhChinhThuc,
  saoChepHoaDon,
  loadDsCthdV3,
  loadDsCthdV2,
  gopBanBanhang,
  tachBan,
  chuyenBanCorrected,
  capNhatTrangThaiDonHang,
  xacNhanDonHang,
  layTrangThaiDonHangRealtime,
  inHoaDonThanhToan,
  gopBanEnhanced,
  chuyenBanEnhanced,
  tachBanEnhanced,
  loadProductImage,
  getFullImageUrl,
  layDsMonCho,
  layDsMonDaXong,
  capNhatTrangThaiMon
} from '../../services/apiServices';

// Import components
import ChonSanPham from './ChonSanPham';
import ProductCard from '../../components/common/ProductCard';
import PaymentModal from '../../components/Payment/PaymentModal';
import ReceiptPrinter from '../../components/Print/ReceiptPrinter';
import OrderStatus from '../../components/Order/OrderStatus';
import TableMergeModal from '../../components/TableOperations/TableMergeModal';
import TableTransferModal from '../../components/TableOperations/TableTransferModal';
import TableSplitModal from '../../components/TableOperations/TableSplitModal';
import TableMergeAnimation from '../../components/TableOperations/TableMergeAnimation';
import { useText } from '../../components/common/Text';

// Debug utilities
import { debugAPIFunctions, testPaymentAPI as quickPaymentTest } from '../../utils/debugAPI';

// Customer display hook
import useCustomerDisplaySync from '../../hooks/useCustomerDisplaySync';

import './BanHang.css';
import '../../styles/components/TableOperations.css';

const { Title, Text } = Typography;
const { Content } = Layout;
const { Option } = Select;

// View states based on flow requirements
const VIEW_STATES = {
  TABLES: 'tables',        // Initial view - show table grid
  PRODUCTS: 'products',    // Show product grid after clicking "select items" 
  COMBINED: 'combined'     // Combined view - invoice (25%) + products (75%)
};

const BanHang = () => {
  const { translate } = useText();
  const __ = (key, values, fallback) => translate(key, { values, defaultText: fallback ?? key });

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
  const navigate = useNavigate();
  const [draftInvoices, setDraftInvoices] = useState([]);
  const [includeVAT, setIncludeVAT] = useState(false); // Checkbox for VAT tax
  const [invoiceSummary, setInvoiceSummary] = useState({
    subtotal: 0,
    tax: 0,
    discount: 0,
    total: 0
  });

  // State cho Enhanced Payment System
  const [showPaymentModal, setShowPaymentModal] = useState(false);
  const [paymentLoading, setPaymentLoading] = useState(false);
  
  // State cho Order Status Tracking
  const [orderStatus, setOrderStatus] = useState(null);
  
  // State UI
  const [loading, setLoading] = useState(false);
  const [lastRefresh, setLastRefresh] = useState(null);
  const [autoRefreshEnabled, setAutoRefreshEnabled] = useState(true);
  const [lastAction, setLastAction] = useState(null); // Track last user action
  const [quickRefreshEnabled, setQuickRefreshEnabled] = useState(false); // For post-action refresh

  // State cho Table Operations
  const [showMergeTableModal, setShowMergeTableModal] = useState(false);
  const [showSplitTableModal, setShowSplitTableModal] = useState(false);
  const [showTransferTableModal, setShowTransferTableModal] = useState(false);
  const [selectedTargetTable, setSelectedTargetTable] = useState(null);
  const [availableTablesForOperation, setAvailableTablesForOperation] = useState([]);
  
  // State cho Split Table - món được chọn để tách
  const [selectedItemsForSplit, setSelectedItemsForSplit] = useState([]);
  const [splitTargetTable, setSplitTargetTable] = useState(null);
  const [availableTablesForSplit, setAvailableTablesForSplit] = useState([]);
  
  // State cho Merged Table Groups - Track các nhóm bàn đã gộp
  const [mergedTableGroups, setMergedTableGroups] = useState(() => {
    try {
      const saved = localStorage.getItem('mergedTableGroups');
      return saved ? JSON.parse(saved) : {};
    } catch (error) {
      console.warn('Không thể load mergedTableGroups từ localStorage:', error);
      return {};
    }
  }); // {mainTableId: [table1, table2, ...]}
  
  // Helper function để xóa bàn khỏi mergedTableGroups và localStorage
  const clearMergedTableGroups = (tableToRemove) => {
    if (tableToRemove) {
      setMergedTableGroups(prev => {
        const newGroups = { ...prev };
        // Xóa nhóm nếu bàn hiện tại là bàn chính
        if (newGroups[tableToRemove.id]) {
          delete newGroups[tableToRemove.id];
        }
        // Hoặc xóa bàn khỏi nhóm khác nếu là bàn phụ
        Object.keys(newGroups).forEach(mainTableId => {
          newGroups[mainTableId] = newGroups[mainTableId].filter(t => t.id !== tableToRemove.id);
          // Nếu nhóm chỉ còn 1 bàn, xóa luôn nhóm
          if (newGroups[mainTableId].length <= 1) {
            delete newGroups[mainTableId];
          }
        });
        return newGroups;
      });
    }
    
    // Xóa dữ liệu mergedTableGroups khỏi localStorage
    try {
      localStorage.removeItem('mergedTableGroups');
    } catch (error) {
      console.warn('Không thể xóa mergedTableGroups khỏi localStorage:', error);
    }
  };
  
  // State cho Animation
  const [showMergeAnimation, setShowMergeAnimation] = useState(false);
  const [animationTables, setAnimationTables] = useState({ source: null, target: null });
  const [operationInProgress, setOperationInProgress] = useState(false);

  // State theo dõi món chờ bếp/bar
  const [pendingKitchenOrders, setPendingKitchenOrders] = useState([]);

  // Performance refs to avoid duplicated network calls/timeouts
  const tableStatusRequestRef = useRef(null);

  // Customer Display Sync - Auto sync cart data to customer display window
  useCustomerDisplaySync(
    invoiceDetails,
    selectedTable,
    orderTotal,
    0, // discount placeholder
    orderTotal
  );
  const quickRefreshTimeoutRef = useRef(null);

  const pendingKitchenIdSet = useMemo(() => {
    const idSet = new Set();
    if (Array.isArray(pendingKitchenOrders)) {
      pendingKitchenOrders.forEach(order => {
        if (order?.idCthd) {
          idSet.add(order.idCthd.toString());
        }
      });
    }
    return idSet;
  }, [pendingKitchenOrders]);

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

  const arePendingListsEqual = (prev = [], next = []) => {
    if (prev.length !== next.length) return false;
    const normalize = (list) => list
      .map(item => `${item.idCthd || item.id || ''}-${item.soLuong || 0}`)
      .sort()
      .join('|');
    return normalize(prev) === normalize(next);
  };

  const areTablesEqual = (prevTables = [], nextTables = []) => {
    if (prevTables.length !== nextTables.length) return false;
    const prevMap = new Map(prevTables.map(table => [table.id, table]));
    for (const nextTable of nextTables) {
      const prevTable = prevMap.get(nextTable.id);
      if (!prevTable) return false;
      if (
        prevTable.status !== nextTable.status ||
        prevTable.invoiceId !== nextTable.invoiceId ||
        prevTable.totalAmount !== nextTable.totalAmount ||
        prevTable.itemCount !== nextTable.itemCount ||
        prevTable.hasPendingKitchenItems !== nextTable.hasPendingKitchenItems ||
        prevTable.sittingTime !== nextTable.sittingTime
      ) {
        return false;
      }
      const prevPending = (prevTable.pendingKitchenOrderIds || []).join(',');
      const nextPending = (nextTable.pendingKitchenOrderIds || []).join(',');
      if (prevPending !== nextPending) {
        return false;
      }
    }
    return true;
  };

  // Load dữ liệu ban đầu
  useEffect(() => {
    loadInitialData();
  }, []);

  // Manual refresh only - remove auto refresh to reduce lag
  // User can manually refresh or refresh will happen after database actions

  // Reduced quick refresh frequency to prevent lag
  useEffect(() => {
    let quickIntervalId;
    
    if (quickRefreshEnabled && currentView === VIEW_STATES.TABLES) {
      // Quick refresh every 5 seconds for 15 seconds after action
      quickIntervalId = setInterval(() => {
        refreshTableStatusOnly({ skipIfBusy: true });
      }, 5000); // 5 seconds - reduced frequency
    }

    return () => {
      if (quickIntervalId) {
        clearInterval(quickIntervalId);
      }
    };
  }, [quickRefreshEnabled, currentView]);

  useEffect(() => {
    return () => {
      if (quickRefreshTimeoutRef.current) {
        clearTimeout(quickRefreshTimeoutRef.current);
        quickRefreshTimeoutRef.current = null;
      }
    };
  }, []);

  // Lưu mergedTableGroups vào localStorage mỗi khi có thay đổi
  useEffect(() => {
    try {
      localStorage.setItem('mergedTableGroups', JSON.stringify(mergedTableGroups));
    } catch (error) {
      console.warn('Không thể lưu mergedTableGroups vào localStorage:', error);
    }
  }, [mergedTableGroups]);

  // Manual refresh handler
  const handleManualRefresh = async () => {
    setLastRefresh(new Date());
    await loadTables();
    message.success(__('Đã cập nhật trạng thái bàn'));
  };

  // Refresh chỉ trạng thái bàn (không reload toàn bộ)
  const refreshTableStatusOnly = async (options = {}) => {
    if (tables.length === 0) return;
    
    try {
      await loadTableStatuses(tables, { silent: true, ...options });
      setLastRefresh(new Date());
    } catch (error) {
  // Silent console
    }
  };

  // Trigger optimized refresh after user actions
  const triggerQuickRefresh = (actionType) => {
    setLastAction({ type: actionType, timestamp: new Date() });
    setQuickRefreshEnabled(true);
    refreshTableStatusOnly({ skipIfBusy: true });

    if (quickRefreshTimeoutRef.current) {
      clearTimeout(quickRefreshTimeoutRef.current);
    }

    // Shorter quick refresh period - 15 seconds instead of 10
    quickRefreshTimeoutRef.current = setTimeout(() => {
      setQuickRefreshEnabled(false);
      quickRefreshTimeoutRef.current = null;
    }, 15000);
  };

  // Remove auto-refresh for table statuses to reduce lag
  // Only refresh on user action or manual refresh
  useEffect(() => {
    // Removed automatic 30-second refresh to improve performance
    // Tables will only refresh when user performs actions or manually refreshes
  }, [currentView, tables]);
  
  // Tính toán tổng tiền khi invoice details thay đổi
  useEffect(() => {
    if (invoiceDetails.length > 0) {
      const total = invoiceDetails.reduce((sum, item) => {
        // API trả về field 'gia' hoặc 'giaBan' tùy endpoint, không phải 'donGia'
        const price = parseFloat(item.gia || item.giaBan || item.donGia || 0);
        const quantity = parseInt(item.sl || item.soLuong || 0); // API trả về 'sl' cho quantity
        return sum + (price * quantity);
      }, 0);
      setOrderTotal(total);
    } else {
      setOrderTotal(0);
    }
  }, [invoiceDetails]);

  // Load dữ liệu ban đầu - chỉ tables và areas, không load products để tránh lag
  const loadInitialData = async () => {
    // Debug API functions availability
    debugAPIFunctions();
    
    // Make payment test available globally for debugging
    window.testPaymentAPI = quickPaymentTest;
    
    // Only load essential data initially - products loaded lazily when needed
    await Promise.all([
      loadTables(),
      loadAreas()
      // Remove loadProducts() from initial load to improve startup performance
    ]);
  };

  // Load danh sách bàn với trạng thái
  const loadTables = async () => {
    try {
      setLoading(true);
      const tablesResponse = await loadBan();
      
      let tablesData = [];
      if (Array.isArray(tablesResponse)) {
        tablesData = tablesResponse.map(table => ({
          id: table.idBan,
          maBan: table.idBan,  // Thêm maBan để phù hợp với modal
          name: table.tenBan,
          tenBan: table.tenBan,  // Thêm tenBan để phù hợp với modal
          areaId: table.idKhuVuc,
          status: 'available' // Sẽ được cập nhật từ loadTableStatuses
        }));
      } else {
  // Silent console
        tablesData = [];
      }

      setTables(tablesData);

      // Load trạng thái bàn riêng biệt
  await loadTableStatuses(tablesData, { silent: true });
      
    } catch (error) {
  // Silent console
        message.error(__('Không thể tải danh sách bàn'));
    } finally {
      setLoading(false);
    }
  };

  // Load trạng thái bàn theo hóa đơn - sử dụng API getChiTietHoaDonRong
  const loadTableStatuses = async (currentTables, options = {}) => {
    const { silent = false, skipIfBusy = false } = options;
    if (!currentTables || currentTables.length === 0) return;

    if (tableStatusRequestRef.current) {
      if (skipIfBusy) {
        return;
      }
      return tableStatusRequestRef.current;
    }

    const requestPromise = (async () => {
      if (!silent) {
        setLoading(true);
      }

      try {
        // Lấy song song trạng thái hóa đơn và các món đang chờ ở bếp/bar
        const [statusResponse, pendingResponseRaw] = await Promise.all([
          getChiTietHoaDonRong(),
          layDsMonCho().catch(() => [])
        ]);

        const normalizedPending = Array.isArray(pendingResponseRaw)
          ? pendingResponseRaw
              .map(order => ({
                ...order,
                idBan: order?.idBan ? order.idBan.toString() : '',
                idCthd: order?.idCthd ? order.idCthd.toString() : ''
              }))
              .filter(order => order.idBan && order.idCthd)
          : [];

        const pendingByTableMap = normalizedPending.reduce((acc, order) => {
          if (!acc[order.idBan]) acc[order.idBan] = [];
          acc[order.idBan].push(order);
          return acc;
        }, {});

        setPendingKitchenOrders(prev => (
          arePendingListsEqual(prev, normalizedPending) ? prev : normalizedPending
        ));
        
        if (Array.isArray(statusResponse)) {
          const updatedTables = await Promise.all(
            currentTables.map(async (table) => {
              
              // Tìm hóa đơn theo idBan
              const tableInvoice = statusResponse.find(invoice => {
                const matches = invoice.idBan === table.id || 
                               parseInt(invoice.idBan) === parseInt(table.id);
                if (matches) {
                }
                return matches;
              });
              const tableIdStr = table.id?.toString() || '';
              const tablePendingOrders = pendingByTableMap[tableIdStr] || [];
              
              if (tableInvoice) {
                
                // Bàn có hóa đơn (kể cả hóa đơn rỗng với tongTien = 0)
                const invoiceId = tableInvoice.idDonHang;
                const totalAmount = parseFloat(tableInvoice.tongTien) || 0;
                
                try {
                  // Load chi tiết hóa đơn để lấy danh sách món
                  const invoiceDetails = await getChiTietHoaDonTheoMaHD(invoiceId);
                  
                  // Tính thời gian ngồi
                  let sittingTime = '';
                  if (tableInvoice.thoiGian) {
                    try {
                      const startTime = new Date(tableInvoice.thoiGian);
                      const now = new Date();
                      const diffMinutes = Math.floor((now - startTime) / 60000);
                      const hours = Math.floor(diffMinutes / 60);
                      const minutes = diffMinutes % 60;
                      sittingTime = hours > 0 ? `${hours}h ${minutes}m` : `${minutes}m`;
                    } catch (timeError) {
                      // Silent console
                      sittingTime = '';
                    }
                  }

                  // Tính số món (những món có sl > 0)
                  const itemsWithQuantity = Array.isArray(invoiceDetails) 
                    ? invoiceDetails.filter(item => parseInt(item.sl) > 0) 
                    : [];

                  const result = {
                    ...table,
                    status: 'occupied', // Bàn có hóa đơn luôn là occupied
                    invoiceId,
                    customerCount: 0, // API không trả về soKhach
                    orderTime: tableInvoice.thoiGian || null,
                    sittingTime,
                    totalAmount,
                    itemCount: itemsWithQuantity.length,
                    orderItems: itemsWithQuantity.slice(0, 3),
                    isEmptyInvoice: totalAmount === 0,
                    hasPendingKitchenItems: tablePendingOrders.length > 0,
                    pendingKitchenOrders: tablePendingOrders,
                    pendingKitchenOrderIds: tablePendingOrders.map(order => order.idCthd)
                  };
                  
                  return result;
                } catch (error) {
                  // Silent console
                  return {
                    ...table,
                    status: 'occupied',
                    invoiceId,
                    customerCount: 0,
                    orderTime: tableInvoice.thoiGian || null,
                    sittingTime: '',
                    totalAmount,
                    itemCount: 0,
                    orderItems: [],
                    isEmptyInvoice: totalAmount === 0,
                    hasPendingKitchenItems: tablePendingOrders.length > 0,
                    pendingKitchenOrders: tablePendingOrders,
                    pendingKitchenOrderIds: tablePendingOrders.map(order => order.idCthd)
                  };
                }
              } else {
                // Bàn không có hóa đơn = bàn trống
                return {
                  ...table,
                  status: 'available',
                  invoiceId: null,
                  customerCount: 0,
                  orderTime: null,
                  sittingTime: '',
                  totalAmount: 0,
                  itemCount: 0,
                  orderItems: [],
                  isEmptyInvoice: false,
                  hasPendingKitchenItems: false,
                  pendingKitchenOrders: [],
                  pendingKitchenOrderIds: []
                };
              }
            })
          );
          
          setTables(prevTables => (
            areTablesEqual(prevTables, updatedTables) ? prevTables : updatedTables
          ));
        } else {
  // Silent console
        }
      } catch (error) {
  // Silent console
        // Don't show error message for status loading failure
      } finally {
        if (!silent) {
          setLoading(false);
        }
        tableStatusRequestRef.current = null;
      }
    })();

    tableStatusRequestRef.current = requestPromise;
    return requestPromise;
  };

  // Load danh sách khu vực
  const loadAreas = async () => {
    try {
      const areasResponse = await loadKhuVuc();
      
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
  // console.error('Error loading areas:', error);
    message.error(__('Không thể tải danh sách khu vực'));
    }
  };

  // Load danh mục sản phẩm (chỉ khi cần) - Enhanced with debugging
  const loadProductCategories = async () => {
    try {
  // Loading product categories
      
      // Try new API first
      let categoriesResponse;
      try {
        categoriesResponse = await loadDanhMucSp();
  // dev log suppressed
      } catch (newApiError) {
  // dev log suppressed
        // Fallback to old API
        categoriesResponse = await getLoaiSanPham();
  // dev log suppressed
      }
      
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
      const mappedCategories = categoriesData
        .filter(cat => cat && (cat.maDanhMucSp || cat.idLoaiSp || cat.id || cat.maLoai))
        .map(cat => ({
          value: cat.maDanhMucSp || cat.idLoaiSp || cat.id || cat.maLoai,
          label: cat.tenDanhMucSp || cat.tenLoaiSp || cat.ten || cat.tenLoai || 'Không có tên',
          // Keep original fields for backward compatibility
          maDm: cat.maDanhMucSp || cat.idLoaiSp || cat.id || cat.maLoai,
          ten: cat.tenDanhMucSp || cat.tenLoaiSp || cat.ten || cat.tenLoai || 'Không có tên'
        }));

      setCategories(mappedCategories);
      
      
      if (mappedCategories.length === 0) {
        
  message.warning(__('Không tìm thấy danh mục sản phẩm'));
      }
    } catch (error) {
      // Silent console
      
      // Tuân thủ .rules: không mock dữ liệu
  message.error(__('Không thể tải danh mục sản phẩm.'));
      setCategories([]);
    }
  };

  // Load sản phẩm (chỉ khi cần) - Enhanced with database image loading
  const loadProducts = async () => {
    try {
      const productsResponse = await getAllSanPham();

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

      // Map products to consistent format with enhanced image handling - Exclude "NL" products
      const mappedProducts = await Promise.all(productsData
        .filter(product => {
          // Filter out products with codes starting with "NL" (Nguyên liệu)
          const productCode = product.maSp || product.id || product.maSP || '';
          return !productCode.toString().startsWith('NL');
        })
        .map(async (product) => {
          let imageUrl = null;
          
          // Try to get image from product data first
          if (product.hinhAnh && product.hinhAnh !== DEFAULT_IMAGES.PRODUCT) {
            imageUrl = getFullImageUrl(product.hinhAnh);
          } else {
            // Try to load from database if no direct image URL
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
            hinhAnh: imageUrl // Will be null if no valid image found
          };
        }));

      setProducts(mappedProducts);
    } catch (error) {
      console.error('[LOAD_PRODUCTS] Lỗi tải sản phẩm:', error);
      message.error(__('Không thể tải danh sách sản phẩm.'));
      setProducts([]);
    }
  };

  // FLOW 1: Chọn bàn và xử lý tự động tạo/load hóa đơn
  const handleTableSelect = async (table) => {
    try {
  // Silent console
      
      // Kiểm tra xem bàn này có phải là bàn đã gộp (không phải bàn chính) không
      const isMergedSlave = Object.values(mergedTableGroups).some(group => 
        group.some(t => t.id === table.id) && mergedTableGroups[table.id] === undefined
      );
      
      if (isMergedSlave) {
        message.warning(__('pages.banhang.table_merged_warning', { table: table.tenBan }, `Bàn ${table.tenBan} đã được gộp vào bàn khác. Chỉ được thao tác trên bàn chính của nhóm.`));
        return; // Không cho phép chọn bàn đã gộp
      }
      
      // Kiểm tra xem bàn này có phải là phần của nhóm gộp không (để chuyển đến bàn chính)
      const mergedGroup = Object.entries(mergedTableGroups).find(([mainTableId, groupTables]) => 
        groupTables.some(t => t.id === table.id)
      );
      
      let actualTable = table;
      if (mergedGroup) {
        // Nếu bàn này thuộc nhóm gộp, chuyển đến bàn chính
        const [mainTableId, groupTables] = mergedGroup;
        const mainTable = groupTables.find(t => t.id === mainTableId);
        if (mainTable) {
          actualTable = mainTable;
          message.info(__('pages.banhang.table_merged_info', { table: table.tenBan, mainTable: mainTable.tenBan }, `Bàn ${table.tenBan} đã được gộp vào bàn ${mainTable.tenBan}`));
        }
      }
      
      setSelectedTable(actualTable);
      setLoading(true);
      
      // Kiểm tra bàn có hóa đơn hay không
      if (table.invoiceId && table.status === 'occupied') {
        // Bàn có hóa đơn - load hóa đơn đó lên (kể cả hóa đơn rỗng)
        
        // Tạo invoice object từ dữ liệu có sẵn
        const invoice = {
          maHd: table.invoiceId,
          maBan: table.id,
          tenBan: table.name
        };
        setCurrentInvoice(invoice);
        
        // Load chi tiết hóa đơn
        const detailsResponse = await getChiTietHoaDonTheoMaHD(table.invoiceId);
        console.log('[INVOICE_DETAILS] Raw details response:', detailsResponse);
        
        if (Array.isArray(detailsResponse)) {
          // Lọc chỉ những món có số lượng > 0
          const itemsWithQuantity = detailsResponse.filter(item => parseInt(item.sl) > 0);
          console.log('[INVOICE_DETAILS] Items with quantity:', itemsWithQuantity);
          console.log('[INVOICE_DETAILS] Item structure example:', itemsWithQuantity[0]);
          setInvoiceDetails(itemsWithQuantity);
        } else {
          console.log('[INVOICE_DETAILS] No valid array response, setting empty');
          setInvoiceDetails([]);
        }
        
        if (table.isEmptyInvoice) {
          message.success(__('pages.banhang.empty_invoice_loaded', { table: table.name }, `Đã load hóa đơn rỗng cho bàn ${table.name} - Sẵn sàng chọn món`));
        } else {
          message.success(__('pages.banhang.invoice_loaded', { table: table.name, invoice: table.invoiceId }, `Đã load hóa đơn cho bàn ${table.name} - #${table.invoiceId}`));
        }
      } else {
        // Bàn trống - tự động tạo hóa đơn mới và chuyển sang combined layout
        
        const response = await taoHoaDon(table.id);
        
        if (response && response.success && response.message) {
          const newInvoice = {
            maHd: response.message, // API trả về mã hóa đơn trong field message
            maBan: table.id,
            tenBan: table.name
          };
          setCurrentInvoice(newInvoice);
          setInvoiceDetails([]);
          
          message.success(__('pages.banhang.invoice_created_for_table', { table: table.name, code: response.message }, `Đã tạo hóa đơn mới cho bàn ${table.name} - #${response.message}`));
          
          // Trigger refresh để cập nhật trạng thái bàn
          triggerQuickRefresh('INVOICE_CREATE');
          
          // Chuyển thẳng sang combined layout cho bàn trống
          setCurrentView(VIEW_STATES.COMBINED);
          return; // Kết thúc hàm tại đây
        } else {
          console.error('Invalid response from taoHoaDon:', response);
          throw new Error('Không thể tạo hóa đơn mới');
        }
      }
      
      // Chuyển sang view combined cho bàn có hóa đơn
      setCurrentView(VIEW_STATES.COMBINED);
      
      // Trigger quick refresh sau khi chọn bàn
      triggerQuickRefresh('TABLE_SELECT');
    } catch (error) {
      console.error('Error selecting table:', error);
      message.error('Không thể xử lý bàn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // FLOW 2: Chuyển sang view chọn sản phẩm (dữ liệu do ChonSanPham tự tải)
  const handleSelectItems = async () => {
    setCurrentView(VIEW_STATES.COMBINED); // Chuyển sang combined view thay vì products
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
  // Silent console
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
        const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse);
        }
        message.success(`Đã thêm ${selectedProductForAdd.ten} (x${quantityToAdd}) vào đơn hàng`);
        
        // Trigger quick refresh sau khi thêm sản phẩm
        triggerQuickRefresh('ADD_PRODUCT');
        
        // Đóng modal
        setShowQuantityModal(false);
        setSelectedProductForAdd(null);
        setQuantityToAdd(1);
      }
    } catch (error) {
  // Silent console
      message.error('Không thể thêm sản phẩm: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Cập nhật số lượng sản phẩm - mở modal
  const updateProductQuantity = (item, newQuantity) => {
    if (newQuantity <= 0) {
      removeProductFromOrder(item.maCt || item.cthd);
      return;
    }

    // Mở modal để nhập số lượng mới
    setSelectedItemForUpdate(item);
    setNewQuantityForUpdate(newQuantity);
    setShowUpdateQuantityModal(true);
  };

  // Cập nhật số lượng trực tiếp không qua modal (cho combined view)
  const updateItemQuantity = async (maCt, newQuantity) => {
    if (!currentInvoice) {
      message.error('Thiếu thông tin hóa đơn');
      return;
    }

    const currentItem = invoiceDetails.find(item => item.maCt === maCt || item.cthd === maCt);
    if (!currentItem) {
      message.error('Không tìm thấy sản phẩm trong đơn hàng');
      return;
    }

    if (newQuantity <= 0) {
      // Xóa sản phẩm nếu số lượng <= 0
      try {
        await xoaCtHd({ maCt: maCt });
        const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
        }
        message.success('Đã xóa sản phẩm khỏi đơn hàng');
        triggerQuickRefresh('REMOVE_ITEM');
      } catch (error) {
        message.error('Không thể xóa sản phẩm: ' + (error.message || 'Lỗi không xác định'));
      }
      return;
    }

    try {
      setLoading(true);
      
      // Phương pháp 1: Thử cập nhật trực tiếp bằng capNhatCtHd
      try {
        const updateResult = await capNhatCtHd({
          maCt: maCt,
          soLuong: newQuantity,
          maHd: currentInvoice.maHd
        });
        
        if (updateResult && !Array.isArray(updateResult) && updateResult.success !== false) {
          // Reload chi tiết hóa đơn
          const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
          if (Array.isArray(detailsResponse)) {
            setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
          }
          
          // Trigger quick refresh
          triggerQuickRefresh('UPDATE_QUANTITY');
          return; // Thành công
        } else {
          throw new Error('API returned unsuccessful result');
        }
      } catch (directUpdateError) {
        // Continue to fallback method
      }
      
      // Phương pháp 2: Fallback - Mở modal để cập nhật
      setSelectedItemForUpdate(currentItem);
      setNewQuantityForUpdate(newQuantity);
      setShowUpdateQuantityModal(true);
      message.info('Đang chuyển sang chế độ cập nhật thủ công');
      
    } catch (error) {
      message.error('Không thể cập nhật số lượng: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Xác nhận update số lượng với fallback strategy
  const confirmUpdateQuantity = async () => {
    if (!selectedItemForUpdate || !currentInvoice) {
      message.error('Thiếu thông tin để cập nhật số lượng');
      return;
    }

    try {
      setLoading(true);
      
      // Phương pháp 1: Thử cập nhật trực tiếp bằng capNhatCtHd
      try {
        const updateResult = await capNhatCtHd({
          maCt: selectedItemForUpdate.maCt || selectedItemForUpdate.cthd, // Thử cả 2 field
          soLuong: newQuantityForUpdate,
          maHd: currentInvoice.maHd
        });
        
        // Sửa lại logic kiểm tra - mảng rỗng có nghĩa là không thành công
        if (updateResult && !Array.isArray(updateResult) && updateResult.success !== false) {
          // Reload chi tiết hóa đơn
          const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
          if (Array.isArray(detailsResponse)) {
            setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
          }
          
          message.success(`Đã cập nhật số lượng ${selectedItemForUpdate.tenSp} thành ${newQuantityForUpdate}`);
          
          // Trigger quick refresh
          triggerQuickRefresh('UPDATE_QUANTITY');
          
          // Đóng modal
          setShowUpdateQuantityModal(false);
          setSelectedItemForUpdate(null);
          setNewQuantityForUpdate(1);
          return; // Exit successfully
        } else {
          throw new Error('API returned empty array or unsuccessful result');
        }
      } catch (directUpdateError) {
        // Continue to fallback method
      }
      
      // Phương pháp 2: Fallback - Xóa và thêm lại
      
      // Nếu products chưa được load, load ngay
      if (!products || products.length === 0) {
        await loadProducts();
      }
      
      // Bước 1: Xóa item hiện tại
      await xoaCtHd({ maCt: selectedItemForUpdate.maCt || selectedItemForUpdate.cthd });
      
      // Bước 2: Tìm sản phẩm gốc để lấy mã sản phẩm
      // Thử nhiều cách match để tránh lỗi
      let foundProduct = null;
      
      // Cách 1: Match theo tên chính xác
      foundProduct = products.find(p => p.ten === selectedItemForUpdate.tenSp);
      
      // Cách 2: Match theo tên không phân biệt hoa thường
      if (!foundProduct) {
        foundProduct = products.find(p => 
          p.ten?.toLowerCase().trim() === selectedItemForUpdate.tenSp?.toLowerCase().trim()
        );
      }
      
      // Cách 3: Match theo mã sản phẩm nếu có trong item
      if (!foundProduct && selectedItemForUpdate.maSp) {
        foundProduct = products.find(p => p.id === selectedItemForUpdate.maSp);
      }
      
      // Cách 4: Match partial name
      if (!foundProduct) {
        foundProduct = products.find(p => 
          p.ten?.includes(selectedItemForUpdate.tenSp) || 
          selectedItemForUpdate.tenSp?.includes(p.ten)
        );
      }
      
      if (!foundProduct) {
        throw new Error(`Không tìm thấy sản phẩm "${selectedItemForUpdate.tenSp}" trong danh sách. Vui lòng thử lại sau khi tải lại trang.`);
      }
      
      // Bước 3: Thêm lại với số lượng mới
      await taoCthd(currentInvoice.maHd, foundProduct.id, newQuantityForUpdate);
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
      }
      
      message.success(`Đã cập nhật số lượng ${selectedItemForUpdate.tenSp} thành ${newQuantityForUpdate}`);
      
      // Trigger quick refresh sau khi cập nhật số lượng
      triggerQuickRefresh('UPDATE_QUANTITY');
      
      // Đóng modal
      setShowUpdateQuantityModal(false);
      setSelectedItemForUpdate(null);
      setNewQuantityForUpdate(1);
    } catch (error) {
      console.error('[UPDATE_QUANTITY] Lỗi:', error);
      message.error('Không thể cập nhật số lượng: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Xóa sản phẩm khỏi đơn hàng
  const removeProductFromOrder = async (maCt) => {
    try {
      setLoading(true);
      
      
      // Sử dụng API mới xoaCtHd với object parameter
      const deleteResponse = await xoaCtHd({ maCt });
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
      
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
      
      message.success('Đã xóa sản phẩm khỏi hóa đơn');
      
      // Trigger quick refresh sau khi xóa sản phẩm
      triggerQuickRefresh('REMOVE_PRODUCT');
    } catch (error) {
  // Silent console
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
      const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
    } catch (error) {
  // Silent console
      message.error('Không thể chuyển xuống bếp: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // ===== ENHANCED ORDER PROCESSING WORKFLOW =====
  
  // Confirm order before sending to kitchen
  const confirmOrder = async () => {
    if (!currentInvoice || invoiceDetails.length === 0) {
      message.error('Không có đơn hàng để xác nhận');
      return;
    }

    try {
      setLoading(true);
      
      // Confirm order with current user
      await xacNhanDonHang(currentInvoice.maHd, 'current_user'); // Replace with actual user ID
      
      message.success('Đã xác nhận đơn hàng');
      
      // Update order status
      await capNhatTrangThaiDonHang(currentInvoice.maHd, 'confirmed');
      
      // Refresh invoice details
      const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
      
    } catch (error) {
  // Silent console
      message.error('Không thể xác nhận đơn hàng: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Track order status in real-time
  const trackOrderStatus = async () => {
    if (!currentInvoice) return;
    
    try {
      const statusResponse = await layTrangThaiDonHangRealtime(currentInvoice.maHd);
      
      // Update order status state
      setOrderStatus(statusResponse);
      
      // Update UI based on status
      // This could trigger notifications or UI updates
      
    } catch (error) {
  // Silent console
      // Don't show error message for tracking failures to avoid spam
    }
  };

  // Auto-track order status every 30 seconds
  useEffect(() => {
    let trackingInterval;
    
    if (currentInvoice && currentView === VIEW_STATES.COMBINED) {
      trackingInterval = setInterval(trackOrderStatus, 30000); // Track every 30 seconds
    }
    
    return () => {
      if (trackingInterval) {
        clearInterval(trackingInterval);
      }
    };
  }, [currentInvoice, currentView]);

  // Enhanced payment processing with detailed tracking
  const processPaymentEnhanced = async (paymentData) => {
    try {
      setPaymentLoading(true);

      // Quy trình thanh toán theo backend:
      // Bước 1: PaymentModal đã gọi thanhToanHoaDonChiTiet (tương ứng với việc tính tiền)
      // Bước 2: Gọi tratien với trangThai=3 để kích hoạt chế độ chờ thanh toán (lv011=1)
      // Bước 3: Gọi tratien với trangThai=2 để hoàn tất thanh toán (lv011=2) và xóa khỏi hệ thống
      // Bước 4: Check trạng thái bàn để refresh UI (giống web GMAC)
      
      if (currentInvoice && selectedTable) {
        try {
          // Bước 2: Kích hoạt chế độ chờ thanh toán (tương ứng với bangtitlewaitmini trên web)
          const activateResponse = await tratien(
            currentInvoice.maHd, 
            selectedTable.id, 
            3, // opt=3: Kích hoạt chế độ chờ thanh toán
            '' // cusid rỗng
          );
          // Silent console
          
          // Bước 3: Hoàn tất thanh toán và xóa khỏi hệ thống
          const finalizeResponse = await tratien(
            currentInvoice.maHd, 
            selectedTable.id, 
            2, // opt=2: Thanh toán hoàn tất, xóa khỏi hệ thống
            '' // cusid rỗng
          );
          // Silent console
          
          // Bước 4: Check trạng thái bàn sau thanh toán (ajaxbangid) - Giống web GMAC
          const statusResponse = await ajaxBangId(selectedTable.id);
          // Silent console
          
          if (finalizeResponse && finalizeResponse.success !== false) {
            message.success('Thanh toán hoàn tất');
          } else {
            message.warning('Thanh toán hoàn tất');
          }
        } catch (tratienError) {
          // Silent console
          message.warning('Thanh toán hoàn tất');
        }
      }

      // Trigger refresh to update table status
      triggerQuickRefresh('PAYMENT_COMPLETE');
      
      // Open success popup for online payments
      if (paymentData.phuongThucThanhToan && paymentData.phuongThucThanhToan !== 'Cash') {
        const key = `payment_success_${Date.now()}`;
        localStorage.setItem(key, JSON.stringify(paymentData));

        if (window.electronAPI?.openPaymentSuccessWindow) {
          const response = await window.electronAPI.openPaymentSuccessWindow(key);
          if (!response?.success) {
            message.warning(response?.error || 'Không thể mở cửa sổ thanh toán thành công.');
          }
        } else {
          // Fallback for web version
          const popupUrl = `${window.location.origin}/#/payment/success?key=${key}`;
          const popup = window.open(
            popupUrl,
            '_blank',
            // eslint-disable-next-line no-restricted-globals
            `width=${Math.floor(screen.width * 0.7)},height=${screen.height},left=0,top=0,scrollbars=yes,resizable=yes`
          );
          if (!popup) {
            message.warning('Không thể mở cửa sổ thanh toán thành công. Vui lòng cho phép cửa sổ bật lên.');
          }
        }
        
        // Close payment modal
        setShowPaymentModal(false);
        return;
      }
      
      // Clear current invoice state
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      setSelectedTable(null);
      setCurrentView(VIEW_STATES.TABLES);
      setShowPaymentModal(false);
      
      // Xóa bàn khỏi mergedTableGroups và localStorage
      clearMergedTableGroups(selectedTable);
      
      // Xóa dữ liệu mergedTableGroups khỏi localStorage sau khi thanh toán
      try {
        localStorage.removeItem('mergedTableGroups');
      } catch (error) {
        console.warn('Không thể xóa mergedTableGroups khỏi localStorage:', error);
      }
      
    } catch (error) {
  // Silent console
      message.error('Không thể xử lý thanh toán: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setPaymentLoading(false);
    }
  };

  // Handle payment success modal close - back to tables
  const handlePaymentSuccessClose = () => {
    // Simply back to tables view
    setCurrentView(VIEW_STATES.TABLES);
    message.success('Đã quay lại trang chọn bàn');
  };
    
  // Open payment modal
  const openPaymentModal = () => {
    if (!currentInvoice || invoiceDetails.length === 0) {
      message.error('Không có đơn hàng để thanh toán');
      return;
    }

    // Check if current table has pending kitchen items
    const currentTable = selectedTable;
    const hasPendingItems = currentTable?.hasPendingKitchenItems || 
      invoiceDetails.some(item => {
        const rawId = item.maCt || item.cthd || item.idCthd || item.id || item.lv001;
        return rawId && pendingKitchenIdSet.has(rawId.toString());
      });

    if (hasPendingItems) {
      Modal.confirm({
        title: 'Xác nhận thanh toán',
        content: 'Bàn này có món chưa xong - xác nhận thanh toán?',
        okText: 'Thanh toán',
        cancelText: 'Hủy',
        onOk: () => {
          setShowPaymentModal(true);
        },
        onCancel: () => {
          // Do nothing, just close the modal
        }
      });
    } else {
      setShowPaymentModal(true);
    }
  };

  // Legacy payment function (kept for compatibility)
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
      
      // Xóa bàn khỏi mergedTableGroups nếu có
      if (selectedTable) {
        setMergedTableGroups(prev => {
          const newGroups = { ...prev };
          // Xóa nhóm nếu bàn hiện tại là bàn chính
          if (newGroups[selectedTable.id]) {
            delete newGroups[selectedTable.id];
          }
          // Hoặc xóa bàn khỏi nhóm khác nếu là bàn phụ
          Object.keys(newGroups).forEach(mainTableId => {
            newGroups[mainTableId] = newGroups[mainTableId].filter(t => t.id !== selectedTable.id);
            // Nếu nhóm chỉ còn 1 bàn, xóa luôn nhóm
            if (newGroups[mainTableId].length <= 1) {
              delete newGroups[mainTableId];
            }
          });
          return newGroups;
        });
      }
      
      // Refresh table data to update status
      await loadTables();
      
    } catch (error) {
  // Silent console
      message.error('Không thể xử lý thanh toán: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // ===== ENHANCED INVOICE MANAGEMENT FUNCTIONS =====
  
  // Copy invoice
  const copyInvoice = async (maHd) => {
    try {
      const result = await saoChepHoaDon(maHd, selectedTable.name);
      if (result.success) {
        message.success('Sao chép hóa đơn thành công!');
        // Refresh current invoice data
        const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
        }
        triggerQuickRefresh('COPY_INVOICE');
      } else {
        message.error('Không thể sao chép hóa đơn: ' + (result.message || 'Lỗi không xác định'));
      }
    } catch (error) {
  // Silent console
      message.error('Lỗi khi sao chép hóa đơn');
    }
  };

  // Reprint invoice
  const reprintInvoice = async (invoice) => {
    try {
      // Here you would integrate with your printing system
      message.success('Đang chuẩn bị in hóa đơn...');
      
      // Example print action - replace with actual print implementation
      window.print();
    } catch (error) {
  // Silent console
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
      await capNhatHd({
        maHd: currentInvoice.maHd,
        tongTien: updatedSummary.total,
        thue: updatedSummary.tax,
        giamGia: updatedSummary.discount
      });
      
      setEditingInvoice(false);
      message.success('Đã lưu thay đổi hóa đơn');
      
      // Refresh data
      const detailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
      }
      triggerQuickRefresh('SAVE_EDITS');
      
    } catch (error) {
  // Silent console
      message.error('Lỗi khi lưu thay đổi hóa đơn');
    } finally {
      setLoading(false);
    }
  };

  // Cancel invoice edits
  const cancelInvoiceEdits = () => {
    setEditingInvoice(false);
    // Reload original invoice data
    if (currentInvoice) {
      getChiTietHoaDonTheoMaHD(currentInvoice.maHd).then(detailsResponse => {
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse.filter(item => parseInt(item.sl) > 0));
        }
      });
    }
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
      
      // Xóa bàn khỏi mergedTableGroups nếu có
      if (selectedTable) {
        setMergedTableGroups(prev => {
          const newGroups = { ...prev };
          // Xóa nhóm nếu bàn hiện tại là bàn chính
          if (newGroups[selectedTable.id]) {
            delete newGroups[selectedTable.id];
          }
          // Hoặc xóa bàn khỏi nhóm khác nếu là bàn phụ
          Object.keys(newGroups).forEach(mainTableId => {
            newGroups[mainTableId] = newGroups[mainTableId].filter(t => t.id !== selectedTable.id);
            // Nếu nhóm chỉ còn 1 bàn, xóa luôn nhóm
            if (newGroups[mainTableId].length <= 1) {
              delete newGroups[mainTableId];
            }
          });
          return newGroups;
        });
      }
      
      // Refresh table data to update status
      await loadTables();
      
    } catch (error) {
  // Silent console
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
  // Silent console
      message.error('Không thể tải lịch sử hóa đơn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // ===== TABLE OPERATIONS FUNCTIONS =====
  
  // Function to reload current table's invoice data
  const loadDsHoaDon = async () => {
    if (!selectedTable) {
      return;
    }

    try {
      // Reload table data to get updated status and invoice ID
      await loadTables();
      // Find the updated table info
      const updatedTable = tables.find(t => t.id === selectedTable.id);
      if (updatedTable) {
        // Update current invoice data if table has invoice
        if (updatedTable.invoiceId && updatedTable.status === 'occupied') {
          const invoice = {
            maHd: updatedTable.invoiceId,
            maBan: updatedTable.id,
            tenBan: updatedTable.name
          };
          setCurrentInvoice(invoice);
          // Load chi tiết hóa đơn
          const detailsResponse = await getChiTietHoaDonTheoMaHD(updatedTable.invoiceId);
          if (Array.isArray(detailsResponse)) {
            const itemsWithQuantity = detailsResponse.filter(item => parseInt(item.sl) > 0);
            setInvoiceDetails(itemsWithQuantity);
          } else {
            setInvoiceDetails([]);
          }
        } else {
          // Table is now empty
          setCurrentInvoice(null);
          setInvoiceDetails([]);
        }
        // Update selected table with new data
        setSelectedTable(updatedTable);
      } else {
      }
    } catch (error) {
      message.error('Không thể tải lại dữ liệu hóa đơn: ' + (error.message || 'Lỗi không xác định'));
    }
  };
  
  // Load danh sách bàn có thể thực hiện operation
  const loadAvailableTablesForOperation = async () => {
    try {
      // Lấy tất cả bàn có hóa đơn đang mở (để gộp/chuyển)
      const allTablesWithInvoices = tables.filter(table => table.status === 'occupied');

      // Lọc thêm theo khu vực nếu đang chọn bàn nguồn
      let filteredTables = allTablesWithInvoices;
      if (selectedTable) {
        filteredTables = allTablesWithInvoices.filter(table =>
          table.idKhuVuc === selectedTable.idKhuVuc && table.id !== selectedTable.id
        );
      }

      setAvailableTablesForOperation(filteredTables);

    } catch (error) {
      message.error('Không thể tải danh sách bàn');
    }
  };

  // Load danh sách bàn trống cho tách bàn
  const loadAvailableTablesForSplit = async () => {
    try {
      // Lấy tất cả bàn trống cùng khu vực
      const emptyTables = tables.filter(table =>
        table.status === 'available' &&
        (!selectedTable || table.idKhuVuc === selectedTable.idKhuVuc) &&
        table.id !== selectedTable?.id
      );

      setAvailableTablesForSplit(emptyTables);

    } catch (error) {
      message.error('Không thể tải danh sách bàn trống');
    }
  };

  // Enhanced Gộp bàn với custom logic (không dùng API)
  const handleMergeTable = async (targetTable) => {
      
      // Lấy chi tiết đầy đủ của bàn nguồn để có mã sản phẩm
      let sourceDetailsFull = [];
      try {
        const sourceResponse = await loadDsCthdV2(currentInvoice.maHd);
        sourceDetailsFull = Array.isArray(sourceResponse) 
          ? sourceResponse.filter(item => parseInt(item.sl) > 0)
          : [];
      } catch (error) {
        sourceDetailsFull = invoiceDetails; // fallback
      }
      
      // Lấy danh sách sản phẩm để map tên -> mã
      let allProducts = [];
      try {
        const productsResponse = await getAllSanPham();
        allProducts = Array.isArray(productsResponse) ? productsResponse : [];
      } catch (error) {
      }

      // Hàm tìm mã sản phẩm từ tên
      const findProductCode = (productName) => {
        if (!productName || !allProducts.length) return null;
        
        // Chuẩn hóa tên để so sánh
        const normalizedName = productName.trim().toLowerCase();
        
        // Tìm sản phẩm có tên khớp
        const product = allProducts.find(p => 
          (p.tenSp && p.tenSp.trim().toLowerCase() === normalizedName) ||
          (p.ten && p.ten.trim().toLowerCase() === normalizedName) ||
          (p.tensp && p.tensp.trim().toLowerCase() === normalizedName) ||
          (p.name && p.name.trim().toLowerCase() === normalizedName)
        );
        
        return product ? (product.maSp || product.ma || product.id || product.ma_sp) : null;
      };
      
    if (!selectedTable?.invoiceId || !targetTable) {
      message.error('Vui lòng chọn bàn có hóa đơn và bàn đích để gộp');
      return;
    }

    // Validation: Kiểm tra cùng khu vực
    if (selectedTable.idKhuVuc !== targetTable.idKhuVuc) {
      message.error('Không thể gộp bàn từ khu vực khác nhau');
      return;
    }

    try {
      setOperationInProgress(true);
      setLoading(true);

      // 1. Lấy chi tiết hóa đơn của bàn đích (nếu có)
      let targetInvoiceDetails = [];
      let targetInvoice = null;

      if (targetTable.invoiceId) {
        try {
          const targetDetailsResponse = await loadDsCthdV2(targetTable.invoiceId);
          targetInvoiceDetails = Array.isArray(targetDetailsResponse) 
            ? targetDetailsResponse.filter(item => parseInt(item.sl) > 0)
            : [];
          
          if (targetDetailsResponse === null || targetDetailsResponse === undefined) {
            targetInvoiceDetails = [];
          }
          
          targetInvoice = {
            maHd: targetTable.invoiceId,
            maBan: targetTable.maBan,
            tenBan: targetTable.tenBan
          };
        } catch (error) {
          targetInvoiceDetails = [];
        }
      } else {
      }

      // 2. Kết hợp chi tiết hóa đơn: bàn đích + bàn nguồn
      const combinedInvoiceDetails = [...targetInvoiceDetails, ...invoiceDetails];

      // 3. Tạo hoặc cập nhật hóa đơn cho bàn đích
      let finalInvoiceId = targetTable.invoiceId;

      if (!targetTable.invoiceId) {
        // Tạo hóa đơn mới cho bàn đích
        try {
          const createResponse = await taoHoaDon(targetTable.id);
          if (createResponse && createResponse.success) {
            finalInvoiceId = createResponse.message;
            } else {
            throw new Error('Không thể tạo hóa đơn cho bàn đích');
          }
        } catch (error) {
          throw error;
        }
      }

      // 4. Lấy danh sách món đã xong từ bàn nguồn trước khi gộp
      let completedItems = [];
      try {
        const completedResponse = await layDsMonDaXong();
        completedItems = Array.isArray(completedResponse) ? completedResponse : [];
        // Lọc chỉ lấy món từ hóa đơn hiện tại
        completedItems = completedItems.filter(item => 
          item.maHd === currentInvoice.maHd || item.donHangId === currentInvoice.maHd
        );
        } catch (error) {
        }

      // 5. Thêm tất cả món từ bàn nguồn vào bàn đích
      if (!finalInvoiceId) {
        throw new Error('Không có mã hóa đơn đích để thêm món');
      }

      for (const item of invoiceDetails) {
        try {
          // Sử dụng taoCthd thay vì themChiTietHoaDon
          const productName = item.tenSp || item.ten || item.tensp || item.name;
          const productCode = findProductCode(productName);
          console.log('Sử dụng mã sản phẩm:', productCode, 'cho tên:', productName);
          
          if (!productCode) {
            continue;
          }
          
          const addResponse = await taoCthd(finalInvoiceId, productCode, parseInt(item.sl));

          if (!addResponse || !addResponse.success) {
            } else {
            }
        } catch (error) {
          }
      }

      // 6. Load lại chi tiết hóa đơn đích để lấy thông tin chi tiết mới
      let newInvoiceDetails = [];
      try {
        const newDetailsResponse = await getChiTietHoaDonTheoMaHD(finalInvoiceId);
        newInvoiceDetails = Array.isArray(newDetailsResponse) 
          ? newDetailsResponse.filter(item => parseInt(item.sl) > 0)
          : [];
        } catch (error) {
        }

      // 7. Cập nhật trạng thái món đã xong
      for (const newItem of newInvoiceDetails) {
        // Kiểm tra xem món này có trong danh sách đã xong của bàn nguồn không
        const isCompleted = completedItems.some(completedItem => {
          const completedName = completedItem.tenSp || completedItem.ten || completedItem.tensp || completedItem.name || '';
          const newItemName = newItem.tenSp || newItem.ten || newItem.tensp || newItem.name || '';
          const completedQty = parseInt(completedItem.sl || completedItem.soLuong || 0);
          const newItemQty = parseInt(newItem.sl || 0);
          
          return completedName.trim().toLowerCase() === newItemName.trim().toLowerCase() && 
                 completedQty === newItemQty;
        });

        if (isCompleted) {
          try {
            // Lấy ID của chi tiết hóa đơn mới
            const itemId = newItem.idCthd || newItem.maCt || newItem.id;
            if (itemId) {
              // Cập nhật trạng thái món về "đã xong"
              // Giả sử trạng thái 2 = "đã xong" (1 = chờ, 2 = xong)
              await capNhatTrangThaiMon(itemId, 2, 'Chuyển từ bàn gộp - đã xong');
              } else {
              }
          } catch (error) {
            }
        }
      }

      // 8. Xóa hóa đơn bàn nguồn (thay vì chỉ cập nhật trạng thái)
      if (selectedTable.invoiceId) {
        try {
          await huyHoaDon(selectedTable.invoiceId);
          } catch (error) {
          }
      }

      // 9. Load lại chi tiết hóa đơn đích lần cuối
      let finalInvoiceDetails = [];
      try {
        const finalDetailsResponse = await getChiTietHoaDonTheoMaHD(finalInvoiceId);
        finalInvoiceDetails = Array.isArray(finalDetailsResponse) 
          ? finalDetailsResponse.filter(item => parseInt(item.sl) > 0)
          : [];
        } catch (error) {
        finalInvoiceDetails = newInvoiceDetails; // fallback
      }

      // 10. Cập nhật state local
      // Cập nhật currentInvoice và invoiceDetails cho bàn đích
      const finalInvoice = {
        maHd: finalInvoiceId,
        maBan: targetTable.maBan,
        tenBan: targetTable.tenBan
      };

      setCurrentInvoice(finalInvoice);
      setInvoiceDetails(finalInvoiceDetails); // Sử dụng dữ liệu từ server
      setSelectedTable(targetTable);

      // Cập nhật merged table groups với logic mới
      setMergedTableGroups(prev => {
        const newGroups = { ...prev };
        
        // Kiểm tra xem targetTable đã là bàn chính của nhóm gộp nào chưa
        const isTargetMainTable = newGroups[targetTable.id] !== undefined;
        
        if (isTargetMainTable) {
          // Nếu targetTable đã là bàn chính: thêm selectedTable vào nhóm hiện tại
          newGroups[targetTable.id] = [...newGroups[targetTable.id], selectedTable];
        } else {
          // Nếu targetTable chưa phải bàn chính: kiểm tra selectedTable
          const isSelectedMainTable = newGroups[selectedTable.id] !== undefined;
          
          if (isSelectedMainTable) {
            // Nếu selectedTable là bàn chính: bàn chính cũ trở thành bàn gộp, targetTable trở thành bàn chính mới
            const oldGroup = newGroups[selectedTable.id];
            delete newGroups[selectedTable.id]; // Xóa nhóm cũ
            
            // Tạo nhóm mới với targetTable là bàn chính
            newGroups[targetTable.id] = [targetTable, ...oldGroup]; // targetTable là bàn chính, các bàn cũ (bao gồm selectedTable) trở thành bàn gộp
          } else {
            // Nếu selectedTable là bàn gộp: tìm nhóm của nó và thêm targetTable vào nhóm đó
            const currentGroupKey = Object.keys(newGroups).find(mainTableId => 
              newGroups[mainTableId].some(t => t.id === selectedTable.id)
            );
            
            if (currentGroupKey) {
              // Thêm targetTable vào nhóm hiện tại
              newGroups[currentGroupKey] = [...newGroups[currentGroupKey], targetTable];
            } else {
              // Trường hợp không tìm thấy nhóm (không nên xảy ra), tạo nhóm mới
              newGroups[targetTable.id] = [selectedTable, targetTable];
            }
          }
        }
        
        return newGroups;
      });

      // 11. Thiết lập animation ghép bàn
      setAnimationTables({
        source: selectedTable,
        target: targetTable
      });
      setShowMergeAnimation(true);

      message.success(`Đã gộp bàn ${selectedTable.tenBan} vào bàn ${targetTable.tenBan}`);

      // Reset modal states
      setShowMergeTableModal(false);
      setSelectedTargetTable(null);

      // Delay để chạy animation xong rồi mới refresh
      setTimeout(async () => {
        await loadDsHoaDon();
        refreshTableStatusOnly();
        setOperationInProgress(false);
      }, 2500); // Animation kéo dài 2s + 0.5s buffer

    } catch (error) {
      message.error('Không thể gộp bàn: ' + (error.message || 'Lỗi không xác định'));
      setOperationInProgress(false);
    } finally {
      setLoading(false);
    }

    };

  // Enhanced Tách bàn - Tách theo món lẻ
 
  const handleSplitTable = async () => {
    

    // Validation
    if (!selectedTable?.invoiceId || !currentInvoice) {
      
      message.error('Vui lòng chọn bàn có hóa đơn để tách');
      return;
    }

    if (invoiceDetails.length <= 1) {
      
      message.error('Bàn chỉ có 1 món, không thể tách bàn');
      return;
    }

    if (!selectedItemsForSplit || selectedItemsForSplit.length === 0) {
      
      message.error('Vui lòng chọn ít nhất 1 món để tách');
      return;
    }

    if (!splitTargetTable) {
      
      message.error('Vui lòng chọn bàn đích để chuyển món');
      return;
    }

    // Validation: Kiểm tra cùng khu vực
    if (selectedTable.idKhuVuc !== splitTargetTable.idKhuVuc) {
      
      message.error('Không thể tách bàn sang khu vực khác');
      return;
    }

    // Validation: Kiểm tra bàn đích trống
    if (splitTargetTable.status !== 'available') {
      
      message.error('Bàn đích phải là bàn trống');
      return;
    }

    // Validation: Kiểm tra còn món ở bàn nguồn sau khi tách
    const remainingItems = invoiceDetails.filter(item =>
      !selectedItemsForSplit.some(selectedItem =>
        (selectedItem.maCt || selectedItem.cthd || selectedItem.idCthd) ===
        (item.maCt || item.cthd || item.idCthd)
      )
    );

    if (remainingItems.length === 0) {
      
      message.error('Phải chừa lại ít nhất 1 món ở bàn nguồn');
      return;
    }

    

    try {
      setOperationInProgress(true);
      setLoading(true);

      // 1. Tạo hóa đơn mới cho bàn đích
      

      const createResponse = await taoHoaDon(splitTargetTable.id);
      if (!createResponse || !createResponse.success) {
        throw new Error('Không thể tạo hóa đơn cho bàn đích');
      }

      const targetInvoiceId = createResponse.message;
      

      // 2. Lấy danh sách món đã xong từ bàn nguồn trước khi tách
      

      let completedItems = [];
      try {
        const completedResponse = await layDsMonDaXong();
        completedItems = Array.isArray(completedResponse) ? completedResponse : [];
        // Lọc chỉ lấy món từ hóa đơn hiện tại
        completedItems = completedItems.filter(item => 
          item.maHd === currentInvoice.maHd || item.donHangId === currentInvoice.maHd
        );
        
      } catch (error) {
        
      }

      // 3. Lấy danh sách sản phẩm để map tên -> mã
      

      let allProducts = [];
      try {
        const productsResponse = await getAllSanPham();
        allProducts = Array.isArray(productsResponse) ? productsResponse : [];
        
      } catch (error) {
        
      }

      // Hàm tìm mã sản phẩm từ tên
      const findProductCode = (productName) => {
        if (!productName || !allProducts.length) return null;

        const normalizedName = productName.trim().toLowerCase();

        const product = allProducts.find(p =>
          (p.tenSp && p.tenSp.trim().toLowerCase() === normalizedName) ||
          (p.ten && p.ten.trim().toLowerCase() === normalizedName) ||
          (p.tensp && p.tensp.trim().toLowerCase() === normalizedName) ||
          (p.name && p.name.trim().toLowerCase() === normalizedName)
        );

        return product ? (product.maSp || product.ma || product.id || product.ma_sp) : null;
      };

      // 5. Thêm món được chọn vào bàn đích
      

      for (const item of selectedItemsForSplit) {
        try {
          const productName = item.tenSp || item.ten || item.tensp || item.name;
          const productCode = findProductCode(productName);
          const quantity = parseInt(item.sl || item.soLuong || 1);

          

          if (!productCode) {
            
            continue;
          }

          const addResponse = await taoCthd(targetInvoiceId, productCode, quantity);

          if (!addResponse || !addResponse.success) {
            
          } else {
            
          }
        } catch (error) {
          
        }
      }

      // 6. Load lại chi tiết hóa đơn đích để lấy thông tin chi tiết mới
      

      let newInvoiceDetails = [];
      try {
        const newDetailsResponse = await getChiTietHoaDonTheoMaHD(targetInvoiceId);
        newInvoiceDetails = Array.isArray(newDetailsResponse) 
          ? newDetailsResponse.filter(item => parseInt(item.sl) > 0)
          : [];
        
      } catch (error) {
        
      }

      // 7. Cập nhật trạng thái món đã xong
      

      for (const newItem of newInvoiceDetails) {
        // Kiểm tra xem món này có trong danh sách đã xong của bàn nguồn không
        const isCompleted = completedItems.some(completedItem => {
          const completedName = completedItem.tenSp || completedItem.ten || completedItem.tensp || completedItem.name || '';
          const newItemName = newItem.tenSp || newItem.ten || newItem.tensp || newItem.name || '';
          const completedQty = parseInt(completedItem.sl || completedItem.soLuong || 0);
          const newItemQty = parseInt(newItem.sl || 0);
          
          return completedName.trim().toLowerCase() === newItemName.trim().toLowerCase() && 
                 completedQty === newItemQty;
        });

        if (isCompleted) {
          try {
            // Lấy ID của chi tiết hóa đơn mới
            const itemId = newItem.idCthd || newItem.maCt || newItem.id;
            if (itemId) {
              // Cập nhật trạng thái món về "đã xong"
              // Giả sử trạng thái 2 = "đã xong" (1 = chờ, 2 = xong)
              await capNhatTrangThaiMon(itemId, 2, 'Chuyển từ bàn tách - đã xong');
              
            } else {
              
            }
          } catch (error) {
            
          }
        }
      }

      // 8. Xóa món đã tách khỏi bàn nguồn
      

      for (const item of selectedItemsForSplit) {
        try {
          const itemId = item.maCt || item.cthd || item.idCthd || item.id;
          if (itemId) {
            await xoaCtHd({ maCt: itemId });
            
          } else {
            
          }
        } catch (error) {
          
        }
      }

      // 9. Load lại dữ liệu bàn nguồn
      

      const sourceDetailsResponse = await getChiTietHoaDonTheoMaHD(currentInvoice.maHd);
      if (Array.isArray(sourceDetailsResponse)) {
        setInvoiceDetails(sourceDetailsResponse);
        
      }

      // 10. Reset states
      

      setSelectedItemsForSplit([]);
      setSplitTargetTable(null);
      setShowSplitTableModal(false);

      

      message.success(`Đã tách ${selectedItemsForSplit.length} món sang bàn ${splitTargetTable.tenBan}`);

      // Trigger quick refresh
      triggerQuickRefresh('SPLIT_TABLE');

    } catch (error) {
      
      message.error('Không thể tách bàn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
      setOperationInProgress(false);
    }

    
  };

  // Enhanced Chuyển bàn
  const handleTransferTable = async (targetTable) => {

    const invoiceIdToUse = selectedTable?.invoiceId || currentInvoice?.maHd;
    if (!invoiceIdToUse || !targetTable) {
      message.error('Vui lòng chọn bàn có hóa đơn và bàn đích để chuyển');
      return;
    }

    try {

      setOperationInProgress(true);
      setLoading(true);
      // Gọi API chuyển bàn enhanced - sử dụng invoiceId từ selectedTable hoặc currentInvoice
      const result = await chuyenBanEnhanced(invoiceIdToUse, targetTable.maBan);
      if (result && result.success !== false) {
        message.success(`Đã chuyển từ bàn ${selectedTable.tenBan} sang bàn ${targetTable.tenBan}`);
        
        // Cập nhật trạng thái bàn và mergedTableGroups
        setSelectedTable(targetTable);
        
        // Chuyển trạng thái bàn chính nếu bàn hiện tại là bàn chính của nhóm gộp
        if (mergedTableGroups[selectedTable.id]) {
          setMergedTableGroups(prev => {
            const newGroups = { ...prev };
            // Chuyển nhóm từ bàn cũ sang bàn mới
            newGroups[targetTable.id] = newGroups[selectedTable.id].map(table => 
              table.id === selectedTable.id ? targetTable : table
            );
            delete newGroups[selectedTable.id];
            return newGroups;
          });
        }
        
        // Reset states
        setShowTransferTableModal(false);
        setSelectedTargetTable(null);
        // Refresh data và chọn bàn mới
        await loadDsHoaDon();
        await loadTableStatuses(tables, { silent: true });

      } else {
        throw new Error(result?.message || 'Chuyển bàn thất bại');
      }
    } catch (error) {
      message.error('Không thể chuyển bàn: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
      setOperationInProgress(false);
    }
  };

  // Mở modal operations và load data
  const openMergeTableModal = () => {
  // Silent console
    loadAvailableTablesForOperation();
    setShowMergeTableModal(true);
  };

  const openTransferTableModal = () => {
  // Silent console
    loadAvailableTablesForOperation();
    setShowTransferTableModal(true);
  };

  const openSplitTableModal = () => {
    loadAvailableTablesForSplit();
    setShowSplitTableModal(true);
  };

  // Animation completion handler
  const handleAnimationComplete = () => {
    setShowMergeAnimation(false);
    setAnimationTables({ source: null, target: null });
  };

  // ===== END TABLE OPERATIONS =====

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
  // Silent console
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
  // Silent console
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
      const quantity = parseInt(item.sl || item.soLuong || 0);
      return sum + (price * quantity);
    }, 0);

    // Tính thuế VAT 10% chỉ khi checkbox được check
    const tax = includeVAT ? subtotal * 0.1 : 0;
    
    // Giảm giá mặc định 0% (có thể config sau)
    const discount = 0;
    
    const total = subtotal + tax - discount;

    setInvoiceSummary({
      subtotal,
      tax,
      discount,
      total
    });
    
    // Update orderTotal for PaymentModal synchronization
    setOrderTotal(total);
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
              <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">${item.sl || item.soLuong}</td>
              <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">${(parseFloat(item.gia || item.giaBan || item.donGia || 0)).toLocaleString()}đ</td>
              <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">${(parseFloat(item.gia || item.giaBan || item.donGia || 0) * parseInt(item.sl || item.soLuong)).toLocaleString()}đ</td>
            </tr>
          `).join('')}
        </table>
        <hr>
        <div style="text-align: right; margin-top: 20px;">
          <p><strong>Tạm tính:</strong> ${invoiceSummary.subtotal.toLocaleString()}đ</p>
          ${includeVAT ? `<p><strong>Thuế VAT (10%):</strong> ${invoiceSummary.tax.toLocaleString()}đ</p>` : ''}
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
  }, [invoiceDetails, includeVAT]);

  // Quay lại view trước
  const handleGoBack = () => {
    if (currentView === VIEW_STATES.PRODUCTS) {
      setCurrentView(VIEW_STATES.COMBINED);
      setSelectedCategory('all');
      setSearchTerm('');
    } else if (currentView === VIEW_STATES.COMBINED) {
      setCurrentView(VIEW_STATES.TABLES);
      setSelectedTable(null);
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      setSelectedCategory('all');
      setSearchTerm('');
      
      // Trigger quick refresh khi quay về tables view
      triggerQuickRefresh('BACK_TO_TABLES');
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
        {filteredTables.map(table => {
          // Kiểm tra xem bàn này có thuộc nhóm gộp không
          const isMerged = Object.values(mergedTableGroups).some(group => 
            group.some(t => t.id === table.id)
          );
          
          // Kiểm tra xem bàn này có phải là bàn chính của nhóm gộp không
          const isMainTable = mergedTableGroups[table.id] !== undefined;
          
          // Lấy thông tin nhóm gộp nếu có
          const mergedGroup = isMainTable ? mergedTableGroups[table.id] : null;
          
          return (
            <Card
              key={table.id}
              className={`table-card ${table.status} ${table.hasPendingKitchenItems ? 'table-pending-blink' : ''} ${isMerged ? 'table-merged' : ''} ${isMainTable ? 'table-main-merged' : ''}`}
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
                borderColor: isMainTable ? '#ff6b35' : (isMerged ? '#ff9500' : getTableStatusColor(table.status)),
                borderWidth: isMerged ? '2px' : '1px',
                cursor: 'pointer',
                position: 'relative'
              }}
            >
              {/* Badge cho bàn đã gộp */}
              {isMerged && (
                <div className="merged-table-badge">
                  {isMainTable ? (
                    <Badge count={mergedGroup.length} color="#ff6b35" />
                  ) : (
                    <Badge count="Gộp" color="#ff9500" />
                  )}
                </div>
              )}
              
              <div className="table-header">
                <div className="table-icon">
                  <Coffee 
                    size={24} 
                    color={getTableStatusTextColor(table.status)}
                  />
                </div>
                <div className="table-info">
                  <Title 
                    level={5} 
                    style={{ 
                      margin: 0, 
                      color: getTableStatusTextColor(table.status),
                      fontSize: '16px',
                      fontWeight: 600
                    }}
                  >
                    {table.name}
                  </Title>
                  <div className="table-status">
                    <Text style={{ 
                      color: getTableStatusTextColor(table.status),
                      fontWeight: '500',
                      fontSize: '14px'
                    }}>
                      {getTableStatusText(table.status)}
                    </Text>
                    {isMerged && (
                      <Text style={{ 
                        color: getTableStatusTextColor(table.status),
                        fontSize: '12px',
                        fontStyle: 'italic',
                        marginLeft: '4px'
                      }}>
                        {isMainTable ? '(Bàn chính)' : '(Đã gộp)'}
                      </Text>
                    )}
                  </div>
                  {table.hasPendingKitchenItems && (
                    <div className="table-pending-pill">
                      Đang chờ bếp
                    </div>
                  )}
                </div>
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
                {table.hasPendingKitchenItems && (
                  <div className="table-pending-info">
                    <span>Đang chế biến:</span>
                    <span style={{ fontWeight: 'bold' }}>
                      {table.pendingKitchenOrders.length} món
                    </span>
                  </div>
                )}
                {table.hasPendingKitchenItems && (
                  <div className="table-pending-list">
                    {table.pendingKitchenOrders.slice(0, 3).map((pendingItem, idx) => (
                      <div key={`${pendingItem.idCthd || idx}`} className="pending-item-row">
                        • {pendingItem.tenNuoc} ({pendingItem.soLuong})
                      </div>
                    ))}
                    {table.pendingKitchenOrders.length > 3 && (
                      <div className="pending-item-row more">
                        ...còn {table.pendingKitchenOrders.length - 3} món khác
                      </div>
                    )}
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
                        • {item.tenSp || item.ten} ({item.sl || item.soLuong})
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
          </Card>
          );
        })}
      </div>
    </div>
  );

  const renderProductsView = () => (
    <Content className="products-content">
      {/* Back Button Row */}
      <div className="back-button-row">
        <Button 
          icon={<ArrowLeft size={16} />}
          onClick={handleGoBack}
          className="back-button"
        >
          Quay lại hóa đơn
        </Button>
      </div>
      
      <div className="view-header">
        <Title level={3}>Chọn món - {selectedTable?.name}</Title>
      </div>

      {/* Delegate categories + products UI to ChonSanPham inside products-content */}
      <ChonSanPham onAddToCart={addProductToOrder} />
    </Content>
  );

  // Combined view - 25% Invoice + 75% Products
  const renderCombinedView = () => (
    <div className="combined-view">
      {/* Back Button Row */}
      <div className="back-button-row">
        <Button 
          icon={<ArrowLeft size={16} />}
          onClick={handleGoBack}
          className="back-button"
        >
          Quay lại hóa đơn
        </Button>
      </div>

      <div className="combined-content">
        {/* Left panel - Products (75%) */}
        <div className="products-panel">
          <div className="panel-header">
            <Title level={4} style={{ margin: 0, color: '#197dd3' }}>
              Chọn món
            </Title>
          </div>
          <div className="products-content-wrapper">
            <ChonSanPham onAddToCart={addProductToOrder} />
          </div>
        </div>

        {/* Right panel - Invoice (25%) */}
        <div className="invoice-panel">
          <div className="panel-header">
            <Title level={4} style={{ margin: 0, color: '#197dd3' }}>
              Hóa đơn - {selectedTable?.name}
              {currentInvoice && ` (#${currentInvoice.maHd})`}
            </Title>
          </div>

          {!currentInvoice ? (
            <div className="empty-invoice">
              <Users size={32} />
              <Text>Không có hóa đơn</Text>
            </div>
          ) : (
            <>
              <div className="invoice-summary">
                <div className="invoice-info-compact">
                  <Text strong>Mã HĐ: {currentInvoice.maHd}</Text>
                  <br />
                  <Text>Bàn: {selectedTable?.name}</Text>
                </div>
                
                <div className="invoice-items-compact">
                  {invoiceDetails.length === 0 ? (
                    <div className="empty-items-compact">
                      <ShoppingCart size={32} />
                      <Text>Chưa có món</Text>
                    </div>
                  ) : (
                    invoiceDetails.map((item, idx) => {
                      const rawId = item.maCt || item.cthd || item.idCthd || item.id || item.lv001;
                      const detailId = rawId ? rawId.toString() : `item-${idx}`;
                      const isPendingItem = rawId && pendingKitchenIdSet.has(rawId.toString());
                      return (
                        <div
                          key={detailId}
                          className={`invoice-item-compact ${isPendingItem ? 'invoice-item-pending' : ''}`}
                        >
                          <div className="item-info-compact">
                            <div className="item-info-header">
                              <Text strong>{item.tenSp}</Text>
                              {isPendingItem && (
                                <span className="kitchen-status-tag">Đang chế biến</span>
                              )}
                            </div>
                            <div className="item-details">
                              <Text type="secondary">SL: {item.sl}</Text>
                              <Text type="secondary">
                                {parseFloat(item.gia || item.giaBan || item.donGia || 0).toLocaleString('vi-VN')}đ
                              </Text>
                            </div>
                          </div>
                          
                          <div className="item-controls-compact">
                            <Button
                              size="small"
                              icon={<Minus size={12} />}
                              onClick={() => updateProductQuantity(item, parseInt(item.sl || item.soLuong || 1) - 1)}
                              disabled={editingInvoice}
                            />
                            <span className="quantity-compact">{item.sl || item.soLuong || 1}</span>
                            <Button
                              size="small"
                              icon={<Plus size={12} />}
                              onClick={() => updateProductQuantity(item, parseInt(item.sl || item.soLuong || 1) + 1)}
                              disabled={editingInvoice}
                            />
                          </div>
                        </div>
                      );
                    })
                  )}
                </div>
              </div>

              {/* Fixed footer with total and actions */}
              <div className="invoice-footer-fixed">
                <div className="invoice-total-compact">
                  <div style={{ marginBottom: '8px' }}>
                    <Checkbox
                      checked={includeVAT}
                      onChange={(e) => setIncludeVAT(e.target.checked)}
                    >
                      Thuế VAT (10%)
                    </Checkbox>
                  </div>
                  <div className="total-display">
                    <Text strong style={{ fontSize: '16px' }}>Tổng: </Text>
                    <Text strong className="total-amount" style={{ fontSize: '22px', color: '#197dd3' }}>
                      {invoiceSummary.total.toLocaleString('vi-VN')} đ
                    </Text>
                  </div>
                </div>

                <div className="invoice-actions-compact">
                  <Button
                    icon={<Clock size={14} />}
                    onClick={sendToKitchen}
                    size="small"
                    block
                    style={{ marginBottom: 8 }}
                  >
                    Gửi bếp
                  </Button>
                  
                  <Button
                    type="primary"
                    icon={<CreditCard size={14} />}
                    onClick={openPaymentModal}
                    disabled={invoiceDetails.length === 0}
                    size="small"
                    block
                    style={{ marginBottom: 8 }}
                  >
                    Thanh toán
                  </Button>

                  {/* Hóa đơn management buttons */}
                  <div className="invoice-management-buttons">
                    <Button
                      icon={<Printer size={14} />}
                      onClick={printInvoice}
                      disabled={invoiceDetails.length === 0}
                      size="small"
                      title="In hóa đơn đầy đủ"
                    >
                      In đầy đủ
                    </Button>
                    
                    <ReceiptPrinter
                      invoice={currentInvoice}
                      invoiceDetails={invoiceDetails}
                      orderTotal={invoiceSummary.total}
                      paymentDetails={null}
                      includeVAT={includeVAT}
                      size="small"
                    />
                    
                    {!editingInvoice && (
                      <Button
                        danger
                        icon={<X size={14} />}
                        onClick={cancelInvoice}
                        size="small"
                      >
                        Hủy HĐ
                      </Button>
                    )}
                  </div>

                  {/* Table management buttons */}
                  {currentInvoice && !currentInvoice.isDraft && (
                    <div className="table-management-buttons">
                      <Button
                        icon={<ArrowRight size={14} />}
                        onClick={openTransferTableModal}
                        disabled={loading || operationInProgress}
                        size="small"
                      >
                        Chuyển bàn
                      </Button>
                      
                      <Button
                        icon={<Users size={14} />}
                        onClick={openMergeTableModal}
                        disabled={loading || operationInProgress}
                        size="small"
                      >
                        Gộp bàn
                      </Button>
                      
                      <Button
                        icon={<Split size={14} />}
                        onClick={openSplitTableModal}
                        disabled={loading || operationInProgress || invoiceDetails.length <= 1}
                        size="small"
                      >
                        Tách bàn
                      </Button>
                    </div>
                  )}
                </div>
              </div>
            </>
          )}
        </div>
      </div>
    </div>
  );

  // Listen for payment success popup close messages
  useEffect(() => {
    const handleMessage = (event) => {
      // Remove origin check since it's from same app
      if (event.data?.type === 'PAYMENT_SUCCESS_CLOSED') {
        // Navigate back to tables view
        setCurrentInvoice(null);
        setInvoiceDetails([]);
        setSelectedTable(null);
        setCurrentView(VIEW_STATES.TABLES);
      }
    };

    window.addEventListener('message', handleMessage);
    return () => window.removeEventListener('message', handleMessage);
  }, []);

  // Main render
  return (
    <div className="banhang-container">
      {currentView === VIEW_STATES.TABLES && renderTablesView()}
      {currentView === VIEW_STATES.PRODUCTS && renderProductsView()}
      {currentView === VIEW_STATES.COMBINED && renderCombinedView()}
      
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

      {/* Table Operations Modals */}
      
      {/* Enhanced Table Operations Modals */}
      <TableMergeModal
        visible={showMergeTableModal}
        onCancel={() => {
          setShowMergeTableModal(false);
          setSelectedTargetTable(null);
        }}
        onConfirm={handleMergeTable}
        selectedTable={selectedTable}
        tables={tables}
        loading={loading || operationInProgress}
      />

      <TableSplitModal
        visible={showSplitTableModal}
        onCancel={() => {
          setShowSplitTableModal(false);
          setSelectedItemsForSplit([]);
          setSplitTargetTable(null);
        }}
        onConfirm={handleSplitTable}
        selectedTable={selectedTable}
        invoiceDetails={invoiceDetails}
        loading={loading || operationInProgress}
        selectedItemsForSplit={selectedItemsForSplit}
        setSelectedItemsForSplit={setSelectedItemsForSplit}
        splitTargetTable={splitTargetTable}
        setSplitTargetTable={setSplitTargetTable}
        availableTablesForSplit={availableTablesForSplit}
      />

      <TableTransferModal
        visible={showTransferTableModal}
        onCancel={() => {
          setShowTransferTableModal(false);
          setSelectedTargetTable(null);
        }}
        onConfirm={handleTransferTable}
        selectedTable={selectedTable}
        tables={tables}
        loading={loading || operationInProgress}
      />

      {/* Table Merge Animation */}
      <TableMergeAnimation
        sourceTable={animationTables.source}
        targetTable={animationTables.target}
        isVisible={showMergeAnimation}
        onComplete={handleAnimationComplete}
      />

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
              Món sẽ được xóa và thêm lại với số lượng mới
            </Text>
          </div>
        </div>
      </Modal>

      {/* Enhanced Payment Modal */}
      <PaymentModal
        visible={showPaymentModal}
        onCancel={() => setShowPaymentModal(false)}
        onConfirm={processPaymentEnhanced}
        onPaymentSuccessClose={handlePaymentSuccessClose}
        invoice={currentInvoice}
        orderTotal={orderTotal}
        invoiceDetails={invoiceDetails}
        loading={paymentLoading}
        includeVAT={includeVAT}
      />
    </div>
  );

};

export default BanHang;




