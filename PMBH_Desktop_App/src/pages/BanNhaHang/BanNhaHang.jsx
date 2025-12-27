import React, { useState, useEffect, useCallback } from 'react';
import { Card, Button, Modal, Form, Input, Select, InputNumber, Table, Space, Breadcrumb, Tag, message, Popconfirm } from 'antd';
import { Coffee, Plus, Edit, Trash2, Search } from 'lucide-react';
import { loadBan, loadKhuVuc, themBan, suaBan, xoaBan } from '../../services/apiServices';
import './BanNhaHang.css';

const { Search: SearchInput } = Input;
const { Option } = Select;

const getKhuVucId = (khuVuc) => (
  khuVuc?.idKhuVuc ?? khuVuc?.maKhuVuc ?? khuVuc?.lv001 ?? khuVuc?.id ?? ''
);

const getKhuVucName = (khuVuc) => (
  khuVuc?.ten ?? khuVuc?.tenKhuVuc ?? khuVuc?.lv002 ?? khuVuc?.name ?? 'Không xác định'
);

const buildKhuVucMap = (list = []) => {
  const map = {};
  list.forEach(item => {
    const id = getKhuVucId(item);
    if (id) {
      map[id] = getKhuVucName(item);
    }
  });
  return map;
};

const BanNhaHang = () => {
  const [tables, setTables] = useState([]);
  const [filteredTables, setFilteredTables] = useState([]);
  const [searchText, setSearchText] = useState('');
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingTable, setEditingTable] = useState(null);
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);
  const [khuVucList, setKhuVucList] = useState([]);

  const loadTablesData = useCallback(async () => {
    setLoading(true);
    try {
      const [banData, khuVucData] = await Promise.all([loadBan(), loadKhuVuc()]);
      console.log('Raw ban data:', banData);
      console.log('Raw khu vuc data:', khuVucData);

      const normalizedKhuVuc = Array.isArray(khuVucData) ? khuVucData : [];
      const nextKhuVucMap = buildKhuVucMap(normalizedKhuVuc);
      setKhuVucList(normalizedKhuVuc);

      if (banData && Array.isArray(banData)) {
        const mappedTables = banData
          .map(table => {
            const maBan = table.maBan ?? table.idBan ?? table.lv001 ?? table.id;
            const maKhuVuc = table.maKhuVuc ?? table.idKhuVuc ?? table.lv004 ?? '';
            if (!maBan) {
              return null;
            }
            return {
              id: maBan,
              maBan,
              ten: (table.tenBan || table.ten || table.lv002 || 'Chưa đặt tên').trim(),
              khuVuc: nextKhuVucMap[maKhuVuc] || maKhuVuc || 'Không xác định',
              maKhuVuc,
              soGhe: Number(table.soGhe) || 4,
              trangThai: table.trangThai || 'available',
              _raw: table
            };
          })
          .filter(Boolean);

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
  }, []);

  useEffect(() => {
    loadTablesData();
  }, [loadTablesData]);

  useEffect(() => {
    if (!searchText || searchText.trim() === '') {
      setFilteredTables(tables);
      return;
    }

    const searchLower = searchText.toLowerCase().trim();
    const filtered = tables.filter(item =>
      (item.ten && item.ten.toLowerCase().includes(searchLower)) ||
      (item.khuVuc && item.khuVuc.toLowerCase().includes(searchLower)) ||
      (item.maBan && item.maBan.toString().toLowerCase().includes(searchLower))
    );
    setFilteredTables(filtered);
  }, [searchText, tables]);

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
    form.setFieldsValue({ soGhe: 4, trangThai: 'available' });
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    console.log('Editing record:', record);
    setEditingTable(record);
    form.setFieldsValue({
      maBan: record.maBan,
      ten: record.ten,
      khuVuc: record.maKhuVuc,
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
          const maBan = record.maBan || record.id || record._raw?.maBan || record._raw?.idBan;
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
      
      const maKhuVuc = values.khuVuc;
      const maBanInput = values.maBan?.toString().trim();

      console.log('Selected maKhuVuc:', maKhuVuc, 'maBan:', maBanInput);

      if (!maKhuVuc) {
        message.warning('Không tìm thấy khu vực, vui lòng chọn lại');
        return;
      }
      if (!maBanInput) {
        message.warning('Vui lòng nhập mã bàn hợp lệ');
        return;
      }
      
      if (editingTable) {
        // Cập nhật bàn
        const maBan = editingTable.maBan || editingTable.id || editingTable._raw?.maBan || editingTable._raw?.idBan || maBanInput;
        
        if (!maBan) {
          message.error('Không tìm thấy mã bàn');
          console.error('Editing table data:', editingTable);
          return;
        }
        
        const payload = {
          maBan,
          tenBan: values.ten.trim(),
          maKhuVuc: maKhuVuc
        };
        
        console.log('Update payload:', payload);
        await suaBan(payload);
        message.success('Đã cập nhật bàn thành công');
      } else {
        // Thêm bàn mới
        const payload = {
          maBan: maBanInput,
          tenBan: values.ten.trim(),
          maKhuVuc: maKhuVuc
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
      title: 'Mã bàn',
      dataIndex: 'maBan',
      key: 'maBan',
      width: 120,
      sorter: (a, b) => a.maBan.localeCompare(b.maBan),
    },
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
              onSearch={(value) => setSearchText(value)}
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
          rowKey="maBan"
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
            name="maBan"
            label="Mã bàn"
            rules={[
              { required: true, message: 'Vui lòng nhập mã bàn!' },
              { pattern: /^[A-Za-z0-9_-]+$/, message: 'Mã bàn chỉ chứa chữ, số, -, _' }
            ]}
          >
            <Input placeholder="Ví dụ: B01" disabled={!!editingTable} />
          </Form.Item>

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
                const idKV = getKhuVucId(khuVuc);
                if (!idKV) return null;
                return (
                  <Option key={idKV} value={idKV}>
                    {getKhuVucName(khuVuc)}
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