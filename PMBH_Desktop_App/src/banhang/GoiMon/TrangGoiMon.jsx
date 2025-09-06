import React, { useState, useEffect } from 'react';
import { 
  Row, Col, Card, Button, Typography, Space, Input, 
  Divider, List, Tag, Avatar, Modal, message 
} from 'antd';
import {
  ClockCircleOutlined, UserOutlined, EditOutlined,
  PlusOutlined, CheckOutlined, PrinterOutlined,
  DeleteOutlined, CommentOutlined
} from '@ant-design/icons';
import { useGoiMon } from '../../hooks/useGoiMon';
import { useBanHang } from '../../hooks/useBanHang';
import ChonSanPham from './ChonSanPham';
import GioHang from './GioHang';

const { Title, Text } = Typography;
const { TextArea } = Input;

const TrangGoiMon = ({ banId, onBack }) => {
  const [showProductSelect, setShowProductSelect] = useState(false);
  const [showCart, setShowCart] = useState(false);
  const [orderNote, setOrderNote] = useState('');
  const [confirmModalVisible, setConfirmModalVisible] = useState(false);
  
  const {
    donHangHienTai,
    gioHang,
    tongTien,
    getDonHangTheoBan,
    taoOrder,
    capNhatOrder,
    hoanThanhOrder
  } = useGoiMon();

  const {
    thongTinBan,
    getThongTinBan,
    chuyenTrangThaiBan
  } = useBanHang();

  useEffect(() => {
    if (banId) {
      getThongTinBan(banId);
      getDonHangTheoBan(banId);
    }
  }, [banId]);

  const handleStartOrder = async () => {
    try {
      // Chuyển trạng thái bàn sang "có khách"
      await chuyenTrangThaiBan(banId, 'co_khach');
      setShowProductSelect(true);
    } catch (error) {
      message.error('Không thể bắt đầu gọi món!');
    }
  };

  const handleConfirmOrder = async (cartItems, totalAmount) => {
    try {
      const orderData = {
        banId,
        danhSachMon: cartItems,
        tongTien: totalAmount,
        ghiChu: orderNote,
        trangThai: 'dang_phuc_vu'
      };

      if (donHangHienTai) {
        await capNhatOrder(donHangHienTai.id, orderData);
        message.success('Cập nhật đơn hàng thành công!');
      } else {
        await taoOrder(orderData);
        message.success('Tạo đơn hàng thành công!');
      }

      // Chuyển trạng thái bàn
      await chuyenTrangThaiBan(banId, 'dang_phuc_vu');
      
      // Refresh data
      getDonHangTheoBan(banId);
      getThongTinBan(banId);
      
    } catch (error) {
      message.error('Không thể xác nhận đơn hàng!');
    }
  };

  const handleFinishOrder = async () => {
    Modal.confirm({
      title: 'Hoàn thành phục vụ',
      content: 'Xác nhận đã phục vụ xong tất cả món cho bàn này?',
      okText: 'Hoàn thành',
      cancelText: 'Hủy',
      onOk: async () => {
        try {
          await hoanThanhOrder(donHangHienTai.id);
          await chuyenTrangThaiBan(banId, 'cho_thanh_toan');
          
          message.success('Đã hoàn thành phục vụ!');
          
          // Refresh data
          getDonHangTheoBan(banId);
          getThongTinBan(banId);
          
        } catch (error) {
          message.error('Không thể hoàn thành đơn hàng!');
        }
      }
    });
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const formatTime = (timeString) => {
    if (!timeString) return '';
    return new Date(timeString).toLocaleTimeString('vi-VN');
  };

  const getTrangThaiColor = (trangThai) => {
    const colors = {
      'co_khach': 'processing',
      'dang_phuc_vu': 'warning',
      'cho_thanh_toan': 'success',
      'hoan_thanh': 'default'
    };
    return colors[trangThai] || 'default';
  };

  const getTrangThaiText = (trangThai) => {
    const texts = {
      'co_khach': 'Có khách',
      'dang_phuc_vu': 'Đang phục vụ',
      'cho_thanh_toan': 'Chờ thanh toán',
      'hoan_thanh': 'Hoàn thành'
    };
    return texts[trangThai] || trangThai;
  };

  return (
    <div className="trang-goi-mon">
      {/* Header */}
      <Card className="order-header">
        <Row justify="space-between" align="middle">
          <Col>
            <Space direction="vertical" size="small">
              <Title level={3} style={{ margin: 0 }}>
                {thongTinBan?.tenBan}
              </Title>
              <Space>
                <Tag color={getTrangThaiColor(thongTinBan?.trangThai)}>
                  {getTrangThaiText(thongTinBan?.trangThai)}
                </Tag>
                <Text type="secondary">
                  <UserOutlined /> {thongTinBan?.sucChua} chỗ ngồi
                </Text>
                {donHangHienTai && (
                  <Text type="secondary">
                    <ClockCircleOutlined /> Bắt đầu: {formatTime(donHangHienTai.thoiGianTao)}
                  </Text>
                )}
              </Space>
            </Space>
          </Col>
          <Col>
            <Space>
              <Button onClick={onBack}>
                Quay lại
              </Button>
              {donHangHienTai && (
                <Button 
                  icon={<PrinterOutlined />}
                  onClick={() => {
                    // TODO: Print order
                    console.log('Print order:', donHangHienTai.id);
                  }}
                >
                  In hóa đơn
                </Button>
              )}
            </Space>
          </Col>
        </Row>
      </Card>

      <Row gutter={16}>
        {/* Order content */}
        <Col span={16}>
          {donHangHienTai ? (
            <Card 
              title="Chi tiết đơn hàng"
              extra={
                <Space>
                  <Button 
                    type="primary" 
                    icon={<PlusOutlined />}
                    onClick={() => setShowProductSelect(true)}
                    disabled={donHangHienTai.trangThai === 'hoan_thanh'}
                  >
                    Thêm món
                  </Button>
                  {donHangHienTai.trangThai === 'dang_phuc_vu' && (
                    <Button 
                      type="primary" 
                      icon={<CheckOutlined />}
                      onClick={handleFinishOrder}
                    >
                      Hoàn thành phục vụ
                    </Button>
                  )}
                </Space>
              }
            >
              <List
                dataSource={donHangHienTai.danhSachMon}
                renderItem={(item, index) => (
                  <List.Item
                    key={index}
                    actions={[
                      <Text>{formatPrice(item.giaBan * item.soLuong)} VNĐ</Text>
                    ]}
                  >
                    <List.Item.Meta
                      avatar={
                        <Avatar 
                          size={60} 
                          src={item.hinhAnh || '/images/no-image.png'}
                          shape="square"
                        />
                      }
                      title={
                        <Space>
                          <Text strong>{item.tenSanPham}</Text>
                          <Tag>{item.soLuong}x</Tag>
                        </Space>
                      }
                      description={
                        <Space direction="vertical" size="small">
                          <Text type="secondary">
                            {formatPrice(item.giaBan)} VNĐ
                          </Text>
                          {item.ghiChu && (
                            <Text type="secondary">
                              <CommentOutlined /> {item.ghiChu}
                            </Text>
                          )}
                        </Space>
                      }
                    />
                  </List.Item>
                )}
              />

              {donHangHienTai.ghiChu && (
                <>
                  <Divider />
                  <div>
                    <Text strong>Ghi chú đơn hàng:</Text>
                    <br />
                    <Text>{donHangHienTai.ghiChu}</Text>
                  </div>
                </>
              )}
            </Card>
          ) : (
            <Card>
              <div style={{ textAlign: 'center', padding: '60px 0' }}>
                <UserOutlined style={{ fontSize: 48, color: '#d9d9d9' }} />
                <p style={{ marginTop: 16, marginBottom: 24 }}>
                  Bàn này chưa có khách
                </p>
                <Button 
                  type="primary" 
                  size="large"
                  icon={<PlusOutlined />}
                  onClick={handleStartOrder}
                >
                  Bắt đầu gọi món
                </Button>
              </div>
            </Card>
          )}
        </Col>

        {/* Order summary */}
        <Col span={8}>
          <Card title="Tổng kết">
            <Space direction="vertical" style={{ width: '100%' }}>
              <Row justify="space-between">
                <Text>Số món:</Text>
                <Text strong>
                  {donHangHienTai?.danhSachMon?.reduce((total, item) => total + item.soLuong, 0) || 0}
                </Text>
              </Row>
              
              <Row justify="space-between">
                <Text>Tạm tính:</Text>
                <Text>{formatPrice(donHangHienTai?.tongTien || 0)} VNĐ</Text>
              </Row>
              
              <Row justify="space-between">
                <Text>Thuế VAT:</Text>
                <Text>{formatPrice((donHangHienTai?.tongTien || 0) * 0.1)} VNĐ</Text>
              </Row>
              
              <Divider style={{ margin: '8px 0' }} />
              
              <Row justify="space-between">
                <Text strong style={{ fontSize: 16 }}>Tổng cộng:</Text>
                <Text strong style={{ fontSize: 16, color: '#f5222d' }}>
                  {formatPrice((donHangHienTai?.tongTien || 0) * 1.1)} VNĐ
                </Text>
              </Row>

              {donHangHienTai && (
                <>
                  <Divider />
                  <TextArea
                    rows={3}
                    placeholder="Ghi chú đơn hàng..."
                    value={orderNote}
                    onChange={(e) => setOrderNote(e.target.value)}
                    maxLength={200}
                    showCount
                  />
                  <Button 
                    block 
                    onClick={() => setShowCart(true)}
                    disabled={!gioHang.length}
                  >
                    Xem giỏ hàng
                  </Button>
                </>
              )}
            </Space>
          </Card>

          {donHangHienTai && (
            <Card title="Thông tin đơn hàng" style={{ marginTop: 16 }}>
              <Space direction="vertical" style={{ width: '100%' }}>
                <Row justify="space-between">
                  <Text>Mã đơn:</Text>
                  <Text strong>#{donHangHienTai.id}</Text>
                </Row>
                
                <Row justify="space-between">
                  <Text>Nhân viên:</Text>
                  <Text>{donHangHienTai.nhanVien || 'N/A'}</Text>
                </Row>
                
                <Row justify="space-between">
                  <Text>Thời gian tạo:</Text>
                  <Text>{formatTime(donHangHienTai.thoiGianTao)}</Text>
                </Row>
                
                {donHangHienTai.thoiGianHoanThanh && (
                  <Row justify="space-between">
                    <Text>Hoàn thành:</Text>
                    <Text>{formatTime(donHangHienTai.thoiGianHoanThanh)}</Text>
                  </Row>
                )}
              </Space>
            </Card>
          )}
        </Col>
      </Row>

      {/* Modals */}
      {showProductSelect && (
        <Modal
          title="Chọn sản phẩm"
          open={showProductSelect}
          onCancel={() => setShowProductSelect(false)}
          width="90%"
          footer={null}
          destroyOnClose
        >
          <ChonSanPham 
            banId={banId}
            onProductSelect={() => {
              // Product added to cart
            }}
          />
        </Modal>
      )}

      <GioHang
        banId={banId}
        visible={showCart}
        onClose={() => setShowCart(false)}
        onCheckout={handleConfirmOrder}
      />
    </div>
  );
};

export default TrangGoiMon;
