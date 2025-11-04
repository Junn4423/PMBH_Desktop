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
  Space,
  message,
  Drawer,
  Typography,
  Tag,
  Popconfirm,
  InputNumber,
  Row,
  Col,
  Statistic,
  Divider,
  Empty
} from 'antd';
import {
  Truck,
  RefreshCw,
  Plus,
  FileOutput,
  PackageSearch,
  Users
} from 'lucide-react';
import dayjs from 'dayjs';
import {
  listPhieuXuat,
  createPhieuXuat,
  deletePhieuXuat,
  getPhieuXuatById,
  listChiTietPhieuXuat,
  getDanhSachKho,
  listTatCaNguyenLieu,
  getSoLuongTonKho
} from '../../services/apiServices';
import './XuatKho.css';

const { RangePicker } = DatePicker;

const parseDateValue = (value) => {
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
  if (/^\d{14}$/.test(str)) {
    return dayjs(str, 'YYYYMMDDHHmmss');
  }
  if (/^\d{8}$/.test(str)) {
    return dayjs(str, 'YYYYMMDD');
  }
  const parsed = dayjs(str);
  return parsed.isValid() ? parsed : null;
};

const formatDateValue = (value) => {
  const parsed = parseDateValue(value);
  return parsed ? parsed.format('DD/MM/YYYY HH:mm') : '';
};

const normalizeReceipt = (item) => ({
  maPhieuXuat: item?.maPhieuXuat ?? item?.lv001 ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  chuDe: item?.chuDe ?? item?.lv004 ?? '',
  nguonXuat: item?.nguonXuat ?? item?.lv005 ?? '',
  maThamChieu: item?.maThamChieu ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? '',
  ghiChu: item?.ghiChu ?? item?.lv008 ?? '',
  ngayXuat: item?.ngayXuat ?? item?.lv009 ?? '',
  hinhThucXuat: item?.HinhThucXuat ?? item?.lv010 ?? '',
  nguoiNhanKho: item?.NguoiNhanKho ?? item?.lv011 ?? ''
});

const normalizeDetail = (item) => ({
  maSanPham: item?.maSanPham ?? item?.maSp ?? item?.lv003 ?? '',
  soLuong: Number(item?.soLuong ?? item?.lv004 ?? 0),
  donViTinh: item?.donViTinh ?? item?.lv005 ?? '',
  gia: Number(item?.gia ?? item?.lv008 ?? 0),
  donViGia: item?.donViGia ?? item?.lv009 ?? '',
  ngayBan: item?.ngayBan ?? item?.lv016 ?? ''
});

