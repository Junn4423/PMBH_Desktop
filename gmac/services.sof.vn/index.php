<?php
// Tắt warnings và notices
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
// Cho phép từ mọi origin (hoặc cụ thể origin nếu muốn)
header("Access-Control-Allow-Origin: *");
// Cho phép các phương thức
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// Cho phép các header custom (như Content-Type)
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Nếu là request OPTIONS (preflight), trả về sớm
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	http_response_code(200);
	exit();
}
session_start();

header(header: "Content-Type: application/json; charset=UTF-8");
include("config.php");
include("function.php");
include("lv_controler.php");


$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
$vtable = isset($input['table']) ? $input['table'] : (isset($_POST['table']) ? $_POST['table'] : "");
$vfun = isset($input['func']) ? $input['func'] : (isset($_POST['func']) ? $_POST['func'] : "");

$vlimit = isset($input['limit']) ? $input['limit'] : (isset($_POST['limit']) ? $_POST['limit'] : "");
$vmonth = isset($input['month']) ? $input['month'] : (isset($_POST['month']) ? $_POST['month'] : "");
$vyear = isset($input['year']) ? $input['year'] : (isset($_POST['year']) ? $_POST['year'] : "");

// $vcode = isset($input['code']) ? $input['code'] : (isset($_POST['code']) ? $_POST['code'] : "");
// $vtoken = isset($input['token']) ? $input['token'] : (isset($_POST['token']) ? $_POST['token'] : "");

$vOutput = array();

