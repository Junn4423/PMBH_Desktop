/* eslint-disable react/no-unstable-nested-components */
/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable react-native/no-inline-styles */
import React, {useState, useEffect, useCallback} from 'react';
import {StyleSheet, View, FlatList, Alert, ScrollView} from 'react-native';
import {
  Appbar,
  Surface,
  Text,
  Card,
  Chip,
  Button,
  Searchbar,
  Portal,
  Modal,
  TextInput,
  Title,
  Paragraph,
  Divider,
  List,
  IconButton,
  ActivityIndicator,
  FAB,
} from 'react-native-paper';
import {
  useNavigation,
  useRoute,
  type RouteProp,
} from '@react-navigation/native';
import {
  chinhSuaTrangThaiPK,
  layChiTietPhieuKiem,
  layThongTinPhieuKiemByID,
  loadSanPhamTheoIdKho,
  laySoLuongTonKho,
  taoChiTietPhieuKiemKho,
  updateChiTietPhieuKiemKho,
  xoaChiTietPhieuKiemKho,
} from '../../api/index';
import {
  chiTietPhieuKiem,
  phieuKiemKho,
  nguyenLieuKho,
  tonKho,
} from '../../types';
import theme from '../../../../theme';
import LayTenSanPham from '../../components/nguyen-lieu/LayTenSanPham';
import QuetMaQR from '../../../../components/QuetMaQR';

type ChiTietPhieuKiemRouteParams = {
  maKiemKho: string;
  tenKho: string;
};

