<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0113.php");
require_once("../../clsall/sl_lv0114.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/sl_lv0009.php");
require_once("../../clsall/sl_lv0070.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0114=new sl_lv0114($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
$mosl_lv0113=new sl_lv0113($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0113');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mosl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0009');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');
$lvsl_lv0070->LV_Load();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr1=GetLangFile("../../","SL0074.txt",$plang);
$mosl_lv0113->lang=strtoupper($plang);
$mosl_lv0113->lv001=$vlv001;
$mosl_lv0114->objparent=$mosl_lv0113;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0113->ArrPush[0]=$vLangArr1[16];
$mosl_lv0113->ArrPush[1]=$vLangArr1[18];
$mosl_lv0113->ArrPush[2]=$vLangArr1[19];
$mosl_lv0113->ArrPush[3]=$vLangArr1[20];
$mosl_lv0113->ArrPush[4]=$vLangArr1[21];
$mosl_lv0113->ArrPush[5]=$vLangArr1[22];
$mosl_lv0113->ArrPush[6]=$vLangArr1[23];
$mosl_lv0113->ArrPush[7]=$vLangArr1[24];
$mosl_lv0113->ArrPush[8]=$vLangArr1[25];
$mosl_lv0113->ArrPush[9]=$vLangArr1[26];
$mosl_lv0113->ArrPush[10]=$vLangArr1[27];
$mosl_lv0113->ArrPush[11]=$vLangArr1[28];
$mosl_lv0113->ArrPush[12]=$vLangArr1[29];
$mosl_lv0113->ArrPush[13]=$vLangArr1[30];
$mosl_lv0113->ArrPush[14]=$vLangArr1[31];	
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv007,lv010";
//$strParent=$mosl_lv0113->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mosl_lv0114->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0023.txt",$plang);
$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mosl_lv0114->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0114->ArrPush[0]=$vLangArr[17];
$mosl_lv0114->ArrPush[1]=$vLangArr[18];
$mosl_lv0114->ArrPush[2]=$vLangArr[19];
$mosl_lv0114->ArrPush[3]=$vLangArr[20];
$mosl_lv0114->ArrPush[4]=$vLangArr[21];
$mosl_lv0114->ArrPush[5]=$vLangArr[22];
$mosl_lv0114->ArrPush[6]=$vLangArr[23];
$mosl_lv0114->ArrPush[7]=$vLangArr[24]."@01";
$mosl_lv0114->ArrPush[8]=$vLangArr[25];
$mosl_lv0114->ArrPush[9]=$vLangArr[26]."(%)";
$mosl_lv0114->ArrPush[10]=$vLangArr[27];
$mosl_lv0114->ArrPush[11]=$vLangArr[28];
$mosl_lv0114->ArrPush[12]=$vLangArr[29]."(%)";
$mosl_lv0114->ArrPush[13]=$vLangArr[30];
$mosl_lv0114->ArrPush[14]=$vLangArr[31];
$mosl_lv0114->ArrPush[15]=$vLangArr[32];
$mosl_lv0114->ArrPush[16]=$vLangArr[33];
$mosl_lv0114->ArrPush[17]=$vLangArr[46];
$mosl_lv0114->ArrPush[18]=$vLangArr[47];
$mosl_lv0114->ArrPush[19]=$vLangArr[48];
$mosl_lv0114->ArrPush[20]=$vLangArr[49];

$mosl_lv0114->ArrPush[21]=$vLangArr[41]."@01";
$mosl_lv0114->ArrPush[22]=$vLangArr[42];
$mosl_lv0114->ArrPush[23]=$vLangArr[43];
$mosl_lv0114->ArrPush[24]=$vLangArr[44];
$mosl_lv0114->ArrPush[25]=$vLangArr[42];
$mosl_lv0114->ArrPush[26]=$vLangArr[54];
$mosl_lv0114->ArrPush[27]=$vLangArr[55];

$mosl_lv0114->ArrFunc[0]='//Function';
$mosl_lv0114->ArrFunc[1]=$vLangArr[2];
$mosl_lv0114->ArrFunc[2]=$vLangArr[4];
$mosl_lv0114->ArrFunc[3]=$vLangArr[6];
$mosl_lv0114->ArrFunc[4]=$vLangArr[7];
$mosl_lv0114->ArrFunc[5]='';
$mosl_lv0114->ArrFunc[6]='';
$mosl_lv0114->ArrFunc[7]='';
$mosl_lv0114->ArrFunc[8]=$vLangArr[10];
$mosl_lv0114->ArrFunc[9]=$vLangArr[12];
$mosl_lv0114->ArrFunc[10]=$vLangArr[0];
$mosl_lv0114->ArrFunc[11]=$vLangArr[33];
$mosl_lv0114->ArrFunc[12]=$vLangArr[34];
$mosl_lv0114->ArrFunc[13]=$vLangArr[35];
$mosl_lv0114->ArrFunc[14]=$vLangArr[36];
$mosl_lv0114->ArrFunc[15]=$vLangArr[37];

////Other
$mosl_lv0114->ArrOther[1]=$vLangArr[31];
$mosl_lv0114->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="EN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mosl_lv0114->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if($mosl_lv0113->GetRpt()==1)
{
?>
<?php  
	$mosl_lv0113->LV_LoadID($vlv001);
	$mohr_lv0020->LV_LoadID($mosl_lv0113->lv010);
	$mosl_lv0001->LV_LoadID($mosl_lv0113->lv002);
	$mosl_lv0009->LV_LoadID($mosl_lv0113->lv007);
	$vOrderList="1,2,3,5,4,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20";
	if($mosl_lv0113->lv006>0 || $mosl_lv0113->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv011,lv012,lv020";
	//$strDetail=$mosl_lv0114->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0113->lv006);
	$sqlS = "SELECT count(*) Num FROM sl_lv0114 A  WHERE A.lv002='".$mosl_lv0113->lv001."'  and A.lv011>0";
	$bResult = db_query($sqlS);
	$vrow = db_fetch_array ($bResult);
	$vCount=$vrow['Num'];
	?>
<html>
<head>
<title><?php echo $mosl_lv0001->lv002;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
</head>
<body  onkeyup="KeyPublicRun(event)">
<?php
$vslqorder="select distinct IF(ISNULL(lv015),'',trim(lv015)) vorder from sl_lv0114 A where lv002='$vlv001'";
$bResultOrder = db_query($vslqorder);
$vNumRows=db_num_rows($bResultOrder);
while($vroworder = db_fetch_array ($bResultOrder))
{
if(trim($vroworder['vorder'])=="" || strlen(trim($vroworder['vorder']))<=3)
	$mosl_lv0001->LV_LoadID($mosl_lv0113->lv002);
else
{
	$mosl_lv0001->LV_LoadID($vroworder['vorder']);
	if($mosl_lv0001->lv001==NULL)
	{
		$mosl_lv0001->lv001=$vroworder['vorder'];
		$mosl_lv0001->lv002="************";
	}
}
?>
<div ondblclick="this.innerHTML=''">
<table width="280" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><div><center><img src="../../logo.jpg" width="90%"/></center></div></td>
  </tr>	
   <tr>
    <td align="center" onDblClick="this.innerHTML=''">
	<div> 
		<div style="float:left;text-align:center;text-align:left">
		<div style="padding-left:0px;font:12px arial;">
			<div style="float:left;width:50%;padding-top:22px;text-align:left;">
				<strong>
				<?php echo $mosl_lv0114->GetCompany();?>
				</strong>
			</div>
			<div style="float:left;width:50%">
					<div><?php echo ($mosl_lv0113->lv011>0)?"<img style='width:140px' src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0113->lv001."'>":"";?></div>
			
			</div>
		</div>
		<div style="clear:both">
	<br><?php echo $mosl_lv0114->GetAddress();?>
<br><?php echo $vLangArr1[40];?>: <?php echo $mosl_lv0114->GetPhone();?>    
<br><?php echo 'Web';?>: <?php echo $mosl_lv0114->GetWeb();?>    
			
		</div>
		</div>
	</div>

    </div></td>
  </tr>
  <tr>
    <td align="center">
	<br/>
	<font style="font-size:25px;font-weight:bold">PHIẾU THU</font></td>
  </tr>
   <tr>
	

    <td align="center">
		Ngày <?php echo getday($mosl_lv0113->lv004);?> tháng <?php echo getmonth($mosl_lv0113->lv004);?> năm <?php echo getyear($mosl_lv0113->lv004);?>
		
	</td>
		
	</tr>
	<tr>
	<td>
	<br/>
			<table width="100%" style="border:0px;text-align:left;" cellpadding="0" cellspacing="0">
				<tr><td><strong>SỐ HÐ:</strong><?php echo $mosl_lv0113->lv001;?></td><td>&nbsp;</td></tr>
				<tr><td><strong>Giờ vào :</strong> <?php echo substr($mosl_lv0113->lv004,11,8);?></td><td><strong>Giờ ra:</strong> <?php echo substr($mosl_lv0113->lv005,11,8);?></td></tr>
			</table>
	</td>
	</tr>
	<tr>
    <td align="left">
		<strong>Ca:</strong> <?php echo '.........';?> <strong>Nhân viên:</strong> <?php echo $mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002;?> <strong>Mã:</strong> <?php echo $mohr_lv0020->lv001;?>
		</td>
	</tr>
		
<?php
if($mosl_lv0001->lv001==NULL || $mosl_lv0001->lv001=="" || $mosl_lv0001->lv001=='Mã KH')
{
	?>
	<tr>
	<td>
		<strong>Số bàn:</strong> <?php echo $mosl_lv0113->getvaluelink('lv077',$mosl_lv0113->lv007);?>
		
	</td>
  </tr>
<?php	
}
else
{
?>
	<tr>
	<td>
		<strong>KH:</strong><?php echo $mosl_lv0001->lv002;?>   <strong>Mã KH:</strong><?php echo $mosl_lv0001->lv001;?> <strong>Số bàn:</strong> <?php echo $mosl_lv0113->getvaluelink('lv077',$mosl_lv0113->lv007);?>
		
	</td>
  </tr>
  <tr><td><strong> Lũy kế điểm mua hàng hiện tại:<?php $vSum=$mosl_lv0113->LV_GetContractMoneyCustomerDate($mosl_lv0001->lv001,$lvsl_lv0070->lv015,$lvsl_lv0070->lv016)+$mosl_lv0113->LV_GetContractMoneyCustomerDetailDate($mosl_lv0001->lv001,$lvsl_lv0070->lv015,$lvsl_lv0070->lv016);echo $mosl_lv0113->FormatView(round($vSum/$lvsl_lv0070->lv009,0),10);?> điểm</td></tr>
<?php
}
?>  

    
	
  <tr>
    <td align="center"><table align="center" class="lvtable" border="1" cellspacing="0" cellpadding="0">
		<tbody><tr class="lvhtable">
			<td width="1%" class="lvhtable"><?php echo $vLangArr[18];?></td>			
			<td width="" class="lvhtable" style="padding-left:30px;padding-right:30px"><?php echo $vLangArr[21];?></td>
			<td width="" class="lvhtable"><?php echo $vLangArr[22];?> </td>
			<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo $vLangArr[24];?></td>
			<?php 
			if($vCount>0){
			?><td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo 'Giảm giá(%)';?></td>
			<?php
			}
			?>
			<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo 'Thành tiền';?></td>
			<!--<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo 'Ghi chú';?></td>-->
		</tr>
<?php
	$vsumCash=$mosl_lv0113->LV_GetPTMoney($mosl_lv0113->lv001);
	$vorder=1;
	$sqlS1 = "SELECT sum(A.lv004*A.lv006) GiatUi FROM sl_lv0114 A inner join sl_lv0007 B on A.lv003=B.lv001 left join sl_lv0005 C on A.lv005=C.lv001 left join sl_lv0059 D on A.lv009=D.lv001 WHERE B.lv003='Giatui' and A.lv002='".$mosl_lv0113->lv001."' order by A.lv015 asc,A.lv001 asc";
	$bResult1 = db_query($sqlS1);
	$vrow1 = db_fetch_array ($bResult1);
	$vGiatUi=$vrow1['GiatUi'];
	$sqlS = "SELECT A.*,B.lv002 ItemName,C.lv002 UnitName,D.lv002 ProgName FROM sl_lv0114 A inner join sl_lv0007 B on A.lv003=B.lv001 left join sl_lv0005 C on A.lv005=C.lv001 left join sl_lv0059 D on A.lv009=D.lv001 WHERE B.lv003<>'Giatui' and A.lv002='".$mosl_lv0113->lv001."' and trim(A.lv015)='".trim($vroworder['vorder'])."' order by A.lv015 asc,A.lv001 asc";
	$bResult = db_query($sqlS);
	$sumMoney=0;
	$sumScore=0;
	$sumDiscount=0;
	$vVAT=0;
	while ($vrow = db_fetch_array ($bResult)){
	if($vrow['lv004']>0)
	{
		$sumMoney=$sumMoney+$vrow['lv004']*$vrow['lv006'];
		$sumScore=$sumScore+$vrow['lv012'];
		$sumDiscount=$sumDiscount+$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100;	
?>		
		<tr class="lvlinehtable1">
			<td width="1%"><?php echo $vorder;?></td>
			<td align="left"><?php echo $vrow['ItemName'];?></td>
			<td align="right"><?php echo $mosl_lv0114->FormatView($vrow['lv004'],10);?></td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0114->FormatView($vrow['lv006'],10);?></td>
			<?php 
			if($vCount>0){
			?>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0114->FormatView($vrow['lv011'],10);?></td>
			<?php
			}
			?>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><?php echo $mosl_lv0114->FormatView($vrow['lv004']*$vrow['lv006']-$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100,10);?></td>
<!--			<td align="left">&nbsp;<?php echo $vrow['lv010'];?></td>-->
		</tr>
<?php
		$vorder++;
	}
}
?>		
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?5:4;?>">TỔNG TIỀN:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0114->FormatView($sumMoney-$sumDiscount,10);?></strong></td>
		</tr>
		
		
		<?php
			$vCK=0;
			if($mosl_lv0113->lv022>0)
			{
				$vCK=$sumMoney*$mosl_lv0113->lv022/100;
		?>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?5:4;?>">GIẢM GIÁ <?php echo $mosl_lv0114->FormatView($mosl_lv0113->lv022,10);?>%: </td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0114->FormatView($vCK,10);?></strong></td>

		</tr>
		<?php
		}
		?>
		<?php
			if($mosl_lv0113->lv006>0)
			{
				$vVAT=($sumMoney)*$mosl_lv0113->lv006/100;
		?>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?5:4;?>"><?php echo $mosl_lv0114->FormatView($mosl_lv0113->lv006,10);?>% VAT:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0114->FormatView($vVAT,10);?></strong></td>
		</tr>
		<?php
		}
		if((-$vsumCash+$vVAT+$vGiatUi-$vCK)!=0)
		{
		?>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?5:4;?>">TỔNG TIỀN CÒN LẠI:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0114->FormatView($sumMoney-$vsumCash+$vVAT-$sumDiscount+$vGiatUi-$vCK,10);?></strong></td>
		</tr>
		<?php
		}
		if($vNumRows==111)
		{
		?>
		
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?5:4;?>">KHÁCH HÀNG ĐƯA:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0114->FormatView($mosl_lv0113->lv099,10);?></strong></td>
		</tr>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?5:4;?>">TIỀN THỪA:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0114->FormatView($mosl_lv0113->lv099-($sumMoney-$vsumCash+$vVAT-$sumDiscount+$vGiatUi-$vCK),10);?></strong></td>
		</tr>
		<?php
		}
		?>
		<tr ondblclick="this.innerHTML=''">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?7:6;?>">Bằng chữ: <?php echo LNum2Text($sumMoney-$sumDiscount-$vsumCash,$plang);?> </td>
		</tr>
		
		</tbody></table></td>
  </tr>
  <tr>
    <td align="left" ><?php echo $mosl_lv0113->lv013;;?></td>
  </tr>
  <tr>
    <td align="center" >
	<!--
	<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="250">&nbsp;</td>
						<td width="243">&nbsp;</td>
						<td width="217">&nbsp;</td>
						<td width="20">&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center" onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Người giao</b></span></b></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><b><span class="center_style" style="cursor:move"><b>Khách hàng</b></span></b></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="60px"><td colspan="7">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<30; $i++) echo ".";?></td>
						<td>&nbsp;</td>
						<td style="text-align:center"  onDblClick="this.innerHTML=''" style="cursor:move"><?php for($i=0; $i<30; $i++) echo ".";?></td>
						<td>&nbsp;</td>
					</tr>
				</table>-->
				<?php echo $mosl_lv0114->GetCompany();?> – SỐNG TRONG CẢM XÚC<br/>
HẸN GẶP LẠI QUÝ KHÁCH HÀNG



				</td>
  </tr>
</table>
<?php
if($vNumRows>1) echo "<br/><br/><br/><br/>";
?>
</div>
<?php
}
?>

</body>
<script language="javascript">
//window.print()
</script>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
