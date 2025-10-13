<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0059.php");

/////////////init object//////////////
$mosl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0059');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0070.txt",$plang);
$mosl_lv0059->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0059->ArrPush[0]=$vLangArr[17];
$mosl_lv0059->ArrPush[1]=$vLangArr[18];
$mosl_lv0059->ArrPush[2]=$vLangArr[20];
$mosl_lv0059->ArrPush[3]=$vLangArr[21];
$mosl_lv0059->ArrPush[4]=$vLangArr[22];
$mosl_lv0059->ArrPush[5]=$vLangArr[23];
$mosl_lv0059->ArrPush[6]=$vLangArr[24];
$mosl_lv0059->ArrPush[7]=$vLangArr[25];
$mosl_lv0059->ArrPush[8]=$vLangArr[26];
$mosl_lv0059->ArrPush[9]=$vLangArr[27];
$mosl_lv0059->ArrPush[10]=$vLangArr[28];
$mosl_lv0059->ArrPush[100]='DS KH';

$mosl_lv0059->ArrFunc[0]='//Function';
$mosl_lv0059->ArrFunc[1]=$vLangArr[2];
$mosl_lv0059->ArrFunc[2]=$vLangArr[4];
$mosl_lv0059->ArrFunc[3]=$vLangArr[6];
$mosl_lv0059->ArrFunc[4]=$vLangArr[7];
$mosl_lv0059->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0059->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0059->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0059->ArrFunc[8]=$vLangArr[10];
$mosl_lv0059->ArrFunc[9]=$vLangArr[12];
$mosl_lv0059->ArrFunc[10]=$vLangArr[0];
$mosl_lv0059->ArrFunc[11]=$vLangArr[31];
$mosl_lv0059->ArrFunc[12]=$vLangArr[32];
$mosl_lv0059->ArrFunc[13]=$vLangArr[33];
$mosl_lv0059->ArrFunc[14]=$vLangArr[34];
$mosl_lv0059->ArrFunc[15]=$vLangArr[35];

