/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
import {ScrollView, StyleSheet, TouchableOpacity, View} from 'react-native';
import {Appbar, Text} from 'react-native-paper';
import theme from '../../../../theme';
import {useEffect, useState} from 'react';
import {chiTietPhieuNhap, phieuNhap} from '../../types';
import {RouteProp, useNavigation, useRoute} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';
import {layCtPhieuNhap, layPhieuNhapById} from '../../api/index';
import {useAuthStore} from '../../../auth/store/login.store';
import numeral from 'numeral';
import HienThiChiTietPhieuNhap from '../../components/nhap-kho/HienThiChiTietPhieuNhap';
type ct = RouteProp<RootStackParamList, 'ChiTietPhieuNhap'>;
export default function ChiTietPhieuNhap() {
  const route = useRoute<ct>();
  const [loading, setLoading] = useState<boolean>(false);
  const [phieuNhap, setPhieuNhap] = useState<phieuNhap>();
  const [ctPhieuNhap, setChiTietPhieuNhap] = useState<chiTietPhieuNhap[]>();
  const {user} = useAuthStore();
  useEffect(() => {
    const fetch = async () => {
      setLoading(true);
      try {
        if (user) {
          const res = await layPhieuNhapById(route.params.maPhieuNhap);
          const resCt = await layCtPhieuNhap(route.params.maPhieuNhap);
          setPhieuNhap(res);
          setChiTietPhieuNhap(resCt);
        }
      } catch (error) {
      } finally {
        setLoading(false);
      }
    };
    fetch();
  }, []);
  const nav = useNavigation();
  return (
    <View style={{flex: 1}}>
      <Appbar.Header style={styles.wrap}>
        <Appbar.BackAction
          color={theme.colors.textHeader}
          onPress={() => nav.goBack()}
        />
        <Appbar.Content
          titleStyle={{color: theme.colors.textHeader, fontWeight: '700'}}
          title="Chi tiết phiếu nhập"
        />
      </Appbar.Header>

      <ScrollView style={styles.containerChiTiet}>
        {phieuNhap ? (
          <>
            <View style={styles.boderChiTiet}>
              <Text style={styles.headerChiTiet}>
                Thông tin phiếu nhập #{phieuNhap.maPhieuNhap}
              </Text>

              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã nhập kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuNhap.maPhieuNhap}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuNhap.maKho}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã nhân viên:</Text>
                <Text style={styles.valueChiTiet}>{phieuNhap.maNguoiDung}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Loại phiếu:</Text>
                <Text style={styles.valueChiTiet}>{phieuNhap.loaiPhieu}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Ghi chú:</Text>
                <Text style={styles.valueChiTiet}>
                  {phieuNhap.ghiChu || 'Không có'}
                </Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Ngày nhập kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuNhap.ngayNhap}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Tổng tiền:</Text>
                <Text style={[styles.valueChiTiet, styles.tongTien]}>
                  {numeral(phieuNhap.tongTien).format()} vnđ
                </Text>
              </View>
            </View>

            <View style={styles.boderChiTiet}>
              <Text style={styles.headerChiTiet}>
                Chi tiết sản phẩm nhập kho
              </Text>

              {ctPhieuNhap && ctPhieuNhap.length > 0 ? (
                ctPhieuNhap.map((item, index) => (
                  <HienThiChiTietPhieuNhap key={index} item={item} />
                ))
              ) : (
                <View style={styles.noData}>
                  <Text style={styles.textNoData}>
                    Không có sản phẩm nào trong phiếu nhập này
                  </Text>
                </View>
              )}
            </View>

            <View style={styles.containerbtn}>
              <TouchableOpacity style={[styles.btnAction, styles.btnEdit]}>
                <Text style={styles.textBtnAction}>Chỉnh sửa</Text>
              </TouchableOpacity>
            </View>
          </>
        ) : (
          <View style={styles.noData}>
            <Text style={styles.textNoData}>
              Không tìm thấy thông tin phiếu
            </Text>
          </View>
        )}
      </ScrollView>
    </View>
  );
}

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
