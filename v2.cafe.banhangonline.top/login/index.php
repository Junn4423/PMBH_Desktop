<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$headers = getallheaders();
// Normalize and safely extract expected headers
$vSOFUserToken = isset($headers['SOF-User-Token']) ? $headers['SOF-User-Token'] : '';
$vSOFUser = isset($headers['SOFUser']) ? $headers['SOFUser'] : '';
$vSOFToken = isset($headers['SOFToken']) ? $headers['SOFToken'] : '';
$vXUserToken = isset($headers['X-User-Token']) ? $headers['X-User-Token'] : '';

if ($vSOFUserToken === '') {
	echo json_encode(array("success" => false, "message" => "Admin contact"));
	exit();
}
if ($vSOFUserToken !== 'SOF2025DEVELOPER') {
	http_response_code(401);
	echo json_encode(array("success" => false, "message" => "Unauthorized"));
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	http_response_code(204);
	exit();
}

$lvIpClient = $_SERVER['REMOTE_ADDR'];

ob_start(); // Turn on output buffering
system('arp ' . $lvIpClient . ' -a'); //Execute external program to display output
$mycom = ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

ob_start();


$pmac = strpos($mycom, " " . $lvIpClient . " "); // Find the position of Physical text
$lvmac = substr($mycom, ($pmac + strlen($lvIpClient) + 2), 30); // Get Physical Address
$lvmac = trim($lvmac); // Remove any spaces
$vArLogin = array();
$vArLogin['code'] = '';
$vArLogin['token'] = '';

function CodeAutoFill($vLen = 10)
{
	$vStrReturn = "";
	for ($i = 1; $i <= $vLen; $i++) {
		$vStrReturn = $vStrReturn . ASCCodeAuto();
	}
	return $vStrReturn;
}

function ASCCodeAuto()
{
	$vcode = rand(1, 3);
	switch ($vcode) {
		case 1:
			return chr(rand(48, 57));
			break;
		case 2:
			return chr(rand(65, 90));
			break;
		default:
			return chr(rand(97, 122));
			break;
	}
}

function save_token_mysql($vUserName, $vToken, $vDeviceType)
{
	switch (strtolower($vDeviceType)) {
		case "web":
			$vsql = "update lv_lv0007 set lv097='" . $vToken . "',lv098=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
			break;

		case "mobile":
			$vsql = "update lv_lv0007 set lv297='" . $vToken . "',lv298=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
			break;

		case "desktop":
			$vsql = "update lv_lv0007 set lv397='" . $vToken . "',lv398=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
			break;

		default:
			return false;
	}
	return db_query($vsql, DB_DATABASE);
}

// $vUserName=$_POST['txtUserName'];
// $vPassword=$_POST['txtPassword'];
include("../couchdb_functions.php");

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
///Dich vu mogo xac nhan dang nhap truoc. Neu ok tha cho token duoc xac nhan di vao truc tiep
$vUserName = $input['txtUserName'];
$vPassword = $input['txtPassword'];
$vDeviceType = $input['txtDeviceType']; // Dung DeviceType de nhan biet loai thiet bi dang nhap
$vMessage = "";
$vnum = 0;
if ($vUserName != "" && $vPassword != "") {
	// Cau hinh thoi gian
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$vDate = date('Y-m-d');
	$vTime = date('H:i:s');
	//CouchDB xu ly login
	$vKQCouchDB = dangNhap($vUserName, $vPassword);

	//Neu thanh cong tra ve token va thong tin user
	$token = $vKQCouchDB['response']['token'];
	
	//Xac dinh loai login Mobile, App Desktop, Web
	//User va Pass dung
	//Kiem tra da login chua. Neu roi hoi dang xuat thiet bi khong?
	//User thuoc dabase mysql
	if ($vKQCouchDB['success']) {
		//Co 1 hang couchdb xac dinh user duoc chay database nao
		$db_mysql = $vKQCouchDB['response']['lv670']; //function doc user => database mysql tu couchdb
		define("DB_DATABASE", $db_mysql);
		
		include("../config.php");
		include("../function.php");
		// $vArLogin['code'] = $vrow['lv001'];
		$vArLogin['code'] = $vUserName;
		$vArLogin['token'] = CodeAutoFill(32);
		$_SESSION['ERPSOFV2RUserID'] = $vUserName;
		$_SESSION['ERPSOFV2RToken'] = $vArLogin['token'];
		// $vArLogin['role'] = $vrow['lv900']; // Thêm cột phân quyền
		// $vArLogin['chiNhanh'] = $vrow['lv100']; // Them cot Chi nhanh
		$vDeviceType = trim($vDeviceType);
		switch (strtolower($vDeviceType)) {
			case "mobile":
				$vCheckToken = saveToken($vUserName, $vArLogin['token'], 'mobile');
				$vArLogin['deviceType'] = strtoupper($vDeviceType[0]) . substr($vDeviceType, 1);
				save_token_mysql($vUserName, $vArLogin['token'], $vDeviceType);

				break;

			case "web":
				$vCheckToken = saveToken($vUserName, $vArLogin['token'], 'web');
				$vArLogin['deviceType'] = strtoupper($vDeviceType[0]) . substr($vDeviceType, 1);
				save_token_mysql($vUserName, $vArLogin['token'], $vDeviceType);

				break;

			case "desktop":
				$vCheckToken = saveToken($vUserName, $vArLogin['token'], 'desktop');
				$vArLogin['deviceType'] = strtoupper($vDeviceType[0]) . substr($vDeviceType, 1);
				save_token_mysql($vUserName, $vArLogin['token'], $vDeviceType);

				break;

			default:
				echo json_encode(array("success" => false, "message" => "Device Type not recognized. [Mobile, Web, Desktop]"));
				exit();
		}


		// Update them CouchDB

		//$vDate = GetServerDate();
		//$vTime = GetServerTime();
		//Logtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0, $lvIpClient, $lvmac);

		//ghi log dang nhap vao couchb
		$vKQCouchDBLoginLog = logTimeCouchDB($vUserName, $vDate, $vTime, 0, $lvIpClient, $lvmac, $vDeviceType);
		// echo json_encode($vKQCouchDBLoginLog);
	} else {
		echo json_encode(array("success" => false, "message" => "CouchDB Service Unavailable"));
		exit();
	}
} else if ($vUserName == "") {
	$vMessage = "Please enter your Login Name!";
} else if ($vPassword == "") {
	$vMessage = "Please enter your Password!";
	$vFlagFocus = 1;
}
if ($vMessage !== "") {
	echo json_encode(array("success" => false, "message" => $vMessage));
} else {
	echo json_encode($vArLogin);
}
ob_end_flush();
