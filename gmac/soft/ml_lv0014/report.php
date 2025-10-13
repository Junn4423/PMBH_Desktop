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
require_once("../../clsall/ml_lv0001.php");

/////////////init object//////////////
$moml_lv0001=new ml_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0001.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0001->ArrPush[0]=$vLangArr[13];
$moml_lv0001->ArrPush[1]=$vLangArr[14];
$moml_lv0001->ArrPush[2]=$vLangArr[15];
$moml_lv0001->ArrPush[3]=$vLangArr[16];
$moml_lv0001->ArrPush[4]=$vLangArr[17];
$moml_lv0001->ArrPush[5]=$vLangArr[18];
$moml_lv0001->ArrPush[6]=$vLangArr[19];
$moml_lv0001->ArrPush[7]=$vLangArr[20];
$moml_lv0001->ArrPush[8]=$vLangArr[21];
$moml_lv0001->ArrPush[9]=$vLangArr[22];
$moml_lv0001->ArrPush[10]=$vLangArr[23];
$moml_lv0001->ArrPush[11]=$vLangArr[24];
$moml_lv0001->ArrPush[12]=$vLangArr[25];
$moml_lv0001->ArrPush[13]=$vLangArr[26];
$moml_lv0001->ArrPush[14]=$vLangArr[27];
$moml_lv0001->ArrPush[15]=$vLangArr[28];

$moml_lv0001->ArrFunc[0]='//Function';
$moml_lv0001->ArrFunc[1]=$vLangArr[2];
$moml_lv0001->ArrFunc[2]=$vLangArr[4];
$moml_lv0001->ArrFunc[3]=$vLangArr[6];
$moml_lv0001->ArrFunc[4]=$vLangArr[7];
$moml_lv0001->ArrFunc[5]='';
$moml_lv0001->ArrFunc[6]='';
$moml_lv0001->ArrFunc[7]='';
$moml_lv0001->ArrFunc[8]=$vLangArr[10];
$moml_lv0001->ArrFunc[9]=$vLangArr[12];
$moml_lv0001->ArrFunc[10]=$vLangArr[0];
$moml_lv0001->ArrFunc[11]=$vLangArr[31];
$moml_lv0001->ArrFunc[12]=$vLangArr[32];
$moml_lv0001->ArrFunc[13]=$vLangArr[33];
$moml_lv0001->ArrFunc[14]=$vLangArr[34];
$moml_lv0001->ArrFunc[15]=$vLangArr[35];
////Other
$moml_lv0001->ArrOther[1]=$vLangArr[29];
$moml_lv0001->ArrOther[2]=$vLangArr[30];


//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ml_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moml_lv0001->ListView;
$curPage = $moml_lv0001->CurPage;
$maxRows =$moml_lv0001->MaxRows;
$vOrderList=$moml_lv0001->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moml_lv0001->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moml_lv0001->GetView()==1)
{
?>

				<?php echo $moml_lv0001->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
