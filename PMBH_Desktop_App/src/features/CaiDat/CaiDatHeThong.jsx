import React, { useState, useEffect } from 'react';
import { 
  Card, Row, Col, Form, Input, Select, Switch, 
  Button, Space, message, Divider, InputNumber,
  Upload, Avatar 
} from 'antd';
import {
  SaveOutlined,
  ReloadOutlined,
  ShopOutlined,
  SettingOutlined,
  BellOutlined,
  SecurityScanOutlined,
  GlobalOutlined,
  PrinterOutlined,
  UploadOutlined,
  UserOutlined
} from '@ant-design/icons';

const { Option } = Select;
const { TextArea } = Input;

const CaiDatHeThong = () => {
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);
  const [caiDatHienTai, setCaiDatHienTai] = useState({});

  useEffect(() => {
    taiCaiDat();
  }, []);

  const taiCaiDat = async () => {
    setLoading(true);
    try {
      // Demo settings data
      const caiDat = {
        // Thông tin cửa hàng
        tenCuaHang: 'Café Phố Cổ',
        diaChi: '123 Nguyễn Huệ, Quận 1, TP.HCM',
        soDienThoai: '0123456789',
        email: 'contact@cafephoco.com',
        website: 'www.cafephoco.com',
        moTa: 'Chuỗi cà phê hàng đầu với không gian ấm cúng và thức uống chất lượng cao',
        
        // Cài đặt hệ thống
        ngonNgu: 'vi',
        donViTienTe: 'VND',
        thueSuat: 10,
        timeZone: 'Asia/Ho_Chi_Minh',
        
        // Cài đặt bán hàng
        tuDongTinhToan: true,
        choPhepGiamGia: true,
        yeuCauKhachHang: false,
        inHoaDonTuDong: true,
        ghiLogGiaoDich: true,
        
        // Cài đặt thông báo
        thongBaoEmail: true,
        thongBaoSMS: false,
        thongBaoTonKho: true,
        thongBaoDoanhThu: true,
        
        // Cài đặt bảo mật
        batBuocMatKhau: true,
        thoiGianPhienLam: 480, // phút
        saoLuuTuDong: true,
        xacThuc2Buoc: false,
        
        // Cài đặt in ấn
        mayIn: 'Máy in nhiệt POS-80',
        kichThuocGiay: '80mm',
        inLogo: true,
        inThongTinLienHe: true,
        inMaVach: false
      };

      setCaiDatHienTai(caiDat);
      form.setFieldsValue(caiDat);
    } catch (error) {
      console.error('Lỗi tải cài đặt:', error);
      message.error('Không thể tải cài đặt hệ thống');
    } finally {
      setLoading(false);
    }
  };

  const luuCaiDat = async (values) => {
    setLoading(true);
    try {
      // Lưu cài đặt
      setCaiDatHienTai({ ...caiDatHienTai, ...values });
      message.success('Lưu cài đặt thành công');
    } catch (error) {
      console.error('Lỗi lưu cài đặt:', error);
      message.error('Không thể lưu cài đặt');
    } finally {
      setLoading(false);
    }
  };

  const khoiPhucMacDinh = () => {
    form.resetFields();
    message.success('Đã khôi phục cài đặt mặc định');
  };

  const khoiDongLaiHeThong = () => {
    message.loading('Đang khởi động lại hệ thống...', 2);
    setTimeout(() => {
      message.success('Hệ thống đã được khởi động lại');
    }, 2000);
  };

  const uploadProps = {
    name: 'logo',
    action: '/api/upload-logo',
    showUploadList: false,
    beforeUpload: (file) => {
      const isJpgOrPng = file.type === 'image/jpeg' || file.type === 'image/png';
      if (!isJpgOrPng) {
        message.error('Chỉ chấp nhận file JPG/PNG!');
      }
      const isLt2M = file.size / 1024 / 1024 < 2;
      if (!isLt2M) {
        message.error('Kích thước ảnh phải nhỏ hơn 2MB!');
      }
      return isJpgOrPng && isLt2M;
    },
    onChange: (info) => {
      if (info.file.status === 'done') {
        message.success('Upload logo thành công');
      } else if (info.file.status === 'error') {
        message.error('Upload logo thất bại');
      }
    },
  };

  return (
    <div style={{ padding: '24px' }}>
      <Row justify="space-between" align="middle" style={{ marginBottom: '24px' }}>
        <Col>
          <h2>Cài đặt hệ thống</h2>
        </Col>
        <Col>
          <Space>
            <Button icon={<ReloadOutlined />} onClick={khoiPhucMacDinh}>
              Khôi phục mặc định
            </Button>
            <Button type="primary" icon={<SaveOutlined />} onClick={() => form.submit()}>
              Lưu cài đặt
            </Button>
          </Space>
        </Col>
      </Row>

      <Form
        form={form}
        layout="vertical"
        onFinish={luuCaiDat}
        loading={loading}
      >
        <Row gutter={24}>
          <Col span={16}>
            {/* Thông tin cửa hàng */}
            <Card 
              title={
                <Space>
                  <ShopOutlined />
                  Thông tin cửa hàng
                </Space>
              }
              style={{ marginBottom: '24px' }}
            >
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="tenCuaHang"
                    label="Tên cửa hàng"
                    rules={[{ required: true, message: 'Vui lòng nhập tên cửa hàng' }]}
                  >
                    <Input placeholder="Nhập tên cửa hàng" />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="soDienThoai"
                    label="Số điện thoại"
                  >
                    <Input placeholder="Nhập số điện thoại" />
                  </Form.Item>
                </Col>
              </Row>

              <Form.Item
                name="diaChi"
                label="Địa chỉ"
              >
                <TextArea rows={2} placeholder="Nhập địa chỉ cửa hàng" />
              </Form.Item>

              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="email"
                    label="Email"
                    rules={[{ type: 'email', message: 'Email không hợp lệ' }]}
                  >
                    <Input placeholder="Nhập email" />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="website"
                    label="Website"
                  >
                    <Input placeholder="Nhập website" />
                  </Form.Item>
                </Col>
              </Row>

              <Form.Item
                name="moTa"
                label="Mô tả"
              >
                <TextArea rows={3} placeholder="Nhập mô tả về cửa hàng" />
              </Form.Item>
            </Card>

            {/* Cài đặt hệ thống */}
            <Card 
              title={
                <Space>
                  <SettingOutlined />
                  Cài đặt hệ thống
                </Space>
              }
              style={{ marginBottom: '24px' }}
            >
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="ngonNgu"
                    label="Ngôn ngữ"
                  >
                    <Select>
                      <Option value="vi">Tiếng Việt</Option>
                      <Option value="en">English</Option>
                    </Select>
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="donViTienTe"
                    label="Đơn vị tiền tệ"
                  >
                    <Select>
                      <Option value="VND">VND (₫)</Option>
                      <Option value="USD">USD ($)</Option>
                    </Select>
                  </Form.Item>
                </Col>
              </Row>

              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="thueSuat"
                    label="Thuế suất (%)"
                  >
                    <InputNumber 
                      min={0} 
                      max={100} 
                      style={{ width: '100%' }}
                      placeholder="Nhập thuế suất"
                    />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="timeZone"
                    label="Múi giờ"
                  >
                    <Select>
                      <Option value="Asia/Ho_Chi_Minh">GMT+7 (Việt Nam)</Option>
                      <Option value="Asia/Bangkok">GMT+7 (Bangkok)</Option>
                      <Option value="Asia/Singapore">GMT+8 (Singapore)</Option>
                    </Select>
                  </Form.Item>
                </Col>
              </Row>
            </Card>

            {/* Cài đặt bán hàng */}
            <Card 
              title={
                <Space>
                  <GlobalOutlined />
                  Cài đặt bán hàng
                </Space>
              }
              style={{ marginBottom: '24px' }}
            >
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="tuDongTinhToan"
                    label="Tự động tính toán"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="choPhepGiamGia"
                    label="Cho phép giảm giá"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="yeuCauKhachHang"
                    label="Yêu cầu thông tin khách hàng"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="inHoaDonTuDong"
                    label="In hóa đơn tự động"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="ghiLogGiaoDich"
                    label="Ghi log giao dịch"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
              </Row>
            </Card>

            {/* Cài đặt thông báo */}
            <Card 
              title={
                <Space>
                  <BellOutlined />
                  Cài đặt thông báo
                </Space>
              }
              style={{ marginBottom: '24px' }}
            >
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="thongBaoEmail"
                    label="Thông báo qua Email"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="thongBaoSMS"
                    label="Thông báo qua SMS"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="thongBaoTonKho"
                    label="Thông báo hết tồn kho"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="thongBaoDoanhThu"
                    label="Thông báo doanh thu"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
              </Row>
            </Card>

            {/* Cài đặt bảo mật */}
            <Card 
              title={
                <Space>
                  <SecurityScanOutlined />
                  Cài đặt bảo mật
                </Space>
              }
              style={{ marginBottom: '24px' }}
            >
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="batBuocMatKhau"
                    label="Bắt buộc mật khẩu mạnh"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="saoLuuTuDong"
                    label="Sao lưu tự động"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="thoiGianPhienLam"
                    label="Thời gian phiên làm việc (phút)"
                  >
                    <InputNumber 
                      min={30} 
                      max={1440}
                      style={{ width: '100%' }}
                    />
                  </Form.Item>
                  <Form.Item
                    name="xacThuc2Buoc"
                    label="Xác thực 2 bước"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
              </Row>
            </Card>

            {/* Cài đặt in ấn */}
            <Card 
              title={
                <Space>
                  <PrinterOutlined />
                  Cài đặt in ấn
                </Space>
              }
            >
              <Row gutter={16}>
                <Col span={12}>
                  <Form.Item
                    name="mayIn"
                    label="Máy in"
                  >
                    <Select>
                      <Option value="Máy in nhiệt POS-80">Máy in nhiệt POS-80</Option>
                      <Option value="Máy in kim EP-500">Máy in kim EP-500</Option>
                      <Option value="Máy in laser HP-1020">Máy in laser HP-1020</Option>
                    </Select>
                  </Form.Item>
                  <Form.Item
                    name="kichThuocGiay"
                    label="Kích thước giấy"
                  >
                    <Select>
                      <Option value="80mm">80mm</Option>
                      <Option value="58mm">58mm</Option>
                      <Option value="A4">A4</Option>
                    </Select>
                  </Form.Item>
                </Col>
                <Col span={12}>
                  <Form.Item
                    name="inLogo"
                    label="In logo trên hóa đơn"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="inThongTinLienHe"
                    label="In thông tin liên hệ"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                  <Form.Item
                    name="inMaVach"
                    label="In mã vạch"
                    valuePropName="checked"
                  >
                    <Switch />
                  </Form.Item>
                </Col>
              </Row>
            </Card>
          </Col>

          <Col span={8}>
            {/* Logo cửa hàng */}
            <Card title="Logo cửa hàng" style={{ marginBottom: '24px' }}>
              <div style={{ textAlign: 'center' }}>
                <Avatar 
                  size={120} 
                  icon={<ShopOutlined />}
                  style={{ marginBottom: '16px' }}
                />
                <br />
                <Upload {...uploadProps}>
                  <Button icon={<UploadOutlined />}>
                    Tải lên logo
                  </Button>
                </Upload>
                <div style={{ color: '#666', fontSize: '12px', marginTop: '8px' }}>
                  Kích thước tối đa: 2MB<br />
                  Định dạng: JPG, PNG
                </div>
              </div>
            </Card>

            {/* Thông tin hệ thống */}
            <Card title="Thông tin hệ thống">
              <Space direction="vertical" style={{ width: '100%' }}>
                <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                  <span>Phiên bản:</span>
                  <strong>v1.0.0</strong>
                </div>
                <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                  <span>Cơ sở dữ liệu:</span>
                  <strong>SQLite</strong>
                </div>
                <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                  <span>Dung lượng:</span>
                  <strong>245 MB</strong>
                </div>
                <div style={{ display: 'flex', justifyContent: 'space-between' }}>
                  <span>Sao lưu cuối:</span>
                  <strong>Hôm qua</strong>
                </div>
                <Divider />
                <Button 
                  type="primary" 
                  danger 
                  block
                  onClick={khoiDongLaiHeThong}
                >
                  Khởi động lại hệ thống
                </Button>
              </Space>
            </Card>
          </Col>
        </Row>
      </Form>
    </div>
  );
};

export default CaiDatHeThong;
