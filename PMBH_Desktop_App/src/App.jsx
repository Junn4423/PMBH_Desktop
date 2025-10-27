import React, { Suspense } from 'react';
import { Routes, Route, Navigate, useLocation } from 'react-router-dom';
import { Layout, Spin } from 'antd';
import { useAuth } from './contexts/AuthContext';
import { LanguageProvider } from './contexts/LanguageContext';
import DangNhap from './auth/DangNhap';
import SidebarMenu from './components/Layout/SidebarMenu/SidebarMenu';
import HeaderBar from './components/Layout/HeaderBar/HeaderBar';

// Lazy load all page components
const TrangChu = React.lazy(() => import('./pages/TrangChu/TrangChu'));
const BanHang = React.lazy(() => import('./pages/BanHang/BanHang'));
const KitchenSystem = React.lazy(() => import('./pages/BepBar/BepBar'));
const QuanLyBanNhaHang = React.lazy(() => import('./pages/QuanLyBanNhaHang/QuanLyBanNhaHang'));
const ThucDon = React.lazy(() => import('./pages/ThucDon/ThucDon'));
const KhachHang = React.lazy(() => import('./pages/KhachHang/KhachHang'));
const NhanVien = React.lazy(() => import('./pages/NhanVien/NhanVien'));
const BaoCao = React.lazy(() => import('./pages/BaoCao/BaoCao'));
const CaiDat = React.lazy(() => import('./pages/CaiDat/CaiDat'));
const BepBar = React.lazy(() => import('./pages/BepBar/BepBar'));
const ChiKhac = React.lazy(() => import('./pages/ChiKhac/ChiKhac'));
const CongTy = React.lazy(() => import('./pages/CongTy/CongTy'));
const BangDieuKhienNguoiDung = React.lazy(() => import('./pages/BangDieuKhienNguoiDung/BangDieuKhienNguoiDung'));
const PhieuChi = React.lazy(() => import('./pages/PhieuChi/PhieuChi'));
const KiemKho = React.lazy(() => import('./pages/KiemKho/KiemKho'));
const PhongBan = React.lazy(() => import('./pages/PhongBan/PhongBan'));
const NhomNguoiDung = React.lazy(() => import('./pages/NhomNguoiDung/NhomNguoiDung'));
const ChonKhoQuanLy = React.lazy(() => import('./pages/ChonKhoQuanLy/ChonKhoQuanLy'));
const TaiKhoanMB = React.lazy(() => import('./pages/TaiKhoanMB/TaiKhoanMB'));
const NhapChi = React.lazy(() => import('./pages/NhapChi/NhapChi'));
const CanhBaoMaxMin = React.lazy(() => import('./pages/CanhBaoMaxMin/CanhBaoMaxMin'));
const VNPayReturn = React.lazy(() => import('./pages/Payment/VNPayReturn'));
const MoMoReturn = React.lazy(() => import('./pages/Payment/MoMoReturn'));
const ZaloPayReturn = React.lazy(() => import('./pages/Payment/ZaloPayReturn'));
const DonVi = React.lazy(() => import('./pages/DonVi/DonVi'));
const VNPaySuccess = React.lazy(() => import('./pages/Payment/VNPaySuccess'));
const PaymentSuccess = React.lazy(() => import('./pages/Payment/PaymentSuccess'));
const ChuongTrinhKinhDoanh = React.lazy(() => import('./pages/ChuongTrinhKinhDoanh/ChuongTrinhKinhDoanh'));
const NguoiDangKy = React.lazy(() => import('./pages/NguoiDangKy/NguoiDangKy'));
const ChoNguoiQuanLy = React.lazy(() => import('./pages/ChoNguoiQuanLy/ChoNguoiQuanLy'));
const NhanVienCongTy = React.lazy(() => import('./pages/NhanVienCongTy/NhanVienCongTy'));
const BcChiTien = React.lazy(() => import('./pages/BcChiTien/BcChiTien'));
const BcChiTienNhapKho = React.lazy(() => import('./pages/BcChiTienNhapKho/BcChiTienNhapKho'));
const NhapBanHang = React.lazy(() => import('./pages/NhapBanHang/NhapBanHang'));
const ChoNhaBep = React.lazy(() => import('./pages/ChoNhaBep/ChoNhaBep'));
const ChoQuayBar = React.lazy(() => import('./pages/ChoQuayBar/ChoQuayBar'));
const BcBanHang = React.lazy(() => import('./pages/BcBanHang/BcBanHang'));
const BcTong = React.lazy(() => import('./pages/BcTong/BcTong'));
const BaoCaoGiaoCa = React.lazy(() => import('./pages/BaoCaoGiaoCa/BaoCaoGiaoCa'));
const BcNhapKho = React.lazy(() => import('./pages/BcNhapKho/BcNhapKho'));
const BaoTonMobil = React.lazy(() => import('./pages/BaoTonMobil/BaoTonMobil'));
const NhapKhoMb = React.lazy(() => import('./pages/NhapKhoMb/NhapKhoMb'));
const KiemKhoMb = React.lazy(() => import('./pages/KiemKhoMb/KiemKhoMb'));
const LoaiSanPham = React.lazy(() => import('./pages/LoaiSanPham/LoaiSanPham'));
const SanPham = React.lazy(() => import('./pages/SanPham/SanPham'));
const CustomerDisplay = React.lazy(() => import('./components/CustomerDisplay/CustomerDisplay'));
const TangNhaHang = React.lazy(() => import('./pages/TangNhaHang/TangNhaHang'));
const BanNhaHang = React.lazy(() => import('./pages/BanNhaHang/BanNhaHang'));
const Kho = React.lazy(() => import('./pages/Kho/Kho'));
const NhapKho = React.lazy(() => import('./pages/NhapKho/NhapKho'));
const XuatKho = React.lazy(() => import('./pages/XuatKho/XuatKho'));
const BaoCaoTheoDieuKien = React.lazy(() => import('./pages/BaoCaoTheoDieuKien/BaoCaoTheoDieuKien'));
const DanhMucKhachHang = React.lazy(() => import('./pages/DanhMucKhachHang/DanhMucKhachHang'));
const CauHinhQuanLyNhaHang = React.lazy(() => import('./pages/CauHinhQuanLyNhaHang/CauHinhQuanLyNhaHang'));
const XemThongTinXoaDonHang = React.lazy(() => import('./pages/XemThongTinXoaDonHang/XemThongTinXoaDonHang'));
const ChoNhaBepQl = React.lazy(() => import('./pages/ChoNhaBepQl/ChoNhaBepQl'));
const ChoQuayBarQl = React.lazy(() => import('./pages/ChoQuayBarQl/ChoQuayBarQl'));
const BaoCaoDoanhThuKhachHang = React.lazy(() => import('./pages/BaoCaoDoanhThuKhachHang/BaoCaoDoanhThuKhachHang'));

