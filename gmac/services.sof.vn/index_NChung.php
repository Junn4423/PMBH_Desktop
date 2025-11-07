<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$_SESSION['ERPSOFV2RRight']='admin';
$_SESSION['ERPSOFV2RUserID']='admin';

if (!function_exists('esc_str')) {
    function esc_str($s)
    {
        if (function_exists('db_escape_string')) {
            return db_escape_string($s);
        }
        if (isset($GLOBALS['db_link']) && function_exists('mysqli_real_escape_string')) {
            return mysqli_real_escape_string($GLOBALS['db_link'], $s);
        }
        return addslashes($s);
    }
}

if (!function_exists('request_value')) {
    function request_value($key, $default = null)
    {
        global $input;
        if (is_array($input) && array_key_exists($key, $input)) {
            return $input[$key];
        }
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }
}

if (!function_exists('normalize_datetime_input')) {
    function normalize_datetime_input($value, $fallback = null)
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d H:i:s');
        }
        if ($value === null) {
            return $fallback ?: '1900-01-01 00:00:00';
        }
        $stringValue = trim((string)$value);
        if ($stringValue === '') {
            return $fallback ?: '1900-01-01 00:00:00';
        }
        if (is_numeric($stringValue)) {
            $timestamp = (int)$stringValue;
        } else {
            $timestamp = strtotime($stringValue);
        }
        if ($timestamp === false) {
            return $fallback ?: '1900-01-01 00:00:00';
        }
        return date('Y-m-d H:i:s', $timestamp);
    }
}

if (!function_exists('normalize_to_array')) {
    function normalize_to_array($value)
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }
        return [];
    }
}

switch ($vtable) {


    // dung cho bep
    case 'Mb_Oder':
        include("../cafe/clsall/sl_lv0014.php");
        $sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'layDsMonDangChoOder':
                $vOutput = $sl_lv0014->layHoaDonTuBanDangBan();

                break;
            case 'layMonAnTuBanDangBan':
                $vOutput = $sl_lv0014->layMonAnTuBanDangBan();

                break; 
            case 'layMonNuocTuBanDangBan':
                $vOutput = $sl_lv0014->layMonNuocTuBanDangBan();

                break;   

            case 'layDsMonDaXong':
                $vOutput = $sl_lv0014->layHoaDonTuBanDaXong();

                break;

            default:
                break;
        }
        break;





    case 'm_CheckTrangThai':
        include("../cafe/clsall/sl_lv0014.php");
        $sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
        $banid = isset($input['banid']) ? $input['banid'] : (isset($_POST['banid']) ? $_POST['banid'] : "");

        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;

            case 'layThongTinDonHang':
                $objEmps = $sl_lv0014->layHoaDonTuBanDangBan($banid);
                while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        "id" => $vrow["lv001"] ?? '',
                        "ten" => $vrow["lv002"] ?? '',
                        "maNguoiDung" => $vrow["lv003"] ?? '',
                        "chuDe" => $vrow["lv004"] ?? '',
                        "nguonXuat" => $vrow["lv005"] ?? 'XUATKHO',
                        "maThamChieu" => $vrow["lv006"] ?? '',
                        "trangThai" => $vrow["lv007"] ?? '0',
                        "chiChu" => $vrow["lv008"] ?? '',
                        "ngayXuat" => $vrow["lv009"] ?? '',
                        "HinhThucXuat" => $vrow["lv010"] ?? 'Xuất kho',
                        "NguoiNhanKho" => $vrow["lv011"] ?? '',
                    ];
                }

                break;

            default:
                break;
        }
        break;

    case 'm_updateTrangThaiMon':
        include("../cafe/clsall/sl_lv0014.php");
		$sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;

            case 'updateTrangThaiMon':
                $itemId = isset($input['itemId']) ? $input['itemId'] : (isset($_POST['itemId']) ? $_POST['itemId'] : "");
                $result = $sl_lv0014->updateTrangThaiMon($itemId);
                break;

            default:
                break;
        }
        break;

    case 'm_loadBan':
    include("../cafe/clsall/sl_lv0013.php");

    if (!function_exists('loadBanWithFilter')) {
        function loadBanWithFilter($filter)
        {
            $filterCondition = "";
            if ($filter === 'trong') {
                $filterCondition = "AND lv004 = 'trong'";
            } elseif ($filter === 'ngoai') {
                $filterCondition = "AND lv004 = 'ngoai'";
            }

            $sql = "
                SELECT 
                    lv0013.lv001 AS maHoaDon,
                    lv0009.lv002 AS tenBan,
                    lv0009.lv004 AS viTri,
                    lv0054.lv002 AS trangThai
                FROM sl_lv0013 AS lv0013
                LEFT JOIN sl_lv0009 AS lv0009 ON lv0013.lv007 = lv0009.lv001
                LEFT JOIN sl_lv0054 AS lv0054 ON lv0013.lv011 = lv0054.lv001
                WHERE 1=1 $filterCondition
                ORDER BY lv0013.lv001 ASC
            ";

            // chỉ lấy dữ liệu associative
            $result = db_query($sql);
            $data   = [];

            while ($row = db_fetch_array($result, MYSQLI_ASSOC)) {
                $data[] = [
                    'maHoaDon'  => $row['maHoaDon'],
                    'tenBan'    => $row['tenBan'],
                    'viTri'     => $row['viTri'],
                    'trangThai' => $row['trangThai'],
                ];
            }

            return $data;
        }
    }

    $filter = isset($input['filter']) ? $input['filter'] : ($_POST['filter'] ?? null);

    switch ($vfun) {
        case 'load':
            $data    = loadBanWithFilter($filter);
            $vOutput = ['success' => true, 'data' => $data];
            break;

        default:
            $vOutput = ['success' => false, 'message' => 'Hành động không hợp lệ.'];
            break;
    }
    break;

    // Dọn bàn sau thanh toán (đã sửa an toàn hơn cho case DonBan)
