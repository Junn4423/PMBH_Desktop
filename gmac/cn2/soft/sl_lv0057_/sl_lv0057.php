<?php
session_start();
$vDir='../';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once($vDir."librarianconfig.php");
require_once($vDir."../clsall/lv_controler.php");
require_once($vDir."../clsall/sl_lv0057.php");

/////////////init object//////////////
$mosl_lv0057=new sl_lv0057($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0057');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mosl_lv0057->Dir=$vDir;
$mosl_lv0057->LV_SetMiniDisplay();
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile($vDir."../","AC0016.txt",$plang);
$mosl_lv0057->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0057->ArrPush[0]=$vLangArr[17];
$mosl_lv0057->ArrPush[1]=$vLangArr[18];
$mosl_lv0057->ArrPush[2]=$vLangArr[19];
$mosl_lv0057->ArrPush[3]=$vLangArr[20];
$mosl_lv0057->ArrPush[4]=$vLangArr[21];
$mosl_lv0057->ArrPush[5]=$vLangArr[22];
$mosl_lv0057->ArrPush[6]=$vLangArr[23];
$mosl_lv0057->ArrPush[7]=$vLangArr[24];
$mosl_lv0057->ArrPush[8]=$vLangArr[25];
$mosl_lv0057->ArrPush[9]=$vLangArr[26];
$mosl_lv0057->ArrPush[10]=$vLangArr[27];
$mosl_lv0057->ArrPush[11]=$vLangArr[28];
$mosl_lv0057->ArrPush[12]=$vLangArr[29];
$mosl_lv0057->ArrPush[13]=$vLangArr[30];
$mosl_lv0057->ArrPush[14]=$vLangArr[31];
$mosl_lv0057->ArrPush[15]=$vLangArr[32];
$mosl_lv0057->ArrPush[16]=$vLangArr[33];
$mosl_lv0057->ArrPush[17]=$vLangArr[34];
$mosl_lv0057->ArrPush[18]=$vLangArr[43];
$mosl_lv0057->ArrPush[19]=$vLangArr[42];

$mosl_lv0057->ArrFunc[0]='//Function';
$mosl_lv0057->ArrFunc[1]=$vLangArr[2];
$mosl_lv0057->ArrFunc[2]=$vLangArr[4];
$mosl_lv0057->ArrFunc[3]=$vLangArr[6];
$mosl_lv0057->ArrFunc[4]=$vLangArr[7];
$mosl_lv0057->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0057->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0057->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0057->ArrFunc[8]=$vLangArr[10];
$mosl_lv0057->ArrFunc[9]=$vLangArr[12];
$mosl_lv0057->ArrFunc[10]=$vLangArr[0];
$mosl_lv0057->ArrFunc[11]=$vLangArr[37];
$mosl_lv0057->ArrFunc[12]=$vLangArr[38];
$mosl_lv0057->ArrFunc[13]=$vLangArr[39];
$mosl_lv0057->ArrFunc[14]=$vLangArr[40];
$mosl_lv0057->ArrFunc[15]=$vLangArr[41];

////Other
$mosl_lv0057->ArrOther[1]=$vLangArr[35];
$mosl_lv0057->ArrOther[2]=$vLangArr[36];
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
	$vresult=$mosl_lv0057->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0057",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0057->lv001=$_POST['txtlv001'];
$mosl_lv0057->lv003=$_POST['txtlv003'];
$mosl_lv0057->lv004=$_POST['txtlv004'];
$mosl_lv0057->lv005=$_POST['txtlv005'];
$mosl_lv0057->lv006=$_POST['txtlv006'];
$mosl_lv0057->lv007=$_POST['txtlv007'];
$mosl_lv0057->lv008=$_POST['txtlv008'];
$mosl_lv0057->lv009=$_POST['txtlv009'];
$mosl_lv0057->lv010=$_POST['txtlv010'];
$mosl_lv0057->lv011=$_POST['txtlv011'];
$mosl_lv0057->lv012=$_POST['txtlv012'];
$mosl_lv0057->lv013=$_POST['txtlv013'];
$mosl_lv0057->lv014=$_POST['txtlv014'];
$mosl_lv0057->lv015=$_POST['txtlv015'];
$mosl_lv0057->lv016=$_POST['txtlv016'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0057->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0057->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0057->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0057');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0057->ListView;
$curPage = $mosl_lv0057->CurPage;
$maxRows =$mosl_lv0057->MaxRows;
$vOrderList=$mosl_lv0057->ListOrder;
$vSortNum=$mosl_lv0057->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
//$mosl_lv0057->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0057',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
$mosl_lv0057->lv013=$_GET['ChildID'];
$totalRowsC=$mosl_lv0057->GetCount();
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
</head>
<script language="JavaScript" type="text/javascript">
<!--
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0);?>"
	 o.submit();

}
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=600 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>sl_lv0057_?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0);?>"
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
	o.txtFlag.value=4;
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0);?>"
	o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0057?func=<?php echo $_GET['func'];?>&childdetailfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php
if($mosl_lv0057->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div>
					<div id="lvtitlelist" class="lvtitle"></div>
					<div id="lvleft"><form onsubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,7,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php 
						$vFieldList="lv001,lv017";
						echo $mosl_lv0057->LV_BuilListMini($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0057->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0057->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0057->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0057->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0057->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0057->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0057->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mosl_lv0057->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mosl_lv0057->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mosl_lv0057->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mosl_lv0057->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mosl_lv0057->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mosl_lv0057->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mosl_lv0057->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mosl_lv0057->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mosl_lv0057->lv016;?>"/>
	   
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div>
<div id="lvright"></div>
</div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0057->ArrPush[0];?>';	
</script>