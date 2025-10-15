/**
 * VNPay Payment Test Script
 * Kiểm tra các tham số VNPay có đúng định dạng không
 */

import { createVNPayPaymentUrl } from './src/services/vnpayService.js';

// Test data
const testInvoice = {
  maHd: 'HD001',
  tongTien: 100000,
  moTa: 'Test thanh toan hoa don',
};

console.log('🧪 Testing VNPay Payment URL Generation...\n');

try {
  const result = createVNPayPaymentUrl(testInvoice, true);
  
  if (result.success) {
    console.log('✅ Payment URL created successfully!');
    console.log('\n📋 Payment Details:');
    console.log('  TxnRef:', result.txnRef);
    console.log('  Amount:', result.amount, 'VNĐ');
    console.log('  Create Date:', result.createDate);
    console.log('\n🔗 Payment URL:');
    console.log(result.paymentUrl);
    console.log('\n✅ Test completed successfully!');
  } else {
    console.error('❌ Error:', result.error);
  }
} catch (error) {
  console.error('❌ Test failed:', error.message);
}
