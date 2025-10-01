import React, { useState, useEffect } from 'react';
import { 
  Modal, 
  InputNumber, 
  Typography, 
  Button,
  message,
  Select,
  List,
  Divider,
  Tag
} from 'antd';
import { 
  ArrowLeft,
  Plus,
  Trash2,
  CheckCircle,
  AlertCircle
} from 'lucide-react';
import './MixedPaymentModal.css';

const { Text, Title } = Typography;
const { Option } = Select;

const MixedPaymentModal = ({
  visible,
  onCancel,
  onConfirm,
  invoice,
  finalTotal,
  orderTotal,
  discountAmount = 0,
  invoiceDetails = []
}) => {
  const [payments, setPayments] = useState([]);
  const [currentMethod, setCurrentMethod] = useState('Cash');
  const [currentAmount, setCurrentAmount] = useState(0);
  const [currency, setCurrency] = useState('VND');
  const [remainingAmount, setRemainingAmount] = useState(finalTotal);
  const [isCompleting, setIsCompleting] = useState(false);

  // Currency exchange rates
  const exchangeRates = {
    VND: 1,
    USD: 23725,
    THB: 5
  };

  const paymentMethods = [
    { key: 'Cash', label: 'Tiền mặt' },
    { key: 'Bank Transfer', label: 'Chuyển khoản' },
    { key: 'GrabPay', label: 'GrabPay' },
    { key: 'ZaloPay', label: 'ZaloPay' },
    { key: 'VNPAY', label: 'VNPAY' },
    { key: 'Others', label: 'Khác' }
  ];

  const convertToVND = (amount, fromCurrency) => {
    if (!amount) return 0;
    return amount * (exchangeRates[fromCurrency] || 1);
  };

  const formatAmount = (amount, displayCurrency = 'VND') => {
    const normalized = Number.isFinite(amount) ? amount : 0;
    if (displayCurrency === 'VND') {
      return Math.round(normalized).toLocaleString('vi-VN');
    }
    return normalized.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  };

  const formatWithCurrency = (amount, displayCurrency = 'VND') => {
    const label = displayCurrency === 'VND' ? 'VNĐ' : displayCurrency;
    return `${formatAmount(amount, displayCurrency)} ${label}`;
  };

  // Reset when modal opens
  useEffect(() => {
    if (visible) {
      setPayments([]);
      setCurrentMethod('Cash');
      setCurrentAmount(0);
      setCurrency('VND');
      setRemainingAmount(finalTotal);
    }
  }, [visible, finalTotal]);

  // Update remaining amount when payments change
  useEffect(() => {
    const totalPaid = payments.reduce((sum, p) => sum + p.amountVND, 0);
    setRemainingAmount(Math.max(0, finalTotal - totalPaid));
  }, [payments, finalTotal]);

  const handleAddPayment = () => {
    if (currentAmount <= 0) {
      message.warning('Vui lòng nhập số tiền thanh toán');
      return;
    }

    const amountVND = convertToVND(currentAmount, currency);
    
    if (amountVND > remainingAmount) {
      message.warning('Số tiền vượt quá số còn lại phải thanh toán');
      return;
    }

    const newPayment = {
      id: Date.now(),
      method: currentMethod,
      methodLabel: paymentMethods.find(m => m.key === currentMethod)?.label || currentMethod,
      amount: currentAmount,
      currency: currency,
      amountVND: amountVND,
      timestamp: new Date().toISOString()
    };

    setPayments([...payments, newPayment]);
    setCurrentAmount(0);
    message.success('Đã thêm phương thức thanh toán');
  };

  const handleRemovePayment = (paymentId) => {
    setPayments(payments.filter(p => p.id !== paymentId));
    message.info('Đã xóa phương thức thanh toán');
  };

  const handleMethodChange = (value) => {
    setCurrentMethod(value);
  };

  const handleCurrencyChange = (value) => {
    setCurrency(value);
    setCurrentAmount(0);
  };

  const handleAmountChange = (value) => {
    setCurrentAmount(value || 0);
  };

  const handleQuickFillRemaining = () => {
    const remaining = remainingAmount;
    const amountInCurrency = remaining / (exchangeRates[currency] || 1);
    setCurrentAmount(parseFloat(amountInCurrency.toFixed(2)));
  };

  const handleCompleteMixedPayment = async () => {
    if (remainingAmount > 0) {
      message.warning(`Vẫn còn thiếu ${formatWithCurrency(remainingAmount, 'VND')} chưa thanh toán`);
      return;
    }

    if (payments.length < 2) {
      message.warning('Thanh toán hỗn hợp cần ít nhất 2 phương thức thanh toán');
      return;
    }

    try {
      setIsCompleting(true);

      // Tạo chuỗi mô tả các phương thức thanh toán
      const paymentMethodsDescription = payments.map(p => 
        `${p.methodLabel} (${formatWithCurrency(p.amount, p.currency)})`
      ).join(' + ');

      const paymentData = {
        maHd: invoice?.maHd,
        tongTien: orderTotal,
        discount: discountAmount,
        finalTotal: finalTotal,
        tienKhachDua: finalTotal, // Tổng đã thanh toán đủ
        tienThua: 0,
        phuongThucThanhToan: `Hỗn hợp: ${paymentMethodsDescription}`,
        ghiChu: `Thanh toán hỗn hợp: ${payments.length} phương thức`,
        ngayThanhToan: new Date().toISOString(),
        mixedPayments: payments.map(p => ({
          method: p.method,
          methodLabel: p.methodLabel,
          amount: p.amount,
          currency: p.currency,
          amountVND: p.amountVND,
          timestamp: p.timestamp
        }))
      };

      await onConfirm(paymentData);
      message.success('Thanh toán hỗn hợp thành công!');
    } catch (error) {
      message.error('Lỗi thanh toán: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setIsCompleting(false);
    }
  };

  const handleModalClose = () => {
    // Kiểm tra nếu đã có thanh toán một phần nhưng chưa hoàn thành
    if (payments.length > 0 && remainingAmount > 0) {
      Modal.warning({
        title: 'Thanh toán chưa hoàn tất',
        content: (
          <div>
            <p>Bạn đã thanh toán: <strong>{formatWithCurrency(totalPaidVND, 'VND')}</strong></p>
            <p>Còn thiếu: <strong style={{ color: '#ff4d4f' }}>{formatWithCurrency(remainingAmount, 'VND')}</strong></p>
            <p style={{ marginTop: 12 }}>Vui lòng hoàn thành thanh toán hoặc hủy các giao dịch đã thêm.</p>
          </div>
        ),
        okText: 'Đã hiểu',
        centered: true
      });
      return;
    }
    onCancel();
  };

  const totalPaidVND = payments.reduce((sum, p) => sum + p.amountVND, 0);
  const isComplete = remainingAmount === 0 && payments.length >= 2;
  const currencyLabel = currency === 'VND' ? 'VNĐ' : currency;

  return (
    <Modal
      open={visible}
      onCancel={handleModalClose}
      footer={null}
      width={900}
      destroyOnClose
      className="mixed-payment-modal"
    >
      <div className="mixed-payment-container">
        {/* Header */}
        <div className="mixed-payment-header">
          <Button 
            icon={<ArrowLeft size={18} />} 
            onClick={handleModalClose}
            className="back-button"
          />
          <Text className="mixed-payment-title">Thanh toán hỗn hợp</Text>
          <div className="header-spacer"></div>
        </div>

        <div className="mixed-payment-content">
          {/* Left Panel - Payment Info */}
          <div className="mixed-payment-left">
            <div className="payment-summary-box">
              <Title level={4}>Thông tin hóa đơn</Title>
              <div className="summary-item">
                <span>Mã hóa đơn:</span>
                <span className="value">{invoice?.maHd || 'N/A'}</span>
              </div>
              <div className="summary-item">
                <span>Tổng hóa đơn:</span>
                <span className="value">{formatWithCurrency(orderTotal, 'VND')}</span>
              </div>
              {discountAmount > 0 && (
                <div className="summary-item">
                  <span>Giảm giá:</span>
                  <span className="value discount">-{formatWithCurrency(discountAmount, 'VND')}</span>
                </div>
              )}
              <Divider style={{ margin: '12px 0' }} />
              <div className="summary-item total">
                <span>Cần thanh toán:</span>
                <span className="value">{formatWithCurrency(finalTotal, 'VND')}</span>
              </div>
              <div className="summary-item paid">
                <span>Đã thanh toán:</span>
                <span className="value">{formatWithCurrency(totalPaidVND, 'VND')}</span>
              </div>
              <div className="summary-item remaining">
                <span>Còn lại:</span>
                <span className="value">{formatWithCurrency(remainingAmount, 'VND')}</span>
              </div>
            </div>

            {/* Payment Methods List */}
            <div className="payments-list-box">
              <Title level={5}>Danh sách thanh toán ({payments.length})</Title>
              {payments.length === 0 ? (
                <div className="empty-payments">
                  <AlertCircle size={32} color="#bdbcc4" />
                  <Text type="secondary">Chưa có phương thức thanh toán nào</Text>
                </div>
              ) : (
                <List
                  dataSource={payments}
                  renderItem={(payment, index) => (
                    <List.Item
                      key={payment.id}
                      className="payment-item"
                      actions={[
                        <Button
                          icon={<Trash2 size={16} />}
                          type="text"
                          danger
                          onClick={() => handleRemovePayment(payment.id)}
                        />
                      ]}
                    >
                      <List.Item.Meta
                        avatar={
                          <div className="payment-number">{index + 1}</div>
                        }
                        title={
                          <div className="payment-item-title">
                            <span>{payment.methodLabel}</span>
                            <Tag color="blue">{payment.currency}</Tag>
                          </div>
                        }
                        description={
                          <div className="payment-item-desc">
                            <span className="amount-original">
                              {formatWithCurrency(payment.amount, payment.currency)}
                            </span>
                            {payment.currency !== 'VND' && (
                              <span className="amount-vnd">
                                ≈ {formatWithCurrency(payment.amountVND, 'VND')}
                              </span>
                            )}
                          </div>
                        }
                      />
                    </List.Item>
                  )}
                />
              )}
            </div>
          </div>

          {/* Right Panel - Add Payment */}
          <div className="mixed-payment-right">
            <div className="add-payment-box">
              <Title level={4}>Thêm phương thức thanh toán</Title>
              
              {/* Payment Method Selection */}
              <div className="form-group">
                <Text className="form-label">Phương thức</Text>
                <Select
                  value={currentMethod}
                  onChange={handleMethodChange}
                  className="form-select"
                  size="large"
                >
                  {paymentMethods.map(method => (
                    <Option key={method.key} value={method.key}>
                      {method.label}
                    </Option>
                  ))}
                </Select>
              </div>

              {/* Currency Selection */}
              <div className="form-group">
                <Text className="form-label">Đơn vị tiền tệ</Text>
                <div className="currency-buttons">
                  {['VND', 'USD', 'THB'].map(curr => (
                    <Button
                      key={curr}
                      className={currency === curr ? 'currency-btn active' : 'currency-btn'}
                      onClick={() => handleCurrencyChange(curr)}
                      size="large"
                    >
                      {curr}
                    </Button>
                  ))}
                </div>
              </div>

              {/* Amount Input */}
              <div className="form-group">
                <div className="form-label-row">
                  <Text className="form-label">Số tiền</Text>
                  {remainingAmount > 0 && (
                    <Button
                      type="link"
                      size="small"
                      onClick={handleQuickFillRemaining}
                      className="quick-fill-btn"
                    >
                      Điền số còn lại
                    </Button>
                  )}
                </div>
                <InputNumber
                  value={currentAmount}
                  onChange={handleAmountChange}
                  min={0}
                  max={remainingAmount / (exchangeRates[currency] || 1)}
                  className="amount-input"
                  size="large"
                  placeholder={`Nhập số tiền (${currencyLabel})`}
                  style={{ width: '100%' }}
                  formatter={value => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                  parser={value => value.replace(/\$\s?|(,*)/g, '')}
                />
                {currentAmount > 0 && currency !== 'VND' && (
                  <Text type="secondary" className="conversion-hint">
                    ≈ {formatWithCurrency(convertToVND(currentAmount, currency), 'VND')}
                  </Text>
                )}
              </div>

              {/* Add Payment Button */}
              <Button
                icon={<Plus size={18} />}
                onClick={handleAddPayment}
                className="add-payment-btn"
                size="large"
                disabled={currentAmount <= 0 || remainingAmount <= 0}
                block
              >
                Thêm phương thức
              </Button>

              {/* Exchange Rates Info */}
              <div className="exchange-info">
                <Text type="secondary" style={{ fontSize: '12px' }}>Tỷ giá quy đổi:</Text>
                <div className="rate-row">
                  <span>1 USD</span>
                  <span>= {exchangeRates.USD.toLocaleString('vi-VN')} VNĐ</span>
                </div>
                <div className="rate-row">
                  <span>1 THB</span>
                  <span>= {exchangeRates.THB.toLocaleString('vi-VN')} VNĐ</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Footer */}
        <div className="mixed-payment-footer">
          <div className="footer-info">
            {remainingAmount > 0 ? (
              <div className="warning-status">
                <AlertCircle size={20} />
                <span>Còn thiếu: {formatWithCurrency(remainingAmount, 'VND')}</span>
              </div>
            ) : payments.length >= 2 ? (
              <div className="success-status">
                <CheckCircle size={20} />
                <span>Đủ số tiền thanh toán</span>
              </div>
            ) : (
              <div className="info-status">
                <span>Cần ít nhất 2 phương thức thanh toán</span>
              </div>
            )}
          </div>
          <Button
            onClick={handleCompleteMixedPayment}
            loading={isCompleting}
            disabled={!isComplete}
            className="complete-payment-btn"
            size="large"
            type="primary"
          >
            <span>HOÀN TẤT THANH TOÁN</span>
            <span className="btn-amount">{formatWithCurrency(finalTotal, 'VND')}</span>
          </Button>
        </div>
      </div>
    </Modal>
  );
};

export default MixedPaymentModal;
