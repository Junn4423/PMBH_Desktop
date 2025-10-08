import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Button, Table, Modal, Form, Input, message, Space, Popconfirm, Switch, Tabs, Checkbox } from 'antd';
import { Users, Plus, Edit, Trash2, Search, Lock, Unlock, Key, ShieldCheck } from 'lucide-react';
import { 
  getAllUsers, 
  addUser, 
  updateUser, 
  deleteUser, 
  toggleUserStatus,
  changeUserPassword,
  getUserRights,
  addUserRight,
  updateUserRight,
  deleteUserRight,
  getRightDetails,
  updateDetailRight,
  getAllPermissions
} from '../../services/apiServices';
import './BangDieuKhienNguoiDung.css';

const BangDieuKhienNguoiDung = () => {
  const [users, setUsers] = useState([]);
  const [permissions, setPermissions] = useState([]);
  const [loading, setLoading] = useState(false);
  const [isModalVisible, setIsModalVisible] = useState(false);
  const [isPasswordModalVisible, setIsPasswordModalVisible] = useState(false);
  const [isPermissionModalVisible, setIsPermissionModalVisible] = useState(false);
  const [editingUser, setEditingUser] = useState(null);
  const [selectedUser, setSelectedUser] = useState(null);
  const [userRights, setUserRights] = useState([]);
  const [searchText, setSearchText] = useState('');
  const [form] = Form.useForm();
  const [passwordForm] = Form.useForm();

  useEffect(() => {
    loadUsers();
    loadPermissions();
  }, []);

  const loadUsers = async () => {
    try {
      setLoading(true);
      const response = await getAllUsers();
      
      let usersData = [];
      if (Array.isArray(response)) {
        usersData = response;
      } else if (response && response.success && response.data) {
        usersData = Array.isArray(response.data) ? response.data : Object.values(response.data);
      } else if (response && typeof response === 'object') {
        usersData = Object.values(response);
      }
      
      setUsers(usersData);
    } catch (error) {
      message.error('Không thể tải danh sách người dùng');
      console.error('Error loading users:', error);
    } finally {
      setLoading(false);
    }
  };

  const loadPermissions = async () => {
    try {
      const response = await getAllPermissions();
      let permissionsData = [];
      if (Array.isArray(response)) {
        permissionsData = response;
      } else if (response && Array.isArray(response.data)) {
        permissionsData = response.data;
      }
      setPermissions(permissionsData);
    } catch (error) {
      console.error('Error loading permissions:', error);
    }
  };

  const loadUserRights = async (userId) => {
    try {
      const response = await getUserRights(userId);
      let rightsData = [];
      if (Array.isArray(response)) {
        rightsData = response;
      } else if (response && Array.isArray(response.data)) {
        rightsData = response.data;
      }
      setUserRights(rightsData);
    } catch (error) {
      message.error('Không thể tải quyền người dùng');
      console.error('Error loading user rights:', error);
    }
  };

  const handleAdd = () => {
    setEditingUser(null);
    form.resetFields();
    setIsModalVisible(true);
  };

  const handleEdit = (record) => {
    setEditingUser(record);
    form.setFieldsValue({
      userId: record.userId,
      groupId: record.groupId || '',
      groupUserId: record.groupUserId || '',
      fullName: record.fullName,
      employeeId: record.employeeId || '',
      theme: record.theme || 'themes1',
      branchId: record.branchId || ''
    });
    setIsModalVisible(true);
  };

  const handleDelete = async (record) => {
    try {
      await deleteUser(record.userId);
      message.success('Xóa người dùng thành công');
      loadUsers();
    } catch (error) {
      message.error('Không thể xóa người dùng');
      console.error('Error deleting user:', error);
    }
  };

  const handleToggleStatus = async (record) => {
    try {
      const newStatus = record.status === 1 ? 0 : 1;
      await toggleUserStatus(record.userId, newStatus);
      message.success(newStatus ? 'Đã khóa người dùng' : 'Đã mở khóa người dùng');
      loadUsers();
    } catch (error) {
      message.error('Không thể thay đổi trạng thái người dùng');
      console.error('Error toggling user status:', error);
    }
  };

  const handleSubmit = async (values) => {
    try {
      if (editingUser) {
        await updateUser(values);
        message.success('Cập nhật người dùng thành công');
      } else {
        await addUser(values);
        message.success('Thêm người dùng thành công');
      }
      setIsModalVisible(false);
      form.resetFields();
      loadUsers();
    } catch (error) {
      message.error(editingUser ? 'Không thể cập nhật người dùng' : 'Không thể thêm người dùng');
      console.error('Error saving user:', error);
    }
  };

  const handleChangePassword = (record) => {
    setSelectedUser(record);
    passwordForm.resetFields();
    setIsPasswordModalVisible(true);
  };

  const handlePasswordSubmit = async (values) => {
    try {
      await changeUserPassword(selectedUser.userId, values.newPassword);
      message.success('Đổi mật khẩu thành công');
      setIsPasswordModalVisible(false);
      passwordForm.resetFields();
    } catch (error) {
      message.error('Không thể đổi mật khẩu');
      console.error('Error changing password:', error);
    }
  };

  const handleManagePermissions = async (record) => {
    setSelectedUser(record);
    await loadUserRights(record.userId);
    setIsPermissionModalVisible(true);
  };

  const handleToggleRight = async (rightId, enabled) => {
    try {
      await updateUserRight(rightId, enabled ? 1 : 0);
      message.success('Cập nhật quyền thành công');
      await loadUserRights(selectedUser.userId);
    } catch (error) {
      message.error('Không thể cập nhật quyền');
      console.error('Error updating right:', error);
    }
  };

  const filteredUsers = users.filter(user => {
    const fullName = user.fullName || '';
    const userId = user.userId || '';
    return fullName.toLowerCase().includes(searchText.toLowerCase()) ||
           userId.toLowerCase().includes(searchText.toLowerCase());
  });

  const columns = [
    {
      title: 'Mã người dùng',
      dataIndex: 'userId',
      key: 'userId',
      width: 150
    },
    {
      title: 'Tên đầy đủ',
      dataIndex: 'fullName',
      key: 'fullName'
    },
    {
      title: 'Nhóm người dùng',
      dataIndex: 'groupUserId',
      key: 'groupUserId',
      width: 150
    },
    {
      title: 'Mã nhân viên',
      dataIndex: 'employeeId',
      key: 'employeeId',
      width: 120
    },
    {
      title: 'Trạng thái',
      dataIndex: 'status',
      key: 'status',
      width: 100,
      render: (status) => (
        <span style={{ color: status === 1 ? '#ff4d4f' : '#52c41a' }}>
          {status === 1 ? 'Đã khóa' : 'Hoạt động'}
        </span>
      )
    },
    {
      title: 'Thao tác',
      key: 'action',
      width: 250,
      render: (_, record) => (
        <Space size="small">
          <Button
            type="text"
            icon={<Edit size={16} />}
            onClick={() => handleEdit(record)}
            title="Sửa"
          />
          <Button
            type="text"
            icon={<Key size={16} />}
            onClick={() => handleChangePassword(record)}
            title="Đổi mật khẩu"
          />
          <Button
            type="text"
            icon={<ShieldCheck size={16} />}
            onClick={() => handleManagePermissions(record)}
            title="Quản lý quyền"
          />
          <Button
            type="text"
            icon={record.status === 1 ? <Unlock size={16} /> : <Lock size={16} />}
            onClick={() => handleToggleStatus(record)}
            title={record.status === 1 ? 'Mở khóa' : 'Khóa'}
          />
          <Popconfirm
            title="Xác nhận xóa"
            description="Bạn có chắc chắn muốn xóa người dùng này?"
            onConfirm={() => handleDelete(record)}
            okText="Xóa"
            cancelText="Hủy"
          >
            <Button
              type="text"
              danger
              icon={<Trash2 size={16} />}
              title="Xóa"
            />
          </Popconfirm>
        </Space>
      ),
    },
  ];

  const rightColumns = [
    {
      title: 'Tên quyền',
      dataIndex: 'permissionName',
      key: 'permissionName'
    },
    {
      title: 'Mã quyền',
      dataIndex: 'rightId',
      key: 'rightId',
      width: 100
    },
    {
      title: 'Trạng thái',
      dataIndex: 'enabled',
      key: 'enabled',
      width: 100,
      render: (enabled, record) => (
        <Switch
          checked={enabled === 1}
          onChange={(checked) => handleToggleRight(record.id, checked)}
        />
      )
    }
  ];

  return (
    <div className="bang-dieu-khien-nguoi-dung-container">
      <Breadcrumb
        items={[
          { title: 'Trang chủ' },
          { title: 'Mục chung' },
          { title: 'Bảng điều khiển người dùng' }
        ]}
        className="page-breadcrumb"
      />
      
      <Card 
        title={
          <div className="page-title">
            <Users size={20} />
            <span>Quản lý người dùng & Phân quyền</span>
          </div>
        }
        extra={
          <Space>
            <Input
              placeholder="Tìm kiếm người dùng..."
              prefix={<Search size={16} />}
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
              style={{ width: 250 }}
            />
            <Button
              type="primary"
              icon={<Plus size={16} />}
              onClick={handleAdd}
            >
              Thêm người dùng
            </Button>
          </Space>
        }
        className="main-card"
      >
        <Table
          columns={columns}
          dataSource={filteredUsers}
          loading={loading}
          rowKey="userId"
          pagination={{
            pageSize: 10,
            showSizeChanger: true,
            showTotal: (total) => `Tổng ${total} người dùng`
          }}
        />
      </Card>

      <Modal
        title={editingUser ? 'Sửa người dùng' : 'Thêm người dùng'}
        open={isModalVisible}
        onCancel={() => {
          setIsModalVisible(false);
          form.resetFields();
        }}
        onOk={() => form.submit()}
        okText={editingUser ? 'Cập nhật' : 'Thêm'}
        cancelText="Hủy"
        width={600}
      >
        <Form
          form={form}
          layout="vertical"
          onFinish={handleSubmit}
        >
          <Form.Item
            name="userId"
            label="Mã người dùng"
            rules={[{ required: true, message: 'Vui lòng nhập mã người dùng' }]}
          >
            <Input disabled={!!editingUser} placeholder="Nhập mã người dùng" />
          </Form.Item>
          <Form.Item
            name="fullName"
            label="Tên đầy đủ"
            rules={[{ required: true, message: 'Vui lòng nhập tên đầy đủ' }]}
          >
            <Input placeholder="Nhập tên đầy đủ" />
          </Form.Item>
          <Form.Item
            name="groupId"
            label="Mã nhóm"
          >
            <Input placeholder="Nhập mã nhóm" />
          </Form.Item>
          <Form.Item
            name="groupUserId"
            label="Nhóm người dùng"
          >
            <Input placeholder="Nhập nhóm người dùng" />
          </Form.Item>
          <Form.Item
            name="employeeId"
            label="Mã nhân viên"
          >
            <Input placeholder="Nhập mã nhân viên" />
          </Form.Item>
          <Form.Item
            name="theme"
            label="Theme"
          >
            <Input placeholder="themes1, themes2, themes3, themes4" />
          </Form.Item>
          <Form.Item
            name="branchId"
            label="Mã chi nhánh"
          >
            <Input placeholder="Nhập mã chi nhánh" />
          </Form.Item>
          {!editingUser && (
            <Form.Item
              name="password"
              label="Mật khẩu"
              initialValue="123456"
            >
              <Input.Password placeholder="Nhập mật khẩu (mặc định: 123456)" />
            </Form.Item>
          )}
        </Form>
      </Modal>

      <Modal
        title="Đổi mật khẩu"
        open={isPasswordModalVisible}
        onCancel={() => {
          setIsPasswordModalVisible(false);
          passwordForm.resetFields();
        }}
        onOk={() => passwordForm.submit()}
        okText="Đổi mật khẩu"
        cancelText="Hủy"
      >
        <Form
          form={passwordForm}
          layout="vertical"
          onFinish={handlePasswordSubmit}
        >
          <Form.Item
            name="newPassword"
            label="Mật khẩu mới"
            rules={[
              { required: true, message: 'Vui lòng nhập mật khẩu mới' },
              { min: 6, message: 'Mật khẩu phải có ít nhất 6 ký tự' }
            ]}
          >
            <Input.Password placeholder="Nhập mật khẩu mới" />
          </Form.Item>
          <Form.Item
            name="confirmPassword"
            label="Xác nhận mật khẩu"
            dependencies={['newPassword']}
            rules={[
              { required: true, message: 'Vui lòng xác nhận mật khẩu' },
              ({ getFieldValue }) => ({
                validator(_, value) {
                  if (!value || getFieldValue('newPassword') === value) {
                    return Promise.resolve();
                  }
                  return Promise.reject(new Error('Mật khẩu xác nhận không khớp'));
                },
              }),
            ]}
          >
            <Input.Password placeholder="Xác nhận mật khẩu mới" />
          </Form.Item>
        </Form>
      </Modal>

      <Modal
        title={`Quản lý quyền: ${selectedUser?.fullName || ''}`}
        open={isPermissionModalVisible}
        onCancel={() => setIsPermissionModalVisible(false)}
        footer={[
          <Button key="close" onClick={() => setIsPermissionModalVisible(false)}>
            Đóng
          </Button>
        ]}
        width={800}
      >
        <Table
          columns={rightColumns}
          dataSource={userRights}
          rowKey="id"
          pagination={{
            pageSize: 10,
            showSizeChanger: false
          }}
        />
      </Modal>
    </div>
  );
};

export default BangDieuKhienNguoiDung;
