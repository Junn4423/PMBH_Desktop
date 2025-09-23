import React from 'react';
import { Button, message } from 'antd';
import { Printer } from 'lucide-react';

const ReceiptPrinter = ({ invoice, invoiceDetails, orderTotal, paymentDetails }) => {
  
  const generateReceiptContent = () => {
    const now = new Date();
    const receiptData = {
      header: {
        storeName: "POS CAFE SYSTEM",
        address: "Địa chỉ cửa hàng",
        phone: "0123-456-789",
        date: now.toLocaleDateString('vi-VN'),
        time: now.toLocaleTimeString('vi-VN'),
        invoiceNumber: invoice?.maHd || 'N/A',
        tableName: invoice?.tenBan || 'N/A'
      },
      items: invoiceDetails.map(item => ({
        name: item.tenSp || item.ten || 'Unknown',
        quantity: item.soLuong || 1,
        price: parseFloat(item.gia || item.giaBan || 0),
        total: (item.soLuong || 1) * parseFloat(item.gia || item.giaBan || 0)
      })),
      totals: {
        subtotal: orderTotal,
        tax: 0, // Add tax calculation if needed
        total: orderTotal,
        paid: paymentDetails?.tienKhachDua || orderTotal,
        change: paymentDetails?.tienThua || 0
      },
      payment: {
        method: paymentDetails?.phuongThucThanhToan || 'cash',
        notes: paymentDetails?.ghiChu || ''
      }
    };

    return receiptData;
  };

  const printReceipt = async () => {
    try {
      const receiptData = generateReceiptContent();
      
      // Create printable content
      const printContent = `
        <div style="width: 300px; font-family: monospace; font-size: 12px; line-height: 1.4;">
          <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="margin: 0; font-size: 16px;">${receiptData.header.storeName}</h2>
            <p style="margin: 2px 0;">${receiptData.header.address}</p>
            <p style="margin: 2px 0;">ĐT: ${receiptData.header.phone}</p>
            <p style="margin: 2px 0;">${receiptData.header.date} ${receiptData.header.time}</p>
          </div>
          
          <div style="border-top: 1px dashed #000; padding-top: 10px; margin-bottom: 10px;">
            <p style="margin: 2px 0;"><strong>Hóa đơn: ${receiptData.header.invoiceNumber}</strong></p>
            <p style="margin: 2px 0;"><strong>Bàn: ${receiptData.header.tableName}</strong></p>
          </div>
          
          <div style="border-top: 1px dashed #000; padding-top: 10px;">
            ${receiptData.items.map(item => `
              <div style="margin-bottom: 8px;">
                <div>${item.name}</div>
                <div style="display: flex; justify-content: space-between;">
                  <span>${item.quantity} x ${item.price.toLocaleString('vi-VN')}đ</span>
                  <span>${item.total.toLocaleString('vi-VN')}đ</span>
                </div>
              </div>
            `).join('')}
          </div>
          
          <div style="border-top: 1px dashed #000; padding-top: 10px; margin-top: 10px;">
            <div style="display: flex; justify-content: space-between; margin: 2px 0;">
              <span>Tạm tính:</span>
              <span>${receiptData.totals.subtotal.toLocaleString('vi-VN')}đ</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin: 2px 0; font-weight: bold; font-size: 14px;">
              <span>Tổng cộng:</span>
              <span>${receiptData.totals.total.toLocaleString('vi-VN')}đ</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin: 2px 0;">
              <span>Tiền khách đưa:</span>
              <span>${receiptData.totals.paid.toLocaleString('vi-VN')}đ</span>
            </div>
            ${receiptData.totals.change > 0 ? `
              <div style="display: flex; justify-content: space-between; margin: 2px 0;">
                <span>Tiền thối:</span>
                <span>${receiptData.totals.change.toLocaleString('vi-VN')}đ</span>
              </div>
            ` : ''}
          </div>
          
          <div style="border-top: 1px dashed #000; padding-top: 10px; margin-top: 10px; text-align: center;">
            <p style="margin: 2px 0;">Phương thức: ${getPaymentMethodText(receiptData.payment.method)}</p>
            ${receiptData.payment.notes ? `<p style="margin: 2px 0;">Ghi chú: ${receiptData.payment.notes}</p>` : ''}
            <p style="margin: 10px 0 2px 0;">Cảm ơn quý khách!</p>
            <p style="margin: 2px 0;">Hẹn gặp lại!</p>
          </div>
        </div>
      `;

      // Open print window
      const printWindow = window.open('', '_blank');
      printWindow.document.write(`
        <html>
          <head>
            <title>Hóa đơn ${receiptData.header.invoiceNumber}</title>
            <style>
              body { margin: 0; padding: 20px; }
              @media print {
                body { margin: 0; padding: 0; }
              }
            </style>
          </head>
          <body>
            ${printContent}
            <script>
              window.onload = function() {
                window.print();
                window.onafterprint = function() {
                  window.close();
                };
              };
            </script>
          </body>
        </html>
      `);
      printWindow.document.close();
      
      message.success('Đã gửi lệnh in hóa đơn');
      
    } catch (error) {
      console.error('Print error:', error);
      message.error('Không thể in hóa đơn: ' + error.message);
    }
  };

  const getPaymentMethodText = (method) => {
    const methods = {
      cash: 'Tiền mặt',
      card: 'Thẻ',
      transfer: 'Chuyển khoản',
      ewallet: 'Ví điện tử'
    };
    return methods[method] || method;
  };

  return (
    <Button
      icon={<Printer size={16} />}
      onClick={printReceipt}
      type="default"
    >
      In hóa đơn
    </Button>
  );
};

export default ReceiptPrinter;