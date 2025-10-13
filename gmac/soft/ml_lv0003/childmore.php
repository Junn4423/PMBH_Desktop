<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
require_once("../paras.php");
require_once("../../clsall/ml_menusl0003.php");

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0020.txt",$plang);
//init object
$ml_menusl0003=new ml_menusl0003();
//Set variant
$ml_menusl0003->itemlst=$pitemlst;
$ml_menusl0003->childlst=$pchildlst;
$ml_menusl0003->level3lst=15;
$ml_menusl0003->child3lst=$pchild3lst;

//Hiện liên kết cần hiễn thị
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/responsive.css" type="text/css">
<link rel="stylesheet" href="../../css/menu.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascript/menuvertical.js"></script>
</head>
<script language="javascript" type="text/javascript">
function callchange(o)
{
rundisplayLayer(parseInt(o.value));
}
function Cancel(){ var o=window.parent.document.getElementById('frm_mail');
	o.action="?&func=<?php echo $_GET['funcparent'];?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);?>";
	o.target="_self";
	o.submit();
}
</script>
<?php
if(trim($_SESSION['ERPSOFV2RUserID'])!="")
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
	<div id="top-nav">
	 
		<TABLE class="menubar" cellSpacing="0" cellPadding="0" width="100%" border="0">
		<TBODY>
			<TR>
			  <TD class="lvtitle" width="*%" id="lvtitlelist">&nbsp; </TD>
				<TD class="lvtitle" id="lvtitlelist"></TD>
			</TR>
		  </TBODY>
		</TABLE>
	</div>
	<h2 id="pageName">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13">
				<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="../images/pictures/table_r1_c2.gif">
				<img name="table_r1_c2" src="../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td width="13">
				<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				<img src="../images/pictures/spacer.gif" 
					width="1" height="12" border="0" alt=""></td>
		</tr>
		<tr>
			<td background="../images/pictures/table_r2_c1.gif">
				<img name="table_r2_c1" src="../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			<table width="100%" border="0">
			  <tr>
                <td><TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0">
					<TBODY>
						<TR vAlign="center" align="middle">				
							 <TD><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/controlright/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
						</TR>
				  </TBODY>
					</TABLE></td>
              </tr>
              <tr>
                <td><div >
	<?php
	$ml_menusl0003->Dir="../";
include($ml_menusl0003->GetLinkEmp());
?>
	</div></td>
              </tr>
            </table
			>
			<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
			</td>
			<td background="../images/pictures/table_r2_c3.gif">
				<img name="table_r2_c3" src="../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td><img src="../images/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="../images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="../images/pictures/table_r3_c2.gif">
				<img name="table_r3_c2" src="../images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
				<img name="table_r3_c3" src="../images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td><img src="../images/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
		</tr>
	</table>
	
  </h2>
	<div id="lvright"></div>
</div>
<script language="javascript">
document.frmhr_employee.cbxoption.value="<?php echo $ml_menusl0003->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
