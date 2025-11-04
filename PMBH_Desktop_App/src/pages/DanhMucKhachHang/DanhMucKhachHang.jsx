import React, { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import { useLocation } from 'react-router-dom';
import {
  Card,
  Row,
  Col,
  Table,
  Form,
  Input,
  Button,
  Space,
  Typography,
  message,
  Divider,
  Statistic,
  List,
  Empty,
  Tag,
  Modal,
  InputNumber,
  Alert
} from 'antd';
import { UserPlus, RefreshCw } from 'lucide-react';
import {
  listLoyaltyCustomers,
  registerLoyaltyCustomer,
  getLoyaltySummary,
  getLoyaltyHistory,
  addLoyaltyPoints
} from '../../services/apiServices';

const { Title, Text } = Typography;
const DEFAULT_PAGE_SIZE = 10;

const normalizeLoyaltyCustomer = (raw) => {
  if (!raw) {
    return null;
  }
  const customerId = raw.customerId || raw.id || raw.lv001 || '';
  const name = raw.name || raw.lv002 || '';
  const phone = raw.phone || raw.lv010 || customerId;
  const group = raw.group || raw.lv022 || '';
  const totalPoints = Number(raw.totalPoints ?? raw.accumulated ?? raw.balance ?? 0);
  const usedPoints = Number(raw.usedPoints ?? raw.redeemed ?? 0);
  const remainingPoints = Number(
    raw.remainingPoints ?? raw.balance ?? totalPoints - usedPoints
  );
  return {
    customerId,
    name,
    phone,
    group,
    totalPoints,
    usedPoints,
    remainingPoints
  };
};

const formatDateTime = (value) => {
  if (!value) {
    return '';
  }
  if (typeof value === 'string' && /^\d{14}$/.test(value)) {
    return `${value.slice(6, 8)}/${value.slice(4, 6)}/${value.slice(0, 4)} ${value.slice(
      8,
      10
    )}:${value.slice(10, 12)}:${value.slice(12, 14)}`;
  }
  const date = new Date(value);
  if (!Number.isNaN(date.getTime())) {
    return date.toLocaleString('vi-VN');
  }
  return value;
};

const formatPoints = (value) => Number(value || 0).toLocaleString('vi-VN');

const buildPrefillNotice = (invoiceCode, pointsEarned) => {
  if (!invoiceCode && !pointsEarned) {
    return null;
  }
  if (invoiceCode && pointsEarned) {
    return `Hoá đơn ${invoiceCode} cần cộng ${Number(pointsEarned).toLocaleString('vi-VN')} điểm.`;
  }
  if (invoiceCode) {
    return `Hoá đơn ${invoiceCode} cần gán với khách hàng.`;
  }
  if (pointsEarned) {
    return `Hoá đơn ${invoiceCode} cần cộng ${Number(pointsEarned).toLocaleString('vi-VN')} điểm cho khách hàng.`;
  }
  return null;
};

const DanhMucKhachHang = () => {
  const location = useLocation();
  const prefillHandledRef = useRef(false);

  const [loading, setLoading] = useState(false);
  const [registering, setRegistering] = useState(false);
  const [addPointsLoading, setAddPointsLoading] = useState(false);

  const [customers, setCustomers] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [pageSize, setPageSize] = useState(DEFAULT_PAGE_SIZE);
  const [totalRecords, setTotalRecords] = useState(0);
  const [searchValue, setSearchValue] = useState('');

  const [selectedCustomer, setSelectedCustomer] = useState(null);
  const [selectedRowKeys, setSelectedRowKeys] = useState([]);
  const [summary, setSummary] = useState(null);
  const [history, setHistory] = useState([]);
  const [historyLoading, setHistoryLoading] = useState(false);

  const [prefillNotice, setPrefillNotice] = useState(null);
  const [prefillContext, setPrefillContext] = useState(null);

  const [addPointsVisible, setAddPointsVisible] = useState(false);
  const [createModalVisible, setCreateModalVisible] = useState(false);
  
  // Real-time search suggestion states
  const [searchSuggestions, setSearchSuggestions] = useState([]);
  const [showSuggestions, setShowSuggestions] = useState(false);
  const searchTimeoutRef = useRef(null);

  const [registerForm] = Form.useForm();
  const [addPointsForm] = Form.useForm();
  const searchValueRef = useRef('');
  const pageSizeRef = useRef(DEFAULT_PAGE_SIZE);
  const selectedCustomerRef = useRef(null);

  useEffect(() => {
    searchValueRef.current = searchValue;
  }, [searchValue]);

  useEffect(() => {
    pageSizeRef.current = pageSize;
  }, [pageSize]);

  useEffect(() => {
    selectedCustomerRef.current = selectedCustomer;
  }, [selectedCustomer]);

  const loadSummary = useCallback(async (customerId) => {
    if (!customerId) {
      setSummary(null);
      return;
    }
    try {
      const response = await getLoyaltySummary(customerId);
      const data = response?.data ?? response;
      if (data) {
        setSummary({
          customerId: data.customerId || customerId,
          name: data.name || '',
          phone: data.phone || '',
          group: data.group || '',
          accumulated: Number(data.accumulated ?? data.totalPoints ?? 0),
          redeemed: Number(data.redeemed ?? data.usedPoints ?? 0),
          balance: Number(data.balance ?? data.remainingPoints ?? 0)
        });
      } else if (response?.success === false) {
        message.warning(response?.message || 'Không tìm thấy thông tin khách hàng');
        setSummary(null);
      }
    } catch (error) {
      console.error('Failed to load loyalty summary:', error);
      setSummary(null);
    }
  }, []);

  const loadHistory = useCallback(async (customerId) => {
    if (!customerId) {
      setHistory([]);
      return;
    }
    setHistoryLoading(true);
    try {
      const response = await getLoyaltyHistory(customerId, { limit: 20 });
      let records = [];
      if (Array.isArray(response)) {
        records = response;
      } else if (response?.data) {
        records = response.data;
      } else if (response?.success === false) {
        message.warning(response?.message || 'Không lấy được lịch sử tích điểm');
      }
      const mapped = records.map((item, idx) => {
        const pointsValue = Number(item.points ?? item.lv004 ?? 0);
        const createdAt = item.createdAt || item.lv007 || item.lv006 || null;
        return {
          id:
            item.id ??
            item.lv001 ??
            `${customerId}-${item.orderCode || item.lv009 || 'txn'}-${createdAt || idx}`,
          points: pointsValue,
          amount: Number(item.amount ?? item.lv013 ?? 0),
          type: item.type || item.lv011 || (pointsValue >= 0 ? 'earn' : 'redeem'),
          orderCode: item.orderCode || item.lv009 || '',
          note: item.note || item.lv012 || '',
          createdAt
        };
      });
      setHistory(mapped);
    } catch (error) {
      console.error('Failed to load loyalty history:', error);
      setHistory([]);
    } finally {
      setHistoryLoading(false);
    }
  }, []);

  const handleSelectCustomer = useCallback(
    (customer) => {
      const normalized = normalizeLoyaltyCustomer(customer);
      if (!normalized) {
        setSelectedCustomer(null);
        setSelectedRowKeys([]);
        setSummary(null);
        setHistory([]);
        return;
      }
      setSelectedCustomer(normalized);
      setSelectedRowKeys([normalized.customerId]);
      loadSummary(normalized.customerId);
      loadHistory(normalized.customerId);
    },
    [loadHistory, loadSummary]
  );

  const fetchCustomers = useCallback(
    async ({ page, limit, keyword } = {}) => {
      const effectiveLimit = limit ?? pageSizeRef.current;
      const effectivePage = page ?? 1;
      const effectiveKeyword =
        keyword !== undefined ? keyword : searchValueRef.current;
      const params = {
        limit: effectiveLimit,
        offset: (effectivePage - 1) * effectiveLimit
      };

      if (effectiveKeyword && effectiveKeyword.trim()) {
        params.keyword = effectiveKeyword.trim();
      }

      setLoading(true);
      try {
        const response = await listLoyaltyCustomers(params);
        let rawList = [];
        let total = 0;
        if (Array.isArray(response)) {
          rawList = response;
          total = response.length;
        } else if (response?.success === false) {
          message.warning(response?.message || 'Không thể tải danh sách khách hàng');
        } else if (response?.data) {
          rawList = response.data;
          total = response.pagination?.total ?? rawList.length;
        }
        const normalizedList = rawList
          .map((item) => normalizeLoyaltyCustomer(item))
          .filter(Boolean);
        setCustomers(normalizedList);
        setCurrentPage(effectivePage);
        if (pageSizeRef.current !== effectiveLimit) {
          setPageSize(effectiveLimit);
        }
        pageSizeRef.current = effectiveLimit;
        setTotalRecords(total);
        const currentSelected = selectedCustomerRef.current;
        if (currentSelected) {
          const refreshed = normalizedList.find(
            (item) => item.customerId === currentSelected.customerId
          );
          if (refreshed) {
            setSelectedCustomer(refreshed);
            setSelectedRowKeys([refreshed.customerId]);
          }
        }
        return normalizedList;
      } catch (error) {
        console.error('Failed to load customers:', error);
        message.error('Không thể tải danh sách khách hàng');
        return [];
      } finally {
        setLoading(false);
      }
    },
    []
  );

  const handleSearch = useCallback(
    (value) => {
      const trimmed = (value || '').trim();
      setSearchValue(trimmed);
      setShowSuggestions(false); // Hide suggestions when searching
      fetchCustomers({ page: 1, limit: pageSize, keyword: trimmed });
    },
    [fetchCustomers, pageSize]
  );
  
  // Real-time search with suggestions
  const handleSearchInputChange = useCallback(
    async (e) => {
      const value = e.target.value;
      setSearchValue(value);
      
      // Clear previous timeout
      if (searchTimeoutRef.current) {
        clearTimeout(searchTimeoutRef.current);
      }
      
      if (value.trim().length < 2) {
        setSearchSuggestions([]);
        setShowSuggestions(false);
        return;
      }
      
      // Debounce search
      searchTimeoutRef.current = setTimeout(async () => {
        try {
          const response = await listLoyaltyCustomers({
            keyword: value.trim(),
            limit: 5
          });
          
          let rawList = [];
          if (Array.isArray(response)) {
            rawList = response;
          } else if (response?.data) {
            rawList = response.data;
          }
          
          const normalized = rawList
            .map((item) => normalizeLoyaltyCustomer(item))
            .filter(Boolean);
          
          setSearchSuggestions(normalized);
          setShowSuggestions(normalized.length > 0);
        } catch (error) {
          console.error('Real-time search error:', error);
        }
      }, 400); // 400ms debounce
    },
    []
  );
  
  const handleSelectSuggestion = useCallback(
    (customer) => {
      setSearchValue(customer.phone || customer.customerId);
      setShowSuggestions(false);
      handleSelectCustomer(customer);
      fetchCustomers({ page: 1, limit: pageSize, keyword: customer.phone || customer.customerId });
    },
    [handleSelectCustomer, fetchCustomers, pageSize]
  );

  const handleRefresh = useCallback(() => {
    fetchCustomers({ page: currentPage, limit: pageSize, keyword: searchValue });
  }, [currentPage, fetchCustomers, pageSize, searchValue]);

  const handleTableChange = useCallback(
    (pagination) => {
      fetchCustomers({ page: pagination.current, limit: pagination.pageSize });
    },
    [fetchCustomers]
  );

  const handleRegisterCustomer = useCallback(
    async (values) => {
      const customerId = (values.customerId || '').trim();
      const name = (values.name || '').trim();
      const phone = (values.phone || customerId || '').trim();
      if (!customerId || !name) {
        message.warning('Vui lòng nhập mã khách hàng và họ tên');
        return;
      }
      setRegistering(true);
      try {
        const payload = { customerId, name, phone };
        const response = await registerLoyaltyCustomer(payload);
        if (response?.success === false) {
          message.error(response?.message || 'Không thể lưu thông tin khách hàng');
          return;
        }
        message.success('Đã lưu thông tin khách hàng');
        const list = await fetchCustomers({
          page: 1,
          limit: pageSize,
          keyword: customerId
        });
        const target =
          list.find((item) => item.customerId === customerId) ||
          normalizeLoyaltyCustomer({ customerId, name, phone });
        handleSelectCustomer(target);
        if (prefillContext) {
          setPrefillContext(null);
        }
        if (response?.data) {
          setSummary({
            customerId: response.data.customerId || customerId,
            name: response.data.name || name,
            phone: response.data.phone || phone,
            group: response.data.group || '',
            accumulated: Number(response.data.accumulated ?? 0),
            redeemed: Number(response.data.redeemed ?? 0),
            balance: Number(response.data.balance ?? 0)
          });
        }
        registerForm.resetFields();
        setCreateModalVisible(false);
      } catch (error) {
        console.error('Failed to register loyalty customer:', error);
        message.error('Không thể lưu thông tin khách hàng');
      } finally {
        setRegistering(false);
      }
    },
    [fetchCustomers, handleSelectCustomer, pageSize]
  );

  const handleSubmitAddPoints = useCallback(async () => {
    if (!selectedCustomer) {
      return;
    }
    try {
      const values = await addPointsForm.validateFields();
      const points = Number(values.points);
      if (!points || points <= 0) {
        message.warning('Vui lòng nhập số điểm hợp lệ (> 0)');
        return;
      }
      const payload = {
        customerId: selectedCustomer.customerId,
        points,
        note: (values.note || '').trim(),
        orderCode: (values.invoiceCode || '').trim()
      };
      setAddPointsLoading(true);
      const response = await addLoyaltyPoints(payload);
      if (response?.success === false) {
        message.error(response?.message || 'Không thể cộng điểm cho khách hàng');
      } else {
        message.success('Đã cộng điểm cho khách hàng');
        setAddPointsVisible(false);
        addPointsForm.resetFields();
        loadSummary(selectedCustomer.customerId);
        loadHistory(selectedCustomer.customerId);
        fetchCustomers({ page: currentPage, limit: pageSize, keyword: searchValue });
      }
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error('Failed to add loyalty points:', error);
      message.error('Không thể cộng điểm cho khách hàng');
    } finally {
      setAddPointsLoading(false);
    }
  }, [
    addPointsForm,
    currentPage,
    fetchCustomers,
    loadHistory,
    loadSummary,
    pageSize,
    searchValue,
    selectedCustomer
  ]);

  const handleOpenCreateModal = useCallback(() => {
    if (!prefillContext) {
      registerForm.resetFields();
    }
    setCreateModalVisible(true);
  }, [prefillContext, registerForm]);

  useEffect(() => {
    fetchCustomers({ page: 1 });
  }, [fetchCustomers]);

  useEffect(() => {
    if (prefillHandledRef.current) {
      return;
    }
    const state = location.state;
    if (!state) {
      return;
    }
    prefillHandledRef.current = true;
    const loyaltyPrefill = state.loyaltyPrefill || null;
    const invoiceCode = state.invoiceCode || '';
    const pointsEarned = state.pointsEarned ?? null;
    setPrefillContext({ invoiceCode, pointsEarned });
    const notice = buildPrefillNotice(invoiceCode, pointsEarned);
    if (notice) {
      setPrefillNotice(notice);
    }
    const targetId =
      loyaltyPrefill?.customerId ||
      loyaltyPrefill?.id ||
      loyaltyPrefill?.phone ||
      '';
    if (targetId) {
      registerForm.setFieldsValue({
        customerId: targetId,
        name: loyaltyPrefill?.name || '',
        phone: loyaltyPrefill?.phone || targetId
      });
      fetchCustomers({ page: 1, limit: pageSize, keyword: targetId }).then((list) => {
        const match = list.find(
          (item) => item.customerId === targetId || item.phone === targetId
        );
        if (match) {
          handleSelectCustomer(match);
          setCreateModalVisible(false);
          setPrefillContext(null);
        } else {
          setCreateModalVisible(true);
          if (pointsEarned && Number(pointsEarned) > 0) {
            addPointsForm.setFieldsValue({
              points: Number(pointsEarned),
              invoiceCode: invoiceCode || '',
              note: ''
            });
          }
        }
      });
    } else if (pointsEarned && Number(pointsEarned) > 0) {
      addPointsForm.setFieldsValue({
        points: Number(pointsEarned),
        invoiceCode: invoiceCode || '',
        note: ''
      });
      setAddPointsVisible(true);
    }
    if (typeof window !== 'undefined' && window.history?.replaceState) {
      const { pathname, search } = window.location;
      window.history.replaceState({}, '', `${pathname}${search}`);
    }
  }, [addPointsForm, fetchCustomers, handleSelectCustomer, location.state, pageSize, registerForm]);

  const columns = useMemo(
    () => [
      {
        title: 'Mã KH',
        dataIndex: 'customerId',
        key: 'customerId',
        width: 120
      },
      {
        title: 'Họ tên',
        dataIndex: 'name',
        key: 'name',
        width: 200
      },
      {
        title: 'Số điện thoại',
        dataIndex: 'phone',
        key: 'phone',
        width: 160
      },
      {
        title: 'Tổng điểm',
        dataIndex: 'totalPoints',
        key: 'totalPoints',
        width: 120,
        render: (value) => formatPoints(value)
      },
      {
        title: 'Đã sử dụng',
        dataIndex: 'usedPoints',
        key: 'usedPoints',
        width: 120,
        render: (value) => formatPoints(value)
      },
      {
        title: 'Còn lại',
        dataIndex: 'remainingPoints',
        key: 'remainingPoints',
        width: 120,
        render: (value) => formatPoints(value)
      }
    ],
    []
  );

  const rowSelection = useMemo(
    () => ({
      type: 'radio',
      selectedRowKeys,
      onChange: (_, rows) => {
        if (rows && rows[0]) {
          handleSelectCustomer(rows[0]);
        }
      }
    }),
    [handleSelectCustomer, selectedRowKeys]
  );

  const paginationConfig = useMemo(
    () => ({
      current: currentPage,
      pageSize,
      total: totalRecords,
      showSizeChanger: true,
      pageSizeOptions: ['10', '20', '50', '100'],
      showTotal: (total) => `Tổng ${total} khách hàng`
    }),
    [currentPage, pageSize, totalRecords]
  );

  const historyContent = useMemo(() => {
    if (!selectedCustomer) {
      return <Empty description="Chọn khách hàng để xem lịch sử" />;
    }
    if (!history.length) {
      return <Empty description="Chưa có lịch sử tích điểm" />;
    }
    return (
      <List
        dataSource={history}
        loading={historyLoading}
        renderItem={(item) => {
          const positive = item.points >= 0;
          return (
            <List.Item
              key={item.id}
              extra={<Tag color={positive ? 'green' : 'red'}>{positive ? 'Cộng' : 'Trừ'}</Tag>}
            >
              <Space direction="vertical" size={0}>
                <Text strong style={{ color: positive ? '#389e0d' : '#d4380d' }}>
                  {positive ? `+${formatPoints(item.points)}` : `-${formatPoints(Math.abs(item.points))}`}
                </Text>
                <Text type="secondary">{formatDateTime(item.createdAt)}</Text>
                {item.orderCode ? (
                  <Text type="secondary">Hóa đơn: {item.orderCode}</Text>
                ) : null}
                {item.amount !== undefined && !Number.isNaN(item.amount) && item.amount > 0 && (
                  <Text type="secondary">
                    Thanh toán: {Number(item.amount).toLocaleString('vi-VN')}`
                  </Text>
                )}
                {item.note ? <Text>{item.note}</Text> : null}
              </Space>
            </List.Item>
          );
        }}
      />
    );
  }, [history, historyLoading, selectedCustomer]);

  return (
    <div style={{ padding: 24 }}>
      <Row justify="space-between" align="middle" style={{ marginBottom: 24 }}>
        <Col>
          <Title level={3} style={{ marginBottom: 0 }}>
            Quản lý khách hàng tích điểm
          </Title>
        </Col>
      </Row>

      {prefillNotice && (
        <Alert
          type="info"
          showIcon
          message={prefillNotice}
          closable
          onClose={() => setPrefillNotice(null)}
          style={{ marginBottom: 16 }}
        />
      )}

      <Row gutter={24}>
        <Col xl={14} lg={14} md={24}>
          <Space direction="vertical" size="large" style={{ width: '100%' }}>
            <Card
              title="Danh sách khách hàng"
              extra={
                <Button
                  type="primary"
                  icon={<UserPlus size={16} />}
                  onClick={handleOpenCreateModal}
                >
                  Thêm khách hàng
                </Button>
              }
            >
              <Space style={{ marginBottom: 16 }} wrap>
                <div style={{ position: 'relative', minWidth: 280 }}>
                  <Input.Search
                    placeholder="Tìm mã khách hàng, tên hoặc số điện thoại"
                    allowClear
                    enterButton="Tìm"
                    value={searchValue}
                    onChange={handleSearchInputChange}
                    onSearch={handleSearch}
                    onFocus={() => {
                      if (searchSuggestions.length > 0) {
                        setShowSuggestions(true);
                      }
                    }}
                    style={{ width: '100%' }}
                  />
                  {/* Real-time suggestions dropdown */}
                  {showSuggestions && searchSuggestions.length > 0 && (
                    <div style={{
                      position: 'absolute',
                      top: '100%',
                      left: 0,
                      right: 0,
                      maxHeight: '250px',
                      overflowY: 'auto',
                      background: 'white',
                      border: '1px solid #d9d9d9',
                      borderRadius: '4px',
                      boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
                      zIndex: 1000,
                      marginTop: '4px'
                    }}>
                      {searchSuggestions.map((customer) => (
                        <div
                          key={customer.customerId}
                          onClick={() => handleSelectSuggestion(customer)}
                          style={{
                            padding: '10px 12px',
                            cursor: 'pointer',
                            borderBottom: '1px solid #f0f0f0',
                            transition: 'background 0.2s'
                          }}
                          onMouseEnter={(e) => e.currentTarget.style.background = '#f5f5f5'}
                          onMouseLeave={(e) => e.currentTarget.style.background = 'white'}
                        >
                          <div style={{ fontWeight: 'bold', color: '#1890ff', marginBottom: '2px' }}>
                            {customer.name || 'Khách hàng'}
                          </div>
                          <div style={{ fontSize: '12px', color: '#666' }}>
                            Mã: {customer.customerId} | SĐT: {customer.phone}
                          </div>
                          <div style={{ fontSize: '12px', color: '#52c41a' }}>
                            Điểm: {formatPoints(customer.remainingPoints)}
                          </div>
                        </div>
                      ))}
                    </div>
                  )}
                </div>
                <Button icon={<RefreshCw size={16} />} onClick={handleRefresh}>
                  Làm mới
                </Button>
              </Space>
              <Table
                rowKey="customerId"
                columns={columns}
                dataSource={customers}
                loading={loading}
                pagination={paginationConfig}
                onChange={handleTableChange}
                rowSelection={rowSelection}
                onRow={(record) => ({
                  onClick: () => handleSelectCustomer(record),
                  style: { cursor: 'pointer' }
                })}
                size="middle"
              />
            </Card>

          </Space>
        </Col>

        <Col xl={10} lg={10} md={24}>
          <Space direction="vertical" size="large" style={{ width: '100%' }}>
            <Card title="Thông tin khách hàng">
              {selectedCustomer ? (
                <>
                  <Space direction="vertical" size={4}>
                    <Text strong>{selectedCustomer.name || 'Khách hàng'}</Text>
                    <Text type="secondary">Mã: {selectedCustomer.customerId}</Text>
                    <Text type="secondary">SDT: {selectedCustomer.phone}</Text>
                  </Space>
                  <Divider />
                  <Row gutter={16}>
                    <Col span={8}>
                      <Statistic
                        title="Tổng điểm"
                        value={summary?.accumulated ?? selectedCustomer.totalPoints}
                        precision={0}
                      />
                    </Col>
                    <Col span={8}>
                      <Statistic
                        title="Đã sử dụng"
                        value={summary?.redeemed ?? selectedCustomer.usedPoints}
                        precision={0}
                      />
                    </Col>
                    <Col span={8}>
                      <Statistic
                        title="Còn lại"
                        value={summary?.balance ?? selectedCustomer.remainingPoints}
                        precision={0}
                      />
                    </Col>
                  </Row>
                </>
              ) : (
                <Empty description="Chọn khách hàng để xem chi tiết" />
              )}
            </Card>

            <Card title="Lịch sử tích điểm">{historyContent}</Card>
          </Space>
        </Col>
      </Row>

      <Modal
        title="Thêm khách hàng"
        open={createModalVisible}
        onCancel={() => {
          setCreateModalVisible(false);
          if (!prefillContext) {
            registerForm.resetFields();
          }
        }}
        onOk={() => registerForm.submit()}
        okText="Lưu"
        cancelText="Hủy"
        confirmLoading={registering}
        destroyOnClose
      >
        <Form
          layout="vertical"
          form={registerForm}
          onFinish={handleRegisterCustomer}
          initialValues={{
            customerId: '',
            name: '',
            phone: ''
          }}
        >
          <Form.Item
            label="Mã khách hàng (số điện thoại)"
            name="customerId"
            rules={[
              { required: true, message: 'Vui lòng nhập mã khách hàng' },
              { min: 3, message: 'Mã khách hàng tối thiểu 3 ký tự' }
            ]}
          >
            <Input placeholder="VD: 0987123456" maxLength={30} />
          </Form.Item>
          <Form.Item
            label="Họ tên"
            name="name"
            rules={[{ required: true, message: 'Vui lòng nhập họ tên' }]}
          >
            <Input placeholder="Họ tên khách hàng" maxLength={120} />
          </Form.Item>
          <Form.Item label="Số điện thoại" name="phone">
            <Input placeholder="Nhập số điện thoại nếu khác mã khách hàng" maxLength={30} />
          </Form.Item>
        </Form>
      </Modal>

      <Modal
        title="Cộng điểm cho khách hàng"
        open={addPointsVisible}
        onCancel={() => {
          setAddPointsVisible(false);
          addPointsForm.resetFields();
        }}
        onOk={handleSubmitAddPoints}
        okText="Cộng điểm"
        cancelText="Hủy"
        confirmLoading={addPointsLoading}
        destroyOnClose
      >
        {selectedCustomer ? (
          <Space direction="vertical" size="middle" style={{ width: '100%' }}>
            <div>
              <Text strong>{selectedCustomer.name}</Text>
              <div>
                <Text type="secondary">Mã: {selectedCustomer.customerId}</Text>
              </div>
            </div>
            <Form layout="vertical" form={addPointsForm}>
              <Form.Item
                label="Số điểm cộng"
                name="points"
                rules={[
                  { required: true, message: 'Vui lòng nhập số điểm' },
                  {
                    validator: (_, value) => {
                      if (!value || Number(value) <= 0) {
                        return Promise.reject(new Error('Số điểm phải lớn hơn 0'));
                      }
                      return Promise.resolve();
                    }
                  }
                ]}
              >
                <InputNumber
                  min={0.01}
                  step={1}
                  precision={0}
                  style={{ width: '100%' }}
                  placeholder="Nhập số điểm cần cộng"
                />
              </Form.Item>
              <Form.Item label="Mã hóa đơn" name="invoiceCode">
                <Input placeholder="Liên kết với hóa đơn (nếu có)" />
              </Form.Item>
              <Form.Item label="Ghi chú" name="note">
                <Input.TextArea rows={3} placeholder="Ghi chú bổ sung (nếu có)" />
              </Form.Item>
            </Form>
          </Space>
        ) : (
          <Empty description="Chọn khách hàng trước khi cộng điểm" />
        )}
      </Modal>
    </div>
  );
};

export default DanhMucKhachHang;

