/* eslint-disable @typescript-eslint/no-unused-vars */
import constants from '../../../api/Api_URL';
import {Instance} from '../../../api/Instance';
import {loginResponse} from '../../auth/types';
import {
  chiTietPhieuNhap,
  chiTietPhieuXuat,
  kho,
  nguyenLieuKho,
  phieuNhap,
  xuatKho,
} from '../types';
export const laySoLuongTonKho = async <T>(
  maSP: string,
  maKho: string,
): Promise<T[]> => {
  const payload = {
    table: 'Mb_Kho',
    func: 'LaySoLuongTonKho',
    maSP: maSP,
    maKho: maKho,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const laySoLuongTonKhoNhieuSP = async <T>(
  maSP: string[],
  maKho: string,
): Promise<T[]> => {
  const payload = {
    table: 'Mb_Kho',
    func: 'LaySoLuongTonKhoNhieuSP',
    maSP,
    maKho,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const loadKho = async (data?: any): Promise<kho[]> => {
  const res = await Instance.post<kho[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'wh_lv0001',
      func: 'loadKho',
      ...data,
    },
    {},
  );
  return res.data;
};

export const themKho = async ({
  lv001,
  lv002,
  lv003,
  lv004,
  lv005,
  lv006,
  lv007,
  lv008,
}: {
  lv001: string;
  lv002: string;
  lv003: string;
  lv004: string;
  lv005: string;
  lv006: string;
  lv007: string;
  lv008: string;
}): Promise<any> => {
  const payload = {
    table: 'wh_lv0001',
    func: 'themKho',
    lv001,
    lv002,
    lv003,
    lv004,
    lv005,
    lv006,
    lv007,
    lv008,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const capNhatKho = async ({
  lv001,
  lv002,
  lv003,
  lv004,
  lv005,
  lv006,
  lv007,
  lv008,
}: {
  lv001: string;
  lv002: string;
  lv003: string;
  lv004: string;
  lv005: string;
  lv006: string;
  lv007: string;
  lv008: string;
}): Promise<any> => {
  const payload = {
    table: 'wh_lv0001',
    func: 'capNhapKho',
    lv001,
    lv002,
    lv003,
    lv004,
    lv005,
    lv006,
    lv007,
    lv008,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const xoaKho = async ({lv001}: {lv001: string}): Promise<any> => {
  const payload = {
    table: 'wh_lv0001',
    func: 'xoaKho',
    lv001,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const loadSanPhamTheoIdKho = async ({
  maKho,
}: {
  maKho: string;
}): Promise<nguyenLieuKho[]> => {
  const payload = {
    table: 'Mb_Kho',
    func: 'LayNvlTheoMaKho',
    maKho,
  };
  const res = await Instance.post<nguyenLieuKho[]>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const loadPhieuNhap = async (data?: any): Promise<phieuNhap[]> => {
  const res = await Instance.post<phieuNhap[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'wh_lv0008',
      func: 'loadPhieuNhap',
      ...data,
    },
    {},
  );
  return res.data;
};

export const xoaPhieuNhap = async ({
  maPhieu,
}: {
  maPhieu: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_PhieuNhap',
    func: 'delete',
    maPhieu,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const ThemPhieuNhapChiTietPn = async (
  lv002: string,
  lv003: string,
  lv004: string,
  lv005: string,
  lv006: string,
  lv008: number,
  details: chiTietPhieuNhap[],
): Promise<any> => {
  const payload = {
    table: 'Mb_PhieuNhap',
    func: 'add',
    lv002,
    lv003,
    lv004,
    lv005,
    lv006,
    lv008,
    details,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const fetchAllNguyenLieuKho = async (): Promise<nguyenLieuKho[]> => {
  const payload = {
    table: 'Mb_NguyenLieu',
    func: 'layAllNguyenLieu',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layPhieuNhapById = async (maPhieu: string): Promise<phieuNhap> => {
  const payload = {
    maPhieu: maPhieu,
    table: 'Mb_PhieuNhap',
    func: 'LoadPhieuNhap_ByID',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layCtPhieuNhap = async (
  maPhieu: string,
): Promise<chiTietPhieuNhap[]> => {
  const payload = {
    maPhieu: maPhieu,
    table: 'Mb_ChiTietPhieuNhap',
    func: 'data',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layXuatKho = async (): Promise<xuatKho[]> => {
  const payload = {
    table: 'Mb_PhieuXuat',
    func: 'data',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const layPhieuXuatById = async (maPhieu: string): Promise<xuatKho[]> => {
  const payload = {
    maPhieu: maPhieu,
    table: 'Mb_PhieuXuat',
    func: 'LoadPhieuXuat_ByID',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const themPhieuXuatChiTietPX = async <T>(
  user: loginResponse,
  lv002: string,
  lv003: string,
  lv004: string,
  lv005: string,
  lv006: string,
  lv007: string,
  lv008: string,
  lv010: string,
  lv011: string,
  details: chiTietPhieuXuat[],
): Promise<any> => {
  const payload = {
    table: 'Mb_PhieuXuat',
    func: 'add',
    lv002,
    lv003,
    lv004,
    lv005,
    lv006,
    lv007,
    lv008,
    lv010,
    lv011,
    details,
  };

  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const xoaPhieuXuat = async ({
  maPhieu,
}: {
  maPhieu: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_PhieuXuat',
    func: 'delete',
    maPhieu,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layCtPhieuXuat = async (
  maPhieu: string,
): Promise<chiTietPhieuXuat[]> => {
  const payload = {
    maPhieu: maPhieu,
    table: 'Mb_ChiTietPhieuXuat',
    func: 'data',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layAll_LoaiNVL = async <T>(): Promise<T[]> => {
  const payload = {
    table: 'Mb_NguyenLieu',
    func: 'get_DS_LoaiNVL',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layAllDanhMucSP = async <T>(): Promise<T[]> => {
  const payload = {
    table: 'Mb_LoaiNguyenLieu',
    func: 'data',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
// export const layDS_NVL = async <T>(): Promise<T[]> => {
//   const payload = {
//     table: 'Mb_NguyenLieu',
//     func: 'get_dsNVL',
//   };
//   const res = await Instance.post<any>(
//     constants.API_URLS.SERVICES,
//     payload,
//     {},
//   );
//   return res.data;
// };

export const themLoaiNguyenLieu = async ({
  maLoai,
  moTa,
  maLoaiCha,
  trangThai,
}: {
  maLoai: string;
  moTa: string;
  maLoaiCha: string;
  trangThai: number;
}): Promise<any> => {
  const payload = {
    table: 'Mb_LoaiNguyenLieu',
    func: 'add',
    maLoai,
    moTa,
    maLoaiCha,
    trangThai,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const themNguyenLieu = async ({
  maSanPham,
  tenSanPham,
  maLoai,
  maDonVi,
  donViTinhQuyDoi,
  giaTriQuyDoi,
  gia,
  donViGia,
  trangThai_HienThiSP,
  maKho,
}: {
  maSanPham: string;
  tenSanPham: string;
  maLoai: string;
  maDonVi: string;
  donViTinhQuyDoi: string;
  giaTriQuyDoi: number;
  gia: number;
  donViGia: string;
  trangThai_HienThiSP: number;
  maKho: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_NguyenLieu',
    func: 'add',
    maSanPham,
    tenSanPham,
    maLoai,
    donViTinh: maDonVi,
    donViQuyDoi: donViTinhQuyDoi,
    giaTriQuyDoi,
    gia,
    donViGia,
    trangThai_HienThiSP: 0,
    maKho,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const themSanPham = async ({
  maSanPham,
  tenSanPham,
  maLoai,
  maDonVi,
  donViTinhQuyDoi,
  giaTriQuyDoi,
  gia,
  donViGia,
  trangThai_HienThiSP,
  maKho,
}: {
  maSanPham: string;
  tenSanPham: string;
  maLoai: string;
  maDonVi: string;
  donViTinhQuyDoi: string;
  giaTriQuyDoi: number;
  gia: number;
  donViGia: string;
  trangThai_HienThiSP: number;
  maKho: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_NguyenLieu',
    func: 'add_SP',
    maSanPham,
    tenSanPham,
    maLoai,
    donViTinh: maDonVi,
    donViQuyDoi: donViTinhQuyDoi,
    giaTriQuyDoi,
    gia,
    donViGia,
    trangThai_HienThiSP: 1,
    maKho,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layDanhSachNVL_TheoLoai = async <T>(
  maLoai: string,
): Promise<T[]> => {
  const payload = {
    table: 'Mb_NguyenLieu',
    func: 'layNVLTheoMaLoai',
    idLoai: maLoai,
  };

  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const xoaNguyenLieu = async <T>(maNguyenLieu: string): Promise<T[]> => {
  const payload = {
    table: 'Mb_NguyenLieu',
    func: 'delete',
    maNguyenLieu: maNguyenLieu,
  };

  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const xoaLoaiNVL = async <T>(maLoai: string): Promise<T[]> => {
  const payload = {
    table: 'Mb_LoaiNguyenLieu',
    func: 'delete',
    idLoai: maLoai,
  };

  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

//Phiếu kiểm
/**
 * Lấy danh sách phiếu kiểm kho theo mã kho
 */
export const layDanhSachPhieuKiemKho = async (
  maKho: string,
): Promise<any[]> => {
  const payload = {
    table: 'Mb_KiemKho',
    func: 'layDanhSachPhieuKiemTheoKho',
    maKho: maKho,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

/**
 * Lấy chi tiết phiếu kiểm theo mã phiếu
 */
export const layChiTietPhieuKiem = async (maPK: string): Promise<any[]> => {
  const payload = {
    table: 'Mb_ChiTietPK',
    func: 'data',
    maPK,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

/**
 * Tạo mới phiếu kiểm kho
 */
export const taoPhieuKiemKho = async ({
  maKho,
  maNhanVien,
  chuDe,
  ghiNhan,
  trangThai,
}: {
  maKho: string;
  maNhanVien: string;
  chuDe: string;
  ghiNhan: string;
  trangThai: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_KiemKho',
    func: 'add',
    maKho,
    maNhanVien,
    chuDe,
    ghiNhan,
    trangThai,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

/**
 * Thêm chi tiết phiếu kiểm kho
 */
export const taoChiTietPhieuKiemKho = async ({
  maKiemKho,
  maSanPham,
  slPM,
  donViKiem,
  soLuongThucTe,
  donViTT,
}: {
  maKiemKho: string;
  maSanPham: string;
  slPM: number;
  donViKiem: string;
  soLuongThucTe: number;
  donViTT: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_ChiTietPK',
    func: 'add',
    maKiemKho,
    maSanPham,
    slPM,
    donViKiem,
    soLuongThucTe,
    donViTT,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

/**
 * Cập nhật chi tiết phiếu kiểm kho
 */
export const updateChiTietPhieuKiemKho = async ({
  maKiemKho,
  maSanPham,
  soLuongThucTe,
  donViTT,
}: {
  maKiemKho: string;
  maSanPham: string;
  soLuongThucTe: number;
  donViTT: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_ChiTietPK',
    func: 'edit',
    maKiemKho,
    maSanPham,
    soLuongThucTe,
    donViTT,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

/**
 * Xóa chi tiết phiếu kiểm kho
 */
export const xoaChiTietPhieuKiemKho = async ({
  maKiemKho,
  maSanPham,
}: {
  maKiemKho: string;
  maSanPham: string;
}): Promise<any> => {
  const payload = {
    table: 'Mb_ChiTietPK',
    func: 'delete',
    maKiemKho,
    maSanPham,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

/**
 * Chỉnh sửa trạng thái phiếu kiểm kho (hàng loạt)
 */
export const chinhSuaTrangThaiPK = async (dsMaPK: string[]): Promise<any> => {
  const payload = {
    table: 'Mb_KiemKho',
    func: 'chinhSuaTrangThai_PK',
    dsMaPK,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layThongTinPhieuKiemByID = async (maPK: string): Promise<any> => {
  const payload = {
    table: 'Mb_KiemKho',
    func: 'layThongTinPhieuKiemByID',
    maPK,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
