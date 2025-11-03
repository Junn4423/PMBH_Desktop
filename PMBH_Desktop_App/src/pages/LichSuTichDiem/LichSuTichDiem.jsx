import React, { useCallback, useMemo, useState } from 'react';
import {
  Card,
  Space,
  Input,
  Button,
  Typography,
  Table,
  Modal,
  List,
  message
} from 'antd';
import { Search as SearchIcon } from 'lucide-react';
import {
  searchLoyaltyCustomers,
  getLoyaltyHistory
} from '../../services/apiServices';

const { Title, Text } = Typography;

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

const normalizeCustomer = (customer) => {
  if (!customer) {
    return null;
  }
  const id =
    customer.customerId ??
    customer.id ??
    customer.lv001 ??
    customer.maKh ??
    customer.ma_kh ??
    '';
  if (!id) {
    return null;
  }
  const name =
    customer.name ??
    customer.fullName ??
    customer.ten ??
    customer.tenKhach ??
    'Khach hang';
  const phone =
    customer.phone ??
    customer.soDienThoai ??
    customer.sdt ??
    customer.dienThoai ??
    '';

  return {
    id: String(id),
    name,
    phone,
    raw: customer
  };
};

const mapHistoryRecords = (records = []) =>
  records.map((item, index) => {
    const amount = Number(item.amount ?? item.lv013 ?? 0);
    const points = Number(item.points ?? item.lv004 ?? 0);
    const createdAt = item.createdAt || item.lv007 || item.lv006 || null;
    return {
      key:
        item.id ??
        item.lv001 ??
        `${item.orderCode || item.lv009 || 'txn'}-${createdAt || index}`,
      orderCode: item.orderCode || item.lv009 || '',
      amount,
      points,
      type: item.type || item.lv011 || (points >= 0 ? 'earn' : 'redeem'),
      note: item.note || item.lv012 || '',
      createdAt
    };
  });

