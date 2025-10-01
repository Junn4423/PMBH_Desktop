import axios from 'axios';
import {url_api_services} from "./url";
import { getAuthHeaders } from './apiLogin';

const urlApi = url_api_services;

// -------------------- API Functions --------------------

// Hàm gọi API chung với auto authentication
export async function callApi(table, func, additionalData = {}, retryCount = 0) {
  try {
    const headers = await getAuthHeaders(retryCount > 0); // Force refresh on retry
    const payload = {
      table,
      func,
      ...additionalData
    };

    const res = await axios.post(urlApi, payload, { headers });
    
    // Log response để debug
    
    // Đảm bảo trả về array nếu dữ liệu là null hoặc undefined
    if (res.data === null || res.data === undefined) {
      console.warn(`API returned null/undefined for ${table}.${func}`);
      return [];
    }
    
    return res.data;
  } catch (error) {
    // If we get 401 or auth error and haven't retried yet, retry with fresh token
    if ((error.response?.status === 401 || error.message.includes('token')) && retryCount === 0) {
      return callApi(table, func, additionalData, 1);
    }
    
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

// Load hình ảnh sản phẩm từ database
export async function loadProductImage(productId) {
  try {
    const result = await callApi('Mb_sanPham', 'loadImage', { maSp: productId });
    return result;
  } catch (error) {
    console.error('Error loading product image:', error);
    return null;
  }
}

// Lấy URL hình ảnh sản phẩm đầy đủ
export function getFullImageUrl(imagePath) {
  if (!imagePath) return null;
  
  // Nếu đã là URL đầy đủ (http/https)
  if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
    return imagePath;
  }
  
  // Nếu là đường dẫn tương đối, tạo URL đầy đủ
  const baseUrl = "http://192.168.1.92/gmac";
  
  // Xử lý đường dẫn bắt đầu bằng /
  if (imagePath.startsWith('/')) {
    return `${baseUrl}${imagePath}`;
  }
  
  // Xử lý đường dẫn tương đối - nếu không bắt đầu bằng images/, giả sử là trong thư mục products
  if (!imagePath.startsWith('images/')) {
    return `${baseUrl}/images/products/${imagePath}`;
  }
  
  // Xử lý đường dẫn tương đối
  return `${baseUrl}/${imagePath}`;
}

// Thêm chi tiết hóa đơn
export async function themChiTietHoaDon(mahd, masp, soluong) {
  return await callApi('Mb_Cthd', 'themCtHd', { mahd, masp, soluong });
}

// Thanh toán hóa đơn
export async function thanhToanHoaDon(mahd) {
  return await callApi('Mb_thanhtoan', 'thanhToan_contract', { mahd });
}

// Cập nhật sản phẩm
export async function updateSanPham(productData) {
  return await callApi('Mb_sanPham', 'edit', productData);
}

// Upload ảnh sản phẩm
export async function uploadProductImage(productId, imageFile) {
  try {
    const formData = new FormData();
    formData.append('table', 'Mb_sanPham');
    formData.append('func', 'uploadImage');
    formData.append('maSp', productId);
    formData.append('imageFile', imageFile);

    const headers = await getAuthHeaders();
    const res = await axios.post(url_api_services, formData, {
      headers: {
        ...headers,
        'Content-Type': 'multipart/form-data'
      }
    });

    return { success: res.data === true || res.data === 1 || res.data === "1" };
  } catch (error) {
    console.error('Error uploading image:', error);
    return { success: false, error: error.message };
  }
}

// Cập nhật URL ảnh sản phẩm
export async function updateProductImageUrl(productId, imageUrl) {
  try {
    const result = await callApi('Mb_sanPham', 'updateImageUrl', { maSp: productId, imageUrl });
    return { success: result === true || result === 1 || result === "1" };
  } catch (error) {
    console.error('Error updating product image URL:', error);
    return { success: false, error: error.message };
  }
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

// Lấy danh sách bàn
export async function getDanhSachBan() {
  return await callApi('Mb_LayDsBan', 'data');
}

// Lấy tổng chi tiết hóa đơn - hóa đơn có món - chưa thanh toán và thanh toán rồi
export async function getTongChiTietHoaDon() {
  return await callApi('Mb_TongCthd', 'data');
}
// Lấy chi tiết hóa đơn - kể cả hóa đơn rỗng
export async function getChiTietHoaDonRong() {
  return await callApi('Mb_TongCthdRong', 'data');
}

// Lấy chi tiết hóa đơn theo mã hóa đơn
export async function getChiTietHoaDonTheoMaHD(maHd) {
  return await callApi('Mb_LayCthd_', 'layCtHd', { maHd });
}

// Gộp bàn
export async function gopBan(idDonHang, idBanGop) {
  return await callApi('m_GopBan', 'add', { idDonHang, idBanGop });
}

// Load bàn
export async function loadBan() {
  return await callApi('Mb_LayDsBan', 'data');
}

// Load khu vực
export async function loadKhuVuc() {
  return await callApi('Mb_LayDanhSachKhuVuc', 'data');
}

// Tạo đơn hàng
export async function taoDonHang(idBan) {
  return await callApi('Mb_TaoDonHang', 'add', { idBan });
}

// -------------------- Functions from index_NChung.php --------------------

//Lấy mã hóa, tên bàn, vị trí, trạng thái từ bàn đang bán
export async function getMaHoaDonTuBanDangBan(banId) {
  return await callApi('m_loadBan', 'load', { banId });
}

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

// Lấy số lượng tồn kho nhiều SP (version 2)
export async function getSoLuongTonKhoNhieuSPv2(maSPArr, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP: maSPArr, maKho });
}



