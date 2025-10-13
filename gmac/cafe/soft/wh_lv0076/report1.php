<?php
session_start();
$vDir="../";
include($vDir."paras.php");
include($vDir."config.php");
include($vDir."function.php");
$strNow=GetServerDate();
$sExport=$_GET['func'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=tonkho'.str_replace("/","",formatdate($strNow,$plang)).'.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=tonkho'.str_replace("/","",formatdate($strNow,$plang)).'.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}


require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0076.php");
require_once("../../clsall/wh_lv0001.php");
////Init object//////////////
		$mowh_lv0076 = new wh_lv0076($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0076');	
		
		$mowh_lv0076->path_server="";
$mowh_lv0076->path_web="";
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
$vlv009=$_GET['txtlv009'];//Reference
$vlv012=$_GET['txtlv012'];//Reference
$vQuiDoi=$_GET['txtquidoi'];
$vexist=$_GET['txtexist'];//Reference
$isbalance=(int)$_GET['isbalance'];//Liên kết nguồn
$vexistcur=$_GET['txtexistcur'];//Reference
$vshowimage=$_GET['txtshowimage'];

	if($plang=="" || $plang!="EN") $plang="VN";
		$vLangArr = GetLangFile("../../","WH0022.txt",$plang);
if($vlv001!="")
{
	$mowh_lv0001 = new wh_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0001');	
	$vArrWH=explode(",",$vlv001);
	$i=0;
	foreach($vArrWH as $vWH)
	{
		$mowh_lv0001->LV_LoadID($vWH);
		if($mowh_lv0001->lv001!=NULL && $mowh_lv0001->lv001!='')
		{
			if($vDSKho=="") $vDSKho= $mowh_lv0001->lv003;
			else
			$vDSKho=$vDSKho.", ".$mowh_lv0001->lv003;
		}
	}
}
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
	o.action="<?php echo $vDir;?>wh_lv0010/?func=&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	}
	else
	{
	o.txtOutStockID.value ="";
	o.txtReceiptionID.value = vValue;
	//o.txtFlag.value = "5";
	o.action="<?php echo $vDir;?>wh_lv0008/?func=&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	
	}	
	o.target="_blank";
	o.submit();
}
function ViewLot(vValue,vStockID){
window.open('<?php echo $vDir;?>wh_lv0020/?func=rpt&lang=<?php echo $plang;?>&StockID='+vStockID+'&LotID='+vValue,'Requirement','width=600,height=200,left=200,top=350,resizable=yes,screenX=0,screenY=100,scrollbars=yes');
}

</script>
<?php
if($mowh_lv0076->GetView()==1)
{
?>
<body onLoad="moveImgPrint()" onResize="moveImgPrint()">
	<table border="0" cellpadding="0" cellspacing="0" width="740px" align="center">
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
							<td align="right"><div><div style="float:left"><img src="../../logo.png" width="130"/></div><div><?php echo (1>0)?"<img src='../../clsall/barcode/barcode.php?barnumber=".str_replace("/","",formatdate($strNow,$plang))."'>":"";?></div></div></td>
						</tr>	
						<tr>
							<td align="center">
							<font style="font-size:14px;font-weight:bold"><?php echo $mowh_lv0076->GetCompany();?></font>
							<br/>
							<div>
							Địa chỉ:<?php echo $mowh_lv0076->GetAddress();?>
							<div style="border-top:1px #000 solid;width:84%;height:20px;margin-top:5px;"></div>
							</div>
							</td>
						 </tr>
				</table>			</td>
		</tr>
		<tr>
	    <td align="center" colspan="6"><table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center" style="padding-right:2px;font-size:30px;font-weight:bold;text-transform:uppercase"><?php 
				switch($vOptRun)
				{
					case 5:
						echo 'Báo cáo kho thay thế và kho hư theo ngày';
						break;
					case 6:
						echo 'Báo cáo kho thay thế và kho hư theo tháng';
						break;
					default:
						echo $vLangArr[0];
						break;
				}
				?></td>
              </tr>
              <tr>
                <td align="center"><table width="200" border="0" cellspacing="1" cellpadding="1">
<?php
if($vOptRun==6)
{
	?>
  <tr>
    <td width="*%"><b><?php echo 'Từ tháng';?>:</b></td>
    <td><?php echo substr($vlv002,3,8);?></td>
	</tr>
	<tr>
    <td width="*%"><b><?php echo ' đến tháng ';?>:</b></td>
    <td><?php echo substr($vlv003,3,8);?></td>
  </tr>
<?php
}
else
{
?>  
 <tr>
    <td width="*%"><b><?php echo $vLangArr[2];?>:</b></td>
    <td><?php echo $vlv002;?></td>
	</tr>
	<tr>
    <td width="*%"><b><?php echo $vLangArr[3];?>:</b></td>
    <td><?php echo $vlv003;?></td>
  </tr>
<?php
}
?>  
</table></td>
              </tr>
            </table>
			  </td>
		</tr>
		<tr class="address"><td colspan="6" height="35px"><strong><?php echo ($vDSKho!='')?(($plang=='VN')?'Kho: ':'Warehouse: ').$vDSKho:(($plang=='VN')?'Tất cả các kho':'All warehouse');?>&nbsp;</strong></td></tr>
		<tr>

			<td height="20px" colspan="6" align="center" class="normaltext">
				<?php 
						switch($vOptRun)
						{
							case 2:
								if($vQuiDoi==1)
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetailQuiDoi($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);
								else
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetail($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);
								break;
							case 3:
								if($vQuiDoi==1)
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetailQuiDoi($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);
								else
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetail($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),1,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);									
								break;
							case 4:
								if($vQuiDoi==1)
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetailQuiDoi($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);
								else
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetail($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),4,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);									
								break;
							case 5:
								if($vQuiDoi==1)
									$strDataShow = $mowh_lv0076->PrintInOutPutInStockDetailQuiDoi($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),2,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$isbalance,$vlv012,$vlv011);
								else
									$strDataShow = $mowh_lv0076->PrintInOutCompareDay($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),4,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$vlv011);									
								break;
							case 6:
								$strDataShow = $mowh_lv0076->PrintInOutCompareMonth($plang, $vLangArr,$vlv001,recoverdate($vlv002,$plang),recoverdate($vlv003,$plang),4,$vlv006,$vlv007,$strTyles,$strQuantitative,$strColor,$strNote,$vlv005,$vlv004,$vlv008,$vlv009,$vexist,$vexistcur,$vshowimage,$vlv011);									
								break;
						}
						
							if($strDataShow!="" || $strDataShow!=NULL){
								echo $strDataShow;
							} else {
								echo $vLangArr[5];
							}?></td>
		</tr>
		<tr height="40px"><td colspan="6" align="right"><span class="normaltext"><span class="boldtext"><?php echo $vLangArr[19]." ".formatdate($strNow, $plang);?></span></span></td></tr>
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
						<td class="center_style"><b><?php echo $vLangArr[37];?></b>&nbsp;</td>
						<td class="center_style">&nbsp;</td>
						<td class="center_style"><b><?php echo $vLangArr[38];?></b>&nbsp;</td>
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
<?php
}
?>