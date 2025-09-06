<?php
/////////////coding ac_lv0034///////////////
class   ac_lv0234 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;


///////////
	public $DefaultFieldList="lv809,lv002,lv003,lv005,lv006,lv007";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='ac_lv0005';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv809"=>"10");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"10","lv004"=>"10","lv005"=>"0","lv006"=>"0","lv007"=>"0","lv809"=>"2");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
		$this->isRpt=1;		
		$this->isFil=0;
		$this->isHelp=0;
		$this->isAdd=0;
		$this->isEdit=0;
		$this->isDel=0;	
		
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv016 from ac_lv0004 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv016']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  ac_lv0005";
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
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  ac_lv0005 Where lv001='$vlv001'";
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
		}
	}
	function LV_CheckExitItem($vContracID,$vNotes)
	{
		$lvsql="select lv001 from  ac_lv0005 Where lv002='$vContracID' and lv007='$vNotes'";
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
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$lvsql="insert into ac_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007')";
		$vReturn= db_query($lvsql);
		if($vReturn){	
		 	$this->InsertLogOperation($this->DateCurrent,'ac_lv0005.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_InsertTemp($vTemID,$vlv002)
	{
		$lvsql="select '$vTemID' lv002,lv003,lv004,lv005,lv006,lv007 from wh_lv0030 where lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		while($vrow=db_fetch_array($vReturn))
		{
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->LV_Insert();
		}
		if($vReturn) $this->LV_DeleteTemp($vlv002);
		return $vReturn;
	}
	function LV_DeleteTemp($vlv002)
	{
		$lvsql = "DELETE FROM wh_lv0030  WHERE wh_lv0030.lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		  $lvsql="Update ac_lv0005 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'ac_lv0005.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateEdit($vOldlv004,$vOldlv006)
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		  $lvsql="Update ac_lv0005 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'ac_lv0005.update',sof_escape_string($lvsql));
		 
		 }
		return $vReturn;
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv016 from  ac_lv0004 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv016']<=0) return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM ac_lv0005  WHERE ac_lv0005.lv001 IN ($lvarr) and (select lv016 from ac_lv0004 B where  B.lv001= ac_lv0005.lv002)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			$this->InsertLogOperation($this->DateCurrent,'ac_lv0005.delete',sof_escape_string($lvsql));
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
		if($this->datefrom!="") $strCondi=$strCondi." and B.lv009>= '$this->datefrom'";
		if($this->dateto!="") $strCondi=$strCondi." and B.lv009<= '$this->dateto'";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  = '$this->lv005'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="")  $strCondi=$strCondi." and A.lv007 like '%$this->lv007%'";
		$strCondi=$strCondi." and B.lv002 =1 and B.lv017=0";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM ac_lv0005 A inner join  ac_lv0004 B on A.lv002=B.lv001 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetLimitDate($vstartdate,$venddate)
	{
		if(count($this->vArrDay)>0) return $this->vArrDay;
		$vstt=1;
		$vstartday=(int)getday($vstartdate);
		$vstartmonth=getmonth($vstartdate);
		$vstartyear=getyear($vstartdate);
		$vendday=(int)getday($venddate);
		$vendmonth=getmonth($venddate);
		$vendyear=getyear($venddate);
		if($vstartmonth!=$vendmonth)
		{
			$vStartNumDay=GetDayInMonth($vstartyear,$vstartmonth);
			for($i=$vstartday;$i<=$vStartNumDay;$i++)
			{

				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				if((date('w', strtotime($this->vArrDay[$vstt]))+1)==1) $this->DOWCN=$this->DOWCN+1;
				$vstt++;
			}
			$vEndNumDay=$vendday;
			for($i=1;$i<=$vEndNumDay;$i++)
			{
				$this->vArrDay[$vstt]=$vendyear."-".Fillnum($vendmonth,2)."-".Fillnum($i,2);
				if((date('w', strtotime($this->vArrDay[$vstt]))+1)==1) $this->DOWCN=$this->DOWCN+1;
				$vstt++;
			}
		}
		else
		{
			for($i=$vstartday;$i<=$vendday;$i++)
			{
				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				if((date('w', strtotime($this->vArrDay[$vstt]))+1)==1) $this->DOWCN=$this->DOWCN+1;
				$vstt++;
			}
		}
		return $this->vArrDay;
	}
	function LV_GET_NameNV($vMaNV)
	{
		$str_return1="";
		$vsql="select lv002 from hr_lv0020 where lv001='$vMaNV'";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($str_return1=="")
				$str_return1=$vrow['lv002'];
			else 
				$str_return1=$str_return1.",".$vrow['lv002']."";
		}
		return $str_return1;
	}
	function PrintInOutPutInStockDetail($plang,$vArrLang,$vDateStart,$vDateEnd,$vOpt=0,$vStaffID='')
	{
		$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td rowspan=\"2\" class=\"htable\" width=\"3%\" >STT</td>
				<td rowspan=\"2\" class=\"htable\" width=\"5%\" >Ngày</td>
				<td rowspan=\"2\" class=\"htable\" width=\"5%\" >Kế toán</td>
				<td rowspan=\"2\" class=\"htable\" width=\"10%\" style=\"cursor:pointer\">Tổng chi</td>
				<td class=\"htable\" width=\"*%\" style=\"cursor:pointer\" colspan=\"4\"><center>Nội dung chi</center></td>
			</tr>
			<tr>
				<td class=\"htable\" width=\"20%\" ondblclick=\"RemoveCol('col_6',this,@!79)\" style=\"cursor:pointer\"><center>Tên mục chi</center></td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_7',this,@!79)\" style=\"cursor:pointer\"><center>Số lượng</center></td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_8',this,@!79)\" style=\"cursor:pointer\"><center>Đơn giá</center></td>
				<td class=\"htable\" width=\"10%\" ondblclick=\"RemoveCol('col_9',this,@!79)\" style=\"cursor:pointer\"><center>Thành tiền</center></td>
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr class=\"lvlinehtable@#02\">
				<td class=\"center_style\" rowspan=\"@#01\" valign=\"top\" >@01</td>
				<td class=\"center_style\" rowspan=\"@#01\" valign=\"top\" nowrap>@02</td>
				<td class=\"left_style\" rowspan=\"@#01\" valign=\"top\" nowrap>@33</td>
				<td class=\"right_style\" rowspan=\"@#01\" valign=\"top\" nowrap>@03</td>
				<td class=\"left_style\" id=\"col_5_@02\">@06</td>
				<td class=\"center_style\" id=\"col_6_@02\" nowrap>@07</td>
				<td class=\"center_style\" id=\"col_7_@02\" nowrap>@08</td>
				<td class=\"right_style\"  id=\"col_8_@02\" nowrap>@09</td>				
			</tr>
			";
		$vRowDetail="
			<tr class=\"lvlinehtable@#02\">
				<td class=\"left_style\" id=\"col_5_@02\"><strong>@06</strong></td>
				<td class=\"center_style\" id=\"col_6_@02\"><strong>@07</strong></td>
				<td class=\"center_style\" id=\"col_7_@02\"><strong>@08</strong></td>
				<td class=\"right_style\"  id=\"col_8_@02\"><strong>@09</strong></td>	
			</tr>
			";
		$vRowLast="
			<tr>
				<td class=\"center_style\" valign=\"top\" colspan=\"3\"><strong>Tổng:</strong></td>
				<td class=\"right_style\" id=\"col_2_@02\"><strong>@03</strong></td>
				<td class=\"left_style\" id=\"col_5_@02\"&nbsp;</td>
				<td class=\"center_style\" id=\"col_6_@02\">&nbsp;</td>
				<td class=\"center_style\" id=\"col_7_@02\">&nbsp;</td>
				<td class=\"right_style\" id=\"col_8_@02\"><strong>&nbsp;</strong></td>	
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"left_style\"  id=\"col_3_@02\">@04</td>
				<td class=\"left_style\" id=\"col_4_@02\">@05</td>
				<td class=\"left_style\" id=\"col_5_@02\" >@06</td>
				<td class=\"center_style\"  id=\"col_6_@02\">@07</td>
				<td class=\"center_style\"  id=\"col_7_@02\">@08</td>
				<td class=\"right_style\"  id=\"col_8_@02\">@09</td>	
				<td class=\"center_style\"  id=\"col_9_@02\">@10</td>
			</tr>";
		$this->LV_GetLimitDate($vDateStart,$vDateEnd);
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($vStaffID!='')
				{
					$vListStaff="'".str_replace(",","','",$vStaffID)."'";
					$vArrStaff[$vStaffID][0]=$vStaffID;
					$vArrStaff[$vStaffID][1]=$vListStaff;
				}
				else
				{
					$vsqlstaff="
					select distinct * from (select A.lv008 lv001 from ac_lv0004 A where A.lv009>='".$this->datefrom."' and A.lv009<='".$this->dateto."' and  A.lv002=1
					union
					select A.lv003 lv001 from  wh_lv0008 A  where A.lv009>='".$this->datefrom." 00:00:00' and A.lv009<='".$this->dateto." 23:59:59' and A.lv005<>'KIEMKHO') MP
					";
					$vresult=db_query($vsqlstaff);
					while($vrow=db_fetch_array($vresult))
					{
						$vArrStaff[$vrow['lv001']][0]=$vrow['lv001'];
						$vListStaff="'".str_replace(",","','",$vrow['lv001'])."'";
						$vArrStaff[$vrow['lv001']][1]=$vListStaff;

					}
				}
		$vOrder=1;
		if(count($this->vArrDay)>0){
			foreach($this->vArrDay as $vDateCal)
			{
				foreach($vArrStaff as $vStaff)
				{
					$vStaffID=$vStaff[0];
					$vListStaff=$vStaff[1];
				$vLineRun = $vRowFirst;
				$vLineRun = str_replace("@01", $vOrder, $vLineRun);
				$vLineRun = str_replace("@02", $this->FormatView($vDateCal,2), $vLineRun);
				$vLineRun = str_replace("@#02", ($vOrder%2), $vLineRun);
				$vLineRun = str_replace("@33",$vStaffID.'<br/>'.$this->LV_GET_NameNV($vStaffID), $vLineRun);
				$vNumline=0;
				$vChi=0;
				$vSumContract=$vSumContract+$vContract;
				$strExpportAll1='';
				/////Chi khác
				if($vOpt==0 || $vOpt==1)
				{
					if($vStaffID!='')
						$vsql="select A.* from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001 and B.lv009='".$vDateCal."' and B.lv002=1 and B.lv008 in ($vListStaff)";
					else
						$vsql="select A.* from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001 and B.lv009='".$vDateCal."' and B.lv002=1";
					$bResultS = db_query($vsql);
					while($vrow =db_fetch_array($bResultS))
					{
						$vChi=$vChi+$vrow['lv003'];
						if($vNumline==0)
						{
							$vLineRun = str_replace("@06", $vrow['lv007'], $vLineRun);
							$vLineRun = str_replace("@07", '&nbsp;', $vLineRun);
							$vLineRun = str_replace("@08", '&nbsp;', $vLineRun);
							$vLineRun = str_replace("@09", $this->FormatView($vrow['lv003'],20),$vLineRun);
						}
						else
						{
							$vLineRun1 = $vRowDetail;
							$vLineRun1 = str_replace("@06", $vrow['lv007'], $vLineRun1);
							$vLineRun1 = str_replace("@07", '&nbsp;', $vLineRun1);
							$vLineRun1 = str_replace("@08", '&nbsp;', $vLineRun1);
							$vLineRun1 = str_replace("@09", $this->FormatView($vrow['lv003'],20),$vLineRun1);
							$strExpportAll1 = $strExpportAll1.$vLineRun1;
						}
						
						$vNumline++;
						
					}
				}
				if($vOpt==0 || $vOpt==2)
				{
					if($vStaffID!='')
						$vsql="select A.*,C.lv002 Names from wh_lv0009 A inner join sl_lv0007 C on A.lv003=C.lv001 inner join wh_lv0008 B on A.lv002=B.lv001 and substr(B.lv009,1,10)='".$vDateCal."'  and B.lv005<>'KIEMKHO'  and B.lv003 in ($vListStaff)";
					else
						$vsql="select A.*,C.lv002 Names from wh_lv0009 A inner join sl_lv0007 C on A.lv003=C.lv001 inner join wh_lv0008 B on A.lv002=B.lv001 and substr(B.lv009,1,10)='".$vDateCal."'  and B.lv005<>'KIEMKHO'";
						$bResultS = db_query($vsql);
					while($vrow =db_fetch_array($bResultS))
					{
						$vChi=$vChi+round($vrow['lv004']*$vrow['lv008'],0);
						if($vNumline==0)
						{
							$vLineRun = str_replace("@06", $vrow['Names'], $vLineRun);
							$vLineRun = str_replace("@07", $this->FormatView($vrow['lv004'],20), $vLineRun);
							$vLineRun = str_replace("@08", $this->FormatView($vrow['lv008'],20), $vLineRun);
							$vLineRun = str_replace("@09", $this->FormatView($vChi,20),$vLineRun);
						}
						else
						{
							$vLineRun1 = $vRowDetail;
							$vLineRun1 = str_replace("@06", $vrow['Names'], $vLineRun1);
							$vLineRun1 = str_replace("@07", $this->FormatView($vrow['lv004'],20), $vLineRun1);
							$vLineRun1 = str_replace("@08", $this->FormatView($vrow['lv008'],20), $vLineRun1);
							$vLineRun1 = str_replace("@09", $this->FormatView(round($vrow['lv004']*$vrow['lv008'],0),20),$vLineRun1);
							$strExpportAll1 = $strExpportAll1.$vLineRun1;
						}
						$vNumline++;
					}
				}
				$vSumChi=$vSumChi+$vChi;
				$vLineRun = str_replace("@03", $this->FormatView(round($vChi,-3),20), $vLineRun);
				if($vNumline==0)
				{
					$vLineRun = str_replace("@06", '&nbsp;', $vLineRun);
					$vLineRun = str_replace("@07", '&nbsp;', $vLineRun);
					$vLineRun = str_replace("@08", '&nbsp;', $vLineRun);
					$vLineRun = str_replace("@09", '&nbsp;',$vLineRun);
					$strExpportAll = $strExpportAll.$vLineRun;
				}
				else
				{
					$strExpportAll = $strExpportAll.$vLineRun;
				}
				$strExpportAll = $strExpportAll.$strExpportAll1;
				if($vNumline==0) $vNumline=1;
				$strExpportAll = str_replace("@#01", $vNumline, $strExpportAll);
				$vNumline=0;
				//Chi theo kho
				$vOrder++;
			}
			}
		} else {
			return $vArrLang[5];
		}
		$vincrease++;
		$vOrder++;
		$vRowLast=str_replace("@03",$this->FormatView(round($vSumChi,-3),10),$vRowLast);
	
		$vRowLast=str_replace("@02",$vincrease,$vRowLast);
		$strExpportAll=$strExpportAll.$vRowLast;	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = str_replace("@!79",$totalRows+1,$vHeaderReportInventory);
		//Order
		$vHeader = str_replace("@02", $vArrLang[4], $vHeader);
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[23], $vHeader);
		//Date incoide
		$vHeader = str_replace("@04", $vArrLang[24], $vHeader);
		//Item
		$vHeader = str_replace("@05",$vArrLang[5], $vHeader);
		//Name Item
		$vHeader = str_replace("@06", $vArrLang[6], $vHeader);
		//Quantity
		$vHeader = str_replace("@07", 'SL', $vHeader);
		//Price
		$vHeader = str_replace("@08",$vArrLang[48], $vHeader);
		//Amount
		$vHeader = str_replace("@09",$vArrLang[51]."(vnđ)", $vHeader);	
		//Discount
		$vHeader = str_replace("@10","CK<br/>(%)", $vHeader);
		//Discount Amount
		$vHeader = str_replace("@11",'Tiền<br/>CK<br/>'."(vnđ)", $vHeader);
		//Tax
		$vHeader = str_replace("@12",$vArrLang[49], $vHeader);
		//Tax Amount
		$vHeader = str_replace("@13",$vArrLang[57]."(vnđ)", $vHeader);
		//Score
		$vHeader = str_replace("@14",$vArrLang[56], $vHeader);
		//
		$vHeader = str_replace("@15",'<span title="'.$vArrLang[53].'">CT<br/>BH</span>', $vHeader);
		//Program
		$vHeader = str_replace("@16",$vArrLang[26], $vHeader);	
		$vHeader = str_replace("@17",$vArrLang[27], $vHeader);	
		$vHeader = str_replace("@18",$vArrLang[55]."(vnđ)", $vHeader);	
		$vHeader = str_replace("@19",$vArrLang[58], $vHeader);	
		$vHeader = str_replace("@20",'<span title="'.$vArrLang[59].'">CK<br/>TM<br/>'."(vnđ)<br/>", $vHeader);	
		$vHeader = str_replace("@21",$vArrLang[60], $vHeader);	
		$vHeader = str_replace("@28","Giá vốn", $vHeader);	
		$vHeader = str_replace("@29","Tổng tiền vốn", $vHeader);	
		$vHeader = str_replace("@30","Lợi nhuận", $vHeader);
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
			//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$this->LV_CheckLock();
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
		<div id=\"func_id\" style='position:relative;background:#f2f2f2'>
		<table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		@#02
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\"><div style=\"float:left\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</div><div style=\"float:right\">".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</div></td><td colspan=\"2\" align=right></td></tr>
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvTdF="<td align=\"right\"><strong>@01</strong></td>";
		$strF="<tr><td colspan=\"2\">&nbsp;</td>";
		$sqlS = "SELECT A.*,B.lv009 lv809 FROM ac_lv0005 A inner join  ac_lv0004 B on A.lv002=B.lv001 WHERE B.lv002=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vSumLv003=$vSumLv003+$vrow['lv003'];
			$vSumLv004=$vSumLv004+$vrow['lv004'];
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv003-->",$this->FormatView($vSumLv003,10),$strF);
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumLv004,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/export.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			datefrom = document.getElementById('txtDateFrom').value;
			dateto = document.getElementById('txtDateTo').value;
			tkno = document.getElementById('txtDateTo').value;
			window.open('".$this->Dir."ac_lv0234/?lang=".$this->lang."&childdetailfunc='+value+'&datefrom='+datefrom+'&dateto='+dateto+'&tkno='+tkno,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
	function LV_BuilListReportBH($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		$lvTable="<div align=\"center\"></div>
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
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.* FROM ac_lv0005 A inner join  ac_lv0004 B on A.lv002=B.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
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
		$lvTable="
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		@#02
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.*,B.lv009 lv809  FROM ac_lv0005 A inner join  ac_lv0004 B on A.lv002=B.lv001 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				$vTempF=str_replace("@01","<!--".$lstArr[$i]."-->",$lvTdF);
				$strF=$strF.$vTempF;
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vSumLv003=$vSumLv003+$vrow['lv003'];
			$vSumLv004=$vSumLv004+$vrow['lv004'];
			$this->Amount=$this->Amount+$vrow['lv003'];
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
		}
		$strF=$strF."</tr>";
		$strF=str_replace("<!--lv003-->",$this->FormatView($vSumLv003,10),$strF);
		$strF=str_replace("<!--lv004-->",$this->FormatView($vSumLv004,10),$strF);
		$lvTable=str_replace("@#02",$strF,$lvTable);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	
//////////////////////Buil list////////////////////
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$vTax)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lvList=$lvList."";
		$lvOrderList=$lvOrderList."";
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
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTrTotal="<tr >
			<td class=\"lvlineboldtable\"  colspan=@04>@03</td>
			<td class=\"lvlineboldtable\">@01</td>
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT A.* FROM ac_lv0005 A inner join  ac_lv0004 B on A.lv002=B.lv001 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VNÐ";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			$this->Amount=0;
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$this->Amount=$this->Amount+$vrow['lv003'];
			for($i=0;$i<count($lstArr);$i++)
			{
				if($lstArr[$i]=="lv013")
				{
					if($vTax>0 || $vTax==-1)
					{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
					{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				}
				else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])).(($lstArr[$i]=='lv008')?'%':''),$lvTd);
				$strL=$strL.$vTemp;
			}
			$vUnitPrice=$this->getvaluelink('lv007',$this->FormatView($vrow['lv007'],(int)$this->ArrView[$vrow['lv007']]));
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vTax>0 || $vTax==-1)
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv006'];
			}
			else
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv006']+$vrow['lv004']*$vrow['lv006']*$vrow['lv008']/100;
			}
			
		}
		/*$strLine=str_replace("@01",$this->FormatView($strSubTotal,1),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[15],$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;
			if($vTax>0)
			{
			$strSubTax=$strSubTotal*$vTax/100;
			$strLine=str_replace("@01",$this->FormatView($strSubTax,1),$lvTrTotal);
			$strLine=str_replace("@03",str_replace("@02",$this->FormatView($vTax,10),$this->ArrPush[16]),$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;
			}
		
			$strTotalAmount=$strSubTotal+$strSubTax;
			$strLine=str_replace("@01",$this->FormatView($strTotalAmount,1),$lvTrTotal);
			$strLine=str_replace("@03",$this->ArrPush[17],$strLine);
			$strLine=str_replace("@04",count($lstArr),$strLine);
			$strTr=$strTr.$strLine;*/
		$strTrH=str_replace("@#01",str_replace("@01","(".$vUnitPrice.")",$strH),$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),2));
	}
	public function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			
			case 'lv005':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv006':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv199';
	 			$vsql="
				select distinct * from (select A.lv008 lv001,B.lv002 lv002,IF(A.lv008='$vSelectID',1,0) lv003 from ac_lv0004 A  inner join hr_lv0020 B on A.lv008=B.lv001 where A.lv009>='".$this->datefrom."' and A.lv009<='".$this->dateto."' and  A.lv002=1
				union
				select A.lv003 lv001,B.lv002 lv002,IF(A.lv003='$vSelectID',1,0) lv003 from  wh_lv0008 A  inner join hr_lv0020 B on A.lv003=B.lv001 where A.lv009>='".$this->datefrom." 00:00:00' and A.lv009<='".$this->dateto." 23:59:59' and A.lv005<>'KIEMKHO') MP
				";
				break;	
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002 where lv001='$vSelectID'";
				break;
			case 'lv006':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002 where lv001='$vSelectID'";
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