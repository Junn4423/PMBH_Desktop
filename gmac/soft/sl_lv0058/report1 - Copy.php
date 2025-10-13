<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0058.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
$vNow=GetServerDate();
/////////////init object//////////////
$mosl_lv0058=new sl_lv0058($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0057');
$mosl_lv0058->LV_LoadID($vlv001);
$vArrMN=$mosl_lv0058->LV_GetMN($vlv001,$mosl_lv0058->lv010);
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<TITLE>PHIẾU THU</TITLE>
</head>
<BODY BGCOLOR="FFFFFF" TOPMARGIN=24 LEFTMARGIN=34>
<A id="begin" name="begin"/>      <BR>&nbsp;&nbsp;
<TABLE CELLPADDING=0 CELLSPACING=0 width="280" align="center">

<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44 align="right">
 <div><div style="float:left"><img src="../../logo_tandatmy.png" width="50"/></div><div><?php echo ($mosl_lv0058->lv016>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0058->lv001."'>":"";?></div></div>
</TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><?php echo $mosl_lv0058->GetCompany();?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><?php echo $mosl_lv0058->GetAddress();?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 01 - TT</B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo quyết định số 48/2006/Q§-BTC 
<BR>
ngày 14/9/2006 của Bộ Trưởng BTC)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP><TD NOWRAP ALIGN="CENTER" COLSPAN=44><B><font style="font:bold 24px Arial, Tahoma">PHIẾU THU</font></B></TD></TR>
<TR VALIGN=TOP>
<TD COLSPAN=14></TD>
<TD NOWRAP COLSPAN=4 ROWSPAN=2><FONT SIZE=3 FACE=".VnTime">Ngày:</FONT></TD>
<TD></TD>
<TD NOWRAP COLSPAN=6><?php echo $mosl_lv0058->FormatView($mosl_lv0058->lv009,2);?></TD>
<TD COLSPAN=19>Số:<?php echo $mosl_lv0058->lv001;?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=14></TD>
<TD COLSPAN=26></TD>
</TR>


<TR VALIGN=TOP>
  <TD COLSPAN=14>&nbsp;</TD>
  <TD COLSPAN=11></TD>
  <TD NOWRAP COLSPAN=18>Ghi nợ:<?php echo $vArrMN[2];?></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=14>&nbsp;</TD>
  <TD COLSPAN=11></TD>
  <TD NOWRAP COLSPAN=18>Ghi có:<?php echo $vArrMN[3];?></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Họ và tên người nộp : </TD>
  <TD COLSPAN=38><?php echo $mosl_lv0058->lv005;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Địa chỉ : </TD>
  <TD COLSPAN=38><?php echo $mosl_lv0058->lv006;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Lý do : </TD>
  <TD COLSPAN=38><?php echo $mosl_lv0058->lv007;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD  COLSPAN=6>Số tiền :</TD>
  <TD COLSPAN=38><?php echo $mosl_lv0058->FormatView($vArrMN[4],1);?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Viết bằng chữ : </TD>
  <TD COLSPAN=38><?php echo LNum2Text($vArrMN[4],$plang);?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Kèm theo :  </TD>
  <TD COLSPAN=11><?php echo $mosl_lv0058->lv013;?></TD>
  <TD NOWRAP COLSPAN=27>Chứng từ gốc: <?php echo $mosl_lv0058->lv015;?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=10></TD>
<TD COLSPAN=7></TD>
<TD NOWRAP COLSPAN=27>&nbsp;</TD>
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
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><B>Người nộp tiền</B></TD>
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
<TD COLSPAN=44 HEIGHT=119>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=11 ROWSPAN=2>Đã nhận đủ tiền (Viết bằng chữ): </TD>
<TD></TD>
<TD NOWRAP COLSPAN=29><?php echo LNum2Text($vArrMN[4],$plang);?></TD>
<TD COLSPAN=3></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=33></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=92><FONT SIZE=1>&nbsp;</FONT></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=461><FONT SIZE=1>&nbsp;</FONT></TD>
</TR>
</TABLE>
<BR>
</BODY></HTML>
