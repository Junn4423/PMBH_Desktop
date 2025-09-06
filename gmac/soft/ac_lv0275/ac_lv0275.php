<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/ac_lv0019.php");
require_once("$vDir../clsall/sl_lv0001.php");
require_once("$vDir../clsall/ac_lv0033.php");
require_once("$vDir../clsall/sl_lv0070.php");
require_once("$vDir../clsall/wh_lv0010.php");
require_once("$vDir../clsall/wh_lv0011.php");
require_once("$vDir../clsall/sl_lv0059.php");
require_once("$vDir../clsall/mn_lv0005.php");
require_once("$vDir../clsall/sl_lv0007.php");
require_once("$vDir../clsall/sl_lv0058.php");
require_once("$vDir../clsall/wh_lv0034.php");
require_once("$vDir../clsall/wh_lv0020.php");
////////init object////////////////////
	$lvac_lv0019=new ac_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvac_lv0033=new ac_lv0033($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');	
	$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvsl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvmn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvwh_lv0034=new wh_lv0034($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$mowh_lv0011=new wh_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');	
	$mowh_lv0020=new wh_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	$lvsl_lv0070->LV_Load();
	$lvac_lv0019->obj_conf=$lvsl_lv0070;
	$mowh_lv0011->objlot=$mowh_lv0020;
	$lvac_lv0019->moac_lv0033=$lvac_lv0033;
	$lvac_lv0019->mowh_lv0011=$mowh_lv0011;

$vNow=GetServerDate();	
if($lvac_lv0019->GetAdd()>0)
{
if(isset($_GET['ajaxdel']))
{
	$vContractID=$_GET['ContractID'];
	$lvac_lv0019->LV_Delete("'".$vContractID."'");
}
if(isset($_GET['ajaxchangeorder']))
{
	$vContractID=$_GET['ContractID'];
	$vContractIDOld=$_GET['ContractIDOld'];
	if($vContractID!=$vContractIDOld)
	{
		if($vContractIDOld=="" || $vContractIDOld==NULL)
		{
			$vContractID=$lvac_lv0019->LV_ExistEmp(getInfor($_SESSION['ERPSOFV2RUserID'],2));
			if($vContractID=="" || $vContractID==NULL)
			{
				if($lvac_lv0019->GetApr()==0) $lvac_lv0019->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
				if($lvac_lv0019->lv003=="") $lvac_lv0019->lv003=getInfor($_SESSION['ERPSOFV2RUserID'],2);
				$lvac_lv0019->lv023=getInfor($_SESSION['ERPSOFV2RUserID'],2);
				$lvac_lv0019->lv005=$lvac_lv0019->FormatView($vNow,2)." ".GetServerTime();
				$lvac_lv0019->lv001=$vContractID;
				//if($lvsl_lv0059->lv009>0) $lvac_lv0019->lv022=$lvsl_lv0059->lv009;
				$vresult=$lvac_lv0019->LV_Insert();
				if($vresult==false)
				{
				}
			}
			echo "[NEWCONTRACTID]";
				echo $vContractID;
			echo "[ENDNEWCONTRACTID]";
		}
		else
		{
			$vsql="update ac_lv0004 set lv001='$vContractID' where lv001='$vContractIDOld' and lv011=0 and lv010='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."'";
			$vresult=db_query($vsql);
			echo "[NEWCONTRACTID]";
				echo $vContractID;
			echo "[ENDNEWCONTRACTID]";
		}
	}
	else
	{
		echo "[NEWCONTRACTID]";
				echo '';
			echo "[ENDNEWCONTRACTID]";
	}
	exit();
}
if(isset($_GET['ajaxitemsend']))
{
	$vItemID=$_GET['ItemID'];
	$vprogid=$_GET['progid'];
	$vWHID=$_GET['WHID'];
	$vContractID=$_GET['ContractID'];
	$vDateGhi=$_GET['DateGhi'];
	$vNotes=$_GET['Notes'];
	if($vContractID=="" || $vContractID==NULL)
	{
		$vContractID=$lvac_lv0019->LV_ExistEmp(getInfor($_SESSION['ERPSOFV2RUserID'],2));
	}
	if($vContractID=="" || $vContractID==NULL)
	{
		$vContractID=getyear($vNow).getmonth($vNow).getday($vNow).rand(0,9).rand(100,999);//InsertWithCheck('ac_lv0019', 'lv001', 'INV-'.getmonth($vNow)."/".getyear($vNow)."-",4);
		if($lvac_lv0019->GetApr()==0) $lvac_lv0019->lv008=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		if($lvac_lv0019->lv008=="") $lvac_lv0019->lv008=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		$lvac_lv0019->lv019=$lvac_lv0019->FormatView($vNow,2)." ".GetServerTime();
		$lvac_lv0019->lv009=$lvac_lv0019->FormatView($vNow,2);//$vDateGhi;
		$lvac_lv0019->lv007=$vNotes;
		$lvac_lv0019->lv001=$vContractID;
		$lvac_lv0019->lv002=1;
		$lvac_lv0019->lv003=$vWHID;
		$lvac_lv0019->lv010='1111';
		//if($lvsl_lv0059->lv009>0) $lvac_lv0019->lv022=$lvsl_lv0059->lv009;
		$vresult=$lvac_lv0019->LV_InsertAuto();
		if($vresult==false)
		{
			$vContractID=getyear($vNow).getmonth($vNow).getday($vNow).rand(0,9).rand(100,999);//InsertWithCheck('ac_lv0019', 'lv001', 'INV-'.getmonth($vNow)."/".getyear($vNow)."-",4);
			$lvac_lv0019->lv001=$vContractID;
			$vresult=$lvac_lv0019->LV_InsertAuto();
			if($vresult==false) $vContractID="";
		}
	}
	echo "[CONTRACTID]";
		echo $vContractID;
	echo "[ENDCONTRACTID]";
	$vlv005=$_GET['tkchitien'];
	if($vlv005=='') $vlv005='331';
	if($vContractID!="" && $vContractID!=NULL)
	{
		$lvac_lv0019->LV_LoadID($vContractID);
		$vUpdate=$_GET['update'];
		$vDetailID=$lvac_lv0033->LV_CheckExitItem($vContractID,$vNotes);
		$vlv003=$lvac_lv0019->lv002;
		$vDateStart=$lvac_lv0019->lv005;
		$vDateEnd=$lvac_lv0019->lv005;
		$vlv006='1111';
		if(($vDetailID!='' && $vDetailID!=NULL && $vUpdate==1))
			$vsql="update ac_lv0005 set lv003='$vItemID',lv004='$vItemID' where lv001='$vDetailID'";
		else
			$vsql="insert into ac_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007)  values('$vContractID','$vItemID','$vItemID','$vlv005','$vlv006','$vNotes')";
		$vresult=db_query($vsql);
		if($vresult)
		{
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="EN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			echo $lvac_lv0019->LV_GetDetail($vContractID,$vWHID,$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[HOPDONGSUM]';
			echo $lvac_lv0019->FormatView($vSum,10);
			echo '[ENDHOPDONGSUM]';
			echo '[HOPDONGUNG]';
			echo 0;
			echo '[ENDHOPDONGUNG]';
			
		}
	}
	exit;
	
}
if(isset($_GET['ajaxbangtext']))
{
	$vdonhangid=$_GET['donhangid'];
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];	
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		switch($voption)
		{			
			case 7:
				$vsql="update ac_lv0004 set lv006='$vText' where lv001='$vdonhangid' and lv016=0";
				break;
			case 9:
				//$vsql="update ac_lv0004 set lv009='".recoverdate($vText,$plang)."' where lv001='$vdonhangid' and lv016=0";
				break;
			case 3:
				$vsql="update ac_lv0004 set lv003='$vText' where lv001='$vdonhangid' and lv016=0";
			break;
		}		
		$vresult=db_query($vsql);
	}
	exit;
}
if(isset($_GET['ajaxbangtextqty']))
{	
	$vdonhangid=$_GET['donhangid'];
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];	
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		switch($voption)
		{			
			case 99:
				$vsql="update ac_lv0004 set lv099='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
		}		
		$vresult=db_query($vsql);
	}
	$lvac_lv0019->LV_LoadID($vdonhangid);
	$vsum8=$lvac_lv0019->LV_GetContractMoney($vdonhangid,0);
	$vsum6=$lvac_lv0019->LV_GetContractMoney($vdonhangid,6);
	$vsum10=$lvac_lv0019->LV_GetContractMoney($vdonhangid,10);
		echo '[CHECKDONHANG]';	
		echo $_GET['WHID'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[SOLUONGTHUC]';
			echo $lvac_lv0019->FormatView($vsum8,10);
		echo '[ENDSOLUONGTHUC]';
		echo '[SOLUONGKHO]';
		echo $lvac_lv0019->FormatView($vsum6,10);
		echo '[ENDSOLUONGKHO]';
		echo '[SOLUONGMUA]';
			echo $lvac_lv0019->FormatView($vsum10,10);
		echo '[ENDSOLUONGMUA]';
	
	exit;
}
if(isset($_GET['ajaxbangvat']))
{
	$vdonhangid=$_GET['donhangid'];
	$vTax=$_GET['taxonline'];
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		$vsql="update ac_lv0004 set lv006=$vTax where lv001='$vdonhangid' and lv011<=1";
		$vresult=db_query($vsql);
	}
}
if(isset($_GET['ajaxcustomertext']))
{
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001->LV_LoadID($vcusid);
	if($lvsl_lv0001->lv001=="" || $lvsl_lv0001->lv001==NULL)
	{
		$lvsl_lv0001->lv001=$vcusid;
		$lvsl_lv0001->lv002=$vcusid;
		
		$lvsl_lv0001->lv024=GetServerDate()." ".GetServerTime();
		$lvsl_lv0001->lv025=getInfor($_SESSION['ERPSOFV2RUserID'],2);
		$lvsl_lv0001->LV_Insert();
	}
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];
	if($vcusid!='' && $vcusid!=NULL)
	{
		switch($voption)
		{
			case 2:
				$vsql="update sl_lv0001 set lv002='$vText',lv003='".GetLastName($vText)."' where lv001='$vcusid'";
			break;
			case 6:
				$vsql="update sl_lv0001 set lv006='$vText' where lv001='$vcusid'";
			break;
			case 16:
				$vsql="update sl_lv0001 set lv010='$vText' where lv001='$vcusid'";
			break;
			case 23:
				$vsql="update sl_lv0001 set lv023='$vText' where lv001='$vcusid'";
			break;
		}
		
		$vresult=db_query($vsql);
	}
	exit;
}
if(isset($_GET['ajaxnote']))
{
	$vsql="update ac_lv0005 set lv007='".$_GET['notes']."' where lv001='".$_GET['chitietid']."' and (select A.lv016 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
	$vresult=db_query($vsql);	
	exit;
}
if(isset($_GET['ajaxquantitysend']))
{
	//if($lvac_lv0019->GetEdit()>0)
	{
		$optqty=(int)$_GET['optqty'];
		if($optqty==5)
		{
			$vsql="update ac_lv0005 set lv005='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
			$vresult=db_query($vsql);	
		}
		elseif($optqty==6)
		{
			$vsql="update ac_lv0005 set lv006='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
			$vresult=db_query($vsql);	
		}
		else
		{
			$vsql="update ac_lv0005 set lv003='".$_GET['qty']."',lv004='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
			$vresult=db_query($vsql);	
		}
		
		
		}
	exit;
}
if(isset($_GET['ajaxquantitycalcsend']))
{
	$vQty=$lvac_lv0033->LV_UpdateCalc($_GET['chitietid']);	
	exit;
}
}	
	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0027.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($lvac_lv0019->GetAdd()>0)
{
if(isset($_GET['ajax']))
{
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
	$lvsl_lv0001->LV_LoadID($vcusid);
	echo '[CHECK]';
	echo $lvsl_lv0001->lv002;
	echo '[ENDCHECK]';
	echo '[TCHECK]';
	echo $lvsl_lv0001->lv006;
	echo '[ENDTCHECK]';
	echo '[SCHECK]';
	echo $lvsl_lv0001->lv010;
	echo '[ENDSCHECK]';
	echo '[DOANHCHECK]';
	echo $lvsl_lv0001->LV_ListPopupYear($lvsl_lv0001->lv001,getyear($vNow));
	echo '[ENDDOANHCHECK]';
	echo '[DATRATRUOC]';
	echo $lvsl_lv0001->SaveTotal;
	echo '[ENDDATRATRUOC]';
	echo '[PROGCHECK]';
	
		echo $vID=$lvsl_lv0059->LV_GetProgCus($lvsl_lv0001->lv022);
	
	echo '[ENDPROGCHECK]';
	exit;
}
if(isset($_GET['ajaxaproval']))
{
		$vContractID=$_GET['donhangid'];
		$vresult=$lvac_lv0019->LV_Aproval("'".$vContractID."'");
		echo '[DONHANGNHAN]';
		echo $_GET['donhangid'];
		echo '[ENDDONHANGNHAN]';
		echo '[EMPTYCONTRACT]';
		echo $lvac_lv0019->LV_GetDetail('','',$vLangArr,$vSum);
		echo '[ENDEMPTYCONTRACT]';
		exit;
}
if(isset($_GET['ajaxWHID']))
{
	$vWHID=$_GET['WHID'];
	$vsql="select * from ac_lv0019 BB where BB.lv007='$vWHID'  and BB.lv011=0 limit 0,1";
	$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
					echo '[CHECKBANGOK]';
						echo 1;
					echo '[ENDCHECKBANGOK]';
					echo '[CHECKWHID]';
						echo $vrow['lv002'];
					echo '[ENDCHECKWHID]';
					echo '[CHECK1WHID]';
						echo $vrow['lv003'];
					echo '[ENDCHECK1WHID]';
					echo '[CHECK2WHID]';
						echo $vrow['lv009'];
					echo '[ENDCHECK2WHID]';
					echo '[CHECK3WHID]';
						echo $vrow['lv014'];
					echo '[ENDCHECK3WHID]';
					echo '[CHECK4WHID]';
						echo $vrow['lv013'];
					echo '[ENDCHECK4WHID]';
			}
}
if(isset($_GET['ajaxquantity']))
{
	//if($lvac_lv0019->GetEdit()>0)
	{
		echo '[CHECKDONHANG]';
		$optqty=(int)$_GET['optqty'];
		$vsql="update ac_lv0005 set lv003='".$_GET['qty']."',lv004='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv007 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
		$vresult=db_query($vsql);	
		
		//$vdata=$lvac_lv0019->LV_GetBH_Invoice($_GET['chitietid']);
		if($_GET['optdel']==1) $lvac_lv0033->LV_Delete($_GET['chitietid']);
		echo $_GET['WHID'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		$vdonhangid=$_GET['donhangid'];
		$vsum=$lvac_lv0019->LV_GetContractMoney($vdonhangid);
		echo '[ENDCHECKDONHANG]';
		echo '[TIENDONHANG]';
		echo $lvac_lv0019->FormatView($vsum,10);
		echo '[ENDTIENDONHANG]';
		echo '[SOLUONGKHO]';
		echo $lvac_lv0019->FormatView($vsum6,10);
		echo '[ENDSOLUONGKHO]';
		echo '[SOLUONGMUA]';
		echo $lvac_lv0019->FormatView($vsum10,10);
		echo '[ENDSOLUONGMUA]';
		}
	exit;
}
if(isset($_GET['ajaxprice']))
{
	$voptprice=$_GET['optprice'];
	echo '[CHECKDONHANG]';
		switch($voptprice)
		{
			case 5:
				$vsql="update ac_lv0005 set lv005='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv016 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
				break;
			case 6:
				$vContractID=$_GET['donhangid'];
				$vsql="update ac_lv0004 set lv010='".$_GET['price']."' where lv001='".$vContractID."' and lv016<=0";
				$vresult=db_query($vsql);
				$vsql="update ac_lv0005 set lv006='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv016 from ac_lv0004 A where A.lv001=ac_lv0005.lv002)<=0";
				break;
		}
		$vresult=db_query($vsql);	

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
					echo '('.$lvac_lv0033->FormatView($vrow['num'],10).'sp -> '.$lvac_lv0033->FormatView($vrow['score'],10).'đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="'.$vrow['num'].'"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="'.$vrow['score'].'"/>';
					$vstrchild=$lvac_lv0033->LV_LinkField('lv016',$Arr);
					if($vstrchild=="")	
						echo '<input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					else
					{
					}
						echo '<select name="txtlv916" id="txtlv916"   tabindex="25"  style="width:150px" onkeypress="return CheckKey(event,1)" />'.$vstrchild.'<option value="">...none...</option></select>	';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $lvac_lv0033->FormatView($vrow['discount'],10);
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
//$lvac_lv0019->LV_CheckSQL();
$flagCtrl = (int)$_POST['txtFlag'];
//Lấy mã phiếu nhập kho
$lvac_lv0019->lv001=$lvac_lv0019->LV_ExistEmp(getInfor($_SESSION['ERPSOFV2RUserID'],2));
if($lvac_lv0019->lv001!="" && $lvac_lv0019->lv001!=NULL)
{	
	$lvac_lv0019->LV_LoadID($lvac_lv0019->lv001);
	$lvsl_lv0001->LV_LoadID($lvac_lv0019->lv002);
}
if($lvac_lv0019->lv001!="" && $lvac_lv0019->lv001!=NULL) $lvac_lv0019->LV_LoadID($lvac_lv0019->lv001);
if($_POST['txtdoiWHID']==1)  $lvac_lv0019->lv001=$_POST['txtlv801'];
$isExists =0;//$lvac_lv0019->LV_Exist($lvac_lv0019->lv001);	
}
else if($flagCtrl == 10){
$lvac_lv0019->lv002=$_POST['txtlv802'];
$lvac_lv0019->lv003=$_POST['txtlv803'];
$lvac_lv0019->lv006=$_POST['txtlv806'];
$lvac_lv0019->lv007=$_POST['txtlv807'];	
$lvac_lv0019->lv008=$_POST['txtlv808'];
$lvac_lv0019->lv006=$_POST['txtlv809'];
$lvac_lv0019->lv011=$_POST['txtlv811'];
$lvac_lv0019->lv012=$_POST['txtlv812'];
$lvac_lv0019->lv013=$_POST['txtlv813'];
$lvac_lv0019->lv014=$_POST['txtlv814'];
$lvac_lv0019->lv015=$_POST['txtlv815'];
$lvac_lv0019->lv016=$_POST['txtlv816'];
$lvac_lv0019->lv017=$_POST['txtlv817'];
$lvac_lv0019->lv018=$_POST['txtlv818'];
$lvac_lv0019->lv019=$_POST['txtlv819'];
$lvac_lv0019->lv022=$_POST['txtlv822'];

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lvac_lv0019->ArrPush[0]=$vLangArr1[17];
$lvac_lv0019->ArrPush[1]=$vLangArr1[18];
$lvac_lv0019->ArrPush[2]=$vLangArr1[19];
$lvac_lv0019->ArrPush[3]=$vLangArr1[20];
$lvac_lv0019->ArrPush[4]=$vLangArr1[21];
$lvac_lv0019->ArrPush[5]=$vLangArr1[22];
$lvac_lv0019->ArrPush[6]=$vLangArr1[23];
$lvac_lv0019->ArrPush[7]=$vLangArr1[24];
$lvac_lv0019->ArrPush[8]=$vLangArr1[25];
$lvac_lv0019->ArrPush[9]=$vLangArr1[26];
$lvac_lv0019->ArrPush[10]=$vLangArr1[27];
$lvac_lv0019->ArrPush[11]=$vLangArr1[28];
$lvac_lv0019->ArrPush[12]=$vLangArr1[29];
$lvac_lv0019->ArrPush[13]=$vLangArr1[41];
$lvac_lv0019->ArrPush[14]=$vLangArr1[40];
$lvac_lv0019->ArrPush[15]=$vLangArr1[42];
$lvac_lv0019->ArrPush[16]=$vLangArr1[45];
$lvac_lv0019->ArrPush[17]=$vLangArr1[43];
$lvac_lv0019->ArrPush[18]=$vLangArr1[44];
$lvac_lv0019->ArrPush[19]=$vLangArr1[46];
$lvac_lv0019->ArrPush[20]=$vLangArr1[47];
$lvac_lv0019->ArrPush[21]=$vLangArr1[48];
$lvac_lv0019->ArrPush[22]=$vLangArr1[49];
$lvac_lv0019->ArrPush[23]=$vLangArr1[50];
$lvac_lv0019->ArrPush[24]=$vLangArr1[51];
$lvac_lv0019->ArrPush[25]=$vLangArr1[52];
$lvac_lv0019->ArrPush[26]=$vLangArr1[53];
$vFieldList="lv001,lv002,lv003,lv010,lv023";
if((int)$isExists>=1){
//	$lvac_lv0019->Load($lvac_lv0019->ID);
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
		var vo=document.getElementById('txtdoiWHID');
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
		if(o1.value=='Mã phiếu chi') o1.value='';
		var o2=document.getElementById("txtlv994");
		AddItemNew(o1.value,o2.value,value);
		
	}
	function Add()
	{
		var o=document.frmadd;
		var o1=document.getElementById("txtContractID");
		var o2=document.getElementById("txtlv994");
		if(o1.value=='Mã phiếu chi') o1.value='';
		if(parseFloat(o.txtlv903.value)>0) AddItemNew(o1.value,o2.value,o.txtlv903.value);
		o.txtlv903.value='';
		o.txtlv903.focus();
	}
	function DelPhieu()
	{
		var o1=document.getElementById("txtContractID");
		if(o1.value=='Mã phiếu chi') o1.value='';
		if(o1.value!='')
		{
			if(confirm("Bạn có muốn xoá phiếu "+o1.value+" này không ?(Y/N)"))
			{
				xmlhttp193=null;
				xmlhttp193=GetXmlHttpObject();
				var url=document.location;
				url=url+"?&ajaxdel=ajaxcheck"+"&ContractID="+o1.value;
				url=url.replace("#","");
				xmlhttp193.onreadystatechange=stateDeleteRun;
				xmlhttp193.open("GET",url,true);
				xmlhttp193.send(null);
			}
		}
		o1.value=='Mã phiếu chi';
	}
	
	function stateDeleteRun()
	{
		if (xmlhttp193.readyState==4)
			{
				nhapchi();
			}
	}	
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'GMAC':
				LoadPopupParent(to,'txtlv806','ac_lv0019','lv003');
				break;
			case 'TRAHANG':
				LoadPopupParent(to,'txtlv806','ac_lv0019','lv003');
				break;
			case 'MUAHANG':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('wh_lv0102/wh_lv0102exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);
		
	}
	function LoadSource()
	{
		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'GMAC':
				break;
			case 'TRAHANG':
				break;
			case 'MUAHANG':
				ajax_do ('wh_lv0102/wh_lv0102excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
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
		if(vValue=='Mã phiếu chi') vValue='';
		if(vValue=="")		var vValue=document.getElementById("txtContractID").value;
		//var vstr="ReportMoreEmpty('"+vValue+"')";
		//window.setTimeout(vstr,500);
		var vPT=document.getElementById("txtPTID").value;
		document.getElementById("txtPTID").value='';
		var vstr="ReportMore('"+vPT+"')";
		window.setTimeout(vstr,500);
		var o1=document.getElementById("txtContractID");
		if(vValue=="") vValue=o1.value;
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ac_lv0019?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();		
	}
	function ReportMore(vValue)
	{
		if(vValue=='Mã phiếu chi') vValue='';
		if(vValue=="") 
		{
			return;
		}
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0058?func=&childdetailfunc=rpt&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function ReportMoreEmpty(vValue)
	{
		if(vValue=='Mã phiếu chi') vValue='';
		if(vValue=="")		var vValue=document.getElementById("txtContractID").value;
		if(vValue=="") 
		{
			return;
		}
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>ac_lv0019?func=rptbill&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function notSpecialChar(evt)
	{
		var e = evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
		if(charCode>=48 && charCode<=57)
		{
			return true;
		}
		if(charCode==75 || charCode==72  || charCode==8 || charCode==46 || charCode==9 || charCode==39 || charCode==13 || charCode==37) return true;  
		return false;

	}
	function  nhapchi()
	{
		window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMjc1L2FjX2x2MDI3NS5waHA=','_self');
	}
	function  phieuchi()
	{
		window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMDE5L2FjX2x2MDAxOS5waHA=','_self');
	}
	function  sanpham()
	{
		window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=c2xfbHYwMDA3L3NsX2x2MDAwNy5waHA=','_self');
	}
	function  baocaosoquy()
	{
		window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMTAzL2FjX2x2MDEwMy5waHA=','_self');
	}
	function baocaochi()
	{
		window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMjMzL2FjX2x2MDIzMy5waHA=','_self');
	}
	function CombackHome()
	{
		window.open('?lang=<?php echo $plang;?>','_self')
	}
	function baocaotong()
	{
		window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjYxL3NsX2x2MDI2MS5waHA=','_self');
	}
	function taikhoanchi()
	{
		window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=YWNfbHYwMDAyL2FjX2x2MDAwMi5waHA=','_self');
	}
	-->
	</script>
</head>
<div class="hd_cafe">
	<ul class="qlycafe">
		<?php 
		require_once("../clsall/ac_lv0234.php");
		$lvac_lv0234=new ac_lv0234($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0234');
		if($_SESSION['ERPSOFV2RRight']=='admin' || $lvac_lv0234->GetView())
		{
			echo '<li><div class="licafe" onclick="baocaochi()" title="Báo cáo chi">BÁO CÁO CHI</div></li>';
		}
		require_once("../clsall/ac_lv0002.php");
		$lvac_lv0002=new ac_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0002');
		if($_SESSION['ERPSOFV2RRight']=='admin' || $lvac_lv0002->GetView())
		{
			echo '<li><div class="licafe" onclick="taikhoanchi()">LOẠI CHI</div></li>';
		}
		?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>		
	</ul>
</div>
<?php
if($lvac_lv0019->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
<div id="bán hàngtab_1" class="libán hàngcur" onclick="setviewhere(1);curtab(1);" style="display:none"></div>
<style>

</style>
<div class="hd_cafe">
	<div style="clear:both;font:bold 18px Arial,Tahoma;line-height:30px;">
		<div style="float:left;width:100px">
		<input tabindex="2"  readonly="true" class="kk_txtContractID" type="textbox" title="Mã phiếu chi" name="txtContractID" id="txtContractID" style="width:90px;text-align:center;height:25px;color:blue" value="<?php echo ($lvac_lv0019->lv001=='')?'Mã phiếu chi':$lvac_lv0019->lv001;?>" onblur="ChangeOrderID(this.value)"><input type="hidden" name="txtContractIDOld" id="txtContractIDOld" style="width:80px;text-align:center;height:20px;color:blue" value="<?php echo $lvac_lv0019->lv001;?>">
		</div>
		
		<div style="float:left;width:82px"><center>
			<input tabindex="2" class="kk_txtcontractend" style="width:70px;text-align:center;height:25px;color:blue" onblur="if(this.value == '') {this.value = this.title;} else {UpdateContract(this,9);}" onfocus="ProcessDateMore(); if(this.value == this.title) {this.value = '';}  " value="<?php echo ($lvac_lv0019->lv005!="" && $lvac_lv0019->lv005!=NULL)?$lvac_lv0019->FormatView($lvac_lv0019->lv005,2):$lvac_lv0019->FormatView($vNow,2);?>" title="Ngày kiểm" class="textview" name="txtcontractend" id="txtcontractend" type="text" tabindex="50" ondblclick="if(self.gfPop)gfPop.fPopCalendar(document.frmadd.txtcontractend);return false;" readonly="true"/></center>
		</div>
		<div style="float:left;width:110px;">
		<center>
			<select  tabindex="2" class="kk_txtkho"  name="tkchitien" id="tkchitien" onblur="UpdateContract(this,100)"  style="width:100px;height:30px;" onkeypress="return CheckKey(event,1)" />
				<?php echo $lvac_lv0019->LV_LinkField('lv010','331');?>
			</select>			
			</center>	
		</div>
		<div style="float:left;width:80px;padding-top:7px;height:30px;" id="kk_del">
			<center>
				<img  tabindex="2" border="0" title="Xoá phiếu" class="imgButton" onclick="DelPhieu()" onmouseout="this.src='../images/iconcontrol/btn_addvn.jpg';" onmouseover="this.src='../images/iconcontrol/btn_delete_02.jpg';" src="../images/iconcontrol/btn_delete.jpg" onkeypress="return CheckKey(event,11)" >
			</center>
		</div>
		<!--<div style="float:right;"><span style="color:black" title="<?php echo GetServerTimeSec();?>" id="countdown"></span>
		</div>-->
		<div  class="kk_chonsanpham" style="float:left;width:160px;">
			<input  tabindex="2" title="Nhập tiền chi" name="txtlv903" id="txtlv903"  style="width:150px;height:25px;text-align:center;" value="Nhập tiền chi" onfocus="if(this.value == this.title) this.value = '';" onblur="if(this.value == '') {this.value = this.title;} }" onfocus="if(this.value == this.title) this.value = '';"/></div>
		</div>
		<div style="float:left;">
			<input  tabindex="2" class="kk_txtcontractnote" style="width:130px;text-align:center;height:25px;color:blue"  onkeypress="return CheckKeys(event,1,this)" onblur="if(this.value == '') {this.value = this.title;} else {UpdateContract(this,7);}" onfocus="if(this.value == this.title) this.value = '';" value="<?php echo ($lvac_lv0019->lv006!="" && $lvac_lv0019->lv006!=NULL)?$lvac_lv0019->lv006:'Ghi chú';?>" title="Ghi chú" class="textview" name="txtcontractnote" id="txtcontractnote" type="text" tabindex="50" />
		</div>
		<div style="float:left;padding-top:7px;height:30px;">
			<img  tabindex="2" border="0" title="Tiền" class="imgButton" onclick="Add()" onmouseout="this.src='../images/iconcontrol/btn_addvn.jpg';" onmouseover="this.src='../images/iconcontrol/btn_add_02vn.jpg';" src="../images/iconcontrol/btn_addvn.jpg" onkeypress="return CheckKey(event,11)">
      </div>									

		
</div>
<!---------------Ban hang---------------------->
<div id="viewhere_1" style="display:block;">
	<div>
		
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											<input type="hidden" name="txtlv807" id="txtlv807" value="">
											<input type="hidden" name="txtPTID" id="txtPTID" value="">
											
											<input type="hidden" name="txtgopWHID" id="txtgopWHID" value="0">
											<input type="hidden" name="txtdoiWHID" id="txtdoiWHID" value="0">
											<input type="hidden" name="txtlv994" id="txtlv994" value="0">
											<input type="hidden" name="txtlv801" id="txtlv801" value=""/>
											<input type="hidden" name="txttyperent" id="txttyperent" value=""/>
											<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
											<input type="hidden" name="curtabview" id="curtabview" value="<?php echo $_POST['curtabview'];?>"/>
											<input type="hidden" name="curtang" id="curtang" value="<?php echo $_POST['curtang'];?>"/>
			
<!-------------------SP------------------------->
				<div class="khungsp">
						<div id="kk_detailview" style="background:#fff;height:400px;overflow: scroll;width100%;">
							<div style="padding:5px">
							<?php 
							$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
							echo $lvac_lv0019->LV_GetDetail($lvac_lv0019->lv001,$vWHID,$vLangArr,$vSum);
							?>
							</div>
						</div>
					
						
					</div>	
					</div>
					
					<div>
					<div style="position:absolute;left:0px;bottom:0px;height:25px">
							<div class="vitribang" style="width:1000px">
							<div class="banhangmini" style="height:40px;border-bottom:2px #fff solid;float:left;" onclick="tratien('',2);"><a tabindex="99" href="javascript:" style="color:inherit" title="Chưa thu tiền và chưa xuất kho"><br/>Xong</a></div>
								<div class="banhangmini" style="height:40px;border-bottom:2px #fff solid;float:left;" onclick="ReportMoreEmpty('<?php echo $lvwh_lv0008->lv001;?>')"><br/>Báo cáo</div>
								<div class="banhangmini" style="height:40px;border-bottom:2px #fff solid;float:left;" onclick="CombackHome();"><br/>Quay lại</div>
							<div  style="float:left;"><input style="padding:0px;margin:0px;height:10px;" type="checkbox" value=1  CHECKED="true" id="txtupdate"/></div>
						</div>					
<!---------------End SP------------------------>
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<div style="display:none;position:absolute;left:240px;bottom:0px;z-index:999999999999;" id="roomid"><select name="txtlv807tmp" id="txtlv807tmp"   tabindex="2"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" onchange="DoiBang(this)"/>
															<?php echo $lvac_lv0019->LV_LinkField('lv007',$lvac_lv0019->lv007);?>
										</select></div>

			</div>
	</div>
	
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</div>
<!---------------Đơn hàng---------------------->
<!---------------Kiem tra tang---------------------->
<div id="viewhere_2" style="display:block;clear:both;">

<?php
//echo $lvac_lv0019->LV_getTangMini($vLangArr);
?>
</div>
										</form>
										<form method="post" enctype="multipart/form-data" name="frmprocess" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
				  <form method="post" enctype="multipart/form-data" name="frmprocess1" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<!---------------Tâng---------------------->

</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
setTimeout(focusmain,1000);
function focusmain()
{
document.getElementById('txtlv903').focus();
}
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[61];?>';	
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
function ActiveGop(vthis,vDonHang,vTang)
{
	if(vDonHang=='') return;
	var o=document.getElementById('txtContractID');
	var o11=document.getElementById('txtContractIDOld');
	o.value=vDonHang;
	o11.value=vDonHang;
	var o1=document.getElementById('txtgopWHID');
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
}
function ChangeOrderID(vDonHang)
{
	var o=document.getElementById('txtContractIDOld');
	vDonHangOld=o.value;
	$xmlhttp75=null;
	if(vDonHang=="") 
	{	
	return false;
	}
	xmlhttp75=GetXmlHttpObject();
	if (xmlhttp75==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxchangeorder=ajaxcheck"+"&ContractID="+vDonHang+"&ContractIDOld="+vDonHangOld;
	url=url.replace("#","");
	xmlhttp75.onreadystatechange=stateChangeOrder;
	xmlhttp75.open("GET",url,true);
	xmlhttp75.send(null);
}
function stateChangeOrder()
{
		if (xmlhttp75.readyState==4)
		{
			var startdomain=xmlhttp75.responseText.indexOf('[NEWCONTRACTID]')+15;
			var enddomain=xmlhttp75.responseText.indexOf('[ENDNEWCONTRACTID]');
			var domainid=xmlhttp75.responseText.substr(startdomain,enddomain-startdomain);
			var o=document.getElementById('txtContractIDOld');
			if(domainid!='') o.value=domainid;
		}
}
function setDonHang(vDonHang)
{
	var o=document.getElementById('txtContractID');
	o.value=vDonHang;
}
function curtab(i)
{
	sum=5;
	var  vo=document.getElementById('curtabview');
	vo.value=i;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('bán hàngtab_'+j);
		if(i==j)
		{
			o.className="libán hàngcur";
		}
		else
			o.className="libán hàng";
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
function AddItemNew(hdid,WHID,vo)
{
		if(vo=='Nhập tiền chi') return;
		if(parseFloat(vo)<=0) return;
		if(WHID=='Mã phiếu chi') WHID='';
		var vUpdate=0;
		if(document.getElementById('txtupdate').checked) vUpdate=1;
		$xmlhttp93=null;
			if(WHID=="") 
			{
			alert("Xin vui lòng chọn kho để kiểm.");
			document.getElementById("txtlv994").focus();
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
			vDateGhi=document.getElementById('txtcontractend').value;
			vNotes=document.getElementById('txtcontractnote').value;
			vtkchitien=document.getElementById('tkchitien').value;
			if(vNotes=='Ghi chú') vNotes='';
			url=url+"?&ajaxitemsend=ajaxcheck"+"&ContractID="+hdid+"&WHID="+WHID+"&ItemID="+vo+"&update="+vUpdate+"&DateGhi="+vDateGhi+"&Notes="+vNotes+"&tkchitien="+vtkchitien;
			url=url.replace("#","");
			xmlhttp93.onreadystatechange=stateAddItemNew;
			xmlhttp93.open("GET",url,true);
			xmlhttp93.send(null);
}
function stateAddItemNew()
{
	if (xmlhttp93.readyState==4)
		{
			
			var startdomain=xmlhttp93.responseText.indexOf('[CONTRACTID]')+12;
			var enddomain=xmlhttp93.responseText.indexOf('[ENDCONTRACTID]');
			var domainid=xmlhttp93.responseText.substr(startdomain,enddomain-startdomain);
			var o=document.getElementById('txtContractID');
			o.value=domainid;
			var o11=document.getElementById('txtContractIDOld');
			o11.value=domainid;
			var startdomain1=xmlhttp93.responseText.indexOf('[HOPDONGMONEY]')+14;
			var enddomain1=xmlhttp93.responseText.indexOf('[ENDHOPDONGMONEY]');
			var domainid1=xmlhttp93.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('kk_detailview');
			o.innerHTML=domainid1;
			var startdomain1=xmlhttp93.responseText.indexOf('[TIENDONHANG]')+13;
			var enddomain1=xmlhttp93.responseText.indexOf('[ENDTIENDONHANG]');
			var domainid1=xmlhttp93.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien').innerHTML=domainid1;		
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
		
	}
}		
function changeqty(o,chitietid)
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
			donhangid = document.getElementById('txtContractID').value;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+o.value+"&chitietid="+chitietid+"&optqty=1"+"&donhangid="+donhangid;
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
			document.getElementById('thanhtien_'+chitietid).innerHTML=parseFloat(document.getElementById('soluong_'+chitietid).value)*parseFloat(document.getElementById('dongia_'+chitietid).value);
		}
function delline(o,chitietid)
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
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+0+"&chitietid="+chitietid+"&optqty=1"+'&optdel=1';
			url=url.replace("#","");
			xmlhttp3.onreadystatechange=statechitietdh;
			xmlhttp3.open("GET",url,true);
			xmlhttp3.send(null);
		}
function statechitietdh()
{
		if (xmlhttp3.readyState==4)
		{
			var startdomain=xmlhttp3.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp3.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp3.responseText.substr(startdomain,enddomain-startdomain);
			/*var startdomain1=xmlhttp3.responseText.indexOf('[SOLUONGTHUC]')+13;
			var enddomain1=xmlhttp3.responseText.indexOf('[ENDSOLUONGTHUC]');
			var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongsoluongthuc').innerHTML=domainid1;*/
			var startdomain1=xmlhttp3.responseText.indexOf('[TIENDONHANG]')+13;
			var enddomain1=xmlhttp3.responseText.indexOf('[ENDTIENDONHANG]');
			var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien').innerHTML=domainid1;
		}
}	
function UpdateCustomer(o,option)
{
		$xmlhttp35=null;
			donhangid=document.getElementById('txtContractID').value;
			if(cusid=="")
			{
				alert("Xin vui lòng số điện thoại");return false;
			}
			xmlhttp35=GetXmlHttpObject();
			if (xmlhttp35==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxcustomertext=ajaxcheck"+"&donhangid="+donhangid+"&cusid="+cusid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp35.onreadystatechange=stateactivecustomertext;
			xmlhttp35.open("GET",url,true);
			xmlhttp35.send(null);	
}
function stateactivecustomertext()
{
	if (xmlhttp35.readyState==4)
		{
			
		}
}
function UpdateTextQty(o,donhangid,option)
{
		if(donhangid=='') donhangid = document.getElementById('txtContractID').value;
		if(donhangid=='') 
		{
			//alert('Đơn hàng chưa có!Xin vui lòng chọn sản phẩm bán để có đơn hàng!');
		}
		$xmlhttp655=null;
			xmlhttp655=GetXmlHttpObject();
			if (xmlhttp655==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangtextqty=ajaxcheck"+"&donhangid="+donhangid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp655.onreadystatechange=stateactivebangtextqty;
			xmlhttp655.open("GET",url,true);
			xmlhttp655.send(null);	
}
function stateactivebangtextqty()
{
	if (xmlhttp655.readyState==4)
		{
			var startdomain=xmlhttp655.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp655.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp655.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp655.responseText.indexOf('[TIENDONHANG]')+13;
			var enddomain1=xmlhttp655.responseText.indexOf('[ENDTIENDONHANG]');
			var domainid1=xmlhttp655.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien').innerHTML=domainid1;
		}
}
function UpdateContract(o,option)
{
		$xmlhttp555=null;
			xmlhttp555=GetXmlHttpObject();
			if (xmlhttp555==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			if(parseFloat(o.value)<=0) return;
			var donhangid = document.getElementById('txtContractID').value;
			var url=document.location;
			url=url+"?&ajaxbangtext=ajaxcheck"+"&donhangid="+donhangid+"&textup="+o.value+"&optrun="+option;
			url=url.replace("#","");
			xmlhttp555.onreadystatechange=stateactivebangtext;
			xmlhttp555.open("GET",url,true);
			xmlhttp555.send(null);	
}
function stateactivebangtext()
{
}
function CheckVAT(o,donhangid)
{	
	taxonline=0;
	if(donhangid=='') donhangid = document.getElementById('txtContractID').value;
	if(o.checked) taxonline=10;	
	$xmlhttp55=null;
	xmlhttp55=GetXmlHttpObject();
	if (xmlhttp55==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
		var url=document.location;
		url=url+"?&ajaxbangvat=ajaxcheck"+"&donhangid="+donhangid+"&taxonline="+taxonline;		
		url=url.replace("#","");
		xmlhttp55.onreadystatechange=stateactivebangvat;
		xmlhttp55.open("GET",url,true);
		xmlhttp55.send(null);	
}	
function tratiendl(donhangid,opt)
{
			if(donhangid=="")
			{
				donhangid=document.getElementById('txtContractID').value;
			}
			
			$xmlhttp2=null;
			if(donhangid=="") 
			{
			alert("Mã đơn hàng trống");
			return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxaproval=ajaxcheck"+"&donhangid="+donhangid+"&cusid="+cusid+"&empid="+empid+"&trangthai="+opt+"&content="+vcontent+"&cusname="+cusname;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=statetratiendl;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
}
function statetratiendl()
{
		if (xmlhttp2.readyState==4)
		{
			var startdomain=xmlhttp2.responseText.indexOf('[DONHANGNHAN]')+13;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDDONHANGNHAN]');
			var donhang=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			ReportMoreEmpty(donhang);
			nhapchi()
		}
}	
function  nhapchi()
	{
		window.open('?lang=<?php echo $plang;?>&opt=99&item=&link=YWNfbHYwMjc1L2FjX2x2MDI3NS5waHA=','_self');
	}
function stateactivebangvat()
{
}
function tratien(donhangid,opt)
		{
			var vmoneytt=0;
			if(donhangid=="")
			{
				donhangid=document.getElementById('txtContractID').value;
			}
			
			$xmlhttp2=null;
			if(donhangid=="") 
			{
			alert("Mã đơn hàng trống");
			return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxaproval=ajaxcheck"+"&donhangid="+donhangid;
			url=url.replace("#","");
			xmlhttp2.onreadystatechange=statetratien;
			xmlhttp2.open("GET",url,true);
			xmlhttp2.send(null);
			}
function loaddataactive(WHID)
{
			$xmlhttp5=null;
			if(WHID=="") 
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
			url=url+"?&ajaxWHID=ajaxcheck"+"&WHID="+WHID;
			url=url.replace("#","");
			xmlhttp5.onreadystatechange=stateactivebang;
			xmlhttp5.open("GET",url,true);
			xmlhttp5.send(null);
}	
function changetkno(o,chitietid)
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
			donhangid = document.getElementById('txtContractID').value;
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=5"+"&donhangid="+donhangid;
			url=url.replace("#","");
			xmlhttp6.onreadystatechange=statepricedh;
			xmlhttp6.open("GET",url,true);
			xmlhttp6.send(null);
			document.getElementById('thanhtien_'+chitietid).innerHTML=parseFloat(document.getElementById('soluong_'+chitietid).value)*parseFloat(document.getElementById('dongia_'+chitietid).value);
		}	
		function changenote(o,chitietid)
		{	
			$xmlhttp66=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp66=GetXmlHttpObject();
			if (xmlhttp66==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxnote=ajaxcheck"+"&notes="+o.value+"&chitietid="+chitietid;
			url=url.replace("#","");
			xmlhttp66.onreadystatechange=statepricedh;
			xmlhttp66.open("GET",url,true);
			xmlhttp66.send(null);
		}			
function changetkco(o,chitietid)
		{
			
			/*if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			*/
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
			donhangid = document.getElementById('txtContractID').value;
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=6"+"&donhangid="+donhangid;
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
			var startdomain1=xmlhttp6.responseText.indexOf('[TIENDONHANG]')+13;
			var enddomain1=xmlhttp6.responseText.indexOf('[ENDTIENDONHANG]');
			var domainid1=xmlhttp6.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien').innerHTML=domainid1;
			
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
				var startdomain=xmlhttp5.responseText.indexOf('[CHECKWHID]')+13;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECKWHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv802');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK1WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK1WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv803');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK3WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK3WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv814');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK2WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK2WHID]');
				var donhang=xmlhttp5.responseText.substr(startdomain,enddomain-startdomain);
				var o=document.getElementById('txtlv809');
				o.value=donhang;
				var startdomain=xmlhttp5.responseText.indexOf('[CHECK4WHID]')+14;
				var enddomain=xmlhttp5.responseText.indexOf('[ENDCHECK4WHID]');
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
			var startdomain=xmlhttp2.responseText.indexOf('[DONHANGNHAN]')+13;
			var enddomain=xmlhttp2.responseText.indexOf('[ENDDONHANGNHAN]');
			var donhang=xmlhttp2.responseText.substr(startdomain,enddomain-startdomain);
			ReportMoreEmpty(donhang);
			nhapchi()
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
		url=url+"?&ajax=ajaxcheck"+"&cusid="+value;
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
		document.getElementById('txtcusname').value=domainid;
		var startdomain=xmlhttp.responseText.indexOf('[TCHECK]')+8;
		var enddomain=xmlhttp.responseText.indexOf('[ENDTCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusadd').value=domainid;
		var startdomain=xmlhttp.responseText.indexOf('[SCHECK]')+8;
		var enddomain=xmlhttp.responseText.indexOf('[ENDSCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusnote').value=domainid;
		document.getElementById('txtcusname').focus();	
		var startdomain=xmlhttp.responseText.indexOf('[DOANHCHECK]')+12;
		var enddomain=xmlhttp.responseText.indexOf('[ENDDOANHCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtdoanhthu').innerHTML=domainid;
		var startdomain=xmlhttp.responseText.indexOf('[DATRATRUOC]')+12;
		var enddomain=xmlhttp.responseText.indexOf('[ENDDATRATRUOC]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtmoney').value=domainid;
		document.getElementById('tongsoluongkhoconlai').innerHTML='0';		
		var startdomain=xmlhttp.responseText.indexOf('[PROGCHECK]')+11;
		var enddomain=xmlhttp.responseText.indexOf('[ENDPROGCHECK]');
		var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
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

function setContractID(value)
{
	var o=document.getElementById('txtlv801');
	o.value=value;
	var vo=document.getElementById('txtdoiWHID');
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
function viewkiemkho()
{
	var scrollwidth=document.body.scrollWidth;
	var content=window.parent.document.getElementById('sof_pages_content');
	var vHeight=parseInt(content.style.height);
	var vWidth=parseInt(content.style.width);
	var left=0;
	var kk_thanhnhom=document.getElementById("kk_thanhnhom");
	var kk_thanhprocess=document.getElementById("kk_thanhprocess");
	kk_thanhnhom.style.height=(vHeight-80)+'px';
	kk_thanhprocess.style.height=(vHeight-80)+'px';
	kk_thanhprocess.style.width=(scrollwidth-140)+'px';
	var kk_detailview=document.getElementById("kk_detailview");
	kk_detailview.style.height=(vHeight-80)+'px';
}
/* Timer */
//setTimeout(setReload,<?php echo ($lvsl_lv0070->lv003==0)?60000:$lvsl_lv0070->lv003*1000;?>);
function setReload()
{
	var o=document.frmadd;
	o.submit();
}
//setTimer();
viewkiemkho();
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



/* End timer */
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>