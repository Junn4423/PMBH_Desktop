<?php
session_start();
//require_once("../../clsall/lv_lv0007.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/lv_lv0007.php");
//////////////init object////////////////
$lvlv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","LV0004.txt",$plang);

$curPage=(int)$_GET['curPg'];	
$vFlag=(int)$_GET['txtFlag'];
$vlv001=$_GET['lv001'];
$vlv002=$_GET['lv002'];
$vlv003=$_GET['lv003'];
$vlv004=$_GET['lv004'];
$vlv005=$_GET['lv005'];
$vlv006=$_GET['lv006'];
$vlv007=$_GET['lv007'];
$vlv008=$_GET['lv008'];
$vlv009=$_GET['lv009'];
$vlv010=$_GET['lv010'];
$vlv011=$_GET['lv011'];
$vlv012=$_GET['lv012'];
$vlv013=$_GET['lv013'];
$vlv014=$_GET['lv014'];
$vlv015=$_GET['lv015'];
$vlv016=$_GET['lv016'];
$vlv017=$_GET['lv017'];
$vlv018=$_GET['lv018'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>LE VINH</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascript/engine.js"></script>

</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmfilter;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmfilter;	
		o.txtlv001.focus();
	}
	function Save()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.txtFlag.value="2";
		o.txtlv001.value=document.frmfilter.txtlv001.value;
		o.txtlv002.value=document.frmfilter.txtlv002.value;		
		o.txtlv003.value=document.frmfilter.txtlv003.value;		
		o.txtlv004.value=document.frmfilter.txtlv004.value;			
		o.txtlv006.value=document.frmfilter.txtlv006.value;
		o.txtlv007.value=document.frmfilter.txtlv007.value;
		o.txtlv008.value=document.frmfilter.txtlv008.value;
		o.txtlv009.value=document.frmfilter.txtlv009.value;
		o.txtlv010.value=document.frmfilter.txtlv010.value;
		o.txtlv011.value=document.frmfilter.txtlv011.value;
		o.txtlv012.value=document.frmfilter.txtlv012.value;
		o.txtlv013.value=document.frmfilter.txtlv013.value;
		o.txtlv014.value=document.frmfilter.txtlv014.value;
		o.txtlv015.value=document.frmfilter.txtlv015.value;
		o.txtlv016.value=document.frmfilter.txtlv016.value;
		o.txtlv018.value=document.frmfilter.txtlv018.value;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}

-->
</script>
<?php
if(1==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[1];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
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
					<form action="#" name="frmfilter" id="frmfilter" method="post">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="112"  height="20"><?php echo $vLangArr[10];?></td>
							  <td width="535"  height="20"><input  name="txtlv001" type="text" id="txtlv001" value="<?php echo $vlv001;?>" /></td>
						    </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[11];?></td>
							  <td  height="20px"><select name="txtlv002" id="txtlv002"  tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<option value="" >...</option><?php echo $lvlv_lv0007->LV_LinkField('lv002',$vlv002);?></select></td>
						  </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[12];?></td>
							  <td  height="20px"><select  name="txtlv003" id="txtlv003"  tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"></select></td>
							  </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[13];?></td>
							  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $vlv004;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  
							
							<tr>
							  <td  height="20px"><?php echo $vLangArr[15];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $vlv006;?>" tabindex="10" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>		
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $vlv007;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>(yyyy-mm-dd)</td>
							</tr>							
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><select name="txtlv008" id="txtlv008"  tabindex="12" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<option value="" >...</option>
							  	<option value="0" <?php echo ($vlv008=='0')?"selected='selected'":""?>>Nữ</option>
							  	<option value="1" <?php echo ($vlv008=='1')?"selected='selected'":""?>>Nam</option>
							  </select>
							  </td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $vlv009;?>" tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv010" type="text" id="txtlv010" value="<?php echo $vlv010;?>" tabindex="14" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $vlv011;?>" tabindex="15" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
								 <tr>
								<td width="166"  height="20"><?php echo $vLangArr[21];?></td>
								<td  height="20"><select name="txtlv012" id="txtlv012"  tabindex="16"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<option value="" >...</option><?php echo $lvlv_lv0007->LV_LinkField('lv012',$vlv012);?></select></td>
                          </tr>
						  <tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
							  <td  height="20px"><input name="txtlv013" type="text" id="txtlv013" value="<?php echo $vlv013;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
							  <td  height="20px"><input name="txtlv014" type="text" id="txtlv014" value="<?php echo $vlv014;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
							  <td  height="20px"><input name="txtlv015" type="text" id="txtlv015" value="<?php echo $vlv015;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[25];?></td>
							  <td  height="20px"><input name="txtlv016" type="text" id="txtlv016" value="<?php echo $vlv016;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[29];?></td>
							  <td  height="20px"><input name="txtlv018" type="text" id="txtlv018" value="<?php echo $vlv018;?>" tabindex="18" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/>(yyyy-mm-dd)</td>
							</tr>	
							<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag" /></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="2"> <TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../../images/lvicon/Filter.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /><?php echo 'Lọc';?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove><?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<script language="javascript"> var o=document.frmfilter; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
		o.txtlv001.focus();
</script>
<script language="javascript" src="../../javascript/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>