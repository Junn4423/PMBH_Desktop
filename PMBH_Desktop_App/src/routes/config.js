import React from 'react';
import {
  Home,
  Calculator,
  Package,
  TrendingUp,
  LayoutDashboard,
  Settings,
  Users,
  Layers,
  Store,
  BriefcaseBusiness,
  ClipboardList,
  BarChart3,
  ShieldCheck,
  LibraryBig
} from 'lucide-react';

const TrangChu = React.lazy(() => import('../pages/TrangChu/TrangChu'));
const BanHang = React.lazy(() => import('../pages/BanHang/BanHang'));
const KitchenSystem = React.lazy(() => import('../pages/BepBar/BepBar'));
const QuanLyBanNhaHang = React.lazy(() => import('../pages/QuanLyBanNhaHang/QuanLyBanNhaHang'));
const ThucDon = React.lazy(() => import('../pages/ThucDon/ThucDon'));
const NhanVien = React.lazy(() => import('../pages/NhanVien/NhanVien'));
const BaoCao = React.lazy(() => import('../pages/BaoCao/BaoCao'));
const CaiDat = React.lazy(() => import('../pages/CaiDat/CaiDat'));
const TaxIntegration = React.lazy(() => import('../pages/TaxIntegration/TaxIntegration'));
const BepBar = React.lazy(() => import('../pages/BepBar/BepBar'));
const ChiKhac = React.lazy(() => import('../pages/ChiKhac/ChiKhac'));
const CongTy = React.lazy(() => import('../pages/CongTy/CongTy'));
const BangDieuKhienNguoiDung = React.lazy(() => import('../pages/BangDieuKhienNguoiDung/BangDieuKhienNguoiDung'));
const PhieuChi = React.lazy(() => import('../pages/PhieuChi/PhieuChi'));
const KiemKho = React.lazy(() => import('../pages/KiemKho/KiemKho'));
const PhongBan = React.lazy(() => import('../pages/PhongBan/PhongBan'));
const NhomNguoiDung = React.lazy(() => import('../pages/NhomNguoiDung/NhomNguoiDung'));
const ChonKhoQuanLy = React.lazy(() => import('../pages/ChonKhoQuanLy/ChonKhoQuanLy'));
const TaiKhoanMB = React.lazy(() => import('../pages/TaiKhoanMB/TaiKhoanMB'));
const NhapChi = React.lazy(() => import('../pages/NhapChi/NhapChi'));
const CanhBaoMaxMin = React.lazy(() => import('../pages/CanhBaoMaxMin/CanhBaoMaxMin'));
const VNPayReturn = React.lazy(() => import('../pages/Payment/VNPayReturn'));
const MoMoReturn = React.lazy(() => import('../pages/Payment/MoMoReturn'));
const ZaloPayReturn = React.lazy(() => import('../pages/Payment/ZaloPayReturn'));
const DonVi = React.lazy(() => import('../pages/DonVi/DonVi'));
const VNPaySuccess = React.lazy(() => import('../pages/Payment/VNPaySuccess'));
const PaymentSuccess = React.lazy(() => import('../pages/Payment/PaymentSuccess'));
const ChuongTrinhKinhDoanh = React.lazy(() => import('../pages/ChuongTrinhKinhDoanh/ChuongTrinhKinhDoanh'));
const NguoiDangKy = React.lazy(() => import('../pages/NguoiDangKy/NguoiDangKy'));
const ChoNguoiQuanLy = React.lazy(() => import('../pages/ChoNguoiQuanLy/ChoNguoiQuanLy'));
const NhanVienCongTy = React.lazy(() => import('../pages/NhanVienCongTy/NhanVienCongTy'));
const BcChiTien = React.lazy(() => import('../pages/BcChiTien/BcChiTien'));
const BcChiTienNhapKho = React.lazy(() => import('../pages/BcChiTienNhapKho/BcChiTienNhapKho'));
const NhapBanHang = React.lazy(() => import('../pages/NhapBanHang/NhapBanHang'));
const ChoNhaBep = React.lazy(() => import('../pages/ChoNhaBep/ChoNhaBep'));
const ChoQuayBar = React.lazy(() => import('../pages/ChoQuayBar/ChoQuayBar'));
const BcBanHang = React.lazy(() => import('../pages/BcBanHang/BcBanHang'));
const BcTong = React.lazy(() => import('../pages/BcTong/BcTong'));
const BaoCaoGiaoCa = React.lazy(() => import('../pages/BaoCaoGiaoCa/BaoCaoGiaoCa'));
const BcNhapKho = React.lazy(() => import('../pages/BcNhapKho/BcNhapKho'));
const BaoTonMobil = React.lazy(() => import('../pages/BaoTonMobil/BaoTonMobil'));
const NhapKhoMb = React.lazy(() => import('../pages/NhapKhoMb/NhapKhoMb'));
const KiemKhoMb = React.lazy(() => import('../pages/KiemKhoMb/KiemKhoMb'));
const LoaiSanPham = React.lazy(() => import('../pages/LoaiSanPham/LoaiSanPham'));
const SanPham = React.lazy(() => import('../pages/SanPham/SanPham'));
const LichSuTichDiem = React.lazy(() => import('../pages/LichSuTichDiem/LichSuTichDiem'));
const CustomerDisplay = React.lazy(() => import('../components/CustomerDisplay/CustomerDisplay'));
const TangNhaHang = React.lazy(() => import('../pages/TangNhaHang/TangNhaHang'));
const BanNhaHang = React.lazy(() => import('../pages/BanNhaHang/BanNhaHang'));
const Kho = React.lazy(() => import('../pages/Kho/Kho'));
const NhapKho = React.lazy(() => import('../pages/NhapKho/NhapKho'));
const XuatKho = React.lazy(() => import('../pages/XuatKho/XuatKho'));
const BaoCaoTheoDieuKien = React.lazy(() => import('../pages/BaoCaoTheoDieuKien/BaoCaoTheoDieuKien'));
const DanhMucKhachHang = React.lazy(() => import('../pages/DanhMucKhachHang/DanhMucKhachHang'));
const CauHinhQuanLyNhaHang = React.lazy(() => import('../pages/CauHinhQuanLyNhaHang/CauHinhQuanLyNhaHang'));
const XemThongTinXoaDonHang = React.lazy(() => import('../pages/XemThongTinXoaDonHang/XemThongTinXoaDonHang'));
const ChoNhaBepQl = React.lazy(() => import('../pages/ChoNhaBepQl/ChoNhaBepQl'));
const ChoQuayBarQl = React.lazy(() => import('../pages/ChoQuayBarQl/ChoQuayBarQl'));
const BaoCaoDoanhThuKhachHang = React.lazy(() => import('../pages/BaoCaoDoanhThuKhachHang/BaoCaoDoanhThuKhachHang'));
const CustomerPaymentSuccess = PaymentSuccess;

