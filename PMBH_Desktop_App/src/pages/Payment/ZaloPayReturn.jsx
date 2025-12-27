import React, { useEffect, useRef, useState, useCallback } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { Result, Button, Spin, Card, Descriptions, Typography } from 'antd';
import { CheckCircle, XCircle, AlertCircle } from 'lucide-react';
import {
  verifyZaloPayCallback,
  logZaloPayTransaction
} from '../../services/zaloPayService';
import './ZaloPayReturn.css';

const { Text } = Typography;

/**
 * ZaloPay Return Page
 * Xử lý kết quả trả về sau khi thanh toán ZaloPay
 */
const ZaloPayReturn = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [loading, setLoading] = useState(true);
  const [paymentResult, setPaymentResult] = useState(null);
  const hasPostedResultRef = useRef(false);

  const handleCloseWindow = useCallback(() => {
    if (typeof window === 'undefined') {
      navigate('/');
      return;
    }

    let closedViaScript = false;

    try {
      window.close();
      closedViaScript = true;
    } catch (error) {
      console.error('Unable to close ZaloPay return window directly:', error);
    }

    setTimeout(() => {
      try {
        if (closedViaScript) {
          return;
        }

        if (typeof window !== 'undefined' && window && window.closed) {
          return;
        }
      } catch (error) {
        // Ignore and fallback to navigation
      }

      navigate('/');
    }, 400);
  }, [navigate]);

  useEffect(() => {
    processReturnUrl();
  }, [location.search]);

  const notifyParentWindow = (resultPayload, queryParams) => {
    if (typeof window === 'undefined' || hasPostedResultRef.current) {
      return;
    }

    const targetOrigin = window.location.origin;
    const payload = {
      ...resultPayload,
      return_code: resultPayload.return_code || resultPayload.returnCode || '',
      return_message: resultPayload.return_message || resultPayload.returnMessage || '',
      sub_return_code: resultPayload.sub_return_code || resultPayload.subReturnCode || '',
      sub_return_message: resultPayload.sub_return_message || resultPayload.subReturnMessage || '',
      zp_trans_token: resultPayload.zp_trans_token || resultPayload.zpTransToken || '',
      order_url: resultPayload.order_url || resultPayload.orderUrl || '',
      app_trans_id: resultPayload.app_trans_id || resultPayload.appTransId || '',
    };

    const message = {
      type: 'ZALOPAY_PAYMENT_RESULT',
      payload: {
        ...payload,
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
      console.error('Unable to notify parent window about ZaloPay result:', error);
    }
  };

  /**
   * Xử lý URL trả về từ ZaloPay
   */
  const processReturnUrl = async () => {
    try {
      setLoading(true);
      hasPostedResultRef.current = false;

      // Parse query parameters
      const searchParams = new URLSearchParams(location.search);
      const queryParams = {};

      for (const [key, value] of searchParams.entries()) {
        queryParams[key] = value;
      }

      logZaloPayTransaction('RETURN_URL_RECEIVED', 'N/A', queryParams, {});

      // Verify the callback data
      const verificationResult = verifyZaloPayCallback(queryParams);

      const result = {
        success: verificationResult.isValid,
        return_code: queryParams.return_code || queryParams.returnCode || '1',
        return_message: queryParams.return_message || queryParams.returnMessage || '',
        sub_return_code: queryParams.sub_return_code || queryParams.subReturnCode || '',
        sub_return_message: queryParams.sub_return_message || queryParams.subReturnMessage || '',
        zp_trans_token: queryParams.zp_trans_token || queryParams.zpTransToken || '',
        order_url: queryParams.order_url || queryParams.orderUrl || '',
        app_trans_id: queryParams.app_trans_id || queryParams.appTransId || '',
        checksum: queryParams.checksum || '',
        verification: verificationResult,
      };

      setPaymentResult(result);

      // Notify parent window
      notifyParentWindow(result, queryParams);

      // Auto-close after a delay
      setTimeout(handleCloseWindow, 3000);

    } catch (error) {
      console.error('Error processing ZaloPay return URL:', error);
      setPaymentResult({
        success: false,
        error: error.message,
        return_code: '1',
        return_message: 'Có lỗi xảy ra khi xử lý kết quả thanh toán',
      });
    } finally {
      setLoading(false);
    }
  };

  const getResultStatus = () => {
    if (!paymentResult) return 'info';

    if (paymentResult.success && paymentResult.return_code === '1') {
      return 'success';
    }

    return 'error';
  };

  const getResultIcon = () => {
    const status = getResultStatus();

    switch (status) {
      case 'success':
        return <CheckCircle size={64} style={{ color: '#52c41a' }} />;
      case 'error':
        return <XCircle size={64} style={{ color: '#ff4d4f' }} />;
      default:
        return <AlertCircle size={64} style={{ color: '#faad14' }} />;
    }
  };

  const getResultTitle = () => {
    if (!paymentResult) return 'Đang xử lý...';

    if (paymentResult.success && paymentResult.return_code === '1') {
      return 'Thanh toán thành công!';
    }

    return 'Thanh toán thất bại';
  };

  const getResultMessage = () => {
    if (!paymentResult) return 'Vui lòng đợi trong giây lát.';

    if (paymentResult.success && paymentResult.return_code === '1') {
      return 'Giao dịch của bạn đã được xử lý thành công. Cửa sổ sẽ tự động đóng sau vài giây.';
    }

    return paymentResult.return_message || paymentResult.sub_return_message || 'Có lỗi xảy ra trong quá trình thanh toán.';
  };

  if (loading) {
    return (
      <div className="zalopay-return-container">
        <Card className="zalopay-return-card">
          <div className="zalopay-return-loading">
            <Spin size="large" />
            <Text className="zalopay-return-loading-text">
              Đang xử lý kết quả thanh toán ZaloPay...
            </Text>
          </div>
        </Card>
      </div>
    );
  }

  return (
    <div className="zalopay-return-container">
      <Card className="zalopay-return-card">
        <Result
          icon={getResultIcon()}
          title={getResultTitle()}
          subTitle={getResultMessage()}
          extra={[
            <Button
              key="close"
              type="primary"
              onClick={handleCloseWindow}
            >
              Đóng cửa sổ
            </Button>
          ]}
        />

        {paymentResult && (
          <div className="zalopay-return-details">
            <Descriptions
              title="Chi tiết giao dịch"
              bordered
              column={1}
              size="small"
            >
              <Descriptions.Item label="Mã giao dịch">
                {paymentResult.app_trans_id || 'N/A'}
              </Descriptions.Item>
              <Descriptions.Item label="Mã trả về">
                {paymentResult.return_code}
              </Descriptions.Item>
              <Descriptions.Item label="Thông báo">
                {paymentResult.return_message}
              </Descriptions.Item>
              {paymentResult.sub_return_code && (
                <Descriptions.Item label="Mã lỗi phụ">
                  {paymentResult.sub_return_code}
                </Descriptions.Item>
              )}
              {paymentResult.sub_return_message && (
                <Descriptions.Item label="Thông báo lỗi phụ">
                  {paymentResult.sub_return_message}
                </Descriptions.Item>
              )}
              {paymentResult.zp_trans_token && (
                <Descriptions.Item label="ZP Trans Token">
                  {paymentResult.zp_trans_token}
                </Descriptions.Item>
              )}
            </Descriptions>
          </div>
        )}
      </Card>
    </div>
  );
};

export default ZaloPayReturn;





