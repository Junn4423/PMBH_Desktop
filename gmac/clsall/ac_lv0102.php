<?php
class ac_lv0102 extends lv_controler{
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
	function LV_Get_No_CoDauKy($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,$opt='',$vlv022)
	{
		$vCondition="";
		$vCondition2="";
		$vAddCond=""; 
		$vAddCond2="";
		if($vDateStart!="") 	
		{
			$vAddCond1=$vAddCond1." AND B.lv009< '$vDateStart'";		
			$vAddCond2=$vAddCond2." AND B.lv009< '$vDateEnd'";				
			
		}		
		if($strlv005!="") 	$vAddCond=$vAddCond." AND A.lv005 = '$strlv005'";			
		if($strlv006!="") 	$vAddCond=$vAddCond." AND A.lv006 = '$strlv006'";	
		if($opt!="") $vAddCond=$vAddCond." AND B.lv002=$opt ";	
		if($vAddCond!="") 
		{
			$vCondition = $vAddCond1.$vCondition.$vAddCond;
			$vCondition2 = $vAddCond2.$vAddCond;
		}
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($opt=='0')
		{
			if($strlv005=="")
			{
				$sqldauky="select sum(lv003) from ac_lv0148 where lv001 in (select A.lv005  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where  (B.lv017=0 or B.lv017=12) $vCondition2)";
			}
			else
			{
				$sqldauky="select sum(lv003) from ac_lv0148 where lv001='$strlv005'";
			}
		}
		else
		{
			if($strlv006=="")
			{
				$sqldauky="select sum(lv005) from ac_lv0148 where lv001 in (select A.lv006  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where  (B.lv017=0 or B.lv017=12) $vCondition2)";
			}
			else
			{
				$sqldauky="select sum(lv005) from ac_lv0148 where lv001='$strlv006'";
			}
		}
		
		$sqlS = "select (select sum(A.lv004)  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where  (B.lv017=0 or B.lv017=12) $vCondition order by B.lv002,B.lv009,A.lv001) sumall, ($sqldauky) sumdauky  ";
		$bResultS = db_query($sqlS);
		$row=db_fetch_array($bResultS);
		return $row['sumall']+$row['sumdauky'];
	}
	function LV_Get_No_CoPhatSinh($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,$opt='',$vlv022='')
	{
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="") 	$vAddCond=$vAddCond." AND B.lv009>= '$vDateStart'";		
		if($vDateEnd!="") 	$vAddCond=$vAddCond." AND B.lv009<= '$vDateEnd'";	
		if($strlv005!="") 	$vAddCond=$vAddCond." AND A.lv005 = '$strlv005'";			
		if($strlv006!="") 	$vAddCond=$vAddCond." AND A.lv006 = '$strlv006'";	
		if($opt!="") $vAddCond=$vAddCond." AND B.lv002=$opt ";	
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";

		if($vAddCond!="") $vCondition = $vCondition.$vAddCond;
		$sqlS = "select sum(A.lv004) sumall from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where  (B.lv017=0 or B.lv017=12) $vCondition order by B.lv002,B.lv009,A.lv001";
		$bResultS = db_query($sqlS);
		$row=db_fetch_array($bResultS);
		return $row['sumall'];
	}
	
