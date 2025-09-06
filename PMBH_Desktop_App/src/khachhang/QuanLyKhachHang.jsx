import React, { useState, useEffect } from 'react';
import { 
  Table, Button, Modal, Form, Input, 
  Space, Popconfirm, message, Row, Col, Card,
  Select, DatePicker, Tag
} from 'antd';
import {
  PlusOutlined,
  EditOutlined,
  DeleteOutlined,
  SearchOutlined,
  UserOutlined,
  PhoneOutlined
} from '@ant-design/icons';

const { Option } = Select;

const QuanLyKhachHang = () => {
  const [danhSachKhachHang, setDanhSachKhachHang] = useState([]);
  const [hienThiModal, setHienThiModal] = useState(false);
  const [chinhSua, setChinhSua] = useState(false);
  const [khachHangHienTai, setKhachHangHienTai] = useState(null);
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);

  const loaiKhachHang = [
    { value: 'thuong', label: 'Thường' },
    { value: 'vip', label: 'VIP' },
    { value: 'thanh_vien', label: 'Thành viên' }
  ];

  useEffect(() => {
    taiDanhSachKhachHang();
  }, []);

  const taiDanhSachKhachHang = async () => {
    setLoading(true);
    try {
      // Demo data
      setDanhSachKhachHang([
        {
          key: '1',
          maKhachHang: 'KH001',
          tenKhachHang: 'Nguyễn Văn A',
          soDienThoai: '0123456789',
          email: 'nguyenvana@email.com',
          diaChi: '123 Nguyễn Huệ, Quận 1, TP.HCM',
          loaiKhachHang: 'vip',
          diemTichLuy: 1250,
          tongChiTieu: 5000000,
          lanMuaCuoi: '2024-01-15',
          ghiChu: 'Khách hàng thân thiết'
        },
        {
          key: '2',
          maKhachHang: 'KH002', 
          tenKhachHang: 'Trần Thị B',
          soDienThoai: '0987654321',
          email: 'tranthib@email.com',
          diaChi: '456 Lê Lợi, Quận 3, TP.HCM',
          loaiKhachHang: 'thanh_vien',
          diemTichLuy: 800,
          tongChiTieu: 2500000,
          lanMuaCuoi: '2024-01-10',
          ghiChu: ''
        }
      ]);
    } catch (error) {
      console.error('Lỗi tải danh sách khách hàng:', error);
      message.error('Không thể tải danh sách khách hàng');
    } finally {
      setLoading(false);
    }
  };

  const moModalThem = () => {
    setChinhSua(false);
    setKhachHangHienTai(null);
    form.resetFields();
    setHienThiModal(true);
  };

  const moModalSua = (khachHang) => {
    setChinhSua(true);
    setKhachHangHienTai(khachHang);
    form.setFieldsValue(khachHang);
    setHienThiModal(true);
  };

  const dongModal = () => {
    setHienThiModal(false);
    form.resetFields();
    setKhachHangHienTai(null);
  };

  const luuKhachHang = async (values) => {
    try {
      if (chinhSua) {
        // Cập nhật khách hàng
        const capNhatDanhSach = danhSachKhachHang.map(kh => 
          kh.key === khachHangHienTai.key ? { ...kh, ...values } : kh
        );
        setDanhSachKhachHang(capNhatDanhSach);
        message.success('Cập nhật khách hàng thành công');
      } else {
        // Thêm khách hàng mới
        const khachHangMoi = {
          key: Date.now().toString(),
          maKhachHang: values.maKhachHang,
          diemTichLuy: 0,
          tongChiTieu: 0,
          lanMuaCuoi: null,
          ...values
        };
        setDanhSachKhachHang([...danhSachKhachHang, khachHangMoi]);
        message.success('Thêm khách hàng thành công');
      }
      dongModal();
    } catch (error) {
      console.error('Lỗi lưu khách hàng:', error);
      message.error('Không thể lưu khách hàng');
    }
  };

  const xoaKhachHang = async (maKhachHang) => {
    try {
      const danhSachMoi = danhSachKhachHang.filter(kh => kh.key !== maKhachHang);
      setDanhSachKhachHang(danhSachMoi);
      message.success('Xóa khách hàng thành công');
    } catch (error) {
      console.error('Lỗi xóa khách hàng:', error);
      message.error('Không thể xóa khách hàng');
    }
  };

  const cotBang = [
    {
      title: 'Mã KH',
      dataIndex: 'maKhachHang',
      key: 'maKhachHang',
      width: 100,
    },
    {
      title: 'Tên khách hàng',
      dataIndex: 'tenKhachHang',
      key: 'tenKhachHang',
      width: 180,
    },
    {
      title: 'SĐT',
      dataIndex: 'soDienThoai',
      key: 'soDienThoai',
      width: 120,
    },
    {
      title: 'Email',
      dataIndex: 'email',
      key: 'email',
      width: 180,
    },
    {
      title: 'Loại KH',
      dataIndex: 'loaiKhachHang',
      key: 'loaiKhachHang',
      width: 100,
      render: (loai) => {
        const timLoai = loaiKhachHang.find(l => l.value === loai);
        const mau = {
          'thuong': 'default',
          'thanh_vien': 'blue',
          'vip': 'gold'
        };
        return (
          <Tag color={mau[loai]}>
            {timLoai ? timLoai.label : loai}
          </Tag>
        );
      }
    },
    {
      title: 'Điểm tích lũy',
      dataIndex: 'diemTichLuy',
      key: 'diemTichLuy',
      width: 100,
      render: (diem) => diem?.toLocaleString() || 0
    },
    {
      title: 'Tổng chi tiêu',
      dataIndex: 'tongChiTieu',
      key: 'tongChiTieu',
      width: 120,
      render: (tong) => `${tong?.toLocaleString() || 0}đ`
    },
    {
      title: 'Lần mua cuối',
      dataIndex: 'lanMuaCuoi',
      key: 'lanMuaCuoi',
      width: 120,
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      width: 120,
      render: (_, record) => (
        <Space size="middle">
          <Button 
            type="link" 
            icon={<EditOutlined />} 
            onClick={() => moModalSua(record)}
            size="small"
          >
            Sửa
          </Button>
          <Popconfirm
            title="Bạn có chắc muốn xóa khách hàng này?"
            onConfirm={() => xoaKhachHang(record.key)}
            okText="Có"
            cancelText="Không"
          >
            <Button 
              type="link" 
              danger 
              icon={<DeleteOutlined />}
              size="small"
            >
              Xóa
            </Button>
          </Popconfirm>
        </Space>
      ),
    },
  ];

  return (
    <div style={{ padding: '24px' }}>
      <Row justify="space-between" align="middle" style={{ marginBottom: '16px' }}>
        <Col>
          <h2>Quản lý khách hàng</h2>
        </Col>
        <Col>
          <Button 
            type="primary" 
            icon={<PlusOutlined />}
            onClick={moModalThem}
          >
            Thêm khách hàng
          </Button>
        </Col>
      </Row>

      {/* Thống kê nhanh */}
      <Row gutter={16} style={{ marginBottom: '24px' }}>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#1890ff' }}>
                {danhSachKhachHang.length}
              </div>
              <div>Tổng khách hàng</div>
            </div>
          </Card>
        </Col>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#52c41a' }}>
                {danhSachKhachHang.filter(kh => kh.loaiKhachHang === 'vip').length}
              </div>
              <div>Khách VIP</div>
            </div>
          </Card>
        </Col>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#faad14' }}>
                {danhSachKhachHang.filter(kh => kh.loaiKhachHang === 'thanh_vien').length}
              </div>
              <div>Thành viên</div>
            </div>
          </Card>
        </Col>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#722ed1' }}>
                {danhSachKhachHang.reduce((tong, kh) => tong + (kh.tongChiTieu || 0), 0).toLocaleString()}đ
              </div>
              <div>Tổng doanh thu</div>
            </div>
          </Card>
        </Col>
      </Row>

      <Card>
        <Table
          columns={cotBang}
          dataSource={danhSachKhachHang}
          loading={loading}
          scroll={{ x: 1200 }}
          pagination={{
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} khách hàng`,
          }}
        />
      </Card>

      {/* Modal thêm/sửa khách hàng */}
      <Modal
        title={chinhSua ? 'Chỉnh sửa khách hàng' : 'Thêm khách hàng mới'}
        open={hienThiModal}
        onCancel={dongModal}
        footer={null}
        width={700}
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={luuKhachHang}
        >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="maKhachHang"
                label="Mã khách hàng"
                rules={[
                  { required: true, message: 'Vui lòng nhập mã khách hàng' }
                ]}
              >
                <Input 
                  prefix={<UserOutlined />}
                  placeholder="Nhập mã khách hàng" 
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="tenKhachHang"
                label="Tên khách hàng"
                rules={[
                  { required: true, message: 'Vui lòng nhập tên khách hàng' }
                ]}
              >
                <Input placeholder="Nhập tên khách hàng" />
              </Form.Item>
            </Col>
          </Row>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="soDienThoai"
                label="Số điện thoại"
                rules={[
                  { required: true, message: 'Vui lòng nhập số điện thoại' },
                  { pattern: /^[0-9]{10,11}$/, message: 'Số điện thoại không hợp lệ' }
                ]}
              >
                <Input 
                  prefix={<PhoneOutlined />}
                  placeholder="Nhập số điện thoại" 
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="email"
                label="Email"
                rules={[
                  { type: 'email', message: 'Email không hợp lệ' }
                ]}
              >
                <Input placeholder="Nhập email" />
              </Form.Item>
            </Col>
          </Row>

          <Form.Item
            name="diaChi"
            label="Địa chỉ"
          >
            <Input.TextArea 
              rows={2} 
              placeholder="Nhập địa chỉ" 
            />
          </Form.Item>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="loaiKhachHang"
                label="Loại khách hàng"
                initialValue="thuong"
              >
                <Select placeholder="Chọn loại khách hàng">
                  {loaiKhachHang.map(loai => (
                    <Option key={loai.value} value={loai.value}>
                      {loai.label}
                    </Option>
                  ))}
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="ghiChu"
                label="Ghi chú"
              >
                <Input placeholder="Nhập ghi chú" />
              </Form.Item>
            </Col>
          </Row>

          <Form.Item>
            <Space>
              <Button type="primary" htmlType="submit">
                {chinhSua ? 'Cập nhật' : 'Thêm mới'}
              </Button>
              <Button onClick={dongModal}>
                Hủy
              </Button>
            </Space>
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default QuanLyKhachHang;
