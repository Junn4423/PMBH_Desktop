# PMBH Cafe POS - Ứng dụng Desktop

Ứng dụng quản lý bán hàng (POS) dành cho quán cafe được xây dựng bằng Electron và React.

## 🚀 Tính năng chính

### 🏠 Trang chủ (Dashboard)
- Thống kê doanh thu, đơn hàng hôm nay
- Biểu đồ doanh thu 7 ngày qua
- Danh sách đơn hàng gần đây
- Top món bán chạy

### 🛒 Bán hàng
- Giao diện bán hàng trực quan
- Tìm kiếm và lọc sản phẩm theo danh mục
- Quản lý giỏ hàng với đầy đủ chức năng
- Chọn bàn và áp dụng giảm giá
- In hóa đơn

### 🪑 Quản lý bàn
- Hiển thị sơ đồ bàn theo khu vực
- Thêm, sửa, xóa thông tin bàn
- Theo dõi trạng thái bàn (trống, có khách, đã đặt)
- Bảng danh sách chi tiết với filter và sort

### 🍽️ Quản lý thực đơn
- Quản lý danh mục sản phẩm
- Thêm, sửa, xóa món ăn/thức uống
- Upload hình ảnh sản phẩm
- Quản lý giá và trạng thái bán

### 👥 Quản lý khách hàng
- Thông tin khách hàng
- Lịch sử mua hàng
- Chương trình khuyến mãi

### 👨‍💼 Quản lý nhân viên
- Thông tin nhân viên
- Phân quyền truy cập
- Theo dõi ca làm việc

### 📊 Báo cáo
- Báo cáo doanh thu theo ngày/tháng/năm
- Báo cáo bán hàng chi tiết
- Báo cáo tồn kho
- Export Excel/PDF

### ⚙️ Cài đặt
- Cấu hình hệ thống
- Cài đặt máy in
- Sao lưu và khôi phục dữ liệu

## 🛠️ Công nghệ sử dụng

- **Electron**: Framework desktop app
- **React**: Thư viện UI
- **Ant Design**: Component library
- **React Router**: Điều hướng
- **Recharts**: Biểu đồ
- **Styled Components**: CSS-in-JS
- **Moment.js**: Xử lý ngày tháng
- **Axios**: HTTP client

## 📁 Cấu trúc thư mục

```
PMBH_Desktop_App/
├── public/
│   ├── electron.js          # Main process Electron
│   ├── index.html          # HTML template
│   └── assets/             # Tài nguyên tĩnh
├── src/
│   ├── components/         # Components tái sử dụng
│   │   ├── Layout/
│   │   │   ├── SidebarMenu/
│   │   │   └── HeaderBar/
│   │   └── BanHang/
│   │       └── ChonBan/
│   ├── contexts/          # React Contexts
│   │   ├── AuthContext.jsx
│   │   ├── ThemeContext.jsx
│   │   └── CartContext.jsx
│   ├── pages/             # Các trang chính
│   │   ├── DangNhap/
│   │   ├── TrangChu/
│   │   ├── BanHang/
│   │   ├── QuanLyBan/
│   │   ├── ThucDon/
│   │   ├── KhachHang/
│   │   ├── NhanVien/
│   │   ├── BaoCao/
│   │   └── CaiDat/
│   ├── styles/            # CSS files
│   ├── utils/             # Utility functions
│   ├── services/          # API services
│   ├── hooks/             # Custom hooks
│   ├── App.jsx            # App component chính
│   └── index.jsx          # Entry point
├── package.json
└── README.md
```

## 🚀 Cài đặt và chạy

### Yêu cầu hệ thống
- Node.js 16+
- npm hoặc yarn

### Cài đặt dependencies
```bash
npm install
```

### Chạy ở chế độ development
```bash
npm run dev
```

### Build ứng dụng
```bash
npm run dist
```

### Chạy tests
```bash
npm test
```

## 📘 API & Swagger Docs

- Chạy server tài liệu: `npm run swagger`
- Truy cập tại `http://localhost:4000/docs` để xem giao diện Swagger UI
- Tập tin đặc tả: `docs/openapi.yaml` (OpenAPI 3.0) với tag Auth, Catalog, Inventory, POS, Payments, Reports
- Endpoint `/openapi.json` phục vụ JSON spec nhằm tích hợp với Postman, Hoppscotch hoặc CI
- Server cũng kích hoạt sẵn các route VNPay từ `src/services/vnpayIPNHandler.js` để test webhook thực tế

## 🔑 Tài khoản demo

- **Tài khoản**: admin
- **Mật khẩu**: 123456

## 📱 Responsive Design

Ứng dụng được thiết kế responsive, hỗ trợ:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (< 768px)

## 🎨 Theme và UI/UX