const XuatKho = () => {
  const [loading, setLoading] = useState(false);
  const [receipts, setReceipts] = useState([]);
  const [filteredReceipts, setFilteredReceipts] = useState([]);

  const [warehouses, setWarehouses] = useState([]);
  const [products, setProducts] = useState([]);
  const [productsLoading, setProductsLoading] = useState(false);

  const [filters, setFilters] = useState({
    kho: undefined,
    dateRange: null,
    search: ''
  });

  const [createDrawerOpen, setCreateDrawerOpen] = useState(false);
  const [createSubmitting, setCreateSubmitting] = useState(false);
  const [createForm] = Form.useForm();
  const detailWatch = Form.useWatch('details', createForm);

  const [detailDrawerOpen, setDetailDrawerOpen] = useState(false);
  const [detailLoading, setDetailLoading] = useState(false);
  const [selectedReceipt, setSelectedReceipt] = useState(null);
  const [receiptDetails, setReceiptDetails] = useState([]);

  const [tonKhoMap, setTonKhoMap] = useState({});

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
    const total = filteredReceipts.length;
    const byStatus = filteredReceipts.reduce(
      (acc, item) => {
        const key = item?.trangThai ?? 'unknown';
        acc[key] = (acc[key] || 0) + 1;
        return acc;
      },
      {}
    );
    return { total, byStatus };
  }, [filteredReceipts]);

  const detailDraftTotal = useMemo(() => {
    if (!detailWatch || !Array.isArray(detailWatch)) {
      return 0;
    }
    return detailWatch.reduce((sum, item) => {
      const qty = Number(item?.soLuong || 0);
      const price = Number(item?.gia || 0);
      return sum + qty * price;
    }, 0);
  }, [detailWatch]);

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

  const fetchReceipts = useCallback(async () => {
    setLoading(true);
    try {
      const data = await listPhieuXuat();
      const list = Array.isArray(data) ? data.map(normalizeReceipt) : [];
      setReceipts(list);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách phiếu xuất.');
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchWarehouses();
    fetchProducts();
    fetchReceipts();
  }, [fetchWarehouses, fetchProducts, fetchReceipts]);

  useEffect(() => {
    let data = [...receipts];

    if (filters.kho) {
      data = data.filter((item) => item.maKho === filters.kho);
    }

    if (filters.search) {
      const keyword = filters.search.trim().toLowerCase();
      data = data.filter((item) => {
        const values = [
          item.maPhieuXuat,
          item.maKho,
          item.maNguoiDung,
          item.maThamChieu,
          item.chuDe,
          item.nguoiNhanKho
        ]
          .filter(Boolean)
          .map((value) => String(value).toLowerCase());
        return values.some((value) => value.includes(keyword));
      });
    }

    if (filters.dateRange && filters.dateRange.length === 2) {
      const [start, end] = filters.dateRange;
      data = data.filter((item) => {
        const date = parseDateValue(item.ngayXuat);
        if (!date) {
          return false;
        }
        const inclusiveEnd = end ? end.endOf('day') : end;
        return date.isBetween(start.startOf('day'), inclusiveEnd, null, '[]');
      });
    }

    setFilteredReceipts(data);
  }, [filters, receipts]);

  const resetCreateForm = () => {
    createForm.resetFields();
    setTonKhoMap({});
    createForm.setFieldsValue({
      trangThai: '0',
      ngayXuat: dayjs(),
      details: [
        {
          soLuong: 1
        }
      ]
    });
  };

  const openCreateDrawer = () => {
    resetCreateForm();
    setCreateDrawerOpen(true);
  };

  const closeCreateDrawer = () => {
    setCreateDrawerOpen(false);
  };

  const handleSelectProduct = async (index, productCode) => {
    const product = productMap[productCode];
    const details = createForm.getFieldValue('details') || [];
    const current = details[index] || {};

    const updated = [...details];
    updated[index] = {
      ...current,
      maSanPham: productCode,
      donViTinh: product?.maDv || product?.lv004 || current?.donViTinh || '',
      donViGia: product?.dvGia || product?.maDv || current?.donViGia || '',
      gia:
        Number(
          product?.gia ??
            product?.lv007 ??
            product?.giaXuat ??
            current?.gia ??
            0
        ) || 0
    };

    createForm.setFieldsValue({ details: updated });

    const maKho = createForm.getFieldValue('maKho');
    if (maKho && productCode) {
      try {
        const tonKho = await getSoLuongTonKho(productCode, maKho);
        setTonKhoMap((prev) => ({
          ...prev,
          [`${maKho}-${productCode}`]: Number(tonKho || 0)
        }));
      } catch (error) {
        console.error(error);
      }
    }
  };

  const handleDeleteReceipt = async (record) => {
    try {
      await deletePhieuXuat(record?.maPhieuXuat);
      message.success('Đã xoá phiếu xuất.');
      fetchReceipts();
    } catch (error) {
      console.error(error);
      message.error('Không thể xoá phiếu xuất, vui lòng thử lại.');
    }
  };

  const handleCreateReceipt = async () => {
    try {
      const values = await createForm.validateFields();
      if (!values.details || values.details.length === 0) {
        message.warning('Vui lòng thêm ít nhất một dòng nguyên vật liệu.');
        return;
      }

      setCreateSubmitting(true);

      const detailsPayload = values.details.map((detail) => ({
        maSanPham: detail.maSanPham,
        soLuong: Number(detail.soLuong || 0),
        donViTinh: detail.donViTinh || '',
        gia: Number(detail.gia || 0),
        donViGia: detail.donViGia || detail.donViTinh || '',
        ghiChu: detail.ghiChu || ''
      }));

      await createPhieuXuat({
        maKho: values.maKho,
        maNguoiDung: values.maNguoiDung || '',
        chuDe: values.chuDe || '',
        nguonXuat: values.nguonXuat || '',
        maThamChieu: values.maThamChieu || '',
        trangThai: values.trangThai || '',
        ghiChu: values.ghiChu || '',
        ngayXuat: values.ngayXuat ? dayjs(values.ngayXuat).format('YYYYMMDDHHmmss') : '',
        hinhThucXuat: values.hinhThucXuat || '',
        nguoiNhanKho: values.nguoiNhanKho || '',
        details: detailsPayload
      });

      message.success('Tạo phiếu xuất thành công.');
      setCreateDrawerOpen(false);
      fetchReceipts();
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error(error);
      message.error('Không thể tạo phiếu xuất, vui lòng thử lại.');
    } finally {
      setCreateSubmitting(false);
    }
  };

  const openDetailDrawer = async (record) => {
    setDetailDrawerOpen(true);
    setDetailLoading(true);
    setSelectedReceipt(null);
    setReceiptDetails([]);

    try {
      const header = await getPhieuXuatById(record?.maPhieuXuat);
      if (header) {
        setSelectedReceipt(normalizeReceipt(header));
      } else {
        setSelectedReceipt(record);
      }

      const detailResponse = await listChiTietPhieuXuat(record?.maPhieuXuat);
      const details = Array.isArray(detailResponse)
        ? detailResponse.map(normalizeDetail)
        : [];
      setReceiptDetails(details);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải chi tiết phiếu xuất.');
    } finally {
      setDetailLoading(false);
    }
  };

  const closeDetailDrawer = () => {
    setDetailDrawerOpen(false);
    setSelectedReceipt(null);
    setReceiptDetails([]);
  };

  const handleFilterChange = (field, value) => {
    setFilters((prev) => ({
      ...prev,
      [field]: value
    }));
  };

  const warehouseOptions = useMemo(
    () =>
      warehouses.map((item) => ({
        label: `${item?.tenKho || item?.maKho} (${item?.maKho})`,
        value: item?.maKho || item?.lv001
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
          label: `${code} - ${name}${unit ? ` (${unit})` : ''}`,
          value: code
        };
      }),
    [products]
  );

  const statusTag = (value) => {
    const map = {
      '0': { text: 'Nháp', color: 'default' },
      '1': { text: 'Đã duyệt', color: 'green' },
      '2': { text: 'Hoàn tất', color: 'blue' }
    };
    const status = map[value] || { text: value || 'Khác', color: 'orange' };
    return <Tag color={status.color}>{status.text}</Tag>;
  };

  const columns = [
    {
      title: 'Mã phiếu',
      dataIndex: 'maPhieuXuat',
      key: 'maPhieuXuat',
      render: (value) => <Tag color="volcano">{value}</Tag>
    },
    {
      title: 'Kho xuất',
      dataIndex: 'maKho',
      key: 'maKho'
    },
    {
      title: 'Người lập',
      dataIndex: 'maNguoiDung',
      key: 'maNguoiDung'
    },
    {
      title: 'Chủ đề',
      dataIndex: 'chuDe',
      key: 'chuDe'
    },
    {
      title: 'Nguồn xuất',
      dataIndex: 'nguonXuat',
      key: 'nguonXuat'
    },
    {
      title: 'Ngày xuất',
      dataIndex: 'ngayXuat',
      key: 'ngayXuat',
      render: (value) => formatDateValue(value)
    },
    {
      title: 'Người nhận',
      dataIndex: 'nguoiNhanKho',
      key: 'nguoiNhanKho'
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
      render: (_, record) => (
        <Space size="small">
          <Button type="link" onClick={() => openDetailDrawer(record)}>
            Xem chi tiết
          </Button>
          <Popconfirm
            title="Xoá phiếu xuất"
            description={`Bạn có chắc muốn xoá phiếu ${record?.maPhieuXuat}?`}
            okText="Xoá"
            cancelText="Huỷ"
            okButtonProps={{ danger: true }}
            onConfirm={() => handleDeleteReceipt(record)}
          >
            <Button type="link" danger>
              Xoá
            </Button>
          </Popconfirm>
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
      render: (value) => {
        const product = productMap[value];
        return product?.tenSp || product?.lv002 || '—';
      }
    },
    {
      title: 'Số lượng',
      dataIndex: 'soLuong',
      key: 'soLuong',
      align: 'right',
      render: (value) => Number(value || 0).toLocaleString('vi-VN')
    },
    {
      title: 'Đơn vị',
      dataIndex: 'donViTinh',
      key: 'donViTinh'
    },
    {
      title: 'Đơn giá',
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
      title: 'Thành tiền',
      key: 'thanhTien',
      align: 'right',
      render: (_, record) => {
        const quantity = Number(record?.soLuong || 0);
        const price = Number(record?.gia || 0);
        return (quantity * price).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        });
      }
    }
  ];

  return (
    <div className="xuat-kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chủ</Breadcrumb.Item>
        <Breadcrumb.Item>Quản lý kho</Breadcrumb.Item>
        <Breadcrumb.Item>Xuất kho</Breadcrumb.Item>
      </Breadcrumb>

      <div className="xuat-kho-header">
        <div className="xuat-kho-title">
          <Truck size={28} />
          <div>
            <Typography.Title level={3} className="xuat-kho-title-text">
              Phiếu xuất kho
            </Typography.Title>
            <Typography.Text type="secondary">
              Quản lý chứng từ xuất kho, nguồn xuất và người nhận hàng.
            </Typography.Text>
          </div>
        </div>
        <Space className="xuat-kho-actions" wrap>
          <Input.Search
            placeholder="Tìm theo mã phiếu, kho, người nhận..."
            allowClear
            className="xuat-kho-search"
            value={filters.search}
            onChange={(e) => handleFilterChange('search', e.target.value)}
          />
          <Select
            allowClear
            placeholder="Lọc theo kho"
            className="xuat-kho-select"
            value={filters.kho}
            onChange={(value) => handleFilterChange('kho', value)}
            options={warehouseOptions}
          />
          <RangePicker
            allowClear
            className="xuat-kho-range-picker"
            value={filters.dateRange}
            onChange={(value) => handleFilterChange('dateRange', value)}
          />
          <Button icon={<RefreshCw size={16} />} onClick={fetchReceipts}>
            Làm mới
          </Button>
          <Button type="primary" icon={<Plus size={16} />} onClick={openCreateDrawer}>
            Tạo phiếu xuất
          </Button>
        </Space>
      </div>

      <Row gutter={16} className="xuat-kho-stats">
        <Col xs={24} sm={12} md={8}>
          <Card className="xuat-kho-stat-card">
            <Statistic
              title="Tổng số phiếu"
              value={stats.total}
              prefix={<FileOutput size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} md={8}>
          <Card className="xuat-kho-stat-card">
            <Statistic
              title="Phiếu đã duyệt"
              value={stats.byStatus['1'] || 0}
              prefix={<PackageSearch size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} md={8}>
          <Card className="xuat-kho-stat-card">
            <Statistic
              title="Người nhận khác nhau"
              value={
                new Set(
                  filteredReceipts
                    .map((item) => item.nguoiNhanKho)
                    .filter((item) => item && String(item).trim().length > 0)
                ).size
              }
              prefix={<Users size={18} />}
            />
          </Card>
        </Col>
      </Row>

      <Card className="main-card">
        <Table
          rowKey={(record) => record?.maPhieuXuat}
          columns={columns}
          dataSource={filteredReceipts}
          loading={loading}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `${total} phiếu xuất`
          }}
        />
      </Card>

      <Drawer
        width={880}
        open={createDrawerOpen}
        title="Tạo phiếu xuất kho"
        onClose={closeCreateDrawer}
        extra={
          <Space>
            <Button onClick={resetCreateForm}>Xoá trắng</Button>
            <Button type="primary" onClick={handleCreateReceipt} loading={createSubmitting}>
              Lưu phiếu
            </Button>
          </Space>
        }
      >
        <Form
          layout="vertical"
          form={createForm}
          initialValues={{
            trangThai: '0',
            ngayXuat: dayjs(),
            details: [
              {
                soLuong: 1
              }
            ]
          }}
        >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                label="Kho xuất"
                name="maKho"
                rules={[{ required: true, message: 'Vui lòng chọn kho' }]}
              >
                <Select
                  placeholder="Chọn kho xuất"
                  options={warehouseOptions}
                  showSearch
                  optionFilterProp="label"
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Người lập phiếu" name="maNguoiDung">
                <Input placeholder="Mã hoặc tên người lập phiếu" />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Chủ đề" name="chuDe">
                <Input placeholder="Diễn giải mục đích xuất kho" />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Nguồn xuất" name="nguonXuat">
                <Input placeholder="Ví dụ: XUATKHO, BANHANG..." />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Mã tham chiếu" name="maThamChieu">
                <Input placeholder="Liên kết với chứng từ khác (nếu có)" />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Trạng thái" name="trangThai">
                <Select
                  options={[
                    { label: 'Nháp', value: '0' },
                    { label: 'Đã duyệt', value: '1' },
                    { label: 'Hoàn tất', value: '2' }
                  ]}
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Ngày xuất" name="ngayXuat">
                <DatePicker
                  className="xuat-kho-date-picker"
                  format="DD/MM/YYYY HH:mm"
                  showTime
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Hình thức xuất" name="hinhThucXuat">
                <Input placeholder="Ví dụ: Xuất kho nội bộ, chuyển kho..." />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Người nhận kho" name="nguoiNhanKho">
                <Input placeholder="Người hoặc bộ phận nhận hàng" />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Ghi chú" name="ghiChu">
                <Input placeholder="Thông tin bổ sung (nếu có)" />
              </Form.Item>
            </Col>
          </Row>

          <Divider orientation="left">Chi tiết xuất kho</Divider>
          <Form.List name="details">
            {(fields, { add, remove }) => (
              <>
                {fields.map((field, index) => {
                  const productCode = detailWatch?.[index]?.maSanPham;
                  const maKho = createForm.getFieldValue('maKho');
                  const tonKhoKey = `${maKho || ''}-${productCode || ''}`;
                  const tonKhoValue = tonKhoMap[tonKhoKey];

                  return (
                    <Card
                      key={field.key}
                      size="small"
                      className="xuat-kho-detail-card"
                      title={`Dòng ${index + 1}`}
                      extra={
                        fields.length > 1 && (
                          <Button type="link" danger onClick={() => remove(field.name)}>
                            Xoá
                          </Button>
                        )
                      }
                    >
                      <Row gutter={16}>
                        <Col span={12}>
                          <Form.Item
                            {...field}
                            label="Nguyên vật liệu"
                            name={[field.name, 'maSanPham']}
                            fieldKey={[field.fieldKey, 'maSanPham']}
                            rules={[{ required: true, message: 'Chọn nguyên vật liệu' }]}
                          >
                            <Select
                              showSearch
                              placeholder="Chọn nguyên vật liệu"
                              options={productOptions}
                              loading={productsLoading}
                              optionFilterProp="label"
                              onChange={(value) => handleSelectProduct(index, value)}
                            />
                          </Form.Item>
                        </Col>
                        <Col span={6}>
                          <Form.Item
                            {...field}
                            label="Số lượng"
                            name={[field.name, 'soLuong']}
                            fieldKey={[field.fieldKey, 'soLuong']}
                            rules={[{ required: true, message: 'Nhập số lượng' }]}
                          >
                            <InputNumber
                              min={0}
                              style={{ width: '100%' }}
                              placeholder="Số lượng"
                            />
                          </Form.Item>
                        </Col>
                        <Col span={6}>
                          <Form.Item
                            {...field}
                            label="Đơn vị"
                            name={[field.name, 'donViTinh']}
                            fieldKey={[field.fieldKey, 'donViTinh']}
                            rules={[{ required: true, message: 'Nhập đơn vị' }]}
                          >
                            <Input placeholder="Đơn vị tính" />
                          </Form.Item>
                        </Col>
                      </Row>
                      <Row gutter={16}>
                        <Col span={8}>
                          <Form.Item
                            {...field}
                            label="Đơn giá"
                            name={[field.name, 'gia']}
                            fieldKey={[field.fieldKey, 'gia']}
                            rules={[{ required: true, message: 'Nhập đơn giá' }]}
                          >
                            <InputNumber
                              min={0}
                              style={{ width: '100%' }}
                              placeholder="Đơn giá"
                              formatter={(value) =>
                                value
                                  ? `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                                  : ''
                              }
                              parser={(value) => value.replace(/,/g, '')}
                            />
                          </Form.Item>
                        </Col>
                        <Col span={8}>
                          <Form.Item
                            {...field}
                            label="Đơn vị giá"
                            name={[field.name, 'donViGia']}
                            fieldKey={[field.fieldKey, 'donViGia']}
                          >
                            <Input placeholder="Đơn vị giá (nếu khác)" />
                          </Form.Item>
                        </Col>
                        <Col span={8}>
                          <Form.Item
                            {...field}
                            label="Ghi chú"
                            name={[field.name, 'ghiChu']}
                            fieldKey={[field.fieldKey, 'ghiChu']}
                          >
                            <Input placeholder="Ghi chú dòng (nếu có)" />
                          </Form.Item>
                        </Col>
                      </Row>
                      {maKho && productCode && (
                        <Typography.Text type="secondary">
                          Tồn kho hiện tại: {tonKhoValue !== undefined ? tonKhoValue.toLocaleString('vi-VN') : 'Đang tải...'}
                        </Typography.Text>
                      )}
                    </Card>
                  );
                })}
                <Button type="dashed" block onClick={() => add({ soLuong: 1 })}>
                  Thêm dòng nguyên vật liệu
                </Button>
              </>
            )}
          </Form.List>

          <Card className="xuat-kho-summary-card" size="small">
            <Space direction="vertical" size={4}>
              <Typography.Text type="secondary">Tổng giá trị dự kiến</Typography.Text>
              <Typography.Title level={4} style={{ margin: 0 }}>
                {Number(detailDraftTotal || 0).toLocaleString('vi-VN', {
                  style: 'currency',
                  currency: 'VND',
                  maximumFractionDigits: 0
                })}
              </Typography.Title>
            </Space>
          </Card>
        </Form>
      </Drawer>

      <Drawer
        width={720}
        open={detailDrawerOpen}
        title={`Chi tiết phiếu xuất ${selectedReceipt?.maPhieuXuat || ''}`}
        onClose={closeDetailDrawer}
      >
        {selectedReceipt ? (
          <Space direction="vertical" size="large" style={{ width: '100%' }}>
            <Card size="small">
              <Row gutter={[16, 8]}>
                <Col span={12}>
                  <Typography.Text type="secondary">Kho xuất</Typography.Text>
                  <div>{selectedReceipt.maKho}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Người lập</Typography.Text>
                  <div>{selectedReceipt.maNguoiDung || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Ngày xuất</Typography.Text>
                  <div>{formatDateValue(selectedReceipt.ngayXuat) || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Nguồn xuất</Typography.Text>
                  <div>{selectedReceipt.nguonXuat || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Người nhận</Typography.Text>
                  <div>{selectedReceipt.nguoiNhanKho || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Hình thức</Typography.Text>
                  <div>{selectedReceipt.hinhThucXuat || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Trạng thái</Typography.Text>
                  <div>{selectedReceipt.trangThai || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Mã tham chiếu</Typography.Text>
                  <div>{selectedReceipt.maThamChieu || '—'}</div>
                </Col>
                <Col span={24}>
                  <Typography.Text type="secondary">Ghi chú</Typography.Text>
                  <div>{selectedReceipt.ghiChu || '—'}</div>
                </Col>
              </Row>
            </Card>

            <Card size="small">
              <Typography.Title level={5} style={{ marginBottom: 16 }}>
                Danh sách nguyên vật liệu
              </Typography.Title>
              <Table
                rowKey={(record) => `${record.maSanPham}-${record.donViTinh}`}
                columns={detailColumns}
                dataSource={receiptDetails}
                loading={detailLoading}
                pagination={false}
                locale={{
                  emptyText: detailLoading ? <Empty description="Đang tải dữ liệu" /> : undefined
                }}
              />
              <Divider />
              <div className="xuat-kho-detail-total">
                <Typography.Text strong>Tổng cộng:</Typography.Text>
                <Typography.Text strong>
                  {Number(
                    receiptDetails.reduce(
                      (sum, item) => sum + (item.soLuong || 0) * (item.gia || 0),
                      0
                    )
                  ).toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                    maximumFractionDigits: 0
                  })}
                </Typography.Text>
              </div>
            </Card>
          </Space>
        ) : (
          <Empty description="Không có dữ liệu phiếu xuất" />
        )}
      </Drawer>
    </div>
  );
};

export default XuatKho;
