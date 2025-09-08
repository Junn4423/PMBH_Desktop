import {useNavigation} from '@react-navigation/native';
import {View, Text, StyleSheet, Pressable} from 'react-native';
import {Icon} from 'react-native-paper';

interface CardProps {
  text: string;
  nameIcon: string;
  color: string;
  route?: any;
}

const Cart = ({text, nameIcon, color, route}: CardProps) => {
  const nav = useNavigation();

  const handlePress = () => {
    if (route) {
      nav.navigate(route as never); // ép kiểu nếu cần
    }
  };

  return (
    <Pressable style={styles.container} onPress={handlePress}>
      <View style={styles.wrap}>
        <Icon source={nameIcon} color={color} size={35} />
        <Text style={styles.text}>{text}</Text>
      </View>
    </Pressable>
  );
};

const styles = StyleSheet.create({
  container: {
    width: '23%',
    backgroundColor: '#fff',
    borderRadius: 10,
  },
  wrap: {
    paddingVertical: 10,
    flexDirection: 'column',
    justifyContent: 'center',
    alignItems: 'center',
    gap: 2,
  },

  text: {
    color: 'black',
    fontSize: 12,
  },
});

export default Cart;
