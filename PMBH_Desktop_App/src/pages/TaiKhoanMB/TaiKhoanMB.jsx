
import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Typography,
  Space,
  Button,
  Tag,
  List,
  message
} from 'antd';
import { User, Package, MapPin, Phone, RefreshCw } from 'lucide-react';
import { getDanhSachKho } from '../../services/apiServices';
import './TaiKhoanMB.css';

const { Text, Title } = Typography;
const STORAGE_KEY = 'app.defaultWarehouse';

const TaiKhoanMB = () => {
  const [warehouses, setWarehouses] = useState([]);
  const [loading, setLoading] = useState(false);
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

  const warehouseMap = useMemo(() => {
    const map = new Map();
    warehouses.forEach((item) => {
      const key = item?.maKho || item?.lv001;
      if (key) {
        map.set(key, item);
      }
    });
    return map;
  }, [warehouses]);

  const selectedWarehouse = defaultWarehouse ? warehouseMap.get(defaultWarehouse) : null;

  const handleClearDefault = () => {
    setDefaultWarehouse(null);
    if (typeof window !== 'undefined') {
      try {
        window.localStorage.removeItem(STORAGE_KEY);
      } catch (error) {
        // ignore storage issues
      }
    }
    message.info('Da bo chon kho mac dinh.');
  };

  const handleNavigateManage = () => {
    message.info('Mo trang "Chon kho quan ly" trong menu de thay doi kho mac dinh.');
  };

  return (
    <div className="tai-khoan-mb-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Muc chung</Breadcrumb.Item>
        <Breadcrumb.Item>Giao dien MB</Breadcrumb.Item>
        <Breadcrumb.Item>Tai khoan</Breadcrumb.Item>
      </Breadcrumb>

      <Card className="profile-card">
        <Space direction="vertical" size={16} style={{ width: '100%' }}>
          <Space size={12} align="center">
            <User size={40} />
            <div>
              <Title level={4} style={{ margin: 0 }}>
                Thong tin tai khoan
              </Title>
              <Text type="secondary">
                Quan ly kho mac dinh va khu vuc lam viec cho giao dien MB.
              </Text>
            </div>
          </Space>

          <Space wrap>
            <Button type="primary" onClick={handleNavigateManage}>
              Chon kho quan ly
            </Button>
            {defaultWarehouse ? (
              <Button onClick={handleClearDefault}>Bo kho mac dinh</Button>
            ) : null}
            <Button icon={<RefreshCw size={16} />} onClick={fetchWarehouses}>
              Lam moi du lieu
            </Button>
          </Space>

          <Card size="small" className="section-card" title="Kho mac dinh">
            {selectedWarehouse ? (
              <Space direction="vertical" size={6}>
                <Space size={6}>
                  <Package size={16} />
                  <Text strong>{selectedWarehouse.tenKho || selectedWarehouse.maKho}</Text>
                  <Tag color="blue">{selectedWarehouse.maKho}</Tag>
                </Space>
                <Space size={6}>
                  <MapPin size={16} />
                  <span>{selectedWarehouse.viTriKho || 'Chua cap nhat vi tri'}</span>
                </Space>
                <Space size={6}>
                  <Phone size={16} />
                  <span>{selectedWarehouse.soDt || 'Chua cap nhat so lien he'}</span>
                </Space>
                {selectedWarehouse.ghiChu ? (
                  <Text type="secondary">Ghi chu: {selectedWarehouse.ghiChu}</Text>
                ) : null}
              </Space>
            ) : (
              <Text type="secondary">
                Chua chon kho mac dinh. Bam "Chon kho quan ly" de thiet lap.
              </Text>
            )}
          </Card>
        </Space>
      </Card>

      <Card
        className="warehouses-card"
        title="Danh sach kho co the truy cap"
        loading={loading}
      >
        <List
          dataSource={warehouses}
          locale={{ emptyText: 'Khong co kho nao.' }}
          renderItem={(item) => (
            <List.Item>
              <Space direction="vertical" size={6} style={{ width: '100%' }}>
                <Space size={8}>
                  <Text strong>{item?.tenKho || item?.maKho || 'Kho chua dat ten'}</Text>
                  {item?.maKho ? <Tag color="blue">{item.maKho}</Tag> : null}
                  {item?.maKho === defaultWarehouse ? <Tag color="gold">MAC DINH</Tag> : null}
                </Space>
                {item?.tenCongTy ? (
                  <Text type="secondary">Cong ty: {item.tenCongTy}</Text>
                ) : null}
              </Space>
            </List.Item>
          )}
        />
      </Card>
    </div>
  );
};

export default TaiKhoanMB;
