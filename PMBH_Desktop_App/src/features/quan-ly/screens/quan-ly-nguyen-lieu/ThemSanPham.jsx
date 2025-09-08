/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react-native/no-inline-styles */
/* eslint-disable @typescript-eslint/no-shadow */
import React, {useState, useEffect, useRef} from 'react';
import {
  View,
  StyleSheet,
  ScrollView,
  KeyboardAvoidingView,
  Dimensions,
} from 'react-native';
import {
  Appbar,
  TextInput,
  Button,
  Snackbar,
  Menu,
  TouchableRipple,
  HelperText,
  Portal,
} from 'react-native-paper';
import {useNavigation, useRoute} from '@react-navigation/native';
import {
  layAll_LoaiNVL,
  themNguyenLieu,
  loadKho,
  themSanPham,
  layAllDanhMucSP,
} from '../../api/index';
import {kho, loaiNguyenLieu} from '../../types';

const ThemSanPham = () => {
  const navigation = useNavigation<any>(); // Đối tượng điều hướng
  const thamSoDuongDan = useRoute(); // Thông tin tham số đường dẫn

  // State cho form thêm nguyên liệu
  const [maNguyenLieu, setMaNguyenLieu] = useState(''); // Mã nguyên liệu
  const [tenNguyenLieu, setTenNguyenLieu] = useState(''); // Tên nguyên liệu
  const [maDonVi, setMaDonVi] = useState(''); // Mã đơn vị tính
  const [donViQuyDoi, setDonViQuyDoi] = useState(''); // Đơn vị tính quy đổi
  const [giaTriQuyDoi, setGiaTriQuyDoi] = useState('0'); // Giá trị quy đổi
  const [gia, setGia] = useState('0'); // Giá nguyên liệu
  const [donViGia, setDonViGia] = useState('VND'); // Đơn vị giá
  const [maKho, setMaKho] = useState(''); // Mã kho
  const [tenKho, setTenKho] = useState(''); // Tên kho
  const [trangThai, setTrangThai] = useState(1);

  // State cho danh sách loại nguyên liệu và kho
  const [dsLoaiNguyenLieu, setDSLoaiNguyenLieu] = useState<loaiNguyenLieu[]>(
    [],
  ); // Danh sách loại nguyên liệu
  const [dsKho, setDSKho] = useState<kho[]>([]); // Danh sách kho
  const [hienMenuLoai, setHienMenuLoai] = useState(false); // Hiển thị menu loại nguyên liệu
  const [hienMenuKho, setHienMenuKho] = useState(false); // Hiển thị menu kho
  const [viTriMenuLoai, setViTriMenuLoai] = useState({x: 0, y: 0}); // Vị trí hiển thị menu loại nguyên liệu
  const [viTriMenuKho, setViTriMenuKho] = useState({x: 0, y: 0}); // Vị trí hiển thị menu kho

  // State cho giao diện
  const [dangTai, setDangTai] = useState(false); // Trạng thái đang tải
  const [hienThongBao, setHienThongBao] = useState(false); // Hiển thị thông báo
  const [noiDungThongBao, setNoiDungThongBao] = useState(''); // Nội dung thông báo
  const [loi, setLoi] = useState(''); // Thông báo lỗi
  const [maLoai, setMaLoai] = useState(''); // Mã loại nguyên liệu
  const [tenLoai, setTenLoai] = useState(''); // Tên loại nguyên liệu
  // Tham chiếu đến ô input
  const oNhapLoaiRef = useRef(null); // Tham chiếu ô nhập loại nguyên liệu
  const oNhapKhoRef = useRef(null); // Tham chiếu ô nhập kho

  // Lấy dữ liệu khi component được tạo
  useEffect(() => {
    layDSLoaiNguyenLieu();
    layDSKho();
  }, []);

  // Hàm lấy danh sách loại nguyên liệu
  const layDSLoaiNguyenLieu = async () => {
    try {
      setDangTai(true);
      const duLieuSanPham = await layAllDanhMucSP<any[]>();
      const sanPhamData = Object.values(duLieuSanPham);
      setDSLoaiNguyenLieu(sanPhamData.flat());
    } catch (error) {
      console.error('Lỗi khi lấy danh sách loại nguyên liệu:', error);
      setLoi('Không thể tải danh sách loại nguyên liệu');
    } finally {
      setDangTai(false);
    }
  };

  // Hàm lấy danh sách kho và đặt kho mặc định
  const layDSKho = async () => {
    try {
      const duLieu = await loadKho();
      const dsKhoDuLieu = Object.values(duLieu);
      setDSKho(dsKhoDuLieu);
      setMaKho(dsKho[0].maKho);
      setTenKho(dsKho[0].tenKho);
    } catch (error) {}
  };

  // Mở menu chọn loại nguyên liệu
  const moMenuLoai = () => {
    if (oNhapLoaiRef.current) {
      // @ts-ignore
      oNhapLoaiRef.current.measure((x, y, width, height, pageX, pageY) => {
        setViTriMenuLoai({x: pageX, y: pageY + height});
        setHienMenuLoai(true);
      });
    } else {
      setHienMenuLoai(true);
    }
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

  // Chọn loại nguyên liệu
  const chonLoai = (maLoai: string, tenLoai: string) => {
    navigation.setParams({maLoai, tenLoai});
    setHienMenuLoai(false);
  };

  // Chọn kho
  const chonKho = (maKho: string, tenKho: string) => {
    setMaKho(maKho);
    setTenKho(tenKho);
    setHienMenuKho(false);
  };

  // Hiển thị thông báo
  const hienThongBaoSnack = (noiDung: string) => {
    setNoiDungThongBao(noiDung);
    setHienThongBao(true);
  };

  // Kiểm tra form hợp lệ
  const kiemTraForm = () => {
    if (!maNguyenLieu) {
      setLoi('Vui lòng nhập mã nguyên liệu');
      return false;
    }
    if (!maLoai) {
      setLoi('Vui lòng chọn loại nguyên liệu');
      return false;
    }
    if (!tenNguyenLieu) {
      setLoi('Vui lòng nhập tên nguyên liệu');
      return false;
    }
    if (!maDonVi) {
      setLoi('Vui lòng nhập đơn vị tính');
      return false;
    }
    if (!gia) {
      setLoi('Vui lòng nhập giá');
      return false;
    }
    if (!maKho) {
      setLoi('Vui lòng chọn mã kho');
      return false;
    }
    return true;
  };

  // Xử lý thêm nguyên liệu
  const xuLyThemNguyenLieu = async () => {
    if (!kiemTraForm()) {
      return;
    }

    try {
      setDangTai(true);
      setLoi('');

      const giaSo = parseFloat(gia);
      const giaTriQuyDoiSo = giaTriQuyDoi ? parseFloat(giaTriQuyDoi) : 0;

      await themSanPham({
        maSanPham: maNguyenLieu,
        tenSanPham: tenNguyenLieu,
        maLoai,
        maDonVi,
        donViTinhQuyDoi: donViQuyDoi,
        giaTriQuyDoi: giaTriQuyDoiSo,
        gia: giaSo,
        donViGia,
        trangThai_HienThiSP: 1,
        maKho,
      });

      hienThongBaoSnack('Thêm nguyên liệu thành công');
      xoaForm();

      setTimeout(() => {
        navigation.goBack();
      }, 2000);
    } catch (error) {
      console.error('Lỗi khi thêm nguyên liệu:', error);
      setLoi('Không thể thêm nguyên liệu. Vui lòng thử lại sau.');
    } finally {
      setDangTai(false);
    }
  };

  // Xóa form
  const xoaForm = () => {
    setMaNguyenLieu('');
    setTenNguyenLieu('');
    setMaDonVi('');
    setDonViQuyDoi('');
    setGiaTriQuyDoi('0');
    setGia('0');
    setDonViGia('VND');
    setMaKho('KHOTONG');
    setTenKho('KHO TỔNG');
    setTrangThai(1);
    setLoi('');
  };

  const chieuRongManHinh = Dimensions.get('window').width; // Chiều rộng màn hình

  return (
    <KeyboardAvoidingView style={styles.container}>
      {/* Thanh tiêu đề */}
      <Appbar.Header>
        <Appbar.BackAction onPress={() => navigation.goBack()} />
        <Appbar.Content title="Thêm sản phẩm mới" />
      </Appbar.Header>

      <ScrollView style={styles.content}>
        <View style={styles.formContainer}>
          {/* Ô nhập mã nguyên liệu */}
          <TextInput
            label="Mã sản phẩm *"
            value={maNguyenLieu}
            onChangeText={setMaNguyenLieu}
            mode="outlined"
            style={styles.input}
          />
          {/* Ô nhập tên nguyên liệu */}
          <TextInput
            label="Tên sản phẩm *"
            value={tenNguyenLieu}
            onChangeText={setTenNguyenLieu}
            mode="outlined"
            style={styles.input}
          />
          {/* Ô chọn loại nguyên liệu */}
          <View
            style={styles.parentCategoryContainer}
            ref={oNhapLoaiRef}
            collapsable={false}>
            <TouchableRipple onPress={moMenuLoai}>
              <TextInput
                label="Loại nguyên liệu *"
                value={
                  maLoai ? `${maLoai}${tenLoai ? ` - ${tenLoai}` : ''}` : ''
                }
                mode="outlined"
                style={styles.input}
                editable={false}
                right={<TextInput.Icon icon="menu-down" onPress={moMenuLoai} />}
              />
            </TouchableRipple>
          </View>
          {/* Ô nhập đơn vị tính */}
          <TextInput
            label="Đơn vị tính *"
            value={maDonVi}
            onChangeText={setMaDonVi}
            mode="outlined"
            style={styles.input}
          />
          {/* Ô nhập đơn vị quy đổi */}
          <TextInput
            label="Đơn vị tính quy đổi"
            value={donViQuyDoi}
            onChangeText={setDonViQuyDoi}
            mode="outlined"
            style={styles.input}
          />
          {/* Ô nhập giá trị quy đổi */}
          <TextInput
            label="Giá trị quy đổi"
            value={giaTriQuyDoi}
            onChangeText={setGiaTriQuyDoi}
            mode="outlined"
            style={styles.input}
            keyboardType="numeric"
          />
          {/* Ô nhập giá */}
          <TextInput
            label="Giá *"
            value={gia}
            onChangeText={setGia}
            mode="outlined"
            style={styles.input}
            keyboardType="numeric"
          />
          {/* Ô nhập đơn vị giá */}
          <TextInput
            label="Đơn vị giá *"
            value={donViGia}
            onChangeText={setDonViGia}
            mode="outlined"
            style={styles.input}
          />
          {/* Ô chọn mã kho */}
          <View
            style={styles.parentCategoryContainer}
            ref={oNhapKhoRef}
            collapsable={false}>
            <TouchableRipple onPress={moMenuKho}>
              <TextInput
                label="Mã kho *"
                value={maKho ? `${maKho}${tenKho ? ` - ${tenKho}` : ''}` : ''}
                mode="outlined"
                style={styles.input}
                editable={false}
                right={<TextInput.Icon icon="menu-down" onPress={moMenuKho} />}
              />
            </TouchableRipple>
          </View>

          {/* Hiển thị lỗi nếu có */}
          {loi ? (
            <HelperText type="error" visible={!!loi}>
              {loi}
            </HelperText>
          ) : null}
          {/* Nút thêm nguyên liệu */}
          <Button
            mode="contained"
            onPress={xuLyThemNguyenLieu}
            loading={dangTai}
            style={styles.submitButton}
            disabled={dangTai}>
            Thêm sản phẩm
          </Button>
        </View>
      </ScrollView>

      {/* Menu chọn loại nguyên liệu */}
      <Portal>
        <Menu
          visible={hienMenuLoai}
          onDismiss={() => setHienMenuLoai(false)}
          anchor={viTriMenuLoai}
          contentStyle={{maxHeight: 300, width: chieuRongManHinh - 32}}>
          <ScrollView>
            {dsLoaiNguyenLieu.map(loai => (
              <Menu.Item
                key={loai.id}
                onPress={() => chonLoai(loai.id, loai.tenLoai)}
                title={`${loai.id} - ${loai.tenLoai}`}
                style={styles.menuItem}
              />
            ))}
          </ScrollView>
        </Menu>
        {/* Menu chọn kho */}
        <Menu
          visible={hienMenuKho}
          onDismiss={() => setHienMenuKho(false)}
          anchor={viTriMenuKho}
          contentStyle={{maxHeight: 300, width: chieuRongManHinh - 32}}>
          <ScrollView>
            {dsKho.map(kho => (
              <Menu.Item
                key={kho.maKho}
                onPress={() => chonKho(kho.maKho, kho.tenKho)}
                title={`${kho.maKho} - ${kho.tenKho}`}
                style={styles.menuItem}
              />
            ))}
          </ScrollView>
        </Menu>
      </Portal>

      {/* Thông báo snackbar */}
      <Snackbar
        visible={hienThongBao}
        onDismiss={() => setHienThongBao(false)}
        duration={3000}>
        {noiDungThongBao}
      </Snackbar>
    </KeyboardAvoidingView>
  );
};

// Định nghĩa styles
const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  content: {
    flex: 1,
    padding: 16,
  },
  formContainer: {
    marginBottom: 20,
  },
  input: {
    marginBottom: 12,
  },
  checkboxContainer: {
    marginTop: 8,
    marginBottom: 16,
  },
  checkboxRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginTop: 4,
  },
  checkboxLabel: {
    marginLeft: 8,
  },
  submitButton: {
    marginTop: 16,
    paddingVertical: 8,
    backgroundColor: '#2196F3',
  },
  parentCategoryContainer: {
    position: 'relative',
    marginBottom: 12,
  },
  menuItem: {
    paddingVertical: 10,
  },
});

export default ThemSanPham;
