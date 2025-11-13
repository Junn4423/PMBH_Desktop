import axios from 'axios';
import { url_chart_api } from './url';
import { callApi } from './api/baseApi';
export async function themChiTietHoaDon(mahd, masp, soluong) {
  return await callApi('Mb_Cthd', 'themCtHd', { mahd, masp, soluong });
}

// Thanh to�n h�a don
export async function thanhToanHoaDon(mahd) {
  return await callApi('Mb_thanhtoan', 'thanhToan_contract', { mahd });
}


// -------------------- Functions from index_Cong.php --------------------

// Th�m nh�n s?
export async function themNhanSu(nhanSuData) {
  return await callApi('hr_NhanSu', 'add', nhanSuData);
}

// S?a nh�n s?
export async function suaNhanSu(nhanSuData) {
  return await callApi('hr_NhanSu', 'edit', nhanSuData);
}

// X�a nh�n s?
export async function xoaNhanSu(lv001) {
  return await callApi('hr_NhanSu', 'delete', { lv001 });
}

// L?y danh s�ch nh�n s?
export async function getDanhSachNhanSu() {
  return await callApi('hr_NhanSu', 'data');
}

// -------------------- Functions from index_KBao.php --------------------

// Th�m kho
export async function themKho(khoData) {
  return await callApi('Mb_Kho', 'add', khoData);
}

// S?a kho
export async function suaKho(khoData) {
  return await callApi('Mb_Kho', 'edit', khoData);
}

// X�a kho
export async function xoaKho(lv001) {
  return await callApi('Mb_Kho', 'delete', { lv001 });
}

// L?y danh s�ch kho
export async function getDanhSachKho() {
  return await callApi('Mb_Kho', 'data');
}

// L?y nguy�n v?t li?u theo m� kho
export async function getNguyenVatLieuTheoMaKho(maKho) {
  return await callApi('Mb_Kho', 'LayNvlTheoMaKho', { maKho });
}

// L?y s? lu?ng t?n kho
export async function getSoLuongTonKho(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKho', { maSP, maKho });
}

// L?y s? lu?ng t?n kho nhi?u s?n ph?m
export async function getSoLuongTonKhoNhieuSP(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP, maKho });
}


// Bao cao kho theo dieu kien
export async function baoCaoKhoTheoDieuKien(params = {}) {
  return await callApi('Mb_BaoCaoKho', 'baoCaoDieuKien', params);
}

// Bao cao xuat nhap ton
export async function baoCaoXuatNhapTon(params = {}) {
  return await callApi('Mb_BaoCaoKho', 'baoCaoXuatNhapTon', params);
}

// Phi?u nh?p kho
export async function listPhieuNhap(params = {}) {
  return await callApi('Mb_PhieuNhap', 'data', params);
}

export async function createPhieuNhap(phieuNhapData = {}) {
  const {
    maKho,
    maNguoiDung,
    ghiChu,
    loaiPhieu,
    maThamChieu,
    trangThai,
    tongTien,
    ngayNhap,
    details = []
  } = phieuNhapData;

  return await callApi('Mb_PhieuNhap', 'add', {
    lv002: maKho ?? phieuNhapData.lv002 ?? '',
    lv003: maNguoiDung ?? phieuNhapData.lv003 ?? '',
    lv004: ghiChu ?? phieuNhapData.lv004 ?? '',
    lv005: loaiPhieu ?? phieuNhapData.lv005 ?? '',
    lv006: maThamChieu ?? phieuNhapData.lv006 ?? '',
    lv007: trangThai ?? phieuNhapData.lv007 ?? '',
    lv008: tongTien ?? phieuNhapData.lv008 ?? 0,
    lv009: ngayNhap ?? phieuNhapData.lv009 ?? '',
    details
  });
}

export async function deletePhieuNhap(maPhieu) {
  return await callApi('Mb_PhieuNhap', 'delete', { maPhieu });
}

export async function getPhieuNhapById(maPhieu) {
  return await callApi('Mb_PhieuNhap', 'LoadPhieuNhap_ByID', { maPhieu });
}

export async function listChiTietPhieuNhap(maPhieu) {
  return await callApi('Mb_ChiTietPhieuNhap', 'data', { maPhieu });
}

// Phi?u xu?t kho
export async function listPhieuXuat(params = {}) {
  return await callApi('Mb_PhieuXuat', 'data', params);
}

export async function createPhieuXuat(phieuXuatData = {}) {
  const {
    maKho,
    maNguoiDung,
    chuDe,
    nguonXuat,
    maThamChieu,
    trangThai,
    ghiChu,
    ngayXuat,
    hinhThucXuat,
    nguoiNhanKho,
    details = []
  } = phieuXuatData;

  return await callApi('Mb_PhieuXuat', 'add', {
    lv002: maKho ?? phieuXuatData.lv002 ?? '',
    lv003: maNguoiDung ?? phieuXuatData.lv003 ?? '',
    lv004: chuDe ?? phieuXuatData.lv004 ?? '',
    lv005: nguonXuat ?? phieuXuatData.lv005 ?? '',
    lv006: maThamChieu ?? phieuXuatData.lv006 ?? '',
    lv007: trangThai ?? phieuXuatData.lv007 ?? '',
    lv008: ghiChu ?? phieuXuatData.lv008 ?? '',
    lv009: ngayXuat ?? phieuXuatData.lv009 ?? '',
    lv010: hinhThucXuat ?? phieuXuatData.lv010 ?? '',
    lv011: nguoiNhanKho ?? phieuXuatData.lv011 ?? '',
    details
  });
}

export async function deletePhieuXuat(maPhieu) {
  return await callApi('Mb_PhieuXuat', 'delete', { maPhieu });
}

export async function getPhieuXuatById(maPhieu) {
  return await callApi('Mb_PhieuXuat', 'LoadPhieuXuat_ByID', { maPhieu });
}

export async function listChiTietPhieuXuat(maPhieu) {
  return await callApi('Mb_ChiTietPhieuXuat', 'data', { maPhieu });
}

// Ki?m kho
export async function listPhieuKiemKho(params = {}) {
  return await callApi('Mb_KiemKho', 'data', params);
}

export async function createPhieuKiemKho(payload = {}) {
  const {
    maKho,
    maNguoiDung,
    chuDe,
    ghiNhan,
    trangThai,
    ngayKiem
  } = payload;

  return await callApi('Mb_KiemKho', 'add', {
    lv002: maKho ?? payload.lv002 ?? '',
    lv003: maNguoiDung ?? payload.lv003 ?? '',
    lv004: chuDe ?? payload.lv004 ?? '',
    lv005: ngayKiem ?? payload.lv005 ?? '',
    lv006: ghiNhan ?? payload.lv006 ?? '',
    lv007: trangThai ?? payload.lv007 ?? ''
  });
}

export async function deletePhieuKiemKho(maPhieuKiem) {
  return await callApi('Mb_KiemKho', 'delete', { maPhieuKiem });
}

export async function getPhieuKiemKhoByKho(maKho) {
  return await callApi('Mb_KiemKho', 'layDanhSachPhieuKiemTheoKho', { lv002: maKho });
}

export async function updateTrangThaiPhieuKiem(dsMaPK = []) {
  return await callApi('Mb_KiemKho', 'chinhSuaTrangThai_PK', { dsMaPK });
}

