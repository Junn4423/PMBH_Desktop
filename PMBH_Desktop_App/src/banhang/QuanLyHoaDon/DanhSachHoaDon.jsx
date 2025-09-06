import React, { useState, useEffect } from 'react';
import { 
  Card, Table, Button, Input, Select, DatePicker, Row, Col, 
  Space, Tag, Typography, Modal, message, Tooltip, Statistic
} from 'antd';
import {
  SearchOutlined, EyeOutlined, PrinterOutlined, DeleteOutlined,
  FilterOutlined, ReloadOutlined, ExportOutlined, DollarOutlined,
  ShoppingCartOutlined, CalendarOutlined, UserOutlined
} from '@ant-design/icons';
import { useHoaDon } from '../../hooks/useHoaDon';
import ChiTietHoaDon from './ChiTietHoaDon';

const { Title, Text } = Typography;
const { Option } = Select;
const { RangePicker } = DatePicker;

const DanhSachHoaDon = () => {
  const [searchText, setSearchText] = useState('');
  const [selectedStatus, setSelectedStatus] = useState('all');
  const [selectedPaymentMethod, setSelectedPaymentMethod] = useState('all');
  const [dateRange, setDateRange] = useState([]);
  const [selectedHoaDon, setSelectedHoaDon] = useState(null);
  const [detailModalVisible, setDetailModalVisible] = useState(false);
  const [pagination, setPagination] = useState({
    current: 1,
    pageSize: 20,
    total: 0
  });

  const {
    danhSachHoaDon,
    thongKeHoaDon,
    loading,
    getDanhSachHoaDon,
    getThongKeHoaDon,
    xoaHoaDon,
    inLaiHoaDon,
    xuatBaoCao
  } = useHoaDon();

  useEffect(() => {
    loadData();
    getThongKeHoaDon();
  }, []);

  const loadData = (params = {}) => {
    const searchParams = {
      page: pagination.current,
      pageSize: pagination.pageSize,
      searchText,
      trangThai: selectedStatus === 'all' ? undefined : selectedStatus,
      phuongThucThanhToan: selectedPaymentMethod === 'all' ? undefined : selectedPaymentMethod,
      tuNgay: dateRange[0]?.format('YYYY-MM-DD'),
      denNgay: dateRange[1]?.format('YYYY-MM-DD'),
      ...params
    };

    getDanhSachHoaDon(searchParams);
  };

  const handleSearch = () => {
    setPagination({ ...pagination, current: 1 });
    loadData({ page: 1 });
  };

  const handleReset = () => {
    setSearchText('');
    setSelectedStatus('all');
    setSelectedPaymentMethod('all');
    setDateRange([]);
    setPagination({ ...pagination, current: 1 });
    
    // Load lại data với params mặc định
    getDanhSachHoaDon({
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

  const handleViewDetail = (hoaDon) => {
    setSelectedHoaDon(hoaDon);
    setDetailModalVisible(true);
  };

  const handleDeleteHoaDon = (hoaDon) => {
    Modal.confirm({
      title: 'Xác nhận xóa hóa đơn',
      content: `Bạn có chắc chắn muốn xóa hóa đơn #${hoaDon.id}? Hành động này không thể hoàn tác.`,
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          await xoaHoaDon(hoaDon.id);
          message.success('Xóa hóa đơn thành công!');
          loadData();
          getThongKeHoaDon();
        } catch (error) {
          message.error('Không thể xóa hóa đơn!');
        }
      }
    });
  };

  const handlePrintHoaDon = async (hoaDon) => {
    try {
      await inLaiHoaDon(hoaDon.id);
      message.success('Đã gửi lệnh in hóa đơn!');
    } catch (error) {
      message.error('Không thể in hóa đơn!');
    }
  };

  const handleExportReport = async () => {
    try {
      const params = {
        searchText,
        trangThai: selectedStatus === 'all' ? undefined : selectedStatus,
        phuongThucThanhToan: selectedPaymentMethod === 'all' ? undefined : selectedPaymentMethod,
        tuNgay: dateRange[0]?.format('YYYY-MM-DD'),
        denNgay: dateRange[1]?.format('YYYY-MM-DD')
      };
      
      await xuatBaoCao(params);
      message.success('Đã xuất báo cáo thành công!');
    } catch (error) {
      message.error('Không thể xuất báo cáo!');
    }
  };

  const formatPrice = (price) => {
    return price?.toLocaleString() || '0';
  };

  const formatDateTime = (dateTime) => {
    return new Date(dateTime).toLocaleString('vi-VN');
  };

  const getTrangThaiColor = (trangThai) => {
    const colors = {
      'hoan_thanh': 'success',
      'huy': 'error',
      'cho_thanh_toan': 'warning',
      'da_thanh_toan': 'processing'
    };
    return colors[trangThai] || 'default';
  };

  const getTrangThaiText = (trangThai) => {
    const texts = {
      'hoan_thanh': 'Hoàn thành',
      'huy': 'Đã hủy',
      'cho_thanh_toan': 'Chờ thanh toán',
      'da_thanh_toan': 'Đã thanh toán'
    };
    return texts[trangThai] || trangThai;
  };

  const getPhuongThucText = (phuongThuc) => {
    const texts = {
      'tien_mat': 'Tiền mặt',
      'chuyen_khoan': 'Chuyển khoản',
      'qr_code': 'QR Code'
    };
    return texts[phuongThuc] || phuongThuc;
  };

  const columns = [
    {
      title: 'Mã HĐ',
      dataIndex: 'id',
      key: 'id',
      render: (id) => `#${id}`,
      width: 80
    },
    {
      title: 'Thời gian',
      dataIndex: 'thoiGianThanhToan',
      key: 'thoiGianThanhToan',
      render: (dateTime) => (
        <Space direction="vertical" size="small">
          <Text>{formatDateTime(dateTime)}</Text>
        </Space>
      ),
      width: 150
    },
    {
      title: 'Bàn',
      dataIndex: 'tenBan',
      key: 'tenBan',
      render: (tenBan) => (
        <Tag color="blue">{tenBan}</Tag>
      ),
      width: 80
    },
    {
      title: 'Khách hàng',
      dataIndex: 'khachHang',
      key: 'khachHang',
      render: (khachHang) => (
        khachHang ? (
          <Space direction="vertical" size="small">
            <Text>{khachHang.hoTen}</Text>
            <Text type="secondary" style={{ fontSize: 12 }}>
              {khachHang.soDienThoai}
            </Text>
          </Space>
        ) : (
          <Text type="secondary">Khách lẻ</Text>
        )
      ),
      width: 150
    },
    {
      title: 'Số món',
      dataIndex: 'soMon',
      key: 'soMon',
      align: 'center',
      width: 80
    },
    {
      title: 'Tổng tiền',
      dataIndex: 'tongTien',
      key: 'tongTien',
      render: (tongTien) => (
        <Text strong style={{ color: '#f5222d' }}>
          {formatPrice(tongTien)} VNĐ
        </Text>
      ),
      align: 'right',
      width: 120
    },
    {
      title: 'Phương thức',
      dataIndex: 'phuongThucThanhToan',
      key: 'phuongThucThanhToan',
      render: (phuongThuc) => (
        <Tag>{getPhuongThucText(phuongThuc)}</Tag>
      ),
      width: 120
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: (trangThai) => (
        <Tag color={getTrangThaiColor(trangThai)}>
          {getTrangThaiText(trangThai)}
        </Tag>
      ),
      width: 120
    },
    {
      title: 'Nhân viên',
      dataIndex: 'nhanVien',
      key: 'nhanVien',
      width: 120
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
          <Tooltip title="In lại hóa đơn">
            <Button 
              type="text" 
              icon={<PrinterOutlined />}
              onClick={() => handlePrintHoaDon(record)}
            />
          </Tooltip>
          <Tooltip title="Xóa hóa đơn">
            <Button 
              type="text" 
              danger 
              icon={<DeleteOutlined />}
              onClick={() => handleDeleteHoaDon(record)}
              disabled={record.trangThai === 'hoan_thanh'}
            />
          </Tooltip>
        </Space>
      ),
      width: 120,
      fixed: 'right'
    }
  ];

  return (
    <div className="danh-sach-hoa-don">
      {/* Header */}
      <div className="page-header">
        <Row justify="space-between" align="middle">
          <Col>
            <Title level={3}>Quản lý hóa đơn</Title>
          </Col>
          <Col>
            <Space>
              <Button 
                icon={<ExportOutlined />}
                onClick={handleExportReport}
              >
                Xuất báo cáo
              </Button>
              <Button 
                icon={<ReloadOutlined />}
                onClick={() => {
                  loadData();
                  getThongKeHoaDon();
                }}
              >
                Làm mới
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
              title="Tổng hóa đơn"
              value={thongKeHoaDon?.tongSoHoaDon || 0}
              prefix={<ShoppingCartOutlined />}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Doanh thu hôm nay"
              value={thongKeHoaDon?.doanhThuHomNay || 0}
              prefix={<DollarOutlined />}
              suffix="VNĐ"
              valueStyle={{ color: '#3f8600' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Hóa đơn hôm nay"
              value={thongKeHoaDon?.hoaDonHomNay || 0}
              prefix={<CalendarOutlined />}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic
              title="Khách hàng"
              value={thongKeHoaDon?.soKhachHang || 0}
              prefix={<UserOutlined />}
            />
          </Card>
        </Col>
      </Row>

      {/* Bộ lọc */}
      <Card className="filter-card" style={{ marginBottom: 16 }}>
        <Row gutter={16} align="middle">
          <Col span={6}>
            <Input
              placeholder="Tìm kiếm mã HĐ, khách hàng..."
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
              placeholder="Trạng thái"
              value={selectedStatus}
              onChange={setSelectedStatus}
            >
              <Option value="all">Tất cả trạng thái</Option>
              <Option value="cho_thanh_toan">Chờ thanh toán</Option>
              <Option value="da_thanh_toan">Đã thanh toán</Option>
              <Option value="hoan_thanh">Hoàn thành</Option>
              <Option value="huy">Đã hủy</Option>
            </Select>
          </Col>
          <Col span={4}>
            <Select
              style={{ width: '100%' }}
              placeholder="Phương thức TT"
              value={selectedPaymentMethod}
              onChange={setSelectedPaymentMethod}
            >
              <Option value="all">Tất cả phương thức</Option>
              <Option value="tien_mat">Tiền mặt</Option>
              <Option value="chuyen_khoan">Chuyển khoản</Option>
              <Option value="qr_code">QR Code</Option>
            </Select>
          </Col>
          <Col span={6}>
            <RangePicker
              style={{ width: '100%' }}
              placeholder={['Từ ngày', 'Đến ngày']}
              value={dateRange}
              onChange={setDateRange}
              format="DD/MM/YYYY"
            />
          </Col>
          <Col span={4}>
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
      </Card>

      {/* Bảng dữ liệu */}
      <Card>
        <Table
          columns={columns}
          dataSource={danhSachHoaDon}
          rowKey="id"
          loading={loading}
          pagination={{
            ...pagination,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total, range) => 
              `${range[0]}-${range[1]} của ${total} hóa đơn`,
            pageSizeOptions: ['10', '20', '50', '100']
          }}
          onChange={handleTableChange}
          scroll={{ x: 1200 }}
          size="small"
        />
      </Card>

      {/* Modal chi tiết */}
      <ChiTietHoaDon
        visible={detailModalVisible}
        onClose={() => {
          setDetailModalVisible(false);
          setSelectedHoaDon(null);
        }}
        hoaDon={selectedHoaDon}
      />
    </div>
  );
};

export default DanhSachHoaDon;
