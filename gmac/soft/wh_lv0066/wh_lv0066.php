<?php
if($_GET['ChildID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/wh_lv0066.php");

/////////////init object//////////////
$mowh_lv0066=new wh_lv0066($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0066');
$mowh_lv0066->Dir=$vDir;
$pSaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0029.txt",$plang);
$mowh_lv0066->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0066->ArrPush[0]=$vLangArr[17];
$mowh_lv0066->ArrPush[1]=$vLangArr[18];
$mowh_lv0066->ArrPush[2]=$vLangArr[19];
$mowh_lv0066->ArrPush[3]=$vLangArr[20];
$mowh_lv0066->ArrPush[4]=$vLangArr[21];
$mowh_lv0066->ArrPush[5]=$vLangArr[22];
$mowh_lv0066->ArrPush[6]=$vLangArr[23];
$mowh_lv0066->ArrPush[7]=$vLangArr[24];
$mowh_lv0066->ArrPush[8]=$vLangArr[25];
$mowh_lv0066->ArrPush[9]=$vLangArr[26];
$mowh_lv0066->ArrPush[10]=$vLangArr[27];
$mowh_lv0066->ArrPush[11]=$vLangArr[28];
$mowh_lv0066->ArrPush[12]=$vLangArr[29];
$mowh_lv0066->ArrPush[13]=$vLangArr[30];
$mowh_lv0066->ArrPush[14]=$vLangArr[31];
$mowh_lv0066->ArrPush[15]=$vLangArr[32];
$mowh_lv0066->ArrPush[16]=$vLangArr[33];
$mowh_lv0066->ArrPush[18]=$vLangArr[41];
$mowh_lv0066->ArrPush[19]=$vLangArr[42];
$mowh_lv0066->ArrPush[20]=$vLangArr[43];
$mowh_lv0066->ArrPush[21]=$vLangArr[44];
$mowh_lv0066->ArrPush[22]=$vLangArr[45];
$mowh_lv0066->ArrPush[23]=$vLangArr[46];
$mowh_lv0066->ArrPush[24]=$vLangArr[47];
$mowh_lv0066->ArrPush[25]=$vLangArr[48];
$mowh_lv0066->ArrPush[26]=$vLangArr[49];
$mowh_lv0066->ArrPush[25]='Thành tiền';
$mowh_lv0066->ArrPush[905]='Ngày đơn hàng';
$mowh_lv0066->ArrPush[995]='Giờ vào';
$mowh_lv0066->ArrPush[996]='Giờ ra';


$mowh_lv0066->ArrFunc[0]='//Function';
$mowh_lv0066->ArrFunc[1]=$vLangArr[2];
$mowh_lv0066->ArrFunc[2]=$vLangArr[4];
$mowh_lv0066->ArrFunc[3]=$vLangArr[6];
$mowh_lv0066->ArrFunc[4]=$vLangArr[7];
$mowh_lv0066->ArrFunc[5]='';
$mowh_lv0066->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mowh_lv0066->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mowh_lv0066->ArrFunc[8]=$vLangArr[10];
$mowh_lv0066->ArrFunc[9]=$vLangArr[12];
$mowh_lv0066->ArrFunc[10]=$vLangArr[0];
$mowh_lv0066->ArrFunc[11]=$vLangArr[36];
$mowh_lv0066->ArrFunc[12]=$vLangArr[37];
$mowh_lv0066->ArrFunc[13]=$vLangArr[38];
$mowh_lv0066->ArrFunc[14]=$vLangArr[39];
$mowh_lv0066->ArrFunc[15]=$vLangArr[40];

////Other
$mowh_lv0066->ArrOther[1]=$vLangArr[34];
$mowh_lv0066->ArrOther[2]=$vLangArr[35];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mowh_lv0066->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"wh_lv0066",$lvMessage);
}
elseif($flagID==2)
{
$mowh_lv0066->lv001=$_POST['txtlv001'];
if($_GET['ChildID']=="")
 $mowh_lv0066->lv002=$_POST['txtlv002'];
else
$mowh_lv0066->lv002=$_GET['ChildID'];
$mowh_lv0066->lv003=$_POST['txtlv003'];
$mowh_lv0066->lv004=$_POST['txtlv004'];
$mowh_lv0066->lv005=$_POST['txtlv005'];
$mowh_lv0066->lv006=$_POST['txtlv006'];
$mowh_lv0066->lv007=$_POST['txtlv007'];
$mowh_lv0066->lv008=$_POST['txtlv008'];
$mowh_lv0066->lv009=$_POST['txtlv009'];
$mowh_lv0066->lv010=$_POST['txtlv010'];
$mowh_lv0066->lv011=$_POST['txtlv011'];
$mowh_lv0066->lv012=$_POST['txtlv012'];
$mowh_lv0066->datefrom=$_POST['txtDateFrom'];
$mowh_lv0066->dateto=$_POST['txtDateTo'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mowh_lv0066->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mowh_lv0066->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0066->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0066');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0066->ListView;
$curPage = $mowh_lv0066->CurPage;
$maxRows =$mowh_lv0066->MaxRows;
$vOrderList=$mowh_lv0066->ListOrder;
$vSortNum=$mowh_lv0066->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mowh_lv0066->SaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0066',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($mowh_lv0066->datefrom=='' && $mowh_lv0066->dateto=='')
{
	$vNow=GetServerDate();
	$mowh_lv0066->datefrom=$vNow;
	$mowh_lv0066->dateto=$vNow;
}
else
{
	if($mowh_lv0066->datefrom!='') $mowh_lv0066->datefrom=recoverdate($mowh_lv0066->datefrom,$plang);
	if($mowh_lv0066->dateto!='') $mowh_lv0066->dateto=recoverdate($mowh_lv0066->dateto,$plang);
}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0066->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/pubscript.js"></script>
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
</head>
<script language="JavaScript" type="text/javascript">
<!--
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function Add()
{

RunFunction('','add');
}
function Edt()
{
	lv_chk_list(document.frmchoose,'lvChk',2);
}
function Edit(vValue)
{
	RunFunction(vValue,'edit');
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>','filter');
}
function Del()
{
	lv_chk_list(document.frmchoose,'lvChk',3);
}
function Delete(vValue)
{
 	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=1;
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=650 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>wh_lv0066/?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	o.target="_self";
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.target="_self";
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=2;
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	o.submit();
}
function  phieuchi()
{
	window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMjMzL2FjX2x2MDIzMy5waHA=','_self');
}
function baocaotong()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjYxL3NsX2x2MDI2MS5waHA=','_self');
}
function Rpt()
{
	Export(document.frmchoose,'pdf');
}
function RptWH(vValue)
{
 	var o=document.frmchoose;
	func=o.func.value;
	o.target="_blank";
	o.action="wh_lv0066?childdetailfunc="+func+"&lang=<?php echo $plang;?>&datefrom="+o.txtDateFrom.value+"&dateto="+o.txtDateTo.value+"&optrpt="+o.optrpt.value;
	o.submit();
	o.target="";
}
function nhapkho()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAyL3doX2x2MDEwMi5waHA=','_self');
	}
	function  kiemkho()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAzL3doX2x2MDEwMy5waHA=','_self');
	}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
