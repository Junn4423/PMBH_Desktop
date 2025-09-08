import axios from 'axios';
import {url_api_services} from "./url";
import { getAuthHeaders } from './apiLogin';

const urlApi = url_api_services;

// -------------------- API Functions --------------------

// Hàm gọi API chung
export async function callApi(table, func, additionalData = {}) {
  try {
    const headers = await getAuthHeaders();
    const payload = {
      table,
      func,
      ...additionalData
    };

    const res = await axios.post(urlApi, payload, { headers });
    return res.data;
  } catch (error) {
    console.error(`API call failed for table: ${table}, func: ${func}`, error);
    throw error;
  }
}

// -------------------- Functions from index_HNhan.php --------------------


// Lấy loại sản phẩm
export async function getLoaiSanPham() {
  return await callApi('Mb_loaiSanPham', 'data');
}

// Lấy sản phẩm theo ID loại
export async function getSanPhamTheoIdLoai(findID) {
  return await callApi('Mb_sanPham', 'laySanTheoIdLoai', { findID });
}

// Lấy tất cả sản phẩm
export async function getAllSanPham() {
  return await callApi('Mb_sanPham', 'data');
}

// Thêm chi tiết hóa đơn
export async function themChiTietHoaDon(mahd, masp, soluong) {
  return await callApi('Mb_Cthd', 'themCtHd', { mahd, masp, soluong });
}

// Thanh toán hóa đơn
export async function thanhToanHoaDon(mahd) {
  return await callApi('Mb_thanhtoan', 'thanhToan_contract', { mahd });
}

// -------------------- Functions from index_Cong.php --------------------

// Thêm nhân sự
export async function themNhanSu(nhanSuData) {
  return await callApi('hr_NhanSu', 'add', nhanSuData);
}

// Sửa nhân sự
export async function suaNhanSu(nhanSuData) {
  return await callApi('hr_NhanSu', 'edit', nhanSuData);
}

// Xóa nhân sự
export async function xoaNhanSu(lv001) {
  return await callApi('hr_NhanSu', 'delete', { lv001 });
}

// Lấy danh sách nhân sự
export async function getDanhSachNhanSu() {
  return await callApi('hr_NhanSu', 'data');
}

// -------------------- Functions from index_KBao.php --------------------

// Thêm kho
export async function themKho(khoData) {
  return await callApi('Mb_Kho', 'add', khoData);
}

// Sửa kho
export async function suaKho(khoData) {
  return await callApi('Mb_Kho', 'edit', khoData);
}

// Xóa kho
export async function xoaKho(lv001) {
  return await callApi('Mb_Kho', 'delete', { lv001 });
}

// Lấy danh sách kho
export async function getDanhSachKho() {
  return await callApi('Mb_Kho', 'data');
}

// Lấy nguyên vật liệu theo mã kho
export async function getNguyenVatLieuTheoMaKho(maKho) {
  return await callApi('Mb_Kho', 'LayNvlTheoMaKho', { maKho });
}

// Lấy số lượng tồn kho
export async function getSoLuongTonKho(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKho', { maSP, maKho });
}

// Lấy số lượng tồn kho nhiều sản phẩm
export async function getSoLuongTonKhoNhieuSP(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP, maKho });
}

// -------------------- Functions from index_long.php --------------------

// Lấy danh sách khu vực
export async function getDanhSachKhuVuc() {
  return await callApi('Mb_LayDanhSachKhuVuc', 'data');
}

// Lấy danh sách bàn
export async function getDanhSachBan() {
  return await callApi('Mb_LayDsBan', 'data');
}

// Lấy tổng chi tiết hóa đơn
export async function getTongChiTietHoaDon() {
  return await callApi('Mb_TongCthd', 'data');
}

// Gộp bàn
export async function gopBan(idDonHang, idBanGop) {
  return await callApi('m_GopBan', 'add', { idDonHang, idBanGop });
}

// Tạo đơn hàng
export async function taoDonHang(idBan) {
  return await callApi('Mb_TaoDonHang', 'add', { idBan });
}

// -------------------- Functions from index_NChung.php --------------------

