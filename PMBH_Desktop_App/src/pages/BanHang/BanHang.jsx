import React, { useState, useEffect } from 'react';
import { Typography, Button, Space, message, Modal, Input, Select } from 'antd';
import { Search, Filter, Plus } from 'lucide-react';
import { useCart } from '../../contexts/CartContext';
import { getAllSanPham, getLoaiSanPham, loadBan, loadKhuVuc, createGmacOrder } from '../../services/apiServices';
import TableGrid from '../../components/tables/TableGrid';
import { CartSidebar, FloatingCartButton } from '../../components/cart/CartComponents';
import ChonSanPham from './ChonSanPham';
import '../../styles/tables/TableGrid.css';

const { Title, Text } = Typography;
const { Option } = Select;

const BanHang = () => {
  const {
    cartItems,
    selectedTable,
    customer,
    discount,
    total,
    finalTotal,
    addToCart,
    updateQuantity,
    removeFromCart,
    clearCart,
    setCustomer,
    setDiscount,
    saveOrder,
    setSelectedTable
  } = useCart();

  // States
  const [tables, setTables] = useState([]);
  const [khuVucList, setKhuVucList] = useState([]);
  const [loadingTables, setLoadingTables] = useState(false);
  const [loadingKhuVuc, setLoadingKhuVuc] = useState(false);
  const [selectedKhuVuc, setSelectedKhuVuc] = useState('all');
  const [showCart, setShowCart] = useState(false);
  const [showProductModal, setShowProductModal] = useState(false);
  const [searchTerm, setSearchTerm] = useState('');

  // Load tables và khu vực khi component mount
  useEffect(() => {
    loadTableList();
    fetchKhuVuc();
  }, []);

  const loadTableList = async () => {
    try {
      setLoadingTables(true);
      const tablesResponse = await loadBan();
      console.log('Tables response:', tablesResponse);
      
      // Xử lý dữ liệu bàn - format: {"idBan":"1","tenBan":"Quầy 1","idKhuVuc":"NGOAI"}
      let tablesData = [];
      if (Array.isArray(tablesResponse)) {
        tablesData = tablesResponse.map(table => ({
          id: table.idBan,
          tenBan: table.tenBan,
          idKhuVuc: table.idKhuVuc,
          khuVuc: table.idKhuVuc
        }));
      } else {
        console.warn('Tables data is not in expected format:', tablesResponse);
        tablesData = [];
      }

      setTables(tablesData);
    } catch (error) {
      console.error('Error loading tables:', error);
      message.error('Không thể tải danh sách bàn');
    } finally {
      setLoadingTables(false);
    }
  };

  // Load danh sách khu vực
  const fetchKhuVuc = async () => {
    setLoadingKhuVuc(true);
    try {
      const result = await loadKhuVuc();
      console.log('Khu vuc response:', result);
      
      // API trả về trực tiếp là array, không có .data
      if (Array.isArray(result) && result.length > 0) {
        setKhuVucList(result);
        console.log('Set khu vuc list:', result);
      } else {
        console.warn('Khu vuc data format:', result);
        message.warning('Không có dữ liệu khu vực');
      }
    } catch (error) {
      console.error('Error loading khu vuc:', error);
      message.error('Không thể tải danh sách khu vực');
    } finally {
      setLoadingKhuVuc(false);
    }
  };

  // Filter tables theo search term và khu vực
  const filteredTables = tables.filter(table => {
    const matchesSearch = table.tenBan?.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesKhuVuc = selectedKhuVuc === 'all' || table.idKhuVuc === selectedKhuVuc;
    return matchesSearch && matchesKhuVuc;
  });

  const handleTableSelect = (table) => {
    setSelectedTable(table);
    message.success(`Đã chọn ${table.tenBan}`);
    setShowProductModal(true);
  };

  const handleSaveOrder = async () => {
    if (!selectedTable) {
      message.error('Vui lòng chọn bàn');
      return;
    }

    if (cartItems.length === 0) {
      message.error('Giỏ hàng trống');
      return;
    }

    try {
      // Tạo đơn hàng qua GMAC API
      const orderData = {
        banId: selectedTable.id,
        itemId: cartItems[0].id,
        order: 1,
        customerId: customer?.id || '',
        addState: 1,
        traHang: 0,
        programId: '',
        contractId: ''
      };

      const result = await createGmacOrder(orderData);

      if (result && result.success) {
        message.success('Đã lưu đơn hàng thành công');
        clearCart();
        setShowCart(false);
      } else {
        throw new Error('Không thể tạo đơn hàng');
      }
    } catch (error) {
      console.error('Error saving order:', error);
      message.error(error.message || 'Không thể lưu đơn hàng');
    }
  };

  const handlePrintOrder = () => {
    message.info('Chức năng in hóa đơn cần gói premium để sử dụng');
  };

  return (
    <div className="tables-container">
      {/* Header */}
      <div className="tables-header">
        <div>
          <Title level={3} style={{ margin: 0, color: '#4b4344' }}>
            Chọn bàn để bán hàng
          </Title>
          <Text type="secondary">
            {tables.length} bàn • {cartItems.length} món trong giỏ
          </Text>
        </div>
        
        <div className="tables-filter">
          <Input
            placeholder="Tìm bàn..."
            prefix={<Search size={16} />}
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            style={{ width: 200 }}
          />
          
          <Select
            value={selectedKhuVuc}
            onChange={setSelectedKhuVuc}
            style={{ width: 200 }}
            loading={loadingKhuVuc}
            placeholder="Chọn khu vực"
          >
            <Option value="all">Tất cả khu vực</Option>
            {khuVucList.map(khuVuc => (
              <Option key={khuVuc.idKhuVuc} value={khuVuc.idKhuVuc}>
                {khuVuc.ten}
              </Option>
            ))}
          </Select>
        </div>
      </div>

      {/* Tables Grid */}
      <TableGrid
        tables={filteredTables}
        loading={loadingTables}
        selectedTable={selectedTable}
        onTableSelect={handleTableSelect}
        selectedKhuVuc={selectedKhuVuc}
      />

      {/* Floating Cart Button */}
      <FloatingCartButton
        cartItems={cartItems}
        onClick={() => setShowCart(true)}
      />

      {/* Cart Sidebar */}
      <CartSidebar
        isOpen={showCart}
        onClose={() => setShowCart(false)}
        cartItems={cartItems}
        selectedTable={selectedTable}
        customer={customer}
        discount={discount}
        total={total}
        finalTotal={finalTotal}
        onUpdateQuantity={updateQuantity}
        onRemoveItem={removeFromCart}
        onSaveOrder={handleSaveOrder}
        onPrintOrder={handlePrintOrder}
      />

      {/* Product Selection Modal */}
      <Modal
        title={`Chọn món cho ${selectedTable?.tenBan || 'bàn'}`}
        open={showProductModal}
        onCancel={() => setShowProductModal(false)}
        footer={null}
        width={1200}
        centered
      >
        <ChonSanPham onAddToCart={addToCart} />
      </Modal>
    </div>
  );
};

export default BanHang;
