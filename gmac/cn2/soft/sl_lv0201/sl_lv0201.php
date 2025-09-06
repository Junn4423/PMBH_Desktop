<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0013.php");
require_once("$vDir../clsall/sl_lv0014.php");
require_once("$vDir../clsall/sl_lv0070.php");
require_once("$vDir../clsall/wh_lv0010.php");
require_once("$vDir../clsall/wh_lv0011.php");
require_once("$vDir../clsall/sl_lv0059.php");
require_once("$vDir../clsall/sl_lv0001.php");
require_once("$vDir../clsall/mn_lv0005.php");
require_once("$vDir../clsall/sl_lv0007.php");
require_once("$vDir../clsall/wh_lv0034.php");
////////init object////////////////////
	$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvsl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');	
	$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvsl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvmn_lv0005=new mn_lv0005($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvwh_lv0034=new wh_lv0034($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvsl_lv0070->LV_Load();
	$lvsl_lv0013->obj_conf=$lvsl_lv0070;
	$lvsl_lv0013->mosl_lv0014=$lvsl_lv0014;
$vNow=GetServerDate();	
$lvsl_lv0059->LV_LoadActive();
if($lvsl_lv0059->lv001!='' && $lvsl_lv0059->lv001!=NULL)
{
	if($lvsl_lv0059->NumLine==1)	$lvsl_lv0013->LV_ChangeShiftAutoUpdate($lvsl_lv0059->lv001);
}
if($lvsl_lv0013->GetAdd()>0)
{
if(isset($_GET['ajaxitemsend']))
{
	
	$vTraHang=$_GET['trahang'];
	$vItemID=$_GET['ItemID'];
	$vBangID=$_GET['BangID'];
	$vOrder=$_GET['Order'];	
	$vCusID=$_GET['CusID'];
	$vprogid='';
	if($lvsl_lv0070->lv031==1)
	{
		$vprogid=$_GET['progid'];
		$lvsl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
		$lvsl_lv0059->LV_LoadID($vprogid);
	}
	if($vprogid=='')
	{
		$lvsl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
		$vprogid=$lvsl_lv0059->LV_ConfirmProgramCus($vCusID);
		if(trim($vprogid)!='')
		{
			$lvsl_lv0059->LV_LoadID($vprogid);
		}
		else
		{
			$lvsl_lv0059->LV_LoadActive();
		}
	}
	$vAddState=$_GET['AddState'];
	$lvsl_lv0007->LV_LoadID($vItemID);
	if($lvsl_lv0007->lv001==NULL)
	{
		$lvmn_lv0005->LV_LoadID($vItemID);
		if($lvmn_lv0005->lv001==NULL)
			$vItemID='';
		else
		$vItemID=$lvmn_lv0005->lv002;
	}
	
	$vContractID=$_GET['ContractID'];
	$vBlock=0;
	if($vContractID=="" || $vContractID==NULL)
	{
		$vContractID=$lvsl_lv0013->LV_ExistEmp($lvsl_lv0013->LV_UserID,$vBangID,$vBlock);
	}
	else
	{
		$lvsl_lv0013->LV_LoadID($vContractID);
		$vBlock=$lvsl_lv0013->lv031;
	}
	if($vContractID=="" || $vContractID==NULL)
	{
		$vContractID=getyear($vNow).getmonth($vNow).getday($vNow).rand(0,9).rand(100,999);//InsertWithCheck('sl_lv0013', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);
		if($lvsl_lv0013->GetApr()==0) $lvsl_lv0013->lv010=$lvsl_lv0013->LV_UserID;
		if($lvsl_lv0013->lv010=="") $lvsl_lv0013->lv010=$lvsl_lv0013->LV_UserID;
		$lvsl_lv0013->lv023=$lvsl_lv0013->LV_UserID;
		$lvsl_lv0013->lv004=$lvsl_lv0013->FormatView($vNow,2)." ".GetServerTime();
		$lvsl_lv0013->lv001=$vContractID;
		$lvsl_lv0013->lv002=$vCusID;
		$lvsl_lv0013->lv006=0;
		$lvsl_lv0013->lv002=str_replace("Mã KH","",$lvsl_lv0013->lv002);
		//if($lvsl_lv0059->lv009>0) $lvsl_lv0013->lv022=$lvsl_lv0059->lv009;
		if($lvsl_lv0070->lv013>0) 
			$lvsl_lv0013->lv027=1;
		else
			$lvsl_lv0013->lv027=0;
		$lvsl_lv0013->lv007=$vBangID;	
		if($lvsl_lv0059->lv009>0) $lvsl_lv0013->lv022=$lvsl_lv0059->lv009;
		$vresult=$lvsl_lv0013->LV_Insert();
		if($vresult==false)
		{
			$vContractID=getyear($vNow).getmonth($vNow).getday($vNow).rand(0,9).rand(100,999);//InsertWithCheck('sl_lv0013', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);
			$lvsl_lv0013->lv001=$vContractID;
			$vresult=$lvsl_lv0013->LV_Insert();
			if($vresult==false) $vContractID="";
		}
	}
	echo '[CHECKHOPDONG]';
	echo $vContractID;
	echo '[ENDCHECKHOPDONG]';
	echo '[CHECKORDER]';
	echo $vOrder;
	echo '[ENDCHECKORDER]';
	echo '[CHECKBLOCK]';
	echo $vBlock;
	echo '[ENDCHECKBLOCK]';
	if($vContractID!="" && $vContractID!=NULL )
	{
		if($vBlock==0)
		{
		$vItemIDPref=$lvsl_lv0014->LV_CheckPriceItem($vContractID,$vItemID,$vprogid,$vPercent,$vPrice,$vPoint,$vBuy11);
		//$vItemIDPref=$lvsl_lv0014->LV_CheckExitItemBuy11($vContractID,$vprogid,$vItemID);
		//$vDetailID=$lvsl_lv0014->LV_CheckExitItem($vContractID,$vItemID);
		/*if($vDetailID!='' && $vDetailID!=NULL)
			$vsql="update sl_lv0014 set lv004=lv004+1 where lv001='$vDetailID'";
		else*/
		if($vAddState==1)
		{
			switch($lvsl_lv0070->lv017)
			{
				case 1:
				case 2:
					if($vTraHang==1) 
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016,lv100) select '$vContractID','$vItemID',-1,A.lv004,'".$lvsl_lv0070->lv018."',A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref',1 from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					else	
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016,lv100) select '$vContractID','$vItemID',1,A.lv004,'".$lvsl_lv0070->lv018."',A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref',1 from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					break;
				case 0:
				default:
					if($vTraHang==1) 
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016) select '$vContractID','$vItemID',-1,A.lv004,IF($vPrice=0,A.lv007,$vPrice),A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref' from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";	
					else
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016) select '$vContractID','$vItemID',1,A.lv004,IF($vPrice=0,A.lv007,$vPrice),A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref' from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					break;
			}
		}
		else
		{
			switch($lvsl_lv0070->lv017)
			{
				case 2:
					if($vTraHang==1) 
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016,lv100) select '$vContractID','$vItemID',-1,A.lv004,'".$lvsl_lv0070->lv018."',A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref',1 from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					else
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016,lv100) select '$vContractID','$vItemID',1,A.lv004,'".$lvsl_lv0070->lv018."',A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref',1 from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					break;
				case 1:
				case 0:
				default:
					if($vTraHang==1) 
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016) select '$vContractID','$vItemID',-1,A.lv004,IF($vPrice=0,A.lv007,$vPrice),A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref' from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					else
						$vsql="insert into sl_lv0014(lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv011,lv012,lv014,lv016) select '$vContractID','$vItemID',1,A.lv004,IF($vPrice=0,A.lv007,$vPrice),A.lv008,0,'$vPercent','$vPoint',concat(CurDate(),' ',CurTime()),'$vItemIDPref' from all_gmacv3_0.sl_lv0007 A where lv001='$vItemID'";
					break;
			}
		}
		$vresult=db_query($vsql);
		if($vresult)
		{
			if($lvsl_lv0059->lv009>0) 
				$vsql="update sl_lv0013 set lv026='0',lv022='".$lvsl_lv0059->lv009."' where lv001='$vContractID' and lv011=0";
			else
				$vsql="update sl_lv0013 set lv026='0',lv022=0 where lv001='$vContractID' and lv011=0";
			$vresult=db_query($vsql);
			$vsql="update sl_lv0007 set lv020=lv020+1 where lv001='$vItemID'";
			$vresult=db_query($vsql);
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="EN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			echo $lvsl_lv0013->LV_GetDetail($vContractID,$vOrder,$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[HOPDONGSUM]';
			echo $lvsl_lv0013->FormatView($vSum,10);
			echo '[ENDHOPDONGSUM]';
			echo '[HOPDONGUNG]';
			echo $lvsl_lv0013->FormatView($vSum-$lvsl_lv0013->LV_GetPTMoney($vContractID),10);
			echo '[ENDHOPDONGUNG]';
			
		}
		}
		else
		{
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="EN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			echo $lvsl_lv0013->LV_GetDetail($vContractID,$vOrder,$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[HOPDONGSUM]';
			echo $lvsl_lv0013->FormatView($vSum,10);
			echo '[ENDHOPDONGSUM]';
			echo '[HOPDONGUNG]';
			echo $lvsl_lv0013->FormatView($vSum-$lvsl_lv0013->LV_GetPTMoney($vContractID),10);
			echo '[ENDHOPDONGUNG]';
		}
	}
	exit;
	
}
if(isset($_GET['ajaxbangvat']))
{
	$vdonhangid=$_GET['donhangid'];
	$vTax=$_GET['taxonline'];
	if($vdonhangid!='' && $vdonhangid!=NULL)
	{
		$vsql="update sl_lv0013 set lv006=$vTax where lv001='$vdonhangid' and lv011=0";
		$vresult=db_query($vsql);
	}
}
if(isset($_GET['ajaxcustomertext']))
{
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001->LV_LoadID($vcusid);
	if($lvsl_lv0001->lv001=="" || $lvsl_lv0001->lv001==NULL)
	{
		$lvsl_lv0001->lv001=$vcusid;
		$lvsl_lv0001->lv002=$vcusid;
		
		$lvsl_lv0001->lv024=GetServerDate()." ".GetServerTime();
		$lvsl_lv0001->lv025=$lvsl_lv0013->LV_UserID;
		$lvsl_lv0001->LV_Insert();
	}
	$vText=$_GET['textup'];
	$voption=$_GET['optrun'];
	if($vcusid!='' && $vcusid!=NULL)
	{
		switch($voption)
		{
			case 2:
				$vsql="update all_gmacv3_0.sl_lv0001 set lv002='$vText' where lv001='$vcusid'";
			break;
			case 6:
				$vsql="update all_gmacv3_0.sl_lv0001 set lv006='$vText' where lv001='$vcusid'";
			break;
			case 16:
				$vsql="update all_gmacv3_0.sl_lv0001 set lv010='$vText' where lv001='$vcusid'";
			break;
			case 23:
				$vsql="update all_gmacv3_0.sl_lv0001 set lv023='$vText' where lv001='$vcusid'";
			break;
		}
		
		$vresult=db_query($vsql);
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
		echo '[CHECKKH]';	
		echo $_GET['bangid'];
		echo '[ENDCHECKKH]';
		echo '[CHECKKHNAME]';
		echo $vText;
		echo '[ENDCHECKKHNAME]';
		switch($voption)
		{
			case 1:
				$vText=str_replace("Mã KH","",$vText);
				$vsql="update sl_lv0013 set lv002='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
			case 2:
				$vsql="update sl_lv0013 set lv003='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
			case 3:
				$vsql="update sl_lv0013 set lv009='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
			case 4:
				$vsql="update sl_lv0013 set lv013='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
			case 99:
				$vsql="update sl_lv0013 set lv099='$vText' where lv001='$vdonhangid' and lv011=0";
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
				$vsql="update sl_lv0013 set lv099='$vText' where lv001='$vdonhangid' and lv011=0";
			break;
		}		
		$vresult=db_query($vsql);
	}
	$vCurHD=$lvsl_lv0013->LV_GetTimeInvoice($vdonhangid);
	$vsum=$lvsl_lv0013->LV_GetContractMoneyConLai($vdonhangid,$vCurHD['VAT']);
		echo '[CHECKDONHANG]';	
		echo $_GET['bangid'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[DONHANGMONEY]';
			echo $lvsl_lv0013->FormatView($vsum,10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $vCurHD['CusMoney'];
		echo '[ENDDONHANGMONEYCL]';
		echo '[HOPDONGTONG]';
			echo $lvsl_lv0013->FormatView($vCurHD['CusMoney']-$vsum,10);
	echo '[ENDHOPDONGTONG]';
	exit;
}
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
			$vsql="update sl_lv0014 set lv017='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
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
if(isset($_GET['ajaxquantitycalcsend']))
{
	$vQty=$lvsl_lv0014->LV_UpdateCalc($_GET['chitietid']);	
	exit;
}
}	
	
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0027.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($lvsl_lv0013->GetAdd()>0)
{
if(isset($_GET['ajaxphone']))
{
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvsl_lv0001->LV_LoadPhoneID($vcusid);
	echo '[CHECKORDER]';
	echo $_GET['order'];
	echo '[ENDCHECKORDER]';
	echo '[CHECKIDORDER]';
	echo $lvsl_lv0001->lv001;
	echo '[ENDCHECKIDORDER]';
	echo '[DOANHCHECK]';
	echo $lvsl_lv0013->LV_ListPopupYear($lvsl_lv0001->lv001,getyear($vNow),$_GET['order']);
	echo '[ENDDOANHCHECK]';	
	echo '[CHECK]';
	echo $lvsl_lv0001->lv002;
	echo '[ENDCHECK]';
	echo '[TCHECK]';
	echo $lvsl_lv0001->lv006;
	echo '[ENDTCHECK]';
	echo '[SCHECK]';
	echo $lvsl_lv0001->lv010;
	echo '[ENDSCHECK]';
	exit;
}
if(isset($_GET['ajax']))
{
	$vcusid=$_GET['cusid'];
	$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	$lvsl_lv0001->LV_LoadID($vcusid);
	echo '[CHECKORDER]';
	echo $_GET['order'];
	echo '[ENDCHECKORDER]';
	echo '[DOANHCHECK]';
		echo $lvsl_lv0013->LV_ListPopupYear($lvsl_lv0001->lv001,getyear($vNow),$_GET['order']);
	echo '[ENDDOANHCHECK]';
	echo '[CHECK]';
	echo $lvsl_lv0001->lv002;
	echo '[ENDCHECK]';
	echo '[TCHECK]';
	echo $lvsl_lv0001->lv006;
	echo '[ENDTCHECK]';
	echo '[SCHECK]';
	echo $lvsl_lv0001->lv010;
	echo '[ENDSCHECK]';
	$donhangid=$_GET['donhangid'];
	if($donhangid!="" && $donhangid!=NULL)
	{
		$vprogid=$lvsl_lv0059->LV_ConfirmProgramCus($vcusid);
		if(trim($vprogid)!='')
		{
			$lvsl_lv0059->LV_LoadID($vprogid);
			echo '[PROGCKTM]';
			echo $lvsl_lv0059->lv009;
			$vsql="update sl_lv0013 set lv022='".$lvsl_lv0059->lv009."' where lv001='".$donhangid."' and lv011<=0";
			db_query($vsql);
			echo '[ENDPROGCKTM]';
		}
		else
		{
			$lvsl_lv0059->LV_LoadActive();
			echo '[PROGCKTM]';
			echo $lvsl_lv0059->lv009;
			$vsql="update sl_lv0013 set lv022='".$lvsl_lv0059->lv009."' where lv001='".$donhangid."' and lv011<=0";
			db_query($vsql);
			echo '[ENDPROGCKTM]';
		}
		echo '[PROGCHECK]';
		echo $vprogid;
		echo '[ENDPROGCHECK]';
		if($vprogid!="" && $vprogid!=NULL)
		{
			$vsql="select A.*,B.lv001 CusID from sl_lv0014 A left join all_gmacv3_0.sl_lv0001 B on concat(A.lv008,'')=B.lv001 where A.lv002='$donhangid' and A.lv100=0";
			$vresult=db_query($vsql);
			while($vrow = db_fetch_array ($vresult))
			{
				if($vrow['CusID']!="" && $vrow['CusID']!=NULL &&  trim($vrow['CusID'])!='0')
				{
					$vSetUpdate="";
				}
				else
				{
					$vSetUpdate="";
					$vchitietid=$vrow['lv001'];
					$vItemID=$vrow['lv003'];
					$vContractID=$vrow['lv002'];
					$vItemIDPref=$lvsl_lv0014->LV_CheckPriceItem($vContractID,$vItemID,$vprogid,$vPercent,$vPrice,$vPoint,$vBuy11);
					if($vPrice!=0) 
					{
					$vSetUpdate=",lv006='".$vPrice."'";
					$vLoad=true;
					}
					if($vPercent>=0)
					{
						$vSetUpdate=$vSetUpdate.",lv011='".$vPercent."'";
						$vLoad=true;
					}
					if($vSetUpdate!="")
					{
						$vsql="update sl_lv0014 set lv002=lv002".$vSetUpdate." where lv001='".$vchitietid."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
						db_query($vsql);
					}
				}
			}
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="EN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			echo $lvsl_lv0013->LV_GetDetail($donhangid,$_GET['order'],$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[DONHANGMONEY]';
			echo $lvsl_lv0013->FormatView($vSum,10);
			echo '[ENDDONHANGMONEY]';
		}
		else
		{
			$vsql="select A.*,B.lv001 CusID from sl_lv0014 A left join all_gmacv3_0.sl_lv0001 B on concat(A.lv008,'')=B.lv001 where A.lv002='$donhangid'";
			$vresult=db_query($vsql);
			while($vrow = db_fetch_array ($vresult))
			{
				$vchitietid=$vrow['lv001'];
				if($vrow['CusID']!="" && $vrow['CusID']!=NULL &&  trim($vrow['CusID'])!='0')
				{
					$vSetUpdate="";
				}
				else
				{
					$vsql="update sl_lv0014 set lv011='0' where lv001='".$vchitietid."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
					db_query($vsql);
				}
			}
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="EN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			echo $lvsl_lv0013->LV_GetDetail($donhangid,$_GET['order'],$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[DONHANGMONEY]';
			echo $lvsl_lv0013->FormatView($vSum,10);
			echo '[ENDDONHANGMONEY]';
		}
	}
	else
	{
		$vprogid=$lvsl_lv0059->LV_ConfirmProgramCus($vcusid);
		if(trim($vprogid)!='')
		{
			$lvsl_lv0059->LV_LoadID($vprogid);
			echo '[PROGCKTM]';
			echo $lvsl_lv0059->lv009;
			echo '[ENDPROGCKTM]';
		}
		else
		{
			echo '[PROGCKTM]';
			echo '0';
			echo '[ENDPROGCKTM]';
		}
	}
	
	
	exit;
}
if(isset($_GET['ajaxaproval']))
{
	//if($lvsl_lv0013->GetEdit()>0)
	{
		$vtrangthai=$_GET['trangthai'];
		echo '[CHECKSTATE]';
		echo $vtrangthai;
		echo '[ENDCHECKSTATE]';
			if($vtrangthai==2)
			{
				$cusid=$_GET['cusid'];
				if(trim($cusid)=='' || $cusid=='Mã KH')
					$vsql="update sl_lv0013 set lv002='',lv003='',lv011=2,lv005=concat(curdate(),' ',curtime()),lv032='".$lvsl_lv0013->LV_UserID."' where lv001='".$_GET['donhangid']."' and lv011=0";
				else
				{
					//$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
					//$lvsl_lv0001->LV_LoadID($cusid);
					$vsql="update sl_lv0013 set  lv011=2,lv005=concat(curdate(),' ',curtime()),lv032='".$lvsl_lv0013->LV_UserID."' where lv001='".$_GET['donhangid']."' and lv011=0";
				}
				$lvwh_lv0034->LV_LoadUser($_SESSION['ERPSOFV2RUserID']);
				if($_SESSION['ERPSOFV2RUserID']=='admin') $lvwh_lv0034->lv003='KHOTONG';
				if(($lvwh_lv0034->lv003!=NULL && trim($lvwh_lv0034->lv003)!=''))
				{
					$vWarehouseID=$lvwh_lv0034->lv003;
					$lvwh_lv0010=new wh_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
					$lvwh_lv0011=new wh_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
					if($lvwh_lv0010->LV_CheckData($_GET['donhangid'],$vWarehouseID))
					{
						$lvwh_lv0010->lv001=str_replace(" ","",'PX-'.str_replace(":","",str_replace("/","",$lvwh_lv0010->DateCurrent))."-".rand(0,100));
						$lvwh_lv0010->lv002=$vWarehouseID;
						$lvwh_lv0010->lv003=$lvwh_lv0010->LV_UserID;
						$lvwh_lv0010->lv004=$_POST['txtlv004'];
						$lvwh_lv0010->lv005='CONTRACT';
						$lvwh_lv0010->lv006=$_GET['donhangid'];
						$lvwh_lv0010->lv007=0;	
						$lvwh_lv0010->lv008=$_POST['txtlv008'];
						$lvwh_lv0010->lv009=$_POST['txtlv009'];
						$lvwh_lv0010->lv010=$_POST['txtlv010'];
						$lvwh_lv0010->lv011=$lvsl_lv0013->LV_UserID;;
						$vresult=$lvwh_lv0010->LV_Insert();
						if($vresult)
						{
							$vresult1=$lvwh_lv0011->LV_InsertTempSL($lvwh_lv0010->lv001,$_GET['donhangid'],$vWarehouseID);
						}
						
					}
				}
			}
			else if($vtrangthai==3)
				$vsql="update sl_lv0013 set lv011=2 where lv001='".$_GET['donhangid']."' and lv011=1";
			else if($vtrangthai==4)
				$vsql="update sl_lv0013 set lv011=3,lv005=concat(curdate(),' ',curtime()),lv032='".$lvsl_lv0013->LV_UserID."' where lv001='".$_GET['donhangid']."' and lv011=0";
			else if($vtrangthai==5)
			{
				$vsql="update sl_lv0013 set lv013=concat(lv013,'<br/>NV order/KT báo/bỏ báo bill:','".$lvsl_lv0013->LV_UserID."','---Ngày giờ:',now()) where lv001='".$_GET['donhangid']."' and lv011=0";
				$vresult=db_query($vsql);
				$vsql="update sl_lv0013 set lv030=IF(lv030=2,1,2),lv018='".$lvsl_lv0013->LV_UserID."' where lv001='".$_GET['donhangid']."' and lv011=0";				
			}
			else if($vtrangthai==15)
			{
				$vsql="update sl_lv0013 set lv013=concat(lv013,'<br/>Người chấp nhận:','".$lvsl_lv0013->LV_UserID."','---Ngày giờ:',now()) where lv001='".$_GET['donhangid']."' and lv011=0";				
			}
			else if($vtrangthai==7)
			{
				$vsql="update sl_lv0013 set lv013=concat(lv013,'<br/>Kế toán khoá/mở khoá tạm tính bill:','".$lvsl_lv0013->LV_UserID."','---Ngày giờ:',now()) where lv001='".$_GET['donhangid']."' and lv011=0";
				$vresult=db_query($vsql);
				$vsql="select lv031 from sl_lv0013 where lv001='".$_GET['donhangid']."'";
				$vresult=db_query($vsql);
				$vrow = db_fetch_array ($vresult);
				echo '[CHECKBLOCK]';
				echo ($vrow['lv031']==0)?1:0;
				echo '[ENDCHECKBLOCK]';
				$vsql="update sl_lv0013 set lv031=IF(lv031=1,0,1),lv018='".$lvsl_lv0013->LV_UserID."' where lv001='".$_GET['donhangid']."' and lv011=0";				
			}
			else
				$vsql="update sl_lv0013 set lv011=1,lv005=concat(curdate(),' ',curtime()),lv032='".$lvsl_lv0013->LV_UserID."' where lv001='".$_GET['donhangid']."' and lv011=0";
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
			else if($vtrangthai==15)
			{
				$vsql="update sl_lv0013 set lv013=concat(lv013,'<br/>NV chấp nhận bill xuống bếp/bar:','".$lvsl_lv0013->LV_UserID."','---Ngày giờ:',now()) where lv001='".$_GET['donhangid']."' and lv011=0";
				$vresult=db_query($vsql);
				$vsql="select lv011 from sl_lv0013 where lv001='".$_GET['donhangid']."'";
				$vresult=db_query($vsql);
				$vrow = db_fetch_array ($vresult);
				if ($vrow['lv011']=='0')
				{
					$vsql="update sl_lv0014 set lv017=1,lv018=1,lv013=concat(curdate(),' ',curtime()),lv020='".$lvsl_lv0102->LV_UserID."' where lv017=0 and lv002 in (select A.lv001 from sl_lv0013 A where A.lv001='".$_GET['donhangid']."' and A.lv011=0)";
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
if(isset($_GET['ajaxgopban']))
{
	//if($lvsl_lv0102->GetEdit()>0)
	{
	echo '[CHECKGOPBAN]';
		if((int)$_GET['delbang']==0)
		{
			$vsql="update sl_lv0013 set lv024=concat(IF(ISNULL(lv024),'',lv024),',','".$_GET['bangid']."') where lv001='".$_GET['donhangid']."'";
			$vresult=db_query($vsql);	
			$vsql="select lv001 from sl_lv0013 BB where BB.lv007='".$_GET['bangid']."'  and BB.lv011=0 limit 0,1";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				$vMaDonHang=$vrow['lv001'];
				$vsql="insert into sl_lv0014 ( lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv102) 
				select MP.* from (select '".$_GET['donhangid']."',lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,'$vMaDonHang' from sl_lv0014 where lv002='".$vMaDonHang."') MP";
				$vresult=db_query($vsql);	
				$vsql="delete  from sl_lv0014 where lv002='".$vMaDonHang."'";
				$vresult=db_query($vsql);	
				$vsql="update  sl_lv0013 set lv011=-1 where lv001='".$vMaDonHang."'";
				$vresult=db_query($vsql);	
			}	
		}
		else
		{
			$vsql="update sl_lv0013 set lv024=REPLACE(lv024,',".$_GET['bangid']."','') where lv001='".$_GET['donhangid']."'";
			$vresult=db_query($vsql);	
								
		}
		echo $_GET['bangid'];
		echo '[ENDCHECKGOPBAN]';
		echo '[DONHANGNHAN]';
			echo $_GET['donhangid'];
		echo '[ENDDONHANGNHAN]';
	}
	exit;
}

if(isset($_GET['ajaxbangid']))
{
	$vbangid=$_GET['bangid'];
	$vsql="select * from sl_lv0013 BB where BB.lv007='$vbangid'  and BB.lv011=0 limit 0,1";
	$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
					echo '[CHECKBANGOK]';
						echo 1;
					echo '[ENDCHECKBANGOK]';
					echo '[CHECKBANGID]';
						echo $vrow['lv002'];
					echo '[ENDCHECKBANGID]';
					echo '[CHECK1BANGID]';
						echo $vrow['lv003'];
					echo '[ENDCHECK1BANGID]';
					echo '[CHECK2BANGID]';
						echo $vrow['lv009'];
					echo '[ENDCHECK2BANGID]';
					echo '[CHECK3BANGID]';
						echo $vrow['lv014'];
					echo '[ENDCHECK3BANGID]';
					echo '[CHECK4BANGID]';
						echo $vrow['lv013'];
					echo '[ENDCHECK4BANGID]';
			}
}
/////////////////////////////////////////////////////////////////////Moi them
if(isset($_GET['ajaxbangchitiet']))
{
	$vBangID=$_GET['bangid'];
	$vContractID=$_GET['hopdongid'];
	$vSum="";
	if($plang=="") $plang="EN";
		$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	echo '[NVLAYDULIEUCT]';
	echo $lvsl_lv0013->LV_GetDetail($vContractID,$vBangID,$vLangArr,$vSum);
	echo '[ENDNVLAYDULIEUCT]';
	exit;
}
/////////////////////////////////////////////////////////////////////Moi them
if(isset($_GET['ajaxquantity']))
{
	//if($lvsl_lv0013->GetEdit()>0)
	{
	echo '[CHECKDONHANG]';
		$optqty=(int)$_GET['optqty'];
		$vLoad=false;
		$vdata=$lvsl_lv0013->LV_GetBH_Invoice($_GET['chitietid']);
		if($vdata[4]==0)
		{
			if($optqty==2)
			{
					$vsql="update sl_lv0014 set lv010='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
			}
			else
				if($_GET['optdel']!=1) $vsql="update sl_lv0014 set lv103=lv004,lv004='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
			$vresult=db_query($vsql);	
			
			
			if($_GET['qty']<=0 && $_GET['optdel']==1) 
			{
				$vsql="select lv002 from sl_lv0014 BB where BB.lv001='".$_GET['chitietid']."'";
				$vresult=db_query($vsql);
				$vrow=db_fetch_array($vresult);
				$vContractID=$vrow['lv002'];
				$lvsl_lv0014->LV_DeleteNoApr($_GET['chitietid']);
				$vdata=$lvsl_lv0013->LV_GetBH_InvoiceParent($vContractID);
			}
			else
			{
				$vdata=$lvsl_lv0013->LV_GetBH_Invoice($_GET['chitietid']);
			}
			
			
		}
		echo $_GET['bangid'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[CHECKBLOCK]';
		echo $vdata[4];
		echo '[ENDCHECKBLOCK]';
		echo '[DONHANGMONEY]';
			echo $lvsl_lv0013->FormatView($vdata[2],10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $lvsl_lv0013->FormatView($vdata[3]-$vdata[2],10);
		echo '[ENDDONHANGMONEYCL]';
		echo '[HOPDONGUNG]';
			echo $lvsl_lv0013->FormatView($vdata[2]-$lvsl_lv0013->LV_GetPTMoney($vdata[0]),10);
		echo '[ENDHOPDONGUNG]';
		if($vdata[4]==1)
		{
			echo '[HOPDONGMONEY]';
			if($plang=="") $plang="EN";
			$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
			$vSum=$vdata[3];
			echo $lvsl_lv0013->LV_GetDetail($vdata[0],$vdata[1],$vLangArr,$vSum);
			echo '[ENDHOPDONGMONEY]';
			echo '[HOPDONGSUM]';
			echo $lvsl_lv0013->FormatView($vSum,10);
			echo '[ENDHOPDONGSUM]';
			echo '[HOPDONGUNG]';
			echo $lvsl_lv0013->FormatView($vdata[4],10);
			echo '[ENDHOPDONGUNG]';
		}
		}
	exit;
}
if(isset($_GET['ajaxprice']))
{
	//if($lvsl_lv0013->GetEdit()>0)
	{
	$vLoad=false;
	$voptprice=$_GET['optprice'];
	echo '[CHECKDONHANG]';
		switch($voptprice)
		{
			case 1:
				$vsql="update sl_lv0014 set lv006='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
				break;
			case 3:
				$vsql="update sl_lv0014 set lv011='".$_GET['price']."' where lv100=0 and lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
				break;
			case 4:
				$vsql="update sl_lv0014 set lv021='".$_GET['price']."' where lv100=0 and lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
				break;
			case 15:	
					$vcusid=$_GET['price'];
					$lvsl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
					$lvsl_lv0001->LV_LoadID($vcusid);	
					$vStrGia="[DONHANGPRICE][ENDDONHANGPRICE]";
					$vStrPercent="[DONHANGPERCENT][ENDDONHANGPERCENT]";
					if($lvsl_lv0001->lv001!="" && $lvsl_lv0001->lv001!=NULL)
					{
						$vSetUpdate="";
						$vprogid=$lvsl_lv0059->LV_GetProgCus($lvsl_lv0001->lv022);
						if($vprogid!="" && $vprogid!=NULL)
						{
							$lvsl_lv0014->LV_LoadID($_GET['chitietid']);
							$vItemID=$lvsl_lv0014->lv003;
							$vContractID=$lvsl_lv0014->lv002;
							$vItemIDPref=$lvsl_lv0014->LV_CheckPriceItem($vContractID,$vItemID,$vprogid,$vPercent,$vPrice,$vPoint,$vBuy11);
							
							if($vPrice!=0) 
							{
							$vStrGia="[DONHANGPRICE]".$vPrice."[ENDDONHANGPRICE]";
							$vSetUpdate=",lv006='".$vPrice."'";
							$vLoad=true;
							}
							if($vPercent>=0)
							{
								$vStrPercent="[DONHANGPERCENT]".$vPercent."[ENDDONHANGPERCENT]";
								$vSetUpdate=$vSetUpdate.",lv011='".$vPercent."'";
								$vLoad=true;
							}
							$vsql="update sl_lv0014 set lv015='".$_GET['price']."'".$vSetUpdate." where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
						}
						else
						$vsql="update sl_lv0014 set lv015='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
					}
					else
						$vsql="update sl_lv0014 set lv015='".$_GET['price']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
				break;
		}
		$vresult=db_query($vsql);	
		$vdata=$lvsl_lv0013->LV_GetBH_Invoice($_GET['chitietid']);
		if($_GET['qty']<=0 && $_GET['optdel']==1) $lvsl_lv0104->LV_Delete($_GET['chitietid']);
		echo $_GET['bangid'];
		//echo $vdata[1];
		echo '[ENDCHECKDONHANG]';
		echo '[DONHANGMONEY]';
			echo $lvsl_lv0013->FormatView($vdata[2],10);
		echo '[ENDDONHANGMONEY]';
		echo '[DONHANGMONEYCL]';
			echo $lvsl_lv0013->FormatView($vdata[3]-$vdata[2],10);
		echo '[ENDDONHANGMONEYCL]';
		echo '[HOPDONGUNG]';
			echo $lvsl_lv0013->FormatView($vdata[2]-$lvsl_lv0013->LV_GetPTMoney($vdata[0]),10);
	echo '[ENDHOPDONGUNG]';
		if($vLoad)
		{
			echo '[DONHANGDETAIL]';
			echo $_GET['chitietid'];
			echo '[ENDDONHANGDETAIL]';
			echo $vStrGia;
			echo $vStrPercent;
		}
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
					echo '('.$lvsl_lv0014->FormatView($vrow['num'],10).'sp -> '.$lvsl_lv0014->FormatView($vrow['score'],10).'đ)<input type="hidden" name="txtlvnumber" type="text" id="txtlvnumber" value="'.$vrow['num'].'"/><input type="hidden" name="txtlvscore" type="text" id="txtlvscore" value="'.$vrow['score'].'"/>';
					$vstrchild=$lvsl_lv0014->LV_LinkField('lv016',$Arr);
					if($vstrchild=="")	
						echo '<input type="hidden" name="txtlv916" id="txtlv916" value=""/>';
					else
					{
					}
						echo '<select name="txtlv916" id="txtlv916"   tabindex="25"  style="width:150px" onkeypress="return CheckKey(event,1)" />'.$vstrchild.'<option value="">...none...</option></select>	';
					echo '[ENDCHECKDEF]';
					echo '[CHECKDIS]';
					echo $lvsl_lv0014->FormatView($vrow['discount'],10);
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
//$lvsl_lv0013->LV_CheckSQL();
$flagCtrl = (int)$_POST['txtFlag'];
//Lấy mã phiếu nhập kho
$lvsl_lv0013->lv001=$lvsl_lv0013->LV_Exist($_POST['txtlv807']);
if($_POST['txtdoibangid']==1)  $lvsl_lv0013->lv001=$_POST['txtlv801'];
$isExists =0;//$lvsl_lv0013->LV_Exist($lvsl_lv0013->lv001);
if($lvsl_lv0013->lv001=='') 
	$lvsl_lv0013->lv001=InsertWithCheck('sl_lv0013', 'lv001', 'BH-'.getmonth($vNow)."/".getyear($vNow)."-",1);
else
	$isExists=1;

$lvsl_lv0013->lv009=$_POST['txtlv809'];
$lvsl_lv0013->lv010=$_POST['txtlv810'];
if($lvsl_lv0013->GetApr()==0) $lvsl_lv0013->lv010=$lvsl_lv0013->LV_UserID;
if($lvsl_lv0013->lv010=="") $lvsl_lv0013->lv010=$lvsl_lv0013->LV_UserID;
$lvsl_lv0013->lv023=$lvsl_lv0013->LV_UserID;
$lvsl_lv0013->lv004=$vNow." ".GetServerTime();
$lvsl_lv0013->lv005=$_POST['txtlv805'];
if($lvsl_lv0013->lv005=="") $lvsl_lv0013->lv005=LV_DATE_ADD($vNow,30);
if($flagCtrl == 1){
$lvsl_lv0013->lv002=str_replace("Mã KH","",$_POST['txtlv802']);
$lvsl_lv0013->lv003=str_replace("Tên khách hàng","",$_POST['txtlv803']);
$lvsl_lv0013->lv006=$_POST['txtlv806'];
$lvsl_lv0013->lv007=$_POST['txtlv807'];	
$lvsl_lv0013->lv008=$_POST['txtlv808'];
$lvsl_lv0013->lv009=str_replace("Địa chỉ thường trú/tạm trú","",$_POST['txtlv809']);
$lvsl_lv0013->lv011=$_POST['txtlv811'];
$lvsl_lv0013->lv012=$_POST['txtlv812'];
$lvsl_lv0013->lv013=str_replace("Số điện thoại","",$_POST['txtlv813']);
$lvsl_lv0013->lv014=$_POST['txtlv814'];
$lvsl_lv0013->lv015=$_POST['txtlv815'];
$lvsl_lv0013->lv016=$_POST['txtlv816'];
$lvsl_lv0013->lv017=$_POST['txtlv817'];
$lvsl_lv0013->lv018=$_POST['txtlv818'];
$lvsl_lv0013->lv019=$_POST['txtlv819'];
$lvsl_lv0013->lv022=$_POST['txtlv822'];
if($lvsl_lv0013->LV_ExistTemp($lvsl_lv0013->lv023)>0)
{
	$vStrMessage = "";
	if((int)$isExists==0){
		$bResultI = $lvsl_lv0013->LV_InsertTemp();
		if($bResultI == true){
			$lvsl_lv0014->LV_InsertTemp($lvsl_lv0013->lv001,$lvsl_lv0013->LV_UserID,$lvsl_lv0013->lv002);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	} else if((int)$isExists>=1 && (int)$lvsl_lv0014->lv007==0){
			$lvsl_lv0013->LV_UpdateNoDate();
			$lvsl_lv0014->LV_InsertTemp($lvsl_lv0013->lv001,$lvsl_lv0013->LV_UserID,$lvsl_lv0013->lv002);	
			$vStrMessage = $vLangArr[9];
			$flagCtrl = 1;
	}
}
else
	{
		
	 if((int)$isExists>=1 && (int)$lvsl_lv0014->lv007==0){
			$vid=$lvsl_lv0013->LV_Exist($_POST['txtlv807']);
			if($vid!="" && $vid!=NULL)
			{
				$lvsl_lv0013->LV_InsertBoth($lvsl_lv0013->lv001,$vid);
				$lvsl_lv0013->LV_UpdateNoDate();
			}
			else
			{
				
				if($_POST['txtdoibangid']==1) $lvsl_lv0013->LV_UpdateNoDate();
			}
		}
	}
	
}
else if($flagCtrl == 10){
	$lvsl_lv0013->lv002=$_POST['txtlv802'];
$lvsl_lv0013->lv003=$_POST['txtlv803'];
$lvsl_lv0013->lv006=$_POST['txtlv806'];
$lvsl_lv0013->lv007=$_POST['txtlv807'];	
$lvsl_lv0013->lv008=$_POST['txtlv808'];
$lvsl_lv0013->lv009=$_POST['txtlv809'];
$lvsl_lv0013->lv011=$_POST['txtlv811'];
$lvsl_lv0013->lv012=$_POST['txtlv812'];
$lvsl_lv0013->lv013=$_POST['txtlv813'];
$lvsl_lv0013->lv014=$_POST['txtlv814'];
$lvsl_lv0013->lv015=$_POST['txtlv815'];
$lvsl_lv0013->lv016=$_POST['txtlv816'];
$lvsl_lv0013->lv017=$_POST['txtlv817'];
$lvsl_lv0013->lv018=$_POST['txtlv818'];
$lvsl_lv0013->lv019=$_POST['txtlv819'];
$lvsl_lv0013->lv022=$_POST['txtlv822'];
//if($lvsl_lv0013->LV_ExistTempDefault($lvsl_lv0013->lv007)>0)
{
	$vStrMessage = "";
	if((int)$isExists==0){
		$lvsl_lv0059->LV_LoadID($_POST['txtlv909']);
		$lvsl_lv0013->lv012=$lvsl_lv0059->lv001;
		if($lvsl_lv0059->lv009>0) $lvsl_lv0013->lv022=$lvsl_lv0059->lv009;
		if($lvsl_lv0070->lv013>0) 
			$lvsl_lv0013->lv027=1;
		else
			$lvsl_lv0013->lv027=0;
		$bResultI = $lvsl_lv0013->LV_InsertTemp();
		if($bResultI == true){
			$lvsl_lv0014->LV_InsertTempDefault($lvsl_lv0013->lv001,$_POST['txttyperent'],$lvsl_lv0013->lv007);
			$vStrMessage = $vLangArr[13];
			$flagCtrl = 1;
		} else{
			$vStrMessage = sof_error();
			$flagCtrl = 0;
		}
	}
	else
	{
		if(!$lvsl_lv0013->LV_ExistDetail($lvsl_lv0013->lv001,$_POST['txttyperent']))
		{
			$lvsl_lv0014->LV_InsertDeleteDefault($lvsl_lv0013->lv001,$_POST['txttyperent'],$lvsl_lv0013->lv007);
			$lvsl_lv0014->LV_InsertTempDefault($lvsl_lv0013->lv001,$_POST['txttyperent'],$lvsl_lv0013->lv007);
		}
	}
}
}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lvsl_lv0013->ArrPush[0]=$vLangArr1[17];
$lvsl_lv0013->ArrPush[1]=$vLangArr1[18];
$lvsl_lv0013->ArrPush[2]=$vLangArr1[19];
$lvsl_lv0013->ArrPush[3]=$vLangArr1[20];
$lvsl_lv0013->ArrPush[4]=$vLangArr1[21];
$lvsl_lv0013->ArrPush[5]=$vLangArr1[22];
$lvsl_lv0013->ArrPush[6]=$vLangArr1[23];
$lvsl_lv0013->ArrPush[7]=$vLangArr1[24];
$lvsl_lv0013->ArrPush[8]=$vLangArr1[25];
$lvsl_lv0013->ArrPush[9]=$vLangArr1[26];
$lvsl_lv0013->ArrPush[10]=$vLangArr1[27];
$lvsl_lv0013->ArrPush[11]=$vLangArr1[28];
$lvsl_lv0013->ArrPush[12]=$vLangArr1[29];
$lvsl_lv0013->ArrPush[13]=$vLangArr1[41];
$lvsl_lv0013->ArrPush[14]=$vLangArr1[40];
$lvsl_lv0013->ArrPush[15]=$vLangArr1[42];
$lvsl_lv0013->ArrPush[16]=$vLangArr1[45];
$lvsl_lv0013->ArrPush[17]=$vLangArr1[43];
$lvsl_lv0013->ArrPush[18]=$vLangArr1[44];
$lvsl_lv0013->ArrPush[19]=$vLangArr1[46];
$lvsl_lv0013->ArrPush[20]=$vLangArr1[47];
$lvsl_lv0013->ArrPush[21]=$vLangArr1[48];
$lvsl_lv0013->ArrPush[22]=$vLangArr1[49];
$lvsl_lv0013->ArrPush[23]=$vLangArr1[50];
$lvsl_lv0013->ArrPush[24]=$vLangArr1[51];
$lvsl_lv0013->ArrPush[25]=$vLangArr1[52];
$lvsl_lv0013->ArrPush[26]=$vLangArr1[53];
$vFieldList="lv001,lv002,lv003,lv010,lv023";
$lvsl_lv0013->LV_GetBangRun($lvsl_lv0014);
$strParent=$lvsl_lv0013->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);

if((int)$isExists>=1){
//	$lvsl_lv0013->Load($lvsl_lv0013->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<style>
@media screen and (max-width:5000px){
	.chitietbang {display:block;width:100%!important;}
	
}	
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
<style>
ul#pop-nav ul
{
	top:27px;
}
</style>
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>
	<!--
	function notSpecialChar(evt)
	{
		var e = evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
		if(charCode>=48 && charCode<=57)
		{
			return true;
		}
		if(charCode==79 || charCode==83 || charCode==8 || charCode==46 || charCode==9 || charCode==39 || charCode==13 || charCode==37) return true;  
		return false;

	}
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
	function SetDefData(vTime,vRoomid,vtang,vOrder)
	{
		viewpopcalendar(vOrder,'',vtang,vRoomid);		
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
		var o4=document.getElementById("txtorderid");	
		var o5=document.getElementById("txtAddState");
		o5.value=0;
		AddItemNew(o4.value,o1.value,o2.value,"1."+value,o3.value);
		AnNhomSanPham();
	}
	function Add()
	{
		
		var o=document.frmadd;
		var o1=document.getElementById("txtContractID");
		var o2=document.getElementById("txtbangid");
		var o3=document.getElementById("txtlv909");
		var o4=document.getElementById("txtorderid");
		var o5=document.getElementById("txtAddState");
		var o6=document.getElementById("txtlv903");
		o5.value=1;
		AddItemNew(o4.value,o1.value,o2.value,"1."+o6.value,o3.value);
		o6.value='';
		o.txtlv903.value="";
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
	function ReportWait(vValue)
	{
		var vstr="Report('"+vValue+"')";
		setTimeout(vstr,100);
	}
	function ReportCookWait(vValue)
	{
		var vstr="ReportCook('"+vValue+"')";
		setTimeout(vstr,100);
	}
/*	function Report(vValue)
	{
		var vstr="ReportMore('"+vValue+"')";
		window.setTimeout(vstr,500);
		var o1=document.getElementById("txtContractID");
		if(vValue=="") vValue=o1.value;
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
		
	}*/
	function ReportCook(vValue)
	{
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptwork&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	function Report(vValue)
	{
		
		var o1=document.getElementById("txtContractID");
		if(vValue=="") vValue=o1.value;
		var o1=document.frmprocess1;
		o1.target="_blank";
		o1.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptretailall&ID="+vValue+"&lang=<?php echo $plang;?>";
		o1.submit();
	}
	function UpdateCustomer(o,vorder,option)
{
		$xmlhttp35=null;
			cusid=document.getElementById('txtcusid_'+vorder).value;
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
function TaoBang()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDA5L3NsX2x2MDAwOS5waHA=','_self');
}
function TaoKhuVuc()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDA4L3NsX2x2MDAwOC5waHA=','_self');
}
function ChuongTrinhBH()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDU5L3NsX2x2MDA1OS5waHA=','_self');
}
function taosanpham()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMDA3L3NsX2x2MDAwNy5waHA=','_self');
}
function runbanhang()
{
	window.open('?lang=<?php echo $plang;?>&opt=22&item=&link=c2xfbHYwMjAxL3NsX2x2MDIwMS5waHA=','_self');
}

function RunDonHang()
{
	
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
	require_once("../clsall/sl_lv0009.php");
	$lvsl_lv0009=new sl_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0011');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0009->GetView())
	{
		echo '<li><div class="licafe" onclick="TaoBang()">TẠO BÀN</div></li>';
	}
	require_once("../clsall/sl_lv0008.php");
	$lvsl_lv0008=new sl_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0010');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0008->GetView())
	{
		echo '<li><div class="licafe" onclick="TaoKhuVuc()">TẠO KV</div></li>';
	}
	require_once("../clsall/sl_lv0059.php");
	$lvsl_lv0059=new sl_lv0059($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0059');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0059->GetView())
	{
		echo '<li><div class="licafe" title="Tạo chương trình" onclick="ChuongTrinhBH()">C.TRÌNH</div></li>';
	}
	require_once("../clsall/sl_lv0007.php");
	$lvsl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0008');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0007->GetView())
	{
		echo '<li><div class="licafe" title="Tạo sản phẩm" onclick="taosanpham()">TẠO SP</div></li>';
	}
	?>
		<li><div  onclick="CombackHome()" style="cursor:pointer;background:#eaeaea;padding:7px;">&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/controlright/move_f2.png" height="25" alt="Cancel" name="cancel" title="Quay lại trang chủ" border="0" align="middle" id="cancel">&nbsp;&nbsp;&nbsp;&nbsp;</li>
	</ul>
</div>
<?php
if($lvsl_lv0013->GetView()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<div id="cafetab_1" class="licafecur" onclick="viewhere(1);curtab(1);" style="display:none"></div>
<style>


</style>
<div class="hd_cafe">
	<ul class="qlycafe">
		
		<li><div id="cafetab_2" class="licafe" onclick="enablecokhach(13);setviewhere(2);curtab(2);viewfloorallscreen()"><?php echo $vLangArr[67];?></div></li>
		<li><div id="cafetab_3" class="licafe" onclick="setviewhere(2);setbancokhach(1);curtab(3);"><?php echo $vLangArr[68];?></div></li>
		<li><div id="cafetab_4" class="licafe" onclick="setviewhere(2);setbancokhach(2);curtab(4);"><?php echo $vLangArr[69];?></div></li>
		<li><div id="cafetab_5" class="licafe" onclick="setviewhere(2);setbancokhach(3);curtab(5);"><?php echo $vLangArr[86];?></div></li>
		
	</ul>
</div>
<!---------------Ban hang---------------------->
<div id="viewhere_3" style="display:none;">
	
			<div id="sanphamthuongchon" style="position:absolute;display:none;z-index:9999;width:100%;background:#fff;">
				<div style="float:left">
								<ul class="ulfix" style="padding:0px;margin:0px;">
								<?php
								if($lvsl_lv0070->lv024==0)
								{
									echo '<li>Xin vui lòng vào cấu hình số dòng hiển thị trong mục cấu hình bán hàng';
								}
								else
								{
									$vsql1="select * from all_gmacv3_0.sl_lv0007 where lv015=0 order by lv020 desc ";
									$vresult1=db_query($vsql1);
									$vWidth=$lvsl_lv0070->lv006;
									while($vrow1=db_fetch_array($vresult1))
									{
									?>
										<li style="float:left" title="<?php echo $vrow1['lv001'];?>"><div style="position:relative;" onclick="AddProd('<?php echo $vrow1['lv001'];?>')" class="buttonClass">
										<?php
										
										if($lvsl_lv0070->lv010==1 && $vrow1['lv014']!="")
										{
										?>
										<img style="width:<?php echo $vWidth;?>px;position:absolute;top:0px;left:0px" src="<?php echo $vrow1['lv014'];?>"/>
										<?php
										}?>
										<span  style="margin-left:<?php echo $vWidth;?>px;"><?php echo $vrow1['lv002'];?></span></div></li>
									<?php
									}
								}
								?>
								</ul>
							</div>
							<div style="position:absolute;top:0px;right:0px;"><img onclick="document.getElementById('sanphamthuongchon').style.display='none'" width="60" src="images/icon/closefull.png"/></div>
						</div>
						<div class="sanpham_bg" style="float:left;width:95%;cursor:pointer;" >
							<div style="float:left;width:30%;z-index:999999">
								<ul id="pop-nav" lang="pop-nav" onMouseOver="ChangeName(this,0)" onkeyup="ChangeName(this,0)" style="z-index:999999!important;">
									<li class="menupopT">
										<input aria-autocomplete="both" aria-haspopup="false" autocapitalize="off" autocomplete="off" autocorrect="off" role="combobox" spellcheck="false"  title="barcode hoặc mã sản phẩm" name="txtlv903" id="txtlv903" tabindex="200"  style="width:90%;height:25px;text-align:center;" onkeypress="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@! @!,lv001)');return CheckKeys(event,1,this);" onFocus="if(document.frmadd.txtlv903.value=='') document.frmadd.txtlv903.select()" onblur="//LoadItem();//changecategory_change(this.value)" onKeyUp="LoadPopupParent(this,'txtlv903','sl_lv0007','concat(lv002,@! @!,lv001)')" value=""/>
										<div id="lv_popup" lang="lv_popup"  style="z-index:999999!important;"> </div>
									</li>
								</ul>
							</div>
							<div style="padding-left;10px;float:left;width:30%" onclick="ShowNhomSanPham()">
								<div class="sanpham_bg_bnt" ><center>
									Chọn sản phẩm</center>
								</div>
							</div>	
							<div style="float:right;width:30%;paddinng-right:10px;" onclick="document.getElementById('sanphamthuongchon').style.display='block'">
								<div class="sanpham_bg_bnt" >
								<center>Thường chọn</center>
								</div>
							</div>	
						</div>
					
					<!--
					<td width="20%">
					<div onclick="SetTraHang()" class="sanpham_bg" style="float:left;width:100%;cursor:pointer;position:relative;" onclick="document.getElementById('sanphamthuongchon').style.display='block'">
						<div style="padding-left:10px">
							<div class="sanpham_bg_bnt" style="padding:0px;" >
						Trả hàng<br/><input  id="trahang" style="padding:0px;margin:0px;width:30px;" type="checkbox" disabled>
						</div>
						</div>	
						<div style="position:absolute;width:80%;height:27px;bottom:0;left:15px;">&nbsp;</div>
						</div>
					</td>-->
				
	</div>
</div>
<div id="viewhere_1" style="display:none;">
	<div>
		<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off" onsubmit="return false">
											<input type="hidden" name="txtAddState" id="txtAddState" value="0">
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
			
<!---------SP------------------------->
				<div class="khungsp" id="khungsp" style="position:absolute;display:none;z-index:9999;width:100%;background:#fff;top:80px;padding-bottom:10px;">
				
						<div  style="display:block;position:absolute;right:0px;top:0px;z-index:99999" >
							<div id="morelistid" style="display:none" class="morelistid">
								
								<div><?php echo $vLangArr[38];?><div id="programid"><select name="txtlv909" id="txtlv909"   tabindex="111"  style="width:80%" onkeypress="return CheckKey(event,1)" onfocus="this.title='1';"/>
																	<?php echo $lvsl_lv0014->LV_LinkFieldExt('lv099',$lvsl_lv0014->lv009);?>
																		</select></div><div style="float:right"><img onclick="document.getElementById('morelistid').style.display='none';document.getElementById('morelistidmin').style.display='block'" width="60" src="images/icon/closefull.png"/></div></div>
											 
							</div>
							<div id="morelistidmin" class="morelistidmin"><div style="float:right;padding-top:65px;"><img onclick="document.getElementById('morelistid').style.display='block';document.getElementById('morelistidmin').style.display='none'" width="20" src="images/icon/mui_ten.png"/></div></div>
						</div>
						<div style="clear:both;width:100%;overflow:hidden;" >
						<div style="float:right;width:100%;overflow: auto;position:relative;" class="thanhprocess" id="thanhprocess">
						<div style="position:absolute;top:0px;right:0px;z-index:99999999"><img onclick="AnNhomSanPham()" width="60" src="images/icon/closefull.png"/></div>
						<?php 
							$vStrAllDetail='<div class="monsp_sp" style="float:left;position:relative;">';
							$strthanh="";
							$i=0;
							$vsql="select * from all_gmacv3_0.sl_lv0006 where  lv004=0 and (ISNULL(lv003) or lv003='' or lv001=lv003) order by lv005 asc";
							$vresultparent=db_query($vsql);
							while($vrowparent=db_fetch_array($vresultparent))
							{
								$i++;
								$strthanh=$strthanh.'<div id="thanhthus_'.$i.'" onclick="viewthanhthu('.$i.')" class="thanhcon '.(($i==1)?'conactive':'').'">'.$vrowparent['lv002'].'</div>';
								$vStrAllDetail=$vStrAllDetail.'<div id="thanhthu_'.$i.'" style="clear:both;'.(($i==1)?'display:block':'display:none').'">';						
								$vsql="select distinct * from all_gmacv3_0.sl_lv0006 where (lv003='".$vrowparent['lv001']."') or ( lv001='".$vrowparent['lv001']."' and (ISNULL(lv003) or lv003='')) and lv004=0 order by lv005 asc";
								$vresult=db_query($vsql);
								while($vrow=db_fetch_array($vresult))
								{
									$vStrAllDetail=$vStrAllDetail.'<div style="float:left;position:relative;">
									<div class="groupcafe">'.$vrow['lv002'].'</div>
									<div>
										<ul class="ulfix" style="padding:0px;margin:0px;">';
										$vsql1="select * from all_gmacv3_0.sl_lv0007 where lv003='".$vrow['lv001']."' and lv015<=1 order by lv001,lv002 asc ";
										$vresult1=db_query($vsql1);
										$vWidth=$lvsl_lv0070->lv006;
										while($vrow1=db_fetch_array($vresult1))
										{
											$vStrAllDetail=$vStrAllDetail.'<li style="float:left" title="'.$vrow1['lv001'].'"><div style="position:relative;" onclick="AddProd(\''.$vrow1['lv001'].'\')" class="buttonClass">';							
											if($lvsl_lv0070->lv010==1 && $vrow1['lv014']!="")
											{
											$vStrAllDetail=$vStrAllDetail.'<img style="width:<?php echo $vWidth;?>px;position:absolute;top:0px;left:0px" src="'.$vrow1['lv014'].'"/>';
											}
											$vStrAllDetail=$vStrAllDetail.'<span  style="margin-left:'.$vWidth.'px;">'.$vrow1['lv002'].'</span></div></li>';
										}
								$vStrAllDetail=$vStrAllDetail.'
										</ul>
									</div>
								</div>';
								}
								$vStrAllDetail=$vStrAllDetail.'</div>';
							}
							$vStrAllDetail=$vStrAllDetail.'</div>';
								
							echo '<div class="thanhnhom" style="float:left;width:105px;overflow: auto;" id="thanhnhom"><input type="hidden" id="txttongthanh" value="'.$i.'"/>'.$strthanh.'</div>';
							echo $vStrAllDetail;
							?>
							
						</div>
						
					</div>							
<!---------------End SP------------------------>
													
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			<div style="display:none;position:absolute;left:240px;bottom:0px;z-index:999999999999;" id="roomid"><select name="txtlv807tmp" id="txtlv807tmp"   tabindex="2"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)" onchange="DoiBang(this)"/>
															<?php echo $lvsl_lv0013->LV_LinkField('lv007',$lvsl_lv0013->lv007);?>
										</select></div>
										</form>
			</div>
	</div>
	<form method="post" enctype="multipart/form-data" name="frmprocess" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
	<form method="post" enctype="multipart/form-data" name="frmprocess1" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</div>
<!---------------Đơn hàng---------------------->
<!---------------Kiem tra tang---------------------->
<div id="viewhere_2" style="display:block;clear:both;">

<?php
echo $lvsl_lv0013->LV_getTangMini($vLangArr);
?>
</div>

<!---------------Tâng---------------------->

</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">

window.setTimeout('RunFunction()',100);
changecategory_change(document.frmadd.txtlv903.value);
function SetTraHang()
{
	var trahang=document.getElementById('trahang');
	if(trahang.checked)
		trahang.checked=false;
	else
		trahang.checked=true;
}
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
	sum=5;
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
		var vo=document.getElementById('gopbangcheck_'+j);
		if(vopt==1)
		{
			var vbang=document.getElementById('bang_'+j);			
			if(vo.checked || vbang.className.indexOf('active')>0)
				o.style.display="block";
			else
			o.style.display="none";
		}
		else
		{
			vo.style.display="block";
			o.style.display="block";
		}
	}	
}	
function setgopbang(o,bang,alarm)
{
	var Ok=false;
	if(alarm==1)
	{
		if(confirm("Bàn này đã có đơn hàng, Bạn có muốn gộp không?"))
		{
			Ok=true;
		}
	}
	else
		Ok=true;
	if(Ok==false){
		o.checked=false;
		return;
	}
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
function AddItemNew(vOrder,hdid,bangid,vo,vprogid)
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
			var o4=document.getElementById("txtorderid");	
			var o8=document.getElementById("txtAddState");		
			var trahang=document.getElementById("trahang");	
			var vth=0;
			if(trahang!=null ) vth=(trahang.checked)?1:0;
			if(o4.value!="") 
			{
				var o5=document.getElementById("txtcusid_"+o4.value);
				url=url+"?&ajaxitemsend=ajaxcheck"+"&Order="+vOrder+"&ContractID="+hdid+"&BangID="+bangid+"&ItemID="+ArItem[1]+"&progid="+vprogid+"&CusID="+o5.value+"&AddState="+o8.value+"&trahang="+vth;
			}
			else
				url=url+"?&ajaxitemsend=ajaxcheck"+"&Order="+vOrder+"&ContractID="+hdid+"&BangID="+bangid+"&ItemID="+ArItem[1]+"&progid="+vprogid+"&AddState="+o8.value+"&trahang="+vth;
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
			document.getElementById("txtContractID").value=domainid;
			var startdomain1=xmlhttp93.responseText.indexOf('[HOPDONGMONEY]')+14;
			var enddomain1=xmlhttp93.responseText.indexOf('[ENDHOPDONGMONEY]');
			var domainid1=xmlhttp93.responseText.substr(startdomain1,enddomain1-startdomain1);
			
			var startdomain2=xmlhttp93.responseText.indexOf('[CHECKORDER]')+12;
			var enddomain2=xmlhttp93.responseText.indexOf('[ENDCHECKORDER]');
			var domainid2=xmlhttp93.responseText.substr(startdomain2,enddomain2-startdomain2);
			var o=document.getElementById('detailview_'+domainid2);
			o.innerHTML=domainid1;
			var bang=document.getElementById('bang_'+domainid2);
			if(bang.className.indexOf('active')>0)
			{
			}
			else
			{
				bang.className="bangleftmini active";
				var bangtitle=document.getElementById('bangtitle_'+domainid2);
				
				bangtitle.className="bangtitlemini";
				var bangtime=document.getElementById('bangtime_'+domainid2);
				bangtime.title="1";
				var tratienid=document.getElementById('tratienid_'+domainid2);
				if(tratienid!=null)
				{
					var o2=document.getElementById("txtbangid");
					var o3=document.getElementById("txtorderid");
					tratienid.setAttribute( "onClick", "tratien('"+domainid+"','"+o3.value+"',2);closepopcalendar("+o3.value+")");
					
				}
				var xuongbepbarid=document.getElementById('xuongbepbarid_'+domainid2);
				if(xuongbepbarid!=null)
				{
					var o2=document.getElementById("txtbangid");
					var o3=document.getElementById("txtorderid");
					xuongbepbarid.setAttribute( "onClick", "tratien('"+domainid+"','"+o3.value+"',15);closepopcalendar("+o3.value+")");
				}
			}
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
			var startdomain13=xmlhttp93.responseText.indexOf('[CHECKBLOCK]')+12;
			var enddomain13=xmlhttp93.responseText.indexOf('[ENDCHECKBLOCK]');
			var domainid13=xmlhttp93.responseText.substr(startdomain13,enddomain13-startdomain13);
			if(domainid13=='1') alert('Bàng đang tạm tính tiền!'); 
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
			var value=(o.checked)?1:0;
			var url=document.location;
			url=url+"?&ajaxquantity=ajaxcheck"+"&qty="+value+"&chitietid="+chitietid+"&optqty=2&bangid="+bangid;
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
			<?php if($lvsl_lv0070->lv012==0)
			{
				?>
			if(parseFloat(o.value+'.0')==0)
			{
				alert('Không được nhập số lượng =0');
				return;
			}
			<?php
			}
			?>
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
			var startdomain=xmlhttp3.responseText.indexOf('[DONHANGDETAIL]')+15;
			var enddomain=xmlhttp3.responseText.indexOf('[ENDDONHANGDETAIL]');
			var detailid=xmlhttp3.responseText.substr(startdomain,enddomain-startdomain);
			if(detailid!="")
			{
				var startdomain=xmlhttp3.responseText.indexOf('[DONHANGPRICE]')+14;
				var enddomain=xmlhttp3.responseText.indexOf('[ENDDONHANGPRICE]');
				var giaban=xmlhttp3.responseText.substr(startdomain,enddomain-startdomain);
				if(giaban!="") document.getElementById('detail_price_'+detailid).value=giaban;
				var startdomain=xmlhttp3.responseText.indexOf('[DONHANGPERCENT]')+16;
				var enddomain=xmlhttp3.responseText.indexOf('[ENDDONHANGPERCENT]');
				var percent=xmlhttp3.responseText.substr(startdomain,enddomain-startdomain);
				if(percent!="") document.getElementById('detail_percent_'+detailid).value=percent;
			}
			var startdomain=xmlhttp3.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp3.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp3.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp3.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp3.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o1=document.getElementById('tongtien_'+domainid);
			if(o1!=null) o1.innerHTML=domainid1;
			var o2=document.getElementById('tongtienct_'+domainid);
			if(o2!=null) o2.innerHTML=domainid1;
			var startdomain4=xmlhttp3.responseText.indexOf('[HOPDONGUNG]')+12;
			var enddomain4=xmlhttp3.responseText.indexOf('[ENDHOPDONGUNG]');
			var domainid4=xmlhttp3.responseText.substr(startdomain4,enddomain4-startdomain4);
			var o=document.getElementById('tongtienconlai_'+domainid);
			if(o!=null) o.innerHTML='<strong>'+domainid4+'</strong>';
			var o=document.getElementById('tongtienconlai1_'+domainid);
			o.innerHTML='<strong>'+domainid4+'</strong>';
			var startdomain1=xmlhttp3.responseText.indexOf('[DONHANGMONEYCL]')+16;
			var enddomain1=xmlhttp3.responseText.indexOf('[ENDDONHANGMONEYCL]');
			var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
			//var o=document.getElementById('tongtientt_'+domainid);
			//o.innerHTML=domainid1;
			var startdomain13=xmlhttp3.responseText.indexOf('[CHECKBLOCK]')+12;
			var enddomain13=xmlhttp3.responseText.indexOf('[ENDCHECKBLOCK]');
			var domainid13=xmlhttp3.responseText.substr(startdomain13,enddomain13-startdomain13);
			if(domainid13=='1') 
			{
				var startdomain1=xmlhttp3.responseText.indexOf('[HOPDONGMONEY]')+14;
				var enddomain1=xmlhttp3.responseText.indexOf('[ENDHOPDONGMONEY]');
				var domainid1=xmlhttp3.responseText.substr(startdomain1,enddomain1-startdomain1);
				var o=document.getElementById('detailview_'+domainid);
				if(o!=null) o.innerHTML=domainid1;
				alert('Bàng đang tạm tính tiền!'); 
			}
			
			
			
			
		}
}	
function UpdateTextQty(o,donhangid,bangid,option)
{
		if(donhangid=='') donhangid = document.getElementById('txtContractID').value;
		$xmlhttp655=null;
			if(bangid=="") 
			{
			//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
			return false;
			}
			xmlhttp655=GetXmlHttpObject();
			if (xmlhttp655==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangtextqty=ajaxcheck"+"&donhangid="+donhangid+"&bangid="+bangid+"&textup="+o.value+"&optrun="+option;
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
			var startdomain1=xmlhttp655.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp655.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp655.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien_'+domainid);
			o.innerHTML=domainid1;
			var startdomain4=xmlhttp655.responseText.indexOf('[HOPDONGTONG]')+13;
			var enddomain4=xmlhttp655.responseText.indexOf('[ENDHOPDONGTONG]');
			var domainid4=xmlhttp655.responseText.substr(startdomain4,enddomain4-startdomain4);
			var o=document.getElementById('tongtienconlai_'+domainid);
			o.innerHTML='<strong>'+domainid4+'</strong>';
		}
}
function UpdateText(o,donhangid,bangid,option)
{
		$xmlhttp555=null;
			/*if(bangid=="") 
			{
			//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
			return false;
			}*/
			if(donhangid=='')
			{
				donhangid=document.getElementById("txtContractID").value;
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
	if (xmlhttp555.readyState==4)
		{
			
			var startdomain=xmlhttp555.responseText.indexOf('[CHECKKH]')+9;
			var enddomain=xmlhttp555.responseText.indexOf('[ENDCHECKKH]');
			var domainid=xmlhttp555.responseText.substr(startdomain,enddomain-startdomain);
			var o=document.getElementById('txtcusid_'+domainid);

			var startdomain1=xmlhttp555.responseText.indexOf('[CHECKKHNAME]')+13;
			var enddomain1=xmlhttp555.responseText.indexOf('[ENDCHECKKHNAME]');
			var domainid1=xmlhttp555.responseText.substr(startdomain1,enddomain1-startdomain1);
			if(domainid1=='' || domainid1=='Mã KH') 
			{
				document.getElementById('txtcusname_'+domainid).value='Tên khách hàng';
				document.getElementById('txtcusadd_'+domainid).value='Địa chỉ';
				document.getElementById('txtcusnote_'+domainid).value='Số điện thoại';

			}
			
		}

}
function CheckVAT(o,donhangid,bangid)
{	
		taxonline=0;
		if(o.checked) taxonline=10;
		$xmlhttp55=null;
			if(bangid=="") 
			{
			//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
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
			/*if(opt==2)
			{
			if(!confirm("Bạn có muốn thực thi trả tiền?"))
			{
				return;
			}
			}*/
			$xmlhttp2=null;
			if(donhangid=="") 
			{
				if(document.getElementById("txtContractID")==null)
				{
					var o=document.getElementById('bangtitle_'+bangid);
					donhangid=o.title;
				}
				else
				{
					donhangid=document.getElementById("txtContractID").value;
				}
				
			}
			if(donhangid=="") 
			{
			//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
			return false;
			}
			xmlhttp2=GetXmlHttpObject();
			if (xmlhttp2==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var cusid=document.getElementById('txtcusid_'+bangid).value;
			var url=document.location;
			url=url+"?&ajaxaproval=ajaxcheck"+"&donhangid="+donhangid+"&bangid="+bangid+"&trangthai="+opt+"&cusid="+cusid;
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
			//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
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
//////////////////////////////////////////////////////////////////////////////////////VIet moi o day
function loaddatachitietbang(vContractID,vBangID,sum)
{
    $xmlhttp655=null;
    if(vBangID=="") 
    {
        return false;
    }
    xmlhttp655=GetXmlHttpObject();
    if (xmlhttp655==null)
    {
        alert ("Your browser does not support AJAX!");
        return;
    }
    
    // Lưu bangid vào xmlhttp5 object để dùng trong callback
    xmlhttp655.bangid = vBangID;
    var url=document.location;
    url=url+"?&ajaxbangchitiet=ajaxcheck"+"&hopdongid="+vContractID+"&bangid="+vBangID+"&sum="+sum;
	alert(url);
    url=url.replace("#","");
	xmlhttp655.onreadystatechange=function() {stateactivebangchitiet(vBangID, xmlhttp655);};
    xmlhttp655.open("GET",url,true);
    xmlhttp655.send(null);
}
function stateactivebangchitiet(banId, xmlhttp655) {
    if (banId == "") return false;
    if (xmlhttp655.readyState == 4 && xmlhttp655.status == 200) {
        var response = xmlhttp655.responseText;
        var startdomain = response.indexOf('[NVLAYDULIEUCT]') + 15;
        var enddomain = response.indexOf('[ENDNVLAYDULIEUCT]');
        var ok = response.substring(startdomain, enddomain);
        var o = document.getElementById('detailview_' + banId);
        if (o != null) {
            o.innerHTML = ok;
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////VIet moi o day
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
function changenotenhanvien(o,chitietid,bangid)
{
			$xmlhttp226=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp226=GetXmlHttpObject();
			if (xmlhttp226==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			var cus=document.getElementById("txtcusid_"+bangid);
			url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=4&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp226.onreadystatechange=stateorderchangeNote;
			xmlhttp226.open("GET",url,true);
			xmlhttp226.send(null);
}	
function stateorderchangeNote()
{
}
function changeorder(o,chitietid,bangid)
	{
		if(parseInt(o.value)==0)
				o.parentNode.parentNode.className=o.parentNode.parentNode.className+'  textunderline';
			else
				o.parentNode.parentNode.className=o.parentNode.parentNode.className.replace('textunderline','');
			$xmlhttp26=null;
			if(chitietid=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp26=GetXmlHttpObject();
			if (xmlhttp26==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			var cus=document.getElementById("txtcusid_"+bangid);
			if(o.value=="" && cus.value!="Mã KH" )
				url=url+"?&ajaxprice=ajaxcheck"+"&price="+cus.value+"&chitietid="+chitietid+"&optprice=15&bangid="+bangid;
			else
				url=url+"?&ajaxprice=ajaxcheck"+"&price="+o.value+"&chitietid="+chitietid+"&optprice=15&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp26.onreadystatechange=stateorderchange;
			xmlhttp26.open("GET",url,true);
			xmlhttp26.send(null);
	}
	function stateorderchange()
	{
		if (xmlhttp26.readyState==4)
		{
			var startdomain=xmlhttp26.responseText.indexOf('[DONHANGDETAIL]')+15;
			var enddomain=xmlhttp26.responseText.indexOf('[ENDDONHANGDETAIL]');
			var detailid=xmlhttp26.responseText.substr(startdomain,enddomain-startdomain);
			if(detailid!="")
			{
				var startdomain=xmlhttp26.responseText.indexOf('[DONHANGPRICE]')+14;
				var enddomain=xmlhttp26.responseText.indexOf('[ENDDONHANGPRICE]');
				var giaban=xmlhttp26.responseText.substr(startdomain,enddomain-startdomain);
				if(giaban!="") document.getElementById('detail_price_'+detailid).value=giaban;
				var startdomain=xmlhttp26.responseText.indexOf('[DONHANGPERCENT]')+16;
				var enddomain=xmlhttp26.responseText.indexOf('[ENDDONHANGPERCENT]');
				var percent=xmlhttp26.responseText.substr(startdomain,enddomain-startdomain);
				if(percent!="") document.getElementById('detail_percent_'+detailid).value=percent;
			}
			var startdomain=xmlhttp26.responseText.indexOf('[CHECKDONHANG]')+14;
			var enddomain=xmlhttp26.responseText.indexOf('[ENDCHECKDONHANG]');
			var domainid=xmlhttp26.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain1=xmlhttp26.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp26.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp26.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien_'+domainid);
			o.innerHTML=domainid1;
			var startdomain4=xmlhttp26.responseText.indexOf('[HOPDONGUNG]')+12;
			var enddomain4=xmlhttp26.responseText.indexOf('[ENDHOPDONGUNG]');
			var domainid4=xmlhttp26.responseText.substr(startdomain4,enddomain4-startdomain4);
			var o=document.getElementById('tongtienconlai_'+domainid);
			o.innerHTML='<strong>'+domainid4+'</strong>';
			var o=document.getElementById('tongtienct_'+domainid);
			o.innerHTML=domainid1;
			var startdomain1=xmlhttp26.responseText.indexOf('[DONHANGMONEYCL]')+16;
			var enddomain1=xmlhttp26.responseText.indexOf('[ENDDONHANGMONEYCL]');
			var domainid1=xmlhttp26.responseText.substr(startdomain1,enddomain1-startdomain1);
			//var o=document.getElementById('tongtientt_'+domainid);
			//o.innerHTML=domainid1;
			var o=document.getElementById('tongtienconlai1_'+domainid);
			o.innerHTML='<strong>'+domainid4+'</strong>';
		}
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
			//var o=document.getElementById('tongtientt_'+domainid);
			//o.innerHTML=domainid1;
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
			var startstate=xmlhttp2.responseText.indexOf('[CHECKSTATE]')+12;
			var endstate=xmlhttp2.responseText.indexOf('[ENDCHECKSTATE]');
			var state=xmlhttp2.responseText.substr(startstate,endstate-startstate);
			var o=document.getElementById('bang_'+domainid);
			if(o.className.indexOf('active')>0 || state=='2' || state=='7' || state=='15')
			{
				o.className="bangleftmini waiting";
				var o=document.getElementById('bangtitle_'+domainid);
				o.className="bangtitlewaitmini";
				var to=document.getElementById('bang_'+domainid);
				to.innerHTML=to.innerHTML.replace('viewpopcalendar(','tratiendonphong(\''+donhang+'\',\''+domainid+'\',3,');
				if(state=='5')
				{
					//
				}
				else if(state=='15')
				{
					<?php if($lvsl_lv0070->lv027==1)
					{
						?>
					//ReportCookWait(donhang);
					<?php
					}
					?>
				}
				else if(state=='7')
				{
					var startdomain13=xmlhttp2.responseText.indexOf('[CHECKBLOCK]')+12;
					var enddomain13=xmlhttp2.responseText.indexOf('[ENDCHECKBLOCK]');
					var block=xmlhttp2.responseText.substr(startdomain13,enddomain13-startdomain13);
					//if(block=='1') ReportWait(donhang);
								
				}
				else
					ReportWait(donhang);
				if(state=='2') runbanhang();
			}
			else if(o.className.indexOf('waiting')>0)
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
function changesodienthoai_change(value,vorder)
{
	$xmlhttp11=null;
	if(value=="") 
	{
	//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
	return false;
	}
	xmlhttp11=GetXmlHttpObject();
	if (xmlhttp11==null)
	{
		alert ("Your browser does not support AJAX!");
		return;
	}
	var url=document.location;
	url=url+"?&ajaxphone=ajaxcheck"+"&cusid="+value+"&order="+vorder;
	url=url.replace("#","");
	xmlhttp11.onreadystatechange=stateChanged11;
	xmlhttp11.open("GET",url,true);
	xmlhttp11.send(null);
}
function stateChanged11()
{
	fcus=false;
	if (xmlhttp11.readyState==4)
	{
		var startdomain=xmlhttp11.responseText.indexOf('[CHECKORDER]')+12;
		var enddomain=xmlhttp11.responseText.indexOf('[ENDCHECKORDER]');
		var order=xmlhttp11.responseText.substr(startdomain,enddomain-startdomain);
		var startdomain=xmlhttp11.responseText.indexOf('[CHECKIDORDER]')+14;
		var enddomain=xmlhttp11.responseText.indexOf('[ENDCHECKIDORDER]');
		var orderid=xmlhttp11.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusid_'+order).value=orderid;
		var startdomain=xmlhttp11.responseText.indexOf('[CHECK]')+7;
		var enddomain=xmlhttp11.responseText.indexOf('[ENDCHECK]');
		var domainid=xmlhttp11.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusname_'+order).value=domainid;
		var startdomain=xmlhttp11.responseText.indexOf('[TCHECK]')+8;
		var enddomain=xmlhttp11.responseText.indexOf('[ENDTCHECK]');
		var domainid=xmlhttp11.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusadd_'+order).value=domainid;
		var startdomain=xmlhttp11.responseText.indexOf('[SCHECK]')+8;
		var enddomain=xmlhttp11.responseText.indexOf('[ENDSCHECK]');
		var domainid=xmlhttp11.responseText.substr(startdomain,enddomain-startdomain);
		document.getElementById('txtcusnote_'+order).value=domainid;
		document.getElementById('txtcusid_'+order).focus();		
		
	}
}
function changecategory_change(value,vorder)
	{
		$xmlhttp=null;
		if(value=="") 
		{
			//alert("Xin vui lòng reset lại màn hình hoặc click double vào tab màn hình này");
			//return false;
		}
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		}
		donhangid=document.getElementById("txtContractID").value;
		var url=document.location;
		url=url+"?&ajax=ajaxcheck"+"&cusid="+value+"&order="+vorder+'&donhangid='+donhangid;
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
			var startdomain=xmlhttp.responseText.indexOf('[CHECKORDER]')+12;
			var enddomain=xmlhttp.responseText.indexOf('[ENDCHECKORDER]');
			var order=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			var startdomain=xmlhttp.responseText.indexOf('[CHECK]')+7;
			var enddomain=xmlhttp.responseText.indexOf('[ENDCHECK]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtcusname_'+order).value=domainid;
			var startdomain=xmlhttp.responseText.indexOf('[TCHECK]')+8;
			var enddomain=xmlhttp.responseText.indexOf('[ENDTCHECK]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtcusadd_'+order).value=domainid;
			var startdomain=xmlhttp.responseText.indexOf('[SCHECK]')+8;
			var enddomain=xmlhttp.responseText.indexOf('[ENDSCHECK]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtcusnote_'+order).value=domainid;
			document.getElementById('txtcusname_'+order).focus();		
			var startdomain=xmlhttp.responseText.indexOf('[DOANHCHECK]')+12;
			var enddomain=xmlhttp.responseText.indexOf('[ENDDOANHCHECK]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtdoanhthu_'+order).innerHTML=domainid;

			var startdomain=xmlhttp.responseText.indexOf('[PROGCKTM]')+10;
			var enddomain=xmlhttp.responseText.indexOf('[ENDPROGCKTM]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			if(parseFloat(domainid)>0)
			{
				document.getElementById('giamgiapercent_'+order).innerText=domainid+'%';
				document.getElementById('giamgia_'+order).style.display='block';
			}
			else
			{
				document.getElementById('giamgia_'+order).style.display='none';
			}
			var startdomain1=xmlhttp.responseText.indexOf('[DONHANGMONEY]')+14;
			var enddomain1=xmlhttp.responseText.indexOf('[ENDDONHANGMONEY]');
			var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('tongtien_'+order);
			o.innerHTML=domainid1;

			var startdomain=xmlhttp.responseText.indexOf('[PROGCHECK]')+11;
			var enddomain=xmlhttp.responseText.indexOf('[ENDPROGCHECK]');
			var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
			document.getElementById('txtlv909').value=domainid+'';

			var startdomain1=xmlhttp.responseText.indexOf('[HOPDONGMONEY]')+14;
			var enddomain1=xmlhttp.responseText.indexOf('[ENDHOPDONGMONEY]');
			var domainid1=xmlhttp.responseText.substr(startdomain1,enddomain1-startdomain1);
			var o=document.getElementById('detailview_'+order);
			if(domainid1!="")				o.innerHTML=domainid1;
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
	$("html, body").animate({ scrollTop: 0 }, 100);
	loaddatachitietbang(vfocus,vstt,"");
	var o1=document.getElementById("txtContractID");
	o1.value=vfocus;
	var o2=document.getElementById("txtbangid");
	o2.value=vRoomid;
	var o3=document.getElementById("txtorderid");
	o3.value=vstt;
	var bang=document.getElementById("bang_"+vstt);
	var o=document.getElementById("calendarview_"+vstt);
	var scrollwidth=document.body.scrollWidth;
	var content=window.parent.document.getElementById('sof_pages_content');
	if(content==null)
	{
		var vHeight=parseInt(document.body.scrollHeight);
		var vWidth=document.body.scrollWidth;
	}
	else
	{
		var vHeight=parseInt(content.style.height);
		var vWidth=content.style.width;
	}
	
	var left=0;
	var top=(1-vtang)*85;
	//if(top<0) top=0;
	if(scrollwidth>(960+130))
	{
		left=(scrollwidth-1090)/2
	}
	o.style.display="block";
	//o.style.left=left+"px";
	//o.style.top=top+"px";
	o.style.top="-60px";
	o.style.left="0px";
	/*o.style.left="-90px";*/
	//o.style.width=(scrollwidth-20)+'px';
	o.style.height=(vHeight-30)+'px';
	var thanhnhom=document.getElementById("thanhnhom");
	var thanhprocess=document.getElementById("thanhprocess");
	thanhnhom.style.height=(vHeight)+'px';
	thanhprocess.style.height=(vHeight)+'px';
	var dataview=document.getElementById("detailview_"+vstt);
	dataview.style.height=(vHeight-200)+'px';
	var obj=document.getElementById('viewhere_1');
	var monan=document.getElementById('monan_'+vstt);
	monan.innerHTML=obj.innerHTML;
	obj.innerHTML='';
	var objdetail=document.getElementById('viewhere_3');
	var chonsanpham=document.getElementById('chonsanpham_'+vstt);
	chonsanpham.innerHTML=objdetail.innerHTML;
	objdetail.innerHTML='';
	var cus=document.getElementById("txtcusid_"+vstt);
	if(cus.value!='' && cus.value!='Mã KH')	changecategory_change(cus.value,vstt);
	<?php
		if($lvsl_lv0070->lv023==1)
		{
		?>
		setTimeout(focusmain,1000);
		function focusmain()
		{
			document.getElementById('txtlv903').select();
		}
	<?php
		}
		else
		{
			?>
//		var vo=document.getElementById("item_"+vfocus);
		//vo.focus();
		setTimeout(focusmain,1000);
		function focusmain()
		{
			document.getElementById('txtlv903').select();
		}
		<?php
		}
		?>
	
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
	var objdetail=document.getElementById('viewhere_3');
	var chonsanpham=document.getElementById('chonsanpham_'+vstt);
	objdetail.innerHTML=chonsanpham.innerHTML;
	chonsanpham.innerHTML='';
	
}
function ShowNhomSanPham()
{
	var o=document.getElementById('txtorderid');
	var bang=document.getElementById('monan_'+o.value);
	bang.style.display="block";
	var khungsp=document.getElementById('khungsp');
	khungsp.style.display="block";
	khungsp.style.height="100%";
}
function AnNhomSanPham()
{
	var o=document.getElementById('txtorderid');
	var bang=document.getElementById('monan_'+o.value);
	bang.style.display="none";
	var khungsp=document.getElementById('khungsp');
	khungsp.style.display="none";
	var sanphamthuongchon=document.getElementById('sanphamthuongchon');
	sanphamthuongchon.style.display="none";
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
		var o1=document.getElementById('gopbang_'+j);
		if(vopt==13)
		{
			o.style.display="block";
			o1.style.display="block";
		}
		else
		{
			if(o.className.indexOf('active')>0)
			{
				if(vopt==1)
				{
					o.style.display="block";
					o1.style.display="block";
				}
				else
				{
					o.style.display="none";
					o1.style.display="none";
				}
			}
			else if(o.className.indexOf('waiting')>0)
			{
				if(vopt==3)
				{
					o.style.display="block";
					o1.style.display="block";
				}
				else
				{
					o.style.display="none";
					o1.style.display="none";
				}
			}
			else
			{
				if(vopt==1)
				{
					o.style.display="none";
					o1.style.display="none";
				}
				else if(vopt==3)
				{
					o.style.display="none";
					o1.style.display="none";
				}
				else
				{
					o.style.display="block";
					o1.style.display="block";
				}
			}
		}
	}	
}
function setviewhere(i)
{
	sum=2;
	
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('viewhere_'+j);
		if(i==j)
		{
			o.style.display="block";
		}
		else
			o.style.display="none";
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
setTimeout(setReload,<?php echo ($lvsl_lv0070->lv003==0)?60000:$lvsl_lv0070->lv003*1000;?>);
function checkviewlist()
{
	sum=parseInt(document.getElementById('sumbang').value);
	for(j=1;j<=sum;j++)
	{
	var o=document.getElementById("calendarview_"+j);
		if(o.style.display=="block")
		{
		setTimeout(setReload,<?php echo ($lvsl_lv0070->lv003==0)?60000:$lvsl_lv0070->lv003*1000;?>);
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
//setTimer();
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
	var sumtangall=<?php echo $lvsl_lv0013->sumTang;?>;
	if(opt==0) opt=2;
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