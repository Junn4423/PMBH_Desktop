<?php
session_start();
$vDir="../";
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");

require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ac_lv0102.php");
////Init object//////////////
		$moac_lv0102 = new ac_lv0102($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0102');	
/////////Varian////////////////		
$vOptRun=(int)$_GET['rad'];
$vlv001=$_GET['txtlv001'];//wh
$vlv002=$_GET['txtlv002'];//startdate
$vlv003=$_GET['txtlv003'];//Enddate
$vlv004=$_GET['txtlv004'];//Source
$vlv005=$_GET['txtlv005'];//Reference
$vlv006=$_GET['txtlv006'];//Reference
$vlv007=$_GET['txtlv007'];//Reference
$vlv008=$_GET['txtlv008'];//Reference
$strNow=GetServerDate();
	if($plang=="" || $plang!="EN") $plang="VN";
		$vLangArr = GetLangFile("../../","AC0064.txt",$plang);
$moac_lv0102->lang=strtoupper($plang);

////////////////////////////////////////////Get Data////////////////////////////////////////////////
////////////////////////////////////////////Get Data////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="<?php echo $vDir;?>../css/reportstyle.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo $vDir;?>../css/runtype/horizontalstyle.css" type="text/css">
<title><?php echo $vLangArr[1];?></title>
<style>
.tblRunChild
{
	color:#000099;
	font-weight:bold;
	background-color:#E2F0F1;
}
.htablerun{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	background-color:#E2F0F1;
	font-weight:bold;
	padding-top:2px;
	padding-left:2px;
	padding-right:2px;
	padding-bottom:2px;
	text-align:center;
	font-weight:bold;
}
</style>
<script language="javascript" src="../../javascript/printscript.js"></script>
</head>
<script language="javascript" src="<?php echo $vDir;?>../javascript/printscript.js"></script>
<script language="javascript">loadImgsPrint("<?php echo $vDir;?>../");
function ViewInfos(vValue,vType){
	var o = document.frmPostThis;
	if(vType=="X")
	{
	o.txtOutStockID.value = vValue;
	o.txtReceiptionID.value="";
	//o.txtFlag.value = "5";
	o.action="<?php echo $vDir;?>ac_lv0102/ac_lv0102outstock.php?lang=<?php echo $plang;?>";
	}
	else
	{
	o.txtOutStockID.value ="";
	o.txtReceiptionID.value = vValue;
	//o.txtFlag.value = "5";
	o.action="<?php echo $vDir;?>ac_lv0102/ac_lv0102receiption.php?lang=<?php echo $plang;?>";
	
	}	
	o.target="_blank";
	o.submit();
}
function ViewLot(vValue,vStockID){
window.open('<?php echo $vDir;?>wh_lots/wh_lotsview.php?lang=<?php echo $plang;?>&StockID='+vStockID+'&LotID='+vValue,'Requirement','width=600,height=200,left=200,top=350,resizable=yes,screenX=0,screenY=100,scrollbars=yes');
}

</script>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<!--
		<tr>
			<td class="specialtext" align="right" valign="top" colspan="5">
				<a href="javascript:window.print();" style="text-decoration:none; color:#888888;"><?php //echo "[ ".$vLangArr[4]." ]";?></a>
				<a href="javascript:window.close();" style="text-decoration:none; color:#888888"><?php //echo "[ ".$vLangArr[5]." ]";?></a>	
			</td>
		</tr>
		//-->
		<tr>
			<td align="center" colspan="6">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td>
						<td width="1" align="right" valign="bottom"><?php echo "<img src='../../clsall/barcode/barcode.php?barnumber=".str_replace("/","",formatdate($strNow,$plang))."'>";?></td>
					</tr>
				</table>			</td>
		</tr>
		<tr>
	    <td align="center" colspan="6"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center" valign="middle" onDblClick="this.innerHTML=''"><img  src="<?php echo $moac_lv0102->GetLogo();?>" /></td>
              </tr>
              <tr>
                <td align="center" style="padding-right:2px;font-size:30px;font-weight:bold" ><?php
				if(($vlv005!="" && $vlv005!=NULL))
				{
					if(strpos($vlv005,'111')===false )
					{
						echo $vLangArr[35].' '.$vlv005.(($vlv005!=""&& $vlv006!="")?" & ".$vlv006:$vlv006);
						
					}
					else
						{
							if( strpos($vlv005,'111')==0)
							echo $vLangArr[38].'   <br/><font style="font-size:14px">TK:'.$vlv005."</font>";
						else
							echo $vLangArr[35].' '.$vlv005.(($vlv005!=""&& $vlv006!="")?" & ".$vlv006:$vlv006);
					}
				}
				else
				{
					if( ($vlv006!="" && $vlv006!=NULL))
					{
							if(strpos($vlv006,'111')===false )
						{
							echo $vLangArr[35].' '.$vlv005.(($vlv005!=""&& $vlv006!="")?" & ".$vlv006:$vlv006);
							
						}
						else
							{
								if(strpos($vlv006,'111')==0)
								echo $vLangArr[37].'   <br/><font style="font-size:14px">TK:'.$vlv006."</font>";
							else
								echo $vLangArr[35].' '.$vlv005.(($vlv005!=""&& $vlv006!="")?" & ".$vlv006:$vlv006);
							}
					}
					else
						echo $vLangArr[0];
				}
				
				?></td>
              </tr>
              <tr>
                <td align="center"><table width="350" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="*%"><b><?php echo $vLangArr[2];?>:</b></td>
    <td><?php echo $vlv002;?></td>
    <td width="*%"><b><?php echo $vLangArr[3];?>:</b></td>
    <td><?php echo $vlv003;?></td>
  </tr>
</table></td>
              </tr>
            </table>
			  </td>
		</tr>
		<tr height="40px">
			<td width="399" valign="middle" class="address">
				<div id="addr" align="left" style="width:480px;">
					<?php echo $moac_lv0102->GetCompany();?>
				<br><?php echo $vLangArr[18].":".$moac_lv0102->GetAddress();?>	
					<br><?php echo $vLangArr[15].":".$moac_lv0102->GetPhone()."&nbsp;&nbsp;&nbsp;".$vLangArr[16].":".$moac_lv0102->GetFax();?>
		  </div></td>
		    <td width="63" align="right" valign="top" class="boldtext">&nbsp;</td>
	        <td width="278" align="left" valign="top" class="boldtext">&nbsp;</td>
		</tr>
		<tr><td colspan="6" height="35px">&nbsp;</td></tr>
		<tr>

			<td height="20px" colspan="6" align="center" class="normaltext">
				<?php 
						switch($vOptRun)
							{
								case 2:
							$strDataShow = $moac_lv0102->PrintInOutPutInStockDetail($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv005,$vlv006);
									break;
								case 3:
							$strDataShow = $moac_lv0102->PrintInOutPutInStockDetail($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),1,$vlv006,$vlv007,$vlv008);									
									break;
							}
						
							if($strDataShow!="" || $strDataShow!=NULL){
								echo $strDataShow;
							} else {
								echo $vLangArr[5];
							}?></td>
		</tr>
		<tr height="40px"><td colspan="6" align="right"><span class="normaltext"><span class="boldtext"><?php echo $vLangArr[20]." ".formatdate($strNow, $plang);?></span></span></td></tr>
		<tr>
			<td height="20px" colspan="6" align="center" class="normaltext">
				<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20px">&nbsp;</td>
						<td width="200px">&nbsp;</td>
						<td width="*">&nbsp;</td>
						<td width="200px">&nbsp;</td>
						<td width="20px">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr[18];?></b>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr[19];?></b>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr height="80px"><td colspan="5">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="center_style"><?php for($i=0; $i<60; $i++) echo ".";?>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><?php for($i=0; $i<60; $i++) echo ".";?>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>			</td>
		</tr>
		<tr><td colspan="6" height="40px">&nbsp;</td></tr>
	</table>
		<form action="" id="frmPostThis" name="frmPostThis" method="post">
			<input type="hidden" name="txtFlag" id="txtFlag" value="0" />
			<input type="hidden" name="txtOutStockID" id="txtOutStockID" value="" />
			<input type="hidden" name="txtReceiptionID" id="txtReceiptionID" value="" />
			
		</form>	
</body>
</html>