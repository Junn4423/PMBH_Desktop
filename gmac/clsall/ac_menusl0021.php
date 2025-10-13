<?php
class ac_menusl0021
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function ac_menusl0021()
	{
		$this->itemlst=0;
		$this->childlst=0;
		$this->level3lst=0;
		$this->child3lst=0;
		$this->lang="EN";
		$this->Dir="";
	}
		function GetLink()
	{
		$strReturn="permit.php";
		switch ($this->level3lst)
		{
			case 0:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0082/ac_lv0082.php";
					break;
				}	
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0082/ac_lv0082.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0031/ac_lv0031.php";
					break;
				}
				break;

		}
		return $strReturn;
	}
	function GetLinkEmp()
	{
		$strReturn="permit.php";
		switch ($this->level3lst)
		{
			case 0:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0082/ac_lv0082.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0082/ac_lv0082.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."ac_lv0031/ac_lv0031.php";
					break;
				}
				break;
					
				
		}
		return $strReturn;
	}
}
?>