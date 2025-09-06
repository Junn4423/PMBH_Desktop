<?php
class mk_reportcontract{
	var $vTableGeneral="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
			<tr>
				<td>
					@02
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					@03
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					@04
				</td>
			</tr>
		</table>";
		//Ghi chu phan nay:
		//@01: de chen bang con thu nhat ($vHContract)
		//@02: de chen bang con thu hai ($vHContractDetail)
		//@02: de chen bang con thu hai ($vTableProcessing)

	function mk_reportcontract(){
		//
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportContractPrint($plang, $vLangArr, $pCustomerID, $pContractID,$vArrMonth){
		$mouser=new user();///New user object for get Employee Name

		$vHContract="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\" height=\"20px\">@02</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"13%\" align=\"center\">@03</td>
					<!--<td class=\"htable_crm\" width=\"*\" align=\"center\">@04</td>-->
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"8%\" align=\"center\">@05</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"8%\" align=\"center\">@11</td>
					<!--<td class=\"htable_crm\" width=\"8%\" align=\"center\">@06</td>-->
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\">@07</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"8%\" align=\"center\">@08</td>
<!--					<td class=\"htable_crm\" width=\"8%\" align=\"center\">@09</td>-->
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\">@10</td>	
				</tr>
				@01
			</table>";
		$vHComp="<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"*%\" align=\"center\">@13</td>";
		$vHPONo="<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"*%\" align=\"center\">@14</td>";
		$vHContractDetail="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"7%\" align=\"center\" height=\"20px\">@02</td>
					<td onClick=\"this.innerHTML='PO No'\" style=\"cursor:move\" class=\"htable_crm\" width=\"*\" align=\"center\">@03</td>
					@13		
					@14																																
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"6%\" align=\"center\">@04</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\">@12</td>											
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"7%\" align=\"center\">@08</td>			
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"7%\" align=\"center\">@07</td>
					<!--<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"7%\" align=\"center\">@10</td>-->					
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\">@05</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\">@06@80</td>
					@11
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable_crm\" width=\"10%\" align=\"center\">@09@81</td>					
				</tr>
				@01
			</table>";

		$vRContract="
			<tr>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"center_style_crm\" height=\"20px\">@02 &nbsp;</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"center_style_crm\">@03</td>
				<!--<td align=\"left\">@04</td>-->
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"center_style_crm\">@05</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\">@11</td>
			<!--	<td class=\"center_style_crm\">@06</td>-->
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\">@07</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"center_style_crm\">@08</td>
			<!--	<td align=\"right\">@09</td>-->
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\">@10</td>
			</tr>";
		$vRComp="<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" rowspan=\"@01\"  align=\"left\">@13</td>";
		$vRPONo="<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\">@14</td>";
		$vRContractDetail="
			<tr>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" rowspan=\"@01\" class=\"center_style_crm\" align=\"center\" height=\"20px\">@02</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" rowspan=\"@01\" align=\"left\" align=\"left\">@03</td>
				@13		
				@14														
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@04</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\">@12</td>								
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@08</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@07</td>
				<!--<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@10</td>	-->			
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@05</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@06</td>
				@11
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\" align=\"left\">@09</td>				
			</tr>";
		$vRContractDetailChild="
			<tr>	
				@14
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@04</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\">@12</td>				
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@08</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@07</td>
				<!--<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@10</td>				-->
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@05</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\">@06</td>
				@11
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"right\"  align=\"right\">@09</td>				
			</tr>";			

		$vTableProcessing01="
			<tr>
				<td class=\"tdprint\">
					<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" align=\"right\" style=\"padding-right:5px\">@02</td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@03</td>
						</tr>		
						@80										

					</table>
				</td>
			</tr>
			";
		$vTableProcessing="
			<tr>
							<td onClick=\"this.innerHTML='-'\"  align=\"left\" style=\"padding-right:5px;@04\" colspan=\"@90\">@02</td>
							<td onClick=\"this.innerHTML='-'\"   width=\"15%\" align=\"right\" style=\"padding-right:5px;@04\">@03</td>
							
			</tr>
					@80
			";			
		$vTableProcessingChild="
						<!--<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\"  align=\"left\" style=\"padding-right:5px\" colspan=\"@90\">@04</td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\"  width=\"15%\" align=\"right\" style=\"padding-right:5px\" >@05</td>
						</tr>						-->
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\" style=\"padding-right:5px\" colspan=\"@90\">@06</td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@07</td>
						</tr>
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" align=\"left\" style=\"padding-right:5px\" bgcolor=\"@96\" colspan=\"@90\"><font color=\"@97\">@08</font></td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" width=\"15%\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@98\"><font color=\"@99\">@09</font></td>
						</tr>						
						";			
		$vTableProcessingChild01="
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" align=\"right\" style=\"padding-right:5px\">@04</td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@05</td>
						</tr>						
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" align=\"right\" style=\"padding-right:5px\">@06</td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@07</td>
						</tr>
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@96\"><font color=\"@97\">@08</font></td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent_crm\" width=\"15%\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@98\"><font color=\"@99\">@09</font></td>
						</tr>						
						";
						
		$sqlS1 = "	SELECT A.ID ContractID, A.Name ContractName, A.CustomerID, A.EmployeeID, C.Name ShippingMethod,C.Description ShippingDescription, 
						A.ShippingDate, A.State, A.ShipPercent, D.Name PaymentMethod,D.Description PaymentDescription, A.ContractDate, 
						A.SalesTaxRate,A.ViewForm, B.ContactFirstName, B.ContactLastName ,A.Composition,A.PONo
					FROM mk_contracts A LEFT JOIN mk_customers B ON A.CustomerID=B.ID 
						LEFT JOIN mk_shippingmethods C ON A.ShippingMethod=C.ID 
						LEFT JOIN mk_paymentmethod D ON A.PaymentMethod=D.ID 
					WHERE A.ID='$pContractID' ORDER BY NULL;";
		$bResultS1 = db_query($sqlS1);
		$totalRows1 = db_num_rows($bResultS1);
		$vLineRun = "";
		$strExpportAll = "";

		$vTableParent = $vHContract;
		//Contract ID
		$vTableParent = str_replace("@02", $vLangArr[13], $vTableParent);
		//Customer ID
		$vTableParent = str_replace("@03", $vLangArr[14], $vTableParent);
		//Sales Person
		$vTableParent = str_replace("@04", $vLangArr[15], $vTableParent);
		//Contract Date
		$vTableParent = str_replace("@05", $vLangArr[16], $vTableParent);
		//State
		$vTableParent = str_replace("@11", $vLangArr[38], $vTableParent);
		//Sales Tax
		$vTableParent = str_replace("@06", $vLangArr[17], $vTableParent);
		//Shipping Method
		$vTableParent = str_replace("@07", $vLangArr[32], $vTableParent);
		//Shipping Date
		$vTableParent = str_replace("@08", $vLangArr[33], $vTableParent);
		//Shipping Percent
		$vTableParent = str_replace("@09", $vLangArr[34], $vTableParent);
		//Payment Method
		$vTableParent = str_replace("@10", $vLangArr[35], $vTableParent);

		if($totalRows1>0){
						$arrS1 = db_fetch_array ($bResultS1);
			$vLineRun ="";
			$vLineRun = $vRContract;
			$pCustomerID=$arrS1['CustomerID'];
			$vLineRun = str_replace("@02", ($arrS1['ContractID']!="" || $arrS1['ContractID']!=NULL)?$arrS1['ContractID']:"-", $vLineRun);
			$vLineRun = str_replace("@03", ($arrS1['CustomerID']!="" || $arrS1['CustomerID']!=NULL)?$arrS1['CustomerID']:"-", $vLineRun);
			$vSalesperson = $mouser->GetEmployee($plang, $arrS1['EmployeeID'], 1);
			$vLineRun = str_replace("@04", ($vSalesperson!="" || $vSalesperson!=NULL)?$vSalesperson:"-", $vLineRun);
			$vLineRun = str_replace("@05", ($arrS1['ContractDate']!="" || $arrS1['ContractDate']!=NULL)?getday($arrS1['ContractDate']).(($plang=="EN")?" ".$vArrMonth[(int)getmonth($arrS1['ContractDate'])].", ":"/".getmonth($arrS1['ContractDate'])."/").getyear($arrS1['ContractDate']):"-", $vLineRun);

			
			$vLineRun = str_replace("@11", ($arrS1['State']!="" || $arrS1['State']!=NULL)?((int)$arrS1['State']==0)?$vLangArr[39]:(((int)$arrS1['State']==1)?$vLangArr[41]:$vLangArr[40]):"-", $vLineRun);
			$vLineRun = str_replace("@06", ($arrS1['SalesTaxRate']!="" || $arrS1['SalesTaxRate']!=NULL)?$arrS1['SalesTaxRate']." %":"-", $vLineRun);
			$vLineRun = str_replace("@08", ($arrS1['ShippingDate']!="" || $arrS1['ShippingDate']!=NULL)?formatdate($arrS1['ShippingDate'], $plang):"-", $vLineRun);
			$vLineRun = str_replace("@09", ($arrS1['ShipPercent']!="" || $arrS1['ShipPercent']!=NULL)?$arrS1['ShipPercent']." %":"-", $vLineRun);
			if($plang=="VN")
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingMethod']!="" || $arrS1['ShippingMethod']!=NULL)?$arrS1['ShippingMethod']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentMethod']!="" || $arrS1['PaymentMethod']!=NULL)?$arrS1['PaymentMethod']:"-", $vLineRun);
			
			}
			else
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingDescription']!="" || $arrS1['ShippingDescription']!=NULL)?$arrS1['ShippingDescription']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentDescription']!="" || $arrS1['PaymentDescription']!=NULL)?$arrS1['PaymentDescription']:"-", $vLineRun);
			
			}			
			$FComposition=(int)$arrS1['Composition'];
			$FPONo=(int)$arrS1['PONo'];			
			$FTDisplayForm=(int)$arrS1['ViewForm'];
			if($FComposition==0)
			{
				 $vHContractDetail=str_replace("@13","",$vHContractDetail);
				 $vRContractDetail=str_replace("@13","",$vRContractDetail);
			}
			else
			{
				$vHContractDetail=str_replace("@13",$vHComp,$vHContractDetail);
				 $vRContractDetail=str_replace("@13",$vRComp,$vRContractDetail);				
			}
			if($FPONo==0)
			{
				 $vHContractDetail=str_replace("@14","",$vHContractDetail);
				 $vRContractDetail=str_replace("@14","",$vRContractDetail);
				 $vRContractDetailChild=str_replace("@14","",$vRContractDetailChild);
			}
			else
			{
				$vHContractDetail=str_replace("@14",$vHPONo,$vHContractDetail);
				$vRContractDetail=str_replace("@14",$vRPONo,$vRContractDetail);
				$vRContractDetailChild=str_replace("@14",$vRPONo,$vRContractDetailChild);				 				
			}
				
			$vTableParent = "";//str_replace("@01", $vLineRun, $vTableParent);
