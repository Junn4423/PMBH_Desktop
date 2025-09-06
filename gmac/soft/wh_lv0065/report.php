<?php
session_start();
$sExport=$_GET['childdetailfunc'];
if ($sExport == "excel") {
   header('Content-Type: application/vnd.ms-excel; charset=utf-8');
   header('Content-Disposition: attachment; filename=danh_thu_ban_hang.xls');
}
if ($sExport == "word") {
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename=danh_thu_ban_hang.doc');
}
if($sExport=="pdf"){
//header('Content-type: application/pdf');
//header('Content-Disposition: attachment; filename="employees.pdf"');
}
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/wh_lv0065.php");

/////////////init object//////////////
$mowh_lv0065=new wh_lv0065($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0065');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mowh_lv0065->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0065->ArrPush[0]=$vLangArr[17];
$mowh_lv0065->ArrPush[1]=$vLangArr[18];
$mowh_lv0065->ArrPush[2]=$vLangArr[19];
$mowh_lv0065->ArrPush[3]=$vLangArr[20];
$mowh_lv0065->ArrPush[4]=$vLangArr[21];
$mowh_lv0065->ArrPush[5]=$vLangArr[22];
$mowh_lv0065->ArrPush[6]=$vLangArr[23];
$mowh_lv0065->ArrPush[7]=$vLangArr[24];
$mowh_lv0065->ArrPush[8]=$vLangArr[25];
$mowh_lv0065->ArrPush[9]=$vLangArr[26];
$mowh_lv0065->ArrPush[10]=$vLangArr[27];
$mowh_lv0065->ArrPush[11]=$vLangArr[28];
$mowh_lv0065->ArrPush[12]=$vLangArr[29];
$mowh_lv0065->ArrPush[13]=$vLangArr[30];
$mowh_lv0065->ArrPush[14]=$vLangArr[31];
$mowh_lv0065->ArrPush[15]=$vLangArr[32];
$mowh_lv0065->ArrPush[16]=$vLangArr[33];
$mowh_lv0065->ArrPush[17]=$vLangArr[46];
$mowh_lv0065->ArrPush[18]=$vLangArr[47];
$mowh_lv0065->ArrPush[19]=$vLangArr[48];
$mowh_lv0065->ArrPush[20]=$vLangArr[49];
$mowh_lv0065->ArrPush[21]=$vLangArr[41];
$mowh_lv0065->ArrPush[26]=$vLangArr[54];
$mowh_lv0065->ArrPush[25]='Thành tiền';
$mowh_lv0065->ArrPush[905]='Ngày đơn hàng';
$mowh_lv0065->ArrPush[995]='Giờ vào';
$mowh_lv0065->ArrPush[996]='Giờ ra';


$mowh_lv0065->ArrFunc[0]='//Function';
$mowh_lv0065->ArrFunc[1]=$vLangArr[2];
$mowh_lv0065->ArrFunc[2]=$vLangArr[4];
$mowh_lv0065->ArrFunc[3]=$vLangArr[6];
$mowh_lv0065->ArrFunc[4]=$vLangArr[7];
$mowh_lv0065->ArrFunc[5]='';
$mowh_lv0065->ArrFunc[6]='';
$mowh_lv0065->ArrFunc[7]='';
$mowh_lv0065->ArrFunc[8]=$vLangArr[10];
$mowh_lv0065->ArrFunc[9]=$vLangArr[12];
$mowh_lv0065->ArrFunc[10]=$vLangArr[0];
$mowh_lv0065->ArrFunc[11]=$vLangArr[33];
$mowh_lv0065->ArrFunc[12]=$vLangArr[34];
$mowh_lv0065->ArrFunc[13]=$vLangArr[35];
$mowh_lv0065->ArrFunc[14]=$vLangArr[36];
$mowh_lv0065->ArrFunc[15]=$vLangArr[37];

////Other
$mowh_lv0065->ArrOther[1]=$vLangArr[31];
$mowh_lv0065->ArrOther[2]=$vLangArr[32];
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];

