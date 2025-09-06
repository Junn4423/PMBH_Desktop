<?php
session_start();
$sExport=$_GET['childfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=employees.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=employees.doc');
}
if($sExport=="pdf"){
header('Content-Type: text/html; charset=utf-8');}

//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
//}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/rp_lv0011.php");
require_once("../../clsall/hr_lv0020.php");
require_once("../../clsall/tc_lv0009.php");
require_once("../../clsall/rp_lv0011.php");
/////////////init object//////////////
$morp_lv0011=new rp_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Rp0011');
$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","TC0052.txt",$plang);

//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->ArrPush[0]=$vLangArr[17];
$morp_lv0011->ArrPush[1]=$vLangArr[18];
$morp_lv0011->ArrPush[2]=$vLangArr[20];
$morp_lv0011->ArrPush[3]=$vLangArr[21];
$morp_lv0011->ArrPush[4]=$vLangArr[22];
$morp_lv0011->ArrPush[5]=$vLangArr[23];
$morp_lv0011->ArrPush[6]=$vLangArr[24];
$morp_lv0011->ArrPush[7]=$vLangArr[25];
$morp_lv0011->ArrPush[8]=$vLangArr[26];
$morp_lv0011->ArrPush[9]=$vLangArr[27];
$morp_lv0011->ArrPush[10]=$vLangArr[28];
$morp_lv0011->ArrPush[11]=$vLangArr[29];
$morp_lv0011->ArrPush[12]=$vLangArr[37];
$morp_lv0011->ArrPush[13]=$vLangArr[48];
$morp_lv0011->ArrPush[14]=$vLangArr[43];
$morp_lv0011->ArrPush[15]=$vLangArr[41];
$morp_lv0011->ArrPush[16]=$vLangArr[42];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
//$ma=$_GET['ma'];
$lvopt=$_GET['txtopt'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";
	//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'rp_lv0011');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$morp_lv0011->lv028=trim($_GET['txtlv003']);
$morp_lv0011->lv029=trim($_GET['txtlv002']);
$morp_lv0011->lv030=trim($_GET['txtlv004']);
$morp_lv0011->lv007=trim($_GET['txtlv006']);
$morp_lv0011->paratimecard=trim($_GET['txtlv020']);
$morp_lv0011->lvState=(int)($_GET['txtlv021']);
$morp_lv0011->lvSort=(int)($_GET['txtlv022']);
$morp_lv0011->datefrom=$_GET['txtdatefrom'];
$morp_lv0011->dateto=$_GET['txtdateto'];
$year=getyear($morp_lv0011->datefrom);
$month=getmonth($morp_lv0011->datefrom);
if($_GET['txtlv004']!="") $mohr_lv0020->LV_LoadID($_GET['txtlv004']);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vFieldList=$morp_lv0011->ListView;
$curPage = $morp_lv0011->CurPage;
$maxRows =$morp_lv0011->MaxRows;
$vOrderList=$morp_lv0011->ListOrder;

if($maxRows ==0) $maxRows = 10;

//$totalRowsC=$morp_lv0011->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<div>
<?php
if($morp_lv0011->GetView()==1)
{

	echo "<div style='width:600px'>
		<div style='text-align:center'><h1>".$vLangArr[54]."</h1></div>
		<div style='text-align:center'><strong>Date From ".$morp_lv0011->FormatView($morp_lv0011->datefrom,2)." to ".$morp_lv0011->FormatView($morp_lv0011->dateto,2)."</strong></div>
		<div>&nbsp;</div>
		</div>";
	$vFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv010,lv011";		
	$vOrderList='0,1,2,3,4,5,6,7,8,9,10,11';
	echo "<div>";
				echo $morp_lv0011->LV_BuilListReportOtherPrintLateSoon($vFieldList,'document.frmchoose','chkAll','lvChk',$curRow, $maxRows,$paging,$vOrderList,$lvopt);
    if(trim($mohr_lv0020->lv001)!="" && $mohr_lv0020->lv001!=NULL)
	{
		if($year=="" && $month=="")
		{
			$lvNow=GetServerDate();
			$lvyear=getyear($lvNow);
			$lvmonth=getmonth($lvNow);
			echo $morp_lv0011->GetTimeCode($mohr_lv0020->lv001,"2000-01-01",$lvyear."-".$lvmonth."-".GetDayInMonth((int)$lvyear,(int)$lvmonth),'GLVT');
		}
		else
    		echo $morp_lv0011->GetTimeCode($mohr_lv0020->lv001,$year."-".$month."-01",$year."-".$month."-".GetDayInMonth((int)$year,(int)$month),'GLVT');
    }            
                
?>	
<h2><?php echo $vLangArr[48];?></h2>
<br />	
<ul>
<li><?php echo $vLangArr[49];?></li>
<li><?php echo $vLangArr[50];?></li>
<li><?php echo $vLangArr[51];?></li>
<li><?php echo $vLangArr[52];?></li>
<li><?php echo $vLangArr[53];?></li>
</ul>	
</div>
</div>		
<?php
} else {
	include("../permit.php");
}
?>
