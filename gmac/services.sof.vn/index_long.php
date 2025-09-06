<?php


switch ($vtable) {
    case 'Mb_LayDanhSachKhuVuc':
        include("../cafe/clsall/sl_lv0008.php");
        $mobile = new sl_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
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
        include("../cafe/clsall/sl_lv0008.php");
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

    case "Mb_TongCthd":

        include("../cafe/clsall/sl_lv0013.php");
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


    case "m_GopBan":
        $idDonHang = $input['idDonHang'] ?? $_POST['idDonHang'] ?? "";
        $idBanGop = $input["idBanGop"] ?? $_POST["idBanGop"] ?? "";
        include("../cafe/clsall/sl_lv0013.php");
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
        include("../cafe/clsall/sl_lv0013.php");
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
        include("../cafe/clsall/sl_lv0009.php");
        $sl_lv0009 = new sl_lv0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'themBan':
                $sl_lv0009->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $sl_lv0009->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
                $sl_lv0009->LV_Insert();
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
        include("../cafe/clsall/sl_lv0008.php");
        $sl_lv0008 = new sl_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'themKhuVuc':
                $sl_lv0008->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                $sl_lv0008->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $sl_lv0008->LV_Insert();
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


    case "Mb_LayCthd":
        include("../cafe/clsall/sl_lv0009.php");
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
        include("../cafe/clsall/sl_lv0014.php");
        include("../cafe/clsall/sl_lv0013.php");

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