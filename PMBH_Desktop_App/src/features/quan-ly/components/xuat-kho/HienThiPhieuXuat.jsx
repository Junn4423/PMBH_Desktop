import {StyleSheet, TouchableOpacity, View} from 'react-native';
import {Text} from 'react-native-paper';
import {xuatKho} from '../../types';
import {NavigationProp, useNavigation} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';

const HienThiPhieuXuat = ({
  item,
  index,
  xoaPhieu,
}: {
  item: xuatKho;
  index: number;
  xoaPhieu: () => void;
}) => {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  return (
    <TouchableOpacity
      style={styles.itemPhieu}
      onPress={() =>
        //@ts-ignore
        nav.navigate('ChiTietPhieuXuat', {maPhieuXuat: item.maPhieuXuat})
      }>
      <View style={styles.headerItem}>
        <View style={styles.indexContainer}>
          <Text style={styles.indexText}>{index + 1}</Text>
        </View>
        <View style={styles.codeContainer}>
          <Text style={styles.maPhieu}>#{item.maPhieuXuat}</Text>
          <Text style={styles.ngayXuat}>{item.ngayXuat}</Text>
        </View>
        <View style={styles.actionContainer}>
          <TouchableOpacity onPress={xoaPhieu} style={styles.btnDelete}>
            <Text style={styles.textBtnAction}>Xóa</Text>
          </TouchableOpacity>
        </View>
      </View>
      <View style={styles.infoGrid}>
        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Mã kho:</Text>
          <Text style={styles.infoValue}>{item.maKho}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Người dùng:</Text>
          <Text style={styles.infoValue}>{item.maNguoiDung || '-'}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Chủ đề:</Text>
          <Text style={styles.infoValue}>{item.chuDe || '-'}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Nguồn xuất:</Text>
          <Text style={styles.infoValue}>{item.nguonXuat || '-'}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Mã tham chiếu:</Text>
          <Text style={styles.infoValue} numberOfLines={1} ellipsizeMode="tail">
            {item.maThamChieu || '-'}
          </Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Trạng thái:</Text>
          <Text
            style={[
              styles.infoValue,
              item.trangThai === '1'
                ? styles.statusLocked
                : styles.statusUnlocked,
            ]}>
            {item.trangThai === '1' ? 'Khóa' : 'Mở'}
          </Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Hình thức xuất:</Text>
          <Text style={styles.infoValue}>{item.hinhThucXuat}</Text>
        </View>

        <View style={styles.infoRow}>
          <Text style={styles.infoLabel}>Người nhận:</Text>
          <Text style={styles.infoValue}>{item.nguoiNhanKho || '-'}</Text>
        </View>
      </View>
    </TouchableOpacity>
  );
};
const styles = StyleSheet.create({
  actionContainer: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    marginTop: 8,
  },
  btnDelete: {
    backgroundColor: '#F44336',
    paddingVertical: 4,
    paddingHorizontal: 12,
    borderRadius: 4,
  },
  btnAction: {
    paddingVertical: 4,
    paddingHorizontal: 12,
    borderRadius: 4,
    marginLeft: 8,
  },
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  tabContainer: {
    flexDirection: 'row',
    backgroundColor: '#fff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  tab: {
    flex: 1,
    paddingVertical: 12,
    alignItems: 'center',
  },
  tabActive: {
    flex: 1,
    paddingVertical: 12,
    alignItems: 'center',
    borderBottomWidth: 2,
    borderBottomColor: '#2196F3',
  },
  tabTextActive: {
    color: '#2196F3',
    fontWeight: '500',
  },
  tabTextInactive: {
    color: '#757575',
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 16,
    backgroundColor: '#ffffff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  textHeader: {
    fontSize: 18,
    fontWeight: 'bold',
  },
  btnCreate: {
    backgroundColor: '#2196F3',
    paddingVertical: 8,
    paddingHorizontal: 12,
    borderRadius: 4,
  },
  textBtnCreate: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
  searchContainer: {
    padding: 8,
    backgroundColor: '#ffffff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  searchInput: {
    height: 40,
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    paddingHorizontal: 12,
    backgroundColor: '#f9f9f9',
  },
  listContainer: {
    flex: 1,
  },
  listContentContainer: {
    padding: 8,
  },
  itemPhieu: {
    backgroundColor: '#ffffff',
    padding: 12,
    marginVertical: 6,
    marginHorizontal: 8,
    borderRadius: 8,
    elevation: 2,
    borderLeftWidth: 4,
    borderLeftColor: '#2196F3',
  },
  headerItem: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 10,
  },
  indexContainer: {
    backgroundColor: '#2196F3',
    width: 28,
    height: 28,
    borderRadius: 14,
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 8,
  },
  indexText: {
    color: '#ffffff',
    fontSize: 14,
    fontWeight: 'bold',
  },
  codeContainer: {
    flex: 1,
  },
  maPhieu: {
    fontWeight: 'bold',
    fontSize: 16,
  },
  ngayXuat: {
    color: '#757575',
    fontSize: 12,
  },
  infoGrid: {
    flexDirection: 'column',
  },
  infoRow: {
    flexDirection: 'row',
    marginBottom: 6,
    flexWrap: 'nowrap',
  },
  infoLabel: {
    fontSize: 14,
    color: '#757575',
    width: 100,
    marginRight: 4,
  },
  infoValue: {
    fontSize: 14,
    color: '#212121',
    fontWeight: '500',
    flex: 1,
  },
  statusLocked: {
    color: '#F44336',
  },
  statusUnlocked: {
    color: '#4CAF50',
  },
  noData: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  textNoData: {
    fontSize: 16,
    color: '#757575',
  },
  textBtnAction: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
});
export default HienThiPhieuXuat;
