"""
Script tự động quét và trích xuất text từ source code React
Tạo file ngôn ngữ cho hệ thống đa ngôn ngữ
"""

import os
import re
import json
from pathlib import Path
from collections import defaultdict

# Đường dẫn gốc của project
PROJECT_ROOT = r"c:\Users\Chung\Desktop\BanHangDesktop\PMBH_Desktop_App\src"
OUTPUT_DIR = r"c:\Users\Chung\Desktop\BanHangDesktop\PMBH_Desktop_App\src\Languages\VN"

# Các pattern để tìm text trong JSX
PATTERNS = [
    # Text trong JSX tags
    r'>\s*([^<>{}\n]+)\s*<',
    # placeholder attribute
    r'placeholder=["\'](.*?)["\']',
    # title attribute  
    r'title=["\'](.*?)["\']',
    # label trong Form.Item
    r'label=["\'](.*?)["\']',
    # message.success/error/warning/info
    r'message\.(success|error|warning|info)\(["\'](.+?)["\']',
    # Modal title
    r'Modal.*?title=["\'](.*?)["\']',
    # Button text
    r'<Button[^>]*>\s*([^<>{}\n]+)\s*</Button>',
    # Typography Text
    r'<Text[^>]*>([^<>]+)</Text>',
    # span text
    r'<span[^>]*>([^<>]+)</span>',
    # Breadcrumb title
    r'title:\s*["\']([^"\']+)["\']',
]

# Các từ khóa để loại trừ (không phải UI text)
EXCLUDE_KEYWORDS = [
    'console.log',
    'console.error',
    'console.warn',
    'import',
    'export',
    'const',
    'let',
    'var',
    'function',
    'return',
    'className',
    'style',
    '//',
    '/*',
    'onClick',
    'onChange',
    'onSubmit'
]

# Các trang cần bỏ qua (chưa hoàn thiện)
SKIP_PAGES = [
    'BcTong.jsx',  # Chưa hoàn thiện
]

def should_skip_text(text):
    """Kiểm tra xem text có nên bỏ qua không"""
    if not text or len(text.strip()) < 2:
        return True
    
    # Bỏ qua các text chứa code
    for keyword in EXCLUDE_KEYWORDS:
        if keyword in text:
            return True
    
    # Bỏ qua text chỉ chứa số hoặc ký tự đặc biệt
    if re.match(r'^[\d\s\-_.,;:!?(){}[\]<>/\\|@#$%^&*+=~`]+$', text):
        return True
    
    # Bỏ qua các biến/props
    if re.match(r'^[a-zA-Z_$][a-zA-Z0-9_$]*$', text) and text[0].islower():
        return True
        
    return False

def extract_texts_from_file(filepath):
    """Trích xuất text từ một file"""
    texts = set()
    
    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            
            # Skip if file contains "cần gói premium"
            if 'cần gói premium' in content.lower() or 'sẽ sớm được hoàn thiện' in content:
                return texts
            
            for pattern in PATTERNS:
                matches = re.finditer(pattern, content, re.MULTILINE | re.DOTALL)
                for match in matches:
                    # Lấy group cuối cùng (thường là text)
                    text = match.group(match.lastindex if match.lastindex else 0)
                    text = text.strip()
                    
                    if not should_skip_text(text):
                        # Làm sạch text
                        text = re.sub(r'\s+', ' ', text)  # Normalize whitespace
                        text = text.replace('{', '').replace('}', '')  # Remove JSX brackets
                        
                        if len(text) > 1 and text not in texts:
                            texts.add(text)
    
    except Exception as e:
        print(f"Error reading {filepath}: {e}")
    
    return texts

def scan_directory(directory):
    """Quét toàn bộ thư mục và phân loại text theo module"""
    module_texts = defaultdict(set)
    
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.endswith('.jsx') or file.endswith('.js'):
                # Skip các file cần bỏ qua
                if file in SKIP_PAGES:
                    continue
                    
                filepath = os.path.join(root, file)
                relative_path = os.path.relpath(filepath, PROJECT_ROOT)
                
                # Xác định module dựa trên đường dẫn
                path_parts = relative_path.split(os.sep)
                
                if 'pages' in path_parts:
                    idx = path_parts.index('pages')
                    if idx + 1 < len(path_parts):
                        module_name = path_parts[idx + 1]
                    else:
                        module_name = 'pages'
                elif 'components' in path_parts:
                    idx = path_parts.index('components')
                    if idx + 1 < len(path_parts):
                        module_name = f"components_{path_parts[idx + 1]}"
                    else:
                        module_name = 'components'
                elif 'auth' in path_parts:
                    module_name = 'auth'
                else:
                    module_name = 'other'
                
                texts = extract_texts_from_file(filepath)
                module_texts[module_name].update(texts)
                
                print(f"Scanned: {relative_path} - Found {len(texts)} texts")
    
    return module_texts

def save_texts_to_files(module_texts):
    """Lưu text vào các file theo module"""
    os.makedirs(OUTPUT_DIR, exist_ok=True)
    
    for module, texts in module_texts.items():
        if not texts:
            continue
            
        filename = os.path.join(OUTPUT_DIR, f"{module}.txt")
        sorted_texts = sorted(list(texts))
        
        with open(filename, 'w', encoding='utf-8') as f:
            f.write(f"# {module.upper()} - Các text UI trong module {module}\n")
            f.write(f"# Tổng số: {len(sorted_texts)} text\n")
            f.write("# Mỗi dòng là một text field riêng biệt\n\n")
            
            for text in sorted_texts:
                f.write(f"{text}\n")
        
        print(f"Saved {len(sorted_texts)} texts to {filename}")

def create_index_file(module_texts):
    """Tạo file index tổng hợp"""
    index_file = os.path.join(OUTPUT_DIR, "index.txt")
    
    with open(index_file, 'w', encoding='utf-8') as f:
        f.write("# INDEX - Danh sách các file ngôn ngữ\n")
        f.write(f"# Tổng số module: {len(module_texts)}\n")
        f.write(f"# Ngày tạo: {Path(__file__).stat().st_mtime}\n\n")
        
        total_texts = sum(len(texts) for texts in module_texts.values())
        f.write(f"# Tổng số text: {total_texts}\n\n")
        
        for module, texts in sorted(module_texts.items()):
            f.write(f"{module}.txt - {len(texts)} texts\n")
    
    print(f"\nCreated index file: {index_file}")
    print(f"Total modules: {len(module_texts)}")
    print(f"Total texts: {total_texts}")

def main():
    """Main function"""
    print("="*60)
    print("QUÉT VÀ TRÍCH XUẤT TEXT TỪ SOURCE CODE")
    print("="*60)
    print(f"Project root: {PROJECT_ROOT}")
    print(f"Output dir: {OUTPUT_DIR}")
    print("="*60)
    
    # Quét toàn bộ project
    module_texts = scan_directory(PROJECT_ROOT)
    
    # Lưu vào các file
    save_texts_to_files(module_texts)
    
    # Tạo file index
    create_index_file(module_texts)
    
    print("\n" + "="*60)
    print("HOÀN TH THÀNH!")
    print("="*60)

if __name__ == "__main__":
    main()
