<?php
$vDir='';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0067.php");
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
/////////////init object//////////////
$mosl_lv0067=new sl_lv0067($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0067');
$mosl_lv0067->Dir=$vDir;
$month=getmonth($_POST['txtMonthYear']);
$year=getyear($_POST['txtMonthYear']);
if($month=='' || $month==NULL)
{
	$vNow=GetServerDate();
	$month=Fillnum(getmonth($vNow),2);
	$year=Fillnum(getyear($vNow),4);
}

if((int)$month==1)
{
	$month_re=12;
	$year_re=$year -1;
}
else
{
	$month_re=$month-1;
	$year_re=$year;
}
$mosl_lv0067->lv004=$year."-".$month;

if($plang=="") $plang="EN";
		$vLangArr=GetLangFile("$vDir../","SL0078.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0067->ArrPush[0]=$vLangArr[18];
$mosl_lv0067->ArrPush[1]=$vLangArr[19];
$mosl_lv0067->ArrPush[2]=$vLangArr[21];
$mosl_lv0067->ArrPush[3]=$vLangArr[20];
$mosl_lv0067->ArrPush[4]=$vLangArr[22];
$mosl_lv0067->ArrPush[5]=$vLangArr[23];
$mosl_lv0067->ArrPush[6]=$vLangArr[24];
$mosl_lv0067->ArrPush[7]=$vLangArr[25];


$mosl_lv0067->ArrFunc[0]='//Function';
$mosl_lv0067->ArrFunc[1]=$vLangArr[2];
$mosl_lv0067->ArrFunc[2]=$vLangArr[4];
$mosl_lv0067->ArrFunc[3]=$vLangArr[6];
$mosl_lv0067->ArrFunc[4]=$vLangArr[7];
$mosl_lv0067->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0067->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0067->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0067->ArrFunc[8]=$vLangArr[10];
$mosl_lv0067->ArrFunc[9]=$vLangArr[12];
$mosl_lv0067->ArrFunc[10]=$vLangArr[0];
$mosl_lv0067->ArrFunc[11]=$vLangArr[31];
$mosl_lv0067->ArrFunc[12]=$vLangArr[32];
$mosl_lv0067->ArrFunc[13]=$vLangArr[33];
$mosl_lv0067->ArrFunc[14]=$vLangArr[34];
$mosl_lv0067->ArrFunc[15]=$vLangArr[35];
////Other
$mosl_lv0067->ArrOther[1]=$vLangArr[29];
$mosl_lv0067->ArrOther[2]=$vLangArr[30];
$mosl_lv0067->ArrTimeCordPush[]=$vLangArr[31];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];
if(strpos($vFieldList,'lv001')===false) $vFieldList='lv001,'.$vFieldList;
$vOrderList=$_POST['txtOrderList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0009->LV_AprovalAll($month,$year);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$motc_lv0009->LV_UnAprovalAll($month,$year);
}
elseif($flagID==5)
{
	$vresult=$motc_lv0009->LV_UpdatePreHSo($month,$year);
	$vresult=$motc_lv0008->LV_UpdateFN(GetServerDate());
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0067->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0067');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0067->ListView;
$curPage = $mosl_lv0067->CurPage;
$maxRows =$mosl_lv0067->MaxRows;
$vOrderList=$mosl_lv0067->ListOrder;
$vSortNum=$mosl_lv0067->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0067->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0067',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
$mosl_lv0067->lvNVID=$_GET['ID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0067->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
$mosl_lv0067->month=$month;
$mosl_lv0067->year=$year;
$mosl_lv0067->lv004=$year."-".$month;
$mosl_lv0067->datefrom=$year."-".$month."-01";
$mosl_lv0067->dateto=$year."-".$month."-".Fillnum(GetDayInMonth($year,(int)$month),2);
$mosl_lv0067->lv028="";
$mosl_lv0067->lv029=$_POST['txtlv029'];
$mosl_lv0067->lv001=$_POST['txtlv001'];
if($mosl_lv0067->GetApr()==0)
{	
	$mosl_lv0067->lv028=$mosl_lv0067->Get_User($_SESSION['ERPSOFV2RUserID'],'lv002');
	$mosl_lv0067->lv001=$mosl_lv0067->Get_User($_SESSION['ERPSOFV2RUserID'],'lv006');
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<style type="text/css">
.lvsizeinput
{width:60px;
border:1;
}
.lvsizeinput2
{width:180px;
border:1;
}
.lvsizeselect
{width:160px;
border:1;
}
.lvsizeselect2
{width:60px;
border:1;
}
</style>
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>','filter');
}
function Save()
	{
		var o=document.frmchoose;

				o.txtFlag.value="1";
				o.submit();
		
	}
function viewpopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="block";
}
function closepopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="none";
}

//////////////RunFunction/////////////////////////
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1000 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>sl_lv0067?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ID=<?php echo $_GET['ID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
	
}
function UpdatePreHso()
{
var o=document.frmchoose;
	o.txtFlag.value=5;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function Apr()
{
var o=document.frmchoose;
	o.txtFlag.value=3;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function UnApr()
{
var o=document.frmchoose;
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function Rpt()
{
lv_chk_list(document.frmchoose,'lvChk',4);
}
///////////////////////////Report/////////////////////
function Report(vValue)
{
var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rpten&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function ChangeTimeCard(o)
{
var o1=document.frmchoose;
 	o1.submit();
}
function ChangeTimeCard1(o)
{
var o1=document.frmchoose;
	o1.txtMonthYear.value=o.value;
 	o1.submit();
}
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
}
function ChangePre()
{
var o1=document.frmchoose;
var month=parseFloat( o1.month.value);
var year=parseFloat(o1.year.value);
if(month==1)
{
	year=year-1;
	month=12;
	SetYear(year);
}
else
{
	month=month-1;
}
if(month>=10)
	o1.txtMonthYear.value=year+'-'+month;
else
	o1.txtMonthYear.value=year+'-0'+month;
 	o1.submit();
}
function ChangeNext()
{
var o1=document.frmchoose;
var month=parseFloat( o1.month.value);
var year=parseFloat(o1.year.value);

if(month==parseFloat(12))
{
	year=year+1;
	month=1;
	SetYear(year);
}
else
{
	month=parseFloat(month)+1;

}
if(month>=parseFloat(10))
{
	o1.txtMonthYear.value=year+'-'+month;
}
else
{
	o1.txtMonthYear.value=year+'-0'+month;
}
 	o1.submit();
}
function SetYear(years)
{
var o1=document.frmchoose;
	for(i=0;i<12;i++)
	{
	 if(parseInt(i)<10)
	 	o1.txtMonthYear.options[i].value=years+'-0'+(i+1);
	 else 
	 	o1.txtMonthYear.options[i].value=years+'-'+(i+1);
	
	}
	
}
function settime8hour(oj)
{
	var i=0;
	for(i=1;i<=31;i++)
	{
	 	var o=document.getElementById("txtlv005"+i);
	 	  if(o!= null)
	 	  {
		 	  if(oj.checked)
		 	  {
			 	  if(o.parentElement.parentElement.className!="lvlinehtable3")
		 	   o.value="08:00:00";
		 	  }
		 	  else
		 		 o.value="00:00:00";
	 	  }
	}
}
//-->
</script>
<?php
if($mosl_lv0067->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

			
					<div><div id="lvleft">
                    <form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['child'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <p>
					    <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					   
					    <input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()">
					   
					    <select id="txtMonthYear" name="txtMonthYear" onChange="ChangeTimeCard(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select><input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()"> 
					Phòng ban<select  name="txtlv029"  id="txtlv029"  tabindex="1" maxlength="255" style="width:100px" onKeyPress="return CheckKey(event,7)" onChange="ChangeInfor()"><option value=''>...</option><?php echo $mosl_lv0067->LV_GetChildDepSelect($mosl_lv0067->lv028,$mosl_lv0067->lv029);?></select> Mã nhân viên <input type="text" name="txtlv001" id="txtlv001" value="<?php echo $mosl_lv0067->lv001;?>" onChange="ChangeInfor()"/>
					    <?php 
						echo $mosl_lv0067->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmprocess','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum,0,$_POST['chkviewinfo']);?>
						  <?php 
						//  if((int)$_POST['chkviewinfo']==1)
						//echo $mosl_lv0067->GetTimeCode($mosl_lv0067->lvNVID,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'1');?>
					    <input name="txtStringID" type="hidden" id="txtStringID" />
					    <input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
					    <input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
					    <input name="txtFlag" type="hidden" id="txtFlag" value="2"/><input type="button" id="txtPre" name="txtPre" value="Previous" onClick="ChangePre()"><select id="txtMonthYear1" name="txtMonthYear1" onChange="ChangeTimeCard1(this)">
						
					<?php
						
						for($i=1;$i<13;$i++)
						{
						if((int)$month==$i)
							echo '<option selected="selected" value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						else
							echo '<option value="'.$year."-".Fillnum($i,2).'">'.Fillnum($i,2)."-".$year.'</option>';
						}
					?>	
					</select><input type="button" id="txtPre" name="txtPre" value="Next" onClick="ChangeNext()">
					<input type="hidden" name="month" id="month" value="<?php echo $month;?>"/>
					<input type="hidden" name="year" id="year" value="<?php echo $year;?>"/>
					</form>
				<form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
						<input type="hidden" name="childfunc" id="year" value="rpt"/>
				  </form>
				  
</div></div>
</body>
				
<?php
} else {
	include("../sl_lv0067/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0067->ArrPush[0];?>';	
		function UpdateMonthly(value,vEmpID,codeid,vopt)
		{
			$xmlhttp=null;
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
			else
				url=url+"&ajaxmonth=month"+"&monthid="+value+"&value="+codeid+"&choose="+vopt+"&curday=<?php echo $year."-".$month."-01";?>&EmpID="+vEmpID;
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
				var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(parseInt(domainid)==3) 
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="Mở khóa";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',4);
						}
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="blue";
						document.getElementById('btmonth_'+domainid1).value="Mở khóa";
					}
				}
				if(parseInt(domainid)==4)
				{
					if(parseInt(domainid2)==1)
					{
						//document.getElementById("btmonth_"+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).value="Khóa";
						document.getElementById('btmonth_'+domainid1).onclick = function(){
						UpdateMonthly(domainid1,'','',3);
						}
						
					}
					else
					{
						document.getElementById('btmonth_'+domainid1).style.color="black";
						document.getElementById('btmonth_'+domainid1).disabled =true;
						document.getElementById('btmonth_'+domainid1).value="Khóa";
						
						
					}
				}
			}
		}
		function runchangetime(value,lvNVID,codeid)
		{
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=''+url;			
			var n = url.indexOf("?"); 
			if(n<0)
				url=url+"?&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			else
				url=url+"&ajaxpro=program"+"&timecardid="+value+"&codeid="+codeid+"&NVID="+lvNVID;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedProgram;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
		function stateChangedProgram()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain=xmlhttp1.responseText.indexOf('[CONGP]')+7;
				var enddomain=xmlhttp1.responseText.indexOf('[ENDCONGP]');
				var domainid=xmlhttp1.responseText.substr(startdomain,enddomain-startdomain);				
				var startdomain1=xmlhttp1.responseText.indexOf('[CONGPDEF]')+10;
				var enddomain1=xmlhttp1.responseText.indexOf('[ENDCONGPDEF]');
				var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
				var startdomain2=xmlhttp1.responseText.indexOf('[CONGPDIS]')+10;
				var enddomain2=xmlhttp1.responseText.indexOf('[ENDCONGPDIS]');
				var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
				if(domainid1=='B')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							alert('Công B không còn để dùng');
						}
				}
				else if(domainid1=='P')
				{
					if(parseInt(domainid)<=0) 
						{
							document.getElementById('timecard_'+domainid2).value="";
							alert('Công P không còn để dùng');
						}
				}
				else
				{
				}
				//document.getElementById('txtlv911').value=domainid2;
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
</html>