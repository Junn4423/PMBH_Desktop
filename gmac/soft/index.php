<?php
// Tắt warnings và notices
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
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
if(isset($_GET['ajaxsate']))
	{	
		$vsql="update lv_lv0007 set lv098=concat(curdate(),' ',curtime()) where lv001='".$_SESSION['ERPSOFV2RUserID']."' and lv097<>''";
		$vresult=db_query($vsql);
		$vsql="select lv007,lv100 from lv_lv0007 where lv001='".$_SESSION['ERPSOFV2RUserID']."' ";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv007']==1)
			{
				$_SESSION['ERPSOFV2RUserID']=NULL;
				$_SESSION['ERPSOFV2RRight']=NULL;
			}	
			else
			{
				if($vrow['lv100']!='')
				{
					if(strpos($vrow['lv100'],'cn001')===false)
					{
						$_SESSION['ERPSOFV2RUserID']=NULL;
						$_SESSION['ERPSOFV2RRight']=NULL;
					}
				}
			}					
		}
		else
		{
				$_SESSION['ERPSOFV2RUserID']=NULL;
				$_SESSION['ERPSOFV2RRight']=NULL;
		}
		exit;
	}	
/////////////////////////////////////////////////////////	
	$_SESSION['UserFilesPath']="/lvhrv1_0/images/human/";
	$plang=strtoupper($plang);
	if($plang!="VN" || $plang=="")
		$plang="EN";
	
//Object test	
	$molv_controlmn=new lv_controlmn();		
include("../clsall/lvsoft_v1_2010.php");
$molvhrv1_0=new lvhrv1_0($plang,$_SESSION['ERPSOFV2RUserID']);
if(isset($_GET['ajaxmenu']))
	{	
			echo '[CHECKOPT]';
				echo $vmenuopt=$_GET['menuopt'];
			echo '[ENDCHECKOPT]';
			echo '[CHECKDEF]';
				echo $strall=$molvhrv1_0->getmenuchildall($_SESSION['ERPSOFV2RUserID'],(int)$vmenuopt,$plang,$giatrian,$lvspt);
			echo '[ENDCHECKDEF]';
		exit();
	}
			
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
	else if($_POST['txtflagfavorite']==3)
	{
		$molvhrv1_0->lv_deleteall($_SESSION['ERPSOFV2RUserID']);	
	}
	$lv_favorite_state=$molvhrv1_0->lv_checkfavorite($_SESSION['ERPSOFV2RUserID'],"?".$_SERVER['QUERY_STRING']);
	if($lv_favorite_state==true)
	{
		$str_favorite='<input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/>';
	}
	else
	{
		$str_favorite='<input type="hidden" name="txtfavorite" value="?'.$_SERVER['QUERY_STRING'].'"/>';
		if($_POST['txtfavorite']=="" || $_POST['txtfavorite']==NULL)
		{	if($_GET['link']!="" && $_GET['link']!=NULL)
			{
				$vName= $molvhrv1_0->lv_checkfavorite_name($_SESSION['ERPSOFV2RUserID'],base64_decode($_GET['link']),$plang);
				$molvhrv1_0->lv_updatefavorite($_SESSION['ERPSOFV2RUserID'],$vName,"?".$_SERVER['QUERY_STRING']);
			}
		}
	}
	$themes='';
	if($_POST['txtthemes']!="")
	{
		$themes=$_POST['themes'];
		GetUserThemeUpdate($_SESSION['ERPSOFV2RUserID'],$themes);
	}
	else
		$themes=getInfor($_SESSION['ERPSOFV2RUserID'],99);
	if($themes=='')	$themes='lvhrcss';
	$vallcreen=$_POST['allcreen'];	
	?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>ERP SOF</title>
<?php  $xajax->printJavascript(TREEVIEW_SOURCE."ajax/framework"); //Enables real-time update. ?>
<link href="../logo.gif" rel="icon" type="image/gif"/>	
<LINK REL="SHORTCUT ICON"  HREF="../logo.ico" >
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
var vitritab=1;
function showchinhanh()
{
	var oblog=document.getElementById('blogIframe_1');
	var chinhanh=oblog.contentWindow.document.getElementById('chinhanh');
	chinhanh.style.display="block";
}
function callscreen2()
	{
			var o=document.getElementById('sof_left');
			var tt=document.getElementById('sof_pages_content');
			//tt.style.width="100% !important";
			if(o.style.width=='')
			{
				tt.style.width=(document.body.scrollWidth-280)+"px";
			}
			else
				tt.style.width=(document.body.scrollWidth-o.style.width-30)+"px";
			//resizeIframeIndex(screen.height,document.body.scrollWidth-22);
	}
