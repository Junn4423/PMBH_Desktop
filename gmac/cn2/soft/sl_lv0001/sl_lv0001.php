<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0001.php");
require_once("$vDir../clsall/sl_lv0070.php");
require_once("$vDir../clsall/sl_lv0013.php");
require_once("$vDir../clsall/sl_lv0014.php");
/////////////init object//////////////
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$lvsl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');	
$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
$lvsl_lv0070->LV_Load();

$lvsl_lv0013->obj_conf=$lvsl_lv0070;
$lvsl_lv0013->lvsl_lv0014=$lvsl_lv0014;
$mosl_lv0001->mosl_lv0013=$lvsl_lv0013;
$mosl_lv0001->lvsl_lv0070=$lvsl_lv0070;
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0001.txt",$plang);
$mosl_lv0001->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0001->ArrPush[0]=$vLangArr[17];
$mosl_lv0001->ArrPush[1]=$vLangArr[18];
$mosl_lv0001->ArrPush[2]=$vLangArr[19];
$mosl_lv0001->ArrPush[3]=$vLangArr[20];
$mosl_lv0001->ArrPush[4]=$vLangArr[21];
$mosl_lv0001->ArrPush[5]=$vLangArr[22];
$mosl_lv0001->ArrPush[6]=$vLangArr[23];
$mosl_lv0001->ArrPush[7]=$vLangArr[24];
$mosl_lv0001->ArrPush[8]=$vLangArr[25];
$mosl_lv0001->ArrPush[9]=$vLangArr[26];
$mosl_lv0001->ArrPush[10]=$vLangArr[27];
$mosl_lv0001->ArrPush[11]=$vLangArr[28];
$mosl_lv0001->ArrPush[12]=$vLangArr[29];
$mosl_lv0001->ArrPush[13]=$vLangArr[30];
$mosl_lv0001->ArrPush[14]=$vLangArr[31];
$mosl_lv0001->ArrPush[15]=$vLangArr[32];
$mosl_lv0001->ArrPush[16]=$vLangArr[33];
$mosl_lv0001->ArrPush[17]=$vLangArr[34];
$mosl_lv0001->ArrPush[18]=$vLangArr[35];
$mosl_lv0001->ArrPush[19]=$vLangArr[36];
$mosl_lv0001->ArrPush[20]=$vLangArr[37];
$mosl_lv0001->ArrPush[21]=$vLangArr[38];
$mosl_lv0001->ArrPush[22]=$vLangArr[39];
$mosl_lv0001->ArrPush[23]=$vLangArr[40];
$mosl_lv0001->ArrPush[24]=$vLangArr[41];
$mosl_lv0001->ArrPush[25]=$vLangArr[42];
$mosl_lv0001->ArrPush[26]=$vLangArr[43];
$mosl_lv0001->ArrPush[27]=$vLangArr[52];
$mosl_lv0001->ArrPush[28]=$vLangArr[53];
$mosl_lv0001->ArrPush[29]=$vLangArr[54];
$mosl_lv0001->ArrPush[30]='Tiền nợ đầu kỳ';
$mosl_lv0001->ArrPush[31]='Điểm hiện tại';
$mosl_lv0001->ArrPush[102]='Điểm đổi voucher';
$mosl_lv0001->ArrPush[103]='Điểm còn lại';

$mosl_lv0001->ArrFunc[0]='//Function';
$mosl_lv0001->ArrFunc[1]=$vLangArr[2];
$mosl_lv0001->ArrFunc[2]=$vLangArr[4];
$mosl_lv0001->ArrFunc[3]=$vLangArr[6];
$mosl_lv0001->ArrFunc[4]=$vLangArr[7];
$mosl_lv0001->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mosl_lv0001->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mosl_lv0001->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mosl_lv0001->ArrFunc[8]=$vLangArr[10];
$mosl_lv0001->ArrFunc[9]=$vLangArr[12];
$mosl_lv0001->ArrFunc[10]=$vLangArr[0];
$mosl_lv0001->ArrFunc[11]=$vLangArr[47];
$mosl_lv0001->ArrFunc[12]=$vLangArr[48];
$mosl_lv0001->ArrFunc[13]=$vLangArr[49];
$mosl_lv0001->ArrFunc[14]=$vLangArr[50];
$mosl_lv0001->ArrFunc[15]=$vLangArr[51];

