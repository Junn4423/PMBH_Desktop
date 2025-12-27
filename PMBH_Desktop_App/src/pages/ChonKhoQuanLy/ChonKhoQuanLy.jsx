import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Typography,
  Input,
  List,
  Tag,
  Button,
  Space,
  Row,
  Col,
  Statistic,
  Empty,
  message
} from 'antd';
import {
  Package,
  MapPin,
  Phone,
  User,
  RefreshCw,
  Star,
  Building
} from 'lucide-react';
import { getDanhSachKho } from '../../services/apiServices';

const { Text, Paragraph } = Typography;

const STORAGE_KEY = 'app.defaultWarehouse';

const ChonKhoQuanLy = () => {
  const [warehouses, setWarehouses] = useState([]);
  const [loading, setLoading] = useState(false);
  const [searchValue, setSearchValue] = useState('');
  const [defaultWarehouse, setDefaultWarehouse] = useState(() => {
    if (typeof window === 'undefined') {
      return null;
    }
    try {
      return window.localStorage.getItem(STORAGE_KEY);
    } catch (error) {
      return null;
    }
  });

  const fetchWarehouses = useCallback(async () => {
    setLoading(true);
    try {
      const data = await getDanhSachKho();
      setWarehouses(Array.isArray(data) ? data : []);
    } catch (error) {
      console.error(error);
      message.error('Khong the tai danh sach kho.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
  }, [fetchWarehouses]);

  useEffect(() => {
    if (typeof window === 'undefined') {
      return;
    }
    try {
      if (defaultWarehouse) {
        window.localStorage.setItem(STORAGE_KEY, defaultWarehouse);
      } else {
        window.localStorage.removeItem(STORAGE_KEY);
      }
    } catch (error) {
      // ignore storage issues
    }
  }, [defaultWarehouse]);

  const filteredWarehouses = useMemo(() => {
    if (!searchValue) {
      return warehouses;
    }
    const keyword = searchValue.trim().toLowerCase();
    return warehouses.filter((item) => {
      const values = [
        item?.maKho,
        item?.tenKho,
        item?.tenCongTy,
        item?.viTriKho,
        item?.maThuKho,
        item?.soDt,
        item?.ghiChu
      ]
        .filter(Boolean)
        .map((value) => String(value).toLowerCase());
      return values.some((value) => value.includes(keyword));
    });
  }, [searchValue, warehouses]);

  const stats = useMemo(() => {
    const total = warehouses.length;
    const companyCount = new Set(
      warehouses
        .map((item) => (item?.tenCongTy || '').trim())
        .filter(Boolean)
    ).size;
    const withContact = warehouses.filter((item) => item?.soDt).length;
    const withManager = warehouses.filter((item) => item?.maThuKho).length;

    return {
      total,
      companyCount,
      withContact,
      withManager
    };
  }, [warehouses]);

  const handleChooseWarehouse = (maKho) => {
    setDefaultWarehouse(maKho);
    message.success('Da chon kho mac dinh.');
  };

  const handleClearDefault = () => {
    setDefaultWarehouse(null);
    message.info('Da bo chon kho mac dinh.');
  };

  return (
    <div className="chon-kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Muc chung</Breadcrumb.Item>
        <Breadcrumb.Item>Bang dieu khien nguoi dung</Breadcrumb.Item>
        <Breadcrumb.Item>Chon kho quan ly</Breadcrumb.Item>
      </Breadcrumb>

      <Row gutter={[16, 16]}>
        <Col xs={24} md={6}>
          <Card>
            <Statistic
              title="Tong so kho"
              value={stats.total}
              prefix={<Building size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} md={6}>
          <Card>
            <Statistic
              title="Doanh nghiep"
              value={stats.companyCount}
              prefix={<Package size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} md={6}>
          <Card>
            <Statistic
              title="Co thong tin lien he"
              value={stats.withContact}
              prefix={<Phone size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} md={6}>
          <Card>
            <Statistic
              title="Co thu kho phu trach"
              value={stats.withManager}
              prefix={<User size={18} />}
            />
          </Card>
        </Col>
      </Row>

      <Card
        title={
          <Space size={8}>
            <Package size={18} />
            <Text strong>Danh sach kho</Text>
          </Space>
        }
        extra={
          <Space>
            {defaultWarehouse ? (
              <Button size="small" onClick={handleClearDefault}>
                Bo mac dinh
              </Button>
            ) : null}
            <Button
              size="small"
              icon={<RefreshCw size={16} />}
              onClick={fetchWarehouses}
            >
              Lam moi
            </Button>
          </Space>
        }
        style={{ marginTop: 16 }}
      >
        <Input.Search
          allowClear
          placeholder="Tim theo ma kho, ten kho, cong ty, vi tri..."
          value={searchValue}
          onChange={(e) => setSearchValue(e.target.value)}
          style={{ marginBottom: 16 }}
        />

        <List
          loading={loading}
          itemLayout="vertical"
          dataSource={filteredWarehouses}
          locale={{
            emptyText: loading ? null : <Empty description="Khong co kho phu hop" />
          }}
          renderItem={(item) => {
            const isDefault = defaultWarehouse === item?.maKho;
            return (
              <List.Item
                actions={[
                  <Button
                    key="select"
                    type={isDefault ? 'primary' : 'link'}
                    onClick={() => handleChooseWarehouse(item?.maKho)}
                    disabled={isDefault}
                  >
                    {isDefault ? 'Dang mac dinh' : 'Chon lam mac dinh'}
                  </Button>
                ]}
              >
                <Space align="start" size={16}>
                  <Package size={28} style={{ color: '#1677ff', marginTop: 4 }} />
                  <div>
                    <Space size={8} wrap>
                      <Text strong>{item?.tenKho || item?.maKho || 'Kho chua dat ten'}</Text>
                      {item?.maKho ? <Tag color="blue">{item.maKho}</Tag> : null}
                      {isDefault ? (
                        <Tag color="gold" icon={<Star size={14} />}>
                          MAC DINH
                        </Tag>
                      ) : null}
                    </Space>
                    <Paragraph type="secondary" style={{ marginBottom: 8 }}>
                      {item?.tenCongTy
                        ? `Cong ty: ${item.tenCongTy}`
                        : 'Chua cap nhat cong ty'}
                    </Paragraph>
                    <Space direction="vertical" size={4}>
                      {item?.viTriKho ? (
                        <Space size={6}>
                          <MapPin size={14} />
                          <span>{item.viTriKho}</span>
                        </Space>
                      ) : null}
                      <Space size={6}>
                        <Phone size={14} />
                        <span>{item?.soDt || 'Chua cap nhat so lien he'}</span>
                      </Space>
                      <Space size={6}>
                        <User size={14} />
                        <span>{item?.maThuKho || 'Chua gan thu kho'}</span>
                      </Space>
                      {item?.ghiChu ? (
                        <Text type="secondary">Ghi chu: {item.ghiChu}</Text>
                      ) : null}
                    </Space>
                  </div>
                </Space>
              </List.Item>
            );
          }}
        />
      </Card>
    </div>
  );
};

export default ChonKhoQuanLy;

