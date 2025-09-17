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
  Popconfirm
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
  CheckCircle
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
  tinhTongTienHoaDon
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
  
  // State UI
  const [loading, setLoading] = useState(false);

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

  const getTableStatusText = (status) => {
    switch (status) {
      case 'available': return 'Trống';
      case 'occupied': return 'Có khách';
      case 'serving': return 'Đang phục vụ';
      case 'checkout': return 'Thanh toán';
      default: return 'Không xác định';
    }
  };

  // Load dữ liệu ban đầu
  useEffect(() => {
    loadInitialData();
  }, []);

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
        return sum + (parseFloat(item.donGia || 0) * parseInt(item.soLuong || 0));
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

  // Thêm sản phẩm vào hóa đơn
  const addProductToOrder = async (product) => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn trước');
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
      const response = await taoCthd(currentInvoice.maHd, product.id, 1);
      
      if (response) {
        // Reload chi tiết hóa đơn
        const detailsResponse = await loadDsCthd(currentInvoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse);
        }
        message.success(`Đã thêm ${product.ten} vào đơn hàng`);
        
        // Quay lại view hóa đơn sau khi thêm sản phẩm
        setCurrentView(VIEW_STATES.INVOICE);
      }
    } catch (error) {
      console.error('Error adding product:', error);
      message.error('Không thể thêm sản phẩm: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setLoading(false);
    }
  };

  // Hủy hóa đơn
  const cancelInvoice = async () => {
    if (!currentInvoice) {
      message.error('Không có hóa đơn để hủy');
      return;
    }

    try {
      setLoading(true);
      await huyHoaDon(currentInvoice.maHd);
      
      message.success('Đã hủy hóa đơn thành công');
      
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

  // Cập nhật số lượng sản phẩm
  const updateProductQuantity = async (item, newQuantity) => {
    if (newQuantity <= 0) {
      await removeProductFromOrder(item.maCt);
      return;
    }

    try {
      setLoading(true);
      
      // Sử dụng API mới capNhatCtHd thay vì gọi trực tiếp
      await capNhatCtHd({ 
        maCt: item.maCt, 
        soLuong: newQuantity,
        ghiChu: item.ghiChu || '' // Giữ nguyên ghi chú cũ
      });
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await loadDsCthd(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
      
      message.success('Đã cập nhật số lượng');
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

  // Quay lại view trước
  const handleGoBack = () => {
    if (currentView === VIEW_STATES.INVOICE) {
      setCurrentView(VIEW_STATES.TABLES);
      setSelectedTable(null);
      setCurrentInvoice(null);
      setInvoiceDetails([]);
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
        <Title level={3}>Chọn bàn để bán hàng</Title>
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
      
      <div className="tables-grid">
        {filteredTables.map(table => (
          <Card
            key={table.id}
            className={`table-card ${table.status}`}
            onClick={() => handleTableSelect(table)}
            hoverable={false}
            bodyStyle={{ padding: 0, height: '100%' }}
          >
            <div className="table-header">
              <div className="table-icon">
                <Coffee size={24} />
              </div>
            </div>
            
            <div className="table-info">
              <Title level={5}>{table.name}</Title>
              <div className="table-status">
                <Badge 
                  status={getTableBadgeStatus(table.status)} 
                  text={getTableStatusText(table.status)}
                />
              </div>
              
              {/* Hiển thị thông tin chi tiết nếu bàn có khách */}
              {table.status !== 'available' && (
                <div className="table-details">
                  {table.sittingTime && (
                    <div className="detail-row">
                      <span className="detail-label">Thời gian:</span>
                      <span className="detail-value">{table.sittingTime}</span>
                    </div>
                  )}
                  {table.totalAmount > 0 && (
                    <div className="detail-row">
                      <span className="detail-label">Tổng tiền:</span>
                      <span className="detail-value">{table.totalAmount.toLocaleString()}đ</span>
                    </div>
                  )}
                  {table.itemCount > 0 && (
                    <div className="detail-row">
                      <span className="detail-label">Số món:</span>
                      <span className="detail-value">{table.itemCount}</span>
                    </div>
                  )}
                  {table.orderItems && table.orderItems.length > 0 && (
                    <div className="order-preview">
                      {table.orderItems.map((item, index) => (
                        <div key={index} className="order-item">
                          {item.tenSp || item.ten} ({item.soLuong})
                        </div>
                      ))}
                      {table.itemCount > 3 && (
                        <div className="order-more">
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
          <Button 
            icon={<ArrowLeft size={16} />}
            onClick={handleGoBack}
          >
            Quay lại
          </Button>
          <Title level={3}>
            Hóa đơn - {selectedTable?.name}
            {currentInvoice && ` (#${currentInvoice.maHd})`}
          </Title>
          <Button 
            type="primary"
            icon={<ShoppingCart size={16} />}
            onClick={handleSelectItems}
          >
            Chọn món
          </Button>
        </div>

        {!currentInvoice ? (
          <div className="empty-invoice">
            <Users size={48} />
            <Text>Chưa có hóa đơn cho bàn này</Text>
            <Button type="primary" onClick={createNewInvoice}>
              Tạo hóa đơn mới
            </Button>
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
                      {parseFloat(item.donGia || 0).toLocaleString('vi-VN')} đ
                    </Text>
                  </div>
                  
                  <div className="item-controls">
                    <Button
                      size="small"
                      icon={<Minus size={12} />}
                      onClick={() => updateProductQuantity(item, parseInt(item.soLuong) - 1)}
                    />
                    <InputNumber
                      size="small"
                      value={item.soLuong}
                      min={1}
                      style={{ width: 60, margin: '0 8px' }}
                      onChange={(value) => updateProductQuantity(item, value)}
                    />
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
            <div className="total-row">
              <Text strong>Tổng cộng: </Text>
              <Text strong className="total-amount">
                {orderTotal.toLocaleString('vi-VN')} đ
              </Text>
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
    </div>
  );
};

export default BanHang;
