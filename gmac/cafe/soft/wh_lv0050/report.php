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
require_once("../../clsall/wh_lv0050.php");

/////////////init object//////////////
$mowh_lv0050=new wh_lv0050($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0050');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0059.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0050->ArrPush[0]=$vLangArr[17];
$mowh_lv0050->ArrPush[1]=$vLangArr[18];
$mowh_lv0050->ArrPush[2]=$vLangArr[20];
$mowh_lv0050->ArrPush[3]=$vLangArr[21];
$mowh_lv0050->ArrPush[4]=$vLangArr[22];

$mowh_lv0050->ArrFunc[0]='//Function';
$mowh_lv0050->ArrFunc[1]=$vLangArr[2];
$mowh_lv0050->ArrFunc[2]=$vLangArr[4];
$mowh_lv0050->ArrFunc[3]=$vLangArr[6];
$mowh_lv0050->ArrFunc[4]=$vLangArr[7];
$mowh_lv0050->ArrFunc[5]='';
$mowh_lv0050->ArrFunc[6]='';
$mowh_lv0050->ArrFunc[7]='';
$mowh_lv0050->ArrFunc[8]=$vLangArr[10];
$mowh_lv0050->ArrFunc[9]=$vLangArr[12];
$mowh_lv0050->ArrFunc[10]=$vLangArr[0];
$mowh_lv0050->ArrFunc[11]=$vLangArr[25];
$mowh_lv0050->ArrFunc[12]=$vLangArr[26];
$mowh_lv0050->ArrFunc[13]=$vLangArr[27];
$mowh_lv0050->ArrFunc[14]=$vLangArr[28];
$mowh_lv0050->ArrFunc[15]=$vLangArr[29];
////Other
$mowh_lv0050->ArrOther[1]=$vLangArr[23];
$mowh_lv0050->ArrOther[2]=$vLangArr[24];
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
$mowh_lv0050->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0050');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0050->ListView;
$curPage = $mowh_lv0050->CurPage;
$maxRows =$mowh_lv0050->MaxRows;
$vOrderList=$mowh_lv0050->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0050->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
if($mowh_lv0050->GetView()==1)
{
?>

				<?php echo $mowh_lv0050->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