// -------------------- GMAC API Integration - Real Implementation --------------------
// Tích hợp với GMAC API thực tế để lấy dữ liệu khu vực và bàn

const GMAC_BASE_URL = 'http://localhost/gmac'; // URL của GMAC server

// API thực để lấy danh sách khu vực từ GMAC hr_lv0004
export async function getGmacKhuVucList() {
  try {
    // Thử gọi API thực từ GMAC hr_lv0004
    const response = await fetch(`${GMAC_BASE_URL}/soft/hr_lv0004/hr_lv0004.php?func=list&lang=vn`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });

    if (response.ok) {
      const htmlData = await response.text();
      return parseGmacHrData(htmlData);
    } else {
      throw new Error('GMAC API không khả dụng');
    }
  } catch (error) {
    console.error('GMAC API không khả dụng:', error);
    throw error;
  }
}

// API thực để lấy danh sách bàn từ GMAC sl_lv0008 theo khu vực
export async function getGmacBanListByKhuVuc(khuVucId) {
  try {
    // Thử gọi API thực từ GMAC sl_lv0008
    const response = await fetch(`${GMAC_BASE_URL}/soft/sl_lv0008/sl_lv0008.php?func=list&khuVuc=${khuVucId}&lang=vn`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    });

    if (response.ok) {
      const htmlData = await response.text();
      return parseGmacBanData(htmlData, khuVucId);
    } else {
      throw new Error('GMAC API không khả dụng');
    }
  } catch (error) {
    console.error('GMAC API không khả dụng:', error);
    throw error;
  }
}

