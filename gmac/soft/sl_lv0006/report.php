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
require_once("../../clsall/sl_lv0006.php");

/////////////init object//////////////
$mosl_lv0006=new sl_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0012.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0006->ArrPush[0]=$vLangArr[17];
$mosl_lv0006->ArrPush[1]=$vLangArr[18];
$mosl_lv0006->ArrPush[2]=$vLangArr[20];
$mosl_lv0006->ArrPush[3]=$vLangArr[21];
$mosl_lv0006->ArrPush[4]=$vLangArr[29];
$mosl_lv0006->ArrPush[5]=$vLangArr[23];
$mosl_lv0006->ArrPush[6]='Thứ tự';

$mosl_lv0006->ArrFunc[0]='//Function';
$mosl_lv0006->ArrFunc[1]=$vLangArr[2];
$mosl_lv0006->ArrFunc[2]=$vLangArr[4];
$mosl_lv0006->ArrFunc[3]=$vLangArr[6];
$mosl_lv0006->ArrFunc[4]=$vLangArr[7];
$mosl_lv0006->ArrFunc[5]='';
$mosl_lv0006->ArrFunc[6]='';
$mosl_lv0006->ArrFunc[7]='';
$mosl_lv0006->ArrFunc[8]=$vLangArr[10];
$mosl_lv0006->ArrFunc[9]=$vLangArr[12];
$mosl_lv0006->ArrFunc[10]=$vLangArr[0];
$mosl_lv0006->ArrFunc[11]=$vLangArr[24];
$mosl_lv0006->ArrFunc[12]=$vLangArr[25];
$mosl_lv0006->ArrFunc[13]=$vLangArr[26];
$mosl_lv0006->ArrFunc[14]=$vLangArr[27];
$mosl_lv0006->ArrFunc[15]=$vLangArr[28];
////Other
$mosl_lv0006->ArrOther[1]=$vLangArr[22];
$mosl_lv0006->ArrOther[2]=$vLangArr[23];
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
$mosl_lv0006->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0006');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0006->ListView;
$curPage = $mosl_lv0006->CurPage;
$maxRows =$mosl_lv0006->MaxRows;
$vOrderList=$mosl_lv0006->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0006->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mosl_lv0006->GetView()==1)
{
?>

				<?php echo $mosl_lv0006->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../sl_lv0006/permit.php");
}
?>