/////Child Table/////////////////////////////////////////////////////////////////////////////////////////////
			$vContractID = $arrS1['ContractID'];
			$sqlS2 = "	SELECT A.FabricID,F.LabID,B.FabCategoryID, A.Quantity, A.Discount, A.Price,A.Repeat,A.Tax, B.Name FabricName,B.Description, C.Name UnitName, D.Name Currency,E.NameVN ColorName,A.ColorID,E.NameEN ColorDescription,A.PercentColor,A.Weigth,A.Width,B.DocPicture Composition,A.PONo
						FROM mk_contractdetails A LEFT JOIN mk_fabrics B ON A.FabricID=B.ID
							LEFT JOIN mk_units C ON A.UnitID=C.ID
							LEFT JOIN mk_currency D ON A.UnitPriceID=D.ID LEFT JOIN warehouse_productx06.wh_color E on A.ColorID=E.ID LEFT JOIN mk_cusproducts F ON A.FabricID=F.FabricID AND F.CustomerID='$pCustomerID'
						WHERE A.ContractID='$vContractID' ORDER BY A.FabricID,A.Price DESC,A.Quantity DESC;";
			$bResultS2 = db_query($sqlS2);
			$totalRows2 = db_num_rows($bResultS2);

			$vTableChild = "";
			$vTotal = 0;
			$vTaxRate = $arrS1['SalesTaxRate'];///Sale Tax Rate
			$vShipPercent = $arrS1['ShipPercent'];///Shipping Percent
			$vTotalWithTax = 0;
			$vTotalWithDiscount = 0;
			$vLastResult = 0;//Last result of total contracts
			$vLineRunAll2 = "";

			$vTableChild = $vHContractDetail;
			//Fabric ID
			$vTableChild = str_replace("@02", $vLangArr[19], $vTableChild);
			//Fabric Name
			if($FTDisplayForm==0)
			$vTableChild = str_replace("@03", $vLangArr[20], $vTableChild);
			else
			$vTableChild = str_replace("@03", $vLangArr[63], $vTableChild);
			//Color
			$vTableChild = str_replace("@04", $vLangArr[42], $vTableChild);			
			//Quantity
			$vTableChild = str_replace("@05", $vLangArr[21], $vTableChild);
			//Unit Price
			$vTableChild = str_replace("@06", $vLangArr[22], $vTableChild);
			//Percent Color
			$vTableChild = str_replace("@07", $vLangArr[49], $vTableChild);
			//Discount
			$vTableChild = str_replace("@08", $vLangArr[50], $vTableChild);
			//Extended Price
			$vTableChild = str_replace("@09", $vLangArr[24], $vTableChild);
			//Repeate
			$vTableChild = str_replace("@10", $vLangArr[55], $vTableChild);			
			//Repeate
			$vTableChild = str_replace("@12", $vLangArr[57], $vTableChild);			
			//Composition
			$vTableChild = str_replace("@13", $vLangArr[62], $vTableChild);					
			//Composition
			$vTableChild = str_replace("@14", $vLangArr[65], $vTableChild);					
			
			//Tax rate
			if($vTaxRate==0)
			{
			$vTableChild = str_replace("@11","<td class=\"htable_crm\" width=\"5%\" align=\"center\">$vLangArr[56]</td>", $vTableChild);			
			}			
			else
			$vTableChild = str_replace("@11","", $vTableChild);			

			//Extended Price
			$vTableChild = str_replace("@09", $vLangArr[24], $vTableChild);			
			$vtFabricID="TR111111111111";
			$vNumline=0;
			if($totalRows2>0){
				while($arrS2=db_fetch_array($bResultS2)){
				
					if($vtFabricID != $arrS2['FabricID']){
						$vOrder++;
						$vtFabricID = $arrS2['FabricID'];
						if(strpos($vtFabricID,"LTGC")===false)
						{
							if(strpos($vtFabricID,$pCustomerID."_")===false)
								$vtTempID=$vtFabricID;							
							else
							{
								
								 $vtTempID=substr($vtFabricID,10,strlen($vtFabricID)-10);
							}						
						}
						else
						{
							if($arrS2['LabID']!=NULL && $arrS2['LabID']!="")
							$vtTempID=$arrS2['LabID'];
							else
							$vtTempID=$vtFabricID;
							
						}
						if($FTDisplayForm==0)		
						{
							if($plang=="VN")
								$vFabricName = ($arrS2['FabricName']!="" || $arrS2['FabricName']!=NULL)?$arrS2['FabricName']:"-";
							else
								$vFabricName = ($arrS2['Description']!="" || $arrS2['Description']!=NULL)?$arrS2['Description']:"-";
						}
						else
								$vFabricName = ($arrS2['LabID']!="" || $arrS2['LabID']!=NULL)?$arrS2['LabID']:"-";
						//$vFabricName = ($arrS2['FabricName']!="" || $arrS2['FabricName']!=NULL)?$arrS2['FabricName']:"-";
						$vLineRun2 = $vRContractDetail;
						$vLineRun2 = str_replace("@13", ($arrS2['Composition']!="" || $arrS2['Composition']!=NULL)?$arrS2['Composition']."":"-", $vLineRun2);
						$vLineRun2 = str_replace("@02",$vtTempID, $vLineRun2);
						$vLineRun2 = str_replace("@03", $vFabricName, $vLineRun2);
						$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);
						$vNumline = 0;
						$vCurrencyName=$arrS2['Currency'];
					}								
					$vNumline++;
					$vLineRun2 = str_replace("@14", ($arrS2['PONo']!="" || $arrS2['PONo']!=NULL)?$arrS2['PONo']."":"-", $vLineRun2);
					$vLineRun2 = str_replace("@04", ($arrS2['ColorID']!="" || $arrS2['ColorID']!=NULL)?$arrS2['ColorID']."":"-", $vLineRun2);					
					$vLineRun2 = str_replace("@05", ($arrS2['Quantity']!="" || $arrS2['Quantity']!=NULL)?LCurrencys($arrS2['Quantity'],$plang).$arrS2['UnitName']:"-", $vLineRun2);
					
					$vLineRun2 = str_replace("@06", ($arrS2['Price']!="" || $arrS2['Price']!=NULL)?LCurrency($arrS2['Price'],2):"-", $vLineRun2);
					

					$vLineRun2 = str_replace("@07", ($arrS2['Weigth']!="" || $arrS2['Weigth']!=NULL)?$arrS2['Weigth']."":"-", $vLineRun2);										
					$vLineRun2 = str_replace("@10", ($arrS2['Repeat']!="" || $arrS2['Repeat']!=NULL)?$arrS2['Repeat']."":"-", $vLineRun2);										
					
					$vLineRun2 = str_replace("@08", ($arrS2['Width']!="" || $arrS2['Width']!=NULL)?$arrS2['Width']."":"-", $vLineRun2);
					
					$vTaxDetail=($arrS2['Tax']!="" || $arrS2['Tax']!=NULL)?$arrS2['Tax']:0;
					if($vTaxRate==0)
					{
					$vLineRun2 = str_replace("@11", "<td align=\"right\">".(($arrS2['Tax']!="" || $arrS2['Tax']!=NULL)?(($arrS2['Tax']==0)?"-":LCurrency($arrS2['Tax'],$plang)."%"):"-")."</td>", $vLineRun2);
					}
					else
					{
					$vLineRun2 = str_replace("@11", "", $vLineRun2);
					$vTaxDetail=0;
					}
					if($plang=="VN")
					$vLineRun2 = str_replace("@12", ($arrS2['ColorName']!="" || $arrS2['ColorName']!=NULL)?$arrS2['ColorName']."":"-", $vLineRun2);	
					else			
					$vLineRun2 = str_replace("@12", ($arrS2['ColorDescription']!="" || $arrS2['ColorDescription']!=NULL)?$arrS2['ColorDescription']."":"-", $vLineRun2);
					$vDiscount = $arrS2['Discount'];///Discount
					$vExtendedPrice = $arrS2['Quantity']*$arrS2['Price'] ;
					$vExtendedPrice=$vExtendedPrice+$vExtendedPrice*$vTaxDetail/100;
					
					$vTotal = $vTotal + $vExtendedPrice;///Total with no tax
					$vLineRun2 = str_replace("@09", ($vExtendedPrice !="" || $vExtendedPrice!=NULL)?LCurrency($vExtendedPrice,$plang):"0", $vLineRun2);
					$vLineRunAll2=$vLineRunAll2.$vLineRun2;
					$vLineRun2=$vRContractDetailChild ;
				}
				$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);				

			} else {
				$vTableChild = str_replace("@01", $vLangArr[27], $vTableChild);
			}

		} else {
			return $vLangArr[26];
		}
		$vTableChild = str_replace("@80"," (".$vCurrencyName.")" , $vTableChild);
		$vTableChild = str_replace("@81", " (".$vCurrencyName.")", $vTableChild);		
		$vCalWithTax=$vTotal*($vTaxRate/100);
		$vTotalWithTax = $vTotal+$vCalWithTax;///Total with tax

		$vTotal = ($vTotal!=0 || $vTotal!=NULL || $vTotal!="")?$vTotal:"0";
		$vTotalWithTax = ($vTotalWithTax!=0 || $vTotalWithTax!=NULL || $vTotalWithTax!="")?$vTotalWithTax:"0";
		$vTableTotalTemp1 ="";
		if($vTaxRate!=0)
		{
			if($FComposition==1 && $FPONo==1)
			{
			$vTableProcessing=str_replace("@90","10",$vTableProcessing);
			$vTableProcessingChild=str_replace("@90","10",$vTableProcessingChild);					
			}
			elseif($FComposition==1 || $FPONo==1)
			{		
			$vTableProcessing=str_replace("@90","9",$vTableProcessing);
			$vTableProcessingChild=str_replace("@90","9",$vTableProcessingChild);					
			}
			else
			{
			$vTableProcessing=str_replace("@90","8",$vTableProcessing);
			$vTableProcessingChild=str_replace("@90","8",$vTableProcessingChild);		
			}		
			$vTableTotalTemp1 = $vTableProcessingChild;		
			$vTableTotalTemp1 = str_replace("@04", "".$vLangArr[52]."", $vTableTotalTemp1);
			$vTableTotalTemp1 = str_replace("@05", "".$vTaxRate."% ", $vTableTotalTemp1);		
			$vTableTotalTemp1 = str_replace("@06", "".$vLangArr[30]."", $vTableTotalTemp1);
			$vTableTotalTemp1 = str_replace("@08", "<b>".$vLangArr[53]."</b>", $vTableTotalTemp1);		
			$vTableTotalTemp1 = str_replace("@07", "".LCurrency($vCalWithTax,$plang), $vTableTotalTemp1);	
			$vTableTotalTemp1 = str_replace("@09", "<b>".LCurrency($vTotalWithTax,$plang)."</b>", $vTableTotalTemp1);	
		}
		/////Table Processing Sum of contracts
		if($FComposition==1 && $FPONo==1)
		{
		$vTableProcessing=str_replace("@90","11",$vTableProcessing);
		$vTableProcessingChild=str_replace("@90","11",$vTableProcessingChild);					
		}
		elseif($FComposition==1 || $FPONo==1)
		{
		$vTableProcessing=str_replace("@90","10",$vTableProcessing);
		$vTableProcessingChild=str_replace("@90","10",$vTableProcessingChild);					
		}
		else
		{
		$vTableProcessing=str_replace("@90","9",$vTableProcessing);
		$vTableProcessingChild=str_replace("@90","9",$vTableProcessingChild);					
		}
		$vTableTotalTemp =str_replace("@80",$vTableTotalTemp1,$vTableProcessing);
		$vTableTotalTemp = str_replace("@02", "".(($vTaxRate!=0)?$vLangArr[28]:$vLangArr[53])."", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@04", "".(($vTaxRate!=0)?"":"font-weight:bold")."", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@03", "".LCurrency($vTotal,$plang), $vTableTotalTemp);		
		$vTableTotalTemp = str_replace("@96", "#FFFFFF", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@97", "#000000", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@98", "#BCF0F5", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@99", "#000000", $vTableTotalTemp);

		$strExpportAll = $this->vTableGeneral;
		$strExpportAll = str_replace("@02", $vTableParent, $strExpportAll);
		$vTableChild = str_replace("@01", $vLineRunAll2.$vTableTotalTemp, $vTableChild);
		$strExpportAll = str_replace("@03", $vTableChild, $strExpportAll);
		$strExpportAll = str_replace("@04", "", $strExpportAll);
		return $strExpportAll;
	}
	function ReportInvoicePrint($plang, $vLangArr, $pCustomerID, $pContractID,$pOpt){
		$mouser=new user();///New user object for get Employee Name

		$vHContract="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td class=\"htable\" width=\"10%\" align=\"center\" height=\"20px\">@02</td>
					<td class=\"htable\" width=\"13%\" align=\"center\">@03</td>
					<!--<td class=\"htable\" width=\"*\" align=\"center\">@04</td>-->
					<td class=\"htable\" width=\"8%\" align=\"center\">@05</td>
					<td class=\"htable\" width=\"8%\" align=\"center\">@11</td>
					<!--<td class=\"htable\" width=\"8%\" align=\"center\">@06</td>-->
					<td class=\"htable\" width=\"10%\" align=\"center\">@07</td>
					<td class=\"htable\" width=\"8%\" align=\"center\">@08</td>
<!--					<td class=\"htable\" width=\"8%\" align=\"center\">@09</td>-->
					<td class=\"htable\" width=\"10%\" align=\"center\">@10</td>	
				</tr>
				@01
			</table>";

		$vHContractDetail="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td class=\"htable\" width=\"7%\" align=\"center\" height=\"20px\">@02</td>
					<td class=\"htable\" width=\"*\" align=\"center\">@03</td>
					<td class=\"htable\" width=\"6%\" align=\"center\">@04</td>
					<td class=\"htable\" width=\"10%\" align=\"center\">@12</td>											
					<td class=\"htable\" width=\"7%\" align=\"center\">@08</td>																
					<td class=\"htable\" width=\"7%\" align=\"center\">@07</td>
					<td class=\"htable\" width=\"7%\" align=\"center\">@10</td>					
					<td class=\"htable\" width=\"10%\" align=\"center\">@05</td>
					<td class=\"htable\" width=\"10%\" align=\"center\">@06</td>
					@11
					<td class=\"htable\" width=\"10%\" align=\"center\">@09</td>					
				</tr>
				@01
			</table>";

		$vRContract="
			<tr>
				<td class=\"center_style\" height=\"20px\">@02 &nbsp;</td>
				<td class=\"center_style\">@03</td>
				<!--<td class=\"left_style\">@04</td>-->
				<td class=\"center_style\">@05</td>
				<td class=\"left_style\">@11</td>
			<!--	<td class=\"center_style\">@06</td>-->
				<td class=\"left_style\">@07</td>
				<td class=\"center_style\">@08</td>
			<!--	<td class=\"right_style\">@09</td>-->
				<td class=\"left_style\">@10</td>
			</tr>";

		$vRContractDetail="
			<tr>
				<td rowspan=\"@01\" class=\"center_style\" align=\"center\" height=\"20px\">@02</td>
				<td rowspan=\"@01\" class=\"left_style\" align=\"left\">@03</td>
				<td class=\"right_style\">@04</td>
				<td class=\"left_style\">@12</td>								
				<td class=\"right_style\">@08</td>
				<td class=\"right_style\">@07</td>
				<td class=\"right_style\">@10</td>				
				<td class=\"right_style\">@05</td>
				<td class=\"right_style\">@06</td>
				@11
				<td class=\"right_style\">@09</td>				
			</tr>";
		$vRContractDetailChild="
			<tr>	
				<td class=\"right_style\">@04</td>
				<td class=\"left_style\">@12</td>				
				<td class=\"right_style\">@08</td>
				<td class=\"right_style\">@07</td>
				<td class=\"right_style\">@10</td>				
				<td class=\"right_style\">@05</td>
				<td class=\"right_style\">@06</td>
				@11
				<td class=\"right_style\">@09</td>				
			</tr>";			

		$vTableProcessing="
			<tr>
				<td class=\"tdprint\">
					<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@02</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@03</td>
						</tr>		
						@80										

					</table>
				</td>
			</tr>
			";
		$vTableProcessingChild="
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@04</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@05</td>
						</tr>						
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@06</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@07</td>
						</tr>
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@96\"><font color=\"@97\">@08</font></td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@98\"><font color=\"@99\">@09</font></td>
						</tr>						
						";
						
		$sqlS1 = "	SELECT A.ID ContractID, A.Name ContractName, A.CustomerID, A.EmployeeID, C.Name ShippingMethod,C.Description ShippingDescription, 
						A.ShippingDate, A.State, A.ShipPercent, D.Name PaymentMethod,D.Description PaymentDescription, A.ContractDate, 
						A.SalesTaxRate, B.ContactFirstName, B.ContactLastName 
					FROM mk_contracts A LEFT JOIN mk_customers B ON A.CustomerID=B.ID 
						LEFT JOIN mk_shippingmethods C ON A.ShippingMethod=C.ID 
						LEFT JOIN mk_paymentmethod D ON A.PaymentMethod=D.ID 
					WHERE A.ID='$pContractID' ORDER BY NULL;";
		$bResultS1 = db_query($sqlS1);
		$totalRows1 = db_num_rows($bResultS1);
		$vLineRun = "";
		$strExpportAll = "";

		$vTableParent = $vHContract;
		//Contract ID
		$vTableParent = str_replace("@02", $vLangArr[13], $vTableParent);
		//Customer ID
		$vTableParent = str_replace("@03", $vLangArr[14], $vTableParent);
		//Sales Person
		$vTableParent = str_replace("@04", $vLangArr[15], $vTableParent);
		//Contract Date
		$vTableParent = str_replace("@05", $vLangArr[16], $vTableParent);
		//State
		$vTableParent = str_replace("@11", $vLangArr[38], $vTableParent);
		//Sales Tax
		$vTableParent = str_replace("@06", $vLangArr[17], $vTableParent);
		//Shipping Method
		$vTableParent = str_replace("@07", $vLangArr[32], $vTableParent);
		//Shipping Date
		$vTableParent = str_replace("@08", $vLangArr[33], $vTableParent);
		//Shipping Percent
		$vTableParent = str_replace("@09", $vLangArr[34], $vTableParent);
		//Payment Method
		$vTableParent = str_replace("@10", $vLangArr[35], $vTableParent);

		if($totalRows1>0){
			$arrS1 = db_fetch_array ($bResultS1);
			$vLineRun ="";
			$vLineRun = $vRContract;
			$pCustomerID=$arrS1['CustomerID'];
			$vLineRun = str_replace("@02", ($arrS1['ContractID']!="" || $arrS1['ContractID']!=NULL)?$arrS1['ContractID']:"-", $vLineRun);
			$vLineRun = str_replace("@03", ($arrS1['CustomerID']!="" || $arrS1['CustomerID']!=NULL)?$arrS1['CustomerID']:"-", $vLineRun);
			$vSalesperson = $mouser->GetEmployee($plang, $arrS1['EmployeeID'], 1);
			$vLineRun = str_replace("@04", ($vSalesperson!="" || $vSalesperson!=NULL)?$vSalesperson:"-", $vLineRun);
			$vLineRun = str_replace("@05", ($arrS1['ContractDate']!="" || $arrS1['ContractDate']!=NULL)?formatdate($arrS1['ContractDate'], $plang):"-", $vLineRun);
			$vLineRun = str_replace("@11", ($arrS1['State']!="" || $arrS1['State']!=NULL)?((int)$arrS1['State']==0)?$vLangArr[39]:(((int)$arrS1['State']==1)?$vLangArr[41]:$vLangArr[40]):"-", $vLineRun);
			$vLineRun = str_replace("@06", ($arrS1['SalesTaxRate']!="" || $arrS1['SalesTaxRate']!=NULL)?$arrS1['SalesTaxRate']." %":"-", $vLineRun);
			$vLineRun = str_replace("@08", ($arrS1['ShippingDate']!="" || $arrS1['ShippingDate']!=NULL)?formatdate($arrS1['ShippingDate'], $plang):"-", $vLineRun);
			$vLineRun = str_replace("@09", ($arrS1['ShipPercent']!="" || $arrS1['ShipPercent']!=NULL)?$arrS1['ShipPercent']." %":"-", $vLineRun);
			if($plang=="VN")
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingMethod']!="" || $arrS1['ShippingMethod']!=NULL)?$arrS1['ShippingMethod']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentMethod']!="" || $arrS1['PaymentMethod']!=NULL)?$arrS1['PaymentMethod']:"-", $vLineRun);
			
			}
			else
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingDescription']!="" || $arrS1['ShippingDescription']!=NULL)?$arrS1['ShippingDescription']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentDescription']!="" || $arrS1['PaymentDescription']!=NULL)?$arrS1['PaymentDescription']:"-", $vLineRun);
			
			}			

			$vTableParent = str_replace("@01", $vLineRun, $vTableParent);
