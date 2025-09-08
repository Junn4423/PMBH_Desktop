import React, { useState } from 'react';
import { Menu, Select, Card } from 'antd';
import { useNavigate, useLocation } from 'react-router-dom';
import {
  Home,
  Calculator,
  Package,
  TrendingUp,
  Palette,
  ChevronDown
} from 'lucide-react';
import './SidebarMenu.css';

const { Option } = Select;

const SidebarMenu = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [selectedTheme, setSelectedTheme] = useState('default');
  const [openKeys, setOpenKeys] = useState([]);

  const menuItems = [
    {
      key: 'muc-chung',
      icon: <Home size={16} />,
      label: 'Mục chung',
      children: [
        {
          key: '/trang-chu',
          label: 'Trang chủ',
        },
        {
          key: 'cong-ty',
          label: (
            <span 
              onClick={() => handleParentItemClick('cong-ty', '/cong-ty')}
              style={{ cursor: 'pointer' }}
            >
              Công ty
            </span>
          ),
          children: [
            {
              key: '/phong-ban',
              label: 'Phòng ban',
            },
            {
              key: '/nhan-vien-cong-ty',
              label: 'Nhân viên',
            }
          ]
        },
        {
          key: 'bang-dieu-khien-nguoi-dung',
          label: (
            <span 
              onClick={() => handleParentItemClick('bang-dieu-khien-nguoi-dung', '/bang-dieu-khien-nguoi-dung')}
              style={{ cursor: 'pointer' }}
            >
              Bảng điều khiển người dùng
            </span>
          ),
          children: [
            {
              key: '/nhom-nguoi-dung',
              label: 'Nhóm người dùng',
            },
            {
              key: '/chon-kho-quan-ly',
              label: 'Chọn kho quản lý',
            }
          ]
        },
        {
          key: 'giao-dien-mb',
          label: 'Giao diện MB',
          children: [
            {
              key: '/tai-khoan-mb',
              label: 'Tài khoản',
            },
            {
              key: '/bc-chi-tien',
              label: 'BC chi tiền',
            },
            {
              key: '/bc-chi-tien-nhap-kho',
              label: 'BC chi tiền + nhập kho',
            },
            {
              key: '/nhap-chi',
              label: 'Nhập chi',
            },
            {
              key: '/nhap-ban-hang',
              label: 'Nhập bán hàng',
            },
            {
              key: '/cho-nha-bep',
              label: 'Cho nhà bếp',
            },
            {
              key: '/cho-quay-bar',
              label: 'Cho quầy bar',
            },
            {
              key: '/bc-ban-hang',
              label: 'BC bán hàng',
            },
            {
              key: '/bc-tong',
              label: 'BC tổng',
            },
            {
              key: '/bao-cao-giao-ca',
              label: 'Báo cáo giao ca',
            },
            {
              key: '/bc-nhap-kho',
              label: 'BC nhập kho',
            },
            {
              key: '/canh-bao-max-min',
              label: 'Cảnh báo max/min',
            },
            {
              key: '/bao-ton-mobil',
              label: 'Báo tồn Mobil',
            },
            {
              key: '/nhap-kho-mb',
              label: 'Nhập kho',
            },
            {
              key: '/kiem-kho-mb',
              label: 'Kiểm kho',
            }
          ]
        },
        {
          key: 'dieu-khien-san-pham',
          label: 'Điều khiển sản phẩm',
          children: [
            {
              key: '/don-vi',
              label: 'Đơn vị',
            },
            {
              key: '/loai-san-pham',
              label: 'Loại sản phẩm',
            },
            {
              key: '/san-pham',
              label: 'Sản phẩm',
            }
          ]
        },
        {
          key: 'thiet-lap-tang-va-ban',
          label: 'Thiết lập tầng và bàn',
          children: [
            {
              key: '/tang-nha-hang',
              label: 'Tầng nhà hàng',
            },
            {
              key: '/ban-nha-hang',
              label: 'Bàn nhà hàng',
            }
          ]
        }
      ]
    },
    {
      key: 'ke-toan',
      icon: <Calculator size={16} />,
      label: 'Kế toán',
      children: [
        {
          key: '/phieu-chi',
          label: 'Phiếu chi',
        }
      ]
    },
    {
      key: 'quan-li-kho',
      icon: <Package size={16} />,
      label: 'Quản lí kho',
      children: [
        {
          key: '/kho',
          label: 'Kho',
        },
        {
          key: '/kiem-kho',
          label: 'Kiểm kho',
        },
        {
          key: '/nhap-kho',
          label: 'Nhập kho',
        },
        {
          key: '/xuat-kho',
          label: 'Xuất kho',
        },
        {
          key: '/bao-cao-theo-dieu-kien',
          label: 'Báo cáo theo điều kiện',
        }
      ]
    },
    {
      key: 'kinh-doanh',
      icon: <TrendingUp size={16} />,
      label: 'Kinh doanh',
      children: [
        {
          key: '/danh-muc-khach-hang',
          label: 'Danh mục khách hàng',
        },
        {
          key: 'quan-ly-ban-nha-hang',
          label: (
            <span 
              onClick={() => handleParentItemClick('quan-ly-ban-nha-hang', '/quan-ly-ban-nha-hang')}
              style={{ cursor: 'pointer' }}
            >
              Quản lý bán nhà hàng
            </span>
          ),
          children: [
            {
              key: '/chuong-trinh-kinh-doanh',
              label: 'Chương trình kinh doanh',
            },
            {
              key: '/cau-hinh-quan-ly-nha-hang',
              label: 'Cấu hình quản lý nhà hàng',
            },
            {
              key: '/xem-thong-tin-xoa-don-hang',
              label: 'Xem thông tin xóa đơn hàng',
            },
            {
              key: '/nguoi-dang-ky',
              label: 'Người đăng ký',
            },
            {
              key: '/cho-nguoi-quan-ly',
              label: 'Cho người quản lý',
            },
            {
              key: '/cho-nha-bep-ql',
              label: 'Cho nhà bếp',
            },
            {
              key: '/cho-quay-bar-ql',
              label: 'Cho quầy bar',
            }
          ]
        },
        {
          key: '/bao-cao-doanh-thu-khach-hang',
          label: 'Báo cáo doanh thu khách hàng',
        }
      ]
    }
  ];

  const colorThemes = [
    { value: 'default', label: 'Mặc định', colors: ['#197dd3', '#77d4fb'] },
    { value: 'ocean', label: 'Đại dương', colors: ['#0066cc', '#66ccff'] },
    { value: 'forest', label: 'Rừng xanh', colors: ['#006600', '#66cc66'] },
    { value: 'sunset', label: 'Hoàng hôn', colors: ['#ff6600', '#ffcc66'] },
    { value: 'purple', label: 'Tím', colors: ['#6600cc', '#cc66ff'] }
  ];

  // Hàm xử lý click vào parent item (có cả navigation và dropdown)
  const handleParentItemClick = (key, path) => {
    // Navigate đến trang
    navigate(path);
    
    // Toggle dropdown
    const newOpenKeys = openKeys.includes(key) 
      ? openKeys.filter(k => k !== key)
      : [...openKeys, key];
    setOpenKeys(newOpenKeys);
  };

  const handleMenuClick = ({ key }) => {
    // Chỉ xử lý navigation cho các items con (routes)
    if (key.startsWith('/')) {
      navigate(key);
    }
  };

  // Hàm xử lý khi submenu được mở/đóng
  const handleOpenChange = (keys) => {
    const latestOpenKey = keys.find(key => !openKeys.includes(key));
    
    if (latestOpenKey) {
      // Định nghĩa các nhóm submenu theo cấp độ
      const rootSubmenuKeys = ['muc-chung', 'ke-toan', 'quan-li-kho', 'kinh-doanh'];
      
      // Các submenu cấp 2 theo từng parent
      const level2SubmenuGroups = {
        'muc-chung': ['cong-ty', 'bang-dieu-khien-nguoi-dung', 'giao-dien-mb', 'dieu-khien-san-pham', 'thiet-lap-tang-va-ban'],
        'kinh-doanh': ['quan-ly-ban-nha-hang']
      };
      
      // Tất cả submenu cấp 2
      const allLevel2Keys = Object.values(level2SubmenuGroups).flat();
      
      if (rootSubmenuKeys.includes(latestOpenKey)) {
        // Khi mở submenu cấp 1 (root level)
        // Đóng tất cả submenu cấp 1 khác và các submenu con của chúng
        const otherRootKeys = rootSubmenuKeys.filter(key => key !== latestOpenKey);
        const keysToClose = [];
        
        // Tìm tất cả submenu con của các root khác
        otherRootKeys.forEach(rootKey => {
          if (level2SubmenuGroups[rootKey]) {
            keysToClose.push(...level2SubmenuGroups[rootKey]);
          }
        });
        
        // Chỉ giữ lại latestOpenKey và loại bỏ các root khác cùng submenu con
        const filteredKeys = keys.filter(key => 
          !otherRootKeys.includes(key) && !keysToClose.includes(key)
        );
        setOpenKeys(filteredKeys);
        
      } else if (allLevel2Keys.includes(latestOpenKey)) {
        // Khi mở submenu cấp 2
        // Tìm parent của submenu này
        const parentKey = Object.keys(level2SubmenuGroups).find(parent => 
          level2SubmenuGroups[parent].includes(latestOpenKey)
        );
        
        if (parentKey) {
          // Đóng tất cả submenu cấp 2 khác trong cùng parent
          const siblingKeys = level2SubmenuGroups[parentKey].filter(key => key !== latestOpenKey);
          const filteredKeys = keys.filter(key => !siblingKeys.includes(key));
          setOpenKeys(filteredKeys);
        } else {
          setOpenKeys(keys);
        }
        
      } else {
        // Các submenu khác (cấp 3 trở đi hoặc không được định nghĩa)
        setOpenKeys(keys);
      }
    } else {
      // Khi đóng submenu
      setOpenKeys(keys);
    }
  };

  const handleThemeChange = (value) => {
    setSelectedTheme(value);
    const selectedColors = colorThemes.find(theme => theme.value === value)?.colors;
    if (selectedColors) {
      // Apply theme to CSS variables
      document.documentElement.style.setProperty('--primary-color', selectedColors[0]);
      document.documentElement.style.setProperty('--secondary-color', selectedColors[1]);
    }
  };

  return (
    <div className="sidebar-menu">
      <div className="logo-section">
        <div className="logo-icon">
          <Home size={24} />
        </div>
        <span className="logo-text">PMBH Desktop</span>
      </div>
      
      <Menu
        mode="inline"
        selectedKeys={[location.pathname]}
        openKeys={openKeys}
        onClick={handleMenuClick}
        onOpenChange={handleOpenChange}
        items={menuItems}
        style={{ border: 'none' }}
        className="main-menu"
      />

      <div className="theme-selector">
        <Card size="small" title={
          <div className="theme-title">
            <Palette size={16} />
            <span>Chọn bộ màu sắc</span>
          </div>
        }>
          <Select
            value={selectedTheme}
            onChange={handleThemeChange}
            className="theme-select"
            suffixIcon={<ChevronDown size={16} />}
          >
            {colorThemes.map(theme => (
              <Option key={theme.value} value={theme.value}>
                <div className="theme-option">
                  <div className="theme-colors">
                    <div 
                      className="color-dot" 
                      style={{ backgroundColor: theme.colors[0] }}
                    />
                    <div 
                      className="color-dot" 
                      style={{ backgroundColor: theme.colors[1] }}
                    />
                  </div>
                  <span>{theme.label}</span>
                </div>
              </Option>
            ))}
          </Select>
        </Card>
      </div>
    </div>
  );
};

export default SidebarMenu;
