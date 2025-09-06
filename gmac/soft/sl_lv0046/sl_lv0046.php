<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0046.php");

/////////////init object//////////////
$mosl_lv0046=new  sl_lv0046($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0046');
/////////////init object//////////////

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","SL0066.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$mosl_lv0046->lv002=getyear($vNow)."-".getmonth($vNow)."-"."01";
$mosl_lv0046->lv003=$vNow;
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
function RptWH(vValue)
{
 	var o=document.frmRpt;
	o.target="_blank";
	o.txtlv008.value=getChecked(o.chklv008.value,'chklv008');
	o.action="sl_lv0046?func=rpt";
	o.submit();
}
function LoadType(to)
	{

		var o=document.frmRpt;
		var vo=o.txtlv004.value;
		switch(vo)
		{
			case 'CONTRACT':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv005','sl_lv0013','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv005','wh_lv0021','lv003');
				break;
			case 'CUS':
				LoadPopupParent(to,'txtlv005','sl_lv0001','concat(lv002,@!-@!,lv001)');
				break;
		}
	}

function Refresh()
{
	
}
//-->
</script>
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
							  <td width="178"  height="20"><select name="txtlv001" id="txtlv001"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							  <option value="">...</option>
								<?php echo $mosl_lv0046->LV_LinkField('lv002',$mosl_lv0046->lv002);?>
							 
                              </select>							    </td>
							</tr><tr>
				      <td  height="20"><?php echo $vLangArr[2];?></td>
				      <td  height="20"><input name="txtlv002" type="text" id="txtlv002" value="<?php echo formatdate($mosl_lv0046->lv002,$plang);?>" tabindex="7" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
			          <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="110"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv002);return false;" /></span></td>
						  </tr>							 
							
						  <tr>
				      <td  height="20"><?php echo $vLangArr[3];?></td>
				      <td  height="20"><input name="txtlv003" type="text" id="txtlv003" value="<?php echo formatdate($mosl_lv0046->lv003,$plang);?>" tabindex="8" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
				        <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="110"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmRpt.txtlv003);return false;" /></span></td>
						  </tr>					  						
						 <tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><select name="txtlv004" id="txtlv004"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
							  <option value="">...</option>
							  <?php echo $mosl_lv0046->LV_LinkField('lv004',$mosl_lv0046->lv004);?>
							  </select>	</td></tr>
						  <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20"><table width="80%"><tr><td width="50%">
							  <input name="txtlv005" type="text" id="txtlv005"  value="<?php echo $mosl_lv0046->lv005;?>" tabindex="10" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv005_search" id="txtlv005_search" style="width:100%" onKeyUp="LoadType(this)" onFocus="LoadType(this)"  tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td></tr>
						 <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[5];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td width="50%">
								<select name="txtlv006" id="txtlv006"   tabindex="11"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
									<option value="">...</option>
									<?php echo $mosl_lv0046->LV_LinkField('lv006',$mosl_lv0046->lv006);?>
								</select>
								</td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv006_search" id="txtlv006_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv006','sl_lv0007','lv002')" onFocus="LoadPopupParent(this,'txtlv006','sl_lv0007','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>		</td>
						    </tr>
                             <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[39];?></td>
							  <td  height="20"><input name="txtlv008" type="hidden" id="txtlv008" value="<?php echo $mosl_lv0046->lv008;?>" tabindex="12" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo $mosl_lv0046->GetBuilCheckList($mosl_lv0046->lv008,'chklv008',12);?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				  <td  height="20"><table width="80%"><tr><td width="50%"><input  name="txtlv007" type="text" id="txtlv007" value="<?php echo $mosl_lv0046->lv007;?>" tabindex="13" maxlength="255" style="width:100%" onKeyPress="return CheckKey(event,7)" /><br>
							  </td><td>
							  <ul id="pop-nav3" lang="pop-nav3" onkeyup="ChangeName(this,3)" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:100%" onkeyup="LoadPopupParentWH(this,'txtlv007','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onfocus="LoadPopupParentWH(this,'txtlv007','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						  </tr>	
						  <tr>
							  <td  height="20">&nbsp;</td>
							  <td  height="20"><select name="rad" id="rad" tabindex="14">
							  <option value="2"><?php echo $vLangArr[35];?></option>
							  <option value="3"><?php echo $vLangArr[36];?></option>
							    </select>							  </td>
					   </tr>	
					   											
							<tr>
							  <td  height="20" colspan="2"><input name="func" type="hidden" id="func" value="rpt"  /></td>
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