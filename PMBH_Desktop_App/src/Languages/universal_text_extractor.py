"""
Universal Text Extractor for Multi-language Projects
=====================================================

Một script Python tổng quát để tự động quét, phát hiện và trích xuất 
UI text từ bất kỳ project nào (React, Vue, Angular, Flutter, Android, iOS...)

Tính năng:
- Tự động phát hiện loại project (React, Vue, Angular, Flutter, etc.)
- Tự động phát hiện ngôn ngữ lập trình
- Quét cây thư mục thông minh
- Trích xuất text từ nhiều loại file
- Phân loại text theo module
- Loại bỏ text trùng lặp
- Hỗ trợ nhiều pattern phức tạp
- Export ra nhiều format (txt, json, csv, xlsx)
- Multilingual support

Author: PMBH Development Team
Version: 2.0.0
License: MIT
Date: October 2, 2025
"""

import os
import re
import json
import csv
import argparse
from pathlib import Path
from collections import defaultdict
from datetime import datetime
import mimetypes

# ============================================
# CONFIGURATION SECTION
# ============================================

class Config:
    """Configuration class for the text extractor"""
    
    # Supported project types
    PROJECT_TYPES = {
        'react': {
            'files': ['*.jsx', '*.js', '*.tsx', '*.ts'],
            'indicators': ['package.json', 'node_modules', 'src'],
            'framework': 'React'
        },
        'vue': {
            'files': ['*.vue', '*.js', '*.ts'],
            'indicators': ['package.json', 'node_modules', 'src'],
            'framework': 'Vue.js'
        },
        'angular': {
            'files': ['*.component.ts', '*.component.html', '*.ts'],
            'indicators': ['angular.json', 'node_modules'],
            'framework': 'Angular'
        },
        'flutter': {
            'files': ['*.dart'],
            'indicators': ['pubspec.yaml', 'lib'],
            'framework': 'Flutter'
        },
        'android': {
            'files': ['*.java', '*.kt', '*.xml'],
            'indicators': ['AndroidManifest.xml', 'build.gradle'],
            'framework': 'Android'
        },
        'ios': {
            'files': ['*.swift', '*.m', '*.storyboard', '*.xib'],
            'indicators': ['Info.plist', '*.xcodeproj'],
            'framework': 'iOS'
        },
        'django': {
            'files': ['*.py', '*.html'],
            'indicators': ['manage.py', 'settings.py'],
            'framework': 'Django'
        },
        'laravel': {
            'files': ['*.php', '*.blade.php'],
            'indicators': ['composer.json', 'artisan'],
            'framework': 'Laravel'
        },
        'generic': {
            'files': ['*.html', '*.js', '*.py', '*.java', '*.php'],
            'indicators': [],
            'framework': 'Generic'
        }
    }
    
    # Text extraction patterns for different contexts
    PATTERNS = {
        # JavaScript/TypeScript/JSX/TSX
        'jsx_text': r'>\s*([^<>{}\n]+)\s*<',
        'jsx_string': r'["\']([^"\'\\]*(?:\\.[^"\'\\]*)*)["\']',
        'placeholder': r'placeholder\s*=\s*["\']([^"\']+)["\']',
        'title': r'title\s*=\s*["\']([^"\']+)["\']',
        'label': r'label\s*=\s*["\']([^"\']+)["\']',
        'alt': r'alt\s*=\s*["\']([^"\']+)["\']',
        'aria_label': r'aria-label\s*=\s*["\']([^"\']+)["\']',
        
        # Messages/Toasts
        'toast': r'(?:toast|message|notification)\.(success|error|warning|info)\s*\(["\']([^"\']+)["\']',
        'alert': r'alert\s*\(["\']([^"\']+)["\']',
        
        # Vue.js specific
        'vue_text': r'>\s*\{\{\s*([^}]+)\s*\}\}\s*<',
        'vue_directive': r'v-(?:text|html|placeholder)\s*=\s*["\']([^"\']+)["\']',
        
        # Angular specific
        'angular_text': r'\{\{\s*([^}]+)\s*\}\}',
        'angular_attr': r'\[(?:placeholder|title|alt)\]\s*=\s*["\']([^"\']+)["\']',
        
        # Flutter/Dart
        'dart_text': r'Text\s*\(\s*["\']([^"\']+)["\']',
        'dart_string': r'["\']([^"\'\\]*(?:\\.[^"\'\\]*)*)["\']',
        
        # Android XML
        'android_string': r'android:text\s*=\s*["\']([^"\']+)["\']',
        'android_hint': r'android:hint\s*=\s*["\']([^"\']+)["\']',
        
        # iOS (Swift/Objective-C)
        'ios_string': r'NSLocalizedString\s*\(\s*@?"([^"]+)"',
        'swift_string': r'["\']([^"\'\\]*(?:\\.[^"\'\\]*)*)["\']',
        
        # Python
        'python_string': r'["\']([^"\'\\]*(?:\\.[^"\'\\]*)*)["\']',
        'gettext': r'_\(["\']([^"\']+)["\']\)',
        
        # PHP/Blade
        'php_string': r'["\']([^"\'\\]*(?:\\.[^"\'\\]*)*)["\']',
        'blade_trans': r'@lang\(["\']([^"\']+)["\']\)',
        
        # HTML
        'html_text': r'>([^<>]+)<',
        'html_placeholder': r'placeholder\s*=\s*["\']([^"\']+)["\']',
    }
    
    # Folders to skip (common build/dependency folders)
    SKIP_FOLDERS = {
        'node_modules', 'dist', 'build', '.git', '.svn', '.hg',
        'vendor', '__pycache__', '.pytest_cache', '.mypy_cache',
        'coverage', '.next', 'out', '.nuxt', 'venv', 'env',
        'Pods', 'DerivedData', '.gradle', '.idea', '.vscode'
    }
    
    # Files to skip
    SKIP_FILES = {
        'package-lock.json', 'yarn.lock', 'composer.lock',
        '.DS_Store', 'Thumbs.db', '*.min.js', '*.map'
    }
    
    # Keywords to exclude (not UI text)
    EXCLUDE_KEYWORDS = [
        'console.log', 'console.error', 'console.warn', 'console.debug',
        'import', 'export', 'const', 'let', 'var', 'function', 'return',
        'className', 'style', 'onClick', 'onChange', 'onSubmit', 'href',
        '//', '/*', '*/', 'TODO', 'FIXME', 'NOTE', 'HACK',
        'require', 'module.exports', 'use strict', 'eslint', 'prettier'
    ]
    
    # Minimum text length
    MIN_TEXT_LENGTH = 2
    
    # Maximum text length (to avoid capturing large code blocks)
    MAX_TEXT_LENGTH = 500
    
    # Languages to detect
    LANGUAGES = {
        'vi': ['Tiếng Việt', 'Vietnamese', r'[àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]'],
        'en': ['English', 'Anh', r'[a-zA-Z]'],
        'zh': ['中文', 'Chinese', r'[\u4e00-\u9fff]'],
        'ja': ['日本語', 'Japanese', r'[\u3040-\u309f\u30a0-\u30ff]'],
        'ko': ['한국어', 'Korean', r'[\uac00-\ud7af]'],
        'th': ['ภาษาไทย', 'Thai', r'[\u0e00-\u0e7f]'],
        'ar': ['العربية', 'Arabic', r'[\u0600-\u06ff]'],
        'ru': ['Русский', 'Russian', r'[а-яА-ЯёЁ]'],
        'fr': ['Français', 'French', r'[àâäéèêëïîôùûüÿæœçÀÂÄÉÈÊËÏÎÔÙÛÜŸÆŒÇ]'],
        'de': ['Deutsch', 'German', r'[äöüßÄÖÜ]'],
        'es': ['Español', 'Spanish', r'[áéíóúñüÁÉÍÓÚÑÜ¿¡]'],
        'pt': ['Português', 'Portuguese', r'[áàâãéêíóôõúüçÁÀÂÃÉÊÍÓÔÕÚÜÇ]'],
        'it': ['Italiano', 'Italian', r'[àèéìíîòóùúÀÈÉÌÍÎÒÓÙÚ]'],
    }

