import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Table, Button, Modal, Form, Input, Space, Popconfirm, message } from 'antd';
import { Building, Plus, Edit, Trash2, Search } from 'lucide-react';
import { loadKhuVuc, themKhuVuc, suaKhuVuc, xoaKhuVuc } from '../../services/apiServices';
import './TangNhaHang.css';

const { Search: SearchInput } = Input;

const TangNhaHang = () => {
  const [khuVucList, setKhuVucList] = useState([]);
  const [filteredList, setFilteredList] = useState([]);
  const [searchText, setSearchText] = useState('');
  const [loading, setLoading] = useState(false);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingKhuVuc, setEditingKhuVuc] = useState(null);
  const [form] = Form.useForm();

  useEffect(() => {
    loadData();
  }, []);

  useEffect(() => {
    handleSearch(searchText);
  }, [searchText, khuVucList]);

  const loadData = async () => {
    setLoading(true);
    try {
      const data = await loadKhuVuc();
      console.log('Khu vuc data:', data);
      if (data && Array.isArray(data)) {
        const mapped = data.map(item => ({
          key: item.idKhuVuc || item.maKhuVuc,
          maKhuVuc: item.idKhuVuc || item.maKhuVuc,
          tenKhuVuc: item.ten || item.tenKhuVuc,
          _raw: item
        }));
        setKhuVucList(mapped);
        setFilteredList(mapped);
      }
    } catch (error) {
      console.error('Error loading khu vuc:', error);
      message.error('Không thể tải danh sách tầng/khu vực');
    } finally {
      setLoading(false);
    }
  };

  const handleSearch = (value) => {
    if (!value || value.trim() === '') {
      setFilteredList(khuVucList);
      return;
    }
    
    const searchLower = value.toLowerCase().trim();
    const filtered = khuVucList.filter(item => 
      (item.maKhuVuc && item.maKhuVuc.toLowerCase().includes(searchLower)) ||
      (item.tenKhuVuc && item.tenKhuVuc.toLowerCase().includes(searchLower))
    );
    setFilteredList(filtered);
  };

  const handleAdd = () => {
    setEditingKhuVuc(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    setEditingKhuVuc(record);
    form.setFieldsValue({
      maKhuVuc: record.maKhuVuc,
      tenKhuVuc: record.tenKhuVuc
    });
    setIsModalVisible(true);
  };

  const handleDelete = async (record) => {
    try {
      await xoaKhuVuc(record.maKhuVuc);
      message.success('Xóa thành công');
      loadData();
    } catch (error) {
      console.error('Error deleting:', error);
      message.error('Không thể xóa tầng/khu vực');
    }
  };

  const handleSubmit = async (values) => {
    try {
      if (editingKhuVuc) {
        await suaKhuVuc({
          maKhuVuc: editingKhuVuc.maKhuVuc,
          tenKhuVuc: values.tenKhuVuc
        });
        message.success('Cập nhật thành công');
      } else {
        await themKhuVuc({
          lv001: values.maKhuVuc,
          lv002: values.tenKhuVuc
        });
        message.success('Thêm thành công');
      }
      setIsModalVisible(false);
      form.resetFields();
      loadData();
    } catch (error) {
      console.error('Error saving:', error);
      message.error(editingKhuVuc ? 'Không thể cập nhật' : 'Không thể thêm tầng/khu vực');
    }
  };

  const columns = [
    {
      title: 'Mã tầng/khu vực',
      dataIndex: 'maKhuVuc',
      key: 'maKhuVuc',
      width: 150
    },
    {
      title: 'Tên tầng/khu vực',
      dataIndex: 'tenKhuVuc',
      key: 'tenKhuVuc'
    },
    {
      title: 'Thao tác',
      key: 'action',
      width: 150,
      render: (_, record) => (
        <Space size="small">
          <Button
            type="link"
            icon={<Edit size={16} />}
            onClick={() => handleEdit(record)}
          >
            Sửa
          </Button>
          <Popconfirm
            title="Xác nhận xóa"
            description="Bạn có chắc chắn muốn xóa?"
            onConfirm={() => handleDelete(record)}
            okText="Xóa"
            cancelText="Hủy"
          >
            <Button
              type="link"
              danger
              icon={<Trash2 size={16} />}
            >
              Xóa
            </Button>
          </Popconfirm>
        </Space>
      )
    }
  ];

  return (
    <div className="tang-nha-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Thiết lập tầng và bàn' },
          { title: 'Tầng nhà hàng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
              <Building size={20} />
              <span>Quản lý Tầng/Khu vực Nhà hàng</span>
            </div>
            <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
              <SearchInput
                placeholder="Tìm kiếm theo mã, tên tầng/khu vực..."
                allowClear
                prefix={<Search size={16} />}
                value={searchText}
                onChange={(e) => setSearchText(e.target.value)}
                onSearch={handleSearch}
                style={{ width: 300 }}
              />
              <Button
                type="primary"
                icon={<Plus size={16} />}
                onClick={handleAdd}
              >
                Thêm mới
              </Button>
            </div>
          </div>
        }
        className="main-card"
      >
        <Table
          columns={columns}
          dataSource={filteredList}
          loading={loading}
          pagination={{
            pageSize: 10,
            showTotal: (total) => `Tổng số: ${total}`
          }}
        />
      </Card>

      <Modal
        title={editingKhuVuc ? 'Sửa tầng/khu vực' : 'Thêm tầng/khu vực mới'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
        }}
        onOk={() => form.submit()}
        okText={editingKhuVuc ? 'Cập nhật' : 'Thêm'}
        cancelText="Hủy"
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSubmit}
        >
          <Form.Item
            name="maKhuVuc"
            label="Mã tầng/khu vực"
            rules={[{ required: true, message: 'Vui lòng nhập mã!' }]}
          >
            <Input disabled={!!editingKhuVuc} placeholder="VD: TANG1, KV01..." />
          </Form.Item>
          
          <Form.Item
            name="tenKhuVuc"
            label="Tên tầng/khu vực"
            rules={[{ required: true, message: 'Vui lòng nhập tên!' }]}
          >
            <Input placeholder="VD: Tầng 1, Khu vực ngoài trời..." />
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default TangNhaHang;
