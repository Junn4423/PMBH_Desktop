<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ac_lv0019.php");
require_once("../../clsall/hr_lv0001.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$moac_lv0019=new ac_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0019');
$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
$moac_lv0019->LV_LoadID($vlv001);
$mohr_lv0001->LV_LoadID($moac_lv0019->lv022);
$vArrMN=$moac_lv0019->LV_GetMN($vlv001,$moac_lv0019->lv010);
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>PHIẾU CHI</TITLE>
<script language="javascript" src="../../javascript/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<BODY BGCOLOR="FFFFFF" style="">
<TABLE CELLPADDING=0 CELLSPACING=0 width="600" align="center">
<TR style="height:1px">
<TD WIDTH=0.210%></TD>
<TD WIDTH=0.456%></TD>
<TD WIDTH=0.070%></TD>
<TD WIDTH=8%></TD>
<TD WIDTH=6%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=0.526%></TD>
<TD WIDTH=7%></TD>
<TD WIDTH=0.439%></TD>
<TD WIDTH=7%></TD>
<TD WIDTH=0.631%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.658%></TD>
<TD WIDTH=0.351%></TD>
<TD WIDTH=0.009%></TD>
<TD WIDTH=0.693%></TD>
<TD WIDTH=4%></TD>
<TD WIDTH=0.368%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=0.439%></TD>
<TD WIDTH=0.325%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=3%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=6%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.728%></TD>
<TD WIDTH=2%></TD>
<TD WIDTH=0.351%></TD>
<TD WIDTH=9%></TD>
<TD WIDTH=0.395%></TD>
<TD WIDTH=0.105%></TD>
<TD WIDTH=1%></TD>
<TD WIDTH=5%></TD>
<TD WIDTH=0.088%></TD>
<TD WIDTH=0.263%></TD>
<TD WIDTH=0.395%></TD>
<TD WIDTH=0.026%></TD>
<TD WIDTH=0.044%></TD>
<TD WIDTH=0.061%></TD>
<TD WIDTH=0.859%></TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44 align="right"><?php echo ($moac_lv0019->lv016>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$moac_lv0019->lv001."'>":"";?></TD>
</TR>
<!--<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=13 onDblClick="this.innerHTML=''"><img  src="<?php echo $moac_lv0019->GetLogo();?>" /></TD>
</TR>-->
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><?php echo $mohr_lv0001->lv002;?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><?php echo $mohr_lv0001->lv003;?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 02 - TT</B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo QĐ số: 15/2006/QĐ-BTC <BR> ngày 20/3/2006 của Bộ trưởng BTC)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>PHIẾU CHI</B></TD>
<TD COLSPAN=5></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=14></TD>
<TD NOWRAP COLSPAN=10 ROWSPAN=2><FONT SIZE=3 FACE=".VnTime">Ngày:</FONT><?php echo $moac_lv0019->FormatView($moac_lv0019->lv009,2);?></TD>
<TD COLSPAN=19>Số:<?php echo $moac_lv0019->lv001;?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=14></TD>
<TD COLSPAN=26></TD>
</TR>


<TR VALIGN=TOP>
  <TD COLSPAN=14>&nbsp;</TD>
  <TD COLSPAN=11></TD>
  <TD NOWRAP COLSPAN=18>Ghi nợ: <?php 
  $vArrView=split(",",$vArrMN[2]);
	if(count($vArrView)==1)
  		echo $vArrMN[2];
	else
		{
			for($i=0;$i<count($vArrView);$i++)
			{
				if($i==0)
					echo $vArrView[$i].": ".$moac_lv0019->LV_GetAccountAmount($vlv001,$moac_lv0019->lv010,$vArrView[$i]);
				else
				{
				echo '<br>';
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$vArrView[$i].": ".$moac_lv0019->LV_GetAccountAmount($vlv001,$moac_lv0019->lv010,$vArrView[$i]);
				}
				
			}
		}
  ?></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=14>&nbsp;</TD>
  <TD COLSPAN=11></TD>
  <TD NOWRAP COLSPAN=18>Ghi có:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php 
  if(count($vArrView)==1 && count(split(",",$vArrMN[3]))==1)
	  echo $vArrMN[3];
  else
  {
	  echo $vArrMN[3].":";?> <?php echo $moac_lv0019->FormatView($vArrMN[4],10);?>
    <?php
  }
  ?></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6 style="white-space:nowrap">Họ và tên người nhận : </TD>
  <TD COLSPAN=38><?php echo $moac_lv0019->lv005;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Địa chỉ : </TD>
  <TD COLSPAN=38><?php echo $moac_lv0019->lv006;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Lý do : </TD>
  <TD COLSPAN=38><?php echo $moac_lv0019->lv007;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD  COLSPAN=6>Số tiền :</TD>
  <TD COLSPAN=38><?php echo $moac_lv0019->FormatView($vArrMN[4],10);?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Viết bằng chữ : </TD>
  <TD COLSPAN=38><?php echo LNum2Text($vArrMN[4],$plang);?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Kèm theo :  </TD>
  <TD COLSPAN=11><?php echo $moac_lv0019->lv013;?></TD>
  <TD NOWRAP COLSPAN=27>Chứng từ gốc: <?php echo $moac_lv0019->lv015;?></TD>
</TR>
<TR VALIGN=TOP style="height:1px">
<TD COLSPAN=10></TD>
<TD COLSPAN=7></TD>
<TD NOWRAP COLSPAN=27></TD>
</TR>

<TR VALIGN=TOP>
  <TD NOWRAP ALIGN="RIGHT" COLSPAN=39><I>Ngày ........&nbsp;&nbsp;tháng ........ năm <?php echo substr(getyear($vNow),0,3);?>...</I></TD>
<TD COLSPAN=6></TD>
</TR>

<TR VALIGN=TOP>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6><B>Giám đốc</B></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><B>Kế toán trưởng</B></TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><B>Người nhận tiền</B></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><B>Người lập phiếu</B></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=11><B>Thủ quỹ</B></TD>
<TD></TD>
</TR>
<TR VALIGN=TOP>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7>(Ký, ghi rõ họ tên)</TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=11>(Ký, ghi rõ họ tên)</TD>
<TD></TD>
</TR>

<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=85>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=11 ROWSPAN=2>Đã nhận đủ tiền (Viết bằng chữ): </TD>
<TD></TD>
<TD NOWRAP COLSPAN=29><?php echo LNum2Text($vArrMN[4],$plang);?></TD>
<TD COLSPAN=3></TD>
</TR>
</TABLE>
</BODY></HTML>
