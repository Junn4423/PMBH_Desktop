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

                $result = db_query($sql);

                $data = [];
                $i = 1;
                while ($row = db_fetch_array($result)) {
                    $data[$i] = $row;
                    $i++;
                }

                return $data;
            }
        }

        $filter = isset($input['filter']) ? $input['filter'] : (isset($_POST['filter']) ? $_POST['filter'] : null);

        switch ($vfun) {
            case 'load':
                $data = loadBanWithFilter($filter); // Gọi hàm và lấy dữ liệu
                $vOutput = array('success' => true, 'data' => $data);
                break;

            default:
                $vOutput = array('success' => false, 'message' => 'Hành động không hợp lệ.');
                break;
        }
        break;
}
?>