export const menuGroups = {
  core: {
    key: 'core',
    label: 'Mục chung',
    icon: Home
  },
  accounting: {
    key: 'accounting',
    label: 'Kế toán',
    icon: Calculator
  },
  inventory: {
    key: 'inventory',
    label: 'Quản lí kho',
    icon: Package
  },
  sales: {
    key: 'sales',
    label: 'Kinh doanh',
    icon: TrendingUp
  }
};

const defaultRoles = ['Admin', 'Manager', 'User', 'Demo'];

export const protectedRoutes = [
  {
    path: '/trang-chu',
    Component: TrangChu,
    meta: {
      title: 'Trang chủ',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Trang chủ',
        icon: LayoutDashboard,
        order: 0
      }
    }
  },
  {
    path: '/ket-noi-thue',
    Component: TaxIntegration,
    meta: {
      title: 'Kết nối thuế',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Kết nối thuế',
        icon: ShieldCheck,
        order: 1
      }
    }
  },
  {
    path: '/cong-ty',
    Component: CongTy,
    meta: {
      title: 'Công ty',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Công ty',
        icon: BriefcaseBusiness,
        order: 2
      }
    }
  },
  {
    path: '/phong-ban',
    Component: PhongBan,
    meta: {
      title: 'Phòng ban',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/cong-ty',
        label: 'Phòng ban',
        order: 0
      }
    }
  },
  {
    path: '/nhan-vien-cong-ty',
    Component: NhanVienCongTy,
    meta: {
      title: 'Nhân viên công ty',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/cong-ty',
        label: 'Nhân viên',
        order: 1
      }
    }
  },
  {
    path: '/bang-dieu-khien-nguoi-dung',
    Component: BangDieuKhienNguoiDung,
    meta: {
      title: 'Bảng điều khiển người dùng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Bảng điều khiển người dùng',
        icon: Users,
        order: 3
      }
    }
  },
  {
    path: '/nhom-nguoi-dung',
    Component: NhomNguoiDung,
    meta: {
      title: 'Nhóm người dùng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/bang-dieu-khien-nguoi-dung',
        label: 'Nhóm người dùng',
        order: 0
      }
    }
  },
  {
    path: '/chon-kho-quan-ly',
    Component: ChonKhoQuanLy,
    meta: {
      title: 'Chọn kho quản lý',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/bang-dieu-khien-nguoi-dung',
        label: 'Chọn kho quản lý',
        order: 1
      }
    }
  },
  {
    path: '/giao-dien-mb',
    Component: TrangChu,
    meta: {
      title: 'Giao diện MB',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Giao diện MB',
        icon: LayoutDashboard,
        order: 4
      }
    }
  },
  {
    path: '/tai-khoan-mb',
    Component: TaiKhoanMB,
    meta: {
      title: 'Tài khoản MB',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Tài khoản',
        order: 0
      }
    }
  },
  {
    path: '/bc-chi-tien',
    Component: BcChiTien,
    meta: {
      title: 'BC chi tiền',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'BC chi tiền',
        order: 1
      }
    }
  },
  {
    path: '/bc-chi-tien-nhap-kho',
    Component: BcChiTienNhapKho,
    meta: {
      title: 'BC chi tiền + nhập kho',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'BC chi tiền + nhập kho',
        order: 2
      }
    }
  },
  {
    path: '/nhap-chi',
    Component: NhapChi,
    meta: {
      title: 'Nhập chi',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Nhập chi',
        order: 3
      }
    }
  },
  {
    path: '/nhap-ban-hang',
    Component: NhapBanHang,
    meta: {
      title: 'Nhập bán hàng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Nhập bán hàng',
        order: 4
      }
    }
  },
  {
    path: '/cho-nha-bep',
    Component: ChoNhaBep,
    meta: {
      title: 'Cho nhà bếp',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Cho nhà bếp',
        order: 5
      }
    }
  },
  {
    path: '/cho-quay-bar',
    Component: ChoQuayBar,
    meta: {
      title: 'Cho quầy bar',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Cho quầy bar',
        order: 6
      }
    }
  },
  {
    path: '/bc-ban-hang',
    Component: BcBanHang,
    meta: {
      title: 'BC bán hàng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'BC bán hàng',
        order: 7
      }
    }
  },
  {
    path: '/bc-tong',
    Component: BcTong,
    meta: {
      title: 'BC tổng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'BC tổng',
        order: 8
      }
    }
  },
  {
    path: '/bao-cao-giao-ca',
    Component: BaoCaoGiaoCa,
    meta: {
      title: 'Báo cáo giao ca',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Báo cáo giao ca',
        order: 9
      }
    }
  },
  {
    path: '/bc-nhap-kho',
    Component: BcNhapKho,
    meta: {
      title: 'BC nhập kho',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'BC nhập kho',
        order: 10
      }
    }
  },
  {
    path: '/canh-bao-max-min',
    Component: CanhBaoMaxMin,
    meta: {
      title: 'Cảnh báo max/min',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Cảnh báo max/min',
        order: 11
      }
    }
  },
  {
    path: '/bao-ton-mobil',
    Component: BaoTonMobil,
    meta: {
      title: 'Báo tồn Mobil',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Báo tồn Mobil',
        order: 12
      }
    }
  },
  {
    path: '/nhap-kho-mb',
    Component: NhapKhoMb,
    meta: {
      title: 'Nhập kho MB',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Nhập kho',
        order: 13
      }
    }
  },
  {
    path: '/kiem-kho-mb',
    Component: KiemKhoMb,
    meta: {
      title: 'Kiểm kho MB',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/giao-dien-mb',
        label: 'Kiểm kho',
        order: 14
      }
    }
  },
  {
    path: '/dieu-khien-san-pham',
    Component: TrangChu,
    meta: {
      title: 'Điều khiển sản phẩm',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Điều khiển sản phẩm',
        icon: Store,
        order: 5
      }
    }
  },
  {
    path: '/don-vi',
    Component: DonVi,
    meta: {
      title: 'Đơn vị',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/dieu-khien-san-pham',
        label: 'Đơn vị',
        order: 0
      }
    }
  },
  {
    path: '/loai-san-pham',
    Component: LoaiSanPham,
    meta: {
      title: 'Loại sản phẩm',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/dieu-khien-san-pham',
        label: 'Loại sản phẩm',
        order: 1
      }
    }
  },
  {
    path: '/san-pham',
    Component: SanPham,
    meta: {
      title: 'Sản phẩm',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/dieu-khien-san-pham',
        label: 'Sản phẩm',
        order: 2
      }
    }
  },
  {
    path: '/thiet-lap-tang-va-ban',
    Component: TrangChu,
    meta: {
      title: 'Thiết lập tầng và bàn',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Thiết lập tầng và bàn',
        icon: Layers,
        order: 6
      }
    }
  },
  {
    path: '/tang-nha-hang',
    Component: TangNhaHang,
    meta: {
      title: 'Tầng nhà hàng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/thiet-lap-tang-va-ban',
        label: 'Tầng nhà hàng',
        order: 0
      }
    }
  },
  {
    path: '/ban-nha-hang',
    Component: BanNhaHang,
    meta: {
      title: 'Bàn nhà hàng',
      roles: defaultRoles,
      menu: {
        group: 'core',
        parent: '/thiet-lap-tang-va-ban',
        label: 'Bàn nhà hàng',
        order: 1
      }
    }
  },
  {
    path: '/phieu-chi',
    Component: PhieuChi,
    meta: {
      title: 'Phiếu chi',
      roles: defaultRoles,
      menu: {
        group: 'accounting',
        label: 'Phiếu chi',
        icon: Calculator,
        order: 0
      }
    }
  },
  {
    path: '/kho',
    Component: Kho,
    meta: {
      title: 'Kho',
      roles: defaultRoles,
      menu: {
        group: 'inventory',
        label: 'Kho',
        icon: Package,
        order: 0
      }
    }
  },
  {
    path: '/kiem-kho',
    Component: KiemKho,
    meta: {
      title: 'Kiểm kho',
      roles: defaultRoles,
      menu: {
        group: 'inventory',
        label: 'Kiểm kho',
        icon: ClipboardList,
        order: 1
      }
    }
  },
  {
    path: '/nhap-kho',
    Component: NhapKho,
    meta: {
      title: 'Nhập kho',
      roles: defaultRoles,
      menu: {
        group: 'inventory',
        label: 'Nhập kho',
        icon: LibraryBig,
        order: 2
      }
    }
  },
  {
    path: '/xuat-kho',
    Component: XuatKho,
    meta: {
      title: 'Xuất kho',
      roles: defaultRoles,
      menu: {
        group: 'inventory',
        label: 'Xuất kho',
        icon: LibraryBig,
        order: 3
      }
    }
  },
  {
    path: '/bao-cao-theo-dieu-kien',
    Component: BaoCaoTheoDieuKien,
    meta: {
      title: 'Báo cáo theo điều kiện',
      roles: defaultRoles,
      menu: {
        group: 'inventory',
        label: 'Báo cáo theo điều kiện',
        icon: BarChart3,
        order: 4
      }
    }
  },
  {
    path: '/danh-muc-khach-hang',
    Component: DanhMucKhachHang,
    meta: {
      title: 'Danh mục khách hàng',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        label: 'Danh mục khách hàng',
        icon: Users,
        order: 0
      }
    }
  },
  {
    path: '/lich-su-tich-diem',
    Component: LichSuTichDiem,
    meta: {
      title: 'Lịch sử tích điểm',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        label: 'Lịch sử tích điểm',
        icon: TrendingUp,
        order: 1
      }
    }
  },
  {
    path: '/quan-ly-ban-nha-hang',
    Component: QuanLyBanNhaHang,
    meta: {
      title: 'Quản lý bán nhà hàng',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        label: 'Quản lý bán nhà hàng',
        icon: Store,
        order: 2
      }
    }
  },
  {
    path: '/chuong-trinh-kinh-doanh',
    Component: ChuongTrinhKinhDoanh,
    meta: {
      title: 'Chương trình kinh doanh',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Chương trình kinh doanh',
        order: 0
      }
    }
  },
  {
    path: '/cau-hinh-quan-ly-nha-hang',
    Component: CauHinhQuanLyNhaHang,
    meta: {
      title: 'Cấu hình quản lý nhà hàng',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Cấu hình quản lý nhà hàng',
        order: 1
      }
    }
  },
  {
    path: '/xem-thong-tin-xoa-don-hang',
    Component: XemThongTinXoaDonHang,
    meta: {
      title: 'Xem thông tin xóa đơn hàng',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Xem thông tin xóa đơn hàng',
        order: 2
      }
    }
  },
  {
    path: '/nguoi-dang-ky',
    Component: NguoiDangKy,
    meta: {
      title: 'Người đăng ký',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Người đăng ký',
        order: 3
      }
    }
  },
  {
    path: '/cho-nguoi-quan-ly',
    Component: ChoNguoiQuanLy,
    meta: {
      title: 'Cho người quản lý',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Cho người quản lý',
        order: 4
      }
    }
  },
  {
    path: '/cho-nha-bep-ql',
    Component: ChoNhaBepQl,
    meta: {
      title: 'Cho nhà bếp',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Cho nhà bếp',
        order: 5
      }
    }
  },
  {
    path: '/cho-quay-bar-ql',
    Component: ChoQuayBarQl,
    meta: {
      title: 'Cho quầy bar',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        parent: '/quan-ly-ban-nha-hang',
        label: 'Cho quầy bar',
        order: 6
      }
    }
  },
  {
    path: '/bao-cao-doanh-thu-khach-hang',
    Component: BaoCaoDoanhThuKhachHang,
    meta: {
      title: 'Báo cáo doanh thu khách hàng',
      roles: defaultRoles,
      menu: {
        group: 'sales',
        label: 'Báo cáo doanh thu khách hàng',
        icon: BarChart3,
        order: 3
      }
    }
  },
  {
    path: '/ban-hang',
    Component: BanHang,
    meta: {
      title: 'Bán hàng',
      roles: defaultRoles
    }
  },
  {
    path: '/kitchen-system',
    Component: KitchenSystem,
    meta: {
      title: 'Kitchen system',
      roles: defaultRoles
    }
  },
  {
    path: '/bep-bar',
    Component: BepBar,
    meta: {
      title: 'Bếp/Bar',
      roles: defaultRoles
    }
  },
  {
    path: '/chi-khac',
    Component: ChiKhac,
    meta: {
      title: 'Chi khác',
      roles: defaultRoles
    }
  },
  {
    path: '/thuc-don',
    Component: ThucDon,
    meta: {
      title: 'Thực đơn',
      roles: defaultRoles
    }
  },
  {
    path: '/khach-hang',
    Component: DanhMucKhachHang,
    meta: {
      title: 'Khách hàng',
      roles: defaultRoles
    }
  },
  {
    path: '/nhan-vien',
    Component: NhanVien,
    meta: {
      title: 'Nhân viên',
      roles: defaultRoles
    }
  },
  {
    path: '/bao-cao',
    Component: BaoCao,
    meta: {
      title: 'Báo cáo',
      roles: defaultRoles
    }
  },
  {
    path: '/cai-dat',
    Component: CaiDat,
    meta: {
      title: 'Cài đặt',
      roles: defaultRoles,
      menu: {
        group: 'core',
        label: 'Cài đặt',
        icon: Settings,
        order: 7
      }
    }
  }
];

export const standaloneRoutes = [
  {
    path: '/customer-display',
    Component: CustomerDisplay,
    meta: {
      title: 'Customer Display',
      requiresAuth: false
    }
  }
];

export const paymentRoutes = [
  {
    path: '/payment/vnpay-return',
    Component: VNPayReturn,
    meta: {
      title: 'VNPay Return',
      requiresAuth: false
    }
  },
  {
    path: '/payment/zalopay-return',
    Component: ZaloPayReturn,
    meta: {
      title: 'ZaloPay Return',
      requiresAuth: false
    }
  },
  {
    path: '/payment/momo-return',
    Component: MoMoReturn,
    meta: {
      title: 'MoMo Return',
      requiresAuth: false
    }
  },
  {
    path: '/payment/vnpay-success',
    Component: VNPaySuccess,
    meta: {
      title: 'VNPay Success',
      requiresAuth: false
    }
  },
  {
    path: '/payment/success',
    Component: CustomerPaymentSuccess,
    meta: {
      title: 'Payment Success',
      requiresAuth: false
    }
  }
];

export const allRoutes = [...protectedRoutes, ...standaloneRoutes, ...paymentRoutes];

export default protectedRoutes;
