<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0203.php");
require_once("$vDir../clsall/sl_lv0105.php");
require_once("$vDir../clsall/sl_lv0070.php");
require_once("$vDir../clsall/wh_lv0010.php");
require_once("$vDir../clsall/wh_lv0011.php");
////////init object////////////////////
	$lvsl_lv0203=new sl_lv0203($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0203');
	$lvsl_lv0105=new sl_lv0105($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0203');	
	$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0203');
	$lvsl_lv0070->LV_Load();
	$lvsl_lv0203->obj_conf=$lvsl_lv0070;
	$lvsl_lv0203->nhommon=$lvsl_lv0070->lv021;
$vNow=GetServerDate();	
if($lvsl_lv0203->GetAdd()>0)
{
if(isset($_GET['ajaxquantitysend']))
{
	//if($lvsl_lv0013->GetEdit()>0)
	{
		$optqty=(int)$_GET['optqty'];
		if($optqty==2)
		{
			$vsql="update sl_lv0014 set lv010='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
			$vresult=db_query($vsql);	
		}
		elseif($optqty==5)
		{
			$vsql="update sl_lv0014 set lv019='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
			$vresult=db_query($vsql);	
		}
		else
		{
			$lvsl_lv0014->LV_UpdateQty($_GET['chitietid'],$_GET['qty']);
		//	$vsql="update sl_lv0014 set lv004='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
		}
		
		
		}
	exit;
}


if(isset($_GET['ajaxquantitysendalldaxoa']))
{
	$vDetail=$_GET['chitietid'];
	$vDetail="'".str_replace(",","','",$vDetail)."'";
	$vsql="update sl_lv0014 set lv019='1' where lv001 in (".$vDetail.") and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
	$vresult=db_query($vsql);
	$vsql="update sl_lv0014_1 set lv019='1' where lv001 in (".$vDetail.") and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014_1.lv002)<=0";
	$vresult=db_query($vsql);
	exit;
}
if(isset($_GET['ajaxquantitysendall']))
{

	$vDetail=$_GET['chitietid'];
	$vDetail="'".str_replace(",","','",$vDetail)."'";
	$vsql="update sl_lv0014 set lv019='1',lv030=IF(lv030<1,1,(lv030+1)) where lv001 in (".$vDetail.") and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
	$vresult=db_query($vsql);
	$vsql="update sl_lv0014_1 set lv019='1' where lv001 in (".$vDetail.") and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014_1.lv002)<=0";
	$vresult=db_query($vsql);
	$lvwh_lv0010=new wh_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0010');
	$lvwh_lv0011=new wh_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0011');
	if($lvwh_lv0010->LV_CheckDataBEPBAR($_GET['donhangid'],$vDetail))
	{
		$vWarehouseID=$lvwh_lv0034->lv003;
		$lvwh_lv0010->lv001=str_replace(" ","",'PX-'.str_replace(":","",str_replace("/","",$lvwh_lv0010->DateCurrent))."-".rand(0,100));
		$lvwh_lv0010->lv002=$vWarehouseID;
		$lvwh_lv0010->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		$lvwh_lv0010->lv004=$_POST['txtlv004'];
		$lvwh_lv0010->lv005='CONTRACT';
		$lvwh_lv0010->lv006=$_GET['donhangid'];
		$lvwh_lv0010->lv007=0;	
		$lvwh_lv0010->lv008=$_POST['txtlv008'];
		$lvwh_lv0010->lv009=$_POST['txtlv009'];
		$lvwh_lv0010->lv010=$_POST['txtlv010'];
		$lvwh_lv0010->lv011=getInfor($_SESSION['ERPSOFV2RUserID'],2);;
		$vresult=$lvwh_lv0010->LV_Insert();
		if($vresult)
		{
			$vresult1=$lvwh_lv0011->LV_InsertTempSLDetail($lvwh_lv0010->lv001,$_GET['chitietid'],$vWarehouseID);
		}
	}
	exit;
}
if(isset($_GET['ajaxquantitycalcsend']))
{
	$vQty=$lvsl_lv0105->LV_UpdateCalc($_GET['chitietid']);	
	exit;
}
}	
	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0027.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($lvsl_lv0203->GetAdd()>0)
{
if(isset($_GET['ajaxaproval']))
{
	//if($lvsl_lv0203->GetEdit()>0)
	{
			$vtrangthai=$_GET['trangthai'];
			if($vtrangthai==2)
			{
				$vWarehouseID='KHOTONG';
				$vsql="update sl_lv0013 set lv011=1,lv005=concat(curdate(),' ',curtime()),lv010='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."' where lv001='".$_GET['donhangid']."' and lv011=0";
				$lvwh_lv0010=new wh_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0010');
				$lvwh_lv0011=new wh_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0011');
				if($lvwh_lv0010->LV_CheckData($_GET['donhangid'],$vWarehouseID))
				{
					$lvwh_lv0010->lv001=InsertWithCheck('wh_lv0010', 'lv001', 'PX-'.getmonth($vNow)."/".getyear($vNow)."-",1);
					$lvwh_lv0010->lv002=$vWarehouseID;
					$lvwh_lv0010->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
					$lvwh_lv0010->lv004=$_POST['txtlv004'];
					$lvwh_lv0010->lv005='CONTRACT';
					$lvwh_lv0010->lv006=$_GET['donhangid'];
					$lvwh_lv0010->lv007=0;	
					$lvwh_lv0010->lv008=$_POST['txtlv008'];
					$lvwh_lv0010->lv009=$_POST['txtlv009'];
					$lvwh_lv0010->lv010=$_POST['txtlv010'];
					$lvwh_lv0010->lv011=getInfor($_SESSION['ERPSOFV2RUserID'],2);;
					$vresult=$lvwh_lv0010->LV_Insert();
					if($vresult)
					{
						$vresult1=$lvwh_lv0011->LV_InsertTempSL($lvwh_lv0010->lv001,$_GET['donhangid'],$vWarehouseID);
					}
				}
			}
			else if($vtrangthai==3)
				$vsql="update sl_lv0013 set lv011=2 where lv001='".$_GET['donhangid']."' and lv011=1";
			else if($vtrangthai==4)
				$vsql="update sl_lv0013 set lv011=3,lv005=concat(curdate(),' ',curtime()),lv010='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."' where lv001='".$_GET['donhangid']."' and lv011=0";
			else if($vtrangthai==5)
			{
				$vsql="update sl_lv0013 set lv027=1,lv030=0,lv029='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."' where lv001='".$_GET['donhangid']."' and lv011=0";				
			}
			else
				$vsql="update sl_lv0013 set lv011=1,lv005=concat(curdate(),' ',curtime()),lv010='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."' where lv001='".$_GET['donhangid']."' and lv011=0";
			$vresult=db_query($vsql);	
			echo '[CHECKAPROVAL]';
			echo $_GET['bangid'];
			echo '[ENDCHECKAPROVAL]';
			echo '[DONHANGNHAN]';
				echo $_GET['donhangid'];
			echo '[ENDDONHANGNHAN]';
			echo '[DONHANGCON]';
			if($vtrangthai==2)
			{
				$vsql="select lv024 from sl_lv0013 where lv001='".$_GET['donhangid']."'";
				$vresult=db_query($vsql);
				$vrow = db_fetch_array ($vresult);
				echo ($vrow['lv024']=='' || $vrow['lv024']==NULL)?'1':'0';
			}
			else if($vtrangthai==5)
			{
				$vsql="select lv027 from sl_lv0013 where lv001='".$_GET['donhangid']."'";
				$vresult=db_query($vsql);
				$vrow = db_fetch_array ($vresult);
				if ($vrow['lv027']=='1')
				{
					$vsql="update sl_lv0014 set lv019=1,lv014=concat(curdate(),' ',curtime()),lv021='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."' where lv019=0 and lv002 in (select A.lv001 from sl_lv0013 A where A.lv001='".$_GET['donhangid']."' and A.lv011=0)";
					$vresult=db_query($vsql);
					echo '2';
				}
				else
					echo '3';
			}
			else
				echo "0";
		echo '[ENDDONHANGCON]';
		exit;
	}
}

if(isset($_GET['ajaxquantity']))
{
	//if($lvsl_lv0203->GetEdit()>0)
	{
	echo '[CHECKDONHANG]';
		$optqty=(int)$_GET['optqty'];
		if($optqty==2)
			$vsql="update sl_lv0014 set lv023='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
			$vresult=db_query($vsql);	

		}
	exit;
}
if(isset($_GET['ajaxprice']))
{
	//if($lvsl_lv0203->GetEdit()>0)
	{
	$voptprice=$_GET['optprice'];
	echo '[CHECKDONHANG]';
		switch($voptprice)
		{
			case 1:
				$vsql="update sl_lv0014 set lv006='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
				break;
			case 3:
				$vsql="update sl_lv0014 set lv011='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
				break;
		}
		$vresult=db_query($vsql);	
		
		$vdata=$lvsl_lv0203->LV_GetBH_Invoice($_GET['chitietid']);
		//if($_GET['qty']<=0) $lvsl_lv0105->LV_Delete($_GET['chitietid']);
		echo $_GET['bangid'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[DONHANGMONEY]';
			echo $lvsl_lv0203->FormatView($vdata[2],10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $lvsl_lv0203->FormatView($vdata[3]-$vdata[2],10);
		echo '[ENDDONHANGMONEYCL]';
		}
	exit;
}
if(isset($_GET['ajaxpro']))
{
		$Arr=Array();
		$Arr[0]=$_GET['programid'];
		$Arr[1]=$_GET['itemid'];
		if($_GET['programid']=='' || $_GET['itemid']=='')
		{
			echo '[CHECKDEF]';
			echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
			
			echo '[ENDCHECKDEF]';
			echo '[CHECKDIS]';
			echo 0;
			echo '[ENDCHECKDIS]';
		}
		else
		{
			$vsql="select A.lv001,A.lv002,B.lv004 discount,B.lv005 num,B.lv006 score from  sl_lv0059 A inner join sl_lv0060 B on A.lv001=B.lv002 where B.lv003='".$_GET['itemid']."' and A.lv001='".$_GET['programid']."' and A.lv008=1";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
					echo '[CHECKDEF]';
					echo '('.$lvsl_lv0105->FormatView($vrow['num'],10).'sp -> '.$lvsl_lv0105->FormatView($vrow['score'],10).'đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="'.$vrow['num'].'"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="'.$vrow['score'].'"/>';
					$vstrchild=$lvsl_lv0105->LV_LinkField('lv016',$Arr);
					if($vstrchild=="")	
						echo '<input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					else
					{
					}
						echo '<select name="txtlv916" id="txtlv916"   tabindex="25"  style="width:150px" onkeypress="return CheckKey(event,1)" />'.$vstrchild.'<option value="">...none...</option></select>	';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $lvsl_lv0105->FormatView($vrow['discount'],10);
					echo '[ENDCHECKDIS]';
			}
			else
			{
					echo '[CHECKDEF]';
					echo '(0sp -> 0đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="0"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="0"/><input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo 0;
					echo '[ENDCHECKDIS]';
			}
		}
}


}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lvsl_lv0203->ArrPush[0]=$vLangArr1[17];
$lvsl_lv0203->ArrPush[1]=$vLangArr1[18];
$lvsl_lv0203->ArrPush[2]=$vLangArr1[19];
$lvsl_lv0203->ArrPush[3]=$vLangArr1[20];
$lvsl_lv0203->ArrPush[4]=$vLangArr1[21];
$lvsl_lv0203->ArrPush[5]=$vLangArr1[22];
$lvsl_lv0203->ArrPush[6]=$vLangArr1[23];
$lvsl_lv0203->ArrPush[7]=$vLangArr1[24];
$lvsl_lv0203->ArrPush[8]=$vLangArr1[25];
$lvsl_lv0203->ArrPush[9]=$vLangArr1[26];
$lvsl_lv0203->ArrPush[10]=$vLangArr1[27];
$lvsl_lv0203->ArrPush[11]=$vLangArr1[28];
$lvsl_lv0203->ArrPush[12]=$vLangArr1[29];
$lvsl_lv0203->ArrPush[13]=$vLangArr1[41];
$lvsl_lv0203->ArrPush[14]=$vLangArr1[40];
$lvsl_lv0203->ArrPush[15]=$vLangArr1[42];
$lvsl_lv0203->ArrPush[16]=$vLangArr1[45];
$lvsl_lv0203->ArrPush[17]=$vLangArr1[43];
$lvsl_lv0203->ArrPush[18]=$vLangArr1[44];
$lvsl_lv0203->ArrPush[19]=$vLangArr1[46];
$lvsl_lv0203->ArrPush[20]=$vLangArr1[47];
$lvsl_lv0203->ArrPush[21]=$vLangArr1[48];
$lvsl_lv0203->ArrPush[22]=$vLangArr1[49];
$lvsl_lv0203->ArrPush[23]=$vLangArr1[50];
$lvsl_lv0203->ArrPush[24]=$vLangArr1[51];
$lvsl_lv0203->ArrPush[25]=$vLangArr1[52];
$lvsl_lv0203->ArrPush[26]=$vLangArr1[53];
$vFieldList="lv001,lv002,lv003,lv010,lv023";
$lvsl_lv0203->LV_GetBangRun($lvsl_lv0105);
$strParent=$lvsl_lv0203->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);

if((int)$isExists>=1){
//	$lvsl_lv0203->Load($lvsl_lv0203->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
.bt_setdefaultmini
{
	width:<?php echo ($lvsl_lv0070->lv009==0)?100:$lvsl_lv0070->lv009-10;?>px !important;
}
.viewlift
{
	width:<?php echo ($lvsl_lv0070->lv009==0)?90:($lvsl_lv0070->lv009);?>px !important;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function runsubmit1()
	{
		document.frmadd.submit();
	}
	function runsubmit()
	{
			window.setTimeout('runsubmit1()',10000);
	}
	function DoiBang(to)
	{
		var o=document.frmadd;
		o.txtlv807.value=to.value;
		var vo=document.getElementById('txtdoibangid');
		if(vo.value=="1")
		{
			if(confirm("Bạn có muốn đổi bàn không?"))
			{
				o.txtFlag.value="1";
				o.submit();
			}
				
		}		
	}
	function SetDefData(vTime,vRoomid)
	{
		return;
		var o=document.frmadd;
		o.txtlv807.value=vRoomid;
		o.txttyperent.value=vTime;
		{
			o.txtFlag.value="10";
			o.submit();
		}
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	function RunFunction()
	{
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
	}
	function AddProd(value)
	{
		var o1=document.getElementById("txtContractID");
		var o2=document.getElementById("txtbangid");
		var o3=document.getElementById("txtlv909");
		AddItemNew(o1.value,o2.value,"1."+value,o3.value);
		
	}
	function Add()
	{
		var o=document.frmadd;
		var o1=document.getElementById("txtContractID");
		var o2=document.getElementById("txtbangid");
		var o3=document.getElementById("txtlv909");
		AddItemNew(o1.value,o2.value,"1."+o.txtlv903.value,o3.value);
		o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('sl_lv0101/sl_lv0101exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);
		
	}
	function LoadSource()
	{
		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				break;
			case 'RECONTRACT':
				break;
			case 'PO':
				ajax_do ('sl_lv0101/sl_lv0101excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}		
	}
	function LoadHD(vobj,vreturn)
	{
		var vcondi="&contractid="+document.frmadd.txtlv801.value+"&startdate="+document.frmadd.txtlv804.value+"&enddate="+document.frmadd.txtlv805.value+"&parentid="+document.frmadd.txtlv817.value;
		LoadTextParentCond(vobj,vreturn,'sl_lv0016','lv003',document.frmadd.txtlv802.value,1,'<?php echo $plang;?>',vcondi);
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv911.value/100);
		o.txtlv908amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv908.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv908amount.value)+parseFloat(o.txtlv904.value*o.txtlv906.value);
		if(parseFloat(o.txtlvnumber.value)!=0) o.txtlv912.value=parseFloat(o.txtlv904.value)*parseFloat(o.txtlvscore.value)/parseFloat(o.txtlvnumber.value);
	}
	function viewmore()
	{
		var o=document.getElementById('morelistid');
		if(o.style.display=="block")
			o.style.display="none";
		else
			o.style.display="block";
	}
	function Report(vValue)
	{
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function vebep()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjA2L3NsX2x2MDIwNi5waHA=','_self');
	}
	function CombackHome()
	{
		window.open('?lang=<?php echo $plang;?>','_self')
	}
	-->
	</script>
</head>
<div class="hd_cafe">
	<ul class="qlycafe">
	<?php
	$lvsl_lv0206=new sl_lv0203($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0206');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0206->GetView())
	{
		echo '<li><div class="licafe" onclick="vebep()">VỀ BAR</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ul>
</div>	
<?php
if($lvsl_lv0203->GetView()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="cafetab_1" class="licafecur" onclick="setviewhere(1);curtab(1);" style="display:none"></div>
<style>


</style>
<div class="hd_cafe">
	<ul class="qlycafe">
		<li><div id="cafetab_6" class="licafe" onclick="setviewhere(6)"><?php echo 'THEO NHÓM MÓN';?></div></li>
		<li><div id="cafetab_7" class="licafe" onclick="setviewhere(7)"><?php echo 'MÓN XONG';?></div></li>
		<li><div id="cafetab_2" class="licafe" onclick="enablecokhach(13);setviewhere(2);curtab(2);viewfloorallscreen()"><?php echo $vLangArr[67];?></div></li>
		<li><div id="cafetab_3" class="licafe" onclick="setviewhere(2);setbancokhach(1);curtab(3);"><?php echo $vLangArr[68];?></div></li>
		<li><div id="cafetab_4" class="licafe" onclick="setviewhere(2);setbancokhach(2);curtab(4);"><?php echo $vLangArr[69];?></div></li>
		<li><div id="cafetab_5" class="licafe" onclick="setviewhere(2);setbancokhach(3);curtab(5);"><?php echo $vLangArr[86];?></div></li>
		<li><div class="licafe" ><span id="curday"><?php echo $lvsl_lv0203->FormatView($vNow,2);?></span> <span style="" title="<?php echo GetServerTimeSec();?>" id="countdown">11</span></li>
		
	</ul>
</div>
<!---------------Ban hang---------------------->
<div id="viewhere_6" style="display:none">
	<?php
		$vStr=$lvsl_lv0203->LV_GetDetailGroup($vLangArr,$vSum,0);
		echo $vStr;
	?>
</div>
<div id="viewhere_7" style="display:none">
	<?php
		$vStr=$lvsl_lv0203->LV_GetDetailGroup($vLangArr,$vSum,1);
		echo $vStr;
	?>
</div>
<div id="viewhere_1" style="display:none;">
	<div>
		<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											<input type="hidden" name="txtlv807" id="txtlv807" value="">
											<input type="hidden" name="txtContractID" id="txtContractID" value="0">
											<input type="hidden" name="txtgopbangid" id="txtgopbangid" value="0">
											<input type="hidden" name="txtdoibangid" id="txtdoibangid" value="0">
											<input type="hidden" name="txtbangid" id="txtbangid" value="0">
											<input type="hidden" name="txtorderid" id="txtorderid" value="0">
											<input type="hidden" name="txtlv801" id="txtlv801" value=""/>
											<input type="hidden" name="txttyperent" id="txttyperent" value=""/>
											<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
											<input type="hidden" name="curtabview" id="curtabview" value="<?php echo $_POST['curtabview'];?>"/>
											<input type="hidden" name="curtang" id="curtang" value="<?php echo $_POST['curtang'];?>"/>
			
<!-------------------SP------------------------->
				<div class="khungsp">
						
						<div  style="display:block;position:absolute;right:0px;top:0px;" >
							<div id="morelistid" style="display:none" class="morelistid">
								
								<div><?php echo $vLangArr[38];?><div id="programid"><select name="txtlv909" id="txtlv909"   tabindex="111"  style="width:80%" onkeypress="return CheckKey(event,1)" onfocus="this.title='1';"/>
																	<?php echo $lvsl_lv0105->LV_LinkFieldExt('lv009',$lvsl_lv0105->lv009);?>
																		</select></div></div>
								<div><div style="float:left"><span class="khungsptitle">Chọn sản phẩm để thêm</span></div><div style="float:right"><img onclick="document.getElementById('morelistid').style.display='none';document.getElementById('morelistidmin').style.display='block'" width="40" src="images/icon/closefull.png"/></div></div>
											  <select name="txtlv903" id="txtlv903"   tabindex="20"  style="width:100%" onkeypress="return CheckKeys(event,1,this)" onFocus="if(document.frmadd.txtlv913.value=='') document.frmadd.txtlv913.value=document.frmadd.txtlv805.value" onblur="LoadItem();changecategory_change(this.value)"/>
												<?php echo $lvsl_lv0105->LV_LinkField('lv003',$lvsl_lv0105->lv003);?>
												</select><ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" xml:lang="pop-nav4">
															<li class="menupopT">
															<input type="text" autocomplete="off" class="search_img_btn" name="txtlv903_search" id="txtlv903_search" style="width:80%" onKeyUp="LoadPopupParent(this,'txtlv903','*@*@*.sl_lv0007','concat(lv002,@! @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv903','*@*@*.sl_lv0007','concat(lv002,@! @!,lv001)')" tabindex="200">
															<div id="lv_popup4" lang="lv_popup4" xml:lang="lv_popup4"> </div>
															</li>
														</ul>
														<br/>
												<img border="0" title="<?php echo $vLangArr[35];?>" class="imgButton" onClick="Add()" onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_add_02<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg';" src="<?php echo $vDir;?>../images/iconcontrol/btn_add<?php echo (strtolower($plang)=="vn")?"vn":"";?>.jpg" tabindex="29" onKeyPress="return CheckKey(event,11)"/></td>
												
											</tr>
										  </table>
							</div>
							<div id="morelistidmin" class="morelistidmin"><div style="float:right"><img onclick="document.getElementById('morelistid').style.display='block';document.getElementById('morelistidmin').style.display='none'" width="20" src="images/icon/mui_ten.png"/></div></div>
						</div>
						<div style="clear:both;width:100%;overflow:hidden;" >
						<div style="float:right;width:50%" class="thanhprocess" >
						<?php 
							$strthanh="";
							$i=0;
							$vsql="select * from all_gmacv3_0.sl_lv0006 where  lv004=0 and (ISNULL(lv003) or lv003='' or lv001=lv003) order by lv004 asc";
							$vresultparent=db_query($vsql);
							while($vrowparent=db_fetch_array($vresultparent))
							{
								$i++;
								$strthanh=$strthanh.'<div id="thanhthus_'.$i.'" onclick="viewthanhthu('.$i.')" class="thanhcon '.(($i==1)?'conactive':'').'">'.$vrowparent['lv002'].'</div>';
								echo '	<div id="thanhthu_'.$i.'" style="clear:both;'.(($i==1)?'display:block':'display:none').'">';						
								$vsql="select distinct * from all_gmacv3_0.sl_lv0006 where (lv003='".$vrowparent['lv001']."') or ( lv001='".$vrowparent['lv001']."' and (ISNULL(lv003) or lv003='')) and lv004=0";
								$vresult=db_query($vsql);
								while($vrow=db_fetch_array($vresult))
								{
						?>
									<div style="float:left;">
										<div class="groupcafe"><?php echo $vrow['lv002'];?></div>
										<div>
											<ul class="ulfix" style="padding:0px;margin:0px;">
											<?php
											$vsql1="select * from all_gmacv3_0.sl_lv0007 where lv003='".$vrow['lv001']."' order by lv010,lv002 asc";
											$vresult1=db_query($vsql1);
											while($vrow1=db_fetch_array($vresult1))
											{
											?>
												<li style="float:left"><div onclick="AddProd('<?php echo $vrow1['lv001'];?>')" class="buttonClass"><?php echo $vrow1['lv002'];?></div></li>
											<?php
											}
											?>
											</ul>
										</div>
									</div>
						<?php
								}?>
						</div>
						<?php
							}
							?>
								</div>
						<?php
							echo '<div class="thanhnhom" style="float:left;width:49%"><input type="hidden" id="txttongthanh" value="'.$i.'"/>'.$strthanh.'</div>';
							?>
							
						</div>
						
					</div>							
<!---------------End SP------------------------>
													
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<div style="display:none;position:absolute;left:240px;bottom:0px;z-index:999999999999;" id="roomid"><select name="txtlv807tmp" id="txtlv807tmp"   tabindex="2"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" onchange="DoiBang(this)"/>
															<?php echo $lvsl_lv0203->LV_LinkField('lv007',$lvsl_lv0203->lv007);?>
										</select></div>
										</form>
			</div>
	</div>
	<form method="post" enctype="multipart/form-data" name="frmprocess" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</div>
<!---------------Đơn hàng---------------------->
<!---------------Kiem tra tang---------------------->
<div id="viewhere_2" style="display:block;clear:both;">

<?php
echo $lvsl_lv0203->LV_getTangMini($vLangArr);
?>
</div>

<!---------------Tâng---------------------->

</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[61];?>';	
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
changecategory_change(document.frmadd.txtlv903.value);
function callsizeobj(t)
{
	var romid=document.getElementById('roomid');
	if(romid.innerHTML=='') return;
	var temp=document.getElementById('roomid_'+t);
	
	var tempchild=document.getElementById('roomidchild_'+t);
	tempchild.innerHTML=romid.innerHTML;
	temp.style.display='block';
	romid.innerHTML='';
}
function closepoprome(t)
{
	var romid=document.getElementById('roomid');
	
	var temp=document.getElementById('roomid_'+t);
	temp.style.display='none';
	var tempchild=document.getElementById('roomidchild_'+t);
	romid.innerHTML=tempchild.innerHTML;
	tempchild.innerHTML='';
	
}
function viewthanhthu(stt)
{
	sum=parseInt(document.getElementById('txttongthanh').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('thanhthu_'+j);
		var vo=document.getElementById('thanhthus_'+j);
		if(stt==j) 
			{
				o.style.display="block";
				if(vo.className.indexOf('conactive')<=0) vo.className=vo.className+' conactive';
				
			}
		else 
			{
				o.style.display="none";
				if(vo.className.indexOf('conactive')>0) vo.className=vo.className.replace("conactive","");;
			}
			
		
	}
}
function ActiveGop(vthis,vDonHang,vTang,vOrder)
{
	if(vDonHang=='') return;
	var o=document.getElementById('txtContractID');
	o.value=vDonHang;
	
	var o1=document.getElementById('txtgopbangid');
	if(o1.value=="0")
		{
			o1.value="1";
			ActiveTable(0);
			vthis.value="<?php echo $vLangArr[83];?>";
		}
	else
		{
			o1.value="0";
			ActiveTable(1);
			vthis.value="<?php echo $vLangArr[81];?>";
			document.frmadd.submit();
		}
	var vo=document.getElementById('gopbangcheck_'+vOrder);
	vo.style.display="none";
}
function setDonHang(vDonHang)
{
	var o=document.getElementById('txtContractID');
	o.value=vDonHang;
}
function curtab(i)
{
	sum=7;
	var  vo=document.getElementById('curtabview');
	vo.value=i;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('cafetab_'+j);
		if(i==j)
		{
			o.className="licafecur";
		}
		else
			o.className="licafe";
	}
}
function ActiveTable(vopt)
{
	sum=parseInt(document.getElementById('sumbangall').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('gopbang_'+j);
		if(vopt==1)
		{
			var vo=document.getElementById('gopbangcheck_'+j);
			var vbang=document.getElementById('bang_'+j);			
			if(vo.checked || vbang.className.indexOf('active')>0)
				o.style.display="block";
			else
			o.style.display="none";
		}
		else
		{
			o.style.display="block";
		}
	}	
}	
function setgopbang(o,bang)
{
			$xmlhttp4=null;
			if(bang=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp4=GetXmlHttpObject();
			if (xmlhttp4==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			donhang = document.getElementById('txtContractID').value;
			var url=document.location;
			url=url+"?&ajaxgopban=ajaxcheck"+"&bangid="+bang+"&donhangid="+donhang+"&delbang="+((o.checked)?'0':'1');
			url=url.replace("#","");
			xmlhttp4.onreadystatechange=stategopbangactive;
			xmlhttp4.open("GET",url,true);
			xmlhttp4.send(null);
}
function stategopbangactive()
{
	if (xmlhttp4.readyState==4)
		{
			var o1=document.getElementById('txtgopbangid');
			if(o1.value=="0") document.frmadd.submit();
		}
}
function AddItemNew(hdid,bangid,vo,vprogid)
{
		$xmlhttp93=null;
			if(bangid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp93=GetXmlHttpObject();
			if (xmlhttp93==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			var ArItem=Array();
			ArItem=vo.split(".",2);
			url=url+"?&ajaxitemsend=ajaxcheck"+"&ContractID="+hdid+"&BangID="+bangid+"&ItemID="+ArItem[1]+"&progid="+vprogid;
			url=url.replace("#","");
			xmlhttp93.onreadystatechange=stateAddItemNew;
			xmlhttp93.open("GET",url,true);
			xmlhttp93.send(null);
}
function stateAddItemNew()
{
	if (xmlhttp93.readyState==4)
		{
			
			var startdomain=xmlhttp93.responseText.indexOf('[CHECKHOPDONG]')+14;
			var enddomain=xmlhttp93.responseText.indexOf('[ENDCHECKHOPDONG]');
			var domainid=xmlhttp93.responseText.substr(startdomain,enddomain-startdomain);
			
			var startdomain1=xmlhttp93.responseText.indexOf('[HOPDONGMONEY]')+14;
			var enddomain1=xmlhttp93.responseText.indexOf('[ENDHOPDONGMONEY]');
			var domainid1=xmlhttp93.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('detailview_'+domainid);
			o.innerHTML=domainid1;
			var startdomain2=xmlhttp93.responseText.indexOf('[CHECKORDER]')+12;
			var enddomain2=xmlhttp93.responseText.indexOf('[ENDCHECKORDER]');
			var domainid2=xmlhttp93.responseText.substr(startdomain2,enddomain2-startdomain2);
			var o=document.getElementById('tongtien_'+domainid2);
			var startdomain3=xmlhttp93.responseText.indexOf('[HOPDONGSUM]')+12;
			var enddomain3=xmlhttp93.responseText.indexOf('[ENDHOPDONGSUM]');
			var domainid3=xmlhttp93.responseText.substr(startdomain3,enddomain3-startdomain3);
			o.innerHTML=domainid3;
			var o=document.getElementById('tongtienconlai_'+domainid2);
			var startdomain4=xmlhttp93.responseText.indexOf('[HOPDONGUNG]')+12;
			var enddomain4=xmlhttp93.responseText.indexOf('[ENDHOPDONGUNG]');
			var domainid4=xmlhttp93.responseText.substr(startdomain4,enddomain4-startdomain4);
			o.innerHTML='<strong>'+domainid4+'</strong>';
			var o=document.getElementById('tongtienconlai1_'+domainid2);
			o.innerHTML='<strong>'+domainid4+'</strong>';
			
		}
}
function changeqtytratruoc(o,chitietid,bangid)
{
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=2&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
}
function changestaffreceivefood(o,chitietid,bangid)
{
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			if(o.checked)
				url=url+"?&ajaxquantitysend=ajaxcheck"+"&qty=1&chitietid="+chitietid+"&optqty=5&bangid="+bangid;
			else
				url=url+"?&ajaxquantitysend=ajaxcheck"+"&qty=0&chitietid="+chitietid+"&optqty=5&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
}
function changestaffreceivefoodDAXOA(o,chitietid,bangid)
{
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitysendalldaxoa=ajaxcheck"+"&qty=1&chitietid="+chitietid;
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
}
function changestaffreceivefoodallDAXOA(chitietid)
{
			$xmlhttp913=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp913=GetXmlHttpObject();
			if (xmlhttp913==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitysendalldaxoa=ajaxcheck"+"&qty=1&chitietid="+chitietid;
			url=url.replace("#","");
			xmlhttp913.onreadystatechange=statechitietdhall;
			xmlhttp913.open("GET",url,true);
			xmlhttp913.send(null);
}
function changestaffreceivefoodall(chitietid)
{
			$xmlhttp93=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp93=GetXmlHttpObject();
			if (xmlhttp93==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitysendall=ajaxcheck"+"&qty=1&chitietid="+chitietid;
			url=url.replace("#","");
			xmlhttp93.onreadystatechange=statechitietdhall;
			xmlhttp93.open("GET",url,true);
			xmlhttp93.send(null);
}
function statechitietdhall()
{
	if (xmlhttp93.readyState==4)
	{
		 document.frmadd.submit();
	}
}
function changeqtynoupdate(o,chitietid)
		{
			return;
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp13=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp13=GetXmlHttpObject();
			if (xmlhttp13==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitysend=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1";
			url=url.replace("#","");
			xmlhttp13.onreadystatechange=statechitietdhnoup;
			xmlhttp13.open("GET",url,true);
			xmlhttp13.send(null);
		}
function changecalcqtynoupdate(o,chitietid)
		{
			return;
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp13=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp13=GetXmlHttpObject();
			if (xmlhttp13==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantitycalcsend=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1";
			url=url.replace("#","");
			xmlhttp13.onreadystatechange=statechitietdhnoup;
			xmlhttp13.open("GET",url,true);
			xmlhttp13.send(null);
		}		
function statechitietdhnoup()
{
	if (xmlhttp13.readyState==4)
		{
		/*var startdomain=xmlhttp13.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp13.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp13.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp13.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp13.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp13.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien_'+domainid);
			o.innerHTML=domainid1;
			var o=document.getElementById('tongtienct_'+domainid);
			o.innerHTML=domainid1;
			
			var startdomain1=xmlhttp13.responseText.indexOf('[DONHANGMONEYCL]')+16;
			var enddomain1=xmlhttp13.responseText.indexOf('[ENDDONHANGMONEYCL]');
			var domainid1=xmlhttp13.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtientt_'+domainid);
			o.innerHTML=domainid1;*/
	//window.location.reload()
	}
}		
function changeqty(o,chitietid,bangid)
		{
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
		}
function delline(o,chitietid,bangid)
		{
			o.parentNode.parentNode.innerHTML='';
			
			$xmlhttp3=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp3=GetXmlHttpObject();
			if (xmlhttp3==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+0+"&chitietid="+chitietid+"&optqty=1&bangid="+bangid+'&optdel=1';
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
		}
function statechitietdh()
{
		if (xmlhttp3.readyState==4)
		{
			
		}
}	
function UpdateText(o,donhangid,bangid,option)
{

		$xmlhttp555=null;
			if(bangid=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp555=GetXmlHttpObject();
			if (xmlhttp555==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&bangid="+bangid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp555.onreadystatechange=stateactivebangtext;
			xmlhttp555.open("GET",url,true);
			xmlhttp555.send(null);	
}
function stateactivebangtext()
{
}
function CheckVAT(o,donhangid,bangid)
{	
		taxonline=0;
		if(o.checked) taxonline=10;
		$xmlhttp55=null;
			if(bangid=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp55=GetXmlHttpObject();
			if (xmlhttp55==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangvat=ajaxcheck"+"&donhangid="+donhangid+"&bangid="+bangid+"&taxonline="+taxonline;
			url=url.replace("#","");
			xmlhttp55.onreadystatechange=stateactivebangvat;
			xmlhttp55.open("GET",url,true);
			xmlhttp55.send(null);	
}	
function stateactivebangvat()
{
}
function tratiendonphong(donhangid,bangid,opt,text1,text2,text3)
{
	tratien(donhangid,bangid,opt);
}
function tratien(donhangid,bangid,opt)
		{
			if(opt==2)
			{
			if(!confirm("Bạn có muốn thực thi trả tiền?"))
			{
				return;
			}
			}
			$xmlhttp2=null;
			if(donhangid=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxaproval=ajaxcheck"+"&donhangid="+donhangid+"&bangid="+bangid+"&trangthai="+opt;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=statetratien;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
			}
function tiencoc(donhangid,bangid,opt)
		{
		var str="<br><iframe id='lvframefrm' height=300 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0058_/sl_lv0058.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>&ChildID="+donhangid+"\" class=lvframe></iframe>";
		div = document.getElementById('lvloaddata_'+donhangid);
		div.innerHTML=str;
		}		
function tratiencoc(donhangid,bangid,opt)
		{
		var str="<br><iframe id='lvframefrm' height=300 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0057_/sl_lv0057.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>&ChildID="+donhangid+"\" class=lvframe></iframe>";
		div = document.getElementById('lvloaddata_'+donhangid);
		div.innerHTML=str;	
		}			
function loaddataactive(bangid)
{
			$xmlhttp5=null;
			if(bangid=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp5=GetXmlHttpObject();
			if (xmlhttp5==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangid=ajaxcheck"+"&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp5.onreadystatechange=stateactivebang;
			xmlhttp5.open("GET",url,true);
			xmlhttp5.send(null);
}	
function changeprice(o,chitietid,bangid)
		{	
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp6=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp6=GetXmlHttpObject();
			if (xmlhttp6==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=1&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp6.onreadystatechange=statepricedh;
			xmlhttp6.open("GET",url,true);
			xmlhttp6.send(null);
		}		
	function changediscount(o,chitietid,bangid)
		{
			
			if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp6=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp6=GetXmlHttpObject();
			if (xmlhttp6==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=3&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp6.onreadystatechange=statepricedh;
			xmlhttp6.open("GET",url,true);
			xmlhttp6.send(null);
		}			
function statepricedh()
{
		if (xmlhttp6.readyState==4)
		{
			var startdomain=xmlhttp6.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp6.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp6.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp6.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp6.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp6.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien_'+domainid);
			o.innerHTML=domainid1;
			var o=document.getElementById('tongtienct_'+domainid);
			o.innerHTML=domainid1;
			var startdomain1=xmlhttp6.responseText.indexOf('[DONHANGMONEYCL]')+16;
			var enddomain1=xmlhttp6.responseText.indexOf('[ENDDONHANGMONEYCL]');
			var domainid1=xmlhttp6.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtientt_'+domainid);
			o.innerHTML=domainid1;
		}
}		
function stateactivebang()
{
		if (xmlhttp5.readyState==4)
		{
			
			var startdomain=xmlhttp5.responseText.indexOf('[CHECKBANGOK]')+13;
			var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECKBANGOK]');
			var ok=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
			if(parseInt(ok)==1)
			{
				var startdomain=xmlhttp5.responseText.indexOf('[CHECKBANGID]')+13;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECKBANGID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv802');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK1BANGID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK1BANGID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv803');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK3BANGID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK3BANGID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv814');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK2BANGID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK2BANGID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv809');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK4BANGID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK4BANGID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv813');
				o.value=donhang;
			}
		}
}
function statetratien()
{
		if (xmlhttp2.readyState==4)
		{
			var startdomain=xmlhttp2.responseText.indexOf('[DONHANGNHAN]')+13;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDDONHANGNHAN]');
			var donhang=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			
			var startdomain=xmlhttp2.responseText.indexOf('[CHECKAPROVAL]')+14;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDCHECKAPROVAL]');
			var domainid=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			var STTID=domainid;
			var o=document.getElementById('bang_'+domainid);
			if(o.className.indexOf('active')==1)
			{
				o.className="bangleftmini waiting";
				var o=document.getElementById('bangtitle_'+domainid);
				o.className="bangtitlewaitmini";
				var to=document.getElementById('bang_'+domainid);
				to.innerHTML=to.innerHTML.replace('viewpopcalendar(','tratiendonphong(\''+donhang+'\',\''+domainid+'\',3,');
				Report(donhang);
			}
			else if(o.className.indexOf('waiting')==1)
			{
				o.className="bangleftmini";
				var o=document.getElementById('bangtitle_'+domainid);
				o.className="bangtitlecurmini";
			}
			else
			{
				o.className="bangleftmini";
				var o=document.getElementById('bangtitle_'+domainid);
				o.className="bangtitlecurmini";
				
			}
			var startdomain=xmlhttp2.responseText.indexOf('[DONHANGCON]')+12;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDDONHANGCON]');
			var domainid=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			if(parseInt(domainid)==0)			document.frmadd.submit();
			if(parseInt(domainid)==3)
			{
				var o=document.getElementById('bangtitle_'+STTID);
				o.className="bangtitlemini_alarm";
			}
			if(parseInt(domainid)==2)
			{
				var o=document.getElementById('bangtitle_'+STTID);
				o.className="bangtitlemini";
			}
				
			var o=document.getElementById('tongtien_'+domainid);
			
			o.innerHTML='0';
			
		}
}		
function changecategory_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajax=ajaxcheck"+"&itemid="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChanged;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function stateChanged()
		{
			fcus=false;
			if (xmlhttp.readyState==4)
			{
				if(document.getElementById('txtlv909').title=='1') fcus=true;	
				var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('programid').innerHTML=domainid;
				var startdomain1=xmlhttp.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
				document.getElementById('calscore').innerHTML=domainid1;
				var startdomain2=xmlhttp.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp.responseText.substr(startdomain2,enddomain2-startdomain2);
				document.getElementById('txtlv911').value=domainid2;
				if(fcus==true) document.getElementById('txtlv909').focus();
				document.getElementById('txtlv909').title='';
				
			}
		}
		function stateChangedProgram()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain1=xmlhttp1.responseText.indexOf('[CHECKDEF]')+10;
				var enddomain1=xmlhttp1.responseText.indexOf('[ENDCHECKDEF]');
				var domainid1=xmlhttp1.responseText.substr(startdomain1,enddomain1-startdomain1);
				document.getElementById('calscore').innerHTML=domainid1;
				var startdomain2=xmlhttp1.responseText.indexOf('[CHECKDIS]')+10;
				var enddomain2=xmlhttp1.responseText.indexOf('[ENDCHECKDIS]');
				var domainid2=xmlhttp1.responseText.substr(startdomain2,enddomain2-startdomain2);
				document.getElementById('txtlv911').value=domainid2;
			}
		}
		function program_change(itemid,value)
		{
			$xmlhttp1=null;
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxpro=program"+"&programid="+value+"&itemid="+itemid;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedProgram;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
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
</script>
<script language="javascript">
function setZoom(i)
{
	var o=document.frmadd;
	o.allcreen.value=((i==0)?"1":"0");
	o.submit();
}
function viewpopcalendar(vstt,vfocus,vtang,vRoomid)
{
	var o1=document.getElementById("txtContractID");
	o1.value=vfocus;
	var o2=document.getElementById("txtbangid");
	o2.value=vRoomid;
	var o3=document.getElementById("txtorderid");
	o3.value=vstt;
	var bang=document.getElementById("bang_"+vstt);
	var o=document.getElementById("calendarview_"+vstt);
	var scrollwidth=document.body.scrollWidth
	var left=0;
	var top=(1-vtang)*85;
	//if(top<0) top=0;
	if(scrollwidth>(960+130))
	{
		left=(scrollwidth-1090)/2
	}
	o.style.display="block";
	o.style.left=left+"px";
	o.style.top=top+"px";
	var obj=document.getElementById('viewhere_1');
	var monan=document.getElementById('monan_'+vstt);
	monan.innerHTML=obj.innerHTML;
	obj.innerHTML='';
	var vo=document.getElementById("item_"+vfocus);
	vo.focus();
}
function viewpopliftview(vstt)
{
	sum=parseInt(document.getElementById('sumbangall').value);
	for(j=1;j<=sum;j++)
	{	
		if(vstt!=j)
		{
			var o=document.getElementById('liftview_'+j);
			if(o!=null)			o.style.display="none";
		}
	}
	var o=document.getElementById("liftview_"+vstt);
	o.style.display="block";

}
function closepoplift(vstt)
{
	var o=document.getElementById("liftview_"+vstt);
	o.style.display="none";
}
function closepopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="none";
	var obj=document.getElementById('viewhere_1');
	var monan=document.getElementById('monan_'+vstt);
	obj.innerHTML=monan.innerHTML;
	monan.innerHTML='';
}
function setBang(vid,state)
{
	var o=document.getElementById('txtlv807');
	o.value=vid;
	if(state==1)	loaddataactive(vid);
}
function viewfloorallscreen()
{
	sum=parseInt(document.getElementById('sumtangall').value);
	viewfloorall(sum);
}
function setbancokhach(opt)
{
	sum=parseInt(document.getElementById('sumtangall').value);
	viewfloorall(sum);
	enablecokhach(opt);
}
function enablecokhach(vopt)
{
	sum=parseInt(document.getElementById('sumbangall').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('bang_'+j);
		if(vopt==13)
		{
			o.style.display="block";
		}
		else
		{
			if(o.className.indexOf('active')>0)
			{
				if(vopt==1)
					o.style.display="block";
				else
					o.style.display="none";
			}
			else if(o.className.indexOf('waiting')>0)
			{
				if(vopt==3)
					o.style.display="block";
				else
					o.style.display="none";
			}
			else
			{
				if(vopt==1)
					o.style.display="none";
				else if(vopt==3)
					o.style.display="none";
				else
					o.style.display="block";
			}
		}
	}	
}
function setviewhere(i)
{
	sum=7;
	
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('viewhere_'+j);
		if(o!=null)
		{
		if(i==j)
		{
			curtab(i);
			o.style.display="block";
		}
		else
			o.style.display="none";
			}
	}
}
function setContractID(value)
{
	var o=document.getElementById('txtlv801');
	o.value=value;
	var vo=document.getElementById('txtdoibangid');
	vo.value="1";
	
}
function viewfloorall(sum)
{
	for(j=1;j<=sum;j++)
	{
		var o=document.getElementById('bangtang_'+j);
		o.style.display="block";
		var v=document.getElementById('litangleft_'+j);
		v.className=v.className.replace('current','');
	}
	var v=document.getElementById('litangleft_0');
	if(v.className.indexOf('current')<=0) v.className=v.className+' current';
	var curtang=document.getElementById('curtang');
	curtang.value=0;
}
function viewfloor(value,sum)
{
	
	for(j=0;j<=sum;j++)
	{
		if(j>0) var o=document.getElementById('bangtang_'+j);
		var v=document.getElementById('litangleft_'+j);
		if(j==value)
			{
				if(j>0)  o.style.display="block";
				if(v.className.indexOf('current')<=0)	v.className=v.className+' current';
				
			}
		else
			{
				v.className=v.className.replace('current','');
				if(j>0)  o.style.display="none";
			}
	}
	var curtang=document.getElementById('curtang');
	curtang.value=value;
	//var v=document.getElementById('litangleft_0');
	//v.className=v.className.replace('current','');
}
/* Timer */
setTimeout(setReload,<?php echo ($lvsl_lv0070->lv025==0)?60000:$lvsl_lv0070->lv025*1000;?>);
function checkviewlist()
{
	sum=parseInt(document.getElementById('sumbang').value);
	for(j=1;j<=sum;j++)
	{
	var o=document.getElementById("calendarview_"+j);
		if(o.style.display=="block")
		{
		setTimeout(setReload,<?php echo ($lvsl_lv0070->lv025==0)?60000:$lvsl_lv0070->lv025*1000;?>);
		return false;
		}
	}
	return true;
}
function setReload()
{
	if(checkviewlist())
	{
		var o=document.frmadd;
		o.submit();
	}
}

runTimer();
setTimer();
function setTimer ()
{
		var othis=document.getElementById('countdown');
		var myTime=othis.title;
		if (parseInt(myTime)>=0)
		{
			var hour=parseInt(myTime/3600,10);
			var minute=parseInt((myTime%3600)/60,10);
			var second=(myTime%3600)%60;
			var str="";
			othis.innerHTML=(getNamDay(hour) + ":" + minute + ":" + second);
			othis.title=parseInt(myTime)+1;
		}
	setTimeout(setTimer,1000);
}
function getNamDay(hour)
{
	if(hour>24)
	{
		return parseInt(hour/24)+" ngày "+(hour%24);
	}
	return hour;
}
function setTimerTwo (othis,orun,osub,ocalc)
{
		var myTime=othis.title;
		if (parseInt(myTime)>=0)
		{
			var hour=parseInt(myTime/3600,10);
			var minute=parseInt((myTime%3600)/60,10);
			var second=(myTime%3600)%60;
			var str="";
			othis.innerHTML=(getNamDay(hour) + ":" + minute + ":" + second);
			othis.title=parseInt(myTime)+<?php echo ($lvsl_lv0070->lv005==0)?60:$lvsl_lv0070->lv005;?>;
			/*if( orun && orun !== "null" && orun !== "undefined")
			{
			detailid=orun.value;
			
			var o=document.getElementById('detail_id_'+orun.value);
			if(orun.title=="0") 
			{	
				if(minute>=10)
					var vday=hour/24+1;
				else
					var vday=hour/24;
					//var vday=hour/24+ ((minute+<?php echo ($lvsl_lv0070->lv005==0 || ($lvsl_lv0070->lv005/60)<1)?1:$lvsl_lv0070->lv005/60;?>)/60)/24;
					
				if(vday<=1) vday=1;
				o.value= vday;
			}
			else
			{
				var giosub=0;
				var tinhh=0;
				var limit=parseFloat(o.title);
				if(minute>=10 && minute<40)
					{
						giosub=hour+ 0.5;
						if((hour)><?php echo ($lvsl_lv0070->lv009==0)?2:$lvsl_lv0070->lv009;?>)
							tinhh=1;
						else
							tinhh=0.5;
						var time=hour+ 0.5-limit;
					}
				else
				{
					if(minute>=40 && minute<59)
					{
						giosub=hour+ 1;
						tinhh=1;
						var time=hour+ 1-limit;
					}
					else
					{
						giosub=hour;
						tinhh=1;
						var time=hour-limit;
					}
				}	
				if(time<0) time=0;
				o.value= time;
				if( osub && osub !== "null" && osub !== "undefined")
				{
					if((giosub)>=<?php echo ($lvsl_lv0070->lv009==0)?2:$lvsl_lv0070->lv009;?>)
					{
						if(parseInt(osub.title)<1)
						{
							var to=document.getElementById('detail_id_'+osub.value);
							to.value= tinhh;
							changeqtynoupdate(to,osub.value);
						}
					}
				}
			}
			if( ocalc && ocalc !== "null" && ocalc !== "undefined")
			{
				//var to=document.getElementById('detail_id_'+ocalc.value);
				//changecalcqtynoupdate(to,ocalc.value);
			}
			changeqtynoupdate(o,detailid);
			}*/
	}
}
function runTimer()
{
	
	sum=parseInt(document.getElementById('sumbang').value);
	
	for(j=1;j<=sum;j++)
	{
		var o=document.getElementById('bangtime_'+j);
		var v=document.getElementById('timedetailid_'+j);
		var t=document.getElementById('timesubtractid_'+j);
		var s=document.getElementById('timecalcid_'+j);
		setTimerTwo(o,v,t,s);		
	}
	setTimeout(runTimer,<?php echo ($lvsl_lv0070->lv005==0)?60000:$lvsl_lv0070->lv005*1000;?>);
}
runtabview(<?php echo (int)$_POST['curtabview'];?>,<?php echo (int)$_POST['curtang'];?>);
function runtabview(opt,curtang)
{
	var sumtangall=<?php echo $lvsl_lv0203->sumTang;?>;
	if(opt==0) opt=6;
	switch(opt)
	{
		case 1:
		setviewhere(1);		
			break;
		case  2:
			enablecokhach(13);setviewhere(2);
			break;
		case  3:
			setviewhere(2);setbancokhach(1);
			break;
		case  4:
			setviewhere(2);setbancokhach(2)		
			break;
		case  5:
			setviewhere(2);setbancokhach(3)		
			break;
		case 6:
			setviewhere(6);		
			break;
		case 7:
			setviewhere(7);		
			break;
	}
	curtab(opt)
	if(parseInt(curtang)==0)
		viewfloorall(sumtangall);
	else
		viewfloor(curtang,sumtangall)
	
}
/* End timer */
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>