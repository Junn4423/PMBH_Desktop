import {useNavigation} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import {useState} from 'react';
import {FlatList, StyleSheet, Text, View} from 'react-native';
import {Appbar} from 'react-native-paper';
import ConfirmModal from '../../../../components/ConfirmModal.component';
import Loading from '../../../../components/Loading.component';
import WrapHeader from '../../../../components/WrapHeader.component';
import {TEXT_TOAST} from '../../../../constants';
import {useToast} from '../../../../context/ToastProvider';
import {gopBan} from '../../api';
import {BanGop} from '../../components/gop-ban';
import useFetchBanKhuVuc from '../../hooks/useFetchBanKhuVuc';

function GopBan() {
  const nav = useNavigation();
  const {dsBanKhongGop, loading, fetchAllData} = useFetchBanKhuVuc();

  const [selectedTables, setSelectedTables] = useState<string[]>([]);

  const [banCanGop, setBanCanGop] = useState<{
    id: string;
    tenBan: string;
    idDonHang: string;
  } | null>(null);

  const [banGop, setBanGop] = useState<{id: string; tenBan: string}[]>([]);

  // ham xu lay cac tinh nang gop
  const handleSelect = (maBan: string, tenBan: string, idDonHang: string) => {
    setSelectedTables(
      prevSelected =>
        prevSelected.includes(maBan)
          ? prevSelected.filter(ban => ban !== maBan) // Bỏ chọn nếu đã chọn
          : [...prevSelected, maBan], // Thêm vào danh sách nếu chưa chọn
    );

    if (!banCanGop) {
      setBanCanGop({id: maBan, tenBan: tenBan, idDonHang: idDonHang});
    }
    if (banCanGop?.id == maBan) {
      setBanCanGop(null);
      setBanGop([]);
      setSelectedTables([]);
    }
    // them ban gop
    if (banCanGop && banCanGop.id != maBan) {
      if (banGop.find(ban => ban.id == maBan)) {
        setBanGop(prev => prev.filter(ban => ban.id !== maBan));
      } else {
        setBanGop(prev => [...prev, {id: maBan, tenBan: tenBan}]);
      }
    }
  };

  const [visibleModal, setVisibleModal] = useState<boolean>(false);
  const {showToast} = useToast();
  const hideModal = () => setVisibleModal(false);

  const {mutate} = useMutation({
    mutationFn: gopBan,
    onSuccess: data => {
      if (data.success) {
        showToast(data.message, 'success');
        fetchAllData();
        hideModal();
      } else {
        showToast(data.message, 'error');
        hideModal();
      }
    },
    onError: err => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const handleMerge = async () => {
    const ids = banGop.map(item => item.id).join(', ');
    mutate({maHoaDon: banCanGop?.idDonHang ?? '', idBanGop: ids});
  };

  return (
    <View style={styles.container}>
      <WrapHeader title="Gộp Bàn" handleBack={() => nav.goBack()}>
        <Appbar.Action
          iconColor={banCanGop ? 'white' : 'gray'}
          icon="check"
          onPress={() => setVisibleModal(true)}
        />
      </WrapHeader>
      <View style={{flex: 1, padding: 12}}>
        <Loading loading={loading}>
          {dsBanKhongGop && dsBanKhongGop.length > 0 ? (
            <FlatList
              data={dsBanKhongGop}
              renderItem={({item}) => (
                <BanGop
                  item={item}
                  onPress={() =>
                    handleSelect(item.maBan, item.tenBan, item.maHoaDon)
                  }
                  isSelected={selectedTables.includes(item.maBan)}
                />
              )}
              keyExtractor={item => item.maBan}
              numColumns={3}
              scrollEnabled={false}
            />
          ) : (
            <Text style={{textAlign: 'center'}}>
              Hiện không còn bàn nào để gộp
            </Text>
          )}
        </Loading>
      </View>

      <ConfirmModal
        visible={visibleModal}
        hideModal={hideModal}
        onConfirm={handleMerge}
        loading={loading}
        title="Gộp bàn"
        description={`Số bàn đang gộp ${banGop.length}. Bàn chính sẽ là bàn ${banCanGop?.tenBan}.`}
        items={banGop.map(item => item.tenBan)}
        confirmLabel="Xác nhận gộp bàn"
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
export default GopBan;
