<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0029.php");

/////////////init object//////////////
$mosl_lv0029=new sl_lv0029($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0029');
$mosl_lv0029->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0044.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0029->ArrPush[0]=$vLangArr[17];
$mosl_lv0029->ArrPush[1]=$vLangArr[18];
$mosl_lv0029->ArrPush[2]=$vLangArr[20];
$mosl_lv0029->ArrPush[3]=$vLangArr[21];
$mosl_lv0029->ArrPush[4]=$vLangArr[22];

$mosl_lv0029->ArrFunc[0]='//Function';
$mosl_lv0029->ArrFunc[1]=$vLangArr[2];
$mosl_lv0029->ArrFunc[2]=$vLangArr[4];
$mosl_lv0029->ArrFunc[3]=$vLangArr[6];
$mosl_lv0029->ArrFunc[4]=$vLangArr[7];
$mosl_lv0029->ArrFunc[5]='';
$mosl_lv0029->ArrFunc[6]='';
$mosl_lv0029->ArrFunc[7]='';
$mosl_lv0029->ArrFunc[8]=$vLangArr[10];
$mosl_lv0029->ArrFunc[9]=$vLangArr[12];
$mosl_lv0029->ArrFunc[10]=$vLangArr[0];
$mosl_lv0029->ArrFunc[11]=$vLangArr[25];
$mosl_lv0029->ArrFunc[12]=$vLangArr[26];
$mosl_lv0029->ArrFunc[13]=$vLangArr[27];
$mosl_lv0029->ArrFunc[14]=$vLangArr[28];
$mosl_lv0029->ArrFunc[15]=$vLangArr[29];
////Other
$mosl_lv0029->ArrOther[1]=$vLangArr[23];
$mosl_lv0029->ArrOther[2]=$vLangArr[24];
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
	$vresult=$mosl_lv0029->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0029",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0029->lv001=$_POST['txtlv001'];
$mosl_lv0029->lv002=$_POST['txtlv002'];
$mosl_lv0029->lv003=$_POST['txtlv003'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0029->LV_Delete($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0029->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0029');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0029->ListView;
$curPage = $mosl_lv0029->CurPage;
$maxRows =$mosl_lv0029->MaxRows;
$vOrderList=$mosl_lv0029->ListOrder;
$vSortNum=$mosl_lv0029->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0029->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0029',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0029->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>','filter');
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=650 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0029?&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
//-->
</script>
<?php
if($mosl_lv0029->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?><?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0029->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0029->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mosl_lv0029->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003"  value="<?php echo $mosl_lv0029->lv003;?>"/>
					    
				  </form>

				  
</div></div>
<div id="lvright"></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0029->ArrPush[0];?>';	
</script>
</html>