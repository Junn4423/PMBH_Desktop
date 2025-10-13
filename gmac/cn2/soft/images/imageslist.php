<?php
include("paras.php");
global $pListFolder;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
require_once("../clsall/lv_controler.php");
require_once("$vDir../clsall/lv_lv0007.php");
$molv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0033');
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","HR0049.txt",$plang);	
$dir=$_POST['dbxFolder'];
$vback=(int)$_POST['txtBack'];
$vChildFolder=$_POST['txtChildFolder'];
$vName=$_POST['txtName'];
$vFolderName=$_POST['txtFolderName'];
$root="images/documents";
if($dir=="") $dir="/";
$dir=$root.$dir;
$dir=str_replace("//","/",$dir);
switch($vback)
{
	case 1:
		$dir=substr($dir,0,strrpos($dir,"/"));
		break;
	case 2:
		$dir=$dir."/".$vChildFolder;
		break;
	case 3:
		if($molv_lv0007->GetDel()>0)
		{
		delete_file($dir."/".$vChildFolder);
		}
		break;
	case 4:
		if($molv_lv0007->GetAdd()>0)
		{
		$maxsize = 4195000;	
		$extension = exten($vName);
		$vName=str_replace($extension,"",$vName);
		if($vName=="") $vName=str_replace("-","",GetServerDate()).str_replace(":","",GetServerTime());
		$path = $dir."/";		
		$result=upload_file($fpath,$vName, $path, $maxsize);
		if($result==1)
		{
			$fp = fopen( $path . "/index.html", "w" );
			fwrite( $fp, "<html>\n<body bgcolor=\"#FFFFFF\"><a href='http://www.sof.vn'>SOF.VN</a>\n</body>\n</html>" );
			fclose( $fp );
			mosChmod( $folder."/index.html" );
			$message = "Image uploaded successfully!";
			$vFlag = 2;//Upload successful.
			$fpath = "";
			$fname = "";
		}
		if($result==2)
			$message = "Incorrect file type!";
		if($result==3 || $result==4)
			$message = "Image size is very small or big!";
		if($result==5 || $result==6)
			$message = "Error in uploading file, please try again!";	
		}
		break;
	case 5:
		if($molv_lv0007->GetAdd()>0)
		{
		create_folder($dir."/",$vFolderName);
		}
		break;
	case 6:
		if($molv_lv0007->GetDel()>0)
		{
		delete_folder($dir."/".$vChildFolder);
		}
		break;
}
if($dir=="" || $dir=="..")   $dir = "images/documents/";
	
