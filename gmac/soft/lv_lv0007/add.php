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
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvlv_lv0007->lv001=$_POST['txtlv001'];
$lvlv_lv0007->lv002=$_POST['txtlv002'];
$lvlv_lv0007->lv003=$_POST['txtlv003'];
$lvlv_lv0007->lv004=$_POST['txtlv004'];
$lvlv_lv0007->lv005=$_POST['txtlv005'];
$lvlv_lv0007->lv006=$_POST['txtlv006'];
$lvlv_lv0007->lv094=$_POST['txtlv094'];
$lvlv_lv0007->lv095=$_POST['txtlv095'];
$lvlv_lv0007->lv099=$_POST['txtlv099'];
$lvlv_lv0007->lv100=$_POST['txtlv100'];
if($vFlag==1)
{
		
		$vresult=$lvlv_lv0007->LV_Insert();
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
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo "Mã khác rỗng";?>");
			o.txtlv002.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.txtlv002.value=getChecked(o.chklv002.value,'chklv002');
				o.submit();
			}
		
	}
function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
-->
</script>
<?php
if($lvlv_lv0007->GetAdd()>0)
{
?>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"  name="frmadd" id="frmadd"  method="post">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="left" id="table1">
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
									<input name="txtlv001" type="text" id="txtlv001"  value="" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv004" type="text" id="txtlv004"  value="<?php echo $lvlv_lv0007->lv004;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br>
							 </td>
							</tr>
							 <tr>
								<td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
								<td height="20"><input type="password"  name="txtlv005" id="txtlv005"   tabindex="6"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv005;?>"/>
									
							  </td>
					      </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px">
												<input type="hidden" name="txtlv002" id="txtlv002"   tabindex="7"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv002;?>"/>
												<?php echo $lvlv_lv0007->GetBuilCheckList($vrow['lv002'],'chklv002',10,'hr_lv0002','lv003');?>
										
							 </td>
							  </tr>	
							<tr>
								<td height="20" valign="top"><?php echo $vLangArr[18];?></td>
								<td height="20">
									<table style="width:80%">
										<tr>
											<td width="100%">
												<select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
												<option value="">...</option>
												<?php echo $lvlv_lv0007->LV_LinkField('lv003',$lvlv_lv0007->lv003);?>
												</select>
											</td>
											
										</tr>
									</table>
									
								</td>
					      </tr>
						 
						  <tr>
								<td  height="20" valign="top"><?php echo $vLangArr[20];?></td>
								<td height="20">
								
								<table style="width:80%">
										<tr>
											<td width="50%">
												<input name="txtlv006" id="txtlv006"   tabindex="8"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv006;?>" readonly="true"/>
											</td>
											<td width="50%">
												<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" onFocus="LoadPopup(this,'txtlv006','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200" >
													<div id="lv_popup" lang="lv_popup1"> </div>						  
													</li>
												</ul>
											</td>
										</tr>
									</table>
							  </td>
					      </tr>
						  <tr>
							  <td  height="20px"><?php echo 'UserControl';?></td>
							  <td  height="20px">
							  <select name="txtlv094" id="txtlv094"   tabindex="10"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <option value="">...</option>
							  <?php echo $lvlv_lv0007->LV_LinkField('lv094',$lvlv_lv0007->lv094);?>
							  </select></td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo 'IPLogin';?></td>
							  <td  height="20px"><input name="txtlv095" type="text" id="txtlv095"  value="<?php echo $lvlv_lv0007->lv095;?>" tabindex="11" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" /><br>
							 </td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo 'Mẫu';?></td>
							  <td  height="20px">
							  <select name="txtlv099" id="txtlv099"   tabindex="12"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
							  <option value="">...</option>
							  <?php echo $lvlv_lv0007->LV_LinkField('lv099',$lvlv_lv0007->lv099);?>
							  </select></td>
							  </tr>		
							<tr>
								<td  height="20" valign="top"><?php echo 'Mã chi nhánh login';?></td>
								<td height="20"><input type="textbox"  name="txtlv100" id="txtlv100"   tabindex="13"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $lvlv_lv0007->lv100;?>"/></td>
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
<script language="javascript"> var o=document.frmadd; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
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
	include("../lv_lv0007/permit.php");
}
?>
</body>
</html>