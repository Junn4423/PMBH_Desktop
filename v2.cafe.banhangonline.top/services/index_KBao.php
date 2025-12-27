<?php
//  error_reporting(E_ALL);
//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
switch ($vtable) {
	case 'Mb_Kho':
		include("../cafe/clsall/wh_lv0001.php");
		include("../cafe/clsall/sl_lv0007.php");
		include("../cafe/clsall/wh_lv0020.php");
		$lwh_lv0001 = new wh_lv0001($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		$lsl_lv0007 = new sl_lv0007($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		$lwh_lv0020 = new wh_lv0020($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		echo 'test';
		switch ($vfun) {
			case 'add':
				$lwh_lv0001->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$lwh_lv0001->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$lwh_lv0001->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$lwh_lv0001->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$lwh_lv0001->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$lwh_lv0001->lv006 = $input['lv006'] ?? $_POST['lv006'] ?? "";
				$lwh_lv0001->lv007 = $input['lv007'] ?? $_POST['lv007'] ?? "";
				$lwh_lv0001->lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
				$lwh_lv0001->LV_Insert();
				break;
			case 'edit':
				$lwh_lv0001->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$lwh_lv0001->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$lwh_lv0001->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$lwh_lv0001->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$lwh_lv0001->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$lwh_lv0001->lv006 = $input['lv006'] ?? $_POST['lv006'] ?? "";
				$lwh_lv0001->lv007 = $input['lv007'] ?? $_POST['lv007'] ?? "";
				$lwh_lv0001->lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";

				$lwh_lv0001->LV_Update();
				break;
			case 'delete':
				$lwh_lv0001->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$lwh_lv0001->MB_Delete($lwh_lv0001->lv001);
				break;
			case 'apr':
				break;
			case 'unapr':
				break;
			case 'data':
				$objEmp = $lwh_lv0001->LV_LoadAll();
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"maKho" => $vrow["lv001"],
						"tenCongTy" => $vrow["lv002"],
						"tenKho" => $vrow["lv003"],
						"viTriKho" => $vrow["lv004"],
						"soDt" => $vrow["lv005"],
						"fax" => $vrow["lv006"],
						"maThuKho" => $vrow["lv007"],
						"ghiChu" => $vrow["lv008"],
					];
				}
				break;
			case 'LayNvlTheoMaKho':
				$lwh_lv0001->lv001 = $input['maKho'] ?? $_POST['maKho'] ?? "";
				$objEmp = $lsl_lv0007->mb_layDS_NVL_TheoMaKho($lwh_lv0001->lv001);
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"maSp" => $vrow["lv001"],
						"tenSp" => $vrow["lv002"],
						"loaiSp" => $vrow["lv003"],
						"maDv" => $vrow["lv004"],
						"gia" => $vrow["lv007"],
						"dvGia" => $vrow["lv008"],
						"maKho" => $vrow["lv016"],
					];
				}
				break;
			case "LaySoLuongTonKho":
				$maSP = $input['maSP'] ?? $_POST['maSP'] ?? "";
				$maKho = $input['maKho'] ?? $_POST['maKho'] ?? "";
				$valueTonKho = $lwh_lv0020->LV_Get_slt_nolot_once($maSP, $maKho);
				$vOutput = $valueTonKho;
				break;
				case "LaySoLuongTonKhoNhieuSP":
					$maSPArr = $input['maSP'] ?? $_POST['maSP'] ?? [];
					$maKho = $input['maKho'] ?? $_POST['maKho'] ?? "";
				
					// Đảm bảo $maSPArr là mảng (nếu nhận từ form-data thì cần parse)
					if (!is_array($maSPArr)) {
						$maSPArr = explode(',', $maSPArr); // nếu nhận về dạng chuỗi 'a,b,c'
					}
				
					// Gọi batch cho nhiều mã sản phẩm
					$arrTonKho = $lwh_lv0020->Mb_LaySoLuongTonKhoNhieu($maSPArr, $maKho);
				
					// Xuất kết quả mảng tồn kho
					$vOutput = $arrTonKho;
					break;
			default:
				break;
		}
		break;

	case "Mb_PhieuNhap":
		include("../cafe/clsall/wh_lv0008.php");
		include("../cafe/clsall/wh_lv0009.php");
		//Phieu Nhap
		$vl_wh_lv0008 = new wh_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		//Chi tiet phieu nhap
		$vl_wh_lv0009 = new wh_lv0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case 'add':
				// Tạo phiếu nhập
				$vl_wh_lv0008->lv001 = $vl_wh_lv0008->generateMaPhieuNhap();
				$vl_wh_lv0008->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$vl_wh_lv0008->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$vl_wh_lv0008->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$vl_wh_lv0008->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$vl_wh_lv0008->lv006 = $input['lv006'] ?? $_POST['lv006'] ?? "";
				$vl_wh_lv0008->lv008 = $input["lv008"] ?? $_POST["lv008"] ?? "";
				$vl_wh_lv0008->LV_Insert();

				if (!empty($input['details']) && is_array($input['details'])) {
					foreach ($input['details'] as $detail) {
						$vl_wh_lv0009 = new wh_lv0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
						$vl_wh_lv0009->lv002 = $vl_wh_lv0008->lv001;
						$vl_wh_lv0009->lv003 = $detail['maSanPham'] ?? "";
						$vl_wh_lv0009->lv004 = $detail['soLuong'] ?? "";
						$vl_wh_lv0009->lv005 = $detail['donViTinh'] ?? "";
						$vl_wh_lv0009->lv008 = $detail['gia'] ?? "";
						$vl_wh_lv0009->lv009 = $detail['donViGia'] ?? "";

						$vl_wh_lv0009->MB_Insert();
					}
				}
				break;
			case 'edit':
				break;
			case 'delete':
				$vl_wh_lv0008->lv001 = $input['maPhieu'] ?? $_POST['maPhieu'] ?? "";
				$vl_wh_lv0008->MB_Delete($vl_wh_lv0008->lv001);
				break;
			case 'apr':
				break;
			case 'unapr':
				break;
			case 'data':
				$objEmp = $vl_wh_lv0008->LV_LoadMobil();
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"maPhieuNhap" => $vrow["lv001"],
						"maKho" => $vrow["lv002"],
						"maNguoiDung" => $vrow["lv003"],
						"loaiPhieu" => $vrow["lv005"],
						"maThamChieu" => $vrow["lv006"],
						"trangThai" => $vrow["lv007"],
						"tongTien" => $vrow["lv008"],
						"ngayNhap" => $vrow["lv009"],
						"ghiChu" => $vrow["lv004"]
					];
				}
				break;
			case "LoadPhieuNhap_ByID":
				$vl_wh_lv0008->lv001 = $input['maPhieu'] ?? $_POST['maPhieu'] ?? "";
				$objEmp = $vl_wh_lv0008->LV_LoadID($vl_wh_lv0008->lv001);
				if ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput = [ // không phải mảng nhiều phần tử nữa
						"maPhieuNhap" => $vrow["lv001"],
						"maKho" => $vrow["lv002"],
						"maNguoiDung" => $vrow["lv003"],
						"loaiPhieu" => $vrow["lv005"],
						"maThamChieu" => $vrow["lv006"],
						"trangThai" => $vrow["lv007"],
						"tongTien" => $vrow["lv008"],
						"ngayNhap" => $vrow["lv009"],
						"ghiChu" => $vrow["lv004"]
					];
				}
				break;
			default:
				break;
		}
		break;
	case "Mb_LoaiNguyenLieu":
		include("../cafe/clsall/sl_lv0006.php");
		$lsl_lv0006 = new sl_lv0006( $_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'],'Tc0002');
		switch($vfun)
		{
			case 'add':
				$lsl_lv0006->lv001 = $input['maLoai'] ?? $_POST['lv001'] ?? "";
				$lsl_lv0006->lv002 = $input['moTa'] ?? $_POST['lv002'] ?? "";
				$lsl_lv0006->lv003 = $input['maLoaiCha'] ?? $_POST['lv003'] ?? "";
				$lsl_lv0006->lv004 = $input['trangThai'] ?? $_POST['lv004'] ?? 0;
				$lsl_lv0006->LV_Insert();
				break;
			case 'edit':
				break;
			case 'delete':
				$idLoai = isset($input['idLoai']) ? $input['idLoai'] : (isset($_POST['idLoai']) ? $_POST['idLoai'] : "");
				$lsl_lv0006->MB_Delete($idLoai);
				break;
			case 'data':
				$objEmp = $lsl_lv0006->MB_LoadDanhMucSP();
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"id" => $vrow["lv001"],
						"tenLoai" => $vrow["lv002"],
						"maLoaiCha" => $vrow["lv003"],
						"trangThai" => $vrow["lv004"],
					];
				}
				break;
			case "apr":
				break;
			case "unapr":
					break;
				
		}
		break;
	case "Mb_NguyenLieu":
		include("../cafe/clsall/sl_lv0007.php");
		include("../cafe/clsall/sl_lv0006.php");
		$lsl_lv0007 = new sl_lv0007($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		$lsl_lv0006 = new sl_lv0006($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case 'add':
				{
					$lsl_lv0007->lv001 = $input['maSanPham'] ?? $_POST['lv001'] ?? "";
					$lsl_lv0007->lv002 = $input['tenSanPham'] ?? $_POST['lv002'] ?? "";
					$lsl_lv0007->lv003 = $input['maLoai'] ?? $_POST['lv003'] ?? "";
					$lsl_lv0007->lv004 = $input['donViTinh'] ?? $_POST['lv004'] ?? "";
					$lsl_lv0007->lv005 = $input["donViQuyDoi"] ?? $_POST["lv005"] ??"";
					$lsl_lv0007->lv006 = $input['giaTriQuyDoi'] ?? $_POST['lv006'] ?? "";
					$lsl_lv0007->lv007 = $input['gia'] ?? $_POST['lv007'] ?? 0;
					$lsl_lv0007->lv008 = $input['donViGia'] ?? $_POST['lv008'] ?? "";
					$lsl_lv0007->lv012 = $input['lv012'] ?? $_POST['lv012'] ?? "BQGQ";
					$lsl_lv0007->lv015 = $input["trangThai_HienThiSP"] ?? $_POST["lv015"] ??0;
					$lsl_lv0007->lv016 = $input['maKho'] ?? $_POST['lv016'] ?? "";
					$lsl_lv0007->LV_Insert();
				}
				break;
			case 'edit':

				break;
			case 'delete':
				$lsl_lv0007->lv001 = $input['maNguyenLieu'] ?? $_POST['lv001'] ?? "";
				$lsl_lv0007->MB_Delete($lsl_lv0007->lv001);
				break;
			case 'apr':
				break;
			case 'unapr':
				break;
			case 'data':
				
				break;
			case 'layAllNguyenLieu':
				$objEmp = $lsl_lv0007->LayAllNguyenLieu();
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"maSp" => $vrow["lv001"],
						"tenSp" => $vrow["lv002"],
						"loaiSp" => $vrow["lv003"],
						"maDv" => $vrow["lv004"],
						"gia" => (int) $vrow["lv007"],
						"dvGia" => $vrow["lv008"],
						"maKho" => $vrow["lv016"],
					];
				}
				break;
			case 'getProductByID':
				$lsl_lv0007->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$objEmp = $lsl_lv0007->LV_LoadID($lsl_lv0007->lv001);
				foreach ($objEmp as $key => $value) {
					if (!is_numeric($key)) {
						$vOutput[$key] = $value;
					}
				}
				break;
			case "get_DS_LoaiNVL":
				$objEmp = $lsl_lv0006->MB_Load_NVL();
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"id" => $vrow["lv001"],
						"tenLoai" => $vrow["lv002"],
						"maLoaiCha" => $vrow["lv003"],
						"trangThai" => $vrow["lv004"],
					];
				}
				break;
			case 'layNVLTheoMaLoai':
				$idLoai = isset($input['idLoai']) ? $input['idLoai'] : (isset($_POST['idLoai']) ? $_POST['idLoai'] : "");
				$vOutput = $lsl_lv0007->LoadSanPhamTheoIdLoai(maLoai: $idLoai);
				break;
			case 'add_SP':
				{
					$lsl_lv0007->lv001 = $input['maSanPham'] ?? $_POST['lv001'] ?? "";
					$lsl_lv0007->lv002 = $input['tenSanPham'] ?? $_POST['lv002'] ?? "";
					$lsl_lv0007->lv003 = $input['maLoai'] ?? $_POST['lv003'] ?? "";
					$lsl_lv0007->lv004 = $input['donViTinh'] ?? $_POST['lv004'] ?? "";
					$lsl_lv0007->lv005 = $input["donViQuyDoi"] ?? $_POST["lv005"] ??"";
					$lsl_lv0007->lv006 = $input['giaTriQuyDoi'] ?? $_POST['lv006'] ?? "";
					$lsl_lv0007->lv007 = $input['gia'] ?? $_POST['lv007'] ?? 0;
					$lsl_lv0007->lv008 = $input['donViGia'] ?? $_POST['lv008'] ?? "";
					$lsl_lv0007->lv012 = $input['lv012'] ?? $_POST['lv012'] ?? "BQGQ";
					$lsl_lv0007->lv015 = $input["trangThai_HienThiSP"] ?? $_POST["lv015"] ??1;
					$lsl_lv0007->lv016 = $input['maKho'] ?? $_POST['lv016'] ?? "";
					$lsl_lv0007->LV_Insert();
				}
				break;
			default:

				break;
		}
		break;


	case "Mb_ChiTietPhieuNhap":
		include("../cafe/clsall/wh_lv0009.php");
		//Chi tiet phieu nhap
		$vl_wh_lv0009 = new wh_lv0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
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
			case 'data':
				$vl_wh_lv0009->lv002 = $input['maPhieu'] ?? $_POST['maPhieu'] ?? "";
				$objEmp = $vl_wh_lv0009->MB_LoadID($vl_wh_lv0009->lv002);
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"maSanPham" => $vrow["lv003"],
						"soLuong" => $vrow["lv004"],
						"donViTinh" => $vrow["lv005"],
						"gia" => $vrow["lv008"],
						"donViGia" => $vrow["lv009"],
						"ngayBan" => $vrow["lv016"],
					];
				}
				break;
			default:
				break;
		}
		break;


	case "Mb_PhieuXuat":
		include("../cafe/clsall/wh_lv0010.php");
		include("../cafe/clsall/wh_lv0011.php");
		$vl_wh_lv0010 = new wh_lv0010($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		$vl_wh_lv0011 = new wh_lv0011($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case 'add':
				// Tạo phiếu xuất
				$vl_wh_lv0010->lv001 = $vl_wh_lv0010->generateMaPhieuXuat();
				$vl_wh_lv0010->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$vl_wh_lv0010->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$vl_wh_lv0010->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$vl_wh_lv0010->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$vl_wh_lv0010->lv006 = $input['lv006'] ?? $_POST['lv006'] ?? "";
				$vl_wh_lv0010->lv007 = $input['lv007'] ?? $_POST['lv007'] ?? "";
				$vl_wh_lv0010->lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
				$vl_wh_lv0010->lv009 = $input['lv009'] ?? $_POST['lv009'] ?? "";
				$vl_wh_lv0010->lv010 = $input['lv010'] ?? $_POST['lv010'] ?? "";
				$vl_wh_lv0010->lv011 = $input["lv011"] ?? $_POST["lv011"] ?? "";
				$vl_wh_lv0010->LV_Insert();
				if (!empty($input['details']) && is_array($input['details'])) {
					foreach ($input['details'] as $detail) {
						$vl_wh_lv0011 = new wh_lv0011($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
						$vl_wh_lv0011->lv002 = $vl_wh_lv0010->lv001;
						$vl_wh_lv0011->lv003 = $detail['maSanPham'] ?? "";
						$vl_wh_lv0011->lv004 = $detail['soLuong'] ?? "";
						$vl_wh_lv0011->lv005 = $detail['donViTinh'] ?? "";
						$vl_wh_lv0011->lv008 = $detail['gia'] ?? "";
						$vl_wh_lv0011->lv009 = $detail['donViGia'] ?? "";
						$vl_wh_lv0011->MB_Insert();
					}
				}
				break;
			case 'edit':
				break;
			case 'delete':
				$vl_wh_lv0010->lv001 = $input['maPhieu'] ?? $_POST['maPhieu'] ?? "";
				$vl_wh_lv0010->MB_Delete($vl_wh_lv0010->lv001);
				break;
			case 'apr':
				break;
			case 'unapr':
				break;
			case 'data':
				$objEmp = $vl_wh_lv0010->MB_LoadALL();
				while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput[] = [
						"maPhieuXuat" => $vrow["lv001"] ?? '',
						"maKho" => $vrow["lv002"] ?? '',
						"maNguoiDung" => $vrow["lv003"] ?? '',
						"chuDe" => $vrow["lv004"] ?? '',
						"nguonXuat" => $vrow["lv005"] ?? 'XUATKHO',
						"maThamChieu" => $vrow["lv006"] ?? '',
						"trangThai" => $vrow["lv007"] ?? '0',
						"ghiChu" => $vrow["lv008"] ?? '',
						"ngayXuat" => $vrow["lv009"] ?? '',
						"HinhThucXuat" => $vrow["lv010"] ?? 'Xuất kho',
						"NguoiNhanKho" => $vrow["lv011"] ?? '',
					];
				}

				break;
			case "LoadPhieuXuat_ByID":
				$vl_wh_lv0010->lv001 = $input['maPhieu'] ?? $_POST['lv001'] ?? "";
				$objEmp = $vl_wh_lv0010->LV_LoadID_($vl_wh_lv0010->lv001);
				if ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
					$vOutput = [ // không phải mảng nhiều phần tử nữa
						"maPhieuXuat" => $vrow["lv001"] ?? '',
						"maKho" => $vrow["lv002"] ?? '',
						"maNguoiDung" => $vrow["lv003"] ?? '',
						"chuDe" => $vrow["lv004"] ?? '',
						"nguonXuat" => $vrow["lv005"] ?? 'XUATKHO',
						"maThamChieu" => $vrow["lv006"] ?? '',
						"trangThai" => $vrow["lv007"] ?? '0',
						"ghiChu" => $vrow["lv008"] ?? '',
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
		case "Mb_ChiTietPhieuXuat":
			include("../cafe/clsall/wh_lv0011.php");
			//Chi tiet phieu xuat
			$vl_wh_lv0011 = new wh_lv0011( $_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
			switch($vfun)
					{
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
						case 'data':
							$vl_wh_lv0011->lv002 = $input['maPhieu'] ?? $_POST['maPhieu'] ?? "";
							$objEmp = $vl_wh_lv0011->MB_LoadID($vl_wh_lv0011->lv002);
							while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
								$vOutput[] = [
									"maSanPham" => $vrow["lv003"],
									"soLuong" => $vrow["lv004"],
									"donViTinh" => $vrow["lv005"],
									"gia" => $vrow["lv008"],
									"donViGia" => $vrow["lv009"],
									"ngayBan" => $vrow["lv016"],
								];
							}
							break;
		
						default:
							break;
					}
			break;

			case "Mb_KiemKho":
				include("../cafe/clsall/wh_lv0004.php");
				include("../cafe/clsall/wh_lv0005.php");
				$vl_wh_lv0004= new wh_lv0004($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');	
				$vl_wh_lv0005= new wh_lv0005($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');	
				switch($vfun)
				{
					case 'add':
						// Tạo phiếu kiểm
						$vl_wh_lv0004->lv001 = $vl_wh_lv0004->generateMaPhieuKiem();
						$vl_wh_lv0004->lv002 = $input['maKho'] ?? $_POST['lv002'] ?? "";
						$vl_wh_lv0004->lv003 = $input['maNhanVien'] ?? $_POST['lv003'] ?? "";
						$vl_wh_lv0004->lv004 = $input['chuDe'] ?? $_POST['lv004'] ?? "";
						$vl_wh_lv0004->lv006 = $input['ghiNhan'] ?? $_POST['lv006'] ?? "";
						$vl_wh_lv0004->lv007 = $input['trangThai'] ?? $_POST['lv007'] ?? "";
						$vl_wh_lv0004->LV_Insert();
							break;
					case 'edit':
						
						break;
					case 'delete':
						$vl_wh_lv0004->lv001 = $input['maPhieuKiem'] ?? $_POST['lv001'] ?? "";
						$vl_wh_lv0004->MB_Delete($vl_wh_lv0004->lv001);
						break;
						case 'apr':
							break;
					case 'unapr':
						break;
					case 'data':
						$objEmp = $vl_wh_lv0004->MB_LoadAll();
						while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
							$vOutput[] = [
								'maKiemKho' => $vrow['lv001'],
								'maKho'  =>$vrow['lv002'],
								'maNguoiDung'=> $vrow['lv003'],
								'chuDe'=> $vrow['lv004'],
								'ghiNhan' => $vrow['lv006'] ,
								'trangThai' => $vrow['lv007'] ,
							];
						}
						break;
					case 'layDanhSachPhieuKiemTheoKho':
						$vl_wh_lv0004->lv002 = $input['maKho'] ?? $_POST['lv002'] ?? '';
						$objEmp = $vl_wh_lv0004->MB_Load($vl_wh_lv0004->lv002);
						while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
							$vOutput[] = [
								'maKiemKho' => $vrow['lv001'],
								'maKho'  =>$vrow['lv002'],
								'maNguoiDung'=> $vrow['lv003'],
								'chuDe'=> $vrow['lv004'],
								'ghiNhan' => $vrow['lv006'] ,
								'trangThai' => $vrow['lv007'] ,
								'ngayKiem' => $vrow['lv005'] ,
							];
						}
						break;
					case 'chinhSuaTrangThai_PK':
						$listPK = array_map(function ($maPK) {
						 return "'" . $maPK . "'";
						}, $input['dsMaPK']);
						 
						$strPK = implode(',', $listPK);
						$vl_wh_lv0004->LV_Aproval($strPK); 
						break; 
					case 'layThongTinPhieuKiemByID':
						$vl_wh_lv0004->lv001 = $input['maPK'] ?? $_POST['lv001'] ?? "";
						$objEmp = $vl_wh_lv0004->MB_LoadByID($vl_wh_lv0004->lv001);
						if ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
							$vOutput = [
								'maKiemKho' => $vrow['lv001'],
								'maKho'  =>$vrow['lv002'],
								'maNguoiDung'=> $vrow['lv003'],
								'chuDe'=> $vrow['lv004'],
								'ghiNhan' => $vrow['lv006'] ,
								'trangThai' => $vrow['lv007'] ,
								'ngayKiem' => $vrow['lv005'] ,
							];
						}
						break;
					default:
					
						break;
				}
				break;
				
			case "Mb_ChiTietPK":
				include("../cafe/clsall/wh_lv0004.php");
				include("../cafe/clsall/wh_lv0005.php");
				$vl_wh_lv0004= new wh_lv0004($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');	
				$vl_wh_lv0005= new wh_lv0005($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');	
				switch($vfun)
				{
					case 'add':
							// Tạo chi tiết phiếu kiểm
							{
								$vl_wh_lv0005 = new wh_lv0005( $_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
								$vl_wh_lv0005->lv002 = $input['maKiemKho']  ?? $_POST['lv002'] ?? "";
								$vl_wh_lv0005->lv003 = $input['maSanPham']  ?? $_POST['lv003'] ?? "";
								$vl_wh_lv0005->lv004 = $input['slPM']  ?? $_POST['lv004'] ?? "";
								$vl_wh_lv0005->lv009 = $input['donViKiem']  ?? $_POST['lv009'] ?? "";
								$vl_wh_lv0005->lv008 = $input['soLuongThucTe']  ?? $_POST['lv008'] ?? "";
								$vl_wh_lv0005->lv007 = $input['donViTT']  ?? $_POST['lv007'] ?? "";
								$vl_wh_lv0005->MB_Insert(); 
							}
							break;
					case 'edit':
						{
							echo "edit";
							$vl_wh_lv0005 = new wh_lv0005( $_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
							$vl_wh_lv0005->lv002 = $input['maKiemKho']  ?? $_POST['lv002'] ?? "";
							$vl_wh_lv0005->lv003 = $input['maSanPham']  ?? $_POST['lv003'] ?? "";
							$vl_wh_lv0005->lv008 = $input['soLuongThucTe']  ?? $_POST['lv008'] ?? "";
							$vl_wh_lv0005->lv007 = $input['donViTT']  ?? $_POST['lv007'] ?? "";
							$vl_wh_lv0005->MB_Update(); 
						}
						break;
					case 'delete':
						$vl_wh_lv0005->lv002 = $input['maKiemKho']  ?? $_POST['lv002'] ?? "";
						$vl_wh_lv0005->lv003 = $input["maSanPham"] ??	$_POST["lv003"] ??"";
						$vl_wh_lv0005->MB_Delete($vl_wh_lv0005->lv002,$vl_wh_lv0005->lv003);
						break;
						case 'apr':
							break;
					case 'unapr':
						break;
					case 'data':
						$vl_wh_lv0004->lv001 = $input['maPK'] ?? $_POST['lv001'] ?? "";
						$objEmp = $vl_wh_lv0005->MB_LoadID($vl_wh_lv0004->lv001);
						while ($vrow = db_fetch_array($objEmp, MYSQLI_ASSOC)) {
							$vOutput[] = [
								'maKiemKho' => $vrow['lv002'],
								'maSanPham'  =>$vrow['lv003'],
								'slPM'=> $vrow['lv004'],
								'soLuongThucTe'=> $vrow['lv008'],
								'donViTinh' => $vrow['lv007'] ,
								'soLuongKiem' => $vrow['lv006'] ,
								'donViKiem' => $vrow['lv009'] ,
							];
						}
						break;	
						
					default:
						break;
				}
				break;
}
?>