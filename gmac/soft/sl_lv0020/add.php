<?php
session_start();
//require_once("../../clsall/sl_lv0020.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0020.php");
//////////////init object////////////////
$lvsl_lv0020=new sl_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0008');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","WH0011.txt",$plang);
$mosl_lv0020->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvsl_lv0020->lv001=$_POST['txtlv001'];
if($_GET['ID']=="")
$lvsl_lv0020->lv002=$_POST['txtlv002'];
else
$lvsl_lv0020->lv002=$_GET['ID'];
$lvsl_lv0020->lv003=$_POST['txtlv003'];
$lvsl_lv0020->lv004=$_POST['txtlv004'];
$lvsl_lv0020->lv005=$_POST['txtlv005'];
$lvsl_lv0020->lv006=$_POST['txtlv006'];
$lvsl_lv0020->lv007=$_POST['txtlv007'];	
$lvsl_lv0020->lv008=$_POST['txtlv008'];
$lvsl_lv0020->lv009=$_POST['txtlv009'];
$lvsl_lv0020->lv010=$_POST['txtlv010'];
$lvsl_lv0020->lv011=$_POST['txtlv011'];

if($lvsl_lv0020->lv009=="") $lvsl_lv0020->lv009=GetServerDate();
if($vFlag==1)
{
		
		$vresult=$lvsl_lv0020->LV_Insert();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/responsive.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascript/engine.js"></script>
<!-- TinyMCE -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtlv008",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
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
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv008.value="";
		o.txtlv006.value="";
		o.txtlv010.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,2,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv002.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv002.select();
		}
		else if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[31];?>");
			o.txtlv003.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
-->
</script>
<?php
if($lvsl_lv0020->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvsl_lv0020->lv001=="")?InsertWithCheckExt('sl_lv0020', 'lv001', 'PN',10):$lvsl_lv0020->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" />			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><select name="txtlv002" id="txtlv002"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)">
							   <?php echo $lvsl_lv0020->LV_LinkField('lv002',$lvsl_lv0020->lv002);?>
                              </select>
							    <br>
							  <table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch3" id="txtlvsearch3" style="width:200px" onKeyUp="LoadPopup(this,'txtlv002','wh_lv0001','lv003')" onFocus="LoadPopup(this,'txtlv002','wh_lv0001','lv003')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table>	</td></tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[17];?></td>
								<td width="178"  height="20"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
								<?php echo $lvsl_lv0020->LV_LinkField('lv003',$lvsl_lv0020->lv003);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv003','*@*@*.hr_lv0020','concat(lv004,lv003,lv002)')" onFocus="LoadPopup(this,'txtlv003','*@*@*.hr_lv0020','concat(lv004,lv003,lv002)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>						 </td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[18];?></td>
							  <td  height="20"></select>
							  <input name="txtlv004" type="text" id="txtlv004"  value="<?php echo $lvsl_lv0020->lv004;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><select name="txtlv005" id="txtlv005"   tabindex="9"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
								<?php echo $lvsl_lv0020->LV_LinkField('lv005',$lvsl_lv0020->lv005);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv003','wh_lv0013','lv002')" onFocus="LoadPopup(this,'txtlv003','wh_lv0013','lv002)')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
						  </tr>
						  <tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[20];?></td>
							  <td  height="20"></select>
							  <input name="txtlv006" type="text" id="txtlv006"  value="<?php echo $lvsl_lv0020->lv006;?>" tabindex="10" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/>
						  <br></td></tr>
							<tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvsl_lv0020->FormatView($lvsl_lv0020->lv009,2);?>" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)">
						      <span class="td"><img src="../../images/calendar/calendar.gif" name="imgDate1" id="imgDate1"  tabindex="11"
															border="0" style="cursor:pointer" width="16" height="16" align="top" 
															onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtlv009);return false;" /></span></td>
						  </tr>
							  <td  height="20"><?php echo $vLangArr[21];?></td>
							  <td  height="20"><textarea name="txtlv008" rows="20" id="txtlv008" style="width:80%" tabindex="13" ><?php echo $lvsl_lv0020->lv007;?></textarea></td>
						    </tr>							 			  							  																			
							<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="47"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
			      </form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv003.focus();
</script>

<script language="javascript" src="../../javascript/menupopup.js"></script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>