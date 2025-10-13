<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
$lvIpClient = $_SERVER['REMOTE_ADDR'];
ob_start(); // Turn on output buffering
system('arp ' . $lvIpClient . ' -a'); //Execute external program to display output
$mycom = ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer
ob_start();
session_start();
include("soft/config.php");
include("soft/function.php");
require_once("clsall/lv_controler.php");
require_once("clsall/hr_lv0001.php");
$mohr_lv0001 = isset($_SESSION['ERPSOFV2RUserID'])
	? new hr_lv0001(isset($_SESSION['ERPSOFV2RRight']) ? $_SESSION['ERPSOFV2RRight'] : null, $_SESSION['ERPSOFV2RUserID'], 'Ad0001')
	: null;

$pmac = strpos($mycom, " " . $lvIpClient . " "); // Find the position of Physical text
$lvmac = substr($mycom, ($pmac + strlen($lvIpClient) + 2), 30); // Get Physical Address
$vFlag = intval(isset($_POST['txtFlag']) ? $_POST['txtFlag'] : '');
if (isset($_SESSION['ERPSOFV2RUserID']) && !empty($_SESSION['ERPSOFV2RUserID']))
	redirect("soft/?lang=VN");
if (isset($_POST['txtUserName'])) {
	$vUserName = $_POST['txtUserName'];
	$vPassword = $_POST['txtPassword'];
	$vgetopt = $_POST['cboLang'];
	if ($vgetopt == 0)
		$vlang = "EN";
	else
		$vlang = "VN";
	///////////////////////////////////////////////////////////////////////////////////////////////
	if (intval($vFlag) == 1) {
		$vMessage = "";
		$vnum = 0;
		if ($vUserName != "" && $vPassword != "") {

			$vsql = "select *,IF(lv095='',1,IF(lv095='$lvIpClient',1,0)) isGood,DATEDIFF(curdate(),lv009) numdate,TIME_TO_SEC(concat(curdate(),' ',curtime())) tos,TIME_TO_SEC(lv009) fros from all_gmacv3_0.lv_lv0007 where lv001='$vUserName' and lv005='" . md5($vPassword) . "' and lv007=0 and ((lv100 like '%cn001%') or lv100='' or ISNULL(lv100))";
			$vresult = db_query($vsql);
			if ($vresult) {
				$vnum = db_num_rows($vresult);
			}
			$vresult = db_query($vsql);
			if ($vresult) {
				$vnum = db_num_rows($vresult);
			}
			if ($vnum > 0) {
				$vrow = db_fetch_array($vresult);
				if ($vrow['isGood'] == 1 || substr($lvIpClient, 0, 8) == '192.168.1.101') {
					if ($vrow['lv008'] != '' && $vrow['lv008'] != null) {
						if ($vrow['tos'] - $vrow['fros'] < 0 && ($vrow['numdate'] == 0)) {
							$vMessage = "Người dùng khác đã đăng nhập trước (" . ($vrow['tos'] - $vrow['fros']) . "s)!";
						} else {
							$_SESSION['ERPSOFV2RUserID'] = $vrow['lv001'];
							$_SESSION['ERPSOFV2RRight'] = $vrow['lv003'];
							$_SESSION['SOFIP'] = $lvIpClient;
							$_SESSION['SOFMAC'] = $lvmac;
							$_SESSION['SOFONLINE'] = $vrow['lv001'] . "-" . rand(0, 1000);
							$vsql = "update lv_lv0007 set lv008='" . $_SESSION['SOFONLINE'] . "',lv009=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
							$vresult = db_query($vsql);
							$vsql = "update lv_lv0007 set lv095='$lvIpClient' where lv094='$vUserName'";
							$vresult = db_query($vsql);
							$vDate = GetServerDate();
							$vTime = GetServerTime();
							Logtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0, $_SESSION['SOFIP'], $_SESSION['SOFMAC']);
							redirect("soft/?lang=$vlang");
						}
					} else {
						$_SESSION['ERPSOFV2RUserID'] = $vrow['lv001'];
						$_SESSION['ERPSOFV2RRight'] = $vrow['lv003'];
						$_SESSION['SOFIP'] = $lvIpClient;
						$_SESSION['SOFMAC'] = $lvmac;
						$_SESSION['SOFONLINE'] = $vrow['lv001'] . "-" . rand(0, 1000);
						$vsql = "update lv_lv0007 set lv008='" . $_SESSION['SOFONLINE'] . "',lv009=concat(CurDate(),' ',CurTime()) where lv001='$vUserName'";
						$vresult = db_query($vsql);
						$vsql = "update lv_lv0007 set lv095='$lvIpClient' where lv094='$vUserName'";
						$vresult = db_query($vsql);
						$vDate = GetServerDate();
						$vTime = GetServerTime();
						Logtime($_SESSION['ERPSOFV2RUserID'], $vDate, $vTime, 0, $_SESSION['SOFIP'], $_SESSION['SOFMAC']);
						redirect("soft/?lang=$vlang");
					}
				} else {
					$vMessage = "Người dùng không truy cập đúng IP, xin vui lòng login với người được ủy quyền sau [" . $vrow['lv094'] . "] !";
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
	}
} else {

}
///////////////////////////////////////////////////////////////////////////////////////////////

?>
<html>

<head>
	<title>ERP SOF</title>
	<link href="logo.gif" rel="icon" type="image/gif" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<LINK REL="SHORTCUT ICON" HREF="../logo.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	<link rel="stylesheet" href="css/cssverticalmenu.css" type="text/css">
	<script language="javascript" src="javascript/menuhorizontal.js"></script>
</head>
<script language="javascript">
	/*=======================================================================*/
	function setFocus() {
		document.loginForm.txtUserName.focus();
	}
	/*=======================================================================*/
	function Login() {
		var o = document.loginForm;
		o.txtFlag.value = 1;
	}
	/*=======================================================================*/
</script>

<body onload="callscreen1();">
	<center>
		<div id="sof_pages" style="width:400px!important;float:none!important;">
			<div class="sof_pages_header">
				<div class="hd_title">
					<div class="hd_title_left" style="width:200px">
						GMAC COFFEE - CN 1
					</div>
					<div style="float:right;padding-top:20px;padding-right:20px">
						<img width="60" src="images/logo/logo.png" />
					</div>
				</div>
				<div class="hd_subtitle">
					<div class="lvtitle">
						<center>ĐĂNG NHẬP</center>
					</div>
				</div>
			</div>
			<div class="sof_pages_content" style="overflow:hidden;width:360px!important;">
				<center>
					<div style="width:320px!important;">
						<div class="frmlogin">
							<form name="loginForm" method="post" action="" onSubmit="submitForm(); return false;">
								<input type="hidden" name="txtFlag" id="txtFlag" value="">
								<div style="color:red"><?php echo (isset($vMessage) ? $vMessage : ''); ?></div>
								<div class="loginname">
									<input autocomplete="off" class="inputtext" type="text" id="txtUserName"
										name="txtUserName" maxlength="32" tabindex="1"
										onblur="if(this.value == '') {this.value = this.title;};"
										onfocus="this.value = '';" title="Tên đăng nhập" value="Tên đăng nhập">
								</div>
								<div class="loginname">
									<div id="matkhau"
										style="position:absolute;padding-top:5px;padding-left:10px;height:25px"
										onclick="this.style.display='none';document.loginForm.txtPassword.focus();cursor:text">
										<span style=";height:25px">Mật khẩu</span>
									</div>
									<input class="inputtext" type="password" id="txtPassword" name="txtPassword"
										maxlength="50" tabindex="2"
										onfocus="this.value = '';document.getElementById('matkhau').style.display='none'"
										title="Mật khẩu" />
								</div>
								<div class="loginname">
									<div style="float:left;">Ngôn ngữ : </div>
									<div style="float:right;text-align:right"><select name="cboLang" id="cboLang"
											class="selecttext" tabindex="3">
											<option value="1" selected="selected">Vietnamese</option>
										</select>
									</div>
								</div>
								<div class="loginname">
									<div>
										<div style="float:left"><input type="submit" name="Submit" onClick="Login();"
												value="Đăng nhập" class="button" tabindex="4"></div>
										<div style="float:left"><input type="reset" name="clear" value="Nạp lại"
												class="button" tabindex="5"></div>
										<div style="float:right"><a style="color:blue;"
												href="http://localhost/gmac/cn2/">GMAC - CN 2</a></div>
									</div>
									<div style="clear:both">


									</div>
								</div>
							</form>
						</div>
					</div>
				</center>
			</div>
		</div>
		</div>
	</center>
</body>

<form name="frmdatabaseload" method="post">
	<input type="hidden" name="txtFlag" id="txtFlag" value="2">
	<input type="hidden" name="txtDatabase" id="txtDatabase" value="">
</form>
<!-- End Footer -->
<!-- End ImageReady Slices -->
<script language="javascript">
	var o = document.loginForm;
	o.txtUserName.focus();

	function LoadCustomer(customer) {
		var o = document.frmdatabaseload;
		o.txtDatabase.value = customer;
		o.submit();
	}
</script>
<script type="text/javascript">
	var glossymenu = new glossymenu.dd("glossymenu");
	glossymenu.init("glossymenu", "menuhover");
</script>

</html>
<?php ob_end_flush(); ?>