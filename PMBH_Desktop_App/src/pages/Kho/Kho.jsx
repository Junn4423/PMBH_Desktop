import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Table,
  Button,
  Form,
  Input,
  Space,
  message,
  Drawer,
  Typography,
  Tag,
  Row,
  Col,
  Statistic,
  Popconfirm,
  Modal
} from 'antd';
import {
  Warehouse,
  RefreshCw,
  Plus,
  PackageSearch,
  Building2,
  Phone,
  UserCircle2
} from 'lucide-react';
import {
  getDanhSachKho,
  themKho,
  suaKho,
  xoaKho,
  getNguyenVatLieuTheoMaKho,
  getSoLuongTonKhoNhieuSP
} from '../../services/apiServices';
import './Kho.css';

const Kho = () => {
  const [warehouses, setWarehouses] = useState([]);
  const [filteredWarehouses, setFilteredWarehouses] = useState([]);
  const [loading, setLoading] = useState(false);
  const [searchValue, setSearchValue] = useState('');
  const [modalVisible, setModalVisible] = useState(false);
  const [modalSubmitting, setModalSubmitting] = useState(false);
  const [editingWarehouse, setEditingWarehouse] = useState(null);
  const [form] = Form.useForm();

  const [nvlDrawerVisible, setNvlDrawerVisible] = useState(false);
  const [nvlLoading, setNvlLoading] = useState(false);
  const [selectedWarehouse, setSelectedWarehouse] = useState(null);
  const [nvlData, setNvlData] = useState([]);

  const fetchWarehouses = useCallback(async () => {
    setLoading(true);
    try {
      const data = await getDanhSachKho();
      const list = Array.isArray(data) ? data : [];
      setWarehouses(list);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách kho, vui lòng thử lại.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
  }, [fetchWarehouses]);

  useEffect(() => {
    if (!searchValue) {
      setFilteredWarehouses(warehouses);
      return;
    }
    const keyword = searchValue.trim().toLowerCase();
    const result = warehouses.filter((item) => {
      const values = [
        item?.maKho,
        item?.tenKho,
        item?.tenCongTy,
        item?.viTriKho,
        item?.soDt,
        item?.maThuKho
      ]
        .filter(Boolean)
        .map((value) => String(value).toLowerCase());

      return values.some((value) => value.includes(keyword));
    });
    setFilteredWarehouses(result);
  }, [searchValue, warehouses]);

  const statisticData = useMemo(() => {
    const total = warehouses.length;
    const withPhone = warehouses.filter((item) => item?.soDt).length;
    const supervisors = new Set(
      warehouses
        .map((item) => item?.maThuKho)
        .filter((code) => code && String(code).trim().length > 0)
    ).size;

    return {
      total,
      withPhone,
      supervisors
    };
  }, [warehouses]);

  const handleRefresh = () => {
    fetchWarehouses();
  };

  const openCreateModal = () => {
    setEditingWarehouse(null);
    form.resetFields();
    setModalVisible(true);
  };

  const openEditModal = (record) => {
    setEditingWarehouse(record);
    form.setFieldsValue({
      maKho: record?.maKho ?? '',
      tenCongTy: record?.tenCongTy ?? '',
      tenKho: record?.tenKho ?? '',
      viTriKho: record?.viTriKho ?? '',
      soDt: record?.soDt ?? '',
      fax: record?.fax ?? '',
      maThuKho: record?.maThuKho ?? '',
      ghiChu: record?.ghiChu ?? ''
    });
    setModalVisible(true);
  };

  const handleSubmitWarehouse = async () => {
    try {
      const values = await form.validateFields();
      setModalSubmitting(true);

      const payload = {
        lv001: values.maKho?.trim(),
        lv002: values.tenCongTy?.trim(),
        lv003: values.tenKho?.trim(),
        lv004: values.viTriKho?.trim(),
        lv005: values.soDt?.trim(),
        lv006: values.fax?.trim(),
        lv007: values.maThuKho?.trim(),
        lv008: values.ghiChu?.trim()
      };

      if (editingWarehouse) {
        await suaKho(payload);
        message.success('Cập nhật thông tin kho thành công.');
      } else {
        await themKho(payload);
        message.success('Thêm kho mới thành công.');
      }

      setModalVisible(false);
      fetchWarehouses();
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error(error);
      message.error('Không thể lưu thông tin kho, vui lòng thử lại.');
    } finally {
      setModalSubmitting(false);
    }
  };

  const handleDeleteWarehouse = async (maKho) => {
    try {
      await xoaKho(maKho);
      message.success('Đã xoá kho thành công.');
      fetchWarehouses();
    } catch (error) {
      console.error(error);
      message.error('Không thể xoá kho, vui lòng thử lại.');
    }
  };

  const normalizeTonKhoResponse = (raw) => {
    if (!raw) {
      return {};
    }

    if (Array.isArray(raw)) {
      const result = {};
      raw.forEach((item) => {
        const key =
          item?.maSp ??
          item?.maSP ??
          item?.lv001 ??
          item?.lv003 ??
          item?.productId;
        if (key) {
          const value =
            item?.soLuong ??
            item?.tonKho ??
            item?.slTon ??
            item?.lv004 ??
            item?.quantity ??
            item?.lv002 ??
            0;
          result[key] = Number(value) || 0;
        }
      });
      return result;
    }

    if (typeof raw === 'object') {
      const result = {};
      Object.entries(raw).forEach(([key, value]) => {
        result[key] = Number(value) || 0;
      });
      return result;
    }

    return {};
  };

  const openNvlDrawer = async (record) => {
    setSelectedWarehouse(record);
    setNvlDrawerVisible(true);
    setNvlLoading(true);

    try {
      const rawMaterials = await getNguyenVatLieuTheoMaKho(record?.maKho);
      const list = Array.isArray(rawMaterials) ? rawMaterials : [];
      const productCodes = list
        .map((item) => item?.maSp || item?.maSP)
        .filter(Boolean);

      let tonKhoMap = {};
      if (productCodes.length > 0) {
        const tonKhoResponse = await getSoLuongTonKhoNhieuSP(productCodes, record?.maKho);
        tonKhoMap = normalizeTonKhoResponse(tonKhoResponse);
      }

      const merged = list.map((item) => {
        const code = item?.maSp || item?.maSP || item?.lv001;
        return {
          key: code,
          maSp: code,
          tenSp: item?.tenSp || item?.lv002 || '',
          loaiSp: item?.loaiSp || item?.lv003 || '',
          maDv: item?.maDv || item?.lv004 || '',
          gia: Number(item?.gia ?? item?.lv007 ?? 0),
          dvGia: item?.dvGia || item?.lv008 || '',
          tonKho: tonKhoMap[code] ?? 0
        };
      });
      setNvlData(merged);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách nguyên vật liệu.');
    } finally {
      setNvlLoading(false);
    }
  };

  const warehouseColumns = [
    {
      title: 'Mã kho',
      dataIndex: 'maKho',
      key: 'maKho',
      render: (value) => <Tag color="blue">{value}</Tag>
    },
    {
      title: 'Tên kho',
      dataIndex: 'tenKho',
      key: 'tenKho',
      render: (value) => <Typography.Text strong>{value}</Typography.Text>
    },
    {
      title: 'Công ty',
      dataIndex: 'tenCongTy',
      key: 'tenCongTy',
      ellipsis: true
    },
    {
      title: 'Vị trí',
      dataIndex: 'viTriKho',
      key: 'viTriKho',
      ellipsis: true
    },
    {
      title: 'Thủ kho',
      dataIndex: 'maThuKho',
      key: 'maThuKho',
      render: (value) =>
        value ? (
          <Space size={6} align="center">
            <UserCircle2 size={14} />
            <span>{value}</span>
          </Space>
        ) : (
          <Typography.Text type="secondary">Chưa thiết lập</Typography.Text>
        )
    },
    {
      title: 'Liên hệ',
      dataIndex: 'soDt',
      key: 'soDt',
      render: (value, record) => (
        <div className="kho-contact-cell">
          {value ? (
            <Space size={6}>
              <Phone size={14} />
              <span>{value}</span>
            </Space>
          ) : (
            <Typography.Text type="secondary">-</Typography.Text>
          )}
          {record?.fax && (
            <Typography.Text className="kho-contact-fax">
              Fax: {record.fax}
            </Typography.Text>
          )}
        </div>
      )
    },
    {
      title: 'Ghi chú',
      dataIndex: 'ghiChu',
      key: 'ghiChu',
      ellipsis: true
    },
    {
      title: 'Thao tác',
      key: 'actions',
      width: 200,
      render: (_, record) => (
        <Space size="small" className="kho-table-actions">
          <Button
            type="link"
            icon={<PackageSearch size={16} />}
            onClick={() => openNvlDrawer(record)}
          >
            Nguyên liệu
          </Button>
          <Button type="link" onClick={() => openEditModal(record)}>
            Sửa
          </Button>
          <Popconfirm
            title="Xoá kho"
            description={`Bạn chắc chắn muốn xoá kho ${record?.tenKho || record?.maKho}?`}
            okText="Xoá"
            cancelText="Huỷ"
            okButtonProps={{ danger: true }}
            onConfirm={() => handleDeleteWarehouse(record?.maKho)}
          >
            <Button type="link" danger>
              Xoá
            </Button>
          </Popconfirm>
        </Space>
      )
    }
  ];

  const nvlColumns = [
    {
      title: 'Mã SP',
      dataIndex: 'maSp',
      key: 'maSp'
    },
    {
      title: 'Tên nguyên liệu',
      dataIndex: 'tenSp',
      key: 'tenSp',
      render: (value) => <Typography.Text strong>{value}</Typography.Text>
    },
    {
      title: 'Loại',
      dataIndex: 'loaiSp',
      key: 'loaiSp'
    },
    {
      title: 'Đơn vị',
      dataIndex: 'maDv',
      key: 'maDv'
    },
    {
      title: 'Giá chuẩn',
      dataIndex: 'gia',
      key: 'gia',
      align: 'right',
      render: (value) =>
        Number(value || 0).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        })
    },
    {
      title: 'Tồn kho',
      dataIndex: 'tonKho',
      key: 'tonKho',
      align: 'right',
      render: (value) => (
        <Typography.Text className={value > 0 ? 'ton-positive' : 'ton-empty'}>
          {Number(value || 0).toLocaleString('vi-VN')}
        </Typography.Text>
      )
    }
  ];

  return (
    <div className="kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chủ</Breadcrumb.Item>
        <Breadcrumb.Item>Quản lý kho</Breadcrumb.Item>
        <Breadcrumb.Item>Kho</Breadcrumb.Item>
      </Breadcrumb>

      <div className="kho-header">
        <div className="kho-title">
          <Warehouse size={28} />
          <div>
            <Typography.Title level={3} className="kho-title-text">
              Quản lý kho
            </Typography.Title>
            <Typography.Text type="secondary">
              Theo dõi thông tin kho, thủ kho và nguyên vật liệu đi kèm.
            </Typography.Text>
          </div>
        </div>
        <Space className="kho-actions" wrap>
          <Input.Search
            allowClear
            placeholder="Tìm theo tên, mã kho, vị trí, thủ kho..."
            value={searchValue}
            onChange={(e) => setSearchValue(e.target.value)}
            className="kho-search"
          />
          <Button icon={<RefreshCw size={16} />} onClick={handleRefresh}>
            Làm mới
          </Button>
          <Button
            type="primary"
            icon={<Plus size={16} />}
            onClick={openCreateModal}
          >
            Thêm kho
          </Button>
        </Space>
      </div>

      <Row gutter={16} className="kho-statistic-row">
        <Col xs={24} sm={8}>
          <Card className="kho-stat-card">
            <Statistic
              title="Tổng số kho"
              value={statisticData.total}
              prefix={<Building2 size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={8}>
          <Card className="kho-stat-card">
            <Statistic
              title="Kho có liên hệ"
              value={statisticData.withPhone}
              prefix={<Phone size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={8}>
          <Card className="kho-stat-card">
            <Statistic
              title="Số thủ kho"
              value={statisticData.supervisors}
              prefix={<UserCircle2 size={18} />}
            />
          </Card>
        </Col>
      </Row>

      <Card className="main-card">
        <Table
          rowKey={(record) => record?.maKho || record?.lv001}
          columns={warehouseColumns}
          dataSource={filteredWarehouses}
          loading={loading}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `${total} kho`
          }}
        />
      </Card>

      <Modal
        title={editingWarehouse ? 'Cập nhật thông tin kho' : 'Thêm kho mới'}
        open={modalVisible}
        onCancel={() => setModalVisible(false)}
        onOk={handleSubmitWarehouse}
        okText={editingWarehouse ? 'Cập nhật' : 'Thêm mới'}
        confirmLoading={modalSubmitting}
        destroyOnClose
        className="kho-modal"
      >
        <Form layout="vertical" form={form}>
          <Form.Item
            label="Mã kho"
            name="maKho"
            rules={[{ required: true, message: 'Vui lòng nhập mã kho' }]}
          >
            <Input placeholder="Nhập mã kho" disabled={Boolean(editingWarehouse)} />
          </Form.Item>
          <Form.Item
            label="Tên kho"
            name="tenKho"
            rules={[{ required: true, message: 'Vui lòng nhập tên kho' }]}
          >
            <Input placeholder="Nhập tên kho" />
          </Form.Item>
          <Form.Item label="Thuộc công ty" name="tenCongTy">
            <Input placeholder="Tên công ty chủ quản" />
          </Form.Item>
          <Form.Item label="Vị trí kho" name="viTriKho">
            <Input placeholder="Địa chỉ hoặc mô tả vị trí kho" />
          </Form.Item>
          <Form.Item label="Số điện thoại" name="soDt">
            <Input placeholder="Thông tin liên hệ" />
          </Form.Item>
          <Form.Item label="Fax" name="fax">
            <Input placeholder="Số fax (nếu có)" />
          </Form.Item>
          <Form.Item label="Mã thủ kho" name="maThuKho">
            <Input placeholder="Mã hoặc tên thủ kho phụ trách" />
          </Form.Item>
          <Form.Item label="Ghi chú" name="ghiChu">
            <Input.TextArea rows={3} placeholder="Ghi chú bổ sung" />
          </Form.Item>
        </Form>
      </Modal>

      <Drawer
        width={720}
        open={nvlDrawerVisible}
        title={
          <div className="kho-drawer-title">
            <PackageSearch size={20} />
            <span>
              Nguyên vật liệu - {selectedWarehouse?.tenKho || selectedWarehouse?.maKho}
            </span>
          </div>
        }
        onClose={() => {
          setNvlDrawerVisible(false);
          setSelectedWarehouse(null);
          setNvlData([]);
        }}
      >
        <Typography.Paragraph type="secondary" className="kho-drawer-description">
          Danh sách nguyên vật liệu đang thuộc kho và tồn kho thực tế tham chiếu từ hệ thống.
        </Typography.Paragraph>
        <Table
          rowKey={(record) => record?.key || record?.maSp}
          columns={nvlColumns}
          dataSource={nvlData}
          loading={nvlLoading}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `${total} nguyên vật liệu`
          }}
          size="middle"
        />
      </Drawer>
    </div>
  );
};

export default Kho;

