import React, { useState, useEffect } from 'react';
import { 
  Card, Table, Button, Input, Select, Row, Col, Space, 
  Tag, Modal, message, Tooltip, Typography, DatePicker 
} from 'antd';
import {
  SearchOutlined, EditOutlined, DeleteOutlined, PlusOutlined,
  EnvironmentOutlined, UserOutlined, ClockCircleOutlined
} from '@ant-design/icons';
import { useBanHang } from '../../hooks/useBanHang';
import TaoBanMoi from './TaoBanMoi';

const { Title } = Typography;
const { Option } = Select;
const { RangePicker } = DatePicker;

const QuanLyKhuVuc = () => {
  const [selectedKhuVuc, setSelectedKhuVuc] = useState(null);
  const [modalVisible, setModalVisible] = useState(false);
  const [editingKhuVuc, setEditingKhuVuc] = useState(null);
  const [searchText, setSearchText] = useState('');
  const [filterStatus, setFilterStatus] = useState('all');
  
  const {
    danhSachKhuVuc,
    danhSachBanTheoKhuVuc,
    loading,
    getDanhSachKhuVuc,
    getDanhSachBanTheoKhuVuc,
    taoKhuVucMoi,
    suaKhuVuc,
    xoaKhuVuc
  } = useBanHang();

  useEffect(() => {
    getDanhSachKhuVuc();
  }, []);

  const handleKhuVucClick = async (khuVuc) => {
    setSelectedKhuVuc(khuVuc);
    await getDanhSachBanTheoKhuVuc(khuVuc.id);
  };

  const handleEditKhuVuc = (khuVuc) => {
    setEditingKhuVuc(khuVuc);
    setModalVisible(true);
  };

  const handleDeleteKhuVuc = (khuVuc) => {
    Modal.confirm({
      title: 'Xác nhận xóa khu vực',
      content: `Bạn có chắc chắn muốn xóa khu vực "${khuVuc.tenKhuVuc}"? Tất cả bàn trong khu vực này cũng sẽ bị xóa.`,
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          await xoaKhuVuc(khuVuc.id);
          message.success('Xóa khu vực thành công!');
          if (selectedKhuVuc?.id === khuVuc.id) {
            setSelectedKhuVuc(null);
          }
        } catch (error) {
          message.error('Không thể xóa khu vực!');
        }
      }
    });
  };

  const handleModalSuccess = () => {
    setModalVisible(false);
    setEditingKhuVuc(null);
    getDanhSachKhuVuc();
  };

  const filteredKhuVuc = danhSachKhuVuc?.filter(khuVuc => {
    const matchSearch = khuVuc.tenKhuVuc.toLowerCase().includes(searchText.toLowerCase()) ||
                       khuVuc.moTa?.toLowerCase().includes(searchText.toLowerCase());
    
    const matchStatus = filterStatus === 'all' || 
                       (filterStatus === 'active' && khuVuc.hoatDong) ||
                       (filterStatus === 'inactive' && !khuVuc.hoatDong);
    
    return matchSearch && matchStatus;
  });

  const columns = [
    {
      title: 'Tên bàn',
      dataIndex: 'tenBan',
      key: 'tenBan',
      render: (text, record) => (
        <Space>
          <span>{text}</span>
          <Tag color={getTrangThaiColor(record.trangThai)}>
            {getTrangThaiText(record.trangThai)}
          </Tag>
        </Space>
      )
    },
    {
      title: 'Sức chứa',
      dataIndex: 'sucChua',
      key: 'sucChua',
      render: (text) => (
        <Space>
          <UserOutlined />
          {text} người
        </Space>
      )
    },
    {
      title: 'Vị trí',
      dataIndex: 'viTri',
      key: 'viTri'
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: (trangThai) => (
        <Tag color={getTrangThaiColor(trangThai)}>
          {getTrangThaiText(trangThai)}
        </Tag>
      )
    },
    {
      title: 'Thao tác',
      key: 'actions',
      render: (_, record) => (
        <Space>
          <Tooltip title="Sửa thông tin">
            <Button 
              type="text" 
              icon={<EditOutlined />}
              onClick={() => console.log('Edit ban:', record.id)}
            />
          </Tooltip>
          <Tooltip title="Xóa bàn">
            <Button 
              type="text" 
              danger 
              icon={<DeleteOutlined />}
              onClick={() => console.log('Delete ban:', record.id)}
              disabled={record.trangThai !== 'trong'}
            />
          </Tooltip>
        </Space>
      )
    }
  ];

  const getTrangThaiColor = (trangThai) => {
    const colors = {
      'trong': 'default',
      'co_khach': 'processing',
      'dang_phuc_vu': 'warning',
      'cho_thanh_toan': 'error',
      'tam_khoa': 'volcano'
    };
    return colors[trangThai] || 'default';
  };

  const getTrangThaiText = (trangThai) => {
    const texts = {
      'trong': 'Trống',
      'co_khach': 'Có khách',
      'dang_phuc_vu': 'Đang phục vụ',
      'cho_thanh_toan': 'Chờ thanh toán',
      'tam_khoa': 'Tạm khóa'
    };
    return texts[trangThai] || trangThai;
  };

  return (
    <div className="quan-ly-khu-vuc">
      <div className="page-header">
        <Row justify="space-between" align="middle">
          <Col>
            <Title level={3}>Quản lý khu vực</Title>
          </Col>
          <Col>
            <Button 
              type="primary" 
              icon={<PlusOutlined />}
              onClick={() => setModalVisible(true)}
            >
              Thêm khu vực mới
            </Button>
          </Col>
        </Row>
      </div>

      <Row gutter={16}>
        {/* Danh sách khu vực */}
        <Col span={8}>
          <Card title="Danh sách khu vực">
            <Space direction="vertical" style={{ width: '100%', marginBottom: 16 }}>
              <Input
                placeholder="Tìm kiếm khu vực..."
                prefix={<SearchOutlined />}
                value={searchText}
                onChange={(e) => setSearchText(e.target.value)}
              />
              <Select
                style={{ width: '100%' }}
                placeholder="Lọc theo trạng thái"
                value={filterStatus}
                onChange={setFilterStatus}
              >
                <Option value="all">Tất cả</Option>
                <Option value="active">Đang hoạt động</Option>
                <Option value="inactive">Tạm ngưng</Option>
              </Select>
            </Space>

            <div className="khu-vuc-list">
              {filteredKhuVuc?.map(khuVuc => (
                <Card
                  key={khuVuc.id}
                  size="small"
                  className={`khu-vuc-item ${selectedKhuVuc?.id === khuVuc.id ? 'selected' : ''}`}
                  onClick={() => handleKhuVucClick(khuVuc)}
                  hoverable
                  actions={[
                    <Tooltip title="Sửa khu vực">
                      <Button 
                        type="text" 
                        icon={<EditOutlined />}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleEditKhuVuc(khuVuc);
                        }}
                      />
                    </Tooltip>,
                    <Tooltip title="Xóa khu vực">
                      <Button 
                        type="text" 
                        danger 
                        icon={<DeleteOutlined />}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleDeleteKhuVuc(khuVuc);
                        }}
                        disabled={khuVuc.soBan > 0}
                      />
                    </Tooltip>
                  ]}
                >
                  <Card.Meta
                    avatar={<EnvironmentOutlined style={{ fontSize: 20 }} />}
                    title={
                      <Space>
                        {khuVuc.tenKhuVuc}
                        <Tag color={khuVuc.hoatDong ? 'green' : 'red'}>
                          {khuVuc.hoatDong ? 'Hoạt động' : 'Tạm ngưng'}
                        </Tag>
                      </Space>
                    }
                    description={
                      <Space direction="vertical" size="small">
                        <span>{khuVuc.moTa}</span>
                        <span>
                          <UserOutlined /> {khuVuc.soBan} bàn
                        </span>
                      </Space>
                    }
                  />
                </Card>
              ))}
            </div>
          </Card>
        </Col>

        {/* Chi tiết khu vực */}
        <Col span={16}>
          {selectedKhuVuc ? (
            <Card 
              title={`Chi tiết khu vực: ${selectedKhuVuc.tenKhuVuc}`}
              extra={
                <Space>
                  <Button 
                    icon={<PlusOutlined />}
                    onClick={() => console.log('Add table to area:', selectedKhuVuc.id)}
                  >
                    Thêm bàn
                  </Button>
                </Space>
              }
            >
              <div className="khu-vuc-stats">
                <Row gutter={16} style={{ marginBottom: 16 }}>
                  <Col span={6}>
                    <Card size="small">
                      <div className="stat-item">
                        <span className="stat-label">Tổng số bàn</span>
                        <span className="stat-value">{danhSachBanTheoKhuVuc?.length || 0}</span>
                      </div>
                    </Card>
                  </Col>
                  <Col span={6}>
                    <Card size="small">
                      <div className="stat-item">
                        <span className="stat-label">Bàn trống</span>
                        <span className="stat-value" style={{ color: '#52c41a' }}>
                          {danhSachBanTheoKhuVuc?.filter(b => b.trangThai === 'trong').length || 0}
                        </span>
                      </div>
                    </Card>
                  </Col>
                  <Col span={6}>
                    <Card size="small">
                      <div className="stat-item">
                        <span className="stat-label">Bàn có khách</span>
                        <span className="stat-value" style={{ color: '#faad14' }}>
                          {danhSachBanTheoKhuVuc?.filter(b => ['co_khach', 'dang_phuc_vu', 'cho_thanh_toan'].includes(b.trangThai)).length || 0}
                        </span>
                      </div>
                    </Card>
                  </Col>
                  <Col span={6}>
                    <Card size="small">
                      <div className="stat-item">
                        <span className="stat-label">Bàn khóa</span>
                        <span className="stat-value" style={{ color: '#ff4d4f' }}>
                          {danhSachBanTheoKhuVuc?.filter(b => b.trangThai === 'tam_khoa').length || 0}
                        </span>
                      </div>
                    </Card>
                  </Col>
                </Row>
              </div>

              <Table
                columns={columns}
                dataSource={danhSachBanTheoKhuVuc}
                rowKey="id"
                loading={loading}
                pagination={{
                  pageSize: 10,
                  showSizeChanger: true,
                  showQuickJumper: true,
                  showTotal: (total) => `Tổng ${total} bàn`
                }}
              />
            </Card>
          ) : (
            <Card>
              <div style={{ textAlign: 'center', padding: '60px 0' }}>
                <EnvironmentOutlined style={{ fontSize: 48, color: '#d9d9d9' }} />
                <p style={{ marginTop: 16, color: '#999' }}>
                  Chọn một khu vực để xem chi tiết
                </p>
              </div>
            </Card>
          )}
        </Col>
      </Row>

      {/* Modal tạo/sửa khu vực */}
      <TaoKhuVucMoi 
        visible={modalVisible}
        onCancel={() => {
          setModalVisible(false);
          setEditingKhuVuc(null);
        }}
        onSuccess={handleModalSuccess}
        editingKhuVuc={editingKhuVuc}
      />
    </div>
  );
};

