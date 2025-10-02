# 🚀 Universal Text Extractor - Quick Start Guide

## 5 phút để bắt đầu!

### ✅ Bước 1: Chuẩn bị

```bash
# Kiểm tra Python version (cần >= 3.7)
python --version

# Download script
# File: universal_text_extractor.py
```

### ✅ Bước 2: Chạy lệnh đầu tiên

```bash
# Cú pháp cơ bản:
python universal_text_extractor.py /path/to/your/project
```

**Ví dụ:**
```bash
# Windows
python universal_text_extractor.py C:\Users\MyName\MyProject

# macOS/Linux
python universal_text_extractor.py ~/projects/my-app
```

### ✅ Bước 3: Kiểm tra kết quả

Output sẽ ở `./extracted_texts/[language_code]/`

```bash
cd extracted_texts/vi
ls
# INDEX.txt, module1.txt, module2.txt, ...
```

---

## 🎯 Các lệnh thường dùng

### 1️⃣ Quét React/Vue/Angular project

```bash
python universal_text_extractor.py ./my-web-app
```

### 2️⃣ Quét Flutter project

```bash
python universal_text_extractor.py ./my-flutter-app --language en
```

### 3️⃣ Quét Android project

```bash
python universal_text_extractor.py ./MyAndroidApp --format all
```

### 4️⃣ Chỉ định output folder

```bash
python universal_text_extractor.py ./project --output ./translations
```

### 5️⃣ Export JSON + CSV

```bash
python universal_text_extractor.py ./project --format json csv
```

---

## 📋 Tham số CLI

| Tham số | Ý nghĩa | Mặc định | Ví dụ |
|---------|---------|----------|-------|
| `project_path` | Đường dẫn project | (bắt buộc) | `./my-app` |
| `--output` hoặc `-o` | Thư mục output | `./extracted_texts` | `--output ./i18n` |
| `--language` hoặc `-l` | Ngôn ngữ | `auto` | `--language vi` |
| `--format` hoặc `-f` | Format xuất | `txt` | `--format txt json csv` |
| `--verbose` hoặc `-v` | Hiển thị chi tiết | `False` | `--verbose` |
| `--min-length` | Độ dài tối thiểu | `2` | `--min-length 5` |
| `--max-length` | Độ dài tối đa | `500` | `--max-length 200` |

---

## 🎨 Examples

### Example 1: React App đơn giản

```bash
python universal_text_extractor.py ~/projects/react-shop \
    --language vi \
    --format txt \
    --output ./translations
```

**Kết quả:**
```
translations/
└── vi/
    ├── INDEX.txt          # 663 texts total
    ├── BanHang.txt        # 155 texts
    ├── SanPham.txt        # 67 texts
    └── TrangChu.txt       # 45 texts
```

### Example 2: Multi-format export

```bash
python universal_text_extractor.py ~/projects/vue-store \
    --format all
```

**Kết quả:**
```
extracted_texts/
├── vi_texts.json          # JSON format
├── vi_texts.csv           # CSV format
└── vi/
    ├── INDEX.txt
    ├── module1.txt        # TXT format
    └── module2.txt
```

### Example 3: Custom text length

```bash
# Chỉ lấy text từ 3-100 ký tự (loại bỏ text quá ngắn/dài)
python universal_text_extractor.py ./my-app \
    --min-length 3 \
    --max-length 100
```

### Example 4: Verbose mode

```bash
python universal_text_extractor.py ./my-app --verbose
```

**Output chi tiết:**
```
============================================================
🚀 STARTING PROJECT SCAN
============================================================

📂 Scanning directory: src

📄 Scanned: components/Header.jsx - Found 12 texts
📄 Scanned: pages/Home.jsx - Found 45 texts
📄 Scanned: pages/Products.jsx - Found 67 texts
...
```

---

## 🌍 Ngôn ngữ được hỗ trợ

```bash
# Tự động phát hiện
--language auto

# Tiếng Việt
--language vi

# English
--language en

# 中文 (Chinese)
--language zh

# 日本語 (Japanese)
--language ja

# 한국어 (Korean)
--language ko

# ภาษาไทย (Thai)
--language th

# Và nhiều hơn nữa...
```

---

## 🔧 Customization nhanh

### Bỏ qua thư mục cụ thể

Chỉnh sửa trong file `.py`:

```python
SKIP_FOLDERS = {
    'node_modules', 'dist', 'build',
    'my_custom_folder'  # ← Thêm folder của bạn
}
```

### Thêm file extension mới

```python
PROJECT_TYPES = {
    'react': {
        'files': ['*.jsx', '*.js', '*.tsx', '*.ts', '*.myext'],  # ← Thêm .myext
        ...
    }
}
```

### Thêm pattern mới

