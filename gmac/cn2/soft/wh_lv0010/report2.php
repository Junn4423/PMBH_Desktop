<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0010.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/wh_lv0011.php");
require_once("../../clsall/wh_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/sl_lv0009.php");
require_once("../../clsall/wh_lv0020.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mowh_lv0011=new wh_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0011');
$mowh_lv0010=new wh_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0010');
$mosl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0009');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0020');
$mowh_lv0001=new wh_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0001');

$mowh_lv0011->objlot=$mowh_lv0020;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0015.txt",$plang);
$mowh_lv0010->lang=strtoupper($plang);
$mowh_lv0010->lv001=$vlv001;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vtitle=$vLangArr[37];;
//$mowh_lv0010->ArrPush[0]=$vLangArr[37];
$mowh_lv0010->ArrPush[1]=$vLangArr[18];
$mowh_lv0010->ArrPush[2]=$vLangArr[19];
$mowh_lv0010->ArrPush[3]=$vLangArr[20];
$mowh_lv0010->ArrPush[4]=$vLangArr[21];
$mowh_lv0010->ArrPush[5]=$vLangArr[22];
$mowh_lv0010->ArrPush[6]=$vLangArr[23];
$mowh_lv0010->ArrPush[7]=$vLangArr[24];
$mowh_lv0010->ArrPush[8]=$vLangArr[25];
$mowh_lv0010->ArrPush[9]=$vLangArr[26];
$mowh_lv0010->ArrPush[10]=$vLangArr[27];
$mowh_lv0010->ArrPush[11]=$vLangArr[40];
$mowh_lv0010->ArrPush[12]=$vLangArr[41];
$mowh_lv0010->ArrPush[13]=$vLangArr[42];

$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv006,lv008,lv009,lv010,lv011";
$strParent=$mowh_lv0010->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mowh_lv0011->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0017.txt",$plang);
$mowh_lv0011->ArrPush[0]=$vLangArr[17];
$mowh_lv0011->ArrPush[1]=$vLangArr[18];
$mowh_lv0011->ArrPush[2]=$vLangArr[19];
$mowh_lv0011->ArrPush[3]=$vLangArr[20];
$mowh_lv0011->ArrPush[4]=$vLangArr[21];
$mowh_lv0011->ArrPush[5]=$vLangArr[22];
$mowh_lv0011->ArrPush[6]=$vLangArr[23];
$mowh_lv0011->ArrPush[7]=$vLangArr[24];
$mowh_lv0011->ArrPush[8]=$vLangArr[25];
$mowh_lv0011->ArrPush[9]=$vLangArr[26];
$mowh_lv0011->ArrPush[10]=$vLangArr[27];
$mowh_lv0011->ArrPush[11]=$vLangArr[28];
$mowh_lv0011->ArrPush[12]=$vLangArr[29];
$mowh_lv0011->ArrPush[13]=$vLangArr[30];
$mowh_lv0011->ArrPush[14]=$vLangArr[31];
$mowh_lv0011->ArrPush[15]=$vLangArr[32];
$mowh_lv0011->ArrPush[16]=$vLangArr[33];
$mowh_lv0011->ArrPush[17]=$vLangArr[34];
$mowh_lv0011->ArrPush[18]=$vLangArr[42];
$mowh_lv0011->ArrPush[22]=$vLangArr[42];
$mowh_lv0011->ArrPush[98]=$vLangArr[43];
$mowh_lv0011->ArrPush[99]=$vLangArr[44];
$mowh_lv0011->ArrPush[89]=$vLangArr[45];
$mowh_lv0011->ArrPush[100]='PO#/ContractID';
$mowh_lv0011->ArrPush[200]='Ngày hết hạn';
if($plang=="") $plang="EN";
//$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


 $mowh_lv0011->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mowh_lv0010->GetView()==1)
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
	$mowh_lv0010->LV_LoadID($vlv001);
	if($mowh_lv0010->lv005=='GMAC')
	{
		$mosl_lv0013->LV_LoadID($mowh_lv0010->lv006);
		$mohr_lv0020->LV_LoadID($mosl_lv0013->lv010);
		$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
		$mosl_lv0009->LV_LoadID($mosl_lv0013->lv007);
	}
	elseif($mowh_lv0010->lv005=='CUS')
	{
		$mosl_lv0001->LV_LoadID($mowh_lv0010->lv006);
		$mohr_lv0020->LV_LoadID($mowh_lv0010->lv003);
	}
	//$vFieldList="lv003,lv004,lv005,lv006,lv007,lv014,lv015";
	$mowh_lv0011->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0011');
