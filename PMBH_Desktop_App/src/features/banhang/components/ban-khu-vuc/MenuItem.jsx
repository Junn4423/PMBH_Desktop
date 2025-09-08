import {NavigationProp, useNavigation} from '@react-navigation/native';
import {useState} from 'react';
import {Appbar, Menu} from 'react-native-paper';
import {RootStackParamList} from '../../../../types/navigation';

type item = {
  title: string;
};

interface Menu {
  listMenu: item[];
}

const MenuItem = () => {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const [visible, setVisible] = useState(false);
  return (
    <Menu
      visible={visible}
      onDismiss={() => setVisible(false)}
      anchor={
        <Appbar.Action
          color="#fff"
          icon="dots-vertical"
          onPress={() => setVisible(true)}
        />
      }
      style={{marginTop: 20}}
      contentStyle={{
        backgroundColor: '#fff', // màu nền menu
        borderRadius: 8, // bo góc cho đẹp
      }}>
      <Menu.Item
        onPress={() => {
          setVisible(false);
          nav.navigate('GopBan');
        }}
        title="Gộp Bàn"
      />
      <Menu.Item
        onPress={() => {
          setVisible(false);
          nav.navigate('ChuyenBan');
        }}
        title="Chuyển Bàn"
      />
      <Menu.Item
        onPress={() => {
          setVisible(false);
          nav.navigate('ChuyenMon');
        }}
        title="Chuyển món"
      />
    </Menu>
  );
};

export default MenuItem;
