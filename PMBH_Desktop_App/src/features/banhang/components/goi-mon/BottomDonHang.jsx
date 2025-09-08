import { StyleSheet, TouchableOpacity, View } from 'react-native';
import { Text } from 'react-native-paper';
import MaterialIcons from 'react-native-vector-icons/MaterialIcons';

const BottomDonHang = ({
  onPressViewOrder,
  onPressCart,
}: {
  onPressViewOrder?: () => void;
  onPressCart?: () => void;
}) => {
  return (
    <View style={styles.bottomButtons}>
      {/* Nút Giỏ hàng */}
      <TouchableOpacity onPress={onPressCart} style={styles.cartButton}>
        <MaterialIcons name="shopping-cart" size={24} color="white" />
        <Text style={styles.cartButtonText}>Giỏ hàng</Text>
      </TouchableOpacity>

      {/* Nút Xem đơn hàng */}
      <TouchableOpacity onPress={onPressViewOrder} style={styles.viewOrderButton}>
        <Text style={styles.viewOrderButtonText}>Xem đơn hàng</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  bottomButtons: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 10,
    paddingBottom: 30,
    backgroundColor: 'white',
   
    
  },
  cartButton: {
    flex: 3, // Chiếm 30% chiều rộng
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#FFA500',
    paddingVertical: 12,
    borderRadius: 20,
    marginRight: 10, // Khoảng cách giữa nút Giỏ hàng và Xem đơn hàng
  },
  cartButtonText: {
    fontSize: 14,
    fontWeight: 'bold',
    color: 'white',
    marginLeft: 5,
  },
  viewOrderButton: {
    flex: 7, // Chiếm 70% chiều rộng
    backgroundColor: '#007AFF',
    paddingVertical: 12,
    alignItems: 'center',
    borderRadius: 20,
  },
  viewOrderButtonText: {
    fontSize: 16,
    fontWeight: 'bold',
    color: 'white',
  },
});

export default BottomDonHang;