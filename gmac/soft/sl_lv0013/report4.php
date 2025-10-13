<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0013.php");
require_once("../../clsall/sl_lv0014.php");
require_once("../../clsall/sl_lv0001.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/sl_lv0009.php");
require_once("../../clsall/sl_lv0070.php");
//$ma=$_GET['ma'];
$varr=explode("@",$_GET["ID"],2);
$vlv001=$varr[0];
/////////////init object//////////////
$mosl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$mosl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0009');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');
$lvsl_lv0070->LV_Load();
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr1=GetLangFile("../../","SL0074.txt",$plang);
$mosl_lv0013->lang=strtoupper($plang);
$mosl_lv0013->lv001=$vlv001;
$mosl_lv0014->objparent=$mosl_lv0013;
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0013->ArrPush[0]=$vLangArr1[16];
$mosl_lv0013->ArrPush[1]=$vLangArr1[18];
$mosl_lv0013->ArrPush[2]=$vLangArr1[19];
$mosl_lv0013->ArrPush[3]=$vLangArr1[20];
$mosl_lv0013->ArrPush[4]=$vLangArr1[21];
$mosl_lv0013->ArrPush[5]=$vLangArr1[22];
$mosl_lv0013->ArrPush[6]=$vLangArr1[23];
$mosl_lv0013->ArrPush[7]=$vLangArr1[24];
$mosl_lv0013->ArrPush[8]=$vLangArr1[25];
$mosl_lv0013->ArrPush[9]=$vLangArr1[26];
$mosl_lv0013->ArrPush[10]=$vLangArr1[27];
$mosl_lv0013->ArrPush[11]=$vLangArr1[28];
$mosl_lv0013->ArrPush[12]=$vLangArr1[29];
$mosl_lv0013->ArrPush[13]=$vLangArr1[30];
$mosl_lv0013->ArrPush[14]=$vLangArr1[31];	
$vOrderList="1,2,3,4,5,6,7,8,9,10,11,12";
$vFieldList="lv001,lv002,lv004,lv005,lv007,lv010";
//$strParent=$mosl_lv0013->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList);



$mosl_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0023.txt",$plang);
$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mosl_lv0014->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0014->ArrPush[0]=$vLangArr[17];
$mosl_lv0014->ArrPush[1]=$vLangArr[18];
$mosl_lv0014->ArrPush[2]=$vLangArr[19];
$mosl_lv0014->ArrPush[3]=$vLangArr[20];
$mosl_lv0014->ArrPush[4]=$vLangArr[21];
$mosl_lv0014->ArrPush[5]=$vLangArr[22];
$mosl_lv0014->ArrPush[6]=$vLangArr[23];
$mosl_lv0014->ArrPush[7]=$vLangArr[24]."@01";
$mosl_lv0014->ArrPush[8]=$vLangArr[25];
$mosl_lv0014->ArrPush[9]=$vLangArr[26]."(%)";
$mosl_lv0014->ArrPush[10]=$vLangArr[27];
$mosl_lv0014->ArrPush[11]=$vLangArr[28];
$mosl_lv0014->ArrPush[12]=$vLangArr[29]."(%)";
$mosl_lv0014->ArrPush[13]=$vLangArr[30];
$mosl_lv0014->ArrPush[14]=$vLangArr[31];
$mosl_lv0014->ArrPush[15]=$vLangArr[32];
$mosl_lv0014->ArrPush[16]=$vLangArr[33];
$mosl_lv0014->ArrPush[17]=$vLangArr[46];
$mosl_lv0014->ArrPush[18]=$vLangArr[47];
$mosl_lv0014->ArrPush[19]=$vLangArr[48];
$mosl_lv0014->ArrPush[20]=$vLangArr[49];

$mosl_lv0014->ArrPush[21]=$vLangArr[41]."@01";
$mosl_lv0014->ArrPush[22]=$vLangArr[42];
$mosl_lv0014->ArrPush[23]=$vLangArr[43];
$mosl_lv0014->ArrPush[24]=$vLangArr[44];
$mosl_lv0014->ArrPush[25]=$vLangArr[42];
$mosl_lv0014->ArrPush[26]=$vLangArr[54];
$mosl_lv0014->ArrPush[27]=$vLangArr[55];

