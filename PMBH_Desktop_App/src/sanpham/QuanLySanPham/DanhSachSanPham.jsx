import React, { useState, useEffect } from 'react';
import { 
  Card, Table, Button, Input, Select, Row, Col, Space, 
  Tag, Modal, message, Image, Typography, Switch, Tooltip,
  Statistic, Badge, Dropdown, Menu
} from 'antd';
import {
  PlusOutlined, EditOutlined, DeleteOutlined, SearchOutlined,
  FilterOutlined, EyeOutlined, CopyOutlined, ExportOutlined,
  ImportOutlined, BarChartOutlined, MoreOutlined, StockOutlined,
  DollarOutlined, PackageOutlined
} from '@ant-design/icons';
import { useSanPham } from '../../hooks/useSanPham';
import TaoSanPham from './TaoSanPham';
import ChiTietSanPham from './ChiTietSanPham';

const { Title, Text } = Typography;
const { Option } = Select;

const DanhSachSanPham = () => {
  const [searchText, setSearchText] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('all');
  const [selectedStatus, setSelectedStatus] = useState('all');
  const [priceRange, setPriceRange] = useState('all');
  const [stockFilter, setStockFilter] = useState('all');
  const [modalVisible, setModalVisible] = useState(false);
  const [detailModalVisible, setDetailModalVisible] = useState(false);
  const [editingSanPham, setEditingSanPham] = useState(null);
  const [selectedSanPham, setSelectedSanPham] = useState(null);
  const [selectedRowKeys, setSelectedRowKeys] = useState([]);
  const [pagination, setPagination] = useState({
    current: 1,
    pageSize: 20,
    total: 0
  });

  const {
    danhSachSanPham,
    danhSachDanhMuc,
    thongKeSanPham,
    loading,
    getDanhSachSanPham,
    getDanhSachDanhMuc,
    getThongKeSanPham,
    xoaSanPham,
    capNhatTrangThai,
    saoChepSanPham,
    xuatDanhSach,
    nhapDanhSach
  } = useSanPham();

  useEffect(() => {
    loadData();
    getDanhSachDanhMuc();
    getThongKeSanPham();
  }, []);

  const loadData = (params = {}) => {
    const searchParams = {
      page: pagination.current,
      pageSize: pagination.pageSize,
      searchText,
      danhMucId: selectedCategory === 'all' ? undefined : selectedCategory,
      trangThai: selectedStatus === 'all' ? undefined : selectedStatus,
      priceRange: priceRange === 'all' ? undefined : priceRange,
      stockFilter: stockFilter === 'all' ? undefined : stockFilter,
      ...params
    };

    getDanhSachSanPham(searchParams);
  };

  const handleSearch = () => {
    setPagination({ ...pagination, current: 1 });
    loadData({ page: 1 });
  };

  const handleReset = () => {
    setSearchText('');
    setSelectedCategory('all');
    setSelectedStatus('all');
    setPriceRange('all');
    setStockFilter('all');
    setSelectedRowKeys([]);
    setPagination({ ...pagination, current: 1 });
    
    getDanhSachSanPham({
      page: 1,
      pageSize: pagination.pageSize
    });
  };

  const handleTableChange = (paginationInfo) => {
    const newPagination = {
      ...pagination,
      current: paginationInfo.current,
      pageSize: paginationInfo.pageSize
    };
    setPagination(newPagination);
    loadData({
      page: paginationInfo.current,
      pageSize: paginationInfo.pageSize
    });
  };

  const handleCreate = () => {
    setEditingSanPham(null);
    setModalVisible(true);
  };

  const handleEdit = (sanPham) => {
    setEditingSanPham(sanPham);
    setModalVisible(true);
  };

  const handleViewDetail = (sanPham) => {
    setSelectedSanPham(sanPham);
    setDetailModalVisible(true);
  };

  const handleDelete = (sanPham) => {
    Modal.confirm({
      title: 'Xác nhận xóa sản phẩm',
      content: `Bạn có chắc chắn muốn xóa sản phẩm "${sanPham.tenSanPham}"?`,
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          await xoaSanPham(sanPham.id);
          message.success('Xóa sản phẩm thành công!');
          loadData();
          getThongKeSanPham();
        } catch (error) {
          message.error('Không thể xóa sản phẩm!');
        }
      }
    });
  };

  const handleBulkDelete = () => {
    Modal.confirm({
      title: `Xác nhận xóa ${selectedRowKeys.length} sản phẩm`,
      content: 'Bạn có chắc chắn muốn xóa các sản phẩm đã chọn?',
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          await Promise.all(selectedRowKeys.map(id => xoaSanPham(id)));
          message.success('Xóa sản phẩm thành công!');
          setSelectedRowKeys([]);
          loadData();
          getThongKeSanPham();
        } catch (error) {
          message.error('Không thể xóa sản phẩm!');
        }
      }
    });
  };

  const handleStatusChange = async (sanPhamId, checked) => {
    try {
      await capNhatTrangThai(sanPhamId, checked ? 'hoat_dong' : 'ngung_ban');
      message.success('Cập nhật trạng thái thành công!');
      loadData();
    } catch (error) {
      message.error('Không thể cập nhật trạng thái!');
    }
  };

  const handleCopy = async (sanPham) => {
    try {
      await saoChepSanPham(sanPham.id);
      message.success('Sao chép sản phẩm thành công!');
      loadData();
    } catch (error) {
      message.error('Không thể sao chép sản phẩm!');
    }
  };

  const handleExport = async () => {
    try {
      await xuatDanhSach({
        searchText,
        danhMucId: selectedCategory === 'all' ? undefined : selectedCategory,
        trangThai: selectedStatus === 'all' ? undefined : selectedStatus
      });
      message.success('Xuất danh sách thành công!');
    } catch (error) {
      message.error('Không thể xuất danh sách!');
    }
  };

  const handleModalSuccess = () => {
    setModalVisible(false);
    setEditingSanPham(null);
    loadData();
    getThongKeSanPham();
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const getTrangThaiColor = (trangThai) => {
    const colors = {
      'hoat_dong': 'success',
      'ngung_ban': 'error',
      'het_hang': 'warning',
      'sap_het': 'orange'
    };
    return colors[trangThai] || 'default';
  };

  const getTrangThaiText = (trangThai) => {
    const texts = {
      'hoat_dong': 'Đang bán',
      'ngung_ban': 'Ngưng bán',
      'het_hang': 'Hết hàng',
      'sap_het': 'Sắp hết'
    };
    return texts[trangThai] || trangThai;
  };

  const getStockStatus = (soLuongTon, mucCanhBao) => {
    if (soLuongTon <= 0) return { status: 'het_hang', color: 'error' };
    if (soLuongTon <= mucCanhBao) return { status: 'sap_het', color: 'warning' };
    return { status: 'con_hang', color: 'success' };
  };

  const getActionMenu = (record) => [
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
      key: 'copy',
      label: 'Sao chép',
      icon: <CopyOutlined />
    },
    {
      type: 'divider'
    },
    {
      key: 'delete',
      label: 'Xóa sản phẩm',
      icon: <DeleteOutlined />,
      danger: true
    }
  ];

  const handleMenuClick = (key, record) => {
    switch (key) {
      case 'view':
        handleViewDetail(record);
        break;
      case 'edit':
        handleEdit(record);
        break;
      case 'copy':
        handleCopy(record);
        break;
      case 'delete':
        handleDelete(record);
        break;
      default:
        break;
    }
  };

  const columns = [
    {
      title: 'Hình ảnh',
      dataIndex: 'hinhAnh',
      key: 'hinhAnh',
      render: (hinhAnh, record) => (
        <Image
          src={hinhAnh || '/images/no-image.png'}
          alt={record.tenSanPham}
          width={60}
          height={60}
          preview={false}
          style={{ borderRadius: 8, objectFit: 'cover' }}
        />
      ),
      width: 80
    },
    {
      title: 'Thông tin sản phẩm',
      key: 'thongTin',
      render: (_, record) => (
        <Space direction="vertical" size="small">
          <Text strong style={{ fontSize: 14 }}>{record.tenSanPham}</Text>
          <Text type="secondary" style={{ fontSize: 12 }}>
            {record.maSanPham}
          </Text>
          <Tag color="blue" size="small">
            {record.tenDanhMuc}
          </Tag>
        </Space>
      ),
      width: 200
    },
    {
      title: 'Giá bán',
      key: 'giaBan',
      render: (_, record) => (
        <Space direction="vertical" size="small">
          <Text strong style={{ color: '#1890ff' }}>
            {formatPrice(record.giaBan)} VNĐ
          </Text>
          {record.giaKhuyenMai && (
            <Text delete type="secondary" style={{ fontSize: 12 }}>
              {formatPrice(record.giaKhuyenMai)} VNĐ
            </Text>
          )}
        </Space>
      ),
      align: 'right',
      width: 120
    },
    {
      title: 'Tồn kho',
      key: 'tonKho',
      render: (_, record) => {
        const stockStatus = getStockStatus(record.soLuongTon, record.mucCanhBao);
        return (
          <Space direction="vertical" size="small">
            <Text strong>
              <Badge 
                status={stockStatus.color} 
                text={`${record.soLuongTon} ${record.donViTinh}`}
              />
            </Text>
            <Text type="secondary" style={{ fontSize: 12 }}>
              Nhập: {record.soLuongNhap || 0}
            </Text>
          </Space>
        );
      },
      align: 'center',
      width: 100
    },
    {
      title: 'Đã bán',
      dataIndex: 'soLuongDaBan',
      key: 'soLuongDaBan',
      render: (soLuong) => (
        <Text>{soLuong || 0}</Text>
      ),
      align: 'center',
      width: 80
    },
    {
      title: 'Trạng thái',
      key: 'trangThai',
      render: (_, record) => (
        <Space direction="vertical" size="small">
          <Tag color={getTrangThaiColor(record.trangThai)}>
            {getTrangThaiText(record.trangThai)}
          </Tag>
          <Switch
            size="small"
            checked={record.trangThai === 'hoat_dong'}
            onChange={(checked) => handleStatusChange(record.id, checked)}
          />
        </Space>
      ),
      width: 120
    },
    {
      title: 'Ngày tạo',
      dataIndex: 'ngayTao',
      key: 'ngayTao',
      render: (date) => new Date(date).toLocaleDateString('vi-VN'),
      width: 100
    },
    {
      title: 'Thao tác',
      key: 'actions',
      render: (_, record) => (
        <Space>
          <Tooltip title="Xem chi tiết">
            <Button 
              type="text" 
              icon={<EyeOutlined />}
              onClick={() => handleViewDetail(record)}
            />
          </Tooltip>
          <Tooltip title="Sửa">
            <Button 
              type="text" 
              icon={<EditOutlined />}
              onClick={() => handleEdit(record)}
            />
          </Tooltip>
          <Dropdown
            menu={{
              items: getActionMenu(record),
              onClick: ({ key }) => handleMenuClick(key, record)
            }}
            trigger={['click']}
          >
            <Button type="text" icon={<MoreOutlined />} />
          </Dropdown>
        </Space>
      ),
      width: 120,
      fixed: 'right'
    }
  ];

  const rowSelection = {
    selectedRowKeys,
    onChange: setSelectedRowKeys,
    getCheckboxProps: (record) => ({
      disabled: record.trangThai === 'het_hang'
    })
  };

  return (
    <div className="danh-sach-san-pham">
      {/* Header */}
      <div className="page-header">
        <Row justify="space-between" align="middle">
          <Col>
            <Title level={3}>Quản lý sản phẩm</Title>
          </Col>
          <Col>
            <Space>
              <Button 
                icon={<ImportOutlined />}
                onClick={() => {
                  // TODO: Open import modal
                  console.log('Import products');
                }}
              >
                Nhập file
              </Button>
              <Button 
                icon={<ExportOutlined />}
                onClick={handleExport}
              >
                Xuất file
              </Button>
              <Button 
                type="primary" 
                icon={<PlusOutlined />}
                onClick={handleCreate}
              >
                Thêm sản phẩm
              </Button>
            </Space>
          </Col>
        </Row>
      </div>

      {/* Thống kê */}
      <Row gutter={16} style={{ marginBottom: 16 }}>
        <Col span={6}>
          <Card>
            <Statistic
              title="Tổng sản phẩm"
              value={thongKeSanPham?.tongSanPham || 0}
              prefix={<PackageOutlined />}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Đang bán"
              value={thongKeSanPham?.dangBan || 0}
              prefix={<StockOutlined />}
              valueStyle={{ color: '#3f8600' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Sắp hết hàng"
              value={thongKeSanPham?.sapHet || 0}
              prefix={<BarChartOutlined />}
              valueStyle={{ color: '#faad14' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Tổng giá trị"
              value={thongKeSanPham?.tongGiaTri || 0}
              prefix={<DollarOutlined />}
              suffix="VNĐ"
              valueStyle={{ color: '#1890ff' }}
            />
          </Card>
        </Col>
      </Row>

      {/* Bộ lọc */}
      <Card className="filter-card" style={{ marginBottom: 16 }}>
        <Row gutter={16} align="middle">
          <Col span={6}>
            <Input
              placeholder="Tìm kiếm sản phẩm..."
              prefix={<SearchOutlined />}
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
              onPressEnter={handleSearch}
              allowClear
            />
          </Col>
          <Col span={4}>
            <Select
              style={{ width: '100%' }}
              placeholder="Danh mục"
              value={selectedCategory}
              onChange={setSelectedCategory}
            >
              <Option value="all">Tất cả danh mục</Option>
              {danhSachDanhMuc?.map(dm => (
                <Option key={dm.id} value={dm.id}>
                  {dm.tenDanhMuc}
                </Option>
              ))}
            </Select>
          </Col>
          <Col span={3}>
            <Select
              style={{ width: '100%' }}
              placeholder="Trạng thái"
              value={selectedStatus}
              onChange={setSelectedStatus}
            >
              <Option value="all">Tất cả</Option>
              <Option value="hoat_dong">Đang bán</Option>
              <Option value="ngung_ban">Ngưng bán</Option>
              <Option value="het_hang">Hết hàng</Option>
            </Select>
          </Col>
          <Col span={3}>
            <Select
              style={{ width: '100%' }}
              placeholder="Giá bán"
              value={priceRange}
              onChange={setPriceRange}
            >
              <Option value="all">Tất cả</Option>
              <Option value="0-50000">Dưới 50K</Option>
              <Option value="50000-100000">50K - 100K</Option>
              <Option value="100000-200000">100K - 200K</Option>
              <Option value="200000+">Trên 200K</Option>
            </Select>
          </Col>
          <Col span={3}>
            <Select
              style={{ width: '100%' }}
              placeholder="Tồn kho"
              value={stockFilter}
              onChange={setStockFilter}
            >
              <Option value="all">Tất cả</Option>
              <Option value="con_hang">Còn hàng</Option>
              <Option value="sap_het">Sắp hết</Option>
              <Option value="het_hang">Hết hàng</Option>
            </Select>
          </Col>
          <Col span={5}>
            <Space>
              <Button 
                type="primary" 
                icon={<SearchOutlined />}
                onClick={handleSearch}
              >
                Tìm kiếm
              </Button>
              <Button 
                icon={<FilterOutlined />}
                onClick={handleReset}
              >
                Đặt lại
              </Button>
            </Space>
          </Col>
        </Row>

        {selectedRowKeys.length > 0 && (
          <Row style={{ marginTop: 16 }}>
            <Col span={24}>
              <Space>
                <Text>Đã chọn {selectedRowKeys.length} sản phẩm</Text>
                <Button 
                  danger 
                  size="small"
                  onClick={handleBulkDelete}
                >
                  Xóa đã chọn
                </Button>
                <Button 
                  size="small"
                  onClick={() => setSelectedRowKeys([])}
                >
                  Bỏ chọn
                </Button>
              </Space>
            </Col>
          </Row>
        )}
      </Card>

      {/* Bảng dữ liệu */}
      <Card>
        <Table
          columns={columns}
          dataSource={danhSachSanPham}
          rowKey="id"
          loading={loading}
          pagination={{
            ...pagination,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} sản phẩm`,
            pageSizeOptions: ['10', '20', '50', '100']
          }}
          onChange={handleTableChange}
          rowSelection={rowSelection}
          scroll={{ x: 1200 }}
          size="small"
        />
      </Card>

      {/* Modals */}
      <TaoSanPham
        visible={modalVisible}
        onCancel={() => {
          setModalVisible(false);
          setEditingSanPham(null);
        }}
        onSuccess={handleModalSuccess}
        editingSanPham={editingSanPham}
      />

      <ChiTietSanPham
        visible={detailModalVisible}
        onClose={() => {
          setDetailModalVisible(false);
          setSelectedSanPham(null);
        }}
        sanPham={selectedSanPham}
      />
    </div>
  );
};

export default DanhSachSanPham;
