import React, { useEffect, useMemo, useState } from 'react';
import { Menu, Select, Card } from 'antd';
import { useNavigate, useLocation } from 'react-router-dom';
import { Home, Palette, ChevronDown } from 'lucide-react';
import { protectedRoutes, menuGroups } from '../../../routes/config';
import './SidebarMenu.css';

const { Option } = Select;

const ICON_SIZE = 16;

const createIconNode = (IconComponent) =>
  IconComponent ? React.createElement(IconComponent, { size: ICON_SIZE }) : undefined;

const buildMenuTree = () => {
  const menuRoutes = protectedRoutes.filter((route) => route.meta?.menu);
  const nodeMap = new Map();
  const parentMap = new Map();
  const groupMap = new Map();

  menuRoutes.forEach((route) => {
    const { meta } = route;
    const { menu = {} } = meta;
    const node = {
      key: route.path,
      path: route.path,
      label: menu.label || meta.title || route.path,
      order: menu.order ?? 0,
      parent: menu.parent || null,
      group: menu.group || 'core',
      icon: createIconNode(menu.icon),
      children: []
    };
    nodeMap.set(node.key, node);
  });

  nodeMap.forEach((node) => {
    if (node.parent && nodeMap.has(node.parent)) {
      const parentNode = nodeMap.get(node.parent);
      parentNode.children.push(node);
      parentMap.set(node.key, parentNode.key);
      node.group = parentNode.group;
    }
  });

  nodeMap.forEach((node) => {
    groupMap.set(node.key, node.group);
  });

  const groups = Object.values(menuGroups).map((group) => ({
    key: group.key,
    label: group.label,
    icon: createIconNode(group.icon),
    order: group.order ?? 0,
    children: []
  }));

  nodeMap.forEach((node) => {
    if (!node.parent) {
      const targetGroup = groups.find((group) => group.key === node.group) || groups[0];
      if (targetGroup) {
        targetGroup.children.push(node);
      }
    }
  });

  const sortNodes = (list) =>
    list
      .slice()
      .sort((a, b) => (a.order ?? 0) - (b.order ?? 0))
      .map((item) => ({
        ...item,
        children: sortNodes(item.children || [])
      }));

  const sortedGroups = groups
    .map((group) => ({
      ...group,
      children: sortNodes(group.children || [])
    }))
    .filter((group) => group.children.length > 0)
    .sort((a, b) => (a.order ?? 0) - (b.order ?? 0));

  return {
    groups: sortedGroups,
    parentMap,
    groupMap
  };
};

const getDefaultOpenKeys = (path, parentMap, groupMap) => {
  const keys = new Set();
  let current = path;
  const visited = new Set();

  while (current && parentMap.has(current)) {
    const parent = parentMap.get(current);
    if (!parent || visited.has(parent)) {
      break;
    }
    keys.add(parent);
    visited.add(parent);
    current = parent;
  }

  const groupKey = groupMap.get(path);
  if (groupKey) {
    keys.add(groupKey);
  }

  return Array.from(keys);
};

const mapNodesToMenuItems = (nodes, navigate) =>
  nodes.map((node) => {
    const hasChildren = node.children && node.children.length > 0;
    const label = node.path && hasChildren
      ? (
          <span
            className="sidebar-menu__parent-link"
            onClick={(event) => {
              event.stopPropagation();
              navigate(node.path);
            }}
          >
            {node.label}
          </span>
        )
      : node.label;

    return {
      key: node.key,
      icon: node.icon,
      label,
      children: hasChildren ? mapNodesToMenuItems(node.children, navigate) : undefined
    };
  });

const SidebarMenu = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [selectedTheme, setSelectedTheme] = useState('default');
  const menuStructure = useMemo(() => buildMenuTree(), []);
  const { parentMap, groupMap, groups } = menuStructure;
  const groupKeys = useMemo(() => new Set(Object.keys(menuGroups)), []);
  const [openKeys, setOpenKeys] = useState(() =>
    getDefaultOpenKeys(location.pathname, parentMap, groupMap)
  );

  const menuItems = useMemo(
    () => mapNodesToMenuItems(groups, navigate),
    [groups, navigate]
  );

  useEffect(() => {
    setOpenKeys(getDefaultOpenKeys(location.pathname, parentMap, groupMap));
  }, [location.pathname, parentMap, groupMap]);

  const colorThemes = [
    { value: 'default', label: 'Mặc định', colors: ['#197dd3', '#77d4fb'] },
    { value: 'ocean', label: 'Đại dương', colors: ['#0066cc', '#66ccff'] },
    { value: 'forest', label: 'Rừng xanh', colors: ['#006600', '#66cc66'] },
    { value: 'sunset', label: 'Hoàng hôn', colors: ['#ff6600', '#ffcc66'] },
    { value: 'purple', label: 'Tím', colors: ['#6600cc', '#cc66ff'] }
  ];

  const handleMenuClick = ({ key }) => {
    // Chỉ xử lý navigation cho các items con (routes)
    if (key.startsWith('/')) {
      navigate(key);
    }
  };

  // Hàm xử lý khi submenu được mở/đóng
  const handleOpenChange = (keys) => {
    const latestKey = keys.find((key) => !openKeys.includes(key));

    if (latestKey && groupKeys.has(latestKey)) {
      const mergedKeys = [latestKey, ...keys.filter((key) => !groupKeys.has(key))];
      setOpenKeys(mergedKeys);
      return;
    }

    setOpenKeys(keys);
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
