<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ac_lv0004.php");
require_once("../../clsall/ac_lv0076.php");
require_once("../../clsall/sl_lv0001.php");

$mosl_lv0001=new  sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'SL0001');
$vlCusID=$_GET['CusID'];	
$vType=$_GET['Type'];	
$vHDID=$_GET['HDID'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vlv011=$_GET['lv011'];	
$vlv012=$_GET['lv012'];	;	
$mosl_lv0001->LV_LoadID($vlCusID);
$vDate=GetServerDate();
///////////Init object ///////////////////////////////
if($vHDID!="" && $vHDID!=NULL)
{
$moac_lv0076=new ac_lv0076($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0056');
$vReturn=$moac_lv0076->LV_InsertCAL($vHDID,$_SESSION['ERPSOFV2RUserID'],$vlv005,$vlv006,$vlv011,$vlv012);
///Save object

$moac_lv0004=new ac_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0004');
$moac_lv0004->LV_LoadID($vHDID);
if($moac_lv0004->lv001!='' && $moac_lv0004->lv001!=NULL)
{
?>
div15 = document.getElementById('txtlv815');
div15.value='<?php echo str_replace("'","",$moac_lv0004->lv015);?>';
div11 = document.getElementById('txtlv811');
div11.value='<?php echo str_replace("'","",$moac_lv0004->lv011);?>';
div12 = document.getElementById('txtlv812');
div12.value='<?php echo str_replace("'","",$moac_lv0004->lv012);?>';	
div14 = document.getElementById('txtlv814');
div14.value='<?php echo str_replace("'","",$moac_lv0004->lv014);?>';	
div18 = document.getElementById('txtlv818');
div18.value='<?php echo str_replace("'","",$moac_lv0004->lv018);?>';	
<?php
	if($mosl_lv0001->lv001==NULL || $mosl_lv0001->lv001=='')
	{
		$mosl_lv0001->LV_LoadID($moac_lv0004->lv004);
	}
}
?>
div4 = document.getElementById('txtlv804');
div4.value='<?php echo str_replace("'","",$mosl_lv0001->lv001);?>';
div5 = document.getElementById('txtlv805');
div5.value='<?php echo str_replace("'","",$mosl_lv0001->lv002);?>';
div6 = document.getElementById('txtlv806');
div6.value='<?php echo str_replace("'","",$mosl_lv0001->lv006);?>';
div5.focus();
<?php
}
else
{
	switch($vType)
	{
		case 'EMP':
			require_once("../../clsall/hr_lv0020.php");
			$mohr_lv0020=new  hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
			$mohr_lv0020->LV_LoadID($vlCusID);
			?>
			div5 = document.getElementById('txtlv805');
			div5.value='<?php echo str_replace("'","",$mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002);?>';
			div6 = document.getElementById('txtlv806');
			div6.value='<?php echo str_replace("'","",$mohr_lv0020->lv034.",".$mohr_lv0020->getvaluelink( 'lv032',$mohr_lv0020->lv032));?>';
			<?php
			break;
		case 'CUS':
			require_once("../../clsall/sl_lv0001.php");
			$mosl_lv0001=new  sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
			$mosl_lv0001->LV_LoadID($vlCusID);
			?>
			div5 = document.getElementById('txtlv805');
			div5.value='<?php echo str_replace("'","",$mosl_lv0001->lv002);?>';
			div6 = document.getElementById('txtlv806');
			div6.value='<?php echo str_replace("'","",$mosl_lv0001->lv006);?>';
			<?php
			break;
		case 'SUP':
			require_once("../../clsall/wh_lv0003.php");
			$mowh_lv0003=new  wh_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0003');
			$mowh_lv0003->LV_LoadID($vlCusID);
			?>
			div5 = document.getElementById('txtlv805');
			div5.value='<?php echo str_replace("'","",$mowh_lv0003->lv002);?>';
			div6 = document.getElementById('txtlv806');
			div6.value='<?php echo str_replace("'","",$mowh_lv0003->lv006);?>';
			<?php
			break;
			
	}
}
