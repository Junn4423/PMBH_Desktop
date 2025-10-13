<?php
/////////////coding sl_lv0059///////////////
class   sl_lv0059 extends lv_controler
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
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv009,lv099,lv005,lv006,lv007,lv008";	
////////////////////GetDate	
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='sl_lv0059';
	public $obj_detail=null;
	public $obj_config=null;
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv099"=>"100");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"4","lv004"=>"4","lv005"=>"0","lv006"=>"22","lv007"=>"0","lv008"=>"10","lv009"=>"0","lv099"=>"0");	
	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	var $ArrViewEnter=array("lv003"=>"2","lv004"=>"2","lv005"=>"101","lv006"=>"101","lv007"=>"101","lv008"=>"101");
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;	
	 	$this->isFil=1;		
		$this->lang=$_GET['lang'];
		
	}
	
	function LV_Load()
	{
		$vsql="select * from  sl_lv0059";
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
			$this->lv099=$vrow['lv099'];
		}
	}
	function LV_ConfirmProgramCus($vCusID)
	{
		//Xác định khách hàng đang ở nhóm nào.
		$lvsql="select lv022 from  sl_lv0001 A  where A.lv001='$vCusID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		$vNhomCus='';
		if($vrow)
		{
			if($vrow['lv022']!='' && $vrow['lv022']!=null)
			{
				$vNhomCus=$vrow['lv022'];
			}
		}
		if($vNhomCus!='')
		{
			$lvsql="select A.lv001 from  sl_lv0059 A  where concat(',',A.lv099,',') like concat('%,','$vNhomCus',',%') and A.lv008=1 and (date(A.lv003)<=CURRENT_DATE() and date(A.lv004)>=CURRENT_DATE()) and (time(A.lv003)<=CURRENT_TIME() and time(A.lv004)>=CURRENT_TIME())";
			$vresult=db_query($lvsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				return $vrow['lv001'];
				
			}
			else
				$this->lv001='';
		}
		return '';
		//Xác định nhóm có chương trình ko
	}
	function LV_LoadActive()
	{
		$lvsql="select A.*,count(A.lv001) NumLine from  sl_lv0059 A  where A.lv099='' and A.lv008=1 and (date(A.lv003)<=CURRENT_DATE() and date(A.lv004)>=CURRENT_DATE()) and (time(A.lv003)<=CURRENT_TIME() and time(A.lv004)>=CURRENT_TIME())";
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
			if(trim($this->lv099)=='') 
				$this->NumLine=$vrow['NumLine'];
			else
				$this->NumLine=0;
			$this->lv099=$vrow['lv099'];
		}
		else
			$this->lv001='';
	}
	function LV_GetProgCus($vlv022)
	{
		$lvsql="select * from  sl_lv0059 Where concat(',',lv099,',') like '%,$vlv022,%'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		else
			return '';
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  sl_lv0059 Where lv001='$vlv001'";
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
			$this->lv099=$vrow['lv099'];
		}
		else
			$this->lv001='';
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$this->lv003 = ($this->lv003!="")?recoverdate(($this->lv003), $this->lang)." ".gettime($this->lv003):$this->DateDefault;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang)." ".gettime($this->lv004):$this->DateDefault;
		$lvsql="insert into sl_lv0059 (lv001,lv002,lv003,lv004,lv005,lv006,lv009,lv099) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv009','$this->lv099')";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{	
			//$this->LV_InsertDetail($this->obj_detail,$this->obj_config);
			$this->InsertLogOperation($this->DateCurrent,'sl_lv0059.insert',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_InsertTemp()
	{
		
		if($this->isAdd==0) return false;
		  $lvsql="insert into sl_lv0059 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv099) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv099')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		$this->InsertLogOperation($this->DateCurrent,'wh_lv0010.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv003 = ($this->lv003!="")?recoverdate(($this->lv003), $this->lang)." ".gettime($this->lv003):$this->DateDefault;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang)." ".gettime($this->lv004):$this->DateDefault;
		$lvsql="Update sl_lv0059 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv006='$this->lv006',lv009='$this->lv009',lv099='$this->lv099' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0059.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM sl_lv0059  WHERE sl_lv0059.lv001 IN ($lvarr) and sl_lv0059.lv008=0   ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0059.delete',sof_escape_string($lvsql));
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
		if($this->lv001!="") $strCondi=$strCondi." and lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";		
		return $strCondi;
	}
	protected function GetConditionMini()
	{
		$strCondi="";
		return $strCondi;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0059 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update sl_lv0059 set lv007='$this->lv007',lv008=lv008+1  WHERE sl_lv0059.lv001 IN ($lvarr)  and lv008<2";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 	$this->InsertLogOperation($this->DateCurrent,'sl_lv0059.approval',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isUnApr==0) return false;
		$lvsql = "Update sl_lv0059 set lv007='$this->lv007',lv008=lv008-1  WHERE sl_lv0059.lv001 IN ($lvarr) and lv008>0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0059.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_InsertDetail($obj_detail,$obj_config)
	{
		$vsql="select * from sl_lv0037";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$obj_detail->lv002=	$this->lv001;
			$obj_detail->lv003=	$vrow['lv002'];
			$obj_detail->lv007=$this->LV_GetContractMoneyDate($vrow['lv002'],$this->lv003,$this->lv004);
			$obj_detail->lv004=	$obj_detail->lv007*$obj_config->lv003/$obj_config->lv002;//diem ban
			$obj_detail->lv005=	$obj_detail->lv007*$obj_config->lv004/$obj_config->lv002;//diem giới thiệu
			$obj_detail->lv006=	$obj_detail->lv007*$obj_config->lv005/$obj_config->lv002;//diem người quản lý			
			$obj_detail->LV_Insert();
		}
	}
	function LV_GetContractMoneyDate($vContractID,$StartDate,$EndDate)
	{
		$condition1="";
		$condition2="";
		if($StartDate!="" && $StartDate!=NULL)
		{
		$condition1=$condition1." AND B.lv004>='$StartDate'";	
		$condition2=$condition2." AND B.lv009>='$StartDate'";	
		}
		if($EndDate!="" && $EndDate!=NULL)
		{
		$condition1=$condition1." AND B.lv004<='$EndDate'";	
		$condition2=$condition2." AND B.lv009<='$EndDate'";	
		}
		$lvsql="select sum(PM.lv003) money,sum(PM.lv004) convertmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv010='$vContractID' AND B.lv011=1 $condition1 )) PM ";	
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		$lvsql="select sum(PM.lv003) money,sum(PM.lv004) convertmoney from ((select sum(A.lv004*A.lv008) lv003,sum(A.lv004*A.lv008*A.lv010/100) lv004 from wh_lv0011 A inner join sl_lv0059 B on A.lv002=B.lv001  where 1=1 and B.lv003='$vContractID' AND B.lv007=1 $condition2)) PM ";	
		$vresult1=db_query($lvsql);
		$vrow1 = db_fetch_array ($vresult1);
		return $vrow['convertmoney']+$vrow['money']+$vrow1['convertmoney']+$vrow1['money'];
	}
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
		<div id=\"func_id\" style='position:relative;background:#f2f2f2'><div style=\"float:left\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</div><div style=\"float:right\">".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</div></div><div style='height:35px'></div><table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
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
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05 class=@#04>@02</td>";
		$sqlS = "SELECT * FROM sl_lv0059 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vField=$lstArr[$i];
				if($this->ArrViewEnter[$vField]==null) $this->ArrViewEnter[$vField]=0;
				switch($this->ArrViewEnter[$vField])
				{			
					case 99:
						if($this->isPopupPlus==0) $this->isPopupPlus=1;
						$vstr='<ul style="width:100%" id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onKeyUp="ChangeName(this,1)"> <li class="menupopT">
									<input class="txtenterquick" type="text" autocomplete="off" style="width:100%;min-width:30px" name="qxt'.$vField.'" id="qxt'.$vField.'" onKeyUp="LoadPopupParentTabIndex(event,this,\'qxt'.$vField.'\',\''.$this->Tables[$vField].'\',\'concat(lv002,@! @!,lv001)\')"  onKeyPress="return CheckKey(event,7)" tabindex="2" onblur="changecustomer_change(this.value)" value="'.$this->Values[$vField].'">
									<div id="lv_popup'.(($this->isPopupPlus==1)?'':$this->isPopupPlus).'" lang="lv_popup'.$this->isPopupPlus.'"> </div>						  
									</li>
								</ul>';
						$this->isPopupPlus++;
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 88:
						$vstr='<select class="selenterquick" name="qxt'.$vField.'" id="qxt'.$vField.'" tabindex="2" style="width:100%;min-width:30px" onKeyPress="return CheckKey(event,7)">'.$this->LV_LinkField($vField,$this->Values[$vField]).'</select>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 4:
						$vstr='<table><tr><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_1" type="text" id="qxt'.$vField.'_1" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:80px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;"></td><td><input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'_2" type="text" id="qxt'.$vField.'_2" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:50%;min-width:60px" onKeyPress="return CheckKey(event,7)" ></td></tr></table>';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 22:
					case 2:
						$vstr='<input class="txtenterquick"  autocomplete="off" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" maxlength="32" style="width:100%;min-width:120px" onKeyPress="return CheckKey(event,7)" ondblclick="if(self.gfPop)gfPop.fPopCalendar(this);return false;">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 0:
						$vstr='<input class="txtenterquick" name="qxt'.$vField.'" type="text" id="qxt'.$vField.'" value="'.$this->Values[$vField].'" tabindex="2" style="width:100%;min-width:50px;text-align:center;" onKeyPress="return CheckKey(event,7)">';
						$vTempEnter=str_replace("@02",$vstr,$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					default:
						$vTempEnter="<td>&nbsp;</td>";
						break;
					
				}
				$strTrEnter=$strTrEnter.$vTempEnter;
			}
		if($this->isAdd==1) 
			$strTrEnter="<tr class='entermobil'><td colspan='2'>".'<img tabindex="2" border="0" title="Tiền" class="imgButton" onclick="Save()" onmouseout="this.src=\'../images/iconcontrol/btn_addvn.jpg\';" onmouseover="this.src=\'../images/iconcontrol/btn_add_02vn.jpg\';" src="../images/iconcontrol/btn_addvn.jpg" onkeypress="return CheckKey(event,11)">'."</td>".$strTrEnter."</tr>";
		else
			$strTrEnter="<tr class='entermobil'><td colspan='2'>".'&nbsp;'."</td>".$strTrEnter."</tr>";	
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv008']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else if($vrow['lv008']==2)		$strTr=str_replace("@#04","lvlineapproval_level2",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTrEnter.$strTr,$lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportMini($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvDateSort)
	{
			
		if($lvList=="") $lvList=$this->DefaultFieldList;
		if($this->isView==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$strSort=" order by lv001 desc";
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
		<ul id=\"menu3-nav\">
			<li class=\"menusubT3\">
				<a target=\"_self\" href=\"\">
				<img style=\"position:absolute;right:0px;top:-20px\" src=\"../images/lvicon/recent_l.png\" height=\"50\" border=\"0\">
				</a>
			<ul id=\"submenu3-nav\">
				<li><table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		@#01
		</table></li>
			</ul>
			</li>
		</ul>
		";
		$lvTrH="<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input type=\"image\" class=\"btn_img_rpt\" name=\"$lvChk\"  id=\"$lvChk@03\" onclick=\"Report('@02')\" value=\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\"  tabindex=\"2\"  border=\"0\"/></td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM sl_lv0059 WHERE 1=1  ".$this->GetConditionMini()." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=="lv010")
				{
					$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($this->LV_GetBLMoney($vrow['lv001']),(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList)
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
		<div align=\"center\" class=lv0>".($this->ArrPush[0])."</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		</table>
		";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM sl_lv0059 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv008']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
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
			window.open('sl_lv0059/?lang=".$this->lang."&func='+value,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM sl_lv0059 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
	function LV_BuilListReportStartEndDate($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvEmployeeID,$lvStartDate,$lvEndDate)
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
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		if($lvEmployeeID!="" && $lvEmployeeID!=NULL) $condition=" AND lv002='$lvEmployeeID'";
		$sqlS = "SELECT * FROM sl_lv0059 WHERE 1=1 $condition ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),2));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv005':
				$vsql="select lv001,lv006 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;	
			case 'lv007':
				$vsql="select lv001,lv006 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;	
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv005':
				$vsql="select lv001,concat(lv004,' ',lv003,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,concat(lv004,' ',lv003,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
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