$mosl_lv0014->ArrFunc[0]='//Function';
$mosl_lv0014->ArrFunc[1]=$vLangArr[2];
$mosl_lv0014->ArrFunc[2]=$vLangArr[4];
$mosl_lv0014->ArrFunc[3]=$vLangArr[6];
$mosl_lv0014->ArrFunc[4]=$vLangArr[7];
$mosl_lv0014->ArrFunc[5]='';
$mosl_lv0014->ArrFunc[6]='';
$mosl_lv0014->ArrFunc[7]='';
$mosl_lv0014->ArrFunc[8]=$vLangArr[10];
$mosl_lv0014->ArrFunc[9]=$vLangArr[12];
$mosl_lv0014->ArrFunc[10]=$vLangArr[0];
$mosl_lv0014->ArrFunc[11]=$vLangArr[33];
$mosl_lv0014->ArrFunc[12]=$vLangArr[34];
$mosl_lv0014->ArrFunc[13]=$vLangArr[35];
$mosl_lv0014->ArrFunc[14]=$vLangArr[36];
$mosl_lv0014->ArrFunc[15]=$vLangArr[37];

////Other
$mosl_lv0014->ArrOther[1]=$vLangArr[31];
$mosl_lv0014->ArrOther[2]=$vLangArr[32];
if($plang=="") $plang="EN";
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];


$mosl_lv0014->lv002=$vlv001;
$vStrMessage="";
?>

