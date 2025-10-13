<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/tc_lv0001.php");

/////////////init object//////////////
$motc_lv0001=new tc_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0001');
$motc_lv0001->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","TC0001.txt",$plang);
$motc_lv0001->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0001->ArrPush[0]=$vLangArr[17];
$motc_lv0001->ArrPush[1]=$vLangArr[18];
$motc_lv0001->ArrPush[2]=$vLangArr[19];
$motc_lv0001->ArrPush[3]=$vLangArr[20];
$motc_lv0001->ArrPush[4]=$vLangArr[21];
$motc_lv0001->ArrPush[5]=$vLangArr[22];
$motc_lv0001->ArrPush[6]=$vLangArr[23];
$motc_lv0001->ArrPush[7]=$vLangArr[24];
$motc_lv0001->ArrPush[8]=$vLangArr[25];
$motc_lv0001->ArrPush[9]=$vLangArr[26];
$motc_lv0001->ArrPush[10]=$vLangArr[27];

$motc_lv0001->ArrFunc[0]='//Function';
$motc_lv0001->ArrFunc[1]=$vLangArr[2];
$motc_lv0001->ArrFunc[2]=$vLangArr[4];
$motc_lv0001->ArrFunc[3]=$vLangArr[6];
$motc_lv0001->ArrFunc[4]=$vLangArr[7];
$motc_lv0001->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$motc_lv0001->ArrFunc[6]=GetLangExcept('Apr',$plang);
$motc_lv0001->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$motc_lv0001->ArrFunc[8]=$vLangArr[10];
$motc_lv0001->ArrFunc[9]=$vLangArr[12];
$motc_lv0001->ArrFunc[10]=$vLangArr[0];
$motc_lv0001->ArrFunc[11]=$vLangArr[32];
$motc_lv0001->ArrFunc[12]=$vLangArr[33];
$motc_lv0001->ArrFunc[13]=$vLangArr[34];
$motc_lv0001->ArrFunc[14]=$vLangArr[35];
$motc_lv0001->ArrFunc[15]=$vLangArr[36];

////Other
$motc_lv0001->ArrOther[1]=$vLangArr[30];
$motc_lv0001->ArrOther[2]=$vLangArr[31];
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
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0001->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"tc_lv0001",$lvMessage);
}
elseif($flagID==2)
{
$motc_lv0001->lv001=$_POST['txtlv001'];
$lvtc_lv0001->lv002=$_POST['txtlv002'];
$motc_lv0001->lv003=$_POST['txtlv003'];
$motc_lv0001->lv004=$_POST['txtlv004'];
$motc_lv0001->lv005=$_POST['txtlv005'];
$motc_lv0001->lv006=$_POST['txtlv006'];
$motc_lv0001->lv007=$_POST['txtlv007'];
$motc_lv0001->lv008=$_POST['txtlv008'];
$motc_lv0001->lv009=$_POST['txtlv009'];
$motc_lv0001->lv010=$_POST['txtlv010'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0001->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0001->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$motc_lv0001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$motc_lv0001->ListView;
$curPage = $motc_lv0001->CurPage;
$maxRows =$motc_lv0001->MaxRows;
$vOrderList=$motc_lv0001->ListOrder;
$vSortNum=$molv_lv0004->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$motc_lv0001->SaveOperation($_SESSION['ERPSOFV2RUserID'],'tc_lv0001',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$motc_lv0001->GetCount();
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
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>tc_lv0001?func=<?php echo $_GET['func'];?>&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>"
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
	o.action="<?php echo $vDir;?>tc_lv0001?func=<?php echo $_GET['func'];?>&func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php
if($motc_lv0001->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $motc_lv0001->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $motc_lv0001->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $motc_lv0001->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $motc_lv0001->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $motc_lv0001->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $motc_lv0001->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $motc_lv0001->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $motc_lv0001->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $motc_lv0001->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $motc_lv0001->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $motc_lv0001->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $motc_lv0001->lv011;?>"/>
					

				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $motc_lv0001->ArrPush[0];?>';	
</script>
</html>