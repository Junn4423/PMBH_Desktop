<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0113.php");
require_once("../../clsall/sl_lv0114.php");

/////////////init object//////////////
$mosl_lv0114=new sl_lv0114($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

$plang="VN";
	$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mosl_lv0114->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0114->ArrPush[0]=$vLangArr[17];
$mosl_lv0114->ArrPush[1]=$vLangArr[18];
$mosl_lv0114->ArrPush[2]=$vLangArr[19];
$mosl_lv0114->ArrPush[3]=$vLangArr[20];
$mosl_lv0114->ArrPush[4]=$vLangArr[21];
$mosl_lv0114->ArrPush[5]=$vLangArr[22];
$mosl_lv0114->ArrPush[6]=$vLangArr[23];
$mosl_lv0114->ArrPush[7]=$vLangArr[24]."@01";
$mosl_lv0114->ArrPush[8]=$vLangArr[25];
$mosl_lv0114->ArrPush[9]=$vLangArr[26];
$mosl_lv0114->ArrPush[10]=$vLangArr[27];
$mosl_lv0114->ArrPush[11]=$vLangArr[28];
$mosl_lv0114->ArrPush[12]=$vLangArr[29];
$mosl_lv0114->ArrPush[13]=$vLangArr[30];
$mosl_lv0114->ArrPush[14]=$vLangArr[31];
$mosl_lv0114->ArrPush[15]=$vLangArr[32];
$mosl_lv0114->ArrPush[16]=$vLangArr[33];
$mosl_lv0114->ArrPush[17]=$vLangArr[46];
$mosl_lv0114->ArrPush[18]=$vLangArr[47];
$mosl_lv0114->ArrPush[19]=$vLangArr[48];
$mosl_lv0114->ArrPush[20]=$vLangArr[49];

/*$mosl_lv0114->ArrPush[0]=$vLangArr[17];
$mosl_lv0114->ArrPush[1]=$vLangArr[18];
$mosl_lv0114->ArrPush[2]=$vLangArr[19];
$mosl_lv0114->ArrPush[3]=$vLangArr[20];
$mosl_lv0114->ArrPush[4]=$vLangArr[21];
$mosl_lv0114->ArrPush[5]=$vLangArr[22];
$mosl_lv0114->ArrPush[6]=$vLangArr[23];
$mosl_lv0114->ArrPush[7]=$vLangArr[24]."@01";
$mosl_lv0114->ArrPush[8]=$vLangArr[25];
$mosl_lv0114->ArrPush[9]=$vLangArr[26];
$mosl_lv0114->ArrPush[10]=$vLangArr[27];
$mosl_lv0114->ArrPush[11]=$vLangArr[28];
$mosl_lv0114->ArrPush[12]=$vLangArr[29];
$mosl_lv0114->ArrPush[13]=$vLangArr[30];
$mosl_lv0114->ArrPush[14]=$vLangArr[31];
$mosl_lv0114->ArrPush[15]=$vLangArr[44];
$mosl_lv0114->ArrPush[16]=$vLangArr[43];
$mosl_lv0114->ArrPush[17]=$vLangArr[41];
$mosl_lv0114->ArrPush[21]=$vLangArr[42];*/
$mosl_lv0114->ArrPush[21]=$vLangArr[41]."@01";
$mosl_lv0114->ArrPush[22]=$vLangArr[42];
$mosl_lv0114->ArrPush[23]=$vLangArr[43];
$mosl_lv0114->ArrPush[24]=$vLangArr[44];
$mosl_lv0114->ArrPush[25]=$vLangArr[42];
$mosl_lv0114->ArrPush[26]=$vLangArr[54];
$mosl_lv0114->ArrPush[27]=$vLangArr[55];

$mosl_lv0114->ArrPush[18]=$vLangArr[47];
$mosl_lv0114->ArrPush[19]=$vLangArr[48];
$mosl_lv0114->ArrPush[20]=$vLangArr[49];

$mosl_lv0114->ArrFunc[0]='//Function';
$mosl_lv0114->ArrFunc[1]=$vLangArr[2];
$mosl_lv0114->ArrFunc[2]=$vLangArr[4];
$mosl_lv0114->ArrFunc[3]=$vLangArr[6];
$mosl_lv0114->ArrFunc[4]=$vLangArr[7];
$mosl_lv0114->ArrFunc[5]='';
$mosl_lv0114->ArrFunc[6]='';
$mosl_lv0114->ArrFunc[7]='';
$mosl_lv0114->ArrFunc[8]=$vLangArr[10];
$mosl_lv0114->ArrFunc[9]=$vLangArr[12];
$mosl_lv0114->ArrFunc[10]=$vLangArr[0];
$mosl_lv0114->ArrFunc[11]=$vLangArr[33];
$mosl_lv0114->ArrFunc[12]=$vLangArr[34];
$mosl_lv0114->ArrFunc[13]=$vLangArr[35];
$mosl_lv0114->ArrFunc[14]=$vLangArr[36];
$mosl_lv0114->ArrFunc[15]=$vLangArr[37];

////Other
$mosl_lv0114->ArrOther[1]=$vLangArr[31];
$mosl_lv0114->ArrOther[2]=$vLangArr[32];
$mosl_lv0114->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0114');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0114->ListView;
$curPage = $mosl_lv0114->CurPage;
$maxRows =$mosl_lv0114->MaxRows;
$vOrderList=$mosl_lv0114->ListOrder;
$vSortNum=$mosl_lv0114->SortNum;
/////////////init object//////////////
$mosl_lv0113=new sl_lv0113($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0113');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mosl_lv0113->lang=strtoupper($plang);
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$mosl_lv0114->lv002=$vlv001;
$flagID=(int)$_POST["txtFlag"];
$vStrMessage="";
?>

<?php
if($mosl_lv0113->GetView()==1)
{
  $mosl_lv0113->LV_LoadID($vlv001);
	/*if($mosl_lv0113->lv006>0)
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv010,lv011,lv012";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010,lv011,lv012";//$vFieldList="lv003,lv004,lv005,lv006,lv008,lv009,lv010";*/
	 $strDetail=$mosl_lv0114->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,$paging,$vOrderList,$mosl_lv0113->lv006);
	 
	?>
<html>
<head>
<title></title>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>	
<body  onkeyup="KeyPublicRun(event)">
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mosl_lv0113->lv011>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0113->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><?php echo str_replace("<!--strAttack-->",$strDetail,$mosl_lv0113->lv009);?></td>
  </tr>
</table>
</body>
<?php
	if(trim($mosl_lv0113->lv009)=="")
	{
?>
	<script language="javascript">
		window.close();
	</script>
<?php
	}
?>	
	<?php
} else {
	include("../permit.php");
}
?>

