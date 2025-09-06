<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0059.php");
require_once("../../clsall/sl_lv0060.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0059');
$mosl_lv0060=new sl_lv0060($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0060');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0070.txt",$plang);
$mosl_lv0059->lang=strtoupper($plang);
$mosl_lv0059->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0059->ArrPush[0]=$vLangArr[17];
$mosl_lv0059->ArrPush[1]=$vLangArr[18];
$mosl_lv0059->ArrPush[2]=$vLangArr[20];
$mosl_lv0059->ArrPush[3]=$vLangArr[21];
$mosl_lv0059->ArrPush[4]=$vLangArr[22];
$mosl_lv0059->ArrPush[5]=$vLangArr[23];
$mosl_lv0059->ArrPush[6]=$vLangArr[24];
$mosl_lv0059->ArrPush[7]=$vLangArr[25];
$mosl_lv0059->ArrPush[8]=$vLangArr[26];
$mosl_lv0059->ArrPush[9]=$vLangArr[27];
$mosl_lv0059->ArrPush[10]=$vLangArr[28];
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006";
$strParent=$mosl_lv0059->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mosl_lv0060->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr1=GetLangFile("../../","SL0072.txt",$plang);
$mosl_lv0060->ArrPush[0]=$vLangArr1[17];
$mosl_lv0060->ArrPush[1]=$vLangArr1[18];
$mosl_lv0060->ArrPush[2]=$vLangArr1[19];
$mosl_lv0060->ArrPush[3]=$vLangArr1[20];
$mosl_lv0060->ArrPush[4]=$vLangArr1[21];
$mosl_lv0060->ArrPush[5]=$vLangArr1[22];
$mosl_lv0060->ArrPush[6]=$vLangArr1[23];
$mosl_lv0060->ArrPush[7]=$vLangArr1[24];
$mosl_lv0060->ArrPush[8]=$vLangArr1[25];
if($plang=="") $plang="EN";
$vOrderList="1,2,3,4,5,6,7";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mosl_lv0060->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mosl_lv0059->GetView()==1)
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
	$mosl_lv0059->LV_LoadID($vlv001);
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007";
	 $strDetail=$mosl_lv0060->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0059->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><?php echo ($mosl_lv0059->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0059->lv001."'>":"";?></td>
  </tr>	
  <tr>
    <td align="center"><img  src="<?php echo $mosl_lv0060->GetLogo();?>" /></td>
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
    <td align="left" ><?php echo $mosl_lv0059->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $vLangArr[39];?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo $mosl_lv0059->GetCompany();?></b></span></td>
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