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
  FileText,
  Warehouse as WarehouseIcon,
  ClipboardList
} from 'lucide-react';
import dayjs from 'dayjs';
import {
  listPhieuNhap,
  createPhieuNhap,
  deletePhieuNhap,
  getPhieuNhapById,
  listChiTietPhieuNhap,
  getDanhSachKho,
  listTatCaNguyenLieu
} from '../../services/apiServices';
import './NhapKho.css';

const { RangePicker } = DatePicker;
const { Option } = Select;

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
  maPhieuNhap: item?.maPhieuNhap ?? item?.lv001 ?? item?.id ?? '',
  maKho: item?.maKho ?? item?.lv002 ?? '',
  maNguoiDung: item?.maNguoiDung ?? item?.lv003 ?? '',
  ghiChu: item?.ghiChu ?? item?.lv004 ?? '',
  loaiPhieu: item?.loaiPhieu ?? item?.lv005 ?? '',
  maThamChieu: item?.maThamChieu ?? item?.lv006 ?? '',
  trangThai: item?.trangThai ?? item?.lv007 ?? '',
  tongTien: Number(item?.tongTien ?? item?.lv008 ?? 0),
  ngayNhap: item?.ngayNhap ?? item?.lv009 ?? '',
  maPhieu: item?.maPhieu ?? item?.lv001 ?? ''
});

const normalizeDetail = (item) => ({
  maSanPham: item?.maSanPham ?? item?.maSp ?? item?.lv003 ?? '',
  soLuong: Number(item?.soLuong ?? item?.lv004 ?? 0),
  donViTinh: item?.donViTinh ?? item?.lv005 ?? '',
  gia: Number(item?.gia ?? item?.lv008 ?? 0),
  donViGia: item?.donViGia ?? item?.lv009 ?? '',
  ngayBan: item?.ngayBan ?? item?.lv016 ?? '',
  ghiChu: item?.ghiChu ?? item?.lv010 ?? ''
});

