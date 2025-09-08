import {
  NavigationProp,
  useFocusEffect,
  useNavigation,
} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import numeral from 'numeral';
import {useCallback} from 'react';
import {
  ActivityIndicator,
  StyleSheet,
  TouchableOpacity,
  View,
} from 'react-native';
import {Button, Icon, Text} from 'react-native-paper';
import WrapHeader from '../../../../components/WrapHeader.component';
import {RootStackParamList} from '../../../../types/navigation';
import {layDsMonCho} from '../../api';

function Bep() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();

  const {mutate, data, isPending, error} = useMutation({
    mutationFn: layDsMonCho,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({});
    }, []),
  );

  return (
    <View style={styles.container}>
      <WrapHeader title={'Bếp'} handleBack={() => nav.goBack()} />
      <View>
        <View style={styles.menuGrid}>
          <TouchableOpacity
            style={styles.menuItem}
            onPress={() => nav.navigate('NhomMonNuoc')}>
            <View style={styles.menuIcon}>
              <Icon source="glass-cocktail" size={32} color="#5c6bc0" />
            </View>
            <Text style={styles.menuText}>Nhóm món nước</Text>
          </TouchableOpacity>

          <TouchableOpacity
            style={styles.menuItem}
            onPress={() => nav.navigate('NhomMonAn')}>
            <View style={styles.menuIcon}>
              <Icon source="pot-steam" size={32} color="#4caf50" />
            </View>
            <Text style={styles.menuText}>Nhóm món ăn</Text>
          </TouchableOpacity>
        </View>

        {isPending ? (
          <View style={styles.loadingContainer}>
            <ActivityIndicator animating={true} size="large" color="#5c6bc0" />
            <Text style={styles.loadingText}>Đang tải dữ liệu...</Text>
          </View>
        ) : error ? (
          <View style={styles.errorContainer}>
            <Icon source="alert-circle" size={48} color="#f44336" />
            {/* <Text style={styles.errorText}>{error}</Text> */}
            <Button
              mode="contained"
              onPress={() => mutate({})}
              style={styles.retryButton}>
              Thử lại
            </Button>
          </View>
        ) : data && data.length > 0 ? (
          <View style={styles.itemsPreviewContainer}>
            <View style={styles.itemsPreviewHeader}>
              <Text style={styles.itemsPreviewTitle}>Món đang chờ làm</Text>
              {/* <Button
                compact
                mode="text"
                onPress={() => nav.navigate('NhomMon')}
                contentStyle={{flexDirection: 'row', alignItems: 'center'}}
                labelStyle={{color: '#5c6bc0'}}
                icon="chevron-right">
                Xem tất cả
              </Button> */}
            </View>

            {data &&
              data.slice(0, 10).map((item: any, index: number) => (
                <View key={`${item.id}-${index}`} style={styles.itemPreviewCard}>
                  <View style={styles.itemPreviewHeader}>
                    <Text style={styles.itemPreviewTable}>{item.banOrder}</Text>
                    <Text style={styles.itemPreviewTime}>{item.orderTime}</Text>
                  </View>
                  <View style={styles.itemPreviewContent}>
                    <Text style={styles.itemPreviewName}>{item.tenNuoc}</Text>
                    <Text style={styles.itemPreviewQuantity}>
                      {'sl: ' + item.soLuong}
                    </Text>
                  </View>
                  <View style={styles.itemPreviewFooter}>
                    <View style={styles.elapsedTimeContainer}>
                      <Text style={styles.elapsedTimeText}>
                        {numeral(item.gia).format() + 'vnd'}
                      </Text>
                    </View>
                  </View>
                </View>
              ))}
          </View>
        ) : (
          <View style={styles.emptyContainer}>
            <Icon source="information-outline" size={48} color="#ccc" />
            <Text style={styles.emptyText}>Không có món nào cần làm</Text>
          </View>
        )}
      </View>
    </View>
  );
}
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
  },
  headerTitle: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#333',
  },
  switchButton: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#ff7043',
    paddingHorizontal: 12,
    paddingVertical: 8,
    borderRadius: 8,
  },
  menuGrid: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    padding: 8,
  },
  menuItem: {
    width: '33.33%',
    padding: 8,
  },
  menuIcon: {
    backgroundColor: '#fff',
    borderRadius: 12,
    padding: 16,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 8,
    elevation: 2,
  },
  menuText: {
    textAlign: 'center',
    fontWeight: 'bold',
    color: '#333',
  },
  statsContainer: {
    flexDirection: 'row',
    padding: 16,
    justifyContent: 'space-between',
  },
  statCard: {
    backgroundColor: '#fff',
    borderRadius: 8,
    padding: 16,
    alignItems: 'center',
    width: '30%',
    elevation: 2,
  },
  statValue: {
    fontSize: 24,
    fontWeight: 'bold',
    color: '#5c6bc0',
    marginBottom: 4,
  },
  statLabel: {
    fontSize: 12,
    color: '#666',
    textAlign: 'center',
  },
  loadingContainer: {
    padding: 40,
    alignItems: 'center',
  },
  loadingText: {
    marginTop: 10,
    color: '#666',
  },
  errorContainer: {
    padding: 40,
    alignItems: 'center',
  },
  errorText: {
    marginTop: 10,
    color: '#f44336',
    textAlign: 'center',
    marginBottom: 20,
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
  emptyContainer: {
    padding: 40,
    alignItems: 'center',
  },
  emptyText: {
    marginTop: 16,
    color: '#999',
    textAlign: 'center',
    fontSize: 16,
  },
  itemsPreviewContainer: {
    padding: 16,
  },
  itemsPreviewHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 12,
  },
  itemsPreviewTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
  },
  viewAllButton: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  viewAllButtonText: {
    color: '#5c6bc0',
    marginRight: 4,
    fontSize: 14,
  },
  itemPreviewCard: {
    backgroundColor: '#fff',
    borderRadius: 8,
    padding: 12,
    marginBottom: 8,
    elevation: 2,
  },
  itemPreviewHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  itemPreviewTable: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#333',
  },
  itemPreviewTime: {
    fontSize: 12,
    color: '#666',
  },
  itemPreviewContent: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 8,
  },
  itemPreviewName: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
  },
  itemPreviewQuantity: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#5c6bc0',
  },
  itemPreviewFooter: {
    alignItems: 'flex-start',
  },
  elapsedTimeContainer: {
    backgroundColor: '#FFC107',
    padding: 5,
    borderRadius: 4,
  },
  elapsedTimeText: {
    color: '#333',
    fontSize: 12,
  },
});
export default Bep;
