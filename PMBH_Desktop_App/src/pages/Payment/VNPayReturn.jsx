import React, { useEffect, useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import { Result, Button, Spin, Card, Descriptions, Typography } from 'antd';
import { CheckCircle, XCircle, AlertCircle } from 'lucide-react';
import { 
  verifyVNPayReturnUrl, 
  getVNPayResponseMessage, 
  logVNPayTransaction 
} from '../../services/vnpayService';
import './VNPayReturn.css';

const { Text } = Typography;

/**
 * VNPay Return Page
 * Xử lý kết quả trả về sau khi thanh toán VNPay
 */
const VNPayReturn = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [loading, setLoading] = useState(true);
  const [paymentResult, setPaymentResult] = useState(null);

  useEffect(() => {
    processReturnUrl();
  }, [location.search]);

  /**
   * Xử lý URL trả về từ VNPay
   */
  const processReturnUrl = async () => {
    try {
      setLoading(true);

      // Parse query parameters
      const searchParams = new URLSearchParams(location.search);
      const queryParams = {};
      
      for (const [key, value] of searchParams.entries()) {
        queryParams[key] = value;
      }

      // Log query params
      console.log('VNPay Return URL Query Params:', queryParams);

      // Xác thực chữ ký
      const verification = verifyVNPayReturnUrl(queryParams);

      if (!verification.isValid) {
        setPaymentResult({
          success: false,
          message: 'Chữ ký không hợp lệ. Giao dịch có thể bị giả mạo.',
          status: 'error',
        });
        
        // Log giao dịch thất bại
        logVNPayTransaction({
          action: 'RETURN_INVALID_SIGNATURE',
          queryParams,
          verification,
        });
        
        setLoading(false);
        return;
      }

      // Lấy thông tin giao dịch
      const {
        vnp_TxnRef,
        vnp_Amount,
        vnp_OrderInfo,
        vnp_ResponseCode,
        vnp_TransactionNo,
        vnp_BankCode,
        vnp_BankTranNo,
        vnp_CardType,
        vnp_PayDate,
        vnp_TransactionStatus,
      } = queryParams;

      const amount = parseInt(vnp_Amount) / 100; // Chia cho 100 để lấy số tiền thực
      const isSuccess = vnp_ResponseCode === '00' && vnp_TransactionStatus === '00';

      const result = {
        success: isSuccess,
        message: getVNPayResponseMessage(vnp_ResponseCode),
        status: isSuccess ? 'success' : 'error',
        txnRef: vnp_TxnRef,
        amount,
        orderInfo: vnp_OrderInfo,
        responseCode: vnp_ResponseCode,
        transactionNo: vnp_TransactionNo,
        bankCode: vnp_BankCode,
        bankTranNo: vnp_BankTranNo,
        cardType: vnp_CardType,
        payDate: vnp_PayDate,
        transactionStatus: vnp_TransactionStatus,
      };

      setPaymentResult(result);

      // Log giao dịch
      logVNPayTransaction({
        action: 'RETURN_PROCESSED',
        result,
        queryParams,
      });

      // TODO: Gửi kết quả lên server để cập nhật database
      // await updatePaymentStatus(result);

      if (isSuccess) {
        // TODO: Cập nhật trạng thái hóa đơn trong database
        console.log('Payment successful, updating invoice status...');
        
        // Có thể gọi API để cập nhật
        // await updateInvoicePaymentStatus(vnp_TxnRef, result);
      }
    } catch (error) {
      console.error('Error processing VNPay return URL:', error);
      setPaymentResult({
        success: false,
        message: 'Có lỗi xảy ra khi xử lý kết quả thanh toán',
        status: 'error',
      });
    } finally {
      setLoading(false);
    }
  };

  /**
   * Format ngày giờ từ VNPay (yyyyMMddHHmmss)
   */
  const formatPayDate = (payDate) => {
    if (!payDate || payDate.length !== 14) return payDate;
    
    const year = payDate.substring(0, 4);
    const month = payDate.substring(4, 6);
    const day = payDate.substring(6, 8);
    const hour = payDate.substring(8, 10);
    const minute = payDate.substring(10, 12);
    const second = payDate.substring(12, 14);
    
    return `${day}/${month}/${year} ${hour}:${minute}:${second}`;
  };

  /**
   * Quay lại trang bán hàng
   */
  const handleBackToSales = () => {
    navigate('/ban-hang');
  };

  /**
   * In hóa đơn
   */
  const handlePrintReceipt = () => {
    // TODO: Implement print receipt
    console.log('Print receipt for:', paymentResult.txnRef);
  };

  if (loading) {
    return (
      <div className="vnpay-return-loading">
        <Spin size="large" tip="Đang xử lý kết quả thanh toán..." />
      </div>
    );
  }

  return (
    <div className="vnpay-return-container">
      <Card className="vnpay-return-card">
        {paymentResult?.success ? (
          <Result
            icon={<CheckCircle size={72} color="#52c41a" />}
            status="success"
            title="Thanh toán thành công!"
            subTitle={paymentResult.message}
            extra={[
              <Button type="primary" key="print" onClick={handlePrintReceipt}>
                In hóa đơn
              </Button>,
              <Button key="back" onClick={handleBackToSales}>
                Quay lại bán hàng
              </Button>,
            ]}
          />
        ) : (
          <Result
            icon={<XCircle size={72} color="#ff4d4f" />}
            status="error"
            title="Thanh toán thất bại"
            subTitle={paymentResult?.message || 'Có lỗi xảy ra'}
            extra={[
              <Button type="primary" key="retry" onClick={handleBackToSales}>
                Thử lại
              </Button>,
            ]}
          />
        )}

        {/* Chi tiết giao dịch */}
        {paymentResult && (
          <Card 
            title="Chi tiết giao dịch" 
            className="transaction-details"
            style={{ marginTop: 24 }}
          >
            <Descriptions column={1} bordered size="small">
              <Descriptions.Item label="Mã giao dịch">
                <Text code>{paymentResult.txnRef}</Text>
              </Descriptions.Item>
              
              <Descriptions.Item label="Số tiền">
                <Text strong style={{ color: '#1890ff' }}>
                  {paymentResult.amount?.toLocaleString('vi-VN')} VNĐ
                </Text>
              </Descriptions.Item>
              
              <Descriptions.Item label="Mô tả">
                {paymentResult.orderInfo}
              </Descriptions.Item>
              
              {paymentResult.transactionNo && (
                <Descriptions.Item label="Mã giao dịch VNPay">
                  {paymentResult.transactionNo}
                </Descriptions.Item>
              )}
              
              {paymentResult.bankCode && (
                <Descriptions.Item label="Ngân hàng">
                  {paymentResult.bankCode}
                </Descriptions.Item>
              )}
              
              {paymentResult.bankTranNo && (
                <Descriptions.Item label="Mã giao dịch NH">
                  {paymentResult.bankTranNo}
                </Descriptions.Item>
              )}
              
              {paymentResult.cardType && (
                <Descriptions.Item label="Loại thẻ">
                  {paymentResult.cardType}
                </Descriptions.Item>
              )}
              
              {paymentResult.payDate && (
                <Descriptions.Item label="Thời gian thanh toán">
                  {formatPayDate(paymentResult.payDate)}
                </Descriptions.Item>
              )}
              
              <Descriptions.Item label="Mã phản hồi">
                <Text code>{paymentResult.responseCode}</Text>
              </Descriptions.Item>
              
              <Descriptions.Item label="Trạng thái">
                <Text type={paymentResult.success ? 'success' : 'danger'}>
                  {paymentResult.success ? 'Thành công' : 'Thất bại'}
                </Text>
              </Descriptions.Item>
            </Descriptions>
          </Card>
        )}

        {/* Lưu ý */}
        <Card 
          size="small" 
          className="notice-card"
          style={{ marginTop: 16, background: '#e6f7ff', border: '1px solid #91d5ff' }}
        >
          <div style={{ display: 'flex', gap: 8 }}>
            <AlertCircle size={16} color="#1890ff" style={{ flexShrink: 0, marginTop: 2 }} />
            <div>
              <Text strong style={{ color: '#1890ff', display: 'block', marginBottom: 4 }}>
                Lưu ý:
              </Text>
              <Text type="secondary" style={{ fontSize: 12 }}>
                {paymentResult?.success 
                  ? 'Giao dịch đã được xác nhận. Vui lòng lưu lại thông tin để đối chiếu.'
                  : 'Nếu tiền đã bị trừ nhưng giao dịch thất bại, vui lòng liên hệ bộ phận hỗ trợ.'
                }
              </Text>
            </div>
          </div>
        </Card>
      </Card>
    </div>
  );
};

export default VNPayReturn;
