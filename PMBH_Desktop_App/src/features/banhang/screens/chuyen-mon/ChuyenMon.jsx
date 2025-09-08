import {
  NavigationProp,
  RouteProp,
  useFocusEffect,
  useNavigation,
} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import {useCallback} from 'react';
import {
  Dimensions,
  FlatList,
  StyleSheet,
  TouchableOpacity,
  View,
} from 'react-native';
import {Text} from 'react-native-paper';
import Loading from '../../../../components/Loading.component';
import WrapHeader from '../../../../components/WrapHeader.component';
import {useToast} from '../../../../context/ToastProvider';
import {loadDsCthdV2} from '../../api';
import useFetchBanKhuVuc from '../../hooks/useFetchBanKhuVuc';
import {RootStackParamList} from '../../../../types/navigation';
const {width} = Dimensions.get('window');
type GoiMonRouteProp = RouteProp<RootStackParamList, 'DanhSachChuyenMon'>;
function ChuyenMon() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const {dsBanKhongGop, loading, fetchAllData} = useFetchBanKhuVuc();
  const handleSelect = (maBan: string, maHoaDon: string) => {
    nav.navigate('DanhSachChuyenMon', {idHoaDon: maHoaDon, idBan: maBan});
    console.log('maHoaDon', maHoaDon);
    console.log('maBan', maBan);
  };
  const {showToast} = useToast();
  return (
    <View style={styles.container}>
      <WrapHeader
        title="Chuyển Món"
        handleBack={() => nav.goBack()}></WrapHeader>

      <View style={{flex: 1, padding: 12}}>
        <Loading loading={loading}>
          <FlatList
            data={dsBanKhongGop}
            renderItem={({item}) => (
              <TouchableOpacity
                style={[styles.tableCard]}
                onPress={() => {
                  handleSelect(item.maBan, item.hoaDon[0]?.maHoaDon);
                }}>
                <View style={styles.tableTop}>
                  <Text style={styles.tableName}>{item.tenBan}</Text>
                </View>

                <View style={styles.tableContent}>
                  <View style={styles.tableInner}></View>
                </View>
              </TouchableOpacity>
            )}
            keyExtractor={item => item.maBan}
            numColumns={3}
            scrollEnabled={false}
          />
        </Loading>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  tableCard: {
    width: (width - 48) / 3,
    height: (width - 48) / 3,
    margin: 4,
    borderRadius: 8,
    borderWidth: 2,
    padding: 8,
    justifyContent: 'space-between',
  },
  tableTop: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  tableName: {
    fontSize: 15,
    fontWeight: 'bold',
    color: '#333',
  },
  tableContent: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  tableInner: {
    width: '90%',
    height: '70%',
    backgroundColor: 'rgba(255, 255, 255, 0.8)',
    borderRadius: 4,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 4,
    position: 'relative',
  },
  tableAmount: {
    fontSize: 12,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 2,
    textAlign: 'center',
  },
  tableOrderCount: {
    fontSize: 10,
    color: '#666',
    textAlign: 'center',
  },
  tableTime: {
    fontSize: 12,
    color: '#666',
  },
});
export default ChuyenMon;