//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$vStrMessage="";

	//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0065->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'wh_lv0065');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mowh_lv0065->lv002=base64_decode($_GET['ID']);
$vFieldList=$mowh_lv0065->ListView;
$curPage = $mowh_lv0065->CurPage;
$maxRows =$mowh_lv0065->MaxRows;
$vOrderList=$mowh_lv0065->ListOrder;
$mowh_lv0065->datefrom=$_GET['datefrom'];
if($mowh_lv0065->datefrom!='') $mowh_lv0065->datefrom=recoverdate($mowh_lv0065->datefrom,$plang);
$mowh_lv0065->dateto=$_GET['dateto'];
if($mowh_lv0065->dateto!='') $mowh_lv0065->dateto=recoverdate($mowh_lv0065->dateto,$plang);
$mowh_lv0065->optrpt=$_GET['optrpt'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mowh_lv0065->GetCount();
$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmchoose','document.frmchoose.curPg',2);
?>
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if($mowh_lv0065->GetView()==1)
{
?>
<div ondblclick="this.innerHTML=''" style="padding:5px;">
<table style="width:100%;max-with:375px;" border="0" cellspacing="0" cellpadding="0" align="center">
	<?php echo ($mowh_lv0065->lv011>0)?"<tr><td><img style='max-width:375px;width:100%;height:50px;' src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'></td></tr>":"<tr><td height=5></td></tr>";?>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''">
	<div style="clear:both;"> 
		<div style="float:left;width:85%;text-align:left;">
		
			<strong><span style="font:18px arial,tahoma"><?php echo $mowh_lv0065->GetCompany();?></span></strong>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐC: ';?><?php echo $mowh_lv0065->GetAddress();?></span>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐT: ';?><?php echo $mowh_lv0065->GetPhone();?>  </span>
			<!--<br><span style="font:10px arial,tahoma"><?php echo 'Web';?><?php echo $mowh_lv0065->GetWeb();?>   </span> -->
	</div>
	<div style="float:left;width:15%"><center><img src="../../logo.png" width="54"/></center></div>
    </div></td>
  </tr>
  <tr>
    <td align="center">
	<div id='idphieu'  style="font-size:18px;font-weight:bold">PHIẾU THU TIỀN</div></td>
  </tr>
   <tr>
    <td align="center">
    Từ ngày: <?php echo $_GET['datefrom'];?> đến <?php echo $_GET['dateto'];?>
    
	</td>
	</tr>
	<tr>
	<td>
  <?php
			echo $strDataShow = $mowh_lv0065->PrintInOutPutInStockDetail($plang, $vLangArr,$mowh_lv0065->datefrom,$mowh_lv0065->dateto,$mowh_lv0065->optrpt);
		?>		
                        <td>
    </tr>
    <td>
	<br/>
			<table width="100%" style="border:0px;text-align:left;" cellpadding="0" cellspacing="0">
				
  <tr></td>
			<table width="100%" style="border:0px;text-align:left;" cellpadding="0" cellspacing="0">
     
          <TR VALIGN=TOP>
          <TD NOWRAP ALIGN="CENTER"><B>Người duyệt</B></TD>
          <TD NOWRAP ALIGN="CENTER" COLSPAN=2><B>Người lập phiếu</B></TD>
      </TR>
      <TR VALIGN=TOP height="100">
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>&nbsp;</TD>
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>&nbsp;</TD>
      </TR>
      <TR VALIGN=TOP>
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>(Ký, ghi rõ họ tên)</TD>
        <TD NOWRAP ALIGN="CENTER" COLSPAN=2>(Ký, ghi rõ họ tên)</TD>
      </TR>
      </table>
</td>
</tr>
</table>
<?php
} else {
	include("../permit.php");
}
?>
