import React, {useEffect, useState, useMemo} from 'react';
import { 
  Card, 
  List, 
  Avatar, 
  Button, 
  Typography, 
  Space, 
  Tag, 
  Collapse, 
  Row, 
  Col, 
  Spin, 
  Empty,
  Modal,
  message
} from 'antd';
import {deletePersonnel, getPersonnel} from '../api/index';
import {displayValue} from '../utils/helper';
import './ListPersonnel.css';

const { Text, Title } = Typography;
const { Panel } = Collapse;

export default function ListPersonnel({refreshKey, searchQuery = ''}) {
  const [expandedId, setExpandedId] = useState(null);
  const [listEmployees, setListEmployees] = useState([]);
  const [isRefreshing, setIsRefreshing] = useState(false);

  const toggleExpand = (id) => {
    setExpandedId(expandedId === id ? null : id);
  };

  const getImageName = (path) => {
    if (!path) return 'noimage.jpeg';
    const parts = path.split('/');
    return parts[parts.length - 1];
  };

  const getData = async () => {
    try {
      setIsRefreshing(true);
      const res = await getPersonnel();

      if (res && Array.isArray(res)) {
        setListEmployees(res);
      }
    } catch (error) {
      console.error('Lỗi khi lấy nhân sự:', error);
    } finally {
      setIsRefreshing(false);
    }
  };

  const onRefresh = async () => {
    await getData();
  };

  // Filter employees based on search query
  const filteredEmployees = useMemo(() => {
    if (!searchQuery.trim()) {
      return listEmployees;
    }
    
    const query = searchQuery.toLowerCase();
    return listEmployees.filter((employee) => 
      employee.lv002?.toLowerCase().includes(query) || // Tên
      employee.lv001?.toLowerCase().includes(query) || // Mã nhân viên
      employee.lv005?.toLowerCase().includes(query)    // Chức vụ
    );
  }, [listEmployees, searchQuery]);
 
  const handleEdit = (employee) => {
    // navigation.navigate('EditPersonnel', {employee});
    console.log('Edit employee:', employee);
  };

  const handleDelete = (lv001) => {
    Modal.confirm({
      title: 'Xác nhận xóa',
      content: 'Bạn có chắc chắn muốn xóa nhân sự này?',
      okText: 'Xóa',
      cancelText: 'Hủy',
      okType: 'danger',
      onOk: async () => {
        try {
          const rawResponse = await deletePersonnel(lv001);
          let cleaned =
            typeof rawResponse === 'string'
              ? rawResponse.replace(/\[\]$/, '')
              : rawResponse;

          const response =
            typeof cleaned === 'string' ? JSON.parse(cleaned) : cleaned;

          if (response.status === 'success') {
            message.success(response.message);
            getData();
          } else if (response.status === 'error') {
            message.error(response.message);
          } else if (response.message === 'invalid') {
            message.error('Lỗi token');
          } else {
            message.error('Lỗi không xác định. Vui lòng thử lại sau.');
          }
        } catch (error) {
          console.error('Lỗi khi xoá:', error);
          message.error('Lỗi hệ thống khi xoá nhân sự');
        }
      }
    });
  };

  useEffect(() => {
    getData();
  }, [refreshKey]);

  return (
    <div className="list-personnel-container">
      <Spin spinning={isRefreshing}>
        {filteredEmployees.length === 0 && searchQuery.trim() ? (
          <Empty 
            description={`Không tìm thấy nhân sự nào với từ khóa "${searchQuery}"`}
            style={{ padding: '40px 0' }}
          />
        ) : (
          <List
            dataSource={filteredEmployees}
            renderItem={(employee: Personnel, index: number) => (
              <List.Item key={employee.lv001} style={{ padding: 0, marginBottom: 16 }}>
                <Card
                  className="personnel-card"
                  hoverable
                  title={
                    <div className="card-header">
                      <Space>
                        <Tag color="blue">{index + 1}</Tag>
                        <Title level={5} style={{ margin: 0 }}>{employee.lv002}</Title>
                      </Space>
                      <Text type="secondary">
                        {employee.lv005 || 'Chưa có chức vụ'}
                      </Text>
                    </div>
                  }
                  extra={
                    <Space>
                      <Button type="primary" size="small" onClick={() => handleEdit(employee)}>
                        Sửa
                      </Button>
                      <Button danger size="small" onClick={() => handleDelete(employee.lv001)}>
                        Xóa
                      </Button>
                    </Space>
                  }
                >
                  <Collapse ghost>
                    <Panel header="Xem chi tiết" key="1">
                      <Row gutter={[16, 16]}>
                        <Col span={24}>
                          <div className="profile-section">
                            <Title level={5}>Thông tin cá nhân</Title>
                            <Row gutter={[16, 8]}>
                              <Col span={12}>
                                <Text strong>Mã nhân viên:</Text> {employee.lv001}
                              </Col>
                              <Col span={12}>
                                <Text strong>Nhóm người dùng:</Text> {displayValue(employee.lv008)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Trạng thái:</Text> {displayValue(employee.lv009)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Giới tính:</Text> {employee.lv018 == '0' ? 'Nam' : 'Nữ'}
                              </Col>
                              <Col span={12}>
                                <Text strong>Ngày sinh:</Text> {displayValue(employee.lv015, true)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Nơi sinh:</Text> {displayValue(employee.lv016)}
                              </Col>
                            </Row>
                          </div>
                        </Col>
                        
                        <Col span={24}>
                          <div className="contact-section">
                            <Title level={5}>Thông tin liên hệ</Title>
                            <Row gutter={[16, 8]}>
                              <Col span={12}>
                                <Text strong>SĐT di động:</Text> {displayValue(employee.lv039)}
                              </Col>
                              <Col span={12}>
                                <Text strong>SĐT công ty:</Text> {displayValue(employee.lv038)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Email công ty:</Text> {displayValue(employee.lv040)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Email khác:</Text> {displayValue(employee.lv041)}
                              </Col>
                            </Row>
                          </div>
                        </Col>

                        <Col span={24}>
                          <div className="work-section">
                            <Title level={5}>Thông tin công việc</Title>
                            <Row gutter={[16, 8]}>
                              <Col span={12}>
                                <Text strong>Phòng ban:</Text> {displayValue(employee.lv029)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Công việc:</Text> {displayValue(employee.lv028)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Ngày bắt đầu:</Text> {displayValue(employee.lv030, true)}
                              </Col>
                              <Col span={12}>
                                <Text strong>Ngày lên VIP:</Text> {displayValue(employee.lv044, true)}
                              </Col>
                            </Row>
                          </div>
                        </Col>
                      </Row>
                    </Panel>
                  </Collapse>
                </Card>
              </List.Item>
            )}
          />
        )}
      </Spin>
    </div>
  );
}
