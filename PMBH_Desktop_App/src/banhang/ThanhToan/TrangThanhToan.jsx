import React, { useState, useEffect } from 'react';
import { 
  Card, Row, Col, Button, Input, Select, Radio, Typography, 
  Space, Divider, Table, message, Modal, Form, InputNumber,
  Tag, Tooltip, Switch
} from 'antd';
import {
  CreditCardOutlined, DollarOutlined, QrcodeOutlined,
  CalculatorOutlined, PrinterOutlined, CheckOutlined,
  GiftOutlined, PercentageOutlined, UserOutlined
} from '@ant-design/icons';
import { useThanhToan } from '../../hooks/useThanhToan';
import { useBanHang } from '../../hooks/useBanHang';

const { Title, Text } = Typography;
const { Option } = Select;

const TrangThanhToan = ({ banId, donHangId, onBack, onComplete }) => {
  const [phuongThucThanhToan, setPhuongThucThanhToan] = useState('tien_mat');
  const [tienKhachDua, setTienKhachDua] = useState(0);
  const [giamGia, setGiamGia] = useState({ loai: 'tien', giaTri: 0 });
  const [khachHangId, setKhachHangId] = useState(null);
  const [ghiChu, setGhiChu] = useState('');
  const [inHoaDon, setInHoaDon] = useState(true);
  const [moNgamCashier, setMoNgamCashier] = useState(false);
  
  const {
    thongTinThanhToan,
    danhSachKhachHang,
    danhSachKhuyenMai,
    getThongTinThanhToan,
    getDanhSachKhachHang,
    getDanhSachKhuyenMai,
    tinhToanThanhToan,
    thucHienThanhToan
  } = useThanhToan();

  const {
    thongTinBan,
    getThongTinBan,
    chuyenTrangThaiBan
  } = useBanHang();

  useEffect(() => {
    if (donHangId) {
      getThongTinThanhToan(donHangId);
      getDanhSachKhachHang();
      getDanhSachKhuyenMai();
    }
    if (banId) {
      getThongTinBan(banId);
    }
  }, [donHangId, banId]);

  useEffect(() => {
    if (thongTinThanhToan) {
      // Tự động set tiền khách đưa bằng tổng tiền nếu thanh toán chuyển khoản
      if (phuongThucThanhToan !== 'tien_mat') {
        setTienKhachDua(thongTinThanhToan.tongTienSauGiam || 0);
      }
    }
  }, [thongTinThanhToan, phuongThucThanhToan]);

  const tinhTienThua = () => {
    const tongTien = thongTinThanhToan?.tongTienSauGiam || 0;
    return Math.max(0, tienKhachDua - tongTien);
  };

  const tinhGiamGia = () => {
    const tongTien = thongTinThanhToan?.tongTienGoc || 0;
    if (giamGia.loai === 'phan_tram') {
      return Math.min(tongTien * giamGia.giaTri / 100, tongTien);
    }
    return Math.min(giamGia.giaTri, tongTien);
  };

  const handleApplyDiscount = () => {
    const discountAmount = tinhGiamGia();
    tinhToanThanhToan(donHangId, {
      giamGia: discountAmount,
      khachHangId,
      phuongThucThanhToan
    });
  };

  const handleThanhToan = async () => {
    const tongTien = thongTinThanhToan?.tongTienSauGiam || 0;
    
    if (phuongThucThanhToan === 'tien_mat' && tienKhachDua < tongTien) {
      message.error('Số tiền khách đưa không đủ!');
      return;
    }

    try {
      const thanhToanData = {
        donHangId,
        banId,
        phuongThucThanhToan,
        tienKhachDua,
        tienThua: tinhTienThua(),
        giamGia: tinhGiamGia(),
        khachHangId,
        ghiChu,
        inHoaDon,
        moNgamCashier
      };

      await thucHienThanhToan(thanhToanData);
      
      // Chuyển trạng thái bàn về trống
      await chuyenTrangThaiBan(banId, 'trong');
      
      message.success('Thanh toán thành công!');
      
      if (inHoaDon) {
        // TODO: Print receipt
        console.log('Print receipt for order:', donHangId);
      }
      
      if (moNgamCashier) {
        // TODO: Open cash drawer
        console.log('Open cash drawer');
      }
      
      onComplete?.();
      
    } catch (error) {
      message.error('Thanh toán thất bại!');
    }
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const columns = [
    {
      title: 'Sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
      render: (text, record) => (
        <Space>
          <Text strong>{text}</Text>
          {record.ghiChu && (
            <Tooltip title={record.ghiChu}>
              <Tag size="small">Ghi chú</Tag>
            </Tooltip>
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
      render: (_, record) => `${formatPrice(record.giaBan * record.soLuong)} VNĐ`,
      align: 'right'
    }
  ];

  return (
    <div className="trang-thanh-toan">
      {/* Header */}
      <Card className="payment-header">
        <Row justify="space-between" align="middle">
          <Col>
            <Space direction="vertical" size="small">
              <Title level={3} style={{ margin: 0 }}>
                Thanh toán - {thongTinBan?.tenBan}
              </Title>
              <Text type="secondary">
                Đơn hàng #{donHangId} • {thongTinThanhToan?.danhSachMon?.length || 0} món
              </Text>
            </Space>
          </Col>
          <Col>
            <Button onClick={onBack}>
              Quay lại
            </Button>
          </Col>
        </Row>
      </Card>

      <Row gutter={16}>
        {/* Chi tiết đơn hàng */}
        <Col span={14}>
          <Card title="Chi tiết đơn hàng">
            <Table
              columns={columns}
              dataSource={thongTinThanhToan?.danhSachMon}
              rowKey="sanPhamId"
              pagination={false}
              size="small"
              summary={() => (
                <Table.Summary.Row>
                  <Table.Summary.Cell colSpan={3}>
                    <Text strong>Tổng cộng</Text>
                  </Table.Summary.Cell>
                  <Table.Summary.Cell align="right">
                    <Text strong style={{ color: '#f5222d' }}>
                      {formatPrice(thongTinThanhToan?.tongTienGoc)} VNĐ
                    </Text>
                  </Table.Summary.Cell>
                </Table.Summary.Row>
              )}
            />
          </Card>

          {/* Khách hàng và khuyến mãi */}
          <Card title="Khách hàng & Khuyến mãi" style={{ marginTop: 16 }}>
            <Row gutter={16}>
              <Col span={12}>
                <Form.Item label="Khách hàng">
                  <Select
                    placeholder="Chọn khách hàng (không bắt buộc)"
                    value={khachHangId}
                    onChange={setKhachHangId}
                    allowClear
                    showSearch
                    optionFilterProp="children"
                  >
                    {danhSachKhachHang?.map(kh => (
                      <Option key={kh.id} value={kh.id}>
                        {kh.hoTen} - {kh.soDienThoai}
                      </Option>
                    ))}
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item label="Mã khuyến mãi">
                  <Select
                    placeholder="Chọn khuyến mãi"
                    allowClear
                    showSearch
                  >
                    {danhSachKhuyenMai?.map(km => (
                      <Option key={km.id} value={km.id}>
                        {km.tenKhuyenMai} (-{km.giaTri}{km.loai === 'phan_tram' ? '%' : ' VNĐ'})
                      </Option>
                    ))}
                  </Select>
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item label="Loại giảm giá">
                  <Radio.Group
                    value={giamGia.loai}
                    onChange={(e) => setGiamGia({ ...giamGia, loai: e.target.value })}
                  >
                    <Radio value="tien">Tiền</Radio>
                    <Radio value="phan_tram">%</Radio>
                  </Radio.Group>
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item label="Giá trị">
                  <InputNumber
                    style={{ width: '100%' }}
                    value={giamGia.giaTri}
                    onChange={(value) => setGiamGia({ ...giamGia, giaTri: value })}
                    min={0}
                    max={giamGia.loai === 'phan_tram' ? 100 : thongTinThanhToan?.tongTienGoc}
                    formatter={value => giamGia.loai === 'phan_tram' ? `${value}%` : `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                    parser={value => value.replace(/%|,/g, '')}
                  />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item label=" ">
                  <Button 
                    icon={<PercentageOutlined />}
                    onClick={handleApplyDiscount}
                    disabled={!giamGia.giaTri}
                  >
                    Áp dụng
                  </Button>
                </Form.Item>
              </Col>
            </Row>
          </Card>
        </Col>

        {/* Thanh toán */}
        <Col span={10}>
          <Card title="Phương thức thanh toán">
            <Radio.Group
              value={phuongThucThanhToan}
              onChange={(e) => setPhuongThucThanhToan(e.target.value)}
              style={{ width: '100%' }}
            >
              <Space direction="vertical" style={{ width: '100%' }}>
                <Radio value="tien_mat">
                  <Space>
                    <DollarOutlined />
                    Tiền mặt
                  </Space>
                </Radio>
                <Radio value="chuyen_khoan">
                  <Space>
                    <CreditCardOutlined />
                    Chuyển khoản
                  </Space>
                </Radio>
                <Radio value="qr_code">
                  <Space>
                    <QrcodeOutlined />
                    Quét mã QR
                  </Space>
                </Radio>
              </Space>
            </Radio.Group>

            <Divider />

            {/* Tính toán tiền */}
            <Space direction="vertical" style={{ width: '100%' }}>
              <Row justify="space-between">
                <Text>Tạm tính:</Text>
                <Text>{formatPrice(thongTinThanhToan?.tongTienGoc)} VNĐ</Text>
              </Row>
              
              {tinhGiamGia() > 0 && (
                <Row justify="space-between">
                  <Text>Giảm giá:</Text>
                  <Text style={{ color: '#52c41a' }}>
                    -{formatPrice(tinhGiamGia())} VNĐ
                  </Text>
                </Row>
              )}
              
              <Row justify="space-between">
                <Text>Thuế VAT (10%):</Text>
                <Text>{formatPrice((thongTinThanhToan?.tongTienGoc || 0) * 0.1)} VNĐ</Text>
              </Row>
              
              <Divider style={{ margin: '8px 0' }} />
              
              <Row justify="space-between">
                <Text strong style={{ fontSize: 18 }}>Tổng tiền:</Text>
                <Text strong style={{ fontSize: 18, color: '#f5222d' }}>
                  {formatPrice(thongTinThanhToan?.tongTienSauGiam)} VNĐ
                </Text>
              </Row>

              <Divider />

              {/* Tiền khách đưa */}
              <Form.Item label="Khách đưa:">
                <InputNumber
                  style={{ width: '100%' }}
                  value={tienKhachDua}
                  onChange={setTienKhachDua}
                  min={0}
                  formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                  parser={value => value.replace(/,/g, '')}
                  addonAfter="VNĐ"
                  size="large"
                />
              </Form.Item>

              {phuongThucThanhToan === 'tien_mat' && (
                <Row justify="space-between">
                  <Text strong>Tiền thừa:</Text>
                  <Text strong style={{ 
                    color: tinhTienThua() >= 0 ? '#52c41a' : '#f5222d',
                    fontSize: 16 
                  }}>
                    {formatPrice(tinhTienThua())} VNĐ
                  </Text>
                </Row>
              )}

              <Divider />

              {/* Ghi chú */}
              <Form.Item label="Ghi chú:">
                <Input.TextArea
                  rows={3}
                  value={ghiChu}
                  onChange={(e) => setGhiChu(e.target.value)}
                  placeholder="Ghi chú thanh toán..."
                  maxLength={200}
                />
              </Form.Item>

              {/* Tùy chọn */}
              <Space direction="vertical" style={{ width: '100%' }}>
                <div>
                  <Switch
                    checked={inHoaDon}
                    onChange={setInHoaDon}
                  />
                  <Text style={{ marginLeft: 8 }}>In hóa đơn</Text>
                </div>
                <div>
                  <Switch
                    checked={moNgamCashier}
                    onChange={setMoNgamCashier}
                  />
                  <Text style={{ marginLeft: 8 }}>Mở ngăm tiền</Text>
                </div>
              </Space>

              {/* Buttons */}
              <Space style={{ width: '100%', marginTop: 16 }}>
                <Button 
                  size="large"
                  icon={<CalculatorOutlined />}
                  onClick={() => {
                    // TODO: Open calculator
                    console.log('Open calculator');
                  }}
                >
                  Máy tính
                </Button>
                <Button 
                  type="primary" 
                  size="large"
                  icon={<CheckOutlined />}
                  onClick={handleThanhToan}
                  disabled={
                    phuongThucThanhToan === 'tien_mat' && 
                    tienKhachDua < (thongTinThanhToan?.tongTienSauGiam || 0)
                  }
                  style={{ flex: 1 }}
                >
                  Thanh toán
                </Button>
              </Space>
            </Space>
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default TrangThanhToan;