export async function getPhieuKiemKhoById(maPK) {
  return await callApi('Mb_KiemKho', 'layThongTinPhieuKiemByID', { maPK });
}

export async function listChiTietPhieuKiem(maPK) {
  return await callApi('Mb_ChiTietPK', 'data', { maPK });
}

export async function addChiTietPhieuKiem(chiTiet = {}) {
  const {
    maKiemKho,
    maSanPham,
    slPM,
    donViKiem,
    soLuongThucTe,
    donViTT
  } = chiTiet;

  return await callApi('Mb_ChiTietPK', 'add', {
    maKiemKho,
    maSanPham,
    slPM,
    donViKiem,
    soLuongThucTe,
    donViTT
  });
}

export async function updateChiTietPhieuKiem(chiTiet = {}) {
  const {
    maKiemKho,
    maSanPham,
    soLuongThucTe,
    donViTT
  } = chiTiet;

  return await callApi('Mb_ChiTietPK', 'edit', {
    maKiemKho,
    maSanPham,
    soLuongThucTe,
    donViTT
  });
}

export async function deleteChiTietPhieuKiem(maKiemKho, maSanPham) {
  return await callApi('Mb_ChiTietPK', 'delete', { maKiemKho, maSanPham });
}

// Nguy�n li?u
export async function listTatCaNguyenLieu() {
  return await callApi('Mb_NguyenLieu', 'layAllNguyenLieu');
}

// -------------------- Functions from index_long.php --------------------

// L?y danh s�ch b�n
export async function getDanhSachBan() {
  return await callApi('Mb_LayDsBan', 'data');
}

// L?y t?ng chi ti?t h�a don - h�a don c� m�n - chua thanh to�n v� thanh to�n r?i
export async function getTongChiTietHoaDon() {
  return await callApi('Mb_TongCthd', 'data');
}
// L?y chi ti?t h�a don - k? c? h�a don r?ng
export async function getChiTietHoaDonRong() {
  return await callApi('Mb_TongCthdRong', 'data');
}

// L?y chi ti?t h�a don theo m� h�a don
export async function getChiTietHoaDonTheoMaHD(maHd) {
  return await callApi('Mb_LayCthd_', 'layCtHd', { maHd });
}

// G?p b�n
export async function gopBan(idDonHang, idBanGop) {
  return await callApi('m_GopBan', 'add', { idDonHang, idBanGop });
}

// Load b�n
export async function loadBan() {
  return await callApi('Mb_LayDsBan', 'data');
}

// Load khu v?c 
export async function loadKhuVuc() {
  return await callApi('sl_lv0008', 'loadKhuVuc');
}

// Th�m khu v?c / t?ng
export async function themKhuVuc(khuVucData) {
  const { lv001, lv002 } = khuVucData;
  return await callApi('sl_lv0008', 'themKhuVuc', { lv001, lv002 });
}

// S?a khu v?c / t?ng
export async function suaKhuVuc(khuVucData = {}) {
  const {
    lv001,
    lv002,
    maKhuVuc,
    tenKhuVuc,
    ...rest
  } = khuVucData;

  // API expects lv001 and lv002 as parameter names
  return await callApi('sl_lv0008', 'suaKhuVuc', {
    lv001: maKhuVuc ?? lv001,
    lv002: tenKhuVuc ?? lv002,
    ...rest
  });
}

// X�a khu v?c / t?ng
export async function xoaKhuVuc(khuVuc) {
  const maKhuVuc = typeof khuVuc === 'string'
    ? khuVuc
    : khuVuc?.maKhuVuc ?? khuVuc?.lv001;

  // API expects lv001 as parameter name
  return await callApi('sl_lv0008', 'xoaKhuVuc', { lv001: maKhuVuc });
}

// Load don v?
export async function loadDonVi() {
  return await callApi('sl_lv0005', 'loadDonVi');
}

// Th�m don v?
export async function themDonVi(donViData) {
  const { lv001, lv002, lv003 } = donViData;
  return await callApi('sl_lv0005', 'themDonVi', { lv001, lv002, lv003 });
}

// S?a don v?
export async function suaDonVi(donViData) {
  const { lv001, lv002, lv003 } = donViData;
  return await callApi('sl_lv0005', 'suaDonVi', { lv001, lv002, lv003 });
}

// X�a don v?
export async function xoaDonVi(lv001) {
  return await callApi('sl_lv0005', 'xoaDonVi', { lv001 });
}

// T?o don h�ng
export async function taoDonHang(idBan) {
  return await callApi('Mb_TaoDonHang', 'add', { idBan });
}

// -------------------- Functions from index_NChung.php --------------------

//L?y m� h�a, t�n b�n, v? tr�, tr?ng th�i t? b�n dang b�n
export async function getMaHoaDonTuBanDangBan(banId) {
  return await callApi('m_loadBan', 'load', { banId });
}

// L?y danh s�ch m�n dang ch? order
export async function getDsMonDangChoOrder() {
  return await callApi('Mb_Oder', 'layDsMonDangChoOder');
}

// L?y m�n an t? b�n dang b�n
export async function getMonAnTuBanDangBan() {
  return await callApi('Mb_Oder', 'layMonAnTuBanDangBan');
}

// L?y m�n nu?c t? b�n dang b�n
export async function getMonNuocTuBanDangBan() {
  return await callApi('Mb_Oder', 'layMonNuocTuBanDangBan');
}

// L?y danh s�ch m�n d� xong
export async function getDsMonDaXong() {
  return await callApi('Mb_Oder', 'layDsMonDaXong');
}

// L?y th�ng tin don h�ng theo b�n
export async function getThongTinDonHang(banid) {
  return await callApi('m_CheckTrangThai', 'layThongTinDonHang', { banid });
}

// Th�m nh�n s?
export async function addNhanSu(data) {
  return await callApi('hr_NhanSu', 'add', data);
}

// S?a nh�n s?
export async function editNhanSu(data) {
  return await callApi('hr_NhanSu', 'edit', data);
}

// X�a nh�n s?
export async function deleteNhanSu(lv001) {
  return await callApi('hr_NhanSu', 'delete', { lv001 });
}

// -------------------- Functions from index_KBao.php --------------------

// L?y d? li?u kho
export async function getKhoData() {
  return await callApi('Mb_Kho', 'data');
}

// Th�m kho
export async function addKho(data) {
  return await callApi('Mb_Kho', 'add', data);
}

// S?a kho
export async function editKho(data) {
  return await callApi('Mb_Kho', 'edit', data);
}

// X�a kho
export async function deleteKho(lv001) {
  return await callApi('Mb_Kho', 'delete', { lv001 });
}

// L?y NVL theo m� kho
export async function getNvlTheoMaKho(maKho) {
  return await callApi('Mb_Kho', 'LayNvlTheoMaKho', { maKho });
}

// L?y s? lu?ng t?n kho nhi?u SP (version 2)
export async function getSoLuongTonKhoNhieuSPv2(maSPArr, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP: maSPArr, maKho });
}



// -------------------- GMAC API Integration - Real Implementation --------------------
// T�ch h?p v?i GMAC API th?c t? d? l?y d? li?u khu v?c v� b�n

const GMAC_BASE_URL = 'http://localhost/gmac'; // URL c?a GMAC server

