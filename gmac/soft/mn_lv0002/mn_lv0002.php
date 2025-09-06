<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/mn_lv0002.php");

/////////////init object//////////////
$momn_lv0002=new mn_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0014.txt",$plang);
$momn_lv0002->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0002->ArrPush[0]=$vLangArr[17];
$momn_lv0002->ArrPush[1]=$vLangArr[18];
$momn_lv0002->ArrPush[2]=$vLangArr[19];
$momn_lv0002->ArrPush[3]=$vLangArr[20];
$momn_lv0002->ArrPush[4]=$vLangArr[21];
$momn_lv0002->ArrPush[5]=$vLangArr[22];
$momn_lv0002->ArrPush[6]=$vLangArr[23];
$momn_lv0002->ArrPush[7]=$vLangArr[24];
$momn_lv0002->ArrPush[8]=$vLangArr[25];
$momn_lv0002->ArrPush[9]=$vLangArr[26];
$momn_lv0002->ArrPush[10]=$vLangArr[27];
$momn_lv0002->ArrPush[11]=$vLangArr[28];
$momn_lv0002->ArrPush[12]=$vLangArr[29];
$momn_lv0002->ArrPush[13]=$vLangArr[30];
$momn_lv0002->ArrPush[14]=$vLangArr[31];
$momn_lv0002->ArrPush[15]=$vLangArr[32];
$momn_lv0002->ArrPush[16]=$vLangArr[33];

$momn_lv0002->ArrFunc[0]='//Function';
$momn_lv0002->ArrFunc[1]=$vLangArr[2];
$momn_lv0002->ArrFunc[2]=$vLangArr[4];
$momn_lv0002->ArrFunc[3]=$vLangArr[6];
$momn_lv0002->ArrFunc[4]=$vLangArr[7];
$momn_lv0002->ArrFunc[5]='';
$momn_lv0002->ArrFunc[6]='';
$momn_lv0002->ArrFunc[7]='';
$momn_lv0002->ArrFunc[8]=$vLangArr[10];
$momn_lv0002->ArrFunc[9]=$vLangArr[12];
$momn_lv0002->ArrFunc[10]=$vLangArr[0];
$momn_lv0002->ArrFunc[11]=$vLangArr[36];
$momn_lv0002->ArrFunc[12]=$vLangArr[37];
$momn_lv0002->ArrFunc[13]=$vLangArr[38];
$momn_lv0002->ArrFunc[14]=$vLangArr[39];
$momn_lv0002->ArrFunc[15]=$vLangArr[40];

////Other
$momn_lv0002->ArrOther[1]=$vLangArr[34];
$momn_lv0002->ArrOther[2]=$vLangArr[35];
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
	$vresult=$momn_lv0002->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"mn_lv0002",$lvMessage);
}
elseif($flagID==2)
{
$momn_lv0002->lv001=$_POST['txtlv001'];
$momn_lv0002->lv002=$_POST['txtlv002'];
$momn_lv0002->lv003=$_POST['txtlv003'];
$momn_lv0002->lv004=$_POST['txtlv004'];
$momn_lv0002->lv005=$_POST['txtlv005'];
$momn_lv0002->lv006=$_POST['txtlv006'];
$momn_lv0002->lv007=$_POST['txtlv007'];
$momn_lv0002->lv008=$_POST['txtlv008'];
$momn_lv0002->lv009=$_POST['txtlv009'];
$momn_lv0002->lv010=$_POST['txtlv010'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$momn_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$momn_lv0002->ListView;
$curPage = $momn_lv0002->CurPage;
$maxRows =$momn_lv0002->MaxRows;
$vOrderList=$momn_lv0002->ListOrder;
$vSortNum=$momn_lv0002->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$momn_lv0002->SaveOperation($_SESSION['ERPSOFV2RUserID'],'mn_lv0002',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$momn_lv0002->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv0015=<?php echo $_POST['txtlv015'];?>','filter');
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
			var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=mn_lv0002?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1400 marginheight=0 marginwidth=0 frameborder=0 src=mn_lv0002?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
	}
	
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}

//-->
</script>
<?php
if($momn_lv0002->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $momn_lv0002->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001" value="<?php echo $momn_lv0002->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $momn_lv0002->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $momn_lv0002->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $momn_lv0002->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $momn_lv0002->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $momn_lv0002->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $momn_lv0002->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $momn_lv0002->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $momn_lv0002->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $momn_lv0002->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $momn_lv0002->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $momn_lv0002->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $momn_lv0002->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $momn_lv0002->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $momn_lv0002->lv015;?>"/>

				  </form>
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../mn_lv0002/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $momn_lv0002->ArrPush[0];?>';	
</script>