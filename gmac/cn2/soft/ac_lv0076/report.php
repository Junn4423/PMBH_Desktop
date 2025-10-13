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
require_once("../../clsall/ac_lv0076.php");

/////////////init object//////////////
$moac_lv0076=new ac_lv0076($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0076');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","AC0024.txt",$plang);
$moac_lv0076->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0076->ArrPush[0]=$vLangArr[17];
$moac_lv0076->ArrPush[1]=$vLangArr[18];
$moac_lv0076->ArrPush[2]=$vLangArr[19];
$moac_lv0076->ArrPush[3]=$vLangArr[20];
$moac_lv0076->ArrPush[4]=$vLangArr[21];
$moac_lv0076->ArrPush[5]=$vLangArr[22];
$moac_lv0076->ArrPush[6]=$vLangArr[23];
$moac_lv0076->ArrPush[7]=$vLangArr[24];
$moac_lv0076->ArrPush[8]=$vLangArr[25];
$moac_lv0076->ArrPush[9]=$vLangArr[26];
$moac_lv0076->ArrPush[10]=$vLangArr[27];
$moac_lv0076->ArrPush[11]=$vLangArr[28];
$moac_lv0076->ArrPush[12]=$vLangArr[29];
$moac_lv0076->ArrPush[13]=$vLangArr[30];
$moac_lv0076->ArrPush[14]=$vLangArr[31];
$moac_lv0076->ArrPush[15]=$vLangArr[32];
$moac_lv0076->ArrPush[16]=$vLangArr[33];

$moac_lv0076->ArrFunc[0]='//Function';
$moac_lv0076->ArrFunc[1]=$vLangArr[2];
$moac_lv0076->ArrFunc[2]=$vLangArr[4];
$moac_lv0076->ArrFunc[3]=$vLangArr[6];
$moac_lv0076->ArrFunc[4]=$vLangArr[7];
$moac_lv0076->ArrFunc[5]='';
$moac_lv0076->ArrFunc[6]='';
$moac_lv0076->ArrFunc[7]='';
$moac_lv0076->ArrFunc[8]=$vLangArr[10];
$moac_lv0076->ArrFunc[9]=$vLangArr[12];
$moac_lv0076->ArrFunc[10]=$vLangArr[0];
$moac_lv0076->ArrFunc[11]=$vLangArr[36];
$moac_lv0076->ArrFunc[12]=$vLangArr[37];
$moac_lv0076->ArrFunc[13]=$vLangArr[38];
$moac_lv0076->ArrFunc[14]=$vLangArr[39];
$moac_lv0076->ArrFunc[15]=$vLangArr[40];
////Other
$moac_lv0076->ArrOther[1]=$vLangArr[31];
$moac_lv0076->ArrOther[2]=$vLangArr[32];
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
$moac_lv0076->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0076');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0076->lv002=base64_decode($_GET['ID']);
$vFieldList=$moac_lv0076->ListView;
$curPage = $moac_lv0076->CurPage;
$maxRows =$moac_lv0076->MaxRows;
$vOrderList=$moac_lv0076->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0076->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moac_lv0076->GetView()==1)
{
?>

						<?php echo $moac_lv0076->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../ac_lv0076/permit.php");
}
?>