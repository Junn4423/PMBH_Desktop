<?php
class usergroup{
	//Declare variant
	var $ID=null;
	var $UsergroupName=null;

	//Variant control
	var $isExist=null;

	function usergroup(){
		$this->isExist=-1;
	}

	function Load($vID){
		$vsql="SELECT * FROM usergroup WHERE ID='$vID' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->ID=$vrow['ID'];
			$this->UsergroupName=$vrow['UsergroupName'];
		} else {
			$this->ID=null;
			$this->UsergroupName=null;
		}
	}

	function Insert(){
		$vsql="INSERT INTO usergroup(ID, UsergroupName) VALUES ('$this->ID', '$this->UsergroupName') ;";
		return db_query($vsql);
	}

	function Update(){
		$vsql="UPDATE usergroup SET usergroup.UsergroupName='$this->UsergroupName' WHERE ID='$this->ID' ;";
		return db_query($vsql);		
	}

	function Delete($strar){
		$sqlD = "DELETE FROM usergroup WHERE ID IN (".$strar.") and (select count(*) from employees B where B.UserGroupID=usergroup.ID)<=0;";
		return db_query($sqlD);
	}

//Kiem tra ton tai
	function Exist($vID){
		$vsql="SELECT ID FROM usergroup WHERE ID='".$vID."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
}
?>