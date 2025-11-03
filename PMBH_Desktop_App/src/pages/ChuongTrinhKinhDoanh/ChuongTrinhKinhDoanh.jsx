import React, { useEffect, useState, useCallback } from 'react';
import {
  Breadcrumb,
  Card,
  Typography,
  Table,
  Button,
  Space,
  Tag,
  Modal,
  Form,
  Input,
  DatePicker,
  InputNumber,
  Select,
  Switch,
  Row,
  Col,
  Popconfirm,
  message,
  Divider
} from 'antd';
import {
  TrendingUp,
  Plus,
  RefreshCcw,
  Edit3,
  Trash2,
  Power
} from 'lucide-react';
import dayjs from 'dayjs';
import {
  listSalesPrograms,
  getSalesProgram,
  createSalesProgram,
  updateSalesProgram,
  deleteSalesProgram,
  toggleSalesProgramStatus,
  getAllSanPham
} from '../../services/apiServices';

const { Title, Text } = Typography;
const { RangePicker } = DatePicker;

const ChuongTrinhKinhDoanh = () => {
  const [loading, setLoading] = useState(false);
  const [programs, setPrograms] = useState([]);
  const [statusFilter, setStatusFilter] = useState('all');
  const [modalOpen, setModalOpen] = useState(false);
  const [modalMode, setModalMode] = useState('create');
  const [modalBusy, setModalBusy] = useState(false);
  const [selectedProgramId, setSelectedProgramId] = useState(null);
  const [form] = Form.useForm();
  const [productOptions, setProductOptions] = useState([]);
  const [productLoading, setProductLoading] = useState(false);

    const normalizeDiscountValue = (value) => {
    const numeric = Number(value);
    if (!Number.isFinite(numeric)) {
      return 1;
    }
    const clamped = Math.min(100, Math.max(1, numeric));
    return Math.round(clamped);
  };

const fetchPrograms = async () => {
    setLoading(true);
    try {
      const params =
        statusFilter !== 'all'
          ? { status: statusFilter === '1' ? 1 : 0 }
          : {};
      const response = await listSalesPrograms(params);
      if (response?.success && Array.isArray(response.data)) {
        setPrograms(response.data);
      } else if (Array.isArray(response)) {
        setPrograms(response);
      } else {
        setPrograms([]);
      }
    } catch (error) {
      console.error('Error loading sales programs:', error);
      message.error('Không thể tải danh sách chương trình');
      setPrograms([]);
    } finally {
      setLoading(false);
    }
  };

  const loadProductOptions = useCallback(async () => {
    try {
      setProductLoading(true);
      const response = await getAllSanPham();
      let productsData = [];

      if (response?.success && Array.isArray(response.data)) {
        productsData = response.data;
      } else if (Array.isArray(response)) {
        productsData = response;
      } else if (response?.data && typeof response.data === 'object') {
        productsData = Object.values(response.data);
      }

      const formattedOptions = productsData
        .map((product) => {
          const productId =
            product?.maSp ?? product?.id ?? product?.maSP ?? product?.lv001 ?? product?.lv002;
          if (!productId) {
            return null;
          }

          const normalizedId = String(productId).trim();
          if (!normalizedId || normalizedId.toUpperCase().startsWith('NVL')) {
            return null;
          }

          const name =
            product?.tenSp ?? product?.ten ?? product?.tensp ?? `Sản phẩm ${normalizedId}`;
          const priceValue =
            product?.giaBan ?? product?.gia ?? product?.donGia ?? product?.lv007 ?? null;
          const price =
            typeof priceValue === 'number'
              ? priceValue
              : parseInt(String(priceValue || '').replace(/[^\d]/g, ''), 10);
          const label =
            Number.isFinite(price) && price > 0
              ? `${name} (${price.toLocaleString('vi-VN')} ₫)`
              : name;
          return {
            value: normalizedId,
            label,
            data: {
              id: normalizedId,
              name,
              price: Number.isFinite(price) ? price : undefined
            }
          };
        })
        .filter(Boolean);

      setProductOptions(formattedOptions);
    } catch (error) {
      console.error('Failed to load product options:', error);
      message.warning('Khong the tai danh sach san pham');
    } finally {
      setProductLoading(false);
    }
  }, []);

  useEffect(() => {
    fetchPrograms();
  }, [statusFilter]);

  useEffect(() => {
    loadProductOptions();
  }, [loadProductOptions]);

  const resetFormForCreate = () => {
    form.resetFields();
    form.setFieldsValue({
      programId: '',
      name: '',
      value: '0',
      customerGroups: [],
      dateRange: [dayjs(), dayjs().add(7, 'day')],
      details: []
    });
  };

  const openCreateModal = () => {
    setModalMode('create');
    setSelectedProgramId(null);
    resetFormForCreate();
    setModalOpen(true);
  };

  const closeModal = () => {
    setModalOpen(false);
    setModalBusy(false);
    setSelectedProgramId(null);
    form.resetFields();
  };

  const handleEdit = async (programId) => {
    setModalMode('edit');
    setModalBusy(true);
    setSelectedProgramId(programId);
    setModalOpen(true);
    try {
      const response = await getSalesProgram(programId);
      const program =
        response?.success && response.data ? response.data : response;
      if (!program || !program.programId) {
        message.error('Không tìm thấy dữ liệu chương trình');
        closeModal();
        return;
      }
      form.setFieldsValue({
        programId: program.programId,
        name: program.name,
        value: program.value ?? '0',
        customerGroups: Array.isArray(program.customerGroups)
          ? program.customerGroups
          : [],
        dateRange: [
          program.startDate ? dayjs(program.startDate) : null,
          program.endDate ? dayjs(program.endDate) : null
        ],
        details: Array.isArray(program.details)
          ? program.details.map((detail) => ({
              itemId: detail.itemId || '',
              discount: normalizeDiscountValue(detail.discount ?? detail.tyLe ?? 0),
              threshold: detail.threshold ?? 0,
              points: detail.points ?? 0,
              status: detail.status ? detail.status === 1 : true,
              note: detail.note || ''
            }))
          : []
      });
      if (Array.isArray(program.details)) {
        setProductOptions((prev) => {
          const existingKeys = new Set(prev.map((item) => item.value));
          const merged = [...prev];
          program.details.forEach((detail) => {
            const rawId =
              detail.itemId ??
              detail.maSp ??
              detail.masp ??
              detail.ma ??
              detail.productId;
            if (!rawId) {
              return;
            }
            const key = String(rawId).trim();
            if (!key || key.toUpperCase().startsWith('NVL')) {
              return;
            }
            if (!existingKeys.has(key)) {
              const displayName =
                detail.productName ??
                detail.tenSp ??
                detail.ten ??
                `Sản phẩm ${key}`;
              merged.push({
                value: key,
                label: displayName,
                data: {
                  id: key,
                  name: displayName
                }
              });
              existingKeys.add(key);
            }
          });
          return merged;
        });
      }

    } catch (error) {
      console.error('Error loading program detail:', error);
      message.error('Không thể tải chi tiết chương trình');
      closeModal();
    } finally {
      setModalBusy(false);
    }
  };

  const handleDelete = async (programId) => {
    try {
      setLoading(true);
      const response = await deleteSalesProgram(programId);
      if (response?.success === false) {
        message.error(response.message || 'Không thể xóa chương trình');
      } else {
        message.success('Đã xóa chương trình');
        fetchPrograms();
      }
    } catch (error) {
      console.error('Error deleting program:', error);
      message.error('Không thể xóa chương trình');
      setLoading(false);
    }
  };

  const handleToggleStatus = async (record) => {
    try {
      setLoading(true);
      const response = await toggleSalesProgramStatus(
        record.programId,
        record.status === 0
      );
      if (response?.success === false) {
        message.error(response.message || 'Không thể cập nhật trạng thái');
      } else {
        message.success('Đã cập nhật trạng thái chương trình');
        fetchPrograms();
      }
    } catch (error) {
      console.error('Error toggling program status:', error);
      message.error('Không thể cập nhật trạng thái');
      setLoading(false);
    }
  };

  const formatDateTime = (value) =>
    value && dayjs(value).isValid()
      ? dayjs(value).format('DD/MM/YYYY HH:mm')
      : '--';

  const handleModalSubmit = async () => {
    try {
      const values = await form.validateFields();
      const { programId, name, value, customerGroups, dateRange, details } =
        values;
      if (!Array.isArray(dateRange) || !dateRange[0] || !dateRange[1]) {
        message.warning('Vui lòng chọn thời gian áp dụng');
        return;
      }
      const payload = {
        programId: programId || undefined,
        name,
        value: value ?? '0',
        customerGroups: Array.isArray(customerGroups)
          ? customerGroups.filter((item) => item && item.trim() !== '')
          : [],
        startDate: dateRange[0].format('YYYY-MM-DD HH:mm:ss'),
        endDate: dateRange[1].format('YYYY-MM-DD HH:mm:ss'),
        details: Array.isArray(details)
          ? details
              .filter((detail) => detail && detail.itemId)
              .map((detail) => ({
                itemId: detail.itemId,
                discount: Number(detail.discount || 0),
                threshold: Number(detail.threshold || 0),
                points: Number(detail.points || 0),
                status: detail.status ? 1 : 0,
                note: detail.note || ''
              }))
          : []
      };
      setModalBusy(true);
      const response =
        modalMode === 'create'
          ? await createSalesProgram(payload)
          : await updateSalesProgram(payload);
      if (response?.success === false) {
        message.error(response.message || 'Không thể lưu chương trình');
        return;
      }
      message.success(
        modalMode === 'create'
          ? 'Đã tạo chương trình mới'
          : 'Đã cập nhật chương trình'
      );
      closeModal();
      fetchPrograms();
    } catch (error) {
      if (error?.errorFields) {
        return;
      }
      console.error('Error saving program:', error);
      message.error('Không thể lưu chương trình');
    } finally {
      setModalBusy(false);
    }
  };

  const columns = [
    {
      title: 'Mã',
      dataIndex: 'programId',
      key: 'programId',
      width: 130
    },
    {
      title: 'Tên chương trình',
      dataIndex: 'name',
      key: 'name'
    },
    {
      title: 'Thời gian áp dụng',
      key: 'period',
      render: (_, record) => (
        <span>
          {formatDateTime(record.startDate)} - {formatDateTime(record.endDate)}
        </span>
      )
    },
    {
      title: 'Khách hàng mục tiêu',
      dataIndex: 'customerGroups',
      key: 'customerGroups',
      render: (groups) =>
        Array.isArray(groups) && groups.length > 0 ? (
          <Space wrap>
            {groups.map((group) => (
              <Tag key={group}>{group}</Tag>
            ))}
          </Space>
        ) : (
          <Text type="secondary">Tất cả</Text>
        )
    },
    {
      title: 'Sản phẩm',
      dataIndex: 'itemCount',
      key: 'itemCount',
      width: 100,
      align: 'center'
    },
    {
      title: 'Trạng thái',
      dataIndex: 'status',
      key: 'status',
      width: 120,
      render: (status) => (
        <Tag color={status === 1 ? 'green' : 'default'}>
          {status === 1 ? 'Hoạt động' : 'Tạm dừng'}
        </Tag>
      )
    },
    {
      title: 'Thao tác',
      key: 'actions',
      width: 240,
      render: (_, record) => (
        <Space size="small" wrap>
          <Button
            size="small"
            icon={<Edit3 size={14} />}
            onClick={() => handleEdit(record.programId)}
          >
            Sửa
          </Button>
          <Button
            size="small"
            icon={<Power size={14} />}
            onClick={() => handleToggleStatus(record)}
          >
            {record.status === 1 ? 'Ngưng' : 'Kích hoạt'}
          </Button>
          <Popconfirm
            title="Xác nhận xóa"
            description="Bạn có chắc chắn muốn xóa chương trình này?"
            onConfirm={() => handleDelete(record.programId)}
            okText="Xóa"
            cancelText="Hủy"
          >
            <Button size="small" danger icon={<Trash2 size={14} />}>
              Xóa
            </Button>
          </Popconfirm>
        </Space>
      )
    }
  ];

  return (
    <div>
      <Breadcrumb style={{ marginBottom: 16 }}>
        <Breadcrumb.Item>Kinh doanh</Breadcrumb.Item>
        <Breadcrumb.Item>Quản lý bán hàng</Breadcrumb.Item>
        <Breadcrumb.Item>Chương trình kinh doanh</Breadcrumb.Item>
      </Breadcrumb>

      <Card>
        <Space
          align="center"
          style={{ width: '100%', justifyContent: 'space-between' }}
          wrap
        >
          <Space align="center">
            <TrendingUp size={28} style={{ color: '#197dd3' }} />
            <div>
              <Title level={4} style={{ margin: 0 }}>
                Quản lý chương trình kinh doanh
              </Title>
              <Text type="secondary">
                Thiết lập ưu đãi theo chương trình & tích điểm khách hàng.
              </Text>
            </div>
          </Space>
          <Space wrap>
            <Select
              size="middle"
              value={statusFilter}
              style={{ width: 160 }}
              onChange={setStatusFilter}
            >
              <Select.Option value="all">Tất cả trạng thái</Select.Option>
              <Select.Option value="1">Đang hoạt động</Select.Option>
              <Select.Option value="0">Tạm dừng</Select.Option>
            </Select>
            <Button
              icon={<RefreshCcw size={16} />}
              onClick={fetchPrograms}
              disabled={loading}
            >
              Làm mới
            </Button>
            <Button
              type="primary"
              icon={<Plus size={16} />}
              onClick={openCreateModal}
            >
              Tạo chương trình
            </Button>
          </Space>
        </Space>

        <Divider />

        <Table
          rowKey="programId"
          dataSource={programs}
          columns={columns}
          loading={loading}
          pagination={{ pageSize: 10 }}
        />
      </Card>

      <Modal
        title={
          modalMode === 'create'
            ? 'Tạo chương trình kinh doanh'
            : 'Cập nhật chương trình'
        }
        open={modalOpen}
        onCancel={closeModal}
        onOk={handleModalSubmit}
        confirmLoading={modalBusy}
        width={900}
        okText={modalMode === 'create' ? 'Tạo chương trình' : 'Lưu thay đổi'}
      >
        <Form
          form={form}
          layout="vertical"
          initialValues={{
            programId: '',
            name: '',
            value: '0',
            customerGroups: [],
            details: []
          }}
        >
          <Row gutter={12}>
            <Col span={12}>
              <Form.Item
                name="programId"
                label="Mã chương trình"
                tooltip="Bỏ trống để hệ thống tự sinh mã"
              >
                <Input
                  placeholder="VD: CTKM2025"
                  disabled={modalMode === 'edit'}
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="value"
                label="Giá trị chung"
                tooltip="Thông tin tùy chọn, ví dụ mức giảm giá mặc định"
              >
                <Input placeholder="VD: 10% hoặc ghi chú nội bộ" />
              </Form.Item>
            </Col>
          </Row>

          <Form.Item
            name="name"
            label="Tên chương trình"
            rules={[{ required: true, message: 'Nhập tên chương trình' }]}
          >
            <Input placeholder="Ví dụ: Khuyến mãi mùa hè 2025" />
          </Form.Item>

          <Row gutter={12}>
            <Col span={12}>
              <Form.Item
                name="dateRange"
                label="Thời gian áp dụng"
                rules={[
                  {
                    required: true,
                    message: 'Chọn thời gian áp dụng'
                  }
                ]}
              >
                <RangePicker
                  style={{ width: '100%' }}
                  showTime
                  format="DD/MM/YYYY HH:mm"
                />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="customerGroups"
                label="Nhóm khách hàng"
                tooltip="Có thể nhập nhiều nhóm, ví dụ VIP, GOLD..."
              >
                <Select
                  mode="tags"
                  placeholder="Áp dụng cho nhóm nào? Để trống = tất cả"
                />
              </Form.Item>
            </Col>
          </Row>

          <Divider orientation="left">Danh sách ưu đãi theo sản phẩm</Divider>

          <Form.List name="details">
            {(fields, { add, remove }) => (
              <>
                {fields.map((field, index) => (
                  <Card
                    key={field.key}
                    size="small"
                    style={{ marginBottom: 12 }}
                    title={`Mục ưu đãi #${index + 1}`}
                    extra={
                      <Button
                        type="text"
                        danger
                        icon={<Trash2 size={14} />}
                        onClick={() => remove(field.name)}
                      />
                    }
                  >
                    <Row gutter={12}>
                      <Col span={12}>
                        <Form.Item
                          {...field}
                          name={[field.name, 'itemId']}
                          fieldKey={[field.fieldKey, 'itemId']}
                          label="Món khuyến mãi"
                          rules={[
                            {
                              required: true,
                              message: 'Chọn món khuyến mãi'
                            }
                          ]}
                        >
                          <Select
                            showSearch
                            allowClear
                            options={productOptions}
                            loading={productLoading}
                            placeholder="Chọn món áp dụng"
                            optionFilterProp="label"
                            filterOption={(input, option) =>
                              (option?.label ?? '')
                                .toString()
                                .toLowerCase()
                                .includes(input.toLowerCase())
                            }
                          />
                        </Form.Item>
                      </Col>
                      <Col span={12}>
                        <Form.Item
                          name={[field.name, 'discount']}
                          fieldKey={[field.fieldKey, 'discount']}
                          label="Giảm giá (%)"
                        >
                          <InputNumber
                            min={1}
                            max={100}
                            step={1}
                            style={{ width: '100%' }}
                            placeholder="1 - 100"
                          />
                        </Form.Item>
                      </Col>
                      <Col span={12}>
                        <Form.Item
                          name={[field.name, 'threshold']}
                          fieldKey={[field.fieldKey, 'threshold']}
                          label="Điều kiện (số lượng)"
                        >
                          <InputNumber
                            min={0}
                            step={1}
                            style={{ width: '100%' }}
                          />
                        </Form.Item>
                      </Col>
                      <Col span={12}>
                        <Form.Item
                          name={[field.name, 'points']}
                          fieldKey={[field.fieldKey, 'points']}
                          label="Điểm thưởng"
                        >
                          <InputNumber
                            min={0}
                            step={1}
                            style={{ width: '100%' }}
                          />
                        </Form.Item>
                      </Col>
                      <Col span={12}>
                        <Form.Item
                          name={[field.name, 'status']}
                          fieldKey={[field.fieldKey, 'status']}
                          label="Kích hoạt"
                          valuePropName="checked"
                        >
                          <Switch />
                        </Form.Item>
                      </Col>
                      <Col span={12}>
                        <Form.Item
                          name={[field.name, 'note']}
                          fieldKey={[field.fieldKey, 'note']}
                          label="Ghi chú"
                        >
                          <Input placeholder="Ghi chú nội bộ" />
                        </Form.Item>
                      </Col>
                    </Row>
                  </Card>
                ))}
                <Button
                  type="dashed"
                  block
                  icon={<Plus size={16} />}
                  onClick={() => add({ status: true })}
                >
                  Thêm sản phẩm áp dụng
                </Button>
              </>
            )}
          </Form.List>
        </Form>
      </Modal>
    </div>
  );
};

export default ChuongTrinhKinhDoanh;



