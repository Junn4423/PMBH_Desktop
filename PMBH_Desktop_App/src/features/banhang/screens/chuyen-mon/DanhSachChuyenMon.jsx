import {
  NavigationProp,
  useFocusEffect,
  useNavigation,
  useRoute,
} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import {useCallback, useState, useMemo} from 'react';
import {
  View,
  StyleSheet,
  FlatList,
  TouchableOpacity,
  Dimensions,
  Modal,
} from 'react-native';
import {Text, Checkbox, Button, Appbar, Searchbar} from 'react-native-paper';
import Loading from '../../../../components/Loading.component';
import WrapHeader from '../../../../components/WrapHeader.component';
import {useToast} from '../../../../context/ToastProvider';
import {loadDsCthdV2, chuyenMon} from '../../api';
import numeral from 'numeral';
import useFetchBanKhuVuc from '../../hooks/useFetchBanKhuVuc';
import {RootStackParamList} from '../../../../types/navigation';

const {width} = Dimensions.get('window');

interface OrderItem {
  maChiTiet: string;
  tenMon: string;
  soLuong: number;
  donGia: number;
  daCheBien?: boolean;
}

interface TableItem {
  maBan: string;
  tenBan: string;
  trangThai: string;
  maKhuVuc?: string;
  tenKhuVuc?: string;
}

