import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { Layout } from 'antd';
import { useAuth } from './contexts/AuthContext';
import DangNhap from './pages/DangNhap/DangNhap';
import TrangChu from './pages/TrangChu/TrangChu';
import BanHang from './pages/BanHang/BanHang';
import QuanLyBan from './pages/QuanLyBan/QuanLyBan';
import ThucDon from './pages/ThucDon/ThucDon';
import KhachHang from './pages/KhachHang/KhachHang';
import NhanVien from './pages/NhanVien/NhanVien';
import BaoCao from './pages/BaoCao/BaoCao';
import CaiDat from './pages/CaiDat/CaiDat';
import SidebarMenu from './components/Layout/SidebarMenu/SidebarMenu';
import HeaderBar from './components/Layout/HeaderBar/HeaderBar';

// Import các features mới
import { 
  QuanLyTaiKhoan, 
  QuanLyKho, 
  QuanLyCaLamViec, 
  QuanLyLuong, 
  QuanLyThuChi, 
  QuanLyHoaDon, 
  BaoCaoThongKe, 
  CaiDatHeThong 
} from './features';

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
            <Route path="/quan-ly-ban" element={<QuanLyBan />} />
            <Route path="/thuc-don" element={<ThucDon />} />
            <Route path="/khach-hang" element={<KhachHang />} />
            <Route path="/nhan-vien" element={<NhanVien />} />
            <Route path="/bao-cao" element={<BaoCao />} />
            <Route path="/cai-dat" element={<CaiDat />} />
            
            {/* Routes cho các features mới */}
            <Route path="/quan-ly-tai-khoan" element={<QuanLyTaiKhoan />} />
            <Route path="/quan-ly-kho" element={<QuanLyKho />} />
            <Route path="/quan-ly-ca-lam-viec" element={<QuanLyCaLamViec />} />
            <Route path="/quan-ly-luong" element={<QuanLyLuong />} />
            <Route path="/quan-ly-thu-chi" element={<QuanLyThuChi />} />
            <Route path="/quan-ly-hoa-don" element={<QuanLyHoaDon />} />
            <Route path="/bao-cao-thong-ke" element={<BaoCaoThongKe />} />
            <Route path="/cai-dat-he-thong" element={<CaiDatHeThong />} />
          </Routes>
        </Content>
      </Layout>
    </Layout>
  );
}

export default App;
