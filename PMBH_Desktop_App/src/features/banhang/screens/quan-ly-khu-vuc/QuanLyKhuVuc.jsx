import { useNavigation } from '@react-navigation/native';
import { StyleSheet, View } from 'react-native';
import WrapHeader from '../../../../components/WrapHeader.component';
import theme from '../../../../theme';
import { FormKhuVuc } from '../../components/quan-ly-khu-vuc';

function QuanLyKhuVuc() {
  const nav = useNavigation();
  return (
    <View style={styles.container}>
      <WrapHeader
        title="Quản lý khu vực"
        handleBack={() => nav.goBack()}></WrapHeader>
      <View style={{flex: 1}}>
        <FormKhuVuc />
      </View>
    </View>
  );
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
  },
});
export default QuanLyKhuVuc;
