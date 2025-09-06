<?php
/////////////coding wh_lv0011///////////////
class   sl_lv0025 extends lv_controler
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
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv014,lv015,lv016,lv021";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='wh_lv0011';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv021"=>"22");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"1","lv005"=>"0","lv006"=>"1","lv007"=>"0","lv008"=>"10","lv009"=>"0","lv010"=>"10","lv011"=>"10","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"0","lv016"=>"2","lv021"=>"1");	

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
	
		$this->isApr=0;		
		$this->isUnApr=0;
		$this->lang=$_GET['lang'];
		
	}
	protected function LV_CheckLock()
	{
		$lvsql="select lv007 from wh_lv0010 B where  B.lv001='$this->lv002'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv007']>=1)
			{
				$this->isAdd=0;	
				$this->isEdit=0;	
				$this->isDel=0;	
			}
		}
		
	}
	function LV_Load()
	{
		$vsql="select * from  wh_lv0011";
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
			$this->lv016=$vrow['lv016'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  wh_lv0011 Where lv001='$vlv001'";
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
			$this->lv016=$vrow['lv016'];
		}
	}
	function LV_Insert()
	{
		
		
		if($this->isAdd==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		$lvsql="insert into wh_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016')";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$this->CheckChild($this->lv003,$this->GetParentWH($this->lv002));
			$tsql="Update wh_lv0012 set lv004=lv004-$this->lv004,lv006=lv006-$this->lv006 where lv002='$this->lv003' and lv003 in (select C.lv002 from wh_lv0010 C where C.lv001='$this->lv002')";
			if(db_query($tsql)) $this->InsertLogOperation($this->DateCurrent,'wh_lv0012.Update',sof_escape_string($tsql));
		 	$this->InsertLogOperation($this->DateCurrent,'wh_lv0011.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_InsertTemp($vTemID,$vlv002)
	{
		$lvsql="select '$vTemID' lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016 from wh_lv0031 where lv002='$vlv002'";
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
			$this->LV_Insert();
		}
		if($vReturn) $this->LV_DeleteTemp($vlv002);
		return $vReturn;
	}
	function LV_DeleteTemp($vlv002)
	{
		$lvsql = "DELETE FROM wh_lv0031  WHERE wh_lv0031.lv002='$vlv002'";
		$vReturn= db_query($lvsql);
		return $vReturn;
	}	
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		//$this->lv015 = ($this->lv015!="")?recoverdate(($this->lv015), $this->lang):$this->DateDefault;
		  $lvsql="Update wh_lv0011 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0011.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateEdit($vOldlv004,$vOldlv006)
	{
		if($this->isEdit==0) return false;
		if(!$this->LV_CheckLocked($this->lv002)) return false;
		$vlv003=$this->GetParentWH($this->lv002);
		  $lvsql="Update wh_lv0011 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016' where  lv001='$this->lv001';";
		$vReturn= db_query($lvsql);
		if($vReturn){
			$vsql1="update wh_lv0012 set lv004=lv004-($this->lv004-$vOldlv004),lv006=lv006-($this->lv006-$vOldlv006) where lv002='$this->lv003' and lv003='".$vlv003."'";
			if(	db_query($vsql1)) $this->InsertLogOperation($this->DateCurrent,'wh_lv0011.update',sof_escape_string($vsql1));
		 $this->InsertLogOperation($this->DateCurrent,'wh_lv0011.update',sof_escape_string($lvsql));
		 
		 }
		return $vReturn;
	}
	function LV_CheckLocked($vlv002)
	{
		$lvsql="select lv007 from  wh_lv0010 Where lv001='$vlv002'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['lv007']<=0) 
					return true;
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
		$lvsql = "DELETE FROM wh_lv0011  WHERE wh_lv0011.lv001 IN ($lvarr) and (select lv007 from wh_lv0010 B where  B.lv001= wh_lv0011.lv002)<=0  ";
		$vReturn= db_query($lvsql);
		if($vReturn) {
			
			$this->InsertLogOperation($this->DateCurrent,'wh_lv0011.delete',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_DeleteDetail($lvarr)
	{
		$sqlD = "SELECT A.lv001 lv001,A.lv002 lv002,A.lv003 lv003,A.lv004 lv004,A.lv006 lv006,B.lv002 lvb002 FROM wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 WHERE A.lv001 IN ($lvarr) and (select lv007 from wh_lv0010 B where  B.lv001= A.lv002)<=0;";
		$vresult=db_query($sqlD);
		$strReturn=false;
		while($vrow=db_fetch_array($vresult))
		{
			
			 $vsql="update wh_lv0012 set lv004=lv004+".$vrow['lv004'].",lv006=lv006+".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
			if(db_query($vsql))
			{
				$tsql="delete from wh_lv0011 where lv001='".$vrow['lv001']."'";
				if(db_query($tsql))
				{
					$strReturn= true;
				}
				else
				{
					$vsql="update wh_lv0012 set lv004=lv004-".$vrow['lv004'].",lv006=lv006-".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
					db_query($vsql);
					$strReturn= false;
				}
				
			}	
			
		}
		return $strReturn;
	}
	function DeleteOrther($strar)
	{
		$sqlD = "SELECT A.*,B.lv002 lvb002 FROM wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 WHERE B.lv007<=0;";
		$vresult=db_query($sqlD);
		$strReturn=false;
		while($vrow=db_fetch_array($vresult))
		{
			$vsql="update wh_lv0012 set lv004=lv004+".$vrow['lv004'].",lv006=lv006+".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
			if(db_query($vsql))
			{
				$tsql="delete from wh_lv0011 where lv001='".$vrow['lv001']."'";
				if(db_query($tsql))
				{
					$strReturn= true;
				}
				else
				{
					$vsql="update wh_lv0012 set lv004=lv004-".$vrow['lv004'].",lv006=lv006-".$vrow['lv006']." where lv002='".$vrow['lv003']."' and lv003='".$vrow['lvb002']."'";
					db_query($vsql);
					$strReturn= false;
				}
				
			}
		}
		return $strReturn;

	}
	function CheckChild($vlv002,$vlv003)
	{
		$sqlD = "SELECT count(*) nums FROM wh_lv0012 WHERE lv002='$vlv002' and lv003='$vlv003'";
		$vresult=db_query($sqlD);
		if($vresult){
			$vrow=db_fetch_array($vresult);
			if($vrow['nums']<=0)
			{
				$lvsql="insert into wh_lv0012 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013) values('$vlv002','$vlv003','0','$this->lv005','0','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013')";
				db_query($lvsql);	
			}
		}
	}
	function GetParentWH($vlv001)
	{
		$sqlD = "SELECT lv002 FROM wh_lv0010 WHERE lv001='$vlv001' ";
		$vresult=db_query($sqlD);
		if($vresult){
			$vrow=db_fetch_array($vresult);
			return $vrow['lv002'];
		}
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
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 like '%$this->lv015%'";
		$strwh=$this->Get_WHControler();
		$strCondi=$strCondi." and lv002 like 'BH-%'"." and lv002 in (select B.lv001 from wh_lv0010 B where B.lv002 in ($strwh))";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM wh_lv0011 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
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
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM wh_lv0011 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=="lv021")
				{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				}
				else
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
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
			window.open('".$this->Dir."sl_lv0025/?lang=".$this->lang."&childdetailfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$sqlS = "SELECT * FROM wh_lv0011 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
		$sqlS = "SELECT * FROM wh_lv0011 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		$strSubTotal=0;
		$strSubTax=0;
		$strTotalAmount=0;
		$vUnitPrice="VNĐ"; 
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
				if($lstArr[$i]=="lv021")
				{
					if($vTax>0 || $vTax==-1 )
					{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
					else
					{
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv011']/100,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
					}
				}
				else
					$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])).(($lstArr[$i]=='lv010'|| $lstArr[$i]=='lv011')?'%':''),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$vUnitPrice=$this->getvaluelink('lv007',$this->FormatView($vrow['lv007'],(int)$this->ArrView[$vrow['lv007']]));
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vTax>0 || $vTax==-1 )
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv011']/100;
			}
			else
			{
				$strSubTotal=$strSubTotal+$vrow['lv004']*$vrow['lv008']+$vrow['lv004']*$vrow['lv008']*$vrow['lv010']/100-$vrow['lv004']*$vrow['lv008']*$vrow['lv011']/100;
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
	public function LV_LinkFieldExt($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlconditionext($vFile,$vSelectID),1));
	}
	private function sqlconditionext($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from   all_gmacv3_0.sl_lv0007 where 1=1 and lv015>=0 and lv016 ='$vSelectID' order by lv001 asc";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			case 'lv012':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv013':
				$vsql="select lv001,concat(lv001,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  ac_lv0002";
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0036";
				break;
		}
		return $vsql;
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from   all_gmacv3_0.sl_lv0007 where 1=1 and lv015>=0";
				break;
			case 'lv005':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			case 'lv014':
				$vsql="select A.lv001,A.lv001 lv002,0 lv003,concat(A.lv006,' - ',A.lv005)  lv004,(select sum(B.lv004) from wh_lv0031 B where B.lv002='".getInfor($_SESSION['ERPSOFV2RUserID'],2)."' and B.lv003=A.lv002 and B.lv014=A.lv001 ) QuantityUsed from  wh_lv0020 A where A.lv002='$vSelectID' order by lv004";
				$lvResult = db_query($vsql);
				$vsql="";
				while($row= db_fetch_array($lvResult)){
					$slt=0;
					$vsltused=(float)$row['QuantityUsed'];
					$slt=$this->objlot->LV_Get_slt_lot($row['lv001'],$vSelectID,$this->objlot->lv003);
					$slt=$slt-$vsltused;
					if($slt>0)
					{
						if($vsql=="")
							$vsql=$vsql."select '".$row['lv001']."' lv001,'Slt: ".$this->FormatView($slt,10)." - S-C: ".($row['lv004'])."' lv002,0 lv003";
						else
							$vsql=$vsql." UNION select '".$row['lv001']."' lv001,'Slt: ".$this->FormatView($slt,10)." - S-C: ".($row['lv004'])."' lv002,0 lv003";
					}	
				}
				break;
			case 'lv017':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0036";
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from all_gmacv3_0.sl_lv0005 where lv001='$vSelectID'";
				break;
			case 'lv009':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";
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