<?php
session_start();
//require_once("../../clsall/ml_lv0010.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ml_lv0010.php");
//////////////init object////////////////
$lvml_lv0010=new ml_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0010');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0019.txt",$plang);

$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvml_lv0010->lv001=InsertWithCheckExt('ml_lv0010', 'lv001', '',0);
$lvml_lv0010->lv002=$_SESSION['ERPSOFV2RUserID'];
$lvml_lv0010->lv006=GetServerDate()." ".GetServerTime();
$lvml_lv0010->lv005=$_FILES['userfile']['name'];
$lvml_lv0010->lv005=(unicode_to_none(unicode_to_upperexist(str_replace(" ","_",$lvml_lv0010->lv005))));
if($vFlag==1)
{
		$lvml_lv0010->lv003=$_FILES['userfile']['size'];
		$lvml_lv0010->lv004="images/human/File/MailTemp/";
		$vresult=$lvml_lv0010->LV_Insert();
		if($vresult==true) {
			UploadImg($lvml_lv0010->lv002."_".$lvml_lv0010->lv001, ($lvml_lv0010->lv005));
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;	
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
function UploadImg($folder_name, $fname){
	$maxsize = 20971520;//Max file size 30KB
	$path = "../../images/human/File/MailTemp/";
	$arrName = explode(".", $fname);
	if(count($arrName)>2)
	{
		$fname="";
		for($i=0;$i<count($arrName)-1;$i++)
		if($fname=="")
		$fname=$fname.$arrName[$i];
		else 
		$fname=$fname.".".$arrName[$i];
	}
	else
		$fname = $arrName[0];///Get name without extention of file
	if(create_folder($path, $folder_name)==true || is_dir($path.$folder_name)){
		$path = $path.$folder_name."/";
		$result = upload_filemail($fpath, $fname, $path, $maxsize);
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
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
</head>
<script language="javascript">
<!--
function isnumber(s){
	if(s!=""){
		var str="0123456789"
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
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frm_mail');
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv001.value=="")
		{
			alert("<?php echo $vLangArr[21];?>");
			o.txtlv001.select();
		}
		else if(o.userfile.value==""){
			alert("<?php echo $vLangArr[23];?>");
			o.userfile.select();
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
if($lvml_lv0010->GetAdd()>0)
{
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" method="post" enctype="multipart/form-data"   name="frmadd" id="frmadd" >
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
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvml_lv0010->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input type="file" name="userfile" id="userfile" size="23" tabindex="9"/>
							  <input name="txtlv005" type="hidden" id="txtlv005" value="<?php echo $lvml_lv0010->lv005;?>" tabindex="9" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
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