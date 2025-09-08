import React, {useEffect, useState} from 'react';
import {Text} from 'react-native';
import {fetchAllNguyenLieuKho} from '../../api';

// Hàm fetchDanhSachSanPham sẽ nhận dữ liệu và trả về map, không dùng useState ở ngoài component
const fetchDanhSachSanPham = async (): Promise<Record<string, string>> => {
  // Thay URL dưới đây bằng API thực tế của bạn
  const res = await fetchAllNguyenLieuKho();
  const danhSachNVL = res.flat();
  const map: Record<string, string> = {};
  danhSachNVL.forEach((sp: {maSp: string; tenSp: string}) => {
    map[sp.maSp] = sp.tenSp;
  });
  return map;
};

type LayTenSanPhamProps = {
  maSanPham: string;
  style?: any;
  fallbackText?: string;
};

/**
 * Chỉ cần truyền mã sản phẩm, component sẽ tự fetch và map tên sản phẩm.
 */
const LayTenSanPham = ({
  maSanPham,
  style,
  fallbackText,
}: LayTenSanPhamProps) => {
  const [tenSanPhamMap, setTenSanPhamMap] = useState<Record<string, string>>(
    {},
  );
  const [loading, setLoading] = useState<boolean>(false);

  useEffect(() => {
    let isMounted = true;
    const fetchData = async () => {
      setLoading(true);
      try {
        const map = await fetchDanhSachSanPham();
        if (isMounted) {
          setTenSanPhamMap(map);
        }
      } catch (e) {
        // handle error nếu muốn
      }
      setLoading(false);
    };
    fetchData();
    return () => {
      isMounted = false;
    };
  }, []);

  if (loading && !tenSanPhamMap[maSanPham]) {
    return <Text style={style}>{fallbackText || 'Đang tải...'}</Text>;
  }

  const tenSp =
    tenSanPhamMap[maSanPham] || fallbackText || `Sản phẩm ${maSanPham}`;
  return <Text style={style}>{tenSp}</Text>;
};

export default LayTenSanPham;
