<?php
ob_start();
//Define where you have placed the phptreeview folder.
$vArrLink=Array();
define("TREEVIEW_SOURCE", "../");	 
include(TREEVIEW_SOURCE."clsall/treeviewclasses.php"); //Include the phptreeview engine.
session_start();
//Cáº¥u hÃ¬nh 
	include("config.php");
	include("configrun.php");
	include("function.php");
	include("paras.php");
	include("excfile.php");
	include("librarianconfig.php");	
	include("../clsall/lv_controlmn.php");
	if($_SESSION['ERPSOFV2RUserID']=="" || $_SESSION['ERPSOFV2RUserID']==NULL)  redirect('../index.php');	
	else
	{
/////////////////////////////////////////////////////////	
	$_SESSION['UserFilesPath']="/lvhrv1_0/images/human/";
	$plang=strtoupper($plang);
	if($plang!="VN" || $plang=="")
		$plang="EN";
	
//Object test	
	$molv_controlmn=new lv_controlmn();		
include("../clsall/lvsoft_v1_2010.php");
$molvhrv1_0=new lvhrv1_0($plang,$_SESSION['ERPSOFV2RUserID']);
//////////////////////////////////////////////////////
//Init object
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
	$xajax = new xajax();
	include(TREEVIEW_SOURCE."ajax/ajax.php");	//Enables real-time update. Must be called before any headers or HTML output have been sent.
	$xajax->processRequests();
	
	//Define identify name(s) to your treeview(s); Add more comma separated names to create more than one treeview. The treeview names must always be unique. You canÂ´t even use the same treeview names on different php sites. 
	$treeviewid = array("treeviewcheckbox");
	
	include(TREEVIEW_SOURCE."clsall/treeviewcreate.php"); //Creates phptreeview objects.	

	$lvmenu=$molvhrv1_0->createframeall($_SESSION['ERPSOFV2RUserID'],(int)$_GET['opt'],$plang);
	if($_POST['txtflagfavorite']==1 )
	{
			$molvhrv1_0->lv_updatefavorite($_SESSION['ERPSOFV2RUserID'],$_POST['txtfavoritename'],$_POST['txtfavorite']);
	
	}	
	else if($_POST['txtflagfavorite']==2)
	{
		$molvhrv1_0->lv_deletefavorite($_SESSION['ERPSOFV2RUserID'],$_POST['txtfavorite']);	
	}
	$lv_favorite_state=$molvhrv1_0->lv_checkfavorite($_SESSION['ERPSOFV2RUserID'],"?".$_SERVER['QUERY_STRING']);
	if($lv_favorite_state==true)
	{
		$str_favorite='<input type="hidden" name="txtfavoritename" value=""/><input type="hidden" name="txtflagfavorite" value="2"/> <input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/><a href="javascript:RemoveFavorite()">'.GetLangTopBar(10,$lang).'</a>';
	}
	else
	{
		$str_favorite='<input type="hidden" name="txtfavoritename" value=""/><input type="hidden" name="txtflagfavorite" value="1"/> <input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/><a href="javascript:AddFavorite()">'.GetLangTopBar(9,$lang).'</a>';
	}
	$themes='';
	if($_POST['txtthemes']!="")
	{
		$themes=$_POST['themes'];
		GetUserThemeUpdate($_SESSION['ERPSOFV2RUserID'],$themes);
	}
	else
		$themes=getInfor($_SESSION['ERPSOFV2RUserID'],99);
	if($themes=='')	$themes='themes1';	
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>ERP SOF</title>
<?php  $xajax->printJavascript(TREEVIEW_SOURCE."ajax/framework"); //Enables real-time update. ?>
<link href="../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../logo.ico" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="../css/<?php echo $themes;?>.css" type="text/css">
<link rel="StyleSheet" href="../css/menu.css" type="text/css">	
<link rel="stylesheet" href="../css/helppopup.css" type="text/css">
<link rel="stylesheet" href="../css/responsive.css" type="text/css">
<style type="text/css">
.topbarview
{
 color:#FFFFFF;
 font-family:Arial, Helvetica, sans-serif;
 font-weight:bold;
 font-size:11px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" src="../javascript/screen.js"></script>
<script language="javascript" src="../javascript/pubscript.js"></script>
<script language="javascript" src="../javascript/engine.js"></script>
<script language="javascript" src="../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../javascript/menuvertical.js"></script>
<script language="javascript" src="../javascript/jquery.js"></script>
<script language="javascript">
function callscreen2()
	{
		/*var heightscreen=document.body.scrollHeight ;
		vsof_pages=document.getElementById('sof_pages');
		vsof_left=document.getElementById('sof_left');
		vsof_pages.style.height=heightscreen+"px";
		vsof_left.style.minHeight=vsof_pages.style.height;*/
		vsof_menu=document.getElementById('submenu-nav');
		if(screen.height-300<0) 
			vsof_menu.style.height=(screen.height-250)+"px";
		else
			vsof_menu.style.height=(screen.height-250)+"px";
		vsof_func=document.getElementById('func_id');
		var lefts=parent.document.getElementById('sof_left');
	/*	if(lefts.style.display=="none")
		{
			vsof_func.style.width=(parent.document.body.scrollWidth-0)+"px";
		}
		else
			vsof_func.style.width=(parent.document.body.scrollWidth-294)+"px";
	*/	
	}
</script>
</head>
<script language="javascript">
function AddFavorite()
{
	var o=document.frmfavorite;
	o.txtfavoritename.value=document.getElementById('lvtitlelist').innerHTML;
	o.submit();	
}
function RemoveFavorite()
{
	var o=document.frmfavorite;
	o.txtfavoritename.value=document.getElementById('lvtitlelist').innerHTML;
	o.submit();	
}
var strnodenouse="";
var leftmenuspt=0;
function closepopchinhanh()
{
	var chinhanh=document.getElementById('chinhanh');
	chinhanh.style.display='none';
	
}
function openpopchinhanh()
{
	var chinhanh=document.getElementById('chinhanh');
	chinhanh.style.display='block';
	
}
</script>
<body  onkeyup="KeyPublicRun(event)" onload="">
<div name="chinhanh" id="chinhanh" style="display: none;opacity: 0.9; position: absolute; top: 20px; z-index: 2147483647;width:100%;height:100%;background:#ffff;">
									<?php  echo $molvhrv1_0->LV_GetLinkCN();?>
						</div>
					<div style="clear:both"><div id="lv_right_titlelist" style="text-align:right;width:50px;float:right"></div></div>
					<div id="showparenttext"></div>
					<div id="showparent" style="text-align:left" >
			 <?php 
				$molvhrv1_0->FillSessionEmpty();
				include("paras.php");
				if($plink=="" ) $plink=$molvhrv1_0->getfirstlink;
				controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
					/*if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")>0 || (($_GET['opt']==''|| $_GET['opt']==null || $_GET['opt']==4)))
						controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
					else
						include("permit.php");*/
			?>
				</div>
				<div id="lvright"></div>
				</div>
<script type="text/javascript">
    $(document).ready(function(){ 
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        }); 
		
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
 
    });
</script>
	
<script language="javascript" src="../javascript/menuhelppopup.js"></script>
<!-- End ImageReady Slices -->
</body>
<script language="javascript">
setTimeout("callscreen2()",500);
function setZoom(i)
{
	var o=document.frmthemes;
	o.allcreen.value=((i==0)?"1":"0");
	o.submit();
}
//parent.resizeIframeIndex(document.body.scrollHeight-100,document.body.scrollWidth);
</script>
</html>
<?php
}?>
<?php ob_end_flush();?>