import React, {useCallback} from 'react';
import {View, StyleSheet} from 'react-native';
import {
  TextInput,
  Button,
  Text,
  HelperText,
  DataTable,
} from 'react-native-paper';
import {useForm, Controller} from 'react-hook-form';
import {useMutation} from '@tanstack/react-query';
import {useFocusEffect} from '@react-navigation/native';
import {useToast} from '../../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../../constants';
import theme from '../../../../theme';
import Loading from '../../../../components/Loading.component';
import {loadKhuVuc, themKhuVuc} from '../../api';
import {khuVuc} from '../../types';

const FormKhuVuc = () => {
  const {
    control,
    handleSubmit,
    formState: {errors},
    reset,
  } = useForm({
    defaultValues: {
      tenKhuVuc: '',
      maKhuVuc: '',
    },
  });

  const {
    mutate,
    data: KhuVuc,
    isPending: loadingKhuVuc,
  } = useMutation({
    mutationFn: loadKhuVuc,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({});
    }, []),
  );

  const {showToast} = useToast();

  const {mutate: themKhuVucApi, isPending: loadingThemKhuVuc} = useMutation({
    mutationFn: themKhuVuc,
    onSuccess: () => {
      showToast('Thêm khu vực mới thành công', 'success');
      mutate({});
      reset({tenKhuVuc: '', maKhuVuc: ''});
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });

  const onSubmit = (data: any) => {
    themKhuVucApi({lv001: data.maKhuVuc, lv002: data.tenKhuVuc});
  };

  return (
    <View style={styles.container}>
      <Text variant="titleLarge" style={styles.title}>
        Thêm Khu Vực Mới
      </Text>
      <Controller
        control={control}
        name="tenKhuVuc"
        rules={{required: 'Vui lòng nhập tên khu vực'}}
        render={({field: {onChange, onBlur, value}}) => (
          <>
            <TextInput
              label="Tên khu vực"
              mode="outlined"
              value={value}
              onBlur={onBlur}
              onChangeText={onChange}
              error={!!errors.tenKhuVuc}
              style={styles.textInput}
              placeholder="Nhập tên khu vực"
              left={<TextInput.Icon icon="domain" />}
            />
            <HelperText type="error" visible={!!errors.tenKhuVuc}>
              {errors.tenKhuVuc?.message}
            </HelperText>
          </>
        )}
      />
      <Controller
        control={control}
        name="maKhuVuc"
        rules={{required: 'Vui lòng nhập mã khu vực'}}
        render={({field: {onChange, onBlur, value}}) => (
          <>
            <TextInput
              label="Mã khu vực"
              mode="outlined"
              value={value}
              onBlur={onBlur}
              onChangeText={onChange}
              error={!!errors.maKhuVuc}
              style={styles.textInput}
              placeholder="Nhập mã khu vực"
              left={<TextInput.Icon icon="identifier" />}
            />
            <HelperText type="error" visible={!!errors.maKhuVuc}>
              {errors.maKhuVuc?.message}
            </HelperText>
          </>
        )}
      />
      <Button
        loading={loadingThemKhuVuc}
        disabled={loadingThemKhuVuc}
        mode="contained"
        onPress={handleSubmit(onSubmit)}
        style={styles.addButton}
        labelStyle={{fontWeight: 'bold', fontSize: 16}}
        icon="plus"
        contentStyle={{flexDirection: 'row-reverse'}}>
        Thêm khu vực
      </Button>

      <Text
        style={{
          marginTop: 32,
          marginBottom: 8,
          fontWeight: 'bold',
          fontSize: 17,
          color: theme.colors.primary,
        }}>
        Danh sách khu vực hiện có
      </Text>
      <Loading loading={loadingKhuVuc}>
        <DataTable
          style={{backgroundColor: '#fff', borderRadius: 8, elevation: 1}}>
          <DataTable.Header>
            <DataTable.Title style={{flex: 2}}>Tên khu vực</DataTable.Title>
            <DataTable.Title style={{flex: 1}}>Mã KV</DataTable.Title>
          </DataTable.Header>
          {Array.isArray(KhuVuc) && KhuVuc.length > 0 ? (
            KhuVuc.map((kv: khuVuc) => (
              <DataTable.Row key={kv.maKhuVuc}>
                <DataTable.Cell style={{flex: 2}}>
                  {kv.tenKhuVuc}
                </DataTable.Cell>
                <DataTable.Cell style={{flex: 1}}>{kv.maKhuVuc}</DataTable.Cell>
              </DataTable.Row>
            ))
          ) : (
            <DataTable.Row>
              <DataTable.Cell style={{flex: 3}}>
                <Text style={{color: '#888'}}>Chưa có khu vực nào</Text>
              </DataTable.Cell>
            </DataTable.Row>
          )}
        </DataTable>
      </Loading>
    </View>
  );
};

export default FormKhuVuc

const styles = StyleSheet.create({
  container: {
    padding: 20,
    flex: 1,
    backgroundColor: '#f7fafd',
  },
  title: {
    marginBottom: 24,
    fontWeight: 'bold',
    color: theme.colors.primary,
    textAlign: 'center',
    fontSize: 22,
    letterSpacing: 1,
  },
  textInput: {
    marginTop: 8,
    backgroundColor: '#fff',
    borderRadius: 8,
  },
  addButton: {
    marginTop: 24,
    backgroundColor: theme.colors.primary,
    borderRadius: 8,
    paddingVertical: 6,
    elevation: 2,
  },
});
