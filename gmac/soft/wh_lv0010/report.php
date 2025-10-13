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
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0010.php");

/////////////init object//////////////
$mowh_lv0010=new wh_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0015');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0015.txt",$plang);
$mowh_lv0010->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0010->ArrPush[0]=$vLangArr[17];
$mowh_lv0010->ArrPush[1]=$vLangArr[18];
$mowh_lv0010->ArrPush[2]=$vLangArr[19];
$mowh_lv0010->ArrPush[3]=$vLangArr[20];
$mowh_lv0010->ArrPush[4]=$vLangArr[21];
$mowh_lv0010->ArrPush[5]=$vLangArr[22];
$mowh_lv0010->ArrPush[6]=$vLangArr[23];
$mowh_lv0010->ArrPush[7]=$vLangArr[24];
$mowh_lv0010->ArrPush[8]=$vLangArr[25];
$mowh_lv0010->ArrPush[9]=$vLangArr[26];
$mowh_lv0010->ArrPush[10]=$vLangArr[27];
$mowh_lv0010->ArrPush[11]=$vLangArr[40];
$mowh_lv0010->ArrPush[12]=$vLangArr[41];
$mowh_lv0010->ArrPush[13]=$vLangArr[42];
$mowh_lv0010->ArrPush[100]=$vLangArr[20]." lưu chuyển đến";

////Other
$mowh_lv0010->ArrOther[1]=$vLangArr[28];
$mowh_lv0010->ArrOther[2]=$vLangArr[29];
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
$mowh_lv0010->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0010');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0010->lv002=base64_decode($_GET['ID']);
$vFieldList=$mowh_lv0010->ListView;
$curPage = $mowh_lv0010->CurPage;
$maxRows =$mowh_lv0010->MaxRows;
$vOrderList=$mowh_lv0010->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0010->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mowh_lv0010->GetView()==1)
{
?>

						<?php echo $mowh_lv0010->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
