import React, {useCallback, useEffect, useState} from 'react';
import {
  View,
  StyleSheet,
  TouchableOpacity,
  FlatList,
  Alert,
} from 'react-native';
import {
  TextInput,
  Button,
  Text,
  HelperText,
  DataTable,
} from 'react-native-paper';
import {useForm, Controller} from 'react-hook-form';
import {ban, khuVuc} from '../../types';

import theme from '../../../../theme';
import {useMutation} from '@tanstack/react-query';
import {loadBan, loadKhuVuc, themBan} from '../../api';
import {useFocusEffect} from '@react-navigation/native';
import {useToast} from '../../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../../constants';
import CommonModal from '../../../../components/CommonModal.component';
import Loading from '../../../../components/Loading.component';

type FormData = {
  tenKhuVuc: string;
  tenBan: string;
};

const FormThemBan = () => {
  const [mdKhuVuc, setMdKhuVuc] = useState<boolean>(false);
  const hideModal = () => setMdKhuVuc(false);
  const [selectKhuVuc, setSelectKhuVuc] = useState<khuVuc | null>(null);

  const {
    control,
    handleSubmit,
    formState: {errors},
    reset, // thêm reset để reset form
  } = useForm({
    defaultValues: {
      tenBan: '',
    },
  });

  const handleChon = (item: khuVuc) => {
    setSelectKhuVuc(item);
    setMdKhuVuc(false);
  };

  const {mutate, data: KhuVuc} = useMutation({
    mutationFn: loadKhuVuc,
  });

  const {
    mutate: loadBanApi,
    data: dataBan,
    isPending: loadingBan,
  } = useMutation({
    mutationFn: loadBan,
  });
  useFocusEffect(
    useCallback(() => {
      mutate({});
      loadBanApi({});
    }, []),
  );

  const {showToast} = useToast();

  const {mutate: themBanApi, isPending: loadingThemBan} = useMutation({
    mutationFn: themBan,
    onSuccess: () => {
      showToast('Thêm bàn mới thành công', 'success');
      loadBanApi({});
      setSelectKhuVuc(null);
      reset({tenBan: ''}); // reset tên bàn về null (rỗng)
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });
  const onSubmit = async (data: any) => {
    themBanApi({lv002: data.tenBan, lv004: selectKhuVuc?.maKhuVuc ?? ''});
  };

  return (
    <View style={styles.container}>
      <Text variant="titleLarge" style={styles.title}>
        Thêm Bàn Mới
      </Text>

      {/* Khu vực */}
      <View style={{marginBottom: 18}}>
        <Text style={styles.labelInput}>Khu vực:</Text>
        <TouchableOpacity
          style={[
            styles.selectInput,
            selectKhuVuc && {
              borderColor: theme.colors.primary,
              backgroundColor: '#f0f8ff',
            },
          ]}
          onPress={() => setMdKhuVuc(true)}>
          <Text
            style={[
              styles.selectText,
              selectKhuVuc && {color: theme.colors.primary},
            ]}>
            {selectKhuVuc
              ? `${selectKhuVuc.tenKhuVuc} (${selectKhuVuc.maKhuVuc})`
              : 'Chọn khu vực'}
          </Text>
        </TouchableOpacity>
      </View>

      {/* Tên bàn */}
      <Controller
        control={control}
        name="tenBan"
        rules={{required: 'Vui lòng nhập tên bàn'}}
        render={({field: {onChange, onBlur, value}}) => (
          <>
            <TextInput
              label="Tên bàn"
              mode="outlined"
              value={value}
              onBlur={onBlur}
              onChangeText={onChange}
              error={!!errors.tenBan}
              style={styles.textInput}
              placeholder="Nhập tên bàn mới"
              left={<TextInput.Icon icon="table-chair" />}
            />
            <HelperText type="error" visible={!!errors.tenBan}>
              {errors.tenBan?.message}
            </HelperText>
          </>
        )}
      />

      {/* Submit Button */}
      <Button
        loading={loadingThemBan}
        disabled={loadingThemBan}
        mode="contained"
        onPress={handleSubmit(onSubmit)}
        style={styles.addButton}
        labelStyle={{fontWeight: 'bold', fontSize: 16}}
        icon="plus"
        contentStyle={{flexDirection: 'row-reverse'}}>
        Thêm bàn
      </Button>

      <CommonModal visible={mdKhuVuc} onDismiss={hideModal}>
        <View>
          <Text style={styles.modalTitle}>Chọn khu vực</Text>
        </View>
        <FlatList
          data={KhuVuc}
          renderItem={({item}) => (
            <TouchableOpacity
              style={[
                styles.modalItem,
                selectKhuVuc?.maKhuVuc === item.maKhuVuc &&
                  styles.modalItemSelected,
              ]}
              onPress={() => handleChon(item)}>
              <View style={styles.modalItemContent}>
                <Text style={styles.modalItemTitle}>{item.tenKhuVuc}</Text>
                <Text style={{color: '#888'}}>Mã: {item.maKhuVuc}</Text>
              </View>
            </TouchableOpacity>
          )}
          keyExtractor={item => item.maKhuVuc}
        />
      </CommonModal>

      {/* Danh sách bàn */}
      <Text
        style={{
          marginTop: 32,
          marginBottom: 8,
          fontWeight: 'bold',
          fontSize: 17,
          color: theme.colors.primary,
        }}>
        Danh sách bàn hiện có
      </Text>
      <Loading loading={loadingBan}>
        <DataTable
          style={{backgroundColor: '#fff', borderRadius: 8, elevation: 1}}>
          <DataTable.Header>
            <DataTable.Title style={{flex: 2}}>Tên bàn</DataTable.Title>
            <DataTable.Title style={{flex: 1}}>Mã KV</DataTable.Title>
          </DataTable.Header>
          {Array.isArray(dataBan) && dataBan.length > 0 ? (
            dataBan.map((ban: ban) => (
              <DataTable.Row key={ban.maBan}>
                <DataTable.Cell style={{flex: 2}}>{ban.tenBan}</DataTable.Cell>
                <DataTable.Cell style={{flex: 1}}>
                  {ban.maKhuVuc}
                </DataTable.Cell>
              </DataTable.Row>
            ))
          ) : (
            <DataTable.Row>
              <DataTable.Cell style={{flex: 5}}>
                <Text style={{color: '#888'}}>Chưa có bàn nào</Text>
              </DataTable.Cell>
            </DataTable.Row>
          )}
        </DataTable>
      </Loading>
    </View>
  );
};

export default FormThemBan;

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
  labelInput: {
    fontWeight: 'bold',
    marginBottom: 6,
    fontSize: 16,
    color: theme.colors.primary,
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
  selectInput: {
    borderWidth: 1.5,
    borderColor: '#e0e0e0',
    borderRadius: 8,
    padding: 14,
    backgroundColor: '#ffffff',
    fontSize: 16,
    marginTop: 2,
    marginBottom: 2,
    elevation: 1,
  },
  selectText: {
    fontSize: 16,
    color: '#666',
  },
  modalContainer: {
    backgroundColor: '#fff',
    padding: 18,
    margin: 18,
    borderRadius: 12,
    elevation: 8,
    shadowColor: '#000',
    shadowOpacity: 0.15,
    shadowRadius: 8,
    shadowOffset: {width: 0, height: 2},
  },
  modalTitle: {
    fontWeight: 'bold',
    fontSize: 18,
    marginBottom: 12,
    color: theme.colors.primary,
    textAlign: 'center',
  },
  modalItem: {
    borderBottomWidth: 1,
    borderBottomColor: '#f0f0f0',
    paddingVertical: 14,
    paddingHorizontal: 4,
    borderRadius: 6,
  },
  modalItemSelected: {
    backgroundColor: '#e3f2fd',
    borderColor: theme.colors.primary,
    borderWidth: 1,
  },
  modalItemContent: {
    paddingHorizontal: 8,
  },
  modalItemTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 2,
    color: theme.colors.primary,
  },
  valueInput: {
    fontSize: 16,
    color: '#424242',
  },
});
