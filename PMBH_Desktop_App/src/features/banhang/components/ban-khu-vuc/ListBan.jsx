import {FlatList, ScrollView, StyleSheet, View, RefreshControl} from 'react-native';
import {Text} from 'react-native-paper';
import Ban from './Ban';
import BanGop from './BanGop';
import {useState} from 'react';

interface listBan {
  maBan: string;
  tenBan: string;
  khuVuc: string;
  maKhuVuc: string;
  hoaDon: {
    maCt: string;
    soLuong: string;
    donGia: string;
    ngayOrder: string;
    maHoaDon: string;
    trangThai: string;
    gioVao: string;
  }[];
}

interface listBanProps {
  listBan: listBan[];
  listBanGop: listBan[];
  fetchAllData: () => void;
}

const ListBan = ({listBan, listBanGop, fetchAllData}: listBanProps) => {
  const [isRefreshing, setIsRefreshing] = useState(false);

  const onRefresh = async () => {
    setIsRefreshing(true);
    try {
      await fetchAllData();
    } catch (error) {
      console.error('Lỗi khi refresh dữ liệu bàn:', error);
    } finally {
      setIsRefreshing(false);
    }
  };

  return (
    <ScrollView 
      style={styles.content}
      refreshControl={
        <RefreshControl
          refreshing={isRefreshing}
          onRefresh={onRefresh}
          colors={['#3498db']} // Android
          // tintColor={'#3498db'} // iOS
          // title="Đang tải lại..." // iOS
          // titleColor={'#3498db'} // iOS
        />
      }
    >
      <Text style={styles.sectionTitle}>Danh sách bàn</Text>
      <FlatList
        data={listBan}
        renderItem={({item}) => <Ban item={item} />}
        keyExtractor={item => item.maBan}
        numColumns={2}
        scrollEnabled={false}
      />

      {listBanGop.length > 0 && (
        <View style={styles.mergedTablesSection}>
          <Text style={styles.sectionTitle}>Danh sách bàn gộp</Text>
          <FlatList
            data={listBanGop}
            renderItem={({item}) => (
              <BanGop item={item} fetchAllData={fetchAllData} />
            )}
            keyExtractor={item => item.maBan}
            numColumns={1}
            scrollEnabled={false}
          />
        </View>
      )}
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  content: {
    flex: 1,
    padding: 12,
  },
  sectionTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 12,
    color: '#1e293b',
  },
  mergedTablesSection: {
    marginTop: 20,
  },
});
export default ListBan;
