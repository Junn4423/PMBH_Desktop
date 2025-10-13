<?php
session_start();
if($_GET['ContractID']!="") $vDir='../';
require_once($vDir."config.php");
require_once($vDir."configrun.php");
require_once($vDir."function.php");
require_once($vDir."librarianconfig.php");
require_once($vDir."excfile.php");
require_once($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0053.php");
require_once("$vDir../clsall/sl_lv0013.php");
/////////////init object//////////////
$mosl_lv0053=new sl_lv0053($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0053');
$mosl_lv0053->Dir=$vDir;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0029.txt",$plang);
$mosl_lv0053->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0053->ArrPush[0]=$vLangArr[17];
$mosl_lv0053->ArrPush[1]=$vLangArr[18];
$mosl_lv0053->ArrPush[2]=$vLangArr[19];
$mosl_lv0053->ArrPush[3]=$vLangArr[20];
$mosl_lv0053->ArrPush[4]=$vLangArr[21];
$mosl_lv0053->ArrPush[5]=$vLangArr[22];
$mosl_lv0053->ArrPush[6]=$vLangArr[23];
$mosl_lv0053->ArrPush[7]=$vLangArr[24];
$mosl_lv0053->ArrPush[8]=$vLangArr[25];
$mosl_lv0053->ArrPush[9]=$vLangArr[26];
$mosl_lv0053->ArrPush[10]=$vLangArr[27];
$mosl_lv0053->ArrPush[11]=$vLangArr[28];
$mosl_lv0053->ArrPush[12]=$vLangArr[29];
$mosl_lv0053->ArrPush[13]=$vLangArr[30];
$mosl_lv0053->ArrPush[14]=$vLangArr[31];
$mosl_lv0053->ArrPush[15]=$vLangArr[32];
$mosl_lv0053->ArrPush[16]=$vLangArr[33];
$mosl_lv0053->ArrPush[17]=$vLangArr[46];
$mosl_lv0053->ArrPush[18]=$vLangArr[47];
$mosl_lv0053->ArrPush[19]=$vLangArr[48];
$mosl_lv0053->ArrPush[20]=$vLangArr[49];
$mosl_lv0053->ArrPush[21]=$vLangArr[41];
$mosl_lv0053->ArrPush[26]=$vLangArr[54];

$mosl_lv0053->ArrFunc[0]='//Function';
$mosl_lv0053->ArrFunc[1]=$vLangArr[2];
$mosl_lv0053->ArrFunc[2]=$vLangArr[4];
$mosl_lv0053->ArrFunc[3]=$vLangArr[6];
$mosl_lv0053->ArrFunc[4]=$vLangArr[7];
$mosl_lv0053->ArrFunc[5]='';
$mosl_lv0053->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0053->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0053->ArrFunc[8]=$vLangArr[10];
$mosl_lv0053->ArrFunc[9]=$vLangArr[12];
$mosl_lv0053->ArrFunc[10]=$vLangArr[0];
$mosl_lv0053->ArrFunc[11]=$vLangArr[36];
$mosl_lv0053->ArrFunc[12]=$vLangArr[37];
$mosl_lv0053->ArrFunc[13]=$vLangArr[38];
$mosl_lv0053->ArrFunc[14]=$vLangArr[39];
$mosl_lv0053->ArrFunc[15]=$vLangArr[40];

////Other
$mosl_lv0053->ArrOther[1]=$vLangArr[34];
$mosl_lv0053->ArrOther[2]=$vLangArr[35];
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
	$vresult=$mosl_lv0053->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0053",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0053->lv001=$_POST['txtlv001'];
if($_GET['ContractID']=="")
 $mosl_lv0053->lv002=$_POST['txtlv002'];
else
$mosl_lv0053->lv002=$_GET['ContractID'];
$mosl_lv0053->lv003=$_POST['txtlv003'];
$mosl_lv0053->lv004=$_POST['txtlv004'];
$mosl_lv0053->lv005=$_POST['txtlv005'];
$mosl_lv0053->lv006=$_POST['txtlv006'];
$mosl_lv0053->lv007=$_POST['txtlv007'];
$mosl_lv0053->lv008=$_POST['txtlv008'];
$mosl_lv0053->lv009=$_POST['txtlv009'];
$mosl_lv0053->lv010=$_POST['txtlv010'];
$mosl_lv0053->lv011=$_POST['txtlv011'];
$mosl_lv0053->lv012=$_POST['txtlv012'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0053->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mosl_lv0053->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0053->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0053');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0053->ListView;
$curPage = $mosl_lv0053->CurPage;
$maxRows =$mosl_lv0053->MaxRows;
$vOrderList=$mosl_lv0053->ListOrder;
$vSortNum=$mosl_lv0053->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0053->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0053',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($_GET['ContractID']=="")
 $mosl_lv0053->lv002=$_POST['txtlv002'];
else
$mosl_lv0053->lv002=$_GET['ContractID'];
$lvgetdata=$_POST['lvgetdata'];
if($lvgetdata=="" || $lvgetdata==NULL)
{
	if($mosl_lv0053->lv002!="" && $mosl_lv0053->lv002!=NULL)
	{
		$mosl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
		$mosl_lv0013->LV_LoadID($mosl_lv0053->lv002);
		$lvgetdata=(int)$mosl_lv0013->lv015;
	}
	else
	$lvgetdata=0;
}
 $mosl_lv0053->lvgetdata=$lvgetdata;
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0053->GetCount();
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
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ContractID=<?php echo $_GET['ContractID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=650 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>sl_lv0053/?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&childdetailfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ContractID=<?php echo $_GET['ContractID'];?>&ChildDetailID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.target="_self";
	o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ContractID=<?php echo $_GET['ContractID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
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
	o.target="_self";
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>"+"&ID=<?php echo $_GET['ID']?>&ContractID=<?php echo $_GET['ContractID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
//-->
</script>
<?php
if($mosl_lv0053->GetView()==1)
{
?>
<body  onkeyup="KeyPublicRun(event)">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onSubmit="return false;" action="?func=<?php echo $_GET['func'];?>&childfunc=<?php echo $_GET['childfunc'];?>&ContractID=<?php echo $_GET['ContractID'];?>&ID=<?php echo $_GET['ID']?>&<?php  echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
                      <select name="lvgetdata" id="lvgetdata" style="width:50%" onChange="document.frmchoose.submit();">
                      	<option value="0" <?php echo ($lvgetdata=='0')?'selected':''?> ><?php echo $vLangArr[50];?></option>
                        <option value="1" <?php echo ($lvgetdata=='1')?'selected':''?> ><?php echo $vLangArr[51];?></option>
                        <option value="2" <?php echo ($lvgetdata=='2')?'selected':''?> ><?php echo $vLangArr[52];?></option>
                        <option value="2" <?php echo ($lvgetdata=='2')?'selected':''?> ><?php echo $vLangArr[53];?></option>
                        
                        
                      </select>
						<?php echo $mosl_lv0053->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0053->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0053->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0053->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0053->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0053->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0053->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0053->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mosl_lv0053->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mosl_lv0053->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mosl_lv0053->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mosl_lv0053->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mosl_lv0053->lv012;?>"/>
					

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
div.innerHTML='<?php echo $mosl_lv0053->ArrPush[0];?>';	
</script>
</html>