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
		switch ($vfun) {
			case 'add':
			case 'edit':
			case 'delete':
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
		$sl_lv0007 = new sl_lv0007($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Jo0100');
		$findID = isset($input['findID']) ? $input['findID'] : (isset($_POST['findID']) ? $_POST['findID'] : "");
		switch ($vfun) {
			case 'add':
				break;
			case 'edit':
			break;
			case 'delete':
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