<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0059.php");
require_once("$vDir../clsall/sl_lv0060.php");
////////init object////////////////////
	$mosl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0059');
	$mosl_lv0060=new sl_lv0060($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0060');
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0070.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0072.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$mosl_lv0059->lv001=$_POST['txtlv801'];
$isExists = 0;//$mosl_lv0059->LV_Exist($mosl_lv0059->lv001);
$mosl_lv0059->lv003=($mosl_lv0059->lv003=="")?$vNow.' 00:00:00':$mosl_lv0059->lv003;
$mosl_lv0059->lv004=($mosl_lv0059->lv004=="")?LV_DATE_ADD($vNow,30).' 23:59:59':$mosl_lv0059->lv004;
if($flagCtrl == 1){
$mosl_lv0059->lv002=$_POST['txtlv802'];
$mosl_lv0059->lv005=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$mosl_lv0059->lv006=$vNow;	
$mosl_lv0059->lv009=$_POST['txtlv809'];
$mosl_lv0059->lv099=$_POST['txtlv899'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mosl_lv0059->LV_InsertTemp();
		if($bResultI == true){
			$mosl_lv0060->LV_InsertTemp($mosl_lv0059->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));
			$vStrMessage = $vLangArr[37];
			$flagCtrl = 1;
			$mosl_lv0059->lv001="";
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mosl_lv0060->lv007==0){
			$mosl_lv0059->LV_Update();
			$mosl_lv0060->LV_InsertTemp($mosl_lv0059->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));	
			$vStrMessage = $vLangArr[38];
			$flagCtrl = 1;
	}
}
$mosl_lv0059->ArrPush[0]=$vLangArr[17];
$mosl_lv0059->ArrPush[1]=$vLangArr[18];
$mosl_lv0059->ArrPush[2]=$vLangArr[20];
$mosl_lv0059->ArrPush[3]=$vLangArr[21];
$mosl_lv0059->ArrPush[4]=$vLangArr[22];
$mosl_lv0059->ArrPush[5]=$vLangArr[23];
$mosl_lv0059->ArrPush[6]=$vLangArr[24];
$mosl_lv0059->ArrPush[7]=$vLangArr[25];
$mosl_lv0059->ArrPush[8]=$vLangArr[26];
$mosl_lv0059->ArrPush[9]=$vLangArr[27];
$mosl_lv0059->ArrPush[10]=$vLangArr[28];
$vFieldList="lv001,lv002,lv003,lv005";
$strParent=$mosl_lv0059->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mosl_lv0059->Load($mosl_lv0059->ID);
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
			alert("<?php echo $vLangArr[36];?>");
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
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=<?php echo $vDir;?>sl_lv0063/sl_lv0063.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?> class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	document.frmadd.txtlv903.focus();
	}
	function Add()
	{
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>sl_lv0063/sl_lv0063.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
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
				LoadPopupParent(to,'txtlv806','sl_lv0034','lv002');
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
		//ajax_do ('sl_lv0026/sl_lv0026exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value+'&lv003='+o.txtlv802.value,1);
	}
	function Report(vValue)
	{
	var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0059?func=<?php echo $_GET['func'];?>&func=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	-->
	</script>
</head>
<?php
if($mosl_lv0059->GetAdd()>0)
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
													<td class="td" width="18%" height="20px" align="left"><?php echo $vLangArr[20];?></td>	
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('*@*@*.sl_lv0001', 'lv001', 'PRO',1);?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[22];?></td>
												  <td class="td" width="33%">
												 <input name="txtlv803" type="text" id="txtlv803"  value="<?php echo $mosl_lv0059->FormatView($mosl_lv0059->lv003,4);?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/> 
												 <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv803);return false;" />
                                                   </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[21];?></td>
													<td height="20px" class="td"><input name="txtlv802" type="text" id="txtlv802"  value="<?php echo $mosl_lv0059->lv002;?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>		
													<td><?php echo $vLangArr[23];?></td>
													<td><input name="txtlv804" type="text" id="txtlv804" value="<?php echo $mosl_lv0059->FormatView($mosl_lv0059->lv004,4);?>" tabindex="111" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
														 <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv804);return false;" />
                                                    </td>
												</tr>
												<tr height="1">
													<td class="td"><?php echo $vLangArr[28];?></td>
												    <td class="td"><input type="textbox" name="txtlv809" id="txtlv809" style="width:80%" tabindex="9" value="<?php echo (float)$mosl_lv0059->lv009;?>"/></td>
													<td class="td">DS KH(VD:METRO1,METHO2...)</td>
													<td class="td">
													<table width="80%">
													<tr>
														<td>
															<ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" xml:lang="pop-nav2">
																<li class="menupopT">
													<input   type="textbox" name="txtlv899" id="txtlv899" style="width:100%" tabindex="9" value="<?php echo $mosl_lv0059->lv099;?>"   onkeyup="LoadSelfNextParent(this,'txtlv899','sl_lv0034','lv001','concat(lv002,@! - @!,lv001)')"/>
													 <div id="lv_popup2" lang="lv_popup2" xml:lang="lv_popup2"> </div>
													</li>
												</ul>
											</td>
										</tr>
									</table>
													</td>
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
                                                      <td width="100%" align="center" class="detail_title"><?php echo $vLangArr1[16];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="13%"><?php echo $vLangArr1[21];?></td>
                                                          <td width="34%">
                                                          <table border=0 cellpadding="0" cellspacing="0" width="100%"><tr><td width="80%"><div id="itemsgetid"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" onblur="LoadItem()"/>
                                                            <?php echo $mosl_lv0060->LV_LinkField('lv003',$mosl_lv0060->lv003);?>
															</select></div></td><td width="20%">
                                                            </td></tr></table>
                                                            <td>
                                                          <table style="width:80%">
                                                              <tr>
                                                                <td><ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav1">
                                                                    <li class="menupopT">
                                                                      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv903','*@*@*.sl_lv0007','concat(lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','*@*@*.sl_lv0007','concat(lv002,@!-@!,lv001)')" tabindex="200">
                                                                      <div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
                                                                    </li>
                                                                </ul></td>
                                                              </tr>
                                                            </table></td>
                                                          <td align="right" style="postion:relative"><div style="postion:relative;width:50%px;"><img id="txtimg_load_sp" name="txtimg_load_sp" style="right:50px;position:absolute;" src="http://thegioithietbilanh.vn/wp-content/plugins/load_products_content_trangchu/images/loading.gif" border="0" height="50"/></div></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr1[22];?></td>
                                                          <td><input name="txtlv904" id="txtlv904"   tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$mosl_lv0060->lv004;?>"/></td>
                                                          <td><?php echo $vLangArr1[25];?></td>
                                                          <td><input name="txtlv907" id="txtlv907"   tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo $mosl_lv0060->lv007;?>"/></td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr1[23];?></td>
                                                          <td><input name="txtlv905" type="text" id="txtlv905" value="<?php echo (float)$mosl_lv0060->lv005;?>" tabindex="22" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr1[24];?></td>
                                                          <td><input name="txtlv906" type="text" id="txtlv906" value="<?php echo (float)$mosl_lv0060->lv006;?>" tabindex="22" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                        </tr>
                                                      </table></td>
                                                    </tr>
													 <tr>
                                                        	<td colspan="2"><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="23" onKeyPress="return CheckKey(event,11)"/></td>
                                                        	<td >&nbsp;</td><td>&nbsp;</td>
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
div.innerHTML='<?php echo $vLangArr[16];?>';
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<script language="javascript">
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