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
require_once("../../clsall/wh_lv0030.php");

/////////////init object//////////////
$mowh_lv0030=new wh_lv0030($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0028');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0037.txt",$plang);
$mowh_lv0030->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0030->ArrPush[0]=$vLangArr[17];
$mowh_lv0030->ArrPush[1]=$vLangArr[18];
$mowh_lv0030->ArrPush[2]=$vLangArr[44];
$mowh_lv0030->ArrPush[3]=$vLangArr[21];
$mowh_lv0030->ArrPush[4]=$vLangArr[31];
$mowh_lv0030->ArrPush[5]=$vLangArr[32];
$mowh_lv0030->ArrPush[6]=$vLangArr[33];
$mowh_lv0030->ArrPush[7]=$vLangArr[34];
$mowh_lv0030->ArrPush[8]=$vLangArr[35];
$mowh_lv0030->ArrPush[9]=$vLangArr[36];
$mowh_lv0030->ArrPush[10]=$vLangArr[37];
$mowh_lv0030->ArrPush[11]=$vLangArr[38];
$mowh_lv0030->ArrPush[12]=$vLangArr[39];
$mowh_lv0030->ArrPush[13]=$vLangArr[40];
$mowh_lv0030->ArrPush[14]=$vLangArr[41];
$mowh_lv0030->ArrPush[15]=$vLangArr[42];
$mowh_lv0030->ArrPush[16]=$vLangArr[43];
$mowh_lv0030->ArrPush[17]=$vLangArr[27];
$mowh_lv0030->ArrPush[18]=$vLangArr[58];
$mowh_lv0030->ArrPush[98]=$vLangArr[59];
$mowh_lv0030->ArrPush[99]=$vLangArr[60];
$mowh_lv0030->ArrFunc[0]='//Function';
$mowh_lv0030->ArrFunc[1]=$vLangArr[2];
$mowh_lv0030->ArrFunc[2]=$vLangArr[4];
$mowh_lv0030->ArrFunc[3]=$vLangArr[6];
$mowh_lv0030->ArrFunc[4]=$vLangArr[7];
$mowh_lv0030->ArrFunc[5]='';
$mowh_lv0030->ArrFunc[6]='';
$mowh_lv0030->ArrFunc[7]='';
$mowh_lv0030->ArrFunc[8]=$vLangArr[10];
$mowh_lv0030->ArrFunc[9]=$vLangArr[12];
$mowh_lv0030->ArrFunc[10]=$vLangArr[0];
$mowh_lv0030->ArrFunc[11]=$vLangArr[36];
$mowh_lv0030->ArrFunc[12]=$vLangArr[37];
$mowh_lv0030->ArrFunc[13]=$vLangArr[38];
$mowh_lv0030->ArrFunc[14]=$vLangArr[39];
$mowh_lv0030->ArrFunc[15]=$vLangArr[40];
////Other
$mowh_lv0030->ArrOther[1]=$vLangArr[31];
$mowh_lv0030->ArrOther[2]=$vLangArr[32];
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
$mowh_lv0030->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0030');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0030->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$vFieldList=$mowh_lv0030->ListView;
$curPage = $mowh_lv0030->CurPage;
$maxRows =$mowh_lv0030->MaxRows;
$vOrderList=$mowh_lv0030->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0030->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mowh_lv0030->GetView()==1)
{
?>

						<?php echo $mowh_lv0030->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