/////Child Table/////////////////////////////////////////////////////////////////////////////////////////////
			$vContractID = $arrS1['ContractID'];
			$sqlS2 = "	SELECT A.FabricID,F.LabID,B.FabCategoryID, A.Quantity, A.Discount, A.Price,A.Repeat,A.Tax,A.UnitID,B.Name FabricName, C.Name UnitName, D.Name Currency,E.NameVN ColorName,A.ColorID,E.NameEN ColorDescription,A.PercentColor,A.Weigth,A.Width
						FROM mk_contractdetails A LEFT JOIN mk_fabrics B ON A.FabricID=B.ID
							LEFT JOIN mk_units C ON A.UnitID=C.ID
							LEFT JOIN mk_currency D ON A.UnitPriceID=D.ID LEFT JOIN warehouse_productx06.wh_color E on A.ColorID=E.ID LEFT JOIN mk_cusproducts F ON A.FabricID=F.FabricID AND F.CustomerID='$pCustomerID'
						WHERE A.ContractID='$vContractID' ORDER BY A.FabricID,A.Price DESC,A.Quantity DESC;";
			$bResultS2 = db_query($sqlS2);
			$totalRows2 = db_num_rows($bResultS2);

			$vTableChild = "";
			$vTotal = 0;
			$vTaxRate = $arrS1['SalesTaxRate'];///Sale Tax Rate
			$vShipPercent = $arrS1['ShipPercent'];///Shipping Percent
			$vTotalWithTax = 0;
			$vTotalWithDiscount = 0;
			$vLastResult = 0;//Last result of total contracts
			$vLineRunAll2 = "";

			$vTableChild = $vHContractDetail;
			//Fabric ID
			$vTableChild = str_replace("@02", $vLangArr[19], $vTableChild);
			//Fabric Name
			$vTableChild = str_replace("@03", $vLangArr[20], $vTableChild);
			//Color
			$vTableChild = str_replace("@04", $vLangArr[42], $vTableChild);			
			//Quantity
			$vTableChild = str_replace("@05", $vLangArr[21], $vTableChild);
			//Unit Price
			$vTableChild = str_replace("@06", $vLangArr[22], $vTableChild);
			//Percent Color
			$vTableChild = str_replace("@07", $vLangArr[49], $vTableChild);
			//Discount
			$vTableChild = str_replace("@08", $vLangArr[50], $vTableChild);
			//Extended Price
			$vTableChild = str_replace("@09", $vLangArr[24], $vTableChild);
			//Repeate
			$vTableChild = str_replace("@10", $vLangArr[55], $vTableChild);			
			//Repeate
			$vTableChild = str_replace("@12", $vLangArr[57], $vTableChild);			
			
			//Tax rate
			if($vTaxRate==0)
			{
			$vTableChild = str_replace("@11","<td class=\"htable\" width=\"5%\" align=\"center\">$vLangArr[56]</td>", $vTableChild);			
			}			
			else
			$vTableChild = str_replace("@11","", $vTableChild);			
			
			//Extended Price
			$vTableChild = str_replace("@09", $vLangArr[24], $vTableChild);			
			$vtFabricID="TR111111111111";
			$vNumline=0;
			if($totalRows2>0){
				while($arrS2=db_fetch_array($bResultS2)){
				
					if($vtFabricID != $arrS2['FabricID']){
						$vOrder++;
						$vtFabricID = $arrS2['FabricID'];
						if(strpos($vtFabricID,"LTGC")===false)
						{
							if(strpos($vtFabricID,$pCustomerID."_")===false)
								$vtTempID=$vtFabricID;							
							else
							{
								
								$vtTempID=substr($vtFabricID,10,strlen($vtFabricID)-10);
							}						
						}
						else
						{
							if($arrS2['LabID']!=NULL && $arrS2['LabID']!="")
							$vtTempID=$arrS2['LabID'];
							else
							$vtTempID=$vtFabricID;
							
						}

						$vFabricName = ($arrS2['FabricName']!="" || $arrS2['FabricName']!=NULL)?$arrS2['FabricName']:"-";
						$vLineRun2 = $vRContractDetail;
						$vLineRun2 = str_replace("@02",$vtTempID, $vLineRun2);
						$vLineRun2 = str_replace("@03", $vFabricName, $vLineRun2);
						$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);
						$vNumline = 0;
						$vCurrencyName=$arrS2['Currency'];
					}								
					$vNumline++;
					switch($pOpt)
					{
						case 1:
							$strQuantity=$this->GetQuantityOutputColor($vContractID,$arrS2['FabricID'],$arrS2['ColorID'],$arrS2['UnitID'])-$this->GetQuantityReceiptionColor($vContractID,$arrS2['FabricID'],$arrS2['ColorID'],$arrS2['UnitID']);
							break;
						case 2:
							$strQuantity=$this->GetQuantityOutputWidth($vContractID,$arrS2['FabricID'],$arrS2['Width'],$arrS2['UnitID'])-$this->GetQuantityReceiptionWidth($vContractID,$arrS2['FabricID'],$arrS2['Width'],$arrS2['UnitID']);						
							break;
						default:
							$strQuantity=$this->GetQuantityOutput($vContractID,$arrS2['FabricID'],$arrS2['ColorID'],$arrS2['Width'],$arrS2['UnitID'])-$this->GetQuantityReceiption($vContractID,$arrS2['FabricID'],$arrS2['ColorID'],$arrS2['Width'],$arrS2['UnitID']);						
							break;
					}
					
					$strQuantity=($strQuantity!="" || $strQuantity!=NULL)?$strQuantity.$arrS2['UnitName']:"0".$arrS2['UnitName'];
					$vLineRun2 = str_replace("@04", ($arrS2['ColorID']!="" || $arrS2['ColorID']!=NULL)?$arrS2['ColorID']."":"-", $vLineRun2);					
					$vLineRun2 = str_replace("@05",$strQuantity , $vLineRun2);
					if ($vCurrencyName=="$" || $vCurrencyName=="USD")
					{
					$vLineRun2 = str_replace("@06", ($arrS2['Price']!="" || $arrS2['Price']!=NULL)?$vCurrencyName.LCurrency($arrS2['Price'],2)."":"-", $vLineRun2);
					}
					else
					{
					$vLineRun2 = str_replace("@06", ($arrS2['Price']!="" || $arrS2['Price']!=NULL)?LCurrency($arrS2['Price'],2)."$vCurrencyName":"-", $vLineRun2);
					}
					

					$vLineRun2 = str_replace("@07", ($arrS2['Weigth']!="" || $arrS2['Weigth']!=NULL)?$arrS2['Weigth']."":"-", $vLineRun2);										
					$vLineRun2 = str_replace("@10", ($arrS2['Repeat']!="" || $arrS2['Repeat']!=NULL)?$arrS2['Repeat']."":"-", $vLineRun2);										
					
					$vLineRun2 = str_replace("@08", ($arrS2['Width']!="" || $arrS2['Width']!=NULL)?$arrS2['Width']."":"-", $vLineRun2);
					$vTaxDetail=($arrS2['Tax']!="" || $arrS2['Tax']!=NULL)?$arrS2['Tax']:0;
					if($vTaxRate==0)
					{
					$vLineRun2 = str_replace("@11", "<td class=\"right_style\">".$vTaxDetail."%</td>", $vLineRun2);
					}
					else
					{
					$vLineRun2 = str_replace("@11", "", $vLineRun2);
					$vTaxDetail=0;
					}
					if($plang=="VN")
					$vLineRun2 = str_replace("@12", ($arrS2['ColorName']!="" || $arrS2['ColorName']!=NULL)?$arrS2['ColorName']."":"-", $vLineRun2);	
					else			
					$vLineRun2 = str_replace("@12", ($arrS2['ColorDescription']!="" || $arrS2['ColorDescription']!=NULL)?$arrS2['ColorDescription']."":"-", $vLineRun2);
					$vDiscount = $arrS2['Discount'];///Discount
					$vExtendedPrice = $strQuantity*$arrS2['Price'] ;
					$vExtendedPrice=$vExtendedPrice+$vExtendedPrice*$vTaxDetail/100;
					
					$vTotal = $vTotal + $vExtendedPrice;///Total with no tax
					if ($vCurrencyName=="$" || $vCurrencyName=="USD")
					$vLineRun2 = str_replace("@09",($vExtendedPrice !="" || $vExtendedPrice!=NULL)? $vCurrencyName.LCurrency($vExtendedPrice,$plang):$vCurrencyName."0", $vLineRun2);
					else
					$vLineRun2 = str_replace("@09", ($vExtendedPrice !="" || $vExtendedPrice!=NULL)?LCurrency($vExtendedPrice,$plang).$vCurrencyName:"0", $vLineRun2);
					$vLineRunAll2=$vLineRunAll2.$vLineRun2;
					$vLineRun2=$vRContractDetailChild ;
				}
				$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);				
				$vTableChild = str_replace("@01", $vLineRunAll2, $vTableChild);
			} else {
				$vTableChild = str_replace("@01", $vLangArr[27], $vTableChild);
			}

		} else {
			return $vLangArr[26];
		}
		$vCalWithTax=$vTotal*($vTaxRate/100);
		$vTotalWithTax = $vTotal+$vCalWithTax;///Total with tax

		$vTotal = ($vTotal!=0 || $vTotal!=NULL || $vTotal!="")?$vTotal:"0";
		$vTotalWithTax = ($vTotalWithTax!=0 || $vTotalWithTax!=NULL || $vTotalWithTax!="")?$vTotalWithTax:"0";
		$vTableTotalTemp1 ="";
		if($vTaxRate!=0)
		{
		$vTableTotalTemp1 = $vTableProcessingChild;		
		$vTableTotalTemp1 = str_replace("@04", "".$vLangArr[52]."", $vTableTotalTemp1);
		$vTableTotalTemp1 = str_replace("@05", "".$vTaxRate."% ", $vTableTotalTemp1);		
		$vTableTotalTemp1 = str_replace("@06", "".$vLangArr[30]."", $vTableTotalTemp1);
				$vTableTotalTemp1 = str_replace("@08", "<b>".$vLangArr[53]."</b>", $vTableTotalTemp1);		
		if ($vCurrencyName=="$" || $vCurrencyName=="USD")
			{
				$vTableTotalTemp1 = str_replace("@07", "$vCurrencyName".LCurrency($vCalWithTax,$plang), $vTableTotalTemp1);	
				$vTableTotalTemp1 = str_replace("@09", "<b>$vCurrencyName".LCurrency($vTotalWithTax,$plang)."</b>", $vTableTotalTemp1);	
			}
			else
			{
				$vTableTotalTemp1 = str_replace("@07", "".LCurrency($vCalWithTax,$plang)." ".$vCurrencyName."", $vTableTotalTemp1);	
				$vTableTotalTemp1 = str_replace("@09", "<b>".LCurrency($vTotalWithTax,$plang)." ".$vCurrencyName."</b>", $vTableTotalTemp1);	
			}
		
		}

		/////Table Processing Sum of contracts
		$vTableTotalTemp =str_replace("@80",$vTableTotalTemp1,$vTableProcessing);
		$vTableTotalTemp = str_replace("@02", "".$vLangArr[28]."", $vTableTotalTemp);
		if ($vCurrencyName=="$" || $vCurrencyName=="USD")
			$vTableTotalTemp = str_replace("@03", "$vCurrencyName".LCurrency($vTotal,$plang), $vTableTotalTemp);
		else
			$vTableTotalTemp = str_replace("@03", "".LCurrency($vTotal,$plang)." ".$vCurrencyName."", $vTableTotalTemp);		
		$vTableTotalTemp = str_replace("@96", "#FFFFFF", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@97", "#000000", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@98", "#BCF0F5", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@99", "#000000", $vTableTotalTemp);

		$strExpportAll = $this->vTableGeneral;
		$strExpportAll = str_replace("@02", $vTableParent, $strExpportAll);
		$strExpportAll = str_replace("@03", $vTableChild, $strExpportAll);
		$strExpportAll = str_replace("@04", $vTableTotalTemp, $strExpportAll);
		return $strExpportAll;
	}
	function GetQuantityOutput($vContractID,$vFabricID,$vColorID,$vWidth,$vUnitID,$vOutStockID)
	{
		$strcondi="";
		if($vOutStockID!="" && $vOutStockID!=NULL) $strcondi=" AND D.ID='$vOutStockID'";
		 $vsql="select sum(A.QuantityContract) Quantitys,A.UnitContractID from warehouse_productx06.wh_outstockdetail A inner join warehouse_productx06.wh_lots B on A.Lot=B.LotID and A.StockID=B.StockID and B.Color='$vColorID' and B.Tyles='$vWidth'  where A.StockID='$vFabricID' and A.InvoiceID IN (select D.ID from warehouse_productx06.wh_outstock D where D.ReferenceID='$vContractID' and D.Type=4 $strcondi) Group by A.UnitContractID" ;
		$bResult = db_query($vsql);
		$vrow=db_fetch_array($bResult );
		if($vrow) 
			{
				if($vrow['UnitContractID']==$vUnitID)
				{
					return $vrow['Quantitys'];				
				}
				else
					return 0;
				

			}
		else
			return 0;
	}
	function GetQuantityReceiption($vContractID,$vFabricID,$vColorID,$vWidth,$vUnitID)
	{
		 $vsql="select sum(A.Price) Quantitys,A.UnitPriceID from warehouse_productx06.wh_receiptiondetail A inner join warehouse_productx06.wh_lots B on A.Lot=B.LotID and A.StockID=B.StockID and B.Color='$vColorID' and B.Tyles='$vWidth'  where A.StockID='$vFabricID' and A.InvoiceID IN (select D.ID from warehouse_productx06.wh_receiption D where D.ReferenceID='$vContractID' and D.Type=7) Group by A.UnitPriceID" ;
		$bResult = db_query($vsql);
		$vrow=db_fetch_array($bResult );
		if($vrow) 
			{
				if($vrow['UnitPriceID']==$vUnitID)
				{
					return $vrow['Quantitys'];				
				}
				else
					return 0;
				

			}
		else
			return 0;
	}