////Other
$mosl_lv0001->ArrOther[1]=$vLangArr[45];
$mosl_lv0001->ArrOther[2]=$vLangArr[46];
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
	$vresult=$mosl_lv0001->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"sl_lv0001",$lvMessage);
}
elseif($flagID==2)
{
$mosl_lv0001->lv001=$_POST['txtlv001'];
$mosl_lv0001->lv002=$_POST['txtlv002'];
$mosl_lv0001->lv003=$_POST['txtlv003'];
$mosl_lv0001->lv004=$_POST['txtlv004'];
$mosl_lv0001->lv005=$_POST['txtlv005'];
$mosl_lv0001->lv006=$_POST['txtlv006'];
$mosl_lv0001->lv007=$_POST['txtlv007'];
$mosl_lv0001->lv008=$_POST['txtlv008'];
$mosl_lv0001->lv009=$_POST['txtlv009'];
$mosl_lv0001->lv010=$_POST['txtlv010'];
$mosl_lv0001->lv011=$_POST['txtlv011'];
$mosl_lv0001->lv012=$_POST['txtlv012'];
$mosl_lv0001->lv013=$_POST['txtlv013'];
$mosl_lv0001->lv014=$_POST['txtlv014'];
$mosl_lv0001->lv015=$_POST['txtlv015'];
$mosl_lv0001->lv016=$_POST['txtlv016'];
$mosl_lv0001->lv017=$_POST['txtlv017'];
$mosl_lv0001->lv018=$_POST['txtlv018'];
$mosl_lv0001->lv019=$_POST['txtlv019'];
$mosl_lv0001->lv020=$_POST['txtlv020'];
$mosl_lv0001->lv021=$_POST['txtlv021'];
$mosl_lv0001->lv022=$_POST['txtlv022'];
$mosl_lv0001->lv023=$_POST['txtlv023'];
$mosl_lv0001->lv024=$_POST['txtlv024'];
$mosl_lv0001->lv025=$_POST['txtlv025'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0001->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.sl_lv0001');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mosl_lv0001->ListView;
$curPage = $mosl_lv0001->CurPage;
$maxRows =$mosl_lv0001->MaxRows;
$vOrderList=$mosl_lv0001->ListOrder;
$vSortNum=$mosl_lv0001->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mosl_lv0001->SaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.sl_lv0001',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;
if($mosl_lv0001->GetApr()<>1)
{
 $mosl_lv0001->lv025=getInfor($_SESSION['ERPSOFV2RUserID'],2);
}
$totalRowsC=$mosl_lv0001->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<script language="JavaScript" type="text/javascript">
<!--
function ChangeInfor()
{
var o1=document.frmchoose;
 	o1.submit();
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
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0001?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1900 marginheight=0 marginwidth=0 frameborder=0 src=\"sl_lv0001?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
			break;
	}
	
	div = document.getElementById('lvright');
	div.innerHTML=str;
	ProcessHiden();
	scrollToBottom();
}
function Rpt()
{
	lv_chk_list(document.frmchoose,'lvChk',4);
}
function Report(vValue)
{
	var o=document.frmprocess;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0001?func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
	var fun1="Report4('"+vValue+"')";
	setTimeout(fun1,100);
}
function Report4(vValue)
{
	var o=document.frmprocess3;
	o.target="_blank";
	o.action="<?php echo $vDir;?>sl_lv0001?func=<?php echo $_GET['func'];?>&func=rptall&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
//-->
</script>
<?php
if($mosl_lv0001->GetView()==1)
{
?>
<link rel="stylesheet" href="../css/popup.css" type="text/css">

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose"> <input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
					<table style="background:#F2F2F2;padding:5px;color:#4D4D4F!important;" border="0" cellpadding="0" cellspacing="0"><tr><td><?php echo $vLangArr[19];?> <input type="text" name="txtlv001" id="txtlv001" tabindex="1" value="<?php echo $mosl_lv0001->lv001;?>" onchange="ChangeInfor()"/>
						&nbsp;&nbsp;&nbsp;</td>
						<td><?php echo $vLangArr[20];?>
						<td>
							  <ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT"><input onKeyPress="return CheckEnter(event)"  name="txtlv002" id="txtlv002" autocomplete="off"  onChange="ChangeInfor()" tabindex="9" maxlength="255" style="width:100%" value="<?php echo $mosl_lv0001->lv002;?>" onKeyUp="LoadSelfNextParent(this,'txtlv002','*@*@*.sl_lv0001','lv002',lv002)" onFocus="LoadSelfNextParent(this,'txtlv002','*@*@*.sl_lv0001','lv002','lv002')"/><div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td>
					<td>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[24];?> <input type="text"  tabindex="1" name="txtlv006" id="txtlv006" value="<?php echo $mosl_lv0001->lv006;?>" onChange="ChangeInfor()"/></td>
					<td>&nbsp;&nbsp;&nbsp;<?php echo $vLangArr[28];?> <input type="text"  tabindex="1" name="txtlv010" id="txtlv010" value="<?php echo $mosl_lv0001->lv010;?>" onChange="ChangeInfor()"/></td></tr></table>
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mosl_lv0001->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mosl_lv0001->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mosl_lv0001->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mosl_lv0001->lv005;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mosl_lv0001->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mosl_lv0001->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mosl_lv0001->lv009;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mosl_lv0001->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mosl_lv0001->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mosl_lv0001->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mosl_lv0001->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mosl_lv0001->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mosl_lv0001->lv016;?>"/>
                        <input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mosl_lv0001->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mosl_lv0001->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mosl_lv0001->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mosl_lv0001->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mosl_lv0001->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mosl_lv0001->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mosl_lv0001->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mosl_lv0001->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mosl_lv0001->lv025;?>"/>					    
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess3" id="frmprocess3" > 
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
div.innerHTML='<?php echo $mosl_lv0001->ArrPush[0];?>';	
</script>