// API th?c d? l?y danh s�ch khu v?c t? GMAC hr_lv0004
export async function getGmacKhuVucList() {
  try {
    // Th? g?i API th?c t? GMAC hr_lv0004
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
      throw new Error('GMAC API kh�ng kh? d?ng');
    }
  } catch (error) {
    console.error('GMAC API kh�ng kh? d?ng:', error);
    throw error;
  }
}

// API th?c d? l?y danh s�ch b�n t? GMAC sl_lv0008 theo khu v?c
export async function getGmacBanListByKhuVuc(khuVucId) {
  try {
    // Th? g?i API th?c t? GMAC sl_lv0008
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
      throw new Error('GMAC API kh�ng kh? d?ng');
    }
  } catch (error) {
    console.error('GMAC API kh�ng kh? d?ng:', error);
    throw error;
  }
}

// API d? t?o don h�ng th?c qua GMAC sl_lv0201
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
      throw new Error('Kh�ng th? t?o don h�ng qua GMAC');
    }
  } catch (error) {
    console.error('Error creating GMAC order:', error);
    return {
      success: false,
      error: error.message
    };
  }
}

// Parse d? li?u khu v?c t? GMAC hr_lv0004 response
function parseGmacHrData(htmlData) {
  try {
    // TODO: Implement actual HTML parsing t? GMAC hr_lv0004
    console.warn('parseGmacHrData chua du?c implement');
    throw new Error('parseGmacHrData chua du?c implement');
  } catch (error) {
    console.error('L?i parse d? li?u khu v?c GMAC:', error);
    throw error;
  }
}

// Parse d? li?u b�n t? GMAC sl_lv0008 response
function parseGmacBanData(htmlData, khuVucId) {
  try {
    // TODO: Implement actual HTML parsing t? GMAC sl_lv0008
    console.warn('parseGmacBanData chua du?c implement');
    throw new Error('parseGmacBanData chua du?c implement');
  } catch (error) {
    console.error('L?i parse d? li?u b�n GMAC:', error);
    throw error;
  }
}

