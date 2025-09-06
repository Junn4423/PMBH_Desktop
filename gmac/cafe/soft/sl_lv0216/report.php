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
require_once("../../clsall/sl_lv0214.php");
/////////////init object//////////////
$mosl_lv0214=new sl_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0214');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$mosl_lv0214->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0214->ArrPush[0]=$vLangArr[17];
$mosl_lv0214->ArrPush[1]=$vLangArr[18];
$mosl_lv0214->ArrPush[2]=$vLangArr[19];
$mosl_lv0214->ArrPush[3]=$vLangArr[20];
$mosl_lv0214->ArrPush[4]=$vLangArr[21];
$mosl_lv0214->ArrPush[5]=$vLangArr[22];
$mosl_lv0214->ArrPush[6]=$vLangArr[23];
$mosl_lv0214->ArrPush[7]=$vLangArr[24];
$mosl_lv0214->ArrPush[8]=$vLangArr[25];
$mosl_lv0214->ArrPush[9]=$vLangArr[26];
$mosl_lv0214->ArrPush[10]=$vLangArr[27];
$mosl_lv0214->ArrPush[11]=$vLangArr[28];
$mosl_lv0214->ArrPush[12]=$vLangArr[29];
$mosl_lv0214->ArrPush[13]=$vLangArr[30];
$mosl_lv0214->ArrPush[14]=$vLangArr[31];
$mosl_lv0214->ArrPush[15]=$vLangArr[32];
$mosl_lv0214->ArrPush[16]=$vLangArr[33];
$mosl_lv0214->ArrPush[17]=$vLangArr[46];
$mosl_lv0214->ArrPush[18]=$vLangArr[47];
$mosl_lv0214->ArrPush[19]=$vLangArr[48];
$mosl_lv0214->ArrPush[20]=$vLangArr[49];
$mosl_lv0214->ArrPush[21]=$vLangArr[41];
$mosl_lv0214->ArrPush[26]=$vLangArr[54];
$mosl_lv0214->ArrPush[25]='Thành tiền';
$mosl_lv0214->ArrPush[905]='Ngày đơn hàng';
$mosl_lv0214->ArrPush[995]='Giờ vào';
$mosl_lv0214->ArrPush[996]='Giờ ra';


$mosl_lv0214->ArrFunc[0]='//Function';
$mosl_lv0214->ArrFunc[1]=$vLangArr[2];
$mosl_lv0214->ArrFunc[2]=$vLangArr[4];
$mosl_lv0214->ArrFunc[3]=$vLangArr[6];
$mosl_lv0214->ArrFunc[4]=$vLangArr[7];
$mosl_lv0214->ArrFunc[5]='';
$mosl_lv0214->ArrFunc[6]='';
$mosl_lv0214->ArrFunc[7]='';
$mosl_lv0214->ArrFunc[8]=$vLangArr[10];
$mosl_lv0214->ArrFunc[9]=$vLangArr[12];
$mosl_lv0214->ArrFunc[10]=$vLangArr[0];
$mosl_lv0214->ArrFunc[11]=$vLangArr[33];
$mosl_lv0214->ArrFunc[12]=$vLangArr[34];
$mosl_lv0214->ArrFunc[13]=$vLangArr[35];
$mosl_lv0214->ArrFunc[14]=$vLangArr[36];
$mosl_lv0214->ArrFunc[15]=$vLangArr[37];

////Other
$mosl_lv0214->ArrOther[1]=$vLangArr[31];
$mosl_lv0214->ArrOther[2]=$vLangArr[32];
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
$mosl_lv0214->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'sl_lv0214');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$mosl_lv0214->lv002=base64_decode($_GET['ID']);
$vFieldList=$mosl_lv0214->ListView;
$curPage = $mosl_lv0214->CurPage;
$maxRows =$mosl_lv0214->MaxRows;
$vOrderList=$mosl_lv0214->ListOrder;
$mosl_lv0214->datefrom=$_GET['datefrom'];
if($mosl_lv0214->datefrom!='') $mosl_lv0214->datefrom=recoverdate($mosl_lv0214->datefrom,$plang);
$mosl_lv0214->dateto=$_GET['dateto'];
if($mosl_lv0214->dateto!='') $mosl_lv0214->dateto=recoverdate($mosl_lv0214->dateto,$plang);
$mosl_lv0214->optrpt=$_GET['optrpt'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$mosl_lv0214->GetCount();
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
if($mosl_lv0214->GetView()==1)
{
?>
<div ondblclick="this.innerHTML=''" style="padding:5px;">
<table style="width:100%;max-with:375px;" border="0" cellspacing="0" cellpadding="0" align="center">
	<?php echo ($mosl_lv0214->lv011>0)?"<tr><td><img style='max-width:375px;width:100%;height:50px;' src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'></td></tr>":"<tr><td height=5></td></tr>";?>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''">
	<div style="clear:both;"> 
		<div style="float:left;width:85%;text-align:left;">
		
			<strong><span style="font:18px arial,tahoma"><?php echo $mosl_lv0214->GetCompany();?></span></strong>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐC: ';?><?php echo $mosl_lv0214->GetAddress();?></span>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐT: ';?><?php echo $mosl_lv0214->GetPhone();?>  </span>
			<!--<br><span style="font:10px arial,tahoma"><?php echo 'Web';?><?php echo $mosl_lv0214->GetWeb();?>   </span> -->
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
			echo $strDataShow = $mosl_lv0214->PrintInOutPutInStockDetail($plang, $vLangArr,$mosl_lv0214->datefrom,$mosl_lv0214->dateto,$mosl_lv0214->optrpt);
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
