<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0008.php");
require_once("../../clsall/wh_lv0009.php");
require_once("../../clsall/wh_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mowh_lv0009=new wh_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0102');
$mowh_lv0008=new wh_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0102');
$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0102');
$mowh_lv0009->objlot=$mowh_lv0020;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0010.txt",$plang);
$mowh_lv0008->lang=strtoupper($plang);
$mowh_lv0008->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vKeeper=$vLangArr[37];
$mowh_lv0008->ArrPush[0]=$vLangArr[38];
$mowh_lv0008->ArrPush[1]=$vLangArr[18];
$mowh_lv0008->ArrPush[2]=$vLangArr[19];
$mowh_lv0008->ArrPush[3]=$vLangArr[20];
$mowh_lv0008->ArrPush[4]=$vLangArr[21];
$mowh_lv0008->ArrPush[5]=$vLangArr[22];
$mowh_lv0008->ArrPush[6]=$vLangArr[23];
$mowh_lv0008->ArrPush[7]=$vLangArr[24];
$mowh_lv0008->ArrPush[8]=$vLangArr[25];
$mowh_lv0008->ArrPush[9]=$vLangArr[26];
$mowh_lv0008->ArrPush[10]=$vLangArr[27];
$mowh_lv0008->ArrPush[11]=$vLangArr[39];
$mowh_lv0008->ArrPush[100]='Từ kho';
$vtitle=$vLangArr[38];
$mowh_lv0008->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0008');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0008->ListView;
$vOrderList=$mowh_lv0008->ListOrder;
$vSortNum=$mowh_lv0008->SortNum;
$strParent=$mowh_lv0008->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mowh_lv0009->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0012.txt",$plang);
$mowh_lv0009->ArrPush[0]=$vLangArr[17];
$mowh_lv0009->ArrPush[1]=$vLangArr[18];
$mowh_lv0009->ArrPush[2]=$vLangArr[19];
$mowh_lv0009->ArrPush[3]=$vLangArr[20];
$mowh_lv0009->ArrPush[4]=$vLangArr[21];
$mowh_lv0009->ArrPush[5]=$vLangArr[22];
$mowh_lv0009->ArrPush[6]=$vLangArr[23];
$mowh_lv0009->ArrPush[7]=$vLangArr[24];
$mowh_lv0009->ArrPush[8]=$vLangArr[25];
$mowh_lv0009->ArrPush[9]=$vLangArr[26];
$mowh_lv0009->ArrPush[10]=$vLangArr[27];
$mowh_lv0009->ArrPush[11]=$vLangArr[28];
$mowh_lv0009->ArrPush[12]=$vLangArr[29];
$mowh_lv0009->ArrPush[13]=$vLangArr[30];
$mowh_lv0009->ArrPush[14]=$vLangArr[31];
$mowh_lv0009->ArrPush[15]=$vLangArr[32];
$mowh_lv0009->ArrPush[16]=$vLangArr[33];
$mowh_lv0009->ArrPush[17]=$vLangArr[34];
$mowh_lv0009->ArrPush[18]=$vLangArr[42];
$mowh_lv0009->ArrPush[42]=$vLangArr[42];
$mowh_lv0009->ArrPush[43]=$vLangArr[43];
$mowh_lv0009->ArrPush[44]=$vLangArr[44];
$mowh_lv0009->ArrPush[89]=$vLangArr[49];
if($plang=="") $plang="EN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mowh_lv0009->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mowh_lv0008->GetView()==1)
{
?>
<html>
<head>
<title><?php echo $vtitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascript/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mowh_lv0008->LV_LoadID($vlv001);
	$mowh_lv0009->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0009');
//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mowh_lv0009->ListView;
	$vOrderList=$mowh_lv0009->ListOrder;
	$vSortNum=$mowh_lv0009->SortNum;
	 $strDetail=$mowh_lv0009->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0008->lv006);
	?>
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr>
		<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo ($mowh_lv0008->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mowh_lv0008->lv001."'>":"";?></div></div></td>
	  </tr>	
  <tr>
		<td align="center">
		<font style="font-size:14px;font-weight:bold"><?php echo $mowh_lv0008->GetCompany();?></font>
		<br/>
		<div>
		Địa chỉ:<?php echo $mowh_lv0008->GetAddress();?>
		<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
		</div>
		</td>
	  </tr>
   <tr>
   <tr>
    <td><div align="center" class="lv0"><?php echo $vtitle;?></div></td>
	</tr>
   <tr>
	<td><div align="center" ><strong>Ngày</strong> <?php echo getday($mowh_lv0008->lv009);?> <strong>tháng</strong> <?php echo getmonth($mowh_lv0008->lv009);?> <strong>năm</strong> <?php echo getyear($mowh_lv0008->lv009);?></div></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><?php echo $vKeeper;?></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><?php echo 'Người lập phiếu';?></b></span></td>
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