//-->
</script>
<?php
if($mowh_lv0066->GetView()==1)
{
?>
<div class="hd_cafe">
	<ul class="qlycafe">
	<?php
	require_once("../clsall/wh_lv0008.php");
	$lvwh_lv0008=new wh_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0102');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvwh_lv0008->GetView())
	{
		echo '<li><div class="licafe" onclick="nhapkho()">NHẬP KHO</div></li>';
	}
	require_once("../clsall/wh_lv0004.php");
	$lvwh_lv0004=new wh_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0103');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvwh_lv0004->GetView())
	{
		echo '<li><div class="licafe" onclick="kiemkho()">KIỂM KHO</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>		
	</ul>
</div>
<body  onkeyup="KeyPublicRun(event)">

			
<?php

	if($plang=="EN")
			{	
	$vStrTableMin='<table class="lvtable" border="1" align="center">
	<tr class="lvhtable"><td>Order</td><td>ItemID</td><td>Item Name</td><td>WarehouseID</td><td>Min Banlace</td><td>Banlace</td></tr>
	@01
	</table>';
	$vStrTableMax='<table border="1" class="lvtable">
	<tr class="lvhtable"><td>Order</td><td>ItemID</td><td>Item Name</td><td>WarehouseID</td><td>Max Banlace</td><td>Banlace</td></tr>
	@01
	</table>';
	}
	else
	{
		$vStrTableMin='<table class="lvtable"  align="center">
	<tr class="lvhtable"><td>STT</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Kho</td><td>Số lượng min</td><td>Số lượng hiện tại</td></tr>
	@01
	</table>';
	$vStrTableMax='<table  class="lvtable">
	<tr class="lvhtable"><td>STT</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Kho</td><td>Số lượng max</td><td>Số lượng hiện tại</td></tr>
	@01
	</table>';
	}	
	$vCount=0;
	
	$slq="select A.*,(select sum(lv004) from wh_lv0012 BB where BB.lv002=A.lv001 and BB.lv003=A.lv016) Banlance from sl_lv0007 A";
	$str_min="";
	$str_max="";
	$alarmmax=false;
	$alarmmin=false;
	$str_td="<tr class='@#00'><td>@#01</td><td>@#02</td><td>@#03</td><td>@#04</td><td  align='right'><strong>@#05</strong></td><td align='right'><strong>@#06</strong></td></tr>";
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
		$tmpstr_td=str_replace("@#01",$vCount,$str_td);
		$tmpstr_td=str_replace("@#02",$vrow['lv001'],$tmpstr_td);
		$tmpstr_td=str_replace("@#03",$vrow['lv002'],$tmpstr_td);
		$tmpstr_td=str_replace("@#04",$vrow['lv016'],$tmpstr_td);

		$tmpstr_td=str_replace("@#06",$mowh_lv0066->FormatView($vrow['Banlance'],10),$tmpstr_td);
		if($vrow['lv018']>0)
		{
			if($vrow['lv018']>$vrow['Banlance'])
			{
				$alarmmin=true;
				$tmpstr_td=str_replace("@#05",$mowh_lv0066->FormatView($vrow['lv018'],10),$tmpstr_td);
				$str_min=$str_min.$tmpstr_td;
			}
		}
		if($vrow['lv019']>0)
		{
			if($vrow['lv019']<$vrow['Banlance'])
			{
				$alarmmax=true;
				$tmpstr_td=str_replace("@#05",$mowh_lv0066->FormatView($vrow['lv019'],10),$tmpstr_td);
				$str_max=$str_max.$tmpstr_td;
			}
		}
	}
?>
<div><hr></div>
<div id="alert_contact_30">
	<div id="alert_contact_header" style="padding:4px"><strong>
	<?php 
		   if($plang=="EN")
			{	
			 echo 'LIST MIN-MAX BALANCE ALARM ('.$vCount.")";
			}
		   else
		   {
		   	 echo 'DANH SÁCH CÁC SẢN PHẨM DƯỚI VÀ TRÊN ĐỊNH MỨC('.$vCount.")";
		   }	
		   ?>
	</strong>
	</div>
	<div>
	<?php
		
		if($alarmmin) echo str_replace("@01",$str_min,$vStrTableMin)."<br/>";
		if($alarmmax)  echo str_replace("@01",$str_max,$vStrTableMax);
	?>
	</div>
</div>
<?php 

?>				  
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mowh_lv0066->ArrPush[0];?>';	
</script>
</html>