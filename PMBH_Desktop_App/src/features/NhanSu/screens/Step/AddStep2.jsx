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
import {
  getColor,
  getNation,
  getNationality,
  getReligion,
  getStatus,
  getUserGroup,
} from '../../api/index';
import {Personnel} from '../../types/PersonnelTypes';
import {formatDateFromDate} from '../../utils/helper';

type UserGroup = {
  lv001: string;
  lv002: string;
};

type Status = {
  lv001: string;
  lv002: string;
};

type Nation = {
  lv001: string;
  lv002: string;
};

type Nationality = {
  lv001: string;
  lv002: string;
};

type Religion = {
  lv001: string;
  lv002: string;
};

type Color = {
  lv001: string;
  lv002: string;
};

type StepProps = {
  data: Personnel;
  setData: React.Dispatch<React.SetStateAction<Personnel>>;
};

const AddStep2: React.FC<StepProps> = ({data, setData}) => {
  const [date, setDate] = useState<Date>(new Date());
  const [open, setOpen] = useState<boolean>(false);

  const [listUserGroup, setListUserGroup] = useState<UserGroup[]>([]);
  const [listStatus, setListStatus] = useState<Status[]>([]);
  const [listNation, setListNation] = useState<Nation[]>([]);
  const [listNationality, setListNationality] = useState<Nationality[]>([]);
  const [listReligion, setListReligion] = useState<Religion[]>([]);
  const [listColor, setListColor] = useState<Color[]>([]);
  const [loading, setLoading] = useState<boolean>(true);

  // Fetch all dropdown data
  useEffect(() => {
    const fetchAllData = async () => {
      setLoading(true);
      try {
        const [
          userGroups,
          statuses,
          nations,
          nationalities,
          religions,
          colors,
        ] = await Promise.all([
          getUserGroup(),
          getStatus(),
          getNation(),
          getNationality(),
          getReligion(),
          getColor(),
        ]);

        if (Array.isArray(userGroups)) setListUserGroup(userGroups);
        if (Array.isArray(statuses)) setListStatus(statuses);
        if (Array.isArray(nations)) setListNation(nations);
        if (Array.isArray(nationalities)) setListNationality(nationalities);
        if (Array.isArray(religions)) setListReligion(religions);
        if (Array.isArray(colors)) setListColor(colors);
      } catch (error) {
        console.error('Lỗi khi lấy dữ liệu:', error);
      } finally {
        setLoading(false);
      }
    };

    fetchAllData();
  }, []);

  // Initialize date if data.lv021 exists
  useEffect(() => {
    if (data.lv021) {
      const parts = data.lv021.split('/');
      if (parts.length === 3) {
        const newDate = new Date(
          parseInt(parts[2]),
          parseInt(parts[1]) - 1,
          parseInt(parts[0]),
        );
        if (!isNaN(newDate.getTime())) {
          setDate(newDate);
        }
      }
    }
  }, [data.lv021]);

  return (
    <ScrollView contentContainerStyle={styles.scrollContainer}>
      <View style={styles.formContainer}>
        {/* Work Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin công việc</Text>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Chức vụ"
                mode="outlined"
                value={data.lv005}
                onChangeText={text => setData(prev => ({...prev, lv005: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                left={<TextInput.Icon icon="briefcase" color="#666" />}
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Nhóm người dùng <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv008: value || ''}))
                }
                value={data.lv008}
                items={listUserGroup.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn nhóm người dùng...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="account-group"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Trạng thái <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv009: value || ''}))
                }
                value={data.lv009}
                items={listStatus.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn trạng thái...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="account-check"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>
        </View>

        <Divider style={styles.divider} />

        {/* Health Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin sức khỏe</Text>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Hút thuốc <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv019: value || ''}))
                }
                value={data.lv019}
                items={[
                  {label: 'Không', value: '0'},
                  {label: 'Có', value: '1'},
                ]}
                placeholder={{label: 'Chọn...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="smoking"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.inputWithIcon}>
              <TextInput
                label="Số BHYT"
                mode="outlined"
                value={data.lv020}
                onChangeText={text => setData(prev => ({...prev, lv020: text}))}
                style={styles.input}
                outlineColor="#ddd"
                activeOutlineColor="#2196F3"
                left={
                  <TextInput.Icon
                    icon="card-account-details-outline"
                    color="#666"
                  />
                }
                right={<TextInput.Icon icon="asterisk" size={15} color="red" />}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <View style={styles.datePickerContainer}>
              <Text style={styles.label}>
                Ngày cấp BHYT <Text style={{color: 'red'}}>*</Text>
              </Text>
              <TouchableOpacity
                onPress={() => setOpen(true)}
                style={styles.dateInputWrapper}>
                <Icon
                  name="calendar"
                  size={20}
                  color="#666"
                  style={styles.dateIcon}
                />
                <Text style={styles.dateText}>{formatDateFromDate(date)}</Text>
                <Icon name="chevron-down" size={20} color="#666" />
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
                lv021: formatDateFromDate(selectedDate),
              }));
            }}
            onCancel={() => setOpen(false)}
          />
        </View>

        <Divider style={styles.divider} />

        {/* Personal Information Section */}
        <View style={styles.formSection}>
          <Text style={styles.sectionTitle}>Thông tin cá nhân</Text>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Dân tộc<Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv023: value || ''}))
                }
                value={data.lv023}
                items={listNation.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn dân tộc...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="account-group"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Quốc tịch <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv022: value || ''}))
                }
                value={data.lv022}
                items={listNationality.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn quốc tịch...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="flag"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Tôn giáo <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv024: value || ''}))
                }
                value={data.lv024}
                items={listReligion.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn tôn giáo...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="church"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>

          <View style={styles.inputGroup}>
            <Text style={styles.label}>
              Màu da <Text style={{color: 'red'}}>*</Text>
            </Text>
            <View style={styles.pickerWrapper}>
              <RNPickerSelect
                onValueChange={value =>
                  setData(prev => ({...prev, lv025: value || ''}))
                }
                value={data.lv025}
                items={listColor.map(item => ({
                  label: `${item.lv002} (${item.lv001})`,
                  value: item.lv001,
                }))}
                placeholder={{label: 'Chọn màu da...', value: null}}
                style={{
                  inputIOS: styles.pickerInput,
                  inputAndroid: styles.pickerInput,
                  iconContainer: styles.pickerIcon,
                }}
                useNativeAndroidPickerStyle={false}
                Icon={() => <Icon name="chevron-down" size={20} color="#666" />}
              />
              <Icon
                name="palette"
                size={20}
                color="#666"
                style={styles.pickerLeftIcon}
              />
            </View>
          </View>
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
    width: '50%', // 2/4 steps
    height: '100%',
    backgroundColor: '#4CAF50',
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

export default AddStep2;
