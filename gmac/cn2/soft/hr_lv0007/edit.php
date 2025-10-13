<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/hr_lv0007.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0007.php");
//////////////init object////////////////
$lvhr_lv0007=new hr_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'HR0023');
/////////Get ID///////////////
$lvhr_lv0007->lv001=$_GET['ID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","HR0060.txt",$plang);

$vFlag=(int)$_POST['txtFlag'];

$vStrMessage="";


if($vFlag==1)
{
		$lvhr_lv0007->lv002=$_POST['txtlv002'];
		$lvhr_lv0007->lv003=$_POST['txtlv003'];
		$lvhr_lv0007->lv004=$_POST['txtlv004'];
		$lvhr_lv0007->lv005=$_POST['txtlv005'];
		$lvhr_lv0007->lv006=$_POST['txtlv006'];		
		$vresult=$lvhr_lv0007->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[11];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[12].sof_error();
			$vFlag=0;
		}

}

$lvhr_lv0007->LV_LoadID($lvhr_lv0007->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
</head>
<script language="javascript">
function isphone(s){
	if(s!=""){
		var str="0123456789.()"
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
		o.txtlv002.value="<?php echo $lvhr_lv0007->lv002;?>";
		o.txtlv003.value="<?php echo $lvhr_lv0007->lv003;?>";
		o.txtlv004.value="<?php echo $lvhr_lv0007->lv004;?>";
		o.txtlv005.value="<?php echo $lvhr_lv0007->lv005;?>";
		o.txtlv006.value="<?php echo $lvhr_lv0007->lv006;?>";		
		o.txtlv007.value="<?php echo $lvhr_lv0007->lv007;?>";		
		o.txtlv002.focus();
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
			alert("<?php echo $vLangArr[22];?>");
		else if(o.txtlv002.value==""){
			alert("<?php echo $vLangArr[23];?>");
			o.txtlv002.focus();
			}	
		else
		{
		o.txtlv006.value=getChecked(o.chklv007.value,'chklv007');
		o.txtFlag.value="1";
		o.submit();
		}
			
	}
</script>
<body bgcolor=""  onkeyup="KeyPublicRun(event)">
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[14];?></h2>
  <div class="story">
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" id="frmedit" action="#" method="post">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="180"  height="20px"><?php echo $vLangArr[15];?></td>
							  <td   height="20px"><input  name="txtlv001" type="text" id="txtlv001" readonly="true" value="<?php echo $lvhr_lv0007->lv001;?>" /></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvhr_lv0007->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><textarea type="text" name="txtlv003" id="txtlv003"  rows="4"  tabindex="7" style="width:80%"><?php echo $lvhr_lv0007->lv003;?></textarea></td>
							</tr>
<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
				  <td  height="20px"><textarea type="text" name="txtlv004" id="txtlv004"  rows="4" tabindex="8" style="width:80%"><?php echo $lvhr_lv0007->lv004;?></textarea></td>
							  </tr>							  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><select name="txtlv005" id="txtlv005" tabindex="9"  style="width:80%">
								<option value=""><?php echo $vLangArr[20];?></option>
                          		<?php 
								$sqlS1 = "SELECT * FROM hr_lv0006 ORDER BY lv002";
								$bResultS1 = db_query($sqlS1);
								$totalRows1 = db_num_rows($bResultS1);
								if($totalRows1>0){
									while($arrS1 = db_fetch_array($bResultS1)){
								?>
                          		<option value="<?php echo $arrS1['lv001'];?>" <?php echo ($arrS1['lv001']==$lvhr_lv0007->lv005)?'selected="selected"':'';?> ><?php echo $arrS1['lv002']." [".$arrS1['lv001']."]";?></option>
                          		<?php
									}
								}
								?>
                        	</select></td>
							  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv006" type="hidden" id="txtlv006" value="<?php echo $lvhr_lv0007->lv006;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $lvhr_lv0007->GetBuilCheckList($lvhr_lv0007->lv006,'chklv007',10);?></td>
							  </tr>																				
							<tr>					 
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
				
  </div>
</div>
<script language="javascript"> var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
		o.txtlv002.select();
</script>
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
</html>