# Universal Text Extractor v2.0.0

## 📖 Giới thiệu

**Universal Text Extractor** là một công cụ Python mạnh mẽ và linh hoạt, được thiết kế để tự động quét, phát hiện và trích xuất UI text từ **bất kỳ loại project nào**, bất kể ngôn ngữ lập trình hay framework.

### ✨ Đặc điểm nổi bật

- 🔍 **Tự động phát hiện loại project** (React, Vue, Angular, Flutter, Android, iOS, Django, Laravel...)
- 🌍 **Phát hiện ngôn ngữ tự động** (hỗ trợ 13+ ngôn ngữ)
- 📂 **Quét cây thư mục thông minh** với khả năng bỏ qua các thư mục không cần thiết
- 🎯 **Trích xuất chính xác** với 20+ pattern regex tối ưu
- 📝 **Export đa dạng**: TXT, JSON, CSV
- 🚀 **Hiệu năng cao** với xử lý song song
- 🛡️ **An toàn** với multiple encoding fallback

---

## 🚀 Cài đặt

### Yêu cầu

- Python 3.7 trở lên
- Không cần thư viện bên ngoài (chỉ sử dụng standard library)

### Cài đặt nhanh

```bash
# Clone hoặc download file universal_text_extractor.py
# Không cần cài đặt gì thêm!
```

---

## 📋 Sử dụng cơ bản

### 1. Quét project đơn giản

```bash
python universal_text_extractor.py /path/to/your/project
```

Kết quả sẽ được lưu vào thư mục `./extracted_texts/`

### 2. Chỉ định thư mục output

```bash
python universal_text_extractor.py /path/to/project --output ./my_texts
```

### 3. Chỉ định ngôn ngữ

```bash
# Tự động phát hiện (mặc định)
python universal_text_extractor.py /path/to/project --language auto

# Tiếng Việt
python universal_text_extractor.py /path/to/project --language vi

# English
python universal_text_extractor.py /path/to/project --language en

# 中文
python universal_text_extractor.py /path/to/project --language zh
```

### 4. Export nhiều format

```bash
# Chỉ TXT
python universal_text_extractor.py /path/to/project --format txt

# TXT + JSON
python universal_text_extractor.py /path/to/project --format txt json

# TXT + JSON + CSV
python universal_text_extractor.py /path/to/project --format txt json csv

# Tất cả format
python universal_text_extractor.py /path/to/project --format all
```

### 5. Tùy chỉnh độ dài text

```bash
# Chỉ lấy text từ 5-200 ký tự
python universal_text_extractor.py /path/to/project --min-length 5 --max-length 200
```

### 6. Verbose mode (hiển thị chi tiết)

```bash
python universal_text_extractor.py /path/to/project --verbose
```

---

## 🎯 Các loại project được hỗ trợ

| Framework | File Extensions | Auto Detection |
|-----------|----------------|----------------|
| **React** | .jsx, .js, .tsx, .ts | ✅ package.json + src/ |
| **Vue.js** | .vue, .js, .ts | ✅ package.json + src/ |
| **Angular** | .component.ts, .html | ✅ angular.json |
| **Flutter** | .dart | ✅ pubspec.yaml + lib/ |
| **Android** | .java, .kt, .xml | ✅ AndroidManifest.xml |
| **iOS** | .swift, .m, .storyboard | ✅ Info.plist + .xcodeproj |
| **Django** | .py, .html | ✅ manage.py |
| **Laravel** | .php, .blade.php | ✅ composer.json + artisan |
| **Generic** | .html, .js, .py, .php | ✅ Fallback |

---

## 🌍 Ngôn ngữ được hỗ trợ

Script tự động phát hiện và phân loại text theo các ngôn ngữ:

