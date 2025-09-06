<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0037.php");

/////////////init object//////////////
$mosl_lv0037=new sl_lv0037($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0054.txt",$plang);
$mosl_lv0037->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0037->ArrPush[0]=$vLangArr[17];
$mosl_lv0037->ArrPush[1]=$vLangArr[18];
$mosl_lv0037->ArrPush[2]=$vLangArr[19];
$mosl_lv0037->ArrPush[3]=$vLangArr[20];
$mosl_lv0037->ArrPush[4]=$vLangArr[21];
$mosl_lv0037->ArrPush[5]=$vLangArr[22];
$mosl_lv0037->ArrPush[6]=$vLangArr[23];
$mosl_lv0037->ArrPush[7]=$vLangArr[24];
$mosl_lv0037->ArrPush[8]=$vLangArr[25];

$mosl_lv0037->ArrFunc[0]='//Function';
$mosl_lv0037->ArrFunc[1]=$vLangArr[2];
$mosl_lv0037->ArrFunc[2]=$vLangArr[4];
$mosl_lv0037->ArrFunc[3]=$vLangArr[6];
$mosl_lv0037->ArrFunc[4]=$vLangArr[7];
$mosl_lv0037->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0037->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0037->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0037->ArrFunc[8]=$vLangArr[10];
$mosl_lv0037->ArrFunc[9]=$vLangArr[12];
$mosl_lv0037->ArrFunc[10]=$vLangArr[0];
$mosl_lv0037->ArrFunc[11]=$vLangArr[28];
$mosl_lv0037->ArrFunc[12]=$vLangArr[29];
$mosl_lv0037->ArrFunc[13]=$vLangArr[30];
$mosl_lv0037->ArrFunc[14]=$vLangArr[31];
$mosl_lv0037->ArrFunc[15]=$vLangArr[32];

////Other
$mosl_lv0037->ArrOther[1]=$vLangArr[26];
$mosl_lv0037->ArrOther[2]=$vLangArr[27];
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
	$vresult=$mosl_lv0037->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0037",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0037->lv001=$_POST['txtlv001'];
$mosl_lv0037->lv002=$_POST['txtlv002'];
$mosl_lv0037->lv003=$_POST['txtlv003'];
$mosl_lv0037->lv004=$_POST['txtlv004'];
$mosl_lv0037->lv005=$_POST['txtlv005'];
$mosl_lv0037->lv006=$_POST['txtlv006'];
$mosl_lv0037->lv007=$_POST['txtlv007'];
$mosl_lv0037->lv008=$_POST['txtlv008'];
$mosl_lv0037->lv009=$_POST['txtlv009'];
$mosl_lv0037->lv010=$_POST['txtlv010'];
$mosl_lv0037->lv011=$_POST['txtlv011'];
$mosl_lv0037->lv012=$_POST['txtlv012'];
$mosl_lv0037->lv013=$_POST['txtlv013'];
$mosl_lv0037->lv014=$_POST['txtlv014'];
$mosl_lv0037->lv015=$_POST['txtlv015'];
$mosl_lv0037->lv016=$_POST['txtlv016'];
$mosl_lv0037->lv017=$_POST['txtlv017'];
$mosl_lv0037->lv018=$_POST['txtlv018'];
$mosl_lv0037->lv019=$_POST['txtlv019'];
$mosl_lv0037->lv020=$_POST['txtlv020'];
$mosl_lv0037->lv021=$_POST['txtlv021'];
$mosl_lv0037->lv022=$_POST['txtlv022'];
$mosl_lv0037->lv023=$_POST['txtlv023'];
$mosl_lv0037->lv024=$_POST['txtlv024'];
$mosl_lv0037->lv025=$_POST['txtlv025'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0037->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0037');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0037->ListView;
$curPage = $mosl_lv0037->CurPage;
$maxRows =$mosl_lv0037->MaxRows;
$vOrderList=$mosl_lv0037->ListOrder;
$vSortNum=$mosl_lv0037->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0037->SaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0037',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($mosl_lv0037->GetApr()<>1)
{
 $mosl_lv0037->lv004=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
$totalRowsC=$mosl_lv0037->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv016=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>','filter');
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
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0037?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0037?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function Rpt()
{
	lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0037?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php
if($mosl_lv0037->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0037->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0037->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0037->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0037->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0037->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0037->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0037->lv006;?>"/>
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
div.innerHTML='<?php echo $mosl_lv0037->ArrPush[0];?>';	
</script>