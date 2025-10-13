<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/ml_lv0004.php");
$vDefaultPath="../../../images/logo/";
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ml_lv0004.php");
//////////////init object////////////////
$lvml_lv0004=new ml_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0004');
/////////Get ID///////////////
$lvml_lv0004->lv001=$_GET['ID'];
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0008.txt",$plang);

$vFlag=(int)$_POST['txtFlag'];

$vStrMessage="";


if($vFlag==1)
{
		$lvml_lv0004->lv002=$_POST['txtlv002'];
		$lvml_lv0004->lv003=$_POST['txtlv003'];
		$lvml_lv0004->lv004=$_POST['txtlv004'];
		$lvml_lv0004->lv005=$_POST['txtlv005'];
		$lvml_lv0004->lv006=$_POST['txtlv006'];
		$lvml_lv0004->lv007=$_POST['txtlv007'];
		$lvml_lv0004->lv008=$_POST['txtlv008'];
		if($_FILES['userfile']['name']=="")
			$lvml_lv0004->lv009=$_POST['txtlv009'];
		else
			$lvml_lv0004->lv009=$_FILES['userfile']['name'];
		$lvml_lv0004->lv010=$_POST['txtlv010'];
		$lvml_lv0004->lv011=$_POST['txtlv011'];
		$lvml_lv0004->lv012=$_POST['txtlv012'];
		$lvml_lv0004->lv013=$_POST['txtlv013'];
		
		$vresult=$lvml_lv0004->LV_Update();
		if($vresult==true) {
			if($_FILES['userfile']['name']!="")
			UploadImg($vDefaultPath,$lvml_lv0004->lv001, $lvml_lv0004->lv009);///Call function Upload file
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
$lvml_lv0004->LV_LoadID($lvml_lv0004->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
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
		o.txtlv002.value="<?php echo $lvml_lv0004->lv002;?>";
		o.txtlv003.value="<?php echo $lvml_lv0004->lv003;?>";
		o.txtlv004.value="<?php echo $lvml_lv0004->lv004;?>";
		o.txtlv005.value="<?php echo $lvml_lv0004->lv005;?>";
		o.txtlv006.value="<?php echo $lvml_lv0004->lv006;?>";		
		o.txtlv007.value="<?php echo $lvml_lv0004->lv007;?>";		
		o.txtlv008.value="<?php echo $lvml_lv0004->lv008;?>";		
		o.txtlv009.value="<?php echo $lvml_lv0004->lv009;?>";	
		o.txtlv010.value="<?php echo $lvml_lv0004->lv010;?>";		
		o.txtlv011.value="<?php echo $lvml_lv0004->lv011;?>";	
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
</script>
<body   onkeyup="KeyPublicRun(event)">
<div id="content_child">
    <h2 id="pageName"><?php echo $vLangArr[9];?></h2>
  <div class="story">
    <h3>
		
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
								<td width="112"  height="20"><?php echo $vLangArr[10];?></td>
							  <td width="535"  height="20"><input  name="txtlv001" type="text" id="txtlv001" readonly="true" value="<?php echo $lvml_lv0004->lv001;?>" /></td>
							  <td width="135" rowspan="8"><img name="imgView" border="1" style="border-color:#CCCCCC" title="" alt="Image" width="96px" height="128px" 
								src="<?php echo "../../../images/logo/".$lvml_lv0004->lv001."/".$lvml_lv0004->lv009; ?>" /></td>
							</tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[11];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002" style="width:80%" value="<?php echo $lvml_lv0004->lv002;?>" onKeyPress="return CheckKey(event,7)" tabindex="6"/></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvml_lv0004->lv004;?>" tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><input  name="txtlv003" type="text" id="txtlv003" value="<?php echo $lvml_lv0004->lv003;?>" tabindex="8	" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvml_lv0004->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>

							<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvml_lv0004->lv006;?>" tabindex="10" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>		
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo $lvml_lv0004->lv007;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>							
							<tr>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><input name="txtlv008" type="text" id="txtlv008" value="<?php echo $lvml_lv0004->lv008;?>" tabindex="12" maxlength="20" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><input name="txtlv009" type="text" id="txtlv009" value="<?php echo $lvml_lv0004->lv009;?>" tabindex="13" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/></td>
							  <td>&nbsp;<input type="file" name="userfile" id="userfile" readonly="true"/></td>
							</tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
							  <td  height="20"><input name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvml_lv0004->lv010;?>" tabindex="14" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[25];?></td>
							  <td  height="20"><input name="txtlv011" type="text" id="txtlv011" value="<?php echo (int)$lvml_lv0004->lv011;?>" tabindex="15" maxlength="4" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							  <td>&nbsp;</td>
							</tr>						 <tr>
								<td width="166"  height="20"><?php echo $vLangArr[27];?></td>
								<td width="178"  height="20"><select name="txtlv012" id="txtlv012"  tabindex="16"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
								<?php echo $lvml_lv0004->LV_LinkField('lv012',$lvml_lv0004->lv012);?></select><br><table><tr><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
						  <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch" id="txtlvsearch" style="width:200px" onKeyUp="LoadPopup(this,'txtlv012','hr_lv0023','lv002')" onFocus="LoadPopup(this,'txtlv012','hr_lv0014','lv002')" tabindex="200" >
						  <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
						
					</ul></td></tr></table>							</td>
							    <td width="178">&nbsp;</td>
                          </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><select name="txtlv013" type="text" id="txtlv013"  value="<?php echo $lvml_lv0004->lv013;?>" tabindex="17" maxlength="6" style="width:80%" onkeypress="return CheckKey(event,7)" />
							  <?php echo $lvml_lv0004->LV_LinkField('lv013',$lvml_lv0004->lv013);?>
						      </select><br><table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv013','hr_lv0014','lv002')" onFocus="LoadPopup(this,'txtlv013','hr_lv0023','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table>	</td>
							  <td>&nbsp;</td>
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