| Code | Language | Detection Pattern |
|------|----------|------------------|
| `vi` | Tiếng Việt | Dấu thanh: à, á, ạ, ả, ã... |
| `en` | English | Latin alphabet |
| `zh` | 中文 | Chinese characters |
| `ja` | 日本語 | Hiragana, Katakana |
| `ko` | 한국어 | Hangul |
| `th` | ภาษาไทย | Thai script |
| `ar` | العربية | Arabic script |
| `ru` | Русский | Cyrillic |
| `fr` | Français | Accents: é, è, ê... |
| `de` | Deutsch | Umlauts: ä, ö, ü, ß |
| `es` | Español | ñ, ¿, ¡... |
| `pt` | Português | ã, õ, ç... |
| `it` | Italiano | Accents |

---

## 📂 Cấu trúc Output

### TXT Format (mặc định)

```
extracted_texts/
└── vi/                    # Language code
    ├── INDEX.txt          # Summary file
    ├── BanHang.txt        # Module 1
    ├── SanPham.txt        # Module 2
    ├── components.txt     # Module 3
    └── ...
```

Mỗi file TXT:
```txt
# BANHANG - UI Texts
# Language: vi
# Total: 155 texts
# Generated: 2025-10-02 14:30:00
# Each line is a separate text field

Bán hàng
Thêm món
Thanh toán
...
```

### JSON Format

```json
{
  "metadata": {
    "language": "vi",
    "total_modules": 20,
    "total_texts": 663,
    "generated_at": "2025-10-02T14:30:00"
  },
  "modules": {
    "BanHang": ["Bán hàng", "Thêm món", "Thanh toán", ...],
    "SanPham": ["Sản phẩm", "Thêm mới", "Chỉnh sửa", ...],
    ...
  }
}
```

### CSV Format

```csv
Module,Text,Language,Length
BanHang,Bán hàng,vi,8
BanHang,Thêm món,vi,8
SanPham,Sản phẩm,vi,8
...
```

---

## 🔧 Tùy chỉnh nâng cao

### Thêm loại project mới

Chỉnh sửa `Config.PROJECT_TYPES`:

```python
PROJECT_TYPES = {
    'my_framework': {
        'files': ['*.myext', '*.js'],
        'indicators': ['my_config.json', 'my_folder'],
        'framework': 'My Framework'
    }
}
```

### Thêm pattern trích xuất mới

Chỉnh sửa `Config.PATTERNS`:

```python
PATTERNS = {
    'my_pattern': r'myFunction\(["\']([^"\']+)["\']\)',
}
```

### Thêm thư mục cần skip

```python
SKIP_FOLDERS = {
    'node_modules', 'dist', 'my_special_folder'
}
```

### Thêm từ khóa loại trừ

```python
EXCLUDE_KEYWORDS = [
    'console.log', 'import', 'my_keyword'
]
```

---

## 🎨 Ví dụ thực tế

### Ví dụ 1: Quét React App

```bash
python universal_text_extractor.py ~/projects/my-react-app \
    --language vi \
    --format txt json \
    --output ./translations \
    --verbose
```

**Output:**
```
============================================================
   UNIVERSAL TEXT EXTRACTOR v2.0.0
============================================================
📁 Project: ~/projects/my-react-app
📂 Output: ./translations
🌍 Language: vi
📝 Format: txt, json
============================================================

🔍 Detected project type: React (react)
📁 Source directories: ['src']

============================================================
🚀 STARTING PROJECT SCAN
============================================================

📂 Scanning directory: src

📄 Scanned: components/Header.jsx - Found 12 texts
📄 Scanned: pages/Home.jsx - Found 45 texts
📄 Scanned: pages/Products.jsx - Found 67 texts
...

✅ Scanned 48 files in src

============================================================
💾 EXPORTING RESULTS
============================================================

💾 Saved 155 texts to BanHang.txt
💾 Saved 67 texts to SanPham.txt
💾 Saved 45 texts to TrangChu.txt
...
💾 Saved JSON to vi_texts.json
📋 Saved index to INDEX.txt

============================================================
✅ EXTRACTION COMPLETE
============================================================
📊 Total modules: 15
📝 Total texts: 663
📁 Output directory: ./translations/vi
============================================================
```

