import React, { useState, useEffect } from 'react';
import { 
  Modal, Form, Input, Select, InputNumber, Row, Col, 
  Button, message, Switch, Space, Divider 
} from 'antd';
import { useBanHang } from '../../hooks/useBanHang';

const { Option } = Select;
const { TextArea } = Input;

const TaoBanMoi = ({ visible, onCancel, onSuccess, editingBan = null }) => {
  const [form] = Form.useForm();
  const [loading, setLoading] = useState(false);
  
  const {
    danhSachKhuVuc,
    getDanhSachKhuVuc,
    taoBanMoi,
    suaThongTinBan
  } = useBanHang();

  useEffect(() => {
    if (visible) {
      getDanhSachKhuVuc();
      
      if (editingBan) {
        form.setFieldsValue({
          tenBan: editingBan.tenBan,
          khuVucId: editingBan.khuVucId,
          sucChua: editingBan.sucChua,
          viTri: editingBan.viTri,
          moTa: editingBan.moTa,
          hoatDong: editingBan.hoatDong,
          ghiChu: editingBan.ghiChu
        });
      } else {
        form.resetFields();
      }
    }
  }, [visible, editingBan, form]);

  const handleSubmit = async (values) => {
    setLoading(true);
    try {
      if (editingBan) {
        await suaThongTinBan(editingBan.id, values);
        message.success('Cập nhật thông tin bàn thành công!');
      } else {
        await taoBanMoi(values);
        message.success('Tạo bàn mới thành công!');
      }
      
      form.resetFields();
      onSuccess?.();
    } catch (error) {
      message.error(editingBan ? 'Không thể cập nhật thông tin bàn!' : 'Không thể tạo bàn mới!');
    } finally {
      setLoading(false);
    }
  };

  const handleCancel = () => {
    form.resetFields();
    onCancel?.();
  };

  return (
    <Modal
      title={editingBan ? 'Sửa thông tin bàn' : 'Tạo bàn mới'}
      open={visible}
      onCancel={handleCancel}
      footer={null}
      width={600}
      destroyOnClose
    >
      <Form
        form={form}
        layout="vertical"
        onFinish={handleSubmit}
        initialValues={{
          sucChua: 4,
          hoatDong: true
        }}
      >
        <Row gutter={16}>
          <Col span={12}>
            <Form.Item
              name="tenBan"
              label="Tên bàn"
              rules={[
                { required: true, message: 'Vui lòng nhập tên bàn!' },
                { min: 1, max: 50, message: 'Tên bàn phải từ 1-50 ký tự!' }
              ]}
            >
              <Input placeholder="Ví dụ: Bàn 01, Bàn VIP 1..." />
            </Form.Item>
          </Col>
          
          <Col span={12}>
            <Form.Item
              name="khuVucId"
              label="Khu vực"
              rules={[{ required: true, message: 'Vui lòng chọn khu vực!' }]}
            >
              <Select placeholder="Chọn khu vực">
                {danhSachKhuVuc?.map(khuVuc => (
                  <Option key={khuVuc.id} value={khuVuc.id}>
                    {khuVuc.tenKhuVuc}
                  </Option>
                ))}
              </Select>
            </Form.Item>
          </Col>
        </Row>

        <Row gutter={16}>
          <Col span={12}>
            <Form.Item
              name="sucChua"
              label="Sức chứa (số người)"
              rules={[
                { required: true, message: 'Vui lòng nhập sức chứa!' },
                { type: 'number', min: 1, max: 20, message: 'Sức chứa từ 1-20 người!' }
              ]}
            >
              <InputNumber 
                min={1} 
                max={20} 
                style={{ width: '100%' }}
                placeholder="Số người tối đa"
              />
            </Form.Item>
          </Col>
          
          <Col span={12}>
            <Form.Item
              name="viTri"
              label="Vị trí"
            >
              <Input placeholder="Ví dụ: Gần cửa sổ, Góc phải..." />
            </Form.Item>
          </Col>
        </Row>

        <Form.Item
          name="moTa"
          label="Mô tả"
        >
          <TextArea 
            rows={3} 
            placeholder="Mô tả chi tiết về bàn (view, đặc điểm đặc biệt...)"
            maxLength={200}
            showCount
          />
        </Form.Item>

        <Row gutter={16}>
          <Col span={12}>
            <Form.Item
              name="hoatDong"
              label="Trạng thái hoạt động"
              valuePropName="checked"
            >
              <Switch 
                checkedChildren="Hoạt động" 
                unCheckedChildren="Tạm ngưng"
              />
            </Form.Item>
          </Col>
        </Row>

        <Form.Item
          name="ghiChu"
          label="Ghi chú"
        >
          <TextArea 
            rows={2} 
            placeholder="Ghi chú thêm về bàn..."
            maxLength={500}
            showCount
          />
        </Form.Item>

        <Divider />

        <Row justify="end">
          <Space>
            <Button onClick={handleCancel}>
              Hủy
            </Button>
            <Button 
              type="primary" 
              htmlType="submit" 
              loading={loading}
            >
              {editingBan ? 'Cập nhật' : 'Tạo bàn'}
            </Button>
          </Space>
        </Row>
      </Form>
    </Modal>
  );
};

export default TaoBanMoi;
