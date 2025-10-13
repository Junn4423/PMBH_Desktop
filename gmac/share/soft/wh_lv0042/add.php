<?php
session_start();
//require_once("../../clsall/wh_lv0042.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0042.php");
//////////////init object////////////////
$lvwh_lv0042=new wh_lv0042($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0009');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0055.txt",$plang);
$mowh_lv0042->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvwh_lv0042->lv001=$_POST['txtlv001'];
$lvwh_lv0042->lv002=$_GET['ChildID'];
$lvwh_lv0042->lv003=$_POST['txtlv003'];
$lvwh_lv0042->lv004=$_POST['txtlv004'];
$lvwh_lv0042->lv005=$_POST['txtlv005'];
$lvwh_lv0042->lv006=$_POST['txtlv006'];
$lvwh_lv0042->lv007=$_POST['txtlv007'];
$lvwh_lv0042->lv008=$_POST['txtlv008'];
$lvwh_lv0042->lv009=$_POST['txtlv009'];
$lvwh_lv0042->lv010=$_POST['txtlv010'];
$lvwh_lv0042->lv011=$_POST['txtlv011'];
$lvwh_lv0042->lv012=$_POST['txtlv012'];
$lvwh_lv0042->lv013=$_POST['txtlv013'];
$lvwh_lv0042->lv014=$_POST['txtlv014'];
$lvwh_lv0042->lv015=$_POST['txtlv015'];
$lvwh_lv0042->lv017=$_POST['txtlv017'];
$lvwh_lv0042->lv018=$_POST['txtlv018'];
$lvwh_lv0042->lv016=GetServerDate()." ".GetServerTime();

if($vFlag==1)
{
		
		$vresult=$lvwh_lv0042->LV_Insert();
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
		var o=document.frmadd;
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv009.value="";
		o.txtlv010.value="";
		o.txtlv011.value="";
		o.txtlv012.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
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
		var o=document.frmadd;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[33];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value=="")
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
if($lvwh_lv0042->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
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
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvwh_lv0042->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/><?php echo $lvwh_lv0042->LV_LinkField('lv003',$lvwh_lv0042->lv003);?>
							  </select>	<br>
							  <table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv003','sl_lv0007','lv002')" onFocus="LoadPopup(this,'txtlv003','sl_lv0007','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				              <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvwh_lv0042->lv004;?>"/></td>
</tr>							  
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0042->LV_LinkField('lv005',$lvwh_lv0042->lv005);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (float)$lvwh_lv0042->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td  height="20"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0042->LV_LinkField('lv007',$lvwh_lv0042->lv007);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopup(this,'txtlv007','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv007','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
				  <td  height="20"><input  name="txtlv008" type="text" id="txtlv008" value="<?php echo (float)$lvwh_lv0042->lv008;?>" tabindex="12" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                          <tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
				  <td  height="20"><input  name="txtlv009" type="text" id="txtlv009" value="<?php echo (float)$lvwh_lv0042->lv009;?>" tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>							 			  							 
                          <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[24];?></td>
							  <td  height="20"><select name="txtlv010" id="txtlv010"   tabindex="14"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0042->LV_LinkField('lv010',$lvwh_lv0042->lv010);?>
							  </select><br>
							  <table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch4" id="txtlvsearch4" style="width:200px" onKeyUp="LoadPopup(this,'txtlv011','sl_lv0029','lv002')" onFocus="LoadPopup(this,'txtlv011','ac_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table></td></tr>
							 <tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
				  <td  height="20"><input  name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvwh_lv0042->lv011;?>" tabindex="15" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                          <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><select name="txtlv012" id="txtlv012"   tabindex="16"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
							  <?php echo $lvwh_lv0042->LV_LinkField('lv012',$lvwh_lv0042->lv012);?>
							  </select><br>
							  <table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch4" id="txtlvsearch4" style="width:200px" onKeyUp="LoadPopup(this,'txtlv011','sl_lv0029','lv002')" onFocus="LoadPopup(this,'txtlv011','ac_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table></td></tr>	
						   <tr>
							  <td  height="20"><?php echo $vLangArr[27];?></td>
				  <td  height="20"><input  name="txtlv013" type="text" id="txtlv013" value="<?php echo $lvwh_lv0042->lv013;?>" tabindex="17" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>		
                           <tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
				  <td  height="20"><input  name="txtlv014" type="text" id="txtlv014" value="<?php echo $lvwh_lv0042->lv014;?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                           <tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
				  <td  height="20"><input  name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvwh_lv0042->lv015;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						  </tr>	
                          <tr>
							  <td  height="20"><?php echo $vLangArr[32];?></td>
				  <td  height="20"><input  name="txtlv018" type="text" id="txtlv018" value="<?php echo $lvwh_lv0042->lv018;?>" tabindex="20" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
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
	include("../permit.php");
}
?>
</body>
</html>