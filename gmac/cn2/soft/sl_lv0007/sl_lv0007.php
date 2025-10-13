<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0007.php");

/////////////init object//////////////
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$mosl_lv0007->path_server="";
$mosl_lv0007->path_web="";
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0014.txt",$plang);
$mosl_lv0007->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0007->ArrPush[0]=$vLangArr[17];
$mosl_lv0007->ArrPush[1]=$vLangArr[18];
$mosl_lv0007->ArrPush[2]=$vLangArr[19];
$mosl_lv0007->ArrPush[3]=$vLangArr[20];
$mosl_lv0007->ArrPush[4]=$vLangArr[21];
$mosl_lv0007->ArrPush[5]=$vLangArr[22];
$mosl_lv0007->ArrPush[6]=$vLangArr[23];
$mosl_lv0007->ArrPush[7]=$vLangArr[24];
$mosl_lv0007->ArrPush[8]=$vLangArr[25];
$mosl_lv0007->ArrPush[9]=$vLangArr[26];
$mosl_lv0007->ArrPush[10]=$vLangArr[27];
$mosl_lv0007->ArrPush[11]=$vLangArr[28];
$mosl_lv0007->ArrPush[12]=$vLangArr[29];
$mosl_lv0007->ArrPush[13]=$vLangArr[30];
$mosl_lv0007->ArrPush[14]=$vLangArr[31];
$mosl_lv0007->ArrPush[15]=$vLangArr[32];
$mosl_lv0007->ArrPush[16]=$vLangArr[33];
$mosl_lv0007->ArrPush[17]=$vLangArr[41];
$mosl_lv0007->ArrPush[18]=$vLangArr[42];
$mosl_lv0007->ArrPush[19]=$vLangArr[43];
$mosl_lv0007->ArrPush[20]=$vLangArr[44];
$mosl_lv0007->ArrPush[23]='Giá vốn/Giá BQ';

$mosl_lv0007->ArrFunc[0]='//Function';
$mosl_lv0007->ArrFunc[1]=$vLangArr[2];
$mosl_lv0007->ArrFunc[2]=$vLangArr[4];
$mosl_lv0007->ArrFunc[3]=$vLangArr[6];
$mosl_lv0007->ArrFunc[4]=$vLangArr[7];
$mosl_lv0007->ArrFunc[5]='';
$mosl_lv0007->ArrFunc[6]='';
$mosl_lv0007->ArrFunc[7]='';
$mosl_lv0007->ArrFunc[8]=$vLangArr[10];
$mosl_lv0007->ArrFunc[9]=$vLangArr[12];
$mosl_lv0007->ArrFunc[10]=$vLangArr[0];
$mosl_lv0007->ArrFunc[11]=$vLangArr[36];
$mosl_lv0007->ArrFunc[12]=$vLangArr[37];
$mosl_lv0007->ArrFunc[13]=$vLangArr[38];
$mosl_lv0007->ArrFunc[14]=$vLangArr[39];
$mosl_lv0007->ArrFunc[15]=$vLangArr[40];

