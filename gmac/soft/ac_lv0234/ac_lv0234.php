<?php
if($_GET['ID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ac_lv0234.php");

/////////////init object//////////////
$moac_lv0234=new ac_lv0234($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
$moac_lv0234->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","AC0024.txt",$plang);
$moac_lv0234->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0234->ArrPush[0]=$vLangArr[17];
$moac_lv0234->ArrPush[1]=$vLangArr[18];
$moac_lv0234->ArrPush[2]=$vLangArr[19];
$moac_lv0234->ArrPush[3]=$vLangArr[20];
$moac_lv0234->ArrPush[4]=$vLangArr[21];
$moac_lv0234->ArrPush[5]=$vLangArr[22];
$moac_lv0234->ArrPush[6]=$vLangArr[23];
$moac_lv0234->ArrPush[7]=$vLangArr[24];
$moac_lv0234->ArrPush[8]=$vLangArr[25];
$moac_lv0234->ArrPush[9]=$vLangArr[26];
$moac_lv0234->ArrPush[10]=$vLangArr[27];
$moac_lv0234->ArrPush[11]=$vLangArr[28];
$moac_lv0234->ArrPush[12]=$vLangArr[29];
$moac_lv0234->ArrPush[13]=$vLangArr[30];
$moac_lv0234->ArrPush[14]=$vLangArr[31];
$moac_lv0234->ArrPush[15]=$vLangArr[32];
$moac_lv0234->ArrPush[16]=$vLangArr[33];
$moac_lv0234->ArrPush[17]=$vLangArr[34];

$moac_lv0234->ArrPush[10]='Ngày chi';

$moac_lv0234->ArrFunc[0]='//Function';
$moac_lv0234->ArrFunc[1]=$vLangArr[2];
$moac_lv0234->ArrFunc[2]=$vLangArr[4];
$moac_lv0234->ArrFunc[3]=$vLangArr[6];
$moac_lv0234->ArrFunc[4]=$vLangArr[7];
$moac_lv0234->ArrFunc[5]='';
$moac_lv0234->ArrFunc[6]='';
$moac_lv0234->ArrFunc[7]='';
$moac_lv0234->ArrFunc[8]=$vLangArr[10];
$moac_lv0234->ArrFunc[9]=$vLangArr[12];
$moac_lv0234->ArrFunc[10]=$vLangArr[0];
$moac_lv0234->ArrFunc[11]=$vLangArr[28];
$moac_lv0234->ArrFunc[12]=$vLangArr[29];
$moac_lv0234->ArrFunc[13]=$vLangArr[30];
$moac_lv0234->ArrFunc[14]=$vLangArr[31];
$moac_lv0234->ArrFunc[15]=$vLangArr[32];

////Other
$moac_lv0234->ArrOther[1]=$vLangArr[26];
$moac_lv0234->ArrOther[2]=$vLangArr[27];
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
if(isset($_POST['txtStaffID']))
{
	$moac_lv0234->StaffID=$_POST['txtStaffID'];
}
else
{
	$moac_lv0234->StaffID=$moac_lv0234->LV_UserID;
}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moac_lv0234->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ac_lv0234",$lvMessage);
}
elseif($flagID==2)
{
	$moac_lv0234->lv001=$_POST['txtlv001'];
	$moac_lv0234->lv002=$_GET['ID'];
	$moac_lv0234->lv003=$_POST['txtlv003'];
	$moac_lv0234->lv004=$_POST['txtlv004'];
	$moac_lv0234->lv005=$_POST['txtlv005'];
	$moac_lv0234->lv006=$_POST['txtlv006'];
	$moac_lv0234->lv007=$_POST['txtlv007'];
	$moac_lv0234->lv008=$_POST['txtlv008'];
	$moac_lv0234->lv009=$_POST['txtlv009'];
	$moac_lv0234->lv010=$_POST['txtlv010'];
	$moac_lv0234->lv011=$_POST['txtlv011'];
	$moac_lv0234->lv012=$_POST['txtlv012'];
	$moac_lv0234->datefrom=$_POST['txtDateFrom'];
	$moac_lv0234->dateto=$_POST['txtDateTo'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0234->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0234');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moac_lv0234->ListView;
$curPage = $moac_lv0234->CurPage;
$maxRows =$moac_lv0234->MaxRows;
$vOrderList=$moac_lv0234->ListOrder;
$vSortNum=$moac_lv0234->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moac_lv0234->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0234',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}

if($moac_lv0234->datefrom=='' && $moac_lv0234->dateto=='')
{
	$vNow=GetServerDate();
	$moac_lv0234->datefrom=$vNow;
	$moac_lv0234->dateto=$vNow;
}
else
{
	if($moac_lv0234->datefrom!='') $moac_lv0234->datefrom=recoverdate($moac_lv0234->datefrom,$plang);
	if($moac_lv0234->dateto!='') $moac_lv0234->dateto=recoverdate($moac_lv0234->dateto,$plang);
}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0234->GetCount();
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
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">	
<link rel="stylesheet" href="<?php echo $vDir;?>../css/reportstyle.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/pubscript.js"></script>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>','filter');
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
function Rpt()
{
	Export(document.frmchoose,'pdf');
}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>ac_lv0234?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function  baocaobanhang()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjE0L3NsX2x2MDIxNC5waHA=','_self');
}
function  sanpham()
{
	window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=c2xfbHYwMDA3L3NsX2x2MDAwNy5waHA=','_self');
}
function  baocaosoquy()
{
	window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMTAzL2FjX2x2MDEwMy5waHA=','_self');
}
function nhapchi()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=YWNfbHYwMjc1L2FjX2x2MDI3NS5waHA=','_self');
}
function baocaotong()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjYxL3NsX2x2MDI2MS5waHA=','_self');
}
function  baocaobanhangkhac()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDYxL3NsX2x2MDA2MS5waHA=','_self');
}
function nhapkho()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAyL3doX2x2MDEwMi5waHA=','_self');
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
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
	o.action="ac_lv0234?childdetailfunc="+func+"&lang=<?php echo $plang;?>&datefrom="+o.txtDateFrom.value+"&dateto="+o.txtDateTo.value+"&optrpt="+o.optrpt.value;
	o.submit();
}
//-->
</script>

