<?php
session_start(); 
unset( $_SESSION['NodesHasBeenAddedCheckBox'] );
unset( $_SESSION['treeviewcheckbox'] );
unset( $_SESSION['treeviewcheckbox'] );
if (isset( $_SESSION['NodesHasBeenAddedCheckBox'] )) {
	session_destroy();
}
if (isset( $_SESSION['treeviewcheckbox'] )) {
	session_destroy();
}
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/lv_lv0007.php");

/////////////init object//////////////
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
$molv_lv0007->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","LV0003.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->ArrPush[0]=$vLangArr[17];
$molv_lv0007->ArrPush[1]=$vLangArr[18];
$molv_lv0007->ArrPush[2]=$vLangArr[20];
$molv_lv0007->ArrPush[3]=$vLangArr[22];
$molv_lv0007->ArrPush[4]=$vLangArr[23];
$molv_lv0007->ArrPush[5]=$vLangArr[21];
$molv_lv0007->ArrPush[6]=$vLangArr[24];
$molv_lv0007->ArrPush[7]=$vLangArr[25];
$molv_lv0007->ArrPush[8]=$vLangArr[26];
$molv_lv0007->ArrPush[9]='DeActive';
$molv_lv0007->ArrPush[10]='UserControl';
$molv_lv0007->ArrPush[11]='IPLogin';
$molv_lv0007->ArrPush[101]='Chi nhánh';

$molv_lv0007->ArrFunc[0]='//Function';
$molv_lv0007->ArrFunc[1]=$vLangArr[2];
$molv_lv0007->ArrFunc[2]=$vLangArr[4];
$molv_lv0007->ArrFunc[3]=$vLangArr[6];
$molv_lv0007->ArrFunc[4]=$vLangArr[7];
$molv_lv0007->ArrFunc[5]='';
$molv_lv0007->ArrFunc[6]='DeActive';
$molv_lv0007->ArrFunc[7]='Active';
$molv_lv0007->ArrFunc[8]=$vLangArr[10];
$molv_lv0007->ArrFunc[9]=$vLangArr[12];
$molv_lv0007->ArrFunc[10]=$vLangArr[0];
$molv_lv0007->ArrFunc[11]=$vLangArr[29];
$molv_lv0007->ArrFunc[12]=$vLangArr[30];
$molv_lv0007->ArrFunc[13]=$vLangArr[31];
$molv_lv0007->ArrFunc[14]=$vLangArr[32];
$molv_lv0007->ArrFunc[15]=$vLangArr[33];
////Other
$molv_lv0007->ArrOther[1]=$vLangArr[27];
$molv_lv0007->ArrOther[2]=$vLangArr[28];
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
	$vresult=$molv_lv0007->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"lv_lv0007",$lvMessage);
}
elseif($flagID==2)
{
$molv_lv0007->lv001=$_POST['txtlv001'];
$molv_lv0007->lv002=$_POST['txtlv002'];
$molv_lv0007->lv003=$_POST['txtlv003'];
$molv_lv0007->lv004=$_POST['txtlv004'];
$molv_lv0007->lv005=$_POST['txtlv005'];
$molv_lv0007->lv006=$_POST['txtlv006'];
$molv_lv0007->lv007=$_POST['txtlv007'];
$molv_lv0007->lv099=$_POST['txtlv099'];
}
elseif($flagID==3)///Admin Mode
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Delete($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_Aproval($strar);
}
elseif($flagID==5)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$molv_lv0007->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$molv_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$molv_lv0007->ListView;
$curPage = $molv_lv0007->CurPage;
$maxRows =$molv_lv0007->MaxRows;
$vOrderList=$molv_lv0007->ListOrder;
$vSortNum=$molv_lv0007->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$molv_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'lv_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$molv_lv0007->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="StyleSheet" href="<?php echo $vDir;?>../css/menu.css" type="text/css">	
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/pubscript.js"></script>
</head>
<script language="JavaScript" type="text/javascript">
<!--
	function AddUser()
	{
		 var o=document.frmcomtemp;
 		 o.target="_self"; 
		 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,1,0,0,0);?>"
		 o.submit();
	}
	function KindOfUser()
	{
		 var o=document.frmcomtemp;
 		 o.target="_self"; 
		 o.txtFlagControl.value="1";
		 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,5,0,0,0);?>"
		 o.submit();
	}
	function AddPer()
	{
		Chked2Submit(document.frmchoose,'lvChk',6)
	}
	function AddPermission(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,3,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	function ViewLogtime(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,4,0,0,0);?>";
		o.target="_self";
		o.submit();
	}
	function ViewLogtimes()
	{
		Chked2Submit(document.frmchoose,'lvChk',9);
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
		 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
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
			o.txtFlag.value=5;
			 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,4,0);?>"
			 o.submit();
	}
	function Help()
	{
		'http://www.sof.vn?option=com_content&amp;sectionid=0#';
	}

	function Reset()
	{
		Chked2Submit(document.frmchoose,"lvChk",26);
	}
	function ResetPass(vValue)
	{
		var o=document.frmcomtemp;
		o.txtlv001.value=vValue;
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,17,0,0,0);?>";
		o.target="_self";
		o.submit();
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>lv_lv0007?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
//-->
</script>
<?php
if($molv_lv0007->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div class="hd_cafe">
	<ul class="qlycafe">
	
		<li><div class="licafe" onclick="ViewLogtimes()">&nbsp;&nbsp;XEM LOG&nbsp;&nbsp;</div></li>
		<li><div class="licafe" style="padding:0px;background:#f2f2f2;"><?php echo $molv_lv0007->TabAddPer();?></div></li>
		<li><div class="licafe" style="padding:0px;background:#f2f2f2;"><?php echo $molv_lv0007->TabReset();?></div></li>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;</li>		
	</ul>
</div>		
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
					  <table style="background:#f2f2f2;font:10px arial;width:100%;">
						<tr>
							<td>
					  
					  </td>
						</tr>
					</table>
						<?php echo $molv_lv0007->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $molv_lv0007->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002"  value="<?php echo $molv_lv0007->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $molv_lv0007->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $molv_lv0007->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $molv_lv0007->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $molv_lv0007->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $molv_lv0007->lv007;?>"/>
						<input type="hidden" name="txtlv099" id="txtlv099" value="<?php echo $molv_lv0007->lv099;?>"/>
					    
				  </form>
				<form action="" name="frmcomtemp" method="post" target="_blank" enctype="multipart/form-data">
						<input type="hidden" name="txtlv001" id="txtlv001" />
						<input type="hidden" name="txtFlagControl" id="txtFlagControl" value="2" />
						<input type="hidden" name="curPg" id="curPg" value="">						
						<input type="hidden" name="txtSQL" id="txtSQL" value="<?php echo $psql;?>" />
					</form>
				  
</div></div>
</body>
				
<?php
} else {
	include("../lv_lv0007/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $molv_lv0007->ArrPush[0];?>';	
</script>
</html>