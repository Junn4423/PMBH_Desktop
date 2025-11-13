import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Button, Table, Modal, Form, Input, message, Space, Popconfirm } from 'antd';
import { Tags, Plus, Edit, Trash2, Search } from 'lucide-react';
import {
  getProductCategories,
  createProductCategory,
  updateProductCategory,
  deleteProductCategory
} from '../../services/domains/catalogService';
import './LoaiSanPham.css';

const LoaiSanPham = () => {
  const [categories, setCategories] = useState([]);
  const [loading, setLoading] = useState(false);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingCategory, setEditingCategory] = useState(null);
  const [searchText, setSearchText] = useState('');
  const [form] = Form.useForm();

  useEffect(() => {
    loadCategories();
  }, []);

  const loadCategories = async () => {
    try {
      setLoading(true);
  const response = await getProductCategories();
      
      let categoriesData = [];
      if (Array.isArray(response)) {
        categoriesData = response;
      } else if (response && response.success && response.data) {
        if (Array.isArray(response.data)) {
          categoriesData = response.data;
        } else if (typeof response.data === 'object') {
          categoriesData = Object.values(response.data);
        }
      } else if (response && typeof response === 'object') {
        categoriesData = Object.values(response);
      }
      
      setCategories(categoriesData);
    } catch (error) {
      message.error('Không thể tải danh sách loại sản phẩm');
      console.error('Error loading categories:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleAdd = () => {
    setEditingCategory(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    setEditingCategory(record);
    form.setFieldsValue({
      lv001: record.lv001 || record.idLoaiSp || record.id || record.maLoai,
      lv002: record.lv002 || record.tenLoaiSp || record.ten || record.tenLoai,
      lv003: record.lv003 || record.moTa || '',
      lv004: record.lv004 || '',
      lv005: record.lv005 || ''
    });
    setIsModalVisible(true);
  };

  const handleDelete = async (record) => {
    try {
      const id = record.lv001 || record.idLoaiSp || record.id || record.maLoai;
  await deleteProductCategory(id);
      message.success('Xóa loại sản phẩm thành công');
      loadCategories();
    } catch (error) {
      message.error('Không thể xóa loại sản phẩm');
      console.error('Error deleting category:', error);
    }
  };

  const handleSubmit = async (values) => {
    try {
      if (editingCategory) {
  await updateProductCategory(values);
        message.success('Cập nhật loại sản phẩm thành công');
      } else {
  await createProductCategory(values);
        message.success('Thêm loại sản phẩm thành công');
      }
      setIsModalVisible(false);
      form.resetFields();
      loadCategories();
    } catch (error) {
      message.error(editingCategory ? 'Không thể cập nhật loại sản phẩm' : 'Không thể thêm loại sản phẩm');
      console.error('Error saving category:', error);
    }
  };

  const filteredCategories = categories.filter(cat => {
    const name = cat.lv002 || cat.tenLoaiSp || cat.ten || cat.tenLoai || '';
    const id = cat.lv001 || cat.idLoaiSp || cat.id || cat.maLoai || '';
    return name.toLowerCase().includes(searchText.toLowerCase()) ||
           id.toLowerCase().includes(searchText.toLowerCase());
  });

  const columns = [
    {
      title: 'Mã loại',
      dataIndex: 'lv001',
      key: 'lv001',
      render: (text, record) => record.lv001 || record.idLoaiSp || record.id || record.maLoai
    },
    {
      title: 'Tên loại sản phẩm',
      dataIndex: 'lv002',
      key: 'lv002',
      render: (text, record) => record.lv002 || record.tenLoaiSp || record.ten || record.tenLoai
    },
    {
      title: 'Mô tả',
      dataIndex: 'lv003',
      key: 'lv003',
      render: (text, record) => record.lv003 || record.moTa || ''
    },
    {
      title: 'Thao tác',
      key: 'action',
      width: 150,
      render: (_, record) => (
        <Space size="small">
          <Button
            type="text"
            icon={<Edit size={16} />}
            onClick={() => handleEdit(record)}
          />
          <Popconfirm
            title="Xác nhận xóa"
            description="Bạn có chắc chắn muốn xóa loại sản phẩm này?"
            onConfirm={() => handleDelete(record)}
            okText="Xóa"
            cancelText="Hủy"
          >
            <Button
              type="text"
              danger
              icon={<Trash2 size={16} />}
            />
          </Popconfirm>
        </Space>
      ),
    },
  ];

  return (
    <div className="loai-san-pham-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Điều khiển sản phẩm' },
          { title: 'Loại sản phẩm' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Tags size={20} />
            <span>Quản lý loại sản phẩm</span>
          </div>
        }
        extra={
          <Space>
            <Input
              placeholder="Tìm kiếm..."
              prefix={<Search size={16} />}
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
              style={{ width: 250 }}
            />
            <Button
              type="primary"
              icon={<Plus size={16} />}
              onClick={handleAdd}
            >
              Thêm loại sản phẩm
            </Button>
          </Space>
        }
        className="main-card"
      >
        <Table
          columns={columns}
          dataSource={filteredCategories}
          loading={loading}
          rowKey={(record) => record.lv001 || record.idLoaiSp || record.id || record.maLoai}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `Tổng ${total} loại sản phẩm`
          }}
        />
      </Card>

      <Modal
        title={editingCategory ? 'Sửa loại sản phẩm' : 'Thêm loại sản phẩm'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
        }}
        onOk={() => form.submit()}
        okText={editingCategory ? 'Cập nhật' : 'Thêm'}
        cancelText="Hủy"
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSubmit}
        >
          <Form.Item
            name="lv001"
            label="Mã loại"
            rules={[{ required: true, message: 'Vui lòng nhập mã loại' }]}
          >
            <Input disabled={!!editingCategory} placeholder="Nhập mã loại" />
          </Form.Item>
          <Form.Item
            name="lv002"
            label="Tên loại sản phẩm"
            rules={[{ required: true, message: 'Vui lòng nhập tên loại sản phẩm' }]}
          >
            <Input placeholder="Nhập tên loại sản phẩm" />
          </Form.Item>
          <Form.Item
            name="lv003"
            label="Mô tả"
          >
            <Input.TextArea rows={3} placeholder="Nhập mô tả" />
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default LoaiSanPham;
