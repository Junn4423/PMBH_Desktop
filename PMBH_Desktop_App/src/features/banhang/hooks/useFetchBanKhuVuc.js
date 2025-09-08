import {useEffect, useMemo, useCallback, useState} from 'react';
import usePostApi from '../../../hooks/usePostApi';

import {ban, khuVuc, trangThaiBanTheoHoaDon} from '../types';
import {loadBan, loadKhuVuc, loadTrangThaiBanTheoHoaDon} from '../api';
import {useToast} from '../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../constants';

const useFetchBanKhuVuc = () => {
  const [loading, setLoading] = useState<boolean>(false);
  const [dataBan, setDataBan] = useState<ban[]>();
  const [dataKhuVuc, setDataKhuVuc] = useState<khuVuc[]>();
  const [dataHd, setDataHd] = useState<trangThaiBanTheoHoaDon[]>();
  const {showToast} = useToast();

  const fetchAllData = useCallback(async () => {
    try {
      setLoading(true);
      // Gọi song song để tối ưu thời gian
      const [resBan, resKhuVuc, hoaDonCuaBan] = await Promise.all([
        loadBan(),
        loadKhuVuc(),
        loadTrangThaiBanTheoHoaDon(),
      ]);
      
      setDataBan(resBan);
      setDataKhuVuc(resKhuVuc);
      setDataHd(hoaDonCuaBan);
    } catch (error) {
      showToast(TEXT_TOAST.err, 'error');
    } finally {
      setLoading(false);
    }
  }, [showToast]);

  // Chỉ fetch khi component mount, không auto-refresh
  useEffect(() => {
    fetchAllData();
  }, [fetchAllData]);

  // Optional: Uncomment nếu muốn auto-refresh (30s thay vì 10s)
  // useEffect(() => {
  //   const interval = setInterval(() => {
  //     fetchAllData();
  //   }, 30000); // 30 giây tự động reload
  //   return () => clearInterval(interval);
  // }, [fetchAllData]);

  const formaData = useMemo(() => {
    if (dataBan && dataKhuVuc && dataHd) {
      return dataBan.map(item => {
        const khuVuc = dataKhuVuc.find(kv => kv.maKhuVuc == item.maKhuVuc);
        const hoaDonCuaBan = dataHd
          .filter(hd => hd.maBan === item.maBan)
          .map(({maBan, ...rest}) => rest);

        return {
          maBan: item.maBan,
          tenBan: item.tenBan,
          khuVuc: khuVuc?.tenKhuVuc || '',
          maKhuVuc: khuVuc?.maKhuVuc || '',
          hoaDon: hoaDonCuaBan,
          gopBan: hoaDonCuaBan[0]?.gopBan || '',
          maHoaDon: hoaDonCuaBan[0]?.maHoaDon,
        };
      });
    }
  }, [dataBan, dataKhuVuc, dataHd]);

  const dsBanKhongGop = useMemo(() => {
    if (formaData) {
      const cacMaBanBiGop = formaData.flatMap(b =>
        b.gopBan !== '' ? b.gopBan.split(',').map(ma => ma.trim()) : [],
      );
      return formaData.filter(
        b => b.gopBan === '' && !cacMaBanBiGop.includes(b.maBan),
      );
    }
  }, [formaData]);

  // const dsBanGop = useMemo(() => {
  //   if (formaData) {
  //     const cacMaBanBiGop = formaData
  //       .filter(ban => ban.gopBan !== '')
  //       .flatMap(ban => ban.gopBan.split(',').map(ma => ma.trim()));

  //     // Trả về danh sách các object bàn bị gộp
  //     const danhSachBan = formaData.filter(ban =>
  //       cacMaBanBiGop.includes(ban.maBan),
  //     );
  //     return danhSachBan;
  //   }
  //   return [];
  // }, [formaData]);

  const dsBanGop = useMemo(() => {
    if (formaData) {
      return formaData
        .filter(ban => ban.gopBan !== '')
        .map(ban => {
          const danhSachGop = ban.gopBan
            .split(',')
            .map(ma => ma.trim())
            .map(ma => formaData.find(b => b.maBan === ma))
            .filter(Boolean);
          console.log('danhSachGop', danhSachGop);
          return {
            ...ban,
            danhSachGop,
          };
        });
    }
  }, [formaData]);

  return {formaData, dsBanKhongGop, dsBanGop, loading, fetchAllData};
};

export default useFetchBanKhuVuc;
