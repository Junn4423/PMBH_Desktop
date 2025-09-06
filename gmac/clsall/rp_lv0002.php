<?php
class rp_lv0002 extends lv_controler{
		public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv040,lv041,lv042,lv043";	
		var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"2","lv004"=>"2","lv005"=>"2","lv006"=>"10","lv007"=>"10","lv008"=>"10","lv009"=>"10","lv010"=>"10","lv011"=>"10","lv012"=>"10","lv013"=>"10","lv014"=>"10","lv015"=>"10","lv016"=>"10","lv017"=>"10","lv018"=>"10","lv019"=>"10","lv020"=>"0","lv021"=>"0","lv022"=>"10","lv023"=>"0","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10","lv028"=>"10","lv029"=>"10","lv030"=>"10","lv031"=>"0","lv040"=>"0","lv041"=>"0","lv042"=>"0","lv043"=>"0");	
	
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
		protected function GetCondition()
	{
		return "";
	}
	/////////////////////ListFieldSave//////////////////////////
	function ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrder,$lvSortNum)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvArrOrder=explode(",",$lvOrder);
		$lvSelect="<ul id=\"menu-nav\" onkeyup=\"return CheckKeyCheckTab(event,$lvFrom,".count($lstArr).")\">
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" class=\"lv_funcshowimg\"/><span class=\"lv_funcshowtext\">".$this->ArrFunc[11]."</span>
							<ul id=\"submenu-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function SelectChk(vFrom,len)
		{
			vFrom.txtFieldList.value=getChecked(len,'lvdisplaychk');
			vFrom.txtOrderList.value=getAlllen(len,'lvorder');
			vFrom.txtFlag.value=2;
			vFrom.submit();
		}
		function lv_on_open(opt)
		{
			div = document.getElementById('lvsllist');
			if(opt==0)
			{
				div.size=1;
			}
			else
				div.size=div.length;
			
		}
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{

				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;

				}
			}
			return str;
		}
		function getAlllen(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
				div = document.getElementById(nameobj+i);
				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;
			}
			return str;
		}
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvNumPage="".$this->ArrOther[2]."<input type=\"text\" class=\"lvmaxrow\" name=lvmaxrow id=lvmaxrow value=\"$maxRows\">";
		$lvSortPage="".GetLangSort(0,$this->lang)."<select class=\"lvsortrow\" name=lvsort id=lvsort >
				<option value=0 ".(($lvSortNum==0)?'selected':'').">".GetLangSort(1,$this->lang)."</option>
				<option value=1 ".(($lvSortNum==1)?'selected':'').">".GetLangSort(2,$this->lang)."</option>
				<option value=2 ".(($lvSortNum==2)?'selected':'').">".GetLangSort(3,$this->lang)."</option>
		</select>";
		$lvChk="<input type=\"checkbox\" id=\"lvdisplaychk@01\" name=\"lvdisplaychk@01\" value=\"@02\" @03><input id=\"lvorder@01\" name=\"lvorder@01\"  type=\"text\" value=\"@06\"\ style=\"width:20px\" >";
		$lvButton="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrOther[1]."\" onclick=\"SelectChk($lvFrom,".count($lstArr).")\">";
		$strGetList="";
		$strGetScript="";
		for ($i=0;$i<count($lstArr);$i++)
		{
			
			$strTempChk=str_replace("@01",$i,$lvChk.$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]]);
			$strTempChk=str_replace("@02",$lstArr[$i],$strTempChk);
			
			$strTempChk=str_replace("@07",100+$i,$strTempChk);
			if(strpos($lvList,",".$lstArr[$i].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
				
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			if($lvArrOrder[$i]==NULL || $lvArrOrder[$i]=="")
				{
				$strTempChk=str_replace("@06",$i,$strTempChk);
				}
			else
				$strTempChk=str_replace("@06",$lvArrOrder[$i],$strTempChk);
			
			
			$strTemp=str_replace("@01",$strTempChk,$lvScript);
			$strGetScript=$strGetScript.$strTemp;
		}
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	function ReportCusProducts($plang, $vArrLang, $pCheckedlv0011, $pCheckedlv0012){
		//$vReport = 0: Report only customer and fabricsample
		//$vReport = 1: Report all from customer to analysis
		$vRowFirst="
			<tr>
				<td class=\"tdprint\" width=\"25%\" height=\"20px\">@01</td>
				<td class=\"tdprint\" width=\"*\">@02</td>
			</tr>";
		$vRowGerneral="
			<tr>
				<td class=\"tdprint\" height=\"20px\">@01</td>
				<td class=\"tdprint\">@02</td>
			</tr>";
		$vRowColspan="
			<tr>
				<td class=\"tdprint\" colspan=\"2\">@01</td>
			</tr>";
		$vRowPartSplit="
			<tr>
				<td class=\"tdhprint\" colspan=\"2\">@01</td>
			</tr>";
		$vTableT1="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr>
					<td width=\"5%\">&nbsp;</td>
					<td width=\"*\">
						<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
							@01
						</table>
					</td>
				</tr>
			</table>";
		if($pCheckedlv0012=="" && $pCheckedlv0011!=""){
			$vSupplierlv001 = $pCheckedlv0011;
			$sqlS = "		SELECT A.*,C.lv002 Categorylv002,D.lv002 Currencylv002,E.lv002 Unitlv002
									FROM wh_supproducts A LEFT JOIN wh_supplier B  ON A.Supplierlv001=B.lv001 left join wh_category C on A.Categorylv001=C.lv001 left join  wh_currency D on D.lv001=A.UnitPricelv001 left join sl_lv0005 E on E.lv001=A.lv005
						WHERE A.Supplierlv001='$vSupplierlv001' ;";
		} else {
			$vSupplierlv001 = $pCheckedlv0011;
			$pLablv001 = $pCheckedlv0012;
			$pLablv001 = substr($pLablv001, 0, strlen($pLablv001)-1);
			$pLablv001 = str_replace("@", "', '", $pLablv001);
			$pLablv001 = "'".$pLablv001."'";
			$sqlS = "	SELECT A.*,C.lv002 Categorylv002,D.lv002 Currencylv002,E.lv002 Unitlv002
									FROM wh_supproducts A LEFT JOIN wh_supplier B  ON A.Supplierlv001=B.lv001 left join wh_category C on A.Categorylv001=C.lv001 left join  wh_currency D on D.lv001=A.UnitPricelv001 left join sl_lv0005 E on E.lv001=A.lv005
											WHERE A.lv001 IN ($pLablv001) and A.Supplierlv001='$vSupplierlv001';";
		}
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun="";
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
	//Row part split
				$vTempRow=$vRowPartSplit;
				$vTempRow=str_replace("@01", "<b>".$vArrLang[25]."</b>", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;
	//Lablv001
				$strlv003=($arrS['lv003']!="")?"->".$arrS['lv003']:"->None";
				$vTempRow=$vRowFirst;
				$vTempRow=str_replace("@01", $vArrLang[12], $vTempRow);
				$vTempRow=str_replace("@02", ($arrS['Lablv001']!="")?"<b>".$arrS['Lablv001'].$strlv003."</b>":"None".$strlv003, $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;

	//lv002
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[15], $vTempRow);
				$vTempRow=str_replace("@02", ($arrS['lv002']!="")?$arrS['lv002']:"&nbsp;", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;
	//Categorylv002
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[13], $vTempRow);
				$vTempRow=str_replace("@02", $arrS['Categorylv002'], $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;				
	//Price
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[15], $vTempRow);
				$vTempRow=str_replace("@02", ($arrS['Price']!="")?$arrS['Price']."(".$arrS['Currencylv002'].")/(".$arrS['Unitlv002'].")":"&nbsp;", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;
	//Tyles (Data)
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[19], $vTempRow);				
				$vTempRow=str_replace("@02", ($arrS['Tyles']!="")?$arrS['Tyles']:"-", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;
	//Quantitative (Data)
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[20], $vTempRow);				
				$vTempRow=str_replace("@02", ($arrS['Quantitative']!="")?$arrS['Quantitative']:"-", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;
	//Color (Data)
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[21], $vTempRow);				
				$vTempRow=str_replace("@02", ($arrS['Color']!="")?$arrS['Color']:"-", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;
	//Note (Data)
				$vTempRow=$vRowGerneral;
				$vTempRow=str_replace("@01", $vArrLang[22], $vTempRow);				
				$vTempRow=str_replace("@02", ($arrS['Note']!="")?$arrS['Note']:"-", $vTempRow);
				$vLineRun=$vLineRun.$vTempRow;				
				
/////Child Table/////////////////////////////////////////////////////////////////////////////////////////////
				if($pCheckedlv0012=="" && $pCheckedlv0011!=""){
					$vLineRun1="";
		//Row part split
					$vTempRow=$vRowPartSplit;
					$vTempRow=str_replace("@01", "<b>".$vArrLang[26]."</b>", $vTempRow);
					$vLineRun1=$vLineRun1.$vTempRow;


				}
			}
			return $vLineRun;
		} else {
			$vTempRow=$vRowColspan;
			$vTempRow=str_replace("@01", $vArrLang[27], $vTempRow);
			$vLineRun=$vLineRun.$vTempRow;
			return $vLineRun;
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportInventoryAdv($plang, $vArrLang, $strInventorylv001, $strTitle, $strWarehouselv001, $strDateCalFrom, $strDateCalTo, $strApproval){
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
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_hr\" >@04</td>
				<td class=\"left_hr\" >@05</td>
				<td class=\"left_hr\" >@06</td>
				<td class=\"left_hr\" >@07</td>
				<td class=\"left_hr\" >@08</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01')\" >@01</a>";
		$vCondition = "";
		if($strInventorylv001!="") $vCondition = " AND A.lv001 LIKE '%$strInventorylv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strWarehouselv001!="") $vCondition = $vCondition." AND A.Warehouselv001='$strWarehouselv001'";	
		if($strDateCalFrom!="") $vCondition = $vCondition." AND A.DateCal >= '$strDateCalFrom'";
		if($strDateCalTo!="") $vCondition = $vCondition." AND A.DateCal <= '$strDateCalTo'";
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";	
	
		$sqlS = "select A.*,B.lv002 Warehouselv002 from wh_inventory A left join  wh_warehouse B on A.Warehouselv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.DateCal Desc,A.lv001 DESC";
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
						$vLineRun = str_replace("@03",str_replace("@01",$vtInventorylv001,$Href), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Warehouselv002']!="" || $arrS['Warehouselv002']!=NULL)?$arrS['Warehouselv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['Employeelv001'], $vLineRun);
				$vLineRun = str_replace("@07", ($arrS['DateCal']!="" || $arrS['DateCal']!=NULL)?formatdate($arrS['DateCal'],$plang):"-", $vLineRun);
				$vLineRun = str_replace("@08", $arrS['Approval'], $vLineRun);				
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

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);
	}	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportReceiptionAdv($plang, $vArrLang, $strReceiptionlv001, $strTitle, $strWarehouselv001, $strlv009From, $strlv009To, $strApproval,$strlv005,$strlv006){
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
		if($strReceiptionlv001!="") $vCondition = " AND A.lv001 LIKE '%$strReceiptionlv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 >= '$strlv009From'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 <= '$strlv009To'";
		if($strWarehouselv001!="") $vCondition = $vCondition." AND A.Warehouselv001='$strWarehouselv001'";
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";
		if($strlv005!="") $vCondition = $vCondition." AND A.lv005='$strlv005'";	
		if($strlv006!="") $vCondition = $vCondition." AND A.lv006='$strlv006'";			
		
	
		$sqlS = "select A.*,B.lv002 Warehouselv002 from  wh_lv0008 A left join  wh_warehouse B on A.Warehouselv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.lv009 Desc,A.lv001 DESC";
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
				$vLineRun = str_replace("@07", ($arrS['lv009']!="" || $arrS['lv009']!=NULL)?formatdate($arrS['lv009'],$plang):"-", $vLineRun);
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportOutStockAdv($plang, $vArrLang, $strReceiptionlv001, $strTitle, $strWarehouselv001, $strlv009From, $strlv009To, $strApproval,$strlv005,$strlv006){
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
		if($strReceiptionlv001!="") $vCondition = " AND A.lv001 LIKE '%$strReceiptionlv001%'";
		if($strTitle!="") $vCondition = $vCondition." AND A.Title LIKE '%$strTitle%'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 >= '$strlv009From'";
		if($strlv009!="") $vCondition = $vCondition." AND A.lv009 <= '$strlv009To'";
		if($strWarehouselv001!="") $vCondition = $vCondition." AND A.Warehouselv001='$strWarehouselv001'";
		if($strApproval!="") $vCondition = $vCondition." AND A.Approval='$strApproval'";
		if($strlv005!="") $vCondition = $vCondition." AND A.lv005='$strlv005'";	
		if($strlv006!="") $vCondition = $vCondition." AND A.lv006='$strlv006'";	
	
		$sqlS = "select A.*,B.lv002 Warehouselv002 from  wh_lv0010 A left join  wh_warehouse B on A.Warehouselv001=B.lv001 where 1=1 ".$vCondition." ORDER BY A.lv009 Desc,A.lv001 DESC";
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
				$vLineRun = str_replace("@07", ($arrS['lv009']!="" || $arrS['lv009']!=NULL)?formatdate($arrS['lv009'],$plang):"-", $vLineRun);
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
	function PrintInOutPutInStock($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" >@03</td>
				<td class=\"htable\" width=\"*%\" >@04</td>
				<td class=\"htable\" width=\"5%\" >@05</td>
				<td class=\"htable\" width=\"10%\" >@06</td>
				<td class=\"htable\" width=\"10%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>				
				<td class=\"htable\" width=\"10%\" >@09</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>				
			</tr>";

		$vRowLightText="
			<tr>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>				
				<td class=\"right_style\" >@09</td>								
			</tr>";
	
		$sqlS = "select A.*,B.lv002 Unitlv002,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009<'$vDateStart' and A11.lv002='$vlv001')) ReReceiptQty,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' and A11.lv002='$vlv001')) InReceiptQty,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009<'$vDateStart' and A21.lv002='$vlv001')) ReOutlv004 ,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' and A21.lv002='$vlv001')) InOutlv004  from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1 and A.lv015>=0";
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
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Unitlv002']!="" || $arrS['Unitlv002']!=NULL)?$arrS['Unitlv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", Lcurrency($arrS['ReReceiptQty']-$arrS['ReOutlv004'],$plang), $vLineRun);
				$vLineRun = str_replace("@07", LCurrency($arrS['InReceiptQty'],$plang), $vLineRun);
				$vLineRun = str_replace("@08", LCurrency($arrS['InOutlv004'],$plang), $vLineRun);				
				$vLineRun = str_replace("@09", LCurrency( ( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']),$plang), $vLineRun);								
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
		$sqlS = "select MP.lv004,MP.Unitlv002,sum(IF(ISNULL(MP.ReReceiptQty),0,MP.ReReceiptQty)+IF(ISNULL(MP.InReceiptQty),0,MP.InReceiptQty)-IF(ISNULL(MP.ReOutlv004),0,MP.ReOutlv004)-IF(ISNULL(MP.InOutlv004),0,MP.InOutlv004) ) SumQty from (select A.lv004,B.lv002 Unitlv002,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009<'$vDateStart' and A11.lv002='$vlv001')) ReReceiptQty,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=A.lv001 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' and A11.lv002='$vlv001')) InReceiptQty,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009<'$vDateStart' and A21.lv002='$vlv001')) ReOutlv004 ,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=A.lv001 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' and A21.lv002='$vlv001')) InOutlv004   from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1 and A.lv015>=0) MP group by MP.lv004,MP.Unitlv002 ";		
		$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//lv003
		$vHeader = str_replace("@03", $vArrLang[5], $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", $vArrLang[6], $vHeader);
		//Unit
		$vHeader = str_replace("@05",$vArrLang[7], $vHeader);
		//Fist
		$vHeader = str_replace("@06", $vArrLang[8], $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", $vArrLang[9], $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08",$vArrLang[10], $vHeader);
		//Last
		$vHeader = str_replace("@09",$vArrLang[11], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
function PrintInOutPutInStockDetail($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource,$strCategory)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"8%\" >@03</td>
				<td class=\"htable\" width=\"*%\" >@04</td>
				<td class=\"htable\" width=\"5%\" >@05</td>
				<td class=\"htable\" width=\"10%\" >@06</td>
				<td class=\"htable\" width=\"10%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>				
				<td class=\"htable\" width=\"10%\" >@09</td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
					<td class=\"center_style\" rowspan=\"@01\" valign=\"top\" >@02</td>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>				
			</tr>
			<tr>
				<td colspan=\"8\">@20<td>
			</tr>
			";

		$vRowLightText="
			<tr>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>				
				<td class=\"right_style\" >@09</td>								
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		if($strSupplierlv001!="")
		{
			
		}
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '%$strQuantiative%'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";	
		if($strNote!="")  	$vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";
		if($strlv014!="") {
		 	$vAddLot=$vAddLot." AND A1.lv014 like '%$strlv014%'";	
			}
		if($strlv003!="") {
		 	$vAddLot=$vAddLot." AND A1.lv003 like '%$strlv003%'";	
			}
		
		if($strContractlv001!="") {$vAddContractR=$vAddContractR." AND A11.lv006='".$strContractlv001."'";
		$vAddContractO=$vAddContractO." AND A21.lv006='".$strContractlv001."'";
		}
		if($strSource!=""){ 
			$vAddContractR=$vAddContractR." AND (A11.lv005='$strSource') ";
			$vAddContractO=$vAddContractO." AND  (A21.lv005='$strSource')  ";					
		}						 
		
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." left join wh_lv0020 B1 on A1.lv003=B1.lv003 AND A1.lv014=B1.lv002  $vAddCond";
		$vConditionStock="";
		if($strlv003!="") $vConditionStock = " AND A.lv001 LIKE '%$strlv003%'";		
		if($strCategory!="")  	 $vConditionStock=$vConditionStock." AND A.lv003 in ('".str_replace(",","','",$strCategory)."')";		
		$sqlS = "select A.*,B.lv002 Unitlv002,(select sum(A1.lv004) from wh_lv0009 A1  $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009<'$vDateStart' $vAddContractR) ) ReReceiptQty,(select sum(A1.lv004) from wh_lv0009 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11  Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' $vAddContractR) ) InReceiptQty,(select sum(A1.lv004) from wh_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009<'$vDateStart' $vAddContractO) ) ReOutlv004 ,(select sum(A1.lv004) from wh_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' $vAddContractO) ) InOutlv004  from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1  and A.lv015>=0 $vConditionStock";	
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
						$vLineRun = str_replace("@02", $vOrder, $vLineRun);
						$vLineRun = str_replace("@03", $vtInventorylv001, $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['Unitlv002']!="" || $arrS['Unitlv002']!=NULL)?$arrS['Unitlv002']:"-", $vLineRun);
				$vLineRun = str_replace("@06", LCurrency($arrS['ReReceiptQty']-$arrS['ReOutlv004'],$plang), $vLineRun);
				$vLineRun = str_replace("@07", LCurrency($arrS['InReceiptQty'],$plang), $vLineRun);
				$vLineRun = str_replace("@08", LCurrency($arrS['InOutlv004'],$plang), $vLineRun);				
				$vLineRun = str_replace("@09",LCurrency( ( $arrS['ReReceiptQty']-$arrS['ReOutlv004'])+( $arrS['InReceiptQty']-$arrS['InOutlv004']),$plang), $vLineRun);	
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@20", '', $vLineRun);	
						break;
					case 3:
						$vLineRun = str_replace("@20", $this->GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource), $vLineRun);	
						break;
					case 4:
						$vLineRun = str_replace("@20", $this->GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource), $vLineRun);	
						break;
					default:
						$vLineRun = str_replace("@20", $this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource), $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return $vArrLang[5];
		}
	  $sqlS = "select MP.lv004,MP.Unitlv002,sum(IF(ISNULL(MP.ReReceiptQty),0,MP.ReReceiptQty)+IF(ISNULL(MP.InReceiptQty),0,MP.InReceiptQty)-IF(ISNULL(MP.ReOutlv004),0,MP.ReOutlv004)-IF(ISNULL(MP.InOutlv004),0,MP.InOutlv004) ) SumQty from (select A.lv004,B.lv002 Unitlv002,(select sum(A1.lv004) from wh_lv0009 A1  $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009<'$vDateStart' $vAddContractR) ) ReReceiptQty,(select sum(A1.lv004) from wh_lv0009 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11  Where A11.lv009>='$vDateStart' and A11.lv009<='$vDateEnd' $vAddContractR) ) InReceiptQty,(select sum(A1.lv004) from wh_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009<'$vDateStart' $vAddContractO) ) ReOutlv004 ,(select sum(A1.lv004) from wh_lv0011 A1 $vCondition where A1.lv003=A.lv001 $vAddLot and A1.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009>='$vDateStart' and A21.lv009<='$vDateEnd' $vAddContractO) ) InOutlv004  from sl_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001  where 1=1 and A.lv015>=0 $vConditionStock) MP group by MP.lv004,MP.Unitlv002 ";		
		$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//lv003
		$vHeader = str_replace("@03", $vArrLang[5], $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", $vArrLang[6], $vHeader);
		//Unit
		$vHeader = str_replace("@05",$vArrLang[7], $vHeader);
		//Fist
		$vHeader = str_replace("@06", $vArrLang[8], $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", $vArrLang[9], $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08",$vArrLang[10], $vHeader);
		//Last
		$vHeader = str_replace("@09",$vArrLang[11], $vHeader);		

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource)
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
				<td class=\"htablerun\" width=\"5%\" >@08</td>	
				<td class=\"htablerun\" width=\"5%\" >@11</td>	
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
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@11</td>	
				<td class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>								
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@11</td>
				<td class=\"left_style\" >@10</td>				
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
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
			if($vAddCond!="") $vCondition = $vCondition." left join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014=B1.lv002  $vAddCond";		
		  $sqlS = "select A.lv001, A.lv002 ,A.lv004,C.lv002 Unitlv002,B.lv005 Type,B.lv009 DateEnter,'N' CategoryPut,B.lv002 Title,A.lv007,A.lv014 Lot,A.lv015,B.lv006 Reference  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv003='$vlv003' $vAddLot
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,B.lv005 Type,B.lv009 DateEnter,'X' CategoryPut,B.lv002 Title,A.lv007,A.lv014 Lot,A.lv015,B.lv006 Reference from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv003='$vlv003' $vAddLot 
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
		//Lot
		$vHeader = str_replace("@09", $vArrLang[24], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[28], $vHeader);		
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Purchase Order////////////////////////////
	function GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource)
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
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014=B1.lv014  $vAddCond";		
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
	function GetBuildTableInputOutputDetailStyle($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv014,$strTyles,$strQuantiative,$strColor,$strNote,$strContractlv001,$strSource)

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
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  ".$vTbl;
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
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
	private function sqlcondition($vFile,$vSelectlv001)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv001':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  tc_lv0013";
				break;
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  hr_lv0002";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectlv001)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  tc_lv0013 where lv001='$vSelectlv001'";
				break;
			case 'lv002':
				$vsql="select lv001,lv002 lv002,IF(lv001='$vSelectlv001',1,0) lv003 from  hr_lv0002 where lv001='$vSelectlv001'";
				break;
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectlv001;
		}
		else
		$lvResult = db_query($vsql);
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
	?>