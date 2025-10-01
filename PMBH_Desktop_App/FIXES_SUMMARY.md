# Tóm tắt các sửa đổi

## Ngày: 2025-10-01

### 1. Đơn Vị (DonVi.jsx) - Di chuyển ô tìm kiếm
**Vấn đề**: Ô tìm kiếm ở dưới header, tách biệt với button "Thêm mới"

**Giải pháp**: 
- Di chuyển ô tìm kiếm lên header của Card, đặt kế bên button "Thêm mới"
- Tạo layout flexbox để ô tìm kiếm và button nằm cạnh nhau
- Code:
```jsx
<div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
  <SearchInput ... />
  <Button type="primary" ... >Thêm mới</Button>
</div>
```

### 2. Tầng Nhà Hàng (TangNhaHang.jsx) - Thêm chức năng tìm kiếm
**Vấn đề**: Không có ô tìm kiếm cho Tầng/Khu vực nhà hàng

**Giải pháp**:
- Thêm state `filteredList` và `searchText`
- Thêm hàm `handleSearch` để lọc danh sách theo mã hoặc tên
- Thêm `SearchInput` component vào header Card
- Cập nhật Table để hiển thị `filteredList` thay vì `khuVucList`
- Đặt ô tìm kiếm kế bên button "Thêm mới" giống như Đơn Vị

### 3. Sản Phẩm (SanPham.jsx) - Sửa lỗi giá bán về 0đ
**Vấn đề**: 
- Khi thêm sản phẩm mới, giá bán tự động về 0đ
- Khi sửa sản phẩm, giá bán không được giữ nguyên
- Tên và giá sản phẩm không được cập nhật đúng

**Nguyên nhân**:
- Hàm `parser` trong `InputNumber` component trả về 0 khi parse thất bại
- Việc parse giá bán từ database không xử lý đúng các định dạng khác nhau (string/number)
- Không validate giá bán trước khi submit

**Giải pháp**:

#### 3.1. Cải thiện hàm `handleEditProduct`:
```javascript
// Parse giá bán tốt hơn
let giaBan = product.gia || original.giaBan || original.gia || original.donGia || 0;

// Chuyển đổi string thành số đúng cách
if (typeof giaBan === 'string') {
  giaBan = giaBan.replace(/[,\.]/g, ''); // Xóa dấu phẩy và chấm
  giaBan = parseInt(giaBan, 10);
}

// Đảm bảo là số hợp lệ
const giaBanNumber = (!isNaN(giaBan) && giaBan >= 0) ? giaBan : 0;
```

#### 3.2. Cải thiện hàm `handleProductSubmit`:
```javascript
// Validate giá bán
let giaBan = values.lv004;

if (typeof giaBan === 'string') {
  giaBan = giaBan.replace(/[,\.]/g, '');
  giaBan = parseInt(giaBan, 10);
}

// Kiểm tra tính hợp lệ
if (isNaN(giaBan) || giaBan < 0) {
  message.error('Giá bán không hợp lệ. Vui lòng nhập giá bán hợp lệ.');
  return; // Ngăn submit nếu giá không hợp lệ
}

// Log để debug
console.log('Price in payload (lv004):', payload.lv004, typeof payload.lv004);
```

#### 3.3. Sửa parser trong InputNumber:
```javascript
parser={value => {
  if (!value) return ''; // Trả về chuỗi rỗng thay vì 0
  const cleaned = value.replace(/[^\d]/g, ''); // Chỉ giữ số
  const num = parseInt(cleaned, 10);
  return isNaN(num) ? '' : num; // Trả về chuỗi rỗng nếu không parse được
}}
```

### 4. Đơn Vị CRUD - Vấn đề không thêm/sửa/xóa được

**Lưu ý**: Cần kiểm tra backend API để đảm bảo:
1. API endpoint `sl_lv0005` đang hoạt động
2. Permissions (isAdd, isEdit, isDel) được cấp đúng cho user
3. Database connection hoạt động bình thường

**Cách kiểm tra**:
1. Mở Console trong Developer Tools
2. Thực hiện thao tác thêm/sửa/xóa
3. Xem các log được in ra:
   - "Form values:" - Dữ liệu từ form
   - "Add/Update payload:" - Dữ liệu gửi lên API
   - "Add/Update result:" - Kết quả từ API
4. Kiểm tra tab Network để xem response từ server

**Có thể là lỗi từ backend**:
- File `gmac/clsall/sl_lv0005.php` cần có quyền thực thi
- User session cần có quyền isAdd=1, isEdit=1, isDel=1
- Database cần có table `sl_lv0005` với đúng structure

## Tóm tắt thay đổi

### Files đã sửa:
1. `src/pages/DonVi/DonVi.jsx`
2. `src/pages/TangNhaHang/TangNhaHang.jsx`
3. `src/pages/SanPham/SanPham.jsx`

### Chức năng đã cải thiện:
1. ✅ Ô tìm kiếm đơn vị giờ nằm kế bên button "Thêm mới"
2. ✅ Thêm ô tìm kiếm cho Tầng Nhà Hàng
3. ✅ Sửa lỗi giá sản phẩm tự động về 0đ
4. ✅ Sửa lỗi không update được giá và tên sản phẩm
5. ✅ Thêm validation cho giá bán
6. ⚠️ Cần kiểm tra backend cho chức năng CRUD đơn vị

## Hướng dẫn test

### Test 1: Tìm kiếm Đơn Vị và Tầng Nhà Hàng
1. Mở trang Đơn Vị hoặc Tầng Nhà Hàng
2. Nhập từ khóa vào ô tìm kiếm
3. Danh sách sẽ được lọc theo mã hoặc tên

### Test 2: Thêm/Sửa Sản Phẩm với giá
1. Thêm sản phẩm mới
2. Nhập giá bán (VD: 50000)
3. Kiểm tra trong database - giá phải là 50000, không phải 0
4. Sửa sản phẩm - giá cũ phải hiển thị đúng trong form
5. Thay đổi giá và save - giá mới phải được cập nhật

### Test 3: Thêm/Sửa/Xóa Đơn Vị
1. Thử thêm đơn vị mới
2. Thử sửa đơn vị
3. Thử xóa đơn vị
4. Nếu không được, mở Console và gửi logs cho developer

## Các console.log để debug
Code đã thêm nhiều console.log để giúp debug:
- Trong `handleEditProduct`: In ra giá bán đã parse
- Trong `handleProductSubmit`: In ra payload và giá bán
- Trong `loadData` của DonVi: In ra dữ liệu từ API

Nếu gặp lỗi, hãy mở Console (F12) và gửi logs để hỗ trợ.