# ============================================
# UTILITY FUNCTIONS
# ============================================

class TextCleaner:
    """Utility class for cleaning and validating text"""
    
    @staticmethod
    def clean_text(text):
        """Clean and normalize text"""
        if not text:
            return ""
        
        # Remove extra whitespace
        text = re.sub(r'\s+', ' ', text).strip()
        
        # Remove JSX/template syntax
        text = re.sub(r'[{}]', '', text)
        
        # Remove HTML entities
        text = text.replace('&nbsp;', ' ')
        text = text.replace('&amp;', '&')
        text = text.replace('&lt;', '<')
        text = text.replace('&gt;', '>')
        text = text.replace('&quot;', '"')
        
        return text
    
    @staticmethod
    def is_valid_text(text, config=Config):
        """Check if text is valid UI text"""
        if not text:
            return False
        
        # Check length
        if len(text) < config.MIN_TEXT_LENGTH or len(text) > config.MAX_TEXT_LENGTH:
            return False
        
        # Check for excluded keywords
        for keyword in config.EXCLUDE_KEYWORDS:
            if keyword in text:
                return False
        
        # Exclude if text looks like code
        code_patterns = [
            r'^[a-zA-Z_$][a-zA-Z0-9_$]*$',  # Variable names
            r'^\d+$',  # Pure numbers
            r'^[\d\s\-_.,;:!?(){}[\]<>/\\|@#$%^&*+=~`]+$',  # Special chars only
            r'^https?://',  # URLs (but keep them for now)
            r'^[./]+',  # Path separators
        ]
        
        for pattern in code_patterns[:5]:  # Skip URL check
            if re.match(pattern, text):
                return False
        
        return True
    
    @staticmethod
    def detect_language(text, config=Config):
        """Detect the language of text"""
        detected = []
        
        for lang_code, (name, _, pattern) in config.LANGUAGES.items():
            if re.search(pattern, text):
                detected.append(lang_code)
        
        # Return primary language (most specific)
        if not detected:
            return 'unknown'
        
        # Prioritize non-Latin scripts
        priority = ['zh', 'ja', 'ko', 'th', 'ar', 'ru']
        for lang in priority:
            if lang in detected:
                return lang
        
        return detected[0] if detected else 'en'

