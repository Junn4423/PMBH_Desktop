<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	http_response_code(204);
	exit();
}

// //header("Content-Type: application/json; charset=UTF-8");
// $lvIpClient=$_SERVER['REMOTE_ADDR'];
// ob_start(); // Turn on output buffering
// system('arp '.$lvIpClient.' -a'); //Execute external program to display output
// $mycom=ob_get_contents(); // Capture the output into a variable
// ob_clean(); // Clean (erase) the output buffer
// ob_start();
// include("config.php");
// include("function.php");
// $pmac = strpos($mycom, " ".$lvIpClient." "); // Find the position of Physical text
// $lvmac=substr($mycom,($pmac+strlen($lvIpClient)+2),30); // Get Physical Address
// $vArLogin=Array();
// $vArLogin['code']='';
// $vArLogin['token']='';

// 	$vUserName=$_POST['txtUserName'];
// 	$vToken=$_POST['txtToken'];
// 		if($vUserName=='' || $vUserName==NULL)
// 		{
// 			$vUserName=$_GET['txtUserName'];
//             $vToken=$_GET['txtToken'];
// 		}
// 			$vMessage = "";
// 			$vnum=0;
// 			if($vUserName!="" && $vToken!="")
// 			{
				
// 				$vsql="select * from hr_lv0020 where (lv001='$vUserName' || lv040='$vUserName' || lv039='$vUserName')  and lv197='".$vToken."' and lv196=0 and lv009 not in (2,3)";
// 				$vresult=db_query($vsql);
// 				if($vresult)
// 				{
// 					$vnum=db_num_rows($vresult);
// 				}
// 				if($vnum>0)
// 				{
// 							$vsql="update hr_lv0020 set lv197='',lv198=' ' where lv001='$vUserName'";
// 							$vresult=db_query($vsql);
							
					
// 				} else {
// 					$vMessage = "Signout failed, please try again!";
// 					$vFlagSelect = 1;
// 				}
// 		} else if($vUserName==""){
// 			$vMessage = "Please enter your Signout Name!";
// 		} else if($$vPassword==""){
// 			$vMessage = "Please enter your Token!";
// 			$vFlagFocus = 1;
// 		}
// echo json_encode($vArLogin);
//  ob_end_flush();



// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$lvIpClient = $_SERVER['REMOTE_ADDR'];
ob_start();
system('arp ' . $lvIpClient . ' -a');
$mycom = ob_get_contents();
ob_clean();
ob_start();
include("config.php");
include("function.php");
$pmac = strpos($mycom, " " . $lvIpClient . " ");
$lvmac = substr($mycom, ($pmac + strlen($lvIpClient) + 2), 30);
// Khởi tạo response array
$vArLogin = array();
$vArLogin['success'] = false;
$vArLogin['message'] = '';
$vArLogin['code'] = '';
// Lấy dữ liệu từ các nguồn khác nhau
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

$vUserName = isset($input['txtUserName']) ? $input['txtUserName'] : 
            (isset($_POST['txtUserName']) ? $_POST['txtUserName'] : 
            (isset($_GET['txtUserName']) ? $_GET['txtUserName'] : ""));
            
$vToken = isset($input['txtToken']) ? $input['txtToken'] : 
         (isset($_POST['txtToken']) ? $_POST['txtToken'] : 
         (isset($_GET['txtToken']) ? $_GET['txtToken'] : ""));

// Xử lý logout
if ($vUserName != "" && $vToken != "") {
    
    // Kiểm tra user và token có hợp lệ không
    $vsql="select * from lv_lv0007 where lv001='$vUserName' and lv097='".$vToken."' and lv009 not in (2,3)";
    $vresult = db_query($vsql);       
    if ($vresult) {
        $vnum = db_num_rows($vresult);
       
        if ($vnum > 0) {
            // Logout thành công - xóa token
            $vsql = "UPDATE lv_lv0007 SET lv097='' and lv098=now() where lv001='$vUserName'";
            $vresult = db_query($vsql);
            if ($vresult) {
                $vArLogin['success'] = true;
                $vArLogin['message'] = "Logout successful!";
            } else {
                $vArLogin['success'] = false;
                $vArLogin['message'] = "Logout failed! Database error.";
            }
            
        } else {
            $vArLogin['success'] = false;
            $vArLogin['message'] = "Invalid user or token!";
        }
    } else {
        $vArLogin['success'] = false;
        $vArLogin['message'] = "Database connection error!";
    }
    
} else if ($vUserName == "") {
    $vArLogin['success'] = false;
    $vArLogin['message'] = "Please enter your username!";
} else if ($vToken == "") {
    $vArLogin['success'] = false;
    $vArLogin['message'] = "Please enter your token!";
}

echo json_encode($vArLogin);
ob_end_flush();






 ?>