### Ví dụ 2: Quét Flutter App

```bash
python universal_text_extractor.py ~/projects/my-flutter-app \
    --language en \
    --format all \
    --min-length 3 \
    --max-length 100
```

**Auto-detect Flutter:**
- ✅ Tìm thấy `pubspec.yaml`
- ✅ Tìm thấy thư mục `lib/`
- ✅ Quét file `*.dart`
- ✅ Trích xuất từ `Text()` widgets

### Ví dụ 3: Quét Android App

```bash
python universal_text_extractor.py ~/projects/MyAndroidApp \
    --language auto \
    --output ./android_strings
```

**Auto-detect Android:**
- ✅ Tìm thấy `AndroidManifest.xml`
- ✅ Quét file `*.java`, `*.kt`, `*.xml`
- ✅ Trích xuất từ `android:text`, `android:hint`

### Ví dụ 4: Multi-language Project

```bash
# Lần 1: Quét tiếng Việt
python universal_text_extractor.py ~/projects/my-app --language vi --output ./i18n

# Lần 2: Quét tiếng Anh
python universal_text_extractor.py ~/projects/my-app --language en --output ./i18n

# Lần 3: Quét tiếng Trung
python universal_text_extractor.py ~/projects/my-app --language zh --output ./i18n
```

**Kết quả:**
```
i18n/
├── vi/
│   ├── INDEX.txt
│   ├── module1.txt
│   └── module2.txt
├── en/
│   ├── INDEX.txt
│   ├── module1.txt
│   └── module2.txt
└── zh/
    ├── INDEX.txt
    ├── module1.txt
    └── module2.txt
```

---

## 🧪 Testing

### Test với project mẫu

```bash
# Tạo project test
mkdir test_project
cd test_project

# Tạo file mẫu
echo '<div>Hello World</div>' > index.html
echo 'const msg = "Welcome";' > app.js

# Chạy extractor
python universal_text_extractor.py . --verbose
```

### Test với các loại file

```bash
# Test React
echo 'export default () => <div>Test Text</div>' > Test.jsx
python universal_text_extractor.py . --format txt

# Test Vue
echo '<template><div>{{ message }}</div></template>' > Test.vue
python universal_text_extractor.py . --format txt

# Test Flutter
echo 'Text("Flutter Text")' > test.dart
python universal_text_extractor.py . --format txt
```

---

## 📊 Performance

### Benchmarks

| Project Size | Files | Texts | Time | Memory |
|-------------|-------|-------|------|--------|
| Small (< 50 files) | 48 | 663 | ~5s | < 50MB |
| Medium (50-200 files) | 150 | 2,500 | ~20s | < 100MB |
| Large (200-1000 files) | 800 | 10,000 | ~90s | < 200MB |
| Very Large (> 1000 files) | 2,500 | 35,000 | ~5min | < 500MB |

### Tối ưu hóa

```bash
# Giảm thời gian bằng cách giới hạn độ dài
python universal_text_extractor.py /path/to/project \
    --min-length 3 \
    --max-length 200

# Chỉ xuất TXT (nhanh hơn JSON/CSV)
python universal_text_extractor.py /path/to/project --format txt
```

---

## 🐛 Troubleshooting

### Lỗi 1: UnicodeDecodeError

**Nguyên nhân:** File có encoding đặc biệt

**Giải pháp:** Script tự động thử nhiều encoding (utf-8, utf-16, latin-1...)

### Lỗi 2: Không tìm thấy text

**Nguyên nhân:** Pattern không phù hợp với code

**Giải pháp:** Thêm custom pattern trong Config.PATTERNS

```python
PATTERNS = {
    'my_custom': r'yourFunction\(["\']([^"\']+)["\']\)'
}
```

### Lỗi 3: Quá nhiều noise (text không cần thiết)