<div class="hd_cafe">
	<ul class="qlycafe">
	<?php
	require_once("../clsall/sl_lv0214.php");
	$lvsl_lv0214=new sl_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0214->GetView())
	{
		echo '<li><div class="licafe" onclick="baocaobanhang()">BÁO CÁO BÁN HÀNG</div></li>';
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
if($moac_lv0234->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
						<table style="background:#f2f2f2;font:10px arial">
							<tr>
							<td  height="20px"><?php echo 'Từ';?></td>
							<td  height="20px">
								<input style="width:35px;text-align:center;" name="txtDateFrom" type="text" id="txtDateFrom" value="<?php echo $moac_lv0234->FormatView($moac_lv0234->datefrom,2);?>" tabindex="2" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" ></td> 
							<td>
							đến
							</td>
							<td  height="20px"><input style="width:35px;text-align:center;" name="txtDateTo" type="text" id="txtDateTo" value="<?php echo $moac_lv0234->FormatView($moac_lv0234->dateto,2);?>" tabindex="2" style="width:100%" onKeyPress="return CheckKey(event,7)" onClick="if(self.gfPop)gfPop.fPopCalendar(this);return false;" ></td> 
							<td>
								Kế toán
							</td>
							<td>
							<table border="0" cellspadding="0" width="">
													<tr>
													<td>
													<select  style="width:65px;text-align:center;" name="txtStaffID" type="text" id="txtStaffID">
													<option value="">...</option>
											<?php echo $moac_lv0234->LV_LinkField('lv199',$moac_lv0234->StaffID);?>
											</select>
													
													</td>
													</tr>
												</table>								
							</td>
							<td>
								<select style="width:45px;" type="textbox" name="txtlv005" id="txtlv005"  onKeyPress="return CheckKey(event,7)">
									<option value="">Chọn loại chi</option>
									 <?php echo $moac_lv0234->LV_LinkField('lv005',$moac_lv0234->lv005);?>
								</select>
							</td>
							<td>
								<select name="optrpt" id="optrpt" style="width:60px;" onchange="Save()">
									<option <?php echo ($_POST['optrpt']==0)?'selected="selected"':'';?> value="0">Cả hai</option>
									<option <?php echo ($_POST['optrpt']==1)?'selected="selected"':'';?> value="1">Chi khác</option>
									<option <?php echo ($_POST['optrpt']==2)?'selected="selected"':'';?> value="2">Chi mua hàng</option>
								</select>
							</td>
							<td><div style="cursor:pointer;"  class="sanpham_bg_bnt" onclick="Save()">Xem</div></td>
							<td>
								<select name="func" id="func" style="width:30px;">
									<option value="rpt">...Kết xuất...</option>
									<option value="excel">Excel</option>
									<option value="word">Word</option>
								</select>
							</td>
							<td><div style="cursor:pointer;"  class="sanpham_bg_bnt" onclick="RptWH()">Báo cáo</div></td>
							</tr>	
						</table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<?php 
						$vOpt=$_POST['optrpt'];

						echo $moac_lv0234->PrintInOutPutInStockDetail($plang, $vLangArr,$moac_lv0234->datefrom,$moac_lv0234->dateto,$vOpt,$moac_lv0234->StaffID);
						?>
					

				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  <input type="hidden" name="txtDateFrom" id="txtDateFrom"  value="<?php echo $moac_lv0234->datefrom;?>"/>
						<input type="hidden" name="txtDateTo" id="txtDateTo" value="<?php echo $moac_lv0234->dateto;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moac_lv0234->lv005;?>"/>
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
div.innerHTML='<?php echo $moac_lv0234->ArrPush[0];?>';	
</script>
</html>