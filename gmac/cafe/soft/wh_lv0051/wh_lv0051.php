<?php
session_start();
$vDir='../';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/wh_lv0051.php");

/////////////init object//////////////
$mowh_lv0051=new wh_lv0051($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0051');
$mowh_lv0051->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","WH0039.txt",$plang);
$mowh_lv0051->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0051->ArrPush[0]=$vLangArr[17];
$mowh_lv0051->ArrPush[1]=$vLangArr[18];
$mowh_lv0051->ArrPush[2]=$vLangArr[30];
$mowh_lv0051->ArrPush[3]=$vLangArr[28];
$mowh_lv0051->ArrPush[4]=$vLangArr[31];
$mowh_lv0051->ArrPush[5]=$vLangArr[32];
$mowh_lv0051->ArrPush[6]=$vLangArr[33];
$mowh_lv0051->ArrPush[7]=$vLangArr[34];
$mowh_lv0051->ArrPush[8]=$vLangArr[35];
$mowh_lv0051->ArrPush[9]=$vLangArr[36];
$mowh_lv0051->ArrPush[10]=$vLangArr[37];
$mowh_lv0051->ArrPush[11]=$vLangArr[38];
$mowh_lv0051->ArrPush[12]=$vLangArr[39];
$mowh_lv0051->ArrPush[13]=$vLangArr[40];
$mowh_lv0051->ArrPush[14]=$vLangArr[52];
$mowh_lv0051->ArrPush[15]=$vLangArr[53];
$mowh_lv0051->ArrPush[16]=$vLangArr[48];
$mowh_lv0051->ArrPush[98]=$vLangArr[50];
$mowh_lv0051->ArrPush[99]=$vLangArr[49];

$mowh_lv0051->ArrFunc[0]='//Function';
$mowh_lv0051->ArrFunc[1]=$vLangArr[2];
$mowh_lv0051->ArrFunc[2]=$vLangArr[4];
$mowh_lv0051->ArrFunc[3]=$vLangArr[6];
$mowh_lv0051->ArrFunc[4]=$vLangArr[7];
$mowh_lv0051->ArrFunc[5]='';
$mowh_lv0051->ArrFunc[6]='';
$mowh_lv0051->ArrFunc[7]='';
$mowh_lv0051->ArrFunc[8]=$vLangArr[10];
$mowh_lv0051->ArrFunc[9]=$vLangArr[12];
$mowh_lv0051->ArrFunc[10]=$vLangArr[0];
$mowh_lv0051->ArrFunc[11]=$vLangArr[43];
$mowh_lv0051->ArrFunc[12]=$vLangArr[44];
$mowh_lv0051->ArrFunc[13]=$vLangArr[45];
$mowh_lv0051->ArrFunc[14]=$vLangArr[46];
$mowh_lv0051->ArrFunc[15]=$vLangArr[47];

////Other
$mowh_lv0051->ArrOther[1]=$vLangArr[41];
$mowh_lv0051->ArrOther[2]=$vLangArr[42];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$flag=(int)$_GET["txtOpt"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mowh_lv0051->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"wh_lv0051",$lvMessage);
}
elseif($flagID==2)
{
$mowh_lv0051->lv001=$_POST['txtlv001'];
$mowh_lv0051->lv002=$_POST['txtlv002'];
$mowh_lv0051->lv003=$_POST['txtlv003'];
$mowh_lv0051->lv004=$_POST['txtlv004'];
$mowh_lv0051->lv005=$_POST['txtlv005'];
$mowh_lv0051->lv006=$_POST['txtlv006'];
$mowh_lv0051->lv007=$_POST['txtlv007'];
$mowh_lv0051->lv008=$_POST['txtlv008'];
$mowh_lv0051->lv009=$_POST['txtlv009'];
$mowh_lv0051->lv010=$_POST['txtlv010'];
$mowh_lv0051->lv011=$_POST['txtlv011'];
$mowh_lv0051->lv012=$_POST['txtlv012'];
}

if($flag==1)
{
	$mowh_lv0051->lv001=$_GET['txtlv001'];
	$mowh_lv0051->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mowh_lv0051->lv003=$_GET['txtlv003'];
	$mowh_lv0051->lv004=$_GET['txtlv004'];
	$mowh_lv0051->lv005=$_GET['txtlv005'];
	$mowh_lv0051->lv006=$_GET['txtlv006'];
	$mowh_lv0051->lv007=$_GET['txtlv007'];
	$mowh_lv0051->lv008=$_GET['txtlv008'];
	$mowh_lv0051->lv009=$_GET['txtlv009'];
	$mowh_lv0051->lv010=$_GET['txtlv010'];
	$mowh_lv0051->lv011=$_GET['txtlv011'];
	$mowh_lv0051->lv012=$_GET['txtlv012'];
	$mowh_lv0051->lv013=$_GET['txtlv013'];
	$mowh_lv0051->lv014=$_GET['txtlv014'];
	$strReturn=$mowh_lv0051->LV_Insert();
	
}
elseif($flag==2)
{
	$mowh_lv0051->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mowh_lv0051->lv013=$_GET['txtlv013'];
	$mowh_lv0051->LV_CalMeterial();
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0051->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0051');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0051->ListView;
$curPage = $mowh_lv0051->CurPage;
$maxRows =$mowh_lv0051->MaxRows;
$vOrderList=$mowh_lv0051->ListOrder;
$vSortNum=$mowh_lv0051->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mowh_lv0051->SaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0051',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mowh_lv0051->lv003='';
$mowh_lv0051->lv004='';
$mowh_lv0051->lv005='';
$mowh_lv0051->lv006='';
$mowh_lv0051->lv007='';
$mowh_lv0051->lv008='';
$mowh_lv0051->lv009='';
$mowh_lv0051->lv010='';
$mowh_lv0051->lv011='';
$mowh_lv0051->lv012='';
$mowh_lv0051->lv013='';
$mowh_lv0051->lv014='';
$mowh_lv0051->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0051->GetCount();
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
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>wh_lv0051?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mowh_lv0051->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mowh_lv0051->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mowh_lv0051->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mowh_lv0051->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mowh_lv0051->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mowh_lv0051->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mowh_lv0051->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mowh_lv0051->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mowh_lv0051->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mowh_lv0051->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mowh_lv0051->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mowh_lv0051->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mowh_lv0051->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mowh_lv0051->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mowh_lv0051->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mowh_lv0051->lv014;?>"/>	
					

				  </form>
			  
</div></div>
<div id="lvright"></div>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mowh_lv0051->ArrPush[0];?>';	
</script>
</html>