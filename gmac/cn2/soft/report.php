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
require_once("../../clsall/lv_lv0007.php");

/////////////init object//////////////
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","LV0003.txt",$plang);
$molv_lv0007->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->ArrPush[0]=$vLangArr[11];
$molv_lv0007->ArrPush[1]=$vLangArr[12];
$molv_lv0007->ArrPush[2]=$vLangArr[13];
$molv_lv0007->ArrPush[3]=$vLangArr[14];
$molv_lv0007->ArrPush[4]=$vLangArr[15];
$molv_lv0007->ArrPush[5]=$vLangArr[26];
$molv_lv0007->ArrPush[6]=$vLangArr[17];
$molv_lv0007->ArrPush[7]=$vLangArr[18];
$molv_lv0007->ArrPush[8]=$vLangArr[19];
$molv_lv0007->ArrPush[9]=$vLangArr[20];
$molv_lv0007->ArrPush[10]=$vLangArr[21];
$molv_lv0007->ArrPush[11]=$vLangArr[22];
$molv_lv0007->ArrPush[12]=$vLangArr[23];
$molv_lv0007->ArrPush[13]=$vLangArr[24];
$molv_lv0007->ArrPush[14]=$vLangArr[25];
$molv_lv0007->ArrPush[15]=$vLangArr[26];
$molv_lv0007->ArrPush[16]=$vLangArr[27];
$molv_lv0007->ArrPush[17]=$vLangArr[35];

////Other
$molv_lv0007->ArrOther[1]=$vLangArr[61];
$molv_lv0007->ArrOther[2]=$vLangArr[62];
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
$molv_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0007->ListView;
$curPage = $molv_lv0007->CurPage;
$maxRows =$molv_lv0007->MaxRows;
$vOrderList=$molv_lv0007->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0007->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($molv_lv0007->GetView()==1)
{
?>

						<?php echo $molv_lv0007->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
