<?php
class lv_menusl0113
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function lv_menusl0013()
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
					$strReturn=$this->Dir."sl_lv0114/sl_lv0114.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0114/sl_lv0114.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0115/sl_lv0115.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0120/sl_lv0120.php";
					break;
				}
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0122/sl_lv0122.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0121/sl_lv0121.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0123/sl_lv0123.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0157/sl_lv0157.php";
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0158/sl_lv0158.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0169/sl_lv0169.php";
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
					$strReturn=$this->Dir."sl_lv0114/sl_lv0114.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0114/sl_lv0114.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0115/sl_lv0115.php";
					break;
				}
				break;		
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0120/sl_lv0120.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0122/sl_lv0122.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0121/sl_lv0121.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0123/sl_lv0123.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0157/sl_lv0157.php";
					break;
				}
				break;	
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0158/sl_lv0158.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0169/sl_lv0169.php";
					break;
				}
				break;
		}
		return $strReturn;
	}	
}
?>