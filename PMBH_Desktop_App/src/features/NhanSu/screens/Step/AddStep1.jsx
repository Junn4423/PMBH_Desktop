import {RouteProp, useNavigation, useRoute} from '@react-navigation/native';
import React, {useEffect, useState} from 'react';
import {
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';
import DatePicker from 'react-native-date-picker';
import {Divider, TextInput} from 'react-native-paper';
import RNPickerSelect from 'react-native-picker-select';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import {Personnel} from '../../types/PersonnelTypes';
import {formatDateFromDate, parseDateFromString} from '../../utils/helper';

type StepProps = {
  data: Personnel;
  setData: React.Dispatch<React.SetStateAction<Personnel>>;
};

const AddStep1: React.FC<StepProps> = ({data, setData}) => {
  type RootStackParamList = {
    AddPersonnel: {
      cccdData?: {
        fullname?: string;
        cccd_number?: string;
        address?: string;
        issue_date?: string;
        gender?: string;
      };
    };
  };

  const [date, setDate] = useState<Date>(new Date());
  const [open, setOpen] = useState<boolean>(false);

  const navigation = useNavigation();
  const route = useRoute<RouteProp<RootStackParamList, 'AddPersonnel'>>();

  useEffect(() => {
    if (route.params?.cccdData) {
      const {fullname, cccd_number, address, issue_date, gender} =
        route.params.cccdData;

      const parsedDate = parseDateFromString(issue_date ?? '');

      setData(prev => ({
        ...prev,
        lv002: fullname || '',
        lv010: cccd_number || '',
        lv034: address || '',
        lv018: gender === 'Nam' ? '0' : '1',
        lv011: parsedDate ? formatDateFromDate(parsedDate) : '',
      }));

      if (parsedDate) {
        setDate(parsedDate);
      }
    }
  }, [route.params?.cccdData, setData]);

  const handleScan = () => {
    navigation.navigate('CameraCCCD' as never);
  };

  return (
    <ScrollView contentContainerStyle={styles.scrollContainer}>
      <View style={styles.formContainer}>
        <View style={styles.formSection}>
          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Mã nhân sự"
                mode="outlined"
                value={data.lv001}
                onChangeText={text => setData(prev => ({...prev, lv001: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                left={<TextInput.Icon icon="account-badge" color="#666" />}
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Họ và tên"
                mode="outlined"
                value={data.lv002}
                onChangeText={text => setData(prev => ({...prev, lv002: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                left={<TextInput.Icon icon="account" color="#666" />}
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Số CCCD"
                mode="outlined"
                value={data.lv010}
                onChangeText={text => setData(prev => ({...prev, lv010: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                keyboardType="numeric"
                left={
                  <TextInput.Icon icon="card-account-details" color="#666" />
                }
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.datePickerContainer}>
              <Text style={styles.label}>
                Ngày cấp <Text style={{color: 'red'}}>*</Text>
              </Text>
              <TouchableOpacity
                onPress={() => setOpen(true)}
                style={styles.dateInputWrapper}>
                <Text style={styles.dateText}>{formatDateFromDate(date)}</Text>
                <Icon name="calendar-month-outline" size={22} color="#666" />
              </TouchableOpacity>
            </View>
          </View>

          <DatePicker
            modal
            open={open}
            date={date}
            mode="date"
            locale="vi"
            title="Chọn ngày cấp"
            confirmText="Xác nhận"
            cancelText="Huỷ"
            onConfirm={selectedDate => {
              setOpen(false);
              setDate(selectedDate);
              setData(prev => ({
                ...prev,
                lv011: formatDateFromDate(selectedDate),
              }));
            }}
            onCancel={() => setOpen(false)}
          />

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Giới tính <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={[styles.pickerWrapper]}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv018: value || ''}))
                }
                value={data.lv018}
                items={[
                  {label: 'Nam', value: '0'},
                  {label: 'Nữ', value: '1'},
                ]}
                placeholder={{label: 'Chọn giới tính...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin địa chỉ</Text>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Địa chỉ hộ khẩu/thường trú"
                mode="outlined"
                value={data.lv034}
                onChangeText={text => setData(prev => ({...prev, lv034: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                multiline
                numberOfLines={2}
                left={<TextInput.Icon icon="home" color="#666" />}
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Địa chỉ tạm trú"
                mode="outlined"
                value={data.lv035}
                onChangeText={text => setData(prev => ({...prev, lv035: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                multiline
                numberOfLines={2}
                left={<TextInput.Icon icon="home-city" color="#666" />}
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>
        </View>

        <View style={styles.actions}>
          <TouchableOpacity style={styles.scanButton} onPress={handleScan}>
            <Icon
              name="camera-outline"
              size={20}
              color="#fff"
              style={styles.buttonIcon}
            />
            <Text style={styles.buttonText}>Quét CCCD</Text>
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
    width: '33%',
    height: '100%',
    backgroundColor: '#2196F3',
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
  datePickerContainer: {
    marginBottom: 4,
  },
  dateInputWrapper: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingVertical: 14,
    paddingHorizontal: 16,
    backgroundColor: '#fff',
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 4,
  },
  dateText: {
    fontSize: 16,
    color: '#000',
  },
  pickerWrapper: {
    position: 'relative',
  },
  pickerInput: {
    fontSize: 16,
    paddingVertical: 14,
    paddingHorizontal: 16,
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
  divider: {
    marginVertical: 16,
    height: 1,
    backgroundColor: '#e0e0e0',
  },
  actions: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    marginTop: 16,
  },
  scanButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#4CAF50',
    paddingVertical: 12,
    paddingHorizontal: 16,
    borderRadius: 8,
    elevation: 2,
  },
  nextButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#2196F3',
    paddingVertical: 12,
    paddingHorizontal: 16,
    borderRadius: 8,
    elevation: 2,
  },
  buttonText: {
    color: '#fff',
    fontWeight: 'bold',
    fontSize: 15,
  },
  buttonIcon: {
    marginHorizontal: 6,
  },
});

export default AddStep1;