# ============================================
# PROJECT DETECTOR
# ============================================

class ProjectDetector:
    """Detect project type and structure"""
    
    @staticmethod
    def detect_project_type(root_path):
        """Detect the type of project"""
        root_path = Path(root_path)
        
        for proj_type, config in Config.PROJECT_TYPES.items():
            if proj_type == 'generic':
                continue
            
            # Check for indicator files/folders
            matches = 0
            for indicator in config['indicators']:
                if '*' in indicator:
                    # Glob pattern
                    if list(root_path.glob(indicator)):
                        matches += 1
                else:
                    # Direct file/folder
                    if (root_path / indicator).exists():
                        matches += 1
            
            # If majority of indicators exist, it's this type
            if matches >= len(config['indicators']) * 0.5:
                return proj_type, config['framework']
        
        return 'generic', 'Generic'
    
    @staticmethod
    def find_source_directories(root_path, project_type):
        """Find source code directories"""
        root_path = Path(root_path)
        source_dirs = []
        
        # Common source directory names
        common_sources = ['src', 'source', 'app', 'lib', 'components', 'views', 'pages']
        
        for dir_name in common_sources:
            dir_path = root_path / dir_name
            if dir_path.exists() and dir_path.is_dir():
                source_dirs.append(dir_path)
        
        # If no common source dirs found, use root
        if not source_dirs:
            source_dirs = [root_path]
        
        return source_dirs
    
    @staticmethod
    def should_skip_path(path, config=Config):
        """Check if path should be skipped"""
        path = Path(path)
        
        # Check folder names
        for part in path.parts:
            if part in config.SKIP_FOLDERS:
                return True
            if part.startswith('.') and part not in ['.', '..']:
                return True
        
        # Check file names
        if path.is_file():
            if path.name in config.SKIP_FILES:
                return True
            for pattern in config.SKIP_FILES:
                if '*' in pattern and path.match(pattern):
                    return True
        
        return False

# ============================================
# TEXT EXTRACTOR ENGINE
# ============================================

