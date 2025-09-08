import React, {useRef, useState} from 'react';
import {View, StyleSheet, Alert, Platform} from 'react-native';
import {WebView} from 'react-native-webview';
import {Button} from 'react-native-paper';
import RNHTMLtoPDF from 'react-native-html-to-pdf';
import {
  NavigationProp,
  RouteProp,
  useNavigation,
  useRoute,
  CommonActions,
} from '@react-navigation/native';
import WrapHeader from '../../../../components/WrapHeader.component';
import {RootStackParamList} from '../../../../types/navigation';

type ReportRoute = RouteProp<RootStackParamList, 'ReportScreen'>;

function ReportScreen() {
  const nav = useNavigation<NavigationProp<RootStackParamList>>();
  const route = useRoute<ReportRoute>();
  const {maHoaDon} = route.params;
  
  const webViewRef = useRef<WebView>(null);
  const [isWebViewLoaded, setIsWebViewLoaded] = useState(false);

  // Tạo URL với mã hóa đơn
  const reportUrl = `http://192.168.1.101/gmac/soft/sl_lv0013?func=&childfunc=rptretailall&ID=${maHoaDon}&lang=VN`;
  console.log(reportUrl);

  const downloadPDF = async () => {
    try {
      if (!isWebViewLoaded) {
        Alert.alert('Thông báo', 'Vui lòng đợi trang web tải xong trước khi tải PDF');
        return;
      }

      Alert.alert('Đang tạo PDF...', 'Vui lòng đợi một chút');
      
      // Lấy HTML content từ WebView
      webViewRef.current?.injectJavaScript(`
        (function() {
          // Thêm CSS để format cho PDF
          const style = document.createElement('style');
          style.textContent = \`
            body { 
              font-family: Arial, sans-serif; 
              margin: 20px; 
              color: #000 !important;
              background: white !important;
            }
            * { 
              color: #000 !important;
              background: white !important;
            }
            table { 
              border-collapse: collapse; 
              width: 100%; 
              margin: 10px 0;
            }
            th, td { 
              border: 1px solid #000; 
              padding: 8px; 
              text-align: left;
            }
            th { 
              background-color: #f0f0f0 !important;
              font-weight: bold;
            }
            .header { 
              text-align: center; 
              margin-bottom: 20px;
            }
          \`;
          document.head.appendChild(style);
          
          // Trả về HTML content
          window.ReactNativeWebView.postMessage(document.documentElement.outerHTML);
        })();
      `);

    } catch (error) {
      console.error('Lỗi tạo PDF:', error);
      Alert.alert('Lỗi', 'Không thể tạo PDF. Vui lòng thử lại sau.');
    }
  };

  const handleWebViewMessage = async (event: any) => {
    try {
      const htmlContent = event.nativeEvent.data;
      
      const fileName = `HoaDon_${maHoaDon}_${new Date().getTime()}`;
      
      // Sử dụng thư mục app-specific không cần quyền đặc biệt
      const options = {
        html: htmlContent,
        fileName: fileName,
        directory: Platform.OS === 'ios' ? 'Documents' : 'Documents',
        base64: false,
        width: 595,  // A4 width in points
        height: 842, // A4 height in points
      };

      const pdf = await RNHTMLtoPDF.convert(options);
      
      if (pdf.filePath) {
        Alert.alert(
          'Tải xuống thành công!', 
          `PDF đã được tạo và lưu thành công!\n\nTên file: ${fileName}.pdf\n\nBạn có thể tìm file trong ứng dụng quản lý file của thiết bị.`,
          [
            {
              text: 'OK',
              style: 'default',
            }
          ]
        );
      }
    } catch (error) {
      console.error('Lỗi tạo PDF từ HTML:', error);
      Alert.alert('Lỗi', 'Không thể tạo PDF. Vui lòng thử lại sau.');
    }
  };

  const handleBackToHome = () => {
    // Reset navigation stack và quay về BottomNav
    nav.dispatch(
      CommonActions.reset({
        index: 0,
        routes: [{ name: 'BottomNavigation' }],
      })
    );
  };

  return (
    <View style={styles.container}>
      <WrapHeader 
        title="Báo Cáo Thanh Toán" 
        handleBack={() => nav.goBack()}
      >
        <Button
          mode="contained"
          onPress={downloadPDF}
          icon="download"
          compact
          style={styles.downloadButton}
          labelStyle={styles.downloadButtonText}
        >
          PDF
        </Button>
      </WrapHeader>
      <WebView
        ref={webViewRef}
        source={{uri: reportUrl}}
        style={styles.webview}
        startInLoadingState={true}
        scalesPageToFit={true}
        javaScriptEnabled={true}
        domStorageEnabled={true}
        onLoadEnd={() => setIsWebViewLoaded(true)}
        onMessage={handleWebViewMessage}
        onError={(error) => {
          console.error('WebView Error:', error.nativeEvent);
        }}
        onHttpError={(error) => {
          console.error('HTTP Error:', error.nativeEvent);
        }}
      />
      <View style={styles.bottomContainer}>
        <Button
          mode="contained"
          onPress={handleBackToHome}
          icon="home"
          style={styles.backHomeButton}
          labelStyle={styles.backHomeButtonText}
        >
          Trở về Trang Chủ
        </Button>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#b01313ff',
  },
  webview: {
    flex: 1,
  },
  downloadButton: {
    backgroundColor: '#27ae60',
    borderRadius: 20,
    marginRight: 8,
  },
  downloadButtonText: {
    fontSize: 12,
    color: 'white',
    fontWeight: 'bold',
  },
  bottomContainer: {
    padding: 16,
    backgroundColor: '#635151ff',
    borderTopWidth: 1,
    borderTopColor: '#ddd',
  },
  backHomeButton: {
    backgroundColor: '#2196F3',
    borderRadius: 8,
    paddingVertical: 4,
  },
  backHomeButtonText: {
    fontSize: 16,
    color: 'white',
    fontWeight: 'bold',
  },
});

export default ReportScreen;
