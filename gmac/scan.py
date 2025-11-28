import os
import sys
import subprocess
from datetime import datetime

# ================= CẤU HÌNH =================
if sys.stdout.encoding != 'utf-8':
    try:
        sys.stdout.reconfigure(encoding='utf-8')
    except AttributeError:
        pass

PROJECT_ROOT = './' 
IGNORE_DIRS = {
    '.git', '.idea', '.vscode', 'vendor', 'node_modules', 
    'storage', 'cache', 'tests', 'tmp', 'logs', 'public', 'build', 'dist', 'image', 'images', 'font', 'fonts'
}

TARGET_EXTENSIONS = {'.php', '.js', '.css', '.blade.php', '.scss'}

SAFE_FILES = {
    'index.php', 'artisan', 'console', 'routes.php', 'web.php', 'api.php', 
    'server.php', 'webpack.mix.js', 'package.json', 'composer.json', 'Dockerfile',
    'docker-compose.yml', 'phpunit.xml', '.env', '.env.example'
}

CONFIDENCE_THRESHOLD = 90 

class Colors:
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'

# ================= HÀM HỖ TRỢ =================

def get_git_file_age(file_path):
    try:
        cmd = ['git', 'log', '-1', '--format=%ct', file_path]
        result = subprocess.run(cmd, capture_output=True, text=True, cwd=PROJECT_ROOT)
        if result.returncode == 0 and result.stdout.strip():
            timestamp = int(result.stdout.strip())
            last_mod = datetime.fromtimestamp(timestamp)
            return (datetime.now() - last_mod).days
    except:
        pass
    return 0

def run_git_grep_verify(term, file_path_to_ignore):
    try:
        # Check tên không đuôi
        cmd = ['git', 'grep', '-l', '-F', term]
        result = subprocess.run(cmd, capture_output=True, text=True, cwd=PROJECT_ROOT)
        
        found_files = []
        if result.returncode == 0:
             found_files = result.stdout.strip().split('\n')

        # Check tên có đuôi (để chắc ăn hơn)
        term_full = os.path.basename(file_path_to_ignore)
        cmd2 = ['git', 'grep', '-l', '-F', term_full]
        result2 = subprocess.run(cmd2, capture_output=True, text=True, cwd=PROJECT_ROOT)
        
        if result2.returncode == 0:
            found_files.extend(result2.stdout.strip().split('\n'))

        real_usage_count = 0
        for f in found_files:
            if not f: continue
            abs_found = os.path.abspath(f)
            abs_ignore = os.path.abspath(file_path_to_ignore)
            if abs_found != abs_ignore:
                real_usage_count += 1
                
        return real_usage_count > 0
    except:
        return True # Nếu lỗi thì giữ lại cho an toàn

def scan_project_structure(root_dir):
    all_files = []
    print(f"{Colors.HEADER}--- DANG QUET FILE HE THONG... ---{Colors.ENDC}")
    for root, dirs, files in os.walk(root_dir):
        dirs[:] = [d for d in dirs if d not in IGNORE_DIRS]
        for file in files:
            if any(file.endswith(ext) for ext in TARGET_EXTENSIONS):
                all_files.append(os.path.join(root, file))
    return all_files

# ================= MAIN LOGIC =================

def main():
    print(f"{Colors.OKBLUE}=== TOOL DON DEP PROJECT PHP (FINAL V3 - AUTO DELETE) ==={Colors.ENDC}")
    print(f"Project Root: {os.path.abspath(PROJECT_ROOT)}")
    
    files = scan_project_structure(PROJECT_ROOT)
    print(f"Tong so file: {len(files)}")
    
    deleted_count = 0
    space_saved = 0
    
    # CỜ BẬT CHẾ ĐỘ TỰ ĐỘNG XÓA
    auto_delete_mode = False

    print(f"\n{Colors.WARNING}--- BAT DAU PHAN TICH ---{Colors.ENDC}")
    
    for idx, file_path in enumerate(files):
        filename = os.path.basename(file_path)
        if filename in SAFE_FILES: continue

        name_no_ext = os.path.splitext(filename)[0]
        
        # BƯỚC 1: GIT GREP (Triple Check: Check tên file & Check full tên file)
        is_used = run_git_grep_verify(name_no_ext, file_path)
        if is_used: continue
            
        # BƯỚC 2: TÍNH ĐIỂM
        confidence = 0
        reasons = []
        
        confidence += 85 # Base score vì Git Grep không tìm thấy
        
        days_old = get_git_file_age(file_path)
        if days_old > 365:
            confidence += 14
            reasons.append(f"Zombie {days_old}d")
        elif days_old > 180:
            confidence += 10
            reasons.append(f"Cu {days_old}d")
        elif days_old > 30:
            confidence += 5
        elif days_old == 0:
            confidence -= 20
            reasons.append("Untracked")

        if confidence > 99: confidence = 99
        
        # BƯỚC 3: XỬ LÝ XÓA
        if confidence >= CONFIDENCE_THRESHOLD:
            file_size = os.path.getsize(file_path) / 1024 
            
            # Nếu chưa bật auto delete thì mới hiện thông báo
            if not auto_delete_mode:
                print(f"\n{Colors.FAIL}------------------------------------------------{Colors.ENDC}")
                print(f"PHAT HIEN: {file_path}")
                print(f"Do tin cay: {Colors.OKGREEN}{confidence}%{Colors.ENDC} ({', '.join(reasons)})")
            
            user_input = ''

            # LOGIC XỬ LÝ INPUT
            if auto_delete_mode:
                # Chế độ tự động: In gọn 1 dòng rồi xóa luôn
                print(f"[AUTO] Deleting: {os.path.basename(file_path)}...", end=" ")
                user_input = 'y'
            else:
                user_input = input(f"{Colors.WARNING}>>> XOA FILE NAY? [y/n/all/quit]: {Colors.ENDC}").lower().strip()
            
            # XỬ LÝ LỆNH 'ALL'
            if user_input == 'all':
                print(f"{Colors.FAIL}!!! CANH BAO: CHE DO XOA TU DONG !!!{Colors.ENDC}")
                confirm = input("Xac nhan xoa tat ca file >90% con lai? (y/n): ").lower().strip()
                
                # Chấp nhận cả 'y' và 'yes'
                if confirm == 'yes' or confirm == 'y':
                    auto_delete_mode = True
                    user_input = 'y' # Xóa luôn file hiện tại
                    print(f"{Colors.OKGREEN}===> DA BAT CHE DO AUTO DELETE <==={Colors.ENDC}")
                else:
                    print("Da huy che do all.")
                    user_input = 'n'

            # THỰC HIỆN XÓA
            if user_input == 'y':
                try:
                    os.remove(file_path)
                    if auto_delete_mode:
                        print("OK") # In gọn
                    else:
                        print(f"{Colors.OKGREEN}---> DA XOA THANH CONG!{Colors.ENDC}")
                    
                    deleted_count += 1
                    space_saved += file_size
                except Exception as e:
                    print(f"{Colors.FAIL}Loi khi xoa: {e}{Colors.ENDC}")
            
            elif user_input == 'quit':
                print("Dung chuong trinh.")
                break

    print(f"\n{Colors.OKBLUE}================ TONG KET ================{Colors.ENDC}")
    print(f"Tong so file da xoa: {deleted_count}")
    print(f"Tong dung luong giai phong: {space_saved:.2f} KB")

if __name__ == "__main__":
    try:
        main()
    except KeyboardInterrupt:
        print("\nDa dung chuong trinh.")