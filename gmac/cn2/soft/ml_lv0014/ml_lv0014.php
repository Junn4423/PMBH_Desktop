<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ml_lv0014.php");
require_once("../clsall/ml_lv0009.php");
require_once("../clsall/ml_lv0008.php");
require_once("../clsall/ml_lv0007.php");
require_once ("../clsall/ml_lv0100.php");
require_once("../clsall/class.phpmailer.php");

/////////////init object//////////////
$moml_lv0014=new ml_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","ML0028.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0014->ArrPush[0]=$vLangArr[13];
$moml_lv0014->ArrPush[1]=$vLangArr[14];
$moml_lv0014->ArrPush[2]=$vLangArr[15];
$moml_lv0014->ArrPush[3]=$vLangArr[16];
$moml_lv0014->ArrPush[4]=$vLangArr[17];
$moml_lv0014->ArrPush[5]=$vLangArr[18];
$moml_lv0014->ArrPush[6]=$vLangArr[19];
$moml_lv0014->ArrPush[7]=$vLangArr[20];
$moml_lv0014->ArrPush[8]=$vLangArr[21];
$moml_lv0014->ArrPush[9]=$vLangArr[22];
$moml_lv0014->ArrPush[10]=$vLangArr[23];
$moml_lv0014->ArrPush[11]=$vLangArr[24];
$moml_lv0014->ArrPush[12]=$vLangArr[25];
$moml_lv0014->ArrPush[13]=$vLangArr[26];
$moml_lv0014->ArrPush[14]=$vLangArr[27];
$moml_lv0014->ArrPush[15]=$vLangArr[28];

$moml_lv0014->ArrFunc[0]='//Function';
$moml_lv0014->ArrFunc[1]=$vLangArr[2];
$moml_lv0014->ArrFunc[2]=$vLangArr[4];
$moml_lv0014->ArrFunc[3]=$vLangArr[6];
$moml_lv0014->ArrFunc[4]=$vLangArr[7];
$moml_lv0014->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$moml_lv0014->ArrFunc[6]=GetLangExcept('Send',$plang);
$moml_lv0014->ArrFunc[7]=GetLangExcept('UnSend',$plang);
$moml_lv0014->ArrFunc[8]=$vLangArr[10];
$moml_lv0014->ArrFunc[9]=$vLangArr[12];
$moml_lv0014->ArrFunc[10]=$vLangArr[0];
$moml_lv0014->ArrFunc[11]=$vLangArr[31];
$moml_lv0014->ArrFunc[12]=$vLangArr[32];
$moml_lv0014->ArrFunc[13]=$vLangArr[33];
$moml_lv0014->ArrFunc[14]=$vLangArr[34];
$moml_lv0014->ArrFunc[15]=$vLangArr[35];
////Other
$moml_lv0014->ArrOther[1]=$vLangArr[29];
$moml_lv0014->ArrOther[2]=$vLangArr[30];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moml_lv0014->LV_Aproval($strar);
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moml_lv0014->LV_UnAproval($strar);
}
else
{
	$moml_lv0011->lv001=$_POST['txtlv001'];
	$moml_lv0011->lv002=$_POST['txtlv002'];
	$moml_lv0011->lv003=$_POST['txtlv003'];
	$moml_lv0011->lv004=$_POST['txtlv004'];
	$moml_lv0011->lv005=$_POST['txtlv005'];
	$moml_lv0011->lv006=$_POST['txtlv006'];
	$moml_lv0011->lv007=$_POST['txtlv007'];
	$moml_lv0011->lv008=$_POST['txtlv008'];
	$moml_lv0011->lv009=$_POST['txtlv009'];
	$moml_lv0011->lv010=$_POST['txtlv010'];
	$moml_lv0011->lv011=$_POST['txtlv011'];
	$moml_lv0011->lv012=$_POST['txtlv012'];
	$moml_lv0011->lv013=$_POST['txtlv013'];
	$moml_lv0011->lv014=$_POST['txtlv014'];
	}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moml_lv0014->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ml_lv0014');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moml_lv0014->ListView;$vOrderList=$moml_lv0014->ListOrder;
$curPage = $moml_lv0014->CurPage;
$maxRows =$moml_lv0014->MaxRows;
$vOrderList=$moml_lv0014->ListOrder;
$vSortNum=$molv_lv0004->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moml_lv0014->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ml_lv0014',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moml_lv0014->GetCount('');
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="JavaScript" type="text/javascript">
<!--
function FunctRunning1(vID,count)
{
RowFontColor(vID,count);
RunFunction(vID,'child');

}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>','filter');
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
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=1300 marginheight=0 marginwidth=0 frameborder=0 src=ml_lv0014?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($moml_lv0014->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moml_lv0014->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="0"/>
					    <input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moml_lv0011->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $moml_lv0011->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moml_lv0011->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moml_lv0011->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moml_lv0011->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moml_lv0011->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $moml_lv0011->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $moml_lv0011->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $moml_lv0011->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $moml_lv0011->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $moml_lv0011->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $moml_lv0011->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $moml_lv0011->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $moml_lv0011->lv014;?>"/>
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
$moml_lv0014->LoadBox($_SESSION['ERPSOFV2RUserID']);
?>
<script language="javascript">
div1 = document.getElementById('idInbox');
div1.innerHTML='<?php echo $moml_lv0014->Inbox;?>';	
div2 = document.getElementById('idOutbox');
div2.innerHTML='<?php echo $moml_lv0014->Outbox;?>';
div3 = document.getElementById('idSendItem');
div3.innerHTML='<?php echo $moml_lv0014->SendItem;?>';	
div4 = document.getElementById('idInboxDel1');
div4.innerHTML='<?php echo $moml_lv0014->DeleteItem;?>';
</script>
<?php

} else {
	include("permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $moml_lv0014->ArrPush[0];?>';	
</script>