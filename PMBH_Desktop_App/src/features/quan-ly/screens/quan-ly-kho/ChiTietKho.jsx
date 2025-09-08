/* eslint-disable react-hooks/exhaustive-deps */

import {FlatList, StyleSheet, View} from 'react-native';
import {Menu, Text, TouchableRipple, TextInput} from 'react-native-paper';
import theme from '../../../../theme';
import WrapHeader from '../../../../components/WrapHeader.component';
import {
  RouteProp,
  useFocusEffect,
  useNavigation,
  useRoute,
} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';
import {useMutation} from '@tanstack/react-query';
import {layAll_LoaiNVL, loadSanPhamTheoIdKho} from '../../api';
import {useCallback, useMemo, useState} from 'react';
import Loading from '../../../../components/Loading.component';
import {HienThiNguyenLieu} from '../../components/quan-ly-kho';
import SearchInput from '../../../../components/SearchInput.component';
import {loaiNguyenLieu} from '../../types';
type ctKho = RouteProp<RootStackParamList, 'ChiTietKho'>;
function ChiTietKho() {
  const route = useRoute<ctKho>();
  const {maKho, tenKho} = route.params;
  const nav = useNavigation();

  const {mutate, data, isPending} = useMutation({
    mutationFn: loadSanPhamTheoIdKho,
  });

  const {mutate: loaiSpApi, data: loaiSp} = useMutation({
    mutationFn: layAll_LoaiNVL,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({maKho: maKho});
      loaiSpApi();
    }, []),
  );

  const [loaiNVLChon, setLoaiNVLChon] = useState<string>('');
  const [moTaLoaiNVL, setMoTaLoaiNVL] = useState<string>('Tất cả loại NVL');
  const [menuVisible, setMenuVisible] = useState<boolean>(false);
  const [tuKhoa, setTuKhoa] = useState<string>('');
  const DanhSachSPLoc = useMemo(() => {
    return (
      data &&
      data.filter(
        item =>
          (item.maSp.toLowerCase().includes(tuKhoa.toLowerCase()) ||
            item.tenSp.toLowerCase().includes(tuKhoa.toLowerCase())) &&
          (loaiNVLChon === '' || item.loaiSp === loaiNVLChon),
      )
    );
  }, [tuKhoa, loaiNVLChon, data]);

  // Xử lý chọn loại nguyên vật liệu
  const chonLoaiNVL = (loai: loaiNguyenLieu | null) => {
    if (loai) {
      setLoaiNVLChon(loai.id);
      setMoTaLoaiNVL(loai.tenLoai);
    } else {
      setLoaiNVLChon('');
      setMoTaLoaiNVL('Tất cả loại NVL');
    }
    setMenuVisible(false);
  };
  return (
    <View style={styles.container}>
      <WrapHeader title="Sản phẩm trong kho" handleBack={() => nav.goBack()} />

      <View style={styles.infoContainer}>
        <Text style={styles.tenKho}>{tenKho}</Text>
        <Text style={styles.soLuongSanPham}>
          Tổng số sản phẩm: {data && data.length}
        </Text>
      </View>

      <View style={styles.searchContainer}>
        <SearchInput
          tuKhoa={tuKhoa}
          containerStyle={{backgroundColor: '#fff'}}
          setTuKhoa={setTuKhoa}
          inputStyle={{backgroundColor: '#fff'}}
        />
        <View>
          <View collapsable={false}>
            <TouchableRipple onPress={() => setMenuVisible(true)}>
              <TextInput
                label="Lọc theo loại nguyên vật liệu"
                value={loaiNVLChon ? moTaLoaiNVL : 'Tất cả nguyên liệu'}
                mode="outlined"
                editable={false}
                right={
                  <TextInput.Icon
                    icon="menu-down"
                    onPress={() => setMenuVisible(true)}
                  />
                }
                theme={{colors: {primary: '#2196F3'}}}
              />
            </TouchableRipple>
          </View>
          <Menu
            visible={menuVisible}
            onDismiss={() => setMenuVisible(false)}
            anchor={{x: 16, y: 220}}
            style={styles.menu}>
            <Menu.Item
              onPress={() => chonLoaiNVL(null)}
              title="Tất cả loại NVL"
            />
            {loaiSp &&
              loaiSp.map(loai => {
                const loaiTyped = loai as loaiNguyenLieu;
                return (
                  <Menu.Item
                    key={loaiTyped.id}
                    onPress={() => chonLoaiNVL(loaiTyped)}
                    title={loaiTyped.tenLoai}
                  />
                );
              })}
          </Menu>
        </View>
      </View>
      <Loading loading={isPending}>
        {DanhSachSPLoc && DanhSachSPLoc.length > 0 ? (
          <FlatList
            data={DanhSachSPLoc}
            renderItem={({item}) => <HienThiNguyenLieu item={item} />}
            keyExtractor={item => item.maSp}
            style={styles.listContainer}
          />
        ) : (
          <View style={styles.noData}>
            <Text style={styles.textNoData}>
              {DanhSachSPLoc && DanhSachSPLoc.length === 0
                ? 'Không có sản phẩm nào trong kho này'
                : 'Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm'}
            </Text>
          </View>
        )}
      </Loading>
    </View>
  );
}

const styles = StyleSheet.create({
  searchContainer: {
    padding: 16,
    backgroundColor: '#ffffff',
  },
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
  },
  infoContainer: {
    backgroundColor: '#ffffff',
    padding: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  tenKho: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#4CAF50',
    marginBottom: 8,
  },
  soLuongSanPham: {
    fontSize: 14,
    color: '#757575',
  },
  listContainer: {
    flex: 1,
    padding: 8,
  },
  menu: {
    width: '90%',
  },
  noData: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  textNoData: {
    fontSize: 16,
    color: '#757575',
    textAlign: 'center',
  },
});

export default ChiTietKho;
