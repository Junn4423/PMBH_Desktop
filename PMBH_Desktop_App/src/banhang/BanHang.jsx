import React, { useState, useEffect } from 'react';
import { 
  Row, Col, Card, Button, Modal, Form, 
  Select, InputNumber, Space, message, 
  Divider, Typography, Table, Tag
} from 'antd';
import {
  ShoppingCartOutlined,
  DeleteOutlined,
  CheckOutlined,
  PrinterOutlined
} from '@ant-design/icons';

const { Option } = Select;
const { Text, Title } = Typography;

const BanHang = () => {
  const [danhSachSanPham, setDanhSachSanPham] = useState([]);
  const [gioHang, setGioHang] = useState([]);
  const [hienThiModalThanhToan, setHienThiModalThanhToan] = useState(false);
  const [form] = Form.useForm();
  const [tongTien, setTongTien] = useState(0);

  const danhSachBan = [
    { value: '1', label: 'Bàn 1' },
    { value: '2', label: 'Bàn 2' },
    { value: '3', label: 'Bàn 3' },
    { value: '4', label: 'Bàn 4' },
    { value: '5', label: 'Bàn 5' },
    { value: '6', label: 'Bàn 6' }
  ];

  const phuongThucThanhToan = [
    { value: 'tien_mat', label: 'Tiền mặt' },
    { value: 'chuyen_khoan', label: 'Chuyển khoản' },
    { value: 'the_tin_dung', label: 'Thẻ tín dụng' }
  ];

  useEffect(() => {
    taiDanhSachSanPham();
  }, []);

  useEffect(() => {
    tinhTongTien();
  }, [gioHang]);

  const taiDanhSachSanPham = async () => {
    try {
      // Demo data
      setDanhSachSanPham([
        {
          id: '1',
          maSanPham: 'SP001',
          tenSanPham: 'Cà phê đen',
          danhMuc: 'cafe',
          giaBan: 25000,
          tonKho: 100,
          hinhAnh: null
        },
        {
          id: '2',
          maSanPham: 'SP002', 
          tenSanPham: 'Cà phê sữa',
          danhMuc: 'cafe',
          giaBan: 30000,
          tonKho: 85,
          hinhAnh: null
        },
        {
          id: '3',
          maSanPham: 'SP003',
          tenSanPham: 'Trà đá',
          danhMuc: 'tra',
          giaBan: 15000,
          tonKho: 50,
          hinhAnh: null
        },
        {
          id: '4',
          maSanPham: 'SP004',
          tenSanPham: 'Bánh mì',
          danhMuc: 'do_an_nhe',
          giaBan: 20000,
          tonKho: 30,
          hinhAnh: null
        }
      ]);
    } catch (error) {
      console.error('Lỗi tải danh sách sản phẩm:', error);
    }
  };

  const themVaoGioHang = (sanPham) => {
    const sanPhamTonTai = gioHang.find(item => item.id === sanPham.id);
    
    if (sanPhamTonTai) {
      const capNhatGioHang = gioHang.map(item =>
        item.id === sanPham.id 
          ? { ...item, soLuong: item.soLuong + 1 }
          : item
      );
      setGioHang(capNhatGioHang);
    } else {
      setGioHang([...gioHang, { ...sanPham, soLuong: 1 }]);
    }
    message.success(`Đã thêm ${sanPham.tenSanPham} vào giỏ hàng`);
  };

  const capNhatSoLuong = (id, soLuongMoi) => {
    if (soLuongMoi <= 0) {
      xoaKhoiGioHang(id);
      return;
    }
    
    const capNhatGioHang = gioHang.map(item =>
      item.id === id ? { ...item, soLuong: soLuongMoi } : item
    );
    setGioHang(capNhatGioHang);
  };

  const xoaKhoiGioHang = (id) => {
    const gioHangMoi = gioHang.filter(item => item.id !== id);
    setGioHang(gioHangMoi);
  };

  const xoaToanBoGioHang = () => {
    setGioHang([]);
  };

  const tinhTongTien = () => {
    const tong = gioHang.reduce((sum, item) => sum + (item.giaBan * item.soLuong), 0);
    setTongTien(tong);
  };

  const moModalThanhToan = () => {
    if (gioHang.length === 0) {
      message.warning('Giỏ hàng trống, vui lòng chọn sản phẩm');
      return;
    }
    setHienThiModalThanhToan(true);
  };

  const dongModalThanhToan = () => {
    setHienThiModalThanhToan(false);
    form.resetFields();
  };

  const thanhToan = async (values) => {
    try {
      const donHang = {
        sanPham: gioHang,
        tongTien: tongTien,
        ban: values.ban,
        phuongThucThanhToan: values.phuongThucThanhToan,
        tienKhachDua: values.tienKhachDua,
        tienThua: values.tienKhachDua - tongTien,
        thoiGian: new Date()
      };

      // Gọi API lưu đơn hàng
      // await api.post('/don-hang', donHang);

      message.success('Thanh toán thành công!');
      setGioHang([]);
      dongModalThanhToan();
      
      // In hóa đơn
      inHoaDon(donHang);
    } catch (error) {
      console.error('Lỗi thanh toán:', error);
      message.error('Thanh toán thất bại');
    }
  };

  const inHoaDon = (donHang) => {
    // Logic in hóa đơn
    console.log('In hóa đơn:', donHang);
    message.info('Đang in hóa đơn...');
  };

  const cotGioHang = [
    {
      title: 'Sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
    },
    {
      title: 'Đơn giá',
      dataIndex: 'giaBan',
      key: 'giaBan',
      render: (gia) => `${gia.toLocaleString()}đ`
    },
    {
      title: 'Số lượng',
      key: 'soLuong',
      render: (_, record) => (
        <InputNumber
          min={1}
          value={record.soLuong}
          onChange={(value) => capNhatSoLuong(record.id, value)}
          size="small"
          style={{ width: '80px' }}
        />
      )
    },
    {
      title: 'Thành tiền',
      key: 'thanhTien',
      render: (_, record) => `${(record.giaBan * record.soLuong).toLocaleString()}đ`
    },
    {
      title: '',
      key: 'thaoTac',
      render: (_, record) => (
        <Button 
          type="link" 
          danger 
          icon={<DeleteOutlined />}
          onClick={() => xoaKhoiGioHang(record.id)}
          size="small"
        />
      )
    }
  ];

  return (
    <div style={{ padding: '24px' }}>
      <Title level={2}>Bán hàng</Title>
      
      <Row gutter={24}>
        {/* Danh sách sản phẩm */}
        <Col span={16}>
          <Card title="Danh sách sản phẩm" size="small">
            <Row gutter={[16, 16]}>
              {danhSachSanPham.map(sanPham => (
                <Col span={6} key={sanPham.id}>
                  <Card
                    hoverable
                    size="small"
                    cover={
                      <div style={{ 
                        height: '120px', 
                        backgroundColor: '#f5f5f5',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center'
                      }}>
                        <ShoppingCartOutlined style={{ fontSize: '48px', color: '#d9d9d9' }} />
                      </div>
                    }
                    onClick={() => themVaoGioHang(sanPham)}
                  >
                    <Card.Meta
                      title={<Text strong style={{ fontSize: '14px' }}>{sanPham.tenSanPham}</Text>}
                      description={
                        <div>
                          <Text type="success" strong>{sanPham.giaBan.toLocaleString()}đ</Text>
                          <br />
                          <Text type="secondary" style={{ fontSize: '12px' }}>
                            Tồn: {sanPham.tonKho}
                          </Text>
                        </div>
                      }
                    />
                  </Card>
                </Col>
              ))}
            </Row>
          </Card>
        </Col>

        {/* Giỏ hàng */}
        <Col span={8}>
          <Card 
            title="Giỏ hàng" 
            size="small"
            extra={
              <Button 
                type="link" 
                danger 
                onClick={xoaToanBoGioHang}
                disabled={gioHang.length === 0}
              >
                Xóa tất cả
              </Button>
            }
          >
            <Table
              columns={cotGioHang}
              dataSource={gioHang}
              pagination={false}
              size="small"
              rowKey="id"
              locale={{ emptyText: 'Giỏ hàng trống' }}
            />
            
            <Divider />
            
            <div style={{ textAlign: 'right' }}>
              <Title level={4} type="danger">
                Tổng tiền: {tongTien.toLocaleString()}đ
              </Title>
              <Space>
                <Button 
                  type="primary" 
                  size="large"
                  icon={<CheckOutlined />}
                  onClick={moModalThanhToan}
                  disabled={gioHang.length === 0}
                >
                  Thanh toán
                </Button>
              </Space>
            </div>
          </Card>
        </Col>
      </Row>

      {/* Modal thanh toán */}
      <Modal
        title="Thanh toán đơn hàng"
        open={hienThiModalThanhToan}
        onCancel={dongModalThanhToan}
        footer={null}
        width={500}
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={thanhToan}
          initialValues={{
            phuongThucThanhToan: 'tien_mat'
          }}
        >
          <Form.Item
            name="ban"
            label="Chọn bàn"
            rules={[{ required: true, message: 'Vui lòng chọn bàn' }]}
          >
            <Select placeholder="Chọn bàn">
              {danhSachBan.map(ban => (
                <Option key={ban.value} value={ban.value}>
                  {ban.label}
                </Option>
              ))}
            </Select>
          </Form.Item>

          <Form.Item
            name="phuongThucThanhToan"
            label="Phương thức thanh toán"
            rules={[{ required: true, message: 'Vui lòng chọn phương thức thanh toán' }]}
          >
            <Select>
              {phuongThucThanhToan.map(pt => (
                <Option key={pt.value} value={pt.value}>
                  {pt.label}
                </Option>
              ))}
            </Select>
          </Form.Item>

          <Form.Item
            name="tienKhachDua"
            label="Tiền khách đưa"
            rules={[
              { required: true, message: 'Vui lòng nhập tiền khách đưa' },
              ({ getFieldValue }) => ({
                validator(_, value) {
                  if (!value || value >= tongTien) {
                    return Promise.resolve();
                  }
                  return Promise.reject(new Error('Tiền khách đưa phải lớn hơn hoặc bằng tổng tiền'));
                },
              }),
            ]}
          >
            <InputNumber
              style={{ width: '100%' }}
              placeholder="Nhập tiền khách đưa"
              formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
              parser={value => value.replace(/\$\s?|(,*)/g, '')}
            />
          </Form.Item>

          <div style={{ marginBottom: '16px' }}>
            <Text strong>Tổng tiền: </Text>
            <Text type="danger" strong style={{ fontSize: '16px' }}>
              {tongTien.toLocaleString()}đ
            </Text>
          </div>

          <Form.Item>
            <Space>
              <Button type="primary" htmlType="submit" icon={<CheckOutlined />}>
                Xác nhận thanh toán
              </Button>
              <Button onClick={dongModalThanhToan}>
                Hủy
              </Button>
            </Space>
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default BanHang;
