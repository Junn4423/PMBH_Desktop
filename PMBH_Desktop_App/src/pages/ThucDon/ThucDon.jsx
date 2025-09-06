import React, { useState, useEffect } from 'react';
import { Card, Table, Button, Modal, Form, Input, InputNumber, Select, Upload, Space, Typography, Image, message, Row, Col, Tag } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, UploadOutlined } from '@ant-design/icons';

const { Title } = Typography;
const { Option } = Select;

const ThucDon = () => {
  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [form] = Form.useForm();

  useEffect(() => {
    // Dữ liệu mẫu danh mục
    const sampleCategories = [
      { id: 1, ten: 'Cà phê', moTa: 'Các loại cà phê' },
      { id: 2, ten: 'Trà', moTa: 'Các loại trà' },
      { id: 3, ten: 'Nước ép', moTa: 'Nước ép trái cây' },
      { id: 4, ten: 'Bánh ngọt', moTa: 'Các loại bánh' },
      { id: 5, ten: 'Khác', moTa: 'Món khác' }
    ];

    // Dữ liệu mẫu sản phẩm
    const sampleProducts = [
      {
        id: 1,
        ten: 'Cà phê đen',
        gia: 15000,
        danhMuc: 'Cà phê',
        moTa: 'Cà phê đen truyền thống',
        trangThai: 'active',
        hinhAnh: null
      },
      {
        id: 2,
        ten: 'Cà phê sữa',
        gia: 18000,
        danhMuc: 'Cà phê',
        moTa: 'Cà phê sữa đậm đà',
        trangThai: 'active',
        hinhAnh: null
      },
      {
        id: 3,
        ten: 'Trà sữa',
        gia: 25000,
        danhMuc: 'Trà',
        moTa: 'Trà sữa thơm ngon',
        trangThai: 'active',
        hinhAnh: null
      },
      {
        id: 4,
        ten: 'Nước ép cam',
        gia: 20000,
        danhMuc: 'Nước ép',
        moTa: 'Nước ép cam tươi',
        trangThai: 'active',
        hinhAnh: null
      },
      {
        id: 5,
        ten: 'Bánh tiramisu',
        gia: 35000,
        danhMuc: 'Bánh ngọt',
        moTa: 'Bánh tiramisu Italy',
        trangThai: 'active',
        hinhAnh: null
      }
    ];

    setCategories(sampleCategories);
    setProducts(sampleProducts);
  }, []);

  const handleAddNew = () => {
    setEditingProduct(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    setEditingProduct(record);
    form.setFieldsValue(record);
    setIsModalVisible(true);
  };

  const handleDelete = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa',
      content: 'Bạn có chắc chắn muốn xóa món này?',
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: () => {
        setProducts(products.filter(product => product.id !== id));
        message.success('Đã xóa món thành công');
      }
    });
  };

  const handleSave = async (values) => {
    try {
      if (editingProduct) {
        setProducts(products.map(product => 
          product.id === editingProduct.id 
            ? { ...product, ...values }
            : product
        ));
        message.success('Đã cập nhật món thành công');
      } else {
        const newProduct = {
          id: Math.max(...products.map(p => p.id)) + 1,
          ...values,
          trangThai: 'active'
        };
        setProducts([...products, newProduct]);
        message.success('Đã thêm món mới thành công');
      }
      
      setIsModalVisible(false);
      form.resetFields();
    } catch (error) {
      message.error('Đã xảy ra lỗi');
    }
  };

  const columns = [
    {
      title: 'Hình ảnh',
      dataIndex: 'hinhAnh',
      key: 'hinhAnh',
      width: 80,
      render: (image, record) => (
        <div style={{ 
          width: 60, 
          height: 60, 
          borderRadius: '50%',
          background: 'linear-gradient(135deg, #1890ff, #096dd9)',
          color: 'white',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          fontWeight: 'bold',
          fontSize: '18px'
        }}>
          {record.ten.charAt(0)}
        </div>
      ),
    },
    {
      title: 'Tên món',
      dataIndex: 'ten',
      key: 'ten',
      sorter: (a, b) => a.ten.localeCompare(b.ten),
    },
    {
      title: 'Danh mục',
      dataIndex: 'danhMuc',
      key: 'danhMuc',
      filters: categories.map(cat => ({
        text: cat.ten,
        value: cat.ten,
      })),
      onFilter: (value, record) => record.danhMuc === value,
    },
    {
      title: 'Giá',
      dataIndex: 'gia',
      key: 'gia',
      render: (price) => `${price.toLocaleString()}đ`,
      sorter: (a, b) => a.gia - b.gia,
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: (status) => (
        <Tag color={status === 'active' ? 'success' : 'error'}>
          {status === 'active' ? 'Đang bán' : 'Ngừng bán'}
        </Tag>
      ),
      filters: [
        { text: 'Đang bán', value: 'active' },
        { text: 'Ngừng bán', value: 'inactive' },
      ],
      onFilter: (value, record) => record.trangThai === value,
    },
    {
      title: 'Mô tả',
      dataIndex: 'moTa',
      key: 'moTa',
    },
    {
      title: 'Thao tác',
      key: 'action',
      render: (_, record) => (
        <Space size="middle">
          <Button
            type="link"
            icon={<EditOutlined />}
            onClick={() => handleEdit(record)}
          >
            Sửa
          </Button>
          <Button
            type="link"
            danger
            icon={<DeleteOutlined />}
            onClick={() => handleDelete(record.id)}
          >
            Xóa
          </Button>
        </Space>
      ),
    },
  ];

  return (
    <div className="thuc-don">
      <div className="page-header">
        <Title level={2}>Quản lý thực đơn</Title>
        <Button
          type="primary"
          icon={<PlusOutlined />}
          onClick={handleAddNew}
        >
          Thêm món mới
        </Button>
      </div>

      <Card>
        <Table
          columns={columns}
          dataSource={products}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} món`,
          }}
        />
      </Card>

      <Modal
        title={editingProduct ? 'Sửa món' : 'Thêm món mới'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
        }}
        footer={null}
        width={600}
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSave}
        >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="ten"
                label="Tên món"
                rules={[
                  { required: true, message: 'Vui lòng nhập tên món!' }
                ]}
              >
                <Input placeholder="Tên món" />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="danhMuc"
                label="Danh mục"
                rules={[
                  { required: true, message: 'Vui lòng chọn danh mục!' }
                ]}
              >
                <Select placeholder="Chọn danh mục">
                  {categories.map(category => (
                    <Option key={category.id} value={category.ten}>
                      {category.ten}
                    </Option>
                  ))}
                </Select>
              </Form.Item>
            </Col>
          </Row>

          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="gia"
                label="Giá"
                rules={[
                  { required: true, message: 'Vui lòng nhập giá!' }
                ]}
              >
                <InputNumber
                  min={0}
                  placeholder="Giá"
                  style={{ width: '100%' }}
                  formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                  parser={value => value.replace(/\$\s?|(,*)/g, '')}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="trangThai"
                label="Trạng thái"
                initialValue="active"
              >
                <Select>
                  <Option value="active">Đang bán</Option>
                  <Option value="inactive">Ngừng bán</Option>
                </Select>
              </Form.Item>
            </Col>
          </Row>

          <Form.Item
            name="moTa"
            label="Mô tả"
          >
            <Input.TextArea
              rows={3}
              placeholder="Mô tả về món ăn..."
            />
          </Form.Item>

          <Form.Item
            name="hinhAnh"
            label="Hình ảnh"
          >
            <Upload
              listType="picture-card"
              maxCount={1}
              beforeUpload={() => false}
            >
              <div>
                <UploadOutlined />
                <div style={{ marginTop: 8 }}>Tải ảnh</div>
              </div>
            </Upload>
          </Form.Item>

          <Form.Item>
            <Space>
              <Button type="primary" htmlType="submit">
                {editingProduct ? 'Cập nhật' : 'Thêm mới'}
              </Button>
              <Button onClick={() => {
                setIsModalVisible(false);
                form.resetFields();
              }}>
                Hủy
              </Button>
            </Space>
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default ThucDon;
