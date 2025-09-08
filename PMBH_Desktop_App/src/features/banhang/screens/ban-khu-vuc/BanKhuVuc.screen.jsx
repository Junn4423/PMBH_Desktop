import {useFocusEffect} from '@react-navigation/native';
import {useMutation} from '@tanstack/react-query';
import {useCallback, useMemo, useState} from 'react';
import {StyleSheet, View} from 'react-native';
import Loading from '../../../../components/Loading.component';
import WrapHeader from '../../../../components/WrapHeader.component';
import {loadKhuVuc} from '../../api';
import {KhuVuc, ListBan, MenuItem} from '../../components/ban-khu-vuc';
import useFetchBanKhuVuc from '../../hooks/useFetchBanKhuVuc';
import theme from '../../../../theme';

function BanKhuVuc() {
  const {dsBanKhongGop, dsBanGop, loading, fetchAllData} = useFetchBanKhuVuc();
  const [selectKhuVuc, setSelectKhuVuc] = useState('ALL');

  const onSelectArea = (maKhuVuc: string) => {
    setSelectKhuVuc(maKhuVuc); // Cập nhật state khu vực đã chọn
  };

  const {mutate, data} = useMutation({
    mutationFn: loadKhuVuc,
  });

  useFocusEffect(
    useCallback(() => {
      mutate({});
      fetchAllData();
    }, []),
  );

  const filteredDataKhongGop = useMemo(() => {
    if (dsBanKhongGop) {
      if (selectKhuVuc === 'ALL') return dsBanKhongGop;
      return dsBanKhongGop.filter(item => item.maKhuVuc === selectKhuVuc);
    }
  }, [dsBanKhongGop, selectKhuVuc]);

  return (
    <View style={styles.container}>
      <WrapHeader title="Bán Hàng">
        <MenuItem />
      </WrapHeader>
      <Loading loading={loading}>
        <KhuVuc
          selectKhucVuc={selectKhuVuc}
          onSelectArea={onSelectArea}
          listKhuVuc={[
            {maKhuVuc: 'ALL', tenKhuVuc: 'Tất cả'}, // thêm thủ công ở đầu
            ...(data ?? []),
          ]}
        />
        <ListBan
          listBanGop={dsBanGop ?? []}
          listBan={filteredDataKhongGop ?? []}
          fetchAllData={fetchAllData}
        />
      </Loading>
    </View>
  );
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: theme.colors.mainBg,
  },
});

export default BanKhuVuc;
