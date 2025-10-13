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
require_once("../../clsall/lv_lv0010.php");

/////////////init object//////////////
$molv_lv0010=new lv_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Lv0010');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","LV0001.txt",$plang);

$molv_lv0010->ArrPush[0]=$vLangArr[17];
$molv_lv0010->ArrPush[1]=$vLangArr[18];
$molv_lv0010->ArrPush[2]=$vLangArr[20];
$molv_lv0010->ArrPush[3]=$vLangArr[21];
$molv_lv0010->ArrPush[4]=$vLangArr[22];
$molv_lv0010->ArrPush[5]=$vLangArr[23];
$molv_lv0010->ArrPush[6]=$vLangArr[24];

$molv_lv0010->ArrFunc[0]='//Function';
$molv_lv0010->ArrFunc[1]=$vLangArr[2];
$molv_lv0010->ArrFunc[2]=$vLangArr[4];
$molv_lv0010->ArrFunc[3]=$vLangArr[6];
$molv_lv0010->ArrFunc[4]=$vLangArr[7];
$molv_lv0010->ArrFunc[5]='';
$molv_lv0010->ArrFunc[6]='';
$molv_lv0010->ArrFunc[7]='';
$molv_lv0010->ArrFunc[8]=$vLangArr[10];
$molv_lv0010->ArrFunc[9]=$vLangArr[12];
$molv_lv0010->ArrFunc[10]=$vLangArr[0];
$molv_lv0010->ArrFunc[11]=$vLangArr[27];
$molv_lv0010->ArrFunc[12]=$vLangArr[28];
$molv_lv0010->ArrFunc[13]=$vLangArr[29];
$molv_lv0010->ArrFunc[14]=$vLangArr[30];
$molv_lv0010->ArrFunc[15]=$vLangArr[31];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0010->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0010');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0010->ListView;
$curPage = $molv_lv0010->CurPage;
$maxRows =$molv_lv0010->MaxRows;
$vOrderList=$molv_lv0010->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0010->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<?php
if($molv_lv0010->GetView()==1)
{
?>

				<?php echo $molv_lv0010->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
