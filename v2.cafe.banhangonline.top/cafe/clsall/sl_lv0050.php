<?php
/////////////coding sl_lv0013///////////////
class   sl_lv0050 extends lv_controler
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
	public $lv017=null;
///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='sl_lv0013';
	public $obj_child=null;
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"2","lv005"=>"2","lv006"=>"0","lv007"=>"0","lv008"=>"0","lv009"=>"0","lv010"=>"0","lv011"=>"0","lv012"=>"0","lv013"=>"0","lv014"=>"0","lv015"=>"10","lv016"=>"0","lv017"=>"0","lv018"=>"0","lv019"=>"22","lv020"=>"0","lv021"=>"22","lv022"=>"10","lv023"=>"10","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
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
		$vsql="select * from  sl_lv0013";
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
			$this->lv017=$vrow['lv017'];
		}
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  sl_lv0013 Where lv001='$vlv001'";
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
			$this->lv017=$vrow['lv017'];
		}
	}
	function LV_Insert()
	{
		
		if($this->isAdd==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		 $lvsql="insert into sl_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.insert',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_InsertTemp()
	{
		
		if($this->isAdd==0) return false;
		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		 $lvsql="insert into sl_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017')";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;

		$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		  $lvsql="Update sl_lv0013 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv011='$this->lv011' ,lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017'  where  lv001='$this->lv001' and lv011<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM sl_lv0013  WHERE sl_lv0013.lv001 IN ($lvarr) and (select count(*) from sl_lv0014 B where  B.lv002= sl_lv0013.lv001)<=0 and  sl_lv0013.lv011<=0";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$lvsql = "Update sl_lv0013 set lv011=1,lv018='$vUserID',lv019=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.approval',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$vUserID=getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$lvsql = "Update sl_lv0013 set lv011=0,lv018='$vUserID',lv019=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0013.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'sl_lv0013.unapproval',sof_escape_string($lvsql));
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
		if($this->lv007!="")  $strCondi=$strCondi." and lv007 like '%$this->lv007%'";
		if($this->lv008!="")  $strCondi=$strCondi." and lv008 like '%$this->lv008%'";
		if($this->lv009!="")  $strCondi=$strCondi." and lv009 like '%$this->lv009%'";
		if($this->lv010!="")  $strCondi=$strCondi." and lv010 like '%$this->lv010%'";
		if($this->lv011!="")  $strCondi=$strCondi." and lv011 like '%$this->lv011%'";
		if($this->lv012!="")  $strCondi=$strCondi." and lv012 like '%$this->lv012%'";
		if($this->lv013!="")  $strCondi=$strCondi." and lv013 like '%$this->lv013%'";
		if($this->lv014!="")  $strCondi=$strCondi." and lv014 like '%$this->lv014%'";
		if($this->lv015!="")  $strCondi=$strCondi." and lv015 like '%$this->lv015%'";
		if($this->lv016!="")  $strCondi=$strCondi." and lv016 like '%$this->lv016%'";
		if($this->lv017!="")  $strCondi=$strCondi." and lv017 like '%$this->lv017%'";
		if($this->lv018!="")  $strCondi=$strCondi." and lv018 like '%$this->lv018%'";
		if($this->lv019!="")  $strCondi=$strCondi." and lv019 like '%$this->lv019%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0013 WHERE 1=1 ".$this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetContractMoney($vContractID,$vTax=0)
	{
		$lvsql="select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'  )) PM ";	
		$vresult=db_query($lvsql);
		$vrow = db_fetch_array ($vresult);
		if($vrow['convertmoney']==0)
		{
			if($vrow['money']==0) return "0";
		}		
		if($vTax!=0)
			{
				$allsum=$vrow['money'];
				if($vrow['CKTM']>0)
					return round($allsum+$vrow['money']*$vTax/100-$allsum*$vrow['CKTM']/100-$vrow['discountmoney'],0);
				else
					return round($allsum+$vrow['money']*$vTax/100-$vrow['discountmoney'],0);
			}
		else
			{
				$allsum=$vrow['money'];
				if($vrow['CKTM']>0)
					return round($allsum+$vrow['convertmoney']-$allsum*$vrow['CKTM']/100-$vrow['discountmoney'],0);
				else
					return round($allsum+$vrow['convertmoney']-$vrow['discountmoney'],0);
			}
	}	
	function LV_GetContractMoneyProduct($vContractID,$vTax=0)
	{
		$lvsql="select A.lv002,A.lv003,A.lv006,A.lv008,A.lv009,A.lv010,A.lv012 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'";
		$vresult=db_query($lvsql);
		$vsumamount=0;
		while($vrow = db_fetch_array ($vresult))
		{
			$vqty_nhap=$this->obj_child->LV_GETNHAP_TP('CONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$vqty_nhaplai=$this->obj_child->LV_GETNHAP_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$vqty_xuat=$this->obj_child->LV_GETXUAT_TP('CONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$vqty_xuatlai=$this->obj_child->LV_GETXUAT_TP('RECONTRACT',$vrow['lv002'],$vrow['lv003'],$vrow['lv010'],$vrow['lv009'],$vrow['lv012']);
			$line_sumqty= $vqty_nhap+$vqty_nhaplai-$vqty_xuat-$vqty_xuatlai;
		
		if($vTax!=0)
			$vsumamount += $line_sumqty*$vrow['lv006'] + $line_sumqty*$vrow['lv006']*$vTax/100;
		else
			$vsumamount += $line_sumqty*$vrow['lv006'] + $line_sumqty*$vrow['lv006']*$vrow['lv008']/100;
		}
		return $vsumamount;
	}	
	function LV_GETPOSITION(&$strArr,$vParentNode)
	{
		$lvsql="select lv001 Node,lv042 ParentNode,concat(lv004,' ',lv003,' ',lv002) Name,lv039 startdate,concat(lv040,' ',lv041) enddate,lv034 saletaxrate,lv010 paymenmethod,concat(lv001,'/',lv007) Image,lv045,lv046 Approval,lv030 NoContract,lv015 PersonApproval  from  sl_lv0013 Where lv001='$vParentNode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			if($vrow['lv045']<=0) return -1;
			else 
			{
				$strArr[''][$vParentNode]['ParentNode']=$vrow['ParentNode'];
				$strArr[''][$vParentNode]['Node']=$vrow['Node'];
				$strArr[''][$vParentNode]['Name']=$vrow['Name'];	
				$strArr[''][$vParentNode]['startdate']=$vrow['startdate'];
				$strArr[''][$vParentNode]['startdate']=$vrow['enddate'];
				$strArr[''][$vParentNode]['startdate']=$vrow['saletaxrate'];
				$strArr[''][$vParentNode]['startdate']=$vrow['paymenmethod'];
				$strArr[''][$vParentNode]['Image']=$vrow['Image'];
				$strArr[''][$vParentNode]['Approval']=$vrow['Approval'];
				$strArr[''][$vParentNode]['NoContract']=$vrow['NoContract'];
				$strArr[''][$vParentNode]['PersonApproval']=$vrow['PersonApproval'];
				return $vrow['lv045']+1;
			}
		}
		else
			return -1;
	}
	function LV_BuilTree($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$vParentNode)
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
		$strArr=Array();
		$strArrOrder=Array();
		$i=$this->LV_GETPOSITION($strArr,$vParentNode);
		$vstr_parentid="and (lv017=lv001 or lv017='') $strSort LIMIT $curRow, $maxRows";
		while(true)
		{
			$sqlS = "SELECT lv001 Node,lv017 ParentNode,lv002 CustomerID,lv003 Name,lv004 startdate,lv005 enddate,lv006 saletaxrate,lv007 paymenmethod,lv008 shippingmethod,lv010 EmployeeID,lv011 Approval,lv016 NoContract,lv018 PersonApproval,lv019 DateApproval,lv022 AmountPayment,IF(lv011=2,(DATEDIFF(lv005,lv021)+30),(DATEDIFF(lv005,CURDATE())+30)) NumDay FROM sl_lv0013 where 1=1 $vstr_parentid";
			$bResult = db_query($sqlS);
			$vexit=true;
			$vstr_parentid="";
			$strnode="";
			while ($vrow = db_fetch_array ($bResult)){
				if($strnode=="")
					$strnode="'".$vrow['Node']."'";
				else 
					$strnode=$strnode.",'".$vrow['Node']."'";
				$vexit=false;
				$strParentNode=($vrow['ParentNode']=="")?$vParentNode:$vrow['ParentNode'];
				$strArr[$strParentNode][$vrow['Node']]['ParentNode']=$strParentNode;
				$strArr[$strParentNode][$vrow['Node']]['Node']=$vrow['Node'];
				$strArr[$strParentNode][$vrow['Node']]['CustomerID']=$vrow['CustomerID'];
				$strArr[$strParentNode][$vrow['Node']]['Name']=$vrow['Name'];
				$strArr[$strParentNode][$vrow['Node']]['startdate']=$vrow['startdate'];
				$strArr[$strParentNode][$vrow['Node']]['enddate']=$vrow['enddate'];
				$strArr[$strParentNode][$vrow['Node']]['saletaxrate']=$vrow['saletaxrate'];
				$strArr[$strParentNode][$vrow['Node']]['paymenmethod']=$vrow['paymenmethod'];
				$strArr[$strParentNode][$vrow['Node']]['Image']=$vrow['shippingmethod'];
				$strArr[$strParentNode][$vrow['Node']]['Approval']=$vrow['Approval'];
				$strArr[$strParentNode][$vrow['Node']]['NoContract']=$vrow['NoContract'];
				$strArr[$strParentNode][$vrow['Node']]['PersonApproval']=$vrow['PersonApproval'];
				$strArr[$strParentNode][$vrow['Node']]['DateApproval']=$vrow['DateApproval'];
				$strArr[$strParentNode][$vrow['Node']]['SumContact']=$this->LV_GetContractMoney($vrow['Node'],$vrow['saletaxrate']);
				$strArr[$strParentNode][$vrow['Node']]['AmountPayment']=$vrow['AmountPayment'];
				$strArr[$strParentNode][$vrow['Node']]['SumContactProduct']=$this->LV_GetContractMoney($vrow['Node'],$vrow['saletaxrate']);
				$strArr[$strParentNode][$vrow['Node']]['NumDay']="(".$vrow['NumDay'].")";
				
			}
			$vstr_parentid=" AND lv017 in ($strnode)";
			if($vexit==true)break;
			$i++;
		}
	echo	$lvTable="
		<table  align=\"center\" class=\"lvtable\">
		<tr><td align=left>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		<tr><td>
		";
	echo '<ul class="treeview">
			<li class="collapsable lastCollapsable">';
		$str_col="CONTRACT";
			echo "<div class='$trclassimg' >".$str_col."</div>";
			$this->LV_LOOPTREE($strArr,$vParentNode,$lstArr);
	echo '	</li>
		</ul>
			</td></tr>
		</table>
		';
	}
	function LV_LOOPTREE($strArr,$vNode,$lstArr)
	{
		if($vNode==NULL) return ;
		if($strArr[$vNode]==NULL) return;
		echo '<ul lang="ul">';
		$i=count($strArr[$vNode]);
		$strdislplay="";
		foreach($strArr[$vNode] as $view)
		{
			$strcolor="";
			if($view["Approval"]==1 || $view["Approval"]==2)
			{ 
				if($view["Approval"]==2)
				{
					$strcolor='style="color:green"';
					$str_col="";
				}
				else
				{  
					$strcolor='style="color:red"';
					if($this->isApr==1 || $this->isUnApr==1)
					{
						$str_col="<input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckAprUnApr(this, '@02')\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\" checked=\"checked\" />";
					}
						else if ($this->isApr==1) 
					{
						$str_col="<input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckAprUnApr(this, '@02')\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\" checked=\"checked\" disabled=\"\"/>";
					}
					else if($this->isUnApr==1)
					{
						$str_col="<input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckAprUnApr(this, '@02')\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\" checked=\"checked\"/>";
					}
					else
					{
						$str_col="";
					}
				}
				
			}
			else
			{
			if($this->isApr==1 || $this->isUnApr==1)
				{
					$str_col="<input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckAprUnApr(this, '@02')\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"   />";
				}
					else if ($this->isApr==1) 
				{
					$str_col="<input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckAprUnApr(this, '@02')\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\" />";
				}
				else if($this->isUnApr==1)
				{
					$str_col="<input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckAprUnApr(this, '@02')\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\" disabled=\"\"/>";
				}
				else
				{
					$str_col="";
				}
			}
			$str_col=$str_col."<input type=\"image\" class=\"btn_img_rpt\" name=\"lvChk\" id=\"lvChk1\" onclick=\"Report('@02')\" value=\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\" tabindex=\"2\" border=\"0\">";
			$str_col=str_replace("@02",$view['Node'], $str_col);
			
			$i=$i-1;
			if($strArr[$view['Node']]==NULL) 
				echo '<li>';
			else
			{
				$strdislplay='onclick="viewdisplay1(this)" style="cursor:pointer"';
				if($i==0)
					echo '<li class="collapsable lastCollapsable" >';
				else
					echo '<li class="collapsable" >';
				
				echo '<div class="hitarea collapsable-hitarea" onclick="viewdisplay(this)"></div>';
			}
			
			$trclassimg="";
			for($i=0;$i<count($lstArr);$i++)
			{
				
				
					if($str_col=="")
					$str_col=$str_col.$this->FormatView($view[$this->ArrGetLink[$lstArr[$i]]],(int)$this->ArrView[$lstArr[$i]]);
					else
					$str_col=$str_col." - ".$this->FormatView($view[$this->ArrGetLink[$lstArr[$i]]],(int)$this->ArrView[$lstArr[$i]]);
				
			}
			echo '<div class="'.$trclassimg.'" '.$strdislplay.' style="min-width:350px"><a href="javascript:ViewContract(\''.$view['Node'].'\')"><font '.$strcolor.' id="color_'.$view['Node'].'">'.$str_col.'</font></a></div>';
			$this->LV_LOOPTREE($strArr,$view['Node'],$lstArr);
			echo '	</li>';
		}
		echo '</ul>';
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
		$lvTr="<tr class=\"lvlinehtable@01\"><td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>	<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>@#01</tr>";
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td align=@#05>@02</td>";
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT * FROM sl_lv0013 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$lvTd);
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	public function CheckListFilter($vListID,$vID,$vTabIndex,$vTbl,$vFieldView='lv002')
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
		$vsql="select * from  ".$vTbl;
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
						$i++;
			
		}
	 $strReturn=str_replace("@#01",$strGetScript,str_replace("@#02",$numrows,$strTbl));
	 return $strReturn;
	}
	public function GetMonthStartEnd($vStartDate,$vEndDate)
	{
		$vCount=0;
		$vStartMonth=getmonth($vStartDate);
		$vStartYear=getyear($vStartDate);
		$vSDate=getday($vStartDate);
		
		$vEndMonth=getmonth($vEndDate);
		$vEndYear=getyear($vEndDate);
		$vEDate=getday($vEndDate);
		if($vStartYear==$vEndYear)
		{
			$vCount= ($vEndMonth-$vStartMonth);
		}
		else
		{
			for($i=$vStartYear;$i<=$vEndYear;$i++)
			{
				if($i==$vStartYear)
				{
					$vCount=$vCount+12-$vStartMonth;				
				}
				else if($i==$vEndYear)
				{
					$vCount=$vCount+$vEndMonth;
				}
				else
				{
					$vCount=$vCount+12;				
				}
				
			}
		}
		if((int)$vEDate-(int)$vSDate>15) $vCount++;
		return $vCount;
		
	}
