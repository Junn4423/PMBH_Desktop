import React, { useState, useEffect } from 'react';
import { 
  Table, Button, Modal, Form, Input, 
  Space, Popconfirm, message, Row, Col, Card,
  Select, InputNumber, DatePicker, Switch
} from 'antd';
import {
  PlusOutlined,
  EditOutlined,
  DeleteOutlined,
  UserOutlined,
  LockOutlined,
  PhoneOutlined,
  MailOutlined
} from '@ant-design/icons';

const { Option } = Select;

const QuanLyNhanVien = () => {
  const [danhSachNhanVien, setDanhSachNhanVien] = useState([]);
  const [hienThiModal, setHienThiModal] = useState(false);
  const [chinhSua, setChinhSua] = useState(false);
  const [nhanVienHienTai, setNhanVienHienTai] = useState(null);
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);

  const chucVu = [
    { value: 'quan_ly', label: 'Quản lý' },
    { value: 'thu_ngan', label: 'Thu ngân' },
    { value: 'pha_che', label: 'Pha chế' },
    { value: 'phuc_vu', label: 'Phục vụ' },
    { value: 'bep', label: 'Bếp' },
    { value: 've_sinh', label: 'Vệ sinh' }
  ];

  const trangThaiLamViec = [
    { value: 'dang_lam', label: 'Đang làm việc' },
    { value: 'nghi_phep', label: 'Nghỉ phép' },
    { value: 'da_nghi', label: 'Đã nghỉ việc' }
  ];

  const caLamViec = [
    { value: 'sang', label: 'Ca sáng (6:00 - 14:00)' },
    { value: 'chieu', label: 'Ca chiều (14:00 - 22:00)' },
    { value: 'toan_ngay', label: 'Toàn ngày (6:00 - 22:00)' }
  ];

  useEffect(() => {
    taiDanhSachNhanVien();
  }, []);

  const taiDanhSachNhanVien = async () => {
    setLoading(true);
    try {
      // Demo data
      setDanhSachNhanVien([
        {
          key: '1',
          maNhanVien: 'NV001',
          tenNhanVien: 'Nguyễn Văn Admin',
          soDienThoai: '0123456789',
          email: 'admin@cafe.com',
          diaChi: '123 Nguyễn Huệ, Quận 1, TP.HCM',
          chucVu: 'quan_ly',
          luongCoBan: 15000000,
          caLamViec: 'toan_ngay',
          ngayVaoLam: '2024-01-01',
          trangThaiLamViec: 'dang_lam',
          ghiChu: 'Quản lý cửa hàng',
          taiKhoan: 'admin',
          kichHoat: true
        },
        {
          key: '2', 
          maNhanVien: 'NV002',
          tenNhanVien: 'Trần Thị B',
          soDienThoai: '0987654321',
          email: 'thungan@cafe.com',
          diaChi: '456 Lê Lợi, Quận 3, TP.HCM',
          chucVu: 'thu_ngan',
          luongCoBan: 8000000,
          caLamViec: 'sang',
          ngayVaoLam: '2024-01-15',
          trangThaiLamViec: 'dang_lam',
          ghiChu: '',
          taiKhoan: 'thungan01',
          kichHoat: true
        },
        {
          key: '3',
          maNhanVien: 'NV003',
          tenNhanVien: 'Lê Văn C',
          soDienThoai: '0369852147',
          email: 'phache@cafe.com',
          diaChi: '789 Pasteur, Quận 1, TP.HCM',
          chucVu: 'pha_che',
          luongCoBan: 9000000,
          caLamViec: 'chieu',
          ngayVaoLam: '2024-02-01',
          trangThaiLamViec: 'dang_lam',
          ghiChu: 'Chuyên pha chế cà phê',
          taiKhoan: 'phache01',
          kichHoat: true
        }
      ]);
    } catch (error) {
      console.error('Lỗi tải danh sách nhân viên:', error);
      message.error('Không thể tải danh sách nhân viên');
    } finally {
      setLoading(false);
    }
  };

  const moModalThem = () => {
    setChinhSua(false);
    setNhanVienHienTai(null);
    form.resetFields();
    setHienThiModal(true);
  };

  const moModalSua = (nhanVien) => {
    setChinhSua(true);
    setNhanVienHienTai(nhanVien);
    form.setFieldsValue({
      ...nhanVien,
      ngayVaoLam: nhanVien.ngayVaoLam ? moment(nhanVien.ngayVaoLam) : null
    });
    setHienThiModal(true);
  };

  const dongModal = () => {
    setHienThiModal(false);
    form.resetFields();
    setNhanVienHienTai(null);
  };

  const luuNhanVien = async (values) => {
    try {
      const duLieu = {
        ...values,
        ngayVaoLam: values.ngayVaoLam ? values.ngayVaoLam.format('YYYY-MM-DD') : null
      };

      if (chinhSua) {
        // Cập nhật nhân viên
        const capNhatDanhSach = danhSachNhanVien.map(nv => 
          nv.key === nhanVienHienTai.key ? { ...nv, ...duLieu } : nv
        );
        setDanhSachNhanVien(capNhatDanhSach);
        message.success('Cập nhật nhân viên thành công');
      } else {
        // Thêm nhân viên mới
        const nhanVienMoi = {
          key: Date.now().toString(),
          maNhanVien: values.maNhanVien,
          kichHoat: true,
          ...duLieu
        };
        setDanhSachNhanVien([...danhSachNhanVien, nhanVienMoi]);
        message.success('Thêm nhân viên thành công');
      }
      dongModal();
    } catch (error) {
      console.error('Lỗi lưu nhân viên:', error);
      message.error('Không thể lưu nhân viên');
    }
  };

  const xoaNhanVien = async (maNhanVien) => {
    try {
      const danhSachMoi = danhSachNhanVien.filter(nv => nv.key !== maNhanVien);
      setDanhSachNhanVien(danhSachMoi);
      message.success('Xóa nhân viên thành công');
    } catch (error) {
      console.error('Lỗi xóa nhân viên:', error);
      message.error('Không thể xóa nhân viên');
    }
  };

  const capNhatTrangThai = async (key, kichHoat) => {
    try {
      const capNhatDanhSach = danhSachNhanVien.map(nv => 
        nv.key === key ? { ...nv, kichHoat } : nv
      );
      setDanhSachNhanVien(capNhatDanhSach);
      message.success(`${kichHoat ? 'Kích hoạt' : 'Vô hiệu hóa'} tài khoản thành công`);
    } catch (error) {
      console.error('Lỗi cập nhật trạng thái:', error);
      message.error('Không thể cập nhật trạng thái');
    }
  };

  const cotBang = [
    {
      title: 'Mã NV',
      dataIndex: 'maNhanVien',
      key: 'maNhanVien',
      width: 100,
    },
    {
      title: 'Tên nhân viên',
      dataIndex: 'tenNhanVien',
      key: 'tenNhanVien',
      width: 150,
    },
    {
      title: 'SĐT',
      dataIndex: 'soDienThoai',
      key: 'soDienThoai',
      width: 120,
    },
    {
      title: 'Chức vụ',
      dataIndex: 'chucVu',
      key: 'chucVu',
      width: 120,
      render: (chucVu) => {
        const timChucVu = chucVu.find(cv => cv.value === chucVu);
        return timChucVu ? timChucVu.label : chucVu;
      }
    },
    {
      title: 'Lương cơ bản',
      dataIndex: 'luongCoBan',
      key: 'luongCoBan',
      width: 120,
      render: (luong) => `${luong?.toLocaleString()}đ`
    },
    {
      title: 'Ca làm việc',
      dataIndex: 'caLamViec',
      key: 'caLamViec',
      width: 150,
      render: (ca) => {
        const timCa = caLamViec.find(c => c.value === ca);
        return timCa ? timCa.label : ca;
      }
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThaiLamViec',
      key: 'trangThaiLamViec',
      width: 120,
      render: (trangThai) => {
        const timTrangThai = trangThaiLamViec.find(tt => tt.value === trangThai);
        const mau = {
          'dang_lam': 'green',
          'nghi_phep': 'orange',
          'da_nghi': 'red'
        };
        return (
          <span style={{ color: mau[trangThai] }}>
            {timTrangThai ? timTrangThai.label : trangThai}
          </span>
        );
      }
    },
    {
      title: 'Kích hoạt',
      dataIndex: 'kichHoat',
      key: 'kichHoat',
      width: 100,
      render: (kichHoat, record) => (
        <Switch
          checked={kichHoat}
          onChange={(checked) => capNhatTrangThai(record.key, checked)}
        />
      )
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
            title="Bạn có chắc muốn xóa nhân viên này?"
            onConfirm={() => xoaNhanVien(record.key)}
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
          <h2>Quản lý nhân viên</h2>
        </Col>
        <Col>
          <Button 
            type="primary" 
            icon={<PlusOutlined />}
            onClick={moModalThem}
          >
            Thêm nhân viên
          </Button>
        </Col>
      </Row>

      {/* Thống kê nhanh */}
      <Row gutter={16} style={{ marginBottom: '24px' }}>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#1890ff' }}>
                {danhSachNhanVien.length}
              </div>
              <div>Tổng nhân viên</div>
            </div>
          </Card>
        </Col>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#52c41a' }}>
                {danhSachNhanVien.filter(nv => nv.trangThaiLamViec === 'dang_lam').length}
              </div>
              <div>Đang làm việc</div>
            </div>
          </Card>
        </Col>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#faad14' }}>
                {danhSachNhanVien.filter(nv => nv.trangThaiLamViec === 'nghi_phep').length}
              </div>
              <div>Nghỉ phép</div>
            </div>
          </Card>
        </Col>
        <Col span={6}>
          <Card size="small">
            <div style={{ textAlign: 'center' }}>
              <div style={{ fontSize: '24px', fontWeight: 'bold', color: '#722ed1' }}>
                {danhSachNhanVien.reduce((tong, nv) => tong + (nv.luongCoBan || 0), 0).toLocaleString()}đ
              </div>
              <div>Tổng lương cơ bản</div>
            </div>
          </Card>
        </Col>
      </Row>

      <Card>
        <Table
          columns={cotBang}
          dataSource={danhSachNhanVien}
          loading={loading}
          scroll={{ x: 1400 }}
          pagination={{
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} nhân viên`,
          }}
        />
      </Card>

      {/* Modal thêm/sửa nhân viên */}
      <Modal
        title={chinhSua ? 'Chỉnh sửa nhân viên' : 'Thêm nhân viên mới'}
        open={hienThiModal}
        onCancel={dongModal}
        footer={null}
        width={800}
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={luuNhanVien}
        >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="maNhanVien"
                label="Mã nhân viên"
                rules={[
                  { required: true, message: 'Vui lòng nhập mã nhân viên' }
                ]}
              >
                <Input 
                  prefix={<UserOutlined />}
                  placeholder="Nhập mã nhân viên" 
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="tenNhanVien"
                label="Tên nhân viên"
                rules={[
                  { required: true, message: 'Vui lòng nhập tên nhân viên' }
                ]}
              >
                <Input placeholder="Nhập tên nhân viên" />
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
                <Input 
                  prefix={<MailOutlined />}
                  placeholder="Nhập email" 
                />
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
                name="chucVu"
                label="Chức vụ"
                rules={[
                  { required: true, message: 'Vui lòng chọn chức vụ' }
                ]}
              >
                <Select placeholder="Chọn chức vụ">
                  {chucVu.map(cv => (
                    <Option key={cv.value} value={cv.value}>
                      {cv.label}
                    </Option>
                  ))}
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="luongCoBan"
                label="Lương cơ bản"
                rules={[
                  { required: true, message: 'Vui lòng nhập lương cơ bản' }
                ]}
              >
                <InputNumber
                  style={{ width: '100%' }}
                  placeholder="Nhập lương cơ bản"
                  formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                  parser={value => value.replace(/\$\s?|(,*)/g, '')}
                />
              </Form.Item>
            </Col>
          </Row>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="caLamViec"
                label="Ca làm việc"
                rules={[
                  { required: true, message: 'Vui lòng chọn ca làm việc' }
                ]}
              >
                <Select placeholder="Chọn ca làm việc">
                  {caLamViec.map(ca => (
                    <Option key={ca.value} value={ca.value}>
                      {ca.label}
                    </Option>
                  ))}
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="ngayVaoLam"
                label="Ngày vào làm"
                rules={[
                  { required: true, message: 'Vui lòng chọn ngày vào làm' }
                ]}
              >
                <DatePicker 
                  style={{ width: '100%' }}
                  placeholder="Chọn ngày vào làm"
                />
              </Form.Item>
            </Col>
          </Row>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="trangThaiLamViec"
                label="Trạng thái làm việc"
                initialValue="dang_lam"
              >
                <Select>
                  {trangThaiLamViec.map(tt => (
                    <Option key={tt.value} value={tt.value}>
                      {tt.label}
                    </Option>
                  ))}
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="taiKhoan"
                label="Tài khoản đăng nhập"
                rules={[
                  { required: true, message: 'Vui lòng nhập tài khoản' }
                ]}
              >
                <Input 
                  prefix={<LockOutlined />}
                  placeholder="Nhập tài khoản đăng nhập" 
                />
              </Form.Item>
            </Col>
          </Row>

          <Form.Item
            name="ghiChu"
            label="Ghi chú"
          >
            <Input.TextArea 
              rows={2} 
              placeholder="Nhập ghi chú" 
            />
          </Form.Item>

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

export default QuanLyNhanVien;