// Component tạo khu vực mới
const TaoKhuVucMoi = ({ visible, onCancel, onSuccess, editingKhuVuc = null }) => {
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);
  
  const { taoKhuVucMoi, suaKhuVuc } = useBanHang();

  useEffect(() => {
    if (visible) {
      if (editingKhuVuc) {
        form.setFieldsValue({
          tenKhuVuc: editingKhuVuc.tenKhuVuc,
          moTa: editingKhuVuc.moTa,
          hoatDong: editingKhuVuc.hoatDong,
          ghiChu: editingKhuVuc.ghiChu
        });
      } else {
        form.resetFields();
      }
    }
  }, [visible, editingKhuVuc, form]);

  const handleSubmit = async (values) => {
    setLoading(true);
    try {
      if (editingKhuVuc) {
        await suaKhuVuc(editingKhuVuc.id, values);
        message.success('Cập nhật khu vực thành công!');
      } else {
        await taoKhuVucMoi(values);
        message.success('Tạo khu vực mới thành công!');
      }
      
      form.resetFields();
      onSuccess?.();
    } catch (error) {
      message.error(editingKhuVuc ? 'Không thể cập nhật khu vực!' : 'Không thể tạo khu vực mới!');
    } finally {
      setLoading(false);
    }
  };

  return (
    <Modal
      title={editingKhuVuc ? 'Sửa thông tin khu vực' : 'Tạo khu vực mới'}
      open={visible}
      onCancel={onCancel}
      footer={null}
      width={500}
      destroyOnClose
    >
      <Form
        form={form}
        layout="vertical"
        onFinish={handleSubmit}
        initialValues={{
          hoatDong: true
        }}
      >
        <Form.Item
          name="tenKhuVuc"
          label="Tên khu vực"
          rules={[
            { required: true, message: 'Vui lòng nhập tên khu vực!' },
            { min: 1, max: 100, message: 'Tên khu vực phải từ 1-100 ký tự!' }
          ]}
        >
          <Input placeholder="Ví dụ: Tầng 1, Khu VIP, Sân thượng..." />
        </Form.Item>

        <Form.Item
          name="moTa"
          label="Mô tả"
        >
          <Input.TextArea 
            rows={3} 
            placeholder="Mô tả chi tiết về khu vực..."
            maxLength={500}
            showCount
          />
        </Form.Item>

        <Form.Item
          name="hoatDong"
          label="Trạng thái hoạt động"
          valuePropName="checked"
        >
          <Switch 
            checkedChildren="Hoạt động" 
            unCheckedChildren="Tạm ngưng"
          />
        </Form.Item>

        <Form.Item
          name="ghiChu"
          label="Ghi chú"
        >
          <Input.TextArea 
            rows={2} 
            placeholder="Ghi chú thêm..."
            maxLength={200}
            showCount
          />
        </Form.Item>

        <Row justify="end">
          <Space>
            <Button onClick={onCancel}>
              Hủy
            </Button>
            <Button 
              type="primary" 
              htmlType="submit" 
              loading={loading}
            >
              {editingKhuVuc ? 'Cập nhật' : 'Tạo khu vực'}
            </Button>
          </Space>
        </Row>
      </Form>
    </Modal>
  );
};

export default QuanLyKhuVuc;