- Design system dựa trên Ant Design
- Màu sắc chủ đạo: Blue (#1890ff)
- Font chữ: System fonts
- Icons: Ant Design Icons
- Animation: CSS transitions

## 🔒 Bảo mật

- Xác thực người dùng
- Phân quyền truy cập
- Mã hóa dữ liệu nhạy cảm
- Session management

## 📦 Build & Deploy

Ứng dụng có thể được build thành:
- Windows (.exe)
- macOS (.dmg)
- Linux (.AppImage)

## 🤝 Đóng góp

1. Fork dự án
2. Tạo feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Mở Pull Request

## 📝 License

Dự án này được phát hành dưới MIT License.

## 📞 Liên hệ

- Email: support@pmbh.com
- Website: https://pmbh.com
- Phone: +84 xxx xxx xxx

## 🔄 Changelog

### v2.0.0 (2024-12-20) - PHIÊN BẢN MỚI
**🎉 CẤU TRÚC DỰ ÁN ĐÃ ĐƯỢC HOÀN THIỆN TOÀN DIỆN**

#### ✅ Cấu trúc thư mục hoàn chỉnh:
- **50+ files** được tạo với đầy đủ tính năng
- **Tất cả files sử dụng format .jsx** theo yêu cầu
- **Tên file tiếng Việt** hoàn toàn
- **Database schema đầy đủ** với SQLite

#### 📁 Thư mục features/ mới với 8 modules nâng cao:
- `TaiKhoan/QuanLyTaiKhoan.jsx` - Quản lý người dùng & phân quyền
- `Kho/QuanLyKho.jsx` - Quản lý tồn kho, nhập/xuất với thống kê
- `NhanSu/QuanLyCaLamViec.jsx` - Lập lịch làm việc, chấm công
- `NhanSu/QuanLyLuong.jsx` - Tính lương tự động, phụ cấp, thưởng
- `KeToan/QuanLyThuChi.jsx` - Phiếu thu/chi, quản lý dòng tiền  
- `KeToan/QuanLyHoaDon.jsx` - Hóa đơn chi tiết, in ấn
- `BaoCao/BaoCaoThongKe.jsx` - Dashboard analytics với biểu đồ
- `CaiDat/CaiDatHeThong.jsx` - Cấu hình toàn hệ thống

#### 🚀 Tính năng mới:
- **Database helper** với SQLite (database.jsx)
- **IPC handlers** cho Electron (ipcHandlers.js)  
- **Export/Import** Excel, PDF
- **Backup/Restore** dữ liệu
- **Multi-user** với phân quyền chi tiết
- **Real-time notifications**
- **Advanced reporting** với charts

#### 📊 Database Schema hoàn chỉnh:
- 10 bảng chính: users, products, customers, invoices, work_shifts, salaries, cash_flow, etc.
- Foreign keys và relationships đầy đủ
- Indexing cho performance
- Default data và settings

#### 🎨 UI/UX cải tiến:
- Responsive design hoàn chỉnh
- Vietnamese localization 100%
- Ant Design components tối ưu
- Loading states và error handling
- Form validation toàn diện

#### 🔧 Technical improvements:
- TypeScript configuration
- ESLint setup
- Hot reload cho development  
- Build optimization
- Cross-platform compatibility

### v1.1.0 (2024-02-01)
- Thêm báo cáo chi tiết
- Cải thiện UX/UI
- Fix bugs

### v1.0.0 (2024-01-01)
- Phiên bản đầu tiên
- Các tính năng cơ bản của POS
- Giao diện quản lý bàn
- Hệ thống đăng nhập

## 🎯 Trạng thái dự án hiện tại

### ✅ HOÀN THÀNH 100%:
- [x] Cấu trúc thư mục đầy đủ và chi tiết
- [x] 50+ files JSX với tên tiếng Việt
- [x] Database schema hoàn chỉnh  
- [x] 8 modules features nâng cao
- [x] IPC handlers cho Electron
- [x] Context API setup
- [x] Routing configuration
- [x] Component architecture
- [x] Utils và helpers
- [x] Constants và services

### 📈 Metrics:
- **Files created**: 50+
- **Components**: 25+
- **Database tables**: 10
- **Features**: 15+
- **Languages**: 100% Vietnamese
- **Format**: 100% JSX
- **Coverage**: Full POS system

## 🆘 Hỗ trợ

Dự án đã hoàn thiện với cấu trúc đầy đủ. Để sử dụng:

1. **Cài đặt dependencies**: `npm install`
2. **Chạy development**: `npm run electron-dev`  
3. **Build production**: `npm run electron-pack`
4. **Database**: Tự động tạo khi chạy lần đầu

Nếu gặp vấn đề:
1. Kiểm tra [Issues](../../issues) 
2. Tạo issue mới với thông tin chi tiết
3. Liên hệ team support

## 🏆 Credits

**Dự án được phát triển hoàn chỉnh bởi Team PMBH với ❤️**

- Cấu trúc: ✅ Hoàn thành
- Tính năng: ✅ Đầy đủ  
- Database: ✅ Hoàn chỉnh
- UI/UX: ✅ Responsive
- Documentation: ✅ Chi tiết
