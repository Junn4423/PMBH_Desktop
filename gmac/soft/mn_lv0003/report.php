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
require_once("../../clsall/mn_lv0003.php");

/////////////init object//////////////
$momn_lv0003=new mn_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0012.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0003->ArrPush[0]=$vLangArr[17];
$momn_lv0003->ArrPush[1]=$vLangArr[18];
$momn_lv0003->ArrPush[2]=$vLangArr[20];
$momn_lv0003->ArrPush[3]=$vLangArr[21];
$momn_lv0003->ArrPush[4]=$vLangArr[22];
$momn_lv0003->ArrPush[5]=$vLangArr[23];
$momn_lv0003->ArrPush[6]=$vLangArr[24];

$momn_lv0003->ArrFunc[0]='//Function';
$momn_lv0003->ArrFunc[1]=$vLangArr[2];
$momn_lv0003->ArrFunc[2]=$vLangArr[4];
$momn_lv0003->ArrFunc[3]=$vLangArr[6];
$momn_lv0003->ArrFunc[4]=$vLangArr[7];
$momn_lv0003->ArrFunc[5]='';
$momn_lv0003->ArrFunc[6]='';
$momn_lv0003->ArrFunc[7]='';
$momn_lv0003->ArrFunc[8]=$vLangArr[10];
$momn_lv0003->ArrFunc[9]=$vLangArr[12];
$momn_lv0003->ArrFunc[10]=$vLangArr[0];
$momn_lv0003->ArrFunc[11]=$vLangArr[24];
$momn_lv0003->ArrFunc[12]=$vLangArr[25];
$momn_lv0003->ArrFunc[13]=$vLangArr[26];
$momn_lv0003->ArrFunc[14]=$vLangArr[27];
$momn_lv0003->ArrFunc[15]=$vLangArr[28];
////Other
$momn_lv0003->ArrOther[1]=$vLangArr[22];
$momn_lv0003->ArrOther[2]=$vLangArr[23];
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
$momn_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0003->ListView;
$curPage = $momn_lv0003->CurPage;
$maxRows =$momn_lv0003->MaxRows;
$vOrderList=$momn_lv0003->ListOrder;

if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0003->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?><link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><?php
if($momn_lv0003->GetView()==1)
{
?>

				<?php echo $momn_lv0003->LV_BuilListReport($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
					
<?php
} else {
	include("../mn_lv0003/permit.php");
}
?>
