<?php
class mk_reportcusrequirement{
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

	function mk_reportcusrequirement(){
		//
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function ReportContractPrint($plang, $vLangArr, $pCustomerID, $pCusRequirementID){
		$mouser=new user();///New user object for get Employee Name

		$vHContract="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"5%\" align=\"center\" height=\"20px\">@02</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\">@03</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"*\" align=\"center\">@04</td>
					<td onClick=\"this.innerHTML='-'\" class=\"htable\" width=\"15%\" align=\"center\">@06</td>					
					<td onClick=\"this.innerHTML='-'\" class=\"htable\" width=\"5%\" align=\"center\">@08</td>					
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"8%\" align=\"center\">@05</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"8%\" align=\"center\">@11</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"15%\" align=\"center\">@07</td>
					<!--<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"15%\" align=\"center\">@09</td>-->
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\">@10</td>	
				</tr>
				@01
			</table>";
		$vHComp="<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"*%\" align=\"center\">@13</td>";
		$vHContractDetail="
			<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
				<tr height=\"25px\">
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\" height=\"20px\">@02</td>
					<td onClick=\"this.innerHTML='PO No'\"  style=\"cursor:move\" class=\"htable\" width=\"*\" align=\"center\">@03</td>
					@13																
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"6%\" align=\"center\">@04</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\">@11</td>																
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"6%\" align=\"center\">@08</td>	
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"6%\" align=\"center\">@07</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"6%\" align=\"center\">@12</td>					
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\">@05</td>
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\">@06@80</td>
					@10
					<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"htable\" width=\"10%\" align=\"center\">@09@81</td>					
				</tr>
				@01
			</table>";

		$vRContract="
			<tr>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"center_style\" height=\"20px\">@02 &nbsp;</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"center_style\">@03 </td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"left_style\">@04 </td>
				<td onClick=\"this.innerHTML='-'\" class=\"center_style\">@06 </td>				
				<td onClick=\"this.innerHTML='-'\" class=\"center_style\">@08 </td>				
				<td class=\"center_style\" onClick=\"this.innerHTML='-'\" style=\"cursor:move\">@05 </td>
				<td  class=\"left_style\" onClick=\"this.innerHTML='-'\" style=\"cursor:move\"> @11 </td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"left_style\">@07 </td>
			<!--	<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@09 </td>-->
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"left_style\">@10 </td>
			</tr>";
		$vRComp="<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" rowspan=\"@01\" class=\"left_style\" class=\"left_style\">@13</td>";
		$vRContractDetail="
			<tr>
				<td rowspan=\"@01\" class=\"center_style\" align=\"center\" height=\"20px\" onClick=\"this.innerHTML='-'\" style=\"cursor:move\">@02</td>
				<td rowspan=\"@01\" class=\"left_style\" align=\"left\">@03</td>
				@13					
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@04</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@11</td>									
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@08</td>																
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@07</td>				
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@12</td>													
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@05</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@06</td>
				@10	
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@09</td>				
			</tr>";
		$vRContractDetailChild="
			<tr>	
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@04</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@11</td>														
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@08</td>							
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@07</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@12</td>									
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@05</td>
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@06</td>
				@10	
				<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"right_style\">@09</td>				
			</tr>";			

		$vTableProcessing="
			<tr>
				<td class=\"tdprint\">
					<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						<tr>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@02</td>
							<td onClick=\"this.innerHTML='-'\" style=\"cursor:move\" class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@03</td>
						</tr>		
						@80										
					</table>
				</td>
			</tr>
			";
		$vTableProcessingChild="
						<tr onClick=\"this.innerHTML='-'\" style=\"cursor:move\">
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@04</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@05</td>
						</tr>						
						<tr onClick=\"this.innerHTML='-'\" style=\"cursor:move\">
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\">@06</td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\">@07</td>
						</tr>
						<tr onClick=\"this.innerHTML='-'\" style=\"cursor:move\">
							<td class=\"tblcontent\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@96\"><font color=\"@97\">@08</font></td>
							<td class=\"tblcontent\" width=\"15%\" align=\"right\" style=\"padding-right:5px\" bgcolor=\"@98\"><font color=\"@99\">@09</font></td>
						</tr>						
						";
		 $sqlS1 = "	SELECT A.ID CusRequirementID, A.Title CusRequirementTitle, A.CustomerID, A.EmployeeID, C.Name ShippingMethod,C.Description ShippingDescription, D.Name PaymentMethod,D.Description PaymentDescription, A.DateRequire, A.Composition,A.DateContact,
						A.SalesTaxRate, B.ContactFirstName, B.ContactLastName ,A.TypeContract,A.FSample,A.PersonApproval
					FROM mk_cusrequirement A LEFT JOIN mk_customers B ON A.CustomerID=B.ID 
						LEFT JOIN mk_shippingmethods C ON A.ShippingMethod=C.ID 
						LEFT JOIN mk_paymentmethod D ON A.PaymentMethod=D.ID 
					WHERE A.ID='$pCusRequirementID' ORDER BY NULL;";
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
		$vTableParent = str_replace("@11", $vLangArr[33], $vTableParent);
		//Sales Tax
		$vTableParent = str_replace("@06", $vLangArr[62], $vTableParent);
		//Shipping Method
		$vTableParent = str_replace("@07", $vLangArr[32], $vTableParent);
		//Shipping Date
		$vTableParent = str_replace("@08", $vLangArr[63], $vTableParent);
		//Shipping Percent
		$vTableParent = str_replace("@09", $vLangArr[34], $vTableParent);
		//Payment Method
		$vTableParent = str_replace("@10", $vLangArr[35], $vTableParent);	

		if($totalRows1>0){
			$arrS1 = db_fetch_array ($bResultS1);
			$vLineRun ="";
			$vLineRun = $vRContract;
			$vLineRun = str_replace("@02", ($arrS1['CusRequirementID']!="" || $arrS1['CusRequirementID']!=NULL)?$arrS1['CusRequirementID']:"-", $vLineRun);
			$pCustomerID=$arrS1['CustomerID'];
			$vLineRun = str_replace("@03", ($arrS1['CustomerID']!="" || $arrS1['CustomerID']!=NULL)?$arrS1['CustomerID']:"-", $vLineRun);
			$vSalesperson = $mouser->GetEmployee($plang, $arrS1['EmployeeID'], 1);
			$vLineRun = str_replace("@04", ($vSalesperson!="" || $vSalesperson!=NULL)?$vSalesperson:"-", $vLineRun);
			$vLineRun = str_replace("@11", ($arrS1['DateContact']!="" || $arrS1['DateContact']!=NULL)?formatdate($arrS1['DateContact'], $plang):"-", $vLineRun);
			$vLineRun = str_replace("@05", ($arrS1['DateRequire']!="" || $arrS1['DateRequire']!=NULL)?formatdate($arrS1['DateRequire'], $plang):"-", $vLineRun);			
			//$vLineRun = str_replace("@11", ($arrS1['State']!="" || $arrS1['State']!=NULL)?((int)$arrS1['State']==0)?$vLangArr[39]:(((int)$arrS1['State']==1)?$vLangArr[41]:$vLangArr[40]):"-", $vLineRun);
			$vSaleApproval= $mouser->GetEmployee($plang, $arrS1['PersonApproval'], 1);			
			$vLineRun = str_replace("@06", ($vSaleApproval!="" || $vSaleApproval!=NULL)?$vSaleApproval:"-", $vLineRun);
			if($plang=="VN")
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingMethod']!="" || $arrS1['ShippingMethod']!=NULL)?$arrS1['ShippingMethod']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentMethod']!="" || $arrS1['PaymentMethod']!=NULL)?$arrS1['PaymentMethod']:"-", $vLineRun);
			}else
			{
			$vLineRun = str_replace("@07", ($arrS1['ShippingDescription']!="" || $arrS1['ShippingDescription']!=NULL)?$arrS1['ShippingDescription']:"-", $vLineRun);
			$vLineRun = str_replace("@10", ($arrS1['PaymentDescription']!="" || $arrS1['PaymentDescription']!=NULL)?$arrS1['PaymentDescription']:"-", $vLineRun);
			}
			$vLineRun = str_replace("@08", ($arrS1['FSample']!="" || $arrS1['FSample']!=NULL)?$vLangArr[(65-$arrS1['FSample'])]:"-", $vLineRun);
			$vLineRun = str_replace("@09", ($arrS1['ShipPercent']!="" || $arrS1['ShipPercent']!=NULL)?$arrS1['ShipPercent']." %":"-", $vLineRun);
			
			$FComposition=(int)$arrS1['Composition'];
			$FTDisplayForm=(int)$arrS1['TypeContract'];
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

			$vTableParent = str_replace("@01", $vLineRun, $vTableParent);