</script>
</head>
<script language="javascript">

var strnodenouse="";
var leftmenuspt=0;
</script>
<body  onkeyup="KeyPublicRun(event)">
		<div id="lvtitlelist" style="display:none"></div>
		<center>
		<div id="sof">		
			<center>
			<div id="sof_pages">			
				<div class="sof_pages_header" >
					<div class="hd_title">
						<div id="hd_title_left" class="hd_title_left" style="width:254px">
							<div style="float:left;text-align:center;width:170px;">
								<center>
								<form name="frmfavorite" action="#" method="post"> 
							<input type="hidden" name="txtfavoritename" value=""/><input type="hidden" name="txtflagfavorite" value=""/> <?php echo $str_favorite;?>
							<ul>
								<li style="float:left">
									<ul id="menu2-nav">
										<li class="menusubT2"><div style="margin-top:0px;"><div style="float:left"><img width="27" src="user.png"/></div><div style="float:left;padding-top:10px;min-width:120px"><a><strong><?php echo GetUserName(getInfor($_SESSION['ERPSOFV2RUserID'],2),$plang);?></strong></a></div></div>
										<ul id="submenu2-nav" style="top:25px;left:0px">
									<?php  echo $molvhrv1_0->getTopBar($_SESSION['ERPSOFV2RUserID'],$plang);?>
											
									<li><a onclick="oncloseall()" style="cursor:pointer"><font class=lvfuncview ><strong><?php echo GetLangTopBar(14,$plang);?></strong></font></a>
									<li>
									<strong> <a href="../logout.php"><font class=lvfuncview ><strong><?php echo GetLangTopBar(4,$plang);?></strong></font></a></strong>
									</li>
									</ul>
									</li></ul>
								</li>
							</ul>
							</form>
								<center>
							</div>
							<div style="float:left;text-align:right;padding-right:10px">
								<img src="logo.png" style="cursor:pointer;height:30px;" onclick="showchinhanh()"/>
							</div>
							<div style="float:right;text-align:right;padding-right:10px">
								<img src="min.png" style="cursor:pointer" onclick="setLeftView(this)"/>
							</div>
						</div>
						<div id="hd_menumain_left" style="float:left;padding-left:4px;padding-right:2px;padding-top:4px;padding-bottom:0px;"><div class="bg_next_prev"><img src="left.png"  style="z-index:9999;left:0px;cursor:pointer;" onclick="onmousepre()"></div></div>
						<div id="hd_title_content" style="float:left;overflow:hidden;height:35px;position:relative;">
							
							<div style="float:left">					
								<div id="hd_menumain" class="hd_menumain" style="float:left;margin-top:5px;position:absolute">
									<?php
										echo $molvhrv1_0->lv_getfavoritefull($_SESSION['ERPSOFV2RUserID'],$plang,$vArrLink);
									?>
									<input type="hidden" name="curtab" id="curtab" value="<?php echo count($vArrLink);?>"/>	
									<input type="hidden" name="fullscreen" id="fullscreen" value="0"/>	
									
								 </div>				
									
									
							</div>
							
						</div>
						
						<div id="hd_title_right" class="hd_title_right" style="width:35px">
							<div id="hd_menumain_left" style="float:right;padding:4px;padding-bottom:0px;">
								<div class="bg_next_prev"><img src="right.png" id="next_button_id" style="z-index:9999;cursor:pointer;" onclick="onmousenext()"></div>
							</div>
						</div>
					</div>
				</div>
				<?php //echo $lvmenu;?>
				<div class="sof_pages_full" id="sof_pages_full"  style="text-align:left;">
				<div style="height:39px"></div>
				<div style="">
				<?php
				//$vState=($_SESSION['ERPSOFV2RUserID']=='admin')?'block':'none';
				?>
				<div id="sof_left" style="float:left;">
					<div class="sof_left_menu" >
						<?php								
						$giatrian=""; 
						$lvspt=0;
						$strall=$molvhrv1_0->getmenuchildall($_SESSION['ERPSOFV2RUserID'],(int)$_GET['opt'],$plang,$giatrian,$lvspt);
						echo str_replace("<!--".$_GET['opt']."-->",$strall,$lvmenu);
						?>
							<script language="javascript">
								strnodenouse="<?php echo $giatrian;?>";
								leftmenuspt=<?php echo $lvspt;?>;
							</script>
						<input type="hidden" name="idleft_cur" id="idleft_cur" value="<?php echo $molvhrv1_0->curmenu_stt;?>"/>
					</div>
					<div class="sof_left_themes">
						<div class="sof_left_themes_title">
						<?php if($plang=='VN') 
								echo 'Chọn mẫu' ;
							else 
								echo 'Option themes';
								?>
						</div>
						<div class="sof_left_themes_content" style="clear:both;overflow:hidden">
							<form name="frmthemes" action="" method="post">
							<input type="hidden" name="txtthemes" value="1"/>
							<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
							<ul style="clear:both">
							<?php
							$vsql="select lv001,".(($plang=='VN')?'lv002':'lv003')." lv002 from lv_lv0011";
							$vresult=db_query($vsql);
							while($vrow=db_fetch_array($vresult))
							{
							?>
								<li>
								<div style="clear:both"><div style="float:left"><input onchange="document.frmthemes.submit()" type="radio" name="themes" value="<?php echo $vrow['lv001'];?>" <?php echo ($vrow['lv001']==$themes)?"checked":"";?>/></div><div style="float:left;padding-top:7px;padding-left:5px"><?php echo $vrow['lv002'];?></div></div>
								</li>
							<?php
							}
							?>
							</ul>
							</form>
						</div>
						
					</div>
				</div>
				
				<div id="sof_pages_content" class="sof_pages_content" style="position:relative;float:left">
					<div style="clear:both"><div id="lv_right_titlelist" style="text-align:right;width:50px;float:right"></div></div>
					<div id="showparenttext"></div>
					<div id="showparent">
			 <?php 
				$i=1;
				if(count($vArrLink)==1 && $popt!='' && $plink!='')
				{
							$vLink[0]='?'.$_SERVER['QUERY_STRING'];
							echo '<div id="lvtab_'.$i.'" style="display:none;width:100%;height:100%">';
								$strView=$strView.'if('.$i.'==i){ if(o.innerHTML==\'\')  {o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}else return;}';
								$strViewLoad=$strViewLoad.'if('.$i.'==i){  o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}';
								//controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
							echo '</div>';
				}
				else
				{
					foreach($vArrLink as $vLink)
					{
						$molvhrv1_0->FillSession($vLink[0]);
						include("paras.php");
						if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")>0 || 1==1 )
						{
							if(strpos($molvhrv1_0->getoptionrun,"@".$popt."@")===false)
							{
								echo $vLink[1]='?'.$_SERVER['QUERY_STRING'];
							}
							if($vLink[1]==true)
							{
								echo '<div id="lvtab_'.$i.'" style="display:block;width:100%;height:100%">';
								$vstrSetDefault="setviewtab($i)";
							}
							else
								echo '<div id="lvtab_'.$i.'" style="display:none;width:100%;height:100%">';
								$strView=$strView.'if('.$i.'==i){ if(o.innerHTML==\'\')  {o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}else return;}';
								$strViewLoad=$strViewLoad.'if('.$i.'==i){  o.innerHTML=\'<iframe id="blogIframe_'.$i.'" onload="this.focus()" width="100%" height="100%" marginheight=0 marginwidth=0 frameborder=0 src="home.php'.$vLink[0].'" class=lvframe></iframe>\';}';
								//controlmain($popt,$pitem,$plink,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
							echo '</div>';
						}
						else
							include("permit.php");
						$i++;
					}
				}
				
			?>
				</div>
					<div id="lvright"></div>
					</div>
				</div>
				</div>
				<div class="sof_pages_footer" style="height:30px!important;"  >
					<div class="sof_pages_footer_left">
						<img src="../images/logo/logo.png" height="30"/>
					</div>
					<div class="sof_pages_footer_right">
						<div style="float:right;padding-right:10px">
							<?php
							if($_SESSION['ERPSOFV2RUserID']!='employees') echo '<div style="float:left"><a href="http://www.sof.vn" target="_blank"><font color="#45a76b">Powered by</font><br/> <font color="red"> www.sof.vn</font> </a></div>';?>
							<a href="#" class="scrollup"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<center>
