<?php
session_start();
$sExport=$_GET['childdetailfunc'];
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
require_once("../../clsall/sl_lv0051.php");

/////////////init object//////////////
$mosl_lv0051=new sl_lv0051($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0051');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0012.txt",$plang);
$mosl_lv0051->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0051->ArrPush[0]=$vLangArr[17];
$mosl_lv0051->ArrPush[1]=$vLangArr[18];
$mosl_lv0051->ArrPush[2]=$vLangArr[19];
$mosl_lv0051->ArrPush[3]=$vLangArr[20];
$mosl_lv0051->ArrPush[4]=$vLangArr[21];
$mosl_lv0051->ArrPush[5]=$vLangArr[22];
$mosl_lv0051->ArrPush[6]=$vLangArr[23];
$mosl_lv0051->ArrPush[7]=$vLangArr[24];
$mosl_lv0051->ArrPush[8]=$vLangArr[25];
$mosl_lv0051->ArrPush[9]=$vLangArr[26];
$mosl_lv0051->ArrPush[10]=$vLangArr[27];
$mosl_lv0051->ArrPush[11]=$vLangArr[28];
$mosl_lv0051->ArrPush[12]=$vLangArr[29];
$mosl_lv0051->ArrPush[13]=$vLangArr[30];
$mosl_lv0051->ArrPush[14]=$vLangArr[31];
$mosl_lv0051->ArrPush[15]=$vLangArr[32];
$mosl_lv0051->ArrPush[16]=$vLangArr[33];
$mosl_lv0051->ArrPush[17]=$vLangArr[34];
$mosl_lv0051->ArrPush[18]=$vLangArr[42];
$mosl_lv0051->ArrPush[98]=$vLangArr[43];
$mosl_lv0051->ArrPush[99]=$vLangArr[44];
$mosl_lv0051->ArrFunc[0]='//Function';
$mosl_lv0051->ArrFunc[1]=$vLangArr[2];
$mosl_lv0051->ArrFunc[2]=$vLangArr[4];
$mosl_lv0051->ArrFunc[3]=$vLangArr[6];
$mosl_lv0051->ArrFunc[4]=$vLangArr[7];
$mosl_lv0051->ArrFunc[5]='';
$mosl_lv0051->ArrFunc[6]='';
$mosl_lv0051->ArrFunc[7]='';
$mosl_lv0051->ArrFunc[8]=$vLangArr[10];
$mosl_lv0051->ArrFunc[9]=$vLangArr[12];
$mosl_lv0051->ArrFunc[10]=$vLangArr[0];
$mosl_lv0051->ArrFunc[11]=$vLangArr[36];
$mosl_lv0051->ArrFunc[12]=$vLangArr[37];
$mosl_lv0051->ArrFunc[13]=$vLangArr[38];
$mosl_lv0051->ArrFunc[14]=$vLangArr[39];
$mosl_lv0051->ArrFunc[15]=$vLangArr[40];
////Other
$mosl_lv0051->ArrOther[1]=$vLangArr[31];
$mosl_lv0051->ArrOther[2]=$vLangArr[32];
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
$mosl_lv0051->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0051');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0051->lv002=base64_decode($_GET['ID']);
$vFieldList=$mosl_lv0051->ListView;
$curPage = $mosl_lv0051->CurPage;
$maxRows =$mosl_lv0051->MaxRows;
$vOrderList=$mosl_lv0051->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0051->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mosl_lv0051->GetView()==1)
{
?>

						<?php echo $mosl_lv0051->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
z