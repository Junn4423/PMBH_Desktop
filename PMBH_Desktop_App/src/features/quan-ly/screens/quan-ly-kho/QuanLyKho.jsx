/* eslint-disable @typescript-eslint/no-shadow */
/* eslint-disable react-hooks/exhaustive-deps */
import {FlatList, StyleSheet, TouchableOpacity, View} from 'react-native';
import {Text} from 'react-native-paper';
import theme from '../../../../theme';
import WrapHeader from '../../../../components/WrapHeader.component';
import {useFocusEffect, useNavigation} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import {loadKho, xoaKho} from '../../api';
import {useCallback, useMemo, useState} from 'react';
import Loading from '../../../../components/Loading.component';
import SearchInput from '../../../../components/SearchInput.component';
import {CartKho, ModalThemSuaKho} from '../../components/quan-ly-kho';
import {kho} from '../../types';
import CommonModal from '../../../../components/CommonModal.component';
import ConfirmModal from '../../../../components/ConfirmModal.component';
import {useToast} from '../../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../../constants';

function QuanLyKho() {
  const nav = useNavigation();
  const {showToast} = useToast();
  const {mutate, data, isPending} = useMutation({
    mutationFn: loadKho,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({});
    }, []),
  );
  const [tuKhoa, setTuKhoa] = useState<string>('');
  const danhSachKhoLoc = useMemo(() => {
    return (
      data &&
      data.filter(kho => {
        const tenKho = kho.tenKho ? kho.tenKho.toLowerCase() : '';
        const maKho = kho.maKho ? kho.maKho.toLowerCase() : '';
        const tuKhoaLowerCase = tuKhoa.toLowerCase();
        return (
          tenKho.includes(tuKhoaLowerCase) || maKho.includes(tuKhoaLowerCase)
        );
      })
    );
  }, [data, tuKhoa]);

  const [visible, setModalVisible] = useState(false);
  const [visibleXoaKho, setVisibleXoaKho] = useState(false);

  const [khoHienTai, setKhoHienTai] = useState<kho | null>(null);

  const handleSuaKho = (item: kho) => {
    setKhoHienTai(item);
    setModalVisible(true);
  };

  const {mutate: xoaKhoApi, isPending: loadingXoaKho} = useMutation({
    mutationFn: xoaKho,
    onSuccess: () => {
      setVisibleXoaKho(false);
      setMaKhoCanXoa(null);
      mutate({}); // Reload lại danh sách kho
      showToast('Xoá kho thành công!', 'success');
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'success');
    },
  });

  const [maKhoCanXoa, setMaKhoCanXoa] = useState<string | null>(null);
  const handleXoaKho = (maKho: string) => {
    setVisibleXoaKho(true);
    setMaKhoCanXoa(maKho);
  };

  const handleXoa = () => {
    if (maKhoCanXoa) {
      xoaKhoApi({lv001: maKhoCanXoa});
    }
  };
  return (
    <View style={styles.container}>
      <WrapHeader title="Quản lý kho" handleBack={() => nav.goBack()}>
        <TouchableOpacity
          style={styles.btnCreate}
          onPress={() => setModalVisible(true)}>
          <Text style={styles.textBtnCreate}>+ Thêm kho mới</Text>
        </TouchableOpacity>
      </WrapHeader>
      <SearchInput tuKhoa={tuKhoa} setTuKhoa={setTuKhoa} />
      <Loading loading={isPending}>
        {danhSachKhoLoc && danhSachKhoLoc.length > 0 ? (
          <FlatList
            style={{paddingHorizontal: 10}}
            data={danhSachKhoLoc}
            keyExtractor={item => item.maKho + ''}
            renderItem={({item}) => (
              <CartKho
                item={item}
                handleSuaKho={() => handleSuaKho(item)}
                handleXoaKho={handleXoaKho}
              />
            )}
          />
        ) : (
          <View style={styles.noData}>
            <Text style={styles.textNoData}>
              Không tìm thấy kho nào phù hợp với từ khóa tìm kiếm
            </Text>
          </View>
        )}
      </Loading>

      <CommonModal
        visible={visible}
        onDismiss={() => setModalVisible(false)}
        children={
          <ModalThemSuaKho
            onReloadGioHang={() => mutate({})}
            khoHienTai={khoHienTai}
            dsKho={data ?? []}
            handelDongModal={() => setModalVisible(false)}
          />
        }
      />

      <ConfirmModal
        onConfirm={handleXoa}
        visible={visibleXoaKho}
        hideModal={() => setVisibleXoaKho(false)}
        loading={loadingXoaKho}
        title="Xoá kho"
        description={'Bạn có chắc chắn muốn xoá kho không ?'}
        confirmLabel="Xác nhận"
        cancelLabel="Huỷ"
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
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
});
export default QuanLyKho;
