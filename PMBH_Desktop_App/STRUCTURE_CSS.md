# CẤU TRÚC CSS CHO HỆ THỐNG POS CAFE DESKTOP

## 📁 TỔNG QUAN CẤU TRÚC THỦ MỤC

```
src/styles/
├── main.css                    # File CSS chính - Import tất cả
├── index.css                   # File hiện tại (sẽ được thay thế)
│
├── base/                       # CSS cơ bản - Foundation
│   ├── variables.css           # Biến CSS toàn cục
│   ├── reset.css              # CSS Reset & Normalize
│   ├── typography.css         # Hệ thống Typography
│   └── layout.css             # Layout & Grid system
│
├── themes/                     # Các theme khác nhau
│   ├── default.css            # Theme mặc định
│   ├── dark.css               # Theme tối
│   └── cafe.css               # Theme cafe đặc biệt
│
├── utils/                      # Utility classes
│   ├── animations.css         # Animations & Transitions
│   ├── helpers.css            # Helper classes
│   └── responsive.css         # Responsive utilities
│
├── components/                 # Component styles
│   ├── buttons.css            # Buttons
│   ├── forms.css              # Form elements
│   ├── cards.css              # Cards
│   ├── tables.css             # Tables
│   ├── modals.css             # Modals & Dialogs
│   ├── navigation.css         # Navigation
│   ├── badges.css             # Badges & Tags
│   ├── tooltips.css           # Tooltips
│   ├── alerts.css             # Alerts & Messages
│   └── loading.css            # Loading states
│
├── modules/                    # Module-specific styles
│   ├── auth.css               # Authentication module
│   ├── banhang.css            # Bán hàng module
│   ├── sanpham.css            # Sản phẩm module
│   ├── khachhang.css          # Khách hàng module
│   ├── nhanvien.css           # Nhân viên module
│   ├── baocao.css             # Báo cáo module
│   └── caidat.css             # Cài đặt module
│
├── pages/                      # Page-specific styles
│   ├── dashboard.css          # Dashboard page
│   ├── login.css              # Login page
│   ├── pos.css                # POS interface
│   ├── reports.css            # Reports pages
│   └── settings.css           # Settings pages
│
├── vendor/                     # Third-party overrides
│   ├── antd-overrides.css     # Ant Design customizations
│   └── print.css              # Print styles
│
└── custom/                     # Custom overrides
    ├── overrides.css          # Global overrides
    └── patches.css            # Temporary fixes
```

## 🎯 NGUYÊN TẮC TỔ CHỨC

### 1. **TÍNH MODULARITY (Tính mô-đun)**
- Mỗi file CSS có trách nhiệm riêng biệt
- Dễ dàng maintain và debug
- Có thể tái sử dụng across different components

### 2. **CASCADE HIERARCHY (Thứ tự ưu tiên)**
```
Base Styles (lowest priority)
  ↓
Theme Styles
  ↓
Utility Styles
  ↓
Component Styles
  ↓
Module Styles
  ↓
Page Styles
  ↓
Vendor Overrides
  ↓
Custom Overrides (highest priority)
```

### 3. **NAMING CONVENTION**
- **BEM Methodology**: `.block__element--modifier`
- **Utility Classes**: `.prefix-property-value`
- **CSS Variables**: `--category-subcategory-property`

## 📋 CHI TIẾT TỪNG THƯ MỤC

### 🔧 **BASE/** - CSS Foundation
#### `variables.css`
- **Color Palette**: Primary, secondary, accent, status colors
- **Typography**: Font families, sizes, weights, line heights
- **Spacing**: Margin, padding scale (4px base)
- **Border Radius**: Corner radius scale
- **Shadows**: Drop shadow system
- **Z-index**: Layer management
- **Breakpoints**: Responsive breakpoints
- **Component Variables**: Button heights, form controls, etc.

#### `reset.css`
- Modern CSS reset
- Browser normalization
- Accessibility defaults
- Screen reader utilities

#### `typography.css`
- Heading styles (h1-h6)
- Text utilities (sizes, weights, colors)
- Font families
- Text alignment, decoration, transform
- Cafe-specific typography (prices, codes, status)

#### `layout.css`
- Grid system (1-12 columns)
- Flexbox utilities
- Container system
- Spacing utilities (margin, padding)
- Position utilities
- Display utilities
- Responsive classes

### 🎨 **THEMES/** - Theme System
#### `default.css`
- Light theme (primary)
- Professional office look
- High contrast for accessibility

