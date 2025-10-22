#!/usr/bin/env python3
import os
import sys
import subprocess
import platform
from pathlib import Path

def run(cmd, shell=False):
    try:
        res = subprocess.run(cmd, shell=shell, check=True)
        return res.returncode
    except subprocess.CalledProcessError as e:
        print(f"[ERR] Lệnh lỗi: {cmd} (code={e.returncode})")
        return e.returncode
    except FileNotFoundError:
        print(f"[ERR] Không tìm thấy lệnh/file: {cmd}")
        return 1

def start_windows():
    base = Path(os.getenv("XAMPP_PATH", r"C:\xampp"))
    if not base.exists():
        # Thử thêm một số vị trí hay dùng
        for p in [Path(r"D:\xampp"), Path(r"E:\xampp")]:
            if p.exists():
                base = p
                break

    print(f"[INFO] XAMPP path (Win): {base}")

    # Ưu tiên xampp_start.exe (start Apache + MySQL)
    exe = base / "xampp_start.exe"
    if exe.exists():
        return run([str(exe)])

    # Fallback: chạy các .bat riêng
    ap_bat = base / "apache_start.bat"
    my_bat = base / "mysql_start.bat"
    ok = 0
    if ap_bat.exists():
        ok |= run(["cmd", "/c", str(ap_bat)])
    else:
        print("[WARN] Không thấy apache_start.bat")

    if my_bat.exists():
        ok |= run(["cmd", "/c", str(my_bat)])
    else:
        print("[WARN] Không thấy mysql_start.bat")

    # Fallback cuối: nếu đã cài dịch vụ Windows
    if ok != 0:
        print("[INFO] Thử start qua dịch vụ Windows (nếu đã install service trong XAMPP Control).")
        run(["sc", "start", "Apache2.4"])
        run(["sc", "start", "mysql"])
    return 0

def start_linux_macos():
    # Các vị trí hay gặp
    candidates = [
        Path(os.getenv("XAMPP_PATH", "/opt/lampp")),                           # Linux
        Path("/Applications/XAMPP/xamppfiles"),                                 # macOS
    ]
    lampp = None
    xampp_script = None

    for base in candidates:
        if (base / "lampp").exists():
            lampp = base / "lampp"
            break
        if (base / "xampp").exists():
            xampp_script = base / "xampp"
            break

    print(f"[INFO] lampp: {lampp} | xampp: {xampp_script}")

    # Ưu tiên script có sẵn
    if lampp:
        rc1 = run([str(lampp), "startapache"])
        rc2 = run([str(lampp), "startmysql"])
        return rc1 | rc2
    if xampp_script:
        rc1 = run([str(xampp_script), "startapache"])
        rc2 = run([str(xampp_script), "startmysql"])
        return rc1 | rc2

    # Fallback: thử gọi binary trực tiếp (ít dùng)
    print("[ERR] Không tìm thấy script lampp/xampp. Đặt biến XAMPP_PATH cho đúng, ví dụ:")
    print("      Linux: export XAMPP_PATH=/opt/lampp")
    print("      macOS: export XAMPP_PATH=/Applications/XAMPP/xamppfiles")
    return 1

def main():
    os_name = platform.system().lower()
    print(f"[INFO] Hệ điều hành: {os_name}")

    if "windows" in os_name:
        code = start_windows()
    else:
        code = start_linux_macos()

    if code == 0:
        print("[OK] Apache và MySQL đã được yêu cầu khởi động.")
    else:
        print("[FAIL] Không khởi động được đầy đủ. Xem cảnh báo/ERR ở trên.")

if __name__ == "__main__":
    sys.exit(main())
