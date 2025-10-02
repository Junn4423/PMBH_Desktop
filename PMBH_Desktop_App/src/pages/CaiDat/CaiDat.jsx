import React, { useState, useEffect } from 'react';
import { Typography, Card, Row, Col, Divider, Space, Upload, Input, Select, Button, message } from 'antd';
import { GlobalOutlined, SettingOutlined } from '@ant-design/icons';
import { Image as ImageIcon, Upload as UploadIcon, Link as LinkIcon, Trash2 } from 'lucide-react';
import { LanguageSelect, LanguageDropdown, LanguageFlagSelector } from '../../components/common/LanguageSelector';
import Text from '../../components/common/Text';
import { useLanguageContext } from '../../contexts/LanguageContext';
import receiptLogoManager from '../../utils/receiptLogoManager';

const { Title, Paragraph } = Typography;

const CaiDat = () => {
  const { currentLanguage, getLanguageName, availableLanguages } = useLanguageContext();
  
  // Receipt logo states
  const [receiptLogo, setReceiptLogo] = useState('');
  const [logoUpdateType, setLogoUpdateType] = useState('url');
  const [logoUrl, setLogoUrl] = useState('');
  const [logoFileList, setLogoFileList] = useState([]);
  const [updatingLogo, setUpdatingLogo] = useState(false);

  // Load receipt logo on mount
  useEffect(() => {
    const savedLogo = receiptLogoManager.getLogo();
    if (savedLogo) {
      setReceiptLogo(savedLogo);
    }
  }, []);

  // Handle logo file change
  const handleLogoFileChange = ({ fileList: newFileList }) => {
    setLogoFileList(newFileList);
  };

  // Handle logo update
  const handleLogoUpdate = async () => {
    try {
      setUpdatingLogo(true);
      let success = false;
      let logoToSave = '';

      if (logoUpdateType === 'url' && logoUrl.trim()) {
        // Use URL
        logoToSave = logoUrl.trim();
        success = receiptLogoManager.setLogo(logoToSave);
      } else if (logoUpdateType === 'upload' && logoFileList.length > 0) {
        // Convert file to base64
        const file = logoFileList[0].originFileObj || logoFileList[0];
        logoToSave = await receiptLogoManager.fileToBase64(file);
        success = receiptLogoManager.setLogo(logoToSave);
      }

      if (success) {
        setReceiptLogo(logoToSave);
        message.success('Cập nhật logo hóa đơn thành công');
        // Clear inputs
        setLogoUrl('');
        setLogoFileList([]);
      } else {
        message.error('Không thể cập nhật logo hóa đơn');
      }
    } catch (error) {
      console.error('Error updating receipt logo:', error);
      message.error('Lỗi khi cập nhật logo: ' + error.message);
    } finally {
      setUpdatingLogo(false);
    }
  };

  // Handle logo removal
  const handleLogoRemove = () => {
    const success = receiptLogoManager.removeLogo();
    if (success) {
      setReceiptLogo('');
      setLogoUrl('');
      setLogoFileList([]);
      message.success('Đã xóa logo hóa đơn');
    } else {
      message.error('Không thể xóa logo hóa đơn');
    }
  };

  return (
    <div style={{ padding: '24px', maxWidth: '1200px', margin: '0 auto' }}>
      {/* Header */}
      <div style={{ marginBottom: '24px' }}>
        <Space size="middle">
          <SettingOutlined style={{ fontSize: '24px', color: '#1890ff' }} />
          <Title level={2} style={{ margin: 0 }}>
            <Text module="settings" line={1} fallback="Cài đặt" />
          </Title>
        </Space>
      </div>

      <Row gutter={[24, 24]}>
        {/* Language Settings */}
        <Col xs={24} lg={12}>
          <Card 
            title={
              <Space>
                <GlobalOutlined />
                <Text module="settings" line={46} fallback="Ngôn ngữ" />
              </Space>
            }
            bordered={false}
            style={{ height: '100%' }}
          >
            <div style={{ padding: '8px 0' }}>
              <Paragraph>
                <Text module="settings" line={47} fallback="Chọn ngôn ngữ hiển thị cho ứng dụng" />
              </Paragraph>
              
              <div style={{ marginBottom: '16px' }}>
                <Text 
                  module="common" 
                  line={39} 
                  fallback="Ngôn ngữ hiện tại:" 
                  style={{ fontWeight: 'bold', marginRight: '8px' }}
                />
                <Text>{getLanguageName(currentLanguage)}</Text>
              </div>

              <Space direction="vertical" size="middle" style={{ width: '100%' }}>
                {/* Language Select Dropdown */}
                <div>
                  <Paragraph strong>
                    <Text module="settings" line={48} fallback="Chọn ngôn ngữ (Select Style)" />
                  </Paragraph>
                  <LanguageSelect 
                    style={{ width: '200px' }}
                    placeholder="Chọn ngôn ngữ"
                  />
                </div>

                <Divider />

                {/* Language Dropdown Button */}
                <div>
                  <Paragraph strong>
                    <Text module="settings" line={49} fallback="Chọn ngôn ngữ (Button Style)" />
                  </Paragraph>
                  <LanguageDropdown />
                </div>

                <Divider />

                {/* Language Flag Selector */}
                <div>
                  <Paragraph strong>
                    <Text module="settings" line={50} fallback="Chọn ngôn ngữ (Flag Style)" />
                  </Paragraph>
                  <LanguageFlagSelector />
                </div>
              </Space>

              <div style={{ marginTop: '24px', padding: '12px', backgroundColor: '#f6f8fa', borderRadius: '6px' }}>
                <Paragraph type="secondary" style={{ fontSize: '12px', margin: 0 }}>
                  <Text 
                    module="settings" 
                    line={51} 
                    fallback="Thay đổi ngôn ngữ sẽ được áp dụng ngay lập tức và lưu cho lần sử dụng tiếp theo" 
                  />
                </Paragraph>
              </div>
            </div>
          </Card>
        </Col>

        {/* System Information */}
        <Col xs={24} lg={12}>
          <Card 
            title={
              <Text module="settings" line={8} fallback="Thông tin hệ thống" />
            }
            bordered={false}
            style={{ height: '100%' }}
          >
            <Space direction="vertical" size="small" style={{ width: '100%' }}>
              <div>
                <Text strong>
                  <Text module="settings" line={52} fallback="Phiên bản:" />
                </Text>
                <Text style={{ marginLeft: '8px' }}>1.0.0</Text>
              </div>
              
              <div>
                <Text strong>
                  <Text module="common" line={39} fallback="Ngôn ngữ hiện tại:" />
                </Text>
                <Text style={{ marginLeft: '8px' }}>{getLanguageName(currentLanguage)}</Text>
              </div>
              
              <div>
                <Text strong>
                  <Text module="settings" line={53} fallback="Ngôn ngữ hỗ trợ:" />
                </Text>
                <div style={{ marginTop: '8px' }}>
                  {availableLanguages.map((lang, index) => (
                    <span key={lang.code}>
                      {lang.name}
                      {index < availableLanguages.length - 1 && ', '}
                    </span>
                  ))}
                </div>
              </div>
            </Space>

            <Divider />
            
            <Paragraph type="secondary" style={{ fontSize: '12px' }}>
              <Text 
                module="settings" 
                line={54} 
                fallback="Các tính năng nâng cao cần gói premium để sử dụng" 
              />
            </Paragraph>
          </Card>
        </Col>

        {/* Receipt Logo Settings */}
        <Col xs={24} lg={12}>
          <Card 
            title={
              <Space>
                <ImageIcon size={20} />
                <span>Logo hóa đơn</span>
              </Space>
            }
            bordered={false}
            style={{ height: '100%' }}
          >
            <div style={{ padding: '8px 0' }}>
              <Paragraph>
                Tùy chỉnh logo hiển thị trên hóa đơn in
              </Paragraph>

              {/* Current Logo Preview */}
              {receiptLogo && (
                <div style={{ marginBottom: '16px' }}>
                  <Paragraph strong>Logo hiện tại:</Paragraph>
                  <div style={{ 
                    textAlign: 'center', 
                    padding: '12px',
                    backgroundColor: '#f5f5f5',
                    borderRadius: '6px',
                    marginBottom: '8px'
                  }}>
                    <img 
                      src={receiptLogo} 
                      alt="Receipt Logo"
                      style={{ 
                        maxWidth: '120px', 
                        maxHeight: '120px', 
                        objectFit: 'contain' 
                      }}
                    />
                  </div>
                  <Button 
                    danger 
                    icon={<Trash2 size={16} />}
                    onClick={handleLogoRemove}
                    style={{ width: '100%' }}
                  >
                    Xóa logo
                  </Button>
                </div>
              )}

              <Divider />

              {/* Logo Update Form */}
              <Space direction="vertical" size="middle" style={{ width: '100%' }}>
                <div>
                  <Paragraph strong>Phương thức cập nhật:</Paragraph>
                  <Select 
                    value={logoUpdateType}
                    onChange={setLogoUpdateType}
                    style={{ width: '100%' }}
                  >
                    <Select.Option value="url">
                      <Space>
                        <LinkIcon size={14} />
                        <span>Nhập URL ảnh</span>
                      </Space>
                    </Select.Option>
                    <Select.Option value="upload">
                      <Space>
                        <UploadIcon size={14} />
                        <span>Tải ảnh lên</span>
                      </Space>
                    </Select.Option>
                  </Select>
                </div>

                {logoUpdateType === 'url' ? (
                  <div>
                    <Paragraph strong>URL ảnh logo:</Paragraph>
                    <Input
                      value={logoUrl}
                      onChange={(e) => setLogoUrl(e.target.value)}
                      placeholder="Nhập URL ảnh logo..."
                      prefix={<LinkIcon size={14} />}
                    />
                  </div>
                ) : (
                  <div>
                    <Paragraph strong>Chọn ảnh logo:</Paragraph>
                    <Upload
                      listType="picture-card"
                      fileList={logoFileList}
                      onChange={handleLogoFileChange}
                      beforeUpload={() => false}
                      accept="image/*"
                      maxCount={1}
                    >
                      {logoFileList.length < 1 && (
                        <div>
                          <UploadIcon size={20} />
                          <div style={{ marginTop: 8 }}>Chọn ảnh</div>
                        </div>
                      )}
                    </Upload>
                  </div>
                )}

                <Button 
                  type="primary"
                  onClick={handleLogoUpdate}
                  loading={updatingLogo}
                  disabled={
                    (logoUpdateType === 'url' && !logoUrl.trim()) ||
                    (logoUpdateType === 'upload' && logoFileList.length === 0)
                  }
                  style={{ width: '100%', background: '#197dd3' }}
                >
                  Cập nhật logo
                </Button>
              </Space>

              <div style={{ marginTop: '16px', padding: '12px', backgroundColor: '#f6f8fa', borderRadius: '6px' }}>
                <Paragraph type="secondary" style={{ fontSize: '12px', margin: 0 }}>
                  Logo sẽ được hiển thị ở đầu tất cả hóa đơn in. Kích thước đề xuất: 200x200px
                </Paragraph>
              </div>
            </div>
          </Card>
        </Col>

        {/* Interface Settings */}
        <Col xs={24}>
          <Card 
            title={
              <Text module="settings" line={42} fallback="Cài đặt giao diện" />
            }
            bordered={false}
          >
            <Paragraph>
              <Text 
                module="settings" 
                line={55} 
                fallback="Các tùy chọn giao diện khác sẽ có sẵn trong phiên bản premium" 
              />
            </Paragraph>
          </Card>
        </Col>
      </Row>
    </div>
  );
};

export default CaiDat;
