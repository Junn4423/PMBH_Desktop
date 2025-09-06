<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0070.php");	
////////init object////////////////////
	$mosl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0081.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Láº¥y mÃ£ phiáº¿u nháº­p kho
$mosl_lv0070->lv001=$_SESSION['ERPSOFV2RUserID'];
$isExists =$mosl_lv0070->LV_Exist($mosl_lv0070->lv001);
$mosl_lv0070->lv002=$_POST['txtlv802'];
$mosl_lv0070->lv002=GetServerDate()." ".GetServerTime();
if($flagCtrl == 1){
$mosl_lv0070->lv003=$_POST['txtlv803'];
$mosl_lv0070->lv004=$_POST['txtlv804'];
$mosl_lv0070->lv006=$_POST['txtlv806'];
$mosl_lv0070->lv005=$_POST['txtlv805'];
$mosl_lv0070->lv007=0;	
$mosl_lv0070->lv008=$_POST['txtlv808'];
$mosl_lv0070->lv009=$_POST['txtlv809'];
$mosl_lv0070->lv010=$_POST['txtlv810'];
$mosl_lv0070->lv011=$_POST['txtlv811'];
$mosl_lv0070->lv012=$_POST['txtlv812'];	
$mosl_lv0070->lv013=$_POST['txtlv813'];
$mosl_lv0070->lv014=$_POST['txtlv814'];
$mosl_lv0070->lv015=$_POST['txtlv815'];
$mosl_lv0070->lv016=$_POST['txtlv816'];
$mosl_lv0070->lv017=$_POST['txtlv817'];
$mosl_lv0070->lv018=$_POST['txtlv818'];
$mosl_lv0070->lv019=$_POST['txtlv819'];
$mosl_lv0070->lv020=$_POST['txtlv820'];
$mosl_lv0070->lv021=$_POST['txtlv821'];
$mosl_lv0070->lv022=$_POST['txtlv822'];
$mosl_lv0070->lv023=$_POST['txtlv823'];
$mosl_lv0070->lv024=$_POST['txtlv824'];
$mosl_lv0070->lv025=$_POST['txtlv825'];
$mosl_lv0070->lv026=$_POST['txtlv826'];
$mosl_lv0070->lv027=$_POST['txtlv827'];
$mosl_lv0070->lv028=$_POST['txtlv828'];
$mosl_lv0070->lv029=$_POST['txtlv829'];
$mosl_lv0070->lv030=$_POST['txtlv830'];
$mosl_lv0070->lv031=$_POST['txtlv831'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $mosl_lv0070->LV_Insert();
		if($bResultI == true){
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$mowh_lv0009->lv007==0){
			$mosl_lv0070->LV_Update();
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
$mosl_lv0070->LV_Load();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((int)$isExists>=1){
//	$mosl_lv0070->Load($mosl_lv0070->ID);
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
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function Save()
	{
		var o=document.frmadd;
		o.txtlv821.value=getChecked(o.chklv021.value,'chklv021');
		o.txtlv822.value=getChecked(o.chklv022.value,'chklv022');
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
	
	function Add()
{

RunFunction('','add');
}
function Edt()
{
	lv_chk_list(document.frmchoose,'lvChk',2);
}
function Edit(vValue)
{

	RunFunction(vValue,'edit');
}
function Fil()
{
	RunFunction('&lv001=<?php echo $_POST['txtlv001'];?>&lv002=<?php echo $_POST['txtlv002'];?>&lv003=<?php echo $_POST['txtlv003'];?>&lv004=<?php echo $_POST['txtlv004'];?>&lv005=<?php echo $_POST['txtlv005'];?>&lv006=<?php echo $_POST['txtlv006'];?>&lv007=<?php echo $_POST['txtlv007'];?>&lv008=<?php echo $_POST['txtlv008'];?>&lv009=<?php echo $_POST['txtlv009'];?>&lv010=<?php echo $_POST['txtlv010'];?>&lv011=<?php echo $_POST['txtlv011'];?>','filter');
}
function Del()
{
	lv_chk_list(document.frmchoose,'lvChk',3);
}
function Delete(vValue)
{
 	var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.target="_self";
	o.txtFlag.value=2;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();

}
function Apr()
{
	lv_chk_list(document.frmchoose,'lvChk',9);
}
function Approvals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.txtFlag.value=3;
	o.target="_self";
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function UnApr()
{
	lv_chk_list(document.frmchoose,'lvChk',10);
}
function UnApprovals(vValue)
{
var o=document.frmchoose;
 	o.txtStringID.value=vValue;
	o.target="_self";
	o.txtFlag.value=4;
	 o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,1,0);?>"
	 o.submit();
}
function RunFunction(vID,func)
{
	var str="<br><iframe id='lvframefrm' height=2000 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0070?func=<?php echo $_GET['func'];?>&childfunc="+func+"&ID=<?php echo $_GET['ID'];?>&ChildID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;
	scrollToBottom();
}
	-->
	</script>
</head>
<?php
if($mosl_lv0070->GetAdd()>0)
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
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo $mosl_lv0070->lv001;?>" tabindex="3" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"  readonly="true"/></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
												  <td class="td" width="33%"><input name="txtlv802" type="text" id="txtlv802" value="<?php echo $mosl_lv0070->FormatView($mosl_lv0070->lv002,22);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true" />                           </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[21];?></td>
												  <td height="20px" class="td"><input name="txtlv803" type="text" id="txtlv803"  value="<?php echo $mosl_lv0070->lv003;?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
												  <td><?php echo $vLangArr[22];?></td>									 
												   <td height="20px" class="td"><input name="txtlv804" type="text" id="txtlv804"  value="<?php echo $mosl_lv0070->lv004;?>" tabindex="4" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[23];?></td>
													<td height="20px" class="td" valign="top"><input type="text" name="txtlv805" id="txtlv805"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv005;?>" /></td>
												    <td height="20px" class="td" ><?php echo $vLangArr[24];?></td>
												    <td height="20px" class="td"> 
													<input type="text" name="txtlv806" id="txtlv806"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv006;?>" />
                                                     </td>
                                                     
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[26];?></td>
												  <td height="20px" class="td">
												  <select name="txtlv808" type="text" id="txtlv808" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
														<option value="1" <?php echo ($mosl_lv0070->lv008=="1")?'selected="selected"':'';?>>Yes</option>
														<option value="0" <?php echo ($mosl_lv0070->lv008=="0")?'selected="selected"':'';?>>No</option>
                                                     </select>
												  </td>
												  <td><?php echo $vLangArr[27];?></td>									 
												   <td height="20px" class="td">
														<input name="txtlv809" type="text" id="txtlv809" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv009;?>"/>
                                                    </td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[28];?></td>
												  <td height="20px" class="td">
												  <select name="txtlv810" type="text" id="txtlv810" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
													<option value="1" <?php echo ($mosl_lv0070->lv010=="1")?'selected="selected"':'';?>>Yes</option>
													<option value="0" <?php echo ($mosl_lv0070->lv010=="0")?'selected="selected"':'';?>>No</option>
                                                     </select>
												  </td>
												  <td><?php echo $vLangArr[29];?></td>									 
												   <td height="20px" class="td">
												   <input  name="txtlv811" type="text" id="txtlv811" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv011;?>"/>
                                                     </td>
												</tr>
													<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[30];?></td>
												  <td height="20px" class="td">
												  <select name="txtlv812" type="text" id="txtlv812" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
													<option value="1" <?php echo ($mosl_lv0070->lv012=="1")?'selected="selected"':'';?>>Yes</option>
													<option value="0" <?php echo ($mosl_lv0070->lv012=="0")?'selected="selected"':'';?>>No</option>
                                                  </select>
												  </td>
												  <td><?php echo $vLangArr[31];?></td>									 
												   <td height="20px" class="td">
												   <input name="txtlv813" type="text" id="txtlv813" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv013;?>"/>
                                                    </td>
												</tr>
												<!--
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[28];?></td>
												  <td height="20px" class="td"><input name="txtlv810" type="text" id="txtlv810"  value="<?php echo $mosl_lv0070->lv010;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
												  <td><?php echo $vLangArr[29];?></td>									 
												   <td height="20px" class="td"><input name="txtlv811" type="text" id="txtlv811"  value="<?php echo $mosl_lv0070->lv011;?>" tabindex="7" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[30];?></td>
												  <td height="20px" class="td"><input name="txtlv812" type="text" id="txtlv812"  value="<?php echo $mosl_lv0070->lv012;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
												  <td><?php echo $vLangArr[31];?></td>									 
												   <td height="20px" class="td"><input name="txtlv813" type="text" id="txtlv813"  value="<?php echo $mosl_lv0070->lv013;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
												</tr>
												<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[32];?></td>
												  <td height="20px" class="td"><table width="80%"><tr><td>
									<select name="txtlv814" id="txtlv814"   tabindex="6"  style="width:100%" onkeypress="return CheckKey(event,7)">
										<?php echo $mosl_lv0070->LV_LinkField('lv014',$mosl_lv0070->lv014);?>
									</select>
							    </td><td>							  
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv814','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopup(this,'txtlv814','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
												  <td>&nbsp;</td>									 
												   <td height="20px" class="td">&nbsp;</td>
												</tr>-->
												<tr>
								<td width="166"  height="20"><?php echo 'Ngày tính điểm từ';?></td>
								<td width="178"  height="20">
									<input name="txtlv815" type="text" id="txtlv815"  value="<?php echo $mosl_lv0070->FormatView($mosl_lv0070->lv015,2);?>" tabindex="17" maxlength="500" style="width:80%" onKeyPress="return CheckKey(event,7)"/>	
									 <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv815);return false;" /></span></td>
					    
							  <td  height="20"><?php echo 'Ngày tính điểm đến';?></td>
							  <td  height="20"><input  name="txtlv816" type="text" id="txtlv816" value="<?php echo $mosl_lv0070->FormatView($mosl_lv0070->lv016,2);?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <span class="td"><img src="../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv816);return false;" /></span></td>
						    </tr>
							<tr>
								<td class="td" height="20px" align="left"><?php echo 'Đồng giá';?></td>
								<td height="20px" class="td"> <select name="txtlv817" type="text" id="txtlv817" tabindex="20" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
													<option value="2" <?php echo ($mosl_lv0070->lv017=="2")?'selected="selected"':'';?>>2.Đồng giá tất cả</option>
													<option value="1" <?php echo ($mosl_lv0070->lv017=="1")?'selected="selected"':'';?>>1.Chỉ đồng giá 1 phần</option>
													<option value="0" <?php echo ($mosl_lv0070->lv017=="0")?'selected="selected"':'';?>>0.Không</option>
                                                  </select></td>
								<td><?php echo 'Giá tiền';?></td>									 
								<td height="20px" class="td"><input name="txtlv818" type="text" id="txtlv818"  value="<?php echo $mosl_lv0070->lv018;?>" tabindex="20" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
							<tr>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Số phút nhóm món cho bếp';?></td>
									<td height="20px" class="td" valign="top"><input type="text" name="txtlv819" id="txtlv819"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv019;?>" /></td>
									<td height="20px" class="td" ><?php echo 'Số phút cảnh báo quá giờ';?></td>
									<td height="20px" class="td"> 
									<input type="text" name="txtlv820" id="txtlv820"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv020;?>" />
									 </td>
									 
								</tr>
							<tr>
								<td  height="20px">
								<?php echo 'Cho quầy ăn';?>
								</td>
							  <td  height="20px">
												<input type="hidden" name="txtlv821" id="txtlv821"   tabindex="7"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $mosl_lv0070->lv021;?>"/>
												<div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;">
												<?php echo $mosl_lv0070->GetBuilCheckList($mosl_lv0070->lv021,'chklv021',10,'sl_lv0006','lv002');?>
												</div>
							 </td>
							 <td  height="20px">
								<?php echo 'Cho quầy nước';?>
								</td>
							  <td  height="20px">
												<input type="hidden" name="txtlv822" id="txtlv822"   tabindex="7"  style="width:80%" onKeyPress="return CheckKeys(event,7,this)" value="<?php echo $mosl_lv0070->lv022;?>"/>
												<div style="width:100%;height:150px;position:relative;overflow: auto;top:0px;">
												<?php echo $mosl_lv0070->GetBuilCheckList($mosl_lv0070->lv022,'chklv022',10,'sl_lv0006','lv002');?>
												</div>
							 </td>
							 <tr>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Cho phép ưu tiên hiện tìm sản phầm';?></td>
									<td height="20px" class="td" valign="top"><input type="text" name="txtlv823" id="txtlv823"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv023;?>" /></td>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Số sản phẩm hiển thị cho sản phẩm thường chọn';?></td>
									<td height="20px" class="td" valign="top"><input type="text" name="txtlv824" id="txtlv824"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv024;?>" /></td>
							</tr>
							 <tr>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Thời gian nạp lại trang cho BẾP/BAR';?></td>
									<td height="20px" class="td" valign="top"><input type="text" name="txtlv825" id="txtlv825"   tabindex="5"  style="width:80%" onkeypress="return CheckKey(event,7)" value="<?php echo $mosl_lv0070->lv025;?>" /></td>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Món ăn xác nhận trước khi xuống Bếp/Bar';?></td>
									<td height="20px" class="td" valign="top">
										<select name="txtlv826" type="text" id="txtlv826" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
											<option value="1" <?php echo ($mosl_lv0070->lv026=="1")?'selected="selected"':'';?>>Yes</option>
											<option value="0" <?php echo ($mosl_lv0070->lv026=="0")?'selected="selected"':'';?>>No</option>
                                         </select>
									</td>
							</tr>
							<tr>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Cho phép in món ăn mới';?></td>
									<td height="20px" class="td" valign="top">
										<select name="txtlv827" type="text" id="txtlv827" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
											<option value="1" <?php echo ($mosl_lv0070->lv027=="1")?'selected="selected"':'';?>>Yes</option>
											<option value="0" <?php echo ($mosl_lv0070->lv027=="0")?'selected="selected"':'';?>>No</option>
                                        </select>
									</td>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Cho phép nhập khách hàng';?></td>
									<td height="20px" class="td" valign="top">
										<select name="txtlv830" type="text" id="txtlv830" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
											<option value="1" <?php echo ($mosl_lv0070->lv030=="1")?'selected="selected"':'';?>>Yes</option>
											<option value="0" <?php echo ($mosl_lv0070->lv030=="0")?'selected="selected"':'';?>>No</option>
                                         </select>
									</td>
													
							</tr>
							<tr>
									<td class="td" height="20px" align="left" valign="top"><?php echo 'Cho phép chọn chương trình bán hàng';?></td>
									<td height="20px" class="td" valign="top">
										<select name="txtlv831" type="text" id="txtlv831" tabindex="5" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)">
											<option value="1" <?php echo ($mosl_lv0070->lv031=="1")?'selected="selected"':'';?>>Yes</option>
											<option value="0" <?php echo ($mosl_lv0070->lv031=="0")?'selected="selected"':'';?>>No</option>
                                         </select>
									</td>
													
							</tr>
							</tr>	
												<tr height="1">
												  <td class="td" colspan="4">&nbsp;</td>
												</tr>
												<tr height="1">
												  <td class="td" colspan="4"><table border="0" cellpadding="0" cellspacing="0" width="100%">
		
		
		
	</table></td>
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

	 <form method="post" enctype="multipart/form-data" name="frmprocess" > 
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[17];?>';
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>