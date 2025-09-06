<?php
session_start();
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../librarianconfig.php");	
require_once("../paras.php");
require_once("../../clsall/lv_menusl0001.php");

$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0003.txt",$plang);
//init object
$molv_menusl0001=new lv_menusl0001();
//Set variant
$molv_menusl0001->itemlst=$pitemlst;
$molv_menusl0001->childlst=$pchildlst;
$molv_menusl0001->level3lst=$plevel3lst;
$molv_menusl0001->child3lst=$pchild3lst;

//Hiện liên kết cần hiễn thị
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/lvhrcss.css" type="text/css">
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
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
			break;
		case 2:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
			break;
		case 3:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";	
			break;
		case 4:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";	
			break;
		case 5:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,5,0)?>";	
			break;
		case 6:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,6,0)?>";	
			break;
		case 7:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0)?>";	
			break;
		case 8:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,8,0)?>";	
			break;
		case 9:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,9,0)?>";	
			break;
		case 10:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,10,0)?>";	
			break;
		case 11:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,11,0)?>";	
			break;
		case 12:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,12,0)?>";	
			break;
		case 13:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,13,0)?>";	
			o.txtFlagDocument.value="1";
			break;
		case 14:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,14,0)?>";	
			o.txtFlagDocument.value="1";
			break;			
		case 15:
			o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,15,0)?>";	
			o.txtFlagDocument.value="1";
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
			  <TD class="lvtitle" id="lvtitlelist"></TD>
			</TR>
		  </TBODY>
		</TABLE>
	</div>
	<h2 id="pageName"></h2><table width="100%" border="0">
              <tr>
                <td><TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0" width="100%">
					<TBODY>
						<TR vAlign="center" align="middle">				
							<td><form name="frmhr_employee" action="#" method="post">
	 			 	<select name="cbxoption" tabindex="1" onChange="callchange(this)">
						<option value="1" <?php echo ($molv_menusl0001->level3lst==1)?'selected="selected"':'';?> >1.<?php echo $vLangArr[8];?></option>
						<option value="2" <?php echo ((int)$molv_menusl0001->level3lst==2)?'selected="selected"':'';?>>2.<?php echo $vLangArr[9];?></option>
						<option value="4" <?php echo ((int)$molv_menusl0001->level3lst==4)?'selected="selected"':'';?>>4.<?php echo $vLangArr[11];?></option>
						<option value="14" <?php echo ((int)$molv_menusl0001->level3lst==14)?'selected="selected"':'';?>>14.<?php echo 'Voucher';?></option>
						<option value="5" <?php echo ((int)$molv_menusl0001->level3lst==5)?'selected="selected"':'';?>>5.<?php echo $vLangArr[12];?></option>
						
					</select>
	    <input type="hidden" name="txtEmployeeID" id="txtEmployeeID" value="<?php echo $_SESSION['ERPSOFV2RUserID'];?>" />
		<input type="hidden" name="txtFlagDocument" id="txtFlagDocument" />
	  </form><br/>
									Chọn thao tác
							
							  </td>		
							<TD  class="toolbar_<?php echo ($lv_menusl0013->level3lst==14)?'selected':'';?>"><a class="toolbar" href="javascript:rundisplayLayer(14);">
								<img src="../images/icon/income.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo 'Voucher';?></a></TD>	
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a class="toolbar" href="javascript:rundisplayLayer(1);">
								<img src="../images/controlright/contract.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[8];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							
							
							<TD><a class="toolbar" href="javascript:rundisplayLayer(2);">
								<img src="../images/controlright/quotation.png" title="<?php echo $vLangArr[100];?>" 
									 alt="add" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[9];?></a></TD>
							<TD>&nbsp;</TD>							
							<TD>&nbsp;</TD>
							<TD><a class="toolbar" href="javascript:rundisplayLayer(4);">
								<img src="../images/controlright/performance.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="perform" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[11];?></a></TD>
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							<TD><a class="toolbar" href="javascript:rundisplayLayer(5);">
								<img src="../images/controlright/document.gif" title="<?php echo $vLangArr[100];?>" 
									 alt="document" border="0" align="middle" width="32" height="32">
								<br><?php echo $vLangArr[12];?></a></TD>
														<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>													
							 <TD><a class="toolbar" href="javascript:Cancel();">
							 	<img src="../images/controlright/move_f2.png" alt="Back" name="Back" border="0" 
									align="middle" id="cancel" /> <br /><?php echo $vLangArr[2];?></a></TD>
						</TR>
				  </TBODY>
					</TABLE></td>
              </tr>
              <tr>
                <td> </td>
              </tr>
              <tr>
                <td>
				<div id="showparenttext"></div>
				<div id="showparent">
				<div >
	<?php
	$molv_menusl0001->Dir="../";
include($molv_menusl0001->GetLinkEmp());
?>
	</div></div></td>
              </tr>
            </table>
	<div id="lvright"></div>
</div>
<script language="javascript">
document.frmhr_employee.cbxoption.value="<?php echo $molv_menusl0001->level3lst;?>";
document.frmhr_employee.cbxoption.focus();
</script>
</body>
</html>
<?php
} else {
	include("../permit.php");
}
?>
