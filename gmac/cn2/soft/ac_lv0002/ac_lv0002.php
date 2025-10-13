<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ac_lv0002.php");

/////////////init object//////////////
$moac_lv0002=new ac_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","AC0003.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0002->ArrPush[0]=$vLangArr[17];
$moac_lv0002->ArrPush[1]=$vLangArr[18];
$moac_lv0002->ArrPush[2]=$vLangArr[20];
$moac_lv0002->ArrPush[3]=$vLangArr[21];
$moac_lv0002->ArrPush[4]=$vLangArr[22];
$moac_lv0002->ArrPush[5]=$vLangArr[23];
$moac_lv0002->ArrPush[6]=$vLangArr[24];

$moac_lv0002->ArrFunc[0]='//Function';
$moac_lv0002->ArrFunc[1]=$vLangArr[2];
$moac_lv0002->ArrFunc[2]=$vLangArr[4];
$moac_lv0002->ArrFunc[3]=$vLangArr[6];
$moac_lv0002->ArrFunc[4]=$vLangArr[7];
$moac_lv0002->ArrFunc[5]='';
$moac_lv0002->ArrFunc[6]='';
$moac_lv0002->ArrFunc[7]='';
$moac_lv0002->ArrFunc[8]=$vLangArr[10];
$moac_lv0002->ArrFunc[9]=$vLangArr[12];
$moac_lv0002->ArrFunc[10]=$vLangArr[0];
$moac_lv0002->ArrFunc[11]=$vLangArr[27];
$moac_lv0002->ArrFunc[12]=$vLangArr[28];
$moac_lv0002->ArrFunc[13]=$vLangArr[29];
$moac_lv0002->ArrFunc[14]=$vLangArr[30];
$moac_lv0002->ArrFunc[15]=$vLangArr[31];
////Other
$moac_lv0002->ArrOther[1]=$vLangArr[25];
$moac_lv0002->ArrOther[2]=$vLangArr[26];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$moac_lv0002->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"ac_lv0002",$lvMessage);
}
elseif($flagID==2)
{
	$moac_lv0002->lv001=$_POST['txtlv001'];
	$moac_lv0002->lv002=$_POST['txtlv002'];
	$moac_lv0002->lv003=$_POST['txtlv003'];
}
elseif($flagID==6)
{
	$moac_lv0002->lv001=$_POST['qxtlv001'];
	$moac_lv0002->lv002=$_POST['qxtlv002'];
	$moac_lv0002->lv003=$_POST['qxtlv003'];
	$moac_lv0002->lv004=$_POST['qxtlv004'];
	$vresult=$moac_lv0002->LV_Insert();	
	if(!$vresult)
	{
		$moac_lv0002->Values['lv001']=$_POST['qxtlv001'];
		$moac_lv0002->Values['lv002']=$_POST['qxtlv002'];
		$moac_lv0002->Values['lv003']=$_POST['qxtlv003'];
		$moac_lv0002->Values['lv004']=$_POST['qxtlv004'];
		echo sof_error();	
	}
	$moac_lv0002->lv001='';
	$moac_lv0002->lv002='';
	$moac_lv0002->lv003='';
	$moac_lv0002->lv004='';
}
else
{
	$moac_lv0002->Values['lv003']='TA0003';
	$moac_lv0002->Values['lv004']='VND';
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0002->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0002');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$moac_lv0002->ListView;
$curPage = $moac_lv0002->CurPage;
$maxRows =$moac_lv0002->MaxRows;
$vSortNum=$moac_lv0002->SortNum;
$vOrderList=$moac_lv0002->ListOrder;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$moac_lv0002->SaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0002',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0002->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>','filter');
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
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=300 marginheight=0 marginwidth=0 frameborder=0 src=\"ac_lv0002?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;ProcessHiden();scrollToBottom();
}
function nhapchi()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=YWNfbHYwMjc1L2FjX2x2MDI3NS5waHA=','_self');
}
function baocaochi()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=YWNfbHYwMjMzL2FjX2x2MDIzMy5waHA=','_self');
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
<?php
if($moac_lv0002->GetView()==1)
{
?>
<div class="hd_cafe">
	<ul class="qlycafe">
		<li><div class="licafe" onclick="nhapchi()" title="Nhập chi tiền khác">NHẬP CHI</div></li>
		<li><div class="licafe" onclick="baocaochi()">BÁO CÁO CHI</div></li>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>		
	</ul>
</div>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $moac_lv0002->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $moac_lv0002->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $moac_lv0002->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $moac_lv0002->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $moac_lv0002->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $moac_lv0002->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $moac_lv0002->lv006;?>"/>
					    
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
div.innerHTML='<?php echo $moac_lv0002->ArrPush[0];?>';	
</script>