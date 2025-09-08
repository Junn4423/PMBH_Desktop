import React, { useCallback, useState } from 'react';
import { SafeAreaView, View, StyleSheet } from 'react-native';
import { Searchbar } from 'react-native-paper';
import HeaderOption from '../components/HeaderOption';
import ListPersonnel from '../components/ListPersonnel';
import {RootStackParamList} from '../../../types/navigation';
import {
  NavigationProp,
  useFocusEffect,
  useNavigation,
} from '@react-navigation/native';
import WrapHeader from '../../../components/WrapHeader.component';

const Personnel: React.FC = () => {
  const navigation = useNavigation<NavigationProp<RootStackParamList>>();
  const [refreshKey, setRefreshKey] = useState<number>(0);
  const [searchQuery, setSearchQuery] = useState<string>('');

  useFocusEffect(
    useCallback(() => {
      setRefreshKey(prev => prev + 1);
    }, [])
  );

  const handleAdd = () => {
    navigation.navigate('AddPersonnel');
  };

  const handleReload = () => {
    console.log('Tải lại danh sách');
    setRefreshKey(prev => prev + 1);
  };

  const handleReport = () => {
    console.log('Xem báo cáo');
  };

  const handleExport = () => {
    console.log('Xuất dữ liệu');
  };

  return (
    <View style={styles.container}>
      <WrapHeader
        title="Quản lí nhân sự"
        handleBack={() => navigation.goBack()}></WrapHeader>
    <SafeAreaView style={{ flex: 1 }}>
      <HeaderOption
        onAdd={handleAdd}
        onReload={handleReload}
        onReport={handleReport}
        onExport={handleExport}
      />

      <Searchbar
        style={styles.searchBar}
        placeholder="Tìm kiếm nhân sự"
        onChangeText={setSearchQuery}
        value={searchQuery}
      />

      <View style={styles.listContainer}>
        <ListPersonnel refreshKey={refreshKey} searchQuery={searchQuery} />
      </View>
    </SafeAreaView>
    </View>
  );
};

const styles = StyleSheet.create({
  listContainer: {
    flex: 1,
    paddingHorizontal: 10,
  },
  searchBar: {
    marginTop: 8,
    marginStart: 8,
    marginEnd: 8,
  },
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  }
});

export default Personnel;
