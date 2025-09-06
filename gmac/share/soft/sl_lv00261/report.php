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
require_once("../../clsall/wh_lv0008.php");

/////////////init object//////////////
$mowh_lv0008=new wh_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0010.txt",$plang);
$mowh_lv0008->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0008->ArrPush[0]=$vLangArr[17];
$mowh_lv0008->ArrPush[1]=$vLangArr[18];
$mowh_lv0008->ArrPush[2]=$vLangArr[19];
$mowh_lv0008->ArrPush[3]=$vLangArr[20];
$mowh_lv0008->ArrPush[4]=$vLangArr[21];
$mowh_lv0008->ArrPush[5]=$vLangArr[22];
$mowh_lv0008->ArrPush[6]=$vLangArr[23];
$mowh_lv0008->ArrPush[7]=$vLangArr[24];
$mowh_lv0008->ArrPush[8]=$vLangArr[25];
$mowh_lv0008->ArrPush[9]=$vLangArr[26];
$mowh_lv0008->ArrPush[10]=$vLangArr[27];

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
$mowh_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0008');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0008->lv002=base64_decode($_GET['ID']);
$vFieldList=$mowh_lv0008->ListView;
$curPage = $mowh_lv0008->CurPage;
$maxRows =$mowh_lv0008->MaxRows;
$vOrderList=$mowh_lv0008->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0008->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mowh_lv0008->GetView()==1)
{
?>

						<?php echo $mowh_lv0008->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