////////////////GetQuantityOutputColor////////////////	
	function GetQuantityOutputColor($vContractID,$vFabricID,$vColorID,$vUnitID,$vOutStockID)
	{
		$strcondi="";
		if($vOutStockID!="" && $vOutStockID!=NULL) $strcondi=" AND D.ID='$vOutStockID'";
		$vsql="select sum(A.QuantityContract) Quantitys,A.UnitContractID from warehouse_productx06.wh_outstockdetail A inner join warehouse_productx06.wh_lots B on A.Lot=B.LotID and A.StockID=B.StockID and B.Color='$vColorID'  where A.StockID='$vFabricID' and A.InvoiceID IN (select D.ID from warehouse_productx06.wh_outstock D where D.ReferenceID='$vContractID' and D.Type=4 $strcondi) Group by A.UnitContractID" ;
		$bResult = db_query($vsql);
		$vrow=db_fetch_array($bResult );
		if($vrow) 
			{
				if($vrow['UnitContractID']==$vUnitID)
				{
					return $vrow['Quantitys'];				
				}
				else
					return 0;
				

			}
		else
			return 0;
	}	
	function GetQuantityReceiptionColor($vContractID,$vFabricID,$vColorID,$vUnitID)
	{
		$vsql="select sum(A.Price) Quantitys,A.UnitPriceID from warehouse_productx06.wh_receiptiondetail A inner join warehouse_productx06.wh_lots B on A.Lot=B.LotID and A.StockID=B.StockID and B.Color='$vColorID'  where A.StockID='$vFabricID' and A.InvoiceID IN (select D.ID from warehouse_productx06.wh_receiption D where D.ReferenceID='$vContractID' and D.Type=7) Group by A.UnitID" ;
		$bResult = db_query($vsql);
		$vrow=db_fetch_array($bResult );
		if($vrow) 
			{
				if($vrow['UnitPriceID']==$vUnitID)
				{
					return $vrow['Quantitys'];				
				}
				else
					return 0;
				

			}
		else
			return 0;
	}	
	function GetQuantityOutputWidth($vContractID,$vFabricID,$vWidth,$vUnitID,$vOutStockID)
	{
		$strcondi="";
		if($vOutStockID!="" && $vOutStockID!=NULL) $strcondi=" AND D.ID='$vOutStockID'";
		 $vsql="select sum(A.QuantityContract) Quantitys,A.UnitContractID from warehouse_productx06.wh_outstockdetail A inner join warehouse_productx06.wh_lots B on A.Lot=B.LotID and A.StockID=B.StockID and B.Tyles='$vWidth'  where A.StockID='$vFabricID' and A.InvoiceID IN (select D.ID from warehouse_productx06.wh_outstock D where D.ReferenceID='$vContractID' and D.Type=4) Group by A.UnitContractID" ;
		$bResult = db_query($vsql);
		$vrow=db_fetch_array($bResult );
		if($vrow) 
			{
				if($vrow['UnitContractID']==$vUnitID)
				{
					return $vrow['Quantitys'];				
				}
				else
					return 0;
				

			}
		else
			return 0;
	}	
	function GetQuantityReceiptionWidth($vContractID,$vFabricID,$vWidth,$vUnitID)
	{
		 $vsql="select sum(A.Price) Quantitys,A.UnitPriceID from warehouse_productx06.wh_receiptiondetail A inner join warehouse_productx06.wh_lots B on A.Lot=B.LotID and A.StockID=B.StockID and B.Tyles='$vWidth'  where A.StockID='$vFabricID' and A.InvoiceID IN (select D.ID from warehouse_productx06.wh_receiption D where D.ReferenceID='$vContractID' and D.Type=7) Group by A.UnitPriceID" ;
		$bResult = db_query($vsql);
		$vrow=db_fetch_array($bResult );
		if($vrow) 
			{
				if($vrow['UnitPriceID']==$vUnitID)
				{
					return $vrow['Quantitys'];				
				}
				else
					return 0;
				

			}
		else
			return 0;
	}		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ReportInvoicePrintDetail($plang, $vLangArr, $pCustomerID, $pContractID,$pOpt,$vOutStockID){
		$mouser=new user();///New user object for get Employee Name

		$vHContract="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td class=\"htable\" width=\"10%\" align=\"center\" height=\"20px\">@02</td>
					<td class=\"htable\" width=\"13%\" align=\"center\">@03</td>
					<!--<td class=\"htable\" width=\"*\" align=\"center\">@04</td>-->
					<td class=\"htable\" width=\"8%\" align=\"center\">@05</td>
					<td class=\"htable\" width=\"8%\" align=\"center\">@11</td>
					<!--<td class=\"htable\" width=\"8%\" align=\"center\">@06</td>-->
					<td class=\"htable\" width=\"10%\" align=\"center\">@07</td>
					<td class=\"htable\" width=\"8%\" align=\"center\">@08</td>
<!--					<td class=\"htable\" width=\"8%\" align=\"center\">@09</td>-->
					<td class=\"htable\" width=\"10%\" align=\"center\">@10</td>	
				</tr>
				@01
			</table>";

		$vHContractDetail="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td class=\"htable\" width=\"7%\" align=\"center\" height=\"20px\">@02</td>
					<td class=\"htable\" width=\"*\" align=\"center\">@03</td>
					<td class=\"htable\" width=\"6%\" align=\"center\">@04</td>
					<td class=\"htable\" width=\"10%\" align=\"center\">@12</td>											
					<td class=\"htable\" width=\"7%\" align=\"center\">@08</td>																
					<td class=\"htable\" width=\"7%\" align=\"center\">@07</td>
					<td class=\"htable\" width=\"7%\" align=\"center\">@10</td>					
					<td class=\"htable\" width=\"10%\" align=\"center\">@05</td>
					<td class=\"htable\" width=\"10%\" align=\"center\">@06</td>
					@11
					<td class=\"htable\" width=\"10%\" align=\"center\">@09</td>					
				</tr>
				@01
			</table>";

		$vRContract="
			<tr>
				<td class=\"center_style\" height=\"20px\">@02 &nbsp;</td>
				<td class=\"center_style\">@03</td>
				<!--<td class=\"left_style\">@04</td>-->
				<td class=\"center_style\">@05</td>
				<td class=\"left_style\">@11</td>
			<!--	<td class=\"center_style\">@06</td>-->
				<td class=\"left_style\">@07</td>
				<td class=\"center_style\">@08</td>
			<!--	<td class=\"right_style\">@09</td>-->
				<td class=\"left_style\">@10</td>
			</tr>";

		$vRContractDetail="
			<tr>
				<td rowspan=\"@01\" class=\"center_style\" align=\"center\" height=\"20px\">@02</td>
				<td rowspan=\"@01\" class=\"left_style\" align=\"left\">@03</td>
				<td class=\"right_style\">@04</td>
				<td class=\"left_style\">@12</td>								
				<td class=\"right_style\">@08</td>
				<td class=\"right_style\">@07</td>
				<td class=\"right_style\">@10</td>				
				<td class=\"right_style\">@05</td>
				<td class=\"right_style\">@06</td>
				@11
				<td class=\"right_style\">@09</td>				
			</tr>";
		$vRContractDetailChild="
			<tr>	
				<td class=\"right_style\">@04</td>
				<td class=\"left_style\">@12</td>				
				<td class=\"right_style\">@08</td>
				<td class=\"right_style\">@07</td>
				<td class=\"right_style\">@10</td>				
				<td class=\"right_style\">@05</td>
				<td class=\"right_style\">@06</td>
				@11
				<td class=\"right_style\">@09</td>				
			</tr>";			

		$vTableProcessing="
			<tr>
				<td class=\"tdprint\">
					<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@02</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@03</td>
						</tr>		
						@80										

					</table>
				</td>
			</tr>
			";
		$vTableProcessingChild="
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@04</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@05</td>
						</tr>						
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@06</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@07</td>
						</tr>
						<tr>
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@96\"><font color=\"@97\">@08</font></td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@98\"><font color=\"@99\">@09</font></td>
						</tr>						
						";
						
		$sqlS1 = "	SELECT A.ID ContractID, A.Name ContractName, A.CustomerID, A.EmployeeID, C.Name ShippingMethod,C.Description ShippingDescription, 
						A.ShippingDate, A.State, A.ShipPercent, D.Name PaymentMethod,D.Description PaymentDescription, A.ContractDate, 
						A.SalesTaxRate, B.ContactFirstName, B.ContactLastName 
					FROM mk_contracts A LEFT JOIN mk_customers B ON A.CustomerID=B.ID 
						LEFT JOIN mk_shippingmethods C ON A.ShippingMethod=C.ID 
						LEFT JOIN mk_paymentmethod D ON A.PaymentMethod=D.ID 
					WHERE A.ID='$pContractID' ORDER BY NULL;";
		$bResultS1 = db_query($sqlS1);
		$totalRows1 = db_num_rows($bResultS1);
		$vLineRun = "";
		$strExpportAll = "";

		$vTableParent = $vHContract;
		//Contract ID
		$vTableParent = str_replace("@02", $vLangArr[13], $vTableParent);
		//Customer ID
		$vTableParent = str_replace("@03", $vLangArr[14], $vTableParent);
		//Sales Person
		$vTableParent = str_replace("@04", $vLangArr[15], $vTableParent);
		//Contract Date
		$vTableParent = str_replace("@05", $vLangArr[16], $vTableParent);
		//State
		$vTableParent = str_replace("@11", $vLangArr[38], $vTableParent);
		//Sales Tax
		$vTableParent = str_replace("@06", $vLangArr[17], $vTableParent);
		//Shipping Method
		$vTableParent = str_replace("@07", $vLangArr[32], $vTableParent);
		//Shipping Date
		$vTableParent = str_replace("@08", $vLangArr[33], $vTableParent);
		//Shipping Percent
		$vTableParent = str_replace("@09", $vLangArr[34], $vTableParent);
		//Payment Method
		$vTableParent = str_replace("@10", $vLangArr[35], $vTableParent);

		if($totalRows1>0){
			$arrS1 = db_fetch_array ($bResultS1);
			$vLineRun ="";
			$vLineRun = $vRContract;
			$pCustomerID=$arrS1['CustomerID'];
			$vLineRun = str_replace("@02", ($arrS1['ContractID']!="" || $arrS1['ContractID']!=NULL)?$arrS1['ContractID']:"-", $vLineRun);
			$vLineRun = str_replace("@03", ($arrS1['CustomerID']!="" || $arrS1['CustomerID']!=NULL)?$arrS1['CustomerID']:"-", $vLineRun);
			$vSalesperson = $mouser->GetEmployee($plang, $arrS1['EmployeeID'], 1);
			$vLineRun = str_replace("@04", ($vSalesperson!="" || $vSalesperson!=NULL)?$vSalesperson:"-", $vLineRun);
			$vLineRun = str_replace("@05", ($arrS1['ContractDate']!="" || $arrS1['ContractDate']!=NULL)?formatdate($arrS1['ContractDate'], $plang):"-", $vLineRun);
			$vLineRun = str_replace("@11", ($arrS1['State']!="" || $arrS1['State']!=NULL)?((int)$arrS1['State']==0)?$vLangArr[39]:(((int)$arrS1['State']==1)?$vLangArr[41]:$vLangArr[40]):"-", $vLineRun);
			$vLineRun = str_replace("@06", ($arrS1['SalesTaxRate']!="" || $arrS1['SalesTaxRate']!=NULL)?$arrS1['SalesTaxRate']." %":"-", $vLineRun);
			$vLineRun = str_replace("@08", ($arrS1['ShippingDate']!="" || $arrS1['ShippingDate']!=NULL)?formatdate($arrS1['ShippingDate'], $plang):"-", $vLineRun);
			$vLineRun = str_replace("@09", ($arrS1['ShipPercent']!="" || $arrS1['ShipPercent']!=NULL)?$arrS1['ShipPercent']." %":"-", $vLineRun);
			if($plang=="VN")
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingMethod']!="" || $arrS1['ShippingMethod']!=NULL)?$arrS1['ShippingMethod']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentMethod']!="" || $arrS1['PaymentMethod']!=NULL)?$arrS1['PaymentMethod']:"-", $vLineRun);
			
			}
			else
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingDescription']!="" || $arrS1['ShippingDescription']!=NULL)?$arrS1['ShippingDescription']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentDescription']!="" || $arrS1['PaymentDescription']!=NULL)?$arrS1['PaymentDescription']:"-", $vLineRun);
			
			}			

			$vTableParent = str_replace("@01", $vLineRun, $vTableParent);