#### `dark.css`
- Dark mode theme
- Eye-friendly for night shifts
- Energy saving for OLED screens

#### `cafe.css`
- Warm coffee colors
- Cozy atmosphere
- Brand-aligned styling

### ⚡ **UTILS/** - Utility Classes
#### `animations.css`
- Fade in/out animations
- Slide transitions
- Loading animations
- Hover effects
- Micro-interactions

#### `helpers.css`
- Common utility classes
- Quick styling solutions
- Debug utilities
- Clearfix, centering, etc.

#### `responsive.css`
- Responsive utilities
- Mobile-first approach
- Breakpoint-specific classes

### 🧩 **COMPONENTS/** - UI Components
#### `buttons.css`
- Primary, secondary, outline buttons
- Button sizes (sm, md, lg)
- Button states (hover, active, disabled)
- Icon buttons
- Button groups

#### `forms.css`
- Input fields
- Textareas
- Select dropdowns
- Checkboxes & radios
- Form validation states
- Form layouts

#### `cards.css`
- Basic card structure
- Card headers, bodies, footers
- Card variants (elevated, outlined)
- Interactive cards

#### `tables.css`
- Table layouts
- Table headers
- Striped, bordered tables
- Responsive tables
- Table actions

#### `modals.css`
- Modal overlays
- Modal sizes
- Modal animations
- Modal headers, bodies, footers

#### `navigation.css`
- Sidebar navigation
- Breadcrumbs
- Tab navigation
- Menu items

### 📦 **MODULES/** - Feature Modules
#### `banhang.css`
- Table grid layout
- Table status colors
- Order interface
- Cart styling
- Payment interface

#### `sanpham.css`
- Product grid
- Product cards
- Category filters
- Stock indicators
- Price display

#### `khachhang.css`
- Customer list
- Customer profiles
- Contact information styling

### 📄 **PAGES/** - Specific Pages
#### `dashboard.css`
- Dashboard layout
- Statistics cards
- Chart containers
- Widget styling

#### `pos.css`
- POS interface layout
- Touch-friendly buttons
- Quick actions
- Cash register styling

### 🔧 **VENDOR/** - Third-party Overrides
#### `antd-overrides.css`
- Ant Design customizations
- Theme alignment
- Component modifications
- Size adjustments

## 🚀 CÁCH SỬ DỤNG

### 1. **Import chính**
```javascript
// Trong App.jsx hoặc main.jsx
import './styles/main.css';
```

### 2. **Sử dụng CSS Variables**
```css
.custom-button {
  background-color: var(--color-primary);
  padding: var(--space-3) var(--space-4);
  border-radius: var(--radius-base);
  box-shadow: var(--shadow-base);
}
```

### 3. **Sử dụng Utility Classes**
```jsx
<div className="flex items-center justify-between p-4 bg-white rounded-lg shadow-base">
  <h2 className="text-xl font-semibold text-gray-800">Title</h2>
  <button className="btn btn-primary">Action</button>
</div>
```

### 4. **Responsive Design**
```jsx
<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <div className="card">Content</div>
</div>
```

## 🎯 LỢI ÍCH CỦA CẤU TRÚC NÀY

### ✅ **MAINTAINABILITY**
- Dễ dàng tìm và sửa styles
- Tách biệt concerns
- Giảm CSS conflicts

### ✅ **SCALABILITY**
- Dễ thêm features mới
- Module system
- Reusable components

### ✅ **CONSISTENCY**
- Design system thống nhất
- CSS variables centralized
- Standardized spacing

### ✅ **PERFORMANCE**
- CSS optimization
- Tree shaking potential
- Selective imports

### ✅ **DEVELOPER EXPERIENCE**
- Clear organization
- Easy debugging
- Predictable naming

## 🔧 CÔNG CỤ VÀ WORKFLOW

### **Development**
- CSS Variables cho theming
- CSS Grid & Flexbox cho layout
- Mobile-first responsive
- BEM methodology

### **Build Process**
- CSS bundling
- Autoprefixer
- Minification
- Dead code elimination

### **Quality Assurance**
- CSS linting
- Style guide enforcement
- Cross-browser testing
- Accessibility validation

---

**Ghi chú**: Đây là cấu trúc foundation hoàn chỉnh. Mỗi lần cần thay đổi gì đó "tập thể" (colors, spacing, typography), chỉ cần sửa trong file `variables.css` và tất cả sẽ được update tự động!
