<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0031.php");
require_once("../../clsall/sl_lv0007.php");
$vlv006=$_GET['lv006'];	
$vDate=GetServerDate();

///////////Init object ///////////////////////////////
$mowh_lv0031=new wh_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$vType=$_GET['Type'];	
switch($vType)
{
	case 'CONTRACT':
		$mowh_lv0031=new wh_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$vReturn=$mowh_lv0031->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
		break;
	case 'RECONTRACT':
		$mowh_lv0031=new wh_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$vReturn=$mowh_lv0031->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
		break;
	case 'WEBTRANSAC':
		$vReturn=$mowh_lv0031->LV_InsertWEB(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv006,$vDate,$mosl_lv0007);
}

///Save object
?>
div3 = document.getElementById('txtlv903');
div3.focus();

