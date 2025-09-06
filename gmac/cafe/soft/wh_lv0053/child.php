<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
require_once("../paras.php");
require_once("../../clsall/wh_menusl0053.php");

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0014.txt",$plang);
//init object
$wh_menusl0053=new wh_menusl0053();
//Set variant
$wh_menusl0053->itemlst=$pitemlst;
$wh_menusl0053->childlst=$pchildlst;
$wh_menusl0053->level3lst=$plevel3lst;
$wh_menusl0053->child3lst=$pchild3lst;

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
function rundisplayLayer(vOpt)
{
var o=document.frmhr_employee;
o.cbxoption.value=vOpt;
o.target="_self";
	switch(vOpt) {
		case 1:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
			break;
		case 2:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
			break;
		case 3:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";	
			break;
		case 4:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";	
			break;
		case 5:
			o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";	
			break;		
	}
	o.submit();
}

function Cancel(){ var o=window.parent.document.getElementById('frmchoose');
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
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
			  <TD class="lvtitle" id="lvtitlelist">&nbsp; </TD>
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
							<TD><a class="toolbar" href="javascript:rundisplayLayer(1);">
								<img src="../images/controlright/detail_icon.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[8];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<!--<TD><a class="toolbar" href="javascript:rundisplayLayer(2);">
								<img src="../images/controlright/dependants.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[9];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							
							<TD><a class="toolbar" href="javascript:rundisplayLayer(3);">
								<img src="../images/controlright/immigration.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[10];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>						-->
							 <TD><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/controlright/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
						</TR>
				  </TBODY>
					</TABLE></td>
              </tr>
              <tr>
                <td> <form name="frmhr_employee" action="#" method="post">
	 			 	<select name="cbxoption" tabindex="1" onChange="callchange(this)">
						<option value="1" <?php echo ($wh_menusl0053->level3lst==1)?'selected="selected"':'';?> >1.<?php echo $vLangArr[8];?></option>
						<!--<option value="2" <?php echo ((int)$wh_menusl0053->level3lst==2)?'selected="selected"':'';?>>2.<?php echo $vLangArr[9];?></option>
						<option value="3" <?php echo ((int)$wh_menusl0053->level3lst==3)?'selected="selected"':'';?>>3.<?php echo $vLangArr[10];?></option>-->
						
					</select>
	    <input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $_SESSION['ERPSOFV2RUserID'];?>" />
		<input type="hidden" name="txtFlagDocument" id="txtFlagDocument" />
	  </form></td>
              </tr>
              <tr>
                <td><div >
	<?php
	$wh_menusl0053->Dir="../";
include($wh_menusl0053->GetLinkEmp());
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
document.frmhr_employee.cbxoption.value="<?php echo $wh_menusl0053->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
