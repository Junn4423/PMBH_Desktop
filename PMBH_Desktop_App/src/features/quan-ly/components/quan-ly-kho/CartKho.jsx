import {StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import {kho} from '../../types';
import {NavigationProp, useNavigation} from '@react-navigation/native';
import { RootStackParamList } from '../../../../types/navigation';

const CartKho = ({
  item,
  handleSuaKho,
  handleXoaKho,

}: {
  item: kho;
  handleSuaKho: () => void;
  handleXoaKho: (maKho: string) =>void
}) => {

  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  return (
    <TouchableOpacity
    onPress={() => nav.navigate("ChiTietKho",{maKho: item.maKho, tenKho: item.tenKho})}>
    
      <View style={styles.itemKho}>
        <View style={styles.headerItem}>
          <Text style={styles.maKho}>{item.maKho}</Text>
          <View style={styles.containerBtn}>
            <TouchableOpacity
              onPress={handleSuaKho}
              style={[styles.btnAction, styles.btnEdit]}>
              <Text style={styles.textBtnAction}>Sửa</Text>
            </TouchableOpacity>
            <TouchableOpacity
                onPress={() => handleXoaKho(item.maKho)}
              style={[styles.btnAction, styles.btnDelete]}>
              <Text style={styles.textBtnAction}>Xóa</Text>
            </TouchableOpacity>
          </View>
        </View>
        <Text style={styles.tenCongTy}>Tên công ty: {item.tenCongTy}</Text>
        <Text style={styles.tenKho}>Tên kho: {item.tenKho}</Text>
        <Text style={styles.thongTinKho}>
          Vị trí kho:{' '}
          {item.viTriKho ? (
            item.viTriKho
          ) : (
            <Text style={{color: 'red'}}>Chưa cập nhật</Text>
          )}
        </Text>
        <Text style={styles.thongTinKho}>
          Điện thoại:{' '}
          {item.soDT ? (
            item.soDT
          ) : (
            <Text style={{color: 'red'}}>Chưa cập nhật</Text>
          )}
        </Text>
        <Text style={styles.thongTinKho}>
          Fax:{' '}
          {item.fax ? (
            item.fax
          ) : (
            <Text style={{color: 'red'}}>Chưa cập nhật</Text>
          )}
        </Text>
        <Text style={styles.thongTinKho}>
          Mã thủ kho:{' '}
          {item.maThuKho ? (
            item.maThuKho
          ) : (
            <Text style={{color: 'red'}}>Chưa cập nhật</Text>
          )}
        </Text>
        {item.ghiChu && (
          <Text style={styles.ghiChu}>Ghi nhận: {item.ghiChu}</Text>
        )}
      </View>
    </TouchableOpacity>
  );
};

const styles = StyleSheet.create({
  logo: {
    width: 80,
    height: 40,
    resizeMode: 'contain',
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
  btnCreate: {
    backgroundColor: '#4CAF50',
    paddingVertical: 8,
    paddingHorizontal: 12,
    borderRadius: 4,
  },
  textBtnCreate: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
  searchContainer: {
    padding: 16,
    backgroundColor: '#ffffff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  searchInput: {
    backgroundColor: '#f5f5f5',
    borderWidth: 1,
    borderColor: '#e0e0e0',
    borderRadius: 4,
    padding: 10,
    fontSize: 16,
  },
  listContainer: {
    flex: 1,
    padding: 8,
  },
  itemKho: {
    backgroundColor: '#ffffff',
    padding: 16,
    marginVertical: 8,
    borderRadius: 8,
    elevation: 2,
    borderLeftWidth: 4,
    borderLeftColor: '#4CAF50',
  },
  headerItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  maKho: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#4CAF50',
  },
  containerBtn: {
    flexDirection: 'row',
  },
  btnAction: {
    paddingVertical: 4,
    paddingHorizontal: 12,
    borderRadius: 4,
    marginLeft: 8,
  },
  btnEdit: {
    backgroundColor: '#2196F3',
  },
  btnDelete: {
    backgroundColor: '#F44336',
  },
  textBtnAction: {
    color: '#ffffff',
    fontWeight: 'bold',
  },
  tenKho: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 4,
  },
  tenCongTy: {
    fontSize: 16,
    fontWeight: '500',
    marginBottom: 8,
    color: '#424242',
  },
  thongTinKho: {
    fontWeight: 'bold',
    fontSize: 14,
    color: '#757575',
    marginBottom: 4,
  },
  ghiChu: {
    fontSize: 14,
    color: '#757575',
    marginTop: 8,
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
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
  },
  modalContent: {
    backgroundColor: '#ffffff',
    borderRadius: 8,
    padding: 20,
    width: '90%',
    maxWidth: 500,
    maxHeight: '80%',
    elevation: 5,
  },
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
});

export default CartKho;
