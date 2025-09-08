/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable @typescript-eslint/no-shadow */

import React, {useState, useEffect, useRef} from 'react';
import {
  View,
  StyleSheet,
  FlatList,
  Platform,
  KeyboardAvoidingView,
  Alert,
} from 'react-native';
import {
  Appbar,
  Button,
  Text,
  Snackbar,
  ActivityIndicator,
  Card,
  TouchableRipple,
  Icon,
  Searchbar,
  Menu,
  TextInput,
} from 'react-native-paper';
import {useNavigation, useRoute} from '@react-navigation/native';
import {
  layDanhSachNVL_TheoLoai,
  xoaNguyenLieu,
  loadKho,
  layAll_LoaiNVL,
} from '../../api/index';
import {kho} from '../../types';

// Định nghĩa kiểu dữ liệu cho nguyên liệu
interface Material {
  idSp: string;
  tenSp: string;
  dvt: string;
  dvtGia: string;
  giaBan: number;
  maKho: string;
}

const DanhSachNguyenLieu = () => {
  const navigation = useNavigation(); // Đối tượng điều hướng
  const thamSoDuongDan = useRoute(); // Tham số đường dẫn
  const {maLoai, tenLoai} = thamSoDuongDan.params as {
    maLoai: string;
    tenLoai: string;
  };

  // State cho danh sách nguyên liệu và kho
  const [dsNguyenLieu, setDSNguyenLieu] = useState<Material[]>([]); // Danh sách nguyên liệu
  const [dsNguyenLieuLoc, setDSNguyenLieuLoc] = useState<Material[]>([]); // Danh sách nguyên liệu đã lọc
  const [dsKho, setDSKho] = useState<kho[]>([]);
  const [dangTai, setDangTai] = useState(false); // Trạng thái đang tải
  const [hienThongBao, setHienThongBao] = useState(false); // Hiển thị thông báo
  const [noiDungThongBao, setNoiDungThongBao] = useState(''); // Nội dung thông báo
  const [loi, setLoi] = useState(''); // Thông báo lỗi
  const [tuKhoaTimKiem, setTuKhoaTimKiem] = useState(''); // Từ khóa tìm kiếm
  const [maKhoLoc, setMaKhoLoc] = useState(''); // Mã kho được chọn để lọc
  const [tenKhoLoc, setTenKhoLoc] = useState('Tất cả kho'); // Tên kho được chọn để hiển thị
  const [hienMenuKho, setHienMenuKho] = useState(false); // Hiển thị menu kho

  // Tham chiếu đến ô chọn kho
  const oNhapKhoRef = useRef(null);

  // Lấy danh sách nguyên liệu khi component được mount hoặc maLoai thay đổi
  useEffect(() => {
    if (maLoai) {
      layDSNguyenLieu();
      layDSKho();
    }
  }, [maLoai]);

  // Lọc danh sách nguyên liệu khi từ khóa tìm kiếm hoặc kho thay đổi
  useEffect(() => {
    let dsLoc = dsNguyenLieu;
    // Lọc theo từ khóa tìm kiếm
    if (tuKhoaTimKiem) {
      dsLoc = dsLoc.filter(
        item =>
          item.tenSp.toLowerCase().includes(tuKhoaTimKiem.toLowerCase()) ||
          item.idSp.toLowerCase().includes(tuKhoaTimKiem.toLowerCase()),
      );
    }

    // Lọc theo kho
    if (maKhoLoc) {
      dsLoc = dsLoc.filter(item => item.maKho === maKhoLoc);
    }

    setDSNguyenLieuLoc(dsLoc);
  }, [tuKhoaTimKiem, maKhoLoc, dsNguyenLieu]);

  // Hàm lấy danh sách nguyên liệu theo loại
  const layDSNguyenLieu = async () => {
    try {
      setDangTai(true);
      setLoi('');
      const duLieuNguyenLieu = await layDanhSachNVL_TheoLoai<any[]>(maLoai);
      setDSNguyenLieu(duLieuNguyenLieu.flat());
      setDSNguyenLieuLoc(duLieuNguyenLieu.flat());
    } catch (error) {
      console.error('Lỗi khi lấy danh sách nguyên liệu:', error);
      setLoi('Không thể tải danh sách nguyên liệu');
      setHienThongBao(true);
    } finally {
      setDangTai(false);
    }
  };
  const layDSKho = async () => {
    try {
      const duLieu = await loadKho();
      const dsKhoDuLieu = Object.values(duLieu);

      if (!Array.isArray(dsKhoDuLieu)) {
        console.error('Dữ liệu không phải mảng:', dsKhoDuLieu);
        setLoi('Dữ liệu kho không hợp lệ');
        setHienThongBao(true);
        return;
      }

      const dsKhoMoi = dsKhoDuLieu.map(item => item as kho);
      // Thêm tùy chọn "Tất cả kho" vào đầu danh sách
      const dsKhoCapNhat: kho[] = [
        {
          maKho: '',
          tenCongTy: '',
          tenKho: 'Tất cả kho',
        } as kho, // Tùy chọn "Tất cả kho"
        ...dsKhoMoi,
      ];

      setDSKho(dsKhoCapNhat);

      // Đặt giá trị mặc định là "Tất cả kho"
      setMaKhoLoc('');
      setTenKhoLoc('Tất cả kho');
    } catch (error) {
      console.error('Lỗi khi lấy danh sách kho:', error);
      setLoi('Không thể tải danh sách kho');
      setHienThongBao(true);
    }
  };
  // Xử lý xóa nguyên liệu
  const xuLyXoaNguyenLieu = (id: string) => {
    Alert.alert(
      'Xác nhận xóa',
      'Bạn có chắc muốn xóa nguyên liệu này?',
      [
        {text: 'Hủy', style: 'cancel'},
        {
          text: 'Xóa',
          style: 'destructive',
          onPress: async () => {
            try {
              setDangTai(true);
              await xoaNguyenLieu(id);
              setDSNguyenLieu(dsNguyenLieu.filter(item => item.idSp !== id));
              setDSNguyenLieuLoc(
                dsNguyenLieuLoc.filter(item => item.idSp !== id),
              );
              setNoiDungThongBao('Xóa nguyên liệu thành công');
              setHienThongBao(true);
            } catch (error) {
              console.error('Lỗi khi xóa nguyên liệu:', error);
              setLoi('Không thể xóa nguyên liệu');
              setHienThongBao(true);
            } finally {
              setDangTai(false);
            }
          },
        },
      ],
      {cancelable: true},
    );
  };

  // Mở menu chọn kho
  const moMenuKho = () => {
    if (oNhapKhoRef.current) {
      // @ts-ignore
      oNhapKhoRef.current.measure((x, y, width, height, pageX, pageY) => {
        setViTriMenuKho({x: pageX, y: pageY + height});
        setHienMenuKho(true);
      });
    } else {
      setHienMenuKho(true);
    }
  };

  // Chọn kho để lọc
  const chonKho = (maKho: string, tenKho: string) => {
    setMaKhoLoc(maKho);
    setTenKhoLoc(tenKho);
    setHienMenuKho(false);
  };

  // State cho vị trí menu kho
  const [viTriMenuKho, setViTriMenuKho] = useState({x: 0, y: 0});

  // Render item nguyên liệu
  const renderNguyenLieu = ({item}: {item: Material}) => (
    <TouchableRipple onPress={() => {}}>
      <Card style={styles.card}>
        <Card.Content style={styles.cardContent}>
          <View style={styles.cardHeader}>
            <View>
              <Text variant="titleMedium" style={styles.cardTitle}>
                {item.tenSp}
              </Text>
              <Text variant="bodyMedium" style={styles.cardSubtitle}>
                Mã: {item.idSp} | Kho: {item.maKho}
              </Text>
              <Text variant="bodySmall" style={styles.cardDetail}>
                Đơn vị: {item.dvt} | Giá: {item.giaBan} {item.dvtGia}
              </Text>
            </View>
            <Button
              icon="delete"
              mode="text"
              onPress={() => xuLyXoaNguyenLieu(item.idSp)}
              textColor="#FF5252"
              style={styles.deleteButton}
              labelStyle={styles.deleteButtonLabel}>
              Xóa
            </Button>
          </View>
        </Card.Content>
      </Card>
    </TouchableRipple>
  );

  return (
    <KeyboardAvoidingView style={styles.container}>
      <Appbar.Header style={styles.appbar}>
        <Appbar.BackAction onPress={() => navigation.goBack()} color="#FFF" />
        <Appbar.Content
          title={`Nguyên liệu: ${tenLoai}`}
          titleStyle={styles.appbarTitle}
        />
        <Appbar.Action
          icon="refresh"
          onPress={() => {
            useEffect;
          }}
          color="#FFF"
        />
        <Appbar.Action
          icon="plus-circle" // Dùng icon khác, vd plus-circle cho nguyên liệu
          onPress={() =>
            //@ts-ignore
            navigation.navigate('ThemNguyenLieu', {
              maLoai: maLoai,
              tenLoai: tenLoai,
            })
          }
          color="#FFF"
          accessibilityLabel="Thêm nguyên liệu"
        />
        <Appbar.Action
          icon="cart-plus" // Dùng icon cart-plus cho sản phẩm (hoặc bất kỳ icon nào hợp lý)
          onPress={() =>
            //@ts-ignore
            navigation.navigate('ThemSanPham')
          }
          color="#FFF"
          accessibilityLabel="Thêm sản phẩm"
        />
      </Appbar.Header>

      <View style={styles.content}>
        {/* Ô tìm kiếm */}
        <Searchbar
          placeholder="Tìm kiếm nguyên liệu"
          onChangeText={setTuKhoaTimKiem}
          value={tuKhoaTimKiem}
          style={styles.searchBar}
          inputStyle={styles.searchInput}
          iconColor="#666"
        />

        {/* Ô lọc theo kho */}
        <View
          style={styles.filterContainer}
          ref={oNhapKhoRef}
          collapsable={false}>
          <TouchableRipple onPress={moMenuKho}>
            <TextInput
              label="Lọc theo kho"
              value={tenKhoLoc}
              mode="outlined"
              style={styles.filterInput}
              editable={false}
              right={<TextInput.Icon icon="menu-down" onPress={moMenuKho} />}
              theme={{colors: {primary: '#2196F3'}}}
            />
          </TouchableRipple>
        </View>
        {/* Danh sách nguyên liệu */}
        {dangTai ? (
          <View style={styles.loadingContainer}>
            <ActivityIndicator size="large" color="#2196F3" />
            <Text style={styles.loadingText}>Đang tải dữ liệu...</Text>
          </View>
        ) : loi ? (
          <View style={styles.errorContainer}>
            <Icon source="alert-circle" size={40} color="#FF5252" />
            <Text style={styles.errorText}>{loi}</Text>
            <Button
              mode="contained"
              onPress={layDSNguyenLieu}
              style={styles.retryButton}
              buttonColor="#2196F3"
              textColor="#FFF">
              Thử lại
            </Button>
          </View>
        ) : (
          <FlatList
            data={dsNguyenLieuLoc}
            renderItem={renderNguyenLieu}
            keyExtractor={item => item.idSp}
            contentContainerStyle={styles.listContainer}
            ListEmptyComponent={
              <View style={styles.emptyContainer}>
                <Icon source="inbox" size={40} color="#666" />
                <Text style={styles.emptyText}>Không có nguyên liệu nào</Text>
              </View>
            }
          />
        )}
      </View>

      {/* Menu chọn kho */}
      <Menu
        visible={hienMenuKho}
        onDismiss={() => setHienMenuKho(false)}
        anchor={viTriMenuKho}
        contentStyle={styles.menuKho}>
        {dsKho.map(kho => (
          <Menu.Item
            key={kho.maKho}
            onPress={() => chonKho(kho.maKho, kho.tenKho)}
            title={kho.tenKho}
            style={styles.menuItem}
          />
        ))}
      </Menu>

      <Snackbar
        visible={hienThongBao}
        onDismiss={() => setHienThongBao(false)}
        duration={3000}
        style={styles.snackbar}
        action={{
          label: 'OK',
          onPress: () => setHienThongBao(false),
        }}>
        {noiDungThongBao}
      </Snackbar>
    </KeyboardAvoidingView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F5F7FA',
  },
  appbar: {
    backgroundColor: '#2196F3',
    elevation: 4,
  },
  appbarTitle: {
    color: '#FFF',
    fontWeight: 'bold',
    fontSize: 20,
  },
  content: {
    flex: 1,
    padding: 16,
  },
  searchBar: {
    marginBottom: 16,
    borderRadius: 8,
    backgroundColor: '#FFF',
    elevation: 2,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 1},
    shadowOpacity: 0.1,
    shadowRadius: 2,
  },
  searchInput: {
    fontSize: 16,
    color: '#333',
  },
  filterContainer: {
    position: 'relative',
    marginBottom: 16,
  },
  filterInput: {
    width: '100%',
    backgroundColor: '#FFF',
  },
  menuKho: {
    backgroundColor: '#FFF',
    borderRadius: 8,
    elevation: 4,
  },
  menuItem: {
    paddingVertical: 12,
    paddingHorizontal: 16,
  },
  addButton: {
    marginBottom: 16,
    paddingVertical: 8,
    borderRadius: 8,
  },
  listContainer: {
    paddingBottom: 16,
  },
  card: {
    marginBottom: 12,
    borderRadius: 12,
    backgroundColor: '#FFF',
    elevation: 3,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 2},
    shadowOpacity: 0.1,
    shadowRadius: 4,
  },
  cardContent: {
    padding: 16,
  },
  cardHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  cardTitle: {
    fontWeight: '600',
    color: '#333',
    fontSize: 18,
  },
  cardSubtitle: {
    color: '#555',
    marginTop: 4,
    fontSize: 14,
  },
  cardDetail: {
    marginTop: 8,
    color: '#777',
    fontSize: 14,
  },
  deleteButton: {
    paddingHorizontal: 8,
  },
  deleteButtonLabel: {
    fontSize: 14,
    fontWeight: '500',
  },
  loadingContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#F5F7FA',
    borderRadius: 12,
    padding: 20,
  },
  loadingText: {
    marginTop: 12,
    fontSize: 16,
    color: '#555',
  },
  errorContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#FFF',
    borderRadius: 12,
    padding: 20,
    elevation: 2,
  },
  errorText: {
    color: '#FF5252',
    fontSize: 16,
    marginVertical: 12,
    textAlign: 'center',
  },
  retryButton: {
    borderRadius: 8,
    paddingVertical: 4,
  },
  emptyContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
    backgroundColor: '#FFF',
    borderRadius: 12,
    elevation: 2,
  },
  emptyText: {
    marginTop: 12,
    fontSize: 16,
    color: '#666',
  },
  snackbar: {
    backgroundColor: '#333',
    borderRadius: 8,
    margin: 16,
    elevation: 4,
  },
});

export default DanhSachNguyenLieu;
