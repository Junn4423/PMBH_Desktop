<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0031.php");
require_once("../../clsall/sl_lv0007.php");
require_once("../../clsall/wb_lv0016.php");
require_once("../../clsall/hr_lv0020.php");
$vlWHID=$_GET['lv002'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vDate=GetServerDate();
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
	case 'PO':
		///////////Init object ///////////////////////////////
		$mowh_lv0031=new wh_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$vReturn=$mowh_lv0031->LV_InsertPO(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
		///Save object
		break;
	case 'WEBOR':
///////////Init object ///////////////////////////////
		$mowh_lv0031=new wh_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
		$vReturn=$mowh_lv0031->LV_InsertWEB(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv006,$vDate,$mosl_lv0007);
		break;
	case 'WEBTRANSAC':
		$mowh_lv0031=new wh_lv0031($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
		$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
		$mowb_lv0016=new wb_lv0016($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wb0016');
		$vReturn=$mowh_lv0031->LV_InsertWEB(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv006,$vDate,$mosl_lv0007);
		if($vReturn)
		{
			$mowb_lv0016->LV_LoadID($vlv006);
			$mohr_lv0020= new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'wh0020');
			$mohr_lv0020->LV_LoadID($mowb_lv0016->lv003);
			if($mohr_lv0020->lv001==$mowb_lv0016->lv003)
			{
		?>
			div1 = document.getElementById('txtlv811');
			div1.value='<?php echo $mowb_lv0016->lv003;?>';
			alert("Đơn hàng do nhân viên [<?php echo $mohr_lv0020->lv004.' '.$mohr_lv0020->lv003.' '.$mohr_lv0020->lv002;?>] có mã [<?php echo $mowb_lv0016->lv003;?>] giới thiệu");
			
		<?php
			}
		
		}
		break;
///Save object
}
?>
div3 = document.getElementById('txtlv903');
div3.focus();

