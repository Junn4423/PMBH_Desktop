/* eslint-disable react-native/no-inline-styles */
import {FlatList, StyleSheet, Text, View} from 'react-native';
import theme from '../../../../theme';
import WrapHeader from '../../../../components/WrapHeader.component';
import {Cart} from '../../components/quan-ly';
import {LIST_MENU} from '../../../../constants';
import {usePermissions} from '../../../auth/hooks/usePermissions';

function QuanLy() {
  const {hasPermission, hasFullAccess} = usePermissions();

  // Hàm kiểm tra quyền truy cập cho từng menu item
  const hasAccessToMenuItem = (nav: string) => {
    switch (nav) {
      // Bếp/Bar - cho BAR, PHACHE, admin, QUANLY
      case 'Bep':
        return hasPermission('KITCHEN_BAR_ACCESS') || hasFullAccess();

      // Quản lý bàn/khu vực - cho admin, QUANLY
      case 'QuanLyBan':
      case 'QuanLyKhuVuc':
      case 'ThemBan':
        return hasFullAccess();

      // Quản lý kho - cho KETOAN, admin, QUANLY
      case 'QuanLyKho':
      case 'NhapKho':
      case 'XuatKho':
      case 'KiemKho':
      case 'DanhSachLoaiNguyenLieu':
      case 'QrDanhSachNguyenLieu':
      case 'QrDanhSachSanPham':
        return hasPermission('WAREHOUSE_MANAGEMENT') || hasFullAccess();

      // Quản lý nhân sự - chỉ admin, QUANLY
      case 'NhanSu':
        return hasFullAccess();

      default:
        return hasFullAccess();
    }
  };

  // Lọc menu theo quyền
  const filteredMenu = LIST_MENU.map(section => ({
    ...section,
    menu: section.menu.filter(item => hasAccessToMenuItem(item.nav)),
  })).filter(section => section.menu.length > 0); // Chỉ hiển thị section có ít nhất 1 item

  return (
    <View style={styles.container}>
      <WrapHeader title="Quản lý" />
      <View style={{flex: 1, marginTop: 10}}>
        {filteredMenu.length === 0 ? (
          <View style={styles.noAccessContainer}>
            <Text style={styles.noAccessText}>
              Bạn không có quyền truy cập các chức năng quản lý
            </Text>
          </View>
        ) : (
          <FlatList
            data={filteredMenu}
            keyExtractor={(item, index) => index.toString()}
            renderItem={({item}) => (
              <View style={styles.section}>
                <Text style={styles.sectionTitle}>{item.name}</Text>
                <View style={styles.menuContainer}>
                  {item.menu.map((subItem, index) => (
                    <Cart
                      key={index}
                      nameIcon={subItem.icon}
                      text={subItem.name}
                      color={subItem.color}
                      route={subItem.nav}
                    />
                  ))}
                </View>
              </View>
            )}
          />
        )}
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
  },
  section: {
    paddingHorizontal: theme.spacing.medium,
    paddingVertical: 10,
  },
  sectionTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 8,
  },
  menuContainer: {
    gap: 6,
    flexDirection: 'row', // Các phần tử trong một hàng ngang
    flexWrap: 'wrap', // Cho phép các phần tử chuyển sang hàng mới khi không đủ không gian
    justifyContent: 'space-between', // Phân bổ khoảng cách đều giữa các phần tử
  },
  noAccessContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  noAccessText: {
    fontSize: 16,
    textAlign: 'center',
    color: '#666',
  },
});
export default QuanLy;
