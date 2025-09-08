/* eslint-disable react-hooks/exhaustive-deps */
import {View, Text, StyleSheet} from 'react-native';
import React, {useState, useEffect, memo} from 'react';
import {nguyenLieuKho, tonKho} from '../../types';
import numeral from 'numeral';
import {laySoLuongTonKhoNhieuSP, loadSanPhamTheoIdKho} from '../../api';

type Props = {
  item: nguyenLieuKho;
};

const HienThiNguyenLieu: React.FC<Props> = ({item}) => {
  const [danhSachTonKho, setDanhSachTonKho] = useState<tonKho[]>([]);
  const [isFetching, setIsFetching] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  // Hàm tải dữ liệu tồn kho (sử dụng batch API)
  const fetchData = async () => {
    setIsFetching(true);
    setError(null);
    try {
      const rawData = await loadSanPhamTheoIdKho({maKho: item.maKho});
      console.log('rawData loadSanPhamTheoIdKho:', rawData);

      const maSPArr = rawData.map(sp => sp.maSp);
      console.log('maSPArr:', maSPArr);
      // Gọi API batch lấy tất cả tồn kho cùng lúc
      const danhSachTon: tonKho[] = await laySoLuongTonKhoNhieuSP(
        maSPArr,
        item.maKho,
      );
      console.log('danhSachTon:', danhSachTon);
      setDanhSachTonKho(Array.isArray(danhSachTon) ? danhSachTon : []);
    } catch (err) {
      console.error('Error fetching stock data:', err);
      setDanhSachTonKho([]);
      setError('Không thể tải dữ liệu tồn kho.');
    } finally {
      setIsFetching(false);
    }
  };

  // Gọi fetchData mỗi khi `item.maKho` thay đổi
  useEffect(() => {
    fetchData();
  }, [item.maKho]);

  // Tìm số lượng tồn kho cho sản phẩm hiện tại
  const soLuongTon = (Array.isArray(danhSachTonKho) ? danhSachTonKho : []).find(
    ton => ton.maSP === item.maSp,
  )?.soLuong;

  // Render trạng thái tải dữ liệu
  if (isFetching) {
    return (
      <View style={styles.loadingContainer}>
        <Text>Đang tải dữ liệu...</Text>
      </View>
    );
  }

  // Render lỗi nếu có
  if (error) {
    return (
      <View style={styles.errorContainer}>
        <Text style={styles.errorText}>{error}</Text>
      </View>
    );
  }
  // Sau khi lấy rawData

  // Render thông tin sản phẩm
  return (
    <View style={styles.itemSanPham}>
      <View style={styles.headerItem}>
        <Text style={styles.maSanPham}>
          {item.maSp || 'Chưa có mã sản phẩm'}
        </Text>
      </View>
      <Text style={styles.tenSanPham}>
        {item.tenSp || 'Tên sản phẩm chưa cập nhật'}
      </Text>
      <View style={styles.thongTinSanPham}>
        <Text style={styles.soLuongTon}>
          Số lượng tồn:{' '}
          {soLuongTon !== undefined ? soLuongTon : 'Chưa cập nhật'}
        </Text>
      </View>
      <View style={styles.thongTinSanPham}>
        <Text style={styles.donViTinh}>
          Đơn vị: {item.dvGia || 'Chưa cập nhật'}
        </Text>
        <Text style={styles.gia}>
          Giá:{' '}
          {item.gia !== undefined
            ? numeral(item.gia).format()
            : 'Chưa cập nhật'}{' '}
          {item.dvGia || ''}
        </Text>
      </View>
    </View>
  );
};

// Sử dụng React.memo để tránh render lại không cần thiết
export default memo(HienThiNguyenLieu);

const styles = StyleSheet.create({
  itemSanPham: {
    backgroundColor: '#ffffff',
    padding: 16,
    marginVertical: 8,
    borderRadius: 8,
    elevation: 2,
    borderLeftWidth: 4,
    borderLeftColor: '#FF9800',
  },
  headerItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  loadingContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  errorContainer: {
    padding: 16,
    backgroundColor: '#f8d7da',
    borderRadius: 8,
    marginVertical: 8,
  },
  errorText: {
    color: '#721c24',
    textAlign: 'center',
  },
  maSanPham: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#FF9800',
  },
  tenSanPham: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 8,
  },
  thongTinSanPham: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  donViTinh: {
    fontSize: 14,
    color: '#757575',
  },
  soLuongTon: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#FF9800',
  },
  gia: {
    fontSize: 14,
    fontWeight: 'bold',
    color: 'red',
  },
});
