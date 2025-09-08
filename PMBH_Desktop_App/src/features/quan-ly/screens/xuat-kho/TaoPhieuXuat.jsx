/* eslint-disable react-native/no-inline-styles */
/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
import {
  StyleSheet,
  View,
  ScrollView,
  TextInput,
  TouchableOpacity,
  FlatList,
  Alert,
} from 'react-native';
import {Appbar, Modal, Text} from 'react-native-paper';
import theme from '../../../../theme';
import {useEffect, useState} from 'react';
import {
  chiTietPhieuNhap,
  chiTietPhieuXuat,
  kho,
  nguyenLieuKho,
  xuatKho,
} from '../../types';
import {ChonSanPham, RenderKhoItem} from '../../components/nhap-kho';
import useFetchApi from '../../hooks/useFetchApi';
import {loadKho, themPhieuXuatChiTietPX} from '../../api/index';
import {Controller, useForm} from 'react-hook-form';
import {NavigationProp, useNavigation} from '@react-navigation/native';
import {RootStackParamList} from '../../../../types/navigation';
import {useAuthStore} from '../../../auth/store/login.store';

export function TaoPhieuXuat() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();

  const {data: dataKho, refetch} = useFetchApi(loadKho);

  const [vsKho, setVsKho] = useState<boolean>(false);
  const [mdSp, setMdSp] = useState<boolean>(false);
  const [mdSlSp, setMdSlSp] = useState<boolean>(false);
  const [khoSelected, setKhoSelected] = useState<kho | null>(null);
  const [nguyenLieuSelect, setNguyenLieuSelect] =
    useState<nguyenLieuKho | null>(null);

  const hideModeMdSlSp = () => setMdSlSp(false);
  const hideModelSp = () => setMdSp(false);
  const hideModal = () => setVsKho(false);
  const ngayHienTai = new Date().toLocaleDateString('vi-VN');
  const [ctPx, setCtPx] = useState<chiTietPhieuXuat[]>([]);

  useEffect(() => {
    refetch();
  }, []);

  const handleChonKho = (item: kho) => {
    setKhoSelected(item);
    hideModal();
  };
  // Xóa sản phẩm khỏi danh sách
  const xoaSanPham = (index: number): void => {
    setCtPx(prev => prev.filter((_, i) => i !== index));
  };
  const handleNguyenLieu = (item: nguyenLieuKho) => {
    hideModelSp();
    setMdSlSp(true);
    setNguyenLieuSelect(item);
  };

  const handleCtPn = (data: chiTietPhieuXuat) => {
    if (!data) {
      return;
    }

    const soLuong = data.soLuong || 1;
    const gia = data.gia || 0;

    setCtPx(prev => {
      const index = prev.findIndex(sp => sp.maSanPham === data.maSanPham);

      if (index !== -1) {
        // Sản phẩm đã tồn tại -> Cộng dồn số lượng
        const newList = [...prev];
        newList[index].soLuong = (newList[index].soLuong ?? 0) + soLuong;
        newList[index].thanhTien = newList[index].soLuong * gia;
        newList[index].gia = gia;
        return newList;
      }
      return [
        ...prev,
        {
          ...data,
          soLuong: Number(soLuong),
          thanhTien: Number(gia * soLuong),
          gia: Number(gia),
        },
      ];
    });
    hideModeMdSlSp();
  };

  const {
    control,
    handleSubmit,

    formState: {errors},
  } = useForm({
    defaultValues: {
      nguoiNhanKho: '',
      maNguoiDung: '',
      chuDeXuat: '',
      nguonXuatKho: 'XUATKHO',
      maThamChieu: '',
      ghiChu: '',
      ngayHienTai: '',
      hinhThucXuat: '',
      ngayNhapKho: ngayHienTai,
    },
  });
  const {
    control: controlNguyenLieu,
    handleSubmit: handleSubmitNguyenLieu,
    setValue,
  } = useForm({
    defaultValues: {
      tenSp: '',
      maSanPham: '',
      soLuong: 1,
      gia: 0,
      donViTinh: '',
      donViGia: '',
    },
  });
  useEffect(() => {
    if (nguyenLieuSelect?.gia != null) {
      setValue('maSanPham', nguyenLieuSelect.maSp);
      setValue('soLuong', 1);
      setValue('tenSp', nguyenLieuSelect.tenSp);
      setValue('donViTinh', nguyenLieuSelect.maDv);
      setValue('donViGia', nguyenLieuSelect.dvGia);
      setValue('gia', nguyenLieuSelect.gia);
    }
  }, [nguyenLieuSelect, setValue]);

  const {user} = useAuthStore();
  const luuPhieuXuat = async (data: xuatKho) => {
    try {
      if (user) {
        const res = await themPhieuXuatChiTietPX(
          user,
          khoSelected?.maKho ?? '',
          data.maNguoiDung,
          data.chuDe,
          data.nguonXuat,
          data.maThamChieu,
          '0',
          data.ghiChu,
          data.hinhThucXuat,
          data.nguoiNhanKho,
          ctPx,
        );
        if (res) {
          Alert.alert('Thành công', 'Đã lưu phiếu nhập thành công', [
            {text: 'OK', onPress: () => nav.goBack()},
          ]);
        }
      }
    } catch (error) {}
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
          title="Thêm phiếu xuất kho"
        />
      </Appbar.Header>

      <ScrollView style={styles.containerForm}>
        <View style={styles.boderForm}>
          <Text style={styles.headerForm}>Thông tin phiếu xuất mới</Text>

          <View style={styles.groupInput}>
            <Text style={styles.labelInput}>Kho xuất:</Text>
            <TouchableOpacity
              style={styles.selectInput}
              onPress={() => setVsKho(true)}>
              <Text style={styles.selectText}>
                {khoSelected
                  ? `${khoSelected.tenKho} (${khoSelected.maKho})`
                  : 'Chọn kho'}
              </Text>
            </TouchableOpacity>
          </View>

          <Controller
            control={control}
            name="maNguoiDung"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Mã người dùng:</Text>
                <TextInput
                  style={styles.textInput}
                  placeholder="Nhập mã người dùng"
                  value={value}
                  onChangeText={onChange}
                />
              </View>
            )}
          />

          <Controller
            control={control}
            name="chuDeXuat"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Chủ đề xuất kho:</Text>
                <TextInput
                  style={styles.textInput}
                  placeholder="Nhập chủ đề xuất kho"
                  value={value}
                  onChangeText={onChange}
                />
              </View>
            )}
          />

          <Controller
            control={control}
            name="maThamChieu"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Mã tham chiếu:</Text>
                <TextInput
                  style={styles.textInput}
                  placeholder="Nhập mã tham chiếu"
                  value={value}
                  onChangeText={onChange}
                />
              </View>
            )}
          />

          <Controller
            control={control}
            name="nguonXuatKho"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Nguồn xuất kho:</Text>
                <TextInput
                  style={styles.textInput}
                  value={value}
                  editable={false}
                />
              </View>
            )}
          />

          <Controller
            control={control}
            name="hinhThucXuat"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Hình thức xuất:</Text>
                <TextInput
                  style={styles.textInput}
                  placeholder="Nhập hình thức xuất"
                  value={value}
                  onChangeText={onChange}
                />
              </View>
            )}
          />

          <Controller
            control={control}
            name="nguoiNhanKho"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Mã người nhận:</Text>
                <TextInput
                  style={styles.textInput}
                  placeholder="Nhập mã người nhận kho"
                  value={value}
                  onChangeText={onChange}
                />
              </View>
            )}
          />

          <Controller
            control={control}
            name="ghiChu"
            render={({field: {onChange, value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Ghi chú:</Text>
                <TextInput
                  style={[styles.textInput, {height: 80}]}
                  placeholder="Nhập ghi chú"
                  multiline
                  value={value}
                  onChangeText={onChange}
                />
              </View>
            )}
          />
          <Controller
            control={control}
            name="ngayNhapKho"
            render={({field: {value}}) => (
              <View style={styles.groupInput}>
                <Text style={styles.labelInput}>Ngày xuất kho:</Text>
                <View style={styles.inputContainer}>
                  <Text style={styles.valueInput}>{value}</Text>
                </View>
              </View>
            )}
          />
          <View style={styles.groupInput}>
            <Text style={styles.labelInput}>Danh sách nguyên liệu:</Text>
            <TouchableOpacity
              style={styles.btnAddProduct}
              onPress={() => setMdSp(true)}>
              <Text style={styles.textBtnAddProduct}>+ Chọn nguyên liệu</Text>
            </TouchableOpacity>
          </View>

          {ctPx.length > 0 ? (
            <View style={styles.productList}>
              {ctPx.map((chiTiet, index) => (
                <View key={index} style={styles.productItem}>
                  <View style={styles.productHeader}>
                    <Text style={styles.productName}>{chiTiet.tenSp}</Text>
                    <TouchableOpacity onPress={() => xoaSanPham(index)}>
                      <Text style={styles.deleteButton}>Xóa</Text>
                    </TouchableOpacity>
                  </View>
                  <View style={styles.productInfo}>
                    <View style={styles.productInfoRow}>
                      <Text>Mã: {chiTiet.maSanPham}</Text>
                    </View>
                    <View style={styles.productInfoRow}>
                      <Text>SL: {chiTiet.soLuong}</Text>
                      <Text>ĐVT: {chiTiet.donViTinh}</Text>
                    </View>
                    <View style={styles.productInfoRow}>
                      <Text>
                        Đơn giá: {Number(chiTiet.gia).toLocaleString('vi-VN')}{' '}
                        vnđ
                      </Text>
                      <Text>ĐVG: {chiTiet.donViGia}</Text>
                    </View>
                    <Text style={styles.productTotal}>
                      Thành tiền:
                      {Number(chiTiet.thanhTien).toLocaleString('vi-VN')} vnđ
                    </Text>
                  </View>
                </View>
              ))}
            </View>
          ) : (
            <View style={styles.emptyList}>
              <Text style={styles.textEmptyList}>
                Chưa có nguyên liệu nào được thêm vào
              </Text>
            </View>
          )}

          <TouchableOpacity
            style={styles.btnSave}
            onPress={handleSubmit(data => luuPhieuXuat(data as any))}>
            <Text style={styles.textBtnSave}>Lưu phiếu nhập</Text>
          </TouchableOpacity>
        </View>
      </ScrollView>

      <Modal
        visible={vsKho}
        onDismiss={hideModal}
        contentContainerStyle={{
          backgroundColor: 'white',
          padding: 20,
          margin: 20,
          borderRadius: 8,
        }}>
        <FlatList
          data={dataKho}
          renderItem={({item}) => (
            <RenderKhoItem item={item} handleChon={() => handleChonKho(item)} />
          )}
          keyExtractor={item => item.maKho}
          style={styles.modalList}
        />
      </Modal>

      <Modal
        visible={mdSp}
        onDismiss={hideModelSp}
        contentContainerStyle={{
          backgroundColor: 'white',
          padding: 20,
          margin: 20,
          borderRadius: 8,
        }}>
        <ChonSanPham
          handleNguyenLieu={item => handleNguyenLieu(item)}
          maKho={khoSelected?.maKho ?? ''}
        />
      </Modal>
      <Modal
        visible={mdSlSp}
        onDismiss={hideModeMdSlSp}
        contentContainerStyle={{
          backgroundColor: 'white',
          padding: 20,
          margin: 20,
          borderRadius: 8,
        }}>
        <View>
          <Text style={styles.modalTitle}>
            Nhập thông tin cho {nguyenLieuSelect?.tenSp}
          </Text>
          <Controller
            control={controlNguyenLieu}
            name="soLuong"
            rules={{required: 'Số lượng không được để trống'}}
            render={({field: {onChange, value}}) => (
              <View style={styles.formGroup}>
                <View style={styles.groupInput}>
                  <Text style={styles.labelInput}>Số lượng:</Text>
                  <TextInput
                    style={styles.textInput}
                    placeholder="Nhập số lượng"
                    value={String(value)}
                    onChangeText={text => onChange(Number(text))}
                    keyboardType="numeric"
                    autoFocus={true}
                  />
                </View>
              </View>
            )}
          />
          <Controller
            control={controlNguyenLieu}
            name="gia"
            rules={{required: 'Gía không được để trống'}}
            render={({field: {onChange, value}}) => (
              <View style={styles.formGroup}>
                <View style={styles.groupInput}>
                  <Text style={styles.labelInput}>Đơn giá:</Text>
                  <TextInput
                    style={styles.textInput}
                    placeholder="Nhập đơn giá"
                    value={String(value)}
                    onChangeText={text => onChange(Number(text))}
                    keyboardType="numeric"
                  />
                </View>
              </View>
            )}
          />
          <View style={styles.modalButtonRow}>
            <TouchableOpacity
              style={[styles.modalButton, styles.modalCancelButton]}
              onPress={hideModeMdSlSp}>
              <Text style={styles.modalButtonText}>Hủy</Text>
            </TouchableOpacity>

            <TouchableOpacity
              style={[styles.modalButton, styles.modalConfirmButton]}
              onPress={handleSubmitNguyenLieu(data => handleCtPn(data))}>
              <Text style={styles.modalButtonText}>Thêm</Text>
            </TouchableOpacity>
          </View>
        </View>
      </Modal>
    </View>
  );
}

