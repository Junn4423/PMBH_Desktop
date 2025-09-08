import React, {useEffect, useState} from 'react';
import {StyleSheet, TouchableOpacity, View, TextInput} from 'react-native';
import {Modal, Portal, Text} from 'react-native-paper';
import theme from '../../../../theme';
import {taoCthd, taoHoaDon} from '../../api';
import {useMutation} from '@tanstack/react-query';
import {TEXT_TOAST} from '../../../../constants';
import Button from '../../../../components/Button.component';
import {sanPham} from '../../types';
import {useToast} from '../../../../context/ToastProvider';

const ModalGoiMon = ({
  visible,
  hideModal,
  maHoaDon,
  maBan,
  sp,
  handleMahd,
}: {
  visible: boolean;
  hideModal: () => void;
  maHoaDon: string;
  maBan: string;
  sp: sanPham | null;
  handleMahd: (maHds: string) => void;
}) => {
  // Dữ liệu giả
  const [quantity, setQuantity] = useState(1);

  // Hàm xử lý số lượng
  const increaseQuantity = () => setQuantity(prev => prev + 1);
  const decreaseQuantity = () => setQuantity(prev => (prev > 1 ? prev - 1 : 1));

  const {showToast} = useToast();

  const {mutate: taoCthdApi, isPending: isLoadingCt} = useMutation({
    mutationFn: taoCthd,
    onSuccess: data => {
      if (data.success) {
        showToast('Thêm sản phẩm thành công', 'success');
        hideModal();
        // loadCthd({maHd: data.message});
        setQuantity(1);
      } else {
        showToast('Thêm sản phẩm thất bại', 'error');
      }
    },
    onError: err => {
      showToast(TEXT_TOAST.success, 'error');
    },
  });
  const [mahd, setMaHd] = useState(maHoaDon);

  const {mutate: taoHoaDonApi, isPending: isLoadingHd} = useMutation({
    mutationFn: taoHoaDon,
    onSuccess: data => {
      if (data.success) {
        if (sp?.maSp) {
          taoCthdApi({maHd: data.message, maSp: sp.maSp, soLuong: quantity});
          setMaHd(data.message);
          handleMahd(data.message);
        } else {
          showToast('Mã sản phẩm không hợp lệ', 'error');
        }
      } else {
        showToast('Tạo đơn hàng thất bại', 'error');
      }
    },
    onError: err => {
      showToast(TEXT_TOAST.success, 'error');
    },
  });

  const handleGoiMon = () => {
    // sang pham da co hoa don
    if (mahd) {
      if (sp?.maSp) {
        console.log(mahd);
        console.log(sp.maSp);
        console.log(quantity);

        taoCthdApi({maHd: mahd, maSp: sp.maSp, soLuong: quantity});
      }
    } else {
      taoHoaDonApi({maBan: maBan});
    }
  };

  return (
    <Portal>
      <Modal
        visible={visible}
        onDismiss={hideModal}
        contentContainerStyle={styles.modalContainer}>
        <View>
          <Text style={styles.title}>{sp?.tenSp}</Text>
          <Text style={styles.price}>{sp?.giaBan.toLocaleString()} đ</Text>

          <View style={styles.quantityContainer}>
            <Text style={styles.sectionTitle}>Số lượng:</Text>
            <View style={styles.quantityControl}>
              <TouchableOpacity
                onPress={decreaseQuantity}
                style={styles.quantityButton}>
                <Text style={styles.quantityButtonText}>-</Text>
              </TouchableOpacity>
              <Text style={styles.quantityText}>{quantity}</Text>
              <TouchableOpacity
                onPress={increaseQuantity}
                style={styles.quantityButton}>
                <Text style={styles.quantityButtonText}>+</Text>
              </TouchableOpacity>
            </View>
          </View>

          <View style={styles.notesContainer}>
            <TextInput
              style={styles.notesInput}
              placeholder="Ghi chú"
              placeholderTextColor="#aaa"
            />
          </View>

          <View style={styles.buttonContainer}>
            <Button
              style={styles.cancelButton}
              onPress={hideModal}
              title="Hủy"
              textStyle={{color: 'black'}}
            />
            <Button
              loading={isLoadingCt || isLoadingHd}
              disabled={isLoadingHd || isLoadingCt}
              style={styles.confirmButton}
              onPress={handleGoiMon}
              title="Xác nhận"
            />
          </View>
        </View>
      </Modal>
    </Portal>
  );
};

const styles = StyleSheet.create({
  modalContainer: {
    backgroundColor: '#ffffff',
    padding: 20,
    margin: 20,
    borderRadius: 12,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 2},
    shadowOpacity: 0.2,
    shadowRadius: 4,
    elevation: 5,
  },
  title: {
    fontSize: 22,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 8,
    textAlign: 'center',
  },
  price: {
    fontSize: 20,
    color: '#007AFF',
    marginBottom: 16,
    textAlign: 'center',
  },
  sectionTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#555',
    marginBottom: 8,
  },
  quantityContainer: {
    marginBottom: 16,
    alignItems: 'center',
  },
  quantityControl: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
  },
  quantityButton: {
    width: 50,
    height: 50,
    backgroundColor: '#e0e0e0',
    borderRadius: 25,
    justifyContent: 'center',
    alignItems: 'center',
    marginHorizontal: 15,
  },
  quantityButtonText: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#333',
  },
  quantityText: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#333',
  },
  notesContainer: {
    marginBottom: 24,
  },
  notesInput: {
    backgroundColor: '#fff',
    borderRadius: 8,
    padding: 12,
    fontSize: 16,
    borderColor: '#ccc',
    borderWidth: 1,
    color: '#333',
    height: 50, // Tăng chiều cao ô ghi chú
  },
  buttonContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 16,
  },
  cancelButton: {
    flex: 1,
    backgroundColor: '#f0f0f0',
    paddingVertical: 14,
    borderRadius: 8,
    alignItems: 'center',
    marginRight: 10, // Khoảng cách giữa nút Hủy và Xác nhận
  },
  confirmButton: {
    flex: 1,
    backgroundColor: theme.colors.primary,
    paddingVertical: 14,
    borderRadius: 8,
    alignItems: 'center',
  },
  confirmButtonText: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#fff',
  },
  cancelButtonText: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
  },
});

export default ModalGoiMon;
function showToast(success: any, arg1: string) {
  throw new Error('Function not implemented.');
}