// API để tạo đơn hàng thực qua GMAC sl_lv0201
export async function createGmacOrder(orderData) {
  try {
    const params = new URLSearchParams({
      ajaxitemsend: 'ajaxcheck',
      ContractID: orderData.contractId || '',
      BangID: orderData.banId,
      ItemID: orderData.itemId,
      Order: orderData.order || 1,
      CusID: orderData.customerId || '',
      AddState: orderData.addState || 1,
      trahang: orderData.traHang || 0,
      progid: orderData.programId || '',
      lang: 'vn'
    });

    const response = await fetch(`${GMAC_BASE_URL}/soft/sl_lv0201/sl_lv0201.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: params
    });

    if (response.ok) {
      const data = await response.text();
      return parseGmacOrderResult(data);
    } else {
      throw new Error('Không thể tạo đơn hàng qua GMAC');
    }
  } catch (error) {
    console.error('Error creating GMAC order:', error);
    return {
      success: false,
      error: error.message
    };
  }
}

// Parse dữ liệu khu vực từ GMAC hr_lv0004 response
function parseGmacHrData(htmlData) {
  try {
    // TODO: Implement actual HTML parsing từ GMAC hr_lv0004
    console.warn('parseGmacHrData chưa được implement');
    throw new Error('parseGmacHrData chưa được implement');
  } catch (error) {
    console.error('Lỗi parse dữ liệu khu vực GMAC:', error);
    throw error;
  }
}

// Parse dữ liệu bàn từ GMAC sl_lv0008 response
function parseGmacBanData(htmlData, khuVucId) {
  try {
    // TODO: Implement actual HTML parsing từ GMAC sl_lv0008
    console.warn('parseGmacBanData chưa được implement');
    throw new Error('parseGmacBanData chưa được implement');
  } catch (error) {
    console.error('Lỗi parse dữ liệu bàn GMAC:', error);
    throw error;
  }
}

// Parse kết quả tạo đơn hàng từ GMAC sl_lv0201
function parseGmacOrderResult(rawData) {
  // Parse response từ GMAC sl_lv0201.php
  // Tìm [CHECKHOPDONG] và [CHECKORDER] patterns như trong source code
  try {
    const contractMatch = rawData.match(/\[CHECKHOPDONG\](.*?)\[ENDCHECKHOPDONG\]/);
    const orderMatch = rawData.match(/\[CHECKORDER\](.*?)\[ENDCHECKORDER\]/);
    const blockMatch = rawData.match(/\[CHECKBLOCK\](.*?)\[ENDCHECKBLOCK\]/);

    if (contractMatch && orderMatch) {
      return {
        success: true,
        contractId: contractMatch[1],
        orderId: orderMatch[1],
        isBlocked: blockMatch ? parseInt(blockMatch[1]) : 0
      };
    } else {
      return {
        success: false,
        error: 'Invalid response format'
      };
    }
  } catch (error) {
    return {
      success: false,
      error: 'Parse error: ' + error.message
    };
  }
}

// -------------------- Functions from features/quan-ly --------------------

// Lấy số lượng tồn kho
export async function laySoLuongTonKho(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKho', { maSP, maKho });
}

// Lấy số lượng tồn kho nhiều sản phẩm
export async function laySoLuongTonKhoNhieuSP(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP, maKho });
}

// Load kho từ features
export async function loadKhoFeatures(data = {}) {
  return await callApi('wh_lv0001', 'loadKho', data);
}

// Thêm kho
export async function themKhoFeatures(khoData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = khoData;
  return await callApi('wh_lv0001', 'themKho', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// Cập nhật kho
export async function capNhatKhoFeatures(khoData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = khoData;
  return await callApi('wh_lv0001', 'capNhatKho', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// Xóa kho
export async function xoaKhoFeatures(lv001) {
  return await callApi('wh_lv0001', 'xoaKho', { lv001 });
}

// Load sản phẩm theo ID kho
export async function loadSanPhamTheoIdKho(idKho) {
  return await callApi('sl_lv0007', 'loadSanPhamTheoIdKho', { idKho });
}

// Load phiếu nhập
export async function loadPhieuNhap(data = {}) {
  return await callApi('wh_lv0002', 'loadPhieuNhap', data);
}

// Xóa phiếu nhập
export async function xoaPhieuNhap(maPhieu) {
  return await callApi('wh_lv0002', 'xoaPhieuNhap', { maPhieu });
}

// Thêm phiếu nhập chi tiết
export async function ThemPhieuNhapChiTietPn(phieuNhapData) {
  const { maPhieu, maSP, soLuong, donGia, ghiChu, maKho } = phieuNhapData;
  return await callApi('wh_lv0003', 'ThemPhieuNhapChiTietPn', {
    maPhieu, maSP, soLuong, donGia, ghiChu, maKho
  });
}

// Fetch all nguyên liệu kho
export async function fetchAllNguyenLieuKho() {
  return await callApi('wh_lv0004', 'fetchAllNguyenLieuKho');
}

// Lấy phiếu nhập by ID
export async function layPhieuNhapById(maPhieu) {
  return await callApi('wh_lv0002', 'layPhieuNhapById', { maPhieu });
}

// Lấy chi tiết phiếu nhập
export async function layCtPhieuNhap(maPhieu) {
  return await callApi('wh_lv0003', 'layCtPhieuNhap', { maPhieu });
}

// Lấy xuất kho
export async function layXuatKho() {
  return await callApi('wh_lv0005', 'layXuatKho');
}

// Lấy phiếu xuất by ID
export async function layPhieuXuatById(maPhieu) {
  return await callApi('wh_lv0005', 'layPhieuXuatById', { maPhieu });
}

// Thêm phiếu xuất chi tiết
export async function themPhieuXuatChiTietPX(phieuXuatData) {
  const { maPhieu, maSP, soLuong, donGia, ghiChu, maKho } = phieuXuatData;
  return await callApi('wh_lv0006', 'themPhieuXuatChiTietPX', {
    maPhieu, maSP, soLuong, donGia, ghiChu, maKho
  });
}

// Xóa phiếu xuất
export async function xoaPhieuXuat(maPhieu) {
  return await callApi('wh_lv0005', 'xoaPhieuXuat', { maPhieu });
}

// Lấy chi tiết phiếu xuất
export async function layCtPhieuXuat(maPhieu) {
  return await callApi('wh_lv0006', 'layCtPhieuXuat', { maPhieu });
}

// Lấy tất cả loại nguyên vật liệu
export async function layAll_LoaiNVL() {
  return await callApi('Mb_NguyenLieu', 'get_DS_LoaiNVL');
}

// Lấy tất cả danh mục sản phẩm (corrected table)
export async function layAllDanhMucSPCorrected() {
  return await callApi('Mb_LoaiNguyenLieu', 'data');
}

// Thêm loại nguyên liệu (corrected parameters)
export async function themLoaiNguyenLieuCorrected(loaiData) {
  const { maLoai, moTa, maLoaiCha, trangThai } = loaiData;
  return await callApi('Mb_LoaiNguyenLieu', 'add', {
    maLoai, moTa, maLoaiCha, trangThai
  });
}

// Thêm nguyên liệu (corrected with more params)
export async function themNguyenLieuCorrected(nguyenLieuData) {
  const { 
    maSanPham, tenSanPham, maLoai, maDonVi, donViTinhQuyDoi, 
    giaTriQuyDoi, gia, donViGia, trangThai_HienThiSP, maKho 
  } = nguyenLieuData;
  return await callApi('Mb_NguyenLieu', 'add', {
    maSanPham, tenSanPham, maLoai, 
    donViTinh: maDonVi, 
    donViQuyDoi: donViTinhQuyDoi, 
    giaTriQuyDoi, gia, donViGia, 
    trangThai_HienThiSP: 0, 
    maKho
  });
}

// Thêm sản phẩm (corrected function)
export async function themSanPhamCorrected(sanPhamData) {
  const { 
    maSanPham, tenSanPham, maLoai, maDonVi, donViTinhQuyDoi, 
    giaTriQuyDoi, gia, donViGia, trangThai_HienThiSP, maKho 
  } = sanPhamData;
  return await callApi('Mb_NguyenLieu', 'add_SP', {
    maSanPham, tenSanPham, maLoai, 
    donViTinh: maDonVi, 
    donViQuyDoi: donViTinhQuyDoi, 
    giaTriQuyDoi, gia, donViGia, 
    trangThai_HienThiSP: 1, 
    maKho
  });
}

// Lấy tất cả danh mục sản phẩm
export async function layAllDanhMucSP() {
  return await callApi('Mb_loaiSanPham', 'data');
}

// Lấy danh sách nguyên vật liệu
export async function layDS_NVL() {
  return await callApi('wh_lv0008', 'layDS_NVL');
}

// Lấy danh sách nguyên vật liệu (version 2 - from features)
export async function layDSNguyenLieu() {
  return await callApi('Mb_NguyenLieu', 'get_dsNVL');
}

// Thêm nguyên liệu
export async function themNguyenLieu(nguyenLieuData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = nguyenLieuData;
  return await callApi('wh_lv0008', 'themNguyenLieu', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// Cập nhật nguyên liệu
export async function capNhatNguyenLieu(nguyenLieuData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = nguyenLieuData;
  return await callApi('wh_lv0008', 'capNhatNguyenLieu', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// Xóa nguyên liệu
export async function xoaNguyenLieu(lv001) {
  return await callApi('wh_lv0008', 'xoaNguyenLieu', { lv001 });
}

// Thêm loại nguyên vật liệu
export async function themLoaiNguyenLieu(loaiData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = loaiData;
  return await callApi('wh_lv0007', 'themLoaiNguyenLieu', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// Cập nhật loại nguyên vật liệu
export async function capNhatLoaiNVL(loaiData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = loaiData;
  return await callApi('wh_lv0007', 'capNhatLoaiNVL', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// Xóa loại nguyên vật liệu
export async function xoaLoaiNVL(lv001) {
  return await callApi('wh_lv0007', 'xoaLoaiNVL', { lv001 });
}

// Thêm sản phẩm
export async function themSanPham(sanPhamData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = sanPhamData;
  return await callApi('sl_lv0007', 'themSanPham', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// Cập nhật sản phẩm
export async function capNhatSanPham(sanPhamData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = sanPhamData;
  return await callApi('sl_lv0007', 'capNhatSanPham', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// Xóa sản phẩm
export async function xoaSanPham(lv001) {
  return await callApi('sl_lv0007', 'xoaSanPham', { lv001 });
}

// -------------------- Functions from features/banhang --------------------

// Load bàn từ banhang
export async function loadBanBanhang(data = {}) {
  return await callApi('sl_lv0009', 'loadBan', data);
}

// Load khu vực từ banhang  
export async function loadKhuVucBanhang(data = {}) {
  return await callApi('sl_lv0008', 'loadKhuVuc', data);
}

// Gộp bàn
export async function gopBanBanhang(maHoaDon, idBanGop) {
  return await callApi('sl_lv0013', 'gopBan', { maHoaDon, idBanGop });
}

// Tách bàn
export async function tachBan(maHoaDon) {
  return await callApi('sl_lv0013', 'tachBan', { maHoaDon });
}

// Load sản phẩm từ banhang
export async function loadSanPhamBanhang(data = {}) {
  return await callApi('sl_lv0007', 'loadSanPham', data);
}

// -------------------- Additional Functions from features/quan-ly --------------------

// Lấy danh sách nguyên vật liệu theo loại
export async function layDanhSachNVL_TheoLoai(maLoai) {
  return await callApi('Mb_NguyenLieu', 'layNVLTheoMaLoai', { idLoai: maLoai });
}

// Cập nhật nguyên liệu (version corrected)
export async function capNhatNguyenLieuFixed(nguyenLieuData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = nguyenLieuData;
  return await callApi('Mb_NguyenLieu', 'edit', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// Xóa nguyên liệu (corrected)
export async function xoaNguyenLieuFixed(maNguyenLieu) {
  return await callApi('Mb_NguyenLieu', 'delete', { maNguyenLieu });
}

// -------------------- Phiếu kiểm kho --------------------

// Lấy danh sách phiếu kiểm kho theo mã kho
export async function layDanhSachPhieuKiemKho(maKho) {
  return await callApi('Mb_KiemKho', 'layDanhSachPhieuKiemTheoKho', { maKho });
}

// Lấy chi tiết phiếu kiểm
export async function layChiTietPhieuKiem(maPK) {
  return await callApi('Mb_ChiTietPK', 'data', { maPK });
}

// Tạo phiếu kiểm kho
export async function taoPhieuKiemKho(phieuKiemData) {
  const { maKho, maNhanVien, chuDe, ghiNhan, trangThai } = phieuKiemData;
  return await callApi('Mb_KiemKho', 'add', {
    maKho, maNhanVien, chuDe, ghiNhan, trangThai
  });
}

// Tạo chi tiết phiếu kiểm kho
export async function taoChiTietPhieuKiemKho(chiTietData) {
  const { maKiemKho, maSanPham, slPM, donViKiem, soLuongThucTe, donViTT } = chiTietData;
  return await callApi('Mb_ChiTietPK', 'add', {
    maKiemKho, maSanPham, slPM, donViKiem, soLuongThucTe, donViTT
  });
}

// Cập nhật chi tiết phiếu kiểm kho
export async function updateChiTietPhieuKiemKho(updateData) {
  const { maKiemKho, maSanPham, soLuongThucTe, donViTT } = updateData;
  return await callApi('Mb_ChiTietPK', 'edit', {
    maKiemKho, maSanPham, soLuongThucTe, donViTT
  });
}

// Xóa chi tiết phiếu kiểm kho
export async function xoaChiTietPhieuKiemKho(deleteData) {
  const { maKiemKho, maSanPham } = deleteData;
  return await callApi('Mb_ChiTietPK', 'delete', { maKiemKho, maSanPham });
}

// Chỉnh sửa trạng thái phiếu kiểm kho
export async function chinhSuaTrangThaiPK(dsMaPK) {
  return await callApi('Mb_KiemKho', 'chinhSuaTrangThai_PK', { dsMaPK });
}

// Lấy thông tin phiếu kiểm by ID
export async function layThongTinPhieuKiemByID(maPK) {
  return await callApi('Mb_KiemKho', 'layThongTinPhieuKiemByID', { maPK });
}

// -------------------- Additional Functions from features/banhang --------------------

// Tạo hóa đơn
export async function taoHoaDon(maBan) {
  return await callApi('sl_lv0013', 'taoHoaDon', { maBan });
}

// Tạo chi tiết hóa đơn
export async function taoCthd(maHd, maSp, soLuong) {
  const result = await callApi('sl_lv0014', 'taoCtHd', { maHd, maSp, soLuong });
  return result;
}

// Load danh sách chi tiết hóa đơn
export async function loadDsCthd(maHd) {
  return await callApi('sl_lv0014', 'loadCtHd', { maHd });
}

// Load danh sách chi tiết hóa đơn V2
export async function loadDsCthdV2(maHd) {
  return await callApi('sl_lv0014', 'loadCtHdV2', { maHd });
}

// Xóa chi tiết hóa đơn
export async function xoaCtHd(data) {
  // Support both direct maCt parameter and object parameter
  const maCt = typeof data === 'object' && data.maCt ? data.maCt : data;
  
  // FIXED: Use correct function name from mobile logic pattern
  const result = await callApi('sl_lv0014', 'xoaCthd', { maCt });
  
  return result;
}

// Chuyển bàn (corrected parameters)
export async function chuyenBanCorrected(chuyenBanData) {
  const { maHoaDonBanCanChuyen, maHoaDonBanChuyen, maBanChuyen } = chuyenBanData;
  return await callApi('sl_lv0013', 'chuyenBan', { 
    maHoaDonBanCanChuyen, maHoaDonBanChuyen, maBanChuyen 
  });
}

// Load hóa đơn theo bàn
export async function loadHoaDonTheoBan(maBan) {
  return await callApi('sl_lv0013', 'loadHoaDonTheoBan', { maBan });
}

// -------------------- Additional missing functions from banhang --------------------

// Thêm khu vực
export async function themKhuVuc(khuVucData) {
  const { lv001, lv002 } = khuVucData;
  return await callApi('sl_lv0008', 'themKhuVuc', { lv001, lv002 });
}

// Cập nhật hóa đơn (thanh toán contract)
export async function capNhatHoaDon(mahd) {
  return await callApi('Mb_thanhtoan', 'thanhToan_contract', { mahd });
}

// Cập nhật hóa đơn 2
export async function capNhatHoaDon2(maHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatHoaDon2', { maHd, trangThai });
}

// Cập nhật hóa đơn trạng thái 4
export async function capNhatHoaDonTT4(maHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatHoaDonTT4', { maHd, trangThai });
}

// Chuyển món
export async function chuyenMon(dsChiTietMonAn, maBanChuyen) {
  return await callApi('sl_lv0013', 'chuyenMonAn', { dsChiTietMonAn, maBanChuyen });
}

// Lấy tất cả sản phẩm (alias)
export async function layALLSanPham() {
  return await callApi('Mb_sanPham', 'data');
}

// -------------------- Additional  functions from commented code in quan-ly --------------------

// Lấy danh sách nguyên vật liệu (uncommented from quan-ly/index.js)
export async function layDSNguyenLieuQuanLy() {
  return await callApi('Mb_NguyenLieu', 'get_dsNVL');
}

// ==================== ENHANCED PAYMENT SYSTEM ====================

// Thanh toán hóa đơn với phương thức chi tiết - Enhanced payment processing
export async function thanhToanHoaDonChiTiet(paymentData) {
  const { 
    maHd, 
    tongTien, 
    tienKhachDua, 
    tienThua, 
    phuongThucThanhToan,
    ghiChu,
    ngayThanhToan 
  } = paymentData;
  
  return await callApi('sl_lv0013', 'thanhToanHoaDonChiTiet', { 
    maHd, 
    tongTien, 
    tienKhachDua, 
    tienThua,
    phuongThucThanhToan,
    ghiChu,
    ngayThanhToan
  });
}

// Lấy lịch sử thanh toán - Get payment history
export async function layLichSuThanhToan(maHd) {
  return await callApi('sl_lv0013', 'layLichSuThanhToan', { maHd });
}

// Lưu thông tin thanh toán - Save payment information
export async function luuThongTinThanhToan(paymentInfo) {
  return await callApi('sl_lv0013', 'luuThongTinThanhToan', paymentInfo);
}

// In hóa đơn thanh toán - Print payment receipt
export async function inHoaDonThanhToan(maHd, paymentDetails) {
  return await callApi('sl_lv0013', 'inHoaDonThanhToan', { 
    maHd, 
    paymentDetails 
  });
}

// Thanh toán hỗn hợp - Mixed payment
export async function thanhToanHonHop(paymentData) {
  const {
    maHd,
    tongTien,
    finalTotal,
    discount,
    mixedPayments,
    ghiChu,
    ngayThanhToan
  } = paymentData;
  
  return await callApi('sl_lv0013', 'thanhToanHonHop', {
    maHd,
    tongTien,
    finalTotal,
    discount,
    mixedPayments: JSON.stringify(mixedPayments),
    ghiChu,
    ngayThanhToan
  });
}

// Lưu chi tiết thanh toán hỗn hợp - Save mixed payment details
export async function luuChiTietThanhToanHonHop(maHd, mixedPayments) {
  return await callApi('sl_lv0013', 'luuChiTietThanhToanHonHop', {
    maHd,
    mixedPayments: JSON.stringify(mixedPayments)
  });
}

// Lấy lịch sử thanh toán hỗn hợp - Get mixed payment history
export async function layLichSuThanhToanHonHop(maHd) {
  return await callApi('sl_lv0013', 'layLichSuThanhToanHonHop', { maHd });
}

// Hủy thanh toán (nếu cần) - Cancel payment
export async function huyThanhToan(maHd, reason) {
  return await callApi('sl_lv0013', 'huyThanhToan', { 
    maHd, 
    reason 
  });
}

// ==================== LEGACY PAYMENT FUNCTION ====================

// Thanh toán hóa đơn bán hàng - Process payment for sales invoice (Legacy)
export async function thanhToanHoaDonBanhang(paymentData) {
  const { maHd, tongTien, tienKhachDua, tienThua } = paymentData;
  return await callApi('sl_lv0013', 'thanhToanHoaDon', { 
    maHd, 
    tongTien, 
    tienKhachDua, 
    tienThua 
  });
}

// Tra tiền (hoàn tất thanh toán) - Final payment completion
// Tương ứng với function tratien(donhangid, bangid, opt) trong sl_lv0201.php
export async function tratien(donhangid, bangid, trangthai, cusid = '') {
  return await callApi('sl_lv0201', 'ajaxaproval', { 
    donhangid,  // Mã hóa đơn
    bangid,     // ID bàn 
    trangthai: 2,  // 1=chờ thanh toán, 2=thanh toán hoàn tất, 3=kích hoạt chờ thanh toán, 4=hủy bill, 5=báo bill
    cusid       // Mã khách hàng (optional)
  });
}

// Check trạng thái bàn sau thanh toán - Check table status after payment  
export async function checkBangStatus(bangid) {
  return await callApi('sl_lv0201', 'ajaxbangid', { 
    bangid      // ID bàn cần check
  });
}

// Cập nhật hóa đơn - Update invoice status (backend function capNhatHd)
export async function capNhatHd(idHd) {
  return await callApi('sl_lv0013', 'capNhatHd', { idHd });
}

// Cập nhật hóa đơn V2 - Update invoice status with flexible state
export async function capNhatHdV2(idHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatHdV2', { idHd, trangThai });
}

// Check và refresh trạng thái bàn - Check and refresh table status (CRITICAL for clearing invoices)
export async function ajaxBangId(bangid) {
  return await callApi('sl_lv0201', 'ajaxbangid', { 
    bangid,
    ajaxbangid: 'ajaxcheck'
  });
}

// Chuyển xuống bếp - Send order to kitchen
export async function chuyenXuongBep(maHd) {
  return await callApi('sl_lv0013', 'chuyenXuongBep', { maHd });
}

// ==================== ORDER PROCESSING SYSTEM COMPLETION ====================

// Xác nhận đơn hàng - Confirm order
export async function xacNhanDonHang(maHd, nguoiXacNhan) {
  return await callApi('sl_lv0013', 'xacNhanDonHang', { 
    maHd, 
    nguoiXacNhan,
    thoiGianXacNhan: new Date().toISOString()
  });
}

// Bắt đầu chuẩn bị - Start preparation
export async function batDauChuanBi(maHd, maNhanVienBep) {
  return await callApi('sl_lv0013', 'batDauChuanBi', { 
    maHd, 
    maNhanVienBep,
    thoiGianBatDau: new Date().toISOString()
  });
}

// Hoàn thành chuẩn bị - Complete preparation
export async function hoanThanhChuanBi(maHd, danhSachMon) {
  return await callApi('sl_lv0013', 'hoanThanhChuanBi', { 
    maHd, 
    danhSachMon,
    thoiGianHoanThanh: new Date().toISOString()
  });
}

// Thông báo món sẵn sàng - Notify order ready
export async function thongBaoMonSanSang(maHd, maBan) {
  return await callApi('sl_lv0013', 'thongBaoMonSanSang', { 
    maHd, 
    maBan,
    thoiGianSanSang: new Date().toISOString()
  });
}

// Giao món cho khách - Deliver order to customer
export async function giaoMonChoKhach(maHd, maBan, nhanVienGiao) {
  return await callApi('sl_lv0013', 'giaoMonChoKhach', { 
    maHd, 
    maBan,
    nhanVienGiao,
    thoiGianGiao: new Date().toISOString()
  });
}

// Theo dõi trạng thái đơn hàng real-time - Track order status
export async function layTrangThaiDonHangRealtime(maHd) {
  return await callApi('sl_lv0013', 'layTrangThaiRealtime', { maHd });
}

// Cập nhật trạng thái từng món - Update individual item status
export async function capNhatTrangThaiMon(idCthd, trangThaiMoi, ghiChu) {
  return await callApi('sl_lv0014', 'capNhatTrangThaiMon', { 
    idCthd, 
    trangThaiMoi,
    ghiChu,
    thoiGianCapNhat: new Date().toISOString()
  });
}

// Cập nhật số lượng chi tiết hóa đơn - Update invoice detail quantity
export async function capNhatCtHd(updateData) {
  // Thử gọi API thật để update số lượng trực tiếp
  const { maCt, soLuong, maHd } = updateData;
  
  const result = await callApi('sl_lv0014', 'capNhatCtHd', { maCt, soLuong, maHd });
  
  return result;
}

// Load trạng thái bàn theo hóa đơn - Get table status based on invoices
export async function loadTrangThaiBanTheoHoaDon(data = {}) {
  return await callApi('sl_lv0013', 'loadTrangThaiBanTheoHoaDon', data);
}

// Load danh mục sản phẩm - Get product categories (following mobile pattern)
export async function loadDanhMucSp(data = {}) {
  return await callApi('sl_lv0006', 'loadDanhMucSp', data);
}

// Load sản phẩm theo mã danh mục - Get products by category ID
export async function loadSanPhamTheoMaDanhMucSp(maDm) {
  return await callApi('sl_lv0007', 'loadSanPhamTheoDmSp', { maDm });
}

// Thêm bàn mới - Add new table
export async function themBan(banData) {
  const { lv002, lv004 } = banData; // tenBan, maKhuVuc
  return await callApi('sl_lv0009', 'themBan', { lv002, lv004 });
}

// Xóa bàn - Delete table
export async function xoaBan(maBan) {
  return await callApi('sl_lv0009', 'xoaBan', { maBan });
}

// Sửa bàn - Edit table
export async function suaBan(banData) {
  const { maBan, tenBan, maKhuVuc } = banData;
  return await callApi('sl_lv0009', 'suaBan', { maBan, tenBan, maKhuVuc });
}

// Hủy hóa đơn - Cancel invoice
export async function huyHoaDon(maHd) {
  return await callApi('sl_lv0013', 'huyHoaDon', { maHd });
}

// Load chi tiết hóa đơn V3 (enhanced version) - Get enhanced invoice details
export async function loadDsCthdV3(maHd) {
  return await callApi('sl_lv0014', 'loadCtHdV3', { maHd });
}

// Cập nhật trạng thái đơn hàng - Update order status
export async function capNhatTrangThaiDonHang(maHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatTrangThai', { maHd, trangThai });
}

// Lấy lịch sử hóa đơn theo bàn - Get invoice history for table
export async function layLichSuHoaDonTheoBan(maBan, fromDate, toDate) {
  return await callApi('sl_lv0013', 'layLichSuHoaDon', { 
    maBan, 
    fromDate, 
    toDate 
  });
}

// Tạo hóa đơn tạm (draft) - Create draft invoice
export async function taoHoaDonTam(maBan) {
  return await callApi('sl_lv0013', 'taoHoaDonTam', { maBan });
}

// Chuyển hóa đơn tạm thành chính thức - Convert draft to official invoice
export async function chuyenHoaDonTamThanhChinhThuc(maHd) {
  return await callApi('sl_lv0013', 'chuyenHdTamThanhChinhThuc', { maHd });
}

// Sao chép hóa đơn - Copy invoice to another table
export async function saoChepHoaDon(maHdGoc, maBanMoi) {
  return await callApi('sl_lv0013', 'saoChepHoaDon', { maHdGoc, maBanMoi });
}

// Tính toán tổng tiền hóa đơn - Calculate invoice total
export async function tinhTongTienHoaDon(maHd) {
  return await callApi('sl_lv0013', 'tinhTongTien', { maHd });
}

// Load thông tin chi tiết bàn (extended) - Get detailed table information
export async function loadThongTinChiTietBan(maBan) {
  return await callApi('sl_lv0009', 'loadThongTinChiTiet', { maBan });
}

// Đặt bàn trước - Reserve table
export async function datBanTruoc(banData) {
  const { maBan, tenKhach, soDienThoai, thoiGianDat, ghiChu } = banData;
  return await callApi('sl_lv0009', 'datBanTruoc', { 
    maBan, 
    tenKhach, 
    soDienThoai, 
    thoiGianDat, 
    ghiChu 
  });
}

// Hủy đặt bàn - Cancel table reservation
export async function huyDatBan(maBan) {
  return await callApi('sl_lv0009', 'huyDatBan', { maBan });
}

// -------------------- Kitchen Order System APIs --------------------

// Lấy danh sách món đang chờ làm - Get pending orders
export async function layDsMonCho() {
  return await callApi('Mb_Oder', 'layDsMonDangChoOder');
}

// Lấy danh sách món nước từ bàn đang bán - Get drink orders from active tables
export async function layDsMonNuoc() {
  return await callApi('Mb_Oder', 'layMonNuocTuBanDangBan');
}

// Lấy danh sách món ăn từ bàn đang bán - Get food orders from active tables
export async function layDsMonAn() {
  return await callApi('Mb_Oder', 'layMonAnTuBanDangBan');
}

// Cập nhật trạng thái món - Update dish status (toggles between pending/completed)
export async function updateTrangThaiMon(itemId) {
  return await callApi('m_updateTrangThaiMon', 'updateTrangThaiMon', { itemId });
}

// Lấy danh sách chi tiết món theo trạng thái - Get dish details by status
export async function layDsMonTheoTrangThai(trangThai) {
  return await callApi('Mb_Oder', 'layDsMonTheoTrangThai', { trangThai });
}

// Lấy danh sách món đã xong - Get completed orders
export async function layDsMonDaXong() {
  return await callApi('Mb_Oder', 'layDsMonDaXong');
}

// -------------------- Enhanced Table Management APIs --------------------

// Gộp bàn - Enhanced merge table function
export async function gopBanEnhanced(maHoaDonBanChinh, maBanGop, bangId) {
  try {
    console.log('gopBanEnhanced params:', { maHoaDonBanChinh, maBanGop, bangId });
    
    const params = new URLSearchParams({
      class: 'sl_lv0013',
      action: 'gopBan',
      idDonHang: maHoaDonBanChinh,
      idBanGop: maBanGop,
      bangid: bangId,
      donhangid: maHoaDonBanChinh
    });

    const response = await fetch(`${GMAC_BASE_URL}/services.sof.vn/index_NChung.php?${params}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const responseText = await response.text();
    console.log('gopBanEnhanced response text:', responseText);
    
    // Kiểm tra nếu response là HTML error
    if (responseText.includes('<br />') || responseText.includes('<b>')) {
      throw new Error('Backend trả về lỗi HTML: ' + responseText.substring(0, 200));
    }
    
    try {
      const result = JSON.parse(responseText);
      console.log('gopBanEnhanced result:', result);
      return result;
    } catch (parseError) {
      console.error('JSON parse error:', parseError);
      throw new Error('Response không phải JSON hợp lệ: ' + responseText.substring(0, 100));
    }
  } catch (error) {
    console.error('Error in gopBanEnhanced:', error);
    throw error;
  }
}

// Chuyển bàn - Enhanced transfer table function  
export async function chuyenBanEnhanced(maHoaDonBanCanChuyen, maBanChuyen) {
  try {
    
    // Sử dụng callApi thay vì fetch trực tiếp để tránh lỗi backend
    const result = await callApi('sl_lv0013', 'chuyenBan', {
      maHoaDonBanCanChuyen: maHoaDonBanCanChuyen,
      maHoaDonBanChuyen: '', // Để trống khi chuyển sang bàn trống
      maBanChuyen: maBanChuyen
    });
    return result;
  } catch (error) {
    console.error('Error in chuyenBanEnhanced:', error);
    throw error;
  }
}

// Tách bàn - Enhanced split table function
export async function tachBanEnhanced(maHoaDon) {
  try {
    console.log('tachBanEnhanced params:', { maHoaDon });
    
    const params = new URLSearchParams({
      class: 'sl_lv0013',
      action: 'tachBan',
      maHoaDon: maHoaDon
    });

    const response = await fetch(`${GMAC_BASE_URL}/services.sof.vn/index_NChung.php?${params}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const responseText = await response.text();
    console.log('tachBanEnhanced response text:', responseText);
    
    // Kiểm tra nếu response là HTML error
    if (responseText.includes('<br />') || responseText.includes('<b>')) {
      throw new Error('Backend trả về lỗi HTML: ' + responseText.substring(0, 200));
    }
    
    try {
      const result = JSON.parse(responseText);
      console.log('tachBanEnhanced result:', result);
      return result;
    } catch (parseError) {
      console.error('JSON parse error:', parseError);
      throw new Error('Response không phải JSON hợp lệ: ' + responseText.substring(0, 100));
    }
  } catch (error) {
    console.error('Error in tachBanEnhanced:', error);
    throw error;
  }
}
