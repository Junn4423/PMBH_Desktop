import {
  Dimensions,
  GestureResponderEvent,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';
import { getStatusColor, getStatusIcon } from '../../../../utils';
import MaterialCommunityIcons from 'react-native-vector-icons/MaterialCommunityIcons';
import numeral from 'numeral';
const {width} = Dimensions.get('window');
interface banProps {
  maBan: string;
  tenBan: string;
  khuVuc: string;
  maKhuVuc: string;
  hoaDon: {
    maCt: string;
    soLuong: string;
    donGia: string;
    ngayOrder: string;
    maHoaDon: string;
    trangThai: string;
    gioVao: string;
  }[];
}

const BanChuyen = ({
  item,
  onPress,
  isSelected,
  disabled,
}: {
  item: banProps;
  onPress?: (event: GestureResponderEvent) => void;
  isSelected?: boolean;
  disabled?: boolean;
}) => {
  const trangThai = item.hoaDon?.[0]?.trangThai ?? '2';
  const tongTien = item.hoaDon.reduce((sum, hd) => {
    return sum + Number(hd.soLuong) * Number(hd.donGia);
  }, 0);
  const soLuongMon = item.hoaDon.reduce((sum, hd) => sum + Number(hd.soLuong), 0);

  return (
    <TouchableOpacity
      style={[
        styles.tableCard,
        {
          backgroundColor: getStatusColor(trangThai) + '20',
          borderColor: getStatusColor(trangThai),
        },
        isSelected && styles.selectedCard,
        disabled && styles.disabledCard,
      ]}
      onPress={onPress}
      disabled={disabled}
      activeOpacity={disabled ? 1 : 0.7}
    >
      <View style={styles.tableTop}>
        <MaterialCommunityIcons
          name={getStatusIcon(trangThai)}
          size={16}
          color={getStatusColor(trangThai)}
        />
        <Text style={styles.tableName}>{item.tenBan}</Text>
      </View>

      <View style={styles.tableContent}>
        <View style={styles.tableInner}>
          <Text style={styles.tableAmount}>
            {tongTien > 0 ? numeral(tongTien).format() + 'đ' : 'Bàn trống'}
          </Text>
          {tongTien > 0 && (
            <Text style={styles.tableOrderCount}>
              {soLuongMon} món
            </Text>
          )}
        </View>
      </View>
    </TouchableOpacity>
  );
};

const styles = StyleSheet.create({
  container: {
    padding: 8,
    flexGrow: 1,
  },
  tableCard: {
    width: (width - 48) / 3,
    height: (width - 48) / 3,
    margin: 4,
    borderRadius: 8,
    borderWidth: 2,
    padding: 8,
    justifyContent: 'space-between',
  },
  tableTop: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  tableName: {
    fontSize: 15,
    fontWeight: 'bold',
    color: '#333',
  },
  tableContent: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  tableInner: {
    width: '90%',
    height: '70%',
    backgroundColor: 'rgba(255, 255, 255, 0.8)',
    borderRadius: 4,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 4,
    position: 'relative',
  },
  tableAmount: {
    fontSize: 12,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 2,
    textAlign: 'center',
  },
  tableOrderCount: {
    fontSize: 10,
    color: '#666',
    textAlign: 'center',
  },
  tableTime: {
    fontSize: 12,
    color: '#666',
  },
  pendingBadge: {
    position: 'absolute',
    top: -8,
    right: -8,
    backgroundColor: '#f44336',
    width: 20,
    height: 20,
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  pendingText: {
    color: '#fff',
    fontSize: 10,
    fontWeight: 'bold',
  },
  selectedCard: {
    borderWidth: 2,
    borderColor: '#ef4444', // Thay đổi màu viền
    shadowColor: '#ef4444', // Thay đổi màu bóng
    shadowOffset: {width: 0, height: 0},
    shadowOpacity: 0.3,
    shadowRadius: 4,
    elevation: 4,
  },
  disabledCard: {
    opacity: 0.4,
  },
});
export default BanChuyen;
