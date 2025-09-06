<?php
class lv_menusl0013
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
					$strReturn=$this->Dir."sl_lv0014/sl_lv0014.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0014/sl_lv0014.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0015/sl_lv0015.php";
					break;
				}
				break;
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0020/sl_lv0020.php";
					break;
				}
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0022/sl_lv0022.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0021/sl_lv0021.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0023/sl_lv0023.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0057/sl_lv0057.php";
					break;
				}
				break;
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0058/sl_lv0058.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0069/sl_lv0069.php";
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
					$strReturn=$this->Dir."sl_lv0014/sl_lv0014.php";
					break;
				}
				break;
			case 1:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0014/sl_lv0014.php";
					break;
				}
				break;
			case 2:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0015/sl_lv0015.php";
					break;
				}
				break;		
			case 3:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0020/sl_lv0020.php";
					break;
				}
				break;
			case 4:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0022/sl_lv0022.php";
					break;
				}
				break;
			case 5:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0021/sl_lv0021.php";
					break;
				}
				break;
			case 6:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0023/sl_lv0023.php";
					break;
				}
				break;
			case 7:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0057/sl_lv0057.php";
					break;
				}
				break;	
			case 8:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0058/sl_lv0058.php";
					break;
				}
				break;
			case 9:
				switch($this->child3lst)
				{
				case 0:
					$strReturn=$this->Dir."sl_lv0069/sl_lv0069.php";
					break;
				}
				break;
		}
		return $strReturn;
	}	
}
?>