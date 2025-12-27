import React, { useMemo, useState, useEffect } from 'react';
import {
  Card,
  Table,
  DatePicker,
  Input,
  Select,
  Button,
  Tag,
  Space,
  Row,
  Col,
  Statistic,
  Tooltip,
  Typography,
  message
} from 'antd';
import {
  ReloadOutlined,
  FilterOutlined,
  SearchOutlined,
  BarChartOutlined,
  AlertOutlined
} from '@ant-design/icons';
import dayjs from 'dayjs';
import {
  fetchSystemLogs,
  buildDefaultDateRange,
  getVerbMeta
} from '../../services/systemlog_api';
import './SystemLogs.css';

const { RangePicker } = DatePicker;
const { Text, Paragraph } = Typography;
const DEFAULT_PAGE_SIZE = 10;

const VERB_LABEL_MAP = {
  delete: 'Xoa du lieu',
  remove: 'Xoa du lieu',
  huy: 'Huy thao tac',
  cancel: 'Huy thao tac',
  insert: 'Them du lieu',
  add: 'Them du lieu',
  update: 'Cap nhat',
  edit: 'Cap nhat',
  apr: 'Duyet',
  unapr: 'Huy duyet',
  approve: 'Duyet',
  deny: 'Tu choi',
  login: 'Dang nhap',
  logout: 'Dang xuat'
};

const cloneRange = (range) => {
  if (!Array.isArray(range)) {
    return [null, null];
  }
  return [range[0], range[1]];
};

