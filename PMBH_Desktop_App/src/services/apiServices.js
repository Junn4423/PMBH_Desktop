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
    console.log(`API Response for ${table}.${func}:`, res.data);
    
    // Đảm bảo trả về array nếu dữ liệu là null hoặc undefined
    if (res.data === null || res.data === undefined) {
      console.warn(`API returned null/undefined for ${table}.${func}`);
      return [];
    }
    
    return res.data;
  } catch (error) {
    // If we get 401 or auth error and haven't retried yet, retry with fresh token
    if ((error.response?.status === 401 || error.message.includes('token')) && retryCount === 0) {
      console.log('Auth error, retrying with fresh token...');
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
    // Không sử dụng mock data, trả về mảng rỗng
    return [];
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
    // Không sử dụng mock data, trả về mảng rỗng
    return [];
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
  // Parse HTML response từ GMAC để lấy dữ liệu khu vực
  // Không sử dụng mock data, cần parse HTML thực tế từ GMAC
  try {
    // TODO: Implement actual HTML parsing từ GMAC hr_lv0004
    console.warn('parseGmacHrData chưa được implement, trả về mảng rỗng');
    return [];
  } catch (error) {
    console.error('Lỗi parse dữ liệu khu vực GMAC:', error);
    return [];
  }
}

// Parse dữ liệu bàn từ GMAC sl_lv0008 response
function parseGmacBanData(htmlData, khuVucId) {
  // Parse HTML response từ GMAC để lấy dữ liệu bàn
  // Không sử dụng mock data, cần parse HTML thực tế từ GMAC
  try {
    // TODO: Implement actual HTML parsing từ GMAC sl_lv0008
    console.warn('parseGmacBanData chưa được implement, trả về mảng rỗng');
    return [];
  } catch (error) {
    console.error('Lỗi parse dữ liệu bàn GMAC:', error);
    return [];
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