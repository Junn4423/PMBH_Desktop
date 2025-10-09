import React, { useState, useEffect } from 'react';
import { Card, Breadcrumb, Button, Table, Modal, Form, Input, message, Space, Popconfirm, Switch, Tabs, Checkbox, Select } from 'antd';
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
  getAllPermissions,
  getUserGroups,
  getThemes,
  getAvailableRights
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
  
  // State cho dropdown data
  const [userGroups, setUserGroups] = useState([]);
  const [themes, setThemes] = useState([]);
  const [availableRights, setAvailableRights] = useState([]);
  
  // State cho checkbox quyền
  const [selectedRightIds, setSelectedRightIds] = useState([]);

  useEffect(() => {
    loadUsers();
    loadPermissions();
    loadDropdownData();
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
  
  const loadDropdownData = async () => {
    try {
      // Load tất cả dữ liệu dropdown song song
      const [groupsRes, themesRes, rightsRes] = await Promise.all([
        getUserGroups(),
        getThemes(),
        getAvailableRights()
      ]);
      
      setUserGroups(Array.isArray(groupsRes) ? groupsRes : []);
      setThemes(Array.isArray(themesRes) ? themesRes : []);
      setAvailableRights(Array.isArray(rightsRes) ? rightsRes : []);
    } catch (error) {
      console.error('Error loading dropdown data:', error);
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
      console.log('Attempting to delete user:', record.userId);
      
      // Kiểm tra user có quyền trong hệ thống không
      const userRightsData = await getUserRights(record.userId);
      console.log('User rights:', userRightsData);
      
      if (Array.isArray(userRightsData) && userRightsData.length > 0) {
        message.warning({
          content: `Không thể xóa người dùng "${record.fullName}" vì còn ${userRightsData.length} quyền trong hệ thống. Vui lòng xóa tất cả quyền của người dùng trước.`,
          duration: 5
        });
        return;
      }
      
      // Xóa user
      const result = await deleteUser(record.userId);
      console.log('Delete user result:', result);
      
      if (result && result.success === false) {
        message.error(result.message || 'Không thể xóa người dùng');
        return;
      }
      
      message.success('Xóa người dùng thành công');
      loadUsers();
    } catch (error) {
      console.error('Error deleting user:', error);
      const errorMessage = error?.response?.data?.message || error?.message || 'Không thể xóa người dùng';
      message.error(errorMessage);
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
    setSelectedRightIds([]); // Reset checkbox khi mở modal
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
  
  const handleAddRight = async (rightId) => {
    try {
      if (!selectedUser) return;
      await addUserRight(selectedUser.userId, rightId);
      message.success('Thêm quyền thành công');
      await loadUserRights(selectedUser.userId);
    } catch (error) {
      message.error('Không thể thêm quyền');
      console.error('Error adding right:', error);
    }
  };
  
  const handleDeleteRight = async (rightId) => {
    try {
      await deleteUserRight(rightId);
      message.success('Xóa quyền thành công');
      await loadUserRights(selectedUser.userId);
    } catch (error) {
      message.error('Không thể xóa quyền');
      console.error('Error deleting right:', error);
    }
  };
  
  const handleDeleteSelectedRights = async () => {
    if (selectedRightIds.length === 0) {
      message.warning('Vui lòng chọn ít nhất một quyền để xóa');
      return;
    }
    
    try {
      message.loading({ content: `Đang xóa ${selectedRightIds.length} quyền...`, key: 'deletingRights' });
      
      let successCount = 0;
      let failCount = 0;
      
      for (const rightId of selectedRightIds) {
        try {
          await deleteUserRight(rightId);
          successCount++;
        } catch (err) {
          console.error('Error deleting right:', rightId, err);
          failCount++;
        }
      }
      
      if (failCount === 0) {
        message.success({ 
          content: `Đã xóa thành công ${successCount} quyền`, 
          key: 'deletingRights' 
        });
      } else {
        message.warning({ 
          content: `Đã xóa ${successCount} quyền, ${failCount} quyền thất bại`, 
          key: 'deletingRights' 
        });
      }
      
      setSelectedRightIds([]);
      await loadUserRights(selectedUser.userId);
    } catch (error) {
      message.error({ content: 'Không thể xóa quyền', key: 'deletingRights' });
      console.error('Error deleting selected rights:', error);
    }
  };
  
  const handleSelectAllRights = (checked) => {
    if (checked) {
      const allIds = userRights.map(right => right.id);
      setSelectedRightIds(allIds);
    } else {
      setSelectedRightIds([]);
    }
  };
  
  const handleSelectRight = (rightId, checked) => {
    if (checked) {
      setSelectedRightIds([...selectedRightIds, rightId]);
    } else {
      setSelectedRightIds(selectedRightIds.filter(id => id !== rightId));
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
      width: 110,
      ellipsis: true
    },
    {
      title: 'Tên đầy đủ',
      dataIndex: 'fullName',
      key: 'fullName',
      width: 150,
      ellipsis: true
    },
    {
      title: 'Nhóm người dùng',
      dataIndex: 'groupUserId',
      key: 'groupUserId',
      width: 120,
      ellipsis: true
    },
    {
      title: 'Mã nhân viên',
      dataIndex: 'employeeId',
      key: 'employeeId',
      width: 110,
      ellipsis: true
    },
    {
      title: 'Trạng thái',
      dataIndex: 'status',
      key: 'status',
      width: 95,
      align: 'center',
      render: (status) => (
        <span style={{ color: status === 1 ? '#ff4d4f' : '#52c41a', fontSize: '14px' }}>
          {status === 1 ? 'Đã khóa' : 'Hoạt động'}
        </span>
      )
    },
    {
      title: 'Thao tác',
      key: 'action',
      width: 200,
      align: 'center',
      fixed: 'right',
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
      title: (
        <Checkbox
          checked={userRights.length > 0 && selectedRightIds.length === userRights.length}
          indeterminate={selectedRightIds.length > 0 && selectedRightIds.length < userRights.length}
          onChange={(e) => handleSelectAllRights(e.target.checked)}
        />
      ),
      dataIndex: 'checkbox',
      key: 'checkbox',
      width: 50,
      align: 'center',
      render: (_, record) => (
        <Checkbox
          checked={selectedRightIds.includes(record.id)}
          onChange={(e) => handleSelectRight(record.id, e.target.checked)}
        />
      )
    },
    {
      title: 'Mã quyền',
      dataIndex: 'rightId',
      key: 'rightId',
      width: 90,
      ellipsis: true
    },
    {
      title: 'Tên quyền / Module',
      dataIndex: 'rightName',
      key: 'rightName',
      width: 250,
      ellipsis: true,
      render: (text, record) => (
        <div>
          <div style={{ fontWeight: 500, fontSize: '14px' }}>{text || record.rightId}</div>
          {record.rightPath && (
            <div style={{ fontSize: '12px', color: '#888', marginTop: '2px' }}>
              {record.rightPath}
            </div>
          )}
        </div>
      )
    },
    {
      title: 'Trạng thái',
      dataIndex: 'enabled',
      key: 'enabled',
      width: 85,
      align: 'center',
      render: (enabled, record) => (
        <Switch
          checked={enabled === 1}
          onChange={(checked) => handleToggleRight(record.id, checked)}
        />
      )
    },
    {
      title: 'Thao tác',
      key: 'action',
      width: 80,
      align: 'center',
      fixed: 'right',
      render: (_, record) => (
        <Popconfirm
          title="Xác nhận xóa"
          description="Bạn có chắc chắn muốn xóa quyền này?"
          onConfirm={() => handleDeleteRight(record.id)}
          okText="Xóa"
          cancelText="Hủy"
        >
          <Button
            type="text"
            danger
            icon={<Trash2 size={16} />}
            title="Xóa quyền"
          />
        </Popconfirm>
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
              className="search-input"
            />
            <Button
              type="primary"
              icon={<Plus size={16} />}
              onClick={handleAdd}
              className="add-user-button"
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
          scroll={{ y: 'calc(100vh - 320px)', x: 'max-content' }}
          pagination={{
            defaultPageSize: 10,
            pageSizeOptions: ['10', '20', '50', '100'],
            showSizeChanger: true,
            showTotal: (total) => `Tổng ${total} người dùng`,
            position: ['bottomRight']
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
            label="Mã nhóm (tùy chọn)"
            extra="Có thể để trống hoặc nhập thủ công"
          >
            <Input placeholder="Nhập mã nhóm" />
          </Form.Item>
          <Form.Item
            name="groupUserId"
            label="Nhóm người dùng"
            extra="Chọn từ danh sách hoặc nhập thủ công"
          >
            <Select
              showSearch
              allowClear
              placeholder="Chọn nhóm người dùng"
              options={userGroups}
              filterOption={(input, option) =>
                (option?.label ?? '').toLowerCase().includes(input.toLowerCase())
              }
            />
          </Form.Item>
          <Form.Item
            name="employeeId"
            label="Mã nhân viên"
          >
            <Input placeholder="Nhập mã nhân viên" />
          </Form.Item>
          <Form.Item
            name="theme"
            label="Giao diện"
            initialValue="themes1"
          >
            <Select
              placeholder="Chọn giao diện"
              options={themes}
            />
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
        onCancel={() => {
          setIsPermissionModalVisible(false);
          setSelectedRightIds([]);
        }}
        footer={[
          <Button key="close" onClick={() => {
            setIsPermissionModalVisible(false);
            setSelectedRightIds([]);
          }}>
            Đóng
          </Button>
        ]}
        width={1000}
      >
        <Space direction="vertical" style={{ width: '100%', marginBottom: 16 }}>
          <div style={{ display: 'flex', gap: '8px', alignItems: 'center' }}>
            <Select
              showSearch
              allowClear
              placeholder="Chọn quyền để thêm"
              style={{ flex: 1 }}
              options={availableRights}
              filterOption={(input, option) =>
                (option?.label ?? '').toLowerCase().includes(input.toLowerCase())
              }
              onChange={(value) => {
                if (value) {
                  handleAddRight(value);
                }
              }}
            />
            <span style={{ fontSize: '12px', color: '#888' }}>
              Chọn quyền từ danh sách để thêm cho người dùng
            </span>
          </div>
          
          {selectedRightIds.length > 0 && (
            <div style={{ 
              display: 'flex', 
              gap: '8px', 
              alignItems: 'center', 
              padding: '8px 12px',
              background: '#e6f7ff',
              borderRadius: '4px',
              border: '1px solid #91d5ff'
            }}>
              <span style={{ flex: 1, color: '#0050b3' }}>
                Đã chọn {selectedRightIds.length} quyền
              </span>
              <Popconfirm
                title="Xác nhận xóa hàng loạt"
                description={`Bạn có chắc chắn muốn xóa ${selectedRightIds.length} quyền đã chọn?`}
                onConfirm={handleDeleteSelectedRights}
                okText="Xóa"
                cancelText="Hủy"
                okButtonProps={{ danger: true }}
              >
                <Button 
                  danger 
                  icon={<Trash2 size={16} />}
                >
                  Xóa {selectedRightIds.length} quyền
                </Button>
              </Popconfirm>
            </div>
          )}
        </Space>
        
        <Table
          columns={rightColumns}
          dataSource={userRights}
          rowKey="id"
          scroll={{ y: 'calc(100vh - 480px)', x: 'max-content' }}
          pagination={{
            defaultPageSize: 10,
            pageSizeOptions: ['10', '20', '50', '100'],
            showSizeChanger: true,
            showTotal: (total) => `Tổng ${total} quyền`,
            position: ['bottomRight']
          }}
        />
      </Modal>
    </div>
  );
};

export default BangDieuKhienNguoiDung;
