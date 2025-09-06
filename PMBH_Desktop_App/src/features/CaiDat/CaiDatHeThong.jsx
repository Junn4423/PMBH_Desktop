import React, { useState } from 'react';
import { 
  Card, 
  Row, 
  Col, 
  Switch, 
  Select, 
  Input, 
  Button, 
  Form, 
  message, 
  Divider, 
  Typography,
  Space,
  Slider,
  ColorPicker
} from 'antd';
import { SaveOutlined, ReloadOutlined, SettingOutlined } from '@ant-design/icons';

const { Title, Text } = Typography;
const { Option } = Select;

const CaiDatHeThong = () => {
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);

  // Dữ liệu cài đặt mặc định
  const [caiDat, setCaiDat] = useState({
    // Cài đặt chung
    tenCuaHang: 'Cafe ABC',
    diaChi: '123 Đường ABC, Quận 1, TP.HCM',
    soDienThoai: '0901234567',
    email: 'cafe@abc.com',
    website: 'https://cafeabc.com',
    
    // Cài đặt bán hàng
    tuDongInHoaDon: true,
    choPhepTraHang: true,
    thoiHanTraHang: 7,
    yeuCauLyDoTraHang: true,
    choPhepGiamGia: true,
    giamGiaToiDa: 50,
    
    // Cài đặt thuế
    thueSuatVAT: 10,
    apDungVATMacDinh: true,
    
    // Cài đặt thanh toán
    phuongThucThanhToanMacDinh: 'tien_mat',
    choPhepThanhToanThe: true,
    choPhepChuyenKhoan: true,
    
    // Cài đặt kho
    tuDongCapNhatKho: true,
    canhBaoKhiHetHang: true,
    canhBaoKhiSapHetHang: true,
    soLuongCanhBao: 10,
    
    // Cài đặt nhân viên
    choPhepDangNhapNhieuThietBi: false,
    thoiGianLamViec: [8, 22],
    tuDongTinhLuong: true,
    luongGioLamThem: 50000,
    
    // Cài đặt giao diện
    mauChuDe: 'blue',
    kichThuocFont: 14,
    ngonNgu: 'vi',
    hienThiTienTe: 'VND',
    
    // Cài đặt bảo mật
    doPhucTapMatKhau: 'trung_binh',
    thoiGianHetHanMatKhau: 90,
    tuDongDangXuat: 30,
    
    // Cài đặt sao lưu
    tuDongSaoLuu: true,
    thoiGianSaoLuu: 'hang_ngay',
    noiLuuSaoLuu: 'local'
  });

  const luuCaiDat = async (values) => {
    setLoading(true);
    try {
      // Mô phỏng lưu cài đặt
      await new Promise(resolve => setTimeout(resolve, 1000));
      setCaiDat({ ...caiDat, ...values });
      message.success('Lưu cài đặt thành công!');
    } catch (error) {
      message.error('Lỗi khi lưu cài đặt!');
    } finally {
      setLoading(false);
    }
  };

  const khoiPhucMacDinh = () => {
    form.resetFields();
    message.info('Đã khôi phục cài đặt mặc định');
  };

  return (
    <div style={{ padding: 24 }}>
      <Title level={3}>
        <SettingOutlined /> Cài đặt hệ thống
      </Title>
      
      <Form
        form={form}
        layout="vertical"
        initialValues={caiDat}
        onFinish={luuCaiDat}
      >
        <Row gutter={24}>
          {/* Cột trái */}
          <Col span={12}>
            {/* Thông tin cửa hàng */}
            <Card title="Thông tin cửa hàng" style={{ marginBottom: 16 }}>
              <Form.Item name="tenCuaHang" label="Tên cửa hàng">
                <Input placeholder="Nhập tên cửa hàng" />
              </Form.Item>
              <Form.Item name="diaChi" label="Địa chỉ">
                <Input.TextArea rows={3} placeholder="Nhập địa chỉ đầy đủ" />
              </Form.Item>
              <Form.Item name="soDienThoai" label="Số điện thoại">
                <Input placeholder="Nhập số điện thoại" />
              </Form.Item>
              <Form.Item name="email" label="Email">
                <Input type="email" placeholder="Nhập địa chỉ email" />
              </Form.Item>
              <Form.Item name="website" label="Website">
                <Input placeholder="Nhập địa chỉ website" />
              </Form.Item>
            </Card>

            {/* Cài đặt bán hàng */}
            <Card title="Cài đặt bán hàng" style={{ marginBottom: 16 }}>
              <Form.Item name="tuDongInHoaDon" label="Tự động in hóa đơn" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="choPhepTraHang" label="Cho phép trả hàng" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="thoiHanTraHang" label="Thời hạn trả hàng (ngày)">
                <Slider min={1} max={30} marks={{ 1: '1', 7: '7', 15: '15', 30: '30' }} />
              </Form.Item>
              <Form.Item name="yeuCauLyDoTraHang" label="Yêu cầu lý do khi trả hàng" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="choPhepGiamGia" label="Cho phép giảm giá" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="giamGiaToiDa" label="Giảm giá tối đa (%)">
                <Slider min={0} max={100} marks={{ 0: '0%', 25: '25%', 50: '50%', 100: '100%' }} />
              </Form.Item>
            </Card>

            {/* Cài đặt thuế */}
            <Card title="Cài đặt thuế" style={{ marginBottom: 16 }}>
              <Form.Item name="thueSuatVAT" label="Thuế suất VAT (%)">
                <Select>
                  <Option value={0}>0%</Option>
                  <Option value={5}>5%</Option>
                  <Option value={10}>10%</Option>
                  <Option value={15}>15%</Option>
                </Select>
              </Form.Item>
              <Form.Item name="apDungVATMacDinh" label="Áp dụng VAT mặc định" valuePropName="checked">
                <Switch />
              </Form.Item>
            </Card>

            {/* Cài đặt thanh toán */}
            <Card title="Cài đặt thanh toán" style={{ marginBottom: 16 }}>
              <Form.Item name="phuongThucThanhToanMacDinh" label="Phương thức thanh toán mặc định">
                <Select>
                  <Option value="tien_mat">Tiền mặt</Option>
                  <Option value="chuyen_khoan">Chuyển khoản</Option>
                  <Option value="the">Thẻ ngân hàng</Option>
                </Select>
              </Form.Item>
              <Form.Item name="choPhepThanhToanThe" label="Cho phép thanh toán bằng thẻ" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="choPhepChuyenKhoan" label="Cho phép chuyển khoản" valuePropName="checked">
                <Switch />
              </Form.Item>
            </Card>
          </Col>

          {/* Cột phải */}
          <Col span={12}>
            {/* Cài đặt kho */}
            <Card title="Cài đặt kho" style={{ marginBottom: 16 }}>
              <Form.Item name="tuDongCapNhatKho" label="Tự động cập nhật kho khi bán" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="canhBaoKhiHetHang" label="Cảnh báo khi hết hàng" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="canhBaoKhiSapHetHang" label="Cảnh báo khi sắp hết hàng" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="soLuongCanhBao" label="Số lượng cảnh báo">
                <Input type="number" placeholder="Nhập số lượng" />
              </Form.Item>
            </Card>

            {/* Cài đặt nhân viên */}
            <Card title="Cài đặt nhân viên" style={{ marginBottom: 16 }}>
              <Form.Item name="choPhepDangNhapNhieuThietBi" label="Cho phép đăng nhập nhiều thiết bị" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="tuDongTinhLuong" label="Tự động tính lương" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="luongGioLamThem" label="Lương giờ làm thêm (VND)">
                <Input type="number" placeholder="Nhập lương/giờ" />
              </Form.Item>
            </Card>

            {/* Cài đặt giao diện */}
            <Card title="Cài đặt giao diện" style={{ marginBottom: 16 }}>
              <Form.Item name="mauChuDe" label="Màu chủ đề">
                <Select>
                  <Option value="blue">Xanh dương</Option>
                  <Option value="green">Xanh lá</Option>
                  <Option value="red">Đỏ</Option>
                  <Option value="purple">Tím</Option>
                  <Option value="orange">Cam</Option>
                </Select>
              </Form.Item>
              <Form.Item name="kichThuocFont" label="Kích thước font">
                <Slider min={12} max={20} marks={{ 12: '12px', 14: '14px', 16: '16px', 18: '18px', 20: '20px' }} />
              </Form.Item>
              <Form.Item name="ngonNgu" label="Ngôn ngữ">
                <Select>
                  <Option value="vi">Tiếng Việt</Option>
                  <Option value="en">English</Option>
                </Select>
              </Form.Item>
              <Form.Item name="hienThiTienTe" label="Hiển thị tiền tệ">
                <Select>
                  <Option value="VND">VND (đ)</Option>
                  <Option value="USD">USD ($)</Option>
                </Select>
              </Form.Item>
            </Card>

            {/* Cài đặt bảo mật */}
            <Card title="Cài đặt bảo mật" style={{ marginBottom: 16 }}>
              <Form.Item name="doPhucTapMatKhau" label="Độ phức tạp mật khẩu">
                <Select>
                  <Option value="thap">Thấp</Option>
                  <Option value="trung_binh">Trung bình</Option>
                  <Option value="cao">Cao</Option>
                </Select>
              </Form.Item>
              <Form.Item name="thoiGianHetHanMatKhau" label="Thời gian hết hạn mật khẩu (ngày)">
                <Select>
                  <Option value={30}>30 ngày</Option>
                  <Option value={60}>60 ngày</Option>
                  <Option value={90}>90 ngày</Option>
                  <Option value={180}>180 ngày</Option>
                </Select>
              </Form.Item>
              <Form.Item name="tuDongDangXuat" label="Tự động đăng xuất sau (phút)">
                <Slider min={15} max={120} marks={{ 15: '15', 30: '30', 60: '60', 120: '120' }} />
              </Form.Item>
            </Card>

            {/* Cài đặt sao lưu */}
            <Card title="Cài đặt sao lưu" style={{ marginBottom: 16 }}>
              <Form.Item name="tuDongSaoLuu" label="Tự động sao lưu" valuePropName="checked">
                <Switch />
              </Form.Item>
              <Form.Item name="thoiGianSaoLuu" label="Thời gian sao lưu">
                <Select>
                  <Option value="hang_ngay">Hàng ngày</Option>
                  <Option value="hang_tuan">Hàng tuần</Option>
                  <Option value="hang_thang">Hàng tháng</Option>
                </Select>
              </Form.Item>
              <Form.Item name="noiLuuSaoLuu" label="Nơi lưu sao lưu">
                <Select>
                  <Option value="local">Máy tính cục bộ</Option>
                  <Option value="cloud">Đám mây</Option>
                  <Option value="usb">USB/Ổ cứng ngoài</Option>
                </Select>
              </Form.Item>
            </Card>
          </Col>
        </Row>

        <Divider />

        {/* Nút điều khiển */}
        <Row justify="center">
          <Col>
            <Space size="large">
              <Button 
                icon={<ReloadOutlined />} 
                onClick={khoiPhucMacDinh}
              >
                Khôi phục mặc định
              </Button>
              <Button 
                type="primary" 
                icon={<SaveOutlined />} 
                htmlType="submit"
                loading={loading}
                size="large"
              >
                Lưu cài đặt
              </Button>
            </Space>
          </Col>
        </Row>
      </Form>
    </div>
  );
};

export default CaiDatHeThong;
