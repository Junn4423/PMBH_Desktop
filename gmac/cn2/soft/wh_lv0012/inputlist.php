<?php
$vDir='../';
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/wh_lv0012.php");

/////////////init object//////////////
$mowh_lv0012=new wh_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0012');
$mowh_lv0012->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","WH0042.txt",$plang);
$mowh_lv0012->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0012->ArrPush[0]=$vLangArr[17];
$mowh_lv0012->ArrPush[1]=$vLangArr[18];
$mowh_lv0012->ArrPush[2]=$vLangArr[19];
$mowh_lv0012->ArrPush[3]=$vLangArr[20];
$mowh_lv0012->ArrPush[4]=$vLangArr[21];
$mowh_lv0012->ArrPush[5]=$vLangArr[22];
$mowh_lv0012->ArrPush[6]=$vLangArr[23];
$mowh_lv0012->ArrPush[7]=$vLangArr[24];
$mowh_lv0012->ArrPush[8]=$vLangArr[25];
$mowh_lv0012->ArrPush[9]=$vLangArr[26];
$mowh_lv0012->ArrPush[10]=$vLangArr[27];
$mowh_lv0012->ArrPush[11]=$vLangArr[28];
$mowh_lv0012->ArrPush[12]=$vLangArr[29];
$mowh_lv0012->ArrPush[13]=$vLangArr[30];
$mowh_lv0012->ArrPush[14]=$vLangArr[31];
$mowh_lv0012->ArrPush[15]=$vLangArr[32];

$mowh_lv0012->ArrFunc[0]='//Function';
$mowh_lv0012->ArrFunc[1]=$vLangArr[2];
$mowh_lv0012->ArrFunc[2]=$vLangArr[4];
$mowh_lv0012->ArrFunc[3]=$vLangArr[6];
$mowh_lv0012->ArrFunc[4]=$vLangArr[7];
$mowh_lv0012->ArrFunc[5]='';
$mowh_lv0012->ArrFunc[6]='';
$mowh_lv0012->ArrFunc[7]='';
$mowh_lv0012->ArrFunc[8]=$vLangArr[10];
$mowh_lv0012->ArrFunc[9]=$vLangArr[12];
$mowh_lv0012->ArrFunc[10]=$vLangArr[0];
$mowh_lv0012->ArrFunc[11]=$vLangArr[33];
$mowh_lv0012->ArrFunc[12]=$vLangArr[34];
$mowh_lv0012->ArrFunc[13]=$vLangArr[35];
$mowh_lv0012->ArrFunc[14]=$vLangArr[36];
$mowh_lv0012->ArrFunc[15]=$vLangArr[37];

////Other
$mowh_lv0012->ArrOther[1]=$vLangArr[31];
$mowh_lv0012->ArrOther[2]=$vLangArr[32];
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

//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0012->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0012');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mowh_lv0012->ListView;
$curPage = $mowh_lv0012->CurPage;
$maxRows =$mowh_lv0012->MaxRows;
$vOrderList=$mowh_lv0012->ListOrder;
$vSortNum=$mowh_lv0012->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mowh_lv0012->SaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0012',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	for($i=$curRow+1;$i<$maxRows+$curRow+1;$i++)
	{
		if($i<=$totalRowsC)
		{
		$mowh_lv0012->lv001=$_POST['txtlv001'.$i];
		$mowh_lv0012->lv002=$_POST['txtlv002'.$i];
		$mowh_lv0012->lv004=$_POST['txtlv004'.$i];
		$mowh_lv0012->lv005=$_POST['txtlv005'.$i];
		$mowh_lv0012->lv006=$_POST['txtlv006'.$i];
		$mowh_lv0012->lv007=$_POST['txtlv007'.$i];
		$mowh_lv0012->lv008=$_POST['txtlv008'.$i];
		$mowh_lv0012->lv009=$_POST['txtlv009'.$i];
		$mowh_lv0012->lv010=$_POST['txtlv010'.$i];
		$mowh_lv0012->lv011=$_POST['txtlv011'.$i];
		$mowh_lv0012->lv012=$_POST['txtlv012'.$i];
		$mowh_lv0012->lv013=$_POST['txtlv013'.$i];
		$vresult=$mowh_lv0012->LV_UpdateOther();
		}
	}
		$mowh_lv0012->lv001='';
		$mowh_lv0012->lv002='';
		$mowh_lv0012->lv004='';
		$mowh_lv0012->lv005='';
		$mowh_lv0012->lv006='';
		$mowh_lv0012->lv007='';
		$mowh_lv0012->lv008='';
		$mowh_lv0012->lv009='';
		$mowh_lv0012->lv010='';
		$mowh_lv0012->lv011='';
		$mowh_lv0012->lv012='';
		$mowh_lv0012->lv013='';
}
$mowh_lv0012->lv003=$_GET['ID'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0012->GetCount();
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ID=<?php echo $_GET['ID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=600 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>wh_lv0012?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ID=<?php echo $_GET['ID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Save()
	{
		var o=document.frmchoose;

				o.txtFlag.value="1";
				o.submit();
		
	}
//-->
</script>
<?php
if($mowh_lv0012->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ChildID=<?php echo $_GET['ChildID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mowh_lv0012->LV_BuilListInput($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
					
					

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
div.innerHTML='<?php echo $mowh_lv0012->ArrPush[0];?>';	
</script>
</html>