import {StyleSheet, Text, View} from 'react-native';
import {chiTietPhieuNhap} from '../../types';
import theme from '../../../../theme';
import LayTenSanPham from '../nguyen-lieu/LayTenSanPham';

const HienThiChiTietPhieuNhap = ({item}: {item: chiTietPhieuNhap}) => {
  return (
    <View style={styles.sanPhamItem} key={item.maChiTiet}>
      <View style={styles.sanPhamHeader}>
        <Text style={styles.sanPhamTen}>
          <LayTenSanPham
            maSanPham={item.maSanPham ?? ''}
            style={styles.sanPhamTen}
            fallbackText="Đang tải..."
          />
        </Text>
        <Text style={styles.sanPhamMa}>Mã: {item.maSanPham}</Text>
      </View>
      <View style={styles.sanPhamInfo}>
        <View style={styles.sanPhamInfoRow}>
          <Text>Mã tự động: {item.maChiTiet}</Text>
        </View>
        <View style={styles.sanPhamInfoRow}>
          <Text>Số lượng: {parseInt(item.soLuong?.toString() || '0')}</Text>
          <Text>ĐVT: {item.donViTinh}</Text>
        </View>
        <View style={styles.sanPhamInfoRow}>
          <Text>
            Đơn giá: {item.gia ? item.gia.toLocaleString('vi-VN') : 'N/A'} vnđ
          </Text>
          <Text>ĐVG: {item.donViGia}</Text>
        </View>
        <View style={styles.sanPhamInfoRow}>
          <Text style={styles.sanPhamThanhTien}>
            Thành tiền:{' '}
            {item.gia && item.soLuong
              ? (item.gia * parseInt(item.soLuong.toString())).toLocaleString(
                  'vi-VN',
                )
              : 'N/A'}{' '}
            vnđ
          </Text>
        </View>
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  wrap: {
    backgroundColor: theme.colors.primary,
  },
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  textBtnCreate: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
  btnCreate: {
    backgroundColor: '#4CAF50',
    paddingVertical: 8,
    paddingHorizontal: 12,
    borderRadius: 4,
    marginRight: 10,
  },

  header: {
    marginTop: 20,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 16,
    backgroundColor: '#ffffff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
    elevation: 2,
  },
  textHeader: {
    fontSize: 18,
    fontWeight: 'bold',
  },
  btnBack: {
    color: '#4CAF50',
    fontSize: 16,
    fontWeight: 'bold',
  },
  containerChiTiet: {
    flex: 1,
  },
  boderChiTiet: {
    backgroundColor: '#ffffff',
    borderRadius: 8,
    padding: 16,
    margin: 16,
    marginBottom: 8,
    elevation: 2,
    borderLeftWidth: 4,
    borderLeftColor: '#4CAF50',
  },
  headerChiTiet: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 16,
    textAlign: 'center',
    color: '#4CAF50',
  },
  rowChiTiet: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingVertical: 8,
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  titleChiTiet: {
    fontWeight: 'bold',
    fontSize: 14,
    color: '#424242',
    flex: 1,
  },
  valueChiTiet: {
    color: '#424242',
    fontSize: 14,
    flex: 1,
    textAlign: 'right',
  },
  tongTien: {
    fontWeight: 'bold',
    color: '#4CAF50',
  },
  containerbtn: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    margin: 16,
    marginTop: 8,
  },
  btnAction: {
    backgroundColor: '#4CAF50',
    borderRadius: 4,
    padding: 10,
    flex: 1,
    alignItems: 'center',
    marginHorizontal: 5,
  },
  btnEdit: {
    backgroundColor: '#8BC34A',
  },
  textBtnAction: {
    color: 'white',
    fontWeight: 'bold',
  },
  noData: {
    padding: 20,
    alignItems: 'center',
  },
  textNoData: {
    fontSize: 16,
    color: '#757575',
    textAlign: 'center',
  },
  // Styles cho danh sách sản phẩm
  sanPhamItem: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 12,
    marginBottom: 12,
    backgroundColor: '#ffffff',
  },
  sanPhamHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
    paddingBottom: 8,
  },
  sanPhamTen: {
    fontWeight: 'bold',
    fontSize: 16,
  },
  sanPhamMa: {
    color: '#757575',
    fontSize: 14,
  },
  sanPhamInfo: {
    marginTop: 4,
  },
  sanPhamInfoRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 4,
  },
  sanPhamThanhTien: {
    fontWeight: 'bold',
    color: 'red',
  },
});

export default HienThiChiTietPhieuNhap;
