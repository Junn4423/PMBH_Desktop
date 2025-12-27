import React, { useMemo, useEffect } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { Result, Button, Card, Descriptions, Typography } from 'antd';
import { CheckCircle } from 'lucide-react';
import './VNPayReturn.css';

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
  if (!payDate || payDate.length !== 14) {
    return payDate || '';
  }
  const year = payDate.substring(0, 4);
  const month = payDate.substring(4, 6);
  const day = payDate.substring(6, 8);
  const hour = payDate.substring(8, 10);
  const minute = payDate.substring(10, 12);
  const second = payDate.substring(12, 14);
  return `${day}/${month}/${year} ${hour}:${minute}:${second}`;
};

const VNPaySuccess = () => {
  const location = useLocation();
  const navigate = useNavigate();

  const query = useMemo(() => new URLSearchParams(location.search), [location.search]);

  const result = useMemo(() => {
    const stateResult = location.state?.paymentResult;
    if (stateResult) {
      return stateResult;
    }

    const amount = query.get('amount');
    const responseCode = query.get('responseCode') || query.get('vnp_ResponseCode') || '00';
    const transactionStatus =
      query.get('transactionStatus') || query.get('vnp_TransactionStatus') || '00';
    return {
      success: true,
      status: 'success',
      message: 'Giao dịch đã được xác nhận thành công.',
      txnRef: query.get('txnRef') || '',
      amount: amount !== null ? Number(amount) : undefined,
      orderInfo: query.get('orderInfo') || '',
      responseCode,
      vnp_ResponseCode: responseCode,
      transactionStatus,
      vnp_TransactionStatus: transactionStatus,
      bankCode: query.get('bankCode') || '',
      payDate: query.get('payDate') || '',
    };
  }, [location.state, query]);

  useEffect(() => {
    try {
      if (window.opener && !window.opener.closed) {
        window.opener.postMessage(
          {
            type: 'VNPAY_PAYMENT_RESULT',
            payload: result,
          },
          window.location.origin
        );
      }
    } catch (error) {
      console.error('Unable to post VNPay success message to opener:', error);
    }
  }, [result]);

  const handleCloseWindow = () => {
    if (window.opener && !window.opener.closed) {
      window.close();
    } else {
      navigate('/ban-hang', { replace: true });
    }
  };

  const handleViewOrders = () => {
    navigate('/ban-hang', { replace: true });
  };

  return (
    <div className="vnpay-return-container">
      <Card className="vnpay-return-card">
        <Result
          icon={<CheckCircle size={72} color="#52c41a" />}
          status="success"
          title="Thanh toán VNPay thành công!"
          subTitle={result.message || 'Giao dịch đã được xác nhận.'}
          extra={[
            <Button type="primary" key="close" onClick={handleCloseWindow}>
              Đóng cửa sổ
            </Button>,
            <Button key="orders" onClick={handleViewOrders}>
              Quay lại bán hàng
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

            <Descriptions.Item label="Mã phản hồi">
              <Text code>{result.responseCode || '00'}</Text>
            </Descriptions.Item>

            {result.bankCode && (
              <Descriptions.Item label="Ngân hàng">
                {result.bankCode}
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

export default VNPaySuccess;
