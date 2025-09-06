<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/wh_lv0075.php");

/////////////init object//////////////
$mowh_lv0075=new  wh_lv0075($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0075');
/////////////init object//////////////

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","WH0022.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$mowh_lv0075->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$mowh_lv0075->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$mowh_lv0075->lv012='3';

$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vStrMessage=GetNoDelete($strar,"",$lvMessage);
}
elseif($flagID==2)
{

}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
}
else//last is RptWH
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
}
if($maxRows ==0) $maxRows = 10;

$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmRpt','document.frmRpt.curPg',2);
?>
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../javascript/engine.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function getChecked(len,nameobj)
{
	var str='';
	for(i=0;i<len;i++)
	{
	div = document.getElementById(nameobj+i);
	if(div.checked)
		{
		if(str=='') 
			str=div.value;
		else
			 str=str+','+div.value;
		}
	
	}
	return str;
}

function LoadType(to)
	{

		var o=document.frmRpt;
		var vo=o.txtlv004.value;
		switch(vo)
		{
			case 'GMAC':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
		}
	}
function ChangeSource(o)
{
	var o1=document.getElementById("BalanceRef");
	document.frmRpt.txtexistcur.checked=false;
	if(o.value!='')
	{
		o1.style.display="block";
		document.frmRpt.isbalance.checked=true;
		
	}
	else
	{
		document.frmRpt.isbalance.checked=false;
		o1.style.display="none";
	}
}	
function LotChange(o)
{
	var o1=document.getElementById("lotcurview");
	
	document.frmRpt.txtexistcur.checked=false;
	if(o.value=="3")
	{
		o1.style.display="block";
		
	}
	else
	{
		o1.style.display="none";
	}
}
function Refresh()
{
	
}
function nhapkho()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAyL3doX2x2MDEwMi5waHA=','_self');
}
function  kiemkho()
{
	window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAzL3doX2x2MDEwMy5waHA=','_self');
}
function TaoBang()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDA4L3NsX2x2MDAwOC5waHA=','_self');
}
function  sanpham()
{
	window.open('?lang=<?php echo $plang;?>&opt=19&item=&link=c2xfbHYwMDA3L3NsX2x2MDAwNy5waHA=','_self');
}
function CombackHome()
{
	window.open('?lang=<?php echo $plang;?>','_self')
}
//-->
</script>
<?php
if($mowh_lv0075->GetView()==1)
{
?>
<div class="hd_cafe">
	<ul class="qlycafe">
		<li><div class="licafe" onclick="nhapkho()" >NHẬP KHO</div></li>
		<li><div class="licafe" onclick="kiemkho()">KIỂM KHO</div></li>
		<li><div class="licafe" onclick="sanpham()">CÔNG THỨC</div></li>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>
		
	</ul>
</div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form  method="get" name="frmRpt" id="frmRpt" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $plang;?>" />
					 <table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							
							  
							  <?php 
							  
							 $vStr=$mowh_lv0075->GetBuilCheckListDept($mowh_lv0075->lv001,'chklv001',10,'wh_lv0001','lv002',$mowh_lv0075->lv001,$vCount);
							 if($vCount<=1)
							 {
								 echo  $vStr;
							 }
							 else
							 {
								 echo '<tr>
							 	 <td width="166"  height="20">'.$vLangArr[1].'</td>
							 	 <td  height="20">';
							  	echo $vStr;
								echo '</td></tr>';
							 }
							 ?>
							<!--  <select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							   				<?php
												if($mowh_lv0075->GetApr()==11)
												{
												?>
												<option value="">...</option>
												<?php
												}
												?>
							  <?php //echo $mowh_lv0075->LV_LinkField('lv002',$mowh_lv0075->lv002);?>
							 
                              </select>-->							    </td>
							</tr>
						<tr>
							<td  height="20"><?php echo $vLangArr[2];?></td>
							<td  height="20"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv002);return false;" name="txtlv002" type="text" id="txtlv002" value="<?php echo formatdate($mowh_lv0075->lv002,$plang);?>" tabindex="11" maxlength="100" style="width:100%;text-align:center;" onKeyPress="return CheckKey(event,7)">
							</td>
						</tr>							 
						<tr>
							<td  height="20"><?php echo $vLangArr[3];?></td>
							<td  height="20"><input onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv003);return false;" name="txtlv003" type="text" id="txtlv003" value="<?php echo formatdate($mowh_lv0075->lv003,$plang);?>" tabindex="11" maxlength="100" style="width:100%;text-align:center;" onKeyPress="return CheckKey(event,7)"></td>
						</tr>					  						
						<tr>
						<td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
						<td  height="20">
						<input name="txtlv008" type="hidden" id="txtlv008" value="<?php echo $mowh_lv0075->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
							<div style="width:100%;height:140px;overflow:scroll;"> 
							<?php echo $mowh_lv0075->GetBuilCheckList($mowh_lv0075->lv008,'chklv008',10);?>
						</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="height:1px;border-top:1px #000 solid;"></td>
					</tr>
						 
						  <tr>
							<td>Hiển thị cột thành tiền
							</td>
							<td>
							<input name="txtlv012" type="hidden" id="txtlv012" value="<?php echo $morp_lv0005->lv012;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> 
							<div style="width:100%;height:70px;overflow:scroll;"> 
							<?php echo $mowh_lv0075->GetBuilCheckListGia($mowh_lv0075->lv012,'chklv012',10,'','lv002',$mowh_lv0075->lv012);?>	
							</div>
							</td>
						  </tr>
						  <tr>
							  <td  height="20"><?php echo $vLangArr[41];?></td>
							  <td  height="20"><select name="rad" id="rad" tabindex="10" onchange="LotChange(this)">
							  <option value="2"><?php echo $vLangArr[35];?></option>
							  <option value="3"><?php echo $vLangArr[36];?></option>
							  <option value="4"><?php echo $vLangArr[36]." Lot";?></option>
							  <option value="5"><?php echo 'Báo cáo kho thay thế và hư theo ngày';?></option>
							  <option value="6"><?php echo 'Báo cáo kho thay thế và hư theo tháng';?></option>
							    </select>							  </td>
					   </tr>	
					   <tr><td ><?php echo $vLangArr[40];?><input type="checkbox" value="1" name="txtexist" checked="checked" /><div id="lotcurview" name="lotcurview" style="display:none"> <?php echo $vLangArr[47];?> <input type="checkbox" value="1" name="txtexistcur" /></div></td>
					   	<td ><?php echo $vLangArr[51];?><input type="checkbox" value="1" name="txtshowimage" checked="checked" /><div id="lotcurview" name="lotcurview" style="display:none"> <?php echo $vLangArr[52];?> <input type="checkbox" value="1" name="txtshowimage" /></div></td></tr>										
							<tr>
							  <td  height="20"><?php echo ($plang=='VN')?'Chọn hình thức báo cáo':'Option type report';?></td>
							  <td  height="20" colspan="2">
							  <select name="func" id="func" tabindex="10" onchange="LotChange(this)">
								  <option value="rpt">...</option>
								  <option value="excel">Excel</option>
								  <option value="world">World</option>
							  </select>
							  </td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:RptWH();" tabindex="47"><img src="../images/lvicon/Rpt.png" 
            alt="RptWH" title="<?php echo $vLangArr[12];?>" 
            name="RptWH" border="0" align="middle" id="RptWH" /> <?php echo $vLangArr[12];?></a></TD>
                    <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[13];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[13];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>  
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<script language="javascript">
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	<?php 
	if($vCount>1)
	{?>
	o.txtlv001.value=getChecked(o.chklv001.value,'chklv001');
	<?php
	}
	?>
	o.txtlv008.value=getChecked(o.chklv008.value,'chklv008');
	o.txtlv012.value=getChecked(o.chklv012.value,'chklv012');
	o.action="wh_lv0075?func=rpt";
	o.submit();
}
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[0];?>';	
</script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
}
?>