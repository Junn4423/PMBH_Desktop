<?php
session_start();
$vDir='../';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ac_lv0077.php");

/////////////init object//////////////
$moac_lv0077=new ac_lv0077($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0077');
$moac_lv0077->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","AC0024.txt",$plang);
$moac_lv0077->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0077->ArrPush[0]=$vLangArr[17];
$moac_lv0077->ArrPush[1]=$vLangArr[18];
$moac_lv0077->ArrPush[2]=$vLangArr[19];
$moac_lv0077->ArrPush[3]=$vLangArr[20];
$moac_lv0077->ArrPush[4]=$vLangArr[21];
$moac_lv0077->ArrPush[5]=$vLangArr[22];
$moac_lv0077->ArrPush[6]=$vLangArr[23];
$moac_lv0077->ArrPush[7]=$vLangArr[24];
$moac_lv0077->ArrPush[8]=$vLangArr[25];
$moac_lv0077->ArrPush[9]=$vLangArr[26];
$moac_lv0077->ArrPush[10]=$vLangArr[27];
$moac_lv0077->ArrPush[11]=$vLangArr[28];
$moac_lv0077->ArrPush[12]=$vLangArr[29];
$moac_lv0077->ArrPush[13]=$vLangArr[30];
$moac_lv0077->ArrPush[14]=$vLangArr[31];
$moac_lv0077->ArrPush[15]=$vLangArr[32];
$moac_lv0077->ArrPush[16]=$vLangArr[33];
$moac_lv0077->ArrPush[17]=$vLangArr[34];

$moac_lv0077->ArrFunc[0]='//Function';
$moac_lv0077->ArrFunc[1]=$vLangArr[2];
$moac_lv0077->ArrFunc[2]=$vLangArr[4];
$moac_lv0077->ArrFunc[3]=$vLangArr[6];
$moac_lv0077->ArrFunc[4]=$vLangArr[7];
$moac_lv0077->ArrFunc[5]='';
$moac_lv0077->ArrFunc[6]='';
$moac_lv0077->ArrFunc[7]='';
$moac_lv0077->ArrFunc[8]=$vLangArr[10];
$moac_lv0077->ArrFunc[9]=$vLangArr[12];
$moac_lv0077->ArrFunc[10]=$vLangArr[0];
$moac_lv0077->ArrFunc[11]=$vLangArr[28];
$moac_lv0077->ArrFunc[12]=$vLangArr[29];
$moac_lv0077->ArrFunc[13]=$vLangArr[30];
$moac_lv0077->ArrFunc[14]=$vLangArr[31];
$moac_lv0077->ArrFunc[15]=$vLangArr[32];

////Other
$moac_lv0077->ArrOther[1]=$vLangArr[26];
$moac_lv0077->ArrOther[2]=$vLangArr[27];
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
$flag=(int)$_GET["txtOpt"];
if($flag==1)
{
	$moac_lv0077->lv001=$_GET['txtlv001'];
	$moac_lv0077->lv002=$_SESSION['ERPSOFV2RUserID'];
	$moac_lv0077->lv003=$_GET['txtlv003'];
	$moac_lv0077->lv004=str_replace(",","",$_GET['txtlv004']);
	$moac_lv0077->lv005=$_GET['txtlv005'];
	$moac_lv0077->lv006=$_GET['txtlv006'];
	$moac_lv0077->lv007=$_GET['txtlv007'];
	$moac_lv0077->lv008=$_GET['txtlv008'];
	$strReturn=$moac_lv0077->LV_Insert();
	
	$moac_lv0077->lv003='';
	$moac_lv0077->lv004='';
	$moac_lv0077->lv005='';
	$moac_lv0077->lv006='';
	$moac_lv0077->lv007='';
	$moac_lv0077->lv008='';
}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moac_lv0077->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ac_lv0077",$lvMessage);
}
elseif($flagID==2)
{
	$moac_lv0077->lv001=$_POST['txtlv001'];
	$moac_lv0077->lv002=$_GET['ID'];
	$moac_lv0077->lv003=$_POST['txtlv003'];
	$moac_lv0077->lv004=$_POST['txtlv004'];
	$moac_lv0077->lv005=$_POST['txtlv005'];
	$moac_lv0077->lv006=$_POST['txtlv006'];
	$moac_lv0077->lv007=$_POST['txtlv007'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0077->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0077');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moac_lv0077->ListView;
$curPage = $moac_lv0077->CurPage;
$maxRows =$moac_lv0077->MaxRows;
$vOrderList=$moac_lv0077->ListOrder;
$vSortNum=$moac_lv0077->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moac_lv0077->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0077',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$moac_lv0077->lv002=$_GET['ID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0077->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>','filter');
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
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>ac_lv0077?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
    div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($moac_lv0077->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moac_lv0077->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moac_lv0077->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $moac_lv0077->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moac_lv0077->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moac_lv0077->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moac_lv0077->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moac_lv0077->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moac_lv0077->lv007;?>"/>
					</form>
				  
</div></div>
<div id="lvright"></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../ac_lv0077/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moac_lv0077->ArrPush[0];?>';	
</script>
</html>