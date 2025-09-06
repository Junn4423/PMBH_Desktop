<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0024.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvwh_lv0024=new wh_lv0024($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'SL0002');
$lvwh_lv0024->lv001=$_GET['ID'];
$lvwh_lv0024->LV_LoadID($lvwh_lv0024->lv001);
if($lvwh_lv0024->lv001==NULL || $lvwh_lv0024->lv001=="" || $lvwh_lv0024->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/supplier/".$lvwh_lv0024->lv002."_".$lvwh_lv0024->lv001."/".$lvwh_lv0024->lv006);
$molv_httpdownload->download();
?>