////Other
$mosl_lv0059->ArrOther[1]=$vLangArr[29];
$mosl_lv0059->ArrOther[2]=$vLangArr[30];
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
	$vresult=$mosl_lv0059->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0059",$lvMessage);
}
elseif($flagID==2)
{
	$mosl_lv0059->lv001=$_POST['txtlv001'];
	$mosl_lv0059->lv002=$_POST['txtlv002'];
	$mosl_lv0059->lv003=$_POST['txtlv003'];
	$mosl_lv0059->lv004=$_POST['txtlv004'];
	$mosl_lv0059->lv005=$_POST['txtlv005'];
	$mosl_lv0059->lv006=$_POST['txtlv006'];
}
elseif($flagID==3)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$mosl_lv0059->lv007=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$vresult=$mosl_lv0059->LV_Aproval($strar);
	$mosl_lv0059->lv007='';
}
elseif($flagID==4)
{
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$mosl_lv0059->lv007=getInfor($_SESSION['ERPSOFV2RUserID'],2);
	$vresult=$mosl_lv0059->LV_UnAproval($strar);
	$mosl_lv0059->lv007='';
}
elseif($flagID==6)
{
	$mosl_lv0059->lv001=$_POST['qxtlv001'];
	$mosl_lv0059->lv002=$_POST['qxtlv002'];
	$mosl_lv0059->lv003=$_POST['qxtlv003'];
	$mosl_lv0059->lv004=$_POST['qxtlv004'];

	$mosl_lv0059->lv005=$mosl_lv0059->LV_UserID;
	$mosl_lv0059->lv006=$mosl_lv0059->DateCurrent;
	$mosl_lv0059->lv009=$_POST['qxtlv009'];
	$mosl_lv0059->lv099=$_POST['qxtlv099'];
	$vresult=$mosl_lv0059->LV_Insert();	
	if(!$vresult)
	{
		$mosl_lv0059->Values['lv001']=$_POST['qxtlv001'];
		$mosl_lv0059->Values['lv002']=$_POST['qxtlv002'];
		$mosl_lv0059->Values['lv003']=$_POST['qxtlv003'];
		$mosl_lv0059->Values['lv004']=$_POST['qxtlv004'];
		$mosl_lv0059->Values['lv009']=$_POST['qxtlv009'];
		$mosl_lv0059->Values['lv099']=$_POST['qxtlv099'];
		echo sof_error();	
	}
	$mosl_lv0059->lv001='';
	$mosl_lv0059->lv002='';
	$mosl_lv0059->lv003='';
	$mosl_lv0059->lv004='';
	$mosl_lv0059->lv005='';
	$mosl_lv0059->lv006='';
	$mosl_lv0059->lv009='';
	$mosl_lv0059->lv099='';
	
}
else
{
	$vYear=getyear($mosl_lv0059->DateCurrent);
	$vMonth=getmonth($mosl_lv0059->DateCurrent);
	$mosl_lv0059->Values['lv001']=InsertWithCheck('*@*@*.sl_lv0001', 'lv001', $vYear.$vMonth,2);
	$mosl_lv0059->Values['lv002']='Chương trình T'.$vMonth.'/'.$vYear;
	$mosl_lv0059->Values['lv003']='01/'.$vMonth.'/'.$vYear.' 00:00:00';
	$mosl_lv0059->Values['lv004']=GetDayInMonth($vYear,(int)$vMonth).'/'.$vMonth.'/'.$vYear.' 23:59:59';
	$mosl_lv0059->Values['lv009']=10;
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0059->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.sl_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0059->ListView;
$curPage = $mosl_lv0059->CurPage;
$maxRows =$mosl_lv0059->MaxRows;
$vOrderList=$mosl_lv0059->ListOrder;
$vSortNum=$mosl_lv0059->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0059->SaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.sl_lv0001',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($mosl_lv0059->GetApr()<>1)
{
 $mosl_lv0059->lv004=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
$totalRowsC=$mosl_lv0059->GetCount();
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
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0059?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0059?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>sl_lv0059?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
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
function BanHang()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjAxL3NsX2x2MDIwMS5waHA=','_self');
}
function TaoKhuVuc()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDA4L3NsX2x2MDAwOC5waHA=','_self');
}
function TaoBang()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDA5L3NsX2x2MDAwOS5waHA=','_self');
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
function Save()
{
	var o=document.frmchoose;
	o.txtFlag.value=6;
	if(o.qxtlv001.value==""){
		alert("Mã không rỗng");
		o.qxtlv001.focus();
	}	
	else if(o.qxtlv002.value==""){
		alert("Xin vui lòng nhập chủ đề");
		o.qxtlv002.focus();
	}	
	else
	{
		o.submit();	
	}
}
//-->
</script>
<div class="hd_cafe">
	<ul class="qlycafe">
	<?php
	require_once("../clsall/sl_lv0013.php");
	$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0013->GetView())
	{
		echo '<li><div class="licafe" onclick="BanHang()" >BÁN HÀNG</div></li>';
	}
	require_once("../clsall/sl_lv0009.php");
	$lvsl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0011');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0009->GetView())
	{
		echo '<li><div class="licafe" onclick="TaoBang()">TẠO BÀN</div></li>';
	}
	require_once("../clsall/sl_lv0008.php");
	$lvsl_lv0008=new sl_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0010');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0008->GetView())
	{
		echo '<li><div class="licafe" onclick="TaoKhuVuc()">TẠO KV</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>
		
	</ul>
</div>
<?php
if($mosl_lv0059->GetView()==1)
{
?>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0059->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mosl_lv0059->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0059->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0059->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0059->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0059->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0059->lv006;?>"/>
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
</div></div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0059->ArrPush[0];?>';	
</script>