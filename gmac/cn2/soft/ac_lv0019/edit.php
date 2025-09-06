<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/ac_lv0019.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ac_lv0019.php");
//////////////init object////////////////
$lvac_lv0019=new ac_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0019');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvac_lv0019->lv001=$_GET['ID'];
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","AC0017.txt",$plang);
$moac_lv0019->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvac_lv0019->lv001_=$_POST['txtlv001_'];
$lvac_lv0019->lv002='1';
$lvac_lv0019->lv003=$_POST['txtlv003'];
$lvac_lv0019->lv004=$_POST['txtlv004'];
$lvac_lv0019->lv005=$_POST['txtlv005'];
$lvac_lv0019->lv006=$_POST['txtlv006'];
$lvac_lv0019->lv007=$_POST['txtlv007'];
$lvac_lv0019->lv008=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvac_lv0019->lv009=$_POST['txtlv009'];
$lvac_lv0019->lv010=$_POST['txtlv010'];
$lvac_lv0019->lv011=$_POST['txtlv011'];
$lvac_lv0019->lv012=$_POST['txtlv012'];
$lvac_lv0019->lv013=$_POST['txtlv013'];
$lvac_lv0019->lv014=$_POST['txtlv014'];
$lvac_lv0019->lv015=$_POST['txtlv015'];
$lvac_lv0019->lv016=$_POST['txtlv016'];
$lvac_lv0019->lv018=$_POST['txtlv018'];
$lvac_lv0019->lv022=$_POST['txtlv022'];		
		$vresult=$lvac_lv0019->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].mysql_error();		
			$vFlag = 0;
		}
}
$lvac_lv0019->LV_LoadID($lvac_lv0019->lv001);


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
	function LoadType(to)
	{
		var o=document.frmedit;
		var vo=o.txtlv003.value;
		switch(vo)
		{
			case 'EMP':
				LoadPopup(to,'txtlv004','*@*@*.hr_lv0020','concat(lv004,lv003,lv002)');
				break;
			case 'CUS':
				LoadPopup(to,'txtlv004','*@*@*.sl_lv0001','lv002');
				break;
			case 'SUP':
				LoadPopup(to,'txtlv004','wh_lv0003','lv002');
				break;
		}
	}
	function Save()
	{
		var o=document.frmedit;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[30];?>");
			o.txtlv001.select();
		}
		else if(o.txtlv005.value==""){
			alert("<?php echo $vLangArr[35];?>");
			o.txtlv005.focus();
			}	
		else if(o.txtlv006.value==""){
			alert("<?php echo $vLangArr[34];?>");
			o.txtlv006.focus();
			}	
		else if(parseFloat(o.txtlv012.value)<=0 || o.txtlv012.value==""){
			alert("<?php echo $vLangArr[33];?>");
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
if($lvac_lv0019->GetEdit()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
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
									<input name="txtlv001" type="hidden" id="txtlv001"  value="<?php echo $lvac_lv0019->lv001;?>" tabindex="5" maxlength="32" style="width:40%" onKeyPress="return CheckKey(event,7)" readonly="true"/>		
<input  readonly="true" name="txtlv001_" type="text" id="txtlv001_"  value="<?php echo $lvac_lv0019->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
									</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"><?php echo $lvac_lv0019->LV_LinkField('lv003',$lvac_lv0019->lv003);?></select>
								</td><td>
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','ac_lv0030','lv002')" onFocus="LoadPopup(this,'txtlv003','ac_lv0030','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><table width="80%"><tr><td width="50%"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvac_lv0019->lv004;?>" tabindex="8" maxlength="100" style="width:100%" onKeyPress="return CheckKey(event,7)"/>
				  <td>
							  <ul id="pop-nav43" lang="pop-nav43" onkeyup="ChangeName(this,43)" onMouseOver="ChangeName(this,43)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" style="width:100%" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="200" >
							    <div id="lv_popup43" lang="lv_popup43"> </div>						  
						</li>
					</ul></td></tr></table></td>
						  </tr>						  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvac_lv0019->lv005;?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvac_lv0019->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td width="178"  height="20"><input name="txtlv007" id="txtlv007"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvac_lv0019->lv007;?>"></td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><input name="txtlv008" id="txtlv008"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvac_lv0019->lv008;?>"></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><input type="text" name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvac_lv0019->FormatView($lvac_lv0019->lv009,2);?>">
						      <img tabindex="13" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv009);return false;" /></td>
						    </tr>
                         <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv010" id="txtlv010"   tabindex="14"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"><?php echo $lvac_lv0019->LV_LinkField('lv010',$lvac_lv0019->lv010);?></select>
				  </td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv010_search" id="txtlv010_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv010','ac_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv010','ac_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%"><select name="txtlv011" id="txtlv011"   tabindex="15"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"><?php echo $lvac_lv0019->LV_LinkField('lv011',$lvac_lv0019->lv011);?></select>
							  </td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onkeyup="ChangeName(this,3)" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv011_search" id="txtlv011_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv011','hr_lv0018','lv002')" onFocus="LoadPopup(this,'txtlv011','hr_lv0018','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input name="txtlv012" type="text" id="txtlv012" value="<?php echo (float)$lvac_lv0019->lv012;?>" tabindex="16" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>		
<tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td width="178"  height="20">
									<input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvac_lv0019->lv013;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><input name="txtlv014" type="text" id="txtlv014"  value="<?php echo  $lvac_lv0019->FormatView($lvac_lv0019->lv014,2);?>" tabindex="18" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						      <img tabindex="18" src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmedit.txtlv014);return false;" /></td>
						    </tr>	
								<tr>
								<td width="166"  height="20"><?php echo $vLangArr[29];?></td>
								<td width="178"  height="20">
									<input name="txtlv015" type="text" id="txtlv015"  value="<?php echo $lvac_lv0019->lv015;?>" tabindex="19" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
					      </tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[36];?></td>
								<td width="178"  height="20">
									<input name="txtlv018" type="text" id="txtlv018"  value="<?php echo $lvac_lv0019->lv018;?>" tabindex="19" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
					      </tr>		
							<tr>
								<td width="166"  height="20"><?php echo 'Chọn chi nhánh';?></td>
								<td width="178"  height="20">
									<select name="txtlv022" id="txtlv022"   tabindex="7"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)"><?php echo $lvac_lv0019->LV_LinkField('lv022',$lvac_lv0019->lv022);?></select>
								</td>
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
		o.txtlv005.focus();
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