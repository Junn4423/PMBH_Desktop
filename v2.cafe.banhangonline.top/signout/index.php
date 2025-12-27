<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$headers = getallheaders();
$vSOFUserToken = isset($headers['SOF-User-Token']) ? $headers['SOF-User-Token'] : '';
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
ob_start();
system('arp ' . $lvIpClient . ' -a');
$mycom = ob_get_contents();
ob_clean();
ob_start();

$pmac = strpos($mycom, " " . $lvIpClient . " ");
$lvmac = substr($mycom, ($pmac + strlen($lvIpClient) + 2), 30);
$lvmac = trim($lvmac);

// Include CouchDB functions
include("../couchdb_functions.php");

// Lấy dữ liệu từ request
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if ($vXUserToken !== 'CkL3E1E4Tpyj848O') {
    http_response_code(401);
    echo json_encode(array("success" => false, "message" => "Unauthorized"));
    exit();
}

$vUserName = isset($input['txtUserName']) ? $input['txtUserName'] : '';
$vToken = isset($input['txtToken']) ? $input['txtToken'] : '';
$vDeviceType = isset($input['txtDeviceType']) ? trim($input['txtDeviceType']) : 'web';

// Khởi tạo response
$vArLogout = array();
$vArLogout['success'] = false;
$vArLogout['message'] = '';

// Validate input
if ($vUserName == "") {
    $vArLogout['message'] = "Please enter your username!";
    echo json_encode($vArLogout);
    ob_end_flush();
    exit();
}

if ($vToken == "") {
    $vArLogout['message'] = "Please enter your token!";
    echo json_encode($vArLogout);
    ob_end_flush();
    exit();
}

// Lấy thông tin user từ CouchDB để lấy database name
$vKQCouchDB = dangNhap($vUserName, ''); // Không cần check password khi logout
global $couchHost, $couchPort, $couchUser, $couchPass, $couchDB, $vUserTable;
$couchURL = "http://{$couchUser}:{$couchPass}@{$couchHost}:{$couchPort}";
$result = makeCouchRequest("{$couchURL}/{$couchDB}/{$vUserTable}:{$vUserName}");

if ($result['code'] !== 200) {
    $vArLogout['message'] = "User not found in CouchDB";
    echo json_encode($vArLogout);
    ob_end_flush();
    exit();
}

$userData = json_decode($result['body'], true);
$db_mysql = $userData['lv670'];
define("DB_DATABASE", $db_mysql);

include("../config.php");
include("../function.php");

// Verify token theo device type
$tokenField = '';
switch (strtolower($vDeviceType)) {
    case 'mobile':
        $tokenField = 'lv297';
        break;
    case 'web':
        $tokenField = 'lv097';
        break;
    case 'desktop':
        $tokenField = 'lv397';
        break;
    default:
        $vArLogout['message'] = "Device Type not recognized. [Mobile, Web, Desktop]";
        echo json_encode($vArLogout);
        ob_end_flush();
        exit();
}

// Kiểm tra token có hợp lệ không trong MySQL
$vsql = "SELECT * FROM lv_lv0007 WHERE lv001='$vUserName' AND $tokenField='$vToken' AND lv009 NOT IN (2,3)";
$vresult = db_query($vsql);

if (!$vresult || db_num_rows($vresult) == 0) {
    $vArLogout['message'] = "Invalid token or user!";
    echo json_encode($vArLogout);
    ob_end_flush();
    exit();
}

// Xóa token khỏi CouchDB
$removeTokenCouchDB = removeToken($vUserName, $vDeviceType);

// Xóa token khỏi MySQL
$updateField = '';
$dateField = '';
switch (strtolower($vDeviceType)) {
    case 'mobile':
        $updateField = "lv297='', lv298=NOW()";
        break;
    case 'web':
        $updateField = "lv097='', lv098=NOW()";
        break;
    case 'desktop':
        $updateField = "lv397='', lv398=NOW()";
        break;
}

$vsql = "UPDATE lv_lv0007 SET $updateField WHERE lv001='$vUserName'";
$vresult = db_query($vsql);

// Ghi log đăng xuất vào CouchDB
date_default_timezone_set('Asia/Ho_Chi_Minh');
$vDate = date('Y-m-d');
$vTime = date('H:i:s');
logTimeCouchDB($vUserName, $vDate, $vTime, 1, $lvIpClient, $lvmac, $vDeviceType); // status = 1 cho logout

if ($vresult && $removeTokenCouchDB) {
    $vArLogout['success'] = true;
    $vArLogout['message'] = "Logout successful!";
} else {
    $vArLogout['success'] = false;
    $vArLogout['message'] = "Logout failed! Please try again.";
}

echo json_encode($vArLogout);
ob_end_flush();
?>
