import React, { useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Row,
  Col,
  Statistic,
  Space,
  DatePicker,
  Select,
  Input,
  Button,
  Table,
  Tag,
  Typography,
  message
} from 'antd';
import { ReloadOutlined, FilterOutlined, SearchOutlined } from '@ant-design/icons';
import dayjs from 'dayjs';
import { Trash2 } from 'lucide-react';
import {
  fetchCancelLogs,
  buildDefaultDateRange
} from '../../services/cancelLog_api';
import './XemThongTinXoaDonHang.css';

const { RangePicker } = DatePicker;
const { Option } = Select;
const { Text } = Typography;
const DEFAULT_PAGE_SIZE = 10;

const cloneRange = (range) => {
  if (!Array.isArray(range)) {
    return [null, null];
  }
  return [range[0], range[1]];
};

const XemThongTinXoaDonHang = () => {
  const initialRange = useMemo(() => buildDefaultDateRange(), []);
  const [filters, setFilters] = useState({
    page: 1,
    pageSize: DEFAULT_PAGE_SIZE,
    keyword: '',
    user: '',
    reasonCode: '',
    dateRange: cloneRange(initialRange)
  });
  const [formState, setFormState] = useState({
    keyword: '',
    user: '',
    reasonCode: '',
    dateRange: cloneRange(initialRange)
  });
  const [data, setData] = useState([]);
  const [pagination, setPagination] = useState({
    page: 1,
    pageSize: DEFAULT_PAGE_SIZE,
    total: 0,
    totalPages: 0
  });
  const [availableReasons, setAvailableReasons] = useState([]);
  const [availableUsers, setAvailableUsers] = useState([]);
  const [summary, setSummary] = useState({
    reasonBreakdown: [],
    userBreakdown: []
  });
  const [loading, setLoading] = useState(false);
  const [lastUpdated, setLastUpdated] = useState(null);
  const [reloadSignal, setReloadSignal] = useState(0);

  useEffect(() => {
    let isMounted = true;
    const loadLogs = async () => {
      setLoading(true);
      try {
        const response = await fetchCancelLogs({
          page: filters.page,
          pageSize: filters.pageSize,
          keyword: filters.keyword,
          user: filters.user,
          reasonCode: filters.reasonCode,
          dateRange: filters.dateRange
        });
        if (!isMounted) return;
        setData(response.data || []);
        setPagination(response.pagination || {
          page: filters.page,
          pageSize: filters.pageSize,
          total: response.data?.length || 0,
          totalPages: 0
        });
        setSummary(response.summary || { reasonBreakdown: [], userBreakdown: [] });
        setAvailableReasons(response.availableReasons || []);
        setAvailableUsers(response.availableUsers || []);
        setLastUpdated(response.fetchedAt || new Date().toISOString());
      } catch (error) {
        if (isMounted) {
          message.error(error.message || 'Không thể tải log hủy hóa đơn');
        }
      } finally {
        if (isMounted) {
          setLoading(false);
        }
      }
    };

    loadLogs();
    return () => {
      isMounted = false;
    };
  }, [filters, reloadSignal]);

  const handleTableChange = (tableConfig) => {
    setFilters((prev) => ({
      ...prev,
      page: tableConfig.current,
      pageSize: tableConfig.pageSize
    }));
  };

  const handleFilterChange = (field, value) => {
    setFormState((prev) => ({
      ...prev,
      [field]: value
    }));
  };

  const handleApplyFilters = () => {
    setFilters((prev) => ({
      ...prev,
      page: 1,
      keyword: formState.keyword,
      user: formState.user,
      reasonCode: formState.reasonCode,
      dateRange: formState.dateRange ? cloneRange(formState.dateRange) : [null, null]
    }));
  };

  const handleResetFilters = () => {
    const newRange = buildDefaultDateRange();
    setFormState({
      keyword: '',
      user: '',
      reasonCode: '',
      dateRange: cloneRange(newRange)
    });
    setFilters((prev) => ({
      ...prev,
      page: 1,
      keyword: '',
      user: '',
      reasonCode: '',
      dateRange: cloneRange(newRange)
    }));
  };

  const columns = useMemo(() => ([
    {
      title: 'Thời gian',
      dataIndex: 'timestamp',
      key: 'timestamp',
      width: 190,
      render: (value) => (value ? dayjs(value).format('DD/MM/YYYY HH:mm:ss') : '-')
    },
    {
      title: 'Hóa đơn / Bàn',
      dataIndex: 'invoiceId',
      key: 'invoice',
      render: (_, record) => (
        <div className="cancel-log__cell">
          <Text strong>{record.invoiceId || 'Không xác định'}</Text>
          <Text type="secondary" className="cancel-log__muted">
            Bàn: {record.tableId || 'N/A'}
          </Text>
          {record.customerName && (
            <Text type="secondary" className="cancel-log__muted">
              Khách: {record.customerName}
            </Text>
          )}
        </div>
      )
    },
    {
      title: 'Lý do',
      dataIndex: 'cancelReasonLabel',
      key: 'reason',
      render: (_, record) => (
        <div className="cancel-log__cell">
          <Tag color={record.cancelReasonColor || 'default'}>{record.cancelReasonLabel || 'Không xác định'}</Tag>
          {record.cancelReasonNote && (
            <Text type="secondary" className="cancel-log__muted">
              {record.cancelReasonNote}
            </Text>
          )}
          {record.cancelReasonGroup && (
            <Text type="secondary" className="cancel-log__muted">
              Nhóm: {record.cancelReasonGroup}
            </Text>
          )}
        </div>
      )
    },
    {
      title: 'Trạng thái trước đó',
      dataIndex: 'previousStatusLabel',
      key: 'status',
      width: 160,
      render: (value) => value || '-'
    },
    {
      title: 'Nhân viên',
      dataIndex: 'userId',
      key: 'userId',
      width: 140,
      render: (value) => value || '-'
    }
  ]), []);

  const totalLogs = pagination.total || data.length;
  const topReason = summary.reasonBreakdown?.[0];
  const topUser = summary.userBreakdown?.[0];

  return (
    <div className="xem-thong-tin-xoa-don-hang-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Kinh doanh' },
          { title: 'Quản lý bán nhà hàng' },
          { title: 'Xem thông tin xóa đơn hàng' }
        ]}
        className="page-breadcrumb"
      />

      <Card
        title={
          <div className="page-title">
            <Trash2 size={20} />
            <span>Xem thông tin xóa đơn hàng</span>
          </div>
        }
        className="main-card"
      >
        <Row gutter={16} className="cancel-log-summary-row">
          <Col xs={24} md={8}>
            <Card size="small" bordered={false} className="cancel-log-summary-card">
              <Statistic title="Tổng số lần hủy" value={totalLogs} />
              <Text type="secondary">
                Cập nhật: {lastUpdated ? dayjs(lastUpdated).format('HH:mm:ss DD/MM/YYYY') : 'Chưa có dữ liệu'}
              </Text>
            </Card>
          </Col>
          <Col xs={24} md={8}>
            <Card size="small" bordered={false} className="cancel-log-summary-card">
              <Statistic
                title="Lý do phổ biến"
                value={topReason ? `${topReason.cancelReasonLabel} (${topReason.total})` : 'N/A'}
              />
            </Card>
          </Col>
          <Col xs={24} md={8}>
            <Card size="small" bordered={false} className="cancel-log-summary-card">
              <Statistic
                title="Nhân viên thao tác nhiều"
                value={topUser ? `${topUser.userId} (${topUser.total})` : 'N/A'}
              />
            </Card>
          </Col>
        </Row>

        <Card className="cancel-log-filter-card" size="small">
          <Row gutter={16} align="middle">
            <Col xs={24} md={10}>
              <RangePicker
                value={formState.dateRange}
                allowClear={false}
                format="DD/MM/YYYY"
                onChange={(range) => handleFilterChange('dateRange', range)}
                style={{ width: '100%' }}
              />
            </Col>
            <Col xs={24} md={4}>
              <Select
                placeholder="Lý do"
                allowClear
                value={formState.reasonCode || undefined}
                onChange={(value) => handleFilterChange('reasonCode', value || '')}
                style={{ width: '100%' }}
              >
                {availableReasons.map((reason) => (
                  <Option key={reason.code} value={reason.code}>
                    {reason.label}
                  </Option>
                ))}
              </Select>
            </Col>
            <Col xs={24} md={4}>
              <Select
                placeholder="Nhân viên"
                allowClear
                value={formState.user || undefined}
                onChange={(value) => handleFilterChange('user', value || '')}
                style={{ width: '100%' }}
              >
                {availableUsers.map((user) => (
                  <Option key={user} value={user}>
                    {user}
                  </Option>
                ))}
              </Select>
            </Col>
            <Col xs={24} md={6}>
              <Input
                placeholder="Tìm theo mã hóa đơn, bàn, ghi chú"
                prefix={<SearchOutlined />}
                value={formState.keyword}
                onChange={(e) => handleFilterChange('keyword', e.target.value)}
              />
            </Col>
          </Row>
          <Space style={{ marginTop: 16 }}>
            <Button icon={<FilterOutlined />} type="primary" onClick={handleApplyFilters}>
              Áp dụng
            </Button>
            <Button onClick={handleResetFilters}>Đặt lại</Button>
            <Button icon={<ReloadOutlined />} onClick={() => setReloadSignal((prev) => prev + 1)}>
              Tải lại
            </Button>
          </Space>
        </Card>

        <Card className="cancel-log-table-card" bodyStyle={{ padding: 0 }}>
          <Table
            dataSource={data}
            columns={columns}
            loading={loading}
            rowKey="id"
            scroll={{ x: 900 }}
            pagination={{
              current: filters.page,
              pageSize: filters.pageSize,
              total: pagination.total,
              showSizeChanger: true,
              pageSizeOptions: ['10', '20', '50', '100']
            }}
            onChange={handleTableChange}
          />
        </Card>
      </Card>
    </div>
  );
};

export default XemThongTinXoaDonHang;
