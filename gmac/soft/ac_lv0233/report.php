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
require_once("../../clsall/ac_lv0233.php");

/////////////init object//////////////
$moac_lv0233=new ac_lv0233($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0233');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0029.txt",$plang);
$moac_lv0233->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0233->ArrPush[0]=$vLangArr[17];
$moac_lv0233->ArrPush[1]=$vLangArr[18];
$moac_lv0233->ArrPush[2]=$vLangArr[19];
$moac_lv0233->ArrPush[3]=$vLangArr[20];
$moac_lv0233->ArrPush[4]=$vLangArr[21];
$moac_lv0233->ArrPush[5]=$vLangArr[22];
$moac_lv0233->ArrPush[6]=$vLangArr[23];
$moac_lv0233->ArrPush[7]=$vLangArr[24];
$moac_lv0233->ArrPush[8]=$vLangArr[25];
$moac_lv0233->ArrPush[9]=$vLangArr[26];
$moac_lv0233->ArrPush[10]=$vLangArr[27];
$moac_lv0233->ArrPush[11]=$vLangArr[28];
$moac_lv0233->ArrPush[12]=$vLangArr[29];
$moac_lv0233->ArrPush[13]=$vLangArr[30];
$moac_lv0233->ArrPush[14]=$vLangArr[31];
$moac_lv0233->ArrPush[15]=$vLangArr[32];
$moac_lv0233->ArrPush[16]=$vLangArr[33];
$moac_lv0233->ArrPush[17]=$vLangArr[46];
$moac_lv0233->ArrPush[18]=$vLangArr[47];
$moac_lv0233->ArrPush[19]=$vLangArr[48];
$moac_lv0233->ArrPush[20]=$vLangArr[49];
$moac_lv0233->ArrPush[21]=$vLangArr[41];
$moac_lv0233->ArrPush[26]=$vLangArr[54];
$moac_lv0233->ArrPush[25]='Thành tiền';
$moac_lv0233->ArrPush[905]='Ngày đơn hàng';
$moac_lv0233->ArrPush[995]='Giờ vào';
$moac_lv0233->ArrPush[996]='中文';


$moac_lv0233->ArrFunc[0]='//Function';
$moac_lv0233->ArrFunc[1]=$vLangArr[2];
$moac_lv0233->ArrFunc[2]=$vLangArr[4];
$moac_lv0233->ArrFunc[3]=$vLangArr[6];
$moac_lv0233->ArrFunc[4]=$vLangArr[7];
$moac_lv0233->ArrFunc[5]='';
$moac_lv0233->ArrFunc[6]='';
$moac_lv0233->ArrFunc[7]='';
$moac_lv0233->ArrFunc[8]=$vLangArr[10];
$moac_lv0233->ArrFunc[9]=$vLangArr[12];
$moac_lv0233->ArrFunc[10]=$vLangArr[0];
$moac_lv0233->ArrFunc[11]=$vLangArr[33];
$moac_lv0233->ArrFunc[12]=$vLangArr[34];
$moac_lv0233->ArrFunc[13]=$vLangArr[35];
$moac_lv0233->ArrFunc[14]=$vLangArr[36];
$moac_lv0233->ArrFunc[15]=$vLangArr[37];

////Other
$moac_lv0233->ArrOther[1]=$vLangArr[31];
$moac_lv0233->ArrOther[2]=$vLangArr[32];
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
$moac_lv0233->LoadSaveOperation($_SESSION['ERPSOFV2RUserID'],'ac_lv0233');
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0233->lv002=base64_decode($_GET['ID']);
$vFieldList=$moac_lv0233->ListView;
$curPage = $moac_lv0233->CurPage;
$maxRows =$moac_lv0233->MaxRows;
$vOrderList=$moac_lv0233->ListOrder;
$moac_lv0233->datefrom=$_GET['datefrom'];
if($moac_lv0233->datefrom!='') $moac_lv0233->datefrom=recoverdate($moac_lv0233->datefrom,$plang);
$moac_lv0233->dateto=$_GET['dateto'];
if($moac_lv0233->dateto!='') $moac_lv0233->dateto=recoverdate($moac_lv0233->dateto,$plang);
$moac_lv0233->optrpt=$_GET['optrpt'];
if($maxRows ==0) $maxRows = 10;

$totalRowsC=$moac_lv0233->GetCount();
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
if($moac_lv0233->GetView()==1)
{
?>
<div ondblclick="this.innerHTML=''" style="padding:5px;">
<table style="width:100%;max-with:375px;" border="0" cellspacing="0" cellpadding="0" align="center">
	<?php echo ($moac_lv0233->lv011>0)?"<tr><td><img style='max-width:375px;width:100%;height:50px;' src='../../clsall/barcode/barcode.php?barnumber=".$mosl_lv0013->lv001."'></td></tr>":"<tr><td height=5></td></tr>";?>
   <tr>
    <td align="center" onDblClick="this.innerHTML=''">
	<div style="clear:both;"> 
		<div style="float:left;width:85%;text-align:left;">
		
			<strong><span style="font:18px arial,tahoma"><?php echo $moac_lv0233->GetCompany();?></span></strong>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐC: ';?><?php echo $moac_lv0233->GetAddress();?></span>
			<br><span style="font:12px arial,tahoma"><?php echo 'ĐT: ';?><?php echo $moac_lv0233->GetPhone();?>  </span>
			<!--<br><span style="font:10px arial,tahoma"><?php echo 'Web';?><?php echo $moac_lv0233->GetWeb();?>   </span> -->
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
			echo $strDataShow = $moac_lv0233->PrintInOutPutInStockDetail($plang, $vLangArr,$moac_lv0233->datefrom,$moac_lv0233->dateto,$moac_lv0233->optrpt);
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
