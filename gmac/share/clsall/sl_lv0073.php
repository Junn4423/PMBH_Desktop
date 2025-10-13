<?php
class sl_lv0073 extends lv_controler{
	var $vRowHeader="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"25%\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@06</b></td>
			</tr>
		@01
		</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var $vRowHeaderAll="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@06</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@07</b></td>
			</tr>
		@01
		</table>";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=0;		
	 	$this->isFil=1;	
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
	function GetView()
	{
		return $this->isView;
	}//////////get view///////////////
	function GetRpt()
	{
		return $this->isRpt;
	}
	//////////get view///////////////
	function GetAdd()
	{
		return $this->isAdd;
	}	
	//////////get edit///////////////
	function GetEdit()
	{
		return $this->isEdit;
	}	
	//////////get edit///////////////
	function GetApr()
	{
		return $this->isApr;
	}		
	//////////get edit///////////////
	function GetUnApr()
	{
		return $this->isUnApr;
	}	
	function LV_GET_ITEMS_EXIST($vWHID,$strwh)
	{
		$str_return="";
		$vcondtion="";
		if($vWHID!="")
		{
			$vcondtion=" and lv003='$vWHID'";
		}
		else 
		{
			$vcondtion=" and lv003 in ($strwh)";
		}
		$vsql="select distinct lv002 from wh_lv0012 where 1=1 $vcondtion";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return=="")
				$str_return="'".$vrow['lv002']."'";
			else 
				$str_return=$str_return.",'".$vrow['lv002']."'";
		}
		return $str_return;
	}
	function LV_GET_ITEMS_CATE($vCateID)
	{
		$str_return="";
		$vCateID=str_replace(",","','",$vCateID);
		$vsql="select lv001 from sl_lv0007 where 1=1 and lv003 in ('$vCateID')";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return=="")
				$str_return="'".$vrow['lv001']."'";
			else 
				$str_return=$str_return.",'".$vrow['lv001']."'";
		}
		if($str_return=="") $str_return="''";
		return $str_return;
	}
	function LV_GET_DONHANG_DANGTHUE()
	{
		$str_return1="";
		$vsql="select lv001 lv002 from sl_lv0013 B where  lv011=0";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return1=="")
				$str_return1="'".$vrow['lv002']."'";
			else 
				$str_return1=$str_return1.",'".$vrow['lv002']."'";
		}
		return $str_return1;
	}
	function LV_GET_DONHANG_CATE($vCateID,$vDateStart)
	{
		$str_return="";
		$str_return1="";
		$vCateID=str_replace(",","','",$vCateID);
		$vsql="select lv001 from sl_lv0007 where 1=1 and lv003 in ('$vCateID')";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return=="")
				$str_return="'".$vrow['lv001']."'";
			else 
				$str_return=$str_return.",'".$vrow['lv001']."'";
		}
		if($str_return=="") $str_return="''";
		$vsql="select A.lv002 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where 1=1 and A.lv003 in ($str_return) AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return1=="")
				$str_return1="'".$vrow['lv002']."'";
			else 
				$str_return1=$str_return1.",'".$vrow['lv002']."'";
		}
		return $str_return1;
	}
	function sec_to_times($seconds) { 
    $hours = floor($seconds / 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60; 

    return sprintf("%d:%02d:%02d", $hours, $minutes, $seconds); 
	}	
	function PrintInOutPutInStockInvoiceSum($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$vCustomerID,$vlv005_opt,$vSalerID,$vlv013_opt,$vItemID,$vProgramID,$vGift,$vCateID,$vCateOpt,$vtax,$vlv007,$vlv007_opt)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" >@03</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_9',this,@!79)\" style=\"cursor:pointer\">@10</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_10',this,@!79)\" style=\"cursor:pointer\">@11</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_18',this,@!79)\" style=\"cursor:pointer\">@19</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_19',this,@!79)\" style=\"cursor:pointer\">@20</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_15',this,@!79)\" style=\"cursor:pointer\">@16</td>
				<td class=\"htable\" width=\"*%\" ondblclick=\"RemoveCol('col_3',this,@!79)\" style=\"cursor:pointer\">@04</td>
				<td class=\"htable\" width=\"5%\" ondblclick=\"RemoveCol('col_4',this,@!79)\" style=\"cursor:pointer\">@05</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_5',this,@!79)\" style=\"cursor:pointer\">@06</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_16',this,@!79)\" style=\"cursor:pointer\">@17</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_20',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@21</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@09</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_17',this,@!79)\" style=\"cursor:pointer\">@18</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@902</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_9_@02\" >@10</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_10_@02\">@11</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_18_@02\" >@19</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_19_@02\">@20</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_15_@02\">@16</td>
				<td class=\"left_style\" rowspan=\"@01\" id=\"col_3_@02\">@04</td>
				<td class=\"left_style\" rowspan=\"@01\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_5_@02\">@06</td>
				<td class=\"right_style\" id=\"col_16_@02\">@17</td>
				<td class=\"right_style\" id=\"col_20_@02\" style=\"background-color:#eee\">@21</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\">@09</td>	
				<td class=\"right_style\" id=\"col_17_@02\">@18</td>	
			</tr>
			@60
			";
		$vRowLast="
			<tr>
				<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_9_@02\" >&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_10_@02\"><strong>&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_18_@02\" >&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_19_@02\"><strong>&nbsp;</td>
				<td class=\"left_style\" id=\"col_15_@02\">&nbsp;</td>
				<td class=\"left_style\" id=\"col_3_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_4_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_5_@02\"><strong>@07</td>
				<td class=\"right_style\" id=\"col_16_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_20_@02\" style=\"background-color:#eee\"><strong>@21</strong></td>					
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\"><strong>@09</strong></td>					
				<td class=\"right_style\" id=\"col_17_@02\"><strong>&nbsp;</strong></td>	
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"right_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"right_style\"  id=\"col_16_@02\">@17</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_8_@02\">@09</td>	
				<td class=\"right_style\"  id=\"col_17_@02\">@18</td>		
			</tr>";
		$vArrSate=Array();
		$vArrSateName=Array();
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="")
		{
			$vCondition = $vCondition." AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		}
		if($vSalerID!="")
		{
			if($vlv013_opt==1)
				$vCondition = $vCondition." AND B.lv010!='$vSalerID' ";
			else
				$vCondition = $vCondition." AND B.lv010='$vSalerID' ";
		}
		if($vlv007!="")
		{
			if($vlv007_opt==1)
				$vCondition = $vCondition." AND B.lv007!='$vlv007' ";
			else
				$vCondition = $vCondition." AND B.lv007='$vlv007' ";
		}
		if($vCustomerID!="")
		{
			if($vlv005_opt==1)
				$vCondition = $vCondition." AND B.lv002!='$vCustomerID' ";
			else
				$vCondition = $vCondition." AND B.lv002='$vCustomerID' ";
		}
		if($vItemID!="")
		{
				$vCondition = $vCondition." AND A.lv003='$vItemID' ";
		}
		if($vProgramID!="")
		{
				$vCondition = $vCondition." AND B.lv011 in ('".str_replace(",","','",$vProgramID)."') ";
		}
		if($vGift!="")
		{
				$vCondition = $vCondition." AND A.lv016='$vGift' ";
		}
		if($vtax!="")
		{
				$vCondition = $vCondition." AND B.lv015='$vtax' ";
		}
		if($vCateID!="")
		{
			if($vCateOpt==1)
			{
				$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
				$vCondition = $vCondition." AND A.lv002 in ($vlscate) ";
			}
			else
			{
				$vlscate=$this->LV_GET_ITEMS_CATE($vCateID);
				$vCondition = $vCondition." AND A.lv003 in ($vlscate) ";
			}
		}
		$sqlS = "select B.lv001 InvoiceID,J.lv002 RoomName,B.lv004 DateInvoice,B.lv011 State,F.lv002 stateName,B.lv005 DateInvoiceTo,B.lv002 CustomerID,B.lv003 CustomerName,B.lv009 CustomerAdd,B.lv013 CustomerNote,B.lv010 EmployeeID,sum(A.lv006*A.lv004-A.lv006*A.lv004*B.lv022/100-A.lv006*A.lv004*A.lv011/100+A.lv006*A.lv004*B.lv006/100) SumTotal,sum(A.lv006*A.lv004*A.lv011/100+A.lv006*A.lv004*B.lv022/100) TCK,TIME_TO_SEC(substr(B.lv004,12,8)) timeview,TIME_TO_SEC(TIMEDIFF('24:00:00',substr(B.lv004,12,8))) timeagain,TIME_TO_SEC('24:00:00') h24,DATEDIFF(B.lv005,B.lv004) days,TIME_TO_SEC(substr(B.lv005,12,8)) curtime from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 left join sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on A.lv003=D.lv001 left join sl_lv0059 E on A.lv009=E.lv001 left join sl_lv0054 F on B.lv011=F.lv001 left join sl_lv0009 J on B.lv007=J.lv001 where 1=1 $vCondition group by  A.lv002";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vsum07=0;
		$vsum08=0;
		$vsum09=0;
		$vsum10=0;
		$vsum11=0;
		$vsum12=0;
		$vsum13=0;
		$vsum14=0;
		$vsum17=0;
		$vincrease=0;
		$vtInventorylv001='1111111111111111111111111111111111111';
		$sumlimittime=0;
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$vincrease++;
					if($vtInventorylv001 != $arrS['InvoiceID']){
						$vOrder++;
						$vtInventorylv001 = $arrS['InvoiceID'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@902", $vOrder, $vLineRun);$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $arrS['RoomName'], $vLineRun);
						$vLineRun = str_replace("@18", $vtInventorylv001, $vLineRun);
						$lvCKTM=$arrS['TCK'];
						$vsumCKTM=$vsumCKTM+$lvCKTM;
						$vLineRun = str_replace("@21", $this->FormatView($lvCKTM,10), $vLineRun);
						//CustomerID
						$vLineRun = str_replace("@10", $arrS['CustomerID']."&nbsp;", $vLineRun);
						//Customer Name
						$vLineRun = str_replace("@11", $arrS['CustomerName']."&nbsp;", $vLineRun);
						$vLineRun = str_replace("@19", $arrS['CustomerAdd']."&nbsp;", $vLineRun);
						$vLineRun = str_replace("@20", $arrS['CustomerNote']."&nbsp;", $vLineRun);
						$vLineRun = str_replace("@16", $arrS['EmployeeID'], $vLineRun);
						$vLineRun = str_replace("@04", $this->FormatView($arrS['DateInvoice'],4), $vLineRun);
						$vLineRun = str_replace("@09", $this->FormatView($arrS['SumTotal'],10), $vLineRun);
						
						$vLineRun = str_replace("@17", $arrS['stateName'], $vLineRun);
						$timeview=$arrS['timeview'];
						$curtime=$arrS['curtime'];
						$timeagain=$arrS['timeagain'];
						$days=$arrS['days'];
						$h24=$arrS['h24'];
						if($days>0)
							$limittime=$timeagain+($days-1)*$h24+$curtime;
						else
							$limittime=$curtime-$timeview;
						
						if($arrS['State']>0) 
						{
							$vLineRun = str_replace("@05", $this->FormatView($arrS['DateInvoiceTo'],4), $vLineRun);
							$vLineRun = str_replace("@06", $this->sec_to_times($limittime), $vLineRun);
							$sumlimittime=$sumlimittime+$limittime;
						}
						else
							{
							$vLineRun = str_replace("@05", '', $vLineRun);
							$vLineRun = str_replace("@06", '', $vLineRun);
							}
						
						$vsum09=$vsum09+$arrS['SumTotal'];
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
					$vArrSate[$arrS['State']]=$vArrSate[$arrS['State']]+$arrS['SumTotal'];
					$vArrSateName[$arrS['State']]=$arrS['stateName'];
				$vNumline++;
				
				$vLineRun = str_replace("@60",$strReplace, $vLineRun);	
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@07",$this->sec_to_times($sumlimittime),$vRowLast);
		$vRowLast=str_replace("@09",$this->FormatView($vsum09,10),$vRowLast);
		$vRowLast=str_replace("@11",$this->FormatView($vsum11,10),$vRowLast);
		$vRowLast=str_replace("@21",$this->FormatView($vsumCKTM,10),$vRowLast);
		$vRowLast=str_replace("@13",$this->FormatView($vsum13,10),$vRowLast);
		$vRowLast=str_replace("@14",$this->FormatView($vsum14,10),$vRowLast);
		$vRowLast=str_replace("@18",$this->FormatView($vsum18,10),$vRowLast);
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", "Bàn", $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", 'Giờ bắt đầu', $vHeader);
		//Item
		$vHeader = str_replace("@05",'Giờ kết thúc', $vHeader);
		//Name Item
		$vHeader = str_replace("@06", 'Tổng giờ', $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
		//Discount
		$vHeader = str_replace("@10","CMND", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11","Tên khách hàng", $vHeader);
		//Tax
		$vHeader = str_replace("@12",$vArrLang[49], $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13",$vArrLang[57]."(vnđ)", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",$vArrLang[53], $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",'Trạng thái', $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[23], $vHeader);	
		$vHeader = str_replace("@19","Địa chỉ", $vHeader);	
		$vHeader = str_replace("@20","Ghi chú", $vHeader);
		$vHeader = str_replace("@21","Tiền chiết khấu", $vHeader);		
		$vHeader = str_replace("@21",$vArrLang[60], $vHeader);	
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	
	}	
	function SumTamUng($vListOrder)
	{
		$vsql="select sum(A.lv004) Money from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001 where B.lv013 in ($vListOrder)";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['Money'];
		}
	}
	function SumKhachNo($vDateStart)
	{
		$vsql="select sum(A.lv004*A.lv006) Money from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart')) and B.lv011=3";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['Money'];
		}
	}
	function SumKhachTraNo($vDateStart)
	{
		$vsql="select sum(A.lv004*A.lv006) Money from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where (YEAR(B.lv021)=YEAR('$vDateStart') AND MONTH(B.lv021)=MONTH('$vDateStart') AND DAY(B.lv021)=DAY('$vDateStart')) and B.lv011=4";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['Money'];
		}
	}
	function SumNuoc($vDateStart)
	{
		$vlistItem=$this->LV_GET_ITEMS_CATE('NGAY,DEM,PHONGIO,CONGTHEM');
		$vsql="select sum(A.lv004*A.lv006) Money from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart')) and B.lv011 in (1,2) and A.lv003 not in ($vlistItem)";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['Money'];
		}
	}
	function SumTheoNgay($vDateStart,$vCateID)
	{
		$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
		$vsql="select sum(A.lv004*A.lv006) Money from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart')) and B.lv011 in (1,2) AND A.lv002 in ($vlscate)";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['Money'];
		}
	}
	function PrintStateValues($vArrState,$vArrStateName,$vDateStart)
	{
		foreach($vArrState as $key => $vState)
		{
			$strReturn=$strReturn.'<div style="text-align:right;font-size:14px"><strong>'.$vArrStateName[$key].': '.$this->FormatView($vState,10)."</strong></div>";
		}
		$strReturn=$strReturn.'
		<br/>
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="1" class="tblprint">
			<tr class=\"tblcaption\">
				<td class="htable">Doanh thu theo giờ(1)</td><td class="htable">Doanh thu theo đêm(2)</td><td class="htable">Doanh thu theo ngày(3)</td><td class="htable">Tổng doanh thu nước(4)</td><td class="htable">Tổng tiền nợ(5)</td><td class="htable">Tổng tiền trả nợ(6)</td><td class="htable">Tổng tiền ứng trước(7)</td><td class="htable">Tiền thu((8)=1+2+3)</td><td class="htable">Tổng thu(6+7+8)</td>
			</tr>
			<tr>
				<td class="right_style">@#07</td><td class="right_style">@#08</td><td class="right_style">@#09</td><td class="right_style">@#03</td><td class="right_style">@#01</td><td class="right_style">@#02</td><td class="right_style">@#04</td><td class="right_style">@#05</td><td class="right_style">@#06</td>
			</tr>
		';
		$vlistdonhang=$this->LV_GET_DONHANG_DANGTHUE();
		$vTamUng=$this->SumTamUng($vlistdonhang);
		$vTienNo=$this->SumKhachNo($vDateStart);
		$vTienTraNo=$this->SumKhachTraNo($vDateStart);		
		$vNuoc=$this->SumNuoc($vDateStart);
		$vNgay=$this->SumTheoNgay($vDateStart,'NGAY');
		$vGio=$this->SumTheoNgay($vDateStart,'PHONGIO');
		$vDem=$this->SumTheoNgay($vDateStart,'DEM');
		$strReturn=str_replace("@#05",$this->FormatView($vArrState[1]+$vArrState[2],10),$strReturn);
		$strReturn=str_replace("@#01",$this->FormatView($vTienNo,10),$strReturn);
		$strReturn=str_replace("@#02",$this->FormatView($vTienTraNo,10),$strReturn);
		$strReturn=str_replace("@#03",$this->FormatView($vNuoc,10),$strReturn);
		$strReturn=str_replace("@#04",$this->FormatView($vTamUng,10),$strReturn);
		$strReturn=str_replace("@#06",$this->FormatView($vArrState[1]+$vArrState[2]+$vTienTraNo+$vTamUng,10),$strReturn);
		$strReturn=str_replace("@#07",$this->FormatView($vGio,10),$strReturn);
		$strReturn=str_replace("@#08",$this->FormatView($vDem,10),$strReturn);
		$strReturn=str_replace("@#09",$this->FormatView($vNgay,10),$strReturn);
		$strReturn=$strReturn."</table>";

		return $strReturn;
	}
	function PrintInOutPutInStockDetail($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$vCustomerID,$vlv005_opt,$vSalerID,$vlv013_opt,$vItemID,$vProgramID,$vGift,$vCateID,$vCateOpt,$vtax,$vlv007,$vlv007_opt)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" >@03</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_9',this,@!79)\" style=\"cursor:pointer\">@10</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_10',this,@!79)\" style=\"cursor:pointer\">@11</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_18',this,@!79)\" style=\"cursor:pointer\">@19</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_19',this,@!79)\" style=\"cursor:pointer\">@20</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_15',this,@!79)\" style=\"cursor:pointer\">@16</td>
				<td class=\"htable\" width=\"*%\" ondblclick=\"RemoveCol('col_3',this,@!79)\" style=\"cursor:pointer\">@04</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_11',this,@!79)\" style=\"cursor:pointer\">@12</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_12',this,@!79)\" style=\"cursor:pointer\">@13</td>	
				<td class=\"htable\" width=\"5%\" ondblclick=\"RemoveCol('col_4',this,@!79)\" style=\"cursor:pointer\">@05</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_5',this,@!79)\" style=\"cursor:pointer\">@06</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_6',this,@!79)\" style=\"cursor:pointer\">@07</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_7',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@08</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_20',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@21</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@09</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_17',this,@!79)\" style=\"cursor:pointer\">@18</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@902</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_9_@02\" >@10</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_10_@02\">@11</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_18_@02\" >@19</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_19_@02\">@20</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_15_@02\">@16</td>
				<td class=\"left_style\" rowspan=\"@01\" id=\"col_3_@02\">@04</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_11_@02\">@12</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_12_@02\">@13</td>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\">@06</td>
				<td class=\"right_style\" id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" id=\"col_7_@02\" style=\"background-color:#eee\">@08</td>
				<td class=\"right_style\" id=\"col_20_@02\" style=\"background-color:#eee\">@21</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\">@09</td>	
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_17_@02\">@18</td>	
			</tr>
			@60
			";
		$vRowLast="
			<tr>
				<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_9_@02\" >&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_10_@02\"><strong>&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_18_@02\" >&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_19_@02\"><strong>&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_11_@02\">&nbsp;</td>
				<td class=\"right_style\" rowspan=\"@01\" id=\"col_12_@02\"><strong>&nbsp;</td>
				<td class=\"left_style\" id=\"col_3_@02\">&nbsp;</td>
				<td class=\"left_style\" id=\"col_4_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_5_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_13_@02\" ><strong>&nbsp;</strong></td>
				<td class=\"right_style\" id=\"col_6_@02\"><strong>@07</td>
				<td class=\"right_style\" id=\"col_7_@02\" >&nbsp;</td>
				<td class=\"right_style\" id=\"col_20_@02\" >@21</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\"><strong>@09</strong></td>							
				<td class=\"right_style\" id=\"col_17_@02\"><strong>&nbsp;</strong></td>	
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"right_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_7_@02\">@08</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_20_@02\">@21</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_8_@02\">@09</td>		
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="")
		{
			$vCondition = $vCondition." AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		}
		if($vSalerID!="")
		{
			if($vlv013_opt==1)
				$vCondition = $vCondition." AND B.lv010!='$vSalerID' ";
			else
				$vCondition = $vCondition." AND B.lv010='$vSalerID' ";
		}
		if($vlv007!="")
		{
			if($vlv007_opt==1)
				$vCondition = $vCondition." AND B.lv007!='$vlv007' ";
			else
				$vCondition = $vCondition." AND B.lv007='$vlv007' ";
		}
		if($vCustomerID!="")
		{
			if($vlv005_opt==1)
				$vCondition = $vCondition." AND B.lv002!='$vCustomerID' ";
			else
				$vCondition = $vCondition." AND B.lv002='$vCustomerID' ";
		}
		if($vItemID!="")
		{
				$vCondition = $vCondition." AND A.lv003='$vItemID' ";
		}
		if($vProgramID!="")
		{
				$vCondition = $vCondition." AND B.lv011 in ('".str_replace(",","','",$vProgramID)."') ";
		}
		if($vGift!="")
		{
				$vCondition = $vCondition." AND A.lv016='$vGift' ";
		}
		if($vtax!="")
		{
				$vCondition = $vCondition." AND B.lv015='$vtax' ";
		}
		if($vCateID!="")
		{
			if($vCateOpt==1)
			{
				$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
				$vCondition = $vCondition." AND A.lv002 in ($vlscate) ";
			}
			else
			{
				$vlscate=$this->LV_GET_ITEMS_CATE($vCateID);
				$vCondition = $vCondition." AND A.lv003 in ($vlscate) ";
			}
		}
		$sqlS = "select A.*,concat(E.lv002,'(',E.lv001,')') ProgramName,J.lv002 RoomName,B.lv022 CKTM,D.lv002 UnitName,C.lv002 ItemName,B.lv001 InvoiceID,B.lv004 DateInvoice,B.lv005 DateInvoiceTo,B.lv002 CustomerID,B.lv003 CustomerName,B.lv009 CustomerAdd,B.lv013 CustomerNote,B.lv010 EmployeeID,TIME_TO_SEC(substr(B.lv004,12,8)) timeview,TIME_TO_SEC(TIMEDIFF('24:00:00',substr(B.lv004,12,8))) timeagain,TIME_TO_SEC('24:00:00') h24,DATEDIFF(B.lv005,B.lv004) days,TIME_TO_SEC(substr(B.lv005,12,8)) curtime from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 left join sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on A.lv003=D.lv001 left join sl_lv0059 E on A.lv009=E.lv001  left join sl_lv0009 J on B.lv007=J.lv001 where 1=1 $vCondition";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vsum07=0;
		$vsum08=0;
		$vsum09=0;
		$vsum10=0;
		$vsum11=0;
		$vsum12=0;
		$vsum13=0;
		$vsum14=0;
		$vsum17=0;
		$vincrease=0;
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$vincrease++;
					if($vtInventorylv001 != $arrS['InvoiceID']){
						$vOrder++;
						$vtInventorylv001 = $arrS['InvoiceID'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@902", $vOrder, $vLineRun);$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $arrS['RoomName'], $vLineRun);
						$vLineRun = str_replace("@18", $vtInventorylv001, $vLineRun);
						//CustomerID
						$vLineRun = str_replace("@10", $arrS['CustomerID']."&nbsp;", $vLineRun);
						//Customer Name
						$vLineRun = str_replace("@11", $arrS['CustomerName']."&nbsp;", $vLineRun);
						$vLineRun = str_replace("@19", $arrS['CustomerAdd']."&nbsp;", $vLineRun);
						$vLineRun = str_replace("@20", $arrS['CustomerNote']."&nbsp;", $vLineRun);
						$vLineRun = str_replace("@16", $arrS['EmployeeID'], $vLineRun);
						$vLineRun = str_replace("@04", $this->FormatView($arrS['DateInvoice'],4), $vLineRun);						
						$vLineRun = str_replace("@12", $this->FormatView($arrS['DateInvoiceTo'],4), $vLineRun);
						$timeview=$arrS['timeview'];
						$curtime=$arrS['curtime'];
						$timeagain=$arrS['timeagain'];
						$days=$arrS['days'];
						$h24=$arrS['h24'];
						if($days>0)
							$limittime=$timeagain+($days-1)*$h24+$curtime;
						else
							$limittime=$curtime-$timeview;
						$sumlimittime=$sumlimittime+$limittime;
						$vLineRun = str_replace("@13", $this->sec_to_times($limittime), $vLineRun);
						
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;
				$vLineRun = str_replace("@02", $vincrease, $vLineRun);
				
				$vLineRun = str_replace("@05", $arrS['lv003'], $vLineRun);				
				$vLineRun = str_replace("@06", $arrS['ItemName'], $vLineRun);
				$vsum07=$vsum07+$arrS['lv004'];
				$vLineRun = str_replace("@07", $this->FormatView($arrS['lv004'],10), $vLineRun);
				$vLineRun = str_replace("@08", $this->FormatView($arrS['lv006'],10), $vLineRun);
				$lvCKTM=$arrS['lv011']*$arrS['lv004']*$arrS['lv006']/100+$arrS['CKTM']*($arrS['lv004']*$arrS['lv006'])/100;
				$vsumCKTM=$vsumCKTM+$lvCKTM;
				$vsum09=$vsum09+$arrS['lv004']*$arrS['lv006']-$lvCKTM;
				//$vsum09=$vsum09+$arrS['lv004']*$arrS['lv006'];
				$vLineRun = str_replace("@09", $this->FormatView($arrS['lv004']*$arrS['lv006']-$lvCKTM,10), $vLineRun);
				$vsum10=$vsum10+$arrS['lv011'];
				
				//$vsum11=$vsum11+$arrS['lv011']*$arrS['lv004']*$arrS['lv006']/100;
				//$lvCKTM=$arrS['CKTM']*($arrS['lv004']*$arrS['lv006'])/100;
				//$vsumCKTM=$vsumCKTM+$lvCKTM;
				
				$vLineRun = str_replace("@12", $this->FormatView($arrS['lv008'],10), $vLineRun);
				$vsum13=$vsum13+$arrS['lv008']*$arrS['lv006']*$arrS['lv004']/100;
				$vLineRun = str_replace("@13", $this->FormatView($arrS['lv008']*$arrS['lv006']*$arrS['lv004']/100,10), $vLineRun);	
				$vsum14=$vsum14+$arrS['lv012'];
				$vLineRun = str_replace("@14", $this->FormatView($arrS['lv012'],10), $vLineRun);	
				$vLineRun = str_replace("@15", $arrS['ProgramName'], $vLineRun);		
				
				$TT18=$arrS['lv004']*$arrS['lv006']+$arrS['lv004']*$arrS['lv006']*$arrS['lv008']/100-$arrS['lv004']*$arrS['lv006']*$arrS['lv011']/100-$lvCKTM;
				$vsum18=$vsum18+$TT18;				
				$vLineRun = str_replace("@18", $this->FormatView($TT18,10), $vLineRun);	
				$vLineRun = str_replace("@21",$this->FormatView($lvCKTM,10), $vLineRun);
				if($arrS['ReOutlv004']+$arrS['InOutlv004']==0)
				$vPrice=0;
				else
				$vPrice=($arrS['PriceReOutlv004']+$arrS['PriceInOutlv004'])/($arrS['ReOutlv004']+$arrS['InOutlv004'])	;
				$sumquanlity=( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']);
				$vLineRun = str_replace("@09",LCurrency($sumquanlity ,$plang), $vLineRun);
				$sum=((float)$vPrice)*$sumquanlity;
				$vLineRun = str_replace("@17",Lcurrency($sum,$plang), $vLineRun);		
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@60", '', $vLineRun);	
						break;
					case 3:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					case 4:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					default:
						$strreturn=$this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001);
						if($strreturn=="")
							$strReplace="";
						else
						$strReplace="<tr>
							<td colspan=\"17\">".$strreturn."</td></tr>";
						$vLineRun = str_replace("@60",$strReplace, $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@07",$this->FormatView($vsum07,10),$vRowLast);
		$vRowLast=str_replace("@09",$this->FormatView($vsum09,10),$vRowLast);
		$vRowLast=str_replace("@11",$this->FormatView($vsum11,10),$vRowLast);
		$vRowLast=str_replace("@21",$this->FormatView($vsumCKTM,10),$vRowLast);
		$vRowLast=str_replace("@13",$this->FormatView($vsum13,10),$vRowLast);
		$vRowLast=str_replace("@14",$this->FormatView($vsum14,10),$vRowLast);
		$vRowLast=str_replace("@18",$this->FormatView($vsum18,10),$vRowLast);
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", 'Bàn', $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", 'Giờ bắt đầu', $vHeader);
		//Item
		$vHeader = str_replace("@05",$vArrLang[5], $vHeader);
		//Name Item
		$vHeader = str_replace("@06", $vArrLang[6], $vHeader);
		//Quantity
		$vHeader = str_replace("@07", $vArrLang[22], $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
			//Discount
		$vHeader = str_replace("@10","CMND", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11","Tên khách hàng", $vHeader);
		//Tax
		$vHeader = str_replace("@12",'Giờ kết thúc', $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13","Tổng giờ", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",$vArrLang[53], $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",$vArrLang[27], $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[23], $vHeader);	
		$vHeader = str_replace("@19","Địa chỉ", $vHeader);	
		$vHeader = str_replace("@20","Ghi chú", $vHeader);	
		$vHeader = str_replace("@21",'Tiền chiết khấu', $vHeader);	
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function PrintInOutPutInStock($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$vCustomerID,$vlv005_opt,$vSalerID,$vlv013_opt,$vItemID,$vProgramID,$vGift,$vCateID,$vCateOpt,$vtax,$vlv007,$vlv007_opt)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"5%\" ondblclick=\"RemoveCol('col_4',this,@!79)\" style=\"cursor:pointer\">@05</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_5',this,@!79)\" style=\"cursor:pointer\">@06</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_6',this,@!79)\" style=\"cursor:pointer\">@07</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_7',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@08</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@09</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_9',this,@!79)\" style=\"cursor:pointer\">@10</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_10',this,@!79)\" style=\"cursor:pointer\">@11</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_18',this,@!79)\" style=\"cursor:pointer\">@19</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_19',this,@!79)\" style=\"cursor:pointer\">@20</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_11',this,@!79)\" style=\"cursor:pointer\">@12</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_12',this,@!79)\" style=\"cursor:pointer\">@13</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_17',this,@!79)\" style=\"cursor:pointer\">@18</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_13',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@14</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@902</td>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\">@06</td>
				<td class=\"right_style\" id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" id=\"col_7_@02\" style=\"background-color:#eee\">@08</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\">@09</td>	
				<td class=\"right_style\" id=\"col_9_@02\" >@10</td>
				<td class=\"right_style\" id=\"col_10_@02\">@11</td>
				<td class=\"right_style\" id=\"col_18_@02\" >@19</td>
				<td class=\"right_style\" id=\"col_19_@02\">@20</td>
				<td class=\"right_style\" id=\"col_11_@02\">@12</td>
				<td class=\"right_style\" id=\"col_12_@02\">@13</td>
				<td class=\"right_style\" id=\"col_17_@02\">@18</td>	
				<td class=\"right_style\" id=\"col_13_@02\">@14</td>
			</tr>
			@60
			";
		$vRowLast="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"left_style\" id=\"col_4_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_5_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_6_@02\"><strong>@07</td>
				<td class=\"right_style\" id=\"col_7_@02\" style=\"background-color:#eee\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\"><strong>@09</strong></td>	
				<td class=\"right_style\" id=\"col_9_@02\" >&nbsp;</td>
				<td class=\"right_style\" id=\"col_10_@02\"><strong>@11</td>
				<td class=\"right_style\" id=\"col_18_@02\" >&nbsp;</td>
				<td class=\"right_style\" id=\"col_19_@02\"><strong>@20</td>
				<td class=\"right_style\" id=\"col_11_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_12_@02\"><strong>@13</td>
				<td class=\"right_style\" id=\"col_17_@02\"><strong>@18</strong></td>	
				<td class=\"right_style\" id=\"col_13_@02\" style=\"background-color:#eee\"><strong>@14</strong></td>
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\" id=\"col_4_@02\">@05	</td>
				<td class=\"right_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"right_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_7_@02\">@08</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_8_@02\">@09</td>	
				<td class=\"right_style\"  id=\"col_9_@02\">@10</td>
				<td class=\"right_style\"  id=\"col_10_@02\">@11</td>
				<td class=\"right_style\"  id=\"col_18_@02\">@19</td>
				<td class=\"right_style\"  id=\"col_19_@02\">@20</td>
				<td class=\"right_style\"  id=\"col_11_@02\">@12</td>
				<td class=\"right_style\"  id=\"col_12_@02\">@13</td>
				<td class=\"right_style\"  id=\"col_17_@02\">@18</td>
				<td class=\"right_style\"  id=\"col_13_@02\">@14</td>				
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="")
		{
			$vCondition = $vCondition." AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		}
		if($vSalerID!="")
		{
			if($vlv013_opt==1)
				$vCondition = $vCondition." AND B.lv010!='$vSalerID' ";
			else
				$vCondition = $vCondition." AND B.lv010='$vSalerID' ";
		}
		if($vlv007!="")
		{
			if($vlv007_opt==1)
				$vCondition = $vCondition." AND B.lv007!='$vlv007' ";
			else
				$vCondition = $vCondition." AND B.lv007='$vlv007' ";
		}
		if($vCustomerID!="")
		{
			if($vlv005_opt==1)
				$vCondition = $vCondition." AND B.lv002!='$vCustomerID' ";
			else
				$vCondition = $vCondition." AND B.lv002='$vCustomerID' ";
		}
		if($vItemID!="")
		{
				$vCondition = $vCondition." AND A.lv003='$vItemID' ";
		}
		if($vProgramID!="")
		{
				$vCondition = $vCondition." AND B.lv011 in ('".str_replace(",","','",$vProgramID)."') ";
		}
		if($vGift!="")
		{
				$vCondition = $vCondition." AND A.lv016='$vGift' ";
		}
		if($vtax!="")
		{
				$vCondition = $vCondition." AND B.lv015='$vtax' ";
		}
		if($vCateID!="")
		{
			if($vCateOpt==1)
			{
				$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
				$vCondition = $vCondition." AND A.lv002 in ($vlscate) ";
			}
			else
			{
				$vlscate=$this->LV_GET_ITEMS_CATE($vCateID);
				$vCondition = $vCondition." AND A.lv003 in ($vlscate) ";
			}
		}
		 $sqlS = "select A.lv003,A.lv004,A.lv006,A.lv008,A.lv011,A.lv012,B.lv022 CKTM,C.lv002 ItemName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 left join sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on A.lv003=D.lv001 left join sl_lv0059 E on A.lv009=E.lv001 where 1=1 $vCondition order by A.lv003 asc";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vsum07=0;
		$vsum08=0;
		$vsum09=0;
		$vsum10=0;
		$vsum11=0;
		$vsum12=0;
		$vsum13=0;
		$vsum14=0;
		$vsum17=0;
		$vincrease=0;
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$vincrease++;
					if($vtInventorylv001 != $arrS['lv003']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv003'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@902", $vOrder, $vLineRun);$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;
				$vLineRun = str_replace("@02", $vincrease, $vLineRun);
				$vLineRun = str_replace("@04", $this->FormatView($arrS['DateInvoice'],2), $vLineRun);
				$vLineRun = str_replace("@05", $arrS['lv003'], $vLineRun);				
				$vLineRun = str_replace("@06", $arrS['ItemName'], $vLineRun);
				$vsum07=$vsum07+$arrS['lv004'];
				$vLineRun = str_replace("@07", $this->FormatView($arrS['lv004'],10), $vLineRun);
				$vLineRun = str_replace("@08", $this->FormatView($arrS['lv006'],10), $vLineRun);
				$vsum09=$vsum09+$arrS['lv004']*$arrS['lv006'];
				$vLineRun = str_replace("@09", $this->FormatView($arrS['lv004']*$arrS['lv006'],10), $vLineRun);
				$vsum10=$vsum10+$arrS['lv011'];
				$vLineRun = str_replace("@10", $this->FormatView($arrS['lv011'],10), $vLineRun);
				$vsum11=$vsum11+$arrS['lv011']*$arrS['lv004']*$arrS['lv006']/100;
				$lvCKTM=$arrS['CKTM']*($arrS['lv004']*$arrS['lv006'])/100;
				$vsumCKTM=$vsumCKTM+$lvCKTM;
				$vLineRun = str_replace("@11", $this->FormatView($arrS['lv011']*$arrS['lv004']*$arrS['lv006']/100,10), $vLineRun);
				$vLineRun = str_replace("@19", $this->FormatView($arrS['CKTM'],10), $vLineRun);
				$vLineRun = str_replace("@20", $this->FormatView($lvCKTM,10), $vLineRun);
				$vLineRun = str_replace("@12", $this->FormatView($arrS['lv008'],10), $vLineRun);
				$vsum13=$vsum13+$arrS['lv008']*$arrS['lv006']*$arrS['lv004']/100;
				$vLineRun = str_replace("@13", $this->FormatView($arrS['lv008']*$arrS['lv006']*$arrS['lv004']/100,10), $vLineRun);	
				$vsum14=$vsum14+$arrS['lv012'];
				$vLineRun = str_replace("@14", $this->FormatView($arrS['lv012'],10), $vLineRun);	
				$vLineRun = str_replace("@15", $arrS['ProgramName'], $vLineRun);		
				$vLineRun = str_replace("@16", $arrS['EmployeeID'], $vLineRun);
				$vLineRun = str_replace("@17", $arrS['CustomerID'], $vLineRun);
				$TT18=$arrS['lv004']*$arrS['lv006']+$arrS['lv004']*$arrS['lv006']*$arrS['lv008']/100-$arrS['lv004']*$arrS['lv006']*$arrS['lv011']/100-$lvCKTM;
				$vsum18=$vsum18+$TT18;				
				$vLineRun = str_replace("@18", $this->FormatView($TT18,10), $vLineRun);	
				$vLineRun = str_replace("@21", $this->getvaluelink('lv016',$arrS['lv016']), $vLineRun);	
				if($arrS['ReOutlv004']+$arrS['InOutlv004']==0)
				$vPrice=0;
				else
				$vPrice=($arrS['PriceReOutlv004']+$arrS['PriceInOutlv004'])/($arrS['ReOutlv004']+$arrS['InOutlv004'])	;
				$sumquanlity=( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']);
				$vLineRun = str_replace("@09",LCurrency($sumquanlity ,$plang), $vLineRun);
				$sum=((float)$vPrice)*$sumquanlity;
				$vLineRun = str_replace("@17",Lcurrency($sum,$plang), $vLineRun);		
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@60", '', $vLineRun);	
						break;
					case 3:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					case 4:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					default:
						$strreturn=$this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001);
						if($strreturn=="")
							$strReplace="";
						else
						$strReplace="<tr>
							<td colspan=\"17\">".$strreturn."</td></tr>";
						$vLineRun = str_replace("@60",$strReplace, $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@07",$this->FormatView($vsum07,10),$vRowLast);
		$vRowLast=str_replace("@09",$this->FormatView($vsum09,10),$vRowLast);
		$vRowLast=str_replace("@11",$this->FormatView($vsum11,10),$vRowLast);
		$vRowLast=str_replace("@20",$this->FormatView($vsumCKTM,10),$vRowLast);
		$vRowLast=str_replace("@13",$this->FormatView($vsum13,10),$vRowLast);
		$vRowLast=str_replace("@14",$this->FormatView($vsum14,10),$vRowLast);
		$vRowLast=str_replace("@18",$this->FormatView($vsum18,10),$vRowLast);
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[23], $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", $vArrLang[24], $vHeader);
		//Item
		$vHeader = str_replace("@05",$vArrLang[5], $vHeader);
		//Name Item
		$vHeader = str_replace("@06", $vArrLang[6], $vHeader);
		//Quantity
		$vHeader = str_replace("@07", $vArrLang[22], $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
		//Discount
		$vHeader = str_replace("@10",$vArrLang[50]."(%)", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11",$vArrLang[54]."(vnđ)", $vHeader);
		//Tax
		$vHeader = str_replace("@12",$vArrLang[49], $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13",$vArrLang[57]."(vnđ)", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",$vArrLang[53], $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",$vArrLang[27], $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[55]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@19",$vArrLang[58], $vHeader);	
		$vHeader = str_replace("@20",$vArrLang[59]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@21",$vArrLang[60], $vHeader);	
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}
function PrintInOutPutInStockSum($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$vCustomerID,$vlv005_opt,$vSalerID,$vlv013_opt,$vItemID,$vProgramID,$vGift,$vCateID,$vCateOpt,$vtax,$vlv007,$vlv007_opt)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"5%\" ondblclick=\"RemoveCol('col_4',this,@!79)\" style=\"cursor:pointer\">@05</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_5',this,@!79)\" style=\"cursor:pointer\">@06</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_6',this,@!79)\" style=\"cursor:pointer\">@07</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@09</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_10',this,@!79)\" style=\"cursor:pointer\">@11</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_19',this,@!79)\" style=\"cursor:pointer\">@20</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_12',this,@!79)\" style=\"cursor:pointer\">@13</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_17',this,@!79)\" style=\"cursor:pointer\">@18</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_13',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@14</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@902</td>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\">@06</td>
				<td class=\"right_style\" id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\">@09</td>	
				<td class=\"right_style\" id=\"col_10_@02\">@11</td>
				<td class=\"right_style\" id=\"col_19_@02\">@20</td>
				<td class=\"right_style\" id=\"col_12_@02\">@13</td>
				<td class=\"right_style\" id=\"col_17_@02\">@18</td>	
				<td class=\"right_style\" id=\"col_13_@02\">@14</td>
			</tr>
			@60
			";
		$vRowLast="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"left_style\" id=\"col_4_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_5_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_6_@02\"><strong>@07</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\"><strong>@09</strong></td>	
				<td class=\"right_style\" id=\"col_10_@02\"><strong>@11</td>
				<td class=\"right_style\" id=\"col_19_@02\"><strong>@20</td>
				<td class=\"right_style\" id=\"col_12_@02\"><strong>@13</td>
				<td class=\"right_style\" id=\"col_17_@02\"><strong>@18</strong></td>	
				<td class=\"right_style\" id=\"col_13_@02\" style=\"background-color:#eee\"><strong>@14</strong></td>
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\" id=\"col_4_@02\">@05	</td>
				<td class=\"right_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"right_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_7_@02\">@08</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_8_@02\">@09</td>	
				<td class=\"right_style\"  id=\"col_9_@02\">@10</td>
				<td class=\"right_style\"  id=\"col_10_@02\">@11</td>
				<td class=\"right_style\"  id=\"col_18_@02\">@19</td>
				<td class=\"right_style\"  id=\"col_19_@02\">@20</td>
				<td class=\"right_style\"  id=\"col_11_@02\">@12</td>
				<td class=\"right_style\"  id=\"col_12_@02\">@13</td>
				<td class=\"right_style\"  id=\"col_17_@02\">@18</td>
				<td class=\"right_style\"  id=\"col_13_@02\">@14</td>				
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="")
		{
			$vCondition = $vCondition." AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		}
		if($vSalerID!="")
		{
			if($vlv013_opt==1)
				$vCondition = $vCondition." AND B.lv010!='$vSalerID' ";
			else
				$vCondition = $vCondition." AND B.lv010='$vSalerID' ";
		}
		if($vlv007!="")
		{
			if($vlv007_opt==1)
				$vCondition = $vCondition." AND B.lv007!='$vlv007' ";
			else
				$vCondition = $vCondition." AND B.lv007='$vlv007' ";
		}
		if($vCustomerID!="")
		{
			if($vlv005_opt==1)
				$vCondition = $vCondition." AND B.lv002!='$vCustomerID' ";
			else
				$vCondition = $vCondition." AND B.lv002='$vCustomerID' ";
		}
		if($vItemID!="")
		{
				$vCondition = $vCondition." AND A.lv003='$vItemID' ";
		}
		if($vProgramID!="")
		{
				$vCondition = $vCondition." AND B.lv011 in ('".str_replace(",","','",$vProgramID)."') ";
		}
		if($vGift!="")
		{
				$vCondition = $vCondition." AND A.lv016='$vGift' ";
		}
		if($vtax!="")
		{
				$vCondition = $vCondition." AND B.lv015='$vtax' ";
		}
		if($vCateID!="")
		{
			if($vCateOpt==1)
			{
				$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
				$vCondition = $vCondition." AND A.lv002 in ($vlscate) ";
			}
			else
			{
				$vlscate=$this->LV_GET_ITEMS_CATE($vCateID);
				$vCondition = $vCondition." AND A.lv003 in ($vlscate) ";
			}
		}
		$sqlS = "select A.lv003,sum(A.lv004) sl,sum(A.lv004*A.lv006) thanhtien,sum(A.lv004*A.lv006*A.lv008/100) thue,sum(A.lv004*A.lv006*A.lv011/100) chietkhau,sum(A.lv012) diem,sum(A.lv004*A.lv006*B.lv022/100) CKTM,C.lv002 ItemName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 left join sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on A.lv003=D.lv001 left join sl_lv0059 E on A.lv009=E.lv001 where 1=1 $vCondition group by A.lv003";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vsum07=0;
		$vsum08=0;
		$vsum09=0;
		$vsum10=0;
		$vsum11=0;
		$vsum12=0;
		$vsum13=0;
		$vsum14=0;
		$vsum17=0;
		$vincrease=0;
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$vincrease++;
					if($vtInventorylv001 != $arrS['lv003']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv003'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@902", $vOrder, $vLineRun);$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;
				$vLineRun = str_replace("@02", $vincrease, $vLineRun);
				$vLineRun = str_replace("@04", $this->FormatView($arrS['DateInvoice'],2), $vLineRun);
				$vLineRun = str_replace("@05", $arrS['lv003'], $vLineRun);				
				$vLineRun = str_replace("@06", $arrS['ItemName'], $vLineRun);
				$vsum07=$vsum07+$arrS['sl'];
				$vLineRun = str_replace("@07", $this->FormatView($arrS['sl'],10), $vLineRun);
				$vLineRun = str_replace("@08", $this->FormatView($arrS['lv006'],10), $vLineRun);
				$vsum09=$vsum09+$arrS['thanhtien'];
				$vLineRun = str_replace("@09", $this->FormatView($arrS['thanhtien'],10), $vLineRun);
				$vsum10=$vsum10+$arrS['lv011'];
				$vLineRun = str_replace("@10", $this->FormatView($arrS['lv011'],10), $vLineRun);
				$vsum11=$vsum11+$arrS['chietkhau'];
				$lvCKTM=$arrS['CKTM'];
				$vsumCKTM=$vsumCKTM+$arrS['CKTM'];
				$vLineRun = str_replace("@11", $this->FormatView($arrS['chietkhau'],10), $vLineRun);
				$vLineRun = str_replace("@19", $this->FormatView($arrS['CKTM'],10), $vLineRun);
				$vLineRun = str_replace("@20", $this->FormatView($lvCKTM,10), $vLineRun);
				$vLineRun = str_replace("@12", $this->FormatView($arrS['lv008'],10), $vLineRun);
				$vsum13=$vsum13+$arrS['thue'];
				$vLineRun = str_replace("@13", $this->FormatView($arrS['thue'],10), $vLineRun);	
				$vsum14=$vsum14+$arrS['diem'];
				$vLineRun = str_replace("@14", $this->FormatView($arrS['diem'],10), $vLineRun);	
				$vLineRun = str_replace("@15", $arrS['ProgramName'], $vLineRun);		
				$vLineRun = str_replace("@16", $arrS['EmployeeID'], $vLineRun);
				$vLineRun = str_replace("@17", $arrS['CustomerID'], $vLineRun);
				$TT18=$arrS['thanhtien']+$arrS['thue']-$arrS['chietkhau']-$lvCKTM;
				$vsum18=$vsum18+$TT18;				
				$vLineRun = str_replace("@18", $this->FormatView($TT18,10), $vLineRun);	
				$vLineRun = str_replace("@21", $this->getvaluelink('lv016',$arrS['lv016']), $vLineRun);	
				if($arrS['ReOutlv004']+$arrS['InOutlv004']==0)
				$vPrice=0;
				else
				$vPrice=($arrS['PriceReOutlv004']+$arrS['PriceInOutlv004'])/($arrS['ReOutlv004']+$arrS['InOutlv004'])	;
				$sumquanlity=( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']);
				$vLineRun = str_replace("@09",LCurrency($sumquanlity ,$plang), $vLineRun);
				$sum=((float)$vPrice)*$sumquanlity;
				$vLineRun = str_replace("@17",Lcurrency($sum,$plang), $vLineRun);		
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@60", '', $vLineRun);	
						break;
					case 3:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					case 4:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					default:
						$strreturn=$this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001);
						if($strreturn=="")
							$strReplace="";
						else
						$strReplace="<tr>
							<td colspan=\"17\">".$strreturn."</td></tr>";
						$vLineRun = str_replace("@60",$strReplace, $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@07",$this->FormatView($vsum07,10),$vRowLast);
		$vRowLast=str_replace("@09",$this->FormatView($vsum09,10),$vRowLast);
		$vRowLast=str_replace("@11",$this->FormatView($vsum11,10),$vRowLast);
		$vRowLast=str_replace("@20",$this->FormatView($vsumCKTM,10),$vRowLast);
		$vRowLast=str_replace("@13",$this->FormatView($vsum13,10),$vRowLast);
		$vRowLast=str_replace("@14",$this->FormatView($vsum14,10),$vRowLast);
		$vRowLast=str_replace("@18",$this->FormatView($vsum18,10),$vRowLast);
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[23], $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", $vArrLang[24], $vHeader);
		//Item
		$vHeader = str_replace("@05",$vArrLang[5], $vHeader);
		//Name Item
		$vHeader = str_replace("@06", $vArrLang[6], $vHeader);
		//Quantity
		$vHeader = str_replace("@07", $vArrLang[22], $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
		//Discount
		$vHeader = str_replace("@10",$vArrLang[50]."(%)", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11",$vArrLang[54]."(vnđ)", $vHeader);
		//Tax
		$vHeader = str_replace("@12",$vArrLang[49], $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13",$vArrLang[57]."(vnđ)", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",$vArrLang[53], $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",$vArrLang[27], $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[55]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@19",$vArrLang[58], $vHeader);	
		$vHeader = str_replace("@20",$vArrLang[59]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@21",$vArrLang[60], $vHeader);	
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function PrintInOutPutInStockCustomer($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$vCustomerID,$vlv005_opt,$vSalerID,$vlv013_opt,$vItemID,$vProgramID,$vGift,$vCateID,$vCateOpt,$vtax,$vlv007,$vlv007_opt)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"5%\" ondblclick=\"RemoveCol('col_4',this,@!79)\" style=\"cursor:pointer\">@05</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_5',this,@!79)\" style=\"cursor:pointer\">@06</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_6',this,@!79)\" style=\"cursor:pointer\">@07</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@09</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_10',this,@!79)\" style=\"cursor:pointer\">@11</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_19',this,@!79)\" style=\"cursor:pointer\">@20</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_12',this,@!79)\" style=\"cursor:pointer\">@13</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_17',this,@!79)\" style=\"cursor:pointer\">@18</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_13',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@14</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@902</td>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\">@06</td>
				<td class=\"right_style\" id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\">@09</td>	
				<td class=\"right_style\" id=\"col_10_@02\">@11</td>
				<td class=\"right_style\" id=\"col_19_@02\">@20</td>
				<td class=\"right_style\" id=\"col_12_@02\">@13</td>
				<td class=\"right_style\" id=\"col_17_@02\">@18</td>	
				<td class=\"right_style\" id=\"col_13_@02\">@14</td>
			</tr>
			@60
			";
		$vRowLast="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"left_style\" id=\"col_4_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_5_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_6_@02\"><strong>@07</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\"><strong>@09</strong></td>	
				<td class=\"right_style\" id=\"col_10_@02\"><strong>@11</td>
				<td class=\"right_style\" id=\"col_19_@02\"><strong>@20</td>
				<td class=\"right_style\" id=\"col_12_@02\"><strong>@13</td>
				<td class=\"right_style\" id=\"col_17_@02\"><strong>@18</strong></td>	
				<td class=\"right_style\" id=\"col_13_@02\" style=\"background-color:#eee\"><strong>@14</strong></td>
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\" id=\"col_4_@02\">@05	</td>
				<td class=\"right_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"right_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_7_@02\">@08</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_8_@02\">@09</td>	
				<td class=\"right_style\"  id=\"col_9_@02\">@10</td>
				<td class=\"right_style\"  id=\"col_10_@02\">@11</td>
				<td class=\"right_style\"  id=\"col_18_@02\">@19</td>
				<td class=\"right_style\"  id=\"col_19_@02\">@20</td>
				<td class=\"right_style\"  id=\"col_11_@02\">@12</td>
				<td class=\"right_style\"  id=\"col_12_@02\">@13</td>
				<td class=\"right_style\"  id=\"col_17_@02\">@18</td>
				<td class=\"right_style\"  id=\"col_13_@02\">@14</td>				
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="")
		{
			$vCondition = $vCondition." AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		}
		if($vSalerID!="")
		{
			if($vlv013_opt==1)
				$vCondition = $vCondition." AND B.lv010!='$vSalerID' ";
			else
				$vCondition = $vCondition." AND B.lv010='$vSalerID' ";
		}
		if($vlv007!="")
		{
			if($vlv007_opt==1)
				$vCondition = $vCondition." AND B.lv007!='$vlv007' ";
			else
				$vCondition = $vCondition." AND B.lv007='$vlv007' ";
		}
		if($vCustomerID!="")
		{
			if($vlv005_opt==1)
				$vCondition = $vCondition." AND B.lv002!='$vCustomerID' ";
			else
				$vCondition = $vCondition." AND B.lv002='$vCustomerID' ";
		}
		if($vItemID!="")
		{
				$vCondition = $vCondition." AND A.lv003='$vItemID' ";
		}
		if($vProgramID!="")
		{
				$vCondition = $vCondition." AND B.lv011 in ('".str_replace(",","','",$vProgramID)."') ";
		}
		if($vGift!="")
		{
				$vCondition = $vCondition." AND A.lv016='$vGift' ";
		}
		if($vtax!="")
		{
				$vCondition = $vCondition." AND B.lv015='$vtax' ";
		}
		if($vCateID!="")
		{
			if($vCateOpt==1)
			{
				$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
				$vCondition = $vCondition." AND A.lv002 in ($vlscate) ";
			}
			else
			{
				$vlscate=$this->LV_GET_ITEMS_CATE($vCateID);
				$vCondition = $vCondition." AND A.lv003 in ($vlscate) ";
			}
		}
		 $sqlS = "select B.lv002 lv003,sum(A.lv004) sl,sum(A.lv004*A.lv006) thanhtien,sum(A.lv004*A.lv006*A.lv008/100) thue,sum(A.lv004*A.lv006*A.lv011/100) chietkhau,sum(A.lv012) diem,sum(A.lv004*A.lv006*B.lv022/100) CKTM,C.lv002 CusName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 left join sl_lv0001 C on B.lv002=C.lv001 left join sl_lv0005 D on A.lv003=D.lv001 left join sl_lv0059 E on A.lv009=E.lv001 where 1=1 $vCondition group by lv003";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vsum07=0;
		$vsum08=0;
		$vsum09=0;
		$vsum10=0;
		$vsum11=0;
		$vsum12=0;
		$vsum13=0;
		$vsum14=0;
		$vsum17=0;
		$vincrease=0;
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$vincrease++;
					if($vtInventorylv001 != $arrS['lv003']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv003'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@902", $vOrder, $vLineRun);$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;
				$vLineRun = str_replace("@02", $vincrease, $vLineRun);
				$vLineRun = str_replace("@04", $this->FormatView($arrS['DateInvoice'],2), $vLineRun);
				$vLineRun = str_replace("@05", $arrS['lv003'], $vLineRun);				
				$vLineRun = str_replace("@06", $arrS['CusName'], $vLineRun);
				$vsum07=$vsum07+$arrS['sl'];
				$vLineRun = str_replace("@07", $this->FormatView($arrS['sl'],10), $vLineRun);
				$vLineRun = str_replace("@08", $this->FormatView($arrS['lv006'],10), $vLineRun);
				$vsum09=$vsum09+$arrS['thanhtien'];
				$vLineRun = str_replace("@09", $this->FormatView($arrS['thanhtien'],10), $vLineRun);
				$vsum10=$vsum10+$arrS['lv011'];
				$vLineRun = str_replace("@10", $this->FormatView($arrS['lv011'],10), $vLineRun);
				$vsum11=$vsum11+$arrS['chietkhau'];
				$lvCKTM=$arrS['CKTM'];
				$vsumCKTM=$vsumCKTM+$arrS['CKTM'];
				$vLineRun = str_replace("@11", $this->FormatView($arrS['chietkhau'],10), $vLineRun);
				$vLineRun = str_replace("@19", $this->FormatView($arrS['CKTM'],10), $vLineRun);
				$vLineRun = str_replace("@20", $this->FormatView($lvCKTM,10), $vLineRun);
				$vLineRun = str_replace("@12", $this->FormatView($arrS['lv008'],10), $vLineRun);
				$vsum13=$vsum13+$arrS['thue'];
				$vLineRun = str_replace("@13", $this->FormatView($arrS['thue'],10), $vLineRun);	
				$vsum14=$vsum14+$arrS['diem'];
				$vLineRun = str_replace("@14", $this->FormatView($arrS['diem'],10), $vLineRun);	
				$vLineRun = str_replace("@15", $arrS['ProgramName'], $vLineRun);		
				$vLineRun = str_replace("@16", $arrS['EmployeeID'], $vLineRun);
				$vLineRun = str_replace("@17", $arrS['CustomerID'], $vLineRun);
				$TT18=$arrS['thanhtien']+$arrS['thue']-$arrS['chietkhau']-$lvCKTM;
				$vsum18=$vsum18+$TT18;				
				$vLineRun = str_replace("@18", $this->FormatView($TT18,10), $vLineRun);	
				$vLineRun = str_replace("@21", $this->getvaluelink('lv016',$arrS['lv016']), $vLineRun);	
				if($arrS['ReOutlv004']+$arrS['InOutlv004']==0)
				$vPrice=0;
				else
				$vPrice=($arrS['PriceReOutlv004']+$arrS['PriceInOutlv004'])/($arrS['ReOutlv004']+$arrS['InOutlv004'])	;
				$sumquanlity=( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']);
				$vLineRun = str_replace("@09",LCurrency($sumquanlity ,$plang), $vLineRun);
				$sum=((float)$vPrice)*$sumquanlity;
				$vLineRun = str_replace("@17",Lcurrency($sum,$plang), $vLineRun);		
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@60", '', $vLineRun);	
						break;
					case 3:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					case 4:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					default:
						$strreturn=$this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001);
						if($strreturn=="")
							$strReplace="";
						else
						$strReplace="<tr>
							<td colspan=\"17\">".$strreturn."</td></tr>";
						$vLineRun = str_replace("@60",$strReplace, $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@07",$this->FormatView($vsum07,10),$vRowLast);
		$vRowLast=str_replace("@09",$this->FormatView($vsum09,10),$vRowLast);
		$vRowLast=str_replace("@11",$this->FormatView($vsum11,10),$vRowLast);
		$vRowLast=str_replace("@20",$this->FormatView($vsumCKTM,10),$vRowLast);
		$vRowLast=str_replace("@13",$this->FormatView($vsum13,10),$vRowLast);
		$vRowLast=str_replace("@14",$this->FormatView($vsum14,10),$vRowLast);
		$vRowLast=str_replace("@18",$this->FormatView($vsum18,10),$vRowLast);
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[23], $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", $vArrLang[24], $vHeader);
		//Item
		$vHeader = str_replace("@05",$vArrLang[61], $vHeader);
		//Name Item
		$vHeader = str_replace("@06", $vArrLang[62], $vHeader);
		//Quantity
		$vHeader = str_replace("@07", $vArrLang[22], $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
		//Discount
		$vHeader = str_replace("@10",$vArrLang[50]."(%)", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11",$vArrLang[54]."(vnđ)", $vHeader);
		//Tax
		$vHeader = str_replace("@12",$vArrLang[49], $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13",$vArrLang[57]."(vnđ)", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",$vArrLang[53], $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",$vArrLang[27], $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[55]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@19",$vArrLang[58], $vHeader);	
		$vHeader = str_replace("@20",$vArrLang[59]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@21",$vArrLang[60], $vHeader);	
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function PrintInOutPutInStockEmp($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$vCustomerID,$vlv005_opt,$vSalerID,$vlv013_opt,$vItemID,$vProgramID,$vGift,$vCateID,$vCateOpt,$vtax,$vlv007,$vlv007_opt)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"5%\" ondblclick=\"RemoveCol('col_4',this,@!79)\" style=\"cursor:pointer\">@05</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_5',this,@!79)\" style=\"cursor:pointer\">@06</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_6',this,@!79)\" style=\"cursor:pointer\">@07</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@09</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_10',this,@!79)\" style=\"cursor:pointer\">@11</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_19',this,@!79)\" style=\"cursor:pointer\">@20</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_12',this,@!79)\" style=\"cursor:pointer\">@13</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_17',this,@!79)\" style=\"cursor:pointer\">@18</td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_13',this,@!79)\" style=\"background-color:#eee;cursor:pointer\">@14</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@902</td>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"right_style\" id=\"col_5_@02\">@06</td>
				<td class=\"right_style\" id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\">@09</td>	
				<td class=\"right_style\" id=\"col_10_@02\">@11</td>
				<td class=\"right_style\" id=\"col_19_@02\">@20</td>
				<td class=\"right_style\" id=\"col_12_@02\">@13</td>
				<td class=\"right_style\" id=\"col_17_@02\">@18</td>	
				<td class=\"right_style\" id=\"col_13_@02\">@14</td>
			</tr>
			@60
			";
		$vRowLast="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >&nbsp;</td>
				<td class=\"left_style\" id=\"col_4_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_5_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_6_@02\"><strong>@07</td>
				<td class=\"right_style\" id=\"col_8_@02\" style=\"background-color:#eee\"><strong>@09</strong></td>	
				<td class=\"right_style\" id=\"col_10_@02\"><strong>@11</td>
				<td class=\"right_style\" id=\"col_19_@02\"><strong>@20</td>
				<td class=\"right_style\" id=\"col_12_@02\"><strong>@13</td>
				<td class=\"right_style\" id=\"col_17_@02\"><strong>@18</strong></td>	
				<td class=\"right_style\" id=\"col_13_@02\" style=\"background-color:#eee\"><strong>@14</strong></td>
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\" id=\"col_4_@02\">@05	</td>
				<td class=\"right_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"right_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_7_@02\">@08</td>
				<td class=\"right_style\" style=\"background-color:#eee\"  id=\"col_8_@02\">@09</td>	
				<td class=\"right_style\"  id=\"col_9_@02\">@10</td>
				<td class=\"right_style\"  id=\"col_10_@02\">@11</td>
				<td class=\"right_style\"  id=\"col_18_@02\">@19</td>
				<td class=\"right_style\"  id=\"col_19_@02\">@20</td>
				<td class=\"right_style\"  id=\"col_11_@02\">@12</td>
				<td class=\"right_style\"  id=\"col_12_@02\">@13</td>
				<td class=\"right_style\"  id=\"col_17_@02\">@18</td>
				<td class=\"right_style\"  id=\"col_13_@02\">@14</td>				
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="")
		{
			$vCondition = $vCondition." AND (YEAR(B.lv004)=YEAR('$vDateStart') AND MONTH(B.lv004)=MONTH('$vDateStart') AND DAY(B.lv004)=DAY('$vDateStart'))";
		}
		if($vSalerID!="")
		{
			if($vlv013_opt==1)
				$vCondition = $vCondition." AND B.lv010!='$vSalerID' ";
			else
				$vCondition = $vCondition." AND B.lv010='$vSalerID' ";
		}
		if($vlv007!="")
		{
			if($vlv007_opt==1)
				$vCondition = $vCondition." AND B.lv007!='$vlv007' ";
			else
				$vCondition = $vCondition." AND B.lv007='$vlv007' ";
		}
		if($vCustomerID!="")
		{
			if($vlv005_opt==1)
				$vCondition = $vCondition." AND B.lv002!='$vCustomerID' ";
			else
				$vCondition = $vCondition." AND B.lv002='$vCustomerID' ";
		}
		if($vItemID!="")
		{
				$vCondition = $vCondition." AND A.lv003='$vItemID' ";
		}
		if($vProgramID!="")
		{
				$vCondition = $vCondition." AND B.lv011 in ('".str_replace(",","','",$vProgramID)."') ";
		}
		if($vGift!="")
		{
				$vCondition = $vCondition." AND A.lv016='$vGift' ";
		}
		if($vtax!="")
		{
				$vCondition = $vCondition." AND B.lv015='$vtax' ";
		}
		if($vCateID!="")
		{
			if($vCateOpt==1)
			{
				$vlscate=$this->LV_GET_DONHANG_CATE($vCateID,$vDateStart);
				$vCondition = $vCondition." AND A.lv002 in ($vlscate) ";
			}
			else
			{
				$vlscate=$this->LV_GET_ITEMS_CATE($vCateID);
				$vCondition = $vCondition." AND A.lv003 in ($vlscate) ";
			}
		}
		 $sqlS = "select B.lv010 lv003,sum(A.lv004) sl,sum(A.lv004*A.lv006) thanhtien,sum(A.lv004*A.lv006*A.lv008/100) thue,sum(A.lv004*A.lv006*A.lv011/100) chietkhau,sum(A.lv012) diem,sum(A.lv004*A.lv006*B.lv022/100) CKTM,concat(C.lv004,' ',C.lv003,' ',C.lv002) CusName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 left join hr_lv0020 C on B.lv010=C.lv001 left join sl_lv0005 D on A.lv003=D.lv001 left join sl_lv0059 E on A.lv009=E.lv001 where 1=1 $vCondition group by lv003";	
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vsum07=0;
		$vsum08=0;
		$vsum09=0;
		$vsum10=0;
		$vsum11=0;
		$vsum12=0;
		$vsum13=0;
		$vsum14=0;
		$vsum17=0;
		$vincrease=0;
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
				$vincrease++;
					if($vtInventorylv001 != $arrS['lv003']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv003'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@902", $vOrder, $vLineRun);$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;
				$vLineRun = str_replace("@02", $vincrease, $vLineRun);
				$vLineRun = str_replace("@04", $this->FormatView($arrS['DateInvoice'],2), $vLineRun);
				$vLineRun = str_replace("@05", $arrS['lv003'], $vLineRun);				
				$vLineRun = str_replace("@06", $arrS['CusName'], $vLineRun);
				$vsum07=$vsum07+$arrS['sl'];
				$vLineRun = str_replace("@07", $this->FormatView($arrS['sl'],10), $vLineRun);
				$vLineRun = str_replace("@08", $this->FormatView($arrS['lv006'],10), $vLineRun);
				$vsum09=$vsum09+$arrS['thanhtien'];
				$vLineRun = str_replace("@09", $this->FormatView($arrS['thanhtien'],10), $vLineRun);
				$vsum10=$vsum10+$arrS['lv011'];
				$vLineRun = str_replace("@10", $this->FormatView($arrS['lv011'],10), $vLineRun);
				$vsum11=$vsum11+$arrS['chietkhau'];
				$lvCKTM=$arrS['CKTM'];
				$vsumCKTM=$vsumCKTM+$arrS['CKTM'];
				$vLineRun = str_replace("@11", $this->FormatView($arrS['chietkhau'],10), $vLineRun);
				$vLineRun = str_replace("@19", $this->FormatView($arrS['CKTM'],10), $vLineRun);
				$vLineRun = str_replace("@20", $this->FormatView(round($lvCKTM,0),10), $vLineRun);
				$vLineRun = str_replace("@12", $this->FormatView($arrS['lv008'],10), $vLineRun);
				$vsum13=$vsum13+$arrS['thue'];
				$vLineRun = str_replace("@13", $this->FormatView($arrS['thue'],10), $vLineRun);	
				$vsum14=$vsum14+$arrS['diem'];
				$vLineRun = str_replace("@14", $this->FormatView($arrS['diem'],10), $vLineRun);	
				$vLineRun = str_replace("@15", $arrS['ProgramName'], $vLineRun);		
				$vLineRun = str_replace("@16", $arrS['EmployeeID'], $vLineRun);
				$vLineRun = str_replace("@17", $arrS['CustomerID'], $vLineRun);
				$TT18=$arrS['thanhtien']+$arrS['thue']-$arrS['chietkhau']-$lvCKTM;
				$vsum18=$vsum18+$TT18;				
				$vLineRun = str_replace("@18", $this->FormatView($TT18,10), $vLineRun);	
				$vLineRun = str_replace("@21", $this->getvaluelink('lv016',$arrS['lv016']), $vLineRun);	
				if($arrS['ReOutlv004']+$arrS['InOutlv004']==0)
				$vPrice=0;
				else
				$vPrice=($arrS['PriceReOutlv004']+$arrS['PriceInOutlv004'])/($arrS['ReOutlv004']+$arrS['InOutlv004'])	;
				$sumquanlity=( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']);
				$vLineRun = str_replace("@09",LCurrency($sumquanlity ,$plang), $vLineRun);
				$sum=((float)$vPrice)*$sumquanlity;
				$vLineRun = str_replace("@17",Lcurrency($sum,$plang), $vLineRun);		
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@60", '', $vLineRun);	
						break;
					case 3:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					case 4:
						$vLineRun = str_replace("@60", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001), $vLineRun);	
						break;
					default:
						$strreturn=$this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001);
						if($strreturn=="")
							$strReplace="";
						else
						$strReplace="<tr>
							<td colspan=\"17\">".$strreturn."</td></tr>";
						$vLineRun = str_replace("@60",$strReplace, $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@07",$this->FormatView($vsum07,10),$vRowLast);
		$vRowLast=str_replace("@09",$this->FormatView($vsum09,10),$vRowLast);
		$vRowLast=str_replace("@11",$this->FormatView($vsum11,10),$vRowLast);
		$vRowLast=str_replace("@20",$this->FormatView($vsumCKTM,10),$vRowLast);
		$vRowLast=str_replace("@13",$this->FormatView($vsum13,10),$vRowLast);
		$vRowLast=str_replace("@14",$this->FormatView($vsum14,10),$vRowLast);
		$vRowLast=str_replace("@18",$this->FormatView($vsum18,10),$vRowLast);
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[23], $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", $vArrLang[24], $vHeader);
		//EmpID
		$vHeader = str_replace("@05",'Mã NV', $vHeader);
		//Name Emp
		$vHeader = str_replace("@06", $vArrLang[26], $vHeader);
		//Quantity
		$vHeader = str_replace("@07", $vArrLang[22], $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
		//Discount
		$vHeader = str_replace("@10",$vArrLang[50]."(%)", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11",$vArrLang[54]."(vnđ)", $vHeader);
		//Tax
		$vHeader = str_replace("@12",$vArrLang[49], $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13",$vArrLang[57]."(vnđ)", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",$vArrLang[53], $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",$vArrLang[27], $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[55]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@19",$vArrLang[58], $vHeader);	
		$vHeader = str_replace("@20",$vArrLang[59]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@21",$vArrLang[60], $vHeader);	
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001)
	{
		
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"5%\" >@02</td>
				<td class=\"htablerun\" width=\"10%\" >@03</td>
				<td class=\"htablerun\" width=\"8%\" >@04</td>
				<td class=\"htablerun\" width=\"15%\" >@05</td>
				<td class=\"htablerun\" width=\"8%\" >@12</td>
				<td class=\"htablerun\" width=\"8%\" >@13</td>
				<td class=\"htablerun\" width=\"8%\" >@14</td>
				<td class=\"htablerun\" width=\"8%\" >@15</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"5%\" >@09</td>												
				<td class=\"htablerun\" width=\"10%\" >@10</td>												
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@12</td>
				<td class=\"center_style\" >@13</td>
				<td class=\"center_style\" >@14</td>
				<td class=\"center_style\" >@15</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\"   >@09</td>											
				<td class=\"left_style\"   >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\"  >@05</td>
				<td class=\"center_style\" >@12</td>
				<td class=\"center_style\" >@13</td>
				<td class=\"center_style\" >@14</td>
				<td class=\"center_style\" >@15</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\"   >@09</td>											
				<td class=\"left_style\"   >@10</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddLot=$vAddLot." AND A.lv014 like '%$strlv014%'";		
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '%$strQuantiative%'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";				
		if($strNote!="") 	$vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";				
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }		
		 if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (B.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (B.lv005='$strSource')  ";					
		}	
		 if($vlv001!="")
		 {
			 $vAddContractR=$vAddContractR." AND B.lv002='$vlv001'";				
			$vAddContractO=$vAddContractO." AND B.lv002='$vlv001'";		
		 }
		else 
		{
			$strwh=$this->Get_WHControler();
			$vAddContractR=$vAddContractR." AND (B.lv002 in ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (B.lv002 in ($strwh))  ";	
		}
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
			if($vAddCond!="") $vCondition = $vCondition." left join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014=B1.lv002  $vAddCond";		
		  $sqlS = "select A.lv001, A.lv002 ,A.lv004,A.lv008,A.lv009,A.lv010,0 lv011,C.lv002 Unitlv002,B.lv005 Type,B.lv009 DateEnter,'N' CategoryPut,B.lv004 Title,A.lv007,A.lv014 Lot,A.lv015,B.lv006 Reference  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv003='$vlv003' $vAddLot
				UNION
				select A.lv001, A.lv002,A.lv004,A.lv008,A.lv009,A.lv010,A.lv011,C.lv002 Unitlv002,B.lv005 Type,B.lv009 DateEnter,'X' CategoryPut,B.lv004 Title,A.lv007,A.lv014 Lot,A.lv015,B.lv006 Reference from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv003='$vlv003' $vAddLot 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv002']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv002'];
						$vTitle = ($arrS['DateEnter']!="" || $arrS['DateEnter']!=NULL)?formatdate($arrS['DateEnter'],$plang):"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@02",$arrS['CategoryPut'],str_replace("@01",$vtInventorylv001,$Href)), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['lv004']!="" || $arrS['lv004']!=NULL)?Lcurrency($arrS['lv004'],$plang)."(".$arrS['Unitlv002'].")":"-", $vLineRun);
				$vLineRun = str_replace("@12", ($arrS['lv008']!="" || $arrS['lv008']!=NULL)?Lcurrency($arrS['lv008'],$plang)."":"-", $vLineRun);
				$vLineRun = str_replace("@13", ($arrS['lv010']!="" || $arrS['lv010']!=NULL)?Lcurrency($arrS['lv010'],$plang)."":"-", $vLineRun);
				$vLineRun = str_replace("@14", ($arrS['lv011']!="" || $arrS['lv011']!=NULL)?Lcurrency($arrS['lv011'],$plang)."":"-", $vLineRun);
				$vLineRun = str_replace("@15", ($arrS['lv008']!="" || $arrS['lv008']!=NULL)?Lcurrency($arrS['lv008']*$arrS['lv004']+$arrS['lv008']*$arrS['lv004']*$arrS['lv010']/100-$arrS['lv008']*$arrS['lv004']*$arrS['lv011']/100,$plang):"-", $vLineRun);//."(".$arrS['lv009'].")"
				$vLineRun = str_replace("@06", $arrS['CategoryPut'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['Title']."&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@08", $arrS['Type'], $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],$HrefLot))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['lv015']!="" || $arrS['lv015']!=NULL)?$arrS['lv015']:"&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@11",($arrS['Reference']!="" || $arrS['Reference']!=NULL)?$arrS['Reference']:"&nbsp;", $vLineRun);				
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[20], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[21], $vHeader);
		//Quanity
		$vHeader = str_replace("@05",$vArrLang[22], $vHeader);
		//Category N/X
		$vHeader = str_replace("@06", $vArrLang[23], $vHeader);
		//Title
		$vHeader = str_replace("@07", $vArrLang[25], $vHeader);
		//Source
		$vHeader = str_replace("@08", $vArrLang[26], $vHeader);
		//Reference
		$vHeader = str_replace("@11", $vArrLang[27], $vHeader);
		$vHeader = str_replace("@12", $vArrLang[48], $vHeader);
		$vHeader = str_replace("@13", $vArrLang[49], $vHeader);
		$vHeader = str_replace("@14", $vArrLang[50], $vHeader);
		$vHeader = str_replace("@15", $vArrLang[51], $vHeader);
		//Lot
		$vHeader = str_replace("@09", $vArrLang[24], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[28], $vHeader);		
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Purchase Order////////////////////////////
	function GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"3%\" >@02</td>
				<td class=\"htablerun\" width=\"8%\" >@03</td>
				<td class=\"htablerun\" width=\"7%\" >@04</td>
				<td class=\"htablerun\" width=\"9%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"6%\" >@09</td>												
				<td class=\"htablerun\" width=\"6%\" >@11</td>	
				<td class=\"htablerun\" width=\"7%\" >@12</td>
				<td class=\"htablerun\" width=\"7%\" >@13</td>				
				<td class=\"htablerun\" width=\"7%\" >@15</td>														
				<td class=\"htablerun\" width=\"6%\" >@14</td>						
				<td class=\"htablerun\" width=\"*%\" >@07</td>
				<td class=\"htablerun\" width=\"5%\" >@08</td>	
				<td class=\"htablerun\" width=\"8%\" >@10</td>																																													
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>				
				<td class=\"left_style\" >@11</td>				
				<td class=\"left_style\" >@12</td>				
				<td class=\"left_style\" >@13</td>		
				<td class=\"left_style\" >@15</td>						
				<td class=\"left_style\" >@14</td>																																		
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>	
				<td class=\"left_style\" >@11</td>				
				<td class=\"left_style\" >@12</td>				
				<td class=\"left_style\" >@13</td>				
				<td class=\"left_style\" >@15</td>																				
				<td class=\"left_style\" >@14</td>												
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@10</td>																											
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddCond=$vAddCond." AND B1.lv014 like '%$strlv014%'";		
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '$strQuantiative'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";	
		if($strNote!="") 	 $vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";		
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }			
		 if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (B.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (B.lv005='$strSource')  ";					
		}	
		 if($vlv001!="")
		 {
			 $vAddContractR=$vAddContractR." AND B.lv002='$vlv001'";				
			$vAddContractO=$vAddContractO." AND B.lv002='$vlv001'";		
		 }
		else 
		{
			$strwh=$this->Get_WHControler();
			$vAddContractR=$vAddContractR." AND (B.lv002 in ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (B.lv002 in ($strwh))  ";	
		}
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014=B1.lv014  $vAddCond";		
		 $sqlS = "select A.lv001,A.lv002 ,A.lv004,C.lv002 Unitlv002,B.lv005,B.lv009 DateEnter,'N' CategoryPut,B.lv004 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,B.lv005,B.lv009 DateEnter,'X' CategoryPut,B.lv004 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002 from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001  left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv002']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv002'];
						$vTitle = ($arrS['DateEnter']!="" || $arrS['DateEnter']!=NULL)?formatdate($arrS['DateEnter'],$plang):"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@02",$arrS['CategoryPut'],str_replace("@01",$vtInventorylv001,$Href)), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['lv004']!="" || $arrS['lv004']!=NULL)?Lcurrency($arrS['lv004'],$plang)."(".$arrS['Unitlv002'].")":"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['CategoryPut'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['Title']."&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@08", $arrS['lv005'], $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],$HrefLot))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['Note']!="" || $arrS['Note']!=NULL)?$arrS['Note']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@11",($arrS['Color']!="" || $arrS['Color']!=NULL)?$arrS['Color']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@12",($arrS['Colorlv002']!="" || $arrS['Colorlv002']!=NULL)?$arrS['Colorlv002']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@13",($arrS['Tyles']!="" || $arrS['Tyles']!=NULL)?$arrS['Tyles']:"&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@14",($arrS['NoteLot']!="" || $arrS['NoteLot']!=NULL)?$arrS['NoteLot']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@15",($arrS['Quantitative']!="" || $arrS['Quantitative']!=NULL)?$arrS['Quantitative']:"&nbsp;", $vLineRun);																					
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[39], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[44], $vHeader);
		//Quanity
		$vHeader = str_replace("@05",$vArrLang[41], $vHeader);
		//Category N/X
		$vHeader = str_replace("@06", $vArrLang[42], $vHeader);
		//Title
		$vHeader = str_replace("@07", $vArrLang[40], $vHeader);
		//lv005
		$vHeader = str_replace("@08", $vArrLang[43], $vHeader);
		//Lot
		$vHeader = str_replace("@09", $vArrLang[46], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[45], $vHeader);		
		//Colorlv001
		$vHeader = str_replace("@11", $vArrLang[47], $vHeader);				
		//Colorlv002
		$vHeader = str_replace("@12", $vArrLang[48], $vHeader);				
		//Tyles
		$vHeader = str_replace("@13", $vArrLang[50], $vHeader);				
		//Description
		$vHeader = str_replace("@14", $vArrLang[49], $vHeader);	
		//Quantitative
		$vHeader = str_replace("@15", $vArrLang[51], $vHeader);						
				
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Detail Sale Style////////////////////////////
	function GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$vlv001)

	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"3%\" >@02</td>
				<td class=\"htablerun\" width=\"8%\" >@03</td>
				<td class=\"htablerun\" width=\"7%\" >@04</td>
				<td class=\"htablerun\" width=\"9%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"9%\" >@07</td>
				<td class=\"htablerun\" width=\"9%\" >@08</td>
				<td class=\"htablerun\" width=\"6%\" >@09</td>												
				<td class=\"htablerun\" width=\"8%\" >@10</td>																																													
				<td class=\"htablerun\" width=\"6%\" >@11</td>					
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"center_style\" >@07</td>
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@09</td>				
				<td class=\"left_style\" >@10</td>					
				<td class=\"left_style\" >@11</td>	
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"center_style\" >@07</td>
				<td class=\"center_style\" >@08</td>				
				<td class=\"left_style\" >@09</td>
				<td class=\"left_style\" >@10</td>	
				<td class=\"left_style\" >@11</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddCond=$vAddCond." AND B1.lv014 like '%$strlv014%'";		
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '$strQuantiative'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";				
		if($strNote!="")  $vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";		
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }		
		 if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (B.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (B.lv005='$strSource')  ";					
		}		
		 if($vlv001!="")
		 {
			 $vAddContractR=$vAddContractR." AND B.lv002='$vlv001'";				
			$vAddContractO=$vAddContractO." AND B.lv002='$vlv001'";		
		 }
		else 
		{
			$strwh=$this->Get_WHControler();
			$vAddContractR=$vAddContractR." AND (B.lv002 in ($strwh)) ";
			$vAddContractO=$vAddContractO." AND (B.lv002 in ($strwh))  ";	
		}
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014 Lot=B1.lv014  $vAddCond";		
		 $sqlS = "select  VC.lv004,VC.lv006,VC.lv006lv002,sum(VC.lv004D) lv004D,sum(VC.lv004N) lv004N,sum(VC.lv004X) lv004X from (select A.lv001,A.lv002,0 lv004D,A.lv004 lv004N,0 lv004X,'N' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR left join sl_lv0005 C on A.lv005=C.lv001 left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,0 lv004D,0 lv004N,A.lv004 lv004X,'X' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002 from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001  left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003'
				UNION
select A.lv001,A.lv002,A.lv004 lv004D ,0 lv004N,0 lv004X,'N' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and B.lv009<'$vDateStart' $vAddContractR left join sl_lv0005 C on A.lv005=C.lv001 left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,-A.lv004 lv004D,0 lv004N,0 lv004X,'X' CategoryPut,D.lv006,D.lv004,E.lv002VN Colorlv002 from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009<'$vDateStart' $vAddContractO  left join sl_lv0005 C on A.lv005=C.lv001  left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003'		
				) VC		
				
				 Group by VC.lv004,VC.lv006 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtTyles='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtTyles != $arrS['Tyles']){
						$vOrder++;
						$vtTyles = $arrS['lv002'];
						$vTitle = ($arrS['Tyles']!="" || $arrS['Tyles']!=NULL)?$arrS['Tyles']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03","+ ".$vOrder, $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Color']!="" || $arrS['Color']!=NULL)?$arrS['Color']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@06",($arrS['Colorlv002']!="" || $arrS['Colorlv002']!=NULL)?$arrS['Colorlv002']:"&nbsp;" , $vLineRun);
				$vLineRun = str_replace("@07",($arrS['lv004D']!="" || $arrS['lv004D']!=NULL)?$arrS['lv004D']:"0", $vLineRun);				
				$vLineRun = str_replace("@08", ($arrS['lv004N']!="" || $arrS['lv004N']!=NULL)?$arrS['lv004N']:"0", $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['lv004X']!="" || $arrS['lv004X']!=NULL)?$arrS['lv004X']:"0", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['lv004D']+$arrS['lv004N']-$arrS['lv004X']), $vLineRun);
				$vLineRun = str_replace("@11","..........", $vLineRun);																				
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Order
		$vHeader = str_replace("@03", $vArrLang[19], $vHeader);
		//Tyles
		$vHeader = str_replace("@04", $vArrLang[50], $vHeader);
		//Colorlv001
		$vHeader = str_replace("@05",$vArrLang[47], $vHeader);
		//Colorlv002
		$vHeader = str_replace("@06", $vArrLang[48], $vHeader);
		//Tồn đầu kỳ
		$vHeader = str_replace("@07", $vArrLang[23], $vHeader);
		//Nhập trong kỳ
		$vHeader = str_replace("@08", $vArrLang[24], $vHeader);
		//Xuất trong kỳ
		$vHeader = str_replace("@09", $vArrLang[25], $vHeader);
		//Tồn cuối kỳ
		$vHeader = str_replace("@10", $vArrLang[26], $vHeader);		
		//Description
		$vHeader = str_replace("@11", $vArrLang[45], $vHeader);	
				
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////////////Purchase Order////////////////////////////////////////////////////////////////////
	function ReportPurchaseOrderAdv($plang, $vArrLang, $strPurchaseRequirelv001, $strTitle,$strDateCreateFrom, $strDateCreateTo, $strDateRequireFrom,$strDateRequireTo,$strDateDeliveryFrom,$strDateDeliveryTo,$strShippingMethodlv001,$strPaymentMethodlv001,$strApproval,$strlv005,$strSupplierlv001){
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"htable_hr\" width=\"3%\" >@02</td>
				<td class=\"htable_hr\" width=\"20%\" >@03</td>
				<td class=\"htable_hr\" width=\"*%\" >@04</td>
				<td class=\"htable_hr\" width=\"20%\" >@05</td>
				<td class=\"htable_hr\" width=\"10%\" >@06</td>
				<td class=\"htable_hr\" width=\"10%\" >@07</td>
				<td class=\"htable_hr\" width=\"10%\" >@08</td>				
				<td class=\"htable_hr\" width=\"10%\" >@09</td>								
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_hr\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_hr\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>
				<td class=\"left_hr\" >@09</td>				
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>				
				<td class=\"left_hr\" >@09</td>								
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01')\" >@01</a>";
		$vCondition = "";
		if($strPurchaseRequirelv001!="") $vCondition = " AND A.lv001 LIKE '%$strPurchaseRequirelv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strDateCreateFrom!="") $vCondition = $vCondition." AND A.DateCreate >= '$strDateCreateFrom'";
		if($strDateCreateTo!="") $vCondition = $vCondition." AND A.DateCreate <= '$strDateCreateTo'";
		if($strDateRequireFrom!="") $vCondition = $vCondition." AND A.DateRequire>= '$strDateRequireFrom'";
		if($strDateRequireTo!="") $vCondition = $vCondition." AND A.DateRequire<= '$strDateRequireTo'";
		if($strDateDeliveryFrom!="") $vCondition = $vCondition." AND A.DateDelivery>= '$strDateDeliveryFrom'";
		if($strDateDeliveryTo!="") $vCondition = $vCondition." AND A.DateDelivery<= '$strDateDeliveryTo'";
		if($strShippingMethodlv001!="") $vCondition = $vCondition." AND A.ShippingMethodlv001='$strShippingMethodlv001'";
		if($strPaymentMethodlv001!="") $vCondition = $vCondition." AND A.PaymentMethodlv001='$strPaymentMethodlv001'";		
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";
		if($strlv005!="") $vCondition = $vCondition." AND A.lv005='$strlv005'";			
		if($strSupplierlv001!="") $vCondition = $vCondition." AND A.Supplierlv001='$strSupplierlv001'";			
	
		$sqlS = "select A.*,B.Companylv002 Warehouselv002 from  wh_purchaserequire A left join  wh_supplier B on A.Supplierlv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.DateCreate Desc,A.lv001 DESC";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['Title']!="" || $arrS['Title']!=NULL)?$arrS['Title']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", str_replace("@01",$vtInventorylv001,$Href), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Warehouselv002']!="" || $arrS['Warehouselv002']!=NULL)?$arrS['Warehouselv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['Employeelv001'], $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['DateCreate']!="" || $arrS['DateCreate']!=NULL)?formatdate($arrS['DateCreate'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", $arrS['Approval'], $vLineRun);				
				$vLineRun = str_replace("@09", $arrS['lv005'], $vLineRun);								
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[6], $vHeader);
		//Inventorylv001
		$vHeader = str_replace("@03", $vArrLang[7], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[8], $vHeader);
		//Warehouse
		$vHeader = str_replace("@05",$vArrLang[9], $vHeader);
		//DateCal
		$vHeader = str_replace("@06", $vArrLang[12], $vHeader);
		//Employee
		$vHeader = str_replace("@07", $vArrLang[10], $vHeader);
		//Approval
		$vHeader = str_replace("@08",$vArrLang[11], $vHeader);
		//lv005
		$vHeader = str_replace("@09",$vArrLang[13], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	}	
	
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
			else $vValue=$vValue." ; ".Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
		}
		if($vValue!="") return  str_replace("@01",$vValue,$vtr);
		return "";
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
		</script>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  sl_lv0006";
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function GetBuilCheckListState($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				if(str=='') 
					str=div.value;
				else
					 str=str+','+div.value;
				}
			
			}
			return str;
		}
		</script>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  sl_lv0054";
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),2));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$strwh=$this->Get_WHControler();
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001 in ($strwh)";
				break;
			case 'lv003':
				$vsql="select lv001,concat(lv004,' ',lv003,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0006";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0059";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054";
				break;
			case 'lv016':
				$vcondition="";
				if($vSelectID[0]!="") $vcondition=$vcondition." and B.lv002='".$vSelectID[0]."'";
				if($vSelectID[1]!="") $vcondition=$vcondition." and B.lv003='".$vSelectID[1]."'";
				$vsql="select A.lv001,concat(B.lv003,'-',A.lv003,'->',A.lv005,'(',A.lv006,')',A.lv004) lv002,0 lv003 from  sl_lv0064 A inner join sl_lv0060 B on A.lv002=B.lv001 where 1=1 $vcondition";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001='$vSelectID'";
				break;
			case 'lv003':
				$vsql="select lv001,concat(lv004,' ',lv003,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0007 where lv001='$vSelectID'";
				break;
			
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0006 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0059 where lv001='$vSelectID'";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054 where lv001='$vSelectID'";
				break;
			case 'lv016':
				$vsql="select lv001,concat(lv003,'->',lv005,'(',lv006,')',lv004) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0064 where lv001='$vSelectID'";
				break;
			
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectID;
		}
		else
		$lvResult = db_query($vsql);
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
	?>