// Lấy danh sách món đang chờ order
export async function getDsMonDangChoOrder() {
  return await callApi('Mb_Oder', 'layDsMonDangChoOder');
}

// Lấy món ăn từ bàn đang bán
export async function getMonAnTuBanDangBan() {
  return await callApi('Mb_Oder', 'layMonAnTuBanDangBan');
}

// Lấy món nước từ bàn đang bán
export async function getMonNuocTuBanDangBan() {
  return await callApi('Mb_Oder', 'layMonNuocTuBanDangBan');
}

// Lấy danh sách món đã xong
export async function getDsMonDaXong() {
  return await callApi('Mb_Oder', 'layDsMonDaXong');
}

// Lấy thông tin đơn hàng theo bàn
export async function getThongTinDonHang(banid) {
  return await callApi('m_CheckTrangThai', 'layThongTinDonHang', { banid });
}

// Cập nhật trạng thái món
export async function updateTrangThaiMon(itemId) {
  return await callApi('m_updateTrangThaiMon', 'updateTrangThaiMon', { itemId });
}

// Thêm nhân sự
export async function addNhanSu(data) {
  return await callApi('hr_NhanSu', 'add', data);
}

// Sửa nhân sự
export async function editNhanSu(data) {
  return await callApi('hr_NhanSu', 'edit', data);
}

// Xóa nhân sự
export async function deleteNhanSu(lv001) {
  return await callApi('hr_NhanSu', 'delete', { lv001 });
}

// -------------------- Functions from index_KBao.php --------------------

// Lấy dữ liệu kho
export async function getKhoData() {
  return await callApi('Mb_Kho', 'data');
}

// Thêm kho
export async function addKho(data) {
  return await callApi('Mb_Kho', 'add', data);
}

// Sửa kho
export async function editKho(data) {
  return await callApi('Mb_Kho', 'edit', data);
}

// Xóa kho
export async function deleteKho(lv001) {
  return await callApi('Mb_Kho', 'delete', { lv001 });
}

// Lấy NVL theo mã kho
export async function getNvlTheoMaKho(maKho) {
  return await callApi('Mb_Kho', 'LayNvlTheoMaKho', { maKho });
}

// Lấy số lượng tồn kho nhiều SP
export async function getSoLuongTonKhoNhieuSP(maSPArr, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP: maSPArr, maKho });
}

// -------------------- Functions from index_long.php --------------------

// Lấy danh sách khu vực
export async function getDanhSachKhuVuc() {
  return await callApi('Mb_LayDanhSachKhuVuc', 'data');
}

// Lấy danh sách bàn
export async function getDanhSachBan() {
  return await callApi('Mb_LayDsBan', 'data');
}

// Lấy tổng chi tiết hóa đơn
export async function getTongChiTietHoaDon() {
  return await callApi('Mb_TongCthd', 'data');
}

// Gộp bàn
export async function gopBan(idDonHang, idBanGop) {
  return await callApi('m_GopBan', 'add', { idDonHang, idBanGop });
}

// Tạo đơn hàng
export async function taoDonHang(idBan) {
  return await callApi('Mb_TaoDonHang', 'add', { idBan });
}

// -------------------- Functions from index_NChung.php --------------------

// Lấy danh sách món đang chờ order
export async function getDsMonDangChoOder() {
  return await callApi('Mb_Oder', 'layDsMonDangChoOder');
}

// Lấy món ăn từ bàn đang bán
export async function getMonAnTuBanDangBan() {
  return await callApi('Mb_Oder', 'layMonAnTuBanDangBan');
}

// Lấy món nước từ bàn đang bán
export async function getMonNuocTuBanDangBan() {
  return await callApi('Mb_Oder', 'layMonNuocTuBanDangBan');
}

// Lấy danh sách món đã xong
export async function getDsMonDaXong() {
  return await callApi('Mb_Oder', 'layDsMonDaXong');
}

// Lấy thông tin đơn hàng
export async function getThongTinDonHang(banid) {
  return await callApi('m_CheckTrangThai', 'layThongTinDonHang', { banid });
}

// Cập nhật trạng thái món
export async function updateTrangThaiMon(itemId) {
  return await callApi('m_updateTrangThaiMon', 'updateTrangThaiMon', { itemId });
}