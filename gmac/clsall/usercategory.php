<?php
class usercategory{
	//Declare variant
	var $ID=null;
	var $Descs=null;

	//Variant control
	var $isExist=null;

	function usercategory(){
		$this->isExist=-1;
	}

	function Load($vID){
		$vsql="SELECT * FROM usercategory WHERE ID='$vID' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->ID=$vrow['ID'];
			$this->Descs=$vrow['Descs'];
		} else {
			$this->ID=null;
			$this->Descs=null;
		}
	}

	function Insert(){
		$vsql="INSERT INTO usercategory(ID, Descs) VALUES ('$this->ID', '$this->Descs') ;";
		return db_query($vsql);
	}

	function Update(){
		$vsql="UPDATE usercategory SET usercategory.Descs='$this->Descs' WHERE ID='$this->ID' ;";
		return db_query($vsql);		
	}

	function Delete($strar){
		$sqlD = "DELETE FROM usercategory WHERE ID IN (".$strar.") AND (SELECT COUNT(*) FROM user rcd where rcd.UserRight=usercategory.ID)<=0;";
		return db_query($sqlD);
	}

//Kiem tra ton tai
	function Exist($vID){
		$vsql="SELECT ID FROM usercategory WHERE ID='".$vID."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
}
?>