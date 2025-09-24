import React, { useState, useEffect } from 'react';
import { Row, Col, Card, Button, Modal, Form, Input, Select, InputNumber, Table, Space, Typography, Tag, message } from 'antd';
import { Plus, Pencil, Trash2, Table as TableIcon } from 'lucide-react';
import { loadBan, loadKhuVuc } from '../../services/apiServices';
import './QuanLyBan.css';

const { Title, Text } = Typography;
const { Option } = Select;

const QuanLyBan = () => {
  const [tables, setTables] = useState([]);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [editingTable, setEditingTable] = useState(null);
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);
  const [khuVucList, setKhuVucList] = useState([]);

  useEffect(() => {
    loadTablesData();
    loadKhuVucData();
  }, []);

  const loadTablesData = async () => {
    setLoading(true);
    try {
      const data = await loadBan();
      if (data && Array.isArray(data)) {
        setTables(data);
      } else {
        // Silent console
        setTables([]);
      }
    } catch (error) {
      console.error('Error loading tables:', error);
      message.error('Không thể tải danh sách bàn');
      setTables([]);
    } finally {
      setLoading(false);
    }
  };

  const loadKhuVucData = async () => {
    try {
      const data = await loadKhuVuc();
      if (data && Array.isArray(data)) {
        setKhuVucList(data);
      } else {
        // Silent console
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

  const handleAddNew = () => {
    setEditingTable(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    setEditingTable(record);
    form.setFieldsValue(record);
    setIsModalVisible(true);
  };

  const handleDelete = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa',
      content: 'Bạn có chắc chắn muốn xóa bàn này?',
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: () => {
        setTables(tables.filter(table => table.id !== id));
        message.success('Đã xóa bàn thành công');
      }
    });
  };

  const handleSave = async (values) => {
    try {
      if (editingTable) {
        // Cập nhật bàn
        setTables(tables.map(table => 
          table.id === editingTable.id 
            ? { ...table, ...values }
            : table
        ));
        message.success('Đã cập nhật bàn thành công');
      } else {
        // Thêm bàn mới
        const newTable = {
          id: Math.max(...tables.map(t => t.id)) + 1,
          ...values
        };
        setTables([...tables, newTable]);
        message.success('Đã thêm bàn mới thành công');
      }
      
      setIsModalVisible(false);
      form.resetFields();
    } catch (error) {
      message.error('Đã xảy ra lỗi');
    }
  };

  const handleChangeStatus = (id, newStatus) => {
    setTables(tables.map(table => 
      table.id === id 
        ? { ...table, trangThai: newStatus }
        : table
    ));
    message.success('Đã cập nhật trạng thái bàn');
  };

  // Nhóm bàn theo khu vực
  const tablesByArea = tables.reduce((acc, table) => {
    if (!acc[table.khuVuc]) {
      acc[table.khuVuc] = [];
    }
    acc[table.khuVuc].push(table);
    return acc;
  }, {});

  const columns = [
    {
      title: 'Tên bàn',
      dataIndex: 'ten',
      key: 'ten',
      sorter: (a, b) => a.ten.localeCompare(b.ten),
    },
    {
      title: 'Khu vực',
      dataIndex: 'khuVuc',
      key: 'khuVuc',
      filters: [...new Set(tables.map(t => t.khuVuc))].map(area => ({
        text: area,
        value: area,
      })),
      onFilter: (value, record) => record.khuVuc === value,
    },
    {
      title: 'Số ghế',
      dataIndex: 'soGhe',
      key: 'soGhe',
      sorter: (a, b) => a.soGhe - b.soGhe,
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: (status, record) => (
        <Select
          value={status}
          onChange={(value) => handleChangeStatus(record.id, value)}
          size="small"
          style={{ width: 100 }}
        >
          <Option value="available">
            <Tag color="success">Trống</Tag>
          </Option>
          <Option value="occupied">
            <Tag color="error">Có khách</Tag>
          </Option>
          <Option value="reserved">
            <Tag color="warning">Đã đặt</Tag>
          </Option>
        </Select>
      ),
      filters: [
        { text: 'Trống', value: 'available' },
        { text: 'Có khách', value: 'occupied' },
        { text: 'Đã đặt', value: 'reserved' },
      ],
      onFilter: (value, record) => record.trangThai === value,
    },
    {
      title: 'Ghi chú',
      dataIndex: 'ghiChu',
      key: 'ghiChu',
    },
    {
      title: 'Thao tác',
      key: 'action',
      render: (_, record) => (
        <Space size="middle">
          <Button
            type="link"
            icon={<Pencil size={16} />}
            onClick={() => handleEdit(record)}
          >
            Sửa
          </Button>
          <Button
            type="link"
            danger
            icon={<Trash2 size={16} />}
            onClick={() => handleDelete(record.id)}
          >
            Xóa
          </Button>
        </Space>
      ),
    },
  ];

  return (
    <div className="quan-ly-ban">
      <div className="page-header">
        <Title level={2}>Quản lý bàn</Title>
        <Button
          type="primary"
          icon={<Plus size={16} />}
          onClick={handleAddNew}
        >
          Thêm bàn mới
        </Button>
      </div>

      {/* Hiển thị bàn theo khu vực */}
      <div className="tables-overview">
        {Object.entries(tablesByArea).map(([area, areaTables]) => (
          <Card key={area} title={area} className="area-card">
            <Row gutter={[12, 12]}>
              {areaTables.map(table => (
                <Col xs={8} sm={6} md={4} lg={3} key={table.id}>
                  <Card
                    size="small"
                    className={`table-card ${table.trangThai}`}
                    onClick={() => handleEdit(table)}
                  >
                    <div className="table-content">
                      <TableIcon size={24} style={{ marginBottom: '8px' }} />
                      <Text strong className="table-name">{table.ten}</Text>
                      <div className="table-details">
                        <Text type="secondary" style={{ fontSize: '12px' }}>
                          {table.soGhe} ghế
                        </Text>
                      </div>
                      <Tag 
                        color={getStatusColor(table.trangThai)}
                        size="small"
                      >
                        {getStatusText(table.trangThai)}
                      </Tag>
                    </div>
                  </Card>
                </Col>
              ))}
            </Row>
          </Card>
        ))}
      </div>

      {/* Bảng danh sách chi tiết */}
      <Card title="Danh sách chi tiết" className="tables-list">
        <Table
          columns={columns}
          dataSource={tables}
          rowKey="id"
          loading={loading}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} bàn`,
          }}
        />
      </Card>

      {/* Modal thêm/sửa bàn */}
      <Modal
        title={editingTable ? 'Sửa thông tin bàn' : 'Thêm bàn mới'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
        }}
        footer={null}
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
              {khuVucList.map(khuVuc => (
                <Option key={khuVuc.ID || khuVuc.id} value={khuVuc.TEN || khuVuc.ten}>
                  {khuVuc.TEN || khuVuc.ten}
                </Option>
              ))}
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

          <Form.Item>
            <Space>
              <Button type="primary" htmlType="submit">
                {editingTable ? 'Cập nhật' : 'Thêm mới'}
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

export default QuanLyBan;
