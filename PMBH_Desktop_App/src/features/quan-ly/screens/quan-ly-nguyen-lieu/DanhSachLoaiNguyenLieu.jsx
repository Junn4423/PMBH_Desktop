/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable @typescript-eslint/no-shadow */
/* eslint-disable no-catch-shadow */
/* eslint-disable react-native/no-inline-styles */
import {useState, useEffect, useRef} from 'react';
import {
  View,
  StyleSheet,
  FlatList,
  ScrollView,
  Dimensions,
  TouchableOpacity,
} from 'react-native';
import {
  Appbar,
  Text,
  Card,
  Button,
  Dialog,
  Portal,
  TextInput,
  Checkbox,
  Snackbar,
  ActivityIndicator,
  Searchbar,
  Menu,
  TouchableRipple,
  Icon,
} from 'react-native-paper';
import {layAll_LoaiNVL, themLoaiNguyenLieu, xoaLoaiNVL} from '../../api/index';
import {loaiNguyenLieu} from '../../types/index';
import {useNavigation} from '@react-navigation/native';
import {StackNavigationProp} from '@react-navigation/stack';
const DanhSachLoaiNguyenLieu = () => {
  const navigation = useNavigation();

  const [categories, setCategories] = useState<loaiNguyenLieu[]>([]);
  const [loading, setLoading] = useState(true);
  const [visible, setVisible] = useState(false);
  const [maLoai, setMaLoai] = useState('');
  const [moTa, setMoTa] = useState('');
  const [maLoaiCha, setMaLoaiCha] = useState('');
  const [tenLoaiCha, setTenLoaiCha] = useState('');
  const [trangThai, setTrangThai] = useState(1);
  const [searchQuery, setSearchQuery] = useState('');
  const [snackbarVisible, setSnackbarVisible] = useState(false);
  const [snackbarMessage, setSnackbarMessage] = useState('');
  const [parentCategoryMenuVisible, setParentCategoryMenuVisible] =
    useState(false);
  const [error, setError] = useState('');
  const [deleteDialogVisible, setDeleteDialogVisible] = useState(false);
  const [categoryToDelete, setCategoryToDelete] =
    useState<loaiNguyenLieu | null>(null);

  const parentInputRef = useRef<View>(null);
  const [menuPosition, setMenuPosition] = useState({x: 0, y: 0});

  useEffect(() => {
    fetchCategories();
  }, []);

  const fetchCategories = async () => {
    try {
      setLoading(true);
      setError('');
      const sanPhamData = await layAll_LoaiNVL<any[]>();
      setCategories(sanPhamData.flat());
    } catch (error) {
      setError('Không thể tải danh sách loại nguyên liệu');
    } finally {
      setLoading(false);
    }
  };

  const handleAddCategory = async () => {
    if (!maLoai || !moTa) {
      setError('Vui lòng nhập đầy đủ thông tin bắt buộc');
      return;
    }

    try {
      setLoading(true);
      await themLoaiNguyenLieu({maLoai, moTa, maLoaiCha, trangThai});
      setVisible(false);
      clearForm();
      fetchCategories();
      showSnackbar('Thêm loại nguyên liệu thành công');
    } catch (error) {
      console.error('Error adding category:', error);
      setError('Không thể thêm loại nguyên liệu');
    } finally {
      setLoading(false);
    }
  };

  const handleDeleteCategory = async () => {
    if (!categoryToDelete) {
      return;
    }

    try {
      setLoading(true);
      await xoaLoaiNVL(categoryToDelete.id);
      setDeleteDialogVisible(false);
      fetchCategories();
      showSnackbar('Xóa loại nguyên liệu thành công');
    } catch (error) {
      console.error('Error deleting category:', error);
      setError('Không thể xóa loại nguyên liệu');
    } finally {
      setLoading(false);
      setCategoryToDelete(null);
    }
  };

  const showDeleteDialog = (category: loaiNguyenLieu) => {
    setCategoryToDelete(category);
    setDeleteDialogVisible(true);
  };

  const hideDeleteDialog = () => {
    setDeleteDialogVisible(false);
    setCategoryToDelete(null);
  };

  const clearForm = () => {
    setMaLoai('');
    setMoTa('');
    setMaLoaiCha('');
    setTenLoaiCha('');
    setTrangThai(1);
    setError('');
  };

  const showDialog = () => setVisible(true);
  const hideDialog = () => {
    setVisible(false);
    clearForm();
  };

  const showSnackbar = (message: string) => {
    setSnackbarMessage(message);
    setSnackbarVisible(true);
  };

  const onChangeSearch = (query: string) => setSearchQuery(query);

  const filteredCategories = categories.filter(
    category =>
      category.id.toLowerCase().includes(searchQuery.toLowerCase()) ||
      category.tenLoai.toLowerCase().includes(searchQuery.toLowerCase()),
  );

  const selectParentCategory = (category: loaiNguyenLieu) => {
    setMaLoaiCha(category.id);
    setTenLoaiCha(category.tenLoai);
    setParentCategoryMenuVisible(false);
  };

  const openParentCategoryMenu = () => {
    if (parentInputRef.current) {
      parentInputRef.current.measure(
        (
          x: any,
          y: any,
          width: any,
          height: any,
          pageX: number,
          pageY: number,
        ) => {
          setMenuPosition({x: pageX, y: pageY + height});
          setParentCategoryMenuVisible(true);
        },
      );
    } else {
      setParentCategoryMenuVisible(true);
    }
  };

  const parentCategoryOptions = categories.filter(cat => true);

  const screenWidth = Dimensions.get('window').width;

  const navigateToAddMaterial = () => {
    // @ts-ignore
    navigation.navigate('ThemNguyenLieu');
  };
  const navigateDanhSachNguyenLieu = (category: loaiNguyenLieu) => {
    // @ts-ignore
    navigation.navigate('DanhSachNguyenLieu', {
      maLoai: category.id,
      tenLoai: category.tenLoai,
    });
  };
  return (
    <View style={styles.container}>
      <Appbar.Header style={styles.appbar}>
        <Appbar.BackAction onPress={() => navigation.goBack()} color="#FFF" />
        <Appbar.Content
          title="Quản lý loại nguyên liệu"
          titleStyle={styles.appbarTitle}
        />
        <Appbar.Action icon="refresh" onPress={fetchCategories} color="#FFF" />
        <Appbar.Action icon="plus" onPress={showDialog} color="#FFF" />
      </Appbar.Header>

      <View style={styles.content}>
        <Searchbar
          placeholder="Tìm kiếm loại nguyên liệu"
          onChangeText={onChangeSearch}
          value={searchQuery}
          style={styles.searchBar}
          inputStyle={styles.searchInput}
          iconColor="#666"
        />

        {loading && categories.length === 0 ? (
          <View style={styles.loadingContainer}>
            <ActivityIndicator size="large" color="#2196F3" />
            <Text style={styles.loadingText}>Đang tải dữ liệu...</Text>
          </View>
        ) : error ? (
          <View style={styles.errorContainer}>
            <Icon source="alert-circle" size={40} color="#FF5252" />
            <Text style={styles.errorText}>{error}</Text>
            <Button
              mode="contained"
              onPress={fetchCategories}
              style={styles.retryButton}
              buttonColor="#2196F3"
              textColor="#FFF">
              Thử lại
            </Button>
          </View>
        ) : (
          <FlatList
            data={filteredCategories}
            keyExtractor={item => item.id}
            contentContainerStyle={styles.listContainer}
            renderItem={({item}) => (
              <TouchableRipple onPress={() => navigateDanhSachNguyenLieu(item)}>
                <Card style={styles.card}>
                  <Card.Content style={styles.cardContent}>
                    <View style={styles.cardHeader}>
                      <View>
                        <Text variant="titleMedium" style={styles.cardTitle}>
                          {item.id}
                        </Text>
                        <Text variant="bodyMedium" style={styles.cardSubtitle}>
                          {item.tenLoai}
                        </Text>
                        {item.maLoaiCha && (
                          <Text
                            variant="bodySmall"
                            style={styles.parentCategory}>
                            Loại cha: {item.maLoaiCha}
                          </Text>
                        )}
                      </View>
                      <Button
                        icon="delete"
                        mode="text"
                        onPress={() => showDeleteDialog(item)}
                        textColor="#FF5252"
                        style={styles.deleteButton}
                        labelStyle={styles.deleteButtonLabel}>
                        Xóa
                      </Button>
                    </View>
                  </Card.Content>
                </Card>
              </TouchableRipple>
            )}
            ListEmptyComponent={
              <View style={styles.emptyContainer}>
                <Icon source="inbox" size={40} color="#666" />
                <Text style={styles.emptyText}>
                  Không có loại nguyên liệu nào
                </Text>
              </View>
            }
          />
        )}
      </View>

      <Portal>
        <Dialog visible={visible} onDismiss={hideDialog} style={styles.dialog}>
          <Dialog.Title style={styles.dialogTitle}>
            Thêm loại nguyên liệu mới
          </Dialog.Title>
          <Dialog.Content>
            <TextInput
              label="Mã loại *"
              value={maLoai}
              onChangeText={setMaLoai}
              mode="outlined"
              style={styles.input}
              left={<TextInput.Icon icon="identifier" />}
              theme={{colors: {primary: '#2196F3'}}}
            />
            <TextInput
              label="Mô tả *"
              value={moTa}
              onChangeText={setMoTa}
              mode="outlined"
              style={styles.input}
              left={<TextInput.Icon icon="text" />}
              theme={{colors: {primary: '#2196F3'}}}
            />
            <View
              style={styles.parentCategoryContainer}
              ref={parentInputRef}
              collapsable={false}>
              <TouchableRipple onPress={openParentCategoryMenu}>
                <TextInput
                  label="Mã loại cha"
                  value={
                    maLoaiCha
                      ? `${maLoaiCha}${tenLoaiCha ? ` - ${tenLoaiCha}` : ''}`
                      : ''
                  }
                  mode="outlined"
                  style={styles.parentCategoryInput}
                  editable={false}
                  left={<TextInput.Icon icon="sitemap" />}
                  right={
                    <TextInput.Icon
                      icon="menu-down"
                      onPress={openParentCategoryMenu}
                    />
                  }
                  theme={{colors: {primary: '#2196F3'}}}
                />
              </TouchableRipple>
            </View>
            <View style={styles.checkboxContainer}>
              <Text style={styles.checkboxTitle}>Trạng thái:</Text>
              <View style={styles.checkboxRow}>
                <Checkbox
                  status={trangThai === 1 ? 'checked' : 'unchecked'}
                  onPress={() => setTrangThai(1)}
                  color="#2196F3"
                />
                <Text style={styles.checkboxLabel}>Hoạt động</Text>
              </View>
              <View style={styles.checkboxRow}>
                <Checkbox
                  status={trangThai === 0 ? 'checked' : 'unchecked'}
                  onPress={() => setTrangThai(0)}
                  color="#2196F3"
                />
                <Text style={styles.checkboxLabel}>Không hoạt động</Text>
              </View>
            </View>
            {error ? <Text style={styles.errorText}>{error}</Text> : null}
          </Dialog.Content>
          <Dialog.Actions style={styles.dialogActions}>
            <Button onPress={hideDialog} textColor="#666">
              Hủy
            </Button>
            <Button
              onPress={handleAddCategory}
              loading={loading}
              mode="contained"
              buttonColor="#2196F3"
              textColor="#FFF">
              Thêm
            </Button>
          </Dialog.Actions>
        </Dialog>
      </Portal>

      <Portal>
        <Dialog
          visible={deleteDialogVisible}
          onDismiss={hideDeleteDialog}
          style={styles.dialog}>
          <Dialog.Title style={styles.dialogTitle}>Xác nhận xóa</Dialog.Title>
          <Dialog.Content>
            <Text style={styles.dialogText}>
              Bạn có chắc chắn muốn xóa loại nguyên liệu "
              {categoryToDelete?.tenLoai}" không?
            </Text>
          </Dialog.Content>
          <Dialog.Actions style={styles.dialogActions}>
            <Button onPress={hideDeleteDialog} textColor="#666">
              Hủy
            </Button>
            <Button
              onPress={handleDeleteCategory}
              textColor="#FFF"
              mode="contained"
              buttonColor="#FF5252">
              Xóa
            </Button>
          </Dialog.Actions>
        </Dialog>
      </Portal>

      <Portal>
        <Menu
          visible={parentCategoryMenuVisible}
          onDismiss={() => setParentCategoryMenuVisible(false)}
          anchor={menuPosition}
          contentStyle={[
            styles.parentCategoryMenu,
            {width: screenWidth * 0.8},
          ]}>
          {parentCategoryOptions.length > 0 ? (
            <ScrollView style={{maxHeight: 300}}>
              {parentCategoryOptions.map(category => (
                <Menu.Item
                  key={category.id}
                  onPress={() => selectParentCategory(category)}
                  title={`${category.id} - ${category.tenLoai}`}
                  style={styles.menuItem}
                  leadingIcon="sitemap"
                />
              ))}
            </ScrollView>
          ) : (
            <Menu.Item title="Không có loại nguyên liệu" disabled={true} />
          )}
        </Menu>
      </Portal>

      <Snackbar
        visible={snackbarVisible}
        onDismiss={() => setSnackbarVisible(false)}
        duration={3000}
        style={styles.snackbar}
        action={{
          label: 'OK',
          onPress: () => setSnackbarVisible(false),
        }}>
        {snackbarMessage}
      </Snackbar>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F5F7FA',
  },
  appbar: {
    backgroundColor: '#2196F3',
    elevation: 4,
  },
  appbarTitle: {
    color: '#FFF',
    fontWeight: 'bold',
    fontSize: 20,
  },
  content: {
    flex: 1,
    padding: 16,
  },
  searchBar: {
    marginBottom: 16,
    borderRadius: 8,
    backgroundColor: '#FFF',
    elevation: 2,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 1},
    shadowOpacity: 0.1,
    shadowRadius: 2,
  },
  searchInput: {
    fontSize: 16,
    color: '#333',
  },
  listContainer: {
    paddingBottom: 80,
  },
  card: {
    marginBottom: 12,
    borderRadius: 12,
    backgroundColor: '#FFF',
    elevation: 3,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 2},
    shadowOpacity: 0.1,
    shadowRadius: 4,
  },
  cardContent: {
    padding: 16,
  },
  cardHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  cardTitle: {
    fontWeight: '600',
    color: '#333',
  },
  cardSubtitle: {
    color: '#555',
    marginTop: 4,
  },
  parentCategory: {
    marginTop: 8,
    color: '#777',
    fontStyle: 'italic',
  },
  deleteButton: {
    paddingHorizontal: 8,
  },
  deleteButtonLabel: {
    fontSize: 14,
    fontWeight: '500',
  },
  input: {
    marginBottom: 16,
    backgroundColor: '#FFF',
  },
  checkboxContainer: {
    marginTop: 12,
    marginBottom: 8,
  },
  checkboxTitle: {
    fontSize: 16,
    fontWeight: '500',
    color: '#333',
    marginBottom: 8,
  },
  checkboxRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginVertical: 4,
  },
  checkboxLabel: {
    marginLeft: 8,
    fontSize: 14,
    color: '#333',
  },
  loadingContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#F5F7FA',
    borderRadius: 12,
    padding: 20,
  },
  loadingText: {
    marginTop: 12,
    fontSize: 16,
    color: '#555',
  },
  errorContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#FFF',
    borderRadius: 12,
    padding: 20,
    elevation: 2,
  },
  errorText: {
    color: '#FF5252',
    fontSize: 16,
    marginVertical: 12,
    textAlign: 'center',
  },
  retryButton: {
    borderRadius: 8,
    paddingVertical: 4,
  },
  emptyContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
    backgroundColor: '#FFF',
    borderRadius: 12,
    elevation: 2,
  },
  emptyText: {
    marginTop: 12,
    fontSize: 16,
    color: '#666',
  },
  parentCategoryContainer: {
    position: 'relative',
    marginBottom: 16,
  },
  parentCategoryInput: {
    width: '100%',
    backgroundColor: '#FFF',
  },
  parentCategoryMenu: {
    backgroundColor: '#FFF',
    borderRadius: 8,
    elevation: 4,
  },
  menuItem: {
    paddingVertical: 12,
    paddingHorizontal: 16,
  },
  fab: {
    position: 'absolute',
    margin: 16,
    right: 16,
    bottom: 16,
    backgroundColor: '#2196F3',
    borderRadius: 16,
    elevation: 6,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 4},
    shadowOpacity: 0.2,
    shadowRadius: 8,
  },
  dialog: {
    borderRadius: 12,
    backgroundColor: '#FFF',
    elevation: 4,
  },
  dialogTitle: {
    fontSize: 20,
    fontWeight: '600',
    color: '#333',
  },
  dialogText: {
    fontSize: 16,
    color: '#555',
  },
  dialogActions: {
    paddingHorizontal: 16,
    paddingBottom: 12,
  },
  snackbar: {
    backgroundColor: '#333',
    borderRadius: 8,
    margin: 16,
    elevation: 4,
  },
});

export default DanhSachLoaiNguyenLieu;
