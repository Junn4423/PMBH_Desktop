import React, { useState, useEffect } from 'react';
import { Card, Table, Button, Modal, Form, Input, InputNumber, Select, Upload, Space, Typography, Image, message, Row, Col, Tag, Spin } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, UploadOutlined, ReloadOutlined } from '@ant-design/icons';
import { getLoaiSanPham, getAllSanPham, getSanPhamTheoIdLoai } from '../../services/apiServices';

const { Title } = Typography;
const { Option } = Select;

const ThucDon = () => {
  const [products, setProducts] = useState([]);
  const [categories, setCategories] = useState([]);
  const [loading, setLoading] = useState(false);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [form] = Form.useForm();

  useEffect(() => {
    loadData();
  }, []);

  const loadData = async () => {
    setLoading(true);
    try {
      // Load categories và products đồng thời
      const [categoriesResult, productsResult] = await Promise.all([
        getLoaiSanPham(),
        getAllSanPham()
      ]);

      if (categoriesResult && Array.isArray(categoriesResult)) {
        setCategories(categoriesResult);
      }

      if (productsResult && Array.isArray(productsResult)) {
        setProducts(productsResult);
      }
    } catch (error) {
      console.error('Error loading menu data:', error);
      message.error('Không thể tải dữ liệu thực đơn');
    } finally {
      setLoading(false);
    }
  };

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
      onOk: async () => {
        try {
          // TODO: Implement API call để xóa sản phẩm
          // await deleteSanPham(id);
          
          setProducts(products.filter(product => product.id !== id));
          message.success('Đã xóa món thành công');
        } catch (error) {
          console.error('Error deleting product:', error);
          message.error('Có lỗi xảy ra khi xóa món');
        }
      }
    });
  };

  const handleSave = async (values) => {
    try {
      setLoading(true);
      
      if (editingProduct) {
        // TODO: Implement API call để update sản phẩm
        // await updateSanPham(editingProduct.id, values);
        
        setProducts(products.map(product => 
          product.id === editingProduct.id 
            ? { ...product, ...values }
            : product
        ));
        message.success('Đã cập nhật món thành công');
      } else {
        // TODO: Implement API call để thêm sản phẩm mới
        // const newProduct = await addSanPham(values);
        
        const newProduct = {
          id: Date.now(), // Temporary ID
          ...values,
          trangThai: 'active'
        };
        setProducts([...products, newProduct]);
        message.success('Đã thêm món mới thành công');
      }
      
      setIsModalVisible(false);
      form.resetFields();
    } catch (error) {
      console.error('Error saving product:', error);
      message.error('Có lỗi xảy ra khi lưu món');
    } finally {
      setLoading(false);
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
          {(record.tenSanPham || record.ten || 'N/A').charAt(0)}
        </div>
      ),
    },
    {
      title: 'Tên món',
      dataIndex: 'tenSanPham',
      key: 'tenSanPham',
      render: (text, record) => record.tenSanPham || record.ten || 'N/A',
      sorter: (a, b) => (a.tenSanPham || a.ten || '').localeCompare(b.tenSanPham || b.ten || ''),
    },
    {
      title: 'Danh mục',
      dataIndex: 'danhMuc',
      key: 'danhMuc',
      filters: categories.map(cat => ({
        text: cat.tenLoai || cat.ten || cat.name,
        value: cat.id || cat.idLoai,
      })),
      onFilter: (value, record) => record.idLoai === value || record.danhMuc === value,
    },
    {
      title: 'Giá',
      dataIndex: 'gia',
      key: 'gia',
      render: (price) => `${(price || 0).toLocaleString()}đ`,
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
      <style jsx>{`
        .page-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 24px;
        }
        .page-header h2 {
          margin: 0;
        }
      `}</style>
      <div className="page-header">
        <Title level={2}>Quản lý thực đơn</Title>
        <Space>
          <Button
            icon={<ReloadOutlined />}
            onClick={loadData}
            loading={loading}
          >
            Làm mới
          </Button>
          <Button
            type="primary"
            icon={<PlusOutlined />}
            onClick={handleAddNew}
          >
            Thêm món mới
          </Button>
        </Space>
      </div>

      <Card>
        <Spin spinning={loading}>
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
        </Spin>
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
                    <Option key={category.id || category.idLoai} value={category.id || category.idLoai}>
                      {category.tenLoai || category.ten || category.name}
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
