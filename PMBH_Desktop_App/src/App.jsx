import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { Layout } from 'antd';
import { useAuth } from './contexts/AuthContext';
import DangNhap from './auth/DangNhap';
import TrangChu from './pages/TrangChu/TrangChu';
import BanHang from './pages/BanHang/BanHang';
import KitchenSystem from './pages/BepBar/BepBar';
import QuanLyBan from './pages/QuanLyBan/QuanLyBan';
import ThucDon from './pages/ThucDon/ThucDon';
import KhachHang from './pages/KhachHang/KhachHang';
import NhanVien from './pages/NhanVien/NhanVien';
import BaoCao from './pages/BaoCao/BaoCao';
import CaiDat from './pages/CaiDat/CaiDat';
import BepBar from './pages/BepBar/BepBar';
import ChiKhac from './pages/ChiKhac/ChiKhac';
import CongTy from './pages/CongTy/CongTy';
import BangDieuKhienNguoiDung from './pages/BangDieuKhienNguoiDung/BangDieuKhienNguoiDung';
import PhieuChi from './pages/PhieuChi/PhieuChi';
import KiemKho from './pages/KiemKho/KiemKho';
import PhongBan from './pages/PhongBan/PhongBan';
import NhomNguoiDung from './pages/NhomNguoiDung/NhomNguoiDung';
import ChonKhoQuanLy from './pages/ChonKhoQuanLy/ChonKhoQuanLy';
import TaiKhoanMB from './pages/TaiKhoanMB/TaiKhoanMB';
import NhapChi from './pages/NhapChi/NhapChi';
import CanhBaoMaxMin from './pages/CanhBaoMaxMin/CanhBaoMaxMin';
import DonVi from './pages/DonVi/DonVi';
import ChuongTrinhKinhDoanh from './pages/ChuongTrinhKinhDoanh/ChuongTrinhKinhDoanh';
import NguoiDangKy from './pages/NguoiDangKy/NguoiDangKy';
import ChoNguoiQuanLy from './pages/ChoNguoiQuanLy/ChoNguoiQuanLy';
import NhanVienCongTy from './pages/NhanVienCongTy/NhanVienCongTy';
import BcChiTien from './pages/BcChiTien/BcChiTien';
import BcChiTienNhapKho from './pages/BcChiTienNhapKho/BcChiTienNhapKho';
import NhapBanHang from './pages/NhapBanHang/NhapBanHang';
import ChoNhaBep from './pages/ChoNhaBep/ChoNhaBep';
import ChoQuayBar from './pages/ChoQuayBar/ChoQuayBar';
import BcBanHang from './pages/BcBanHang/BcBanHang';
import BcTong from './pages/BcTong/BcTong';
import BaoCaoGiaoCa from './pages/BaoCaoGiaoCa/BaoCaoGiaoCa';
import BcNhapKho from './pages/BcNhapKho/BcNhapKho';
import BaoTonMobil from './pages/BaoTonMobil/BaoTonMobil';
import NhapKhoMb from './pages/NhapKhoMb/NhapKhoMb';
import KiemKhoMb from './pages/KiemKhoMb/KiemKhoMb';
import LoaiSanPham from './pages/LoaiSanPham/LoaiSanPham';
import SanPham from './pages/SanPham/SanPham';
import TangNhaHang from './pages/TangNhaHang/TangNhaHang';
import BanNhaHang from './pages/BanNhaHang/BanNhaHang';
import Kho from './pages/Kho/Kho';
import NhapKho from './pages/NhapKho/NhapKho';
import XuatKho from './pages/XuatKho/XuatKho';
import BaoCaoTheoDieuKien from './pages/BaoCaoTheoDieuKien/BaoCaoTheoDieuKien';
import DanhMucKhachHang from './pages/DanhMucKhachHang/DanhMucKhachHang';
import CauHinhQuanLyNhaHang from './pages/CauHinhQuanLyNhaHang/CauHinhQuanLyNhaHang';
import XemThongTinXoaDonHang from './pages/XemThongTinXoaDonHang/XemThongTinXoaDonHang';
import ChoNhaBepQl from './pages/ChoNhaBepQl/ChoNhaBepQl';
import ChoQuayBarQl from './pages/ChoQuayBarQl/ChoQuayBarQl';
import BaoCaoDoanhThuKhachHang from './pages/BaoCaoDoanhThuKhachHang/BaoCaoDoanhThuKhachHang';
import QuanLyBanNhaHang from './pages/QuanLyBanNhaHang/QuanLyBanNhaHang';
import SidebarMenu from './components/Layout/SidebarMenu/SidebarMenu';
import HeaderBar from './components/Layout/HeaderBar/HeaderBar';

const { Sider, Content } = Layout;

function App() {
  const { isAuthenticated } = useAuth();

  if (!isAuthenticated) {
    return <DangNhap />;
  }

  return (
    <Layout style={{ minHeight: '100vh' }}>
      <Sider width={250} theme="light">
        <SidebarMenu />
      </Sider>
      <Layout>
        <HeaderBar />
        <Content style={{ padding: '20px', background: '#f0f2f5' }}>
          <Routes>
            <Route path="/" element={<Navigate to="/trang-chu" replace />} />
            <Route path="/trang-chu" element={<TrangChu />} />
            <Route path="/ban-hang" element={<BanHang />} />
            <Route path="/kitchen-system" element={<KitchenSystem />} />
            <Route path="/bep-bar" element={<BepBar />} />
            <Route path="/chi-khac" element={<ChiKhac />} />
            <Route path="/quan-ly-ban" element={<QuanLyBan />} />
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
          </Routes>
        </Content>
      </Layout>
    </Layout>
  );
}

export default App;
