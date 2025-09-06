<?php
session_start();
$vDir='../';
include($vDir."paras.php");
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0063.php");

/////////////init object//////////////
$mosl_lv0063=new sl_lv0063($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0063');
$mosl_lv0063->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if(isset($_GET['ajaxqty']))
{
	$vlineid=$_GET['lineid'];
	$vcol=$_GET['col'];
	$vqty=$_GET['qty'];
	$mosl_lv0063->LV_UpdateQty($vlineid,$vqty,$vcol);
	exit;
}	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0072.txt",$plang);
$mosl_lv0063->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0063->ArrPush[0]=$vLangArr[17];
$mosl_lv0063->ArrPush[1]=$vLangArr[18];
$mosl_lv0063->ArrPush[2]=$vLangArr[19];
$mosl_lv0063->ArrPush[3]=$vLangArr[20];
$mosl_lv0063->ArrPush[4]=$vLangArr[21];
$mosl_lv0063->ArrPush[5]=$vLangArr[22];
$mosl_lv0063->ArrPush[6]=$vLangArr[23];
$mosl_lv0063->ArrPush[7]=$vLangArr[24];
$mosl_lv0063->ArrPush[8]=$vLangArr[25];

$mosl_lv0063->ArrFunc[0]='//Function';
$mosl_lv0063->ArrFunc[1]=$vLangArr[2];
$mosl_lv0063->ArrFunc[2]=$vLangArr[4];
$mosl_lv0063->ArrFunc[3]=$vLangArr[6];
$mosl_lv0063->ArrFunc[4]=$vLangArr[7];
$mosl_lv0063->ArrFunc[8]=$vLangArr[10];
$mosl_lv0063->ArrFunc[9]=$vLangArr[12];
$mosl_lv0063->ArrFunc[10]=$vLangArr[0];
$mosl_lv0063->ArrFunc[11]=$vLangArr[28];
$mosl_lv0063->ArrFunc[12]=$vLangArr[29];
$mosl_lv0063->ArrFunc[13]=$vLangArr[30];
$mosl_lv0063->ArrFunc[14]=$vLangArr[31];
$mosl_lv0063->ArrFunc[15]=$vLangArr[32];

////Other
$mosl_lv0063->ArrOther[1]=$vLangArr[45];
$mosl_lv0063->ArrOther[2]=$vLangArr[46];
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
	$vresult=$mosl_lv0063->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0063",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0063->lv001=$_POST['txtlv001'];
$mosl_lv0063->lv002=$_POST['txtlv002'];
$mosl_lv0063->lv003=$_POST['txtlv003'];
$mosl_lv0063->lv004=$_POST['txtlv004'];
$mosl_lv0063->lv005=$_POST['txtlv005'];
$mosl_lv0063->lv006=$_POST['txtlv006'];
$mosl_lv0063->lv007=$_POST['txtlv007'];
$mosl_lv0063->lv008=$_POST['txtlv008'];
$mosl_lv0063->lv009=$_POST['txtlv009'];
$mosl_lv0063->lv010=$_POST['txtlv010'];
$mosl_lv0063->lv011=$_POST['txtlv011'];
$mosl_lv0063->lv012=$_POST['txtlv012'];
}

if($flag==1)
{
	$mosl_lv0063->lv001=$_GET['txtlv001'];
	$mosl_lv0063->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$mosl_lv0063->lv003=$_GET['txtlv003'];
	$mosl_lv0063->lv004=$_GET['txtlv004'];
	$mosl_lv0063->lv005=$_GET['txtlv005'];
	$mosl_lv0063->lv006=$_GET['txtlv006'];
	$mosl_lv0063->lv007=$_GET['txtlv007'];
	$mosl_lv0063->lv008=$_GET['txtlv008'];
	$mosl_lv0063->lv009=$_GET['txtlv009'];
	$mosl_lv0063->lv010=$_GET['txtlv010'];
	$mosl_lv0063->lv011=$_GET['txtlv011'];
	$mosl_lv0063->lv012=$_GET['txtlv012'];
	$mosl_lv0063->lv013=$_GET['txtlv013'];
	$mosl_lv0063->lv014=$_GET['txtlv014'];
	$mosl_lv0063->lv015=$_GET['txtlv015'];
	$mosl_lv0063->lv016=GetServerDate();
	$strReturn=$mosl_lv0063->LV_Insert();
	
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0063->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0063');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0063->ListView;
$curPage = $mosl_lv0063->CurPage;
$maxRows =$mosl_lv0063->MaxRows;
$vOrderList=$mosl_lv0063->ListOrder;
$vSortNum=$mosl_lv0063->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0063->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0063',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mosl_lv0063->lv003='';
$mosl_lv0063->lv004='';
$mosl_lv0063->lv005='';
$mosl_lv0063->lv006='';
$mosl_lv0063->lv007='';
$mosl_lv0063->lv008='';
$mosl_lv0063->lv009='';
$mosl_lv0063->lv010='';
$mosl_lv0063->lv011='';
$mosl_lv0063->lv012='';
$mosl_lv0063->lv013='';
$mosl_lv0063->lv014='';
$mosl_lv0063->lv015='';
$mosl_lv0063->lv016='';
$mosl_lv0063->lv002=getInfor($_SESSION['ERPSOFV2RUserID'],2);
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0063->GetCount();
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
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>sl_lv0063?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($mosl_lv0063->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0063->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0063->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0063->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0063->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0063->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0063->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0063->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0063->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mosl_lv0063->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mosl_lv0063->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mosl_lv0063->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mosl_lv0063->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mosl_lv0063->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mosl_lv0063->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mosl_lv0063->lv014;?>"/>	
					

				  </form>
			  
</div></div>
<div id="lvright"></div>
<script language="javascript">
		function updateprice(o,value,col)
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
			url=url+"?&ajaxqty=ajaxcheck"+"&lineid="+value+"&qty="+qty+"&col="+col;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=stateChangedQty;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
		}
		function stateChangedQty()
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
div.innerHTML='<?php echo $mosl_lv0063->ArrPush[0];?>';	
</script>
</html>