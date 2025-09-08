/* eslint-disable @typescript-eslint/no-unused-vars */
import React, {useRef} from 'react';
import {
  View,
  StyleSheet,
  ScrollView,
  KeyboardAvoidingView,
  Platform,
  Dimensions,
} from 'react-native';
import {
  Appbar,
  TextInput,
  Button,
  Text,
  Checkbox,
  Snackbar,
  Menu,
  TouchableRipple,
  HelperText,
  Portal,
} from 'react-native-paper';
import {loaiNguyenLieu} from '../../types';

type MaterialFormProps = {
  maSanPham: string;
  setMaSanPham: (v: string) => void;
  tenSanPham: string;
  setTenSanPham: (v: string) => void;
  maLoai: string;
  setMaLoai: (v: string) => void;
  tenLoai: string;
  setTenLoai: (v: string) => void;
  maDonVi: string;
  setMaDonVi: (v: string) => void;
  donViTinhQuyDoi: string;
  setDonViTinhQuyDoi: (v: string) => void;
  giaTriQuyDoi: string;
  setGiaTriQuyDoi: (v: string) => void;
  gia: string;
  setGia: (v: string) => void;
  donViGia: string;
  setDonViGia: (v: string) => void;
  maKho: string;
  setMaKho: (v: string) => void;
  trangThai: number;
  setTrangThai: (v: number) => void;
  error: string;
  loading: boolean;
  handleAddMaterial: () => void;
  categories: loaiNguyenLieu[];
  openCategoryMenu: () => void;
  categoryMenuVisible: boolean;
  menuPosition: {x: number; y: number};
  setCategoryMenuVisible: (v: boolean) => void;
  selectCategory: (category: loaiNguyenLieu) => void;
  categoryInputRef: React.RefObject<View>;
  snackbarVisible: boolean;
  snackbarMessage: string;
  setSnackbarVisible: (v: boolean) => void;
};

const MaterialForm: React.FC<MaterialFormProps> = ({
  maSanPham,
  setMaSanPham,
  tenSanPham,
  setTenSanPham,
  maLoai,
  setMaLoai,
  tenLoai,
  setTenLoai,
  maDonVi,
  setMaDonVi,
  donViTinhQuyDoi,
  setDonViTinhQuyDoi,
  giaTriQuyDoi,
  setGiaTriQuyDoi,
  gia,
  setGia,
  donViGia,
  setDonViGia,
  maKho,
  setMaKho,
  trangThai,
  setTrangThai,
  error,
  loading,
  handleAddMaterial,
  categories,
  openCategoryMenu,
  categoryMenuVisible,
  menuPosition,
  setCategoryMenuVisible,
  selectCategory,
  categoryInputRef,
  snackbarVisible,
  snackbarMessage,
  setSnackbarVisible,
}) => {
  return (
    <>
      <ScrollView style={styles.content}>
        {/* Form thêm nguyên liệu */}
        <View style={styles.formContainer}>
          {/* Mã nguyên liệu */}
          <TextInput
            label="Mã nguyên liệu *"
            value={maSanPham}
            onChangeText={setMaSanPham}
            mode="outlined"
            style={styles.input}
          />

          {/* Tên nguyên liệu */}
          <TextInput
            label="Tên nguyên liệu *"
            value={tenSanPham}
            onChangeText={setTenSanPham}
            mode="outlined"
            style={styles.input}
          />

          {/* Loại nguyên liệu */}
          <View
            style={styles.parentCategoryContainer}
            ref={categoryInputRef}
            collapsable={false}>
            <TouchableRipple onPress={openCategoryMenu}>
              <TextInput
                label="Loại nguyên liệu *"
                value={
                  maLoai ? `${maLoai}${tenLoai ? ` - ${tenLoai}` : ''}` : ''
                }
                mode="outlined"
                style={styles.input}
                editable={false}
                right={
                  <TextInput.Icon icon="menu-down" onPress={openCategoryMenu} />
                }
              />
            </TouchableRipple>
          </View>

          {/* Đơn vị tính */}
          <TextInput
            label="Đơn vị tính *"
            value={maDonVi}
            onChangeText={setMaDonVi}
            mode="outlined"
            style={styles.input}
          />

          {/* Đơn vị tính quy đổi */}
          <TextInput
            label="Đơn vị tính quy đổi"
            value={donViTinhQuyDoi}
            onChangeText={setDonViTinhQuyDoi}
            mode="outlined"
            style={styles.input}
          />

          {/* Giá trị quy đổi */}
          <TextInput
            label="Giá trị quy đổi"
            value={giaTriQuyDoi}
            onChangeText={setGiaTriQuyDoi}
            mode="outlined"
            style={styles.input}
            keyboardType="numeric"
          />

          {/* Giá */}
          <TextInput
            label="Giá *"
            value={gia}
            onChangeText={setGia}
            mode="outlined"
            style={styles.input}
            keyboardType="numeric"
          />

          {/* Đơn vị giá */}
          <TextInput
            label="Đơn vị giá *"
            value={donViGia}
            onChangeText={setDonViGia}
            mode="outlined"
            style={styles.input}
          />

          {/* Mã kho */}
          <TextInput
            label="Mã kho *"
            value={maKho}
            onChangeText={setMaKho}
            mode="outlined"
            style={styles.input}
          />

          {/* Trạng thái */}
          <View style={styles.checkboxContainer}>
            <Text>Trạng thái:</Text>
            <View style={styles.checkboxRow}>
              <Checkbox
                status={trangThai === 1 ? 'checked' : 'unchecked'}
                onPress={() => setTrangThai(1)}
              />
              <Text style={styles.checkboxLabel}>Hoạt động</Text>
            </View>
            <View style={styles.checkboxRow}>
              <Checkbox
                status={trangThai === 0 ? 'checked' : 'unchecked'}
                onPress={() => setTrangThai(0)}
              />
              <Text style={styles.checkboxLabel}>Không hoạt động</Text>
            </View>
          </View>

          {/* Hiển thị lỗi nếu có */}
          {error ? (
            <HelperText type="error" visible={!!error}>
              {error}
            </HelperText>
          ) : null}

          {/* Nút thêm nguyên liệu */}
          <Button
            mode="contained"
            onPress={handleAddMaterial}
            loading={loading}
            style={styles.submitButton}
            disabled={loading}>
            Thêm nguyên liệu
          </Button>
        </View>
      </ScrollView>

      {/* Menu chọn loại nguyên liệu */}
      <Portal>
        <Menu
          visible={categoryMenuVisible}
          onDismiss={() => setCategoryMenuVisible(false)}
          anchor={menuPosition}
          contentStyle={[styles.parentCategoryMenu]}>
          {categories.length > 0 ? (
            <ScrollView style={{maxHeight: 300}}>
              {categories.map(category => (
                <Menu.Item
                  key={category.id}
                  onPress={() => selectCategory(category)}
                  title={`${category.id} - ${category.tenLoai}`}
                  style={styles.menuItem}
                />
              ))}
            </ScrollView>
          ) : (
            <Menu.Item title="Không có loại nguyên liệu" disabled={true} />
          )}
        </Menu>
      </Portal>

      {/* Thông báo snackbar */}
      <Snackbar
        visible={snackbarVisible}
        onDismiss={() => setSnackbarVisible(false)}
        duration={3000}>
        {snackbarMessage}
      </Snackbar>
    </>
  );
};

const styles = StyleSheet.create({
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
  parentCategoryMenu: {
    marginTop: 0,
  },
  menuItem: {
    paddingVertical: 10,
  },
});

export default MaterialForm;
