import React, { useState, useEffect } from 'react';
import { 
  Modal, Card, Typography, Space, Row, Col, Button, 
  Divider, Table, Tag, Timeline, Descriptions, Image,
  message, Tooltip
} from 'antd';
import {
  PrinterOutlined, MailOutlined, CopyOutlined,
  ClockCircleOutlined, UserOutlined, PhoneOutlined,
  EnvironmentOutlined, CommentOutlined, EditOutlined
} from '@ant-design/icons';
import { useHoaDon } from '../../hooks/useHoaDon';

const { Title, Text } = Typography;

const ChiTietHoaDon = ({ visible, onClose, hoaDon }) => {
  const [timeline, setTimeline] = useState([]);
  
  const {
    chiTietHoaDon,
    lichSuHoaDon,
    getChiTietHoaDon,
    getLichSuHoaDon,
    inLaiHoaDon,
    guiHoaDonEmail,
    capNhatGhiChu
  } = useHoaDon();

  useEffect(() => {
    if (visible && hoaDon?.id) {
      getChiTietHoaDon(hoaDon.id);
      getLichSuHoaDon(hoaDon.id);
    }
  }, [visible, hoaDon]);

  useEffect(() => {
    if (lichSuHoaDon) {
      const timelineItems = lichSuHoaDon.map(item => ({
        color: getTimelineColor(item.hanhDong),
        children: (
          <div>
            <Text strong>{getHanhDongText(item.hanhDong)}</Text>
            <br />
            <Text type="secondary">
              {new Date(item.thoiGian).toLocaleString('vi-VN')} • {item.nguoiThucHien}
            </Text>
            {item.ghiChu && (
              <>
                <br />
                <Text>{item.ghiChu}</Text>
              </>
            )}
          </div>
        )
      }));
      setTimeline(timelineItems);
    }
  }, [lichSuHoaDon]);

  const getTimelineColor = (hanhDong) => {
    const colors = {
      'tao_don': 'blue',
      'thanh_toan': 'green',
      'in_hoa_don': 'purple',
      'gui_email': 'orange',
      'huy_don': 'red',
      'cap_nhat': 'yellow'
    };
    return colors[hanhDong] || 'blue';
  };

  const getHanhDongText = (hanhDong) => {
    const texts = {
      'tao_don': 'Tạo đơn hàng',
      'thanh_toan': 'Thanh toán',
      'in_hoa_don': 'In hóa đơn',
      'gui_email': 'Gửi email',
      'huy_don': 'Hủy đơn',
      'cap_nhat': 'Cập nhật thông tin'
    };
    return texts[hanhDong] || hanhDong;
  };

  const handlePrint = async () => {
    try {
      await inLaiHoaDon(hoaDon.id);
      message.success('Đã gửi lệnh in hóa đơn!');
    } catch (error) {
      message.error('Không thể in hóa đơn!');
    }
  };

  const handleSendEmail = async () => {
    try {
      await guiHoaDonEmail(hoaDon.id, chiTietHoaDon?.khachHang?.email);
      message.success('Đã gửi hóa đơn qua email!');
    } catch (error) {
      message.error('Không thể gửi email!');
    }
  };

  const handleCopyInfo = () => {
    const receiptText = generateReceiptText();
    navigator.clipboard.writeText(receiptText);
    message.success('Đã sao chép thông tin hóa đơn!');
  };

  const generateReceiptText = () => {
    const items = chiTietHoaDon?.danhSachMon || [];
    const itemsList = items.map(item => 
      `${item.tenSanPham} x${item.soLuong} - ${(item.giaBan * item.soLuong).toLocaleString()} VNĐ`
    ).join('\n');
    
    return `
HÓA ĐƠN THANH TOÁN
Mã đơn: #${hoaDon?.id}
Ngày: ${new Date(hoaDon?.thoiGianThanhToan).toLocaleString('vi-VN')}
Bàn: ${hoaDon?.tenBan}
Nhân viên: ${hoaDon?.nhanVien}

CHI TIẾT:
${itemsList}

Tạm tính: ${chiTietHoaDon?.tongTienGoc?.toLocaleString()} VNĐ
Giảm giá: ${chiTietHoaDon?.giamGia?.toLocaleString()} VNĐ
Thuế VAT: ${chiTietHoaDon?.thue?.toLocaleString()} VNĐ
TỔNG CỘNG: ${chiTietHoaDon?.tongTien?.toLocaleString()} VNĐ

Phương thức: ${getPhuongThucText(hoaDon?.phuongThucThanhToan)}
Cảm ơn quý khách!
    `.trim();
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const formatDateTime = (dateTime) => {
    return new Date(dateTime).toLocaleString('vi-VN');
  };

  const getTrangThaiColor = (trangThai) => {
    const colors = {
      'hoan_thanh': 'success',
      'huy': 'error',
      'cho_thanh_toan': 'warning',
      'da_thanh_toan': 'processing'
    };
    return colors[trangThai] || 'default';
  };

  const getTrangThaiText = (trangThai) => {
    const texts = {
      'hoan_thanh': 'Hoàn thành',
      'huy': 'Đã hủy',
      'cho_thanh_toan': 'Chờ thanh toán',
      'da_thanh_toan': 'Đã thanh toán'
    };
    return texts[trangThai] || trangThai;
  };

  const getPhuongThucText = (phuongThuc) => {
    const texts = {
      'tien_mat': 'Tiền mặt',
      'chuyen_khoan': 'Chuyển khoản',
      'qr_code': 'QR Code'
    };
    return texts[phuongThuc] || phuongThuc;
  };

  const columns = [
    {
      title: 'Hình ảnh',
      dataIndex: 'hinhAnh',
      key: 'hinhAnh',
      render: (hinhAnh, record) => (
        <Image
          src={hinhAnh || '/images/no-image.png'}
          alt={record.tenSanPham}
          width={50}
          height={50}
          preview={false}
          style={{ borderRadius: 4 }}
        />
      ),
      width: 80
    },
    {
      title: 'Sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
      render: (text, record) => (
        <Space direction="vertical" size="small">
          <Text strong>{text}</Text>
          {record.ghiChu && (
            <Text type="secondary" style={{ fontSize: 12 }}>
              <CommentOutlined /> {record.ghiChu}
            </Text>
          )}
        </Space>
      )
    },
    {
      title: 'Đơn giá',
      dataIndex: 'giaBan',
      key: 'giaBan',
      render: (price) => `${formatPrice(price)} VNĐ`,
      align: 'right'
    },
    {
      title: 'SL',
      dataIndex: 'soLuong',
      key: 'soLuong',
      align: 'center',
      width: 60
    },
    {
      title: 'Thành tiền',
      key: 'thanhTien',
      render: (_, record) => (
        <Text strong>
          {formatPrice(record.giaBan * record.soLuong)} VNĐ
        </Text>
      ),
      align: 'right'
    }
  ];

  return (
    <Modal
      title={
        <Space>
          Chi tiết hóa đơn #{hoaDon?.id}
          <Tag color={getTrangThaiColor(hoaDon?.trangThai)}>
            {getTrangThaiText(hoaDon?.trangThai)}
          </Tag>
        </Space>
      }
      open={visible}
      onCancel={onClose}
      width={1000}
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
          {chiTietHoaDon?.khachHang?.email && (
            <Button 
              icon={<MailOutlined />}
              onClick={handleSendEmail}
            >
              Gửi Email
            </Button>
          )}
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
      <Row gutter={16}>
        {/* Thông tin cơ bản */}
        <Col span={16}>
          <Card title="Thông tin hóa đơn" className="detail-card">
            <Descriptions bordered size="small" column={2}>
              <Descriptions.Item label="Mã hóa đơn">
                #{hoaDon?.id}
              </Descriptions.Item>
              <Descriptions.Item label="Bàn">
                <Tag color="blue">{hoaDon?.tenBan}</Tag>
              </Descriptions.Item>
              <Descriptions.Item label="Thời gian thanh toán">
                <ClockCircleOutlined /> {formatDateTime(hoaDon?.thoiGianThanhToan)}
              </Descriptions.Item>
              <Descriptions.Item label="Nhân viên">
                <UserOutlined /> {hoaDon?.nhanVien}
              </Descriptions.Item>
              <Descriptions.Item label="Phương thức thanh toán">
                <Tag>{getPhuongThucText(hoaDon?.phuongThucThanhToan)}</Tag>
              </Descriptions.Item>
              <Descriptions.Item label="Trạng thái">
                <Tag color={getTrangThaiColor(hoaDon?.trangThai)}>
                  {getTrangThaiText(hoaDon?.trangThai)}
                </Tag>
              </Descriptions.Item>
            </Descriptions>

            {/* Thông tin khách hàng */}
            {chiTietHoaDon?.khachHang && (
              <>
                <Divider orientation="left">Thông tin khách hàng</Divider>
                <Descriptions bordered size="small" column={2}>
                  <Descriptions.Item label="Họ tên">
                    <UserOutlined /> {chiTietHoaDon.khachHang.hoTen}
                  </Descriptions.Item>
                  <Descriptions.Item label="Số điện thoại">
                    <PhoneOutlined /> {chiTietHoaDon.khachHang.soDienThoai}
                  </Descriptions.Item>
                  <Descriptions.Item label="Email" span={2}>
                    <MailOutlined /> {chiTietHoaDon.khachHang.email}
                  </Descriptions.Item>
                  <Descriptions.Item label="Địa chỉ" span={2}>
                    <EnvironmentOutlined /> {chiTietHoaDon.khachHang.diaChi}
                  </Descriptions.Item>
                </Descriptions>
              </>
            )}

            {/* Chi tiết sản phẩm */}
            <Divider orientation="left">Chi tiết sản phẩm</Divider>
            <Table
              columns={columns}
              dataSource={chiTietHoaDon?.danhSachMon}
              rowKey="sanPhamId"
              pagination={false}
              size="small"
              summary={() => (
                <Table.Summary.Row>
                  <Table.Summary.Cell colSpan={4}>
                    <Text strong>Tổng cộng</Text>
                  </Table.Summary.Cell>
                  <Table.Summary.Cell align="right">
                    <Text strong style={{ color: '#f5222d' }}>
                      {formatPrice(chiTietHoaDon?.tongTienGoc)} VNĐ
                    </Text>
                  </Table.Summary.Cell>
                </Table.Summary.Row>
              )}
            />

            {/* Tổng kết thanh toán */}
            <Card size="small" style={{ marginTop: 16, backgroundColor: '#fafafa' }}>
              <Row justify="space-between" style={{ marginBottom: 8 }}>
                <Text>Tạm tính:</Text>
                <Text>{formatPrice(chiTietHoaDon?.tongTienGoc)} VNĐ</Text>
              </Row>
              
              {chiTietHoaDon?.giamGia > 0 && (
                <Row justify="space-between" style={{ marginBottom: 8 }}>
                  <Text>Giảm giá:</Text>
                  <Text style={{ color: '#52c41a' }}>
                    -{formatPrice(chiTietHoaDon?.giamGia)} VNĐ
                  </Text>
                </Row>
              )}
              
              <Row justify="space-between" style={{ marginBottom: 8 }}>
                <Text>Thuế VAT:</Text>
                <Text>{formatPrice(chiTietHoaDon?.thue)} VNĐ</Text>
              </Row>
              
              <Divider style={{ margin: '8px 0' }} />
              
              <Row justify="space-between" style={{ marginBottom: 8 }}>
                <Text strong style={{ fontSize: 16 }}>Tổng thanh toán:</Text>
                <Text strong style={{ fontSize: 16, color: '#f5222d' }}>
                  {formatPrice(chiTietHoaDon?.tongTien)} VNĐ
                </Text>
              </Row>

              {hoaDon?.phuongThucThanhToan === 'tien_mat' && (
                <>
                  <Row justify="space-between" style={{ marginBottom: 8 }}>
                    <Text>Khách đưa:</Text>
                    <Text>{formatPrice(chiTietHoaDon?.tienKhachDua)} VNĐ</Text>
                  </Row>
                  
                  <Row justify="space-between">
                    <Text>Tiền thừa:</Text>
                    <Text>{formatPrice(chiTietHoaDon?.tienThua)} VNĐ</Text>
                  </Row>
                </>
              )}
            </Card>

            {/* Ghi chú */}
            {chiTietHoaDon?.ghiChu && (
              <>
                <Divider orientation="left">Ghi chú</Divider>
                <Card size="small">
                  <Text>{chiTietHoaDon.ghiChu}</Text>
                  <Tooltip title="Sửa ghi chú">
                    <Button 
                      type="text" 
                      size="small" 
                      icon={<EditOutlined />}
                      style={{ marginLeft: 8 }}
                      onClick={() => {
                        // TODO: Open edit note modal
                        console.log('Edit note');
                      }}
                    />
                  </Tooltip>
                </Card>
              </>
            )}
          </Card>
        </Col>

        {/* Lịch sử và timeline */}
        <Col span={8}>
          <Card title="Lịch sử hoạt động" className="timeline-card">
            <Timeline items={timeline} />
          </Card>

          {/* Thống kê */}
          <Card title="Thống kê" style={{ marginTop: 16 }}>
            <Space direction="vertical" style={{ width: '100%' }}>
              <Row justify="space-between">
                <Text>Tổng số món:</Text>
                <Text strong>
                  {chiTietHoaDon?.danhSachMon?.reduce((total, item) => total + item.soLuong, 0) || 0}
                </Text>
              </Row>
              
              <Row justify="space-between">
                <Text>Số loại món:</Text>
                <Text strong>{chiTietHoaDon?.danhSachMon?.length || 0}</Text>
              </Row>
              
              <Row justify="space-between">
                <Text>Thời gian phục vụ:</Text>
                <Text strong>
                  {chiTietHoaDon?.thoiGianPhucVu || 'N/A'}
                </Text>
              </Row>
              
              <Row justify="space-between">
                <Text>Đánh giá:</Text>
                <Text strong>
                  {chiTietHoaDon?.danhGia ? `${chiTietHoaDon.danhGia}/5 ⭐` : 'Chưa có'}
                </Text>
              </Row>
            </Space>
          </Card>
        </Col>
      </Row>
    </Modal>
  );
};

export default ChiTietHoaDon;
