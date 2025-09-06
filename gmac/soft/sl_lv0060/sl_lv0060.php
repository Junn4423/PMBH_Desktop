<?php
if($_GET['ID']!="") $vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0060.php");

/////////////init object//////////////
$mosl_lv0060=new sl_lv0060($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0060');
$mosl_lv0060->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0072.txt",$plang);
$mosl_lv0060->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0060->ArrPush[0]=$vLangArr[17];
$mosl_lv0060->ArrPush[1]=$vLangArr[18];
$mosl_lv0060->ArrPush[2]=$vLangArr[19];
$mosl_lv0060->ArrPush[3]=$vLangArr[20];
$mosl_lv0060->ArrPush[4]=$vLangArr[21];
$mosl_lv0060->ArrPush[5]=$vLangArr[22];
$mosl_lv0060->ArrPush[6]=$vLangArr[23];
$mosl_lv0060->ArrPush[7]=$vLangArr[24];
$mosl_lv0060->ArrPush[8]=$vLangArr[25];

$mosl_lv0060->ArrFunc[0]='//Function';
$mosl_lv0060->ArrFunc[1]=$vLangArr[2];
$mosl_lv0060->ArrFunc[2]=$vLangArr[4];
$mosl_lv0060->ArrFunc[3]=$vLangArr[6];
$mosl_lv0060->ArrFunc[4]=$vLangArr[7];
$mosl_lv0060->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0060->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0060->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0060->ArrFunc[8]=$vLangArr[10];
$mosl_lv0060->ArrFunc[9]=$vLangArr[12];
$mosl_lv0060->ArrFunc[10]=$vLangArr[0];
$mosl_lv0060->ArrFunc[11]=$vLangArr[28];
$mosl_lv0060->ArrFunc[12]=$vLangArr[29];
$mosl_lv0060->ArrFunc[13]=$vLangArr[30];
$mosl_lv0060->ArrFunc[14]=$vLangArr[31];
$mosl_lv0060->ArrFunc[15]=$vLangArr[32];

////Other
$mosl_lv0060->ArrOther[1]=$vLangArr[26];
$mosl_lv0060->ArrOther[2]=$vLangArr[27];
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
	$vresult=$mosl_lv0060->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0060",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0060->lv001=$_POST['txtlv001'];
$lvsl_lv0060->lv002=$_POST['txtlv002'];
$mosl_lv0060->lv003=$_POST['txtlv003'];
$mosl_lv0060->lv004=$_POST['txtlv004'];
$mosl_lv0060->lv005=$_POST['txtlv005'];
$mosl_lv0060->lv006=$_POST['txtlv006'];
$mosl_lv0060->lv007=$_POST['txtlv007'];
$mosl_lv0060->lv008=$_POST['txtlv008'];
$mosl_lv0060->lv009=$_POST['txtlv009'];
$mosl_lv0060->lv010=$_POST['txtlv010'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0060->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0060->LV_UnAproval($strar);
}
elseif($flagID==6)
{
	$mosl_lv0060->lv001=$_POST['qxtlv001'];
	$mosl_lv0060->lv002=$_GET['ID'];
	$mosl_lv0060->lv003=$_POST['qxtlv003'];
	$mosl_lv0060->lv004=$_POST['qxtlv004'];
	$mosl_lv0060->lv005=$_POST['qxtlv005'];
	$mosl_lv0060->lv006=$_POST['qxtlv006'];
	$mosl_lv0060->lv007=$_POST['qxtlv007'];
	$vresult=$mosl_lv0060->LV_Insert();	
	if(!$vresult)
	{
		$mosl_lv0060->Values['lv001']=$_POST['qxtlv001'];
		$mosl_lv0060->Values['lv002']=$_GET['ID'];
		$mosl_lv0060->Values['lv003']=$_POST['qxtlv003'];
		$mosl_lv0060->Values['lv004']=$_POST['qxtlv004'];
		$mosl_lv0060->Values['lv005']=$_POST['qxtlv005'];
		$mosl_lv0060->Values['lv006']=$_POST['qxtlv006'];
		$mosl_lv0060->Values['lv007']=$_POST['qxtlv007'];
		echo sof_error();	
	}
	$mosl_lv0060->lv001='';
	$mosl_lv0060->lv002='';
	$mosl_lv0060->lv003='';
	$mosl_lv0060->lv004='';
	$mosl_lv0060->lv005='';
	$mosl_lv0060->lv006='';
	$mosl_lv0060->lv007='';
}
$mosl_lv0060->Values['lv002']=$_GET['ID'];
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0060->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0060');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0060->ListView;
$curPage = $mosl_lv0060->CurPage;
$maxRows =$mosl_lv0060->MaxRows;
$vOrderList=$mosl_lv0060->ListOrder;
$vSortNum=$mosl_lv0060->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0060->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0060',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($_GET['ID']=="")
$mosl_lv0060->lv002=$_POST['txtlv002'];
else
$mosl_lv0060->lv002=$_GET['ID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0060->GetCount();
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1500 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0060?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.action="<?php echo $vDir;?>sl_lv0060?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function Save()
	{
		var o=document.frmchoose;
		o.txtFlag.value=6;
		if(o.qxtlv002.value==""){
			alert("Xin vui lòng nhập tên");
			o.qxtlv002.focus();
		}	
		else if(o.qxtlv003.value==""){
			alert("Mã sản phẩm không rỗng!");
			o.qxtlv003.focus();
		}	
		else
		{
			o.submit();
		}
	}
	setTimeout(focusmain,1000);
function focusmain()
{
	document.getElementById('qxtlv003').focus();
}
//-->
</script>
<?php
if($mosl_lv0060->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php 
						
						echo $mosl_lv0060->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0060->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0060->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0060->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0060->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0060->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0060->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0060->lv007;?>"/>				
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
div.innerHTML='<?php echo $mosl_lv0060->ArrPush[0];?>';	
</script>
</html>