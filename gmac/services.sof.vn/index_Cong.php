<?php
// error_reporting(E_ALL);	
// ini_set('display_errors', 1);
switch ($vtable) {
    case 'hr_NhanSu':
        include("../cafe/clsall/hr_lv0020.php");
        include("../cafe/clsall/lv_lv0004.php");
        $mobile = new hr_lv0020($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
        switch ($vfun) {
            case 'add':
                $mobile->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                $mobile->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $mobile->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
                $mobile->lv007 = $input['lv007'] ?? $_POST['lv007'] ?? "";
                $mobile->lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
                $mobile->lv009 = $input['lv009'] ?? $_POST['lv009'] ?? "";
                $mobile->lv010 = $input['lv010'] ?? $_POST['lv010'] ?? "";
                $mobile->lv011 = $input['lv011'] ?? $_POST['lv011'] ?? "";
                $mobile->lv017 = $input['lv017'] ?? $_POST['lv017'] ?? "";
                $mobile->lv018 = $input['lv018'] ?? $_POST['lv018'] ?? "";
                $mobile->lv019 = $input['lv019'] ?? $_POST['lv019'] ?? "";
                $mobile->lv020 = $input['lv020'] ?? $_POST['lv020'] ?? "";
                $mobile->lv021 = $input['lv021'] ?? $_POST['lv021'] ?? "";
                $mobile->lv022 = $input['lv022'] ?? $_POST['lv022'] ?? "";
                $mobile->lv023 = $input['lv023'] ?? $_POST['lv023'] ?? "";
                $mobile->lv024 = $input['lv024'] ?? $_POST['lv024'] ?? "";
                $mobile->lv025 = $input['lv025'] ?? $_POST['lv025'] ?? "";
                $mobile->lv031 = $input['lv031'] ?? $_POST['lv031'] ?? "";
                $mobile->lv034 = $input['lv034'] ?? $_POST['lv034'] ?? "";
                $mobile->lv035 = $input['lv035'] ?? $_POST['lv035'] ?? "";
                $mobile->lv036 = $input['lv036'] ?? $_POST['lv036'] ?? "";
                $mobile->lv037 = $input['lv037'] ?? $_POST['lv037'] ?? "";
                $mobile->lv038 = $input['lv038'] ?? $_POST['lv038'] ?? "";
                $mobile->lv039 = $input['lv039'] ?? $_POST['lv039'] ?? "";
                $mobile->lv040 = $input['lv040'] ?? $_POST['lv040'] ?? "";
                $mobile->lv041 = $input['lv041'] ?? $_POST['lv041'] ?? "";
                $mobile->lv042 = $input['lv042'] ?? $_POST['lv042'] ?? "";
                // Thực hiện thêm
                if ($mobile->LV_InsertPersonnel(
                    $mobile->lv001, $mobile->lv002, $mobile->lv005, $mobile->lv007, $mobile->lv008, $mobile->lv009, $mobile->lv010, $mobile->lv011, $mobile->lv017, $mobile->lv018, $mobile->lv019, $mobile->lv020, $mobile->lv021, $mobile->lv022, $mobile->lv023, $mobile->lv024, $mobile->lv025, $mobile->lv031, $mobile->lv034, $mobile->lv035, $mobile->lv036,$mobile->lv037,$mobile->lv038,$mobile->lv039,$mobile->lv040, $mobile->lv041, $mobile->lv042,
                )) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Thêm nhân sự thành công.',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Thêm nhân sự thất bại. Vui lòng thử lại.',
                    ]);
                }
                break;
            case 'edit':
                $mobile->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                $mobile->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $mobile->lv034 = $input['lv034'] ?? $_POST['lv034'] ?? "";
                $mobile->lv035 = $input['lv035'] ?? $_POST['lv035'] ?? "";
                $mobile->lv018 = $input['lv018'] ?? $_POST['lv018'] ?? "";
                $mobile->lv010 = $input['lv010'] ?? $_POST['lv010'] ?? "";
                $mobile->lv011 = $input['lv011'] ?? $_POST['lv011'] ?? "";

                if ($mobile->LV_UpdatePersonnel()) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Sửa nhân sự thành công.',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Sửa nhân sự thất bại. Vui lòng thử lại.',
                    ]);
                }
                break;
            case 'delete':
                $lv001_input = $input['lv001'] ?? $_POST['lv001'] ?? "";

                // Xử lý để tạo danh sách ID an toàn
                if (is_array($lv001_input)) {
                    // Nếu là mảng, xử lý từng phần tử, bọc nháy đơn nếu cần
                    $lv001_clean = array_map(function ($id) {
                        return "'" . addslashes(trim($id)) . "'";
                    }, $lv001_input);
                    $lv001_list = implode(",", $lv001_clean);
                } else {
                    // Nếu là chuỗi, kiểm tra xem có cần thêm nháy không
                    $lv001_input = trim($lv001_input);

                    // Nếu là chuỗi các ID không có nháy → ta thêm nháy
                    if (!str_contains($lv001_input, "'")) {
                        // Tách ra rồi bọc từng ID
                        $parts = explode(",", $lv001_input);
                        $parts = array_map(function ($id) {
                            return "'" . addslashes(trim($id)) . "'";
                        }, $parts);
                        $lv001_list = implode(",", $parts);
                    } else {
                        // Giữ nguyên nếu đã có nháy đơn
                        $lv001_list = $lv001_input;
                    }
                }

                // Gọi hàm xóa
                if (!empty($lv001_list) && $mobile->LV_Delete($lv001_list)) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Xóa nhân sự thành công.',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Xóa nhân sự thất bại. Vui lòng thử lại.',
                    ]);
                }
                break;
            case 'apr':
            case 'status': 
                $vOutput = $mobile->status();
                break;
            case 'nation': 
                $vOutput = $mobile->nation();
                break;
            case 'nationality':
                $vOutput=$mobile->Nationality();
                break;
            case 'religion':
                $vOutput=$mobile->religion();
                break;
            case 'color':
                $vOutput=$mobile->color();
                break;
            case 'unapr':
                break;
            case 'data':
                $objEmp = $mobile->hr_LoadNhanSu();
                $i = 0;
                foreach ($objEmp as $objEmp) {
                    $i++;
                    foreach ($objEmp as $key => $value) {
                        if (!is_numeric($key)) {
                            $vOutput[$i][$key] = $value;
                        }
                    }
                }
                break;
            default:

                break;
        }
    break;
    case 'lv_lv0004':
        include("../cafe/clsall/lv_lv0004.php");
        $lv_lv0004 = new lv_lv0004($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Lv0004');
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'userGroup': 
                // $objEmp = $lv_lv0004->userGroup();
                // $i = 0;
                // foreach ($objEmp as $objEmp) {
                //     $i++;
                //     foreach ($objEmp as $key => $value) {
                //         if (!is_numeric($key)) {
                //             $vOutput[$i][$key] = $value;
                //         }
                //     }
                // }
                $vOutput = $lv_lv0004->userGroup();
                break;
            case 'unapr':
            case 'data':
                
            default:
                break;
        }
    break;
    case 'hr_lv0022':
        include("../cafe/clsall/hr_lv0022.php");
        $hr_lv0022 = new hr_lv0022($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Lv0004');
        switch ($vfun) {
            case 'add':
            case 'edit':
            case 'delete':
            case 'apr':
            case 'status': 
                $vOutput = $hr_lv0022->status();
                break;
            case 'unapr':
            case 'data':
                
            default:
                break;
        }
    break;
}