<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/hr_lv0020.php");

/////////////init object//////////////
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","AD0025.txt",$plang);
$mohr_lv0020->lang=strtoupper($plang);
if(isset($_POST['txtlv009']))
$mohr_lv0020->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1";
$mohr_lv0020->lv009=$_POST['txtlv009'];
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0020->ArrPush[0]=$vLangArr[17];
$mohr_lv0020->ArrPush[1]=$vLangArr[18];
$mohr_lv0020->ArrPush[2]=$vLangArr[19];
$mohr_lv0020->ArrPush[3]=$vLangArr[20];
$mohr_lv0020->ArrPush[4]=$vLangArr[21];
$mohr_lv0020->ArrPush[5]=$vLangArr[22];
$mohr_lv0020->ArrPush[6]=$vLangArr[23];
$mohr_lv0020->ArrPush[7]=$vLangArr[24];
$mohr_lv0020->ArrPush[8]=$vLangArr[25];
$mohr_lv0020->ArrPush[9]=$vLangArr[26];
$mohr_lv0020->ArrPush[10]=$vLangArr[27];
$mohr_lv0020->ArrPush[11]=$vLangArr[28];
$mohr_lv0020->ArrPush[12]=$vLangArr[29];
$mohr_lv0020->ArrPush[13]=$vLangArr[30];
$mohr_lv0020->ArrPush[14]=$vLangArr[31];
$mohr_lv0020->ArrPush[15]=$vLangArr[32];
$mohr_lv0020->ArrPush[16]=$vLangArr[33];
$mohr_lv0020->ArrPush[17]=$vLangArr[34];
$mohr_lv0020->ArrPush[18]=$vLangArr[35];
$mohr_lv0020->ArrPush[19]=$vLangArr[36];
$mohr_lv0020->ArrPush[20]=$vLangArr[37];
$mohr_lv0020->ArrPush[21]=$vLangArr[38];
$mohr_lv0020->ArrPush[22]=$vLangArr[39];
$mohr_lv0020->ArrPush[23]=$vLangArr[40];
$mohr_lv0020->ArrPush[24]=$vLangArr[41];
$mohr_lv0020->ArrPush[25]=$vLangArr[42];
$mohr_lv0020->ArrPush[26]=$vLangArr[43];
$mohr_lv0020->ArrPush[27]=$vLangArr[44];
$mohr_lv0020->ArrPush[28]=$vLangArr[45];
$mohr_lv0020->ArrPush[29]=$vLangArr[46];
$mohr_lv0020->ArrPush[30]=$vLangArr[47];
$mohr_lv0020->ArrPush[31]=$vLangArr[48];
$mohr_lv0020->ArrPush[32]=$vLangArr[49];
$mohr_lv0020->ArrPush[33]=$vLangArr[50];
$mohr_lv0020->ArrPush[34]=$vLangArr[51];
$mohr_lv0020->ArrPush[35]=$vLangArr[52];
$mohr_lv0020->ArrPush[36]=$vLangArr[53];
$mohr_lv0020->ArrPush[37]=$vLangArr[54];
$mohr_lv0020->ArrPush[38]=$vLangArr[55];
$mohr_lv0020->ArrPush[39]=$vLangArr[56];
$mohr_lv0020->ArrPush[40]=$vLangArr[57];
$mohr_lv0020->ArrPush[41]=$vLangArr[58];
$mohr_lv0020->ArrPush[42]=$vLangArr[59];
$mohr_lv0020->ArrPush[43]=$vLangArr[60];
$mohr_lv0020->ArrPush[44]=$vLangArr[61];
$mohr_lv0020->ArrPush[45]=$vLangArr[62];
$mohr_lv0020->ArrPush[46]=$vLangArr[71];
$mohr_lv0020->ArrPush[47]=$vLangArr[72];
$mohr_lv0020->ArrPush[48]=$vLangArr[73];
$mohr_lv0020->ArrPush[49]=$vLangArr[74];
$mohr_lv0020->ArrPush[50]=$vLangArr[75];
$mohr_lv0020->ArrFunc[0]='//Function';
$mohr_lv0020->ArrFunc[1]=$vLangArr[2];
$mohr_lv0020->ArrFunc[2]=$vLangArr[4];
$mohr_lv0020->ArrFunc[3]=$vLangArr[6];
$mohr_lv0020->ArrFunc[4]=$vLangArr[7];
$mohr_lv0020->ArrFunc[5]=GetLangExcept('Rpt',$plang);
$mohr_lv0020->ArrFunc[6]=GetLangExcept('Apr',$plang);
$mohr_lv0020->ArrFunc[7]=GetLangExcept('UnApr',$plang);
$mohr_lv0020->ArrFunc[8]=$vLangArr[10];
$mohr_lv0020->ArrFunc[9]=$vLangArr[12];
$mohr_lv0020->ArrFunc[10]=$vLangArr[0];
$mohr_lv0020->ArrFunc[11]=$vLangArr[65];
$mohr_lv0020->ArrFunc[12]=$vLangArr[66];
$mohr_lv0020->ArrFunc[13]=$vLangArr[67];
$mohr_lv0020->ArrFunc[14]=$vLangArr[68];
$mohr_lv0020->ArrFunc[15]=$vLangArr[69];

