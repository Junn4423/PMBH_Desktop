import React, { useState, useEffect } from 'react';
import { 
  Modal, 
  Form, 
  Radio, 
  InputNumber, 
  Typography, 
  Divider, 
  Row, 
  Col, 
  Space,
  Button,
  message,
  Tag,
  Input
} from 'antd';
import { 
  DollarSign, 
  CreditCard, 
  Smartphone, 
  Building2,
  Receipt,
  Calculator
} from 'lucide-react';
import { PAYMENT_METHODS, PAYMENT_METHOD_LABELS } from '../../constants';
import { thanhToanHoaDon } from '../../services/apiServices'; // Use original working API

const { Title, Text } = Typography;

const PaymentModal = ({ 
  visible, 
  onCancel, 
  onConfirm, 
  invoice, 
  orderTotal,
  loading = false 
}) => {
  const [form] = Form.useForm();
  const [paymentMethod, setPaymentMethod] = useState(PAYMENT_METHODS.CASH);
  const [customerPaid, setCustomerPaid] = useState(orderTotal);
  const [changeAmount, setChangeAmount] = useState(0);

  // Reset form when modal opens
  useEffect(() => {
    if (visible) {
      setCustomerPaid(orderTotal);
      setChangeAmount(0);
      form.setFieldsValue({
        paymentMethod: PAYMENT_METHODS.CASH,
        customerPaid: orderTotal,
        notes: ''
      });
    }
  }, [visible, orderTotal, form]);

  // Calculate change amount
  useEffect(() => {
    const change = customerPaid - orderTotal;
    setChangeAmount(change >= 0 ? change : 0);
  }, [customerPaid, orderTotal]);

  const handlePaymentMethodChange = (e) => {
    const method = e.target.value;
    setPaymentMethod(method);
    
    // For non-cash payments, customer typically pays exact amount
    if (method !== PAYMENT_METHODS.CASH) {
      setCustomerPaid(orderTotal);
      form.setFieldValue('customerPaid', orderTotal);
    }
  };

  const handleCustomerPaidChange = (value) => {
    setCustomerPaid(value || 0);
  };

  const handleConfirmPayment = async () => {
    try {
      const values = await form.validateFields();
      
      if (values.customerPaid < orderTotal) {
        message.error('Số tiền khách đưa không đủ');
        return;
      }

      console.log('💰 [PaymentModal] Starting payment process...');
      console.log('💰 [PaymentModal] Invoice ID:', invoice?.maHd);
      console.log('💰 [PaymentModal] Order Total:', orderTotal);
      console.log('💰 [PaymentModal] Customer Paid:', values.customerPaid);

      // Use simple original API call
      if (!invoice?.maHd) {
        message.error('Không có mã hóa đơn để thanh toán');
        return;
      }

      // Call the original working payment API
      const result = await thanhToanHoaDon(invoice.maHd);
      console.log('💰 [PaymentModal] Payment API result:', result);
      
      if (result && (result.success !== false)) {
        message.success('Thanh toán thành công!');
        
        // Call parent onConfirm with payment data for additional processing
        const paymentData = {
          maHd: invoice?.maHd,
          tongTien: orderTotal,
          tienKhachDua: values.customerPaid,
          tienThua: changeAmount,
          phuongThucThanhToan: values.paymentMethod,
          ghiChu: values.notes || '',
          ngayThanhToan: new Date().toISOString()
        };
        
        await onConfirm(paymentData);
      } else {
        message.error('Thanh toán thất bại: ' + (result?.error || 'Lỗi không xác định'));
      }
    } catch (error) {
      console.error('💰 [PaymentModal] Payment error:', error);
      message.error('Lỗi thanh toán: ' + (error.message || 'Lỗi không xác định'));
    }
  };

  const getPaymentMethodIcon = (method) => {
    switch (method) {
      case PAYMENT_METHODS.CASH:
        return <DollarSign size={18} />;
      case PAYMENT_METHODS.CARD:
        return <CreditCard size={18} />;
      case PAYMENT_METHODS.TRANSFER:
        return <Building2 size={18} />;
      case PAYMENT_METHODS.EWALLET:
        return <Smartphone size={18} />;
      default:
        return <DollarSign size={18} />;
    }
  };

  const quickAmountButtons = [
    orderTotal,
    Math.ceil(orderTotal / 10000) * 10000, // Round up to nearest 10k
    Math.ceil(orderTotal / 20000) * 20000, // Round up to nearest 20k
    Math.ceil(orderTotal / 50000) * 50000  // Round up to nearest 50k
  ].filter((amount, index, arr) => arr.indexOf(amount) === index) // Remove duplicates
   .filter(amount => amount >= orderTotal); // Only amounts >= total

  return (
    <Modal
      title={
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <Receipt size={20} />
          <span>Thanh toán hóa đơn</span>
        </div>
      }
      open={visible}
      onCancel={onCancel}
      footer={[
        <Button key="cancel" onClick={onCancel}>
          Hủy
        </Button>,
        <Button 
          key="confirm" 
          type="primary" 
          loading={loading}
          onClick={handleConfirmPayment}
          icon={<Calculator size={16} />}
        >
          Xác nhận thanh toán
        </Button>
      ]}
      width={600}
      destroyOnClose
    >
      <Form 
        form={form} 
        layout="vertical"
        initialValues={{
          paymentMethod: PAYMENT_METHODS.CASH,
          customerPaid: orderTotal
        }}
      >
        {/* Order Summary */}
        <div style={{ 
          background: '#f8f9fa', 
          padding: 16, 
          borderRadius: 8, 
          marginBottom: 20 
        }}>
          <Row justify="space-between" align="middle">
            <Col>
              <Text strong>Bàn: {invoice?.tenBan || 'N/A'}</Text>
            </Col>
            <Col>
              <Text>Mã HĐ: {invoice?.maHd || 'N/A'}</Text>
            </Col>
          </Row>
          <Divider style={{ margin: '12px 0' }} />
          <Row justify="space-between" align="middle">
            <Col>
              <Title level={4} style={{ margin: 0, color: '#197dd3' }}>
                Tổng tiền:
              </Title>
            </Col>
            <Col>
              <Title level={3} style={{ margin: 0, color: '#197dd3' }}>
                {orderTotal.toLocaleString('vi-VN')} đ
              </Title>
            </Col>
          </Row>
        </div>

        {/* Payment Method Selection */}
        <Form.Item 
          name="paymentMethod" 
          label="Phương thức thanh toán"
          rules={[{ required: true, message: 'Vui lòng chọn phương thức thanh toán' }]}
        >
          <Radio.Group 
            onChange={handlePaymentMethodChange}
            size="large"
            style={{ width: '100%' }}
          >
            <Row gutter={[12, 12]}>
              {Object.values(PAYMENT_METHODS).map(method => (
                <Col span={12} key={method}>
                  <Radio.Button 
                    value={method} 
                    style={{ 
                      width: '100%', 
                      height: 50,
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center'
                    }}
                  >
                    <Space>
                      {getPaymentMethodIcon(method)}
                      {PAYMENT_METHOD_LABELS[method]}
                    </Space>
                  </Radio.Button>
                </Col>
              ))}
            </Row>
          </Radio.Group>
        </Form.Item>

        {/* Customer Payment Amount */}
        <Form.Item 
          name="customerPaid" 
          label="Tiền khách đưa"
          rules={[
            { required: true, message: 'Vui lòng nhập số tiền khách đưa' },
            { type: 'number', min: orderTotal, message: 'Số tiền không đủ để thanh toán' }
          ]}
        >
          <InputNumber
            style={{ width: '100%' }}
            size="large"
            formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
            parser={value => value.replace(/\$\s?|(,*)/g, '')}
            onChange={handleCustomerPaidChange}
            min={0}
            step={1000}
            controls={false}
          />
        </Form.Item>

        {/* Quick Amount Buttons (for cash payments) */}
        {paymentMethod === PAYMENT_METHODS.CASH && quickAmountButtons.length > 1 && (
          <div style={{ marginBottom: 16 }}>
            <Text type="secondary" style={{ fontSize: 12 }}>Số tiền nhanh:</Text>
            <div style={{ marginTop: 8 }}>
              <Space wrap>
                {quickAmountButtons.map(amount => (
                  <Button 
                    key={amount}
                    size="small"
                    onClick={() => {
                      setCustomerPaid(amount);
                      form.setFieldValue('customerPaid', amount);
                    }}
                  >
                    {amount.toLocaleString('vi-VN')}đ
                  </Button>
                ))}
              </Space>
            </div>
          </div>
        )}

        {/* Change Amount Display */}
        {paymentMethod === PAYMENT_METHODS.CASH && changeAmount > 0 && (
          <div style={{
            background: '#f6ffed',
            border: '1px solid #b7eb8f',
            borderRadius: 8,
            padding: 16,
            marginBottom: 16
          }}>
            <Row justify="space-between" align="middle">
              <Col>
                <Text strong>Tiền thối lại:</Text>
              </Col>
              <Col>
                <Tag color="success" style={{ fontSize: 16, padding: '4px 12px' }}>
                  {changeAmount.toLocaleString('vi-VN')} đ
                </Tag>
              </Col>
            </Row>
          </div>
        )}

        {/* Notes */}
        <Form.Item name="notes" label="Ghi chú (tùy chọn)">
          <Input.TextArea 
            placeholder="Ghi chú thêm về thanh toán..."
            rows={2}
            maxLength={200}
          />
        </Form.Item>
      </Form>
    </Modal>
  );
};

export default PaymentModal;