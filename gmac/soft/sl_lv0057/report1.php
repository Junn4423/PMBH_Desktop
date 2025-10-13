<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0057.php");
require_once("../../clsall/sl_lv0013.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$mosl_lv0057=new sl_lv0057($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0057');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mosl_lv0057->LV_LoadID($vlv001);
$mosl_lv0013->LV_LoadID($mosl_lv0057->lv013);
$vArrMN=$mosl_lv0057->LV_GetMN($vlv001,$mosl_lv0057->lv010);
?>
<?php
if($mosl_lv0057->GetView()==1)
{
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<TITLE>PHIẾU THU</TITLE>
</head>
<style>
table td
{
	text-align:left;
	padding:5px;
}
</style>
<table width="280" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
  <TD COLSPAN=2>
    <div><div style="float:left"><img src="../../logo_tandatmy.png" width="50"/></div><div><?php echo ($mosl_lv0057->lv016>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0057->lv001."'>":"";?></div></div>
  </tr>	
   <tr>
    <td align="center" onDblClick="this.innerHTML=''" COLSPAN=2>
	<div> 
	
		<div style="padding:10px">
	<strong><?php echo $mosl_lv0057->GetCompany();?></strong><br><?php echo $mosl_lv0057->GetAddress();?>
<br><?php echo "Điện thoại: ";?><?php echo $mosl_lv0057->GetPhone();?>    
		</div>
	
</td>
  </tr>
  <tr>
    <td align="center" COLSPAN=2 style="text-align:center"><font style="font-size:25px;font-weight:bold">PHIẾU TRẢ TIỀN ỨNG</font></td>
  </tr>
  <tr>
  <td colspan=2 style="text-align:center">
	<strong>NGÀY:</strong><?php echo $mosl_lv0057->FormatView($mosl_lv0057->lv009,4);?>
  </td>
  </tr>
   <tr>
    <td align="center" COLSPAN=2>
		<div style="float:left;text-align:left;width:60%;font-weight:none">
			<div style="padding-right:10px">
				<strong>Số phòng:</strong> <?php echo $mosl_lv0013->getvaluelink('lv077',$mosl_lv0013->lv007);?>
				<br><strong>Bắt đầu :</strong> <?php echo $mosl_lv0013->FormatView($mosl_lv0013->lv004,4);?>
				
			</div>
		</div>
		<div style="float:left;text-align:left;width:40%;font-weight:none">
			<div style="padding-left:	0px">
			<strong>NV:</strong> <?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<br><strong>SỐ:</strong><?php echo $mosl_lv0057->lv001;?>
			</div>
		</div>
	</td>
  </tr>
</table>  
<table width="280" border="1" cellspacing="0" cellpadding="0" align="center">  
<TR VALIGN=TOP>
  <TD style="width:100px">Người nộp : </TD>
  <TD style="width:180px"><?php echo $mosl_lv0057->lv005;?>&nbsp;</TD>
  </TR>
<TR VALIGN=TOP>
  <TD =6>Địa chỉ : </TD>
  <TD =38><?php echo $mosl_lv0057->lv006;?>&nbsp;</TD>
  </TR>
<TR VALIGN=TOP>
  <TD =6>Lý do : </TD>
  <TD =38><?php echo $mosl_lv0057->lv007;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD  =6><strong>Số tiền :</strong></TD>
  <TD =38><strong><?php echo $mosl_lv0057->FormatView($vArrMN[4],1);?></strong></TD>
  </TR>
<TR VALIGN=TOP>
  <TD =6>Viết bằng chữ : </TD>
  <TD =38><?php echo LNum2Text($vArrMN[4],$plang);?>&nbsp;</TD>
  </TR>
<TR VALIGN=TOP>
  <TD =6>Kèm theo :  </TD>
  <TD =11><?php echo $mosl_lv0057->lv013;?>&nbsp;</TD>
</tr>
<tr> 
  <TD>Chứng từ gốc:</td><td> <?php echo $mosl_lv0057->lv015;?>&nbsp;</TD>
</TR>
</table>  
<table width="280" border="0" cellspacing="0" cellpadding="0" align="center">  
  <tr>
    <td align="right" colspan=2><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Người giao</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Khách hàng</b></span></b></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="60px"><td colspan="7">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<30; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<30; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
				</table></td>
  </tr>
</table>
</body>
<script language="javascript">
window.print()
</script>
</HTML>
<?php
} else {
	include("../permit.php");
}
?>