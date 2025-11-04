import React, { useCallback, useEffect, useMemo, useState } from 'react';
import {
  Breadcrumb,
  Card,
  Table,
  Button,
  Form,
  Input,
  Select,
  DatePicker,
  message,
  Typography,
  Tag,
  Modal,
  Space,
  Drawer,
  Row,
  Col,
  Statistic,
  InputNumber,
  Divider,
  Empty
} from 'antd';
import { ClipboardCheck, RefreshCw, Plus, CheckCircle2, ArchiveRestore } from 'lucide-react';
import dayjs from 'dayjs';
import {
  listPhieuKiemKho,
  createPhieuKiemKho,
  deletePhieuKiemKho,
  getPhieuKiemKhoById,
  updateTrangThaiPhieuKiem,
  listChiTietPhieuKiem,
  addChiTietPhieuKiem,
  updateChiTietPhieuKiem,
  deleteChiTietPhieuKiem,
  getDanhSachKho,
  listTatCaNguyenLieu,
  getSoLuongTonKho
} from '../../services/apiServices';
import './KiemKho.css';

const statusOptions = [
  { label: 'Nháp', value: '0' },
  { label: 'Đã duyệt', value: '1' },
  { label: 'Hoàn tất', value: '2' }
];

const statusTag = (value) => {
  const status = statusOptions.find((item) => item.value === value);
  if (!status) {
    return <Tag color="default">{value || 'Khác'}</Tag>;
  }
  const colorMap = {
    '0': 'default',
    '1': 'green',
    '2': 'blue'
  };
  return <Tag color={colorMap[value] || 'default'}>{status.label}</Tag>;
};

const parseDate = (value) => {
  if (!value) {
    return null;
  }
  if (dayjs.isDayjs(value)) {
    return value;
  }
  if (value instanceof Date) {
    return dayjs(value);
  }
  const str = String(value);
  if (/^\d{8}$/.test(str)) {
    return dayjs(str, 'YYYYMMDD');
  }
  if (/^\d{14}$/.test(str)) {
    return dayjs(str, 'YYYYMMDDHHmmss');
  }
  const parsed = dayjs(str);
  return parsed.isValid() ? parsed : null;
};

const formatDate = (value) => {
  const parsed = parseDate(value);
  return parsed ? parsed.format('DD/MM/YYYY HH:mm') : '';
};

const normalizeHeader = (item) => ({
  maKiemKho: item?.maKiemKho ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  chuDe: item?.chuDe ?? item?.lv004 ?? '',
  ngayKiem: item?.ngayKiem ?? item?.lv005 ?? '',
  ghiNhan: item?.ghiNhan ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? ''
});

const normalizeDetail = (item) => ({
  maKiemKho: item?.maKiemKho ?? item?.lv002 ?? '',
  maSanPham: item?.maSanPham ?? item?.lv003 ?? '',
  soLuongHeThong: Number(item?.slPM ?? item?.lv004 ?? 0),
  soLuongKiem: Number(item?.soLuongKiem ?? item?.lv006 ?? 0),
  donViKiem: item?.donViKiem ?? item?.lv009 ?? '',
  donViHeThong: item?.donViTinh ?? item?.lv007 ?? '',
  soLuongThucTe: Number(item?.soLuongThucTe ?? item?.lv008 ?? 0)
});

