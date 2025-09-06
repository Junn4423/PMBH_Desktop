<?php
session_start();
$sExport=$_GET['childfunc'];
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ml_lv0010.php");
require_once("../../clsall/lv_httpdownload.php");
$molv_httpdownload=new lv_httpdownload();
$lvml_lv0010=new ml_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0014');
$lvml_lv0010->lv001=$_GET['ID'];
$lvml_lv0010->LV_LoadID($lvml_lv0010->lv001);
if($lvml_lv0010->lv001==NULL || $lvml_lv0010->lv001=="" || $lvml_lv0010->GetView()<=0) exit;
$molv_httpdownload->set_byurl("../../images/human/File/MailTemp/".$lvml_lv0010->lv002."_".$lvml_lv0010->lv001."/".$lvml_lv0010->lv005);
$molv_httpdownload->download();
?>