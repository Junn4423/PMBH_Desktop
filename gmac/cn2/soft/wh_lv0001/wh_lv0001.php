<?php
//if($_GET['ID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/wh_lv0001.php");

/////////////init object//////////////
$mowh_lv0001=new wh_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0001');
$mowh_lv0001->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","WH0001.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0001->ArrPush[0]=$vLangArr[17];
$mowh_lv0001->ArrPush[1]=$vLangArr[18];
$mowh_lv0001->ArrPush[2]=$vLangArr[20];
$mowh_lv0001->ArrPush[3]=$vLangArr[21];
$mowh_lv0001->ArrPush[4]=$vLangArr[22];
$mowh_lv0001->ArrPush[5]=$vLangArr[23];
$mowh_lv0001->ArrPush[6]=$vLangArr[24];
$mowh_lv0001->ArrPush[7]=$vLangArr[25];
$mowh_lv0001->ArrPush[8]=$vLangArr[26];
$mowh_lv0001->ArrPush[9]=$vLangArr[27];

$mowh_lv0001->ArrFunc[0]='//Function';
$mowh_lv0001->ArrFunc[1]=$vLangArr[2];
$mowh_lv0001->ArrFunc[2]=$vLangArr[4];
$mowh_lv0001->ArrFunc[3]=$vLangArr[6];
$mowh_lv0001->ArrFunc[4]=$vLangArr[7];
$mowh_lv0001->ArrFunc[5]='Tính lại tồn';
$mowh_lv0001->ArrFunc[6]='Tính lại tồn';
$mowh_lv0001->ArrFunc[7]='';
$mowh_lv0001->ArrFunc[8]=$vLangArr[10];
$mowh_lv0001->ArrFunc[9]=$vLangArr[12];
$mowh_lv0001->ArrFunc[10]=$vLangArr[0];
$mowh_lv0001->ArrFunc[11]=$vLangArr[30];
$mowh_lv0001->ArrFunc[12]=$vLangArr[31];
$mowh_lv0001->ArrFunc[13]=$vLangArr[32];
$mowh_lv0001->ArrFunc[14]=$vLangArr[33];
$mowh_lv0001->ArrFunc[15]=$vLangArr[34];
////Other
$mowh_lv0001->ArrOther[1]=$vLangArr[28];
$mowh_lv0001->ArrOther[2]=$vLangArr[29];
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
	$vresult=$mowh_lv0001->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"wh_lv0001",$lvMessage);
}
elseif($flagID==2)
{
$mowh_lv0001->lv001=$_POST['txtlv001'];
$mowh_lv0001->lv002=$_POST['txtlv002'];
$mowh_lv0001->lv003=$_POST['txtlv003'];
$mowh_lv0001->lv004=$_POST['txtlv004'];
$mowh_lv0001->lv005=$_POST['txtlv005'];
$mowh_lv0001->lv006=$_POST['txtlv006'];
$mowh_lv0001->lv007=$_POST['txtlv007'];
$mowh_lv0001->lv008=$_POST['txtlv008'];
}
if($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mowh_lv0001->LV_Delete($strar);
}
if($flagID==4)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$vresult=$mowh_lv0001->LV_Approval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0001->ListView;
$curPage = $mowh_lv0001->CurPage;
$maxRows =$mowh_lv0001->MaxRows;
$vOrderList=$mowh_lv0001->ListOrder;
$vSortNum=$mowh_lv0001->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mowh_lv0001->SaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0001',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0001->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>','filter');
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
	var str="<br><iframe height=1500 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>wh_lv0001?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();
}
//-->
</script>
<?php
if($mowh_lv0001->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mowh_lv0001->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mowh_lv0001->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $mowh_lv0001->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mowh_lv0001->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mowh_lv0001->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mowh_lv0001->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mowh_lv0001->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mowh_lv0001->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mowh_lv0001->lv008;?>"/>
					    
				  </form>

				  
</div></div>
</body>
				
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mowh_lv0001->ArrPush[0];?>';	
</script>
</html>