class TextExtractor:
    """Main text extraction engine"""
    
    def __init__(self, root_path, config=Config):
        self.root_path = Path(root_path)
        self.config = config
        self.project_type, self.framework = ProjectDetector.detect_project_type(root_path)
        self.source_dirs = ProjectDetector.find_source_directories(root_path, self.project_type)
        self.cleaner = TextCleaner()
        
        print(f"🔍 Detected project type: {self.framework} ({self.project_type})")
        print(f"📁 Source directories: {[str(d.relative_to(self.root_path)) for d in self.source_dirs]}")
    
    def extract_from_file(self, filepath):
        """Extract text from a single file"""
        texts = set()
        
        try:
            # Determine file type
            ext = filepath.suffix.lower()
            
            # Read file with multiple encoding attempts
            content = self._read_file_safe(filepath)
            if not content:
                return texts
            
            # Select appropriate patterns based on file type
            patterns = self._get_patterns_for_file(ext)
            
            # Extract texts using patterns
            for pattern_name, pattern in patterns.items():
                try:
                    matches = re.finditer(pattern, content, re.MULTILINE | re.DOTALL)
                    for match in matches:
                        # Get the last group (usually the text content)
                        text = match.group(match.lastindex) if match.lastindex else match.group(0)
                        text = self.cleaner.clean_text(text)
                        
                        if self.cleaner.is_valid_text(text, self.config):
                            texts.add(text)
                except Exception as e:
                    # Skip pattern if it causes errors
                    continue
        
        except Exception as e:
            print(f"❌ Error processing {filepath}: {e}")
        
        return texts
    
    def _read_file_safe(self, filepath):
        """Read file with multiple encoding attempts"""
        encodings = ['utf-8', 'utf-16', 'latin-1', 'cp1252', 'iso-8859-1']
        
        for encoding in encodings:
            try:
                with open(filepath, 'r', encoding=encoding) as f:
                    return f.read()
            except (UnicodeDecodeError, UnicodeError):
                continue
            except Exception:
                return None
        
        return None
    
    def _get_patterns_for_file(self, ext):
        """Get appropriate patterns for file extension"""
        patterns = {}
        
        # JavaScript/TypeScript/JSX/TSX
        if ext in ['.js', '.jsx', '.ts', '.tsx']:
            patterns.update({
                'jsx_text': self.config.PATTERNS['jsx_text'],
                'placeholder': self.config.PATTERNS['placeholder'],
                'title': self.config.PATTERNS['title'],
                'label': self.config.PATTERNS['label'],
                'toast': self.config.PATTERNS['toast'],
                'jsx_string': self.config.PATTERNS['jsx_string'],
            })
        
        # Vue
        elif ext == '.vue':
            patterns.update({
                'jsx_text': self.config.PATTERNS['jsx_text'],
                'vue_text': self.config.PATTERNS['vue_text'],
                'placeholder': self.config.PATTERNS['placeholder'],
            })
        
        # HTML
        elif ext in ['.html', '.htm']:
            patterns.update({
                'html_text': self.config.PATTERNS['html_text'],
                'placeholder': self.config.PATTERNS['html_placeholder'],
                'title': self.config.PATTERNS['title'],
            })
        
        # Dart (Flutter)
        elif ext == '.dart':
            patterns.update({
                'dart_text': self.config.PATTERNS['dart_text'],
                'dart_string': self.config.PATTERNS['dart_string'],
            })
        
        # XML (Android)
        elif ext == '.xml':
            patterns.update({
                'android_string': self.config.PATTERNS['android_string'],
                'android_hint': self.config.PATTERNS['android_hint'],
            })
        
        # Swift/Objective-C (iOS)
        elif ext in ['.swift', '.m']:
            patterns.update({
                'ios_string': self.config.PATTERNS['ios_string'],
                'swift_string': self.config.PATTERNS['swift_string'],
            })
        
        # Python
        elif ext == '.py':
            patterns.update({
                'python_string': self.config.PATTERNS['python_string'],
                'gettext': self.config.PATTERNS['gettext'],
            })
        
        # PHP/Blade
        elif ext in ['.php', '.blade.php']:
            patterns.update({
                'php_string': self.config.PATTERNS['php_string'],
                'blade_trans': self.config.PATTERNS['blade_trans'],
            })
        
        # Default: use generic patterns
        else:
            patterns.update({
                'jsx_text': self.config.PATTERNS['jsx_text'],
                'jsx_string': self.config.PATTERNS['jsx_string'],
            })
        
        return patterns
    
    def scan_directory(self, directory, file_patterns=None):
        """Recursively scan directory for text"""
        module_texts = defaultdict(set)
        file_count = 0
        
        directory = Path(directory)
        
        # Get file patterns for this project type
        if file_patterns is None:
            proj_config = self.config.PROJECT_TYPES.get(self.project_type, self.config.PROJECT_TYPES['generic'])
            file_patterns = proj_config['files']
        
        # Walk through directory
        for root, dirs, files in os.walk(directory):
            root_path = Path(root)
            
            # Skip certain directories
            dirs[:] = [d for d in dirs if not ProjectDetector.should_skip_path(root_path / d)]
            
            for file in files:
                filepath = root_path / file
                
                # Check if file matches patterns
                matches_pattern = False
                for pattern in file_patterns:
                    if filepath.match(pattern):
                        matches_pattern = True
                        break
                
                if not matches_pattern:
                    continue
                
                # Skip if should skip
                if ProjectDetector.should_skip_path(filepath):
                    continue
                
                # Extract texts from file
                texts = self.extract_from_file(filepath)
                
                if texts:
                    # Determine module name from path
                    relative_path = filepath.relative_to(directory)
                    module_name = self._get_module_name(relative_path)
                    
                    module_texts[module_name].update(texts)
                    file_count += 1
                    
                    print(f"📄 Scanned: {relative_path} - Found {len(texts)} texts")
        
        print(f"\n✅ Scanned {file_count} files in {directory.name}")
        return dict(module_texts)
    
    def _get_module_name(self, relative_path):
        """Get module name from relative path"""
        parts = relative_path.parts
        
        # Try to get meaningful module name
        if len(parts) >= 2:
            # Use parent directory name
            return parts[-2]
        elif len(parts) == 1:
            # Use filename without extension
            return relative_path.stem
        else:
            return 'root'
    
    def scan_project(self):
        """Scan entire project"""
        all_texts = defaultdict(set)
        
        print("\n" + "="*60)
        print("🚀 STARTING PROJECT SCAN")
        print("="*60)
        
        for source_dir in self.source_dirs:
            print(f"\n📂 Scanning directory: {source_dir.relative_to(self.root_path)}")
            module_texts = self.scan_directory(source_dir)
            
            # Merge results
            for module, texts in module_texts.items():
                all_texts[module].update(texts)
        
        return dict(all_texts)

