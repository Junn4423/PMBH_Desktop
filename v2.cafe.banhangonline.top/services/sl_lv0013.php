<?php
/////////////coding sl_lv0013///////////////
class sl_lv0013 extends lv_controler
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
	public $lv010 = null;
	public $lv011 = null;
	public $lv012 = null;
	public $lv013 = null;
	public $lv014 = null;
	public $lv015 = null;
	public $lv016 = null;
	public $lv017 = null;
	///////////
	public $DefaultFieldList = "lv001,lv002,lv100,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv032";
	////////////////////GetDate
	public $DateDefault = "1900-01-01";
	public $DateCurrent = "1900-01-01";
	public $Count = null;
	public $paging = null;
	public $sumTang = 0;
	public $lang = null;
	public $obj_conf = null;
	protected $objhelp = 'sl_lv0013';
	public $obj_child = null;
	public $itemlist = null;
	////////////
	var $ArrOther = array();
	var $ArrPush = array();
	var $ArrFunc = array();
	var $ArrGet = array("lv001" => "2", "lv002" => "3", "lv003" => "4", "lv004" => "5", "lv005" => "6", "lv006" => "7", "lv007" => "8", "lv008" => "9", "lv009" => "10", "lv010" => "11", "lv011" => "12", "lv012" => "13", "lv013" => "14", "lv014" => "15", "lv015" => "16", "lv016" => "17", "lv017" => "18", "lv018" => "19", "lv019" => "20", "lv020" => "21", "lv021" => "22", "lv022" => "23", "lv023" => "24", "lv024" => "25", "lv025" => "26", "lv026" => "27", "lv027" => "28", "lv028" => "29", "lv029" => "30", "lv032" => "33", "lv100" => "101");
	var $ArrView = array("lv001" => "0", "lv002" => "0", "lv003" => "0", "lv004" => "4", "lv005" => "4", "lv006" => "0", "lv007" => "0", "lv008" => "0", "lv009" => "0", "lv010" => "0", "lv011" => "0", "lv012" => "0", "lv013" => "0", "lv014" => "0", "lv015" => "10", "lv016" => "0", "lv017" => "0", "lv018" => "0", "lv019" => "22", "lv020" => "0", "lv021" => "22", "lv022" => "10", "lv023" => "10", "lv024" => "10", "lv025" => "10", "lv026" => "10", "lv027" => "10", "lv028" => "0", "lv029" => "0", "lv032" => "0", "lv100" => "0");

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
		$vsql = "select * from  sl_lv0013";
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
			$this->lv010 = $vrow['lv010'];
			$this->lv011 = $vrow['lv011'];
			$this->lv012 = $vrow['lv012'];
			$this->lv013 = $vrow['lv013'];
			$this->lv014 = $vrow['lv014'];
			$this->lv015 = $vrow['lv015'];
			$this->lv016 = $vrow['lv016'];
			$this->lv017 = $vrow['lv017'];
			$this->lv018 = $vrow['lv018'];
			$this->lv019 = $vrow['lv019'];
			$this->lv020 = $vrow['lv020'];
			$this->lv021 = $vrow['lv021'];
			$this->lv022 = $vrow['lv022'];
			$this->lv032 = $vrow['lv032'];
		}
	}
	function LV_ExistEmp($vlv010, $vlv007, &$vBlock = 0)
	{
		$lvsql = "select lv001,lv031 from sl_lv0013 BB where BB.lv007='$vlv007' and (BB.lv011=0)";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			$vBlock = $vrow['lv031'];
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_ChangeShiftAutoUpdate($vProgID)
	{
		if ($vProgID == "" || $vProgID == NULL)
			return;
		$lvsql = "select * from  sl_lv0013 Where lv011='0' and (lv012<>'$vProgID' and lv012<>'')";
		$vresult = db_query($lvsql);
		while ($vrow = db_fetch_array($vresult)) {
			if ($strLv001 == "")
				$strLv001 = "'" . $vrow['lv001'] . "'";
			else
				$strLv001 = $strLv001 . ",'" . $vrow['lv001'] . "'";

		}
		if ($strLv001 != "") {
			$vsql = "select * from sl_lv0014 where lv002 in ($strLv001)";
			$vresult = db_query($vsql);
			while ($vrow = db_fetch_array($vresult)) {
				$this->mosl_lv0014->LV_CheckPriceItem($vItem, $vProgId, $vPercent, $vPrice);
				$vsql = "update sl_lv0014 set lv006=IF($vPrice=0,lv006,$vPrice),lv011='$vPercent' where lv001='" . $vrow['lv001'] . "'";
				db_query($vsql);
			}
			$vsql = "update sl_lv0013 set lv012='$vProgID' where lv001 in ($strLv001) and lv011=0";
			db_query($vsql);

		}
	}

	function LV_LoadChild($vparent)
	{
		$vsql = "select * from  sl_lv0013 where lv017='$vparent'";
		$vresult = db_query($vsql);
		return $vresult;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql = "select * from  sl_lv0013 Where lv001='$vlv001'";
		$vresult = db_query($lvsql);
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
			$this->lv010 = $vrow['lv010'];
			$this->lv011 = $vrow['lv011'];
			$this->lv012 = $vrow['lv012'];
			$this->lv013 = $vrow['lv013'];
			$this->lv014 = $vrow['lv014'];
			$this->lv015 = $vrow['lv015'];
			$this->lv016 = $vrow['lv016'];
			$this->lv017 = $vrow['lv017'];
			$this->lv018 = $vrow['lv018'];
			$this->lv019 = $vrow['lv019'];
			$this->lv020 = $vrow['lv020'];
			$this->lv021 = $vrow['lv021'];
			$this->lv022 = $vrow['lv022'];
			$this->lv023 = $vrow['lv023'];
			$this->lv030 = $vrow['lv030'];
			$this->lv031 = $vrow['lv031'];
			$this->lv032 = $vrow['lv032'];
			$this->lv099 = $vrow['lv099'];
		}
	}
	function LV_LoadIDAmount($vlv001)
	{
		$lvsql = "select * from  sl_lv0013 Where lv001='$vlv001'";
		$vresult = db_query($lvsql);
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
			$this->lv010 = $vrow['lv010'];
			$this->lv011 = $vrow['lv011'];
			$this->lv012 = $vrow['lv012'];
			$this->lv013 = $vrow['lv013'];
			$this->lv014 = $vrow['lv014'];
			$this->lv015 = $vrow['lv015'];
			$this->lv016 = $vrow['lv016'];
			$this->lv017 = $vrow['lv017'];
			$this->lv018 = $vrow['lv018'];
			$this->lv019 = $vrow['lv019'];
			$this->lv020 = $vrow['lv020'];
			$this->lv021 = $vrow['lv021'];
			$this->lv022 = $vrow['lv022'];
			$this->lv030 = $vrow['lv030'];
			$this->lv031 = $vrow['lv031'];
			$this->lv032 = $vrow['lv032'];
			$this->lv023 = $this->LV_GetContractMoney($this->lv001, $this->lv006);
		}
	}
	function LV_GetBH_InvoiceParent($vContractID)
	{
		$vReturn = array();
		$lvsql = "select B.lv001,B.lv006,B.lv007,B.lv031 from  sl_lv0013 B  where B.lv001='$vContractID'";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		$vReturn[0] = $vrow['lv001'];
		$vReturn[1] = $vrow['lv007'];
		$vReturn[4] = $vrow['lv031'];
		$vReturn[2] = $this->LV_GetContractMoneyConLai($vReturn[0], $vrow['lv006']);
		$vReturn[3] = $this->LV_GetContractMoney($vReturn[0], $vrow['lv006']);
		return $vReturn;
	}
	function LV_GetBH_Invoice($vDetailID)
	{
		$vReturn = array();
		$lvsql = "select B.lv001,B.lv006,B.lv007,B.lv031 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where A.lv001='$vDetailID'";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		$vReturn[0] = $vrow['lv001'];
		$vReturn[1] = $vrow['lv007'];
		$vReturn[4] = $vrow['lv031'];
		$vReturn[2] = $this->LV_GetContractMoneyConLai($vReturn[0], $vrow['lv006']);
		$vReturn[3] = $this->LV_GetContractMoney($vReturn[0], $vrow['lv006']);
		return $vReturn;
	}
	function LV_ExistTemp($vUserID)
	{
		$lvsql = "select count(*) num from sl_lv0032 where lv002='$vUserID'";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			return $vrow['num'];
		}
		return 0;
	}
	function LV_ExistDetail($vDonHang, $vTypeRoom)
	{
		$lvsql = "select A.lv003,(select BB.lv003 from sl_lv0072 BB where BB.lv004=A.lv003 and BB.lv002=B.lv007 limit 0,1) TypeRoom from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 where A.lv002='$vDonHang'";
		$vresult = db_query($lvsql);
		$vType = false;
		while ($vrow = db_fetch_array($vresult)) {

			if ($vrow['TypeRoom'] != "") {
				if ($vTypeRoom == $vrow['TypeRoom'])
					$vType = true;
			}
		}
		return 0;
	}
	function LV_ExistTempDefault($vRoomID)
	{
		$lvsql = "select count(*) num from sl_lv0072 where lv002='$vRoomID'";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			return $vrow['num'];
		}
		return 0;
	}
	function LV_RoomExist($vlv007)
	{
		$lvsql = "select lv001 from sl_lv0013 BB where BB.lv007='$vlv007' and BB.lv011=0";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_Exist($vlv007)
	{
		$lvsql = "select lv001 from sl_lv0013 BB where BB.lv007='$vlv007' and (BB.lv011=0 or BB.lv011=1)";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow) {
			return $vrow['lv001'];
		}
		return '';
	}
	function LV_CheckRoomNew()
	{
		$lvsql = "select lv001 from sl_lv0009 order by lv005";
		$vresult = db_query($lvsql);
		while ($vrow = db_fetch_array($vresult)) {
			if ($lstSQL == "")
				$lstSQL = "SELECT ROOMNO,CONVERT(VARCHAR(20), [INTIME], 120) [INTIME] FROM (SELECT top 1 * from [ADEL9200].[dbo].[KRK] where ROOMNO='" . $vrow['lv001'] . "' order by INTIME DESC) MP";
			else
				$lstSQL = $lstSQL . "
				UNION
				SELECT ROOMNO,CONVERT(VARCHAR(20), [INTIME], 120) [INTIME] FROM ( SELECT top 1 * from [ADEL9200].[dbo].[KRK] where ROOMNO='" . $vrow['lv001'] . "' order by INTIME DESC) MP";
		}
		return $lstSQL;
	}
	function LV_CheckSQL()
	{
		$server = $this->ServerSQL;

		// Connect to MSSQL
		$link = mssql_connect($server, '', '');

		if (!$link || !mssql_select_db($this->DataBaseSQL, $link)) {
			die('Unable to connect or select database!');
		}
		$vsql = $this->LV_CheckRoomNew();
		// Do a simple query, select the version of 
		// MSSQL and print it.
		$version = mssql_query($vsql);
		while ($row = mssql_fetch_array($version)) {
			$this->LV_ProcessUpdate($row['ROOMNO'], $row['INTIME']);
		}



		// Clean up
		mssql_free_result($version);
	}
	function LV_ProcessUpdate($vBangID, $vDateStart)
	{
		$lvsql = "select lv001 from sl_lv0013 where lv007='$vBangID' and lv004='$vDateStart'";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		$vCodeId = '';
		if ($vrow) {
			$vCodeId = $vrow['lv001'];
		}
		if ($vCodeId != "" && $vCodeId != NULL) {
			//check state 
		} else {
			//Insert 
			$this->lv001 = InsertWithCheck('sl_lv0013', 'lv001', 'BH-' . getmonth($this->DateCurrent) . "/" . getyear($this->DateCurrent) . "-", 1);
			$this->lv004 = $vDateStart;
			$this->lv007 = $vBangID;
			$this->LV_InsertTemp();
		}
	}
	function LV_Insert()
	{

		if ($this->isAdd == 0)
			return false;
		$this->lv004 = ($this->lv004 != "") ? recoverdate(($this->lv004), $this->lang) . " " . gettime($this->lv004) : $this->DateDefault;
		$this->lv005 = ($this->lv005 != "") ? recoverdate(($this->lv005), $this->lang) . " " . gettime($this->lv005) : $this->DateDefault;
		$lvsql = "insert into sl_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv022,lv027) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv022','$this->lv027')";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.insert', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_InsertBoth($oldid, $newid)
	{
		if ($this->isAdd == 0)
			return false;
		$lvsql = "Update sl_lv0014 set lv002='$newid'  WHERE lv002 ='" . $oldid . "'";
		$vReturn = db_query($lvsql);
		$lvsql = "Update sl_lv0013 set lv025='$newid' WHERE lv001 ='" . $oldid . "'";
		$vReturn = db_query($lvsql);
	}
	function LV_InsertTemp()
	{

		if ($this->isAdd == 0)
			return false;
		//$this->lv004 = ($this->lv004!="")?recoverdate(($this->lv004), $this->lang):$this->DateDefault;
		$this->lv005 = ($this->lv005 != "") ? recoverdate(($this->lv005), $this->lang) : $this->DateDefault;
		$lvsql = "insert into sl_lv0013 (lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv022,lv027) values('$this->lv001','$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv022','$this->lv027')";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.insert', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		if ($this->isEdit == 0)
			return false;

		$this->lv004 = ($this->lv004 != "") ? recoverdate(($this->lv004), $this->lang) . " " . gettime($this->lv004) : $this->DateDefault;
		$this->lv005 = ($this->lv005 != "") ? recoverdate(($this->lv005), $this->lang) . " " . gettime($this->lv005) : $this->DateDefault;
		$lvsql = "Update sl_lv0013 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010' ,lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv022='$this->lv022'  where  lv001='$this->lv001' and lv011<=0;";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.update', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UpdateNoDate()
	{
		if ($this->isEdit == 0)
			return false;

		$this->lv004 = ($this->lv004 != "") ? recoverdate(($this->lv004), $this->lang) . " " . gettime($this->lv004) : $this->DateDefault;
		$this->lv005 = ($this->lv005 != "") ? recoverdate(($this->lv005), $this->lang) . " " . gettime($this->lv005) : $this->DateDefault;
		$lvsql = "Update sl_lv0013 set lv002='$this->lv002',lv003='$this->lv003',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010' ,lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv022='$this->lv022'  where  lv001='$this->lv001' and lv011<=0;";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.update', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if ($this->isDel == 0)
			return false;
		$lvsql = "DELETE FROM sl_lv0013  WHERE sl_lv0013.lv001 IN ($lvarr) and  sl_lv0013.lv011<=0";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.delete', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Aproval($lvarr)
	{
		if ($this->isApr == 0)
			return false;
		$vUserID = getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$lvsql = "Update sl_lv0013 set lv011=IF(lv011<4,lv011+1,4),lv018='$vUserID',lv019=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0013.lv001 IN ($lvarr)  ";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.approval', sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_UnAproval($lvarr)
	{
		if ($this->isUnApr == 0)
			return false;
		$vUserID = getInfor($_SESSION['ERPSOFV2RUserID'], 2);
		$lvsql = "Update sl_lv0013 set lv011=0,lv018='$vUserID',lv019=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0013.lv001 IN ($lvarr)  ";
		//$lvsql = "Update sl_lv0013 set lv011=IF(lv011>0,lv011-1,0),lv018='$vUserID',lv019=concat(CURDATE(),' ',CURTIME())  WHERE sl_lv0013.lv001 IN ($lvarr)  ";
		$vReturn = db_query($lvsql);
		if ($vReturn)
			$this->InsertLogOperation($this->DateCurrent, 'sl_lv0013.unapproval', sof_escape_string($lvsql));
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
		if ($this->lv010 != "")
			$strCondi = $strCondi . " and lv010 like '%$this->lv010%'";
		if ($this->lv011 != "")
			$strCondi = $strCondi . " and lv011 like '%$this->lv011%'";
		if ($this->lv012 != "")
			$strCondi = $strCondi . " and lv012 like '%$this->lv012%'";
		if ($this->lv013 != "")
			$strCondi = $strCondi . " and lv013 like '%$this->lv013%'";
		if ($this->lv014 != "")
			$strCondi = $strCondi . " and lv014 like '%$this->lv014%'";
		if ($this->lv015 != "")
			$strCondi = $strCondi . " and lv015 like '%$this->lv015%'";
		if ($this->lv016 != "")
			$strCondi = $strCondi . " and lv016 like '%$this->lv016%'";
		if ($this->lv017 != "")
			$strCondi = $strCondi . " and lv017 like '%$this->lv017%'";
		if ($this->lv018 != "")
			$strCondi = $strCondi . " and lv018 like '%$this->lv018%'";
		if ($this->lv019 != "")
			$strCondi = $strCondi . " and lv019 like '%$this->lv019%'";
		return $strCondi;
	}
	protected function GetConditionView()
	{
		$strCondi = "";
		if ($this->lv001 != "")
			$strCondi = $strCondi . " and lv001  = '$this->lv001'";
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
		if ($this->lv010 != "")
			$strCondi = $strCondi . " and lv010 like '%$this->lv010%'";
		if ($this->lv011 != "")
			$strCondi = $strCondi . " and lv011 like '%$this->lv011%'";
		if ($this->lv012 != "")
			$strCondi = $strCondi . " and lv012 like '%$this->lv012%'";
		if ($this->lv013 != "")
			$strCondi = $strCondi . " and lv013 like '%$this->lv013%'";
		if ($this->lv014 != "")
			$strCondi = $strCondi . " and lv014 like '%$this->lv014%'";
		if ($this->lv015 != "")
			$strCondi = $strCondi . " and lv015 like '%$this->lv015%'";
		if ($this->lv016 != "")
			$strCondi = $strCondi . " and lv016 like '%$this->lv016%'";
		if ($this->lv017 != "")
			$strCondi = $strCondi . " and lv017 like '%$this->lv017%'";
		if ($this->lv018 != "")
			$strCondi = $strCondi . " and lv018 like '%$this->lv018%'";
		if ($this->lv019 != "")
			$strCondi = $strCondi . " and lv019 like '%$this->lv019%'";
		return $strCondi;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM sl_lv0013 WHERE 1=1 " . $this->GetCondition();
		$bResultC = db_query($sqlC);
		$arrRowC = db_fetch_array($bResultC);
		return $arrRowC['nums'];
	}
	function LV_ListPopupYear($vCustomerID, $vYearTo, $vOrder = 0)
	{
		$i = 2014;
		$vStrReturn = '
		<div  style="position:relative"><img src="../images/icon/income.png" onclick="document.getElementById(\'logto_' . $vOrder . '\').style.display=\'block\'">
		<div id="logto_' . $vOrder . '" style="display:none;position:absolute;z-index:9999;background:#FFF;" >
		<img src="../images/icon/closefull.png" style="position:absolute;right:0px;top:0px" onclick="document.getElementById(\'logto_' . $vOrder . '\').style.display=\'none\'">
		
		<table border=1 cellspacing=0 cellpadding=0 class="lvtable" style="width:150px!important">
		<tr class="lvhtable"><td  class="lvhtable">Năm</td><td  class="lvhtable">Tổng doanh thu</td>
		';
		$vSum = 0;
		for (; $i <= $vYearTo; $i++) {
			$vDoanhthu = $this->LV_GetContractMoneyCustomerDate($vCustomerID, $i . '-01-01', $i . '-12-31') + $this->LV_GetContractMoneyCustomerDetailDate($vCustomerID, $i . '-01-01', $i . '-12-31');
			$vSum = $vSum + $vDoanhthu;
			$vStrReturn = $vStrReturn . "<tr class=\"lvlinehtable" . ($i % 2) . "\"><td>" . $i . "</td><td align=right>" . $this->FormatView($vDoanhthu, 10) . "</td></tr>";
		}
		$vStrReturn = $vStrReturn . "
		<tr class=\"lvlinehtable" . ($i % 2) . "\"><td >Tổng:</td><td align=right> " . $this->FormatView($vSum, 10) . "</td></tr>";
		$i++;
		$vDoanhthu = $this->LV_GetContractMoneyCustomerDate($vCustomerID, $this->obj_conf->lv015, $this->obj_conf->lv016) + $this->LV_GetContractMoneyCustomerDetailDate($vCustomerID, $this->obj_conf->lv015, $this->obj_conf->lv016);
		$vSumPoint = round($vDoanhthu / $this->obj_conf->lv009, 0);
		$vSumVoucher = $this->LV_GetPointVoucher($vCustomerID, $this->obj_conf->lv015, $this->obj_conf->lv016);
		$vStrReturn = $vStrReturn . "
		<tr class=\"lvlinehtable" . ($i % 2) . "\"><td colspan='2' ><strong>Ma KH:</strong> " . $vCustomerID . "</td></tr>
		<tr class=\"lvlinehtable" . ($i % 2) . "\"><td colspan='2' ><strong>Điểm lũy kế:</strong> " . $this->FormatView($vSumPoint, 10) . "</td></tr>
		<tr class=\"lvlinehtable" . ($i % 2) . "\"><td colspan='2' ><strong>Đổi voucher:</strong> " . $this->FormatView($vSumVoucher, 10) . "</td></tr>
		<tr class=\"lvlinehtable" . ($i % 2) . "\"><td colspan='2' ><strong>Còn lại: " . $this->FormatView($vSumPoint - $vSumVoucher, 10) . "</strong></td></tr>
		</table>
		</div>
		</div>
		";
		return $vStrReturn;
	}
	function LV_GetContractMoneyYear($vCustomerID, $vYear)
	{
		$lvsql = "select sum(PM.lv003) money,sum(PM.lv004) convertmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001  where C.lv099=0 and B.lv002='$vCustomerID' AND B.lv011>=1 and Year(B.lv004)='$vYear' )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		return $vrow['convertmoney'] + $vrow['money'];
	}
	function LV_GetContractMoney($vContractID, $vTax = 0)
	{
		$lvsql = "select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'  )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		if ($vTax != 0) {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
		} else {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
		}
	}
	function LV_GetContractMoneyConLai($vContractID, $vTax = 0)
	{
		if ($vContractID == "" || $vContractID == NULL)
			return 0;
		$lvsql = "select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'  )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		if ($vTax != 0) {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
		} else {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
		}
	}
	function LV_GetContractMoneyCustomerDetail($vCustomerID, $vTax = 0)
	{
		if ($vCustomerID == "" || $vCustomerID == NULL)
			return 0;
		$lvsql = "select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and A.lv015='$vCustomerID' and (CHARACTER_LENGTH(A.lv015)>3) )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		if ($vTax != 0) {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
		} else {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
		}
	}
	function LV_GetPointVoucher($vCusID, $vDateStart, $vDateEnd)
	{
		//GetMoney
		if (trim($vDateStart) != "") {
			$vCondition = $vCondition . " AND A.lv005>='$vDateStart 00:00:00' ";
		}
		if (trim($vDateEnd) != "") {
			$vCondition = $vCondition . " AND A.lv005<='$vDateEnd 23:59:59' ";
		}
		if ($vCusID == '' || $vCusID == NULL)
			return 0;
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumPoint from sl_lv0115 A  WHERE A.lv002='$vCusID' and lv015>=1 $vCondition";
		$vReturnArr = array();
		$lvResult = db_query($lvsql);
		$row = db_fetch_array($lvResult);
		return $row['SumPoint'];

	}
	function LV_GetContractMoneyCustomerDate($vCustomerID, $vDateStart = '', $vDateEnd = '', $vTax = 0)
	{
		if ($vDateStart != "") {
			$vCondition = $vCondition . " AND B.lv005>='$vDateStart 00:00:00' ";
		}
		if ($vDateEnd != "") {
			$vCondition = $vCondition . " AND B.lv005<='$vDateEnd 23:59:59' ";
		}
		if ($vCustomerID == "" || $vCustomerID == NULL)
			return 0;
		$lvsql = "select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and (ISNULL(A.lv010) or A.lv010<>'1') $vCondition and B.lv002='$vCustomerID' and (CHARACTER_LENGTH(A.lv015)<=3)  )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		if ($vTax != 0) {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
		} else {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
		}
	}
	function LV_GetContractMoneyCustomerDateArr($vDateStart = '', $vDateEnd = '')
	{
		$vArrCus = array();
		if ($vDateStart != "") {
			$vCondition = $vCondition . " AND B.lv005>='$vDateStart 00:00:00' ";
		}
		if ($vDateEnd != "") {
			$vCondition = $vCondition . " AND B.lv005<='$vDateEnd 23:59:59' ";
		}
		$lvsql = "select PM.lv002,PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select B.lv002,sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and (ISNULL(A.lv010) or A.lv010<>'1') $vCondition  and (CHARACTER_LENGTH(A.lv015)<=3)  group by B.lv002)) PM  group by lv002";
		$vresult = db_query($lvsql);
		while ($vrow = db_fetch_array($vresult)) {
			if ($vrow['convertmoney'] == 0) {
				if ($vrow['money'] == 0)
					$vArrCus[$vrow['lv002']] = 0;
			}
			if ($vTax != 0) {
				$allsum = $vrow['money'];
				if ($vrow['CKTM'] > 0)
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
				else
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
			} else {
				$allsum = $vrow['money'];
				if ($vrow['CKTM'] > 0)
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
				else
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
			}
		}
		return $vArrCus;
	}
	function LV_GetContractMoneyCustomerDetailDateArr($vDateStart = '', $vDateEnd = '')
	{
		$vArrCus = array();
		if ($vDateStart != "") {
			$vCondition = $vCondition . " AND B.lv005>='$vDateStart 00:00:00' ";
		}
		if ($vDateEnd != "") {
			$vCondition = $vCondition . " AND B.lv005<='$vDateEnd 23:59:59' ";
		}
		$lvsql = "select PM.lv002,PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select B.lv002,sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1  and (ISNULL(A.lv010) or A.lv010<>'1') $vCondition and (CHARACTER_LENGTH(A.lv015)>3) group by B.lv002 )) PM group by lv002";
		$vresult = db_query($lvsql);
		while ($vrow = db_fetch_array($vresult)) {
			if ($vrow['convertmoney'] == 0) {
				if ($vrow['money'] == 0)
					$vArrCus[$vrow['lv002']] = "0";
			}
			if ($vTax != 0) {
				$allsum = $vrow['money'];
				if ($vrow['CKTM'] > 0)
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
				else
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
			} else {
				$allsum = $vrow['money'];
				if ($vrow['CKTM'] > 0)
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
				else
					$vArrCus[$vrow['lv002']] = round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
			}
		}
	}
	function LV_GetContractMoneyCustomerDetailDate($vCustomerID, $vDateStart = '', $vDateEnd = '', $vTax = 0)
	{
		if ($vDateStart != "") {
			$vCondition = $vCondition . " AND B.lv005>='$vDateStart 00:00:00' ";
		}
		if ($vDateEnd != "") {
			$vCondition = $vCondition . " AND B.lv005<='$vDateEnd 23:59:59' ";
		}
		if ($vCustomerID == "" || $vCustomerID == NULL)
			return 0;
		$lvsql = "select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1  and (ISNULL(A.lv010) or A.lv010<>'1') $vCondition and A.lv015='$vCustomerID' and (CHARACTER_LENGTH(A.lv015)>3) )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		if ($vTax != 0) {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
		} else {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
		}
	}
	function LV_GetContractMoneyCustomer($vCustomerID, $vTax = 0)
	{
		if ($vCustomerID == "" || $vCustomerID == NULL)
			return 0;
		$lvsql = "select PM.CKTM,sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discountmoney from ((select sum((A.lv004)*A.lv006) lv003,sum((A.lv004)*A.lv006*A.lv008/100) lv004,sum((A.lv004)*A.lv006*A.lv011/100) lv005,B.lv022 CKTM from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv002='$vCustomerID' and (CHARACTER_LENGTH(A.lv015)<=3)  )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		if ($vTax != 0) {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['money'] * $vTax / 100 - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['money'] * $vTax / 100 - $vrow['discountmoney'], 0);
		} else {
			$allsum = $vrow['money'];
			if ($vrow['CKTM'] > 0)
				return round($allsum + $vrow['convertmoney'] - $allsum * $vrow['CKTM'] / 100 - $vrow['discountmoney'], 0);
			else
				return round($allsum + $vrow['convertmoney'] - $vrow['discountmoney'], 0);
		}
	}
	function LV_GetContractMoneyProduct($vContractID, $vTax = 0)
	{
		$lvsql = "select A.lv002,A.lv003,A.lv006,A.lv008,A.lv009,A.lv010,A.lv012 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID'";
		$vresult = db_query($lvsql);
		$vsumamount = 0;
		while ($vrow = db_fetch_array($vresult)) {
			$vqty_nhap = $this->obj_child->LV_GETNHAP_TP('CONTRACT', $vrow['lv002'], $vrow['lv003'], $vrow['lv010'], $vrow['lv009'], $vrow['lv012']);
			$vqty_nhaplai = $this->obj_child->LV_GETNHAP_TP('RECONTRACT', $vrow['lv002'], $vrow['lv003'], $vrow['lv010'], $vrow['lv009'], $vrow['lv012']);
			$vqty_xuat = $this->obj_child->LV_GETXUAT_TP('CONTRACT', $vrow['lv002'], $vrow['lv003'], $vrow['lv010'], $vrow['lv009'], $vrow['lv012']);
			$vqty_xuatlai = $this->obj_child->LV_GETXUAT_TP('RECONTRACT', $vrow['lv002'], $vrow['lv003'], $vrow['lv010'], $vrow['lv009'], $vrow['lv012']);
			$line_sumqty = $vqty_nhap + $vqty_nhaplai - $vqty_xuat - $vqty_xuatlai;

			if ($vTax != 0)
				$vsumamount += $line_sumqty * $vrow['lv006'] + $line_sumqty * $vrow['lv006'] * $vTax / 100;
			else
				$vsumamount += $line_sumqty * $vrow['lv006'] + $line_sumqty * $vrow['lv006'] * $vrow['lv008'] / 100;
		}
		return $vsumamount;
	}
	function LV_getTangView($vLangArr)
	{
		$vsql = "select * from sl_lv0008 order by lv004 asc";
		$lvResult = db_query($vsql);
		$lvNumRow = db_num_rows($lvResult);
		$vautocrease = 0;
		$vorder = 0;
		$vRights = '			
			<div style="float:left;width:80%">';
		$vLeft = '
		<div class="tang_left" style="float:left;width:15%">
			<ul>
			';
		$i = 1;
		while ($row = db_fetch_array($lvResult)) {
			$vTakeAway = '';
			if (strpos(' take a way, cafe mang đi, cafe mang di', strtolower($row['lv002'])) > 0)
				$vTakeAway = " takeaway";
			$vLeft = $vLeft . '<li><div style="" id="litangleft_' . $i . '" class="litangleft' . $vTakeAway . '" onclick="viewfloor(' . $i . ',' . $lvNumRow . ')">' . $row['lv002'] . '</div></li>';
			$vRights = $vRights . $this->LV_GetBangView($row['lv001'], $i, $lvNumRow, $vautocrease, $vorder, $vLangArr);
			$i++;
		}
		$this->sumTang = $i - 1;
		$vLeft = $vLeft . '		
	<li><div id="litangleft_0" class="litangleft current" onclick="viewfloorall(' . $lvNumRow . ')">Tất cả</div></li>
	</ul>
		<input type="hidden" value="' . $vautocrease . '" id="sumbang"/>
		<input type="hidden" value="' . $vorder . '" id="sumbangall"/>
		<input type="hidden" value="' . ($i - 1) . '" id="sumtangall"/>		
		</div>';
		$vRights = $vRights . '	
		</div>';
		return $vLeft . $vRights;
	}
	function LV_GetBangRun($lvsl_lv0014)
	{
		$vsql = "select A.*,(select lv001 from sl_lv0013 BB where BB.lv007=A.lv001 and (BB.lv011=0 || BB.lv011=1 ) limit 0,1) active  from sl_lv0009 A  order by lv005 asc";
		$lvResult = db_query($vsql);
		while ($row = db_fetch_array($lvResult)) {
			$vorder++;
			$active = false;
			$checks = false;

			$vHDGop = $this->LV_CheckGopBan($row['lv001']);
			if ($vHDGop != NULL) {
				$checks = true;
			}
			if ($row['active'] != "" && $row['active'] != NULL) {
				$active = true;
				$vCurHD = $this->LV_GetTimeInvoice($row['active']);
				$this->LV_GetDetailRun($lvsl_lv0014, $vCurHD, $row['active']);
			}

		}
		return $vLeft;
	}
	function LV_GetDetailRun($lvsl_lv0014, $vCurHD, $vContractID)
	{
		if ($this->itemlistTime == null)
			$this->itemlistTime = $this->LV_GetItem_Time('TIME');
		if ($this->itemlistDay == null)
			$this->itemlistDay = $this->LV_GetItem_Time('DAY');
		if ($this->itemlistCalc == null)
			$this->itemlistCalc = $this->LV_GetItem_Time('CALC');
		$vobjtext = "";
		$lvsql = "select A.*,C.lv002 Name from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 where 1=1 and B.lv001='$vContractID'";
		$vresult = db_query($lvsql);
		$i = 1;
		$vSum = 0;
		$vSumTT = 0;
		$isCal = true;
		$isDetail = true;
		$timeview = $vCurHD['timeview'];
		$curtime = $vCurHD['curtime'];
		$timeagain = $vCurHD['timeagain'];
		$days = $vCurHD['days'];
		$h24 = $vCurHD['h24'];
		$vsate = (int) $vCurHD['state'];
		if ($days > 0)
			$limittime = $timeagain + ($days - 1) * $h24 + $curtime;
		else
			$limittime = $curtime - $timeview;
		while ($vrow = db_fetch_array($vresult)) {
			if (strpos("," . $this->itemlistTime . ",", "," . $vrow['lv003'] . ",") === false) {
				if (strpos("," . $this->itemlistDay . ",", "," . $vrow['lv003'] . ",") === false) {
					$vobjtext = $vobjtext . '';

				} else {
					//$lvsl_lv0014->LV_UpdateQty($vrow['lv001'],$limittime);
				}
			} else {
				//$lvsl_lv0014->LV_UpdateQty($vrow['lv001'],$limittime);
			}
			if (strpos("," . $this->itemlistCalc . ",", "," . $vrow['lv003'] . ",") === false) {
				$vobjtext = $vobjtext . '';
			} else {
				$vQty = $lvsl_lv0014->LV_UpdateCalc($vrow['lv001']);
			}

		}
		return $vstr;
	}
	function LV_GetBangView($vTangID, $vTang, $lvNumRow, &$vautocrease, &$vorder, $vLangArr)
	{
		$vLeft = '<div id="bangtang_' . $vTang . '" class="bang_left" style="float:left;width:100%">
			';
		$vsql = "select A.*,(select lv001 from sl_lv0013 BB where BB.lv007=A.lv001 and (BB.lv011=0 || BB.lv011=1 ) limit 0,1) active  from sl_lv0009 A where A.lv004='$vTangID' order by lv005 asc";
		$lvResult = db_query($vsql);
		while ($row = db_fetch_array($lvResult)) {
			$vorder++;
			$active = false;
			$checks = false;

			$vHDGop = $this->LV_CheckGopBan($row['lv001']);
			if ($vHDGop != NULL) {
				$checks = true;
			}
			if ($row['active'] != "" && $row['active'] != NULL) {
				$active = true;
				$vCurHD = $this->LV_GetTimeInvoice($row['active']);
				$timeview = $vCurHD['timeview'];
				$curtime = $vCurHD['curtime'];
				$timeagain = $vCurHD['timeagain'];
				$days = $vCurHD['days'];
				$h24 = $vCurHD['h24'];
				$vsate = (int) $vCurHD['state'];
				if ($days > 0)
					$limittime = $timeagain + ($days - 1) * $h24 + $curtime;
				else
					$limittime = $curtime - $timeview;
				if (!$checks)
					$vautocrease++;
			}
			$vsum = $this->LV_GetContractMoneyConLai($row['active'], $vCurHD['VAT']);
			$vung = $this->LV_GetPTMoney($row['active']) - $this->LV_GetPCMoney($row['active']);
			$vLeft = $vLeft . '<div style="width:140px!important" id="bang_' . $vorder . '" class="bangleft ' . (($active || $checks) ? (($vsate == 0) ? 'active' : 'waiting') : '') . '" onclick="setBang(\'' . $row['lv001'] . '\',\'' . (($active || $checks) ? (($vsate == 0) ? '1' : '0') : '') . '\');//viewfloor(' . $vTang . ',' . $lvNumRow . ')">
				<div style="width:120px!important" id="bangtitle_' . $vorder . '" class="' . (($active || $checks) ? (($vsate == 0) ? 'bangtitle' : 'bangtitlewait') : 'bangtitlecur') . '"><div style="float:left">' . $row['lv001'] . '</div><div style="float:right">' . (($active) ? (($checks) ? '<span class="bangtime">' . $vHDGop['name'] . '</span>' : ' <span class="bangtime" id="bangtime_' . $vautocrease . '" title="' . $limittime . '">' . $this->sec_to_times($limittime) . '</span>') : '<span class="bangtime">' . $vHDGop['name'] . '</span>') . '</div></div>
				<ul style="clear:both;font-size:11px;font:Arial,tahoma;">
					<li>' . $vLangArr[85] . ': <span id="tongtien_' . $vorder . '">' . $this->FormatView($vsum, 10) . '</span></li>
					<li>' . $vLangArr[88] . ': <span id="tongtienung_' . $vorder . '">' . $this->FormatView($vung, 10) . '</span></li>
					<li>' . $vLangArr[89] . ': <span id="tongtienung_' . $vorder . '"><strong>' . $this->FormatView($vsum - $vung, 10) . '</strong></span></li>
					<li><div id="calendarview_' . $vorder . '" class="viewcalandar" style="display:none;clear:both;">
					<div style="float:left;width:100%;padding-bottom:25px">
				' . ((($active || $checks) && $vsate == 0) ? $this->LV_GetDetail($row['active'], $vorder, $vLangArr, $vSum) : '') . '
						<p style="position:absolute;right:0px;top:0px" onclick="closepopcalendar(\'' . $vorder . '\')"><img width="60" src="images/icon/closefull.png"/></p>
						<div style="position:absolute;left:0px;bottom:0px;height:25px">
							<div class="vitribang" style="width:280px">
							<div class="banhang" onclick="setviewhere(1)" style="float:left">' . $vLangArr[78] . '</div>
							<div class="banhang" onclick="Report(\'' . $row['active'] . '\')"  style="float:left;padding-left:15px;padding-right:15px;"> ' . $vLangArr[79] . ' </div>
							<div class="banhang" onclick="setContractID(\'' . $row['active'] . '\');setviewhere(1)"  style="float:left;padding-left:15px;padding-right:15px;">' . $vLangArr[80] . '</div>
							<div class="banhang" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;padding-left:15px;padding-right:15px;">' . $vLangArr[84] . '</div>
							<div class="banhang" onclick="tiencoc(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;padding-left:15px;padding-right:15px;">' . 'Tiền cọc' . '</div>
							<div class="banhang" onclick="tratiencoc(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;padding-left:15px;padding-right:15px;">' . 'Trả cọc' . '</div>
							</div>
						</div>
					</div>					
				</li>
					';
			$vLeft = $vLeft . '
				</ul>';
			if ($active)
				if ($vsate == 0) {
					/*$vLeft=$vLeft.'
																																																																																																																													<div class="vitribang" id="tratien_'.$vorder.'">
																																																																																																																														<div class="tratien" style="width:120px;padding:0px;padding-top:5px;padding-bottom:5px" onclick="viewpopcalendar(\''.$vorder.'\')">'.$vLangArr[77].'</div>
																																																																																																																													</div>					
																																																																																																																													';*/
				}
			$vLeft = $vLeft . '	
				</div>';
		}
		$vLeft = $vLeft . '		
		</div>';
		return $vLeft;
	}
	function LV_getTangMini($vLangArr)
	{
		$vsql = "select * from sl_lv0008 order by lv004 asc";
		$lvResult = db_query($vsql);
		$lvNumRow = db_num_rows($lvResult);
		$vautocrease = 0;
		$vorder = 0;
		$vRights = '			
			<div class="tang_right" style="float:left;position:relative;margin-top:10px;">';
		$vLeft = '
		<div class="tang_leftmini" style="float:left;width:100px">
			<ul>
			';
		$i = 1;
		while ($row = db_fetch_array($lvResult)) {
			$vTakeAway = '';
			if (strpos(' take a way, cafe mang đi, cafe mang di', strtolower($row['lv002'])) > 0)
				$vTakeAway = " takeaway";
			$vLeft = $vLeft . '<li><div id="litangleft_' . $i . '" class="litangleft' . $vTakeAway . '" onclick="viewfloor(' . $i . ',' . $lvNumRow . ')">' . $row['lv002'] . '</div></li>';
			$vRights = $vRights . $this->LV_GetBangMini($row['lv001'], $i, $lvNumRow, $vautocrease, $vorder, $vLangArr);
			$i++;
		}
		$this->sumTang = $i - 1;
		$vLeft = $vLeft . '		
			</ul>
		<input type="hidden" value="' . $vautocrease . '" id="litangleft_0"/>
		<input type="hidden" value="' . $vautocrease . '" id="sumbang"/>
		<input type="hidden" value="' . $vorder . '" id="sumbangall"/>
		<input type="hidden" value="' . ($i - 1) . '" id="sumtangall"/>		
		</div>';
		$vRights = $vRights . '	
		</div>';
		return $vLeft . $vRights;
	}
	function LV_getTang($vLangArr)
	{
		$vsql = "select * from sl_lv0008 order by lv004 asc";
		$lvResult = db_query($vsql);
		$lvNumRow = db_num_rows($lvResult);
		$vautocrease = 0;
		$vorder = 0;
		$vRights = '			
			<div style="float:left;width:80%">';
		$vLeft = '
		<div class="tang_left" style="float:left;width:15%">
			<ul>
			<li><div id="litangleft_0" class="litangleft current" onclick="viewfloorall(' . $lvNumRow . ')">Tất cả</div></li>
			';
		$i = 1;
		while ($row = db_fetch_array($lvResult)) {
			$vLeft = $vLeft . '<li><div id="litangleft_' . $i . '" class="litangleft" onclick="viewfloor(' . $i . ',' . $lvNumRow . ')">' . $row['lv002'] . '</div></li>';
			$vRights = $vRights . $this->LV_GetBang($row['lv001'], $i, $lvNumRow, $vautocrease, $vorder, $vLangArr);
			$i++;
		}
		$this->sumTang = $i - 1;
		$vLeft = $vLeft . '		</ul>
		<input type="hidden" value="' . $vautocrease . '" id="sumbang"/>
		<input type="hidden" value="' . $vorder . '" id="sumbangall"/>
		<input type="hidden" value="' . ($i - 1) . '" id="sumtangall"/>		
		</div>';
		$vRights = $vRights . '	
		</div>';
		return $vLeft . $vRights;
	}
	function sec_to_times($seconds)
	{
		if ($seconds == "")
			return "";
		$hours = floor($seconds / 3600);
		$minutes = floor($seconds % 3600 / 60);
		$seconds = $seconds % 60;

		return sprintf("%d:%02d:%02d", $hours, $minutes, $seconds);
	}
	function LV_GetBangMini($vTangID, $vTang, $lvNumRow, &$vautocrease, &$vorder, $vLangArr)
	{
		$vLeft = '<div id="bangtang_' . $vTang . '" class="bang_leftmini" style="float:left;width:100%">
			';
		$vsql = "select A.*,(select lv001 from sl_lv0013 BB where BB.lv007=A.lv001 and (BB.lv011=0 || BB.lv011=1 ) limit 0,1) active  from sl_lv0009 A where A.lv004='$vTangID' order by lv005 asc";
		$lvResult = db_query($vsql);
		$vlistItem = $this->LV_GetWHItemMini();
		while ($row = db_fetch_array($lvResult)) {
			$vorder++;
			$active = false;
			$checks = false;

			$vHDGop = $this->LV_CheckGopBan($row['lv001']);
			if ($vHDGop != NULL) {
				$checks = true;
			}
			$vCKTM = 0;
			$vVAT = 0;
			$limittime = '';
			$vCurHD = NULL;
			$vLockBill = 0;
			if ($row['active'] != "" && $row['active'] != NULL) {
				$active = true;
				$vCurHD = $this->LV_GetTimeInvoice($row['active']);
				$timeview = $vCurHD['timeview'];
				$curtime = $vCurHD['curtime'];
				$vCKTM = $vCurHD['CKTM'];
				$vVAT = $vCurHD['VAT'];
				$timeagain = $vCurHD['timeagain'];
				$days = $vCurHD['days'];
				$h24 = $vCurHD['h24'];
				$vBill = $vCurHD['lv030'];
				$CusMoney = $vCurHD['CusMoney'];
				$vsate = (int) $vCurHD['state'];
				$vLockBill = (int) $vCurHD['LockBill'];
				if ($days > 0)
					$limittime = $timeagain + ($days - 1) * $h24 + $curtime;
				else
					$limittime = $curtime - $timeview;

				$vstrkey = '<input style="width:10px;background:#ecebeb;border:0px;padding:0px;margin:0px;" type="textbox" name="item_@#01" onkeypress="return CheckKeyItem(this,event,\'@#01\',\'@#02\')" id="item_@#01" />';
				$vstrkey = str_replace("@#02", $vorder, str_replace("@#01", $row['active'], $vstrkey));
			}
			//$this->LV_ListPopupYear($vCurHD['CMND'],getyear($this->DateCurrent),$vorder)
			$vautocrease++;
			$vsum = $this->LV_GetContractMoneyConLai($row['active'], $vVAT);
			$vung = $this->LV_GetPTMoney($row['active']) - $this->LV_GetPCMoney($row['active']);
			$vLeft = $vLeft . '
				<div class="bangcafe" style="float:left;">
				<div id="bang_' . $vorder . '" class="bangleftmini ' . (($active || $checks) ? (($vsate == 0) ? 'active' : 'waiting') : '') . '" onclick="setBang(\'' . $row['lv001'] . '\',\'' . (($active || $checks) ? (($vsate == 0) ? '1' : '0') : '') . '\');//viewfloor(' . $vTang . ',' . $lvNumRow . ')">
				<div id="bangtitle_' . $vorder . '" class="' . (($active || $checks) ? (($vsate == 0) ? (($vBill == 2) ? 'bangtitlemini_alarm' : 'bangtitlemini') : 'bangtitlewaitmini') : 'bangtitlecurmini') . '" @#@01><div style="font:10px arial;overflow:hidden;height:12px;padding-top:0px">' . (($active && $this->obj_conf->lv008 == 1) ? '<span id="tongtienconlai1_' . $vorder . '"><strong>' . $this->FormatView($vsum, 10) . ' đ</strong></span>' : '<span id="tongtienconlai1_' . $vorder . '"><strong></strong></span>') . '</div><div style="font-size:25px" title="' . $this->FormatView($vCurHD['lv004'], 2) . ' ' . substr($vCurHD['lv004'], 11, 8) . " " . $vCurHD['Note'] . '">' . $row['lv002'] . '</div><div>' . ((($checks) ? '<span class="bangtime">' . $vHDGop['name'] . '</span>' : ' <span class="bangtime" id="bangtime_' . $vautocrease . '" title="' . $limittime . '">' . $this->sec_to_times($limittime) . '</span>')) . '</div></div>
				<ul style="clear:both">
					<li>';
			if (($active || $checks))
				$vLeft = $vLeft;
			else
				$this->LV_GetButtonMini($row['lv001'], $vorder, $vLangArr, $vautocrease, $row['active'], $vLeft, $vTang);
			$vLeft = $vLeft . '
					<div id="calendarview_' . $vorder . '" class="viewcalandarmini" style="display:none;clear:both;">
					<div class="liftview_title"><table cellspacing=2 cellpadding=2 width="99%" border="0" style="color:white;">
						<tr>
						<td class="lvhtable" style="text-align:left!important;width:60px;">
						<ul id="pop-nav' . $vorder . '" lang="pop-nav' . $vorder . '" onmouseover="ChangeName(this,' . $vorder . ')" style="margin-top:0px!important;padding:0px!important;">
											<li class="menupopT">
											<input type="text" autocomplete="off" class="search_img_btn" name="txtcusid_search" id="txtcusid_search" style="width:100%" onkeyup="LoadPopupParent(this,\'txtcusid_' . $vorder . '\',\'sl_lv0001\',\'concat(lv002,@! @!,lv010,@! @!,lv011,@! @!,lv006,@! - @!,lv001)\')" onfocus="LoadPopupParent(this,\'txtcusid_' . $vorder . '\',\'sl_lv0001\',\'concat(lv002,@! @!,lv010,@! @!,lv011,@! @!,lv006,@! - @!,lv001)\')" tabindex="200">
											<div id="lv_popup' . $vorder . '" lang="lv_popup' . $vorder . '" style="display: block;"> </div>
											</li>
										</ul>
						</td>
						<td class="lvhtable" style="text-align:center!important;padding-right:10px;font:bold 16px Arial;">' . $row['lv002'] . '</td>
						<td class="lvhtable" align="center" style="padding-right:10px;font:bold 16px Arial">' . $vLangArr[85] . ': <span id="tongtien_' . $vorder . '">' . $this->FormatView($vsum, 10) . '</span> đ</td>
						<td class="lvhtable" align="center" id="giamgia_' . $vorder . '" style="display:' . (($vCKTM > 0) ? 'block' : 'none') . '">ĐÃ GIẢM GIÁ <span id="giamgiapercent_' . $vorder . '">' . $this->FormatView($vCKTM, 10) . '%</span> </td>' . '
						' . (($vVAT > 0) ? '<td class="lvhtable" align="center">ĐÃ CÓ VAT ' . $this->FormatView($vVAT, 10) . '%</td>' : '') . '
						<td class="lvhtable" align="center" style="display:none">Tiền khách đưa : <input style="width:60px" onblur="UpdateTextQty(this,\'' . $row['active'] . '\',\'' . $vorder . '\',99);" onfocus="this.select();"   title="Tiền khách đưa" name="txtmoney_' . $vorder . '" id="txtmoney_' . $vorder . '" class="textview" value="' . $vCurHD['CusMoney'] . '"/> đ</td>
						<td class="lvhtable" style="text-align:right!important;padding-right:10px;font:bold 16px Arial;display:none">' . $vLangArr[89] . ': <span id="tongtienconlai_' . $vorder . '"><strong>' . $this->FormatView($vCurHD['CusMoney'] - $vsum, 10) . '</strong> đ</span>
						</td></tr></table>	</div>
						' . (($this->obj_conf->lv030 > 0) ? '<div><table cellspacing=2 cellpadding=2 width="99%" border="0">
						<tr>
						<td><input  onkeypress="return notSpecialChar(event);" style="width:100%" onblur="if(this.value == \'\') {this.value = this.title;};  {UpdateText(this,\'' . $row['active'] . '\',\'' . $vorder . '\',1);UpdateCustomer(this,\'' . $vorder . '\',1);changecategory_change(this.value,\'' . $vorder . '\')}" onfocus="if(this.value == this.title) this.value = \'\';" value="' . ((trim($vCurHD['CMND']) == '' || $vCurHD['CMND'] == NULL) ? 'Mã KH' : $vCurHD['CMND']) . '" title="Mã KH" class="textview" name="txtcusid_' . $vorder . '" id="txtcusid_' . $vorder . '" type="text" tabindex="20" />
						</td>
						<td><div id="txtdoanhthu_' . $vorder . '">' . '' . '</div></td>
						<td>
						<input style="width:100%" onblur="if(this.value == \'\') {this.value = this.title;} else {UpdateText(this,\'' . $row['active'] . '\',\'' . $vorder . '\',2);UpdateCustomer(this,\'' . $vorder . '\',2)}" onfocus="if(this.value == this.title) this.value = \'\';" value="' . ((trim($vCurHD['CusName']) == '' || $vCurHD['CusName'] == NULL) ? 'Tên khách hàng' : $vCurHD['CusName']) . '" title="Tên khách hàng" class="textview" name="txtcusname_' . $vorder . '" id="txtcusname_' . $vorder . '"  type="text" tabindex="20" />
						</td><td><input style="width:100%" onblur="if(this.value == \'\') {this.value = this.title;} else {UpdateText(this,\'' . $row['active'] . '\',\'' . $vorder . '\',3);UpdateCustomer(this,\'' . $vorder . '\',6);}" onfocus="if(this.value == this.title) this.value = \'\';"  title="Địa chỉ" name="txtcusadd_' . $vorder . '" id="txtcusadd_' . $vorder . '"  rows="3"  tabindex="90" class="textview" value="' . ((trim($vCurHD['Address']) == '' || $vCurHD['Address'] == NULL) ? 'Địa chỉ' : $vCurHD['Address']) . '"/>
						</td><td><input style="width:100%" onblur="if(this.value == \'\') {this.value = this.title;} else {UpdateText(this,\'' . $row['active'] . '\',\'' . $vorder . '\',4);UpdateCustomer(this,\'' . $vorder . '\',16);}" onfocus="if(this.value == this.title) this.value = \'\';"  title="Số điện thoại" name="txtcusnote_' . $vorder . '" id="txtcusnote_' . $vorder . '"  rows="3"  tabindex="90" class="textview" value="' . ((trim($vCurHD['Note']) == '' || $vCurHD['Note'] == NULL) ? 'Số điện thoại' : $vCurHD['Note']) . '"/>
						</td></tr></table>
					</div>' : '<input type="hidden" name="txtcusid_' . $vorder . '" id="txtcusid_' . $vorder . '" type="text" tabindex="20" />') . '	
					<!--
					<div style="float:left;width:20%;padding-bottom:15px;">
						<div class="view_title">Đặt bàn</div>
						<div style="padding:10px">
							
						' . $this->LV_GetButtonMiniView($row['lv001'], $vorder, $vLangArr, $vautocrease, $row['active']) . '
						</div>
					</div>-->
					<div style="float:left;width:100%;padding-bottom:5px">
					<!--<div class="view_title">Các món ăn/thức uống' . $vstrkey . '</div>-->
					<div style="padding-top:0px;">
				' . $this->LV_GetDetailControlMini($row['active'], $vorder, $vLangArr, $vlistItem, $vCurHD['VAT']) . '
					' . (($active && $vsate == 0) ? '<br><div id="lvloaddata_' . $row['active'] . '"></div>' : '') . '
						<p style="position:absolute;right:0px;top:0px;width:50px;height:50px;" onclick="closepopcalendar(\'' . $vorder . '\')"><img style="float:right" width="60" src="images/icon/closefull.png"/></p>
						<div style="height:30px;width:100%;clear:both;"></div>
						<div style="position:absolute;left:0px;bottom:0px;height:25px">
							<div class="vitribang" style="width:666px">
							<div class="banhangmini" style="height:40px;border-bottom:2px #fff solid;float:left;" onclick="closepopcalendar(\'' . $vorder . '\');"  style="float:left;">Đóng lại</div>' . '
							' . (($this->obj_conf->lv026 >= 0 && $vBill != 2) ? '<div id="xuongbepbarid_' . $vorder . '" class="banhangmini" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',15);closepopcalendar(\'' . $vorder . '\');"  style="height:40px;border-bottom:2px #fff solid;float:left;">' . 'XUỐNG<br/>BẾP/BAR' . '</div>' : '') . '
							<div class="banhangmini" style="float:left;height:40px;margin-top:0px;"><span   onclick="setContractID(\'' . $row['active'] . '\');callsizeobj(' . $vorder . ')">' . $vLangArr[80] . '</span><div id="roomid_' . $vorder . '" style="display:none;position:absolute;bottom:40px;z-index:999999999999;"><p style="position:absolute;right:0px;top:0px" onclick="closepoprome(' . $vorder . ')"><img width="60" src="images/icon/closefull.png"/></p>
							<div class="groupcafe">Đồi bàn</div><div id="roomidchild_' . $vorder . '"></div></div></div>
							<!--<div class="banhangmini" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',7)"  style="float:left;height:40px;margin-top:0px;">' . (($vLockBill == 1) ? 'Dừng tạm tính' : 'Bill tạm tính') . '</div>-->
							' . (($this->isApr == 1) ? (($vBill == 2) ? '<div class="banhangmini" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',5);closepopcalendar(\'' . $vorder . '\');"  style="float:left;height:40px;margin-top:0px;">Dừng Báo</div>' : '') : (($vBill != 2) ? '<div class="banhangmini" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',5);closepopcalendar(\'' . $vorder . '\');"  style="float:left;height:40px;margin-top:0px;">Báo Bill</div>' : '')) . (($this->isApr == 1) ? '<div id="tratienid_' . $vorder . '" class="banhangmini" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',2);closepopcalendar(\'' . $vorder . '\');"  style="float:left;height:40px;margin-top:0px;">' . $vLangArr[75] . '</div>
							<!--<div class="banhangmini"   style="float:left;;height:40px;margin-top:0px;"><input style="padding:0px;margin:0px;height:10px;" type="checkbox" value=1 onclick="CheckVAT(this,\'' . $row['active'] . '\',\'' . $vorder . '\');"' . (($active) ? (($vCurHD['VAT'] > 0) ? 'checked' : '') : 'checked') . '/><font color="white">VAT</font></div>-->' : '') . '
							' . (($this->obj_conf->lv011 == 1) ? '<div class="banhangmini" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;">' . $vLangArr[84] . '</div>
							<div class="banhangmini" onclick="tiencoc(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;height:40px;margin-top:0px;">' . 'Tiền cọc' . '</div>
							<div class="banhangmini" onclick="tratiencoc(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;height:40px;margin-top:0px;">' . 'Trả cọc' . '</div>' : '') . '
							</div>
						</div>
						</div>
					</div>					
				</li>
					';
			$vLeft = $vLeft . '
				</ul>';
			if ($active) {
				if ($vsate == 0) {
					$vLeft = str_replace("@#@01", 'onclick="viewpopcalendar(\'' . $vorder . '\',\'' . $row['active'] . '\',\'' . $vTang . '\')" onmouseover="viewpopliftview(\'111111\')"', $vLeft);
				} else {
					$vLeft = str_replace("@#@01", 'onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',3);"  onmouseover="viewpopliftview(\'111111\')"', $vLeft);
				}
			} else
				$vLeft = str_replace("@#@01", ' ' . $this->obj_conf->lv010 . '="viewpopliftview(\'' . $vorder . '\')"', $vLeft);

			$vLeft = $vLeft . '	
				</div>
				<div class="gopban"  id="gopbang_' . $vorder . '" style="position:absolute;display:' . (($active || $checks) ? 'block' : 'none') . '">
				<div style="float:left;padding-top:5px">' . (($checks || $active == false) ? '' : '
				<input class="bntgop" type="button" value="' . $vLangArr[81] . '" onclick="ActiveGop(this,\'' . $row['active'] . '\',\'' . $vTang . '\',' . $vorder . ')"/>') . '</div>
				<div style="float:left;width:30px;height:30px;margin-top:12px;" class="' . (($vLockBill == 1) ? 'blockbill' : '') . '">&nbsp;</div>
				<div style="position:absolute;bottom:0px;">
				<input  style="display:' . (($checks) ? 'block' : 'none') . '" class="chkgop" id="gopbangcheck_' . $vorder . '" type="checkbox" onclick="' . (($checks) ? "setDonHang('" . $vHDGop['lv001'] . "')" : '') . ';setgopbang(this,\'' . $row['lv001'] . '\',' . (($active) ? 1 : 0) . ')" ' . (($checks) ? 'checked' : '') . '/></div></div>
				</div>
				';
		}
		$vLeft = $vLeft . '		
		</div>';
		return $vLeft;
	}
	function LV_GetBang($vTangID, $vTang, $lvNumRow, &$vautocrease, &$vorder, $vLangArr)
	{
		$vLeft = '<div id="bangtang_' . $vTang . '" class="bang_left" style="float:left;width:100%">
			';
		$vsql = "select A.*,(select lv001 from sl_lv0013 BB where BB.lv007=A.lv001 and (BB.lv011=0 || BB.lv011=1 ) limit 0,1) active  from sl_lv0009 A where A.lv004='$vTangID' order by lv005 asc";
		$lvResult = db_query($vsql);
		$vlistItem = $this->LV_GetWHItem();
		while ($row = db_fetch_array($lvResult)) {
			$vorder++;
			$active = false;
			$checks = false;

			$vHDGop = $this->LV_CheckGopBan($row['lv001']);
			if ($vHDGop != NULL) {
				$checks = true;
			}
			if ($row['active'] != "" && $row['active'] != NULL) {
				$active = true;
				$vCurHD = $this->LV_GetTimeInvoice($row['active']);
				$timeview = $vCurHD['timeview'];
				$curtime = $vCurHD['curtime'];
				$timeagain = $vCurHD['timeagain'];
				$days = $vCurHD['days'];
				$h24 = $vCurHD['h24'];
				$vsate = (int) $vCurHD['state'];
				if ($days > 0)
					$limittime = $timeagain + ($days - 1) * $h24 + $curtime;
				else
					$limittime = $curtime - $timeview;
				if (!$checks)
					$vautocrease++;
			}
			$vsum = $this->LV_GetContractMoneyConLai($row['active'], $vCurHD['VAT']);
			$vung = $this->LV_GetPTMoney($row['active']) - $this->LV_GetPCMoney($row['active']);
			$vLeft = $vLeft . '<div id="bang_' . $vorder . '" class="bangleft ' . (($active || $checks) ? (($vsate == 0) ? 'active' : 'waiting') : '') . '" onclick="setBang(\'' . $row['lv001'] . '\',\'' . (($active || $checks) ? (($vsate == 0) ? '1' : '0') : '') . '\');//viewfloor(' . $vTang . ',' . $lvNumRow . ')">
				<div id="bangtitle_' . $vorder . '" class="' . (($active || $checks) ? (($vsate == 0) ? 'bangtitle' : 'bangtitlewait') : 'bangtitlecur') . '"><div style="float:left" title="' . $this->FormatView($vCurHD['lv004'], 2) . ' ' . substr($vCurHD['lv004'], 11, 8) . '">' . $row['lv002'] . '</div><div style="float:right">' . (($active) ? (($checks) ? '<span class="bangtime">' . $vHDGop['name'] . '</span>' : ' <span class="bangtime" id="bangtime_' . $vautocrease . '" title="' . $limittime . '">' . $this->sec_to_times($limittime) . '</span>') : '<span class="bangtime">' . $vHDGop['name'] . '</span>') . '</div></div>
				<ul style="clear:both">
					<li>' . $vLangArr[85] . ': <span id="tongtien_' . $vorder . '">' . $this->FormatView($vsum, 10) . '</span></li>
					<li>' . $vLangArr[88] . ': <span id="tongtienung_' . $vorder . '">' . $this->FormatView($vung, 10) . '</span></li>
					<li>' . $vLangArr[89] . ': <span id="tongtienconlai_' . $vorder . '"><strong>' . $this->FormatView($vsum - $vung, 10) . '</strong></span></li>
					<li>' . $this->LV_GetButton($row['lv001'], $vorder, $vLangArr, $vautocrease, $row['active']) . '
					' . (($active && $vsate == 0) ? '<br>CMND:' . $vCurHD['CMND'] . ' <br>Tên:' . $vCurHD['CusName'] : '') . '
					</li>
					<li><div class="gopban"  id="gopbang_' . $vorder . '" style="display:' . (($active || $checks) ? 'block' : 'none') . '"><div style="float:left;padding-top:5px">' . (($checks || $active == false) ? $vLangArr[82] : '<input type="button" value="' . $vLangArr[81] . '" onclick="ActiveGop(this,\'' . $row['active'] . '\',\'' . $vTang . '\',' . $vorder . ')"/>') . '</div><div style="float:left;"><input id="gopbangcheck_' . $vorder . '" type="checkbox" onclick="' . (($checks) ? "setDonHang('" . $vHDGop['lv001'] . "')" : '') . ';setgopbang(this,\'' . $row['lv001'] . '\',' . (($active) ? 1 : 0) . ')" ' . (($checks) ? 'checked' : '') . '/></div></div></li>
					<li><div id="calendarview_' . $vorder . '" class="viewcalandar" style="display:none;clear:both;">
					<div style="float:left;width:100%;padding-bottom:25px">
				' . ((($active || $checks) && $vsate == 0) ? $this->LV_GetDetailControl($row['active'], $vorder, $vLangArr, $vlistItem, $vCurHD['VAT']) : '') . '
					' . (($active && $vsate == 0) ? '<br><div id="lvloaddata_' . $row['active'] . '"></div>' : '') . '
						<p style="position:absolute;right:0px;top:0px" onclick="closepopcalendar(\'' . $vorder . '\')"><img width="60" src="images/icon/closefull.png"/></p>
						<div style="position:absolute;left:0px;bottom:0px;height:25px">
							<div class="vitribang" style="width:420px">
							<div class="banhang" onclick="setviewhere(1)" style="float:left">' . $vLangArr[78] . '</div>
							<div class="banhang" onclick="Report(\'' . $row['active'] . '\')"  style="float:left;padding-left:15px;padding-right:15px;"> ' . $vLangArr[79] . ' </div>
							<div class="banhang" onclick="setContractID(\'' . $row['active'] . '\');setviewhere(1)"  style="float:left;padding-left:15px;padding-right:15px;">' . $vLangArr[80] . '</div>
							<div class="banhang" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;padding-left:15px;padding-right:15px;">' . $vLangArr[84] . '</div>
							<div class="banhang" onclick="tiencoc(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;padding-left:15px;padding-right:15px;">' . 'Tiền cọc' . '</div>
							<div class="banhang" onclick="tratiencoc(\'' . $row['active'] . '\',\'' . $vorder . '\',4);"  style="float:left;padding-left:15px;padding-right:15px;">' . 'Trả cọc' . '</div>
							</div>
						</div>
					</div>					
				</li>
					';
			$vLeft = $vLeft . '
				</ul>';
			if ($active)
				if ($vsate == 0) {
					$vLeft = $vLeft . '
					<div class="vitribang" id="tratien_' . $vorder . '">
						<div class="tratien" style="width:50px;padding:0px;padding-top:5px;padding-bottom:5px" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',2)" >' . $vLangArr[75] . '</div>
						<div class="tratien" style="width:50px;padding:0px;padding-top:5px;padding-bottom:5px" onclick="viewpopcalendar(\'' . $vorder . '\',\'' . $row['active'] . '\')">' . $vLangArr[77] . '</div>
						<div class="tratien" style="width:50px;padding:0px;padding-top:5px;padding-bottom:5px" onclick="setviewhere(1)" style="float:left">Thêm</div>
					</div>					
					';
				} else {
					$vLeft = $vLeft . '
					<div class="vitribang" id="tratien_' . $vorder . '"><div class="banhang" onclick="tratien(\'' . $row['active'] . '\',\'' . $vorder . '\',3);" >' . $vLangArr[87] . '</div></div>';
				} else
				$vLeft = $vLeft . '
					<div class="vitribang" id="tratien_' . $vorder . '"><div class="banhang" onclick="setviewhere(1)" >' . $vLangArr[73] . '</div></div>';
			$vLeft = $vLeft . '	
				</div>';
		}
		$vLeft = $vLeft . '		
		</div>';
		return $vLeft;
	}
	function LV_GetItem_Time($vCode)
	{
		$vcondition = "";
		$lvsql = "select * from  sl_lv0007 Where lv017='" . $vCode . "'";
		$vresult = db_query($lvsql);
		while ($vrow = db_fetch_array($vresult)) {
			$vreturn = $vreturn . "," . $vrow['lv001'];
		}
		return $vreturn;
	}
	function LV_GetTimeInvoice($vContractID)
	{
		$lvsql = "select lv001,lv030,lv031 LockBill,lv026 KM,lv027 KI,lv030 NV,lv006 VAT,IF(lv011=0,lv004,lv005) lv004,TIME_TO_SEC(substr(IF(lv011=0,lv004,lv005),12,8)) timeview,TIME_TO_SEC(TIMEDIFF('24:00:00',substr(IF(lv011=0,lv004,lv005),12,8))) timeagain,TIME_TO_SEC('24:00:00') h24,DATEDIFF(CURRENT_DATE(),substr(IF(lv011=0,lv004,lv005),1,12)) days,TIME_TO_SEC(CURRENT_TIME()) curtime,lv011 state,lv002 CMND,lv003 CusName,lv009 Address,lv013 Note,lv022 CKTM,lv099 CusMoney from  sl_lv0013 Where lv001='$vContractID'";
		$vresult = db_query($lvsql);
		return db_fetch_array($vresult);
	}
	function LV_CheckGopBan($vBang)
	{
		$lvsql = "select BB.lv001,concat(CC.lv002,'(',BB.lv007,')') name from sl_lv0013 BB left join sl_lv0009 CC on BB.lv007=CC.lv001 where concat(BB.lv024,',') like '%," . $vBang . ",%' and BB.lv011=0 ";
		$vresult = db_query($lvsql);
		if ($vresult) {
			$vrow = db_fetch_array($vresult);
			return $vrow;

		}
		return null;
	}
	function LV_GetWHItemMini()
	{
		$lvsql = "select * from sl_lv0007 where lv005!='' order by lv005 asc";
		$vresult = db_query($lvsql);
		$vlistReturn = '<div style="padding:10px;background:#fff;height:146px; overflow: auto;"><ul class="lst_itemkey" style="height:139px;" >
	';
		$i = 1;
		while ($vrow = db_fetch_array($vresult)) {
			$vlistReturn = $vlistReturn . '<li><a id="liitemkey_' . $i . '" class="liitemkey" onclick="AddItemNew(\'@#01\',\'@#02\',\'' . $vrow['lv005'] . "." . $vrow['lv001'] . '\')" title="' . $vrow['lv005'] . "." . $vrow['lv001'] . '" style="color:' . $vrow['lv009'] . '">' . $vrow['lv005'] . '.' . $vrow['lv002'] . '</a></li>';
			$i++;
		}
		$vlistReturn = $vlistReturn . '</ul></div>';
		return $vlistReturn;
	}
	function LV_GetWHItem()
	{
		$lvsql = "select * from sl_lv0007 where lv005!='' order by lv005 asc";
		$vresult = db_query($lvsql);
		$vlistReturn = '<select name="item_@#01" onkeypress="return CheckKeyItem(this,event,\'@#01\',\'@#02\')" id="item_@#01" multiple="multiple" style="width:100%;height:179px;" ondblclick="AddItemNew(\'@#01\',\'@#02\',this.value)">
	';
		while ($vrow = db_fetch_array($vresult)) {
			$vlistReturn = $vlistReturn . '<option value="' . $vrow['lv005'] . "." . $vrow['lv001'] . '" style="color:' . $vrow['lv009'] . '">' . $vrow['lv005'] . '.' . $vrow['lv002'] . '</option>';
		}
		$vlistReturn = $vlistReturn . '</select';
		return $vlistReturn;
	}
	function LV_GetDetailControlMini($vContractID, $vBangID, $vLangArr, $vlistItem = '', $cvat)
	{
		$vstr = '
			<div class="monanbang" style="float:left;padding:0px;" id="monan_' . $vBangID . '">' . str_replace("@#02", $vBangID, str_replace("@#01", $vContractID, $vlistItem)) . ' </div>
			<div class="chitietbang"  style="float:left;">
			<div id="chonsanpham_' . $vBangID . '" class="chonsanpham" style="valign:top"></div>
			<div class="detailview" id="detailview_' . $vBangID . '" style="valign:top;padding:0px;padding-top:3px;background:#fff;height:350px;overflow: scroll;width:100%">
			';
		$vstr = $vstr . $this->LV_GetDetail($vContractID, $vBangID, $vLangArr, $vSum);
		$vstr = $vstr . '</div></div>';
		return $vstr;
	}
	function LV_GetDetailControl($vContractID, $vBangID, $vLangArr, $vlistItem = '', $cvat)
	{
		$vstr = '<div><h3>' . $vLangArr[16] . '<div class="banhang" onclick="tratien(\'' . $vContractID . '\',\'' . $vBangID . '\',2);"  style="float:left;padding-left:15px;padding-right:15px;">' . $vLangArr[75] . '</div><div class="banhang"   style="float:left;padding-left:15px;padding-right:15px;"><!--<input style="padding:0px;margin:0px;height:15px;" type="checkbox" value=1 onclick="CheckVAT(this,\'' . $vContractID . '\',\'' . $vBangID . '\');"' . (($cvat > 0) ? 'checked' : '') . '/><font color="white">VAT</font>--></div></h3></div>
			<div>' . str_replace("@#02", $vBangID, str_replace("@#01", $vContractID, $vlistItem)) . ' </div>
			<div id="detailview_' . $vBangID . '">';
		$vstr = $vstr . $this->LV_GetDetail($vContractID, $vBangID, $vLangArr, $vSum);
		$vstr = $vstr . '</div>';
		return $vstr;
	}
	function LV_GetDetail($vContractID, $vBangID, $vLangArr, &$vSum)
	{
		$vobjtext = "";
		$vstr = '
			<table class="lvtable">
			<tr class="lvhtable"><td class="lvhtable">S</td>' . (($this->obj_conf->lv026 == 1) ? '<td style class="lvhtable" style="width:10px">M</td><td style class="lvhtable" style="width:10px">K</td><td  class="lvhtable" style="width:20px">R</td>' : '') . (($this->obj_conf->lv012 == 1) ? '<td class="lvhtable">X</td>' : '') . '<td class="lvhtable">Tên</td><td class="lvhtable" width="50">SL</td><td class="lvhtable">Giá<td class="lvhtable" width="50">Ggiá%</td></tr>
		';
		$lvsql = "select A.*,B.lv022 CKTong,C.lv002 Name,C.lv009 ColorName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 where 1=1 and B.lv001='$vContractID' AND A.lv004>0 order by A.lv018,A.lv001";
		$vresult = db_query($lvsql);
		$i = 1;
		$vSum = 0;
		$vSumTT = 0;
		$isCal = true;
		$isDetail = true;
		while ($vrow = db_fetch_array($vresult)) {
			if ($vrow['CKTong'] > 0)
				$vSum = $vSum + ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) - ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) * $vrow['CKTong'] / 100;
			else
				$vSum = $vSum + ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100);

			//$vSumTT=$vSumTT+$vrow['lv017']*$vrow['lv006'];
			if ($vrow['lv018'] == 0) {
				if ($this->obj_conf->lv026 == 1)
					$vAlarmStyle = "-webkit-animation: glowing 1500ms infinite;-moz-animation: glowing 1500ms infinite;-o-animation: glowing 1500ms infinite;animation: glowing 1500ms infinite;";
				else
					$vAlarmStyle = "";
			} else {
				$vAlarmStyle = "";
			}
			$vstr = $vstr . '<tr style="' . $vAlarmStyle . '" class="lvlinehtable' . ($i % 2) . (($vrow['lv004'] == 0) ? ' textunderline' : '') . '"  ><td style="color:' . $vrow['ColorName'] . '">' . $i . '</td>' . (($this->obj_conf->lv026 == 1) ? ('<td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv018'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv019'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . (($vrow['lv017'] == 0) ? '<input type="checkbox" onclick="changestaffreceivefood(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/>' : $vrow['lv017']) . '</td>') : '') . (($this->obj_conf->lv012 == 1) ? '<td style="color:' . $vrow['ColorName'] . ';text-align:center"><img src="../images/icon/delete.png"  onclick="delline(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td>' : '') . '<td style="color:' . $vrow['ColorName'] . ';min-width:120px;">' . $vrow['Name'] . '</td><td><input onFocus="this.select();"  id="detail_id_' . $vrow['lv001'] . '" style="min-width:20px;width:100%;text-align:center;" type="textbox" value="' . $vrow['lv004'] . '" onblur="changeqty(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();" id="detail_price_' . $vrow['lv001'] . '" style="min-width:60px;width:100%;text-align:center;" type="textbox" value="' . $vrow['lv006'] . '" readonly="true" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();" id="detail_percent_' . $vrow['lv001'] . '" style="min-width:25px;width:100%;text-align:center;" type="textbox" value="' . $vrow['lv011'] . '" readonly="true" title="' . $this->obj_conf->lv004 . '"/></td></tr>';
			$i++;
		}
		$lvsql = "select A.*,B.lv022 CKTong,C.lv002 Name,C.lv009 ColorName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 where 1=1 and B.lv001='$vContractID' and A.lv004<0";
		$vresult = db_query($lvsql);
		$vFirts = true;
		while ($vrow = db_fetch_array($vresult)) {
			if ($vFirts) {
				$vFirts = false;
				$vstr = $vstr . '<tr><td colspan="12"><span style="color:red;padding:3px;">TRẢ HÀNG</span></td></tr>';
			}
			if ($vrow['CKTong'] > 0)
				$vSum = $vSum + ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) - ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) * $vrow['CKTong'] / 100;
			else
				$vSum = $vSum + $vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100;
			//$vSumTT=$vSumTT+$vrow['lv017']*$vrow['lv006'];
			$vstr = $vstr . '<tr class="lvlinehtable' . ($i % 2) . (($vrow['lv004'] == 0) ? ' textunderline' : '') . '"  ><td style="color:' . $vrow['ColorName'] . '">' . $i . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv018'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv019'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . (($vrow['lv017'] == 0) ? '<input type="checkbox" onclick="changestaffreceivefood(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/>' : $vrow['lv017']) . '</td>' . (($this->obj_conf->lv012 == 1) ? '<td style="color:' . $vrow['ColorName'] . ';text-align:center"><img src="../images/icon/delete.png"  onclick="delline(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td>' : '') . '<td style="color:' . $vrow['ColorName'] . ';min-width:120px;">' . $vrow['Name'] . '</td><td><input  onFocus="this.select();" id="detail_id_' . $vrow['lv001'] . '" style="min-width:20px;width:100%;text-align:center;" type="textbox" value="' . $vrow['lv004'] . '" onblur="changeqty(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();"  id="detail_price_' . $vrow['lv001'] . '" style="min-width:60px;width:100%;text-align:center;" type="textbox" value="' . $vrow['lv006'] . '" readonly="true" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();" id="detail_percent_' . $vrow['lv001'] . '" style="min-width:25px;width:100%;text-align:center;" type="textbox" value="' . $vrow['lv011'] . '" onblur="changediscount(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  id="detail_price_' . $vrow['lv001'] . '" style="width:60px;text-align:center;" type="textbox" value="' . $vrow['lv021'] . '" onblur="changenotenhanvien(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" /></td><td><div style="float:left"><input type="checkbox" ' . (($vrow['lv010'] == 1) ? 'checked' : '') . ' style="width:20px;text-align:center;background:orange" onblur="changeqtytratruoc(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" name="tratruoc_' . $vContractID . '_' . $i . '" title="' . $this->FormatView($vrow['lv013'], 4) . '"/></div><div style="float:right">' . (($vrow['lv022'] != "") ? '<span title="' . $vrow['lv022'] . '"><image src="../images/icon/note_all.png"/></span>' : '') . (($vrow['lv023'] != "") ? '<span title="' . $vrow['lv023'] . '"><image src="../images/icon/note_ki.png"/></span>' : '') . '</div></td><td><input  onFocus="this.select();" style="width:25px;text-align:center;" type="textbox" value="' . $vrow['lv015'] . '" onblur="changeorder(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td></tr>';
			$i++;
		}
		$vstr = $vstr . '
		<tr class="lvhtable">' . (($this->obj_conf->lv026 == 1) ? '<td style class="lvhtable" colspan="3">&nbsp;</td>' : '') . '<td class="lvhtable">&nbsp;' . $vobjtext . '</td>' . (($this->obj_conf->lv012 == 1) ? '<td class="lvhtable">&nbsp;</td>' : '') . '<td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable"><span id="tongtienct_' . $vBangID . '">' . $this->FormatView($vSum, 10) . '</span></td><td>&nbsp;</td></tr>
		</table>
		';
		return $vstr;
	}
	function LV_GetDetailFull($vContractID, $vBangID, $vLangArr, &$vSum)
	{
		$vobjtext = "";
		$vstr = '
			<table class="lvtable">
			<tr class="lvhtable"><td class="lvhtable">S</td>' . (($this->obj_conf->lv026 == 1) ? '<td style class="lvhtable" style="width:10px">M</td><td style class="lvhtable" style="width:10px">K</td><td  class="lvhtable" style="width:20px">R</td>' : '') . (($this->obj_conf->lv012 == 1) ? '<td class="lvhtable">X</td>' : '') . '<td class="lvhtable">Tên</td><td class="lvhtable">SL</td><td class="lvhtable">Giá<td class="lvhtable">Ggiá%</td><td class="lvhtable" style="width:10px" title="Ghi chú">Ghi chú</td><td class="lvhtable" style="width:10px" title="Không tích điểm thì check vào">?</td><td class="lvhtable" title="Nhập số điện thoại, Mã thẻ thành viên hoặc 0,1,2,3...">Tách Bill/ĐT/TV</td></tr>
		';
		$lvsql = "select A.*,B.lv022 CKTong,C.lv002 Name,C.lv009 ColorName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 where 1=1 and B.lv001='$vContractID' AND A.lv004>0 order by A.lv018,A.lv001";
		$vresult = db_query($lvsql);
		$i = 1;
		$vSum = 0;
		$vSumTT = 0;
		$isCal = true;
		$isDetail = true;
		while ($vrow = db_fetch_array($vresult)) {
			if ($vrow['CKTong'] > 0)
				$vSum = $vSum + ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) - ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) * $vrow['CKTong'] / 100;
			else
				$vSum = $vSum + ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100);

			//$vSumTT=$vSumTT+$vrow['lv017']*$vrow['lv006'];
			if ($vrow['lv018'] == 0) {
				if ($this->obj_conf->lv026 == 1)
					$vAlarmStyle = "-webkit-animation: glowing 1500ms infinite;-moz-animation: glowing 1500ms infinite;-o-animation: glowing 1500ms infinite;animation: glowing 1500ms infinite;";
				else
					$vAlarmStyle = "";
			} else {
				$vAlarmStyle = "";
			}
			$vstr = $vstr . '<tr style="' . $vAlarmStyle . '" class="lvlinehtable' . ($i % 2) . (($vrow['lv004'] == 0) ? ' textunderline' : '') . '"  ><td style="color:' . $vrow['ColorName'] . '">' . $i . '</td>' . (($this->obj_conf->lv026 == 1) ? ('<td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv018'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv019'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . (($vrow['lv017'] == 0) ? '<input type="checkbox" onclick="changestaffreceivefood(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/>' : $vrow['lv017']) . '</td>') : '') . (($this->obj_conf->lv012 == 1) ? '<td style="color:' . $vrow['ColorName'] . ';text-align:center"><img src="../images/icon/delete.png"  onclick="delline(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td>' : '') . '<td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv003'] . ' ' . $vrow['Name'] . '</td><td><input onFocus="this.select();"  id="detail_id_' . $vrow['lv001'] . '" style="width:20px;text-align:center;" type="textbox" value="' . $vrow['lv004'] . '" onblur="changeqty(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();" id="detail_price_' . $vrow['lv001'] . '" style="width:60px;text-align:center;" type="textbox" value="' . $vrow['lv006'] . '" onblur="changeprice(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();" id="detail_percent_' . $vrow['lv001'] . '" style="width:25px;text-align:center;" type="textbox" value="' . $vrow['lv011'] . '" onblur="changediscount(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  id="detail_price_' . $vrow['lv001'] . '" style="width:60px;text-align:center;" type="textbox" value="' . $vrow['lv021'] . '" onblur="changenotenhanvien(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" /></td><td><div style="float:left"><input type="checkbox" ' . (($vrow['lv010'] == 1) ? 'checked' : '') . ' style="width:20px;text-align:center;background:orange" onblur="changeqtytratruoc(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" name="tratruoc_' . $vContractID . '_' . $i . '" title="' . $this->FormatView($vrow['lv013'], 4) . '"/></div><div style="float:right">' . (($vrow['lv022'] != "") ? '<span title="' . $vrow['lv022'] . '"><image src="../images/icon/note_all.png"/></span>' : '') . (($vrow['lv023'] != "") ? '<span title="' . $vrow['lv023'] . '"><image src="../images/icon/note_ki.png"/></span>' : '') . '</div></td><td><input  onFocus="this.select();" style="width:25px;text-align:center;" type="textbox" value="' . $vrow['lv015'] . '" onblur="changeorder(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td></tr>';
			$i++;
		}
		$lvsql = "select A.*,B.lv022 CKTong,C.lv002 Name,C.lv009 ColorName from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001 inner join sl_lv0007 C on A.lv003=C.lv001 where 1=1 and B.lv001='$vContractID' and A.lv004<0";
		$vresult = db_query($lvsql);
		$vFirts = true;
		while ($vrow = db_fetch_array($vresult)) {
			if ($vFirts) {
				$vFirts = false;
				$vstr = $vstr . '<tr><td colspan="12"><span style="color:red;padding:3px;">TRẢ HÀNG</span></td></tr>';
			}
			if ($vrow['CKTong'] > 0)
				$vSum = $vSum + ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) - ($vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100) * $vrow['CKTong'] / 100;
			else
				$vSum = $vSum + $vrow['lv004'] * $vrow['lv006'] - $vrow['lv004'] * $vrow['lv006'] * $vrow['lv011'] / 100;
			//$vSumTT=$vSumTT+$vrow['lv017']*$vrow['lv006'];
			$vstr = $vstr . '<tr class="lvlinehtable' . ($i % 2) . (($vrow['lv004'] == 0) ? ' textunderline' : '') . '"  ><td style="color:' . $vrow['ColorName'] . '">' . $i . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv018'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv019'] . '</td><td style="color:' . $vrow['ColorName'] . '">' . (($vrow['lv017'] == 0) ? '<input type="checkbox" onclick="changestaffreceivefood(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/>' : $vrow['lv017']) . '</td>' . (($this->obj_conf->lv012 == 1) ? '<td style="color:' . $vrow['ColorName'] . ';text-align:center"><img src="../images/icon/delete.png"  onclick="delline(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td>' : '') . '<td style="color:' . $vrow['ColorName'] . '">' . $vrow['lv003'] . ' ' . $vrow['Name'] . '</td><td><input  onFocus="this.select();" id="detail_id_' . $vrow['lv001'] . '" style="width:20px;text-align:center;" type="textbox" value="' . $vrow['lv004'] . '" onblur="changeqty(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();"  id="detail_price_' . $vrow['lv001'] . '" style="width:60px;text-align:center;" type="textbox" value="' . $vrow['lv006'] . '" onblur="changeprice(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  onFocus="this.select();" id="detail_percent_' . $vrow['lv001'] . '" style="width:25px;text-align:center;" type="textbox" value="' . $vrow['lv011'] . '" onblur="changediscount(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" title="' . $this->obj_conf->lv004 . '"/></td><td><input  id="detail_price_' . $vrow['lv001'] . '" style="width:60px;text-align:center;" type="textbox" value="' . $vrow['lv021'] . '" onblur="changenotenhanvien(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" /></td><td><div style="float:left"><input type="checkbox" ' . (($vrow['lv010'] == 1) ? 'checked' : '') . ' style="width:20px;text-align:center;background:orange" onblur="changeqtytratruoc(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')" name="tratruoc_' . $vContractID . '_' . $i . '" title="' . $this->FormatView($vrow['lv013'], 4) . '"/></div><div style="float:right">' . (($vrow['lv022'] != "") ? '<span title="' . $vrow['lv022'] . '"><image src="../images/icon/note_all.png"/></span>' : '') . (($vrow['lv023'] != "") ? '<span title="' . $vrow['lv023'] . '"><image src="../images/icon/note_ki.png"/></span>' : '') . '</div></td><td><input  onFocus="this.select();" style="width:25px;text-align:center;" type="textbox" value="' . $vrow['lv015'] . '" onblur="changeorder(this,\'' . $vrow['lv001'] . '\',' . $vBangID . ')"/></td></tr>';
			$i++;
		}
		$vstr = $vstr . '
		<tr class="lvhtable"><td class="lvhtable">&nbsp;' . $vobjtext . '</td>' . (($this->obj_conf->lv012 == 1) ? '<td class="lvhtable">&nbsp;</td>' : '') . '<td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable">&nbsp;</td><td class="lvhtable"><span id="tongtienct_' . $vBangID . '">' . $this->FormatView($vSum, 10) . '</span></td><td  colspan="4"></td></tr>
		</table>
		';
		return $vstr;
	}
	function LV_GetButtonMini($vRoomID, $vorder, $vLangArr, $vautocrease, $vDHID, &$strLeft, $vTang)
	{
		$vstr = '';
		$vlistID = "";
		$lvsql = "select MP.id,MP.name,IF(MP.Nums>0,1,0) Nums from (select distinct A.lv003 id,B.lv002 name,(select count(*) from sl_lv0014 BB where BB.lv003=A.lv004 and BB.lv002='$vDHID') Nums,B.lv004 vOrder from sl_lv0072 A inner join sl_lv0071 B on A.lv003=B.lv001 where 1=1 and A.lv002='$vRoomID') MP order by MP.vOrder,MP.Nums Desc";
		$vresult = db_query($lvsql);
		$vStrFist = "";
		$i = 0;
		while ($vrow = db_fetch_array($vresult)) {
			if (strpos($vlistID, "," . $vrow['id'] . ",") === false) {
				if ($vrow['Nums'] == 0) {
					$vstr = $vstr . '<div class="bt_setdefaultmini" onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\',\'' . $vTang . '\',\'' . $vorder . '\')" >' . $vrow['name'] . '</div>';
				} else {

					$vstr = $vstr . '<div class="bt_setdefaultmini defaultred" onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\',\'' . $vTang . '\',\'' . $vorder . '\')">' . $vrow['name'] . '</div>';
				}
			}
			$vStrFist = 'onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\',\'' . $vTang . '\',\'' . $vorder . '\')" ';
			$vlistID = $vlistID . "," . $vrow['id'] . ",";
			$i++;
		}
		if ($i == 0) {
			$vStrFist = 'onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\',\'' . $vTang . '\',\'' . $vorder . '\')" ';
			$strLeft = str_replace("@#@01", $vStrFist, $strLeft);
		} elseif ($i == 1) {
			$strLeft = str_replace("@#@01", $vStrFist, $strLeft);
		} else
			$strLeft = $strLeft . '<div id="liftview_' . $vorder . '" class="viewlift" style="display:none;clear:both;" onmouseleave="closepoplift(\'' . $vorder . '\')">
						<p style="position:absolute;right:0px;top:0px" onclick="closepoplift(\'' . $vorder . '\')"><img width="60" src="images/icon/closefull.png"/></p>
						<div class="liftview_title">Chọn thuê</div>
					' . $vstr . '</div>';
		return "";
	}
	function LV_GetButtonMiniView($vRoomID, $vorder, $vLangArr, $vautocrease, $vDHID)
	{
		$vstr = '';
		$vlistID = "";
		$lvsql = "select MP.id,MP.name,IF(MP.Nums>0,1,0) Nums from (select distinct A.lv003 id,B.lv002 name,(select count(*) from sl_lv0014 BB where BB.lv003=A.lv004 and BB.lv002='$vDHID') Nums,B.lv004 vOrder from sl_lv0072 A inner join sl_lv0071 B on A.lv003=B.lv001 where 1=1 and A.lv002='$vRoomID') MP order by MP.vOrder,MP.Nums Desc";
		$vresult = db_query($lvsql);
		$vStrFist = "";
		$i = 0;
		while ($vrow = db_fetch_array($vresult)) {
			if (strpos($vlistID, "," . $vrow['id'] . ",") === false) {
				if ($vrow['Nums'] == 0) {
					$vstr = $vstr . '<div class="bt_setdefaultminiview" onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\')" >' . $vrow['name'] . '</div>';
				} else {

					$vstr = $vstr . '<div class="bt_setdefaultminiview defaultredminiview" onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\')">' . $vrow['name'] . '</div>';
				}
			}
			$vStrFist = 'onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\')" ';
			$vlistID = $vlistID . "," . $vrow['id'] . ",";
			$i++;
		}

		return $vstr;
	}
	function LV_GetButton($vRoomID, $vBangID, $vLangArr, $vautocrease, $vDHID)
	{
		$vstr = '';
		$vlistID = "";
		$lvsql = "select MP.id,MP.name,IF(MP.Nums>0,1,0) Nums from (select distinct A.lv003 id,B.lv002 name,(select count(*) from sl_lv0014 BB where BB.lv003=A.lv004 and BB.lv002='$vDHID') Nums,B.lv004 vOrder from sl_lv0072 A inner join sl_lv0071 B on A.lv003=B.lv001 where 1=1 and A.lv002='$vRoomID') MP order by MP.vOrder,MP.Nums Desc";
		$vresult = db_query($lvsql);
		while ($vrow = db_fetch_array($vresult)) {
			if (strpos($vlistID, "," . $vrow['id'] . ",") === false) {
				if ($vrow['Nums'] == 0)
					$vstr = $vstr . '<input class="bt_setdefault" type="button" name="" onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\')" value="' . $vrow['name'] . '"/>';
				else
					$vstr = $vstr . '<input class="bt_setdefault defaultred" type="button" name="" onclick="SetDefData(\'' . $vrow['id'] . '\',\'' . $vRoomID . '\')" value="' . $vrow['name'] . '"/>';
			}
			$vlistID = $vlistID . "," . $vrow['id'] . ",";
		}
		$vstr = $vstr . '';
		return $vstr;
	}
	function LV_GetPCMoney($vContractID)
	{
		//GetMoney
		if ($vContractID == '' || $vContractID == NULL)
			return 0;
		$vListParent = $this->LV_GetInvoiceParent($vContractID, 1);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE A.lv002 in (" . $vListParent . ")";
		$vReturnArr = array();
		$lvResult = db_query($lvsql);
		$row = db_fetch_array($lvResult);
		return $row['SumMoney'];

	}
	function LV_GetPTMoney($vContractID)
	{
		//GetMoney
		if ($vContractID == '' || $vContractID == NULL)
			return 0;
		$vListParent = $this->LV_GetInvoiceParent($vContractID, 0);
		$lvsql = "select if(ISNULL(sum(lv004)),0,sum(lv004)) SumMoney from ac_lv0005 A  WHERE A.lv002 in (" . $vListParent . ") ";
		$vReturnArr = array();
		$lvResult = db_query($lvsql);
		$row = db_fetch_array($lvResult);
		return $row['SumMoney'];
	}
	function LV_GetInvoiceParent($vContractID, $vtype)
	{
		$vResult = '';
		$lvsql = "select B.lv001 from ac_lv0004 B where B.lv013='$vContractID' and B.lv002='$vtype'";
		$lvResult = db_query($lvsql);
		while ($row = db_fetch_array($lvResult)) {
			if ($vResult == "")
				$vResult = "'" . $row['lv001'] . "'";
			else
				$vResult = $vResult . ",'" . $row['lv001'] . "'";
			;
		}
		if ($vResult == '')
			return "''";
		else
			return $vResult;
	}
	function LV_GetDetailCus($vContractID)
	{
		$vResult = '';
		$lvsql = "select B.lv015 from sl_lv0014 B inner join sl_lv0001 A on A.lv001=B.lv015 where B.lv002='$vContractID'";
		$lvResult = db_query($lvsql);
		while ($row = db_fetch_array($lvResult)) {
			if ($vResult == "")
				$vResult = "" . $row['lv015'] . "";
			else
				$vResult = $vResult . "," . $row['lv015'] . "";
			;
		}
		return $vResult;
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
		$lvTrSum = "<tr class=\"lvlinehtable@01\">
			<td colspan=\"2\"><strong>" . ($this->ArrPush[99]) . "</strong></td>
			@#01
		</tr>
		";
		$lvHref = "<span onclick=\"ProcessTextHiden(this)\"><a href=\"javascript:FunctRunning1('@01')\" style=\"text-decoration:none\">@02</a></span>";
		$lvTdH = "<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd = "<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$lvSum = "<td  class=\"@#04\" align=\"@#05\"><strong>@02</strong></td>";
		$sqlS = "SELECT *,IF(lv011=2,(DATEDIFF(lv004,lv021)+30),(DATEDIFF(lv004,CURDATE())+30)) lv025 FROM sl_lv0013 WHERE 1=1  " . $this->GetCondition() . " $strSort LIMIT $curRow, $maxRows";
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
		$sumHD = 0;
		$sumTT = 0;
		$sumCL = 0;
		while ($vrow = db_fetch_array($bResult)) {
			$strL = "";
			$vorder++;
			$strSum = '';
			for ($i = 0; $i < count($lstArr); $i++) {
				if ($lstArr[$i] == "lv023") {
					$AmountHD = $this->LV_GetContractMoney($vrow['lv001'], $vrow['lv006']);
					$sumHD = $sumHD + $AmountHD;
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($AmountHD, (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", $this->FormatView($sumHD, (int) $this->ArrView[$lstArr[$i]]), $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv024") {
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'], $vrow['lv006']), (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv026") {
					$AmountTT = $this->LV_GetPTMoney($vrow['lv001']) - $this->LV_GetPCMoney($vrow['lv001']);
					$sumTT = $sumTT + $AmountTT;
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($AmountTT, (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", $this->FormatView($sumTT, (int) $this->ArrView[$lstArr[$i]]), $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv027") {
					$AmountHD = $this->LV_GetContractMoney($vrow['lv001'], $vrow['lv006']);
					$AmountTT = $this->LV_GetPTMoney($vrow['lv001']) - $this->LV_GetPCMoney($vrow['lv001']);
					$AmountCL = $AmountHD - $AmountTT;
					$sumCL = $sumCL + $AmountCL;
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($AmountCL, (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", $this->FormatView($sumCL, (int) $this->ArrView[$lstArr[$i]]), $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv028") {
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $vrow['lv001']), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv029") {
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $vrow['lv002']), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv100") {
					$vListCust = $this->LV_GetDetailCus($vrow['lv001']);
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $vListCust), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} else {
					$vTemp = str_replace("@02", str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), str_replace("@01", $vrow['lv001'], $lvHref)), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				}

				$strL = $strL . $vTemp;
				$strSum = $strSum . $vTempsum;
			}

			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv011'] == 1)
				$strTr = str_replace("@#04", "lvlineapproval", $strTr);
			else if ($vrow['lv011'] == 2)
				$strTr = str_replace("@#04", "lvlineapproval_level2", $strTr);
			else if ($vrow['lv011'] == 3)
				$strTr = str_replace("@#04", "lvlineapproval_level3", $strTr);
			else if ($vrow['lv011'] == 4)
				$strTr = str_replace("@#04", "lvlineapproval_level4", $strTr);
			else
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strTr = $strTr . str_replace("@#01", $strSum, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTrSum))));
		$strTrH = str_replace("@#01", $strH, $lvTrH);
		$lvTotalNumTd = str_replace("@#01", $this->FormatView($vtotalnum, 10), $lvTotalNumTd);
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
			window.open('" . $this->Dir . "sl_lv0013/?lang=" . $this->lang . "&childfunc='+value+'&ID=" . base64_encode($this->lv002) . "','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
		$sqlS = "SELECT * FROM sl_lv0013 WHERE 1=1 and lv004 like '$lvDateSort%'  $strSort LIMIT $curRow, $maxRows";
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
				if ($lstArr[$i] == "lv023") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetContractMoney($vrow['lv001'], $vrow['lv006']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv024") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'], $vrow['lv006']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv026") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetPTMoney($vrow['lv001']) - $this->LV_GetPCMoney($vrow['lv001']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
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
	function LV_GetBLMoney($vContractID)
	{
		$lvsql = "select sum(PM.lv003) money,sum(PM.lv004) convertmoney,sum(PM.lv005) discount from ((select sum(A.lv004*A.lv006) lv003,sum(A.lv004*A.lv006*A.lv008/100) lv004,sum(A.lv004*A.lv006*A.lv011/100) lv005 from sl_lv0014 A inner join sl_lv0013 B on A.lv002=B.lv001  where 1=1 and B.lv001='$vContractID' )) PM ";
		$vresult = db_query($lvsql);
		$vrow = db_fetch_array($vresult);
		if ($vrow['convertmoney'] == 0) {
			if ($vrow['money'] == 0)
				return "0";
		}
		return $vrow['convertmoney'] + $vrow['money'] - $vrow['discount'];
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
		$lvTable = "<div align=\"center\"><img  src=\"" . $this->GetLogo() . "\" /></div>
		<div align=\"center\"><h1>" . ($this->ArrPush[0]) . "</h2></div>
		<table  align=\"center\" class=\"lvtable\" border=1>
		@#01
		</table>
		";
		$lvTrH = "<tr class=\"lvhtable\">
			<td width=1% class=\"lvhtable\">" . $this->ArrPush[1] . "</td>
			
			@#01
		</tr>
		";
		$lvTr = "<tr class=\"lvlinehtable@01\">
			<td width=1% onclick=\"Select_Check('$lvChk@03',$lvFrom, '$lvChk', '$lvChkAll')\">@03</td>
			@#01
		</tr>
		";
		$lvTrSum = "<tr class=\"lvlinehtable@01\">
			<td ><strong>" . ($this->ArrPush[99]) . "</strong></td>
			@#01
		</tr>
		";
		$lvTdH = "<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd = "<td  class=\"#04\" align=\"@#05\">@02</td>";
		$lvSum = "<td  class=\"#04\" align=\"@#05\"><strong>@02</strong></td>";
		$sqlS = "SELECT *,IF(lv011=2,(DATEDIFF(lv005,lv021)+30),(DATEDIFF(lv005,CURDATE())+30)) lv025 FROM sl_lv0013 WHERE 1=1  " . $this->RptCondition . " $strSort LIMIT $curRow, $maxRows";
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
			$strSum = '';
			for ($i = 0; $i < count($lstArr); $i++) {
				if ($lstArr[$i] == "lv023") {
					$AmountHD = $this->LV_GetContractMoney($vrow['lv001'], $vrow['lv006']);
					$sumHD = $sumHD + $AmountHD;
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($AmountHD, (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", $this->FormatView($sumHD, (int) $this->ArrView[$lstArr[$i]]), $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv024") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'], $vrow['lv006']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv026") {
					$AmountTT = $this->LV_GetPTMoney($vrow['lv001']) - $this->LV_GetPCMoney($vrow['lv001']);
					$sumTT = $sumTT + $AmountTT;
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($AmountTT, (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", $this->FormatView($sumTT, (int) $this->ArrView[$lstArr[$i]]), $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv027") {
					$AmountHD = $this->LV_GetContractMoney($vrow['lv001'], $vrow['lv006']);
					$AmountTT = $this->LV_GetPTMoney($vrow['lv001']) - $this->LV_GetPCMoney($vrow['lv001']);
					$AmountCL = $AmountHD - $AmountTT;
					$sumCL = $sumCL + $AmountCL;
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($AmountCL, (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", $this->FormatView($sumCL, (int) $this->ArrView[$lstArr[$i]]), $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv028") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $vrow['lv001']), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv029") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $vrow['lv002']), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				} else {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
					$vTempsum = str_replace("@02", '', $this->Align($lvSum, (int) $this->ArrView[$lstArr[$i]]));
				}
				$strL = $strL . $vTemp;
				$strSum = $strSum . $vTempsum;
			}

			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv011'] == 1)
				$strTr = str_replace("@#04", "lvlineapproval", $strTr);
			else
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strTr = $strTr . str_replace("@#01", $strSum, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTrSum))));
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
		<div align=\"center\" class=lv0>" . ($this->ArrPush[0]) . "</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		</table>
		";
		$lvTrH = "<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr = "<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTdH = "<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd = "<td  class=\"#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT *,IF(lv011=2,(DATEDIFF(lv005,lv021)+30),(DATEDIFF(lv005,CURDATE())+30)) lv025 FROM sl_lv0013 WHERE 1=1  " . $this->GetConditionView() . " $strSort LIMIT $curRow, $maxRows";
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
				if ($lstArr[$i] == "lv023") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetContractMoney($vrow['lv001'], $vrow['lv006']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv024") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetContractMoneyProduct($vrow['lv001'], $vrow['lv006']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} elseif ($lstArr[$i] == "lv026") {
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($this->LV_GetPTMoney($vrow['lv001']) - $this->LV_GetPCMoney($vrow['lv001']), (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				} else
					$vTemp = str_replace("@02", $this->getvaluelink($lstArr[$i], $this->FormatView($vrow[$lstArr[$i]], (int) $this->ArrView[$lstArr[$i]])), $this->Align($lvTd, (int) $this->ArrView[$lstArr[$i]]));
				$strL = $strL . $vTemp;
			}


			$strTr = $strTr . str_replace("@#01", $strL, str_replace("@02", $vrow['lv001'], str_replace("@03", $vorder, str_replace("@01", $vorder % 2, $lvTr))));
			if ($vrow['lv011'] == 1)
				$strTr = str_replace("@#04", "", $strTr);

		}
		$strTrH = str_replace("@#01", $strH, $lvTrH);
		return str_replace("@#01", $strTrH . $strTr, $lvTable);
	}
	public function LV_LinkField($vFile, $vSelectID)
	{
		return ($this->CreateSelect($this->sqlcondition($vFile, $vSelectID), 0));
	}
	private function sqlcondition($vFile, $vSelectID)
	{
		$vsql = "";
		switch ($vFile) {
			case 'lv002':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001";
				break;
			case 'lv007':
				$vsql = "select MP.lv001,concat(MP.lv002,IF(ISNULL(MP.lv002_),'','*')) lv002,MP.lv003 from (select lv001,concat(lv002,'(',lv004,')') lv002,(select BB.lv001 from sl_lv0013 BB where BB.lv007=A.lv001 and BB.lv011=0 limit 0,1) lv002_,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009 A) MP";
				break;
			case 'lv008':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0008";
				break;
			case 'lv011':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054";
				break;
			case 'lv012':
				if ($this->lv002 != "")
					$vsql = "select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 where lv002='$this->lv002'";
				else
					$vsql = "select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 ";
				break;
			case 'lv015':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0016";
				break;
			case 'lv017':
				$vsql = "select lv001,concat(lv003,' - ',lv016) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0013";
				break;
		}
		return $vsql;
	}
	public function getvaluelink($vFile, $vSelectID)
	{
		switch ($vFile) {
			/*case 'lv002':
																																																																												$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 where lv001='$vSelectID'";
																																																																												$lvopt=2;
																																																																												break;*/
			case 'lv007':
				$lvopt = 0;
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009 where lv001='$vSelectID'";
				break;
			case 'lv077':
				$lvopt = 0;
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0009 where lv001='$vSelectID'";
				break;
			case 'lv008':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0008 where lv001='$vSelectID'";
				break;
			case 'lv010':
				$lvopt = 2;
				$vsql = "select lv001,lv002 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";
				break;
			case 'lv011':
				$vsql = "select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0054 where lv001='$vSelectID'";
				break;
			case 'lv012':
				$vsql = "select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0010 where lv002='$this->lv002'";
				break;
			case 'lv028':
				$vsql = "select A.lv001,(select concat(B.lv002,'(',B.lv001,')') from hr_lv0020 B where B.lv001=A.lv011)  lv002,IF(lv001='$vSelectID',1,0) lv003 from  wh_lv0010 A  where (A.lv005='CONTRACT' or A.lv005='RECONTRACT') and A.lv006='$vSelectID'";
				break;
			case 'lv029':
				$vsql = "select A.lv001,concat(lv009,',',lv007) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0001 A  where A.lv001='$vSelectID'";
				break;
			/*case 'lv017':
																																																																												$vsql="select lv001,concat(lv003,' - ',lv016) lv002,IF(lv001='$vSelectID',1,0) lv003 from  sl_lv0013 where lv002='$this->lv002'";
																																																																												break;*/
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


	// code Long

	//tinh tong tien theo trang thai dang ban va dang don, de ht len ban
	//tinh tong tien theo trang thai dang ban va dang don, de ht len ban
	function Mb_HoaDonBan()
	{
		$vArrRe = [];
		$vsql = "SELECT cthd.lv002, SUM(cthd.lv004 * cthd.lv006) AS tongTien , hd.lv011 as
		 trangThai , hd.lv007 as maBan, hd.lv004 as thoiGian, hd.lv001 as
		  idDonHang, b.lv002 AS tenBanGop FROM sl_lv0014 cthd JOIN sl_lv0013 hd ON cthd.lv002 = hd.lv001 LEFT JOIN sl_lv0009 b ON hd.lv024 = b.lv001  GROUP BY  cthd.lv002, hd.lv011 HAVING hd.lv011 IN (0, 1)";
		$vresult = db_query($vsql);
		while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
			$vArrRe[] = [
				"idDonHang" => $vrow["lv002"],
				"tongTien" => $vrow["tongTien"],
				"trangThai" => $vrow["trangThai"],
				"idBan" => $vrow["maBan"],
				"thoiGian" => $vrow["thoiGian"],
				"tenBanGop" => $vrow["tenBanGop"]
			];
		}
		return $vArrRe;
	}

	// hàm load cả hóa đơn rỗng
	function loadHoaDonRong()
	{
		$vArrRe = [];
		$vsql = "
			SELECT
				hd.lv001 AS idDonHang,
				hd.lv011 AS trangThai,
				hd.lv007 AS maBan,
				hd.lv004 AS thoiGian,
				b.lv002  AS tenBanGop,
				COALESCE(SUM(cthd.lv004 * cthd.lv006), 0) AS tongTien
			FROM sl_lv0013 hd
			LEFT JOIN sl_lv0014 cthd ON cthd.lv002 = hd.lv001
			LEFT JOIN sl_lv0009 b    ON hd.lv024 = b.lv001
			WHERE hd.lv011 IN (0,1)
			GROUP BY hd.lv001, hd.lv011, hd.lv007, hd.lv004, b.lv002
		";
		$vresult = db_query($vsql);
		while ($vrow = db_fetch_array($vresult, MYSQLI_ASSOC)) {
			$vArrRe[] = [
				"idDonHang"  => $vrow["idDonHang"],
				"tongTien"   => $vrow["tongTien"],
				"trangThai"  => $vrow["trangThai"],
				"idBan"      => $vrow["maBan"],
				"thoiGian"   => $vrow["thoiGian"],
				"tenBanGop"  => $vrow["tenBanGop"],
			];
		}
		return $vArrRe;
	}






	// ham dung de gop ban




	///////////
	function capNhatHd($idHd)
	{
		// Cập nhật trạng thái món trong bảng sl_lv0014
		$sql = "UPDATE sl_lv0013
			SET lv011 = 2
			WHERE lv001 = '$idHd'";
		// Thực thi câu lệnh SQL sử dụng hàm db_query thay vì $this->db->query
		$result = db_query($sql);
		return $result;
	}
	// ham moi
	function loadTrangThaiBanTheoHoaDon()
	{
		$sql = "SELECT c.lv001 as maCt,  c.lv004 as soLuong, c.lv006 as donGia,  h.lv024 as gopBan,  
		c.lv014 ngayOrder, h.lv007 as maBan,  h.lv001 as maHoaDon ,  h.lv011  as trangThai, h.lv004 as gioVao, h.lv013 as checkChuyenBan
				FROM sl_lv0014 c
				JOIN sl_lv0013 h ON c.lv002 = h.lv001
				WHERE h.lv011 = '0' OR h.lv011 = '-1' OR h.lv011 = '1'";
		$vresult = db_query($sql);
		$data = [];
		if ($vresult && mysqli_num_rows($vresult) > 0) {
			while ($row = mysqli_fetch_assoc($vresult)) {
				$data[] = $row;
			}
		}
		return $data;
	}

	function l_gopBan($idDonHang, $idBanGop)
	{
		$success = true;
		$errorMessages = [];

		if ($idBanGop != null && $idDonHang != null) {
			// Cập nhật lv024 để thêm id bàn gộp
			$updateLv024 = "UPDATE sl_lv0013 
							SET lv024 = CONCAT(IF(ISNULL(lv024), '', lv024), ',', '" . $idBanGop . "') 
							WHERE lv001 = '" . $idDonHang . "'";
			db_query($updateLv024);

			// Lấy thông tin đơn hàng theo id bàn
			$vsql = "SELECT lv001 
					FROM sl_lv0013 
					WHERE lv007 = '" . $_GET['bangid'] . "' AND lv011 = 0 
					LIMIT 1";
			$vresult = db_query($vsql);
			$vrow = db_fetch_array($vresult);

			if ($vrow) {
				$vMaDonHang = $vrow['lv001'];

				// Sao chép chi tiết đơn hàng từ đơn cũ sang đơn mới
				$vsql = "INSERT INTO sl_lv0014 (
							lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
							lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, 
							lv020, lv021, lv022, lv023, lv102
						)
						SELECT 
							'" . $_GET['donhangid'] . "', lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
							lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, 
							lv020, lv021, lv022, lv023, '$vMaDonHang'
						FROM sl_lv0014 
						WHERE lv002 = '" . $vMaDonHang . "'";
				db_query($vsql);

				// Xóa chi tiết đơn cũ
				$vsql = "DELETE FROM sl_lv0014 WHERE lv002 = '" . $vMaDonHang . "'";
				db_query($vsql);

				// Cập nhật trạng thái đơn cũ thành đã gộp
				$vsql = "UPDATE sl_lv0013 SET lv011 = -1 WHERE lv001 = '" . $vMaDonHang . "'";
				db_query($vsql);
			}
		} else {
			// Nếu huỷ gộp, loại bỏ id bàn khỏi lv024
			$vsql = "UPDATE sl_lv0013 
					SET lv024 = REPLACE(lv024, '," . $idBanGop . "', '') 
					WHERE lv001 = '" . $idDonHang . "'";
			db_query($vsql);
		}

		$finalMessage = $success ? 'Gộp bàn thành công!' : 'Gộp bàn thất bại!';
		if (!$success) {
			$finalMessage .= "\n" . implode("\n", $errorMessages);
		}

		return [
			'success' => $success,
			'message' => $finalMessage,
		];
	}

	////Ham cu
	function l_gopBan_Cu($idDonHang, $idBanGop)
	{
		$success = true; // Biến để theo dõi trạng thái thực hiện
		$errorMessages = []; // Mảng lưu trữ các thông báo lỗi

		// Gộp bàn thêm vào cột lv024
		$updateLv024 = "UPDATE sl_lv0013  
                    SET lv024 = TRIM(BOTH ',' FROM CONCAT(IFNULL(lv024, ''), ',', '" . $idBanGop . "')) 
                    WHERE lv001 = '" . $idDonHang . "'";

		if (!db_query($updateLv024)) {
			$success = false;
			$errorMessages[] = "Lỗi khi cập nhật lv024 cho đơn hàng $idDonHang.";
		}

		$mang = explode(",", $idBanGop);
		foreach ($mang as $id) {
			// Kiểm tra xem bàn có tồn tại không
			$vsql = "SELECT lv001 FROM sl_lv0013 WHERE lv007 = '" . $id . "' AND lv011 = 0 LIMIT 1";
			$vresult = db_query($vsql);
			$vrow = db_fetch_array($vresult);

			if ($vrow) {
				$vMaDonHang = $vrow['lv001'];

				// Chuyển dữ liệu đơn hàng
				$insertCthd = "INSERT INTO sl_lv0014 (
                lv002, lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
                lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, 
                lv020, lv021, lv022, lv023, lv102, lv031
            )
            SELECT 
                '$idDonHang', lv003, lv004, lv005, lv006, lv007, lv008, lv009, lv010, 
                lv011, lv012, lv013, lv014, lv015, lv016, lv017, lv018, lv019, lv020, 
                lv021, lv022, lv023, '$vMaDonHang', 0 
            FROM sl_lv0014 
            WHERE lv002 = '$vMaDonHang'";

				if (!db_query($insertCthd)) {
					$success = false;
					$errorMessages[] = "Lỗi khi chèn dữ liệu từ hóa đơn cũ ($vMaDonHang).";
				}

				// Xóa chi tiết hóa đơn cũ
				$deleteCthd = "DELETE FROM sl_lv0014 WHERE lv002 = '$vMaDonHang'";
				if (!db_query($deleteCthd)) {
					$success = false;
					$errorMessages[] = "Lỗi khi xóa chi tiết hóa đơn cũ ($vMaDonHang).";
				}

				// Cập nhật trạng thái hóa đơn cũ thành `-1`
				$updateOldInvoice = "UPDATE sl_lv0013 SET lv011 = -1 WHERE lv001 = '$vMaDonHang'";
				if (!db_query($updateOldInvoice)) {
					$success = false;
					$errorMessages[] = "Lỗi khi cập nhật trạng thái hóa đơn cũ ($vMaDonHang).";
				}
			}
		}

		// Tạo thông báo cuối cùng
		$finalMessage = $success ? 'Gộp bàn thành công!' : 'Gộp bàn thất bại!';

		// Nếu có lỗi, gộp tất cả các lỗi lại
		if (!$success) {
			$finalMessage .= "\n" . implode("\n", $errorMessages);
		}

		// Trả về thông báo thành công hoặc thất bại dưới dạng một mảng kết hợp
		return [
			'success' => $success,
			'message' => $finalMessage,
		];
	}


	// ...existing code...
	// ...existing code...
	function chuyenBan($maHdBanCanChuyen, $maHdBanChuyen, $maBanChuyen)
	{
		$success = true; // Biến để theo dõi trạng thái thực hiện
		$errorMessages = []; // Mảng lưu trữ các thông báo lỗi

		// Lấy tất cả chi tiết hóa đơn
		$sql = "SELECT * FROM `sl_lv0014` WHERE lv002 = '$maHdBanCanChuyen'";
		$vresult = db_query($sql);

		if (!$maHdBanChuyen) {
			// Nếu bàn đó đang trống thì tạo 1 hóa đơn mới
			$maHoaDon = 'HD' . strtoupper(uniqid());
			$trangThai = "0";
			$ngayHienTai = date('Y-m-d H:i:s');
			$ngTao = "AD001";
			$lvsql = "INSERT INTO sl_lv0013 (
            lv001, lv004, lv007, lv011, lv032
        ) VALUES (
            '$maHoaDon', '$ngayHienTai', '$maBanChuyen', '$trangThai', '$ngTao'
        )";
			if (!db_query($lvsql)) {
				$success = false;
				$errorMessages[] = "Lỗi khi tạo hóa đơn mới.";
			}

			// Cập nhật lại mã hóa đơn của các chi tiết hóa đơn từ bàn cần chuyển sang hóa đơn mới
			$updateCthd = "UPDATE sl_lv0014 SET lv002 = '$maHoaDon' WHERE lv002 = '$maHdBanCanChuyen'";
			if (!db_query($updateCthd)) {
				$success = false;
				$errorMessages[] = "Lỗi khi cập nhật chi tiết hóa đơn sang hóa đơn mới.";
			}

			// Xóa hóa đơn cũ đã chuyển
			$deleteOldHd = "DELETE FROM sl_lv0013 WHERE lv001 = '$maHdBanCanChuyen'";
			if (!db_query($deleteOldHd)) {
				$success = false;
				$errorMessages[] = "Lỗi khi xóa hóa đơn cũ.";
			}
		} else if ($vresult) {
			// Cập nhật lại mã hóa đơn của các chi tiết hóa đơn từ bàn cần chuyển sang hóa đơn chuyển
			$updateCthd = "UPDATE sl_lv0014 SET lv002 = '$maHdBanChuyen' WHERE lv002 = '$maHdBanCanChuyen'";
			if (!db_query($updateCthd)) {
				$success = false;
				$errorMessages[] = "Lỗi khi cập nhật chi tiết hóa đơn sang hóa đơn chuyển.";
			}

			// Xóa hóa đơn cũ đã chuyển
			$deleteOldHd = "DELETE FROM sl_lv0013 WHERE lv001 = '$maHdBanCanChuyen'";
			if (!db_query($deleteOldHd)) {
				$success = false;
				$errorMessages[] = "Lỗi khi xóa hóa đơn cũ.";
			}
		}

		$finalMessage = $success ? 'Chuyển bàn thành công!' : 'Chuyển bàn thất bại!';
		if (!$success) {
			$finalMessage .= "\n" . implode("\n", $errorMessages);
		}

		return [
			'success' => $success,
			'message' => $finalMessage,
		];
	}
	// ...existing code...


	function tachBan($idDonHang)
	{
		$success = true; // Biến để theo dõi trạng thái thực hiện
		$errorMessages = []; // Mảng lưu trữ các thông báo lỗi
		$updateLv024 = "
			UPDATE sl_lv0013  
			SET lv024 = NULL
			WHERE lv001 = '" . $idDonHang . "'
		";

		if (!db_query($updateLv024)) {
			$success = false;
			$errorMessages[] = "Lỗi khi cập nhật lv024 cho đơn hàng $idDonHang.";
		}

		$finalMessage = $success ? 'Tách bàn thành công!' : 'Tách bàn thất bại!';

		if (!$success) {
			$finalMessage .= "\n" . implode("\n", $errorMessages);
		}
		return [
			'success' => $success,
			'message' => $finalMessage,
		];
	}

	function taoHoaDon($maBan)
	{
		$success = true; // Biến để theo dõi trạng thái thực hiện
		$errorMessage = '';
		$maHoaDon = 'HD' . strtoupper(uniqid());
		$trangThai = "0";
		$ngayHienTai = date('Y-m-d H:i:s');
		$lv010 = "AD001";

		$lvsql = "INSERT INTO sl_lv0013 (
			lv001, lv004, lv007, lv010, lv011
		) VALUES (
			'$maHoaDon', '$ngayHienTai','$maBan', '$lv010', '$trangThai'
		)"; // <- Đóng chuỗi SQL đúng chỗ này

		$vReturn = db_query($lvsql);
		if (!$vReturn) {
			$success = false;
			$errorMessage .= "Lỗi tạo đơn hàng\n";
		}

		return [
			'success' => $success,
			'message' => $maHoaDon
		];
	}

	function capNhatHdV2($idHd, $trangThai)
	{
		// Cập nhật trạng thái món trong bảng sl_lv0014
		$sql = "UPDATE sl_lv0013
			SET lv011 = '$trangThai'
			WHERE lv001 = '$idHd'";
		// Thực thi câu lệnh SQL sử dụng hàm db_query thay vì $this->db->query
		$result = db_query($sql);
		return $result;
	}
	function capNhatHdtt4($idHd, $trangThai)
	{
		// Cập nhật trạng thái món trong bảng sl_lv0014
		$sql = "UPDATE sl_lv0013
			SET lv011 = '$trangThai',
				lv013 = NULL
			WHERE lv001 = '$idHd'";

		// Thực thi câu lệnh SQL sử dụng hàm db_query thay vì $this->db->query
		$result = db_query($sql);
		return $result;
	}
	// function chuyenXuongBep($idHd)
	// {
	// 	$sql = "UPDATE sl_lv0013 SET lv013 = 'Admin' AND lv011=0 WHERE lv001 = '$idHd'";
	// 	$result = db_query($sql);
	// 	return $result;
	// 	///////////////////////////////////////////////////////////////////////////////////////
	// }

	function chuyenXuongBep($idHd, $userId = 'AD001')
	{
		// Ghi nhận người chấp nhận
		$vsql = "UPDATE sl_lv0013 SET lv013 = CONCAT(IFNULL(lv013,''), '<br/>Người chấp nhận:','$userId','---Ngày giờ:',NOW()) WHERE lv001 = '$idHd' AND lv011 = 0";
		db_query($vsql);

		// Kiểm tra trạng thái đơn hàng
		$vsql = "SELECT lv011 FROM sl_lv0013 WHERE lv001 = '$idHd'";
		$result = db_query($vsql);
		$vrow = db_fetch_array($result);

		if ($vrow && $vrow['lv011'] == '0') {
			// Ghi nhận nhân viên chấp nhận bill xuống bếp/bar
			$vsql = "UPDATE sl_lv0013 SET lv013 = CONCAT(IFNULL(lv013,''), '<br/>NV chấp nhận bill xuống bếp/bar:','$userId','---Ngày giờ:',NOW()) WHERE lv001 = '$idHd' AND lv011 = 0";
			db_query($vsql);

			// Cập nhật chi tiết món
			$vsql = "UPDATE sl_lv0014 SET lv017 = 1, lv018 = 1, lv013 = CONCAT(CURDATE(),' ',CURTIME()), lv020 = '$userId' WHERE lv017 = 0 AND lv002 = '$idHd'";
			db_query($vsql);

			return 2;
		} else if ($vrow && $vrow['lv011'] != '0') {
			return 3;
		}
		return 0;
	}



	function checkBanStatus($maBan)
	{
		$sql = "SELECT lv001 FROM sl_lv0013 WHERE lv007 = '$maBan' AND lv011 IN (0, 1)";
		$result = db_query($sql);
		if ($result && mysqli_num_rows($result) > 0) {
			return true; // Bàn đang có hóa đơn
		} else {
			return false; // Bàn không có hóa đơn
		}
	}
	function chuyenMonAn($dsChiTietMonAn, $maBanChuyen)
	{
		$success = true;
		$errorMessages = [];
		$maHdBanChuyen = null;
		$hoaDonGoc = [];

		//Kiểm tra bàn đích có hóa đơn chưa
		$sqlCheck = "SELECT lv001 FROM sl_lv0013 WHERE lv007 = '$maBanChuyen' AND lv011 IN (0, 1) LIMIT 1";
		$result = db_query($sqlCheck);

		if ($result && $row = db_fetch_array($result)) {
			//Bàn đã có hóa đơn → dùng lại
			$maHdBanChuyen = $row['lv001'];
		} else {
			//Bàn chưa có → tạo hóa đơn mới
			$maHdBanChuyen = 'HD' . strtoupper(uniqid());
			$trangThai = "0";
			$ngayHienTai = date('Y-m-d H:i:s');
			$ngTao = "AD001";

			$createHoaDon = "INSERT INTO sl_lv0013 (lv001, lv004, lv007, lv011, lv032)
							VALUES ('$maHdBanChuyen', '$ngayHienTai', '$maBanChuyen', '$trangThai', '$ngTao')";
			if (!db_query($createHoaDon)) {
				$success = false;
				$errorMessages[] = "Lỗi khi tạo hóa đơn mới.";
			}
		}

		//Duyệt từng món: lấy mã hóa đơn gốc → cập nhật lv002
		foreach ($dsChiTietMonAn as $idChiTiet) {
			// Lấy mã hóa đơn gốc của món
			$sqlGetOld = "SELECT lv002 FROM sl_lv0014 WHERE lv001 = '$idChiTiet'";
			$res = db_query($sqlGetOld);
			if ($res && $row = db_fetch_array($res)) {
				$hoaDonGoc[] = $row['lv002'];
			}

			// Cập nhật lv002 = mã hóa đơn đích
			$updateChiTiet = "UPDATE sl_lv0014 SET lv002 = '$maHdBanChuyen' WHERE lv001 = '$idChiTiet'";
			if (!db_query($updateChiTiet)) {
				$success = false;
				$errorMessages[] = "Lỗi khi chuyển món có ID $idChiTiet.";
			}
		}

		//Kiểm tra từng hóa đơn gốc → nếu không còn món thì xóa
		$hoaDonGoc = array_unique($hoaDonGoc); // loại trùng
		foreach ($hoaDonGoc as $maHdGoc) {
			if ($maHdGoc == $maHdBanChuyen)
				continue; // tránh xóa nhầm hóa đơn đích
			$sqlCheckMon = "SELECT COUNT(*) AS soMon FROM sl_lv0014 WHERE lv002 = '$maHdGoc'";
			$res = db_query($sqlCheckMon);
			if ($res && $row = db_fetch_array($res)) {
				if ((int) $row['soMon'] === 0) {
					//Không còn món → xóa hóa đơn gốc
					$deleteHd = "DELETE FROM sl_lv0013 WHERE lv001 = '$maHdGoc'";
					if (!db_query($deleteHd)) {
						$success = false;
						$errorMessages[] = "Lỗi khi xóa hóa đơn $maHdGoc.";
					}
				}
			}
		}

		//Kết luận
		$finalMessage = $success ? 'Chuyển món thành công!' : 'Chuyển món thất bại!';
		if (!$success) {
			$finalMessage .= "\n" . implode("\n", $errorMessages);
		}

		return [
			'success' => $success,
			'message' => $finalMessage,
		];
	}
// Hàm hủy/xóa hóa đơn theo mã hóa đơn
	function huyHoaDon($maHd)
	{
		// Kiểm tra xem hóa đơn có tồn tại không
		$sqlCheck = "SELECT lv001, lv011 FROM sl_lv0013 WHERE lv001 = '$maHd'";
		$result = db_query($sqlCheck);
		
		if (!$result || mysqli_num_rows($result) == 0) {
			return [
				'success' => false,
				'message' => 'Hóa đơn không tồn tại'
			];
		}
		
		$row = db_fetch_array($result);
		$trangThai = $row['lv011'];
		
		// Chỉ cho phép hủy hóa đơn ở trạng thái chưa thanh toán (0: chờ, 1: đang phục vụ)
		if ($trangThai != 0 && $trangThai != 1) {
			return [
				'success' => false,
				'message' => 'Không thể hủy hóa đơn đã thanh toán hoặc đã hoàn thành'
			];
		}
		
		// Bắt đầu transaction
		db_query("START TRANSACTION");
		
		try {
			// Xóa chi tiết hóa đơn trước
			$sqlDeleteCthd = "DELETE FROM sl_lv0014 WHERE lv002 = '$maHd'";
			if (!db_query($sqlDeleteCthd)) {
				throw new Exception('Lỗi khi xóa chi tiết hóa đơn');
			}
			
			// Xóa hóa đơn
			$sqlDeleteHd = "DELETE FROM sl_lv0013 WHERE lv001 = '$maHd'";
			if (!db_query($sqlDeleteHd)) {
				throw new Exception('Lỗi khi xóa hóa đơn');
			}
			
			// Commit transaction
			db_query("COMMIT");
			
			return [
				'success' => true,
				'message' => 'Hủy hóa đơn thành công'
			];
			
		} catch (Exception $e) {
			// Rollback transaction nếu có lỗi
			db_query("ROLLBACK");
			
			return [
				'success' => false,
				'message' => 'Lỗi khi hủy hóa đơn: ' . $e->getMessage()
			];
		}
	}

}
?>