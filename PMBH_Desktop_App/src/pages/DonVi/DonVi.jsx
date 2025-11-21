import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Table, Button, Modal, Form, Input, Space, Popconfirm, message } from 'antd';
import { Ruler, Plus, Edit, Trash2, Search } from 'lucide-react';
import { loadDonVi, themDonVi, suaDonVi, xoaDonVi } from '../../services/apiServices';

const { Search: SearchInput } = Input;

const DonVi = () => {
  const [donViList, setDonViList] = useState([]);
  const [filteredList, setFilteredList] = useState([]);
  const [searchText, setSearchText] = useState('');
  const [loading, setLoading] = useState(false);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingDonVi, setEditingDonVi] = useState(null);
  const [form] = Form.useForm();

  useEffect(() => {
    loadData();
  }, []);

  useEffect(() => {
    handleSearch(searchText);
  }, [searchText, donViList]);

  const loadData = async () => {
    setLoading(true);
    try {
      const data = await loadDonVi();
      console.log('Don vi data:', data);
      if (data && Array.isArray(data)) {
        const mapped = data.map(item => ({
          key: item.maDonVi,
          maDonVi: item.maDonVi,
          tenDonVi: item.tenDonVi,
          heSo: item.heSo || '',
          _raw: item
        }));
        setDonViList(mapped);
        setFilteredList(mapped);
      }
    } catch (error) {
      console.error('Error loading don vi:', error);
      message.error('Không thể tải danh sách đơn vị');
    } finally {
      setLoading(false);
    }
  };

  const handleSearch = (value) => {
    if (!value || value.trim() === '') {
      setFilteredList(donViList);
      return;
    }

    const searchLower = value.toLowerCase().trim();
    const filtered = donViList.filter(item =>
      (item.maDonVi && item.maDonVi.toLowerCase().includes(searchLower)) ||
      (item.tenDonVi && item.tenDonVi.toLowerCase().includes(searchLower)) ||
      (item.heSo && item.heSo.toString().includes(searchLower))
    );
    setFilteredList(filtered);
  };

  const handleAdd = () => {
    setEditingDonVi(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    setEditingDonVi(record);
    form.setFieldsValue({
      maDonVi: record.maDonVi,
      tenDonVi: record.tenDonVi,
      heSo: record.heSo
    });
    setIsModalVisible(true);
  };

  const handleDelete = async (record) => {
    try {
      await xoaDonVi(record.maDonVi);
      message.success('Xóa thành công');
      loadData();
    } catch (error) {
      console.error('Error deleting:', error);
      message.error('Không thể xóa đơn vị');
    }
  };

  const handleSubmit = async (values) => {
    try {
      console.log('Form values:', values);
      console.log('Editing don vi:', editingDonVi);

      const tenDonVi = values.tenDonVi ? values.tenDonVi.toString().trim() : '';
      const maDonVi = values.maDonVi ? values.maDonVi.toString().trim() : '';

      // Validate special characters
      // Allow alphanumeric, spaces, and Vietnamese characters
      const specialCharRegex = /^[a-zA-Z0-9\s\u00C0-\u1EF9]+$/;

      // Validate Unit Code (maDonVi) only when adding new
      if (!editingDonVi) {
        if (!specialCharRegex.test(maDonVi)) {
          message.error('Mã đơn vị không được chứa kí tự đặc biệt');
          return;
        }
      }

      // Validate Unit Name (tenDonVi)
      if (!specialCharRegex.test(tenDonVi)) {
        message.error('Tên đơn vị không được chứa kí tự đặc biệt');
        return;
      }

      if (editingDonVi) {
        const payload = {
          lv001: editingDonVi.maDonVi,
          lv002: tenDonVi,
          lv003: values.heSo || ''
        };
        console.log('Update payload:', payload);
        const result = await suaDonVi(payload);
        console.log('Update result:', result);
        message.success('Cập nhật thành công');
      } else {
        const payload = {
          lv001: maDonVi,
          lv002: tenDonVi,
          lv003: (values.heSo || '').toString().trim()
        };
        console.log('Add payload:', payload);
        const result = await themDonVi(payload);
        console.log('Add result:', result);

        if (result === -2) {
          message.error('Mã đơn vị đã tồn tại');
          return;
        }
        if (!result) {
          message.error('Thêm thất bại');
          return;
        }

        message.success('Thêm thành công');
      }
      setIsModalVisible(false);
      form.resetFields();
      setEditingDonVi(null);
      await loadData();
    } catch (error) {
      console.error('Error saving:', error);
      message.error(editingDonVi ? 'Không thể cập nhật' : 'Không thể thêm đơn vị');
    }
  };

  const columns = [
    {
      title: 'Mã đơn vị',
      dataIndex: 'maDonVi',
      key: 'maDonVi',
      width: 120
    },
    {
      title: 'Tên đơn vị',
      dataIndex: 'tenDonVi',
      key: 'tenDonVi'
    },
    {
      title: 'Hệ số',
      dataIndex: 'heSo',
      key: 'heSo',
      width: 150
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
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Mục chung</Breadcrumb.Item>
        <Breadcrumb.Item>Điều khiển sản phẩm</Breadcrumb.Item>
        <Breadcrumb.Item>Đơn vị</Breadcrumb.Item>
      </Breadcrumb>

      <Card
        title={
          <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
              <Ruler size={20} />
              <span>Quản lý Đơn vị</span>
            </div>
            <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
              <SearchInput
                placeholder="Tìm kiếm theo mã, tên đơn vị..."
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
      >
        <div style={{ marginBottom: 16 }}>
          {/* Search moved to header */}
        </div>

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
        title={editingDonVi ? 'Sửa đơn vị' : 'Thêm đơn vị mới'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
        }}
        onOk={() => form.submit()}
        okText={editingDonVi ? 'Cập nhật' : 'Thêm'}
        cancelText="Hủy"
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSubmit}
        >
          <Form.Item
            name="maDonVi"
            label="Mã đơn vị"
            rules={[{ required: true, message: 'Vui lòng nhập mã!' }]}
          >
            <Input disabled={!!editingDonVi} placeholder="VD: DV001, KG, LY..." />
          </Form.Item>

          <Form.Item
            name="tenDonVi"
            label="Tên đơn vị"
            rules={[{ required: true, message: 'Vui lòng nhập tên!' }]}
          >
            <Input placeholder="VD: Kilogram, Lý, Chai..." />
          </Form.Item>

          <Form.Item
            name="heSo"
            label="Hệ số"
          >
            <Input placeholder="VD: 0.5, 1, 2, ..." />
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default DonVi;
