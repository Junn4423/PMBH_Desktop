<?php
class lv_menusl0044
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function lv_menusl0044()
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
					$strReturn=$this->Dir."hr_lv0045/hr_lv0045.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0045/hr_lv0045.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0046/hr_lv0046.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0047/hr_lv0047.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0045/inputlist.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0048/hr_lv0048.php";
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
					$strReturn=$this->Dir."hr_lv0045/hr_lv0045.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0045/hr_lv0045.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0046/hr_lv0046.php";
					break;
				}
				break;	
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0047/hr_lv0047.php";
					break;
				}
				break;		
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0045/inputlist.php";
					break;
				}
				break;	
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."hr_lv0048/hr_lv0048.php";
					break;
				}
				break;
				
		}
		return $strReturn;
	}
}
?>