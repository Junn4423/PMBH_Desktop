import React, { useState, useEffect } from 'react';
import { Table, Card, Button, Modal, Form, Input, Select, DatePicker, Space, message, Row, Col, Statistic, Tag, Descriptions } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, DollarOutlined, CalculatorOutlined } from '@ant-design/icons';
import dayjs from 'dayjs';

const { Option } = Select;
const { RangePicker } = DatePicker;

const QuanLyLuong = () => {
  const [danhSachLuong, setDanhSachLuong] = useState([]);
  const [danhSachNhanVien, setDanhSachNhanVien] = useState([]);
  const [modalLuong, setModalLuong] = useState(false);
  const [modalChiTiet, setModalChiTiet] = useState(false);
  const [luongHienTai, setLuongHienTai] = useState(null);
  const [chiTietLuong, setChiTietLuong] = useState(null);
  const [form] = Form.useForm();

  // Dữ liệu mẫu nhân viên
  useEffect(() => {
    const nhanVienMau = [
      { id: 1, hoTen: 'Nguyễn Văn A', chucVu: 'Thu ngân', luongCoBan: 5000000 },
      { id: 2, hoTen: 'Trần Thị B', chucVu: 'Phục vụ', luongCoBan: 4500000 },
      { id: 3, hoTen: 'Lê Văn C', chucVu: 'Pha chế', luongCoBan: 5500000 },
      { id: 4, hoTen: 'Phạm Thị D', chucVu: 'Quản lý ca', luongCoBan: 8000000 }
    ];
    setDanhSachNhanVien(nhanVienMau);

    // Dữ liệu mẫu bảng lương
    const luongMau = [
      {
        id: 1,
        nhanVienId: 1,
        hoTenNhanVien: 'Nguyễn Văn A',
        thangNam: '2024-12',
        luongCoBan: 5000000,
        phuCapChucVu: 500000,
        phuCapKhac: 200000,
        luongLamThem: 800000,
        thuong: 300000,
        khauTru: 150000,
        tamUng: 1000000,
        luongThucLanh: 5650000,
        soNgayLam: 26,
        soGioLamThem: 20,
        trangThai: 'da_thanh_toan',
        ngayThanhToan: '2024-12-30',
        ghiChu: 'Đúng hạn'
      },
      {
        id: 2,
        nhanVienId: 2,
        hoTenNhanVien: 'Trần Thị B',
        thangNam: '2024-12',
        luongCoBan: 4500000,
        phuCapChucVu: 300000,
        phuCapKhac: 0,
        luongLamThem: 600000,
        thuong: 200000,
        khauTru: 100000,
        tamUng: 500000,
        luongThucLanh: 5000000,
        soNgayLam: 24,
        soGioLamThem: 15,
        trangThai: 'chua_thanh_toan',
        ngayThanhToan: '',
        ghiChu: ''
      }
    ];
    setDanhSachLuong(luongMau);
  }, []);

  const cotBang = [
    {
      title: 'Nhân viên',
      dataIndex: 'hoTenNhanVien',
      key: 'hoTenNhanVien',
      width: 150,
    },
    {
      title: 'Tháng/Năm',
      dataIndex: 'thangNam',
      key: 'thangNam',
      width: 100,
    },
    {
      title: 'Lương cơ bản',
      dataIndex: 'luongCoBan',
      key: 'luongCoBan',
      width: 130,
      render: (luong) => new Intl.NumberFormat('vi-VN').format(luong) + ' đ'
    },
    {
      title: 'Phụ cấp',
      key: 'phuCap',
      width: 120,
      render: (_, record) => {
        const tongPhuCap = record.phuCapChucVu + record.phuCapKhac;
        return new Intl.NumberFormat('vi-VN').format(tongPhuCap) + ' đ';
      }
    },
    {
      title: 'Làm thêm',
      dataIndex: 'luongLamThem',
      key: 'luongLamThem',
      width: 120,
      render: (luong) => new Intl.NumberFormat('vi-VN').format(luong) + ' đ'
    },
    {
      title: 'Thưởng',
      dataIndex: 'thuong',
      key: 'thuong',
      width: 100,
      render: (thuong) => new Intl.NumberFormat('vi-VN').format(thuong) + ' đ'
    },
    {
      title: 'Khấu trừ',
      dataIndex: 'khauTru',
      key: 'khauTru',
      width: 100,
      render: (khauTru) => new Intl.NumberFormat('vi-VN').format(khauTru) + ' đ'
    },
    {
      title: 'Tạm ứng',
      dataIndex: 'tamUng',
      key: 'tamUng',
      width: 100,
      render: (tamUng) => new Intl.NumberFormat('vi-VN').format(tamUng) + ' đ'
    },
    {
      title: 'Thực lãnh',
      dataIndex: 'luongThucLanh',
      key: 'luongThucLanh',
      width: 130,
      render: (luong) => (
        <span style={{ fontWeight: 'bold', color: '#1890ff' }}>
          {new Intl.NumberFormat('vi-VN').format(luong)} đ
        </span>
      )
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 120,
      render: (trangThai) => {
        const mauSac = {
          chua_thanh_toan: 'warning',
          da_thanh_toan: 'success',
          tam_ung: 'processing'
        };
        const tenTrangThai = {
          chua_thanh_toan: 'Chưa thanh toán',
          da_thanh_toan: 'Đã thanh toán',
          tam_ung: 'Tạm ứng'
        };
        return <Tag color={mauSac[trangThai]}>{tenTrangThai[trangThai]}</Tag>;
      }
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      width: 180,
      render: (_, record) => (
        <Space>
          <Button 
            size="small" 
            type="primary"
            icon={<CalculatorOutlined />} 
            onClick={() => xemChiTiet(record)}
          >
            Chi tiết
          </Button>
          <Button 
            size="small" 
            icon={<EditOutlined />} 
            onClick={() => suaLuong(record)}
          >
            Sửa
          </Button>
          <Button 
            size="small" 
            danger 
            icon={<DeleteOutlined />}
            onClick={() => xoaLuong(record.id)}
          >
            Xóa
          </Button>
        </Space>
      )
    }
  ];

  const tinhThongKe = () => {
    const thangHienTai = dayjs().format('YYYY-MM');
    const luongThangHienTai = danhSachLuong.filter(l => l.thangNam === thangHienTai);
    const tongLuongThang = luongThangHienTai.reduce((tong, l) => tong + l.luongThucLanh, 0);
    const luongDaThanhToan = luongThangHienTai.filter(l => l.trangThai === 'da_thanh_toan').length;
    const luongChuaThanhToan = luongThangHienTai.filter(l => l.trangThai === 'chua_thanh_toan').length;

    return { tongLuongThang, luongDaThanhToan, luongChuaThanhToan, tongBangLuong: luongThangHienTai.length };
  };

  const tinhLuong = () => {
    Modal.confirm({
      title: 'Tính lương tự động',
      content: 'Hệ thống sẽ tính lương cho tất cả nhân viên dựa trên số giờ làm việc. Bạn có muốn tiếp tục?',
      onOk: () => {
        const thangHienTai = dayjs().format('YYYY-MM');
        const luongTuDong = danhSachNhanVien.map(nv => {
          const luongCoBan = nv.luongCoBan;
          const phuCapChucVu = luongCoBan * 0.1; // 10% lương cơ bản
          const soNgayLam = Math.floor(Math.random() * 4) + 22; // 22-26 ngày
          const soGioLamThem = Math.floor(Math.random() * 30); // 0-30 giờ
          const luongLamThem = soGioLamThem * 50000; // 50k/giờ
          const thuong = Math.floor(Math.random() * 500000); // 0-500k
          const khauTru = Math.floor(Math.random() * 200000); // 0-200k
          const tamUng = Math.floor(Math.random() * 1000000); // 0-1M
          
          const tongLuong = luongCoBan + phuCapChucVu + luongLamThem + thuong - khauTru - tamUng;

          return {
            id: Date.now() + nv.id,
            nhanVienId: nv.id,
            hoTenNhanVien: nv.hoTen,
            thangNam: thangHienTai,
            luongCoBan,
            phuCapChucVu,
            phuCapKhac: 0,
            luongLamThem,
            thuong,
            khauTru,
            tamUng,
            luongThucLanh: tongLuong,
            soNgayLam,
            soGioLamThem,
            trangThai: 'chua_thanh_toan',
            ngayThanhToan: '',
            ghiChu: 'Tính tự động'
          };
        });

        setDanhSachLuong(prev => [
          ...prev.filter(l => l.thangNam !== thangHienTai),
          ...luongTuDong
        ]);
        message.success('Tính lương tự động thành công!');
      }
    });
  };

  const themLuong = () => {
    setLuongHienTai(null);
    form.resetFields();
    form.setFieldsValue({
      thangNam: dayjs().format('YYYY-MM'),
      trangThai: 'chua_thanh_toan'
    });
    setModalLuong(true);
  };

  const suaLuong = (luong) => {
    setLuongHienTai(luong);
    form.setFieldsValue(luong);
    setModalLuong(true);
  };

  const xemChiTiet = (luong) => {
    setChiTietLuong(luong);
    setModalChiTiet(true);
  };

  const luuLuong = (values) => {
    const nhanVien = danhSachNhanVien.find(nv => nv.id === values.nhanVienId);
    const luongThucLanh = values.luongCoBan + values.phuCapChucVu + (values.phuCapKhac || 0) + 
                         (values.luongLamThem || 0) + (values.thuong || 0) - 
                         (values.khauTru || 0) - (values.tamUng || 0);

    const luongMoi = {
      ...values,
      hoTenNhanVien: nhanVien.hoTen,
      luongThucLanh,
      phuCapKhac: values.phuCapKhac || 0,
      luongLamThem: values.luongLamThem || 0,
      thuong: values.thuong || 0,
      khauTru: values.khauTru || 0,
      tamUng: values.tamUng || 0
    };

    if (luongHienTai) {
      setDanhSachLuong(prev => 
        prev.map(l => l.id === luongHienTai.id ? { ...l, ...luongMoi } : l)
      );
      message.success('Cập nhật bảng lương thành công!');
    } else {
      const luongThemMoi = {
        id: Date.now(),
        ...luongMoi
      };
      setDanhSachLuong(prev => [...prev, luongThemMoi]);
      message.success('Thêm bảng lương thành công!');
    }
    setModalLuong(false);
  };

  const xoaLuong = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa bảng lương',
      content: 'Bạn có chắc chắn muốn xóa bảng lương này?',
      onOk: () => {
        setDanhSachLuong(prev => prev.filter(l => l.id !== id));
        message.success('Xóa bảng lương thành công!');
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
              title="Tổng lương tháng" 
              value={thongKe.tongLuongThang} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#1890ff' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Đã thanh toán" value={thongKe.luongDaThanhToan} valueStyle={{ color: '#3f8600' }} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Chưa thanh toán" value={thongKe.luongChuaThanhToan} valueStyle={{ color: '#cf1322' }} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Tổng bảng lương" value={thongKe.tongBangLuong} />
          </Card>
        </Col>
      </Row>

      <Card title="Quản lý lương" className="quan-ly-luong">
        <Row gutter={[16, 16]} style={{ marginBottom: 16 }}>
          <Col span={24}>
            <Space>
              <Button 
                type="primary" 
                icon={<PlusOutlined />} 
                onClick={themLuong}
              >
                Thêm bảng lương
              </Button>
              <Button 
                icon={<CalculatorOutlined />}
                onClick={tinhLuong}
              >
                Tính lương tự động
              </Button>
              <Button 
                icon={<DollarOutlined />}
              >
                Xuất báo cáo lương
              </Button>
            </Space>
          </Col>
        </Row>

        <Table
          columns={cotBang}
          dataSource={danhSachLuong}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total) => `Tổng ${total} bảng lương`
          }}
          scroll={{ x: 1500 }}
        />

        {/* Modal thêm/sửa lương */}
        <Modal
          title={luongHienTai ? "Sửa bảng lương" : "Thêm bảng lương mới"}
          open={modalLuong}
          onCancel={() => setModalLuong(false)}
          footer={null}
          width={800}
        >
          <Form
            form={form}
            layout="vertical"
            onFinish={luuLuong}
          >
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
                  name="thangNam"
                  label="Tháng/Năm"
                  rules={[{ required: true, message: 'Vui lòng nhập tháng năm!' }]}
                >
                  <Input placeholder="YYYY-MM" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="luongCoBan"
                  label="Lương cơ bản (VND)"
                  rules={[{ required: true, message: 'Vui lòng nhập lương cơ bản!' }]}
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="phuCapChucVu"
                  label="Phụ cấp chức vụ (VND)"
                  rules={[{ required: true, message: 'Vui lòng nhập phụ cấp!' }]}
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="phuCapKhac"
                  label="Phụ cấp khác (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="luongLamThem"
                  label="Lương làm thêm (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="thuong"
                  label="Thưởng (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="khauTru"
                  label="Khấu trừ (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="tamUng"
                  label="Tạm ứng (VND)"
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="soNgayLam"
                  label="Số ngày làm"
                >
                  <Input type="number" placeholder="26" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="soGioLamThem"
                  label="Số giờ làm thêm"
                >
                  <Input type="number" placeholder="0" />
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
                    <Option value="chua_thanh_toan">Chưa thanh toán</Option>
                    <Option value="da_thanh_toan">Đã thanh toán</Option>
                    <Option value="tam_ung">Tạm ứng</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="ngayThanhToan"
                  label="Ngày thanh toán"
                >
                  <Input placeholder="YYYY-MM-DD" />
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
                <Button onClick={() => setModalLuong(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  {luongHienTai ? 'Cập nhật' : 'Thêm mới'}
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>

        {/* Modal chi tiết lương */}
        <Modal
          title="Chi tiết bảng lương"
          open={modalChiTiet}
          onCancel={() => setModalChiTiet(false)}
          footer={[
            <Button key="close" onClick={() => setModalChiTiet(false)}>
              Đóng
            </Button>
          ]}
          width={600}
        >
          {chiTietLuong && (
            <Descriptions bordered column={2}>
              <Descriptions.Item label="Nhân viên" span={2}>
                {chiTietLuong.hoTenNhanVien}
              </Descriptions.Item>
              <Descriptions.Item label="Tháng/Năm">
                {chiTietLuong.thangNam}
              </Descriptions.Item>
              <Descriptions.Item label="Số ngày làm">
                {chiTietLuong.soNgayLam} ngày
              </Descriptions.Item>
              <Descriptions.Item label="Lương cơ bản">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.luongCoBan)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Phụ cấp chức vụ">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.phuCapChucVu)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Phụ cấp khác">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.phuCapKhac)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Lương làm thêm">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.luongLamThem)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Thưởng">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.thuong)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Khấu trừ">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.khauTru)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Tạm ứng">
                {new Intl.NumberFormat('vi-VN').format(chiTietLuong.tamUng)} đ
              </Descriptions.Item>
              <Descriptions.Item label="Lương thực lãnh" span={2}>
                <span style={{ fontSize: '18px', fontWeight: 'bold', color: '#1890ff' }}>
                  {new Intl.NumberFormat('vi-VN').format(chiTietLuong.luongThucLanh)} đ
                </span>
              </Descriptions.Item>
              <Descriptions.Item label="Trạng thái">
                <Tag color={chiTietLuong.trangThai === 'da_thanh_toan' ? 'success' : 'warning'}>
                  {chiTietLuong.trangThai === 'da_thanh_toan' ? 'Đã thanh toán' : 'Chưa thanh toán'}
                </Tag>
              </Descriptions.Item>
              <Descriptions.Item label="Ngày thanh toán">
                {chiTietLuong.ngayThanhToan || 'Chưa thanh toán'}
              </Descriptions.Item>
              <Descriptions.Item label="Ghi chú" span={2}>
                {chiTietLuong.ghiChu || 'Không có'}
              </Descriptions.Item>
            </Descriptions>
          )}
        </Modal>
      </Card>
    </div>
  );
};

export default QuanLyLuong;