const ChiTietPhieuKiem = () => {
  const navigation = useNavigation();
  const route =
    useRoute<RouteProp<Record<string, ChiTietPhieuKiemRouteParams>, string>>();
  const {maKiemKho, tenKho} = route.params || {};
  const [dsmaKiemKho, setDSmaKiemKho] = useState<any[]>([]);
  const [phieuKiem, setPhieuKiem] = useState<phieuKiemKho | null>(null);
  const [chiTietPhieuKiem, setChiTietPhieuKiem] = useState<chiTietPhieuKiem[]>(
    [],
  );
  const [tuKhoaSanPham, setTuKhoaSanPham] = useState<string>('');
  const [modalEditSanPhamVisible, setModalEditSanPhamVisible] =
    useState<boolean>(false);
  const [modalConfirmVisible, setModalConfirmVisible] =
    useState<boolean>(false);
  const [modalChonSP, setModalChonSP] = useState<boolean>(false);
  const [modalQRVisible, setModalQRVisible] = useState<boolean>(false);
  const [selectedSanPham, setSelectedSanPham] =
    useState<chiTietPhieuKiem | null>(null);
  const [soLuongThucTe, setSoLuongThucTe] = useState<number>(0);
  const [ghiChu, setGhiChu] = useState<string>('');
  const [tenSanPhamMap, setTenSanPhamMap] = useState<Record<string, string>>(
    {},
  );
  const [danhSachSPTrongKho, setDanhSachSPTrongKho] = useState<nguyenLieuKho[]>(
    [],
  );
  const [danhSachTonKho, setDanhSachTonKho] = useState<tonKho[]>([]);
  const [maKho, setKhoId] = useState<string>('');
  const [productSearchKeyword, setProductSearchKeyword] = useState<string>('');
  const [loading, setLoading] = useState(false);

  // Lấy thông tin phiếu kiểm và chi tiết
  const fetchData = useCallback(async () => {
    try {
      setLoading(true);
      // Lấy thông tin phiếu kiểm
      const phieuKiemData = await layThongTinPhieuKiemByID(maKiemKho);
      if (phieuKiemData) {
        setPhieuKiem(phieuKiemData);
        setKhoId(phieuKiemData.maKho || '');
      }

      // Lấy chi tiết phiếu kiểm
      if (maKiemKho) {
        setDSmaKiemKho(prev => [...new Set([...prev, maKiemKho])]); // Tránh trùng lặp
        const rawData = await layChiTietPhieuKiem(maKiemKho);
        setChiTietPhieuKiem(rawData || []);
      }

      // Lấy sản phẩm trong kho
      if (phieuKiemData?.maKho) {
        const rawData = await loadSanPhamTheoIdKho({
          maKho: phieuKiemData.maKho,
        });
        setDanhSachSPTrongKho(rawData || []);

        // Tạo map tên sản phẩm
        const tenMap: Record<string, string> = {};
        rawData.forEach((sp: any) => {
          tenMap[sp.maSp] = sp.tenSp || `Sản phẩm ${sp.maSp}`;
        });
        setTenSanPhamMap(tenMap);

        const danhSachTon: tonKho[] = await Promise.all(
          rawData.map(async (sp: any) => {
            const slTonRaw = await laySoLuongTonKho(
              sp.maSp,
              phieuKiemData.maKho,
            );
            let slTon = 0;
            if (Array.isArray(slTonRaw) && slTonRaw.length > 0) {
              slTon = parseFloat(String(slTonRaw[0]));
              if (isNaN(slTon)) {
                slTon = 0;
              }
            } else {
              slTon = parseFloat(String(slTonRaw));
              if (isNaN(slTon)) {
                slTon = 0;
              }
            }
            return {maSP: sp.maSp, soLuong: slTon};
          }),
        );
        setDanhSachTonKho(danhSachTon);
      }
      setLoading(false);
    } catch (error) {
      console.error('Lỗi khi lấy dữ liệu:', error);
      Alert.alert('Lỗi', 'Không thể tải dữ liệu phiếu kiểm kho.');
      setLoading(false);
    }
  }, [maKiemKho]);

  useEffect(() => {
    fetchData();
  }, [fetchData]);

  // Xử lý quét mã QR
  const onScanQRCode = async (data: {
    maSp: string;
    tenSp: string;
    maDV?: string;
    tonKho?: number;
  }) => {
    setModalQRVisible(false);
    try {
      if (!data.maSp || !data.tenSp) {
        throw new Error('QR không hợp lệ hoặc thiếu thông tin');
      }

      const sp = danhSachSPTrongKho.find(item => item.maSp === data.maSp);
      if (!sp) {
        Alert.alert('Lỗi', 'Sản phẩm không tồn tại trong kho');
        return;
      }

      const existingItem = chiTietPhieuKiem.find(
        item => item.maSanPham === data.maSp,
      );
      const inventory = danhSachTonKho.find(t => t.maSP === data.maSp);
      const soLuongTon = inventory ? inventory.soLuong : 0;

      if (existingItem) {
        // Cập nhật số lượng thực tế +1
        const newSoLuongThucTe = (existingItem.soLuongThucTe || 0) + 1;
        const res = await updateChiTietPhieuKiemKho({
          maKiemKho: maKiemKho,
          maSanPham: data.maSp,
          soLuongThucTe: newSoLuongThucTe,
          donViTT: existingItem.donViTinh || data.maDV || 'Cái',
        });
        if (!res) {
          throw new Error('Cập nhật số lượng thất bại');
        }
      } else {
        // Tạo mới với số lượng thực tế = số lượng tồn kho
        const res = await taoChiTietPhieuKiemKho({
          maKiemKho: maKiemKho,
          maSanPham: data.maSp,
          slPM: soLuongTon,
          donViKiem: data.maDV || 'Cái',
          soLuongThucTe: soLuongTon,
          donViTT: data.maDV || 'Cái',
        });
        if (!res) {
          throw new Error('Tạo mới sản phẩm thất bại');
        }
      }

      Alert.alert('Thành công', 'Đã thêm/cập nhật sản phẩm');
      await fetchData();
    } catch (error) {
      console.error('Lỗi khi xử lý QR:', error);
      Alert.alert('Lỗi', 'Không thể xử lý QR hoặc cập nhật sản phẩm.');
    }
  };

  // Xử lý chọn sản phẩm thủ công
  const handleSelectProduct = async (product: nguyenLieuKho) => {
    try {
      const existingItem = chiTietPhieuKiem.find(
        item => item.maSanPham === product.maSp,
      );
      const inventory = danhSachTonKho.find(t => t.maSP === product.maSp);
      const soLuongTon = inventory ? inventory.soLuong : 0;

      if (existingItem) {
        // Cập nhật số lượng thực tế +1
        const newSoLuongThucTe =
          parseFloat(existingItem.soLuongThucTe.toString() || '0') + 1;
        const res = await updateChiTietPhieuKiemKho({
          maKiemKho: maKiemKho,
          maSanPham: product.maSp,
          soLuongThucTe: newSoLuongThucTe,
          donViTT: existingItem.donViTinh || 'Cái',
        });
        if (!res) {
          throw new Error('Cập nhật số lượng thất bại');
        }
      } else {
        // Tạo mới với số lượng thực tế = số lượng tồn kho
        const res = await taoChiTietPhieuKiemKho({
          maKiemKho: maKiemKho,
          maSanPham: product.maSp,
          slPM: soLuongTon,
          donViKiem: 'Cái',
          soLuongThucTe: soLuongTon,
          donViTT: 'Cái',
        });
        if (!res) {
          throw new Error('Tạo mới sản phẩm thất bại');
        }
      }

      Alert.alert('Thành công', 'Đã thêm/cập nhật sản phẩm');
      setModalChonSP(false);
      await fetchData();
    } catch (error) {
      console.error('Lỗi khi thêm sản phẩm:', error);
      Alert.alert(
        'Lỗi',
        'Không thể thêm/cập nhật sản phẩm vào phiếu kiểm kho.',
      );
    }
  };

  // Xử lý xác nhận hoàn thành phiếu kiểm
  const handleXacNhanHoanThanh = async () => {
    try {
      const res = await chinhSuaTrangThaiPK(dsmaKiemKho);
      if (res) {
        Alert.alert('Thành công', 'Phiếu kiểm kê đã được hoàn thành.');
        setModalConfirmVisible(false);
        await fetchData();
      } else {
        Alert.alert('Thất bại', 'Có lỗi xảy ra khi hoàn thành phiếu kiểm kê.');
      }
    } catch (error) {
      console.error('Lỗi khi hoàn thành phiếu kiểm:', error);
      Alert.alert('Lỗi', 'Không thể hoàn thành phiếu kiểm kê.');
    }
  };

  // Cập nhật số lượng thực tế
  const updateSoLuongThucTe = async () => {
    try {
      if (selectedSanPham) {
        const res = await updateChiTietPhieuKiemKho({
          maKiemKho: maKiemKho,
          maSanPham: selectedSanPham.maSanPham || '',
          soLuongThucTe: soLuongThucTe ?? 0,
          donViTT: selectedSanPham.donViTinh || 'Cái',
        });
        if (res) {
          Alert.alert('Thành công', 'Cập nhật thành công.');
          setModalEditSanPhamVisible(false);
          await fetchData();
        } else {
          Alert.alert('Thất bại', 'Có lỗi xảy ra khi cập nhật sản phẩm.');
        }
      }
    } catch (error) {
      console.error('Lỗi khi cập nhật số lượng:', error);
      Alert.alert('Lỗi', 'Không thể cập nhật sản phẩm.');
    }
  };

  // Xóa sản phẩm
  const deleteSanPham = async (maPhieuKiem: string, maSanPham: string) => {
    try {
      const res = await xoaChiTietPhieuKiemKho({
        maKiemKho: maPhieuKiem,
        maSanPham,
      });
      if (res) {
        Alert.alert('Thành công', 'Xóa sản phẩm thành công.');
        await fetchData();
      } else {
        Alert.alert('Thất bại', 'Có lỗi xảy ra khi xóa sản phẩm.');
      }
    } catch (error) {
      console.error('Lỗi khi xóa sản phẩm:', error);
      Alert.alert('Lỗi', 'Không thể xóa sản phẩm.');
    }
  };

  // Xuất báo cáo
  const xuatBaoCao = async () => {
    if (phieuKiem) {
      // @ts-ignore
      navigation.navigate('BaoCaoPK', {
        maKiemKho: phieuKiem.maKiemKho,
        tenKho: tenKho,
      });
    }
  };

  // Lọc danh sách sản phẩm theo từ khóa
  const chiTietPhieuKiemLoc = chiTietPhieuKiem.filter(item => {
    if (!tuKhoaSanPham) {
      return true;
    }
    const maSanPham = item.maSanPham ? item.maSanPham.toLowerCase() : '';
    const tuKhoaLowerCase = tuKhoaSanPham.toLowerCase();
    return maSanPham.includes(tuKhoaLowerCase);
  });

  // Lấy tên sản phẩm từ mã sản phẩm
  const layTenSanPham = (maSanPham: string): string => {
    return tenSanPhamMap[maSanPham] || `Sản phẩm ${maSanPham}`;
  };

  // Quay lại màn hình danh sách phiếu kiểm
  const quayLai = (): void => {
    navigation.goBack();
  };

  // Mở modal chọn sản phẩm
  const moModalChonSanPham = () => {
    setModalChonSP(true);
  };

  // Mở modal chỉnh sửa sản phẩm
  const moModalChinhSuaSanPham = (item: chiTietPhieuKiem) => {
    setSelectedSanPham(item);
    setSoLuongThucTe(item.soLuongThucTe || 0);
    setGhiChu('');
    setModalEditSanPhamVisible(true);
  };

  // Mở modal xác nhận hoàn thành
  const moModalXacNhanHoanThanh = () => {
    setModalConfirmVisible(true);
  };

  // Hiển thị chi tiết sản phẩm
  const hienThiChiTietSanPham = ({item}: {item: chiTietPhieuKiem}) => {
    const slPM = item.slPM || 0;
    const slTT = item.soLuongThucTe || 0;
    const chenhLech = slTT - slPM;

    return (
      <Card style={styles.itemSanPham}>
        <Card.Content>
          <View style={styles.sanPhamHeader}>
            <View style={styles.sanPhamInfo}>
              <Title style={styles.tenSanPham}>
                <LayTenSanPham
                  maSanPham={item.maSanPham || ''}
                  fallbackText="Đang tải..."
                />
              </Title>
              <Paragraph style={styles.maSanPham}>
                Mã sản phẩm: {item.maSanPham}
              </Paragraph>
            </View>
            {phieuKiem && phieuKiem.trangThai === '0' ? (
              <View style={styles.actionButtons}>
                <IconButton
                  icon="pencil"
                  size={20}
                  iconColor={theme.colors.primary}
                  style={styles.actionButton}
                  onPress={() => moModalChinhSuaSanPham(item)}
                />
                <IconButton
                  icon="delete"
                  size={20}
                  iconColor="red"
                  style={styles.actionButton}
                  onPress={() => deleteSanPham(maKiemKho, item.maSanPham)}
                />
              </View>
            ) : (
              <View style={styles.actionButtons}>
                <IconButton
                  icon="pencil"
                  size={20}
                  iconColor="#e0e0e0"
                  style={styles.actionButton}
                  disabled
                />
                <IconButton
                  icon="delete"
                  size={20}
                  iconColor="#e0e0e0"
                  style={styles.actionButton}
                  disabled
                />
              </View>
            )}
          </View>
          <Divider style={styles.divider} />
          <View style={styles.sanPhamContent}>
            <View style={styles.sanPhamRow}>
              <View style={styles.sanPhamCol}>
                <Text style={styles.sanPhamLabel}>SL thực tế:</Text>
                <Text style={styles.sanPhamValue}>{item.soLuongThucTe}</Text>
              </View>
              <View style={styles.sanPhamCol}>
                <Text style={styles.sanPhamLabel}>SL PM:</Text>
                <Text style={styles.sanPhamValue}>{item.slPM}</Text>
              </View>
            </View>
            <View style={styles.sanPhamRow}>
              <View style={styles.sanPhamCol}>
                <Text style={styles.sanPhamLabel}>Đơn vị tính:</Text>
                <Text style={styles.sanPhamValue}>{item.donViTinh}</Text>
              </View>
              <View style={styles.sanPhamCol}>
                <Text style={styles.sanPhamLabel}>Đơn vị kiểm:</Text>
                <Text style={styles.sanPhamValue}>{item.donViKiem}</Text>
              </View>
              <View style={styles.sanPhamCol}>
                <Text style={styles.sanPhamLabel}>Chênh lệch:</Text>
                <Text
                  style={[
                    styles.sanPhamValue,
                    chenhLech !== 0
                      ? styles.chenhLechCo
                      : styles.chenhLechKhong,
                  ]}>
                  {chenhLech !== 0 ? chenhLech : 'Không'}
                </Text>
              </View>
            </View>
          </View>
        </Card.Content>
      </Card>
    );
  };

  if (loading) {
    return (
      <Surface style={styles.loadingContainer}>
        <ActivityIndicator size="large" color={theme.colors.primary} />
        <Text style={styles.loadingText}>Đang tải dữ liệu...</Text>
      </Surface>
    );
  }

  return (
    <Surface style={styles.container}>
      <Appbar.Header style={styles.header}>
        <Appbar.BackAction onPress={quayLai} color="white" />
        <Appbar.Content
          title="Chi tiết phiếu kiểm kho"
          titleStyle={styles.headerTitle}
        />
      </Appbar.Header>

      {phieuKiem ? (
        <>
          <ScrollView style={styles.scrollView}>
            <Card style={styles.phieuInfoContainer}>
              <Card.Content>
                <Title style={styles.phieuTitle}>
                  Thông tin phiếu kiểm #{phieuKiem.maKiemKho}
                </Title>
                <Divider style={styles.divider} />
                <List.Item
                  title="Mã kiểm kho"
                  description={phieuKiem.maKiemKho}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Kho"
                  description={phieuKiem.maKho}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Tên kho"
                  description={tenKho || 'Không có thông tin'}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Người kiểm"
                  description={phieuKiem.maNguoiDung || 'Chưa xác định'}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Chủ đề"
                  description={phieuKiem.chuDe || 'Không có'}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Ngày kiểm"
                  description={phieuKiem.ngayKiem}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Ghi nhận"
                  description={phieuKiem.ghiNhan || 'Không có'}
                  titleStyle={styles.listItemTitle}
                  descriptionStyle={styles.listItemDescription}
                />
                <List.Item
                  title="Trạng thái"
                  description={
                    <Chip
                      mode="outlined"
                      style={{
                        backgroundColor:
                          phieuKiem.trangThai === '0' ? '#E3F2FD' : '#E8F5E9',
                        borderColor:
                          phieuKiem.trangThai === '0' ? '#2196F3' : '#4CAF50',
                      }}
                      textStyle={{
                        color:
                          phieuKiem.trangThai === '0' ? '#2196F3' : '#4CAF50',
                      }}>
                      {phieuKiem.trangThai === '0'
                        ? 'Chưa hoàn thành'
                        : 'Hoàn thành'}
                    </Chip>
                  }
                  titleStyle={styles.listItemTitle}
                />
              </Card.Content>
            </Card>

            <Card style={styles.sanPhamContainer}>
              <Card.Content>
                <View style={styles.sanPhamHeader}>
                  <Title style={styles.sanPhamTitle}>
                    Danh sách sản phẩm kiểm kê
                  </Title>
                  {phieuKiem.trangThai === '0' && (
                    <Button
                      mode="contained"
                      icon="plus"
                      onPress={moModalChonSanPham}
                      style={styles.btnAddSanPham}>
                      Thêm
                    </Button>
                  )}
                </View>

                <Searchbar
                  placeholder="Tìm kiếm sản phẩm..."
                  onChangeText={setTuKhoaSanPham}
                  value={tuKhoaSanPham}
                  style={styles.searchBar}
                  iconColor={theme.colors.primary}
                />

                <Card style={styles.statsCard}>
                  <Card.Content style={styles.sanPhamStats}>
                    <View style={styles.statItem}>
                      <Text style={styles.statValue}>
                        {chiTietPhieuKiem.length}
                      </Text>
                      <Text style={styles.statLabel}>Tổng sản phẩm</Text>
                    </View>
                    <View style={styles.statItem}>
                      <Text style={styles.statValue}>
                        {
                          chiTietPhieuKiem.filter(item => {
                            const slTT = item.soLuongThucTe || 0;
                            const slPM = item.slPM || 0;
                            return slPM !== slTT;
                          }).length
                        }
                      </Text>
                      <Text style={styles.statLabel}>Chênh lệch</Text>
                    </View>
                    <View style={styles.statItem}>
                      <Text style={styles.statValue}>
                        {
                          chiTietPhieuKiem.filter(item => {
                            const slTT = item.soLuongThucTe || 0;
                            return slTT === 0;
                          }).length
                        }
                      </Text>
                      <Text style={styles.statLabel}>Chưa kiểm</Text>
                    </View>
                  </Card.Content>
                </Card>

                {chiTietPhieuKiemLoc.length > 0 ? (
                  <FlatList
                    data={chiTietPhieuKiemLoc}
                    renderItem={hienThiChiTietSanPham}
                    keyExtractor={(item, index) => `${item.maSanPham}-${index}`}
                    style={styles.sanPhamList}
                    scrollEnabled={false}
                    nestedScrollEnabled={true}
                  />
                ) : (
                  <View style={styles.noData}>
                    <Text style={styles.textNoData}>
                      {chiTietPhieuKiem.length === 0
                        ? 'Chưa có sản phẩm nào trong phiếu kiểm kê'
                        : 'Không tìm thấy sản phẩm phù hợp với từ khóa'}
                    </Text>
                  </View>
                )}
              </Card.Content>
            </Card>
          </ScrollView>

          <View style={styles.bottomActions}>
            {phieuKiem.trangThai === '0' ? (
              <Button
                mode="contained"
                icon="check-circle"
                onPress={moModalXacNhanHoanThanh}
                style={styles.btnHoanThanh}>
                Hoàn thành kiểm kê
              </Button>
            ) : (
              <Button
                mode="outlined"
                icon="check-circle"
                disabled
                style={styles.btnDaHoanThanh}>
                Phiếu đã hoàn thành
              </Button>
            )}

            <Button
              mode="contained"
              icon="file-export"
              onPress={xuatBaoCao}
              style={styles.btnExport}>
              Xuất báo cáo
            </Button>
          </View>

          <FAB
            style={styles.fab}
            icon="plus"
            visible={phieuKiem?.trangThai === '0'}
            onPress={moModalChonSanPham}
          />
        </>
      ) : (
        <View style={styles.noData}>
          <Text style={styles.textNoData}>
            Không tìm thấy thông tin phiếu kiểm kho
          </Text>
        </View>
      )}

      {/* Modal chỉnh sửa sản phẩm */}
      <Portal>
        <Modal
          visible={modalEditSanPhamVisible}
          onDismiss={() => setModalEditSanPhamVisible(false)}
          contentContainerStyle={styles.modalContent}>
          <Title style={styles.modalTitle}>Chỉnh sửa sản phẩm</Title>

          {selectedSanPham && (
            <>
              <List.Item
                title="Mã sản phẩm"
                description={selectedSanPham.maSanPham}
                titleStyle={styles.listItemTitle}
                descriptionStyle={styles.listItemDescription}
              />
              <List.Item
                title="Tên sản phẩm"
                description={layTenSanPham(selectedSanPham.maSanPham)}
                titleStyle={styles.listItemTitle}
                descriptionStyle={styles.listItemDescription}
              />
              <TextInput
                label="Số lượng thực tế"
                value={
                  soLuongThucTe !== undefined ? soLuongThucTe.toString() : ''
                }
                onChangeText={text => {
                  const value = Number.parseFloat(text);
                  setSoLuongThucTe(isNaN(value) ? 0 : value);
                }}
                keyboardType="numeric"
                style={styles.modalInput}
                mode="outlined"
              />
              <TextInput
                label="Số lượng PM (tồn kho)"
                value={
                  selectedSanPham.slPM !== undefined
                    ? selectedSanPham.slPM.toString()
                    : ''
                }
                disabled
                style={styles.modalInput}
                mode="outlined"
              />
              <TextInput
                label="Ghi chú"
                value={ghiChu}
                onChangeText={setGhiChu}
                multiline
                numberOfLines={3}
                style={styles.modalInput}
                mode="outlined"
              />
            </>
          )}

          <View style={styles.modalButtonGroup}>
            <Button
              mode="outlined"
              onPress={() => setModalEditSanPhamVisible(false)}
              style={styles.modalButton}>
              Hủy
            </Button>
            <Button
              mode="contained"
              onPress={updateSoLuongThucTe}
              style={styles.modalButton}>
              Lưu
            </Button>
          </View>
        </Modal>
      </Portal>

      {/* Modal xác nhận hoàn thành */}
      <Portal>
        <Modal
          visible={modalConfirmVisible}
          onDismiss={() => setModalConfirmVisible(false)}
          contentContainerStyle={styles.modalConfirmContent}>
          <Title style={styles.modalConfirmTitle}>Xác nhận hoàn thành</Title>
          <Paragraph style={styles.modalConfirmText}>
            Bạn có chắc chắn muốn hoàn thành phiếu kiểm kê này?
          </Paragraph>
          <Paragraph style={styles.modalConfirmSubtext}>
            Sau khi hoàn thành, bạn sẽ không thể chỉnh sửa thông tin kiểm kê.
          </Paragraph>
          <View style={styles.modalConfirmButtons}>
            <Button
              mode="outlined"
              onPress={() => setModalConfirmVisible(false)}
              style={styles.modalConfirmButton}>
              Hủy
            </Button>
            <Button
              mode="contained"
              onPress={handleXacNhanHoanThanh}
              style={styles.modalConfirmButton}>
              Xác nhận
            </Button>
          </View>
        </Modal>
      </Portal>

      {/* Modal chọn sản phẩm */}
      <Portal>
        <Modal
          visible={modalChonSP}
          onDismiss={() => setModalChonSP(false)}
          contentContainerStyle={styles.modalContent}>
          <Title style={styles.modalTitle}>Chọn sản phẩm</Title>
          <Searchbar
            placeholder="Tìm kiếm sản phẩm..."
            onChangeText={setProductSearchKeyword}
            value={productSearchKeyword}
            style={styles.searchBar}
            iconColor={theme.colors.primary}
          />
          <Button
            mode="contained"
            icon="qrcode-scan"
            style={{marginBottom: 16}}
            onPress={() => setModalQRVisible(true)}>
            Quét mã QR
          </Button>
          {danhSachSPTrongKho.length > 0 ? (
            <FlatList
              data={danhSachSPTrongKho.filter(item => {
                if (!productSearchKeyword) {
                  return true;
                }
                const maSP = item.maSp?.toLowerCase() || '';
                const tenSP = item.tenSp?.toLowerCase() || '';
                const keyword = productSearchKeyword.toLowerCase();
                return maSP.includes(keyword) || tenSP.includes(keyword);
              })}
              keyExtractor={item => item.maSp}
              renderItem={({item}) => {
                const inventory = danhSachTonKho.find(
                  t => t.maSP === item.maSp,
                );
                const tonKho = inventory ? inventory.soLuong : 0;
                return (
                  <List.Item
                    title={item.tenSp || `Sản phẩm ${item.maSp}`}
                    description={`Mã: ${item.maSp} | Tồn kho: ${tonKho}`}
                    onPress={() => handleSelectProduct(item)}
                    left={props => (
                      <List.Icon {...props} icon="package-variant" />
                    )}
                    style={styles.productItem}
                  />
                );
              }}
              style={styles.productList}
            />
          ) : (
            <View style={styles.noData}>
              <Text style={styles.textNoData}>
                {danhSachSPTrongKho.length === 0
                  ? 'Không có sản phẩm nào trong kho này'
                  : 'Không tìm thấy sản phẩm phù hợp với từ khóa'}
              </Text>
            </View>
          )}
          <Button
            mode="outlined"
            onPress={() => setModalChonSP(false)}
            style={{marginTop: 16}}>
            Đóng
          </Button>
        </Modal>
      </Portal>

      {/* Modal QR Scanner */}
      <Portal>
        <Modal
          visible={modalQRVisible}
          onDismiss={() => setModalQRVisible(false)}
          contentContainerStyle={styles.modalQRContainer}>
          <View style={styles.qrContainer}>
            <QuetMaQR onScanSuccess={data => onScanQRCode(data)} />
            <Button
              mode="contained"
              onPress={() => setModalQRVisible(false)}
              style={styles.closeQRButton}>
              Đóng camera
            </Button>
          </View>
        </Modal>
      </Portal>
    </Surface>
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
  },
  loadingText: {
    marginTop: 16,
    fontSize: 16,
  },
  header: {
    backgroundColor: theme.colors.primary,
    elevation: 4,
  },
  headerTitle: {
    color: 'white',
    fontWeight: 'bold',
  },
  scrollView: {
    flex: 1,
  },
  phieuInfoContainer: {
    margin: 16,
    marginBottom: 8,
    elevation: 2,
  },
  phieuTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: theme.colors.primary,
    marginBottom: 16,
    textAlign: 'center',
  },
  divider: {
    marginVertical: 8,
  },
  listItemTitle: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#555',
  },
  listItemDescription: {
    fontSize: 14,
    color: '#333',
  },
  sanPhamContainer: {
    margin: 16,
    marginTop: 8,
    elevation: 2,
  },
  sanPhamHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 16,
  },
  sanPhamTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#333',
  },
  btnAddSanPham: {
    backgroundColor: theme.colors.primary,
  },
  searchBar: {
    marginBottom: 16,
    elevation: 0,
  },
  statsCard: {
    marginBottom: 16,
    backgroundColor: '#f9f9f9',
  },
  sanPhamStats: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    padding: 12,
  },
  statItem: {
    alignItems: 'center',
    flex: 1,
  },
  statValue: {
    fontSize: 20,
    fontWeight: 'bold',
    color: theme.colors.primary,
  },
  statLabel: {
    fontSize: 12,
    color: '#757575',
    marginTop: 4,
  },
  sanPhamList: {
    marginBottom: 16,
  },
  itemSanPham: {
    marginBottom: 12,
    borderLeftWidth: 3,
    borderLeftColor: theme.colors.primary,
    elevation: 1,
  },
  actionButtons: {
    flexDirection: 'row',
  },
  actionButton: {
    margin: 0,
  },
  sanPhamInfo: {
    flex: 1,
  },
  maSanPham: {
    fontSize: 14,
    color: '#555',
    fontStyle: 'italic',
  },
  tenSanPham: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#333',
    marginBottom: 0,
  },
  sanPhamContent: {
    backgroundColor: '#f0f0f0',
    borderRadius: 6,
    padding: 10,
  },
  sanPhamRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginBottom: 8,
  },
  sanPhamCol: {
    flex: 1,
    alignItems: 'center',
  },
  sanPhamLabel: {
    fontSize: 12,
    color: '#757575',
    marginBottom: 4,
  },
  sanPhamValue: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
  },
  chenhLechCo: {
    color: '#F44336',
  },
  chenhLechKhong: {
    color: '#4CAF50',
  },
  noData: {
    padding: 20,
    alignItems: 'center',
    justifyContent: 'center',
  },
  textNoData: {
    fontSize: 16,
    color: '#757575',
    textAlign: 'center',
  },
  bottomActions: {
    flexDirection: 'row',
    padding: 16,
    backgroundColor: 'white',
    borderTopWidth: 1,
    borderTopColor: '#e0e0e0',
  },
  btnHoanThanh: {
    flex: 2,
    marginRight: 8,
    backgroundColor: '#4CAF50',
  },
  btnDaHoanThanh: {
    flex: 2,
    marginRight: 8,
    borderColor: '#4CAF50',
  },
  btnExport: {
    flex: 1,
    backgroundColor: '#FF9800',
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    margin: 20,
    borderRadius: 12,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 20,
    textAlign: 'center',
    color: theme.colors.primary,
  },
  modalInput: {
    marginBottom: 16,
    backgroundColor: 'white',
  },
  productSelectButton: {
    marginBottom: 16,
  },
  modalButtonGroup: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 20,
  },
  modalButton: {
    flex: 1,
    marginHorizontal: 5,
  },
  modalConfirmContent: {
    backgroundColor: 'white',
    padding: 24,
    margin: 20,
    borderRadius: 12,
    elevation: 5,
  },
  modalConfirmTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 16,
    textAlign: 'center',
    color: theme.colors.primary,
  },
  modalConfirmText: {
    fontSize: 16,
    marginBottom: 12,
    textAlign: 'center',
    color: '#333',
  },
  modalConfirmSubtext: {
    fontSize: 14,
    marginBottom: 20,
    textAlign: 'center',
    color: '#757575',
    fontStyle: 'italic',
  },
  modalConfirmButtons: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  modalConfirmButton: {
    flex: 1,
    marginHorizontal: 5,
  },
  productList: {
    maxHeight: 400,
  },
  productItem: {
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
  },
  fab: {
    position: 'absolute',
    margin: 16,
    right: 0,
    bottom: 80,
    backgroundColor: theme.colors.primary,
  },
  modalQRContainer: {
    flex: 1,
    margin: 0,
    padding: 0,
    backgroundColor: 'black',
  },
  qrContainer: {
    flex: 1,
    position: 'relative',
  },
  closeQRButton: {
    position: 'absolute',
    bottom: 40,
    alignSelf: 'center',
    width: 200,
    borderRadius: 8,
  },
});

export default ChiTietPhieuKiem;
