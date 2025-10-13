<?php
class mk_cusproducts
{
var $ID=null;
var $CustomerID=null;
var $LabID=null;
var $Name=null;
var $Period=null;
var $DocPicture=null;
var $CreateDate=null;
var $FabricID=null;
//Biến điều khiển
var $isExist=null;
	function mk_cusproducts()
	{
		$this->isExistFabricID=-1;
		$this->isExist=-1;
	}
	function Load($vID)
	{
		$vsql="select * from crmx06.mk_cusproducts where ID='$vID'";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->ID=$vrow['ID'];
			$this->CustomerID=$vrow['CustomerID'];			
			$this->LabID=$vrow['LabID'];
			$this->Name=$vrow['Name'];
			$this->DocPicture=$vrow['DocPicture'];
			$this->CreateDate=$vrow['CreateDate'];		
			$this->Period=$vrow['Period'];
			$this->FabricID=$vrow['FabricID'];
		}
		else
		{
			$this->ID=null;
			$this->CustomerID=null;			
			$this->LabID=null;
			$this->Name=null;
			$this->DocPicture=null;
			$this->CreateDate=null;			
			$this->Period=null;				
			$this->FabricID=null;								
															
		}
	}
	function LoadPublic($vID)
	{
		$vsql="select ID,CustomerID,LabID,Name,CreateDate,FabricID from crmx06.mk_cusproducts where ID='$vID'";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->ID=$vrow['ID'];
			$this->CustomerID=$vrow['CustomerID'];			
			$this->LabID=$vrow['LabID'];
			$this->Name=$vrow['Name'];
			$this->CreateDate=$vrow['CreateDate'];			
			$this->FabricID=$vrow['FabricID'];		
		}
		else
		{
			$this->ID=null;
			$this->CustomerID=null;			
			$this->LabID=null;
			$this->Name=null;
			$this->CreateDate=null;		
			$this->FabricID=null;													
		}
	}

	//Thêm dữ liệu 
	function Insert()
	{
		$vsql="insert into crmx06.mk_cusproducts(CustomerID,LabID,Name,DocPicture,Period,CreateDate,FabricID) values('$this->CustomerID','$this->LabID','$this->Name','$this->DocPicture','$this->Period','$this->CreateDate','$this->FabricID')";
		return db_query($vsql);
		
	}	
	function update()
	{
		$vsql="update crmx06.mk_cusproducts set CustomerID='$this->CustomerID',LabID='$this->LabID',Name='$this->Name',DocPicture='$this->DocPicture',Period='$this->Period',FabricID='$this->FabricID' where ID='$this->ID'";
		return db_query($vsql);
	}
	//Hàm kiểm tra vải mẫu có tồn tại không
	function Exist($vCustomerID,$vLabID)
	{
		$vsql="select ID from crmx06.mk_cusproducts where LabID='".$vLabID."' and CustomerID='".$vCustomerID."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}


}
?>