const KiemKho = () => {
  const [loading, setLoading] = useState(false);
  const [records, setRecords] = useState([]);
  const [filteredRecords, setFilteredRecords] = useState([]);
  const [selectedRowKeys, setSelectedRowKeys] = useState([]);

  const [warehouses, setWarehouses] = useState([]);
  const [products, setProducts] = useState([]);
  const [productsLoading, setProductsLoading] = useState(false);

  const [filters, setFilters] = useState({
    maKho: undefined,
    trangThai: undefined,
    search: ''
  });

  const [createModalOpen, setCreateModalOpen] = useState(false);
  const [createSubmitting, setCreateSubmitting] = useState(false);
  const [createForm] = Form.useForm();

  const [detailDrawerOpen, setDetailDrawerOpen] = useState(false);
  const [detailLoading, setDetailLoading] = useState(false);
  const [selectedHeader, setSelectedHeader] = useState(null);
  const [detailRows, setDetailRows] = useState([]);

  const [detailModalOpen, setDetailModalOpen] = useState(false);
  const [detailSubmitting, setDetailSubmitting] = useState(false);
  const [detailForm] = Form.useForm();
  const [editingDetail, setEditingDetail] = useState(null);

  const [tonKhoCache, setTonKhoCache] = useState({});

  const productMap = useMemo(() => {
    const map = {};
    products.forEach((item) => {
      const code = item?.maSp || item?.maSP || item?.lv001;
      if (code) {
        map[code] = item;
      }
    });
    return map;
  }, [products]);

  const stats = useMemo(() => {
    const total = filteredRecords.length;
    const approved = filteredRecords.filter((item) => item.trangThai === '1').length;
    const completed = filteredRecords.filter((item) => item.trangThai === '2').length;
    return {
      total,
      approved,
      completed
    };
  }, [filteredRecords]);

  const fetchWarehouses = useCallback(async () => {
    try {
      const data = await getDanhSachKho();
      setWarehouses(Array.isArray(data) ? data : []);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách kho.');
    }
  }, []);

  const fetchProducts = useCallback(async () => {
    setProductsLoading(true);
    try {
      const data = await listTatCaNguyenLieu();
      setProducts(Array.isArray(data) ? data : []);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách nguyên vật liệu.');
    } finally {
      setProductsLoading(false);
    }
  }, []);

  const fetchRecords = useCallback(async () => {
    setLoading(true);
    try {
      const data = await listPhieuKiemKho();
      const list = Array.isArray(data) ? data.map(normalizeHeader) : [];
      setRecords(list);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách phiếu kiểm kho.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
    fetchProducts();
    fetchRecords();
  }, [fetchWarehouses, fetchProducts, fetchRecords]);

  useEffect(() => {
    let data = [...records];

    if (filters.maKho) {
      data = data.filter((item) => item.maKho === filters.maKho);
    }

    if (filters.trangThai) {
      data = data.filter((item) => item.trangThai === filters.trangThai);
    }

    if (filters.search) {
      const keyword = filters.search.trim().toLowerCase();
      data = data.filter((item) => {
        const values = [item.maKiemKho, item.maKho, item.maNguoiDung, item.chuDe]
          .filter(Boolean)
          .map((value) => String(value).toLowerCase());
        return values.some((value) => value.includes(keyword));
      });
    }

    setFilteredRecords(data);
  }, [filters, records]);

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        value: item?.maKho || item?.lv001,
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`
      })),
    [warehouses]
  );

  const productOptions = useMemo(
    () =>
      products.map((item) => {
        const code = item?.maSp || item?.maSP || item?.lv001;
        const name = item?.tenSp || item?.lv002 || '';
        const unit = item?.maDv || item?.lv004 || '';
        return {
          value: code,
          label: `${code} - ${name}${unit ? ` (${unit})` : ''}`
        };
      }),
    [products]
  );

  const handleCreate = async () => {
    try {
      const values = await createForm.validateFields();
      setCreateSubmitting(true);
      await createPhieuKiemKho({
        maKho: values.maKho,
        maNguoiDung: values.maNguoiDung || '',
        chuDe: values.chuDe || '',
        ghiNhan: values.ghiNhan || '',
        trangThai: values.trangThai || '0',
        ngayKiem: values.ngayKiem ? dayjs(values.ngayKiem).format('YYYYMMDDHHmmss') : ''
      });
      message.success('Tạo phiếu kiểm kho thành công.');
      setCreateModalOpen(false);
      fetchRecords();
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error(error);
      message.error('Không thể tạo phiếu kiểm kho, vui lòng thử lại.');
    } finally {
      setCreateSubmitting(false);
    }
  };

  const handleDelete = async (record) => {
    try {
      await deletePhieuKiemKho(record.maKiemKho);
      message.success('Đã xoá phiếu kiểm kho.');
      fetchRecords();
    } catch (error) {
      console.error(error);
      message.error('Không thể xoá phiếu kiểm kho.');
    }
  };

  const handleApproveSelected = async () => {
    if (!selectedRowKeys.length) {
      message.info('Hãy chọn ít nhất một phiếu để duyệt.');
      return;
    }
    try {
      await updateTrangThaiPhieuKiem(selectedRowKeys);
      message.success('Đã duyệt phiếu kiểm kho.');
      setSelectedRowKeys([]);
      fetchRecords();
    } catch (error) {
      console.error(error);
      message.error('Không thể duyệt phiếu, vui lòng thử lại.');
    }
  };

  const openDetailDrawer = async (record) => {
    setDetailDrawerOpen(true);
    setDetailLoading(true);
    setSelectedHeader(null);
    setDetailRows([]);

    try {
      const header = await getPhieuKiemKhoById(record.maKiemKho);
      if (header) {
        setSelectedHeader(normalizeHeader(header));
      } else {
        setSelectedHeader(record);
      }

      const detailResponse = await listChiTietPhieuKiem(record.maKiemKho);
      const details = Array.isArray(detailResponse)
        ? detailResponse.map(normalizeDetail)
        : [];
      setDetailRows(details);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải chi tiết phiếu kiểm kho.');
    } finally {
      setDetailLoading(false);
    }
  };

  const closeDetailDrawer = () => {
    setDetailDrawerOpen(false);
    setSelectedHeader(null);
    setDetailRows([]);
  };

  const openDetailModal = async (mode, detail) => {
    if (!selectedHeader) {
      return;
    }
    setEditingDetail(mode === 'edit' ? detail : null);
    setDetailModalOpen(true);

    if (mode === 'edit' && detail) {
      detailForm.setFieldsValue({
        maSanPham: detail.maSanPham,
        donViTinh: detail.donViHeThong,
        soLuongHeThong: detail.soLuongHeThong,
        soLuongThucTe: detail.soLuongThucTe,
        donViThucTe: detail.donViHeThong
      });
    } else {
      detailForm.resetFields();
    }
  };

  const closeDetailModal = () => {
    setDetailModalOpen(false);
    setEditingDetail(null);
    detailForm.resetFields();
  };

  const handleDetailSubmit = async () => {
    if (!selectedHeader) {
      return;
    }
    try {
      const values = await detailForm.validateFields();
      setDetailSubmitting(true);

      if (editingDetail) {
        await updateChiTietPhieuKiem({
          maKiemKho: selectedHeader.maKiemKho,
          maSanPham: editingDetail.maSanPham,
          soLuongThucTe: Number(values.soLuongThucTe || 0),
          donViTT: values.donViThucTe || values.donViTinh || ''
        });
        message.success('Cập nhật chi tiết phiếu kiểm kho thành công.');
      } else {
        await addChiTietPhieuKiem({
          maKiemKho: selectedHeader.maKiemKho,
          maSanPham: values.maSanPham,
          slPM: Number(values.soLuongHeThong || 0),
          donViKiem: values.donViTinh || '',
          soLuongThucTe: Number(values.soLuongThucTe || 0),
          donViTT: values.donViThucTe || values.donViTinh || ''
        });
        message.success('Thêm chi tiết kiểm kho thành công.');
      }

      const detailResponse = await listChiTietPhieuKiem(selectedHeader.maKiemKho);
      const details = Array.isArray(detailResponse)
        ? detailResponse.map(normalizeDetail)
        : [];
      setDetailRows(details);
      closeDetailModal();
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error(error);
      message.error('Không thể lưu chi tiết kiểm kho.');
    } finally {
      setDetailSubmitting(false);
    }
  };

  const handleDeleteDetail = async (detail) => {
    if (!selectedHeader) {
      return;
    }
    try {
      await deleteChiTietPhieuKiem(selectedHeader.maKiemKho, detail.maSanPham);
      message.success('Đã xoá dòng kiểm kho.');
      const detailResponse = await listChiTietPhieuKiem(selectedHeader.maKiemKho);
      const details = Array.isArray(detailResponse)
        ? detailResponse.map(normalizeDetail)
        : [];
      setDetailRows(details);
    } catch (error) {
      console.error(error);
      message.error('Không thể xoá dòng kiểm kho.');
    }
  };

  const handleFetchTonKho = async (productCode) => {
    if (!selectedHeader?.maKho || !productCode) {
      return;
    }
    const cacheKey = `${selectedHeader.maKho}-${productCode}`;
    if (cacheKey in tonKhoCache) {
      detailForm.setFieldsValue({ soLuongHeThong: tonKhoCache[cacheKey] });
      return;
    }
    try {
      const tonKho = await getSoLuongTonKho(productCode, selectedHeader.maKho);
      setTonKhoCache((prev) => ({ ...prev, [cacheKey]: Number(tonKho || 0) }));
      detailForm.setFieldsValue({ soLuongHeThong: Number(tonKho || 0) });
    } catch (error) {
      console.error(error);
    }
  };

  const columns = [
    {
      title: 'Mã phiếu',
      dataIndex: 'maKiemKho',
      key: 'maKiemKho',
      render: (value) => <Tag color="blue">{value}</Tag>
    },
    {
      title: 'Kho kiểm',
      dataIndex: 'maKho',
      key: 'maKho'
    },
    {
      title: 'Người kiểm',
      dataIndex: 'maNguoiDung',
      key: 'maNguoiDung'
    },
    {
      title: 'Chủ đề',
      dataIndex: 'chuDe',
      key: 'chuDe',
      ellipsis: true
    },
    {
      title: 'Ngày kiểm',
      dataIndex: 'ngayKiem',
      key: 'ngayKiem',
      render: (value) => formatDate(value)
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: statusTag
    },
    {
      title: 'Thao tác',
      key: 'actions',
      width: 180,
      render: (_, record) => (
        <Space size="small">
          <Button type="link" onClick={() => openDetailDrawer(record)}>
            Chi tiết
          </Button>
          <Button type="link" danger onClick={() => handleDelete(record)}>
            Xoá
          </Button>
        </Space>
      )
    }
  ];

  const detailColumns = [
    {
      title: 'Mã SP',
      dataIndex: 'maSanPham',
      key: 'maSanPham'
    },
    {
      title: 'Tên nguyên liệu',
      dataIndex: 'maSanPham',
      key: 'tenSp',
      render: (value) => productMap[value]?.tenSp || productMap[value]?.lv002 || '—'
    },
    {
      title: 'SL hệ thống',
      dataIndex: 'soLuongHeThong',
      key: 'soLuongHeThong',
      align: 'right',
      render: (value) => Number(value || 0).toLocaleString('vi-VN')
    },
    {
      title: 'SL thực tế',
      dataIndex: 'soLuongThucTe',
      key: 'soLuongThucTe',
      align: 'right',
      render: (value) => Number(value || 0).toLocaleString('vi-VN')
    },
    {
      title: 'Chênh lệch',
      key: 'chenhLech',
      align: 'right',
      render: (_, record) => {
        const diff = Number(record.soLuongThucTe || 0) - Number(record.soLuongHeThong || 0);
        const color = diff === 0 ? 'inherit' : diff > 0 ? '#237804' : '#cf1322';
        return <span style={{ color }}>{diff.toLocaleString('vi-VN')}</span>;
      }
    },
    {
      title: 'Thao tác',
      key: 'actions',
      render: (_, record) => (
        <Space size="small">
          <Button type="link" onClick={() => openDetailModal('edit', record)}>
            Cập nhật
          </Button>
          <Button type="link" danger onClick={() => handleDeleteDetail(record)}>
            Xoá
          </Button>
        </Space>
      )
    }
  ];

  return (
    <div className="kiem-kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Quản lý kho</Breadcrumb.Item>
        <Breadcrumb.Item>Kiểm kho</Breadcrumb.Item>
      </Breadcrumb>

      <div className="kiem-kho-header">
        <div className="kiem-kho-title">
          <ClipboardCheck size={28} />
          <div>
            <Typography.Title level={3} className="kiem-kho-title-text">
              Phiếu kiểm kho
            </Typography.Title>
            <Typography.Text type="secondary">
              Lập, duyệt và theo dõi chênh lệch kiểm kê trong kho.
            </Typography.Text>
          </div>
        </div>
        <Space className="kiem-kho-actions" wrap>
          <Input.Search
            placeholder="Tìm theo mã phiếu, kho, chủ đề..."
            allowClear
            className="kiem-kho-search"
            value={filters.search}
            onChange={(e) => setFilters((prev) => ({ ...prev, search: e.target.value }))}
          />
          <Select
            allowClear
            placeholder="Lọc theo kho"
            className="kiem-kho-select"
            options={warehouseOptions}
            value={filters.maKho}
            onChange={(value) => setFilters((prev) => ({ ...prev, maKho: value }))}
          />
          <Select
            allowClear
            placeholder="Lọc theo trạng thái"
            className="kiem-kho-select"
            options={statusOptions}
            value={filters.trangThai}
            onChange={(value) => setFilters((prev) => ({ ...prev, trangThai: value }))}
          />
          <Button icon={<RefreshCw size={16} />} onClick={fetchRecords}>
            Làm mới
          </Button>
          <Button
            type="primary"
            icon={<Plus size={16} />}
            onClick={() => {
              createForm.resetFields();
              createForm.setFieldsValue({
                trangThai: '0',
                ngayKiem: dayjs()
              });
              setCreateModalOpen(true);
            }}
          >
            Tạo phiếu kiểm
          </Button>
          <Button
            type="default"
            icon={<CheckCircle2 size={16} />}
            disabled={!selectedRowKeys.length}
            onClick={handleApproveSelected}
          >
            Duyệt phiếu
          </Button>
        </Space>
      </div>

      <Row gutter={16} className="kiem-kho-stats">
        <Col xs={24} sm={12} md={8}>
          <Card className="kiem-kho-stat-card">
            <Statistic
              title="Tổng số phiếu"
              value={stats.total}
              prefix={<ClipboardCheck size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} md={8}>
          <Card className="kiem-kho-stat-card">
            <Statistic
              title="Phiếu đã duyệt"
              value={stats.approved}
              prefix={<CheckCircle2 size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} md={8}>
          <Card className="kiem-kho-stat-card">
            <Statistic
              title="Phiếu hoàn tất"
              value={stats.completed}
              prefix={<ArchiveRestore size={18} />}
            />
          </Card>
        </Col>
      </Row>

      <Card className="main-card">
        <Table
          rowKey={(record) => record.maKiemKho}
          columns={columns}
          dataSource={filteredRecords}
          loading={loading}
          rowSelection={{ selectedRowKeys, onChange: setSelectedRowKeys }}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `${total} phiếu kiểm kho`
          }}
        />
      </Card>

      <Modal
        title="Tạo phiếu kiểm kho"
        open={createModalOpen}
        onCancel={() => setCreateModalOpen(false)}
        onOk={handleCreate}
        confirmLoading={createSubmitting}
        okText="Lưu"
        cancelText="Huỷ"
        destroyOnClose
      >
        <Form
          layout="vertical"
          form={createForm}
          initialValues={{
            trangThai: '0',
            ngayKiem: dayjs()
          }}
        >
          <Form.Item
            label="Kho kiểm"
            name="maKho"
            rules={[{ required: true, message: 'Chọn kho kiểm' }]}
          >
            <Select
              placeholder="Chọn kho"
              options={warehouseOptions}
              showSearch
              optionFilterProp="label"
            />
          </Form.Item>
          <Form.Item label="Người kiểm" name="maNguoiDung">
            <Input placeholder="Mã hoặc tên người kiểm" />
          </Form.Item>
          <Form.Item label="Chủ đề" name="chuDe">
            <Input placeholder="Nội dung kiểm kê" />
          </Form.Item>
          <Form.Item
            label="Ngày kiểm"
            name="ngayKiem"
            rules={[{ required: true, message: 'Chọn ngày kiểm' }]}
          >
            <DatePicker
              showTime
              format="DD/MM/YYYY HH:mm"
              style={{ width: '100%' }}
            />
          </Form.Item>
          <Form.Item label="Ghi nhận" name="ghiNhan">
            <Input.TextArea rows={3} placeholder="Ghi chú kết quả kiểm kê" />
          </Form.Item>
          <Form.Item label="Trạng thái" name="trangThai">
            <Select options={statusOptions} />
          </Form.Item>
        </Form>
      </Modal>

      <Drawer
        width={780}
        open={detailDrawerOpen}
        title={`Chi tiết phiếu kiểm ${selectedHeader?.maKiemKho || ''}`}
        onClose={closeDetailDrawer}
        extra={
          <Button type="primary" onClick={() => openDetailModal('add')}>
            Thêm dòng kiểm
          </Button>
        }
      >
        {selectedHeader ? (
          <Space direction="vertical" size="large" style={{ width: '100%' }}>
            <Card size="small">
              <Row gutter={[16, 8]}>
                <Col span={12}>
                  <Typography.Text type="secondary">Kho kiểm</Typography.Text>
                  <div>{selectedHeader.maKho}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Người kiểm</Typography.Text>
                  <div>{selectedHeader.maNguoiDung || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Ngày kiểm</Typography.Text>
                  <div>{formatDate(selectedHeader.ngayKiem) || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Trạng thái</Typography.Text>
                  <div>{statusTag(selectedHeader.trangThai)}</div>
                </Col>
                <Col span={24}>
                  <Typography.Text type="secondary">Chủ đề</Typography.Text>
                  <div>{selectedHeader.chuDe || '—'}</div>
                </Col>
                <Col span={24}>
                  <Typography.Text type="secondary">Ghi nhận</Typography.Text>
                  <div>{selectedHeader.ghiNhan || '—'}</div>
                </Col>
              </Row>
            </Card>

            <Card size="small">
              <Typography.Title level={5} style={{ marginBottom: 16 }}>
                Danh sách kiểm kê
              </Typography.Title>
              <Table
                rowKey={(record) => `${record.maSanPham}`}
                columns={detailColumns}
                dataSource={detailRows}
                loading={detailLoading}
                pagination={false}
                locale={{
                  emptyText: detailLoading ? <Empty description="Đang tải dữ liệu" /> : undefined
                }}
              />
              <Divider />
              <div className="kiem-kho-diff-summary">
                <Typography.Text strong>Chênh lệch tổng:</Typography.Text>
                <Typography.Text strong>
                  {Number(
                    detailRows.reduce(
                      (sum, item) => sum + (item.soLuongThucTe || 0) - (item.soLuongHeThong || 0),
                      0
                    )
                  ).toLocaleString('vi-VN')}
                </Typography.Text>
              </div>
            </Card>
          </Space>
        ) : (
          <Empty description="Không có dữ liệu phiếu kiểm" />
        )}
      </Drawer>

      <Modal
        title={editingDetail ? 'Cập nhật dòng kiểm' : 'Thêm dòng kiểm'}
        open={detailModalOpen}
        onCancel={closeDetailModal}
        onOk={handleDetailSubmit}
        confirmLoading={detailSubmitting}
        okText="Lưu"
        cancelText="Huỷ"
        destroyOnClose
      >
        <Form layout="vertical" form={detailForm}>
          <Form.Item
            label="Nguyên vật liệu"
            name="maSanPham"
            rules={[{ required: true, message: 'Chọn nguyên vật liệu kiểm kê' }]}
          >
            <Select
              placeholder="Chọn nguyên vật liệu"
              options={productOptions}
              showSearch
              optionFilterProp="label"
              disabled={Boolean(editingDetail)}
              onChange={(value) => handleFetchTonKho(value)}
            />
          </Form.Item>
          <Form.Item
            label="Đơn vị kiểm"
            name="donViTinh"
            rules={[{ required: true, message: 'Nhập đơn vị kiểm' }]}
          >
            <Input placeholder="Đơn vị kiểm kê" />
          </Form.Item>
          <Form.Item label="Số lượng hệ thống" name="soLuongHeThong">
            <InputNumber min={0} style={{ width: '100%' }} placeholder="Số lượng hệ thống" />
          </Form.Item>
          <Form.Item
            label="Số lượng thực tế"
            name="soLuongThucTe"
            rules={[{ required: true, message: 'Nhập số lượng thực tế' }]}
          >
            <InputNumber min={0} style={{ width: '100%' }} placeholder="Số lượng thực tế" />
          </Form.Item>
          <Form.Item label="Đơn vị thực tế" name="donViThucTe">
            <Input placeholder="Đơn vị tính thực tế" />
          </Form.Item>
        </Form>
      </Modal>
    </div>
  );
};

export default KiemKho;
