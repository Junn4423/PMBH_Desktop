import React, { useState, useEffect } from 'react';
import { 
  Layout, 
  Row, 
  Col, 
  Card, 
  Table, 
  Button, 
  Modal, 
  Input, 
  Select, 
  Typography, 
  message, 
  Badge, 
  Space,
  Divider,
  InputNumber,
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
  Filter,
  RefreshCw,
  ArrowRight,
  CheckCircle,
  Merge,
  Split,
  ArrowRightLeft
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
  huyHoaDon,
  gopBanBanhang,
  tachBan,
  chuyenBanCorrected
} from '../../services/apiServices';

import './BanHang.css';

const { Title, Text } = Typography;
const { Content, Sider } = Layout;
const { Option } = Select;

const BanHang = () => {
  // State quản lý bàn
  const [tables, setTables] = useState([]);
  const [areas, setAreas] = useState([]);
  const [selectedTable, setSelectedTable] = useState(null);
  const [selectedArea, setSelectedArea] = useState('all');
  
  // State quản lý sản phẩm
  const [categories, setCategories] = useState([]);
  const [products, setProducts] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState('all');
  
  // State quản lý đơn hàng
  const [currentInvoice, setCurrentInvoice] = useState(null);
  const [invoiceDetails, setInvoiceDetails] = useState([]);
  const [orderTotal, setOrderTotal] = useState(0);
  
  // State UI
  const [loading, setLoading] = useState(false);
  const [searchTerm, setSearchTerm] = useState('');
  const [paymentModalVisible, setPaymentModalVisible] = useState(false);
  const [paymentAmount, setPaymentAmount] = useState(0);
  const [customerPayment, setCustomerPayment] = useState(0);
  
  // Table management states
  const [mergeModalVisible, setMergeModalVisible] = useState(false);
  const [transferModalVisible, setTransferModalVisible] = useState(false);
  const [targetTable, setTargetTable] = useState(null);
  const [tableActionsVisible, setTableActionsVisible] = useState(false);
  
  // Load dữ liệu ban đầu
  useEffect(() => {
    loadInitialData();
  }, []);
  
  // Tính toán tổng tiền khi invoice details thay đổi
  useEffect(() => {
    const total = invoiceDetails.reduce((sum, item) => {
      return sum + (parseFloat(item.soLuong || 0) * parseFloat(item.donGia || 0));
    }, 0);
    setOrderTotal(total);
    setPaymentAmount(total);
  }, [invoiceDetails]);

  const loadInitialData = async () => {
    try {
      setLoading(true);
      await Promise.all([
        loadTables(),
        loadAreas(),
        loadProductCategories(),
        loadProducts()
      ]);
    } catch (error) {
      console.error('Error loading initial data:', error);
      message.error('Không thể tải dữ liệu ban đầu');
    } finally {
      setLoading(false);
    }
  };

  // Load danh sách bàn
  const loadTables = async () => {
    try {
      const response = await loadBan();
      console.log('Tables response:', response);
      
      // Xử lý dữ liệu bàn - format: {"idBan":"1","tenBan":"Quầy 1","idKhuVuc":"NGOAI"}
      let tablesData = [];
      if (Array.isArray(response)) {
        tablesData = response.map(table => ({
          id: table.idBan,
          name: table.tenBan,
          areaId: table.idKhuVuc,
          status: 'available' // Có thể lấy từ API status
        }));
      } else {
        console.warn('Tables data is not in expected format:', response);
        tablesData = [];
      }

      setTables(tablesData);
    } catch (error) {
      console.error('Error loading tables:', error);
      message.error('Không thể tải danh sách bàn');
    }
  };

  // Load danh sách khu vực
  const loadAreas = async () => {
    try {
      const result = await loadKhuVuc();
      console.log('Khu vuc response:', result);
      
      // API trả về trực tiếp là array, không có .data
      if (Array.isArray(result) && result.length > 0) {
        setAreas(result);
        console.log('Set khu vuc list:', result);
      } else {
        console.warn('Khu vuc data format:', result);
        message.warning('Không có dữ liệu khu vực');
      }
    } catch (error) {
      console.error('Error loading khu vuc:', error);
      message.error('Không thể tải danh sách khu vực');
    }
  };

  // Load danh mục sản phẩm
  const loadProductCategories = async () => {
    try {
      const categoriesResponse = await getLoaiSanPham();
      console.log('Categories response:', categoriesResponse);
      
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

      // Map categories to consistent format
      const mappedCategories = categoriesData.map(cat => ({
        value: cat.idLoaiSp || cat.id || cat.maLoai,
        label: cat.tenLoaiSp || cat.ten || cat.tenLoai,
        // Keep original fields for backward compatibility
        maDm: cat.idLoaiSp || cat.id || cat.maLoai,
        ten: cat.tenLoaiSp || cat.ten || cat.tenLoai
      }));

      setCategories(mappedCategories);
    } catch (error) {
      console.error('Error loading categories:', error);
    }
  };

  // Load sản phẩm
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

  // Chọn bàn và load hóa đơn hiện tại
  const handleTableSelect = async (table) => {
    try {
      setSelectedTable(table);
      setLoading(true);
      
      // Load hóa đơn hiện tại của bàn
      const invoiceResponse = await loadHoaDonTheoBan(table.id);
      
      if (invoiceResponse && invoiceResponse.length > 0) {
        const invoice = invoiceResponse[0];
        setCurrentInvoice(invoice);
        
        // Load chi tiết hóa đơn
        const detailsResponse = await loadDsCthd(invoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse);
        }
      } else {
        setCurrentInvoice(null);
        setInvoiceDetails([]);
      }
    } catch (error) {
      console.error('Error selecting table:', error);
      message.error('Không thể tải thông tin bàn');
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
      
      if (response && response.maHd) {
        setCurrentInvoice(response);
        setInvoiceDetails([]);
        message.success('Đã tạo hóa đơn mới');
      }
    } catch (error) {
      console.error('Error creating invoice:', error);
      message.error('Không thể tạo hóa đơn mới');
    } finally {
      setLoading(false);
    }
  };

  // Thêm sản phẩm vào hóa đơn
  const addProductToOrder = async (product) => {
    if (!currentInvoice) {
      // Tạo hóa đơn mới nếu chưa có
      await createNewInvoice();
      if (!currentInvoice) return;
    }

    try {
      const response = await taoCthd(currentInvoice.maHd, product.id, 1);
      
      if (response) {
        // Reload chi tiết hóa đơn
        const detailsResponse = await loadDsCthd(currentInvoice.maHd);
        if (Array.isArray(detailsResponse)) {
          setInvoiceDetails(detailsResponse);
        }
        message.success(`Đã thêm ${product.ten} vào đơn hàng`);
      }
    } catch (error) {
      console.error('Error adding product:', error);
      message.error('Không thể thêm sản phẩm');
    }
  };

  // Cập nhật số lượng sản phẩm
  const updateProductQuantity = async (item, newQuantity) => {
    if (newQuantity <= 0) {
      await removeProductFromOrder(item.maCt);
      return;
    }

    try {
      await capNhatCtHd({ maCt: item.maCt, soLuong: newQuantity });
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await loadDsCthd(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
    } catch (error) {
      console.error('Error updating quantity:', error);
      message.error('Không thể cập nhật số lượng');
    }
  };

  // Xóa sản phẩm khỏi đơn hàng
  const removeProductFromOrder = async (maCt) => {
    try {
      await xoaCtHd(maCt);
      
      // Reload chi tiết hóa đơn
      const detailsResponse = await loadDsCthd(currentInvoice.maHd);
      if (Array.isArray(detailsResponse)) {
        setInvoiceDetails(detailsResponse);
      }
      message.success('Đã xóa sản phẩm');
    } catch (error) {
      console.error('Error removing product:', error);
      message.error('Không thể xóa sản phẩm');
    }
  };

  // Chuyển xuống bếp
  const sendToKitchen = async () => {
    if (!currentInvoice) {
      message.error('Không có hóa đơn để chuyển xuống bếp');
      return;
    }

    try {
      await chuyenXuongBep(currentInvoice.maHd);
      message.success('Đã chuyển đơn hàng xuống bếp');
    } catch (error) {
      console.error('Error sending to kitchen:', error);
      message.error('Không thể chuyển xuống bếp');
    }
  };

  // Thanh toán hóa đơn
  const processPayment = async () => {
    if (!currentInvoice || invoiceDetails.length === 0) {
      message.error('Không có đơn hàng để thanh toán');
      return;
    }

    if (customerPayment < paymentAmount) {
      message.error('Số tiền khách đưa không đủ');
      return;
    }

    try {
      const change = customerPayment - paymentAmount;
      
      await thanhToanHoaDonBanhang({
        maHd: currentInvoice.maHd,
        tongTien: paymentAmount,
        tienKhachDua: customerPayment,
        tienThua: change
      });

      message.success('Thanh toán thành công');
      setPaymentModalVisible(false);
      
      // Reset đơn hàng
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      setSelectedTable(null);
      
    } catch (error) {
      console.error('Error processing payment:', error);
      message.error('Không thể xử lý thanh toán');
    }
  };

  // Gộp bàn
  const mergeTables = async () => {
    if (!currentInvoice || !targetTable) {
      message.error('Vui lòng chọn bàn để gộp');
      return;
    }

    try {
      await gopBanBanhang(currentInvoice.maHd, targetTable.id);
      message.success(`Đã gộp bàn ${selectedTable.name} vào ${targetTable.name}`);
      setMergeModalVisible(false);
      setTargetTable(null);
      
      // Reload thông tin bàn
      await handleTableSelect(targetTable);
    } catch (error) {
      console.error('Error merging tables:', error);
      message.error('Không thể gộp bàn');
    }
  };

  // Tách bàn
  const splitTable = async () => {
    if (!currentInvoice) {
      message.error('Không có hóa đơn để tách bàn');
      return;
    }

    try {
      await tachBan(currentInvoice.maHd);
      message.success('Đã tách bàn thành công');
      
      // Reload thông tin bàn
      await handleTableSelect(selectedTable);
    } catch (error) {
      console.error('Error splitting table:', error);
      message.error('Không thể tách bàn');
    }
  };

  // Chuyển bàn
  const transferTable = async () => {
    if (!currentInvoice || !targetTable) {
      message.error('Vui lòng chọn bàn để chuyển');
      return;
    }

    try {
      // Load hóa đơn của bàn đích (nếu có)
      const targetInvoiceResponse = await loadHoaDonTheoBan(targetTable.id);
      let targetInvoiceId = null;
      
      if (targetInvoiceResponse && targetInvoiceResponse.length > 0) {
        targetInvoiceId = targetInvoiceResponse[0].maHd;
      }

      await chuyenBanCorrected({
        maHoaDonBanCanChuyen: currentInvoice.maHd,
        maHoaDonBanChuyen: targetInvoiceId,
        maBanChuyen: targetTable.id
      });

      message.success(`Đã chuyển bàn từ ${selectedTable.name} sang ${targetTable.name}`);
      setTransferModalVisible(false);
      setTargetTable(null);
      
      // Reset và chọn bàn đích
      setCurrentInvoice(null);
      setInvoiceDetails([]);
      await handleTableSelect(targetTable);
    } catch (error) {
      console.error('Error transferring table:', error);
      message.error('Không thể chuyển bàn');
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

  return (
    <Layout className="ban-hang-new-layout">
      {/* Sidebar - Danh sách bàn */}
      <Sider width={300} className="ban-hang-sidebar">
        <div className="sidebar-header">
          <Title level={4}>Danh sách bàn</Title>
          <Select
            value={selectedArea}
            onChange={setSelectedArea}
            style={{ width: '100%', marginTop: 8 }}
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
              className={`table-card ${selectedTable?.id === table.id ? 'selected' : ''}`}
              onClick={() => handleTableSelect(table)}
              hoverable
            >
              <div className="table-info">
                <Coffee size={20} />
                <span>{table.name}</span>
              </div>
              <Badge 
                status={table.status === 'occupied' ? 'error' : 'success'} 
                text={table.status === 'occupied' ? 'Có khách' : 'Trống'}
              />
            </Card>
          ))}
        </div>
      </Sider>

      {/* Main Content */}
      <Layout>
        <Content className="ban-hang-content">
          <Row gutter={16} style={{ height: '100%' }}>
            {/* Cột trái - Danh sách sản phẩm */}
            <Col span={14} className="products-section">
              <Card title="Danh sách món" className="products-card">
                <div className="products-filter">
                  <Input
                    placeholder="Tìm món..."
                    prefix={<Search size={16} />}
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                    style={{ marginBottom: 16 }}
                  />
                  
                  <Select
                    value={selectedCategory}
                    onChange={setSelectedCategory}
                    style={{ width: '100%', marginBottom: 16 }}
                    placeholder="Chọn danh mục"
                  >
                    <Option value="all">Tất cả danh mục</Option>
                    {categories.map(category => (
                      <Option key={category.maDm} value={category.maDm}>
                        {category.ten}
                      </Option>
                    ))}
                  </Select>
                </div>

                <Row gutter={[12, 12]}>
                  {filteredProducts.map(product => (
                    <Col span={8} key={product.id}>
                      <Card
                        className="product-card"
                        hoverable
                        onClick={() => addProductToOrder(product)}
                      >
                        <div className="product-info">
                          <Title level={5} className="product-name">
                            {product.ten}
                          </Title>
                          <Text className="product-price">
                            {parseFloat(product.gia || 0).toLocaleString('vi-VN')} đ
                          </Text>
                        </div>
                      </Card>
                    </Col>
                  ))}
                </Row>
              </Card>
            </Col>

            {/* Cột phải - Đơn hàng hiện tại */}
            <Col span={10} className="order-section">
              <Card 
                title={
                  <div className="order-header">
                    <span>Đơn hàng {selectedTable ? `- ${selectedTable.name}` : ''}</span>
                    {!currentInvoice && selectedTable && (
                      <Button 
                        type="primary" 
                        size="small"
                        onClick={createNewInvoice}
                      >
                        Tạo hóa đơn
                      </Button>
                    )}
                  </div>
                }
                className="order-card"
              >
                {!selectedTable ? (
                  <div className="empty-state">
                    <Users size={48} />
                    <Text>Vui lòng chọn bàn để bắt đầu</Text>
                  </div>
                ) : !currentInvoice ? (
                  <div className="empty-state">
                    <ShoppingCart size={48} />
                    <Text>Chưa có hóa đơn cho bàn này</Text>
                  </div>
                ) : (
                  <>
                    <div className="order-items">
                      {invoiceDetails.map(item => (
                        <div key={item.maCt} className="order-item">
                          <div className="item-info">
                            <Text strong>{item.tenSp}</Text>
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
                              style={{ width: 60, margin: '0 4px' }}
                              onChange={(value) => updateProductQuantity(item, value)}
                            />
                            <Button
                              size="small"
                              icon={<Plus size={12} />}
                              onClick={() => updateProductQuantity(item, parseInt(item.soLuong) + 1)}
                            />
                            <Button
                              size="small"
                              danger
                              icon={<Trash2 size={12} />}
                              onClick={() => removeProductFromOrder(item.maCt)}
                              style={{ marginLeft: 8 }}
                            />
                          </div>
                        </div>
                      ))}
                    </div>

                    <Divider />

                    <div className="order-summary">
                      <div className="total-row">
                        <Text strong>Tổng cộng: </Text>
                        <Text strong className="total-amount">
                          {orderTotal.toLocaleString('vi-VN')} đ
                        </Text>
                      </div>
                    </div>

                    <div className="order-actions">
                      <div className="table-management-actions">
                        <Space wrap>
                          <Button
                            size="small"
                            icon={<Merge size={14} />}
                            onClick={() => setMergeModalVisible(true)}
                            disabled={!currentInvoice}
                          >
                            Gộp bàn
                          </Button>
                          <Button
                            size="small"
                            icon={<Split size={14} />}
                            onClick={splitTable}
                            disabled={!currentInvoice}
                          >
                            Tách bàn
                          </Button>
                          <Button
                            size="small"
                            icon={<ArrowRightLeft size={14} />}
                            onClick={() => setTransferModalVisible(true)}
                            disabled={!currentInvoice}
                          >
                            Chuyển bàn
                          </Button>
                        </Space>
                      </div>
                      
                      <Button
                        type="default"
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
                        onClick={() => setPaymentModalVisible(true)}
                        disabled={invoiceDetails.length === 0}
                        block
                      >
                        Thanh toán
                      </Button>
                    </div>
                  </>
                )}
              </Card>
            </Col>
          </Row>
        </Content>
      </Layout>

      {/* Payment Modal */}
      <Modal
        title="Thanh toán hóa đơn"
        open={paymentModalVisible}
        onCancel={() => setPaymentModalVisible(false)}
        footer={[
          <Button key="cancel" onClick={() => setPaymentModalVisible(false)}>
            Hủy
          </Button>,
          <Button 
            key="pay" 
            type="primary" 
            onClick={processPayment}
            disabled={customerPayment < paymentAmount}
          >
            Thanh toán
          </Button>
        ]}
      >
        <div className="payment-content">
          <div className="payment-summary">
            <Row justify="space-between">
              <Text>Tổng tiền:</Text>
              <Text strong>{paymentAmount.toLocaleString('vi-VN')} đ</Text>
            </Row>
          </div>

          <Divider />

          <div className="payment-input">
            <Text>Tiền khách đưa:</Text>
            <InputNumber
              style={{ width: '100%', marginTop: 8 }}
              value={customerPayment}
              onChange={setCustomerPayment}
              formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
              parser={value => value.replace(/\$\s?|(,*)/g, '')}
              min={0}
            />
          </div>

          {customerPayment >= paymentAmount && (
            <div className="change-amount">
              <Row justify="space-between">
                <Text>Tiền thừa:</Text>
                <Text strong className="change">
                  {(customerPayment - paymentAmount).toLocaleString('vi-VN')} đ
                </Text>
              </Row>
            </div>
          )}
        </div>
      </Modal>

      {/* Merge Tables Modal */}
      <Modal
        title="Gộp bàn"
        open={mergeModalVisible}
        onCancel={() => {
          setMergeModalVisible(false);
          setTargetTable(null);
        }}
        footer={[
          <Button key="cancel" onClick={() => {
            setMergeModalVisible(false);
            setTargetTable(null);
          }}>
            Hủy
          </Button>,
          <Button 
            key="merge" 
            type="primary" 
            onClick={mergeTables}
            disabled={!targetTable}
          >
            Gộp bàn
          </Button>
        ]}
      >
        <div className="table-selection-content">
          <Text>Chọn bàn để gộp vào:</Text>
          <div className="table-selection-grid">
            {filteredTables
              .filter(table => table.id !== selectedTable?.id)
              .map(table => (
                <Card
                  key={table.id}
                  className={`table-select-card ${targetTable?.id === table.id ? 'selected' : ''}`}
                  onClick={() => setTargetTable(table)}
                  hoverable
                >
                  <div className="table-info">
                    <Coffee size={16} />
                    <span>{table.name}</span>
                  </div>
                </Card>
              ))}
          </div>
        </div>
      </Modal>

      {/* Transfer Table Modal */}
      <Modal
        title="Chuyển bàn"
        open={transferModalVisible}
        onCancel={() => {
          setTransferModalVisible(false);
          setTargetTable(null);
        }}
        footer={[
          <Button key="cancel" onClick={() => {
            setTransferModalVisible(false);
            setTargetTable(null);
          }}>
            Hủy
          </Button>,
          <Button 
            key="transfer" 
            type="primary" 
            onClick={transferTable}
            disabled={!targetTable}
          >
            Chuyển bàn
          </Button>
        ]}
      >
        <div className="table-selection-content">
          <Text>Chọn bàn đích để chuyển:</Text>
          <div className="table-selection-grid">
            {filteredTables
              .filter(table => table.id !== selectedTable?.id)
              .map(table => (
                <Card
                  key={table.id}
                  className={`table-select-card ${targetTable?.id === table.id ? 'selected' : ''}`}
                  onClick={() => setTargetTable(table)}
                  hoverable
                >
                  <div className="table-info">
                    <Coffee size={16} />
                    <span>{table.name}</span>
                  </div>
                </Card>
              ))}
          </div>
        </div>
      </Modal>
    </Layout>
  );
};

export default BanHang;
