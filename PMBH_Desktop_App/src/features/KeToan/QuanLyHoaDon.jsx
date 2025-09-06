import React, { useState, useEffect } from 'react';
import { Table, Card, Button, Modal, Form, Input, Select, DatePicker, Space, message, Row, Col, Statistic, Tag, Descriptions } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, FileTextOutlined, PrinterOutlined } from '@ant-design/icons';
import dayjs from 'dayjs';

const { Option } = Select;
const { RangePicker } = DatePicker;

const QuanLyHoaDon = () => {
  const [danhSachHoaDon, setDanhSachHoaDon] = useState([]);
  const [danhSachKhachHang, setDanhSachKhachHang] = useState([]);
  const [modalHoaDon, setModalHoaDon] = useState(false);
  const [modalChiTiet, setModalChiTiet] = useState(false);
  const [hoaDonHienTai, setHoaDonHienTai] = useState(null);
  const [chiTietHoaDon, setChiTietHoaDon] = useState(null);
  const [form] = Form.useForm();

  // Dữ liệu mẫu khách hàng
  useEffect(() => {
    const khachHangMau = [
      { id: 1, hoTen: 'Nguyễn Văn A', soDienThoai: '0901234567', email: 'nva@email.com' },
      { id: 2, hoTen: 'Trần Thị B', soDienThoai: '0902345678', email: 'ttb@email.com' },
      { id: 3, hoTen: 'Lê Văn C', soDienThoai: '0903456789', email: 'lvc@email.com' },
      { id: 4, hoTen: 'Phạm Thị D', soDienThoai: '0904567890', email: 'ptd@email.com' }
    ];
    setDanhSachKhachHang(khachHangMau);

    // Dữ liệu mẫu hóa đơn
    const hoaDonMau = [
      {
        id: 1,
        soHoaDon: 'HD001',
        ngayHoaDon: '2024-12-20',
        khachHangId: 1,
        tenKhachHang: 'Nguyễn Văn A',
        soDienThoai: '0901234567',
        loaiHoaDon: 'ban_hang',
        tongTienHang: 350000,
        chietKhau: 35000,
        thueVAT: 31500,
        tongThanhToan: 346500,
        daThanhToan: 346500,
        conLai: 0,
        trangThai: 'da_thanh_toan',
        phuongThucThanhToan: 'tien_mat',
        nhanVienBan: 'Thu ngân A',
        ghiChu: 'Khách hàng VIP',
        chiTietSanPham: [
          { tenSanPham: 'Cà phê đen', soLuong: 2, donGia: 25000, thanhTien: 50000 },
          { tenSanPham: 'Bánh mì thịt nướng', soLuong: 3, donGia: 20000, thanhTien: 60000 },
          { tenSanPham: 'Trà sữa trân châu', soLuong: 4, donGia: 35000, thanhTien: 140000 },
          { tenSanPham: 'Bánh ngọt chocolate', soLuong: 2, donGia: 45000, thanhTien: 90000 }
        ]
      },
      {
        id: 2,
        soHoaDon: 'HD002',
        ngayHoaDon: '2024-12-20',
        khachHangId: 2,
        tenKhachHang: 'Trần Thị B',
        soDienThoai: '0902345678',
        loaiHoaDon: 'ban_hang',
        tongTienHang: 180000,
        chietKhau: 0,
        thueVAT: 18000,
        tongThanhToan: 198000,
        daThanhToan: 100000,
        conLai: 98000,
        trangThai: 'chua_thanh_toan',
        phuongThucThanhToan: 'chuyen_khoan',
        nhanVienBan: 'Thu ngân B',
        ghiChu: 'Thanh toán một phần',
        chiTietSanPham: [
          { tenSanPham: 'Cà phê sữa', soLuong: 2, donGia: 30000, thanhTien: 60000 },
          { tenSanPham: 'Bánh croissant', soLuong: 4, donGia: 30000, thanhTien: 120000 }
        ]
      },
      {
        id: 3,
        soHoaDon: 'HD003',
        ngayHoaDon: '2024-12-19',
        khachHangId: 3,
        tenKhachHang: 'Lê Văn C',
        soDienThoai: '0903456789',
        loaiHoaDon: 'tra_hang',
        tongTienHang: -120000,
        chietKhau: 0,
        thueVAT: -12000,
        tongThanhToan: -132000,
        daThanhToan: -132000,
        conLai: 0,
        trangThai: 'da_hoan_tien',
        phuongThucThanhToan: 'tien_mat',
        nhanVienBan: 'Thu ngân A',
        ghiChu: 'Trả hàng do lỗi',
        chiTietSanPham: [
          { tenSanPham: 'Trà sữa trân châu', soLuong: -2, donGia: 35000, thanhTien: -70000 },
          { tenSanPham: 'Bánh ngọt chocolate', soLuong: -1, donGia: 45000, thanhTien: -45000 }
        ]
      }
    ];
    setDanhSachHoaDon(hoaDonMau);
  }, []);

  const cotBang = [
    {
      title: 'Số hóa đơn',
      dataIndex: 'soHoaDon',
      key: 'soHoaDon',
      width: 120,
    },
    {
      title: 'Ngày hóa đơn',
      dataIndex: 'ngayHoaDon',
      key: 'ngayHoaDon',
      width: 120,
      render: (ngay) => dayjs(ngay).format('DD/MM/YYYY')
    },
    {
      title: 'Khách hàng',
      dataIndex: 'tenKhachHang',
      key: 'tenKhachHang',
      width: 150,
    },
    {
      title: 'SĐT',
      dataIndex: 'soDienThoai',
      key: 'soDienThoai',
      width: 120,
    },
    {
      title: 'Loại HĐ',
      dataIndex: 'loaiHoaDon',
      key: 'loaiHoaDon',
      width: 100,
      render: (loai) => {
        const mau = {
          ban_hang: 'green',
          tra_hang: 'red',
          doi_hang: 'orange'
        };
        const ten = {
          ban_hang: 'Bán hàng',
          tra_hang: 'Trả hàng',
          doi_hang: 'Đổi hàng'
        };
        return <Tag color={mau[loai]}>{ten[loai]}</Tag>;
      }
    },
    {
      title: 'Tổng tiền',
      dataIndex: 'tongTienHang',
      key: 'tongTienHang',
      width: 120,
      render: (tien) => new Intl.NumberFormat('vi-VN').format(tien) + ' đ'
    },
    {
      title: 'Chiết khấu',
      dataIndex: 'chietKhau',
      key: 'chietKhau',
      width: 100,
      render: (tien) => new Intl.NumberFormat('vi-VN').format(tien) + ' đ'
    },
    {
      title: 'Thuế VAT',
      dataIndex: 'thueVAT',
      key: 'thueVAT',
      width: 100,
      render: (tien) => new Intl.NumberFormat('vi-VN').format(tien) + ' đ'
    },
    {
      title: 'Thành tiền',
      dataIndex: 'tongThanhToan',
      key: 'tongThanhToan',
      width: 130,
      render: (tien) => (
        <span style={{ 
          fontWeight: 'bold', 
          color: tien >= 0 ? '#1890ff' : '#cf1322' 
        }}>
          {new Intl.NumberFormat('vi-VN').format(tien)} đ
        </span>
      )
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 140,
      render: (trangThai) => {
        const mau = {
          chua_thanh_toan: 'warning',
          da_thanh_toan: 'success',
          da_hoan_tien: 'error',
          huy: 'default'
        };
        const ten = {
          chua_thanh_toan: 'Chưa thanh toán',
          da_thanh_toan: 'Đã thanh toán',
          da_hoan_tien: 'Đã hoàn tiền',
          huy: 'Đã hủy'
        };
        return <Tag color={mau[trangThai]}>{ten[trangThai]}</Tag>;
      }
    },
    {
      title: 'Nhân viên',
      dataIndex: 'nhanVienBan',
      key: 'nhanVienBan',
      width: 120,
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      width: 200,
      render: (_, record) => (
        <Space>
          <Button 
            size="small" 
            type="primary"
            icon={<FileTextOutlined />} 
            onClick={() => xemChiTiet(record)}
          >
            Chi tiết
          </Button>
          <Button 
            size="small" 
            icon={<PrinterOutlined />}
            onClick={() => inHoaDon(record)}
          >
            In
          </Button>
          <Button 
            size="small" 
            icon={<EditOutlined />} 
            onClick={() => suaHoaDon(record)}
          >
            Sửa
          </Button>
          <Button 
            size="small" 
            danger 
            icon={<DeleteOutlined />}
            onClick={() => xoaHoaDon(record.id)}
          >
            Xóa
          </Button>
        </Space>
      )
    }
  ];

  const tinhThongKe = () => {
    const homNay = dayjs().format('YYYY-MM-DD');
    const thangHienTai = dayjs().format('YYYY-MM');
    
    const doanhThuHomNay = danhSachHoaDon
      .filter(hd => hd.ngayHoaDon === homNay && hd.loaiHoaDon === 'ban_hang' && hd.trangThai === 'da_thanh_toan')
      .reduce((tong, hd) => tong + hd.tongThanhToan, 0);
    
    const doanhThuThang = danhSachHoaDon
      .filter(hd => hd.ngayHoaDon.startsWith(thangHienTai) && hd.loaiHoaDon === 'ban_hang' && hd.trangThai === 'da_thanh_toan')
      .reduce((tong, hd) => tong + hd.tongThanhToan, 0);
    
    const soHoaDonHomNay = danhSachHoaDon.filter(hd => hd.ngayHoaDon === homNay).length;
    
    const chuaThanhToan = danhSachHoaDon
      .filter(hd => hd.trangThai === 'chua_thanh_toan')
      .reduce((tong, hd) => tong + hd.conLai, 0);

    return { doanhThuHomNay, doanhThuThang, soHoaDonHomNay, chuaThanhToan };
  };

  const taoSoHoaDon = () => {
    const so = danhSachHoaDon.length + 1;
    return `HD${so.toString().padStart(3, '0')}`;
  };

  const themHoaDon = () => {
    setHoaDonHienTai(null);
    form.resetFields();
    form.setFieldsValue({
      soHoaDon: taoSoHoaDon(),
      ngayHoaDon: dayjs(),
      loaiHoaDon: 'ban_hang',
      trangThai: 'chua_thanh_toan',
      phuongThucThanhToan: 'tien_mat',
      thueVAT: 10
    });
    setModalHoaDon(true);
  };

  const suaHoaDon = (hoaDon) => {
    setHoaDonHienTai(hoaDon);
    form.setFieldsValue({
      ...hoaDon,
      ngayHoaDon: dayjs(hoaDon.ngayHoaDon)
    });
    setModalHoaDon(true);
  };

  const xemChiTiet = (hoaDon) => {
    setChiTietHoaDon(hoaDon);
    setModalChiTiet(true);
  };

  const inHoaDon = (hoaDon) => {
    message.info('Chức năng in hóa đơn đang được phát triển!');
  };

  const luuHoaDon = (values) => {
    const khachHang = danhSachKhachHang.find(kh => kh.id === values.khachHangId);
    const tongTienHang = values.tongTienHang || 0;
    const chietKhau = values.chietKhau || 0;
    const thueVAT = tongTienHang * (values.thueVAT || 0) / 100;
    const tongThanhToan = tongTienHang - chietKhau + thueVAT;
    const daThanhToan = values.daThanhToan || 0;
    const conLai = tongThanhToan - daThanhToan;

    const hoaDonMoi = {
      ...values,
      ngayHoaDon: values.ngayHoaDon.format('YYYY-MM-DD'),
      tenKhachHang: khachHang.hoTen,
      soDienThoai: khachHang.soDienThoai,
      thueVAT,
      tongThanhToan,
      conLai,
      chiTietSanPham: []
    };

    if (hoaDonHienTai) {
      setDanhSachHoaDon(prev => 
        prev.map(hd => hd.id === hoaDonHienTai.id ? { ...hd, ...hoaDonMoi } : hd)
      );
      message.success('Cập nhật hóa đơn thành công!');
    } else {
      const hoaDonThemMoi = {
        id: Date.now(),
        ...hoaDonMoi
      };
      setDanhSachHoaDon(prev => [...prev, hoaDonThemMoi]);
      message.success('Thêm hóa đơn thành công!');
    }
    setModalHoaDon(false);
  };

  const xoaHoaDon = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa hóa đơn',
      content: 'Bạn có chắc chắn muốn xóa hóa đơn này?',
      onOk: () => {
        setDanhSachHoaDon(prev => prev.filter(hd => hd.id !== id));
        message.success('Xóa hóa đơn thành công!');
      }
    });
  };

  const thongKe = tinhThongKe();

  return (
    <div style={{ padding: 24 }}>
      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: 24 }}>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Doanh thu hôm nay" 
              value={thongKe.doanhThuHomNay} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#3f8600' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Doanh thu tháng" 
              value={thongKe.doanhThuThang} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#1890ff' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Hóa đơn hôm nay" value={thongKe.soHoaDonHomNay} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Chưa thanh toán" 
              value={thongKe.chuaThanhToan} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#cf1322' }}
            />
          </Card>
        </Col>
      </Row>

      <Card title="Quản lý hóa đơn" className="quan-ly-hoa-don">
        <Row gutter={[16, 16]} style={{ marginBottom: 16 }}>
          <Col span={24}>
            <Space>
              <Button 
                type="primary" 
                icon={<PlusOutlined />} 
                onClick={themHoaDon}
              >
                Tạo hóa đơn mới
              </Button>
              <Button 
                icon={<FileTextOutlined />}
              >
                Xuất báo cáo
              </Button>
              <Button 
                icon={<PrinterOutlined />}
              >
                In danh sách
              </Button>
            </Space>
          </Col>
        </Row>

        <Table
          columns={cotBang}
          dataSource={danhSachHoaDon}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total) => `Tổng ${total} hóa đơn`
          }}
          scroll={{ x: 1600 }}
        />

        {/* Modal thêm/sửa hóa đơn */}
        <Modal
          title={hoaDonHienTai ? "Sửa hóa đơn" : "Tạo hóa đơn mới"}
          open={modalHoaDon}
          onCancel={() => setModalHoaDon(false)}
          footer={null}
          width={800}
        >
          <Form
            form={form}
            layout="vertical"
            onFinish={luuHoaDon}
          >
            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="soHoaDon"
                  label="Số hóa đơn"
                  rules={[{ required: true, message: 'Vui lòng nhập số hóa đơn!' }]}
                >
                  <Input placeholder="Số hóa đơn tự động" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="ngayHoaDon"
                  label="Ngày hóa đơn"
                  rules={[{ required: true, message: 'Vui lòng chọn ngày!' }]}
                >
                  <DatePicker style={{ width: '100%' }} format="DD/MM/YYYY" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="loaiHoaDon"
                  label="Loại hóa đơn"
                  rules={[{ required: true, message: 'Vui lòng chọn loại!' }]}
                >
                  <Select placeholder="Chọn loại hóa đơn">
                    <Option value="ban_hang">Bán hàng</Option>
                    <Option value="tra_hang">Trả hàng</Option>
                    <Option value="doi_hang">Đổi hàng</Option>
                  </Select>
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="khachHangId"
                  label="Khách hàng"
                  rules={[{ required: true, message: 'Vui lòng chọn khách hàng!' }]}
                >
                  <Select placeholder="Chọn khách hàng" showSearch>
                    {danhSachKhachHang.map(kh => (
                      <Option key={kh.id} value={kh.id}>
                        {kh.hoTen} - {kh.soDienThoai}
                      </Option>
                    ))}
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="nhanVienBan"
                  label="Nhân viên bán"
                  rules={[{ required: true, message: 'Vui lòng nhập nhân viên!' }]}
                >
                  <Input placeholder="Tên nhân viên bán hàng" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="tongTienHang"
                  label="Tổng tiền hàng (VND)"
                  rules={[{ required: true, message: 'Vui lòng nhập tổng tiền!' }]}
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="chietKhau"
                  label="Chiết khấu (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="thueVAT"
                  label="Thuế VAT (%)"
                >
                  <Input type="number" placeholder="10" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="daThanhToan"
                  label="Đã thanh toán (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="phuongThucThanhToan"
                  label="Phương thức thanh toán"
                  rules={[{ required: true, message: 'Vui lòng chọn phương thức!' }]}
                >
                  <Select placeholder="Chọn phương thức">
                    <Option value="tien_mat">Tiền mặt</Option>
                    <Option value="chuyen_khoan">Chuyển khoản</Option>
                    <Option value="the">Thẻ ngân hàng</Option>
                    <Option value="ket_hop">Kết hợp</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="trangThai"
                  label="Trạng thái"
                  rules={[{ required: true, message: 'Vui lòng chọn trạng thái!' }]}
                >
                  <Select placeholder="Chọn trạng thái">
                    <Option value="chua_thanh_toan">Chưa thanh toán</Option>
                    <Option value="da_thanh_toan">Đã thanh toán</Option>
                    <Option value="da_hoan_tien">Đã hoàn tiền</Option>
                    <Option value="huy">Đã hủy</Option>
                  </Select>
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
                <Button onClick={() => setModalHoaDon(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  {hoaDonHienTai ? 'Cập nhật' : 'Tạo hóa đơn'}
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>

        {/* Modal chi tiết hóa đơn */}
        <Modal
          title="Chi tiết hóa đơn"
          open={modalChiTiet}
          onCancel={() => setModalChiTiet(false)}
          footer={[
            <Button key="print" icon={<PrinterOutlined />} onClick={() => inHoaDon(chiTietHoaDon)}>
              In hóa đơn
            </Button>,
            <Button key="close" onClick={() => setModalChiTiet(false)}>
              Đóng
            </Button>
          ]}
          width={700}
        >
          {chiTietHoaDon && (
            <div>
              <Descriptions bordered column={2} style={{ marginBottom: 16 }}>
                <Descriptions.Item label="Số hóa đơn">{chiTietHoaDon.soHoaDon}</Descriptions.Item>
                <Descriptions.Item label="Ngày hóa đơn">
                  {dayjs(chiTietHoaDon.ngayHoaDon).format('DD/MM/YYYY')}
                </Descriptions.Item>
                <Descriptions.Item label="Khách hàng">{chiTietHoaDon.tenKhachHang}</Descriptions.Item>
                <Descriptions.Item label="SĐT">{chiTietHoaDon.soDienThoai}</Descriptions.Item>
                <Descriptions.Item label="Nhân viên bán">{chiTietHoaDon.nhanVienBan}</Descriptions.Item>
                <Descriptions.Item label="Loại hóa đơn">
                  <Tag color={chiTietHoaDon.loaiHoaDon === 'ban_hang' ? 'green' : 'red'}>
                    {chiTietHoaDon.loaiHoaDon === 'ban_hang' ? 'Bán hàng' : 'Trả hàng'}
                  </Tag>
                </Descriptions.Item>
              </Descriptions>

              <Card title="Chi tiết sản phẩm" size="small" style={{ marginBottom: 16 }}>
                <Table
                  size="small"
                  columns={[
                    { title: 'Tên sản phẩm', dataIndex: 'tenSanPham', key: 'tenSanPham' },
                    { title: 'Số lượng', dataIndex: 'soLuong', key: 'soLuong', width: 100 },
                    { 
                      title: 'Đơn giá', 
                      dataIndex: 'donGia', 
                      key: 'donGia', 
                      width: 120,
                      render: (gia) => new Intl.NumberFormat('vi-VN').format(gia) + ' đ'
                    },
                    { 
                      title: 'Thành tiền', 
                      dataIndex: 'thanhTien', 
                      key: 'thanhTien', 
                      width: 150,
                      render: (tien) => new Intl.NumberFormat('vi-VN').format(tien) + ' đ'
                    }
                  ]}
                  dataSource={chiTietHoaDon.chiTietSanPham}
                  rowKey="tenSanPham"
                  pagination={false}
                />
              </Card>

              <Descriptions bordered column={2}>
                <Descriptions.Item label="Tổng tiền hàng">
                  {new Intl.NumberFormat('vi-VN').format(chiTietHoaDon.tongTienHang)} đ
                </Descriptions.Item>
                <Descriptions.Item label="Chiết khấu">
                  {new Intl.NumberFormat('vi-VN').format(chiTietHoaDon.chietKhau)} đ
                </Descriptions.Item>
                <Descriptions.Item label="Thuế VAT">
                  {new Intl.NumberFormat('vi-VN').format(chiTietHoaDon.thueVAT)} đ
                </Descriptions.Item>
                <Descriptions.Item label="Thành tiền">
                  <span style={{ fontSize: '16px', fontWeight: 'bold', color: '#1890ff' }}>
                    {new Intl.NumberFormat('vi-VN').format(chiTietHoaDon.tongThanhToan)} đ
                  </span>
                </Descriptions.Item>
                <Descriptions.Item label="Đã thanh toán">
                  {new Intl.NumberFormat('vi-VN').format(chiTietHoaDon.daThanhToan)} đ
                </Descriptions.Item>
                <Descriptions.Item label="Còn lại">
                  <span style={{ color: chiTietHoaDon.conLai > 0 ? '#cf1322' : '#3f8600' }}>
                    {new Intl.NumberFormat('vi-VN').format(chiTietHoaDon.conLai)} đ
                  </span>
                </Descriptions.Item>
                <Descriptions.Item label="Phương thức TT">
                  {chiTietHoaDon.phuongThucThanhToan === 'tien_mat' ? 'Tiền mặt' : 
                   chiTietHoaDon.phuongThucThanhToan === 'chuyen_khoan' ? 'Chuyển khoản' : 'Thẻ'}
                </Descriptions.Item>
                <Descriptions.Item label="Trạng thái">
                  <Tag color={chiTietHoaDon.trangThai === 'da_thanh_toan' ? 'success' : 'warning'}>
                    {chiTietHoaDon.trangThai === 'da_thanh_toan' ? 'Đã thanh toán' : 'Chưa thanh toán'}
                  </Tag>
                </Descriptions.Item>
                <Descriptions.Item label="Ghi chú" span={2}>
                  {chiTietHoaDon.ghiChu || 'Không có'}
                </Descriptions.Item>
              </Descriptions>
            </div>
          )}
        </Modal>
      </Card>
    </div>
  );
};

export default QuanLyHoaDon;
