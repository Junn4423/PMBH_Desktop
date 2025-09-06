import React, { useState, useEffect } from 'react';
import { Table, Card, Button, Modal, Form, Input, DatePicker, Space, message, Row, Col, Statistic, Tag } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, EyeOutlined } from '@ant-design/icons';
import dayjs from 'dayjs';

const QuanLyKho = () => {
  const [danhSachSanPham, setDanhSachSanPham] = useState([]);
  const [modalSanPham, setModalSanPham] = useState(false);
  const [modalNhapKho, setModalNhapKho] = useState(false);
  const [modalXuatKho, setModalXuatKho] = useState(false);
  const [sanPhamHienTai, setSanPhamHienTai] = useState(null);
  const [form] = Form.useForm();
  const [formNhapKho] = Form.useForm();
  const [formXuatKho] = Form.useForm();

  // Dữ liệu mẫu sản phẩm trong kho
  useEffect(() => {
    const sanPhamMau = [
      {
        id: 1,
        maSanPham: 'SP001',
        tenSanPham: 'Cà phê đen',
        loaiSanPham: 'Đồ uống',
        donVi: 'Ly',
        soLuongTon: 150,
        soLuongToiThieu: 20,
        giaNhap: 15000,
        giaBan: 25000,
        ngayCapNhat: '2024-12-20',
        trangThai: 'con_hang'
      },
      {
        id: 2,
        maSanPham: 'SP002',
        tenSanPham: 'Bánh mì thịt nướng',
        loaiSanPham: 'Đồ ăn',
        donVi: 'Chiếc',
        soLuongTon: 35,
        soLuongToiThieu: 10,
        giaNhap: 12000,
        giaBan: 20000,
        ngayCapNhat: '2024-12-20',
        trangThai: 'con_hang'
      },
      {
        id: 3,
        maSanPham: 'SP003',
        tenSanPham: 'Trà sữa trân châu',
        loaiSanPham: 'Đồ uống',
        donVi: 'Ly',
        soLuongTon: 8,
        soLuongToiThieu: 15,
        giaNhap: 18000,
        giaBan: 35000,
        ngayCapNhat: '2024-12-19',
        trangThai: 'sap_het'
      },
      {
        id: 4,
        maSanPham: 'SP004',
        tenSanPham: 'Bánh ngọt chocolate',
        loaiSanPham: 'Đồ ăn',
        donVi: 'Chiếc',
        soLuongTon: 0,
        soLuongToiThieu: 5,
        giaNhap: 25000,
        giaBan: 45000,
        ngayCapNhat: '2024-12-18',
        trangThai: 'het_hang'
      }
    ];
    setDanhSachSanPham(sanPhamMau);
  }, []);

  const cotBang = [
    {
      title: 'Mã SP',
      dataIndex: 'maSanPham',
      key: 'maSanPham',
      width: 100,
    },
    {
      title: 'Tên sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
      width: 200,
    },
    {
      title: 'Loại',
      dataIndex: 'loaiSanPham',
      key: 'loaiSanPham',
      width: 120,
    },
    {
      title: 'Đơn vị',
      dataIndex: 'donVi',
      key: 'donVi',
      width: 80,
    },
    {
      title: 'Tồn kho',
      dataIndex: 'soLuongTon',
      key: 'soLuongTon',
      width: 100,
      render: (soLuong, record) => (
        <span style={{ 
          color: soLuong === 0 ? 'red' : 
                 soLuong <= record.soLuongToiThieu ? 'orange' : 'green',
          fontWeight: 'bold'
        }}>
          {soLuong}
        </span>
      )
    },
    {
      title: 'Tối thiểu',
      dataIndex: 'soLuongToiThieu',
      key: 'soLuongToiThieu',
      width: 100,
    },
    {
      title: 'Giá nhập',
      dataIndex: 'giaNhap',
      key: 'giaNhap',
      width: 120,
      render: (gia) => new Intl.NumberFormat('vi-VN').format(gia) + ' đ'
    },
    {
      title: 'Giá bán',
      dataIndex: 'giaBan',
      key: 'giaBan',
      width: 120,
      render: (gia) => new Intl.NumberFormat('vi-VN').format(gia) + ' đ'
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 120,
      render: (trangThai) => {
        const mauSac = {
          con_hang: 'green',
          sap_het: 'orange',
          het_hang: 'red'
        };
        const tenTrangThai = {
          con_hang: 'Còn hàng',
          sap_het: 'Sắp hết',
          het_hang: 'Hết hàng'
        };
        return <Tag color={mauSac[trangThai]}>{tenTrangThai[trangThai]}</Tag>;
      }
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
            onClick={() => nhapKho(record)}
          >
            Nhập
          </Button>
          <Button 
            size="small" 
            onClick={() => xuatKho(record)}
          >
            Xuất
          </Button>
          <Button 
            size="small" 
            icon={<EditOutlined />} 
            onClick={() => suaSanPham(record)}
          >
            Sửa
          </Button>
        </Space>
      )
    }
  ];

  const tinhThongKe = () => {
    const tongSanPham = danhSachSanPham.length;
    const sanPhamConHang = danhSachSanPham.filter(sp => sp.trangThai === 'con_hang').length;
    const sanPhamSapHet = danhSachSanPham.filter(sp => sp.trangThai === 'sap_het').length;
    const sanPhamHetHang = danhSachSanPham.filter(sp => sp.trangThai === 'het_hang').length;
    const tongGiaTriKho = danhSachSanPham.reduce((tong, sp) => tong + (sp.soLuongTon * sp.giaNhap), 0);

    return { tongSanPham, sanPhamConHang, sanPhamSapHet, sanPhamHetHang, tongGiaTriKho };
  };

  const themSanPham = () => {
    setSanPhamHienTai(null);
    form.resetFields();
    setModalSanPham(true);
  };

  const suaSanPham = (sanPham) => {
    setSanPhamHienTai(sanPham);
    form.setFieldsValue(sanPham);
    setModalSanPham(true);
  };

  const nhapKho = (sanPham) => {
    setSanPhamHienTai(sanPham);
    formNhapKho.resetFields();
    formNhapKho.setFieldsValue({
      tenSanPham: sanPham.tenSanPham,
      soLuongHienTai: sanPham.soLuongTon,
      ngayNhap: dayjs()
    });
    setModalNhapKho(true);
  };

  const xuatKho = (sanPham) => {
    setSanPhamHienTai(sanPham);
    formXuatKho.resetFields();
    formXuatKho.setFieldsValue({
      tenSanPham: sanPham.tenSanPham,
      soLuongHienTai: sanPham.soLuongTon,
      ngayXuat: dayjs()
    });
    setModalXuatKho(true);
  };

  const luuSanPham = (values) => {
    const trangThai = values.soLuongTon === 0 ? 'het_hang' : 
                     values.soLuongTon <= values.soLuongToiThieu ? 'sap_het' : 'con_hang';

    if (sanPhamHienTai) {
      setDanhSachSanPham(prev => 
        prev.map(sp => sp.id === sanPhamHienTai.id ? 
          { ...sp, ...values, trangThai, ngayCapNhat: dayjs().format('YYYY-MM-DD') } : sp
        )
      );
      message.success('Cập nhật sản phẩm thành công!');
    } else {
      const sanPhamMoi = {
        id: Date.now(),
        ...values,
        trangThai,
        ngayCapNhat: dayjs().format('YYYY-MM-DD')
      };
      setDanhSachSanPham(prev => [...prev, sanPhamMoi]);
      message.success('Thêm sản phẩm thành công!');
    }
    setModalSanPham(false);
  };

  const luuNhapKho = (values) => {
    const soLuongMoi = sanPhamHienTai.soLuongTon + values.soLuongNhap;
    const trangThai = soLuongMoi === 0 ? 'het_hang' : 
                     soLuongMoi <= sanPhamHienTai.soLuongToiThieu ? 'sap_het' : 'con_hang';

    setDanhSachSanPham(prev =>
      prev.map(sp => 
        sp.id === sanPhamHienTai.id ? 
          { ...sp, soLuongTon: soLuongMoi, trangThai, ngayCapNhat: dayjs().format('YYYY-MM-DD') } : sp
      )
    );
    message.success(`Nhập kho thành công! Số lượng mới: ${soLuongMoi}`);
    setModalNhapKho(false);
  };

  const luuXuatKho = (values) => {
    if (values.soLuongXuat > sanPhamHienTai.soLuongTon) {
      message.error('Số lượng xuất không được lớn hơn số lượng tồn kho!');
      return;
    }

    const soLuongMoi = sanPhamHienTai.soLuongTon - values.soLuongXuat;
    const trangThai = soLuongMoi === 0 ? 'het_hang' : 
                     soLuongMoi <= sanPhamHienTai.soLuongToiThieu ? 'sap_het' : 'con_hang';

    setDanhSachSanPham(prev =>
      prev.map(sp => 
        sp.id === sanPhamHienTai.id ? 
          { ...sp, soLuongTon: soLuongMoi, trangThai, ngayCapNhat: dayjs().format('YYYY-MM-DD') } : sp
      )
    );
    message.success(`Xuất kho thành công! Số lượng còn lại: ${soLuongMoi}`);
    setModalXuatKho(false);
  };

  const thongKe = tinhThongKe();

  return (
    <div style={{ padding: 24 }}>
      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: 24 }}>
        <Col span={6}>
          <Card>
            <Statistic title="Tổng sản phẩm" value={thongKe.tongSanPham} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Còn hàng" value={thongKe.sanPhamConHang} valueStyle={{ color: '#3f8600' }} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic title="Sắp hết" value={thongKe.sanPhamSapHet} valueStyle={{ color: '#cf1322' }} />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Giá trị kho" 
              value={thongKe.tongGiaTriKho} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
            />
          </Card>
        </Col>
      </Row>

      <Card title="Quản lý kho" className="quan-ly-kho">
        <Row gutter={[16, 16]} style={{ marginBottom: 16 }}>
          <Col span={24}>
            <Button 
              type="primary" 
              icon={<PlusOutlined />} 
              onClick={themSanPham}
            >
              Thêm sản phẩm mới
            </Button>
          </Col>
        </Row>

        <Table
          columns={cotBang}
          dataSource={danhSachSanPham}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total) => `Tổng ${total} sản phẩm`
          }}
        />

        {/* Modal thêm/sửa sản phẩm */}
        <Modal
          title={sanPhamHienTai ? "Sửa sản phẩm" : "Thêm sản phẩm mới"}
          open={modalSanPham}
          onCancel={() => setModalSanPham(false)}
          footer={null}
          width={600}
        >
          <Form
            form={form}
            layout="vertical"
            onFinish={luuSanPham}
          >
            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="maSanPham"
                  label="Mã sản phẩm"
                  rules={[{ required: true, message: 'Vui lòng nhập mã sản phẩm!' }]}
                >
                  <Input placeholder="Nhập mã sản phẩm" />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="tenSanPham"
                  label="Tên sản phẩm"
                  rules={[{ required: true, message: 'Vui lòng nhập tên sản phẩm!' }]}
                >
                  <Input placeholder="Nhập tên sản phẩm" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="loaiSanPham"
                  label="Loại sản phẩm"
                  rules={[{ required: true, message: 'Vui lòng nhập loại sản phẩm!' }]}
                >
                  <Input placeholder="Ví dụ: Đồ uống, Đồ ăn" />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="donVi"
                  label="Đơn vị tính"
                  rules={[{ required: true, message: 'Vui lòng nhập đơn vị!' }]}
                >
                  <Input placeholder="Ví dụ: Ly, Chiếc, Kg" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="soLuongTon"
                  label="Số lượng tồn"
                  rules={[{ required: true, message: 'Vui lòng nhập số lượng!' }]}
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="soLuongToiThieu"
                  label="Số lượng tối thiểu"
                  rules={[{ required: true, message: 'Vui lòng nhập số lượng tối thiểu!' }]}
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="giaNhap"
                  label="Giá nhập"
                  rules={[{ required: true, message: 'Vui lòng nhập giá nhập!' }]}
                >
                  <Input type="number" placeholder="0" />
                </Form.Item>
              </Col>
            </Row>

            <Form.Item
              name="giaBan"
              label="Giá bán"
              rules={[{ required: true, message: 'Vui lòng nhập giá bán!' }]}
            >
              <Input type="number" placeholder="0" />
            </Form.Item>

            <Form.Item style={{ marginBottom: 0, textAlign: 'right' }}>
              <Space>
                <Button onClick={() => setModalSanPham(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  {sanPhamHienTai ? 'Cập nhật' : 'Thêm mới'}
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>

        {/* Modal nhập kho */}
        <Modal
          title="Nhập kho"
          open={modalNhapKho}
          onCancel={() => setModalNhapKho(false)}
          footer={null}
          width={500}
        >
          <Form
            form={formNhapKho}
            layout="vertical"
            onFinish={luuNhapKho}
          >
            <Form.Item name="tenSanPham" label="Sản phẩm">
              <Input disabled />
            </Form.Item>

            <Form.Item name="soLuongHienTai" label="Số lượng hiện tại">
              <Input disabled />
            </Form.Item>

            <Form.Item
              name="soLuongNhap"
              label="Số lượng nhập"
              rules={[
                { required: true, message: 'Vui lòng nhập số lượng!' },
                { type: 'number', min: 1, message: 'Số lượng phải lớn hơn 0!' }
              ]}
            >
              <Input type="number" placeholder="Nhập số lượng cần nhập" />
            </Form.Item>

            <Form.Item name="ngayNhap" label="Ngày nhập">
              <DatePicker style={{ width: '100%' }} />
            </Form.Item>

            <Form.Item name="ghiChu" label="Ghi chú">
              <Input.TextArea rows={3} placeholder="Ghi chú thêm (tùy chọn)" />
            </Form.Item>

            <Form.Item style={{ marginBottom: 0, textAlign: 'right' }}>
              <Space>
                <Button onClick={() => setModalNhapKho(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  Nhập kho
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>

        {/* Modal xuất kho */}
        <Modal
          title="Xuất kho"
          open={modalXuatKho}
          onCancel={() => setModalXuatKho(false)}
          footer={null}
          width={500}
        >
          <Form
            form={formXuatKho}
            layout="vertical"
            onFinish={luuXuatKho}
          >
            <Form.Item name="tenSanPham" label="Sản phẩm">
              <Input disabled />
            </Form.Item>

            <Form.Item name="soLuongHienTai" label="Số lượng hiện tại">
              <Input disabled />
            </Form.Item>

            <Form.Item
              name="soLuongXuat"
              label="Số lượng xuất"
              rules={[
                { required: true, message: 'Vui lòng nhập số lượng!' },
                { type: 'number', min: 1, message: 'Số lượng phải lớn hơn 0!' }
              ]}
            >
              <Input type="number" placeholder="Nhập số lượng cần xuất" />
            </Form.Item>

            <Form.Item name="ngayXuat" label="Ngày xuất">
              <DatePicker style={{ width: '100%' }} />
            </Form.Item>

            <Form.Item name="lyDoXuat" label="Lý do xuất">
              <Input placeholder="Ví dụ: Bán hàng, Hư hỏng, Khuyến mãi" />
            </Form.Item>

            <Form.Item style={{ marginBottom: 0, textAlign: 'right' }}>
              <Space>
                <Button onClick={() => setModalXuatKho(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  Xuất kho
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>
      </Card>
    </div>
  );
};

export default QuanLyKho;
