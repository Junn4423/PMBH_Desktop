<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0030.php");
$vlWHID=$_GET['lv002'];	
$vlv005=$_GET['lv005'];	
$vlv006=$_GET['lv006'];	
$vDate=GetServerDate();

///////////Init object ///////////////////////////////
$mowh_lv0030=new wh_lv0030($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
$vReturn=$mowh_lv0030->LV_InsertPO(getInfor($_SESSION['ERPSOFV2RUserID'],2),$vlv005,$vlv006,$vlWHID,$vDate);
///Save object

?>
div3 = document.getElementById('txtlv903');
div3.focus();

