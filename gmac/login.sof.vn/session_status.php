<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

ob_start();
include("config.php");
include("function.php");

function sof_get_request_value($input, $key)
{
    if (is_array($input) && array_key_exists($key, $input)) {
        return $input[$key];
    }
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    if (isset($_GET[$key])) {
        return $_GET[$key];
    }
    return null;
}

function sof_hash_equals($expected, $provided)
{
    if ($expected === null || $provided === null) {
        return false;
    }
    if (function_exists('hash_equals')) {
        return hash_equals((string) $expected, (string) $provided);
    }
    return (string) $expected === (string) $provided;
}

function respond_and_exit($payload)
{
    echo json_encode($payload);
    ob_end_flush();
    exit();
}

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

$vCode = trim((string) sof_get_request_value($input, 'code'));
$vToken = trim((string) sof_get_request_value($input, 'token'));

if ($vCode === '' || $vToken === '') {
    respond_and_exit(array(
        'success' => false,
        'valid' => false,
        'message' => 'invalid_request'
    ));
}

$vsql = "select lv097, lv098 from lv_lv0007 where lv001='$vCode' limit 1";
$vresult = db_query($vsql);

if (!$vresult) {
    respond_and_exit(array(
        'success' => false,
        'valid' => false,
        'message' => 'db_error'
    ));
}

$vrow = db_fetch_array($vresult);
if (!$vrow) {
    respond_and_exit(array(
        'success' => false,
        'valid' => false,
        'message' => 'user_not_found'
    ));
}

$vStoredToken = trim((string) $vrow['lv097']);
if ($vStoredToken === '' || !sof_hash_equals($vStoredToken, $vToken)) {
    respond_and_exit(array(
        'success' => false,
        'valid' => false,
        'message' => 'session_conflict',
        'lastActive' => $vrow['lv098']
    ));
}

respond_and_exit(array(
    'success' => true,
    'valid' => true,
    'message' => 'active',
    'lastActive' => $vrow['lv098']
));
?>