const NhapKho = () => {
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
  const detailsWatch = Form.useWatch('details', createForm);

  const [detailDrawerOpen, setDetailDrawerOpen] = useState(false);
  const [detailLoading, setDetailLoading] = useState(false);
  const [selectedReceipt, setSelectedReceipt] = useState(null);
  const [receiptDetails, setReceiptDetails] = useState([]);

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

  const receiptStats = useMemo(() => {
    const total = filteredReceipts.length;
    const totalAmount = filteredReceipts.reduce((sum, item) => sum + (item?.tongTien || 0), 0);
    return {
      total,
      totalAmount
    };
  }, [filteredReceipts]);

  const detailDraftTotal = useMemo(() => {
    if (!detailsWatch || !Array.isArray(detailsWatch)) {
      return 0;
    }
    return detailsWatch.reduce((sum, item) => {
      const qty = Number(item?.soLuong || 0);
      const price = Number(item?.gia || 0);
      return sum + qty * price;
    }, 0);
  }, [detailsWatch]);

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
      const list = Array.isArray(data) ? data : [];
      setProducts(list);
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
      const data = await listPhieuNhap();
      const list = Array.isArray(data) ? data.map(normalizeReceipt) : [];
      setReceipts(list);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải danh sách phiếu nhập.');
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
          item.maPhieuNhap,
          item.maKho,
          item.maNguoiDung,
          item.maThamChieu,
          item.loaiPhieu
        ]
          .filter(Boolean)
          .map((value) => String(value).toLowerCase());
        return values.some((value) => value.includes(keyword));
      });
    }

    if (filters.dateRange && filters.dateRange.length === 2) {
      const [start, end] = filters.dateRange;
      data = data.filter((item) => {
        const date = parseDateValue(item.ngayNhap);
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
    createForm.setFieldsValue({
      details: [
        {
          soLuong: 1
        }
      ],
      trangThai: '0',
      ngayNhap: dayjs()
    });
  };

  const openCreateDrawer = () => {
    resetCreateForm();
    setCreateDrawerOpen(true);
  };

  const closeCreateDrawer = () => {
    setCreateDrawerOpen(false);
  };

  const handleSelectProduct = (index, productCode) => {
    const product = productMap[productCode];
    if (!product) {
      return;
    }

    const details = createForm.getFieldValue('details') || [];
    const current = details[index] || {};

    const updated = [...details];
    updated[index] = {
      ...current,
      maSanPham: productCode,
      donViTinh: product?.maDv || product?.maDV || product?.donViTinh || current?.donViTinh || '',
      donViGia: product?.dvGia || product?.maDv || current?.donViGia || '',
      gia:
        Number(
          product?.gia ??
            product?.lv007 ??
            product?.giaNhap ??
            current?.gia ??
            0
        ) || 0
    };

    createForm.setFieldsValue({ details: updated });
  };

  const handleDeleteReceipt = async (record) => {
    try {
      await deletePhieuNhap(record?.maPhieuNhap || record?.maPhieu);
      message.success('Đã xoá phiếu nhập.');
      fetchReceipts();
    } catch (error) {
      console.error(error);
      message.error('Không thể xoá phiếu nhập, vui lòng thử lại.');
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

      const tongTien = detailsPayload.reduce(
        (sum, item) => sum + (item.soLuong || 0) * (item.gia || 0),
        0
      );

      await createPhieuNhap({
        maKho: values.maKho,
        maNguoiDung: values.maNguoiDung || '',
        ghiChu: values.ghiChu || '',
        loaiPhieu: values.loaiPhieu || '',
        maThamChieu: values.maThamChieu || '',
        trangThai: values.trangThai || '',
        ngayNhap: values.ngayNhap ? dayjs(values.ngayNhap).format('YYYYMMDDHHmmss') : '',
        tongTien,
        details: detailsPayload
      });

      message.success('Tạo phiếu nhập thành công.');
      setCreateDrawerOpen(false);
      fetchReceipts();
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error(error);
      message.error('Không thể tạo phiếu nhập, vui lòng thử lại.');
    } finally {
      setCreateSubmitting(false);
    }
  };

  const openDetailDrawer = async (record) => {
    setSelectedReceipt(null);
    setReceiptDetails([]);
    setDetailDrawerOpen(true);
    setDetailLoading(true);

    try {
      const header = await getPhieuNhapById(record?.maPhieuNhap || record?.maPhieu);
      if (header) {
        setSelectedReceipt(normalizeReceipt(header));
      } else {
        setSelectedReceipt(record);
      }

      const detailResponse = await listChiTietPhieuNhap(record?.maPhieuNhap || record?.maPhieu);
      const details = Array.isArray(detailResponse)
        ? detailResponse.map(normalizeDetail)
        : [];
      setReceiptDetails(details);
    } catch (error) {
      console.error(error);
      message.error('Không thể tải chi tiết phiếu nhập.');
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

  const warehouseOptions = useMemo(() => {
    return warehouses.map((item) => ({
      label: `${item?.tenKho || item?.maKho} (${item?.maKho})`,
      value: item?.maKho || item?.lv001
    }));
  }, [warehouses]);

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

  const columns = [
    {
      title: 'Mã phiếu',
      dataIndex: 'maPhieuNhap',
      key: 'maPhieuNhap',
      render: (value) => <Tag color="blue">{value}</Tag>
    },
    {
      title: 'Kho',
      dataIndex: 'maKho',
      key: 'maKho',
      render: (value) => (
        <Space size={6}>
          <WarehouseIcon size={14} />
          <span>{value}</span>
        </Space>
      )
    },
    {
      title: 'Người nhập',
      dataIndex: 'maNguoiDung',
      key: 'maNguoiDung'
    },
    {
      title: 'Loại phiếu',
      dataIndex: 'loaiPhieu',
      key: 'loaiPhieu'
    },
    {
      title: 'Ngày nhập',
      dataIndex: 'ngayNhap',
      key: 'ngayNhap',
      render: (value) => formatDateValue(value)
    },
    {
      title: 'Tổng tiền',
      dataIndex: 'tongTien',
      key: 'tongTien',
      align: 'right',
      render: (value) =>
        Number(value || 0).toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        })
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      render: (value) => {
        const statusMap = {
          '0': { text: 'Nháp', color: 'default' },
          '1': { text: 'Đã duyệt', color: 'green' },
          '2': { text: 'Hoàn tất', color: 'blue' }
        };
        const status = statusMap[value] || { text: value || 'Khác', color: 'orange' };
        return <Tag color={status.color}>{status.text}</Tag>;
      }
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
            title="Xoá phiếu nhập"
            description={`Bạn có chắc muốn xoá phiếu ${record?.maPhieuNhap}?`}
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
        const amount = quantity * price;
        return amount.toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
          maximumFractionDigits: 0
        });
      }
    }
  ];

  return (
    <div className="nhap-kho-container">
      <Breadcrumb className="page-breadcrumb">
        <Breadcrumb.Item>Trang chủ</Breadcrumb.Item>
        <Breadcrumb.Item>Quản lý kho</Breadcrumb.Item>
        <Breadcrumb.Item>Nhập kho</Breadcrumb.Item>
      </Breadcrumb>

      <div className="nhap-kho-header">
        <div className="nhap-kho-title">
          <Truck size={28} />
          <div>
            <Typography.Title level={3} className="nhap-kho-title-text">
              Phiếu nhập kho
            </Typography.Title>
            <Typography.Text type="secondary">
              Theo dõi chứng từ nhập kho, trạng thái và chi tiết nguyên vật liệu.
            </Typography.Text>
          </div>
        </div>
        <Space className="nhap-kho-actions" wrap>
          <Input.Search
            placeholder="Tìm theo mã phiếu, kho, người nhập..."
            allowClear
            className="nhap-kho-search"
            value={filters.search}
            onChange={(e) => handleFilterChange('search', e.target.value)}
          />
          <Select
            allowClear
            placeholder="Lọc theo kho"
            className="nhap-kho-select"
            value={filters.kho}
            onChange={(value) => handleFilterChange('kho', value)}
            options={warehouseOptions}
          />
          <RangePicker
            allowClear
            className="nhap-kho-range-picker"
            value={filters.dateRange}
            onChange={(value) => handleFilterChange('dateRange', value)}
          />
          <Button icon={<RefreshCw size={16} />} onClick={fetchReceipts}>
            Làm mới
          </Button>
          <Button type="primary" icon={<Plus size={16} />} onClick={openCreateDrawer}>
            Tạo phiếu nhập
          </Button>
        </Space>
      </div>

      <Row gutter={16} className="nhap-kho-stats">
        <Col xs={24} sm={12} md={8}>
          <Card className="nhap-kho-stat-card">
            <Statistic
              title="Tổng số phiếu"
              value={receiptStats.total}
              prefix={<FileText size={18} />}
            />
          </Card>
        </Col>
        <Col xs={24} sm={12} md={8}>
          <Card className="nhap-kho-stat-card">
            <Statistic
              title="Giá trị nhập"
              value={receiptStats.totalAmount}
              precision={0}
              formatter={(value) =>
                Number(value || 0).toLocaleString('vi-VN', {
                  style: 'currency',
                  currency: 'VND',
                  maximumFractionDigits: 0
                })
              }
              prefix={<ClipboardList size={18} />}
            />
          </Card>
        </Col>
      </Row>

      <Card className="main-card">
        <Table
          rowKey={(record) => record?.maPhieuNhap || record?.maPhieu}
          columns={columns}
          dataSource={filteredReceipts}
          loading={loading}
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `${total} phiếu nhập`
          }}
        />
      </Card>

      <Drawer
        width={880}
        open={createDrawerOpen}
        title="Tạo phiếu nhập kho"
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
            details: [
              {
                soLuong: 1
              }
            ],
            trangThai: '0',
            ngayNhap: dayjs()
          }}
        >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                label="Kho nhập"
                name="maKho"
                rules={[{ required: true, message: 'Vui lòng chọn kho' }]}
              >
                <Select
                  placeholder="Chọn kho nhập"
                  options={warehouseOptions}
                  showSearch
                  optionFilterProp="label"
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Người nhập" name="maNguoiDung">
                <Input placeholder="Mã hoặc tên người nhập" />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item label="Loại phiếu" name="loaiPhieu">
                <Input placeholder="Ví dụ: NHAPKHO, MUAHANG..." />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item label="Mã tham chiếu" name="maThamChieu">
                <Input placeholder="Liên kết với chứng từ khác (nếu có)" />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
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
            <Col span={12}>
              <Form.Item label="Ngày nhập" name="ngayNhap">
                <DatePicker
                  className="nhap-kho-date-picker"
                  format="DD/MM/YYYY HH:mm"
                  showTime
                />
              </Form.Item>
            </Col>
          </Row>
          <Form.Item label="Ghi chú" name="ghiChu">
            <Input.TextArea rows={3} placeholder="Thông tin bổ sung cho phiếu nhập" />
          </Form.Item>

          <Divider orientation="left">Chi tiết nguyên vật liệu</Divider>
          <Form.List name="details">
            {(fields, { add, remove }) => (
              <>
                {fields.map((field, index) => (
                  <Card
                    key={field.key}
                    size="small"
                    className="nhap-kho-detail-card"
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
                  </Card>
                ))}
                <Button type="dashed" block onClick={() => add({ soLuong: 1 })}>
                  Thêm dòng nguyên vật liệu
                </Button>
              </>
            )}
          </Form.List>

          <Card className="nhap-kho-summary-card" size="small">
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
        title={`Chi tiết phiếu nhập ${selectedReceipt?.maPhieuNhap || ''}`}
        onClose={closeDetailDrawer}
      >
        {selectedReceipt ? (
          <Space direction="vertical" size="large" style={{ width: '100%' }}>
            <Card size="small">
              <Row gutter={[16, 8]}>
                <Col span={12}>
                  <Typography.Text type="secondary">Kho</Typography.Text>
                  <div>{selectedReceipt.maKho}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Người nhập</Typography.Text>
                  <div>{selectedReceipt.maNguoiDung || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Ngày nhập</Typography.Text>
                  <div>{formatDateValue(selectedReceipt.ngayNhap) || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Loại phiếu</Typography.Text>
                  <div>{selectedReceipt.loaiPhieu || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Mã tham chiếu</Typography.Text>
                  <div>{selectedReceipt.maThamChieu || '—'}</div>
                </Col>
                <Col span={12}>
                  <Typography.Text type="secondary">Trạng thái</Typography.Text>
                  <div>{selectedReceipt.trangThai || '—'}</div>
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
              <div className="nhap-kho-detail-total">
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
          <Empty description="Không có dữ liệu phiếu nhập" />
        )}
      </Drawer>
    </div>
  );
};

export default NhapKho;
