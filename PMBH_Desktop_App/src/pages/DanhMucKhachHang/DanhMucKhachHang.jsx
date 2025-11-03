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
const DEFAULT_PAGE_SIZE = 20;

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
    return `Hoa don ${invoiceCode} can cong ${Number(pointsEarned).toLocaleString('vi-VN')} diem.`;
  }
  if (invoiceCode) {
    return `Hoa don ${invoiceCode} can gan voi khach hang.`;
  }
  if (pointsEarned) {
    return `Can cong ${Number(pointsEarned).toLocaleString('vi-VN')} diem cho khach hang.`;
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
        message.warning(response?.message || 'Khong tim thay thong tin khach hang');
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
        message.warning(response?.message || 'Khong lay duoc lich su tich diem');
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
    (customer, options = {}) => {
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
      if (options.openAddPoints) {
        addPointsForm.setFieldsValue({
          points: options.points ? Number(options.points) : null,
          invoiceCode: options.invoiceCode || '',
          note: options.note || ''
        });
        setAddPointsVisible(true);
        setPrefillContext(null);
      }
    },
    [addPointsForm, loadHistory, loadSummary, setPrefillContext]
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
          message.warning(response?.message || 'Khong the tai danh sach khach hang');
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
        message.error('Khong the tai danh sach khach hang');
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
      fetchCustomers({ page: 1, limit: pageSize, keyword: trimmed });
    },
    [fetchCustomers, pageSize]
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
        message.warning('Vui long nhap ma khach hang va ho ten');
        return;
      }
      setRegistering(true);
      try {
        const payload = { customerId, name, phone };
        const response = await registerLoyaltyCustomer(payload);
        if (response?.success === false) {
          message.error(response?.message || 'Khong the luu thong tin khach hang');
          return;
        }
        message.success('Da luu thong tin khach hang');
        const list = await fetchCustomers({
          page: 1,
          limit: pageSize,
          keyword: customerId
        });
        const target =
          list.find((item) => item.customerId === customerId) ||
          normalizeLoyaltyCustomer({ customerId, name, phone });
        handleSelectCustomer(target);
        if (prefillContext && Number(prefillContext.pointsEarned) > 0) {
          addPointsForm.setFieldsValue({
            points: Number(prefillContext.pointsEarned),
            invoiceCode: prefillContext.invoiceCode || '',
            note: ''
          });
          setAddPointsVisible(true);
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
        message.error('Khong the luu thong tin khach hang');
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
        message.warning('Vui long nhap so diem hop le (> 0)');
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
        message.error(response?.message || 'Khong the cong diem cho khach hang');
      } else {
        message.success('Da cong diem cho khach hang');
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
      message.error('Khong the cong diem cho khach hang');
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
          handleSelectCustomer(match, {
            openAddPoints: pointsEarned && Number(pointsEarned) > 0,
            points: pointsEarned,
            invoiceCode
          });
          setCreateModalVisible(false);
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
        title: 'Ma KH',
        dataIndex: 'customerId',
        key: 'customerId',
        width: 120
      },
      {
        title: 'Ho ten',
        dataIndex: 'name',
        key: 'name',
        width: 200
      },
      {
        title: 'So dien thoai',
        dataIndex: 'phone',
        key: 'phone',
        width: 160
      },
      {
        title: 'Tong diem',
        dataIndex: 'totalPoints',
        key: 'totalPoints',
        width: 120,
        render: (value) => formatPoints(value)
      },
      {
        title: 'Da su dung',
        dataIndex: 'usedPoints',
        key: 'usedPoints',
        width: 120,
        render: (value) => formatPoints(value)
      },
      {
        title: 'Con lai',
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
      showTotal: (total) => `Tong ${total} khach hang`
    }),
    [currentPage, pageSize, totalRecords]
  );

  const historyContent = useMemo(() => {
    if (!selectedCustomer) {
      return <Empty description="Chon khach hang de xem lich su" />;
    }
    if (!history.length) {
      return <Empty description="Chua co lich su tich diem" />;
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
              extra={<Tag color={positive ? 'green' : 'red'}>{positive ? 'Cong' : 'Tru'}</Tag>}
            >
              <Space direction="vertical" size={0}>
                <Text strong style={{ color: positive ? '#389e0d' : '#d4380d' }}>
                  {positive ? `+${formatPoints(item.points)}` : `-${formatPoints(Math.abs(item.points))}`}
                </Text>
                <Text type="secondary">{formatDateTime(item.createdAt)}</Text>
                {item.orderCode ? (
                  <Text type="secondary">Hoa don: {item.orderCode}</Text>
                ) : null}
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
            Quan ly khach hang tich diem
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
              title="Danh sach khach hang"
              extra={
                <Button
                  type="primary"
                  icon={<UserPlus size={16} />}
                  onClick={handleOpenCreateModal}
                >
                  Them khach hang
                </Button>
              }
            >
              <Space style={{ marginBottom: 16 }} wrap>
                <Input.Search
                  placeholder="Tim ma khach hang, ten hoac so dien thoai"
                  allowClear
                  enterButton="Tim"
                  value={searchValue}
                  onChange={(event) => setSearchValue(event.target.value)}
                  onSearch={handleSearch}
                  style={{ minWidth: 280 }}
                />
                <Button icon={<RefreshCw size={16} />} onClick={handleRefresh}>
                  Lam moi
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
            <Card title="Thong tin khach hang">
              {selectedCustomer ? (
                <>
                  <Space direction="vertical" size={4}>
                    <Text strong>{selectedCustomer.name || 'Khach hang'}</Text>
                    <Text type="secondary">Ma: {selectedCustomer.customerId}</Text>
                    <Text type="secondary">SDT: {selectedCustomer.phone}</Text>
                  </Space>
                  <Divider />
                  <Row gutter={16}>
                    <Col span={8}>
                      <Statistic
                        title="Tong diem"
                        value={summary?.accumulated ?? selectedCustomer.totalPoints}
                        precision={0}
                      />
                    </Col>
                    <Col span={8}>
                      <Statistic
                        title="Da su dung"
                        value={summary?.redeemed ?? selectedCustomer.usedPoints}
                        precision={0}
                      />
                    </Col>
                    <Col span={8}>
                      <Statistic
                        title="Con lai"
                        value={summary?.balance ?? selectedCustomer.remainingPoints}
                        precision={0}
                      />
                    </Col>
                  </Row>
                </>
              ) : (
                <Empty description="Chon khach hang de xem chi tiet" />
              )}
            </Card>

            <Card title="Lich su tich diem">{historyContent}</Card>
          </Space>
        </Col>
      </Row>

      <Modal
        title="Them khach hang"
        open={createModalVisible}
        onCancel={() => {
          setCreateModalVisible(false);
          if (!prefillContext) {
            registerForm.resetFields();
          }
        }}
        onOk={() => registerForm.submit()}
        okText="Luu"
        cancelText="Huy"
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
            label="Ma khach hang (so dien thoai)"
            name="customerId"
            rules={[
              { required: true, message: 'Vui long nhap ma khach hang' },
              { min: 3, message: 'Ma khach hang toi thieu 3 ky tu' }
            ]}
          >
            <Input placeholder="VD: 0987123456" maxLength={30} />
          </Form.Item>
          <Form.Item
            label="Ho ten"
            name="name"
            rules={[{ required: true, message: 'Vui long nhap ho ten' }]}
          >
            <Input placeholder="Ho ten khach hang" maxLength={120} />
          </Form.Item>
          <Form.Item label="So dien thoai" name="phone">
            <Input placeholder="Nhap so dien thoai neu khac ma khach hang" maxLength={30} />
          </Form.Item>
        </Form>
      </Modal>

      <Modal
        title="Cong diem cho khach hang"
        open={addPointsVisible}
        onCancel={() => {
          setAddPointsVisible(false);
          addPointsForm.resetFields();
        }}
        onOk={handleSubmitAddPoints}
        okText="Cong diem"
        cancelText="Huy"
        confirmLoading={addPointsLoading}
        destroyOnClose
      >
        {selectedCustomer ? (
          <Space direction="vertical" size="middle" style={{ width: '100%' }}>
            <div>
              <Text strong>{selectedCustomer.name}</Text>
              <div>
                <Text type="secondary">Ma: {selectedCustomer.customerId}</Text>
              </div>
            </div>
            <Form layout="vertical" form={addPointsForm}>
              <Form.Item
                label="So diem cong"
                name="points"
                rules={[
                  { required: true, message: 'Vui long nhap so diem' },
                  {
                    validator: (_, value) => {
                      if (!value || Number(value) <= 0) {
                        return Promise.reject(new Error('So diem phai lon hon 0'));
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
                  placeholder="Nhap so diem can cong"
                />
              </Form.Item>
              <Form.Item label="Ma hoa don" name="invoiceCode">
                <Input placeholder="Lien ket voi hoa don (neu co)" />
              </Form.Item>
              <Form.Item label="Ghi chu" name="note">
                <Input.TextArea rows={3} placeholder="Ghi chu bo sung (neu co)" />
              </Form.Item>
            </Form>
          </Space>
        ) : (
          <Empty description="Chon khach hang truoc khi cong diem" />
        )}
      </Modal>
    </div>
  );
};

export default DanhMucKhachHang;

