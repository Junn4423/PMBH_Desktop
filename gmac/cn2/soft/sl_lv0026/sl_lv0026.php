<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0024.php");
require_once("$vDir../clsall/sl_lv0025.php");
require_once("$vDir../clsall/wh_lv0020.php");
require_once("$vDir../clsall/wb_lv0006.php");	
////////init object////////////////////
	$mosl_lv0024=new sl_lv0024($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0024');
	$mosl_lv0025=new sl_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0025');
	$mowb_lv0006=new wb_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wb0011');
	$mosl_lv0025->obj_wb_lv0006=$mowb_lv0006;
if(isset($_GET['ajax']))
{
	$vwarehouseid=$_GET['warehouseid'];
	echo '[CHECK]';
	echo '<select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeyup="search_item(event)"  onkeypress="return CheckKeys(event,1,this)" onBlur="LoadItem()"/>'.$mosl_lv0025->LV_LinkFieldExt('lv003',$vwarehouseid).'</select>	';
	echo '[ENDCHECK]';
	exit;
}	
if(isset($_GET['ajaxlot']))
{
	$mosl_lv0025=new sl_lv0025($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0011');
	$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0020');
	$mosl_lv0025->objlot=$mowh_lv0020;
	$mosl_lv0025->lang=$plang;
	$mosl_lv0025->objlot->lv003=$_GET['whid'];
	echo '[CHECKLOT]';
	$strLot=$mosl_lv0025->LV_LinkField('lv014',$_GET['itemid']);
	if($strLot!="")
	{
		echo '<select name="txtlv914" id="txtlv914"   tabindex="22"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" ><option value="">...Chọn lô</option>'.$strLot.'</select>	';
	}
	else
		{
		echo '<input  name="txtlv914" type="text" id="txtlv914" value="" tabindex="23" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,1,this)" />';
		}
	echo '[ENDCHECKLOT]';
	exit;
}	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0039.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0040.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$mosl_lv0024->lv001=InsertWithCheck('wh_lv0010', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);
$isExists = 0;//$mosl_lv0024->LV_Exist($mosl_lv0024->lv001);
$mosl_lv0024->lv009=$_POST['txtlv809'];
$mosl_lv0024->lv009=($mosl_lv0024->lv009=="")?GetServerDate():$mosl_lv0024->lv009;
if($flagCtrl == 1){
$mosl_lv0024->lv002=$_POST['txtlv802'];
$mosl_lv0024->lv011=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$mosl_lv0024->lv004=$_POST['txtlv804'];
$mosl_lv0024->lv005=$_POST['txtlv805'];
$mosl_lv0024->lv006=$_POST['txtlv806'];
$mosl_lv0024->lv007=0;	
$mosl_lv0024->lv008=$_POST['txtlv808'];
$mosl_lv0024->lv003=$_POST['txtlv803'];
$mosl_lv0024->lv010=$_POST['txtlv810'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mosl_lv0024->LV_InsertTemp();
		if($bResultI == true){
			$mosl_lv0025->LV_InsertTemp($mosl_lv0024->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
			$mosl_lv0024->lv001="";
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mosl_lv0025->lv007==0){
			$mosl_lv0024->LV_Update();
			$mosl_lv0025->LV_InsertTemp($mosl_lv0024->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
$mosl_lv0024->ArrPush[0]=$vLangArr1[38];
$mosl_lv0024->ArrPush[1]=$vLangArr1[18];
$mosl_lv0024->ArrPush[2]=$vLangArr1[19];
$mosl_lv0024->ArrPush[3]=$vLangArr1[20];
$mosl_lv0024->ArrPush[4]=$vLangArr1[21];
$mosl_lv0024->ArrPush[5]=$vLangArr1[22];
$mosl_lv0024->ArrPush[6]=$vLangArr1[23];
$mosl_lv0024->ArrPush[7]=$vLangArr1[24];
$mosl_lv0024->ArrPush[8]=$vLangArr1[25];
$mosl_lv0024->ArrPush[9]=$vLangArr1[26];
$mosl_lv0024->ArrPush[10]=$vLangArr1[27];
$vFieldList="lv001,lv004,lv009";
$strParent=$mosl_lv0024->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mosl_lv0024->Load($mosl_lv0024->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>
	
	<!--
	function search_item(e)
	{
		var keynum;
		var keychar;
		var numcheck;
		if(window.event) // IE
		  {
		  keynum = e.keyCode;
		  }
		else if(e.which) // Netscape/Firefox/Opera
		  {
		  keynum = e.which;
		  }
		else
		{
			keynum = e.keyCode;
		}
		if(keynum=="115")
		{
			var o=document.frmadd;
			o.txtlv903_search.focus();
		}
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv802.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv802.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	function RunFunction()
	{
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>wh_lv0031/wh_lv0031.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	document.frmadd.txtlv903.focus();
	}
	function Add()
	{
	CalculateM();
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv014="+o.txtlv914.value+"&txtlv015="+o.txtlv915.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>wh_lv0031/wh_lv0031.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv002,@! @!,lv001)');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','concat(lv003,@! @!,lv002,@! @!,lv001)');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
			case 'CUS':
				LoadPopupParent(to,'txtlv806','*@*@*.sl_lv0001','lv002');
				break;
			case 'WEBTRANSAC':
				LoadPopupParentSecond(to,'txtlv806','wb_lv0016','concat(lv002,@! @!,lv005,@! @!,lv009,@! @!,lv015,@! =@!,lv001)');
				break;
		}
	}
	function LoadSource()
	{
	var o=document.frmadd;
	var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'WEBTRANSAC':
				ajax_do ('sl_lv0026/sl_lv0026excesource.php?&lang=<?php echo $plang;?>&Type=WEBTRANSAC&&childfunc=load'+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
			case 'CONTRACT':
				ajax_do ('sl_lv0026/sl_lv0026excesource.php?&lang=<?php echo $plang;?>&Type=CONTRACT&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
			case 'RECONTRACT':
				ajax_do ('sl_lv0026/sl_lv0026excesource.php?&lang=<?php echo $plang;?>&Type=RECONTRACT&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
			case 'PO':
				ajax_do ('sl_lv0026/sl_lv0026excesource.php?&lang=<?php echo $plang;?>&Type=PO&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}		
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv911.value/100);
		o.txtlv910amount.value=parseFloat(o.txtlv904.value*o.txtlv908.value*o.txtlv910.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv910amount.value)+parseFloat(o.txtlv904.value*o.txtlv908.value);
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('sl_lv0026/sl_lv0026exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
		changeitemlot_change(o.txtlv903.value,o.txtlv802.value);
	}
	function Report(vValue)
	{
	var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0024?func=<?php echo $_GET['func'];?>&childfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	-->
	</script>
</head>
<?php
if($mosl_lv0024->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="center">
				<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
					<tr><td class="td" colspan="3">&nbsp;</td></tr>
					<tr>
						<td>&nbsp;</td>
						<td class="td" width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="td" align="center">
										<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="td" height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
													<td class="td" width="18%" height="20px" align="left"><?php echo $vLangArr[19];?></td>	
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('wh_lv0010', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
												  <td class="td" width="33%">
												  <select name="txtlv802" id="txtlv802"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"  onchange="changewarehourse_change(this.value)">
                                                     <?php echo $mosl_lv0024->LV_LinkField('lv002',$mosl_lv0024->lv002);?>
                                                  </select>
                                                   </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[22];?></td>
												  <td height="20px" class="td"><input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $mosl_lv0024->lv004;?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>		<td><?php echo $vLangArr[27];?></td>
												  <td><input name="txtlv809" type="text" id="txtlv809" value="<?php echo $mosl_lv0024->FormatView($mosl_lv0024->lv009,2);?>" tabindex="111" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true" />
                                                    </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[23];?></td>
													<td height="20px" class="td"><label>
													  <select name="txtlv805" id="txtlv805"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
                                                      <?php echo $mosl_lv0024->LV_LinkField('lv005',$mosl_lv0024->lv005);?>
                                                      </select><input type="button" name="Load2" value="۩▲" tabindex="20" onClick="LoadSource()" >
													</label></td>
												    <td height="20px" class="td" ><?php echo $vLangArr[24];?></td>
												    <td height="20px" class="td">
                                                      <table style="width:80%"><tr>
                                                      	  <td><input name="txtlv806" type="text" id="txtlv806"  value="<?php echo $mosl_lv0024->lv006;?>" tabindex="6" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/></td>                                                          
                                                          <td><ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav3">
                                                              <li class="menupopT">
                                                                <input type="text" autocomplete="off" class="search_img_btn" name="txtlv806_search" id="txtlv806_search" style="width:100%" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="200">
                                                                <div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
                                                              </li>
                                                          </ul></td>
                                                        </tr>
                                                      </table></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr1[40];?></td>
													<td height="20px" class="td"><label>
													  <select name="txtlv810" id="txtlv810"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
														<option value="">...</option>
                                                      <?php echo $mosl_lv0024->LV_LinkField('lv010',$mosl_lv0024->lv010);?>
                                                      </select>
													</label></td>
												    <td height="20px" class="td" ><?php echo $vLangArr1[41];?></td>
												    <td height="20px" class="td">
                                                      <table style="width:80%"><tr>
                                                      	  <td><select name="txtlv803" id="txtlv803"   tabindex="9"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
                                                      <?php echo $mosl_lv0024->LV_LinkField('lv011',$mosl_lv0024->lv011);?>
                                                      </select></td>                                                          
                                                          <td><ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" xml:lang="pop-nav5">
                                                              <li class="menupopT">
                                                                <input type="text" autocomplete="off" class="search_img_btn" name="txtlv803_search" id="txtlv803_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv803','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv803','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002)')" tabindex="200">
                                                                <div id="lv_popup5" lang="lv_popup5" xml:lang="lv_popup5"> </div>
                                                              </li>
                                                          </ul></td>
                                                        </tr>
                                                      </table></td>
												</tr>
												<tr height="1">
													<td class="td"><?php echo $vLangArr[26];?></td>
												    <td colspan="3" class="td"><textarea name="txtlv808" rows="3" id="txtlv808" style="width:80%" tabindex="9" ><?php echo $mosl_lv0024->lv008;?></textarea></td>
											    </tr>												
												<tr height="1">
												  <td class="td" colspan="4">&nbsp;</td>
												</tr>
												
												<tr height="1">
												  <td class="td" colspan="4"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13">
				<img name="table_r1_c1" src="<?php echo $vDir;?>images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="<?php echo $vDir;?>images/pictures/table_r1_c2.gif">
				<img name="table_r1_c2" src="<?php echo $vDir;?>images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td width="13">
				<img name="table_r1_c3" src="<?php echo $vDir;?>images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				<img src="<?php echo $vDir;?>images/pictures/spacer.gif" 
					width="1" height="12" border="0" alt=""></td>
		</tr>
		<tr>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c1.gif">
				<img name="table_r2_c1" src="<?php echo $vDir;?>images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td><table width="100%" border="0">
                                                    <tr>
                                                      <td width="100%" align="center" class="detail_title"><?php echo $vLangArr[16];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="13%"><?php echo $vLangArr[31];?></td>
                                                          <td width="34%">
                                                          <table border=0 cellpadding="0" cellspacing="0" width="100%"><tr><td width="80%"><div id="itemsgetid"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" onblur="LoadItem()"/>
                                                            </select></div></td><td width="20%">
                                                            </td></tr></table>
                                                            <td>
                                                          <table style="width:80%">
                                                              <tr>
                                                                <td><ul id="pop-nav4" lang="pop-nav4" onkeyup="ChangeName(this,4)" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv903','*@*@*.sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','*@*@*.sl_lv0007','concat(lv002,@!-@!,lv010,@! @!,lv001)')" tabindex="200">
                                                                      <div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
                                                                    </li>
                                                                </ul></td>
                                                              </tr>
                                                            </table></td>
                                                          <td align="right" style="postion:relative"><div style="postion:relative;width:50%px;"><img id="txtimg_load_sp" name="txtimg_load_sp" style="right:50px;position:absolute;" src="http://thegioithietbilanh.vn/wp-content/plugins/load_products_content_trangchu/images/loading.gif" border="0" height="50"/></div></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[32];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()" name="txtlv904" id="txtlv904"   tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mosl_lv0025->lv004;?>"/></td>
                                                          <td><?php echo $vLangArr[33];?></td>
                                                          <td><select name="txtlv905" id="txtlv905"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mosl_lv0025->LV_LinkField('lv005',$mosl_lv0025->lv005);?>
                                                            </select>
                                                            <br /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[34];?></td>
                                                          <td><input name="txtlv906" type="text" id="txtlv906" value="<?php echo (float)$mosl_lv0025->lv006;?>" tabindex="22" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr[35];?></td>
                                                          <td><select name="txtlv907" id="txtlv907"   tabindex="11"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $mosl_lv0025->LV_LinkField('lv007',$mosl_lv0025->lv007);?>
                                                            </select></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[42];?></td>
                                                          <td>
															  <table style="width:80%"><tr>
															  <td><div id="txtlotid"><input  name="txtlv914" type="text" id="txtlv914" value="<?php echo $mosl_lv0025->lv014;?>" tabindex="23" maxlength="255" style="width:100%" onKeyPress="return CheckKeys(event,1,this)" /></div></td>
															  <td>
															    <ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
															      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv914_search" id="txtlv914_search" style="width:100%" onKeyUp="LoadPopupParentWHCondi(this,'txtlv914','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)" onFocus="LoadPopupParentWHCondi(this,'txtlv914','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)',document.frmadd.txtlv802.value)"  tabindex="200" >
															      <div id="lv_popup7" lang="lv_popup7"> </div>						  
														  		</li>
													  			</ul></td></tr></table>
													  		</td>
                                                          <td><?php echo $vLangArr[43];?></td>
                                                          <td><input  name="txtlv915" type="text" id="txtlv915" value="<?php echo $mosl_lv0025->lv015;?>" tabindex="24" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[36];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()" type="text" name="txtlv908" id="txtlv908"  style="width:80%"  tabindex="25"  value="<?php echo (float)$mosl_lv0025->lv008;?>" onKeyPress="return CheckKey(event,1)"></td>
                                                          <td><?php echo $vLangArr[37];?></td>
                                                          <td><select name="txtlv909" id="txtlv909"   tabindex="13"  style="width:80%" onKeyPress="return CheckKey(event,1)"/>
							  <?php echo $mosl_lv0025->LV_LinkField('lv009',$mosl_lv0025->lv009);?>
							  </select></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[39];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv911" type="text" id="txtlv911" value="<?php echo (float)$mosl_lv0025->lv011;?>" tabindex="26" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv911amount" type="text" id="txtlv911amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td><?php echo $vLangArr[38];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv910" type="text" id="txtlv910" value="<?php echo (float)$mosl_lv0025->lv010;?>" tabindex="14" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv910amount" type="text" id="txtlv910amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                        </tr>
                                                        <tr>
                                                        	<td colspan="2"><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="8" onKeyPress="return CheckKey(event,11)"/></td>
                                                        	<td ><?php echo $vLangArr[62];?></td><td><input  name="txtlvallamount" type="text" id="txtlvallamount" readonly="true" style="width:80%;background:#cccccc;border:1px #999999 solid"></td>
                                                        </tr>
													
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="26"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="67" onKeyUp="return loadkey(event,2)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td><div id="idProdcess"></div></td>
                                                    </tr>
                                                  </table>
				 
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c3.gif">
				<img name="table_r2_c3" src="<?php echo $vDir;?>images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td><img src="<?php echo $vDir;?>images/pictures/spacer.gif" width="1" height="1" border="0" alt=""></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="<?php echo $vDir;?>images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="<?php echo $vDir;?>images/pictures/table_r3_c2.gif">
				<img name="table_r3_c2" src="<?php echo $vDir;?>images/pictures/spacer.gif" 
					width="1" height="1" border="0" alt=""></td>
			<td>
				<img name="table_r3_c3" src="<?php echo $vDir;?>images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td><img src="<?php echo $vDir;?>images/pictures/spacer.gif" width="1" height="16" border="0" alt=""></td>
		</tr>
	</table></td>
											  </tr>
												<tr height="1"><td class="td" colspan="4">
												<div id="lvloaddata"></div></td>
												</tr>
												<tr>
													<td class="td" align="center" colspan="4">
<?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="67"/>
<?php
}
?>															
														<img type="image" class="btAdd" name="back" onClick="Back();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_back_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[5];?>" tabindex="67" onKeyUp="return loadkey(event,2)"/></td>
												</tr>
												<tr><td class="td" height="20px" colspan="4" align="center">&nbsp;</td>
											</table>
										</form>
										
									</td>
								</tr>
							</table>
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="25%"><td>&nbsp;</td></tr>
	</table>
	 <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[53];?>';
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<script language="javascript">
		changewarehourse_change(document.frmadd.txtlv802.value);
		function changewarehourse_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
			alert("Please! WarehourseID is not empty!");
			return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&warehouseid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('itemsgetid').innerHTML=domainid;
			}
		}
		function changeitemlot_change(value,whid)
		{
			$xmlhttp1=null;
			if(whid=="")
			{
				alert("Warehourse is not empty!");
				return false;
			}
			if(value=="") 
			{
				alert("ProductID is not empty!");
				return false;
			}
			
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxlot=ajaxcheck"+"&itemid="+value+"&whid="+whid;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedLot;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
		function stateChangedLot()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain=xmlhttp1.responseText.indexOf('[CHECKLOT]')+10;
				var enddomain=xmlhttp1.responseText.indexOf('[ENDCHECKLOT]');
				var domainid=xmlhttp1.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('txtlotid').innerHTML=domainid;
			}
		}
		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>