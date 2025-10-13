<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/wh_lv0015.php");

/////////////init object//////////////
$mowh_lv0015=new  wh_lv0015($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0015');
/////////////init object//////////////

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","WH0022.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$mowh_lv0015->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$mowh_lv0015->lv003=$vNow;
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
$mowh_lv0015->lv012='3';

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
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	o.txtlv001.value=getChecked(o.chklv001.value,'chklv001');
	o.txtlv008.value=getChecked(o.chklv008.value,'chklv008');
	o.txtlv012.value=getChecked(o.chklv012.value,'chklv012');
	o.action="wh_lv0015?func=rpt";
	o.submit();
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
if($mowh_lv0015->GetView()==1)
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
							<tr>
							  <td width="166"  height="20"><?php echo $vLangArr[1];?></td>
							  <td  height="20">
							  <input name="txtlv001" type="hidden" id="txtlv001" value="<?php echo $morp_lv0005->lv001;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mowh_lv0015->GetBuilCheckListDept($mowh_lv0015->lv001,'chklv001',10,'wh_lv0001','lv002',$mowh_lv0015->lv001);?>
							<!--  <select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							   				<?php
												if($mowh_lv0015->GetApr()==11)
												{
												?>
												<option value="">...</option>
												<?php
												}
												?>
							  <?php //echo $mowh_lv0015->LV_LinkField('lv002',$mowh_lv0015->lv002);?>
							 
                              </select>-->							    </td>
							</tr><tr>
				      <td  height="20"><?php echo $vLangArr[2];?></td>
				      <td  height="20"><input name="txtlv002" type="text" id="txtlv002" value="<?php echo formatdate($mowh_lv0015->lv002,$plang);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv002);return false;" /></span></td>
						  </tr>							 
							
						  <tr>
				      <td  height="20"><?php echo $vLangArr[3];?></td>
				      <td  height="20"><input name="txtlv003" type="text" id="txtlv003" value="<?php echo formatdate($mowh_lv0015->lv003,$plang);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
				        <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv003);return false;" /></span></td>
						  </tr>					  						
						 <tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><select name="txtlv004" id="txtlv004"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)" onchange="ChangeSource(this)"/>
							  <option value="">...</option>
							  <?php echo $mowh_lv0015->LV_LinkField('lv004',$mowh_lv0015->lv004);?>
							  </select><div id="BalanceRef" name="BalanceRef" style="display:none"> Lấy liên kết nguồn <input type="checkbox" value="1" name="isbalance"  /></div>	</td></tr>
						  <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20">
							   <table width="80%"><tr><td width="50%">
							    <input name="txtlv005" type="text" id="txtlv005"  value="<?php echo $mowh_lv0015->lv005;?>" tabindex="10" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7)"/>
							    </td>
							    <td>
							   
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onKeyUp="LoadType(this)" onFocus="LoadType(this)"  tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>
							 
							 </td></tr>
						 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[5];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							   <!--<input name="txtlv006" type="text" id="txtlv006"  value="<?php echo $mowh_lv0015->lv006;?>" tabindex="7" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7)"/>
							  --><select name="txtlv006" id="txtlv006"   tabindex="7"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
							    
							  <option value="">...</option>
							  <?php echo $mowh_lv0015->LV_LinkField('lv006',$mowh_lv0015->lv006);?>
							  </select>
							  </td>
							  <td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv006','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv006','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
							 	<td  height="20">
								<input name="txtlv008" type="hidden" id="txtlv008" value="<?php echo $mowh_lv0015->lv008;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)">
									<div style="width:100%;height:100px;overflow:scroll;"> 
									<?php echo $mowh_lv0015->GetBuilCheckList($mowh_lv0015->lv008,'chklv008',10);?>
								</div>
								</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							  <input  name="txtlv007" type="text" id="txtlv007" value="<?php echo $mowh_lv0015->lv007;?>" tabindex="9" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" />
							  </td>
							  <td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv007_search" id="txtlv007_search" style="width:100%" onkeyup="LoadPopupParentWH(this,'txtlv007','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onfocus="LoadPopupParentWH(this,'txtlv007','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						  </tr>	
						  	<tr>
							  <td  height="20"><?php echo $vLangArr[29];?></td>
				  <td  height="20">
							  <table width="80%"><tr><td width="50%">
							  <input  name="txtlv009" type="text" id="txtlv009" value="<?php echo $mowh_lv0015->lv009;?>" tabindex="9" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" />
							  </td>
							  <td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv009_search" id="txtlv009_search" style="width:100%" onkeyup="LoadPopupParentWHVS(this,'txtlv009','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onfocus="LoadPopupParentWHVS(this,'txtlv009','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						  </tr>	
						  <tr>
							<td>Hiển thị cột thành tiền
							</td>
							<td>
							<input name="txtlv012" type="hidden" id="txtlv012" value="<?php echo $morp_lv0005->lv012;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mowh_lv0015->GetBuilCheckListGia($mowh_lv0015->lv012,'chklv012',10,'','lv002',$mowh_lv0015->lv012);?>	
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
					   <tr><td colspan="2"><?php echo $vLangArr[40];?><input type="checkbox" value="1" name="txtexist" checked="checked" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="lotcurview" name="lotcurview" style="display:none"> <?php echo $vLangArr[47];?> <input type="checkbox" value="1" name="txtexistcur" /></div></td></tr>
					   	<tr><td colspan="2"><?php echo $vLangArr[51];?><input type="checkbox" value="1" name="txtshowimage" checked="checked" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="lotcurview" name="lotcurview" style="display:none"> <?php echo $vLangArr[52];?> <input type="checkbox" value="1" name="txtshowimage" /></div></td></tr>										
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
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[0];?>';	
</script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
}
?>