<?php
session_start();
$vDir='../';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0032.php");
require_once("$vDir../clsall/sl_lv0007.php");

/////////////init object//////////////
$mosl_lv0032=new sl_lv0032($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0031');
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
$mosl_lv0032->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajaxnote']))
{
	$vlineid=$_GET['lineid'];
	$vnote=$_GET['note'];
	$mosl_lv0032->LV_UpdateNote($vlineid,$vnote);
	exit;
}	
if(isset($_GET['ajaxqty']))
{
	$vlineid=$_GET['lineid'];
	$vqty=$_GET['qty'];
	$mosl_lv0032->LV_UpdateQty($vlineid,$vqty);
	exit;
}	
if(isset($_GET['ajaxprice']))
{
	$vlineid=$_GET['lineid'];
	$vqty=$_GET['price'];
	$mosl_lv0032->LV_UpdatePrice($vlineid,$vqty);
	exit;
}	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0029.txt",$plang);
$mosl_lv0032->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0032->ArrPush[0]=$vLangArr[17];
$mosl_lv0032->ArrPush[1]=$vLangArr[18];
$mosl_lv0032->ArrPush[2]=$vLangArr[19];
$mosl_lv0032->ArrPush[3]=$vLangArr[45];
$mosl_lv0032->ArrPush[4]=$vLangArr[21];
$mosl_lv0032->ArrPush[5]=$vLangArr[22];
$mosl_lv0032->ArrPush[6]=$vLangArr[23];
$mosl_lv0032->ArrPush[7]=$vLangArr[24];
$mosl_lv0032->ArrPush[8]=$vLangArr[25];
$mosl_lv0032->ArrPush[9]=$vLangArr[26];
$mosl_lv0032->ArrPush[10]=$vLangArr[27];
$mosl_lv0032->ArrPush[11]=$vLangArr[28];
$mosl_lv0032->ArrPush[12]=$vLangArr[29];
$mosl_lv0032->ArrPush[13]=$vLangArr[30];
$mosl_lv0032->ArrPush[14]=$vLangArr[31];
$mosl_lv0032->ArrPush[15]=$vLangArr[41];
$mosl_lv0032->ArrPush[16]=$vLangArr[33];
$mosl_lv0032->ArrPush[17]=$vLangArr[59];
$mosl_lv0032->ArrPush[18]=$vLangArr[32];
$mosl_lv0032->ArrPush[98]=$vLangArr[58];
$mosl_lv0032->ArrPush[99]=$vLangArr[57];

$mosl_lv0032->ArrFunc[0]='//Function';
$mosl_lv0032->ArrFunc[1]=$vLangArr[2];
$mosl_lv0032->ArrFunc[2]=$vLangArr[4];
$mosl_lv0032->ArrFunc[3]=$vLangArr[6];
$mosl_lv0032->ArrFunc[4]=$vLangArr[7];
$mosl_lv0032->ArrFunc[5]='';
$mosl_lv0032->ArrFunc[6]='';
$mosl_lv0032->ArrFunc[7]='';
$mosl_lv0032->ArrFunc[8]=$vLangArr[10];
$mosl_lv0032->ArrFunc[9]=$vLangArr[12];
$mosl_lv0032->ArrFunc[10]=$vLangArr[0];
$mosl_lv0032->ArrFunc[11]=$vLangArr[36];
$mosl_lv0032->ArrFunc[12]=$vLangArr[37];
$mosl_lv0032->ArrFunc[13]=$vLangArr[38];
$mosl_lv0032->ArrFunc[14]=$vLangArr[39];
$mosl_lv0032->ArrFunc[15]=$vLangArr[40];

////Other
$mosl_lv0032->ArrOther[1]=$vLangArr[34];
$mosl_lv0032->ArrOther[2]=$vLangArr[35];
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
	$vresult=$mosl_lv0032->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0032",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0032->lv001=$_POST['txtlv001'];
if($_GET['ChildID']=="")
 $mosl_lv0032->lv002=$_POST['txtlv002'];
else
$mosl_lv0032->lv002=$_GET['ChildID'];
$mosl_lv0032->lv003=$_POST['txtlv003'];
$mosl_lv0032->lv004=$_POST['txtlv004'];
$mosl_lv0032->lv005=$_POST['txtlv005'];
$mosl_lv0032->lv006=$_POST['txtlv006'];
$mosl_lv0032->lv007=$_POST['txtlv007'];
$mosl_lv0032->lv008=$_POST['txtlv008'];
$mosl_lv0032->lv009=$_POST['txtlv009'];
$mosl_lv0032->lv010=$_POST['txtlv010'];
$mosl_lv0032->lv011=$_POST['txtlv011'];
$mosl_lv0032->lv012=$_POST['txtlv012'];
$mosl_lv0032->lv016=$_POST['txtlv016'];
$mosl_lv0032->lv015=$_POST['txtlv015'];
}
if($flag==1)
{
	$mosl_lv0032->lv001=$_GET['txtlv001'];
	$mosl_lv0032->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mosl_lv0032->lv003=$_GET['txtlv003'];
	$mosl_lv0007->LV_LoadID($mosl_lv0032->lv003);
	$mosl_lv0032->lv004=$_GET['txtlv004'];
	$mosl_lv0032->lv005=$_GET['txtlv005'];
	if($mosl_lv0032->lv005=="" || $mosl_lv0032->lv005==NULL) $mosl_lv0032->lv005=$mosl_lv0007->lv004;
	$mosl_lv0032->lv007=$_GET['txtlv007'];
	if($mosl_lv0032->lv007=="" || $mosl_lv0032->lv007==NULL) $mosl_lv0032->lv007=$mosl_lv0007->lv008;
	$mosl_lv0032->lv008=$_GET['txtlv008'];
	$mosl_lv0032->lv009=$_GET['txtlv009'];
	$mosl_lv0032->lv006=$mosl_lv0032->LV_CheckPriceItem($mosl_lv0032->lv003,$mosl_lv0032->lv009);
	$mosl_lv0032->lv010=$_GET['txtlv010'];
	$mosl_lv0032->lv011=$_GET['txtlv011'];
	$mosl_lv0032->lv012=$_GET['txtlv012'];
	$mosl_lv0032->lv013=$mosl_lv0032->FormatView(GetServerDate().' '.GetServerTime(),4);
	$mosl_lv0032->lv016=$_GET['txtlv016'];
	$mosl_lv0032->lv015=$_GET['txtlv015'];
	$vid=$mosl_lv0032->LV_CheckLine($mosl_lv0032->lv003,$mosl_lv0032->lv002);
	if($vid=="")
		$strReturn=$mosl_lv0032->LV_Insert();
	else
		$strReturn=$mosl_lv0032->LV_UpdateIncrease($vid);
	
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0032->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0032');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0032->ListView;
$curPage = $mosl_lv0032->CurPage;
$maxRows =$mosl_lv0032->MaxRows;
$vOrderList=$mosl_lv0032->ListOrder;
$vSortNum=$mosl_lv0032->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0032->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0032',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mosl_lv0032->lv003='';
$mosl_lv0032->lv004='';
$mosl_lv0032->lv005='';
$mosl_lv0032->lv006='';
$mosl_lv0032->lv007='';
$mosl_lv0032->lv008='';
$mosl_lv0032->lv009='';
$mosl_lv0032->lv010='';
$mosl_lv0032->lv011='';
$mosl_lv0032->lv012='';
$mosl_lv0032->lv013='';
$mosl_lv0032->lv014='';
$mosl_lv0032->lv015='';
$mosl_lv0032->lv016='';
$mosl_lv0032->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0032->GetCount();
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
	var str="<br><iframe id='lvframefrm' height=650 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0032?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mosl_lv0032->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0032->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0032->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0032->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0032->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0032->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0032->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0032->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0032->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mosl_lv0032->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mosl_lv0032->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mosl_lv0032->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mosl_lv0032->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mosl_lv0032->lv012;?>"/>
					

				  </form>
				  
</div></div>
<div id="lvright"></div>
<script language="javascript">
		function updateqty(o,value)
		{
			qty=o.value;
			$xmlhttp2=null;
			if(value=="" || qty=="") 
			{
				alert("Please! Qty is not empty!");
				return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxqty=ajaxcheck"+"&lineid="+value+"&qty="+qty;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=stateChangedQty;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
		}
		function updatenote(o,value)
		{
			note=o.value;
			$xmlhttp3=null;
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxnote=ajaxcheck"+"&lineid="+value+"&note="+note;
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=stateChangedNote;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
		}
		function updateprice(o,value)
		{
			qty=o.value;
			$xmlhttp2=null;
			if(value=="" || qty=="") 
			{
				alert("Please! Qty is not empty!");
				return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxprice=ajaxcheck"+"&lineid="+value+"&price="+qty;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=stateChangedPrice;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
		}
		function stateChangedNote()
		{
		}
		function stateChangedQty()
		{
		}
		function stateChangedPrice()
		{
		}
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
</script>
</body>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("$vDir../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0032->ArrPush[0];?>';	
</script>
</html>