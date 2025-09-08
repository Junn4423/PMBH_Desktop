import {FlatList, StyleSheet, View} from 'react-native';
import {Appbar, Text} from 'react-native-paper';
import WrapHeader from '../../../../components/WrapHeader.component';
import {useNavigation} from '@react-navigation/native';
import Loading from '../../../../components/Loading.component';
import useFetchBanKhuVuc from '../../hooks/useFetchBanKhuVuc';
import {BanChuyen} from '../../components/chuyen-ban';
import {useState} from 'react';
import {useToast} from '../../../../context/ToastProvider';
import ConfirmModal from '../../../../components/ConfirmModal.component';
import {useMutation} from '@tanstack/react-query';
import {chuyenBan} from '../../api';
import {TEXT_TOAST} from '../../../../constants';

function ChuyenBan() {
  const nav = useNavigation();

  const {dsBanKhongGop, loading, fetchAllData} = useFetchBanKhuVuc();

  const [selectedTables, setSelectedTables] = useState<
    {maBan: string; maHoaDon: string}[]
  >([]);
  // Hàm chọn bàn
  const handleSelect = (maBan: string, maHoaDon: string) => {
    if (selectedTables.find(t => t.maBan === maBan)) {
      setSelectedTables(selectedTables.filter(t => t.maBan !== maBan));
    } else if (selectedTables.length < 2) {
      setSelectedTables([...selectedTables, {maBan, maHoaDon}]);
    }
  };

  const [visibleModal, setVisibleModal] = useState<boolean>(false);
  const {showToast} = useToast();
  const hideModal = () => setVisibleModal(false);

  const {mutate, isPending} = useMutation({
    mutationFn: chuyenBan,
    onSuccess: data => {
      if (data) {
        showToast('Chuyển bàn thành công', 'success');
        fetchAllData();
        hideModal();
        setSelectedTables([])

      } else {
        showToast('Không thể chuyển bàn', 'error');
      }
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const handleChuyenBan = () => {
    if (
      selectedTables.length === 2 &&
      !selectedTables[0].maHoaDon &&
      !selectedTables[1].maHoaDon
    ) {
      showToast('Không thể chuyển bàn', 'error');
      return;
    } else if (selectedTables.length === 2) {
      mutate({
        maHoaDonBanCanChuyen: selectedTables[0].maHoaDon,
        maBanChuyen: selectedTables[1].maBan,
        maHoaDonBanChuyen: selectedTables[1].maHoaDon,
      });
    }
  };

  return (
    <View style={styles.container}>
      <WrapHeader title="Chuyển Bàn" handleBack={() => nav.goBack()}>
        <Appbar.Action
          iconColor={selectedTables.length === 2 ? 'white' : 'gray'}
          icon="check"
          onPress={() => {
            if (selectedTables.length === 2) setVisibleModal(true);
          }}
        />
      </WrapHeader>

      <View style={{flex: 1, padding: 12}}>
        <Loading loading={loading}>
          {dsBanKhongGop && dsBanKhongGop.length > 0 ? (
            <FlatList
              data={dsBanKhongGop}
              renderItem={({item}) => (
                <BanChuyen
                  item={item}
                  onPress={() =>
                    handleSelect(item.maBan, item.hoaDon?.[0]?.maHoaDon || '')
                  }
                  isSelected={selectedTables.some(t => t.maBan === item.maBan)}
                  disabled={
                    selectedTables.length === 2 &&
                    !selectedTables.some(t => t.maBan === item.maBan)
                  }
                />
              )}
              keyExtractor={item => item.maBan}
              numColumns={3}
              scrollEnabled={false}
            />
          ) : (
            <Text style={{textAlign: 'center'}}>
              Hiện không còn bàn nào để chuyển
            </Text>
          )}
        </Loading>
      </View>

      <ConfirmModal
        visible={visibleModal}
        hideModal={hideModal}
        onConfirm={handleChuyenBan}
        loading={isPending}
        title="Xác nhận chuyển bàn"
        description={
          selectedTables.length === 2
            ? `Bạn muốn chuyển hóa đơn từ bàn "${
                dsBanKhongGop &&
                dsBanKhongGop.find(b => b.maBan === selectedTables[0].maBan)
                  ?.tenBan
              }" sang bàn "${
                dsBanKhongGop &&
                dsBanKhongGop.find(b => b.maBan === selectedTables[1].maBan)
                  ?.tenBan
              }"?`
            : 'Vui lòng chọn đủ 2 bàn để chuyển.'
        }
        items={
          selectedTables.length === 2
            ? [
                `Bàn chuyển đi: ${
                  dsBanKhongGop &&
                  dsBanKhongGop.find(b => b.maBan === selectedTables[0].maBan)
                    ?.tenBan
                } (HĐ: ${selectedTables[0].maHoaDon || 'Không có'})`,
                `Bàn nhận: ${
                  dsBanKhongGop &&
                  dsBanKhongGop.find(b => b.maBan === selectedTables[1].maBan)
                    ?.tenBan
                } (HĐ: ${selectedTables[1].maHoaDon || 'Không có'})`,
              ]
            : []
        }
        confirmLabel="Xác nhận chuyển bàn"
        cancelLabel="Huỷ"
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
export default ChuyenBan;
