<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/sl_lv0001.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0001.php");
//////////////init object////////////////
$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvsl_lv0001->lv001=$_GET['ID'];
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0002.txt",$plang);
$mosl_lv0001->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvsl_lv0001->lv001_=$_POST['txtlv001_'];
$lvsl_lv0001->lv002=$_POST['txtlv002'];
$lvsl_lv0001->lv003=$_POST['txtlv003'];
$lvsl_lv0001->lv004=$_POST['txtlv004'];
$lvsl_lv0001->lv005=$_POST['txtlv005'];
$lvsl_lv0001->lv006=$_POST['txtlv006'];
$lvsl_lv0001->lv007=$_POST['txtlv007'];
$lvsl_lv0001->lv008=$_POST['txtlv008'];
$lvsl_lv0001->lv009=$_POST['txtlv009'];
$lvsl_lv0001->lv010=$_POST['txtlv010'];
$lvsl_lv0001->lv011=$_POST['txtlv011'];
$lvsl_lv0001->lv012=$_POST['txtlv012'];
$lvsl_lv0001->lv013=$_POST['txtlv013'];
$lvsl_lv0001->lv014=$_POST['txtlv014'];
$lvsl_lv0001->lv015=$_POST['txtlv015'];
$lvsl_lv0001->lv016=$_POST['txtlv016'];
$lvsl_lv0001->lv017=$_POST['txtlv017'];
$lvsl_lv0001->lv018=$_POST['txtlv018'];
$lvsl_lv0001->lv019=$_POST['txtlv019'];
$lvsl_lv0001->lv020=$_POST['txtlv020'];
$lvsl_lv0001->lv021=$_POST['txtlv021'];
$lvsl_lv0001->lv022=$_POST['txtlv022'];
$lvsl_lv0001->lv023=$_POST['txtlv023'];
$lvsl_lv0001->lv099=$_POST['txtlv099'];	
		$vresult=$lvsl_lv0001->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvsl_lv0001->LV_LoadID($lvsl_lv0001->lv001);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/lvhrcss.css" type="text/css">
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
			alert("<?php echo $vLangArr[38];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[36];?>");
			o.txtlv002.focus();
			}
		else if(!isphone(o.txtlv010.value)){
			alert("<?php echo $vLangArr[37];?>");
			o.txtlv010.focus();
			}	
		else if(!isphone(o.txtlv011.value)){
			alert("<?php echo $vLangArr[37];?>");
			o.txtlv011.focus();
			}	
		else if(!isphone(o.txtlv012.value)){
			alert("<?php echo $vLangArr[37];?>");
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
if($lvsl_lv0001->GetEdit()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[14];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
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
								<td width="178"  height="20">
									
									<input name="txtlv001" type="hidden" id="txtlv001"  value="<?php echo $lvsl_lv0001->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" />			
									<input name="txtlv001_" type="text" id="txtlv001_"  value="<?php echo $lvsl_lv0001->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
									</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvsl_lv0001->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvsl_lv0001->lv003;?>" tabindex="7" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[31];?></td>
							  <td  height="20"><input name="txtlv017" type="text" id="txtlv017" value="<?php echo $lvsl_lv0001->FormatView($lvsl_lv0001->lv017,2);?>" tabindex="21" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img tabindex="8" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv017);return false;" /></span>	</td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvsl_lv0001->lv004;?>" tabindex="8" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvsl_lv0001->FormatView($lvsl_lv0001->lv005,2);?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"><span class="td"><img tabindex="8" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv005);return false;" /></span></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvsl_lv0001->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							  <!--
							 <tr>
								<td height="20" valign="top"><?php echo $vLangArr[23];?></td>
								<td height="20">
									<table style="width:80%">
										<tr>
											<td width="50%">
												<select name="txtlv009" id="txtlv009"   tabindex="10"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value="">...</option>
												<?php echo $lvsl_lv0001->LV_LinkField('lv009',$lvsl_lv0001->lv009);?>
												</select>
											</td>
											<td width="50%">
												<ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv009_search" id="txtlv009_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv009','hr_lv0083','lv002')" onFocus="LoadPopup(this,'txtlv009','hr_lv0083','lv002')" tabindex="200" >
													<div id="lv_popup4" lang="lv_popup4"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
									
								</td>
					      </tr>
							<tr>
								<td  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td height="20"><table style="width:80%">
										<tr>
											<td width="50%"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvsl_lv0001->LV_LinkField('lv007',$lvsl_lv0001->lv007);?>
							  </select></td>
											<td width="50%">
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv007','hr_lv0023','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><table style="width:80%">
										<tr>
											<td width="50%"><select name="txtlv008" id="txtlv008"   tabindex="12"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvsl_lv0001->LV_LinkField('lv008',$lvsl_lv0001->lv008);?>
							  </select></td>
											<td width="50%">
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv008_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv008','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv008','hr_lv0014','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							-->
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvsl_lv0001->lv010;?>" tabindex="14" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvsl_lv0001->lv011;?>" tabindex="15" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvsl_lv0001->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
<tr>
								<td   height="20"><?php echo $vLangArr[27];?></td>
								<td   height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvsl_lv0001->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvsl_lv0001->lv014;?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvsl_lv0001->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[30];?></td>
				  <td  height="20"><input  name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvsl_lv0001->lv016;?>" tabindex="20" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>		
								
						<!--
						<tr>
								<td  height="20"><?php echo $vLangArr[32];?></td>
								<td  height="20"><table width="80%"><tr><td width="50%">
									<select name="txtlv018" id="txtlv018"   tabindex="12"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvsl_lv0001->LV_LinkField('lv018',$lvsl_lv0001->lv018);?>
							  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:100%" onKeyUp="LoadPopup(this,'txtlv018','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv018','hr_lv0014','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>			</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[33];?></td>
							  <td  height="20"><textarea name="txtlv019" rows="5" id="txtlv019" style="width:80%" tabindex="23" onKeyPress="return CheckKey(event,7)"><?php echo $lvsl_lv0001->lv019;?></textarea></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[34];?></td>
							  <td  height="20"><input  name="txtlv020" type="text" id="txtlv020" value="<?php echo $lvsl_lv0001->lv020;?>" tabindex="24" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[35];?></td>
				  <td  height="20"><input  name="txtlv021" type="text" id="txtlv021" value="<?php echo $lvsl_lv0001->lv021;?>" tabindex="25" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>	-->
						  
							<tr>
								<td   height="20"><?php echo $vLangArr[41];?></td>
								<td  height="20"><table width="80%"><tr><td width="50%">
									<select name="txtlv022" id="txtlv022"   tabindex="24"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
										<?php echo $lvsl_lv0001->LV_LinkField('lv022',$lvsl_lv0001->lv022);?>
									</select></td>
									<td width="50%">
							  <ul id="pop-nav4" lang="pop-nav4" onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv022_search" id="txtlv022_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv022','sl_lv0034','lv002')" onFocus="LoadPopup(this,'txtlv022','sl_lv0034','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>			</td>
					      </tr>
						  <!--
						  <tr>
								<td  height="20"><?php echo $vLangArr[42];?></td>
								<td   height="20"><table width="80%"><tr><td width="50%">
									<select name="txtlv023" id="txtlv023"   tabindex="26"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvsl_lv0001->LV_LinkField('lv023',$lvsl_lv0001->lv023);?>
							  </select></td><td>
							  <ul id="pop-nav5" lang="pop-nav5" onkeyup="ChangeName(this,5)" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv023_search" id="txtlv023_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv023','sl_lv0035','lv002')" onFocus="LoadPopup(this,'txtlv023','sl_lv0035','lv002')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table>			</td>
					      </tr>
						  <tr>
							  <td  height="20"><?php echo 'Số nợ đầu kỳ';?></td>
							  <td  height="20"><input  name="txtlv099" type="text" id="txtlv099" value="<?php echo $lvsl_lv0001->lv099;?>" tabindex="27" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>-->
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