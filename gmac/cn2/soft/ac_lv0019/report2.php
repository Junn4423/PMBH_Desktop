<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0057.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$mosl_lv0057=new sl_lv0057($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0019');
$mosl_lv0057->LV_LoadID($vlv001);
$vArrMN=$mosl_lv0057->LV_GetMN($vlv001,$mosl_lv0057->lv010);
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<TITLE>PHIẾU CHI</TITLE>
<script language="javascript" src="../../javascript/printscript.js"></script>
</head>
<BODY >
<div ondblclick="this.innerHTML=''" style="padding:5px;">
<table style="width:100%;max-with:375px;" border="0" cellspacing="0" cellpadding="0" align="center">
	<?php echo ($mosl_lv0057->lv011>0)?"<tr><td><img style='max-width:375px;width:100%;height:50px;' src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0057->lv001."'></td></tr>":"<tr><td height=5></td></tr>";?>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''">
	<div style="clear:both;"> 
		<div style="float:left;width:85%;text-align:left;">
		
			<strong><span style="font:18px arial,tahoma"><?php echo $mosl_lv0057->GetCompany();?></span></strong>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐC: ';?><?php echo $mosl_lv0057->GetAddress();?></span>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐT: ';?><?php echo $mosl_lv0057->GetPhone();?>  </span>
			<!--<br><span style="font:10px arial,tahoma"><?php echo 'Web';?><?php echo $mosl_lv0057->GetWeb();?>   </span> -->
	</div>
	<div style="float:left;width:15%"><center><img src="../../logo.png" width="54"/></center></div>
    </div></td>
  </tr>
  <tr>
    <td align="center">
	<div id='idphieu'  style="font-size:18px;font-weight:bold">PHIẾU CHI</div></td>
  </tr>
  <tr>
    <td align="center" ondblclick="this.innerHTML='<B>Liên 2</B>'"><B>Liên 1</B></TD>
  </TR>
   <tr>
    <td align="center">
	<?php echo $mosl_lv0057->lv007;?>
	</td>
	</tr>
	<tr>
	<td>
	<br/>
			<table width="100%" style="border:0px;text-align:left;" cellpadding="0" cellspacing="0">
				<tr><td>Ngày: <?php echo getday($mosl_lv0057->lv009);?>/<?php echo getmonth($mosl_lv0057->lv009);?>/<?php echo getyear($mosl_lv0057->lv009);?></td><td><strong>Mã phiếu: </strong><?php echo $mosl_lv0057->lv001;?></td></tr>
				<tr><td>Mã NV: 	<?php echo $mosl_lv0057->lv008;?></td><td>In lúc: <?php echo substr(GetServerTime(),0,5);?>
				<tr><td><strong>Ghi nợ: </strong> <?php echo $vArrMN[2];?> </td><td> Ghi có: <?php echo $vArrMN[3];?></td></tr>
    </td>
  </tr>
  <tr></td>
			<table width="100%" style="border:0px;text-align:left;" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="left"><B>Số tiền: <?php echo $mosl_lv0057->FormatView($vArrMN[4],10);?> đồng</B></TD>
      </TR>
      <tr>
        <td colspan="4" align="left"><B>Viết bằng chữ : <?php echo LNum2Text($vArrMN[4],$plang);?></B></TD>
      </TR>
          <TR VALIGN=TOP>
          <TD NOWRAP ALIGN="CENTER"><B>Người duyệt</B></TD>
          <TD NOWRAP ALIGN="CENTER" COLSPAN=2><B>Người lập phiếu</B></TD>
      </TR>
      <TR VALIGN=TOP height="100">
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>&nbsp;</TD>
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>&nbsp;</TD>
      </TR>
      <TR VALIGN=TOP>
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>(Ký, ghi rõ họ tên)</TD>
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>(Ký, ghi rõ họ tên)</TD>
      </TR>
      </table>
</td>
</tr>
</table>
</div>