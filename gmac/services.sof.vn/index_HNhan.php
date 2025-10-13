<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$_SESSION['ERPSOFV2RRight']='admin';
$_SESSION['ERPSOFV2RUserID']='admin';
switch ($vtable) {
	
	// lay loai san pham
	case 'Mb_loaiSanPham':
		include("../cafe/clsall/sl_lv0006.php");
		$sl_lv0006 = new sl_lv0006($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
		
		$lv001 = isset($input['lv001']) ? $input['lv001'] : (isset($_POST['lv001']) ? $_POST['lv001'] : "");
		$lv002 = isset($input['lv002']) ? $input['lv002'] : (isset($_POST['lv002']) ? $_POST['lv002'] : "");
		$lv003 = isset($input['lv003']) ? $input['lv003'] : (isset($_POST['lv003']) ? $_POST['lv003'] : "");
		$lv004 = isset($input['lv004']) ? $input['lv004'] : (isset($_POST['lv004']) ? $_POST['lv004'] : "");
		$lv005 = isset($input['lv005']) ? $input['lv005'] : (isset($_POST['lv005']) ? $_POST['lv005'] : "");
		
		switch ($vfun) {
			case 'add':
				$sl_lv0006->lv001 = $lv001;
				$sl_lv0006->lv002 = $lv002;
				$sl_lv0006->lv003 = $lv003;
				$sl_lv0006->lv004 = $lv004;
				$sl_lv0006->lv005 = $lv005;
				$vOutput = $sl_lv0006->LV_Insert();
				break;
			case 'edit':
				$sl_lv0006->lv001 = $lv001;
				$sl_lv0006->lv002 = $lv002;
				$sl_lv0006->lv003 = $lv003;
				$sl_lv0006->lv004 = $lv004;
				$sl_lv0006->lv005 = $lv005;
				$vOutput = $sl_lv0006->LV_Update();
				break;
			case 'delete':
				$vOutput = $sl_lv0006->LV_Delete("'$lv001'");
				break;
			case 'apr':
			case 'unapr':
			case 'data':
				$vOutput = $sl_lv0006->LoadLoaiSanPham();
				break;
			default:
				break;
		}
		break;

	case 'Mb_sanPham':
		include("../cafe/clsall/sl_lv0007.php");
		$sl_lv0007 = new sl_lv0007('admin', 'admin', 'admin');
		$findID = isset($input['findID']) ? $input['findID'] : (isset($_POST['findID']) ? $_POST['findID'] : "");
		
		$lv001 = isset($input['lv001']) ? $input['lv001'] : (isset($_POST['lv001']) ? $_POST['lv001'] : "");
		$lv002 = isset($input['lv002']) ? $input['lv002'] : (isset($_POST['lv002']) ? $_POST['lv002'] : "");
		$lv003 = isset($input['lv003']) ? $input['lv003'] : (isset($_POST['lv003']) ? $_POST['lv003'] : "");
		$lv004 = isset($input['lv004']) ? $input['lv004'] : (isset($_POST['lv004']) ? $_POST['lv004'] : 0);
		$lv005 = isset($input['lv005']) ? $input['lv005'] : (isset($_POST['lv005']) ? $_POST['lv005'] : "");
		$lv006 = isset($input['lv006']) ? $input['lv006'] : (isset($_POST['lv006']) ? $_POST['lv006'] : "");
		$lv007 = isset($input['lv007']) ? $input['lv007'] : (isset($_POST['lv007']) ? $_POST['lv007'] : "");
		$lv008 = isset($input['lv008']) ? $input['lv008'] : (isset($_POST['lv008']) ? $_POST['lv008'] : 0);
		$lv009 = isset($input['lv009']) ? $input['lv009'] : (isset($_POST['lv009']) ? $_POST['lv009'] : 0);
		$lv010 = isset($input['lv010']) ? $input['lv010'] : (isset($_POST['lv010']) ? $_POST['lv010'] : 0);
		
		switch ($vfun) {
			case 'add':
				$sl_lv0007->lv001 = $lv001;
				$sl_lv0007->lv002 = $lv002;
				$sl_lv0007->lv003 = $lv003;
				$sl_lv0007->lv004 = $lv004;
				$sl_lv0007->lv005 = $lv005;
				$sl_lv0007->lv006 = $lv006;
				$sl_lv0007->lv007 = $lv007;
				$sl_lv0007->lv008 = $lv008;
				$sl_lv0007->lv009 = $lv009;
				$sl_lv0007->lv010 = $lv010;
				$sl_lv0007->lv014 = $lv014;
				$vOutput = $sl_lv0007->LV_Insert();
				break;
			case 'edit':
				$sl_lv0007->lv001 = $lv001;
				$sl_lv0007->lv002 = $lv002;
				$sl_lv0007->lv003 = $lv003;
				$sl_lv0007->lv004 = $lv004;
				$sl_lv0007->lv005 = $lv005;
				$sl_lv0007->lv006 = $lv006;
				$sl_lv0007->lv007 = $lv007;
				$sl_lv0007->lv008 = $lv008;
				$sl_lv0007->lv009 = $lv009;
				$sl_lv0007->lv010 = $lv010;
				$vOutput = $sl_lv0007->LV_Update();
				break;
			case 'delete':
				$result = $sl_lv0007->LV_Delete("'$lv001'");
				// Trả về object với thông tin rõ ràng
				if ($result) {
					$vOutput = [
						'success' => true,
						'message' => 'Xóa sản phẩm thành công'
					];
				} else {
					$vOutput = [
						'success' => false,
						'message' => 'Không thể xóa sản phẩm này vì đã được sử dụng trong hóa đơn hoặc phiếu xuất'
					];
				}
				break;
			case 'apr':
				break;
			case 'unapr':
				break;

			case 'laySanTheoIdLoai':
				$vOutput = $sl_lv0007->LoadSanPhamTheoIdLoai(maLoai: $findID);
				break;
			case 'data':
				$vOutput = $sl_lv0007->MB_LoadAll();
				break;
			case 'updateImageUrl':
				$maSp = isset($input['maSp']) ? $input['maSp'] : (isset($_POST['maSp']) ? $_POST['maSp'] : "");
				$imageUrl = isset($input['imageUrl']) ? $input['imageUrl'] : (isset($_POST['imageUrl']) ? $_POST['imageUrl'] : "");
				$vOutput = $sl_lv0007->UpdateImageUrl($maSp, $imageUrl);
				break;
			case 'uploadImage':
				$maSp = isset($input['maSp']) ? $input['maSp'] : (isset($_POST['maSp']) ? $_POST['maSp'] : "");
				$imageFile = isset($_FILES['imageFile']) ? $_FILES['imageFile'] : null;
				$vOutput = $sl_lv0007->UploadImage($maSp, $imageFile);
				break;
			default:
				break;
		}
		break;

	case 'Mb_Cthd':
		include("../cafe/clsall/sl_lv0014.php");
		$sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
		$idDonHang = isset($input['mahd']) ? $input['mahd'] : (isset($_POST['mahd']) ? $_POST['mahd'] : "");
		$idSp = isset($input['masp']) ? $input['masp'] : (isset($_POST['masp']) ? $_POST['masp'] : "");
		$soLuong = isset($input['soluong']) ? $input['soluong'] : (isset($_POST['soluong']) ? $_POST['soluong'] : "");
		switch ($vfun) {
			case 'themCtHd':
				$objEmps = $sl_lv0014->themCtdh($idDonHang, $idSp, $soLuong);
				$i = 0;
				foreach ($objEmps as $objEmp) {
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
	case 'Mb_thanhtoan':
		include("sl_lv0014.php");
		$sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
			
		// $cusid = isset($input['cusid']) ? $input['cusid'] : (isset($_POST['cusid']) ? $_POST['cusid'] : "");
		$mahd = isset($input['mahd']) ? $input['mahd'] : (isset($_POST['mahd']) ? $_POST['mahd'] : "");
		// $txtlv004 = isset($input['txtlv004']) ? $input['txtlv004'] : (isset($_POST['txtlv004']) ? $_POST['txtlv004'] : "");
		// $txtlv008 = isset($input['txtlv008']) ? $input['txtlv008'] : (isset($_POST['txtlv008']) ? $_POST['txtlv008'] : "");
		// $txtlv010 = isset($input['txtlv010']) ? $input['txtlv010'] : (isset($_POST['txtlv010']) ? $_POST['txtlv010'] : "");
		// $userid = isset($input['userid']) ? $input['userid'] : (isset($_POST['userid']) ? $_POST['userid'] : "");
		switch ($vfun) {
			case 'thanhToan_contract':
				$objEmps = $sl_lv0014->thanhToan('', $mahd, '', '', '', 'admin');
				break;
			default:
				break;
		break;
		}
	}
?>