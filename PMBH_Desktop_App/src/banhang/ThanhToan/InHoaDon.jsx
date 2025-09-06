import React, { useState, useEffect } from 'react';
import { 
  Modal, Card, Typography, Space, Row, Col, Button, 
  Divider, Table, Tag, message, Input
} from 'antd';
import {
  PrinterOutlined, CopyOutlined, MailOutlined,
  PhoneOutlined, EnvironmentOutlined, CalendarOutlined
} from '@ant-design/icons';
import { useThanhToan } from '../../hooks/useThanhToan';

const { Title, Text } = Typography;

const InHoaDon = ({ visible, onClose, donHangId, thongTinThanhToan }) => {
  const [customerEmail, setCustomerEmail] = useState('');
  const [customerPhone, setCustomerPhone] = useState('');
  
  const {
    thongTinCuaHang,
    getThongTinCuaHang,
    inHoaDon,
    guiHoaDonEmail,
    guiHoaDonSMS
  } = useThanhToan();

  useEffect(() => {
    if (visible) {
      getThongTinCuaHang();
    }
  }, [visible]);

  const handlePrint = async () => {
    try {
      await inHoaDon(donHangId);
      message.success('Đã gửi lệnh in hóa đơn!');
    } catch (error) {
      message.error('Không thể in hóa đơn!');
    }
  };

  const handleSendEmail = async () => {
    if (!customerEmail) {
      message.error('Vui lòng nhập email khách hàng!');
      return;
    }
    
    try {
      await guiHoaDonEmail(donHangId, customerEmail);
      message.success('Đã gửi hóa đơn qua email!');
    } catch (error) {
      message.error('Không thể gửi email!');
    }
  };

  const handleSendSMS = async () => {
    if (!customerPhone) {
      message.error('Vui lòng nhập số điện thoại khách hàng!');
      return;
    }
    
    try {
      await guiHoaDonSMS(donHangId, customerPhone);
      message.success('Đã gửi hóa đơn qua SMS!');
    } catch (error) {
      message.error('Không thể gửi SMS!');
    }
  };

  const handleCopyInfo = () => {
    const receiptText = generateReceiptText();
    navigator.clipboard.writeText(receiptText);
    message.success('Đã sao chép thông tin hóa đơn!');
  };

  const generateReceiptText = () => {
    const items = thongTinThanhToan?.danhSachMon || [];
    const itemsList = items.map(item => 
      `${item.tenSanPham} x${item.soLuong} - ${(item.giaBan * item.soLuong).toLocaleString()} VNĐ`
    ).join('\n');
    
    return `
${thongTinCuaHang?.tenCuaHang || 'CAFE'}
${thongTinCuaHang?.diaChi || ''}
ĐT: ${thongTinCuaHang?.soDienThoai || ''}

HÓA ĐƠN THANH TOÁN
Mã đơn: #${donHangId}
Ngày: ${new Date().toLocaleString('vi-VN')}
Bàn: ${thongTinThanhToan?.tenBan || ''}
Nhân viên: ${thongTinThanhToan?.nhanVien || ''}

CHI TIẾT:
${itemsList}

Tạm tính: ${thongTinThanhToan?.tongTienGoc?.toLocaleString()} VNĐ
Giảm giá: ${thongTinThanhToan?.giamGia?.toLocaleString()} VNĐ
Thuế VAT (10%): ${((thongTinThanhToan?.tongTienGoc || 0) * 0.1)?.toLocaleString()} VNĐ
TỔNG CỘNG: ${thongTinThanhToan?.tongTienSauGiam?.toLocaleString()} VNĐ

Khách đưa: ${thongTinThanhToan?.tienKhachDua?.toLocaleString()} VNĐ
Tiền thừa: ${thongTinThanhToan?.tienThua?.toLocaleString()} VNĐ

Cảm ơn quý khách!
    `.trim();
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const formatDateTime = (dateTime) => {
    return new Date(dateTime).toLocaleString('vi-VN');
  };

  const columns = [
    {
      title: 'Sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham'
    },
    {
      title: 'SL',
      dataIndex: 'soLuong',
      key: 'soLuong',
      align: 'center',
      width: 60
    },
    {
      title: 'Đơn giá',
      dataIndex: 'giaBan',
      key: 'giaBan',
      render: (price) => `${formatPrice(price)}`,
      align: 'right'
    },
    {
      title: 'Thành tiền',
      key: 'thanhTien',
      render: (_, record) => formatPrice(record.giaBan * record.soLuong),
      align: 'right'
    }
  ];

  return (
    <Modal
      title="Hóa đơn thanh toán"
      open={visible}
      onCancel={onClose}
      width={600}
      footer={[
        <Space key="actions">
          <Button onClick={onClose}>
            Đóng
          </Button>
          <Button 
            icon={<CopyOutlined />}
            onClick={handleCopyInfo}
          >
            Sao chép
          </Button>
          <Button 
            type="primary"
            icon={<PrinterOutlined />}
            onClick={handlePrint}
          >
            In hóa đơn
          </Button>
        </Space>
      ]}
    >
      <div className="receipt-content">
        {/* Header thông tin cửa hàng */}
        <div style={{ textAlign: 'center', marginBottom: 24 }}>
          <Title level={3} style={{ margin: 0 }}>
            {thongTinCuaHang?.tenCuaHang || 'CAFE'}
          </Title>
          <Text type="secondary">
            <EnvironmentOutlined /> {thongTinCuaHang?.diaChi}
          </Text>
          <br />
          <Text type="secondary">
            <PhoneOutlined /> {thongTinCuaHang?.soDienThoai}
          </Text>
        </div>

        <Divider />

        {/* Thông tin đơn hàng */}
        <Row gutter={16} style={{ marginBottom: 16 }}>
          <Col span={12}>
            <Space direction="vertical" size="small">
              <Text><strong>Mã đơn:</strong> #{donHangId}</Text>
              <Text><strong>Bàn:</strong> {thongTinThanhToan?.tenBan}</Text>
              <Text><strong>Nhân viên:</strong> {thongTinThanhToan?.nhanVien}</Text>
            </Space>
          </Col>
          <Col span={12}>
            <Space direction="vertical" size="small">
              <Text>
                <CalendarOutlined /> {formatDateTime(thongTinThanhToan?.thoiGianThanhToan)}
              </Text>
              <Text>
                <strong>Phương thức:</strong> {
                  thongTinThanhToan?.phuongThucThanhToan === 'tien_mat' ? 'Tiền mặt' :
                  thongTinThanhToan?.phuongThucThanhToan === 'chuyen_khoan' ? 'Chuyển khoản' :
                  'QR Code'
                }
              </Text>
            </Space>
          </Col>
        </Row>

        <Divider />

        {/* Chi tiết sản phẩm */}
        <Table
          columns={columns}
          dataSource={thongTinThanhToan?.danhSachMon}
          rowKey="sanPhamId"
          pagination={false}
          size="small"
          bordered
        />

        <Divider />

        {/* Tổng kết */}
        <div style={{ marginTop: 16 }}>
          <Row justify="space-between" style={{ marginBottom: 8 }}>
            <Text>Tạm tính:</Text>
            <Text>{formatPrice(thongTinThanhToan?.tongTienGoc)} VNĐ</Text>
          </Row>
          
          {thongTinThanhToan?.giamGia > 0 && (
            <Row justify="space-between" style={{ marginBottom: 8 }}>
              <Text>Giảm giá:</Text>
              <Text style={{ color: '#52c41a' }}>
                -{formatPrice(thongTinThanhToan?.giamGia)} VNĐ
              </Text>
            </Row>
          )}
          
          <Row justify="space-between" style={{ marginBottom: 8 }}>
            <Text>Thuế VAT (10%):</Text>
            <Text>{formatPrice((thongTinThanhToan?.tongTienGoc || 0) * 0.1)} VNĐ</Text>
          </Row>
          
          <Divider style={{ margin: '8px 0' }} />
          
          <Row justify="space-between" style={{ marginBottom: 16 }}>
            <Text strong style={{ fontSize: 16 }}>TỔNG CỘNG:</Text>
            <Text strong style={{ fontSize: 16, color: '#f5222d' }}>
              {formatPrice(thongTinThanhToan?.tongTienSauGiam)} VNĐ
            </Text>
          </Row>

          {thongTinThanhToan?.phuongThucThanhToan === 'tien_mat' && (
            <>
              <Row justify="space-between" style={{ marginBottom: 8 }}>
                <Text>Khách đưa:</Text>
                <Text>{formatPrice(thongTinThanhToan?.tienKhachDua)} VNĐ</Text>
              </Row>
              
              <Row justify="space-between" style={{ marginBottom: 16 }}>
                <Text>Tiền thừa:</Text>
                <Text>{formatPrice(thongTinThanhToan?.tienThua)} VNĐ</Text>
              </Row>
            </>
          )}
        </div>

        {thongTinThanhToan?.ghiChu && (
          <>
            <Divider />
            <div>
              <Text><strong>Ghi chú:</strong> {thongTinThanhToan.ghiChu}</Text>
            </div>
          </>
        )}

        <Divider />

        {/* Gửi hóa đơn */}
        <Card size="small" title="Gửi hóa đơn cho khách hàng">
          <Space direction="vertical" style={{ width: '100%' }}>
            <Row gutter={8}>
              <Col span={16}>
                <Input
                  placeholder="Email khách hàng"
                  value={customerEmail}
                  onChange={(e) => setCustomerEmail(e.target.value)}
                  prefix={<MailOutlined />}
                />
              </Col>
              <Col span={8}>
                <Button 
                  block 
                  onClick={handleSendEmail}
                  disabled={!customerEmail}
                >
                  Gửi Email
                </Button>
              </Col>
            </Row>
            
            <Row gutter={8}>
              <Col span={16}>
                <Input
                  placeholder="Số điện thoại khách hàng"
                  value={customerPhone}
                  onChange={(e) => setCustomerPhone(e.target.value)}
                  prefix={<PhoneOutlined />}
                />
              </Col>
              <Col span={8}>
                <Button 
                  block 
                  onClick={handleSendSMS}
                  disabled={!customerPhone}
                >
                  Gửi SMS
                </Button>
              </Col>
            </Row>
          </Space>
        </Card>

        <div style={{ textAlign: 'center', marginTop: 24, color: '#999' }}>
          <Text>Cảm ơn quý khách và hẹn gặp lại!</Text>
        </div>
      </div>
    </Modal>
  );
};

export default InHoaDon;