function DanhSachChuyenMon() {
  const navigation = useNavigation<NavigationProp<RootStackParamList>>();
  const route = useRoute();
  const {showToast} = useToast();

  // Get parameters from navigation
  // const {maBan, maHoaDon} = route.params as {maBan: string; maHoaDon: string};
  const {idBan, idHoaDon} = route.params as {idBan: string; idHoaDon: string};

  const [selectedItems, setSelectedItems] = useState<string[]>([]);
  const [allSelected, setAllSelected] = useState(false);
  const [modalVisible, setModalVisible] = useState(false);
  const [selectedDestinationTable, setSelectedDestinationTable] = useState<
    string | null
  >(null);
  const [searchQuery, setSearchQuery] = useState('');
  const {dsBanKhongGop, loading: tablesLoading} = useFetchBanKhuVuc();

  // Load order details mutation
  const {
    mutate: loadOrderDetails,
    data: orderItems,
    // isLoading,
  } = useMutation({
    mutationFn: loadDsCthdV2,
    onError: error => {
      showToast('Lỗi khi tải chi tiết đơn hàng', 'error');
    },
  });

  // Fetch available tables - REMOVE này vì đã có dsBanKhongGop
  // const {
  //   data: tables,
  //   isLoading: tablesLoading,
  //   refetch: refetchTables,
  // } = useQuery({
  //   queryKey: ['danhSachBan'],
  //   queryFn: fetchDanhSachBan,
  // });

  // Mutation for submitting selected items
  const {mutate: submitChuyenMon, status: submitStatus} = useMutation({
    mutationFn: chuyenMon,

    onSuccess: () => {
      showToast('Chuyển món thành công', 'success');
      setModalVisible(false);
      navigation.reset({
        index: 0,
        routes: [{name: 'BottomNav'}],
      });
    },
    onError: error => {
      showToast('Lỗi khi chuyển món', 'error');
    },
  });

  // Load data when screen is focused
  useFocusEffect(
    useCallback(() => {
      console.log('Loading data for maHoaDon:', idHoaDon);
      if (idHoaDon) {
        loadOrderDetails({maHd: idHoaDon});
      }

      // Reset selections when screen is focused
      setSelectedItems([]);
      setAllSelected(false);

      return () => {
        // Cleanup if needed
      };
    }, [idHoaDon]),
  );

  const toggleItem = (maChiTiet: string) => {
    setSelectedItems(prev => {
      const isSelected = prev.includes(maChiTiet);
      const newSelection = isSelected
        ? prev.filter(id => id !== maChiTiet)
        : [...prev, maChiTiet];

      // Update allSelected state based on whether all items are selected
      if (orderItems && orderItems.length > 0) {
        setAllSelected(newSelection.length === orderItems.length);
      }
      console.log('Selected items:', newSelection);
      return newSelection;
    });
  };

  const toggleSelectAll = () => {
    setAllSelected(!allSelected);
    if (!allSelected && orderItems) {
      setSelectedItems(orderItems.map(item => item.maCt));
    } else {
      setSelectedItems([]);
    }
  };

  const handleShowTableModal = () => {
    if (selectedItems.length === 0) {
      showToast('Vui lòng chọn ít nhất một món', 'error');
      return;
    }

    // Không cần refresh lại - sử dụng data có sẵn từ dsBanKhongGop
    setModalVisible(true);
  };

  const handleTableSelect = (tableMaBan: string) => {
    setSelectedDestinationTable(tableMaBan);
  };

  const handleSubmitChuyenMon = () => {
    if (!selectedDestinationTable) {
      showToast('Vui lòng chọn bàn đích', 'error');
      return;
    }

    submitChuyenMon({
      dsChiTietMonAn: selectedItems,
      maBanChuyen: selectedDestinationTable,
    });
    console.log(selectedDestinationTable);
    console.log(selectedItems);
  };

  const filteredTables = useMemo(() => {
    if (!dsBanKhongGop) return [];
    
    return dsBanKhongGop.filter(
      table =>
        table.maBan !== idBan && // Don't show the current table
        table.tenBan.toLowerCase().includes(searchQuery.toLowerCase()),
    );
  }, [dsBanKhongGop, idBan, searchQuery]);

  return (
    // <View style={styles.container}>
    //   <WrapHeader
    //     title={`Chi Tiết Đơn Hàng - ${maBan}`}
    //     handleBack={() => navigation.goBack()}>
    //     {selectedItems.length > 0 && (
    //       <Appbar.Action
    //         icon="swap-horizontal"
    //         onPress={handleShowTableModal}
    //         disabled={submitStatus === 'pending'}
    //       />
    //     )}
    //   </WrapHeader>

    //   <View style={styles.selectAllContainer}>
    //     <TouchableOpacity
    //       style={styles.selectAllButton}
    //       onPress={toggleSelectAll}>
    //       <Checkbox status={allSelected ? 'checked' : 'unchecked'} />
    //       <Text style={styles.selectAllText}>Chọn Tất Cả</Text>
    //     </TouchableOpacity>
    //   </View>

    //   {/* <Loading loading={isLoading}> */}
    //   <Loading loading={false}>
    //     {orderItems && orderItems.length > 0 ? (
    //       <FlatList
    //         data={orderItems}
    //         keyExtractor={item => item.maCt}
    //         renderItem={({item}) => (
    //           <TouchableOpacity
    //             style={styles.itemRow}
    //             onPress={() => toggleItem(item.maCt)}>
    //             <Checkbox
    //               status={
    //                 selectedItems.includes(item.maCt) ? 'checked' : 'unchecked'
    //               }
    //               onPress={() => toggleItem(item.maCt)}
    //             />
    //             <View style={styles.itemDetails}>
    //               <Text style={styles.itemName}>{item.tenSp}</Text>
    //               <View style={styles.itemInfo}>
    //                 <Text>SL: {item.soLuong}</Text>
    //                 <Text style={styles.price}>
    //                   {item.donGia ? numeral(item.donGia).format() + 'đ' : ''}
    //                 </Text>
    //               </View>
    //             </View>
    //           </TouchableOpacity>
    //         )}
    //       />
    //     ) : (
    //       <View style={styles.emptyState}>
    //         <Text>Không có món nào trong đơn hàng</Text>
    //       </View>
    //     )}
    //   </Loading>

    //   {selectedItems.length > 0 && (
    //     <View style={styles.footer}>
    //       <Button
    //         mode="contained"
    //         style={styles.submitButton}
    //         onPress={handleShowTableModal}
    //         loading={submitStatus === 'pending'}
    //         disabled={submitStatus === 'pending'}>
    //         Chuyển {selectedItems.length} Món
    //       </Button>
    //     </View>
    //   )}

    <View style={styles.container}>
      <WrapHeader
        title={`Chuyển món bàn ${idBan}`}
        handleBack={() => navigation.goBack()}>
        {/* {selectedItems.length > 0 && (
          <Appbar.Action
            icon="check"
            onPress={handleSubmit}
            // disabled={isSubmitting}
          />
        )} */}
      </WrapHeader>

      <View style={styles.selectAllContainer}>
        <TouchableOpacity
          style={styles.selectAllButton}
          onPress={toggleSelectAll}>
          <Checkbox status={allSelected ? 'checked' : 'unchecked'} />
          <Text style={styles.selectAllText}>Chọn Tất Cả</Text>
        </TouchableOpacity>
      </View>

      {/* <Loading loading={status === 'pending'}> */}
      <Loading loading={false}>
        {orderItems && orderItems.length > 0 ? (
          <FlatList
            data={orderItems}
            keyExtractor={item => item.maCt}
            renderItem={({item}) => (
              <TouchableOpacity
                style={styles.itemRow}
                onPress={() => toggleItem(item.maCt)}>
                <Checkbox
                  status={
                    selectedItems.includes(item.maCt) ? 'checked' : 'unchecked'
                  }
                  onPress={() => toggleItem(item.maCt)}
                />
                <View style={styles.itemDetails}>
                  <Text style={styles.itemName}>{item.tenSp}</Text>
                  <View style={styles.itemInfo}>
                    <Text>SL: {item.soLuong}</Text>

                    <Text style={styles.price}>
                      {numeral(item.giaBan).format()} đ
                      {/* {item.donGia.toLocaleString('vi-VN')} đ */}
                    </Text>
                  </View>
                </View>
              </TouchableOpacity>
            )}
          />
        ) : (
          <View style={styles.emptyState}>
            <Text>Không có món nào trong đơn hàng</Text>
          </View>
        )}
      </Loading>

      {selectedItems.length > 0 && (
        <View style={styles.footer}>
          <Button
            mode="contained"
            style={styles.submitButton}
            onPress={handleShowTableModal}
            // loading={isSubmitting}
            // disabled={isSubmitting}
          >
            Chuyển {selectedItems.length} Món
          </Button>
        </View>
      )}

      {/* Modal for table selection */}
      <Modal
        animationType="slide"
        transparent={true}
        visible={modalVisible}
        onRequestClose={() => setModalVisible(false)}>
        <View style={styles.modalContainer}>
          <View style={styles.modalContent}>
            <WrapHeader
              title="Chọn Bàn Đích"
              handleBack={() => setModalVisible(false)}
            />

            <Searchbar
              placeholder="Tìm bàn..."
              onChangeText={setSearchQuery}
              value={searchQuery}
              style={styles.searchBar}
            />

            <Loading loading={tablesLoading}>
              {filteredTables.length > 0 ? (
                <FlatList
                  data={filteredTables}
                  keyExtractor={item => item.maBan}
                  renderItem={({item}) => (
                    <TouchableOpacity
                      style={[
                        styles.tableItem,
                        selectedDestinationTable === item.maBan &&
                          styles.selectedTableItem,
                      ]}
                      onPress={() => handleTableSelect(item.maBan)}>
                      <Text style={styles.tableName}>{item.tenBan}</Text>
                      {item.khuVuc && (
                        <Text style={styles.tableArea}>{item.khuVuc}</Text>
                      )}
                      {selectedDestinationTable === item.maBan && (
                        <View style={styles.checkmark}>
                          <Text style={styles.checkmarkText}>✓</Text>
                        </View>
                      )}
                    </TouchableOpacity>
                  )}
                  numColumns={2}
                  contentContainerStyle={styles.tableGrid}
                />
              ) : (
                <View style={styles.emptyState}>
                  <Text>Không tìm thấy bàn phù hợp</Text>
                </View>
              )}
            </Loading>

            <View style={styles.modalFooter}>
              <Button
                mode="outlined"
                onPress={() => setModalVisible(false)}
                style={styles.modalButton}>
                Hủy
              </Button>
              <Button
                mode="contained"
                onPress={handleSubmitChuyenMon}
                disabled={
                  !selectedDestinationTable || submitStatus === 'pending'
                }
                loading={submitStatus === 'pending'}
                style={styles.modalButton}>
                Xác Nhận
              </Button>
            </View>
          </View>
        </View>
      </Modal>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  selectAllContainer: {
    backgroundColor: '#fff',
    paddingHorizontal: 16,
    paddingVertical: 12,
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
  },
  selectAllButton: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  selectAllText: {
    marginLeft: 8,
    fontSize: 16,
  },
  itemRow: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 12,
    paddingHorizontal: 16,
    backgroundColor: '#fff',
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
  },
  itemDetails: {
    flex: 1,
    marginLeft: 12,
  },
  itemName: {
    fontSize: 16,
    fontWeight: '500',
  },
  itemInfo: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 4,
  },
  price: {
    fontWeight: '500',
  },
  emptyState: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  footer: {
    padding: 16,
    backgroundColor: '#fff',
    borderTopWidth: 1,
    borderTopColor: '#eee',
  },
  submitButton: {
    paddingVertical: 8,
  },
  // Modal styles
  modalContainer: {
    flex: 1,
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
  },
  modalContent: {
    flex: 1,
    backgroundColor: '#fff',
    marginTop: 50,
    borderTopLeftRadius: 20,
    borderTopRightRadius: 20,
    overflow: 'hidden',
  },
  searchBar: {
    margin: 16,
    elevation: 0,
    backgroundColor: '#f5f5f5',
  },
  tableGrid: {
    padding: 8,
  },
  tableItem: {
    flex: 1,
    margin: 8,
    padding: 16,
    backgroundColor: '#f5f5f5',
    borderRadius: 8,
    alignItems: 'center',
    justifyContent: 'center',
    minHeight: 100,
    position: 'relative',
  },
  selectedTableItem: {
    backgroundColor: '#e6f7ff',
    borderColor: '#1890ff',
    borderWidth: 1,
  },
  tableName: {
    fontSize: 16,
    fontWeight: 'bold',
    textAlign: 'center',
  },
  tableArea: {
    fontSize: 14,
    color: '#666',
    marginTop: 4,
    textAlign: 'center',
  },
  checkmark: {
    position: 'absolute',
    top: 8,
    right: 8,
    width: 20,
    height: 20,
    borderRadius: 10,
    backgroundColor: '#1890ff',
    alignItems: 'center',
    justifyContent: 'center',
  },
  checkmarkText: {
    color: '#fff',
    fontSize: 12,
    fontWeight: 'bold',
  },
  modalFooter: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    padding: 16,
    borderTopWidth: 1,
    borderTopColor: '#eee',
  },
  modalButton: {
    flex: 1,
    marginHorizontal: 8,
  },
});

export default DanhSachChuyenMon;
