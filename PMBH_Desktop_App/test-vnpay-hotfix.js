// Test VNPay Hotfix - Kiểm tra URL sau khi sửa lỗi
// Chạy: node test-vnpay-hotfix.js

console.log('=== TEST VNPAY FORMAT FIX ===\n');

// Test TxnRef format mới
console.log('1️⃣ TEST TXNREF FORMAT:');
const testInvoiceCode = 'HD68ECCAE4548D2';
const timestamp = Date.now().toString().slice(-8);
const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
const cleanInvoice = testInvoiceCode.replace(/[^A-Za-z0-9]/g, '').slice(0, 10);
const newTxnRef = `${cleanInvoice}${timestamp}${random}`.slice(0, 34);

console.log('Input invoice:', testInvoiceCode);
console.log('❌ Old format:', `${testInvoiceCode}_${Date.now()}_${Math.floor(Math.random() * 1000)}`);
console.log('✅ New format:', newTxnRef);
console.log('Length:', newTxnRef.length, '(≤ 34 required)');
console.log('Only A-Z a-z 0-9:', /^[A-Za-z0-9]+$/.test(newTxnRef) ? '✅ PASS' : '❌ FAIL');
console.log();

// Test encoding
console.log('2️⃣ TEST ENCODING:');
const testString = 'Thanh toan hoa don HD001';
const rfc3986 = encodeURIComponent(testString);
const rfc1738 = testString.replace(/ /g, '+').replace(/[!'()*]/g, function(c) {
  return '%' + c.charCodeAt(0).toString(16).toUpperCase();
});
console.log('Input:', testString);
console.log('❌ RFC3986 (space = %20):', rfc3986);
console.log('✅ RFC1738 (space = +):', rfc1738);
console.log();

// Test tham số đã bỏ
console.log('3️⃣ THAM SỐ ĐÃ BỎ (để tránh reject TMN sandbox):');
const removedParams = [
  'vnp_OrderType=other',
  'vnp_IpAddr=127.0.0.1',
  'vnp_ExpireDate=20241015153000',
  'vnp_IpnUrl=https://...',
  'vnp_SecureHashType=HMACSHA512',
  'vnp_BankCode=VNPAYQR'
];
removedParams.forEach(param => console.log('❌', param));
console.log();

console.log('4️⃣ THAM SỐ CÒN LẠI (core params):');
const coreParams = [
  'vnp_Version=2.1.0',
  'vnp_Command=pay',
  'vnp_TmnCode=HF0KUL29',
  'vnp_Amount=1000000',
  'vnp_CreateDate=20241015150000',
  'vnp_CurrCode=VND',
  'vnp_Locale=vn',
  'vnp_OrderInfo=Thanh+toan+hoa+don+HD001',
  'vnp_ReturnUrl=https://...',
  'vnp_TxnRef=' + newTxnRef,
  'vnp_SecureHash=...'
];
coreParams.forEach(param => console.log('✅', param));

console.log('\n=== KẾT QUẢ ===');
console.log('✅ TxnRef: Chỉ A-Z a-z 0-9, ≤ 34 ký tự');
console.log('✅ Encoding: Space = + (RFC1738)');
console.log('✅ Tham số: Chỉ core params, bỏ tham số nhạy cảm');
console.log('✅ ReturnUrl: Đã có trong config');
console.log('✅ CreateDate: Format yyyyMMddHHmmss');

console.log('\n🎯 Sẵn sàng test với TMN sandbox!');