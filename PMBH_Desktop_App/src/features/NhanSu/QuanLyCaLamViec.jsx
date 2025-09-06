import React, { useState, useEffect } from 'react';
import { Table, Card, Button, Modal, Form, Input, Select, DatePicker, Space, message, Row, Col, Statistic, Tag } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, CalendarOutlined } from '@ant-design/icons';
import dayjs from 'dayjs';

const { Option } = Select;
const { RangePicker } = DatePicker;

const QuanLyCaLamViec = () => {
  const [danhSachCaLam, setDanhSachCaLam] = useState([]);
  const [danhSachNhanVien, setDanhSachNhanVien] = useState([]);
  const [modalCaLam, setModalCaLam] = useState(false);
  const [caLamHienTai, setCaLamHienTai] = useState(null);
  const [form] = Form.useForm();

  // Dữ liệu mẫu nhân viên
  useEffect(() => {
    const nhanVienMau = [
      { id: 1, hoTen: 'Nguyễn Văn A', chucVu: 'Thu ngân' },
      { id: 2, hoTen: 'Trần Thị B', chucVu: 'Phục vụ' },
      { id: 3, hoTen: 'Lê Văn C', chucVu: 'Pha chế' },
      { id: 4, hoTen: 'Phạm Thị D', chucVu: 'Quản lý ca' }
    ];
    setDanhSachNhanVien(nhanVienMau);

    // Dữ liệu mẫu ca làm việc
    const caLamMau = [
      {
        id: 1,
        tenCa: 'Ca sáng',
        gioVao: '06:00',
        gioRa: '14:00',
        ngayLam: '2024-12-20',
        nhanVienId: 1,
        hoTenNhanVien: 'Nguyễn Văn A',
        trangThai: 'da_lam',
        luongCa: 200000,
        gioLamThucTe: '8 giờ',
        ghiChu: ''
      },
      {
        id: 2,
        tenCa: 'Ca chiều',
        gioVao: '14:00',
        gioRa: '22:00',
        ngayLam: '2024-12-20',
        nhanVienId: 2,
        hoTenNhanVien: 'Trần Thị B',
        trangThai: 'dang_lam',
        luongCa: 250000,
        gioLamThucTe: '',
        ghiChu: ''
      },
      {
        id: 3,
        tenCa: 'Ca tối',
        gioVao: '18:00',
        gioRa: '02:00',
        ngayLam: '2024-12-21',
        nhanVienId: 3,
        hoTenNhanVien: 'Lê Văn C',
        trangThai: 'chua_lam',
        luongCa: 300000,
        gioLamThucTe: '',
        ghiChu: 'Ca đêm'
      }
    ];
    setDanhSachCaLam(caLamMau);
  }, []);

  const cotBang = [
    {
      title: 'Tên ca',
      dataIndex: 'tenCa',
      key: 'tenCa',
      width: 120,
    },
    {
      title: 'Ngày làm',
      dataIndex: 'ngayLam',
      key: 'ngayLam',
      width: 120,
      render: (ngay) => dayjs(ngay).format('DD/MM/YYYY')
    },
    {
      title: 'Giờ vào',
      dataIndex: 'gioVao',
      key: 'gioVao',
      width: 100,
    },
    {
      title: 'Giờ ra',
      dataIndex: 'gioRa',
      key: 'gioRa',
      width: 100,
    },
    {
      title: 'Nhân viên',
      dataIndex: 'hoTenNhanVien',
      key: 'hoTenNhanVien',
      width: 150,
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 120,
      render: (trangThai) => {
        const mauSac = {
          chua_lam: 'default',
          dang_lam: 'processing',
          da_lam: 'success',
          nghi_phep: 'warning',
          tre_gio: 'error'
        };
        const tenTrangThai = {
          chua_lam: 'Chưa làm',
          dang_lam: 'Đang làm',
          da_lam: 'Đã làm',
          nghi_phep: 'Nghỉ phép',
          tre_gio: 'Trễ giờ'
        };
        return <Tag color={mauSac[trangThai]}>{tenTrangThai[trangThai]}</Tag>;
      }
    },
    {
      title: 'Lương ca',
      dataIndex: 'luongCa',
      key: 'luongCa',
      width: 120,
      render: (luong) => new Intl.NumberFormat('vi-VN').format(luong) + ' đ'
    },
    {
      title: 'Giờ làm thực tế',
      dataIndex: 'gioLamThucTe',
      key: 'gioLamThucTe',
      width: 130,
    },
    {
      title: 'Ghi chú',
      dataIndex: 'ghiChu',
      key: 'ghiChu',
      width: 150,
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      width: 150,
      render: (_, record) => (
        <Space>
          <Button 
            size="small" 
            icon={<EditOutlined />} 
            onClick={() => suaCaLam(record)}
          >
            Sửa
          </Button>
          <Button 
            size="small" 
            danger 
            icon={<DeleteOutlined />}
            onClick={() => xoaCaLam(record.id)}
          >
            Xóa
          </Button>
        </Space>
      )
    }
  ];

  const tinhThongKe = () => {
    const homNay = dayjs().format('YYYY-MM-DD');
    const caHomNay = danhSachCaLam.filter(ca => ca.ngayLam === homNay);
    const caDangLam = danhSachCaLam.filter(ca => ca.trangThai === 'dang_lam').length;
    const caDaLam = danhSachCaLam.filter(ca => ca.trangThai === 'da_lam').length;
    const tongLuongThang = danhSachCaLam
      .filter(ca => ca.trangThai === 'da_lam')
      .reduce((tong, ca) => tong + ca.luongCa, 0);

    return { caHomNay: caHomNay.length, caDangLam, caDaLam, tongLuongThang };
  };

  const themCaLam = () => {
    setCaLamHienTai(null);
    form.resetFields();
    form.setFieldsValue({
      ngayLam: dayjs(),
      trangThai: 'chua_lam'
    });
    setModalCaLam(true);
  };

  const suaCaLam = (caLam) => {
    setCaLamHienTai(caLam);
    const nhanVien = danhSachNhanVien.find(nv => nv.id === caLam.nhanVienId);
    form.setFieldsValue({
      ...caLam,
      ngayLam: dayjs(caLam.ngayLam),
      gioVao: dayjs(caLam.gioVao, 'HH:mm'),
      gioRa: dayjs(caLam.gioRa, 'HH:mm'),
      nhanVienId: caLam.nhanVienId
    });
    setModalCaLam(true);
  };

  const luuCaLam = (values) => {
    const nhanVien = danhSachNhanVien.find(nv => nv.id === values.nhanVienId);
    const caLamMoi = {
      ...values,
      ngayLam: values.ngayLam.format('YYYY-MM-DD'),
      gioVao: values.gioVao.format('HH:mm'),
      gioRa: values.gioRa.format('HH:mm'),
      hoTenNhanVien: nhanVien.hoTen,
      gioLamThucTe: values.trangThai === 'da_lam' ? 
        tinhGioLam(values.gioVao.format('HH:mm'), values.gioRa.format('HH:mm')) : ''
    };

    if (caLamHienTai) {
      setDanhSachCaLam(prev => 
        prev.map(ca => ca.id === caLamHienTai.id ? { ...ca, ...caLamMoi } : ca)
      );
      message.success('Cập nhật ca làm việc thành công!');
    } else {
      const caLamThemMoi = {
        id: Date.now(),
        ...caLamMoi
      };
      setDanhSachCaLam(prev => [...prev, caLamThemMoi]);
      message.success('Thêm ca làm việc thành công!');
    }
    setModalCaLam(false);
  };

  const xoaCaLam = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa ca làm việc',
      content: 'Bạn có chắc chắn muốn xóa ca làm việc này?',
      onOk: () => {
        setDanhSachCaLam(prev => prev.filter(ca => ca.id !== id));
        message.success('Xóa ca làm việc thành công!');
      }
    });
  };

  const tinhGioLam = (gioVao, gioRa) => {
    const vao = dayjs(gioVao, 'HH:mm');
    const ra = dayjs(gioRa, 'HH:mm');
    let diff = ra.diff(vao, 'hour', true);
    
    // Xử lý ca qua đêm
    if (diff < 0) {
      diff += 24;
    }
    
    return diff + ' giờ';
  };

  const thongKe = tinhThongKe();

  return (
    <div style={{ padding: 24 }}>
      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: 24 }}>
        <Col span={6}>
          <Card>
            <Statistic title="Ca hôm nay" value={thongKe.caHomNay} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Đang làm việc" value={thongKe.caDangLam} valueStyle={{ color: '#1890ff' }} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Đã hoàn thành" value={thongKe.caDaLam} valueStyle={{ color: '#3f8600' }} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Tổng lương tháng" 
              value={thongKe.tongLuongThang} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
            />
          </Card>
        </Col>
      </Row>

      <Card title="Quản lý ca làm việc" className="quan-ly-ca-lam-viec">
        <Row gutter={[16, 16]} style={{ marginBottom: 16 }}>
          <Col span={24}>
            <Space>
              <Button 
                type="primary" 
                icon={<PlusOutlined />} 
                onClick={themCaLam}
              >
                Thêm ca làm việc
              </Button>
              <Button 
                icon={<CalendarOutlined />}
              >
                Xem lịch làm việc
              </Button>
            </Space>
          </Col>
        </Row>

        <Table
          columns={cotBang}
          dataSource={danhSachCaLam}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total) => `Tổng ${total} ca làm việc`
          }}
        />

        {/* Modal thêm/sửa ca làm việc */}
        <Modal
          title={caLamHienTai ? "Sửa ca làm việc" : "Thêm ca làm việc mới"}
          open={modalCaLam}
          onCancel={() => setModalCaLam(false)}
          footer={null}
          width={600}
        >
          <Form
            form={form}
            layout="vertical"
            onFinish={luuCaLam}
          >
            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="tenCa"
                  label="Tên ca"
                  rules={[{ required: true, message: 'Vui lòng nhập tên ca!' }]}
                >
                  <Select placeholder="Chọn ca làm việc">
                    <Option value="Ca sáng">Ca sáng</Option>
                    <Option value="Ca chiều">Ca chiều</Option>
                    <Option value="Ca tối">Ca tối</Option>
                    <Option value="Ca đêm">Ca đêm</Option>
                    <Option value="Ca full time">Ca full time</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="ngayLam"
                  label="Ngày làm"
                  rules={[{ required: true, message: 'Vui lòng chọn ngày!' }]}
                >
                  <DatePicker style={{ width: '100%' }} format="DD/MM/YYYY" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="gioVao"
                  label="Giờ vào ca"
                  rules={[{ required: true, message: 'Vui lòng chọn giờ vào!' }]}
                >
                  <DatePicker.TimePicker 
                    style={{ width: '100%' }} 
                    format="HH:mm" 
                    placeholder="Chọn giờ vào"
                  />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="gioRa"
                  label="Giờ ra ca"
                  rules={[{ required: true, message: 'Vui lòng chọn giờ ra!' }]}
                >
                  <DatePicker.TimePicker 
                    style={{ width: '100%' }} 
                    format="HH:mm" 
                    placeholder="Chọn giờ ra"
                  />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="nhanVienId"
                  label="Nhân viên"
                  rules={[{ required: true, message: 'Vui lòng chọn nhân viên!' }]}
                >
                  <Select placeholder="Chọn nhân viên">
                    {danhSachNhanVien.map(nv => (
                      <Option key={nv.id} value={nv.id}>
                        {nv.hoTen} - {nv.chucVu}
                      </Option>
                    ))}
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="luongCa"
                  label="Lương ca (VND)"
                  rules={[{ required: true, message: 'Vui lòng nhập lương ca!' }]}
                >
                  <Input type="number" placeholder="Nhập lương ca" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="trangThai"
                  label="Trạng thái"
                  rules={[{ required: true, message: 'Vui lòng chọn trạng thái!' }]}
                >
                  <Select placeholder="Chọn trạng thái">
                    <Option value="chua_lam">Chưa làm</Option>
                    <Option value="dang_lam">Đang làm</Option>
                    <Option value="da_lam">Đã làm</Option>
                    <Option value="nghi_phep">Nghỉ phép</Option>
                    <Option value="tre_gio">Trễ giờ</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="gioLamThucTe"
                  label="Giờ làm thực tế"
                >
                  <Input placeholder="Ví dụ: 8 giờ" />
                </Form.Item>
              </Col>
            </Row>

            <Form.Item
              name="ghiChu"
              label="Ghi chú"
            >
              <Input.TextArea rows={3} placeholder="Ghi chú thêm (tùy chọn)" />
            </Form.Item>

            <Form.Item style={{ marginBottom: 0, textAlign: 'right' }}>
              <Space>
                <Button onClick={() => setModalCaLam(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  {caLamHienTai ? 'Cập nhật' : 'Thêm mới'}
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>
      </Card>
    </div>
  );
};

export default QuanLyCaLamViec;
