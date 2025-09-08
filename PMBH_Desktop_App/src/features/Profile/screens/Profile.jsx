import {Alert, StyleSheet, View} from 'react-native';
import {Avatar, Button, Card, Divider, Text} from 'react-native-paper';
import {useAuthStore} from '../../auth/store/login.store';
import {usePermissions} from '../../auth/hooks/usePermissions';
import useLogoutApi from '../hooks/useLogout';
import theme from '../../../theme';
import WrapHeader from '../../../components/WrapHeader.component';

function Profile() {
  const {user} = useAuthStore();
  const {getRoleDisplayName, getUserRole} = usePermissions();
  const {loading, logoutUser} = useLogoutApi();

  const handleLogout = () => {
    Alert.alert(
      'Xác nhận đăng xuất',
      'Bạn có chắc chắn muốn đăng xuất khỏi ứng dụng?',
      [
        {
          text: 'Hủy',
          style: 'cancel',
        },
        {
          text: 'Đăng xuất',
          style: 'destructive',
          onPress: logoutUser,
        },
      ],
    );
  };

  return (
    <View style={styles.container}>
      <WrapHeader title="Thông tin cá nhân" />
      
      <View style={styles.content}>
        {/* User Info Card */}
        <Card style={styles.userCard}>
          <Card.Content style={styles.userInfo}>
            <Avatar.Icon 
              size={80} 
              icon="account" 
              style={styles.avatar}
            />
            <View style={styles.userDetails}>
              <Text variant="headlineSmall" style={styles.userName}>
                Người dùng
              </Text>
              <Text variant="bodyMedium" style={styles.userRole}>
                {getRoleDisplayName()}
              </Text>
              <Text variant="bodySmall" style={styles.roleCode}>
                Mã quyền: {getUserRole()}
              </Text>
            </View>
          </Card.Content>
        </Card>

        <Divider style={styles.divider} />

        {/* Account Info */}
        <Card style={styles.infoCard}>
          <Card.Content>
            <Text variant="titleMedium" style={styles.sectionTitle}>
              Thông tin tài khoản
            </Text>
            <View style={styles.infoRow}>
              <Text variant="bodyMedium" style={styles.label}>
                Trạng thái:
              </Text>
              <Text variant="bodyMedium" style={[styles.value, styles.activeStatus]}>
                Đang hoạt động
              </Text>
            </View>
          </Card.Content>
        </Card>

        {/* Logout Button */}
        <Button
          mode="contained"
          onPress={handleLogout}
          loading={loading}
          disabled={loading}
          icon="logout"
          style={styles.logoutButton}
          buttonColor="#e53e3e"
          textColor="white"
        >
          {loading ? 'Đang đăng xuất...' : 'Đăng xuất'}
        </Button>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
  },
  content: {
    flex: 1,
    padding: 16,
  },
  userCard: {
    marginBottom: 16,
    elevation: 2,
  },
  userInfo: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  avatar: {
    backgroundColor: theme.colors.primary,
    marginRight: 16,
  },
  userDetails: {
    flex: 1,
  },
  userName: {
    fontWeight: 'bold',
    marginBottom: 4,
  },
  userRole: {
    color: theme.colors.primary,
    marginBottom: 2,
  },
  roleCode: {
    color: '#666',
  },
  divider: {
    marginVertical: 16,
  },
  infoCard: {
    marginBottom: 24,
    elevation: 1,
  },
  sectionTitle: {
    fontWeight: 'bold',
    marginBottom: 12,
  },
  infoRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 8,
  },
  label: {
    fontWeight: '500',
    flex: 1,
  },
  value: {
    flex: 2,
    textAlign: 'right',
  },
  activeStatus: {
    color: '#22c55e',
    fontWeight: '500',
  },
  logoutButton: {
    marginTop: 'auto',
    marginBottom: 20,
    paddingVertical: 8,
  },
});

export default Profile;