////Other
$mosl_lv0007->ArrOther[1]=$vLangArr[34];
$mosl_lv0007->ArrOther[2]=$vLangArr[35];
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
	$vresult=$mosl_lv0007->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0007",$lvMessage);
}
elseif($flagID==6)
{
	$mosl_lv0007->lv001=$_POST['qxtlv001'];
	$mosl_lv0007->lv002=$_POST['qxtlv002'];
	$mosl_lv0007->lv003=$_POST['qxtlv003'];
	$mosl_lv0007->lv004=$_POST['qxtlv004'];
	$mosl_lv0007->lv007=$_POST['qxtlv007'];
	$mosl_lv0007->lv008=$_POST['qxtlv008'];
	$mosl_lv0007->lv005=$_POST['qxtlv005'];
	$mosl_lv0007->lv006=$_POST['qxtlv006'];
	$mosl_lv0007->lv009=$_POST['qxtlv009'];
	$mosl_lv0007->lv010=$_POST['qxtlv010'];
	$mosl_lv0007->lv011=$_POST['qxtlv011'];
	$mosl_lv0007->lv012=$_POST['qxtlv012'];
	$mosl_lv0007->lv013=$_POST['qxtlv013'];
	$mosl_lv0007->lv014=$_POST['qxtlv014'];
	$mosl_lv0007->lv015=$_POST['qxtlv015'];
	$mosl_lv0007->lv016=$_POST['qxtlv016'];
	$mosl_lv0007->lv017=$_POST['qxtlv017'];
	$mosl_lv0007->lv018=$_POST['qxtlv018'];
	$mosl_lv0007->lv019=$_POST['qxtlv019'];
	$mosl_lv0007->lv020=$_POST['qxtlv020'];
	$vresult=$mosl_lv0007->LV_Insert();	
	if(!$vresult)
	{
		$mosl_lv0007->Values['lv001']=$_POST['qxtlv001'];
		$mosl_lv0007->Values['lv002']=$_POST['qxtlv002'];
		$mosl_lv0007->Values['lv003']=$_POST['qxtlv003'];
		$mosl_lv0007->Values['lv004']=$_POST['qxtlv004'];
		$mosl_lv0007->Values['lv007']=$_POST['qxtlv007'];
		$mosl_lv0007->Values['lv008']=$_POST['qxtlv008'];
		$mosl_lv0007->Values['lv005']=$_POST['qxtlv005'];
		$mosl_lv0007->Values['lv006']=$_POST['qxtlv006'];
		$mosl_lv0007->Values['lv009']=$_POST['qxtlv009'];
		$mosl_lv0007->Values['lv010']=$_POST['qxtlv010'];
		$mosl_lv0007->Values['lv011']=$_POST['qxtlv011'];
		$mosl_lv0007->Values['lv012']=$_POST['qxtlv012'];
		$mosl_lv0007->Values['lv013']=$_POST['qxtlv013'];
		$mosl_lv0007->Values['lv014']=$_POST['qxtlv014'];
		$mosl_lv0007->Values['lv015']=$_POST['qxtlv015'];
		$mosl_lv0007->Values['lv016']=$_POST['qxtlv016'];
		$mosl_lv0007->Values['lv017']=$_POST['qxtlv017'];
		$mosl_lv0007->Values['lv018']=$_POST['qxtlv018'];
		$mosl_lv0007->Values['lv019']=$_POST['qxtlv019'];
		$mosl_lv0007->Values['lv020']=$_POST['qxtlv020'];
		echo sof_error();	
	}
	$mosl_lv0007->lv001='';
	$mosl_lv0007->lv002='';
	$mosl_lv0007->lv003='';
	$mosl_lv0007->lv004='';
	$mosl_lv0007->lv007='';
	$mosl_lv0007->lv008='';
	$mosl_lv0007->lv005='';
	$mosl_lv0007->lv006='';
	$mosl_lv0007->lv009='';
	$mosl_lv0007->lv010='';
	$mosl_lv0007->lv011='';
	$mosl_lv0007->lv012='';
	$mosl_lv0007->lv013='';
	$mosl_lv0007->lv014='';
	$mosl_lv0007->lv015='';
	$mosl_lv0007->lv016='';
	$mosl_lv0007->lv017='';
	$mosl_lv0007->lv018='';
	$mosl_lv0007->lv019='';
	$mosl_lv0007->lv020='';
}
elseif($flagID==2)
{
	$mosl_lv0007->lv001=$_POST['txtlv001'];
	$mosl_lv0007->lv002=$_POST['txtlv002'];
	$mosl_lv0007->lv003=$_POST['txtlv003'];
	$mosl_lv0007->lv004=$_POST['txtlv004'];
	$mosl_lv0007->lv005=$_POST['txtlv005'];
	$mosl_lv0007->lv006=$_POST['txtlv006'];
	$mosl_lv0007->lv007=$_POST['txtlv007'];
	$mosl_lv0007->lv008=$_POST['txtlv008'];
	$mosl_lv0007->lv009=$_POST['txtlv009'];
	$mosl_lv0007->lv010=$_POST['txtlv010'];
	$mosl_lv0007->lv011=$_POST['txtlv011'];
	$mosl_lv0007->lv012=$_POST['txtlv012'];
	$mosl_lv0007->lv013=$_POST['txtlv013'];
	$mosl_lv0007->lv014=$_POST['txtlv014'];
	$mosl_lv0007->lv015=$_POST['txtlv015'];
	$mosl_lv0007->lv016=$_POST['txtlv016'];
	$mosl_lv0007->lv017=$_POST['txtlv017'];
	$mosl_lv0007->lv018=$_POST['txtlv018'];
	$mosl_lv0007->lv019=$_POST['txtlv019'];
	$mosl_lv0007->lv020=$_POST['txtlv020'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0007->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.sl_lv0007');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0007->ListView;
$curPage = $mosl_lv0007->CurPage;
$maxRows =$mosl_lv0007->MaxRows;
$vOrderList=$mosl_lv0007->ListOrder;
$vSortNum=$mosl_lv0007->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0007->SaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.sl_lv0007',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0007->GetCount();
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
			var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0007?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1400 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0007?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
	function nhapkho()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAyL3doX2x2MDEwMi5waHA=','_self');
	}
	function  kiemkho()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAzL3doX2x2MDEwMy5waHA=','_self');
	}
	function nhomsanpham()
	{
		window.open('?lang=<?php echo $plang;?>&opt=19&item=&link=c2xfbHYwMDA2L3NsX2x2MDAwNi5waHA=','_self');
	}
	function donvitinh()
	{
		window.open('?lang=<?php echo $plang;?>&opt=19&item=&link=c2xfbHYwMDA1L3NsX2x2MDAwNS5waHA=','_self');
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
			alert("Xin vui lòng nhập tên");
			o.qxtlv002.focus();
		}	
		else
		{
			o.submit();
		}
	}
	setTimeout(focusmain,1000);
