/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react/no-unstable-nested-components */
/* eslint-disable react-native/no-inline-styles */
import {useState, useEffect} from 'react';
import {
  SafeAreaView,
  StatusBar,
  Share,
  Alert,
  ActivityIndicator,
  FlatList,
  StyleSheet,
  View,
} from 'react-native';
import {useNavigation, useRoute, RouteProp} from '@react-navigation/native';
import {
  Appbar,
  Button,
  Card,
  Text,
  Title,
  Paragraph,
  Divider,
  Chip,
  List,
  Surface,
  Caption,
} from 'react-native-paper';
import {
  layChiTietPhieuKiem,
  layDanhSachPhieuKiemKho,
  loadSanPhamTheoIdKho,
} from '../../api/index';

import {chiTietPhieuKiem, nguyenLieuKho, phieuKiemKho} from '../../types/index';

type BaoCaoRouteParams = {
  maKiemKho: string;
  tenKho: string;
};

const BaoCaoPK = () => {
  const navigation = useNavigation();
  const route =
    useRoute<RouteProp<Record<string, BaoCaoRouteParams>, string>>();
  const {maKiemKho, tenKho} = route.params || {};
  const [currentDate] = useState(new Date());
  const [loading, setLoading] = useState(true);
  const [phieuKiem, setPhieuKiem] = useState<phieuKiemKho | null>(null);
  const [chiTietPhieuKiem, setChiTietPhieuKiem] = useState<chiTietPhieuKiem[]>(
    [],
  );
  const [tenSanPhamMap, setTenSanPhamMap] = useState<Record<string, string>>(
    {},
  );
  const [dsSanPham, setDSSanPham] = useState<nguyenLieuKho[]>([]);
  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        const phieuKiemData = await layDanhSachPhieuKiemKho(
          phieuKiem?.maKho || '',
        );
        if (phieuKiemData) {
          setPhieuKiem(phieuKiemData.flat()[0]);
        }

        if (maKiemKho) {
          const rawData = await layChiTietPhieuKiem(maKiemKho);
          setChiTietPhieuKiem(rawData);
        }

        const sanPhamData = await loadSanPhamTheoIdKho({
          maKho: phieuKiem?.maKho || '',
        });
        setDSSanPham(sanPhamData);

        const tenMap: Record<string, string> = {};
        sanPhamData.forEach(sp => {
          tenMap[sp.maSp] = sp.tenSp;
        });
        setTenSanPhamMap(tenMap);
        setLoading(false);
      } catch (error) {
        console.error('Lỗi khi lấy dữ liệu:', error);
        setLoading(false);
        Alert.alert('Lỗi', 'Không thể tải dữ liệu báo cáo');
      }
    };

    fetchData();
  }, []);

  const formatDate = (dateString: string | undefined) => {
    return dateString || '';
  };

  const formatCurrentDate = (date: Date) => {
    return `${date.getDate().toString().padStart(2, '0')}/${(
      date.getMonth() + 1
    )
      .toString()
      .padStart(2, '0')}/${date.getFullYear()} ${date
      .getHours()
      .toString()
      .padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date
      .getSeconds()
      .toString()
      .padStart(2, '0')}`;
  };

  const formatNumber = (number: number | string): string => {
    const num = parseFloat(number.toString().replace(/[^0-9.-]+/g, ''));
    if (isNaN(num)) {
      return '0';
    }
    return num
      .toFixed(3)
      .replace(/\d(?=(\d{3})+\.)/g, '$&.')
      .slice(0, -1);
  };

  const layTenSanPham = (maSanPham: string): string => {
    return tenSanPhamMap[maSanPham] || maSanPham;
  };

  // Tính tổng sô slượng pm số lượng thực tế
  const calculateTotals = () => {
    let totalSLPM = 0;
    let totalSLThucTe = 0;

    chiTietPhieuKiem.forEach(item => {
      const slPM = parseFloat(
        item.slPM?.toString().replace(/[^0-9.-]+/g, '') || '0',
      );
      const slThucTe = parseFloat(
        item.soLuongThucTe?.toString().replace(/[^0-9.-]+/g, '') || '0',
      );
      totalSLPM += isNaN(slPM) ? 0 : slPM;
      totalSLThucTe += isNaN(slThucTe) ? 0 : slThucTe;
    });

    return {totalSLPM, totalSLThucTe};
  };

  const handleShare = async () => {
    try {
      const totals = calculateTotals();
      const reportText = `
GMAC COFFEE
Địa chỉ: Số 1, Đường Phú Mỹ, Phường 22, Q.Bình Thạnh, Tp. HCM

KIỂM KHO

Mã kiểm kho: ${phieuKiem?.maKiemKho || ''}
Mã kho: ${phieuKiem?.maKho || ''}
Mã NV: ${phieuKiem?.maNguoiDung || ''}
Chủ đề: ${phieuKiem?.chuDe || ''}
Ngày kiểm kho: ${formatDate(phieuKiem?.ngayKiem)}
Ghi nhận: ${phieuKiem?.ghiNhan || ''}
Trạng thái: ${phieuKiem?.trangThai === '0' ? 'Chưa hoàn thành' : 'Hoàn thành'}

Chi tiết sản phẩm:
${chiTietPhieuKiem
  .map(
    (item, index) =>
      `${index + 1}. ${layTenSanPham(item.maSanPham)} - SL PM: ${formatNumber(
        item.slPM || 0,
      )}, SL thực tế: ${formatNumber(item.soLuongThucTe || 0)}, Đơn vị: ${
        item.donViTinh || ''
      }`,
  )
  .join('\n')}

Tổng: SL PM: ${formatNumber(totals.totalSLPM)}, SL thực tế: ${formatNumber(
        totals.totalSLThucTe,
      )}

Ngày in: ${formatCurrentDate(currentDate)}
      `;

      await Share.share({
        message: reportText,
        title: `Báo cáo kiểm kho ${phieuKiem?.maKiemKho || ''}`,
      });
    } catch (error) {
      Alert.alert('Lỗi', 'Không thể chia sẻ báo cáo');
    }
  };

  const handleBack = () => navigation.goBack();
  const handlePrint = () =>
    Alert.alert('Thông báo', 'Chức năng in đang được phát triển');

  if (loading) {
    return (
      <SafeAreaView style={styles.loadingContainer}>
        <ActivityIndicator size="large" />
        <Caption style={styles.loadingText}>Đang tải báo cáo...</Caption>
      </SafeAreaView>
    );
  }

  const totals = calculateTotals();

  //Hiển thị sản phẩm
  const renderProductItem = ({
    item,
    index,
  }: {
    item: chiTietPhieuKiem;
    index: number;
  }) => (
    <Card style={styles.productCard} elevation={1}>
      <Card.Title
        title={layTenSanPham(item.maSanPham)}
        subtitle={`Mã SP: ${item.maSanPham}`}
        left={() => (
          <Chip style={styles.productNumber} textStyle={{color: 'white'}}>
            {index + 1}
          </Chip>
        )}
      />
      <Card.Content>
        <View style={styles.detailRow}>
          <View style={styles.detailItem}>
            <Caption style={styles.detailLabel}>SL PM</Caption>
            <Text style={styles.detailValue}>
              {formatNumber(item.slPM || 0)}
            </Text>
          </View>
          <View style={styles.detailItem}>
            <Caption style={styles.detailLabel}>SL thực tế</Caption>
            <Text style={styles.detailValue}>
              {formatNumber(item.soLuongThucTe || 0)}
            </Text>
          </View>
          <View style={styles.detailItem}>
            <Caption style={styles.detailLabel}>Đơn vị</Caption>
            <Text style={styles.detailValue}>{item.donViTinh || ''}</Text>
          </View>
        </View>
        <View style={styles.detailRow}>
          <View style={styles.detailItem}>
            <Caption style={styles.detailLabel}>SL kiểm</Caption>
            <Text style={styles.detailValue}>
              {formatNumber(item.soLuongThucTe || 0)}
            </Text>
          </View>
          <View style={styles.detailItem}>
            <Caption style={styles.detailLabel}>ĐV kiểm</Caption>
            <Text style={styles.detailValue}>{item.donViKiem || ''}</Text>
          </View>
          <View style={styles.detailItem}>
            <Caption style={styles.detailLabel}>Chênh lệch</Caption>
            <Text
              style={[
                styles.detailValue,
                (item.slPM || 0) !== (item.soLuongThucTe || 0)
                  ? styles.detailValueNegative
                  : styles.detailValuePositive,
              ]}>
              {formatNumber((item.soLuongThucTe || 0) - (item.slPM || 0))}
            </Text>
          </View>
        </View>
      </Card.Content>
    </Card>
  );

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="light-content" />
      <Appbar.Header>
        <Appbar.BackAction onPress={handleBack} />
        <Appbar.Content title="Báo Cáo Kiểm Kho" />
        <Appbar.Action icon="share" onPress={handleShare} />
        <Appbar.Action icon="printer" onPress={handlePrint} />
      </Appbar.Header>

      <FlatList
        data={[{key: 'report'}]}
        renderItem={() => (
          <Surface style={styles.reportContainer}>
            <Card elevation={2} style={styles.card}>
              <Card.Content style={styles.companyInfo}>
                <Title>GMAC COFFEE</Title>
                <Paragraph style={styles.companyAddress}>
                  Địa chỉ: Số 1, Đường Phú Mỹ, Phường 22, Q.Bình Thạnh, Tp. HCM
                </Paragraph>
              </Card.Content>
            </Card>

            <Card elevation={2} style={styles.card}>
              <Card.Content style={styles.reportTitleContainer}>
                <Title style={styles.reportTitle}>KIỂM KHO</Title>
              </Card.Content>
            </Card>

            <Card elevation={2} style={styles.card}>
              <Card.Title
                title="Thông tin phiếu kiểm"
                titleStyle={styles.infoCardTitle}
              />
              <Card.Content style={styles.infoCardContent}>
                <View style={styles.infoRow}>
                  <List.Item
                    title="Mã kiểm kho"
                    description={phieuKiem?.maKiemKho || ''}
                    titleStyle={styles.infoLabel}
                    descriptionStyle={styles.infoValue}
                    style={styles.infoItem}
                  />
                  <List.Item
                    title="Mã kho"
                    description={phieuKiem?.maKho || ''}
                    titleStyle={styles.infoLabel}
                    descriptionStyle={styles.infoValue}
                    style={styles.infoItem}
                  />
                </View>
                <View style={styles.infoRow}>
                  <List.Item
                    title="Tên kho"
                    description={tenKho || ''}
                    titleStyle={styles.infoLabel}
                    descriptionStyle={styles.infoValue}
                    style={styles.infoItem}
                  />
                  <List.Item
                    title="Mã NV"
                    description={phieuKiem?.maNguoiDung || ''}
                    titleStyle={styles.infoLabel}
                    descriptionStyle={styles.infoValue}
                    style={styles.infoItem}
                  />
                </View>
                <List.Item
                  title="Chủ đề"
                  description={phieuKiem?.chuDe || ''}
                  titleStyle={styles.infoLabel}
                  descriptionStyle={styles.infoValue}
                  style={styles.infoItem}
                />
                <List.Item
                  title="Ngày kiểm kho"
                  description={formatDate(phieuKiem?.ngayKiem)}
                  titleStyle={styles.infoLabel}
                  descriptionStyle={styles.infoValue}
                  style={styles.infoItem}
                />
                <List.Item
                  title="Ghi nhận"
                  description={phieuKiem?.ghiNhan || ''}
                  titleStyle={styles.infoLabel}
                  descriptionStyle={styles.infoValue}
                  style={styles.infoItem}
                />
                <List.Item
                  title="Trạng thái"
                  description={
                    <Chip
                      style={
                        phieuKiem?.trangThai === '0'
                          ? styles.statusPending
                          : styles.statusCompleted
                      }>
                      {phieuKiem?.trangThai === '0'
                        ? 'Chưa hoàn thành'
                        : 'Hoàn thành'}
                    </Chip>
                  }
                  titleStyle={styles.infoLabel}
                  style={styles.infoItem}
                />
              </Card.Content>
            </Card>

            <Card elevation={2} style={styles.card}>
              <Card.Title title="Tổng quan kiểm kê" />
              <Card.Content style={styles.summaryContent}>
                <Surface style={styles.summaryItem}>
                  <Title>{chiTietPhieuKiem.length}</Title>
                  <Caption>Sản phẩm</Caption>
                </Surface>
                <Surface style={styles.summaryItem}>
                  <Title>{formatNumber(totals.totalSLPM)}</Title>
                  <Caption>Tổng SL PM</Caption>
                </Surface>
                <Surface style={styles.summaryItem}>
                  <Title>{formatNumber(totals.totalSLThucTe)}</Title>
                  <Caption>Tổng SL thực tế</Caption>
                </Surface>
              </Card.Content>
            </Card>

            <Card elevation={2} style={styles.card}>
              <Card.Title title="Chi tiết sản phẩm" />
              <Card.Content>
                <FlatList
                  data={chiTietPhieuKiem}
                  renderItem={renderProductItem}
                  keyExtractor={(item, index) => `${item.maSanPham}-${index}`}
                  ListEmptyComponent={
                    <Caption style={styles.emptyText}>
                      Không có sản phẩm nào
                    </Caption>
                  }
                />
              </Card.Content>
            </Card>

            <View style={styles.signaturesContainer}>
              <View style={styles.signatureBox}>
                <Caption style={styles.signatureTitle}>Người nhận</Caption>
                <Divider style={styles.signatureLine} />
              </View>
              <View style={styles.signatureBox}>
                <Caption style={styles.signatureTitle}>Người lập phiếu</Caption>
                <Divider style={styles.signatureLine} />
              </View>
            </View>

            <Card elevation={2} style={styles.card}>
              <Card.Content style={styles.printDateContainer}>
                <Caption>Ngày in: {formatCurrentDate(currentDate)}</Caption>
              </Card.Content>
            </Card>
          </Surface>
        )}
        ListFooterComponent={
          <Surface style={{height: 100}}>
            <></>
          </Surface>
        }
      />

      <Surface style={styles.bottomActions}>
        <Button
          mode="outlined"
          onPress={handleBack}
          style={styles.bottomButton}
          labelStyle={styles.bottomButtonText}>
          Quay lại
        </Button>
        <Button
          mode="contained"
          onPress={handlePrint}
          style={[styles.bottomButton, styles.primaryButton]}
          labelStyle={styles.primaryButtonText}>
          Xuất PDF
        </Button>
      </Surface>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  loadingContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f5f5f5',
  },
  loadingText: {
    marginTop: 12,
  },
  reportContainer: {
    margin: 16,
  },
  card: {
    marginBottom: 16,
  },
  companyInfo: {
    alignItems: 'center',
  },
  companyAddress: {
    textAlign: 'center',
  },
  reportTitleContainer: {
    alignItems: 'center',
  },
  reportTitle: {
    color: '#2196F3',
  },
  statusPending: {
    backgroundColor: '#E3F2FD',
  },
  statusCompleted: {
    backgroundColor: '#E8F5E9',
  },
  infoCardTitle: {
    fontSize: 16,
    fontWeight: '600',
  },
  infoCardContent: {
    paddingVertical: 8,
  },
  infoRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  infoItem: {
    paddingVertical: 2,
    margin: 0,
    flex: 1,
  },
  infoLabel: {
    fontSize: 16,
    color: '#666',
    fontWeight: '500',
  },
  infoValue: {
    fontSize: 15,
    color: '#333',
  },
  summaryContent: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  summaryItem: {
    flex: 1,
    alignItems: 'center',
    padding: 8,
  },
  productCard: {
    marginBottom: 12,
  },
  productNumber: {
    backgroundColor: '#2196F3',
  },
  detailRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  detailItem: {
    flex: 1,
    alignItems: 'center',
  },
  detailLabel: {
    fontSize: 12,
    color: '#666',
  },
  detailValue: {
    fontSize: 14,
    fontWeight: '600',
    color: '#333',
  },
  detailValuePositive: {
    color: '#4CAF50',
  },
  detailValueNegative: {
    color: '#F44336',
  },
  emptyText: {
    textAlign: 'center',
    padding: 24,
  },
  signaturesContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginVertical: 24,
  },
  signatureBox: {
    width: '45%',
    alignItems: 'center',
  },
  signatureTitle: {
    marginBottom: 24,
    fontSize: 16,
  },
  signatureLine: {
    width: '100%',
  },
  printDateContainer: {
    alignItems: 'flex-end',
  },
  bottomActions: {
    flexDirection: 'row',
    padding: 16,
    elevation: 8,
  },
  bottomButton: {
    flex: 1,
    marginHorizontal: 6,
  },
  bottomButtonText: {
    fontSize: 14,
  },
  primaryButton: {
    backgroundColor: '#2196F3',
  },
  primaryButtonText: {
    color: 'white',
  },
});

export default BaoCaoPK;