// Open a known directory, and proceed to read its contents
$vGetArrlst=getlistforder($root);
Looplistforder($vGetArrlst);
?>
<script language="javascript">
<!--
function Help(){'http://www.ERPSOFV2R.com?option=com_content&amp;sectionid=0#';}
/*=======================================================================================*/
function Reload(){
	var o=document.frmchoose;
	o.action="?<?php echo $psaveget;?>";
	o.submit();
}
/*=======================================================================================*/
function Back(){
	var o=document.frmchoose;
	o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
	o.submit();
}
/*=======================================================================================*/
function RunChange()
{
	var o=document.frmchoose;
	o.txtBack.value="0";	
	o.action="?<?php echo $psaveget;?>";
	o.submit();
}
function BackFolder()
{
	var o=document.frmchoose;
	o.txtBack.value="1";
	o.action="?<?php echo $psaveget;?>";
	o.submit();

}
function openchild(ChildFolder)
{
	var o=document.frmchoose;
	o.txtBack.value="2";
	o.action="?<?php echo $psaveget;?>";
	o.txtChildFolder.value=ChildFolder;
	o.submit();
}
function delefile(vfile)
{
	var o=document.frmchoose;
	o.txtBack.value="3";
	o.action="?<?php echo $psaveget;?>";
	o.txtChildFolder.value=vfile;
	if(confirm("<?php echo $vLangArr[15];?>"))
	{
	o.submit();
	}

}
function Upload()
{
	var o=document.frmchoose;
	o.txtBack.value="4";
	o.action="?<?php echo $psaveget;?>";
	if(confirm("<?php echo $vLangArr[16];?>"))
	{
		o.submit();
	}	
}
function Create()
{
	var o=document.frmchoose;
	o.txtBack.value="5";
	o.action="?<?php echo $psaveget;?>";
	if(o.txtFolderName.value=="")
	{
		alert("<?php echo $vLangArr[0];?>");
		return;
	}
	if(confirm("<?php echo $vLangArr[17];?>"))
	{
		o.submit();
	}	
}
function deleteFolder(vfile)
{
	var o=document.frmchoose;
	o.txtBack.value="6";
	o.action="?<?php echo $psaveget;?>";
	o.txtChildFolder.value=vfile;
	if(confirm("<?php echo $vLangArr[18];?>"))
	{
	o.submit();	
	}
}
//-->
</script>
<?php
if($molv_lv0007->GetView()>0)
{
?>
<div id="content_child">
	<div id="breadCrumb">
		<TABLE class="menubar" cellSpacing="0" cellPadding="0" width="100%" border="0">
		<TBODY>
			<TR>
				<TD class=menudottedline width="20%">
				</TD>
				<TD class="menudottedline" align="right">
					<TABLE id="toolbar" cellSpacing="0" cellPadding="0" border="0">
					<TBODY>
						<TR vAlign="center" align="middle">
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<?php
							if($molv_lv0007->GetAdd()>0)
		{?>
							<TD>
								<a class="toolbar" href="javascript:Upload();">
						  		<img tittle="<?php echo $vLangArr[1];?>" 
								src="../<?php echo $vDir;?>images/controlright/upload_f2.png" align="middle" border="0" 
								name="print" /><br><?php echo $vLangArr[2];?></a></TD>
							<TD><a class="toolbar" href="javascript:Create();">
								<img src="../images/controlright/new_f2.png" title="<?php echo $vLangArr[3];?>" 
									name="back" id="back" alt="back" border="0" align="middle">
								<br>
							    <?php echo $vLangArr[4];?></a></TD>
								<?php
								}
								?>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD><a class="toolbar" href="javascript:Reload();">
								<img src="../images/controlright/reload.gif" title="<?php echo $vLangArr[5];?>" 
									name="reload" id="reload" alt="reload" border="0" align="middle">
								<br><?php echo $vLangArr[6];?></a></TD>
							<!--
							<TD>&nbsp;</TD>
							<TD>&nbsp;</TD>
							//-->
							<TD>
								<a class="toolbar" onclick="window.open('http://help.lyminhtextile.com/index2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=screen.content','mambo_help_win','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" href="javascript:Help()">
								<img src="../images/controlright/help.gif" title="<?php echo $vLangArr[7];?>" 
									name="help" id="help" alt="help" border="0" align="middle">
								<br><?php echo $vLangArr[8];?></a></TD>
						</TR>
						</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
		</TABLE>
	</div>
	<div class="story">
	<h3>
<!----------------------------------------------//Note//------------------------------------------------------------->
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="index2.php" name="frmchoose" method="post" enctype="multipart/form-data" >
						<table width="100%" align="center">
						<tr>
							<th>
								<table class="adminheading" width="100%">
								<tr>
									<th class="mediamanager">
										<table border=0 width="100%">
										  <?php
											  if($molv_lv0007->GetAdd()>0)
												{
											  
											  ?>
											<tr>
												<td colspan="2"><?php echo $vLangArr[13];?></td>
												<td width="229"><small>
												  <input class="inputbox" type="file" name="userfile" id="userfile" width="100%" />
												</small> </td>
												<td align="right"> <?php echo $vLangArr[14];?></td>
												<td align="right"><input type="text" name="txtName" style="width:90px" /></td>
											</tr>
											<?php
											}
											?></table>
									</th>
									<td>
										<table border="0" align="right" cellpadding="0" cellspacing="4" width="100%">
										<tr>
											<td align="right" width="100%" style="padding-right:10px;white-space:nowrap">
												<?php echo $vLangArr[10];?>
											</td>
											<td>
												<input class="inputbox" type="text" name="txtFolderName"  width="100%" />
											</td>
										</tr>
										<tr>
											<td align="right" style="padding-right:10px;;white-space:nowrap">
												<?php echo $vLangArr[11];?>
											</td>
											<td>
												<input class="inputbox" type="text" name="imagecode" style="width:100%" />
											</td>
										</tr>						
										</table>
									</td>
								</tr>
								</table>
							</th>
						<tr>
							<td align="center">
								<fieldset>
									<table width="99%" align="center" border="0" cellspacing="2" cellpadding="2">
									<tr>
										<td>
											<table border="0" cellspacing="1" cellpadding="3"  class="adminheading">
											<tr>
											  <td width="129"><?php echo $vLangArr[12];?> </td>
											  <td colspan="2"><select name="dbxFolder" id="dbxFolder" onchange="javascript:RunChange();">
												<option value="">/</option>
												<?php 
														$i=0;
														while(count($pListFolder)>$i)
														{
														?>
												<option value="<?php echo str_replace($root,"",$pListFolder[$i]);?>" <?php echo ($dir==$pListFolder[$i])?'selected':'';?> ><?php echo str_replace($root,"",$pListFolder[$i]);?></option>
												<?php										
															$i++;
														}
				
														?>
																			</select></td>
											  <td width="37" align="right"><a href="javascript:BackFolder()"><img src="../images/sample/btnFolderUp.gif"   border="0" alt="Up" /></a>&nbsp;</td>
											  <td width="144" align="right">&nbsp;</td>
											  </tr>
											
											</table>						</td>
									</tr>
									<tr>
										<td align="center" bgcolor="white">
						 <div class="manager">
				<?php
					$file_type = array (".jpg",".gif",".bmp",".jpeg",".JPG",".GIF",".BMP",".JPEG",'.png','.PNG');
					if (is_dir($dir)) {
					if ($dh = opendir($dir)) {
						while (($file = readdir($dh)) !== false) {
							if(is_dir($dir ."/".$file) && $file!="." && $file!=".." )
							{
				
				?>		 
						  <div style="padding: 5px; float: left;">
							<div class="imgTotal" onmouseover="return overlib( 'Files 9<br/><br/> *Click to Open*', CAPTION, 'stories', BELOW, RIGHT, WIDTH, 150 );" onmouseout="return nd();">
								<div class="imgBorder" align="center"><a href="javascript:openchild('<?php echo $file;?>');" ><img src="../images/sample/folder.gif" alt="stories" border="0" height="32" width="32"></a></div>
							</div>
							<div class="imginfoBorder">
								<small>
									<?php echo $file;?>				</small>
								<div class="buttonOut">
									<a href="javascript:deleteFolder('<?php echo $file;?>')">
										<img src="../images/sample/edit_trash.gif" alt="Delete" border="0" height="15" width="15"></a>				</div>
							</div>
						</div>
						<?php
							}
							else
							{ 
							if( $file!="." && $file!="..")
								{
									$vfiles= $dir ."/". $file ;
									$image_info = @getimagesize( $vfiles);					
						?>
								<div style="padding: 5px; float: left;">
							<div class="imgTotal" onmouseover="return overlib( 'Filesize: 1.12 Kb<br/><br/> *Click for Url*', CAPTION, 'favicon.ico', BELOW, RIGHT, WIDTH, 200 );" onmouseout="return nd();">
								<div class="imgBorder" align="center">
								  <a href="javascript: window.open( '<?php echo $dir ."/". $file;?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=<?php echo $image_info[0]*1.5;?>,height=<?php echo $image_info[1]*1.5;?>,directories=no,location=no,left=120,top=80'); window.top.document.forms[0].imagecode.value = '<img src=<?php echo $dir ."/". $file;?> align=&quot;left&quot; hspace=&quot;6&quot; alt=&quot;Image&quot; />';" onclick="javascript:window.top.document.forms[0].imagecode.value = '<a href=&quot;http://localhost/joomla/images/favicon.ico&quot;>Insert your text here</a>';">
								  <div class="image">
								  <?php
								  $ext = strrchr($file,".");
									if(in_array($ext,$file_type))
									{
								  ?>
										<img src="<?php echo $dir ."/". $file;?>" alt="favicon.ico" border="0" <?php echo imageResize($image_info[0],$image_info[1],50);?> >
								<?php
									}
								else
									{
								?>
									<img src="<?php echo "images/icons/".str_replace(".","",strtolower ($ext)).".gif";?>" alt="favicon.ico" border="0" <?php echo imageResize($image_info[0],$image_info[1],50);?> >
								<?php
									}
								?>
										</div></a>		  		</div>
										
										
							</div>
							<div class="imginfoBorder">
								<small>
									<?php echo $file;?>				</small>
								<div class="buttonOut">
									<a href="javascript:delefile('<?php echo $file;?>');" >
										<img src="../images/sample/edit_trash.gif" alt="Delete" border="0" height="15" width="15"></a>				</div>
							</div>
						</div>
				<?php
								}
							}
						}
						closedir($dh);
					}
					}
				?>		
								</div>						  </td>
									</tr>
									</table>
								</fieldset>
							</td>
						</tr>
						<tr>
							<td>
				
							</td>
						</tr>
						<tr>
							<td>
								<div style="text-align: right;">
								</div>
							</td>
						</tr>
						</table>
						<input type="hidden" name="txtChildFolder" value=""/>
						<input type="hidden" name="txtBack" value="0" />
						</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				
<!----------------------------------------------//Note//------------------------------------------------------------->
	</h3>
	</div>
</div>
<script language="javascript">
	div = document.getElementById('lvtitlelist');
	div.innerHTML='<?php echo $vLangArr[0];?>';	
<?php
if($flagCtrl==1)
{
?>

<!--
	Back();
//-->

<?php
}
?></script>
<?php
} else {
	include("permit.php");
}
?>