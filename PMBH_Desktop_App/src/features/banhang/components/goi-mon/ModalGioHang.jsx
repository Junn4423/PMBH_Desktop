import React, { useState } from 'react';
import {
  StyleSheet,
  View,
  TouchableOpacity,
  TextInput,
  FlatList,
  ActivityIndicator,
} from 'react-native';
import { Modal, Portal, Text } from 'react-native-paper';
import MaterialIcons from 'react-native-vector-icons/MaterialIcons';
import { gioHang } from '../../types';
import numeral from 'numeral';
import { useMutation } from '@tanstack/react-query';
import { xoaCtHd } from '../../api';
import { useToast } from '../../../../context/ToastProvider';
import { TEXT_TOAST } from '../../../../constants';

const ModalGioHang = ({
  visible,
  hideModal,
  gioHang,
  onReloadGioHang,
}: {
  visible: boolean;
  hideModal: () => void;
  gioHang: gioHang[];
  onReloadGioHang: () => void;
}) => {
  const { showToast } = useToast();
  const [loadingItem, setLoadingItem] = useState<string | null>(null); // Theo dõi trạng thái loading của từng sản phẩm

  const { mutate } = useMutation({
    mutationFn: xoaCtHd,
    onSuccess: (data) => {
      if (data.success) {
        showToast('Xóa sản phẩm thành công', 'success');
        onReloadGioHang();
      } else {
        showToast('Xóa sản phẩm thất bại', 'error');
      }
      setLoadingItem(null); // Kết thúc loading
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
      setLoadingItem(null); // Kết thúc loading
    },
  });

  // Xóa 1 sản phẩm
  const handleRemoveItem = (maCt: string) => {
    setLoadingItem(maCt); // Bắt đầu loading cho sản phẩm cụ thể
    mutate({ maCt });
  };

  const renderItem = ({ item }: { item: gioHang }) => (
    <View style={styles.cartItem}>
      <View style={styles.itemInfo}>
        <Text style={styles.itemName}>{item.tenSp}</Text>
        <TextInput
          style={styles.notesInput}
          placeholder="Ghi chú cho quán"
          placeholderTextColor="#aaa"
        />
        <View style={{ flexDirection: 'row', alignItems: 'center', gap: 20 }}>
          <Text style={styles.itemPrice}>
            Đơn Giá: {numeral(item.giaBan).format()} đ
          </Text>
          <Text style={styles.itemPrice}>Số lượng: {item.soLuong}</Text>
        </View>
      </View>
      <TouchableOpacity
        onPress={() => handleRemoveItem(item.maCt)}
        style={styles.removeButton}
        disabled={loadingItem === item.maCt} // Vô hiệu hóa nút khi đang loading
      >
        {loadingItem === item.maCt ? ( // Hiển thị spinner nếu đang loading
          <ActivityIndicator size="small" color="red" />
        ) : (
          <MaterialIcons name="delete" size={24} color="red" />
        )}
      </TouchableOpacity>
    </View>
  );

  return (
    <Portal>
      <Modal
        visible={visible}
        onDismiss={hideModal}
        contentContainerStyle={styles.modalContainer}
      >
        <View style={styles.header}>
          <Text style={styles.title}>Giỏ hàng</Text>
          <TouchableOpacity onPress={hideModal}>
            <MaterialIcons name="close" size={24} color="black" />
          </TouchableOpacity>
        </View>
        <FlatList
          data={gioHang}
          renderItem={renderItem}
          keyExtractor={(item) => item.maCt}
          contentContainerStyle={styles.cartList}
        />
      </Modal>
    </Portal>
  );
};

const styles = StyleSheet.create({
  modalContainer: {
    backgroundColor: '#ffffff',
    padding: 20,
    borderRadius: 12,
    marginHorizontal: 10,
    maxHeight: '80%',
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 16,
  },
  title: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#333',
  },
  cartList: {
    paddingBottom: 20,
  },
  cartItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 16,
    borderBottomWidth: 1,
    borderColor: '#eee',
    paddingBottom: 10,
  },
  itemInfo: {
    flex: 1,
    gap: 5,
  },
  itemName: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 4,
  },
  notesInput: {
    backgroundColor: '#f9f9f9',
    borderRadius: 8,
    padding: 8,
    fontSize: 14,
    borderColor: '#ddd',
    borderWidth: 1,
    marginBottom: 4,
    color: '#333',
  },
  itemPrice: {
    fontSize: 14,
    color: '#007AFF',
    fontWeight: 'bold',
  },
  removeButton: {
    padding: 8,
  },
});

export default ModalGioHang;