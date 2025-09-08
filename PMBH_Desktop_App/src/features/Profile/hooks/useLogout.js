import {NavigationProp, useNavigation} from '@react-navigation/native';
import {useState} from 'react';
import {useToast} from '../../../context/ToastProvider';
import {RootStackParamList} from '../../../types/navigation';
import {useAuthStore} from '../../auth/store/login.store';
import {logoutApi} from '../api/logout.api';
import {logoutData} from '../types';

const useLogoutApi = () => {
  const {logout, user} = useAuthStore();
  const [loading, setLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const {showToast} = useToast();

  const logoutUser = async () => {
    if (!user?.token) {
      showToast('Không tìm thấy thông tin đăng nhập', 'error');
      return;
    }

    setLoading(true);
    setError(null);
    
    try {
      const logoutData: logoutData = {
        txtUserName: user.code,
        txtToken: user.token,
      };

      const response = await logoutApi(logoutData);
    //   console.log('Logout response:', response);
      
      // Kiểm tra response thành công
      if (response.success) {
        logout(); // Clear user data từ store
        nav.reset({
          index: 0,
          routes: [{name: 'Login'}],
        });
        showToast('Đăng xuất thành công', 'success');
      } else {
        showToast('Đăng xuất thất bại', 'error');
      }
    } catch (err) {
      setError('Failed to logout');
      console.log('Logout error:', err);
      showToast('Lỗi từ hệ thống khi đăng xuất', 'error');
    } finally {
      setLoading(false);
    }
  };

  return {loading, logoutUser, error};
};

export default useLogoutApi;
