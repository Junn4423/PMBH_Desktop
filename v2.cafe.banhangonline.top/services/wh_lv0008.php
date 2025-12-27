<?php
/////////////coding wh_lv0008///////////////
class wh_lv0008 extends lv_controler
{
	public $lv001 = null;
	public $lv002 = null;
	public $lv003 = null;
	public $lv004 = null;
	public $lv005 = null;
	public $lv006 = null;
	public $lv007 = null;
	public $lv008 = null;
	public $lv009 = null;

	///////////
	public $DefaultFieldList = "lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv099";
	////////////////////GetDate
	public $DateDefault = "1900-01-01";
	public $DateCurrent = "1900-01-01";
	public $Count = null;
	public $paging = null;
	public $lang = null;
	protected $objhelp = 'wh_lv0008';
	////////////
	var $ArrOther = array();
	var $ArrPush = array();
	var $ArrFunc = array();
	var $ArrGet = array("lv001" => "2", "lv002" => "3", "lv003" => "4", "lv004" => "5", "lv005" => "6", "lv006" => "7", "lv007" => "8", "lv008" => "9", "lv009" => "10", "lv010" => "11", "lv099" => "100");
	var $ArrView = array("lv001" => "0", "lv002" => "0", "lv003" => "0", "lv004" => "0", "lv005" => "0", "lv006" => "0", "lv007" => "0", "lv008" => "0", "lv009" => "22", "lv010" => "10", "lv099" => "0");

	public $LE_CODE = "NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin, $vUserID, $vright)
	{
		$this->DateCurrent = GetServerDate() . " " . GetServerTime();
		$this->Set_User($vCheckAdmin, $vUserID, $vright);
		$this->isRel = 1;
		$this->isHelp = 1;
		$this->isConfig = 0;
		$this->isFil = 1;
		$this->lang = $_GET['lang'] ?? 'vi';

	}

	function LV_Load()
	{
		$vsql = "select * from  wh_lv0008";
		$vresult = db_query($vsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			$this->lv001 = $vrow['lv001'];
			$this->lv002 = $vrow['lv002'];
			$this->lv003 = $vrow['lv003'];
			$this->lv004 = $vrow['lv004'];
			$this->lv005 = $vrow['lv005'];
			$this->lv006 = $vrow['lv006'];
			$this->lv007 = $vrow['lv007'];
			$this->lv008 = $vrow['lv008'];
			$this->lv009 = $vrow['lv009'];

		}
	}
	//Kebao_Mobile
	function MB_LoadData()
	{
		$vsql = "select * from  wh_lv0008";
		$vresult = db_query($vsql);
		return $vresult;
	}

