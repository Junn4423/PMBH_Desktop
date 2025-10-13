<?php
session_start();
//require_once("../../clsall/sl_lv0003.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0003.php");
//////////////init object////////////////
$lvsl_lv0003=new sl_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0007.txt",$plang);

$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvsl_lv0003->lv001=InsertWithCheckExt('sl_lv0003', 'lv001', '',0);
$lvsl_lv0003->lv002=$_GET['ID'];
$lvsl_lv0003->lv003=$_POST['txtlv003'];
$lvsl_lv0003->lv004=$_POST['txtlv004'];
$lvsl_lv0003->lv005=$_POST['txtlv005'];
$lvsl_lv0003->lv006=$_POST['txtlv006'];
 $lvsl_lv0003->lv007=GetServerDate();
$lvsl_lv0003->lv008=$_POST['txtlv008'];
$lvsl_lv0003->lv009=$_POST['txtlv009'];
$lvsl_lv0003->lv010=$lvsl_lv0003->Get_User($_SESSION['ERPSOFV2RUserID'],'lv006');
$lvsl_lv0003->lv011=$_POST['txtlv011'];
if($lvsl_lv0003->lv011=="") $lvsl_lv0003->lv011="00:00:00";
$lvsl_lv0003->lv012=$_POST['txtlv012'];
if($lvsl_lv0003->lv012=="") $lvsl_lv0003->lv012="00:00:00";
$lvsl_lv0003->lv014=$_POST['txtlv014'];
$lvsl_lv0003->lv013=0;
if($vFlag==1)
{
		
		$vresult=$lvsl_lv0003->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
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
<script language="javascript" src="../../javascript/engine.js"></script>
</head>
<script language="javascript">
<!--
function isnumber(s){
	if(s!=""){
		var str="0123456789"
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
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[23];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[24];?>");
			o.txtlv003.focus();
			}
		else if(o.txtlv005.value==""){
			alert("<?php echo $vLangArr[26];?>");
			o.txtlv005.focus();
			}	
		else if(o.txtlv006.value==""){
			alert("<?php echo $vLangArr[25];?>");
			o.txtlv006.focus();
			}
		else if(o.txtlv008.value==""){
			alert("<?php echo $vLangArr[27];?>");
			o.txtlv008.focus();
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
if($lvsl_lv0003->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post">
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
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvsl_lv0003->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px">
							  <table width="80%"><tr><td><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvsl_lv0003->lv002;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							  <td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadPopup(this,'txtlv002','sl_lv0001','lv002')" onFocus="LoadPopup(this,'txtlv002','sl_lv0001','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
							</tr>
							<tr>
								<td  height="20" valign="top"><?php echo $vLangArr[28];?></td>
								<td  height="20"><table style="width:80%">
										<tr>
											<td width="50%"><select name="txtlv009" id="txtlv009"   tabindex="6"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
											<?php echo $lvsl_lv0003->LV_LinkField('lv009',$lvsl_lv0003->lv009);?>
											</select></td><td>
											<ul id="pop-nav9" lang="pop-nav9" onMouseOver="ChangeName(this,9)" onkeyup="ChangeName(this,9)"> <li class="menupopT">
												<input type="text" autocomplete="off" class="search_img_btn" name="txtlv009_search" id="txtlv008_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv009','sl_lv0068','lv002')" onFocus="LoadPopup(this,'txtlv009','sl_lv0068','lv002')" tabindex="200" >
												<div id="lv_popup9" lang="lv_popup9"> </div>						  
												</li>
											</ul></td></tr>
											</table>
								</td>
						    </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				  <td  height="20px"><input type="text" value="<?php echo $lvsl_lv0003->lv003;?>"  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
				  
							 </td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvsl_lv0003->lv004;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"> <input name="txtlv005" type="text" tabindex="9" value="<?php echo $lvsl_lv0003->lv005;?>" style="width:80%" />
						 </td>
							</tr>	
													
													  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px">
							  <table><tr><td>
							  <input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvsl_lv0003->FormatView(($lvsl_lv0003->lv006==""?GetServerDate():$lvsl_lv0003->lv006),2);?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv006);return false;" /></span></td>
							  </td>
							  <td>
							  <?php echo $vLangArr[30];?></td>
							  <td  height="20px"> <input name="txtlv011" type="text" tabindex="9" value="<?php echo $lvsl_lv0003->lv011;?>" style="width:80%"  onKeyPress="return CheckKey(event,7)" />
							 </td>
							 <td>
							  <?php echo $vLangArr[31];?></td>
							  <td  height="20px"> <input name="txtlv012" type="text" tabindex="9" value="<?php echo $lvsl_lv0003->lv012;?>" style="width:80%"  onKeyPress="return CheckKey(event,7)" />
							 </td>
							 </tr></table> 
						 </td>
							</tr>	
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvsl_lv0003->FormatView($lvsl_lv0003->lv007,2);?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv007);return false;" /></span></td>
							  </tr>
								<tr>
							  <td  height="20px" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20px"><textarea name="txtlv008" cols="50" rows="9" id="txtlv008" style="width:80%" tabindex="11" ><?php echo $lvsl_lv0003->lv008;?></textarea></td>
							  </tr>																			
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
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
<script language="javascript">
	var o=document.frmadd;
		o.txtlv003.focus();
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
	include("../sl_lv0003/permit.php");
}
?>
</body>
</html>