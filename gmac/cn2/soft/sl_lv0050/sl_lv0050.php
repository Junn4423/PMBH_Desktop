<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0050.php");
require_once("$vDir../clsall/sl_lv0014.php");
////////init object////////////////////
	$mosl_lv0050=new sl_lv0050($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0050');
	$mosl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0014');
	$mosl_lv0050->obj_child=$mosl_lv0014;
	$mosl_lv0050->path_server="http://msmart.vn/";
	$mosl_lv0050->path_web="images/employees/";
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0027.txt",$plang);
if(isset($_GET['ajax']))
{
	echo '[CHECK]';
	echo $_GET['contractid'];
	
	require_once ('sl_lv0053/sl_lv0053.php');
	echo '[ENDCHECK]';
	exit;
}
if(isset($_GET['apr_ajax']))
{
	echo '[CHECK]';
	$strar="'".$_GET['contractid']."'";
	require_once("$vDir../clsall/sl_lv0013.php");
	$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
	if($mosl_lv0013->GetApr()==1)
	{
		$vresult=$mosl_lv0013->LV_Aproval($strar);
		echo $_GET['contractid'];
	}
	echo '[ENDCHECK]';
	exit;
}
if(isset($_GET['unapr_ajax']))
{
	echo '[CHECK]';
	$strar="'".$_GET['contractid']."'";
	require_once("$vDir../clsall/sl_lv0013.php");
	$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
	
	if($mosl_lv0013->GetUnApr()==1)
	{	$vresult=$mosl_lv0013->LV_UnAproval($strar);
		echo $_GET['contractid'];
	}
	echo '[ENDCHECK]';
	exit;
}
$vNow=GetServerDate();
$mosl_lv0050->ArrPush[0]=$vLangArr[17];
$mosl_lv0050->ArrPush[1]=$vLangArr[18];
$mosl_lv0050->ArrPush[2]=$vLangArr[19];
$mosl_lv0050->ArrPush[3]=$vLangArr[20];
$mosl_lv0050->ArrPush[4]=$vLangArr[21];
$mosl_lv0050->ArrPush[5]=$vLangArr[22];
$mosl_lv0050->ArrPush[6]=$vLangArr[23];
$mosl_lv0050->ArrPush[7]=$vLangArr[24];
$mosl_lv0050->ArrPush[8]=$vLangArr[25];
$mosl_lv0050->ArrPush[9]=$vLangArr[26];
$mosl_lv0050->ArrPush[10]=$vLangArr[27];
$mosl_lv0050->ArrPush[11]=$vLangArr[28];
$mosl_lv0050->ArrPush[12]=$vLangArr[29];
$mosl_lv0050->ArrPush[13]=$vLangArr[41];
$mosl_lv0050->ArrPush[14]=$vLangArr[40];
$mosl_lv0050->ArrPush[15]=$vLangArr[42];
$mosl_lv0050->ArrPush[16]=$vLangArr[45];
$mosl_lv0050->ArrPush[17]=$vLangArr[43];
$mosl_lv0050->ArrPush[18]=$vLangArr[44];
$mosl_lv0050->ArrPush[19]=$vLangArr[46];
$mosl_lv0050->ArrPush[20]=$vLangArr[47];
$mosl_lv0050->ArrPush[21]=$vLangArr[48];
$mosl_lv0050->ArrPush[22]=$vLangArr[49];
$mosl_lv0050->ArrPush[23]=$vLangArr[50];
$mosl_lv0050->ArrPush[24]=$vLangArr[51];
$mosl_lv0050->ArrPush[25]=$vLangArr[52];
$mosl_lv0050->ArrPush[26]=$vLangArr[53];

$mosl_lv0050->ArrFunc[0]='//Function';
$mosl_lv0050->ArrFunc[1]=$vLangArr[2];
$mosl_lv0050->ArrFunc[2]=$vLangArr[4];
$mosl_lv0050->ArrFunc[3]=$vLangArr[6];
$mosl_lv0050->ArrFunc[4]=$vLangArr[7];
$mosl_lv0050->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0050->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0050->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0050->ArrFunc[8]=$vLangArr[10];
$mosl_lv0050->ArrFunc[9]=$vLangArr[12];
$mosl_lv0050->ArrFunc[10]=$vLangArr[0];
$mosl_lv0050->ArrFunc[11]=$vLangArr[34];
$mosl_lv0050->ArrFunc[12]=$vLangArr[35];
$mosl_lv0050->ArrFunc[13]=$vLangArr[36];
$mosl_lv0050->ArrFunc[14]=$vLangArr[37];
$mosl_lv0050->ArrFunc[15]=$vLangArr[38];
$mosl_lv0050->ArrFunc[16]=$vLangArr[43];
$mosl_lv0050->ArrFunc[17]=$vLangArr[44];
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0050->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0050');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0050->ListView;
$curPage = $mosl_lv0050->CurPage;
$maxRows =$mosl_lv0050->MaxRows;
$vSortNum=$moac_lv0001->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0050->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0050',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0050->GetCount('');
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mosl_lv0050->Load($mosl_lv0050->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/jquery.treeview.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function viewdisplay(v)
	{
		var o=v.parentNode;
		var i=0;
		for(i=0;i<10;i++)
		{
			if(o.childNodes[i].lang=="ul")
			{
				if(o.childNodes[i].style.display=="none")
				{
					o.childNodes[i].style.display="block";
					o.className="";
				}
				else
				{
					o.childNodes[i].style.display="none";
					o.className="expandable lastExpandable";
				}
			}
			
		}
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv802.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv802.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	function RunFunction()
	{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>wh_lv0031/wh_lv0031.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	}
	function Add()
	{
	CalculateM();
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+o.txtlv913.value+"&txtlv014="+o.txtlv914.value+"&txtlv015="+o.txtlv915.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>wh_lv0031/wh_lv0031.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0050','lv003');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
			case 'WEBTRANSAC':
				LoadPopupParentSecond(to,'txtlv806','wb_lv0016','concat(lv002,@! @!,lv005,@! @!,lv009,@! @!,lv015,@! =@!,lv001)');
				break;
		}
	}
	function LoadSource()
	{
	var o=document.frmadd;
	var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'WEBTRANSAC':
				ajax_do ('sl_lv0026/sl_lv0026excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}		
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv911.value/100);
		o.txtlv910amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv910.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv910amount.value)+parseFloat(o.txtlv904.value*o.txtlv908.value);
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('sl_lv0026/sl_lv0026exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
	}
	function Report(vValue)
	{
	var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rpten&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
		var fun1="Report2('"+vValue+"')";
		setTimeout(fun1,100);
	}
	function Report2(vValue)
	{
		var o=document.frmprocess1;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}	
	function resizeframe()
	{
		var frmleft=document.getElementById("idframe_left");
		var frmright=document.getElementById("idframe_right");
		if(frmleft.style.width=="100%")
		{
			frmleft.style.width="28%";
			frmright.style.width="70%";
		}
		else
		{
			frmleft.style.width="100%";
			frmright.style.width="100%";
		}	
	}
	-->
	</script>
</head>
<?php
if($mosl_lv0050->GetView()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">

<div style="clear:both">
	<div ondblclick="resizeframe()" id="idframe_left" style="float:left;width:28%;overflow:auto;display:auto;height:500px;background-color:#fff">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="left">
			<form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
			<?php 
			$mosl_lv0050->LV_BuilTree($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,'CONTRACTS');
			?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
				  </form>
			</td>
		</tr>
	</table>
	</div>
	<div id="idframe_right" style="float:right;width:70%;overflow:auto;display:auto;height:500px;" >
	
	</div>
	</div>
	 <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
 <form method="post" enctype="multipart/form-data" name="frmprocess1" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>				  
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[53];?>';
function ViewContract(value)
{
	var strvalue="&ChildID="+value;
	var str="<br><iframe id='lvframefrm' height=500 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>sl_lv0053/?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('idframe_right');
	div.innerHTML=str;
	
}
function CheckAprUnApr(o,value)
{
	$xmlhttp=null;
	if(value=="") 
	{
	alert("Xin vui long nhap tên đăng nhập");
	return false;
	}
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	if(o.checked==true)
		url=url+"?&apr_ajax=ajaxcheck"+"&contractid="+value;
	else
		url=url+"?&unapr_ajax=ajaxcheck"+"&contractid="+value;
	url=url.replace("#","");
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}
function stateChanged()
{
	if (xmlhttp.readyState==4)
	{
		var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		
		var obj=document.getElementById('color_'+domainid);
		if(obj.style.color=="red")
			obj.style.color="";
		else
			obj.style.color="red";
	}
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
<?php
} else {
	include ("permit.php");
}	
?>
</html>