/* eslint-disable @typescript-eslint/no-unused-vars */
import React, {useEffect, useState} from 'react';
import {FlatList, StyleSheet, View} from 'react-native';
import {
  Appbar,
  Card,
  Searchbar,
  Text,
  Title,
  Paragraph,
  Divider,
  Surface,
} from 'react-native-paper';
import {StackNavigationProp} from '@react-navigation/stack';
import {useNavigation} from '@react-navigation/native';
import {loadKho} from '../../api/index';
import {RootStackParamList} from '../../../../types/navigation';
import {kho} from '../../types';
import theme from '../../../../theme';

type NavigationProp = StackNavigationProp<RootStackParamList>;

const KiemKho = () => {
  const navigation = useNavigation<NavigationProp>();
  const [danhSachKho, setDanhSachKho] = useState<kho[]>([]);
  const [tuKhoa, setTuKhoa] = useState<string>('');
  const [reloadData, setReloadData] = useState(false);

  // Chuyển đến màn hình danh sách sản phẩm của kho
  const chuyenDenKiemKeSP = async (khoId: string, tenKho: string) => {
    //@ts-ignore
    navigation.navigate('KiemKeSPKho', {
      maKho: khoId,
      tenKho,
    });
  };

  const danhSachKhoLoc = danhSachKho.filter(kho => {
    // Kiểm tra xem các thuộc tính có tồn tại không trước khi gọi toLowerCase()
    const tenKho = kho.tenKho ? kho.tenKho.toLowerCase() : '';
    const maKho = kho.maKho ? kho.maKho.toLowerCase() : '';
    const tuKhoaLowerCase = tuKhoa.toLowerCase();

    return tenKho.includes(tuKhoaLowerCase) || maKho.includes(tuKhoaLowerCase);
  });

  useEffect(() => {
    const layDuLieuKho = async () => {
      try {
        const rawData = await loadKho();
        console.log('Data:', rawData);
        setDanhSachKho(rawData);
      } catch (error) {
        console.error('Lỗi khi tải dữ liệu kho:', error);
      }
    };
    layDuLieuKho();
  }, [reloadData]);

  const hienThiKho = ({item}: {item: kho}) => (
    <Card
      style={styles.itemKho}
      onPress={() => chuyenDenKiemKeSP(item.maKho, item.tenKho)}>
      <Card.Content>
        <View style={styles.headerItem}>
          <Text style={styles.maKho}>{item.maKho}</Text>
        </View>
        <Title style={styles.tenKho}>{item.tenKho}</Title>
        <Paragraph style={styles.tenCongTy}>{item.tenCongTy}</Paragraph>
        <Divider style={styles.divider} />
        <View style={styles.infoContainer}>
          <Text style={styles.thongTinKho}>Địa chỉ: {item.viTriKho}</Text>
          <Text style={styles.thongTinKho}>Mã thủ kho: {item.maThuKho}</Text>
        </View>
      </Card.Content>
    </Card>
  );

  return (
    <Surface style={styles.container}>
      <Appbar.Header style={styles.header}>
        <Appbar.BackAction onPress={() => navigation.goBack()} color="white" />
        <Appbar.Content
          title="CHỌN KHO CẦN KIỂM"
          titleStyle={styles.headerTitle}
        />
      </Appbar.Header>

      <Searchbar
        placeholder="Tìm kiếm theo tên hoặc mã kho..."
        onChangeText={setTuKhoa}
        value={tuKhoa}
        style={styles.searchBar}
        iconColor={theme.colors.primary}
      />

      {danhSachKhoLoc.length > 0 ? (
        <FlatList
          data={danhSachKhoLoc}
          renderItem={hienThiKho}
          keyExtractor={item => item.maKho}
          style={styles.listContainer}
          contentContainerStyle={styles.listContentContainer}
        />
      ) : (
        <View style={styles.noData}>
          <Text style={styles.textNoData}>
            Không tìm thấy kho nào phù hợp với từ khóa tìm kiếm
          </Text>
        </View>
      )}
    </Surface>
  );
};

export default KiemKho;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  header: {
    backgroundColor: theme.colors.primary,
    elevation: 4,
  },
  headerTitle: {
    color: 'white',
    fontWeight: 'bold',
    fontSize: 18,
  },
  searchBar: {
    margin: 16,
    elevation: 2,
  },
  listContainer: {
    flex: 1,
  },
  listContentContainer: {
    padding: 8,
  },
  itemKho: {
    marginHorizontal: 8,
    marginVertical: 4,
    borderLeftWidth: 4,
    borderLeftColor: theme.colors.primary,
    elevation: 2,
  },
  headerItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  maKho: {
    fontWeight: 'bold',
    fontSize: 14,
    color: theme.colors.primary,
  },
  tenKho: {
    fontSize: 18,
    marginBottom: 4,
  },
  tenCongTy: {
    fontSize: 14,
    color: '#424242',
    marginBottom: 8,
  },
  divider: {
    marginVertical: 8,
  },
  infoContainer: {
    marginTop: 8,
  },
  thongTinKho: {
    fontSize: 14,
    color: '#757575',
    marginBottom: 4,
  },
  noData: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  textNoData: {
    fontSize: 16,
    color: '#757575',
    textAlign: 'center',
  },
});
