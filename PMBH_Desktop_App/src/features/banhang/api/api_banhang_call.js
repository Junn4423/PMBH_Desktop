import api from 'axios';
import 
import {
  ban,
  danhMucSp,
  gioHang,
  khuVuc,
  respon,
  sanPham,
  trangThaiBanTheoHoaDon,
} from '../types';

export const loadBan = async (data?: any): Promise<ban[]> => {
  const res = await Instance.post<ban[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'sl_lv0009',
      func: 'loadBan',
      ...data,
    },
    {},
  );
  return res.data;
};

export const loadKhuVuc = async (data?: any): Promise<khuVuc[]> => {
  const res = await Instance.post<khuVuc[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'sl_lv0008',
      func: 'loadKhuVuc',
      ...data,
    },
    {},
  );
  return res.data;
};

export const loadTrangThaiBanTheoHoaDon = async (
  data?: any,
): Promise<trangThaiBanTheoHoaDon[]> => {
  const res = await Instance.post<trangThaiBanTheoHoaDon[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'sl_lv0013',
      func: 'loadTrangThaiBanTheoHoaDon',
      ...data,
    },
    {},
  );
  return res.data;
};

export const gopBan = async ({
  maHoaDon,
  idBanGop,
}: {
  maHoaDon: string;
  idBanGop: string;
}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'gopBan',
    maHoaDon,
    idBanGop,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const tachBan = async ({
  maHoaDon,
}: {
  maHoaDon: string;
}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'tachBan',
    maHoaDon,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const loadDanhMucSp = async (data?: any): Promise<danhMucSp[]> => {
  const res = await Instance.post<danhMucSp[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'sl_lv0006',
      func: 'loadDanhMucSp',
      ...data,
    },
    {},
  );
  return res.data;
};

export const loadSanPhamTheoMaDanhMucSp = async ({
  maDm,
}: {
  maDm: string;
}): Promise<sanPham[]> => {
  const payload = {
    table: 'sl_lv0007',
    func: 'loadSanPhamTheoDmSp',
    maDm,
  };
  const res = await Instance.post<sanPham[]>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const taoHoaDon = async ({maBan}: {maBan: string}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'taoHoaDon',
    maBan,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const taoCthd = async ({
  maHd,
  maSp,
  soLuong,
}: {
  maHd: string;
  maSp: string;
  soLuong: number;
}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0014',
    func: 'taoCtHd',
    maHd,
    maSp,
    soLuong,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const loadDsCthd = async ({
  maHd,
}: {
  maHd: string;
}): Promise<gioHang[]> => {
  const payload = {
    table: 'sl_lv0014',
    func: 'loadCtHd',
    maHd,
  };
  const res = await Instance.post<gioHang[]>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const loadDsCthdV2 = async ({
  maHd,
}: {
  maHd: string;
}): Promise<gioHang[]> => {
  const payload = {
    table: 'sl_lv0014',
    func: 'loadCtHdV2',
    maHd,
  };
  const res = await Instance.post<gioHang[]>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const xoaCtHd = async ({maCt}: {maCt: string}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0014',
    func: 'xoaCthd',
    maCt,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const chuyenBan = async ({
  maHoaDonBanCanChuyen,
  maHoaDonBanChuyen,
  maBanChuyen,
}: {
  maHoaDonBanCanChuyen: string;
  maHoaDonBanChuyen: string;
  maBanChuyen: string;
}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'chuyenBan',
    maHoaDonBanCanChuyen,
    maHoaDonBanChuyen,
    maBanChuyen,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const themBan = async ({
  lv002,
  lv004,
}: {
  lv002: string;
  lv004: string;
}): Promise<any> => {
  const payload = {
    table: 'sl_lv0009',
    func: 'themBan',
    lv002,
    lv004,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const themKhuVuc = async ({
  lv001,
  lv002,
}: {
  lv001: string;
  lv002: string;
}): Promise<any> => {
  const payload = {
    table: 'sl_lv0008',
    func: 'themKhuVuc',
    lv001,
    lv002,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const capNhatHoaDon = async ({mahd}: {mahd: string}): Promise<any> => {
  const payload = {
    table: 'Mb_thanhtoan',
    func: 'thanhToan_contract',
    mahd: mahd,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const capNhatHoaDon2 = async ({
  maHd,
  trangThai,
}: {
  maHd: string;
  trangThai: string;
}): Promise<any> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'capNhatHoaDon2',
    maHd,
    trangThai,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const capNhatHoaDonTT4 = async ({
  maHd,
  trangThai,
}: {
  maHd: string;
  trangThai: string;
}): Promise<any> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'capNhatHoaDonTT4',
    maHd,
    trangThai,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const chuyenXuongBep = async ({maHd}: {maHd: string}): Promise<any> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'chuyenXuongBep',
    maHd,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const layDsMonCho = async (data?: any): Promise<any> => {
  const res = await Instance.post<danhMucSp[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'Mb_Oder',
      func: 'layDsMonDangChoOder',
      ...data,
    },
    {},
  );
  return res.data;
};
export const layDsMonNuoc = async (data?: any): Promise<any> => {
  const res = await Instance.post<danhMucSp[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'Mb_Oder',
      func: 'layMonNuocTuBanDangBan',
      ...data,
    },
    {},
  );
  return res.data;
};
export const layDsMonAn = async (data?: any): Promise<any> => {
  const res = await Instance.post<danhMucSp[]>(
    constants.API_URLS.SERVICES,
    {
      table: 'Mb_Oder',
      func: 'layMonAnTuBanDangBan',
      ...data,
    },
    {},
  );
  return res.data;
};

export const updateTrangThai = async ({
  itemId,
}: // status,
{
  itemId: string;
  // status: string;
}): Promise<any> => {
  const payload = {
    table: 'm_updateTrangThaiMon',
    func: 'updateTrangThaiMon',
    itemId,
    // status,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const chuyenMon = async ({
  dsChiTietMonAn,
  maBanChuyen,
}: {
  dsChiTietMonAn: string[];
  maBanChuyen: string;
}): Promise<respon> => {
  const payload = {
    table: 'sl_lv0013',
    func: 'chuyenMonAn',
    dsChiTietMonAn,
    maBanChuyen,
  };
  const res = await Instance.post<respon>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
export const layALLSanPham = async (): Promise<any> => {
  const payload = {
    table: 'Mb_sanPham',
    func: 'data',
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};
