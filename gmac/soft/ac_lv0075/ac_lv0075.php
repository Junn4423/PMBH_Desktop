<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ac_lv0075.php");
require_once("$vDir../clsall/ac_lv0077.php");
require_once("$vDir../clsall/hr_lv0001.php");
////////init object////////////////////
	$moac_lv0075=new ac_lv0075($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'AC0075');
	$moac_lv0077=new ac_lv0077($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'AC0077');
if($plang=="") $plang="EN";
if(isset($_GET['ajax']))
{
	$mohr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0001');
	$mohr_lv0001->LV_LoadID($_GET['companyid']);
	echo '[CHECK]';
	echo InsertWithCheck('ac_lv0004', 'lv001', $mohr_lv0001->lv022,$mohr_lv0001->lv023);
	echo '[ENDCHECK]';
	exit;
}
	$vLangArr=GetLangFile("$vDir../","AC0026.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$moac_lv0075->lv001=$_POST['txtlv801'];//InsertWithCheck('ac_lv0004', 'lv001', 'PC-'.getmonth($vNow)."/".getyear($vNow)."-",3);
$isExists =0;//$moac_lv0075->LV_Exist($moac_lv0075->lv001);
$moac_lv0075->lv009=$_POST['txtlv809'];
$moac_lv0075->lv009=($moac_lv0075->lv009=="")?GetServerDate():$moac_lv0075->lv009;
if($moac_lv0075->lv010=="" || $moac_lv0075->lv010==NULL) $moac_lv0075->lv010="1111";
$moac_lv0075->lv003=$_POST['txtlv803'];
if($moac_lv0075->lv003=="" || $moac_lv0075->lv003==NULL) $moac_lv0075->lv003="SUP";
if($flagCtrl == 1){
$moac_lv0075->lv002='1';

$moac_lv0075->lv004=$_POST['txtlv804'];
$moac_lv0075->lv005=$_POST['txtlv805'];
$moac_lv0075->lv006=$_POST['txtlv806'];
$moac_lv0075->lv007=$_POST['txtlv807'];
$moac_lv0075->lv008=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$moac_lv0075->lv009=$_POST['txtlv809'];
if($moac_lv0075->lv009=="" || $moac_lv0075->lv009==NULL) $moac_lv0075->lv009=$moac_lv0075->FormatView($vNow,2);
$moac_lv0075->lv010=$_POST['txtlv810'];
$moac_lv0075->lv011=$_POST['txtlv811'];
$moac_lv0075->lv012=$_POST['txtlv812'];
$moac_lv0075->lv013=$_POST['txtlv813'];
$moac_lv0075->lv014=$_POST['txtlv814'];
if($moac_lv0075->lv014=="" || $moac_lv0075->lv014==NULL) $moac_lv0075->lv014=$moac_lv0075->FormatView($vNow,2);
$moac_lv0075->lv015=$_POST['txtlv815'];
$moac_lv0075->lv016='0';
$moac_lv0075->lv018=$_POST['txtlv818'];
$moac_lv0075->lv022=$_POST['txtlv822'];
	$vStrMessage = "";
	if((int)$isExists==0){
		if( $moac_lv0077->GetCountUser($_SESSION['ERPSOFV2RUserID'],$moac_lv0075->lv013)>0)
		{
		$bResultI = $moac_lv0075->LV_Insert();
		if($bResultI == true){
			$moac_lv0077->LV_InsertTemp($moac_lv0075->lv001,$_SESSION['ERPSOFV2RUserID'],$moac_lv0075->lv013);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage =$vLangArr[15].mysql_error();
			$flagCtrl = 0;
			}
		}
		else
		{
			$vStrMessage = $vLangArr[14];
		}
	} else if((int)$isExists>=1 && (int)$moac_lv0077->lv007==0){
			$moac_lv0075->LV_Update();
			$moac_lv0077->LV_InsertTemp($moac_lv0075->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2));	
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
	}
}
$moac_lv0077->lv005=$_POST['txtlv905'];
if($moac_lv0077->lv005=="" || $moac_lv0077->lv005==NULL) $moac_lv0077->lv005="331";
$moac_lv0077->lv006=$_POST['txtlv906'];
if($moac_lv0077->lv006=="" || $moac_lv0077->lv006==NULL) $moac_lv0077->lv006="1111";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$moac_lv0075->Load($moac_lv0075->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
$vLangArr1=GetLangFile("../","AC0016.txt",$plang);
$moac_lv0075->lang=strtoupper($plang);
//////////////////////////////////////////////////////////////////////////////////////////////////////
$moac_lv0075->ArrPush[0]=$vLangArr1[17];
$moac_lv0075->ArrPush[1]=$vLangArr1[18];
$moac_lv0075->ArrPush[2]=$vLangArr1[19];
$moac_lv0075->ArrPush[3]=$vLangArr1[20];
$moac_lv0075->ArrPush[4]=$vLangArr1[21];
$moac_lv0075->ArrPush[5]=$vLangArr1[22];
$moac_lv0075->ArrPush[6]=$vLangArr1[23];
$moac_lv0075->ArrPush[7]=$vLangArr1[24];
$moac_lv0075->ArrPush[8]=$vLangArr1[25];
$moac_lv0075->ArrPush[9]=$vLangArr1[26];
$moac_lv0075->ArrPush[10]=$vLangArr1[27];
$moac_lv0075->ArrPush[11]=$vLangArr1[28];
$moac_lv0075->ArrPush[12]=$vLangArr1[29];
$moac_lv0075->ArrPush[13]=$vLangArr1[30];
$moac_lv0075->ArrPush[14]=$vLangArr1[31];
$moac_lv0075->ArrPush[15]=$vLangArr1[32];
$moac_lv0075->ArrPush[16]=$vLangArr1[33];
$moac_lv0075->ArrPush[17]=$vLangArr1[34];
$moac_lv0075->ArrPush[18]=$vLangArr1[43];
$moac_lv0075->ArrPush[19]=$vLangArr1[42];
$vFieldList="lv001,lv004,lv005,lv017";
$strParent=$moac_lv0075->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
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
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv801.value=="")
		{
			alert("<?php echo $vLangArr[49];?>");
			o.txtlv801.select();
		}
		else if(o.txtlv804.value=="")
		{
			alert("<?php echo $vLangArr[47];?>");
			o.txtlv804.select();
		}
		else if(o.txtlv805.value=="")
		{
			alert("<?php echo $vLangArr[48];?>");
			o.txtlv805.select();
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
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>ac_lv0077/ac_lv0077.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	}
	function Add()
	{
		CalculateM();
	var o=document.frmadd;
	var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv813.value+"&txtOpt=1";
	var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>ac_lv0077/ac_lv0077.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
	div = document.getElementById('lvloaddata');
	div.innerHTML=str;
	o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv803.value;
		switch(vo)
		{
			case 'EMP':
				LoadPopupParent(to,'txtlv804','*@*@*.hr_lv0020','concat(lv004,lv003,lv002)');
				break;
			case 'CUS':
				LoadPopupParent(to,'txtlv804','sl_lv0001','lv002');
				break;
			case 'SUP':
				LoadPopupParent(to,'txtlv804','wh_lv0003','lv002');
				break;
		}
	}
	function LoadCurency()
	{
	var o=document.frmadd;
		ajax_do ('ac_lv0049/ac_lv0049exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv811.value,1);
		window.setTimeout('CalculateM()',1000);
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv904.value=parseFloat(o.txtlv903.value*o.txtlv812.value);
	}
	function LoadSource()
	{
		var o=document.frmadd;
		var vo=o.txtlv803.value;
				ajax_do ('ac_lv0075/ac_lv0075excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&POID='+o.txtlv813.value+'&Type='+o.txtlv803.value+'&SupID='+o.txtlv804.value+'&lv005='+o.txtlv905.value+'&lv006='+o.txtlv906.value+'&lv011='+o.txtlv811.value+'&lv012='+o.txtlv812.value,1);
				window.setTimeout('RunFunction()',500);

		
	}
	-->
	</script>
<style>
table .tdpar
{
	border-bottom:1px #ececec solid;
	padding:5px;
}
table .tdpar input
{
	height:22px!important;
	width:100%;
}
table .tdpar select
{
	height:28px!important;
	width:100%;
}
table .tdpar textarea
{
	height:22px!important;
	width:100%;
}
</style>	
	</head>

<?php
if($moac_lv0075->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr height="25%"><td>&nbsp;</td></tr>
		<tr height="*">
			<td>&nbsp;</td>
			<td width="100%" align="center">
				<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
					<tr>
						<td>&nbsp;</td>
						<td class="tdpar"width="100%" align="center">
							<table border="0" cellpadding="1" cellspacing="1" width="100%" align="center" class="tbl">	
								<tr>
									<td class="tdpar"align="center">
										<form  name="frmadd" id="frmadd"  method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											
											<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
												<?php if($vStrMessage!=""){ ?>
												<tr>
												  <td class="tdpar"height="20px" colspan="4" align="center"><font color="#3366CC"><?php echo $vStrMessage;?></font></td>
												</tr>
												<?php }?>
												<tr>
												  <td width="15%"><?php echo $vLangArr[27];?></td>
												  <td  class="tdpar" width="25%"><input name="txtlv809" type="text" id="txtlv809" value="<?php echo $moac_lv0075->FormatView($moac_lv0075->lv009,2);?>" tabindex="4" maxlength="100" style="" onKeyPress="return CheckKey(event,7)" />
												  </td>
												  <td  class="tdpar" width="15%">
                                                    <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv809);return false;" /></td>
													<td  class="tdpar" width="15%" height="20px" align="left"><?php echo $vLangArr[19];?></td>	
												  <td colspan="2" class="tdpar" width="32%"><input readonly="true" name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('ac_lv0004', 'lv001', 'PC-'.getmonth($vNow)."/".getyear($vNow)."-",3);?>" tabindex="3" maxlength="32" style="" onKeyPress="return CheckKey(event,7)"/></td>
													
												</tr>	
												<tr>
													<td class="tdpar"height="20px" align="left"><?php echo $vLangArr[21];?></td>
													<td height="20px" class="tdpar"><label>
													  <select name="txtlv803" id="txtlv803"   tabindex="4"  style="" onkeypress="return CheckKey(event,7)"/>
												
                                                      <?php echo $moac_lv0075->LV_LinkField('lv003',$moac_lv0075->lv003);?>
                                                      </select>
													  </td>
													  <td  class="tdpar">
                                                      <input style="padding:3px;height:30px!important;width:80px;" type="button" name="Load2" value="۩▲Lấy DL" tabindex="5" onClick="LoadSource()" >
                                                    
													</label></td>
													
													<td class="tdpar" height="20px" align="left" valign="top"><?php echo $vLangArr[50];?></td>
												  <td class="tdpar"><input  tabindex="6" name="txtlv818" type="text" id="txtlv818"  value="<?php echo $moac_lv0075->lv018;?>" maxlength="225" style="" onKeyPress="return CheckKey(event,7)"/></td>	
													
												</tr>
												<tr>
												<td class="tdpar"height="20px" align="left" valign="top"><?php echo $vLangArr[22];?></td>
												<td class="tdpar"><input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $moac_lv0075->lv004;?>" tabindex="4" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/> </td>
													
													<td class="tdpar"><ul id="pop-nav" lang="pop-nav1" onkeyup="ChangeName(this,1)" onMouseOver="ChangeName(this,1)" xml:lang="pop-nav1">
														  <li class="menupopT">
															<input type="text" autocomplete="off" class="search_img_btn" name="txtlv804_search" id="txtlv804_search" style="width:100%" onKeyUp="LoadType(this)" onFocus="LoadType(this)" tabindex="200">
															<div id="lv_popup" lang="lv_popup1" xml:lang="lv_popup1"> </div>
														  </li>
													  </ul>
													</td>
												 
												  <td class="tdpar" height="20px" align="left" valign="top"><?php echo $vLangArr[33];?></td>
												    <td class="tdpar" ><input  tabindex="6" name="txtlv815" type="text" id="txtlv815"  value="<?php echo $moac_lv0075->lv015;?>" maxlength="225" style="" onKeyPress="return CheckKey(event,7)"/></td>
												</tr>
												<tr>
													<td class="tdpar"height="20px" align="left"><?php echo $vLangArr[23];?></td>
												  <td height="20px" colspan="4" class="tdpar"><input name="txtlv805" type="text" id="txtlv805"  value="<?php echo $moac_lv0075->lv005;?>" tabindex="6" maxlength="225" style="" onKeyPress="return CheckKey(event,7)"/></td>		
												  
											    </tr>												
												<tr height="1">
												  <td class="tdpar"><?php echo $vLangArr[24];?></td>
												  <td colspan="4" class="tdpar"><input name="txtlv806" type="text" id="txtlv806"  value="<?php echo $moac_lv0075->lv006;?>" tabindex="6" maxlength="225" style="" onKeyPress="return CheckKey(event,7)"/></td>
												 
											  </tr>
												<tr height="1">
													<td class="tdpar"><?php echo $vLangArr[25];?></td>
												    <td colspan="5" class="tdpar"><textarea name="txtlv807" rows="3" id="txtlv807" style="" tabindex="6" ><?php echo $moac_lv0075->lv007;?></textarea></td>
												</tr>	
												
												<tr height="1">
												  <td class="tdpar" colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>

                                                      <td  class="tdpar" width="15%"><?php echo $vLangArr[29];?></td>
                                                      <td class="tdpar"  width="10%"><?php echo $vLangArr[30];?></td>
                                                      <td  class="tdpar" width="30%"><?php echo $vLangArr[28];?></td>
                                                      <td  class="tdpar" width="30"><?php echo $vLangArr[31];?></td>
                                                      <td  class="tdpar" width="15%"><?php echo $vLangArr[32];?></td>
                                                    </tr>
                                                    <tr>
                                                      <td><select name="txtlv811" id="txtlv811"   tabindex="8"  style="" onkeypress="return CheckKey(event,7)" onChange="LoadCurency()"/>
														<?php echo $moac_lv0075->LV_LinkField('lv011',$moac_lv0075->lv011);?>
														</select>                                                      </td>
                                                      <td><input name="txtlv812" id="txtlv812"   tabindex="9"  style="" onKeyPress="return CheckKey(event,7)" value="<?php echo ((float)$moac_lv0075->lv012==0)?"1":(float)$moac_lv0075->lv012;?>"/>                                                      </td>
                                                      <td><table border="0" width="100%">
                                                        <tr>
                                                          <td width="50%">
                                                          	<select name="txtlv810" id="txtlv810"   tabindex="10"  style="width:100%" onkeypress="return CheckKeys(event,7,this)"/>
                                                      			<?php echo $moac_lv0075->LV_LinkField('lv010',$moac_lv0075->lv010);?>
                                                      		</select>
                                                      	  </td>
                                                          <td><ul id="pop-nav2" lang="pop-nav2" onkeyup="ChangeName(this,2)" onMouseOver="ChangeName(this,2)" >
                                                              <li class="menupopT">
                                                                <input type="text" autocomplete="off" class="search_img_btn" name="txtlv810_search" id="txtlv810_search" style="width:100%px" onKeyUp="LoadPopupParent(this,'txtlv810','ac_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv810','ac_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200">
                                                                <div id="lv_popup2" lang="lv_popup2" > </div>
                                                              </li>
                                                          </ul></td>
                                                        </tr>
                                                      </table></td>
                                                      <td>
                                                     		<table width="100%" border="0">
                                                     					<tr>
                                                     						<td width="50%">
                                                     							<input name="txtlv813" type="text" id="txtlv813"  value="<?php echo $moac_lv0075->lv013;?>" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
                                                     						</td>
                                                     						<td width="5%">
                                                     							<input type="button" name="Load2" value="۩▲" onClick="LoadSource()" >
                                                     						</td>
                                                     						<td>
																	    	<ul id="pop-nav3" lang="pop-nav3" onkeyup="ChangeName(this,3)" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
																	      		<input type="text" autocomplete="off" class="search_img_btn" name="txtlv813_search" id="txtlv813_search" style="width:150px" onKeyUp="LoadPopupParent(this,'txtlv813','ac_lv0004','concat(lv001,@! @!,lv005,@! @!,lv015,@! @!,lv009,@! @!,lv013)')" onFocus="LoadPopupParent(this,'txtlv813','ac_lv0004','concat(lv001,@! @!,lv005,@! @!,lv015,@! @!,lv009,@! @!,lv013)')" tabindex="200" >
																	      		<div id="lv_popup3" lang="lv_popup3"> </div>						  
																  				</li>
																			</ul>
																			</td>
																		</tr>
															</table>
                                                      </td>
                                                      <td><table width="100%" border="0">
                                                     					<tr>
                                                     						<td width="80%"><input name="txtlv814" type="text" id="txtlv814" value="<?php echo $moac_lv0075->FormatView($moac_lv0075->lv014,2);?>" tabindex="110" maxlength="100" style="width:100%" onKeyPress="return CheckKey(event,7)" />
                                                     						</td>
                                                     						<td>
							                                                    <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1" 
																						border="0" style="cursor:pointer" width="16" height="16" align="top" 
																						onclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv814);return false;" />
																			</td>
																		</tr>
																	</table>
														</td>
                                                    </tr>                                                   
                                                  </table></td>
												</tr>
												<tr height="1">
												  <td class="tdpar" colspan="7"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="13">
				<img name="table_r1_c1" src="<?php echo $vDir;?>images/pictures/table_r1_c1.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="*" background="<?php echo $vDir;?>images/pictures/table_r1_c2.gif">
				</td>
			<td width="13">
				<img name="table_r1_c3" src="<?php echo $vDir;?>images/pictures/table_r1_c3.gif" 
					width="13" height="12" border="0" alt=""></td>
			<td width="11">
				</td>
		</tr>
		<tr>
			<td background="<?php echo $vDir;?>images/pictures/table_r2_c1.gif">
				</td>
			<td><table width="100%" border="0">
                                                    <tr>
                                                      <td width="100%" align="left" style="text-transform:uppercase" class="detail_title"><h3><?php echo $vLangArr[16];?></h3></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td class="tdpar" width="13%"><?php echo $vLangArr[35];?></td>
                                                          <td class="tdpar" width="20%"><input type="text" name="txtlv903" id="txtlv903"  style=""  tabindex="25"  value="<?php echo (float)$moac_lv0077->lv003;?>" onKeyPress="return CheckKey(event,1)" onKeyUp="CalculateM()"  onChange="CalculateM()"></td>
														  <td class="tdpar" width="17%"><?php echo $vLangArr[37];?></td>
                                                          <td class="tdpar" width="20%">
															<select name="txtlv905" id="txtlv905"   tabindex="27"  style="width:100%" onkeypress="return CheckKeys(event,1,this)"/>
                                                         						 <?php echo $moac_lv0077->LV_LinkField('lv005',$moac_lv0077->lv005);?>
                                                            					</select>
														</td>
							  							<td  class="tdpar" width="20%">
																	    <ul id="pop-nav5" lang="pop-nav5" onkeyup="ChangeName(this,5)" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
																	      <input type="text" autocomplete="off" class="search_img_btn" name="txtlv905_search" id="txtlv905_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv905','ac_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv905','ac_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200" >
																	      <div id="lv_popup5" lang="lv_popup5"> </div>						  
																  			</li>
															  			</ul>
														</td>
                                                         
                                                        </tr>
                                                        <tr>
															<td class="tdpar" ><?php echo $vLangArr[36];?></td>
															<td class="tdpar" ><input  name="txtlv904" type="text" id="txtlv904" value="<?php echo (float)$moac_lv0077->lv004;?>" tabindex="26" maxlength="255" style="" onKeyPress="return CheckKey(event,1)"  readonly="TRUE"/></td> 
															<td class="tdpar" valign="top"><?php echo $vLangArr[38];?></td>
															<td class="tdpar" ><select name="txtlv906" id="txtlv906"   tabindex="28"  style="width:100%" onKeyPress="return CheckKeys(event,1,this)"/>
															<?php echo $moac_lv0077->LV_LinkField('lv006',$moac_lv0077->lv006);?>
															</select>
														</td>
														<td  class="tdpar">
														  <ul id="pop-nav6" lang="pop-nav6" onkeyup="ChangeName(this,6)" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
															<input type="text" autocomplete="off" class="search_img_btn" name="txtlv906_search" id="txtlv906_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv906','ac_lv0002','concat(lv001,@! @!,lv002)')" onFocus="LoadPopupParent(this,'txtlv906','ac_lv0002','concat(lv001,@! @!,lv002)')" tabindex="200" >
															<div id="lv_popup6" lang="lv_popup6"> </div>						  
															</li>
															</ul>
														</td>
                                                        </tr>
                                                        <tr>
                                                          <td class="tdpar"><?php echo $vLangArr[39];?></td>
                                                          <td  class="tdpar"colspan="4"><input name="txtlv907" type="text" id="txtlv907"  value="<?php echo $moac_lv0077->lv007;?>"  tabindex="29" maxlength="225" style="" onKeyPress="return CheckKey(event,7)"/></td>
                                                        </tr>
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td><img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="29" onKeyPress="return CheckKey(event,11)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><?php
$isRun=1;
if($isRun==1)
{
?>														
														<img type="image" class="btAdd" name="save" id='save' onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="66"/>
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
				</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<img name="table_r3_c1" src="<?php echo $vDir;?>images/pictures/table_r3_c1.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td background="<?php echo $vDir;?>images/pictures/table_r3_c2.gif">
				</td>
			<td>
				<img name="table_r3_c3" src="<?php echo $vDir;?>images/pictures/table_r3_c3.gif" 
					width="13" height="16" border="0" alt=""></td>
			<td></td>
		</tr>
	</table></td>
											  </tr>
												<tr height="1"><td class="tdpar" colspan="7">
												<div id="lvloaddata"></div></td>
												</tr>
												<tr>
													<td class="tdpar"align="center" colspan="7">
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
												<tr><td class="tdpar"height="20px" colspan="4" align="center">&nbsp;</td>
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
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
document.frmadd.txtlv903.focus();
window.setTimeout('RunFunction()',100);
	function changecompany_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
				return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&companyid="+value;
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
				document.getElementById('txtlv801').value=domainid;
				
				document.getElementById('txtlv801').focus();
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
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[17];?>';
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>