<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/sl_lv0214.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0214.php");
//////////////init object////////////////
$lvsl_lv0214=new sl_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0214');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvsl_lv0214->lv001=$_GET['ChildDetailID'];
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0030.txt",$plang);
$mosl_lv0214->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvsl_lv0214->lv002=$_POST['txtlv002'];
$lvsl_lv0214->lv003=$_POST['txtlv003'];
$lvsl_lv0214->lv004=$_POST['txtlv004'];
$lvsl_lv0214->lv005=$_POST['txtlv005'];
$lvsl_lv0214->lv006=$_POST['txtlv006'];
$lvsl_lv0214->lv007=$_POST['txtlv007'];
$lvsl_lv0214->lv008=$_POST['txtlv008'];
$lvsl_lv0214->lv009=$_POST['txtlv009'];
$lvsl_lv0214->lv010=$_POST['txtlv010'];
$lvsl_lv0214->lv011=$_POST['txtlv011'];
$lvsl_lv0214->lv012=$_POST['txtlv012'];
$lvsl_lv0214->lv013=$_POST['txtlv013'];
$lvsl_lv0214->lv014=$_POST['txtlv014'];
$lvsl_lv0214->lv015=$_POST['txtlv015'];		
		$vresult=$lvsl_lv0214->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvsl_lv0214->LV_LoadID($lvsl_lv0214->lv001);


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
if($lvsl_lv0214->GetEdit()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
    <h3>
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" name="frmedit" id="frmedit" method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvsl_lv0214->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>		</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvsl_lv0214->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20">
							  <table width="80%">
								<tr><td width="50%">
										<select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/><?php echo $lvsl_lv0214->LV_LinkField('lv003',$lvsl_lv0214->lv003);?>
										</select></td>
									<td>
										<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
											<input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','*@*@*.sl_lv0007','concat(lv001,@!-@!,lv002)')" onFocus="LoadPopup(this,'txtlv003','*@*@*.sl_lv0007','concat(lv001,@!-@!,lv002)')" tabindex="200" >
											<div id="lv_popup" lang="lv_popup1"> </div>						  
											</li>
										</ul></td></tr></table>		
									</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				              <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvsl_lv0214->lv004;?>"/></td>
							</tr>							  
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><table width="80%">
								<tr><td width="50%"><select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvsl_lv0214->LV_LinkField('lv005',$lvsl_lv0214->lv005);?>
							  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv005_search" id="txtlv005_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (float)$lvsl_lv0214->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
							<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td width="178"  height="20"><table width="80%">
								<tr><td width="50%"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvsl_lv0214->LV_LinkField('lv007',$lvsl_lv0214->lv007);?>
							  </select></td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv007','hr_lv0018','lv002')" onFocus="LoadPopup(this,'txtlv007','hr_lv0018','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><input name="txtlv008" id="txtlv008"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvsl_lv0214->lv008;?>"/>							  </td>
						    </tr>
							<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[23];?></td>
								<td width="178"  height="20"><table width="80%">
								<tr><td width="50%"><select name="txtlv009" id="txtlv009"   tabindex="13"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvsl_lv0214->LV_LinkField('lv099',$lvsl_lv0214->lv009);?>
							  </select></td><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv009_search" id="txtlv009_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv009','*@*@*.sl_lv0001','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopup(this,'txtlv009','*@*@*.sl_lv0001','concat(lv002,@!-@!,lv001)')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvsl_lv0214->lv010;?>" tabindex="14" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>							 			  							  <tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
				  <td  height="20"><input  name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvsl_lv0214->lv011;?>" tabindex="15" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	 	
						   <tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
				  <td  height="20"><input  name="txtlv012" type="text" id="txtlv012" value="<?php echo $lvsl_lv0214->lv012;?>" tabindex="16" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>		
                            <tr>
							  <td  height="20"><?php echo $vLangArr[27];?></td>
				  <td  height="20"><input name="txtlv013" id="txtlv013"   tabindex="17"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvsl_lv0214->FormatView($lvsl_lv0214->lv013,4);?>"/><span class="td"><img tabindex="18" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv013);return false;" /></span></td>
						  </tr>	
                            <tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
				  <td  height="20"><input name="txtlv014" id="txtlv014"   tabindex="18"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvsl_lv0214->FormatView($lvsl_lv0214->lv014,4);?>"/><span class="td"><img tabindex="18" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv014);return false;" /></span></td>
						  </tr>																		
							<tr>
							 <td  height="20"><?php echo $vLangArr[29];?></td>
							<td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvsl_lv0214->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
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