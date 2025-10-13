<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0024.php");
require_once("../../clsall/sl_lv0025.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0025=new sl_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0025');
$mosl_lv0024=new sl_lv0024($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0024');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0040.txt",$plang);
$mosl_lv0024->lang=strtoupper($plang);
$mosl_lv0024->lv001=$vlv001;
$buyer=$vLangArr[39];
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0024->ArrPush[0]=$vLangArr[38];
$mosl_lv0024->ArrPush[1]=$vLangArr[18];
$mosl_lv0024->ArrPush[2]=$vLangArr[19];
$mosl_lv0024->ArrPush[3]=$vLangArr[20];
$mosl_lv0024->ArrPush[4]=$vLangArr[21];
$mosl_lv0024->ArrPush[5]=$vLangArr[22];
$mosl_lv0024->ArrPush[6]=$vLangArr[23];
$mosl_lv0024->ArrPush[7]=$vLangArr[24];
$mosl_lv0024->ArrPush[8]=$vLangArr[25];
$mosl_lv0024->ArrPush[9]=$vLangArr[26];
$mosl_lv0024->ArrPush[10]=$vLangArr[27];
$mosl_lv0024->ArrPush[11]=$vLangArr[30];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006,lv008,lv009,lv010";
$strParent=$mosl_lv0024->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mosl_lv0025->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0017.txt",$plang);
$mosl_lv0025->ArrPush[0]=$vLangArr[17];
$mosl_lv0025->ArrPush[1]=$vLangArr[18];
$mosl_lv0025->ArrPush[2]=$vLangArr[19];
$mosl_lv0025->ArrPush[3]=$vLangArr[20];
$mosl_lv0025->ArrPush[4]=$vLangArr[21];
$mosl_lv0025->ArrPush[5]=$vLangArr[22];
$mosl_lv0025->ArrPush[6]=$vLangArr[23];
$mosl_lv0025->ArrPush[7]=$vLangArr[24];
$mosl_lv0025->ArrPush[8]=$vLangArr[25];
$mosl_lv0025->ArrPush[9]=$vLangArr[26];
$mosl_lv0025->ArrPush[10]=$vLangArr[27];
$mosl_lv0025->ArrPush[11]=$vLangArr[28];
$mosl_lv0025->ArrPush[12]=$vLangArr[29];
$mosl_lv0025->ArrPush[13]=$vLangArr[30];
$mosl_lv0025->ArrPush[14]=$vLangArr[31];
$mosl_lv0025->ArrPush[15]=$vLangArr[32];
$mosl_lv0025->ArrPush[16]=$vLangArr[33];
$mosl_lv0025->ArrPush[22]=$vLangArr[42];
if($plang=="") $plang="EN";
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mosl_lv0025->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mosl_lv0024->GetView()==1)
{
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
	<?php  
	$mosl_lv0024->LV_LoadID($vlv001);
	$vFieldList="lv003,lv004,lv005,lv008,lv010,lv011,lv021";
	 $strDetail=$mosl_lv0025->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0024->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mosl_lv0024->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0024->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center" ondblclick="this.innerHTML=''"><img  src="<?php echo $mosl_lv0025->GetLogo();?>" /></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strParent;?></td>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  <tr>
    <td align="left" ><?php echo $mosl_lv0024->FormatView($mosl_lv0024->lv009,2);?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $buyer;?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mosl_lv0024->GetCompany();?></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<60; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
  </tr>
</table>
</body>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
