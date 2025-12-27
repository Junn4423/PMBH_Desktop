<?php


switch ($vtable) {
    case 'Mb_LayDanhSachKhuVuc':
        include_once("../cafe/clsall/sl_lv0008.php");
        $mobile = new sl_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'admin');
        echo $vcode;
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
                $objEmp = $mobile->Mb_LoadKhuVuc();
                $vOutput = $objEmp;
                break;
            default:

                break;
        }
        break;

    //Lấy danh sách bàn
    case "Mb_LayDsBan":
        include_once("../cafe/clsall/sl_lv0008.php");
        $mobile = new sl_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
                $vOutput = $mobile->Mb_LoadBan();
                break;
            default:

                break;
        }
        break;
// lấy hóa đơn thanh toán và chưa thanh toán ( có món)
    case "Mb_TongCthd":

        include_once("../cafe/clsall/sl_lv0013.php");
        $mobile = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
                $vOutput = $mobile->Mb_HoaDonBan();
                break;
            default:
                break;
        }
        break;


// lấy tất cả hóa đơn kể cả rỗng
    case "Mb_TongCthdRong":

    include_once("../cafe/clsall/sl_lv0013.php");
    $mobile = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
    switch ($vfun) {
        case 'add':
        case 'edit':
        case 'delete':
        case 'apr':
        case 'unapr':
            break;
        case 'data':
            $vOutput = $mobile->loadHoaDonRong();
            break;
        default:
            break;
    }
    break;


    case "m_GopBan":
        $idDonHang = $input['idDonHang'] ?? $_POST['idDonHang'] ?? "";
        $idBanGop = $input["idBanGop"] ?? $_POST["idBanGop"] ?? "";
        include_once("../cafe/clsall/sl_lv0013.php");
        $mobile = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'add':
                $objEmp = $mobile->Mb_GopBan($idDonHang, $idBanGop);
                $vOutput = $objEmp;
                break;
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
                break;
            default:

                break;
        }
        break;


    case "Mb_TaoDonHang":
        $idBan = $input['idBan'] ?? $_POST['idBan'] ?? "";
        include_once("../cafe/clsall/sl_lv0013.php");
        $mobile = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'add':
                $objEmp = $mobile->Mb_TaoHoaDon($idBan);
                $vOutput = $objEmp;
                break;
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
                break;
            default:
                break;
        }
        break;

    case "Mb_Ban":
        include_once("../cafe/clsall/sl_lv0009.php");
        $sl_lv0009 = new sl_lv0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'themBan':
                $maBan = trim($input['lv001'] ?? $_POST['lv001'] ?? "");
                $tenBan = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $maKhuVuc = $input['lv004'] ?? $_POST['lv004'] ?? "";
                if ($maBan !== '') {
                    $maBanEsc = sof_escape_string($maBan);
                    $tenBanEsc = sof_escape_string($tenBan);
                    $maKhuVucEsc = sof_escape_string($maKhuVuc);
                    $checkSql = "SELECT 1 FROM sl_lv0009 WHERE lv001='" . $maBanEsc . "' LIMIT 1";
                    $checkResult = db_query($checkSql);
                    if ($checkResult && db_fetch_array($checkResult)) {
                        $vOutput = false;
                        break;
                    }
                    $insertSql = "INSERT INTO sl_lv0009 (lv001, lv002, lv003, lv004, lv005) VALUES ('" . $maBanEsc . "', '" . $tenBanEsc . "', '', '" . $maKhuVucEsc . "', 0)";
                    $vOutput = db_query($insertSql) ? true : false;
                    break;
                }
                $sl_lv0009->lv002 = $tenBan;
                $sl_lv0009->lv004 = $maKhuVuc;
                $vOutput = $sl_lv0009->LV_Insert();
                break;
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
            default:
                break;
        }
        break;


    case "Mb_KhuVuc":
        include_once("../cafe/clsall/sl_lv0008.php");
        $sl_lv0008 = new sl_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'themKhuVuc':
                $sl_lv0008->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                $sl_lv0008->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $sl_lv0008->LV_Insert();
                break;
            case 'suaKhuVuc':
                // $sl_lv0008->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                // $sl_lv0008->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                // $sl_lv0008->LV_Update();
                break;
            case 'xoaKhuVuc':
                // $lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                // $sl_lv0008->LV_Delete($lv001);
                break;
            case 'apr':
            case 'unapr':
                break;
            case 'data':
            default:
                break;
        }
        break;


    case "Mb_LayCthd":
        include_once("../cafe/clsall/sl_lv0009.php");
        $sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'layCtHd':
                $maHd = isset($input['maHd']) ? $input['maHd'] : (isset($_POST['maHd']) ? $_POST['maHd'] : "");
              $sl_lv0014->LV_Insert();
            case 'edit':
            case 'delete':
            case 'apr':
            case 'unapr':
                break;
            case 'data':
            default:
                break;
        }
        break;


    case "Mb_LayCthd_":
        include_once("../cafe/clsall/sl_lv0014.php");
        include_once("../cafe/clsall/sl_lv0013.php");

        $sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        $sl_lv0013 = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');

        switch ($vfun) {
            case 'layCtHd':
                $maHd = isset($input['maHd']) ? $input['maHd'] : (isset($_POST['maHd']) ? $_POST['maHd'] : "");
                $vOutput =  $sl_lv0014->layCthd($maHd);
                break;
            case 'edit':
            case 'delete':
                $maCtHd = isset($input['maCtHd']) ? $input['maCtHd'] : (isset($_POST['maCtHd']) ? $_POST['maCtHd'] : "");
                $vOutput =  $sl_lv0014->xoaCthd($maCtHd);
                break;
            case 'layThongTinHd':
            case 'unapr':
                break;
            case 'capNhatHd':
                $maHd = isset($input['maHd']) ? $input['maHd'] : (isset($_POST['maHd']) ? $_POST['maHd'] : "");
                $vOutput =  $sl_lv0013->capNhatHd($maHd);
            default:
                break;
        }
        break;

    

}
?>