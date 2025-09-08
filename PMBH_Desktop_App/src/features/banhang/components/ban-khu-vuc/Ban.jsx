import {NavigationProp, useNavigation} from '@react-navigation/native';

import {useMutation} from '@tanstack/react-query';
import numeral from 'numeral';
import React from 'react';
import {
  Dimensions,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';
import MaterialCommunityIcons from 'react-native-vector-icons/MaterialCommunityIcons';
import {RootStackParamList} from '../../../../types/navigation';
import {getStatusColor, getStatusIcon} from '../../../../utils';
import {capNhatHoaDon2, capNhatHoaDonTT4} from '../../api';
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
    checkChuyenBan: string;
  }[];
}

const Ban = ({item}: {item: banProps}) => {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();

  const trangThai = item.hoaDon?.[0]?.checkChuyenBan
    ? '4'
    : item.hoaDon?.[0]?.trangThai ?? '2';
  const tongTien = item.hoaDon.reduce((sum, hd) => {
    return sum + Number(hd.soLuong) * Number(hd.donGia);
  }, 0);
  const gioVao = item.hoaDon?.[0]?.gioVao ?? null;

  const {mutate: capNhatHoaDonApi} = useMutation({
    mutationFn: capNhatHoaDon2,
    onSuccess: () => {
      // nav.navigate('GoiMon', {
      //   maHoaDon: item.hoaDon[0]?.maHoaDon,
      //   tenBan: item.tenBan,
      //   maBan: item.maBan,
      // });
      nav.reset({
        index: 0,
        routes: [{name: 'BottomNav'}],
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
    } else if (trangThai == '0') {
      // nav.navigate('GoiMon', {
      //   maHoaDon: item.hoaDon[0]?.maHoaDon,
      //   tenBan: item.tenBan,
      //   maBan: item.maBan,
      // });

      const maHoaDon = item.hoaDon?.[0]?.maHoaDon;
      if (maHoaDon) {
        nav.navigate('ThanhToan', {
          idDonHang: maHoaDon,
          tenBan: item.tenBan,
        });
      } else {
        nav.navigate('GoiMon', {
          maHoaDon: maHoaDon ?? '',
          tenBan: item.tenBan,
          maBan: item.maBan,
        });
      }
    } else {
      nav.navigate('GoiMon', {
        maHoaDon: item.hoaDon[0]?.maHoaDon,
        tenBan: item.tenBan,
        maBan: item.maBan,
      });
    }
  };

  return (
    <TouchableOpacity
      onPress={handleGoiMon}
      style={[
        styles.tableCard,
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
        <View style={styles.tableInner}>
          <Text style={styles.tableAmount}>
            {tongTien ? numeral(tongTien).format() + 'đ' : ''}
          </Text>
          <Text style={styles.tableTime}>{gioVao ? gioVao : ''}</Text>
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
    width: (width - 48) / 2,
    height: (width - 48) / 2,
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
    fontSize: 13,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 4,
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
    borderColor: '#3b82f6',
    shadowColor: '#3b82f6',
    shadowOffset: {width: 0, height: 0},
    shadowOpacity: 0.3,
    shadowRadius: 4,
    elevation: 4,
  },
});

export default Ban;
