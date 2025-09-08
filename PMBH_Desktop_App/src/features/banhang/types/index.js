export type ban = {
  maBan: string;
  tenBan: string;
  maKhuVuc: string;
};

export type khuVuc = {
  maKhuVuc: string;
  tenKhuVuc: string;
};

export type ctHoaDon = {
  maCt: string;
  soLuong: string;
  donGia: string;
  ngayOrder: string;
};

export type hoaDon = {
  maHoaDon: string;
  trangThai: string;
  gioVao: string;
  gopBan: string;
  maBan: string;
};
export type trangThaiBanTheoHoaDon = ctHoaDon & hoaDon;

export type danhMucSp = {
  maDanhMucSp: string;
  tenDanhMucSp: string;
};

export type sanPham = {
  maSp: string;
  tenSp: string;
  dvt: string;
  dvtGia: string;
  giaBan: number;
  hinhAnh: string;
};

export type respon = {
  success: string;
  message: string;
};

export type gioHang = ctHoaDon & sanPham & hoaDon;
