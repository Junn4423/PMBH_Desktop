<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ac_lv0017.php");
require_once("../../clsall/ac_lv0068.php");
//$ma=$_GET['ma'];
$vNow=GetServerDate();
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","AC0039.txt",$plang);
$moac_lv0017->lang=strtoupper($plang);
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$moac_lv0017=new ac_lv0017($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0061');
$moac_lv0068=new ac_lv0068($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0068');

$moac_lv0068->ArrPush[0]=$vLangArr[17];
$moac_lv0068->ArrPush[1]=$vLangArr[18];
$moac_lv0068->ArrPush[2]=$vLangArr[19];
$moac_lv0068->ArrPush[3]=$vLangArr[20];
$moac_lv0068->ArrPush[4]=$vLangArr[21];
$moac_lv0068->ArrPush[5]=$vLangArr[22];
$moac_lv0068->ArrPush[6]=$vLangArr[23];
$moac_lv0068->ArrPush[7]=$vLangArr[24];
$moac_lv0068->ArrPush[8]=$vLangArr[25];
$moac_lv0068->ArrPush[9]=$vLangArr[26];
$moac_lv0068->ArrPush[10]=$vLangArr[27];
$moac_lv0068->ArrPush[11]=$vLangArr[28];
$moac_lv0068->ArrPush[12]=$vLangArr[29];
$moac_lv0068->ArrPush[13]=$vLangArr[30];
$moac_lv0068->ArrPush[14]=$vLangArr[31];
$moac_lv0068->ArrPush[15]=$vLangArr[32];
$moac_lv0068->ArrPush[16]=$vLangArr[33];
$moac_lv0068->ArrPush[17]=$vLangArr[34];
$moac_lv0068->ArrPush[18]=$vLangArr[35];
$moac_lv0068->ArrPush[19]=$vLangArr[36];
$moac_lv0068->ArrPush[20]=$vLangArr[37];
$moac_lv0068->ArrPush[21]=$vLangArr[38];
$moac_lv0068->ArrPush[22]=$vLangArr[39];

$moac_lv0017->LV_LoadID($vlv001);
$vArrMN=$moac_lv0017->LV_GetMN($vlv001,$moac_lv0017->lv010);
$vFieldList="lv003,lv004,lv005,lv006,lv007,lv008,lv009";
$strDetail=$moac_lv0068->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vlv001);
?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
<TITLE>PHIẾU NHẬP KHO</TITLE>
<script language="javascript" src="../../javascript/printscript.js"></script>
<script language="javascript">loadImgsPrint("../../");</script>
</head>
<BODY BGCOLOR="FFFFFF" TOPMARGIN=24 LEFTMARGIN=34>
<A id="begin" name="begin"/>      <BR>&nbsp;&nbsp;
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
<TD NOWRAP COLSPAN=44 align="right"><?php echo ($moac_lv0017->lv016>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".$moac_lv0017->lv001."'>":"";?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=44 HEIGHT=13><img  src="<?php echo $moac_lv0017->GetLogo();?>" /></TD>
</TR>
<TR VALIGN=TOP>
<TD NOWRAP COLSPAN=44><?php echo $moac_lv0017->GetCompany();?></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=28><?php echo $moac_lv0017->GetAddress();?></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=5><B>Mẫu số 01 – VT</B></TD>
<TD COLSPAN=11></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=26></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=14>(Ban hành theo QĐ số: 15/2006/QĐ-BTC <BR> ngày 20/3/2006 của Bộ trưởng BTC)</TD>
<TD COLSPAN=4></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=3></TD>
<TD NOWRAP ALIGN="CENTER" COLSPAN=36><B>PHIẾU NHẬP KHO </B></TD>
<TD COLSPAN=5></TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=14></TD>
<TD NOWRAP COLSPAN=4 ROWSPAN=2><FONT SIZE=3 FACE=".VnTime">Ngày:</FONT></TD>
<TD></TD>
<TD NOWRAP COLSPAN=6><?php echo $moac_lv0017->FormatView($moac_lv0017->lv009,2);?></TD>
<TD COLSPAN=19>Số:<?php echo $moac_lv0017->lv001;?></TD>
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
  <TD COLSPAN=6>họ và tên Người nộp : </TD>
  <TD COLSPAN=38><?php echo $moac_lv0017->lv005;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Địa chỉ : </TD>
  <TD COLSPAN=38><?php echo $moac_lv0017->lv006;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Lý do : </TD>
  <TD COLSPAN=38><?php echo $moac_lv0017->lv007;?></TD>
  </TR>
<TR VALIGN=TOP>
  <TD COLSPAN=6>Kèm theo :  </TD>
  <TD COLSPAN=11><?php echo $moac_lv0017->lv013;?></TD>
  <TD NOWRAP COLSPAN=27>Chứng từ gốc: <?php echo $moac_lv0017->lv015;?></TD>
</TR>
<TR VALIGN=TOP>
  <TD COLSPAN=10></TD>
  <TD COLSPAN=7></TD>
  <TD NOWRAP COLSPAN=27>&nbsp;</TD>
</TR>
<TR VALIGN=TOP>
<TD COLSPAN=44><?php echo $strDetail;?></TD>
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
<TD NOWRAP ALIGN="CENTER" COLSPAN=7><B>Người nộp ti?n</B></TD>
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
<TD NOWRAP COLSPAN=41 ROWSPAN=2>Số tiền bằng chữ: <?php echo LNum2Text($vArrMN[4],$plang);?></TD>
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
