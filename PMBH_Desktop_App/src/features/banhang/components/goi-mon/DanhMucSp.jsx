import { FlatList, Pressable, StyleSheet, Text, View } from 'react-native';
import { danhMucSp } from '../../types';

type select = {
  index: number;
  maDanhMucSp: string;
};

interface DanhMucSpProps {
  data: danhMucSp[];
  select: select;
  setSelect: ({index, maDanhMucSp}: select) => void;
}

const DanhMucSp = ({data, select, setSelect}: DanhMucSpProps) => {
  return (
    <View style={styles.categoryTabs}>
      <FlatList
        data={data}
        horizontal
        showsHorizontalScrollIndicator={false}
        renderItem={({item, index}) => (
          <Pressable
            onPress={() => setSelect({index, maDanhMucSp: item.maDanhMucSp})}
            style={[
              styles.categoryTab,
              select.index == index ? styles.activeTab : '',
            ]}
            key={index}>
            <Text
              style={[
                styles.categoryTabText,
                select.index == index ? styles.activeTabText : '',
              ]}>
              {item.tenDanhMucSp}
            </Text>
          </Pressable>
        )}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  categoryTabs: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    paddingHorizontal: 10,
    marginVertical: 8,
  },
  categoryTab: {
    backgroundColor: 'white',
    paddingVertical: 2,
    paddingHorizontal: 13,
    borderRadius: 15,
    marginRight: 10,
  },
  activeTab: {
    backgroundColor: '#dee6ff',
    borderWidth: 1,
    borderColor: '#5874eb',
  },
  activeTabText: {
    color: '#3168da',
  },

  categoryTabText: {
    color: '#6b7280',
    fontSize: 13,
    paddingHorizontal: 10,
    paddingVertical: 5,
    marginHorizontal: 5,
  },
  inactiveTabText: {
    color: 'black',
  },
});

export default DanhMucSp;
