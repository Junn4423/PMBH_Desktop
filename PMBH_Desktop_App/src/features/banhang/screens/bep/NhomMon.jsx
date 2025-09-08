import type React from 'react';
import {useCallback, useEffect, useState} from 'react';
import {
  Alert,
  FlatList,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';

import numeral from 'numeral';
import WrapHeader from '../../../../components/WrapHeader.component';
import {useMutation} from '@tanstack/react-query';
import {layDsMonCho, updateTrangThai} from '../../api';
import {
  NavigationProp,
  useFocusEffect,
  useNavigation,
} from '@react-navigation/native';
import {useToast} from '../../../../context/ToastProvider';
import {TEXT_TOAST} from '../../../../constants';
import {RootStackParamList} from '../../../../types/navigation';

type Item = {
  tenNuoc: string;
  soLuong: string;
  gia: string;
  thoiGian: string;
  banOrder: string;
  idBan: string;
};

const NhomMon: React.FC = () => {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const [data, setData] = useState<any>();
  const {mutate, isPending} = useMutation({
    mutationFn: layDsMonCho,
    onSuccess: data => {
      const grouped = groupByBan(data);
      const listData = Object.keys(grouped).map(idBan => ({
        idBan,
        banOrder: grouped[idBan].banOrder,
        items: grouped[idBan].items,
      }));
      setData(listData);
    },
  });

  useFocusEffect(
    useCallback(() => {
      mutate({});
    }, []),
  );

  function groupByBan(data: Item[]) {
    const grouped: Record<string, {banOrder: string; items: Item[]}> = {};

    data.forEach(item => {
      if (!grouped[item.idBan]) {
        grouped[item.idBan] = {
          banOrder: item.banOrder,
          items: [],
        };
      }
      grouped[item.idBan].items.push(item);
    });

    return grouped;
  }

  const {showToast} = useToast();
  const {mutate: capNhaMon} = useMutation({
    mutationFn: updateTrangThai,
    onSuccess: () => {
      showToast('Cập nhập món thành công', 'success');
      setTimeout(() => mutate({}), 300);
    },
    onError: () => {
      showToast(TEXT_TOAST.err, 'error');
    },
  });
  const handle = async (item: any) => {
    await capNhaMon({itemId: item});
  };

  const renderItem = ({item}: {item: any}) => (
    <View style={styles.itemRow}>
      <View style={styles.itemInfo}>
        <View style={styles.itemNameContainer}>
          <Text style={styles.itemName}>{item.tenNuoc}</Text>
        </View>
        <Text style={styles.itemQuantity}>{numeral(item.gia).format()}</Text>
        {item.note && (
          <View style={styles.noteContainer}>
            <Text style={styles.noteText}>{item.ghiChu}</Text>
          </View>
        )}
        {/* <View style={styles.timeContainer}>
          <Text style={styles.timeText}>{item.elapsedTime}</Text>
        </View> */}
      </View>
      <TouchableOpacity
        style={styles.completeButton}
        onPress={() => handle(item.idCthd)}>
        <Text style={styles.completeButtonText}>Xong</Text>
      </TouchableOpacity>
    </View>
  );

  const renderTableGroup = ({item}: {item: any}) => (
    <View style={styles.tableGroup}>
      <View style={styles.tableHeader}>
        <Text style={styles.tableName}>{item.banOrder}</Text>
        <Text style={styles.itemCount}>{item.items.length} món</Text>
      </View>
      <FlatList
        data={item.items}
        renderItem={renderItem}
        keyExtractor={item => item.id}
        scrollEnabled={false}
      />
    </View>
  );

  return (
    <View style={{flex: 1}}>
      <WrapHeader title="Theo Nhóm Món"></WrapHeader>
      <FlatList
        data={data}
        renderItem={renderTableGroup}
        keyExtractor={item => item.idBan}
        contentContainerStyle={styles.listContainer}
        ListEmptyComponent={
          <View style={styles.emptyContainer}>
            <Text style={styles.emptyText}>Không có món nào cần làm</Text>
          </View>
        }
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 16,
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
    backgroundColor: '#fff',
  },
  headerTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#333',
  },
  headerRight: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  headerItemCount: {
    fontSize: 14,
    color: '#5c6bc0',
    fontWeight: 'bold',
    marginRight: 8,
  },
  loader: {
    marginLeft: 8,
  },
  errorContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  errorText: {
    color: '#f44336',
    textAlign: 'center',
    fontSize: 16,
    marginVertical: 16,
  },
  retryButton: {
    backgroundColor: '#5c6bc0',
    paddingVertical: 10,
    paddingHorizontal: 20,
    borderRadius: 4,
  },
  retryButtonText: {
    color: '#fff',
    fontWeight: 'bold',
  },
  listContainer: {
    padding: 8,
    paddingBottom: 80, // Space for footer
  },
  emptyContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 40,
    marginTop: 40,
  },
  emptyText: {
    marginTop: 16,
    color: '#999',
    textAlign: 'center',
    fontSize: 16,
  },
  tableGroup: {
    backgroundColor: '#fff',
    borderRadius: 8,
    marginBottom: 16,
    overflow: 'hidden',
    elevation: 2,
  },
  tableHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 12,
    backgroundColor: '#5c6bc0',
  },
  tableName: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#fff',
  },
  itemCount: {
    fontSize: 14,
    color: '#fff',
    fontWeight: 'bold',
  },
  itemRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 12,
    borderBottomWidth: 1,
    borderBottomColor: '#eee',
  },
  itemInfo: {
    flex: 1,
    marginRight: 8,
  },
  itemNameContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 4,
  },
  itemName: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
    marginRight: 8,
  },
  typeIndicator: {
    width: 20,
    height: 20,
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  foodIndicator: {
    backgroundColor: '#5c6bc0',
  },
  drinkIndicator: {
    backgroundColor: '#ff7043',
  },
  itemCode: {
    fontSize: 12,
    color: '#666',
    marginBottom: 4,
  },
  itemQuantity: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#5c6bc0',
    marginBottom: 4,
  },
  noteContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 4,
  },
  noteText: {
    marginLeft: 4,
    fontSize: 12,
    color: '#666',
    fontStyle: 'italic',
  },
  timeContainer: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  timeText: {
    marginLeft: 4,
    fontSize: 12,
    color: '#ff9800',
    fontWeight: 'bold',
  },
  completeButton: {
    backgroundColor: '#4CAF50',
    paddingVertical: 8,
    paddingHorizontal: 16,
    borderRadius: 4,
  },
  completeButtonText: {
    color: '#fff',
    fontWeight: 'bold',
    fontSize: 14,
  },
  footer: {
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    padding: 16,
    backgroundColor: '#fff',
    borderTopWidth: 1,
    borderTopColor: '#eee',
    alignItems: 'center',
  },
  refreshButton: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#5c6bc0',
    paddingVertical: 10,
    paddingHorizontal: 20,
    borderRadius: 4,
  },
  refreshButtonText: {
    color: '#fff',
    fontWeight: 'bold',
    marginLeft: 8,
  },
});

export default NhomMon;
