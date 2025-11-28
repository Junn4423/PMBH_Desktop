

<?php
header("Content-Type: application/json; charset=UTF-8");
include("config.php");
include("function.php");

$lvIpClient = $_SERVER['REMOTE_ADDR'];

// Lấy địa chỉ MAC
function getMacAddress($ip) {
    ob_start();
    system("arp -a");
    $output = ob_get_contents();
    ob_clean();

    $pmac = strpos($output, " " . $ip . " ");
    if ($pmac === false) {
        return "Unknown MAC";
    }

    return substr($output, ($pmac + strlen($ip) + 2), 30);
}

$lvmac = getMacAddress($lvIpClient);

// Hàm tạo token ngẫu nhiên
function generateToken($length = 16) {
    return bin2hex(random_bytes($length / 2));
}

// Nhận dữ liệu từ JSON hoặc POST
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
echo "sss";
$vUserName = isset($input['txtUserName']) ? trim($input['txtUserName']) : (isset($_POST['txtUserName']) ? trim($_POST['txtUserName']) : "");
$vPassword = isset($input['txtPassword']) ? trim($input['txtPassword']) : (isset($_POST['txtPassword']) ? trim($_POST['txtPassword']) : "");

$response = ["code" => "", "token" => ""]; // Thêm MAC vào dữ liệu trả về

if (empty($vUserName) || empty($vPassword)) {
    echo json_encode(["error" => "Vui lòng nhập tài khoản và mật khẩu!"]);
    exit();
}

// Kết nối database
$conn = db_connect();
$vUserName = mysqli_real_escape_string($conn, $vUserName);
$vPasswordMd5 = md5($vPassword);

$vsql = "SELECT lv001 FROM lv_lv0007 WHERE (lv001='$vUserName' OR lv006='$vUserName') AND lv005='$vPasswordMd5' AND lv096=0";
$vresult = mysqli_query($conn, $vsql);

if ($vresult && mysqli_num_rows($vresult) > 0) {
    $vrow = mysqli_fetch_assoc($vresult);
    
    $token = generateToken(16);
    $response['code'] = $vrow['lv001'];
    $response['token'] = $token;


    $updateSQL = "UPDATE lv_lv0007 SET lv097='$token', lv098=NOW() WHERE lv001='$vUserName'";
    mysqli_query($conn, $updateSQL);

    // Ghi log đăng nhập
    $vDate = GetServerDate();
    $vTime = GetServerTime();
    Logtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0, $lvIpClient, $lvmac);
} else {
    echo json_encode(["error" => "Sai tài khoản hoặc mật khẩu!"]);
    exit();
}

echo json_encode($response);
?>
