<?php
class lv_lv0007{

	var $lv001=null;
	var $lv002=null;
	var $lv003=null;
	var $lv004=null;
	var $lv005=null;
	var $lv006=null;

	//Variant control
	var $isExist=null;

	function lv_lv0007(){
		$this->isExist=-1;
	}

	function Load($vlv001){
		$vsql="SELECT * FROM lv_lv0007 WHERE lv001='$vlv001' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
		} else {
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
		}
	}

	function Insert(){
		$vsql="INSERT INTO lv_lv0007(lv001, lv002, lv003, lv004, lv005, lv006) VALUES ('$this->lv001', '$this->lv002', '$this->lv003', '$this->lv004', '".md5($this->lv005)."', '$this->lv006') ;";
		return db_query($vsql);
	}

	function Update(){
		$vsql="UPDATE lv_lv0007 SET lv002='$this->lv002', lv003='$this->lv003', lv004='$this->lv004', lv006='$this->lv006' WHERE lv001='$this->lv001' ;";
		return db_query($vsql);		
	}

	function Delete($strar){
		$sqlD = "DELETE FROM lv_lv0007 WHERE lv_lv0007.lv001 IN (".$strar.") and (select count(*) from rightdetail B where B.lv_lv0007lv001=lv_lv0007.lv001)<=0;";
		return db_query($sqlD);
	}

//Kiem tra ton tai
	function Exist($vlv001){
		$vsql="SELECT lv001 FROM lv_lv0007 WHERE lv001='".$vlv001."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
	function Getlv004($lv001)
	{
		$vsql="select  lv004 from lv_lv0007 where lv001='$lv001'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow)
		{
			return $trow['lv004'];
		}
		return "";
	}
	function GetEmployee($plang,$lv001,$vState)
	{
		$vsql="select  A.lv004,A.lv006,B.lv002 FirstName,B.lv003 MiddleName,B.lv004 LastName from lv_lv0007 A left join hr_lv0020 B on A.lv006=B.lv001 where A.lv001='$lv001'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow)
		{
			if($trow['lv006']==NULL || $trow['lv006']=="")
			{
				return $trow['lv004'].(($vState==1)?"":(" (".$lv001.")"));
			}
			else
			{
				if(strtoupper($plang)=="EN")
				{
					return $trow['MiddleName']." ".$trow['FirstName']." ".$trow['LastName'].(($vState==1)?"":(" (".$trow['lv006'].")"));
				}
				else
				{
					return $trow['LastName'].$trow['MiddleName']." ".$trow['FirstName']." ".(($vState==1)?"":(" (".$trow['lv006'].")"));				
				}
				
			}

		}
		return "";
	}
}
?>