function focusmain()
{
	document.getElementById('qxtlv001').focus();
}
//-->
</script>
<div class="hd_cafe">
	<ul class="qlycafe">
	<?php
	require_once("../clsall/sl_lv0006.php");
	$lvsl_lv0006=new sl_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0007');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0006->GetView())
	{
	echo '<li><div class="licafe" onclick="nhomsanpham()">NHÓM SP</div></li>';
	}
	require_once("../clsall/sl_lv0005.php");
	$lvsl_lv0005=new sl_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0006');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0005->GetView())
	{
		echo '<li><div class="licafe" onclick="donvitinh()">ĐON VỊ</div></li>';
	}
	require_once("../clsall/wh_lv0008.php");
	$lvwh_lv0008=new wh_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0102');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvwh_lv0008->GetView())
	{
		echo '<li><div class="licafe" onclick="nhapkho()">NHẬP KHO</div></li>';
	}
	require_once("../clsall/wh_lv0004.php");
	$lvwh_lv0004=new wh_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0103');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvwh_lv0004->GetView())
	{
		echo '<li><div class="licafe" onclick="kiemkho()">KIỂM KHO</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;</li>		
	</ul>
</div>
<?php
if($mosl_lv0007->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0007->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001" value="<?php echo $mosl_lv0007->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mosl_lv0007->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0007->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0007->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0007->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0007->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0007->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mosl_lv0007->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mosl_lv0007->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mosl_lv0007->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mosl_lv0007->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mosl_lv0007->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mosl_lv0007->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mosl_lv0007->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mosl_lv0007->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mosl_lv0007->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mosl_lv0007->lv017;?>"/>

				  </form>
				  
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<?php
} else {
	include("../sl_lv0007/permit.php");
}
?>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $mosl_lv0007->ArrPush[0];?>';	
</script>