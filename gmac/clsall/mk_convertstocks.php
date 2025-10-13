<?php
class mk_convertstocks
{
//declare variant
var $ID=null;

var $isExist=null;

	function mk_convertstocks()
	{
	
	}
	//Load Date
	function ConvertStock($strarr)
	{
		$vsql="select ID,Name,CategoryID,UnitID from warehouse_productx06.wh_stocks where ID in ($strarr)";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($this->Exist($vrow['ID'])>0)
			{
				$vsqlinsert="update crmx06.mk_fabrics set Name='".$vrow['Name']."',FabCategoryID='".$vrow['CategoryID']."' where ID='".$vrow['ID']."'";
				db_query($vsqlinsert);
			}
			else
			{
				$vDateCreate=GetServerDate();
				$vsqlinsert="insert into crmx06.mk_fabrics(ID,Name,FabCategoryID,UnitID,State,CreateDate,Description) select ID,Name,CategoryID,UnitID,'0','$vDateCreate',Name from warehouse_productx06.wh_stocks where ID='".$vrow['ID']."'";
				db_query($vsqlinsert);
			}
		}
		return true;
	}
	//Load Date
	function Exist($vID)
	{
		$vsql="select ID from crmx06.mk_fabrics where ID='$vID'";		
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return  $this->isExist;
	}	
}
?>