<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ac_lv0034.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvac_lv0034=new ac_lv0034($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0034');
$lvac_lv0034->lv001=$_GET['ID'];
$lvac_lv0034->LV_LoadID($lvac_lv0034->lv001);
if($lvac_lv0034->lv001==NULL || $lvac_lv0034->lv001=="" || $lvac_lv0034->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/contracts/".$lvac_lv0034->lv002."_".$lvac_lv0034->lv001."/".$lvac_lv0034->lv006);
$molv_httpdownload->download();
?>