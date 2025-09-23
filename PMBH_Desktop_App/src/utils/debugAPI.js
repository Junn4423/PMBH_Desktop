// Debug utility to test API functions
import { 
  thanhToanHoaDonChiTiet,
  thanhToanHoaDonBanhang,
  capNhatTrangThaiDonHang,
  xacNhanDonHang,
  layTrangThaiDonHangRealtime,
  inHoaDonThanhToan
} from '../services/apiServices';

export const debugAPIFunctions = () => {
  console.log('=== DEBUG API FUNCTIONS ===');
  
  // Check if functions are defined
  console.log('thanhToanHoaDonChiTiet:', typeof thanhToanHoaDonChiTiet);
  console.log('capNhatTrangThaiDonHang:', typeof capNhatTrangThaiDonHang);
  console.log('xacNhanDonHang:', typeof xacNhanDonHang);
  console.log('layTrangThaiDonHangRealtime:', typeof layTrangThaiDonHangRealtime);
  console.log('inHoaDonThanhToan:', typeof inHoaDonThanhToan);
  
  return {
    thanhToanHoaDonChiTiet: typeof thanhToanHoaDonChiTiet === 'function',
    capNhatTrangThaiDonHang: typeof capNhatTrangThaiDonHang === 'function',
    xacNhanDonHang: typeof xacNhanDonHang === 'function',
    layTrangThaiDonHangRealtime: typeof layTrangThaiDonHangRealtime === 'function',
    inHoaDonThanhToan: typeof inHoaDonThanhToan === 'function'
  };
};

export const testPaymentAPI = async (testData) => {
  try {
    console.log('Testing payment API with data:', testData);
    
    // Test basic payment first
    const basicResult = await thanhToanHoaDonBanhang({
      maHd: testData.maHd,
      tongTien: testData.tongTien,
      tienKhachDua: testData.tienKhachDua,
      tienThua: testData.tienThua
    });
    
    console.log('Basic payment result:', basicResult);
    return basicResult;
    
  } catch (error) {
    console.error('Payment test failed:', error);
    throw error;
  }
};