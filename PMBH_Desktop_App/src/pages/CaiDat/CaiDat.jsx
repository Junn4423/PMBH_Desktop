import React, { useState, useEffect } from 'react';
import { Typography, Card, Row, Col, Divider, Space, Upload, Input, Select, Button, message, Progress, Table, Modal, Tag, Popconfirm, Switch } from 'antd';
import { GlobalOutlined, SettingOutlined } from '@ant-design/icons';
import { Image as ImageIcon, Upload as UploadIcon, Link as LinkIcon, Trash2, HardDrive, Database, Download, Eye, RefreshCw } from 'lucide-react';
import { LanguageSelect, LanguageDropdown, LanguageFlagSelector } from '../../components/common/LanguageSelector';
import Text from '../../components/common/Text';
import { useLanguageContext } from '../../contexts/LanguageContext';
import receiptLogoManager from '../../utils/receiptLogoManager';
import localStorageManager from '../../utils/localStorageManager';
import './CaiDat.css';

const { Title, Paragraph } = Typography;

const CaiDat = () => {
  const { currentLanguage, getLanguageName, availableLanguages, changeLanguage } = useLanguageContext();
  
  // Language loading states
  const [languageLoading, setLanguageLoading] = useState(false);
  const [languageProgress, setLanguageProgress] = useState(0);
  
  // Receipt logo states
  const [receiptLogo, setReceiptLogo] = useState('');
  const [logoUpdateType, setLogoUpdateType] = useState('url');
  const [logoUrl, setLogoUrl] = useState('');
  const [logoFileList, setLogoFileList] = useState([]);
  const [updatingLogo, setUpdatingLogo] = useState(false);

  // LocalStorage states
  const [storageStats, setStorageStats] = useState(null);
  const [storageEstimate, setStorageEstimate] = useState(null);
  const [viewItemModal, setViewItemModal] = useState(false);
  const [selectedItem, setSelectedItem] = useState(null);
  const [refreshKey, setRefreshKey] = useState(0);

  // Dual Screen Mode states
  const [dualScreenEnabled, setDualScreenEnabled] = useState(false);
  const [dualScreenLoading, setDualScreenLoading] = useState(false);

  // Load receipt logo on mount
  useEffect(() => {
    const savedLogo = receiptLogoManager.getLogo();
    if (savedLogo) {
      setReceiptLogo(savedLogo);
    }
    loadStorageStats();
    
    // Load dual screen mode setting
    const savedDualScreen = localStorage.getItem('pmbh_dual_screen_mode');
    if (savedDualScreen) {
      setDualScreenEnabled(savedDualScreen === 'true');
    }
  }, []);

  // Reload storage stats when refreshKey changes
  useEffect(() => {
    loadStorageStats();
  }, [refreshKey]);

  // Handle language switch with loading bar
  const handleLanguageSwitch = async (checked) => {
    const newLanguage = checked ? 'EN' : 'VN';
    if (newLanguage === currentLanguage) return;

    setLanguageLoading(true);
    setLanguageProgress(0);

    // Simulate 5 second loading with progress updates
    const progressInterval = setInterval(() => {
      setLanguageProgress(prev => {
        if (prev >= 100) {
          clearInterval(progressInterval);
          return 100;
        }
        return prev + 2; // 100% in 5 seconds (50 steps * 100ms)
      });
    }, 100);

    try {
      // Wait for 5 seconds
      await new Promise(resolve => setTimeout(resolve, 5000));
      
      // Change language after loading completes
      await changeLanguage(newLanguage);
      message.success(`Đã chuyển sang ${newLanguage === 'EN' ? 'Tiếng Anh' : 'Tiếng Việt'}`);
    } catch (error) {
      console.error('Error changing language:', error);
      message.error('Lỗi khi chuyển đổi ngôn ngữ');
    } finally {
      clearInterval(progressInterval);
      setLanguageLoading(false);
      setLanguageProgress(0);
    }
  };

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
      setRefreshKey(prev => prev + 1); // Refresh storage stats
    } else {
      message.error('Không thể xóa logo hóa đơn');
    }
  };

  // Load storage statistics
  const loadStorageStats = async () => {
    try {
      const stats = localStorageManager.getStatistics();
      setStorageStats(stats);

      // Get Chromium storage estimate
      const estimate = await localStorageManager.getStorageEstimate();
      setStorageEstimate(estimate);
    } catch (error) {
      console.error('Error loading storage stats:', error);
    }
  };

  // Handle dual screen mode toggle
  const handleDualScreenToggle = async (checked) => {
    try {
      setDualScreenLoading(true);
      
      if (checked) {
        // Open customer display window
        if (window.electronAPI && window.electronAPI.openCustomerDisplay) {
          const result = await window.electronAPI.openCustomerDisplay();
          if (result.success) {
            setDualScreenEnabled(true);
            localStorage.setItem('pmbh_dual_screen_mode', 'true');
            message.success('Đã bật chế độ màn hình kép');
          } else {
            message.error('Không thể mở màn hình khách hàng');
          }
        } else {
          message.error('Chức năng chưa được hỗ trợ');
        }
      } else {
        // Close customer display window
        if (window.electronAPI && window.electronAPI.closeCustomerDisplay) {
          await window.electronAPI.closeCustomerDisplay();
          setDualScreenEnabled(false);
          localStorage.setItem('pmbh_dual_screen_mode', 'false');
          message.success('Đã tắt chế độ màn hình kép');
        }
      }
    } catch (error) {
      console.error('Error toggling dual screen:', error);
      message.error('Lỗi khi chuyển đổi chế độ màn hình');
    } finally {
      setDualScreenLoading(false);
    }
  };

  // Handle view item details
  const handleViewItem = (item) => {
    setSelectedItem(item);
    setViewItemModal(true);
  };

  // Handle delete item
  const handleDeleteItem = (key) => {
    const success = localStorageManager.removeItem(key);
    if (success) {
      message.success(`Đã xóa item: ${key}`);
      setRefreshKey(prev => prev + 1);
    } else {
      message.error('Không thể xóa item');
    }
  };

  // Handle clear all
  const handleClearAll = () => {
    const success = localStorageManager.clearAll();
    if (success) {
      message.success('Đã xóa toàn bộ localStorage');
      setRefreshKey(prev => prev + 1);
    } else {
      message.error('Không thể xóa localStorage');
    }
  };

  // Handle export data
  const handleExportData = () => {
    try {
      const data = localStorageManager.exportData();
      const blob = new Blob([data], { type: 'application/json' });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = `localStorage_backup_${new Date().getTime()}.json`;
      a.click();
      URL.revokeObjectURL(url);
      message.success('Đã xuất dữ liệu localStorage');
    } catch (error) {
      console.error('Error exporting data:', error);
      message.error('Không thể xuất dữ liệu');
    }
  };

  // Table columns for localStorage items
  const storageColumns = [
    {
      title: 'Key',
      dataIndex: 'key',
      key: 'key',
      width: '30%',
      ellipsis: true,
    },
    {
      title: 'Loại',
      dataIndex: 'key',
      key: 'type',
      width: '15%',
      render: (_, record) => {
        const type = localStorageManager.getValueType(record.value);
        const colors = {
          'JSON Object': 'blue',
          'JSON Array': 'cyan',
          'Base64 Image': 'purple',
          'URL': 'green',
          'String': 'default',
          'Empty': 'default'
        };
        return <Tag color={colors[type]}>{type}</Tag>;
      }
    },
    {
      title: 'Kích thước',
      dataIndex: 'sizeFormatted',
      key: 'size',
      width: '15%',
      sorter: (a, b) => a.size - b.size,
    },
    {
      title: 'Hành động',
      key: 'action',
      width: '20%',
      render: (_, record) => (
        <Space size="small">
          <Button 
            size="small" 
            icon={<Eye size={14} />}
            onClick={() => handleViewItem(record)}
          >
            Xem
          </Button>
          <Popconfirm
            title="Xóa item này?"
            description="Bạn có chắc muốn xóa item này?"
            onConfirm={() => handleDeleteItem(record.key)}
            okText="Xóa"
            cancelText="Hủy"
          >
            <Button 
              size="small" 
              danger
              icon={<Trash2 size={14} />}
            >
              Xóa
            </Button>
          </Popconfirm>
        </Space>
      ),
    },
  ];

  return (
    <div className="caidat-container">
      {/* Header */}
      <div className="caidat-header">
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
            className="caidat-card"
            title={
              <Space>
                <GlobalOutlined />
                <Text module="settings" line={46} fallback="Ngôn ngữ" />
              </Space>
            }
            bordered={false}
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
                {/* Language Switch (VN/EN) with Loading Bar */}
                <div>
                  <Paragraph strong>Chuyển đổi ngôn ngữ (VN/EN)</Paragraph>
                  <Space direction="vertical" style={{ width: '100%' }}>
                    <Space>
                      <span>Tiếng Việt</span>
                      <Switch 
                        checked={currentLanguage === 'EN'}
                        onChange={handleLanguageSwitch}
                        loading={languageLoading}
                        disabled={languageLoading}
                        checkedChildren="EN"
                        unCheckedChildren="VN"
                      />
                      <span>English</span>
                    </Space>
                    {languageLoading && (
                      <div style={{ width: '100%', marginTop: '8px' }}>
                        <Progress 
                          percent={languageProgress} 
                          status="active"
                          strokeColor={{
                            from: '#108ee9',
                            to: '#87d068',
                          }}
                          format={percent => `${percent}%`}
                        />
                        <Text 
                          type="secondary" 
                          style={{ fontSize: '12px', marginTop: '4px', display: 'block' }}
                        >
                          Đang chuyển đổi ngôn ngữ, vui lòng chờ...
                        </Text>
                      </div>
                    )}
                  </Space>
                </div>

                <Divider />

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
            className="caidat-card"
            title={
              <Text module="settings" line={8} fallback="Thông tin hệ thống" />
            }
            bordered={false}
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
            className="caidat-card"
            title={
              <Space>
                <ImageIcon size={20} />
                <span>Logo hóa đơn</span>
              </Space>
            }
            bordered={false}
          >
            <div className="logo-upload-section">
              <Paragraph>
                Tùy chỉnh logo hiển thị trên hóa đơn in
              </Paragraph>

              {/* Current Logo Preview */}
              {receiptLogo && (
                <div style={{ marginBottom: '16px' }}>
                  <Paragraph strong>Logo hiện tại:</Paragraph>
                  <div className="logo-preview-container">
                    <img 
                      src={receiptLogo} 
                      alt="Receipt Logo"
                      className="logo-preview-image"
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

              <div className="info-box">
                <Paragraph type="secondary" style={{ fontSize: '12px', margin: 0 }}>
                  Logo sẽ được hiển thị ở đầu tất cả hóa đơn in. Kích thước đề xuất: 200x200px
                </Paragraph>
              </div>
            </div>
          </Card>
        </Col>

        {/* LocalStorage Management */}
        <Col xs={24}>
          <Card 
            className="caidat-card"
            title={
              <Space>
                <HardDrive size={20} />
                <span>Quản lý LocalStorage</span>
              </Space>
            }
            extra={
              <Space>
                <Button 
                  icon={<RefreshCw size={16} />}
                  onClick={() => setRefreshKey(prev => prev + 1)}
                  size="small"
                >
                  Làm mới
                </Button>
                <Button 
                  icon={<Download size={16} />}
                  onClick={handleExportData}
                  size="small"
                >
                  Xuất dữ liệu
                </Button>
              </Space>
            }
            bordered={false}
          >
            {storageStats && (
              <div style={{ padding: '8px 0' }}>
                {/* Storage Overview */}
                <Row gutter={[16, 16]} style={{ marginBottom: '24px' }}>
                  <Col xs={24} md={8}>
                    <Card 
                      size="small" 
                      style={{ background: '#f0f9ff', borderColor: '#197dd3' }}
                    >
                      <div style={{ textAlign: 'center' }}>
                        <Database size={32} color="#197dd3" />
                        <div style={{ fontSize: '24px', fontWeight: 'bold', marginTop: '8px' }}>
                          {storageStats.itemCount}
                        </div>
                        <div style={{ color: '#666', fontSize: '12px' }}>Items trong LocalStorage</div>
                      </div>
                    </Card>
                  </Col>
                  <Col xs={24} md={8}>
                    <Card 
                      size="small" 
                      style={{ background: '#f0fdf4', borderColor: '#22c55e' }}
                    >
                      <div style={{ textAlign: 'center' }}>
                        <HardDrive size={32} color="#22c55e" />
                        <div style={{ fontSize: '24px', fontWeight: 'bold', marginTop: '8px' }}>
                          {storageStats.totalSizeFormatted}
                        </div>
                        <div style={{ color: '#666', fontSize: '12px' }}>Đã sử dụng</div>
                      </div>
                    </Card>
                  </Col>
                  <Col xs={24} md={8}>
                    <Card 
                      size="small" 
                      style={{ background: '#fef3c7', borderColor: '#f59e0b' }}
                    >
                      <div style={{ textAlign: 'center' }}>
                        <Database size={32} color="#f59e0b" />
                        <div style={{ fontSize: '24px', fontWeight: 'bold', marginTop: '8px' }}>
                          {storageStats.remainingFormatted}
                        </div>
                        <div style={{ color: '#666', fontSize: '12px' }}>Còn lại (ước tính)</div>
                      </div>
                    </Card>
                  </Col>
                </Row>

                {/* Storage Progress Bar */}
                <div style={{ marginBottom: '24px' }}>
                  <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '8px' }}>
                    <span style={{ fontWeight: 'bold' }}>LocalStorage Usage:</span>
                    <span style={{ color: '#666' }}>
                      {storageStats.totalSizeFormatted} / {storageStats.quotaFormatted} 
                      ({storageStats.percentage}%)
                    </span>
                  </div>
                  <Progress 
                    percent={parseFloat(storageStats.percentage)} 
                    strokeColor={{
                      '0%': '#197dd3',
                      '100%': '#77d4fb',
                    }}
                    status={parseFloat(storageStats.percentage) > 80 ? 'exception' : 'active'}
                  />
                </div>

                {/* Chromium Storage Estimate */}
                {storageEstimate && (
                  <div style={{ marginBottom: '24px', padding: '12px', background: '#f6f8fa', borderRadius: '6px' }}>
                    <Paragraph strong>Chromium Storage Estimate:</Paragraph>
                    <Row gutter={[8, 8]}>
                      <Col span={12}>
                        <div style={{ fontSize: '12px', color: '#666' }}>Đã sử dụng:</div>
                        <div style={{ fontWeight: 'bold' }}>{storageEstimate.usageFormatted}</div>
                      </Col>
                      <Col span={12}>
                        <div style={{ fontSize: '12px', color: '#666' }}>Quota:</div>
                        <div style={{ fontWeight: 'bold' }}>{storageEstimate.quotaFormatted}</div>
                      </Col>
                    </Row>
                    <Progress 
                      percent={parseFloat(storageEstimate.percentage)} 
                      size="small"
                      style={{ marginTop: '8px' }}
                    />
                  </div>
                )}

                <Divider />

                {/* Items Table */}
                <div style={{ marginBottom: '16px', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                  <Paragraph strong style={{ margin: 0 }}>
                    Danh sách Items trong LocalStorage:
                  </Paragraph>
                  <Popconfirm
                    title="Xóa toàn bộ localStorage?"
                    description="Cảnh báo: Hành động này không thể hoàn tác!"
                    onConfirm={handleClearAll}
                    okText="Xóa tất cả"
                    cancelText="Hủy"
                    okButtonProps={{ danger: true }}
                  >
                    <Button 
                      danger 
                      size="small"
                      icon={<Trash2 size={14} />}
                    >
                      Xóa tất cả
                    </Button>
                  </Popconfirm>
                </div>

                <Table 
                  columns={storageColumns}
                  dataSource={storageStats.items}
                  rowKey="key"
                  size="small"
                  pagination={{ 
                    pageSize: 10,
                    showSizeChanger: true,
                    showTotal: (total) => `Tổng ${total} items`
                  }}
                  scroll={{ x: 'max-content' }}
                />

                <div className="info-box" style={{ marginTop: '16px' }}>
                  <Paragraph type="secondary" style={{ fontSize: '12px', margin: 0 }}>
                    💡 <strong>Lưu ý:</strong> LocalStorage có giới hạn khoảng 5-10MB tùy trình duyệt. 
                    Chromium Storage bao gồm cả IndexedDB, Cache API và các storage khác.
                  </Paragraph>
                </div>
              </div>
            )}
          </Card>
        </Col>

        {/* Interface Settings */}
        <Col xs={24}>
          <Card 
            className="caidat-card"
            title={
              <Text module="settings" line={42} fallback="Cài đặt giao diện" />
            }
            bordered={false}
          >
            <Space direction="vertical" size="large" style={{ width: '100%' }}>
              {/* Dual Screen Mode */}
              <div>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '8px' }}>
                  <div>
                    <Paragraph strong style={{ margin: 0 }}>
                      Chế độ màn hình kép (Dual Screen Mode)
                    </Paragraph>
                    <Paragraph type="secondary" style={{ margin: '4px 0 0 0', fontSize: '12px' }}>
                      Mở màn hình riêng để hiển thị đơn hàng cho khách hàng
                    </Paragraph>
                  </div>
                  <Switch 
                    checked={dualScreenEnabled}
                    onChange={handleDualScreenToggle}
                    loading={dualScreenLoading}
                    disabled={dualScreenLoading}
                    checkedChildren="BẬT"
                    unCheckedChildren="TẮT"
                  />
                </div>
                
                {dualScreenEnabled && (
                  <div style={{ 
                    padding: '12px', 
                    background: '#e6f7ff', 
                    borderRadius: '6px',
                    borderLeft: '3px solid #197dd3',
                    marginTop: '12px'
                  }}>
                    <Paragraph style={{ margin: 0, fontSize: '12px', color: '#197dd3' }}>
                      ✓ Màn hình khách hàng đang hoạt động
                    </Paragraph>
                  </div>
                )}
              </div>

              <Divider style={{ margin: '12px 0' }} />

              <Paragraph type="secondary" style={{ fontSize: '12px', margin: 0 }}>
                <Text 
                  module="settings" 
                  line={55} 
                  fallback="Các tùy chọn giao diện khác sẽ có sẵn trong phiên bản premium" 
                />
              </Paragraph>
            </Space>
          </Card>
        </Col>
      </Row>

      {/* View Item Modal */}
      <Modal
        title={
          <Space>
            <Eye size={20} />
            <span>Chi tiết Item</span>
          </Space>
        }
        open={viewItemModal}
        onCancel={() => {
          setViewItemModal(false);
          setSelectedItem(null);
        }}
        footer={[
          <Button key="close" onClick={() => setViewItemModal(false)}>
            Đóng
          </Button>,
          <Popconfirm
            key="delete"
            title="Xóa item này?"
            description="Bạn có chắc muốn xóa item này?"
            onConfirm={() => {
              handleDeleteItem(selectedItem.key);
              setViewItemModal(false);
            }}
            okText="Xóa"
            cancelText="Hủy"
          >
            <Button danger icon={<Trash2 size={14} />}>
              Xóa
            </Button>
          </Popconfirm>
        ]}
        width={700}
      >
        {selectedItem && (
          <div>
            <div style={{ marginBottom: '16px' }}>
              <div style={{ fontWeight: 'bold', marginBottom: '4px' }}>Key:</div>
              <Input value={selectedItem.key} readOnly />
            </div>

            <div style={{ marginBottom: '16px' }}>
              <div style={{ fontWeight: 'bold', marginBottom: '4px' }}>Loại dữ liệu:</div>
              <Tag color="blue">{localStorageManager.getValueType(selectedItem.value)}</Tag>
            </div>

            <div style={{ marginBottom: '16px' }}>
              <div style={{ fontWeight: 'bold', marginBottom: '4px' }}>Kích thước:</div>
              <Tag color="green">{selectedItem.sizeFormatted}</Tag>
            </div>

            <div style={{ marginBottom: '16px' }}>
              <div style={{ fontWeight: 'bold', marginBottom: '4px' }}>Nội dung:</div>
              {localStorageManager.getValueType(selectedItem.value) === 'Base64 Image' ? (
                <div style={{ 
                  textAlign: 'center', 
                  padding: '16px', 
                  background: '#f5f5f5', 
                  borderRadius: '6px' 
                }}>
                  <img 
                    src={selectedItem.value} 
                    alt="Preview" 
                    style={{ maxWidth: '100%', maxHeight: '300px', objectFit: 'contain' }}
                  />
                </div>
              ) : (
                <Input.TextArea 
                  value={selectedItem.value} 
                  rows={10}
                  readOnly
                  style={{ fontFamily: 'monospace', fontSize: '12px' }}
                />
              )}
            </div>
          </div>
        )}
      </Modal>
    </div>
  );
};

export default CaiDat;
