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
require_once("../../clsall/ac_lv0019.php");

/////////////init object//////////////
$moac_lv0019=new ac_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0019');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","AC0016.txt",$plang);
$moac_lv0019->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0019->ArrPush[0]=$vLangArr[17];
$moac_lv0019->ArrPush[1]=$vLangArr[18];
$moac_lv0019->ArrPush[2]=$vLangArr[19];
$moac_lv0019->ArrPush[3]=$vLangArr[20];
$moac_lv0019->ArrPush[4]=$vLangArr[21];
$moac_lv0019->ArrPush[5]=$vLangArr[22];
$moac_lv0019->ArrPush[6]=$vLangArr[23];
$moac_lv0019->ArrPush[7]=$vLangArr[24];
$moac_lv0019->ArrPush[8]=$vLangArr[25];
$moac_lv0019->ArrPush[9]=$vLangArr[26];
$moac_lv0019->ArrPush[10]=$vLangArr[27];
$moac_lv0019->ArrPush[11]=$vLangArr[28];
$moac_lv0019->ArrPush[12]=$vLangArr[29];
$moac_lv0019->ArrPush[13]=$vLangArr[30];
$moac_lv0019->ArrPush[14]=$vLangArr[31];
$moac_lv0019->ArrPush[15]=$vLangArr[32];
$moac_lv0019->ArrPush[16]=$vLangArr[33];
$moac_lv0019->ArrPush[17]=$vLangArr[34];
$moac_lv0019->ArrPush[18]=$vLangArr[43];
$moac_lv0019->ArrPush[19]=$vLangArr[42];
$moac_lv0019->ArrPush[20]=$vLangArr[37];
$moac_lv0019->ArrPush[21]=$vLangArr[38];
$moac_lv0019->ArrPush[22]=$vLangArr[39];
$moac_lv0019->ArrPush[23]=$vLangArr[40];
$moac_lv0019->ArrPush[24]=$vLangArr[41];
$moac_lv0019->ArrPush[25]=$vLangArr[42];
$moac_lv0019->ArrPush[26]=$vLangArr[43];
$moac_lv0019->ArrPush[27]=$vLangArr[44];
$moac_lv0019->ArrPush[28]=$vLangArr[45];
$moac_lv0019->ArrPush[29]=$vLangArr[46];
$moac_lv0019->ArrPush[30]=$vLangArr[47];
$moac_lv0019->ArrPush[31]=$vLangArr[48];
$moac_lv0019->ArrPush[32]=$vLangArr[49];
$moac_lv0019->ArrPush[33]=$vLangArr[50];
$moac_lv0019->ArrPush[34]=$vLangArr[51];
$moac_lv0019->ArrPush[35]=$vLangArr[52];
$moac_lv0019->ArrPush[36]=$vLangArr[53];
$moac_lv0019->ArrPush[37]=$vLangArr[54];
$moac_lv0019->ArrPush[38]=$vLangArr[55];
$moac_lv0019->ArrPush[39]=$vLangArr[56];
$moac_lv0019->ArrPush[40]=$vLangArr[57];
$moac_lv0019->ArrPush[41]=$vLangArr[58];
$moac_lv0019->ArrPush[42]=$vLangArr[59];
$moac_lv0019->ArrPush[43]=$vLangArr[60];



$moac_lv0019->ArrFunc[0]='//Function';
$moac_lv0019->ArrFunc[1]=$vLangArr[2];
$moac_lv0019->ArrFunc[2]=$vLangArr[4];
$moac_lv0019->ArrFunc[3]=$vLangArr[6];
$moac_lv0019->ArrFunc[4]=$vLangArr[7];
$moac_lv0019->ArrFunc[5]='';
$moac_lv0019->ArrFunc[6]='';
$moac_lv0019->ArrFunc[7]='';
$moac_lv0019->ArrFunc[8]=$vLangArr[10];
$moac_lv0019->ArrFunc[9]=$vLangArr[12];
$moac_lv0019->ArrFunc[10]=$vLangArr[0];
$moac_lv0019->ArrFunc[11]=$vLangArr[63];
$moac_lv0019->ArrFunc[12]=$vLangArr[64];
$moac_lv0019->ArrFunc[13]=$vLangArr[65];
$moac_lv0019->ArrFunc[14]=$vLangArr[66];

////Other
$moac_lv0019->ArrOther[1]=$vLangArr[61];
$moac_lv0019->ArrOther[2]=$vLangArr[62];
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
$moac_lv0019->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0019');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moac_lv0019->ListView;
$curPage = $moac_lv0019->CurPage;
$maxRows =$moac_lv0019->MaxRows;
$vOrderList=$moac_lv0019->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0019->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($moac_lv0019->GetView()==1)
{
?>

						<?php echo $moac_lv0019->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../permit.php");
}
?>
