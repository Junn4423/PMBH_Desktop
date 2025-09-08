export type kho = {
  maKho: string;
  tenCongTy: string;
  tenKho: string;
  viTriKho?: string;
  soDT?: string;
  fax?: string;
  maThuKho?: string;
  ghiChu?: string;
};

export type nguyenLieuKho = {
  maSp: string;
  tenSp: string;
  loaiSp: string;
  maDv: string;
  gia: number;
  dvGia: string;
  maKho: string;
};

export type phieuNhap = {
  maPhieuNhap?: string;
  maKho?: string;
  maNguoiDung?: string;
  loaiPhieu?: string;
  maThamChieu?: string;
  trangThai?: string;
  tongTien?: number;
  ngayNhap?: string;
  ghiChu?: string;
};

export type chiTietPhieuNhap = {
  maChiTiet?: string;
  maPhieuNhap?: string;
  maSanPham?: string;
  soLuong?: number;
  donViTinh?: string;
  gia?: number;
  donViGia?: string;
  ngayBan?: string;
  tenSp?: string;
  thanhTien?: number;
};

export type chiTietPhieuXuat = {
  maChiTiet?: string;
  maPhieuNhap?: string;
  maSanPham?: string;
  soLuong?: number;
  donViTinh?: string;
  gia?: number;
  donViGia?: string;
  ngayBan?: string;
  tenSp?: string;
  thanhTien?: number;
};

export type xuatKho = {
  maPhieuXuat: string;
  maKho: string;
  maNguoiDung: string;
  chuDe: string;
  nguonXuat: string;
  maThamChieu: string;
  trangThai: string;
  ghiChu: string;
  ngayXuat: string;
  hinhThucXuat: string;
  nguoiNhanKho: string;
};
export type tonKho = {
  maSP: string;
  soLuong: number;
};

export type loaiNguyenLieu = {
  id: string;
  tenLoai: string;
  maLoaiCha: string;
  trangThai: number;
};
export interface phieuKiemKho {
  maKiemKho: string;
  maKho: string;
  maNguoiDung?: string;
  chuDe?: string;
  ngayKiem: string;
  ghiNhan?: string;
  trangThai?: string;
}

export interface chiTietPhieuKiem {
  maKiemKho: string;
  maSanPham: string;
  slPM: number;
  soLuongThucTe: number;
  donViTinh: string;
  soLuongKiem: number;
  donViKiem: string;
}