////Other
$mohr_lv0020->ArrOther[1]=$vLangArr[63];
$mohr_lv0020->ArrOther[2]=$vLangArr[64];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];
$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vresult=$mohr_lv0020->LV_Delete($strar);
	$vStrMessage=GetNoDelete($strar,"hr_lv0020",$lvMessage);
}
elseif($flagID==2)
{
$mohr_lv0020->lv001=$_POST['txtlv001'];
$mohr_lv0020->lv002=$_POST['txtlv002'];
$mohr_lv0020->lv003=$_POST['txtlv003'];
$mohr_lv0020->lv004=$_POST['txtlv004'];
$mohr_lv0020->lv005=$_POST['txtlv005'];
$mohr_lv0020->lv006=$_POST['txtlv006'];
$mohr_lv0020->lv007=$_POST['txtlv007'];
$mohr_lv0020->lv008=$_POST['txtlv008'];
if(isset($_POST['txtlv009']))
$mohr_lv0020->lv009=$_POST['txtlv009'];
else
{
 $_POST['txtlv009']="0,1";
$mohr_lv0020->lv009=$_POST['txtlv009'];
}
$mohr_lv0020->lv010=$_POST['txtlv010'];
$mohr_lv0020->lv011=$_POST['txtlv011'];
$mohr_lv0020->lv012=$_POST['txtlv012'];
$mohr_lv0020->lv013=$_POST['txtlv013'];
$mohr_lv0020->lv014=$_POST['txtlv014'];
$mohr_lv0020->lv015=$_POST['txtlv015'];
$mohr_lv0020->lv016=$_POST['txtlv016'];
$mohr_lv0020->lv017=$_POST['txtlv017'];
$mohr_lv0020->lv018=$_POST['txtlv018'];
$mohr_lv0020->lv019=$_POST['txtlv019'];
$mohr_lv0020->lv020=$_POST['txtlv020'];
$mohr_lv0020->lv021=$_POST['txtlv021'];
$mohr_lv0020->lv022=$_POST['txtlv022'];
$mohr_lv0020->lv023=$_POST['txtlv023'];
$mohr_lv0020->lv024=$_POST['txtlv024'];
$mohr_lv0020->lv025=$_POST['txtlv025'];
$mohr_lv0020->lv026=$_POST['txtlv026'];
$mohr_lv0020->lv027=$_POST['txtlv027'];
$mohr_lv0020->lv028=$_POST['txtlv028'];
$mohr_lv0020->lv029=$_POST['txtlv029'];
$mohr_lv0020->lv030=$_POST['txtlv030'];
$mohr_lv0020->lv031=$_POST['txtlv031'];
$mohr_lv0020->lv032=$_POST['txtlv032'];
$mohr_lv0020->lv033=$_POST['txtlv033'];
$mohr_lv0020->lv034=$_POST['txtlv034'];
$mohr_lv0020->lv035=$_POST['txtlv035'];
$mohr_lv0020->lv036=$_POST['txtlv036'];
$mohr_lv0020->lv037=$_POST['txtlv037'];
$mohr_lv0020->lv038=$_POST['txtlv038'];
$mohr_lv0020->lv039=$_POST['txtlv039'];
$mohr_lv0020->lv040=$_POST['txtlv040'];
$mohr_lv0020->lv041=$_POST['txtlv041'];
$mohr_lv0020->lv042=$_POST['txtlv042'];
$mohr_lv0020->lv043=$_POST['txtlv043'];
}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mohr_lv0020->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.hr_lv0020');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$mohr_lv0020->ListView;
$curPage = $mohr_lv0020->CurPage;
$maxRows =$mohr_lv0020->MaxRows;
$vOrderList=$mohr_lv0020->ListOrder;
$vSortNum=$mohr_lv0020->SortNum;
}
else//last is save
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
$mohr_lv0020->SaveOperation($_SESSION['ERPSOFV2RUserID'],'*@*@*.hr_lv0020',$vFieldList,(int)$_POST['lvmaxrow'],(int)$_POST['curPg'],$vOrderList,(int)$_POST['lvsort']);

}
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mohr_lv0020->GetCount();
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
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv0010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>&lv012=<?php echo $_POST['txtlv012'];?>&lv013=<?php echo $_POST['txtlv013'];?>&lv014=<?php echo $_POST['txtlv014'];?>&lv015=<?php echo $_POST['txtlv015'];?>&lv015=<?php echo $_POST['txtlv016'];?>&lv017=<?php echo $_POST['txtlv017'];?>&lv018=<?php echo $_POST['txtlv018'];?>&lv019=<?php echo $_POST['txtlv019'];?>&lv020=<?php echo $_POST['txtlv020'];?>&lv021=<?php echo $_POST['txtlv021'];?>&lv022=<?php echo $_POST['txtlv022'];?>&lv023=<?php echo $_POST['txtlv023'];?>&lv024=<?php echo $_POST['txtlv024'];?>&lv025=<?php echo $_POST['txtlv025'];?>&lv026=<?php echo $_POST['txtlv026'];?>&lv027=<?php echo $_POST['txtlv027'];?>&lv028=<?php echo $_POST['txtlv028'];?>&lv029=<?php echo $_POST['txtlv029'];?>&lv030=<?php echo $_POST['txtlv030'];?>&lv031=<?php echo $_POST['txtlv031'];?>&lv033=<?php echo $_POST['txtlv033'];?>&lv034=<?php echo $_POST['txtlv034'];?>&lv035=<?php echo $_POST['txtlv035'];?>&lv036=<?php echo $_POST['txtlv036'];?>&lv037=<?php echo $_POST['txtlv037'];?>&lv038=<?php echo $_POST['txtlv038'];?>&lv039=<?php echo $_POST['txtlv039'];?>&lv040=<?php echo $_POST['txtlv040'];?>&lv041=<?php echo $_POST['txtlv041'];?>&lv042=<?php echo $_POST['txtlv042'];?>','filter');
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
			var str="<br><iframe id='lvframefrm' height=1400 marginheight=0 marginwidth=0 frameborder=0 src=hr_lv0020?func="+func+"&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
			break;
		default:
			var str="<br><iframe id='lvframefrm' height=1600 marginheight=0 marginwidth=0 frameborder=0 src=hr_lv0020?func="+func+"&ID="+vID+"&CandID=<?php echo $_GET['CandID'];?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
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
	o.action="<?php echo $vDir;?>hr_lv0020?func=<?php echo $_GET['func'];?>&func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
	o.submit();
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
//-->
</script>