const SystemLogs = () => {
  const initialRange = useMemo(() => buildDefaultDateRange(), []);

  const [filters, setFilters] = useState({
    page: 1,
    pageSize: DEFAULT_PAGE_SIZE,
    keyword: '',
    action: '',
    user: '',
    dateRange: cloneRange(initialRange)
  });
  const [formState, setFormState] = useState({
    keyword: '',
    action: '',
    user: '',
    dateRange: cloneRange(initialRange)
  });
  const [reloadSignal, setReloadSignal] = useState(0);
  const [data, setData] = useState([]);
  const [summary, setSummary] = useState({
    actionBreakdown: [],
    userBreakdown: [],
    verbBreakdown: []
  });
  const [availableActions, setAvailableActions] = useState([]);
  const [availableUsers, setAvailableUsers] = useState([]);
  const [pagination, setPagination] = useState({
    page: 1,
    pageSize: DEFAULT_PAGE_SIZE,
    total: 0,
    totalPages: 0
  });
  const [loading, setLoading] = useState(false);
  const [lastUpdated, setLastUpdated] = useState(null);

  useEffect(() => {
    let isMounted = true;

    const loadLogs = async () => {
      setLoading(true);
      try {
        const response = await fetchSystemLogs(filters);
        if (!isMounted) return;
        if (!response.success) {
          message.warning(response.message || 'Khong the tai du lieu log');
        }
        const normalizedData = response.data || [];
        setData(normalizedData);
        setSummary(response.summary || {
          actionBreakdown: [],
          userBreakdown: [],
          verbBreakdown: []
        });
        setAvailableActions(response.availableActions || []);
        setAvailableUsers(response.availableUsers || []);
        setPagination(response.pagination || {
          page: filters.page,
          pageSize: filters.pageSize,
          total: normalizedData.length,
          totalPages: 0
        });
        setLastUpdated(response.fetchedAt || new Date().toISOString());
      } catch (error) {
        if (isMounted) {
          message.error(error.message || 'Co loi khi tai log he thong');
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

  const handleTableChange = (paginationConfig) => {
    setFilters((prev) => ({
      ...prev,
      page: paginationConfig.current,
      pageSize: paginationConfig.pageSize
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
      action: formState.action,
      user: formState.user,
      dateRange: formState.dateRange ? cloneRange(formState.dateRange) : null
    }));
  };

  const handleResetFilters = () => {
    const newRange = buildDefaultDateRange();
    setFormState({
      keyword: '',
      action: '',
      user: '',
      dateRange: cloneRange(newRange)
    });
    setFilters((prev) => ({
      ...prev,
      page: 1,
      keyword: '',
      action: '',
      user: '',
      dateRange: cloneRange(newRange)
    }));
  };

  const handleRefresh = () => {
    setReloadSignal((prev) => prev + 1);
  };

  const columns = useMemo(() => ([
    {
      title: 'Thoi gian',
      dataIndex: 'timestamp',
      key: 'timestamp',
      width: 190,
      render: (value) => (value ? dayjs(value).format('DD/MM/YYYY HH:mm:ss') : '-')
    },
    {
      title: 'Nguoi dung',
      dataIndex: 'userId',
      key: 'userId',
      width: 140,
      render: (value) => value || '-'
    },
    {
      title: 'Hanh dong',
      dataIndex: 'actionKey',
      key: 'actionKey',
      width: 240,
      render: (value, record) => {
        const meta = getVerbMeta(record.verb);
        return (
          <div className="system-log__action-cell">
            <Tag color={meta.color} className="system-log__verb-tag">{meta.label}</Tag>
            <Text strong>{value || 'Khong xac dinh'}</Text>
            {record.resource && (
              <Text type="secondary" className="system-log__resource">
                {record.resource}
              </Text>
            )}
          </div>
        );
      }
    },
    {
      title: 'Chi tiet',
      dataIndex: 'detailsPreview',
      key: 'details',
      render: (value, record) => (
        <Tooltip title={record.details} overlayStyle={{ maxWidth: 600 }}>
          <Paragraph
            className="system-log__details"
            ellipsis={{ rows: 2, expandable: false }}
          >
            {value || record.details || '-'}
          </Paragraph>
        </Tooltip>
      )
    },
    {
      title: 'IP / Thiet bi',
      dataIndex: 'ip',
      key: 'meta',
      width: 200,
      render: (value, record) => (
        <div className="system-log__meta">
          <Text>{value || '-'}</Text>
          <Text type="secondary">{record.device || '-'}</Text>
        </div>
      )
    }
  ]), []);

  const totalLogs = pagination.total || data.length;
  const topVerb = summary.verbBreakdown?.[0];
  const topAction = summary.actionBreakdown?.[0];
  const topUser = summary.userBreakdown?.[0];

  return (
    <div className="system-logs-page">
      <Row gutter={16} className="system-logs__summary">
        <Col xs={24} md={6}>
          <Card size="small">
            <Statistic
              title="Tong so log"
              value={totalLogs}
              prefix={<BarChartOutlined />}
            />
            <Text type="secondary">
              Cap nhat: {lastUpdated ? dayjs(lastUpdated).format('HH:mm:ss DD/MM/YYYY') : 'Chua co du lieu'}
            </Text>
          </Card>
        </Col>
        <Col xs={24} md={6}>
          <Card size="small">
            <Statistic
              title="Nhom hanh dong noi bat"
              value={topVerb ? `${VERB_LABEL_MAP[topVerb.verb] || topVerb.verb} (${topVerb.total})` : 'N/A'}
              prefix={<AlertOutlined />}
            />
          </Card>
        </Col>
        <Col xs={24} md={6}>
          <Card size="small">
            <Statistic
              title="Bang duoc thao tac nhieu"
              value={topAction ? `${topAction.actionKey || ''} (${topAction.total})` : 'N/A'}
            />
          </Card>
        </Col>
        <Col xs={24} md={6}>
          <Card size="small">
            <Statistic
              title="Nguoi thao tac nhieu"
              value={topUser ? `${topUser.userId || ''} (${topUser.total})` : 'N/A'}
            />
          </Card>
        </Col>
      </Row>

      <Card
        title="Bo loc"
        className="system-logs__filters-card"
        extra={
          <Space>
            <Button icon={<ReloadOutlined />} onClick={handleRefresh}>
              Tai lai
            </Button>
            <Button onClick={handleResetFilters}>Dat lai</Button>
            <Button type="primary" icon={<SearchOutlined />} onClick={handleApplyFilters}>
              Ap dung
            </Button>
          </Space>
        }
      >
        <div className="system-logs__filters">
          <Input
            placeholder="Tim theo tu khoa, bang, cau lenh"
            value={formState.keyword}
            onChange={(e) => handleFilterChange('keyword', e.target.value)}
            prefix={<FilterOutlined />}
            allowClear
          />
          <Select
            placeholder="Loc theo hanh dong"
            value={formState.action || null}
            onChange={(value) => handleFilterChange('action', value || '')}
            allowClear
            options={availableActions.map((action) => ({ value: action, label: action }))}
            className="system-logs__select"
          />
          <Select
            placeholder="Loc theo nguoi dung"
            value={formState.user || null}
            onChange={(value) => handleFilterChange('user', value || '')}
            allowClear
            options={availableUsers.map((user) => ({ value: user, label: user }))}
            className="system-logs__select"
          />
          <RangePicker
            value={formState.dateRange && Array.isArray(formState.dateRange) ? formState.dateRange : null}
            onChange={(value) => handleFilterChange('dateRange', value ? cloneRange(value) : null)}
            showTime={{ format: 'HH:mm' }}
            format="DD/MM/YYYY HH:mm"
            className="system-logs__range-picker"
          />
        </div>
      </Card>

      <Card title="Danh sach log he thong" className="system-logs__table-card">
        <Table
          rowKey={(record) => record.id || `${record.actionKey}-${record.timestamp}`}
          columns={columns}
          dataSource={data}
          loading={loading}
          pagination={{
            current: pagination.page,
            pageSize: pagination.pageSize,
            total: pagination.total,
            showSizeChanger: true,
            showTotal: (total, range) => `${range[0]}-${range[1]} / ${total}`
          }}
          onChange={handleTableChange}
          scroll={{ x: 900 }}
        />
      </Card>
    </div>
  );
};

export default SystemLogs;
