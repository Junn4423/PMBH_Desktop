<?php
class lv_lv0007 extends lv_controler {

	var $lv001=null;
	var $lv002=null;
	var $lv003=null;
	var $lv004=null;
	var $lv005=null;
	var $lv006=null;
	var $lv095=null;
	var $lv099=null;
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv094,lv095,lv099,lv100";	
////////////////////GetDate
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='all_gmacv3_0.lv_lv0007';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"9","lv099"=>"8","lv094"=>"10","lv095"=>"11","lv100"=>"101");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"3","lv06"=>"0","lv099"=>"0","lv007"=>"0","lv095"=>"0","lv094"=>"0","lv100"=>"0");	

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
		$this->isReset=1;
		$this->isAddPer=1;
		$this->isAddMoreRight=0;
		$this->isDelMoreRight=0;
	
		$this->lang=$_GET['lang'];
		
	}
	
	function LV_Load()
	{
		$vsql="select * from  all_gmacv3_0.lv_lv0007";
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
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv099=$vrow['lv099'];	
			$this->lv100=$vrow['lv100'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  all_gmacv3_0.lv_lv0007 Where lv001='$vlv001'";
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
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];	
			$this->lv099=$vrow['lv099'];	
			$this->lv100=$vrow['lv100'];			
		}
	}
	function Load($vlv001){
		$vsql="SELECT * FROM all_gmacv3_0.lv_lv0007 WHERE lv001='$vlv001' ;";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow){
			$this->lv001=$vrow['lv001'];
			$this->lv002=$vrow['lv002'];
			$this->lv003=$vrow['lv003'];
			$this->lv004=$vrow['lv004'];
			$this->lv005=$vrow['lv005'];
			$this->lv006=$vrow['lv006'];
			$this->lv007=$vrow['lv007'];
			$this->lv094=$vrow['lv094'];
			$this->lv095=$vrow['lv095'];
			$this->lv099=$vrow['lv099'];	
			$this->lv100=$vrow['lv100'];
		} else {
			$this->lv001=null;
			$this->lv002=null;
			$this->lv003=null;
			$this->lv004=null;
			$this->lv005=null;
			$this->lv006=null;
		}
	}

	function LV_Insert(){
		if($this->isAdd==0) return false;
		$vsql="INSERT INTO all_gmacv3_0.lv_lv0007(lv001, lv002, lv003, lv004, lv005, lv006,lv094,lv095,lv099,lv100) VALUES ('$this->lv001', '$this->lv002', '$this->lv003', '$this->lv004', '".md5($this->lv005)."', '$this->lv006','$this->lv094','$this->lv095','$this->lv099','$this->lv100') ;";
		$result=db_query($vsql);
		if($result)
		{
			$this->LV_GroupSecurityUdate($this->lv001,$this->lv003);
		}
		return $result;
	}

	function LV_Update(){
		if($this->isEdit==0) return false;
		$vsql="UPDATE all_gmacv3_0.lv_lv0007 SET lv002='$this->lv002', lv003='$this->lv003', lv004='$this->lv004',lv006='$this->lv006',lv094='$this->lv094',lv095='$this->lv095',lv099='$this->lv099',lv100='$this->lv100' WHERE lv001='$this->lv001' ;";
		$result=db_query($vsql);
		if($result)
		{
			if($this->isDelMoreRight==1) $this->LV_GroupDeleteRight($this->lv001);
			if($this->isAddMoreRight==1) $this->LV_GroupSecurityUdate($this->lv001,$this->lv003);
		}
		return $result;		
	}

	function LV_Delete($strar){
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM all_gmacv3_0.lv_lv0007 WHERE all_gmacv3_0.lv_lv0007.lv001 IN (".$strar.") and (select count(*) from all_gmacv3_0.lv_lv0008 B where B.lv002=all_gmacv3_0.lv_lv0007.lv001)<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'all_gmacv3_0.lv_lv0007.delete',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update all_gmacv3_0.lv_lv0007 set lv007=1,lv008='',lv005='1'  WHERE all_gmacv3_0.lv_lv0007.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'all_gmacv3_0.lv_lv0007.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update all_gmacv3_0.lv_lv0007 set lv007=0  WHERE all_gmacv3_0.lv_lv0007.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'all_gmacv3_0.lv_lv0007.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
//Kiem tra ton tai
	function Exist($vlv001){
		$vsql="SELECT lv001 FROM all_gmacv3_0.lv_lv0007 WHERE lv001='".$vlv001."'";
		$vresult=db_query($vsql);
		$this->isExist=db_num_rows($vresult);
		return $this->isExist;
	}
	function Getlv004($lv001)
	{
		$vsql="select  lv004 from all_gmacv3_0.lv_lv0007 where lv001='$lv001'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow)
		{
			return $trow['lv004'];
		}
		return "";
	}
	function LV_GroupDeleteRight($vUserID)
	{
		$vsql="delete from all_gmacv3_0.lv_lv0008   where lv002='$vUserID'";
		$tresult=db_query($vsql);
	}
	function LV_GroupSecurityUdate($vUserID,$vGroupID)
	{
		$vsql="select * from all_gmacv3_0.lv_lv0008 A  where A.lv002='$vGroupID'";
		$tresult=db_query($vsql);
		while($trow=db_fetch_array($tresult))
		{
			$vlv001 = InsertWithCheckExt('lv_lv0008', 'lv001', '',1);
			$vsqlc="INSERT INTO lv_lv0008(lv001, lv002, lv003, lv004) VALUES ('$vlv001', '$vUserID', '".$trow['lv003']."', '".$trow['lv004']."')";
			$cResutl = db_query($vsqlc);
			if($cResutl)
			{
				$vsqlcc="INSERT INTO lv_lv0009(lv002, lv003, lv004) SELECT lv002,'$vlv001', lv004 from all_gmacv3_0.lv_lv0009 where lv003='".$trow['lv001']."'";
				$cResutl = db_query($vsqlcc);
			}
		}
		
	}
	function GetEmployee($plang,$lv001,$vState)
	{
		$vsql="select  A.lv004,A.lv006,B.lv002 FirstName,B.lv003 MiddleName,B.lv004 LastName from all_gmacv3_0.lv_lv0007 A left join all_gmacv3_0.hr_lv0020 B on A.lv006=B.lv001 where A.lv001='$lv001'";
		$tresult=db_query($vsql);
		$trow=db_fetch_array($tresult);
		if($trow)
		{
			if($trow['lv006']==NULL || $trow['lv006']=="")
			{
				return $trow['lv004'].(($vState==1)?"":(" (".$lv001.")"));
			}
			else
			{
				if(strtoupper($plang)=="EN")
				{
					return $trow['MiddleName']." ".$trow['FirstName']." ".$trow['LastName'].(($vState==1)?"":(" (".$trow['lv006'].")"));
				}
				else
				{
					return $trow['LastName'].$trow['MiddleName']." ".$trow['FirstName']." ".(($vState==1)?"":(" (".$trow['lv006'].")"));				
				}
				
			}

		}
		return "";
	}
	public function GetBuilCheckList($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
	{
		$vListID=",".$vListID.",";
		$strTbl="<table  align=\"center\" class=\"lvtable\">
		<input type=\"hidden\" id=$vID name=$vID value=\"@#02\">
		@#01
		</table>
		";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql="select * from  ".$vTbl." where lv002='LACVIET'";
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
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",$vrow['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vrow[$vFieldView]."(".$vrow['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow['lv001'],$vTbl,$vFieldView,$i,$numrows,'');
			$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	function GetBuilCheckListChild($vListID,$vID,$vParentID,$vTbl,$vFieldView,&$i,&$numrows,$vspace)
	{
		$strGetScript="";
		$lvChk="<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH="<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>			
		</tr>
		";
		$vsql1="select * from  ".$vTbl." where lv002='".$vParentID."' order by lv003";
		$vresult1=db_query($vsql1);
		$vnum=db_num_rows($vresult1);
		$numrows=$numrows+$vnum;
		$i++;
		while($vrow1=db_fetch_array($vresult1))		
		{
			$strTempChk=str_replace("@01",$i,$lvChk);
			$strTempChk=str_replace("@02",$vrow1['lv001'],$strTempChk);
			if(strpos($vListID,",".$vrow1['lv001'].",") === FALSE)
				$strTempChk=str_replace("@03","",$strTempChk);
			else
				$strTempChk=str_replace("@03","checked=checked",$strTempChk);
			
			$strTempChk=str_replace("@04",'&nbsp;&nbsp;&nbsp;'.$vrow1['lv003'],$strTempChk);
			
			$strTemp=str_replace("@#01",$strTempChk,$lvTrH);
			$strTemp=str_replace("@#02",$vspace.'|-----'.$vrow1[$vFieldView]."(".$vrow1['lv001'].")",$strTemp);
			$strGetScript=$strGetScript.$strTemp;
			$strGetScript=$strGetScript.$this->GetBuilCheckListChild($vListID,$vID,$vrow1['lv001'],$vTbl,$vFieldView,$i,$numrows,$vspace.'&nbsp;&nbsp;&nbsp;');
			$i++;
		}
		$i--;
		return $strGetScript;
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
		$strCondi=" and lv001<>'admin' ";
		if($_SESSION['ERPSOFV2RRight']!='admin') $strCondi=$strCondi." and lv003<>'QUANLY' ";
		if($this->lv001!="") $strCondi=$strCondi." and lv001 like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002 like '%$this->lv002%'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003 like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004 like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005 like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006 like '%$this->lv006%'";
		if($this->lv099!="") $strCondi=$strCondi." and lv099 like '%$this->lv099%'";
		return $strCondi;
	}
		////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM all_gmacv3_0.lv_lv0007 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
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
		$lvTrH="<tr class=\"lvhtable\">	<td width=1% class=\"lvhtable\">".$this->ArrPush[1]."</td><td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>@#01</tr>";		$lvTr="<tr class=\"lvlinehtable@01\"><td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>	<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$sqlS = "SELECT * FROM all_gmacv3_0.lv_lv0007 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			window.open('".$this->Dir."lv_lv0007/?lang=".$this->lang."&func='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$sqlS = "SELECT * FROM all_gmacv3_0.lv_lv0007 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			case 'lv002':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.hr_lv0002";
				break;
			case 'lv003':
				$vsql="
				select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.lv_lv0004
				UNION
				select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.lv_lv0007 where lv001 not in ('admin')
				";
				break;
			case 'lv099':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  lv_lv0011";
				break;
			case 'lv094':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.lv_lv0007";
				break;
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv003':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.lv_lv0004 where lv001='$vSelectID'";
				break;
			case 'lv099':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  lv_lv0011 where lv001='$vSelectID'";
				break;
			case 'lv094':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.lv_lv0007 where lv001='$vSelectID'";
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