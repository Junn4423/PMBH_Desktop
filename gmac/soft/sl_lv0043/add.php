<?php
session_start();
//require_once("../../clsall/sl_lv0043.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0043.php");
require_once("../../clsall/tc_lv0005.php");
require_once("../../clsall/sl_lv0044.php");
require_once("../../clsall/sl_lv0013.php");
//////////////init object////////////////
$lvsl_lv0043=new sl_lv0043($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0043');
$lvtc_lv0005=new tc_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0042');
$lvsl_lv0044=new sl_lv0044($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0044');
$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0013');
$lvsl_lv0043->obj_detail=$lvsl_lv0044;
$lvsl_lv0043->obj_config=$lvtc_lv0005;
$lvsl_lv0043->obj_contract=$lvsl_lv0013;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0061.txt",$plang);
$vNow=GetServerDate();	
$mosl_lv0043->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvsl_lv0043->lv001=$_POST['txtlv001'];
$lvsl_lv0043->lv002=$_POST['txtlv002'];
if($lvsl_lv0043->lv002=="" || $lvsl_lv0043->lv002==NULL) $lvsl_lv0043->lv002=getyear($vNow);
$lvsl_lv0043->lv003=$_POST['txtlv003'];
if($lvsl_lv0043->lv003=="" || $lvsl_lv0043->lv003==NULL) $lvsl_lv0043->lv003="01/01/".(getyear($vNow)-1);
$lvsl_lv0043->lv004=$_POST['txtlv004'];
if($lvsl_lv0043->lv004=="" || $lvsl_lv0043->lv004==NULL) $lvsl_lv0043->lv004="31/12/".(getyear($vNow)-1);
$lvsl_lv0043->lv007=$_POST['txtlv007'];
if($lvsl_lv0043->lv007=="" || $lvsl_lv0043->lv007==NULL) $lvsl_lv0043->lv007="01/01/".getyear($vNow);
$lvsl_lv0043->lv008=$_POST['txtlv008'];
if($vFlag==1)
{
		
		$vresult=$lvsl_lv0043->LV_Insert();
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
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv006.value="";
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
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		 if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[22];?>");
			o.txtlv002.focus();
			}
		 else if(o.txtlv003.value==""){
				alert("<?php echo $vLangArr[21];?>");
				o.txtlv003.focus();
				}
		 else if(o.txtlv004.value==""){
				alert("<?php echo $vLangArr[21];?>");
				o.txtlv004.focus();
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
if($lvsl_lv0043->GetAdd()>0)
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
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvsl_lv0043->lv001=="")?InsertWithCheck('sl_lv0043', 'lv001', 'SAL',4):$lvsl_lv0043->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
						    <tr>
								<td width="166"  height="20"><?php echo $vLangArr[16];?></td>
								<td width="178"  height="20">
									<input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvsl_lv0043->lv002;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							  <tr>
								<td width="166"  height="20"><?php echo $vLangArr[17];?></td>
								<td width="178"  height="20">
									<input name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvsl_lv0043->lv003;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>	
									 <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv003);return false;" /></span></td>
					      </tr>
							
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
							  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvsl_lv0043->lv004;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv004);return false;" /></span></td>
						    </tr>
							 <tr>
								<td width="166"  height="20"><?php echo 'Ngày hết hạn';?></td>
								<td width="178"  height="20">
									<input name="txtlv007" type="text" id="txtlv007"  value="<?php echo $lvsl_lv0043->lv007;?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>	
									 <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv007);return false;" /></span></td>
					      </tr>
							<tr>
								<td width="166"  height="20"><?php echo 'Phần % giảm trực tiếp';?></td>
								<td width="178"  height="20">
									<input name="txtlv008" type="text" id="txtlv008"  value="<?php echo $lvsl_lv0043->lv008;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
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
		o.txtlv001.focus();
</script>

<script language="javascript" src="../../javascript/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
		Cancel();
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