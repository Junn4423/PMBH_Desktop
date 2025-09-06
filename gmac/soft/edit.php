<?php
/*
Copy right ERPSOFV2R.com
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/lv_lv0007.php");
$vDefaultPath="../../../images/logo/";
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/lv_lv0007.php");
//////////////init object////////////////
$lvlv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
/////////Get ID///////////////
$lvlv_lv0007->lv001=$_GET['ID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","LV0004.txt",$plang);

$vFlag=(int)$_POST['txtFlag'];

$vStrMessage="";


if($vFlag==1)
{
		$lvlv_lv0007->lv002=$_POST['txtlv002'];
		$lvlv_lv0007->lv003='';
		$lvlv_lv0007->lv004=$_POST['txtlv004'];
		$lvlv_lv0007->lv005=$_POST['txtlv005'];
		$lvlv_lv0007->lv006=$_POST['txtlv006'];
		$lvlv_lv0007->lv007=$_POST['txtlv007'];
		$lvlv_lv0007->lv008=$_POST['txtlv008'];
		$lvlv_lv0007->lv009=$_POST['txtlv009'];
		$lvlv_lv0007->lv010=$_POST['txtlv010'];
		$lvlv_lv0007->lv011=$_POST['txtlv011'];
		$lvlv_lv0007->lv012=$_POST['txtlv012'];
		$lvlv_lv0007->lv013=$_POST['txtlv013'];
		$lvlv_lv0007->lv014=$_POST['txtlv014'];
		$lvlv_lv0007->lv015=$_POST['txtlv015'];
		$lvlv_lv0007->lv016=$_POST['txtlv016'];
		$lvlv_lv0007->lv017=$_POST['txtlv017'];
		$lvlv_lv0007->lv019=$_POST['txtlv019'];
		$lvlv_lv0007->lv099=$_POST['txtlv099'];
		$vresult=$lvlv_lv0007->LV_Update();
		if($vresult==true) {
			if($_FILES['userfile']['name']!="")
			UploadImg($vDefaultPath,$lvlv_lv0007->lv001, $lvlv_lv0007->lv009);///Call function Upload file
			$vStrMessage=$vLangArr[14];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[15].sof_error();
			$vFlag=0;
		}

}
function DelFiles($path, $vFileName){
	if (is_dir($path)) {
		if ($dh = opendir($path)) {
			while (($file = readdir($dh)) !== false) {
				if(!(is_dir($path.$file) && $file!="." && $file!=".."  )) {
					if($file!=$vFileName && $file!="index.html") delete_file($path.$file);
				}
			}
			closedir($dh);
		}
	}
	//return $files;
}
function UploadImg($folder_name,$folderemp, $fname){
	$maxsize = 316960;//Max file size 4MB
	$path = $folder_name.$folderemp."/";
	if( !is_dir($path )) create_folder( $folder_name,$folderemp);
	$vFileName = $fname;
	$arrName = explode(".", $fname);
		$fname = $arrName[0];///Get name without extention of file
	$result = upload_file($fpath, $fname, $path, $maxsize);
	if($result==1){
		$message = "Image uploaded successfully!";
		DelFiles($path, $vFileName);///Remove all other file
	}
	if($result==2)
		$message = "Incorrect file type!";
	if($result==3 || $result==4)
		$message = "Image size is very small or big!";
	if($result==5 || $result==6)
		$message = "Error in uploading file, please try again!";
}
$lvlv_lv0007->LV_LoadID($lvlv_lv0007->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>LE VINH</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['userlogin_smcd'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascript/engine.js"></script>
</head>
<script language="javascript">
function isphone(s){
	if(s!=""){
		var str="0123456789.()"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frmedit;
		o.txtlv002.value="<?php echo $lvlv_lv0007->lv002;?>";
		o.txtlv003.value="<?php echo $lvlv_lv0007->lv003;?>";
		o.txtlv004.value="<?php echo $lvlv_lv0007->lv004;?>";
		o.txtlv005.value="<?php echo $lvlv_lv0007->lv005;?>";
		o.txtlv006.value="<?php echo $lvlv_lv0007->lv006;?>";		
		o.txtlv007.value="<?php echo $lvlv_lv0007->lv007;?>";		
		o.txtlv008.value="<?php echo $lvlv_lv0007->lv008;?>";		
		o.txtlv009.value="<?php echo $lvlv_lv0007->lv009;?>";	
		o.txtlv010.value="<?php echo $lvlv_lv0007->lv010;?>";		
		o.txtlv011.value="<?php echo $lvlv_lv0007->lv011;?>";	
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frmedit;
		if(o.txtlv001.value=="")
			alert("<?php echo $vLangArr[16];?>");
		else
		{
		o.txtFlag.value="1";
		o.submit();
		}
			
	}
</script>
<body bgcolor="">
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[9];?></h2>
  <div class="story">
    <h3>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#f1f1f1">
			<tr>
				<td width="13">
					<img name="table_r1_c1" src="../images/pictures/table_r1_c1.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="*" background="../images/pictures/table_r1_c2.gif">
					<img name="table_r1_c2" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td width="13">
					<img name="table_r1_c3" src="../images/pictures/table_r1_c3.gif" 
						width="13" height="12" border="0" alt=""></td>
				<td width="11">
					<img src="../images/pictures/spacer.gif" 
						width="1" height="12" border="0" alt=""></td>
			</tr>
			<tr>
				<td background="../images/pictures/table_r2_c1.gif">
					<img name="table_r2_c1" src="../images/pictures/spacer.gif" 
						width="1" height="1" border="0" alt=""></td>
				<td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frmedit" id="frmedit" action="#" method="post" enctype="multipart/form-data">
					<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>" />
						<table width="680" border="0" align="center" id="table1">
							<tr><td colspan="3" align="center">
					<?php		
						echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
						?>
							</td></tr>
							<tr>
								<td width="112"  height="20px"><?php echo $vLangArr[10];?></td>
							  <td width="335"  height="20px"><input   tabindex="5"  name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvlv_lv0007->lv001;?>" /></td>
							</tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[11];?></td>
							  <td  height="20px"><select name="txtlv002" id="txtlv002"  tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvlv_lv0007->LV_LinkField('lv002',$lvlv_lv0007->lv002);?></select></td>
						  </tr>
						  <!--
							<tr>
							  <td  height="20px"><?php echo $vLangArr[12];?></td>
							  <td  height="20px"><select  name="txtlv003" id="txtlv003"  tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"></select></td>
							  </tr>
							  -->
							<tr>
							  <td  height="20px"><?php echo $vLangArr[13];?></td>
							  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvlv_lv0007->lv004;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  </tr>							  
							
							<tr>
							  <td  height="20px"><?php echo $vLangArr[15];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvlv_lv0007->lv006;?>" tabindex="10" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>		
							<tr>
							  <td  height="20px"><?php echo $vLangArr[16];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvlv_lv0007->FormatView($lvlv_lv0007->lv007,2);?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>							
							<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
							  <td  height="20px"><select name="txtlv008" id="txtlv008"  tabindex="12" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)">
							  	<option value="0" <?php echo ($lvlv_lv0007->lv008==0)?"selected='selected'":""?>>Nữ</option>
							  	<option value="1" <?php echo ($lvlv_lv0007->lv008==1)?"selected='selected'":""?>>Nam</option>
							  </select>
							  </td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvlv_lv0007->lv009;?>" tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvlv_lv0007->lv010;?>" tabindex="14" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo $lvlv_lv0007->lv011;?>" tabindex="15" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
								 <tr>
								<td width="166"  height="20"><?php echo $vLangArr[21];?></td>
								<td  height="20"><select name="txtlv012" id="txtlv012"  tabindex="16"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvlv_lv0007->LV_LinkField('lv012',$lvlv_lv0007->lv012);?></select></td>
                          </tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[23];?></td>
							  <td  height="20px"><input name="txtlv014" type="text" id="txtlv014" value="<?php echo $lvlv_lv0007->lv014;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[24];?></td>
							  <td  height="20px"><input name="txtlv015" type="text" id="txtlv015" value="<?php echo $lvlv_lv0007->lv015;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
							  <td  height="20px"><?php echo $vLangArr[25];?></td>
							  <td  height="20px"><input name="txtlv016" type="text" id="txtlv016" value="<?php echo $lvlv_lv0007->lv016;?>" tabindex="17" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>	
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[26];?></td>
								<td  height="20"><select name="txtlv019" id="txtlv019"  tabindex="18"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvlv_lv0007->LV_LinkField('lv019',$lvlv_lv0007->lv019);?></select></td>
                          </tr>
						  <tr>
								<td width="166"  height="20"><?php echo 'Themes';?></td>
								<td  height="20"><select name="txtlv099" id="txtlv099"  tabindex="18"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvlv_lv0007->LV_LinkField('lv099',$lvlv_lv0007->lv099);?></select></td>
                          </tr>
							<tr>
							  <td  height="20" colspan="3"><input name="txtFlag" type="hidden" id="txtFlag" /></td>
						  </tr>
							<tr>
							  <td  height="20" colspan="3"> <TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /><?php echo $vLangArr[2];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
			<!--
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			//-->	
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove><?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<script language="javascript"> var o=document.frmedit; resizeFrameAll(document.body.offsetWidth,o.offsetHeight);
		o.txtlv002.select();
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
</body>
</html>