<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/mn_lv0004.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/mn_lv0004.php");
//////////////init object////////////////
$lvmn_lv0004=new mn_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0004');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvmn_lv0004->lv001=$_GET['ChildID'];
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","MN0002.txt",$plang);
$momn_lv0004->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvmn_lv0004->lv002=$_POST['txtlv002'];
$lvmn_lv0004->lv003=$_POST['txtlv003'];
$lvmn_lv0004->lv004=$_POST['txtlv004'];
$lvmn_lv0004->lv005=$_POST['txtlv005'];
$lvmn_lv0004->lv006=$_POST['txtlv006'];
$lvmn_lv0004->lv007=$_POST['txtlv007'];
$lvmn_lv0004->lv008=$_POST['txtlv008'];
$lvmn_lv0004->lv009=$_POST['txtlv009'];
$lvmn_lv0004->lv010=$_POST['txtlv010'];
$lvmn_lv0004->lv011=$_POST['txtlv011'];
$lvmn_lv0004->lv012=$_POST['txtlv012'];
		
		$vresult=$lvmn_lv0004->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvmn_lv0004->LV_LoadID($lvmn_lv0004->lv001);


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
	o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0)?>";
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
if($lvmn_lv0004->GetEdit()>0)
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvmn_lv0004->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>		</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvmn_lv0004->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20">
							 <table style="width:80%"><tr>
							  <td width="50%"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" onblur="changeitem_change(this.value)"/><?php echo $lvmn_lv0004->LV_LinkField('lv003',$lvmn_lv0004->lv003);?>
							  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv003_search" id="txtlv003_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv003','*@*@*.sl_lv0007','lv002')" onFocus="LoadPopup(this,'txtlv003','*@*@*.sl_lv0007','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				              <td  height="20"><input name="txtlv004" id="txtlv004"   tabindex="8"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvmn_lv0004->lv004;?>"/></td>
</tr>							  
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><table style="width:80%"><tr>
							  <td width="50%"><div id="itemsgetid"><select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <?php echo $lvmn_lv0004->LV_LinkField('lv005',$lvmn_lv0004->lv005);?>
							  </select></div></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv005_search" id="txtlv005_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv005','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (float)$lvmn_lv0004->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td  height="20"><select name="txtlv007" id="txtlv007"   tabindex="11"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <option value="0" <?php echo ($lvmn_lv0004->lv007=="0")?'selected="selected"':''?>><?php echo $vLangArr[30];?></option>
							  <option value="1" <?php echo ($lvmn_lv0004->lv007=="1")?'selected="selected"':''?>><?php echo $vLangArr[29];?></option>
							  </select>						 </td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><select name="txtlv008" id="txtlv008"   tabindex="12"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)"/>
							  <option value="1" <?php echo ($lvmn_lv0004->lv008=="1")?'selected="selected"':''?>><?php echo $vLangArr[29];?></option>
							  <option value="0" <?php echo ($lvmn_lv0004->lv008=="0")?'selected="selected"':''?>><?php echo $vLangArr[30];?></option>
							  </select>		
							  </td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><table style="width:80%" ><tr>
							  <td width="50%">
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" name="txtlv009" id="txtlv009" tabindex="13" style="width:100%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0004->lv009;?>" onKeyUp="LoadSelf(this,'txtlv009','sl_lv0017','lv003')" onFocus="LoadSelf(this,'txtlv009','sl_lv0017','lv003')">
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
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
	include("../mn_lv0004/permit.php");
}
?>
</body>
</html>