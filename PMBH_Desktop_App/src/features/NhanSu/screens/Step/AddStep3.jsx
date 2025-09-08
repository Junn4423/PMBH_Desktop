import React, {useEffect, useState} from 'react';
import {
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
} from 'react-native';
import DatePicker from 'react-native-date-picker';
import {Divider} from 'react-native-paper';
import RNPickerSelect from 'react-native-picker-select';
import Icon from 'react-native-vector-icons/MaterialCommunityIcons';
import {
  getDepartment,
  getJobType,
  getRecruitmentStatus,
  getWorkSubject,
} from '../../api/index';
import {Personnel} from '../../types/PersonnelTypes';
import {formatDateFromDate} from '../../utils/helper';

type WorkSubject = {
  lv001: string;
  lv002: string;
};

type JobType = {
  lv001: string;
  lv002: string;
};

type RecruitmentStatus = {
  lv001: string;
  lv002: string;
};

type Department = {
  lv001: string;
  lv002: string;
  lv003: string;
};

type StepProps = {
  data: Personnel;
  setData: React.Dispatch<React.SetStateAction<Personnel>>;
};

const AddStep3: React.FC<StepProps> = ({data, setData}) => {
  const [startDate, setStartDate] = useState<Date>(new Date());
  const [vipDate, setVipDate] = useState<Date>(new Date());
  const [openStartDate, setOpenStartDate] = useState(false);
  const [openVipDate, setOpenVipDate] = useState(false);

  const [listWorkSubject, setListWorkSubject] = useState<WorkSubject[]>([]);
  const [listJobType, setListJobType] = useState<JobType[]>([]);
  const [listRecruitmentStatus, setListRecruitmentStatus] = useState<
    RecruitmentStatus[]
  >([]);
  const [listDepartment, setListDepartment] = useState<Department[]>([]);
  const [loading, setLoading] = useState<boolean>(true);

  // Fetch all dropdown data
  useEffect(() => {
    const fetchAllData = async () => {
      setLoading(true);
      try {
        const [workSubjects, jobTypes, recruitmentStatuses, departments] =
          await Promise.all([
            getWorkSubject(),
            getJobType(),
            getRecruitmentStatus(),
            getDepartment(),
          ]);

        if (Array.isArray(workSubjects)) setListWorkSubject(workSubjects);
        if (Array.isArray(jobTypes)) setListJobType(jobTypes);
        if (Array.isArray(recruitmentStatuses))
          setListRecruitmentStatus(recruitmentStatuses);
        if (Array.isArray(departments)) setListDepartment(departments);
      } catch (error) {
        console.error('Lỗi khi lấy dữ liệu:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchAllData();
  }, []);

  // Initialize dates if data exists
  useEffect(() => {
    if (data.lv030) {
      const parts = data.lv030.split('/');
      if (parts.length === 3) {
        const newDate = new Date(
          parseInt(parts[2]),
          parseInt(parts[1]) - 1,
          parseInt(parts[0]),
        );
        if (!isNaN(newDate.getTime())) {
          setStartDate(newDate);
        }
      }
    }

    if (data.lv044) {
      const parts = data.lv044.split('/');
      if (parts.length === 3) {
        const newDate = new Date(
          parseInt(parts[2]),
          parseInt(parts[1]) - 1,
          parseInt(parts[0]),
        );
        if (!isNaN(newDate.getTime())) {
          setVipDate(newDate);
        }
      }
    }
  }, [data.lv030, data.lv044]);

  return (
    <ScrollView contentContainerStyle={styles.scrollContainer}>
      <View style={styles.formContainer}>
        {/* Work Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin công việc</Text>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Chủ đề công việc <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv026: value || ''}))
                }
                value={data.lv026}
                items={listWorkSubject.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn chủ đề công việc...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="briefcase-outline"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Loại công việc <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv028: value || ''}))
                }
                value={data.lv028}
                items={listJobType.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn loại công việc...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="clipboard-list-outline"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        {/* Department & Recruitment Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Phòng ban & Tuyển dụng</Text>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Trạng thái tuyển dụng <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv027: value || ''}))
                }
                value={data.lv027}
                items={listRecruitmentStatus.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{
                  label: 'Chọn trạng thái tuyển dụng...',
                  value: null,
                }}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="account-check-outline"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Phòng ban <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv029: value || ''}))
                }
                value={data.lv029}
                items={listDepartment.map(item => ({
                  label: `${item.lv003} [${item.lv002}] (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{
                  label: 'Chọn phòng ban...',
                  value: null,
                }}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="office-building"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        {/* Important Dates Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Ngày quan trọng</Text>

          <View style={styles.inputGroup}>
            <View style={styles.datePickerContainer}>
              <Text style={styles.label}>
                Ngày bắt đầu làm việc <Text style={{color: 'red'}}>*</Text>
              </Text>
              <TouchableOpacity
                onPress={() => setOpenStartDate(true)}
                style={styles.dateInputWrapper}>
                <Icon
                  name="calendar-clock"
                  size={20}
                  color="#666"
                  style={styles.dateIcon}
                />
                <Text style={styles.dateText}>
                  {formatDateFromDate(startDate)}
                </Text>
                <Icon name="chevron-down" size={20} color="#666" />
              </TouchableOpacity>
            </View>
          </View>

          <DatePicker
            modal
            open={openStartDate}
            date={startDate}
            mode="date"
            locale="vi"
            title="Chọn ngày bắt đầu làm việc"
            confirmText="Xác nhận"
            cancelText="Huỷ"
            onConfirm={selectedDate => {
              setOpenStartDate(false);
              setStartDate(selectedDate);
              setData(prev => ({
                ...prev,
                lv030: formatDateFromDate(selectedDate),
              }));
            }}
            onCancel={() => setOpenStartDate(false)}
          />

          <View style={styles.inputGroup}>
            <View style={styles.datePickerContainer}>
              <Text style={styles.label}>Ngày lên VIP</Text>
              <TouchableOpacity
                onPress={() => setOpenVipDate(true)}
                style={styles.dateInputWrapper}>
                <Icon
                  name="star-circle"
                  size={20}
                  color="#666"
                  style={styles.dateIcon}
                />
                <Text style={styles.dateText}>
                  {formatDateFromDate(vipDate)}
                </Text>
                <Icon name="chevron-down" size={20} color="#666" />
              </TouchableOpacity>
            </View>
          </View>

          <DatePicker
            modal
            open={openVipDate}
            date={vipDate}
            mode="date"
            locale="vi"
            title="Chọn ngày lên VIP"
            confirmText="Xác nhận"
            cancelText="Huỷ"
            onConfirm={selectedDate => {
              setOpenVipDate(false);
              setVipDate(selectedDate);
              setData(prev => ({
                ...prev,
                lv044: formatDateFromDate(selectedDate),
              }));
            }}
            onCancel={() => setOpenVipDate(false)}
          />
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
    width: '75%', // 3/4 steps
    height: '100%',
    backgroundColor: '#FF9800', // Orange for step 3
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
    paddingVertical: 14,
    paddingHorizontal: 16,
    backgroundColor: '#fff',
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 4,
  },
  dateIcon: {
    marginRight: 10,
  },
  dateText: {
    fontSize: 16,
    color: '#000',
    flex: 1,
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
});

export default AddStep3;
