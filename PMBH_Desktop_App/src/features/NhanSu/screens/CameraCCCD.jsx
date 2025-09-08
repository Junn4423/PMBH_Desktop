import React, { useEffect, useRef, useState } from 'react';
import {
  PermissionsAndroid,
  Platform,
  StyleSheet,
  Text,
  View,
  TouchableOpacity,
  ActivityIndicator,
  Image,
  Alert,
} from 'react-native';
import { Camera, useCameraDevice, PhotoFile, CameraPermissionStatus} from 'react-native-vision-camera';
import { ScanCCCD } from '../api/index';
import { useNavigation } from '@react-navigation/native';
import type { NativeStackNavigationProp } from '@react-navigation/native-stack';

type RootStackParamList = {
  AddPersonnel: { cccdData: any };
  CameraCCCD: undefined;
};

type NavigationProp = NativeStackNavigationProp<RootStackParamList, 'CameraCCCD'>;

export default function CameraCCCD() {
  const navigation = useNavigation<NavigationProp>();
  const device = useCameraDevice('back');
  const cameraRef = useRef<Camera>(null);
  const [permissionGranted, setPermissionGranted] = useState(false);
  const [loading, setLoading] = useState(false);
  const [isCameraActive, setIsCameraActive] = useState(true);
  const [capturedPhoto, setCapturedPhoto] = useState<string | null>(null);

  useEffect(() => {
    const requestPermissions = async () => {
      let granted = false;
      if (Platform.OS === 'android') {
        const result = await PermissionsAndroid.request(
          PermissionsAndroid.PERMISSIONS.CAMERA,
          {
            title: 'Yêu cầu quyền camera',
            message: 'Ứng dụng cần quyền truy cập camera để hoạt động.',
            buttonNeutral: 'Hỏi lại sau',
            buttonNegative: 'Từ chối',
            buttonPositive: 'Đồng ý',
          },
        );
        granted = result === PermissionsAndroid.RESULTS.GRANTED;
      } else {
        const status = await Camera.requestCameraPermission();
        granted = status === 'granted';
      }
      setPermissionGranted(granted);
    };

    requestPermissions();
  }, []);

  const takePhoto = async () => {
    if (!cameraRef.current) return;

    try {
      setLoading(true);
      const photo: PhotoFile = await cameraRef.current.takePhoto({ flash: 'off' });
      setCapturedPhoto(photo.path);
      setIsCameraActive(false);
    } catch (error) {
      console.log('Lỗi chụp ảnh:', error);
    } finally {
      setLoading(false);
    }
  };

  const confirmPhoto = async () => {
    if (!capturedPhoto) return;

    try {
      setLoading(true);
      const result = await ScanCCCD(capturedPhoto);

      if (!result || result.error) {
        Alert.alert('Thất bại', 'Không thể nhận diện CCCD. Vui lòng chụp lại!');
        return;
      }

      navigation.navigate('AddPersonnel', { cccdData: result });
    } catch (error) {
      console.log('Lỗi gửi ảnh:', error);
      Alert.alert(
        'Lỗi',
        'Có lỗi xảy ra khi gửi ảnh. Vui lòng chụp lại ảnh khác.',
      );
    } finally {
      setLoading(false);
    }
  };

  const retakePhoto = () => {
    setCapturedPhoto(null);
    setIsCameraActive(true);
  };

  if (device == null || !permissionGranted) {
    return (
      <View style={styles.centered}>
        <Text>Không tìm thấy camera hoặc chưa cấp quyền</Text>
      </View>
    );
  }

  return (
    <View style={styles.container}>
      {isCameraActive && (
        <Camera
          ref={cameraRef}
          style={StyleSheet.absoluteFill}
          device={device}
          isActive={true}
          photo={true}
        />
      )}

      {isCameraActive && (
        <View style={styles.overlay}>
          <View style={styles.frame} />
        </View>
      )}

      {isCameraActive && !loading && (
        <TouchableOpacity style={styles.captureButton} onPress={takePhoto}>
          <Text style={styles.captureText}>Chụp CCCD</Text>
        </TouchableOpacity>
      )}

      {capturedPhoto && (
        <View style={styles.previewContainer}>
          <Image
            source={{ uri: 'file://' + capturedPhoto }}
            style={styles.previewImage}
          />
          <View style={styles.buttonRow}>
            <TouchableOpacity style={styles.actionButton} onPress={retakePhoto}>
              <Text style={styles.buttonText}>Chụp lại</Text>
            </TouchableOpacity>
            <TouchableOpacity style={styles.actionButton} onPress={confirmPhoto}>
              <Text style={styles.buttonText}>Dùng ảnh này</Text>
            </TouchableOpacity>
          </View>
        </View>
      )}

      {loading && (
        <View style={styles.loading}>
          <ActivityIndicator size="large" color="#fff" />
          <Text style={{ color: '#fff', marginTop: 10 }}>Đang xử lý...</Text>
        </View>
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  centered: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  overlay: {
    ...StyleSheet.absoluteFillObject,
    justifyContent: 'center',
    alignItems: 'center',
  },
  frame: {
    width: 360,
    height: 240,
    borderWidth: 2,
    borderColor: '#00FF00',
    borderRadius: 10,
    backgroundColor: 'transparent',
  },
  captureButton: {
    position: 'absolute',
    bottom: 40,
    alignSelf: 'center',
    backgroundColor: '#ffffffcc',
    padding: 16,
    borderRadius: 50,
  },
  captureText: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#000',
  },
  loading: {
    position: 'absolute',
    top: '40%',
    left: 0,
    right: 0,
    alignItems: 'center',
  },
  previewContainer: {
    ...StyleSheet.absoluteFillObject,
    backgroundColor: 'black',
    justifyContent: 'center',
    alignItems: 'center',
  },
  previewImage: {
    width: '100%',
    height: '100%',
    resizeMode: 'contain',
  },
  buttonRow: {
    position: 'absolute',
    bottom: 40,
    flexDirection: 'row',
    justifyContent: 'space-around',
    width: '100%',
    paddingHorizontal: 20,
  },
  actionButton: {
    backgroundColor: '#ffffffcc',
    padding: 14,
    borderRadius: 10,
    minWidth: 120,
    alignItems: 'center',
  },
  buttonText: {
    fontWeight: 'bold',
    fontSize: 16,
    color: '#000',
  },
});