/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom,$lvList,$maxRows)
	{
		if($lvList=="") $lvList=$this->DefaultFieldList;
		$lvList=",".$lvList.",";
		$lstArr=explode(",",$this->DefaultFieldList);
		$lvSelect="<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\"> 
						<li class=\"menusubT1\"><img src=\"../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[12]."
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript="		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('sl_lv0013/?lang=".$this->lang."&func='+value,'','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
						<li class=\"menusubT\"><img src=\"../images/lvicon/config.png\" border=\"0\" class=\"lv_funcshowimg\"/><span class=\"lv_funcshowtext\">".$this->ArrFunc[11]."</span>
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
		$lvImg="<td  ><img name=\"imgView\" border=\"0\" style=\"border-color:#CCCCCC\" title=\"\" alt=\"Image\" width=\"96px\" height=\"128px\" src=\"../../../images/employees/@01/@02\" /></td>";
		$sqlS = "SELECT * FROM sl_lv0013 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
				if($lstArr[$i]=='lv007')
				{
					$vTemp=str_replace("@02",$vrow[$lstArr[$i]],str_replace("@01",$vrow['lv001'],$lvImg));

				}
				else
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
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0008";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054";
				break;
			case 'lv012':
				if($this->lv002!="")
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 where lv002='$this->lv002'";
				else
					$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 ";
				break;
			case 'lv015':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0016";
				break;
			case 'lv017':
				$vsql="select lv001,concat(lv003,' - ',lv016) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0013";
				break;
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 where lv001='$vSelectID'";
				break;
			case 'lv007':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0008 where lv001='$vSelectID'";
				break;
			case 'lv011':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054 where lv001='$vSelectID'";
				break;
			case 'lv012':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 where lv002='$this->lv002'";
				break;
			case 'lv017':
				$vsql="select lv001,concat(lv003,' - ',lv016) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0013 where lv002='$this->lv002'";
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