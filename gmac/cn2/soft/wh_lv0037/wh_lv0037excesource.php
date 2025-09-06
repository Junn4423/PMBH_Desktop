<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0040.php");
$vlWHID=$_GET['lv002'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vDate=GetServerDate();
$vType=$_GET['Type'];	
$vlv913=$_GET['lv913'];	
switch($vType)
{
	case 'GMAC':
		$mowh_lv0040=new wh_lv0040($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$vReturn=$mowh_lv0040->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate,$vlv913);
		break;
	case 'TRAHANG':
		$mowh_lv0040=new wh_lv0040($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$vReturn=$mowh_lv0040->LV_InsertCONTRACT(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate,$vlv913);
		break;
	case 'MUAHANG':
		///////////Init object ///////////////////////////////
		$mowh_lv0040=new wh_lv0040($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$vReturn=$mowh_lv0040->LV_InsertPO(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate,$vlv913);
		///Save object
		break;
		
}



?>
div3 = document.getElementById('txtlv903');
div3.focus();