const { Sider, Content } = Layout;

function App() {
  const { isAuthenticated } = useAuth();
  const location = useLocation();
  
  // Check if current route is customer display
  const isCustomerDisplay = location.pathname === '/customer-display';
  const isVNPayReturn = location.pathname.startsWith('/payment/vnpay-return');
  const isVNPaySuccess = location.pathname.startsWith('/payment/vnpay-success');
  const isPaymentSuccess = location.pathname.startsWith('/payment/success');
  const isMoMoReturn = location.pathname.startsWith('/payment/momo-return');
  const isZaloPayReturn = location.pathname.startsWith('/payment/zalopay-return');
  const isStandalonePayment = isVNPayReturn || isVNPaySuccess || isPaymentSuccess || isMoMoReturn || isZaloPayReturn;
  // Customer Display without authentication - shown directly without login
  if (isCustomerDisplay) {
    return (
      <LanguageProvider>
        <Suspense fallback={<div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', height: '100vh' }}><Spin size="large" /></div>}>
          <Routes>
            <Route path="/customer-display" element={<CustomerDisplay />} />
          </Routes>
        </Suspense>
      </LanguageProvider>
    );
  }

  if (isStandalonePayment) {
    return (
      <LanguageProvider>
        <Suspense fallback={<div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', height: '100vh' }}><Spin size="large" /></div>}>
          <Routes>
            <Route path="/payment/vnpay-return" element={<VNPayReturn />} />
            <Route path="/payment/momo-return" element={<MoMoReturn />} />
            <Route path="/payment/zalopay-return" element={<ZaloPayReturn />} />
            <Route path="/payment/vnpay-success" element={<VNPaySuccess />} />
            <Route path="/payment/success" element={<PaymentSuccess />} />
          </Routes>
        </Suspense>
      </LanguageProvider>
    );
  }

  // Require authentication for all other routes
  if (!isAuthenticated) {
    return (
      <LanguageProvider>
        <DangNhap />
      </LanguageProvider>
    );
  }

  return (
    <LanguageProvider>
      <Layout style={{ minHeight: '100vh' }}>
      <SidebarMenu />
      <HeaderBar />
      <Layout>
        <Content 
          className="app-content" 
          style={{ 
            marginLeft: '250px', 
            marginTop: '64px', 
            padding: '20px',
            minHeight: 'calc(100vh - 64px)'
          }}
        >
          <Suspense fallback={<div style={{ display: 'flex', justifyContent: 'center', alignItems: 'center', height: '100vh' }}><Spin size="large" /></div>}>
            <Routes>
              <Route path="/" element={<Navigate to="/trang-chu" replace />} />
              <Route path="/trang-chu" element={<TrangChu />} />
              <Route path="/ban-hang" element={<BanHang />} />
              <Route path="/kitchen-system" element={<KitchenSystem />} />
              <Route path="/bep-bar" element={<BepBar />} />
              <Route path="/chi-khac" element={<ChiKhac />} />
              <Route path="/quan-ly-ban" element={<QuanLyBanNhaHang />} />
              <Route path="/thuc-don" element={<ThucDon />} />
              <Route path="/khach-hang" element={<KhachHang />} />
              <Route path="/nhan-vien" element={<NhanVien />} />
              <Route path="/bao-cao" element={<BaoCao />} />
              <Route path="/cai-dat" element={<CaiDat />} />
              
              {/* Routes cho mục chung */}
              <Route path="/cong-ty" element={<CongTy />} />
              <Route path="/bang-dieu-khien-nguoi-dung" element={<BangDieuKhienNguoiDung />} />
              <Route path="/giao-dien-mb" element={<TrangChu />} />
              <Route path="/dieu-khien-san-pham" element={<TrangChu />} />
              <Route path="/thiet-lap-tang-va-ban" element={<TrangChu />} />
              
              {/* Routes con cho Công ty */}
              <Route path="/phong-ban" element={<PhongBan />} />
              <Route path="/nhan-vien-cong-ty" element={<NhanVienCongTy />} />
              
              {/* Routes con cho Bảng điều khiển người dùng */}
              <Route path="/nhom-nguoi-dung" element={<NhomNguoiDung />} />
              <Route path="/chon-kho-quan-ly" element={<ChonKhoQuanLy />} />
              
              {/* Routes con cho Giao diện MB */}
              <Route path="/tai-khoan-mb" element={<TaiKhoanMB />} />
              <Route path="/bc-chi-tien" element={<BcChiTien />} />
              <Route path="/bc-chi-tien-nhap-kho" element={<BcChiTienNhapKho />} />
              <Route path="/nhap-chi" element={<NhapChi />} />
              <Route path="/nhap-ban-hang" element={<NhapBanHang />} />
              <Route path="/cho-nha-bep" element={<ChoNhaBep />} />
              <Route path="/cho-quay-bar" element={<ChoQuayBar />} />
              <Route path="/bc-ban-hang" element={<BcBanHang />} />
              <Route path="/bc-tong" element={<BcTong />} />
              <Route path="/bao-cao-giao-ca" element={<BaoCaoGiaoCa />} />
              <Route path="/bc-nhap-kho" element={<BcNhapKho />} />
              <Route path="/canh-bao-max-min" element={<CanhBaoMaxMin />} />
              <Route path="/bao-ton-mobil" element={<BaoTonMobil />} />
              <Route path="/nhap-kho-mb" element={<NhapKhoMb />} />
              <Route path="/kiem-kho-mb" element={<KiemKhoMb />} />
              
              {/* Routes con cho Điều khiển sản phẩm */}
              <Route path="/don-vi" element={<DonVi />} />
              <Route path="/loai-san-pham" element={<LoaiSanPham />} />
              <Route path="/san-pham" element={<SanPham />} />
              
              {/* Routes con cho Thiết lập tầng và bàn */}
              <Route path="/tang-nha-hang" element={<TangNhaHang />} />
              <Route path="/ban-nha-hang" element={<BanNhaHang />} />
              
              {/* Routes cho kế toán */}
              <Route path="/phieu-chi" element={<PhieuChi />} />
              
              {/* Routes cho quản lý kho */}
              <Route path="/kho" element={<Kho />} />
              <Route path="/kiem-kho" element={<KiemKho />} />
              <Route path="/nhap-kho" element={<NhapKho />} />
              <Route path="/xuat-kho" element={<XuatKho />} />
              <Route path="/bao-cao-theo-dieu-kien" element={<BaoCaoTheoDieuKien />} />
              
              {/* Routes cho kinh doanh */}
              <Route path="/danh-muc-khach-hang" element={<DanhMucKhachHang />} />
              <Route path="/quan-ly-ban-nha-hang" element={<QuanLyBanNhaHang />} />
              <Route path="/bao-cao-doanh-thu-khach-hang" element={<BaoCaoDoanhThuKhachHang />} />
              
              {/* Routes con cho Quản lý bán nhà hàng */}
              <Route path="/chuong-trinh-kinh-doanh" element={<ChuongTrinhKinhDoanh />} />
              <Route path="/cau-hinh-quan-ly-nha-hang" element={<CauHinhQuanLyNhaHang />} />
              <Route path="/xem-thong-tin-xoa-don-hang" element={<XemThongTinXoaDonHang />} />
              <Route path="/nguoi-dang-ky" element={<NguoiDangKy />} />
              <Route path="/cho-nguoi-quan-ly" element={<ChoNguoiQuanLy />} />
              <Route path="/cho-nha-bep-ql" element={<ChoNhaBepQl />} />
              <Route path="/cho-quay-bar-ql" element={<ChoQuayBarQl />} />
              <Route path="/payment/vnpay-return" element={<VNPayReturn />} />
              <Route path="/payment/momo-return" element={<MoMoReturn />} />
              <Route path="/payment/vnpay-success" element={<VNPaySuccess />} />
            </Routes>
          </Suspense>
        </Content>
      </Layout>
    </Layout>
    </LanguageProvider>
  );
}

export default App;


