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
$mosl_lv0058=new sl_lv0058($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0018');
$mosl_lv0058->LV_LoadID($vlv001);
$vArrMN=$mosl_lv0058->LV_GetMN($vlv001,$mosl_lv0058->lv010);
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<TITLE>PHIẾU THU</TITLE>
<script language="javascript" src="../../javascript/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<BODY BGCOLOR="FFFFFF" TOPMARGIN=24 LEFTMARGIN=34>
<TABLE CELLPADDING=0 CELLSPACING=0 width="600" align="center">
<TR>
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
<TD NOWRAP COLSPAN=44 align="right"><?php echo ($mosl_lv0058->lv016>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0058->lv001."'>":"";?></TD>
</TR>
<!--<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=13  ondblclick="this.innerHTML=''"><img  src="<?php echo $mosl_lv0058->GetLogo();?>" /></TD>
</TR>-->
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><?php echo $mosl_lv0058->GetCompany();?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><?php echo $mosl_lv0058->GetAddress();?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 02 - TT</B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo QĐ số: 15/2006/QĐ-BTC <BR> ngày 20/3/2006 của Bộ trưởng BTC)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP><TD NOWRAP ALIGN="CENTER" COLSPAN=44><B><font style="font:bold 24px Arial, Tahoma">PHIẾU THU</font></B></TD></TR>
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>Liên 1(lưu)</B></TD>
<TD COLSPAN=5></TD>
</TR>
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
  <TD COLSPAN=38><?php echo $mosl_lv0058->FormatView($vArrMN[4],10);?></TD>
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
<TD COLSPAN=44 HEIGHT=95>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6><!--(Ký, ghi rõ họ tên)--></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><!--(Ký, ghi rõ họ tên)--></TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6><?php //echo $mosl_lv0058->getvaluelink('lv111',$mosl_lv0058->lv008);?></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><?php echo $mosl_lv0058->getvaluelink('lv111',getInfor($_SESSION['ERPSOFV2RUserID'],2));?></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=11><!--(Ký, ghi rõ họ tên)--></TD>
<TD></TD>
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
</TABLE>
<div   ondblclick="this.innerHTML=''" >
<div style="height:30px">&nbsp;</div>
</div>
<TABLE CELLPADDING=0 CELLSPACING=0 width="600" align="center">
<TR>
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
<TD NOWRAP COLSPAN=44 align="right"><?php echo ($mosl_lv0058->lv016>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0058->lv001."'>":"";?></TD>
</TR>
<!--<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=13  ondblclick="this.innerHTML=''"><img  src="<?php echo $mosl_lv0058->GetLogo();?>" /></TD>
</TR>-->
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><?php echo $mosl_lv0058->GetCompany();?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><?php echo $mosl_lv0058->GetAddress();?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 02 - TT</B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo QĐ số: 15/2006/QĐ-BTC <BR> ngày 20/3/2006 của Bộ trưởng BTC)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP><TD NOWRAP ALIGN="CENTER" COLSPAN=44><B><font style="font:bold 24px Arial, Tahoma">PHIẾU THU</font></B></TD></TR>
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>Liên 2</B></TD>
<TD COLSPAN=5></TD>
</TR>
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
  <TD COLSPAN=38><?php echo $mosl_lv0058->FormatView($vArrMN[4],10);?></TD>
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
<TD COLSPAN=44 HEIGHT=95>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6><!--(Ký, ghi rõ họ tên)--></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><!--(Ký, ghi rõ họ tên)--></TD>
<TD COLSPAN=2></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=6><?php //echo $mosl_lv0058->getvaluelink('lv111',$mosl_lv0058->lv008);?></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><?php echo $mosl_lv0058->getvaluelink('lv111',getInfor($_SESSION['ERPSOFV2RUserID'],2));?></TD>
<TD></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=11><!--(Ký, ghi rõ họ tên)--></TD>
<TD></TD>
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
</TABLE>
</BODY></HTML>