function PrintInOutPutInStockDetail($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,$vlv022)
	{
		$CoDK=$this->LV_Get_No_CoDauKy($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"1",$vlv022);
		$NoDK=$this->LV_Get_No_CoDauKy($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"0",$vlv022);
		$CoPS=$this->LV_Get_No_CoPhatSinh($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"1",$vlv022);
		$NoPS=$this->LV_Get_No_CoPhatSinh($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"0",$vlv022);
		if($CoPS==NULL) $CoPS=0;
		if($NoDK==NULL) $NoDK=0;
		if($CoDK==NULL) $CoDK=0;
		if($NoPS==NULL) $NoPS=0;		
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"4%\" >@03</td>
				<td class=\"htable\" width=\"2%\" >@04</td>
				<td class=\"htable\" width=\"2%\" >@05</td>
				<td class=\"htable\" width=\"*%\" >@06</td>
				<td class=\"htable\" width=\"5%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>				
				<td class=\"htable\" width=\"*%\" >@09</td>
				<td class=\"htable\" width=\"4%\" >@10</td>
				<td class=\"htable\" width=\"12%\" >@11</td>
				<td class=\"htable\" width=\"6%\" >@12</td>
				<td class=\"htable\" width=\"6%\" >@13</td>
				<!--<td class=\"htable\" width=\"10%\" >@14</td>-->
				<td class=\"htable\" width=\"6%\" >@15</td>
			</tr>";

	$vHeaderReportInventory=$vHeaderReportInventory."			
			<tr>
				<td class=\"center_style\" colspan=7>&nbsp;</td>
				<td class=\"right_style\" >Số dư nợ đầu kỳ:</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >".$this->FormatView($NoDK-$CoDK,1)."</td>	
				<td class=\"right_style\" >".$this->FormatView(0,1)."</td>	
				<td class=\"right_style\" >&nbsp;</td>	
			</tr>
";		
$vHeaderReportInventory=$vHeaderReportInventory."<tr>
				<td class=\"center_style\" colspan=7>&nbsp;</td>
				<td class=\"right_style\" >Tổng phát sinh trong kỳ:</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >".$this->FormatView($NoPS,1)."</td>	
				<td class=\"right_style\" >".$this->FormatView($CoPS,1)."</td>	
				<td class=\"right_style\" >&nbsp;</td>	
			</tr>
";
$vHeaderReportInventory=$vHeaderReportInventory."<tr>
				<td class=\"center_style\" colspan=7>&nbsp;</td>
				<td class=\"right_style\" >Số dư nợ cuối kỳ:</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >".$this->FormatView($NoDK-$CoDK+$NoPS-$CoPS,1)."</td>	
				<td class=\"right_style\" >".$this->FormatView(0,1)."</td>	
				<td class=\"right_style\" >&nbsp;</td>	
			</tr>
";

$vHeaderReportInventory=$vHeaderReportInventory."
			@01
		</table>";		
		
		$vRowFirst="
			<tr>
				<td class=\"center_style\" >@02</td>
				<td class=\"left_style\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"left_style\" >@06</td>
				<td class=\"left_style\" >@07</td>
				<td class=\"left_style\" >@08</td>
				<td class=\"left_style\" >@09</td>	
				<td class=\"left_style\" >@10</td>	
				<td class=\"left_style\" >@11</td>	
				<td class=\"right_style\" >@12</td>	
				<td class=\"right_style\" >@13</td>	
				<!--<td class=\"right_style\" >@14</td>	-->
				<td class=\"left_style\" >@15</td>	
			</tr><!--
			<tr>
				<td colspan=\"13\">@20<td>
			</tr>-->
			";

		$vRowLightText="
			<tr>
				td class=\"center_style\" >@02</td>
				<td class=\"left_style\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>	
				<td class=\"right_style\" >@10</td>	
				<td class=\"right_style\" >@11</td>	
				<td class=\"right_style\" >@12</td>	
				<td class=\"right_style\" >@13</td>	
				<!--<td class=\"right_style\" >@14</td>	-->
				<td class=\"right_style\" >@15</td>								
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="") 	$vAddCond=$vAddCond." AND B.lv009>= '$vDateStart'";		
		if($vDateEnd!="") 	$vAddCond=$vAddCond." AND B.lv009<= '$vDateEnd'";	
		if($strlv005!="") 	$vAddCond=$vAddCond." AND A.lv005 = '$strlv005'";			
		if($strlv006!="") 	$vAddCond=$vAddCond." AND A.lv006 = '$strlv006'";			
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";

		if($vAddCond!="") $vCondition = $vCondition.$vAddCond;
		$vConditionStock="";
		if($strlv003!="") $vConditionStock = "";	
		$sqlS = "select A.*,EE.lv002 NameDebitAccount,FF.lv002 NameCreditAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,B.lv002 TypeView,B.lv007 description  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001 left join sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv005=EE.lv001 left join ac_lv0002 FF on A.lv006=FF.lv001  where (B.lv017=0 or B.lv017=12) $vCondition order by B.lv002,B.lv009,B.lv001";
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
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $this->FormatView($arrS['VoiceDate'],2), $vLineRun);
						$vLineRun = str_replace("@03", ($arrS['InvoiceSoureID']!="" || $arrS['InvoiceSoureID']!=NULL)?$arrS['InvoiceSoureID']:"&nbsp;", $vLineRun);
						$ArrInvoiceID=split("-",$arrS['InvoiceID']);
						$vLineRun = str_replace("@04", $ArrInvoiceID[2], $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", "-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['NameObj'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['CustomerID'], $vLineRun);
				if($arrS['TypeView']=="0")
				{
					$vLineRun = str_replace("@08", $arrS['CustomerName']."&nbsp;", $vLineRun);	
					$vLineRun = str_replace("@10", $arrS['lv006'], $vLineRun);
					$vLineRun = str_replace("@11", $arrS['NameCreditAccount'], $vLineRun);
					$vLineRun = str_replace("@12", $this->FormatView($arrS['lv004'],1), $vLineRun);
					$vLineRun = str_replace("@13", "&nbsp;", $vLineRun);
				}
				else
				{
					$vLineRun = str_replace("@08", $arrS['SupplierName']."&nbsp;", $vLineRun);	
					$vLineRun = str_replace("@10", $arrS["lv005"], $vLineRun);
					$vLineRun = str_replace("@11", $arrS["NameDebitAccount"], $vLineRun);
					$vLineRun = str_replace("@12", "&nbsp;", $vLineRun);
					$vLineRun = str_replace("@13", $this->FormatView($arrS['lv004'],1), $vLineRun);					
				}
				
				$vLineRun = str_replace("@09", $arrS['description']."&nbsp;", $vLineRun);
				
				
				$vLineRun = str_replace("@14","&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@15",$arrS['InvoiceID'], $vLineRun);	
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@20", '', $vLineRun);	
						break;
					default:
						$vLineRun = str_replace("@20", $this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv006,$strlv007,$strlv008), $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} 
	//$sqlS = "select MP.lv005,MP.Unitlv002,ReReceiptQty,InReceiptQty,ReOutlv004 ,InOutlv004  from ac_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1 and A.lv015=0 $vConditionStock) MP group by MP.lv005,MP.Unitlv002 ";		
	//	$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[21], $vHeader);
		//lv003
		$vHeader = str_replace("@03", $vArrLang[22], $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", $vArrLang[23], $vHeader);
		//Unit
		$vHeader = str_replace("@05",$vArrLang[24], $vHeader);
		//Fist
		$vHeader = str_replace("@06", $vArrLang[25], $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", $vArrLang[26], $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08",$vArrLang[27], $vHeader);
		//Last
		$vHeader = str_replace("@09",$vArrLang[28], $vHeader);		
		$vHeader = str_replace("@10",$vArrLang[29], $vHeader);	
		$vHeader = str_replace("@11",$vArrLang[30], $vHeader);	
		$vHeader = str_replace("@12",$vArrLang[31], $vHeader);	
		$vHeader = str_replace("@13",$vArrLang[32], $vHeader);	
		$vHeader = str_replace("@14",$vArrLang[33], $vHeader);	
		$vHeader = str_replace("@15",$vArrLang[34], $vHeader);	

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv006,$strlv007,$strlv008)
	{
		
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"5%\" >@02</td>
				<td class=\"htablerun\" width=\"10%\" >@03</td>
				<td class=\"htablerun\" width=\"8%\" >@04</td>
				<td class=\"htablerun\" width=\"15%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"5%\" >@09</td>												
				<td class=\"htablerun\" width=\"*%\" >@07</td>
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
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>								
				<td class=\"left_style\" >@07</td>				
				<td class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>								
				<td class=\"left_style\" >@07</td>				
				<td class=\"left_style\" >@10</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 					
		//if($strNote!="") 	$vAddCond=$vAddCond." AND A.lv007 like '%$strNote%'";				
		//if($strContractlv001!="")
		//{
			//$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			//$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		// }		
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		//if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014 Lot=B1.lv014  $vAddCond";		
		 $sqlS = "select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,A.lv014 DateEnter,'N' CategoryPut,'' Title,A.lv007,A.lv012 Lot,A.lv013 Note from ac_lv0007 A   left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv014>='$vDateStart' and A.lv014<='$vDateEnd' and A.lv010='$strlv008'  
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,A.lv014 DateEnter,'X' CategoryPut,'' Title,A.lv007,A.lv012 Lot,A.lv013 Note from ac_lv0007 A   left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv014>='$vDateStart' and A.lv014<='$vDateEnd' and A.lv011='$strlv008'
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
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],$HrefLot))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['Note']!="" || $arrS['Note']!=NULL)?$arrS['Note']:"&nbsp;", $vLineRun);					
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
		//Lot
		$vHeader = str_replace("@09", $vArrLang[24], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[28], $vHeader);		
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Purchase Order////////////////////////////
	function GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv006,$strlv007,$strlv008)
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
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014 Lot=B1.lv014  $vAddCond";		
		 $sqlS = "select A.lv001,A.lv002 ,A.lv004,C.lv002 Unitlv002,B.lv005,B.lv009 DateEnter,'N' CategoryPut,B.lv002 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,B.lv005,B.lv009 DateEnter,'X' CategoryPut,B.lv002 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002 from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001  left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
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
	function GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001)

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
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			
			case 'lv005':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv006':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002 where lv001='$vSelectID'";
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