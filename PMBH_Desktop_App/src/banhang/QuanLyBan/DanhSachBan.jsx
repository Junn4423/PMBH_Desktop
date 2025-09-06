import React, { useState, useEffect } from 'react';
import { 
  Card, Row, Col, Button, Tag, Modal, Dropdown, Menu, 
  Typography, Space, Tooltip, Badge, message 
} from 'antd';
import {
  PlusOutlined, EditOutlined, DeleteOutlined, EyeOutlined,
  UserOutlined, ClockCircleOutlined, DollarOutlined,
  MoreOutlined, CoffeeOutlined
} from '@ant-design/icons';
import { useBanHang } from '../../hooks/useBanHang';

const { Title, Text } = Typography;

const DanhSachBan = () => {
  const [selectedBan, setSelectedBan] = useState(null);
  const [modalVisible, setModalVisible] = useState(false);
  const [viewMode, setViewMode] = useState('grid'); // 'grid' or 'list'
  
  const {
    danhSachBan,
    loading,
    getDanhSachBan,
    moKhoaBan,
    chuyenTrangThaiBan,
    xoaBan
  } = useBanHang();

  useEffect(() => {
    getDanhSachBan();
  }, []);

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

  const handleBanClick = (ban) => {
    setSelectedBan(ban);
    
    // Redirect to order page if table has customers
    if (ban.trangThai !== 'trong' && ban.trangThai !== 'tam_khoa') {
      // TODO: Navigate to order page
      console.log('Navigate to order page for ban:', ban.id);
    }
  };

  const handleMenuClick = (action, ban) => {
    switch (action) {
      case 'edit':
        // TODO: Open edit modal
        console.log('Edit ban:', ban.id);
        break;
      case 'delete':
        handleDeleteBan(ban);
        break;
      case 'lock':
        handleLockBan(ban);
        break;
      case 'unlock':
        handleUnlockBan(ban);
        break;
      case 'view':
        setSelectedBan(ban);
        setModalVisible(true);
        break;
      default:
        break;
    }
  };

  const handleDeleteBan = (ban) => {
    Modal.confirm({
      title: 'Xác nhận xóa bàn',
      content: `Bạn có chắc chắn muốn xóa bàn "${ban.tenBan}"?`,
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          await xoaBan(ban.id);
          message.success('Xóa bàn thành công!');
        } catch (error) {
          message.error('Không thể xóa bàn!');
        }
      }
    });
  };

  const handleLockBan = async (ban) => {
    try {
      await chuyenTrangThaiBan(ban.id, 'tam_khoa');
      message.success('Khóa bàn thành công!');
    } catch (error) {
      message.error('Không thể khóa bàn!');
    }
  };

  const handleUnlockBan = async (ban) => {
    try {
      await chuyenTrangThaiBan(ban.id, 'trong');
      message.success('Mở khóa bàn thành công!');
    } catch (error) {
      message.error('Không thể mở khóa bàn!');
    }
  };

  const getMenuItems = (ban) => [
    {
      key: 'view',
      label: 'Xem chi tiết',
      icon: <EyeOutlined />
    },
    {
      key: 'edit',
      label: 'Sửa thông tin',
      icon: <EditOutlined />
    },
    {
      type: 'divider'
    },
    ban.trangThai === 'tam_khoa' ? {
      key: 'unlock',
      label: 'Mở khóa',
      icon: <UserOutlined />
    } : {
      key: 'lock',
      label: 'Khóa bàn',
      icon: <UserOutlined />
    },
    {
      type: 'divider'
    },
    {
      key: 'delete',
      label: 'Xóa bàn',
      icon: <DeleteOutlined />,
      danger: true,
      disabled: ban.trangThai !== 'trong'
    }
  ];

  const renderBanCard = (ban) => (
    <Card
      key={ban.id}
      className={`ban-card ${ban.trangThai}`}
      onClick={() => handleBanClick(ban)}
      hoverable
      actions={[
        <Dropdown
          menu={{
            items: getMenuItems(ban),
            onClick: ({ key }) => handleMenuClick(key, ban)
          }}
          trigger={['click']}
          onClick={(e) => e.stopPropagation()}
        >
          <Button type="text" icon={<MoreOutlined />} />
        </Dropdown>
      ]}
    >
      <Card.Meta
        avatar={
          <Badge
            count={ban.soKhach || 0}
            showZero={false}
            offset={[-10, 10]}
          >
            <CoffeeOutlined 
              style={{ 
                fontSize: 24, 
                color: ban.trangThai === 'tam_khoa' ? '#ccc' : '#1890ff' 
              }} 
            />
          </Badge>
        }
        title={
          <Space>
            <Text strong>{ban.tenBan}</Text>
            <Tag color={getTrangThaiColor(ban.trangThai)}>
              {getTrangThaiText(ban.trangThai)}
            </Tag>
          </Space>
        }
        description={
          <Space direction="vertical" size="small" style={{ width: '100%' }}>
            <Text type="secondary">
              <UserOutlined /> Sức chứa: {ban.sucChua} người
            </Text>
            <Text type="secondary">
              Khu vực: {ban.khuVuc}
            </Text>
            {ban.trangThai !== 'trong' && ban.trangThai !== 'tam_khoa' && (
              <>
                <Text type="secondary">
                  <ClockCircleOutlined /> Bắt đầu: {ban.thoiGianBatDau}
                </Text>
                {ban.tongTien && (
                  <Text type="secondary">
                    <DollarOutlined /> Tổng tiền: {ban.tongTien?.toLocaleString()} VNĐ
                  </Text>
                )}
              </>
            )}
          </Space>
        }
      />
    </Card>
  );

  return (
    <div className="danh-sach-ban">
      <div className="page-header">
        <Row justify="space-between" align="middle">
          <Col>
            <Title level={3}>Quản lý bàn</Title>
          </Col>
          <Col>
            <Space>
              <Button 
                type="primary" 
                icon={<PlusOutlined />}
                onClick={() => {
                  // TODO: Open create table modal
                  console.log('Create new table');
                }}
              >
                Thêm bàn mới
              </Button>
            </Space>
          </Col>
        </Row>
      </div>

      <div className="table-stats">
        <Row gutter={16}>
          <Col span={6}>
            <Card>
              <div className="stat-item">
                <Text type="secondary">Tổng số bàn</Text>
                <Title level={4}>{danhSachBan?.length || 0}</Title>
              </div>
            </Card>
          </Col>
          <Col span={6}>
            <Card>
              <div className="stat-item">
                <Text type="secondary">Bàn trống</Text>
                <Title level={4} style={{ color: '#52c41a' }}>
                  {danhSachBan?.filter(b => b.trangThai === 'trong').length || 0}
                </Title>
              </div>
            </Card>
          </Col>
          <Col span={6}>
            <Card>
              <div className="stat-item">
                <Text type="secondary">Bàn có khách</Text>
                <Title level={4} style={{ color: '#faad14' }}>
                  {danhSachBan?.filter(b => ['co_khach', 'dang_phuc_vu', 'cho_thanh_toan'].includes(b.trangThai)).length || 0}
                </Title>
              </div>
            </Card>
          </Col>
          <Col span={6}>
            <Card>
              <div className="stat-item">
                <Text type="secondary">Bàn khóa</Text>
                <Title level={4} style={{ color: '#ff4d4f' }}>
                  {danhSachBan?.filter(b => b.trangThai === 'tam_khoa').length || 0}
                </Title>
              </div>
            </Card>
          </Col>
        </Row>
      </div>

      <div className="table-grid">
        <Row gutter={[16, 16]}>
          {danhSachBan?.map(ban => (
            <Col key={ban.id} xs={24} sm={12} md={8} lg={6} xl={4}>
              {renderBanCard(ban)}
            </Col>
          ))}
        </Row>
      </div>

      {/* Chi tiết bàn Modal */}
      <Modal
        title={`Chi tiết bàn: ${selectedBan?.tenBan}`}
        open={modalVisible}
        onCancel={() => setModalVisible(false)}
        footer={null}
        width={600}
      >
        {selectedBan && (
          <div className="ban-detail">
            <Row gutter={16}>
              <Col span={12}>
                <Space direction="vertical">
                  <Text><strong>Tên bàn:</strong> {selectedBan.tenBan}</Text>
                  <Text><strong>Khu vực:</strong> {selectedBan.khuVuc}</Text>
                  <Text><strong>Sức chứa:</strong> {selectedBan.sucChua} người</Text>
                  <Text><strong>Trạng thái:</strong> 
                    <Tag color={getTrangThaiColor(selectedBan.trangThai)}>
                      {getTrangThaiText(selectedBan.trangThai)}
                    </Tag>
                  </Text>
                </Space>
              </Col>
              <Col span={12}>
                {selectedBan.trangThai !== 'trong' && selectedBan.trangThai !== 'tam_khoa' && (
                  <Space direction="vertical">
                    <Text><strong>Số khách:</strong> {selectedBan.soKhach}</Text>
                    <Text><strong>Thời gian bắt đầu:</strong> {selectedBan.thoiGianBatDau}</Text>
                    <Text><strong>Nhân viên phục vụ:</strong> {selectedBan.nhanVienPhucVu}</Text>
                    {selectedBan.tongTien && (
                      <Text><strong>Tổng tiền:</strong> {selectedBan.tongTien?.toLocaleString()} VNĐ</Text>
                    )}
                  </Space>
                )}
              </Col>
            </Row>
            
            {selectedBan.ghiChu && (
              <div style={{ marginTop: 16 }}>
                <Text><strong>Ghi chú:</strong> {selectedBan.ghiChu}</Text>
              </div>
            )}
          </div>
        )}
      </Modal>
    </div>
  );
};

export default DanhSachBan;
