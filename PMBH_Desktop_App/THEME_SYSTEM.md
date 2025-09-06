# Theme System - PMBH Desktop App

## Tổng quan

Hệ thống theme mới được thiết kế để dễ dàng chuyển đổi giữa các bộ màu khác nhau, phù hợp với nhiều loại hình kinh doanh và sở thích người dùng.

## Danh sách Themes

### Theme Default (Blue Ocean)
- **Mô tả**: Theme mặc định với tone xanh dương hiện đại
- **Pallet màu**: `#197dd3`, `#77d4fb`, `#bdbcc4`, `#4b4344`
- **Phù hợp**: Business hiện đại, tech-focused, professional
- **Class**: Không cần class (default)

### Theme 1 (Cafe Classic)
- **Mô tả**: Theme truyền thống với tone nâu cafe
- **Màu chủ đạo**: `#8B4513`, `#D2B48C`, `#5D2F0A`, `#F4A460`
- **Phù hợp**: Quán cafe truyền thống, không gian ấm cúng
- **Class**: `.theme-1`

## Màu Trạng Thái (Status Colors)

Được thiết kế để hài hòa với tất cả themes:

- **Success**: `#22c55e` (Modern Green)
- **Warning**: `#f59e0b` (Amber)
- **Error**: `#ef4444` (Modern Red) 
- **Info**: `#3b82f6` (Modern Blue)

## Cách sử dụng

### 1. Áp dụng Theme

#### Phương pháp 1: Sử dụng JavaScript
```javascript
// Khởi tạo theme controller
const themeController = new ThemeController();

// Chuyển đổi theme
themeController.applyTheme('theme-1');
themeController.applyTheme('default');

// Toggle giữa default và theme-1
themeController.toggleTheme();
```

#### Phương pháp 2: Thêm class CSS
```html
<!-- Theme mặc định -->
<body>
  <!-- Nội dung -->
</body>

<!-- Theme 1 -->
<body class="theme-1">
  <!-- Nội dung -->
</body>
```

### 2. Keyboard Shortcuts

- **Ctrl + T**: Toggle giữa theme Blue Ocean (default) và Cafe Classic (theme-1)

### 3. Theme Selector UI

```javascript
// Tạo theme selector
const selector = window.themeController.createThemeSelector();
document.body.appendChild(selector);
```

## Cấu trúc Files

```
src/styles/
├── base/
│   └── variables.css          # Biến CSS chính + theme system notes
├── themes/
│   ├── default.css           # Theme Blue Ocean (mặc định)
│   ├── theme-1.css          # Theme Cafe Classic
│   └── [theme-2.css]        # Themes tương lai
├── components/
│   └── theme-selector.css   # Styles cho theme selector
└── main.css                 # Import tất cả themes

src/js/
└── theme-controller.js      # JavaScript controller

theme-demo.html              # Demo page để test themes
```

## Test Themes

Mở file `theme-demo.html` trong trình duyệt để test:

1. **Color Palette**: Xem các màu chủ đạo
2. **Status Colors**: Test màu thành công, cảnh báo, lỗi
3. **Components**: Buttons, forms, cards, tables
4. **Theme Selector**: UI để chuyển đổi theme
5. **Keyboard Shortcuts**: Test Ctrl + T

## Thêm Theme Mới

### Bước 1: Tạo file theme mới
```css
/* src/styles/themes/theme-2.css */
.theme-2 {
  --color-primary: #your-color;
  --color-primary-light: #your-light-color;
  /* ... override các variables khác */
}
```

### Bước 2: Import vào main.css
```css
@import './themes/theme-2.css';
```

### Bước 3: Cập nhật ThemeController
```javascript
// Thêm vào getAvailableThemes()
{
  name: 'theme-2',
  label: 'Your Theme Name',
  description: 'Theme description',
  colors: ['#color1', '#color2', '#color3']
}
```

### Bước 4: Cập nhật removeAllThemeClasses()
```javascript
const themeClasses = ['theme-1', 'theme-2', 'theme-dark'];
```

## CSS Variables Hệ thống

### Colors
- `--color-primary`, `--color-primary-light`, `--color-primary-dark`
- `--color-secondary`, `--color-secondary-light`, `--color-secondary-dark`
- `--color-success`, `--color-warning`, `--color-error`, `--color-info`

### Backgrounds
- `--bg-primary`, `--bg-secondary`, `--bg-tertiary`
- `--bg-surface`, `--bg-surface-hover`

### Text
- `--color-text-primary`, `--color-text-secondary`, `--color-text-muted`
- `--color-text-on-primary`, `--color-text-on-surface`

### Borders & Shadows
- `--border-light`, `--border-medium`, `--border-dark`
- `--shadow-primary`, `--shadow-success`, `--shadow-warning`, `--shadow-error`

## Best Practices

1. **Consistency**: Sử dụng CSS variables thay vì hardcode màu
2. **Accessibility**: Đảm bảo contrast ratio phù hợp
3. **Testing**: Test tất cả components với theme mới
4. **Documentation**: Ghi chú rõ ràng cho theme mới
5. **Fallbacks**: Luôn có fallback colors cho các variables

## Browser Support

- Chrome 49+
- Firefox 31+
- Safari 9.1+
- Edge 16+

CSS Variables được support đầy đủ trên các trình duyệt hiện đại.
