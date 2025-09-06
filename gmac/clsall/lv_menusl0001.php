<?php
class lv_menusl0001
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function lv_menusl0001()
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
					$strReturn=$this->Dir."sl_lv0013/sl_lv0013.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0013/sl_lv0013.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0010/sl_lv0010.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0004/sl_lv0004.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0003/sl_lv0003.php";									
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0002/sl_lv0002.php";					
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
					$strReturn=$this->Dir."sl_lv0013/sl_lv0013.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0013/sl_lv0013.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0010/sl_lv0010.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0004/sl_lv0004.php";					
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0003/sl_lv0003.php";									
					break;
				}
				break;				
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0002/sl_lv0002.php";					
					break;
				}
				break;				
			case 14:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0115/sl_lv0115.php";									
					break;
				}
				break;				
				
		}
		return $strReturn;
	}
}
?>