</div>		
		</center>
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

<style>
	#sof
	{
		width:100% !important;
	}
	#sof_pages
	{
			width:100% !important;
			padding:0px;
			margin:0px;
	}
	
</style>

</body>
<script language="javascript">
setTimeout("callscreen2()",500);
function setConfirmView()
{
	var fullheight=0;
	var isfull=document.getElementById('fullscreen').value;
	if(isfull=='1') fullheight=0;
	var o=document.getElementById('sof_left');
	var tt=document.getElementById('sof_pages_content');	
	var ttpr=document.getElementById('showparent');
	if(o.style.display=="none" || (o.style.display=="" && document.body.scrollWidth<1000))
	{
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=tt.style.height;
		tt.style.width=(document.body.scrollWidth-o.style.width-30)+"px";
		resizeIframeIndex(window.innerHeight-80-fullheight,document.body.scrollWidth);
	}
	else
	{
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.width=(window.innerHeight-274-fullheight)+"px !important";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=tt.style.height;
		resizeIframeIndex(window.innerHeight-80-fullheight,document.body.scrollWidth-274);
	}
	return;
}
function setLeftView(t)
{
	var fullheight=0;
	var isfull=document.getElementById('fullscreen').value;
	if(isfull=='1') fullheight=0;
	var o=document.getElementById('sof_left');
	var tt=document.getElementById('sof_pages_content');
	var ttpr=document.getElementById('showparent');		
	if(o.style.display=="none" || (o.style.display=="" && document.body.scrollWidth<1000))
	{
		var w=document.body.scrollWidth;
		tt.style.width=(w-274)+"px";
		ttpr.style.width=(w-274)+"px";;
		o.style.display="block";
		t.src="min.png";
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=tt.style.height;
		resizeIframeIndex(window.innerHeight-80-fullheight,w-274);
	}
	else
	{
		o.style.display="none";
		t.src="max.png";
		o.style.height=(window.innerHeight-90-fullheight)+"px";
		tt.style.height=(window.innerHeight-70-fullheight)+"px";
		ttpr.style.height=tt.style.height;
		tt.style.width=(document.body.scrollWidth)+"px";
		resizeIframeIndex(window.innerHeight-80-fullheight,document.body.scrollWidth);
	}
}
function AddFavorite()
{
	var o=document.frmfavorite;
	sum=<?php echo count($vArrLink);?>;
	o.txtflagfavorite.value="1";
	o.txtfavoritename.value=document.getElementById('lvtabli_'+sum).title;
	o.submit();	
}
function RemoveFavorite()
{
	var o=document.frmfavorite;
	sum=<?php echo count($vArrLink);?>;
	o.txtfavoritename.value=document.getElementById('lvtabli_'+sum).title;
	o.txtflagfavorite.value="2";
	o.submit();	
}
function RemoveFavoriteTab(vLink)
{
	var o=document.frmfavorite;
	sum=<?php echo count($vArrLink);?>;
	o.txtfavorite.value=vLink;
	o.txtflagfavorite.value="2";
	o.submit();	
}
function setviewtabload(i)
{
	curtab(i)
	sum=<?php echo count($vArrLink);?>;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('lvtab_'+j);
		if(i==j)
		{
			o.style.display="block";
			//alert(window.innerHeight+'-'+window.innerHeight);
			vitritab=i;
			//o.style.height=(window.innerHeight-80)+"px";
			<?php echo $strViewLoad;?>
			//resizeIframeIndex(document.body.scrollHeight,document.body.scrollWidth-20);
			setConfirmView();
		}
		else
			o.style.display="none";
	}
}
function setviewtab(i)
{
	curtab(i)
	sum=<?php echo count($vArrLink);?>;
	
	for(jt=i+1;jt<=sum;jt++)
	{
		var o=document.getElementById('lvtab_'+jt);
		o.style.display="none";
	}
	for(jt=i-1;jt>=1;jt--)
	{	
		var o=document.getElementById('lvtab_'+jt);
		o.style.display="none";
	}
	if(i!=0)
	{
		var o=document.getElementById('lvtab_'+i);
		o.style.display="block";
		vitritab=i;
		<?php echo $strView;?>
		setConfirmView();
	}
		
	
}
function curtab(i)
{
	sum=<?php echo count($vArrLink);?>;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('lvtabli_'+j);
		if(i==j)
		{
			
			o.className="lifullmenucur";
			var to=document.getElementById('curtab');
			to.value=i;
		
		}
		else
			o.className="lifullmenu";
	}
}
function oncloseall()
{
	var o=document.frmfavorite;
	o.action="?lang=<?php echo $plang;?>";
	o.txtflagfavorite.value="3";
	o.submit();	
}
function onmousenext()
{
	var hd_menumain=document.getElementById('hd_menumain');
	if(hd_menumain.style.left=="") hd_menumain.style.left=0;
	var vint=parseInt(hd_menumain.style.left)-170;
	var vw=parseInt(hd_menumain.style.width);
	if(-vint-170>vw) vint=-vw;
	hd_menumain.style.left=vint+"px";
}
function onmousepre()
{
	var hd_menumain=document.getElementById('hd_menumain');
	if(hd_menumain.style.left=="") hd_menumain.style.left=0;
	var vint=parseInt(hd_menumain.style.left)+170;
	if(vint>0) vint=0;
	hd_menumain.style.left=vint+"px";
}
function startscreen()
{
	var fullheight=0;
	var isfull=document.getElementById('fullscreen').value;
	if(isfull=='1') fullheight=0;
	var to=document.getElementById('sof_pages_full');
	to.style.height=(window.innerHeight-30-fullheight)+'px';
	var hd_left=document.getElementById('hd_title_left');
	var hd_right=document.getElementById('hd_title_right');
	var wleft=parseInt(hd_left.style.width);
	var wright=parseInt(hd_right.style.width);
	var hscre=window.innerWidth;
	var hd_content=document.getElementById('hd_title_content');
	var bnt_right=document.getElementById('next_button_id');
	hd_content.style.width=(hscre-(wleft+wright)-55)+"px";
	bnt_right.style.left=(hscre-(wleft+wright)-70)+"px";
	var hd_menumain=document.getElementById('hd_menumain');
	hd_menumain.style.width=(170)*<?php echo (count($vArrLink)>0)?count($vArrLink):1;?>+"px";	
}
function resizeIframeIndex(newHeight,newWidth)
{	
	var to=document.getElementById('curtab');
    document.getElementById('blogIframe_'+to.value).style.height = (parseInt(newHeight,10)+10) + 'px';
	document.getElementById('blogIframe_'+to.value).style.width = parseInt(newWidth,10) + 'px';
}	
<?php echo ($vstrSetDefault=="")?"setviewtab(1)":$vstrSetDefault;?>
</script>
<script language="javascript">
function closeall()
{
	for(var i=1;i<120;i++)
	{
		var vot=document.getElementById('ul_menu_'+i);
		if(vot==null)
		{
		}
		else
		{
			vot.style.display="none";
		}
	}
}
function openoptionhere(value)
		{
			var str=document.getElementById('sof_left').innerHTML;
			var n=str.indexOf('<!--'+value+'-->');
			closeall();
			if(n<=0)
			{
				
				var vot=document.getElementById('ul_menu_'+value);
				/*if(vot.style.display=="block") 
					vot.style.display="none";
				else*/
					vot.style.display="block";
			}
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)	
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"&ajaxmenu=program"+"&menuopt="+value+"&lang=<?php echo $plang;?>";
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedLoadMenu;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}
function stateChangedLoadMenu()
{
	if (xmlhttp1.readyState==4)
		{		
			var startdomain1=xmlhttp1.responseText.indexOf('[CHECKDEF]')+10;
			var enddomain1=xmlhttp1.responseText.indexOf('[ENDCHECKDEF]');
			var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
			var startdomain2=xmlhttp1.responseText.indexOf('[CHECKOPT]')+10;
			var enddomain2=xmlhttp1.responseText.indexOf('[ENDCHECKOPT]');
			var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
			var str=document.getElementById('sof_left').innerHTML;
			document.getElementById('sof_left').innerHTML=str.replace('<!--'+domainid2+'-->',domainid1);
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
setTimeout("Load_CheckSate()",1000);
function Load_CheckSate()
{
			$xmlhttp11=null;
			xmlhttp11=GetXmlHttpObject();
			if (xmlhttp11==null)	
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"&ajaxsate=ok";
			url=url.replace("#","");
			xmlhttp11.onreadystatechange=stateChangedStates;
			xmlhttp11.open("GET",url,true);
			xmlhttp11.send(null);
}
function stateChangedStates()
{
	if (xmlhttp11.readyState==4)
		{	
		setTimeout("Load_CheckSate()",58000);
	}
}
startscreen();
</script>
</html>
<?php
}?>
<?php ob_end_flush();?>