switch ($vtable) {

	// case dùng để cho xử lý bàn 
	case "sl_lv0009":
		include("sl_lv0009.php");
		$sl_lv0009 = new sl_lv0009($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case 'loadBan':
				$vOutput = $sl_lv0009->LoadBan();
				break;
			case 'themBan':
				$sl_lv0009->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$sl_lv0009->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$vOutput = $sl_lv0009->LV_Insert();
				break;
			case 'suaBan':
				$maBan = $input['maBan'] ?? $_POST['maBan'] ?? "";
				$sl_lv0009->lv001 = $maBan;
				$sl_lv0009->lv002 = $input['tenBan'] ?? $_POST['tenBan'] ?? "";
				$sl_lv0009->lv004 = $input['maKhuVuc'] ?? $_POST['maKhuVuc'] ?? "";
				$vOutput = $sl_lv0009->LV_Update();
				break;
			case 'xoaBan':
				$maBan = $input['maBan'] ?? $_POST['maBan'] ?? "";
				$vOutput = $sl_lv0009->LV_Delete("'$maBan'");
				break;
			default:
				break;
		}
		break;
	// case dùng để xử lý khu vực
	case "sl_lv0008":
		include("sl_lv0008.php");
		$sl_lv0008 = new sl_lv0008('admin', 'admin', 'admin');
		switch ($vfun) {
			case 'loadKhuVuc':
				$vOutput = $sl_lv0008->LoadKhuVuc();
				break;
			case 'themKhuVuc':
				$sl_lv0008->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$sl_lv0008->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$vOutput = $sl_lv0008->LV_Insert();
				break;
			case 'suaKhuVuc':
				$sl_lv0008->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                $sl_lv0008->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
                $vOutput = $sl_lv0008->LV_Update();
				break;
			case 'xoaKhuVuc':
				$lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
                $vOutput = $sl_lv0008->LV_Delete($lv001);
				break;
			default:
				break;
		}
		break;
	
	// case dùng để xử lý đơn vị
	case "sl_lv0005":
		include("../cafe/clsall/sl_lv0005.php");
		$sl_lv0005 = new sl_lv0005('admin', 'admin', 'admin');
		switch ($vfun) {
			case 'loadDonVi':
				$vOutput = $sl_lv0005->LoadDonVi();
				break;
			case 'themDonVi':
				$sl_lv0005->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$sl_lv0005->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$sl_lv0005->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$vOutput = $sl_lv0005->LV_Insert();
				break;
			case 'suaDonVi':
				$sl_lv0005->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$sl_lv0005->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$sl_lv0005->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$vOutput = $sl_lv0005->LV_Update();
				break;
			case 'xoaDonVi':
				$maDonVi = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$vOutput = $sl_lv0005->LV_Delete("'$maDonVi'");
				break;
			default:
				break;
		}
		break;

	// case dùng để xử lý hoá đơn
	case "sl_lv0013":
		include("sl_lv0013.php");
		$sl_lv0013 = new sl_lv0013($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Sl0201');

		switch ($vfun) {
			case 'loadTrangThaiBanTheoHoaDon':
				$vOutput = $sl_lv0013->loadTrangThaiBanTheoHoaDon();
				break;
			case 'gopBan':
				$idDonHang = $input['maHoaDon'] ?? $_POST['maHoaDon'] ?? "";
				$idBanGop = $input["idBanGop"] ?? $_POST["idBanGop"] ?? "";
				$vOutput = $sl_lv0013->l_gopBan($idDonHang, $idBanGop);
				break;
			case 'tachBan':
				$idDonHang = $input['maHoaDon'] ?? $_POST['maHoaDon'] ?? "";
				$vOutput = $sl_lv0013->tachBan($idDonHang);
				break;

			case 'chuyenBan':
				$idDonHangBanCanChuyen = $input['maHoaDonBanCanChuyen'] ?? $_POST['maHoaDonBanCanChuyen'] ?? "";
				$idDonHangBanChuyen = $input['maHoaDonBanChuyen'] ?? $_POST['maHoaDonBanChuyen'] ?? "";
				$maBanChuyen = $input['maBanChuyen'] ?? $_POST['maBanChuyen'] ?? "";
				$vOutput = $sl_lv0013->chuyenBan($idDonHangBanCanChuyen, $idDonHangBanChuyen, $maBanChuyen);

			case 'taoHoaDon':
				$maBan = $input['maBan'] ?? $_POST['maBan'] ?? "";
				$vOutput = $sl_lv0013->taoHoaDon(maBan: $maBan);
				break;


			case 'capNhatHoaDon2':
				$maHd = $input['maHd'] ?? $_POST['maHd'] ?? "";
				$trangThai = $input['trangThai'] ?? $_POST['trangThai'] ?? "";
				$vOutput = $sl_lv0013->capNhatHdV2($maHd, $trangThai);
				break;
			case 'capNhatHoaDonTT4':
				$maHd = $input['maHd'] ?? $_POST['maHd'] ?? "";
				$trangThai = $input['trangThai'] ?? $_POST['trangThai'] ?? "";
				$vOutput = $sl_lv0013->capNhatHdtt4($maHd, $trangThai);
				break;


			case 'chuyenXuongBep':
				$maHd = $input['maHd'] ?? $_POST['maHd'] ?? "";
				$userId = $input['userId'] ?? $_POST['userId'] ?? "AD001";
				$vOutput = $sl_lv0013->chuyenXuongBep($maHd, $userId);
				break;
			case 'chuyenMonAn':
				$input1 = json_decode(file_get_contents("php://input"), true);
				$dsChiTietMonAn = $input1['dsChiTietMonAn'] ?? [];
				$maBanChuyen = $input1['maBanChuyen'] ?? "";

				if (!is_array($dsChiTietMonAn)) {
					$dsChiTietMonAn = json_decode($dsChiTietMonAn, true);
				}
				$vOutput = $sl_lv0013->chuyenMonAn($dsChiTietMonAn, $maBanChuyen);
				break;

			case 'huyHoaDon':
				$maHd = $input['maHd'] ?? $_POST['maHd'] ?? "";
				$vOutput = $sl_lv0013->huyHoaDon($maHd);
				break;

			default:
				break;
		}
		break;

	case "sl_lv0014":
		include("sl_lv0014.php");
		$sl_lv0014 = new sl_lv0014($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case 'taoCtHd':

				$maHoaDon = $input['maHd'] ?? $_POST['maHoaDon'] ?? "";
				$maSp = $input['maSp'] ?? $_POST['maSp'] ?? "";
				$soLuong = $input['soLuong'] ?? $_POST['soLuong'] ?? "";
				$vOutput = $sl_lv0014->taoCtHd($maHoaDon, $maSp, $soLuong);
				break;
			case 'loadCtHd':
				$maHoaDon = $input['maHd'] ?? $_POST['maHoaDon'] ?? "";
				$vOutput = $sl_lv0014->layCthd($maHoaDon);
				break;
			case 'xoaCthd':
				$maCt = $input['maCt'] ?? $_POST['maCt'] ?? "";
				$vOutput = $sl_lv0014->xoaCthd($maCt);
				break;


			case 'loadCtHdV2':
				$maHoaDon = $input['maHd'] ?? $_POST['maHoaDon'] ?? "";
				$vOutput = $sl_lv0014->layCthdV2($maHoaDon);
				break;




			default:
				break;
		}
		break;


	case "sl_lv0006":
		include("sl_lv0006.php");
		$sl_lv0006 = new sl_lv0006($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "loadDanhMucSp":
				$vOutput = $sl_lv0006->LoadDanhMucSp();
				break;
		}

		break;


	case "sl_lv0007":
		include("sl_lv0007.php");
		$sl_lv0007 = new sl_lv0007($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "loadSanPhamTheoDmSp":
				$maDm = $input['maDm'] ?? $_POST['maDm'] ?? "";
				$vOutput = $sl_lv0007->loadSanPhamTheoDmSp($maDm);
				break;
			case "loadSanPhamTheoKho":
				$maKho = $input['maKho'] ?? $_POST['maKho'] ?? "";
				$objEmp = $sl_lv0007->layDsSpTheoMaKho($maKho);
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





		}
		break;


	case "wh_lv0001":
		include("wh_lv0001.php");
		$wh_lv0001 = new wh_lv0001($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "loadKho":
				$objEmp = $wh_lv0001->LV_LoadAll();
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
			case 'themKho':
				$wh_lv0001->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$wh_lv0001->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$wh_lv0001->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$wh_lv0001->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$wh_lv0001->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$wh_lv0001->lv006 = $input['lv006'] ?? $_POST['lv006'] ?? "";
				$wh_lv0001->lv007 = $input['lv007'] ?? $_POST['lv007'] ?? "";
				$wh_lv0001->lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
				$wh_lv0001->LV_Insert();
				break;
			case 'capNhapKho':
				$wh_lv0001->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$wh_lv0001->lv002 = $input['lv002'] ?? $_POST['lv002'] ?? "";
				$wh_lv0001->lv003 = $input['lv003'] ?? $_POST['lv003'] ?? "";
				$wh_lv0001->lv004 = $input['lv004'] ?? $_POST['lv004'] ?? "";
				$wh_lv0001->lv005 = $input['lv005'] ?? $_POST['lv005'] ?? "";
				$wh_lv0001->lv006 = $input['lv006'] ?? $_POST['lv006'] ?? "";
				$wh_lv0001->lv007 = $input['lv007'] ?? $_POST['lv007'] ?? "";
				$wh_lv0001->lv008 = $input['lv008'] ?? $_POST['lv008'] ?? "";
				$wh_lv0001->LV_Update();
				break;
			case 'xoaKho':
				$wh_lv0001->lv001 = $input['lv001'] ?? $_POST['lv001'] ?? "";
				$wh_lv0001->MB_Delete($wh_lv0001->lv001);
				break;
		}
		break;

	case "wh_lv0008":
		include("wh_lv0008.php");
		$wh_lv0008 = new wh_lv0008($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Tc0002');
		switch ($vfun) {
			case "loadPhieuNhap":
				$objEmp = $wh_lv0008->LV_LoadMobil();
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


			case "xoaPhieu":
				$wh_lv0008->lv001 = $input['maPhieu'] ?? $_POST['maPhieu'] ?? "";
				$wh_lv0008->MB_Delete($wh_lv0008->lv001);
				break;

		}
		break;


	// dang ky khach hang
	case "sl_lv0001":
		switch ($vfun) {
			case "themKhachHang":

				$tenKh = $input['tenKh'] ?? $_POST['tenKh'] ?? "";
				$tenCty = $input['tenCty'] ?? $_POST['tenCty'] ?? "";
				$sdt = $input['sdt'] ?? $_POST['sdt'] ?? "";
				$email = $input['email'] ?? $_POST['email'] ?? "";
				$viTriCv = $input['viTriCv'] ?? $_POST['viTriCv'] ?? "";
				$khuVuc = $input['khuVuc'] ?? $_POST['khuVuc'] ?? "";
				$quyMoNhanSu = $input['quyMoNhanSu'] ?? $_POST['quyMoNhanSu'] ?? "";
				$dsPhanMem = $input['dsPhanMem'] ?? $_POST['dsPhanMem'] ?? "";

				$dsPhanMemStr = implode(',', $dsPhanMem);
				$success = true; // Biến để theo dõi trạng thái thực hiện
				$errorMessage = '';
				$maKhachHang = 'Kh' . strtoupper(uniqid());
				$ngayHienTai = date('Y-m-d H:i:s'); // lay ngay

				$lvsql = "INSERT INTO sl_lv0001 (
					lv001, lv003, lv002, lv010, lv015, lv111, lv112,lv113, lv024, lv114
				) VALUES (
					'$maKhachHang', '$tenKh', '$tenCty', '$sdt', '$email', '$viTriCv', '$khuVuc', '$quyMoNhanSu', '$ngayHienTai', '$dsPhanMemStr'
				)";
				$vReturn = db_query($lvsql);
				if (!$vReturn) {
					$success = false;
					$errorMessage .= "Lỗi tạo khách hàng\n";
				}
				$vOutput = [
					'success' => $success,
					'message' => $email
				];

		}

		break;

	// case dùng để xuất báo cáo bán hàng chi tiết
	case "sl_lv0214":
		include("../clsall/sl_lv0214.php");
		$sl_lv0214 = new sl_lv0214($_SESSION['ERPSOFV2RRight'], $_SESSION['ERPSOFV2RUserID'], 'Sl0201');
		switch ($vfun) {
			case 'xuatBaoCaoBanHang':
				$ngayBatDau = $input['ngayBatDau'] ?? $_POST['ngayBatDau'] ?? "";
				$ngayKetThuc = $input['ngayKetThuc'] ?? $_POST['ngayKetThuc'] ?? "";
				$plang = $input['plang'] ?? $_POST['plang'] ?? 'vi';
				$vArrLang = $input['vArrLang'] ?? $_POST['vArrLang'] ?? [];
				$vOpt = $input['vOpt'] ?? $_POST['vOpt'] ?? 0;
				
				if (empty($ngayBatDau) || empty($ngayKetThuc)) {
					$vOutput = [
						'success' => false,
						'message' => 'Vui lòng cung cấp ngày bắt đầu và ngày kết thúc'
					];
				} else {
					$htmlReport = $sl_lv0214->PrintInOutPutInStockDetail($plang, $vArrLang, $ngayBatDau, $ngayKetThuc, $vOpt);
					$vOutput = [
						'success' => true,
						'data' => $htmlReport,
						'message' => 'Xuất báo cáo bán hàng thành công'
					];
				}
				break;
			default:
				$vOutput = [
					'success' => false,
					'message' => 'Chức năng không tồn tại'
				];
				break;
		}
		break;



}

include("index_KBao.php");
include("index_long.php");
include("index_HNhan.php");
include("index_Cong.php");
include("index_NChung.php");



if ($vfun == 'data') {
	$i = 1;
	echo "[";
	foreach ($vOutput as $vData) {
		if ($i > 1)
			echo ",";
		echo json_encode($vData);

		$i++;
	}
	echo "]";
} else
	echo json_encode($vOutput);