```python
PATTERNS = {
    'my_pattern': r'myFunction\(["\']([^"\']+)["\']\)',  # ← Custom pattern
}
```

---

## ⚡ Pro Tips

### Tip 1: Quét từng thư mục

```bash
# Thay vì quét toàn bộ project (chậm)
python universal_text_extractor.py ~/project

# Quét riêng thư mục src (nhanh)
python universal_text_extractor.py ~/project/src --output ~/project/i18n
```

### Tip 2: Script tự động

Tạo file `extract.sh` (Linux/Mac) hoặc `extract.bat` (Windows):

```bash
#!/bin/bash
# extract.sh

echo "🚀 Extracting UI texts..."
python universal_text_extractor.py . \
    --language vi \
    --format all \
    --output ./i18n

echo "✅ Done! Check ./i18n folder"
```

Chạy:
```bash
chmod +x extract.sh
./extract.sh
```

### Tip 3: Tích hợp Git

```bash
# .gitignore - Không commit file tạm
extracted_texts/

# Hoặc commit để team cùng dùng
git add extracted_texts/
git commit -m "Update UI texts"
```

### Tip 4: So sánh versions

```bash
# Extract version cũ
git checkout old-branch
python universal_text_extractor.py . --output ./old_texts

# Extract version mới
git checkout new-branch
python universal_text_extractor.py . --output ./new_texts

# So sánh
diff old_texts/vi/INDEX.txt new_texts/vi/INDEX.txt
```

---

## 🐛 Xử lý lỗi thường gặp

### ❌ Lỗi: "No module named 'xxx'"

**Nguyên nhân:** Script chỉ dùng standard library, không cần cài package

**Giải pháp:** Kiểm tra Python version >= 3.7

```bash
python --version  # Phải >= 3.7
```

### ❌ Lỗi: "Permission denied"

**Nguyên nhân:** Không có quyền ghi file

**Giải pháp:**
```bash
# Windows: Chạy CMD/PowerShell as Administrator
# Linux/Mac:
chmod +x universal_text_extractor.py
# Hoặc chỉ định output folder có quyền ghi
python universal_text_extractor.py . --output ~/Documents/texts
```

### ❌ Lỗi: "UnicodeDecodeError"

**Nguyên nhân:** File có encoding đặc biệt

**Giải pháp:** Script tự động fallback encoding, không cần fix

### ❌ Không tìm thấy text nào

**Nguyên nhân:** Pattern không match với code

**Giải pháp:** Giảm min-length hoặc thêm custom pattern

```bash
python universal_text_extractor.py . --min-length 1
```

---

## 📊 Workflow thực tế

### Workflow 1: Development

```bash
# 1. Code tính năng mới
# 2. Extract texts
python universal_text_extractor.py . --output ./i18n
# 3. Copy texts vào language files
# 4. Test translation
# 5. Commit
```

### Workflow 2: Translation Team

```bash
# 1. PM: Extract texts
python universal_text_extractor.py . --format csv

# 2. Upload CSV lên Google Sheets
# 3. Translators: Dịch trong Sheets
# 4. Export CSV
# 5. Import vào project
```

### Workflow 3: CI/CD Integration

```yaml
# .github/workflows/extract.yml
name: Extract Texts
on: [push]
jobs:
  extract:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Extract
        run: python universal_text_extractor.py . --format json
      - name: Upload
        uses: actions/upload-artifact@v2
        with:
          name: texts
          path: extracted_texts/
```

---

## 🎓 Next Steps

1. ✅ Chạy script lần đầu → Kiểm tra output
2. ✅ Customize theo nhu cầu → Thêm patterns/skip folders
3. ✅ Tích hợp vào workflow → Script tự động
4. ✅ Chia sẻ với team → Hướng dẫn sử dụng

---

## 📚 Tài liệu đầy đủ

Đọc thêm: [UNIVERSAL_EXTRACTOR_README.md](./UNIVERSAL_EXTRACTOR_README.md)

---

## ❓ Câu hỏi thường gặp

**Q: Script có cần cài đặt thư viện không?**
A: Không, chỉ cần Python 3.7+

**Q: Có hỗ trợ Windows không?**
A: Có, hoạt động trên Windows/macOS/Linux

**Q: Có thể quét project PHP/Python/Java không?**
A: Có, hỗ trợ đa ngôn ngữ (xem list ở README)

**Q: Output có thể dùng làm translation file không?**
A: Có, format TXT/JSON/CSV đều có thể dùng cho i18n

**Q: Có thể customize patterns không?**
A: Có, chỉnh sửa Config.PATTERNS trong code

---

**🎉 Chúc bạn extraction thành công! 🎉**

_Need help? Check the full README or open an issue on GitHub_
