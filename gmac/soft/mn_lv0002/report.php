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
require_once("../../clsall/mn_lv0002.php");

/////////////init object//////////////
$momn_lv0002=new mn_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0014.txt",$plang);
$momn_lv0002->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0002->ArrPush[0]=$vLangArr[17];
$momn_lv0002->ArrPush[1]=$vLangArr[18];
$momn_lv0002->ArrPush[2]=$vLangArr[19];
$momn_lv0002->ArrPush[3]=$vLangArr[20];
$momn_lv0002->ArrPush[4]=$vLangArr[21];
$momn_lv0002->ArrPush[5]=$vLangArr[22];
$momn_lv0002->ArrPush[6]=$vLangArr[23];
$momn_lv0002->ArrPush[7]=$vLangArr[24];
$momn_lv0002->ArrPush[8]=$vLangArr[25];
$momn_lv0002->ArrPush[9]=$vLangArr[26];
$momn_lv0002->ArrPush[10]=$vLangArr[27];
$momn_lv0002->ArrPush[11]=$vLangArr[28];
$momn_lv0002->ArrPush[12]=$vLangArr[29];
$momn_lv0002->ArrPush[13]=$vLangArr[30];
$momn_lv0002->ArrPush[14]=$vLangArr[31];
$momn_lv0002->ArrPush[15]=$vLangArr[32];
$momn_lv0002->ArrPush[16]=$vLangArr[33];
$momn_lv0002->ArrPush[17]=$vLangArr[34];
$momn_lv0002->ArrPush[18]=$vLangArr[35];
$momn_lv0002->ArrPush[19]=$vLangArr[36];
$momn_lv0002->ArrPush[20]=$vLangArr[37];
$momn_lv0002->ArrPush[21]=$vLangArr[38];
$momn_lv0002->ArrPush[22]=$vLangArr[39];
$momn_lv0002->ArrPush[23]=$vLangArr[40];
$momn_lv0002->ArrPush[24]=$vLangArr[41];
$momn_lv0002->ArrPush[25]=$vLangArr[42];
$momn_lv0002->ArrPush[26]=$vLangArr[43];
$momn_lv0002->ArrPush[27]=$vLangArr[44];
$momn_lv0002->ArrPush[28]=$vLangArr[45];
$momn_lv0002->ArrPush[29]=$vLangArr[46];
$momn_lv0002->ArrPush[30]=$vLangArr[47];
$momn_lv0002->ArrPush[31]=$vLangArr[48];
$momn_lv0002->ArrPush[32]=$vLangArr[49];
$momn_lv0002->ArrPush[33]=$vLangArr[50];
$momn_lv0002->ArrPush[34]=$vLangArr[51];
$momn_lv0002->ArrPush[35]=$vLangArr[52];
$momn_lv0002->ArrPush[36]=$vLangArr[53];
$momn_lv0002->ArrPush[37]=$vLangArr[54];
$momn_lv0002->ArrPush[38]=$vLangArr[55];
$momn_lv0002->ArrPush[39]=$vLangArr[56];
$momn_lv0002->ArrPush[40]=$vLangArr[57];
$momn_lv0002->ArrPush[41]=$vLangArr[58];
$momn_lv0002->ArrPush[42]=$vLangArr[59];
$momn_lv0002->ArrPush[43]=$vLangArr[60];



$momn_lv0002->ArrFunc[0]='//Function';
$momn_lv0002->ArrFunc[1]=$vLangArr[2];
$momn_lv0002->ArrFunc[2]=$vLangArr[4];
$momn_lv0002->ArrFunc[3]=$vLangArr[6];
$momn_lv0002->ArrFunc[4]=$vLangArr[7];
$momn_lv0002->ArrFunc[5]='';
$momn_lv0002->ArrFunc[6]='';
$momn_lv0002->ArrFunc[7]='';
$momn_lv0002->ArrFunc[8]=$vLangArr[10];
$momn_lv0002->ArrFunc[9]=$vLangArr[12];
$momn_lv0002->ArrFunc[10]=$vLangArr[0];
$momn_lv0002->ArrFunc[11]=$vLangArr[63];
$momn_lv0002->ArrFunc[12]=$vLangArr[64];
$momn_lv0002->ArrFunc[13]=$vLangArr[65];
$momn_lv0002->ArrFunc[14]=$vLangArr[66];

////Other
$momn_lv0002->ArrOther[1]=$vLangArr[61];
$momn_lv0002->ArrOther[2]=$vLangArr[62];
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
$momn_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0002->ListView;
$curPage = $momn_lv0002->CurPage;
$maxRows =$momn_lv0002->MaxRows;
$vOrderList=$momn_lv0002->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0002->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($momn_lv0002->GetView()==1)
{
?>

						<?php echo $momn_lv0002->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../mn_lv0002/permit.php");
}
?>