// Parse k?t qu? t?o don h�ng t? GMAC sl_lv0201
function parseGmacOrderResult(rawData) {
  // Parse response t? GMAC sl_lv0201.php
  // T�m [CHECKHOPDONG] v� [CHECKORDER] patterns nhu trong source code
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

// L?y s? lu?ng t?n kho
export async function laySoLuongTonKho(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKho', { maSP, maKho });
}

// L?y s? lu?ng t?n kho nhi?u s?n ph?m
export async function laySoLuongTonKhoNhieuSP(maSP, maKho) {
  return await callApi('Mb_Kho', 'LaySoLuongTonKhoNhieuSP', { maSP, maKho });
}

// Load kho t? features
export async function loadKhoFeatures(data = {}) {
  return await callApi('wh_lv0001', 'loadKho', data);
}

// Th�m kho
export async function themKhoFeatures(khoData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = khoData;
  return await callApi('wh_lv0001', 'themKho', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// C?p nh?t kho
export async function capNhatKhoFeatures(khoData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = khoData;
  return await callApi('wh_lv0001', 'capNhatKho', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// X�a kho
export async function xoaKhoFeatures(lv001) {
  return await callApi('wh_lv0001', 'xoaKho', { lv001 });
}

// Load s?n ph?m theo ID kho
export async function loadSanPhamTheoIdKho(idKho) {
  return await callApi('sl_lv0007', 'loadSanPhamTheoIdKho', { idKho });
}

// Load phi?u nh?p
export async function loadPhieuNhap(data = {}) {
  return await callApi('wh_lv0002', 'loadPhieuNhap', data);
}

// X�a phi?u nh?p
export async function xoaPhieuNhap(maPhieu) {
  return await callApi('wh_lv0002', 'xoaPhieuNhap', { maPhieu });
}

// Th�m phi?u nh?p chi ti?t
export async function ThemPhieuNhapChiTietPn(phieuNhapData) {
  const { maPhieu, maSP, soLuong, donGia, ghiChu, maKho } = phieuNhapData;
  return await callApi('wh_lv0003', 'ThemPhieuNhapChiTietPn', {
    maPhieu, maSP, soLuong, donGia, ghiChu, maKho
  });
}

// Fetch all nguy�n li?u kho
export async function fetchAllNguyenLieuKho() {
  return await callApi('wh_lv0004', 'fetchAllNguyenLieuKho');
}

// L?y phi?u nh?p by ID
export async function layPhieuNhapById(maPhieu) {
  return await callApi('wh_lv0002', 'layPhieuNhapById', { maPhieu });
}

// L?y chi ti?t phi?u nh?p
export async function layCtPhieuNhap(maPhieu) {
  return await callApi('wh_lv0003', 'layCtPhieuNhap', { maPhieu });
}

// L?y xu?t kho
export async function layXuatKho() {
  return await callApi('wh_lv0005', 'layXuatKho');
}

// L?y phi?u xu?t by ID
export async function layPhieuXuatById(maPhieu) {
  return await callApi('wh_lv0005', 'layPhieuXuatById', { maPhieu });
}

// Th�m phi?u xu?t chi ti?t
export async function themPhieuXuatChiTietPX(phieuXuatData) {
  const { maPhieu, maSP, soLuong, donGia, ghiChu, maKho } = phieuXuatData;
  return await callApi('wh_lv0006', 'themPhieuXuatChiTietPX', {
    maPhieu, maSP, soLuong, donGia, ghiChu, maKho
  });
}

// X�a phi?u xu?t
export async function xoaPhieuXuat(maPhieu) {
  return await callApi('wh_lv0005', 'xoaPhieuXuat', { maPhieu });
}

// L?y chi ti?t phi?u xu?t
export async function layCtPhieuXuat(maPhieu) {
  return await callApi('wh_lv0006', 'layCtPhieuXuat', { maPhieu });
}

// L?y t?t c? lo?i nguy�n v?t li?u
export async function layAll_LoaiNVL() {
  return await callApi('Mb_NguyenLieu', 'get_DS_LoaiNVL');
}

// L?y t?t c? danh m?c s?n ph?m (corrected table)
export async function layAllDanhMucSPCorrected() {
  return await callApi('Mb_LoaiNguyenLieu', 'data');
}

// Th�m lo?i nguy�n li?u (corrected parameters)
export async function themLoaiNguyenLieuCorrected(loaiData) {
  const { maLoai, moTa, maLoaiCha, trangThai } = loaiData;
  return await callApi('Mb_LoaiNguyenLieu', 'add', {
    maLoai, moTa, maLoaiCha, trangThai
  });
}

// Th�m nguy�n li?u (corrected with more params)
export async function themNguyenLieuCorrected(nguyenLieuData) {
  const { 
    maSanPham, tenSanPham, maLoai, maDonVi, donViTinhQuyDoi, 
    giaTriQuyDoi, gia, donViGia, maKho 
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

// Th�m s?n ph?m (corrected function)
export async function themSanPhamCorrected(sanPhamData) {
  const { 
    maSanPham, tenSanPham, maLoai, maDonVi, donViTinhQuyDoi, 
    giaTriQuyDoi, gia, donViGia, maKho 
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

// L?y t?t c? danh m?c s?n ph?m
export async function layAllDanhMucSP() {
  return await callApi('Mb_loaiSanPham', 'data');
}

// L?y danh s�ch nguy�n v?t li?u
export async function layDS_NVL() {
  return await callApi('wh_lv0008', 'layDS_NVL');
}

// L?y danh s�ch nguy�n v?t li?u (version 2 - from features)
export async function layDSNguyenLieu() {
  return await callApi('Mb_NguyenLieu', 'get_dsNVL');
}

// Th�m nguy�n li?u
export async function themNguyenLieu(nguyenLieuData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = nguyenLieuData;
  return await callApi('wh_lv0008', 'themNguyenLieu', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// C?p nh?t nguy�n li?u
export async function capNhatNguyenLieu(nguyenLieuData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = nguyenLieuData;
  return await callApi('wh_lv0008', 'capNhatNguyenLieu', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// X�a nguy�n li?u
export async function xoaNguyenLieu(lv001) {
  return await callApi('wh_lv0008', 'xoaNguyenLieu', { lv001 });
}

// Th�m lo?i nguy�n v?t li?u
export async function themLoaiNguyenLieu(loaiData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = loaiData;
  return await callApi('wh_lv0007', 'themLoaiNguyenLieu', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// C?p nh?t lo?i nguy�n v?t li?u
export async function capNhatLoaiNVL(loaiData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008 } = loaiData;
  return await callApi('wh_lv0007', 'capNhatLoaiNVL', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008
  });
}

// X�a lo?i nguy�n v?t li?u
export async function xoaLoaiNVL(lv001) {
  return await callApi('wh_lv0007', 'xoaLoaiNVL', { lv001 });
}

const DEFAULT_SANPHAM_CURRENCY = 'VND';
const DEFAULT_SANPHAM_CONVERSION = 1;

const hasLvStructure = (data) => (
  data &&
  (Object.prototype.hasOwnProperty.call(data, 'lv001') ||
   Object.prototype.hasOwnProperty.call(data, 'lv002') ||
   Object.prototype.hasOwnProperty.call(data, 'lv003'))
);

const toTrimmedString = (value, fallback = '') => {
  if (value === null || value === undefined) {
    return fallback;
  }
  return value.toString().trim();
};

const toNumber = (value, fallback = 0) => {
  if (value === null || value === undefined || value === '') {
    return fallback;
  }

  if (typeof value === 'number') {
    return Number.isNaN(value) ? fallback : value;
  }

  if (typeof value === 'string') {
    const cleaned = value.replace(/[^0-9.-]/g, '');
    const parsed = Number(cleaned);
    return Number.isNaN(parsed) ? fallback : parsed;
  }

  if (typeof value === 'boolean') {
    return value ? 1 : 0;
  }

  if (typeof value === 'object' && value !== null && 'value' in value) {
    return toNumber(value.value, fallback);
  }

  const parsed = Number(value);
  return Number.isNaN(parsed) ? fallback : parsed;
};

const buildSanPhamPayload = (data, { includeImage = false } = {}) => {
  if (!data || typeof data !== 'object') {
    return {};
  }

  if (hasLvStructure(data)) {
    const {
      lv001 = '',
      lv002 = '',
      lv003 = '',
      lv004 = '',
      lv005 = '',
      lv006 = DEFAULT_SANPHAM_CONVERSION,
      lv007 = 0,
      lv008 = DEFAULT_SANPHAM_CURRENCY,
      lv009 = 0,
      lv010 = 0,
      lv014 = ''
    } = data;

    const payload = {
      lv001,
      lv002,
      lv003,
      lv004,
      lv005,
      lv006,
      lv007,
      lv008,
      lv009,
      lv010
    };

    if (includeImage || Object.prototype.hasOwnProperty.call(data, 'lv014')) {
      payload.lv014 = lv014;
    }

    return payload;
  }

  const payload = {
    lv001: toTrimmedString(data.maSanPham ?? data.id ?? data.maSp ?? data.maSP ?? ''),
    lv002: toTrimmedString(data.tenSanPham ?? data.ten ?? data.tenSp ?? data.tenSP ?? ''),
    lv003: toTrimmedString(data.maLoai ?? data.danhMuc ?? data.idLoai ?? ''),
    lv004: toTrimmedString(data.donViTinh ?? data.donVi ?? data.dvt ?? ''),
    lv005: toTrimmedString(data.donViQuyDoi ?? data.donViTinh ?? data.donVi ?? data.dvt ?? ''),
    lv006: toNumber(data.giaTriQuyDoi ?? data.tyLeQuyDoi ?? DEFAULT_SANPHAM_CONVERSION, DEFAULT_SANPHAM_CONVERSION),
    lv007: toNumber(data.giaBan ?? data.gia ?? data.donGia ?? data.price ?? 0, 0),
    lv008: toTrimmedString(data.donViGia ?? data.currency ?? DEFAULT_SANPHAM_CURRENCY, DEFAULT_SANPHAM_CURRENCY),
    lv009: toNumber(data.trangThai ?? data.trangThai_HienThiSP ?? data.status ?? 0, 0),
    lv010: toNumber(data.soLuongTonToiThieu ?? data.tonKhoToiThieu ?? data.limitTonKho ?? 0, 0)
  };

  if (includeImage || data.imageUrl !== undefined || data.hinhAnh !== undefined) {
    payload.lv014 = toTrimmedString(data.imageUrl ?? data.hinhAnh ?? '');
  }

  return payload;
};

// Th�m s?n ph?m
export async function themSanPham(sanPhamData) {
  const payload = buildSanPhamPayload(sanPhamData, { includeImage: true });
  return await callApi('Mb_sanPham', 'add', payload);
}

// C?p nh?t s?n ph?m
export async function capNhatSanPham(sanPhamData) {
  const includeImage = sanPhamData && (sanPhamData.imageUrl !== undefined || sanPhamData.lv014 !== undefined);
  const payload = buildSanPhamPayload(sanPhamData, { includeImage });
  return await callApi('Mb_sanPham', 'edit', payload);
}

// X�a s?n ph?m
export async function xoaSanPham(lv001) {
  return await callApi('Mb_sanPham', 'delete', { lv001 });
}

// -------------------- Functions from features/banhang --------------------

// Load b�n t? banhang
export async function loadBanBanhang(data = {}) {
  return await callApi('sl_lv0009', 'loadBan', data);
}

// Load khu v?c t? banhang  
export async function loadKhuVucBanhang(data = {}) {
  return await callApi('sl_lv0008', 'loadKhuVuc', data);
}

// G?p b�n
export async function gopBanBanhang(maHoaDon, idBanGop) {
  return await callApi('sl_lv0013', 'gopBan', { maHoaDon, idBanGop });
}

// T�ch b�n
export async function tachBan(maHoaDon) {
  return await callApi('sl_lv0013', 'tachBan', { maHoaDon });
}

// Load s?n ph?m t? banhang
export async function loadSanPhamBanhang(data = {}) {
  return await callApi('sl_lv0007', 'loadSanPham', data);
}

// -------------------- Additional Functions from features/quan-ly --------------------

// L?y danh s�ch nguy�n v?t li?u theo lo?i
export async function layDanhSachNVL_TheoLoai(maLoai) {
  return await callApi('Mb_NguyenLieu', 'layNVLTheoMaLoai', { idLoai: maLoai });
}

// C?p nh?t nguy�n li?u (version corrected)
export async function capNhatNguyenLieuFixed(nguyenLieuData) {
  const { lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020 } = nguyenLieuData;
  return await callApi('Mb_NguyenLieu', 'edit', {
    lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
    lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020
  });
}

// X�a nguy�n li?u (corrected)
export async function xoaNguyenLieuFixed(maNguyenLieu) {
  return await callApi('Mb_NguyenLieu', 'delete', { maNguyenLieu });
}

// -------------------- Phi?u ki?m kho --------------------

// L?y danh s�ch phi?u ki?m kho theo m� kho
export async function layDanhSachPhieuKiemKho(maKho) {
  return await callApi('Mb_KiemKho', 'layDanhSachPhieuKiemTheoKho', { maKho });
}

// L?y chi ti?t phi?u ki?m
export async function layChiTietPhieuKiem(maPK) {
  return await callApi('Mb_ChiTietPK', 'data', { maPK });
}

// T?o phi?u ki?m kho
export async function taoPhieuKiemKho(phieuKiemData) {
  const { maKho, maNhanVien, chuDe, ghiNhan, trangThai } = phieuKiemData;
  return await callApi('Mb_KiemKho', 'add', {
    maKho, maNhanVien, chuDe, ghiNhan, trangThai
  });
}

// T?o chi ti?t phi?u ki?m kho
export async function taoChiTietPhieuKiemKho(chiTietData) {
  const { maKiemKho, maSanPham, slPM, donViKiem, soLuongThucTe, donViTT } = chiTietData;
  return await callApi('Mb_ChiTietPK', 'add', {
    maKiemKho, maSanPham, slPM, donViKiem, soLuongThucTe, donViTT
  });
}

// C?p nh?t chi ti?t phi?u ki?m kho
export async function updateChiTietPhieuKiemKho(updateData) {
  const { maKiemKho, maSanPham, soLuongThucTe, donViTT } = updateData;
  return await callApi('Mb_ChiTietPK', 'edit', {
    maKiemKho, maSanPham, soLuongThucTe, donViTT
  });
}

// X�a chi ti?t phi?u ki?m kho
export async function xoaChiTietPhieuKiemKho(deleteData) {
  const { maKiemKho, maSanPham } = deleteData;
  return await callApi('Mb_ChiTietPK', 'delete', { maKiemKho, maSanPham });
}

// Ch?nh s?a tr?ng th�i phi?u ki?m kho
export async function chinhSuaTrangThaiPK(dsMaPK) {
  return await callApi('Mb_KiemKho', 'chinhSuaTrangThai_PK', { dsMaPK });
}

// L?y th�ng tin phi?u ki?m by ID
export async function layThongTinPhieuKiemByID(maPK) {
  return await callApi('Mb_KiemKho', 'layThongTinPhieuKiemByID', { maPK });
}

// -------------------- Additional Functions from features/banhang --------------------

// T?o h�a don
export async function taoHoaDon(maBan) {
  return await callApi('sl_lv0013', 'taoHoaDon', { maBan });
}

// T?o chi ti?t h�a don
export async function taoCthd(maHd, maSp, soLuong) {
  const result = await callApi('sl_lv0014', 'taoCtHd', { maHd, maSp, soLuong });
  return result;
}

// Load danh s�ch chi ti?t h�a don
export async function loadDsCthd(maHd) {
  return await callApi('sl_lv0014', 'loadCtHd', { maHd });
}

// Load danh s�ch chi ti?t h�a don V2
export async function loadDsCthdV2(maHd) {
  return await callApi('sl_lv0014', 'loadCtHdV2', { maHd });
}

// X�a chi ti?t h�a don
export async function xoaCtHd(data) {
  // Support both direct maCt parameter and object parameter
  const maCt = typeof data === 'object' && data.maCt ? data.maCt : data;
  
  // FIXED: Use correct function name from mobile logic pattern
  const result = await callApi('sl_lv0014', 'xoaCthd', { maCt });
  
  return result;
}

// Chuy?n b�n (corrected parameters)
export async function chuyenBanCorrected(chuyenBanData) {
  const { maHoaDonBanCanChuyen, maHoaDonBanChuyen, maBanChuyen } = chuyenBanData;
  return await callApi('sl_lv0013', 'chuyenBan', { 
    maHoaDonBanCanChuyen, maHoaDonBanChuyen, maBanChuyen 
  });
}

// Load h�a don theo b�n
export async function loadHoaDonTheoBan(maBan) {
  return await callApi('sl_lv0013', 'loadHoaDonTheoBan', { maBan });
}

// -------------------- Additional missing functions from banhang --------------------

// C?p nh?t h�a don (thanh to�n contract)
export async function capNhatHoaDon(mahd) {
  return await callApi('Mb_thanhtoan', 'thanhToan_contract', { mahd });
}

// C?p nh?t h�a don 2
export async function capNhatHoaDon2(maHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatHoaDon2', { maHd, trangThai });
}

// C?p nh?t h�a don tr?ng th�i 4
export async function capNhatHoaDonTT4(maHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatHoaDonTT4', { maHd, trangThai });
}

// Chuy?n m�n
export async function chuyenMon(dsChiTietMonAn, maBanChuyen) {
  return await callApi('sl_lv0013', 'chuyenMonAn', { dsChiTietMonAn, maBanChuyen });
}

// L?y t?t c? s?n ph?m (alias)
export async function layALLSanPham() {
  return await callApi('Mb_sanPham', 'data');
}

// -------------------- Additional  functions from commented code in quan-ly --------------------

// L?y danh s�ch nguy�n v?t li?u (uncommented from quan-ly/index.js)
export async function layDSNguyenLieuQuanLy() {
  return await callApi('Mb_NguyenLieu', 'get_dsNVL');
}

// ==================== ENHANCED PAYMENT SYSTEM ====================

// Thanh to�n h�a don v?i phuong th?c chi ti?t - Enhanced payment processing
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

// L?y l?ch s? thanh to�n - Get payment history
export async function layLichSuThanhToan(maHd) {
  return await callApi('sl_lv0013', 'layLichSuThanhToan', { maHd });
}

// Luu th�ng tin thanh to�n - Save payment information
export async function luuThongTinThanhToan(paymentInfo) {
  return await callApi('sl_lv0013', 'luuThongTinThanhToan', paymentInfo);
}

// In h�a don thanh to�n - Print payment receipt
export async function inHoaDonThanhToan(maHd, paymentDetails) {
  return await callApi('sl_lv0013', 'inHoaDonThanhToan', { 
    maHd, 
    paymentDetails 
  });
}

// Thanh to�n h?n h?p - Mixed payment
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

// Luu chi ti?t thanh to�n h?n h?p - Save mixed payment details
export async function luuChiTietThanhToanHonHop(maHd, mixedPayments) {
  return await callApi('sl_lv0013', 'luuChiTietThanhToanHonHop', {
    maHd,
    mixedPayments: JSON.stringify(mixedPayments)
  });
}

// L?y l?ch s? thanh to�n h?n h?p - Get mixed payment history
export async function layLichSuThanhToanHonHop(maHd) {
  return await callApi('sl_lv0013', 'layLichSuThanhToanHonHop', { maHd });
}

// H?y thanh to�n (n?u c?n) - Cancel payment
export async function huyThanhToan(maHd, reason) {
  return await callApi('sl_lv0013', 'huyThanhToan', { 
    maHd, 
    reason 
  });
}

// ==================== LEGACY PAYMENT FUNCTION ====================

// Thanh to�n h�a don b�n h�ng - Process payment for sales invoice (Legacy)
export async function thanhToanHoaDonBanhang(paymentData) {
  const { maHd, tongTien, tienKhachDua, tienThua } = paymentData;
  return await callApi('sl_lv0013', 'thanhToanHoaDon', { 
    maHd, 
    tongTien, 
    tienKhachDua, 
    tienThua 
  });
}

// Tra ti?n (ho�n t?t thanh to�n) - Final payment completion
// Tuong ?ng v?i function tratien(donhangid, bangid, opt) trong sl_lv0201.php
export async function tratien(donhangid, bangid, trangthai, cusid = '') {
  return await callApi('sl_lv0201', 'ajaxaproval', { 
    donhangid,  // M� h�a don
    bangid,     // ID b�n 
    trangthai: 2,  // 1=ch? thanh to�n, 2=thanh to�n ho�n t?t, 3=k�ch ho?t ch? thanh to�n, 4=h?y bill, 5=b�o bill
    cusid       // M� kh�ch h�ng (optional)
  });
}

// Check tr?ng th�i b�n sau thanh to�n - Check table status after payment  
export async function checkBangStatus(bangid) {
  return await callApi('sl_lv0201', 'ajaxbangid', { 
    bangid      // ID b�n c?n check
  });
}

// C?p nh?t h�a don - Update invoice status (backend function capNhatHd)
export async function capNhatHd(idHd) {
  return await callApi('sl_lv0013', 'capNhatHd', { idHd });
}

// C?p nh?t h�a don V2 - Update invoice status with flexible state
export async function capNhatHdV2(idHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatHdV2', { idHd, trangThai });
}

// Check v� refresh tr?ng th�i b�n - Check and refresh table status (CRITICAL for clearing invoices)
export async function ajaxBangId(bangid) {
  return await callApi('sl_lv0201', 'ajaxbangid', { 
    bangid,
    ajaxbangid: 'ajaxcheck'
  });
}

// Chuy?n xu?ng b?p - Send order to kitchen
export async function chuyenXuongBep(maHd) {
  return await callApi('sl_lv0013', 'chuyenXuongBep', { maHd });
}

// ==================== ORDER PROCESSING SYSTEM COMPLETION ====================

// X�c nh?n don h�ng - Confirm order
export async function xacNhanDonHang(maHd, nguoiXacNhan) {
  return await callApi('sl_lv0013', 'xacNhanDonHang', { 
    maHd, 
    nguoiXacNhan,
    thoiGianXacNhan: new Date().toISOString()
  });
}

// B?t d?u chu?n b? - Start preparation
export async function batDauChuanBi(maHd, maNhanVienBep) {
  return await callApi('sl_lv0013', 'batDauChuanBi', { 
    maHd, 
    maNhanVienBep,
    thoiGianBatDau: new Date().toISOString()
  });
}

// Ho�n th�nh chu?n b? - Complete preparation
export async function hoanThanhChuanBi(maHd, danhSachMon) {
  return await callApi('sl_lv0013', 'hoanThanhChuanBi', { 
    maHd, 
    danhSachMon,
    thoiGianHoanThanh: new Date().toISOString()
  });
}

// Th�ng b�o m�n s?n s�ng - Notify order ready
export async function thongBaoMonSanSang(maHd, maBan) {
  return await callApi('sl_lv0013', 'thongBaoMonSanSang', { 
    maHd, 
    maBan,
    thoiGianSanSang: new Date().toISOString()
  });
}

// Giao m�n cho kh�ch - Deliver order to customer
export async function giaoMonChoKhach(maHd, maBan, nhanVienGiao) {
  return await callApi('sl_lv0013', 'giaoMonChoKhach', { 
    maHd, 
    maBan,
    nhanVienGiao,
    thoiGianGiao: new Date().toISOString()
  });
}

// Theo d�i tr?ng th�i don h�ng real-time - Track order status
export async function layTrangThaiDonHangRealtime(maHd) {
  return await callApi('sl_lv0013', 'layTrangThaiRealtime', { maHd });
}

// C?p nh?t tr?ng th�i t?ng m�n - Update individual item status
export async function capNhatTrangThaiMon(idCthd, trangThaiMoi, ghiChu) {
  return await callApi('sl_lv0014', 'capNhatTrangThaiMon', { 
    idCthd, 
    trangThaiMoi,
    ghiChu,
    thoiGianCapNhat: new Date().toISOString()
  });
}

// C?p nh?t s? lu?ng chi ti?t h�a don - Update invoice detail quantity
export async function capNhatCtHd(updateData) {
  // Th? g?i API th?t d? update s? lu?ng tr?c ti?p
  const { maCt, soLuong, maHd } = updateData;
  
  const result = await callApi('sl_lv0014', 'capNhatCtHd', { maCt, soLuong, maHd });
  
  return result;
}

// Load tr?ng th�i b�n theo h�a don - Get table status based on invoices
export async function loadTrangThaiBanTheoHoaDon(data = {}) {
  return await callApi('sl_lv0013', 'loadTrangThaiBanTheoHoaDon', data);
}

// Load danh m?c s?n ph?m - Get product categories (following mobile pattern)
export async function loadDanhMucSp(data = {}) {
  return await callApi('sl_lv0006', 'loadDanhMucSp', data);
}

// Load s?n ph?m theo m� danh m?c - Get products by category ID
export async function loadSanPhamTheoMaDanhMucSp(maDm) {
  return await callApi('sl_lv0007', 'loadSanPhamTheoDmSp', { maDm });
}

// Th�m b�n m?i - Add new table
export async function themBan(banData) {
  const { lv002, lv004 } = banData; // tenBan, maKhuVuc
  console.log('themBan API called with:', { lv002, lv004 });
  const result = await callApi('sl_lv0009', 'themBan', { lv002, lv004 });
  console.log('themBan API result:', result);
  return result;
}

// X�a b�n - Delete table
export async function xoaBan(maBan) {
  console.log('xoaBan API called with maBan:', maBan);
  const result = await callApi('sl_lv0009', 'xoaBan', { maBan });
  console.log('xoaBan API result:', result);
  return result;
}

// S?a b�n - Edit table
export async function suaBan(banData) {
  const { maBan, tenBan, maKhuVuc } = banData;
  console.log('suaBan API called with:', { maBan, tenBan, maKhuVuc });
  const result = await callApi('sl_lv0009', 'suaBan', { maBan, tenBan, maKhuVuc });
  console.log('suaBan API result:', result);
  return result;
}

// H?y h�a don - Cancel invoice
export async function huyHoaDon(maHd) {
  return await callApi('sl_lv0013', 'huyHoaDon', { maHd });
}

// Load chi ti?t h�a don V3 (enhanced version) - Get enhanced invoice details
export async function loadDsCthdV3(maHd) {
  return await callApi('sl_lv0014', 'loadCtHdV3', { maHd });
}

// C?p nh?t tr?ng th�i don h�ng - Update order status
export async function capNhatTrangThaiDonHang(maHd, trangThai) {
  return await callApi('sl_lv0013', 'capNhatTrangThai', { maHd, trangThai });
}

// L?y l?ch s? h�a don theo b�n - Get invoice history for table
export async function layLichSuHoaDonTheoBan(maBan, fromDate, toDate) {
  return await callApi('sl_lv0013', 'layLichSuHoaDon', { 
    maBan, 
    fromDate, 
    toDate 
  });
}

// T?o h�a don t?m (draft) - Create draft invoice
export async function taoHoaDonTam(maBan) {
  return await callApi('sl_lv0013', 'taoHoaDonTam', { maBan });
}

// Chuy?n h�a don t?m th�nh ch�nh th?c - Convert draft to official invoice
export async function chuyenHoaDonTamThanhChinhThuc(maHd) {
  return await callApi('sl_lv0013', 'chuyenHdTamThanhChinhThuc', { maHd });
}

// Sao ch�p h�a don - Copy invoice to another table
export async function saoChepHoaDon(maHdGoc, maBanMoi) {
  return await callApi('sl_lv0013', 'saoChepHoaDon', { maHdGoc, maBanMoi });
}

// T�nh to�n t?ng ti?n h�a don - Calculate invoice total
export async function tinhTongTienHoaDon(maHd) {
  return await callApi('sl_lv0013', 'tinhTongTien', { maHd });
}

// Load th�ng tin chi ti?t b�n (extended) - Get detailed table information
export async function loadThongTinChiTietBan(maBan) {
  return await callApi('sl_lv0009', 'loadThongTinChiTiet', { maBan });
}

// �?t b�n tru?c - Reserve table
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

// H?y d?t b�n - Cancel table reservation
export async function huyDatBan(maBan) {
  return await callApi('sl_lv0009', 'huyDatBan', { maBan });
}

// -------------------- Kitchen Order System APIs --------------------

// L?y danh s�ch m�n dang ch? l�m - Get pending orders
export async function layDsMonCho() {
  return await callApi('Mb_Oder', 'layDsMonDangChoOder');
}

// L?y danh s�ch m�n nu?c t? b�n dang b�n - Get drink orders from active tables
export async function layDsMonNuoc() {
  return await callApi('Mb_Oder', 'layMonNuocTuBanDangBan');
}

// L?y danh s�ch m�n an t? b�n dang b�n - Get food orders from active tables
export async function layDsMonAn() {
  return await callApi('Mb_Oder', 'layMonAnTuBanDangBan');
}

// C?p nh?t tr?ng th�i m�n - Update dish status (toggles between pending/completed)
export async function updateTrangThaiMon(itemId) {
  return await callApi('m_updateTrangThaiMon', 'updateTrangThaiMon', { itemId });
}

// L?y danh s�ch chi ti?t m�n theo tr?ng th�i - Get dish details by status
export async function layDsMonTheoTrangThai(trangThai) {
  return await callApi('Mb_Oder', 'layDsMonTheoTrangThai', { trangThai });
}

// L?y danh s�ch m�n d� xong - Get completed orders
export async function layDsMonDaXong() {
  return await callApi('Mb_Oder', 'layDsMonDaXong');
}

// -------------------- Enhanced Table Management APIs --------------------

// G?p b�n - Enhanced merge table function
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
    
    // Ki?m tra n?u response l� HTML error
    if (responseText.includes('<br />') || responseText.includes('<b>')) {
      throw new Error('Backend tr? v? l?i HTML: ' + responseText.substring(0, 200));
    }
    
    try {
      const result = JSON.parse(responseText);
      console.log('gopBanEnhanced result:', result);
      return result;
    } catch (parseError) {
      console.error('JSON parse error:', parseError);
      throw new Error('Response kh�ng ph?i JSON h?p l?: ' + responseText.substring(0, 100));
    }
  } catch (error) {
    console.error('Error in gopBanEnhanced:', error);
    throw error;
  }
}

// Chuy?n b�n - Enhanced transfer table function  
export async function chuyenBanEnhanced(maHoaDonBanCanChuyen, maBanChuyen) {
  try {
    
    // S? d?ng callApi thay v� fetch tr?c ti?p d? tr�nh l?i backend
    const result = await callApi('sl_lv0013', 'chuyenBan', {
      maHoaDonBanCanChuyen: maHoaDonBanCanChuyen,
      maHoaDonBanChuyen: '', // �? tr?ng khi chuy?n sang b�n tr?ng
      maBanChuyen: maBanChuyen
    });
    return result;
  } catch (error) {
    console.error('Error in chuyenBanEnhanced:', error);
    throw error;
  }
}

// T�ch b�n - Enhanced split table function
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
    
    // Ki?m tra n?u response l� HTML error
    if (responseText.includes('<br />') || responseText.includes('<b>')) {
      throw new Error('Backend tr? v? l?i HTML: ' + responseText.substring(0, 200));
    }
    
    try {
      const result = JSON.parse(responseText);
      console.log('tachBanEnhanced result:', result);
      return result;
    } catch (parseError) {
      console.error('JSON parse error:', parseError);
      throw new Error('Response kh�ng ph?i JSON h?p l?: ' + responseText.substring(0, 100));
    }
  } catch (error) {
    console.error('Error in tachBanEnhanced:', error);
    throw error;
  }
}

// ==================== B�O C�O B�N H�NG CHI TI?T ====================

/**
 * L?y b�o c�o b�n h�ng chi ti?t theo kho?ng th?i gian
 * @param {string} ngayBatDau - Ng�y b?t d?u (format: YYYY-MM-DD)
 * @param {string} ngayKetThuc - Ng�y k?t th�c (format: YYYY-MM-DD)
 * @param {string} plang - Ng�n ng? b�o c�o (m?c d?nh: 'vi')
 * @param {array} vArrLang - M?ng ng�n ng? (t�y ch?n)
 * @param {number} vOpt - T�y ch?n b�o c�o (m?c d?nh: 0)
 * @returns {Promise<Object>} Object ch?a HTML b�o c�o v� th�ng tin k? b�o c�o
 */
export async function layBaoCaoBanHangChiTiet(ngayBatDau, ngayKetThuc, plang = 'vi', vArrLang = [], vOpt = 0) {
  return await callApi('BaoCaoBanHang', 'layBaoCaoBanHangChiTiet', {
    ngayBatDau,
    ngayKetThuc,
    plang,
    vArrLang,
    vOpt
  });
}

/**
 * Xu?t b�o c�o b�n h�ng chi ti?t (alias function v?i t�n r� r�ng hon)
 * @param {Object} params - Object ch?a c�c tham s?
 * @param {string} params.startDate - Ng�y b?t d?u (YYYY-MM-DD)
 * @param {string} params.endDate - Ng�y k?t th�c (YYYY-MM-DD)
 * @param {string} params.language - Ng�n ng? (m?c d?nh: 'vi')
 * @returns {Promise<Object>} K?t qu? b�o c�o
 */
export async function xuatBaoCaoBanHang({ startDate, endDate, language = 'vi' }) {
  return await layBaoCaoBanHangChiTiet(startDate, endDate, language);
}

/**
 * L?y b�o c�o b�n h�ng theo th�ng
 * @param {number} month - Th�ng (1-12)
 * @param {number} year - Nam
 * @returns {Promise<Object>} K?t qu? b�o c�o
 */
export async function layBaoCaoBanHangTheoThang(month, year) {
  // T�nh ng�y d?u v� cu?i th�ng
  const startDate = `${year}-${String(month).padStart(2, '0')}-01`;
  const lastDay = new Date(year, month, 0).getDate();
  const endDate = `${year}-${String(month).padStart(2, '0')}-${String(lastDay).padStart(2, '0')}`;
  
  return await layBaoCaoBanHangChiTiet(startDate, endDate);
}

/**
 * L?y b�o c�o b�n h�ng h�m nay
 * @returns {Promise<Object>} K?t qu? b�o c�o
 */
export async function layBaoCaoBanHangHomNay() {
  const today = new Date().toISOString().split('T')[0];
  return await layBaoCaoBanHangChiTiet(today, today);
}

/**
 * L?y b�o c�o b�n h�ng tu?n n�y
 * @returns {Promise<Object>} K?t qu? b�o c�o
 */
export async function layBaoCaoBanHangTuanNay() {
  const today = new Date();
  const firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 1));
  const lastDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 7));
  
  const startDate = firstDayOfWeek.toISOString().split('T')[0];
  const endDate = lastDayOfWeek.toISOString().split('T')[0];
  
  return await layBaoCaoBanHangChiTiet(startDate, endDate);
}

// ==================== CHART API ====================

/**
 * T?o bi?u d? doanh thu t? d? li?u
 * @param {Array} chartData - M?ng d? li?u [{date: "YYYY-MM-DD HH:mm:ss", totalRevenue: number}]
 * @returns {Promise<Object>} K?t qu? ch?a SVG chart HTML
 */
export async function taoChartDoanhThu(chartData) {
  try {
    const response = await axios.post(url_chart_api, chartData, {
      headers: {
        'Content-Type': 'application/json'
      }
    });
    
    if (response.data) {
      return {
        success: true,
        chartHtml: response.data,
        message: 'T?o bi?u d? th�nh c�ng'
      };
    } else {
      return {
        success: false,
        chartHtml: null,
        message: 'Kh�ng nh?n du?c d? li?u bi?u d?'
      };
    }
  } catch (error) {
    console.error('Error creating chart:', error);
    return {
      success: false,
      chartHtml: null,
      message: error.message || 'C� l?i x?y ra khi t?o bi?u d?'
    };
  }
}


// -------------------- USER MANAGEMENT & PERMISSIONS --------------------

/**
 * L?y danh s�ch t?t c? ngu?i d�ng
 */
export async function getAllUsers() {
  return await callApi('Mb_Users', 'getAll');
}

/**
 * L?y th�ng tin ngu?i d�ng theo ID
 */
export async function getUserById(userId) {
  return await callApi('Mb_Users', 'getById', { userId });
}

/**
 * Th�m ngu?i d�ng m?i
 */
export async function addUser(userData) {
  return await callApi('Mb_Users', 'add', userData);
}

/**
 * C?p nh?t th�ng tin ngu?i d�ng
 */
export async function updateUser(userData) {
  return await callApi('Mb_Users', 'edit', userData);
}

/**
 * X�a ngu?i d�ng
 */
export async function deleteUser(userId) {
  return await callApi('Mb_Users', 'delete', { userId });
}

/**
 * Kh�a/M? kh�a ngu?i d�ng
 */
export async function toggleUserStatus(userId, status) {
  return await callApi('Mb_Users', 'toggleStatus', { userId, status });
}

/**
 * �?i m?t kh?u ngu?i d�ng
 */
export async function changeUserPassword(userId, newPassword) {
  return await callApi('Mb_Users', 'changePassword', { userId, newPassword });
}

/**
 * L?y danh s�ch quy?n c?a ngu?i d�ng
 */
export async function getUserRights(userId) {
  return await callApi('Mb_UserRights', 'getUserRights', { userId });
}

/**
 * L?y chi ti?t quy?n
 */
export async function getRightDetails(rightId) {
  return await callApi('Mb_UserRights', 'getRightDetails', { rightId });
}

/**
 * Th�m quy?n cho ngu?i d�ng
 */
export async function addUserRight(userId, rightId) {
  return await callApi('Mb_UserRights', 'addRight', { userId, rightId });
}

/**
 * C?p nh?t quy?n c?a ngu?i d�ng
 */
export async function updateUserRight(id, enabled) {
  return await callApi('Mb_UserRights', 'updateRight', { id, enabled });
}

/**
 * X�a quy?n c?a ngu?i d�ng
 */
export async function deleteUserRight(id) {
  return await callApi('Mb_UserRights', 'deleteRight', { id });
}

/**
 * C?p nh?t quy?n chi ti?t
 */
export async function updateDetailRight(id, enabled) {
  return await callApi('Mb_UserRights', 'updateDetailRight', { id, enabled });
}

/**
 * L?y danh s�ch t?t c? c�c lo?i quy?n
 */
export async function getAllPermissions() {
  return await callApi('Mb_Permissions', 'getAll');
}

/**
 * L?y danh s�ch nh�m ngu?i d�ng cho dropdown
 */
export async function getUserGroups() {
  return await callApi('Mb_UserFormData', 'getUserGroups');
}

/**
 * L?y danh s�ch nh�n vi�n cho dropdown
 */
export async function getEmployees() {
  return await callApi('Mb_UserFormData', 'getEmployees');
}

/**
 * L?y danh s�ch chi nh�nh cho dropdown
 */
export async function getBranches() {
  return await callApi('Mb_UserFormData', 'getBranches');
}

/**
 * L?y danh s�ch themes cho dropdown
 */
export async function getThemes() {
  return await callApi('Mb_UserFormData', 'getThemes');
}

/**
 * L?y danh s�ch quy?n c� th? g�n cho ngu?i d�ng
 */
export async function getAvailableRights() {
  return await callApi('Mb_UserFormData', 'getAvailableRights');
}

// -------------------- Sales Program Management --------------------

export async function listSalesPrograms(params = {}) {
  return await callApi('Mb_SalesPrograms', 'list', params);
}

export async function getSalesProgram(programId) {
  return await callApi('Mb_SalesPrograms', 'get', { programId });
}

export async function createSalesProgram(programData) {
  return await callApi('Mb_SalesPrograms', 'create', programData);
}

export async function updateSalesProgram(programData) {
  return await callApi('Mb_SalesPrograms', 'update', programData);
}

export async function deleteSalesProgram(programId) {
  return await callApi('Mb_SalesPrograms', 'delete', { programId });
}

export async function toggleSalesProgramStatus(programId, active) {
  return await callApi('Mb_SalesPrograms', 'toggleStatus', {
    programId,
    active: active ? 1 : 0
  });
}

// -------------------- Loyalty / Customer Points --------------------

export async function listLoyaltyCustomers(params = {}) {
  return await callApi('Mb_Loyalty', 'listCustomers', params);
}

export async function searchLoyaltyCustomers(keyword, limit = 20) {
  return await callApi('Mb_Loyalty', 'searchCustomers', { keyword, limit });
}

export async function registerLoyaltyCustomer(customerData) {
  return await callApi('Mb_Loyalty', 'registerCustomer', customerData);
}

export async function getLoyaltySummary(customerId) {
  return await callApi('Mb_Loyalty', 'getCustomerSummary', { customerId });
}

export async function addLoyaltyPoints(payload) {
  return await callApi('Mb_Loyalty', 'addPoints', payload);
}

export async function redeemLoyaltyPoints(payload) {
  return await callApi('Mb_Loyalty', 'redeemPoints', payload);
}

export async function getLoyaltyHistory(customerId, params = {}) {
  return await callApi('Mb_Loyalty', 'history', { customerId, ...params });
}