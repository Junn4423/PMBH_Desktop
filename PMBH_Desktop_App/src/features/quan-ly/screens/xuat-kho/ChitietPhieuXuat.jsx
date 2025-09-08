/* eslint-disable react-native/no-inline-styles */
/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable @typescript-eslint/no-unused-vars */
import {
  View,
  Text,
  ScrollView,
  StyleSheet,
  TouchableOpacity,
} from 'react-native';
import {Appbar} from 'react-native-paper';
import theme from '../../../../theme';
import {useEffect, useState} from 'react';
import {chiTietPhieuXuat, xuatKho} from '../../types';
import {layCtPhieuXuat, layPhieuXuatById} from '../../api/index';
import {useAuthStore} from '../../../auth/store/login.store';
import {HienThiPhieuXuat} from '../../components/xuat-kho';
import HienThiChiTietPhieuXuat from '../../components/xuat-kho/HienThiChiTietPhieuXuat';
import {
  NavigationProp,
  RouteProp,
  useFocusEffect,
  useNavigation,
  useRoute,
} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';
type ct = RouteProp<RootStackParamList, 'ChiTietPhieuXuat'>;
export default function ChiTietPhieuXuat() {
  const route = useRoute<ct>();
  const [loading, setLoading] = useState<boolean>(false);
  const [phieuXuat, setPhieuXuat] = useState<xuatKho>();
  const [ctPhieuXuat, setChiTietPhieuXuat] = useState<chiTietPhieuXuat[]>();
  const {user} = useAuthStore();

  useEffect(() => {
    const fetch = async () => {
      setLoading(true);
      try {
        if (user) {
          const res = await layPhieuXuatById(route.params.maPhieuXuat);
          const resCt = await layCtPhieuXuat(route.params.maPhieuXuat);
          setPhieuXuat(res);
          setChiTietPhieuXuat(resCt);
        }
      } catch (error) {
      } finally {
        setLoading(false);
      }
    };
    fetch();
  }, []);
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  return (
    <View>
      <Appbar.Header style={styles.wrap}>
        <Appbar.BackAction
          color={theme.colors.textHeader}
          onPress={() => {
            nav.goBack();
          }}
        />
        <Appbar.Content
          titleStyle={{color: theme.colors.textHeader, fontWeight: '700'}}
          title="Chi tiết phiếu xuất"
        />
      </Appbar.Header>
      <ScrollView>
        {phieuXuat ? (
          <>
            <View style={styles.boderChiTiet}>
              <Text style={styles.headerChiTiet}>
                Thông tin phiếu xuất #{phieuXuat.maPhieuXuat}
              </Text>

              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã xuất kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.maPhieuXuat}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.maKho}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Tên kho:</Text>
                <Text style={styles.valueChiTiet}>
                  {/* {getTenKho(phieuXuat.maKho)} */}
                  alo alo
                </Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã nhân viên:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.maNguoiDung}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Chủ đề xuất kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.chuDe}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Nguồn xuất kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.nguonXuat}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Mã tham chiếu:</Text>
                <Text
                  style={styles.valueChiTiet}
                  numberOfLines={1}
                  ellipsizeMode="tail">
                  {phieuXuat.maThamChieu}
                </Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Ghi chú:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.ghiChu}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Ngày xuất kho:</Text>
                <Text style={styles.valueChiTiet}>{phieuXuat.ngayXuat}</Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Hình thức xuất kho:</Text>
                <Text style={styles.valueChiTiet}>
                  {phieuXuat.hinhThucXuat}
                </Text>
              </View>
              <View style={styles.rowChiTiet}>
                <Text style={styles.titleChiTiet}>Người nhận kho:</Text>
                <Text style={styles.valueChiTiet}>
                  {phieuXuat.nguoiNhanKho}
                </Text>
              </View>
            </View>

            <View style={styles.boderChiTiet}>
              <Text style={styles.headerChiTiet}>
                Chi tiết sản phẩm xuất kho
              </Text>
              {ctPhieuXuat && ctPhieuXuat.length > 0 ? (
                ctPhieuXuat.map((item, index) => (
                  <HienThiChiTietPhieuXuat key={index} item={item} />
                ))
              ) : (
                <View style={styles.noData}>
                  <Text style={styles.textNoData}>
                    Không có sản phẩm nào trong phiếu xuất này
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
    color: '#2196F3',
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
    borderLeftColor: '#2196F3',
  },
  headerChiTiet: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 16,
    textAlign: 'center',
    color: '#2196F3',
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
    color: '#2196F3',
  },
  containerbtn: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    margin: 16,
    marginTop: 8,
  },
  btnAction: {
    backgroundColor: '#2196F3',
    borderRadius: 4,
    padding: 10,
    flex: 1,
    alignItems: 'center',
    marginHorizontal: 5,
  },
  btnEdit: {
    backgroundColor: '#2196F3',
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
  statusLocked: {
    color: '#F44336',
  },
  statusUnlocked: {
    color: '#4CAF50',
  },
});
