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
require_once("../../clsall/sl_lv0058.php");

/////////////init object//////////////
$mosl_lv0058=new sl_lv0058($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0057');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","AC0007.txt",$plang);
$mosl_lv0058->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0058->ArrPush[0]=$vLangArr[17];
$mosl_lv0058->ArrPush[1]=$vLangArr[18];
$mosl_lv0058->ArrPush[2]=$vLangArr[19];
$mosl_lv0058->ArrPush[3]=$vLangArr[20];
$mosl_lv0058->ArrPush[4]=$vLangArr[21];
$mosl_lv0058->ArrPush[5]=$vLangArr[22];
$mosl_lv0058->ArrPush[6]=$vLangArr[23];
$mosl_lv0058->ArrPush[7]=$vLangArr[24];
$mosl_lv0058->ArrPush[8]=$vLangArr[25];
$mosl_lv0058->ArrPush[9]=$vLangArr[26];
$mosl_lv0058->ArrPush[10]=$vLangArr[27];
$mosl_lv0058->ArrPush[11]=$vLangArr[28];
$mosl_lv0058->ArrPush[12]=$vLangArr[29];
$mosl_lv0058->ArrPush[13]=$vLangArr[30];
$mosl_lv0058->ArrPush[14]=$vLangArr[31];
$mosl_lv0058->ArrPush[15]=$vLangArr[32];
$mosl_lv0058->ArrPush[16]=$vLangArr[33];
$mosl_lv0058->ArrPush[17]=$vLangArr[34];
$mosl_lv0058->ArrPush[18]=$vLangArr[43];
$mosl_lv0058->ArrPush[19]=$vLangArr[42];
$mosl_lv0058->ArrPush[20]=$vLangArr[37];
$mosl_lv0058->ArrPush[21]=$vLangArr[38];
$mosl_lv0058->ArrPush[22]=$vLangArr[39];
$mosl_lv0058->ArrPush[23]=$vLangArr[40];
$mosl_lv0058->ArrPush[24]=$vLangArr[41];
$mosl_lv0058->ArrPush[25]=$vLangArr[42];
$mosl_lv0058->ArrPush[26]=$vLangArr[43];
$mosl_lv0058->ArrPush[27]=$vLangArr[44];
$mosl_lv0058->ArrPush[28]=$vLangArr[45];
$mosl_lv0058->ArrPush[29]=$vLangArr[46];
$mosl_lv0058->ArrPush[30]=$vLangArr[47];
$mosl_lv0058->ArrPush[31]=$vLangArr[48];
$mosl_lv0058->ArrPush[32]=$vLangArr[49];
$mosl_lv0058->ArrPush[33]=$vLangArr[50];
$mosl_lv0058->ArrPush[34]=$vLangArr[51];
$mosl_lv0058->ArrPush[35]=$vLangArr[52];
$mosl_lv0058->ArrPush[36]=$vLangArr[53];
$mosl_lv0058->ArrPush[37]=$vLangArr[54];
$mosl_lv0058->ArrPush[38]=$vLangArr[55];
$mosl_lv0058->ArrPush[39]=$vLangArr[56];
$mosl_lv0058->ArrPush[40]=$vLangArr[57];
$mosl_lv0058->ArrPush[41]=$vLangArr[58];
$mosl_lv0058->ArrPush[42]=$vLangArr[59];
$mosl_lv0058->ArrPush[43]=$vLangArr[60];



$mosl_lv0058->ArrFunc[0]='//Function';
$mosl_lv0058->ArrFunc[1]=$vLangArr[2];
$mosl_lv0058->ArrFunc[2]=$vLangArr[4];
$mosl_lv0058->ArrFunc[3]=$vLangArr[6];
$mosl_lv0058->ArrFunc[4]=$vLangArr[7];
$mosl_lv0058->ArrFunc[5]='';
$mosl_lv0058->ArrFunc[6]='';
$mosl_lv0058->ArrFunc[7]='';
$mosl_lv0058->ArrFunc[8]=$vLangArr[10];
$mosl_lv0058->ArrFunc[9]=$vLangArr[12];
$mosl_lv0058->ArrFunc[10]=$vLangArr[0];
$mosl_lv0058->ArrFunc[11]=$vLangArr[63];
$mosl_lv0058->ArrFunc[12]=$vLangArr[64];
$mosl_lv0058->ArrFunc[13]=$vLangArr[65];
$mosl_lv0058->ArrFunc[14]=$vLangArr[66];

////Other
$mosl_lv0058->ArrOther[1]=$vLangArr[61];
$mosl_lv0058->ArrOther[2]=$vLangArr[62];
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
$mosl_lv0058->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0058');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0058->ListView;
$curPage = $mosl_lv0058->CurPage;
$maxRows =$mosl_lv0058->MaxRows;
$vOrderList=$mosl_lv0058->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0058->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($mosl_lv0058->GetView()==1)
{
?>

						<?php echo $mosl_lv0058->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
