<?php
/*
Copy right ERPSOFV2R.com
No Edit
DateCreate:18/07/2005
*/
session_start();
$vDefaultPath="../../../images/employees/";
//require_once("../../clsall/hr_lv0086.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0086.php");
//////////////init object////////////////
$lvhr_lv0086=new hr_lv0086($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0086');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","HR0213.txt",$plang);
$mohr_lv0086->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
if($vFlag==1)
{
$lvhr_lv0086->lv001=$_POST['txtlv001'];
$lvhr_lv0086->lv002=$_POST['txtlv002'];
$lvhr_lv0086->lv003=$_POST['txtlv003'];
$lvhr_lv0086->lv004=$_POST['txtlv004'];
$lvhr_lv0086->lv005=$_POST['txtlv005'];
$lvhr_lv0086->lv006=$_POST['txtlv006'];
$lvhr_lv0086->lv007=$_POST['txtlv007'];
$lvhr_lv0086->lv008=$_POST['txtlv008'];
$lvhr_lv0086->lv009=$_POST['txtlv009'];
$lvhr_lv0086->lv010=$_POST['txtlv010'];
$lvhr_lv0086->lv011=$_POST['txtlv011'];
$lvhr_lv0086->lv012=$_POST['txtlv012'];
$lvhr_lv0086->lv013=$_POST['txtlv013'];
$lvhr_lv0086->lv014=$_POST['txtlv014'];
$lvhr_lv0086->lv015=$_POST['txtlv015'];
$lvhr_lv0086->lv016=$_POST['txtlv016'];
		
		$vresult=$lvhr_lv0086->LV_UpdateMonth($_GET['ChildID']);
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();		
			$vFlag = 0;
		}
}
$lvhr_lv0086->LV_LoadMonthID($_GET['ChildID']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
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
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
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
if($lvhr_lv0086->GetEdit()>0)
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
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0086->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[16];?></td>
								<td  height="20">
									<input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0086->lv002;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20">
							  <input name="txtlv003" type="text" id="txtlv003"  value="<?php echo $lvhr_lv0086->lv003;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  </td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[18];?></td>
							  <td  height="20">
							  <input name="txtlv004" type="text" id="txtlv004"  value="<?php echo $lvhr_lv0086->lv004;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[19];?></td>
							  <td  height="20">
							  <input name="txtlv005" type="text" id="txtlv005"  value="<?php echo $lvhr_lv0086->lv005;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[20];?></td>
							  <td  height="20">
							  <input name="txtlv006" type="text" id="txtlv006"  value="<?php echo $lvhr_lv0086->lv006;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20">
							  <input name="txtlv008" type="text" id="txtlv008"  value="<?php echo $lvhr_lv0086->lv008;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[23];?></td>
							  <td  height="20">
							  <input name="txtlv009" type="text" id="txtlv009"  value="<?php echo $lvhr_lv0086->lv009;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[24];?></td>
							  <td  height="20">
							  <input name="txtlv010" type="text" id="txtlv010"  value="<?php echo $lvhr_lv0086->lv010;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[25];?></td>
							  <td  height="20">
							  <input name="txtlv011" type="text" id="txtlv011"  value="<?php echo $lvhr_lv0086->lv011;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[26];?></td>
							  <td  height="20">
							  <input name="txtlv012" type="text" id="txtlv012"  value="<?php echo $lvhr_lv0086->lv012;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20">
							  <input name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvhr_lv0086->lv013;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							</td></tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[28];?></td>
							  <td  height="20">
							  <input name="txtlv014" type="text" id="txtlv014"  value="<?php echo $lvhr_lv0086->lv014;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							</td></tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[29];?></td>
							  <td  height="20">
							  <input name="txtlv015" type="text" id="txtlv015"  value="<?php echo $lvhr_lv0086->lv015;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							</td></tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[30];?></td>
							  <td  height="20">
							  <input name="txtlv016" type="text" id="txtlv016"  value="<?php echo $lvhr_lv0086->lv016;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							</td></tr>	
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

</body>
<?php
} else {
	include("../permit.php");
}
?>
</html>