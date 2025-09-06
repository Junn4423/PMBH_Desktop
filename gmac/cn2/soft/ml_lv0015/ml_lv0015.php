<?php
include("paras.php");
require_once("../clsall/lv_controler.php");
require_once("../clsall/ml_lv0015.php");
require_once("../clsall/ml_lv0013.php");
require_once("../clsall/ml_lv0009.php");
require_once("../clsall/ml_lv0008.php");
require_once("../clsall/ml_lv0007.php");
require_once ("../clsall/ml_lv0100.php");
require_once("../clsall/class.phpmailer.php");
/////////////init object//////////////
$moml_lv0015=new  ml_lv0015($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0015');
/////////////init object//////////////

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../","ML0029.txt",$plang);

//////////////////////////////////////////////////////
//////Delete message///
$lvMessage=array();
$lvMessage[0]=$vLangArr[14];
$lvMessage[1]=$vLangArr[15];
$vNow=GetServerDate();
$moml_lv0015->lv001=20;
$moml_lv0015->lv002=120;
$moml_lv0015->lv003="TEM002";
//$ma=$_GET['ma'];
$strchk=$_POST["txtStringID"];
$flagID=(int)$_POST["txtFlag"];
$vFieldList=$_POST['txtFieldList'];$vOrderList=$_POST['txtOrderList'];
if(!isset($_POST['txtlv005'])) $moml_lv0015->lv005='

------------------ 
CTy TNHH SOF 
website: www.sof.vn 
Tel:(848) 36.020.139 Fax: (848) 38.498.379 

Name: Lê Quang Vinh
Sale Manager
Mobi: 0933 549 469
Mail: vinhlq@sof.vn - sales@sof.vn 
';

$vStrMessage="";
if($flagID==1)
{
//	$tsql="select count(*) from department where CompanyID ";
	$strar=substr($strchk,0,strlen($strchk)-1);
	$strar=str_replace("@","','",$strar);
	$strar="'".$strar."'";
	$vStrMessage=GetNoDelete($strar,"",$lvMessage);
}
elseif($flagID==2)
{

}
//first is load
if($_POST["txtFlag"]=="")
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
}
else//last is RunAuto
{
$curPage = (int)$_POST['curPg'];
$maxRows =(int)$_POST['lvmaxrow'];
$vSortNum=(int)$_POST['lvsort'];
}
if($maxRows ==0) $maxRows = 10;

$maxPages = 10;
if($curPage=="") 
$curPage = 1;
$curRow = ($curPage-1)*$maxRows;
$paging = divepage($plang, $curPage, $totalRowsC, $maxRows, $maxPages, $curRow,'document.frmRunAuto','document.frmRunAuto.curPg',2);
?>
<?php
if($moml_lv0015->GetView()==1)
{
	
	if(isset($_GET['ajax']))
	{
		$moml_lv0013=new  ml_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'ML0013');
		global $wpdb;
		echo "[CHECK]";
		$numrun= $_GET['numrun'];
		$temid=$_GET['temid'];
		$emailsend=$_GET['emailsend'];
		$moml_lv0013->LV_LoadID($temid);
		$moml_lv0015->LV_Aproval($moml_lv0013->lv003,$moml_lv0013->lv002,$numrun,$_SESSION['ERPSOFV2RUserID'],$emailsend);
		//$usrlogin=update_productshop($_SESSION['sof_online'],$_GET['productid']);
		//echo  Build_ListProd();		
		echo "[ENDCHECK]";	
		exit(0);
	}
?>
<link rel="stylesheet" href="../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<script language="javascript" src="../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../javascript/engine.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

function RunAuto()
{
	var o=document.frmRunAuto;
	var t=parseInt(o.txtlv002.value);
	TimeRun();
	setTimeout("RunAuto()",t*1000 );
}
function TimeRun()
{
	var value=11;
	var o=document.frmRunAuto;
	xmlhttp=null;
	if(value=="") 
	{
	alert("Nếu gặp lỗi này, xin vui long liên hệ với quản trị website!");
	return false;
	}
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajax=ajax_check"+"&Runid="+value+"&numrun="+o.txtlv001.value+"&temid="+o.txtlv003.value+"&emailsend="+o.txtlv004.value;
	url=url.replace("#","");
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}
function stateChanged()
{
	if (xmlhttp.readyState==4)	
	{
		var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('listreport').innerHTML=domainid;
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
function Refresh()
{
	
}
//-->
</script>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<div><div id="lvleft"><form  method="get" name="frmRunAuto" id="frmRunAuto" enctype="multipart/form-data">
                    <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>" />
					 <table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
                             <tr>
							  <td width="166"  height="20" valign="top"><?php echo $vLangArr[1];?></td>
							  <td width="178"  height="20"><input name="txtlv001" type="text" id="txtlv001" value="<?php echo $moml_lv0015->lv001;?>" tabindex="2" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> </td>
						    </tr>	
						  <tr>
							  <td  height="20"><?php echo $vLangArr[2];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002" value="<?php echo $moml_lv0015->lv002;?>" tabindex="3" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"> </td>
					   </tr>	
                       <tr>
							  <td  height="20px"><?php echo $vLangArr[3];?></td>
							  <td  height="20px"><select name="txtlv003" id="txtlv003" tabindex="4" style="width:80%" onKeyPress="return CheckKey(event,7)"><option value="">...</option><?php echo $moml_lv0015->LV_LinkField('lv003',$moml_lv0015->lv003);?></select></td>
							  </tr>	
					   	  <tr>
							  <td  height="20px"><?php echo $vLangArr[3];?></td>
							  <td  height="20px"><select name="txtlv004" id="txtlv004" tabindex="5" style="width:80%" onKeyPress="return CheckKey(event,7)"><option value="">...</option><?php echo $moml_lv0015->LV_LinkField('lv004',$_SESSION['ERPSOFV2RUserID']);?></select></td>
							  </tr>		
                            <tr>
				      			<td  height="20"><?php echo $vLangArr[5];?></td>
				      			<td  height="20"><textarea name="txtlv005" type="text" id="txtlv005" tabindex="11" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"> <?php echo ($moml_lv0015->lv005);?></textarea>
			          		</tr>		
                          <tr>
							  <td  height="20" ><?php echo $vLangArr[6];?></td><td><select name="txtopt" id="txtopt"   tabindex="6"  style="width:80%" onkeypress="return CheckKey(event,7)"><option value="0"><?php echo $vLangArr[7];?></option>
                              <option value="1"><?php echo $vLangArr[8];?></option>
							 
                              </select></td>
					   </tr>									
							<tr>
							  <td  height="20" colspan="2"><div id="listreport"></div></div><input name="txtflag" type="hidden" id="txtflag" value="0"  /></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:RunAuto();" tabindex="47"><img src="../images/lvicon/Rpt.png" 
            alt="RunAuto" title="<?php echo $vLangArr[8];?>" 
            name="RunAuto" border="0" align="middle" id="RunAuto" /> <?php echo $vLangArr[8];?></a></TD>
                    <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[13];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[13];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>  
				  </form>
</div></div>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
<script language="javascript">
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[0];?>';	
</script>
<script language="javascript" src="../javascript/menupopup.js"></script>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../javascript/ipopeng.php?lang=lv" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php
} else {
	include("../permit.php");
}
?>