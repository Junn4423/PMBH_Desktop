<?php
class lv_menusl0017
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function lv_menusl0017()
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
					$strReturn=$this->Dir."mn_lv0004/mn_lv0004.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."mn_lv0004/mn_lv0004.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0027/sl_lv0027.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0017/sl_lv0017.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."mn_lv0005/mn_lv0005.php";
					break;
				}
				break;
			case 10:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."mn_lv0010/mn_lv0010.php";
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
					$strReturn=$this->Dir."mn_lv0004/mn_lv0004.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."mn_lv0004/mn_lv0004.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0027/sl_lv0027.php";
					break;
				}
				break;		
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0017/sl_lv0017.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."mn_lv0005/mn_lv0005.php";
					break;
				}
				break;
			case 10:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."mn_lv0010/mn_lv0010.php";
					break;
				}
				break;
				
		}
		return $strReturn;
	}
}
?>