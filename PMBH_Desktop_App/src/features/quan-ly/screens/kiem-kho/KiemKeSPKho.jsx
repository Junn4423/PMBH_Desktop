/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react-native/no-inline-styles */
import React, {useState, useCallback} from 'react';
import {StyleSheet, View, FlatList, Alert} from 'react-native';
import {
  Appbar,
  Surface,
  Text,
  Card,
  Chip,
  Button,
  Searchbar,
  Portal,
  Modal,
  TextInput,
  Title,
  Paragraph,
  Divider,
} from 'react-native-paper';
import {
  useFocusEffect,
  useNavigation,
  useRoute,
  type RouteProp,
} from '@react-navigation/native';
import {
  layDanhSachPhieuKiemKho,
  taoPhieuKiemKho as taoPhieuKiemKhoAPI,
} from '../../api/index';
import {phieuKiemKho} from '../../types/index';
import theme from '../../../../theme';

type DanhSachSPRouteParams = {
  maKho: string;
  tenKho: string;
};

const KiemKeSPKho = () => {
  const navigation = useNavigation();
  const [modalSanPhamVisible, setModalSanPhamVisible] = useState(false);
  const route =
    useRoute<RouteProp<Record<string, DanhSachSPRouteParams>, string>>();
  const {maKho, tenKho} = route.params || {};
  console.log('Kho ID:', maKho);

  const [tuKhoa, setTuKhoa] = useState<string>('');
  const [danhSachPhieuKiem, setDanhSachPhieuKiem] = useState<phieuKiemKho[]>(
    [],
  );

  const [maKhoInput, setMaKhoInput] = useState(maKho || '');
  const [maNhanVienInput, setMaNhanVienInput] = useState('');
  const [chuDeInput, setChuDeInput] = useState('');
  const [ghiNhanInput, setGhiNhanInput] = useState('');
  const [isLoading, setIsLoading] = useState(false);

  // Lấy danh sách phiếu kiểm kho khi component được mount
  const fetchData = async () => {
    console.log('Kho ID:', maKho);
    try {
      const phieuKiemdata = await layDanhSachPhieuKiemKho(maKho);
      setDanhSachPhieuKiem(phieuKiemdata);
    } catch (error) {
      console.error('Lỗi khi lấy dữ liệu:', error);
    }
  };

  // Gọi lại API mỗi khi màn hình được focus
  useFocusEffect(
    useCallback(() => {
      fetchData();
    }, []),
  );

  // Lọc danh sách phiếu kiểm theo từ khóa tìm kiếm
  const danhSachPhieuKiemLoc = danhSachPhieuKiem.filter(phieu => {
    // Kiểm tra xem các thuộc tính có tồn tại không trước khi gọi toLowerCase()
    const maKho = phieu.maKho ? phieu.maKho.toLowerCase() : '';
    const maKiemKho = phieu.maKiemKho ? phieu.maKiemKho.toLowerCase() : '';
    const tuKhoaLowerCase = tuKhoa.toLowerCase();

    return (
      maKho.includes(tuKhoaLowerCase) || maKiemKho.includes(tuKhoaLowerCase)
    );
  });

  // Quay lại màn hình danh sách kho
  const quayLai = (): void => {
    navigation.goBack();
  };

  // Xem chi tiết phiếu kiểm kho
  const xemChiTietPhieuKiem = (phieu: phieuKiemKho) => {
    // @ts-ignore
    navigation.navigate('ChiTietPhieuKiem', {
      maKiemKho: phieu.maKiemKho,
      tenKho: tenKho,
    });
  };

  // Hiển thị một phiếu kiểm kho trong danh sách
  const hienThiPhieuKiemKho = ({item}: {item: phieuKiemKho}) => (
    <Card
      style={styles.itemPhieuKiem}
      onPress={() => xemChiTietPhieuKiem(item)}>
      <Card.Content>
        <View style={styles.headerItem}>
          <Title style={styles.maPhieuKiem}>{item.maKiemKho}</Title>
          <Chip
            mode="outlined"
            style={{
              backgroundColor: item.trangThai === '0' ? '#E3F2FD' : '#E8F5E9',
              borderColor: item.trangThai === '0' ? '#2196F3' : '#4CAF50',
            }}
            textStyle={{
              color: item.trangThai === '0' ? '#2196F3' : '#4CAF50',
              fontWeight: 'bold',
            }}>
            {item.trangThai === '0' ? 'Chưa hoàn thành' : 'Hoàn thành'}
          </Chip>
        </View>
        <Divider style={styles.divider} />
        <Paragraph style={styles.tenKhoPhieu}>Kho: {item.maKho}</Paragraph>
        <Paragraph style={styles.ngayKiem}>
          Ngày kiểm: {item.ngayKiem}
        </Paragraph>
        {item.chuDe && (
          <Paragraph style={styles.chuDe}>Chủ đề: {item.chuDe}</Paragraph>
        )}
      </Card.Content>
    </Card>
  );

  // Hiển thị modal tạo phiếu kiểm kho mới
  const hienThiModalTaoPhieu = (): void => {
    setMaKhoInput(maKho || '');
    setMaNhanVienInput('');
    setChuDeInput('');
    setGhiNhanInput('');
    setModalSanPhamVisible(true);
  };

  // Tạo phiếu kiểm kho mới
  const taoPhieuKiemKho = async (): Promise<void> => {
    if (!maKhoInput) {
      Alert.alert('Lỗi', 'Vui lòng nhập mã kho');
      return;
    }

    if (!maNhanVienInput) {
      Alert.alert('Lỗi', 'Vui lòng nhập mã nhân viên');
      return;
    }

    try {
      setIsLoading(true);
      await taoPhieuKiemKhoAPI({
        maKho: maKhoInput,
        maNhanVien: maNhanVienInput,
        chuDe: chuDeInput,
        ghiNhan: ghiNhanInput,
        trangThai: '0',
      });

      fetchData();
      setModalSanPhamVisible(false);
      Alert.alert('Thành công', 'Đã tạo phiếu kiểm kho thành công');
    } catch (error) {
      console.error('Lỗi khi tạo phiếu kiểm kho:', error);
      Alert.alert('Lỗi', 'Không thể tạo phiếu kiểm kho. Vui lòng thử lại sau.');
    } finally {
      setIsLoading(false);
    }
  };

  const getPhieuKiemKey = (item: phieuKiemKho, index: number) => {
    return item.maKiemKho ? item.maKiemKho : `phieu-${index}`;
  };

  const ngayHienTai = new Date().toLocaleDateString('vi-VN');

  return (
    <Surface style={styles.container}>
      <Appbar.Header style={styles.header}>
        <Appbar.BackAction onPress={quayLai} color="white" />
        <Appbar.Content
          title="Phiếu kiểm kho"
          titleStyle={styles.headerTitle}
        />
      </Appbar.Header>

      <Card style={styles.infoContainer}>
        <Card.Content>
          <Title style={styles.tenKho}>{tenKho || 'Tất cả kho'}</Title>
          <View style={styles.infoRow}>
            <Text style={styles.soLuongPhieu}>
              Tổng số phiếu: {danhSachPhieuKiem.length}
            </Text>
            <Button
              mode="contained"
              onPress={hienThiModalTaoPhieu}
              icon="plus"
              style={styles.btnAddPhieu}>
              Tạo phiếu kiểm kho
            </Button>
          </View>
        </Card.Content>
      </Card>

      <Searchbar
        placeholder="Tìm kiếm theo mã phiếu hoặc mã kho..."
        onChangeText={setTuKhoa}
        value={tuKhoa}
        style={styles.searchBar}
        iconColor={theme.colors.primary}
      />

      {danhSachPhieuKiemLoc.length > 0 ? (
        <FlatList
          data={danhSachPhieuKiemLoc}
          renderItem={hienThiPhieuKiemKho}
          keyExtractor={getPhieuKiemKey}
          style={styles.listContainer}
          contentContainerStyle={styles.listContentContainer}
        />
      ) : (
        <View style={styles.noData}>
          <Text style={styles.textNoData}>
            {danhSachPhieuKiem.length === 0
              ? 'Không có phiếu kiểm kho nào'
              : 'Không tìm thấy phiếu kiểm kho phù hợp'}
          </Text>
        </View>
      )}

      {/* Modal tạo phiếu kiểm kho mới */}
      <Portal>
        <Modal
          visible={modalSanPhamVisible}
          onDismiss={() => setModalSanPhamVisible(false)}
          contentContainerStyle={styles.modalContent}>
          <Title style={styles.modalTitle}>Tạo phiếu kiểm kho mới</Title>

          <TextInput
            label="Kho"
            value={maKhoInput}
            onChangeText={setMaKhoInput}
            style={styles.modalInput}
            disabled={true}
            mode="outlined"
          />

          <TextInput
            label="Nhân viên"
            value={maNhanVienInput}
            onChangeText={setMaNhanVienInput}
            style={styles.modalInput}
            mode="outlined"
            placeholder="Nhập mã nhân viên"
          />

          <TextInput
            label="Chủ đề"
            value={chuDeInput}
            onChangeText={setChuDeInput}
            style={styles.modalInput}
            mode="outlined"
            placeholder="Nhập chủ đề kiểm kho"
          />

          <TextInput
            label="Ngày kiểm"
            value={ngayHienTai}
            style={styles.modalInput}
            mode="outlined"
            disabled={true}
          />

          <TextInput
            label="Ghi nhận"
            value={ghiNhanInput}
            onChangeText={setGhiNhanInput}
            style={styles.modalInput}
            mode="outlined"
            placeholder="Nhập ghi nhận (nếu có)"
            multiline
            numberOfLines={3}
          />

          <View style={styles.modalButtonGroup}>
            <Button
              mode="outlined"
              onPress={() => setModalSanPhamVisible(false)}
              style={styles.modalButton}
              disabled={isLoading}>
              Hủy
            </Button>
            <Button
              mode="contained"
              onPress={taoPhieuKiemKho}
              style={styles.modalButton}
              loading={isLoading}
              disabled={isLoading}>
              {isLoading ? 'Đang xử lý...' : 'Tạo phiếu'}
            </Button>
          </View>
        </Modal>
      </Portal>
    </Surface>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  header: {
    backgroundColor: theme.colors.primary,
    elevation: 4,
  },
  headerTitle: {
    color: 'white',
    fontWeight: 'bold',
  },
  infoContainer: {
    margin: 16,
    marginBottom: 8,
    elevation: 2,
  },
  infoRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginTop: 8,
  },
  tenKho: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 8,
  },
  soLuongPhieu: {
    fontSize: 14,
    color: '#757575',
    fontWeight: '500',
  },
  searchBar: {
    marginHorizontal: 16,
    marginBottom: 16,
    elevation: 2,
  },
  listContainer: {
    flex: 1,
  },
  listContentContainer: {
    padding: 12,
  },
  itemPhieuKiem: {
    marginBottom: 12,
    borderLeftWidth: 4,
    borderLeftColor: theme.colors.primary,
    elevation: 2,
  },
  headerItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 8,
  },
  maPhieuKiem: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#333',
  },
  divider: {
    marginVertical: 8,
  },
  tenKhoPhieu: {
    fontSize: 15,
    marginBottom: 6,
    color: '#424242',
  },
  ngayKiem: {
    fontSize: 14,
    color: '#757575',
    marginBottom: 6,
  },
  chuDe: {
    fontSize: 14,
    color: '#757575',
    fontStyle: 'italic',
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
  btnAddPhieu: {
    backgroundColor: theme.colors.primary,
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    margin: 20,
    borderRadius: 12,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: theme.colors.primary,
  },
  modalInput: {
    marginBottom: 16,
    backgroundColor: 'white',
  },
  modalButtonGroup: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 20,
  },
  modalButton: {
    flex: 1,
    marginHorizontal: 5,
  },
});

export default KiemKeSPKho;
