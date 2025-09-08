import React, {useState} from 'react';
import {
  Alert,
  SafeAreaView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';
import {ProgressBar} from 'react-native-paper';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import {Personnel} from '../types/PersonnelTypes';
import AddStep1 from './Step/AddStep1';
import AddStep2 from './Step/AddStep2';
import AddStep4 from './Step/AddStep4';
import WrapHeader from '../../../components/WrapHeader.component';
import { NavigationProp, useNavigation } from '@react-navigation/native';
import { RootStackParamList } from '../../../types/navigation';

const AddPersonnel: React.FC = () => {
  const [currentStep, setCurrentStep] = useState(1);
  const navigation = useNavigation<NavigationProp<RootStackParamList>>();
  const [personnelData, setPersonnelData] = useState<Personnel>({
    lv001: '',
    lv002: '',
    lv005: '',
    lv007: '',
    lv008: '',
    lv009: '',
    lv010: '',
    lv011: '',
    lv017: '',
    lv018: '',
    lv019: '',
    lv020: '',
    lv021: '',
    lv022: '',
    lv023: '',
    lv024: '',
    lv025: '',
    lv031: '',
    lv034: '',
    lv035: '',
    lv036: '',
    lv037: '',
    lv038: '',
    lv039: '',
    lv040: '',
    lv041: '',
    lv042: '',
  });

  const validateStep1 = () => {
    const {lv001, lv002, lv010, lv011, lv018, lv034, lv035} = personnelData;

    // Kiểm tra rỗng
    if (!lv001?.trim()) {
      Alert.alert('Vui lòng nhập Mã nhân sự');
      return false;
    }
    if (!lv002?.trim()) {
      Alert.alert('Vui lòng nhập Họ và tên');
      return false;
    }
    if (!lv010?.trim()) {
      Alert.alert('Vui lòng nhập Số CCCD');
      return false;
    }
    // Kiểm tra định dạng CCCD (12 số)
    const cccdRegex = /^\d{12}$/;
    if (!cccdRegex.test(lv010)) {
      Alert.alert('Số CCCD phải bao gồm 12 chữ số');
      return false;
    }
    if (!lv011?.trim()) {
      Alert.alert('Vui lòng nhập Ngày cấp');
      return false;
    }
    // Kiểm tra ngày cấp hợp lệ (định dạng YYYY-MM-DD hoặc DD/MM/YYYY)
    const isValidDate = (dateStr: string) => {
      const regex1 = /^\d{4}-\d{2}-\d{2}$/; // ISO
      const regex2 = /^\d{2}\/\d{2}\/\d{4}$/; // VN
      return regex1.test(dateStr) || regex2.test(dateStr);
    };
    if (!isValidDate(lv011)) {
      Alert.alert(
        'Ngày cấp không hợp lệ. Vui lòng nhập đúng định dạng (VD: 2020-01-01 hoặc 01/01/2020)',
      );
      return false;
    }
    if (!lv018?.trim()) {
      Alert.alert('Vui lòng chọn Giới tính');
      return false;
    }
    if (!lv034?.trim()) {
      Alert.alert('Vui lòng nhập Địa chỉ hộ khẩu');
      return false;
    }
    if (!lv035?.trim()) {
      Alert.alert('Vui lòng nhập Địa chỉ tạm trú');
      return false;
    }

    // Kiểm tra độ dài địa chỉ
    if (lv034.length < 5) {
      Alert.alert('Địa chỉ hộ khẩu quá ngắn');
      return false;
    }
    if (lv035.length < 5) {
      Alert.alert('Địa chỉ tạm trú quá ngắn');
      return false;
    }

    return true;
  };
  const validateStep2 = () => {
    const { lv005, lv008,lv009, lv019,lv020,lv021,lv022,lv023,lv024,lv025,} = personnelData;

    if (!lv005?.trim()) {
      Alert.alert('Vui lòng chọn nhập Chức vụ');
      return false;
    }
    if (!lv008?.trim()) {
      Alert.alert('Vui lòng chọn Nhóm người dùng');
      return false;
    }
    if (!lv009?.trim()) {
      Alert.alert('Vui lòng chọn Trạng thái tuyển dụng');
      return false;
    }
    if (!lv019?.trim()) {
      Alert.alert('Vui lòng chọn Hút thuốc');
      return false;
    }
    if (!lv020?.trim()) {
      Alert.alert('Vui lòng chọn Số BHYT');
      return false;
    }
    if (!lv021?.trim()) {
      Alert.alert('Vui lòng chọn Ngày cấp BHYT');
      return false;
    }
    if (!lv022?.trim()) {
      Alert.alert('Vui lòng chọn Quôc tịch');
      return false;
    }
    if (!lv023?.trim()) {
      Alert.alert('Vui lòng chọn Dân tộc');
      return false;
    }
    if (!lv024?.trim()) {
      Alert.alert('Vui lòng chọn Tôn giáo');
      return false;
    }
    if (!lv025?.trim()) {
      Alert.alert('Vui lòng chọn Màu da');
      return false;
    }

    return true;
  };
  const validateStep4 = () => {
    const {lv031, lv039} = personnelData;
    if (!lv031?.trim()) {
      Alert.alert('Vui lòng chọn Quốc gia');
      return false;
    }
    if (!lv039?.trim()) {
      Alert.alert('Vui lòng nhập Số điện thoại');
      return false;
    }

    return true;
  };
  // Các bước và màu sắc được gán vào mảng cho dễ mở rộng (đã bỏ step 3)
  const steps = [
    {
      component: <AddStep1 data={personnelData} setData={setPersonnelData} />,
      color: '#2196F3', // Changed to a more modern blue
      title: 'Thông tin cơ bản',
    },
    {
      component: <AddStep2 data={personnelData} setData={setPersonnelData} />,
      color: '#4CAF50', // Changed to a more modern green
      title: 'Thông tin liên hệ',
    },
    {
      component: <AddStep4 data={personnelData} setData={setPersonnelData} />,
      color: '#9C27B0', // Changed to a more modern purple
      title: 'Xác nhận thông tin',
    },
  ];

  const renderStep = () => steps[currentStep - 1].component;

  const getProgressColor = () => steps[currentStep - 1].color;

  const getCurrentStepTitle = () => steps[currentStep - 1].title;

  const handleSubmit = () => {
    // Xử lý khi hoàn tất
    console.log('Submitting data:', personnelData);
  };

  const handleNext = () => {
    if (currentStep === 1 && !validateStep1()) return;

    if (currentStep === 2 && !validateStep2()) return;

    if (currentStep === 3 && !validateStep4()) return;

    if (currentStep < 3) setCurrentStep(currentStep + 1);
  };

  const handleBack = () => {
    if (currentStep > 1) setCurrentStep(currentStep - 1);
  };

  return (
    <View style={styles.container}>
      <WrapHeader
        title="Quản lí nhân sự"
        handleBack={() => navigation.goBack()}></WrapHeader>
    <SafeAreaView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.title}>Thêm nhân sự</Text>
        <View style={styles.stepIndicator}>
          <Text style={styles.subtitle}>
            Bước {currentStep}/3: {getCurrentStepTitle()}
          </Text>
          <ProgressBar
            progress={currentStep / 3}
            color={getProgressColor()}
            style={styles.progress}
          />
        </View>
      </View>

      <View style={styles.content}>{renderStep()}</View>

      <View style={styles.footer}>
        <View style={styles.navigationButtons}>
          {currentStep > 1 ? (
            <TouchableOpacity
              style={styles.backButton}
              onPress={handleBack}
              activeOpacity={0.8}>
              <Icon name="arrow-left" size={20} color="#666" />
              <Text style={styles.backButtonText}>Quay lại</Text>
            </TouchableOpacity>
          ) : (
            <View style={{width: 100}} /> // Placeholder for layout balance when back button is not shown
          )}

          <TouchableOpacity
            style={[
              styles.nextButton,
              currentStep === 3 ? styles.submitButton : null,
            ]}
            onPress={currentStep < 3 ? handleNext : handleSubmit}
            activeOpacity={0.8}>
            <Text style={styles.nextButtonText}>
              {currentStep < 3 ? 'Tiếp tục' : 'Hoàn tất'}
            </Text>
            <Icon
              name={currentStep < 3 ? 'arrow-right' : 'check-circle'}
              size={20}
              color="#fff"
            />
          </TouchableOpacity>
        </View>
      </View>
    </SafeAreaView>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f5f5f5',
  },
  header: {
    paddingTop: 16,
    paddingHorizontal: 16,
    backgroundColor: '#fff',
    borderBottomWidth: 1,
    borderBottomColor: '#e0e0e0',
    paddingBottom: 12,
  },
  title: {
    fontSize: 22,
    fontWeight: 'bold',
    marginBottom: 12,
    textAlign: 'center',
    color: '#333',
  },
  stepIndicator: {
    marginBottom: 8,
  },
  subtitle: {
    fontSize: 16,
    color: '#666',
    marginBottom: 8,
    textAlign: 'center',
  },
  progress: {
    height: 8,
    borderRadius: 4,
    backgroundColor: '#e0e0e0',
  },
  content: {
    flex: 1,
    padding: 16,
  },
  footer: {
    padding: 16,
    backgroundColor: '#fff',
    borderTopWidth: 1,
    borderTopColor: '#e0e0e0',
  },
  navigationButtons: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  backButton: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 12,
    paddingHorizontal: 16,
    borderRadius: 8,
    borderWidth: 1,
    borderColor: '#ddd',
    backgroundColor: '#fff',
  },
  backButtonText: {
    marginLeft: 8,
    fontSize: 16,
    color: '#666',
    fontWeight: '500',
  },
  nextButton: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    paddingVertical: 12,
    paddingHorizontal: 20,
    borderRadius: 8,
    backgroundColor: '#2196F3',
    minWidth: 140,
    elevation: 2,
  },
  nextButtonText: {
    marginRight: 8,
    fontSize: 16,
    color: '#fff',
    fontWeight: 'bold',
  },
  submitButton: {
    backgroundColor: '#4CAF50',
  },
});

export default AddPersonnel;