<div class="hd_cafe">
	<ul class="qlycafe">
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;</li>		
	</ul>
</div>
<?php
if($mohr_lv0020->GetView()==1)
{
?>

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form onsubmit="return false;" action="?<?php echo $psaveget;?>" method="post" name="frmchoose" id="frmchoose">
					  <input type="hidden" name="curPg" value="<?php echo  $curPage;?>"/>
						<?php echo $mohr_lv0020->LV_BuilList($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$vSortNum);?>
						<input name="txtStringID" type="hidden" id="txtStringID" />
						<input name="txtFieldList" type="hidden" id="txtFieldList"  value="<?php echo $vFieldList;?>"/>
						<input name="txtOrderList" type="hidden" id="txtOrderList"  value="<?php echo $vOrderList;?>"/>
						
						<input name="txtFlag" type="hidden" id="txtFlag" value="2"/>
						<input type="hidden" name="txtlv001" id="txtlv001"  value="<?php echo $mohr_lv0020->lv001;?>"/>
						<input type="hidden" name="txtlv002" id="txtlv002" value="<?php echo $mohr_lv0020->lv002;?>"/>
						<input type="hidden" name="txtlv003" id="txtlv003" value="<?php echo $mohr_lv0020->lv003;?>"/>
						<input type="hidden" name="txtlv004" id="txtlv004" value="<?php echo $mohr_lv0020->lv004;?>"/>
						<input type="hidden" name="txtlv005" id="txtlv005" value="<?php echo $mohr_lv0020->lv005;?>"/>
						<input type="hidden" name="txtlv006" id="txtlv006" value="<?php echo $mohr_lv0020->lv006;?>"/>
						<input type="hidden" name="txtlv007" id="txtlv007" value="<?php echo $mohr_lv0020->lv007;?>"/>
						<input type="hidden" name="txtlv008" id="txtlv008" value="<?php echo $mohr_lv0020->lv008;?>"/>
						<input type="hidden" name="txtlv009" id="txtlv009" value="<?php echo $mohr_lv0020->lv009;?>"/>
						<input type="hidden" name="txtlv010" id="txtlv010" value="<?php echo $mohr_lv0020->lv010;?>"/>
						<input type="hidden" name="txtlv011" id="txtlv011" value="<?php echo $mohr_lv0020->lv011;?>"/>
						<input type="hidden" name="txtlv012" id="txtlv012" value="<?php echo $mohr_lv0020->lv012;?>"/>
						<input type="hidden" name="txtlv013" id="txtlv013" value="<?php echo $mohr_lv0020->lv013;?>"/>
						<input type="hidden" name="txtlv014" id="txtlv014" value="<?php echo $mohr_lv0020->lv014;?>"/>
						<input type="hidden" name="txtlv015" id="txtlv015" value="<?php echo $mohr_lv0020->lv015;?>"/>
						<input type="hidden" name="txtlv016" id="txtlv016" value="<?php echo $mohr_lv0020->lv016;?>"/>
						<input type="hidden" name="txtlv017" id="txtlv017" value="<?php echo $mohr_lv0020->lv017;?>"/>
						<input type="hidden" name="txtlv018" id="txtlv018" value="<?php echo $mohr_lv0020->lv018;?>"/>
						<input type="hidden" name="txtlv019" id="txtlv019" value="<?php echo $mohr_lv0020->lv019;?>"/>
						<input type="hidden" name="txtlv020" id="txtlv020" value="<?php echo $mohr_lv0020->lv020;?>"/>
						<input type="hidden" name="txtlv021" id="txtlv021" value="<?php echo $mohr_lv0020->lv021;?>"/>
						<input type="hidden" name="txtlv022" id="txtlv022" value="<?php echo $mohr_lv0020->lv022;?>"/>
						<input type="hidden" name="txtlv023" id="txtlv023" value="<?php echo $mohr_lv0020->lv023;?>"/>
						<input type="hidden" name="txtlv024" id="txtlv024" value="<?php echo $mohr_lv0020->lv024;?>"/>
						<input type="hidden" name="txtlv025" id="txtlv025" value="<?php echo $mohr_lv0020->lv025;?>"/>
						<input type="hidden" name="txtlv026" id="txtlv026" value="<?php echo $mohr_lv0020->lv026;?>"/>
						<input type="hidden" name="txtlv027" id="txtlv027" value="<?php echo $mohr_lv0020->lv027;?>"/>
						<input type="hidden" name="txtlv028" id="txtlv028" value="<?php echo $mohr_lv0020->lv028;?>"/>
						<input type="hidden" name="txtlv029" id="txtlv029" value="<?php echo $mohr_lv0020->lv029;?>"/>
						<input type="hidden" name="txtlv030" id="txtlv030" value="<?php echo $mohr_lv0020->lv030;?>"/>
						<input type="hidden" name="txtlv031" id="txtlv031" value="<?php echo $mohr_lv0020->lv031;?>"/>
						<input type="hidden" name="txtlv032" id="txtlv032" value="<?php echo $mohr_lv0020->lv032;?>"/>
						<input type="hidden" name="txtlv033" id="txtlv033" value="<?php echo $mohr_lv0020->lv033;?>"/>
						<input type="hidden" name="txtlv034" id="txtlv034" value="<?php echo $mohr_lv0020->lv034;?>"/>
						<input type="hidden" name="txtlv035" id="txtlv035" value="<?php echo $mohr_lv0020->lv035;?>"/>
						<input type="hidden" name="txtlv036" id="txtlv036" value="<?php echo $mohr_lv0020->lv036;?>"/>
						<input type="hidden" name="txtlv037" id="txtlv037" value="<?php echo $mohr_lv0020->lv037;?>"/>
						<input type="hidden" name="txtlv038" id="txtlv038" value="<?php echo $mohr_lv0020->lv038;?>"/>
						<input type="hidden" name="txtlv039" id="txtlv039" value="<?php echo $mohr_lv0020->lv039;?>"/>
						<input type="hidden" name="txtlv040" id="txtlv040" value="<?php echo $mohr_lv0020->lv040;?>"/>
						<input type="hidden" name="txtlv041" id="txtlv041" value="<?php echo $mohr_lv0020->lv041;?>"/>
						<input type="hidden" name="txtlv042" id="txtlv042" value="<?php echo $mohr_lv0020->lv042;?>"/>
						<input type="hidden" name="txtlv043" id="txtlv043" value="<?php echo $mohr_lv0020->lv043;?>"/>
						<input type="hidden" name="txtlv044" id="txtlv044" value="<?php echo $mohr_lv0020->lv044;?>"/>

					    
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
div.innerHTML='<?php echo $mohr_lv0020->ArrPush[0];?>';	
<?php if($_GET['CandID']!="" && $_GET['CandID']!=NULL )
{
?>
setTimeout('Add()',1000);
<?php 
}
?>
</script>