<?php
class hr_menusl0001
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function hr_menusl0001()
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
					$strReturn=$this->Dir."hr_lv0042/hr_lv0042.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0042/hr_lv0042.php";
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
					$strReturn=$this->Dir."hr_lv0042/hr_lv0042.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0042/hr_lv0042.php";
					break;
				}
				break;

		}
		return $strReturn;
	}
}
?>