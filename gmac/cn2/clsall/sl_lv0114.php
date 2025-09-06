<?php
/////////////coding sl_lv0014///////////////
class   sl_lv0114 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;
	public $lv008=null;
	public $lv009=null;
	public $lv010=null;
	public $lv011=null;
	public $lv012=null;
	public $lv013=null;
	public $lv014=null;
	public $lv015=null;
	public $lv016=null;

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	public $lvgetdata=null;	
	protected $objhelp='sl_lv0014';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"10","lv005"=>"0","lv006"=>"10","lv007"=>"0","lv008"=>"10","lv009"=>"0","lv010"=>"0","lv011"=>"10","lv012"=>"10","lv013"=>"2","lv014"=>"2","lv015"=>"0","lv016"=>"0","lv017"=>"10","lv018"=>"10","lv019"=>"10","lv020"=>"0","lv021"=>"0","lv022"=>"0","lv023"=>"0","lv024"=>"10");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=0;		
	 	$this->isFil=1;	
	
		$this->lang=$_GET['lang'];
		$this->lvgetdata=0;
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv011 from sl_lv0013 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv011']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  sl_lv0014";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  sl_lv0014 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];	
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
		}
	}
	function LV_GetItemAdward($vContracID,$vProgId,$vItemID)
	{
		//lay danh sach san pham co khuyen mai 1 tang 1
		$vsql="select BB.lv003,CC.lv007 Price,(select DD.lv007 from  all_gmacv3_0.sl_lv0007 DD where DD.lv001='$vItemID') PriceF from sl_lv0060 BB left join  all_gmacv3_0.sl_lv0007 CC on BB.lv003=CC.lv001 where BB.lv002='$vProgId' and BB.lv007=1";
		$vReturn= db_query($vsql);
		while($vrow=db_fetch_array($vReturn))
		{
			//Check lay so luong san pham trong don hang
			if($vrow['PriceF']>=$vrow['Price'])
			{
			$vItemProID=$vrow['lv003'];
			$lvsql="select (select sum(lv004) sum from  sl_lv0014 Where lv002='$vContracID' and lv003='$vItemProID' and (lv016='' or ISNULL(lv016))) slco,(select sum(lv004) sum from  sl_lv0014 Where lv002='$vContracID' and lv016='$vItemProID') sldung";
			$vresult=db_query($lvsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['slco']>0)
				{
					if($vrow['slco']>$vrow['sldung']) return $vItemProID;
					
				}
			}
			}
		}
		return '';
	}
	function LV_CheckPriceItem($vContractID,$vItem,$vProgId,&$vPercent,&$vPrice,&$vPoint=0,&$vBuy11)
	{
		$vPercent=0;
		$vPrice=0;
		$vBuy11=0;
		$lvsql="select A.lv001,A.lv004,A.lv005,A.lv006,A.lv007 from sl_lv0060 A inner join sl_lv0059 B on B.lv001=A.lv002 where A.lv003='$vItem' and B.lv001='$vProgId' and B.lv008=1";
		$vReturn= db_query($lvsql);
		$vrow=db_fetch_array($vReturn);
		if($vrow)
		{
			$vPercent=$vrow['lv004'];
			$vPrice=$vrow['lv005'];
			$vPoint=$vrow['lv006'];
			$vBuy11=$vrow['lv007'];
		}
		if($vPercent==0)
		{
			$vItemRefID=$this->LV_GetItemAdward($vContractID,$vProgId,$vItem);
			if($vItemRefID!='')
			{
				$vPercent=100;
				return $vItemRefID;
			}
		}
		return '';
	}
	function LV_CheckExitItemBuy11($vContracID,$vprogid,$vItemID)
	{
		//Xác định số sản phẩm tặng và tổng số lượng
		$lvsql="select A.lv001,A.lv004,A.lv005,A.lv006,A.lv007 from sl_lv0060 A inner join sl_lv0059 B on B.lv001=A.lv002 where A.lv003='$vItem' and B.lv001='$vProgId' and B.lv008=1 and A.lv007=1";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
				$vPercent=$vrow['lv004'];
				$vPrice=$vrow['lv005'];
				$vPoint=$vrow['lv006'];
				$vBuy11=$vrow['lv007'];
			
		}
		$lvsql="select sum(lv004) sum from  sl_lv0014 Where lv002='$vContracID' and lv016='$vItemID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCountFinish=$vrow['sum'];
		}
		return '';
	}
	function LV_CheckExitItem($vContracID,$vItemID)
	{
		$lvsql="select lv001 from  sl_lv0014 Where lv002='$vContracID' and lv003='$vItemID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$this->lv013 = ($this->lv013!="")?recoverdate(($this->lv013), $this->lang):$this->DateDefault;
		$this->lv014 = ($this->lv014!="")?recoverdate(($this->lv014), $this->lang):$this->DateDefault;
		$lvsql="insert into sl_lv0014 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0014.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
		function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update sl_lv0014 set lv015=lv015+1,lv014=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0014.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update sl_lv0014 set lv015=lv015-1,lv014=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0014.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	
	function LV_InsertNoDate()
	{
		
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$lvsql="insert into sl_lv0014 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0014.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_InsertTemp($vTemID,$vlv002,$vWhId)
	{
		$lvsql="select '$vTemID' lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016 from sl_lv0032 where lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			$this->LV_InsertNoDate();
		}
		if($vReturn) $this->LV_DeleteTemp($vlv002);
		return $vReturn;
	}
	function LV_GetTimeInvoice($vContractID)
	{
		$lvsql="select lv001,IF(lv011=0,lv004,lv005) lv004,TIME_TO_SEC(substr(IF(lv011=0,lv004,lv005),12,8)) timeview,TIME_TO_SEC(TIMEDIFF('24:00:00',substr(IF(lv011=0,lv004,lv005),12,8))) timeagain,TIME_TO_SEC('24:00:00') h24,DATEDIFF(CURRENT_DATE(),substr(IF(lv011=0,lv004,lv005),1,12)) days,TIME_TO_SEC(CURRENT_TIME()) curtime,lv011 state,lv002 CMND,lv003 CusName from  sl_lv0013 Where lv001='$vContractID'";
		$vresult=db_query($lvsql);
		return db_fetch_array($vresult);
	}
	function LV_InsertDeleteDefault($vTemID,$vlv002,$vRoomID)
	{
		$lvsql="delete from sl_lv0014 where lv002='$vTemID' and lv003 in (select lv004 from sl_lv0072 A  where A.lv002='$vRoomID' )";
		//$lvsql="delete from sl_lv0014 where lv002='$vTemID' and lv003 in (select lv004 from sl_lv0072 A  where A.lv003<>'$vlv002' and A.lv002='$vRoomID' )";
		$vresult=db_query($lvsql);
		return ;
	}
	function LV_InsertTempDefault($vTemID,$vlv002,$vRoomID)
	{
		$lvsql=" select '$vTemID' lv002,A.lv004 lv003,A.lv005 lv004,B.lv004 lv005,A.lv006 lv006,B.lv008 lv007,B.lv006 congthu,concat(CURRENT_DATE(),' ',CURRENT_TIME()) lv014 from sl_lv0072 A inner join  all_gmacv3_0.sl_lv0007 B on A.lv004=B.lv001 where A.lv003='$vlv002' and A.lv002='$vRoomID'";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv008=$vrow['lv008'];
			$this->lv009=$vrow['lv009'];
			$this->lv010=$vrow['lv010'];
			$this->lv011=$vrow['lv011'];
			$this->lv012=$vrow['lv012'];
			$this->lv013=$vrow['lv013'];
			$this->lv014=$vrow['lv014'];
			$this->lv015=$vrow['lv015'];
			$this->lv016=$vrow['lv016'];
			if($vrow['congthu']!="" && $vrow['congthu']!=NULL)	
			$this->lv004=$this->LV_TimeToCal($vRoomID,$vrow['congthu']);
			$this->LV_InsertNoDate();
		}
		return $vReturn;
	}
	function sec_to_times($seconds) { 
    $hours = floor($seconds / 3600); 
    $minutes = floor($seconds % 3600 / 60); 
    $seconds = $seconds % 60; 

    return sprintf("%d:%02d:%02d", $hours, $minutes, $seconds); 
	}	
	function LV_TimeToCal($vRoomID,$vCongThuc)
	{
		
		$vCongThuc1=$vCongThuc;
		$vTimeArr=$this->LV_GetTimeArray($vRoomID,$vCongThuc);
		for($i=0;$i<count($vTimeArr);$i++)
		{
			$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
		}
		return $this->LV_TimeToCalRun($vCongThuc1);
	}
	function LV_TimeToCalRun($vCongTHuc)
	{
		$vCongTHuc=str_replace(" ","",$vCongTHuc);
		$vCongTHuc1=$vCongTHuc;
		for($i=strlen($vCongTHuc);$i>=0;$i--)
		{
			$vTwo=substr($vCongTHuc,$i,2);
			if(strtoupper($vTwo)=="IF")
			{
				$vEndVT= $this->LV_IF($i,$vCongTHuc);
				$vFunIFRun=$this->LV_IFRUN(substr($vCongTHuc,$i,$vEndVT-$i));
				$vCongTHuc1=str_replace(substr($vCongTHuc,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc1);
				$vCongTHuc=$vCongTHuc1;
			}
			
		}	
		$vCongTHuc2=$vCongTHuc1;
		for($i=0;$i<strlen($vCongTHuc1);$i++)
		{
			$vOne=substr($vCongTHuc1,$i,1);
			if(strtoupper($vOne)=="(")
			{
				$vEndVT= $this->LV_DAYMO($i,$vCongTHuc1);
				
				$vFunIFRun=$this->LV_DAYMORUN(substr($vCongTHuc1,$i,$vEndVT-$i+1));
				$vCongTHuc2=str_replace(substr($vCongTHuc1,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc2);
				$i=$vEndVT;
			}
			
			
		}	
		return $this->LV_CheckOperation($vCongTHuc2);
		
	}
	function LV_DAYMORUN($vStr)
	{
		$vStr=substr($vStr,1,strlen($vStr)-2);
		return $this->LV_CheckOperation($vStr);
		
	}
	function LV_IFRUN($vStr)
	{	
		$vArStr=explode("(",$vStr,2);//l�y IF
		if(strpos($vArStr[1],"IF")===false)
		{
			$vAr1=explode(",",$vArStr[1],3);
			if($this->LV_DieuKien($vAr1[0]))
			{
				return $vAr1[1];
			}
			else
				return $vAr1[2];
		}
		else
		{
			$vAr1=explode(",",$vArStr[1],3);
			if($this->LV_DieuKien($vAr1[0]))
			{
				if(strpos($vAr1[1],"IF")===false)
					return $this->LV_CheckOperation($vAr1[1]);
				else
					{
						$vEndVT=$this->LV_IF(0,$vAr1[1]);
						return $this->LV_IFRUN(substr($vAr1[1],0,$vEndVT));
						
					}
			}
			else
			{
				if(strpos($vAr1[2],"IF")===false)
					return $this->LV_CheckOperation($vAr1[2]);
				else
				{
					$vEndVT=$this->LV_IF(0,$vAr1[2]);
					return $this->LV_IFRUN(substr($vAr1[2],0,$vEndVT));
				}
				
			}
			
		}
		for($v=$vVitri+2;$v<strlen($vStr);$v++)
		{
			$vOne=substr($vStr,$v,1);
			if($vOne=="(") $vtang++;
			if($vOne==")") $vtang--;
			if($vtang==0) return $v;
		}
		return $vVitri;
	}
	function LV_GetTimeArray($vRoomID,$vCongThuc)
	{
		$vReturn=Array();
		$i=0;
		$vArrCT=explode("[",$vCongThuc);
		$strOK="";
		foreach($vArrCT as $vTC)
		{
			$vCTC=explode("]",$vTC);
			
			if(strpos($vCTC[0],",")===false)
			{
			
				if(strpos($strOK,'['.$vCTC[0].']')===false)
				{
					if($vCTC[0]=='h')
						{
							$vReturn[$i]['name']='[h]';
							$vReturn[$i]['value']=(float)substr($this->DateCurrent,11,2);
						}	
					elseif($vCTC[0]=='m')
						{
							$vReturn[$i]['name']='[m]';
							$vReturn[$i]['value']=(float)substr($this->DateCurrent,14,2);
						}	
					elseif($vCTC[0]=='s')
						{
							$vReturn[$i]['name']='[s]';
							$vReturn[$i]['value']=(float)substr($this->DateCurrent,17,2);
						}	
					elseif($vCTC[0]=='sh')
						{
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$vReturn[$i]['name']='[sh]';
							$vReturn[$i]['value']=(float)substr($vCurHD['lv004'],11,2);
						}	
					elseif($vCTC[0]=='sm')
						{
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$vReturn[$i]['name']='[sm]';
							$vReturn[$i]['value']=(float)substr($vCurHD['lv004'],14,2);
						}	
					elseif($vCTC[0]=='ss')
						{
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$vReturn[$i]['name']='[ss]';
							$vReturn[$i]['value']=(float)substr($vCurHD['lv004'],17,2);
						}	
					elseif($vCTC[0]=='sdd')
						{
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$vReturn[$i]['name']='[sdd]';
							$vReturn[$i]['value']=(float)substr($vCurHD['lv004'],8,2);
						}	
					elseif($vCTC[0]=='smm')
						{
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$vReturn[$i]['name']='[smm]';
							$vReturn[$i]['value']=(float)substr($vCurHD['lv004'],5,2);
						}	
					elseif($vCTC[0]=='syy')
						{
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$vReturn[$i]['name']='[syy]';
							$vReturn[$i]['value']=(float)substr($vCurHD['lv004'],0,4);
						}	
					elseif($vCTC[0]=='dd')
						{
							$vReturn[$i]['name']='[dd]';
							$vReturn[$i]['value']=(float)substr($this->DateCurrent,8,2);
						}	
					elseif($vCTC[0]=='mm')
						{
							$vReturn[$i]['name']='[mm]';
							$vReturn[$i]['value']=(float)substr($this->DateCurrent,5,2);
						}	
					elseif($vCTC[0]=='yy')
						{
							$vReturn[$i]['name']='[yy]';
							$vReturn[$i]['value']=(float)substr($this->DateCurrent,0,4);
						}	
					elseif($vCTC[0]=='huse')
						{
							$vReturn[$i]['name']='[huse]';
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$timeview=$vCurHD['timeview'];
							$curtime=$vCurHD['curtime'];
							$timeagain=$vCurHD['timeagain'];
							$days=$vCurHD['days'];
							$h24=$vCurHD['h24'];
							$vsate=(int)$vCurHD['state'];
							if($days>0)
								$limittime=$timeagain+($days-1)*$h24+$curtime;
							else
								$limittime=$curtime-$timeview;
							$hours = floor($limittime / 3600); 
							
							$vReturn[$i]['value']=(float)$hours;
						}	
					elseif($vCTC[0]=='muse')
						{
							$vReturn[$i]['name']='[muse]';
							$vCurHD=$this->LV_GetTimeInvoice($this->lv002);
							$timeview=$vCurHD['timeview'];
							$curtime=$vCurHD['curtime'];
							$timeagain=$vCurHD['timeagain'];
							$days=$vCurHD['days'];
							$h24=$vCurHD['h24'];
							$vsate=(int)$vCurHD['state'];
							if($days>0)
								$limittime=$timeagain+($days-1)*$h24+$curtime;
							else
								$limittime=$curtime-$timeview;
							$minutes = floor($limittime % 3600 / 60); 
							$vReturn[$i]['value']=(float)$minutes;
						}	
					else
						{
							$vReturn[$i]['name']='['.$vCTC[0].']';
							$vReturn[$i]['value']=(int)$vArrEmp["$vEmployee"][0][$vCTC[0]];
						}
						$strOK=$strOK.",[".$vCTC[0]."]";
						$i++;
				}
			}
			else
			{
				$vDivTC=explode(",",$vCTC[0]);
				if(strpos($strOK,'['.$vCTC[0].']')===false)
				{
				switch($vDivTC[1])
				{
					case "QTY":
						$vsql="select (lv005) sumqty from sl_lv0072 where lv002='$vRoomID' and lv004='".$vDivTC[0]."'";
						break;
					case "PRICE":
						$vsql="select (lv006) sumqty from sl_lv0072 where lv002='$vRoomID' and lv004='".$vDivTC[0]."'";
						break;
					case "MONEY":						
						$vsql="select (lv006*lv005) sumqty from sl_lv0072 where lv002='$vRoomID' and lv004='".$vDivTC[0]."'";
						break;
				}
				
				$vresult=db_query($vsql);					
				$vrow=db_fetch_array($vresult);
				$vReturn[$i]['name']='['.$vCTC[0].']';
				$vReturn[$i]['value']=(float)$vrow['sumqty'];
				$strOK=$strOK.",[".$vCTC[0]."]";
				$i++;
				}
			}
			
		}
		return $vReturn;
	}
	function LV_DieuKien($vStr)
	{
		if(eregi("&",$vStr))
		{
			
			$vArrStr=explode("&",$vStr);
			if($this->LV_CheckOperation($this->LV_DieuKien($vArrStr[0])) && $this->LV_CheckOperation($this->LV_DieuKien($vArrStr[1])))
			{
				return true;
			}
			else
			return false;
		}
		elseif(eregi("#",$vStr))
		{
			
			$vArrStr=explode("#",$vStr);
			if($this->LV_CheckOperation($this->LV_DieuKien($vArrStr[0])) || $this->LV_CheckOperation($this->LV_DieuKien($vArrStr[1])))
			{
				return true;
			}
			else
			return false;
		}
		elseif(eregi(">=",$vStr))
		{
			$vArrStr=explode(">=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])>=$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("<=",$vStr))
		{
			
			$vArrStr=explode("<=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])<=$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("!=",$vStr))
		{
			
			$vArrStr=explode("!=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])!=$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("<>",$vStr))
		{
			
			$vArrStr=explode("<>",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])<>$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("=",$vStr))
		{
			
			$vArrStr=explode("=",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])==$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi(">",$vStr))
		{
			
			$vArrStr=explode(">",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])>$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		else if(eregi("<",$vStr))
		{
			
			$vArrStr=explode("<",$vStr);
			if($this->LV_CheckOperation($vArrStr[0])<$this->LV_CheckOperation($vArrStr[1]))
			{
				return true;
			}
			else
			return false;
		}
		
		return false;
		
	}
	function LV_CheckOperation($vStr)
	{
		$vCongTHuc2=$vStr;
		for($i=0;$i<strlen($vStr);$i++)
		{
			$vOne=substr($vStr,$i,1);
			if(strtoupper($vOne)=="(")
			{
				$vEndVT= $this->LV_DAYMO($i,$vStr);
				
				$vFunIFRun=$this->LV_DAYMORUN(substr($vStr,$i,$vEndVT-$i+1));
				$vCongTHuc2=str_replace(substr($vStr,$i,$vEndVT-$i+1),$vFunIFRun,$vCongTHuc2);
				$i=$vEndVT;
			}
			
			
		}	
		$vStr=$vCongTHuc2;
		if(strpos($vStr,"+")>0)
		{
			$vArrStr=explode("+",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])+$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"-")>0)
		{			
			$vArrStr=explode("-",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])-$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"*")>0)
		{			
			$vArrStr=explode("*",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])*$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"/")>0)
		{			
			$vArrStr=explode("/",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])/$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"%")>0)
		{			
			$vArrStr=explode("%",$vStr,2);
			return $this->LV_CheckOperation($vArrStr[0])%$this->LV_CheckOperation($vArrStr[1]);
		}
		else if(strpos($vStr,"^")>0)
		{			
			$vArrStr=explode("^",$vStr,2);
			return $this->LV_LayNguyen($this->LV_CheckOperation($vArrStr[0])/$this->LV_CheckOperation($vArrStr[1]));
		}
		return (float)$vStr;
	}
	function LV_LayNguyen($vNumber)
	{
		$vArray=explode(".",$vNumber);
		return $vArray[0];
	}
	function LV_DAYMO($vVitri,$vStr)
	{
		$vtang=0;
		for($v=$vVitri;$v<strlen($vStr);$v++)
		{
			$vOne=substr($vStr,$v,1);
			if($vOne=="(") $vtang++;
			if($vOne==")") $vtang--;
			if($vtang==0) return $v;
		}
		return $vVitri;
		
	}
	function LV_IF($vVitri,$vStr)
	{
		$vtang=0;
		for($v=$vVitri+2;$v<strlen($vStr);$v++)
		{
			$vOne=substr($vStr,$v,1);
			if($vOne=="(") $vtang++;
			if($vOne==")") $vtang--;
			if($vtang==0) return $v;
		}
		return $vVitri;
	}
	function LV_DeleteTemp($vlv002)
	{
		$lvsql = "DELETE FROM sl_lv0032  WHERE sl_lv0032.lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}	
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv011 from  sl_lv0013 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv011']<=0) 
					return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
	}
	function LV_InsertOther($vlv002,$vreplace)
	{
		
		if($this->isAdd==0) return false;
		 $lvsql="insert into sl_lv0014 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012) select '$vreplace' ,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012 from sl_lv0011 where lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0014.InsertOther',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;		
		$lvsql="Update sl_lv0014 set lv015='$this->lv015' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0014.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateCalc($vDetailID)
	{
		$vsql="select B.lv006,A.lv002 ContractID,C.lv007 RoomID from sl_lv0014 A inner join  all_gmacv3_0.sl_lv0007 B on A.lv003=B.lv001 left join sl_lv0013 C on C.lv001=A.lv002 where A.lv001='".$vDetailID."' and (select AA.lv011 from sl_lv0013 AA where AA.lv001=A.lv002)<=0";
		$vresult=db_query($vsql);	
		$vrow = db_fetch_array ($vresult);
		if($vrow)
		{
			$this->lv002=$vrow['ContractID'];
			$vValue=$this->LV_TimeToCal($vrow['RoomID'],$vrow['lv006']);
			$lvsql="Update sl_lv0014 set lv004='$vValue' where  lv001='$vDetailID';";
			$vReturn= db_query($lvsql);
			return $vValue;
		}
		return 0;
	}
	function LV_UpdateQty($vDetailID,$vQty)
	{
		$vsql="select B.lv006,A.lv002 ContractID from sl_lv0014 A inner join  all_gmacv3_0.sl_lv0007 B on A.lv003=B.lv001 where A.lv001='".$vDetailID."' and (select AA.lv011 from sl_lv0013 AA where AA.lv001=A.lv002)<=0";
		$vresult=db_query($vsql);	
		$vrow = db_fetch_array ($vresult);
		if($vrow)
		{
			$this->lv002=$vrow['ContractID'];
			if($vrow['lv006']!="" && $vrow['lv006']!=NULL)
				$vValue=$this->LV_TimeToCal($vRoomID,$vrow['lv006']);
			else
				$vValue=$vQty;
			$lvsql="Update sl_lv0014 set lv004='$vValue' where  lv001='$vDetailID' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0;";
			$vReturn= db_query($lvsql);
			return $vValue;
		}
		return 0;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql1 = "insert into sl_lv0014_1 (lv024,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021)   (select lv001,lv002,lv002,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021 from sl_lv0014 where  lv001 IN ($lvarr) and (select B.lv011 from sl_lv0013 B where  B.lv001= sl_lv0014.lv002)<=0)  ";
		$vReturn= db_query($lvsql1);
		{
			$lvsql = "DELETE FROM sl_lv0014  WHERE sl_lv0014.lv001 IN ($lvarr) and (select B.lv011 from sl_lv0013 B where  B.lv001= sl_lv0014.lv002)<=0  ";
			$vReturn= db_query($lvsql);
			if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0014.delete',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_DeleteNoApr($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql1 = "insert into sl_lv0014_1 (lv024,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021)   (select lv001,lv002,lv002,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021 from sl_lv0014 where  lv018=0 And  lv001 IN ($lvarr) and (select B.lv011 from sl_lv0013 B where  B.lv001= sl_lv0014.lv002)<=0)  ";
		$vReturn= db_query($lvsql1);
		{
			$lvsql = "DELETE FROM sl_lv0014  WHERE sl_lv0014.lv001  IN ($lvarr) And lv018=0 and (select B.lv011 from sl_lv0013 B where  B.lv001= sl_lv0014.lv002)<=0  ";
			$vReturn= db_query($lvsql);
			if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0014.delete',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	//////////get view///////////////
	function GetView()
	{
		return $this->isView;
	}//////////get view///////////////
	function GetRpt()
	{
		return $this->isRpt;
	}
	//////////get view///////////////
	function GetAdd()
	{
		return $this->isAdd;
	}	
	//////////get edit///////////////
	function GetEdit()
	{
		return $this->isEdit;
	}	
	//////////get edit///////////////
	function GetApr()
	{
		return $this->isApr;
	}		
	//////////get edit///////////////
	function GetUnApr()
	{
		return $this->isUnApr;
	}	
	//////////Get Filter///////////////
	protected function GetCondition()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and lv001  = '$this->lv001'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0014 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="
		<div id=\"func_id\" style='position:none;background:#f2f2f2'><div style=\"float:left\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</div><div style=\"float:right\">".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</div></div><div style='height:35px'></div><table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr)+2)."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\"><td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>	<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM sl_lv0014 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($lstArr[$i]=="lv003")
				{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[26],$vTemp);
				$strH=$strH.$vTemp;	
				}
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv024':
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100-$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				
				$strL=$strL.$vTemp;
				if($lstArr[$i]=="lv003")
				{
					$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
					$strL=$strL.$vTemp;
				}
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv015']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	function LV_GETNHAP_TP($cateid,$lvcontractid,$lvitemid,$Cut,$Color,$Size)
	{
		switch($this->lvgetdata)
		{
			case 1:
				return $this->LV_GETNHAP($cateid,$lvcontractid,$lvitemid);
				break;
			case 2:
				$LotID=$Cut;
				$sql="SELECT sum(A.lv004) sumall from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid' and A.lv014='$LotID'";
				$bResult = db_query($sql);
				$vrow = db_fetch_array ($bResult);
				return $vrow['sumall'];
				break;
			case 3:
				$LotID=$Color;
				$sql="SELECT sum(A.lv004) sumall from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid' and A.lv014='$LotID'";
				$bResult = db_query($sql);
				$vrow = db_fetch_array ($bResult);
				return $vrow['sumall'];
				break;
			default:
				$LotID=$Cut;
				//$LotID=$Cut."-".$Color."-".$Size;
				$sql="SELECT sum(A.lv004) sumall from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid'";
				$bResult = db_query($sql);
				$vrow = db_fetch_array ($bResult);
				return $vrow['sumall'];
				break;
		}
	}
	function LV_GETXUAT_TP($cateid,$lvcontractid,$lvitemid,$Cut,$Color,$Size)
	{
		switch($this->lvgetdata)
		{
			case 1:
				return $this->LV_GETXUAT($cateid,$lvcontractid,$lvitemid);
				break;
			case 2:
				$LotID=$Cut;
				$sql="SELECT sum(A.lv004) sumall from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid' and A.lv014='$LotID'";
				$bResult = db_query($sql);
				$vrow = db_fetch_array ($bResult);
				return $vrow['sumall'];
				break;
			case 3:
				$LotID=$Color;
				$sql="SELECT sum(A.lv004) sumall from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid' and A.lv014='$LotID'";
				$bResult = db_query($sql);
				$vrow = db_fetch_array ($bResult);
				return $vrow['sumall'];
				break;
			default:
				#$LotID=$Cut."-".$Color."-".$Size;
				$LotID=$Cut;
				$sql="SELECT sum(A.lv004) sumall from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid'";
				$bResult = db_query($sql);
				$vrow = db_fetch_array ($bResult);
				return $vrow['sumall'];
				break;
		}
	}
	function LV_GETNHAP($cateid,$lvcontractid,$lvitemid)
	{
		$sql="SELECT sum(A.lv004) sumall from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid'";
		$bResult = db_query($sql);
		$vrow = db_fetch_array ($bResult);
		return $vrow['sumall'];
	}
	function LV_GETXUAT($cateid,$lvcontractid,$lvitemid)
	{
		$sql="SELECT sum(A.lv004) sumall from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 where A.lv003='$lvitemid' and B.lv005='$cateid' and B.lv006='$lvcontractid'";
		$bResult = db_query($sql);
		$vrow = db_fetch_array ($bResult);
		return $vrow['sumall'];
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\"> 
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('".$this->Dir."sl_lv0014/?lang=".$this->lang."&childdetailfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
		}
	
		
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvexcel="<input class=lvbtdisplay type=\"button\" id=\"lvbuttonexcel\" value=\"".$this->ArrFunc[13]."\" onclick=\"Export($lvFrom,'excel')\">";
		$lvpdf="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[15]."\" onclick=\"Export($lvFrom,'pdf')\">";
		$lvword="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrFunc[14]."\" onclick=\"Export($lvFrom,'word')\">";
		$strGetList="";
		$strGetScript="";
		
		$strTemp=str_replace("@01",$lvexcel,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvword,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvpdf,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	/////////////////////ListFieldSave//////////////////////////
	function ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrder,$lvSortNum)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvArrOrder=explode(",",$lvOrder);
		$lvSelect="<ul id=\"menu-nav\" onkeyup=\"return CheckKeyCheckTab(event,$lvFrom,".count($lstArr).")\">
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" class=\"lv_funcshowimg\"/><span class=\"lv_funcshowtext\">".$this->ArrFunc[11]."</span>
							<ul id=\"submenu-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function SelectChk(vFrom,len)
		{
			vFrom.txtFieldList.value=getChecked(len,'lvdisplaychk');
			vFrom.txtOrderList.value=getAlllen(len,'lvorder');
			vFrom.txtFlag.value=2;
			vFrom.submit();
		}
		function lv_on_open(opt)
		{
			div = document.getElementById('lvsllist');
			if(opt==0)
			{
				div.size=1;
			}
			else
				div.size=div.length;
			
		}
		function getChecked(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{

				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;

				}
			}
			return str;
		}
		function getAlllen(len,nameobj)
		{
			var str='';
			for(i=0;i<len;i++)
			{
				div = document.getElementById(nameobj+i);
				if(str=='') 
					str=''+div.value;
				else
					 str=str+','+div.value;
			}
			return str;
		}
		</script>
";
		$lvScript="<li class=\"menuT\"> @01 </li>";
		$lvNumPage="".$this->ArrOther[2]."<input type=\"text\" class=\"lvmaxrow\" name=lvmaxrow id=lvmaxrow value=\"$maxRows\">";
		$lvSortPage="".GetLangSort(0,$this->lang)."<select class=\"lvsortrow\" name=lvsort id=lvsort >
				<option value=0 ".(($lvSortNum==0)?'selected':'').">".GetLangSort(1,$this->lang)."</option>
				<option value=1 ".(($lvSortNum==1)?'selected':'').">".GetLangSort(2,$this->lang)."</option>
				<option value=2 ".(($lvSortNum==2)?'selected':'').">".GetLangSort(3,$this->lang)."</option>
		</select>";
		$lvChk="<input type=\"checkbox\" id=\"lvdisplaychk@01\" name=\"lvdisplaychk@01\" value=\"@02\" @03><input id=\"lvorder@01\" name=\"lvorder@01\"  type=\"text\" value=\"@06\"\ style=\"width:20px\" >";
		$lvButton="<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"".$this->ArrOther[1]."\" onclick=\"SelectChk($lvFrom,".count($lstArr).")\">";
		$strGetList="";
		$strGetScript="";
		for ($i=0;$i<count($lstArr);$i++)
		{
			
			$strTempChk=str_replace("@01",$i,$lvChk.$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]]);
			$strTempChk=str_replace("@02",$lstArr[$i],$strTempChk);
			
			$strTempChk=str_replace("@07",100+$i,$strTempChk);
			if(strpos($lvList,",".$lstArr[$i].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
				
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			if($lvArrOrder[$i]==NULL || $lvArrOrder[$i]=="")
				{
				$strTempChk=str_replace("@06",$i,$strTempChk);
				}
			else
				$strTempChk=str_replace("@06",$lvArrOrder[$i],$strTempChk);
			
			
			$strTemp=str_replace("@01",$strTempChk,$lvScript);
			$strGetScript=$strGetScript.$strTemp;
		}
		$strTemp=str_replace("@01",$lvNumPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
				$strTemp=str_replace("@01",$lvSortPage,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strTemp=str_replace("@01",$lvButton,$lvScript);
		$strGetScript=$strGetScript.$strTemp;
		$strReturn=str_replace("@#01",$strGetScript,$lvSelect).$strScript;
		return $strReturn;
		
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex)
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		<script language=\"javascript\">
		function getChecked(len,nameobj,namevalue)
		{
			var str='';
			for(i=0;i<len;i++)
			{
			div = document.getElementById(nameobj+i);
			if(div.checked)
				{
				div1 = document.getElementById(namevalue+i);
				if(str=='') 
					str=(namevalue=='')?div.value:div1.value;
				else
					 str=str+','+(namevalue=='')?div.value:div1.value;
				}
			
			}
			return str;
		}
		</script>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  hr_lv0004";
		$strGetList="";
		$strGetScript="";
		$i=0;
		$vresult=db_query($vsql);
		$numrows=db_num_rows($vresult);
		while($vrow=db_fetch_array($vresult))		
		{

			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow['lv001'].",") === FALSE)
			{
				$strTempChk=str_replace("@03","",$strTempChk);
			}
			else
			{
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			}
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow['lv002']."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
//////////////////////Buil list////////////////////
	function LV_BuilListReport($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="<div align=\"center\"><img  src=\"".$this->GetLogo()."\" /></div>
		<div align=\"center\"><h1>".($this->ArrPush[0])."</h2></div>
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1%>@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM sl_lv0014 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($lstArr[$i]=="lv003")
				{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[26],$vTemp);
				$strH=$strH.$vTemp;	
				}
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv017':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETNHAP_TP('CONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv018':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETNHAP_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv019':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETXUAT_TP('CONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));	
						break;
					case 'lv020':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETXUAT_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv021':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100-$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}				
				$strL=$strL.$vTemp;
				if($lstArr[$i]=="lv003")
				{
					$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
					$strL=$strL.$vTemp;
				}
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vTax,$optsum=0,$lvSortNum,$vCKTT=0)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		if($optsum==0)
		{
			$lvList=$lvList;
			$lvOrderList=$lvOrderList;
		}
		else
		{
			$lvList=$lvList;
			$lvOrderList=$lvOrderList;
		}
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort="";
		switch($lvSortNum)
		{
			case 0:
				break;
			case 1:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"asc");
				break;
			case 2:
				$strSort=" order by ".$this->LV_SortBuild($this->GB_Sort,"desc");
				break;
		}
		$lvTable="<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1%>@03</td>
			@#01
		</tr>
		";
		if($optsum==0)
		{
		$lvTrTotal="<tr ondblclick=\"this.innerHTML=''\">
			<td class=\"lvlineboldtable\"  colspan=@04>@03</td>
			<td class=\"lvlineboldtable\" align='right'>@01</td>
		</tr>
		";
		}
		else
			$lvTrTotal="";
		$lvTrBangchu="<tr ondblclick=\"this.innerHTML=''\">
			<td class=\"lvlineboldtable\"  colspan=\"@04\">@03 @01</td>
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM sl_lv0014 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		$strSubTotal=0;
		$strSubDiscount=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VN�";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($lstArr[$i]=="lv003")
				{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[26],$vTemp);
				$strH=$strH.$vTemp;	
				}
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv017':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETNHAP_TP('CONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv018':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETNHAP_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv019':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETXUAT_TP('CONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));	
						break;
					case 'lv020':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GETXUAT_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']),(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv021':
						if($vTax>0)
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006']-$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					else
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100-$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}	
				$strL=$strL.$vTemp;
				if($lstArr[$i]=="lv003")
				{
					$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]),$lvTd);
					$strL=$strL.$vTemp;
				}
			}
			$vUnitPrice=$this->getvaluelink('lv007',$this->FormatView($vrow['lv007'],(int)$this->ArrView[$vrow['lv007']]));
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vTax>0)
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv006'];
			}
			else
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100;
			}
			$strSubDiscount=$strSubDiscount+$vrow['lv004']*$vrow['lv006']*$vrow['lv011']/100;
			
		}
			$strLine=str_replace("@01",$this->FormatView($strSubTotal-$strSubDiscount,10),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[22],$strLine);
			$strLine=str_replace("@04",count($lstArr)+1,$strLine);
			$strTr=$strTr.$strLine;
			if($vTax>0)
			{
			$strSubTax=$strSubTotal*$vTax/100;
			$strLine=str_replace("@01",$this->FormatView($strSubTax,10),$lvTrTotal);
			$strLine=str_replace("@03",str_replace("@02",$this->FormatView($vTax,10)."%",$this->ArrPush[23]),$strLine);
			$strLine=str_replace("@04",count($lstArr)+1,$strLine);
			$strTr=$strTr.$strLine;
			}
			if($vCKTT>0)
			{
				$strSubCKTT=$strSubTotal*$vCKTT/100;
				$strLine=str_replace("@01",$this->FormatView($strSubCKTT,10),$lvTrTotal);
				$strLine=str_replace("@03",str_replace("@02",$this->FormatView($vCKTT,10)."%",$this->ArrPush[28]),$strLine);
				$strLine=str_replace("@04",count($lstArr)+1,$strLine);
				$strTr=$strTr.$strLine;
			}
			$strTotalAmount=round($strSubTotal+$strSubTax-$strSubCKTT-$strSubDiscount);
			$strLine=str_replace("@01",$this->FormatView($strTotalAmount,10),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[24],$strLine);
			$strLine=str_replace("@04",count($lstArr)+1,$strLine);
			$strTr=$strTr.$strLine;
			$strLine=str_replace("@01",LNum2Text($strTotalAmount,$this->lang),$lvTrBangchu);
			$strLine=str_replace("@03",$this->ArrPush[27],$strLine);
			$strLine=str_replace("@04",count($lstArr)+2,$strLine);
			$strTr=$strTr.$strLine;
		$strTrH=str_replace("@#01",str_replace("@01","(".$vUnitPrice.")",$strH),$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	public function LV_LinkFieldExt($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlconditionext($vFile,$vSelectID),2));
	}
	private function sqlconditionext($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{

			case 'lv009':
				$vsql="select A.lv001,A.lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  sl_lv0059 A  where A.lv008=1";
				break;
			case 'lv099':
				$vsql="select A.lv001,A.lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  sl_lv0059 A  where A.lv008=1 and (date(A.lv003)<=CURRENT_DATE() and date(A.lv004)>=CURRENT_DATE()) and (time(A.lv003)<=CURRENT_TIME() and time(A.lv004)>=CURRENT_TIME())";
				break;
			
		}
		return $vsql;
	}
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),2));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from   all_gmacv3_0.sl_lv0007";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			case 'lv009':
				$vsql="select A.lv001,A.lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  sl_lv0059 A inner join sl_lv0060 B on A.lv001=B.lv002 where B.lv003='$vSelectID' and A.lv008=1";
				break;
			case 'lv099':
				$vsql="select A.lv001,A.lv002,IF(A.lv001='$vSelectID',1,0) lv003 from  sl_lv0059 A";
				break;
			case 'lv012':
				$vsql="select lv003 lv001,lv003 lv002,0 lv003 from  sl_lv0030 where lv002='$vSelectID' order by lv002 asc";
				break;
			case 'lv016':
				$vsql="select A.lv001,concat(A.lv003,'->',A.lv005,'(',A.lv006,')',A.lv004) lv002,0 lv003 from  sl_lv0064 A inner join sl_lv0060 B on A.lv002=B.lv001 where B.lv002='".$vSelectID[0]."' and B.lv003='".$vSelectID[1]."'";
				break;
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from   all_gmacv3_0.sl_lv0007 where lv001='$vSelectID'";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0059 where lv001='$vSelectID'";
				break;
			case 'lv016':
				$vsql="select A.lv001,concat(A.lv003,'->',A.lv005,'(',A.lv006,')',A.lv004) lv002,0 lv003 from  sl_lv0064 A  where A.lv001='".$vSelectID."'";
				break;
			default:
				$vsql ="";
				break;
		}
		if($vsql=="")
		{
			return $vSelectID;
		}
		else
		$lvResult = db_query($vsql);
		while($row= db_fetch_array($lvResult)){
		return ($lvopt==0)?$row['lv002']:(($lvopt==1)?$row['lv001']."(".$row['lv002'].")":(($lvopt==2)?$row['lv002']."(".$row['lv001'].")":$row['lv001']));
		}
		
	}
}
?>