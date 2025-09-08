import {Controller, useForm} from 'react-hook-form';
import {ScrollView, StyleSheet, Text, TextInput, View} from 'react-native';
import {Button, Icon} from 'react-native-paper';
import theme from '../../../../theme';
import {kho} from '../../types';

import {useMutation} from '@tanstack/react-query';
import {TEXT_TOAST} from '../../../../constants';
import {useToast} from '../../../../context/ToastProvider';
import {capNhatKho, themKho} from '../../api';

interface ModalThemSuaKhoProps {
  khoHienTai: kho | null;
  handelDongModal: () => void;
  dsKho: kho[] | null;
  onReloadGioHang: () => void;
}

const ModalThemSuaKho = ({
  khoHienTai,
  handelDongModal,
  dsKho,
  onReloadGioHang,
}: ModalThemSuaKhoProps) => {
  const {
    control,
    handleSubmit,
    formState: {errors},
  } = useForm({
    defaultValues: {
      maKho: khoHienTai?.maKho || '',
      tenCongTy: khoHienTai?.tenCongTy || '',
      tenKho: khoHienTai?.tenKho || '',
      viTriKho: khoHienTai?.viTriKho || '',
      soDT: khoHienTai?.soDT || '',
      fax: khoHienTai?.fax || '',
      maThuKho: khoHienTai?.maThuKho || '',
      ghiChu: khoHienTai?.ghiChu || '',
    },
  });

  // tien hanh them vao csdl
  const {showToast} = useToast();
  const {mutate: taoKho, isPending: loadingTaoKho} = useMutation({
    mutationFn: themKho,
    onSuccess: () => {
      showToast('Tạo kho thành công !', 'success');
      handelDongModal();
      onReloadGioHang()
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const {mutate: capNhat, isPending: loadingCapNhatKho} = useMutation({
    mutationFn: capNhatKho,
    onSuccess: () => {
      showToast('Cập nhật kho thành công !', 'success');
      handelDongModal();
      onReloadGioHang()
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const onSummit = (data: kho) => {
    if (khoHienTai) {
      capNhat({
        lv001: data.maKho ?? '',
        lv002: data.tenCongTy ?? '',
        lv003: data.tenKho ?? '',
        lv004: data.viTriKho ?? '',
        lv005: data.soDT ?? '',
        lv006: data.fax ?? '',
        lv007: data.maThuKho ?? '',
        lv008: data.ghiChu ?? '',
      });
    } else {
      const khoTonTai = dsKho && dsKho.find(kho => kho.maKho == data.maKho);
      if (khoTonTai) {
        capNhat({
          lv001: data.maKho ?? '',
          lv002: data.tenCongTy ?? '',
          lv003: data.tenKho ?? '',
          lv004: data.viTriKho ?? '',
          lv005: data.soDT ?? '',
          lv006: data.fax ?? '',
          lv007: data.maThuKho ?? '',
          lv008: data.ghiChu ?? '',
        });
      } else {
        taoKho({
          lv001: data.maKho ?? '',
          lv002: data.tenCongTy ?? '',
          lv003: data.tenKho ?? '',
          lv004: data.viTriKho ?? '',
          lv005: data.soDT ?? '',
          lv006: data.fax ?? '',
          lv007: data.maThuKho ?? '',
          lv008: data.ghiChu ?? '',
        });
      }
    }
  };

  return (
    <View>
      <Text style={styles.modalHeader}>
        {khoHienTai ? 'Chỉnh sửa thông tin kho' : 'Thêm kho mới'}
      </Text>

      <ScrollView style={styles.formContainer}>
        {!khoHienTai && (
          <Controller
            control={control}
            name="maKho"
            rules={{required: 'Mã kho không được để trống'}}
            render={({field: {onChange, value}}) => (
              <View style={styles.formGroup}>
                <Text style={styles.formLabel}>
                  Mã kho: <Text style={styles.required}>*</Text>
                </Text>
                <TextInput
                  style={styles.formInput}
                  placeholder="Nhập mã kho"
                  value={value}
                  onChangeText={onChange}
                />
                {errors.maKho && (
                  <View style={styles.wrapError}>
                    <Icon source="alert-circle-outline" size={15} color="red" />
                    <Text style={styles.textError}>{errors.maKho.message}</Text>
                  </View>
                )}
              </View>
            )}
          />
        )}
        <Controller
          control={control}
          name="tenCongTy"
          rules={{required: 'Tên công ty không được để trống'}}
          render={({field: {onChange, value}}) => (
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>
                Tên công ty: <Text style={styles.required}>*</Text>
              </Text>
              <TextInput
                style={styles.formInput}
                placeholder="Nhập tên công ty"
                value={value}
                onChangeText={onChange}
              />
              {errors.tenCongTy && (
                <View style={styles.wrapError}>
                  <Icon source="alert-circle-outline" size={15} color="red" />
                  <Text style={styles.textError}>
                    {errors.tenCongTy.message}
                  </Text>
                </View>
              )}
            </View>
          )}
        />

        <Controller
          control={control}
          name="tenKho"
          rules={{required: 'Tên kho không được để trống'}}
          render={({field: {onChange, value}}) => (
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>
                Tên kho: <Text style={styles.required}>*</Text>
              </Text>
              <TextInput
                style={styles.formInput}
                placeholder="Nhập tên kho"
                value={value}
                onChangeText={onChange}
              />
              {errors.tenKho && (
                <View style={styles.wrapError}>
                  <Icon source="alert-circle-outline" size={15} color="red" />
                  <Text style={styles.textError}>{errors.tenKho.message}</Text>
                </View>
              )}
            </View>
          )}
        />

        <Controller
          control={control}
          name="viTriKho"
          render={({field: {onChange, value}}) => (
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>Địa chỉ:</Text>
              <TextInput
                style={styles.formInput}
                placeholder="Nhập địa chỉ kho"
                value={value}
                onChangeText={onChange}
              />
            </View>
          )}
        />

        <Controller
          control={control}
          name="soDT"
          render={({field: {onChange, value}}) => (
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>Số điện thoại:</Text>
              <TextInput
                style={styles.formInput}
                placeholder="Nhập số điện thoại"
                value={value}
                onChangeText={onChange}
                keyboardType="phone-pad"
              />
            </View>
          )}
        />

        <Controller
          control={control}
          name="fax"
          render={({field: {onChange, value}}) => (
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>Số fax:</Text>
              <TextInput
                style={styles.formInput}
                placeholder="Nhập số fax"
                value={value}
                onChangeText={onChange}
                keyboardType="phone-pad"
              />
            </View>
          )}
        />

        <Controller
          control={control}
          name="maThuKho"
          render={({field: {onChange, value}}) => (
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>Mã thủ kho:</Text>
              <TextInput
                style={styles.formInput}
                placeholder="Nhập mã thủ kho"
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
            <View style={styles.formGroup}>
              <Text style={styles.formLabel}>Ghi chú:</Text>
              <TextInput
                style={[styles.formInput, styles.textArea]}
                placeholder="Nhập ghi chú (nếu có)"
                value={value}
                onChangeText={onChange}
                multiline={true}
                numberOfLines={4}
              />
            </View>
          )}
        />

        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'center',
            gap: 10,
            width: '100%',
          }}>
          <Button
            onPress={handelDongModal}
            contentStyle={{height: 36}} // giảm chiều cao
            labelStyle={{fontSize: 13, color: '#fff'}}
            style={[
              styles.btn,
              {flex: 1, backgroundColor: 'gray', height: 36},
            ]}>
            Huỷ
          </Button>
          <Button
            disabled={loadingCapNhatKho || loadingTaoKho}
            loading={loadingCapNhatKho || loadingTaoKho}
            onPress={handleSubmit(data => onSummit(data))}
            contentStyle={{height: 36}} // giảm chiều cao
            labelStyle={{fontSize: 13, color: '#fff'}}
            style={[styles.btn, {flex: 1, height: 36}]}>
            Lưu
          </Button>
        </View>
      </ScrollView>
    </View>
  );
};
export default ModalThemSuaKho;

const styles = StyleSheet.create({
  modalHeader: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: '#4CAF50',
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
  textArea: {
    height: 100,
    textAlignVertical: 'top',
  },
  modalActions: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 20,
  },
  modalBtn: {
    flex: 1,
    padding: 12,
    borderRadius: 4,
    alignItems: 'center',
    marginHorizontal: 5,
  },
  modalBtnCancel: {
    backgroundColor: '#9e9e9e',
  },
  modalBtnSave: {
    backgroundColor: '#4CAF50',
  },
  modalBtnText: {
    color: '#ffffff',
    fontWeight: 'bold',
    fontSize: 16,
  },

  wrapError: {
    flexDirection: 'row',
    alignItems: 'center',
    marginTop: 5,
    marginLeft: 10,
  },
  textError: {
    marginLeft: 5,
    fontWeight: 700,
    fontSize: 12,
    color: 'red',
  },
  btn: {
    backgroundColor: theme.colors.primary,
    height: 36, // giảm chiều cao mặc định
    marginTop: 10,
    justifyContent: 'center',
  },
});
