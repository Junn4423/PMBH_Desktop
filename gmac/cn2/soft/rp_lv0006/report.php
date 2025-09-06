<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}


//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/tc_lv0027.php");

/////////////init object//////////////
$motc_lv0027=new tc_lv0027($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0011');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","TC0022.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0027->ArrPush[0]=$vLangArr[17];
$motc_lv0027->ArrPush[1]=$vLangArr[18];
$motc_lv0027->ArrPush[2]=$vLangArr[20];
$motc_lv0027->ArrPush[3]=$vLangArr[21];
$motc_lv0027->ArrPush[4]=$vLangArr[22];
$motc_lv0027->ArrPush[5]=$vLangArr[23];
$motc_lv0027->ArrPush[6]=$vLangArr[24];
$motc_lv0027->ArrPush[7]=$vLangArr[25];
$motc_lv0027->ArrPush[8]=$vLangArr[26];
$motc_lv0027->ArrPush[9]=$vLangArr[27];
$motc_lv0027->ArrPush[10]=$vLangArr[28];
$motc_lv0027->ArrPush[11]=$vLangArr[29];
$motc_lv0027->ArrPush[12]=$vLangArr[37];
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
$motc_lv0027->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0027');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0027->lv002=base64_decode($_GET['ID']);
$vFieldList=$motc_lv0027->ListView;
$curPage = $motc_lv0027->CurPage;
$maxRows =$motc_lv0027->MaxRows;
$vOrderList=$motc_lv0027->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0027->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($motc_lv0027->GetView()==1)
{
?>

				<?php echo $motc_lv0027->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
