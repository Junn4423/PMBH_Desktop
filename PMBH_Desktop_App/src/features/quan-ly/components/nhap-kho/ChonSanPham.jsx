/* eslint-disable react-hooks/exhaustive-deps */
import {FlatList, StyleSheet, TextInput, View} from 'react-native';
import {Text} from 'react-native-paper';
import useFetchApi from '../../hooks/useFetchApi';
import {loadSanPhamTheoIdKho} from '../../api/index';
import {useEffect, useState} from 'react';
import RenderNguyenLieu from './RenderNguyenLieu';
import {nguyenLieuKho} from '../../types';

const ChonSanPham = ({
  handleNguyenLieu,
  maKho,
}: {
  handleNguyenLieu: (item: nguyenLieuKho) => void;
  maKho: string;
}) => {
  const {data, refetch} = useFetchApi(() => loadSanPhamTheoIdKho({maKho}));

  useEffect(() => {
    refetch();
  }, [maKho]);
  const [tuKhoa, setTuKhoa] = useState<string>('');

  const filtered =
    data &&
    data.filter(
      item =>
        item.tenSp.toLowerCase().includes(tuKhoa.toLowerCase()) ||
        item.maSp.toLowerCase().includes(tuKhoa.toLowerCase()),
    );
  return (
    <View>
      <Text style={styles.modalTitle}>Chọn nguyên liệu</Text>
      <View style={styles.searchContainer}>
        <TextInput
          style={styles.searchInput}
          placeholder="Tìm kiếm ..."
          value={tuKhoa}
          onChangeText={setTuKhoa}
          autoCapitalize="none"
          clearButtonMode="while-editing"
        />
        {/* {searchQuery.length > 0 && (
          <TouchableOpacity
            style={styles.clearSearch}
            onPress={() => setSearchQuery('')}>
            <Text style={styles.clearSearchText}>✕</Text>
          </TouchableOpacity>
        )} */}
      </View>

      <Text style={styles.resultCount}>
        {filtered && filtered.length} Nguyên liệu được tìm thấy
      </Text>

      <FlatList
        data={filtered}
        renderItem={({item}) => (
          <RenderNguyenLieu
            item={item}
            handleChonSanPham={() => handleNguyenLieu(item)}
          />
        )}
        keyExtractor={item => item.maSp}
        style={styles.modalList}
        ListEmptyComponent={
          <View style={styles.emptySearch}>
            <Text style={styles.emptySearchText}>
              Không tìm thấy nguyên liệu nào phù hợp
            </Text>
          </View>
        }
      />
    </View>
  );
};

const styles = StyleSheet.create({
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
    color: '#4CAF50',
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
    backgroundColor: '#4CAF50',
    borderRadius: 4,
    padding: 10,
    alignItems: 'center',
    marginTop: 16,
  },
  modalCloseButtonText: {
    color: 'white',
    fontWeight: 'bold',
  },
  searchContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#f5f5f5',
    borderRadius: 8,
    marginBottom: 12,
    paddingHorizontal: 12,
    borderWidth: 1,
    borderColor: '#e0e0e0',
  },
  searchInput: {
    flex: 1,
    height: 40,
    fontSize: 16,
  },
  clearSearch: {
    padding: 6,
  },
  clearSearchText: {
    fontSize: 16,
    color: '#757575',
  },
  resultCount: {
    marginBottom: 8,
    fontSize: 14,
    color: '#757575',
  },
  emptySearch: {
    padding: 20,
    alignItems: 'center',
  },
  emptySearchText: {
    fontSize: 16,
    color: '#9e9e9e',
    textAlign: 'center',
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
});

export default ChonSanPham;
