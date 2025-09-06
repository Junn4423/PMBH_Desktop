<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/ml_lv0001.php");
$vDefaultPath="../../../images/logo/";
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ml_lv0001.php");
require_once("../../clsall/ml_lv0010.php");
require_once("../../clsall/ml_lv0009.php");
require_once("../../clsall/ml_lv0008.php");
require_once("../../clsall/ml_lv0007.php");
require_once("../../clsall/ml_lv0006.php");
require_once("../../clsall/ml_lv0100.php");
require_once("../../clsall/class.phpmailer.php");
//////////////init object////////////////
$lvml_lv0001=new ml_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0001');
$lvml_lv0010=new ml_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0010');
$lvml_lv0009=new ml_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0009');
$lvml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
$lvml_lv0007=new ml_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0007');
$lvml_lv0006=new ml_lv0006($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0006');

/////////Get ID///////////////
//$lvml_lv0001->lv001=(float)($_GET['ID']);
$lvml_lv0009->LV_LoadSMTP();
$lvml_lv0001->Domain=$lvml_lv0009->lv010;
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0021.txt",$plang);

$vFlag=(int)$_POST['txtFlag'];

$strSendAlert="";
$lvml_lv0001->lv003=$_SESSION['ERPSOFV2RUserID'];
$lvml_lv0001->lv004=$_POST['txtmail_lv004'];
$lvml_lv0001->lv005=$_POST['txtmail_lv005'];
$lvml_lv0001->lv006=$_POST['txtmail_lv006'];
$lvml_lv0001->lv007=$_POST['txtmail_lv007'];
$lvml_lv0001->lv008=$_POST['txtmail_lv008'];
$lvml_lv0001->lv016=$_POST['txtmail_lv016'];
$lvml_lv0001->lv009=$_POST['txtmail_lv009'];
$lvml_lv0001->lv010=$_POST['txtmail_lv010'];
$lvml_lv0001->lv011=$_POST['txtmail_lv011'];
$lvml_lv0001->lv012=$_POST['txtmail_lv012'];
$lvml_lv0001->lv013=$_POST['txtmail_lv013'];
if($vFlag==1)
{
		$lvml_lv0001->lv004=GetServerDate();
		$lvml_lv0001->lv014=GetServerTime();
		$lvml_lv0001->lv002=2;
		$lvml_lv0001->lv011=1;
		$lvml_lv0001->lv012=0;
		$lvml_lv0008->LV_LoadUser($lvml_lv0001->lv003,$lvml_lv0001->lv006);
		$lvml_lv0007->LV_LoadUser($lvml_lv0001->lv003,$lvml_lv0001->lv006);
		if(strpos($lvml_lv0001->lv009,$lvml_lv0007->lv004)===false)
			 $lvml_lv0001->lv009=$lvml_lv0001->lv009.$lvml_lv0007->lv004;
		if($lvml_lv0008->lv006==1)
		{
			$vstrTo=SplitTo(str_replace(";",",",str_replace(" ","",$lvml_lv0001->lv007)),"<",">",",");
			$vstrToSend=$lvml_lv0001->SplitToEsc($vstrTo,",",0);
			$vstrCC=SplitTo(str_replace(";",",",str_replace(" ","",$lvml_lv0001->lv008)),"<",">",",");
			$vstrCCSend=$lvml_lv0001->SplitToEsc($vstrCC,",",0);
			$vstrBCC=SplitTo(str_replace(";",",",str_replace(" ","",$lvml_lv0001->lv016)),"<",">",",");
			$vstrBCCSend=$lvml_lv0001->SplitToEsc($vstrBCC,",",0);
			$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');
			$lvml_lv0100->To(explode(",",$vstrToSend));
			$vResult=$lvml_lv0010->LV_LoadUserArray($_SESSION['ERPSOFV2RUserID']);
			while($vrow = db_fetch_array ($vResult))
			{
				if($lvml_lv0008->lv005==1)
				{
				$lvml_lv0100->Attach("../../images/human/File/MailTemp/".$vrow['lv002']."_".$vrow['lv001']."/".$vrow['lv005'],str_replace(" ","_",trim($vrow['lv005'])),'','attachment');
				}
				$lvml_lv0001->AttachFile($lvml_lv0001->SaveAndGetFile("../../images/human/File/MailTemp/".$vrow['lv002']."_".$vrow['lv001']."/".$vrow['lv005'],"../../SendFile/",$lvml_lv0001->lv003,str_replace(" ","_",trim($vrow['lv005'])),str_replace(" ","_",trim($vrow['lv005']))),$vrow['lv005']);
			}
			if($lvml_lv0008->lv008==1)
				{
					$lvml_lv0001->lv018=1;
					$lvml_lv0001->lv019=$lvml_lv0008->lv009;
				}
			if($lvml_lv0001->lv001==0)
			{
			
				$lvml_lv0001->lv001=InsertWithCheck('ml_lv0001', 'lv001', '',0);
				$vresult=$lvml_lv0001->LV_Insert();
			}
			else
			$vresult=$lvml_lv0001->LV_Update();
			if($vresult==true) {
				if($lvml_lv0008->lv008==0)
				{
						if($lvml_lv0008->lv005==1)
						{
							if(trim($vstrToSend)!="" || trim($vstrCCSend)!="" || trim($vstrBCCSend)!="")				{
								$lvml_lv0100->lvml_lv0009=$lvml_lv0009;
								$lvml_lv0100->lvml_lv0008=$lvml_lv0008;
								$lvml_lv0100->To(explode(",",$vstrToSend));
								$lvml_lv0100->From($lvml_lv0001->lv006);
								$lvml_lv0100->Subject($lvml_lv0001->lv005);
								$lvml_lv0100->Priority(3);	
								$lvml_lv0100->Content_type("multipart/related");
								$lvml_lv0100->charset="utf-8";
								$lvml_lv0100->ctencoding="quoted-printable";
								$lvml_lv0100->Cc(explode(",",$vstrCCSend));
								$lvml_lv0100->Bcc(explode(",",$vstrBCCSend));
								$lvml_lv0100->Body($lvml_lv0001->lv009,'');
								if($lvml_lv0100->Send())
								{
									$lvml_lv0006->LV_SaveEmail($vstrToSend,$vstrCCSend,$vstrBCCSend,$_SESSION['ERPSOFV2RUserID']);
									$lvml_lv0001->SendLocal($lvml_lv0001->SplitToEsc($lvml_lv0001->lv007,",",1),$lvml_lv0001->SplitToEsc($lvml_lv0001->lv008,",",1),$lvml_lv0001->SplitToEsc($lvml_lv0001->lv016,",",1),1,1,0);
									$lvml_lv0001->LV_UpdateDel();
									$strSendAlert="<font color=\"#3333FF\" size=\"+4\">(SUCCESSFULL!)</font>";
								}
								else
								$strSendAlert="<font color=\"#3333FF\" size=\"+4\">(SUCCESSFULL!)</font>";
								$lvml_lv0010->LV_DeleteUser($_SESSION['ERPSOFV2RUserID']);
							}
							else
							{
								$lvml_lv0001->SendLocal($lvml_lv0001->SplitToEsc($lvml_lv0001->lv007,",",1),$lvml_lv0001->SplitToEsc($lvml_lv0001->lv008,",",1),$lvml_lv0001->SplitToEsc($lvml_lv0001->lv016,",",1),1,1,0);
								$lvml_lv0001->LV_UpdateDel();
								$strSendAlert="<font color=\"#3333FF\" size=\"+4\">(SUCCESSFULL!)</font>";
								$lvml_lv0010->LV_DeleteUser($_SESSION['ERPSOFV2RUserID']);
							}
						}
						else
						{
						$lvml_lv0001->SendLocal($lvml_lv0001->SplitToEsc($lvml_lv0001->lv007,",",1),$lvml_lv0001->SplitToEsc($lvml_lv0001->lv008,",",1),$lvml_lv0001->SplitToEsc($lvml_lv0001->lv016,",",1),1,1,0);
						$lvml_lv0001->LV_UpdateDel();
						$lvml_lv0010->LV_DeleteUser($_SESSION['ERPSOFV2RUserID']);
						}
						
						$strSendAlert="<font color=\"#000099\" size=\"+4\">".$vLangArr[9]."</font>";
						$vFlag=1;
					}
					else
					{
						$lvml_lv0001->LV_UpdateDel();
						$lvml_lv0010->LV_DeleteUser($_SESSION['ERPSOFV2RUserID']);
						$strSendAlert="<font color=\"#000099\" size=\"+4\">".$vLangArr[9]."</font>";
						$vFlag=1;
					}
			} else{
				$strSendAlert="<font color=\"#FF0000\" size=\"+4\">".$vLangArr[10].sof_error()."</font>";
				$vFlag=2;
			}
		}

}
if($vFlag==0)
{
$lvml_lv0001->lv002=$_SESSION['ERPSOFV2RUserID'];
if($lvml_lv0001->lv001!=0) $lvml_lv0001->LV_LoadID($lvml_lv0001->lv001);

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
function FunctRunning1(vID,count)
{
RunFunction(vID,'childmore');

}
function RunFunction(vID,func)
{
	
	var str="<br><iframe id='lvframefrm' height=500 marginheight=0 marginwidth=0 frameborder=0 src=../ml_lv0001/?func="+func+"&funcparent=<?php echo $_GET['func'];?>&ID="+vID+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst)?> class=lvframe></iframe>";
	div = document.getElementById('lvright');
	div.innerHTML=str;
	div.style.height="500px";
	scrollToBottom();
}
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
		var o=document.frm_mail;
		o.txtmail_lv005.value="";
		o.txtmail_lv006.value="";		
		o.txtmail_lv007.value="";		
		o.txtmail_lv008.value="";		
		o.txtmail_lv009.value="";	
		o.txtmail_lv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
		function Send()
	{
		var o=document.frm_mail;
		if(o.txtmail_lv006.value=="")
		{
			alert("<?php echo $vLangArr[29];?>");
			o.txtmail_lv006.focus();
		}
		else if(o.txtmail_lv007.value==""){
			alert("<?php echo $vLangArr[30];?>");
			o.txtmail_lv007.focus();
			}	
		else
		{
		 if(o.txtmail_lv005.value==""){
		 	if(confirm("<?php echo $vLangArr[31];?>"))
			{
			o.txtFlag.value="1";
			o.submit();
			}
			o.txtmail_lv006.focus();
			}	
		else
			{
			o.txtFlag.value="1";
			o.submit();
			}
		}
			
	}
	function Atachfile()
	{
		var o=document.frm_mail;
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>&ChildID=<?php echo $_GET['ChildID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,3,0);?>";
		o.submit();
		
	}
</script>
<body   onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h3>
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frm_mail" id="frm_mail" action="#" method="post" enctype="multipart/form-data" autocomplete="off">
					  <table width="100%" border="0" align="left" id="table1">							  
							

							<tr class="lvlinehtable0">
							  <td width="166"  height="20"><?php echo $vLangArr[20];?>
						      <input name="hidden" type="hidden" style="width:90%" value="<?php echo $lvml_lv0001->lv001;?>"/></td>
							  <td width="535"  height="20"><select name="txtmail_lv006" id="txtmail_lv006"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvml_lv0001->LV_LinkField('lv030',$lvml_lv0001->lv006);?>
							  </select>	</td>
						    </tr>		
							<tr class="lvlinehtable1">
							  <td  height="20"><?php echo $vLangArr[21];?></td>
							  <td  height="20"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
							  <ul style="margin: 0;padding: 0;list-style: none;" id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT"><input name="txtmail_lv007" id="txtmail_lv007" type="text" style="width:400px" value='<?php echo $lvml_lv0001->lv007;?>' tabindex="13" onKeyUp="LoadSelfNext(this,'txtmail_lv007','ml_lv0006','lv003','lv004')" onFocus="LoadSelfNext(this,'txtmail_lv007','ml_lv0006','lv003','lv004')" /><div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>							
							<tr class="lvlinehtable0">
							  <td  height="20"><?php echo 'Cc';?></td>
							  <td  height="20"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,1)" style="margin: 0;padding: 0;list-style: none;"> <li class="menupopT" ><input name="txtmail_lv008" id="txtmail_lv008" type="text" style="width:400px" value='<?php echo $lvml_lv0001->lv008;?>' tabindex="14" onKeyUp="LoadSelfNext(this,'txtmail_lv008','ml_lv0006','lv003','lv004')" onFocus="LoadSelfNext(this,'txtmail_lv008','ml_lv0006','lv003','lv004')" /><div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
						    <tr class="lvlinehtable1">
							  <td  height="20"><?php echo 'Bcc';?></td>
							  <td  height="20"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,1)" style="margin: 0;padding: 0;list-style: none;"> <li class="menupopT" ><input name="txtmail_lv016" id="txtmail_lv016" type="text" style="width:400px" value='<?php echo $lvml_lv0001->lv016;?>' tabindex="14" onKeyUp="LoadSelfNext(this,'txtmail_lv016','ml_lv0006','lv003','lv004')" onFocus="LoadSelfNext(this,'txtmail_lv016','ml_lv0006','lv003','lv004')" /><div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr class="lvlinehtable0">
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtmail_lv005" id="txtmail_lv005" type="text" style="width:90%" value='<?php echo $lvml_lv0001->lv005;?>' tabindex="15"/></td>
						    </tr>
							<tr class="lvlinehtable1">
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20">&nbsp;</td>
						    </tr>	
							<tr class="lvlinehtable0">
							  <td  height="20" colspan="2"><textarea name="txtmail_lv009" id="txtmail_lv009" rows="15" style="width:100%" tabindex="16"><?php echo $lvml_lv0001->lv009;?></textarea></td>
					    </tr>
							<tr class="lvlinehtable1">
							  <td  height="20"><a href="javascript:FunctRunning1('',0)" target="_self"><?php echo $vLangArr[24];?></a></td>
							  <td  height="20"><?php echo $lvml_lv0010->LV_LoadUserID($_SESSION['ERPSOFV2RUserID']);?></td>
					    </tr>
					    <tr>
								  <td  height="20" colspan="2">
								  	<div id="lvright" style="width:100%"></div>	</td>
						    </tr>
							<tr>
							  <td  height="20" colspan="2"><input name="txtFlag" type="hidden" id="txtFlag" /><input name="txtFlagFw" type="hidden" id="txtFlagFw"  value="<?php echo $_POST['txtFlagFw'];?>"/><input type="hidden" name="txtmail_lv010" id="txtmail_lv010" value='<?php echo $lvml_lv0001->lv010;?>'/>
						<input type="hidden" name="txtmail_lv013" id="txtmail_lv013" value='<?php echo $lvml_lv0001->lv013;?>'/></td>
						  </tr>
					<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Send();" tabindex="16"><img src="../images/controlright/send.gif" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE></td>
						  </tr>
					  </table>
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<script language="javascript">
	var o=document.frm_mail;
		o.txtmail_lv002.select();
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
<?php
}
else
{
echo $strSendAlert;
?>
<?php
}
?>