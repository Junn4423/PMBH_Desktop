<?php
session_start();
$vDir = "../";
include($vDir."config.php");
include($vDir."function.php");
include($vDir."paras.php");
$objid=$_GET['objid'];
$objvalue=$_GET['objvalue'];
$objtable=$_GET['objtable'];
$objfield=str_replace("@!","'",$_GET['objfield']);
if(trim($objvalue)=="")
$lvsql="";
else
{
$lvsql="select top 30 * from (select distinct * from (select SOTK lv001,$objfield lv002 from [dbo].$objtable where $objfield like '$objvalue%' union select SOTK lv001,$objfield lv002 from [dbo].$objtable where $objfield like '%$objvalue%' union select SOTK lv001,$objfield lv002 from [dbo].$objtable where $objfield like '%$objvalue') A ) AA";
$strul="<ul id=subpop-nav><li class=menupopT><table border=0 width=100%>@#01</table></li></ul>";
$strtr="<tr><td><a href=\"javascript:PopupSelect('@01','$objid')\" tabindex=2>@01&nbsp;&nbsp;@02</a></td></tr>";
$strAllTr='';
$vServer='192.168.1.3';
$vUser='sa';
$vPass='P@ssword';
$vDatabase='abriDBboss';
$link = mssql_connect($vServer, $vUser, $vPass);
if (!$link || !mssql_select_db($vDatabase, $link)) {
	die('Unable to connect or select database!');
}
$lvResult = mssql_query($lvsql);
while($row=mssql_fetch_array($lvResult)){
		$lvTemp=str_replace("@01",$row['lv001'],$strtr);
		$lvTemp=str_replace("@02",str_replace($objvalue,"<font color=\"#FF0000\">".$objvalue."</font>",$row['lv002']),$lvTemp);
		$strAllTr=$strAllTr.$lvTemp;
		}
}
$strReturn=str_replace("'","\'",str_replace("@#01",$strAllTr,$strul));
$strReturn=str_replace('"','\"',$strReturn);
$strReturn=str_replace("
","",$strReturn);		
?>
<?php
?>
div1 = document.getElementById('lv_popup');
div1.innerHTML="<?php echo $strReturn;?>";
