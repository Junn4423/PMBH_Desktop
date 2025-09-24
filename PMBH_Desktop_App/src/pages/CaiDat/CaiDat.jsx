import React from 'react';
import { Typography, Card, Row, Col, Divider, Space } from 'antd';
import { GlobalOutlined, SettingOutlined } from '@ant-design/icons';
import { LanguageSelect, LanguageDropdown, LanguageFlagSelector } from '../../components/common/LanguageSelector';
import Text from '../../components/common/Text';
import { useLanguageContext } from '../../contexts/LanguageContext';

const { Title, Paragraph } = Typography;

const CaiDat = () => {
  const { currentLanguage, getLanguageName, availableLanguages } = useLanguageContext();

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
