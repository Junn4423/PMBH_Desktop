<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0004.php");
require_once("../../clsall/wh_lv0005.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mowh_lv0005=new wh_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0005');
$mowh_lv0004=new wh_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0005.txt",$plang);
$mowh_lv0004->lang=strtoupper($plang);
$mowh_lv0004->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0004->ArrPush[0]=$vLangArr[16];
$mowh_lv0004->ArrPush[1]=$vLangArr[18];
$mowh_lv0004->ArrPush[2]=$vLangArr[19];
$mowh_lv0004->ArrPush[3]=$vLangArr[20];
$mowh_lv0004->ArrPush[4]=$vLangArr[21];
$mowh_lv0004->ArrPush[5]=$vLangArr[22];
$mowh_lv0004->ArrPush[6]=$vLangArr[23];
$mowh_lv0004->ArrPush[7]=$vLangArr[24];
$mowh_lv0004->ArrPush[8]=$vLangArr[25];
$mowh_lv0004->ArrPush[9]=$vLangArr[26];
$mowh_lv0004->ArrPush[10]=$vLangArr[27];
$mowh_lv0004->ArrPush[11]=$vLangArr[28];
$mowh_lv0004->ArrPush[12]=$vLangArr[29];
$mowh_lv0004->ArrPush[13]=$vLangArr[30];
$mowh_lv0004->ArrPush[14]=$vLangArr[31];	
$mowh_lv0004->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0004');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0004->ListView;
$curPage = $mowh_lv0004->CurPage;
$maxRows =$mowh_lv0004->MaxRows;
$vOrderList=$mowh_lv0004->ListOrder;
$strParent=$mowh_lv0004->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mowh_lv0005->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0008.txt",$plang);
$mowh_lv0005->ArrPush[0]=$vLangArr[17];
$mowh_lv0005->ArrPush[1]=$vLangArr[18];
$mowh_lv0005->ArrPush[2]=$vLangArr[19];
$mowh_lv0005->ArrPush[3]=$vLangArr[20];
$mowh_lv0005->ArrPush[4]=$vLangArr[21];
$mowh_lv0005->ArrPush[5]=$vLangArr[22];
$mowh_lv0005->ArrPush[6]=$vLangArr[23];
$mowh_lv0005->ArrPush[7]=$vLangArr[24];
$mowh_lv0005->ArrPush[8]=$vLangArr[25];
$mowh_lv0005->ArrPush[9]=$vLangArr[26];
$mowh_lv0005->ArrPush[10]=$vLangArr[27];
$mowh_lv0005->ArrPush[11]=$vLangArr[28];
$mowh_lv0005->ArrPush[12]=$vLangArr[29];
$mowh_lv0005->ArrPush[13]=$vLangArr[30];
$mowh_lv0005->ArrPush[14]=$vLangArr[38];
$mowh_lv0005->ArrPush[15]=$vLangArr[39];
$mowh_lv0005->ArrPush[16]=$vLangArr[40];
$mowh_lv0005->ArrPush[17]=$vLangArr[41];
$mowh_lv0005->ArrPush[100]='Mã SP';

$mowh_lv0005->ArrFunc[0]='//Function';
$mowh_lv0005->ArrFunc[1]=$vLangArr[2];
$mowh_lv0005->ArrFunc[2]=$vLangArr[4];
$mowh_lv0005->ArrFunc[3]=$vLangArr[6];
$mowh_lv0005->ArrFunc[4]=$vLangArr[7];
$mowh_lv0005->ArrFunc[5]='';
$mowh_lv0005->ArrFunc[6]='';
$mowh_lv0005->ArrFunc[7]='';
$mowh_lv0005->ArrFunc[8]=$vLangArr[10];
$mowh_lv0005->ArrFunc[9]=$vLangArr[12];
$mowh_lv0005->ArrFunc[10]=$vLangArr[0];
$mowh_lv0005->ArrFunc[11]=$vLangArr[33];
$mowh_lv0005->ArrFunc[12]=$vLangArr[34];
$mowh_lv0005->ArrFunc[13]=$vLangArr[35];
$mowh_lv0005->ArrFunc[14]=$vLangArr[36];
$mowh_lv0005->ArrFunc[15]=$vLangArr[37];

////Other
$mowh_lv0005->ArrOther[1]=$vLangArr[31];
$mowh_lv0005->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="EN";
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mowh_lv0005->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mowh_lv0004->GetView()==1)
{
?>
<html>
<head>
<title><?php echo $mowh_lv0004->ArrPush[0];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascript/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<?php  
	$mowh_lv0004->LV_LoadID($vlv001);
	$mowh_lv0005->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0005');
//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mowh_lv0005->ListView;
	$curPage = $mowh_lv0005->CurPage;
	$maxRows =$mowh_lv0005->MaxRows;
	$vOrderList=$mowh_lv0005->ListOrder;
	 $strDetail=$mowh_lv0005->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0004->lv006);

			
	
	?>
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
		<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo ($mowh_lv0004->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mowh_lv0004->lv001."'>":"";?></div></div></td>
	  </tr>	
  <tr>
		<td align="center">
		<font style="font-size:14px;font-weight:bold"><?php echo $mowh_lv0004->GetCompany();?></font>
		<br/>
		<div>
		Địa chỉ:<?php echo $mowh_lv0004->GetAddress();?>
		<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
		</div>
		</td>
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
    <td align="left" ><?php echo $mowh_lv0004->lv009;;?></td>
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
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><center><?php echo 'Người nhận';?><center></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><center><?php echo 'Người lập phiếu';?><center></b></span></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><?php for($i=0; $i<60; $i++) echo ".";?></center></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><?php for($i=0; $i<60; $i++) echo ".";?></center></td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
  </tr>
</table>
</body>
</html>					
<?php
} else {
	include("../wh_lv0004/permit.php");
}
?>
