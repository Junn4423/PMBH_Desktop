<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0262.php");
require_once("../clsall/sl_lv0001.php");
require_once("../clsall/hr_lv0020.php");
require_once("../clsall/sl_lv0070.php");
require_once("../clsall/sl_lv0007.php");
/////////////init object//////////////
$mosl_lv0262=new  sl_lv0262($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0262');
$mosl_lv0070 = new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');	
$mosl_lv0001 = new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');	
$mohr_lv0020 = new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');	
$mosl_lv0007 = new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
/////////////init object//////////////

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0075.txt",$plang);
$mosl_lv0070->LV_Load();
$mosl_lv0262->obj_conf=$mosl_lv0070;
//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$mosl_lv0262->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$mosl_lv0262->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
$mosl_lv0262->StaffID=$_POST['txtStaffID'];
if($mosl_lv0262->StaffID=='')
{
	$mosl_lv0262->StaffID=$mosl_lv0262->LV_UserID;
}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vStrMessage=GetNoDelete($strar,"",$lvMessage);
}
elseif($flagID==2)
{
	$mosl_lv0262->datefrom=$_POST['txtDateFrom'];
	$mosl_lv0262->dateto=$_POST['txtDateTo'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
}
else//last is RptWH
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
}
if($maxRows ==0) $maxRows = 10;
if($mosl_lv0262->datefrom=='' && $mosl_lv0262->dateto=='')
{
	$vNow=GetServerDate();
	$mosl_lv0262->datefrom=$vNow;
	$mosl_lv0262->dateto=$vNow;
}
else
{
	if($mosl_lv0262->datefrom!='') $mosl_lv0262->datefrom=recoverdate($mosl_lv0262->datefrom,$plang);
	if($mosl_lv0262->dateto!='') $mosl_lv0262->dateto=recoverdate($mosl_lv0262->dateto,$plang);
}
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmRpt','document.frmRpt.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<link rel="stylesheet" href="<?php echo $vDir;?>../css/reportstyle.css" type="text/css">
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

<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/pubscript.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	o.txtlv008.value=getChecked(o.chklv008.value,'chklv008');
	o.txtlv011.value=getChecked(o.chklv011.value,'chklv011');
	o.action="sl_lv0262?func=rpt";
	o.submit();
}
function LoadType(to)
	{

		var o=document.frmRpt;
		var vo=o.txtlv004.value;
		switch(vo)
		{
			case 'GMAC':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv005','wh_lv0021','lv003');
				break;
			case 'CUS':
				LoadPopupParent(to,'txtlv005','sl_lv0001','concat(lv002,@!-@!,lv001)');
				break;
		}
	}

function Refresh()
{
	
}
function  phieuchi()
{
	window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMjM0L2FjX2x2MDIzNC5waHA=','_self');
}
function baocaobanhang()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjE0L3NsX2x2MDIxNC5waHA=','_self');
}

function Rpt()
{
	Export(document.frmchoose,'pdf');
}
function Save()
{

	var o=document.frmchoose;
	o.txtFlag.value=2;
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function RptWH(vValue)
{
 	var o=document.frmchoose;
	func=o.func.value;
	o.target="_blank";
	
	o.action="sl_lv0262?func="+func+"&lang=<?php echo $plang;?>&txtDateFrom="+o.txtDateFrom.value+"&txtDateTo="+o.txtDateTo.value;
	o.submit();
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
function  baocaobanhangkhac()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDYxL3NsX2x2MDA2MS5waHA=','_self');
}
//-->
</script>
<div class="hd_cafe">
<ul class="qlycafe" width="100%">
<?php
	require_once("../clsall/sl_lv0214.php");
	$lvsl_lv0214=new sl_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0214->GetView())
	{
		echo '<li><div class="licafe" onclick="baocaobanhang()">BÁO CÁO BÁN HÀNG</div></li>';
	}
	require_once("../clsall/ac_lv0234.php");
	$lvac_lv0234=new ac_lv0234($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvac_lv0234->GetView())
	{
		echo '<li><div class="licafe" onclick="phieuchi()" title="Báo cáo chi">BÁO CÁO CHI</div></li>';
	}
	require_once("../clsall/sl_lv0061.php");
	$lvsl_lv0061=new sl_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0061->GetView())
	{
		echo '<li><div class="licafe" onclick="baocaobanhangkhac()" title="Báo cáo chi">BC BH 2</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>		
	</ul>
</div>	
<?php
if($mosl_lv0262->GetView()==1)
{
?>
	
	<body  onkeyup="KeyPublicRun(event)">

<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
	<div style="clear:both" width="100%"><div id="lvleft">
	<form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
	  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
	  <input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
	  <table style="background:#f2f2f2;font:10px arial">
			<tr>
			<td  height="20px"><?php echo 'Từ';?></td>
			<td  height="20px">
				<input autocomplete="off" style="width:65px;text-align:center;" name="txtDateFrom" type="text" id="txtDateFrom" value="<?php echo $mosl_lv0262->FormatView($mosl_lv0262->datefrom,2);?>" tabindex="2" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" ></td> 
			<td>
			đến
			</td>
			<td  height="20px">
				<input autocomplete="off" style="width:65px;text-align:center;" name="txtDateTo" type="text" id="txtDateTo" value="<?php echo $mosl_lv0262->FormatView($mosl_lv0262->dateto,2);?>" tabindex="2" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" >
			</td> 
			<td>
				Kế toán
			</td>
			<td>
			<table border="0" cellspadding="0" width="">
									<tr>
									<td>
									<select  style="width:65px;text-align:center;" name="txtStaffID" type="text" id="txtStaffID">
									<option value="">...</option>
							  <?php echo $mosl_lv0262->LV_LinkField('lv199',$mosl_lv0262->StaffID);?>
							  </select>
									
									</td>
									</tr>
								</table>								
			</td>
			<td><div style="cursor:pointer;"  class="sanpham_bg_bnt" onclick="Save()">Xem</div></td>
			<td>
				<select name="func" id="func" style="width:60px">
					<option value="rpt">...Kết xuất...</option>
					<option value="excel">Excel</option>
					<option value="word">Word</option>
				</select>
			</td>
			<td><div style="cursor:pointer;"  class="sanpham_bg_bnt" onclick="RptWH()">Báo cáo</div></td>
			</tr>	
		</table>
		<?php
			echo $strDataShow = $mosl_lv0262->PrintInOutPutInStockDetail($plang, $vLangArr,$mosl_lv0262->datefrom,$mosl_lv0262->dateto,$mosl_lv0262->StaffID);
		?>
  </form>
				  
				  </div></div>
				  <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				  </body>			
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[0];?>';	
document.frmRpt.txtlv011.value='';
	
</script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
}
?>