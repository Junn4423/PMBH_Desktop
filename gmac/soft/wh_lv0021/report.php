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
require_once("../../clsall/wh_lv0021.php");

/////////////init object//////////////
$mowh_lv0021=new wh_lv0021($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0021');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0024.txt",$plang);
$mowh_lv0021->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0021->ArrPush[0]=$vLangArr[17];
$mowh_lv0021->ArrPush[1]=$vLangArr[18];
$mowh_lv0021->ArrPush[2]=$vLangArr[19];
$mowh_lv0021->ArrPush[3]=$vLangArr[20];
$mowh_lv0021->ArrPush[4]=$vLangArr[21];
$mowh_lv0021->ArrPush[5]=$vLangArr[22];
$mowh_lv0021->ArrPush[6]=$vLangArr[23];
$mowh_lv0021->ArrPush[7]=$vLangArr[24];
$mowh_lv0021->ArrPush[8]=$vLangArr[25];
$mowh_lv0021->ArrPush[9]=$vLangArr[26];
$mowh_lv0021->ArrPush[10]=$vLangArr[27];
$mowh_lv0021->ArrPush[11]=$vLangArr[28];
$mowh_lv0021->ArrPush[12]=$vLangArr[29];
$mowh_lv0021->ArrPush[13]=$vLangArr[40];
$mowh_lv0021->ArrPush[14]=$vLangArr[31];
$mowh_lv0021->ArrPush[15]=$vLangArr[32];
$mowh_lv0021->ArrPush[100]=$vLangArr[42];

$mowh_lv0021->ArrFunc[0]='//Function';
$mowh_lv0021->ArrFunc[1]=$vLangArr[2];
$mowh_lv0021->ArrFunc[2]=$vLangArr[4];
$mowh_lv0021->ArrFunc[3]=$vLangArr[6];
$mowh_lv0021->ArrFunc[4]=$vLangArr[7];
$mowh_lv0021->ArrFunc[5]='';
$mowh_lv0021->ArrFunc[6]='';
$mowh_lv0021->ArrFunc[7]='';
$mowh_lv0021->ArrFunc[8]=$vLangArr[10];
$mowh_lv0021->ArrFunc[9]=$vLangArr[12];
$mowh_lv0021->ArrFunc[10]=$vLangArr[0];
$mowh_lv0021->ArrFunc[11]=$vLangArr[34];
$mowh_lv0021->ArrFunc[12]=$vLangArr[35];
$mowh_lv0021->ArrFunc[13]=$vLangArr[36];
$mowh_lv0021->ArrFunc[14]=$vLangArr[37];
$mowh_lv0021->ArrFunc[15]=$vLangArr[38];

////Other
$mowh_lv0021->ArrOther[1]=$vLangArr[32];
$mowh_lv0021->ArrOther[2]=$vLangArr[33];
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
$mowh_lv0021->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0021');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0021->lv002=base64_decode($_GET['ID']);
$vFieldList=$mowh_lv0021->ListView;
$curPage = $mowh_lv0021->CurPage;
$maxRows =$mowh_lv0021->MaxRows;
$vOrderList=$mowh_lv0021->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0021->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mowh_lv0021->GetView()==1)
{
?>

						<?php echo $mowh_lv0021->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