const LichSuTichDiem = () => {
  const [searchValue, setSearchValue] = useState('');
  const [searching, setSearching] = useState(false);
  const [historyLoading, setHistoryLoading] = useState(false);
  const [selectedCustomer, setSelectedCustomer] = useState(null);
  const [history, setHistory] = useState([]);
  const [pickerVisible, setPickerVisible] = useState(false);
  const [searchResults, setSearchResults] = useState([]);

  const loadHistory = useCallback(async (customerId) => {
    setHistoryLoading(true);
    try {
      const response = await getLoyaltyHistory(customerId, { limit: 200 });
      let records = [];
      if (Array.isArray(response)) {
        records = response;
      } else if (response?.success && Array.isArray(response.data)) {
        records = response.data;
      } else if (Array.isArray(response?.data?.items)) {
        records = response.data.items;
      }
      setHistory(mapHistoryRecords(records));
    } catch (error) {
      console.error('Failed to load loyalty history:', error);
      message.error('Không thể tải lịch sử tích điểm');
      setHistory([]);
    } finally {
      setHistoryLoading(false);
    }
  }, []);

  const handleSelectCustomer = useCallback(
    (customer) => {
      const normalized = normalizeCustomer(customer);
      if (!normalized) {
        message.error('Không thể chọn khách hàng');
        return;
      }
      setSelectedCustomer(normalized);
      setPickerVisible(false);
      setSearchResults([]);
      setSearchValue(normalized.phone || normalized.id);
      loadHistory(normalized.id);
    },
    [loadHistory]
  );

  const handleSearchCustomers = useCallback(async () => {
    const keyword = searchValue.trim();
    if (!keyword) {
      message.warning('Vui lòng nhập số điện thoại khách hàng');
      return;
    }
    setSearching(true);
    try {
      const response = await searchLoyaltyCustomers(keyword, 10);
      let customers = [];
      if (response?.success && Array.isArray(response.data)) {
        customers = response.data;
      } else if (Array.isArray(response)) {
        customers = response;
      } else if (Array.isArray(response?.data?.items)) {
        customers = response.data.items;
      }
      const normalized = customers
        .map((item) => normalizeCustomer(item))
        .filter(Boolean);

      if (normalized.length === 0) {
        message.info('Không tìm thấy khách hàng phù hợp');
        setSearchResults([]);
        setPickerVisible(false);
        return;
      }

      if (normalized.length === 1) {
        handleSelectCustomer(normalized[0]);
        return;
      }

      setSearchResults(normalized);
      setPickerVisible(true);
    } catch (error) {
      console.error('Failed to search loyalty customers:', error);
      message.error('Không thể tìm khách hàng');
      setSearchResults([]);
      setPickerVisible(false);
    } finally {
      setSearching(false);
    }
  }, [handleSelectCustomer, searchValue]);

  const handleClearSelection = useCallback(() => {
    setSelectedCustomer(null);
    setHistory([]);
    setSearchResults([]);
    setPickerVisible(false);
  }, []);

  const columns = useMemo(
    () => [
      {
        title: 'Thời gian',
        dataIndex: 'createdAt',
        key: 'createdAt',
        render: (value) => formatDateTime(value)
      },
      {
        title: 'Mã hóa đơn',
        dataIndex: 'orderCode',
        key: 'orderCode'
      },
      {
        title: 'Số tiền',
        dataIndex: 'amount',
        key: 'amount',
        render: (value) =>
          Number(value || 0).toLocaleString('vi-VN', { minimumFractionDigits: 0 }) + ''
      },
      {
        title: 'Điểm',
        dataIndex: 'points',
        key: 'points',
        render: (value) => value.toLocaleString('vi-VN')
      },
      {
        title: 'Loại',
        dataIndex: 'type',
        key: 'type',
        render: (value) => (value === 'earn' ? 'Cộng' : value === 'redeem' ? 'Trừ' : value)
      },
      {
        title: 'Ghi chú',
        dataIndex: 'note',
        key: 'note'
      }
    ],
    []
  );

  return (
    <div style={{ padding: 24 }}>
      <Title level={3} style={{ marginBottom: 24 }}>
        Lịch sử thanh toán tích điểm
      </Title>

      <Card>
        <Space style={{ marginBottom: 16 }} wrap>
          <Input
            prefix={<SearchIcon size={14} />}
            placeholder="Nhập số điện thoại khách hàng"
            value={searchValue}
            onChange={(event) => setSearchValue(event.target.value)}
            style={{ minWidth: 260 }}
          />
          <Button type="primary" loading={searching} onClick={handleSearchCustomers}>
            Tìm khách hàng
          </Button>
          <Button onClick={handleClearSelection} disabled={!selectedCustomer && history.length === 0}>
            Xóa lựa chọn
          </Button>
        </Space>

        {selectedCustomer ? (
          <Space direction="vertical" size={0} style={{ marginBottom: 16 }}>
            <Text strong>{selectedCustomer.name}</Text>
            <Text type="secondary">
              Mã KH: {selectedCustomer.id} {selectedCustomer.phone ? `- SDT: ${selectedCustomer.phone}` : ''}
            </Text>
          </Space>
        ) : (
          <Text type="secondary" style={{ display: 'block', marginBottom: 16 }}>
            Chưa chọn khách hàng
          </Text>
        )}

        <Table
          dataSource={history}
          columns={columns}
          loading={historyLoading}
          pagination={{ pageSize: 20 }}
          locale={{
            emptyText: selectedCustomer
              ? 'Không có lịch sử tích điểm'
              : 'Chọn khách hàng để xem lịch sử'
          }}
          scroll={{ x: true }}
        />
      </Card>

      <Modal
        title="Chọn khách hàng"
        open={pickerVisible}
        footer={null}
        onCancel={() => setPickerVisible(false)}
        destroyOnClose
      >
        <List
          dataSource={searchResults}
          renderItem={(item) => (
            <List.Item
              key={item.id}
              actions={[
                <Button type="link" onClick={() => handleSelectCustomer(item.raw)} key="pick">
                  Chọn
                </Button>
              ]}
            >
              <List.Item.Meta
                title={item.name}
                description={item.phone ? `SDT: ${item.phone}` : 'Không có số điện thoại'}
              />
            </List.Item>
          )}
        />
      </Modal>
    </div>
  );
};

export default LichSuTichDiem;

