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
header('Content-Type: text/html; charset=utf-8');}


//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0034.php");

/////////////init object//////////////
$mowh_lv0034=new wh_lv0034($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0034');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0048.txt",$plang);

$mowh_lv0034->ArrPush[0]=$vLangArr[17];
$mowh_lv0034->ArrPush[1]=$vLangArr[18];
$mowh_lv0034->ArrPush[2]=$vLangArr[20];
$mowh_lv0034->ArrPush[3]=$vLangArr[21];
$mowh_lv0034->ArrPush[4]=$vLangArr[22];
$mowh_lv0034->ArrPush[5]=$vLangArr[23];
$mowh_lv0034->ArrPush[6]=$vLangArr[24];

$mowh_lv0034->ArrFunc[0]='//Function';
$mowh_lv0034->ArrFunc[1]=$vLangArr[2];
$mowh_lv0034->ArrFunc[2]=$vLangArr[4];
$mowh_lv0034->ArrFunc[3]=$vLangArr[6];
$mowh_lv0034->ArrFunc[4]=$vLangArr[7];
$mowh_lv0034->ArrFunc[5]='';
$mowh_lv0034->ArrFunc[6]='';
$mowh_lv0034->ArrFunc[7]='';
$mowh_lv0034->ArrFunc[8]=$vLangArr[10];
$mowh_lv0034->ArrFunc[9]=$vLangArr[12];
$mowh_lv0034->ArrFunc[10]=$vLangArr[0];
$mowh_lv0034->ArrFunc[11]=$vLangArr[27];
$mowh_lv0034->ArrFunc[12]=$vLangArr[28];
$mowh_lv0034->ArrFunc[13]=$vLangArr[29];
$mowh_lv0034->ArrFunc[14]=$vLangArr[30];
$mowh_lv0034->ArrFunc[15]=$vLangArr[31];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0034->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0034');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0034->ListView;
$curPage = $mowh_lv0034->CurPage;
$maxRows =$mowh_lv0034->MaxRows;
$vOrderList=$mowh_lv0034->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0034->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mowh_lv0034->GetView()==1)
{
?>

				<?php echo $mowh_lv0034->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
