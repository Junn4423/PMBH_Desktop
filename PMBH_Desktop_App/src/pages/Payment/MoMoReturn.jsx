import React, { useEffect, useRef, useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { Result, Button, Spin, Card, Descriptions, Typography } from 'antd';
import { CheckCircle, XCircle, AlertCircle } from 'lucide-react';
import {
  verifyMoMoReturnSignature,
  getMoMoResultMessage,
  normalizeMoMoResultCode,
  logMoMoTransaction,
} from '../../services/momoService';
import './VNPayReturn.css';

const { Text } = Typography;

const MoMoReturn = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [loading, setLoading] = useState(true);
  const [paymentResult, setPaymentResult] = useState(null);
  const hasPostedResultRef = useRef(false);

  useEffect(() => {
    processReturnUrl();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [location.search]);

  const notifyParentWindow = (resultPayload, queryParams) => {
    if (typeof window === 'undefined' || hasPostedResultRef.current) {
      return;
    }

    const targetOrigin = window.location.origin;
    const message = {
      type: 'MOMO_PAYMENT_RESULT',
      payload: {
        ...resultPayload,
        rawQuery: queryParams,
      },
    };

    try {
      if (window.opener && !window.opener.closed) {
        window.opener.postMessage(message, targetOrigin);
        hasPostedResultRef.current = true;
        return;
      }

      if (window.parent && window.parent !== window) {
        window.parent.postMessage(message, targetOrigin);
        hasPostedResultRef.current = true;
      }
    } catch (error) {
      console.error('Unable to notify parent window about MoMo result:', error);
    }
  };

  const processReturnUrl = () => {
    setLoading(true);
    hasPostedResultRef.current = false;

    const searchParams = new URLSearchParams(location.search);
    const queryParams = {};
    for (const [key, value] of searchParams.entries()) {
      queryParams[key] = value;
    }

    logMoMoTransaction({
      action: 'RETURN_QUERY',
      queryParams,
    });

    const verification = verifyMoMoReturnSignature(queryParams);

    if (!verification.isValid) {
      const invalidResult = {
        success: false,
        message: 'Chu ky MoMo khong hop le. Giao dich co the bi thay doi.',
        status: 'error',
        resultCode: normalizeMoMoResultCode(queryParams.resultCode),
        orderId: queryParams.orderId,
        requestId: queryParams.requestId,
        transId: queryParams.transId,
        amount: Number(queryParams.amount || 0),
        payType: queryParams.payType,
      };

      setPaymentResult(invalidResult);
      notifyParentWindow(
        {
          ...invalidResult,
          verification,
          signature: queryParams.signature,
        },
        queryParams
      );
      setLoading(false);
      return;
    }

    const normalizedCode = normalizeMoMoResultCode(queryParams.resultCode);
    const isSuccess = normalizedCode === '0' || normalizedCode === '9000';
    const messageText = getMoMoResultMessage(normalizedCode);

    const resultPayload = {
      success: isSuccess,
      status: isSuccess ? 'success' : 'error',
      message: messageText,
      resultCode: normalizedCode,
      orderId: queryParams.orderId,
      requestId: queryParams.requestId,
      transId: queryParams.transId,
      amount: Number(queryParams.amount || 0),
      payType: queryParams.payType,
      orderInfo: queryParams.orderInfo,
      extraData: queryParams.extraData,
      signature: queryParams.signature,
      verification,
    };

    setPaymentResult(resultPayload);

    logMoMoTransaction({
      action: 'RETURN_RESULT',
      resultPayload,
    });

    notifyParentWindow(resultPayload, queryParams);
    setLoading(false);
  };

  const handleBackToSales = () => {
    if (window.opener && !window.opener.closed) {
      window.close();
    } else {
      navigate('/ban-hang');
    }
  };

  if (loading) {
    return (
      <div className="vnpay-return-loading">
        <Spin size="large" tip="Dang xu ly ket qua thanh toan..." />
      </div>
    );
  }

  if (!paymentResult) {
    return (
      <div className="vnpay-return-loading">
        <Result
          status="warning"
          title="Khong tim thay ket qua thanh toan MoMo"
          subTitle="Vui long dong cua so nay va thu lai tu ban hang."
          extra={[
            <Button type="primary" key="back" onClick={handleBackToSales}>
              Quay lai ban hang
            </Button>,
          ]}
        />
      </div>
    );
  }

  return (
    <div className="vnpay-return-container">
      <Card className="vnpay-return-card">
        {paymentResult.success ? (
          <Result
            icon={<CheckCircle size={72} color="#52c41a" />}
            status="success"
            title="Thanh toan MoMo thanh cong!"
            subTitle={paymentResult.message}
            extra={[
              <Button type="primary" key="back" onClick={handleBackToSales}>
                Quay lai ban hang
              </Button>,
            ]}
          />
        ) : (
          <Result
            icon={<XCircle size={72} color="#ff4d4f" />}
            status="error"
            title="Thanh toan MoMo that bai"
            subTitle={paymentResult.message || 'Co loi xay ra trong qua trinh thanh toan.'}
            extra={[
              <Button type="primary" key="retry" onClick={handleBackToSales}>
                Thu lai
              </Button>,
            ]}
          />
        )}

        {paymentResult && (
          <Card
            title="Chi tiet giao dich"
            className="transaction-details"
            style={{ marginTop: 24 }}
          >
            <Descriptions column={1} bordered size="small">
              <Descriptions.Item label="Ma don hang">
                <Text code>{paymentResult.orderId || 'N/A'}</Text>
              </Descriptions.Item>
              <Descriptions.Item label="Ma yeu cau">
                <Text code>{paymentResult.requestId || 'N/A'}</Text>
              </Descriptions.Item>
              <Descriptions.Item label="Ma giao dich MoMo">
                <Text code>{paymentResult.transId || 'N/A'}</Text>
              </Descriptions.Item>
              <Descriptions.Item label="So tien">
                <Text strong style={{ color: '#1890ff' }}>
                  {Number(paymentResult.amount || 0).toLocaleString('vi-VN')} VND
                </Text>
              </Descriptions.Item>
              <Descriptions.Item label="Ket qua">
                <Text type={paymentResult.success ? 'success' : 'danger'}>
                  {paymentResult.message}
                </Text>
              </Descriptions.Item>
              <Descriptions.Item label="Ma ket qua">
                <Text code>{paymentResult.resultCode}</Text>
              </Descriptions.Item>
              {paymentResult.payType && (
                <Descriptions.Item label="Hinh thuc thanh toan">
                  {paymentResult.payType}
                </Descriptions.Item>
              )}
              {paymentResult.orderInfo && (
                <Descriptions.Item label="Noi dung">
                  {paymentResult.orderInfo}
                </Descriptions.Item>
              )}
              {paymentResult.extraData && (
                <Descriptions.Item label="Extra Data">
                  <Text code>{paymentResult.extraData}</Text>
                </Descriptions.Item>
              )}
            </Descriptions>
          </Card>
        )}

        <Card
          size="small"
          className="notice-card"
          style={{ marginTop: 16, background: '#fff7e6', border: '1px solid #ffd591' }}
        >
          <div style={{ display: 'flex', gap: 8 }}>
            <AlertCircle size={16} color="#fa8c16" style={{ flexShrink: 0, marginTop: 2 }} />
            <div>
              <Text strong style={{ color: '#fa8c16', display: 'block', marginBottom: 4 }}>
                Luu y:
              </Text>
              <Text type="secondary" style={{ fontSize: 12 }}>
                {paymentResult.success
                  ? 'Giao dich da duoc xac nhan thanh cong. Vui long dong cua so nay neu he thong khong tu dong dong.'
                  : 'Neu ban nghi rang giao dich thanh cong nhung he thong thong bao that bai, vui long lien he bo phan ho tro.'}
              </Text>
            </div>
          </div>
        </Card>
      </Card>
    </div>
  );
};

export default MoMoReturn;