/////Child Table/////////////////////////////////////////////////////////////////////////////////////////////
			$vContractID = $arrS1['ContractID'];
			$sqlS2 = "	SELECT A.FabricID,F.LabID,B.FabCategoryID, A.Quantity, A.Discount, A.Price,A.Repeat,A.Tax,A.UnitID,B.Name FabricName, C.Name UnitName, D.Name Currency,E.NameVN ColorName,A.ColorID,E.NameEN ColorDescription,A.PercentColor,A.Weigth,A.Width
						FROM mk_contractdetails A LEFT JOIN mk_fabrics B ON A.FabricID=B.ID
							LEFT JOIN mk_units C ON A.UnitID=C.ID
							LEFT JOIN mk_currency D ON A.UnitPriceID=D.ID LEFT JOIN warehouse_productx06.wh_color E on A.ColorID=E.ID LEFT JOIN mk_cusproducts F ON A.FabricID=F.FabricID AND F.CustomerID='$pCustomerID'
						WHERE A.ContractID='$vContractID' ORDER BY A.FabricID,A.Price DESC,A.Quantity DESC;";
			$bResultS2 = db_query($sqlS2);
			$totalRows2 = db_num_rows($bResultS2);

			$vTableChild = "";
			$vTotal = 0;
			$vTaxRate = $arrS1['SalesTaxRate'];///Sale Tax Rate
			$vShipPercent = $arrS1['ShipPercent'];///Shipping Percent
			$vTotalWithTax = 0;
			$vTotalWithDiscount = 0;
			$vLastResult = 0;//Last result of total contracts
			$vLineRunAll2 = "";

			$vTableChild = $vHContractDetail;
			//Fabric ID
			$vTableChild = str_replace("@02", $vLangArr[19], $vTableChild);
			//Fabric Name
			$vTableChild = str_replace("@03", $vLangArr[20], $vTableChild);
			//Color
			$vTableChild = str_replace("@04", $vLangArr[42], $vTableChild);			
			//Quantity
			$vTableChild = str_replace("@05", $vLangArr[21], $vTableChild);
			//Unit Price
			$vTableChild = str_replace("@06", $vLangArr[22], $vTableChild);
			//Percent Color
			$vTableChild = str_replace("@07", $vLangArr[49], $vTableChild);
			//Discount
			$vTableChild = str_replace("@08", $vLangArr[50], $vTableChild);
			//Extended Price
			$vTableChild = str_replace("@09", $vLangArr[24], $vTableChild);
			//Repeate
			$vTableChild = str_replace("@10", $vLangArr[55], $vTableChild);			
			//Repeate
			$vTableChild = str_replace("@12", $vLangArr[57], $vTableChild);			
			
			//Tax rate
			if($vTaxRate==0)
			{
			$vTableChild = str_replace("@11","<td class=\"htable\" width=\"5%\" align=\"center\">$vLangArr[56]</td>", $vTableChild);			
			}			
			else
			$vTableChild = str_replace("@11","", $vTableChild);			
			
			//Extended Price
			$vTableChild = str_replace("@09", $vLangArr[24], $vTableChild);			
			$vtFabricID="TR111111111111";
			$vNumline=0;
			if($totalRows2>0){
				while($arrS2=db_fetch_array($bResultS2)){
				
					if($vtFabricID != $arrS2['FabricID']){
						$vOrder++;
						$vtFabricID = $arrS2['FabricID'];
						if(strpos($vtFabricID,"LTGC")===false)
						{
							if(strpos($vtFabricID,$pCustomerID."_")===false)
								$vtTempID=$vtFabricID;							
							else
							{
								
								$vtTempID=substr($vtFabricID,10,strlen($vtFabricID)-10);
							}						
						}
						else
						{
							if($arrS2['LabID']!=NULL && $arrS2['LabID']!="")
							$vtTempID=$arrS2['LabID'];
							else
							$vtTempID=$vtFabricID;
							
						}

						$vFabricName = ($arrS2['FabricName']!="" || $arrS2['FabricName']!=NULL)?$arrS2['FabricName']:"-";
						$vLineRun2 = $vRContractDetail;
						$vLineRun2 = str_replace("@02",$vtTempID, $vLineRun2);
						$vLineRun2 = str_replace("@03", $vFabricName, $vLineRun2);
						$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);
						$vNumline = 0;
						$vCurrencyName=$arrS2['Currency'];
					}								
					$vNumline++;
					switch($pOpt)
					{
						case 1:
							$strQuantity=$this->GetQuantityOutputColor($vContractID,$arrS2['FabricID'],$arrS2['ColorID'],$arrS2['UnitID'],$vOutStockID);
							break;
						case 2:
							$strQuantity=$this->GetQuantityOutputWidth($vContractID,$arrS2['FabricID'],$arrS2['Width'],$arrS2['UnitID'],$vOutStockID);						
							break;
						default:
							$strQuantity=$this->GetQuantityOutput($vContractID,$arrS2['FabricID'],$arrS2['ColorID'],$arrS2['Width'],$arrS2['UnitID'],$vOutStockID);						
							break;
					}
					
					$strQuantity=($strQuantity!="" || $strQuantity!=NULL)?$strQuantity.$arrS2['UnitName']:"0".$arrS2['UnitName'];
					$vLineRun2 = str_replace("@04", ($arrS2['ColorID']!="" || $arrS2['ColorID']!=NULL)?$arrS2['ColorID']."":"-", $vLineRun2);					
					$vLineRun2 = str_replace("@05",$strQuantity , $vLineRun2);
					if ($vCurrencyName=="$" || $vCurrencyName=="USD")
					{
					$vLineRun2 = str_replace("@06", ($arrS2['Price']!="" || $arrS2['Price']!=NULL)?$vCurrencyName.LCurrency($arrS2['Price'],2)."":"-", $vLineRun2);
					}
					else
					{
					$vLineRun2 = str_replace("@06", ($arrS2['Price']!="" || $arrS2['Price']!=NULL)?LCurrency($arrS2['Price'],2)."$vCurrencyName":"-", $vLineRun2);
					}
					

					$vLineRun2 = str_replace("@07", ($arrS2['Weigth']!="" || $arrS2['Weigth']!=NULL)?$arrS2['Weigth']."":"-", $vLineRun2);										
					$vLineRun2 = str_replace("@10", ($arrS2['Repeat']!="" || $arrS2['Repeat']!=NULL)?$arrS2['Repeat']."":"-", $vLineRun2);										
					
					$vLineRun2 = str_replace("@08", ($arrS2['Width']!="" || $arrS2['Width']!=NULL)?$arrS2['Width']."":"-", $vLineRun2);
					$vTaxDetail=($arrS2['Tax']!="" || $arrS2['Tax']!=NULL)?$arrS2['Tax']:0;
					if($vTaxRate==0)
					{
					$vLineRun2 = str_replace("@11", "<td class=\"right_style\">".$vTaxDetail."%</td>", $vLineRun2);
					}
					else
					{
					$vLineRun2 = str_replace("@11", "", $vLineRun2);
					$vTaxDetail=0;
					}
					if($plang=="VN")
					$vLineRun2 = str_replace("@12", ($arrS2['ColorName']!="" || $arrS2['ColorName']!=NULL)?$arrS2['ColorName']."":"-", $vLineRun2);	
					else			
					$vLineRun2 = str_replace("@12", ($arrS2['ColorDescription']!="" || $arrS2['ColorDescription']!=NULL)?$arrS2['ColorDescription']."":"-", $vLineRun2);
					$vDiscount = $arrS2['Discount'];///Discount
					$vExtendedPrice = $strQuantity*$arrS2['Price'] ;
					$vExtendedPrice=$vExtendedPrice+$vExtendedPrice*$vTaxDetail/100;
					
					$vTotal = $vTotal + $vExtendedPrice;///Total with no tax
					if ($vCurrencyName=="$" || $vCurrencyName=="USD")
					$vLineRun2 = str_replace("@09",($vExtendedPrice !="" || $vExtendedPrice!=NULL)? $vCurrencyName.LCurrency($vExtendedPrice,$plang):$vCurrencyName."0", $vLineRun2);
					else
					$vLineRun2 = str_replace("@09", ($vExtendedPrice !="" || $vExtendedPrice!=NULL)?LCurrency($vExtendedPrice,$plang).$vCurrencyName:"0", $vLineRun2);
					$vLineRunAll2=$vLineRunAll2.$vLineRun2;
					$vLineRun2=$vRContractDetailChild ;
				}
				$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);				
				$vTableChild = str_replace("@01", $vLineRunAll2, $vTableChild);
			} else {
				$vTableChild = str_replace("@01", $vLangArr[27], $vTableChild);
			}

		} else {
			return $vLangArr[26];
		}
		$vCalWithTax=$vTotal*($vTaxRate/100);
		$vTotalWithTax = $vTotal+$vCalWithTax;///Total with tax

		$vTotal = ($vTotal!=0 || $vTotal!=NULL || $vTotal!="")?$vTotal:"0";
		$vTotalWithTax = ($vTotalWithTax!=0 || $vTotalWithTax!=NULL || $vTotalWithTax!="")?$vTotalWithTax:"0";
		$vTableTotalTemp1 ="";
		if($vTaxRate!=0)
		{
		$vTableTotalTemp1 = $vTableProcessingChild;		
		$vTableTotalTemp1 = str_replace("@04", "".$vLangArr[52]."", $vTableTotalTemp1);
		$vTableTotalTemp1 = str_replace("@05", "".$vTaxRate."% ", $vTableTotalTemp1);		
		$vTableTotalTemp1 = str_replace("@06", "".$vLangArr[30]."", $vTableTotalTemp1);
				$vTableTotalTemp1 = str_replace("@08", "<b>".$vLangArr[53]."</b>", $vTableTotalTemp1);		
		if ($vCurrencyName=="$" || $vCurrencyName=="USD")
			{
				$vTableTotalTemp1 = str_replace("@07", "$vCurrencyName".LCurrency($vCalWithTax,$plang), $vTableTotalTemp1);	
				$vTableTotalTemp1 = str_replace("@09", "<b>$vCurrencyName".LCurrency($vTotalWithTax,$plang)."</b>", $vTableTotalTemp1);	
			}
			else
			{
				$vTableTotalTemp1 = str_replace("@07", "".LCurrency($vCalWithTax,$plang)." ".$vCurrencyName."", $vTableTotalTemp1);	
				$vTableTotalTemp1 = str_replace("@09", "<b>".LCurrency($vTotalWithTax,$plang)." ".$vCurrencyName."</b>", $vTableTotalTemp1);	
			}
		
		}

		/////Table Processing Sum of contracts
		$vTableTotalTemp =str_replace("@80",$vTableTotalTemp1,$vTableProcessing);
		$vTableTotalTemp = str_replace("@02", "".$vLangArr[28]."", $vTableTotalTemp);
		if ($vCurrencyName=="$" || $vCurrencyName=="USD")
			$vTableTotalTemp = str_replace("@03", "$vCurrencyName".LCurrency($vTotal,$plang), $vTableTotalTemp);
		else
			$vTableTotalTemp = str_replace("@03", "".LCurrency($vTotal,$plang)." ".$vCurrencyName."", $vTableTotalTemp);		
		$vTableTotalTemp = str_replace("@96", "#FFFFFF", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@97", "#000000", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@98", "#BCF0F5", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@99", "#000000", $vTableTotalTemp);

		$strExpportAll = $this->vTableGeneral;
		$strExpportAll = str_replace("@02", $vTableParent, $strExpportAll);
		$strExpportAll = str_replace("@03", $vTableChild, $strExpportAll);
		$strExpportAll = str_replace("@04", $vTableTotalTemp, $strExpportAll);
		return $strExpportAll;
	}
}
?>