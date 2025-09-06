<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/mn_lv0005.php");
$momn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0005');
$strchk=$_GET['ID'];
$slin=$_GET['slin'];
$isqrcode=$_GET['isqrcode'];
if($momn_lv0005->GetView()==1)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
if($isqrcode==1)
	echo $momn_lv0005->LV_BuilQRcode($strar,$slin);
else
	echo $momn_lv0005->LV_BuilBarcode($strar,$slin);
?>
					
<?php
} else {
	include("../mn_lv0005/permit.php");
}
?>
