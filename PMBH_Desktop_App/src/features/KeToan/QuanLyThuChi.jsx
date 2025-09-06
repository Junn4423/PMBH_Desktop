import React, { useState, useEffect } from 'react';
import { Table, Card, Button, Modal, Form, Input, Select, DatePicker, Space, message, Row, Col, Statistic, Tag } from 'antd';
import { PlusOutlined, EditOutlined, DeleteOutlined, FileTextOutlined, CalculatorOutlined } from '@ant-design/icons';
import dayjs from 'dayjs';

const { Option } = Select;
const { RangePicker } = DatePicker;

const QuanLyThuChi = () => {
  const [danhSachThuChi, setDanhSachThuChi] = useState([]);
  const [modalThuChi, setModalThuChi] = useState(false);
  const [thuChiHienTai, setThuChiHienTai] = useState(null);
  const [form] = Form.useForm();

  // Dữ liệu mẫu thu chi
  useEffect(() => {
    const thuChiMau = [
      {
        id: 1,
        loaiPhieu: 'thu',
        soPhieu: 'PT001',
        ngayPhieu: '2024-12-20',
        dienGiai: 'Thu tiền bán hàng',
        loaiThuChi: 'doanh_thu',
        soTien: 2500000,
        nguoiNop: 'Khách hàng',
        nguoiNhan: 'Thu ngân A',
        phuongThuc: 'tien_mat',
        trangThai: 'da_duyet',
        ghiChu: 'Thu từ bán hàng trong ngày'
      },
      {
        id: 2,
        loaiPhieu: 'chi',
        soPhieu: 'PC001',
        ngayPhieu: '2024-12-20',
        dienGiai: 'Mua nguyên liệu',
        loaiThuChi: 'mua_hang',
        soTien: 800000,
        nguoiNop: 'Kế toán',
        nguoiNhan: 'Nhà cung cấp ABC',
        phuongThuc: 'chuyen_khoan',
        trangThai: 'da_duyet',
        ghiChu: 'Mua cà phê và nguyên liệu'
      },
      {
        id: 3,
        loaiPhieu: 'chi',
        soPhieu: 'PC002',
        ngayPhieu: '2024-12-19',
        dienGiai: 'Thanh toán lương nhân viên',
        loaiThuChi: 'luong',
        soTien: 15000000,
        nguoiNop: 'Kế toán',
        nguoiNhan: 'Nhân viên',
        phuongThuc: 'chuyen_khoan',
        trangThai: 'cho_duyet',
        ghiChu: 'Lương tháng 12/2024'
      },
      {
        id: 4,
        loaiPhieu: 'thu',
        soPhieu: 'PT002',
        ngayPhieu: '2024-12-19',
        dienGiai: 'Thu nợ khách hàng',
        loaiThuChi: 'thu_no',
        soTien: 1200000,
        nguoiNop: 'Khách hàng XYZ',
        nguoiNhan: 'Thu ngân B',
        phuongThuc: 'tien_mat',
        trangThai: 'da_duyet',
        ghiChu: 'Thu nợ hóa đơn tháng 11'
      }
    ];
    setDanhSachThuChi(thuChiMau);
  }, []);

  const cotBang = [
    {
      title: 'Số phiếu',
      dataIndex: 'soPhieu',
      key: 'soPhieu',
      width: 100,
    },
    {
      title: 'Loại',
      dataIndex: 'loaiPhieu',
      key: 'loaiPhieu',
      width: 80,
      render: (loai) => (
        <Tag color={loai === 'thu' ? 'green' : 'red'}>
          {loai === 'thu' ? 'Thu' : 'Chi'}
        </Tag>
      )
    },
    {
      title: 'Ngày phiếu',
      dataIndex: 'ngayPhieu',
      key: 'ngayPhieu',
      width: 120,
      render: (ngay) => dayjs(ngay).format('DD/MM/YYYY')
    },
    {
      title: 'Diễn giải',
      dataIndex: 'dienGiai',
      key: 'dienGiai',
      width: 200,
    },
    {
      title: 'Loại thu/chi',
      dataIndex: 'loaiThuChi',
      key: 'loaiThuChi',
      width: 120,
      render: (loai) => {
        const tenLoai = {
          doanh_thu: 'Doanh thu',
          thu_no: 'Thu nợ',
          khac: 'Khác',
          mua_hang: 'Mua hàng',
          luong: 'Lương',
          dien_nuoc: 'Điện nước',
          thue_nha: 'Thuê nhà',
          marketing: 'Marketing',
          bao_tri: 'Bảo trì'
        };
        return tenLoai[loai] || loai;
      }
    },
    {
      title: 'Số tiền',
      dataIndex: 'soTien',
      key: 'soTien',
      width: 150,
      render: (tien, record) => (
        <span style={{ 
          color: record.loaiPhieu === 'thu' ? 'green' : 'red',
          fontWeight: 'bold'
        }}>
          {record.loaiPhieu === 'thu' ? '+' : '-'}{new Intl.NumberFormat('vi-VN').format(tien)} đ
        </span>
      )
    },
    {
      title: 'Người nộp/Chi',
      dataIndex: 'nguoiNop',
      key: 'nguoiNop',
      width: 150,
    },
    {
      title: 'Người nhận',
      dataIndex: 'nguoiNhan',
      key: 'nguoiNhan',
      width: 150,
    },
    {
      title: 'Phương thức',
      dataIndex: 'phuongThuc',
      key: 'phuongThuc',
      width: 120,
      render: (phuongThuc) => {
        const mau = {
          tien_mat: 'green',
          chuyen_khoan: 'blue',
          the: 'purple'
        };
        const ten = {
          tien_mat: 'Tiền mặt',
          chuyen_khoan: 'Chuyển khoản',
          the: 'Thẻ'
        };
        return <Tag color={mau[phuongThuc]}>{ten[phuongThuc]}</Tag>;
      }
    },
    {
      title: 'Trạng thái',
      dataIndex: 'trangThai',
      key: 'trangThai',
      width: 120,
      render: (trangThai) => {
        const mau = {
          cho_duyet: 'warning',
          da_duyet: 'success',
          tu_choi: 'error'
        };
        const ten = {
          cho_duyet: 'Chờ duyệt',
          da_duyet: 'Đã duyệt',
          tu_choi: 'Từ chối'
        };
        return <Tag color={mau[trangThai]}>{ten[trangThai]}</Tag>;
      }
    },
    {
      title: 'Thao tác',
      key: 'thaoTac',
      width: 150,
      render: (_, record) => (
        <Space>
          <Button 
            size="small" 
            icon={<EditOutlined />} 
            onClick={() => suaThuChi(record)}
          >
            Sửa
          </Button>
          <Button 
            size="small" 
            danger 
            icon={<DeleteOutlined />}
            onClick={() => xoaThuChi(record.id)}
          >
            Xóa
          </Button>
        </Space>
      )
    }
  ];

  const tinhThongKe = () => {
    const homNay = dayjs().format('YYYY-MM-DD');
    const thangHienTai = dayjs().format('YYYY-MM');
    
    const thuHomNay = danhSachThuChi
      .filter(tc => tc.ngayPhieu === homNay && tc.loaiPhieu === 'thu' && tc.trangThai === 'da_duyet')
      .reduce((tong, tc) => tong + tc.soTien, 0);
    
    const chiHomNay = danhSachThuChi
      .filter(tc => tc.ngayPhieu === homNay && tc.loaiPhieu === 'chi' && tc.trangThai === 'da_duyet')
      .reduce((tong, tc) => tong + tc.soTien, 0);
    
    const thuThang = danhSachThuChi
      .filter(tc => tc.ngayPhieu.startsWith(thangHienTai) && tc.loaiPhieu === 'thu' && tc.trangThai === 'da_duyet')
      .reduce((tong, tc) => tong + tc.soTien, 0);
    
    const chiThang = danhSachThuChi
      .filter(tc => tc.ngayPhieu.startsWith(thangHienTai) && tc.loaiPhieu === 'chi' && tc.trangThai === 'da_duyet')
      .reduce((tong, tc) => tong + tc.soTien, 0);

    return { thuHomNay, chiHomNay, thuThang, chiThang, loiNhuanThang: thuThang - chiThang };
  };

  const taoSoPhieu = (loaiPhieu) => {
    const prefix = loaiPhieu === 'thu' ? 'PT' : 'PC';
    const so = danhSachThuChi.filter(tc => tc.loaiPhieu === loaiPhieu).length + 1;
    return `${prefix}${so.toString().padStart(3, '0')}`;
  };

  const themThuChi = (loaiPhieu) => {
    setThuChiHienTai(null);
    form.resetFields();
    form.setFieldsValue({
      loaiPhieu,
      soPhieu: taoSoPhieu(loaiPhieu),
      ngayPhieu: dayjs(),
      trangThai: 'cho_duyet',
      phuongThuc: 'tien_mat'
    });
    setModalThuChi(true);
  };

  const suaThuChi = (thuChi) => {
    setThuChiHienTai(thuChi);
    form.setFieldsValue({
      ...thuChi,
      ngayPhieu: dayjs(thuChi.ngayPhieu)
    });
    setModalThuChi(true);
  };

  const luuThuChi = (values) => {
    const thuChiMoi = {
      ...values,
      ngayPhieu: values.ngayPhieu.format('YYYY-MM-DD')
    };

    if (thuChiHienTai) {
      setDanhSachThuChi(prev => 
        prev.map(tc => tc.id === thuChiHienTai.id ? { ...tc, ...thuChiMoi } : tc)
      );
      message.success('Cập nhật phiếu thu chi thành công!');
    } else {
      const thuChiThemMoi = {
        id: Date.now(),
        ...thuChiMoi
      };
      setDanhSachThuChi(prev => [...prev, thuChiThemMoi]);
      message.success('Thêm phiếu thu chi thành công!');
    }
    setModalThuChi(false);
  };

  const xoaThuChi = (id) => {
    Modal.confirm({
      title: 'Xác nhận xóa phiếu thu chi',
      content: 'Bạn có chắc chắn muốn xóa phiếu thu chi này?',
      onOk: () => {
        setDanhSachThuChi(prev => prev.filter(tc => tc.id !== id));
        message.success('Xóa phiếu thu chi thành công!');
      }
    });
  };

  const thongKe = tinhThongKe();

  return (
    <div style={{ padding: 24 }}>
      {/* Thống kê tổng quan */}
      <Row gutter={16} style={{ marginBottom: 24 }}>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Thu hôm nay" 
              value={thongKe.thuHomNay} 
              formatter={(value) => '+' + new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#3f8600' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Chi hôm nay" 
              value={thongKe.chiHomNay} 
              formatter={(value) => '-' + new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#cf1322' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Thu tháng này" 
              value={thongKe.thuThang} 
              formatter={(value) => '+' + new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: '#3f8600' }}
            />
          </Card>
        </Col>
        <Col span={6}>
          <Card>
            <Statistic 
              title="Lợi nhuận tháng" 
              value={thongKe.loiNhuanThang} 
              formatter={(value) => new Intl.NumberFormat('vi-VN').format(value) + ' đ'}
              valueStyle={{ color: thongKe.loiNhuanThang >= 0 ? '#3f8600' : '#cf1322' }}
            />
          </Card>
        </Col>
      </Row>

      <Card title="Quản lý thu chi" className="quan-ly-thu-chi">
        <Row gutter={[16, 16]} style={{ marginBottom: 16 }}>
          <Col span={24}>
            <Space>
              <Button 
                type="primary" 
                icon={<PlusOutlined />} 
                onClick={() => themThuChi('thu')}
                style={{ backgroundColor: '#52c41a' }}
              >
                Tạo phiếu thu
              </Button>
              <Button 
                type="primary" 
                icon={<PlusOutlined />} 
                onClick={() => themThuChi('chi')}
                danger
              >
                Tạo phiếu chi
              </Button>
              <Button 
                icon={<FileTextOutlined />}
              >
                Xuất báo cáo
              </Button>
              <Button 
                icon={<CalculatorOutlined />}
              >
                Báo cáo tổng hợp
              </Button>
            </Space>
          </Col>
        </Row>

        <Table
          columns={cotBang}
          dataSource={danhSachThuChi}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showQuickJumper: true,
            showTotal: (total) => `Tổng ${total} phiếu thu chi`
          }}
          scroll={{ x: 1400 }}
        />

        {/* Modal thêm/sửa thu chi */}
        <Modal
          title={thuChiHienTai ? "Sửa phiếu thu chi" : "Tạo phiếu thu chi mới"}
          open={modalThuChi}
          onCancel={() => setModalThuChi(false)}
          footer={null}
          width={700}
        >
          <Form
            form={form}
            layout="vertical"
            onFinish={luuThuChi}
          >
            <Row gutter={16}>
              <Col span={8}>
                <Form.Item
                  name="loaiPhieu"
                  label="Loại phiếu"
                  rules={[{ required: true, message: 'Vui lòng chọn loại phiếu!' }]}
                >
                  <Select placeholder="Chọn loại">
                    <Option value="thu">Phiếu thu</Option>
                    <Option value="chi">Phiếu chi</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="soPhieu"
                  label="Số phiếu"
                  rules={[{ required: true, message: 'Vui lòng nhập số phiếu!' }]}
                >
                  <Input placeholder="Số phiếu tự động" />
                </Form.Item>
              </Col>
              <Col span={8}>
                <Form.Item
                  name="ngayPhieu"
                  label="Ngày phiếu"
                  rules={[{ required: true, message: 'Vui lòng chọn ngày!' }]}
                >
                  <DatePicker style={{ width: '100%' }} format="DD/MM/YYYY" />
                </Form.Item>
              </Col>
            </Row>

            <Form.Item
              name="dienGiai"
              label="Diễn giải"
              rules={[{ required: true, message: 'Vui lòng nhập diễn giải!' }]}
            >
              <Input placeholder="Mô tả nội dung thu/chi" />
            </Form.Item>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="loaiThuChi"
                  label="Loại thu/chi"
                  rules={[{ required: true, message: 'Vui lòng chọn loại!' }]}
                >
                  <Select 
                    placeholder="Chọn loại thu/chi"
                    onChange={(value, option) => {
                      const loaiPhieu = form.getFieldValue('loaiPhieu');
                      if (loaiPhieu === 'thu') {
                        // Các loại thu
                      } else {
                        // Các loại chi
                      }
                    }}
                  >
                    <Option value="doanh_thu">Doanh thu bán hàng</Option>
                    <Option value="thu_no">Thu nợ khách hàng</Option>
                    <Option value="khac">Thu khác</Option>
                    <Option value="mua_hang">Mua hàng hóa</Option>
                    <Option value="luong">Lương nhân viên</Option>
                    <Option value="dien_nuoc">Tiền điện nước</Option>
                    <Option value="thue_nha">Tiền thuê nhà</Option>
                    <Option value="marketing">Chi phí marketing</Option>
                    <Option value="bao_tri">Chi phí bảo trì</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="soTien"
                  label="Số tiền (VND)"
                  rules={[{ required: true, message: 'Vui lòng nhập số tiền!' }]}
                >
                  <Input type="number" placeholder="Nhập số tiền" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="nguoiNop"
                  label="Người nộp/Chi"
                  rules={[{ required: true, message: 'Vui lòng nhập người nộp!' }]}
                >
                  <Input placeholder="Tên người nộp tiền hoặc chi tiền" />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="nguoiNhan"
                  label="Người nhận"
                  rules={[{ required: true, message: 'Vui lòng nhập người nhận!' }]}
                >
                  <Input placeholder="Tên người nhận tiền" />
                </Form.Item>
              </Col>
            </Row>

            <Row gutter={16}>
              <Col span={12}>
                <Form.Item
                  name="phuongThuc"
                  label="Phương thức thanh toán"
                  rules={[{ required: true, message: 'Vui lòng chọn phương thức!' }]}
                >
                  <Select placeholder="Chọn phương thức">
                    <Option value="tien_mat">Tiền mặt</Option>
                    <Option value="chuyen_khoan">Chuyển khoản</Option>
                    <Option value="the">Thẻ ngân hàng</Option>
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  name="trangThai"
                  label="Trạng thái"
                  rules={[{ required: true, message: 'Vui lòng chọn trạng thái!' }]}
                >
                  <Select placeholder="Chọn trạng thái">
                    <Option value="cho_duyet">Chờ duyệt</Option>
                    <Option value="da_duyet">Đã duyệt</Option>
                    <Option value="tu_choi">Từ chối</Option>
                  </Select>
                </Form.Item>
              </Col>
            </Row>

            <Form.Item
              name="ghiChu"
              label="Ghi chú"
            >
              <Input.TextArea rows={3} placeholder="Ghi chú thêm (tùy chọn)" />
            </Form.Item>

            <Form.Item style={{ marginBottom: 0, textAlign: 'right' }}>
              <Space>
                <Button onClick={() => setModalThuChi(false)}>
                  Hủy
                </Button>
                <Button type="primary" htmlType="submit">
                  {thuChiHienTai ? 'Cập nhật' : 'Tạo phiếu'}
                </Button>
              </Space>
            </Form.Item>
          </Form>
        </Modal>
      </Card>
    </div>
  );
};

export default QuanLyThuChi;