# ============================================
# EXPORTERS
# ============================================

class TextExporter:
    """Export extracted texts to various formats"""
    
    @staticmethod
    def export_to_txt(module_texts, output_dir, language='unknown'):
        """Export to TXT files (one per module)"""
        output_dir = Path(output_dir)
        output_dir.mkdir(parents=True, exist_ok=True)
        
        for module, texts in module_texts.items():
            if not texts:
                continue
            
            filename = output_dir / f"{module}.txt"
            sorted_texts = sorted(list(texts))
            
            with open(filename, 'w', encoding='utf-8') as f:
                f.write(f"# {module.upper()} - UI Texts\n")
                f.write(f"# Language: {language}\n")
                f.write(f"# Total: {len(sorted_texts)} texts\n")
                f.write(f"# Generated: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")
                f.write("# Each line is a separate text field\n\n")
                
                for text in sorted_texts:
                    f.write(f"{text}\n")
            
            print(f"💾 Saved {len(sorted_texts)} texts to {filename.name}")
    
    @staticmethod
    def export_to_json(module_texts, output_file, language='unknown'):
        """Export to single JSON file"""
        output_file = Path(output_file)
        output_file.parent.mkdir(parents=True, exist_ok=True)
        
        # Convert sets to lists for JSON serialization
        data = {
            'metadata': {
                'language': language,
                'total_modules': len(module_texts),
                'total_texts': sum(len(texts) for texts in module_texts.values()),
                'generated_at': datetime.now().isoformat()
            },
            'modules': {
                module: sorted(list(texts))
                for module, texts in module_texts.items()
            }
        }
        
        with open(output_file, 'w', encoding='utf-8') as f:
            json.dump(data, f, ensure_ascii=False, indent=2)
        
        print(f"💾 Saved JSON to {output_file.name}")
    
    @staticmethod
    def export_to_csv(module_texts, output_file, language='unknown'):
        """Export to CSV file"""
        output_file = Path(output_file)
        output_file.parent.mkdir(parents=True, exist_ok=True)
        
        with open(output_file, 'w', encoding='utf-8', newline='') as f:
            writer = csv.writer(f)
            writer.writerow(['Module', 'Text', 'Language', 'Length'])
            
            for module, texts in sorted(module_texts.items()):
                for text in sorted(texts):
                    lang = TextCleaner.detect_language(text)
                    writer.writerow([module, text, lang, len(text)])
        
        print(f"💾 Saved CSV to {output_file.name}")
    
    @staticmethod
    def export_index(module_texts, output_file, language='unknown'):
        """Export index/summary file"""
        output_file = Path(output_file)
        
        total_texts = sum(len(texts) for texts in module_texts.values())
        
        with open(output_file, 'w', encoding='utf-8') as f:
            f.write("# INDEX - Extracted UI Texts Summary\n")
            f.write(f"# Language: {language}\n")
            f.write(f"# Generated: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")
            f.write(f"# Total Modules: {len(module_texts)}\n")
            f.write(f"# Total Texts: {total_texts}\n\n")
            
            f.write("=" * 60 + "\n")
            f.write("MODULES SUMMARY\n")
            f.write("=" * 60 + "\n\n")
            
            for module, texts in sorted(module_texts.items(), key=lambda x: len(x[1]), reverse=True):
                f.write(f"{module}.txt - {len(texts)} texts\n")
            
            f.write("\n" + "=" * 60 + "\n")
            f.write(f"TOTAL: {total_texts} texts from {len(module_texts)} modules\n")
            f.write("=" * 60 + "\n")
        
        print(f"📋 Saved index to {output_file.name}")

