/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
import {
  StyleSheet,
  TextInput,
  View,
  TouchableOpacity,
  FlatList,
} from 'react-native';
import {Appbar, Text} from 'react-native-paper';
import theme from '../../../../theme';
import {layXuatKho, xoaPhieuXuat} from '../../api/index';
import {useCallback, useMemo, useState} from 'react';
import {HienThiPhieuXuat} from '../../components/xuat-kho/index';
import {
  NavigationProp,
  useFocusEffect,
  useNavigation,
} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';
import ConfirmModal from '../../../../components/ConfirmModal.component';
import {useMutation} from '@tanstack/react-query';
import {useToast} from '../../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../../constants';

export default function XuatKho() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();

  const {mutate, data, isPending} = useMutation({
    mutationFn: layXuatKho,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({});
    }, []),
  );
  const [tuKhoa, setTuKhoa] = useState<string>('');
  // Thêm các state cho modal xác nhận xoá
  const [visibleXoaKho, setVisibleXoaKho] = useState(false);
  const [maPhieu, setMaPhieu] = useState<string | null>(null);

  const dsPhieuXuat = useMemo(() => {
    return data?.filter(p => {
      const tuKhoaLowerCase = tuKhoa.toLowerCase();
      const maKho = p.maKho ? p.maKho.toLowerCase() : '';
      return maKho.includes(tuKhoaLowerCase);
    });
  }, [tuKhoa, data]);

  // Khi gọi xoá phiếu nhập, mở modal xác nhận và lưu mã kho cần xoá
  const handleXoaPhieu = (maPhieuXuat: string) => {
    setMaPhieu(maPhieuXuat);
    setVisibleXoaKho(true);
  };

  const {showToast} = useToast();
  const {mutate: xoaPhieu, isPending: loadingXoaPhieu} = useMutation({
    mutationFn: xoaPhieuXuat,
    onSuccess: () => {
      setVisibleXoaKho(false);
      setMaPhieu(null);
      mutate({}); // Reload lại danh sách kho
      showToast('Xoá phiếu thành công!', 'success');
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'success');
    },
  });
  // Hàm xác nhận xoá
  const handleXoa = () => {
    console.log(maPhieu);
    if (maPhieu) {
      xoaPhieu({maPhieu: maPhieu});
    }
  };
  return (
    <View style={{flex: 1}}>
      <Appbar.Header style={styles.wrap}>
        <Appbar.BackAction
          color={theme.colors.textHeader}
          onPress={() => {
            nav.goBack();
          }}
        />
        <Appbar.Content
          titleStyle={{color: theme.colors.textHeader, fontWeight: '700'}}
          title="Xuất kho"
        />

        <TouchableOpacity
          style={styles.btnCreate}
          //@ts-ignore
          onPress={() => nav.navigate('TaoPhieuXuat')}>
          <Text style={styles.textBtnCreate}>+ Thêm Phiếu Xuất</Text>
        </TouchableOpacity>
      </Appbar.Header>
      <View style={styles.searchContainer}>
        <TextInput
          style={styles.searchInput}
          placeholder="Tìm kiếm theo tên hoặc mã kho..."
          value={tuKhoa}
          onChangeText={setTuKhoa}
        />
      </View>
      {dsPhieuXuat && dsPhieuXuat.length > 0 ? (
        <FlatList
          data={dsPhieuXuat}
          renderItem={({item, index}) => (
            <HienThiPhieuXuat
              item={item}
              index={index}
              xoaPhieu={() => handleXoaPhieu(item.maPhieuXuat)}
            />
          )}
          keyExtractor={item => item.maPhieuXuat}
          style={styles.listContainer}
          contentContainerStyle={styles.listContentContainer}
        />
      ) : (
        <View style={styles.noData}>
          <Text style={styles.textNoData}>
            Không tìm thấy phiếu nhập nào phù hợp với từ khóa tìm kiếm
          </Text>
        </View>
      )}
      <ConfirmModal
        onConfirm={handleXoa}
        visible={visibleXoaKho}
        hideModal={() => setVisibleXoaKho(false)}
        loading={loadingXoaPhieu}
        title="Xoá phiếu nhập"
        description={'Bạn có chắc chắn muốn xoá phiếu nhập không ?'}
        confirmLabel="Xác nhận"
        cancelLabel="Huỷ"
      />
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
  btnCreate: {
    backgroundColor: '#4CAF50',
    paddingVertical: 8,
    paddingHorizontal: 12,
    borderRadius: 4,
    marginRight: 10,
  },
  textBtnCreate: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
  searchContainer: {
    padding: 8,
    backgroundColor: theme.colors.primary,
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
    borderLeftColor: '#4CAF50',
  },
  headerItem: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 10,
  },
  indexContainer: {
    backgroundColor: '#4CAF50',
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
  ngayNhap: {
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
  tongGiaTri: {
    fontWeight: 'bold',
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
  textBtnAction: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
  statusLocked: {
    color: '#F44336',
  },
  statusUnlocked: {
    color: '#4CAF50',
  },
});
