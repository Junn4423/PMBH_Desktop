﻿import React, { useState, useEffect, useRef, useCallback } from 'react';
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
  Printer,
  Split,
  Plus,
  CheckCircle
} from 'lucide-react';
import { thanhToanHoaDon } from '../../services/apiServices';
import { createVNPayPaymentUrl } from '../../services/vnpayService';
import {
  createMoMoPayment,
  verifyMoMoReturnSignature,
  normalizeMoMoResultCode,
  getMoMoResultMessage,
  logMoMoTransaction,
} from '../../services/momoService';
import {
  createZaloPayPayment,
  queryZaloPayOrder,
  logZaloPayTransaction,
} from '../../services/zaloPayService';
import vnpayConfig from '../../config/vnpayConfig';
import momoConfig from '../../config/momoConfig';
import zalopayConfig from '../../config/zalopayConfig';
import ReceiptPrinter from '../Print/ReceiptPrinter';
import receiptLogoManager from '../../utils/receiptLogoManager';
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
  includeVAT = false,
  onPaymentSuccessClose
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
  const [isMixedPaymentMode, setIsMixedPaymentMode] = useState(false);
  const [mixedPayments, setMixedPayments] = useState([]);
  const [partialPaidAmount, setPartialPaidAmount] = useState(0);
  const [pendingVNPayTxn, setPendingVNPayTxn] = useState(null);
  const [pendingMoMoTxn, setPendingMoMoTxn] = useState(null);
  const [pendingZaloPayTxn, setPendingZaloPayTxn] = useState(null);
  const [mixedGatewayPendingPayment, setMixedGatewayPendingPayment] = useState(null);
  const zalopayPopupRef = useRef(null);
  const zalopayPollRef = useRef(null);
  const [showPaymentSuccessModal, setShowPaymentSuccessModal] = useState(false);

  const cleanupZaloPayPayment = useCallback(() => {
    try {
      if (zalopayPollRef.current) {
        clearInterval(zalopayPollRef.current);
        zalopayPollRef.current = null;
      }
    } catch (error) {
      console.error('Failed to clear ZaloPay polling interval:', error);
    }

    if (typeof window !== 'undefined') {
      try {
        if (window.electronAPI?.closeZaloPayPaymentWindow) {
          window.electronAPI.closeZaloPayPaymentWindow({ force: true });
        }
      } catch (error) {
        console.error('Failed to close ZaloPay electron window:', error);
      }
    }

    try {
      const popupWindow = zalopayPopupRef.current;
      if (popupWindow && !popupWindow.closed) {
        let closed = false;
        try {
          if (typeof popupWindow.close === 'function') {
            popupWindow.close();
            closed = popupWindow.closed;
          }
        } catch (error) {
          console.error('Failed to close ZaloPay popup window directly:', error);
        }

        if (!closed) {
          try {
            popupWindow.location.href = 'data:text/html,<html><body><script>window.close();</script></body></html>';
          } catch (error) {
            console.error('Failed to trigger ZaloPay popup self-close:', error);
          }

          setTimeout(() => {
            try {
              if (popupWindow && !popupWindow.closed) {
                popupWindow.close();
              }
            } catch (error) {
              console.error('Failed to close ZaloPay popup after redirect:', error);
            }
          }, 300);
        }
      }
    } catch (error) {
      console.error('Failed to close ZaloPay popup window:', error);
    } finally {
      zalopayPopupRef.current = null;
    }
  }, []);

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

  const GATEWAY_METHODS = ['MoMo', 'ZaloPay', 'VNPAY'];

  const isGatewayMethod = (method) => GATEWAY_METHODS.includes(method);

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
      setPendingVNPayTxn(null);
      setPendingMoMoTxn(null);
      setPendingZaloPayTxn(null);
      setMixedGatewayPendingPayment(null);
      setShowPaymentSuccessModal(false);
      
      // Load partial payment from localStorage
      if (invoice?.maHd) {
        const savedPayment = localStorage.getItem(`partial_payment_${invoice.maHd}`);
        if (savedPayment) {
          try {
            const data = JSON.parse(savedPayment);
            setMixedPayments(data.payments || []);
            setPartialPaidAmount(data.totalPaid || 0);
            setIsMixedPaymentMode(true);
            message.info(`Phát hiện thanh toán chưa hoàn tất. Đã thanh toán: ${data.totalPaid.toLocaleString()} VNĐ`);
          } catch (e) {
            console.error('Error loading partial payment:', e);
          }
        }
      }
    } else {
      if (window.electronAPI?.closeVNPayPaymentWindow) {
        window.electronAPI.closeVNPayPaymentWindow();
      }
      if (window.electronAPI?.closeMoMoPaymentWindow) {
        window.electronAPI.closeMoMoPaymentWindow();
      }
      cleanupZaloPayPayment();
      setPendingVNPayTxn(null);
      setPendingMoMoTxn(null);
      setPendingZaloPayTxn(null);
      setMixedGatewayPendingPayment(null);
    }
  }, [visible, orderTotal, invoice?.maHd, cleanupZaloPayPayment]);

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
  }, [customerPaid, finalTotal, currency, convertToVND, convertFromVND]);

  const handlePaymentMethodChange = (value) => {
    if (paymentMethod === 'VNPAY' && value !== 'VNPAY' && window.electronAPI?.closeVNPayPaymentWindow) {
      window.electronAPI.closeVNPayPaymentWindow();
    }
    if (paymentMethod === 'MoMo' && value !== 'MoMo' && window.electronAPI?.closeMoMoPaymentWindow) {
      window.electronAPI.closeMoMoPaymentWindow();
    }
    if (paymentMethod === 'ZaloPay' && value !== 'ZaloPay') {
      cleanupZaloPayPayment();
    }
    setPaymentMethod(value);
    setPendingVNPayTxn(null);
    setPendingMoMoTxn(null);
    setPendingZaloPayTxn(null);

    if (value === 'VNPAY') {
      setCurrency('VND');
      setCustomerPaid(finalTotal);
      return;
    }

    if (value === 'MoMo') {
      setCurrency('VND');
      setCustomerPaid(finalTotal);
      return;
    }

    if (value === 'ZaloPay') {
      setCurrency('VND');
      setCustomerPaid(finalTotal);
      return;
    }

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
    if (paymentMethod === 'VNPAY') {
      await initiateVNPayPayment();
      return;
    }
    if (paymentMethod === 'MoMo') {
      await initiateMoMoPayment();
      return;
    }
    if (paymentMethod === 'ZaloPay') {
      await initiateZaloPayPayment();
      return;
    }

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
        // Tự động in hóa đơn sau khi thanh toán thành công
        setTimeout(() => {
          handlePrintReceipt();
        }, 500);
        
        // Hiển thị modal payment success
        setShowPaymentSuccessModal(true);
        
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

  const handleToggleMixedPayment = () => {
    setIsMixedPaymentMode(!isMixedPaymentMode);
    setCustomerPaid(0);
    if (!isMixedPaymentMode) {
      message.info('Chế độ thanh toán hỗn hợp đã bật');
    } else {
      message.info('Chế độ thanh toán thường đã bật');
    }
  };

  const persistMixedPaymentState = (payments, totalPaid) => {
    if (!invoice?.maHd) {
      return;
    }

    localStorage.setItem(
      `partial_payment_${invoice.maHd}`,
      JSON.stringify({
        payments,
        totalPaid,
        finalTotal,
        timestamp: new Date().toISOString()
      })
    );
  };

  const clearMixedPaymentState = () => {
    if (!invoice?.maHd) {
      return;
    }
    localStorage.removeItem(`partial_payment_${invoice.maHd}`);
  };

  const addMixedPaymentEntry = (entry, { successMessage, notify = true } = {}) => {
    const normalizedEntry = {
      ...entry,
      status: entry.status || 'SUCCESS',
      timestamp: entry.timestamp || new Date().toISOString()
    };

    const updatedPayments = [...mixedPayments, normalizedEntry];
    const newTotalPaid = partialPaidAmount + normalizedEntry.amountVND;

    setMixedPayments(updatedPayments);
    setPartialPaidAmount(newTotalPaid);
    setCustomerPaid(0);

    persistMixedPaymentState(updatedPayments, newTotalPaid);

    if (notify) {
      const remainingAfter = Math.max(0, finalTotal - newTotalPaid);
      const messageContent =
        successMessage ||
        `Đã thêm ${formatWithCurrency(normalizedEntry.amountVND, 'VND')}. Còn lại: ${formatWithCurrency(
          remainingAfter,
          'VND'
        )}`;
      message.success(messageContent);
      if (remainingAfter === 0) {
        message.success('Đã thanh toán đủ! Nhấn "HOÀN TẤT" để hoàn thành');
      }
    }
  };


  const completeMixedGatewayPayment = (entry, { provider, transactionData, successMessage } = {}) => {
    if (!entry) {
      return;
    }

    const enrichedEntry = {
      ...entry,
      status: 'SUCCESS',
      gatewayDetails: {
        ...(entry.gatewayDetails || {}),
        provider,
        transactionData,
      },
      transactionData,
    };

    addMixedPaymentEntry(enrichedEntry, { successMessage });
    setMixedGatewayPendingPayment(null);
  };

  const resetMixedPaymentSession = (showNotification = true) => {
    clearMixedPaymentState();
    setMixedPayments([]);
    setPartialPaidAmount(0);
    setCustomerPaid(0);
    setMixedGatewayPendingPayment(null);
    setPendingVNPayTxn(null);
    setPendingMoMoTxn(null);
    setPendingZaloPayTxn(null);
    cleanupZaloPayPayment();
    if (showNotification) {
      message.info('Đã hủy dữ liệu thanh toán hỗn hợp. Vui lòng thực hiện lại.');
    }
  };

  const handleAddPartialPayment = async () => {
    if (customerPaid <= 0) {
      message.warning('Vui lòng nhập số tiền thanh toán');
      return;
    }

    const amountVND = Math.round(convertToVND(customerPaid, currency));
    if (amountVND <= 0) {
      message.warning('Số tiền không hợp lệ để thanh toán');
      return;
    }
    const remainingBeforeAddition = finalTotal - partialPaidAmount;

    if (amountVND > remainingBeforeAddition) {
      message.warning('Số tiền vượt quá số còn lại phải thanh toán');
      return;
    }

    if (isGatewayMethod(paymentMethod)) {
      if (pendingVNPayTxn || pendingMoMoTxn || pendingZaloPayTxn || mixedGatewayPendingPayment) {
        message.warning('Đang có giao dịch trực tuyến đang xử lý. Vui lòng hoàn tất trước khi tạo giao dịch mới.');
        return;
      }

      const gatewayEntry = {
        id: Date.now(),
        method: paymentMethod,
        methodLabel: paymentMethod,
        amount: customerPaid,
        currency,
        amountVND,
        status: 'PENDING',
        timestamp: new Date().toISOString()
      };

      setMixedGatewayPendingPayment(gatewayEntry);

      const gatewayOptions = {
        amount: amountVND,
        isMixedPayment: true,
        mixedPaymentEntry: gatewayEntry
      };

      try {
        if (paymentMethod === 'MoMo') {
          await initiateMoMoPayment(gatewayOptions);
        } else if (paymentMethod === 'ZaloPay') {
          await initiateZaloPayPayment(gatewayOptions);
        } else if (paymentMethod === 'VNPAY') {
          await initiateVNPayPayment(gatewayOptions);
        }
        message.info(`Vui lòng hoàn tất thanh toán ${paymentMethod} cho ${formatWithCurrency(amountVND, 'VND')}`);
      } catch (error) {
        console.error('Mixed gateway initiation error:', error);
        setMixedGatewayPendingPayment(null);
        message.error(error?.message || 'Không thể khởi tạo thanh toán trực tuyến.');
      }
      return;
    }

    const newPayment = {
      id: Date.now(),
      method: paymentMethod,
      methodLabel: paymentMethod,
      amount: customerPaid,
      currency,
      amountVND,
      status: 'SUCCESS',
      timestamp: new Date().toISOString()
    };

    addMixedPaymentEntry(newPayment);

  };

  const handleRemovePartialPayment = (paymentId) => {
    const payment = mixedPayments.find(p => p.id === paymentId);
    if (!payment) return;

    const updatedPayments = mixedPayments.filter(p => p.id !== paymentId);
    const newTotalPaid = partialPaidAmount - payment.amountVND;

    setMixedPayments(updatedPayments);
    setPartialPaidAmount(newTotalPaid);

    if (updatedPayments.length === 0) {
      clearMixedPaymentState();
    } else {
      persistMixedPaymentState(updatedPayments, newTotalPaid);
    }

    message.info('Đã xoá phương thức thanh toán');
  };

  const handleEditPartialPayment = (payment) => {
    setPaymentMethod(payment.method);
    setCurrency(payment.currency);
    setCustomerPaid(payment.amount);

    const updatedPayments = mixedPayments.filter(p => p.id !== payment.id);
    const newTotalPaid = partialPaidAmount - payment.amountVND;

    setMixedPayments(updatedPayments);
    setPartialPaidAmount(newTotalPaid);

    if (updatedPayments.length === 0) {
      clearMixedPaymentState();
    } else {
      persistMixedPaymentState(updatedPayments, newTotalPaid);
    }

    message.info('Đã tải dữ liệu để chỉnh sửa');
  };

  const handleCompleteMixedPayment = async () => {
    const remaining = finalTotal - partialPaidAmount;

    if (pendingVNPayTxn || pendingMoMoTxn || pendingZaloPayTxn || mixedGatewayPendingPayment) {
      message.warning('Vẫn còn giao dịch trực tuyến chưa hoàn tất. Vui lòng hoàn tất trước khi hoàn thành.');
      return;
    }

    if (mixedPayments.some(payment => payment.status === 'PENDING')) {
      message.warning('Có phương thức thanh toán chưa được xác nhận.');
      return;
    }

    if (remaining > 0) {
      message.error(`Còn thiếu ${formatWithCurrency(remaining, 'VND')} chưa thanh toán`);
      return;
    }

    if (mixedPayments.length < 2) {
      message.warning('Thanh toán hỗn hợp cần ít nhất 2 phương thức thanh toán');
      return;
    }

    if (!invoice?.maHd) {
      message.error('Không có mã hóa đơn để hoàn thành thanh toán.');
      return;
    }

    try {
      setPaymentLoading(true);

      const result = await thanhToanHoaDon(invoice.maHd);

      if (result && (result.success !== false)) {
        message.success('Thanh toán hỗn hợp thành công!');

        const currentMixedPayments = mixedPayments.map(payment => ({
          ...payment,
          status: payment.status || 'SUCCESS'
        }));

        const paymentMethodsDescription = currentMixedPayments
          .map(p => `${p.methodLabel} (${formatWithCurrency(p.amount, p.currency)})`)
          .join(' + ');

        const mixedPaymentData = {
          maHd: invoice?.maHd,
          tongTien: orderTotal,
          discount: discountAmount,
          finalTotal,
          tienKhachDua: finalTotal,
          tienThua: 0,
          phuongThucThanhToan: `Hỗn hợp: ${paymentMethodsDescription}`,
          ghiChu: `Thanh toán hỗn hợp: ${currentMixedPayments.length} phương thức`,
          ngayThanhToan: new Date().toISOString(),
          mixedPayments: currentMixedPayments
        };

        setTimeout(() => {
          handlePrintReceiptMixed(mixedPaymentData);
        }, 500);

        await onConfirm(mixedPaymentData);

        resetMixedPaymentSession(false);
      } else {
        message.error('Thanh toán thất bại: ' + (result?.error || 'Lỗi không xác định'));
      }
    } catch (error) {
      message.error('Lỗi thanh toán: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setPaymentLoading(false);
    }
  };

  const handleModalCancel = () => {
    // Nếu đang ở chế độ hỗn hợp và có thanh toán chưa hoàn tất
    if (isMixedPaymentMode && mixedPayments.length > 0) {
      const remaining = finalTotal - partialPaidAmount;
      if (remaining > 0) {
        Modal.confirm({
          title: 'Thanh toán chưa hoàn tất',
          content: (
            <div>
              <p>Đã thanh toán: <strong>{formatWithCurrency(partialPaidAmount, 'VND')}</strong></p>
              <p>Còn thiếu: <strong style={{ color: '#ff4d4f' }}>{formatWithCurrency(remaining, 'VND')}</strong></p>
              <p style={{ marginTop: 12 }}>Bạn có muốn lưu tiến trình để thanh toán tiếp sau?</p>
            </div>
          ),
          okText: 'Lưu và thoát',
          cancelText: 'Hủy hết và thoát',
          onOk: () => {
            // Đã lưu vào localStorage rồi, chỉ cần đóng
            message.info('Đã lưu tiến trình thanh toán');
            onCancel();
          },
          onCancel: () => {
            resetMixedPaymentSession(false);
            setIsMixedPaymentMode(false);
            message.info('Đã hủy thanh toán chưa hoàn tất');
            onCancel();
          },
          centered: true
        });
        return;
      }
    }
    onCancel();
  };

  const handlePrintReceiptMixed = (mixedData) => {
    if (!invoice || invoiceDetails.length === 0) {
      message.error('Không có hóa đơn để in');
      return;
    }

    const printContent = `
      <div class="receipt-root">
        ${receiptLogoManager.getLogoHTML()}
        <div class="receipt-header">
          <h2>POS CAFE SYSTEM</h2>
          <p>Địa chỉ cửa hàng</p>
          <p>0123-456-789</p>
          <p>${new Date().toLocaleDateString('vi-VN')} ${new Date().toLocaleTimeString('vi-VN')}</p>
        </div>
        
        <div class="invoice-meta">
          <p><strong>Hóa đơn:</strong> ${invoice?.maHd || 'N/A'}</p>
          <p><strong>Bàn:</strong> ${invoice?.tenBan || 'N/A'}</p>
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
            ${invoiceDetails.map(item => `
              <tr>
                <td class="item-name">${item.tenSp || item.tenMon || 'Unknown'}</td>
                <td class="qty">${item.soLuong || item.sl || 1} x ${formatAmount(parseFloat(item.gia || item.giaBan || item.donGia || 0), 'VND')} VNĐ</td>
                <td class="total">${formatAmount((item.soLuong || item.sl || 1) * parseFloat(item.gia || item.giaBan || item.donGia || 0), 'VND')} VNĐ</td>
              </tr>
            `).join('')}
          </tbody>
        </table>
        
        <div class="totals-section">
          <div class="amount-line">
            <span class="label">Tạm tính</span>
            <div class="value">
              <span class="primary">${formatWithCurrency(orderTotal, 'VND')}</span>
            </div>
          </div>
          ${discountAmount > 0 ? `
            <div class="amount-line">
              <span class="label">Giảm giá</span>
              <div class="value">
                <span class="primary">-${formatWithCurrency(discountAmount, 'VND')}</span>
              </div>
            </div>
          ` : ''}
          <div class="amount-line highlight">
            <span class="label">Tổng cộng</span>
            <div class="value">
              <span class="primary">${formatWithCurrency(finalTotal, 'VND')}</span>
            </div>
          </div>
          <div class="amount-line">
            <span class="label">Phương thức:</span>
            <div class="value">
              <span class="primary">Thanh toán hỗn hợp</span>
            </div>
          </div>
          ${mixedData.mixedPayments.map((p, idx) => `
            <div class="amount-line">
              <span class="label">${idx + 1}. ${p.methodLabel}</span>
              <div class="value">
                <span class="primary">${formatWithCurrency(p.amount, p.currency)}</span>
                ${p.currency !== 'VND' ? `<span class="secondary">≈ ${formatWithCurrency(p.amountVND, 'VND')}</span>` : ''}
              </div>
            </div>
          `).join('')}
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
            ${receiptLogoManager.getLogoCSS()}
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
            .countdown-timer { 
              text-align: center; 
              font-size: 14px; 
              font-weight: bold; 
              color: #ff4d4f; 
              margin: 10px 0; 
              padding: 8px; 
              background: #fff2f0; 
              border: 1px solid #ffccc7; 
              border-radius: 4px; 
            }
            @media print {
              .no-print { display: none; }
              .countdown-timer { display: none; }
              body { margin: 0; }
            }
          </style>
        </head>
        <body>
          ${printContent}
          ${(() => {
            const timeoutSetting = localStorage.getItem('pmbh_receipt_print_timeout');
            const timeoutEnabled = localStorage.getItem('pmbh_receipt_print_timeout_enabled');
            const timeoutSeconds = timeoutSetting ? parseInt(timeoutSetting, 10) : 15;
            const isEnabled = timeoutEnabled !== 'false'; // Mặc định true nếu chưa set
            return timeoutSeconds > 0 && isEnabled ? `<div class="countdown-timer no-print">
              Cửa sổ sẽ tự động đóng sau <span id="countdown">${timeoutSeconds}</span> giây
            </div>` : '';
          })()}
          <div class="no-print" style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px dashed #000;">
            <button onclick="window.print()" style="padding: 10px 20px; background: #197dd3; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px;">In hóa đơn</button>
            <button onclick="window.close()" style="padding: 10px 20px; background: #ccc; color: black; border: none; border-radius: 4px; cursor: pointer; margin: 5px;">Đóng</button>
          </div>
          ${(() => {
            const timeoutSetting = localStorage.getItem('pmbh_receipt_print_timeout');
            const timeoutEnabled = localStorage.getItem('pmbh_receipt_print_timeout_enabled');
            const timeoutSeconds = timeoutSetting ? parseInt(timeoutSetting, 10) : 15;
            const isEnabled = timeoutEnabled !== 'false'; // Mặc định true nếu chưa set
            return timeoutSeconds > 0 && isEnabled ? `<script>
              let countdown = ${timeoutSeconds};
              const countdownElement = document.getElementById('countdown');
              
              const timer = setInterval(() => {
                countdown--;
                if (countdownElement) {
                  countdownElement.textContent = countdown;
                }
                
                if (countdown <= 0) {
                  clearInterval(timer);
                  window.close();
                }
              }, 1000);
              
              // Clear timer when window is closed manually
              window.addEventListener('beforeunload', () => {
                clearInterval(timer);
              });
            </script>` : '';
          })()}
        </body>
      </html>
    `);
    printWindow.document.close();
    message.success('Đã gửi hóa đơn đến máy in');
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
          ${receiptLogoManager.getLogoHTML()}
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

      // Get timeout setting from localStorage
      const timeoutSetting = localStorage.getItem('pmbh_receipt_print_timeout');
      const timeoutEnabled = localStorage.getItem('pmbh_receipt_print_timeout_enabled');
      const timeoutSeconds = timeoutSetting ? parseInt(timeoutSetting, 10) : 15;
      const isEnabled = timeoutEnabled !== 'false'; // Mặc định true nếu chưa set

      const printWindow = window.open('', '_blank', 'width=400,height=600');
      printWindow.document.write(`
        <html>
          <head>
            <title>Hóa đơn thanh toán</title>
            <style>
              body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
              .receipt-root { width: 300px; font-family: monospace; font-size: 12px; line-height: 1.4; }
              ${receiptLogoManager.getLogoCSS()}
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
              .countdown-timer { 
                text-align: center; 
                font-size: 14px; 
                font-weight: bold; 
                color: #ff4d4f; 
                margin: 10px 0; 
                padding: 8px; 
                background: #fff2f0; 
                border: 1px solid #ffccc7; 
                border-radius: 4px; 
              }
              @media print {
                .no-print { display: none; }
                .countdown-timer { display: none; }
                body { margin: 0; }
              }
            </style>
          </head>
          <body>
            ${printContent}
            ${timeoutSeconds > 0 && isEnabled ? `<div class="countdown-timer no-print">
              Cửa sổ sẽ tự động đóng sau <span id="countdown">${timeoutSeconds}</span> giây
            </div>` : ''}
            <div class="no-print" style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px dashed #000;">
              <button onclick="window.print()" style="padding: 10px 20px; background: #197dd3; color: white; border: none; border-radius: 4px; cursor: pointer; margin: 5px;">In hóa đơn</button>
              <button onclick="window.close()" style="padding: 10px 20px; background: #ccc; color: black; border: none; border-radius: 4px; cursor: pointer; margin: 5px;">Đóng</button>
            </div>
            ${timeoutSeconds > 0 && isEnabled ? `<script>
              let countdown = ${timeoutSeconds};
              const countdownElement = document.getElementById('countdown');
              
              const timer = setInterval(() => {
                countdown--;
                if (countdownElement) {
                  countdownElement.textContent = countdown;
                }
                
                if (countdown <= 0) {
                  clearInterval(timer);
                  window.close();
                }
              }, 1000);
              
              // Clear timer when window is closed manually
              window.addEventListener('beforeunload', () => {
                clearInterval(timer);
              });
            </script>` : ''}
          </body>
        </html>
      `);
      printWindow.document.close();
    };

    printReceipt();
    document.body.removeChild(receiptPrinter);
    message.success('Đã gửi hóa đơn đến máy in');
  };

  const initiateMoMoPayment = async (options = {}) => {
    const {
      amount: amountOverride,
      isMixedPayment = false,
      mixedPaymentEntry = null,
    } = options;

    try {
      if (pendingMoMoTxn) {
        message.warning('Đang chờ kết quả thanh toán MoMo hiện tại. Vui lòng hoàn tất giao dịch trước khi tạo mới.');
        return;
      }

      if (!invoice?.maHd) {
        message.error('Không có mã hóa đơn để thanh toán MoMo');
        return;
      }

      setPaymentLoading(true);

      const paymentAmount = Number.isFinite(amountOverride) ? Math.round(amountOverride) : finalTotal;

      const extraData = {
        invoiceCode: invoice.maHd,
        amount: paymentAmount,
        source: 'PMBH_POS',
      };

      if (isMixedPayment && mixedPaymentEntry) {
        extraData.partialPayment = paymentAmount;
        extraData.mixedPayment = true;
        extraData.mixedMethod = mixedPaymentEntry.method;
        extraData.partialId = mixedPaymentEntry.id;
      }

      const paymentRequest = await createMoMoPayment({
        invoiceCode: invoice.maHd,
        amount: paymentAmount,
        orderInfo: `Thanh toan hoa don ${invoice.maHd}`,
        extraData,
      });

      const paymentUrl = paymentRequest.payUrl || paymentRequest.deeplink || paymentRequest.qrCodeUrl;

      if (!paymentUrl) {
        message.error('Không tìm thấy đường dẫn thanh toán MoMo.');
        return;
      }

      setPendingMoMoTxn({
        orderId: paymentRequest.orderId,
        requestId: paymentRequest.requestId,
        amount: paymentAmount,
        isMixedPayment,
        mixedPartialId: mixedPaymentEntry?.id || null,
      });

      if (isMixedPayment && mixedPaymentEntry) {
        setMixedGatewayPendingPayment((prev) => {
          if (!prev || prev.id !== mixedPaymentEntry.id) {
            return prev;
          }
          return {
            ...prev,
            status: 'PENDING',
            amountVND: paymentAmount,
            gatewayDetails: {
              provider: 'MoMo',
              orderId: paymentRequest.orderId,
              requestId: paymentRequest.requestId,
            },
          };
        });
      }

      logMoMoTransaction({
        action: 'CREATE_PAYMENT',
        invoiceCode: invoice.maHd,
        payload: paymentRequest.payload,
        response: paymentRequest.response,
      });

      let opened = false;

      if (window.electronAPI?.openMoMoPaymentWindow) {
        const response = await window.electronAPI.openMoMoPaymentWindow(
          paymentUrl,
          momoConfig.redirectUrl
        );

        if (!response?.success) {
          setPendingMoMoTxn(null);
          if (isMixedPayment) {
            setMixedGatewayPendingPayment(null);
          }
          message.error(response?.error || 'Không thể mở cửa sổ thanh toán MoMo.');
          return;
        }

        opened = true;
        message.info('Đã mở cổng thanh toán MoMo. Vui lòng hoàn tất giao dịch trong cửa sổ mới.');
      } else {
        const popup = window.open(paymentUrl, '_blank');
        opened = !!popup;
        if (!opened) {
          message.warning('Trình duyệt đã chặn cửa sổ thanh toán MoMo. Vui lòng cho phép cửa sổ bật lên hoặc mở lại liên kết.');
        } else {
          message.info('Đã mở cổng thanh toán MoMo. Vui lòng hoàn tất giao dịch trong cửa sổ mới.');
        }
      }

      if (!opened) {
        setPendingMoMoTxn(null);
        if (isMixedPayment) {
          setMixedGatewayPendingPayment(null);
        }
      }
    } catch (error) {
      console.error('MoMo initialization error:', error);
      message.error(error?.message ? `Không thể khởi tạo thanh toán MoMo: ${error.message}` : 'Có lỗi khi khởi tạo thanh toán MoMo');
      setPendingMoMoTxn(null);
      if (isMixedPayment) {
        setMixedGatewayPendingPayment(null);
      }
    } finally {
      setPaymentLoading(false);
    }
  };

  const initiateZaloPayPayment = async (options = {}) => {
    const {
      amount: amountOverride,
      isMixedPayment = false,
      mixedPaymentEntry = null,
    } = options;

    try {
      if (pendingZaloPayTxn) {
        message.warning('Đang chờ kết quả thanh toán ZaloPay hiện tại. Vui lòng hoàn tất giao dịch trước khi tạo mới.');
        return;
      }

      if (!invoice?.maHd) {
        message.error('Không có mã hóa đơn để thanh toán ZaloPay');
        return;
      }

      setPaymentLoading(true);

      const paymentAmount = Number.isFinite(amountOverride) ? Math.round(amountOverride) : finalTotal;

      const embedData = {
        invoiceCode: invoice.maHd,
        amount: paymentAmount,
        source: 'PMBH_POS',
      };

      if (isMixedPayment && mixedPaymentEntry) {
        embedData.mixedPayment = true;
        embedData.partialAmount = paymentAmount;
        embedData.partialId = mixedPaymentEntry.id;
        embedData.mixedMethod = mixedPaymentEntry.method;
      }

      const paymentRequest = await createZaloPayPayment({
        invoiceCode: invoice.maHd,
        amount: paymentAmount,
        orderInfo: `Thanh toan hoa don ${invoice.maHd}`,
        embedData: JSON.stringify(embedData),
      });

      const paymentUrl = paymentRequest.orderUrl;

      if (!paymentUrl) {
        message.error('Không tìm thấy đường dẫn thanh toán ZaloPay.');
        return;
      }

      setPendingZaloPayTxn({
        appTransId: paymentRequest.appTransId,
        zpTransToken: paymentRequest.zpTransToken,
        amount: paymentAmount,
        isMixedPayment,
        mixedPartialId: mixedPaymentEntry?.id || null,
      });

      if (isMixedPayment && mixedPaymentEntry) {
        setMixedGatewayPendingPayment((prev) => {
          if (!prev || prev.id !== mixedPaymentEntry.id) {
            return prev;
          }
          return {
            ...prev,
            status: 'PENDING',
            amountVND: paymentAmount,
            gatewayDetails: {
              provider: 'ZaloPay',
              appTransId: paymentRequest.appTransId,
              zpTransToken: paymentRequest.zpTransToken,
            },
          };
        });
      }

      logZaloPayTransaction({
        action: 'CREATE_PAYMENT',
        invoiceCode: invoice.maHd,
        payload: paymentRequest.payload,
        response: paymentRequest.response,
      });

      let opened = false;

      if (window.electronAPI?.openZaloPayPaymentWindow) {
        const response = await window.electronAPI.openZaloPayPaymentWindow(
          paymentUrl,
          zalopayConfig.redirectUrl
        );

        if (!response?.success) {
          setPendingZaloPayTxn(null);
          if (isMixedPayment) {
            setMixedGatewayPendingPayment(null);
          }
          message.error(response?.error || 'Không thể mở cửa sổ thanh toán ZaloPay.');
          return;
        }

        opened = true;
        message.info('Đã mở cổng thanh toán ZaloPay. Vui lòng hoàn tất giao dịch trong cửa sổ mới.');
      } else {
        const popup = window.open(paymentUrl, '_blank');
        zalopayPopupRef.current = popup;
        opened = !!popup;
        if (!opened) {
          message.warning('Trình duyệt đã chặn cửa sổ thanh toán ZaloPay. Vui lòng cho phép cửa sổ bật lên hoặc mở lại liên kết.');
        } else {
          message.info('Đã mở cổng thanh toán ZaloPay. Vui lòng hoàn tất giao dịch trong cửa sổ mới.');
        }
      }

      if (!opened) {
        setPendingZaloPayTxn(null);
        if (isMixedPayment) {
          setMixedGatewayPendingPayment(null);
        }
        return;
      }

      if (zalopayPollRef.current) {
        clearInterval(zalopayPollRef.current);
        zalopayPollRef.current = null;
      }

      zalopayPollRef.current = setInterval(async () => {
        try {
          const appTransId = paymentRequest.appTransId;
          const queryResult = await queryZaloPayOrder(appTransId);
          if (!queryResult) return;

          console.log('ZaloPay poll result:', queryResult);

          const returnCode = Number(queryResult.data.return_code);
          const subReturnCode = Number(queryResult.data.sub_return_code);
          console.log('ZaloPay codes - return_code:', returnCode, 'sub_return_code:', subReturnCode);

          if (queryResult.success && queryResult.data && returnCode === 1 && subReturnCode === 1) {
            clearInterval(zalopayPollRef.current);
            zalopayPollRef.current = null;

            cleanupZaloPayPayment();
            setPendingZaloPayTxn(null);

            if (isMixedPayment && mixedPaymentEntry) {
              const successMessage = `Đã ghi nhận ZaloPay ${formatWithCurrency(paymentAmount, 'VND')}`;
              completeMixedGatewayPayment(
                {
                  ...mixedPaymentEntry,
                  amountVND: paymentAmount,
                  gatewayDetails: {
                    ...(mixedPaymentEntry.gatewayDetails || {}),
                    provider: 'ZaloPay',
                    appTransId: paymentRequest.appTransId,
                    zpTransToken: paymentRequest.zpTransToken,
                  },
                },
                {
                  provider: 'ZaloPay',
                  transactionData: queryResult.data,
                  successMessage,
                }
              );
              return;
            }

            setPaymentLoading(true);
            try {
              const result = await thanhToanHoaDon(invoice.maHd);
              if (result && (result.success !== false)) {
                message.success('Thanh toán ZaloPay thành công!');
                setTimeout(() => { handlePrintReceipt(); }, 500);

                const paymentData = {
                  maHd: invoice?.maHd,
                  tongTien: orderTotal,
                  discount: discountAmount,
                  discountType,
                  finalTotal,
                  tienKhachDua: finalTotal,
                  tienThua: 0,
                  phuongThucThanhToan: 'ZaloPay',
                  ghiChu: `Thanh toan ZaloPay - app_trans_id: ${paymentRequest.appTransId}`,
                  ngayThanhToan: new Date().toISOString(),
                  zalopayData: queryResult.data,
                };

                await onConfirm(paymentData);
              } else {
                message.error('Thanh toán thất bại: ' + (result?.error || 'Lỗi không xác định'));
              }
            } catch (ex) {
              console.error('Error finalizing invoice after ZaloPay success:', ex);
              message.error('Lỗi khi xử lý hoá đơn sau ZaloPay');
            } finally {
              setPaymentLoading(false);
            }
          } else if (
            queryResult.data &&
            Number(queryResult.data.sub_return_code) < 0 &&
            Number(queryResult.data.sub_return_code) !== -101
          ) {
            clearInterval(zalopayPollRef.current);
            zalopayPollRef.current = null;

            cleanupZaloPayPayment();
            setPendingZaloPayTxn(null);
            if (isMixedPayment) {
              setMixedGatewayPendingPayment(null);
            }
            message.warning('Giao dịch ZaloPay không thành công hoặc đã bị huỷ.');
          }
        } catch (err) {
          console.error('Error polling ZaloPay order:', err);
        }
      }, 3000);
    } catch (error) {
      console.error('ZaloPay initialization error:', error);
      message.error(error?.message ? `Không thể khởi tạo thanh toán ZaloPay: ${error.message}` : 'Có lỗi khi khởi tạo thanh toán ZaloPay');
      setPendingZaloPayTxn(null);
      if (isMixedPayment) {
        setMixedGatewayPendingPayment(null);
      }
    } finally {
      setPaymentLoading(false);
    }
  };

  const handleMoMoSuccess = async (paymentResult, verificationResult) => {
    try {
      setPaymentLoading(true);

      logMoMoTransaction({
        action: 'RETURN_SUCCESS',
        invoiceCode: invoice?.maHd,
        paymentResult,
        verification: verificationResult,
      });

      const isMixedMoMoPayment = Boolean(
        mixedGatewayPendingPayment && mixedGatewayPendingPayment.method === 'MoMo'
      );

      if (isMixedMoMoPayment) {
        const amountVND = mixedGatewayPendingPayment.amountVND || Number(paymentResult.amount) || 0;
        const successMessage = `Đã ghi nhận MoMo ${formatWithCurrency(amountVND, 'VND')}`;

        completeMixedGatewayPayment(
          {
            ...mixedGatewayPendingPayment,
            amountVND,
            gatewayDetails: {
              ...(mixedGatewayPendingPayment.gatewayDetails || {}),
              provider: 'MoMo',
              orderId: paymentResult.orderId,
              requestId: paymentResult.requestId,
            },
          },
          {
            provider: 'MoMo',
            transactionData: {
              payment: paymentResult,
              verification: verificationResult,
            },
            successMessage,
          }
        );

        return;
      }

      const result = await thanhToanHoaDon(invoice.maHd);

      if (result && (result.success !== false)) {
        message.success('Thanh toan MoMo thanh cong!');

        setTimeout(() => {
          handlePrintReceipt();
        }, 500);

        const paymentData = {
          maHd: invoice?.maHd,
          tongTien: orderTotal,
          discount: discountAmount,
          discountType,
          finalTotal,
          tienKhachDua: finalTotal,
          tienThua: 0,
          phuongThucThanhToan: 'MoMo',
          ghiChu: `Thanh toan MoMo - OrderId: ${paymentResult.orderId}`,
          ngayThanhToan: new Date().toISOString(),
          momoData: {
            ...paymentResult,
            verification: verificationResult,
          },
        };

        await onConfirm(paymentData);
      } else {
        message.error('Thanh toan that bai: ' + (result?.error || 'Loi khong xac dinh'));
      }
    } catch (error) {
      message.error('Loi thanh toan MoMo: ' + (error.message || 'Loi khong xac dinh'));
    } finally {
      setPaymentLoading(false);
    }
  };

  const processMoMoPayload = React.useCallback(
    (rawPayload = {}) => {
      if (!pendingMoMoTxn) {
        return;
      }

      const payload = rawPayload.payload || rawPayload;
      const rawQuery = payload.rawQuery || payload.query || {};
      const mergedPayload = {
        ...rawQuery,
        ...payload,
      };

      const isMixedMoMoPayment = Boolean(
        mixedGatewayPendingPayment && mixedGatewayPendingPayment.method === 'MoMo'
      );

      const targetOrderId = mergedPayload.orderId || rawQuery.orderId;

      if (
        pendingMoMoTxn.orderId &&
        targetOrderId &&
        targetOrderId !== pendingMoMoTxn.orderId
      ) {
        return;
      }

      if (payload.error) {
        logMoMoTransaction({
          action: 'RETURN_ERROR',
          invoiceCode: invoice?.maHd,
          payload,
        });
        setPendingMoMoTxn(null);
        if (isMixedMoMoPayment) {
          setMixedGatewayPendingPayment(null);
        }
        message.error(`Thanh toán MoMo không hoàn tất: ${payload.error}`);
        return;
      }

      const verification =
        payload.verification ||
        verifyMoMoReturnSignature(rawQuery && Object.keys(rawQuery).length ? rawQuery : mergedPayload);

      const enrichedPayload = {
        ...mergedPayload,
        verification,
      };

      logMoMoTransaction({
        action: 'RETURN_CALLBACK',
        invoiceCode: invoice?.maHd,
        payload: enrichedPayload,
        verification,
      });

      setPendingMoMoTxn(null);

      if (!verification.isValid) {
        if (isMixedMoMoPayment) {
          setMixedGatewayPendingPayment(null);
        }
        message.error('Chữ ký MoMo không hợp lệ. Vui lòng kiểm tra lại giao dịch.');
        return;
      }

      const normalizedCode = normalizeMoMoResultCode(enrichedPayload.resultCode);
      const normalizedPayload = {
        ...enrichedPayload,
        resultCode: normalizedCode,
        message: enrichedPayload.message || getMoMoResultMessage(normalizedCode),
      };

      if (normalizedCode === '0' || normalizedCode === '9000') {
        handleMoMoSuccess(normalizedPayload, verification);
        return;
      }

      const errorMessage = normalizedPayload.message || 'Thanh toán MoMo thất bại.';
      if (isMixedMoMoPayment) {
        setMixedGatewayPendingPayment(null);
      }
      message.error(`Thanh toán MoMo thất bại: ${errorMessage}`);
    },
    [pendingMoMoTxn, handleMoMoSuccess, mixedGatewayPendingPayment, setMixedGatewayPendingPayment]
  );

  useEffect(() => {
    if (typeof window === 'undefined') {
      return undefined;
    }

    const handleMoMoMessage = (event) => {
      if (!event || !event.data) {
        return;
      }

      const { type, payload } = event.data;
      if (type !== 'MOMO_PAYMENT_RESULT') {
        return;
      }

      processMoMoPayload(payload || event.data.payload || {});
    };

    window.addEventListener('message', handleMoMoMessage);
    return () => {
      window.removeEventListener('message', handleMoMoMessage);
    };
  }, [processMoMoPayload]);

  useEffect(() => {
    if (!window.electronAPI?.onMoMoPaymentResult) {
      return undefined;
    }

    const removeListener = window.electronAPI.onMoMoPaymentResult((payload) => {
      processMoMoPayload(payload);
    });

    return () => {
      if (typeof removeListener === 'function') {
        removeListener();
      }
    };
  }, [processMoMoPayload]);

  useEffect(() => {
    if (!pendingMoMoTxn) {
      return;
    }

    if (window.electronAPI?.onceMoMoPaymentClosed) {
      window.electronAPI.onceMoMoPaymentClosed(() => {
        setPendingMoMoTxn((prev) => {
          if (prev) {
            message.warning('Cửa sổ thanh toán MoMo đã đóng trước khi hoàn tất.');
          }
          return null;
        });
      });
    }
  }, [pendingMoMoTxn]);

  const initiateVNPayPayment = async (options = {}) => {
    const {
      amount: amountOverride,
      isMixedPayment = false,
      mixedPaymentEntry = null,
    } = options;

    try {
      if (pendingVNPayTxn) {
        message.warning('Đang chờ kết quả cho giao dịch VNPay hiện tại. Vui lòng hoàn tất giao dịch trước khi tạo giao dịch mới.');
        return;
      }

      if (!invoice?.maHd) {
        message.error('Không có mã hóa đơn để thanh toán');
        return;
      }

      setPaymentLoading(true);

      const paymentAmount = Number.isFinite(amountOverride) ? Math.round(amountOverride) : finalTotal;

      const invoiceData = {
        maHd: invoice.maHd,
        tongTien: paymentAmount,
        moTa: `Thanh toan hoa don ${invoice.maHd}`,
      };

      const result = createVNPayPaymentUrl(invoiceData, true);

      if (!result.success) {
        message.error(result.error || 'Không thể khởi tạo thanh toán VNPay');
        return;
      }

      setPendingVNPayTxn({
        txnRef: result.txnRef,
        invoiceCode: invoice.maHd,
        amount: result.amount,
        isMixedPayment,
        mixedPartialId: mixedPaymentEntry?.id || null,
      });

      if (isMixedPayment && mixedPaymentEntry) {
        setMixedGatewayPendingPayment((prev) => {
          if (!prev || prev.id !== mixedPaymentEntry.id) {
            return prev;
          }
          return {
            ...prev,
            status: 'PENDING',
            amountVND: paymentAmount,
            gatewayDetails: {
              provider: 'VNPay',
              txnRef: result.txnRef,
            },
          };
        });
      }

      let opened = false;

      if (window.electronAPI?.openVNPayPaymentWindow) {
        const response = await window.electronAPI.openVNPayPaymentWindow(
          result.paymentUrl,
          vnpayConfig.vnp_ReturnUrl
        );

        if (!response?.success) {
          setPendingVNPayTxn(null);
          if (isMixedPayment) {
            setMixedGatewayPendingPayment(null);
          }
          message.error(response?.error || 'Không thể mở cửa sổ thanh toán VNPay.');
          return;
        }

        opened = true;
        message.info('Đã mở cổng thanh toán VNPay. Vui lòng hoàn tất giao dịch trong cửa sổ mới.');
      } else {
        const popup = window.open(result.paymentUrl, '_blank');
        opened = !!popup;
        if (!opened) {
          message.warning('Trình duyệt đã chặn cửa sổ thanh toán VNPay. Vui lòng cho phép cửa sổ bật lên hoặc mở lại liên kết.');
        } else {
          message.info('Đã mở cổng thanh toán VNPay. Vui lòng hoàn tất giao dịch trong cửa sổ mới.');
        }
      }

      if (!opened) {
        setPendingVNPayTxn(null);
        if (isMixedPayment) {
          setMixedGatewayPendingPayment(null);
        }
      }
    } catch (error) {
      console.error('VNPay initialization error:', error);
      message.error('Có lỗi xảy ra khi mở cổng thanh toán VNPay');
      setPendingVNPayTxn(null);
      if (isMixedPayment) {
        setMixedGatewayPendingPayment(null);
      }
    } finally {
      setPaymentLoading(false);
    }
  };

  /**
   * Xử lý thanh toán thành công từ VNPay
   */
  const handleVNPaySuccess = React.useCallback(async (paymentResult) => {
    console.log('VNPay payment result:', paymentResult);
    try {
      setPaymentLoading(true);
      setPendingVNPayTxn(null);

      const normalizedResponseCode =
        paymentResult?.responseCode === '0' ? '00' : paymentResult?.responseCode || '00';

      if (normalizedResponseCode !== '00') {
        if (mixedGatewayPendingPayment && mixedGatewayPendingPayment.method === 'VNPAY') {
          setMixedGatewayPendingPayment(null);
        }
        message.error(`Thanh toán VNPay không hợp lệ (mã ${normalizedResponseCode})`);
        return;
      }

      const normalizedResult = {
        ...paymentResult,
        responseCode: normalizedResponseCode,
      };

      const isMixedVNPayPayment = Boolean(
        mixedGatewayPendingPayment && mixedGatewayPendingPayment.method === 'VNPAY'
      );

      if (isMixedVNPayPayment) {
        const amountVND = mixedGatewayPendingPayment.amountVND || Number(paymentResult.amount) || 0;
        const successMessage = `Đã ghi nhận VNPay ${formatWithCurrency(amountVND, 'VND')}`;

        completeMixedGatewayPayment(
          {
            ...mixedGatewayPendingPayment,
            amountVND,
            gatewayDetails: {
              ...(mixedGatewayPendingPayment.gatewayDetails || {}),
              provider: 'VNPay',
              txnRef: normalizedResult.txnRef,
            },
          },
          {
            provider: 'VNPay',
            transactionData: normalizedResult,
            successMessage,
          }
        );

        return;
      }

      const result = await thanhToanHoaDon(invoice.maHd);
      
      if (result && (result.success !== false)) {
        message.success('Thanh toán VNPay thành công!');
        
        setTimeout(() => {
          handlePrintReceipt();
        }, 500);
        
        const paymentData = {
          maHd: invoice?.maHd,
          tongTien: orderTotal,
          discount: discountAmount,
          discountType,
          finalTotal,
          tienKhachDua: finalTotal,
          tienThua: 0,
          phuongThucThanhToan: 'VNPay',
          ghiChu: `Thanh toan VNPay - TxnRef: ${normalizedResult.txnRef}`,
          ngayThanhToan: new Date().toISOString(),
          vnpayData: normalizedResult,
        };
        
        await onConfirm(paymentData);
      } else {
        message.error('Thanh toán thất bại: ' + (result?.error || 'Lỗi không xác định'));
      }
    } catch (error) {
      message.error('Lỗi thanh toán VNPay: ' + (error.message || 'Lỗi không xác định'));
    } finally {
      setPaymentLoading(false);
    }
  }, [
    setPaymentLoading,
    setPendingVNPayTxn,
    invoice?.maHd,
    thanhToanHoaDon,
    handlePrintReceipt,
    orderTotal,
    discountAmount,
    discountType,
    finalTotal,
    onConfirm,
    mixedGatewayPendingPayment,
    setMixedGatewayPendingPayment,
    completeMixedGatewayPayment,
  ]);

  const processVNPayPayload = React.useCallback(
    (rawPayload = {}) => {
      if (!pendingVNPayTxn) {
        return;
      }

      const payload = rawPayload.payload || rawPayload;

      if (
        pendingVNPayTxn.txnRef &&
        payload.txnRef &&
        payload.txnRef !== pendingVNPayTxn.txnRef
      ) {
        return;
      }

      if (typeof process !== 'undefined' && process.env?.NODE_ENV !== 'production') {
        console.log('VNPay payload received:', payload);
      }
      const normalizedPayload = {
        ...payload,
        responseCode:
          payload.responseCode ??
          payload.vnp_ResponseCode ??
          payload?.rawQuery?.vnp_ResponseCode ??
          '',
        transactionStatus:
          payload.transactionStatus ??
          payload.vnp_TransactionStatus ??
          payload?.rawQuery?.vnp_TransactionStatus ??
          '',
      };

      setPendingVNPayTxn(null);
      handleVNPaySuccess(normalizedPayload);
    },
    [handleVNPaySuccess, pendingVNPayTxn]
  );

  const processZaloPayPayload = React.useCallback(
    (rawPayload = {}) => {
      if (!pendingZaloPayTxn) {
        return;
      }

      const payload = rawPayload.payload || rawPayload;

      if (
        pendingZaloPayTxn.appTransId &&
        payload.appTransId &&
        payload.appTransId !== pendingZaloPayTxn.appTransId
      ) {
        console.warn('AppTransId mismatch:', payload.appTransId, 'vs', pendingZaloPayTxn.appTransId);
        return;
      }

      const normalizedPayload = {
        ...payload,
        return_code: payload.return_code || payload.returnCode || '',
        return_message: payload.return_message || payload.returnMessage || '',
        sub_return_code: payload.sub_return_code || payload.subReturnCode || '',
        sub_return_message: payload.sub_return_message || payload.subReturnMessage || '',
        zp_trans_token: payload.zp_trans_token || payload.zpTransToken || '',
        app_trans_id: payload.app_trans_id || payload.appTransId || '',
      };

      const wasMixedPayment = Boolean(pendingZaloPayTxn?.isMixedPayment);
      const mixedPartialId = pendingZaloPayTxn?.mixedPartialId;
      const paymentAmount = pendingZaloPayTxn?.amount || 0;

      cleanupZaloPayPayment();
      setPendingZaloPayTxn(null);

      const matchedMixedEntry =
        wasMixedPayment &&
        mixedGatewayPendingPayment &&
        (mixedGatewayPendingPayment.id === mixedPartialId || mixedPartialId == null)
          ? mixedGatewayPendingPayment
          : null;

      const handleZaloPaySuccessInline = async (paymentResult) => {
        console.log('ZaloPay payment result:', paymentResult);
        const normalizedReturnCode = paymentResult?.return_code || '1';

        if (normalizedReturnCode !== '1') {
          message.error(`Thanh toán ZaloPay không hợp lệ (mã ${normalizedReturnCode})`);
          if (matchedMixedEntry) {
            setMixedGatewayPendingPayment(null);
          }
          return;
        }

        if (matchedMixedEntry) {
          const amountVND = paymentAmount || matchedMixedEntry.amountVND || 0;
          const successMessage = `Đã ghi nhận ZaloPay ${formatWithCurrency(amountVND, 'VND')}`;

          completeMixedGatewayPayment(
            {
              ...matchedMixedEntry,
              amountVND,
              gatewayDetails: {
                ...(matchedMixedEntry.gatewayDetails || {}),
                provider: 'ZaloPay',
                appTransId: paymentResult.app_trans_id,
                zpTransToken: paymentResult.zp_trans_token,
              },
            },
            {
              provider: 'ZaloPay',
              transactionData: paymentResult,
              successMessage,
            }
          );

          return;
        }

        try {
          setPaymentLoading(true);

          const result = await thanhToanHoaDon(invoice.maHd);

          if (result && (result.success !== false)) {
            message.success('Thanh toán ZaloPay thành công!');

            setTimeout(() => {
              handlePrintReceipt();
            }, 500);

            const paymentData = {
              maHd: invoice?.maHd,
              tongTien: orderTotal,
              discount: discountAmount,
              discountType,
              finalTotal,
              tienKhachDua: finalTotal,
              tienThua: 0,
              phuongThucThanhToan: 'ZaloPay',
              ghiChu: `Thanh toan ZaloPay - AppTransId: ${paymentResult.app_trans_id}`,
              ngayThanhToan: new Date().toISOString(),
              zalopayData: paymentResult,
            };

            await onConfirm(paymentData);
          } else {
            message.error('Thanh toán thất bại: ' + (result?.error || 'Lỗi không xác định'));
          }
        } catch (error) {
          message.error('Lỗi thanh toán ZaloPay: ' + (error.message || 'Lỗi không xác định'));
        } finally {
          setPaymentLoading(false);
        }
      };

      handleZaloPaySuccessInline(normalizedPayload);
    },
    [
      pendingZaloPayTxn,
      setPaymentLoading,
      setPendingZaloPayTxn,
      invoice?.maHd,
      thanhToanHoaDon,
      handlePrintReceipt,
      orderTotal,
      discountAmount,
      discountType,
      finalTotal,
      onConfirm,
      cleanupZaloPayPayment,
      mixedGatewayPendingPayment,
      completeMixedGatewayPayment,
      setMixedGatewayPendingPayment,
    ]
  );

  useEffect(() => {
    if (typeof window === 'undefined') {
      return undefined;
    }

    const handleVNPayMessage = (event) => {
      if (!event || !event.data) {
        return;
      }

      const { type, payload } = event.data;
      if (type !== 'VNPAY_PAYMENT_RESULT') {
        return;
      }

      processVNPayPayload(payload || event.data.payload || {});
    };

    window.addEventListener('message', handleVNPayMessage);
    return () => {
      window.removeEventListener('message', handleVNPayMessage);
    };
  }, [processVNPayPayload]);

  useEffect(() => {
    if (!window.electronAPI?.onVNPayPaymentResult) {
      return undefined;
    }

    const removeListener = window.electronAPI.onVNPayPaymentResult((payload) => {
      processVNPayPayload(payload);
    });

    return () => {
      if (typeof removeListener === 'function') {
        removeListener();
      }
    };
  }, [processVNPayPayload]);

  useEffect(() => {
    if (typeof window === 'undefined') {
      return undefined;
    }

    const handleZaloPayMessage = (event) => {
      if (!event || !event.data) {
        return;
      }

      const { type, payload } = event.data;
      if (type !== 'ZALOPAY_PAYMENT_RESULT') {
        return;
      }

      processZaloPayPayload(payload || event.data.payload || {});
    };

    window.addEventListener('message', handleZaloPayMessage);
    return () => {
      window.removeEventListener('message', handleZaloPayMessage);
    };
  }, [processZaloPayPayload]);

  useEffect(() => {
    if (!window.electronAPI?.onZaloPayPaymentResult) {
      return undefined;
    }

    const removeListener = window.electronAPI.onZaloPayPaymentResult((payload) => {
      processZaloPayPayload(payload);
    });

    return () => {
      if (typeof removeListener === 'function') {
        removeListener();
      }
    };
  }, [processZaloPayPayload]);

  useEffect(() => {
    if (!pendingVNPayTxn) {
      return;
    }

    if (window.electronAPI?.onceVNPayPaymentClosed) {
      window.electronAPI.onceVNPayPaymentClosed(() => {
        setPendingVNPayTxn((prev) => {
          if (prev) {
            message.warning('Cửa sổ thanh toán VNPay đã đóng trước khi hoàn tất.');
          }
          return null;
        });
      });
    }
  }, [pendingVNPayTxn]);

  useEffect(() => {
    if (!pendingZaloPayTxn) {
      return;
    }

    if (window.electronAPI?.onceZaloPayPaymentClosed) {
      window.electronAPI.onceZaloPayPaymentClosed(() => {
        cleanupZaloPayPayment();
        setPendingZaloPayTxn((prev) => {
          if (prev) {
            message.warning('Cửa sổ thanh toán ZaloPay đã đóng trước khi hoàn tất.');
          }
          return null;
        });
      });
    }
  }, [pendingZaloPayTxn, cleanupZaloPayPayment]);

  const customerPaidInVND = convertToVND(customerPaid, currency);
  const finalTotalInCurrency = convertFromVND(finalTotal, currency);
  const changeInVND = Math.max(0, customerPaidInVND - finalTotal);
  const remainingMixedPayment = finalTotal - partialPaidAmount;
  const hasPendingGatewayTransaction =
    Boolean(pendingVNPayTxn || pendingMoMoTxn || pendingZaloPayTxn || mixedGatewayPendingPayment);
  const enoughPayment =
    paymentMethod === 'VNPAY' || paymentMethod === 'MoMo' || paymentMethod === 'ZaloPay'
      ? true
      : isMixedPaymentMode
        ? partialPaidAmount >= finalTotal
        : customerPaidInVND >= finalTotal;
  const currencyLabel = currency === 'VND' ? 'VNĐ' : currency;

  return (
    <Modal
      open={visible}
      onCancel={handleModalCancel}
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
            onClick={handleModalCancel}
            className="back-button"
          />
          <Text className="payment-title">
            {isMixedPaymentMode ? 'Thanh toán hỗn hợp' : 'Thanh toán'}
          </Text>
          <div className="header-spacer"></div>
        </div>

        <div className="payment-content">
          {/* Left Panel - 3 Columns Layout */}
          <div className="payment-left">
            {/* Column 1: Payment Methods */}
            <div className="payment-column">
              <Text className="column-title">Phương thức thanh toán</Text>
              <div className="method-list">
                {['Tiền mặt', 'MoMo', 'ZaloPay', 'VNPAY'].map(method => (
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
                <span>Cần thanh toán:</span>
                <span>{finalTotal.toLocaleString()} VND</span>
              </div>

              {/* Mixed Payment Mode */}
              {isMixedPaymentMode && (
                <>
                  <div className="summary-line paid">
                    <span>Đã thanh toán:</span>
                    <span style={{ color: '#52c41a', fontWeight: 'bold' }}>
                      {formatWithCurrency(partialPaidAmount, 'VND')}
                    </span>
                  </div>
                  <div className="summary-line remaining">
                    <span>Còn lại:</span>
                    <span style={{ color: '#ff4d4f', fontWeight: 'bold' }}>
                      {formatWithCurrency(remainingMixedPayment, 'VND')}
                    </span>
                  </div>
                  <div className="summary-line">
                    <span>Số phương thức:</span>
                    <span>{mixedPayments.length}</span>
                  </div>
                  
                  {/* Mixed Payments List */}
                  {mixedPayments.length > 0 && (
                    <div className="mixed-payments-list">
                      <Text className="list-title">Đã thanh toán:</Text>
                      {mixedPayments.map((payment, index) => (
                        <div key={payment.id} className="mixed-payment-item">
                          <div className="payment-info">
                            <span className="payment-index">{index + 1}.</span>
                            <span className="payment-method">{payment.methodLabel}</span>
                            <span className="payment-amount">
                              {formatWithCurrency(payment.amount, payment.currency)}
                            </span>
                          </div>
                          <div className="payment-actions">
                            <Button
                              type="text"
                              size="small"
                              onClick={() => handleEditPartialPayment(payment)}
                              className="edit-payment-btn"
                              title="Sửa"
                            >
                              Sửa
                            </Button>
                            <Button
                              type="text"
                              danger
                              size="small"
                              onClick={() => handleRemovePartialPayment(payment.id)}
                              className="remove-payment-btn"
                            >
                              Xóa
                            </Button>
                          </div>
                        </div>
                      ))}
                    </div>
                  )}
                </>
              )}

              {/* Normal Payment Mode */}
              {!isMixedPaymentMode && paymentMethod === 'Cash' && (
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
            <Button 
              icon={<Split size={16} />}
              onClick={handleToggleMixedPayment}
              className={isMixedPaymentMode ? "mixed-payment-btn active" : "mixed-payment-btn"}
              size="large"
            >
              {isMixedPaymentMode ? 'Tắt hỗn hợp' : 'Thanh toán hỗn hợp'}
            </Button>
          </div>
          <div className="footer-center">
            {isMixedPaymentMode ? (
              <div className="mixed-payment-actions">
                <Button 
                  onClick={() => resetMixedPaymentSession()}
                  className="cancel-partial-btn"
                  size="large"
                  disabled={
                    mixedPayments.length === 0 &&
                    partialPaidAmount === 0 &&
                    !mixedGatewayPendingPayment &&
                    !hasPendingGatewayTransaction
                  }
                >
                  Hủy
                </Button>
                <Button 
                  icon={<Plus size={16} />}
                  onClick={handleAddPartialPayment}
                  className="add-partial-btn"
                  size="large"
                  disabled={
                    customerPaid <= 0 ||
                    remainingMixedPayment <= 0 ||
                    (isGatewayMethod(paymentMethod) && hasPendingGatewayTransaction)
                  }
                  type="primary"
                >
                  Thêm thanh toán
                </Button>
              </div>
            ) : (
              <Button 
                icon={<Printer size={16} />}
                onClick={handlePrintReceipt}
                className="print-receipt-btn"
                size="large"
              >
                In hóa đơn
              </Button>
            )}
          </div>
          <div className="footer-right">
            {isMixedPaymentMode ? (
              <Button 
                className="main-payment-btn"
                onClick={handleCompleteMixedPayment}
                loading={paymentLoading}
                size="large"
                type="primary"
                disabled={
                  !enoughPayment ||
                  mixedPayments.length < 2 ||
                  hasPendingGatewayTransaction
                }
              >
                <span>HOÀN TẤT</span>
                <span className="payment-amount">
                  {mixedPayments.length < 2 ? 'Cần ít nhất 2 PT' : `${partialPaidAmount.toLocaleString()} VND`}
                </span>
              </Button>
            ) : (
              <Button 
                className="main-payment-btn"
                onClick={handleConfirmPayment}
                loading={paymentLoading}
                size="large"
                type="primary"
                disabled={
                  !enoughPayment ||
                  (paymentMethod === 'VNPAY' && Boolean(pendingVNPayTxn)) ||
                  (paymentMethod === 'MoMo' && Boolean(pendingMoMoTxn))
                }
              >
                <span>THANH TOÁN</span>
                <span className="payment-amount">{finalTotal.toLocaleString()} VND</span>
              </Button>
            )}
          </div>
        </div>
      </div>

      {/* Payment Success Modal */}
      <Modal
        title="Thanh toán thành công"
        visible={showPaymentSuccessModal}
        onCancel={() => {
          setShowPaymentSuccessModal(false);
          // Call custom close handler for payment success
          if (onPaymentSuccessClose) {
            onPaymentSuccessClose();
          } else {
            onCancel();
          }
        }}
        footer={[
          <Button
            key="close"
            type="primary"
            onClick={() => {
              setShowPaymentSuccessModal(false);
              // Call custom close handler for payment success
              if (onPaymentSuccessClose) {
                onPaymentSuccessClose();
              } else {
                onCancel();
              }
            }}
          >
            Đóng
          </Button>
        ]}
        width={500}
        centered
      >
        <div style={{ textAlign: 'center', padding: '20px' }}>
          <CheckCircle size={64} color="#52c41a" style={{ marginBottom: 16 }} />
          <h3 style={{ color: '#52c41a', marginBottom: 8 }}>Thanh toán thành công!</h3>
          <p style={{ marginBottom: 16 }}>
            Hóa đơn #{invoice?.maHd} đã được thanh toán thành công.
          </p>
          <div style={{ background: '#f6ffed', padding: '12px', borderRadius: '6px', marginBottom: 16 }}>
            <Text strong>Tổng tiền: {formatWithCurrency(finalTotal, 'VND')}</Text>
            {discountAmount > 0 && (
              <div>
                <Text>Giảm giá: {formatWithCurrency(discountAmount, 'VND')}</Text>
              </div>
            )}
            <div>
              <Text>Tiền khách đưa: {formatWithCurrency(customerPaidInVND, 'VND')}</Text>
            </div>
            {changeAmount > 0 && (
              <div>
                <Text>Tiền thừa: {formatWithCurrency(Math.max(0, customerPaidInVND - finalTotal), 'VND')}</Text>
              </div>
            )}
          </div>
          <Text type="secondary">
            Hệ thống sẽ tự động quay lại trang chọn bàn.
          </Text>
        </div>
      </Modal>

    </Modal>
  );
};

export default PaymentModal;


