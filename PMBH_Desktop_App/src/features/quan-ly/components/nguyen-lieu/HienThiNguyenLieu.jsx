/* eslint-disable @typescript-eslint/no-unused-vars */
import {StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import theme from '../../../../theme';

interface Material {
  idSp: string;
  tenSp: string;
  dvt: string;
  dvtGia: string;
  giaBan: number;
  maKho: string;
}

interface Props {
  item: Material;
  index: number;
  xoaNguyenLieu: (id: string) => void;
}

function HienThiNguyenLieu({item, index, xoaNguyenLieu}: Props) {
  return (
    <View style={styles.itemContainer}>
      <View style={styles.headerItem}>
        <Text style={styles.maNguyenLieu}>
          {item.idSp} ({item.dvt})
        </Text>
        <Text style={styles.tenNguyenLieu}>{item.tenSp}</Text>
        <Text style={styles.giaNguyenLieu}>
          Giá: {item.giaBan} {item.dvtGia}
        </Text>
        <Text style={styles.khoNguyenLieu}>Kho: {item.maKho}</Text>
      </View>
      <TouchableOpacity
        style={styles.btnDelete}
        onPress={() => xoaNguyenLieu(item.idSp)}>
        <Text style={styles.textBtnAction}>Xóa</Text>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  itemContainer: {
    backgroundColor: '#ffffff',
    padding: 12,
    marginVertical: 6,
    marginHorizontal: 8,
    borderRadius: 8,
    elevation: 2,
    borderLeftWidth: 4,
    borderLeftColor: '#4CAF50',
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  headerItem: {
    flex: 1,
  },
  maNguyenLieu: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#424242',
  },
  tenNguyenLieu: {
    fontSize: 14,
    color: '#424242',
    marginTop: 4,
  },
  giaNguyenLieu: {
    fontSize: 12,
    color: '#757575',
    marginTop: 4,
  },
  khoNguyenLieu: {
    fontSize: 12,
    color: '#757575',
    marginTop: 4,
  },
  btnDelete: {
    backgroundColor: '#F44336',
    paddingVertical: 4,
    paddingHorizontal: 12,
    borderRadius: 4,
  },
  textBtnAction: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
});

export default HienThiNguyenLieu;
