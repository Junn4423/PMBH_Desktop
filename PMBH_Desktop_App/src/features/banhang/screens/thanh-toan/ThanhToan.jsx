import {
  NavigationProp,
  RouteProp,
  useFocusEffect,
  useNavigation,
  useRoute,
} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import numeral from 'numeral';
import {useCallback} from 'react';
import {Alert, ScrollView, StyleSheet, View} from 'react-native';
import {Button, Text} from 'react-native-paper';
import WrapHeader from '../../../../components/WrapHeader.component';
import {RootStackParamList} from '../../../../types/navigation';
import {capNhatHoaDon, chuyenXuongBep, loadDsCthdV2} from '../../api';
import {useToast} from '../../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../../constants';
type ThanhToan = RouteProp<RootStackParamList, 'ThanhToan'>;
function ThanhToan() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();

  const route = useRoute<ThanhToan>();
  const {idDonHang, tenBan} = route.params;

  const {mutate, data} = useMutation({
    mutationFn: loadDsCthdV2,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({maHd: idDonHang});
    }, []),
  );

  // Tính tổng tiền đúng (tổng thành tiền từng dòng)
  const tongTien = Array.isArray(data)
    ? data.reduce(
        (sum, item) =>
          sum + Number(item.giaBan || 0) * Number(item.soLuong || 0),
        0,
      )
    : 0;

  const {mutate: capNhatHoaDonApi} = useMutation({
    mutationFn: capNhatHoaDon,
    onSuccess: () => {
      // Chuyển sang màn hình report sau khi thanh toán thành công
      nav.navigate('ReportScreen', {maHoaDon: idDonHang});
    },
    onError: () => {
      Alert.alert('Lỗi', 'Có lỗi xảy ra trong quá trình thanh toán!');
    },
  });
  // Hàm chuyển số thành chữ (đơn giản, có thể thay bằng thư viện nếu cần)
  const handelThanhToan = (idDonHang: string) => {
    console.log(idDonHang);
    Alert.alert(
      'Xác nhận thanh toán',
      'Bạn có chắc muốn thanh toán đơn hàng này?',
      [
        {
          text: 'Hủy',
          style: 'cancel',
        },
        {
          text: 'Thanh toán',
          onPress: () => {
            // Xử lý thanh toán tại đây
            capNhatHoaDonApi({mahd: idDonHang});
            // nav.navigate('ThanhToan', {idDonHang: idDonHang});
          },
        },
      ],
    );
  };
  const {showToast} = useToast();
  const {mutate: chuyenXuongBepApi} = useMutation({
    mutationFn: chuyenXuongBep,
    onSuccess: () => {
      showToast('Chuyển xuống bếp thành công!', 'success');
      nav.navigate('BottomNav');
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });
  const handelChuyenXuongBep = () => {
    chuyenXuongBepApi({maHd: idDonHang});
  };
  const handelGoiMon = () => {
    console.log('vao 1');
    if (!Array.isArray(data) || data.length === 0) return;
    console.log('vao 2');

    console.log(123);
    console.log(tenBan);
    console.log(123);
    const firstItem = data[0];
    nav.navigate('GoiMon', {
      maHoaDon: firstItem?.maHoaDon,
      tenBan: tenBan || '',
      maBan: firstItem?.maBan,
    });
  };
  return (
    <View style={styles.container}>
      <WrapHeader title="Thanh Toán" handleBack={() => nav.goBack()} />
      <ScrollView style={{padding: 8}}>
        <View style={styles.tableContainer}>
          <View style={styles.rowHeader}>
            <Text style={[styles.cell, styles.cellTenHang, styles.headerText]}>
              Tên sản phẩm
            </Text>
            <Text style={[styles.cell, styles.cellSL, styles.headerText]}>
              SL
            </Text>
            <Text style={[styles.cell, styles.cellDonGia, styles.headerText]}>
              Đơn giá
            </Text>
            <Text
              style={[styles.cell, styles.cellThanhTien, styles.headerText]}>
              Thành tiền
            </Text>
          </View>
          {Array.isArray(data) &&
            data.map((item, idx) => (
              <View style={styles.row} key={idx}>
                <Text style={[styles.cell, styles.cellTenHang]}>
                  {item.tenSp}
                </Text>
                <Text style={[styles.cell, styles.cellSL]}>{item.soLuong}</Text>
                <Text style={[styles.cell, styles.cellDonGia]}>
                  {numeral(item.giaBan).format()}
                </Text>
                <Text style={[styles.cell, styles.cellThanhTien]}>
                  {numeral(
                    Number(item.giaBan || 0) * Number(item.soLuong || 0),
                  ).format()}
                </Text>
              </View>
            ))}
          {/* Tổng tiền */}
          <View style={styles.row}>
            <Text
              style={[styles.cell, styles.cellTenHang, {fontWeight: 'bold'}]}>
              TỔNG TIỀN:
            </Text>
            {/* <Text style={[styles.cell, styles.cellSL]}></Text>
            <Text style={[styles.cell, styles.cellDonGia]}></Text> */}
            <Text
              style={[styles.cell, styles.cellThanhTien, {fontWeight: 'bold'}]}>
              {tongTien.toLocaleString()}
            </Text>
          </View>
        </View>
      </ScrollView>
      <View style={styles.bottomActions}>
        <Button
          mode="contained"
          style={[
            {
              flex: 1,
              marginRight: 8,
              backgroundColor: '#f59e42',
              borderRadius: 8,
            },
          ]}
          labelStyle={{fontWeight: 'bold', fontSize: 16}}
          icon={() => <Text style={{fontSize: 18}}>🍳</Text>}
          onPress={() => handelChuyenXuongBep()}>
          Xuống bếp
        </Button>
        <Button
          mode="contained"
          style={[
            {
              flex: 1,
              backgroundColor: '#3c467aff',
              borderRadius: 8,
            },
          ]}
          labelStyle={{fontWeight: 'bold', fontSize: 16}}
          icon={() => <Text style={{fontSize: 18}}>🍸</Text>}
          onPress={() => handelGoiMon()}>
          Gọi món
        </Button>
        <Button
          mode="contained"
          style={[
            {
              flex: 1,
              marginLeft: 8,
              backgroundColor: '#22c55e',
              borderRadius: 8,
            },
          ]}
          labelStyle={{fontWeight: 'bold', fontSize: 16}}
          icon={() => <Text style={{fontSize: 18}}>💵</Text>}
          onPress={() => handelThanhToan(idDonHang)}>
          Thanh toán
        </Button>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  tableContainer: {
    borderWidth: 1,
    borderColor: '#bbb',
    borderRadius: 4,
    margin: 8,
    backgroundColor: '#fff',
    overflow: 'hidden',
  },
  rowHeader: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderColor: '#bbb',
    backgroundColor: '#f5f5f5',
  },
  row: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderColor: '#eee',
    minHeight: 32,
    alignItems: 'center',
  },
  cell: {
    borderRightWidth: 1,
    borderColor: '#bbb',
    paddingVertical: 4,
    paddingHorizontal: 6,
    fontSize: 14,
  },
  cellTenHang: {
    flex: 3,
  },
  cellSL: {
    flex: 1,
    textAlign: 'center',
  },
  cellDonGia: {
    flex: 2,
    textAlign: 'right',
  },
  cellThanhTien: {
    flex: 2,
    textAlign: 'right',
    borderRightWidth: 0,
  },
  headerText: {
    fontWeight: 'bold',
    textAlign: 'center',
  },
  bottomActions: {
    flexDirection: 'row',
    padding: 12,
    backgroundColor: '#fff',
    borderTopWidth: 1,
    borderColor: '#eee',
  },
});

export default ThanhToan;
