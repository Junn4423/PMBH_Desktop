/* eslint-disable react-native/no-inline-styles */
import {
  NavigationProp,
  RouteProp,
  useFocusEffect,
  useNavigation,
  useRoute,
} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import {useCallback, useEffect, useState} from 'react';
import {StyleSheet, View} from 'react-native';

import Loading from '../../../../components/Loading.component';
import WrapHeader from '../../../../components/WrapHeader.component';
import {TEXT_TOAST} from '../../../../constants';
import {useToast} from '../../../../context/ToastProvider';
import theme from '../../../../theme';
import {RootStackParamList} from '../../../../types/navigation';
import {loadDanhMucSp, loadDsCthd, loadSanPhamTheoMaDanhMucSp} from '../../api';
import {
  BottomDonHang,
  DanhMucSp,
  ListSanPham,
  ModalGioHang,
  ModalGoiMon,
} from '../../components/goi-mon';
import {sanPham} from '../../types';
import {IconButton} from 'react-native-paper';

// Thêm import Modal QR và state
import QuetMaQR from '../../../../components/QuetMaQR';
import {Modal, Portal} from 'react-native-paper';

type GoiMonRouteProp = RouteProp<RootStackParamList, 'GoiMon'>;
function GoiMon() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const route = useRoute<GoiMonRouteProp>();
  const {maBan, maHoaDon} = route.params;
  const [select, setSelect] = useState<{
    index: number;
    maDanhMucSp: string;
  }>({
    index: 0,
    maDanhMucSp: '',
  });
  const {showToast} = useToast();

  const [visible, setVisible] = useState(false);
  const [visibleGioHang, setVisibleGioHang] = useState(false);
  const [mahd, setMaHd] = useState(maHoaDon);
  const {
    mutate,
    data: dataDanhMucSp,
    isPending: loadingSp,
  } = useMutation({
    mutationFn: loadDanhMucSp,
    onSuccess: data => {
      if (data) {
        loadSp({maDm: data?.[0]?.maDanhMucSp});
      }
    },
    onError: err => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const {mutate: loadCthd, data: gioHang} = useMutation({
    mutationFn: loadDsCthd,
  });

  const {mutate: loadSp, data: dataSp} = useMutation({
    mutationFn: loadSanPhamTheoMaDanhMucSp,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({}); // danh muc
      if (mahd) {
        loadCthd({maHd: mahd});
      }
    }, [mahd]),
  );

  useEffect(() => {
    loadSp({maDm: select.maDanhMucSp});
  }, [select]);

  const [itemSp, setItemSp] = useState<sanPham | null>(null);

  // QR state
  const [modalQRVisible, setModalQRVisible] = useState(false);

  const handelSelectSp = (item: sanPham) => {
    setItemSp(item);
    setVisible(true);
  };

  const hideModal = () => {
    setVisible(false);
    setItemSp(null); // Reset sản phẩm khi đóng modal
  };

  const hideModalGioHang = () => setVisibleGioHang(false);

  const onHandeleMahd = (maHds: string) => {
    console.log('maHd', maHds);
    setMaHd(maHds);
  };

  // Xử lý khi quét xong mã QR
  const handleScanQRSuccess = (data: any) => {
    setModalQRVisible(false);
    try {
      // Kiểm tra dữ liệu QR
      if (!data || !data.maSp) {
        showToast('Mã QR không chứa thông tin sản phẩm hợp lệ', 'error');
        return;
      }
      // Tìm sản phẩm trong danh sách sản phẩm
      const found = (dataSp ?? []).find((sp: sanPham) => sp.maSp === data.maSp);
      if (found) {
        handelSelectSp(found);
      } else {
        showToast('Sản phẩm không tồn tại trong danh sách hiện tại', 'error');
      }
    } catch (error) {
      showToast('Lỗi khi xử lý mã QR', 'error');
    }
  };

  return (
    <View style={styles.container}>
      <WrapHeader title={route.params.tenBan} handleBack={() => nav.goBack()} />
      <View
        style={{
          position: 'absolute',
          top: 0,
          right: 0,
          zIndex: 1,
          marginTop: 6,
        }}>
        <IconButton
          icon="qrcode-scan"
          iconColor="white"
          size={28}
          onPress={() => setModalQRVisible(true)}
        />
      </View>

      <DanhMucSp
        data={dataDanhMucSp ?? []}
        select={select}
        setSelect={setSelect}
      />
      <Loading loading={loadingSp}>
        <ListSanPham dataSp={dataSp ?? []} handelSelectSp={handelSelectSp} />
      </Loading>
      <BottomDonHang
        onPressCart={() => setVisibleGioHang(true)}
        onPressViewOrder={() => nav.navigate('ThanhToan', {idDonHang: mahd})}
      />
      <ModalGoiMon
        visible={visible}
        hideModal={hideModal}
        maHoaDon={mahd}
        maBan={maBan}
        sp={itemSp}
        handleMahd={maHds => onHandeleMahd(maHds)}
      />
      <ModalGioHang
        onReloadGioHang={() => loadCthd({maHd: maHoaDon})}
        visible={visibleGioHang}
        hideModal={hideModalGioHang}
        gioHang={gioHang ?? []}
      />

      {/* Modal QR */}
      <Portal>
        <Modal
          visible={modalQRVisible}
          onDismiss={() => setModalQRVisible(false)}
          contentContainerStyle={{flex: 1, backgroundColor: 'black'}}>
          <QuetMaQR onScanSuccess={handleScanQRSuccess} />
          <IconButton
            icon="close"
            iconColor="#fff"
            size={32}
            style={{
              position: 'absolute',
              top: 40,
              right: 20,
              backgroundColor: '#0008',
            }}
            onPress={() => setModalQRVisible(false)}
          />
        </Modal>
      </Portal>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
  },
});

export default GoiMon;
