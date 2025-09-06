import React, { useState, useEffect } from 'react';
import { 
  Table, Button, Modal, Form, Input, Select, 
  Space, Popconfirm, message, Row, Col, Card,
  InputNumber, Upload, Image
} from 'antd';
import {
  PlusOutlined,
  EditOutlined,
  DeleteOutlined,
  UploadOutlined,
  SearchOutlined
} from '@ant-design/icons';

const { Option } = Select;

const QuanLySanPham = () => {
  const [danhSachSanPham, setDanhSachSanPham] = useState([]);
  const [hienThiModal, setHienThiModal] = useState(false);
  const [chinhSua, setChinhSua] = useState(false);
  const [sanPhamHienTai, setSanPhamHienTai] = useState(null);
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);

  const danhMucSanPham = [
    { value: 'cafe', label: 'Cà phê' },
    { value: 'tra', label: 'Trà' },
    { value: 'nuoc_ep', label: 'Nước ép' },
    { value: 'banh_ngot', label: 'Bánh ngọt' },
    { value: 'do_an_nhe', label: 'Đồ ăn nhẹ' }
  ];

  useEffect(() => {
    taiDanhSachSanPham();
  }, []);

  const taiDanhSachSanPham = async () => {
    setLoading(true);
    try {
      // Gọi API lấy danh sách sản phẩm
      // const response = await api.get('/san-pham');
      // setDanhSachSanPham(response.data);
      
      // Demo data
      setDanhSachSanPham([
        {
          key: '1',
          maSanPham: 'SP001',
          tenSanPham: 'Cà phê đen',
          danhMuc: 'cafe',
          donVi: 'ly',
          giaNhap: 15000,
          giaBan: 25000,
          tonKho: 100,
          hinhAnh: null,
          moTa: 'Cà phê đen truyền thống'
        },
        {
          key: '2', 
          maSanPham: 'SP002',
          tenSanPham: 'Cà phê sữa',
          danhMuc: 'cafe',
          donVi: 'ly',
          giaNhap: 18000,
          giaBan: 30000,
          tonKho: 85,
          hinhAnh: null,
          moTa: 'Cà phê sữa đá'
        }
      ]);
    } catch (error) {
      console.error('Lỗi tải danh sách sản phẩm:', error);
      message.error('Không thể tải danh sách sản phẩm');
    } finally {
      setLoading(false);
    }
  };

  const moModalThem = () => {
    setChinhSua(false);
    setSanPhamHienTai(null);
    form.resetFields();
    setHienThiModal(true);
  };

  const moModalSua = (sanPham) => {
    setChinhSua(true);
    setSanPhamHienTai(sanPham);
    form.setFieldsValue(sanPham);
    setHienThiModal(true);
  };

  const dongModal = () => {
    setHienThiModal(false);
    form.resetFields();
    setSanPhamHienTai(null);
  };

  const luuSanPham = async (values) => {
    try {
      if (chinhSua) {
        // Cập nhật sản phẩm
        // await api.put(`/san-pham/${sanPhamHienTai.key}`, values);
        const capNhatDanhSach = danhSachSanPham.map(sp => 
          sp.key === sanPhamHienTai.key ? { ...sp, ...values } : sp
        );
        setDanhSachSanPham(capNhatDanhSach);
        message.success('Cập nhật sản phẩm thành công');
      } else {
        // Thêm sản phẩm mới
        const sanPhamMoi = {
          key: Date.now().toString(),
          maSanPham: values.maSanPham,
          ...values
        };
        // await api.post('/san-pham', sanPhamMoi);
        setDanhSachSanPham([...danhSachSanPham, sanPhamMoi]);
        message.success('Thêm sản phẩm thành công');
      }
      dongModal();
    } catch (error) {
      console.error('Lỗi lưu sản phẩm:', error);
      message.error('Không thể lưu sản phẩm');
    }
  };

  const xoaSanPham = async (maSanPham) => {
    try {
      // await api.delete(`/san-pham/${maSanPham}`);
      const danhSachMoi = danhSachSanPham.filter(sp => sp.key !== maSanPham);
      setDanhSachSanPham(danhSachMoi);
      message.success('Xóa sản phẩm thành công');
    } catch (error) {
      console.error('Lỗi xóa sản phẩm:', error);
      message.error('Không thể xóa sản phẩm');
    }
  };

  const cotBang = [
    {
      title: 'Mã sản phẩm',
      dataIndex: 'maSanPham',
      key: 'maSanPham',
      width: 120,
    },
    {
      title: 'Tên sản phẩm',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
      width: 200,
    },
    {
      title: 'Danh mục',
      dataIndex: 'danhMuc',
      key: 'danhMuc',
      width: 120,
      render: (danhMuc) => {
        const timDanhMuc = danhMucSanPham.find(dm => dm.value === danhMuc);
        return timDanhMuc ? timDanhMuc.label : danhMuc;
      }
    },
    {
      title: 'Đơn vị',
      dataIndex: 'donVi',
      key: 'donVi',
      width: 80,
    },
    {
      title: 'Giá nhập',
      dataIndex: 'giaNhap',
      key: 'giaNhap',
      width: 100,
      render: (gia) => `${gia?.toLocaleString()}đ`
    },
    {
      title: 'Giá bán',
      dataIndex: 'giaBan',
      key: 'giaBan',
      width: 100,
      render: (gia) => `${gia?.toLocaleString()}đ`
    },
    {
      title: 'Tồn kho',
      dataIndex: 'tonKho',
      key: 'tonKho',
      width: 80,
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
            title="Bạn có chắc muốn xóa sản phẩm này?"
            onConfirm={() => xoaSanPham(record.key)}
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
          <h2>Quản lý sản phẩm</h2>
        </Col>
        <Col>
          <Button 
            type="primary" 
            icon={<PlusOutlined />}
            onClick={moModalThem}
          >
            Thêm sản phẩm
          </Button>
        </Col>
      </Row>

      <Card>
        <Table
          columns={cotBang}
          dataSource={danhSachSanPham}
          loading={loading}
          scroll={{ x: 1000 }}
          pagination={{
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} sản phẩm`,
          }}
        />
      </Card>

      {/* Modal thêm/sửa sản phẩm */}
      <Modal
        title={chinhSua ? 'Chỉnh sửa sản phẩm' : 'Thêm sản phẩm mới'}
        open={hienThiModal}
        onCancel={dongModal}
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
                rules={[
                  { required: true, message: 'Vui lòng nhập mã sản phẩm' }
                ]}
              >
                <Input placeholder="Nhập mã sản phẩm" />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="tenSanPham"
                label="Tên sản phẩm"
                rules={[
                  { required: true, message: 'Vui lòng nhập tên sản phẩm' }
                ]}
              >
                <Input placeholder="Nhập tên sản phẩm" />
              </Form.Item>
            </Col>
          </Row>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="danhMuc"
                label="Danh mục"
                rules={[
                  { required: true, message: 'Vui lòng chọn danh mục' }
                ]}
              >
                <Select placeholder="Chọn danh mục">
                  {danhMucSanPham.map(dm => (
                    <Option key={dm.value} value={dm.value}>
                      {dm.label}
                    </Option>
                  ))}
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="donVi"
                label="Đơn vị"
                rules={[
                  { required: true, message: 'Vui lòng nhập đơn vị' }
                ]}
              >
                <Input placeholder="Nhập đơn vị (ly, phần, ...)" />
              </Form.Item>
            </Col>
          </Row>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="giaNhap"
                label="Giá nhập"
                rules={[
                  { required: true, message: 'Vui lòng nhập giá nhập' }
                ]}
              >
                <InputNumber
                  style={{ width: '100%' }}
                  placeholder="Nhập giá nhập"
                  formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                  parser={value => value.replace(/\$\s?|(,*)/g, '')}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="giaBan"
                label="Giá bán"
                rules={[
                  { required: true, message: 'Vui lòng nhập giá bán' }
                ]}
              >
                <InputNumber
                  style={{ width: '100%' }}
                  placeholder="Nhập giá bán"
                  formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                  parser={value => value.replace(/\$\s?|(,*)/g, '')}
                />
              </Form.Item>
            </Col>
          </Row>

          <Form.Item
            name="tonKho"
            label="Tồn kho"
          >
            <InputNumber
              style={{ width: '100%' }}
              placeholder="Nhập số lượng tồn kho"
              min={0}
            />
          </Form.Item>

          <Form.Item
            name="moTa"
            label="Mô tả"
          >
            <Input.TextArea 
              rows={3} 
              placeholder="Nhập mô tả sản phẩm" 
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

export default QuanLySanPham;
