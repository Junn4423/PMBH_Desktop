<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/wh_lv0039.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0039.php");
//////////////init object////////////////
$lvwh_lv0039=new wh_lv0039($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0028');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvwh_lv0039->lv001=$_GET['ChildDetailID'];
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0018.txt",$plang);
$mowh_lv0039->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvwh_lv0039->lv002=$_POST['txtlv002'];
$lvwh_lv0039->lv003=$_POST['txtlv003'];
$lvwh_lv0039->lv004=$_POST['txtlv004'];
$lvwh_lv0039->lv005=$_POST['txtlv005'];
$lvwh_lv0039->lv006=$_POST['txtlv006'];
$lvwh_lv0039->lv007=$_POST['txtlv007'];
$lvwh_lv0039->lv008=$_POST['txtlv008'];
$lvwh_lv0039->lv009=$_POST['txtlv009'];
$lvwh_lv0039->lv010=$_POST['txtlv010'];
$lvwh_lv0039->lv011=$_POST['txtlv011'];
$lvwh_lv0039->lv012=$_POST['txtlv012'];
$lvwh_lv0039->lv013=$_POST['txtlv013'];
$lvwh_lv0039->lv014=$_POST['txtlv014'];
$lvwh_lv0039->lv015=$_POST['txtlv015'];
$lvwh_lv0039->lv016=GetServerDate()." ".GetServerTime();
$lvwh_lv0039->lv017=$_POST['txtlv017'];
$lvwh_lv0039->lv018=$_POST['txtlv018'];
$lvwh_lv0039->lv019=$_POST['txtlv019'];
$lvwh_lv0039->lv020=$_POST['txtlv020'];
		
		$vresult=$lvwh_lv0039->LV_UpdateEdit($_POST['txtlv004old'],$_POST['txtlv006old']);
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvwh_lv0039->LV_LoadID($lvwh_lv0039->lv001);

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
		o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&lang=<?php echo $_GET['lang'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv003.select();
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

if($lvwh_lv0039->GetEdit()>0)
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
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvwh_lv0039->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvwh_lv0039->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvwh_lv0039->LV_LinkField('lv003',$lvwh_lv0039->lv003);?>
							  </select>	<br>
							  <table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv003','*@*@*.sl_lv0007','lv002')" onFocus="LoadPopup(this,'txtlv003','*@*@*.sl_lv0007','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
	              <td  height="20"><input type="hidden" name="txtlv004old" id="txtlv004old" value="<?php echo $lvwh_lv0039->lv004;?>" />
			                  <input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvwh_lv0039->lv004;?>"/></td>
</tr>							  
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv005',$lvwh_lv0039->lv005);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input type="hidden" name="txtlv006old" id="txtlv006old" value="<?php echo $lvwh_lv0039->lv006;?>" /><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (float)$lvwh_lv0039->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td  height="20"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv007',$lvwh_lv0039->lv007);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopup(this,'txtlv007','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv007','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20">	<input type="text" name="txtlv008" id="txtlv008"  style="width:80%"  tabindex="12"  value="<?php echo (float)$lvwh_lv0039->lv008;?>" onKeyPress="return CheckKey(event,7)">					  </td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><select name="txtlv009" id="txtlv009"   tabindex="13"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv009',$lvwh_lv0039->lv009);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch9" id="txtlvsearch9" tabindex="200" style="width:200px" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvwh_lv0039->lv009;?>" onKeyUp="LoadSelf(this,'txtlv009','hr_lv0018','lv002')" onFocus="LoadSelf(this,'txtlv009','hr_lv0018','lv002')">
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						    </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo (float)$lvwh_lv0039->lv010;?>" tabindex="14" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>							 			  							 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><select name="txtlv011" id="txtlv011"   tabindex="15"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv011',$lvwh_lv0039->lv011);?>
							  </select><br>
							  <table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch4" id="txtlvsearch4" style="width:200px" onKeyUp="LoadPopup(this,'txtlv011','ac_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv011','ac_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table></td></tr>
					<!--
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><select name="txtlv012" id="txtlv012"   tabindex="16"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv012',$lvwh_lv0039->lv012);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch5" id="txtlvsearch5" style="width:200px" onKeyUp="LoadPopup(this,'txtlv012','ac1_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv012','ac1_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20"><select name="txtlv013" id="txtlv013"   tabindex="17"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv013',$lvwh_lv0039->lv013);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch6" id="txtlvsearch6" style="width:200px" onKeyUp="LoadPopup(this,'txtlv013','ac1_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv013','ac1_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>	-->
							 <tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
				  <td  height="20"><input  name="txtlv014" type="text" id="txtlv014" value="<?php echo $lvwh_lv0039->lv014;?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
						   <tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
				  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvwh_lv0039->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                           <tr>
							  <td  height="20"><?php echo $vLangArr[38];?></td>
				  <td  height="20"><select name="txtlv017" id="txtlv017"   tabindex="20"  style="width:80%" onKeyPress="return CheckKey(event,1)"/>
							  <?php echo $lvwh_lv0039->LV_LinkField('lv017',$lvwh_lv0039->lv017);?>
							  </select>
						  </tr>	
                           <tr>
							  <td  height="20"><?php echo $vLangArr[39];?></td>
				  <td  height="20"><input  name="txtlv018" type="text" id="txtlv018" value="<?php echo $lvwh_lv0039->lv018;?>" tabindex="21" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                           <tr>
							  <td  height="20"><?php echo $vLangArr[40];?></td>
				  <td  height="20"><input  name="txtlv019" type="text" id="txtlv019" value="<?php echo $lvwh_lv0039->lv019;?>" tabindex="22" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                           <tr>
							  <td  height="20"><?php echo $vLangArr[41];?></td>
				  <td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvwh_lv0039->lv020;?>" tabindex="23" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
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
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
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