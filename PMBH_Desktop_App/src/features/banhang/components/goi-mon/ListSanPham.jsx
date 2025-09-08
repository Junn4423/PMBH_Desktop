import React, {useMemo, useState} from 'react';
import {
  FlatList,
  Image,
  StyleSheet,
  Text,
  TextInput,
  TouchableOpacity,
  View,
} from 'react-native';
import {sanPham} from '../../types';
import MaterialCommunityIcons from 'react-native-vector-icons/MaterialCommunityIcons';
import theme from '../../../../theme';

interface ListSanPhamProps {
  dataSp: sanPham[] | null;
  handelSelectSp: (item: sanPham) => void;
}

const ListSanPham = ({dataSp, handelSelectSp}: ListSanPhamProps) => {
  const [searchText, setSearchText] = useState('');

  // Lọc sản phẩm theo từ khóa tìm kiếm
  const filteredData = useMemo(() => {
    if (!dataSp) return [];
    return dataSp.filter(item =>
      item.tenSp.toLowerCase().includes(searchText.toLowerCase()),
    );
  }, [searchText, dataSp]);

  return (
    <View style={{flex: 1}}>
      {/* Ô tìm kiếm */}
      <TextInput
        placeholder="Tìm sản phẩm..."
        value={searchText}
        onChangeText={setSearchText}
        style={styles.searchInput}
        placeholderTextColor="#999"
      />

      <FlatList
        data={filteredData}
        keyExtractor={(item, index) => index.toString()}
        initialNumToRender={10}
        maxToRenderPerBatch={10}
        windowSize={10}
        contentContainerStyle={styles.menuList}
        ListEmptyComponent={
          <Text style={styles.emptyText}>Không tìm thấy sản phẩm</Text>
        }
        renderItem={({item}) => (
          <View style={styles.wrapItem}>
            <View style={styles.menuItem}>
              <View style={styles.menuItems}>
                <Image
                  source={{uri: item.hinhAnh || ''}}
                  style={styles.menuItemImage}
                />
                <View style={styles.menuItemInfo}>
                  <Text style={styles.menuItemName}>{item.tenSp}</Text>
                  <Text style={styles.menuItemPrice}>
                    {item.giaBan.toLocaleString()}/{item.dvtGia}/{item.dvt}
                  </Text>
                </View>
              </View>

              <TouchableOpacity
                onPress={() => handelSelectSp(item)}
                style={styles.addButton}
                activeOpacity={0.7}>
                <MaterialCommunityIcons
                  name="cart-plus"
                  size={15}
                  color="white"
                />
              </TouchableOpacity>
            </View>
          </View>
        )}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  searchInput: {
    height: 40,
    borderColor: '#ddd',
    borderWidth: 1,
    borderRadius: 8,
    paddingHorizontal: 10,
    margin: 10,
    fontSize: 14,
    backgroundColor: '#f9f9f9',
    color: '#333',
  },
  menuList: {
    flexGrow: 1,
    alignItems: 'stretch',
  },
  wrapItem: {
    backgroundColor: 'white',
  },
  menuItem: {
    paddingHorizontal: 16,
    paddingVertical: 5,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    borderBottomWidth: 1,
    borderColor: '#ddd',
    gap: 10,
  },
  menuItems: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
  },
  menuItemImage: {
    width: 60,
    height: 60,
    borderRadius: 5,
  },
  menuItemInfo: {
    flexDirection: 'column',
    gap: 25,
  },
  menuItemName: {
    fontSize: 12,
  },
  menuItemPrice: {
    fontSize: 13,
    fontWeight: '600',
  },
  emptyText: {
    textAlign: 'center',
    fontSize: 18,
    color: '#888',
    marginTop: 20,
    paddingBottom: 20,
  },
  addButton: {
    backgroundColor: theme.colors.primary,
    padding: 4,
    borderRadius: 5,
  },
});

export default ListSanPham;
