import React, { useState, useEffect } from 'react';
import { 
  Row, Col, Card, Badge, Button, Modal, 
  Typography, Space, Tag, message, Dropdown,
  Menu, Divider
} from 'antd';
import {
  TableOutlined,
  ClockCircleOutlined,
  CheckCircleOutlined,
  CloseCircleOutlined,
  MoreOutlined,
  EditOutlined,
  DeleteOutlined,
  PrinterOutlined
} from '@ant-design/icons';

const { Text, Title } = Typography;

const QuanLyBan = () => {
  const [danhSachBan, setDanhSachBan] = useState([]);
  const [hienThiModal, setHienThiModal] = useState(false);
  const [banDangChon, setBanDangChon] = useState(null);
  const [chiTietDonHang, setChiTietDonHang] = useState([]);

  useEffect(() => {
    taiDanhSachBan();
  }, []);

  const taiDanhSachBan = async () => {
    try {
      // Demo data
      setDanhSachBan([
        {
          id: '1',
          tenBan: 'Bàn 1',
          viTri: 'Khu A',
          soGhe: 4,
          trangThai: 'trong',
          donHang: null,
          thoiGianBatDau: null
        },
        {
          id: '2',
          tenBan: 'Bàn 2', 
          viTri: 'Khu A',
          soGhe: 2,
          trangThai: 'dang_su_dung',
          donHang: {
            maDon: 'HD001',
            tongTien: 125000,
            soMon: 3
          },
          thoiGianBatDau: '10:30'
        },
        {
          id: '3',
          tenBan: 'Bàn 3',
          viTri: 'Khu A', 
          soGhe: 6,
          trangThai: 'dat_truoc',
          donHang: {
            maDon: 'HD002',
            tongTien: 200000,
            soMon: 5
          },
          thoiGianBatDau: '14:00'
        },
        {
          id: '4',
          tenBan: 'Bàn 4',
          viTri: 'Khu B',
          soGhe: 4,
          trangThai: 'trong',
          donHang: null,
          thoiGianBatDau: null
        },
        {
          id: '5',
          tenBan: 'Bàn 5',
          viTri: 'Khu B',
          soGhe: 8,
          trangThai: 'dang_su_dung',
          donHang: {
            maDon: 'HD003',
            tongTien: 350000,
            soMon: 8
          },
          thoiGianBatDau: '11:15'
        },
        {
          id: '6',
          tenBan: 'Bàn 6',
          viTri: 'Khu B',
          soGhe: 2,
          trangThai: 'trong',
          donHang: null,
          thoiGianBatDau: null
        }
      ]);
    } catch (error) {
      console.error('Lỗi tải danh sách bàn:', error);
    }
  };

  const layMauTrangThai = (trangThai) => {
    switch (trangThai) {
      case 'trong':
        return { 
          color: '#52c41a', 
          bgColor: '#f6ffed',
          borderColor: '#b7eb8f',
          icon: <CheckCircleOutlined />
        };
      case 'dang_su_dung':
        return { 
          color: '#1890ff', 
          bgColor: '#e6f7ff',
          borderColor: '#91d5ff',
          icon: <ClockCircleOutlined />
        };
      case 'dat_truoc':
        return { 
          color: '#faad14', 
          bgColor: '#fffbe6',
          borderColor: '#ffe58f',
          icon: <ClockCircleOutlined />
        };
      case 'bao_tri':
        return { 
          color: '#ff4d4f', 
          bgColor: '#fff2f0',
          borderColor: '#ffccc7',
          icon: <CloseCircleOutlined />
        };
      default:
        return { 
          color: '#d9d9d9', 
          bgColor: '#fafafa',
          borderColor: '#d9d9d9',
          icon: <TableOutlined />
        };
    }
  };

  const layNhanTrangThai = (trangThai) => {
    switch (trangThai) {
      case 'trong':
        return 'Trống';
      case 'dang_su_dung':
        return 'Đang sử dụng';
      case 'dat_truoc':
        return 'Đặt trước';
      case 'bao_tri':
        return 'Bảo trì';
      default:
        return 'Không xác định';
    }
  };

  const xemChiTietBan = (ban) => {
    setBanDangChon(ban);
    
    // Demo chi tiết đơn hàng
    if (ban.donHang) {
      setChiTietDonHang([
        { tenMon: 'Cà phê đen', soLuong: 2, donGia: 25000 },
        { tenMon: 'Bánh mì', soLuong: 1, donGia: 20000 },
        { tenMon: 'Nước cam', soLuong: 1, donGia: 30000 }
      ]);
    } else {
      setChiTietDonHang([]);
    }
    
    setHienThiModal(true);
  };

  const dongModal = () => {
    setHienThiModal(false);
    setBanDangChon(null);
    setChiTietDonHang([]);
  };

  const thanhToanBan = async (banId) => {
    try {
      // Gọi API thanh toán
      // await api.post(`/ban/${banId}/thanh-toan`);
      
      const capNhatDanhSach = danhSachBan.map(ban =>
        ban.id === banId 
          ? { ...ban, trangThai: 'trong', donHang: null, thoiGianBatDau: null }
          : ban
      );
      setDanhSachBan(capNhatDanhSach);
      message.success('Thanh toán thành công');
      dongModal();
    } catch (error) {
      console.error('Lỗi thanh toán:', error);
      message.error('Thanh toán thất bại');
    }
  };

  const chuyenBan = async (banCu, banMoi) => {
    try {
      // Logic chuyển bàn
      message.success(`Đã chuyển từ ${banCu} sang ${banMoi}`);
    } catch (error) {
      console.error('Lỗi chuyển bàn:', error);
      message.error('Chuyển bàn thất bại');
    }
  };

  const gopBan = async (ban1, ban2) => {
    try {
      // Logic gộp bàn
      message.success(`Đã gộp ${ban1} và ${ban2}`);
    } catch (error) {
      console.error('Lỗi gộp bàn:', error);
      message.error('Gộp bàn thất bại');
    }
  };

  const inHoaDon = (ban) => {
    // Logic in hóa đơn
    message.info(`Đang in hóa đơn cho ${ban.tenBan}`);
  };

  const menuThaoTac = (ban) => (
    <Menu>
      <Menu.Item 
        key="xem" 
        icon={<EditOutlined />}
        onClick={() => xemChiTietBan(ban)}
      >
        Xem chi tiết
      </Menu.Item>
      {ban.trangThai === 'dang_su_dung' && (
        <>
          <Menu.Item 
            key="thanh_toan" 
            icon={<CheckCircleOutlined />}
            onClick={() => thanhToanBan(ban.id)}
          >
            Thanh toán
          </Menu.Item>
          <Menu.Item 
            key="in_hoa_don" 
            icon={<PrinterOutlined />}
            onClick={() => inHoaDon(ban)}
          >
            In hóa đơn
          </Menu.Item>
        </>
      )}
      <Menu.Divider />
      <Menu.Item key="chuyen_ban" icon={<EditOutlined />}>
        Chuyển bàn
      </Menu.Item>
      <Menu.Item key="gop_ban" icon={<EditOutlined />}>
        Gộp bàn  
      </Menu.Item>
    </Menu>
  );

  // Nhóm bàn theo khu vực
  const banTheoKhuVuc = danhSachBan.reduce((acc, ban) => {
    if (!acc[ban.viTri]) {
      acc[ban.viTri] = [];
    }
    acc[ban.viTri].push(ban);
    return acc;
  }, {});

  return (
    <div style={{ padding: '24px' }}>
      <Row justify="space-between" align="middle" style={{ marginBottom: '24px' }}>
        <Col>
          <Title level={2}>Quản lý bàn</Title>
        </Col>
        <Col>
          <Space>
            <Badge color="#52c41a" text="Trống" />
            <Badge color="#1890ff" text="Đang sử dụng" />
            <Badge color="#faad14" text="Đặt trước" />
            <Badge color="#ff4d4f" text="Bảo trì" />
          </Space>
        </Col>
      </Row>

      {Object.entries(banTheoKhuVuc).map(([khuVuc, danhSachBanKhu]) => (
        <div key={khuVuc} style={{ marginBottom: '32px' }}>
          <Title level={4}>{khuVuc}</Title>
          <Row gutter={[16, 16]}>
            {danhSachBanKhu.map(ban => {
              const { color, bgColor, borderColor, icon } = layMauTrangThai(ban.trangThai);
              
              return (
                <Col span={6} key={ban.id}>
                  <Card
                    hoverable
                    style={{
                      backgroundColor: bgColor,
                      borderColor: borderColor,
                      borderWidth: '2px'
                    }}
                    bodyStyle={{ padding: '16px' }}
                    extra={
                      <Dropdown overlay={menuThaoTac(ban)} trigger={['click']}>
                        <Button type="text" icon={<MoreOutlined />} />
                      </Dropdown>
                    }
                    onClick={() => xemChiTietBan(ban)}
                  >
                    <div style={{ textAlign: 'center' }}>
                      <div style={{ fontSize: '32px', color, marginBottom: '8px' }}>
                        {icon}
                      </div>
                      
                      <Title level={4} style={{ margin: '8px 0', color }}>
                        {ban.tenBan}
                      </Title>
                      
                      <Tag color={color} style={{ marginBottom: '8px' }}>
                        {layNhanTrangThai(ban.trangThai)}
                      </Tag>
                      
                      <div style={{ fontSize: '12px', color: '#666' }}>
                        <div>Số ghế: {ban.soGhe}</div>
                        {ban.thoiGianBatDau && (
                          <div>Bắt đầu: {ban.thoiGianBatDau}</div>
                        )}
                      </div>
                      
                      {ban.donHang && (
                        <div style={{ marginTop: '8px', padding: '8px', backgroundColor: '#fff', borderRadius: '4px' }}>
                          <Text strong style={{ fontSize: '12px' }}>
                            {ban.donHang.maDon}
                          </Text>
                          <br />
                          <Text type="success" strong>
                            {ban.donHang.tongTien.toLocaleString()}đ
                          </Text>
                          <br />
                          <Text type="secondary" style={{ fontSize: '11px' }}>
                            {ban.donHang.soMon} món
                          </Text>
                        </div>
                      )}
                    </div>
                  </Card>
                </Col>
              );
            })}
          </Row>
        </div>
      ))}

      {/* Modal chi tiết bàn */}
      <Modal
        title={banDangChon ? `Chi tiết ${banDangChon.tenBan}` : ''}
        open={hienThiModal}
        onCancel={dongModal}
        width={600}
        footer={
          banDangChon && banDangChon.trangThai === 'dang_su_dung' ? (
            <Space>
              <Button onClick={dongModal}>
                Đóng
              </Button>
              <Button 
                type="primary" 
                icon={<PrinterOutlined />}
                onClick={() => inHoaDon(banDangChon)}
              >
                In hóa đơn
              </Button>
              <Button 
                type="primary" 
                danger
                icon={<CheckCircleOutlined />}
                onClick={() => thanhToanBan(banDangChon.id)}
              >
                Thanh toán
              </Button>
            </Space>
          ) : (
            <Button onClick={dongModal}>
              Đóng
            </Button>
          )
        }
      >
        {banDangChon && (
          <div>
            <Row gutter={16} style={{ marginBottom: '16px' }}>
              <Col span={12}>
                <Text strong>Tên bàn: </Text>
                <Text>{banDangChon.tenBan}</Text>
              </Col>
              <Col span={12}>
                <Text strong>Vị trí: </Text>
                <Text>{banDangChon.viTri}</Text>
              </Col>
            </Row>
            
            <Row gutter={16} style={{ marginBottom: '16px' }}>
              <Col span={12}>
                <Text strong>Số ghế: </Text>
                <Text>{banDangChon.soGhe}</Text>
              </Col>
              <Col span={12}>
                <Text strong>Trạng thái: </Text>
                <Tag color={layMauTrangThai(banDangChon.trangThai).color}>
                  {layNhanTrangThai(banDangChon.trangThai)}
                </Tag>
              </Col>
            </Row>

            {banDangChon.donHang && (
              <>
                <Divider />
                <Title level={5}>Thông tin đơn hàng</Title>
                
                <Row gutter={16} style={{ marginBottom: '16px' }}>
                  <Col span={12}>
                    <Text strong>Mã đơn: </Text>
                    <Text>{banDangChon.donHang.maDon}</Text>
                  </Col>
                  <Col span={12}>
                    <Text strong>Thời gian bắt đầu: </Text>
                    <Text>{banDangChon.thoiGianBatDau}</Text>
                  </Col>
                </Row>

                <div style={{ marginBottom: '16px' }}>
                  <Text strong>Chi tiết món: </Text>
                  {chiTietDonHang.map((mon, index) => (
                    <div key={index} style={{ 
                      display: 'flex', 
                      justifyContent: 'space-between',
                      padding: '4px 0',
                      borderBottom: '1px solid #f0f0f0'
                    }}>
                      <Text>{mon.tenMon} x {mon.soLuong}</Text>
                      <Text strong>{(mon.donGia * mon.soLuong).toLocaleString()}đ</Text>
                    </div>
                  ))}
                </div>

                <div style={{ textAlign: 'right', paddingTop: '8px', borderTop: '2px solid #f0f0f0' }}>
                  <Title level={4} type="danger">
                    Tổng tiền: {banDangChon.donHang.tongTien.toLocaleString()}đ
                  </Title>
                </div>
              </>
            )}
          </div>
        )}
      </Modal>
    </div>
  );
};

export default QuanLyBan;
