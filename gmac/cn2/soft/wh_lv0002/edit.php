<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/wh_lv0002.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0002.php");
//////////////init object////////////////
$lvwh_lv0002=new wh_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvwh_lv0002->lv001=$_GET['ID'];
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0002.txt",$plang);
$mowh_lv0002->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvwh_lv0002->lv002=$_POST['txtlv002'];
$lvwh_lv0002->lv003=$_POST['txtlv003'];
$lvwh_lv0002->lv004=$_POST['txtlv004'];
$lvwh_lv0002->lv005=$_POST['txtlv005'];
$lvwh_lv0002->lv006=$_POST['txtlv006'];
if($_FILES['userfile']['name']=="")
$lvwh_lv0002->lv007=$_POST['txtlv007'];
else
$lvwh_lv0002->lv007=$_FILES['userfile']['name'];
$lvwh_lv0002->lv008=$_POST['txtlv008'];
$lvwh_lv0002->lv009=$_POST['txtlv009'];
$lvwh_lv0002->lv010=$_POST['txtlv010'];
$lvwh_lv0002->lv011=$_POST['txtlv011'];
$lvwh_lv0002->lv012=$_POST['txtlv012'];
$lvwh_lv0002->lv013=$_POST['txtlv013'];
$lvwh_lv0002->lv014=$_POST['txtlv014'];
$lvwh_lv0002->lv015=$_POST['txtlv015'];
$lvwh_lv0002->lv016=$_POST['txtlv016'];
		
		$vresult=$lvwh_lv0002->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvwh_lv0002->LV_LoadID($lvwh_lv0002->lv001);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/responsive.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascript/engine.js"></script></head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmedit;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmedit;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[33];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv002.focus();
			}
		else if(!isphone(o.txtlv010.value)){
			alert("<?php echo $vLangArr[32];?>");
			o.txtlv010.focus();
			}	
		else if(!isphone(o.txtlv011.value)){
			alert("<?php echo $vLangArr[32];?>");
			o.txtlv011.focus();
			}	
		else if(!isphone(o.txtlv012.value)){
			alert("<?php echo $vLangArr[35];?>");
			o.txtlv012.focus();
			}	
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}

-->
</script>
<?php
if($lvwh_lv0002->GetEdit()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
			<tr>
				<td width="13">
					<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="*" background="../images/pictures/table_r1_c2.gif">
					</td>
				<td width="13">
					<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="11">
					</td>
			</tr>
			<tr>
				<td background="../images/pictures/table_r2_c1.gif">
					</td>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="760" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvwh_lv0002->lv001=="")?InsertWithCheckExt('huyvanv2_0.wh_lv0002', 'lv001', '',10):$lvwh_lv0002->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvwh_lv0002->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvwh_lv0002->lv003;?>" tabindex="7" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvwh_lv0002->lv004;?>" tabindex="8" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvwh_lv0002->lv005;?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvwh_lv0002->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td  height="20"><table width="80%" border="0"><tr><td width="50%"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvwh_lv0002->LV_LinkField('lv007',$lvwh_lv0002->lv007);?>
							  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv007','hr_lv0023','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><table width="80%" border="0"><tr><td width="50%"><select name="txtlv008" id="txtlv008"   tabindex="12"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvwh_lv0002->LV_LinkField('lv008',$lvwh_lv0002->lv008);?>
							  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv008_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv008','hr_lv0014','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><input type="text" name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvwh_lv0002->lv009;?>"></td>
						    </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvwh_lv0002->lv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvwh_lv0002->lv011;?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvwh_lv0002->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvwh_lv0002->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvwh_lv0002->lv014;?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvwh_lv0002->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvwh_lv0002->lv016;?>" tabindex="20" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
				  		</tr>	
						<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

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
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmedit;
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
	include("../wh_lv0002/permit.php");
}
?>
</body>
</html>