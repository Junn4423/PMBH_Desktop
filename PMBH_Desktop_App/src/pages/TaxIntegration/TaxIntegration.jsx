import React, { useEffect, useMemo, useState } from 'react';
import {
  Alert,
  Button,
  Card,
  Col,
  Divider,
  Form,
  Input,
  InputNumber,
  Row,
  Space,
  Switch,
  Typography,
  message
} from 'antd';
import {
  Save,
  RefreshCcw,
  Send,
  Trash2,
  Plus,
  MinusCircle
} from 'lucide-react';
import {
  cacheTaxToken,
  clearCachedTaxToken,
  clearTaxIntegrationConfig,
  getCachedTaxToken,
  loadTaxConfig,
  mapConfigToFormValues,
  mapFormValuesToConfig,
  normalizeTaxConfig,
  requestTaxAccessToken,
  saveTaxConfig
} from '../../services/taxIntegrationService';

const { Title, Text, Paragraph } = Typography;

const layout = {
  labelCol: { span: 8 },
  wrapperCol: { span: 16 }
};

const narrowLayout = {
  labelCol: { span: 6 },
  wrapperCol: { span: 18 }
};

const TaxIntegration = () => {
  const [form] = Form.useForm();
  const [saving, setSaving] = useState(false);
  const [testingToken, setTestingToken] = useState(false);
  const [configSnapshot, setConfigSnapshot] = useState(() => normalizeTaxConfig(loadTaxConfig()));
  const [tokenSnapshot, setTokenSnapshot] = useState(() => getCachedTaxToken());

  useEffect(() => {
    form.setFieldsValue(mapConfigToFormValues(configSnapshot));
  }, [configSnapshot, form]);

  const isIntegrationEnabled = Form.useWatch('enabled', form);

  const tokenPreview = useMemo(() => {
    if (!tokenSnapshot?.accessToken) {
      return null;
    }
    const hiddenToken = `${tokenSnapshot.accessToken.slice(0, 8)}…${tokenSnapshot.accessToken.slice(-4)}`;
    return {
      masked: hiddenToken,
      expiresAt: tokenSnapshot.expiresAt ? new Date(tokenSnapshot.expiresAt) : null
    };
  }, [tokenSnapshot]);

  const handleSave = async () => {
    try {
      setSaving(true);
      const values = await form.validateFields();
      const configToSave = mapFormValuesToConfig(values);
      const persisted = saveTaxConfig(configToSave);
      setConfigSnapshot(persisted);
      message.success('Đã lưu cấu hình kết nối thuế.');
      if (!persisted.enabled) {
        setTokenSnapshot(null);
      }
    } catch (error) {
      console.error('[TaxIntegration] Save failed:', error);
      if (error?.errorFields) {
        message.error('Vui lòng kiểm tra lại các trường bắt buộc.');
      } else {
        message.error(error.message || 'Không thể lưu cấu hình.');
      }
    } finally {
      setSaving(false);
    }
  };

  const handleTestToken = async () => {
    try {
      setTestingToken(true);
      const values = await form.validateFields([
        'enabled',
        'apiBaseUrl',
        'tokenEndpoint',
        'tokenFields',
        'tokenResponseAccessPath',
        'tokenResponseExpiresPath',
        'tokenExpiresBufferSeconds'
      ]);
      const configToUse = mapFormValuesToConfig({
        ...form.getFieldsValue(true),
        ...values
      });
      const tokenData = await requestTaxAccessToken(configToUse);
      cacheTaxToken(tokenData, configToUse);
      setTokenSnapshot(getCachedTaxToken());
      message.success('Kết nối thành công và đã lấy token mới.');
    } catch (error) {
      console.error('[TaxIntegration] Token test failed:', error);
      message.error(error?.response?.data?.message || error.message || 'Không thể lấy token.');
    } finally {
      setTestingToken(false);
    }
  };

  const handleClearConfig = () => {
    clearTaxIntegrationConfig();
    setConfigSnapshot(normalizeTaxConfig(loadTaxConfig()));
    setTokenSnapshot(null);
    message.success('Đã xóa cấu hình kết nối thuế.');
  };

  const handleClearToken = () => {
    clearCachedTaxToken();
    setTokenSnapshot(null);
    message.success('Đã xóa token đã lưu.');
  };

  return (
    <div className="page tax-integration-page">
      <Row justify="space-between" align="middle" style={{ marginBottom: 24 }}>
        <Col>
          <Title level={2} style={{ marginBottom: 0 }}>
            Kết nối hóa đơn điện tử
          </Title>
          <Text type="secondary">
            Cấu hình thông tin kết nối tới nhà cung cấp hóa đơn điện tử để đồng bộ hóa đơn sau khi thanh toán.
          </Text>
        </Col>
        <Col>
          <Space>
            <Button icon={<Trash2 size={16} />} danger onClick={handleClearConfig}>
              Xóa cấu hình
            </Button>
            <Button icon={<RefreshCcw size={16} />} onClick={handleClearToken}>
              Xóa token
            </Button>
            <Button
              type="primary"
              icon={<Save size={16} />}
              loading={saving}
              onClick={handleSave}
            >
              Lưu cấu hình
            </Button>
          </Space>
        </Col>
      </Row>

      <Row gutter={[24, 24]}>
        <Col span={16}>
          <Card title="Thông tin kết nối">
            <Form
              form={form}
              layout="horizontal"
              {...layout}
              colon={false}
              initialValues={mapConfigToFormValues(configSnapshot)}
            >
              <Form.Item
                label="Kích hoạt"
                name="enabled"
                valuePropName="checked"
              >
                <Switch />
              </Form.Item>

              <Form.Item
                label="API Base URL"
                name="apiBaseUrl"
                rules={[
                  {
                    required: isIntegrationEnabled,
                    message: 'Vui lòng nhập API Base URL'
                  }
                ]}
              >
                <Input placeholder="Ví dụ: https://api.ncc-hoadon.vn" />
              </Form.Item>

              <Form.Item
                label="Token Endpoint"
                name="tokenEndpoint"
                tooltip="Đường dẫn lấy token OAuth2, có thể là path tương đối hoặc URL đầy đủ."
                rules={[
                  {
                    required: isIntegrationEnabled,
                    message: 'Vui lòng nhập token endpoint'
                  }
                ]}
              >
                <Input placeholder="/oauth/token" />
              </Form.Item>

              <Form.Item
                label="Invoice Endpoint"
                name="invoiceEndpoint"
                tooltip="Đường dẫn gửi dữ liệu hóa đơn."
                rules={[
                  {
                    required: isIntegrationEnabled,
                    message: 'Vui lòng nhập invoice endpoint'
                  }
                ]}
              >
                <Input placeholder="/invoice" />
              </Form.Item>

              <Form.Item
                label="Đường dẫn mã tra cứu"
                name="lookupCodeResponsePath"
                tooltip="Đường dẫn JSON tới mã tra cứu. Để trống để hệ thống tự dò theo các khóa phổ biến."
              >
                <Input placeholder="data.lookup_code" />
              </Form.Item>

              <Divider orientation="left">Thông tin token</Divider>

              <Form.Item
                label="Đường dẫn access_token"
                name="tokenResponseAccessPath"
                tooltip="Đường dẫn truy cập tới token trong JSON trả về, ví dụ: access_token hoặc data.access_token."
              >
                <Input placeholder="access_token" />
              </Form.Item>

              <Form.Item
                label="Đường dẫn expires_in"
                name="tokenResponseExpiresPath"
                tooltip="Đường dẫn tới expires_in trong JSON trả về."
              >
                <Input placeholder="expires_in" />
              </Form.Item>

              <Form.Item
                label="Buffer hết hạn (s)"
                name="tokenExpiresBufferSeconds"
                tooltip="Số giây trừ đi trước khi token hết hạn để làm mới."
              >
                <InputNumber min={0} style={{ width: '100%' }} />
              </Form.Item>

              <Form.List name="tokenFields">
                {(fields, { add, remove }) => (
                  <>
                    <Form.Item label="Trường gửi token">
                      <Button
                        type="dashed"
                        onClick={() => add({ key: '', value: '' })}
                        icon={<Plus size={16} />}
                        block
                      >
                        Thêm trường
                      </Button>
                    </Form.Item>

                    {fields.map(({ key, name, ...restField }) => (
                      <Row key={key} gutter={12} style={{ marginBottom: 12 }}>
                        <Col span={10}>
                          <Form.Item
                            {...restField}
                            name={[name, 'key']}
                            rules={[
                              { required: true, message: 'Nhập tên trường' }
                            ]}
                          >
                            <Input placeholder="client_id" />
                          </Form.Item>
                        </Col>
                        <Col span={12}>
                          <Form.Item
                            {...restField}
                            name={[name, 'value']}
                            rules={[
                              { required: true, message: 'Nhập giá trị' }
                            ]}
                          >
                            <Input placeholder="Giá trị" />
                          </Form.Item>
                        </Col>
                        <Col span={2} style={{ display: 'flex', alignItems: 'center' }}>
                          <Button
                            type="text"
                            danger
                            icon={<MinusCircle size={18} />}
                            onClick={() => remove(name)}
                          />
                        </Col>
                      </Row>
                    ))}
                  </>
                )}
              </Form.List>

              <Form.Item wrapperCol={{ span: 16, offset: 8 }}>
                <Space>
                  <Button
                    icon={<Send size={16} />}
                    onClick={handleTestToken}
                    loading={testingToken}
                    disabled={!isIntegrationEnabled}
                  >
                    Thử kết nối token
                  </Button>
                  <Button
                    type="primary"
                    icon={<Save size={16} />}
                    loading={saving}
                    onClick={handleSave}
                  >
                    Lưu cấu hình
                  </Button>
                </Space>
              </Form.Item>

              <Divider orientation="left">Mặc định hóa đơn</Divider>

              <Form.Item
                {...narrowLayout}
                label="Ký hiệu hóa đơn"
                name={['invoiceDefaults', 'serial']}
              >
                <Input placeholder="Ví dụ: 2C25MPA" />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Tên hóa đơn"
                name={['invoiceDefaults', 'name']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Loại hóa đơn"
                name={['invoiceDefaults', 'invoice_type']}
              >
                <InputNumber min={0} style={{ width: '100%' }} />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Mã khởi tạo"
                name={['invoiceDefaults', 'init_invoice']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Kiểu thanh toán"
                name={['invoiceDefaults', 'payment_type']}
              >
                <InputNumber min={0} style={{ width: '100%' }} />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Auto sign"
                name={['invoiceDefaults', 'autoSign']}
              >
                <InputNumber min={0} max={1} style={{ width: '100%' }} />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Return XML"
                name={['invoiceDefaults', 'returnXml']}
              >
                <InputNumber min={0} max={1} style={{ width: '100%' }} />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Create action"
                name="createAction"
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Update action"
                name="updateAction"
              >
                <Input />
              </Form.Item>

              <Divider orientation="left">Thông tin khách hàng mặc định</Divider>

              <Form.Item
                {...narrowLayout}
                label="Tên khách hàng"
                name={['customerDefaults', 'cus_name']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Người mua"
                name={['customerDefaults', 'cus_buyer']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Mã số thuế"
                name={['customerDefaults', 'cus_tax_code']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Địa chỉ"
                name={['customerDefaults', 'cus_address']}
              >
                <Input.TextArea rows={2} />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Điện thoại"
                name={['customerDefaults', 'cus_phone']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Email"
                name={['customerDefaults', 'cus_email']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Email CC"
                name={['customerDefaults', 'cus_email_cc']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Email BCC"
                name={['customerDefaults', 'cus_email_bcc']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Số tài khoản"
                name={['customerDefaults', 'cus_bank_no']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Tên ngân hàng"
                name={['customerDefaults', 'cus_bank_name']}
              >
                <Input />
              </Form.Item>

              <Form.Item
                {...narrowLayout}
                label="Gửi ngay sau thanh toán"
                name="sendAfterPayment"
                valuePropName="checked"
              >
                <Switch />
              </Form.Item>
            </Form>
          </Card>
        </Col>

        <Col span={8}>
          <Space direction="vertical" size="large" style={{ width: '100%' }}>
            <Card title="Trạng thái kết nối">
              {tokenPreview ? (
                <>
                  <Paragraph>
                    <Text strong>Token hiện tại:</Text>
                    <br />
                    <Text code>{tokenPreview.masked}</Text>
                  </Paragraph>
                  {tokenPreview.expiresAt && (
                    <Paragraph>
                      <Text strong>Hết hạn:</Text>
                      <br />
                      <Text>
                        {tokenPreview.expiresAt.toLocaleString('vi-VN')}
                      </Text>
                    </Paragraph>
                  )}
                </>
              ) : (
                <Paragraph>Chưa có token được lưu.</Paragraph>
              )}

              <Alert
                type="info"
                showIcon
                message="Mẹo"
                description="Sau khi lưu cấu hình, bạn có thể thử kết nối để kiểm tra thông tin token."
              />
            </Card>

            <Card title="Hướng dẫn tóm tắt">
              <Paragraph>
                <Text strong>1.</Text> Điền API Base URL, đường dẫn lấy token và gửi hóa đơn.
              </Paragraph>
              <Paragraph>
                <Text strong>2.</Text> Thêm các tham số x-www-form-urlencoded để lấy token.
              </Paragraph>
              <Paragraph>
                <Text strong>3.</Text> Kiểm tra và lưu thông tin mặc định của hóa đơn, khách hàng.
              </Paragraph>
              <Paragraph>
                <Text strong>4.</Text> Nhấn &quot;Thử kết nối token&quot; để đảm bảo thông tin chính xác.
              </Paragraph>
            </Card>
          </Space>
        </Col>
      </Row>
    </div>
  );
};

export default TaxIntegration;

