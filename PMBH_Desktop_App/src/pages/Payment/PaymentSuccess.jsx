import React, { useMemo, useEffect, useState, useCallback } from 'react';
import { useLocation, useNavigate, useSearchParams } from 'react-router-dom';
import { Result, Button, Card, Descriptions, Typography } from 'antd';
import { CheckCircle } from 'lucide-react';
import './PaymentSuccess.css';

const { Text } = Typography;

const formatAmount = (amount) => {
  if (amount === null || amount === undefined) {
    return '';
  }
  const numeric = Number(amount);
  if (Number.isNaN(numeric)) {
    return '';
  }
  return `${numeric.toLocaleString('vi-VN')} VNĐ`;
};

const formatPayDate = (payDate) => {
  if (!payDate) return '';
  // Giả sử payDate là string hoặc Date
  if (typeof payDate === 'string' && payDate.length === 14) {
    const year = payDate.substring(0, 4);
    const month = payDate.substring(4, 6);
    const day = payDate.substring(6, 8);
    const hour = payDate.substring(8, 10);
    const minute = payDate.substring(10, 12);
    const second = payDate.substring(12, 14);
    return `${day}/${month}/${year} ${hour}:${minute}:${second}`;
  }
  return payDate;
};

const PaymentSuccess = () => {
  const location = useLocation();
  const navigate = useNavigate();
  const [searchParams] = useSearchParams();

  // Auto close countdown state
  const [countdown, setCountdown] = useState(null);

  const result = useMemo(() => {
    const key = searchParams.get('key');
    let paymentData = null;
    if (key) {
      try {
        const stored = localStorage.getItem(key);
        if (stored) {
          paymentData = JSON.parse(stored);
        }
      } catch (error) {
        console.error('Error parsing payment data from localStorage:', error);
      }
    } else {
      // Fallback to location.state for backward compatibility
      paymentData = location.state?.paymentResult;
    }

    if (paymentData) {
      return {
        success: true,
        status: 'success',
        message: 'Thanh toán thành công.',
        txnRef: paymentData.maHd || '',
        amount: paymentData.finalTotal || paymentData.tongTien || 0,
        orderInfo: paymentData.maHd || '',
        paymentMethod: paymentData.phuongThucThanhToan || 'Online',
        payDate: paymentData.ngayThanhToan || new Date().toISOString(),
        discount: paymentData.discount || 0,
        discountType: paymentData.discountType || '',
        tienKhachDua: paymentData.tienKhachDua || 0,
        tienThua: paymentData.tienThua || 0,
        ghiChu: paymentData.ghiChu || '',
        vnpayData: paymentData.vnpayData,
        loyaltyCustomer: paymentData.loyaltyCustomer || null,
        loyaltyPoints: paymentData.loyaltyPoints ?? null,
      };
    }
    return {
      success: true,
      status: 'success',
      message: 'Thanh toán thành công.',
      txnRef: '',
      amount: 0,
      orderInfo: '',
      paymentMethod: 'online',
      payDate: new Date().toISOString(),
      loyaltyCustomer: null,
      loyaltyPoints: null,
    };
  }, [location.state, searchParams]);

  useEffect(() => {
    try {
      if (window.opener && !window.opener.closed) {
        window.opener.postMessage(
          {
            type: 'PAYMENT_SUCCESS_RESULT',
            payload: result,
          },
          window.location.origin
        );
      }
    } catch (error) {
      console.error('Unable to post payment success message to opener:', error);
    }

    // Clean up localStorage
    const key = searchParams.get('key');
    if (key) {
      localStorage.removeItem(key);
    }
  }, [result, searchParams]);

  const notifyParentAboutClose = useCallback(() => {
    const hasOpener = window.opener && !window.opener.closed;

    if (hasOpener) {
      try {
        window.opener.postMessage(
          {
            type: 'PAYMENT_SUCCESS_CLOSED',
          },
          window.location.origin
        );
      } catch (error) {
        console.error('Unable to notify opener about payment success close:', error);
      }
    }

    if (window.electronAPI?.focusMainWindow) {
      window.electronAPI.focusMainWindow();
    } else if (hasOpener) {
      try {
        window.opener.focus();
      } catch (error) {
        console.warn('Unable to focus opener window:', error);
      }
    } else if (typeof window.focus === 'function') {
      window.focus();
    }
  }, []);

  const handleLoyaltyClick = useCallback(() => {
    const payload = {
      invoiceCode: result.txnRef || result.orderInfo || '',
      loyaltyCustomer: result.loyaltyCustomer || null,
      pointsEarned: result.loyaltyPoints ?? null
    };

    let forwardToParent = false;

    if (window.opener && !window.opener.closed) {
      try {
        window.opener.postMessage(
          {
            type: 'PAYMENT_SUCCESS_OPEN_LOYALTY',
            payload
          },
          window.location.origin
        );
        forwardToParent = true;
      } catch (error) {
        console.error('Unable to notify opener about loyalty action:', error);
      }
    }

    if (forwardToParent) {
      notifyParentAboutClose();
      window.close();
      return;
    }

    navigate('/danh-muc-khach-hang', {
      state: {
        fromPaymentSuccess: true,
        loyaltyPrefill: payload.loyaltyCustomer,
        invoiceCode: payload.invoiceCode,
        pointsEarned: payload.pointsEarned
      }
    });
  }, [navigate, notifyParentAboutClose, result]);

  useEffect(() => {
    const handleBeforeUnload = () => {
      notifyParentAboutClose();
    };

    window.addEventListener('beforeunload', handleBeforeUnload);
    return () => {
      window.removeEventListener('beforeunload', handleBeforeUnload);
    };
  }, [notifyParentAboutClose]);

  const handleCloseWindow = useCallback(() => {
    notifyParentAboutClose();
    window.close();
  }, [notifyParentAboutClose]);

  // Auto close functionality
  useEffect(() => {
    const timeoutSetting = localStorage.getItem('pmbh_payment_success_timeout');
    const timeoutEnabled = localStorage.getItem('pmbh_payment_success_timeout_enabled');
    const timeoutSeconds = timeoutSetting ? parseInt(timeoutSetting, 10) : 10;
    const isEnabled = timeoutEnabled !== 'false'; // Mặc định true nếu chưa set

    if (timeoutSeconds > 0 && isEnabled) {
      setCountdown(timeoutSeconds);

      const interval = setInterval(() => {
        setCountdown(prev => {
          if (prev <= 1) {
            clearInterval(interval);
            handleCloseWindow();
            return 0;
          }
          return prev - 1;
        });
      }, 1000);

      return () => clearInterval(interval);
    }
  }, [handleCloseWindow]);

  return (
    <div className="payment-success-container">
      <Card className="payment-success-card">
        <Result
          icon={<CheckCircle size={72} color="#52c41a" />}
          status="success"
          title="Thanh toán thành công!"
          subTitle={
            countdown !== null && countdown > 0 
              ? `Giao dịch đã được xác nhận. Cửa sổ sẽ tự động đóng sau ${countdown} giây.`
              : 'Giao dịch đã được xác nhận.'
          }
          extra={[
            <Button key="loyalty" onClick={handleLoyaltyClick}>
              Tich diem
            </Button>,
            <Button type="primary" key="close" onClick={handleCloseWindow}>
              Đóng cửa sổ
            </Button>,
          ]}
        />

        <Card
          title="Chi tiết giao dịch"
          className="transaction-details"
          style={{ marginTop: 24 }}
        >
          <Descriptions column={1} bordered size="small">
            <Descriptions.Item label="Mã giao dịch">
              <Text code>{result.txnRef || '—'}</Text>
            </Descriptions.Item>

            <Descriptions.Item label="Số tiền">
              <Text strong style={{ color: '#1890ff' }}>
                {formatAmount(result.amount)}
              </Text>
            </Descriptions.Item>

            <Descriptions.Item label="Mã đơn hàng">
              {result.orderInfo || '—'}
            </Descriptions.Item>

            <Descriptions.Item label="Phương thức thanh toán">
              {result.paymentMethod || 'Online'}
            </Descriptions.Item>

            {result.discount > 0 && (
              <Descriptions.Item label="Giảm giá">
                <Text type="danger">
                  -{formatAmount(result.discount)} ({result.discountType === 'percent' ? '%' : 'VNĐ'})
                </Text>
              </Descriptions.Item>
            )}

            <Descriptions.Item label="Tiền khách đưa">
              {formatAmount(result.tienKhachDua)}
            </Descriptions.Item>

            <Descriptions.Item label="Tiền thừa">
              {formatAmount(result.tienThua)}
            </Descriptions.Item>

            {result.ghiChu && (
              <Descriptions.Item label="Ghi chú">
                {result.ghiChu}
              </Descriptions.Item>
            )}

            {result.payDate && (
              <Descriptions.Item label="Thời gian thanh toán">
                {formatPayDate(result.payDate)}
              </Descriptions.Item>
            )}
          </Descriptions>
        </Card>

        <Card
          size="small"
          className="notice-card"
          style={{ marginTop: 16, background: '#f6ffed', border: '1px solid #b7eb8f' }}
        >
          <Text strong style={{ color: '#389e0d', display: 'block', marginBottom: 4 }}>
            Lưu ý:
          </Text>
          <Text type="secondary" style={{ fontSize: 12 }}>
            Vui lòng giữ lại biên nhận hoặc chụp màn hình trang này để đối chiếu khi cần thiết.
          </Text>
        </Card>
      </Card>
    </div>
  );
};

export default PaymentSuccess;