//////////////////////////////////////////////////////////////////////////////////////////////////////
	$vFieldList=$mowh_lv0011->ListView;
	$vOrderList=$mowh_lv0011->ListOrder;
	$vSortNum=$mowh_lv0011->SortNum;
	 $strDetail=$mowh_lv0011->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mowh_lv0010->lv006);

			
	
	?>
	<table width="680" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
		<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo ($mowh_lv0010->lv007>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mowh_lv0010->lv001."'>":"";?></div></div></td>
	  </tr>	
  <tr>
		<td align="center">
		<font style="font-size:14px;font-weight:bold"><?php echo $mowh_lv0010->GetCompany();?></font>
		<br/>
		<div>
		Địa chỉ:<?php echo $mowh_lv0010->GetAddress();?>
		<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
		</div>
		</td>
	  </tr>
   <tr>
    <td><div align="center" class="lv0"><?php echo 'PHIẾU GIAO HÀNG';?></div></td>
	</tr>
	<tr>
	<td><div align="center" >Ngày <?php echo getday($mowh_lv0010->lv009);?> tháng <?php echo getmonth($mowh_lv0010->lv009);?> năm <?php echo getyear($mowh_lv0010->lv009);?></div></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td align="center">
		<div style="float:left;text-align:left;width:50%;font-weight:none">
			<div style="padding-right:10px">
				<strong>Mã Phiếu:</strong> <?php echo $vlv001;?>
				<br><strong>Tên KH:</strong> <?php echo $mosl_lv0001->lv002;?>
				<br><strong>Ð.CHỈ:</strong> <?php echo $mosl_lv0001->lv006;?>
				<br/><strong>Người giao hàng:</strong><?php echo $mosl_lv0013->LV_GetListEmp($mosl_lv0013->lv028);?>
			</div>
		</div>
		<div style="float:left;text-align:left;width:50%;font-weight:none">
			<div style="padding-left:10px">
			<strong>Xuất tại kho:</strong> <?php $mowh_lv0001->LV_LoadID($mowh_lv0010->lv002);echo $mowh_lv0001->lv003;?>
			<br><strong>NV:</strong> <?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<br/><strong>ÐT:</strong> <?php echo $mohr_lv0020->lv039;?>
				
			</div>
		</div>
	</td>
  </tr>
  <tr>
    <td align="center"><?php //echo $strParent;?></td>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $strDetail;?></td>
  </tr>
  <tr>
    <td align="left" ><br/><?php echo $mowh_lv0010->lv008;;?></td>
  </tr>
  <tr>
    <td align="right" ><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="20">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><center><?php echo 'Giám đốc';?><center></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><center><?php echo 'Kho';?><center></b></span></b></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><span class="center_style" style="cursor:move"><b><center><?php echo 'Người lập phiếu';?></center></b></span></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b><center><?php echo 'Người nhận';?><center></b></span></b></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><?php for($i=0; $i<60; $i++) echo ".";?></center></td>
						<td>&nbsp;</td>
						<td class="center_style" onDblClick="this.innerHTML=''" style="cursor:move"><center><?php for($i=0; $i<60; $i++) echo ".";?></center></td>
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
	include("../permit.php");
}
?>
