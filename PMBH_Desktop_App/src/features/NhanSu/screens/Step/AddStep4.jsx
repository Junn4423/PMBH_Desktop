import {useNavigation} from '@react-navigation/native';
import React, {useEffect, useState} from 'react';
import {
  Alert,
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';
import {Divider, TextInput} from 'react-native-paper';
import RNPickerSelect from 'react-native-picker-select';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import {addPersonnel, getNationality} from '../../api/index';
import {Personnel} from '../../types/PersonnelTypes';

type Nationality = {
  lv001: string;
  lv002: string;
};

type StepProps = {
  data: Personnel;
  setData: React.Dispatch<React.SetStateAction<Personnel>>;
};

const AddStep4: React.FC<StepProps> = ({data, setData}) => {
  const [listNationality, setListNationality] = useState<Nationality[]>([]);
  const [loading, setLoading] = useState<boolean>(false);
  const [submitting, setSubmitting] = useState<boolean>(false);

  const navigation = useNavigation();

  // Fetch nationality data
  useEffect(() => {
    const fetchNationality = async () => {
      setLoading(true);
      try {
        const res = await getNationality();
        if (res && Array.isArray(res)) {
          setListNationality(res);
        }
      } catch (error) {
        console.error('Lỗi khi lấy dữ liệu quốc tịch:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchNationality();
  }, []);

  const validateForm = (): boolean => {
    const errors: string[] = [];

    // Validate required fields
    if (!data.lv039?.trim()) {
      errors.push('Số điện thoại di động không được để trống');
    } else if (!/^\d+$/.test(data.lv039.trim())) {
      errors.push('Số điện thoại di động chỉ được chứa chữ số');
    }

    if (
      data.lv040?.trim() &&
      !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.lv040.trim())
    ) {
      errors.push('Email công ty không hợp lệ');
    }

    if (
      data.lv041?.trim() &&
      !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.lv041.trim())
    ) {
      errors.push('Email khác không hợp lệ');
    }

    if (errors.length > 0) {
      Alert.alert('Lỗi xác thực', errors.join('\n'));
      return false;
    }

    return true;
  };

  const handleSave = async () => {
    if (!validateForm()) return;

    setSubmitting(true);
    try {
      console.log("tao log data ne:");
      console.log(data);
      const rawResponse = await addPersonnel(data);
      let cleaned =
        typeof rawResponse === 'string'
          ? rawResponse.replace(/\[\]$/, '')
          : rawResponse;

      const response =
        typeof cleaned === 'string' ? JSON.parse(cleaned) : cleaned;

      if (response.status === 'success') {
        Alert.alert('Thành công', 'Đã thêm nhân sự mới thành công!', [
          {
            text: 'OK',
            onPress: () => navigation.navigate('Personnel' as never),
          },
        ]);
      } else {
        Alert.alert(
          'Lỗi',
          response.message || 'Đã có lỗi xảy ra khi lưu dữ liệu.',
        );
      }
    } catch (error) {
      console.error('Error saving personnel:', error);
      Alert.alert(
        'Lỗi kết nối',
        'Không thể kết nối tới server. Vui lòng thử lại sau.',
      );
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <ScrollView contentContainerStyle={styles.scrollContainer}>
      <View style={styles.formContainer}>
        {/* Country Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin quốc gia</Text>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Quốc gia <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv031: value || ''}))
                }
                value={data.lv031}
                items={listNationality.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn quốc gia...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="earth"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Mã bưu điện"
                mode="outlined"
                value={data.lv036}
                onChangeText={text => setData(prev => ({...prev, lv036: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="numeric"
                left={<TextInput.Icon icon="mailbox" color="#666" />}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        {/* Contact Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin liên hệ</Text>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Số điện thoại nhà"
                mode="outlined"
                value={data.lv037}
                onChangeText={text => setData(prev => ({...prev, lv037: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="phone-pad"
                left={<TextInput.Icon icon="phone-classic" color="#666" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Số điện thoại công ty"
                mode="outlined"
                value={data.lv038}
                onChangeText={text => setData(prev => ({...prev, lv038: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="phone-pad"
                left={<TextInput.Icon icon="phone-in-talk" color="#666" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Số điện thoại di động"
                mode="outlined"
                value={data.lv039}
                onChangeText={text => setData(prev => ({...prev, lv039: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="phone-pad"
                left={<TextInput.Icon icon="cellphone" color="#666" />}
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        {/* Email Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin email</Text>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Email công ty"
                mode="outlined"
                value={data.lv040}
                onChangeText={text => setData(prev => ({...prev, lv040: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="email-address"
                autoCapitalize="none"
                left={<TextInput.Icon icon="email" color="#666" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Email khác"
                mode="outlined"
                value={data.lv041}
                onChangeText={text => setData(prev => ({...prev, lv041: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="email-address"
                autoCapitalize="none"
                left={<TextInput.Icon icon="email-outline" color="#666" />}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        {/* Additional Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin bổ sung</Text>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Người giới thiệu"
                mode="outlined"
                value={data.lv042}
                onChangeText={text => setData(prev => ({...prev, lv042: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                left={
                  <TextInput.Icon icon="account-arrow-right" color="#666" />
                }
              />
            </View>
          </View>
        </View>

        <View style={styles.submitContainer}>
          <TouchableOpacity
            style={styles.submitButton}
            onPress={handleSave}
            disabled={submitting}>
            {submitting ? (
              <Text style={styles.submitButtonText}>Đang lưu...</Text>
            ) : (
              <>
                <Icon
                  name="content-save"
                  size={20}
                  color="#fff"
                  style={styles.buttonIcon}
                />
                <Text style={styles.submitButtonText}>Hoàn tất đăng ký</Text>
              </>
            )}
          </TouchableOpacity>
        </View>
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  scrollContainer: {
    flexGrow: 1,
    paddingVertical: 2,
    paddingHorizontal: 2,
  },
  formContainer: {
    backgroundColor: '#fff',
    borderRadius: 12,
    padding: 8,
    elevation: 4,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 2},
    shadowOpacity: 0.1,
    shadowRadius: 4,
  },
  headerContainer: {
    marginBottom: 20,
  },
  formTitle: {
    fontSize: 22,
    fontWeight: 'bold',
    marginBottom: 12,
    color: '#2196F3',
    textAlign: 'center',
  },
  stepIndicator: {
    marginBottom: 8,
  },
  stepText: {
    fontSize: 14,
    color: '#666',
    marginBottom: 6,
    textAlign: 'right',
  },
  progressBarContainer: {
    height: 6,
    backgroundColor: '#e0e0e0',
    borderRadius: 3,
    overflow: 'hidden',
  },
  progressBar: {
    width: '100%', // 4/4 steps
    height: '100%',
    backgroundColor: '#9C27B0', // Purple for final step
  },
  formSection: {
    marginBottom: 16,
  },
  sectionTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
    marginBottom: 12,
  },
  inputGroup: {
    marginBottom: 12,
  },
  inputWithIcon: {
    position: 'relative',
  },
  input: {
    backgroundColor: '#fff',
  },
  label: {
    fontSize: 14,
    marginBottom: 6,
    color: '#666',
    fontWeight: '500',
  },
  pickerWrapper: {
    position: 'relative',
  },
  pickerInput: {
    fontSize: 16,
    paddingVertical: 14,
    paddingHorizontal: 46, // Space for left icon
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 4,
    color: '#000',
    backgroundColor: '#fff',
    paddingRight: 40,
  },
  pickerIcon: {
    position: 'absolute',
    right: 12,
    top: '50%',
    marginTop: -10,
  },
  pickerLeftIcon: {
    position: 'absolute',
    left: 12,
    top: '50%',
    marginTop: -10,
    zIndex: 1,
  },
  divider: {
    marginVertical: 16,
    height: 1,
    backgroundColor: '#e0e0e0',
  },
  submitContainer: {
    marginTop: 24,
  },
  submitButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#4CAF50',
    paddingVertical: 14,
    paddingHorizontal: 24,
    borderRadius: 8,
    elevation: 3,
  },
  submitButtonText: {
    color: '#fff',
    fontWeight: 'bold',
    fontSize: 16,
  },
  buttonIcon: {
    marginRight: 8,
  },
});

export default AddStep4;
