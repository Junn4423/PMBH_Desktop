import React, { useState, useEffect } from 'react';
import { Card, Button, Modal, Form, Input, Select, InputNumber, Table, Space, Breadcrumb, Tag, message, Popconfirm } from 'antd';
import { Coffee, Plus, Edit, Trash2, Search } from 'lucide-react';
import { loadBan, loadKhuVuc, themBan, suaBan, xoaBan } from '../../services/apiServices';
import './BanNhaHang.css';

const { Search: SearchInput } = Input;
const { Option } = Select;

const BanNhaHang = () => {
  const [tables, setTables] = useState([]);
  const [filteredTables, setFilteredTables] = useState([]);
  const [searchText, setSearchText] = useState('');
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingTable, setEditingTable] = useState(null);
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);
  const [khuVucList, setKhuVucList] = useState([]);

  useEffect(() => {
    loadTablesData();
    loadKhuVucData();
  }, []);

  useEffect(() => {
    handleSearch(searchText);
  }, [searchText, tables]);

  const loadTablesData = async () => {
    setLoading(true);
    try {
      const [banData, khuVucData] = await Promise.all([loadBan(), loadKhuVuc()]);
      console.log('Raw ban data:', banData);
      console.log('Raw khu vuc data:', khuVucData);
      
      // Create khu vuc map for quick lookup
      const khuVucMap = {};
      if (khuVucData && Array.isArray(khuVucData)) {
        khuVucData.forEach(kv => {
          khuVucMap[kv.idKhuVuc] = kv.ten || kv.tenKhuVuc;
        });
      }
      
      if (banData && Array.isArray(banData)) {
        // Map dữ liệu từ backend (format: idBan, tenBan, idKhuVuc)
        const mappedTables = banData.map(table => ({
          id: table.idBan || table.id,
          ten: (table.tenBan || table.ten || 'undefined').trim(), // Trim whitespace
          khuVuc: khuVucMap[table.idKhuVuc] || table.idKhuVuc || 'Không xác định', // Get tên from map
          maKhuVuc: table.idKhuVuc, // idKhuVuc chính là mã khu vực
          soGhe: table.soGhe || 4,
          trangThai: table.trangThai || 'available',
          // Keep original data for reference
          _raw: table
        }));
        
        console.log('Mapped tables:', mappedTables);
        setTables(mappedTables);
        setFilteredTables(mappedTables);
      } else {
        console.warn('Invalid data format:', banData);
        setTables([]);
        setFilteredTables([]);
      }
    } catch (error) {
      console.error('Error loading tables:', error);
      message.error('Không thể tải danh sách bàn');
      setTables([]);
      setFilteredTables([]);
    } finally {
      setLoading(false);
    }
  };

  const handleSearch = (value) => {
    if (!value || value.trim() === '') {
      setFilteredTables(tables);
      return;
    }
    
    const searchLower = value.toLowerCase().trim();
    const filtered = tables.filter(item => 
      (item.ten && item.ten.toLowerCase().includes(searchLower)) ||
      (item.khuVuc && item.khuVuc.toLowerCase().includes(searchLower)) ||
      (item.id && item.id.toString().toLowerCase().includes(searchLower))
    );
    setFilteredTables(filtered);
  };

  const loadKhuVucData = async () => {
    try {
      const data = await loadKhuVuc();
      console.log('Raw khu vuc data:', data);
      
      if (data && Array.isArray(data)) {
        setKhuVucList(data);
      } else {
        console.warn('Invalid khu vuc data:', data);
        setKhuVucList([]);
      }
    } catch (error) {
      console.error('Error loading khu vuc:', error);
      setKhuVucList([]);
    }
  };

  const getStatusColor = (status) => {
    switch (status) {
      case 'available':
        return 'success';
      case 'occupied':
        return 'error';
      case 'reserved':
        return 'warning';
      default:
        return 'default';
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'available':
        return 'Trống';
      case 'occupied':
        return 'Có khách';
      case 'reserved':
        return 'Đã đặt';
      default:
        return 'Không xác định';
    }
  };

  const handleAdd = () => {
    setEditingTable(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    console.log('Editing record:', record);
    setEditingTable(record);
    
    // Find khu vuc name
    const khuVuc = khuVucList.find(k => k.idKhuVuc === record.maKhuVuc);
    const khuVucName = khuVuc ? (khuVuc.ten || khuVuc.tenKhuVuc) : record.khuVuc;
    
    form.setFieldsValue({
      ten: record.ten,
      khuVuc: khuVucName,
      soGhe: record.soGhe || 4,
      trangThai: record.trangThai
    });
    setIsModalVisible(true);
  };

  const handleDelete = async (record) => {
    Modal.confirm({
      title: 'Xác nhận xóa',
      content: `Bạn có chắc chắn muốn xóa bàn "${record.ten}"?`,
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          const maBan = record.id || record._raw?.idBan;
          console.log('Deleting table:', record);
          console.log('Deleting table with ID:', maBan);
          
          if (!maBan) {
            message.error('Không tìm thấy mã bàn');
            console.error('Record data:', record);
            return;
          }
          
          await xoaBan(maBan);
          message.success('Đã xóa bàn thành công');
          await loadTablesData();
        } catch (error) {
          message.error('Không thể xóa bàn: ' + (error.message || 'Lỗi không xác định'));
          console.error('Error deleting table:', error);
        }
      }
    });
  };

  const handleSave = async (values) => {
    try {
      console.log('Form values:', values);
      console.log('Editing table:', editingTable);
      console.log('Khu vuc list:', khuVucList);
      
      // Tìm khu vực từ tên (format: {idKhuVuc, ten} hoặc {maKhuVuc, tenKhuVuc})
      const khuVuc = khuVucList.find(k => {
        const tenKV = k.ten || k.tenKhuVuc;
        return tenKV === values.khuVuc;
      });
      // Lấy mã khu vực từ các property có thể có
      const maKhuVuc = khuVuc ? (khuVuc.idKhuVuc || khuVuc.maKhuVuc || khuVuc.id) : '';
      
      console.log('Found khu vuc:', khuVuc, 'maKhuVuc:', maKhuVuc);
      
      if (!maKhuVuc) {
        message.warning('Không tìm thấy khu vực, vui lòng chọn lại');
        return;
      }
      
      if (editingTable) {
        // Cập nhật bàn
        const maBan = editingTable.id || editingTable._raw?.idBan;
        
        if (!maBan) {
          message.error('Không tìm thấy mã bàn');
          console.error('Editing table data:', editingTable);
          return;
        }
        
        const payload = {
          maBan: maBan,
          tenBan: values.ten.trim(),
          maKhuVuc: maKhuVuc
        };
        
        console.log('Update payload:', payload);
        await suaBan(payload);
        message.success('Đã cập nhật bàn thành công');
      } else {
        // Thêm bàn mới
        const payload = {
          lv002: values.ten.trim(),
          lv004: maKhuVuc
        };
        
        console.log('Add payload:', payload);
        await themBan(payload);
        message.success('Đã thêm bàn mới thành công');
      }
      
      setIsModalVisible(false);
      form.resetFields();
      setEditingTable(null);
      await loadTablesData();
    } catch (error) {
      message.error('Đã xảy ra lỗi: ' + (error.message || 'Lỗi không xác định'));
      console.error('Error saving table:', error);
    }
  };

  const columns = [
    {
      title: 'Tên bàn',
      dataIndex: 'ten',
      key: 'ten',
      width: 150,
      sorter: (a, b) => a.ten.localeCompare(b.ten),
    },
    {
      title: 'Khu vực',
      dataIndex: 'khuVuc',
      key: 'khuVuc',
      width: 200,
    },
    {
      title: 'Số ghế',
      dataIndex: 'soGhe',
      key: 'soGhe',
      width: 100,
      align: 'center'
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 150,
      render: (status) => (
        <Tag color={getStatusColor(status)}>
          {getStatusText(status)}
        </Tag>
      )
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
            description="Bạn có chắc chắn muốn xóa bàn này?"
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
    <div className="ban-nha-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Thiết lập tầng và bàn' },
          { title: 'Bàn nhà hàng' }
        ]}
        style={{ marginBottom: 16 }}
      />
      
      <Card
        title={
          <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
            <Coffee size={20} />
            <span>Quản lý bàn nhà hàng</span>
          </div>
        }
        extra={
          <Space>
            <SearchInput
              placeholder="Tìm kiếm bàn..."
              allowClear
              prefix={<Search size={16} />}
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
              onSearch={handleSearch}
              style={{ width: 250 }}
            />
            <Button
              type="primary"
              icon={<Plus size={16} />}
              onClick={handleAdd}
            >
              Thêm bàn mới
            </Button>
          </Space>
        }
      >
        <Table
          columns={columns}
          dataSource={filteredTables}
          rowKey="id"
          loading={loading}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `Tổng ${total} bàn`
          }}
        />
      </Card>

      <Modal
        title={editingTable ? 'Sửa thông tin bàn' : 'Thêm bàn mới'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
          setEditingTable(null);
        }}
        onOk={() => form.submit()}
        okText={editingTable ? 'Cập nhật' : 'Thêm'}
        cancelText="Hủy"
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSave}
        >
          <Form.Item
            name="ten"
            label="Tên bàn"
            rules={[
              { required: true, message: 'Vui lòng nhập tên bàn!' }
            ]}
          >
            <Input placeholder="Ví dụ: Bàn 1" />
          </Form.Item>

          <Form.Item
            name="khuVuc"
            label="Khu vực"
            rules={[
              { required: true, message: 'Vui lòng chọn khu vực!' }
            ]}
          >
            <Select placeholder="Chọn khu vực">
              {khuVucList.map(khuVuc => {
                const tenKV = khuVuc.ten || khuVuc.tenKhuVuc;
                const idKV = khuVuc.idKhuVuc;
                return (
                  <Option key={idKV} value={tenKV}>
                    {tenKV}
                  </Option>
                );
              })}
            </Select>
          </Form.Item>

          <Form.Item
            name="soGhe"
            label="Số ghế"
            rules={[
              { required: true, message: 'Vui lòng nhập số ghế!' }
            ]}
          >
            <InputNumber
              min={1}
              max={20}
              placeholder="Số ghế"
              style={{ width: '100%' }}
            />
          </Form.Item>

          <Form.Item
            name="trangThai"
            label="Trạng thái"
            initialValue="available"
          >
            <Select>
              <Option value="available">Trống</Option>
              <Option value="occupied">Có khách</Option>
              <Option value="reserved">Đã đặt</Option>
            </Select>
          </Form.Item>

          <Form.Item
            name="ghiChu"
            label="Ghi chú"
          >
            <Input.TextArea
              rows={3}
              placeholder="Ghi chú thêm về bàn này..."
            />
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default BanNhaHang;