case 'DonBan':
    include("../cafe/clsall/sl_lv0013.php");
    $sl_lv0013 = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');

    // helper escape tối thiểu (giữ nguyên hệ hàm db_* hiện có)
    if (!function_exists('esc_str')) {
        function esc_str($s) {
            if (function_exists('db_escape_string')) return db_escape_string($s);
            if (isset($GLOBALS['db_link']) && function_exists('mysqli_real_escape_string')) {
                return mysqli_real_escape_string($GLOBALS['db_link'], $s);
            }
            return addslashes($s);
        }
    }

    switch ($vfun) {
        case 'donBan': {
            // yêu cầu: chỉ “đóng” các hoá đơn đang mở (lv011=0) của đúng bàn
            $maBan = isset($input['maBan']) ? trim($input['maBan']) : (isset($_POST['maBan']) ? trim($_POST['maBan']) : "");
            if ($maBan === "") {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã bàn'];
                break;
            }

            $maBanEsc = esc_str($maBan);

            // chỉ update bill đang mở; ghi user & thời điểm UTC
            $sql = "
                UPDATE sl_lv0013
                   SET lv011 = 1,                -- đánh dấu dọn bàn (đóng bill tạm)
                       lv029 = UTC_TIMESTAMP(),  -- thời điểm dọn bàn
                       lv032 = '".esc_str($_SESSION['ERPSOFV2RUserID'])."'  -- người thao tác
                 WHERE lv007 = '{$maBanEsc}'
                   AND lv011 = 0
            ";
            $result = db_query($sql);

            // xác định số dòng bị ảnh hưởng nếu có hàm, nếu không thì rơi về true/false
            $rows = 0;
            if (function_exists('db_affected_rows')) {
                $rows = (int) db_affected_rows();
            } else if ($result && function_exists('db_num_affected_rows')) {
                $rows = (int) db_num_affected_rows($result);
            }

            if ($result && $rows > 0) {
                $vOutput = ['success' => true, 'message' => 'Dọn bàn thành công', 'rows' => $rows];
            } else {
                // Không có bill đang mở khớp điều kiện hoặc lỗi truy vấn
                $vOutput = ['success' => false, 'message' => 'Không tìm thấy hoá đơn đang mở cho bàn này hoặc lỗi truy vấn'];
            }
            break;
        }

        case 'donBanTheoHoaDon': {
            $maHoaDon = isset($input['maHoaDon']) ? trim($input['maHoaDon']) : (isset($_POST['maHoaDon']) ? trim($_POST['maHoaDon']) : "");
            if ($maHoaDon === "") {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã hóa đơn'];
                break;
            }

            $maHdEsc = esc_str($maHoaDon);
            $sql = "
                UPDATE sl_lv0013
                   SET lv011 = 1,
                       lv029 = UTC_TIMESTAMP(),
                       lv032 = '".esc_str($_SESSION['ERPSOFV2RUserID'])."'
                 WHERE lv001 = '{$maHdEsc}'
                   AND lv011 = 0
            ";
            $result = db_query($sql);

            $rows = 0;
            if (function_exists('db_affected_rows')) $rows = (int) db_affected_rows();

            if ($result && $rows === 1) {
                $vOutput = ['success' => true, 'message' => 'Dọn bàn theo hóa đơn thành công'];
            } else {
                $vOutput = ['success' => false, 'message' => 'Hóa đơn không tồn tại hoặc không ở trạng thái mở'];
            }
            break;
        }

        case 'thanhToanHoaDon': {
            $maHd        = isset($input['maHd']) ? trim($input['maHd']) : (isset($_POST['maHd']) ? trim($_POST['maHd']) : "");
            $tongTien    = isset($input['tongTien']) ? (float)$input['tongTien'] : (isset($_POST['tongTien']) ? (float)$_POST['tongTien'] : 0);
            $tienKhach   = isset($input['tienKhachDua']) ? (float)$input['tienKhachDua'] : (isset($_POST['tienKhachDua']) ? (float)$_POST['tienKhachDua'] : 0);
            $tienThua    = isset($input['tienThua']) ? (float)$input['tienThua'] : (isset($_POST['tienThua']) ? (float)$_POST['tienThua'] : 0);

            if ($maHd === "") {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã hóa đơn'];
                break;
            }
            if ($tongTien < 0 || $tienKhach < 0) {
                $vOutput = ['success' => false, 'message' => 'Giá trị tiền không hợp lệ'];
                break;
            }

            $maHdEsc = esc_str($maHd);

            // Chỉ cho phép thanh toán khi hoá đơn đang mở (lv011=0)
            $sql = "
                UPDATE sl_lv0013
                   SET lv011 = 2,                -- đánh dấu đã thanh toán (sửa theo enum thực tế của bạn)
                       lv029 = UTC_TIMESTAMP(),
                       lv016 = ".($tongTien + 0).",
                       lv017 = ".($tienKhach + 0).",
                       lv018 = ".($tienThua + 0).",
                       lv032 = '".esc_str($_SESSION['ERPSOFV2RUserID'])."'
                 WHERE lv001 = '{$maHdEsc}'
                   AND lv011 = 0
            ";
            $result = db_query($sql);

            $rows = 0;
            if (function_exists('db_affected_rows')) $rows = (int) db_affected_rows();

            if ($result && $rows === 1) {
                $vOutput = ['success' => true, 'message' => 'Thanh toán và dọn bàn thành công', 'tienThua' => $tienThua];
            } else {
                $vOutput = ['success' => false, 'message' => 'Hoá đơn không tồn tại hoặc không ở trạng thái mở'];
            }
            break;
        }

        case 'thanhToanHonHop': {
            $maHd           = isset($input['maHd']) ? trim($input['maHd']) : (isset($_POST['maHd']) ? trim($_POST['maHd']) : "");
            $tongTien       = isset($input['tongTien']) ? (float)$input['tongTien'] : (isset($_POST['tongTien']) ? (float)$_POST['tongTien'] : 0);
            $finalTotal     = isset($input['finalTotal']) ? (float)$input['finalTotal'] : (isset($_POST['finalTotal']) ? (float)$_POST['finalTotal'] : 0);
            $discount       = isset($input['discount']) ? (float)$input['discount'] : (isset($_POST['discount']) ? (float)$_POST['discount'] : 0);
            $mixedPayments  = isset($input['mixedPayments']) ? $input['mixedPayments'] : (isset($_POST['mixedPayments']) ? $_POST['mixedPayments'] : "");
            $ghiChu         = isset($input['ghiChu']) ? trim($input['ghiChu']) : (isset($_POST['ghiChu']) ? trim($_POST['ghiChu']) : "");
            $ngayThanhToan  = isset($input['ngayThanhToan']) ? trim($input['ngayThanhToan']) : (isset($_POST['ngayThanhToan']) ? trim($_POST['ngayThanhToan']) : "");

            if ($maHd === "") {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã hóa đơn'];
                break;
            }
            if ($finalTotal < 0) {
                $vOutput = ['success' => false, 'message' => 'Giá trị tiền không hợp lệ'];
                break;
            }

            $maHdEsc = esc_str($maHd);
            $ghiChuEsc = esc_str($ghiChu);
            $mixedPaymentsEsc = esc_str($mixedPayments);

            // Cập nhật hoá đơn với thông tin thanh toán hỗn hợp
            $sql = "
                UPDATE sl_lv0013
                   SET lv011 = 2,
                       lv029 = UTC_TIMESTAMP(),
                       lv016 = ".($finalTotal + 0).",
                       lv017 = ".($finalTotal + 0).",
                       lv018 = 0,
                       lv030 = '{$ghiChuEsc}',
                       lv031 = '{$mixedPaymentsEsc}',
                       lv032 = '".esc_str($_SESSION['ERPSOFV2RUserID'])."'
                 WHERE lv001 = '{$maHdEsc}'
                   AND lv011 = 0
            ";
            $result = db_query($sql);

            $rows = 0;
            if (function_exists('db_affected_rows')) $rows = (int) db_affected_rows();

            if ($result && $rows === 1) {
                $vOutput = ['success' => true, 'message' => 'Thanh toán hỗn hợp thành công'];
            } else {
                $vOutput = ['success' => false, 'message' => 'Hoá đơn không tồn tại hoặc không ở trạng thái mở'];
            }
            break;
        }

        case 'luuChiTietThanhToanHonHop': {
            $maHd          = isset($input['maHd']) ? trim($input['maHd']) : (isset($_POST['maHd']) ? trim($_POST['maHd']) : "");
            $mixedPayments = isset($input['mixedPayments']) ? $input['mixedPayments'] : (isset($_POST['mixedPayments']) ? $_POST['mixedPayments'] : "");

            if ($maHd === "" || $mixedPayments === "") {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã hóa đơn hoặc thông tin thanh toán'];
                break;
            }

            $maHdEsc = esc_str($maHd);
            $mixedPaymentsEsc = esc_str($mixedPayments);

            // Lưu chi tiết thanh toán vào bảng (giả sử có bảng sl_lv0013_payments hoặc field lv031)
            $sql = "
                UPDATE sl_lv0013
                   SET lv031 = '{$mixedPaymentsEsc}'
                 WHERE lv001 = '{$maHdEsc}'
            ";
            $result = db_query($sql);

            if ($result) {
                $vOutput = ['success' => true, 'message' => 'Lưu chi tiết thanh toán hỗn hợp thành công'];
            } else {
                $vOutput = ['success' => false, 'message' => 'Lỗi lưu chi tiết thanh toán'];
            }
            break;
        }

        case 'layLichSuThanhToanHonHop': {
            $maHd = isset($input['maHd']) ? trim($input['maHd']) : (isset($_POST['maHd']) ? trim($_POST['maHd']) : "");

            if ($maHd === "") {
                $vOutput = ['success' => false, 'message' => 'Thiếu mã hóa đơn'];
                break;
            }

            $maHdEsc = esc_str($maHd);

            // Lấy lịch sử thanh toán từ field lv031
            $sql = "
                SELECT lv001 as maHd, lv030 as ghiChu, lv031 as mixedPayments, lv029 as ngayThanhToan
                  FROM sl_lv0013
                 WHERE lv001 = '{$maHdEsc}'
            ";
            $result = db_query($sql);

            if ($result && $row = db_fetch_array($result, MYSQLI_ASSOC)) {
                $vOutput = [
                    'success' => true,
                    'data' => [
                        'maHd' => $row['maHd'],
                        'ghiChu' => $row['ghiChu'],
                        'mixedPayments' => $row['mixedPayments'],
                        'ngayThanhToan' => $row['ngayThanhToan']
                    ]
                ];
            } else {
                $vOutput = ['success' => false, 'message' => 'Không tìm thấy lịch sử thanh toán'];
            }
            break;
        }

        default:
            $vOutput = ['success' => false, 'message' => 'Chức năng không tồn tại'];
            break;
    }
    break;

    // Case xuất báo cáo bán hàng chi tiết
    case 'BaoCaoBanHang':
        include("../clsall/sl_lv0214.php");
        $sl_lv0214 = new sl_lv0214($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Sl0201');
        
        switch ($vfun) {
            case 'layBaoCaoBanHangChiTiet': {
                $ngayBatDau = isset($input['ngayBatDau']) ? trim($input['ngayBatDau']) : (isset($_POST['ngayBatDau']) ? trim($_POST['ngayBatDau']) : "");
                $ngayKetThuc = isset($input['ngayKetThuc']) ? trim($input['ngayKetThuc']) : (isset($_POST['ngayKetThuc']) ? trim($_POST['ngayKetThuc']) : "");
                $plang = isset($input['plang']) ? $input['plang'] : (isset($_POST['plang']) ? $_POST['plang'] : 'vi');
                $vArrLang = isset($input['vArrLang']) ? $input['vArrLang'] : (isset($_POST['vArrLang']) ? $_POST['vArrLang'] : []);
                $vOpt = isset($input['vOpt']) ? (int)$input['vOpt'] : (isset($_POST['vOpt']) ? (int)$_POST['vOpt'] : 0);

                if ($ngayBatDau === "" || $ngayKetThuc === "") {
                    $vOutput = [
                        'success' => false,
                        'message' => 'Vui lòng cung cấp ngày bắt đầu và ngày kết thúc'
                    ];
                    break;
                }

                // Validate định dạng ngày
                $dateStart = date_create_from_format('Y-m-d', $ngayBatDau);
                $dateEnd = date_create_from_format('Y-m-d', $ngayKetThuc);
                
                if (!$dateStart || !$dateEnd) {
                    $vOutput = [
                        'success' => false,
                        'message' => 'Định dạng ngày không hợp lệ. Vui lòng sử dụng định dạng YYYY-MM-DD'
                    ];
                    break;
                }

                if ($dateStart > $dateEnd) {
                    $vOutput = [
                        'success' => false,
                        'message' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc'
                    ];
                    break;
                }

                try {
                    // Lấy dữ liệu từ database
                    $vsql = "
                        SELECT 
                            DATE(B.lv004) AS Ngay,
                            A.lv003 AS MaSP,
                            COALESCE(CAST(NULLIF(A.lv006, '') AS DECIMAL(18,2)), 0) AS DonGia,
                            COALESCE(CAST(REPLACE(NULLIF(A.lv004, ''), ',', '') AS DECIMAL(18,2)), 0) AS SoLuong,
                            COALESCE(CAST(NULLIF(A.lv011, '') AS DECIMAL(10,2)), 0) AS GiamGia,
                            COALESCE(CAST(NULLIF(B.lv022, '') AS DECIMAL(10,2)), 0) AS CKTM,
                            ROUND(
                                COALESCE(CAST(NULLIF(A.lv006,'') AS DECIMAL(18,2)),0) *
                                COALESCE(CAST(REPLACE(NULLIF(A.lv004,''),',','') AS DECIMAL(18,2)),0) *
                                (1 - COALESCE(CAST(NULLIF(A.lv011,'') AS DECIMAL(10,2)),0)/100.0) *
                                (1 - COALESCE(CAST(NULLIF(B.lv022,'') AS DECIMAL(10,2)),0)/100.0)
                            , 0) AS ThanhTien,
                            C.lv002 AS TenSP
                        FROM sl_lv0014 A
                        JOIN sl_lv0007 C ON A.lv003 = C.lv001
                        JOIN sl_lv0013 B ON A.lv002 = B.lv001
                        WHERE DATE(B.lv004) BETWEEN '$ngayBatDau' AND '$ngayKetThuc'
                        ORDER BY Ngay, A.lv003
                    ";
                    
                    $rs = db_query($vsql);
                    
                    if (!$rs) {
                        $vOutput = [
                            'success' => false,
                            'message' => 'Lỗi truy vấn database'
                        ];
                        break;
                    }
                    
                    // Gom dữ liệu theo ngày
                    $dataByDate = [];
                    $tongThanhTien = 0;
                    
                    while ($row = db_fetch_array($rs, MYSQLI_ASSOC)) {
                        $ngay = $row['Ngay'];
                        $maSP = $row['MaSP'];
                        
                        // Ép kiểu số
                        $soLuong = (float)$row['SoLuong'];
                        $donGia = (float)$row['DonGia'];
                        $giamGia = (float)$row['GiamGia'];
                        $cktm = (float)$row['CKTM'];
                        $thanhTien = (float)$row['ThanhTien'];
                        
                        // Gộp sản phẩm trùng trong cùng ngày
                        if (!isset($dataByDate[$ngay])) {
                            $dataByDate[$ngay] = [];
                        }
                        
                        if (!isset($dataByDate[$ngay][$maSP])) {
                            $dataByDate[$ngay][$maSP] = [
                                'maSP' => $maSP,
                                'tenSP' => $row['TenSP'],
                                'soLuong' => $soLuong,
                                'donGia' => $donGia,
                                'giamGia' => $giamGia,
                                'cktm' => $cktm,
                                'thanhTien' => $thanhTien
                            ];
                        } else {
                            // Cộng dồn nếu trùng sản phẩm
                            $dataByDate[$ngay][$maSP]['soLuong'] += $soLuong;
                            $dataByDate[$ngay][$maSP]['thanhTien'] += $thanhTien;
                        }
                        
                        $tongThanhTien += $thanhTien;
                    }
                    
                    // Sắp xếp theo ngày
                    ksort($dataByDate);
                    
                    // Format dữ liệu output
                    $reportData = [];
                    $stt = 1;
                    
                    foreach ($dataByDate as $ngay => $products) {
                        $ngayFormatted = date('d/m/Y', strtotime($ngay));
                        
                        foreach ($products as $product) {
                            $reportData[] = [
                                'stt' => $stt,
                                'ngay' => $ngayFormatted,
                                'maSP' => $product['maSP'],
                                'tenSP' => $product['tenSP'],
                                'soLuong' => $product['soLuong'],
                                'donGia' => $product['donGia'],
                                'giamGia' => $product['giamGia'],
                                'cktm' => $product['cktm'],
                                'thanhTien' => $product['thanhTien']
                            ];
                        }
                        $stt++;
                    }
                    
                    if (count($reportData) > 0) {
                        $vOutput = [
                            'success' => true,
                            'data' => $reportData,
                            'summary' => [
                                'tongThanhTien' => $tongThanhTien,
                                'soNgay' => count($dataByDate),
                                'tongSanPham' => count($reportData)
                            ],
                            'message' => 'Xuất báo cáo bán hàng thành công',
                            'period' => [
                                'from' => $ngayBatDau,
                                'to' => $ngayKetThuc
                            ]
                        ];
                    } else {
                        $vOutput = [
                            'success' => false,
                            'message' => 'Không có dữ liệu bán hàng trong khoảng thời gian đã chọn',
                            'data' => []
                        ];
                    }
                } catch (Exception $e) {
                    $vOutput = [
                        'success' => false,
                        'message' => 'Lỗi khi xuất báo cáo bán hàng: ' . $e->getMessage()
                    ];
                }
                break;
            }

            default:
                $vOutput = ['success' => false, 'message' => 'Chức năng không tồn tại'];
                break;
        }
        break;

    case 'Mb_SalesPrograms':
        $currentUserIdEsc = esc_str($_SESSION['ERPSOFV2RUserID']);
        switch ($vfun) {
            case 'list':
                $statusRaw = request_value('status', null);
                $statusFilter = null;
                if ($statusRaw !== null && $statusRaw !== '') {
                    $statusFilter = (int)$statusRaw;
                }
                $sql = "SELECT A.lv001, A.lv002, A.lv003, A.lv004, A.lv005, A.lv006, A.lv007, A.lv008, A.lv009, A.lv099, (SELECT COUNT(*) FROM sl_lv0060 D WHERE D.lv002=A.lv001) AS itemCount FROM sl_lv0059 A";
                if ($statusFilter !== null) {
                    $sql .= " WHERE A.lv008 = " . $statusFilter;
                }
                $sql .= " ORDER BY COALESCE(A.lv006, A.lv003) DESC";
                $result = db_query($sql);
                if (!$result) {
                    $vOutput = ['success' => false, 'message' => 'Khong truy van duoc danh sach chuong trinh'];
                    break;
                }
                $programs = [];
                while ($row = db_fetch_array($result, MYSQLI_ASSOC)) {
                    $groupsRaw = isset($row['lv099']) ? $row['lv099'] : '';
                    $groups = array_values(array_filter(array_map('trim', explode(',', (string)$groupsRaw))));
                    $programs[] = [
                        'programId' => $row['lv001'],
                        'name' => $row['lv002'],
                        'startDate' => $row['lv003'],
                        'endDate' => $row['lv004'],
                        'createdBy' => $row['lv005'],
                        'updatedAt' => $row['lv006'],
                        'approvedBy' => $row['lv007'],
                        'status' => (int)$row['lv008'],
                        'value' => $row['lv009'],
                        'customerGroups' => $groups,
                        'itemCount' => (int)$row['itemCount']
                    ];
                }
                $vOutput = ['success' => true, 'data' => $programs];
                break;

            case 'get':
                $programId = trim((string)request_value('programId', ''));
                if ($programId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ma chuong trinh'];
                    break;
                }
                $programIdEsc = esc_str($programId);
                $programSql = "SELECT lv001, lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv099 FROM sl_lv0059 WHERE lv001='$programIdEsc' LIMIT 1";
                $programRes = db_query($programSql);
                if (!$programRes || !($programRow = db_fetch_array($programRes, MYSQLI_ASSOC))) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay chuong trinh'];
                    break;
                }
                $detailSql = "SELECT D.lv001, D.lv003 AS itemId, P.lv002 AS itemName, D.lv004 AS discount, D.lv005 AS quantityThreshold, D.lv006 AS pointValue, D.lv007 AS statusFlag, D.lv008 AS note FROM sl_lv0060 D LEFT JOIN sl_lv0007 P ON P.lv001 = D.lv003 WHERE D.lv002 = '$programIdEsc' ORDER BY D.lv001";
                $detailResult = db_query($detailSql);
                $details = [];
                if ($detailResult) {
                    while ($detailRow = db_fetch_array($detailResult, MYSQLI_ASSOC)) {
                        $details[] = [
                            'detailId' => (int)$detailRow['lv001'],
                            'itemId' => $detailRow['itemId'],
                            'itemName' => $detailRow['itemName'],
                            'discount' => (float)$detailRow['discount'],
                            'threshold' => (float)$detailRow['quantityThreshold'],
                            'points' => (float)$detailRow['pointValue'],
                            'status' => (int)$detailRow['statusFlag'],
                            'note' => $detailRow['note']
                        ];
                    }
                }
                $groupsRaw = isset($programRow['lv099']) ? $programRow['lv099'] : '';
                $groups = array_values(array_filter(array_map('trim', explode(',', (string)$groupsRaw))));
                $vOutput = [
                    'success' => true,
                    'data' => [
                        'programId' => $programRow['lv001'],
                        'name' => $programRow['lv002'],
                        'startDate' => $programRow['lv003'],
                        'endDate' => $programRow['lv004'],
                        'createdBy' => $programRow['lv005'],
                        'updatedAt' => $programRow['lv006'],
                        'approvedBy' => $programRow['lv007'],
                        'status' => (int)$programRow['lv008'],
                        'value' => $programRow['lv009'],
                        'customerGroups' => $groups,
                        'details' => $details
                    ]
                ];
                break;

            case 'create':
                $programId = trim((string)request_value('programId', ''));
                if ($programId === '') {
                    $programId = strtoupper('PRG' . dechex(time()) . substr(md5(uniqid('', true)), 0, 4));
                }
                $programIdEsc = esc_str($programId);
                $name = trim((string)request_value('name', ''));
                if ($name === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ten chuong trinh'];
                    break;
                }
                $nameEsc = esc_str($name);
                $startDate = normalize_datetime_input(request_value('startDate', null), date('Y-m-d 00:00:00'));
                $endDate = normalize_datetime_input(request_value('endDate', null), date('Y-m-d 23:59:59'));
                $startDateSql = "'" . esc_str($startDate) . "'";
                $endDateSql = "'" . esc_str($endDate) . "'";
                $value = trim((string)request_value('value', '0'));
                $valueEsc = esc_str($value);
                $groups = normalize_to_array(request_value('customerGroups', []));
                $groups = array_values(array_filter(array_map(function ($item) {
                    return trim((string)$item);
                }, $groups)));
                $groupStringEsc = esc_str(implode(',', array_unique($groups)));
                $details = normalize_to_array(request_value('details', []));
                db_query("START TRANSACTION");
                $insertSql = "INSERT INTO sl_lv0059 (lv001, lv002, lv003, lv004, lv005, lv006, lv008, lv009, lv099) VALUES ('$programIdEsc', '$nameEsc', $startDateSql, $endDateSql, '$currentUserIdEsc', NOW(), 0, '$valueEsc', '$groupStringEsc')";
                if (!db_query($insertSql)) {
                    db_query("ROLLBACK");
                    $vOutput = ['success' => false, 'message' => 'Khong the tao chuong trinh'];
                    break;
                }
                $detailError = null;
                if (is_array($details) && count($details) > 0) {
                    foreach ($details as $detail) {
                        if (!is_array($detail)) {
                            continue;
                        }
                        $itemId = isset($detail['itemId']) ? trim((string)$detail['itemId']) : '';
                        if ($itemId === '') {
                            continue;
                        }
                        $itemIdEsc = esc_str($itemId);
                        $discount = isset($detail['discount']) ? (float)$detail['discount'] : 0;
                        $threshold = isset($detail['threshold']) ? (float)$detail['threshold'] : 0;
                        $points = isset($detail['points']) ? (float)$detail['points'] : 0;
                        $statusFlag = isset($detail['status']) ? (int)$detail['status'] : 0;
                        $note = isset($detail['note']) ? trim((string)$detail['note']) : '';
                        $noteEsc = esc_str($note);
                        $detailSql = "INSERT INTO sl_lv0060 (lv002, lv003, lv004, lv005, lv006, lv007, lv008) VALUES ('$programIdEsc', '$itemIdEsc', " . number_format($discount, 2, '.', '') . ", " . number_format($threshold, 2, '.', '') . ", " . number_format($points, 2, '.', '') . ", $statusFlag, '$noteEsc')";
                        if (!db_query($detailSql)) {
                            $detailError = 'Khong the luu chi tiet chuong trinh';
                            break;
                        }
                    }
                }
                if ($detailError !== null) {
                    db_query("ROLLBACK");
                    $vOutput = ['success' => false, 'message' => $detailError];
                    break;
                }
                db_query("COMMIT");
                $vOutput = ['success' => true, 'message' => 'Da tao chuong trinh', 'programId' => $programId];
                break;

            case 'update':
                $programId = trim((string)request_value('programId', ''));
                if ($programId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ma chuong trinh'];
                    break;
                }
                $programIdEsc = esc_str($programId);
                $checkSql = "SELECT lv008 FROM sl_lv0059 WHERE lv001='$programIdEsc' LIMIT 1";
                $checkResult = db_query($checkSql);
                if (!$checkResult || !($programRow = db_fetch_array($checkResult, MYSQLI_ASSOC))) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay chuong trinh'];
                    break;
                }
                if ((int)$programRow['lv008'] > 0) {
                    $vOutput = ['success' => false, 'message' => 'Chuong trinh da duyet, khong the cap nhat'];
                    break;
                }
                $name = trim((string)request_value('name', ''));
                if ($name === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ten chuong trinh'];
                    break;
                }
                $nameEsc = esc_str($name);
                $startDate = normalize_datetime_input(request_value('startDate', null), date('Y-m-d 00:00:00'));
                $endDate = normalize_datetime_input(request_value('endDate', null), date('Y-m-d 23:59:59'));
                $startDateSql = "'" . esc_str($startDate) . "'";
                $endDateSql = "'" . esc_str($endDate) . "'";
                $value = trim((string)request_value('value', '0'));
                $valueEsc = esc_str($value);
                $groups = normalize_to_array(request_value('customerGroups', []));
                $groups = array_values(array_filter(array_map(function ($item) {
                    return trim((string)$item);
                }, $groups)));
                $groupStringEsc = esc_str(implode(',', array_unique($groups)));
                $details = normalize_to_array(request_value('details', []));
                db_query("START TRANSACTION");
                $updateSql = "UPDATE sl_lv0059 SET lv002='$nameEsc', lv003=$startDateSql, lv004=$endDateSql, lv006=NOW(), lv009='$valueEsc', lv099='$groupStringEsc' WHERE lv001='$programIdEsc'";
                if (!db_query($updateSql)) {
                    db_query("ROLLBACK");
                    $vOutput = ['success' => false, 'message' => 'Khong the cap nhat chuong trinh'];
                    break;
                }
                if (!db_query("DELETE FROM sl_lv0060 WHERE lv002='$programIdEsc'")) {
                    db_query("ROLLBACK");
                    $vOutput = ['success' => false, 'message' => 'Khong the xoa chi tiet cu'];
                    break;
                }
                $detailError = null;
                if (is_array($details) && count($details) > 0) {
                    foreach ($details as $detail) {
                        if (!is_array($detail)) {
                            continue;
                        }
                        $itemId = isset($detail['itemId']) ? trim((string)$detail['itemId']) : '';
                        if ($itemId === '') {
                            continue;
                        }
                        $itemIdEsc = esc_str($itemId);
                        $discount = isset($detail['discount']) ? (float)$detail['discount'] : 0;
                        $threshold = isset($detail['threshold']) ? (float)$detail['threshold'] : 0;
                        $points = isset($detail['points']) ? (float)$detail['points'] : 0;
                        $statusFlag = isset($detail['status']) ? (int)$detail['status'] : 0;
                        $note = isset($detail['note']) ? trim((string)$detail['note']) : '';
                        $noteEsc = esc_str($note);
                        $detailSql = "INSERT INTO sl_lv0060 (lv002, lv003, lv004, lv005, lv006, lv007, lv008) VALUES ('$programIdEsc', '$itemIdEsc', " . number_format($discount, 2, '.', '') . ", " . number_format($threshold, 2, '.', '') . ", " . number_format($points, 2, '.', '') . ", $statusFlag, '$noteEsc')";
                        if (!db_query($detailSql)) {
                            $detailError = 'Khong the luu chi tiet chuong trinh';
                            break;
                        }
                    }
                }
                if ($detailError !== null) {
                    db_query("ROLLBACK");
                    $vOutput = ['success' => false, 'message' => $detailError];
                    break;
                }
                db_query("COMMIT");
                $vOutput = ['success' => true, 'message' => 'Da cap nhat chuong trinh'];
                break;

            case 'delete':
                $programId = trim((string)request_value('programId', ''));
                if ($programId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ma chuong trinh'];
                    break;
                }
                $programIdEsc = esc_str($programId);
                $checkSql = "SELECT lv008 FROM sl_lv0059 WHERE lv001='$programIdEsc' LIMIT 1";
                $checkResult = db_query($checkSql);
                if (!$checkResult || !($programRow = db_fetch_array($checkResult, MYSQLI_ASSOC))) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay chuong trinh'];
                    break;
                }
                if ((int)$programRow['lv008'] > 0) {
                    $vOutput = ['success' => false, 'message' => 'Chuong trinh da duyet, khong the xoa'];
                    break;
                }
                if (db_query("DELETE FROM sl_lv0059 WHERE lv001='$programIdEsc'")) {
                    $vOutput = ['success' => true, 'message' => 'Da xoa chuong trinh'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Khong the xoa chuong trinh'];
                }
                break;

            case 'toggleStatus':
                $programId = trim((string)request_value('programId', ''));
                if ($programId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ma chuong trinh'];
                    break;
                }
                $programIdEsc = esc_str($programId);
                $statusRaw = request_value('active', null);
                if ($statusRaw === null || $statusRaw === '') {
                    $statusRaw = request_value('status', null);
                }
                $targetStatus = (int)((bool)$statusRaw ? 1 : 0);
                $checkSql = "SELECT lv008 FROM sl_lv0059 WHERE lv001='$programIdEsc' LIMIT 1";
                $checkResult = db_query($checkSql);
                if (!$checkResult || !($programRow = db_fetch_array($checkResult, MYSQLI_ASSOC))) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay chuong trinh'];
                    break;
                }
                if ($targetStatus === (int)$programRow['lv008']) {
                    $vOutput = ['success' => true, 'message' => 'Trang thai khong thay doi', 'status' => $targetStatus];
                    break;
                }
                if ($targetStatus === 1) {
                    $toggleSql = "UPDATE sl_lv0059 SET lv008=1, lv007='$currentUserIdEsc', lv006=NOW() WHERE lv001='$programIdEsc'";
                } else {
                    $toggleSql = "UPDATE sl_lv0059 SET lv008=0, lv007=NULL, lv006=NOW() WHERE lv001='$programIdEsc'";
                }
                if (db_query($toggleSql)) {
                    $vOutput = ['success' => true, 'message' => 'Da cap nhat trang thai', 'status' => $targetStatus];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Khong the cap nhat trang thai'];
                }
                break;

            default:
                $vOutput = ['success' => false, 'message' => 'Chuc nang khong hop le'];
                break;
        }
        break;

    case 'Mb_Loyalty':
        $currentUserIdEsc = esc_str($_SESSION['ERPSOFV2RUserID']);
        $fetchSummary = function ($customerIdEsc) {
            $summarySql = "SELECT C.lv001, C.lv002, C.lv010, C.lv022,
                                  COALESCE(SUM(CASE WHEN T.lv004 > 0 THEN T.lv004 ELSE 0 END),0) AS totalEarned,
                                  COALESCE(SUM(CASE WHEN T.lv004 < 0 THEN -T.lv004 ELSE 0 END),0) AS totalRedeemed,
                                  COALESCE(SUM(T.lv004),0) AS balance
                           FROM sl_lv0001 C
                           LEFT JOIN sl_lv0115 T ON T.lv002 = C.lv001 AND T.lv015 >= 0
                           WHERE C.lv001 = '$customerIdEsc'
                           GROUP BY C.lv001, C.lv002, C.lv010, C.lv022";
            $summaryResult = db_query($summarySql);
            if ($summaryResult && ($row = db_fetch_array($summaryResult, MYSQLI_ASSOC))) {
                return [
                    'customerId' => $row['lv001'],
                    'name' => $row['lv002'],
                    'phone' => $row['lv010'],
                    'group' => $row['lv022'],
                    'accumulated' => (float)$row['totalEarned'],
                    'redeemed' => (float)$row['totalRedeemed'],
                    'balance' => (float)$row['balance']
                ];
            }
            return null;
        };
        $updateAggregates = function ($customerIdEsc) use ($fetchSummary) {
            $summary = $fetchSummary($customerIdEsc);
            if (!$summary) {
                return null;
            }
            $totalEarned = number_format((float)$summary['accumulated'], 2, '.', '');
            $totalRedeemed = number_format((float)$summary['redeemed'], 2, '.', '');
            $balance = number_format((float)$summary['balance'], 2, '.', '');
            $updateSql = "UPDATE sl_lv0001 
                          SET lv100=$totalEarned, lv101=$totalRedeemed, lv102=$balance, lv024=NOW() 
                          WHERE lv001='$customerIdEsc'";
            db_query($updateSql);
            return $summary;
        };
        switch ($vfun) {
            case 'listCustomers':
                $limit = (int)request_value('limit', 50);
                if ($limit <= 0) {
                    $limit = 50;
                }
                if ($limit > 200) {
                    $limit = 200;
                }
                $offset = (int)request_value('offset', 0);
                if ($offset < 0) {
                    $offset = 0;
                }
                $keyword = trim((string)request_value('keyword', ''));
                $group = trim((string)request_value('group', ''));
                $conditions = [];
                if ($keyword !== '') {
                    $keywordLikeEsc = esc_str('%' . $keyword . '%');
                    $conditions[] = "(C.lv001 LIKE '$keywordLikeEsc' OR C.lv002 LIKE '$keywordLikeEsc' OR C.lv010 LIKE '$keywordLikeEsc')";
                }
                if ($group !== '') {
                    $groupEsc = esc_str($group);
                    $conditions[] = "C.lv022 = '$groupEsc'";
                }
                $whereClause = '';
                if (count($conditions) > 0) {
                    $whereClause = 'WHERE ' . implode(' AND ', $conditions);
                }
                $countSql = "SELECT COUNT(*) AS total FROM sl_lv0001 C $whereClause";
                $countResult = db_query($countSql);
                $totalRecords = 0;
                if ($countResult && ($countRow = db_fetch_array($countResult, MYSQLI_ASSOC))) {
                    $totalRecords = (int)$countRow['total'];
                }
                $sql = "SELECT C.lv001, C.lv002, C.lv010, C.lv022,
                               COALESCE(SUM(CASE WHEN T.lv004 > 0 THEN T.lv004 ELSE 0 END),0) AS totalPoints,
                               COALESCE(SUM(CASE WHEN T.lv004 < 0 THEN -T.lv004 ELSE 0 END),0) AS usedPoints,
                               COALESCE(SUM(T.lv004),0) AS remainingPoints
                        FROM sl_lv0001 C
                        LEFT JOIN sl_lv0115 T ON T.lv002 = C.lv001 AND T.lv015 >= 0
                        $whereClause
                        GROUP BY C.lv001, C.lv002, C.lv010, C.lv022
                        ORDER BY COALESCE(C.lv024, '1900-01-01 00:00:00') DESC, C.lv002, C.lv001
                        LIMIT $offset, $limit";
                $result = db_query($sql);
                if (!$result) {
                    $vOutput = ['success' => false, 'message' => 'Khong lay duoc danh sach khach hang'];
                    break;
                }
                $data = [];
                while ($row = db_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = [
                        'customerId' => $row['lv001'],
                        'name' => $row['lv002'],
                        'phone' => $row['lv010'],
                        'group' => $row['lv022'],
                        'totalPoints' => (float)$row['totalPoints'],
                        'usedPoints' => (float)$row['usedPoints'],
                        'remainingPoints' => (float)$row['remainingPoints']
                    ];
                }
                $vOutput = [
                    'success' => true,
                    'data' => $data,
                    'pagination' => [
                        'limit' => $limit,
                        'offset' => $offset,
                        'total' => $totalRecords
                    ]
                ];
                break;

            case 'searchCustomers':
                $keyword = trim((string)request_value('keyword', ''));
                $limit = (int)request_value('limit', 20);
                if ($limit <= 0) {
                    $limit = 20;
                }
                if ($limit > 100) {
                    $limit = 100;
                }
                if ($keyword === '') {
                    $vOutput = ['success' => true, 'data' => []];
                    break;
                }
                $keywordLikeEsc = esc_str('%' . $keyword . '%');
                $sql = "SELECT C.lv001, C.lv002, C.lv010, C.lv022,
                               COALESCE(SUM(CASE WHEN T.lv004 > 0 THEN T.lv004 ELSE 0 END),0) AS totalPoints,
                               COALESCE(SUM(CASE WHEN T.lv004 < 0 THEN -T.lv004 ELSE 0 END),0) AS usedPoints,
                               COALESCE(SUM(T.lv004),0) AS remainingPoints
                        FROM sl_lv0001 C
                        LEFT JOIN sl_lv0115 T ON T.lv002 = C.lv001 AND T.lv015 >= 0
                        WHERE C.lv001 LIKE '$keywordLikeEsc' OR C.lv002 LIKE '$keywordLikeEsc' OR C.lv010 LIKE '$keywordLikeEsc'
                        GROUP BY C.lv001, C.lv002, C.lv010, C.lv022
                        ORDER BY C.lv002
                        LIMIT $limit";
                $result = db_query($sql);
                if (!$result) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim duoc khach hang'];
                    break;
                }
                $data = [];
                while ($row = db_fetch_array($result, MYSQLI_ASSOC)) {
                    $data[] = [
                        'customerId' => $row['lv001'],
                        'name' => $row['lv002'],
                        'phone' => $row['lv010'],
                        'group' => $row['lv022'],
                        'totalPoints' => (float)$row['totalPoints'],
                        'usedPoints' => (float)$row['usedPoints'],
                        'remainingPoints' => (float)$row['remainingPoints']
                    ];
                }
                $vOutput = ['success' => true, 'data' => $data];
                break;

            case 'registerCustomer':
                $customerId = trim((string)request_value('customerId', ''));
                $name = trim((string)request_value('name', ''));
                if ($customerId === '' || $name === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu thong tin khach hang'];
                    break;
                }
                $phone = trim((string)request_value('phone', ''));
                if ($phone === '') {
                    $phone = $customerId;
                }
                $group = trim((string)request_value('group', ''));
                $note = trim((string)request_value('note', ''));
                $customerIdEsc = esc_str($customerId);
                $nameEsc = esc_str($name);
                $phoneEsc = esc_str($phone);
                $groupEsc = esc_str($group);
                $noteEsc = esc_str($note);
                $sql = "INSERT INTO sl_lv0001 (lv001, lv002, lv010, lv022, lv019, lv099, lv100, lv101, lv102, lv024) VALUES ('$customerIdEsc', '$nameEsc', '$phoneEsc', '$groupEsc', '$noteEsc', 0, 0, 0, 0, NOW())
                        ON DUPLICATE KEY UPDATE lv002=VALUES(lv002), lv010=VALUES(lv010), lv022=VALUES(lv022), lv019=VALUES(lv019), lv024=NOW()";
                if (db_query($sql)) {
                    $summary = $updateAggregates($customerIdEsc);
                    if (!$summary) {
                        $summary = [
                            'customerId' => $customerId,
                            'name' => $name,
                            'phone' => $phone,
                            'group' => $group,
                            'accumulated' => 0.0,
                            'redeemed' => 0.0,
                            'balance' => 0.0
                        ];
                    }
                    $vOutput = ['success' => true, 'message' => 'Da cap nhat khach hang', 'data' => $summary];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Khong the cap nhat khach hang'];
                }
                break;

            case 'getCustomerSummary':
                $customerId = trim((string)request_value('customerId', ''));
                if ($customerId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ma khach hang'];
                    break;
                }
                $customerIdEsc = esc_str($customerId);
                $summary = $fetchSummary($customerIdEsc);
                if ($summary) {
                    $vOutput = ['success' => true, 'data' => $summary];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay khach hang'];
                }
                break;

            case 'addPoints':
                $customerId = trim((string)request_value('customerId', ''));
                $points = (float)request_value('points', 0);
                if ($customerId === '' || $points <= 0) {
                    $vOutput = ['success' => false, 'message' => 'Thong tin diem khong hop le'];
                    break;
                }
                $customerIdEsc = esc_str($customerId);
                $checkResult = db_query("SELECT lv001 FROM sl_lv0001 WHERE lv001='$customerIdEsc' LIMIT 1");
                if (!$checkResult || !db_fetch_array($checkResult, MYSQLI_ASSOC)) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay khach hang'];
                    break;
                }
                $amount = (float)request_value('amount', 0);
                $amountValue = number_format($amount, 2, '.', '');
                $programId = trim((string)request_value('programId', ''));
                $programValue = $programId !== '' ? "'" . esc_str($programId) . "'" : "NULL";
                $orderCode = trim((string)request_value('orderCode', ''));
                $orderValue = $orderCode !== '' ? "'" . esc_str($orderCode) . "'" : "NULL";
                $note = trim((string)request_value('note', ''));
                $noteValue = $note !== '' ? "'" . esc_str($note) . "'" : "NULL";
                $effectiveDate = normalize_datetime_input(request_value('effectiveDate', null), date('Y-m-d 00:00:00'));
                $startDateSql = "'" . esc_str(substr($effectiveDate, 0, 10)) . "'";
                $expiryRaw = request_value('expiryDate', null);
                $expiryValue = "NULL";
                if ($expiryRaw !== null && $expiryRaw !== '') {
                    $expiryDate = normalize_datetime_input($expiryRaw, null);
                    if ($expiryDate !== null) {
                        $expiryValue = "'" . esc_str(substr($expiryDate, 0, 10)) . "'";
                    }
                }
                $pointsValue = number_format($points, 2, '.', '');
                $insertSql = "INSERT INTO sl_lv0115 (lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015)
                              VALUES ('$customerIdEsc', $programValue, $pointsValue, $startDateSql, $expiryValue, NOW(), '$currentUserIdEsc', $orderValue, NOW(), 'earn', $noteValue, '$amountValue', 'POS', 1)";
                if (db_query($insertSql)) {
                    $summary = $updateAggregates($customerIdEsc);
                    if (!$summary) {
                        $summary = $fetchSummary($customerIdEsc);
                    }
                    $vOutput = ['success' => true, 'message' => 'Da cong diem', 'data' => $summary];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Khong the cong diem'];
                }
                break;

            case 'redeemPoints':
                $customerId = trim((string)request_value('customerId', ''));
                $points = (float)request_value('points', 0);
                if ($customerId === '' || $points <= 0) {
                    $vOutput = ['success' => false, 'message' => 'Thong tin diem khong hop le'];
                    break;
                }
                $customerIdEsc = esc_str($customerId);
                $summary = $fetchSummary($customerIdEsc);
                if (!$summary) {
                    $vOutput = ['success' => false, 'message' => 'Khong tim thay khach hang'];
                    break;
                }
                if ($summary['balance'] < $points) {
                    $vOutput = ['success' => false, 'message' => 'Khong du diem de tru'];
                    break;
                }
                $orderCode = trim((string)request_value('orderCode', ''));
                $orderValue = $orderCode !== '' ? "'" . esc_str($orderCode) . "'" : "NULL";
                $note = trim((string)request_value('note', ''));
                $noteValue = $note !== '' ? "'" . esc_str($note) . "'" : "NULL";
                $pointsValue = '-' . number_format(abs($points), 2, '.', '');
                $insertSql = "INSERT INTO sl_lv0115 (lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv014, lv015)
                              VALUES ('$customerIdEsc', NULL, $pointsValue, CURDATE(), NULL, NOW(), '$currentUserIdEsc', $orderValue, NOW(), 'redeem', $noteValue, '0', 'POS', 1)";
                if (db_query($insertSql)) {
                    $summary = $updateAggregates($customerIdEsc);
                    if (!$summary) {
                        $summary = $fetchSummary($customerIdEsc);
                    }
                    $vOutput = ['success' => true, 'message' => 'Da tru diem', 'data' => $summary];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Khong the tru diem'];
                }
                break;

            case 'history':
                $customerId = trim((string)request_value('customerId', ''));
                if ($customerId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thieu ma khach hang'];
                    break;
                }
                $customerIdEsc = esc_str($customerId);
                $limit = (int)request_value('limit', 50);
                if ($limit <= 0) {
                    $limit = 50;
                }
                if ($limit > 200) {
                    $limit = 200;
                }
                $offset = (int)request_value('offset', 0);
                if ($offset < 0) {
                    $offset = 0;
                }
                $historySql = "SELECT lv001, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, lv011, lv012, lv013, lv015 FROM sl_lv0115 WHERE lv002='$customerIdEsc' ORDER BY lv007 DESC LIMIT $offset, $limit";
                $result = db_query($historySql);
                if (!$result) {
                    $vOutput = ['success' => false, 'message' => 'Khong lay duoc lich su'];
                    break;
                }
                $records = [];
                while ($row = db_fetch_array($result, MYSQLI_ASSOC)) {
                    $records[] = [
                        'id' => (int)$row['lv001'],
                        'programId' => $row['lv003'],
                        'points' => (float)$row['lv004'],
                        'startDate' => $row['lv005'],
                        'expiryDate' => $row['lv006'],
                        'createdAt' => $row['lv007'],
                        'createdBy' => $row['lv008'],
                        'orderCode' => $row['lv009'],
                        'updatedAt' => $row['lv010'],
                        'type' => $row['lv011'],
                        'note' => $row['lv012'],
                        'amount' => isset($row['lv013']) ? (float)$row['lv013'] : 0.0,
                        'status' => (int)$row['lv015']
                    ];
                }
                $vOutput = [
                    'success' => true,
                    'data' => $records,
                    'pagination' => [
                        'limit' => $limit,
                        'offset' => $offset
                    ]
                ];
                break;

            default:
                $vOutput = ['success' => false, 'message' => 'Chuc nang khong hop le'];
                break;
        }
        break;

    // ==================== USER MANAGEMENT & PERMISSIONS ====================
    case 'Mb_Users':
        include("../clsall/lv_lv0007.php");
        $lv_lv0007 = new lv_lv0007($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Ad0011');
        
        if (!function_exists('esc_str')) {
            function esc_str($s) {
                if (function_exists('db_escape_string')) return db_escape_string($s);
                if (isset($GLOBALS['db_link']) && function_exists('mysqli_real_escape_string')) {
                    return mysqli_real_escape_string($GLOBALS['db_link'], $s);
                }
                return addslashes($s);
            }
        }
        
        switch ($vfun) {
            case 'getAll':
                $vsql = "SELECT lv001, lv002, lv003, lv004, lv006, lv007, lv094, lv095, lv099, lv100 FROM lv_lv0007 ORDER BY lv001";
                $vresult = db_query($vsql);
                $vOutput = [];
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'userId' => $vrow['lv001'],
                        'groupId' => $vrow['lv002'],
                        'groupUserId' => $vrow['lv003'],
                        'fullName' => $vrow['lv004'],
                        'employeeId' => $vrow['lv006'],
                        'status' => (int)$vrow['lv007'],
                        'companyId' => $vrow['lv094'],
                        'ipAddress' => $vrow['lv095'],
                        'theme' => $vrow['lv099'],
                        'branchId' => $vrow['lv100']
                    ];
                }
                break;
                
            case 'getById':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                if ($userId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã người dùng'];
                    break;
                }
                
                $userIdEsc = esc_str($userId);
                $vsql = "SELECT lv001, lv002, lv003, lv004, lv006, lv007, lv094, lv095, lv099, lv100 FROM lv_lv0007 WHERE lv001='$userIdEsc'";
                $vresult = db_query($vsql);
                $vrow = db_fetch_array($vresult, MYSQLI_ASSOC);
                
                if ($vrow) {
                    $vOutput = [
                        'success' => true,
                        'data' => [
                            'userId' => $vrow['lv001'],
                            'groupId' => $vrow['lv002'],
                            'groupUserId' => $vrow['lv003'],
                            'fullName' => $vrow['lv004'],
                            'employeeId' => $vrow['lv006'],
                            'status' => (int)$vrow['lv007'],
                            'companyId' => $vrow['lv094'],
                            'ipAddress' => $vrow['lv095'],
                            'theme' => $vrow['lv099'],
                            'branchId' => $vrow['lv100']
                        ]
                    ];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Không tìm thấy người dùng'];
                }
                break;
                
            case 'add':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                $groupId = isset($input['groupId']) ? trim($input['groupId']) : '';
                $groupUserId = isset($input['groupUserId']) ? trim($input['groupUserId']) : '';
                $fullName = isset($input['fullName']) ? trim($input['fullName']) : '';
                $password = isset($input['password']) ? trim($input['password']) : '123456';
                $employeeId = isset($input['employeeId']) ? trim($input['employeeId']) : '';
                $theme = isset($input['theme']) ? trim($input['theme']) : 'themes1';
                $branchId = isset($input['branchId']) ? trim($input['branchId']) : '';
                
                if ($userId === '' || $fullName === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu thông tin bắt buộc'];
                    break;
                }
                
                // Check if user exists
                $lv_lv0007->Load($userId);
                if ($lv_lv0007->lv001) {
                    $vOutput = ['success' => false, 'message' => 'Mã người dùng đã tồn tại'];
                    break;
                }
                
                $lv_lv0007->lv001 = $userId;
                $lv_lv0007->lv002 = $groupId;
                $lv_lv0007->lv003 = $groupUserId;
                $lv_lv0007->lv004 = $fullName;
                $lv_lv0007->lv005 = $password; // Will be hashed in LV_Insert
                $lv_lv0007->lv006 = $employeeId;
                $lv_lv0007->lv094 = '';
                $lv_lv0007->lv095 = '';
                $lv_lv0007->lv099 = $theme;
                $lv_lv0007->lv100 = $branchId;
                
                $result = $lv_lv0007->LV_Insert();
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Thêm người dùng thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Thêm người dùng thất bại'];
                }
                break;
                
            case 'edit':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                $groupId = isset($input['groupId']) ? trim($input['groupId']) : '';
                $groupUserId = isset($input['groupUserId']) ? trim($input['groupUserId']) : '';
                $fullName = isset($input['fullName']) ? trim($input['fullName']) : '';
                $employeeId = isset($input['employeeId']) ? trim($input['employeeId']) : '';
                $theme = isset($input['theme']) ? trim($input['theme']) : 'themes1';
                $branchId = isset($input['branchId']) ? trim($input['branchId']) : '';
                
                if ($userId === '' || $fullName === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu thông tin bắt buộc'];
                    break;
                }
                
                $lv_lv0007->lv001 = $userId;
                $lv_lv0007->lv002 = $groupId;
                $lv_lv0007->lv003 = $groupUserId;
                $lv_lv0007->lv004 = $fullName;
                $lv_lv0007->lv006 = $employeeId;
                $lv_lv0007->lv094 = '';
                $lv_lv0007->lv095 = '';
                $lv_lv0007->lv099 = $theme;
                $lv_lv0007->lv100 = $branchId;
                
                $result = $lv_lv0007->LV_Update();
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Cập nhật người dùng thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Cập nhật người dùng thất bại'];
                }
                break;
                
            case 'delete':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                
                if ($userId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã người dùng'];
                    break;
                }
                
                $userIdEsc = esc_str($userId);
                $result = $lv_lv0007->LV_Delete("'$userIdEsc'");
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Xóa người dùng thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Xóa người dùng thất bại'];
                }
                break;
                
            case 'toggleStatus':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                $status = isset($input['status']) ? (int)$input['status'] : 0;
                
                if ($userId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã người dùng'];
                    break;
                }
                
                $userIdEsc = esc_str($userId);
                $vsql = "UPDATE lv_lv0007 SET lv007=$status WHERE lv001='$userIdEsc'";
                $result = db_query($vsql);
                
                if ($result) {
                    $statusText = $status ? 'khóa' : 'mở khóa';
                    $vOutput = ['success' => true, 'message' => "Đã $statusText người dùng thành công"];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Cập nhật trạng thái thất bại'];
                }
                break;
                
            case 'changePassword':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                $newPassword = isset($input['newPassword']) ? trim($input['newPassword']) : '';
                
                if ($userId === '' || $newPassword === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu thông tin'];
                    break;
                }
                
                $userIdEsc = esc_str($userId);
                $hashedPassword = md5($newPassword);
                $vsql = "UPDATE lv_lv0007 SET lv005='$hashedPassword' WHERE lv001='$userIdEsc'";
                $result = db_query($vsql);
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Đổi mật khẩu thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Đổi mật khẩu thất bại'];
                }
                break;
                
            default:
                $vOutput = ['success' => false, 'message' => 'Chức năng không hợp lệ'];
                break;
        }
        break;
        
    case 'Mb_UserRights':
        if (!function_exists('esc_str')) {
            function esc_str($s) {
                if (function_exists('db_escape_string')) return db_escape_string($s);
                if (isset($GLOBALS['db_link']) && function_exists('mysqli_real_escape_string')) {
                    return mysqli_real_escape_string($GLOBALS['db_link'], $s);
                }
                return addslashes($s);
            }
        }
        
        switch ($vfun) {
            case 'getUserRights':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                
                if ($userId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã người dùng'];
                    break;
                }
                
                $userIdEsc = esc_str($userId);
                // Join với lv_lv0005 để lấy tên module/quyền đầy đủ
                $vsql = "SELECT A.lv001, A.lv002, A.lv003, A.lv004, 
                                B.lv002 as rightName, B.lv003 as rightPath
                         FROM lv_lv0008 A 
                         LEFT JOIN lv_lv0005 B ON A.lv003 = B.lv001 
                         WHERE A.lv002='$userIdEsc' 
                         ORDER BY B.lv002, A.lv001";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'id' => $vrow['lv001'],
                        'userId' => $vrow['lv002'],
                        'rightId' => $vrow['lv003'],
                        'enabled' => (int)$vrow['lv004'],
                        'rightName' => $vrow['rightName'] ?: $vrow['lv003'],
                        'rightPath' => $vrow['rightPath']
                    ];
                }
                break;
                
            case 'getRightDetails':
                $rightId = isset($input['rightId']) ? trim($input['rightId']) : '';
                
                if ($rightId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu mã quyền'];
                    break;
                }
                
                $rightIdEsc = esc_str($rightId);
                $vsql = "SELECT A.lv001, A.lv002, A.lv003, A.lv004, B.lv002 as controlName 
                         FROM lv_lv0009 A 
                         LEFT JOIN lv_lv0006 B ON A.lv002 = B.lv001 
                         WHERE A.lv003='$rightIdEsc' ORDER BY A.lv001";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'id' => $vrow['lv001'],
                        'controlType' => $vrow['lv002'],
                        'rightId' => $vrow['lv003'],
                        'enabled' => (int)$vrow['lv004'],
                        'controlName' => $vrow['controlName']
                    ];
                }
                break;
                
            case 'addRight':
                $userId = isset($input['userId']) ? trim($input['userId']) : '';
                $rightId = isset($input['rightId']) ? trim($input['rightId']) : '';
                
                if ($userId === '' || $rightId === '') {
                    $vOutput = ['success' => false, 'message' => 'Thiếu thông tin'];
                    break;
                }
                
                // Get next ID
                $vsql = "SELECT MAX(lv001) as maxId FROM lv_lv0008";
                $vresult = db_query($vsql);
                $vrow = db_fetch_array($vresult, MYSQLI_ASSOC);
                $nextId = $vrow['maxId'] + 1;
                
                $userIdEsc = esc_str($userId);
                $rightIdEsc = esc_str($rightId);
                
                $vsqlInsert = "INSERT INTO lv_lv0008(lv001, lv002, lv003, lv004) VALUES ($nextId, '$userIdEsc', '$rightIdEsc', 1)";
                $result = db_query($vsqlInsert);
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Thêm quyền thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Thêm quyền thất bại'];
                }
                break;
                
            case 'updateRight':
                $id = isset($input['id']) ? (int)$input['id'] : 0;
                $enabled = isset($input['enabled']) ? (int)$input['enabled'] : 0;
                
                if ($id === 0) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu ID'];
                    break;
                }
                
                $vsql = "UPDATE lv_lv0008 SET lv004=$enabled WHERE lv001=$id";
                $result = db_query($vsql);
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Cập nhật quyền thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Cập nhật quyền thất bại'];
                }
                break;
                
            case 'deleteRight':
                $id = isset($input['id']) ? (int)$input['id'] : 0;
                
                if ($id === 0) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu ID'];
                    break;
                }
                
                $vsql = "DELETE FROM lv_lv0008 WHERE lv001=$id";
                $result = db_query($vsql);
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Xóa quyền thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Xóa quyền thất bại'];
                }
                break;
                
            case 'updateDetailRight':
                $id = isset($input['id']) ? (int)$input['id'] : 0;
                $enabled = isset($input['enabled']) ? (int)$input['enabled'] : 0;
                
                if ($id === 0) {
                    $vOutput = ['success' => false, 'message' => 'Thiếu ID'];
                    break;
                }
                
                $vsql = "UPDATE lv_lv0009 SET lv004=$enabled WHERE lv001=$id";
                $result = db_query($vsql);
                
                if ($result) {
                    $vOutput = ['success' => true, 'message' => 'Cập nhật quyền chi tiết thành công'];
                } else {
                    $vOutput = ['success' => false, 'message' => 'Cập nhật quyền chi tiết thất bại'];
                }
                break;
                
            default:
                $vOutput = ['success' => false, 'message' => 'Chức năng không hợp lệ'];
                break;
        }
        break;
        
    case 'Mb_BaoCaoKho':
        switch ($vfun) {
            case 'baoCaoDieuKien':
        $maKhoInput = request_value('maKho', '');
        if (is_array($maKhoInput)) {
            $maKhoInput = reset($maKhoInput);
        }
        $maKhoInput = trim((string)$maKhoInput);

        $rawDateFrom = request_value('dateFrom');
        $rawDateTo = request_value('dateTo');

        $dateFrom = null;
        if (!empty($rawDateFrom)) {
            $timestamp = strtotime($rawDateFrom);
            if ($timestamp !== false) {
                $dateFrom = date('Y-m-d H:i:s', $timestamp);
            }
        }

        $dateTo = null;
        if (!empty($rawDateTo)) {
            $timestamp = strtotime($rawDateTo);
            if ($timestamp !== false) {
                $dateTo = date('Y-m-d H:i:s', $timestamp);
            }
        }

        $recordLimit = (int) (request_value('limit', 500));
        if ($recordLimit <= 0) {
            $recordLimit = 500;
        }
        if ($recordLimit > 1000) {
            $recordLimit = 1000;
        }

        $topLimit = (int) (request_value('topLimit', 5));
        if ($topLimit <= 0) {
            $topLimit = 5;
        }
        if ($topLimit > 20) {
            $topLimit = 20;
        }

        $maKhoEsc = $maKhoInput !== '' ? esc_str($maKhoInput) : '';
        $dateFromEsc = $dateFrom ? esc_str($dateFrom) : '';
        $dateToEsc = $dateTo ? esc_str($dateTo) : '';

        $headerConditions = [];
        $detailNhapConditions = [];
        $detailXuatConditions = [];

        if ($maKhoEsc !== '') {
            $headerConditions[] = "lv002 = '$maKhoEsc'";
            $detailNhapConditions[] = "h.lv002 = '$maKhoEsc'";
            $detailXuatConditions[] = "hx.lv002 = '$maKhoEsc'";
        }

        if ($dateFromEsc !== '') {
            $headerConditions[] = "lv009 >= '$dateFromEsc'";
            $detailNhapConditions[] = "h.lv009 >= '$dateFromEsc'";
            $detailXuatConditions[] = "hx.lv009 >= '$dateFromEsc'";
        }

        if ($dateToEsc !== '') {
            $headerConditions[] = "lv009 <= '$dateToEsc'";
            $detailNhapConditions[] = "h.lv009 <= '$dateToEsc'";
            $detailXuatConditions[] = "hx.lv009 <= '$dateToEsc'";
        }

        $headerWhere = $headerConditions ? implode(' AND ', $headerConditions) : '1=1';
        $detailNhapWhere = $detailNhapConditions ? implode(' AND ', $detailNhapConditions) : '1=1';
        $detailXuatWhere = $detailXuatConditions ? implode(' AND ', $detailXuatConditions) : '1=1';

        $nhapRecords = [];
        $tongNhap = 0;
        $sqlNhap = "SELECT lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009 FROM wh_lv0008 WHERE $headerWhere ORDER BY lv009 DESC LIMIT $recordLimit";
        $resNhap = db_query($sqlNhap);
        if ($resNhap) {
            while ($row = db_fetch_array($resNhap, MYSQLI_ASSOC)) {
                $tongTien = isset($row['lv008']) ? (float) $row['lv008'] : 0;
                $tongNhap += $tongTien;
                $nhapRecords[] = [
                    'maPhieuNhap' => $row['lv001'] ?? '',
                    'maPhieu' => $row['lv001'] ?? '',
                    'maKho' => $row['lv002'] ?? '',
                    'maNguoiDung' => $row['lv003'] ?? '',
                    'ghiChu' => $row['lv004'] ?? '',
                    'loaiPhieu' => $row['lv005'] ?? '',
                    'maThamChieu' => $row['lv006'] ?? '',
                    'trangThai' => $row['lv007'] ?? '',
                    'tongTien' => $tongTien,
                    'ngayNhap' => $row['lv009'] ?? ''
                ];
            }
        }

        $xuatRecords = [];
        $sqlXuat = "SELECT 
                        lv001,
                        lv002,
                        lv003,
                        lv004,
                        lv005,
                        lv006,
                        lv007,
                        lv008,
                        lv009,
                        lv010,
                        lv011,
                        (SELECT SUM(IFNULL(d.lv004,0) * IFNULL(d.lv008,0)) FROM wh_lv0011 d WHERE d.lv002 = wh_lv0010.lv001) AS tongTien
                    FROM wh_lv0010
                    WHERE $headerWhere
                    ORDER BY lv009 DESC
                    LIMIT $recordLimit";
        $resXuat = db_query($sqlXuat);
        if ($resXuat) {
            while ($row = db_fetch_array($resXuat, MYSQLI_ASSOC)) {
                $xuatRecords[] = [
                    'maPhieuXuat' => $row['lv001'] ?? '',
                    'maPhieu' => $row['lv001'] ?? '',
                    'maKho' => $row['lv002'] ?? '',
                    'maNguoiDung' => $row['lv003'] ?? '',
                    'chuDe' => $row['lv004'] ?? '',
                    'nguonXuat' => $row['lv005'] ?? '',
                    'maThamChieu' => $row['lv006'] ?? '',
                    'trangThai' => $row['lv007'] ?? '',
                    'ghiChu' => $row['lv008'] ?? '',
                    'ngayXuat' => $row['lv009'] ?? '',
                    'HinhThucXuat' => $row['lv010'] ?? '',
                    'NguoiNhanKho' => $row['lv011'] ?? '',
                    'tongTien' => isset($row['tongTien']) ? (float) $row['tongTien'] : 0
                ];
            }
        }

        $tongXuat = 0;
        $sqlTongXuat = "SELECT SUM(IFNULL(d.lv004,0) * IFNULL(d.lv008,0)) AS totalGiaTri
                        FROM wh_lv0011 d
                        INNER JOIN wh_lv0010 hx ON d.lv002 = hx.lv001
                        WHERE $detailXuatWhere";
        $resTongXuat = db_query($sqlTongXuat);
        if ($resTongXuat) {
            $sumRow = db_fetch_array($resTongXuat, MYSQLI_ASSOC);
            if ($sumRow && isset($sumRow['totalGiaTri'])) {
                $tongXuat = (float) $sumRow['totalGiaTri'];
            }
        }

        $topNhap = [];
        $sqlTopNhap = "SELECT 
                            d.lv003 AS maSanPham,
                            IFNULL(sp.lv002, '') AS tenSanPham,
                            SUM(IFNULL(d.lv004,0)) AS soLuong,
                            SUM(IFNULL(d.lv004,0) * IFNULL(d.lv008,0)) AS giaTri
                        FROM wh_lv0009 d
                        INNER JOIN wh_lv0008 h ON d.lv002 = h.lv001
                        LEFT JOIN sl_lv0007 sp ON sp.lv001 = d.lv003
                        WHERE $detailNhapWhere
                        GROUP BY d.lv003, sp.lv002
                        ORDER BY soLuong DESC, giaTri DESC
                        LIMIT $topLimit";
        $resTopNhap = db_query($sqlTopNhap);
        if ($resTopNhap) {
            while ($row = db_fetch_array($resTopNhap, MYSQLI_ASSOC)) {
                $topNhap[] = [
                    'maSanPham' => $row['maSanPham'] ?? '',
                    'tenSanPham' => $row['tenSanPham'] ?? '',
                    'soLuong' => (float) ($row['soLuong'] ?? 0),
                    'giaTri' => (float) ($row['giaTri'] ?? 0)
                ];
            }
        }

        $topXuat = [];
        $sqlTopXuat = "SELECT 
                            d.lv003 AS maSanPham,
                            IFNULL(sp.lv002, '') AS tenSanPham,
                            SUM(IFNULL(d.lv004,0)) AS soLuong,
                            SUM(IFNULL(d.lv004,0) * IFNULL(d.lv008,0)) AS giaTri
                        FROM wh_lv0011 d
                        INNER JOIN wh_lv0010 hx ON d.lv002 = hx.lv001
                        LEFT JOIN sl_lv0007 sp ON sp.lv001 = d.lv003
                        WHERE $detailXuatWhere
                        GROUP BY d.lv003, sp.lv002
                        ORDER BY soLuong DESC, giaTri DESC
                        LIMIT $topLimit";
        $resTopXuat = db_query($sqlTopXuat);
        if ($resTopXuat) {
            while ($row = db_fetch_array($resTopXuat, MYSQLI_ASSOC)) {
                $topXuat[] = [
                    'maSanPham' => $row['maSanPham'] ?? '',
                    'tenSanPham' => $row['tenSanPham'] ?? '',
                    'soLuong' => (float) ($row['soLuong'] ?? 0),
                    'giaTri' => (float) ($row['giaTri'] ?? 0)
                ];
            }
        }

        $vOutput = [
            'summary' => [
                'tongNhap' => $tongNhap,
                'tongXuat' => $tongXuat,
                'soPhieuNhap' => count($nhapRecords),
                'soPhieuXuat' => count($xuatRecords)
            ],
            'nhap' => $nhapRecords,
            'xuat' => $xuatRecords,
            'topNhap' => $topNhap,
            'topXuat' => $topXuat
        ];
                break;
            default:
                $vOutput = [
                    'success' => false,
                    'message' => 'Chuc nang khong ton tai'
                ];
                break;
        }
        break;
        
    case 'Mb_Permissions':
        switch ($vfun) {
            case 'getAll':
                $vsql = "SELECT lv001, lv002 FROM lv_lv0006 ORDER BY lv001";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'id' => $vrow['lv001'],
                        'name' => $vrow['lv002']
                    ];
                }
                break;
                
            default:
                $vOutput = ['success' => false, 'message' => 'Chức năng không hợp lệ'];
                break;
        }
        break;
        
    // ==================== DROPDOWN DATA FOR USER FORM ====================
    case 'Mb_UserFormData':
        if (!function_exists('esc_str')) {
            function esc_str($s) {
                if (function_exists('db_escape_string')) return db_escape_string($s);
                if (isset($GLOBALS['db_link']) && function_exists('mysqli_real_escape_string')) {
                    return mysqli_real_escape_string($GLOBALS['db_link'], $s);
                }
                return addslashes($s);
            }
        }
        
        switch ($vfun) {
            case 'getUserGroups':
                // Lấy danh sách nhóm người dùng từ lv_lv0004
                $vsql = "SELECT lv001, lv002 FROM lv_lv0004 ORDER BY lv002";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'value' => $vrow['lv001'],
                        'label' => $vrow['lv002']
                    ];
                }
                break;
                
            case 'getEmployees':
                // Lấy danh sách nhân viên từ hr_lv0020
                $vsql = "SELECT lv001, lv002 FROM hr_lv0020 WHERE lv099=1 ORDER BY lv002";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'value' => $vrow['lv001'],
                        'label' => $vrow['lv002'] . ' (' . $vrow['lv001'] . ')'
                    ];
                }
                break;
                
            case 'getBranches':
                // Lấy danh sách chi nhánh
                $vsql = "SELECT lv001, lv002 FROM hr_lv0001 ORDER BY lv002";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'value' => $vrow['lv001'],
                        'label' => $vrow['lv002']
                    ];
                }
                break;
                
            case 'getThemes':
                // Trả về danh sách themes có sẵn
                $vOutput = [
                    ['value' => 'themes1', 'label' => 'Theme 1 - Xanh dương'],
                    ['value' => 'themes2', 'label' => 'Theme 2 - Xanh lá'],
                    ['value' => 'themes3', 'label' => 'Theme 3 - Cam'],
                    ['value' => 'themes4', 'label' => 'Theme 4 - Tím']
                ];
                break;
                
            case 'getAvailableRights':
                // Lấy danh sách các quyền có thể gán cho user từ lv_lv0005
                $vsql = "SELECT lv001, lv002, lv006 FROM lv_lv0005 WHERE lv005=0 ORDER BY lv007, lv002";
                $vresult = db_query($vsql);
                $vOutput = [];
                
                while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
                    $vOutput[] = [
                        'value' => $vrow['lv001'],
                        'label' => $vrow['lv002'] . ' (' . $vrow['lv001'] . ')',
                        'parent' => $vrow['lv006']
                    ];
                }
                break;
                
            default:
                $vOutput = ['success' => false, 'message' => 'Chức năng không hợp lệ'];
                break;
        }
        break;

}
?>