# ============================================
# INTERACTIVE MENU
# ============================================

class InteractiveMenu:
    """Interactive menu for easy usage"""
    
    @staticmethod
    def print_header():
        """Print welcome header"""
        print("\n" + "="*70)
        print("   🌍 UNIVERSAL TEXT EXTRACTOR v2.0.0 🌍")
        print("   Trích xuất UI Text tự động từ mọi loại project")
        print("="*70 + "\n")
    
    @staticmethod
    def get_project_path():
        """Get project path from user"""
        print("📁 BƯỚC 1: CHỌN PROJECT")
        print("-" * 70)
        print("Nhập đường dẫn đến project của bạn:")
        print("  - Có thể dùng đường dẫn tuyệt đối: C:\\Users\\...\\MyProject")
        print("  - Hoặc đường dẫn tương đối: . (thư mục hiện tại)")
        print("  - Hoặc: .. (thư mục cha)")
        print("  - Hoặc: ../../MyProject")
        print()
        
        while True:
            project_path = input("👉 Đường dẫn project: ").strip()
            
            # Remove quotes if user copied path with quotes
            project_path = project_path.strip('"').strip("'")
            
            if not project_path:
                print("❌ Vui lòng nhập đường dẫn!\n")
                continue
            
            # Convert to Path and check
            path = Path(project_path).resolve()
            
            if not path.exists():
                print(f"❌ Đường dẫn không tồn tại: {path}")
                retry = input("Nhập lại? (y/n): ").strip().lower()
                if retry != 'y':
                    return None
                continue
            
            if not path.is_dir():
                print(f"❌ Đây không phải là thư mục: {path}")
                retry = input("Nhập lại? (y/n): ").strip().lower()
                if retry != 'y':
                    return None
                continue
            
            print(f"✅ Project path: {path}\n")
            return str(path)
    
    @staticmethod
    def get_output_path(default='./extracted_texts'):
        """Get output path from user"""
        print("📂 BƯỚC 2: CHỌN THỦ MỤC OUTPUT")
        print("-" * 70)
        print(f"Nhập đường dẫn lưu kết quả (Enter để dùng mặc định: {default})")
        print()
        
        output_path = input(f"👉 Output path [{default}]: ").strip()
        
        if not output_path:
            output_path = default
        
        # Remove quotes
        output_path = output_path.strip('"').strip("'")
        
        print(f"✅ Output path: {output_path}\n")
        return output_path
    
    @staticmethod
    def get_language():
        """Get language from user"""
        print("🌍 BƯỚC 3: CHỌN NGÔN NGỮ")
        print("-" * 70)
        
        languages = {
            '1': ('auto', '🔍 Tự động phát hiện (Recommended)'),
            '2': ('vi', '🇻🇳 Tiếng Việt'),
            '3': ('en', '🇬🇧 English'),
            '4': ('zh', '🇨🇳 中文 (Chinese)'),
            '5': ('ja', '🇯🇵 日本語 (Japanese)'),
            '6': ('ko', '🇰🇷 한국어 (Korean)'),
            '7': ('th', '🇹🇭 ภาษาไทย (Thai)'),
            '8': ('ar', '🇸🇦 العربية (Arabic)'),
            '9': ('ru', '🇷🇺 Русский (Russian)'),
            '10': ('fr', '🇫🇷 Français (French)'),
            '11': ('de', '🇩🇪 Deutsch (German)'),
            '12': ('es', '🇪🇸 Español (Spanish)'),
            '13': ('pt', '🇵🇹 Português (Portuguese)'),
            '14': ('it', '🇮🇹 Italiano (Italian)'),
        }
        
        for key, (code, name) in languages.items():
            print(f"  {key}. {name}")
        print()
        
        while True:
            choice = input("👉 Chọn ngôn ngữ [1]: ").strip() or '1'
            
            if choice in languages:
                lang_code, lang_name = languages[choice]
                print(f"✅ Đã chọn: {lang_name}\n")
                return lang_code
            else:
                print("❌ Lựa chọn không hợp lệ, vui lòng chọn lại!\n")
    
    @staticmethod
    def get_format():
        """Get export format from user"""
        print("📝 BƯỚC 4: CHỌN FORMAT XUẤT FILE")
        print("-" * 70)
        
        formats = {
            '1': (['txt'], '📄 TXT - Text files (Recommended)'),
            '2': (['json'], '📦 JSON - Single JSON file'),
            '3': (['csv'], '📊 CSV - Excel compatible'),
            '4': (['txt', 'json'], '📄📦 TXT + JSON'),
            '5': (['txt', 'csv'], '📄📊 TXT + CSV'),
            '6': (['txt', 'json', 'csv'], '🎁 ALL - Tất cả formats'),
        }
        
        for key, (codes, name) in formats.items():
            print(f"  {key}. {name}")
        print()
        
        while True:
            choice = input("👉 Chọn format [1]: ").strip() or '1'
            
            if choice in formats:
                format_codes, format_name = formats[choice]
                print(f"✅ Đã chọn: {format_name}\n")
                return format_codes
            else:
                print("❌ Lựa chọn không hợp lệ, vui lòng chọn lại!\n")
    
    @staticmethod
    def get_text_length():
        """Get text length constraints"""
        print("📏 BƯỚC 5: TÙY CHỈNH ĐỘ DÀI TEXT (Optional)")
        print("-" * 70)
        print("Lọc text theo độ dài (giúp loại bỏ noise)")
        print("  - Mặc định: min=2, max=500")
        print("  - Khuyến nghị: min=3, max=200 (strict)")
        print()
        
        use_default = input("👉 Dùng mặc định? (Y/n): ").strip().lower()
        
        if use_default != 'n':
            print("✅ Sử dụng mặc định: min=2, max=500\n")
            return 2, 500
        
        try:
            min_length = int(input("  Min length [2]: ").strip() or '2')
            max_length = int(input("  Max length [500]: ").strip() or '500')
            print(f"✅ Độ dài: min={min_length}, max={max_length}\n")
            return min_length, max_length
        except ValueError:
            print("❌ Giá trị không hợp lệ, dùng mặc định: min=2, max=500\n")
            return 2, 500
    
    @staticmethod
    def confirm_settings(settings):
        """Confirm all settings before running"""
        print("=" * 70)
        print("📋 XÁC NHẬN CÀI ĐẶT")
        print("=" * 70)
        print(f"  📁 Project:     {settings['project_path']}")
        print(f"  📂 Output:      {settings['output']}")
        print(f"  🌍 Language:    {settings['language']}")
        print(f"  📝 Format:      {', '.join(settings['format'])}")
        print(f"  📏 Text length: min={settings['min_length']}, max={settings['max_length']}")
        print("=" * 70)
        print()
        
        confirm = input("👉 Bắt đầu quét? (Y/n): ").strip().lower()
        return confirm != 'n'
    
    @staticmethod
    def run_interactive():
        """Run interactive mode"""
        InteractiveMenu.print_header()
        
        # Get all settings
        project_path = InteractiveMenu.get_project_path()
        if not project_path:
            print("\n❌ Hủy bỏ!\n")
            return None
        
        output = InteractiveMenu.get_output_path()
        language = InteractiveMenu.get_language()
        format_list = InteractiveMenu.get_format()
        min_length, max_length = InteractiveMenu.get_text_length()
        
        settings = {
            'project_path': project_path,
            'output': output,
            'language': language,
            'format': format_list,
            'min_length': min_length,
            'max_length': max_length,
        }
        
        # Confirm
        if not InteractiveMenu.confirm_settings(settings):
            print("\n❌ Hủy bỏ!\n")
            return None
        
        return settings

