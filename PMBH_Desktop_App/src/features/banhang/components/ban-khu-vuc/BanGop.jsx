import {
  Dimensions,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';

import {useMutation} from '@tanstack/react-query';
import {useState} from 'react';
import Button from '../../../../components/Button.component';
import ConfirmModal from '../../../../components/ConfirmModal.component';
import {TEXT_TOAST} from '../../../../constants';
import {useToast} from '../../../../context/ToastProvider';
import {capNhatHoaDon2, capNhatHoaDonTT4, tachBan} from '../../api';
import numeral from 'numeral';
import MaterialCommunityIcons from 'react-native-vector-icons/MaterialCommunityIcons';
import {getStatusColor, getStatusIcon} from '../../../../utils';
import {NavigationProp, useNavigation} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';
const {width} = Dimensions.get('window');
interface banGopProps {
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
    checkChuyenBan: string;
  }[];
  danhSachGop: any;
}

const BanGop = ({
  item,
  fetchAllData,
}: {
  item: banGopProps;
  fetchAllData: () => void;
}) => {
  console.log('item', item);
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const [visible, setVisible] = useState<boolean>(false);

  const trangThai = item.hoaDon?.[0]?.checkChuyenBan
    ? '4'
    : item.hoaDon?.[0]?.trangThai ?? '2';
  const gioVao = item.hoaDon?.[0]?.gioVao ?? null;

  const tongTien = item.hoaDon.reduce((sum, hd) => {
    return sum + Number(hd.soLuong) * Number(hd.donGia);
  }, 0);
  const {showToast} = useToast();
  const {mutate, isPending} = useMutation({
    mutationFn: tachBan,
    onSuccess: data => {
      if (data.success) {
        showToast(data.message, 'success');
        hideModal();
        fetchAllData();
      } else {
        showToast(data.message, 'error');
      }
    },
    onError: err => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const hideModal = () => setVisible(false);

  const handleTachBan = () => {
    mutate({maHoaDon: item.hoaDon[0].maHoaDon});
  };
  const {mutate: capNhatHoaDonApi} = useMutation({
    mutationFn: capNhatHoaDon2,
    onSuccess: () => {
      nav.navigate('GoiMon', {
        maHoaDon: item.hoaDon[0]?.maHoaDon,
        tenBan: item.tenBan,
        maBan: item.maBan,
      });
    },
  });
  const {mutate: capNhatHoaDonApi1} = useMutation({
    mutationFn: capNhatHoaDonTT4,
    onSuccess: () => {
      nav.reset({
        index: 0,
        routes: [{name: 'BottomNav'}],
      });
    },
  });
  const handleGoiMon = () => {
    if (trangThai == '1') {
      capNhatHoaDonApi({maHd: item.hoaDon[0].maHoaDon, trangThai: '2'});
    } else if (trangThai == '4') {
      capNhatHoaDonApi1({maHd: item.hoaDon[0].maHoaDon, trangThai: '0'});
    } else {
      nav.navigate('GoiMon', {
        maHoaDon: item.hoaDon[0]?.maHoaDon,
        tenBan: item.tenBan,
        maBan: item.maBan,
      });
    }
  };

  return (
    <View style={styles.tableCard}>
      <View style={styles.leftSection}>
        <TouchableOpacity
          onPress={handleGoiMon}
          style={[
            styles.mainTable,
            {
              backgroundColor: getStatusColor(trangThai) + '20',
              borderColor: getStatusColor(trangThai),
            },
          ]}>
          <View style={styles.tableTop}>
            <MaterialCommunityIcons
              name={getStatusIcon(trangThai)}
              size={16}
              color={getStatusColor(trangThai)}
            />
            <Text style={styles.tableName}>{item.tenBan}</Text>
          </View>

          <View style={styles.tableContent}>
            <Text style={styles.tableAmount}>
              {tongTien ? numeral(tongTien).format() + 'đ' : ''}
            </Text>
            <Text style={styles.tableTime}>{gioVao ? gioVao : ''}</Text>
          </View>
          <Button
            style={styles.tachButton}
            fontSize={12}
            disabled={isPending}
            loading={isPending}
            onPress={() => setVisible(true)}
            title="Tách bàn"
          />
        </TouchableOpacity>
      </View>

      <View style={styles.rightSection}>
        {/* <Text style={styles.mergedTitle}>Đang gộp với</Text> */}
        <View style={styles.mergedList}>
          {item.danhSachGop.map((item: any, index: any) => (
            <View
              key={index}
              style={[
                styles.mergedItem,
                {
                  backgroundColor: getStatusColor(trangThai) + '20',
                  borderColor: getStatusColor(trangThai),
                },
              ]}>
              <View style={styles.mergedTableHeader}>
                <MaterialCommunityIcons
                  name={getStatusIcon(trangThai)}
                  size={14}
                  color={getStatusColor(trangThai)}
                />
                <Text style={styles.mergedTableName}>{item.tenBan}</Text>
              </View>
              <View style={styles.tableContent}>
                <Text style={styles.tableTime}>Đã gộp</Text>
              </View>
            </View>
          ))}
        </View>
      </View>

      <ConfirmModal
        visible={visible}
        onClose={hideModal}
        onConfirm={handleTachBan}
        title="Xác nhận tách bàn?"
      />
    </View>
  );
};

const styles = StyleSheet.create({
  tableCard: {
    flexDirection: 'row',
    marginBottom: 12,
    marginHorizontal: 4,
    padding: 12,
    backgroundColor: '#ffffff',
    borderRadius: 8,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 1},
    shadowOpacity: 0.1,
    shadowRadius: 2,
    elevation: 2,
  },
  leftSection: {
    flex: 1,
    marginRight: 12,
  },
  rightSection: {
    flex: 1,
    borderLeftWidth: 1,
    borderLeftColor: '#e5e5e5',
    paddingLeft: 12,
  },
  mainTable: {
    borderWidth: 2,
    borderRadius: 8,
    padding: 10,
  },
  tachButton: {
    height: 32,
    marginTop: 8,
  },
  mergedTitle: {
    fontSize: 14,
    fontWeight: '600',
    marginBottom: 10,
    color: '#444',
  },
  mergedList: {
    gap: 8,
  },
  mergedItem: {
    borderWidth: 2,
    borderRadius: 8,
    padding: 10,
    height: 100, // Match mainTable height
    justifyContent: 'space-between',
  },
  mergedTableHeader: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  mergedTableName: {
    fontSize: 13,
    fontWeight: '600',
    color: '#333',
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
  tableAmount: {
    fontSize: 13,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 4,
  },
  tableTime: {
    fontSize: 12,
    color: '#666',
  },
});

export default BanGop;
