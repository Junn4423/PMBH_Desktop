<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
$headers = getallheaders();
if (isset($headers['SOF-User-Token'])) {
    $vSOFUserToken = $headers['SOF-User-Token'];
	$vSOFUser = $headers['SOFUser'];
	$vSOFToken = $headers['SOFToken'];
} else {
    echo json_encode(array("success" => false, "message" => "Admin contact"));
	exit();
}
if($vSOFUserToken!='SOF2025DEVELOPER') 
{
	echo json_encode(array("success" => false, "message" => "Unauthorized"));
	exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	http_response_code(204);
	exit();
}
///  Muc tieu la cac thiet bi do token dua vao ham doi de signout thiet bi do _  ben couchdb co bang chua token can signout
// Lay thong tin thiet bi tu header