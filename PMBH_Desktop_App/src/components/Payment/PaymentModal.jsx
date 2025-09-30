import React, { useState, useEffect } from 'react';
import { 
  Modal, 
  InputNumber, 
  Typography, 
  Button,
  message,
  Select
} from 'antd';
import { 
  ArrowLeft,
  Printer
} from 'lucide-react';
import { thanhToanHoaDon } from '../../services/apiServices';
import ReceiptPrinter from '../Print/ReceiptPrinter';
import './PaymentModal.css';

const { Text } = Typography;
const { Option } = Select;

const PaymentModal = ({
  visible,
  onCancel,
  onConfirm,
  invoice,
  orderTotal,
  invoiceDetails = [],
  loading = false,
  includeVAT = false
}) => {
  const [paymentMethod, setPaymentMethod] = useState('Cash');
  const [currency, setCurrency] = useState('VND');
  const [customerPaid, setCustomerPaid] = useState(0);
  const [changeAmount, setChangeAmount] = useState(0);
  const [discount, setDiscount] = useState(0);
  const [discountType, setDiscountType] = useState('percent'); // 'amount' or 'percent'
  const [discountAmount, setDiscountAmount] = useState(0);
  const [finalTotal, setFinalTotal] = useState(orderTotal);
  const [paymentLoading, setPaymentLoading] = useState(false);

  // Currency exchange rates
  const exchangeRates = {
    VND: 1,
    USD: 23725, // 1 USD = 23,725 VND
    THB: 5 // 1 THB = 5 VND
  };

  const convertToVND = (amount, fromCurrency) => {
    if (!amount) return 0;
    return amount * (exchangeRates[fromCurrency] || 1);
  };

  const convertFromVND = (amount, toCurrency) => {
    if (!amount) return 0;
    return amount / (exchangeRates[toCurrency] || 1);
  };

  const formatAmount = (amount, displayCurrency) => {
    const normalized = Number.isFinite(amount) ? amount : 0;
    if (displayCurrency === 'VND') {
      return Math.round(normalized).toLocaleString('vi-VN');
    }
    return normalized.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  };

  const formatWithCurrency = (amount, displayCurrency) => {
    const label = displayCurrency === 'VND' ? 'VNĐ' : displayCurrency;
    return `${formatAmount(amount, displayCurrency)} ${label}`;
  };

  // Cash denominations for each currency
  const cashDenominations = {
    VND: [10000, 20000, 50000, 100000, 200000, 500000],
    USD: [1, 5, 10, 20, 50, 100],
    THB: [20, 50, 100, 500, 1000]
  };

  // Reset form when modal opens
  useEffect(() => {
    if (visible) {
      setCustomerPaid(0);
      setChangeAmount(0);
      setDiscount(0);
      setDiscountAmount(0);
      setFinalTotal(orderTotal);
      setPaymentMethod('Cash');
      setCurrency('VND');
    }
  }, [visible, orderTotal]);

  // Calculate discount amount and final total
  useEffect(() => {
    let discountValue = 0;
    if (discountType === 'percent') {
      discountValue = (orderTotal * discount) / 100;
    } else {
      discountValue = discount;
    }
    setDiscountAmount(discountValue);

    // Calculate VAT if included
    const vatAmount = includeVAT ? orderTotal * 0.1 : 0;
    const subtotalWithVAT = orderTotal + vatAmount;
    const total = Math.max(0, subtotalWithVAT - discountValue);
    setFinalTotal(total);

    // Do not auto-update customerPaid, keep user's input
  }, [discount, discountType, orderTotal, includeVAT]);

  // Calculate change amount with currency conversion
  useEffect(() => {
    const paidInVND = convertToVND(customerPaid, currency);
    const remainingInVND = paidInVND - finalTotal;
    const changeInCurrency = remainingInVND > 0 ? convertFromVND(remainingInVND, currency) : 0;
    setChangeAmount(changeInCurrency);
  }, [customerPaid, finalTotal, currency]);

  const handlePaymentMethodChange = (value) => {
    setPaymentMethod(value);
    
    if (value !== 'Cash') {
      const exactAmount = convertFromVND(finalTotal, currency);
      setCustomerPaid(Number.isFinite(exactAmount) ? parseFloat(exactAmount.toFixed(2)) : 0);
    } else {
      setCustomerPaid(0);
    }
  };

  const handleCurrencyChange = (value) => {
    setCurrency(value);
    if (paymentMethod !== 'Cash') {
      const exactAmount = convertFromVND(finalTotal, value);
      setCustomerPaid(Number.isFinite(exactAmount) ? parseFloat(exactAmount.toFixed(2)) : 0);
    } else {
      setCustomerPaid(0);
    }
  };

  const handleCustomerPaidChange = (value) => {
    setCustomerPaid(value || 0);
  };

  const handleDiscountChange = (value) => {
    setDiscount(value || 0);
  };

  const handleNumberClick = (num) => {
    if (num === 'clear') {
      setCustomerPaid(0);
    } else if (num === 'backspace') {
      const currentValue = customerPaid.toString();
      const newValue = currentValue.slice(0, -1);
      const numValue = newValue === '' ? 0 : parseInt(newValue, 10);
      setCustomerPaid(numValue);
    } else {
      const currentValue = customerPaid.toString();
      const newValue = currentValue === '0' ? num.toString() : currentValue + num.toString();
      const numValue = parseInt(newValue, 10);
      setCustomerPaid(numValue);
    }
  };

  const handleQuickAmount = (amount) => {
    setCustomerPaid(amount);
  };

  const handleConfirmPayment = async () => {
    try {
      const customerPaidInVND = convertToVND(customerPaid, currency);
      const shortfallInVND = finalTotal - customerPaidInVND;

      if (shortfallInVND > 0) {
        const shortfallInCurrency = convertFromVND(shortfallInVND, currency);
        message.error(`Chưa đủ tiền! Cần thêm ${shortfallInCurrency.toFixed(2)} ${currency}`);
        return;
      }

      if (!invoice?.maHd) {
        message.error('Không có mã hóa đơn để thanh toán');
        return;
      }

      setPaymentLoading(true);

      // Call the original working payment API
      const result = await thanhToanHoaDon(invoice.maHd);
      
      if (result && (result.success !== false)) {
        message.success('Thanh toán thành công!');
        
        // Tự động in hóa đơn sau khi thanh toán thành công
        setTimeout(() => {
          handlePrintReceipt();
        }, 500);
        
        // Call parent onConfirm with payment data for additional processing
        const paymentData = {
          maHd: invoice?.maHd,
          tongTien: orderTotal,
          discount: discountAmount,
          discountType,
          finalTotal,
          tienKhachDua: customerPaidInVND,
          tienThua: Math.max(0, customerPaidInVND - finalTotal),
          phuongThucThanhToan: paymentMethod,
          currency: currency,
          originalPaidAmount: customerPaid,
          ghiChu: `Thanh toán bằng ${currency}`,
          ngayThanhToan: new Date().toISOString()
        };
        
        await onConfirm(paymentData);
      } else {
        message.error('Thanh toán thất bại: ' + (result?.error || 'Lỗi không xác định'));
      }
    } catch (error) {
      message.error('Lỗi thanh toán: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setPaymentLoading(false);
    }
  };

  const handlePrintReceipt = () => {
    if (!invoice || invoiceDetails.length === 0) {
      message.error('Không có hóa đơn để in');
      return;
    }

    const paidInVND = convertToVND(customerPaid, currency);
    const changeInVND = Math.max(0, paidInVND - finalTotal);
    const subtotalInCurrency = convertFromVND(orderTotal, currency);
    const discountInCurrency = convertFromVND(discountAmount, currency);
    const totalInCurrency = convertFromVND(finalTotal, currency);
    // Create a hidden ReceiptPrinter component and trigger print
    const receiptPrinter = document.createElement('div');
    receiptPrinter.style.display = 'none';
    document.body.appendChild(receiptPrinter);

    // Use ReceiptPrinter logic
    const printReceipt = () => {
      const receiptData = {
        header: {
          storeName: "POS CAFE SYSTEM",
          address: "Địa chỉ cửa hàng",
          phone: "0123-456-789",
          date: new Date().toLocaleDateString('vi-VN'),
          time: new Date().toLocaleTimeString('vi-VN'),
          invoiceNumber: invoice?.maHd || 'N/A',
          tableName: invoice?.tenBan || 'N/A'
        },
        items: invoiceDetails.map(item => ({
          name: item.tenSp || item.tenMon || 'Unknown',
          quantity: item.soLuong || item.sl || 1,
          price: parseFloat(item.gia || item.giaBan || item.donGia || 0),
          total: (item.soLuong || item.sl || 1) * parseFloat(item.gia || item.giaBan || item.donGia || 0)
        })),
        totals: {
          subtotalVND: orderTotal,
          vatVND: includeVAT ? orderTotal * 0.1 : 0,
          discountVND: discountAmount,
          totalVND: finalTotal,
          subtotalCurrency: subtotalInCurrency,
          vatCurrency: includeVAT ? subtotalInCurrency * 0.1 : 0,
          discountCurrency: discountInCurrency,
          totalCurrency: totalInCurrency,
          paidCurrency: customerPaid,
          changeCurrency: changeAmount,
          paidVND: paidInVND,
          changeVND: changeInVND
        },
        payment: {
          method: paymentMethod,
          currency: currency
        }
      };

      const renderAmountLine = (label, valueInVND, valueInCurrency, options = {}) => {
        const { highlight = false } = options;
        const showSecondary = currency !== 'VND';
        return `
          <div class="amount-line${highlight ? ' highlight' : ''}">
            <span class="label">${label}</span>
            <div class="value">
              <span class="primary">${formatWithCurrency(valueInVND, 'VND')}</span>
              ${showSecondary ? `<span class="secondary">≈ ${formatWithCurrency(valueInCurrency, currency)}</span>` : ''}
            </div>
          </div>
        `;
      };

      const printContent = `
        <div class="receipt-root">
          <div class="receipt-header">
            <h2>${receiptData.header.storeName}</h2>
            <p>${receiptData.header.address}</p>
            <p>${receiptData.header.phone}</p>
            <p>${receiptData.header.date} ${receiptData.header.time}</p>
          </div>
          
          <div class="invoice-meta">
            <p><strong>Hóa đơn:</strong> ${receiptData.header.invoiceNumber}</p>
            <p><strong>Bàn:</strong> ${receiptData.header.tableName}</p>
          </div>
          
          <table class="items-table">
            <thead>
              <tr>
                <th class="item-name">Món</th>
                <th>SL x Giá</th>
                <th class="total">Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              ${receiptData.items.map(item => `
                <tr>
                  <td class="item-name">${item.name}</td>
                  <td class="qty">${item.quantity} x ${formatAmount(item.price, 'VND')} VNĐ</td>
                  <td class="total">${formatAmount(item.total, 'VND')} VNĐ</td>
                </tr>
              `).join('')}
            </tbody>
          </table>
          
          <div class="totals-section">
            ${renderAmountLine('Tạm tính', receiptData.totals.subtotalVND, receiptData.totals.subtotalCurrency)}
            ${receiptData.totals.vatVND > 0 ? renderAmountLine('Thuế VAT (10%)', receiptData.totals.vatVND, receiptData.totals.vatCurrency) : ''}
            ${receiptData.totals.discountVND > 0 ? renderAmountLine('Giảm giá', -receiptData.totals.discountVND, -receiptData.totals.discountCurrency) : ''}
            ${renderAmountLine('Tổng cộng', receiptData.totals.totalVND, receiptData.totals.totalCurrency, { highlight: true })}
            ${paymentMethod === 'Cash' ? renderAmountLine('Tiền khách đưa', receiptData.totals.paidVND, receiptData.totals.paidCurrency) : ''}
            ${paymentMethod === 'Cash' ? renderAmountLine('Tiền thừa', receiptData.totals.changeVND, receiptData.totals.changeCurrency) : ''}
            <div class="amount-line">
              <span class="label">Phương thức:</span>
              <div class="value">
                <span class="primary">${receiptData.payment.method}</span>
              </div>
            </div>
            ${currency !== 'VND' ? `
              <div class="amount-line">
                <span class="label">Tỷ giá:</span>
                <div class="value">
                  <span class="primary">1 ${currency} = ${exchangeRates[currency].toLocaleString('vi-VN')} VND</span>
                </div>
              </div>
            ` : ''}
          </div>
          
          <div class="receipt-footer">
            <p>Cảm ơn quý khách!</p>
            <p>Hẹn gặp lại!</p>
          </div>
        </div>
      `;

      const printWindow = window.open('', '_blank', 'width=400,height=600');
      printWindow.document.write(`
        <html>
          <head>
            <title>Hóa đơn thanh toán</title>
            <style>
              body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
              .receipt-root { width: 300px; font-family: monospace; font-size: 12px; line-height: 1.4; }
              .receipt-header { text-align: center; margin-bottom: 20px; }
              .receipt-header h2 { margin: 0; font-size: 16px; }
              .receipt-header p { margin: 2px 0; }
              .invoice-meta { border-top: 1px dashed #000; padding-top: 10px; margin-bottom: 10px; }
              .invoice-meta p { margin: 2px 0; }
              .items-table { width: 100%; border-top: 1px dashed #000; margin-top: 10px; padding-top: 10px; border-collapse: collapse; }
              .items-table th, .items-table td { padding: 4px 0; font-family: monospace; font-size: 12px; }
              .items-table th { text-align: left; border-bottom: 1px dashed #000; }
              .items-table th.total, .items-table td.total { text-align: right; }
              .items-table td.item-name { text-align: left; }
              .items-table td.qty { text-align: right; color: #555; font-size: 11px; }
              .totals-section { border-top: 1px dashed #000; padding-top: 10px; margin-top: 10px; }
              .amount-line { display: flex; justify-content: space-between; margin: 4px 0; }
              .amount-line .value { display: flex; flex-direction: column; align-items: flex-end; text-align: right; }
              .amount-line .primary { font-weight: 500; }
              .amount-line.highlight .primary { font-weight: 700; }
              .amount-line .secondary { font-size: 11px; color: #555; }
              .receipt-footer { text-align: center; margin-top: 20px; border-top: 1px dashed #000; padding-top: 10px; }
              .no-print { display: block; }
              @media print {
                .no-print { display: none; }
                body { margin: 0; }
              }
            </style>
          </head>
          <body>
            ${printContent}
            <div class="no-print" style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px dashed #000;">
              <button onclick="window.print()" style="padding: 10px 20px; background: #197dd3; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px;">In hóa đơn</button>
              <button onclick="window.close()" style="padding: 10px 20px; background: #ccc; color: black; border: none; border-radius: 4px; cursor: pointer; margin: 5px;">Đóng</button>
            </div>
          </body>
        </html>
      `);
      printWindow.document.close();
    };

    printReceipt();
    document.body.removeChild(receiptPrinter);
    message.success('Đã gửi hóa đơn đến máy in');
  };

  const customerPaidInVND = convertToVND(customerPaid, currency);
  const finalTotalInCurrency = convertFromVND(finalTotal, currency);
  const changeInVND = Math.max(0, customerPaidInVND - finalTotal);
  const enoughPayment = customerPaidInVND >= finalTotal;
  const currencyLabel = currency === 'VND' ? 'VNĐ' : currency;

  return (
    <Modal
      open={visible}
      onCancel={onCancel}
      footer={null}
      width={1200}
      height={700}
      destroyOnClose
      className="payment-modal"
      styles={{
        body: { padding: 0, height: '700px' }
      }}
    >
      <div className="payment-container">
        {/* Header */}
        <div className="payment-header">
          <Button 
            icon={<ArrowLeft size={18} />} 
            onClick={onCancel}
            className="back-button"
          />
          <Text className="payment-title">Thanh toán</Text>
          <div className="header-spacer"></div>
        </div>

        <div className="payment-content">
          {/* Left Panel - 3 Columns Layout */}
          <div className="payment-left">
            {/* Column 1: Payment Methods */}
            <div className="payment-column">
              <Text className="column-title">Phương thức thanh toán</Text>
              <div className="method-list">
                {['Cash', 'Bank Transfer', 'GrabPay', 'ZaloPay', 'VNPAY', 'OnAccount', 'Others', 'Credit'].map(method => (
                  <Button 
                    key={method}
                    className={paymentMethod === method ? 'method-item active' : 'method-item'}
                    onClick={() => handlePaymentMethodChange(method)}
                  >
                    {method}
                  </Button>
                ))}
              </div>
            </div>

            {/* Column 2: Currency */}
            <div className="payment-column">
              <Text className="column-title">Đơn vị tiền tệ</Text>
              <div className="currency-list">
                {['VND', 'USD', 'THB'].map(curr => (
                  <Button 
                    key={curr}
                    className={currency === curr ? 'currency-item active' : 'currency-item'}
                    onClick={() => handleCurrencyChange(curr)}
                  >
                    {curr}
                  </Button>
                ))}
              </div>
              
              {/* Exchange Rates */}
              <div className="exchange-rates">
                <div className="rate-item">
                  <span>USD</span>
                  <span>1 USD = {exchangeRates.USD.toLocaleString('vi-VN')} VND</span>
                </div>
                <div className="rate-item">
                  <span>THB</span>
                  <span>1 THB = {exchangeRates.THB.toLocaleString('vi-VN')} VND</span>
                </div>
              </div>
            </div>

            {/* Column 3: Quick Amounts & Number Pad */}
            <div className="payment-column">
              <Text className="column-title">Mệnh giá {currency}</Text>
              
              {/* Quick Amount Buttons */}
              <div className="quick-amounts">
                {cashDenominations[currency].map(amount => (
                  <Button 
                    key={amount}
                    className="quick-amount-btn"
                    onClick={() => handleQuickAmount(amount)}
                  >
                    {currency === 'VND' ? amount.toLocaleString() : amount}
                  </Button>
                ))}
              </div>

              {/* Number Pad */}
              <div className="number-pad">
                <div className="number-grid">
                  {[7, 8, 9, 4, 5, 6, 1, 2, 3].map(num => (
                    <Button 
                      key={num}
                      className="number-btn"
                      onClick={() => handleNumberClick(num)}
                    >
                      {num}
                    </Button>
                  ))}
                  <Button 
                    className="number-btn zero"
                    onClick={() => handleNumberClick(0)}
                  >
                    0
                  </Button>
                  <Button 
                    className="clear-btn"
                    onClick={() => handleNumberClick('clear')}
                  >
                    XÓA
                  </Button>
                </div>
              </div>
            </div>
          </div>

          {/* Right Panel */}
          <div className="payment-right">
            {/* Amount Display */}
            <div className="amount-display">
              <Text className="current-amount">{formatAmount(customerPaid, currency)}</Text>
              <Text className="currency-label">{currencyLabel}</Text>
            </div>

            {/* Discount Section */}
            <div className="discount-section">
              <Text className="section-label">Chiết khấu</Text>
              <div className="discount-controls">
                <Select 
                  value={discountType}
                  onChange={setDiscountType}
                  className="discount-type"
                  style={{ width: 80 }}
                >
                  <Option value="percent">%</Option>
                  <Option value="amount">Tiền</Option>
                </Select>
                <InputNumber
                  value={discount}
                  onChange={handleDiscountChange}
                  min={0}
                  max={discountType === 'percent' ? 100 : orderTotal}
                  className="discount-input"
                  style={{ flex: 1 }}
                />
              </div>
            </div>

            {/* Payment Summary */}
            <div className="payment-summary">
              <div className="summary-line">
                <span>Tổng hóa đơn:</span>
                <span>{orderTotal.toLocaleString()} VND</span>
              </div>
              <div className="summary-line">
                <span>Giảm giá:</span>
                <span>{discountAmount.toLocaleString()} VND</span>
              </div>
              <div className="summary-line">
                <span>Bar/code:</span>
                <span>{invoiceDetails.length}</span>
              </div>
              <div className="summary-line total">
                <span>Còn lại:</span>
                <span>{finalTotal.toLocaleString()} VND</span>
              </div>
              {paymentMethod === 'Cash' && (
                <>
                  <div className="summary-line">
                    <span>Tiền khách đưa:</span>
                    <span>
                      {formatWithCurrency(customerPaid, currency)}
                      {currency !== 'VND' && (
                        <span className="amount-hint">≈ {formatWithCurrency(customerPaidInVND, 'VND')}</span>
                      )}
                    </span>
                  </div>
                  <div className="summary-line">
                    <span>Số tiền trả:</span>
                    <span>
                      {formatWithCurrency(changeAmount, currency)}
                      {currency !== 'VND' && (
                        <span className="amount-hint">≈ {formatWithCurrency(changeInVND, 'VND')}</span>
                      )}
                    </span>
                  </div>
                  {!enoughPayment && (
                    <div className="summary-line">
                      <span></span>
                      <span style={{ color: '#ff4d4f' }}>Chưa đủ tiền</span>
                    </div>
                  )}
                  {currency !== 'VND' && (
                    <div className="summary-line">
                      <span>Tỷ giá:</span>
                      <span>1 {currency} = {exchangeRates[currency].toLocaleString('vi-VN')} VND</span>
                    </div>
                  )}
                  {currency !== 'VND' && (
                    <div className="summary-line">
                      <span>Tổng cần thanh toán:</span>
                      <span>{formatWithCurrency(finalTotalInCurrency, currency)}</span>
                    </div>
                  )}
                </>
              )}
            </div>
          </div>
        </div>
        
        {/* Footer với nút thanh toán chính */}
        <div className="payment-footer">
          <div className="footer-left">
          </div>
          <div className="footer-center">
            <Button 
              icon={<Printer size={16} />}
              onClick={handlePrintReceipt}
              className="print-receipt-btn"
              size="large"
            >
              In hóa đơn
            </Button>
          </div>
          <div className="footer-right">
            <Button 
              className="main-payment-btn"
              onClick={handleConfirmPayment}
              loading={paymentLoading}
              size="large"
              type="primary"
              disabled={!enoughPayment}
            >
              <span>THANH TOÁN</span>
              <span className="payment-amount">{finalTotal.toLocaleString()} VND</span>
            </Button>
          </div>
        </div>
      </div>
    </Modal>
  );
};

export default PaymentModal;