	//////////////END CODE MOBILE_KB////////////////
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  wh_lv0008 Where lv001='$vlv001'";
		$vresult=db_query($lvsql);
		return $vresult;
	}
	function LV_Insert()
	{
		$this->lv009 = ($this->lv009 != "") ? recoverdate(($this->lv009), $this->lang) : $this->DateDefault;
		$lvsql = "insert into wh_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008',concat(CURRENT_DATE(),' ',CURRENT_TIME()))";
		$vReturn = db_query($lvsql);
		if ($vReturn) {
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.insert', sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_InsertAuto()
	{
		if ($this->isAdd == 0)
			return false;
		$this->lv009 = ($this->lv009 != "") ? recoverdate(($this->lv009), $this->lang) : $this->DateDefault;
		$lvsql = "insert into wh_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008',concat(CURRENT_DATE(),' ',CURRENT_TIME()))";
		$vReturn = db_query($lvsql);
		if ($vReturn) {
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.insert', sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_CheckData($vlv002, $vWarehourID)
	{
		$lvsql = "select A.lv004 lv004 from sl_lv0014 A inner join sl_lv0007 B on A.lv003=B.lv001  where A.lv002='$vlv002'";
		$vReturn = db_query($lvsql);
		while ($vrow = db_fetch_array($vReturn)) {
			$this->lv004 = $vrow['lv004'];
			if ($this->lv004 > 0)
				return true;
		}
		return false;
	}
	function LV_InsertTemp()
	{

		if ($this->isAdd == 0)
			return false;
		$this->lv009 = ($this->lv009 != "") ? recoverdate(($this->lv009), $this->lang) : $this->DateDefault;
		$lvsql = "insert into wh_lv0008 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008',concat('$this->lv009',' ',CURRENT_TIME()),'$this->LV_UserID')";
		$vReturn = db_query($lvsql);
		if ($vReturn) {
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.insert', sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Update()
	{
		if ($this->isEdit == 0)
			return false;
		if ($this->lv001_ == "")
			$this->lv001_ = $this->lv001;
		$this->lv009 = ($this->lv009 != "") ? recoverdate(($this->lv009), $this->lang) : $this->DateDefault;
		$lvsql = "Update wh_lv0008 set lv001='$this->lv001_',lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv008='$this->lv008',lv009=concat('$this->lv009',' ',CURRENT_TIME()) where  lv001='$this->lv001' AND lv007<=0;";
		$vReturn = db_query($lvsql);
		if ($vReturn) {
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.update', sof_escape_string($lvsql));
		}
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if ($this->isDel == 0)
			return false;
		$lvsql = "DELETE FROM wh_lv0008  WHERE wh_lv0008.lv007<=0 AND wh_lv0008.lv001 IN ($lvarr)";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.delete', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if ($this->isApr == 0)
			return false;
		$lvsql = "Update wh_lv0008 set lv007=1  WHERE wh_lv0008.lv001 IN ($lvarr)  ";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.approval', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_AprovalCreateLot($lvarr)
	{
		if ($this->isApr == 0)
			return false;
		$lvsql = "Update wh_lv0008 set lv007=1  WHERE wh_lv0008.lv001 IN ($lvarr)  ";
		$vReturn = db_query($lvsql);
		if ($vReturn) {
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.approval', sof_escape_string($lvsql));
			$lvsql1 = "select B.lv002 WhID,A.* from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 where B.lv001  IN ($lvarr)";
			$vReturn1 = db_query($lvsql1);
			while ($vrow = db_fetch_array($vReturn1)) {
				$this->CheckChild($vrow['lv003'], $vrow['WhID']);
				$this->AddLotReciept($vrow['lv014'], $vrow['lv003'], $vrow['WhID'], $vrow['lv006'], $vrow['lv008'], $vrow['lv019'], $vrow['lv015'], $vrow['lv011']);
				if ($this->objwh_lv0001 != null)
					$this->objwh_lv0001->LV_ApprovalItem($vrow['WhID'], $vrow['lv003']);
			}
		}
		return $vReturn;
	}
	function CheckChild($vlv002, $vlv003)
	{
		$sqlD = "SELECT count(*) nums FROM wh_lv0012 WHERE lv002='$vlv002' and lv003='$vlv003'";
		$vresult = db_query($sqlD);
		if ($vresult) {
			$vrow = db_fetch_array($vresult);
			if ($vrow['nums'] <= 0) {
				$lvsql = "insert into wh_lv0012 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013) values('$vlv002','$vlv003','0','$this->lv005','0','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013')";
				db_query($lvsql);
			}
		}
	}
	function AddLotReciept($lvLotId, $lvItemId, $lvWhId, $lvColor, $lvSize, $lvTypeSize, $lvNote, $lvExpireDate)
	{
		if ($this->CheckLot($lvLotId, $lvItemId, $lvWhId) <= 0) {
			$lvsql = "insert into wh_lv0020 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008) values('$lvLotId','$lvItemId','$lvWhId','$lvExpireDate','$lvColor','$lvSize',concat(CURRENT_DATE(),' ',CURRENT_TIME()),'$lvNote')";
			$vReturn = db_query($lvsql);
			if ($vReturn)
				$this->InsertLogOperation($this->DateCurrent, 'wh_lv0020.insert', sof_escape_string($lvsql));
		}
	}
	function CheckLot($lvLotId, $lvItemId, $lvWhId)
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM wh_lv0020 WHERE lv001='$lvLotId' and lv002='$lvItemId' and lv003='$lvWhId'";
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_Exist($vlv001)
	{
		$lvsql = "select count(*) num from  wh_lv0008 Where lv001='$vlv001'";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			if ($vrow['num'] > 0)
				return true;
			else
				return false;
		}
		return false;
	}
	function LV_UnAproval($lvarr)
	{
		if ($this->isUnApr == 0)
			return false;
		$lvsql = "Update wh_lv0008 set lv007=0  WHERE wh_lv0008.lv001 IN ($lvarr)  ";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.unapproval', sof_escape_string($lvsql));
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
		$strCondi = "";
		if ($this->lv001 != "")
			$strCondi = $strCondi . " and lv001  like '%$this->lv001%'";
		if ($this->lv002 != "")
			$strCondi = $strCondi . " and lv002  like '%$this->lv002%'";
		if ($this->lv003 != "")
			$strCondi = $strCondi . " and lv003  like '%$this->lv003%'";
		if ($this->lv004 != "")
			$strCondi = $strCondi . " and lv004  like '%$this->lv004%'";
		if ($this->lv005 != "")
			$strCondi = $strCondi . " and lv005  like '%$this->lv005%'";
		if ($this->lv006 != "")
			$strCondi = $strCondi . " and lv006  like '%$this->lv006%'";
		if ($this->lv007 != "")
			$strCondi = $strCondi . " and lv007 like '%$this->lv007%'";
		if ($this->lv008 != "")
			$strCondi = $strCondi . " and lv008 like '%$this->lv008%'";
		if ($this->lv009 != "")
			$strCondi = $strCondi . " and lv009 like '%$this->lv009%'";
		$strwh = $this->Get_WHControler();
		$strCondi = $strCondi . " and lv002 in ($strwh)";
		return $strCondi;
	}
	protected function GetConditionRpt()
	{
		$strCondi = "";
		if ($this->lv001 != "")
			$strCondi = $strCondi . " and lv001 = '$this->lv001'";
		if ($this->lv002 != "")
			$strCondi = $strCondi . " and lv002  like '%$this->lv002%'";
		if ($this->lv003 != "")
			$strCondi = $strCondi . " and lv003  like '%$this->lv003%'";
		if ($this->lv004 != "")
			$strCondi = $strCondi . " and lv004  like '%$this->lv004%'";
		if ($this->lv005 != "")
			$strCondi = $strCondi . " and lv005  like '%$this->lv005%'";
		if ($this->lv006 != "")
			$strCondi = $strCondi . " and lv006  like '%$this->lv006%'";
		if ($this->lv007 != "")
			$strCondi = $strCondi . " and lv007 like '%$this->lv007%'";
		if ($this->lv008 != "")
			$strCondi = $strCondi . " and lv008 like '%$this->lv008%'";
		if ($this->lv009 != "")
			$strCondi = $strCondi . " and lv009 like '%$this->lv009%'";
		$strwh = $this->Get_WHControler();
		$strCondi = $strCondi . " and lv002 in ($strwh)";
		return $strCondi;
	}
	protected function GetConditionMini()
	{
		$strCondi = "";
		$strwh = $this->Get_WHControler();
		$strCondi = $strCondi . " and lv002 in ($strwh)";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM wh_lv0008 WHERE 1=1 " . $this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_GetBLMoney($vContractID)
	{
		$lvsql = "select sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discount from ((select sum(A.lv004*A.lv008) lv003,sum(A.lv004*A.lv008*A.lv010/100) lv004,sum(A.lv004*A.lv008*A.lv012/100) lv005 from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID' )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		return $vrow['convertmoney'] + $vrow['money'] - $vrow['discount'];
	}
	function LV_ExistEmp($vlv003, $vOpt = 0)
	{
		$lvsql = "select lv001 from wh_lv0008 BB where BB.lv003='$vlv003' and (BB.lv007=0)";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_GetDetail($vContractID, $vBangID, $vLangArr, &$vSum)
	{
		$vobjtext = "";
		$vstr = '
			<table class="lvtable">
			<tr class="lvhtable"><td class="lvhtable">S</td>' . (($this->obj_conf->lv012 == 1) ? '<td class="lvhtable">Xóa</td>' : '') . '<td class="lvhtable">MãSP</td><td class="lvhtable">Tên</td><td class="lvhtable">SL</td><td class="lvhtable">ĐVT</td><td class="lvhtable">Đơn giá</td><!--<td class="lvhtable">%VAT</td>--><td class="lvhtable">Thành tiền</td><td class="lvhtable">Ghi chú</td></tr>
		';
		$lvsql = "select A.*,D.lv002 UnitName,C.lv002 Name,C.lv009 ColorName from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on C.lv004=D.lv001 where 1=1 and B.lv001='$vContractID'";
		$vresult = db_query($lvsql);
		$i = 1;
		$vSum = 0;
		$vSumTT = 0;
		$isCal = true;
		$isDetail = true;
		$vtongsoluongthuc = 0;
		while ($vrow = db_fetch_array($vresult)) {
			$vtongsoluongthuc = $vtongsoluongthuc + $vrow['lv008'];
			$vtongsoluongkho = $vtongsoluongkho + $vrow['lv004'];
			$vtongsoluongmua = $vtongsoluongmua + $vrow['lv008'] * $vrow['lv004'];
			$vstr = $vstr . '
			<tr class="lvlinehtable' . ($i % 2) . '"  >
				<td style="color:' . $vrow['ColorName'] . '">' . $i . '</td>
				' . (($this->obj_conf->lv012 == 1) ? '<td style="color:' . $vrow['ColorName'] . ';text-align:center"><img style="cursor:pointer" src="../images/icon/delete.png"  onclick="delline(this,\'' . $vrow['lv001'] . '\')"/></td>' : '') . '<td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv003'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['Name'] . '</td>
				<td><input onfocus="this.select();" id="soluong_' . $vrow['lv001'] . '" style="min-width:30px;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv004'] . '" onblur="changeqty(this,\'' . $vrow['lv001'] . '\')"/></td>
				<td>' . $vrow['UnitName'] . '</td>
				<td align="center"><input  id="dongia_' . $vrow['lv001'] . '" style="min-width:53px;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv008'] . '" onblur="changeprice(this,\'' . $vrow['lv001'] . '\')"/></td>
				<!--<td align="center"><input  id="detail_id_' . $vrow['lv001'] . '" style="min-width:53px;;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv010'] . '" onblur="changediscount(this,\'' . $vrow['lv001'] . '\')"/></td>-->
				<td align="center"><div style="text-align:right;" id="thanhtien_' . $vrow['lv001'] . '">' . $this->FormatView($vrow['lv004'] * $vrow['lv008'], 10) . '</div></td>
				<td align="center"><input type="textbox" value="' . $vrow['lv015'] . '" style="min-width:50px;width:98%;;text-align:center;background:orange" onblur="changenote(this,\'' . $vrow['lv001'] . '\')" name="tratruoc_' . $vContractID . '_' . $i . '"/></td></tr>';
			$i++;
		}
		$vstr = $vstr . '
		<tr class="lvhtable"><td class="lvhtable">&nbsp;' . $vobjtext . '</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable"><span id="tongsoluongkho">' . $this->FormatView($vtongsoluongkho, 10) . '</span></td><td class="lvhtable"><span id="">&nbsp;</span></td><td class="lvhtable" align="right">&nbsp;</td><td  style="text-align:right!important;" class="lvhtable"><span style="text-align:right;" id="tongsoluongmua">' . $this->FormatView(round($vtongsoluongmua, -3), 10) . '</span></td><td colspan="2">&nbsp;</td></tr>
		</table>
		';
		return $vstr;
	}
	function LV_GetDetailMuaHang($vContractID, $vBangID, $vLangArr, &$vSum)
	{
		$vobjtext = "";
		$vstr = '
			<table class="lvtable">
			<tr class="lvhtable"><td class="lvhtable">S</td>' . (($this->obj_conf->lv012 == 1) ? '<td class="lvhtable">Xóa</td>' : '') . '<td class="lvhtable">MãSP</td><td class="lvhtable">Tên</td><td class="lvhtable">SL Nhập</td><td class="lvhtable">ĐVT Nhập</td><td class="lvhtable">SL Mua</td><td class="lvhtable">ĐVT Mua</td><td class="lvhtable">Đơn giá</td><!--<td class="lvhtable">%VAT</td>--><td class="lvhtable">Thành tiền</td><td class="lvhtable">Ghi chú</td></tr>
		';
		$lvsql = "select A.*,D.lv002 UnitName,E.lv002 UnitNameMua,C.lv002 Name,C.lv009 ColorName from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 left join sl_lv0005 D on C.lv004=D.lv001 left join sl_lv0005 E on C.lv006=E.lv001 where 1=1 and B.lv001='$vContractID'";
		$vresult = db_query($lvsql);
		$i = 1;
		$vSum = 0;
		$vSumTT = 0;
		$isCal = true;
		$isDetail = true;
		$vtongsoluongthuc = 0;
		while ($vrow = db_fetch_array($vresult)) {
			$vtongsoluongthuc = $vtongsoluongthuc + $vrow['lv008'];
			$vtongsoluongkho = $vtongsoluongkho + $vrow['lv004'];
			$vtongsoluongmua = $vtongsoluongmua + $vrow['lv008'] * $vrow['lv004'];
			$vstr = $vstr . '
			<tr class="lvlinehtable' . ($i % 2) . '"  >
				<td style="color:' . $vrow['ColorName'] . '">' . $i . '</td>
				' . (($this->obj_conf->lv012 == 1) ? '<td style="color:' . $vrow['ColorName'] . ';text-align:center"><img style="cursor:pointer" src="../images/icon/delete.png"  onclick="delline(this,\'' . $vrow['lv001'] . '\')"/></td>' : '') . '<td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv003'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['Name'] . '</td>
				<td><input onfocus="this.select();" id="soluong_' . $vrow['lv001'] . '" style="min-width:30px;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv004'] . '" onblur="changeqty(this,\'' . $vrow['lv001'] . '\')"/></td>
				<td>' . $vrow['UnitName'] . '</td>
				<td><input onfocus="this.select();" id="soluongmua_' . $vrow['lv001'] . '" style="min-width:30px;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv006'] . '" onblur="changeqtymua(this,\'' . $vrow['lv001'] . '\')"/></td>
				<td><select  id="tkno_' . $vrow['lv001'] . '" style="min-width:53px;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv005'] . '" onblur="changetkno(this,\'' . $vrow['lv001'] . '\')">
				' . $this->LV_LinkField('lv907', $vrow['lv007']) . '
				</select></td>
				<td align="center"><input  id="dongia_' . $vrow['lv001'] . '" style="min-width:53px;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv008'] . '" onblur="changeprice(this,\'' . $vrow['lv001'] . '\')"/></td>
				<!--<td align="center"><input  id="detail_id_' . $vrow['lv001'] . '" style="min-width:53px;;width:98%;text-align:center;" type="textbox" value="' . $vrow['lv010'] . '" onblur="changediscount(this,\'' . $vrow['lv001'] . '\')"/></td>-->
				<td align="center"><div style="text-align:right;" id="thanhtien_' . $vrow['lv001'] . '">' . $this->FormatView($vrow['lv004'] * $vrow['lv008'], 10) . '</div></td>
				<td align="center"><input type="textbox" value="' . $vrow['lv015'] . '" style="min-width:50px;width:98%;;text-align:center;background:orange" onblur="changenote(this,\'' . $vrow['lv001'] . '\')" name="tratruoc_' . $vContractID . '_' . $i . '"/></td></tr>';
			$i++;
		}
		$vstr = $vstr . '
		<tr class="lvhtable"><td class="lvhtable">&nbsp;' . $vobjtext . '</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable"><span id="tongsoluongkho">' . $this->FormatView($vtongsoluongkho, 10) . '</span></td><td class="lvhtable"><span id="">&nbsp;</span></td><td class="lvhtable" align="right">&nbsp;</td><td  style="text-align:right!important;" class="lvhtable"><span style="text-align:right;" id="tongsoluongmua">' . $this->FormatView($vtongsoluongmua, 10) . '</span></td><td>&nbsp;</td><td><span style="text-align:right;" id="tongsoluong">' . $this->FormatView($vtongsoluongmua, 10) . '</span></td><td colspan="2">&nbsp;</td></tr>
		</table>
		';
		return $vstr;
	}
	function LV_GetContractMoney($vInvoiceID, $vopt = 0)
	{
		switch ($vopt) {
			case 8:
				$vField = "A.lv008";
				break;
			case 10:
				$vField = "A.lv004*A.lv008";
				break;
			default:
				$vField = "A.lv004";
				break;
		}
		$lvsql = "select sum($vField) SumMoney from wh_lv0009 A  WHERE A.lv002 = '$vInvoiceID'";
		$vReturnArr = array();
		$lvResult = db_query($lvsql);
		$row = db_fetch_array($lvResult);
		return $row['SumMoney'];
	}
	//////////////////////Buil list////////////////////
//////////////////////Buil list////////////////////
	function LV_BuilList($lvList, $lvFrom, $lvChkAll, $lvChk, $curRow, $maxRows, $paging, $lvOrderList, $lvSortNum)
	{
		if ($lvList == "")
			$lvList = $this->DefaultFieldList;
		if ($this->isView == 0)
			return false;
		$lstArr = explode(",", $lvList);
		$lstOrdArr = explode(",", $lvOrderList);
		$lstArr = $this->getsort($lstArr, $lstOrdArr);
		$strSort = "";
		switch ($lvSortNum) {
			case 0:
				break;
			case 1:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "asc");
				break;
			case 2:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "desc");
				break;
		}
		$lvTable = "
		<div id=\"func_id\" style='position:relative;background:#f2f2f2'><div style=\"float:left\">" . $this->TabFunction($lvFrom, $lvList, $maxRows) . "</div><div style=\"float:right\">" . $this->ListFieldSave($lvFrom, $lvList, $maxRows, $lvOrderList, $lvSortNum) . "</div><div style='float:right'>&nbsp;&nbsp;&nbsp;</div><div style='float:right'>" . $this->ListFieldExport($lvFrom, $lvList, $maxRows) . "</div></div><div style='height:35px'></div><table  align=\"center\" class=\"lvtable\"><!--<tr ><td colspan=\"" . (2 + count($lstArr)) . "\" class=\"lvTTable\">" . $this->ArrPush[0] . "</td></tr>-->
		@#01
		@#02
		<tr ><td colspan=\"" . (count($lstArr) + 2) . "\">$paging</td></tr>
		<tr class=\"cssbold_tab\"><td colspan=\"" . (count($lstArr) + 2) . "\">" . $this->TabFunction($lvFrom, $lvList, $maxRows) . "</td></tr>
		</table>
		";
		$lvTrH = "<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">" . $this->ArrPush[1] . "</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr = "<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input name=\"$lvChk\" type=\"checkbox\" id=\"$lvChk@03\" onclick=\"CheckOne($lvFrom, '$lvChk', '$lvChkAll', this)\" value=\"@02\" tabindex=\"2\"  onKeyUp=\"return CheckKeyCheck(event,2,'$lvChk',$lvFrom, '$lvChk', '$lvChkAll',@03)\"/></td>
			@#01
		</tr>
		";
		$lvHref = "<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" class=@#04 style=\"text-decoration:none\">@02</a></span>";
		$lvTdH = "<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd = "<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvTdF = "<td align=\"right\"><strong>@01</strong></td>";
		$strF = "<tr><td colspan=\"2\">&nbsp;</td>";
		$sqlS = "SELECT * FROM wh_lv0008 WHERE 1=1  " . $this->GetCondition() . " $strSort LIMIT $curRow, $maxRows";
		$vorder = $curRow;
		$bResult = db_query($sqlS);
		$this->Count = db_num_rows($bResult);
		$strTrH = "";
		$strTr = "";
		for ($i = 0; $i < count($lstArr); $i++) {
			$vTemp = str_replace("@01", "", $lvTdH);
			$vTemp = str_replace("@02", $this->ArrPush[(int) $this->ArrGet[$lstArr[$i]]], $vTemp);
			$strH = $strH . $vTemp;
			$vTempF = str_replace("@01", "<!--" . $lstArr[$i] . "-->", $lvTdF);
			$strF = $strF . $vTempF;
		}

		while ($vrow = db_fetch_array($bResult)) {
			$strL = "";
			$vorder++;
			$vlineamount = $this->LV_GetBLMoney($vrow['lv001']);
			$vsumamount = $vsumamount + $vlineamount;
			for ($i = 0; $i < count($lstArr); $i++) {
				if ($lstArr[$i] == "lv010") {
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vlineamount, (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} else
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				$strL = $strL . $vTemp;
			}
			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv007'] == 1)
				$strTr = str_replace("@#04", "lvlineapproval", $strTr);
			else
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strF = $strF . "</tr>";
		$strF = str_replace("<!--lv010-->", $this->FormatView($vsumamount, 10), $strF);
		$strF = str_replace("<!--lv003-->", '<p style="text-align:center;padding:5px">Tổng:</p>', $strF);
		$lvTable = str_replace("@#02", $strF, $lvTable);
		$strTrH = str_replace("@#01", $strH, $lvTrH);
		return str_replace("@#01", $strTrH . $strTr, $lvTable);
	}
	/////////////////////ListFieldExport//////////////////////////
	function ListFieldExport($lvFrom, $lvList, $maxRows)
	{
		if ($lvList == "")
			$lvList = $this->DefaultFieldList;
		$lvList = "," . $lvList . ",";
		$lstArr = explode(",", $this->DefaultFieldList);
		$lvSelect = "<ul id=\"menu1-nav\" onkeyup=\"return CheckKeyCheckTabExp(event)\">
						<li class=\"menusubT1\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />" . $this->ArrFunc[12] . "
							<ul id=\"submenu1-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript = "		
		<script language=\"javascript\">
		function Export(vFrom,value)
		{
			window.open('" . $this->Dir . "wh_lv0008/?lang=" . $this->lang . "&childfunc='+value+'&ID=" . base64_encode($this->lv002) . "','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
		}
	
		
		</script>
";
		$lvScript = "<li class=\"menuT\"> @01 </li>";
		$lvexcel = "<input class=lvbtdisplay type=\"button\" id=\"lvbuttonexcel\" value=\"" . $this->ArrFunc[13] . "\" onclick=\"Export($lvFrom,'excel')\">";
		$lvpdf = "<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"" . $this->ArrFunc[15] . "\" onclick=\"Export($lvFrom,'pdf')\">";
		$lvword = "<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"" . $this->ArrFunc[14] . "\" onclick=\"Export($lvFrom,'word')\">";
		$strGetList = "";
		$strGetScript = "";

		$strTemp = str_replace("@01", $lvexcel, $lvScript);
		$strGetScript = $strGetScript . $strTemp;
		$strTemp = str_replace("@01", $lvword, $lvScript);
		$strGetScript = $strGetScript . $strTemp;
		$strTemp = str_replace("@01", $lvpdf, $lvScript);
		$strGetScript = $strGetScript . $strTemp;
		$strReturn = str_replace("@#01", $strGetScript, $lvSelect) . $strScript;
		return $strReturn;

	}
	/////////////////////ListFieldSave//////////////////////////
	function ListFieldSave($lvFrom, $lvList, $maxRows, $lvOrder, $lvSortNum)
	{
		if ($lvList == "")
			$lvList = $this->DefaultFieldList;
		$lvList = "," . $lvList . ",";
		$lstArr = explode(",", $this->DefaultFieldList);
		$lvArrOrder = explode(",", $lvOrder);
		$lvSelect = "<ul id=\"menu-nav\" onkeyup=\"return CheckKeyCheckTab(event,$lvFrom," . count($lstArr) . ")\">
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" class=\"lv_funcshowimg\"/><span class=\"lv_funcshowtext\">" . $this->ArrFunc[11] . "</span>
							<ul id=\"submenu-nav\">
							@#01
							</ul>
						</li>
					</ul>";
		$strScript = "		
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
		$lvScript = "<li class=\"menuT\"> @01 </li>";
		$lvNumPage = "" . $this->ArrOther[2] . "<input type=\"text\" class=\"lvmaxrow\" name=lvmaxrow id=lvmaxrow value=\"$maxRows\">";
		$lvSortPage = "" . GetLangSort(0, $this->lang) . "<select class=\"lvsortrow\" name=lvsort id=lvsort >
				<option value=0 " . (($lvSortNum == 0) ? 'selected' : '') . ">" . GetLangSort(1, $this->lang) . "</option>
				<option value=1 " . (($lvSortNum == 1) ? 'selected' : '') . ">" . GetLangSort(2, $this->lang) . "</option>
				<option value=2 " . (($lvSortNum == 2) ? 'selected' : '') . ">" . GetLangSort(3, $this->lang) . "</option>
		</select>";
		$lvChk = "<input type=\"checkbox\" id=\"lvdisplaychk@01\" name=\"lvdisplaychk@01\" value=\"@02\" @03><input id=\"lvorder@01\" name=\"lvorder@01\"  type=\"text\" value=\"@06\"\ style=\"width:20px\" >";
		$lvButton = "<input class=lvbtdisplay type=\"button\" id=\"lvbutton\" value=\"" . $this->ArrOther[1] . "\" onclick=\"SelectChk($lvFrom," . count($lstArr) . ")\">";
		$strGetList = "";
		$strGetScript = "";
		for ($i = 0; $i < count($lstArr); $i++) {

			$strTempChk = str_replace("@01", $i, $lvChk . $this->ArrPush[(int) $this->ArrGet[$lstArr[$i]]]);
			$strTempChk = str_replace("@02", $lstArr[$i], $strTempChk);

			$strTempChk = str_replace("@07", 100 + $i, $strTempChk);
			if (strpos($lvList, "," . $lstArr[$i] . ",") === FALSE) {
				$strTempChk = str_replace("@03", "", $strTempChk);

			} else {
				$strTempChk = str_replace("@03", "checked=checked", $strTempChk);
			}
			if ($lvArrOrder[$i] == NULL || $lvArrOrder[$i] == "") {
				$strTempChk = str_replace("@06", $i, $strTempChk);
			} else
				$strTempChk = str_replace("@06", $lvArrOrder[$i], $strTempChk);


			$strTemp = str_replace("@01", $strTempChk, $lvScript);
			$strGetScript = $strGetScript . $strTemp;
		}
		$strTemp = str_replace("@01", $lvNumPage, $lvScript);
		$strGetScript = $strGetScript . $strTemp;
		$strTemp = str_replace("@01", $lvSortPage, $lvScript);
		$strGetScript = $strGetScript . $strTemp;
		$strTemp = str_replace("@01", $lvButton, $lvScript);
		$strGetScript = $strGetScript . $strTemp;
		$strReturn = str_replace("@#01", $strGetScript, $lvSelect) . $strScript;
		return $strReturn;

	}
	public function GetBuilCheckList($vListID, $vID, $vTabIndex)
	{
		$vListID = "," . $vListID . ",";
		$strTbl = "<table  align=\"center\" class=\"lvtable\">
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
		$lvChk = "<input type=\"checkbox\" id=\"$vID@01\" value=\"@02\" @03 title=\"@04\" tabindex=\"$vTabIndex\">";
		$lvTrH = "<tr class=\"lvlinehtable1\">
			<td width=1%>@#01</td><td>@#02</td>
			
		</tr>
		";
		$vsql = "select * from  hr_lv0004";
		$strGetList = "";
		$strGetScript = "";
		$i = 0;
		$vresult = db_query($vsql);
		$numrows = db_num_rows($vresult);
		while ($vrow = db_fetch_array($vresult)) {

			$strTempChk = str_replace("@01", $i, $lvChk);
			$strTempChk = str_replace("@02", $vrow['lv001'], $strTempChk);
			if (strpos($vListID, "," . $vrow['lv001'] . ",") === FALSE) {
				$strTempChk = str_replace("@03", "", $strTempChk);
			} else {
				$strTempChk = str_replace("@03", "checked=checked", $strTempChk);
			}

			$strTempChk = str_replace("@04", $vrow['lv003'], $strTempChk);

			$strTemp = str_replace("@#01", $strTempChk, $lvTrH);
			$strTemp = str_replace("@#02", $vrow['lv002'] . "(" . $vrow['lv001'] . ")", $strTemp);
			$strGetScript = $strGetScript . $strTemp;
			$i++;

		}
		$strReturn = str_replace("@#01", $strGetScript, str_replace("@#02", $numrows, $strTbl));
		return $strReturn;
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReport($lvList, $lvFrom, $lvChkAll, $lvChk, $curRow, $maxRows, $paging, $lvOrderList)
	{

		if ($lvList == "")
			$lvList = $this->DefaultFieldList;
		if ($this->isView == 0)
			return false;
		$lstArr = explode(",", $lvList);
		$lstOrdArr = explode(",", $lvOrderList);
		$lstArr = $this->getsort($lstArr, $lstOrdArr);
		$strSort = "";
		switch ($lvSortNum) {
			case 0:
				break;
			case 1:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "asc");
				break;
			case 2:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "desc");
				break;
		}
		$lvTable = "<div align=\"center\"><div ondblclick=\"this.innerHTML=''\">" . $this->Get_TitleHeader() . "</div></div>
		<div align=\"center\"><h1>" . ($this->ArrPush[0]) . "</h2></div>
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		@#02
		</table>
		";
		$lvTrH = "<tr >
			<td width=1% class=\"lvhtable\">" . $this->ArrPush[1] . "</td>
			
			@#01
		</tr>
		";
		$lvTr = "<tr class=\"lvlinehtable@01\">
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvTdF = "<td align=\"@#05\"><strong>@01</strong></td>";
		$strF = "<tr><td colspan=\"1\">&nbsp;</td>";
		$lvTdH = "<td width=\"@01\" class=\"lvtabletd\">@02</td>";
		$lvTd = "<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM wh_lv0008 WHERE 1=1  " . $this->RptCondition . " $strSort LIMIT $curRow, $maxRows";
		$vorder = $curRow;
		$bResult = db_query($sqlS);
		$this->Count = db_num_rows($bResult);
		$strTrH = "";
		$strTr = "";
		for ($i = 0; $i < count($lstArr); $i++) {
			$vTemp = str_replace("@01", "", $lvTdH);
			$vTemp = str_replace("@02", $this->ArrPush[(int) $this->ArrGet[$lstArr[$i]]], $vTemp);
			$strH = $strH . $vTemp;
			$vTempF = str_replace("@01", "<!--" . $lstArr[$i] . "-->", $this->Align($lvTdF, (int) $this->ArrView[$lstArr[$i]]));
			$strF = $strF . $vTempF;
		}

		while ($vrow = db_fetch_array($bResult)) {
			$strL = "";
			$vorder++;
			$vlineamount = $this->LV_GetBLMoney($vrow['lv001']);
			$vsumamount = $vsumamount + $vlineamount;
			for ($i = 0; $i < count($lstArr); $i++) {
				if ($lstArr[$i] == "lv010") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vlineamount, (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} else
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				$strL = $strL . $vTemp;
			}
			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv007'] == 1)
				$strTr = str_replace("@#04", "lvlineapproval", $strTr);
			else
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strF = $strF . "</tr>";
		$strF = str_replace("<!--lv010-->", $this->FormatView($vsumamount, 10), $strF);
		$strF = str_replace("<!--lv003-->", '<p style="text-align:center;padding:5px">Tổng:</p>', $strF);
		$lvTable = str_replace("@#02", $strF, $lvTable);
		$strTrH = str_replace("@#01", $strH, $lvTrH);
		return str_replace("@#01", $strTrH . $strTr, $lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportMini($lvList, $lvFrom, $lvChkAll, $lvChk, $curRow, $maxRows, $paging, $lvOrderList, $lvDateSort)
	{

		if ($lvList == "")
			$lvList = $this->DefaultFieldList;
		if ($this->isView == 0)
			return false;
		$lstArr = explode(",", $lvList);
		$lstOrdArr = explode(",", $lvOrderList);
		$lstArr = $this->getsort($lstArr, $lstOrdArr);
		$strSort = "";
		switch ($lvSortNum) {
			case 0:
				break;
			case 1:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "asc");
				break;
			case 2:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "desc");
				break;
		}
		$lvTable = "
		<ul id=\"menu3-nav\">
			<li class=\"menusubT3\">
				<a target=\"_self\" href=\"\">
				<img style=\"position:absolute;right:0px;top:-20px\" src=\"../images/lvicon/recent_l.png\" height=\"50\" border=\"0\">
				</a>
			<ul id=\"submenu3-nav\">
				<li><table  align=\"center\" class=\"lvtable\">
		<!--<tr ><td colspan=\"" . (2 + count($lstArr)) . "\" class=\"lvTTable\">" . $this->ArrPush[0] . "</td></tr>-->
		@#01
		</table></li>
			</ul>
			</li>
		</ul>
		";
		$lvTrH = "<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">" . $this->ArrPush[1] . "</td>
			<td width=1%><input name=\"$lvChkAll\" type=\"checkbox\" id=\"$lvChkAll\" onclick=\"DoChkAll($lvFrom, '$lvChk', this)\" value=\"$curRow\" tabindex=\"2\"/></td>
			@#01
		</tr>
		";
		$lvTr = "<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			<td width=1%><input type=\"image\" class=\"btn_img_rpt\" name=\"$lvChk\"  id=\"$lvChk@03\" onclick=\"Report('@02')\" value=\"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\"  tabindex=\"2\"  border=\"0\"/></td>
			@#01
		</tr>
		";
		$lvTdH = "<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd = "<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM wh_lv0008 WHERE 1=1 and lv009 like '$lvDateSort%' " . $this->GetConditionMini() . " $strSort LIMIT $curRow, $maxRows";
		$vorder = $curRow;
		$bResult = db_query($sqlS);
		$this->Count = db_num_rows($bResult);
		$strTrH = "";
		$strTr = "";
		for ($i = 0; $i < count($lstArr); $i++) {
			$vTemp = str_replace("@01", "", $lvTdH);
			$vTemp = str_replace("@02", $this->ArrPush[(int) $this->ArrGet[$lstArr[$i]]], $vTemp);
			$strH = $strH . $vTemp;

		}

		while ($vrow = db_fetch_array($bResult)) {
			$strL = "";
			$vorder++;
			for ($i = 0; $i < count($lstArr); $i++) {
				if ($lstArr[$i] == "lv010") {
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetBLMoney($vrow['lv001']), (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} else
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				$strL = $strL . $vTemp;
			}


			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv007'] == 1)
				$strTr = str_replace("@#04", "lvlineapproval", $strTr);
			else
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strTrH = str_replace("@#01", $strH, $lvTrH);
		return str_replace("@#01", $strTrH . $strTr, $lvTable);
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList, $lvFrom, $lvChkAll, $lvChk, $curRow, $maxRows, $paging, $lvOrderList)
	{

		if ($lvList == "")
			$lvList = $this->DefaultFieldList;
		if ($this->isView == 0)
			return false;
		$lstArr = explode(",", $lvList);
		$lstOrdArr = explode(",", $lvOrderList);
		$lstArr = $this->getsort($lstArr, $lstOrdArr);
		$strSort = "";
		switch ($lvSortNum) {
			case 0:
				break;
			case 1:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "asc");
				break;
			case 2:
				$strSort = " order by " . $this->LV_SortBuild($this->GB_Sort, "desc");
				break;
		}
		$lvTable = "
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		@#02
		</table>
		";
		$lvTrH = "<tr>			
			@#01
		</tr>
		";
		$lvTr = "<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdF = "<td align=\"@#05\"><strong>@01</strong></td>";
		$strF = "<tr ondblclick=\"this.innerHTML='';\">";
		$lvTdH = "<td width=\"@01\" class=\"lvtabletd\">@02</td>";
		$lvTd = "<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM wh_lv0008 WHERE 1=1  " . $this->GetConditionRpt() . " $strSort LIMIT $curRow, $maxRows";
		$vorder = $curRow;
		$bResult = db_query($sqlS);
		$this->Count = db_num_rows($bResult);
		$strTrH = "";
		$strTr = "";
		for ($i = 0; $i < count($lstArr); $i++) {
			$vTemp = str_replace("@01", "", $lvTdH);
			$vTemp = str_replace("@02", $this->ArrPush[(int) $this->ArrGet[$lstArr[$i]]], $vTemp);
			$strH = $strH . $vTemp;
			$vTempF = str_replace("@01", "<!--" . $lstArr[$i] . "-->", $lvTdF);
			$strF = $strF . $vTempF;
		}

		while ($vrow = db_fetch_array($bResult)) {
			$strL = "";
			$vorder++;
			$vlineamount = $this->LV_GetBLMoney($vrow['lv001']);
			$vsumamount = $vsumamount + $vlineamount;
			for ($i = 0; $i < count($lstArr); $i++) {
				if ($lstArr[$i] == "lv010") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vlineamount, (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} else
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				$strL = $strL . $vTemp;
			}
			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv007'] == 1)
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strF = $strF . "</tr>";
		$strF = str_replace("<!--lv010-->", $this->FormatView($vsumamount, 10), $strF);
		$strF = str_replace("<!--lv003-->", '<p style="text-align:center;padding:5px">Tổng:</p>', $strF);
		$lvTable = str_replace("@#02", $strF, $lvTable);
		$strTrH = str_replace("@#01", $strH, $lvTrH);
		return str_replace("@#01", $strTrH . $strTr, $lvTable);
	}

	public function LV_LinkField($vFile, $vSelectID)
	{
		return ($this->CreateSelect($this->sqlcondition($vFile, $vSelectID), 2));
	}
	private function sqlcondition($vFile, $vSelectID)
	{
		$vsql = "";
		switch ($vFile) {
			case 'lv002':
				$strwh = $this->Get_WHControler();
				$vsql = "select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001 in ($strwh) and lv001!=''";
				break;
			case 'lv003':
				$vsql = "select lv001,concat(lv004,lv003,lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;
			case 'lv005':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0013 where lv003 in (0,1)";
				break;
			case 'lv907':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0005";
				break;
		}
		return $vsql;
	}
	public function getvaluelink($vFile, $vSelectID)
	{
		switch ($vFile) {
			case 'lv002':
				$vsql = "select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0001 where lv001='$vSelectID'";
				break;
			case 'lv003':
				$vsql = "select lv001,concat(lv004,lv003,lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv005':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0013 where lv001='$vSelectID'";
				break;
			default:
				$vsql = "";
				break;
		}
		if ($vsql == "") {
			return $vSelectID;
		} else
			$lvResult = db_query($vsql);
		while ($row = db_fetch_array($lvResult)) {
			return ($lvopt == 0) ? $row['lv002'] : (($lvopt == 1) ? $row['lv001'] . "(" . $row['lv002'] . ")" : (($lvopt == 2) ? $row['lv002'] . "(" . $row['lv001'] . ")" : $row['lv001']));
		}

	}
	function LV_LoadMobil()
	{
		$vsql = "select * from wh_lv0008";
		$vresult = db_query($vsql);
		return $vresult;
	}

	function MB_Delete($id)
	{
		$lvsql = "delete from wh_lv0008 where lv007 <=0 and lv001='$id'";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			echo "Xóa thành công";
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'wh_lv0008.delete', sof_escape_string($lvsql));
		return $vReturn;
	}


	function generateMaPhieuNhap()
	{
		$month = date('m');
		$year = date('Y');
		$vsql = "SELECT MAX(SUBSTRING_INDEX(lv001, '-', -1)) AS maxIndex 
				FROM wh_lv0008 WHERE lv001 LIKE 'PN-$month/$year-%'";
		$vresult = db_query($vsql);
		$lastIndex = 0;
		if ($vresult) {
			$row = mysqli_fetch_array($vresult);
			if ($row && isset($row[0])) {
				$lastIndex = intval($row[0]);
			}
		}
		$newIndex = $lastIndex + 1;
		$formattedIndex = str_pad($newIndex, 4, '0', STR_PAD_LEFT);
		return "PN-$month/$year-$formattedIndex";
	}
}
?>