<?php
if(1==1)//if($mosl_lv0013->GetRpt()==1)
{
?>
<?php  
	$mosl_lv0013->LV_LoadID($vlv001);
	$mohr_lv0020->LV_LoadID($mosl_lv0013->lv010);
	$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
	$mosl_lv0009->LV_LoadID($mosl_lv0013->lv007);
	$vOrderList="1,2,3,5,4,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20";
	if($mosl_lv0013->lv006>0 || $mosl_lv0013->lv006==-1)
	$vFieldList="lv003,lv004,lv005,lv006";
	else
	$vFieldList="lv003,lv004,lv005,lv006,lv009,lv011,lv012,lv020";
	//$strDetail=$mosl_lv0014->LV_BuilListReportOther($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$mosl_lv0013->lv006);
	$sqlS = "SELECT count(*) Num FROM sl_lv0014 A  WHERE A.lv002='".$mosl_lv0013->lv001."'  and A.lv011>0";
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
<style>
table td
{
	font:12px Arial,Tahoma !important;
}
</style>
</head>
<body  onkeyup="KeyPublicRun(event)">
<?php
$vslqorder="select distinct IF(ISNULL(lv015),'',trim(lv015)) vorder from sl_lv0014 A where lv002='$vlv001'";
$bResultOrder = db_query($vslqorder);
$vNumRows=db_num_rows($bResultOrder);
while($vroworder = db_fetch_array ($bResultOrder))
{
if(trim($vroworder['vorder'])=="" || strlen(trim($vroworder['vorder']))<=3)
	$mosl_lv0001->LV_LoadID($mosl_lv0013->lv002);
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
<table width="150" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right"><div><center><img src="../../logo.jpg" width="90%"/></center></div></td>
  </tr>	
   <tr>
    <td align="center" onDblClick="this.innerHTML=''">
	<div> 
		<div style="float:left;text-align:center;text-align:left">
		<div style="padding-left:0px;font:12px arial;">
			<div>
					<div><?php echo ($mosl_lv0013->lv011>0)?"<img style='width:140px' src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'>":"";?></div>
			
			</div>
		</div>
		<div style="clear:both">
		<strong>
		<span style="font:10px arial,tahoma"><?php echo $mosl_lv0014->GetCompany();?></span>
		</strong>
			
	<br><span style="font:9px arial,tahoma"><?php echo $mosl_lv0014->GetAddress();?></span>
<br><span style="font:10px arial,tahoma"><?php echo 'ĐT:';?>: <?php echo $mosl_lv0014->GetPhone();?>  </span>
<br><span style="font:10px arial,tahoma"><?php echo 'Web';?>: <?php echo $mosl_lv0014->GetWeb();?>   </span> 
			
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
		Ngày: <?php echo getday($mosl_lv0013->lv004);?>/<?php echo getmonth($mosl_lv0013->lv004);?>/<?php echo getyear($mosl_lv0013->lv004);?>
		
	</td>
		
	</tr>
	<tr>
	<td>
	<br/>
			<table width="100%" style="border:0px;text-align:left;" cellpadding="0" cellspacing="0">
				<tr><td><strong>Giờ vào/ra :</strong> <?php echo substr($mosl_lv0013->lv004,11,5);?> / <?php echo substr($mosl_lv0013->lv005,11,5);?></td></tr>
			</table>
	</td>
	</tr>
	<tr>
    <td align="left">
		<strong>Mã:</strong> <?php echo $mohr_lv0020->lv001;?>
				
<?php
if($mosl_lv0001->lv001==NULL || $mosl_lv0001->lv001=="" || $mosl_lv0001->lv001=='Mã KH')
{
	?>
	
		<strong>Số bàn:</strong> <?php echo $mosl_lv0013->getvaluelink('lv077',$mosl_lv0013->lv007);?>
		
	</td>
  </tr>
<?php	
}
else
{
?>
	<tr>
	<td>
		<strong>KH:</strong><?php echo $mosl_lv0001->lv002;?>   <strong>Mã KH:</strong><?php echo $mosl_lv0001->lv001;?> <strong>Số bàn:</strong> <?php echo $mosl_lv0013->getvaluelink('lv077',$mosl_lv0013->lv007);?>
		
	</td>
  </tr>
  <!--
  <tr><td><div style="font:11px Arial,Tahoma;"><strong>Điểm lũy kế:</strong> <?php $vSum=$mosl_lv0013->LV_GetContractMoneyCustomerDate($mosl_lv0001->lv001,$lvsl_lv0070->lv015,$lvsl_lv0070->lv016)+$mosl_lv0013->LV_GetContractMoneyCustomerDetailDate($mosl_lv0001->lv001,$lvsl_lv0070->lv015,$lvsl_lv0070->lv016);$vSumPoint=round($vSum/$lvsl_lv0070->lv009,0); echo $mosl_lv0013->FormatView($vSumPoint,10);?>
  &nbsp;<strong>Đổi voucher:</strong> <?php $vSumVoucher=$mosl_lv0013->LV_GetPointVoucher($mosl_lv0001->lv001,$lvsl_lv0070->lv015,$lvsl_lv0070->lv016); echo $mosl_lv0013->FormatView($vSumVoucher,10);?>
  &nbsp;&nbsp;<strong>Còn lại:</strong> <?php echo $mosl_lv0013->FormatView($vSumPoint-$vSumVoucher,10);?></div>
  </td></tr>-->
<?php
}
?>  

    
	
  <tr>
    <td align="center"><table align="center" border="1" cellspacing="0" cellpadding="0">
		<tbody><tr >
			<td align="center" width="1%" ><strong><?php echo 'S.';?></strong></td>			
			<td align="center" width="" style="padding:2px"><strong><?php echo 'Tên';?><strong></td>
			<td align="center" width="" ><strong><?php echo 'SL';?> </strong></td>
			<!--<td align="center" width="" style="padding:2px"><strong><?php echo 'ĐGiá';?></strong></td>-->
			<?php 
			if($vCount>0){
			?><td align="center" width="" style="padding:2px"><strong><?php echo 'Giảm giá(%)';?></strong></td>
			<?php
			}
			?>
			<td align="center" width="" style="padding:2px"><strong><?php echo 'Th.Tiền';?></strong></td>
			<!--<td width="" class="lvhtable" style="padding-left:5px;padding-right:5px"><?php echo 'Ghi chú';?></td>-->
		</tr>
<?php
	$vsumCash=$mosl_lv0013->LV_GetPTMoney($mosl_lv0013->lv001);
	$vorder=1;
	$sqlS1 = "SELECT sum(A.lv004*A.lv006) GiatUi FROM sl_lv0014 A inner join sl_lv0007 B on A.lv003=B.lv001 left join sl_lv0005 C on A.lv005=C.lv001 left join sl_lv0059 D on A.lv009=D.lv001 WHERE B.lv003='Giatui' and A.lv002='".$mosl_lv0013->lv001."' order by A.lv015 asc,A.lv001 asc";
	$bResult1 = db_query($sqlS1);
	$vrow1 = db_fetch_array ($bResult1);
	$vGiatUi=$vrow1['GiatUi'];
	$sqlS = "SELECT A.*,B.lv002 ItemName,C.lv002 UnitName,D.lv002 ProgName FROM sl_lv0014 A inner join sl_lv0007 B on A.lv003=B.lv001 left join sl_lv0005 C on A.lv005=C.lv001 left join sl_lv0059 D on A.lv009=D.lv001 WHERE B.lv003<>'Giatui' and A.lv002='".$mosl_lv0013->lv001."' and trim(A.lv015)='".trim($vroworder['vorder'])."' order by A.lv015 asc,A.lv001 asc";
	$bResult = db_query($sqlS);
	$sumMoney=0;
	$sumScore=0;
	$sumDiscount=0;
	$vVAT=0;
	while ($vrow = db_fetch_array ($bResult)){
	if($vrow['lv004']>0)
	{
		$sumQty=$sumQty+$vrow['lv004'];
		$sumMoney=$sumMoney+$vrow['lv004']*$vrow['lv006'];
		$sumScore=$sumScore+$vrow['lv012'];
		$sumDiscount=$sumDiscount+$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100;	
?>		
		<tr class="lvlinehtable1">
			<td align="center" width="1%"><?php echo $vorder;?></td>
			<td align="left" style="padding:2px;"><span style="font:11px arial,tahoma"><?php echo $vrow['ItemName'];?></span></td>
			<td align="center"><span style="font:12px arial,tahoma"><?php echo $mosl_lv0014->FormatView($vrow['lv004'],10);?></span></td>
			<!--<td align="right" ><span style="font:10px arial,tahoma"><?php echo $mosl_lv0014->FormatView($vrow['lv006'],10);?></span></td>-->
			<?php 
			if($vCount>0){
			?>
			<td align="right" style="padding:2px;"><?php echo $mosl_lv0014->FormatView($vrow['lv011'],10);?></td>
			<?php
			}
			?>
			<td align="right" style="padding:2px;"><?php echo $mosl_lv0014->FormatView($vrow['lv004']*$vrow['lv006']-$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100,10);?></td>
<!--			<td align="left">&nbsp;<?php echo $vrow['lv010'];?></td>-->
		</tr>
<?php
		$vorder++;
	}
}
?>		
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" style="padding:5px;" colspan="<?php echo ($vCount>0)?3:2;?>"><strong>TỔNG TIỀN:</strong></td>
			<td align="center" style="font-size:14px" ><strong><?php echo $mosl_lv0014->FormatView($sumQty,10);?></strong></td>
			<td align="right" style="font-size:14px" ><strong><?php echo $mosl_lv0014->FormatView($sumMoney-$sumDiscount,10);?></strong></td>
		</tr>
		
		
		<?php
			$vCK=0;
			if($mosl_lv0013->lv022>0 || $sumDiscount>0)
			{
				if($sumDiscount>0)
					$vCK=$sumDiscount;
				else
					$vCK=$sumMoney*$mosl_lv0013->lv022/100;
		?>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?4:3;?>">BẠN ĐÃ TIẾT KIỆM <?php echo ($sumDiscount>0)?'':$mosl_lv0014->FormatView($mosl_lv0013->lv022,10).'%';?>: </td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0014->FormatView($vCK,10);?></strong></td>

		</tr>
		<?php
		}
		?>
		<?php
			if($mosl_lv0013->lv006>0)
			{
				$vVAT=($sumMoney)*$mosl_lv0013->lv006/100;
		?>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?4:3;?>"><?php echo $mosl_lv0014->FormatView($mosl_lv0013->lv006,10);?>% VAT:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0014->FormatView($vVAT,10);?></strong></td>
		</tr>
		<?php
		}
		if((-$vsumCash+$vVAT+$vGiatUi-$vCK)!=0 && $mosl_lv0013->lv022>0)
		{
		?>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?4:3;?>">TỔNG TIỀN CÒN LẠI:</td>
			
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0014->FormatView($sumMoney-$vsumCash+$vVAT-$sumDiscount+$vGiatUi-$vCK,10);?></strong></td>
		</tr>
		<?php
		}
		if($vNumRows==111)
		{
		?>
		
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?4:3;?>">KHÁCH HÀNG ĐƯA:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0014->FormatView($mosl_lv0013->lv099,10);?></strong></td>
		</tr>
		<tr class="lvlinehtable1">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?4:3;?>">TIỀN THỪA:</td>
			<td align="right" style="padding:2px;padding-right:5px;padding-left:5px;font-size:14px"><strong><?php echo $mosl_lv0014->FormatView($mosl_lv0013->lv099-($sumMoney-$vsumCash+$vVAT-$sumDiscount+$vGiatUi-$vCK),10);?></strong></td>
		</tr>
		<?php
		}
		?>
		<tr ondblclick="this.innerHTML=''">
			<td class="lvlineboldtable" colspan="<?php echo ($vCount>0)?7:6;?>" style="padding:2px;"><?php echo LNum2Text($sumMoney-$sumDiscount-$vsumCash,$plang);?> </td>
		</tr>
		
		</tbody></table></td>
  </tr>
  <tr>
    <td align="left" ><?php echo $mosl_lv0013->lv013;;?></td>
  </tr>
  <tr>
    <td align="center" style="padding:2px;" >
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
				<?php echo $mosl_lv0014->GetCompany();?><br/>
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
window.print()
</script>
</html>					
<?php
} else {
	include("../permit.php");
}
?>
