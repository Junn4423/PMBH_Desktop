<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ac_lv0018.php");

/////////////init object//////////////
$moac_lv0018=new ac_lv0018($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0018');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","AC0007.txt",$plang);
$moac_lv0018->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0018->ArrPush[0]=$vLangArr[17];
$moac_lv0018->ArrPush[1]=$vLangArr[18];
$moac_lv0018->ArrPush[2]=$vLangArr[19];
$moac_lv0018->ArrPush[3]=$vLangArr[20];
$moac_lv0018->ArrPush[4]=$vLangArr[21];
$moac_lv0018->ArrPush[5]=$vLangArr[22];
$moac_lv0018->ArrPush[6]=$vLangArr[23];
$moac_lv0018->ArrPush[7]=$vLangArr[24];
$moac_lv0018->ArrPush[8]=$vLangArr[25];
$moac_lv0018->ArrPush[9]=$vLangArr[26];
$moac_lv0018->ArrPush[10]=$vLangArr[27];
$moac_lv0018->ArrPush[11]=$vLangArr[28];
$moac_lv0018->ArrPush[12]=$vLangArr[29];
$moac_lv0018->ArrPush[13]=$vLangArr[30];
$moac_lv0018->ArrPush[14]=$vLangArr[31];
$moac_lv0018->ArrPush[15]=$vLangArr[32];
$moac_lv0018->ArrPush[16]=$vLangArr[33];
$moac_lv0018->ArrPush[17]=$vLangArr[34];
$moac_lv0018->ArrPush[18]=$vLangArr[43];
$moac_lv0018->ArrPush[19]=$vLangArr[42];
$moac_lv0018->ArrPush[23]='Chi nhánh';

$moac_lv0018->ArrFunc[0]='//Function';
$moac_lv0018->ArrFunc[1]=$vLangArr[2];
$moac_lv0018->ArrFunc[2]=$vLangArr[4];
$moac_lv0018->ArrFunc[3]=$vLangArr[6];
$moac_lv0018->ArrFunc[4]=$vLangArr[7];
$moac_lv0018->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$moac_lv0018->ArrFunc[6]=GetLangExcept('Apr',$plang);
$moac_lv0018->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$moac_lv0018->ArrFunc[8]=$vLangArr[10];
$moac_lv0018->ArrFunc[9]=$vLangArr[12];
$moac_lv0018->ArrFunc[10]=$vLangArr[0];
$moac_lv0018->ArrFunc[11]=$vLangArr[37];
$moac_lv0018->ArrFunc[12]=$vLangArr[38];
$moac_lv0018->ArrFunc[13]=$vLangArr[39];
$moac_lv0018->ArrFunc[14]=$vLangArr[40];
$moac_lv0018->ArrFunc[15]=$vLangArr[41];

////Other
$moac_lv0018->ArrOther[1]=$vLangArr[35];
$moac_lv0018->ArrOther[2]=$vLangArr[36];
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
	$vresult=$moac_lv0018->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ac_lv0018",$lvMessage);
}
elseif($flagID==2)
{
$moac_lv0018->lv001=$_POST['txtlv001'];
$moac_lv0018->lv003=$_POST['txtlv003'];
$moac_lv0018->lv004=$_POST['txtlv004'];
$moac_lv0018->lv005=$_POST['txtlv005'];
$moac_lv0018->lv006=$_POST['txtlv006'];
$moac_lv0018->lv007=$_POST['txtlv007'];
$moac_lv0018->lv008=$_POST['txtlv008'];
$moac_lv0018->lv009=$_POST['txtlv009'];
$moac_lv0018->lv010=$_POST['txtlv010'];
$moac_lv0018->lv011=$_POST['txtlv011'];
$moac_lv0018->lv012=$_POST['txtlv012'];
$moac_lv0018->lv013=$_POST['txtlv013'];
$moac_lv0018->lv014=$_POST['txtlv014'];
$moac_lv0018->lv015=$_POST['txtlv015'];
$moac_lv0018->lv016=$_POST['txtlv016'];
$moac_lv0018->lv018=$_POST['txtlv018'];
$moac_lv0018->lv022=$_POST['txtlv022'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moac_lv0018->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moac_lv0018->LV_UnAproval($strar);
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0018->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0018');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moac_lv0018->ListView;
$curPage = $moac_lv0018->CurPage;
$maxRows =$moac_lv0018->MaxRows;
$vOrderList=$moac_lv0018->ListOrder;
$vSortNum=$moac_lv0018->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moac_lv0018->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0018',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0018->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="JavaScript" type="text/javascript">
<!--
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv018=<?php echo $_POST['txtlv018'];?>','filter');
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
	 o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
	 o.submit();

}
function FunctRunning1(vID)
{
RunFunction(vID,'child');
}
function RunFunction(vID,func)
{
	switch(func)
	{
		case 'child':
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"ac_lv0018?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"ac_lv0018?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>"
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
	o.action="<?php echo $vDir;?>ac_lv0018?func=<?php echo $_GET['func'];?>&func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}

//-->
</script>
<?php
if($moac_lv0018->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moac_lv0018->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moac_lv0018->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $moac_lv0018->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moac_lv0018->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moac_lv0018->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moac_lv0018->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moac_lv0018->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moac_lv0018->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $moac_lv0018->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $moac_lv0018->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $moac_lv0018->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $moac_lv0018->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $moac_lv0018->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $moac_lv0018->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $moac_lv0018->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $moac_lv0018->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $moac_lv0018->lv016;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $moac_lv0018->lv018;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $moac_lv0018->lv022;?>"/>
				  </form>
				   <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moac_lv0018->ArrPush[0];?>';	
</script>