# ============================================
# CLI INTERFACE
# ============================================

def main():
    """Main CLI function"""
    
    # Check if any arguments provided (CLI mode)
    if len(os.sys.argv) == 1:
        # No arguments - run interactive mode
        settings = InteractiveMenu.run_interactive()
        
        if not settings:
            return 1
        
        # Use settings from interactive mode
        args = argparse.Namespace(
            project_path=settings['project_path'],
            output=settings['output'],
            language=settings['language'],
            format=settings['format'],
            min_length=settings['min_length'],
            max_length=settings['max_length'],
            verbose=True  # Always verbose in interactive mode
        )
    else:
        # Arguments provided - use CLI mode
        parser = argparse.ArgumentParser(
            description='Universal Text Extractor for Multi-language Projects',
            formatter_class=argparse.RawDescriptionHelpFormatter,
            epilog="""
Examples:
  # Interactive mode (no arguments)
  python universal_text_extractor.py
  
  # CLI mode
  python universal_text_extractor.py /path/to/project
  python universal_text_extractor.py /path/to/project --output ./output
  python universal_text_extractor.py /path/to/project --format txt json csv
  python universal_text_extractor.py /path/to/project --language vi
  python universal_text_extractor.py /path/to/project --verbose
            """
        )
        
        parser.add_argument(
            'project_path',
            nargs='?',  # Make it optional for interactive mode
            help='Path to the project root directory'
        )
    
        parser.add_argument(
            '--output', '-o',
            default='./extracted_texts',
            help='Output directory for extracted texts (default: ./extracted_texts)'
        )
        
        parser.add_argument(
            '--language', '-l',
            default='auto',
            choices=['auto', 'vi', 'en', 'zh', 'ja', 'ko', 'th', 'ar', 'ru', 'fr', 'de', 'es', 'pt', 'it'],
            help='Primary language of the project (default: auto-detect)'
        )
        
        parser.add_argument(
            '--format', '-f',
            nargs='+',
            default=['txt'],
            choices=['txt', 'json', 'csv', 'all'],
            help='Output format(s) (default: txt)'
        )
        
        parser.add_argument(
            '--verbose', '-v',
            action='store_true',
            help='Enable verbose output'
        )
        
        parser.add_argument(
            '--min-length',
            type=int,
            default=2,
            help='Minimum text length to extract (default: 2)'
        )
        
        parser.add_argument(
            '--max-length',
            type=int,
            default=500,
            help='Maximum text length to extract (default: 500)'
        )
        
        args = parser.parse_args()
        
        # If no project_path in CLI mode, show error
        if not args.project_path:
            parser.print_help()
            print("\n❌ Error: project_path is required in CLI mode")
            print("💡 Tip: Run without arguments for interactive mode")
            return 1
    
    # Update config with CLI arguments
    Config.MIN_TEXT_LENGTH = args.min_length
    Config.MAX_TEXT_LENGTH = args.max_length
    
    # Print header
    print("\n" + "="*60)
    print("   UNIVERSAL TEXT EXTRACTOR v2.0.0")
    print("="*60)
    print(f"📁 Project: {args.project_path}")
    print(f"📂 Output: {args.output}")
    print(f"🌍 Language: {args.language}")
    print(f"📝 Format: {', '.join(args.format)}")
    print("="*60 + "\n")
    
    # Check if project path exists
    if not Path(args.project_path).exists():
        print(f"❌ Error: Project path does not exist: {args.project_path}")
        return 1
    
    # Create extractor
    extractor = TextExtractor(args.project_path, Config)
    
    # Scan project
    module_texts = extractor.scan_project()
    
    # Detect language if auto
    if args.language == 'auto':
        # Sample some texts to detect language
        sample_texts = []
        for texts in list(module_texts.values())[:5]:
            sample_texts.extend(list(texts)[:10])
        
        lang_votes = defaultdict(int)
        for text in sample_texts:
            lang = TextCleaner.detect_language(text)
            lang_votes[lang] += 1
        
        detected_lang = max(lang_votes.items(), key=lambda x: x[1])[0] if lang_votes else 'unknown'
        print(f"\n🔍 Detected language: {detected_lang}")
    else:
        detected_lang = args.language
    
    # Create output directory
    output_dir = Path(args.output) / detected_lang
    output_dir.mkdir(parents=True, exist_ok=True)
    
    # Export results
    print("\n" + "="*60)
    print("💾 EXPORTING RESULTS")
    print("="*60 + "\n")
    
    formats = args.format
    if 'all' in formats:
        formats = ['txt', 'json', 'csv']
    
    if 'txt' in formats:
        TextExporter.export_to_txt(module_texts, output_dir, detected_lang)
    
    if 'json' in formats:
        TextExporter.export_to_json(
            module_texts,
            output_dir.parent / f"{detected_lang}_texts.json",
            detected_lang
        )
    
    if 'csv' in formats:
        TextExporter.export_to_csv(
            module_texts,
            output_dir.parent / f"{detected_lang}_texts.csv",
            detected_lang
        )
    
    # Export index
    TextExporter.export_index(
        module_texts,
        output_dir / "INDEX.txt",
        detected_lang
    )
    
    # Print summary
    total_texts = sum(len(texts) for texts in module_texts.values())
    print("\n" + "="*60)
    print("✅ EXTRACTION COMPLETE")
    print("="*60)
    print(f"📊 Total modules: {len(module_texts)}")
    print(f"📝 Total texts: {total_texts}")
    print(f"📁 Output directory: {output_dir}")
    print("="*60 + "\n")
    
    return 0

if __name__ == "__main__":
    exit(main())