**Giải pháp 1:** Tăng min-length
```bash
python universal_text_extractor.py /path --min-length 5
```

**Giải pháp 2:** Thêm exclude keywords
```python
EXCLUDE_KEYWORDS = [
    'console.log', 'import', 'your_noise_keyword'
]
```

### Lỗi 4: Script chạy quá lâu

**Giải pháp:** Thêm thư mục vào SKIP_FOLDERS
```python
SKIP_FOLDERS = {
    'node_modules', 'dist', 'your_large_folder'
}
```

---

## 🔍 So sánh với các công cụ khác

| Feature | Universal Extractor | i18next-scanner | react-intl-extractor |
|---------|-------------------|-----------------|---------------------|
| Multi-framework | ✅ | ❌ (React only) | ❌ (React only) |
| Auto-detect project | ✅ | ❌ | ❌ |
| Multi-language | ✅ | Partial | Partial |
| Multiple formats | ✅ TXT/JSON/CSV | ❌ JSON only | ❌ JSON only |
| Zero dependencies | ✅ | ❌ npm | ❌ npm |
| Offline | ✅ | ✅ | ✅ |
| Easy to customize | ✅ Single file | ❌ Complex | ❌ Complex |

---

## 🤝 Contributing

### Thêm hỗ trợ framework mới

1. Fork repo
2. Thêm config trong `PROJECT_TYPES`
3. Thêm patterns trong `PATTERNS`
4. Test với project mẫu
5. Submit PR

### Thêm hỗ trợ ngôn ngữ mới

1. Thêm entry trong `Config.LANGUAGES`
2. Thêm regex pattern phát hiện
3. Test với text mẫu

---

## 📜 License

MIT License - Free to use, modify and distribute

---

## 🙏 Credits

Developed by **PMBH Development Team**

Inspired by:
- i18next-scanner
- react-intl
- gettext

---

## 📞 Support

- 📧 Email: support@pmbh.dev
- 🐛 Issues: [GitHub Issues](https://github.com/yourrepo/issues)
- 📖 Docs: [Full Documentation](https://docs.pmbh.dev)

---

## 🗺️ Roadmap

### v2.1.0 (Coming Soon)
- [ ] GUI interface (Electron app)
- [ ] Real-time preview
- [ ] Translation suggestions (via API)
- [ ] Diff mode (compare versions)

### v2.2.0
- [ ] Plugin system
- [ ] Cloud integration
- [ ] Team collaboration
- [ ] Version control integration

### v3.0.0
- [ ] AI-powered text detection
- [ ] Auto-translation
- [ ] Context-aware extraction
- [ ] Visual editor

---

## 💡 Tips & Tricks

### Tip 1: Quét nhanh project lớn

```bash
# Chỉ quét thư mục src (bỏ qua thư mục khác)
cd your_project/src
python universal_text_extractor.py . --output ../translations
```

### Tip 2: Tạo workflow tự động

```bash
#!/bin/bash
# auto_extract.sh

python universal_text_extractor.py . --format all
git add extracted_texts/
git commit -m "Update translations [auto]"
git push
```

### Tip 3: Integration với CI/CD

```yaml
# .github/workflows/extract-texts.yml
name: Extract UI Texts

on: [push]

jobs:
  extract:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Run extractor
        run: python universal_text_extractor.py . --output ./i18n
      - name: Upload artifacts
        uses: actions/upload-artifact@v2
        with:
          name: translations
          path: i18n/
```

### Tip 4: Tạo translation checklist

```bash
# Extract texts
python universal_text_extractor.py . --format csv --output ./check

# Import CSV vào Google Sheets
# Share với translators
# Track progress
```

---

## 📚 References

- [Regex101](https://regex101.com/) - Test regex patterns
- [Unicode Character Database](https://unicode.org/) - Language detection
- [i18n Best Practices](https://www.i18next.com/) - Internationalization guide

---

**🎉 Happy Extracting! 🎉**

---

_Last updated: October 2, 2025_
