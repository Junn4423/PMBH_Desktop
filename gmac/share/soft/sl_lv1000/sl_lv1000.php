<?php
$lvIpClient=$_SERVER['REMOTE_ADDR'];
ob_start(); // Turn on output buffering
if($_GET['ID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0072.php");

$flagID=(int)$_POST["txtFlag"];
if($flagID==1)
{
	$vsql="Update hr_lv0001 set lv099='$lvIpClient' ";
	db_query($vsql);
}
/////////////init object//////////////
$mosl_lv0072=new sl_lv0072($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl1000');
if($mosl_lv0072->GetView()==1)
{
?>
<form action="#" method="post" name="frmchoose" id="frmchoose">
						<input name="txtFlag" type="hidden" id="txtFlag" value="1"/>
						<input type="submit" value="Lấy IP của ADSL" onclick=""/> Chú ý: chỉ click vào khi đứng tại văn phòng có camera, nếu ở ngoài không được click vào
</form>						
<iframe style="width:100%;height:800px" src="http://<?php echo $mosl_lv0072->GetIP();?>:81"></iframe>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='Camera';
</script>
<?php
} else {
	include("$vDir../permit.php");
}
?>
