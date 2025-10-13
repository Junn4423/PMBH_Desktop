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
require_once("../../clsall/sl_lv0037.php");

/////////////init object//////////////
$mosl_lv0037=new sl_lv0037($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0037');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0054.txt",$plang);
$mosl_lv0037->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0037->ArrPush[0]=$vLangArr[17];
$mosl_lv0037->ArrPush[1]=$vLangArr[18];
$mosl_lv0037->ArrPush[2]=$vLangArr[19];
$mosl_lv0037->ArrPush[3]=$vLangArr[20];
$mosl_lv0037->ArrPush[4]=$vLangArr[21];
$mosl_lv0037->ArrPush[5]=$vLangArr[22];
$mosl_lv0037->ArrPush[6]=$vLangArr[23];
$mosl_lv0037->ArrPush[7]=$vLangArr[24];
$mosl_lv0037->ArrPush[8]=$vLangArr[25];
$mosl_lv0037->ArrPush[9]=$vLangArr[26];
$mosl_lv0037->ArrPush[10]=$vLangArr[27];
$mosl_lv0037->ArrPush[11]=$vLangArr[28];
$mosl_lv0037->ArrPush[12]=$vLangArr[29];
$mosl_lv0037->ArrPush[13]=$vLangArr[30];
$mosl_lv0037->ArrPush[14]=$vLangArr[31];
$mosl_lv0037->ArrPush[15]=$vLangArr[32];
$mosl_lv0037->ArrPush[16]=$vLangArr[33];
$mosl_lv0037->ArrPush[17]=$vLangArr[34];
$mosl_lv0037->ArrPush[18]=$vLangArr[35];
$mosl_lv0037->ArrPush[19]=$vLangArr[36];
$mosl_lv0037->ArrPush[20]=$vLangArr[37];
$mosl_lv0037->ArrPush[21]=$vLangArr[38];
$mosl_lv0037->ArrPush[22]=$vLangArr[39];
$mosl_lv0037->ArrPush[23]=$vLangArr[40];
$mosl_lv0037->ArrPush[24]=$vLangArr[41];
$mosl_lv0037->ArrPush[25]=$vLangArr[42];




$mosl_lv0037->ArrFunc[0]='//Function';
$mosl_lv0037->ArrFunc[1]=$vLangArr[2];
$mosl_lv0037->ArrFunc[2]=$vLangArr[4];
$mosl_lv0037->ArrFunc[3]=$vLangArr[6];
$mosl_lv0037->ArrFunc[4]=$vLangArr[7];
$mosl_lv0037->ArrFunc[5]='';
$mosl_lv0037->ArrFunc[6]='';
$mosl_lv0037->ArrFunc[7]='';
$mosl_lv0037->ArrFunc[8]=$vLangArr[10];
$mosl_lv0037->ArrFunc[9]=$vLangArr[12];
$mosl_lv0037->ArrFunc[10]=$vLangArr[0];
$mosl_lv0037->ArrFunc[11]=$vLangArr[63];
$mosl_lv0037->ArrFunc[12]=$vLangArr[64];
$mosl_lv0037->ArrFunc[13]=$vLangArr[65];
$mosl_lv0037->ArrFunc[14]=$vLangArr[66];

////Other
$mosl_lv0037->ArrOther[1]=$vLangArr[61];
$mosl_lv0037->ArrOther[2]=$vLangArr[62];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$StartDate=$_GET['txtlv002'];
if($StartDate!="") $StartDate=recoverdate($StartDate, $plang);
$EndDate=$_GET['txtlv003'];
if($EndDate!="") $EndDate=recoverdate($EndDate, $plang);
$EmployeeID=$_POST['txtlv005'];

$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0037->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0037');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0037->ListView;
$curPage = $mosl_lv0037->CurPage;
$maxRows =$mosl_lv0037->MaxRows;
$vOrderList=$mosl_lv0037->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0037->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<?php
if($mosl_lv0037->GetView()==1)
{
?>

						<?php echo $mosl_lv0037->LV_BuilListReportStartEndDate($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$EmployeeID,$StartDate,$EndDate);?>
					
<?php
} else {
	include("../permit.php");
}
?>
