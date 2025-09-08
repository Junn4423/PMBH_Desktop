import {FlatList, StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import {khuVuc} from '../../types';

interface KhuVucProps {
  selectKhucVuc: string;
  listKhuVuc: khuVuc[];
  onSelectArea: (maKhuVuc: string) => void;
}

const KhuVuc = ({selectKhucVuc, listKhuVuc, onSelectArea}: KhuVucProps) => {
  return (
    <View style={styles.container}>
      <FlatList
        data={listKhuVuc}
        keyExtractor={item => item.maKhuVuc}
        horizontal
        showsHorizontalScrollIndicator={false}
        contentContainerStyle={styles.flatListContent}
        renderItem={({item}) => {
          const isSelected = selectKhucVuc === item.maKhuVuc;
          return (
            <TouchableOpacity
              style={[styles.chip, isSelected && styles.chipSelected]}
              onPress={() => onSelectArea(item.maKhuVuc)}>
              <Text
                style={[
                  styles.chipText,
                  isSelected && styles.chipTextSelected,
                ]}>
                {item.tenKhuVuc}
              </Text>
            </TouchableOpacity>
          );
        }}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    paddingVertical: 8,
    paddingHorizontal: 12,
    backgroundColor: '#ffffff',
  },
  flatListContent: {
    paddingHorizontal: 4,
  },
  chip: {
    paddingVertical: 8,
    paddingHorizontal: 16,
    backgroundColor: '#f2f2f2',
    borderRadius: 20,
    borderWidth: 1,
    borderColor: '#ccc',
    marginRight: 8,
  },
  chipSelected: {
    backgroundColor: '#5c6bc0',
    borderColor: '#5c6bc0',
  },
  chipText: {
    fontSize: 14,
    color: '#333',
  },
  chipTextSelected: {
    color: '#fff',
    fontWeight: 'bold',
  },
});

export default KhuVuc;