const styles = StyleSheet.create({
  wrap: {
    backgroundColor: theme.colors.primary,
  },
  modalButtonRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 16,
  },
  modalButton: {
    flex: 1,
    borderRadius: 4,
    padding: 10,
    alignItems: 'center',
  },
  modalCancelButton: {
    backgroundColor: '#9e9e9e',
    marginRight: 8,
  },
  modalConfirmButton: {
    backgroundColor: '#4CAF50',
    marginLeft: 8,
  },
  modalButtonText: {
    color: 'white',
    fontWeight: 'bold',
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
  btnBack: {
    color: '#FF9800',
    fontSize: 16,
    fontWeight: 'bold',
  },
  boderForm: {
    backgroundColor: '#ffffff',
    borderRadius: 8,
    padding: 16,
    margin: 16,
    elevation: 2,
    borderLeftWidth: 4,
    borderLeftColor: '#FF9800',
  },
  headerForm: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 16,
    textAlign: 'center',
    color: '#FF9800',
  },
  containerForm: {
    flex: 1,
  },
  groupInput: {
    marginBottom: 16,
  },
  labelInput: {
    fontWeight: 'bold',
    marginBottom: 8,
    fontSize: 16,
    color: '#424242',
  },
  inputContainer: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 12,
    backgroundColor: '#f9f9f9',
  },
  textInput: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 12,
    backgroundColor: '#ffffff',
    fontSize: 16,
  },
  selectInput: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 12,
    backgroundColor: '#ffffff',
    fontSize: 16,
  },
  selectText: {
    fontSize: 16,
  },
  valueInput: {
    fontSize: 16,
    color: '#424242',
  },
  btnAddProduct: {
    backgroundColor: '#FF9800', // Màu cam cho xuất kho
    borderRadius: 4,
    padding: 10,
    alignItems: 'center',
    marginTop: 8,
  },
  textBtnAddProduct: {
    color: 'white',
    fontWeight: 'bold',
  },
  productList: {
    marginVertical: 16,
  },
  productItem: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 12,
    marginBottom: 8,
    backgroundColor: '#ffffff',
  },
  productHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
    paddingBottom: 8,
  },
  productName: {
    fontSize: 16,
    fontWeight: 'bold',
  },
  productCode: {
    color: '#757575',
    fontSize: 14,
  },
  productInfo: {
    marginTop: 4,
  },
  productInfoRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 4,
  },
  productTotal: {
    fontWeight: 'bold',
    color: '#FF9800', // Màu cam cho xuất kho
    marginTop: 4,
    textAlign: 'right',
  },
  emptyList: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 20,
    alignItems: 'center',
    backgroundColor: '#f9f9f9',
    marginVertical: 16,
  },
  textEmptyList: {
    color: '#9e9e9e',
    fontSize: 16,
  },
  summaryRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingVertical: 12,
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  summaryLabel: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#424242',
  },
  summaryValue: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#FF9800', // Màu cam cho xuất kho
  },
  btnSave: {
    backgroundColor: '#FF9800', // Màu cam cho xuất kho
    borderRadius: 4,
    padding: 12,
    alignItems: 'center',
    marginTop: 20,
  },
  textBtnSave: {
    color: 'white',
    fontWeight: 'bold',
    fontSize: 16,
  },
  // Styles cho modal
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
  },
  modalContent: {
    width: '90%',
    maxHeight: '80%',
    backgroundColor: 'white',
    borderRadius: 8,
    padding: 16,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 16,
    textAlign: 'center',
    color: '#FF9800',
  },
  modalList: {
    maxHeight: 400,
  },
  modalItem: {
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
    paddingVertical: 12,
  },
  modalItemContent: {
    paddingHorizontal: 8,
  },
  modalItemTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 4,
  },
  modalCloseButton: {
    backgroundColor: '#FF9800',
    borderRadius: 4,
    padding: 10,
    alignItems: 'center',
    marginTop: 16,
  },
  modalCloseButtonText: {
    color: 'white',
    fontWeight: 'bold',
  },
  modalInputContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
    paddingBottom: 16,
  },
  modalInputLabel: {
    fontWeight: 'bold',
    marginRight: 8,
  },
  modalInput: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 8,
    flex: 1,
  },

  formContainer: {
    maxHeight: 400,
  },
  formGroup: {
    marginBottom: 16,
  },
  formLabel: {
    fontWeight: 'bold',
    marginBottom: 8,
    fontSize: 16,
  },
  required: {
    color: '#F44336',
  },
  formInput: {
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 10,
    fontSize: 16,
  },
});
