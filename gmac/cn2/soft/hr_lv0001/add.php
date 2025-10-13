<?php
session_start();
//require_once("../../clsall/hr_lv0001.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0001.php");
//////////////init object////////////////
$lvhr_lv0001=new hr_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0001');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","AD0050.txt",$plang);
function db_connecttmp()
{
	global $db_link1;
	$db_link1=mysql_connect(DB_SERVER,DB_USER,DB_PWD);
	return $db_link1;
}
function db_closetmp()
{
	global $db_link1;
	$result=mysql_close($db_link);
	return $db_link1;
}
function db_querytmp($db_query){
	global $db_link1;
	$result=mysql_query($db_query,db_connecttmp());
	return $result;
}
$curPage=(int)$_POST['curPg'];
$vFlag=(int)$_POST['txtFlag'];
$lvhr_lv0001->lv001=$_POST['txtlv001'];
$lvhr_lv0001->lv002=$_POST['txtlv002'];
$lvhr_lv0001->lv003=$_POST['txtlv003'];
$lvhr_lv0001->lv004=$_POST['txtlv004'];
$lvhr_lv0001->lv005=$_POST['txtlv005'];
$lvhr_lv0001->lv006=$_POST['txtlv006'];
$lvhr_lv0001->lv007=$_POST['txtlv007'];
$lvhr_lv0001->lv008=$_POST['txtlv008'];
$lvhr_lv0001->lv009=$_FILES['userfile']['name'];
$lvhr_lv0001->lv010=$_POST['txtlv010'];
$lvhr_lv0001->lv011=$_POST['txtlv011'];
$lvhr_lv0001->lv012=$_POST['txtlv012'];
$lvhr_lv0001->lv013=$_POST['txtlv013'];
$lvhr_lv0001->lv014=str_replace(" ","",$_POST['txtlv014']);
$lvhr_lv0001->lv015=$_FILES['userfile2']['name'];
$lvhr_lv0001->lv016=$_POST['txtlv016'];
$lvhr_lv0001->lv099=$_POST['txtlv099'];
if($vFlag==1)
{
	
	$vresult=$lvhr_lv0001->LV_Insert();
	if($vresult==true) {
		UploadImg($lvhr_lv0001->lv001, $lvhr_lv0001->lv009);///Call function Upload file
		$vStrMessage=$vLangArr[12];
		$vFlag = 1;
	} else{
		$vStrMessage=$vLangArr[13].sof_error();		
		$vFlag = 0;
	}
}
function UploadImg($folder_name, $fname){
	$maxsize = 316960;//Max file size 30KMB
	$path = "../../../images/logo/";
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	if(create_folder($path, $folder_name)==true){
		$path = $path.$folder_name."/";
		$result = upload_file($fpath, $fname, $path, $maxsize);
		if($result==1){
			$message = "Image uploaded successfully!";
			//$vFlag = 2;//Upload successful.
			//$fpath = "";
			//$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";
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
</head>
<script language="javascript">
<!--
function isphone(s){
	if(s!=""){
		var str="0123456789.()"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>");	
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
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
			alert("<?php echo $vLangArr[16];?>");
		else if(!isphone(o.txtlv005.value)){
			o.txtlv005.focus();
			}
		else if(!isphone(o.txtlv006.value)){
			o.txtlv006.focus();
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
if($lvhr_lv0001->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h2 id="pageName"><?php echo $vLangArr[8];?></h2>
    
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						<table width="100%" border="0" align="center" class="table1">
							<tr><td colspan="2" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="180"  height="20px"><?php echo $vLangArr[10];?></td>
							  <td width="*%"  height="20px"><input  name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvhr_lv0001->lv001;?>" tabindex="5" style="width:80%"/></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[11];?></td>
							  <td  height="20px"><input name="txtlv002" type="text" id="txtlv002" style="width:80%" value="<?php echo $lvhr_lv0001->lv002;?>" onKeyPress="return CheckKey(event,7)" tabindex="6" /></td>
						  </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[26];?></td>
							  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvhr_lv0001->lv004;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>
<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvhr_lv0001->lv003;?>" tabindex="8	" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvhr_lv0001->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>

							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvhr_lv0001->lv006;?>" tabindex="10" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>		
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvhr_lv0001->lv007;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>							
							<tr>
							  <td  height="20px"><?php echo $vLangArr[22];?></td>
							  <td  height="20px"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvhr_lv0001->lv008;?>" tabindex="12" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
							  <td  height="20px"><input name="txtlv009" type="hidden" id="txtlv009" value="<?php echo $lvhr_lv0001->lv009;?>" tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/><input type="file" tabindex="13"  name="userfile" id="userfile" size="23" readonly="true" style="width:80%"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
							  <td  height="20px"><input name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvhr_lv0001->lv010;?>" tabindex="14" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[25];?></td>
							  <td  height="20px"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo (int)$lvhr_lv0001->lv011;?>" tabindex="15" maxlength="4" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
								 <tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td height="20">
								<table width="80%"><tr><td  width="50%"><select name="txtlv012" id="txtlv012"  tabindex="16"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
								<?php echo $lvhr_lv0001->LV_LinkField('lv012',$lvhr_lv0001->lv012);?></select></td><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlv012_search" id="txtlv012_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv012','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv012','hr_lv0014','lv002')" tabindex="200" >
						  <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
						
					</ul></td></tr></table>							</td>
                          </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20">
							  <table width="80%"><tr><td  width="50%"><select name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvhr_lv0001->lv013;?>" tabindex="17" maxlength="6" style="width:100%" onkeypress="return CheckKeys(event,7,this)" />
							  <?php echo $lvhr_lv0001->LV_LinkField('lv013',$lvhr_lv0001->lv013);?>
						      </select></td><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlv013_search" id="txtlv013_search" style="width:100%" onKeyUp="LoadPopup(this,'txtlv013','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv013','hr_lv0023','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
							</tr>		
							<tr>
							  <td  height="20px"><?php echo 'Your IP';?></td>
							  <td  height="20px"><input name="txtlv099" type="text" id="txtlv099" value="<?php echo $lvhr_lv0001->lv099;?>" tabindex="19" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag"  /></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>	

				
  </div>
</div>
<script language="javascript">
	var o=document.frmadd;
		o.txtlv001.focus();
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
	include("permit.php");
}
?>
</body>
</html>