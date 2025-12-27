<?php
if($_GET['ChildID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0214.php");
require_once("$vDir../clsall/sl_lv0013.php");

/////////////init object//////////////
$mosl_lv0214=new sl_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0214');

$mosl_lv0214->Dir=$vDir;
$pSaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0029.txt",$plang);
$mosl_lv0214->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0214->ArrPush[0]=$vLangArr[17];
$mosl_lv0214->ArrPush[1]=$vLangArr[18];
$mosl_lv0214->ArrPush[2]=$vLangArr[19];
$mosl_lv0214->ArrPush[3]=$vLangArr[20];
$mosl_lv0214->ArrPush[4]=$vLangArr[21];
$mosl_lv0214->ArrPush[5]=$vLangArr[22];
$mosl_lv0214->ArrPush[6]=$vLangArr[23];
$mosl_lv0214->ArrPush[7]=$vLangArr[24];
$mosl_lv0214->ArrPush[8]=$vLangArr[25];
$mosl_lv0214->ArrPush[9]=$vLangArr[26];
$mosl_lv0214->ArrPush[10]=$vLangArr[27];
$mosl_lv0214->ArrPush[11]=$vLangArr[28];
$mosl_lv0214->ArrPush[12]=$vLangArr[29];
$mosl_lv0214->ArrPush[13]=$vLangArr[30];
$mosl_lv0214->ArrPush[14]=$vLangArr[31];
$mosl_lv0214->ArrPush[15]=$vLangArr[32];
$mosl_lv0214->ArrPush[16]=$vLangArr[33];
$mosl_lv0214->ArrPush[18]=$vLangArr[41];
$mosl_lv0214->ArrPush[19]=$vLangArr[42];
$mosl_lv0214->ArrPush[20]=$vLangArr[43];
$mosl_lv0214->ArrPush[21]=$vLangArr[44];
$mosl_lv0214->ArrPush[22]=$vLangArr[45];
$mosl_lv0214->ArrPush[23]=$vLangArr[46];
$mosl_lv0214->ArrPush[24]=$vLangArr[47];
$mosl_lv0214->ArrPush[25]=$vLangArr[48];
$mosl_lv0214->ArrPush[26]=$vLangArr[49];
$mosl_lv0214->ArrPush[25]='Thành tiền';
$mosl_lv0214->ArrPush[905]='Ngày đơn hàng';
$mosl_lv0214->ArrPush[995]='Giờ vào';
$mosl_lv0214->ArrPush[996]='Giờ ra';


$mosl_lv0214->ArrFunc[0]='//Function';
$mosl_lv0214->ArrFunc[1]=$vLangArr[2];
$mosl_lv0214->ArrFunc[2]=$vLangArr[4];
$mosl_lv0214->ArrFunc[3]=$vLangArr[6];
$mosl_lv0214->ArrFunc[4]=$vLangArr[7];
$mosl_lv0214->ArrFunc[5]='';
$mosl_lv0214->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0214->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0214->ArrFunc[8]=$vLangArr[10];
$mosl_lv0214->ArrFunc[9]=$vLangArr[12];
$mosl_lv0214->ArrFunc[10]=$vLangArr[0];
$mosl_lv0214->ArrFunc[11]=$vLangArr[36];
$mosl_lv0214->ArrFunc[12]=$vLangArr[37];
$mosl_lv0214->ArrFunc[13]=$vLangArr[38];
$mosl_lv0214->ArrFunc[14]=$vLangArr[39];
$mosl_lv0214->ArrFunc[15]=$vLangArr[40];

////Other
$mosl_lv0214->ArrOther[1]=$vLangArr[34];
$mosl_lv0214->ArrOther[2]=$vLangArr[35];
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
if(isset($_POST['optrpt']))
{
	$mosl_lv0214->optrpt=$_POST['optrpt'];
}
else
{
 	$mosl_lv0214->optrpt=1;
}

if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0214->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0214",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0214->lv001=$_POST['txtlv001'];
if($_GET['ChildID']=="")
 $mosl_lv0214->lv002=$_POST['txtlv002'];
else
$mosl_lv0214->lv002=$_GET['ChildID'];
$mosl_lv0214->lv003=$_POST['txtlv003'];
$mosl_lv0214->lv004=$_POST['txtlv004'];
$mosl_lv0214->lv005=$_POST['txtlv005'];
$mosl_lv0214->lv006=$_POST['txtlv006'];
$mosl_lv0214->lv007=$_POST['txtlv007'];
$mosl_lv0214->lv008=$_POST['txtlv008'];
$mosl_lv0214->lv009=$_POST['txtlv009'];
$mosl_lv0214->lv010=$_POST['txtlv010'];
$mosl_lv0214->lv011=$_POST['txtlv011'];
$mosl_lv0214->lv012=$_POST['txtlv012'];
$mosl_lv0214->datefrom=$_POST['txtDateFrom'];
$mosl_lv0214->dateto=$_POST['txtDateTo'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0214->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0214->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0214->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0214');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0214->ListView;
$curPage = $mosl_lv0214->CurPage;
$maxRows =$mosl_lv0214->MaxRows;
$vOrderList=$mosl_lv0214->ListOrder;
$vSortNum=$mosl_lv0214->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0214->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0214',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($mosl_lv0214->datefrom=='' && $mosl_lv0214->dateto=='')
{
	$vNow=GetServerDate();
	$mosl_lv0214->datefrom=$vNow;
	$mosl_lv0214->dateto=$vNow;
}
else
{
	if($mosl_lv0214->datefrom!='') $mosl_lv0214->datefrom=recoverdate($mosl_lv0214->datefrom,$plang);
	if($mosl_lv0214->dateto!='') $mosl_lv0214->dateto=recoverdate($mosl_lv0214->dateto,$plang);
}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0214->GetCount();
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
	var str="<br><iframe id='lvframefrm' height=650 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0214/?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMjM0L2FjX2x2MDIzNC5waHA=','_self');
}
function  baocaobanhangkhac()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDYxL3NsX2x2MDA2MS5waHA=','_self');
}
function baocaotong()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjYxL3NsX2x2MDI2MS5waHA=','_self');
}
function baocaogiaoca()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjYyL3NsX2x2MDI2Mi5waHA=','_self');
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
	o.action="sl_lv0214?childdetailfunc="+func+"&lang=<?php echo $plang;?>&datefrom="+o.txtDateFrom.value+"&dateto="+o.txtDateTo.value+"&optrpt="+o.optrpt.value;
	o.submit();
	o.target="";
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
//-->
</script>
<div class="hd_cafe">
	<ul class="qlycafe">
	<?php
	require_once("../clsall/ac_lv0234.php");
	$lvac_lv0234=new ac_lv0234($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvac_lv0234->GetView())
	{
		echo '<li><div class="licafe" onclick="phieuchi()" title="Báo cáo chi">BÁO CÁO CHI</div></li>';
	}
	require_once("../clsall/sl_lv0262.php");
	$lvsl_lv0262=new sl_lv0262($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0262');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0262->GetView())
	{
		echo '<li><div class="licafe" onclick="baocaogiaoca()">BC GIAO CA</div></li>';
	}
	require_once("../clsall/sl_lv0261.php");
	$lvsl_lv0261=new sl_lv0261($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0261');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0261->GetView())
	{
		echo '<li><div class="licafe" onclick="baocaotong()">BÁO CÁO TỔNG</div></li>';
	}
	require_once("../clsall/sl_lv0061.php");
	$lvsl_lv0061=new sl_lv0061($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0061');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0061->GetView())
	{
		echo '<li><div class="licafe" onclick="baocaobanhangkhac()" title="Báo cáo chi">BC BH 2</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>		
	</ul>
</div>
<?php
if($mosl_lv0214->GetView()==1)
{
?>

<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					<input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
	  				<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
					  <table style="background:#f2f2f2;font:10px arial">
							<tr>
							<td  height="20px"><?php echo 'Từ';?></td>
							<td  height="20px">
								<input style="width:65px;text-align:center;" name="txtDateFrom" type="text" id="txtDateFrom" value="<?php echo $mosl_lv0214->FormatView($mosl_lv0214->datefrom,2);?>" tabindex="2" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" ></td> 
							<td>
							đến
							</td>
							<td  height="20px"><input style="width:65px;text-align:center;" name="txtDateTo" type="text" id="txtDateTo" value="<?php echo $mosl_lv0214->FormatView($mosl_lv0214->dateto,2);?>" tabindex="2" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" ></td> 
							<td>
								<select name="optrpt" id="optrpt" style="width:60px;" onchange="Save()">
									<option <?php echo ('0'==$mosl_lv0214->optrpt)?'selected="selected"':'';?> value="0">BC chi tiết</option>
									<option <?php echo ('1'==$mosl_lv0214->optrpt)?'selected="selected"':'';?> value="1">BC theo nhóm theo sản phẩm</option>
									<option <?php echo ('2'==$mosl_lv0214->optrpt)?'selected="selected"':'';?> value="2">BC loại nhóm</option>
									<option <?php echo ('3'==$mosl_lv0214->optrpt)?'selected="selected"':'';?> value="3">BC nhân viên PV</option>
									<option <?php echo ('13'==$mosl_lv0214->optrpt)?'selected="selected"':'';?> value="13">BC nhân viên Kế Toán</option>
									<option <?php echo ('4'==$mosl_lv0214->optrpt)?'selected="selected"':'';?> value="4">BC khách hàng</option>
								</select>
							</td>
							<td>
								<select name="func" id="func" style="width:60px;">
									<option value="rpt">...Kết xuất...</option>
									<option value="excel">Excel</option>
									<option value="word">Word</option>
								</select>
							</td>
							<td><div style="cursor:pointer;"  class="sanpham_bg_bnt" onclick="RptWH()">Báo cáo</div></td>
							</tr>	
						</table>
						<?php
						$vOpt=$mosl_lv0214->optrpt;
						echo $strDataShow = $mosl_lv0214->PrintInOutPutInStockDetail($plang, $vLangArr,$mosl_lv0214->datefrom,$mosl_lv0214->dateto,$vOpt);
		?>
		</form>
				  
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0214->ArrPush[0];?>';	
</script>
</html>