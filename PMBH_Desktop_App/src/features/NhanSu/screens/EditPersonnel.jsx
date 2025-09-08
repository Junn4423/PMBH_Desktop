import { useNavigation, useRoute, RouteProp } from '@react-navigation/native';
import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  Alert,
} from 'react-native';
import { ProgressBar, TextInput } from 'react-native-paper';
import DatePicker from 'react-native-date-picker';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import RNPickerSelect from 'react-native-picker-select';
import { formatDate, formatDateFromDate } from '../utils/helper';
import { editPersonnel } from '../api/index';
import { NativeStackNavigationProp } from '@react-navigation/native-stack';
import WrapHeader from '../../../components/WrapHeader.component';

type RootStackParamList = {
  EditPersonnel: { employee: FormData };
  Personnel: undefined;
};

type EditPersonnelRouteProp = RouteProp<RootStackParamList, 'EditPersonnel'>;
type NavigationProp = NativeStackNavigationProp<RootStackParamList, 'EditPersonnel'>;

type FormData = {
  lv001: string;
  lv002: string;
  lv034: string;
  lv035: string;
  lv018: string;
  lv010: string;
  lv011: string;
};

const EditPersonnel = () => {
  const route = useRoute<EditPersonnelRouteProp>();
  const navigation = useNavigation<NavigationProp>();

  const { employee } = route.params;
  console.log(employee);
  const [formData, setFormData] = useState<FormData>({
    lv001: employee?.lv001 || '',
    lv002: employee?.lv002 || '',
    lv034: employee?.lv034 || '',
    lv035: employee?.lv035 || '',
    lv018: employee?.lv018 || '',
    lv010: employee?.lv010 || '',
    lv011: employee?.lv011 || '',
  });

  const [open, setOpen] = useState<boolean>(false);
  const [date, setDate] = useState<Date>(
    employee?.lv011 ? new Date(employee.lv011) : new Date()
  );

  const handleSave = async () => {
    try {
      if (!validateForm()) return;
        console.log(formData);

      const rawResponse = await editPersonnel(formData);

      let cleaned =
        typeof rawResponse === 'string'
          ? rawResponse.replace(/\[\]$/, '')
          : rawResponse;

      const response =
        typeof cleaned === 'string' ? JSON.parse(cleaned) : cleaned;

      if (response.status === 'success') {
        Alert.alert('Thành công', response.message);
        navigation.navigate('Personnel');
      } else if (response.status === 'error') {
        Alert.alert('Lỗi', response.message);
      } else if (response.message === 'invalid') {
        Alert.alert('Lỗi xác thực', 'Lỗi token');
      } else {
        Alert.alert('Lỗi không xác định', 'Vui lòng thử lại sau.');
      }
    } catch (error) {
      Alert.alert('Lỗi hệ thống', 'Không thể kết nối tới máy chủ.');
    }
  };

  const validateForm = (): boolean => {
    const newErrors: Record<string, string> = {};
  
    if (!formData.lv002 || !formData.lv002.trim()) {
      newErrors.lv002 = 'Họ và tên không được để trống';
    }
  
    if (!formData.lv010 || !formData.lv010.trim()) {
      newErrors.lv010 = 'Số CCCD không được để trống';
    } else if (!/^\d{9,12}$/.test(formData.lv010.trim())) {
      newErrors.lv010 = 'Số CCCD phải là số và có từ 9 đến 12 chữ số';
    }
  
    if (!formData.lv034 || !formData.lv034.trim()) {
      newErrors.lv034 = 'Địa chỉ thường trú không được để trống';
    }

    if (!formData.lv035 || !formData.lv035.trim()) {
      newErrors.lv035 = 'Địa chỉ tạm trú không được để trống';
    }
  
    if (!formData.lv018 || !formData.lv018.trim()) {
      newErrors.lv018 = 'Giới tính không được để trống';
    }
  
    if (!date) {
      newErrors.date = 'Ngày cấp không được để trống';
    } else {
      const now = new Date();
      if (date > now) {
        newErrors.date = 'Ngày cấp không được lớn hơn ngày hiện tại';
      }
    }
  
    if (Object.keys(newErrors).length > 0) {
      const message = Object.values(newErrors).join('\n');
      Alert.alert(message);
      return false;
    }
  
    return true;
  };

  return (
    <View style={styles.container}>
      <WrapHeader
        title="Sửa nhân sự"
        handleBack={() => navigation.goBack()}></WrapHeader>
    <View style={styles.container}>

      <View style={styles.formContainer}>

        <TextInput
          label="Mã nhân sự"
          mode="outlined"
          value={formData.lv001}
          onChangeText={text => setFormData({ ...formData, lv001: text })}
          style={styles.input}
          placeholder="Nhập mã nhân sự"
          editable={false}
        />

        <TextInput
          label="Họ và tên"
          mode="outlined"
          value={formData.lv002}
          onChangeText={text => setFormData({ ...formData, lv002: text })}
          style={styles.input}
          placeholder="Nhập tên nhân sự"
        />

        <TextInput
          label="Số CCCD"
          mode="outlined"
          value={formData.lv010}
          onChangeText={text => setFormData({ ...formData, lv010: text })}
          style={styles.input}
          placeholder="Nhập số CCCD"
        />
        <TextInput
          label="Địa chỉ hộ khẩu hay thường trú"
          mode="outlined"
          value={formData.lv034}
          onChangeText={text => setFormData({...formData, lv034: text})}
          style={styles.input}
        />
        <TextInput
          label="Địa chỉ tạm trú"
          mode="outlined"
          value={formData.lv035}
          onChangeText={text => setFormData({...formData, lv035: text})}
          style={styles.input}
        />

        {/* Ngày cấp */}
        <View style={styles.datePickerContainer}>
          <Text style={styles.label}>Ngày cấp</Text>
          <TouchableOpacity
            onPress={() => setOpen(true)}
            style={styles.dateInputWrapper}>
            <Text style={styles.dateText}>{date.toLocaleDateString('vi-VN')}</Text>
            <Icon name="calendar-month-outline" size={22} color="#666" />
          </TouchableOpacity>
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
          onConfirm={(selectedDate: Date) => {
            setOpen(false);
            setDate(selectedDate);
            setFormData({ ...formData, lv011: formatDateFromDate(selectedDate) });
          }}
          onCancel={() => setOpen(false)}
        />

        <View style={[styles.input, styles.pickerWrapper]}>
          <RNPickerSelect
            onValueChange={value => setFormData({ ...formData, lv018: value })}
            value={formData.lv018}
            items={[
              { label: 'Nam', value: '0' },
              { label: 'Nữ', value: '1' },
            ]}
            placeholder={{ label: 'Chọn giới tính...', value: null }}
            style={{
              inputIOS: styles.pickerInput,
              inputAndroid: styles.pickerInput,
              iconContainer: styles.pickerIcon,
            }}
            useNativeAndroidPickerStyle={false}
            Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
          />
        </View>
        <View style={styles.actions}>
          <TouchableOpacity
            style={[styles.button, styles.saveButton]}
            onPress={handleSave}>
            <Text style={styles.buttonText}>Lưu</Text>
          </TouchableOpacity>
        </View>
      </View>
    </View>
    </View>

  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    paddingTop: 8,
    paddingHorizontal: 16,
    backgroundColor: '#fff',
  },
  title: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 8,
    textAlign: 'center',
  },
  subtitle: {
    fontSize: 16,
    color: '#888',
    marginBottom: 12,
    textAlign: 'center',
  },
  progress: {
    height: 10,
    borderRadius: 5,
    backgroundColor: '#eee',
    marginBottom: 24,
  },
  formContainer: {
    backgroundColor: '#eee',
    borderRadius: 12,
    padding: 8,
    elevation: 3,
  },
  formTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 8,
    color: '#00FFFF',
    textAlign: 'center',
  },
  stepText: {
    fontSize: 14,
    color: '#666',
    marginBottom: 12,
  },
  input: {
    backgroundColor: '#fff',
    marginBottom: 8,
  },
  actions: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    marginTop: 12,
    gap: 10,
  },
  button: {
    paddingVertical: 6,
    paddingHorizontal: 12,
    borderRadius: 6,
  },
  editButton: {
    backgroundColor: '#4CAF50',
  },
  saveButton: {
    backgroundColor: '#00CCFF',
  },
  buttonText: {
    color: '#fff',
    fontWeight: 'bold',
  },
  datePickerContainer: {
    marginBottom: 12,
  },
  label: {
    fontSize: 14,
    marginBottom: 4,
    color: '#333',
  },
  dateInputWrapper: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingVertical: 12,
    paddingHorizontal: 16,
    backgroundColor: '#fff',
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 4,
  },
  dateText: {
    fontSize: 16,
    color: '#000',
  },
  pickerWrapper: {
    position: 'relative',
    justifyContent: 'center',
  },

  pickerInput: {
    fontSize: 16,
    paddingVertical: 12,
    paddingHorizontal: 16,
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 4,
    color: '#000',
    backgroundColor: '#fff',
    paddingRight: 40, // chừa chỗ cho icon
  },

  pickerIcon: {
    position: 'absolute',
    right: 12,
    top: '50%',
    marginTop: -10, // khoảng -1/2 icon size để canh giữa
  },
});

export default EditPersonnel;