<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/sl_lv0064.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0064.php");
//////////////init object////////////////
$lvsl_lv0064=new sl_lv0064($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0064');
/////////Get ID///////////////
$lvsl_lv0064->lv001=$_GET['ChildDetailID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0077.txt",$plang);

$vFlag=(int)$_POST['txtFlag'];

$vStrMessage="";


if($vFlag==1)
{
		$lvsl_lv0064->lv002=$_POST['txtlv002'];
		$lvsl_lv0064->lv003=$_POST['txtlv003'];
		$lvsl_lv0064->lv004=$_POST['txtlv004'];
		$lvsl_lv0064->lv005=$_POST['txtlv005'];
		$lvsl_lv0064->lv006=$_POST['txtlv006'];
		$lvsl_lv0064->lv007=$_POST['txtlv007'];	
		$lvsl_lv0064->lv008=$_POST['txtlv008'];			
		$vresult=$lvsl_lv0064->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}

$lvsl_lv0064->LV_LoadID($lvsl_lv0064->lv001);

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
		var o=document.frmedit;
		o.txtlv002.value="<?php echo $lvsl_lv0064->lv002;?>";
		o.txtlv003.value="<?php echo $lvsl_lv0064->lv003;?>";
		o.txtlv004.value="<?php echo $lvsl_lv0064->lv004;?>";
		o.txtlv005.value="<?php echo $lvsl_lv0064->lv005;?>";
		o.txtlv006.value="<?php echo $lvsl_lv0064->lv006;?>";	
		o.txtlv007.value="<?php echo $lvsl_lv0064->lv007;?>";
		o.txtlv002.focus();
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
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[22];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value==""){
			alert("<?php echo $vLangArr[23];?>");
			o.txtlv003.focus();
			}
		else
			{
			o.txtFlag.value="1";
			o.submit();
			}
			
	}
	function LoadUnit()
	{
		var o=document.frmedit;
		ajax_do ('../sl_lv0064/sl_lv0064exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv004.value,1);
		window.setTimeout('CalculateC()',1000);
	}
</script>
<?php
if($lvsl_lv0064->GetEdit()>0)
{
?>
<body >
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
  <div class="story">
    <h3>
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" id="frmedit" action="#" method="post">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="610" border="0" align="center" id="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvsl_lv0064->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input  name="txtlv002" type="text" id="txtlv002" value="<?php echo $lvsl_lv0064->lv002;?>" tabindex="6" maxlength="38" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px">
								<input  name="txtlv003" type="text" id="txtlv003" value="<?php echo (float)$lvsl_lv0064->lv003;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							 </td>
							  </tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><table style="width:80%"><tr><td><select name="txtlv004" id="txtlv004"   tabindex="6"  style="width:100%" onKeyPress="return CheckKey(event,7)" onblur="LoadUnit()"/>
								<?php echo $lvsl_lv0064->LV_LinkField('lv004',$lvsl_lv0064->lv004);?>
							  </select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv004_search" id="txtlv004_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv004','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv004','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"> <input name="txtlv005" type="text" tabindex="9" value="<?php echo (float)$lvsl_lv0064->lv005;?>" style="width:80%" />
						 </td>
							</tr>					  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><table style="width:80%"><tr><td><select name="txtlv006" id="txtlv006"   tabindex="10"  style="width:100%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvsl_lv0064->LV_LinkField('lv006',$lvsl_lv0064->lv006);?>
							  </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv006','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv006','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table> </td>
							  </tr>
							  <tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvsl_lv0064->lv007;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      </td>
							  </tr>						 
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag" /></td>
						  </tr>
							<tr>
							  <td  height="20px" colspan="2"> <TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /><?php echo $vLangArr[2];?></a></TD>
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
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript"> var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
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