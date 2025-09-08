// // components/WarehouseSelector.component.tsx
// import React, {useState} from 'react';
// import {
//   Modal,
//   StyleSheet,
//   TouchableOpacity,
//   View,
//   FlatList,
// } from 'react-native';
// import {Text} from 'react-native-paper';
// import theme from '../../../../theme';

// interface Warehouse {
//   maKho: string;
//   tenKho: string;
//   tenCongTy?: string;
// }

// interface WarehouseSelectorProps {
//   selectedWarehouse: string;
//   warehouses: Warehouse[];
//   onSelect: (maKho: string, tenKho: string) => void;
// }

// const WarehouseSelector = ({
//   selectedWarehouse,
//   warehouses,
//   onSelect,
// }: WarehouseSelectorProps) => {
//   const [modalVisible, setModalVisible] = useState(false);

//   const selectedName =
//     warehouses.find(kho => kho.maKho === selectedWarehouse)?.tenKho ||
//     'Tất cả kho';

//   return (
//     <>
//       <TouchableOpacity
//         style={styles.selectorButton}
//         onPress={() => setModalVisible(true)}>
//         <Text style={styles.selectorButtonText}>{selectedName}</Text>
//         <Text style={styles.dropdownIcon}>▼</Text>
//       </TouchableOpacity>

//       <Modal
//         transparent={true}
//         visible={modalVisible}
//         animationType="fade"
//         onRequestClose={() => setModalVisible(false)}>
//         <TouchableOpacity
//           style={styles.modalOverlay}
//           activeOpacity={1}
//           onPress={() => setModalVisible(false)}>
//           <View style={styles.modalContent}>
//             <Text style={styles.modalTitle}>Chọn kho</Text>
//             <FlatList
//               data={warehouses}
//               keyExtractor={item => item.maKho}
//               renderItem={({item}) => (
//                 <TouchableOpacity
//                   style={[
//                     styles.warehouseItem,
//                     item.maKho === selectedWarehouse && styles.selectedItem,
//                   ]}
//                   onPress={() => {
//                     onSelect(item.maKho, item.tenKho);
//                     setModalVisible(false);
//                   }}>
//                   <Text
//                     style={[
//                       styles.warehouseItemText,
//                       item.maKho === selectedWarehouse &&
//                         styles.selectedItemText,
//                     ]}>
//                     {item.tenKho}
//                   </Text>
//                 </TouchableOpacity>
//               )}
//             />
//           </View>
//         </TouchableOpacity>
//       </Modal>
//     </>
//   );
// };

// const styles = StyleSheet.create({
//   selectorButton: {
//     backgroundColor: '#2196F3',
//     paddingVertical: 10,
//     paddingHorizontal: 15,
//     borderRadius: 4,
//     flexDirection: 'row',
//     alignItems: 'center',
//     justifyContent: 'space-between',
//   },
//   selectorButtonText: {
//     color: '#ffffff',
//     fontWeight: 'bold',
//     flex: 1,
//   },
//   dropdownIcon: {
//     color: '#ffffff',
//     fontSize: 12,
//     marginLeft: 8,
//   },
//   modalOverlay: {
//     flex: 1,
//     backgroundColor: 'rgba(0, 0, 0, 0.5)',
//     justifyContent: 'center',
//     alignItems: 'center',
//   },
//   modalContent: {
//     width: '80%',
//     maxHeight: '70%',
//     backgroundColor: '#ffffff',
//     borderRadius: 8,
//     padding: 16,
//     elevation: 5,
//   },
//   modalTitle: {
//     fontSize: 18,
//     fontWeight: 'bold',
//     marginBottom: 16,
//     textAlign: 'center',
//     color: theme.colors.primary,
//   },
//   warehouseItem: {
//     paddingVertical: 12,
//     paddingHorizontal: 16,
//     borderBottomWidth: 1,
//     borderBottomColor: '#e0e0e0',
//   },
//   selectedItem: {
//     backgroundColor: 'rgba(33, 150, 243, 0.1)',
//   },
//   warehouseItemText: {
//     fontSize: 16,
//   },
//   selectedItemText: {
//     fontWeight: 'bold',
//     color: theme.colors.primary,
//   },
// });

// export default WarehouseSelector;
