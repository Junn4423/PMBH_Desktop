<?php
/////////////coding wh_lv0004///////////////
class   wh_lv0004 extends lv_controler
{
	public $lv001=null;
	public $lv002=null;
	public $lv003=null;
	public $lv004=null;
	public $lv005=null;
	public $lv006=null;
	public $lv007=null;

///////////
	public $DefaultFieldList="lv001,lv002,lv003,lv004,lv005,lv006,lv007";	
////////////////////GetDate
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	protected $objhelp='wh_lv0004';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"0","lv005"=>"4","lv006"=>"0","lv007"=>"0");	

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
		$vsql="select * from  wh_lv0004";
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
	function LV_LoadGroupSanPham($vWhID,&$strthanh,&$strsanpham,&$i,$widthsp="67%",$widthgroup="32%")
	{
		//$vWhID='KHOTONG';
		$lsItem=$this->LV_GetWHSanPham($vWhID);
		$lsGroup=$this->LV_GetNhomSanPham($lsItem);
		if($vWhID!='')
		{
			if($lsItem=='') $lsItem="''";
			if($lsGroup=='') $lsGroup="''";
		}
		$strthanh="";
		$strsanpham='<div style="width:'.$widthsp.';float:left;overflow: auto;height:400px;padding:0px!important"  class="thanhprocess">
							<div style="padding:5px" >';
							$i=0;
							if($lsGroup=='')
								$vsql="select * from  all_gmacv3_0.sl_lv0006 where  lv004=0 and (ISNULL(lv003) or lv003='' or lv001=lv003) order by lv005 asc";
							else
								$vsql="select * from  all_gmacv3_0.sl_lv0006  where lv001 in ($lsGroup) and  lv004=0 and (ISNULL(lv003) or lv003='' or lv001=lv003) order by lv005 asc";
							
							$vresultparent=db_query($vsql);
							while($vrowparent=db_fetch_array($vresultparent))
							{
								$i++;
								$strthanh=$strthanh.'<div id="thanhthus_'.$i.'" onclick="viewthanhthu('.$i.')" class="thanhcon '.(($i==1)?'conactive':'').'" style="text-transform:none!important">'.$vrowparent['lv001'].'</div>';
								$strsanpham=$strsanpham.'<div id="thanhthu_'.$i.'" style="clear:both;'.(($i==1)?'display:block':'display:none').'">';						
								$vsql="select distinct * from  all_gmacv3_0.sl_lv0006 where (lv003='".$vrowparent['lv001']."') or ( lv001='".$vrowparent['lv001']."' and (ISNULL(lv003) or lv003='')) and lv004=0 order by lv005 asc";
								$vresult=db_query($vsql);
								while($vrow=db_fetch_array($vresult))
								{
									$strsanpham=$strsanpham.'<div style="float:left;width:97%">
										<div class="groupcafe" style="padding:5px 0px 5px 0px!important;width:auto!important">'.$vrow['lv002'].'</div>
										<div>
											<ul class="ulfix" style="padding:0px;margin:0px;">';
											if($lsItem=='')
												$vsql1="select * from  all_gmacv3_0.sl_lv0007 where lv003='".$vrow['lv001']."'  order by lv010,lv002 asc";
											else
												$vsql1="select * from  all_gmacv3_0.sl_lv0007 where lv003='".$vrow['lv001']."' and lv001 in ($lsItem) order by lv010,lv002 asc";
											$vresult1=db_query($vsql1);
											$vWidth=$lvsl_lv0070->lv006;
											while($vrow1=db_fetch_array($vresult1))
											{
												$strsanpham=$strsanpham.'<li style="float:left"><div style="position:relative;" onclick="AddProd(\''.$vrow1['lv001'].'\')" class="buttonClass">';
												
												if($lvsl_lv0070->lv010==1 && $vrow1['lv014']!="")
												{
												$strsanpham=$strsanpham.'<img style="width:'.$vWidth.'px;position:absolute;top:0px;left:0px" src="'.$vrow1['lv014'].'"/>';
												
												}
												$strsanpham=$strsanpham.'<span style="text-transform:none!important"  style="margin-left:'.$vWidth.'px;">'.$vrow1['lv002'].'</span></div></li>';
											}
											
											$strsanpham=$strsanpham.'</ul>
										</div>
									</div>';
								}
								$strsanpham=$strsanpham.'</div>';
							}
							$strsanpham=$strsanpham.'</div></div>';
							$strthanh='<div class="thanhnhom" style="float:left;width:'.$widthgroup.';overflow: auto;height:400px"><div style="padding:5px"><input type="hidden" id="txttongthanh" value="'.$i.'"/>'.$strthanh.'</div></div>';
	}
	function LV_GetContractMoney($vInvoiceID,$vopt=0)
	{
		switch($vopt)
		{
			case 6:
				$vField="lv006";
				break;
			case 10:
				$vField="lv010";
				break;
			default:
				$vField="lv008";
				break;
		}
		$lvsql = "select sum(A.$vField) SumMoney from wh_lv0005 A  WHERE A.lv002 = '$vInvoiceID'";
		$vReturnArr=array();
		$lvResult= db_query($lvsql);
		$row= db_fetch_array($lvResult);
		return $row['SumMoney'];
	}
	function LV_GetWHSanPham($vWhID)
	{
		$vReturn="";
		if($vWhID=='')
			return '';
		else
			$vsql="select distinct lv002 from wh_lv0012 where lv003='$vWhID'";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vReturn=="")
				$vReturn="'".$vrow['lv002']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv002']."'";
		}
		return $vReturn;
	}
	function LV_GetNhomSanPham($vListItem)
	{
		$vReturn="";
		if($vListItem=='')
			return '';
		else
			$vsql="select distinct lv003 from  all_gmacv3_0.sl_lv0007 where lv001 in ($vListItem)";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vReturn=="")
				$vReturn="'".$vrow['lv003']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv003']."'";
		}
		$vGroup=$this->LV_GetParentNhomSanPham($vReturn);
		if($vGroup!="") $vReturn=$vReturn.",".$vGroup;
		
		return $vReturn;
	}
	function LV_GetParentNhomSanPham($vGroupItem)
	{
		$vsql="select distinct lv003 from  all_gmacv3_0.sl_lv0006 where lv001 in ($vGroupItem)";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vReturn=="")
				$vReturn="'".$vrow['lv003']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv003']."'";
		}
		return $vReturn;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  wh_lv0004 Where lv001='$vlv001'";
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
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$vDateInventory=$this->lv005;
		 $lvsql="insert into wh_lv0004 (lv001,lv002,lv003,lv004,lv005,lv006,lv007) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		$this->LV_InsertOther($this->lv001,$this->lv002,$vDateInventory,$vDateInventory);
		 $this->InsertLogOperation($this->DateCurrent,'wh_lv0004.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}	
	function LV_InsertAuto()
	{
		if($this->isAdd==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		$vDateInventory=$this->lv005;
		 $lvsql="insert into wh_lv0004 (lv001,lv002,lv003,lv004,lv005,lv006,lv007) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007')";
		$vReturn= db_query($lvsql);
		if($vReturn){
		 $this->InsertLogOperation($this->DateCurrent,'wh_lv0004.insert',sof_escape_string($lvsql));
		 }
		return $vReturn;
	}
	function LV_InsertOther($vlv002,$vlv003,$vDateStart,$vDateEnd)
	{
		if($this->isAdd==0) return false;
		 $lvsql="DELETE FROM wh_lv0005  where lv002='$vlv002'";
		 $vReturn= db_query($lvsql);
		 $lvsql="insert into wh_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007,lv009,lv011) select '$vlv002',MP.lv002,if(ISNULL(ReReceiptQty),0,ReReceiptQty)-if(ISNULL(ReOutlv004),0,ReOutlv004)+if(ISNULL(InReceiptQty),0,InReceiptQty)-if(ISNULL(InOutlv004),0,InOutlv004) sl1,MP.lv005,if(ISNULL(ReReceiptQty),0,ReReceiptQty)-if(ISNULL(ReOutlv004),0,ReOutlv004)+if(ISNULL(InReceiptQty),0,InReceiptQty)-if(ISNULL(InOutlv004),0,InOutlv004) sl2,MP.lv007,MP.lv005,MP.lv005 from (select A.*,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=A.lv002 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009<'$vDateStart 00:00:00' and A11.lv002='$vlv003')) ReReceiptQty,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=A.lv002 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009>='$vDateStart 00:00:00' and A11.lv009<='$vDateEnd 23:59:59' and A11.lv002='$vlv003')) InReceiptQty,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=A.lv002 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009<'$vDateStart 00:00:00' and A21.lv002='$vlv003')) ReOutlv004 ,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=A.lv002 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009>='$vDateStart 00:00:00' and A21.lv009<='$vDateEnd 23:59:59' and A21.lv002='$vlv003')) InOutlv004   from wh_lv0012 A inner join  all_gmacv3_0.sl_lv0007 B on A.lv002=B.lv001 where A.lv003='$vlv003'  and B.lv015>=0 ) MP";
		 $vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0005.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_InsertOnces($vlv002,$vlv003,$vDateStart,$vDateEnd,$vItemID,$vSl,$vUnitID)
	{
		if($this->isAdd==0) return false;
		$lvsql="insert into wh_lv0005 (lv002,lv003,lv004,lv005,lv006,lv007,lv009,lv011,lv008) 
		select '$vlv002',MP.lv001,if(ISNULL(ReReceiptQty),0,ReReceiptQty)-if(ISNULL(ReOutlv004),0,ReOutlv004)+if(ISNULL(InReceiptQty),0,InReceiptQty)-if(ISNULL(InOutlv004),0,InOutlv004) sl1,MP.lv004,if(ISNULL(ReReceiptQty),0,ReReceiptQty)-if(ISNULL(ReOutlv004),0,ReOutlv004)+if(ISNULL(InReceiptQty),0,InReceiptQty)-if(ISNULL(InOutlv004),0,InOutlv004) sl2,MP.lv004,MP.lv004,MP.lv008,'$vSl' from (select B.*,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=B.lv001 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009<'$vDateStart 00:00:00' and A11.lv002='$vlv003')) ReReceiptQty,(select sum(A1.lv004) from wh_lv0009 A1 where A1.lv003=B.lv001 and A1.lv002 IN (select A11.lv001 from wh_lv0008 A11 Where A11.lv009>='$vDateStart 00:00:00' and A11.lv009<='$vDateEnd 23:59:59' and A11.lv002='$vlv003')) InReceiptQty,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=B.lv001 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009<'$vDateStart 00:00:00' and A21.lv002='$vlv003')) ReOutlv004 ,(select sum(A2.lv004) from wh_lv0011 A2 where A2.lv003=B.lv001 and A2.lv002 IN (select A21.lv001 from wh_lv0010 A21 Where A21.lv009>='$vDateStart 00:00:00' and A21.lv009<='$vDateEnd 23:59:59' and A21.lv002='$vlv003')) InOutlv004  from   all_gmacv3_0.sl_lv0007 B where B.lv001='$vItemID'  and B.lv015>=0 ) MP";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0005.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if($this->isEdit==0) return false;
		$this->lv005 = ($this->lv005!="")?recoverdate(($this->lv005), $this->lang):$this->DateDefault;
		  $lvsql="Update wh_lv0004 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006' where  lv001='$this->lv001' AND lv007<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->LV_InsertOther($this->lv001,$this->lv002);
		$this->InsertLogOperation($this->DateCurrent,'wh_lv0004.update',sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM wh_lv0004  WHERE wh_lv0004.lv007<=0 AND wh_lv0004.lv001 IN ($lvarr) ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0004.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_AprovalMain($lvarr)
	{
		if($this->isAdd==0) return false;
		//$lvsql = "Update wh_lv0004 set lv007=IF(lv007>1,2,lv007+1)  WHERE wh_lv0004.lv001 IN ($lvarr)  ";
		$lvsql = "Update wh_lv0004 set lv007=2,lv005=now()  WHERE wh_lv0004.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) {$this->InsertLogOperation($this->DateCurrent,'wh_lv0004.approval',sof_escape_string($lvsql));
			$lvarr=str_replace("'","",$lvarr);
			$vArrGet=explode(",",$lvarr);
			for($i=0;$i<count($vArrGet);$i++)
			{
				$vCountTC=$this->LV_CheckKhoActive($vArrGet[$i],$vActive);
				if($vCountTC==0 && $vActive==2) $this->LV_InStock_OutStock($vArrGet[$i],getInfor($this->UserID,2));
			}
		}
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update wh_lv0004 set lv007=IF(lv007>1,2,lv007+1)  WHERE wh_lv0004.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) {$this->InsertLogOperation($this->DateCurrent,'wh_lv0004.approval',sof_escape_string($lvsql));
			$lvarr=str_replace("'","",$lvarr);
			$vArrGet=explode(",",$lvarr);
			for($i=0;$i<count($vArrGet);$i++)
			{
				$vCountTC=$this->LV_CheckKhoActive($vArrGet[$i],$vActive);
				if($vCountTC==0 && $vActive==2) $this->LV_InStock_OutStock($vArrGet[$i],getInfor($this->UserID,2));
			}
		}
		return $vReturn;
	}	
	function LV_CheckKhoActive($vInventoryID,&$vActive)
	{
		$vsql="
		select count(*) nums,(select B.lv007  from wh_lv0004 B where B.lv001='$vInventoryID') Actives from (select lv001 from wh_lv0008 where lv005='KIEMKHO' and lv006='$vInventoryID'
		UNION
		select lv001 from wh_lv0010 where lv005='KIEMKHO' and lv006='$vInventoryID') MP
		";
		
		$bResultC = db_query($vsql);
		$arrRowC = db_fetch_array($bResultC);
		$vActive=$arrRowC['Actives'];
		return $arrRowC['nums'];
	}
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update wh_lv0004 set lv007=IF(lv007<1,0,lv007-1)  WHERE wh_lv0004.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'wh_lv0004.unapproval',sof_escape_string($lvsql));
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
	function LV_InStock_OutStock($vlv001,$vEmpID)
	{
		$vDate=GetServerDate();
		$lvWHID=$this->LV_GETWH($vlv001);
		if($lvWHID!='')
		{	
			$vCondition="select count(*) num from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)>0";
			if($this->LV_CheckSQL($vCondition))
				{
					$vNow=substr($this->DateCurrent,0,10);
					$vlv002='PNKDC-'.getyear($vNow).getmonth($vNow).getday($vNow).rand(0,9).rand(100,999);//InsertWithCheck('wh_lv0008', 'lv001', 'PNKDC-'.getmonth($vDate)."/".getyear($vDate)."-",1);
					$lvsql="insert into wh_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009)   values('$vlv002','$lvWHID','$vEmpID','Inventory adjustments','KIEMKHO','$vlv001',0,'KIEMKHO',concat('$vDate',' ',curtime()))";
					$vReturn= db_query($lvsql);
					if($vReturn)
					{
					$this->mowh_lv0009->LV_InsertTempInventory($vlv002,$vlv001,$lvWHID);
					$lvsql1="update wh_lv0008 set lv007=1 where lv001='$vlv002'";
					$vReturn= db_query($lvsql1);
					/* $lvsql="insert into wh_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) select '$vlv002',lv003,lv008-lv006,lv005,lv008-lv006,lv005,0,'',0,'','156','3381','',lv012,'$vDate' from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)>0";
					 $sql="select lv003 item,lv008-lv006 quantity,lv005 unit from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)>0";
					  $vReturnTmp= db_query($sql);
					 ///getRow;
					   $vReturn= db_query($lvsql);
					   if($vReturn)
					   	{
							while($vrow = db_fetch_array ($vReturnTmp))
							{
							 $lvsql="update wh_lv0012 set lv004=lv004+".$vrow['quantity'].",lv006=lv006+".$vrow['quantity']." where lv002='".$vrow['item']."' and lv003='".$lvWHID."'";
							db_query($lvsql);
							}
						}
					*/
					  }
				}
			$vCondition="select count(*) num from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)<0";
			if($this->LV_CheckSQL($vCondition))
				{
				$vlv002=InsertWithCheck('wh_lv0010', 'lv001', 'PXKDC-'.getmonth($vDate)."/".getyear($vDate)."-",1);
				$lvsql="insert into wh_lv0010 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009)   values('$vlv002','$lvWHID','$vEmpID','Inventory adjustments','KIEMKHO','$vlv001',0,'KIEMKHO',concat('$vDate',' ',curtime()))";
				 $vReturn= db_query($lvsql);
				if($vReturn)
					{
						$this->mowh_lv0011->LV_InsertTempInventory($vlv002,$vlv001,$lvWHID);
						$lvsql1="update wh_lv0010 set lv007=1 where lv001='$vlv002'";
						$vReturn= db_query($lvsql1);
					 /*$lvsql="insert into wh_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) select '$vlv002',lv003,lv006-lv008,lv005,lv006-lv008,lv005,0,'',0,'','156','3381','',lv012,'$vDate' from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)<0";
					    $sql="select lv003 item,lv006-lv008 quantity,lv005 unit from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)<0";
					  $vReturnTmp= db_query($sql);
					 ///getRow;
					   $vReturn= db_query($lvsql);
					   if($vReturn)
					   	{
							while($vrow = db_fetch_array ($vReturnTmp))
							{
							 $lvsql1="update wh_lv0012 set lv004=lv004-".$vrow['quantity'].",lv006=lv006-".$vrow['quantity']." where lv002='".$vrow['item']."' and lv003='".$lvWHID."'";
							db_query($lvsql1);
							}
						}
					*/
					 }
				}
		 
		}
		return true;
		
	}
	function LV_InStock_OutStockOld($vlv001,$vEmpID)
	{
		$vDate=GetServerDate();
		$lvWHID=$this->LV_GETWH($vlv001);
		if($lvWHID!='')
		{	
			$vCondition="select count(*) num from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)>0";
			if($this->LV_CheckSQL($vCondition))
				{
				 $vlv002=InsertWithCheck('wh_lv0008', 'lv001', 'PNKDC-'.getmonth($vDate)."/".getyear($vDate)."-",1);
				 $lvsql="insert into wh_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009)   values('$vlv002','$lvWHID','$vEmpID','Inventory adjustments','KIEMKHO','$vlv001',0,'KIEMKHO','$vDate')";
				 $vReturn= db_query($lvsql);
				if($vReturn)
					{
					 $lvsql="insert into wh_lv0009 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) select '$vlv002',lv003,lv008-lv006,lv005,lv008-lv006,lv005,0,'',0,'','156','3381','',lv012,'$vDate' from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)>0";
					 $sql="select lv003 item,lv008-lv006 quantity,lv005 unit from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)>0";
					  $vReturnTmp= db_query($sql);
					 ///getRow;
					   $vReturn= db_query($lvsql);
					   if($vReturn)
					   	{
							while($vrow = db_fetch_array ($vReturnTmp))
							{
							 $lvsql="update wh_lv0012 set lv004=lv004+".$vrow['quantity'].",lv006=lv006+".$vrow['quantity']." where lv002='".$vrow['item']."' and lv003='".$lvWHID."'";
							db_query($lvsql);
							}
						}
					  }
				}
			$vCondition="select count(*) num from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)<0";
			if($this->LV_CheckSQL($vCondition))
				{
				$vlv002=InsertWithCheck('wh_lv0010', 'lv001', 'PXKDC-'.getmonth($vDate)."/".getyear($vDate)."-",1);
				$lvsql="insert into wh_lv0010 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009)   values('$vlv002','$lvWHID','$vEmpID','Inventory adjustments','KIEMKHO','$vlv001',0,'KIEMKHO','$vDate')";
				 $vReturn= db_query($lvsql);
				if($vReturn)
					{
					 $lvsql="insert into wh_lv0011 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) select '$vlv002',lv003,lv006-lv008,lv005,lv006-lv008,lv005,0,'',0,'','156','3381','',lv012,'$vDate' from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)<0";
					    $sql="select lv003 item,lv006-lv008 quantity,lv005 unit from wh_lv0005 where lv002='$vlv001' and (lv008-lv006)<0";
					  $vReturnTmp= db_query($sql);
					 ///getRow;
					   $vReturn= db_query($lvsql);
					   if($vReturn)
					   	{
							while($vrow = db_fetch_array ($vReturnTmp))
							{
							 $lvsql1="update wh_lv0012 set lv004=lv004-".$vrow['quantity'].",lv006=lv006-".$vrow['quantity']." where lv002='".$vrow['item']."' and lv003='".$lvWHID."'";
							db_query($lvsql1);
							}
						}
					 }
				}
		 
		}
		return true;
		
	}
	function LV_GETWH($vlv001)
	{
		$lvsql="select lv002  from  wh_lv0004 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				return $vrow['lv002'];
			}
			else
			return '';
		}else
		return '';
	}
	function LV_CheckSQL($lvsql)
	{
		$vresult=db_query($lvsql);
		if($vresult){
		$vrow=db_fetch_array($vresult);
			if($vrow)
			{
				if($vrow['num']>0) return true;
				else 
					return false;
			}
			else
			return false;
		}else
		return false;
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
		$strwh=$this->Get_WHControler();
		$strCondi=$strCondi." and lv002 in ($strwh)";
		return $strCondi;
	}
	function LV_Exist($vlv003)
	{
		$lvsql="select lv001 from wh_lv0004 BB where BB.lv003='$vlv003' and (BB.lv007=0 or BB.lv007=1)";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_ExistEmp($vlv003,$vOpt=0)
	{
		$lvsql="select lv001 from wh_lv0004 BB where BB.lv003='$vlv003' and (BB.lv007=0)";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_GetDetail($vContractID,$vBangID,$vLangArr,&$vSum)
	{
		$vobjtext="";
		$vstr='
			<table class="lvtable">
			<tr class="lvhtable"><td class="lvhtable">S</td>'.(($this->obj_conf->lv012==1)?'<td class="lvhtable">Xóa</td>':'').'<td class="lvhtable">MãSP</td><td class="lvhtable">Tên</td><td class="lvhtable">SL</td><td class="lvhtable">SL thực</td><td class="lvhtable">Ghi chú</td><td class="lvhtable">ĐVT</td></tr>
		';		
		$lvsql="select A.*,D.lv002 UnitName,C.lv002 Name,C.lv009 ColorName from wh_lv0005 A inner join wh_lv0004 B on A.lv002=B.lv001 inner join  all_gmacv3_0.sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on C.lv004=D.lv001 where 1=1 and B.lv001='$vContractID'";	
		$vresult=db_query($lvsql);
		$i=1;
		$vSum=0;
		$vSumTT=0;
		$isCal=true;
		$isDetail=true;
		$vtongsoluongthuc=0;
		while($vrow = db_fetch_array ($vresult))
		{
			$vtongsoluongthuc=$vtongsoluongthuc+$vrow['lv008'];
			$vtongsoluongkho=$vtongsoluongkho+$vrow['lv006'];
			$vtongsoluongmua=$vtongsoluongmua+$vrow['lv010'];
			$vstr=$vstr.'<tr class="lvlinehtable'.($i%2).'"  ><td style="color:'.$vrow['ColorName'].'">'.$i.'</td>'.(($this->obj_conf->lv012==1)?'<td style="color:'.$vrow['ColorName'].';text-align:center"><img style="cursor:pointer" src="../images/icon/delete.png"  onclick="delline(this,\''.$vrow['lv001'].'\')"/></td>':'').'<td style="color:'.$vrow['ColorName'].'">'.$vrow['lv003'].'</td><td style="color:'.$vrow['ColorName'].'">'.$vrow['Name'].'</td>
			<td align="center"><input type="hidden" id="soluongton_'.$vrow['lv001'].'" style="width:30px;text-align:center;" type="textbox" value="'.$vrow['lv004'].'" onblur="changeqty(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/>'.$this->FormatView($vrow['lv004'],10).'</td>
			
			<td align="center"><input onfocus="this.select()"  id="soluongthuc_'.$vrow['lv001'].'" style="min-width:53px;width:100%;text-align:center;" type="textbox" value="'.$vrow['lv008'].'" onblur="changeprice(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/></td>
			<td align="center"><input id="notes_'.$vrow['lv001'].'" type="textbox" value="'.$vrow['lv012'].'" style="min-width:50px;width:100%;;text-align:center;background:orange" onblur="changenotes(this,\''.$vrow['lv001'].'\')"  title="'.$this->FormatView($vrow['lv013'],4).'"/></td>
			<!--<td align="center"><input  id="soluongmua_'.$vrow['lv001'].'" style="min-width:53px;;width:100%;text-align:center;" type="textbox" value="'.$vrow['lv010'].'" onblur="changediscount(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/></td>-->
			<td>'.$vrow['UnitName'].'</td>
			
			</tr>';
			$i++;
		}
		$vstr=$vstr.'
		<tr class="lvhtable"><td class="lvhtable">&nbsp;'.$vobjtext.'</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable"><span id="tongsoluongkho">'.$this->FormatView($vtongsoluongkho,10).'</span></td><td class="lvhtable" align="right"><span id="tongsoluongthuc">'.$this->FormatView($vtongsoluongthuc,10).'</span></td><td colspan="3">&nbsp;</td></tr>
		</table>
		';
		return $vstr;
	}
	function LV_LoadDonVi()
	{
		$vsql="select lv001,lv002 from all_gmacv3_0.sl_lv0005";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrDonVi[$vrow['lv001']]=$vrow['lv002'];
		}
	}
	function LV_GetDVThem()
	{
		$vsql="select lv002,lv003,lv004 from mn_lv0010";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->ArrDonViThem[$vrow['lv002']][$vrow['lv003']]=$vrow['lv004'];
		}
	}
	function LV_CreateSelectDVItem($vItemID,$vDonVi,$vDonViKhac,$vDVSelected,&$vStrReturn='')
	{
		$vStrReturn="";
		if($vDVSelected=='') 
			$vDVSelected=$vDonVi;
		else
		{
			if($vDVSelected!=$vDonVi && $vDVSelected!=$vDonViKhac)
			$vDVSelected=$vDonVi;
		}
		if($vDonVi==$vDonViKhac || trim($vDonViKhac)=='')
		{
			$vSelectDV="<option value='".$vDonVi."' ".(($vDVSelected==$vDonVi)?'selected="selected"':'').">".$this->ArrDonVi[$vDonVi]."</option>";
		}
		else
		{
			$vSelectDV="<option value='".$vDonVi."' ".(($vDVSelected==$vDonVi)?'selected="selected"':'').">".$this->ArrDonVi[$vDonVi]."</option>";
			$vSelectDV=$vSelectDV."<option value='".$vDonViKhac."' ".(($vDVSelected==$vDonViKhac)?'selected="selected"':'').">".$this->ArrDonVi[$vDonViKhac]."</option>";
		}
		foreach($this->ArrDonViThem[$vItemID] as $key => $vQuiDoi)
		{
			if($key!=$vDonVi && $key!=$vDonViKhac)
			{
				$vSelectDV=$vSelectDV."<option value='".$key."' ".(($vDVSelected==$key)?'selected="selected"':'').">".$this->ArrDonVi[$key]."</option>";
				$vStrReturn=$vStrReturn."<input type='hidden' id='".$vItemID."_".$key."' value='".$vQuiDoi."'/>";
			}
		}
		return $vSelectDV;
	}
	function LV_CreateSelectDV($vDonVi,$vDonViKhac,$vDVSelected)
	{
		if($vDVSelected=='') 
			$vDVSelected=$vDonVi;
		else
		{
			if($vDVSelected!=$vDonVi && $vDVSelected!=$vDonViKhac)
			$vDVSelected=$vDonVi;
		}
		if($vDonVi==$vDonViKhac || trim($vDonViKhac)=='')
		{
			$vSelectDV="<option value='".$vDonVi."' ".(($vDVSelected==$vDonVi)?'selected="selected"':'').">".$this->ArrDonVi[$vDonVi]."</option>";
		}
		else
		{
			$vSelectDV="<option value='".$vDonVi."' ".(($vDVSelected==$vDonVi)?'selected="selected"':'').">".$this->ArrDonVi[$vDonVi]."</option>";
			$vSelectDV=$vSelectDV."<option value='".$vDonViKhac."' ".(($vDVSelected==$vDonViKhac)?'selected="selected"':'').">".$this->ArrDonVi[$vDonViKhac]."</option>";
		}
		return $vSelectDV;
	}
	//Full Inventory
	function LV_GetDetailFull($vContractID,$vBangID,$vLangArr,&$vSum)
	{
		$this->LV_GetDVThem();
		$this->LV_LoadDonVi();
		$vobjtext="";
		$vstr='
			<table class="lvtable">
			<tr class="lvhtable"><td class="lvhtable">S</td>'.(($this->obj_conf->lv012==1)?'<td class="lvhtable">Xóa</td>':'').'<td class="lvhtable">MãSP</td><td class="lvhtable">Tên</td><td class="lvhtable">SL</td><td class="lvhtable">ĐVKK</td><td class="lvhtable">SLKK</td><td class="lvhtable">SL Chính</td><td class="lvhtable">ĐV</td><td class="lvhtable">Ghi chú</td></tr>
		';		
		$lvsql="select A.*,D.lv002 UnitName,C.lv002 Name,C.lv009 ColorName,C.lv004 DonVi,C.lv005 DonViKhac,C.lv006 QuiDoi from wh_lv0005 A inner join wh_lv0004 B on A.lv002=B.lv001 inner join all_gmacv3_0.sl_lv0007 C on A.lv003=C.lv001 left join all_gmacv3_0.sl_lv0005 D on C.lv004=D.lv001 where 1=1 and B.lv001='$vContractID'";	
		$vresult=db_query($lvsql);
		$i=1;
		$vSum=0;
		$vSumTT=0;
		$isCal=true;
		$isDetail=true;
		$vtongsoluongthuc=0;
		while($vrow = db_fetch_array ($vresult))
		{
			$vtongsoluongthuc=$vtongsoluongthuc+$vrow['lv008'];
			$vtongsoluongkho=$vtongsoluongkho+$vrow['lv004'];
			$vtongsoluongmua=$vtongsoluongmua+$vrow['lv010'];
			$vtongsoluongkiem=$vtongsoluongkiem+$vrow['lv006'];
			$vstr=$vstr.'<tr class="lvlinehtable'.($i%2).'"  ><td style="color:'.$vrow['ColorName'].'">'.$i.'</td>'.(($this->obj_conf->lv012==1)?'<td style="color:'.$vrow['ColorName'].';text-align:center"><img style="cursor:pointer" src="../images/icon/delete.png"  onclick="delline(this,\''.$vrow['lv001'].'\')"/></td>':'').'<td style="color:'.$vrow['ColorName'].'">'.$vrow['lv003'].'</td><td style="color:'.$vrow['ColorName'].'">'.$vrow['Name'].'</td>
			<td align="center"><input type="hidden" id="soluongton_'.$vrow['lv001'].'" style="width:30px;text-align:center;" type="textbox" value="'.$vrow['lv004'].'" onblur="changeqty(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/>'.$this->FormatView($vrow['lv004'],10).'</td>
			<td align="center">
				<select id="donvi_'.$vrow['lv001'].'" style="width:100px;text-align:center;" type="textbox" value="'.$vrow['DonVi'].'" onchange="changedonvifull(this,\''.$vrow['lv001'].'\',\''.$vrow['lv003'].'\')">
					'.$this->LV_CreateSelectDVItem($vrow['lv003'],$vrow['DonVi'],$vrow['DonViKhac'],$vrow['lv007'],$vStrReturn).'
				</select>'.$vStrReturn.'
				<input type="hidden" name="'.$vrow['lv003'].'_'.$vrow['DonViKhac'].'" id="'.$vrow['lv003'].'_'.$vrow['DonViKhac'].'" value="'.$vrow['QuiDoi'].'"/>
				<input type="hidden" name="txtquidoi_'.$vrow['lv001'].'" id="txtquidoi_'.$vrow['lv001'].'" value="'.$vrow['QuiDoi'].'"/>
			</td>
			<td align="center"><input onfocus="this.select()"  id="soluongkiem_'.$vrow['lv001'].'" style="min-width:53px;width:100%;text-align:center;" type="textbox" value="'.$vrow['lv006'].'" onblur="changeSLKK(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/></td>
			<td align="center"><input onfocus="this.select()"  id="soluongthuc_'.$vrow['lv001'].'" style="min-width:53px;width:100%;text-align:center;" type="textbox" value="'.$vrow['lv008'].'" onblur="changeprice(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/></td>
			<td align="center">
			<input type="hidden" name="txtdonvichinh_'.$vrow['lv001'].'" id="txtdonvichinh_'.$vrow['lv001'].'" value="'.$vrow['DonVi'].'"/>
			'.$vrow['UnitName'].'</td>
			<td align="center"><input id="notes_'.$vrow['lv001'].'" type="textbox" value="'.$vrow['lv012'].'" style="min-width:50px;width:100%;;text-align:center;background:orange" onblur="changenotes(this,\''.$vrow['lv001'].'\')"  title="'.$this->FormatView($vrow['lv013'],4).'"/></td>
			<!--<td align="center"><input  id="soluongmua_'.$vrow['lv001'].'" style="min-width:53px;;width:100%;text-align:center;" type="textbox" value="'.$vrow['lv010'].'" onblur="changediscount(this,\''.$vrow['lv001'].'\')" title="'.$this->obj_conf->lv004.'"/></td>-->
			</tr>';
			$i++;
		}
		$vstr=$vstr.'
		<tr class="lvhtable"><td class="lvhtable">&nbsp;'.$vobjtext.'</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable"><span id="tongsoluongkho">'.$this->FormatView($vtongsoluongkho,10).'</span></td><td class="lvhtable">&nbsp;</td><td class="lvhtable" align="right"><span id="tongsoluongkiem">'.$this->FormatView($vtongsoluongkiem,10).'</span></td><td class="lvhtable" align="right"><span id="tongsoluongthuc">'.$this->FormatView($vtongsoluongthuc,10).'</span></td><td colspan="3">&nbsp;</td></tr>
		</table>
		';
		return $vstr;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM wh_lv0004 WHERE 1=1 ".$this->GetCondition();
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
		<table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"".(2+count($lstArr))."\" class=\"lvTTable\">".$this->ArrPush[0]."</td></tr>-->
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldSave($lvFrom,$lvList,$maxRows,$lvOrderList,$lvSortNum)."</td></tr>
		@#01
		<tr ><td colspan=\"".(count($lstArr)+2)."\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"".(count($lstArr))."\">".$this->TabFunction($lvFrom,$lvList,$maxRows)."</td><td colspan=\"2\" align=right>".$this->ListFieldExport($lvFrom,$lvList,$maxRows)."</td></tr>
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
		$lvHref="<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" class=@#04 style=\"text-decoration:none\">@02</a></span>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM wh_lv0004 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
				$vTemp=str_replace("@02",str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),str_replace("@01",$vrow['lv001'] ,$lvHref)),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","lvlineapproval_red",$strTr);
			elseif($vrow['lv007']==2)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else $strTr=str_replace("@#04","",$strTr);
			
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
			window.open('".$this->Dir."wh_lv0004/?lang=".$this->lang."&childfunc='+value+'&ID=".base64_encode($this->lv002)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$lvTable="<div align=\"center\"><div ondblclick=\"this.innerHTML=''\">".$this->Get_TitleHeader()."</div></div>
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
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM wh_lv0004 WHERE 1=1  ".$this->RptCondition." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			
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
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM wh_lv0004 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	
	public function LV_LinkField($vFile,$vSelectID)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectID),0));
	}
	private function sqlcondition($vFile,$vSelectID)
	{
		$vsql="";
		switch($vFile)
		{
			case 'lv002':
				$strwh=$this->Get_WHControler();
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001 in ($strwh) and lv001!=''";
				break;
			case 'lv003':
				$vsql="select lv001,concat(lv004,lv003,lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.hr_lv0020";
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv002':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001='$vSelectID'";
				break;
			case 'lv003':
				$vsql="select lv001,concat(lv004,lv003,lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  all_gmacv3_0.hr_lv0020 where lv001='$vSelectID'";
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