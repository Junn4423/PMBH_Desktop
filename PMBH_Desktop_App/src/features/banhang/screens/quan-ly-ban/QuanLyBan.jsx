import {StyleSheet, Text, View} from 'react-native';
import theme from '../../../../theme';
import WrapHeader from '../../../../components/WrapHeader.component';
import {useNavigation} from '@react-navigation/native';
import {FormThemBan} from '../../components/quan-ly-ban';

function QuanLyBan() {
  const nav = useNavigation();
  return (
    <View style={styles.container}>
      <WrapHeader
        title="Quản lý bàn"
        handleBack={() => nav.goBack()}></WrapHeader>
      <View style={{flex: 1}}>
        <FormThemBan />
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
export default QuanLyBan;
