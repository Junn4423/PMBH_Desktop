<?php
session_start();
$sExport=$_GET['func'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0086.php");

/////////////init object//////////////
$mohr_lv0086=new hr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","HR0192.txt",$plang);
$mohr_lv0086->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0086->ArrPush[0]=$vLangArr[38];
$mohr_lv0086->ArrPush[1]='STT';
$mohr_lv0086->ArrPush[2]=$vLangArr[19];
$mohr_lv0086->ArrPush[3]=$vLangArr[20];
$mohr_lv0086->ArrPush[4]=$vLangArr[21];
$mohr_lv0086->ArrPush[5]=$vLangArr[22];
$mohr_lv0086->ArrPush[6]=$vLangArr[23];
$mohr_lv0086->ArrPush[7]=$vLangArr[24];
$mohr_lv0086->ArrPush[8]=$vLangArr[25];
$mohr_lv0086->ArrPush[9]=$vLangArr[26];
$mohr_lv0086->ArrPush[10]=$vLangArr[27];
$mohr_lv0086->ArrPush[11]=$vLangArr[28];
$mohr_lv0086->ArrPush[12]=$vLangArr[29];
$mohr_lv0086->ArrPush[13]=$vLangArr[30];
$mohr_lv0086->ArrPush[14]=$vLangArr[31];
$mohr_lv0086->ArrPush[15]=$vLangArr[32];
$mohr_lv0086->ArrPush[16]=$vLangArr[33];
$mohr_lv0086->ArrPush[17]=$vLangArr[34];

//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0086->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'hr_lv0086');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0086->lv002=base64_decode($_GET['ID']);
$vFieldList=$mohr_lv0086->ListView;
$curPage = $mohr_lv0086->CurPage;
$maxRows =$mohr_lv0086->MaxRows;
$vOrderList=$mohr_lv0086->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0086->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($mohr_lv0086->GetView()==1)
{
?>

						<?php echo $mohr_lv0086->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
