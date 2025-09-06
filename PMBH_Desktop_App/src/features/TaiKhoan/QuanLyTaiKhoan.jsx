import React, { useState, useEffect } from 'react';
import { Table, Card, Button, Modal, Form, Input, Select, Space, message, Row, Col, Tag } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, LockOutlined, UnlockOutlined } from '@ant-design/icons';

const { Option } = Select;

const QuanLyTaiKhoan = () => {
  const [danhSachTaiKhoan, setDanhSachTaiKhoan] = useState([]);
  const [modalTaiKhoan, setModalTaiKhoan] = useState(false);
  const [taiKhoanHienTai, setTaiKhoanHienTai] = useState(null);
  const [form] = Form.useForm();

  // Dữ liệu mẫu tài khoản
  useEffect(() => {
    const taiKhoanMau = [
      {
        id: 1,
        tenDangNhap: 'admin',
        hoTen: 'Quản trị viên',
        email: 'admin@cafe.vn',
        vaiTro: 'admin',
        trangThai: 'hoat_dong',
        ngayTao: '2024-01-01',
        lanDangNhapCuoi: '2024-12-20 10:30:00'
      },
      {
        id: 2,
        tenDangNhap: 'nhanvien01',
        hoTen: 'Nguyễn Văn A',
        email: 'nva@cafe.vn',
        vaiTro: 'nhan_vien',
        trangThai: 'hoat_dong',
        ngayTao: '2024-01-15',
        lanDangNhapCuoi: '2024-12-20 09:15:00'
      },
      {
        id: 3,
        tenDangNhap: 'thungan01',
        hoTen: 'Trần Thị B',
        email: 'ttb@cafe.vn',
        vaiTro: 'thu_ngan',
        trangThai: 'khoa',
        ngayTao: '2024-02-01',
        lanDangNhapCuoi: '2024-12-19 16:45:00'
      }
    ];
    setDanhSachTaiKhoan(taiKhoanMau);
  }, []);

  const cotBang = [
    {
      title: 'Tên đăng nhập',
      dataIndex: 'tenDangNhap',
      key: 'tenDangNhap',
      width: 150,
    },
    {
      title: 'Họ tên',
      dataIndex: 'hoTen',
      key: 'hoTen',
      width: 200,
    },
    {
      title: 'Email',
      dataIndex: 'email',
      key: 'email',
      width: 200,
    },
    {
      title: 'Vai trò',
      dataIndex: 'vaiTro',
      key: 'vaiTro',
      width: 120,
      render: (vaiTro) => {
        const mauSac = {
          admin: 'red',
          quan_ly: 'orange',
          thu_ngan: 'blue',
          nhan_vien: 'green',
          bep: 'purple'
        };
        const tenVaiTro = {
          admin: 'Quản trị viên',
          quan_ly: 'Quản lý',
          thu_ngan: 'Thu ngân',
          nhan_vien: 'Nhân viên',
          bep: 'Bếp'
        };
        return <Tag color={mauSac[vaiTro]}>{tenVaiTro[vaiTro]}</Tag>;
      }
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 120,
      render: (trangThai) => (
        <Tag color={trangThai === 'hoat_dong' ? 'green' : 'red'}>
          {trangThai === 'hoat_dong' ? 'Hoạt động' : 'Đã khóa'}
        </Tag>
      )
    },
    {
      title: 'Lần đăng nhập cuối',
      dataIndex: 'lanDangNhapCuoi',
      key: 'lanDangNhapCuoi',
      width: 180,
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      width: 200,
      render: (_, record) => (
        <Space>
          <Button 
            size="small" 
            icon={<EditOutlined />} 
            onClick={() => suaTaiKhoan(record)}
          >
            Sửa
          </Button>
          <Button 
            size="small" 
            type={record.trangThai === 'hoat_dong' ? 'default' : 'primary'}
            icon={record.trangThai === 'hoat_dong' ? <LockOutlined /> : <UnlockOutlined />}
            onClick={() => thayDoiTrangThai(record)}
          >
            {record.trangThai === 'hoat_dong' ? 'Khóa' : 'Mở khóa'}
          </Button>
          <Button 
            size="small" 
            danger 
            icon={<DeleteOutlined />}
            onClick={() => xoaTaiKhoan(record.id)}
          >
            Xóa
          </Button>
        </Space>
      )
    }
  ];

  const themTaiKhoan = () => {
    setTaiKhoanHienTai(null);
    form.resetFields();
    setModalTaiKhoan(true);
  };

  const suaTaiKhoan = (taiKhoan) => {
    setTaiKhoanHienTai(taiKhoan);
    form.setFieldsValue(taiKhoan);
    setModalTaiKhoan(true);
  };

  const luuTaiKhoan = (values) => {
    if (taiKhoanHienTai) {
      // Cập nhật tài khoản
      setDanhSachTaiKhoan(prev => 
        prev.map(tk => tk.id === taiKhoanHienTai.id ? { ...tk, ...values } : tk)
      );
      message.success('Cập nhật tài khoản thành công!');
    } else {
      // Thêm tài khoản mới
      const taiKhoanMoi = {
        id: Date.now(),
        ...values,
        ngayTao: new Date().toISOString().split('T')[0],
        lanDangNhapCuoi: 'Chưa đăng nhập',
        trangThai: 'hoat_dong'
      };
      setDanhSachTaiKhoan(prev => [...prev, taiKhoanMoi]);
      message.success('Thêm tài khoản thành công!');
    }
    setModalTaiKhoan(false);
  };

  const thayDoiTrangThai = (taiKhoan) => {
    const trangThaiMoi = taiKhoan.trangThai === 'hoat_dong' ? 'khoa' : 'hoat_dong';
    setDanhSachTaiKhoan(prev =>
      prev.map(tk => 
        tk.id === taiKhoan.id ? { ...tk, trangThai: trangThaiMoi } : tk
      )
    );
    message.success(`${trangThaiMoi === 'hoat_dong' ? 'Mở khóa' : 'Khóa'} tài khoản thành công!`);
  };

  const xoaTaiKhoan = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa tài khoản',
      content: 'Bạn có chắc chắn muốn xóa tài khoản này?',
      onOk: () => {
        setDanhSachTaiKhoan(prev => prev.filter(tk => tk.id !== id));
        message.success('Xóa tài khoản thành công!');
      }
    });
  };

  return (
    <div style={{ padding: 24 }}>
      <Card title="Quản lý tài khoản" className="quan-ly-tai-khoan">
        <Row gutter={[16, 16]} style={{ marginBottom: 16 }}>
          <Col span={24}>
            <Button 
              type="primary" 
              icon={<PlusOutlined />} 
              onClick={themTaiKhoan}
            >
              Thêm tài khoản mới
            </Button>
          </Col>
        </Row>

        <Table
          columns={cotBang}
          dataSource={danhSachTaiKhoan}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total) => `Tổng ${total} tài khoản`
          }}
        />

        <Modal
          title={taiKhoanHienTai ? "Sửa tài khoản" : "Thêm tài khoản mới"}
          open={modalTaiKhoan}
          onCancel={() => setModalTaiKhoan(false)}
          footer={null}
          width={600}
        >
          <Form
            form={form}
            layout="vertical"
            onFinish={luuTaiKhoan}
          >
            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="tenDangNhap"
                  label="Tên đăng nhập"
                  rules={[
                    { required: true, message: 'Vui lòng nhập tên đăng nhập!' },
                    { min: 3, message: 'Tên đăng nhập phải có ít nhất 3 ký tự!' }
                  ]}
                >
                  <Input placeholder="Nhập tên đăng nhập" />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="hoTen"
                  label="Họ tên"
                  rules={[{ required: true, message: 'Vui lòng nhập họ tên!' }]}
                >
                  <Input placeholder="Nhập họ tên đầy đủ" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="email"
                  label="Email"
                  rules={[
                    { required: true, message: 'Vui lòng nhập email!' },
                    { type: 'email', message: 'Email không hợp lệ!' }
                  ]}
                >
                  <Input placeholder="Nhập địa chỉ email" />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="vaiTro"
                  label="Vai trò"
                  rules={[{ required: true, message: 'Vui lòng chọn vai trò!' }]}
                >
                  <Select placeholder="Chọn vai trò">
                    <Option value="admin">Quản trị viên</Option>
                    <Option value="quan_ly">Quản lý</Option>
                    <Option value="thu_ngan">Thu ngân</Option>
                    <Option value="nhan_vien">Nhân viên</Option>
                    <Option value="bep">Bếp</Option>
                  </Select>
                </Form.Item>
              </Col>
            </Row>

            {!taiKhoanHienTai && (
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="matKhau"
                    label="Mật khẩu"
                    rules={[
                      { required: true, message: 'Vui lòng nhập mật khẩu!' },
                      { min: 6, message: 'Mật khẩu phải có ít nhất 6 ký tự!' }
                    ]}
                  >
                    <Input.Password placeholder="Nhập mật khẩu" />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="xacNhanMatKhau"
                    label="Xác nhận mật khẩu"
                    dependencies={['matKhau']}
                    rules={[
                      { required: true, message: 'Vui lòng xác nhận mật khẩu!' },
                      ({ getFieldValue }) => ({
                        validator(_, value) {
                          if (!value || getFieldValue('matKhau') === value) {
                            return Promise.resolve();
                          }
                          return Promise.reject('Mật khẩu xác nhận không khớp!');
                        }
                      })
                    ]}
                  >
                    <Input.Password placeholder="Nhập lại mật khẩu" />
                  </Form.Item>
                </Col>
              </Row>
            )}

            <Form.Item style={{ marginBottom: 0, textAlign: 'right' }}>
              <Space>
                <Button onClick={() => setModalTaiKhoan(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  {taiKhoanHienTai ? 'Cập nhật' : 'Thêm mới'}
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>
      </Card>
    </div>
  );
};

export default QuanLyTaiKhoan;
