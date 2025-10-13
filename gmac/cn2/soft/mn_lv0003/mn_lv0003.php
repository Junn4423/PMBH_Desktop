<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/mn_lv0003.php");

/////////////init object//////////////
$momn_lv0003=new mn_lv0003($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0003');
$momn_lv0003->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0012.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0003->ArrPush[0]=$vLangArr[17];
$momn_lv0003->ArrPush[1]=$vLangArr[18];
$momn_lv0003->ArrPush[2]=$vLangArr[20];
$momn_lv0003->ArrPush[3]=$vLangArr[21];

$momn_lv0003->ArrFunc[0]='//Function';
$momn_lv0003->ArrFunc[1]=$vLangArr[2];
$momn_lv0003->ArrFunc[2]=$vLangArr[4];
$momn_lv0003->ArrFunc[3]=$vLangArr[6];
$momn_lv0003->ArrFunc[4]=$vLangArr[7];
$momn_lv0003->ArrFunc[5]='';
$momn_lv0003->ArrFunc[6]='';
$momn_lv0003->ArrFunc[7]='';
$momn_lv0003->ArrFunc[8]=$vLangArr[10];
$momn_lv0003->ArrFunc[9]=$vLangArr[12];
$momn_lv0003->ArrFunc[10]=$vLangArr[0];
$momn_lv0003->ArrFunc[11]=$vLangArr[24];
$momn_lv0003->ArrFunc[12]=$vLangArr[25];
$momn_lv0003->ArrFunc[13]=$vLangArr[26];
$momn_lv0003->ArrFunc[14]=$vLangArr[27];
$momn_lv0003->ArrFunc[15]=$vLangArr[28];
////Other
$momn_lv0003->ArrOther[1]=$vLangArr[22];
$momn_lv0003->ArrOther[2]=$vLangArr[23];
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
	$vresult=$momn_lv0003->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"mn_lv0003",$lvMessage);
}
elseif($flagID==2)
{
$momn_lv0003->lv001=$_POST['txtlv001'];
$momn_lv0003->lv002=$_POST['txtlv002'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$momn_lv0003->LV_Delete($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0003->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0003');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0003->ListView;
$curPage = $momn_lv0003->CurPage;
$maxRows =$momn_lv0003->MaxRows;
$vOrderList=$momn_lv0003->ListOrder;
$vSortNum=$momn_lv0003->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$momn_lv0003->SaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0003',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0003->GetCount();
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
	var str="<br><iframe id='lvframefrm' height=250 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>mn_lv0003?&func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($momn_lv0003->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?><?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $momn_lv0003->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $momn_lv0003->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $momn_lv0003->lv002;?>"/>
					    
				  </form>

				  
</div></div>
<div id="lvright"></div>
</body>
				
<?php
} else {
	include("../mn_lv0003/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $momn_lv0003->ArrPush[0];?>';	
</script>
</html>