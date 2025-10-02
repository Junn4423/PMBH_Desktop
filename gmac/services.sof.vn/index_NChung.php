<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$_SESSION['ERPSOFV2RRight']='admin';
$_SESSION['ERPSOFV2RUserID']='admin';
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

}
?>