<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0013.php");
require_once("$vDir../clsall/sl_lv0014.php");
////////init object////////////////////
	$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
	$lvsl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0027.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['ajax']))
{
	echo '[CHECK]';
	echo '<select name="txtlv909" id="txtlv909"   tabindex="21"  style="width:80%" onkeypress="return CheckKey(event,1)" onfocus="this.title=\'1\';" onblur="program_change(document.frmadd.txtlv903.value,this.value)" />
	'.$lvsl_lv0014->LV_LinkField('lv009',$_GET['itemid']).'<option value="">...</option></select>	';
	$vsql="select A.lv001,A.lv002,B.lv004 discount,B.lv005 num,B.lv006 score from  sl_lv0059 A inner join sl_lv0060 B on A.lv001=B.lv002 where B.lv003='".$_GET['itemid']."' and A.lv008=1";
		
	echo '[ENDCHECK]';
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
				echo '[CHECKDEF]';
				echo '('.$lvsl_lv0014->FormatView($vrow['num'],10).'sp -> '.$lvsl_lv0014->FormatView($vrow['score'],10).'đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="'.$vrow['num'].'"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="'.$vrow['score'].'"/>';
				echo '[ENDCHECKDEF]';
				echo '[CHECKDIS]';
				echo $lvsl_lv0014->FormatView($vrow['discount'],10);
				echo '[ENDCHECKDIS]';
		}
		else
		{
				echo '[CHECKDEF]';
				echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/>';
				echo '[ENDCHECKDEF]';
				echo '[CHECKDIS]';
				echo 0;
				echo '[ENDCHECKDIS]';
		}	
	exit;
}
if(isset($_GET['ajaxpro']))
{
		$Arr=Array();
		$Arr[0]=$_GET['programid'];
		$Arr[1]=$_GET['itemid'];
		if($_GET['programid']=='' || $_GET['itemid']=='')
		{
			echo '[CHECKDEF]';
			echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
			
			echo '[ENDCHECKDEF]';
			echo '[CHECKDIS]';
			echo 0;
			echo '[ENDCHECKDIS]';
		}
		else
		{
			$vsql="select A.lv001,A.lv002,B.lv004 discount,B.lv005 num,B.lv006 score from  sl_lv0059 A inner join sl_lv0060 B on A.lv001=B.lv002 where B.lv003='".$_GET['itemid']."' and A.lv001='".$_GET['programid']."' and A.lv008=1";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
					echo '[CHECKDEF]';
					echo '('.$lvsl_lv0014->FormatView($vrow['num'],10).'sp -> '.$lvsl_lv0014->FormatView($vrow['score'],10).'đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="'.$vrow['num'].'"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="'.$vrow['score'].'"/>';
					$vstrchild=$lvsl_lv0014->LV_LinkField('lv016',$Arr);
					if($vstrchild=="")	
						echo '<input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					else
					{
					}
						echo '<select name="txtlv916" id="txtlv916"   tabindex="25"  style="width:150px" onkeypress="return CheckKey(event,1)" />'.$vstrchild.'<option value="">...none...</option></select>	';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $lvsl_lv0014->FormatView($vrow['discount'],10);
					echo '[ENDCHECKDIS]';
			}
			else
			{
					echo '[CHECKDEF]';
					echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo 0;
					echo '[ENDCHECKDIS]';
			}
		}
}
$flagCtrl = (int)$_POST['txtFlag'];
$vNow=GetServerDate();
//Lấy mã phiếu nhập kho
$lvsl_lv0013->lv001=$_POST['txtlv801'];
//$lvsl_lv0013->lv001=InsertWithCheck('sl_lv0013', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);
$isExists =0;//$lvsl_lv0013->LV_Exist($lvsl_lv0013->lv001);
$lvsl_lv0013->lv009=$_POST['txtlv809'];
$lvsl_lv0013->lv010=$_POST['txtlv810'];
if($lvsl_lv0013->lv010=="") $lvsl_lv0013->lv010=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvsl_lv0013->lv023=getInfor($_SESSION['ERPSOFV2RUserID'],2);
$lvsl_lv0013->lv004=$_POST['txtlv804'];
if($lvsl_lv0013->lv004=="") $lvsl_lv0013->lv004=$vNow;
$lvsl_lv0013->lv005=$_POST['txtlv805'];
if($lvsl_lv0013->lv005=="") $lvsl_lv0013->lv005=LV_DATE_ADD($vNow,30);
if($flagCtrl == 1){
$lvsl_lv0013->lv002=$_POST['txtlv802'];
$lvsl_lv0013->lv003=$_POST['txtlv803'];
$lvsl_lv0013->lv006=$_POST['txtlv806'];
$lvsl_lv0013->lv007=$_POST['txtlv807'];	
$lvsl_lv0013->lv008=$_POST['txtlv808'];
$lvsl_lv0013->lv009=$_POST['txtlv809'];
$lvsl_lv0013->lv011=$_POST['txtlv811'];
$lvsl_lv0013->lv012=$_POST['txtlv812'];
$lvsl_lv0013->lv013=$_POST['txtlv813'];
$lvsl_lv0013->lv014=$_POST['txtlv814'];
$lvsl_lv0013->lv015=$_POST['txtlv815'];
$lvsl_lv0013->lv016=$_POST['txtlv816'];
$lvsl_lv0013->lv017=$_POST['txtlv817'];
$lvsl_lv0013->lv018=$_POST['txtlv818'];
$lvsl_lv0013->lv019=$_POST['txtlv819'];
$lvsl_lv0013->lv022=$_POST['txtlv822'];
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $lvsl_lv0013->LV_InsertTemp();
		if($bResultI == true){
			$lvsl_lv0014->LV_InsertTemp($lvsl_lv0013->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$lvsl_lv0013->lv002);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$lvsl_lv0014->lv007==0){
			$lvsl_lv0013->LV_Update();
			$lvsl_lv0014->LV_InsertTemp($lvsl_lv0013->lv001,getInfor($_SESSION['ERPSOFV2RUserID'],2),$lvsl_lv0013->lv002);	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lvsl_lv0013->ArrPush[0]=$vLangArr1[17];
$lvsl_lv0013->ArrPush[1]=$vLangArr1[18];
$lvsl_lv0013->ArrPush[2]=$vLangArr1[19];
$lvsl_lv0013->ArrPush[3]=$vLangArr1[20];
$lvsl_lv0013->ArrPush[4]=$vLangArr1[21];
$lvsl_lv0013->ArrPush[5]=$vLangArr1[22];
$lvsl_lv0013->ArrPush[6]=$vLangArr1[23];
$lvsl_lv0013->ArrPush[7]=$vLangArr1[24];
$lvsl_lv0013->ArrPush[8]=$vLangArr1[25];
$lvsl_lv0013->ArrPush[9]=$vLangArr1[26];
$lvsl_lv0013->ArrPush[10]=$vLangArr1[27];
$lvsl_lv0013->ArrPush[11]=$vLangArr1[28];
$lvsl_lv0013->ArrPush[12]=$vLangArr1[29];
$lvsl_lv0013->ArrPush[13]=$vLangArr1[41];
$lvsl_lv0013->ArrPush[14]=$vLangArr1[40];
$lvsl_lv0013->ArrPush[15]=$vLangArr1[42];
$lvsl_lv0013->ArrPush[16]=$vLangArr1[45];
$lvsl_lv0013->ArrPush[17]=$vLangArr1[43];
$lvsl_lv0013->ArrPush[18]=$vLangArr1[44];
$lvsl_lv0013->ArrPush[19]=$vLangArr1[46];
$lvsl_lv0013->ArrPush[20]=$vLangArr1[47];
$lvsl_lv0013->ArrPush[21]=$vLangArr1[48];
$lvsl_lv0013->ArrPush[22]=$vLangArr1[49];
$lvsl_lv0013->ArrPush[23]=$vLangArr1[50];
$lvsl_lv0013->ArrPush[24]=$vLangArr1[51];
$lvsl_lv0013->ArrPush[25]=$vLangArr1[52];
$lvsl_lv0013->ArrPush[26]=$vLangArr1[53];
$vFieldList="lv001,lv002,lv003,lv010,lv023";
$strParent=$lvsl_lv0013->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
if((int)$isExists>=1){
//	$lvsl_lv0013->Load($lvsl_lv0013->ID);
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
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo $vDir;?>jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv809",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv813",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv801.value=="")
		{
			alert("<?php echo $vLangArr[63];?>");
			o.txtlv801.select();
		}
		else if(o.txtlv802.value=="")
		{
			alert("<?php echo $vLangArr[64];?>");
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
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
	}
	function Add()
	{
		var o=document.frmadd;
		var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv004="+o.txtlv904.value+"&txtlv005="+o.txtlv905.value+"&txtlv006="+o.txtlv906.value+"&txtlv007="+o.txtlv907.value+"&txtlv008="+o.txtlv908.value+"&txtlv009="+o.txtlv909.value+"&txtlv010="+o.txtlv910.value+"&txtlv011="+o.txtlv911.value+"&txtlv012="+o.txtlv912.value+"&txtlv013="+o.txtlv913.value+"&txtlv015="+o.txtlv915.value+"&txtlv016="+o.txtlv916.value+"&txtOpt=1";
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
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
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('sl_lv0031/sl_lv0031exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);
		
	}
	function LoadSource()
	{
		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				break;
			case 'RECONTRACT':
				break;
			case 'PO':
				ajax_do ('sl_lv0031/sl_lv0031excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}		
	}
	function LoadHD(vobj,vreturn)
	{
		var vcondi="&contractid="+document.frmadd.txtlv801.value+"&startdate="+document.frmadd.txtlv804.value+"&enddate="+document.frmadd.txtlv805.value+"&parentid="+document.frmadd.txtlv817.value;
		LoadTextParentCond(vobj,vreturn,'sl_lv0016','lv003',document.frmadd.txtlv802.value,1,'<?php echo $plang;?>',vcondi);
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv911.value/100);
		o.txtlv908amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv908.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv908amount.value)+parseFloat(o.txtlv904.value*o.txtlv906.value);
		if(parseFloat(o.txtlvnumber.value)!=0) o.txtlv912.value=parseFloat(o.txtlv904.value)*parseFloat(o.txtlvscore.value)/parseFloat(o.txtlvnumber.value);
	}
	function viewmore()
	{
		var o=document.getElementById('morelistid');
		if(o.style.display=="block")
			o.style.display="none";
		else
			o.style.display="block";
	}
	function Report(vValue)
	{
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	-->
	</script>
</head>
<?php
if($lvsl_lv0013->GetAdd()>0)
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
												  <td class="td" width="32%"><input name="txtlv801" type="text" id="txtlv801"  value="<?php echo InsertWithCheck('sl_lv0013', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);?>" tabindex="2" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
													<td class="td" width="17%" height="20px" align="left" valign="top"><?php echo $vLangArr[20];?></td>
												  <td class="td" width="33%">
							  <table width="80%"><tr><td width="50%"><input name="txtlv802" type="text" id="txtlv802"  value="<?php echo $lvsl_lv0013->lv002;?>" tabindex="2" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv802_search" id="txtlv802_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv802','sl_lv0001','concat(lv002,@!:@!,lv009,@!, @!,lv007,@! - @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv802','sl_lv0001','concat(lv002,@!:@!,lv009,@!, @!,lv007,@! - @!,lv001)')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
												</tr>
												<tr>
												  <td class="td" height="20px" align="left"><?php echo $vLangArr[21];?></td>
												  <td height="20px" class="td"><input  name="txtlv803" type="text" id="txtlv803" value="<?php echo $lvsl_lv0013->lv003;?>" tabindex="3" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
												  <td><?php echo $vLangArr[28];?></td>
												  <td><table width="80%"><tr><td width="50%"><input  name="txtlv810" type="text" id="txtlv810" value="<?php echo $lvsl_lv0013->lv010;?>" tabindex="4" maxlength="15" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" />
														 </td>
														<td>
															<ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
																	<input type="text" autocomplete="off" class="search_img_btn" name="txtlv810_search" id="txtlv810_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv810','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv810','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" tabindex="200" >
																	<div id="lv_popup7" lang="lv_popup7"> </div>						  
																	</li>
															</ul>
														</td></tr>
													</table>	
												  </td>
											  </tr>
												<tr>
												  <td class="td" height="20px" align="left"><?php echo $vLangArr[22];?></td>
												  <td height="20px" class="td"><input name="txtlv804" type="text" id="txtlv804" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0013->lv004,2);?>" tabindex="4" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)" />
                                                  <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv804);return false;" /></td>
												  <td><?php echo $vLangArr[23];?></td>
												  <td><input name="txtlv805" type="text" id="txtlv805" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0013->lv005,2);?>" tabindex="5" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"  onKeyDown="document.frmadd.txtlv913.value=this.value"/>
                                                  <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv805);return false;" /></td>
											  </tr>
											  <tr>
												<td width="18%"class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[25];?></td>
												<td width="32%" height="20px" class="td" valign="top"><table width="80%"><tr><td width="50%"><select name="txtlv807" id="txtlv807"   tabindex="7"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
													  <?php echo $lvsl_lv0013->LV_LinkField('lv007',$lvsl_lv0013->lv007);?>
													  </select></td>
														<td>							   
													<ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv807_search" id="txtlv807_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv807','sl_lv0009','lv002')" onFocus="LoadPopupParent(this,'txtlv807','sl_lv0009','lv002')" tabindex="200" >
													<div id="lv_popup3" lang="lv_popup3"> </div>						  
													</li>
												</ul></td></tr></table>
													  </td>
												<td><?php echo $vLangArr[65];?></td><td><input  name="txtlv822" type="text" id="txtlv822" value="<?php echo (float)$lvsl_lv0013->lv022;?>" tabindex="6" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
												</tr>
											  <tr><td colspan="4" style="height:30px;text-align:center">&nbsp;<a href="javascript:viewmore()">Nhập thêm</a></td></tr>
												
				</table>
				<div style="display:none" id="morelistid">
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
													<td class="td" height="20px" align="left"><?php echo $vLangArr[24];?></td>
												  <td height="20px" class="td"><input  name="txtlv806" type="text" id="txtlv806" value="<?php echo (float)$lvsl_lv0013->lv006;?>" tabindex="6" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>		
												  <td><?php echo $vLangArr[55];?></td>
												  <td><input  name="txtlv814" type="text" id="txtlv814" value="<?php echo $lvsl_lv0013->lv014;?>" tabindex="44" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
					</tr>
					<tr>
						<td width="18%"class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[56];?></td>
						<td width="32%" height="20px" class="td" valign="top"><input  name="txtlv816" type="text" id="txtlv816" value="<?php echo $lvsl_lv0013->lv016;?>" tabindex="6" maxlength="15" style="width:80%" onKeyPress="return CheckKey(event,7)" /></td>
						<td width="17%" height="20px" class="td" ><?php echo $vLangArr[26];?></td>
						<td width="33%" height="20px" class="td"><table width="80%"><tr><td width="50%">
											    <select name="txtlv808" id="txtlv808"   tabindex="12"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
													<?php echo $lvsl_lv0013->LV_LinkField('lv008',$lvsl_lv0013->lv008);?>
												</select>
												</td>
												<td>							   
													<ul id="pop-nav8" lang="pop-nav8" onMouseOver="ChangeName(this,8)" onkeyup="ChangeName(this,8)"> <li class="menupopT">
													<input type="text" autocomplete="off" class="search_img_btn" name="txtlv808_search" id="txtlv808_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv808','sl_lv0008','lv002')" onFocus="LoadPopupParent(this,'txtlv808','sl_lv0008','lv002')" tabindex="200" >
													<div id="lv_popup8" lang="lv_popup8"> </div>						  
													</li>
												</ul></td></tr></table></td>
					</tr>
					<tr>
						<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[54];?></td>
						<td height="20px" class="td" valign="top"><table width="80%"><tr><td width="50%">
							    <select name="txtlv812" id="txtlv812"   tabindex="15"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
                                <option value="">...</option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv012',$lvsl_lv0013->lv012);?>
							  </select></td><td>
							  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv812_search" id="txtlv812_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv812','sl_lv0010','lv003')" onFocus="LoadPopupParent(this,'txtlv812','sl_lv0010','lv003')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
									</li>
								</ul></td></tr></table>	</td>
						<td height="20px" class="td" ><?php echo $vLangArr[57];?></td>
						<td height="20px" class="td"><table width="80%"><tr><td width="50%">
							    <select name="txtlv817" id="txtlv817"   tabindex="12"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
                                <option value="">...</option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv017',$lvsl_lv0013->lv017);?>
							  </select></td><td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv817','sl_lv0013','concat(lv003,@! @!,lv016,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv817','sl_lv0013','concat(lv003,@! @!,lv016,@! @!,lv001)')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
								</li>
									</ul></td></tr></table></td>
					</tr>
					<tr>
						<td class="td" height="20px" align="left" valign="top"><?php echo $vLangArr[27];?></td>
						<td height="20px" class="td" valign="top"><select name="txtlvopt1" id="txtlvopt1"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadHD(this,'txtlv809')"/>
							  <option value="">...</option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv015',$lvsl_lv0013->lv013);?>
							  </select>	</td>
											   <td height="20px" class="td" ><?php echo $vLangArr[59];?></td>
											   <td height="20px" class="td"><select name="txtlvopt2" id="txtlvopt2"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)" onChange="LoadHD(this,'txtlv813')"/>
							  <option value="">...</option>
							  <?php echo $lvsl_lv0013->LV_LinkField('lv015',$lvsl_lv0013->lv013);?>
							  </select>	</td>
					</tr>
					<tr>
						<td height="20px" colspan="2" align="left" valign="top" class="td"><textarea name="txtlv809" rows="5" id="txtlv809" style="width:80%" tabindex="13"><?php echo $lvsl_lv0013->lv009;?></textarea></td>
						<td height="20px" colspan="2" class="td" ><textarea name="txtlv813" rows="5" id="txtlv813" style="width:80%" tabindex="14"><?php echo $lvsl_lv0013->lv013;?></textarea></td>
					</tr>												
					<tr height="1">
					  <td class="td" colspan="4">&nbsp;</td>
					</tr>
				</table>
				</div>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
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
                                                      <td width="100%" align="center"><h3><?php echo $vLangArr[16];?></h3></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td width="13%"><?php echo $vLangArr[32];?></td>
                                                          <td width="34%">
                                                          <table width="100%"><tr> <td width="50%"><select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" onFocus="if(document.frmadd.txtlv913.value=='') document.frmadd.txtlv913.value=document.frmadd.txtlv805.value" onblur="LoadItem();changecategory_change(this.value)"/>
                                                            <?php echo $lvsl_lv0014->LV_LinkField('lv003',$lvsl_lv0014->lv003);?>
                                                            </select></td>
																<td><ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
																		<li class="menupopT">
																		<input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:80%" onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200">
																		<div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
																		</li>
																	</ul>
																</td>
                                                              </tr>
                                                            </table></td>
															<td><?php echo $vLangArr[38];?></td>
															<td><div id="programid"><select name="txtlv909" id="txtlv909"   tabindex="111"  style="width:80%" onkeypress="return CheckKey(event,1)" onfocus="this.title='1';"/>
																
																</select>
																</div>
                                                            </td>
                                                        </tr>
                                                         
                                                        <tr>
                                                          <td><?php echo $vLangArr[33];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()" name="txtlv904" id="txtlv904"   tabindex="21"  style="width:80%" onKeyPress="return CheckKey(event,1)" value="<?php echo (float)$lvsl_lv0014->lv004;?>" onFocus="if(document.frmadd.txtlv913.value=='') document.frmadd.txtlv913.value=document.frmadd.txtlv805.value"/></td>
                                                          <td><?php echo $vLangArr[34];?></td>
                                                          <td><select name="txtlv905" id="txtlv905"   tabindex="111"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $lvsl_lv0014->LV_LinkField('lv005',$lvsl_lv0014->lv005);?>
                                                            </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                          <td><?php echo $vLangArr[35];?></td>
                                                          <td><input name="txtlv906" onkeyup="CalculateM()"  onChange="CalculateM()"  type="text" id="txtlv906" value="<?php echo (float)$lvsl_lv0014->lv006;?>" tabindex="22" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
                                                          <td><?php echo $vLangArr[36];?></td>
                                                          <td><select name="txtlv907" id="txtlv907"   tabindex="111"  style="width:80%" onkeypress="return CheckKey(event,1)"/>
                                                            <?php echo $lvsl_lv0014->LV_LinkField('lv007',$lvsl_lv0014->lv007);?>
                                                            </select></td>
                                                        </tr>
                                                       
														
                                                        
                                                       <tr>
                                                          <td><?php echo $vLangArr[40];?></td>
                                                          <td><input onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv911" type="text" id="txtlv911" value="<?php echo (float)$lvsl_lv0014->lv011;?>" tabindex="23" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv911amount" type="text" id="txtlv911amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td><?php echo $vLangArr[41];?></td>
                                                          <td><div><div style="float:left;width:40%"><input type="textbox" name="txtlv912" id="txtlv912"   tabindex="25"  style="width:100%" onkeypress="return CheckKey(event,1)" value="<?php echo (float)$lvsl_lv0014->lv012;?>"/></div><div style="float:left;width:60%" id="calscore">(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/></div></div></td>
                                                        </tr>
														<tr>
                                                          <td><?php echo $vLangArr[44];?></td>
                                                          <td><input type="text" name="txtlv915" id="txtlv915" style="width:80%" value="<?php echo (int)$lvsl_lv0014->lv015;?>" tabindex="24" maxlength="16"  onKeyPress="return CheckKey(event,1)" /><input type="hidden" onkeyup="CalculateM()"  onChange="CalculateM()"  name="txtlv908" id="txtlv908" value="<?php echo (float)$lvsl_lv0014->lv008;?>" tabindex="24" maxlength="255" style="width:30%" onKeyPress="return CheckKey(event,1)" /><input  name="txtlv908amount" type="hidden" id="txtlv908amount" readonly="true" style="width:48%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td><?php echo $vLangArr[42];?></td>
                                                          <td><input name="txtlv913" type="text" id="txtlv913" value="<?php echo $lvsl_lv0013->FormatView($lvsl_lv0014->lv013,2);?>" tabindex="27" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,1)"  onFocus="if(this.value=='')this.value=document.frmadd.txtlv805.value"/>                                                            
                                                          <img src="<?php echo $vDir;?>../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="111"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv913);return false;" /></td>
                                                        </tr>
														 <tr>
                                                          <td><?php echo $vLangArr[62];?></td>
                                                          <td><input  name="txtlvallamount" type="text" id="txtlvallamount" readonly="true" style="width:80%;background:#cccccc;border:1px #999999 solid"></td>
                                                          <td><?php echo $vLangArr[39];?></td>
                                                          <td><input  name="txtlv910" type="text" id="txtlv910" value="<?php echo $lvsl_lv0014->lv010;?>" tabindex="26" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,1)" /></td>
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
														<img type="image" class="btAdd" name="save" onClick="Save();" 
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
                                                    <tr>
                                                      <td>&nbsp;</td>
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
setTimeout("loadchrome()",100);
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[61];?>';	
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
changecategory_change(document.frmadd.txtlv903.value);
function loadchrome()
{
	tinyMCE.get('txtlv809').execCommand('mceInsertContent',true,'');
	tinyMCE.get('txtlv813').execCommand('mceInsertContent',true,'');
	document.frmadd.txtlv903.focus();
}
function changecategory_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&itemid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			fcus=false;
			if (xmlhttp.readyState==4)
			{
				if(document.getElementById('txtlv909').title=='1') fcus=true;	
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('programid').innerHTML=domainid;
				var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
				document.getElementById('calscore').innerHTML=domainid1;
				var startdomain2=xmlhttp.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp.responseText.substr(startdomain2,enddomain2-startdomain2);
				document.getElementById('txtlv911').value=domainid2;
				if(fcus==true) document.getElementById('txtlv909').focus();
				document.getElementById('txtlv909').title='';
				
			}
		}
		function stateChangedProgram()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain1=xmlhttp1.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp1.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
				document.getElementById('calscore').innerHTML=domainid1;
				var startdomain2=xmlhttp1.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp1.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
				document.getElementById('txtlv911').value=domainid2;
			}
		}
		function program_change(itemid,value)
		{
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxpro=program"+"&programid="+value+"&itemid="+itemid;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedProgram;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
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