<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

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
include("config.php");
include("function.php");

$pmac = strpos($mycom, " " . $lvIpClient . " "); // Find the position of Physical text
$lvmac = substr($mycom, ($pmac + strlen($lvIpClient) + 2), 30); // Get Physical Address

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
// $vUserName=$_POST['txtUserName'];
// $vPassword=$_POST['txtPassword'];
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

$vUserName = isset($input['txtUserName']) ? $input['txtUserName'] : (isset($_POST['txtUserName']) ? $_POST['txtUserName'] : "");
$vPassword = isset($input['txtPassword']) ? $input['txtPassword'] : (isset($_POST['txtPassword']) ? $_POST['txtPassword'] : "");
/*
	if($vUserName=='' || $vUserName==NULL)
	{
		$vUserName=$_GET['txtUserName'];
		$vPassword=$_GET['txtPassword'];
	}*/
$vMessage = "";
$vnum = 0;
if ($vUserName != "" && $vPassword != "") {
	//$vsql = "select * from lv_lv0007 where (lv001='$vUserName' || lv006='$vUserName' )  and lv005='" . md5($vPassword) . "' and lv096=0 ";
	$vsql = "select *,IF(lv095='',1,IF(lv095='$lvIpClient',1,0)) isGood,DATEDIFF(curdate(),lv009) numdate,TIME_TO_SEC(concat(curdate(),' ',curtime())) tos,TIME_TO_SEC(lv009) fros from all_gmacv3_0.lv_lv0007 where lv001='$vUserName' and lv005='" . md5($vPassword) . "' and lv007=0 and ((lv100 like '%cn001%') or lv100='' or ISNULL(lv100))";
	$vresult = db_query($vsql);
	if ($vresult) {
		$vnum = db_num_rows($vresult);
	}
	if ($vnum > 0) {
		$vrow = db_fetch_array($vresult);
		if ($vrow['lv197'] != '' && $vrow['lv197'] != null) { {
				$vArLogin['code'] = $vrow['lv001'];
				$vArLogin['token'] = CodeAutoFill(16);
				$vArLogin['role'] = $vrow['lv900']; // Thêm cột phân quyền
				$vArLogin['chiNhanh'] = $vrow['lv100']; // Them cot Chi nhanh
				$vsql = "update lv_lv0007 set lv097='" . $vArLogin['token'] . "',lv098=now() where lv001='$vUserName'";
				$vresult = db_query($vsql);
				$vDate = GetServerDate();
				$vTime = GetServerTime();
				Logtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0, $lvIpClient, $lvmac);
			}
		} else {

			$vArLogin['code'] = $vrow['lv001'];
			$vArLogin['token'] = CodeAutoFill(16);
			$vArLogin['role'] = $vrow['lv900']; // Thêm cột phân quyền
			$vArLogin['chiNhanh'] = $vrow['lv100']; // Them cot Chi nhanh
			$vsql = "update lv_lv0007 set lv097='" . $vArLogin['token'] . "',lv098=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
			$vresult = db_query($vsql);
			$vDate = GetServerDate();
			$vTime = GetServerTime();
			Logtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0, $lvIpClient, $lvmac);
		}

	} else {
		$vMessage = "Login failed, please try again!";
		$vFlagSelect = 1;
	}
} else if ($vUserName == "") {
	$vMessage = "Please enter your Login Name!";
} else if ($$vPassword == "") {
	$vMessage = "Please enter your Password!";
	$vFlagFocus = 1;
}
echo json_encode($vArLogin);
ob_end_flush();
?>