/////Child Table/////////////////////////////////////////////////////////////////////////////////////////////
			$vCusRequirementID = $arrS1['CusRequirementID'];
			$sqlS2 = "	SELECT A.CusProductID,F.LabID, A.Quantity, A.Price,A.Tax, B.Name FabricName,B.Description, C.Name UnitName, D.Name Currency,E.NameVN ColorName,E.NameEN ColorDescription,A.ColorID,A.Roll,A.Width,A.Remark,B.DocPicture Composition
						FROM mk_cusrequirementdetail A LEFT JOIN mk_fabrics B ON B.ID=A.CusProductID 
							LEFT JOIN mk_units C ON A.UnitID=C.ID
							LEFT JOIN mk_currency D ON A.UnitPriceID=D.ID LEFT JOIN warehouse_productx06.wh_color E on A.ColorID=E.ID LEFT JOIN mk_cusproducts F ON A.CusProductID=F.FabricID AND F.CustomerID='$pCustomerID'
						WHERE A.RequirementID='$vCusRequirementID' ORDER BY A.CusProductID,A.Price DESC,A.Quantity DESC;";
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
				$vTableChild = str_replace("@03", $vLangArr[61], $vTableChild);
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
			if($vTaxRate==0)//Nếu không tính thuế tổng
			{			//Tax
			$vTableChild = str_replace("@10",str_replace("@10", $vLangArr[55],"<td class=\"htable\" width=\"6%\" align=\"center\">@10</td>"), $vTableChild);
			}
			else
			$vTableChild = str_replace("@10", "", $vTableChild);
			//ColorName
			$vTableChild = str_replace("@11", $vLangArr[56], $vTableChild);
			//Repeat
			$vTableChild = str_replace("@12", $vLangArr[57], $vTableChild);
			//Composition
			$vTableChild = str_replace("@13", $vLangArr[60], $vTableChild);
			
			$vtCusProductID="TR111111111111";
			$vNumline=0;
			if($totalRows2>0){
				while($arrS2=db_fetch_array($bResultS2)){
				
					if($vtCusProductID != $arrS2['CusProductID']){
						$vOrder++;
						$vtCusProductID = $arrS2['CusProductID'];
						if(strpos($vtCusProductID,"LTGC")===false)
						{
							if(strpos($vtCusProductID,$pCustomerID."_")===false)
								$vtTempID=$vtCusProductID;							
							else
							{
								
								$vtTempID=substr($vtCusProductID,10,strlen($vtCusProductID)-10);
							}
						}
						else
						{
							if($arrS2['LabID']!=NULL && $arrS2['LabID']!="")
							$vtTempID=$arrS2['LabID'];
							else
							$vtTempID=$vtCusProductID;
							
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
						
						$vLineRun2 = $vRContractDetail;
						$vLineRun2 = str_replace("@13", ($arrS2['Composition']!="" || $arrS2['Composition']!=NULL)?$arrS2['Composition']."":"-", $vLineRun2);
						
						$vLineRun2 = str_replace("@02",$vtTempID, $vLineRun2);
						$vLineRun2 = str_replace("@03", $vFabricName, $vLineRun2);
						$vLineRunAll2 = str_replace("@01", $vNumline, $vLineRunAll2);
						$vNumline = 0;
						$vCurrencyName=$arrS2['Currency'];
					}								
					$vNumline++;
					$vLineRun2 = str_replace("@04", (strlen(trim($arrS2['ColorID']))>1)?$arrS2['ColorID']."":"-", $vLineRun2);					
					$vLineRun2 = str_replace("@05", ($arrS2['Quantity']!="" || $arrS2['Quantity']!=NULL)?LCurrencys($arrS2['Quantity'],$plang)."(".$arrS2['UnitName'].")":"-", $vLineRun2);

					$vLineRun2 = str_replace("@06", ($arrS2['Price']!="" || $arrS2['Price']!=NULL)?LCurrency($arrS2['Price'],$plang):"-", $vLineRun2);

					$vLineRun2 = str_replace("@07", ($arrS2['Roll']!="" || $arrS2['Roll']!=NULL)?$arrS2['Roll']."":"-", $vLineRun2);										
					$vLineRun2 = str_replace("@08", ($arrS2['Width']!="" || $arrS2['Width']!=NULL)?$arrS2['Width']."":"-", $vLineRun2);
					$vLineRun2 = str_replace("@12", ($arrS2['Remark']!="" || $arrS2['Remark']!=NULL)?$arrS2['Remark']."":"-", $vLineRun2);
					

					if($plang=="VN")
					$vLineRun2 = str_replace("@11", ($arrS2['ColorName']!="" || $arrS2['ColorName']!=NULL)?$arrS2['ColorName']."":"-", $vLineRun2);	
					else			
					$vLineRun2 = str_replace("@11", ($arrS2['ColorDescription']!="" || $arrS2['ColorDescription']!=NULL)?$arrS2['ColorDescription']."":"-", $vLineRun2);						
					$vDiscount = $arrS2['Discount'];///Discount
					$vExtendedPrice = $arrS2['Quantity']*$arrS2['Price']  ;
					if($vTaxRate==0)
					{				
					$vLineRun2 = str_replace("@10",str_replace("@10",($arrS2['Tax']!="" || $arrS2['Tax']!=NULL)?(($arrS2['Tax']==0)?"-":LCurrency($arrS2['Tax'],$plang)."%"):"-","<td class=\"right_style\">@10</td>"), $vLineRun2);	
					$vExtendedPrice=$vExtendedPrice+$vExtendedPrice*$arrS2['Tax']/100;
					}
					else
					$vLineRun2 = str_replace("@10", "", $vLineRun2);					
					$vTotal = $vTotal + $vExtendedPrice;///Total with no tax
					$vLineRun2 = str_replace("@09", ($vExtendedPrice !="" || $vExtendedPrice!=NULL)?LCurrency($vExtendedPrice,$plang):"0", $vLineRun2);

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
		
		$vTableChild = str_replace("@80"," (".$vCurrencyName.")" , $vTableChild);
		$vTableChild = str_replace("@81"," (".$vCurrencyName.")", $vTableChild);	
		
		$vTotal = ($vTotal!=0 || $vTotal!=NULL || $vTotal!="")?$vTotal:"-";
		$vTotalWithTax = ($vTotalWithTax!=0 || $vTotalWithTax!=NULL || $vTotalWithTax!="")?$vTotalWithTax:"-";
		$vTableTotalTemp1 ="";
		if($vTaxRate!=0)
		{
		$vTableTotalTemp1 = $vTableProcessingChild;		
		$vTableTotalTemp1 = str_replace("@04", "".$vLangArr[52]."", $vTableTotalTemp1);
		$vTableTotalTemp1 = str_replace("@05", "".LCurrency($vTaxRate,$plang)."% ", $vTableTotalTemp1);		
		$vTableTotalTemp1 = str_replace("@06", "".$vLangArr[30]."", $vTableTotalTemp1);
		$vTableTotalTemp1 = str_replace("@08", "<b>".$vLangArr[53]."</b>", $vTableTotalTemp1);		


		$vTableTotalTemp1 = str_replace("@07", "".LCurrency($vCalWithTax,$plang)."", $vTableTotalTemp1);	
		$vTableTotalTemp1 = str_replace("@09", "<b>".LCurrency($vTotalWithTax,$plang)."</b>", $vTableTotalTemp1);	
		}
	
		/////Table Processing Sum of contracts
		$vTableTotalTemp =str_replace("@80",$vTableTotalTemp1,$vTableProcessing);
		$vTableTotalTemp = str_replace("@02", "".$vLangArr[28]."", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@03", "".LCurrency($vTotal,$plang)."", $vTableTotalTemp);
		
		$vTableTotalTemp = str_replace("@96", "#FFFFFF", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@97", "#000000", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@98", "#BCF0F5", $vTableTotalTemp);
		$vTableTotalTemp = str_replace("@99", "#000000", $vTableTotalTemp);

		$strExpportAll = $this->vTableGeneral;
		$strExpportAll = str_replace("@02", $vTableParent, $strExpportAll);
		$strExpportAll = str_replace("@03", $vTableChild, $strExpportAll);
		$vTableTotalTemp="";
		$strExpportAll = str_replace("@04", $vTableTotalTemp, $strExpportAll);
		return $strExpportAll;
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>