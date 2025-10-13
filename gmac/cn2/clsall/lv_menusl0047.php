<?php
class lv_menusl0047
{
var $itemlst=null;
var $childlst=null;
var $level3lst=null;
var $child3lst=null;
var $lang=null;
var $Dir=null;
	function lv_menusl0047()
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
					$strReturn=$this->Dir."sl_lv0048/sl_lv0048.php";					
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
					$strReturn=$this->Dir."sl_lv0048/sl_lv0048.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0049/sl_lv0049.php";					
					break;
				}
				break;		
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0050/sl_lv0050.php";
					break;
				}
				break;		
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0055/sl_lv0055.php";
					break;
				}
				break;		
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0056/sl_lv0056.php";
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
					$strReturn=$this->Dir."sl_lv0048/sl_lv0048.php";					
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
					$strReturn=$this->Dir."sl_lv0048/sl_lv0048.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0049/sl_lv0049.php";					
					break;
				}
				break;		
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0050/sl_lv0050.php";
					break;
				}
				break;			
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0055/sl_lv0055.php";
					break;
				}
				break;		
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0056/sl_lv0056.php";
					break;
				}
				break;			
		}
		return $strReturn;
	}
}
?>