<?php
/////////////coding tc_lv0020///////////////
class   tc_lv0020 extends lv_controler
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
	public $lv018=null;
	public $lv019=null;
	public $lv020=null;
	public $lv021=null;
	public $lv022=null;
	public $lv023=null;
	public $lv024=null;
	public $lv025=null;
	public $lv026=null;
	public $lv027=null;
	public $lv028=null;
	public $lv029=null;
	public $lv030=null;
	public $lv031=null;
	public $lv032=null;
	public $lv033=null;
	public $lv034=null;
	public $lv035=null;
	public $lv036=null;
	public $lv037=null;
	public $lv038=null;
	public $lv039=null;
	public $lv040=null;
	public $lv041=null;
	public $lv042=null;
	public $lv043=null;
	public $lv044=null;
	public $lv045=null;
	public $lv046=null;
	public $lv047=null;
	public $lv048=null;
	public $lv049=null;
	public $lv050=null;
	public $lv051=null;
	public $lv052=null;
	public $lv053=null;
	public $lv054=null;
	public $lv055=null;
	public $lv056=null;
	public $lv057=null;
	public $lv058=null;
	public $lv059=null;
	public $lv060=null;
	public $lv061=null;
	public $lv062=null;
	public $lv063=null;
	public $lv064=null;
	public $lv065=null;
	public $lv067=null;
	public $lv068=null;
	public $lv069=null;
	public $lv070=null;
	public $lv071=null;
	public $lv072=null;
	public $lv073=null;
	public $lv074=null;
	public $lv075=null;
	public $lv076=null;
	public $lv077=null;
	public $lv078=null;
	public $lv079=null;
	public $lv080=null;
	public $lv081=null;
	public $lv082=null;
	public $lv083=null;
	public $lv084=null;
	public $lv085=null;
	public $lv086=null;
	public $lv087=null;
	public $lv088=null;
	public $lv089=null;
	public $lv090=null;
	public $lv091=null;
	public $lv092=null;
	public $lv093=null;
	public $lv094=null;
	public $lv095=null;
	public $lv096=null;
	public $lv097=null;
	public $lv099=null;
	public $lv100=null;
	public $lv101=null;
	public $ArrDaySpecial=null;
	public $CountDate=null;
	public $vArrDay=null;
	public $vArrPetrol=null;
	public $ContractCompare=null;
	public $ArrayDeptCode=null;
	public $ArrCalendar=null;
	public $Bank=null;
	public $ArrUnionCompany=null;
	public $NumKhongTru=null;
	public $TotalTCGiamThue=null;
	public $TotalNghi=null;
	public $MaxLe=null;
	
///////////
////////////////////GetDate
	public $DefaultFieldList="lv001,lv058,lv002,lv007,lv003,lv004,lv005,lv006,lv008,lv051,lv052,lv053,lv054,lv055,lv074,lv075,lv076,lv077,lv078,lv079,lv011,lv072,lv010,lv012,lv025,lv013,lv014,lv019,lv093,lv018,lv023,lv015,lv016,lv017,lv020,lv021,lv022,lv092,lv024,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv080,lv036,lv037,lv038,lv039,lv040,lv041,lv042,lv043,lv180,lv044,lv045,lv046,lv047,lv048,lv049,lv050,lv009,lv056,lv057,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv073,lv100,lv101,lv090,lv091";	
	public $DateDefault="1900-01-01";
	public $DateCurrent="1900-01-01";
	public $Count=null;
	public $paging=null;
	public $lang=null;
	public $mohr_lv0020=null;
	public $mohr_lv0038=null;
	public $motc_lv0009=null;
	public $ArrDepartment=null;
	public $ArrPriceItem=null;
	public $vlv024_sum=null;
	public $vlv024_sumcheck=null;
	protected $objhelp='tc_lv0020';
////////////
	var $ArrOther=array();
	var $ArrPush=array();
	var $ArrFunc=array();
	var $ArrGet=array("lv001"=>"2","lv002"=>"3","lv003"=>"4","lv004"=>"5","lv005"=>"6","lv006"=>"7","lv007"=>"8","lv008"=>"9","lv009"=>"10","lv010"=>"11","lv011"=>"12","lv012"=>"13","lv013"=>"14","lv014"=>"15","lv015"=>"16","lv016"=>"17","lv017"=>"18","lv018"=>"19","lv019"=>"20","lv020"=>"21","lv021"=>"22","lv022"=>"23","lv023"=>"24","lv024"=>"25","lv025"=>"26","lv026"=>"27","lv027"=>"28","lv028"=>"29","lv029"=>"30","lv030"=>"31","lv031"=>"32","lv032"=>"33","lv033"=>"34","lv034"=>"35","lv035"=>"36","lv036"=>"37","lv037"=>"38","lv038"=>"39","lv039"=>"40","lv040"=>"41","lv041"=>"42","lv042"=>"43","lv043"=>"44","lv044"=>"45","lv045"=>"46","lv046"=>"47","lv047"=>"48","lv048"=>"49","lv049"=>"50","lv050"=>"51","lv051"=>"52","lv052"=>"53","lv053"=>"54","lv054"=>"55","lv055"=>"56","lv056"=>"57","lv057"=>"58","lv058"=>"59","lv059"=>"60","lv060"=>"61","lv061"=>"62","lv062"=>"63","lv063"=>"64","lv064"=>"65","lv065"=>"66","lv066"=>"67","lv067"=>"68","lv068"=>"69","lv069"=>"70","lv070"=>"71","lv071"=>"72","lv072"=>"73","lv073"=>"74","lv074"=>"75","lv075"=>"76","lv076"=>"77","lv077"=>"78","lv078"=>"79","lv079"=>"80","lv080"=>"81","lv081"=>"82","lv082"=>"83","lv083"=>"84","lv084"=>"85","lv085"=>"86","lv086"=>"87","lv087"=>"88","lv088"=>"89","lv089"=>"90","lv090"=>"91","lv091"=>"92","lv092"=>"93","lv093"=>"94","lv100"=>"101","lv101"=>"102","lv180"=>"181");
	var $ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"2","lv004"=>"2","lv005"=>"2","lv006"=>"1","lv007"=>"0","lv008"=>"10","lv009"=>"10","lv010"=>"10","lv011"=>"10","lv012"=>"10","lv013"=>"10","lv014"=>"10","lv015"=>"10","lv016"=>"10","lv017"=>"10","lv018"=>"10","lv019"=>"10","lv020"=>"10","lv021"=>"10","lv022"=>"10","lv023"=>"10","lv024"=>"10","lv025"=>"10","lv026"=>"10","lv027"=>"10","lv028"=>"10","lv029"=>"10","lv030"=>"10","lv030"=>"10","lv031"=>"10","lv032"=>"10","lv033"=>"10","lv034"=>"10","lv035"=>"10","lv036"=>"10","lv037"=>"10","lv038"=>"10","lv039"=>"10","lv040"=>"10","lv041"=>"10","lv042"=>"10","lv043"=>"10","lv044"=>"10","lv045"=>"10","lv046"=>"10","lv047"=>"10","lv048"=>"10","lv049"=>"10","lv050"=>"10","lv051"=>"10","lv052"=>"10","lv053"=>"10","lv054"=>"10","lv055"=>"10","lv056"=>"0","lv057"=>"0","lv058"=>"0","lv059"=>"0","lv060"=>"0","lv061"=>"0","lv062"=>"0","lv063"=>"10","lv064"=>"10","lv065"=>"10","lv066"=>"10","lv067"=>"10","lv068"=>"10","lv069"=>"0","lv070"=>"10","lv071"=>"10","lv072"=>"10","lv073"=>"10","lv074"=>"10","lv075"=>"10","lv076"=>"10","lv077"=>"10","lv078"=>"10","lv079"=>"10","lv080"=>"10","lv081"=>"10","lv082"=>"10","lv083"=>"10","lv083"=>"10","lv084"=>"10","lv085"=>"10","lv086"=>"10","lv087"=>"10","lv088"=>"10","lv090"=>"10","lv091"=>"10","lv092"=>"10","lv093"=>"10","lv100"=>"0","lv101"=>"0","lv180"=>"10");	

	public $LE_CODE="NjlIUS02VFdULTZIS1QtNlFIQQ==";
	function __construct($vCheckAdmin,$vUserID,$vright)
	{
		$this->DateCurrent=GetServerDate()." ".GetServerTime();
		$this->Set_User($vCheckAdmin,$vUserID,$vright);
		$this->isRel=1;		
	 	$this->isHelp=1;	
		$this->isConfig=0;
	 	$this->isFil=0;	
		$this->isEdit=0;
		$this->lang=$_GET['lang'];		
		$this->vlv024_sumcheck=false;
		$this->ArrDaySpecial=Array();
		$this->vArrDay=Array();
		$this->vArrPetrol=Array();
		$this->CountDate=0;
		$this->ContractCompare=Array();
		$this->NumKhongTru=Array();
		$this->MaxLe=Array();
		
	}
	function LV_LoadMobil()
	{
		$vArrRe=Array();
		$vsql="select A.lv004,A.lv050 from  tc_lv0021 A  where 1=1 ".$this->GetConditionMoBil()." order by A.lv004 ASC,A.lv005 ASC";
		$vresult=db_query($vsql);
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$vArrRe[$i]=$vrow;
			$i++;
		}
		return $vArrRe;
	}
	protected function GetConditionMoBil()
	{
		$strCondi="";
		
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		
		if($this->year!="")
		{
			if($this->month!="")
			{
				$this->month=Fillnum($this->month,2);
				 $strCondi=$strCondi." and (substr(A.lv004,1,7)='$this->year-$this->month')";
			}	
			else
				 $strCondi=$strCondi." and (substr(A.lv004,1,4)<='$this->year' )";
		}
		
		return $strCondi;
	}
	function LV_Load()
	{
		$vsql="select * from  tc_lv0021";
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
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv100=$vrow['lv100'];
		}
	}
	function LV_LoadActiveMultiID($vlv002,$vlv020)
	{
		$vArrSalary=Array();
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv060='$vlv020'";
		$vresult=db_query($lvsql);
		$i=0;
		while($vrow=db_fetch_array($vresult))
		{
			$vArrSalary[$i]=$vrow;
			$i++;
		}
		return $vArrSalary;
	}
	function LV_LoadActiveShowID($vrow)
	{
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
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];	
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];	
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv100=$vrow['lv100'];
		}
		else
			$this->lv001=null;
	}
	function LV_LoadActiveID($vlv002,$vlv020)
	{
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv060='$vlv020'";
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
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];	
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];	
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv100=$vrow['lv100'];
		}
		else
			$this->lv001=null;
	}
	function LV_LoadID($vlv001)
	{
		$lvsql="select * from  tc_lv0021 Where lv001='$vlv001'";
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
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];	
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];	
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv100=$vrow['lv100'];
		}
	}
	function LV_GetAmountTypeCalID($vlv002,$vlv060,$vlv032,$vField)
	{
		$lvsql="select $vField from  tc_lv0021 Where lv002='$vlv002' and lv060='$vlv060' and lv057='$vlv032'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return (float)$vrow[$vField];
		}
		return 0;
	}
	function LV_GetCountSalary($vlv002,$vYear)
	{
		$lvsql="select count(*) Nums from  tc_lv0021 Where lv002='$vlv002' and year(lv004)='$vYear'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return (float)$vrow['Nums'];
		}
		return 0;
	}
	function LV_LoadTypeCalID($vlv002,$vlv060,$vlv032)
	{
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv060='$vlv060' and lv057='$vlv032'";
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
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];	
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];	
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];
			$this->lv100=$vrow['lv100'];
		}
	}
	function LV_LoadCurrentID($vlv002,$vlv060)
	{
		$lvsql="select * from  tc_lv0021 Where lv002='$vlv002' and lv060='$vlv060'";
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
			$this->lv018=$vrow['lv018'];
			$this->lv019=$vrow['lv019'];
			$this->lv020=$vrow['lv020'];
			$this->lv021=$vrow['lv021'];
			$this->lv022=$vrow['lv022'];
			$this->lv023=$vrow['lv023'];	
			$this->lv024=$vrow['lv024'];
			$this->lv025=$vrow['lv025'];
			$this->lv026=$vrow['lv026'];
			$this->lv027=$vrow['lv027'];	
			$this->lv028=$vrow['lv028'];
			$this->lv029=$vrow['lv029'];
			$this->lv030=$vrow['lv030'];
			$this->lv031=$vrow['lv031'];
			$this->lv032=$vrow['lv032'];
			$this->lv033=$vrow['lv033'];
			$this->lv034=$vrow['lv034'];
			$this->lv035=$vrow['lv035'];
			$this->lv036=$vrow['lv036'];
			$this->lv037=$vrow['lv037'];
			$this->lv038=$vrow['lv038'];
			$this->lv039=$vrow['lv039'];
			$this->lv040=$vrow['lv040'];
			$this->lv041=$vrow['lv041'];
			$this->lv042=$vrow['lv042'];
			$this->lv043=$vrow['lv043'];
			$this->lv044=$vrow['lv044'];
			$this->lv045=$vrow['lv045'];
			$this->lv046=$vrow['lv046'];
			$this->lv047=$vrow['lv047'];
			$this->lv048=$vrow['lv048'];
			$this->lv048=$vrow['lv048'];
			$this->lv049=$vrow['lv049'];
			$this->lv050=$vrow['lv050'];
			$this->lv051=$vrow['lv051'];
			$this->lv052=$vrow['lv052'];
			$this->lv053=$vrow['lv053'];
			$this->lv054=$vrow['lv054'];
			$this->lv055=$vrow['lv055'];
			$this->lv056=$vrow['lv056'];
			$this->lv057=$vrow['lv057'];
			$this->lv058=$vrow['lv058'];
			$this->lv059=$vrow['lv059'];
			$this->lv060=$vrow['lv060'];
			$this->lv061=$vrow['lv061'];
			$this->lv062=$vrow['lv062'];
			$this->lv063=$vrow['lv063'];
			$this->lv064=$vrow['lv064'];
			$this->lv065=$vrow['lv065'];
			$this->lv066=$vrow['lv066'];
			$this->lv067=$vrow['lv067'];
			$this->lv068=$vrow['lv068'];
			$this->lv069=$vrow['lv069'];
			$this->lv070=$vrow['lv070'];
			$this->lv071=$vrow['lv071'];
			$this->lv072=$vrow['lv072'];
			$this->lv073=$vrow['lv073'];
			$this->lv074=$vrow['lv074'];
			$this->lv075=$vrow['lv075'];
			$this->lv076=$vrow['lv076'];
			$this->lv077=$vrow['lv077'];
			$this->lv078=$vrow['lv078'];
			$this->lv079=$vrow['lv079'];
			$this->lv080=$vrow['lv080'];
			$this->lv081=$vrow['lv081'];
			$this->lv082=$vrow['lv082'];
			$this->lv083=$vrow['lv083'];
			$this->lv084=$vrow['lv084'];
			$this->lv085=$vrow['lv085'];
			$this->lv086=$vrow['lv086'];
			$this->lv087=$vrow['lv087'];
			$this->lv088=$vrow['lv088'];
			$this->lv089=$vrow['lv089'];
			$this->lv090=$vrow['lv090'];
			$this->lv091=$vrow['lv091'];
			$this->lv092=$vrow['lv092'];
			$this->lv093=$vrow['lv093'];

			$this->lv100=$vrow['lv100'];
		}
	}
	function LV_Insert()
	{
		if($this->isAdd==0) return false;
		$lvsql="insert into tc_lv0021 (lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026,lv027,lv028,lv029,lv030,lv031,lv032,lv033,lv034,lv035,lv036,lv037,lv038,lv039,lv040,lv041,lv042,lv043,lv044,lv045,lv046,lv047,lv048,lv049,lv050,lv051,lv052,lv053,lv054,lv055,lv056,lv057,lv058,lv059,lv060,lv061,lv062,lv063,lv064,lv065,lv066,lv067,lv068,lv069,lv070,lv071,lv072,lv073,lv074,lv075,lv076,lv077,lv078,lv079,lv080,lv081,lv082,lv083,lv084,lv085,lv086,lv087,lv088,lv089,lv090,lv091,lv092,lv093,lv098,lv099,lv100) values('$this->lv002','$this->lv003','$this->lv004','$this->lv005','$this->lv006','$this->lv007','$this->lv008','$this->lv009','$this->lv010','$this->lv011','$this->lv012','$this->lv013','$this->lv014','$this->lv015','$this->lv016','$this->lv017','$this->lv018','$this->lv019','$this->lv020','$this->lv021','$this->lv022','$this->lv023','$this->lv024','$this->lv025','$this->lv026','$this->lv027','$this->lv028','$this->lv029','$this->lv030','$this->lv031','$this->lv032','$this->lv033','$this->lv034','$this->lv035','$this->lv036','$this->lv037','$this->lv038','$this->lv039','$this->lv040','$this->lv041','$this->lv042','$this->lv043','$this->lv044','$this->lv045','$this->lv046','$this->lv047','$this->lv048','$this->lv049','$this->lv050','$this->lv051','$this->lv052','$this->lv053','$this->lv054','$this->lv055','$this->lv056','$this->lv057','$this->lv058','$this->lv059','$this->lv060','$this->lv061','$this->lv062','$this->lv063','$this->lv064','$this->lv065','$this->lv066','$this->lv067','$this->lv068','$this->lv069','$this->lv070','$this->lv071','$this->lv072','$this->lv073','$this->lv074','$this->lv075','$this->lv076','$this->lv077','$this->lv078','$this->lv079','$this->lv080','$this->lv081','$this->lv082','$this->lv083','$this->lv084','$this->lv085','$this->lv086','$this->lv087','$this->lv088','$this->lv089','$this->lv090','$this->lv091','$this->lv092','$this->lv093','$this->lv098','$this->lv099','$this->lv100')";
		$vReturn= db_query($lvsql);
		if($vReturn) {
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0021.insert',sof_escape_string($lvsql));
		$this->LV_InsertOther($this->lv001,$this->lv011);
		}
		return $vReturn;
	}	
	function LV_InsertOther($lv002,$vlv0022)
	{
		
		if($this->isAdd==0) return false;
		$lvsql="insert into tc_lv0014 (lv002,lv003,lv004) select '$lv002',lv003,lv004 from tc_lv0014 where lv002='$vlv0022'";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0014.insert',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Update()
	{
		$lvsql="Update tc_lv0021 set lv002='$this->lv002',lv003='$this->lv003',lv004='$this->lv004',lv005='$this->lv005',lv006='$this->lv006',lv007='$this->lv007',lv008='$this->lv008',lv009='$this->lv009',lv010='$this->lv010',lv011='$this->lv011',lv012='$this->lv012',lv013='$this->lv013',lv014='$this->lv014',lv015='$this->lv015',lv016='$this->lv016',lv017='$this->lv017',lv018='$this->lv018',lv019='$this->lv019',lv020='$this->lv020',lv021='$this->lv021',lv022='$this->lv022',lv023='$this->lv023',lv024='$this->lv024',lv025='$this->lv025',lv026='$this->lv026',lv027='$this->lv027' ,lv028='$this->lv028',lv029='$this->lv029',lv030='$this->lv030',lv031='$this->lv031',lv032='$this->lv032',lv033='$this->lv033',lv034='$this->lv034',lv035='$this->lv035',lv036='$this->lv036',lv037='$this->lv037',lv038='$this->lv038',lv039='$this->lv039',lv040='$this->lv040',lv041='$this->lv041',lv042='$this->lv042',lv043='$this->lv043',lv044='$this->lv044',lv045='$this->lv045',lv046='$this->lv046',lv047='$this->lv047',lv048='$this->lv048',lv049='$this->lv049',lv050='$this->lv050',lv051='$this->lv051',lv052='$this->lv052',lv053='$this->lv053',lv054='$this->lv054',lv055='$this->lv055',lv056='$this->lv056',lv057='$this->lv057',lv058='$this->lv058',lv059='$this->lv059',lv060='$this->lv060',lv061='$this->lv061',lv062='$this->lv062',lv063='$this->lv063',lv064='$this->lv064',lv065='$this->lv065',lv066='$this->lv066',lv067='$this->lv067',lv068='$this->lv068',lv069='$this->lv069',lv070='$this->lv070',lv071='$this->lv071',lv072='$this->lv072',lv073='$this->lv073',lv074='$this->lv074',lv075='$this->lv075',lv076='$this->lv076',lv077='$this->lv077',lv078='$this->lv078',lv079='$this->lv079',lv080='$this->lv080',lv081='$this->lv081',lv082='$this->lv082',lv083='$this->lv083',lv084='$this->lv084',lv085='$this->lv085',lv086='$this->lv086',lv087='$this->lv087',lv088='$this->lv088',lv089='$this->lv089',lv090='$this->lv090',lv091='$this->lv091',lv092='$this->lv092',lv093='$this->lv093',lv098='$this->lv098',lv099='$this->lv099',lv100='$this->lv100' where  lv001='$this->lv001' AND lv063<=0;";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.update',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_Delete($lvarr)
	{
		if($this->isDel==0) return false;
		$lvsql = "DELETE FROM tc_lv0021  WHERE tc_lv0021.lv063<=0 AND tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.delete',sof_escape_string($lvsql));
		return $vReturn;
	}	
	function LV_Aproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0021 set lv063=1  WHERE tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			//$this->LV_SendMailAll($lvarr);
		$this->InsertLogOperation($this->DateCurrent,'tc_lv0021.approval',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_SendSalaryPayroll($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0021 set lv063=1  WHERE tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) 
		{
			$this->LV_SendMailAll($lvarr);
			$this->InsertLogOperation($this->DateCurrent,'tc_lv0021.approval',sof_escape_string($lvsql));
		}
		return $vReturn;
	}	
	function LV_UnAproval($lvarr)
	{
		if($this->isApr==0) return false;
		$lvsql = "Update tc_lv0021 set lv063=0  WHERE tc_lv0021.lv001 IN ($lvarr)  ";
		$vReturn= db_query($lvsql);
		if($vReturn) $this->InsertLogOperation($this->DateCurrent,'tc_lv0021.unapproval',sof_escape_string($lvsql));
		return $vReturn;
	}
	function LV_SendMailAll($lvarr)
	{
		$lvsql="select A.lv001,A.lv002,A.lv060 from tc_lv0021 A where A.lv001 in($lvarr)";
		$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
		$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
		$vReturn= db_query($lvsql);
		while ($vrow = db_fetch_array ($vReturn)){
				$str = "";
		$motc_lv0013->LV_LoadID($vrow['lv060']);
		$mohr_lv0020->LV_LoadID($vrow['lv002']);
		$lvtitle=$mohr_lv0020->lv001." - ".'PHIẾU LƯƠNG THÁNG '.$motc_lv0013->lv006. ' NĂM '.$motc_lv0013->lv007;
		$lvemail="newsletter@tdl-mep.vn";
		$vTo="";
		if($mohr_lv0020->lv040!="" && $mohr_lv0020->lv041!="")	
		{
			$vTo=$mohr_lv0020->lv040.",".$mohr_lv0020->lv041;
		}
		else
		{
			if($mohr_lv0020->lv040!="")	$vTo=$mohr_lv0020->lv040;
			if($mohr_lv0020->lv041!="")	$vTo=$mohr_lv0020->lv041;
		}
		$lvcontent=$this->LV_GetOnePerson($vrow['lv001']);
		$lvuser=$_SESSION['ERPSOFV2RUserID'];
		if($vTo!="")
			$this->LV_SendMail($lvcontent,$lvtitle,$lvuser,$lvemail,$vTo,$vrow['lv001']);
		else
			echo 'Email ['.$vrow['lv002'].'] không có'; 
			
		}
	}	
	function LV_SendMail($lvcontent,$lvtitle,$lvuser,$lvemail,$vTo,$vID='')
	{
		$lvListId_del="";
		$lvml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
		$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');		
		$lvml_lv0009=new ml_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0009');
		$lvml_lv0009->LV_LoadSMTP();
		$lvml_lv0008->LV_LoadUser($lvuser,$lvemail);
			$this->Domain=$lvml_lv0009->lv010;
			$vstrTo=SplitTo(str_replace(";",",",str_replace(" ","",$vTo)),"<",">",",");
			$vstrToSend=$this->SplitToEsc($vstrTo,",",0);
			$lvml_lv0100=new ml_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0100');
			$lvml_lv0100->To(explode(",",$vstrToSend));		
			if($lvml_lv0008->lv005==1)
			{
					if($this->isSendPDF)
					{
						$myfile = fopen("../tc_lv0020/payroll.pdf", "w");// or die("Unable to open file!");
						$vXMLFile = file_get_contents($_SERVER['SERVER_NAME'].'/soft/pdf/?ID='.$vID);
						fwrite($myfile, $vXMLFile);
						fclose($myfile);
						$lvml_lv0100->Attach("../tc_lv0020/payroll.pdf",'payroll.pdf','','attachment');
					}
					$lvml_lv0100->lvml_lv0009=$lvml_lv0009;
					$lvml_lv0100->lvml_lv0008=$lvml_lv0008;
					$lvml_lv0100->To(explode(",",$vstrToSend));
					$lvml_lv0100->From($lvemail);
					$lvml_lv0100->Subject($lvtitle);
					$lvml_lv0100->Priority(3);	
					$lvml_lv0100->Content_type("multipart/related");
					$lvml_lv0100->charset="utf-8";
					$lvml_lv0100->ctencoding="quoted-printable";
					$lvml_lv0100->Cc(explode(",",$vstrCCSend));
					$lvml_lv0100->Bcc(explode(",",$vstrBCCSend));
					$lvml_lv0100->Body($lvcontent,'');
					$lvml_lv0100->Content_type('text/html');
					if($lvml_lv0100->Send())
					//if(1==1)
					{
						echo 'Thành công gửi! Email:'.$vTo."<br/>";
					}
					else	
						echo 'Không thành công gửi! Email:'.$vTo."<br/>";

			}
			else	
						echo 'Không thành công gửi! Email:'.$vTo."<br/>";

		return $vReturn;
	}
	function SplitToEsc($vAddress,$vPara1,$vopt)
	{
		$strTemp=$vAddress;
		$vArrTemp=explode($vPara1,$strTemp);
		$strReturn="";
		if(count($vArrTemp)==0) return $vAddress;
		for($i=0;$i<count($vArrTemp);$i++)
		{
			if($vopt==1)
			{
				if (!(strpos($vArrTemp[$i],"@11111111".$this->Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			}
			else
			{
				if ((strpos($vArrTemp[$i],"@11111".$this->Domain)===false))
				{
					if($strReturn!="")
						$strReturn=$strReturn.$vPara1.trim($vArrTemp[$i]);
					else
						$strReturn=$strReturn.trim($vArrTemp[$i]);			
				}		
			
			}
		}
		return $strReturn;
	}
	function LV_CheckReNew($vEmployeeID,$motc_lv0013)
	{
		$vArray=Array();
		$vValue=$this->LV_GetAmountTypeCalID($vEmployeeID,$motc_lv0013->lv001,1,'lv012');
		$vValue1=$this->LV_GetAmountTypeCalID($vEmployeeID,$motc_lv0013->lv001,0,'lv012');
		if($vValue!=0 && $vValue!=NULL) 
		{
			$vArray[1]=$vValue1;
			$vArray[2]=$vValue;
			if($vValue1==$vValue)
				$vArray[0]=false;
			else
				$vArray[0]=true;
		}
		else
		{
			$vPreCalID=$motc_lv0013->LV_LoadPreMonth($motc_lv0013->lv006,$motc_lv0013->lv007);
			$vValue=$this->LV_GetAmountTypeCalID($vEmployeeID,$vPreCalID,0,'lv012');
			$vArray[1]=$vValue1;
			$vArray[2]=$vValue;
			if($vValue1==$vValue || ($vValue==0))
				$vArray[0]=false;
			else
				$vArray[0]=true;
		}
		return $vArray;
	}
	function LV_GetNoteCongKhac($vEmpID,$vCalID,$vCode="'CONGKHAC','ALLOWANCE'")
	{
		$strReturn="";
		$lvsql="select lv007 from  tc_lv0017 Where lv002='$vEmpID' and lv003='$vCalID' and lv004 in ($vCode)";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$strReturn=$strReturn.((trim($strReturn).''=='')?'':',').$vrow['lv007'];
		}
		return $strReturn;
	}
	function LV_GetNoteTruKhac($vEmpID,$vCalID,$vCode="'OTHER-DED','TAMUNG'")
	{
		$strReturn="";
		$lvsql="select lv007 from  tc_lv0023 Where lv002='$vEmpID' and lv003='$vCalID' and lv004 in ($vCode)";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			$strReturn=$strReturn.((trim($strReturn).''=='')?'':',').$vrow['lv007'];
		}
		return $strReturn;
	}
	function LV_GetOnePerson($vlv001)
	{
	$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
	$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
	$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
	$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
	$motc_lv0020->LV_LoadID($vlv001);
	$motc_lv0013->LV_LoadID($motc_lv0020->lv060);
	$vArrCheck=$this->LV_CheckReNew($motc_lv0020->lv002,$motc_lv0013);
	$mohr_lv0020->LV_LoadID($motc_lv0020->lv002);
	//$mohr_lv0038->LV_LoadID($motc_lv0020->lv033);
	//$vPBCha=$mohr_lv0020->LV_GetPBLon($mohr_lv0020->lv029);
	//$vFNUsed=$motc_lv0008->LV_CheckOne_FNCB($motc_lv0020->lv002,$motc_lv0013->lv007,0);
	//$vFNMonth=$motc_lv0009->LV_FNLoadMonthID($motc_lv0020->lv002,$motc_lv0013->lv006,$motc_lv0013->lv007);
	$vstrRetrun='';
		$vstrRetrun=$vstrRetrun.'
		<div style="float:left;width:489px;border:0px #c3c3c3 solid;padding-right:20px;padding-bottom:10px">
	<div style="width:489px;border:1px #c3c3c3 solid;">
<table style="width: 489px;" border="1" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td rowspan="2" width="189">
<p><img src="../../'.(($vPBCha=='TECH')?'logotech.png':'logo.png').'" height="38"/></p>
</td>
<td colspan="2" rowspan="2" width="231">
<p align="center"><strong>PHIẾU LƯƠNG TH&Aacute;NG </strong></p>
</td>
<td rowspan="2" width="113">
<p align="center"><strong>'.getmonth($motc_lv0020->lv005).'</strong><strong>/'.getyear($motc_lv0020->lv005).'</strong></p>
</td>
</tr>
<tr>
</tr>
<tr>
<td width="189">
<p><strong>Họ t&ecirc;n</strong><strong></strong></p>
</td>
<td colspan="3" width="344">
<p align="center"><strong>'.$mohr_lv0020->lv002.'</strong><strong> (</strong><strong>'.$mohr_lv0020->lv005.'</strong><strong>)</strong></p>
</td>
</tr>
<tr>
<td width="189">
<p><strong>M&atilde; số</strong></p>
</td>
<td width="65">
<p align="right"><strong>'.$mohr_lv0020->lv101.'</strong><strong></strong></p>
</td>
<td width="166">
<p>Mức lương thực tế</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv078,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>NC chuẩn</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv012,20).'</p>
</td>
<td width="166">
<p>Mức lương&nbsp; căn bản</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv008,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>NC thực tế</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv025,20).'</p>
</td>
<td width="166">
<p>Lương thực tế</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv024,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>NC c&ocirc;ng tr&igrave;nh</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv014,20).'</p>
</td>
<td width="166">
<p>Phụ cấp c&ocirc;ng tr&igrave;nh</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv076,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>NC vượt ĐM</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv026,20).'</p>
</td>
<td width="166">
<p>Lương vượt định mức</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv029,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>NC Lễ/Tết/Ph&eacute;p</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv018,20).'</p>
</td>
<td width="166">
<p>Lương Lễ/Tết/Ph&eacute;p</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv023,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>C&ocirc;ng (300%) (Giờ)</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv017,20).'</p>
</td>
<td width="166">
<p>Lương C&ocirc;ng (300%)</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv022,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>C&ocirc;ng ngo&agrave;i giờ (200%) (giờ)</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv016,20).'</p>
</td>
<td width="166">
<p>Lương ngo&agrave;i giờ (200%)</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv021,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>C&ocirc;ng ngo&agrave;i giờ (150%) (giờ)</p>
</td>
<td width="65">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv015,20).'</p>
</td>
<td width="166">
<p>Lương ngo&agrave;i giờ (150%)</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv020,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>Tiền Cơm&nbsp;</p>
</td>
<td width="65">
<p align="right"><strong>'.$motc_lv0020->FormatView($motc_lv0020->lv052,20).'</strong></p>
</td>
<td width="166">
<p>Tiền cơm tăng ca</p>
</td>
<td width="113">
<p align="right"><strong>'.$motc_lv0020->FormatView($motc_lv0020->lv092,20).'</strong></p>
</td>
</tr>
<tr>
<td width="189">
<p>Thưởng ABC</p>
</td>
<td width="65">
<p align="right"><strong>&nbsp;</strong></p>
</td>
<td width="166">
<p>&nbsp;</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv051,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>PC Trách Nhiệm</p>
</td>
<td width="65">
<p align="right"><strong>&nbsp;</strong></p>
</td>
<td width="166">
<p>&nbsp;</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv075,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>Cộng kh&aacute;c</p>
</td>
<td width="65">
<p align="right"><strong>&nbsp;</strong></p>
</td>
<td width="166">
<p>'.$this->LV_GetNoteCongKhac($motc_lv0020->lv002,$motc_lv0020->lv060).'</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv077+$motc_lv0020->lv031,20).'</p>
</td>
</tr>
<tr>
<td colspan="3" width="420">
<p><strong>TỔNG LƯƠNG (1)</strong></p>
</td>
<td width="113">
<p align="right"><strong>'.$motc_lv0020->FormatView($motc_lv0020->lv033,20).'</strong><strong></strong></p>
</td>
</tr>
<tr>
<td colspan="3" width="420">
<p>Trừ thuế thu nhập c&aacute; nh&acirc;n</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv045,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>Trừ BHXH+YT+TN</p>
</td>
<td width="65">
<p align="right"><strong>&nbsp;</strong></p>
</td>
<td width="166">
<p>&nbsp;</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv043,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>Tạm ứng :&nbsp;</p>
</td>
<td width="65">
<p align="right">&nbsp;</p>
</td>
<td width="166">
<p>'.$this->LV_GetNoteTruKhac($motc_lv0020->lv002,$motc_lv0020->lv060,"'TAMUNG'").'</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv027,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p>Trừ kh&aacute;c:</p>
</td>
<td width="65">
<p align="right">&nbsp;</p>
</td>
<td width="166">
<p>'.$this->LV_GetNoteTruKhac($motc_lv0020->lv002,$motc_lv0020->lv060,"'OTHER-DED'").'</p>
</td>
<td width="113">
<p align="right">'.$motc_lv0020->FormatView($motc_lv0020->lv046,20).'</p>
</td>
</tr>
<tr>
<td width="189">
<p><strong>TỔNG TRỪ (2)</strong></p>
</td>
<td width="65">
<p align="right"><strong>&nbsp;</strong></p>
</td>
<td width="166">
<p><strong>&nbsp;</strong></p>
</td>
<td width="113">
<p align="right"><strong>'.$motc_lv0020->FormatView($motc_lv0020->lv048,20).'</strong><strong></strong></p>
</td>
</tr>
<tr>
<td colspan="2" width="254">
<p align="center"><strong>THỰC NHẬN (1) &ndash; (2)</strong></p>
</td>
<td colspan="2" width="279">
<p align="center"><strong>'.$motc_lv0020->FormatView($motc_lv0020->lv050,20).'</strong><strong></strong></p>
</td>
</tr>
</tbody>
</table>
	</div>
	</div>
	
';
		return $vstrRetrun;
	}
	function LV_GetOnePerson1($vlv001)
	{
	$motc_lv0013=new tc_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0013');
	$mohr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0020');
	$mohr_lv0038=new hr_lv0038($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0038');
	$motc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0020');
	$motc_lv0008=new tc_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0008');
	$motc_lv0009=new tc_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0009');
	$motc_lv0020->LV_LoadID($vlv001);
	$motc_lv0013->LV_LoadID($motc_lv0020->lv060);
	$mohr_lv0020->LV_LoadID($motc_lv0020->lv002);
	$mohr_lv0038->LV_LoadID($motc_lv0020->lv033);
	$vFNUsed=$motc_lv0008->LV_CheckOne_FNCB($motc_lv0020->lv002,$motc_lv0013->lv007,0);
	$vFNMonth=$motc_lv0009->LV_FNLoadMonthID($motc_lv0020->lv002,$motc_lv0013->lv006,$motc_lv0013->lv007);
	$vstrRetrun='';
		$vstrRetrun=$vstrRetrun.'
<table cellpadding="0" cellspacing="0" border="1" width="760">
<tr>
  <td width="14%">HỌ TÊN/FULL NAME </td>
  <td width="32%">'.($mohr_lv0020->lv004." ".$mohr_lv0020->lv003." ".$mohr_lv0020->lv002).'</td>
  <td width="15%">MÃ NV/ EMP.CODE </td>
  <td width="23%">'.($mohr_lv0020->lv001).'</td>
  </tr>
<tr>
 
  <td>LƯƠNG CƠ BẢN/BASIC </td>
  <td>'.($motc_lv0020->FormatView($motc_lv0020->lv006,10)).'</td>
   <td>Bộ phận/ Section </td>
  <td>'.($mohr_lv0020->getvaluelink('lv029',$mohr_lv0020->lv029)).'</td>
  </tr>
</table>
<br/>
<table cellpadding="0" cellspacing="0" border="1" width="760">  
<tr>
  <td width="20%">Ngày làm việc/ working day </td>
  <td>'.($motc_lv0013->FormatView($motc_lv0020->lv018,10)).'</td>
  <td width="20%">Phép năm/ Annual leave  </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv016,10)).'</td>
  <td width="20%">Không lương/ Ul </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv020,10)).'</td>
  </tr>
 <tr>
  <td>Ngày lễ và nghỉ bù/ compensation leave </td>
  <td>'.($motc_lv0013->FormatView($motc_lv0020->lv015,10)).'</td>
  <td>Bệnh/Medical leave   </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv016,10)).'</td>
  <td>Làm vào ngày lễ/ PH  </td>
  <td>'.($mohr_lv0020->FormatView($motc_lv0020->lv026,10)).'</td>
  </tr>
</table>
<br/>
';
	$vSumAdd=0;
	$vSumSub=0;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv035;
	$vSumSub=$vSumSub+$motc_lv0020->lv062;
	$vSumSub=$vSumSub+$motc_lv0020->lv063;
	
	$vSumAdd=$vSumAdd+$motc_lv0020->lv040;
	
	$vSumAdd=$vSumAdd+$motc_lv0020->lv037;
	
	$vSumAdd=$vSumAdd+$motc_lv0020->lv038;
	$vSumSub=$vSumSub+$motc_lv0020->lv068;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv039;;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv047;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv048;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv049;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv050;
	if($mohr_lv0038->lv019==1)
	{
		$vSumSub=$vSumSub+$motc_lv0020->lv064;
		$vSumSub=$vSumSub+$motc_lv0020->lv065;
		$vSumSub=$vSumSub+$motc_lv0020->lv066;
		$vSumSub=$vSumSub+$motc_lv0020->lv067;
	}
	else
	{
		$vSumSub=$vSumSub+$motc_lv0020->lv072;
		$vSumSub=$vSumSub+$motc_lv0020->lv073;
		$vSumSub=$vSumSub+$motc_lv0020->lv074;
		$vSumSub=$vSumSub+$motc_lv0020->lv088;
	}
	$vMeal=$motc_lv0020->LV_GetPriceProduct($motc_lv0020->lv060,'Meal');
	if($vMeal==0) $vMeal=1;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv041;;
	$vTransport=$motc_lv0020->LV_GetPriceProduct($motc_lv0020->lv060,'Transport');
	if($vTransport==0) $vTransport=1;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv042;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv044;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv043;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv045;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv056;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv060;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv046;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv051;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv057;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv031;
	$vSumAdd=$vSumAdd+$motc_lv0020->lv036;
			
$vstrRetrun=$vstrRetrun.'
<table cellpadding="0" cellspacing="0" border="1" width="760">
	<colgroup>
		<col width="187" />
		<col width="109" />
		<col width="105" />
		<col width="108" />
		<col width="121" />
		<col width="135" />
		<col width="84" /></colgroup>
	<tbody>
		<tr height="36">
			<td height="36" width="187">Các khoản thu nhập/ Incomes&nbsp;</td>
			<td width="109">Số <br />
				Ngày/giờ&nbsp;</td>
			<td width="105">Số tiền&nbsp;</td>
			<td colspan="2" width="229">Các khoản giảm trừ/ Deductions&nbsp;</td>
			<td colspan="2" width="219">Phép năm T1/2014&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Ngày làm việc</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv018,10)).'</td>
			<td align="right">'.$motc_lv0013->FormatView($motc_lv0020->lv035,10).'</td>
			<td>Tạm ứng</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv062,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Lương điều chỉnh&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>Tạm ứng riêng</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv063,10)).'</td>
			<td>Phép năm đã sử dụng trong năm&nbsp;</td>
			<td>'.($motc_lv0008->FormatView($motc_lv0008->lv003-$vFNUsed,10)).'</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca Ngày thường 150%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv022,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv036,10)).'</td>
			<td>BHXH</td>
			<td align="right">'.($motc_lv0013->FormatView((($mohr_lv0038->lv019==1)?$motc_lv0020->lv064:$motc_lv0020->lv072),10)).'</td>
			<td>Phép năm nghỉ trong tháng</td>
			<td>'.($motc_lv0008->FormatView($vFNMonth,10)).'</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca Ngày nghỉ lễ 300%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv026,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv040,10)).'</td>
			<td>BHYT&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView((($mohr_lv0038->lv019==1)?$motc_lv0020->lv065:$motc_lv0020->lv073),10)).'</td>
			<td>Phép năm còn lại&nbsp;</td>
			<td>'.($motc_lv0008->FormatView($vFNUsed,10)).'</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca (Chủ nhật) 200%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv023,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv037,10)).'</td>
			<td>BHTN</td>
			<td align="right">'.($motc_lv0013->FormatView((($mohr_lv0038->lv019==1)?$motc_lv0020->lv066:$motc_lv0020->lv074),10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca&nbsp; ca đêm (195%)</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv024,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv038,10)).'</td>
			<td>Đoàn phí CĐ&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv068,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Tăng ca đêm của CN 260%</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv025,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv039,10)).'</td>
			<td>Thuế TNCN</td>
			<td align="right">'.($motc_lv0013->FormatView((($mohr_lv0038->lv019==1)?$motc_lv0020->lv067:$motc_lv0020->lv088),10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp trượt giá&nbsp;</td>
			<td align="center"> - </td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv047,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp vận hànhnh&nbsp;</td>
			<td align="center"> - </td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv048,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp chức vụ</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv049,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp quản lý&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv050,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp cơm</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv041/$vMeal,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv041,10)).'</td>
			<td>Khác&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp xăng</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv042/$vTransport,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv042,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp phòng trộn</td>
			<td align="center">-</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv044,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp ca đêm</td>
			<td align="center">'.($motc_lv0013->FormatView($motc_lv0020->lv019,10)).'</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv043,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Trợ cấp thôi việc</td>
			<td>&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Hoàn trả</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv057,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Chuyên cần</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv045,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Lucky Money</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv031,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Bốc xếp</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv056,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Lương tháng 13</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv060,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	';
		switch($motc_lv0020->lv095)
		{	
			case 2:
		$vstrRetrun=$vstrRetrun.'
		<tr height="19">
			<td height="19">Trợ cấp OT (QC)&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv046,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		';
				break;
			case 3:
		$vstrRetrun=$vstrRetrun.'
		<tr height="19">
			<td height="19">SPI & Commission </td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($motc_lv0020->lv051,10)).'</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		';
			
		}
$vstrRetrun=$vstrRetrun.'		
		<tr height="26">
			<td height="26">Tổng cộng/ Total</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($vSumAdd,10)).'</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($vSumSub,10)).'</td>
			<td colspan="2" rowspan="3" width="219">Cảm ơn sự nỗ lực và hợp tác của <br />
				Các bạn trong thời gian qua&nbsp;</td>
		</tr>
		<tr height="23">
			<td height="23">Thực nhận còn lại/ Remaining&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'.($motc_lv0013->FormatView($vSumAdd-$vSumSub,10)).'</td>
		</tr>
	</tbody>
</table>
<br/>
<table cellpadding="0" cellspacing="0" border="0" width="760">
	<colgroup>
		<col width="187" />
		<col width="109" />
		<col width="105" />
		<col width="108" />
		<col width="121" />
		<col width="135" />
		<col width="84" /></colgroup>
	<tbody>
		<tr height="19">
			<td height="19" width="187">Prepared by</td>
			<td width="109">HR Dept</td>
			<td width="121">&nbsp;</td>
		</tr>
		<tr height="19">
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr height="19">
			<td height="19">Remarks :</td>
			<td colspan="5">Salary period from';
			$motc_lv0020->lang="EN"; 
		$vstrRetrun=$vstrRetrun.$motc_lv0020->FormatView($motc_lv0020->lv004,2).' till '.($motc_lv0020->FormatView($motc_lv0020->lv005,2)).' / Lương được tính từ';
		$motc_lv0020->lang="VN"; 
		$vstrRetrun=$vstrRetrun.$motc_lv0020->FormatView($motc_lv0020->lv004,2).'  đến '.($motc_lv0020->FormatView($motc_lv0020->lv005,2)).'</td>
		</tr>
	</tbody>
</table>
  ';
	return $vstrRetrun;
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
		if($this->lv002!="") $strCondi=$strCondi." and lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and lv011  like '%$this->lv011%'";
		if($this->lv012!="") $strCondi=$strCondi." and lv012  like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and lv013  like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and lv014  like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and lv015  like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and lv016  like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and lv017  like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and lv018  like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and lv019  like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and lv020  like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and lv021  like '%$this->lv021%'";
		if($this->lv022!="") $strCondi=$strCondi." and lv022  like '%$this->lv022%'";
		if($this->lv023!="") $strCondi=$strCondi." and lv023  like '%$this->lv023%'";
		if($this->lv024!="") $strCondi=$strCondi." and lv024  like '%$this->lv024%'";
		if($this->lv025!="") $strCondi=$strCondi." and lv025  like '%$this->lv025%'";
		if($this->lv026!="") $strCondi=$strCondi." and lv026  like '%$this->lv026%'";
		if($this->lv027!="") $strCondi=$strCondi." and lv027  like '%$this->lv027%'";
		if($this->lv028!="") $strCondi=$strCondi." and lv028  like '%$this->lv028%'";
		if($this->lv029!="") $strCondi=$strCondi." and lv029  like '%$this->lv029%'";
		if($this->lv030!="") $strCondi=$strCondi." and lv030  like '%$this->lv030%'";
		if($this->lv031!="") $strCondi=$strCondi." and lv031  like '%$this->lv031%'";
		if($this->lv032!="") $strCondi=$strCondi." and lv032  like '%$this->lv032%'";
		if($this->lv033!="") $strCondi=$strCondi." and lv033  like '%$this->lv033%'";
		if($this->lv034!="") $strCondi=$strCondi." and lv034  like '%$this->lv034%'";
		if($this->lv035!="") $strCondi=$strCondi." and lv035  like '%$this->lv035%'";
		if($this->lv053!="") $strCondi=$strCondi." and lv053  like '%$this->lv053%'";
		if($this->lv060!="") $strCondi=$strCondi." and lv060  = '$this->lv060'";
		if($this->lv058_!="")  
		{
			$strCondi=$strCondi." and lv058 in (".$this->LV_GetDepFull($this->lv058_).")";
		}
		return $strCondi;
	}
	protected function GetConditionFixed()
	{
		$strCondi="";
		
		if($this->lv058_!="")  
		{
			$strCondi=$strCondi." and lv058 in (".$this->LV_GetDepFull($this->lv058_).")";
		}
		return $strCondi;
	}
	//////////Get Filter///////////////
	protected function GetConditionOther()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and A.lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and A.lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and A.lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and A.lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and A.lv011  like '%$this->lv011%'";
		if($this->lv012!="") $strCondi=$strCondi." and A.lv012  like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and A.lv013  like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and A.lv014  like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and A.lv015  like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and A.lv016  like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and A.lv017  like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and A.lv018  like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and A.lv019  like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and A.lv020  like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and A.lv021  like '%$this->lv021%'";
		if($this->lv022!="") $strCondi=$strCondi." and A.lv022  like '%$this->lv022%'";
		if($this->lv023!="") $strCondi=$strCondi." and A.lv023  like '%$this->lv023%'";
		if($this->lv024!="") $strCondi=$strCondi." and A.lv024  like '%$this->lv024%'";
		if($this->lv025!="") $strCondi=$strCondi." and A.lv025  like '%$this->lv025%'";
		if($this->lv026!="") $strCondi=$strCondi." and A.lv026  like '%$this->lv026%'";
		if($this->lv027!="") $strCondi=$strCondi." and A.lv027  like '%$this->lv027%'";
		if($this->lv028!="") $strCondi=$strCondi." and A.lv028  like '%$this->lv028%'";
		if($this->lv029!="") $strCondi=$strCondi." and A.lv029  like '%$this->lv029%'";
		if($this->lv030!="") $strCondi=$strCondi." and A.lv030  like '%$this->lv030%'";
		if($this->lv031!="") $strCondi=$strCondi." and A.lv031  like '%$this->lv031%'";
		if($this->lv032!="") $strCondi=$strCondi." and A.lv032  like '%$this->lv032%'";
		if($this->lv033!="") $strCondi=$strCondi." and A.lv033  like '%$this->lv033%'";
		if($this->lv034!="") $strCondi=$strCondi." and A.lv034  like '%$this->lv034%'";
		if($this->lv035!="") $strCondi=$strCondi." and A.lv035  like '%$this->lv035%'";
		if($this->lv053!="") $strCondi=$strCondi." and A.lv053  like '%$this->lv053%'";
		if($this->lv060!="") $strCondi=$strCondi." and A.lv060  = '$this->lv060'";
		switch($this->Bank)
		{
			case 2:
				$strCondi=$strCondi." and (trim(A.lv061) = '' or ISNULL(A.lv061))";
				break;
			case 1:
				$strCondi=$strCondi." and (trim(A.lv061) <> '')";
				break;
		}
		if($this->lv201!="") $strCondi=$strCondi." and (A.lv002 in (select B.lv001 from hr_lv0020 B where B.lv029 in (".$this->LV_GetDep($this->lv201).")	))";
		if($this->lv202!="") $strCondi=$strCondi." and (A.lv002 in (select B.lv001 from hr_lv0020 B where B.lv029 in (".$this->LV_GetDep($this->lv202).")	))";
		if($this->lv839!="")
		{
			$strCondi=$strCondi." and (A.lv056 in (".$this->LV_GetHDLD($this->lv839).")	)";
		}
		if($this->lv058_!="")  
		{
			$strCondi=$strCondi." and A.lv058 in (".$this->LV_GetDepFull($this->lv058_).")";
		}
		return $strCondi;
	}
	protected function GetConditionOtherlevel1()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and A.lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and A.lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and A.lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and A.lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and A.lv011  like '%$this->lv011%'";
		if($this->lv012!="") $strCondi=$strCondi." and A.lv012  like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and A.lv013  like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and A.lv014  like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and A.lv015  like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and A.lv016  like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and A.lv017  like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and A.lv018  like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and A.lv019  like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and A.lv020  like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and A.lv021  like '%$this->lv021%'";
		if($this->lv022!="") $strCondi=$strCondi." and A.lv022  like '%$this->lv022%'";
		if($this->lv023!="") $strCondi=$strCondi." and A.lv023  like '%$this->lv023%'";
		if($this->lv024!="") $strCondi=$strCondi." and A.lv024  like '%$this->lv024%'";
		if($this->lv025!="") $strCondi=$strCondi." and A.lv025  like '%$this->lv025%'";
		if($this->lv026!="") $strCondi=$strCondi." and A.lv026  like '%$this->lv026%'";
		if($this->lv027!="") $strCondi=$strCondi." and A.lv027  like '%$this->lv027%'";
		if($this->lv028!="") $strCondi=$strCondi." and A.lv028  like '%$this->lv028%'";
		if($this->lv029!="") $strCondi=$strCondi." and A.lv029  like '%$this->lv029%'";
		if($this->lv030!="") $strCondi=$strCondi." and A.lv030  like '%$this->lv030%'";
		if($this->lv031!="") $strCondi=$strCondi." and A.lv031  like '%$this->lv031%'";
		if($this->lv032!="") $strCondi=$strCondi." and A.lv032  like '%$this->lv032%'";
		if($this->lv033!="") $strCondi=$strCondi." and A.lv033  like '%$this->lv033%'";
		if($this->lv034!="") $strCondi=$strCondi." and A.lv034  like '%$this->lv034%'";
		if($this->lv035!="") $strCondi=$strCondi." and A.lv035  like '%$this->lv035%'";
		if($this->lv053!="") $strCondi=$strCondi." and A.lv053  like '%$this->lv053%'";
		if($this->lv060!="") $strCondi=$strCondi." and A.lv060  = '$this->lv060'";
		switch($this->isViet)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and B.lv022='VIETNAM'";
				break;
			case 2:
				$strCondi=$strCondi." and B.lv022<>'VIETNAM'";
				break;
		}
		switch($this->isNghi)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and (month(B.lv044)='".$this->CalMonth."' and year(B.lv044)='".$this->CalYear."')";
				break;
			case 2:
				$strCondi=$strCondi." and (month(B.lv044)<>'".$this->CalMonth."' and year(B.lv044)<>'".$this->CalYear."')";
				break;
		}
		switch($this->Bank)
		{
			case 2:
				$strCondi=$strCondi." and (trim(A.lv061) = '' or ISNULL(A.lv061))";
				break;
			case 1:
				$strCondi=$strCondi." and (trim(A.lv061) <> '')";
				break;
		}
		return $strCondi;
	}
	protected function GetConditionOtherCal()
	{
		$strCondi="";
		if($this->lv001!="") $strCondi=$strCondi." and A.lv001  like '%$this->lv001%'";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		if($this->lv003!="") $strCondi=$strCondi." and A.lv003  like '%$this->lv003%'";
		if($this->lv004!="") $strCondi=$strCondi." and A.lv004  like '%$this->lv004%'";
		if($this->lv005!="") $strCondi=$strCondi." and A.lv005  like '%$this->lv005%'";
		if($this->lv006!="") $strCondi=$strCondi." and A.lv006  like '%$this->lv006%'";
		if($this->lv007!="") $strCondi=$strCondi." and A.lv007  like '%$this->lv007%'";
		if($this->lv008!="") $strCondi=$strCondi." and A.lv008  like '%$this->lv008%'";
		if($this->lv009!="") $strCondi=$strCondi." and A.lv009  like '%$this->lv009%'";
		if($this->lv010!="") $strCondi=$strCondi." and A.lv010  like '%$this->lv010%'";
		if($this->lv011!="") $strCondi=$strCondi." and A.lv011  like '%$this->lv011%'";
		if($this->lv012!="") $strCondi=$strCondi." and A.lv012  like '%$this->lv012%'";
		if($this->lv013!="") $strCondi=$strCondi." and A.lv013  like '%$this->lv013%'";
		if($this->lv014!="") $strCondi=$strCondi." and A.lv014  like '%$this->lv014%'";
		if($this->lv015!="") $strCondi=$strCondi." and A.lv015  like '%$this->lv015%'";
		if($this->lv016!="") $strCondi=$strCondi." and A.lv016  like '%$this->lv016%'";
		if($this->lv017!="") $strCondi=$strCondi." and A.lv017  like '%$this->lv017%'";
		if($this->lv018!="") $strCondi=$strCondi." and A.lv018  like '%$this->lv018%'";
		if($this->lv019!="") $strCondi=$strCondi." and A.lv019  like '%$this->lv019%'";
		if($this->lv020!="") $strCondi=$strCondi." and A.lv020  like '%$this->lv020%'";
		if($this->lv021!="") $strCondi=$strCondi." and A.lv021  like '%$this->lv021%'";
		if($this->lv022!="") $strCondi=$strCondi." and A.lv022  like '%$this->lv022%'";
		if($this->lv023!="") $strCondi=$strCondi." and A.lv023  like '%$this->lv023%'";
		if($this->lv024!="") $strCondi=$strCondi." and A.lv024  like '%$this->lv024%'";
		if($this->lv025!="") $strCondi=$strCondi." and A.lv025  like '%$this->lv025%'";
		if($this->lv026!="") $strCondi=$strCondi." and A.lv026  like '%$this->lv026%'";
		if($this->lv027!="") $strCondi=$strCondi." and A.lv027  like '%$this->lv027%'";
		if($this->lv028!="") $strCondi=$strCondi." and A.lv028  like '%$this->lv028%'";
		if($this->lv029!="") $strCondi=$strCondi." and A.lv029  like '%$this->lv029%'";
		if($this->lv030!="") $strCondi=$strCondi." and A.lv030  like '%$this->lv030%'";
		if($this->lv031!="") $strCondi=$strCondi." and A.lv031  like '%$this->lv031%'";
		if($this->lv032!="") $strCondi=$strCondi." and A.lv032  like '%$this->lv032%'";
		if($this->lv033!="") $strCondi=$strCondi." and A.lv033  like '%$this->lv033%'";
		if($this->lv034!="") $strCondi=$strCondi." and A.lv034  like '%$this->lv034%'";
		if($this->lv035!="") $strCondi=$strCondi." and A.lv035  like '%$this->lv035%'";
		if($this->lv053!="") $strCondi=$strCondi." and A.lv053  like '%$this->lv053%'";
		if($this->lv060!="") $strCondi=$strCondi." and A.lv060  = '$this->lv060'";
		switch($this->Bank)
		{
			case 2:
				$strCondi=$strCondi." and (trim(A.lv061) = '' or ISNULL(A.lv061))";
				break;
			case 1:
				$strCondi=$strCondi." and (trim(A.lv061) <> '')";
				break;
		}
		switch($this->isViet)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and B.lv022='VIETNAM'";
				break;
			case 2:
				$strCondi=$strCondi." and B.lv022<>'VIETNAM'";
				break;
		}
		switch($this->isNghi)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and (month(B.lv044)='".$this->CalMonth."' and year(B.lv044)='".$this->CalYear."')";
				break;
			case 2:
				$strCondi=$strCondi." and (month(B.lv044)<>'".$this->CalMonth."' and year(B.lv044)<>'".$this->CalYear."')";
				break;
		}
		if($this->isHDCheck==1)
		{
			if($this->lv201!="") $strCondi=$strCondi." and (AA.lv010 in (".$this->LV_GetDep($this->lv201).")	)";
			if($this->lv202!="") $strCondi=$strCondi." and (AA.lv010 in (".$this->LV_GetDep($this->lv202).")	)";
		}
		else
		{
			if($this->lv201!="") $strCondi=$strCondi." and (AA.lv004 in (".$this->LV_GetDep($this->lv201).")	)";
			if($this->lv202!="") $strCondi=$strCondi." and (AA.lv004 in (".$this->LV_GetDep($this->lv202).")	)";
		}
		
		if($this->lv839!="")
		{
			$strCondi=$strCondi." and (A.lv056 in (".$this->LV_GetHDLD($this->lv839).")	)";
		}
		if($this->lv058_!="")  
		{
			$strCondi=$strCondi." and A.lv058 in (".$this->LV_GetDepFull($this->lv058_).")";
		}
		return $strCondi;
	}
	function LV_GetDepFull($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		
			$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn) ";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				//$vReturn=$vReturn.",'".$vrow['lv001']."'";
				$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
			}
		
		return $vReturn;
	}
	function LV_GetHDLD($vTypeLabor)
	{
		if($vTypeLabor=="") return '';
		$vCondition="'".str_replace(",","','",$vTypeLabor)."'";
		$vsql="select lv001 from  hr_lv0038 where lv003 in ($vCondition) ";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			if($vReturn=="")
				$vReturn="'".$vrow['lv001']."'";
			else
				$vReturn=$vReturn.",'".$vrow['lv001']."'";
		}
		return $vReturn;
	}
	function LV_GetDep($vDepID)
	{
		if($vDepID=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		if($this->isChildCheck.""=="") $this->isChildCheck=1;
		if($this->isChildCheck==1)
		{
			$vsql="select lv001 from  hr_lv0002 where lv001 in ($vReturn) ";
			$bResult=db_query($vsql);
			while ($vrow = db_fetch_array ($bResult)){
				//$vReturn=$vReturn.",'".$vrow['lv001']."'";
				$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
			}
		}
		return $vReturn;
	}
	function LV_GetChildDep($vDepID)
	{
		$vReturn="";
		if(trim($vDepID)=="") return '';
		$vReturn="'".str_replace(",","','",$vDepID)."'";
		$vsql="select lv001 from  hr_lv0002 where lv002 in ($vReturn) ";
		$bResult=db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vReturn=$vReturn.",".$this->LV_GetChildDep($vrow['lv001']);
		}
		return $vReturn;
	}
	////////////////Count///////////////////////////
	function GetCount()
	{
		$sqlC = "SELECT COUNT(*) AS nums FROM tc_lv0021 WHERE 1=1 ".$this->GetCondition();
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
		$lvHref="@02";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT *,(lv039+lv043-lv035) lv180 FROM tc_lv0021 WHERE 1=1  ".$this->GetCondition()." $strSort LIMIT $curRow, $maxRows";
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
			if($vrow['lv063']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
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
			window.open('".$this->Dir."tc_lv0020/?lang=".$this->lang."&func='+value+'&NVID=".base64_encode($this->lv002)."&CalID=".base64_encode($this->lv020)."','','width=800,height=600,left=200,top=100,screenX=0,screenY=100,resizable=yes,status=no,scrollbars=yes,menubar=yes');
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
						<li class=\"menusubT\"><img src=\"$this->Dir../images/lvicon/config.png\" border=\"0\" />".$this->ArrFunc[11]."
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
			<td width=1% class=@#04>@03</td>
			@#01
		</tr>
		";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\">@02</td>";
		$sqlS = "SELECT * FROM tc_lv0021 WHERE 1=1  ".$this->RptCondition." ".$this->GetConditionFixed()." $strSort LIMIT $curRow, $maxRows";
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
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	function LV_GetCodeKT($vCode,$vDeptID)
	{
		
		if($this->ArrayDeptCode[$vDeptID][0]==true) return $this->ArrayDeptCode[$vDeptID][1];
		if($vCode!=''){
			$this->ArrayDeptCode[$vDeptID][0]=true;
			$this->ArrayDeptCode[$vDeptID][1]=$vCode;
			return $vCode;
		} 
		if($vDeptID=='THAIDUCLAM' || $vDeptID=='VP' || $vDeptID=='XUONG' || $vDeptID=='')
		{
			$this->ArrayDeptCode[$vDeptID][0]=true;
			$this->ArrayDeptCode[$vDeptID][1]=$vCode;
			return $vCode;
		}	
		$lvsql="select lv001,lv002,lv003,lv007 from  hr_lv0002 Where lv001='$vDeptID'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
			
			if($vrow['lv002']=='THAIDUCLAM' || $vrow['lv002']=='VP' || $vrow['lv002']=='XUONG')
			{
				$this->ArrayDeptCode[$vDeptID][0]=true;
				$this->ArrayDeptCode[$vDeptID][1]=$vrow['lv007'];
				return $vrow['lv007'];
			}
			else
			{
				$this->ArrayDeptCode[$vDeptID][0]=true;
				$this->ArrayDeptCode[$vDeptID][1]=$this->LV_GetCodeKT($vrow['lv007'],$vrow['lv002']);
				return $this->ArrayDeptCode[$vDeptID][1];
			}
		}
		return $vlv001;
	}
	function LV_GetVuotCong($vDeptID)
	{
		if($this->ArrayDeptVuotCong[$vDeptID][0]==true) return $this->ArrayDeptVuotCong[$vDeptID][1];
		$lvsql="select lv001,lv002,lv003,lv007,lv008 from  hr_lv0002 Where lv001='$vDeptID'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
				$this->ArrayDeptVuotCong[$vDeptID][0]=true;
				$this->ArrayDeptVuotCong[$vDeptID][1]=$vrow['lv008'];
		}
		return $this->ArrayDeptVuotCong[$vDeptID][1];
	}
	function LV_GetSoLanTC($vDeptID)
	{
		if($this->ArrayDeptSoLanTC[$vDeptID][0]==true) return $this->ArrayDeptSoLanTC[$vDeptID][1];
		$lvsql="select lv001,lv002,lv003,lv007,lv008 from  hr_lv0002 Where lv001='$vDeptID'";
		$vresult=db_query($lvsql);
		while($vrow=db_fetch_array($vresult))
		{
				$this->ArrayDeptSoLanTC[$vDeptID][0]=true;
				$this->ArrayDeptSoLanTC[$vDeptID][1]=$vrow['lv007'];
		}
		return $this->ArrayDeptSoLanTC[$vDeptID][1];
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOther($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
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
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\"  >
		@#01
		<tr class=\"lvlineboldtable\"><td colspan='2'>".($this->ArrPush[1000])."</td>@#02</tr>
		</table>
		";
		$lvTdS="<td align=\"right\">@#01</td>";
		$lvTrH="<tr class=\"lvhtable\">			
			@#01
		</tr>
		";
		$lvTr="<tr class=\"lvlinehtable@01\">
			
			@#01
		</tr>
		";
		$lvTrDep="<tr class=\"lvlinehtable@01\">
			<td class=\"lvhtable_1\" colspan=\"3\" align=\"center\"><strong>@#01</strong></td>
		";
		$lvTdHE="<td width=\"@01\" class=\"lvhtable_1\" >&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\" style='white-space:nowrap'>@02</td>";
		$sqlS = "select * from (SELECT A.*,(A.lv039+A.lv043-A.lv035) lv180,AA.lv004 DeptID,C.lv007 lv101  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001  WHERE 1=1  ".$this->GetConditionOtherCal().") MP $strSort LIMIT $curRow, $maxRows";
		//$sqlS = "SELECT A.*  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		$strH="<td width=\"@01\" class=\"lvhtable\">".($this->ArrPush[1])."</td>";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($i>1) $lvTrDep=$lvTrDep.$lvTdHE;
			}
		$strDepart="";	
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$vlv103=$vlv103+$vrow['lv103'];
			$vlv102=$vlv102+$vrow['lv102'];
			$vlv091=$vlv091+$vrow['lv091'];
			$vlv090=$vlv090+$vrow['lv090'];
			$vlv089=$vlv089+$vrow['lv089'];
			$vlv088=$vlv088+$vrow['lv088'];
			$vlv087=$vlv087+$vrow['lv087'];
			$vlv086=$vlv086+$vrow['lv086'];
			$vlv085=$vlv085+$vrow['lv085'];
			$vlv084=$vlv084+$vrow['lv084'];
			$vlv083=$vlv083+$vrow['lv083'];
			$vlv082=$vlv082+$vrow['lv082'];
			$vlv081=$vlv081+$vrow['lv081'];
			$vlv080=$vlv080+$vrow['lv080'];
			$vlv079=$vlv079+$vrow['lv079'];
			$vlv078=$vlv078+$vrow['lv078'];
			$vlv077=$vlv077+$vrow['lv077'];
			$vlv076=$vlv076+$vrow['lv076'];
			$vlv075=$vlv075+$vrow['lv075'];
			$vlv074=$vlv074+$vrow['lv074'];
			$vlv073=$vlv073+$vrow['lv073'];
			$vlv072=$vlv072+$vrow['lv072'];
			$vlv071=$vlv071+$vrow['lv071'];
			$vlv070=$vlv070+$vrow['lv070'];
			$vlv069=$vlv069+$vrow['lv069'];
			$vlv068=$vlv068+$vrow['lv068'];
			$vlv067=$vlv067+$vrow['lv067'];
			$vlv066=$vlv066+$vrow['lv066'];
			$vlv065=$vlv065+$vrow['lv065'];
			$vlv064=$vlv064+$vrow['lv064'];
			$vlv063=$vlv063+$vrow['lv063'];
			$vlv062=$vlv062+$vrow['lv062'];
			$vlv061=$vlv061+$vrow['lv061'];
			$vlv060=$vlv060+$vrow['lv060'];
			$vlv059=$vlv059+$vrow['lv059'];
			$vlv058=$vlv058+$vrow['lv058'];
			$vlv057=$vlv057+$vrow['lv057'];
			$vlv056=$vlv056+$vrow['lv056'];
			$vlv055=$vlv055+$vrow['lv055'];
			$vlv054=$vlv054+$vrow['lv053'];
			$vlv053=$vlv053+$vrow['lv053'];
			$vlv052=$vlv052+$vrow['lv052'];
			$vlv051=$vlv051+$vrow['lv051'];
			$vlv050=$vlv050+$vrow['lv050'];
			$vlv049=$vlv049+$vrow['lv049'];
			$vlv048=$vlv048+$vrow['lv048'];
			$vlv047=$vlv047+$vrow['lv047'];
			$vlv046=$vlv046+$vrow['lv046'];
			$vlv045=$vlv045+$vrow['lv045'];
			$vlv044=$vlv044+$vrow['lv044'];
			$vlv043=$vlv043+$vrow['lv043'];
			$vlv042=$vlv042+$vrow['lv042'];
			$vlv041=$vlv041+$vrow['lv041'];
			$vlv040=$vlv040+$vrow['lv040'];
			$vlv039=$vlv039+$vrow['lv039'];
			$vlv038=$vlv038+$vrow['lv038'];
			$vlv037=$vlv037+$vrow['lv037'];
			$vlv036=$vlv036+$vrow['lv036'];
			$vlv035=$vlv035+$vrow['lv035'];
			$vlv034=$vlv034+$vrow['lv034'];
			$vlv033=$vlv033+$vrow['lv033'];
			$vlv032=$vlv032+$vrow['lv032'];
			$vlv029=$vlv029+$vrow['lv029'];
			$vlv028=$vlv028+$vrow['lv028'];
			$vlv026=$vlv026+$vrow['lv026'];
			$vlv027=$vlv027+$vrow['lv027'];
			$vlv025=$vlv025+$vrow['lv025'];
			$vlv024=$vlv024+$vrow['lv024'];
			$vlv023=$vlv023+$vrow['lv023'];
			$vlv022=$vlv022+$vrow['lv022'];
			$vlv021=$vlv021+$vrow['lv021'];			
			$vlv020=$vlv020+$vrow['lv020'];
			$vlv019=$vlv019+$vrow['lv019'];		
			$vlv018=$vlv018+$vrow['lv018'];
			$vlv017=$vlv017+$vrow['lv017'];
			$vlv016=$vlv016+$vrow['lv016'];
			$vlv015=$vlv015+$vrow['lv015'];
			$vlv014=$vlv014+$vrow['lv014'];
			$vlv013=$vlv013+$vrow['lv013'];
			$vlv012=$vlv012+$vrow['lv012'];
			$vlv011=$vlv011+$vrow['lv011'];
			$vlv010=$vlv010+$vrow['lv010'];
			$vlv009=$vlv009+$vrow['lv009'];
			$vlv008=$vlv008+$vrow['lv008'];
			$vlv007=$vlv007+$vrow['lv007'];
			$vlv006=$vlv006+$vrow['lv006'];
			$vlv180=$vlv180+$vrow['lv180'];
			if(strpos($strDepart,$vrow['DeptID'].'')===false)
			{
				$vorder=1;
				$strSumBuilHD=str_replace("@#01",$this->getvaluelink("lv096",$vrow['DeptID']),$lvTrDep);
			}
				$vTemp1=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vorder,10)),$this->Align($lvTd,10));
			
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					
					case 'lv058':
						if(strpos($strDepart,$vrow['DeptID'].'')===false || $vorder==1)
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							$strDepart=$strDepart.$vrow['DeptID']."@";
						}
						else
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView('',(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv101':
						$vCodeKT=$this->LV_GetCodeKT($vrow['lv101'],$vrow['DeptID']);
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vCodeKT,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv007':
						if($this->option==1)
						{
						$vTemp=str_replace("@02",unicode_to_none($this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]))),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
						}
					default:
					
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}
			$strTr=$strTr.$strSumBuilHD;
			$strSumBuilHD="";
			$strTr=$strTr.str_replace("@#01",$vTemp1.$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		/*$strTable=str_replace("@#lv029",$this->FormatView($vlv029,1),$lvTable);
		$strTable=str_replace("@#lv028",$this->FormatView($vlv028,1),$strTable);
		$strTable=str_replace("@#lv027",$this->FormatView($vlv027,1),$strTable);
		$strTable=str_replace("@#lv019",$this->FormatView($vlv019,1),$strTable);
		$strTable=str_replace("@#lv025",$this->FormatView($vlv025,1),$strTable);
		$strTable=str_replace("@#lv024",$this->FormatView($vlv024,10),$strTable);
		$strTable=str_replace("@#lv017",$this->FormatView($vlv017,1),$strTable);
		$strTable=str_replace("@#lv022",$this->FormatView($vlv022,1),$strTable);
		$strTable=str_replace("@#lv016",$this->FormatView($vlv016,10),$strTable);
		$strTable=str_replace("@#lv015",$this->FormatView($vlv015,1),$strTable);
		$strTable=str_replace("@#lv014",$this->FormatView($vlv014,1),$strTable);
		$strTable=str_replace("@#lv013",$this->FormatView($vlv013,1),$strTable);
		$strTable=str_replace("@#lv012",$this->FormatView($vlv012,1),$strTable);
		$strTable=str_replace("@#lv011",$this->FormatView($vlv011,1),$strTable);
		$strTable=str_replace("@#lv010",$this->FormatView($vlv010,1),$strTable);
		$strTable=str_replace("@#lv009",$this->FormatView($vlv009,1),$strTable);
		$strTable=str_replace("@#lv008",$this->FormatView($vlv008,1),$strTable);
		$strTable=str_replace("@#lv007",$this->FormatView($vlv007,1),$strTable);
		$strTable=str_replace("@#lv006",$this->FormatView($vlv006,1),$strTable);*/
		$strSumBuil="";
		for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
				
					case 'lv180':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv180,1),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv080,1),$lvTdS);
						break;	
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv055,1),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv054,1),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv053,1),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv052,1),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv051,1),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv050,1),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv049,1),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv048,1),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv047,1),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv046,1),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv045,1),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv044,1),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv043,1),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv042,1),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv041,1),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv040,1),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv039,1),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv038,1),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv037,1),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv036,1),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv035,1),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv034,1),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv033,1),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,1),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv031,1),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv030,1),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv029,1),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv028,1),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv027,1),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv026,1),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv025,1),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv024,1),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv023,1),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv022,1),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv021,1),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv020,1),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv019,1),$lvTdS);
						break;						
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv018,1),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv017,1),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv015,1),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv014,1),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv013,1),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv012,1),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv011,1),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv010,1),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv009,1),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv008,1),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv006,1),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
			$strTable=str_replace("@#02",$strSumBuil,$lvTable);
		return str_replace("@#01",$strTrH.$strTr,$strTable);
	}
	function GetMonthName($vMonth)
{
	$vArr=array ("01"=>"Jan","02"=>"Feb","03"=>"Mar","04"=>"Apr","05"=>"May","06"=>"Jun","07"=>"Jul","08"=>"Aug","09"=>"Sep","10"=>"Oct","11"=>"Nov","12"=>"Dec");
	return $vArr[$vMonth];
}
	function LV_BuilListHotel($motc_lv0013)
	{
		$vHeader='<table border="0" cellspacing="0">
<tbody>
<tr>
<td height="19" align="left" valign="bottom"><span style="text-decoration: underline;"><span style="color: #000000;">IMPERIAL HOTEL VUNG TAU</span></span></td>
<td align="left" valign="bottom"><span style="text-decoration: underline;"><span style="color: #000000;"><br /> </span></span></td>
<td align="left" valign="bottom"><span style="text-decoration: underline;"><span style="color: #000000;"><br /> </span></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
</tr>
<tr>
<td height="19" align="left" valign="bottom"><span style="color: #000000;">VUNG TAU - VIET NAM</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
</tr>
<tr>
<td height="19" align="left" valign="bottom"><span style="color: #000000;">PAYROLL&nbsp; REGISTER - OCTOBER-2015</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
</tr>
<tr>
<td height="19" align="left" valign="bottom"><span style="color: #000000;">PAYROLL CUT - OFF DATE</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
</tr>
<tr>
<td height="19" align="left" valign="bottom"><span style="color: #000000;">Number of working days</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
</tr>
<tr>
<td height="19" align="left" valign="bottom"><span style="color: #000000;">Number of overtime</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
</tr>
<tr>
<td height="19" align="left" valign="bottom"><span style="color: #000000;">EX.RATE</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
<td align="center" valign="bottom"><span style="color: #000000; font-size: small;"><br /> </span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>';
$vHeader=$vHeader.'

<table border="1" cellspacing="0">
<colgroup width="30"></colgroup> <colgroup width="56"></colgroup> <colgroup width="199"></colgroup> <colgroup width="92"></colgroup> <colgroup width="80"></colgroup> <colgroup width="182"></colgroup> <colgroup width="61"></colgroup> <colgroup width="78"></colgroup> <colgroup width="64"></colgroup> <colgroup width="69"></colgroup> <colgroup width="85"></colgroup> <colgroup width="120"></colgroup> <colgroup width="128"></colgroup> <colgroup width="117"></colgroup> <colgroup width="105"></colgroup> <colgroup width="128"></colgroup> <colgroup width="116"></colgroup> <colgroup width="136"></colgroup> <colgroup width="130"></colgroup> <colgroup width="102"></colgroup> <colgroup width="104"></colgroup> <colgroup width="103"></colgroup> <colgroup width="97"></colgroup> <colgroup width="106"></colgroup> <colgroup width="112"></colgroup> <colgroup width="116"></colgroup> <colgroup width="176"></colgroup> <colgroup width="122"></colgroup> <colgroup width="117"></colgroup> <colgroup span="2" width="126"></colgroup> <colgroup width="116"></colgroup> <colgroup width="130"></colgroup> <colgroup width="174"></colgroup> 
<tbody>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: small;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="right" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="right" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="right" valign="bottom"><span style="font-family: Arial; color: #000000;"> 248,777,749 </span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000;"><br /></span></td>
<td colspan="4" align="right" valign="bottom"><em><span style="font-family: Arial; color: #000000; font-size: small;"> Vũng T&agrave;u, ng&agrave;y 04 tháng 10 năm 2015 </span></em></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">Prepared by</span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td colspan="3" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"> Verified by </span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td colspan="2" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">Verified by</span></td>
<td colspan="3" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom">Aproval by</td>
<td align="left" valign="bottom"><br /></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="22" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="57" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="31" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">Trần Th&uacute;y An</span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td colspan="3" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"> Trần Thị Thu Th&uacute;y </span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td colspan="4" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">V&otilde; B&iacute;ch Tr&acirc;m</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="center" valign="bottom" bgcolor="#FFFFFF"><span style="font-family: Arial; font-size: medium;">Frank Huch</span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">V&otilde; Nguyễn Phương Trang</span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
<tr>
<td height="32" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">HR Officer</span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td colspan="3" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"> AHR Manager </span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td colspan="4" align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">Director Of Finance</span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="left" valign="bottom"><span style="color: #000000;"><br /></span></td>
<td align="center" valign="bottom" bgcolor="#FFFFFF"><span style="font-family: Arial; font-size: medium;">Resident Manager</span></td>
<td align="left" valign="bottom" bgcolor="#FFFFFF"><em><span style="font-family: Arial; font-size: medium;"><br /></span></em></td>
<td align="left" valign="bottom" bgcolor="#FFFFFF"><em><span style="font-family: Arial; font-size: medium;"><br /></span></em></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
<td align="center" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;">Vice General Director</span></td>
<td align="left" valign="bottom"><span style="font-family: Arial; color: #000000; font-size: medium;"><br /></span></td>
</tr>
</tbody>
</table>';
return $vHeader.$vTR.$vFooter;
	}
	
	function LV_BuilListForeigner($motc_lv0013)
	{
		$vNow=$this->DateCurrent;
		$vHeader='
<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="41"></col> <col width="175"></col> <col width="158"></col> <col width="92"></col> <col width="88"></col> <col width="108"></col> <col width="93"></col> <col width="90"></col> <col width="105"></col> <col width="135"></col> <col width="83"></col> <col width="93"></col> <col width="65"></col> <col width="131"></col> <col width="120"></col> <col width="130"></col> <col width="92"></col> <col width="120"></col> <col width="71"></col> <col width="102"></col> <col width="115"></col> <col width="121"></col> <col width="83"></col> <col width="126"></col> <col width="87"></col> <col width="101"></col> <col span="2" width="87"></col> <col width="87"></col> <col width="138"></col> <col width="91"></col> <col width="129"></col> <col width="120"></col> <col width="161"></col> </colgroup> 
<tbody>
<tr height="25">
<td height="25">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="25">
<td colspan="3" height="25">IMPERIAL HOTEL   VUNG TAU</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="25">
<td colspan="3" height="25">VUNG TAU - VIETNAM</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="25">
<td colspan="6" height="25">EXPAT   PAYROLL REGISTER/ BẢNG LƯƠNG NGƯỜI NƯỚC NGO&Agrave;I -'.Fillnum($motc_lv0013->lv006,2).'/ '.$motc_lv0013->lv007.'</td>
<td>&nbsp;</td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td><span style="text-decoration: underline;">&nbsp;</span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="26">
<td colspan="2" height="26">'.$this->GetMonthName(getmonth($vNow)).'-'.getday($vNow).'</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="29">
<td colspan="3" height="29">Number   of working days/ ngày công</td>
<td>&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 24</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="26">
<td colspan="2" height="26">Exchange rate/ tỷ   giá</td>
<td>'.getday($motc_lv0013->lv005).'-'.$this->GetMonthName(getmonth($motc_lv0013->lv005)).'-'.substr($motc_lv0013->lv005,2,2).'</td>
<td>&nbsp;</td>
<td>Ex.rate :</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$motc_lv0013->FormatView($motc_lv0013->lv024,10).'</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
';
$vTable='
<table style="width: 100%;" border="1" cellspacing="0" cellpadding="0"  class="lvtable">
<colgroup><col width="41"></col> <col width="175"></col> <col width="158"></col> <col width="92"></col> <col width="88"></col> <col width="108"></col> <col width="93"></col> <col width="90"></col> <col width="105"></col> <col width="135"></col> <col width="83"></col> <col width="93"></col> <col width="65"></col> <col width="131"></col> <col width="120"></col> <col width="130"></col> <col width="92"></col> <col width="120"></col> <col width="71"></col> <col width="102"></col> <col width="115"></col> <col width="121"></col> <col width="83"></col> <col width="126"></col> <col width="87"></col> <col width="101"></col> <col span="2" width="87"></col> <col width="87"></col> <col width="138"></col> <col width="91"></col> <col width="129"></col> <col width="120"></col> <col width="161"></col> </colgroup> 
<tbody>
<tr height="86" class="lvhtable">
<td rowspan="3" width="41" height="221" class="lvhtable">STT<br /> (No)</td>
<td rowspan="3" width="175" class="lvhtable">Tê<br /> (Name)</td>
<td rowspan="3" width="158" class="lvhtable">Chức vụ<br /> (Position)<br /></td>
<td class="lvhtable">&nbsp;</td>
<td rowspan="3" width="108" class="lvhtable">&nbsp;Net salary<br /> (Lương sau thuế)&nbsp;</td>
<td rowspan="3" width="93" class="lvhtable">&nbsp;Tổng công (Day at works)&nbsp;</td>
<td rowspan="3" width="90" class="lvhtable">&nbsp;Công thực tế<br /> (Paid days)<br /> &nbsp;</td>
<td colspan="2" rowspan="2" width="240" class="lvhtable">&nbsp;Lương NET<br /> (Net basic salary)&nbsp;</td>
<td colspan="2" width="176" class="lvhtable">&nbsp;Các   khoản<br /> phụ cấp NET<br /> (Allowances)&nbsp;</td>
<td colspan="2" rowspan="2" width="173" class="lvhtable">&nbsp;Thưởng<textarea class="lvhtable"></textarea></td>
<td colspan="2" rowspan="2" width="236" class="lvhtable">&nbsp;Tổng thu nhập tính thuế&nbsp;</td>
<td colspan="2" rowspan="2" width="209" class="lvhtable">&nbsp;Tổng thuế TNCN<br /> (PIT by company)&nbsp;</td>
<td colspan="2" rowspan="2" width="225" class="lvhtable">&nbsp;   Tổng chi phí tiền lương<br /> <br /> (Total costs)&nbsp;</td>
<td colspan="2" rowspan="2" width="220" class="lvhtable">&nbsp;Tiền Tạm Ứng<br /> (Cash Advance)&nbsp;</td>
<td colspan="2" rowspan="2" width="281" class="lvhtable">Thực lãnh<br /> (Net Pay)</td>
</tr>
<tr height="67" class="lvhtable">
<td width="88" class="lvhtable">&nbsp;Date Hired (mm/dd/yy)&nbsp;</td>
<td colspan="2" width="176" class="lvhtable">&nbsp;House&nbsp;</td>
</tr>
<tr height="68" class="lvhtable">
<td width="88">&nbsp;</td>
<td width="105">&nbsp;USD&nbsp;</td>
<td width="135">&nbsp;VND&nbsp;</td>
<td width="83">&nbsp;USD&nbsp;</td>
<td width="93">&nbsp;VND&nbsp;</td>
<td width="71">&nbsp;USD&nbsp;</td>
<td width="102">&nbsp;VND&nbsp;</td>
<td width="115">&nbsp;USD&nbsp;</td>
<td width="121">&nbsp;VND&nbsp;</td>
<td width="83">&nbsp;USD&nbsp;</td>
<td width="126">&nbsp;VND&nbsp;</td>
<td width="87">&nbsp;USD&nbsp;</td>
<td width="138">&nbsp;VND&nbsp;</td>
<td width="91">&nbsp;USD&nbsp;</td>
<td width="129">&nbsp;VND&nbsp;</td>
<td width="120">&nbsp;USD&nbsp;</td>
<td width="161">&nbsp;VND&nbsp;</td>
</tr>
<tr height="68">
<td width="41" height="68">1</td>
<td width="175">2</td>
<td width="158">3</td>
<td width="88">4</td>
<td width="108">5</td>
<td width="93">6</td>
<td width="93">7</td>
<td width="90">8</td>
<td width="105">9</td>
<td width="135">10</td>
<td width="83">11</td>
<td width="120">12</td>
<td width="71">13</td>
<td width="102">14</td>
<td width="115">15</td>
<td width="121">16</td>
<td width="83">17</td>
<td width="87">18</td>
<td width="87">19</td>
<td width="138">20</td>
<td>21</td>
<td>22</td>
<td>23</td>
</tr>
@01

';
$vFooter='
<table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
<colgroup><col width="41"></col> <col width="175"></col> <col width="158"></col> <col width="92"></col> <col width="88"></col> <col width="108"></col> <col width="93"></col> <col width="90"></col> <col width="105"></col> <col width="135"></col> <col width="83"></col> <col width="93"></col> <col width="65"></col> <col width="131"></col> <col width="120"></col> <col width="130"></col> <col width="92"></col> <col width="120"></col> <col width="71"></col> <col width="102"></col> <col width="115"></col> <col width="121"></col> <col width="83"></col> <col width="126"></col> <col width="87"></col> <col width="101"></col> <col span="2" width="87"></col> <col width="87"></col> <col width="138"></col> <col width="91"></col> <col width="129"></col> <col width="120"></col> <col width="161"></col> </colgroup> 
<tbody><tr height="48">
<td height="48">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="12">&nbsp;Vũng tàu,   ngày '.getday($vNow).' tháng '.getmonth($vNow).' năm '.getyear($vNow).'&nbsp;</td>
</tr>
<tr height="48">
<td height="48">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="42">
<td colspan="2" height="42">Prepared by</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;Verified   by&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;Verified by&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="7">&nbsp;Verified   by&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;Approved   by&nbsp;</td>
</tr>
<tr height="42">
<td height="42">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="42">
<td height="42">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="31">
<td height="31">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="31">
<td height="31">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr height="31">
<td colspan="2" height="31">Trần Th&uacute;y An</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">V&otilde; Bích Trâm</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="7">Frank Huch</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">V&otilde; Nguyễn Phương Trang</td>
</tr>
<tr height="31">
<td colspan="2" height="31">Payroll Officer</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">AHR Manager</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="3">Director of Finance</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="7">Resident Manager</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td colspan="2">Vice General Director</td>
</tr>
</tbody>
</table>';
$vTr='
<tr height="88"  class="lvlinehtable@01">
<td height="88">@#01</td>
<td>@#02</td>
<td>@#03</td>
<td>@#04</td>
<td>@#05</td>
<td>@#06</td>
<td>@#07</td>
<td>@#08</td>
<td>@#09</td>
<td>@#10</td>
<td>@#11</td>
<td>@#12</td>
<td>@#13</td>
<td>@#14</td>
<td>@#15</td>
<td>@#16</td>
<td>@#17</td>
<td>@#18</td>
<td>@#19</td>
<td>@#20</td>
<td>@#21</td>
<td>@#22</td>
<td>@#23</td>
</tr>';
$vTrSum='
<tr height="88">
<td height="87">&nbsp;</td>
<td height="88" colspan="3">Sum</td>
<td>@#05</td>
<td>@#06</td>
<td>@#07</td>
<td>@#08</td>
<td>@#09</td>
<td>@#10</td>
<td>@#11</td>
<td>@#12</td>
<td>@#13</td>
<td>@#14</td>
<td>@#15</td>
<td>@#16</td>
<td>@#17</td>
<td>@#18</td>
<td>@#19</td>
<td>@#20</td>
<td>@#21</td>
<td>@#22</td>
<td>@#23</td>
</tr>';
$vCalID=$motc_lv0013->lv001;
$vslq="select A.*,B.lv002 Name,B.lv005 Position,B.lv030 DateWork from tc_lv0021 A inner join hr_lv0020 B on A.lv002=B.lv001 where A.lv060='$vCalID' and A.lv100='USD' and B.lv009 not in (2,3)";
$bResult=db_query($vslq);
$i=1;
while ($vrow = db_fetch_array ($bResult)){
	if($vrow['lv100']=='USD')
	{
		$vSumLv005=$vSumLv005+$vrow['lv019']+$vrow['lv023'];
		$vSumLv006=$vSumLv006+$vrow['lv012'];
		$vSumLv007=$vSumLv007+$vrow['lv013'];
		$vSumLv008=$vSumLv008+$vrow['lv019']*($vrow['lv013']/$vrow['lv012']);
		$vSumLv009=$vSumLv009+$vrow['lv019']*($vrow['lv013']/$vrow['lv012'])*$motc_lv0013->lv024;
		$vSumLv010=$vSumLv010+$vrow['lv023']*($vrow['lv013']/$vrow['lv012']);
		$vSumLv011=$vSumLv011+$vrow['lv023']*($vrow['lv013']/$vrow['lv012'])*$motc_lv0013->lv024;
		$vSumLv012=$vSumLv012+$vrow['lv071'];
		$vSumLv013=$vSumLv013+$vrow['lv071']*$motc_lv0013->lv024;
		$vSumLv014=$vSumLv014+$vrow['lv044'];
		$vSumLv015=$vSumLv015+$vrow['lv044']*$motc_lv0013->lv024;
		$vSumLv016=$vSumLv016+$vrow['lv045'];
		$vSumLv017=$vSumLv017+$vrow['lv045']*$motc_lv0013->lv024;
		$vSumLv018=$vSumLv018+$vrow['lv048'];
		$vSumLv019=$vSumLv019+$vrow['lv048']*$motc_lv0013->lv024;
		$vSumLv020=$vSumLv020+$vrow['lv010'];
		$vSumLv021=$vSumLv021+$vrow['lv010']*$motc_lv0013->lv024;
		$vSumLv022=$vSumLv022+$vrow['lv050'];
		$vSumLv023=$vSumLv023+$vrow['lv050']*$motc_lv0013->lv024;
		
		$vTemp=str_replace("@01",$i%2,$vTr);
		$vTemp=str_replace("@#01",$i,$vTemp);
		$vTemp=str_replace("@#02",$vrow['Name'],$vTemp);
		$vTemp=str_replace("@#03",$vrow['Position'],$vTemp);
		$vTemp=str_replace("@#04",getmonth($vrow['DateWork']).'/'.getday($vrow['DateWork'])."/".getyear($vrow['DateWork']),$vTemp);
		$vTemp=str_replace("@#05",$this->FormatView($vrow['lv019']+$vrow['lv023'],10),$vTemp);
		$vTemp=str_replace("@#06",$this->FormatView($vrow['lv012'],10),$vTemp);
		$vTemp=str_replace("@#07",$this->FormatView($vrow['lv013'],10),$vTemp);
		$vTemp=str_replace("@#08",$this->FormatView($vrow['lv019']*($vrow['lv013']/$vrow['lv012']),10),$vTemp);
		$vTemp=str_replace("@#09",$this->FormatView($vrow['lv019']*($vrow['lv013']/$vrow['lv012'])*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#10",$this->FormatView($vrow['lv023']*($vrow['lv013']/$vrow['lv012']),10),$vTemp);
		$vTemp=str_replace("@#11",$this->FormatView($vrow['lv023']*($vrow['lv013']/$vrow['lv012'])*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#12",$this->FormatView($vrow['lv071'],10),$vTemp);
		$vTemp=str_replace("@#13",$this->FormatView($vrow['lv071']*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#14",$this->FormatView($vrow['lv044'],10),$vTemp);
		$vTemp=str_replace("@#15",$this->FormatView($vrow['lv044']*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#16",$this->FormatView($vrow['lv045'],10),$vTemp);
		$vTemp=str_replace("@#17",$this->FormatView($vrow['lv045']*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#18",$this->FormatView($vrow['lv048'],10),$vTemp);
		$vTemp=str_replace("@#19",$this->FormatView($vrow['lv048']*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#20",$this->FormatView($vrow['lv010'],10),$vTemp);
		$vTemp=str_replace("@#21",$this->FormatView($vrow['lv010']*$motc_lv0013->lv024,10),$vTemp);
		$vTemp=str_replace("@#22",$this->FormatView($vrow['lv050'],10),$vTemp);
		$vTemp=str_replace("@#23",$this->FormatView($vrow['lv050']*$motc_lv0013->lv024,10),$vTemp);
	}
	else
	{
		$vSumLv005=$vSumLv005+$vrow['lv019']+$vrow['lv023'];
		$vSumLv006=$vSumLv006+$vrow['lv012'];
		$vSumLv007=$vSumLv007+$vrow['lv013'];
		$vSumLv008=$vSumLv008+$vrow['lv019']*($vrow['lv013']/$vrow['lv012'])/$motc_lv0013->lv024;
		$vSumLv009=$vSumLv009+$vrow['lv019']*($vrow['lv013']/$vrow['lv012']);
		$vSumLv010=$vSumLv010+$vrow['lv023']*($vrow['lv013']/$vrow['lv012'])/$motc_lv0013->lv024;
		$vSumLv011=$vSumLv011+$vrow['lv023']*($vrow['lv013']/$vrow['lv012']);
		$vSumLv012=$vSumLv012+$vrow['lv071']/$motc_lv0013->lv024;
		$vSumLv013=$vSumLv013+$vrow['lv071'];
		$vSumLv014=$vSumLv014+$vrow['lv044']/$motc_lv0013->lv024;
		$vSumLv015=$vSumLv015+$vrow['lv044'];
		$vSumLv016=$vSumLv016+$vrow['lv045']/$motc_lv0013->lv024;
		$vSumLv017=$vSumLv017+$vrow['lv045'];
		$vSumLv018=$vSumLv018+$vrow['lv048']/$motc_lv0013->lv024;
		$vSumLv019=$vSumLv019+$vrow['lv048'];
		$vSumLv020=$vSumLv020+$vrow['lv010']/$motc_lv0013->lv024;
		$vSumLv021=$vSumLv021+$vrow['lv010'];
		$vSumLv022=$vSumLv022+$vrow['lv050']/$motc_lv0013->lv024;
		$vSumLv023=$vSumLv023+$vrow['lv050'];	
	$vTemp=str_replace("@01",$i%2,$vTr);
	$vTemp=str_replace("@#01",$i,$vTemp);
	$vTemp=str_replace("@#02",$vrow['Name'],$vTemp);
	$vTemp=str_replace("@#03",$vrow['Position'],$vTemp);
	$vTemp=str_replace("@#04",getmonth($vrow['DateWork']).'/'.getday($vrow['DateWork'])."/".getyear($vrow['DateWork']),$vTemp);
	$vTemp=str_replace("@#05",$this->FormatView($vrow['lv019']+$vrow['lv023'],10),$vTemp);
	$vTemp=str_replace("@#06",$this->FormatView($vrow['lv012'],10),$vTemp);
	$vTemp=str_replace("@#07",$this->FormatView($vrow['lv013'],10),$vTemp);
	$vTemp=str_replace("@#08",$this->FormatView($vrow['lv019']*($vrow['lv013']/$vrow['lv012'])/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#09",$this->FormatView($vrow['lv019']*($vrow['lv013']/$vrow['lv012']),10),$vTemp);
	$vTemp=str_replace("@#10",$this->FormatView($vrow['lv023']*($vrow['lv013']/$vrow['lv012'])/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#11",$this->FormatView($vrow['lv023']*($vrow['lv013']/$vrow['lv012']),10),$vTemp);
	$vTemp=str_replace("@#12",$this->FormatView($vrow['lv071']/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#13",$this->FormatView($vrow['lv071'],10),$vTemp);
	$vTemp=str_replace("@#14",$this->FormatView($vrow['lv044']/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#15",$this->FormatView($vrow['lv044'],10),$vTemp);
	$vTemp=str_replace("@#16",$this->FormatView($vrow['lv045']/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#17",$this->FormatView($vrow['lv045'],10),$vTemp);
	$vTemp=str_replace("@#18",$this->FormatView($vrow['lv048']/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#19",$this->FormatView($vrow['lv048'],10),$vTemp);
	$vTemp=str_replace("@#20",$this->FormatView($vrow['lv010']/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#21",$this->FormatView($vrow['lv010'],10),$vTemp);
	$vTemp=str_replace("@#22",$this->FormatView($vrow['lv050']/$motc_lv0013->lv024,10),$vTemp);
	$vTemp=str_replace("@#23",$this->FormatView($vrow['lv050'],10),$vTemp);
	
	}
	$vStrTr=$vStrTr.$vTemp;
	$i++;
	
}
$vTrSum=str_replace("@#05",$this->FormatView($vSumLv005,10),$vTrSum);
$vTrSum=str_replace("@#06",$this->FormatView($vSumLv006,10),$vTrSum);
$vTrSum=str_replace("@#07",$this->FormatView($vSumLv007,10),$vTrSum);
$vTrSum=str_replace("@#08",$this->FormatView($vSumLv008,10),$vTrSum);
$vTrSum=str_replace("@#09",$this->FormatView($vSumLv009,10),$vTrSum);
$vTrSum=str_replace("@#10",$this->FormatView($vSumLv010,10),$vTrSum);
$vTrSum=str_replace("@#11",$this->FormatView($vSumLv011,10),$vTrSum);
$vTrSum=str_replace("@#12",$this->FormatView($vSumLv012,10),$vTrSum);
$vTrSum=str_replace("@#13",$this->FormatView($vSumLv013,10),$vTrSum);
$vTrSum=str_replace("@#14",$this->FormatView($vSumLv014,10),$vTrSum);
$vTrSum=str_replace("@#15",$this->FormatView($vSumLv015,10),$vTrSum);
$vTrSum=str_replace("@#16",$this->FormatView($vSumLv016,10),$vTrSum);
$vTrSum=str_replace("@#17",$this->FormatView($vSumLv017,10),$vTrSum);
$vTrSum=str_replace("@#18",$this->FormatView($vSumLv018,10),$vTrSum);
$vTrSum=str_replace("@#19",$this->FormatView($vSumLv019,10),$vTrSum);
$vTrSum=str_replace("@#20",$this->FormatView($vSumLv020,10),$vTrSum);
$vTrSum=str_replace("@#21",$this->FormatView($vSumLv021,10),$vTrSum);
$vTrSum=str_replace("@#22",$this->FormatView($vSumLv022,10),$vTrSum);
$vTrSum=str_replace("@#23",$this->FormatView($vSumLv023,10),$vTrSum);
$vStrTr=$vStrTr.$vTrSum;
return $vHeader.str_replace("@01",$vStrTr,$vTable).$vFooter;
	}
	function LV_LoadFullSalaryYear($vYear)
	{
		$vArSalaryEmp=Array();
		$vsql="select A.*,month(A.lv005) Months,year(A.lv005) Years,B.lv004 DeptID from tc_lv0021 A left join tc_lv0064 B on A.lv060=B.lv002 and A.lv002=B.lv003  where year(A.lv005)='$vYear'";
		$bResult = db_query($vsql);
		while ($vrow = db_fetch_array ($bResult)){
			$vrow['Months']=Fillnum($vrow['Months'],2);
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['DeptID']=$vrow['DeptID'];
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv033']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv033']+$vrow['lv033']-$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv043']-(1/3)*$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv019']-(1/2)*$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv022']-(2/3)*$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv023'];//Tổng lương
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv024']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv024']+$vrow['lv024'];//Tổng lương
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv057']=$vrow['lv057'];//Cách tính lương làm thêm hay chinh thức
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv023']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv023']+$vrow['lv023'];//Số người giảm trừ
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv066']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv066']+$vrow['lv066'];//Số tiền giảm trừ
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv067']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv067']+$vrow['lv067'];//Mốc tính thuế
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv043']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv043']+$vrow['lv043'];//Mốc tính thuế
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['SumCheckPIT']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['SumCheckPIT']+$vrow['lv066']+$vrow['lv067']+$vrow['lv043'];//Tổng check PIT
			$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv045']=$vArSalaryEmp[$vrow['lv002']][$vrow['Months']]['lv045']+$vrow['lv045'];//PIT
		}
		return $vArSalaryEmp;
		
	}
	function LV_GetEmpPIT($vArSalaryEmp,$vEmpID,$vField='')
	{
		$vSumPIT=0;
		for($vj=0;$vj<=12;$vj++)
		{
			$vSumPIT=$vSumPIT+$vArSalaryEmp[$vEmpID][Fillnum($vj,2)][$vField];
		}
		return $vSumPIT;	
	}
	//////////Get Filter///////////////
	protected function GetConditionQTThue($vYear)
	{
		$this->ListDept=$this->LV_GetDep($this->lv201);
		$strCondi="";
		if($this->lv201!="") $strCondi=$strCondi." and (A.lv001 in (select B.lv003 from tc_lv0064 B inner join tc_lv0013 AG on AG.lv001=B.lv002 where AG.lv007='$vYear' and B.lv004 in (".$this->ListDept.")	))";
		if($this->lv202!="") $strCondi=$strCondi." and (A.lv001 in (select B.lv003 from tc_lv0064 B inner join tc_lv0013 AG on AG.lv001=B.lv002 where AG.lv007='$vYear' and B.lv004 in (".$this->ListDept.")	))";
		return $strCondi;
	}
	function LV_TrichPITFull($vopt=0,$vYear,$vMonth)
	{
		//Lấy dữ liệu lương toàn cty
		$vArSalaryEmp=$this->LV_LoadFullSalaryYear($vYear);
		$vTable='<table style="width: 13242px; text-align: center;" border="1" cellspacing="0" cellpadding="0">
<colgroup><col width="30"></col><col width="72"></col><col width="213"></col><col width="105"></col><col width="127"></col><col width="127"></col><col width="135"></col><col width="117"></col><col width="113"></col><col width="113"></col><col width="117"></col><col width="117"></col><col width="110"></col><col width="110"></col><col width="106"></col><col width="106"></col><col width="126"></col><col width="126"></col><col width="111"></col><col width="111"></col><col width="109"></col><col width="109"></col><col width="114"></col><col width="114"></col><col width="129"></col><col width="129"></col><col span="2" width="109"></col><col width="105"></col><col width="112"></col><col width="69"></col><col width="124"></col><col width="110"></col><col width="99"></col><col width="44"></col><col width="135"></col><col width="100"></col><col width="108"></col><col width="115"></col><col width="103"></col><col width="36"></col><col width="116"></col><col width="59"></col><col width="91"></col><col width="111"></col><col width="94"></col><col width="36"></col><col width="88"></col><col width="59"></col><col width="95"></col><col width="110"></col><col width="98"></col><col width="45"></col><col width="91"></col><col width="59"></col><col width="84"></col><col width="123"></col><col width="98"></col><col width="36"></col><col width="106"></col><col width="87"></col><col width="96"></col><col width="111"></col><col width="97"></col><col width="36"></col><col width="105"></col><col width="61"></col><col width="99"></col><col width="111"></col><col width="91"></col><col width="31"></col><col width="111"></col><col width="59"></col><col width="86"></col><col width="102"></col><col width="92"></col><col width="36"></col><col width="99"></col><col width="59"></col><col width="103"></col><col width="110"></col><col width="93"></col><col width="40"></col><col width="104"></col><col width="59"></col><col width="97"></col><col width="108"></col><col width="93"></col><col width="36"></col><col width="106"></col><col width="59"></col><col width="100"></col><col width="117"></col><col width="103"></col><col width="40"></col><col width="105"></col><col width="78"></col><col width="104"></col><col width="116"></col><col width="101"></col><col width="36"></col><col width="105"></col><col width="74"></col><col width="94"></col><col width="97"></col><col width="92"></col><col width="74"></col><col width="105"></col><col width="75"></col><col width="79"></col><col width="112"></col><col width="112"></col><col width="112"></col><col width="112"></col><col width="93"></col><col width="93"></col><col width="93"></col><col width="93"></col><col width="96"></col><col width="96"></col><col width="107"></col><col width="107"></col><col width="109"></col><col width="109"></col><col width="89"></col><col width="89"></col><col width="101"></col><col width="101"></col><col width="107"></col><col width="88"></col><col width="96"></col><col width="96"></col><col span="2" width="95"></col><col width="113"></col><col width="75"></col><col width="85"></col><col width="123"></col><col width="100"></col></colgroup> 
<tbody>
<tr height="40">
<td rowspan="5" width="30" height="154"><strong style="font-weight: bold;">STT</strong></td>
<td rowspan="5" width="72"><strong style="font-weight: bold;">Mã số</strong></td>
<td rowspan="5" width="213"><strong style="font-weight: bold;">Họ t&ecirc;n</strong></td>
<td rowspan="5" width="105"><strong style="font-weight: bold;">MST</strong></td>
<td colspan="26" width="3011"><strong style="font-weight: bold;"> Thu nhập chịu thuế năm '.$vYear.' </strong></td>
<td colspan="78" width="6760"><strong style="font-weight: bold;"> Các khoản giảm trừ năm '.$vYear.' </strong></td>
<td rowspan="5" width="75"><strong style="font-weight: bold;"> Thu nhập<br />t&iacute;nh thuế<br />năm '.$vYear.' </strong></td>
<td rowspan="5" width="79"><strong style="font-weight: bold;"> Số thuế<br />phải khấu trừ<br />năm '.$vYear.' </strong></td>
<td colspan="25" width="2514"><strong style="font-weight: bold;"> Số thuế đã khấu trừ trong năm '.$vYear.' </strong></td>
<td rowspan="5" width="75"><strong style="font-weight: bold;"> Số thuế <br />nộp thiếu<br />(c&ograve;n phải KT)<br />năm '.$vYear.' </strong></td>
<td rowspan="5" width="85"><strong style="font-weight: bold;"> Số thuế <br />nộp thừa<br />năm '.$vYear.' </strong></td>
<td rowspan="5" width="123"><strong style="font-weight: bold;">Ghi ch&uacute;</strong></td>
<td rowspan="5" width="100"><strong style="font-weight: bold;">CMND</strong></td>
</tr>
<tr height="29">
<td rowspan="4" width="127" height="114"><strong style="font-weight: bold;">Tháng 01</strong></td>
<td rowspan="4" width="127"><strong style="font-weight: bold;">Tháng 01 <br />Thuế 10% </strong></td>
<td rowspan="4" width="135"><strong style="font-weight: bold;"> Tháng 02 </strong></td>
<td rowspan="4" width="117"><strong style="font-weight: bold;">Tháng 02 <br />Thuế 10% </strong></td>
<td rowspan="4" width="113"><strong style="font-weight: bold;"> Tháng 03 </strong></td>
<td rowspan="4" width="113"><strong style="font-weight: bold;">Tháng 03 <br />Thuế 10% </strong></td>
<td rowspan="4" width="117"><strong style="font-weight: bold;"> Tháng 04 </strong></td>
<td rowspan="4" width="117"><strong style="font-weight: bold;">Tháng 04 <br />Thuế 10% </strong></td>
<td rowspan="4" width="110"><strong style="font-weight: bold;"> Tháng 05 </strong></td>
<td rowspan="4" width="110"><strong style="font-weight: bold;">Tháng 05 <br />Thuế 10% </strong></td>
<td rowspan="4" width="106"><strong style="font-weight: bold;">Tháng 06</strong></td>
<td rowspan="4" width="106"><strong style="font-weight: bold;">Tháng 06<br />Thuế 10% </strong></td>
<td rowspan="4" width="126"><strong style="font-weight: bold;">Tháng 07</strong></td>
<td rowspan="4" width="126"><strong style="font-weight: bold;">Tháng 07 <br />Thuế 10% </strong></td>
<td rowspan="4" width="111"><strong style="font-weight: bold;">Tháng 08</strong></td>
<td rowspan="4" width="111"><strong style="font-weight: bold;">Tháng 08<br />Thuế 10% </strong></td>
<td rowspan="4" width="109"><strong style="font-weight: bold;"> Tháng 09 </strong></td>
<td rowspan="4" width="109"><strong style="font-weight: bold;">Tháng 09<br />Thuế 10% </strong></td>
<td rowspan="4" width="114"><strong style="font-weight: bold;"> Tháng 10 </strong></td>
<td rowspan="4" width="114"><strong style="font-weight: bold;">Tháng 10 <br />Thuế 10% </strong></td>
<td rowspan="4" width="129"><strong style="font-weight: bold;"> Tháng 11 </strong></td>
<td rowspan="4" width="129"><strong style="font-weight: bold;">Tháng 11 <br />Thuế 10% </strong></td>
<td rowspan="4" width="109"><strong style="font-weight: bold;"> Tháng 12 </strong></td>
<td rowspan="4" width="109"><strong style="font-weight: bold;">Tháng 12 <br />Thuế 10% </strong></td>
<td rowspan="4" width="105"><strong style="font-weight: bold;"> Những thu nhập chưa t&iacute;nh thuế </strong></td>
<td rowspan="4" width="112"><strong style="font-weight: bold;"> Cộng<br />thu nhập<br />chịu thuế<br />năm '.$vYear.' </strong></td>
<td colspan="6" width="581"><strong style="font-weight: bold;"> Tháng 01 </strong></td>
<td colspan="6" width="578"><strong style="font-weight: bold;"> Tháng 02 </strong></td>
<td colspan="6" width="479"><strong style="font-weight: bold;"> Tháng 03 </strong></td>
<td colspan="6" width="498"><strong style="font-weight: bold;"> Tháng 04 </strong></td>
<td colspan="6" width="506"><strong style="font-weight: bold;"> Tháng 05 </strong></td>
<td colspan="6" width="532"><strong style="font-weight: bold;"> Tháng 06 </strong></td>
<td colspan="6" width="504"><strong style="font-weight: bold;"> Tháng 07 </strong></td>
<td colspan="6" width="474"><strong style="font-weight: bold;"> Tháng 08 </strong></td>
<td colspan="6" width="509"><strong style="font-weight: bold;"> Tháng 09 </strong></td>
<td colspan="6" width="499"><strong style="font-weight: bold;"> Tháng 10 </strong></td>
<td colspan="6" width="524"><strong style="font-weight: bold;"> Tháng 11 </strong></td>
<td colspan="6" width="540"><strong style="font-weight: bold;"> Tháng 12 </strong></td>
<td colspan="6" width="536"><strong style="font-weight: bold;"> Cộng năm '.$vYear.' </strong></td>
<td rowspan="4" width="112"><strong style="font-weight: bold;"> Tháng 01 </strong></td>
<td rowspan="4" width="112"><strong style="font-weight: bold;"> Tháng 01 <br />Thuế 10% </strong></td>
<td rowspan="4" width="112"><strong style="font-weight: bold;"> Tháng 02 </strong></td>
<td rowspan="4" width="112"><strong style="font-weight: bold;"> Tháng 02<br />Thuế 10% </strong></td>
<td rowspan="4" width="93"><strong style="font-weight: bold;"> Tháng 03 </strong></td>
<td rowspan="4" width="93"><strong style="font-weight: bold;"> Tháng 03<br />Thuế 10% </strong></td>
<td rowspan="4" width="93"><strong style="font-weight: bold;"> Tháng 04 </strong></td>
<td rowspan="4" width="93"><strong style="font-weight: bold;"> Tháng 04<br />Thuế 10% </strong></td>
<td rowspan="4" width="96"><strong style="font-weight: bold;"> Tháng 05 </strong></td>
<td rowspan="4" width="96"><strong style="font-weight: bold;"> Tháng 05<br />Thuế 10% </strong></td>
<td rowspan="4" width="107"><strong style="font-weight: bold;"> Tháng 06 </strong></td>
<td rowspan="4" width="107"><strong style="font-weight: bold;"> Tháng 06<br />Thuế 10% </strong></td>
<td rowspan="4" width="109"><strong style="font-weight: bold;"> Tháng 07 </strong></td>
<td rowspan="4" width="109"><strong style="font-weight: bold;"> Tháng 07<br />Thuế 10% </strong></td>
<td rowspan="4" width="89"><strong style="font-weight: bold;"> Tháng 08 </strong></td>
<td rowspan="4" width="89"><strong style="font-weight: bold;"> Tháng 08<br />Thuế 10% </strong></td>
<td rowspan="4" width="101"><strong style="font-weight: bold;"> Tháng 09 </strong></td>
<td rowspan="4" width="101"><strong style="font-weight: bold;"> Tháng 09<br />Thuế 10% </strong></td>
<td rowspan="4" width="107"><strong style="font-weight: bold;"> Tháng 10 </strong></td>
<td rowspan="4" width="88"><strong style="font-weight: bold;"> Tháng 10<br />Thuế 10% </strong></td>
<td rowspan="4" width="96"><strong style="font-weight: bold;"> Tháng 11 </strong></td>
<td rowspan="4" width="96"><strong style="font-weight: bold;"> Tháng 11<br />Thuế 10% </strong></td>
<td rowspan="4" width="95"><strong style="font-weight: bold;"> Tháng 12 </strong></td>
<td rowspan="4" width="95"><strong style="font-weight: bold;"> Tháng 12<br />Thuế 10% </strong></td>
<td rowspan="4" width="113"><strong style="font-weight: bold;"> Cộng<br />số thuế<br />đã khấu trừ<br />năm '.$vYear.' </strong></td>
</tr>
<tr height="19">
<td colspan="3" width="303" height="19"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="99"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="44"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="135"><strong style="font-weight: bold;"> Cộng<br />tháng 01 </strong></td>
<td colspan="3" width="323"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="103"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="116"><strong style="font-weight: bold;"> Cộng<br />tháng 02 </strong></td>
<td colspan="3" width="261"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="94"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="88"><strong style="font-weight: bold;"> Cộng<br />tháng 03 </strong></td>
<td colspan="3" width="264"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="98"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="45"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="91"><strong style="font-weight: bold;"> Cộng<br />tháng 04 </strong></td>
<td colspan="3" width="266"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="98"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="106"><strong style="font-weight: bold;"> Cộng<br />tháng 05 </strong></td>
<td colspan="3" width="294"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="97"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="105"><strong style="font-weight: bold;"> Cộng<br />tháng 06 </strong></td>
<td colspan="3" width="271"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="91"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="31"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="111"><strong style="font-weight: bold;"> Cộng<br />tháng 07 </strong></td>
<td colspan="3" width="247"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="92"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="99"><strong style="font-weight: bold;"> Cộng<br />tháng 08 </strong></td>
<td colspan="3" width="272"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="93"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="40"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="104"><strong style="font-weight: bold;"> Cộng<br />tháng 09 </strong></td>
<td colspan="3" width="264"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="93"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="106"><strong style="font-weight: bold;"> Cộng<br />tháng 10 </strong></td>
<td colspan="3" width="276"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="103"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="40"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="105"><strong style="font-weight: bold;"> Cộng<br />tháng 11 </strong></td>
<td colspan="3" width="298"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="101"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="36"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="105"><strong style="font-weight: bold;"> Cộng<br />tháng 12 </strong></td>
<td colspan="3" width="265"><strong style="font-weight: bold;"> Giảm trừ gia cảnh </strong></td>
<td rowspan="3" width="92"><strong style="font-weight: bold;"> Các khoản<br />bảo hiểm<br />bắt buộc </strong></td>
<td rowspan="3" width="74"><strong style="font-weight: bold;"> Khác </strong></td>
<td rowspan="3" width="105"><strong style="font-weight: bold;"> Cộng<br />các khoản<br />giảm trừ <br />năm '.$vYear.' </strong></td>
</tr>
<tr height="19">
<td colspan="2" width="193" height="19"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="110"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="208"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="115"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="150"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="111"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="154"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="110"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="143"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="123"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="183"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="111"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="160"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="111"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="145"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="102"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="162"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="110"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="156"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="108"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="159"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="117"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="182"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="116"><strong style="font-weight: bold;"> Bản thân </strong></td>
<td colspan="2" width="168"><strong style="font-weight: bold;"> Người phụ thuộc </strong></td>
<td rowspan="2" width="97"><strong style="font-weight: bold;"> Bản thân </strong></td>
</tr>
<tr height="47">
<td width="69" height="47"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="124"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="100"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="108"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="91"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="95"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="84"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="87"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="96"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="61"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="99"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="86"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="103"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="97"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="59"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="100"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="78"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="104"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
<td width="74"><strong style="font-weight: bold;"> Số người<br />phụ thuộc </strong></td>
<td width="94"><strong style="font-weight: bold;"> Số tiền<br /> giảm trừ  </strong></td>
</tr>
@#01
</tbody>
</table>';
$vTr='
<tr height="22">
<td height="22">@#00</td>
<td height="22">'.(($_GET['funcexp']=='excel')?'<Data ss:Type="String">="@#01"</Data>':'@#01').'</td>
<td>@#02</td>
<td>@#03</td>
<td>@#04</td>
<td>@#05</td>
<td>@#06</td>
<td>@#07</td>
<td>@#08</td>
<td>@#09</td>
<td>@#10</td>
<td>@#11</td>
<td>@#12</td>
<td>@#13</td>
<td>@#14</td>
<td>@#15</td>
<td>@#16</td>
<td>@#17</td>
<td>@#18</td>
<td>@#19</td>
<td>@#20</td>
<td>@#21</td>
<td>@#22</td>
<td>@#23</td>
<td>@#24</td>
<td>@#25</td>
<td>@#26</td>
<td>@#27</td>
<td>@#28</td>
<td>@#29</td>
<td>@#30</td>
<td>@#31</td>
<td>@#32</td>
<td>@#33</td>
<td>@#34</td>
<td>@#35</td>
<td>@#36</td>
<td>@#37</td>
<td>@#38</td>
<td>@#39</td>
<td>@#40</td>
<td>@#41</td>
<td>@#42</td>
<td>@#43</td>
<td>@#44</td>
<td>@#45</td>
<td>@#46</td>
<td>@#47</td>
<td>@#48</td>
<td>@#49</td>
<td>@#50</td>
<td>@#51</td>
<td>@#52</td>
<td>@#53</td>
<td>@#54</td>
<td>@#55</td>
<td>@#56</td>
<td>@#57</td>
<td>@#58</td>
<td>@#59</td>
<td>@#60</td>
<td>@#61</td>
<td>@#62</td>
<td>@#63</td>
<td>@#64</td>
<td>@#65</td>
<td>@#66</td>
<td>@#67</td>
<td>@#68</td>
<td>@#69</td>
<td>@#70</td>
<td>@#71</td>
<td>@#72</td>
<td>@#73</td>
<td>@#74</td>
<td>@#75</td>
<td>@#76</td>
<td>@#77</td>
<td>@#78</td>
<td>@#79</td>
<td>@#80</td>
<td>@#81</td>
<td>@#82</td>
<td>@#83</td>
<td>@#84</td>
<td>@#85</td>
<td>@#86</td>
<td>@#87</td>
<td>@#88</td>
<td>@#89</td>
<td>@#90</td>
<td>@#91</td>
<td>@#92</td>
<td>@#93</td>
<td>@#94</td>
<td>@#95</td>
<td>@#96</td>
<td>@#97</td>
<td>@#98</td>
<td>@#99</td>
<td>@01</td>
<td>@02 </td>
<td>@03</td>
<td>@04</td>
<td>@05</td>
<td>@06</td>
<td>@07</td>
<td>@08</td>
<td>@10</td>
<td>@11</td>
<td>@12</td>
<td>@13</td>
<td>@14</td>
<td>@15</td>
<td>@16</td>
<td>@17</td>
<td>@18</td>
<td>@19</td>
<td>@20</td>
<td>@21</td>
<td>@22</td>
<td>@23</td>
<td>@24</td>
<td>@25</td>
<td>@26</td>
<td>@27</td>
<td>@28</td>
<td>@29</td>
<td>@30</td>
<td>@31</td>
<td>@32</td>
<td>@33</td>
<td>@34</td>
<td>@35</td>
<td>@36</td>
<td>@37</td>
<td>@38</td>
<td>@39</td>
<td>@40</td>
</tr>
';
		$vsql="select A.lv001,A.lv002,A.lv013,A.lv010 from hr_lv0020 A where A.lv001 in (select BB.lv002 from tc_lv0021 BB where year(BB.lv005)='$vYear') ".$this->GetConditionQTThue($vYear);
		$bResult=db_query($vsql);
		$i=1;
		$strDepart='';
		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			/*if($strDepart!=$vrow['lv058'].'')
			{
				if($strDepart!='')
				{
					$vOrder=0;
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",$this->FormatView($vlv012_1,20),$vLineOne);

				$strTrH=$strTrH.$vLineOne;
				$strTable=str_replace("@#02",'&nbsp;',$lvTable);
				$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
				$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
				$strTrH='';
				$vlv012_1=0;
				
				}
				$strDepart=$vrow['lv058'];
			}*/
			
			$vOrder++;
			
			$vLineOne=$vTr;
			$vLineOne=str_replace("@#00",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#01",$vrow['lv001'],$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['lv013'],$vLineOne);
			if($vArSalaryEmp[$vrow['lv001']]['01']['lv057']!=2)
			{
				$vlv004=$vArSalaryEmp[$vrow['lv001']]['01']['lv033']+$vArSalaryEmp[$vrow['lv001']]['01']['lv071'];
				$vSum004=$vSum004+$vlv004;
				$vLineOne=str_replace("@#04",$this->FormatView($vlv004,20),$vLineOne);
				$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv005=$vArSalaryEmp[$vrow['lv001']]['01']['lv033']+$vArSalaryEmp[$vrow['lv001']]['01']['lv071'];
				$vSum005=$vSum005+$vlv005;
				$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#05",$this->FormatView($vlv005,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['02']['lv057']!=2)
			{
				$vlv006=$vArSalaryEmp[$vrow['lv001']]['02']['lv033']+$vArSalaryEmp[$vrow['lv001']]['02']['lv071'];
				$vSum006=$vSum006+$vlv006;
				$vLineOne=str_replace("@#06",$this->FormatView($vlv006,20),$vLineOne);
				$vLineOne=str_replace("@#07",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv007=$vArSalaryEmp[$vrow['lv001']]['02']['lv033']+$vArSalaryEmp[$vrow['lv001']]['02']['lv071'];
				$vSum007=$vSum007+$vlv007;
				$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vlv007,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['03']['lv057']!=2)
			{
				$vlv008=$vArSalaryEmp[$vrow['lv001']]['03']['lv033']+$vArSalaryEmp[$vrow['lv001']]['03']['lv071'];
				$vSum008=$vSum008+$vlv008;
				$vLineOne=str_replace("@#08",$this->FormatView($vlv008,20),$vLineOne);
				$vLineOne=str_replace("@#09",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv009=$vArSalaryEmp[$vrow['lv001']]['03']['lv033']+$vArSalaryEmp[$vrow['lv001']]['03']['lv071'];
				$vSum009=$vSum009+$vlv009;
				$vLineOne=str_replace("@#08",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vlv009,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['04']['lv057']!=2)
			{
				$vlv010=$vArSalaryEmp[$vrow['lv001']]['04']['lv033']+$vArSalaryEmp[$vrow['lv001']]['04']['lv071'];
				$vSum010=$vSum010+$vlv010;
				$vLineOne=str_replace("@#10",$this->FormatView($vlv010,20),$vLineOne);
				$vLineOne=str_replace("@#11",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv011=$vArSalaryEmp[$vrow['lv001']]['04']['lv033']+$vArSalaryEmp[$vrow['lv001']]['04']['lv071'];
				$vSum011=$vSum011+$vlv011;
				$vLineOne=str_replace("@#10",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vlv011,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['05']['lv057']!=2)
			{
				$vlv012=$vArSalaryEmp[$vrow['lv001']]['05']['lv033']+$vArSalaryEmp[$vrow['lv001']]['05']['lv071'];
				$vSum012=$vSum012+$vlv012;
				$vLineOne=str_replace("@#12",$this->FormatView($vlv012,20),$vLineOne);
				$vLineOne=str_replace("@#13",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv013=$vArSalaryEmp[$vrow['lv001']]['05']['lv033']+$vArSalaryEmp[$vrow['lv001']]['05']['lv071'];
				$vSum013=$vSum013+$vlv013;
				$vLineOne=str_replace("@#12",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#13",$this->FormatView($vlv013,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['06']['lv057']!=2)
			{
				$vlv014=$vArSalaryEmp[$vrow['lv001']]['06']['lv033']+$vArSalaryEmp[$vrow['lv001']]['06']['lv071'];
				$vSum014=$vSum014+$vlv014;
				$vLineOne=str_replace("@#14",$this->FormatView($vlv014,20),$vLineOne);
				$vLineOne=str_replace("@#15",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv015=$vArSalaryEmp[$vrow['lv001']]['06']['lv033']+$vArSalaryEmp[$vrow['lv001']]['06']['lv071'];
				$vSum015=$vSum015+$vlv015;
				$vLineOne=str_replace("@#14",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#15",$this->FormatView($vlv015,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['07']['lv057']!=2)
			{
				$vlv016=$vArSalaryEmp[$vrow['lv001']]['07']['lv033']+$vArSalaryEmp[$vrow['lv001']]['07']['lv071'];
				$vSum016=$vSum016+$vlv016;
				$vLineOne=str_replace("@#16",$this->FormatView($vlv016,20),$vLineOne);
				$vLineOne=str_replace("@#17",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv017=$vArSalaryEmp[$vrow['lv001']]['07']['lv033']+$vArSalaryEmp[$vrow['lv001']]['07']['lv071'];
				$vSum017=$vSum017+$vlv017;
				$vLineOne=str_replace("@#16",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#17",$this->FormatView($vlv017,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['08']['lv057']!=2)
			{
				$vlv018=$vArSalaryEmp[$vrow['lv001']]['08']['lv033']+$vArSalaryEmp[$vrow['lv001']]['08']['lv071'];
				$vSum018=$vSum018+$vlv018;
				$vLineOne=str_replace("@#18",$this->FormatView($vlv018,20),$vLineOne);
				$vLineOne=str_replace("@#19",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv019=$vArSalaryEmp[$vrow['lv001']]['08']['lv033']+$vArSalaryEmp[$vrow['lv001']]['08']['lv071'];
				$vSum019=$vSum019+$vlv019;
				$vLineOne=str_replace("@#18",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#19",$this->FormatView($vlv019,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['09']['lv057']!=2)
			{
				$vlv020=$vArSalaryEmp[$vrow['lv001']]['09']['lv033']+$vArSalaryEmp[$vrow['lv001']]['09']['lv071'];
				$vSum020=$vSum020+$vlv020;
				$vLineOne=str_replace("@#20",$this->FormatView($vlv020,20),$vLineOne);
				$vLineOne=str_replace("@#21",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv021=$vArSalaryEmp[$vrow['lv001']]['09']['lv033']+$vArSalaryEmp[$vrow['lv001']]['09']['lv071'];
				$vSum021=$vSum021+$vlv021;
				$vLineOne=str_replace("@#20",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#21",$this->FormatView($vlv021,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['10']['lv057']!=2)
			{
				$vlv022=$vArSalaryEmp[$vrow['lv001']]['10']['lv033']+$vArSalaryEmp[$vrow['lv001']]['10']['lv071'];
				$vSum022=$vSum022+$vlv022;
				$vLineOne=str_replace("@#22",$this->FormatView($vlv022,20),$vLineOne);
				$vLineOne=str_replace("@#23",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv023=$vArSalaryEmp[$vrow['lv001']]['10']['lv033']+$vArSalaryEmp[$vrow['lv001']]['10']['lv071'];
				$vSum023=$vSum023+$vlv023;
				$vLineOne=str_replace("@#22",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#23",$this->FormatView($vlv023,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['11']['lv057']!=2)
			{
				$vlv024=$vArSalaryEmp[$vrow['lv001']]['11']['lv033']+$vArSalaryEmp[$vrow['lv001']]['11']['lv071'];
				$vSum024=$vSum024+$vlv024;
				$vLineOne=str_replace("@#24",$this->FormatView($vlv024,20),$vLineOne);
				$vLineOne=str_replace("@#25",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv025=$vArSalaryEmp[$vrow['lv001']]['11']['lv033']+$vArSalaryEmp[$vrow['lv001']]['11']['lv071'];
				$vSum025=$vSum025+$vlv025;
				$vLineOne=str_replace("@#24",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#25",$this->FormatView($vlv025,20),$vLineOne);
			}
			if($vArSalaryEmp[$vrow['lv001']]['12']['lv057']!=2)
			{
				$vlv026=$vArSalaryEmp[$vrow['lv001']]['12']['lv033']+$vArSalaryEmp[$vrow['lv001']]['12']['lv071'];
				$vSum026=$vSum026+$vlv026;
				$vLineOne=str_replace("@#26",$this->FormatView($vlv026,20),$vLineOne);
				$vLineOne=str_replace("@#27",'&nbsp;',$vLineOne);
			}
			else
			{
				$vlv027=$vArSalaryEmp[$vrow['lv001']]['12']['lv033']+$vArSalaryEmp[$vrow['lv001']]['12']['lv071'];
				$vSum027=$vSum027+$vlv027;
				$vLineOne=str_replace("@#26",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#27",$this->FormatView($vlv027,20),$vLineOne);
			}
			
			$vLineOne=str_replace("@#28",'&nbsp;',$vLineOne);
			$vlv030=$vArSalaryEmp[$vrow['lv001']]['01']['lv065'];
			$vSum030=$vSum030+$vlv030;
			$vLineOne=str_replace("@#30",$this->FormatView($vlv030,20),$vLineOne);
			$vlv031=$vArSalaryEmp[$vrow['lv001']]['01']['lv066'];
			$vSum031=$vSum031+$vlv031;
			$vLineOne=str_replace("@#31",$this->FormatView($vlv031,20),$vLineOne);
			$vlv032=$vArSalaryEmp[$vrow['lv001']]['01']['lv067'];
			$vSum032=$vSum032+$vlv032;
			$vLineOne=str_replace("@#32",$this->FormatView($vlv032,20),$vLineOne);
			$vlv033=$vArSalaryEmp[$vrow['lv001']]['01']['lv043'];
			$vSum033=$vSum033+$vlv033;
			$vLineOne=str_replace("@#33",$this->FormatView($vlv033,20),$vLineOne);
			$vlv034=$vArSalaryEmp[$vrow['lv001']]['01']['Other'];
			$vSum034=$vSum034+$vlv034;
			$vLineOne=str_replace("@#34",$this->FormatView($vlv034,20),$vLineOne);
			$vlv035=$vArSalaryEmp[$vrow['lv001']]['01']['SumCheckPIT'];
			$vSum035=$vSum035+$vlv035;
			$vLineOne=str_replace("@#35",$this->FormatView($vlv035,20),$vLineOne);
			
			$vlv036=$vArSalaryEmp[$vrow['lv001']]['02']['lv065'];
			$vSum036=$vSum036+$vlv036;
			$vLineOne=str_replace("@#36",$this->FormatView($vlv036,20),$vLineOne);
			$vlv037=$vArSalaryEmp[$vrow['lv001']]['02']['lv066'];
			$vSum037=$vSum037+$vlv037;
			$vLineOne=str_replace("@#37",$this->FormatView($vlv037,20),$vLineOne);
			$vlv038=$vArSalaryEmp[$vrow['lv001']]['02']['lv067'];
			$vSum038=$vSum038+$vlv038;
			$vLineOne=str_replace("@#38",$this->FormatView($vlv038,20),$vLineOne);
			$vlv039=$vArSalaryEmp[$vrow['lv001']]['02']['lv043'];
			$vSum039=$vSum039+$vlv039;
			$vLineOne=str_replace("@#39",$this->FormatView($vlv039,20),$vLineOne);
			$vlv040=$vArSalaryEmp[$vrow['lv001']]['02']['Other'];
			$vSum040=$vSum040+$vlv040;
			$vLineOne=str_replace("@#40",$this->FormatView($vlv040,20),$vLineOne);
			$vlv041=$vArSalaryEmp[$vrow['lv001']]['02']['SumCheckPIT'];
			$vSum041=$vSum041+$vlv041;
			$vLineOne=str_replace("@#41",$this->FormatView($vlv041,20),$vLineOne);
			
			$vlv042=$vArSalaryEmp[$vrow['lv001']]['03']['lv065'];
			$vSum042=$vSum042+$vlv042;
			$vLineOne=str_replace("@#42",$this->FormatView($vlv042,20),$vLineOne);
			$vlv043=$vArSalaryEmp[$vrow['lv001']]['03']['lv066'];
			$vSum043=$vSum043+$vlv043;
			$vLineOne=str_replace("@#43",$this->FormatView($vlv043,20),$vLineOne);
			$vlv044=$vArSalaryEmp[$vrow['lv001']]['03']['lv067'];
			$vSum044=$vSum044+$vlv044;
			$vLineOne=str_replace("@#44",$this->FormatView($vlv044,20),$vLineOne);
			$vlv045=$vArSalaryEmp[$vrow['lv001']]['03']['lv065'];
			$vSum045=$vSum045+$vlv045;
			$vLineOne=str_replace("@#45",$this->FormatView($vlv045,20),$vLineOne);
			$vlv046=$vArSalaryEmp[$vrow['lv001']]['03']['Other'];
			$vSum046=$vSum046+$vlv046;
			$vLineOne=str_replace("@#46",$this->FormatView($vlv046,20),$vLineOne);
			$vlv047=$vArSalaryEmp[$vrow['lv001']]['03']['SumCheckPIT'];
			$vSum047=$vSum047+$vlv047;
			$vLineOne=str_replace("@#47",$this->FormatView($vlv047,20),$vLineOne);
			
			$vlv048=$vArSalaryEmp[$vrow['lv001']]['04']['lv065'];
			$vSum048=$vSum048+$vlv048;
			$vLineOne=str_replace("@#48",$this->FormatView($vlv048,20),$vLineOne);
			$vlv049=$vArSalaryEmp[$vrow['lv001']]['04']['lv066'];
			$vSum049=$vSum049+$vlv049;
			$vLineOne=str_replace("@#49",$this->FormatView($vlv049,20),$vLineOne);
			$vlv050=$vArSalaryEmp[$vrow['lv001']]['04']['lv067'];
			$vSum050=$vSum050+$vlv050;
			$vLineOne=str_replace("@#50",$this->FormatView($vlv050,20),$vLineOne);
			$vlv051=$vArSalaryEmp[$vrow['lv001']]['04']['lv065'];
			$vSum051=$vSum051+$vlv051;
			$vLineOne=str_replace("@#51",$this->FormatView($vlv051,20),$vLineOne);
			$vlv052=$vArSalaryEmp[$vrow['lv001']]['04']['Other'];
			$vSum052=$vSum052+$vlv052;
			$vLineOne=str_replace("@#52",$this->FormatView($vlv052,20),$vLineOne);
			$vlv053=$vArSalaryEmp[$vrow['lv001']]['04']['SumCheckPIT'];
			$vSum053=$vSum053+$vlv053;
			$vLineOne=str_replace("@#53",$this->FormatView($vlv053,20),$vLineOne);
			
			$vlv054=$vArSalaryEmp[$vrow['lv001']]['05']['lv065'];
			$vSum054=$vSum054+$vlv054;
			$vLineOne=str_replace("@#54",$this->FormatView($vlv054,20),$vLineOne);
			$vlv055=$vArSalaryEmp[$vrow['lv001']]['05']['lv066'];
			$vSum055=$vSum055+$vlv055;
			$vLineOne=str_replace("@#55",$this->FormatView($vlv055,20),$vLineOne);
			$vlv056=$vArSalaryEmp[$vrow['lv001']]['05']['lv067'];
			$vSum056=$vSum056+$vlv056;
			$vLineOne=str_replace("@#56",$this->FormatView($vlv056,20),$vLineOne);
			$vlv057=$vArSalaryEmp[$vrow['lv001']]['05']['lv065'];
			$vSum057=$vSum057+$vlv057;
			$vLineOne=str_replace("@#57",$this->FormatView($vlv057,20),$vLineOne);
			$vlv058=$vArSalaryEmp[$vrow['lv001']]['05']['Other'];
			$vSum058=$vSum058+$vlv058;
			$vLineOne=str_replace("@#58",$this->FormatView($vlv058,20),$vLineOne);
			$vlv059=$vArSalaryEmp[$vrow['lv001']]['05']['SumCheckPIT'];
			$vSum059=$vSum059+$vlv059;
			$vLineOne=str_replace("@#59",$this->FormatView($vlv059,20),$vLineOne);
			
			$vlv060=$vArSalaryEmp[$vrow['lv001']]['06']['lv065'];
			$vSum060=$vSum060+$vlv060;
			$vLineOne=str_replace("@#60",$this->FormatView($vlv060,20),$vLineOne);
			$vlv061=$vArSalaryEmp[$vrow['lv001']]['06']['lv066'];
			$vSum061=$vSum061+$vlv061;
			$vLineOne=str_replace("@#61",$this->FormatView($vlv061,20),$vLineOne);
			$vlv062=$vArSalaryEmp[$vrow['lv001']]['06']['lv067'];
			$vSum062=$vSum062+$vlv062;
			$vLineOne=str_replace("@#62",$this->FormatView($vlv062,20),$vLineOne);
			$vlv063=$vArSalaryEmp[$vrow['lv001']]['06']['lv043'];
			$vSum063=$vSum063+$vlv063;
			$vLineOne=str_replace("@#63",$this->FormatView($vlv063,20),$vLineOne);
			$vlv064=$vArSalaryEmp[$vrow['lv001']]['06']['Other'];
			$vSum064=$vSum064+$vlv064;
			$vLineOne=str_replace("@#64",$this->FormatView($vlv064,20),$vLineOne);
			$vlv065=$vArSalaryEmp[$vrow['lv001']]['06']['SumCheckPIT'];
			$vSum065=$vSum065+$vlv065;
			$vLineOne=str_replace("@#65",$this->FormatView($vlv065,20),$vLineOne);
			
			$vlv066=$vArSalaryEmp[$vrow['lv001']]['07']['lv065'];
			$vSum066=$vSum066+$vlv066;
			$vLineOne=str_replace("@#66",$this->FormatView($vlv066,20),$vLineOne);
			$vlv067=$vArSalaryEmp[$vrow['lv001']]['07']['lv066'];
			$vSum067=$vSum067+$vlv067;
			$vLineOne=str_replace("@#67",$this->FormatView($vlv067,20),$vLineOne);
			$vlv068=$vArSalaryEmp[$vrow['lv001']]['07']['lv067'];
			$vSum068=$vSum068+$vlv068;
			$vLineOne=str_replace("@#68",$this->FormatView($vlv068,20),$vLineOne);
			$vlv069=$vArSalaryEmp[$vrow['lv001']]['07']['lv043'];
			$vSum069=$vSum069+$vlv069;
			$vLineOne=str_replace("@#69",$this->FormatView($vlv069,20),$vLineOne);
			$vlv070=$vArSalaryEmp[$vrow['lv001']]['07']['Other'];
			$vSum070=$vSum070+$vlv070;
			$vLineOne=str_replace("@#70",$this->FormatView($vlv070,20),$vLineOne);
			$vlv071=$vArSalaryEmp[$vrow['lv001']]['07']['SumCheckPIT'];
			$vSum071=$vSum071+$vlv071;
			$vLineOne=str_replace("@#71",$this->FormatView($vlv071,20),$vLineOne);
			
			$vlv072=$vArSalaryEmp[$vrow['lv001']]['08']['lv065'];
			$vSum072=$vSum072+$vlv072;
			$vLineOne=str_replace("@#72",$this->FormatView($vlv072,20),$vLineOne);
			$vlv073=$vArSalaryEmp[$vrow['lv001']]['08']['lv066'];
			$vSum073=$vSum073+$vlv073;
			$vLineOne=str_replace("@#73",$this->FormatView($vlv073,20),$vLineOne);
			$vlv074=$vArSalaryEmp[$vrow['lv001']]['08']['lv067'];
			$vSum074=$vSum074+$vlv074;
			$vLineOne=str_replace("@#74",$this->FormatView($vlv074,20),$vLineOne);
			$vlv075=$vArSalaryEmp[$vrow['lv001']]['08']['lv043'];
			$vSum075=$vSum075+$vlv075;
			$vLineOne=str_replace("@#75",$this->FormatView($vlv075,20),$vLineOne);
			$vlv076=$vArSalaryEmp[$vrow['lv001']]['08']['Other'];
			$vSum076=$vSum076+$vlv076;
			$vLineOne=str_replace("@#76",$this->FormatView($vlv076,20),$vLineOne);
			$vlv077=$vArSalaryEmp[$vrow['lv001']]['08']['SumCheckPIT'];
			$vSum077=$vSum077+$vlv077;
			$vLineOne=str_replace("@#77",$this->FormatView($vlv077,20),$vLineOne);
			
			$vlv078=$vArSalaryEmp[$vrow['lv001']]['09']['lv065'];
			$vSum078=$vSum078+$vlv078;
			$vLineOne=str_replace("@#78",$this->FormatView($vlv078,20),$vLineOne);
			$vlv079=$vArSalaryEmp[$vrow['lv001']]['09']['lv066'];
			$vSum079=$vSum079+$vlv079;
			$vLineOne=str_replace("@#79",$this->FormatView($vlv079,20),$vLineOne);
			$vlv080=$vArSalaryEmp[$vrow['lv001']]['09']['lv067'];
			$vSum080=$vSum080+$vlv080;
			$vLineOne=str_replace("@#80",$this->FormatView($vlv080,20),$vLineOne);
			$vlv081=$vArSalaryEmp[$vrow['lv001']]['09']['lv043'];
			$vSum081=$vSum081+$vlv081;
			$vLineOne=str_replace("@#81",$this->FormatView($vlv081,20),$vLineOne);
			$vlv082=$vArSalaryEmp[$vrow['lv001']]['09']['Other'];
			$vSum082=$vSum082+$vlv082;
			$vLineOne=str_replace("@#82",$this->FormatView($vSum082,20),$vLineOne);
			$vlv083=$vArSalaryEmp[$vrow['lv001']]['09']['SumCheckPIT'];
			$vSum083=$vSum083+$vlv083;
			$vLineOne=str_replace("@#83",$this->FormatView($vlv083,20),$vLineOne);
			
			$vlv084=$vArSalaryEmp[$vrow['lv001']]['10']['lv065'];
			$vSum084=$vSum084+$vlv084;
			$vLineOne=str_replace("@#84",$this->FormatView($vlv084,20),$vLineOne);
			$vlv085=$vArSalaryEmp[$vrow['lv001']]['10']['lv066'];
			$vSum085=$vSum085+$vlv085;
			$vLineOne=str_replace("@#85",$this->FormatView($vlv085,20),$vLineOne);
			$vlv086=$vArSalaryEmp[$vrow['lv001']]['10']['lv067'];
			$vSum086=$vSum086+$vlv086;
			$vLineOne=str_replace("@#86",$this->FormatView($vlv086,20),$vLineOne);
			$vlv087=$vArSalaryEmp[$vrow['lv001']]['10']['lv043'];
			$vSum087=$vSum087+$vlv087;
			$vLineOne=str_replace("@#87",$this->FormatView($vlv087,20),$vLineOne);
			$vlv088=$vArSalaryEmp[$vrow['lv001']]['10']['Other'];
			$vSum088=$vSum088+$vlv088;
			$vLineOne=str_replace("@#88",$this->FormatView($vSum088,20),$vLineOne);
			$vlv089=$vArSalaryEmp[$vrow['lv001']]['10']['SumCheckPIT'];
			$vSum089=$vSum089+$vlv089;
			$vLineOne=str_replace("@#89",$this->FormatView($vlv089,20),$vLineOne);
			
			$vlv090=$vArSalaryEmp[$vrow['lv001']]['11']['lv065'];
			$vSum090=$vSum090+$vlv090;
			$vLineOne=str_replace("@#90",$this->FormatView($vlv090,20),$vLineOne);
			$vlv091=$vArSalaryEmp[$vrow['lv001']]['11']['lv066'];
			$vSum091=$vSum091+$vlv091;
			$vLineOne=str_replace("@#91",$this->FormatView($vlv091,20),$vLineOne);
			$vlv092=$vArSalaryEmp[$vrow['lv001']]['11']['lv067'];
			$vSum092=$vSum092+$vlv092;
			$vLineOne=str_replace("@#92",$this->FormatView($vlv092,20),$vLineOne);
			$vlv093=$vArSalaryEmp[$vrow['lv001']]['11']['lv043'];
			$vSum093=$vSum093+$vlv093;
			$vLineOne=str_replace("@#93",$this->FormatView($vlv093,20),$vLineOne);
			$vlv094=$vArSalaryEmp[$vrow['lv001']]['11']['Other'];
			$vSum094=$vSum094+$vlv094;
			$vLineOne=str_replace("@#94",$this->FormatView($vlv094,20),$vLineOne);
			$vlv095=$vArSalaryEmp[$vrow['lv001']]['11']['SumCheckPIT'];
			$vSum095=$vSum095+$vlv095;
			$vLineOne=str_replace("@#95",$this->FormatView($vlv095,20),$vLineOne);
			
			$vlv096=$vArSalaryEmp[$vrow['lv001']]['12']['lv065'];
			$vSum096=$vSum096+$vlv096;
			$vLineOne=str_replace("@#96",$this->FormatView($vlv096,20),$vLineOne);
			$vlv097=$vArSalaryEmp[$vrow['lv001']]['12']['lv066'];
			$vSum097=$vSum097+$vlv097;
			$vLineOne=str_replace("@#97",$this->FormatView($vlv097,20),$vLineOne);
			$vlv098=$vArSalaryEmp[$vrow['lv001']]['12']['lv067'];
			$vSum098=$vSum098+$vlv098;
			$vLineOne=str_replace("@#98",$this->FormatView($vlv098,20),$vLineOne);
			$vlv099=$vArSalaryEmp[$vrow['lv001']]['12']['lv043'];
			$vSum099=$vSum099+$vlv099;
			$vLineOne=str_replace("@#99",$this->FormatView($vlv099,20),$vLineOne);
			$vlv101=$vArSalaryEmp[$vrow['lv001']]['12']['Other'];
			$vSum101=$vSum101+$vlv101;
			$vLineOne=str_replace("@01",$this->FormatView($vlv101,20),$vLineOne);
			$vlv102=$vArSalaryEmp[$vrow['lv001']]['12']['SumCheckPIT'];
			$vSum102=$vSum102+$vlv102;
			$vLineOne=str_replace("@02",$this->FormatView($vlv102,20),$vLineOne);
			
			
			$vlv103=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'lv065');
			$vSum103=$vSum103+$vlv103;
			$vLineOne=str_replace("@03",$this->FormatView($vlv103,20),$vLineOne);
			$vlv104=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'lv066');
			$vSum104=$vSum104+$vlv104;
			$vLineOne=str_replace("@04",$this->FormatView($vlv104,20),$vLineOne);
			$vlv105=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'lv067');
			$vSum105=$vSum105+$vlv105;
			$vLineOne=str_replace("@05",$this->FormatView($vlv105,20),$vLineOne);
			$vlv106=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'lv043');
			$vSum106=$vSum106+$vlv106;
			$vLineOne=str_replace("@06",$this->FormatView($vlv106,20),$vLineOne);
			$vlv107=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'Other');
			$vSum107=$vSum107+$vlv107;
			$vLineOne=str_replace("@07",$this->FormatView($vlv107,20),$vLineOne);
			
			$vSumKhauTru=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'SumCheckPIT');
			$vlv108=$vSumKhauTru;
			$vSum108=$vSum108+$vlv108;
			$vLineOne=str_replace("@08",$this->FormatView($vSumKhauTru,20),$vLineOne);
			
			$vSumTruocThue=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'lv033');
			$vlv029=$vSumTruocThue;
			$vSum029=$vSum029+$vlv029;
			//$vLineOne=str_replace("@#28",$this->FormatView(0,20),$vLineOne);
			$vLineOne=str_replace("@#29",$this->FormatView($vSumTruocThue,20),$vLineOne);
			$vTienTinhThue=($vSumTruocThue>$vSumKhauTru)?$vSumTruocThue-$vSumKhauTru:0;
			$vlv110=$vTienTinhThue;
			$vSum110=$vSum110+$vlv110;
			$vLineOne=str_replace("@10",$this->FormatView($vTienTinhThue,20),$vLineOne);
			$vSumTienThue=$this->LV_GetEmpPIT($vArSalaryEmp,$vrow['lv001'],'lv045');
			$vlv136=$vSumTienThue;
			$vSum136=$vSum136+$vlv136;
			$vLineOne=str_replace("@36",$this->FormatView($vSumTienThue,20),$vLineOne);
			
			if($vArSalaryEmp[$vrow['lv001']]['01']['lv057']!=2)
			{
				$vlv112=$vArSalaryEmp[$vrow['lv001']]['01']['lv045'];
				$vSum112=$vSum112+$vlv112;
				$vLineOne=str_replace("@12",$this->FormatView($vlv112,20),$vLineOne);	
				$vLineOne=str_replace("@13",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv112=$vArSalaryEmp[$vrow['lv001']]['01']['lv045'];
				$vSum112=$vSum112+$vlv112;
				$vLineOne=str_replace("@12",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@13",$this->FormatView($vArSalaryEmp[$vrow['lv001']]['01']['lv045'],20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['02']['lv057']!=2)
			{
				$vlv114=$vArSalaryEmp[$vrow['lv001']]['02']['lv045'];
				$vSum114=$vSum114+$vlv114;
				$vLineOne=str_replace("@14",$this->FormatView($vlv114,20),$vLineOne);	
				$vLineOne=str_replace("@15",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv115=$vArSalaryEmp[$vrow['lv001']]['02']['lv045'];
				$vSum115=$vSum115+$vlv115;
				$vLineOne=str_replace("@14",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@15",$this->FormatView($vlv115,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['03']['lv057']!=2)
			{
				$vlv116=$vArSalaryEmp[$vrow['lv001']]['03']['lv045'];
				$vSum116=$vSum116+$vlv116;
				$vLineOne=str_replace("@16",$this->FormatView($vlv116,20),$vLineOne);	
				$vLineOne=str_replace("@17",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv117=$vArSalaryEmp[$vrow['lv001']]['03']['lv045'];
				$vSum117=$vSum117+$vlv117;
				$vLineOne=str_replace("@16",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@17",$this->FormatView($vlv117,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['04']['lv057']!=2)
			{
				$vlv118=$vArSalaryEmp[$vrow['lv001']]['04']['lv045'];
				$vSum118=$vSum118+$vlv118;
				$vLineOne=str_replace("@18",$this->FormatView($vlv118,20),$vLineOne);	
				$vLineOne=str_replace("@19",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv119=$vArSalaryEmp[$vrow['lv001']]['04']['lv045'];
				$vSum119=$vSum119+$vlv119;
				$vLineOne=str_replace("@18",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@19",$this->FormatView($vlv119,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['05']['lv057']!=2)
			{
				$vlv120=$vArSalaryEmp[$vrow['lv001']]['05']['lv045'];
				$vSum120=$vSum120+$vlv120;
				$vLineOne=str_replace("@20",$this->FormatView($vlv120,20),$vLineOne);	
				$vLineOne=str_replace("@21",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv121=$vArSalaryEmp[$vrow['lv001']]['05']['lv045'];
				$vSum121=$vSum121+$vlv121;
				$vLineOne=str_replace("@20",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@21",$this->FormatView($vlv121,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['06']['lv057']!=2)
			{
				$vlv122=$vArSalaryEmp[$vrow['lv001']]['06']['lv045'];
				$vSum122=$vSum122+$vlv122;
				$vLineOne=str_replace("@22",$this->FormatView($vlv122,20),$vLineOne);	
				$vLineOne=str_replace("@23",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv123=$vArSalaryEmp[$vrow['lv001']]['06']['lv045'];
				$vSum123=$vSum123+$vlv123;
				$vLineOne=str_replace("@22",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@23",$this->FormatView($vlv123,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['07']['lv057']!=2)
			{
				$vlv124=$vArSalaryEmp[$vrow['lv001']]['07']['lv045'];
				$vSum124=$vSum124+$vlv124;
				$vLineOne=str_replace("@24",$this->FormatView($vlv124,20),$vLineOne);	
				$vLineOne=str_replace("@25",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv125=$vArSalaryEmp[$vrow['lv001']]['07']['lv045'];
				$vSum125=$vSum125+$vlv125;
				$vLineOne=str_replace("@24",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@25",$this->FormatView($vlv125,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['08']['lv057']!=2)
			{
				$vlv126=$vArSalaryEmp[$vrow['lv001']]['08']['lv045'];
				$vSum126=$vSum126+$vlv126;
				$vLineOne=str_replace("@26",$this->FormatView($vlv126,20),$vLineOne);	
				$vLineOne=str_replace("@27",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv127=$vArSalaryEmp[$vrow['lv001']]['08']['lv045'];
				$vSum127=$vSum127+$vlv127;
				$vLineOne=str_replace("@26",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@27",$this->FormatView($vlv127,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['09']['lv057']!=2)
			{
				$vlv128=$vArSalaryEmp[$vrow['lv001']]['09']['lv045'];
				$vSum128=$vSum128+$vlv128;
				$vLineOne=str_replace("@28",$this->FormatView($vlv128,20),$vLineOne);	
				$vLineOne=str_replace("@29",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv129=$vArSalaryEmp[$vrow['lv001']]['09']['lv045'];
				$vSum129=$vSum129+$vlv129;
				$vLineOne=str_replace("@28",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@29",$this->FormatView($vlv129,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['10']['lv057']!=2)
			{
				$vlv130=$vArSalaryEmp[$vrow['lv001']]['10']['lv045'];
				$vSum130=$vSum130+$vlv130;
				$vLineOne=str_replace("@30",$this->FormatView($vlv130,20),$vLineOne);	
				$vLineOne=str_replace("@31",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv131=$vArSalaryEmp[$vrow['lv001']]['10']['lv045'];
				$vSum131=$vSum131+$vlv131;
				$vLineOne=str_replace("@30",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@31",$this->FormatView($vlv131,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['11']['lv057']!=2)
			{
				$vlv132=$vArSalaryEmp[$vrow['lv001']]['11']['lv045'];
				$vSum132=$vSum132+$vlv132;
				$vLineOne=str_replace("@32",$this->FormatView($vlv132,20),$vLineOne);	
				$vLineOne=str_replace("@33",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv133=$vArSalaryEmp[$vrow['lv001']]['11']['lv045'];
				$vSum133=$vSum133+$vlv133;
				$vLineOne=str_replace("@32",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@33",$this->FormatView($vlv133,20),$vLineOne);	
			}
			if($vArSalaryEmp[$vrow['lv001']]['12']['lv057']!=2)
			{
				$vlv134=$vArSalaryEmp[$vrow['lv001']]['12']['lv045'];
				$vSum134=$vSum134+$vlv134;
				$vLineOne=str_replace("@34",$this->FormatView($vlv134,20),$vLineOne);	
				$vLineOne=str_replace("@35",$this->FormatView(0,20),$vLineOne);	
			}
			else
			{
				$vlv135=$vArSalaryEmp[$vrow['lv001']]['12']['lv045'];
				$vSum135=$vSum135+$vlv135;
				$vLineOne=str_replace("@34",$this->FormatView(0,20),$vLineOne);	
				$vLineOne=str_replace("@35",$this->FormatView($vlv135,20),$vLineOne);	
			}

			$vLineOne=str_replace("@11",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@37",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@38",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@39",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@40",$vrow['lv010'],$vLineOne);	
			
			$strLine=$strLine.$vLineOne;
			
		}
		$vLineOne=$vTr;
			$vLineOne=str_replace("@#00",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#01",'',$vLineOne);
			$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
			$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
			
			$vLineOne=str_replace("@#04",$this->FormatView($vSum004,20),$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vSum005,20),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vSum006,20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vSum007,20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vSum008,20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vSum009,20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vSum010,20),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vSum011,20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vSum012,20),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vSum013,20),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vSum014,20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vSum015,20),$vLineOne);
			$vLineOne=str_replace("@#16",$this->FormatView($vSum016,20),$vLineOne);
			$vLineOne=str_replace("@#17",$this->FormatView($vSum017,20),$vLineOne);
			$vLineOne=str_replace("@#18",$this->FormatView($vSum018,20),$vLineOne);
			$vLineOne=str_replace("@#19",$this->FormatView($vSum019,20),$vLineOne);
			$vLineOne=str_replace("@#20",$this->FormatView($vSum020,20),$vLineOne);
			$vLineOne=str_replace("@#21",$this->FormatView($vSum021,20),$vLineOne);
			$vLineOne=str_replace("@#22",$this->FormatView($vSum022,20),$vLineOne);
			$vLineOne=str_replace("@#23",$this->FormatView($vSum023,20),$vLineOne);
			$vLineOne=str_replace("@#24",$this->FormatView($vSum024,20),$vLineOne);
			$vLineOne=str_replace("@#25",$this->FormatView($vSum025,20),$vLineOne);
			$vLineOne=str_replace("@#26",$this->FormatView($vSum026,20),$vLineOne);
			$vLineOne=str_replace("@#27",$this->FormatView($vSum027,20),$vLineOne);
			$vLineOne=str_replace("@#28",$this->FormatView($vSum028,20),$vLineOne);
			$vLineOne=str_replace("@#29",$this->FormatView($vSum029,20),$vLineOne);
			$vLineOne=str_replace("@#30",$this->FormatView($vSum030,20),$vLineOne);
			$vLineOne=str_replace("@#31",$this->FormatView($vSum031,20),$vLineOne);
			$vLineOne=str_replace("@#32",$this->FormatView($vSum032,20),$vLineOne);
			$vLineOne=str_replace("@#33",$this->FormatView($vSum033,20),$vLineOne);
			$vLineOne=str_replace("@#34",$this->FormatView($vSum034,20),$vLineOne);
			$vLineOne=str_replace("@#35",$this->FormatView($vSum035,20),$vLineOne);
			$vLineOne=str_replace("@#36",$this->FormatView($vSum036,20),$vLineOne);
			$vLineOne=str_replace("@#37",$this->FormatView($vSum037,20),$vLineOne);
			$vLineOne=str_replace("@#38",$this->FormatView($vSum038,20),$vLineOne);
			$vLineOne=str_replace("@#39",$this->FormatView($vSum039,20),$vLineOne);
			$vLineOne=str_replace("@#40",$this->FormatView($vSum040,20),$vLineOne);
			$vLineOne=str_replace("@#41",$this->FormatView($vSum041,20),$vLineOne);
			$vLineOne=str_replace("@#42",$this->FormatView($vSum042,20),$vLineOne);
			$vLineOne=str_replace("@#43",$this->FormatView($vSum043,20),$vLineOne);
			$vLineOne=str_replace("@#44",$this->FormatView($vSum044,20),$vLineOne);
			$vLineOne=str_replace("@#45",$this->FormatView($vSum045,20),$vLineOne);
			$vLineOne=str_replace("@#46",$this->FormatView($vSum046,20),$vLineOne);
			$vLineOne=str_replace("@#47",$this->FormatView($vSum047,20),$vLineOne);
			$vLineOne=str_replace("@#48",$this->FormatView($vSum048,20),$vLineOne);
			$vLineOne=str_replace("@#49",$this->FormatView($vSum049,20),$vLineOne);
			$vLineOne=str_replace("@#50",$this->FormatView($vSum050,20),$vLineOne);
			$vLineOne=str_replace("@#51",$this->FormatView($vSum051,20),$vLineOne);
			$vLineOne=str_replace("@#52",$this->FormatView($vSum052,20),$vLineOne);
			$vLineOne=str_replace("@#53",$this->FormatView($vSum053,20),$vLineOne);
			$vLineOne=str_replace("@#54",$this->FormatView($vSum054,20),$vLineOne);
			$vLineOne=str_replace("@#55",$this->FormatView($vSum055,20),$vLineOne);
			$vLineOne=str_replace("@#56",$this->FormatView($vSum056,20),$vLineOne);
			$vLineOne=str_replace("@#57",$this->FormatView($vSum057,20),$vLineOne);
			$vLineOne=str_replace("@#58",$this->FormatView($vSum058,20),$vLineOne);
			$vLineOne=str_replace("@#59",$this->FormatView($vSum059,20),$vLineOne);
			$vLineOne=str_replace("@#60",$this->FormatView($vSum060,20),$vLineOne);
			$vLineOne=str_replace("@#61",$this->FormatView($vSum061,20),$vLineOne);
			$vLineOne=str_replace("@#62",$this->FormatView($vSum062,20),$vLineOne);
			$vLineOne=str_replace("@#63",$this->FormatView($vSum063,20),$vLineOne);
			$vLineOne=str_replace("@#64",$this->FormatView($vSum064,20),$vLineOne);
			$vLineOne=str_replace("@#65",$this->FormatView($vSum065,20),$vLineOne);
			$vLineOne=str_replace("@#66",$this->FormatView($vSum066,20),$vLineOne);
			$vLineOne=str_replace("@#67",$this->FormatView($vSum067,20),$vLineOne);
			$vLineOne=str_replace("@#68",$this->FormatView($vSum068,20),$vLineOne);
			$vLineOne=str_replace("@#69",$this->FormatView($vSum069,20),$vLineOne);
			$vLineOne=str_replace("@#70",$this->FormatView($vSum070,20),$vLineOne);
			$vLineOne=str_replace("@#71",$this->FormatView($vSum071,20),$vLineOne);
			$vLineOne=str_replace("@#72",$this->FormatView($vSum072,20),$vLineOne);
			$vLineOne=str_replace("@#73",$this->FormatView($vSum073,20),$vLineOne);
			$vLineOne=str_replace("@#74",$this->FormatView($vSum074,20),$vLineOne);
			$vLineOne=str_replace("@#75",$this->FormatView($vSum075,20),$vLineOne);
			$vLineOne=str_replace("@#76",$this->FormatView($vSum076,20),$vLineOne);
			$vLineOne=str_replace("@#77",$this->FormatView($vSum077,20),$vLineOne);
			$vLineOne=str_replace("@#78",$this->FormatView($vSum078,20),$vLineOne);
			$vLineOne=str_replace("@#79",$this->FormatView($vSum079,20),$vLineOne);
			$vLineOne=str_replace("@#80",$this->FormatView($vSum080,20),$vLineOne);
			$vLineOne=str_replace("@#81",$this->FormatView($vSum081,20),$vLineOne);
			$vLineOne=str_replace("@#82",$this->FormatView($vSum082,20),$vLineOne);
			$vLineOne=str_replace("@#83",$this->FormatView($vSum083,20),$vLineOne);
			$vLineOne=str_replace("@#84",$this->FormatView($vSum084,20),$vLineOne);
			$vLineOne=str_replace("@#85",$this->FormatView($vSum085,20),$vLineOne);
			$vLineOne=str_replace("@#86",$this->FormatView($vSum086,20),$vLineOne);
			$vLineOne=str_replace("@#87",$this->FormatView($vSum087,20),$vLineOne);
			$vLineOne=str_replace("@#88",$this->FormatView($vSum088,20),$vLineOne);
			$vLineOne=str_replace("@#89",$this->FormatView($vSum089,20),$vLineOne);
			$vLineOne=str_replace("@#90",$this->FormatView($vSum090,20),$vLineOne);
			$vLineOne=str_replace("@#91",$this->FormatView($vSum091,20),$vLineOne);
			$vLineOne=str_replace("@#92",$this->FormatView($vSum092,20),$vLineOne);
			$vLineOne=str_replace("@#93",$this->FormatView($vSum093,20),$vLineOne);
			$vLineOne=str_replace("@#94",$this->FormatView($vSum094,20),$vLineOne);
			$vLineOne=str_replace("@#95",$this->FormatView($vSum095,20),$vLineOne);
			$vLineOne=str_replace("@#96",$this->FormatView($vSum096,20),$vLineOne);
			$vLineOne=str_replace("@#97",$this->FormatView($vSum097,20),$vLineOne);
			$vLineOne=str_replace("@#98",$this->FormatView($vSum098,20),$vLineOne);
			$vLineOne=str_replace("@#99",$this->FormatView($vSum099,20),$vLineOne);
			
			$vLineOne=str_replace("@01",$this->FormatView($vSum101,20),$vLineOne);
			$vLineOne=str_replace("@02",$this->FormatView($vSum102,20),$vLineOne);
			$vLineOne=str_replace("@03",$this->FormatView($vSum103,20),$vLineOne);
			$vLineOne=str_replace("@04",$this->FormatView($vSum104,20),$vLineOne);
			$vLineOne=str_replace("@05",$this->FormatView($vSum105,20),$vLineOne);
			$vLineOne=str_replace("@06",$this->FormatView($vSum106,20),$vLineOne);
			$vLineOne=str_replace("@07",$this->FormatView($vSum107,20),$vLineOne);
			$vLineOne=str_replace("@08",$this->FormatView($vSum108,20),$vLineOne);
			$vLineOne=str_replace("@09",$this->FormatView($vSum109,20),$vLineOne);
			$vLineOne=str_replace("@10",$this->FormatView($vSum110,20),$vLineOne);
			$vLineOne=str_replace("@11",$this->FormatView($vSum111,20),$vLineOne);
			$vLineOne=str_replace("@12",$this->FormatView($vSum112,20),$vLineOne);
			$vLineOne=str_replace("@13",$this->FormatView($vSum113,20),$vLineOne);
			$vLineOne=str_replace("@14",$this->FormatView($vSum114,20),$vLineOne);
			$vLineOne=str_replace("@15",$this->FormatView($vSum115,20),$vLineOne);
			$vLineOne=str_replace("@16",$this->FormatView($vSum116,20),$vLineOne);
			$vLineOne=str_replace("@17",$this->FormatView($vSum117,20),$vLineOne);
			$vLineOne=str_replace("@18",$this->FormatView($vSum118,20),$vLineOne);
			$vLineOne=str_replace("@19",$this->FormatView($vSum119,20),$vLineOne);
			$vLineOne=str_replace("@20",$this->FormatView($vSum120,20),$vLineOne);
			$vLineOne=str_replace("@21",$this->FormatView($vSum121,20),$vLineOne);
			$vLineOne=str_replace("@22",$this->FormatView($vSum122,20),$vLineOne);
			$vLineOne=str_replace("@23",$this->FormatView($vSum123,20),$vLineOne);
			$vLineOne=str_replace("@24",$this->FormatView($vSum124,20),$vLineOne);
			$vLineOne=str_replace("@25",$this->FormatView($vSum125,20),$vLineOne);
			$vLineOne=str_replace("@26",$this->FormatView($vSum126,20),$vLineOne);
			$vLineOne=str_replace("@27",$this->FormatView($vSum127,20),$vLineOne);
			$vLineOne=str_replace("@28",$this->FormatView($vSum128,20),$vLineOne);
			$vLineOne=str_replace("@29",$this->FormatView($vSum129,20),$vLineOne);
			$vLineOne=str_replace("@30",$this->FormatView($vSum130,20),$vLineOne);
			$vLineOne=str_replace("@31",$this->FormatView($vSum131,20),$vLineOne);
			$vLineOne=str_replace("@32",$this->FormatView($vSum132,20),$vLineOne);
			$vLineOne=str_replace("@33",$this->FormatView($vSum133,20),$vLineOne);
			$vLineOne=str_replace("@34",$this->FormatView($vSum134,20),$vLineOne);
			$vLineOne=str_replace("@35",$this->FormatView($vSum135,20),$vLineOne);
			$vLineOne=str_replace("@36",$this->FormatView($vSum136,20),$vLineOne);
			$vLineOne=str_replace("@37",$this->FormatView($vSum137,20),$vLineOne);
			$vLineOne=str_replace("@38",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@39",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@40",'&nbsp;',$vLineOne);	
			$strLine=$strLine.$vLineOne;
	$vTable=str_replace("@#01",$strLine,$vTable);
	return $vTable;
		
	}
	function LV_TAMTINH_T13_TFull($vopt=0,$vYear,$vMonth,$mau)
	{
		//Lấy dữ liệu lương toàn cty
		$vArSalaryEmp=$this->LV_LoadFullSalaryYear($vYear);
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="1" cellspacing="1" style="width:1077px" >
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;" width="1645">
			<tbody>
			<tr height="25" id="CC_Title" class="lvhtable">
			<td align="left" height="79" rowspan="2"  valign="middle"  class="lvhtable"><b>STT </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>T&ecirc;n NV </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Lương </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b><font size="1">Lương CB </font></b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Số ng&agrave;y c&ocirc;ng </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Tiền lương thực tế </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Số ng&agrave;y nghỉ lế </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Tiền lương nghỉ lễ </b></td>
			<td align="center" colspan="5"  valign="middle" class="lvhtable"><b>Phụ cấp </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>C&aacute;c khoản trừ kh&aacute;c </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Tạm ứng </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Thực l&atilde;nh </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>K&yacute; nhận </b></td>
		</tr>
		<tr id="CCC_Title" class="lvhtable">
			<td align="center"  valign="middle" class="lvhtable"><b>ABC </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>PCCT </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>PCTN </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>Tăng ca </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>Cộng kh&aacute;c </b></td>
		</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	
		$vTRBold='<tr height="22">
					<td height="22"> </td>
					<td height="22"> </td>
					<td nowrap><strong>@#02</strong></td>
					<td nowrap><strong>@#03</strong></td>
					<td nowrap><strong>@#33</strong></td>
					<td align=right><strong>@#04</strong></td>
					<td align=right><strong>@#06</strong></td>
					<td align=right><strong>@#08</strong></td>
					<td align=right><strong>@#10</strong></td>
					<td align=right><strong>@#12</strong></td>
					<td align=right><strong>@#14</strong></td>
					<td align=right><strong>@#16</strong></td>
					<td align=right><strong>@#18</strong></td>
					<td align=right><strong>@#20</strong></td>
					<td align=right><strong>@#22</strong></td>
					<td align=right><strong>@#24</strong></td>
					<td align=right><strong>@#26</strong></td>
					<td align=right><strong>@#28</strong></td>
					<td align=right><strong>@#29</strong></td>
					</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left colspan="6"><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_11_@02"> </td>
			<td align=right id="col_12_@02"> </td>
			<td align=right id="col_13_@02"> </td>
			<td align=right id="col_14_@02"> </td>
			<td align=right id="col_15_@02"> </td>
			<td align=right id="col_16_@02"> </td>
			<td align=right id="col_17_@02"></td>
		</tr>';

		$vTable='<table style="width: 1100px; text-align: center;" border="1" cellspacing="0" cellpadding="0">
<colgroup>
</colgroup>
<tbody>
<tr height="40"  class="lvhtable">
<td class="lvhtable" width="30" height="154"><strong style="font-weight: bold;">STT</strong></td>
<td class="lvhtable" width="72"><strong style="font-weight: bold;">MÃ SỐ</strong></td>
<td class="lvhtable" width="213"><strong style="font-weight: bold;">HỌ VÀ TÊN</strong></td>
<td class="lvhtable" width="105"><strong style="font-weight: bold;">BỘ PHẬN</strong></td>
<td class="lvhtable" width="105"><strong style="font-weight: bold;">CHỨC VỤ</strong></td>

<td class="lvhtable" nowrap width="127" height="114"><strong style="font-weight: bold;">THÁNG 01</strong></td>
<td class="lvhtable" nowrap width="135"><strong style="font-weight: bold;">THÁNG 02 </strong></td>
<td class="lvhtable" nowrap width="113"><strong style="font-weight: bold;">THÁNG 03 </strong></td>
<td class="lvhtable" nowrap width="117"><strong style="font-weight: bold;">THÁNG 04 </strong></td>
<td class="lvhtable" nowrap width="110"><strong style="font-weight: bold;">THÁNG 05 </strong></td>
<td class="lvhtable" nowrap width="106"><strong style="font-weight: bold;">THÁNG 06</strong></td>
<td class="lvhtable" nowrap width="126"><strong style="font-weight: bold;">THÁNG 07</strong></td>
<td class="lvhtable" nowrap width="111"><strong style="font-weight: bold;">THÁNG 08</strong></td>
<td class="lvhtable" nowrap width="109"><strong style="font-weight: bold;">THÁNG 09 </strong></td>
<td class="lvhtable" nowrap width="114"><strong style="font-weight: bold;">THÁNG 10 </strong></td>
<td class="lvhtable" nowrap width="129"><strong style="font-weight: bold;">THÁNG 11 </strong></td>
<td class="lvhtable" nowrap width="109"><strong style="font-weight: bold;">THÁNG 12 </strong></td>
<td class="lvhtable" nowrap width="105"><strong style="font-weight: bold;">TỔNG THU NHẬP 12 THÁNG</strong></td>
<td class="lvhtable" nowrap width="112"><strong style="font-weight: bold;">LƯƠNG THÁNG 13 </strong></td>
</tr>
<tr height="19">
	<td><strong>(1)</strong></td>
	<td><strong>(2)</strong></td>
	<td><strong>(3)</strong></td>
	<td><strong>(4)</strong></td>
	<td><strong>(5)</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
@#01
</tbody>
</table>';
$vTr='
<tr id="CC_Title_@#01"></tr>
<tr id="CCC_Title_@#01"></tr>
<tr height="22">
<td height="22">@#00</td>
<td height="22">'.(($_GET['funcexp']=='excel')?'<Data ss:Type="String">="@#01"</Data>':'@#01').'</td>
<td nowrap>@#02</td>
<td nowrap>@#03</td>
<td nowrap>@#33</td>
<td align=right>@#04</td>
<td align=right>@#06</td>
<td align=right>@#08</td>
<td align=right>@#10</td>
<td align=right>@#12</td>
<td align=right>@#14</td>
<td align=right>@#16</td>
<td align=right>@#18</td>
<td align=right>@#20</td>
<td align=right>@#22</td>
<td align=right>@#24</td>
<td align=right>@#26</td>
<td align=right>@#28</td>
<td align=right>@#29</td>
</tr>
';
$vTRMAU1='
			<tr height="17">
				<td colspan="19" align=left>@!02</td>
			</tr>
			<tr height="22">
				<td height="22">@#00</td>
				<td height="22">'.(($_GET['funcexp']=='excel')?'<Data ss:Type="String">="@#01"</Data>':'@#01').'</td>
				<td nowrap>@#02</td>
				<td nowrap>@#03</td>
				<td nowrap>@#33</td>
				<td align=right>@#04</td>
				<td align=right>@#06</td>
				<td align=right>@#08</td>
				<td align=right>@#10</td>
				<td align=right>@#12</td>
				<td align=right>@#14</td>
				<td align=right>@#16</td>
				<td align=right>@#18</td>
				<td align=right>@#20</td>
				<td align=right>@#22</td>
				<td align=right>@#24</td>
				<td align=right>@#26</td>
				<td align=right>@#28</td>
				<td align=right>@#29</td>
		</tr>';
		$vsql="select A.lv001,A.lv002,A.lv013,A.lv010,A.lv029 DeptID,A.lv005 from hr_lv0020 A where A.lv001 in (select BB.lv002 from tc_lv0021 BB where year(BB.lv005)='$vYear') ".$this->GetConditionQTThue($vYear)." order by A.lv029 ASC,A.lv001 ASC" ;
		$bResult=db_query($vsql);
		$i=1;
		$strDepart='';
		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			
			if($strDepart!=$vrow['DeptID'].'' && $mau==1)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#33",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#04",$this->FormatView($vSum004_1,20),$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vSum006_1,20),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vSum008_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vSum010_1,20),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vSum012_1,20),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vSum014_1,20),$vLineOne);
					$vLineOne=str_replace("@#16",$this->FormatView($vSum016_1,20),$vLineOne);
					$vLineOne=str_replace("@#18",$this->FormatView($vSum018_1,20),$vLineOne);
					$vLineOne=str_replace("@#20",$this->FormatView($vSum020_1,20),$vLineOne);
					$vLineOne=str_replace("@#22",$this->FormatView($vSum022_1,20),$vLineOne);
					$vLineOne=str_replace("@#24",$this->FormatView($vSum024_1,20),$vLineOne);
					$vLineOne=str_replace("@#26",$this->FormatView($vSum026_1,20),$vLineOne);
					$vLineOne=str_replace("@#28",$this->FormatView($vSum028_1,20),$vLineOne);
					$vLineOne=str_replace("@#29",$this->FormatView($vSum029_1,20),$vLineOne);
				
					$strLine=$strLine.$vLineOne;

					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vSum004_1=0;
					$vSum006_1=0;
					$vSum008_1=0;
					$vSum010_1=0;
					$vSum012_1=0;
					$vSum014_1=0;
					$vSum016_1=0;
					$vSum018_1=0;
					$vSum020_1=0;
					$vSum022_1=0;
					$vSum024_1=0;
					$vSum026_1=0;
					$vSum028_1=0;
					$vSum029_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTr;
						break;
				}
			}
			else
				$vLineOne=$vTr;
			$vLineOne=str_replace("@#00",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#01",$vrow['lv001'],$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv058',$vrow['DeptID']),$vLineOne);
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$vrow['DeptID']),$vLineOne);
			$vLineOne=str_replace("@#33",$vrow['lv005'],$vLineOne);
			$vlv028=0;

			$vlv004=$vArSalaryEmp[$vrow['lv001']]['01']['lv024']+$vArSalaryEmp[$vrow['lv001']]['01']['lv023'];
			$vlv028=$vlv028+$vlv004;
			$vSum004=$vSum004+$vlv004;
			$vSum004_1=$vSum004_1+$vlv004;
			$vLineOne=str_replace("@#04",$this->FormatView($vlv004,20),$vLineOne);

			$vlv006=$vArSalaryEmp[$vrow['lv001']]['02']['lv024']+$vArSalaryEmp[$vrow['lv001']]['02']['lv023'];
			$vlv028=$vlv028+$vlv006;
			$vSum006=$vSum006+$vlv006;
			$vSum006_1=$vSum006_1+$vlv006;
			$vLineOne=str_replace("@#06",$this->FormatView($vlv006,20),$vLineOne);

			$vlv008=$vArSalaryEmp[$vrow['lv001']]['03']['lv024']+$vArSalaryEmp[$vrow['lv001']]['03']['lv023'];
			$vlv028=$vlv028+$vlv008;
			$vSum008=$vSum008+$vlv008;
			$vSum008_1=$vSum008_1+$vlv008;
			$vLineOne=str_replace("@#08",$this->FormatView($vlv008,20),$vLineOne);
			
			$vlv010=$vArSalaryEmp[$vrow['lv001']]['04']['lv024']+$vArSalaryEmp[$vrow['lv001']]['04']['lv023'];
			$vlv028=$vlv028+$vlv010;
			$vSum010=$vSum010+$vlv010;
			$vSum010_1=$vSum010_1+$vlv010;
			$vLineOne=str_replace("@#10",$this->FormatView($vlv010,20),$vLineOne);
			
			$vlv012=$vArSalaryEmp[$vrow['lv001']]['05']['lv024']+$vArSalaryEmp[$vrow['lv001']]['05']['lv023'];
			$vlv028=$vlv028+$vlv012;
			$vSum012=$vSum012+$vlv012;
			$vSum012_1=$vSum012_1+$vlv012;
			$vLineOne=str_replace("@#12",$this->FormatView($vlv012,20),$vLineOne);
			
			$vlv014=$vArSalaryEmp[$vrow['lv001']]['06']['lv024']+$vArSalaryEmp[$vrow['lv001']]['06']['lv023'];
			$vlv028=$vlv028+$vlv014;
			$vSum014=$vSum014+$vlv014;
			$vSum014_1=$vSum014_1+$vlv014;
			$vLineOne=str_replace("@#14",$this->FormatView($vlv014,20),$vLineOne);
			

			$vlv016=$vArSalaryEmp[$vrow['lv001']]['07']['lv024']+$vArSalaryEmp[$vrow['lv001']]['07']['lv023'];
			$vlv028=$vlv028+$vlv016;
			$vSum016=$vSum016+$vlv016;
			$vSum016_1=$vSum016_1+$vlv016;
			$vLineOne=str_replace("@#16",$this->FormatView($vlv016,20),$vLineOne);
			
			$vlv018=$vArSalaryEmp[$vrow['lv001']]['08']['lv024']+$vArSalaryEmp[$vrow['lv001']]['08']['lv023'];
			$vlv028=$vlv028+$vlv018;
			$vSum018=$vSum018+$vlv018;
			$vSum018_1=$vSum018_1+$vlv018;
			$vLineOne=str_replace("@#18",$this->FormatView($vlv018,20),$vLineOne);
				
			$vlv020=$vArSalaryEmp[$vrow['lv001']]['09']['lv024']+$vArSalaryEmp[$vrow['lv001']]['09']['lv023'];
			$vlv028=$vlv028+$vlv020;
			$vSum020=$vSum020+$vlv020;
			$vSum020_1=$vSum020_1+$vlv020;
			$vLineOne=str_replace("@#20",$this->FormatView($vlv020,20),$vLineOne);
			
			$vlv022=$vArSalaryEmp[$vrow['lv001']]['10']['lv024']+$vArSalaryEmp[$vrow['lv001']]['10']['lv023'];
			$vlv028=$vlv028+$vlv022;
			$vSum022=$vSum022+$vlv022;
			$vSum022_1=$vSum022_1+$vlv022;
			$vLineOne=str_replace("@#22",$this->FormatView($vlv022,20),$vLineOne);
				
			$vlv024=$vArSalaryEmp[$vrow['lv001']]['11']['lv024']+$vArSalaryEmp[$vrow['lv001']]['11']['lv023'];
			$vlv028=$vlv028+$vlv024;
			$vSum024=$vSum024+$vlv024;
			$vSum024_1=$vSum024_1+$vlv024;
			$vLineOne=str_replace("@#24",$this->FormatView($vlv024,20),$vLineOne);
				
			$vlv026=$vArSalaryEmp[$vrow['lv001']]['12']['lv024']+$vArSalaryEmp[$vrow['lv001']]['12']['lv023'];
			$vlv028=$vlv028+$vlv026;
			$vSum026=$vSum026+$vlv026;
			$vSum026_1=$vSum026_1+$vlv026;
			$vLineOne=str_replace("@#26",$this->FormatView($vlv026,20),$vLineOne);
				
			$vLineOne=str_replace("@#28",$this->FormatView($vlv028,20),$vLineOne);
			$vlv029=round($vlv028/12,0);
			$vLineOne=str_replace("@#29",$this->FormatView($vlv029,20),$vLineOne);
		
			$vSum029=$vSum029+$vlv029;
			$vSum029_1=$vSum029_1+$vlv029;
			$vSum028=$vSum028+$vlv028;
			$vSum028_1=$vSum028_1+$vlv028;
			$vLineOne=str_replace("@11",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@37",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@38",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@39",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@40",$vrow['lv010'],$vLineOne);	
			
			$strLine=$strLine.$vLineOne;
			
		}
		$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#33",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#04",$this->FormatView($vSum004_1,20),$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vSum006_1,20),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vSum008_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vSum010_1,20),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vSum012_1,20),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vSum014_1,20),$vLineOne);
					$vLineOne=str_replace("@#16",$this->FormatView($vSum016_1,20),$vLineOne);
					$vLineOne=str_replace("@#18",$this->FormatView($vSum018_1,20),$vLineOne);
					$vLineOne=str_replace("@#20",$this->FormatView($vSum020_1,20),$vLineOne);
					$vLineOne=str_replace("@#22",$this->FormatView($vSum022_1,20),$vLineOne);
					$vLineOne=str_replace("@#24",$this->FormatView($vSum024_1,20),$vLineOne);
					$vLineOne=str_replace("@#26",$this->FormatView($vSum026_1,20),$vLineOne);
					$vLineOne=str_replace("@#28",$this->FormatView($vSum028_1,20),$vLineOne);
					$vLineOne=str_replace("@#29",$this->FormatView($vSum029_1,20),$vLineOne);
				
					$strLine=$strLine.$vLineOne;
		$vLineOne=$vTRBold;
			$vLineOne=str_replace("@#00",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#01",'',$vLineOne);
			$vLineOne=str_replace("@#02",'Tổng công:',$vLineOne);
			$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
			
			$vLineOne=str_replace("@#04",$this->FormatView($vSum004,20),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vSum006,20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vSum008,20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vSum010,20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vSum012,20),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vSum014,20),$vLineOne);
			$vLineOne=str_replace("@#16",$this->FormatView($vSum016,20),$vLineOne);
			$vLineOne=str_replace("@#18",$this->FormatView($vSum018,20),$vLineOne);
			$vLineOne=str_replace("@#20",$this->FormatView($vSum020,20),$vLineOne);
			$vLineOne=str_replace("@#22",$this->FormatView($vSum022,20),$vLineOne);
			$vLineOne=str_replace("@#24",$this->FormatView($vSum024,20),$vLineOne);
			$vLineOne=str_replace("@#26",$this->FormatView($vSum026,20),$vLineOne);
			$vLineOne=str_replace("@#28",$this->FormatView($vSum028,20),$vLineOne);
			$vLineOne=str_replace("@#29",$this->FormatView($vSum029,20),$vLineOne);
			
			$vLineOne=str_replace("@#33",'&nbsp;',$vLineOne);	
			$strLine=$strLine.$vLineOne;
	$vTable=str_replace("@#01",$strLine,$vTable);
	return $vTable;
		
	}
	function LV_QuyetToanThueTNCN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<table border="1" cellspacing="0" style="width: 100%;">
	<tbody>
		<tr>
			<td class="lvhtable" align="center" height="123" rowspan="3" valign="middle"><b><font size="1">STT</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Họ v&agrave; t&ecirc;n (*)</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">M&atilde; số thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số CMND/Hộ chiếu</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">C&aacute; nh&acirc;n uỷ quyền quyết to&aacute;n thay</font></b></td>
			<td class="lvhtable" align="center" colspan="3" valign="middle"><b><font size="1">Thu nhập chịu thuế</font></b></td>
			<td class="lvhtable" align="center" colspan="5" valign="middle"><b><font size="1">C&aacute;c khoản giảm trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Thu nhập t&iacute;nh<br />
				thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số thuế TNCN đ&atilde; khấu trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số thuế TNCN được giảm do l&agrave;m việc trong KKT</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">C&aacute; nh&acirc;n nước ngo&agrave;i uỷ quyền quyết to&aacute;n dưới 12 th&aacute;ng/năm</font></b></td>
			<td class="lvhtable" align="center" colspan="3" valign="middle"><b><font size="1">Chi tiết kết quả quyết to&aacute;n thay cho c&aacute; nh&acirc;n nộp thuế</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số</font></b></td>
			<td class="lvhtable" align="center" colspan="2" valign="middle"><b><font size="1">Trong đ&oacute;: TNCT l&agrave;m căn cứ t&iacute;nh giảm thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số lượng NPT t&iacute;nh giảm trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số tiền giảm trừ gia cảnh</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Từ thiện, nh&acirc;n đạo, khuyến học</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Bảo hiểm được trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Quĩ hưu tr&iacute; tự nguyện được trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số thuế phải nộp</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số thuế đ&atilde; nộp thừa</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số thuế c&ograve;n phải nộp</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">L&agrave;m việc trong KKT</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">Theo Hiệp định</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" height="29" valign="middle"><b><font size="1">[06]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[07]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[08]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[09]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[10]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[11]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[12]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[13]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[14]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[15]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[16]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[17]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[18]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[19]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[20]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[21]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1"></font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[22]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[23]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[24]</font></b></td>
		</tr>
		
		@#01
			@#02
	</tbody>
</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td colspan="17">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13/td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">@#17</td>
			<td align=right id="col_18_@02">@#18</td>
			<td align=right id="col_19_@02">@#19</td>
			<td align=right>&nbsp;</td>
		</tr>';
	$vTR='
	<tr id="CC_Title_@#01"></tr>
	<tr id="CCC_Title_@#01"></tr>
	<tr height="17" onDblClick="Show_CC_Title(@#01)" class="lvlinehtable@01">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap"><strong>@#02</strong></td>
			<td align=center style="white-space:nowrap"><strong>@#03</strong></td>
			<td align=center><strong>@#04<strong></td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13</td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">@#17</td>
			<td align=right id="col_18_@02">@#18</td>
			<td align=right id="col_19_@02">@#19</td>
			<td align=right id="col_17_@02">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

		</tr>';
		$vTRBold='<tr height="17" style="background:yellow;font-weight:bold;">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=right><strong>@#03</strong></td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right id="col_8_@02"><strong>@#08</strong></td>
			<td align=right id="col_9_@02"><strong>@#09</strong></td>
			<td align=right id="col_10_@02"><strong>@#10</strong></td>
			<td align=right id="col_11_@02"><strong>@#11</strong></td>
			<td align=right id="col_12_@02"><strong>@#12</strong></td>
			<td align=right id="col_13_@02"><strong>@#13</strong></td>
			<td align=right id="col_14_@02"><strong>@#14</strong></td>
			<td align=right id="col_15_@02"><strong>@#15</strong></td>
			<td align=right id="col_16_@02"><strong>@#16</strong></td>
			<td align=right id="col_17_@02"><strong>@#17</strong></td>
			<td align=right id="col_18_@02"><strong>@#18</strong></td>
			<td align=right id="col_19_@02"><strong>@#19</strong></td>
			<td align=right id="col_20_@02"><strong>&nbsp;</strong></td>
		</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left colspan="6"><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_11_@02"> </td>
			<td align=right id="col_12_@02"> </td>
			<td align=right id="col_13_@02"> </td>
			<td align=right id="col_14_@02"> </td>
			<td align=right id="col_15_@02"> </td>
			<td align=right id="col_16_@02"> </td>
			<td align=right id="col_17_@02"></td>
			<td align=right id="col_18_@02"></td>
			<td align=right id="col_19_@02"></td>
			<td align=right id="col_20_@02"></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		//Mo rong
		$vlv016_0=0;
		$vlv017_0=0;
		$vlv018_0=0;
		$vlv019_0=0;
		$vlv020_0=0;
		$vlv021_0=0;
		$vlv022_0=0;
		$vlv023_0=0;
		$vlv027_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#06","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#09","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#10","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#12","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#14","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#15","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
					/*$vLineOne=str_replace("@#11",$this->FormatView($vlv075_1,20),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vTangCa_1,20),$vLineOne);
					$vLineOne=str_replace("@#13",$this->FormatView($vCongKhac_1,20),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vTongTru_1,20),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($vTamUng_1,20),$vLineOne);
					$vLineOne=str_replace("@#16",$this->FormatView($vlv050_1,20),$vLineOne);*/
				
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv079_1=0;
					$vlv024_1=0;
					$vlv019_1=0;
					$vlv028_1=0;
					$vlv015_1=0;
					$vlv020_1=0;
					$vlv016_1=0;
					$vlv021_1=0;
					$vlv017_1=0;
					$vlv022_1=0;
					$vlv022_1=0;
					$vlv022_1=0;
					$vkhongcong_1=0;
					$vTangCa_1=0;
					$vCongKhac_1=0;
					$vTongTru_1=0;


					$vlv025_1=0;
					$vlv085_1=0;
					$vlv043_1=0;
					$vlv039_1=0;
					$vlv045_1=0;
					$vlv035_1=0;
					$vlv048_1=0;
					$vlv084_1=0;
					$vlv080_1=0;
					$vlv050_1=0;
					$vlv051_1=0;
					$vlv092_1=0;
					$vlv027_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vkhongcong_1=$vkhongcong_1+(float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'];
			$vkhongcong_0=$vkhongcong_0+(float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'];
			$vlv079_0=$vlv079_0+$vrow['lv079'];
			$vlv024_0=$vlv024_0+$vrow['lv024'];
			$vlv019_0=$vlv019_0+$vrow['lv019'];
			$vlv028_0=$vlv028_0+$vrow['lv028'];
			
			$vlv015_0=$vlv015_0+$vrow['lv015'];
			$vlv020_0=$vlv020_0+$vrow['lv020'];
			$vlv016_0=$vlv016_0+$vrow['lv016'];
			$vlv021_0=$vlv021_0+$vrow['lv021'];
			$vlv017_0=$vlv017_0+$vrow['lv017'];
			$vlv022_0=$vlv022_0+$vrow['lv022'];
			$vlv048_0=$vlv048_0+$vrow['lv048'];

			$vlv050_0=$vlv050_0+$vrow['lv050'];
			$vlv051_0=$vlv051_0+$vrow['lv051'];
			$vlv025_0=$vlv025_0+$vrow['lv025'];
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv039_0=$vlv039_0+$vrow['lv039'];
			$vlv080_0=$vlv080_0+$vrow['lv080'];
			$vlv092_0=$vlv092_0+$vrow['lv092'];
			$vlv078_0=$vlv078_0+$vrow['lv078'];
			$vlv008_0=$vlv008_0+$vrow['lv008'];

			$vTangCa_0=$vTangCa_0+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022'];
			$vCongKhac_0=$vCongKhac_0+(float)$vrow['lv033']-($vrow['lv024']+$vrow['lv051']+$vrow['lv076']+$vrow['lv075']+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022']);
			$vTongTru_0=$vTongTru_0+$vrow['lv048']-$vrow['lv027'];
			$vlv027_0=$vlv027_0+$vrow['lv027'];
			$vPIT=$vrow['lv045'];
			
			$vlv046_0=$vlv046_0+$vrow['lv046']-$vrow['lv088'];
			$vlv035_0=$vlv035_0+$vrow['lv035'];
			
			$vlv079_1=$vlv079_1+$vrow['lv079'];
			$vlv024_1=$vlv024_1+$vrow['lv024'];
			$vlv019_1=$vlv019_1+$vrow['lv019'];
			$vlv028_1=$vlv028_1+$vrow['lv028'];
			$vlv015_1=$vlv015_1+$vrow['lv015'];
			$vlv020_1=$vlv020_1+$vrow['lv020'];
			$vlv016_1=$vlv016_1+$vrow['lv016'];
			$vlv021_1=$vlv021_1+$vrow['lv021'];
			$vlv017_1=$vlv017_1+$vrow['lv017'];
			$vlv022_1=$vlv022_1+$vrow['lv022'];$


			$vlv048_1=$vlv048_1+$vrow['lv048'];

			$vlv050_1=$vlv050_1+$vrow['lv050'];
			$vlv051_1=$vlv051_1+$vrow['lv051'];
			$vlv025_1=$vlv025_1+$vrow['lv025'];
			$vlv085_1=$vlv085_1+$vrow['lv085'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv039_1=$vlv039_1+$vrow['lv039'];
			
			$vlv046_1=$vlv046_1+$vrow['lv046']-$vrow['lv088'];
			$vlv035_1=$vlv035_1+$vrow['lv035'];
			$vlv080_1=$vlv080_1+$vrow['lv080'];
			$vlv092_1=$vlv092_1+$vrow['lv092'];
			$vlv078_1=$vlv078_1+$vrow['lv078'];
			$vlv008_1=$vlv008_1+$vrow['lv008'];

			$vTangCa_1=$vTangCa_1+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022'];
			$vCongKhac_1=$vCongKhac_1+(float)$vrow['lv033']-($vrow['lv024']+$vrow['lv051']+$vrow['lv076']+$vrow['lv075']+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022']);
			$vTongTru_1=$vTongTru_1+$vrow['lv048']-$vrow['lv027'];
			$vlv027_1=$vlv027_1+$vrow['lv027'];
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@01",$vOrder%2,$vLineOne);
			$vLineOne = str_replace("@02", $vOrder, $vLineOne);
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['TenNV'],$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['CMND'],$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['MST'],$vLineOne);
			$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#06","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#09","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#10","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#12","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#14","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#15","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
		}
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+1, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#10","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#15","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+2, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#10","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#15","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBoldChu;
		$vLineOne = str_replace("@02", $vOrder+3, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Bằng chữ:',$vLineOne);
		$vLineOne=str_replace("@#03",LNum2Text($vlv050_1,$this->lang),$vLineOne);
		

		//$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		$strFullTbl=str_replace("@!79",$vOrder+3,$strFullTbl);
		return $strFullTbl;	
	}
	protected function GetConditionOtherCalYear()
	{
		$strCondi="";
		if($this->lv002!="") $strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		
		if($this->CalYear!="") $strCondi=$strCondi." and year(A.lv004)='$this->CalYear'";
		switch($this->Bank)
		{
			case 2:
				$strCondi=$strCondi." and (trim(A.lv061) = '' or ISNULL(A.lv061))";
				break;
			case 1:
				$strCondi=$strCondi." and (trim(A.lv061) <> '')";
				break;
		}
		switch($this->isViet)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and B.lv022='VIETNAM'";
				break;
			case 2:
				$strCondi=$strCondi." and B.lv022<>'VIETNAM'";
				break;
		}
		switch($this->isNghi)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and (month(B.lv044)='".$this->CalMonth."' and year(B.lv044)='".$this->CalYear."')";
				break;
			case 2:
				$strCondi=$strCondi." and (month(B.lv044)<>'".$this->CalMonth."' and year(B.lv044)<>'".$this->CalYear."')";
				break;
		}
		if($this->isHDCheck==1)
		{
			if($this->lv201!="") $strCondi=$strCondi." and (AA.lv010 in (".$this->LV_GetDep($this->lv201).")	)";
			if($this->lv202!="") $strCondi=$strCondi." and (AA.lv010 in (".$this->LV_GetDep($this->lv202).")	)";
		}
		else
		{
			if($this->lv201!="") $strCondi=$strCondi." and (AA.lv004 in (".$this->LV_GetDep($this->lv201).")	)";
			if($this->lv202!="") $strCondi=$strCondi." and (AA.lv004 in (".$this->LV_GetDep($this->lv202).")	)";
		}
		
		if($this->lv839!="")
		{
			$strCondi=$strCondi." and (A.lv056 in (".$this->LV_GetHDLD($this->lv839).")	)";
		}
		if($this->lv058_!="")  
		{
			$strCondi=$strCondi." and A.lv058 in (".$this->LV_GetDepFull($this->lv058_).")";
		}
		return $strCondi;
	}
	protected function GetConditionOtherCalYearQuy()
	{
		$strCondi="";
		//if($this->lv002!="") $strCondi=$strCondi." and A.lv002  = '$this->lv002'";
		$vYear=$this->CalYear;
		switch($this->CalMonth)
			{
				case 1:
				case 2:
				case 3:
					$strCondi=$strCondi." and ( A.lv005>='$vYear-01-01' and A.lv005<='$vYear-03-31') ";
					break;
				case 4:
				case 5:
				case 6:
					$strCondi=$strCondi." and ( A.lv005>='$vYear-04-01' and A.lv005<='$vYear-06-30') ";
					break;
				case 7:
				case 8:
				case 9:
					$strCondi=$strCondi." and ( A.lv005>='$vYear-07-01' and A.lv005<='$vYear-09-31') ";
					break;
				case 10:
				case 11:
				case 12:
					$strCondi=$strCondi." and ( A.lv005>='$vYear-10-01' and A.lv005<='$vYear-12-31') ";
					break;
			}
		if($this->CalYear!="") $strCondi=$strCondi." and year(A.lv004)='$this->CalYear'";
		switch($this->Bank)
		{
			case 2:
				$strCondi=$strCondi." and (trim(A.lv061) = '' or ISNULL(A.lv061))";
				break;
			case 1:
				$strCondi=$strCondi." and (trim(A.lv061) <> '')";
				break;
		}
		switch($this->isViet)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and B.lv022='VIETNAM'";
				break;
			case 2:
				$strCondi=$strCondi." and B.lv022<>'VIETNAM'";
				break;
		}
		switch($this->isNghi)
		{
			case 0:
				break;
			case 1:
				$strCondi=$strCondi." and (month(B.lv044)='".$this->CalMonth."' and year(B.lv044)='".$this->CalYear."')";
				break;
			case 2:
				$strCondi=$strCondi." and (month(B.lv044)<>'".$this->CalMonth."' and year(B.lv044)<>'".$this->CalYear."')";
				break;
		}
		if($this->isHDCheck==1)
		{
			if($this->lv201!="") $strCondi=$strCondi." and (AA.lv010 in (".$this->LV_GetDep($this->lv201).")	)";
			if($this->lv202!="") $strCondi=$strCondi." and (AA.lv010 in (".$this->LV_GetDep($this->lv202).")	)";
		}
		else
		{
			if($this->lv201!="") $strCondi=$strCondi." and (AA.lv004 in (".$this->LV_GetDep($this->lv201).")	)";
			if($this->lv202!="") $strCondi=$strCondi." and (AA.lv004 in (".$this->LV_GetDep($this->lv202).")	)";
		}
		
		if($this->lv839!="")
		{
			$strCondi=$strCondi." and (A.lv056 in (".$this->LV_GetHDLD($this->lv839).")	)";
		}
		if($this->lv058_!="")  
		{
			$strCondi=$strCondi." and A.lv058 in (".$this->LV_GetDepFull($this->lv058_).")";
		}
		return $strCondi;
	}
	function LV_QuyetToanThueTNCNYear($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<table border="1" cellspacing="0" style="width: 100%;">
	<tbody>
		<tr>
			<td class="lvhtable" align="center" height="123" rowspan="3" valign="middle"><b><font size="1">STT</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Họ v&agrave; t&ecirc;n (*)</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">M&atilde; số thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số CMND/Hộ chiếu</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">C&aacute; nh&acirc;n uỷ quyền quyết to&aacute;n thay</font></b></td>
			<td class="lvhtable" align="center" colspan="3" valign="middle"><b><font size="1">Thu nhập chịu thuế</font></b></td>
			<td class="lvhtable" align="center" colspan="5" valign="middle"><b><font size="1">C&aacute;c khoản giảm trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Thu nhập t&iacute;nh<br />
				thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số thuế TNCN đ&atilde; khấu trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số thuế TNCN được giảm do l&agrave;m việc trong KKT</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">C&aacute; nh&acirc;n nước ngo&agrave;i uỷ quyền quyết to&aacute;n dưới 12 th&aacute;ng/năm</font></b></td>
			<td class="lvhtable" align="center" colspan="3" valign="middle"><b><font size="1">Chi tiết kết quả quyết to&aacute;n thay cho c&aacute; nh&acirc;n nộp thuế</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số</font></b></td>
			<td class="lvhtable" align="center" colspan="2" valign="middle"><b><font size="1">Trong đ&oacute;: TNCT l&agrave;m căn cứ t&iacute;nh giảm thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số lượng NPT t&iacute;nh giảm trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số tiền giảm trừ gia cảnh</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Từ thiện, nh&acirc;n đạo, khuyến học</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Bảo hiểm được trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Quĩ hưu tr&iacute; tự nguyện được trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số thuế phải nộp</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số thuế đ&atilde; nộp thừa</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số thuế c&ograve;n phải nộp</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">L&agrave;m việc trong KKT</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">Theo Hiệp định</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" height="29" valign="middle"><b><font size="1">[06]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[07]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[08]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[09]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[10]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[11]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[12]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[13]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[14]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[15]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[16]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[17]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[18]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[19]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[20]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[21]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1"></font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[22]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[23]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[24]</font></b></td>
		</tr>
		
		@#01
			@#02
	</tbody>
</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td colspan="17">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13/td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">@#17</td>
			<td align=right id="col_18_@02">@#18</td>
			<td align=right id="col_19_@02">@#19</td>
			<td align=right>&nbsp;</td>
		</tr>';
	$vTR='
	<tr id="CC_Title_@#01"></tr>
	<tr id="CCC_Title_@#01"></tr>
	<tr height="17" onDblClick="Show_CC_Title(@#01)" class="lvlinehtable@01">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap"><strong>@#02</strong></td>
			<td align=center style="white-space:nowrap"><strong>@#03</strong></td>
			<td align=center><strong>@#04<strong></td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13</td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">@#17</td>
			<td align=right id="col_18_@02">@#18</td>
			<td align=right id="col_19_@02">@#19</td>
			<td align=right id="col_17_@02">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

		</tr>';
		$vTRBold='<tr height="17" style="background:yellow;font-weight:bold;">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=right><strong>@#03</strong></td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right id="col_8_@02"><strong>@#08</strong></td>
			<td align=right id="col_9_@02"><strong>@#09</strong></td>
			<td align=right id="col_10_@02"><strong>@#10</strong></td>
			<td align=right id="col_11_@02"><strong>@#11</strong></td>
			<td align=right id="col_12_@02"><strong>@#12</strong></td>
			<td align=right id="col_13_@02"><strong>@#13</strong></td>
			<td align=right id="col_14_@02"><strong>@#14</strong></td>
			<td align=right id="col_15_@02"><strong>@#15</strong></td>
			<td align=right id="col_16_@02"><strong>@#16</strong></td>
			<td align=right id="col_17_@02"><strong>@#17</strong></td>
			<td align=right id="col_18_@02"><strong>@#18</strong></td>
			<td align=right id="col_19_@02"><strong>@#19</strong></td>
			<td align=right id="col_20_@02"><strong>&nbsp;</strong></td>
		</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left colspan="6"><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_11_@02"> </td>
			<td align=right id="col_12_@02"> </td>
			<td align=right id="col_13_@02"> </td>
			<td align=right id="col_14_@02"> </td>
			<td align=right id="col_15_@02"> </td>
			<td align=right id="col_16_@02"> </td>
			<td align=right id="col_17_@02"></td>
			<td align=right id="col_18_@02"></td>
			<td align=right id="col_19_@02"></td>
			<td align=right id="col_20_@02"></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		if($this->isHDCheck==1)
			$sqlS = "SELECT A.lv002,SUM(A.lv033) ThucLanh,SUM(IF(A.lv070>0,A.lv070,0)) TongThuNhapTruocTongGiamTru,SUM(A.lv044) TongGiamTru,SUM(A.lv040) BHXHNLD,SUM(A.lv070) ThuNhapTinhThue,SUM(A.lv045) TNCN,B.lv030 lv503,B.lv005 Position,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST,B.lv049 SoNguoiPhuThuoc  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCalYear()." group by A.lv002 $strSort LIMIT $curRow, $maxRows";
		else
			$sqlS = "SELECT A.lv002,SUM(A.lv033) ThucLanh,SUM(IF(A.lv070>0,A.lv070,0)) TongThuNhapTruocTongGiamTru,SUM(A.lv044) TongGiamTru,SUM(A.lv040) BHXHNLD,SUM(A.lv070) ThuNhapTinhThue,SUM(A.lv045) TNCN,B.lv030 lv503,B.lv005 Position,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST,B.lv049 SoNguoiPhuThuoc  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCalYear()."  group by A.lv002 $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		//Mo rong
		$vlv016_0=0;
		$vlv017_0=0;
		$vlv018_0=0;
		$vlv019_0=0;
		$vlv020_0=0;
		$vlv021_0=0;
		$vlv022_0=0;
		$vlv023_0=0;
		$vlv027_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_1,20),$vLineOne);
					$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_1,20),$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD,20),$vLineOne);
					$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru,20),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($TNCN,20),$vLineOne);
					$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
				
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$ThucLanh_1=0;
					$SoNguoiPhuThuoc_1=0;
					$TongGiamTru_1=0;
					$BHXHNLD_1=0;
					$TongThuNhapTruocTongGiamTru_1=0;
					$TNCN_1=0;

				}
				$strDepart=$vrow['DeptID'];
			}

			$ThucLanh_0=$ThucLanh_0+$vrow['ThucLanh'];
			$SoNguoiPhuThuoc_0=$SoNguoiPhuThuoc_0+$vrow['SoNguoiPhuThuoc'];
			$TongGiamTru_0=$TongGiamTru_0+$vrow['TongGiamTru'];
			$BHXHNLD_0=$BHXHNLD_0+$vrow['BHXHNLD'];
			$TongThuNhapTruocTongGiamTru_0=$TongThuNhapTruocTongGiamTru_0+$vrow['TongThuNhapTruocTongGiamTru'];
			$TNCN_0=$TNCN_0+$vrow['TNCN'];

			$ThucLanh_1=$ThucLanh_1+$vrow['ThucLanh'];
			$SoNguoiPhuThuoc_1=$SoNguoiPhuThuoc_1+$vrow['SoNguoiPhuThuoc'];
			$TongGiamTru_1=$TongGiamTru_1+$vrow['TongGiamTru'];
			$BHXHNLD_1=$BHXHNLD_1+$vrow['BHXHNLD'];
			$TongThuNhapTruocTongGiamTru_1=$TongThuNhapTruocTongGiamTru_1+$vrow['TongThuNhapTruocTongGiamTru'];
			$TNCN_1=$TNCN_1+$vrow['TNCN'];


			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@01",$vOrder%2,$vLineOne);
			$vLineOne=str_replace("@02", $vOrder, $vLineOne);
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['TenNV'],$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['CMND'],$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['MST'],$vLineOne);
			$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['ThucLanh'],20),$vLineOne);
			$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['SoNguoiPhuThuoc'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['TongGiamTru'],20),$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['BHXHNLD'],20),$vLineOne);
			$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['TongThuNhapTruocTongGiamTru'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['TNCN'],20),$vLineOne);
			$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
		}
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+1, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_1,20),$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_1,20),$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD,20),$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($TNCN,20),$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+2, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_0,20),$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD_0,20),$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($TNCN_0,20),$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBoldChu;
		$vLineOne = str_replace("@02", $vOrder+3, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Bằng chữ:',$vLineOne);
		$vLineOne=str_replace("@#03",LNum2Text($vlv050_1,$this->lang),$vLineOne);
		

		//$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		$strFullTbl=str_replace("@!79",$vOrder+3,$strFullTbl);
		return $strFullTbl;	
	}
	function LV_QuyetToanThueTNCNYear2019($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<table border="1" cellspacing="0" style="width: 100%;">
	<tbody>
		<tr>
			<td class="lvhtable" align="center"   height="120" rowspan="2" valign="middle"><b><font size="1">STT</font></b></td>
			<td class="lvhtable" align="center"   rowspan="2" sdnum="1033;0;@" valign="middle"><b><font size="1">Họ v&agrave; t&ecirc;n (*)</font></b></td>
			<td class="lvhtable" align="center"   rowspan="2" sdnum="1033;0;@" valign="middle"><b><font size="1">M&atilde; số thuế</font></b></td>
			<td class="lvhtable" align="center"   rowspan="2" sdnum="1033;0;@" valign="middle"><b><font size="1">Số CMND/Hộ chiếu</font></b></td>
			<td class="lvhtable" align="center"   rowspan="2" sdnum="1033;0;@" valign="middle"><b><font size="1">Thu nhập chịu thuế</font></b></td>
			<td class="lvhtable" align="center"   colspan="4" sdnum="1033;0;#,##0" valign="middle"><b><font size="1">C&aacute;c khoản giảm trừ</font></b></td>
			<td class="lvhtable" align="center"   rowspan="2" sdnum="1033;0;@" valign="middle"><b><font size="1">Thu nhập t&iacute;nh thuế</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center"   sdnum="1033;0;#,##0" valign="middle"><b><font size="1">Tổng số tiền giảm trừ gia cảnh</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;#,##0" valign="middle"><b><font size="1">Từ thiện, nh&acirc;n đạo, khuyến học</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;#,##0" valign="middle"><b><font size="1">Bảo hiểm được trừ</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;#,##0" valign="middle"><b><font size="1">Quỹ hưu tr&iacute; tự nguyện được trừ</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center"   height="29" valign="middle"><b><font size="1">[06]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[07]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[08]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[09]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[10]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[11]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[12]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[13]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[14]</font></b></td>
			<td class="lvhtable" align="center"   sdnum="1033;0;@" valign="middle"><b><font size="1">[15]</font></b></td>
		</tr>
		
		@#01
			@#02
	</tbody>
</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td colspan="17">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
		</tr>';
	$vTR='
	<tr id="CC_Title_@#01"></tr>
	<tr id="CCC_Title_@#01"></tr>
	<tr height="17" onDblClick="Show_CC_Title(@#01)" class="lvlinehtable@01">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap"><strong>@#02</strong></td>
			<td align=center style="white-space:nowrap"><strong>@#03</strong></td>
			<td align=center><strong>@#04<strong></td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>

		</tr>';
		$vTRBold='<tr height="17" style="background:yellow;font-weight:bold;">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=right><strong>@#03</strong></td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right id="col_8_@02"><strong>@#08</strong></td>
			<td align=right id="col_9_@02"><strong>@#09</strong></td>
			<td align=right id="col_10_@02"><strong>@#10</strong></td>
		</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left colspan="6"><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_10_@02"> </td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		if($this->isHDCheck==1)
			$sqlS = "SELECT A.lv002,SUM(A.lv033) ThucLanh,SUM(IF(A.lv070>0,A.lv070,0)) TongThuNhapTruocTongGiamTru,SUM(A.lv044) TongGiamTru,SUM(A.lv040) BHXHNLD,SUM(A.lv070) ThuNhapTinhThue,SUM(A.lv045) TNCN,B.lv030 lv503,B.lv005 Position,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST,B.lv049 SoNguoiPhuThuoc  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCalYear()." group by A.lv002 $strSort LIMIT $curRow, $maxRows";
		else
			$sqlS = "SELECT A.lv002,SUM(A.lv033) ThucLanh,SUM(IF(A.lv070>0,A.lv070,0)) TongThuNhapTruocTongGiamTru,SUM(A.lv044) TongGiamTru,SUM(A.lv040) BHXHNLD,SUM(A.lv070) ThuNhapTinhThue,SUM(A.lv045) TNCN,B.lv030 lv503,B.lv005 Position,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST,B.lv049 SoNguoiPhuThuoc  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCalYear()."  group by A.lv002 $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		//Mo rong
		$vlv016_0=0;
		$vlv017_0=0;
		$vlv018_0=0;
		$vlv019_0=0;
		$vlv020_0=0;
		$vlv021_0=0;
		$vlv022_0=0;
		$vlv023_0=0;
		$vlv027_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_1,20),$vLineOne);
					$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_1,20),$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD,20),$vLineOne);
					$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru,20),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($TNCN,20),$vLineOne);
					$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
				
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$ThucLanh_1=0;
					$SoNguoiPhuThuoc_1=0;
					$TongGiamTru_1=0;
					$BHXHNLD_1=0;
					$TongThuNhapTruocTongGiamTru_1=0;
					$TNCN_1=0;

				}
				$strDepart=$vrow['DeptID'];
			}

			$ThucLanh_0=$ThucLanh_0+$vrow['ThucLanh'];
			$SoNguoiPhuThuoc_0=$SoNguoiPhuThuoc_0+$vrow['SoNguoiPhuThuoc'];
			$TongGiamTru_0=$TongGiamTru_0+$vrow['TongGiamTru'];
			$BHXHNLD_0=$BHXHNLD_0+$vrow['BHXHNLD'];
			$TongThuNhapTruocTongGiamTru_0=$TongThuNhapTruocTongGiamTru_0+$vrow['TongThuNhapTruocTongGiamTru'];
			$TNCN_0=$TNCN_0+$vrow['TNCN'];

			$ThucLanh_1=$ThucLanh_1+$vrow['ThucLanh'];
			$SoNguoiPhuThuoc_1=$SoNguoiPhuThuoc_1+$vrow['SoNguoiPhuThuoc'];
			$TongGiamTru_1=$TongGiamTru_1+$vrow['TongGiamTru'];
			$BHXHNLD_1=$BHXHNLD_1+$vrow['BHXHNLD'];
			$TongThuNhapTruocTongGiamTru_1=$TongThuNhapTruocTongGiamTru_1+$vrow['TongThuNhapTruocTongGiamTru'];
			$TNCN_1=$TNCN_1+$vrow['TNCN'];


			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@01",$vOrder%2,$vLineOne);
			$vLineOne=str_replace("@02", $vOrder, $vLineOne);
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['TenNV'],$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['CMND'],$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['MST'],$vLineOne);
			$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['ThucLanh'],20),$vLineOne);
			$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['SoNguoiPhuThuoc'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['TongGiamTru'],20),$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['BHXHNLD'],20),$vLineOne);
			$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['TongThuNhapTruocTongGiamTru'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['TNCN'],20),$vLineOne);
			$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
		}
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+1, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_1,20),$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_1,20),$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD,20),$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($TNCN,20),$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+2, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_0,20),$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD_0,20),$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($TNCN_0,20),$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBoldChu;
		$vLineOne = str_replace("@02", $vOrder+3, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Bằng chữ:',$vLineOne);
		$vLineOne=str_replace("@#03",LNum2Text($vlv050_1,$this->lang),$vLineOne);
		

		//$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		$strFullTbl=str_replace("@!79",$vOrder+3,$strFullTbl);
		return $strFullTbl;	
	}
	function LV_QuyetToanThueTNCNYearQui($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<table border="1" cellspacing="0" style="width: 100%;">
	<tbody>
		<tr>
			<td class="lvhtable" align="center" height="123" rowspan="3" valign="middle"><b><font size="1">STT</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Họ v&agrave; t&ecirc;n (*)</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">M&atilde; số thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số CMND/Hộ chiếu</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">C&aacute; nh&acirc;n uỷ quyền quyết to&aacute;n thay</font></b></td>
			<td class="lvhtable" align="center" colspan="3" valign="middle"><b><font size="1">Thu nhập chịu thuế</font></b></td>
			<td class="lvhtable" align="center" colspan="5" valign="middle"><b><font size="1">C&aacute;c khoản giảm trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Thu nhập t&iacute;nh<br />
				thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số thuế TNCN đ&atilde; khấu trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">Số thuế TNCN được giảm do l&agrave;m việc trong KKT</font></b></td>
			<td class="lvhtable" align="center" rowspan="3" valign="middle"><b><font size="1">C&aacute; nh&acirc;n nước ngo&agrave;i uỷ quyền quyết to&aacute;n dưới 12 th&aacute;ng/năm</font></b></td>
			<td class="lvhtable" align="center" colspan="3" valign="middle"><b><font size="1">Chi tiết kết quả quyết to&aacute;n thay cho c&aacute; nh&acirc;n nộp thuế</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số</font></b></td>
			<td class="lvhtable" align="center" colspan="2" valign="middle"><b><font size="1">Trong đ&oacute;: TNCT l&agrave;m căn cứ t&iacute;nh giảm thuế</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số lượng NPT t&iacute;nh giảm trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số tiền giảm trừ gia cảnh</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Từ thiện, nh&acirc;n đạo, khuyến học</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Bảo hiểm được trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Quĩ hưu tr&iacute; tự nguyện được trừ</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Tổng số thuế phải nộp</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số thuế đ&atilde; nộp thừa</font></b></td>
			<td class="lvhtable" align="center" rowspan="2" valign="middle"><b><font size="1">Số thuế c&ograve;n phải nộp</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">L&agrave;m việc trong KKT</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">Theo Hiệp định</font></b></td>
		</tr>
		<tr>
			<td class="lvhtable" align="center" height="29" valign="middle"><b><font size="1">[06]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[07]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[08]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[09]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[10]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[11]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[12]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[13]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[14]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[15]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[16]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[17]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[18]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[19]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[20]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[21]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1"></font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[22]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[23]</font></b></td>
			<td class="lvhtable" align="center" valign="middle"><b><font size="1">[24]</font></b></td>
		</tr>
		
		@#01
			@#02
	</tbody>
</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td colspan="17">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13/td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">@#17</td>
			<td align=right id="col_18_@02">@#18</td>
			<td align=right id="col_19_@02">@#19</td>
			<td align=right>&nbsp;</td>
		</tr>';
	$vTR='
	<tr id="CC_Title_@#01"></tr>
	<tr id="CCC_Title_@#01"></tr>
	<tr height="17" onDblClick="Show_CC_Title(@#01)" class="lvlinehtable@01">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap"><strong>@#02</strong></td>
			<td align=center style="white-space:nowrap"><strong>@#03</strong></td>
			<td align=center><strong>@#04<strong></td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13</td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">@#17</td>
			<td align=right id="col_18_@02">@#18</td>
			<td align=right id="col_19_@02">@#19</td>
			<td align=right id="col_17_@02">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

		</tr>';
		$vTRBold='<tr height="17" style="background:yellow;font-weight:bold;">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=right><strong>@#03</strong></td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right id="col_8_@02"><strong>@#08</strong></td>
			<td align=right id="col_9_@02"><strong>@#09</strong></td>
			<td align=right id="col_10_@02"><strong>@#10</strong></td>
			<td align=right id="col_11_@02"><strong>@#11</strong></td>
			<td align=right id="col_12_@02"><strong>@#12</strong></td>
			<td align=right id="col_13_@02"><strong>@#13</strong></td>
			<td align=right id="col_14_@02"><strong>@#14</strong></td>
			<td align=right id="col_15_@02"><strong>@#15</strong></td>
			<td align=right id="col_16_@02"><strong>@#16</strong></td>
			<td align=right id="col_17_@02"><strong>@#17</strong></td>
			<td align=right id="col_18_@02"><strong>@#18</strong></td>
			<td align=right id="col_19_@02"><strong>@#19</strong></td>
			<td align=right id="col_20_@02"><strong>&nbsp;</strong></td>
		</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left colspan="6"><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_11_@02"> </td>
			<td align=right id="col_12_@02"> </td>
			<td align=right id="col_13_@02"> </td>
			<td align=right id="col_14_@02"> </td>
			<td align=right id="col_15_@02"> </td>
			<td align=right id="col_16_@02"> </td>
			<td align=right id="col_17_@02"></td>
			<td align=right id="col_18_@02"></td>
			<td align=right id="col_19_@02"></td>
			<td align=right id="col_20_@02"></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		if($this->isHDCheck==1)
			$sqlS = "SELECT A.lv002,SUM(A.lv033) ThucLanh,SUM(IF(A.lv070>0,A.lv070,0)) TongThuNhapTruocTongGiamTru,SUM(A.lv044) TongGiamTru,SUM(A.lv040) BHXHNLD,SUM(A.lv070) ThuNhapTinhThue,SUM(A.lv045) TNCN,B.lv030 lv503,B.lv005 Position,AA.lv010 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST,B.lv049 SoNguoiPhuThuoc  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCalYearQuy()." group by A.lv002 $strSort LIMIT $curRow, $maxRows";
		else
			$sqlS = "SELECT A.lv002,SUM(A.lv033) ThucLanh,SUM(IF(A.lv070>0,A.lv070,0)) TongThuNhapTruocTongGiamTru,SUM(A.lv044) TongGiamTru,SUM(A.lv040) BHXHNLD,SUM(A.lv070) ThuNhapTinhThue,SUM(A.lv045) TNCN,B.lv030 lv503,B.lv005 Position,AA.lv004 DeptID,B.lv002 TenNV,B.lv010 CMND,B.lv013 MST,B.lv049 SoNguoiPhuThuoc  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCalYearQuy()."  group by A.lv002 $strSort LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		//Mo rong
		$vlv016_0=0;
		$vlv017_0=0;
		$vlv018_0=0;
		$vlv019_0=0;
		$vlv020_0=0;
		$vlv021_0=0;
		$vlv022_0=0;
		$vlv023_0=0;
		$vlv027_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_1,20),$vLineOne);
					$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_1,20),$vLineOne);
					$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD,20),$vLineOne);
					$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru,20),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($TNCN,20),$vLineOne);
					$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
					$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
				
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							
							$strTrH='';
							break;
					}
					$ThucLanh_1=0;
					$SoNguoiPhuThuoc_1=0;
					$TongGiamTru_1=0;
					$BHXHNLD_1=0;
					$TongThuNhapTruocTongGiamTru_1=0;
					$TNCN_1=0;

				}

				$strDepart=$vrow['DeptID'];
			}

			$ThucLanh_0=$ThucLanh_0+$vrow['ThucLanh'];
			$SoNguoiPhuThuoc_0=$SoNguoiPhuThuoc_0+$vrow['SoNguoiPhuThuoc'];
			$TongGiamTru_0=$TongGiamTru_0+$vrow['TongGiamTru'];
			$BHXHNLD_0=$BHXHNLD_0+$vrow['BHXHNLD'];
			$TongThuNhapTruocTongGiamTru_0=$TongThuNhapTruocTongGiamTru_0+$vrow['TongThuNhapTruocTongGiamTru'];
			$TNCN_0=$TNCN_0+$vrow['TNCN'];

			$ThucLanh_1=$ThucLanh_1+$vrow['ThucLanh'];
			$SoNguoiPhuThuoc_1=$SoNguoiPhuThuoc_1+$vrow['SoNguoiPhuThuoc'];
			$TongGiamTru_1=$TongGiamTru_1+$vrow['TongGiamTru'];
			$BHXHNLD_1=$BHXHNLD_1+$vrow['BHXHNLD'];
			$TongThuNhapTruocTongGiamTru_1=$TongThuNhapTruocTongGiamTru_1+$vrow['TongThuNhapTruocTongGiamTru'];
			$TNCN_1=$TNCN_1+$vrow['TNCN'];


			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@01",$vOrder%2,$vLineOne);
			$vLineOne=str_replace("@02", $vOrder, $vLineOne);
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['TenNV'],$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['CMND'],$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['MST'],$vLineOne);
			$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['ThucLanh'],20),$vLineOne);
			$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['SoNguoiPhuThuoc'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['TongGiamTru'],20),$vLineOne);
			$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['BHXHNLD'],20),$vLineOne);
			$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['TongThuNhapTruocTongGiamTru'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['TNCN'],20),$vLineOne);
			$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
			$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
		}
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+1, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_1,20),$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_1,20),$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD,20),$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($TNCN,20),$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#20","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#21","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#22","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#23","&nbsp;",$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+2, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#04","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#05","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($ThucLanh_0,20),$vLineOne);
		$vLineOne=str_replace("@#07","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#08","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($SoNguoiPhuThuoc_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($TongGiamTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#11","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($BHXHNLD_0,20),$vLineOne);
		$vLineOne=str_replace("@#13","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($TongThuNhapTruocTongGiamTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($TNCN_0,20),$vLineOne);
		$vLineOne=str_replace("@#16","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#17","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#18","&nbsp;",$vLineOne);
		$vLineOne=str_replace("@#19","&nbsp;",$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBoldChu;
		$vLineOne = str_replace("@02", $vOrder+3, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Bằng chữ:',$vLineOne);
		$vLineOne=str_replace("@#03",LNum2Text($vlv050_1,$this->lang),$vLineOne);
		

		//$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		$strFullTbl=str_replace("@!79",$vOrder+3,$strFullTbl);
		return $strFullTbl;	
	}
	function LV_LuongGiaiNgan($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="1" cellspacing="1" style="width:1077px" >
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;" width="1645">
			<tbody>
			<tr height="25" id="CC_Title" class="lvhtable">
			<td align="left" height="79" rowspan="2"  valign="middle"  class="lvhtable"><b>STT </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>T&ecirc;n NV </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Lương </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b><font size="1">Lương CB </font></b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Số ng&agrave;y c&ocirc;ng </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Tiền lương thực tế </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Số ng&agrave;y nghỉ lế </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Tiền lương nghỉ lễ </b></td>
			<td align="center" colspan="5"  valign="middle" class="lvhtable"><b>Phụ cấp </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>C&aacute;c khoản trừ kh&aacute;c </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Tạm ứng </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>Thực l&atilde;nh </b></td>
			<td align="center" rowspan="2"  valign="middle" class="lvhtable"><b>K&yacute; nhận </b></td>
		</tr>
		<tr id="CCC_Title" class="lvhtable">
			<td align="center"  valign="middle" class="lvhtable"><b>ABC </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>PCCT </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>PCTN </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>Tăng ca </b></td>
			<td align="center"  valign="middle" class="lvhtable"><b>Cộng kh&aacute;c </b></td>
		</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td colspan="17">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13/td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right>&nbsp;</td>
		</tr>';
	$vTR='
	<tr id="CC_Title_@#01"></tr>
	<tr id="CCC_Title_@#01"></tr>
	<tr height="17" onDblClick="Show_CC_Title(@#01)" class="lvlinehtable@01">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap"><strong>@#02</strong></td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_10_@02">@#10</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13</td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#15</td>
			<td align=right id="col_16_@02">@#16</td>
			<td align=right id="col_17_@02">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

		</tr>';
		$vTRBold='<tr height="17" style="background:yellow;font-weight:bold;">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=right><strong>@#03</strong></td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right id="col_8_@02"><strong>@#08</strong></td>
			<td align=right id="col_9_@02"><strong>@#09</strong></td>
			<td align=right id="col_10_@02"><strong>@#10</strong></td>
			<td align=right id="col_11_@02"><strong>@#11</strong></td>
			<td align=right id="col_12_@02"><strong>@#12</strong></td>
			<td align=right id="col_13_@02"><strong>@#13</strong></td>
			<td align=right id="col_14_@02"><strong>@#14</strong></td>
			<td align=right id="col_15_@02"><strong>@#15</strong></td>
			<td align=right id="col_16_@02"><strong>@#16</strong></td>
			<td align=right id="col_17_@02"><strong>&nbsp;</strong></td>
		</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left colspan="6"><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_11_@02"> </td>
			<td align=right id="col_12_@02"> </td>
			<td align=right id="col_13_@02"> </td>
			<td align=right id="col_14_@02"> </td>
			<td align=right id="col_15_@02"> </td>
			<td align=right id="col_16_@02"> </td>
			<td align=right id="col_17_@02"></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		//Mo rong
		$vlv016_0=0;
		$vlv017_0=0;
		$vlv018_0=0;
		$vlv019_0=0;
		$vlv020_0=0;
		$vlv021_0=0;
		$vlv022_0=0;
		$vlv023_0=0;
		$vlv027_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03",$this->FormatView($vlv078_1,20),$vLineOne);
					$vLineOne=str_replace("@#04",$this->FormatView($vlv008_1,20),$vLineOne);
					$vLineOne=str_replace("@#05",$this->FormatView($vlv025_1,20),$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv024_1,20),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv018_1,20),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv023_1,20),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv051_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv076_1,20),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv075_1,20),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vTangCa_1,20),$vLineOne);
					$vLineOne=str_replace("@#13",$this->FormatView($vCongKhac_1,20),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vTongTru_1,20),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($vTamUng_1,20),$vLineOne);
					$vLineOne=str_replace("@#16",$this->FormatView($vlv050_1,20),$vLineOne);
				
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv079_1=0;
					$vlv024_1=0;
					$vlv019_1=0;
					$vlv028_1=0;
					$vlv015_1=0;
					$vlv020_1=0;
					$vlv016_1=0;
					$vlv021_1=0;
					$vlv017_1=0;
					$vlv022_1=0;
					$vlv022_1=0;
					$vlv022_1=0;
					$vkhongcong_1=0;
					$vTangCa_1=0;
					$vCongKhac_1=0;
					$vTongTru_1=0;


					$vlv025_1=0;
					$vlv085_1=0;
					$vlv043_1=0;
					$vlv039_1=0;
					$vlv045_1=0;
					$vlv035_1=0;
					$vlv048_1=0;
					$vlv084_1=0;
					$vlv080_1=0;
					$vlv050_1=0;
					$vlv051_1=0;
					$vlv092_1=0;
					$vlv027_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vkhongcong_1=$vkhongcong_1+(float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'];
			$vkhongcong_0=$vkhongcong_0+(float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'];
			$vlv079_0=$vlv079_0+$vrow['lv079'];
			$vlv024_0=$vlv024_0+$vrow['lv024'];
			$vlv019_0=$vlv019_0+$vrow['lv019'];
			$vlv028_0=$vlv028_0+$vrow['lv028'];
			
			$vlv015_0=$vlv015_0+$vrow['lv015'];
			$vlv020_0=$vlv020_0+$vrow['lv020'];
			$vlv016_0=$vlv016_0+$vrow['lv016'];
			$vlv021_0=$vlv021_0+$vrow['lv021'];
			$vlv017_0=$vlv017_0+$vrow['lv017'];
			$vlv022_0=$vlv022_0+$vrow['lv022'];
			$vlv048_0=$vlv048_0+$vrow['lv048'];

			$vlv050_0=$vlv050_0+$vrow['lv050'];
			$vlv051_0=$vlv051_0+$vrow['lv051'];
			$vlv025_0=$vlv025_0+$vrow['lv025'];
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv039_0=$vlv039_0+$vrow['lv039'];
			$vlv080_0=$vlv080_0+$vrow['lv080'];
			$vlv092_0=$vlv092_0+$vrow['lv092'];
			$vlv078_0=$vlv078_0+$vrow['lv078'];
			$vlv008_0=$vlv008_0+$vrow['lv008'];

			$vTangCa_0=$vTangCa_0+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022'];
			$vCongKhac_0=$vCongKhac_0+(float)$vrow['lv033']-($vrow['lv024']+$vrow['lv051']+$vrow['lv076']+$vrow['lv075']+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022']);
			$vTongTru_0=$vTongTru_0+$vrow['lv048']-$vrow['lv027'];
			$vlv027_0=$vlv027_0+$vrow['lv027'];
			$vPIT=$vrow['lv045'];
			
			$vlv046_0=$vlv046_0+$vrow['lv046']-$vrow['lv088'];
			$vlv035_0=$vlv035_0+$vrow['lv035'];
			
			$vlv079_1=$vlv079_1+$vrow['lv079'];
			$vlv024_1=$vlv024_1+$vrow['lv024'];
			$vlv019_1=$vlv019_1+$vrow['lv019'];
			$vlv028_1=$vlv028_1+$vrow['lv028'];
			$vlv015_1=$vlv015_1+$vrow['lv015'];
			$vlv020_1=$vlv020_1+$vrow['lv020'];
			$vlv016_1=$vlv016_1+$vrow['lv016'];
			$vlv021_1=$vlv021_1+$vrow['lv021'];
			$vlv017_1=$vlv017_1+$vrow['lv017'];
			$vlv022_1=$vlv022_1+$vrow['lv022'];$


			$vlv048_1=$vlv048_1+$vrow['lv048'];

			$vlv050_1=$vlv050_1+$vrow['lv050'];
			$vlv051_1=$vlv051_1+$vrow['lv051'];
			$vlv025_1=$vlv025_1+$vrow['lv025'];
			$vlv085_1=$vlv085_1+$vrow['lv085'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv039_1=$vlv039_1+$vrow['lv039'];
			
			$vlv046_1=$vlv046_1+$vrow['lv046']-$vrow['lv088'];
			$vlv035_1=$vlv035_1+$vrow['lv035'];
			$vlv080_1=$vlv080_1+$vrow['lv080'];
			$vlv092_1=$vlv092_1+$vrow['lv092'];
			$vlv078_1=$vlv078_1+$vrow['lv078'];
			$vlv008_1=$vlv008_1+$vrow['lv008'];

			$vTangCa_1=$vTangCa_1+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022'];
			$vCongKhac_1=$vCongKhac_1+(float)$vrow['lv033']-($vrow['lv024']+$vrow['lv051']+$vrow['lv076']+$vrow['lv075']+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022']);
			$vTongTru_1=$vTongTru_1+$vrow['lv048']-$vrow['lv027'];
			$vlv027_1=$vlv027_1+$vrow['lv027'];
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@01",$vOrder%2,$vLineOne);
			$vLineOne = str_replace("@02", $vOrder, $vLineOne);
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['TenNV'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->FormatView($vrow['lv078'],20),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['lv008'],20),$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vrow['lv025'],20),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv024'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv018'],20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv023'],20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv051'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv076'],20),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv075'],20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView((float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022'],20),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView((float)$vrow['lv033']-($vrow['lv024']+$vrow['lv051']+$vrow['lv076']+$vrow['lv075']+(float)$vrow['lv020']+(float)$vrow['lv021']+(float)$vrow['lv022']),20),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['lv048']-$vrow['lv027'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['lv027'],20),$vLineOne);
			$vLineOne=str_replace("@#16",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
		}
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+1, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vlv078_1,20),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vlv008_1,20),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vlv025_1,20),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv024_1,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv018_1,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv023_1,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv051_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv076_1,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv075_1,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTangCa_1,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vCongKhac_1,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vTongTru_1,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv027_1,20),$vLineOne);
		$vLineOne=str_replace("@#16",$this->FormatView($vlv050_1,20),$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+2, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vlv078_0,20),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vlv008_0,20),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vlv025_0,20),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv024_0,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv018_0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv023_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv051_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv076_0,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv075_0,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTangCa_0,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vCongKhac_0,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vTongTru_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv027_0,20),$vLineOne);
		$vLineOne=str_replace("@#16",$this->FormatView($vlv050_0,20),$vLineOne);

		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBoldChu;
		$vLineOne = str_replace("@02", $vOrder+3, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Bằng chữ:',$vLineOne);
		$vLineOne=str_replace("@#03",LNum2Text($vlv050_1,$this->lang),$vLineOne);
		

		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		$strFullTbl=str_replace("@!79",$vOrder+3,$strFullTbl);
		return $strFullTbl;	
	}
	function LV_LuongVanPhongChinh($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="1" cellspacing="1" style="width:1077px" >
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" style="width: 100%;" width="1645">
			<colgroup><col width="42"></col> <col width="166"></col> <col width="64"></col> <col width="71"></col> <col width="97"></col> <col width="71"></col> <col width="99"></col> <col width="72"></col> <col width="118"></col> <col width="125"></col> <col width="152"></col> </colgroup> 
			<tbody>
			<tr height="25" id="CC_Title">
			<td width="42" height="50" align="center"><strong>STT</strong></td>
			<td width="166" align="center"><strong>Họ v&agrave; T&ecirc;n</strong></td>
			<td width="64" align="center"><strong>C&ocirc;ng</strong></td>
			<td width="71" align="center"><strong>Tiền lương ng&agrave;y</strong></td>
			<td width="97" align="center"><strong>Lương thực tế</strong></td>
			'.(($this->isABC)?'<td width="71" align="center"><strong>ABC</strong></td>':'').'
			<td width="71" align="center"><strong>Chủ nhật</strong></td>
			<td width="99" align="center"><strong>Tiền lương chủ nhật</strong></td>
			<td width="72" align="center" ondblclick="RemoveCol(\'col_8\',this,@!79)"><strong>Giờ tăng (150%)</strong></td>
			<td width="118" align="center" ondblclick="RemoveCol(\'col_9\',this,@!79)"><strong>Tiền lương tăng ca(150%)</strong></td>
			<td width="72" align="center" ondblclick="RemoveCol(\'col_11\',this,@!79)"><strong>Giờ tăng (200%)</strong></td>
			<td width="118" align="center" ondblclick="RemoveCol(\'col_12\',this,@!79)"><strong>Tiền lương tăng ca(200%)</strong></td>
			<td width="72" align="center" ondblclick="RemoveCol(\'col_13\',this,@!79)"><strong>Giờ tăng (300%)</strong></td>
			<td width="118" align="center" ondblclick="RemoveCol(\'col_14\',this,@!79)"><strong>Tiền lương tăng ca(300%)</strong></td>
			<td width="118" align="center" ondblclick="RemoveCol(\'col_15\',this,@!79)"><strong>Tiền ăn tăng ca</strong></td>
			<td width="118" align="center" ondblclick="RemoveCol(\'col_16\',this,@!79)"><strong>Khoản cộng</strong></td>
			<td width="118" align="center" ondblclick="RemoveCol(\'col_17\',this,@!79)"><strong>Khoản trừ</strong></td>
			<td width="125" align="center"><strong>Thực nhận</strong></td>
			<td width="152" align="center"><strong>K&yacute; nhận</strong></td>
			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td colspan="21">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap">@#02</td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			'.(($this->isABC)?'<td align=right>@#15</td>':'').'
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13</td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#16</td>
			<td align=right id="col_16_@02">@#17</td>
			<td align=right id="col_17_@02">@#18</td>
			<td align=right>@#10</td>
			<td align=right>&nbsp;</td>

		</tr>';
	$vTR='
	<tr id="CC_Title_@#01"></tr>
	<tr height="17" onDblClick="Show_CC_Title(@#01)">
			<td height="17" >'.(($sExport == "excel")?'<Data ss:Type="String">="@#01"':'@#01').'</td>
			<td style="white-space:nowrap"><strong>@#02</strong></td>
			<td align=right style="white-space:nowrap">@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			'.(($this->isABC)?'<td align=right>@#15</td>':'').'
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right id="col_8_@02">@#08</td>
			<td align=right id="col_9_@02">@#09</td>
			<td align=right id="col_11_@02">@#11</td>
			<td align=right id="col_12_@02">@#12</td>
			<td align=right id="col_13_@02">@#13</td>
			<td align=right id="col_14_@02">@#14</td>
			<td align=right id="col_15_@02">@#16</td>
			<td align=right id="col_16_@02">@#17</td>
			<td align=right id="col_17_@02">@#18</td>
			<td align=right>@#10</td>
			<td align=right>&nbsp;</td>

		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=right>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			'.(($this->isABC)?'<td align=right>@#15</td>':'').'
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right id="col_8_@02"><strong>@#08</strong></td>
			<td align=right id="col_9_@02"><strong>@#09</strong></td>
			<td align=right id="col_11_@02"><strong>@#11</strong></td>
			<td align=right id="col_12_@02"><strong>@#12</strong></td>
			<td align=right id="col_13_@02"><strong>@#13</strong></td>
			<td align=right id="col_14_@02"><strong>@#14</strong></td>
			<td align=right id="col_15_@02"><strong>@#16</strong></td>
			<td align=right id="col_16_@02"><strong>@#17</strong></td>
			<td align=right id="col_17_@02"><strong>@#18</strong></td>
			<td align=right><strong>@#10</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
		</tr>';
		$vTRBoldChu='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td align=left '.(($this->isABC)?'colspan="6"':'colspan="5"').'><strong>@#03</strong></td>
			<td align=right id="col_8_@02"> </td>
			<td align=right id="col_9_@02"> </td>
			<td align=right id="col_11_@02"> </td>
			<td align=right id="col_12_@02"> </td>
			<td align=right id="col_13_@02"> </td>
			<td align=right id="col_14_@02"> </td>
			<td align=right id="col_15_@02"> </td>
			<td align=right id="col_16_@02"> </td>
			<td align=right id="col_17_@02"></td>
			<td align=right><strong>&nbsp;</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				if($this->isHDCheck==1)
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv010 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join hr_lv0038 AA on AA.lv002=A.lv002 and AA.lv001=A.lv056  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				else
					$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv002 TenNV  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		$vlv079_0=0;
		$vlv024_0=0;
		$vlv019_0=0;
		$vlv028_0=0;
		$vlv015_0=0;
		$vlv020_0=0;
		$vlv050_0=0;
		$vlv025_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vlv080_0=0;
		//Mo rong
		$vlv016_0=0;
		$vlv017_0=0;
		$vlv018_0=0;
		$vlv019_0=0;
		$vlv020_0=0;
		$vlv021_0=0;
		$vlv022_0=0;
		$vlv023_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03",$this->FormatView($vlv025_1,20),$vLineOne);
					$vLineOne=str_replace("@#04",$this->FormatView($vlv079_1,20),$vLineOne);
					$vLineOne=str_replace("@#05",$this->FormatView($vlv024_1,20),$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv019_1,20),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv028_1,20),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv015_1,20),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv020_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv050_1,20),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv016_1,20),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vlv021_1,20),$vLineOne);
					$vLineOne=str_replace("@#13",$this->FormatView($vlv017_1,20),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vlv022_1,20),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($vlv051_1,20),$vLineOne);
					$vLineOne=str_replace("@#16",$this->FormatView($vlv092_1,20),$vLineOne);
					$vLineOne=str_replace("@#17",$this->FormatView($vkhongcong_1,20),$vLineOne);
					$vLineOne=str_replace("@#18",$this->FormatView($vlv048_1,20),$vLineOne);
				
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strTable=str_replace("@!01",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv079_1=0;
					$vlv024_1=0;
					$vlv019_1=0;
					$vlv028_1=0;
					$vlv015_1=0;
					$vlv020_1=0;
					$vlv016_1=0;
					$vlv021_1=0;
					$vlv017_1=0;
					$vlv022_1=0;
					$vlv022_1=0;
					$vlv022_1=0;
					$vkhongcong_1=0;


					$vlv025_1=0;
					$vlv085_1=0;
					$vlv043_1=0;
					$vlv039_1=0;
					$vlv045_1=0;
					$vlv035_1=0;
					$vlv048_1=0;
					$vlv084_1=0;
					$vlv080_1=0;
					$vlv050_1=0;
					$vlv051_1=0;
					$vlv092_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vkhongcong_1=$vkhongcong_1+(float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'];
			$vkhongcong_0=$vkhongcong_0+(float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'];
			$vlv079_0=$vlv079_0+$vrow['lv079'];
			$vlv024_0=$vlv024_0+$vrow['lv024'];
			$vlv019_0=$vlv019_0+$vrow['lv019'];
			$vlv028_0=$vlv028_0+$vrow['lv028'];
			
			$vlv015_0=$vlv015_0+$vrow['lv015'];
			$vlv020_0=$vlv020_0+$vrow['lv020'];
			$vlv016_0=$vlv016_0+$vrow['lv016'];
			$vlv021_0=$vlv021_0+$vrow['lv021'];
			$vlv017_0=$vlv017_0+$vrow['lv017'];
			$vlv022_0=$vlv022_0+$vrow['lv022'];
			$vlv048_0=$vlv048_0+$vrow['lv048'];

			$vlv050_0=$vlv050_0+$vrow['lv050'];
			$vlv051_0=$vlv051_0+$vrow['lv051'];
			$vlv025_0=$vlv025_0+$vrow['lv025'];
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv039_0=$vlv039_0+$vrow['lv039'];
			$vlv080_0=$vlv080_0+$vrow['lv080'];
			$vlv092_0=$vlv092_0+$vrow['lv092'];
			$vPIT=$vrow['lv045'];
			
			$vlv046_0=$vlv046_0+$vrow['lv046']-$vrow['lv088'];
			$vlv035_0=$vlv035_0+$vrow['lv035'];
			
			$vlv079_1=$vlv079_1+$vrow['lv079'];
			$vlv024_1=$vlv024_1+$vrow['lv024'];
			$vlv019_1=$vlv019_1+$vrow['lv019'];
			$vlv028_1=$vlv028_1+$vrow['lv028'];
			$vlv015_1=$vlv015_1+$vrow['lv015'];
			$vlv020_1=$vlv020_1+$vrow['lv020'];
			$vlv016_1=$vlv016_1+$vrow['lv016'];
			$vlv021_1=$vlv021_1+$vrow['lv021'];
			$vlv017_1=$vlv017_1+$vrow['lv017'];
			$vlv022_1=$vlv022_1+$vrow['lv022'];

			$vlv048_1=$vlv048_1+$vrow['lv048'];

			$vlv050_1=$vlv050_1+$vrow['lv050'];
			$vlv051_1=$vlv051_1+$vrow['lv051'];
			$vlv025_1=$vlv025_1+$vrow['lv025'];
			$vlv085_1=$vlv085_1+$vrow['lv085'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv039_1=$vlv039_1+$vrow['lv039'];
			
			$vlv046_1=$vlv046_1+$vrow['lv046']-$vrow['lv088'];
			$vlv035_1=$vlv035_1+$vrow['lv035'];
			$vlv080_1=$vlv080_1+$vrow['lv080'];
			$vlv092_1=$vlv092_1+$vrow['lv092'];
			
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne = str_replace("@02", $vOrder, $vLineOne);
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['TenNV'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->FormatView($vrow['lv025'],20),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['lv079'],20),$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vrow['lv024'],20),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv019'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv028'],20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv015'],20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv020'],20),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv016'],20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv021'],20),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vrow['lv017'],20),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['lv022'],20),$vLineOne);
			$vLineOne=str_replace("@#16",$this->FormatView($vrow['lv092'],20),$vLineOne);
			$vLineOne=str_replace("@#17",$this->FormatView((float)$vrow['lv071']+(float)$vrow['lv034']+(float)$vrow['lv086']+(float)$vrow['lv031'],20),$vLineOne);
			$vLineOne=str_replace("@#18",$this->FormatView($vrow['lv048'],20),$vLineOne);

			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['lv051'],20),$vLineOne);			
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+1, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vlv025_1,20),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vlv079_1,20),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vlv024_1,20),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv019_1,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv028_1,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv015_1,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv020_1,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv016_1,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv021_1,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv017_1,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv022_1,20),$vLineOne);
		$vLineOne=str_replace("@#16",$this->FormatView($vlv092_1,20),$vLineOne);
		$vLineOne=str_replace("@#17",$this->FormatView($vkhongcong_1,20),$vLineOne);
		$vLineOne=str_replace("@#18",$this->FormatView($vlv048_1,20),$vLineOne);

		$vLineOne=str_replace("@#10",$this->FormatView($vlv050_1,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv051_1,20),$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne = str_replace("@02", $vOrder+2, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vlv079_0,20),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vlv024_0,20),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv019_0,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv028_0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv015_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv020_0,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv016_0,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv021_0,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv017_0,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv022_0,20),$vLineOne);
		$vLineOne=str_replace("@#16",$this->FormatView($vlv092_0,20),$vLineOne);
		$vLineOne=str_replace("@#17",$this->FormatView($vkhongcong_0,20),$vLineOne);
		$vLineOne=str_replace("@#18",$this->FormatView($vlv048_0,20),$vLineOne);

		$vLineOne=str_replace("@#10",$this->FormatView($vlv050_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv051_0,20),$vLineOne);

		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBoldChu;
		$vLineOne = str_replace("@02", $vOrder+3, $vLineOne);
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Bằng chữ:',$vLineOne);
		$vLineOne=str_replace("@#03",LNum2Text($vlv050_1,$this->lang),$vLineOne);
		

		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		$strFullTbl=str_replace("@!79",$vOrder+3,$strFullTbl);
		return $strFullTbl;	
	}

	function LV_LuongNganHangMau2($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vAutoShow=rand(0,1);
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		if($vAutoShow==0)
		{
			$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="120" />
			<col width="120" />
			<col width="100" />
			<col width="100" />
			<col width="100" />
			<col width="100" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" ><center><strong>STT</strong></center></td>
				<td  ><center><strong>Họ và Tên</strong></center></td>
				<td ><center><strong>Ho va Ten</strong></center></td>
				<td ><center><strong>Chức vụ</strong></center></td>
				<td ><center><strong>Phòng ban</strong></center></td>
				<td  ><center><strong> Số Tài Khoản</strong></center></td>
				<td  ><center><strong> Chi nhánh</strong></center></td>
				<td ><center><strong> Số Tiền</strong></center></td>
				<td ><center><strong> Ghi chú</strong></center></td>
			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="8">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td nowrap  align=center>@#02</td>
			<td nowrap  align=center>@#03</td>
			<td nowrap align=center>@#04</td>
			<td nowrap align=center>@#29</td>
			<td nowrap align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td nowrap align=center>@#96</td>
			<td nowrap align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>	
			<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td nowrap  align=center>@#02</td>
			<td nowrap  align=center>@#03</td>
			<td nowrap align=center>@#04</td>
			<td nowrap align=center>@#29</td>
			<td nowrap align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td nowrap align=center>@#96</td>
			<td nowrap align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td nowrap align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>';
			
		}
		else
		{
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="120" />
			<col width="120" />
			<col width="120" />
			<col width="120" />
			<col width="120" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" ><center><strong>STT</strong></center></td>
				<td  ><center><strong>Họ và Tên</strong></center></td>
				<td ><center><strong>Ho va Ten</strong></center></td>
				<td ><center><strong>Chức vụ</strong></center></td>
				<td ><center><strong>Phòng ban</strong></center></td>
				<td  ><center><strong> Số Tài Khoản</strong></center></td>
				<td  ><center><strong> Chi nhánh</strong></center></td>
				<td ><center><strong> Số Tiền</strong></center></td>
				<td ><center><strong> Ghi chú</strong></center></td>
			</tr>
			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td  align=center>@#01</td>
			<td  align=center>@#02</td>
			<td  align=center>@#03</td>
			<td align=center>@#04</td>
			<td align=center>@#29</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td nowrap align=center>@#96</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>';
	$vTR='<tr height="17">
			<td nowrap  align=center>@#01</td>
			<td nowrap  align=center>@#02</td>
			<td nowrap  align=center>@#03</td>
			<td nowrap align=center>@#04</td>
			<td nowrap align=center>@#29</td>
			<td nowrap align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td nowrap align=center>@#96</td>
			<td nowrap align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=center nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

		</tr>';
		}
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,A.lv061 BankAcount,AA.lv004 DeptID,B.lv005 ChucVu,B.lv106 ChiNhanh  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,A.lv061 BankAcount,AA.lv004 DeptID,B.lv005 ChucVu,B.lv106 ChiNhanh  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,A.lv061 BankAcount,AA.lv004 DeptID,B.lv005 ChucVuu,B.lv106 ChiNhanh  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		
		$vlv012_0=0;
		$vlv013_0=0;
		$vlv023_0=0;
		$vlv034_0=0;
		$vlv045_0=0;
		$vlv050_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
		
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'Tổng',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",'',$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				//$vLineOne=str_replace("@#29",'',$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
				$vLineOne=str_replace("@#07",'',$vLineOne);
				$vLineOne=str_replace("@#08",'',$vLineOne);
				$strTrH=$strTrH.$vLineOne;
				switch($mau)
				{
					case 1:
						
						break;
					default:
						$strTable=str_replace("@#02",'&nbsp;',$lvTable);						
						$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
						$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
						$strTrH='';
						break;
				}

				$vlv050_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vlv050_0=$vlv050_0+$vrow['lv050'];
			
			$vlv050_1=$vlv050_1+$vrow['lv050'];
			
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
						break;
					default:
						$vLineOne=$vTR;
						
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#03",unicode_to_case($this->getvaluelink('lv007',$vrow['lv002'])),$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['ChucVu'],$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['BankAcount'],$vLineOne);
			$vLineOne=str_replace("@#96",$vrow['ChiNhanh'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#29",$this->getvaluelink('lv058',$vrow['DeptID']),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_0,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	

		}
	function LV_LuongNganHang($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vAutoShow=rand(0,1);
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		if($vAutoShow==0)
		{
			$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="120" />
			<col width="120" />
			<col width="100" />
			<col width="100" />
			<col width="100" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" ><center><strong>STT</strong></center></td>
				<td  ><center><strong>Họ và Tên</strong></center></td>
				<td ><center><strong>Ho va Ten</strong></center></td>
				<td ><center><strong>Số CMND</strong></center></td>
				<td  ><center><strong> Số Tài Khoản</strong></center></td>
				<td ><center><strong> Số Tiền</strong></center></td>
			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>@#02</td>
			<td  align=center>@#03</td>
			<td align=center>@#04</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>	
		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>@#02</td>
			<td  align=center>@#03</td>
			<td align=center>@#04</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
		</tr>';
			
		}
		else
		{
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="100" />
			<col width="100" />
			<col width="120" />
			<col width="120" />
			<col width="120" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" ><center><strong>STT</strong></center></td>
				<td  ><center><strong>Họ và Tên</strong></center></td>
				<td ><center><strong>Ho va Ten</strong></center></td>
				<td ><center><strong>Số CMND</strong></center></td>
				<td  ><center><strong> Số Tài Khoản</strong></center></td>
				<td ><center><strong> Số Tiền</strong></center></td>
			</tr>
			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td  align=center>@#01</td>
			<td  align=center>@#02</td>
			<td  align=center>@#03</td>
			<td align=center>@#04</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
		</tr>';
	$vTR='<tr height="17">
			<td  align=center>@#01</td>
			<td  align=center>@#02</td>
			<td  align=center>@#03</td>
			<td align=center>@#04</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#05"':'@#05').'</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>

		</tr>';
		}
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,A.lv061 BankAcount,AA.lv004 DeptID,B.lv010 CMND  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,A.lv061 BankAcount,AA.lv004 DeptID,B.lv010 CMND  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,A.lv061 BankAcount,AA.lv004 DeptID,B.lv010 CMND  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		
		$vlv012_0=0;
		$vlv013_0=0;
		$vlv023_0=0;
		$vlv034_0=0;
		$vlv045_0=0;
		$vlv050_0=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
		
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
				$vLineOne=str_replace("@#07",'',$vLineOne);
				$vLineOne=str_replace("@#08",'',$vLineOne);
				$strTrH=$strTrH.$vLineOne;
				switch($mau)
				{
					case 1:
						
						break;
					default:
						$strTable=str_replace("@#02",'&nbsp;',$lvTable);						
						$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
						$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
						$strTrH='';
						break;
				}

				$vlv050_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vlv050_0=$vlv050_0+$vrow['lv050'];
			
			$vlv050_1=$vlv050_1+$vrow['lv050'];
			
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#03",unicode_to_case($this->getvaluelink('lv007',$vrow['lv002'])),$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['CMND'],$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['BankAcount'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_0,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	

		}
	function LV_LuongTienMat($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="60" />
			<col width="100" />
			<col width="100" />
			<col width="100" />
			<col width="100" />

			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" width="18"><center><strong>STT<br/>次序</strong></center></td>
				<td ><center><strong>SỐ THẺ</strong></center></td>
<td ><center><strong>HỌ VÀ TÊN</strong></center></td>
				<td  ><center><strong>THỰC LÃNH</strong></center></td>
				<td ><center><strong>KÝ NHẬN</strong></center></td>
				<td ><center><strong>GHI CHÚ</strong></center></td>
			</tr>			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td align=left>@#03</td>
			<td align=right>@#04</td>
			<td align=center>@#05</td>
			<td align=center>@#06</td>

		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td align=left>@#03</td>
			<td align=right>@#04</td>
			<td align=center>@#05</td>
			<td align=center>@#06</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,B.lv030 DateWork,AA.lv004 DeptID,B.lv101 MaThe  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,B.lv030 DateWork,AA.lv004 DeptID,B.lv101 MaThe  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,B.lv030 DateWork,AA.lv004 DeptID,B.lv101 MaThe  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv050_1=0;

		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
		
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#03",'TOTAL:',$vLineOne);
				$vLineOne=str_replace("@#04",$this->FormatView($vlv050_1,10),$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				$vLineOne=str_replace("@#06",'',$vLineOne);
				$strTrH=$strTrH.$vLineOne;
				switch($mau)
				{
					case 1:
						break;
					default:
						$strTable=str_replace("@#02",'&nbsp;',$lvTable);
						$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
						$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
						$strTrH='';
						break;
				}
				$vlv050_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vlv050_0=$vlv050_0+$vrow['lv050'];
			
			$vlv050_1=$vlv050_1+$vrow['lv050'];
			
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['MaThe'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vlv050_1,10),$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vlv050_0,10),$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_GetMonthlyBaoHiem($vDept,$vYear,$vMonth,$vOpt=0)
	{
		$vListDept=$this->LV_GetDep($vDept);
		/*if($vOpt==0)
			$vsql="select count(*) Nums,sum(A.lv006) Salary,sum(A.lv036+A.lv040) TongBHXH,sum(A.lv037+A.lv041) TongBHYT,sum(A.lv038+A.lv042) TongBHTN,sum(A.lv039+A.lv043) TongTienBH from tc_lv0021 A where A.lv058 in ($vListDept) and ((A.lv036<>0 and A.lv037<>0 and A.lv038<>0) or (A.lv040<>0 and A.lv041<>0 and A.lv042<>0)) and Year(A.lv005)='$vYear' and month(A.lv005)='$vMonth'";
		else
			$vsql="select count(*) Nums,sum(A.lv006) Salary,sum(A.lv036+A.lv040) TongBHXH,sum(A.lv037+A.lv041) TongBHYT,sum(A.lv038+A.lv042) TongBHTN,sum(A.lv039+A.lv043) TongTienBH from tc_lv0021 A where A.lv058 in ($vListDept) and ((A.lv039<>0 ) or (A.lv043<>0)) and Year(A.lv005)='$vYear' and month(A.lv005)='$vMonth'";
		*/
		$vsql="select (select count(*) from tc_lv0021 AA where AA.lv058 in ($vListDept) and ((AA.lv036<>0 and AA.lv037<>0 and AA.lv038<>0) or (AA.lv040<>0 and AA.lv041<>0 and AA.lv042<>0)) and Year(AA.lv005)='$vYear' and month(AA.lv005)='$vMonth') Nums,sum(A.lv006) Salary,sum(A.lv036+A.lv040) TongBHXH,sum(A.lv037+A.lv041) TongBHYT,sum(A.lv038+A.lv042) TongBHTN,sum(A.lv039+A.lv043) TongTienBH from tc_lv0021 A where A.lv058 in ($vListDept) and ((A.lv039<>0 ) or (A.lv043<>0)) and Year(A.lv005)='$vYear' and month(A.lv005)='$vMonth'";
		$bResult = db_query($vsql);
		$vrow = db_fetch_array ($bResult);
		return $vrow;
	}
	function LV_CONGDOAN2PERCEN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
		<tbody>
			<tr height="23">
				<td height="55" width="100"><center><strong>STT</strong></center></td>
				<td height="55" width="100"><center><strong>Phòng ban</strong></center></td>
				<td height="55" width="100"><center><strong>Phòng ban</strong></center></td>
				<td height="55" width="100"><center><strong>Phòng ban con</strong></center></td>
				<td ><center><strong></strong></center></td>
				<td ><center><strong>THÁNG 1</strong></center></td>
				<td ><center><strong>THÁNG 2</strong></center></td>
				<td ><center><strong>THÁNG 3</strong></center></td>
				<td ><center><strong>THÁNG 4</strong></center></td>
				<td ><center><strong>THÁNG 5</strong></center></td>
				<td ><center><strong>THÁNG 6</strong></center></td>
				<td ><center><strong>THÁNG 7</strong></center></td>
				<td ><center><strong>THÁNG 8</strong></center></td>
				<td ><center><strong>THÁNG 9</strong></center></td>
				<td ><center><strong>THÁNG 10</strong></center></td>
				<td ><center><strong>THÁNG 11</strong></center></td>
				<td ><center><strong>THÁNG 12</strong></center></td>
				<td ><center><strong>Tổng cộng</strong></center></td>
			</tr>			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTR='<tr height="17">
			<td align=center rowspan="@#00">@#22</td>
			<td align=center rowspan="@#00">@#23</td>
			<td align=center rowspan="@#00">@#24</td>
			<td align=center>@#20</td>
			<td align=center>@#21</td>
			<td align=right>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRD='<tr height="17">
			<td align=center>@#20</td>
			<td align=center>@#21</td>	
			<td align=right>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td align=center>@#22</td>
			<td align=center>@#23</td>
			<td align=center>@#24</td>
			<td align=center>@#20</td>
			<td align=center>@#21</td>
			<td align=center>@#00</td>
			<td align=center>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$sqlS1="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$vorder=$curRow;
		$bResult1 = db_query($sqlS1);
		$strDepart='';

		$vlv050_1=0;

		$strTrH='';
		$vOrder=0;
		$vYear=$this->CalYear;
		while ($vrows = db_fetch_array ($bResult1)){
			$sqlS="select * from hr_lv0002 where lv002='".$vrows['lv001']."'";
			$bResult = db_query($sqlS);
			while ($vrow = db_fetch_array ($bResult))
			{			
				$vLineOne=$vTR;
				$vLineOne=str_replace("@#22",$vrows['lv007'],$vLineOne);
				$vLineOne=str_replace("@#23",$vrows['lv001'],$vLineOne);
				$vLineOne=str_replace("@#24",$vrows['lv003'],$vLineOne);
				if($vrows['lv001']!='') $vTitleParent=$vrows['lv001'];
				$vrows['lv007']='';$vrows['lv001']='';$vrows['lv003']='';
				$vLineOne=str_replace("@#20",$vrow['lv001'],$vLineOne);
				$vLineOne=str_replace("@#21",$vrow['lv003'],$vLineOne);
				$vLineOne=str_replace("@#00",1,$vLineOne);
				
				$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'01','lv080');
				$vTotalNums1=$vTotalNums1+$vrow1['Nums'];
				$vTotalSalary1=$vTotalSalary1+$vrow1['Salary'];
				$vTotalDoanPhi1=$vTotalDoanPhi1+$vrow1['DoanPhi'];
				$vTotalTotals1=$vTotalTotals1+$vrow1['Totals'];
				$vLineOne=str_replace("@#01",$this->FormatView($vrow1['Totals'],10),$vLineOne);
				
				$vrow2=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'02','lv080');
				$vTotalNums2=$vTotalNums2+$vrow2['Nums'];
				$vTotalSalary2=$vTotalSalary2+$vrow2['Salary'];
				$vTotalDoanPhi2=$vTotalDoanPhi2+$vrow2['DoanPhi'];
				$vTotalTotals2=$vTotalTotals2+$vrow1['Totals'];
				$vLineOne=str_replace("@#02",$this->FormatView($vrow2['Totals'],10),$vLineOne);
				
				$vrow3=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'03','lv080');
				$vTotalNums3=$vTotalNums3+$vrow3['Nums'];
				$vTotalSalary3=$vTotalSalary3+$vrow3['Salary'];
				$vTotalDoanPhi3=$vTotalDoanPhi3+$vrow3['DoanPhi'];
				$vTotalTotals3=$vTotalTotals3+$vrow3['Totals'];
				$vLineOne=str_replace("@#03",$this->FormatView($vrow3['Totals'],10),$vLineOne);
				
				$vrow4=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'04','lv080');
				$vTotalNums4=$vTotalNums4+$vrow4['Nums'];
				$vTotalSalary4=$vTotalSalary4+$vrow4['Salary'];
				$vTotalDoanPhi4=$vTotalDoanPhi4+$vrow4['DoanPhi'];
				$vTotalTotals4=$vTotalTotals4+$vrow4['Totals'];
				$vLineOne=str_replace("@#04",$this->FormatView($vrow4['Totals'],10),$vLineOne);
				
				$vrow5=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'05','lv080');
				$vTotalNums5=$vTotalNums5+$vrow5['Nums'];
				$vTotalSalary5=$vTotalSalary5+$vrow5['Salary'];
				$vTotalDoanPhi5=$vTotalDoanPhi5+$vrow5['DoanPhi'];
				$vTotalTotals5=$vTotalTotals5+$vrow5['Totals'];
				$vLineOne=str_replace("@#05",$this->FormatView($vrow5['Totals'],10),$vLineOne);
				
				$vrow6=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'06','lv080');
				$vTotalNums6=$vTotalNums6+$vrow6['Nums'];
				$vTotalSalary6=$vTotalSalary6+$vrow6['Salary'];
				$vTotalDoanPhi6=$vTotalDoanPhi6+$vrow6['DoanPhi'];
				$vTotalTotals6=$vTotalTotals6+$vrow6['Totals'];
				$vLineOne=str_replace("@#06",$this->FormatView($vrow6['Totals'],10),$vLineOne);
				
				$vrow7=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'07','lv080');
				$vTotalNums7=$vTotalNums7+$vrow7['Nums'];
				$vTotalSalary7=$vTotalSalary7+$vrow7['Salary'];
				$vTotalDoanPhi7=$vTotalDoanPhi7+$vrow7['DoanPhi'];
				$vTotalTotals7=$vTotalTotals7+$vrow7['Totals'];
				$vLineOne=str_replace("@#07",$this->FormatView($vrow7['Totals'],10),$vLineOne);
				
				$vrow8=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'08','lv080');
				$vTotalNums8=$vTotalNums8+$vrow8['Nums'];
				$vTotalSalary8=$vTotalSalary8+$vrow8['Salary'];
				$vTotalDoanPhi8=$vTotalDoanPhi8+$vrow8['DoanPhi'];
				$vTotalTotals8=$vTotalTotals8+$vrow8['Totals'];
				$vLineOne=str_replace("@#08",$this->FormatView($vrow8['Totals'],10),$vLineOne);
				
				$vrow9=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'09','lv080');
				$vTotalNums9=$vTotalNums9+$vrow9['Nums'];
				$vTotalSalary9=$vTotalSalary9+$vrow9['Salary'];
				$vTotalDoanPhi9=$vTotalDoanPhi9+$vrow9['DoanPhi'];
				$vTotalTotals9=$vTotalTotals9+$vrow9['Totals'];
				$vLineOne=str_replace("@#09",$this->FormatView($vrow9['Totals'],10),$vLineOne);
				
				$vrow10=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'10','lv080');
				$vTotalNums10=$vTotalNums10+$vrow10['Nums'];
				$vTotalSalary10=$vTotalSalary10+$vrow10['Salary'];
				$vTotalDoanPhi10=$vTotalDoanPhi10+$vrow10['DoanPhi'];
				$vTotalTotals10=$vTotalTotals10+$vrow10['Totals'];
				$vLineOne=str_replace("@#10",$this->FormatView($vrow10['Totals'],10),$vLineOne);
				
				$vrow11=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'11','lv080');
				$vTotalNums11=$vTotalNums11+$vrow11['Nums'];
				$vTotalSalary11=$vTotalSalary11+$vrow11['Salary'];
				$vTotalDoanPhi11=$vTotalDoanPhi11+$vrow11['DoanPhi'];
				$vTotalTotals11=$vTotalTotals11+$vrow11['Totals'];
				$vLineOne=str_replace("@#11",$this->FormatView($vrow11['Totals'],10),$vLineOne);
				
				$vrow12=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'12','lv080');
				$vTotalNums12=$vTotalNums12+$vrow12['Nums'];
				$vTotalSalary12=$vTotalSalary12+$vrow12['Salary'];
				$vTotalDoanPhi12=$vTotalDoanPhi12+$vrow12['DoanPhi'];
				$vTotalTotals12=$vTotalTotals12+$vrow12['Totals'];
				$vLineOne=str_replace("@#12",$this->FormatView($vrow12['Totals'],20),$vLineOne);
				$vSumTotals=$vrow1['Totals']+$vrow2['Totals']+$vrow3['Totals']+$vrow4['Totals']+$vrow5['Totals']+$vrow6['Totals']+$vrow7['Totals']+$vrow8['Totals']+$vrow9['Totals']+$vrow10['Totals']+$vrow11['Totals']+$vrow12['Totals'];
				$vSumSalary=$vrow1['Salary']+$vrow2['Salary']+$vrow3['Salary']+$vrow4['Salary']+$vrow5['Salary']+$vrow6['Salary']+$vrow7['Salary']+$vrow8['Salary']+$vrow9['Salary']+$vrow10['Salary']+$vrow11['Salary']+$vrow12['Salary'];
				$vSumDoanPhi=$vrow1['DoanPhi']+$vrow2['DoanPhi']+$vrow3['DoanPhi']+$vrow4['DoanPhi']+$vrow5['DoanPhi']+$vrow6['DoanPhi']+$vrow7['DoanPhi']+$vrow8['DoanPhi']+$vrow9['DoanPhi']+$vrow10['DoanPhi']+$vrow11['DoanPhi']+$vrow12['DoanPhi'];
				$vTotalSalary=$vTotalSalary+$vSumSalary;
				$vTotalTotal=$vTotalTotal+$vSumTotals;
				$vTotalDoanPhi=$vTotalDoanPhi+$vSumDoanPhi;
				$vLineOne=str_replace("@#13",$this->FormatView($vSumTotals,10),$vLineOne);
				$strTrH=$strTrH.$vLineOne;
			}
			$vLineOne=$vTR;
			$vLineOne=str_replace("@#20",'',$vLineOne);
			$vLineOne=str_replace("@#21",'',$vLineOne);
			$vLineOne=str_replace("@#22",'',$vLineOne);
			$vLineOne=str_replace("@#23",$vTitleParent.' Tổng cộng',$vLineOne);
			$vLineOne=str_replace("@#24",'',$vLineOne);
			$vLineOne=str_replace("@#00",1,$vLineOne);
			$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1,10),$vLineOne);
			$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2,10),$vLineOne);
			$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3,10),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4,10),$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5,10),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6,10),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7,10),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8,10),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9,10),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10,10),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11,10),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12,10),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal,10),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			$allTotalTotals1=$allTotalTotals1+$vTotalTotals1;
			$allTotalTotals2=$allTotalTotals2+$vTotalTotals2;
			$allTotalTotals3=$allTotalTotals3+$vTotalTotals3;
			$allTotalTotals4=$allTotalTotals4+$vTotalTotals4;
			$allTotalTotals5=$allTotalTotals5+$vTotalTotals5;
			$allTotalTotals6=$allTotalTotals6+$vTotalTotals6;
			$allTotalTotals7=$allTotalTotals7+$vTotalTotals7;
			$allTotalTotals8=$allTotalTotals8+$vTotalTotals8;
			$allTotalTotals9=$allTotalTotals9+$vTotalTotals9;
			$allTotalTotals10=$allTotalTotals10+$vTotalTotals10;
			$allTotalTotals11=$allTotalTotals11+$vTotalTotals11;
			$allTotalTotals12=$allTotalTotals12+$vTotalTotals12;
			$allTotalTotals=$allTotalTotals+$vTotalTotal;
			$vTotalTotals1=0;
			$vTotalTotals2=0;
			$vTotalTotals3=0;
			$vTotalTotals4=0;
			$vTotalTotals5=0;
			$vTotalTotals6=0;
			$vTotalTotals7=0;
			$vTotalTotals8=0;
			$vTotalTotals9=0;
			$vTotalTotals10=0;
			$vTotalTotals11=0;
			$vTotalTotals12=0;
			$vTotalTotals=0;
		}
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#20",'',$vLineOne);
		$vLineOne=str_replace("@#21",'',$vLineOne);
		$vLineOne=str_replace("@#22",'',$vLineOne);
		$vLineOne=str_replace("@#23",'Tổng cộng',$vLineOne);
		$vLineOne=str_replace("@#24",'',$vLineOne);
		$vLineOne=str_replace("@#00",1,$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($allTotalTotals1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($allTotalTotals2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($allTotalTotals3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($allTotalTotals4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($allTotalTotals5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($allTotalTotals6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($allTotalTotals7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($allTotalTotals8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($allTotalTotals9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($allTotalTotals10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($allTotalTotals11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($allTotalTotals12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($allTotalTotals,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_CONGDOAN22PERCEN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
		<tbody>
			<tr height="23">
				<td height="55" width="100"><center><strong>會科代號</strong></center></td>
				<td height="55" width="100"><center><strong>廠別</strong></center></td>
				<td height="55" width="100"><center><strong>類別</strong></center></td>
				<td height="55" width="100"><center><strong>部門代號</strong></center></td>
				<td ><center><strong></strong></center></td>
				<td ><center><strong>THÁNG 1<br/>編號</strong></center></td>
				<td ><center><strong>THÁNG 2</strong></center></td>
				<td ><center><strong>THÁNG 3</strong></center></td>
				<td ><center><strong>THÁNG 4</strong></center></td>
				<td ><center><strong>THÁNG 5</strong></center></td>
				<td ><center><strong>THÁNG 6</strong></center></td>
				<td ><center><strong>THÁNG 7</strong></center></td>
				<td ><center><strong>THÁNG 8</strong></center></td>
				<td ><center><strong>THÁNG 9</strong></center></td>
				<td ><center><strong>THÁNG 10</strong></center></td>
				<td ><center><strong>THÁNG 11</strong></center></td>
				<td ><center><strong>THÁNG 12</strong></center></td>
				<td ><center><strong>Tổng cộng</strong></center></td>
			</tr>			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTR='<tr height="17">
			<td align=center rowspan="@#00">@#22</td>
			<td align=center rowspan="@#00">@#23</td>
			<td align=center rowspan="@#00">@#24</td>
			<td align=center>@#20</td>
			<td align=center>@#21</td>
			<td align=right>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRD='<tr height="17">
			<td align=center>@#20</td>
			<td align=center>@#21</td>	
			<td align=right>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td align=center>@#22</td>
			<td align=center>@#23</td>
			<td align=center>@#24</td>
			<td align=center>@#20</td>
			<td align=center>@#21</td>
			<td align=center>@#00</td>
			<td align=center>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$sqlS1="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$vorder=$curRow;
		$bResult1 = db_query($sqlS1);
		$strDepart='';

		$vlv050_1=0;

		$strTrH='';
		$vOrder=0;
		$vYear=$this->CalYear;
		while ($vrows = db_fetch_array ($bResult1)){
			$sqlS="select * from hr_lv0002 where lv002='".$vrows['lv001']."'";
			$bResult = db_query($sqlS);
			while ($vrow = db_fetch_array ($bResult))
			{			
				$vLineOne=$vTR;
				$vLineOne=str_replace("@#22",$vrows['lv007'],$vLineOne);
				$vLineOne=str_replace("@#23",$vrows['lv001'],$vLineOne);
				$vLineOne=str_replace("@#24",$vrows['lv003'],$vLineOne);
				if($vrows['lv001']!='') $vTitleParent=$vrows['lv001'];
				$vrows['lv007']='';$vrows['lv001']='';$vrows['lv003']='';
				$vLineOne=str_replace("@#20",$vrow['lv001'],$vLineOne);
				$vLineOne=str_replace("@#21",$vrow['lv003'],$vLineOne);
				$vLineOne=str_replace("@#00",1,$vLineOne);
				
				$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'01','lv039');
				$vTotalNums1=$vTotalNums1+$vrow1['Nums'];
				$vTotalSalary1=$vTotalSalary1+$vrow1['Salary'];
				$vTotalDoanPhi1=$vTotalDoanPhi1+$vrow1['DoanPhi'];
				$vTotalTotals1=$vTotalTotals1+$vrow1['Totals'];
				$vLineOne=str_replace("@#01",$this->FormatView($vrow1['Totals'],10),$vLineOne);
				
				$vrow2=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'02','lv039');
				$vTotalNums2=$vTotalNums2+$vrow2['Nums'];
				$vTotalSalary2=$vTotalSalary2+$vrow2['Salary'];
				$vTotalDoanPhi2=$vTotalDoanPhi2+$vrow2['DoanPhi'];
				$vTotalTotals2=$vTotalTotals2+$vrow1['Totals'];
				$vLineOne=str_replace("@#02",$this->FormatView($vrow2['Totals'],10),$vLineOne);
				
				$vrow3=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'03','lv039');
				$vTotalNums3=$vTotalNums3+$vrow3['Nums'];
				$vTotalSalary3=$vTotalSalary3+$vrow3['Salary'];
				$vTotalDoanPhi3=$vTotalDoanPhi3+$vrow3['DoanPhi'];
				$vTotalTotals3=$vTotalTotals3+$vrow3['Totals'];
				$vLineOne=str_replace("@#03",$this->FormatView($vrow3['Totals'],10),$vLineOne);
				
				$vrow4=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'04','lv039');
				$vTotalNums4=$vTotalNums4+$vrow4['Nums'];
				$vTotalSalary4=$vTotalSalary4+$vrow4['Salary'];
				$vTotalDoanPhi4=$vTotalDoanPhi4+$vrow4['DoanPhi'];
				$vTotalTotals4=$vTotalTotals4+$vrow4['Totals'];
				$vLineOne=str_replace("@#04",$this->FormatView($vrow4['Totals'],10),$vLineOne);
				
				$vrow5=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'05','lv039');
				$vTotalNums5=$vTotalNums5+$vrow5['Nums'];
				$vTotalSalary5=$vTotalSalary5+$vrow5['Salary'];
				$vTotalDoanPhi5=$vTotalDoanPhi5+$vrow5['DoanPhi'];
				$vTotalTotals5=$vTotalTotals5+$vrow5['Totals'];
				$vLineOne=str_replace("@#05",$this->FormatView($vrow5['Totals'],10),$vLineOne);
				
				$vrow6=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'06','lv039');
				$vTotalNums6=$vTotalNums6+$vrow6['Nums'];
				$vTotalSalary6=$vTotalSalary6+$vrow6['Salary'];
				$vTotalDoanPhi6=$vTotalDoanPhi6+$vrow6['DoanPhi'];
				$vTotalTotals6=$vTotalTotals6+$vrow6['Totals'];
				$vLineOne=str_replace("@#06",$this->FormatView($vrow6['Totals'],10),$vLineOne);
				
				$vrow7=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'07','lv039');
				$vTotalNums7=$vTotalNums7+$vrow7['Nums'];
				$vTotalSalary7=$vTotalSalary7+$vrow7['Salary'];
				$vTotalDoanPhi7=$vTotalDoanPhi7+$vrow7['DoanPhi'];
				$vTotalTotals7=$vTotalTotals7+$vrow7['Totals'];
				$vLineOne=str_replace("@#07",$this->FormatView($vrow7['Totals'],10),$vLineOne);
				
				$vrow8=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'08','lv039');
				$vTotalNums8=$vTotalNums8+$vrow8['Nums'];
				$vTotalSalary8=$vTotalSalary8+$vrow8['Salary'];
				$vTotalDoanPhi8=$vTotalDoanPhi8+$vrow8['DoanPhi'];
				$vTotalTotals8=$vTotalTotals8+$vrow8['Totals'];
				$vLineOne=str_replace("@#08",$this->FormatView($vrow8['Totals'],10),$vLineOne);
				
				$vrow9=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'09','lv039');
				$vTotalNums9=$vTotalNums9+$vrow9['Nums'];
				$vTotalSalary9=$vTotalSalary9+$vrow9['Salary'];
				$vTotalDoanPhi9=$vTotalDoanPhi9+$vrow9['DoanPhi'];
				$vTotalTotals9=$vTotalTotals9+$vrow9['Totals'];
				$vLineOne=str_replace("@#09",$this->FormatView($vrow9['Totals'],10),$vLineOne);
				
				$vrow10=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'10','lv039');
				$vTotalNums10=$vTotalNums10+$vrow10['Nums'];
				$vTotalSalary10=$vTotalSalary10+$vrow10['Salary'];
				$vTotalDoanPhi10=$vTotalDoanPhi10+$vrow10['DoanPhi'];
				$vTotalTotals10=$vTotalTotals10+$vrow10['Totals'];
				$vLineOne=str_replace("@#10",$this->FormatView($vrow10['Totals'],10),$vLineOne);
				
				$vrow11=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'11','lv039');
				$vTotalNums11=$vTotalNums11+$vrow11['Nums'];
				$vTotalSalary11=$vTotalSalary11+$vrow11['Salary'];
				$vTotalDoanPhi11=$vTotalDoanPhi11+$vrow11['DoanPhi'];
				$vTotalTotals11=$vTotalTotals11+$vrow11['Totals'];
				$vLineOne=str_replace("@#11",$this->FormatView($vrow11['Totals'],10),$vLineOne);
				
				$vrow12=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'12','lv039');
				$vTotalNums12=$vTotalNums12+$vrow12['Nums'];
				$vTotalSalary12=$vTotalSalary12+$vrow12['Salary'];
				$vTotalDoanPhi12=$vTotalDoanPhi12+$vrow12['DoanPhi'];
				$vTotalTotals12=$vTotalTotals12+$vrow12['Totals'];
				$vLineOne=str_replace("@#12",$this->FormatView($vrow12['Totals'],20),$vLineOne);
				$vSumTotals=$vrow1['Totals']+$vrow2['Totals']+$vrow3['Totals']+$vrow4['Totals']+$vrow5['Totals']+$vrow6['Totals']+$vrow7['Totals']+$vrow8['Totals']+$vrow9['Totals']+$vrow10['Totals']+$vrow11['Totals']+$vrow12['Totals'];
				$vSumSalary=$vrow1['Salary']+$vrow2['Salary']+$vrow3['Salary']+$vrow4['Salary']+$vrow5['Salary']+$vrow6['Salary']+$vrow7['Salary']+$vrow8['Salary']+$vrow9['Salary']+$vrow10['Salary']+$vrow11['Salary']+$vrow12['Salary'];
				$vSumDoanPhi=$vrow1['DoanPhi']+$vrow2['DoanPhi']+$vrow3['DoanPhi']+$vrow4['DoanPhi']+$vrow5['DoanPhi']+$vrow6['DoanPhi']+$vrow7['DoanPhi']+$vrow8['DoanPhi']+$vrow9['DoanPhi']+$vrow10['DoanPhi']+$vrow11['DoanPhi']+$vrow12['DoanPhi'];
				$vTotalSalary=$vTotalSalary+$vSumSalary;
				$vTotalTotal=$vTotalTotal+$vSumTotals;
				$vTotalDoanPhi=$vTotalDoanPhi+$vSumDoanPhi;
				$vLineOne=str_replace("@#13",$this->FormatView($vSumTotals,10),$vLineOne);
				$strTrH=$strTrH.$vLineOne;
			}
			$vLineOne=$vTR;
			$vLineOne=str_replace("@#20",'',$vLineOne);
			$vLineOne=str_replace("@#21",'',$vLineOne);
			$vLineOne=str_replace("@#22",'',$vLineOne);
			$vLineOne=str_replace("@#23",$vTitleParent.' Tổng cộng',$vLineOne);
			$vLineOne=str_replace("@#24",'',$vLineOne);
			$vLineOne=str_replace("@#00",1,$vLineOne);
			$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1,10),$vLineOne);
			$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2,10),$vLineOne);
			$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3,10),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4,10),$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5,10),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6,10),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7,10),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8,10),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9,10),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10,10),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11,10),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12,10),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal,10),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			$allTotalTotals1=$allTotalTotals1+$vTotalTotals1;
			$allTotalTotals2=$allTotalTotals2+$vTotalTotals2;
			$allTotalTotals3=$allTotalTotals3+$vTotalTotals3;
			$allTotalTotals4=$allTotalTotals4+$vTotalTotals4;
			$allTotalTotals5=$allTotalTotals5+$vTotalTotals5;
			$allTotalTotals6=$allTotalTotals6+$vTotalTotals6;
			$allTotalTotals7=$allTotalTotals7+$vTotalTotals7;
			$allTotalTotals8=$allTotalTotals8+$vTotalTotals8;
			$allTotalTotals9=$allTotalTotals9+$vTotalTotals9;
			$allTotalTotals10=$allTotalTotals10+$vTotalTotals10;
			$allTotalTotals11=$allTotalTotals11+$vTotalTotals11;
			$allTotalTotals12=$allTotalTotals12+$vTotalTotals12;
			$allTotalTotals=$allTotalTotals+$vTotalTotal;
			$vTotalTotals1=0;
			$vTotalTotals2=0;
			$vTotalTotals3=0;
			$vTotalTotals4=0;
			$vTotalTotals5=0;
			$vTotalTotals6=0;
			$vTotalTotals7=0;
			$vTotalTotals8=0;
			$vTotalTotals9=0;
			$vTotalTotals10=0;
			$vTotalTotals11=0;
			$vTotalTotals12=0;
			$vTotalTotals=0;
		}
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#20",'',$vLineOne);
		$vLineOne=str_replace("@#21",'',$vLineOne);
		$vLineOne=str_replace("@#22",'',$vLineOne);
		$vLineOne=str_replace("@#23",'Tổng cộng',$vLineOne);
		$vLineOne=str_replace("@#24",'',$vLineOne);
		$vLineOne=str_replace("@#00",1,$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($allTotalTotals1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($allTotalTotals2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($allTotalTotals3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($allTotalTotals4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($allTotalTotals5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($allTotalTotals6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($allTotalTotals7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($allTotalTotals8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($allTotalTotals9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($allTotalTotals10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($allTotalTotals11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($allTotalTotals12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($allTotalTotals,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_THANHTOANBHCONG2PERCEN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
		<tbody>
			<tr height="23">
				<td height="55" width="100"><center><strong>Tháng月份<br/>項目</strong></center></td>
				<td ><center><strong>THÁNG 1<br/>編號</strong></center></td>
				<td ><center><strong>THÁNG 2</strong></center></td>
				<td ><center><strong>THÁNG 3</strong></center></td>
				<td ><center><strong>THÁNG 4</strong></center></td>
				<td ><center><strong>THÁNG 5</strong></center></td>
				<td ><center><strong>THÁNG 6</strong></center></td>
				<td ><center><strong>THÁNG 7</strong></center></td>
				<td ><center><strong>THÁNG 8</strong></center></td>
				<td ><center><strong>THÁNG 9</strong></center></td>
				<td ><center><strong>THÁNG 10</strong></center></td>
				<td ><center><strong>THÁNG 11</strong></center></td>
				<td ><center><strong>THÁNG 12</strong></center></td>
				<td ><center><strong>Tổng cộng</strong></center></td>
			</tr>			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTR='<tr height="17">
			<td align=center>@#00</td>
			<td align=right>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td align=center>@#00</td>
			<td align=center>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$sqlS="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv050_1=0;

		$strTrH='';
		$vOrder=0;
		$vYear=$this->CalYear;
		while ($vrow = db_fetch_array ($bResult)){
			$vLineOne=$vTR;
			$vLineOne=str_replace("@#00",$vrow['lv003'],$vLineOne);
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'01');
			$vTotalNums1=$vTotalNums1+$vrow1['Nums'];
			$vTotalSalary1=$vTotalSalary1+$vrow1['Salary'];
			$vTotalDoanPhi1=$vTotalDoanPhi1+$vrow1['DoanPhi'];
			$vTotalTotals1=$vTotalTotals1+$vrow1['Totals'];
			$vLineOne=str_replace("@#01",$this->FormatView($vrow1['Salary'],10),$vLineOne);
			
			$vrow2=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'02');
			$vTotalNums2=$vTotalNums2+$vrow2['Nums'];
			$vTotalSalary2=$vTotalSalary2+$vrow2['Salary'];
			$vTotalDoanPhi2=$vTotalDoanPhi2+$vrow2['DoanPhi'];
			$vTotalTotals2=$vTotalTotals2+$vrow1['Totals'];
			$vLineOne=str_replace("@#02",$this->FormatView($vrow2['Salary'],10),$vLineOne);
			
			$vrow3=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'03');
			$vTotalNums3=$vTotalNums3+$vrow3['Nums'];
			$vTotalSalary3=$vTotalSalary3+$vrow3['Salary'];
			$vTotalDoanPhi3=$vTotalDoanPhi3+$vrow3['DoanPhi'];
			$vTotalTotals3=$vTotalTotals3+$vrow3['Totals'];
			$vLineOne=str_replace("@#03",$this->FormatView($vrow3['Salary'],10),$vLineOne);
			
			$vrow4=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'04');
			$vTotalNums4=$vTotalNums4+$vrow4['Nums'];
			$vTotalSalary4=$vTotalSalary4+$vrow4['Salary'];
			$vTotalDoanPhi4=$vTotalDoanPhi4+$vrow4['DoanPhi'];
			$vTotalTotals4=$vTotalTotals4+$vrow4['Totals'];
			$vLineOne=str_replace("@#04",$this->FormatView($vrow4['Salary'],10),$vLineOne);
			
			$vrow5=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'05');
			$vTotalNums5=$vTotalNums5+$vrow5['Nums'];
			$vTotalSalary5=$vTotalSalary5+$vrow5['Salary'];
			$vTotalDoanPhi5=$vTotalDoanPhi5+$vrow5['DoanPhi'];
			$vTotalTotals5=$vTotalTotals5+$vrow5['Totals'];
			$vLineOne=str_replace("@#05",$this->FormatView($vrow5['Salary'],10),$vLineOne);
			
			$vrow6=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'06');
			$vTotalNums6=$vTotalNums6+$vrow6['Nums'];
			$vTotalSalary6=$vTotalSalary6+$vrow6['Salary'];
			$vTotalDoanPhi6=$vTotalDoanPhi6+$vrow6['DoanPhi'];
			$vTotalTotals6=$vTotalTotals6+$vrow6['Totals'];
			$vLineOne=str_replace("@#06",$this->FormatView($vrow6['Salary'],10),$vLineOne);
			
			$vrow7=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'07');
			$vTotalNums7=$vTotalNums7+$vrow7['Nums'];
			$vTotalSalary7=$vTotalSalary7+$vrow7['Salary'];
			$vTotalDoanPhi7=$vTotalDoanPhi7+$vrow7['DoanPhi'];
			$vTotalTotals7=$vTotalTotals7+$vrow7['Totals'];
			$vLineOne=str_replace("@#07",$this->FormatView($vrow7['Salary'],10),$vLineOne);
			
			$vrow8=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'08');
			$vTotalNums8=$vTotalNums8+$vrow8['Nums'];
			$vTotalSalary8=$vTotalSalary8+$vrow8['Salary'];
			$vTotalDoanPhi8=$vTotalDoanPhi8+$vrow8['DoanPhi'];
			$vTotalTotals8=$vTotalTotals8+$vrow8['Totals'];
			$vLineOne=str_replace("@#08",$this->FormatView($vrow8['Salary'],10),$vLineOne);
			
			$vrow9=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'09');
			$vTotalNums9=$vTotalNums9+$vrow9['Nums'];
			$vTotalSalary9=$vTotalSalary9+$vrow9['Salary'];
			$vTotalDoanPhi9=$vTotalDoanPhi9+$vrow9['DoanPhi'];
			$vTotalTotals9=$vTotalTotals9+$vrow9['Totals'];
			$vLineOne=str_replace("@#09",$this->FormatView($vrow9['Salary'],10),$vLineOne);
			
			$vrow10=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'10');
			$vTotalNums10=$vTotalNums10+$vrow10['Nums'];
			$vTotalSalary10=$vTotalSalary10+$vrow10['Salary'];
			$vTotalDoanPhi10=$vTotalDoanPhi10+$vrow10['DoanPhi'];
			$vTotalTotals10=$vTotalTotals10+$vrow10['Totals'];
			$vLineOne=str_replace("@#10",$this->FormatView($vrow10['Salary'],10),$vLineOne);
			
			$vrow11=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'11');
			$vTotalNums11=$vTotalNums11+$vrow11['Nums'];
			$vTotalSalary11=$vTotalSalary11+$vrow11['Salary'];
			$vTotalDoanPhi11=$vTotalDoanPhi11+$vrow11['DoanPhi'];
			$vTotalTotals11=$vTotalTotals11+$vrow11['Totals'];
			$vLineOne=str_replace("@#11",$this->FormatView($vrow11['Salary'],10),$vLineOne);
			
			$vrow12=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'12');
			$vTotalNums12=$vTotalNums12+$vrow12['Nums'];
			$vTotalSalary12=$vTotalSalary12+$vrow12['Salary'];
			$vTotalDoanPhi12=$vTotalDoanPhi12+$vrow12['DoanPhi'];
			$vTotalTotals12=$vTotalTotals12+$vrow12['Totals'];
			$vLineOne=str_replace("@#12",$this->FormatView($vrow12['Salary'],20),$vLineOne);
			$vSumTotals=$vrow1['Totals']+$vrow2['Totals']+$vrow3['Totals']+$vrow4['Totals']+$vrow5['Totals']+$vrow6['Totals']+$vrow7['Totals']+$vrow8['Totals']+$vrow9['Totals']+$vrow10['Totals']+$vrow11['Totals']+$vrow12['Totals'];
			$vSumSalary=$vrow1['Salary']+$vrow2['Salary']+$vrow3['Salary']+$vrow4['Salary']+$vrow5['Salary']+$vrow6['Salary']+$vrow7['Salary']+$vrow8['Salary']+$vrow9['Salary']+$vrow10['Salary']+$vrow11['Salary']+$vrow12['Salary'];
			$vSumDoanPhi=$vrow1['DoanPhi']+$vrow2['DoanPhi']+$vrow3['DoanPhi']+$vrow4['DoanPhi']+$vrow5['DoanPhi']+$vrow6['DoanPhi']+$vrow7['DoanPhi']+$vrow8['DoanPhi']+$vrow9['DoanPhi']+$vrow10['DoanPhi']+$vrow11['DoanPhi']+$vrow12['DoanPhi'];
			$vTotalSalary=$vTotalSalary+$vSumSalary;
			$vTotalTotal=$vTotalTotal+$vSumTotals;
			$vTotalDoanPhi=$vTotalDoanPhi+$vSumDoanPhi;
			$vLineOne=str_replace("@#13",$this->FormatView($vSumSalary,10),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Trích nộp 2%',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal,10),$vLineOne);
		$strTrH=$vLineOne.$strTrH;
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Quỹ lương BHXH',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalSalary1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalSalary2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalSalary3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalSalary4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalSalary5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalSalary6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalSalary7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalSalary8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalSalary9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalSalary10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalSalary11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalSalary12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalSalary,10),$vLineOne);
		$strTrH=$vLineOne.$strTrH;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Kinh Phí',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalDoanPhi1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalDoanPhi2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalDoanPhi3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalDoanPhi4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalDoanPhi5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalDoanPhi6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalDoanPhi7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalDoanPhi8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalDoanPhi9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalDoanPhi10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalDoanPhi11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalDoanPhi12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalDoanPhi,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Kinh phí lao động',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Tổng',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1+$vTotalDoanPhi1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2+$vTotalDoanPhi2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3+$vTotalDoanPhi3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4+$vTotalDoanPhi4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5+$vTotalDoanPhi5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6+$vTotalDoanPhi6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7+$vTotalDoanPhi7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8+$vTotalDoanPhi8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9+$vTotalDoanPhi9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10+$vTotalDoanPhi10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11+$vTotalDoanPhi11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12+$vTotalDoanPhi12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal+$vTotalDoanPhi,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'40% Đoán phí nộp cấp trên',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalDoanPhi1*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalDoanPhi2*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalDoanPhi3*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalDoanPhi4*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalDoanPhi5*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalDoanPhi6*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalDoanPhi7*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalDoanPhi8*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalDoanPhi9*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalDoanPhi10*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalDoanPhi11*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalDoanPhi12*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalDoanPhi*0.4,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'35% Kinh phí nộp cấp trên',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal*0.35,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_KINHPHICD2PERCEN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
		<tbody>
			<tr height="23">
				<td height="55" width="100"><center><strong>Tháng</strong></center></td>
				<td ><center><strong>THÁNG 1/strong></center></td>
				<td ><center><strong>THÁNG 2</strong></center></td>
				<td ><center><strong>THÁNG 3</strong></center></td>
				<td ><center><strong>THÁNG 4</strong></center></td>
				<td ><center><strong>THÁNG 5</strong></center></td>
				<td ><center><strong>THÁNG 6</strong></center></td>
				<td ><center><strong>THÁNG 7</strong></center></td>
				<td ><center><strong>THÁNG 8</strong></center></td>
				<td ><center><strong>THÁNG 9</strong></center></td>
				<td ><center><strong>THÁNG 10</strong></center></td>
				<td ><center><strong>THÁNG 11</strong></center></td>
				<td ><center><strong>THÁNG 12</strong></center></td>
				<td ><center><strong>Tổng cộng</strong></center></td>
			</tr>			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTR='<tr height="17">
			<td align=center>@#00</td>
			<td align=right>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td align=center>@#00</td>
			<td align=center>@#01</td>
			<td align=right>@#02</td>
			<td align=right>@#03</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$sqlS="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv050_1=0;

		$strTrH='';
		$vOrder=0;
		$vYear=$this->CalYear;
		while ($vrow = db_fetch_array ($bResult)){
			$vLineOne=$vTR;
			$vLineOne=str_replace("@#00",$vrow['lv003'],$vLineOne);
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'01');
			$vTotalNums1=$vTotalNums1+$vrow1['Nums'];
			$vTotalSalary1=$vTotalSalary1+$vrow1['Salary'];
			$vTotalDoanPhi1=$vTotalDoanPhi1+$vrow1['DoanPhi'];
			$vTotalTotals1=$vTotalTotals1+$vrow1['Totals'];
			$vLineOne=str_replace("@#01",$this->FormatView($vrow1['Salary'],10),$vLineOne);
			
			$vrow2=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'02');
			$vTotalNums2=$vTotalNums2+$vrow2['Nums'];
			$vTotalSalary2=$vTotalSalary2+$vrow2['Salary'];
			$vTotalDoanPhi2=$vTotalDoanPhi2+$vrow2['DoanPhi'];
			$vTotalTotals2=$vTotalTotals2+$vrow1['Totals'];
			$vLineOne=str_replace("@#02",$this->FormatView($vrow2['Salary'],10),$vLineOne);
			
			$vrow3=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'03');
			$vTotalNums3=$vTotalNums3+$vrow3['Nums'];
			$vTotalSalary3=$vTotalSalary3+$vrow3['Salary'];
			$vTotalDoanPhi3=$vTotalDoanPhi3+$vrow3['DoanPhi'];
			$vTotalTotals3=$vTotalTotals3+$vrow3['Totals'];
			$vLineOne=str_replace("@#03",$this->FormatView($vrow3['Salary'],10),$vLineOne);
			
			$vrow4=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'04');
			$vTotalNums4=$vTotalNums4+$vrow4['Nums'];
			$vTotalSalary4=$vTotalSalary4+$vrow4['Salary'];
			$vTotalDoanPhi4=$vTotalDoanPhi4+$vrow4['DoanPhi'];
			$vTotalTotals4=$vTotalTotals4+$vrow4['Totals'];
			$vLineOne=str_replace("@#04",$this->FormatView($vrow4['Salary'],10),$vLineOne);
			
			$vrow5=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'05');
			$vTotalNums5=$vTotalNums5+$vrow5['Nums'];
			$vTotalSalary5=$vTotalSalary5+$vrow5['Salary'];
			$vTotalDoanPhi5=$vTotalDoanPhi5+$vrow5['DoanPhi'];
			$vTotalTotals5=$vTotalTotals5+$vrow5['Totals'];
			$vLineOne=str_replace("@#05",$this->FormatView($vrow5['Salary'],10),$vLineOne);
			
			$vrow6=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'06');
			$vTotalNums6=$vTotalNums6+$vrow6['Nums'];
			$vTotalSalary6=$vTotalSalary6+$vrow6['Salary'];
			$vTotalDoanPhi6=$vTotalDoanPhi6+$vrow6['DoanPhi'];
			$vTotalTotals6=$vTotalTotals6+$vrow6['Totals'];
			$vLineOne=str_replace("@#06",$this->FormatView($vrow6['Salary'],10),$vLineOne);
			
			$vrow7=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'07');
			$vTotalNums7=$vTotalNums7+$vrow7['Nums'];
			$vTotalSalary7=$vTotalSalary7+$vrow7['Salary'];
			$vTotalDoanPhi7=$vTotalDoanPhi7+$vrow7['DoanPhi'];
			$vTotalTotals7=$vTotalTotals7+$vrow7['Totals'];
			$vLineOne=str_replace("@#07",$this->FormatView($vrow7['Salary'],10),$vLineOne);
			
			$vrow8=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'08');
			$vTotalNums8=$vTotalNums8+$vrow8['Nums'];
			$vTotalSalary8=$vTotalSalary8+$vrow8['Salary'];
			$vTotalDoanPhi8=$vTotalDoanPhi8+$vrow8['DoanPhi'];
			$vTotalTotals8=$vTotalTotals8+$vrow8['Totals'];
			$vLineOne=str_replace("@#08",$this->FormatView($vrow8['Salary'],10),$vLineOne);
			
			$vrow9=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'09');
			$vTotalNums9=$vTotalNums9+$vrow9['Nums'];
			$vTotalSalary9=$vTotalSalary9+$vrow9['Salary'];
			$vTotalDoanPhi9=$vTotalDoanPhi9+$vrow9['DoanPhi'];
			$vTotalTotals9=$vTotalTotals9+$vrow9['Totals'];
			$vLineOne=str_replace("@#09",$this->FormatView($vrow9['Salary'],10),$vLineOne);
			
			$vrow10=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'10');
			$vTotalNums10=$vTotalNums10+$vrow10['Nums'];
			$vTotalSalary10=$vTotalSalary10+$vrow10['Salary'];
			$vTotalDoanPhi10=$vTotalDoanPhi10+$vrow10['DoanPhi'];
			$vTotalTotals10=$vTotalTotals10+$vrow10['Totals'];
			$vLineOne=str_replace("@#10",$this->FormatView($vrow10['Salary'],10),$vLineOne);
			
			$vrow11=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'11');
			$vTotalNums11=$vTotalNums11+$vrow11['Nums'];
			$vTotalSalary11=$vTotalSalary11+$vrow11['Salary'];
			$vTotalDoanPhi11=$vTotalDoanPhi11+$vrow11['DoanPhi'];
			$vTotalTotals11=$vTotalTotals11+$vrow11['Totals'];
			$vLineOne=str_replace("@#11",$this->FormatView($vrow11['Salary'],10),$vLineOne);
			
			$vrow12=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'12');
			$vTotalNums12=$vTotalNums12+$vrow12['Nums'];
			$vTotalSalary12=$vTotalSalary12+$vrow12['Salary'];
			$vTotalDoanPhi12=$vTotalDoanPhi12+$vrow12['DoanPhi'];
			$vTotalTotals12=$vTotalTotals12+$vrow12['Totals'];
			$vLineOne=str_replace("@#12",$this->FormatView($vrow12['Salary'],20),$vLineOne);
			$vSumTotals=$vrow1['Totals']+$vrow2['Totals']+$vrow3['Totals']+$vrow4['Totals']+$vrow5['Totals']+$vrow6['Totals']+$vrow7['Totals']+$vrow8['Totals']+$vrow9['Totals']+$vrow10['Totals']+$vrow11['Totals']+$vrow12['Totals'];
			$vSumSalary=$vrow1['Salary']+$vrow2['Salary']+$vrow3['Salary']+$vrow4['Salary']+$vrow5['Salary']+$vrow6['Salary']+$vrow7['Salary']+$vrow8['Salary']+$vrow9['Salary']+$vrow10['Salary']+$vrow11['Salary']+$vrow12['Salary'];
			$vSumDoanPhi=$vrow1['DoanPhi']+$vrow2['DoanPhi']+$vrow3['DoanPhi']+$vrow4['DoanPhi']+$vrow5['DoanPhi']+$vrow6['DoanPhi']+$vrow7['DoanPhi']+$vrow8['DoanPhi']+$vrow9['DoanPhi']+$vrow10['DoanPhi']+$vrow11['DoanPhi']+$vrow12['DoanPhi'];
			$vTotalSalary=$vTotalSalary+$vSumSalary;
			$vTotalTotal=$vTotalTotal+$vSumTotals;
			$vTotalDoanPhi=$vTotalDoanPhi+$vSumDoanPhi;
			$vLineOne=str_replace("@#13",$this->FormatView($vSumSalary,10),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Trích nộp 2%',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal,10),$vLineOne);
		$strTrH=$vLineOne.$strTrH;
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Quỹ lương BHXH',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalSalary1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalSalary2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalSalary3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalSalary4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalSalary5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalSalary6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalSalary7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalSalary8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalSalary9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalSalary10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalSalary11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalSalary12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalSalary,10),$vLineOne);
		$strTrH=$vLineOne.$strTrH;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Kinh Phí',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalDoanPhi1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalDoanPhi2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalDoanPhi3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalDoanPhi4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalDoanPhi5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalDoanPhi6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalDoanPhi7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalDoanPhi8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalDoanPhi9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalDoanPhi10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalDoanPhi11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalDoanPhi12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalDoanPhi,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Kinh phí lao động',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'Tổng cộng',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1+$vTotalDoanPhi1,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2+$vTotalDoanPhi2,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3+$vTotalDoanPhi3,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4+$vTotalDoanPhi4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5+$vTotalDoanPhi5,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6+$vTotalDoanPhi6,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7+$vTotalDoanPhi7,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8+$vTotalDoanPhi8,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9+$vTotalDoanPhi9,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10+$vTotalDoanPhi10,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11+$vTotalDoanPhi11,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12+$vTotalDoanPhi12,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal+$vTotalDoanPhi,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'40% Doan phi nop cap tren',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalDoanPhi1*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalDoanPhi2*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalDoanPhi3*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalDoanPhi4*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalDoanPhi5*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalDoanPhi6*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalDoanPhi7*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalDoanPhi8*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalDoanPhi9*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalDoanPhi10*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalDoanPhi11*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalDoanPhi12*0.4,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalDoanPhi*0.4,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$vLineOne=$vTR;
		$vLineOne=str_replace("@#00",'35% Kinh phi nop cap tren',$vLineOne);
		$vLineOne=str_replace("@#01",$this->FormatView($vTotalTotals1*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#02",$this->FormatView($vTotalTotals2*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#03",$this->FormatView($vTotalTotals3*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#04",$this->FormatView($vTotalTotals4*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vTotalTotals5*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vTotalTotals6*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vTotalTotals7*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vTotalTotals8*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vTotalTotals9*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vTotalTotals10*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vTotalTotals11*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vTotalTotals12*0.35,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vTotalTotal*0.35,10),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_TrichCongDoanFull($vopt=0,$vYear,$vMonth)
	{
		//Liệt kê phòng ban
		$vArrDept=Array();
		$vTitlePB='<td style="text-align: center;" colspan="4" width="244" height="34"><strong>@01</strong></td>';
		$vTitlePBChild='
<td style="text-align: center;" width="48" height="71">Tổng số lao động</td>
<td width="98" style="text-align: center;" width="98">Tổng Lương<br/>Tham gia BH</td>
<td style="text-align: center;" width="98">Kinh Phí <br /> Công Đòan <br /> 2%</td>
<td style="text-align: center;" width="98">Đoàn Phí</td>
';
		$vContentBP='
<td style="text-align: center;" width="48" height="71">@01</td>
<td width="98" style="text-align: center;" width="98">@02</td>
<td style="text-align: center;" width="98">@03</td><td style="text-align: center;" width="98">@04</td>';
		$vsql="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$bResult = db_query($vsql);
		$vTotalNums1=0;
		$vTotalNums2=0;
		$vTotalNums3=0;
		$vTotalNums4=0;
		$vTotalNums5=0;
		$vTotalNums6=0;
		$vTotalNums7=0;
		$vTotalNums8=0;
		$vTotalNums9=0;
		$vTotalNums10=0;
		$vTotalNums11=0;
		$vTotalNums12=0;
		
		$vTotalSalary1=0;
		$vTotalSalary2=0;
		$vTotalSalary3=0;
		$vTotalSalary4=0;
		$vTotalSalary5=0;
		$vTotalSalary6=0;
		$vTotalSalary7=0;
		$vTotalSalary8=0;
		$vTotalSalary9=0;
		$vTotalSalary10=0;
		$vTotalSalary11=0;
		$vTotalSalary12=0;	

		$vTotalTotal1=0;
		$vTotalTotal2=0;
		$vTotalTotal3=0;
		$vTotalTotal4=0;
		$vTotalTotal5=0;
		$vTotalTotal6=0;
		$vTotalTotal7=0;
		$vTotalTotal8=0;
		$vTotalTotal9=0;
		$vTotalTotal10=0;
		$vTotalTotal11=0;
		$vTotalTotal12=0;

		$vTotalDonPhi1=0;
		$vTotalDonPhi2=0;
		$vTotalDonPhi3=0;
		$vTotalDonPhi4=0;
		$vTotalDonPhi5=0;
		$vTotalDonPhi6=0;
		$vTotalDonPhi7=0;
		$vTotalDonPhi8=0;
		$vTotalDonPhi9=0;
		$vTotalDonPhi10=0;
		$vTotalDonPhi11=0;
		$vTotalDonPhi12=0;		
		while ($vrow = db_fetch_array ($bResult)){
			//echo $vrow['lv001'];
			$vArrDept[$vrow['lv001']]['lv001']=	$vrow['lv001'];
			$vArrDept[$vrow['lv001']]['lv003']=	$vrow['lv003'];
			$vArrDept[$vrow['lv001']][30]=str_replace("@01",$vrow['lv003'],$vTitlePB);
			$vArrDept[$vrow['lv001']][31]=$vTitlePBChild;
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'01');
			$vTotalNums1=$vTotalNums1+$vrow1['Nums'];
			$vTotalSalary1=$vTotalSalary1+$vrow1['Salary'];
			$vTotalTotals1=$vTotalTotals1+$vrow1['Totals'];
			$vTotalDoanPhi1=$vTotalDoanPhi1+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][1]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'02');
			$vTotalNums2=$vTotalNums2+$vrow1['Nums'];
			$vTotalSalary2=$vTotalSalary2+$vrow1['Salary'];
			$vTotalTotals2=$vTotalTotals2+$vrow1['Totals'];
			$vTotalDoanPhi2=$vTotalDoanPhi2+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][2]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'03');
			$vTotalNums3=$vTotalNums3+$vrow1['Nums'];
			$vTotalSalary3=$vTotalSalary3+$vrow1['Salary'];
			$vTotalTotals3=$vTotalTotals3+$vrow1['Totals'];
			$vTotalDoanPhi3=$vTotalDoanPhi3+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($this->FormatView($vrow1['Nums'],10),10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][3]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'04');
			$vTotalNums4=$vTotalNums4+$vrow1['Nums'];
			$vTotalSalary4=$vTotalSalary4+$vrow1['Salary'];
			$vTotalTotals4=$vTotalTotals4+$vrow1['Totals'];
			$vTotalDoanPhi4=$vTotalDoanPhi4+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][4]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'05');
			$vTotalNums5=$vTotalNums5+$vrow1['Nums'];
			$vTotalSalary5=$vTotalSalary5+$vrow1['Salary'];
			$vTotalTotals5=$vTotalTotals5+$vrow1['Totals'];
			$vTotalDoanPhi5=$vTotalDoanPhi5+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][5]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'06');
			$vTotalNums6=$vTotalNums6+$vrow1['Nums'];
			$vTotalSalary6=$vTotalSalary6+$vrow1['Salary'];
			$vTotalTotals6=$vTotalTotals6+$vrow1['Totals'];
			$vTotalDoanPhi6=$vTotalDoanPhi6+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][6]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'07');
			$vTotalNums7=$vTotalNums7+$vrow1['Nums'];
			$vTotalSalary7=$vTotalSalary7+$vrow1['Salary'];
			$vTotalTotals7=$vTotalTotals7+$vrow1['Totals'];
			$vTotalDoanPhi7=$vTotalDoanPhi7+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][7]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'08');
			$vTotalNums8=$vTotalNums8+$vrow1['Nums'];
			$vTotalSalary8=$vTotalSalary8+$vrow1['Salary'];
			$vTotalTotals8=$vTotalTotals8+$vrow1['Totals'];
			$vTotalDoanPhi8=$vTotalDoanPhi8+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][8]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'09');
			$vTotalNums9=$vTotalNums9+$vrow1['Nums'];
			$vTotalSalary9=$vTotalSalary9+$vrow1['Salary'];
			$vTotalTotals9=$vTotalTotals9+$vrow1['Totals'];
			$vTotalDoanPhi9=$vTotalDoanPhi9+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][9]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'10');
			$vTotalNums10=$vTotalNums10+$vrow1['Nums'];
			$vTotalSalary10=$vTotalSalary10+$vrow1['Salary'];
			$vTotalTotals10=$vTotalTotals10+$vrow1['Totals'];
			$vTotalDoanPhi10=$vTotalDoanPhi10+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][10]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'11');
			$vTotalNums11=$vTotalNums11+$vrow1['Nums'];
			$vTotalSalary11=$vTotalSalary11+$vrow1['Salary'];
			$vTotalTotals11=$vTotalTotals11+$vrow1['Totals'];
			$vTotalDoanPhi11=$vTotalDoanPhi11+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][11]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyCongDoan($vrow['lv001'],$vYear,'12');
			$vTotalNums12=$vTotalNums12+$vrow1['Nums'];
			$vTotalSalary12=$vTotalSalary12+$vrow1['Salary'];
			$vTotalTotals12=$vTotalTotals12+$vrow1['Totals'];
			$vTotalDoanPhi12=$vTotalDoanPhi12+$vrow1['DoanPhi'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['Totals'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['DoanPhi'],10),$vContent);
			$vArrDept[$vrow['lv001']][12]=$vContent;
		}
		$vArrDept['THAIDUCLAM']['lv001']=	'THAIDUCLAM';
		$vArrDept['THAIDUCLAM']['lv003']=	'TỔNG CỘNG';
		$vArrDept['THAIDUCLAM'][30]=str_replace("@01",'TỔNG CỘNG',$vTitlePB);
		$vArrDept['THAIDUCLAM'][31]=$vTitlePBChild;
		$vContent=str_replace("@01",$this->FormatView($vTotalNums1,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary1,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals1,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi1,10),$vContent);
		$vArrDept['THAIDUCLAM'][1]=$vContent;

		$vContent=str_replace("@01",$this->FormatView($vTotalNums2,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary2,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals2,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi2,10),$vContent);
		$vArrDept['THAIDUCLAM'][2]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums3,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary3,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals3,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi3,10),$vContent);
		$vArrDept['THAIDUCLAM'][3]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums4,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary4,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals4,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi4,10),$vContent);
		$vArrDept['THAIDUCLAM'][4]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums5,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary5,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals5,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi5,10),$vContent);
		$vArrDept['THAIDUCLAM'][5]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums6,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary6,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals6,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi6,10),$vContent);
		$vArrDept['THAIDUCLAM'][6]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums7,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary7,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals7,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi7,10),$vContent);
		$vArrDept['THAIDUCLAM'][7]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums8,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary8,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals8,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi8,10),$vContent);
		$vArrDept['THAIDUCLAM'][8]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums9,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary9,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals9,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi9,10),$vContent);
		$vArrDept['THAIDUCLAM'][9]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums10,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary10,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals10,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi10,10),$vContent);
		$vArrDept['THAIDUCLAM'][10]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums11,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary11,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals11,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi11,10),$vContent);
		$vArrDept['THAIDUCLAM'][11]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums12,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTotalSalary12,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTotals12,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalDoanPhi12,10),$vContent);
		$vArrDept['THAIDUCLAM'][12]=$vContent;
		$vArrTT=Array();
		foreach($vArrDept as $vDept)
		{
			$vArrTT[30]=$vArrTT[30].$vDept[30];
			$vArrTT[31]=$vArrTT[31].$vDept[31];
			$vArrTT[1]=$vArrTT[1].$vDept[1];
			$vArrTT[2]=$vArrTT[2].$vDept[2];
			$vArrTT[3]=$vArrTT[3].$vDept[3];
			$vArrTT[4]=$vArrTT[4].$vDept[4];
			$vArrTT[5]=$vArrTT[5].$vDept[5];
			$vArrTT[6]=$vArrTT[6].$vDept[6];
			$vArrTT[7]=$vArrTT[7].$vDept[7];
			$vArrTT[8]=$vArrTT[8].$vDept[8];
			$vArrTT[9]=$vArrTT[9].$vDept[9];
			$vArrTT[10]=$vArrTT[10].$vDept[10];
			$vArrTT[11]=$vArrTT[11].$vDept[11];
			$vArrTT[12]=$vArrTT[12].$vDept[12];
		}
		$vTable='
		<table border="1" cellspacing=0 cellpadding=0>
		<tr><td rowspan="2">Tháng /Năm </td>'.$vArrTT[30].'<td rowspan="2" style="width:100px" >Ghi chú </td></tr>
		<tr>'.$vArrTT[31].'</tr>
		'.(($vTotalNums1<=0)?'':'<tr><td>01/'.$vYear.'</td>'.$vArrTT[1].'<td></td></tr>').'
		'.(($vTotalNums2<=0)?'':'<tr><td>02/'.$vYear.'</td>'.$vArrTT[2].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums3<=0)?'':'<tr><td>03/'.$vYear.'</td>'.$vArrTT[3].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums4<=0)?'':'<tr><td>04/'.$vYear.'</td>'.$vArrTT[4].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums5<=0)?'':'<tr><td>05/'.$vYear.'</td>'.$vArrTT[5].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums6<=0)?'':'<tr><td>06/'.$vYear.'</td>'.$vArrTT[6].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums7<=0)?'':'<tr><td>07/'.$vYear.'</td>'.$vArrTT[7].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums8<=0)?'':'<tr><td>08/'.$vYear.'</td>'.$vArrTT[8].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums9<=0)?'':'<tr><td>09/'.$vYear.'</td>'.$vArrTT[9].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums10<=0)?'':'<tr><td>10/'.$vYear.'</td>'.$vArrTT[10].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums11<=0)?'':'<tr><td>11/'.$vYear.'</td>'.$vArrTT[11].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums12<=0)?'':'<tr><td>12/'.$vYear.'</td>'.$vArrTT[12].'<td>&nbsp;</td></tr>').'
		</table>
		';
		return $vTable;
		
	}
	function LV_TrichBaoHiemFull($vopt=0,$vYear,$vMonth,$motc_lv0013)
	{
		//Liệt kê phòng ban
		$vArrDept=Array();
		$vTitlePB='<td style="text-align: center;" colspan="6" width="244" height="34"><strong>@01</strong></td>';
		$vTitlePBChild='
<td style="text-align: center;" width="48" height="71">Tổng số lao động</td>
<td width="98" style="text-align: center;" width="98">Quỹ Lương<br/>Tham gia BH</td>
<td style="text-align: center;" width="98">BHXH '.$this->FormatView($motc_lv0013->lv012+$motc_lv0013->lv017,10).'%</td>
<td style="text-align: center;" width="98"> BHTN '.$this->FormatView($motc_lv0013->lv014+$motc_lv0013->lv019,10).'%</td>
<td style="text-align: center;" width="98"> BHYT '.$this->FormatView($motc_lv0013->lv013+$motc_lv0013->lv018,10).'% </td>
<td style="text-align: center;" width="98"> TỔNG CỘNG</td>
';
		$vContentBP='
<td style="text-align: center;" width="48" height="71">@01</td>
<td width="98" style="text-align: center;" width="98">@02</td>
<td style="text-align: center;" width="98">@03</td>
<td style="text-align: center;" width="98">@04</td>
<td style="text-align: center;" width="98">@05</td>
<td style="text-align: center;" width="98">@06</td>
';
		$vsql="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$bResult = db_query($vsql);
		$vTotalNums1=0;
		$vTotalNums2=0;
		$vTotalNums3=0;
		$vTotalNums4=0;
		$vTotalNums5=0;
		$vTotalNums6=0;
		$vTotalNums7=0;
		$vTotalNums8=0;
		$vTotalNums9=0;
		$vTotalNums10=0;
		$vTotalNums11=0;
		$vTotalNums12=0;
		
		$vTongBHXHalary1=0;
		$vTongBHXHalary2=0;
		$vTongBHXHalary3=0;
		$vTongBHXHalary4=0;
		$vTongBHXHalary5=0;
		$vTongBHXHalary6=0;
		$vTongBHXHalary7=0;
		$vTongBHXHalary8=0;
		$vTongBHXHalary9=0;
		$vTongBHXHalary10=0;
		$vTongBHXHalary11=0;
		$vTongBHXHalary12=0;	

		$vTotalTongBHXH1=0;
		$vTotalTongBHXH2=0;
		$vTotalTongBHXH3=0;
		$vTotalTongBHXH4=0;
		$vTotalTongBHXH5=0;
		$vTotalTongBHXH6=0;
		$vTotalTongBHXH7=0;
		$vTotalTongBHXH8=0;
		$vTotalTongBHXH9=0;
		$vTotalTongBHXH10=0;
		$vTotalTongBHXH11=0;
		$vTotalTongBHXH12=0;

		$vTotalTongBHYT1=0;
		$vTotalTongBHYT2=0;
		$vTotalTongBHYT3=0;
		$vTotalTongBHYT4=0;
		$vTotalTongBHYT5=0;
		$vTotalTongBHYT6=0;
		$vTotalTongBHYT7=0;
		$vTotalTongBHYT8=0;
		$vTotalTongBHYT9=0;
		$vTotalTongBHYT10=0;
		$vTotalTongBHYT11=0;
		$vTotalTongBHYT12=0;	

		$vTotalTongBHTN1=0;
		$vTotalTongBHTN2=0;
		$vTotalTongBHTN3=0;
		$vTotalTongBHTN4=0;
		$vTotalTongBHTN5=0;
		$vTotalTongBHTN6=0;
		$vTotalTongBHTN7=0;
		$vTotalTongBHTN8=0;
		$vTotalTongBHTN9=0;
		$vTotalTongBHTN10=0;
		$vTotalTongBHTN11=0;
		$vTotalTongBHTN12=0;		
		
		$vTotalTongTienBH1=0;
		$vTotalTongTienBH2=0;
		$vTotalTongTienBH3=0;
		$vTotalTongTienBH4=0;
		$vTotalTongTienBH5=0;
		$vTotalTongTienBH6=0;
		$vTotalTongTienBH7=0;
		$vTotalTongTienBH8=0;
		$vTotalTongTienBH9=0;
		$vTotalTongTienBH10=0;
		$vTotalTongTienBH11=0;
		$vTotalTongTienBH12=0;
		while ($vrow = db_fetch_array ($bResult)){
			//echo $vrow['lv001'];
			$vArrDept[$vrow['lv001']]['lv001']=	$vrow['lv001'];
			$vArrDept[$vrow['lv001']]['lv003']=	$vrow['lv003'];
			$vArrDept[$vrow['lv001']][30]=str_replace("@01",$vrow['lv003'],$vTitlePB);
			$vArrDept[$vrow['lv001']][31]=$vTitlePBChild;
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'01');
			$vTotalNums1=$vTotalNums1+$vrow1['Nums'];
			$vTongBHXHalary1=$vTongBHXHalary1+$vrow1['Salary'];
			$vTotalTongBHXH1=$vTotalTongBHXH1+$vrow1['TongBHXH'];
			$vTotalTongBHYT1=$vTotalTongBHYT1+$vrow1['TongBHYT'];
			$vTotalTongBHTN1=$vTotalTongBHTN1+$vrow1['TongBHTN'];
			$vTotalTongTienBH1=$vTotalTongTienBH1+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][1]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'02');
			$vTotalNums2=$vTotalNums2+$vrow1['Nums'];
			$vTongBHXHalary2=$vTongBHXHalary2+$vrow1['Salary'];
			$vTotalTongBHXH2=$vTotalTongBHXH2+$vrow1['TongBHXH'];
			$vTotalTongBHYT2=$vTotalTongBHYT2+$vrow1['TongBHYT'];
			$vTotalTongBHTN2=$vTotalTongBHTN2+$vrow1['TongBHTN'];
			$vTotalTongTienBH2=$vTotalTongTienBH2+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][2]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'03');
			$vTotalNums3=$vTotalNums3+$vrow1['Nums'];
			$vTongBHXHalary3=$vTongBHXHalary3+$vrow1['Salary'];
			$vTotalTongBHXH3=$vTotalTongBHXH3+$vrow1['TongBHXH'];
			$vTotalTongBHYT3=$vTotalTongBHYT3+$vrow1['TongBHYT'];
			$vTotalTongBHTN3=$vTotalTongBHTN3+$vrow1['TongBHTN'];
			$vTotalTongTienBH3=$vTotalTongTienBH3+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($this->FormatView($vrow1['Nums'],10),10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vArrDept[$vrow['lv001']][3]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'04');
			$vTotalNums4=$vTotalNums4+$vrow1['Nums'];
			$vTongBHXHalary4=$vTongBHXHalary4+$vrow1['Salary'];
			$vTotalTongBHXH4=$vTotalTongBHXH4+$vrow1['TongBHXH'];
			$vTotalTongBHYT4=$vTotalTongBHYT4+$vrow1['TongBHYT'];
			$vTotalTongBHTN4=$vTotalTongBHTN4+$vrow1['TongBHTN'];
			$vTotalTongTienBH4=$vTotalTongTienBH4+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][4]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'05');
			$vTotalNums5=$vTotalNums5+$vrow1['Nums'];
			$vTongBHXHalary5=$vTongBHXHalary5+$vrow1['Salary'];
			$vTotalTongBHXH5=$vTotalTongBHXH5+$vrow1['TongBHXH'];
			$vTotalTongBHYT5=$vTotalTongBHYT5+$vrow1['TongBHYT'];
			$vTotalTongBHTN5=$vTotalTongBHTN5+$vrow1['TongBHTN'];
			$vTotalTongTienBH5=$vTotalTongTienBH5+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][5]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'06');
			$vTotalNums6=$vTotalNums6+$vrow1['Nums'];
			$vTongBHXHalary6=$vTongBHXHalary6+$vrow1['Salary'];
			$vTotalTongBHXH6=$vTotalTongBHXH6+$vrow1['TongBHXH'];
			$vTotalTongBHYT6=$vTotalTongBHYT6+$vrow1['TongBHYT'];
			$vTotalTongBHTN6=$vTotalTongBHTN6+$vrow1['TongBHTN'];
			$vTotalTongTienBH6=$vTotalTongTienBH6+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][6]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'07');
			$vTotalNums7=$vTotalNums7+$vrow1['Nums'];
			$vTongBHXHalary7=$vTongBHXHalary7+$vrow1['Salary'];
			$vTotalTongBHXH7=$vTotalTongBHXH7+$vrow1['TongBHXH'];
			$vTotalTongBHYT7=$vTotalTongBHYT7+$vrow1['TongBHYT'];
			$vTotalTongBHTN7=$vTotalTongBHTN7+$vrow1['TongBHTN'];
			$vTotalTongTienBH7=$vTotalTongTienBH7+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][7]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'08');
			$vTotalNums8=$vTotalNums8+$vrow1['Nums'];
			$vTongBHXHalary8=$vTongBHXHalary8+$vrow1['Salary'];
			$vTotalTongBHXH8=$vTotalTongBHXH8+$vrow1['TongBHXH'];
			$vTotalTongBHYT8=$vTotalTongBHYT8+$vrow1['TongBHYT'];
			$vTotalTongBHTN8=$vTotalTongBHTN8+$vrow1['TongBHTN'];
			$vTotalTongTienBH8=$vTotalTongTienBH8+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][8]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'09');
			$vTotalNums9=$vTotalNums9+$vrow1['Nums'];
			$vTongBHXHalary9=$vTongBHXHalary9+$vrow1['Salary'];
			$vTotalTongBHXH9=$vTotalTongBHXH9+$vrow1['TongBHXH'];
			$vTotalTongBHYT9=$vTotalTongBHYT9+$vrow1['TongBHYT'];
			$vTotalTongBHTN9=$vTotalTongBHTN9+$vrow1['TongBHTN'];
			$vTotalTongTienBH9=$vTotalTongTienBH9+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][9]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'10');
			$vTotalNums10=$vTotalNums10+$vrow1['Nums'];
			$vTongBHXHalary10=$vTongBHXHalary10+$vrow1['Salary'];
			$vTotalTongBHXH10=$vTotalTongBHXH10+$vrow1['TongBHXH'];
			$vTotalTongBHYT10=$vTotalTongBHYT10+$vrow1['TongBHYT'];
			$vTotalTongBHTN10=$vTotalTongBHTN10+$vrow1['TongBHTN'];
			$vTotalTongTienBH10=$vTotalTongTienBH10+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][10]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'11');
			$vTotalNums11=$vTotalNums11+$vrow1['Nums'];
			$vTongBHXHalary11=$vTongBHXHalary11+$vrow1['Salary'];
			$vTotalTongBHXH11=$vTotalTongBHXH11+$vrow1['TongBHXH'];
			$vTotalTongBHYT11=$vTotalTongBHYT11+$vrow1['TongBHYT'];
			$vTotalTongBHTN11=$vTotalTongBHTN11+$vrow1['TongBHTN'];
			$vTotalTongTienBH11=$vTotalTongTienBH11+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][11]=$vContent;
			
			$vrow1=$this->LV_GetMonthlyBaoHiem($vrow['lv001'],$vYear,'12');
			$vTotalNums12=$vTotalNums12+$vrow1['Nums'];
			$vTongBHXHalary12=$vTongBHXHalary12+$vrow1['Salary'];
			$vTotalTongBHXH12=$vTotalTongBHXH12+$vrow1['TongBHXH'];
			$vTotalTongBHYT12=$vTotalTongBHYT12+$vrow1['TongBHYT'];
			$vTotalTongBHTN12=$vTotalTongBHTN12+$vrow1['TongBHTN'];
			$vTotalTongTienBH12=$vTotalTongTienBH12+$vrow1['TongTienBH'];
			$vContent=str_replace("@01",$this->FormatView($vrow1['Nums'],10),$vContentBP);
			$vContent=str_replace("@02",$this->FormatView($vrow1['Salary'],10),$vContent);
			$vContent=str_replace("@03",$this->FormatView($vrow1['TongBHXH'],10),$vContent);
			$vContent=str_replace("@04",$this->FormatView($vrow1['TongBHYT'],10),$vContent);
			$vContent=str_replace("@05",$this->FormatView($vrow1['TongBHTN'],10),$vContent);
			$vContent=str_replace("@06",$this->FormatView($vrow1['TongTienBH'],10),$vContent);
			$vArrDept[$vrow['lv001']][12]=$vContent;
		}
		$vArrDept['THAIDUCLAM']['lv001']=	'THAIDUCLAM';
		$vArrDept['THAIDUCLAM']['lv003']=	'TỔNG CỘNG';
		$vArrDept['THAIDUCLAM'][30]=str_replace("@01",'TỔNG CỘNG',$vTitlePB);
		$vArrDept['THAIDUCLAM'][31]=$vTitlePBChild;
		$vContent=str_replace("@01",$this->FormatView($vTotalNums1,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary1,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH1,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT1,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN1,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH1,10),$vContent);
		$vArrDept['THAIDUCLAM'][1]=$vContent;

		$vContent=str_replace("@01",$this->FormatView($vTotalNums2,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary2,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH2,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT2,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN2,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH2,10),$vContent);
		$vArrDept['THAIDUCLAM'][2]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums3,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary3,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH3,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT3,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN3,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH3,10),$vContent);
		$vArrDept['THAIDUCLAM'][3]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums4,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary4,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH4,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT4,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN4,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH4,10),$vContent);
		$vArrDept['THAIDUCLAM'][4]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums5,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary5,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH5,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT5,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN5,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH5,10),$vContent);
		$vArrDept['THAIDUCLAM'][5]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums6,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary6,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH6,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT6,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN6,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH6,10),$vContent);
		$vArrDept['THAIDUCLAM'][6]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums7,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary7,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH7,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT7,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN7,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH7,10),$vContent);
		$vArrDept['THAIDUCLAM'][7]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums8,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary8,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH8,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT8,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN8,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH8,10),$vContent);
		$vArrDept['THAIDUCLAM'][8]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums9,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary9,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH9,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT9,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN9,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH9,10),$vContent);
		$vArrDept['THAIDUCLAM'][9]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums10,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary10,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH10,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT10,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN10,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH10,10),$vContent);
		$vArrDept['THAIDUCLAM'][10]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums11,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary11,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH11,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT11,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN11,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH11,10),$vContent);
		$vArrDept['THAIDUCLAM'][11]=$vContent;
		
		$vContent=str_replace("@01",$this->FormatView($vTotalNums12,10),$vContentBP);
		$vContent=str_replace("@02",$this->FormatView($vTongBHXHalary12,10),$vContent);
		$vContent=str_replace("@03",$this->FormatView($vTotalTongBHXH12,10),$vContent);
		$vContent=str_replace("@04",$this->FormatView($vTotalTongBHYT12,10),$vContent);
		$vContent=str_replace("@05",$this->FormatView($vTotalTongBHTN12,10),$vContent);
		$vContent=str_replace("@06",$this->FormatView($vTotalTongTienBH12,10),$vContent);
		$vArrDept['THAIDUCLAM'][12]=$vContent;
		$vArrTT=Array();
		foreach($vArrDept as $vDept)
		{
			$vArrTT[30]=$vArrTT[30].$vDept[30];
			$vArrTT[31]=$vArrTT[31].$vDept[31];
			$vArrTT[1]=$vArrTT[1].$vDept[1];
			$vArrTT[2]=$vArrTT[2].$vDept[2];
			$vArrTT[3]=$vArrTT[3].$vDept[3];
			$vArrTT[4]=$vArrTT[4].$vDept[4];
			$vArrTT[5]=$vArrTT[5].$vDept[5];
			$vArrTT[6]=$vArrTT[6].$vDept[6];
			$vArrTT[7]=$vArrTT[7].$vDept[7];
			$vArrTT[8]=$vArrTT[8].$vDept[8];
			$vArrTT[9]=$vArrTT[9].$vDept[9];
			$vArrTT[10]=$vArrTT[10].$vDept[10];
			$vArrTT[11]=$vArrTT[11].$vDept[11];
			$vArrTT[12]=$vArrTT[12].$vDept[12];
		}
		$vTable='
		<table border="1" cellspacing=0 cellpadding=0>
		<tr><td rowspan="2">Tháng /Năm </td>'.$vArrTT[30].'<td rowspan="2" style="width:100px" >Ghi chú </td></tr>
		<tr>'.$vArrTT[31].'</tr>
		'.(($vTotalNums1<=0)?'':'<tr><td>01/'.$vYear.'</td>'.$vArrTT[1].'<td></td></tr>').'
		'.(($vTotalNums2<=0)?'':'<tr><td>02/'.$vYear.'</td>'.$vArrTT[2].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums3<=0)?'':'<tr><td>03/'.$vYear.'</td>'.$vArrTT[3].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums4<=0)?'':'<tr><td>04/'.$vYear.'</td>'.$vArrTT[4].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums5<=0)?'':'<tr><td>05/'.$vYear.'</td>'.$vArrTT[5].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums6<=0)?'':'<tr><td>06/'.$vYear.'</td>'.$vArrTT[6].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums7<=0)?'':'<tr><td>07/'.$vYear.'</td>'.$vArrTT[7].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums8<=0)?'':'<tr><td>08/'.$vYear.'</td>'.$vArrTT[8].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums9<=0)?'':'<tr><td>09/'.$vYear.'</td>'.$vArrTT[9].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums10<=0)?'':'<tr><td>10/'.$vYear.'</td>'.$vArrTT[10].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums11<=0)?'':'<tr><td>11/'.$vYear.'</td>'.$vArrTT[11].'<td>&nbsp;</td></tr>').'
		'.(($vTotalNums12<=0)?'':'<tr><td>12/'.$vYear.'</td>'.$vArrTT[12].'<td>&nbsp;</td></tr>').'
		</table>
		';
		return $vTable;
		
	}
	
	function LV_GetMonthlyCongDoan($vDept,$vYear,$vMonth,$vField='lv080')
	{
		$vListDept=$this->LV_GetDep($vDept);
		$vsql="select count(*) Nums,sum(A.lv006) Salary,sum(A.$vField) Totals,sum(A.lv035) DoanPhi from tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 where AA.lv004 in ($vListDept) and (A.$vField>0 or A.lv035>0) and Year(A.lv005)='$vYear' and month(A.lv005)='$vMonth'";
		$bResult = db_query($vsql);
		$vrow = db_fetch_array ($bResult);
		return $vrow;
	}
	function LV_TrichCongDoan($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="18" />
			<col width="120" />
			<col width="40" />
			<col width="160" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" width="18"><center><strong>No<br/>(Stt)
</strong></center></td>
				<td  ><center><strong>CODE<br/>(Mã NV)
</strong></center></td>
				<td ><center><strong>Full Name<br/>(Họ tên)
</strong></center></td>
				<td ><center><strong>Start date<br/>(Ngày vào làm)
</strong></center></td>
				<td  ><center><strong> Position<br/>(Chức danh)
</strong></center></td>
				<td ><center><strong> Basic Salary<br/>(Lương Căn Bản)
 </strong></center></td>
				<td ><center><strong>Phí Công Đoàn 
2%<br/>(Hotel)
</strong></center></td>
				<td ><center><strong>Union Fee<br />(Đoàn phí)</strong></center></td>
				<td ><center><strong> Remark<br/>(Ghi chú)
 </strong></center></td>
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>A
</strong></center></td>
				<td  width="18" ><center><strong>B
</strong></center></td>
				<td ><center><strong>C
</strong></center></td>
				<td ><center><strong>D
</strong></center></td>
				<td  ><center><strong>1
</strong></center></td>
				<td ><center><strong>2
 </strong></center></td>
				<td ><center><strong>3
</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td ><center><strong>5
 </strong></center></td>
			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>

		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=left>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td align=left>@#03</td>
			<td align=center><strong>@#04</strong></td>
			<td align=left><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=center><strong>@#09</strong></td>

		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0   ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0 and A.lv080<>0 and  (A.lv039<>0 or A.lv043<>0)   ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0 and   (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 4:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv006_0=0;
		$vlv080_0=0;
		$strTrH='';
		$vOrder=0;
		$vTang=0;
		while ($vrow = db_fetch_array ($bResult)){
			
			$vrow['lv058']=$vrow['DeptID'];
			if($strDepart!=$vrow['lv058'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv006_1,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv080_1,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv035_1,20),$vLineOne);
					$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
					$vLineOne=str_replace("@#09",'',$vLineOne);
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv006_1=0;
					$vlv080_1=0;
					$vlv035_1=0;
					}
					$strDepart=$vrow['lv058'];
			}
			if($this->optkpcd==1)
			{
				if($vrow['lv080']!=0)
				{
				$vlv006_0=$vlv006_0+$vrow['lv006'];
				$vlv006_1=$vlv006_1+$vrow['lv006'];
				$vTang++;
				$vlv080_0=$vlv080_0+$vrow['lv080'];
				$vlv035_0=$vlv035_0+$vrow['lv035'];
				
				//$vlv006_1=$vlv006_1+$vrow['lv006'];
				$vlv080_1=$vlv080_1+$vrow['lv080'];
				$vlv035_1=$vlv035_1+$vrow['lv035'];
				}
			}
			else
			{
				$vlv006_0=$vlv006_0+$vrow['lv006'];
				$vlv006_1=$vlv006_1+$vrow['lv006'];
				$vTang++;
				$vlv080_0=$vlv080_0+$vrow['lv080'];
				$vlv035_0=$vlv035_0+$vrow['lv035'];
				
				//$vlv006_1=$vlv006_1+$vrow['lv006'];
				$vlv080_1=$vlv080_1+$vrow['lv080'];
				$vlv035_1=$vlv035_1+$vrow['lv035'];
			}
			//$vlv006_0=$vlv006_0+$vrow['lv006'];
			
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['DateW'],2),$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv006'],10),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv080'],10),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv035'],20),$vLineOne);
			$vLineOne=str_replace("@#09",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv006_1,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv080_1,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv035_1,20),$vLineOne);
		$vLineOne=str_replace("@#09",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",$vTang,$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv006_0,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv080_0,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv035_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_TrichCongDoanLevel1($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="18" />
			<col width="120" />
			<col width="40" />
			<col width="160" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" width="18"><center><strong>No<br/>(Stt)
</strong></center></td>
				<td  ><center><strong>CODE<br/>(Mã NV)
</strong></center></td>
				<td ><center><strong>Full Name<br/>(Họ tên)
</strong></center></td>
				<td ><center><strong>Start date<br/>(Ngày vào làm)
</strong></center></td>
				<td  ><center><strong> Position<br/>(Chức danh)
</strong></center></td>
				<td ><center><strong> Basic Salary<br/>(Lương Căn Bản)
 </strong></center></td>
				<td ><center><strong>Phí Công Đoàn 
2%<br/>(Hotel)
</strong></center></td>
				<td ><center><strong>Union Fee<br />(Đoàn phí)</strong></center></td>
				<td ><center><strong> Remark<br/>(Ghi chú)
 </strong></center></td>
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>A
</strong></center></td>
				<td  width="18" ><center><strong>B
</strong></center></td>
				<td ><center><strong>C
</strong></center></td>
				<td ><center><strong>D
</strong></center></td>
				<td  ><center><strong>1
</strong></center></td>
				<td ><center><strong>2
 </strong></center></td>
				<td ><center><strong>3
</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td ><center><strong>5
 </strong></center></td>
			</tr>
			@#01
			@#02
			@#13
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>

		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=left>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td align=left>@#03</td>
			<td align=center><strong>@#04</strong></td>
			<td align=left><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=center><strong>@#09</strong></td>

		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		if($this->lv201=='TDL')
			$vsql="select * from hr_lv0002 where lv002='TDL'";
		elseif($this->lv201=='TECH')
			$vsql="select * from hr_lv0002 where lv002='TECH'";
		else
			$vsql="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$bResultL1 = db_query($vsql);
			$vlv006_0=0;
			$vlv150_0=0;
			
			$vOrder=0;
			$vTang=0;
		$vTang=0;
		$vlv006_0=0;
			$vlv080_0=0;
		while ($vrowL1 = db_fetch_array ($bResultL1))
		{
			$vListDep='';
			$strTrHSave='';
			$vListDep=trim($this->LV_GetChildDep($vrowL1['lv001']));
			$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
			switch($vDh)
			{
				case 0:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0   and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 1:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0 and A.lv080<>0 and  (A.lv039<>0 or A.lv043<>0)   and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 2:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0 and   (A.lv039=0 and A.lv043=0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 3:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 4:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and (A.lv039<>0 or A.lv043<>0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
			}
			$vorder=$curRow;
			$bResult = db_query($sqlS);
			$strDepart=$vrowL1['lv001'];

			$strTrH='';
			$vOrder=0;
			$vlv006_1=0;
			$vlv080_1=0;
			$vlv035_1=0;
			$strFullTbl=str_replace("@#13",'@#13<!--_'.$vTang.'-->',$strFullTbl);	
			while ($vrow = db_fetch_array ($bResult)){
				$strFullTbl=str_replace('@#13<!--_'.$vTang.'-->','',$strFullTbl);	
				$vrow['lv058']=$vrow['DeptID'];
				if($this->optkpcd==1)
				{
					if($vrow['lv080']!=0)
					{
					$vlv006_0=$vlv006_0+$vrow['lv006'];
					$vlv006_1=$vlv006_1+$vrow['lv006'];
					$vTang++;
					//$vlv006_0=$vlv006_0+$vrow['lv006'];
					$vlv080_0=$vlv080_0+$vrow['lv080'];
					$vlv035_0=$vlv035_0+$vrow['lv035'];
					
					//$vlv006_1=$vlv006_1+$vrow['lv006'];
					$vlv080_1=$vlv080_1+$vrow['lv080'];
					$vlv035_1=$vlv035_1+$vrow['lv035'];
					}
				}
				else
				{
					$vlv006_0=$vlv006_0+$vrow['lv006'];
					$vlv006_1=$vlv006_1+$vrow['lv006'];
					$vTang++;
					//$vlv006_0=$vlv006_0+$vrow['lv006'];
					$vlv080_0=$vlv080_0+$vrow['lv080'];
					$vlv035_0=$vlv035_0+$vrow['lv035'];
					
					//$vlv006_1=$vlv006_1+$vrow['lv006'];
					$vlv080_1=$vlv080_1+$vrow['lv080'];
					$vlv035_1=$vlv035_1+$vrow['lv035'];
				}
				
				$vOrder++;
				if($vOrder==1)
				{
					switch($mau)
					{
						case 1:
							$vLineOne=$vTRMAU1;
							break;
						default:
							$vLineOne=$vTR;
							break;
					}
				}
				else
					$vLineOne=$vTR;
				$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
				$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
				$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
				$vLineOne=str_replace("@#04",$this->FormatView($vrow['DateW'],2),$vLineOne);
				$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv006'],10),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv080'],10),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv035'],20),$vLineOne);
				$vLineOne=str_replace("@#09",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
			}
			if($strTrHSave!='')
			{
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vlv006_1,10),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vlv080_1,10),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vlv035_1,20),$vLineOne);
				$vLineOne=str_replace("@#09",'',$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
				if($mau!=3)
				{
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",$vTang,$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv006_0,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv080_0,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv035_0,20),$vLineOne);
					$vLineOne=str_replace("@#09",'',$vLineOne);
					$strTrHSaveSum=$vLineOne;
				}
				$strTable=str_replace("@#02",'',$lvTable);
				$strTable=str_replace("@#03",$this->getvaluelink('lv058',$vrowL1['lv001']),$strTable);
				$strFullTbl=$strFullTbl.str_replace("@#01",$strTrHSave,$strTable);
			}
		}
		
		$strFullTbl=str_replace("@#13",$strTrHSaveSum,$strFullTbl);
		return $strFullTbl;
	}
	////////PIT thang//////
	function LV_TrichPIT($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="140" />
			<col width="60" />
			<col width="40" />
			<col width="160" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td width="18" rowspan="2"><center><strong>Stt</strong></center></td>
				<td colspan="2" rowspan="2"><center><strong>Họ và tên cá nhân</strong></center></td>
				<td rowspan="2"><center><strong>MST CN</strong></center></td>
				<td colspan="4"><center><strong> Thu nhập chịu thuế</strong></center></td>
				<td rowspan="2"><center><strong>Thuế phải nộp</strong></center></td>
				<td rowspan="2"><center><strong>Ghi chú</strong></center></td>
			</tr>
			<tr>
				<td ><center><strong>Tổng số - Tổng cộng</strong></center></td>
				<td ><center><strong>Lương</strong></center></td>
				<td ><center><strong>Thưởng</strong></center></td>
				<td ><center><strong>Khác</strong></center></td>		
				
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>1</strong></center></td>
				<td  width="18" ><center><strong>2</strong></center></td>
				<td ><center><strong></strong></center></td>
				<td ><center><strong>3</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td  ><center><strong>5</strong></center></td>
				<td ><center><strong>6</strong></center></td>
				<td ><center><strong>7</strong></center></td>
				<td ><center><strong>8</strong></center></td>
				<td ><center><strong>9</strong></center></td>

			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTRLine='
			<tr height="17">
				<td colspan="10" style="padding:5px"><strong>@!01</strong></td>
			</tr>
			';
			
	$vTRMAU1='
			<tr height="17">
				<td colspan="10">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=center>@#10</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>	
			<td align=center>@#10</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17" colspan="3" style="padding:5px;"><strong>@#01<strong></td>
			
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=right><strong>@#09</strong></td>
			<td align=center><strong>@#10</strong></td>
		</tr>';
		
		if($mau==2)
			$strSort=' order by B.lv022 DESC';
		else
			$strSort=' order by A.lv058 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv010 CMND,B.lv013 MST,B.lv022 QTich  FROM tc_lv0021 A inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv010 CMND,B.lv013 MST,B.lv022 QTich  FROM tc_lv0021 A inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045<>0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv010 CMND,B.lv013 MST,B.lv022 QTich  FROM tc_lv0021 A inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045=0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		/*
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
		}*/
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv006_0=0;
		$vlv150_0=0;
		$strTrH='';
		$vOrder=0;
		$vTang=0;
		$strQtich='111111111111';
		while ($vrow = db_fetch_array ($bResult)){
			$vTang++;
		
			if($strDepart!=$vrow['lv058'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv150_1,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv043_1,10),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv045_1,10),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv145_1,10),$vLineOne);
					$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
					
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv050_1=0;
					$vlv150_1=0;
					$vlv043_1=0;
					$vlv045_1=0;
					$vlv145_1=0;
					$vlv065_1=0;
					$vlv067_1=0;
					}
					$strDepart=$vrow['lv058'];
			}
			if($mau==2 && $strQtich!=$vrow['QTich'])
			{
				$vOrder=0;
				$strQtich=$vrow['QTich'];
				if($strQtich=='VIETNAM')
					$vLineOne=str_replace('@!01','A.  Thu nhập thường xuyên người Việt Nam',$vTRLine);
				else
					$vLineOne=str_replace('@!01','B.  Thu nhập thường xuyên người Nước ngoài',$vTRLine);
				$strTrH=$strTrH.$vLineOne;
				$vlv050_1=0;
					$vlv150_1=0;
					$vlv043_1=0;
					$vlv045_1=0;
					$vlv145_1=0;
					$vlv065_1=0;
					$vlv067_1=0;
			}
			if($vrow['lv150']>0) $vrow['lv050']=0;
			$vlv050_0=$vlv050_0+$vrow['lv050'];
			$vlv150_0=$vlv150_0+$vrow['lv150'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv045_0=$vlv045_0+$vrow['lv045'];
			$vlv145_0=$vlv145_0+$vrow['lv145'];
			$vlv065_0=$vlv065_0+$vrow['lv065'];
			$vlv067_0=$vlv067_0+$vrow['lv067'];
			
			$vlv050_1=$vlv050_1+$vrow['lv050'];
			$vlv150_1=$vlv150_1+$vrow['lv150'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv045_1=$vlv045_1+$vrow['lv045'];
			$vlv145_1=$vlv145_1+$vrow['lv145'];
			$vlv065_1=$vlv065_1+$vrow['lv065'];
			$vlv067_1=$vlv067_1+$vrow['lv067'];
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['CMND'],$vLineOne);
			$vLineOne=str_replace("@#04",$vrow['MST'],$vLineOne);
			$vLineOne=str_replace("@#05",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView(0,20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView(0,20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv045'],20),$vLineOne);
			$vLineOne=str_replace("@#10",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'Cộng',$vLineOne);
		$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'',$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vlv050_1,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView(0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView(0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv045_1,20),$vLineOne);
	
		$vLineOne=str_replace("@#10",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		//if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'Tổng cộng - Tổng cộng',$vLineOne);
		$vLineOne=str_replace("@#02",'',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'',$vLineOne);
		$vLineOne=str_replace("@#05",$this->FormatView($vlv050_0,10),$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_0,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView(0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView(0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv045_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv145_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_TrichPITNNN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="18" />
			<col width="120" />
			<col width="40" />
			<col width="160" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" width="18"><center><strong>No<br/>(Stt)</strong></center></td>
				<td  ><center><strong>CODE<br/>(Mã NV)</strong></center></td>
				<td ><center><strong>Full Name<br/>(Họ tên)</strong></center></td>
				<td ><center><strong>Start date<br/>(Ngày vào làm)</strong></center></td>
				<td  ><center><strong> Position<br/>(Chức danh)</strong></center></td>
				<td ><center><strong> Tổng lương </strong></center></td>
				<td ><center><strong>Tổng lương Thuế 10%</strong></center></td>
				<td ><center><strong>BH '.$this->FormatView(round($motc_lv0013->lv012+$motc_lv0013->lv013+$motc_lv0013->lv014,1),10).'%</strong></center></td>
				<td ><center><strong>PIT</strong></center></td>
				<td ><center><strong>PIT 10%</strong></center></td>
				<td ><center><strong>Số người phụ thuộc</strong></center></td>
				<td ><center><strong>Bản thân</strong></center></td>
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>1</strong></center></td>
				<td  width="18" ><center><strong>2</strong></center></td>
				<td ><center><strong>3</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td  ><center><strong>5</strong></center></td>
				<td ><center><strong>6</strong></center></td>
				<td ><center><strong>7</strong></center></td>
				<td ><center><strong>8</strong></center></td>
				<td ><center><strong>9</strong></center></td>
				<td ><center><strong>10</strong></center></td>
				<td ><center><strong>11</strong></center></td>
				<td ><center><strong>12</strong></center></td>

			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
			<td align=center>@#10</td>
			<td align=center>@#11</td>
			<td align=center>@#12</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
			<td align=center>@#10</td>
			<td align=center>@#11</td>
			<td align=center>@#12</td>
			
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=center><strong>@#09</strong></td>
			<td align=center><strong>@#10</strong></td>
			<td align=center><strong>@#11</strong></td>
			<td align=center><strong>@#12</strong></td>
		</tr>';
		$strSort=' order by A.lv058 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045<>0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045=0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		/*
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount  FROM tc_lv0021 A left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOther()." $strSort LIMIT $curRow, $maxRows";
				break;
		}*/
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv006_0=0;
		$vlv150_0=0;
		$strTrH='';
		$vOrder=0;
		$vTang=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vTang++;
		
			if($strDepart!=$vrow['lv058'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv150_1,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv043_1,10),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv045_1,10),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv145_1,10),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv065_1,10),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vlv067_1,10),$vLineOne);
					$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
					
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv050_1=0;
					$vlv150_1=0;
					$vlv043_1=0;
					$vlv045_1=0;
					$vlv145_1=0;
					$vlv065_1=0;
					$vlv067_1=0;
					}
					$strDepart=$vrow['lv058'];
			}
			if($vrow['lv150']>0) $vrow['lv050']=0;
			$vlv050_0=$vlv050_0+$vrow['lv050'];
			$vlv150_0=$vlv150_0+$vrow['lv150'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv045_0=$vlv045_0+$vrow['lv045'];
			$vlv145_0=$vlv145_0+$vrow['lv145'];
			$vlv065_0=$vlv065_0+$vrow['lv065'];
			$vlv067_0=$vlv067_0+$vrow['lv067'];
			
			$vlv050_1=$vlv050_1+$vrow['lv050'];
			$vlv150_1=$vlv150_1+$vrow['lv150'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv045_1=$vlv045_1+$vrow['lv045'];
			$vlv145_1=$vlv145_1+$vrow['lv145'];
			$vlv065_1=$vlv065_1+$vrow['lv065'];
			$vlv067_1=$vlv067_1+$vrow['lv067'];
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['DateW'],2),$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv050'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv150'],10),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv043'],10),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv045'],10),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv145'],10),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv065'],10),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv067'],10),$vLineOne);
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv150_1,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv043_1,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv045_1,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv145_1,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv065_1,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv067_1,10),$vLineOne);
		$vLineOne=str_replace("@#09",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",$vTang,$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv050_0,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv150_0,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv043_0,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv045_0,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv145_0,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv065_0,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv067_0,10),$vLineOne);
		$vLineOne=str_replace("@#09",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_TrichPITLevel1($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="140" />
			<col width="60" />
			<col width="40" />
			<col width="160" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td width="18" rowspan="2"><center><strong>Stt</strong></center></td>
				<td colspan="2" rowspan="2"><center><strong>Họ và tên cá nhân - 姓名</strong></center></td>
				<td rowspan="2"><center><strong>MST CN-稅號</strong></center></td>
				<td colspan="4"><center><strong> Thu nhập chịu thuế - 收入金額</strong></center></td>
				<td ><center><strong>Thuế phải nộp</strong></center></td>
				<td ><center><strong>Ghi chú</strong></center></td>
			</tr>
			<tr>
				<td ><center><strong>Tổng số - Tổng cộng</strong></center></td>
				<td ><center><strong>Lương - 薪資</strong></center></td>
				<td ><center><strong>Thưởng - 獎金</strong></center></td>
				<td ><center><strong>Khác - 其他</strong></center></td>		
				<td ><center><strong>應課稅金</strong></center></td>
				<td ><center><strong>備註</strong></center></td>
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>1</strong></center></td>
				<td  width="18" ><center><strong>2</strong></center></td>
				<td ><center><strong></strong></center></td>
				<td ><center><strong>3</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td  ><center><strong>5</strong></center></td>
				<td ><center><strong>6</strong></center></td>
				<td ><center><strong>7</strong></center></td>
				<td ><center><strong>8</strong></center></td>
				<td ><center><strong>9</strong></center></td>

			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vLineTitle='<tr height="17">
				<td colspan="12">@!01</td>
			</tr>';
	
	$vTRMAU1='
			<tr height="17">
				<td colspan="12">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
			<td align=center>@#10</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
			<td align=center>@#10</td>
			
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=center><strong>@#09</strong></td>
			<td align=center><strong>@#10</strong></td>
		</tr>';
		$strSort='  order by B.lv022 DESC';
		if($this->lv201=='TDL')
			$vsql="select * from hr_lv0002 where lv002='TDL'";
		elseif($this->lv201=='TECH')
			$vsql="select * from hr_lv0002 where lv002='TECH'";
		else
			$vsql="select * from hr_lv0002 where lv002='THAIDUCLAM'";
		$bResultL1 = db_query($vsql);
			$vlv006_0=0;
			$vlv150_0=0;
			
			$vOrder=0;
			$vTang=0;
		while ($vrowL1 = db_fetch_array ($bResultL1))
		{
			$strTrHSave='';
		$vListDep=$this->LV_GetChildDep($vrowL1['lv001']);
		if($vListDep!="") 
			$vListDep=$vListDep.",'".$vrowL1['lv001']."'";
		else
			$vListDep="'".$vrowL1['lv001']."'";
			switch($vDh)
			{
				case 0:
					$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv022 QTich,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1 and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 1:
					$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv022 QTich,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045<>0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 2:
					$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv022 QTich,B.lv010 CMND,B.lv013 MST  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045=0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
			}
			$vorder=$curRow;
			$bResult = db_query($sqlS);
			$strDepart=$vrowL1['lv001'];
			$strTrH='';
			$vOrder=0;
			$vlv050_1=0;
			$vlv150_1=0;
			$vlv043_1=0;
			$vlv045_1=0;
			$vlv145_1=0;
			$vlv065_1=0;
			$vlv067_1=0;
			$strFullTbl=str_replace("@#13",'',$strFullTbl);
			while ($vrow = db_fetch_array ($bResult)){
				$vTang++;
				if($vrow['lv150']>0) $vrow['lv050']=0;
				$vlv050_0=$vlv050_0+$vrow['lv050'];
				$vlv150_0=$vlv150_0+$vrow['lv150'];
				$vlv043_0=$vlv043_0+$vrow['lv043'];
				$vlv045_0=$vlv045_0+$vrow['lv045'];
				$vlv145_0=$vlv145_0+$vrow['lv145'];
				$vlv065_0=$vlv065_0+$vrow['lv065'];
				$vlv067_0=$vlv067_0+$vrow['lv067'];
				
				$vlv050_1=$vlv050_1+$vrow['lv050'];
				$vlv150_1=$vlv150_1+$vrow['lv150'];
				$vlv043_1=$vlv043_1+$vrow['lv043'];
				$vlv045_1=$vlv045_1+$vrow['lv045'];
				$vlv145_1=$vlv145_1+$vrow['lv145'];
				$vlv065_1=$vlv065_1+$vrow['lv065'];
				$vlv067_1=$vlv067_1+$vrow['lv067'];
				$vOrder++;
				if($vOrder==1)
				{
					switch($mau)
					{
						case 1:
							$vLineOne=$vTRMAU1;
							break;
						default:
							$vLineOne=$vTR;
							break;
					}
				}
				else
					$vLineOne=$vTR;
				
				$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
				$vLineOne=str_replace("@#02",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
				$vLineOne=str_replace("@#03",$vrow['CMND'],$vLineOne);
				$vLineOne=str_replace("@#04",$vrow['MST'],$vLineOne);
				$vLineOne=str_replace("@#05",$this->FormatView($vrow['lv050'],20),$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv050'],20),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView(0,20),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView(0,20),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv045'],20),$vLineOne);
				$vLineOne=str_replace("@#10",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
			}
			if($strTrHSave!='')
			{
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vlv150_1,10),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vlv043_1,10),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vlv045_1,10),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vlv145_1,10),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vlv065_1,10),$vLineOne);
				$vLineOne=str_replace("@#12",$this->FormatView($vlv067_1,10),$vLineOne);
				$vLineOne=str_replace("@#09",'',$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
				if($mau!=2)
				{
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",$vTang,$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv050_0,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv150_0,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv043_0,10),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv045_0,10),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv145_0,10),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv065_0,10),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vlv067_0,10),$vLineOne);
					$vLineOne=str_replace("@#09",'',$vLineOne);
					$strTrHSaveSum=$vLineOne;
				}
				
				$strTable=str_replace("@#02",'',$lvTable);
				$strTable=str_replace("@#03",$this->getvaluelink('lv058',$vrowL1['lv001']),$strTable);
				$strFullTbl=$strFullTbl.str_replace("@#01",$strTrHSave,$strTable);
			}
		}
		
		$strFullTbl=str_replace("@#13",$strTrHSaveSum,$strFullTbl);
		
		return $strFullTbl;	
	}
	function LV_TrichPITLevel1NNN($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="18" />
			<col width="18" />
			<col width="120" />
			<col width="40" />
			<col width="160" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td height="55" width="18"><center><strong>序</strong></center></td>
				<td  ><center><strong>CODE<br/>P.Xưởng<br/>廠別</strong></center></td>
				<td ><center><strong>Họ tên<br/>姓名</strong></center></td>
				<td ><center><strong>美金金額</strong></center></td>
				<td  ><center><strong>匯款</strong></center></td>
				<td ><center><strong>金額</strong></center></td>
				<td ><center><strong>醫保</strong></center></td>
				<td ><center><strong>課稅金額</strong></center></td>
				<td ><center><strong>免稅金額</strong></center></td>
				<td ><center><strong>應稅金額</strong></center></td>
				<td ><center><strong>應繳稅額</strong></center></td>
			</tr>
			@#01
			@#02
			@#13
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="9">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=center>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
			<td align=center>@#10</td>
			<td align=center>@#11</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=right>@#04</td>
			<td align=right>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=center>@#09</td>
			<td align=center>@#10</td>
			<td align=center>@#11</td>
			
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td>@#03</td>
			<td align=right><strong>@#04</strong></td>
			<td align=right><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=center><strong>@#09</strong></td>
			<td align=center><strong>@#10</strong></td>
			<td align=center><strong>@#11</strong></td>
		</tr>';
		$strSort=' order by A.lv058 ASC,A.lv002 ASC';
		if($this->lv201=='TDL')
			$vsql="select * from hr_lv0002 where lv002='TDL'";
		elseif($this->lv201=='TECH')
			$vsql="select * from hr_lv0002 where lv002='TECH'";
		else
			$vsql="select * from hr_lv0002 where lv002='THAIDUClAM'";
		$bResultL1 = db_query($vsql);
			$vlv006_0=0;
			$vlv150_0=0;
			
			$vOrder=0;
			$vTang=0;
		while ($vrowL1 = db_fetch_array ($bResultL1))
		{
			$strTrHSave='';
		$vListDep=$this->LV_GetChildDep($vrowL1['lv001']);
		if($vListDep!="") 
			$vListDep=$vListDep.",'".$vrowL1['lv001']."'";
		else
			$vListDep="'".$vrowL1['lv001']."'";
			switch($vDh)
			{
				case 0:
					$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv029 PhanXuong  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1 and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 1:
					$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv029 PhanXuong  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045<>0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 2:
					$sqlS = "SELECT A.*,IF(A.lv057=2,A.lv050,0) lv150,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,B.lv029 PhanXuong  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 inner join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv045=0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
			}
			$vorder=$curRow;
			$bResult = db_query($sqlS);
			$strDepart=$vrowL1['lv001'];
			$strTrH='';
			$vOrder=0;
			$vlv050_1=0;
			$vlv150_1=0;
			$vlv043_1=0;
			$vlv045_1=0;
			$vlv145_1=0;
			$vlv065_1=0;
			$vlv067_1=0;
			$strFullTbl=str_replace("@#13",'',$strFullTbl);
			while ($vrow = db_fetch_array ($bResult)){
				$vTang++;
				if($vrow['lv150']>0) $vrow['lv050']=0;
				$vlv050_0=$vlv050_0+$vrow['lv050'];
				$vlv150_0=$vlv150_0+$vrow['lv150'];
				$vlv043_0=$vlv043_0+$vrow['lv043'];
				$vlv045_0=$vlv045_0+$vrow['lv045'];
				$vlv145_0=$vlv145_0+$vrow['lv145'];
				$vlv065_0=$vlv065_0+$vrow['lv065'];
				$vlv067_0=$vlv067_0+$vrow['lv067'];
				
				$vlv050_1=$vlv050_1+$vrow['lv050'];
				$vlv150_1=$vlv150_1+$vrow['lv150'];
				$vlv043_1=$vlv043_1+$vrow['lv043'];
				$vlv045_1=$vlv045_1+$vrow['lv045'];
				$vlv145_1=$vlv145_1+$vrow['lv145'];
				$vlv065_1=$vlv065_1+$vrow['lv065'];
				$vlv067_1=$vlv067_1+$vrow['lv067'];
				$vOrder++;
				if($vOrder==1)
				{
					switch($mau)
					{
						case 1:
							$vLineOne=$vTRMAU1;
							break;
						default:
							$vLineOne=$vTR;
							break;
					}
				}
				else
					$vLineOne=$vTR;
				$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
				$vLineOne=str_replace("@#02",$vrow['PhanXuong'],$vLineOne);
				$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
				$vLineOne=str_replace("@#04",$this->FormatView(0,20),$vLineOne);
				$vLineOne=str_replace("@#05",$this->FormatView(0,20),$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv050'],20),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView(0,20),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv050'],20),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv066'],20),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv050']-$vrow['lv066'],20),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv045'],10),$vLineOne);
				$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
			}
			if($strTrHSave!='')
			{
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vlv050_1,10),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView(0,10),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vlv050_1,10),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView(0,10),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vlv050_1-$vlv066_1,10),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vlv045_1,10),$vLineOne);
				$vLineOne=str_replace("@#09",'',$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
				if($mau!=2)
				{
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",$vTang,$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv050_0,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView(0,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv050_0,10),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv066_0,10),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv050_0-$vlv066_0,10),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv045_0,10),$vLineOne);
					$vLineOne=str_replace("@#09",'',$vLineOne);
					$strTrHSaveSum=$vLineOne;
				}
				
				$strTable=str_replace("@#02",'',$lvTable);
				$strTable=str_replace("@#03",$this->getvaluelink('lv058',$vrowL1['lv001']),$strTable);
				$strFullTbl=$strFullTbl.str_replace("@#01",$strTrHSave,$strTable);
			}
		}
		
		$strFullTbl=str_replace("@#13",$strTrHSaveSum,$strFullTbl);
		
		return $strFullTbl;	
	}
	function LV_DanhSachThamGiaBHLevel1($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="1100">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="1100">
			<colgroup>
			<col width="18" />
			<col width="50" />
			<col width="150" />
			<col width="40" />
			<col width="150" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			</colgroup>
		<tbody>
			<tr height="23" >
				<td height="55" class="print_hdtb"><center><strong>No<br/>(Stt)
</strong></center></td>
				<td  class="print_hdtb"><center><strong>CODE<br/>(Mã NV)
</strong></center></td>
				<td class="print_hdtb"><center><strong>Full Name<br/>(Họ tên)
</strong></center></td>
				<td class="print_hdtb"><center><strong>Start date<br/>(Ngày vào làm)
</strong></center></td>
				<td  class="print_hdtb"><center><strong> Position<br/>(Chức danh)
</strong></center></td>
				<td class="print_hdtb"><center><strong> Basic Salary<br/>(Lương Căn Bản)
 </strong></center></td>
				<td class="print_hdtb"><center>Social insurance
'.$this->FormatView($motc_lv0013->lv017,10).'%<br/></center></td>
				<td class="print_hdtb"><center>Unemployment
Insurance '.$this->FormatView($motc_lv0013->lv019,10).'%<br/></center></td>
				<td class="print_hdtb"><center>Health Insurance '.$this->FormatView($motc_lv0013->lv018,10).'%<br/></center></td>
				<td class="print_hdtb"><center>Total Paid
'.$this->FormatView(round($motc_lv0013->lv017+$motc_lv0013->lv018+$motc_lv0013->lv019,1),10).'%
<br/>(Phí BH KS trả)</center></td>
				<td class="print_hdtb"><center>Social Insurance
'.$this->FormatView($motc_lv0013->lv012,10).'%<br/>(employee)
</center></td>
				<td class="print_hdtb"><center>Unemployment
Insurance
'.$this->FormatView($motc_lv0013->lv014,10).'%<br/>( employee)</center></td>
				<td class="print_hdtb"><center>Health Insurance
'.$this->FormatView($motc_lv0013->lv013,10).'%
<br/>(employee)
</center></td>
				<td class="print_hdtb"><center>Total Employee 
'.$this->FormatView(round($motc_lv0013->lv012+$motc_lv0013->lv013+$motc_lv0013->lv014,1),10).'%
<br/>( phí BH người lđ trả)</center></td>
				<td class="print_hdtb"><center><strong> Trích Đóng</strong></center></td>
				<td class="print_hdtb"><center><strong> Ghi chú<br/>(Remark)
 </strong></center></td>
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>A
</strong></center></td>
				<td  width="18" ><center><strong>B
</strong></center></td>
				<td ><center><strong>C
</strong></center></td>
				<td ><center><strong>D
</strong></center></td>
				<td  ><center><strong>E
</strong></center></td>
				<td ><center><strong>1
 </strong></center></td>
				<td ><center><strong>2
</strong></center></td>
				<td ><center><strong>3</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td ><center><strong>5</strong></center></td>
				<td ><center><strong>6</strong></center></td>
				<td ><center><strong>7</strong></center></td>
				<td ><center><strong>8</strong></center></td>
				<td ><center><strong>9</strong></center></td>
				<td ><center><strong>10</strong></center></td>
				<td ><center><strong>11</strong></center></td>
			</tr>
			@#01
			@#02
			@#13
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
	<tr height="17">
				<td colspan="16">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=left>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#09</td>
			<td align=right>@#08</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#13</td>
			<td align=right>@#12</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=left>@#16</td>

		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=left>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			
			<td align=right>@#09</td>
			<td align=right>@#08</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			
			<td align=right>@#13</td>
			<td align=right>@#12</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=left>@#16</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td >@#03</td>
			<td align=center><strong>@#04</strong></td>
			<td align=left><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			
			<td align=right><strong>@#09</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=right><strong>@#10</strong></td>
			<td align=right><strong>@#11</strong></td>
			
			<td align=right><strong>@#13</strong></td>
			<td align=right><strong>@#12</strong></td>
			<td align=right><strong>@#14</strong></td>
			<td align=right><strong>@#15</strong></td>
			<td align=center><strong>@#16</strong></td>

		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		if($this->lv201=='TDL')
			$vsql="select * from hr_lv0002 where lv002='TDL'";
		elseif($this->lv201=='TECH')
			$vsql="select * from hr_lv0002 where lv002='TECH'";
		else
			$vsql="select * from hr_lv0002 where lv002='THAIDUClAM'";
		$bResultL1 = db_query($vsql);
		$vlv006_0=0;
		$vlv150_0=0;
		
		$vOrder=0;
		$vTang=0;
		$vTang=0;
		$vlv006_0=0;
		$vlv080_0=0;
		$vlv039_0=0;
		$vlv043_0=0;
		while ($vrowL1 = db_fetch_array ($bResultL1))
		{
			$vListDep='';
			$strTrHSave='';
			$vListDep=trim($this->LV_GetChildDep($vrowL1['lv001']));
			$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
			switch($vDh)
			{
				case 0:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0   and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 1:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0 and A.lv080<>0 and  (A.lv039<>0 or A.lv043<>0)   and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 2:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0 and   (A.lv039=0 and A.lv043=0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 3:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and A.lv006>0  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
				case 4:
					$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001 WHERE 1=1 and (A.lv039<>0 or A.lv043<>0)  and  AA.lv004 in ($vListDep) ".$this->GetConditionOtherlevel1()." $strSort LIMIT $curRow, $maxRows";
					break;
			}
			$vorder=$curRow;
			$bResult = db_query($sqlS);
			$strDepart=$vrowL1['lv001'];

			$strTrH='';
			$vOrder=0;
			$vlv006_1=0;
			$vlv080_1=0;
			$vlv036_1=0;
			$vlv037_1=0;
			$vlv038_1=0;
			$vlv039_1=0;
			$vlv040_1=0;
			$vlv041_1=0;
			$vlv042_1=0;
			$vlv043_1=0;
			$strFullTbl=str_replace("@#13",'@#13<!--_'.$vTang.'-->',$strFullTbl);
			while ($vrow = db_fetch_array ($bResult)){
				$strFullTbl=str_replace('@#13<!--_'.$vTang.'-->','',$strFullTbl);	
				//$vTang++;
				$vrow['lv058']=$vrow['DeptID'];
				if($this->optkpcd==1)
				{
					if($vrow['lv080']!=0)
					{
						$vlv006_0=$vlv006_0+$vrow['lv006'];
						$vlv006_1=$vlv006_1+$vrow['lv006'];
						$vTang++;
						if($vrow['lv039']!=0)
						{
						
						$vlv036_0=$vlv036_0+$vrow['lv036'];
						$vlv037_0=$vlv037_0+$vrow['lv037'];
						$vlv038_0=$vlv038_0+$vrow['lv038'];
						$vlv039_0=$vlv039_0+$vrow['lv039'];
						
						$vlv036_1=$vlv036_1+$vrow['lv036'];
						$vlv037_1=$vlv037_1+$vrow['lv037'];
						$vlv038_1=$vlv038_1+$vrow['lv038'];
						$vlv039_1=$vlv039_1+$vrow['lv039'];			
						}
						if($vrow['lv043']!=0 && $vrow['lv039']!=0) $vOrderCur++;
						if($vrow['lv043']!=0)
						{
						
						$vlv040_0=$vlv040_0+$vrow['lv040'];
						$vlv041_0=$vlv041_0+$vrow['lv041'];
						$vlv042_0=$vlv042_0+$vrow['lv042'];
						$vlv043_0=$vlv043_0+$vrow['lv043'];
						
						
						$vlv040_1=$vlv040_1+$vrow['lv040'];
						$vlv041_1=$vlv041_1+$vrow['lv041'];
						$vlv042_1=$vlv042_1+$vrow['lv042'];
						$vlv043_1=$vlv043_1+$vrow['lv043'];
						}
					}
				}
				else
				{
					$vlv006_0=$vlv006_0+$vrow['lv006'];
					$vlv006_1=$vlv006_1+$vrow['lv006'];
					$vTang++;
					if($vrow['lv039']!=0)
					{
					
					$vlv036_0=$vlv036_0+$vrow['lv036'];
					$vlv037_0=$vlv037_0+$vrow['lv037'];
					$vlv038_0=$vlv038_0+$vrow['lv038'];
					$vlv039_0=$vlv039_0+$vrow['lv039'];
					
					$vlv036_1=$vlv036_1+$vrow['lv036'];
					$vlv037_1=$vlv037_1+$vrow['lv037'];
					$vlv038_1=$vlv038_1+$vrow['lv038'];
					$vlv039_1=$vlv039_1+$vrow['lv039'];			
					}
					if($vrow['lv043']!=0 && $vrow['lv039']!=0) $vOrderCur++;
					if($vrow['lv043']!=0)
					{
					
					$vlv040_0=$vlv040_0+$vrow['lv040'];
					$vlv041_0=$vlv041_0+$vrow['lv041'];
					$vlv042_0=$vlv042_0+$vrow['lv042'];
					$vlv043_0=$vlv043_0+$vrow['lv043'];
					
					
					$vlv040_1=$vlv040_1+$vrow['lv040'];
					$vlv041_1=$vlv041_1+$vrow['lv041'];
					$vlv042_1=$vlv042_1+$vrow['lv042'];
					$vlv043_1=$vlv043_1+$vrow['lv043'];
					}
				}
				
				$vOrder++;
				if($vOrder==1)
				{
					switch($mau)
					{
						case 1:
							$vLineOne=$vTRMAU1;
							break;
						default:
							$vLineOne=$vTR;
							break;
					}
				}
				else
					$vLineOne=$vTR;
				$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
				$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
				$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
				$vLineOne=str_replace("@#04",$this->FormatView($vrow['DateW'],2),$vLineOne);
				$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv006'],10),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv036'],10),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv037'],10),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv038'],10),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv039'],10),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv040'],10),$vLineOne);
				$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv041'],10),$vLineOne);
				$vLineOne=str_replace("@#13",$this->FormatView($vrow['lv042'],10),$vLineOne);
				$vLineOne=str_replace("@#14",$this->FormatView($vrow['lv043'],10),$vLineOne);
				$vLineOne=str_replace("@#15",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#16",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
			}
			if($strTrHSave!='')
			{
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#03",'',$vLineOne);
				$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
				$vLineOne=str_replace("@#05",'',$vLineOne);
				$vLineOne=str_replace("@#06",$this->FormatView($vlv006_1,10),$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vlv036_1,10),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vlv037_1,10),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vlv038_1,10),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vlv039_1,10),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vlv040_1,10),$vLineOne);
				$vLineOne=str_replace("@#12",$this->FormatView($vlv041_1,10),$vLineOne);
				$vLineOne=str_replace("@#13",$this->FormatView($vlv042_1,10),$vLineOne);
				$vLineOne=str_replace("@#14",$this->FormatView($vlv043_1,10),$vLineOne);
				$vLineOne=str_replace("@#15",$this->FormatView($vlv039_1+$vlv043_1,10),$vLineOne);
				$vLineOne=str_replace("@#16",'',$vLineOne);
				$strTrHSave=$strTrHSave.$vLineOne;
				if($mau!=3)
				{
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",$vTang,$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv006_0,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv036_0,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv037_0,10),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv038_0,10),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv039_0,10),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv040_0,10),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vlv041_0,10),$vLineOne);
					$vLineOne=str_replace("@#13",$this->FormatView($vlv042_0,10),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vlv043_0,10),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($vlv039_0+$vlv043_0,10),$vLineOne);
					$vLineOne=str_replace("@#16",'',$vLineOne);
					$strTrHSaveSum=$vLineOne;
				}
				$strTable=str_replace("@#02",'',$lvTable);
				$strTable=str_replace("@#03",$this->getvaluelink('lv058',$vrowL1['lv001']),$strTable);
				$strFullTbl=$strFullTbl.str_replace("@#01",$strTrHSave,$strTable);
			}
		}
		
		$strFullTbl=str_replace("@#13",$strTrHSaveSum,$strFullTbl);
		return $strFullTbl;
	}
	function LV_DanhSachThamGiaBH($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="1100">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="1100">
			<colgroup>
			<col width="18" />
			<col width="50" />
			<col width="150" />
			<col width="40" />
			<col width="150" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			<col width="60" />
			</colgroup>
		<tbody>
			<tr height="23" >
				<td height="55" class="print_hdtb"><center><strong>No<br/>(Stt)
</strong></center></td>
				<td  class="print_hdtb"><center><strong>CODE<br/>(Mã NV)
</strong></center></td>
				<td class="print_hdtb"><center><strong>Full Name<br/>(Họ tên)
</strong></center></td>
				<td class="print_hdtb"><center><strong>Start date<br/>(Ngày vào làm)
</strong></center></td>
				<td  class="print_hdtb"><center><strong> Position<br/>(Chức danh)
</strong></center></td>
				<td class="print_hdtb"><center><strong> Basic Salary<br/>(Lương Căn Bản)
 </strong></center></td>
				<td class="print_hdtb"><center>Social insurance
'.$this->FormatView($motc_lv0013->lv017,10).'%<br/></center></td>
				<td class="print_hdtb"><center>Unemployment
Insurance '.$this->FormatView($motc_lv0013->lv019,10).'%<br/></center></td>
				<td class="print_hdtb"><center>Health Insurance '.$this->FormatView($motc_lv0013->lv018,10).'%<br/></center></td>
				<td class="print_hdtb"><center>Total Paid
'.$this->FormatView(round($motc_lv0013->lv017+$motc_lv0013->lv018+$motc_lv0013->lv019,1),10).'%
<br/>(Phí BH KS trả)</center></td>
				<td class="print_hdtb"><center>Social Insurance
'.$this->FormatView($motc_lv0013->lv012,10).'%<br/>(employee)
</center></td>
				<td class="print_hdtb"><center>Unemployment
Insurance
'.$this->FormatView($motc_lv0013->lv014,10).'%<br/>( employee)</center></td>
				<td class="print_hdtb"><center>Health Insurance
'.$this->FormatView($motc_lv0013->lv013,10).'%
<br/>(employee)
</center></td>
				<td class="print_hdtb"><center>Total Employee 
'.$this->FormatView(round($motc_lv0013->lv012+$motc_lv0013->lv013+$motc_lv0013->lv014,1),10).'%
<br/>( phí BH người lđ trả)</center></td>
				<td class="print_hdtb"><center><strong> Trích Đóng</strong></center></td>
				<td class="print_hdtb"><center><strong> Ghi chú<br/>(Remark)
 </strong></center></td>
			</tr>
			<tr height="23">
				<td height="55" width="18"><center><strong>A
</strong></center></td>
				<td  width="18" ><center><strong>B
</strong></center></td>
				<td ><center><strong>C
</strong></center></td>
				<td ><center><strong>D
</strong></center></td>
				<td  ><center><strong>E
</strong></center></td>
				<td ><center><strong>1
 </strong></center></td>
				<td ><center><strong>2
</strong></center></td>
				<td ><center><strong>3</strong></center></td>
				<td ><center><strong>4</strong></center></td>
				<td ><center><strong>5</strong></center></td>
				<td ><center><strong>6</strong></center></td>
				<td ><center><strong>7</strong></center></td>
				<td ><center><strong>8</strong></center></td>
				<td ><center><strong>9</strong></center></td>
				<td ><center><strong>10</strong></center></td>
				<td ><center><strong>11</strong></center></td>
			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="16">@!02</td>
			</tr>
			<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=left>@#05</td>
			<td align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			<td align=right>@#09</td>
			<td align=right>@#08</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#13</td>
			<td align=right>@#12</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=left>@#16</td>

		</tr>';
	$vTR='<tr height="17">
			<td height="17"  align=center>@#01</td>
			<td  align=center>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=center>@#04</td>
			<td align=left>@#05</td>
			<td align=right>'.(($sExport == "excel")?'<Data ss:Type="String">="@#06"':'@#06').'</td>
			<td align=right>@#07</td>
			
			<td align=right>@#09</td>
			<td align=right>@#08</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			
			<td align=right>@#13</td>
			<td align=right>@#12</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=left>@#16</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td align=center><strong>@#02</strong></td>
			<td >@#03</td>
			<td align=center><strong>@#04</strong></td>
			<td align=left><strong>@#05</strong></td>
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			
			<td align=right><strong>@#09</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=right><strong>@#10</strong></td>
			<td align=right><strong>@#11</strong></td>
			
			<td align=right><strong>@#13</strong></td>
			<td align=right><strong>@#12</strong></td>
			<td align=right><strong>@#14</strong></td>
			<td align=right><strong>@#15</strong></td>
			<td align=center><strong>@#16</strong></td>

		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1 and A.lv006>0  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE ((A.lv036<>0 and A.lv037<>0 and A.lv038<>0) or (A.lv040<>0 and A.lv041<>0 and A.lv042<>0)) and A.lv006>0 ".$this->GetConditionOtherCal()."  $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0) and A.lv006>0 ".$this->GetConditionOtherCal()."  $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE  A.lv006>0 ".$this->GetConditionOtherCal()."  $strSort LIMIT $curRow, $maxRows";
				break;
			case 4:
				$sqlS = "SELECT A.*,B.lv030 DateW,B.lv030 lv503,B.lv005 Position,B.lv014 BankAcount,AA.lv004 DeptID FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE  (A.lv039<>0 or A.lv043<>0) ".$this->GetConditionOtherCal()."  $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';

		$vlv006_0=0;
		$vlv080_0=0;
		$strTrH='';
		$vOrder=0;
		$vTang=0;
		while ($vrow = db_fetch_array ($bResult)){
			$vTang++;
			$vrow['lv058']=$vrow['DeptID'];
			if($strDepart!=$vrow['lv058'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
					$vLineOne=str_replace("@#05",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv006_1,10),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv036_1,10),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv037_1,10),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv038_1,10),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv039_1,10),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv040_1,10),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vlv041_1,10),$vLineOne);
					$vLineOne=str_replace("@#13",$this->FormatView($vlv042_1,10),$vLineOne);
					$vLineOne=str_replace("@#14",$this->FormatView($vlv043_1,10),$vLineOne);
					$vLineOne=str_replace("@#15",$this->FormatView($vlv039_1+$vlv043_1,10),$vLineOne);
					$vLineOne=str_replace("@#16",'',$vLineOne);
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv006_1=0;
					$vlv080_1=0;
					$vlv036_1=0;
					$vlv037_1=0;
					$vlv038_1=0;
					$vlv039_1=0;
					$vlv040_1=0;
					$vlv041_1=0;
					$vlv042_1=0;
					$vlv043_1=0;
					}
					$strDepart=$vrow['lv058'];
			}
			if($this->optkpcd==1)
			{
				if($vrow['lv080']!=0)
				{
				$vlv006_0=$vlv006_0+$vrow['lv006'];
				$vlv006_1=$vlv006_1+$vrow['lv006'];
				$vTang++;
				if($vrow['lv039']!=0)
				{
				$vlv036_0=$vlv036_0+$vrow['lv036'];
				$vlv037_0=$vlv037_0+$vrow['lv037'];
				$vlv038_0=$vlv038_0+$vrow['lv038'];
				$vlv039_0=$vlv039_0+$vrow['lv039'];
				
				
				$vlv036_1=$vlv036_1+$vrow['lv036'];
				$vlv037_1=$vlv037_1+$vrow['lv037'];
				$vlv038_1=$vlv038_1+$vrow['lv038'];
				$vlv039_1=$vlv039_1+$vrow['lv039'];			
				}
				if($vrow['lv043']!=0 && $vrow['lv039']!=0) $vOrderCur++;
				if($vrow['lv043']!=0)
				{
				
				$vlv040_0=$vlv040_0+$vrow['lv040'];
				$vlv041_0=$vlv041_0+$vrow['lv041'];
				$vlv042_0=$vlv042_0+$vrow['lv042'];
				$vlv043_0=$vlv043_0+$vrow['lv043'];
				
				
				$vlv040_1=$vlv040_1+$vrow['lv040'];
				$vlv041_1=$vlv041_1+$vrow['lv041'];
				$vlv042_1=$vlv042_1+$vrow['lv042'];
				$vlv043_1=$vlv043_1+$vrow['lv043'];
				}
				}
			}
			else
			{
				$vlv006_0=$vlv006_0+$vrow['lv006'];
				$vlv006_1=$vlv006_1+$vrow['lv006'];
				$vTang++;
								{
				$vlv036_0=$vlv036_0+$vrow['lv036'];
				$vlv037_0=$vlv037_0+$vrow['lv037'];
				$vlv038_0=$vlv038_0+$vrow['lv038'];
				$vlv039_0=$vlv039_0+$vrow['lv039'];
				
				
				$vlv036_1=$vlv036_1+$vrow['lv036'];
				$vlv037_1=$vlv037_1+$vrow['lv037'];
				$vlv038_1=$vlv038_1+$vrow['lv038'];
				$vlv039_1=$vlv039_1+$vrow['lv039'];			
				}
				if($vrow['lv043']!=0 && $vrow['lv039']!=0) $vOrderCur++;
				if($vrow['lv043']!=0)
				{
				
				$vlv040_0=$vlv040_0+$vrow['lv040'];
				$vlv041_0=$vlv041_0+$vrow['lv041'];
				$vlv042_0=$vlv042_0+$vrow['lv042'];
				$vlv043_0=$vlv043_0+$vrow['lv043'];
				
				
				$vlv040_1=$vlv040_1+$vrow['lv040'];
				$vlv041_1=$vlv041_1+$vrow['lv041'];
				$vlv042_1=$vlv042_1+$vrow['lv042'];
				$vlv043_1=$vlv043_1+$vrow['lv043'];
				}

			}
			
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$vrow['lv002']),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['DateW'],2),$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv006'],10),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv036'],10),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv037'],10),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv038'],10),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv039'],10),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv040'],10),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv041'],10),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vrow['lv042'],10),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['lv043'],10),$vLineOne);
			$vLineOne=str_replace("@#15",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@#16",'&nbsp;',$vLineOne);
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",$this->FormatView($vOrderCur,10),$vLineOne);
		$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv006_1,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv036_1,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv037_1,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv038_1,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv039_1,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv040_1,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv041_1,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv042_1,10),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv043_1,10),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv039_1+$vlv043_1,10),$vLineOne);
		$vLineOne=str_replace("@#16",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		if($mau!=2)
		{
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#04",'TOTAL:',$vLineOne);
		$vLineOne=str_replace("@#05",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv006_0,10),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv036_0,10),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv037_0,10),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv038_0,10),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv039_0,10),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv040_0,10),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv041_0,10),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv042_0,10),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv043_0,10),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv039_0+$vlv043_0,10),$vLineOne);
		$vLineOne=str_replace("@#16",'',$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		}
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		
		return $strFullTbl;	
	}
	function LV_LuongThang13($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,$mau=0)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
			<table border="1" cellpadding="0" cellspacing="0" width="800">
			<colgroup>
			<col width="58" />
			<col width="120" />
			<col width="120" />
			<col width="47" />
			<col width="44" />
			<col width="94" />
			<col width="92" />
			<col width="88" />
			<col width="92" />
			</colgroup>
		<tbody>
			<tr height="23">
				<td>No</td>
				<td>廠別<br>Bộ phận</td>
				<td height="55" width="58"><center><strong>Mã NV</strong></center></td>
				<td ><center><strong>Ngày vào làm</strong></center></td>
				<td  ><center><strong>Họ v&agrave; T&ecirc;n</strong></center></td>
				<td ><center><strong>總薪<br/>Tổng lương</strong></center></td>
				<td  ><center><strong>扣全勤生活交通<br/>(Trừ TCGT+TCSH+CC)</strong></center></td>
				<td ><center><strong>日薪</strong></center></td>
				<td ><center><strong>考績等級</strong></center></td>
				<td ><center><strong>核發天數</strong></center></td>
				<td ><center><strong>核發額</strong></center></td>
				<td><center><strong>特別加給</strong></center></td>
				<td><center><strong>實際核發金額</strong></center></td>
			</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
 
	$vTRMAU1='
			<tr height="17">
				<td colspan="12">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">@#01</td>
			<td>@#02</td>
			<td>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=right>@#04</td>
			<td style="white-space:nowrap">@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17">@#01</td>
			<td >@#02</td>
			<td>'.(($sExport == "excel")?'<Data ss:Type="String">="@#03"':'@#03').'</td>
			<td align=right>@#04</td>
			<td style="white-space:nowrap" >@#05</td>
			<td align=right>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17" colspan="5">@#01</td>
			
		
			<td align=right><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=right><strong>@#09</strong></td>
			<td align=right><strong>@#10</strong></td>
			<td align=right><strong>@#11</strong></td>
			<td align=right><strong>@#12</strong></td>
			<td align=right><strong>@#13</strong></td>
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv030 DateW  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv030 DateW  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv030 DateW  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID,B.lv030 DateW  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on A.lv058=C.lv001 WHERE A.lv006>0 ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		
		
		$vlv011_0=0;
		$vlv082_0=0;
		$vlv084_0=0;
		$vlv085_0=0;
		$vlv081_0=0;
		$vlv082_0=0;
		$vlv025_0=0;
		$vlv032_0=0;
		
		$strTrH='';
		$vOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{
					$vOrder=0;
					$vLineOne=$vTRBold;
					$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
					$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
					$vLineOne=str_replace("@#03",'',$vLineOne);
					$vLineOne=str_replace("@#06",$this->FormatView($vlv011_1,20),$vLineOne);
					$vLineOne=str_replace("@#07",$this->FormatView($vlv082_1,20),$vLineOne);
					$vLineOne=str_replace("@#08",$this->FormatView($vlv084_1,20),$vLineOne);
					$vLineOne=str_replace("@#09",$this->FormatView($vlv085_1,20),$vLineOne);
					$vLineOne=str_replace("@#10",$this->FormatView($vlv081_1,20),$vLineOne);
					$vLineOne=str_replace("@#11",$this->FormatView($vlv082_1,20),$vLineOne);
					$vLineOne=str_replace("@#12",$this->FormatView($vlv084_1*$vlv082_1,20),$vLineOne);
					$vLineOne=str_replace("@#13",$this->FormatView($vlv032_1,20),$vLineOne);
					$strTrH=$strTrH.$vLineOne;
					switch($mau)
					{
						case 1:
							break;
						default:
							$strTable=str_replace("@#02",'&nbsp;',$lvTable);
							$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
							$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
							$strTrH='';
							break;
					}
					$vlv011_1=0;
					$vlv082_1=0;
					$vlv084_1=0;
					$vlv085_1=0;
					$vlv081_1=0;
					$vlv082_1=0;
					$vlv025_1=0;
					$vlv032_1=0;
				}
				$strDepart=$vrow['DeptID'];
			}
			$vlv011_0=$vlv011_0+$vrow['lv011'];
			$vlv082_0=$vlv082_0+$vrow['lv082'];
			$vlv084_0=$vlv084_0+$vrow['lv084'];
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			$vlv025_0=$vlv025_0+$vrow['lv025'];
			$vlv032_0=$vlv032_0+$vrow['lv032'];
			$vPIT=$vrow['lv081'];
			switch($vrow['lv099'])
			{
				case 0:
					$vlv081_0=$vlv081_0+$vrow['lv081'];
					$vlv081_1=$vlv081_1+$vrow['lv081'];
					$vPIT=$vrow['lv081'];
					break;
				case 1:
					$vlv081_0=$vlv081_0+0;
					$vlv081_1=$vlv081_1+0;
					$vPIT=0;
					break;
				case 2:
					$vlv081_0=$vlv081_0+$vrow['lv081'];
					$vlv081_1=$vlv081_1+$vrow['lv081'];
					$vPIT=$vrow['lv081'];
					break;
			}
			$vlv082_0=$vlv082_0+$vrow['lv082'];
	
			$vlv011_1=$vlv011_1+$vrow['lv011'];
			$vlv082_1=$vlv082_1+$vrow['lv082'];
			$vlv084_1=$vlv084_1+$vrow['lv084'];
			$vlv085_1=$vlv085_1+$vrow['lv085'];
			$vlv082_1=$vlv082_1+$vrow['lv082'];
			$vlv025_1=$vlv025_1+$vrow['lv025'];
			$vlv032_1=$vlv032_1+$vrow['lv032'];
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
				$vLineOne=$vTR;
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$vLineOne=str_replace("@#03",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['DateW'],2),$vLineOne);
			$vLineOne=str_replace("@#05",$this->getvaluelink('lv007',$this->FormatView($vrow['lv002'],(int)$this->ArrView['lv002'])),$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv011'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv083'],20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv084'],20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv085'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vPIT,20),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv082'],20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv084']*$vrow['lv082'],20),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vrow['lv032'],20),$vLineOne);
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$vLineOne=str_replace("@#22",$vrow['KTCode'],$vLineOne);
			$strTrH=$strTrH.$vLineOne;
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'Total:',$vLineOne);
		$vLineOne=str_replace("@#02",'',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv011_1,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv083_1,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv084_1,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv085_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv081_1,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv082_1,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv084_1*$vlv082_1,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv032_1,20),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'Total All:',$vLineOne);
		$vLineOne=str_replace("@#02",'',$vLineOne);
		$vLineOne=str_replace("@#03",'',$vLineOne);
		$vLineOne=str_replace("@#06",$this->FormatView($vlv011_0,20),$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv083_0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv084_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv085_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv081_0,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv082_0,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv084_0*$vlv082_0,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv032_0,20),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		return $strFullTbl;	
	}
	function LV_LuongHotel($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,&$mau=0)
	{
		$vExel=($_GET['funcexp']=='excel')?true:false;
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
		<table border="1" cellpadding="0" cellspacing="0" width="2757">
	<colgroup>
		<col width="29" />
		<col width="54" />
		<col width="191" />
		<col width="88" />
		<col width="174" />
		<col width="59" />
		<col width="75" />
		<col width="63" />
		<col width="62" />
		<col width="66" />
		<col width="50" />
		<col width="82" />
		<col width="123" />
		<col width="108" />
		<col width="100" />
		<col width="99" />
		<col width="102" />
		<col width="107" />
		<col width="111" />
		<col width="169" />
		<col width="117" />
		<col width="112" />
		<col width="121" />
		<col width="121" />
		<col width="111" />
		<col width="125" />
		<col width="138" /></colgroup>
	<tbody>
		<tr height="72">
			<td height="152" rowspan="3" style="text-align: center;" width="29"><strong>No<br />
				(Stt)</strong></td>
			<td rowspan="3" style="text-align: center;" width="54"><strong>CODE<br />
				(M&atilde; NV)</strong></td>
			<td rowspan="3" style="text-align: center;" width="191"><strong>Full Name<br />
				(Họ t&ecirc;n)</strong></td>
			<td rowspan="3" style="text-align: center;" width="88"><strong>Start date<br />
				(Ng&agrave;y v&agrave;o l&agrave;m)</strong></td>
			<td rowspan="3" style="text-align: center;" width="174"><strong>Position<br />
				(Chức danh)</strong></td>
			<td style="text-align: center;" width="59"><strong>working tro cap theo ngay</strong></td>
			<td style="text-align: center;" width="75"><strong>After 22 hour<br />
				(ca sau 22h)</strong></td>
			<td style="text-align: center;" width="63"><strong>&nbsp;Overtime&nbsp;</strong></td>
			<td style="text-align: center;" width="62"><strong>&nbsp;SS<br />
				(Ca g&atilde;y)<br />
				<br />
				</strong></td>
			<td style="text-align: center;" width="66"><strong>&nbsp;Night Shift<br />
				( ca đ&ecirc;m, T&iacute;nh theo ng&agrave;y)<br />
				<br />
				</strong></td>
			<td style="text-align: center;" width="50"><strong>C&ocirc;ng l&agrave;m <br />
				tết</strong></td>
			<td style="text-align: center;" width="82"><strong>Paid day<br />
				( C&ocirc;ng thực tế)</strong></td>
			<td rowspan="3" style="text-align: center;" width="123"><strong>Basic Salary<br />
				(Lương Căn Bản)</strong></td>
			<td rowspan="3" style="text-align: center;" width="108"><strong>&nbsp;Split Shift<br />
				Allowance<br />
				(Trợ cấp ca g&atilde;y)<br />
				<br />
				</strong></td>
			<td rowspan="3" style="text-align: center;" width="100"><strong>&nbsp;Night Shift <br />
				Allowance<br />
				(Tiền l&agrave;m&nbsp; ca đ&ecirc;m)<br />
				<br />
				</strong></td>
			<td rowspan="3" style="text-align: center;" width="99"><strong>&nbsp;After 22 hour<br />
				Allowance (Tiền l&agrave;m ca sau 22h)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="102"><strong>&nbsp;Salary Adjustment<br />
				(Lương điều chỉnh)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="107"><strong>&nbsp;Other allowance (thu khac)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="111"><strong>&nbsp;Service Charge<br />
				(Ph&iacute; phục vụ)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="169"><strong>&nbsp;Total Earning <br />
				( Tổng thu nhập trước khi khấu trừ)<br />
				before Deduction&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="117"><strong>&nbsp;Ph&iacute; C&ocirc;ng Đo&agrave;n <br />
				2%<br />
				(Hotel)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="117"><strong>&nbsp;Union Fee<br />(Đoàn phí)</strong></td>
			<td rowspan="3" style="text-align: center;" width="112"><strong>&nbsp;Total Hotel Paid<br />
				22%<br />
				(Ph&iacute; BH KS trả)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="111"><strong>Social Insurance
8% (employee)<br />
			<td rowspan="3" style="text-align: center;" width="111"><strong>Unemployment
Insurance
1% ( employee)<br />
			<td rowspan="3" style="text-align: center;" width="111"><strong>Health Insurance
1.5%) 
(employee
<br />
			<td rowspan="3"  style="text-align: center;" width="121"><strong>&nbsp;Total Employee <br />
				10.5%<br />
				( ph&iacute; BH người lđ trả)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="121"><strong>PIT (Thuế thu <br />
				nhập c&aacute; nh&acirc;n)</strong></td>
			<td rowspan="3" style="text-align: center;" width="111"><strong>&nbsp;Other&nbsp; deduction&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (tru khac)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="125"><strong>&nbsp;Total Deduction<br />
				( Tổng giảm trừ)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="138"><strong>&nbsp;Net pay<br />
				(Lương Thực l&atilde;nh)&nbsp;</strong></td>
			<td rowspan="3" style="text-align: center;" width="138"><strong>&nbsp;Code Account<br />
				(Mã kế toán)&nbsp;</strong></td>
		</tr>
		<tr height="40">
			<td colspan="7" height="40" style="text-align: center;" width="457"><strong>UNIT<br />
				Đơn Vị T&iacute;nh</strong></td>
		</tr>
		<tr height="40">
			<td height="40" style="text-align: center;" width="59"><strong>Days<br />
				(Ng&agrave;y)</strong></td>
			<td style="text-align: center;" width="75"><strong>Hours<br />
				(Giờ)</strong></td>
			<td style="text-align: center;" width="63"><strong>Hours<br />
				(Giờ)</strong></td>
			<td style="text-align: center;" width="62"><strong>Days<br />
				(Ng&agrave;y)</strong></td>
			<td style="text-align: center;" width="66"><strong>Days<br />
				(Ng&agrave;y)</strong></td>
			<td style="text-align: center;" width="50"><strong>Hours<br />
				(Giờ)</strong></td>
			<td style="text-align: center;" width="82"><strong>Days<br />
				(Ng&agrave;y)</strong></td>
		</tr>
		<tr height="17">
			<td height="17" style="text-align: center;"><strong>A</strong></td>
			<td style="text-align: center;"><strong>B</strong></td>
			<td style="text-align: center;"><strong>C</strong></td>
			<td style="text-align: center;"><strong>D</strong></td>
			<td style="text-align: center;"><strong>E</strong></td>
			<td style="text-align: center;" width="59"><strong>F</strong></td>
			<td style="text-align: center;" width="75"><strong>G</strong></td>
			<td style="text-align: center;" width="63"><strong>&nbsp;H&nbsp;</strong></td>
			<td style="text-align: center;" width="62"><strong>&nbsp;J&nbsp;</strong></td>
			<td style="text-align: center;" width="66"><strong>&nbsp;K&nbsp;</strong></td>
			<td style="text-align: center;"><strong><br />
				</strong></td>
			<td style="text-align: center;"><strong>L</strong></td>
			<td style="text-align: center;"><strong>1</strong></td>
			<td style="text-align: center;"><strong>5</strong></td>
			<td style="text-align: center;"><strong>6</strong></td>
			<td style="text-align: center;"><strong>7</strong></td>
			<td style="text-align: center;"><strong>9</strong></td>
			<td style="text-align: center;"><strong>10</strong></td>
			<td style="text-align: center;"><strong>11</strong></td>
			<td style="text-align: center;"><strong>12=4+5+6+7+8+9+10+11</strong></td>
			<td style="text-align: center;"><strong><br />
				</strong></td>
			<td style="text-align: center;"><strong><br />
				</strong></td>
			<td style="text-align: center;"><strong>13</strong></td>
			<td style="text-align: center;"><strong>14</strong></td>
			<td style="text-align: center;"><strong>15</strong></td>
			<td style="text-align: center;"><strong>16</strong></td>
			<td style="text-align: center;"><strong>17=14+15+16</strong></td>
			<td style="text-align: center;"><strong>18</strong></td>
			<td style="text-align: center;"><strong>19</strong></td>
			<td style="text-align: center;"><strong>20=18+19</strong></td>
			<td style="text-align: center;"><strong>21</strong></td>
			<td style="text-align: center;"><strong>22</strong></td>
		</tr>
			
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td height="17" colspan="27">@!02</td>
			</tr>
			<tr height="17">
			<td height="17">@#02</td>
			<td>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td>@#03</td>
			<td>@#04</td>
			<td>@#05</td>
			<td>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=right>@#16</td>
			<td align=right>@#17</td>
			<td align=right>@#18</td>
			<td align=right>@#19</td>
			<td align=right>@#20</td>
			<td align=right>@#21</td>
			<td align=right>@#22</td>
			
			<td align=right>@#40</td>
			<td align=right>@#41</td>
			<td align=right>@#42</td>
			
			<td align=right>@#23</td>
			<td align=right>@#24</td>
			<td align=right>@#25</td>
			<td align=right>@#26</td>
			<td align=right>@#27</td>
			<td align=right>@#28</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17">@#01</td>
			<td>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td>@#03</td>
			<td>@#04</td>
			<td>@#05</td>
			<td>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=right>@#16</td>
			<td align=right>@#17</td>
			<td align=right>@#18</td>
			<td align=right>@#19</td>
			<td align=right>@#20</td>
			<td align=right>@#21</td>
			
			<td align=right>@#35</td>
			
			<td align=right>@#22</td>
			
			<td align=right>@#40</td>
			<td align=right>@#41</td>
			<td align=right>@#42</td>
			
			<td align=right>@#23</td>
			<td align=right>@#24</td>
			<td align=right>@#25</td>
			<td align=right>@#26</td>
			<td align=right>@#27</td>
			<td align=right>@#28</td>

		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td ><strong>@#04</strong></td>
			<td ><strong>@#05</strong></td>
			<td><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=right><strong>@#09</strong></td>
			<td align=right><strong>@#10</strong></td>
			<td align=right><strong>@#11</strong></td>
			<td align=right><strong>@#12</strong></td>
			<td align=right><strong>@#13</strong></td>
			<td align=right><strong>@#14</strong></td>
			<td align=right><strong>@#15</strong></td>
			<td align=right><strong>@#16</strong></td>
			<td align=right><strong>@#17</strong></td>
			<td align=right><strong>@#18</strong></td>
			<td align=right><strong>@#19</strong></td>
			<td align=right><strong>@#20</strong></td>
			<td align=right><strong>@#21</strong></td>
			
			<td align=right><strong>@#35</strong></td>
			
			<td align=right><strong>@#22</strong></td>
			
			<td align=right><strong>@#40</strong></td>
			<td align=right><strong>@#41</strong></td>
			<td align=right><strong>@#42</strong></td>
			
			<td align=right><strong>@#23</strong></td>
			<td align=right><strong>@#24</strong></td>
			<td align=right><strong>@#25</strong></td>
			<td align=right><strong>@#26</strong></td>
			<td align=right><strong>@#27</strong></td>
			<td align=right><strong>&nbsp;</strong></td>

		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				$sqlS = "SELECT A.*,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE A.lv006>0 ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		$vlv012_0=0;
		$vlv013_0=0;
		$vlv019_0=0;
		$vlv010_0=0;
		$vlv052_0=0;
		$vlv051_0=0;
		$vlv077_0=0;
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vOrder=0;
		$strTrH='';
		$vIsFirst=true;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{	
				$vOrder=0;
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
				$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vlv015_1,20),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vlv016_1,20),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vlv017_1,20),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vlv018_1,20),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vlv079_1,20),$vLineOne);
				$vLineOne=str_replace("@#12",$this->FormatView($vlv013_1,20),$vLineOne);
				$vLineOne=str_replace("@#13",$this->FormatView($vlv019_1,20),$vLineOne);
				$vLineOne=str_replace("@#14",$this->FormatView($vlv027_1,20),$vLineOne);
				$vLineOne=str_replace("@#15",$this->FormatView($vlv028_1,20),$vLineOne);
				$vLineOne=str_replace("@#16",$this->FormatView($vlv029_1,20),$vLineOne);
				$vLineOne=str_replace("@#17",$this->FormatView($vlv030_1,20),$vLineOne);
				$vLineOne=str_replace("@#18",$this->FormatView($vlv089_1,20),$vLineOne);
				$vLineOne=str_replace("@#19",$this->FormatView($vlv032_1,20),$vLineOne);
				$vLineOne=str_replace("@#20",$this->FormatView($vlv085_1,20),$vLineOne);
				$vLineOne=str_replace("@#21",$this->FormatView($vlv080_1,20),$vLineOne);
				$vLineOne=str_replace("@#22",$this->FormatView($vlv039_1,20),$vLineOne);
				$vLineOne=str_replace("@#23",$this->FormatView($vlv043_1,20),$vLineOne);
				$vLineOne=str_replace("@#24",$this->FormatView($vlv045_1,20),$vLineOne);
				$vLineOne=str_replace("@#25",$this->FormatView($vlv046_1,20),$vLineOne);
				$vLineOne=str_replace("@#26",$this->FormatView($vlv048_1,20),$vLineOne);
				$vLineOne=str_replace("@#27",$this->FormatView($vlv084_1,20),$vLineOne);
				
				$vLineOne=str_replace("@#35",$this->FormatView($vlv035_1,20),$vLineOne);
				$vLineOne=str_replace("@#40",$this->FormatView($vlv040_1,20),$vLineOne);
				$vLineOne=str_replace("@#41",$this->FormatView($vlv041_1,20),$vLineOne);
				$vLineOne=str_replace("@#42",$this->FormatView($vlv042_1,20),$vLineOne);
				$strTrH=$strTrH.$vLineOne;
				switch($mau)
				{
					case 1:
						break;
					default:
						$strTable=str_replace("@#02",'&nbsp;',$lvTable);
						$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
						$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
						$strTrH='';
						break;
				}
				$vlv012_1=0;
				$vlv013_1=0;
				$vlv019_1=0;
				$vlv010_1=0;
				$vlv052_1=0;
				$vlv051_1=0;
				$vlv077_1=0;
				$vlv085_1=0;
				$vlv043_1=0;
				$vlv039_1=0;
				$vlv045_1=0;
				$vlv035_1=0;
				$vlv048_1=0;
				$vlv084_1=0;
				
				$vlv035_1=0;
				$vlv040_1=0;
				$vlv041_1=0;
				$vlv042_1=0;
				}
				$strDepart=$vrow['DeptID'];
				
			}
			$vlv012_0=$vlv012_0+$vrow['lv012'];
			$vlv013_0=$vlv013_0+$vrow['lv013'];
			$vlv019_0=$vlv019_0+$vrow['lv019'];
			$vlv010_0=$vlv010_0+$vrow['lv010'];
			$vlv052_0=$vlv052_0+$vrow['lv052'];
			$vlv051_0=$vlv051_0+$vrow['lv051'];
			$vlv077_0=$vlv077_0+$vrow['lv077'];
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv039_0=$vlv039_0+$vrow['lv039'];
			$vPIT=$vrow['lv045'];
			switch($vrow['lv099'])
			{
				case 0:
					$vlv045_0=$vlv045_0+0;
					$vlv045_1=$vlv045_1+0;
					$vPIT=0;
					break;
				case 1:
					$vlv045_0=$vlv045_0+$vrow['lv045'];
					$vlv045_1=$vlv045_1+$vrow['lv045'];
					$vPIT=$vrow['lv045'];
					break;
				case 2:
					$vlv045_0=$vlv045_0+$vrow['lv045']-$vrow['lv025'];
					$vlv045_1=$vlv045_1+$vrow['lv045']-$vrow['lv025'];
					$vPIT=$vrow['lv045']-$vrow['lv025'];
					break;
			}
			
			$vlv014_0=$vlv014_0+$vrow['lv014'];
			$vlv015_0=$vlv015_0+$vrow['lv015'];
			$vlv016_0=$vlv016_0+$vrow['lv016'];
			$vlv017_0=$vlv017_0+$vrow['lv017'];
			$vlv018_0=$vlv018_0+$vrow['lv018'];
			$vlv079_0=$vlv079_0+$vrow['lv079'];
			$vlv013_0=$vlv013_0+$vrow['lv013'];
			$vlv019_0=$vlv019_0+$vrow['lv019'];
			$vlv027_0=$vlv027_0+$vrow['lv027'];
			$vlv028_0=$vlv028_0+$vrow['lv028'];
			$vlv029_0=$vlv029_0+$vrow['lv029'];
			$vlv030_0=$vlv030_0+$vrow['lv030'];
			$vlv089_0=$vlv089_0+$vrow['lv089'];
			$vlv032_0=$vlv032_0+$vrow['lv032'];
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			$vlv080_0=$vlv080_0+$vrow['lv080'];
			$vlv039_0=$vlv039_0+$vrow['lv039'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv046_0=$vlv046_0+$vrow['lv046'];
			
			$vlv035_0=$vlv035_0+$vrow['lv035'];
			$vlv040_0=$vlv040_0+$vrow['lv040'];
			$vlv041_0=$vlv041_0+$vrow['lv041'];
			$vlv042_0=$vlv042_0+$vrow['lv042'];
			
			
			$vlv014_1=$vlv014_1+$vrow['lv014'];
			$vlv015_1=$vlv015_1+$vrow['lv015'];
			$vlv016_1=$vlv016_1+$vrow['lv016'];
			$vlv017_1=$vlv017_1+$vrow['lv017'];
			$vlv018_1=$vlv018_1+$vrow['lv018'];
			$vlv079_1=$vlv079_1+$vrow['lv079'];
			$vlv013_1=$vlv013_1+$vrow['lv013'];
			$vlv019_1=$vlv019_1+$vrow['lv019'];
			$vlv027_1=$vlv027_1+$vrow['lv027'];
			$vlv028_1=$vlv028_1+$vrow['lv028'];
			$vlv029_1=$vlv029_1+$vrow['lv029'];
			$vlv030_1=$vlv030_1+$vrow['lv030'];
			$vlv089_1=$vlv089_1+$vrow['lv089'];
			$vlv032_1=$vlv032_1+$vrow['lv032'];
			$vlv085_1=$vlv085_1+$vrow['lv085'];
			$vlv080_1=$vlv080_1+$vrow['lv080'];
			$vlv039_1=$vlv039_1+$vrow['lv039'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv046_1=$vlv046_1+$vrow['lv046'];
			
			$vlv035_1=$vlv035_1+$vrow['lv035'];
			$vlv040_1=$vlv040_1+$vrow['lv040'];
			$vlv041_1=$vlv041_1+$vrow['lv041'];
			$vlv042_1=$vlv042_1+$vrow['lv042'];
			
			//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
			switch($vrow['lv099'])
			{
				case 0:
				$vlv045_0=$vlv045_0+0;
				$vlv048_0=$vlv048_0+$vrow['lv048']-$vrow['lv045'];
				$vlv084_0=$vlv084_0+$vrow['lv084'];
				
				$vlv045_1=$vlv045_1+0;			
				$vlv048_1=$vlv048_1+$vrow['lv048']-$vrow['lv045'];
				$vlv084_1=$vlv084_1+$vrow['lv084'];
				break;
				case 1:
				$vlv045_0=$vlv045_0+$vrow['lv045'];
				$vlv048_0=$vlv048_0+$vrow['lv048'];
				$vlv084_0=$vlv084_0+$vrow['lv084'];
				
				$vlv045_1=$vlv045_1+$vrow['lv045'];			
				$vlv048_1=$vlv048_1+$vrow['lv048'];
				$vlv084_1=$vlv084_1+$vrow['lv084'];
				break;
				case 2:
				$vlv045_0=$vlv045_0+$vrow['lv045']-$vrow['lv025'];
				$vlv048_0=$vlv048_0+$vrow['lv048']-($vrow['lv045']-$vrow['lv025']);
				$vlv084_0=$vlv084_0+$vrow['lv084'];
				
				$vlv045_1=$vlv045_1+$vrow['lv045']-$vrow['lv025'];			
				$vlv048_1=$vlv048_1+$vrow['lv048']-($vrow['lv045']-$vrow['lv025']);
				$vlv084_1=$vlv084_1+$vrow['lv084'];
				break;
			}
			
			$vLineOne=$vTR;
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
			$vLineOne=$vTR;	
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$this->FormatView($vrow['lv002'],(int)$this->ArrView['lv002'])),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['lv503'],2),$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv014'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv015'],20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv016'],20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv017'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv018'],20),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv079'],20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv013'],20),$vLineOne);
			$vLineOne=str_replace("@#13",$this->FormatView($vrow['lv019'],20),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['lv027'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['lv028'],20),$vLineOne);
			$vLineOne=str_replace("@#16",$this->FormatView($vrow['lv029'],20),$vLineOne);
			$vLineOne=str_replace("@#17",$this->FormatView($vrow['lv030'],20),$vLineOne);
			$vLineOne=str_replace("@#18",$this->FormatView($vrow['lv089'],20),$vLineOne);
			$vLineOne=str_replace("@#19",$this->FormatView($vrow['lv032'],20),$vLineOne);
			$vLineOne=str_replace("@#20",$this->FormatView($vrow['lv085'],20),$vLineOne);
			$vLineOne=str_replace("@#21",$this->FormatView($vrow['lv080'],20),$vLineOne);
			$vLineOne=str_replace("@#22",$this->FormatView($vrow['lv039'],20),$vLineOne);
			$vLineOne=str_replace("@#23",$this->FormatView($vrow['lv043'],20),$vLineOne);
			$vLineOne=str_replace("@#28",$this->FormatView($vrow['KTCode'],20),$vLineOne);
			
			$vLineOne=str_replace("@#35",$this->FormatView($vrow['lv035'],20),$vLineOne);
			$vLineOne=str_replace("@#40",$this->FormatView($vrow['lv040'],20),$vLineOne);
			$vLineOne=str_replace("@#41",$this->FormatView($vrow['lv041'],20),$vLineOne);
			$vLineOne=str_replace("@#42",$this->FormatView($vrow['lv042'],20),$vLineOne);
			
			$vLineOne=str_replace("@#25",$this->FormatView($vrow['lv046'],20),$vLineOne);
			//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
			switch($vrow['lv099'])
			{
				case 0:
					$vLineOne=str_replace("@#24",$this->FormatView(0,20),$vLineOne);
					$vLineOne=str_replace("@#26",$this->FormatView($vrow['lv048']-$vrow['lv045'],20),$vLineOne);
					$vLineOne=str_replace("@#27",$this->FormatView($vrow['lv084'],20),$vLineOne);
					break;
				case 1:
					$vLineOne=str_replace("@#24",$this->FormatView($vrow['lv045'],20),$vLineOne);
					$vLineOne=str_replace("@#26",$this->FormatView($vrow['lv048'],20),$vLineOne);
					$vLineOne=str_replace("@#27",$this->FormatView($vrow['lv084'],20),$vLineOne);
					break;
				case 2:
					$vLineOne=str_replace("@#24",$this->FormatView($vrow['lv045']-$vrow['lv025'],20),$vLineOne);
					$vLineOne=str_replace("@#26",$this->FormatView($vrow['lv048']-($vrow['lv045']-$vrow['lv025']),20),$vLineOne);
					$vLineOne=str_replace("@#27",$this->FormatView($vrow['lv084'],20),$vLineOne);
					break;
				break;;
			}
			
			
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
	
			
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv015_1,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv016_1,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv017_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv018_1,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv079_1,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv013_1,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv019_1,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv027_1,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv028_1,20),$vLineOne);
		$vLineOne=str_replace("@#16",$this->FormatView($vlv029_1,20),$vLineOne);
		$vLineOne=str_replace("@#17",$this->FormatView($vlv030_1,20),$vLineOne);
		$vLineOne=str_replace("@#18",$this->FormatView($vlv089_1,20),$vLineOne);
		$vLineOne=str_replace("@#19",$this->FormatView($vlv032_1,20),$vLineOne);
		$vLineOne=str_replace("@#20",$this->FormatView($vlv085_1,20),$vLineOne);
		$vLineOne=str_replace("@#21",$this->FormatView($vlv080_1,20),$vLineOne);
		$vLineOne=str_replace("@#22",$this->FormatView($vlv039_1,20),$vLineOne);
		$vLineOne=str_replace("@#23",$this->FormatView($vlv043_1,20),$vLineOne);
		$vLineOne=str_replace("@#24",$this->FormatView($vlv045_1,20),$vLineOne);
		$vLineOne=str_replace("@#25",$this->FormatView($vlv046_1,20),$vLineOne);
		$vLineOne=str_replace("@#26",$this->FormatView($vlv048_1,20),$vLineOne);
		$vLineOne=str_replace("@#27",$this->FormatView($vlv084_1,20),$vLineOne);
		
		$vLineOne=str_replace("@#35",$this->FormatView($vlv035_1,20),$vLineOne);
		$vLineOne=str_replace("@#40",$this->FormatView($vlv040_1,20),$vLineOne);
		$vLineOne=str_replace("@#41",$this->FormatView($vlv041_1,20),$vLineOne);
		$vLineOne=str_replace("@#42",$this->FormatView($vlv042_1,20),$vLineOne);
		
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv015_0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv016_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv017_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv018_0,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv079_0,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv013_0,20),$vLineOne);
		$vLineOne=str_replace("@#13",$this->FormatView($vlv019_0,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv027_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv028_0,20),$vLineOne);
		$vLineOne=str_replace("@#16",$this->FormatView($vlv029_0,20),$vLineOne);
		$vLineOne=str_replace("@#17",$this->FormatView($vlv030_0,20),$vLineOne);
		$vLineOne=str_replace("@#18",$this->FormatView($vlv089_0,20),$vLineOne);
		$vLineOne=str_replace("@#19",$this->FormatView($vlv032_0,20),$vLineOne);
		$vLineOne=str_replace("@#20",$this->FormatView($vlv085_0,20),$vLineOne);
		$vLineOne=str_replace("@#21",$this->FormatView($vlv080_0,20),$vLineOne);
		$vLineOne=str_replace("@#22",$this->FormatView($vlv039_0,20),$vLineOne);
		$vLineOne=str_replace("@#23",$this->FormatView($vlv043_0,20),$vLineOne);
		$vLineOne=str_replace("@#24",$this->FormatView($vlv045_0,20),$vLineOne);
		$vLineOne=str_replace("@#25",$this->FormatView($vlv046_0,20),$vLineOne);
		$vLineOne=str_replace("@#26",$this->FormatView($vlv048_0,20),$vLineOne);
		$vLineOne=str_replace("@#27",$this->FormatView($vlv084_0,20),$vLineOne);
		
		$vLineOne=str_replace("@#35",$this->FormatView($vlv035_0,20),$vLineOne);
		$vLineOne=str_replace("@#40",$this->FormatView($vlv040_0,20),$vLineOne);
		$vLineOne=str_replace("@#41",$this->FormatView($vlv041_0,20),$vLineOne);
		$vLineOne=str_replace("@#42",$this->FormatView($vlv042_0,20),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
		return $strFullTbl;	
	}
	function LV_LuongSumHotel($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum,$motc_lv0013,&$vDh=0,&$mau=0)
	{
		
		$vExel=($_GET['funcexp']=='excel')?true:false;
		$this->ArrDanhGia=Array('100'=>'A','120'=>'A++','110'=>'A+','90'=>'B','80'=>'C');
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
		switch($mau)
		{
			case 1:
				$vExtent='';
				break;
			default:
				$vExtent='<tr><td>@#03</td></tr>';
				break;
		}
		$lvTable='
		<p></p>
		<p></p>
		<style>
		table td
		{
			padding:2px;
		}
		</style>
		<table border="0" cellpadding="0" cellspacing="0"  width="800">
		'.$vExtent.'
		<tr><td>
		<table style="width: 100%; text-align: center;" border="1" cellspacing="0" cellpadding="0">
<colgroup><col width="33"></col> <col width="62"></col> <col width="218"></col> <col width="101"></col> <col width="199"></col> <col width="67"></col> <col width="86"></col> <col width="72"></col> <col width="71"></col> <col width="75"></col> <col width="57"></col> <col width="94"></col> <col width="159"></col> <col width="141"></col> <col width="147"></col> <col width="115"></col> <col width="141"></col> <col width="127"></col> <col width="149"></col> <col width="135"></col> <col width="143"></col> <col width="112"></col> <col width="114"></col> <col width="126"></col> <col width="106"></col> <col width="80"></col> <col width="117"></col> <col width="122"></col> <col width="145"></col> <col width="193"></col> <col width="193"></col> <col width="136"></col> <col width="134"></col> <col width="128"></col> <col width="128"></col> <col width="128"></col> <col width="128"></col> <col width="122"></col> <col width="112"></col> <col width="127"></col> <col width="138"></col> <col width="152"></col> <col width="133"></col> <col width="138"></col> <col width="127"></col> <col width="119"></col> <col width="143"></col> <col width="145"></col> <col width="145"></col> <col width="191"></col> <col width="78"></col> <col width="149"></col> <col width="103"></col> <col width="117"></col> <col width="113"></col> <col width="119"></col> <col width="187"></col> <col width="289"></col> <col width="115"></col> <col width="125"></col> <col width="125"></col> <col width="106"></col> </colgroup> 
<tbody>
<tr height="72">
<td rowspan="3" width="33" height="152"><strong>No<br /> (Stt)</strong></td>
<td rowspan="3" width="62"><strong>CODE<br /> (M&atilde; NV)</strong></td>
<td rowspan="3" width="218"><strong>Full Name<br /> (Họ t&ecirc;n)</strong></td>
<td rowspan="3" width="101"><strong>Start date<br /> (Ng&agrave;y v&agrave;o l&agrave;m)</strong></td>
<td rowspan="3" width="199"><strong>Position<br /> (Chức danh)</strong></td>
<td width="67"><strong>working tro cap   theo ngay</strong></td>
<td width="86"><strong>After 22   hour<br /> (ca sau 22h)<br /></strong></td>
<td width="72"><strong>Overtime</strong></td>
<td width="71"><strong>SS<br /> (Ca g&atilde;y)<br /> </strong></td>
<td width="75"><strong>Night Shift<br /> ( ca đ&ecirc;m, T&iacute;nh theo ng&agrave;y)<br /> </strong></td>
<td width="57"><strong>C&ocirc;ng l&agrave;m <br /> tết</strong></td>
<td width="94"><strong>Paid day<br /> ( C&ocirc;ng thực tế)<br /></strong></td>
<td rowspan="3" width="159"><strong>Basic Salary<br /> Bảo hiẻm</strong></td>
<td rowspan="3" width="141"><strong>Basic Salary<br /> (Lương Căn Bản)</strong></td>
<td rowspan="3" width="147"><strong>Tiền Thưởng</strong></td>
<td rowspan="3" width="115"><strong>Đ&Aacute;NH GI&Aacute; TẠM ỨNG</strong></td>
<td rowspan="3" width="141"><strong>Tiền Thưởng <br /> T09.2016</strong></td>
<td rowspan="3" width="127"><strong>Thưởng T&iacute;nh tr&ecirc;n c&ocirc;ng</strong></td>
<td rowspan="3" width="149"><strong>Lương +Thưởng<br /> (Basic Salary+Bunos)</strong></td>
<td rowspan="3" width="135"><strong> Salary + Bonus( chưa đ&aacute;nh gi&aacute;)</strong></td>
<td rowspan="3" width="143"><strong>Lương +Thưởng<br /> (Basic Salary+Bunos)<br /> Theo c&ocirc;ng</strong></td>
<td rowspan="3" width="112"><strong>Split Shift<br /> Allowance<br /> (Trợ cấp ca g&atilde;y)<br /> </strong></td>
<td rowspan="3" width="114"><strong>Night Shift <br /> Allowance<br /> (Tiền l&agrave;m ca đ&ecirc;m)<br /> </strong></td>
<td rowspan="3" width="126"><strong>After 22 hour<br /> Allowance (Tiền l&agrave;m ca sau 22h)</strong></td>
<td rowspan="3" width="106"><strong>Overtime <br /> Allowance (Tiền l&agrave;m tăng ca)</strong></td>
<td rowspan="3" width="80"><strong>Tiền l&agrave;m tết</strong></td>
<td rowspan="3" width="117"><strong>Salary Adjustment<br /> (Lương điều chỉnh)</strong></td>
<td rowspan="3" width="122"><strong>Other allowance (phu cap khac)</strong></td>
<td rowspan="3" width="145"><strong>Service Charge<br /> (Ph&iacute; phục vụ)</strong></td>
<td rowspan="3" width="193"><strong>Total Earning <br /> ( Tổng thu nhập trước khi khấu trừ)<br /> before Deduction</strong></td>
<td rowspan="3" width="193"><strong>Total Earning <br /> ( Tổng thu nhập trước khi khấu trừ)<br /> before Deduction<br /> ( đ&atilde; trừ thưởng )</strong></td>
<td rowspan="3" width="136"><strong>Tiền Thưởng 2/9/2016<br /> v&agrave; thưởng 100 danh thu</strong></td>
<td rowspan="3" width="134"><strong>Ph&iacute; C&ocirc;ng Đo&agrave;n <br /> 2%<br /> (Hotel)</strong></td>
<td rowspan="3" width="128"><strong>Social insurance<br /> 18% ( Hotel)</strong></td>
<td rowspan="3" width="128"><strong>Unemployment<br /> Insurance 1%<br /> (Hotel)</strong></td>
<td rowspan="3" width="128"><strong>Health Insurance 3% (Hotel)</strong></td>
<td rowspan="3" width="128"><strong>Total Hotel Paid<br /> 22%<br /> (Ph&iacute; BH KS trả)</strong></td>
<td rowspan="3" width="122"><strong>Social Insurance<br /> 8% (employee)</strong></td>
<td rowspan="3" width="112"><strong>Unemployment<br /> Insurance<br /> 1% ( employee)</strong></td>
<td rowspan="3" width="127"><strong>Health Insurance<br /> 1.5%) <br /> (employee<br /> </strong></td>
<td rowspan="3" width="138"><strong>Total Employee <br /> 10.5%<br /> ( ph&iacute; BH người lđ trả)</strong></td>
<td rowspan="3" width="152"><strong>Exemption</strong></td>
<td rowspan="3" width="133"><strong>Subject to Tax ( TNTT)</strong></td>
<td rowspan="3" width="138"><strong>PIT (Thuế thu <br /> nhập c&aacute; nh&acirc;n)</strong></td>
<td rowspan="3" width="127"><strong>Other   deduction (tru khac)</strong></td>
<td rowspan="3" width="119"><strong>Ho&agrave;n trả tiền thuế TNCN đ&atilde; nộp thừa 2015 Hoặc số Tiền c&ograve;n phải khấu   trừ thuế 2015 th&ecirc;m</strong></td>
<td rowspan="3" width="143"><strong>Total Deduction<br /> ( Tổng giảm trừ)</strong></td>
<td rowspan="3" width="145"><strong>Net pay<br /> Lương Thực l&atilde;nh</strong></td>
<td rowspan="3" width="145"><strong>Thưởng thực l&atilde;nh</strong></td>
<td rowspan="3" width="191"><strong>Final <br /> Net Pay<br /> Lương+Thưởng</strong></td>
</tr>
<tr height="40">
<td colspan="7" width="522" height="40"><strong>UNIT<br /> Đơn Vị T&iacute;nh</strong></td>
</tr>
<tr height="40">
<td width="67" height="40"><strong>Days<br /> (Ng&agrave;y)</strong></td>
<td width="86"><strong>Hours<br /> (Giờ)</strong></td>
<td width="72"><strong>Hours<br /> (Giờ)</strong></td>
<td width="71"><strong>Days<br /> (Ng&agrave;y)</strong></td>
<td width="75"><strong>Days<br /> (Ng&agrave;y)</strong></td>
<td width="57"><strong>Hours<br /> (Giờ)</strong></td>
<td width="94"><strong>Days<br /> (Ng&agrave;y)</strong></td>
</tr>
<tr height="17">
<td height="17"><strong>A</strong></td>
<td><strong>B</strong></td>
<td><strong>C</strong></td>
<td><strong>D</strong></td>
<td><strong>E</strong></td>
<td width="67"><strong>F</strong></td>
<td width="86"><strong>G</strong></td>
<td width="72"><strong>H</strong></td>
<td width="71"><strong>J</strong></td>
<td width="75"><strong>K</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>L</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>1</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>2</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>3</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>4</strong></td>
<td><strong>5</strong></td>
<td><strong>6</strong></td>
<td><strong>7</strong></td>
<td><strong>8</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>9</strong></td>
<td><strong>10</strong></td>
<td><strong>11</strong></td>
<td><strong>12=4+5+6+7+8+9+10+11</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>13</strong></td>
<td><strong>14</strong></td>
<td><strong>15</strong></td>
<td><strong>16</strong></td>
<td><strong>17=14+15+16</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>18</strong></td>
<td><strong>19</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>20=18+19</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>&nbsp;</strong></td>
<td><strong>21</strong></td>
</tr>
			@#01
			@#02
		</tbody>
	</table>
	</td>
	</tr>
	</table>';
	$sExport=$_GET['funcexp'];
	$vTRMAU1='
			<tr height="17">
				<td height="17" colspan="27"  align=left nowrap><strong>@!02</strong></td>
			</tr>
			<tr height="17">
			<td height="17">@#02</td>
			<td >'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td align=left nowrap>@#03</td>
			<td>@#04</td>
			<td align=left > <div style="width:160px">@#05</div></td>
			<td>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=center>@#16</td>
			<td align=right>@#17</td>
			<td align=right>@#18</td>
			<td align=right>@#19</td>
			<td align=right>@#20</td>
			<td align=right>@#21</td>
			<td align=right>@#22</td>
			<td align=right>@#23</td>
			<td align=right>@#24</td>
			<td align=right>@#25</td>
			<td align=right>@#26</td>
			<td align=right>@#27</td>
			<td align=right>@#28</td>
			<td align="right">@#29</td>
			<td align="right">@#30</td>
			<td align="right">@#31</td>
			<td align="right">@#32</td>
			<td align="right">@#33</td>
			<td align="right">@#34</td>
			<td align="right">@#35</td>
			<td align="right">@#36</td>
			<td align="right">@#37</td>
			<td align="right">@#38</td>
			<td align="right">@#39</td>
			<td align="right">@#40</td>
			<td align="right">@#41</td>
			<td align="right">@#42</td>
			<td align="right">@#43</td>
			<td align="right">@#44</td>
			<td align="right">@#45</td>
			<td align="right">@#46</td>
			<td align="right">@#47</td>
			<td align="right">@#48</td>
			<td align="right">@#49</td>
			<td align="right">@#50</td>
		</tr>';
	$vTR='<tr height="17">
			<td height="17">@#01</td>
			<td>'.(($sExport == "excel")?'<Data ss:Type="String">="@#02"':'@#02').'</td>
			<td  align=left nowrap>@#03</td>
			<td>@#04</td>
			<td  align=left><div style="width:160px">@#05</div></td>
			<td>@#06</td>
			<td align=right>@#07</td>
			<td align=right>@#08</td>
			<td align=right>@#09</td>
			<td align=right>@#10</td>
			<td align=right>@#11</td>
			<td align=right>@#12</td>
			<td align=right>@#13</td>
			<td align=right>@#14</td>
			<td align=right>@#15</td>
			<td align=center>@#16</td>
			<td align=right>@#17</td>
			<td align=right>@#18</td>
			<td align=right>@#19</td>
			<td align=right>@#20</td>
			<td align=right>@#21</td>
			<td align=right>@#22</td>			
			<td align=right>@#23</td>
			<td align=right>@#24</td>
			<td align=right>@#25</td>
			<td align=right>@#26</td>
			<td align=right>@#27</td>
			<td align=right>@#28</td>
			<td align="right">@#29</td>
			<td align="right">@#30</td>
			<td align="right">@#31</td>
			<td align="right">@#32</td>
			<td align="right">@#33</td>
			<td align="right">@#34</td>
			<td align="right">@#35</td>
			<td align="right">@#36</td>
			<td align="right">@#37</td>
			<td align="right">@#38</td>
			<td align="right">@#39</td>
			<td align="right">@#40</td>
			<td align="right">@#41</td>
			<td align="right">@#42</td>
			<td align="right">@#43</td>
			<td align="right">@#44</td>
			<td align="right">@#45</td>
			<td align="right">@#46</td>
			<td align="right">@#47</td>
			<td align="right">@#48</td>
			<td align="right">@#49</td>
			<td align="right">@#50</td>
		</tr>';
		$vTRBold='<tr height="17">
			<td height="17">@#01</td>
			<td><strong>@#02</strong></td>
			<td>@#03</td>
			<td ><strong>@#04</strong></td>
			<td ><strong>@#05</strong></td>
			<td><strong>@#06</strong></td>
			<td align=right><strong>@#07</strong></td>
			<td align=right><strong>@#08</strong></td>
			<td align=right><strong>@#09</strong></td>
			<td align=right><strong>@#10</strong></td>
			<td align=right><strong>@#11</strong></td>
			<td align=right><strong>@#12</strong></td>
			<td align=right><strong>@#13</strong></td>
			<td align=right><strong>@#14</strong></td>
			<td align=right><strong>@#15</strong></td>
			<td align=right><strong>&nbsp;</strong></td>
			<td align=right><strong>@#17</strong></td>
			<td align=right><strong>@#18</strong></td>
			<td align=right><strong>@#19</strong></td>
			<td align=right><strong>@#20</strong></td>
			<td align=right><strong>@#21</strong></td>
			<td align=right><strong>@#22</strong></td>
			<td align=right><strong>@#23</strong></td>
			<td align=right><strong>@#24</strong></td>
			<td align=right><strong>@#25</strong></td>
			<td align=right><strong>@#26</strong></td>
			<td align=right><strong>@#27</strong></td>
			<td align=right><strong>@#28</strong></td>
			<td align=right><strong>@#29</strong></td>
			<td align=right><strong>@#30</strong></td>
			<td align=right><strong>@#31</strong></td>
			<td align=right><strong>@#32</strong></td>
			<td align=right><strong>@#33</strong></td>
			<td align=right><strong>@#34</strong></td>
			<td align=right><strong>@#35</strong></td>
			<td align=right><strong>@#36</strong></td>
			<td align=right><strong>@#37</strong></td>
			<td align=right><strong>@#38</strong></td>
			<td align=right><strong>@#39</strong></td>
			<td align=right><strong>@#40</strong></td>
			<td align=right><strong>@#41</strong></td>
			<td align=right><strong>@#42</strong></td>
			<td align=right><strong>@#43</strong></td>
			<td align=right><strong>@#44</strong></td>
			<td align=right><strong>@#45</strong></td>
			<td align=right><strong>@#46</strong></td>
			<td align=right><strong>@#47</strong></td>
			<td align=right><strong>@#48</strong></td>
			<td align=right><strong>@#49</strong></td>
			<td align=right><strong>@#50</strong></td>
	
		</tr>';
		$strSort=' order by AA.lv004 ASC,A.lv002 ASC';
		switch($vDh)
		{
			case 0:
				$sqlS = "SELECT A.*,(A.lv039+A.lv043-A.lv035) lv180,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE 1=1  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 1:
				$sqlS = "SELECT A.*,(A.lv039+A.lv043-A.lv035) lv180,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039<>0 or A.lv043<>0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 2:
				$sqlS = "SELECT A.*,(A.lv039+A.lv043-A.lv035) lv180,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE (A.lv039=0 and A.lv043=0)  ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
			case 3:
				$sqlS = "SELECT A.*,(A.lv039+A.lv043-A.lv035) lv180,B.lv030 lv503,B.lv005 Position,C.lv007 KTCode,AA.lv004 DeptID  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060  left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on B.lv029=C.lv001 WHERE A.lv006>0 ".$this->GetConditionOtherCal()." $strSort LIMIT $curRow, $maxRows";
				break;
		}
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$strDepart='';
		$vlv006_0=0;
		$vlv081_0=0;
		$vlv082_0=0;
		$vlv023_0=0;
		$vlv025_0=0;
		$vlv020_0=0;
		$vlv026_0=0;
		$vlv027_0=0;
		$vlv028_0=0;
		$vlv029_0=0;
		$vlv077_0=0;
		$vlv078_0=0;
		$vlv030_0=0;
		$vlv031_0=0;
		$vlv032_0=0;
		$vlv033_0=0;
		$vlv034_0=0;
		$vlv080_0=0;
		$vlv036_0=0;
		$vlv037_0=0;
		$vlv038_0=0;
		$vlv039_0=0;
		$vlv040_0=0;
		$vlv041_0=0;
		$vlv042_0=0;
		$vlv043_0=0;
		$vlv044_0=0;
		$vlv045_0=0;
		$vlv070_0=0;
		$vlv046_0=0;
		$vlv047_0=0;
		$vlv050_0=0;
		$vlv083_0=0;
		$vlv084_0=0;
		
		$vlv012_0=0;
		$vlv013_0=0;
		$vlv019_0=0;
		$vlv010_0=0;
		$vlv052_0=0;
		$vlv051_0=0;
		
		$vlv085_0=0;
		$vlv043_0=0;
		$vlv039_0=0;
		$vlv045_0=0;
		$vlv035_0=0;
		$vlv048_0=0;
		$vlv084_0=0;
		$vOrder=0;
		$strTrH='';
		$vIsFirst=true;
		while ($vrow = db_fetch_array ($bResult)){
			if($strDepart!=$vrow['DeptID'].'' && $mau!=2)
			{
				if($strDepart!='')
				{	
				$vOrder=0;
				$vLineOne=$vTRBold;
				$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
				$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
				$vLineOne=str_replace("@#07",$this->FormatView($vlv015_1,20),$vLineOne);
				$vLineOne=str_replace("@#08",$this->FormatView($vlv016_1,20),$vLineOne);
				$vLineOne=str_replace("@#09",$this->FormatView($vlv017_1,20),$vLineOne);
				$vLineOne=str_replace("@#10",$this->FormatView($vlv018_1,20),$vLineOne);
				$vLineOne=str_replace("@#11",$this->FormatView($vlv079_1,20),$vLineOne);
				$vLineOne=str_replace("@#12",$this->FormatView($vlv013_1,20),$vLineOne);
				$vLineOne=str_replace("@#13",$this->FormatView($vlv006_1,20),$vLineOne);
				$vLineOne=str_replace("@#14",$this->FormatView($vlv019_1,20),$vLineOne);
				$vLineOne=str_replace("@#15",$this->FormatView($vlv082_1,20),$vLineOne);
				$vLineOne=str_replace("@#16",$this->FormatView($vlv081_1,20),$vLineOne);
				$vLineOne=str_replace("@#17",$this->FormatView($vlv023_1,20),$vLineOne);
				$vLineOne=str_replace("@#18",$this->FormatView($vlv025_1,20),$vLineOne);
				$vLineOne=str_replace("@#19",$this->FormatView($vlv020_1,20),$vLineOne);
				$vLineOne=str_replace("@#20",$this->FormatView($vlv019_1+$vlv082_1,20),$vLineOne);
				$vLineOne=str_replace("@#21",$this->FormatView($vlv024_1,20),$vLineOne);
				$vLineOne=str_replace("@#22",$this->FormatView($vlv027_1,20),$vLineOne);
				$vLineOne=str_replace("@#23",$this->FormatView($vlv028_1,20),$vLineOne);
				$vLineOne=str_replace("@#24",$this->FormatView($vlv029_1,20),$vLineOne);
				$vLineOne=str_replace("@#25",$this->FormatView($vlv077_1,20),$vLineOne);
				$vLineOne=str_replace("@#26",$this->FormatView($vlv078_1,20),$vLineOne);
				$vLineOne=str_replace("@#27",$this->FormatView($vlv030_1,20),$vLineOne);
				$vLineOne=str_replace("@#28",$this->FormatView($vlv031_1,20),$vLineOne);
				$vLineOne=str_replace("@#29",$this->FormatView($vlv032_1,20),$vLineOne);
				$vLineOne=str_replace("@#30",$this->FormatView($vlv033_1,20),$vLineOne);
				$vLineOne=str_replace("@#31",$this->FormatView($vlv033_1-$vlv025_1,20),$vLineOne);
				$vLineOne=str_replace("@#32",$this->FormatView($vlv034_1,20),$vLineOne);
				$vLineOne=str_replace("@#33",$this->FormatView($vlv080_1,20),$vLineOne);
				$vLineOne=str_replace("@#34",$this->FormatView($vlv036_1,20),$vLineOne);
				$vLineOne=str_replace("@#35",$this->FormatView($vlv038_1,20),$vLineOne);
				$vLineOne=str_replace("@#36",$this->FormatView($vlv037_1,20),$vLineOne);
				$vLineOne=str_replace("@#37",$this->FormatView($vlv039_1,20),$vLineOne);
				$vLineOne=str_replace("@#38",$this->FormatView($vlv040_1,20),$vLineOne);
				$vLineOne=str_replace("@#39",$this->FormatView($vlv042_1,20),$vLineOne);
				$vLineOne=str_replace("@#40",$this->FormatView($vlv041_1,20),$vLineOne);
				$vLineOne=str_replace("@#41",$this->FormatView($vlv043_1,20),$vLineOne);
				$vLineOne=str_replace("@#42",$this->FormatView($vlv044_1,20),$vLineOne);
				$vLineOne=str_replace("@#43",$this->FormatView($vlv070_1,20),$vLineOne);
				$vLineOne=str_replace("@#44",$this->FormatView($vlv045_1,20),$vLineOne);
				$vLineOne=str_replace("@#45",$this->FormatView($vlv046_1,20),$vLineOne);
				$vLineOne=str_replace("@#46",$this->FormatView($vlv047_1,20),$vLineOne);
				$vLineOne=str_replace("@#47",$this->FormatView($vlv048_1,20),$vLineOne);
				$vLineOne=str_replace("@#48",$this->FormatView($vlv084_1,20),$vLineOne);
				$vLineOne=str_replace("@#49",$this->FormatView($vlv083_1,20),$vLineOne);
				$vLineOne=str_replace("@#50",$this->FormatView($vlv050_1,20),$vLineOne);
				
				
				$strTrH=$strTrH.$vLineOne;
				switch($mau)
				{
					case 1:
						break;
					default:
						$strTable=str_replace("@#02",'&nbsp;',$lvTable);
						$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
						$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable);
						$strTrH='';
						break;
				}
				$vlv006_1=0;
				$vlv082_1=0;
				$vlv081_1=0;
				$vlv023_1=0;
				$vlv024_1=0;
				$vlv025_1=0;
				$vlv020_1=0;
				$vlv026_1=0;
				$vlv027_1=0;
				$vlv028_1=0;
				$vlv029_1=0;
				$vlv077_1=0;
				$vlv078_1=0;
				$vlv030_1=0;
				$vlv031_1=0;
				$vlv032_1=0;
				$vlv033_1=0;
				$vlv080_1=0;
				$vlv036_1=0;
				$vlv037_1=0;
				$vlv038_1=0;
				$vlv039_1=0;
				$vlv040_1=0;
				$vlv041_1=0;
				$vlv042_1=0;
				$vlv043_1=0;
				$vlv044_1=0;
				$vlv045_1=0;
				$vlv070_1=0;
				$vlv046_1=0;
				$vlv047_1=0;
				$vlv048_1=0;
				$vlv083_1=0;
				$vlv084_1=0;
				$vlv050_1=0;
				
				
				$vlv012_1=0;
				$vlv013_1=0;
				$vlv019_1=0;
				$vlv010_1=0;
				$vlv052_1=0;
				$vlv051_1=0;
				
				$vlv085_1=0;
				$vlv043_1=0;
				$vlv039_1=0;
				$vlv035_1=0;
				$vlv084_1=0;
				
				
				$vlv035_1=0;
				$vlv040_1=0;
				$vlv041_1=0;
				$vlv042_1=0;
				}
				$strDepart=$vrow['DeptID'];
				
			}
			$vlv006_0=$vlv006_0+$vrow['lv006'];
			$vlv082_0=$vlv082_0+$vrow['lv082'];
			$vlv081_0=$vlv081_0+$vrow['lv081'];
			$vlv023_0=$vlv023_0+$vrow['lv023'];
			$vlv024_0=$vlv024_0+$vrow['lv024'];
			$vlv025_0=$vlv025_0+$vrow['lv025'];
			$vlv020_0=$vlv020_0+$vrow['lv020'];
			$vlv026_0=$vlv026_0+$vrow['lv026'];
			$vlv027_0=$vlv027_0+$vrow['lv027'];
			$vlv028_0=$vlv028_0+$vrow['lv028'];
			$vlv029_0=$vlv029_0+$vrow['lv029'];
			$vlv077_0=$vlv077_0+$vrow['lv077'];
			$vlv078_0=$vlv078_0+$vrow['lv078'];
			$vlv030_0=$vlv030_0+$vrow['lv030'];
			$vlv031_0=$vlv031_0+$vrow['lv031'];
			$vlv032_0=$vlv032_0+$vrow['lv032'];
			$vlv033_0=$vlv033_0+$vrow['lv033'];
			$vlv034_0=$vlv034_0+$vrow['lv034'];
			$vlv080_0=$vlv080_0+$vrow['lv080'];
			$vlv036_0=$vlv036_0+$vrow['lv036'];
			$vlv037_0=$vlv037_0+$vrow['lv037'];
			$vlv038_0=$vlv038_0+$vrow['lv038'];
			$vlv039_0=$vlv039_0+$vrow['lv039'];
			$vlv040_0=$vlv040_0+$vrow['lv040'];
			$vlv041_0=$vlv041_0+$vrow['lv041'];
			$vlv042_0=$vlv042_0+$vrow['lv042'];
			$vlv043_0=$vlv043_0+$vrow['lv043'];
			$vlv044_0=$vlv044_0+$vrow['lv044'];
			$vlv045_0=$vlv045_0+$vrow['lv045'];
			$vlv070_0=$vlv070_0+$vrow['lv070'];
			$vlv046_0=$vlv046_0+$vrow['lv046'];
			$vlv047_0=$vlv047_0+$vrow['lv047'];
			$vlv048_0=$vlv048_0+$vrow['lv048'];
			$vlv083_0=$vlv083_0+$vrow['lv083'];
			$vlv084_0=$vlv084_0+$vrow['lv084'];
			$vlv050_0=$vlv050_0+$vrow['lv050'];
			
			$vlv012_0=$vlv012_0+$vrow['lv012'];
			$vlv013_0=$vlv013_0+$vrow['lv013'];
			$vlv019_0=$vlv019_0+$vrow['lv019'];
			$vlv010_0=$vlv010_0+$vrow['lv010'];
			$vlv052_0=$vlv052_0+$vrow['lv052'];
			$vlv051_0=$vlv051_0+$vrow['lv051'];
			
			$vlv085_0=$vlv085_0+$vrow['lv085'];
			
			$vlv014_0=$vlv014_0+$vrow['lv014'];
			$vlv015_0=$vlv015_0+$vrow['lv015'];
			$vlv016_0=$vlv016_0+$vrow['lv016'];
			$vlv017_0=$vlv017_0+$vrow['lv017'];
			$vlv018_0=$vlv018_0+$vrow['lv018'];
			$vlv079_0=$vlv079_0+$vrow['lv079'];			
			$vlv089_0=$vlv089_0+$vrow['lv089'];
			
			$vlv035_0=$vlv035_0+$vrow['lv035'];
			$vlv040_0=$vlv040_0+$vrow['lv040'];
			$vlv041_0=$vlv041_0+$vrow['lv041'];
			$vlv042_0=$vlv042_0+$vrow['lv042'];
			
			$vlv006_1=$vlv006_1+$vrow['lv006'];
			$vlv082_1=$vlv082_1+$vrow['lv082'];
			$vlv081_1=$vlv081_1+$vrow['lv081'];
			$vlv023_1=$vlv023_1+$vrow['lv023'];
			$vlv024_1=$vlv024_1+$vrow['lv024'];
			$vlv025_1=$vlv025_1+$vrow['lv025'];
			$vlv020_1=$vlv020_1+$vrow['lv020'];
			$vlv026_1=$vlv026_1+$vrow['lv026'];
			$vlv027_1=$vlv027_1+$vrow['lv027'];
			$vlv028_1=$vlv028_1+$vrow['lv028'];
			$vlv029_1=$vlv029_1+$vrow['lv029'];
			$vlv077_1=$vlv077_1+$vrow['lv077'];
			$vlv078_1=$vlv078_1+$vrow['lv078'];
			$vlv030_1=$vlv030_1+$vrow['lv030'];
			$vlv031_1=$vlv031_1+$vrow['lv031'];
			$vlv032_1=$vlv032_1+$vrow['lv032'];
			$vlv033_1=$vlv033_1+$vrow['lv033'];
			$vlv034_1=$vlv034_1+$vrow['lv034'];
			$vlv080_1=$vlv080_1+$vrow['lv080'];
			$vlv036_1=$vlv036_1+$vrow['lv036'];
			$vlv037_1=$vlv037_1+$vrow['lv037'];
			$vlv038_1=$vlv038_1+$vrow['lv038'];
			$vlv039_1=$vlv039_1+$vrow['lv039'];
			$vlv040_1=$vlv040_1+$vrow['lv040'];
			$vlv041_1=$vlv041_1+$vrow['lv041'];
			$vlv042_1=$vlv042_1+$vrow['lv042'];
			$vlv043_1=$vlv043_1+$vrow['lv043'];
			$vlv044_1=$vlv044_1+$vrow['lv044'];
			$vlv045_1=$vlv045_1+$vrow['lv045'];
			$vlv070_1=$vlv070_1+$vrow['lv070'];
			$vlv046_1=$vlv046_1+$vrow['lv046'];
			$vlv047_1=$vlv047_1+$vrow['lv047'];
			$vlv048_1=$vlv048_1+$vrow['lv048'];
			$vlv083_1=$vlv083_1+$vrow['lv083'];
			$vlv084_1=$vlv084_1+$vrow['lv084'];
			$vlv050_1=$vlv050_1+$vrow['lv050'];
			
			$vlv014_1=$vlv014_1+$vrow['lv014'];
			$vlv015_1=$vlv015_1+$vrow['lv015'];
			$vlv016_1=$vlv016_1+$vrow['lv016'];
			$vlv017_1=$vlv017_1+$vrow['lv017'];
			$vlv018_1=$vlv018_1+$vrow['lv018'];
			$vlv079_1=$vlv079_1+$vrow['lv079'];
			$vlv013_1=$vlv013_1+$vrow['lv013'];
			$vlv019_1=$vlv019_1+$vrow['lv019'];
			
			$vlv089_1=$vlv089_1+$vrow['lv089'];
			$vlv085_1=$vlv085_1+$vrow['lv085'];
			
			$vlv035_1=$vlv035_1+$vrow['lv035'];
			$vlv040_1=$vlv040_1+$vrow['lv040'];
			$vlv041_1=$vlv041_1+$vrow['lv041'];
			$vlv042_1=$vlv042_1+$vrow['lv042'];
			
			
			
			$vLineOne=$vTR;
			$vOrder++;
			if($vOrder==1)
			{
				switch($mau)
				{
					case 1:
						$vLineOne=$vTRMAU1;
						break;
					default:
						$vLineOne=$vTR;
						break;
				}
			}
			else
			$vLineOne=$vTR;	
			$vLineOne=str_replace("@#01",$vOrder,$vLineOne);
			$vLineOne=str_replace("@#02",$vrow['lv002'],$vLineOne);
			$vLineOne=str_replace("@#03",$this->getvaluelink('lv007',$this->FormatView($vrow['lv002'],(int)$this->ArrView['lv002'])),$vLineOne);
			$vLineOne=str_replace("@#04",$this->FormatView($vrow['lv503'],2),$vLineOne);
			$vLineOne=str_replace("@#05",$vrow['Position'],$vLineOne);
			$vLineOne=str_replace("@#06",$this->FormatView($vrow['lv014'],20),$vLineOne);
			$vLineOne=str_replace("@#07",$this->FormatView($vrow['lv015'],20),$vLineOne);
			$vLineOne=str_replace("@#08",$this->FormatView($vrow['lv016'],20),$vLineOne);
			$vLineOne=str_replace("@#09",$this->FormatView($vrow['lv017'],20),$vLineOne);
			$vLineOne=str_replace("@#10",$this->FormatView($vrow['lv018'],20),$vLineOne);
			$vLineOne=str_replace("@#11",$this->FormatView($vrow['lv079'],20),$vLineOne);
			$vLineOne=str_replace("@#12",$this->FormatView($vrow['lv013'],20),$vLineOne);
			
			$vLineOne=str_replace("@#13",$this->FormatView($vrow['lv006'],20),$vLineOne);
			$vLineOne=str_replace("@#14",$this->FormatView($vrow['lv019'],20),$vLineOne);
			$vLineOne=str_replace("@#15",$this->FormatView($vrow['lv082'],20),$vLineOne);
			$vLineOne=str_replace("@#16",$this->ArrDanhGia[$vrow['lv081']],$vLineOne);
			$vLineOne=str_replace("@#17",$this->FormatView($vrow['lv023'],20),$vLineOne);
			$vLineOne=str_replace("@#18",$this->FormatView($vrow['lv025'],20),$vLineOne);
			$vLineOne=str_replace("@#19",$this->FormatView($vrow['lv020'],20),$vLineOne);
			$vLineOne=str_replace("@#20",$this->FormatView($vrow['lv019']+$vrow['lv082'],20),$vLineOne);
			$vLineOne=str_replace("@#21",$this->FormatView($vrow['lv024'],20),$vLineOne);
			$vLineOne=str_replace("@#22",$this->FormatView($vrow['lv027'],20),$vLineOne);
			$vLineOne=str_replace("@#23",$this->FormatView($vrow['lv028'],20),$vLineOne);
			$vLineOne=str_replace("@#24",$this->FormatView($vrow['lv029'],20),$vLineOne);
			$vLineOne=str_replace("@#25",$this->FormatView($vrow['lv077'],20),$vLineOne);
			$vLineOne=str_replace("@#26",$this->FormatView($vrow['lv078'],20),$vLineOne);
			$vLineOne=str_replace("@#27",$this->FormatView($vrow['lv030'],20),$vLineOne);
			$vLineOne=str_replace("@#28",$this->FormatView($vrow['lv031'],20),$vLineOne);
			$vLineOne=str_replace("@#29",$this->FormatView($vrow['lv032'],20),$vLineOne);
			$vLineOne=str_replace("@#30",$this->FormatView($vrow['lv033'],20),$vLineOne);
			$vLineOne=str_replace("@#31",$this->FormatView($vrow['lv033']-$vrow['lv025'],20),$vLineOne);
			$vLineOne=str_replace("@#32",$this->FormatView($vrow['lv034'],20),$vLineOne);
			$vLineOne=str_replace("@#33",$this->FormatView($vrow['lv080'],20),$vLineOne);			
			$vLineOne=str_replace("@#34",$this->FormatView($vrow['lv036'],20),$vLineOne);
			$vLineOne=str_replace("@#35",$this->FormatView($vrow['lv038'],20),$vLineOne);
			$vLineOne=str_replace("@#36",$this->FormatView($vrow['lv037'],20),$vLineOne);
			$vLineOne=str_replace("@#37",$this->FormatView($vrow['lv039'],20),$vLineOne);
			$vLineOne=str_replace("@#38",$this->FormatView($vrow['lv040'],20),$vLineOne);
			$vLineOne=str_replace("@#39",$this->FormatView($vrow['lv042'],20),$vLineOne);
			$vLineOne=str_replace("@#40",$this->FormatView($vrow['lv041'],20),$vLineOne);
			$vLineOne=str_replace("@#41",$this->FormatView($vrow['lv043'],20),$vLineOne);
			$vLineOne=str_replace("@#42",$this->FormatView($vrow['lv044'],20),$vLineOne);
			$vLineOne=str_replace("@#43",$this->FormatView($vrow['lv070'],20),$vLineOne);
			$vLineOne=str_replace("@#44",$this->FormatView($vrow['lv045'],20),$vLineOne);
			$vLineOne=str_replace("@#45",$this->FormatView($vrow['lv046'],20),$vLineOne);
			$vLineOne=str_replace("@#46",$this->FormatView($vrow['lv047'],20),$vLineOne);
			$vLineOne=str_replace("@#47",$this->FormatView($vrow['lv048'],20),$vLineOne);
			$vLineOne=str_replace("@#48",$this->FormatView($vrow['lv084'],20),$vLineOne);
			$vLineOne=str_replace("@#49",$this->FormatView($vrow['lv083'],20),$vLineOne);
			$vLineOne=str_replace("@#50",$this->FormatView($vrow['lv050'],20),$vLineOne);

			
			
			$vLineOne=str_replace("@!02",$this->getvaluelink('lv058',$strDepart),$vLineOne);
			$strTrH=$strTrH.$vLineOne;
			
	
			
		}
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng:',$vLineOne);
		$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv015_1,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv016_1,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv017_1,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv018_1,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv079_1,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv013_1,20),$vLineOne);
		
		$vLineOne=str_replace("@#13",$this->FormatView($vlv006_1,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv019_1,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv082_1,20),$vLineOne);
		$vLineOne=str_replace("@#16",'',$vLineOne);
		$vLineOne=str_replace("@#17",$this->FormatView($vlv023_1,20),$vLineOne);
		$vLineOne=str_replace("@#18",$this->FormatView($vlv025_1,20),$vLineOne);
		$vLineOne=str_replace("@#19",$this->FormatView($vlv020_1,20),$vLineOne);
		$vLineOne=str_replace("@#20",$this->FormatView($vlv019_1+$vlv082_1,20),$vLineOne);
		$vLineOne=str_replace("@#21",$this->FormatView($vlv024_1,20),$vLineOne);
		$vLineOne=str_replace("@#22",$this->FormatView($vlv027_1,20),$vLineOne);
		$vLineOne=str_replace("@#23",$this->FormatView($vlv028_1,20),$vLineOne);
		$vLineOne=str_replace("@#24",$this->FormatView($vlv029_1,20),$vLineOne);
		$vLineOne=str_replace("@#25",$this->FormatView($vlv077_1,20),$vLineOne);
		$vLineOne=str_replace("@#26",$this->FormatView($vlv078_1,20),$vLineOne);
		$vLineOne=str_replace("@#27",$this->FormatView($vlv030_1,20),$vLineOne);
		$vLineOne=str_replace("@#28",$this->FormatView($vlv031_1,20),$vLineOne);
		$vLineOne=str_replace("@#29",$this->FormatView($vlv032_1,20),$vLineOne);
		$vLineOne=str_replace("@#30",$this->FormatView($vlv033_1,20),$vLineOne);
		$vLineOne=str_replace("@#31",$this->FormatView($vlv033_1-$vlv025_1,20),$vLineOne);
		$vLineOne=str_replace("@#32",$this->FormatView($vlv034_1,20),$vLineOne);
		$vLineOne=str_replace("@#33",$this->FormatView($vlv080_1,20),$vLineOne);		
		$vLineOne=str_replace("@#34",$this->FormatView($vlv036_1,20),$vLineOne);
		$vLineOne=str_replace("@#35",$this->FormatView($vlv038_1,20),$vLineOne);
		$vLineOne=str_replace("@#36",$this->FormatView($vlv037_1,20),$vLineOne);
		$vLineOne=str_replace("@#37",$this->FormatView($vlv039_1,20),$vLineOne);
		$vLineOne=str_replace("@#38",$this->FormatView($vlv040_1,20),$vLineOne);
		$vLineOne=str_replace("@#39",$this->FormatView($vlv042_1,20),$vLineOne);
		$vLineOne=str_replace("@#40",$this->FormatView($vlv041_1,20),$vLineOne);
		$vLineOne=str_replace("@#41",$this->FormatView($vlv043_1,20),$vLineOne);
		$vLineOne=str_replace("@#42",$this->FormatView($vlv044_1,20),$vLineOne);
		$vLineOne=str_replace("@#43",$this->FormatView($vlv070_1,20),$vLineOne);
		$vLineOne=str_replace("@#44",$this->FormatView($vlv045_1,20),$vLineOne);
		$vLineOne=str_replace("@#45",$this->FormatView($vlv046_1,20),$vLineOne);
		$vLineOne=str_replace("@#46",$this->FormatView($vlv047_1,20),$vLineOne);
		$vLineOne=str_replace("@#47",$this->FormatView($vlv048_1,20),$vLineOne);
		$vLineOne=str_replace("@#48",$this->FormatView($vlv084_1,20),$vLineOne);
		$vLineOne=str_replace("@#49",$this->FormatView($vlv083_1,20),$vLineOne);
		$vLineOne=str_replace("@#50",$this->FormatView($vlv050_1,20),$vLineOne);
		$strTrH=$strTrH.$vLineOne;
		$vLineOne=$vTRBold;
		$vLineOne=str_replace("@#01",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#02",'Tổng cộng:',$vLineOne);
		$vLineOne=str_replace("@#03",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#04",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#05",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#06",'&nbsp;',$vLineOne);
		$vLineOne=str_replace("@#07",$this->FormatView($vlv015_0,20),$vLineOne);
		$vLineOne=str_replace("@#08",$this->FormatView($vlv016_0,20),$vLineOne);
		$vLineOne=str_replace("@#09",$this->FormatView($vlv017_0,20),$vLineOne);
		$vLineOne=str_replace("@#10",$this->FormatView($vlv018_0,20),$vLineOne);
		$vLineOne=str_replace("@#11",$this->FormatView($vlv079_0,20),$vLineOne);
		$vLineOne=str_replace("@#12",$this->FormatView($vlv013_0,20),$vLineOne);
		
		$vLineOne=str_replace("@#13",$this->FormatView($vlv006_0,20),$vLineOne);
		$vLineOne=str_replace("@#14",$this->FormatView($vlv019_0,20),$vLineOne);
		$vLineOne=str_replace("@#15",$this->FormatView($vlv082_0,20),$vLineOne);
		$vLineOne=str_replace("@#16",'',$vLineOne);
		$vLineOne=str_replace("@#17",$this->FormatView($vlv023_0,20),$vLineOne);
		$vLineOne=str_replace("@#18",$this->FormatView($vlv025_0,20),$vLineOne);
		$vLineOne=str_replace("@#19",$this->FormatView($vlv020_0,20),$vLineOne);
		$vLineOne=str_replace("@#20",$this->FormatView($vlv019_0+$vlv082_0,20),$vLineOne);
		$vLineOne=str_replace("@#21",$this->FormatView($vlv024_0,20),$vLineOne);
		$vLineOne=str_replace("@#22",$this->FormatView($vlv027_0,20),$vLineOne);
		$vLineOne=str_replace("@#23",$this->FormatView($vlv028_0,20),$vLineOne);
		$vLineOne=str_replace("@#24",$this->FormatView($vlv029_0,20),$vLineOne);
		$vLineOne=str_replace("@#25",$this->FormatView($vlv077_0,20),$vLineOne);
		$vLineOne=str_replace("@#26",$this->FormatView($vlv078_0,20),$vLineOne);
		$vLineOne=str_replace("@#27",$this->FormatView($vlv030_0,20),$vLineOne);
		$vLineOne=str_replace("@#28",$this->FormatView($vlv031_0,20),$vLineOne);
		$vLineOne=str_replace("@#29",$this->FormatView($vlv032_0,20),$vLineOne);
		$vLineOne=str_replace("@#30",$this->FormatView($vlv033_0,20),$vLineOne);
		$vLineOne=str_replace("@#31",$this->FormatView($vlv033_0-$vlv025_0,20),$vLineOne);
		$vLineOne=str_replace("@#32",$this->FormatView($vlv034_0,20),$vLineOne);
		$vLineOne=str_replace("@#33",$this->FormatView($vlv080_0,20),$vLineOne);
		
		$vLineOne=str_replace("@#34",$this->FormatView($vlv036_0,20),$vLineOne);
		$vLineOne=str_replace("@#35",$this->FormatView($vlv038_0,20),$vLineOne);
		$vLineOne=str_replace("@#36",$this->FormatView($vlv037_0,20),$vLineOne);
		$vLineOne=str_replace("@#37",$this->FormatView($vlv039_0,20),$vLineOne);
		$vLineOne=str_replace("@#38",$this->FormatView($vlv040_0,20),$vLineOne);
		$vLineOne=str_replace("@#39",$this->FormatView($vlv042_0,20),$vLineOne);
		$vLineOne=str_replace("@#40",$this->FormatView($vlv041_0,20),$vLineOne);
		$vLineOne=str_replace("@#41",$this->FormatView($vlv043_0,20),$vLineOne);
		$vLineOne=str_replace("@#42",$this->FormatView($vlv044_0,20),$vLineOne);
		$vLineOne=str_replace("@#43",$this->FormatView($vlv070_0,20),$vLineOne);
		$vLineOne=str_replace("@#44",$this->FormatView($vlv045_0,20),$vLineOne);
		$vLineOne=str_replace("@#45",$this->FormatView($vlv046_0,20),$vLineOne);
		$vLineOne=str_replace("@#46",$this->FormatView($vlv047_0,20),$vLineOne);
		$vLineOne=str_replace("@#47",$this->FormatView($vlv048_0,20),$vLineOne);
		$vLineOne=str_replace("@#48",$this->FormatView($vlv084_0,20),$vLineOne);
		$vLineOne=str_replace("@#49",$this->FormatView($vlv083_0,20),$vLineOne);
		$vLineOne=str_replace("@#50",$this->FormatView($vlv050_0,20),$vLineOne);		
		
		$strTrH=$strTrH.$vLineOne;
		$strTable=str_replace("@#02",'',$lvTable);
		$strTable=str_replace("@#03",$this->getvaluelink('lv058',$strDepart),$strTable);
		$strFullTbl=$strFullTbl.str_replace("@#01",$strTrH,$strTable); 
		return $strFullTbl;	
	}
	//////////////////////Buil list////////////////////
	function LV_BuilListReportOtherNone($lvList,$lvFrom,$lvChkAll,$lvChk,$curRow, $maxRows,$paging,$lvOrderList,$lvSortNum)
	{
		$vExel=($_GET['childfunc']=='excel')?true:false;
		if($vExel==false) $vExel=($_GET['funcexp']=='excel')?true:false;
		
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
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\" >
		@#01
		<tr class=\"lvlineboldtable\"><td colspan='2'>".($this->ArrPush[1000])."</td>@#02</tr>
		</table>
		";
		$lvTdSSTR="<td align=\"left\"   ss:Type=\"String\">=\"@#01\"</td>";
		$lvTdS="<td align=\"right\">@#01</td>";
		$lvTrS="<tr style=\"background:yellow;font-weight:bold;\"><td colspan='2'>".($this->ArrPush[999])."</td>@#02</tr>";
		$lvTrH="<tr class=\"lvhtable\" id=\"CC_Title@999\">			
			@#01
		</tr>
		";
		$lvTr="
		<tr id=\"CC_Title_@88\"></tr>
		<tr class=\"lvlinehtable@01\" onDblClick=\"Show_CC_Title(@88)\">
			@#01
		</tr>
		";
		$lvTrDep="<tr class=\"lvlinehtable@01\">
			<td class=\"lvhtable_1\" colspan=\"3\" align=\"center\"><strong>@#01</strong></td>
		";
		$lvTdHE="<td width=\"@01\" class=\"lvhtable_1\" >&nbsp;</td>";
		$lvTdH="<td width=\"@01\" class=\"lvhtable\">@02</td>";
		$lvTd="<td  class=\"@#04\" align=\"@#05\" style='white-space:nowrap'>@02</td>";
		if($vExel)
			$lvTdString="<td  class=\"@#04\" align=\"@#05\" style='white-space:nowrap'   ss:Type=\"String\">=\"@02\"</td>";
		else
			$lvTdString=$lvTd;
		$sqlS = "SELECT A.*,(A.lv039+A.lv043-A.lv035) lv180,B.lv030 lv503,AA.lv004 DeptID,C.lv007 lv101  FROM tc_lv0021 A inner join tc_lv0064 AA on AA.lv003=A.lv002 and AA.lv002=A.lv060 left join hr_lv0020 B on A.lv002=B.lv001 left join hr_lv0002 C on AA.lv004=C.lv001  WHERE 1=1  ".$this->GetConditionOtherCal()." order by AA.lv004,AA.lv003 LIMIT $curRow, $maxRows";
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		$strH="<td width=\"@01\" class=\"lvhtable\">".($this->ArrPush[1])."</td>";
		
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				if($i>1) $lvTrDep=$lvTrDep.$lvTdHE;
			}
		$lvTrDep=$lvTrDep."</tr>";	
		$strDepart="";	
		$AllOrder=0;
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			$AllOrder++;
			$vrow['lv058']=$vrow['DeptID'];
			if(strpos($strDepart,$vrow['DeptID'].'')===false && $strDepart!="")
			{
			$strSumBuil="";
			for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv097':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv097,13),$lvTdS);
						break;
					case 'lv096':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv096,13),$lvTdS);
						break;
					case 'lv095':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv095,13),$lvTdS);
						break;
					case 'lv094':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv094,13),$lvTdS);
						break;
					case 'lv093':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv093,13),$lvTdS);
						break;
					case 'lv092':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv092,13),$lvTdS);
						break;
					case 'lv091':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv091,13),$lvTdS);
						break;
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv090,13),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv089,13),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv088,13),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv087,13),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv086,13),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv085,13),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv084,13),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv083,13),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv082,13),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv080,13),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv079,13),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv078,13),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv077,13),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv076,13),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv075,13),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv055,13),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv054,13),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv053,13),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv052,13),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv051,13),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv050,13),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv049,13),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv048,13),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv047,13),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv046,13),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv045,13),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv044,13),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv043,13),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv042,13),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv041,13),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv040,13),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv039,13),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv038,13),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv037,13),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv036,13),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv035,13),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv034,13),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv033,13),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv031,13),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv029,13),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv028,13),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv027,13),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv026,13),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv025,13),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv024,13),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv023,13),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv022,13),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv021,13),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv020,13),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv019,13),$lvTdS);
						break;						
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv018,13),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv017,13),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv015,13),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv014,13),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv013,13),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv012,13),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv011,13),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv010,13),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv009,13),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv008,13),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv006,13),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
			$strTr=$strTr.str_replace("@#02",$strSumBuil,$lvTrS);
			//$strTr=$strTr.$strSumBuilHD;
			//$strSumBuilHD="";
			$deplv097=0;
			$deplv096=0;
			$deplv095=0;
			$deplv094=0;
			$deplv093=0;
			$deplv092=0;
			$deplv091=0;
			$deplv090=0;
			$deplv089=0;
			$deplv088=0;
			$deplv087=0;
			$deplv086=0;
			$deplv085=0;
			$deplv084=0;
			$deplv083=0;
			$deplv082=0;
			
			$deplv080=0;
			$deplv055=0;//$deplv055+$vrow['lv055'];
			$deplv054=0;//$deplv054+$vrow['lv053'];
			$deplv053=0;//$deplv053+$vrow['lv053'];
			$deplv052=0;//$deplv052+$vrow['lv052'];
			$deplv051=0;//$deplv051+$vrow['lv051'];
			$deplv050=0;//$deplv050+$vrow['lv050'];
			$deplv049=0;//$deplv049+$vrow['lv049'];
			$deplv048=0;//$deplv048+$vrow['lv048'];
			$deplv047=0;//$deplv047+$vrow['lv047'];
			$deplv046=0;//$deplv046+$vrow['lv046'];
			$deplv045=0;//$deplv045+$vrow['lv045'];
			$deplv044=0;//$deplv044+$vrow['lv044'];
			$deplv043=0;//$deplv043+$vrow['lv043'];
			$deplv042=0;//$deplv042+$vrow['lv042'];
			$deplv041=0;//$deplv041+$vrow['lv041'];
			$deplv040=0;//$deplv040+$vrow['lv040'];
			$deplv039=0;//$deplv039+$vrow['lv039'];
			$deplv038=0;//$deplv038+$vrow['lv038'];
			$deplv037=0;//$deplv037+$vrow['lv037'];
			$deplv036=0;//$deplv036+$vrow['lv036'];
			$deplv035=0;//$deplv035+$vrow['lv035'];
			$deplv034=0;//$deplv034+$vrow['lv034'];
			$deplv033=0;//$deplv033+$vrow['lv033'];
			$deplv032=0;//$deplv032+$vrow['lv032'];
			$deplv031=0;//$deplv031+$vrow['lv031'];
			$deplv029=0;//$deplv029+$vrow['lv029'];
			$deplv028=0;//$deplv028+$vrow['lv028'];
			$deplv026=0;//$deplv026+$vrow['lv026'];
			$deplv027=0;//$deplv027+$vrow['lv027'];
			$deplv025=0;//$deplv025+$vrow['lv025'];
			$deplv024=0;//$deplv024+$vrow['lv024'];
			$deplv023=0;//$deplv023+$vrow['lv023'];
			$deplv022=0;//$deplv022+$vrow['lv022'];
			$deplv021=0;//$deplv021+$vrow['lv021'];			
			$deplv020=0;//$deplv020+$vrow['lv020'];
			$deplv019=0;//$deplv019+$vrow['lv019'];		
			$deplv018=0;//$deplv018+$vrow['lv018'];
			$deplv017=0;//$deplv017+$vrow['lv017'];
			$deplv016=0;//$deplv016+$vrow['lv016'];
			$deplv015=0;//$deplv015+$vrow['lv015'];
			$deplv014=0;//$deplv014+$vrow['lv014'];
			$deplv013=0;//$deplv013+$vrow['lv013'];
			$deplv012=0;//$deplv012+$vrow['lv012'];
			$deplv011=0;//$deplv011+$vrow['lv011'];
			$deplv010=0;//$deplv010+$vrow['lv010'];
			$deplv009=0;//$deplv009+$vrow['lv009'];
			$deplv008=0;//$deplv008+$vrow['lv008'];
			$deplv007=0;//$deplv007+$vrow['lv007'];
			$deplv006=0;//$deplv006+$vrow['lv006'];
			$deplv075=0;
			$deplv076=0;
			$deplv077=0;
			$deplv078=0;
			$deplv079=0;
			$deplv180=0;
			}
			$deplv180=$deplv180+$vrow['lv180'];
			$deplv097=$deplv097+$vrow['lv097'];
			$deplv096=$deplv096+$vrow['lv096'];
			$deplv095=$deplv095+$vrow['lv095'];
			$deplv094=$deplv094+$vrow['lv094'];
			$deplv093=$deplv093+$vrow['lv093'];
			$deplv092=$deplv092+$vrow['lv092'];
			$deplv091=$deplv091+$vrow['lv091'];
			$deplv090=$deplv090+$vrow['lv090'];
			$deplv089=$deplv089+$vrow['lv089'];
			$deplv088=$deplv088+$vrow['lv088'];
			$deplv087=$deplv087+$vrow['lv087'];
			$deplv086=$deplv086+$vrow['lv086'];
			$deplv085=$deplv085+$vrow['lv085'];
			$deplv084=$deplv084+$vrow['lv084'];
			$deplv083=$deplv083+$vrow['lv083'];
			$deplv082=$deplv082+$vrow['lv082'];

			$deplv080=$deplv080+$vrow['lv080'];
			$deplv079=$deplv079+$vrow['lv079'];
			$deplv078=$deplv078+$vrow['lv078'];
			$deplv077=$deplv077+$vrow['lv077'];
			$deplv076=$deplv076+$vrow['lv076'];
			$deplv075=$deplv075+$vrow['lv075'];
			$deplv055=$deplv055+$vrow['lv055'];
			$deplv054=$deplv054+$vrow['lv054'];
			$deplv053=$deplv053+$vrow['lv053'];
			$deplv052=$deplv052+$vrow['lv052'];
			$deplv051=$deplv051+$vrow['lv051'];
			$deplv050=$deplv050+$vrow['lv050'];
			$deplv049=$deplv049+$vrow['lv049'];
			$deplv048=$deplv048+$vrow['lv048'];
			$deplv047=$deplv047+$vrow['lv047'];
			$deplv046=$deplv046+$vrow['lv046'];
			$deplv045=$deplv045+$vrow['lv045'];
			$deplv044=$deplv044+$vrow['lv044'];
			$deplv043=$deplv043+$vrow['lv043'];
			$deplv042=$deplv042+$vrow['lv042'];
			$deplv041=$deplv041+$vrow['lv041'];
			$deplv040=$deplv040+$vrow['lv040'];
			$deplv039=$deplv039+$vrow['lv039'];
			$deplv038=$deplv038+$vrow['lv038'];
			$deplv037=$deplv037+$vrow['lv037'];
			$deplv036=$deplv036+$vrow['lv036'];
			$deplv035=$deplv035+$vrow['lv035'];
			$deplv034=$deplv034+$vrow['lv034'];
			$deplv033=$deplv033+$vrow['lv033'];
			$deplv032=$deplv032+$vrow['lv032'];
			$deplv031=$deplv031+$vrow['lv031'];
			$deplv029=$deplv029+$vrow['lv029'];
			$deplv028=$deplv028+$vrow['lv028'];
			$deplv026=$deplv026+$vrow['lv026'];
			$deplv027=$deplv027+$vrow['lv027'];
			$deplv025=$deplv025+$vrow['lv025'];
			$deplv024=$deplv024+$vrow['lv024'];
			$deplv023=$deplv023+$vrow['lv023'];
			$deplv022=$deplv022+$vrow['lv022'];
			$deplv021=$deplv021+$vrow['lv021'];			
			$deplv020=$deplv020+$vrow['lv020'];
			$deplv019=$deplv019+$vrow['lv019'];		
			$deplv018=$deplv018+$vrow['lv018'];
			$deplv017=$deplv017+$vrow['lv017'];
			$deplv016=$deplv016+$vrow['lv016'];
			$deplv015=$deplv015+$vrow['lv015'];
			$deplv014=$deplv014+$vrow['lv014'];
			$deplv013=$deplv013+$vrow['lv013'];
			$deplv012=$deplv012+$vrow['lv012'];
			$deplv011=$deplv011+$vrow['lv011'];
			$deplv010=$deplv010+$vrow['lv010'];
			$deplv009=$deplv009+$vrow['lv009'];
			$deplv008=$deplv008+$vrow['lv008'];
			//$deplv007=$deplv007+$vrow['lv007'];
			$deplv006=$deplv006+$vrow['lv006'];
			
			$vlv180=$vlv180+$vrow['lv180'];
			$vlv097=$vlv097+$vrow['lv097'];
			$vlv096=$vlv096+$vrow['lv096'];
			$vlv095=$vlv095+$vrow['lv095'];
			$vlv094=$vlv094+$vrow['lv094'];
			$vlv093=$vlv093+$vrow['lv093'];
			$vlv092=$vlv092+$vrow['lv092'];
			$vlv091=$vlv091+$vrow['lv091'];
			$vlv090=$vlv090+$vrow['lv090'];
			$vlv089=$vlv089+$vrow['lv089'];
			$vlv088=$vlv088+$vrow['lv088'];
			$vlv087=$vlv087+$vrow['lv087'];
			$vlv086=$vlv086+$vrow['lv086'];
			$vlv085=$vlv085+$vrow['lv085'];
			$vlv084=$vlv084+$vrow['lv084'];
			$vlv083=$vlv083+$vrow['lv083'];
			$vlv082=$vlv082+$vrow['lv082'];

			$vlv080=$vlv080+$vrow['lv080'];
			$vlv079=$vlv079+$vrow['lv079'];
			$vlv078=$vlv078+$vrow['lv078'];
			$vlv077=$vlv077+$vrow['lv077'];
			$vlv076=$vlv076+$vrow['lv076'];
			$vlv075=$vlv075+$vrow['lv075'];
			$vlv055=$vlv055+$vrow['lv055'];
			$vlv054=$vlv054+$vrow['lv054'];
			$vlv053=$vlv053+$vrow['lv053'];
			$vlv052=$vlv052+$vrow['lv052'];
			$vlv051=$vlv051+$vrow['lv051'];
			$vlv050=$vlv050+$vrow['lv050'];
			$vlv049=$vlv049+$vrow['lv049'];
			$vlv048=$vlv048+$vrow['lv048'];
			$vlv047=$vlv047+$vrow['lv047'];
			$vlv046=$vlv046+$vrow['lv046'];
			$vlv045=$vlv045+$vrow['lv045'];
			$vlv044=$vlv044+$vrow['lv044'];
			$vlv043=$vlv043+$vrow['lv043'];
			$vlv042=$vlv042+$vrow['lv042'];
			$vlv041=$vlv041+$vrow['lv041'];
			$vlv040=$vlv040+$vrow['lv040'];
			$vlv039=$vlv039+$vrow['lv039'];
			$vlv038=$vlv038+$vrow['lv038'];
			$vlv037=$vlv037+$vrow['lv037'];
			$vlv036=$vlv036+$vrow['lv036'];
			$vlv035=$vlv035+$vrow['lv035'];
			$vlv034=$vlv034+$vrow['lv034'];
			$vlv033=$vlv033+$vrow['lv033'];
			$vlv032=$vlv032+$vrow['lv032'];
			$vlv031=$vlv031+$vrow['lv031'];
			$vlv029=$vlv029+$vrow['lv029'];
			$vlv028=$vlv028+$vrow['lv028'];
			$vlv026=$vlv026+$vrow['lv026'];
			$vlv027=$vlv027+$vrow['lv027'];
			$vlv025=$vlv025+$vrow['lv025'];
			$vlv024=$vlv024+$vrow['lv024'];
			$vlv023=$vlv023+$vrow['lv023'];
			$vlv022=$vlv022+$vrow['lv022'];
			$vlv021=$vlv021+$vrow['lv021'];			
			$vlv020=$vlv020+$vrow['lv020'];
			$vlv019=$vlv019+$vrow['lv019'];		
			$vlv018=$vlv018+$vrow['lv018'];
			$vlv017=$vlv017+$vrow['lv017'];
			$vlv016=$vlv016+$vrow['lv016'];
			$vlv015=$vlv015+$vrow['lv015'];
			$vlv014=$vlv014+$vrow['lv014'];
			$vlv013=$vlv013+$vrow['lv013'];
			$vlv012=$vlv012+$vrow['lv012'];
			$vlv011=$vlv011+$vrow['lv011'];
			$vlv010=$vlv010+$vrow['lv010'];
			$vlv009=$vlv009+$vrow['lv009'];
			$vlv008=$vlv008+$vrow['lv008'];
			//$vlv007=$vlv007+$vrow['lv007'];
			$vlv006=$vlv006+$vrow['lv006'];
			
			if(strpos($strDepart,$vrow['DeptID'].'')===false)
			{
				$vorder=1;
				$strDepart=$strDepart.$vrow['DeptID']."@";
				$strSumBuilHD=str_replace("@#01",$this->getvaluelink("lv096",$vrow['DeptID']),$lvTrDep);
			}
				$vTemp1=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vorder,10)),$this->Align($lvTd,10));
			for($i=0;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					
					case 'lv058':
						if(strpos($strDepart,$vrow['DeptID'].'')===false || $vorder==1)
						{
						
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
							$strDepart=$strDepart.$vrow['DeptID']."@";
						}
						else
						{
							$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView('',(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						}
						break;
					case 'lv002':
					case 'lv061':
							//$vnote=rnd(1)
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView("".$vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTdString,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv003':
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow['lv503'],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
					case 'lv101':
						$vCodeKT=$this->LV_GetCodeKT($vrow['lv101'],$vrow['DeptID']);
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vCodeKT,(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;		
					case 'lv007':
						if($this->option==1)
						{
						$vTemp=str_replace("@02",unicode_to_none($this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]]))),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
						}
					default:
					
						$vTemp=str_replace("@02",$this->getvaluelink($lstArr[$i],$this->FormatView($vrow[$lstArr[$i]],(int)$this->ArrView[$lstArr[$i]])),$this->Align($lvTd,(int)$this->ArrView[$lstArr[$i]]));
						break;
				}
				$strL=$strL.$vTemp;
			}

			$strTr=$strTr.$strSumBuilHD;
			$strSumBuilHD="";
			$strTr=$strTr.str_replace("@88",$AllOrder,str_replace("@#01",$vTemp1.$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr)))));
			if($vrow['lv007']==1)		$strTr=str_replace("@#04","",$strTr);
			
		}
		$strSumBuil="";
		for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv180':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv180,13),$lvTdS);
						break;
					case 'lv097':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv097,13),$lvTdS);
						break;
					case 'lv096':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv096,13),$lvTdS);
						break;
					case 'lv095':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv095,13),$lvTdS);
						break;
					case 'lv094':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv094,13),$lvTdS);
						break;
					case 'lv093':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv093,13),$lvTdS);
						break;
					case 'lv092':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv092,13),$lvTdS);
						break;
					case 'lv091':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv091,13),$lvTdS);
						break;
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv090,13),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv089,13),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv088,13),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv087,13),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv086,13),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv085,13),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv084,13),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv083,13),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv082,13),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv080,13),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv079,13),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv078,13),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv077,13),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv076,13),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv075,13),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv055,13),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv054,13),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv053,13),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv052,13),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv051,13),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv050,13),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv049,13),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv048,13),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv047,13),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv046,13),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv045,13),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv044,13),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv043,13),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv042,13),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv041,13),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv040,13),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv039,13),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv038,13),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv037,13),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv036,13),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv035,13),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv034,13),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv033,13),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv032,13),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv031,13),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv030,13),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv029,13),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv028,13),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv027,13),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv026,13),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv025,13),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv024,13),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv023,13),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv022,13),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv021,13),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv020,13),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv019,13),$lvTdS);
						break;						
					
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv018,13),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv017,13),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv015,13),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv014,13),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv013,13),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv012,13),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv011,13),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv010,13),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv009,13),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv008,13),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($deplv006,13),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
		$strTr=$strTr.str_replace("@#02",$strSumBuil,$lvTrS);
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		/*$strTable=str_replace("@#lv029",$this->FormatView($vlv029,13),$lvTable);
		$strTable=str_replace("@#lv028",$this->FormatView($vlv028,13),$strTable);
		$strTable=str_replace("@#lv027",$this->FormatView($vlv027,13),$strTable);
		$strTable=str_replace("@#lv019",$this->FormatView($vlv019,13),$strTable);
		$strTable=str_replace("@#lv025",$this->FormatView($vlv025,13),$strTable);
		$strTable=str_replace("@#lv024",$this->FormatView($vlv024,10),$strTable);
		$strTable=str_replace("@#lv017",$this->FormatView($vlv017,13),$strTable);
		$strTable=str_replace("@#lv022",$this->FormatView($vlv022,13),$strTable);
		$strTable=str_replace("@#lv016",$this->FormatView($vlv016,10),$strTable);
		$strTable=str_replace("@#lv015",$this->FormatView($vlv015,13),$strTable);
		$strTable=str_replace("@#lv014",$this->FormatView($vlv014,13),$strTable);
		$strTable=str_replace("@#lv013",$this->FormatView($vlv013,13),$strTable);
		$strTable=str_replace("@#lv012",$this->FormatView($vlv012,13),$strTable);
		$strTable=str_replace("@#lv011",$this->FormatView($vlv011,13),$strTable);
		$strTable=str_replace("@#lv010",$this->FormatView($vlv010,13),$strTable);
		$strTable=str_replace("@#lv009",$this->FormatView($vlv009,13),$strTable);
		$strTable=str_replace("@#lv008",$this->FormatView($vlv008,13),$strTable);
		$strTable=str_replace("@#lv007",$this->FormatView($vlv007,13),$strTable);
		$strTable=str_replace("@#lv006",$this->FormatView($vlv006,13),$strTable);*/
		$strSumBuil="";
		for($i=1;$i<count($lstArr);$i++)
			{
				switch($lstArr[$i])
				{
					case 'lv180':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv180,13),$lvTdS);
						break;
					case 'lv097':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv097,13),$lvTdS);
						break;
					case 'lv096':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv096,13),$lvTdS);
						break;
					case 'lv095':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv095,13),$lvTdS);
						break;
					case 'lv094':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv094,13),$lvTdS);
						break;
					case 'lv093':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv093,13),$lvTdS);
						break;
					case 'lv092':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv092,13),$lvTdS);
						break;
					case 'lv091':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv091,13),$lvTdS);
						break;
					case 'lv090':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv090,13),$lvTdS);
						break;
					case 'lv089':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv089,13),$lvTdS);
						break;
					case 'lv088':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv088,13),$lvTdS);
						break;
					case 'lv087':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv087,13),$lvTdS);
						break;
					case 'lv086':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv086,13),$lvTdS);
						break;
					case 'lv085':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv085,13),$lvTdS);
						break;
					case 'lv084':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv084,13),$lvTdS);
						break;
					case 'lv083':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv083,13),$lvTdS);
						break;
					case 'lv082':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv082,13),$lvTdS);
						break;
					case 'lv080':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv080,13),$lvTdS);
						break;
					case 'lv079':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv079,13),$lvTdS);
						break;
					case 'lv078':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv078,13),$lvTdS);
						break;
					case 'lv077':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv077,13),$lvTdS);
						break;
					case 'lv076':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv076,13),$lvTdS);
						break;
					case 'lv075':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv075,13),$lvTdS);
						break;
					case 'lv055':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv055,13),$lvTdS);
						break;
					case 'lv054':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv054,13),$lvTdS);
						break;
					case 'lv053':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv053,13),$lvTdS);
						break;
					case 'lv052':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv052,13),$lvTdS);
						break;
					case 'lv051':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv051,13),$lvTdS);
						break;
					case 'lv050':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv050,13),$lvTdS);
						break;
					case 'lv049':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv049,13),$lvTdS);
						break;
					case 'lv048':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv048,13),$lvTdS);
						break;
					case 'lv047':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv047,13),$lvTdS);
						break;
					case 'lv046':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv046,13),$lvTdS);
						break;
					case 'lv045':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv045,13),$lvTdS);
						break;
					case 'lv044':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv044,13),$lvTdS);
						break;
					case 'lv043':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv043,13),$lvTdS);
						break;
					case 'lv042':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv042,13),$lvTdS);
						break;
					case 'lv041':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv041,13),$lvTdS);
						break;
					case 'lv040':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv040,13),$lvTdS);
						break;
					case 'lv039':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv039,13),$lvTdS);
						break;
					case 'lv038':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv038,13),$lvTdS);
						break;
					case 'lv037':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv037,13),$lvTdS);
						break;
					case 'lv036':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv036,13),$lvTdS);
						break;
					case 'lv035':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv035,13),$lvTdS);
						break;
					case 'lv034':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv034,13),$lvTdS);
						break;
					case 'lv033':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv033,13),$lvTdS);
						break;
					case 'lv032':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv032,13),$lvTdS);
						break;
					case 'lv031':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv031,13),$lvTdS);
						break;
					case 'lv030':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv030,13),$lvTdS);
						break;
					case 'lv029':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv029,13),$lvTdS);
						break;
					case 'lv028':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv028,13),$lvTdS);
						break;
					case 'lv027':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv027,13),$lvTdS);
						break;
					case 'lv026':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv026,13),$lvTdS);
						break;
					case 'lv025':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv025,13),$lvTdS);
						break;
					case 'lv024':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv024,13),$lvTdS);
						break;
					case 'lv023':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv023,13),$lvTdS);
						break;
					case 'lv022':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv022,13),$lvTdS);
						break;
					case 'lv021':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv021,13),$lvTdS);
						break;	
					case 'lv020':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv020,13),$lvTdS);
						break;	
					case 'lv019':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv019,13),$lvTdS);
						break;
					case 'lv018':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv018,13),$lvTdS);
						break;
					case 'lv017':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv017,13),$lvTdS);
						break;
					case 'lv016':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv016,10),$lvTdS);
						break;
					case 'lv015':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv015,13),$lvTdS);
						break;
					case 'lv014':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv014,13),$lvTdS);
						break;
					case 'lv013':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv013,13),$lvTdS);
						break;
					case 'lv012':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv012,13),$lvTdS);
						break;
					case 'lv011':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv011,13),$lvTdS);
						break;
					case 'lv010':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv010,13),$lvTdS);
						break;
					case 'lv009':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv009,13),$lvTdS);
						break;
					case 'lv008':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv008,13),$lvTdS);
						break;
					case 'lv006':
						$strSumBuil=$strSumBuil.str_replace("@#01",$this->FormatView($vlv006,13),$lvTdS);
						break;
					default:
						$strSumBuil=$strSumBuil.str_replace("@#01","&nbsp;",$lvTdS);
						break;
				}
			}
			$strTable=str_replace("@#02",$strSumBuil,$lvTable);
		return str_replace("@#01",$strTrH.$strTr,$strTable);
	}
	

	function LV_GETHSOK($vDepartment,$vCalID,&$hsok,&$tanggiamhso)
	{
		$vsql="select BB.lv006 hsok,BB.lv004 tanggiamhso from tc_lv0031 BB where BB.lv003='".$vDepartment."' and BB.lv002='".$vCalID."' limit 0,1";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$hsok=(float)$vrow['hsok'];
			$tanggiamhso=(float)$vrow['tanggiamhso'];
		}
	}
	function TinhCongTheoNgay($vDepartment,$vyear,$vmonth,$vrate,$vCalID)
	{
		if($this->ArrDepartment["$vDepartment"][0]['value']==true) return;
		$vListEmp=$this->LV_GetListEmp("'".$vDepartment."'",'lv001');
		if($vListEmp=="") $vListEmp="''";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vNumDay=GetDayInMonth($vyear,$vmonth);
		$tanggiamhso=0;
		$hesok=0;
		//$this->LV_GETHSOK($vDepartment,$vCalID,$hesok,$tanggiamhso);
		for($i=1;$i<=$vNumDay;$i++)
		{
			$vDay=$vyear."-".Fillnum($vmonth,2)."-".Fillnum($i,2);
			if($vsql=="")
				$vsql="select $i stt, A.lv004 ngaytinh,sum(IF(A.lv011='$vDepartment',A.lv006,(IF(ISNULL(C.lv007),0,(IF(ISNULL(D.lv004),IF(A.lv007='AD',C.lv007*0.77,C.lv007),IF(A.lv007='AD',C.lv007*0.77,C.lv007)*D.lv004/100)))))) tonghesocong,count(A.lv007) tongcong,(select sum(IF(ISNULL(DD.lv006*EE.lv004),0,DD.lv006*EE.lv004)) from tc_lv0026 DD left join tc_lv0015 EE on DD.lv005=EE.lv003 and EE.lv002='$vCalID' where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=0 and DD.lv012='$vDepartment' AND DD.lv011=1) TongTien,(select sum(IF(ISNULL(DD.lv006),0,DD.lv006)) from tc_lv0026 DD  where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=1 and DD.lv012='$vDepartment'  AND DD.lv011=1) TongCongNgoai,$hesok hesok,$tanggiamhso tanggiamconglv   from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 and C.lv003='$vmonth' and C.lv004='$vyear' left join tc_lv0025 D on C.lv008=D.lv001 and D.lv002='".$vCalID."' where A1.lv100<>1 And A.lv004='$vDay' and ( (A.lv002 in ($vListCalendar) AND (A.lv011='' or ISNULL(A.lv011))) or A.lv011='$vDepartment') and A.lv007 in ('1','2','3','11','22','33','U','H','AD')";
			else
				$vsql=$vsql." union
				select $i stt, A.lv004 ngaytinh,sum(IF(A.lv011='$vDepartment',A.lv006,(IF(ISNULL(C.lv007),0,(IF(ISNULL(D.lv004),IF(A.lv007='AD',C.lv007*0.77,C.lv007),IF(A.lv007='AD',C.lv007*0.77,C.lv007)*D.lv004/100)))))) tonghesocong,count(A.lv007) tongcong,(select sum(IF(ISNULL(DD.lv006*EE.lv004),0,DD.lv006*EE.lv004)) from tc_lv0026 DD left join tc_lv0015 EE on DD.lv005=EE.lv003 and EE.lv002='$vCalID' where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=0 and DD.lv012='$vDepartment' AND DD.lv011=1) TongTien,(select sum(IF(ISNULL(DD.lv006),0,DD.lv006)) from tc_lv0026 DD  where DD.lv004=A.lv004 and DD.lv003='$vCalID' and DD.lv013=1 and DD.lv012='$vDepartment'  AND DD.lv011=1) TongCongNgoai,$hesok hesok,$tanggiamhso tanggiamconglv   from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 left join tc_lv0009 C on B.lv002=C.lv002 and C.lv003='$vmonth' and C.lv004='$vyear' left join tc_lv0025 D on C.lv008=D.lv001 and D.lv002='".$vCalID."' where A.lv100<>1 And A.lv004='$vDay' and ((A.lv002 in ($vListCalendar) AND (A.lv011='' or ISNULL(A.lv011))) or A.lv011='$vDepartment')  and A.lv007 in ('1','2','3','11','22','33','U','H','AD')";
		}
			$this->ArrDepartment["$vDepartment"][0]['value']=true;
			$vresult=db_query($vsql);
			$this->ArrDepartment["$vDepartment"][0]['log']='<p style="cursor:pointer" onclick=document.getElementById("logto").style.display="block">Lương tổ(phòng ban) từng ngày :</p><div id=logto style="display:none">';
			while($vrow=db_fetch_array($vresult))
			{
				$i=$vrow['stt'];
				$this->ArrDepartment["$vDepartment"][$i]['ngaytinh']=$vrow['ngaytinh'];
				$this->ArrDepartment["$vDepartment"][$i]['hesok']=$vrow['hesok'];
				$this->ArrDepartment["$vDepartment"][$i]['tonghesocong']=$vrow['tonghesocong'];
				$this->ArrDepartment["$vDepartment"][$i]['tongcong']=$vrow['tongcong'];
				$this->ArrDepartment["$vDepartment"][$i]['TongTien']=$vrow['TongTien'];
				$this->ArrDepartment["$vDepartment"][$i]['ngaytinh']=$vrow['ngaytinh'];
				$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv']=$vrow['tanggiamconglv'];
				$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']=$vrow['TongCongNgoai'];
				$this->ArrDepartment["$vDepartment"][0][$vrow['MaCong']]=(int)$this->ArrDepartment["$vDepartment"][0][$vrow['MaCong']]+1;
				
				if($this->ArrDepartment["$vDepartment"][$i]['tongcong']>0)
				{
					if($this->ArrDepartment["$vDepartment"][$i]['hesok']==0) $this->ArrDepartment["$vDepartment"][$i]['hesok']=1;
					$this->ArrDepartment["$vDepartment"][$i]['TienPhongBan']=round($this->ArrDepartment["$vDepartment"][$i]['TongTien']*$this->ArrDepartment["$vDepartment"][$i]['tongcong']*$this->ArrDepartment["$vDepartment"][$i]['hesok']/($this->ArrDepartment["$vDepartment"][$i]['tongcong']+$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']+$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv']),0);
					$this->ArrDepartment["$vDepartment"][0]['TienPhongBan']=$this->ArrDepartment["$vDepartment"][0]['TienPhongBan']+$this->ArrDepartment["$vDepartment"][$i]['TienPhongBan'];
					$this->ArrDepartment["$vDepartment"][0]['log']=$this->ArrDepartment["$vDepartment"][0]['log']."ngày $i:".$this->ArrDepartment["$vDepartment"][$i]['TongTien']."*".$this->ArrDepartment["$vDepartment"][$i]['tongcong']."*".$this->ArrDepartment["$vDepartment"][$i]['hesok']."/".($this->ArrDepartment["$vDepartment"][$i]['tongcong']+$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']+$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv'])."=".(round($this->ArrDepartment["$vDepartment"][$i]['TongTien']*$this->ArrDepartment["$vDepartment"][$i]['tongcong']*$this->ArrDepartment["$vDepartment"][$i]['hesok']/($this->ArrDepartment["$vDepartment"][$i]['tongcong']+$this->ArrDepartment["$vDepartment"][$i]['TongCongNgoai']+$this->ArrDepartment["$vDepartment"][$i]['tanggiamconglv']),0))."<br/>";
				}
			}
			$this->ArrDepartment["$vDepartment"][0]['log']=$this->ArrDepartment["$vDepartment"][0]['log']."</div>";
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
				$vstt++;
			}
			$vEndNumDay=$vendday;
			for($i=1;$i<=$vEndNumDay;$i++)
			{
				$this->vArrDay[$vstt]=$vendyear."-".Fillnum($vendmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		else
		{
			for($i=$vstartday;$i<=$vendday;$i++)
			{
				$this->vArrDay[$vstt]=$vstartyear."-".Fillnum($vstartmonth,2)."-".Fillnum($i,2);
				$vstt++;
			}
		}
		return $this->vArrDay;
	}
	function LV_CheckActiveContractLB($vEmpID,$vstartdate,$venddate,$vCalID,&$vOtherContractID,$vContractID)
	{
	
		$vListEmp="'".$vEmpID."'";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vsql="select A.lv099,SUM(A.lv005) SRTime  from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv100<>1 And ( A.lv004>='$vstartdate' and  A.lv004<='$venddate') and A.lv002 in ($vListCalendar) group by A.lv099 ";
		$vresult=db_query($vsql);
		$vIsHave=false;
		while($vrow=db_fetch_array($vresult))
		{
			if($vContractID==$vrow['lv099'])
			{
				if($vrow['SRTime']>0) return $vContractID; 
			}
			else
				$vOtherContractID=$vrow['lv099'];
		}
		return $vOtherContractID;
	}
	function TinhCongTheoNgayVP_BV($vEmpID,$vstartdate,$venddate,$vrate,$vCalID,&$ArrEmpList,$vContractID,$vNgayLam=-1)
	{
		$vTemArr=null;
		$ArrEmpListPre=null;
		$vListEmp="'".$vEmpID."'";
		$vListCalendar=$this->LV_GetListCalendar($vListEmp,'lv001');
		if($vListCalendar=="") $vListCalendar="''";
		$vArrDay=$this->LV_GetLimitDate($vstartdate,$venddate);
		$hesok=0;
		//$this->LV_GETHSOK($this->mohr_lv0020->lv029,$vCalID,$hesok,$tanggiamhso);
		for($i=1;$i<=count($vArrDay);$i++)
		{
			$vDay=$vArrDay[$i];
			if($this->ArrDaySpecial[0]['state']==false)
			{
				if(GetDayOfWeek($vDay)==7)	$this->ArrDaySpecial[0]['T7']=(int)$this->ArrDaySpecial[0]['T7']+1;
				if(GetDayOfWeek($vDay)==1)	$this->ArrDaySpecial[0]['CN']=(int)$this->ArrDaySpecial[0]['CN']+1;
			}
			if($vsql=="")
				$vsql="select $i stt,DAYOFWEEK(A.lv004) DOWS,A.lv007 MaCong,A.lv008 tiencomtc,A.lv010 tiencom,A.lv004 ngaytinh,A.lv011 DepID,A.lv005 RGTime,A.lv014 TCTime,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TCTimeTrua,A.lv017 TCTimeDEM,A.lv018 TCTimeLe,A.lv022 GioCong,A.lv023 GioBu,A.lv099 ContractID,A.lv021 ProjectID from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv100<>1 And A.lv004='$vDay' and A.lv002 in ($vListCalendar) ";
			else
				$vsql=$vsql." union
				       select $i stt,DAYOFWEEK(A.lv004) DOWS, A.lv007 MaCong,A.lv008 tiencomtc,A.lv010 tiencom,A.lv004 ngaytinh,A.lv011 DepID,A.lv005 RGTime,A.lv014 TCTime,IF(ISNULL(A.lv016),'00:00:00',A.lv016) TCTimeTrua,A.lv017 TCTimeDEM,A.lv018 TCTimeLe,A.lv022 GioCong,A.lv023 GioBu,A.lv099 ContractID,A.lv021 ProjectID from tc_lv0011 A left join tc_lv0010 B on A.lv002=B.lv001 where A.lv100<>1 And A.lv004='$vDay' and A.lv002 in ($vListCalendar)";
		}
		$this->ArrDaySpecial[0]['state']=true;
		$vresult=db_query($vsql);
		$vContinue=1;
		$ArrEmpList["$vEmpID"][0]['TINHTS']=true;
		$ArrEmpList["$vEmpID"][0]['ISTS']=false;
		$vt=0;
		$vIsC=false;
		$this->isSameHD=0;
		$SoLanKhac=0;
		$SoLanGiong=0;
		$this->isABC=0;
		$this->isPCCT=0;
		$isABC=0;
		while($vrow=db_fetch_array($vresult))
		{
			if($vNgayLam!=13 || ($vNgayLam==13 && $vrow['DOWS']!=1))
			{
				if($vt==0)
				{
					$vContractID=$vrow['ContractID'];
					if($this->mohr_lv0038->lv001!=$vContractID)
					{
						$vIsC=true;
						$vPreContractID=$vContractID;				
					}	
				}				
				if($vContractID!=$vrow['ContractID'])
				{
					$SoLanKhac++;
					 $vContinue=$this->LV_ConfirmHD($vContractID,$vrow['ContractID'],$isABC,$isPCCT);
					 if($isABC==2) $this->isABC=2;
					 if($isPCCT==2) $this->isPCCT=2;
					 if($vContinue) $SoLanGiong++;
					 $this->isSameHD=$vContinue;
				}
				$vContractID=$vrow['ContractID'];
				if($vContinue==1)
				{
					$i=$vrow['stt'];
					$vGioLam=$this->GetTime($this->mohr_lv0038->lv007);
					if($vGioLam==0) $vGioLam=8;
					$vTimeLate=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeLate'];
					$vTimeSoon=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['TimeSoon'];
					$vGIOTANGCA=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCA'];
					$vGIOTANGCACN=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCACN'];
					$vGIOTANGCADEM=$this->ArrTCEmp[$this->ArrEmp[$i][0]]['GIOTANGCADEM'];
					
					$ArrEmpList["$vEmpID"][$i]['value']=true;
					$ArrEmpList["$vEmpID"][$i]['DepID']=$vrow['DepID'];
					$ArrEmpList["$vEmpID"][$i]['HSCV']=$vrow['hscv'];
					$ArrEmpList["$vEmpID"][$i]['MaCong']=$vrow['MaCong'];
					$ArrEmpList["$vEmpID"][$i]['ngaytinh']=$vrow['ngaytinh'];
					$ArrEmpList["$vEmpID"][$i]['hesok']=$vrow['hesok'];		
					$ArrEmpList["$vEmpID"][0]['ContractID']=$vrow['ContractID'];
					$vSoGioTC=$this->GetTime(TIMEADD($vrow['TCTime'],$vrow['TCTimeDEM']));
					if($vSoGioTC>=1.5)
					{
						$ArrEmpList["$vEmpID"][0]['TC_LON_1_5H']=(int)$ArrEmpList["$vEmpID"][0]['TC_LON_1_5H']+1;
					}
					if($vSoGioTC>=2)
					{
						if($vSoGioTC<=4)
							$ArrEmpList["$vEmpID"][0]['TC_NHO_2H']=(int)$ArrEmpList["$vEmpID"][0]['TC_NHO_2H']+1;
						else
							$ArrEmpList["$vEmpID"][0]['TC_LON_2H']=(int)$ArrEmpList["$vEmpID"][0]['TC_LON_2H']+1;

					}
					if($vrow['MaCong']!='L' && $vrow['MaCong']!='P' && $vrow['MaCong']!='0.5P' && $vrow['MaCong']!='B' && $vrow['MaCong']!='HL')
					{
						if($vrow['DOWS']==1)
						{
							$ArrEmpList["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['CNTime'],$vrow['RGTime']);			
							$ArrEmpList["$vEmpID"][0]['CNTimeS']=$ArrEmpList["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['CNTimeH'],$vrow['RGTime']);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpList["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['RGTime'],$vrow['RGTime']);			
							$ArrEmpList["$vEmpID"][0]['RGTimeS']=$ArrEmpList["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['RGTimeH'],$vrow['RGTime']);
						}
						else
						{
							$ArrEmpList["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['PJTime'],$vrow['RGTime']);			
							$ArrEmpList["$vEmpID"][0]['PJTimeS']=$ArrEmpList["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['PJTimeH'],$vrow['RGTime']);
						}
					}
					elseif($vrow['MaCong']=='0.5P' && $vrow['RGTime']!='04:00:00' && $vrow['RGTime']>'04:00:00')
					{
						$vTimeAgain=TIMEADD($vrow['RGTime'],'-04:00:00');
						if($vrow['DOWS']==1)
						{
							$ArrEmpList["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['CNTime'],$vTimeAgain);			
							$ArrEmpList["$vEmpID"][0]['CNTimeS']=$ArrEmpList["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['CNTimeH'],$vTimeAgain);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpList["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['RGTime'],$vTimeAgain);			
							$ArrEmpList["$vEmpID"][0]['RGTimeS']=$ArrEmpList["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['RGTimeH'],$vTimeAgain);
						}
						else
						{
							$ArrEmpList["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpList["$vEmpID"][0]['PJTime'],$vTimeAgain);			
							$ArrEmpList["$vEmpID"][0]['PJTimeS']=$ArrEmpList["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpList["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpList["$vEmpID"][0]['PJTimeH'],$vTimeAgain);
						}
					}
					$ArrEmpList["$vEmpID"][0]['GioCong']= TIMEADD($ArrEmpList["$vEmpID"][0]['GioCong'],$vrow['GioCong']);
					$ArrEmpList["$vEmpID"][0]['GioBu']= TIMEADD($ArrEmpList["$vEmpID"][0]['GioBu'],$vrow['GioBu']);

					$ArrEmpList["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpList["$vEmpID"][0]['TC150'],$vrow['TCTime']);			
					$ArrEmpList["$vEmpID"][0]['TC150S']=$ArrEmpList["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTime'])/$vGioLam,2);			
					
					$ArrEmpList["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpList["$vEmpID"][0]['TC150'],$vrow['TCTimeTrua']);			
					$ArrEmpList["$vEmpID"][0]['TC150S']=$ArrEmpList["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTimeTrua'])/$vGioLam,2);			
					
					$ArrEmpList["$vEmpID"][0]['TC200']= TIMEADD($ArrEmpList["$vEmpID"][0]['TC200'],$vrow['TCTimeDEM']);			
					$ArrEmpList["$vEmpID"][0]['TC200S']=$ArrEmpList["$vEmpID"][0]['TC200S']+round($this->GetTime($vrow['TCTimeDEM'])/$vGioLam,2);			
					
					$ArrEmpList["$vEmpID"][0]['TC300']=TIMEADD($ArrEmpList["$vEmpID"][0]['TC300'],$vrow['TCTimeLe']);
					$ArrEmpList["$vEmpID"][0]['TC300S']=$ArrEmpList["$vEmpID"][0]['TC300S']+round($this->GetTime($vrow['TCTimeLe'])/$vGioLam,2);		
					if($vrow['DOWS']!=1)
						{
							if($vrow['MaCong']=='O')
							{
								$ArrEmpList["$vEmpID"][0]['NGAYKHONGLAM']=(int)$ArrEmpList["$vEmpID"][0]['NGAYKHONGLAM']+1;
							}
						}
					switch($vrow['MaCong'])
					{
						case 'SS':
							if(str_replace(":","",$vrow['RGTime'])>=40000) $ArrEmpList["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
						case '*':
							if($ArrEmpList["$vEmpID"][0]['ISTS']==false) $ArrEmpList["$vEmpID"][0]['TS_NGAYTINH']=getday($vrow['ngaytinh']);
							$ArrEmpList["$vEmpID"][0]['ISTS']=true;
							if(getday($vrow['ngaytinh'])<=15) $ArrEmpList["$vEmpID"][0]['TINHTS']=false;
							break;
						case 'SL':
							$ArrEmpList["$vEmpID"][0]['ISSL']=true;
							break;
						default:
							/*if($this->MaxLe[$vrow['ngaytinh']]==true)
							{
								if($vrow['MaCong']=='VP' || $vrow['MaCong']=='CT')  $ArrEmpList["$vEmpID"][0]['L']=(int)$ArrEmpList["$vEmpID"][0]['L']+1;
							}*/
							$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpList["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
					}
					if((int)$ArrEmpList["$vEmpID"][0]['hesok']==0) $ArrEmpList["$vEmpID"][0]['hesok']=$vrow['hesok'];
					if($vrow['tiencom']!=1)
						$ArrEmpList["$vEmpID"][0]['tiencom']=(int)$ArrEmpList["$vEmpID"][0]['tiencom']+1;	
					else
						$ArrEmpList["$vEmpID"][0]['tiencoman']=(int)$ArrEmpList["$vEmpID"][0]['tiencoman']+1;	
					if($vrow['tiencomtc']!=1)
						$ArrEmpList["$vEmpID"][0]['tiencomtc']=(int)$ArrEmpList["$vEmpID"][0]['tiencomtc']+1;	
					else
						$ArrEmpList["$vEmpID"][0]['tiencomtcan']=(int)$ArrEmpList["$vEmpID"][0]['tiencomtcan']+1;	
					
				}
				else
				{
					
					$i=$vrow['stt'];
					$ArrEmpListPre["$vEmpID"][$i]['value']=true;
					$ArrEmpListPre["$vEmpID"][$i]['DepID']=$vrow['DepID'];
					$ArrEmpListPre["$vEmpID"][$i]['HSCV']=$vrow['hscv'];
					$ArrEmpListPre["$vEmpID"][$i]['MaCong']=$vrow['MaCong'];
					$ArrEmpListPre["$vEmpID"][$i]['ngaytinh']=$vrow['ngaytinh'];
					$ArrEmpListPre["$vEmpID"][$i]['hesok']=$vrow['hesok'];		
					$ArrEmpListPre["$vEmpID"][0]['ContractID']=$vrow['ContractID'];
					$vSoGioTC=$this->GetTime(TIMEADD($vrow['TCTime'],$vrow['TCTimeDEM']));
					if($vSoGioTC>=1.5)
					{
						$ArrEmpListPre["$vEmpID"][0]['TC_LON_1_5H']=(int)$ArrEmpListPre["$vEmpID"][0]['TC_LON_1_5H']+1;
					}
					if($vSoGioTC>2)
					{
						if($vSoGioTC<=4)
							$ArrEmpListPre["$vEmpID"][0]['TC_NHO_2H']=(int)$ArrEmpListPre["$vEmpID"][0]['TC_NHO_2H']+1;
						else
							$ArrEmpListPre["$vEmpID"][0]['TC_LON_2H']=(int)$ArrEmpListPre["$vEmpID"][0]['TC_LON_2H']+1;

					}
					if($vrow['MaCong']!='L' && $vrow['MaCong']!='P' && $vrow['MaCong']!='0.5P'  && $vrow['MaCong']!='B' && $vrow['MaCong']!='HL')
					{
						if($vrow['DOWS']==1)
						{
							$ArrEmpListPre["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTime'],$vrow['RGTime']);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeS']=$ArrEmpListPre["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTimeH'],$vrow['RGTime']);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpListPre["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTime'],$vrow['RGTime']);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeS']=$ArrEmpListPre["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTimeH'],$vrow['RGTime']);
						}
						else
						{
							$ArrEmpListPre["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTime'],$vrow['RGTime']);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeS']=$ArrEmpListPre["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vrow['RGTime'])/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTimeH'],$vrow['RGTime']);
						}
					}
					elseif($vrow['MaCong']=='0.5P' && $vrow['RGTime']!='04:00:00' && $vrow['RGTime']>'04:00:00')
					{
						$vTimeAgain=TIMEADD($vrow['RGTime'],'-04:00:00');
						if($vrow['DOWS']==1)
						{
							$ArrEmpListPre["$vEmpID"][0]['CNTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTime'],$vTimeAgain);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeS']=$ArrEmpListPre["$vEmpID"][0]['CNTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['CNTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['CNTimeH'],$vTimeAgain);
						}
						if($vrow['MaCong']!='CT' && ($vrow['ProjectID']==NULL || $vrow['ProjectID']=='VP' || trim($vrow['ProjectID'])==''))
						{
							$ArrEmpListPre["$vEmpID"][0]['RGTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTime'],$vTimeAgain);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeS']=$ArrEmpListPre["$vEmpID"][0]['RGTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['RGTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['RGTimeH'],$vTimeAgain);
						}
						else
						{
							$ArrEmpListPre["$vEmpID"][0]['PJTime']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTime'],$vTimeAgain);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeS']=$ArrEmpListPre["$vEmpID"][0]['PJTimeS']+round($this->GetTime($vTimeAgain)/$vGioLam,2);			
							$ArrEmpListPre["$vEmpID"][0]['PJTimeH']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['PJTimeH'],$vTimeAgain);
						}
					}
					$ArrEmpListPre["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC150'],$vrow['TCTime']);			
					$ArrEmpListPre["$vEmpID"][0]['TC150S']=$ArrEmpListPre["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTime'])/$vGioLam,2);			
					
					$ArrEmpListPre["$vEmpID"][0]['TC150']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC150'],$vrow['TCTimeTrua']);			
					$ArrEmpListPre["$vEmpID"][0]['TC150S']=$ArrEmpListPre["$vEmpID"][0]['TC150S']+round($this->GetTime($vrow['TCTimeTrua'])/$vGioLam,2);			
					
					$ArrEmpListPre["$vEmpID"][0]['TC200']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC200'],$vrow['TCTimeDEM']);			
					$ArrEmpListPre["$vEmpID"][0]['TC200S']=$ArrEmpListPre["$vEmpID"][0]['TC200S']+round($this->GetTime($vrow['TCTimeDEM'])/$vGioLam,2);			
					
					$ArrEmpListPre["$vEmpID"][0]['TC300']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TC300'],$vrow['TCTimeLe']);
					$ArrEmpListPre["$vEmpID"][0]['TC300S']=$ArrEmpListPre["$vEmpID"][0]['TC300S']+round($this->GetTime($vrow['TCTimeLe'])/$vGioLam,2);
				
					if($vrow['DOWS']!=1)
						{
							if($vrow['MaCong']=='O')
							{
								$ArrEmpListPre["$vEmpID"][0]['NGAYKHONGLAM']=(int)$ArrEmpListPre["$vEmpID"][0]['NGAYKHONGLAM']+1;
							}
						}
					$ArrEmpListPre["$vEmpID"][0]['TCTimeTrua']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TCTimeTrua'],$vrow['TCTimeTrua']);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeTruaS']=$ArrEmpListPre["$vEmpID"][0]['TCTimeTruaS']+round($this->GetTime($vrow['TCTimeTrua'])/8,2);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeDEM']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TCTimeDEM'],$vrow['TCTimeDEM']);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeDEMS']=$ArrEmpListPre["$vEmpID"][0]['TCTimeDEMS']+round($this->GetTime($vrow['TCTimeTrua'])/8,2);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeLe']=TIMEADD($ArrEmpListPre["$vEmpID"][0]['TCTimeLe'],$vrow['TCTimeLe']);
					$ArrEmpListPre["$vEmpID"][0]['TCTimeLeS']=$ArrEmpListPre["$vEmpID"][0]['TCTimeLeS']+round($this->GetTime($vrow['TCTimeLe'])/$vGioLam,2);

					$ArrEmpListPre["$vEmpID"][0]['GioCong']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['GioCong'],$vrow['GioCong']);
					$ArrEmpListPre["$vEmpID"][0]['GioBu']= TIMEADD($ArrEmpListPre["$vEmpID"][0]['GioBu'],$vrow['GioBu']);
					switch($vrow['MaCong'])
					{
						case 'SS':
							if(str_replace(":","",$vrow['RGTime'])>=40000) $ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
						case '*':
							if($ArrEmpList["$vEmpID"][0]['ISTS']==false) 
							{
								$ArrEmpList["$vEmpID"][0]['TS_NGAYTINH']=getday($vrow['ngaytinh']);
								$ArrEmpListPre["$vEmpID"][0]['TS_NGAYTINH']=$ArrEmpList["$vEmpID"][0]['TS_NGAYTINH'];
							}
							break;
						default:
							/*if($this->MaxLe[$vrow['ngaytinh']]==true)
							{
								if($vrow['MaCong']=='VP' || $vrow['MaCong']=='CT')  $ArrEmpListPre["$vEmpID"][0]['L']=(int)$ArrEmpListPre["$vEmpID"][0]['L']+1;
							}*/
							$ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]=(int)$ArrEmpListPre["$vEmpID"][0][$vrow['MaCong']]+1;
							break;
					}
					if((int)$ArrEmpListPre["$vEmpID"][0]['hesok']==0) $ArrEmpListPre["$vEmpID"][0]['hesok']=$vrow['hesok'];
					if($vrow['tiencom']!=1)
						$ArrEmpListPre["$vEmpID"][0]['tiencom']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencom']+1;	
					else
						$ArrEmpListPre["$vEmpID"][0]['tiencoman']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencoman']+1;	
					if($vrow['tiencomtc']!=1)
						$ArrEmpListPre["$vEmpID"][0]['tiencomtc']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencomtc']+1;	
					else
						$ArrEmpListPre["$vEmpID"][0]['tiencomtcan']=(int)$ArrEmpListPre["$vEmpID"][0]['tiencomtcan']+1;	
				}
			$vt++;
			}
		}
		//echo "if($SoLanKhac!=$SoLanGiong) $this->isSameHD=0; $this->isABC";
		if($SoLanKhac!=$SoLanGiong)
		{
			if($this->isABC==2) $this->isRateTwo=true;
			if($this->isPCCT==2) $this->isPCCTTwo=true;
			$this->isSameHD=0;
		} 
		if($vIsC==true)
		{
			if( $ArrEmpListPre["$vEmpID"][0]['RGTimeS']>0 )
			{
				$vTemArr=$ArrEmpList;
				$ArrEmpList=$ArrEmpListPre;
				$ArrEmpListPre=$vTemArr;
				$this->mohr_lv0038->LV_LoadActivePre($vPreContractID);
			}
		}
		return $ArrEmpListPre;
		
	}
	function LV_ConfirmHD($vContractID,$vOldContractID,&$vABC=0,&$vPCCT=0)
	{
		if($this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][0]==1) return $this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1];
		$this->ContractCompare['T'.$vContractID.','.$vOldContractID][0]=1;
		$vrow1=$this->LV_GetHD($vContractID);
		$vrow2=$this->LV_GetHD($vOldContractID);
		if($vrow1['lv013']==$vrow2['lv013'] && $vrow1['lv013']>0)
		{
			$vABC=1;
		}
		else
		{
			if($vrow1['lv013']>0 && $vrow2['lv013']>0)
			{
				$vABC=2;		
			}	
		}
		if($vrow1['lv023']==$vrow2['lv023'] && $vrow1['lv023']>0)
		{
			$vPCCT=1;
		}
		else
		{
			if($vrow1['lv023']>0 && $vrow2['lv023']>0)
			{
				$vPCCT=2;		
			}	
		}
		if($vrow1['lv022']==$vrow2['lv022'] && $vrow1['lv021']==$vrow2['lv021'] && $vrow1['lv013']==$vrow2['lv013'] && $vrow1['lv014']==$vrow2['lv014'] && $vrow1['lv016']==$vrow2['lv016'] && $vrow1['lv026']==$vrow2['lv026']  && $vrow1['lv018']==$vrow2['lv018'] && $vrow1['lv020']==$vrow2['lv020'] && $vrow1['lv023']==$vrow2['lv023'] && $vrow1['lv025']==$vrow2['lv025'] && $vrow1['lv026']==$vrow2['lv026'] )
		$this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1]=1;
		else
		$this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1]=0;
		return $this->ContractCompare['T'.$vContractID.'-'.$vOldContractID][1];
	}
	function LV_GetListEmp($vDepartment,$vField)
	{
		$vsql="select $vField from hr_lv0020 where lv029 in ($vDepartment)";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			return $strReturn;
		}
	}
	function LV_GetHD($vConTractID)
	{
		$vsql="select lv011,lv012,lv013,lv014,lv015,lv016,lv017,lv018,lv019,lv020,lv021,lv022,lv023,lv024,lv025,lv026 from hr_lv0038 where lv001='$vConTractID'";
		$vresult=db_query($vsql);
		$strReturn="";
		return db_fetch_array($vresult);
	}
	function LV_GetTongHeCong($vObjCal)
	{
		$vsql="select lv003 from tc_lv0031 where lv002='".$vObjCal->lv001."' and lv007=1";
		$vresult=db_query($vsql);
		$strReturn="";
		while($vrow=db_fetch_array($vresult))
		{
			if($strReturn=="") $strReturn="'".$vrow['lv003']."'";
				else $strReturn=$strReturn.",'".$vrow['lv003']."'";
		}
		$vListEmp=$this->LV_GetListEmp($strReturn,'lv001');
		if($vListEmp=="") return 0;
		$vsql="select sum(lv007) sumcong from tc_lv0009 where lv003='".$vObjCal->lv006."' and lv004='".$vObjCal->lv007."' and lv002 in ($vListEmp) ";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)		return $vrow['sumcong'];
		return 0;		
	}
	function LV_GetPriceProduct($vCalculateTimesID,$ItemID)
	{
		$vsql="select lv004 from tc_lv0015 where lv002='$vCalculateTimesID' and lv003='$ItemID'";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)		return $vrow['lv004'];
		return 0;
	}
	function LV_GetRateEmp($vCalDate)
	{
		$this->RateEmp=Array();
		$vsql="select A.* from tc_lv0062 A inner join tc_lv0061 B on A.lv002=B.lv001 where '$vCalDate'>=B.lv003 and '$vCalDate'<=B.lv004 and B.lv008>=1";
		$vresult=db_query($vsql);
		$strReturn="";
		while($vrow=db_fetch_array($vresult))
		{
			$this->RateEmp[$vrow['lv003']][0]=$vrow['lv004'];
			$this->RateEmp[$vrow['lv003']][1]=$vrow['lv005'];
		}
	}
	function LV_GetChenhLechCT($vPercent,$vACB,$vCurABC)
	{
		return ($vACB-$vCurABC)*$vPercent;
	}
	function LV_GetPercenPCCT($vLuong,$vABC,$vPCCT)
	{
		return $vPercent=$vPCCT/($vLuong+$vABC);
	}
	function Calculate($vObjCal,$vEmployeeID,$vTypeCalculate,$salaryitem,$heso,$salarydepartment,$totalnumtime,$departmentid,$vrate=0,$vPetrol,$vStateBonus=0)
	{		
		$this->lv002=$vEmployeeID;
		$this->lv003=GetServerDate();
		$this->lv004=$vObjCal->lv004;
		$this->lv005=$vObjCal->lv005;
		$this->LV_GetRateEmp($vObjCal->lv004);
		$this->mohr_lv0038->LV_LoadActive($vEmployeeID);
		if($this->mohr_lv0038->lv001==NULL) echo '<font color="red">Không có hợp đồng cho phép tính lương</font>';
		$this->motc_lv0008->LV_LoadCurrentID($vEmployeeID,$vObjCal->lv005);
		$vConfirmContractID=$this->LV_CheckActiveContractLB($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vObjCal->lv001,$vOtherContractID,$this->mohr_lv0038->lv001);
		if($this->mohr_lv0038->lv001!=$vConfirmContractID )
		{
			if($vConfirmContractID!="" && $vConfirmContractID!=NULL)
				$this->mohr_lv0038->LV_LoadID($vConfirmContractID);
			else
				echo '<font color="red">'.$vEmployeeID.' : Không có hợp đồng cho phép tính lương hoặc không có công</font><br/>';
		}
		$vTypeCalculate=$this->mohr_lv0038->lv012;
		$this->lv060=$vObjCal->lv001;
		$this->lv081=$vTypeCalculate;
		$this->TotalTCGiamThue=0;
		$this->TotalNghi=0;
		$this->isTamUng=0;
		$this->ACBPercentNext=0;
		$this->lv019_=0;
		$this->lv025__=0;
		$this->lv025_==0;
		$this->lv035_=0;
		$sday=getyear($this->mohr_lv0020->lv030);
		$smonth=getmonth($this->mohr_lv0020->lv030);
		$syear=getyear($this->mohr_lv0020->lv030);
		$this->isRateTwo=false;
		$this->isPCCTTwo=false;
		if($smonth==$vObjCal->lv006 && $syear==$vObjCal->lv007)
		{
			if($sday!=1) $this->isRateTwo=true;
		}
		switch($vTypeCalculate)
		{
			case 0:
			case 1:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) $this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
					{
						$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];						
						if($vContractID!="" && $vContractID!=NULL)
						{
							$this->mohr_lv0038->LV_LoadActivePre($vContractID);
							if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0)  
							{
								switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,2,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
								}
								
							}
						}
					}
					else
					{
						$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
						if($vContractID!="" && $vContractID!=NULL)
						{
							$this->mohr_lv0038->LV_LoadActivePre($vContractID);
							if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0)
							{
								switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
								}
							}								//$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
						}
					}
					
				}
				break;
			case 2:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0)  $this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
					if($vContractID!="" && $vContractID!=NULL)
					{
						$this->mohr_lv0038->LV_LoadActivePre($vContractID);
						if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0)
						{
							switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
								}
						}
							//$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
					}
				}
				break;
			case 3:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) $this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
					if($vContractID!="" && $vContractID!=NULL)
					{
						$this->mohr_lv0038->LV_LoadActivePre($vContractID);
						if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) 
						{
							switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
								}
						}	
							//$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
					}
				}
				break;
			case 4:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) $this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
					if($vContractID!="" && $vContractID!=NULL)
					{
						$this->mohr_lv0038->LV_LoadActivePre($vContractID);
						if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) 
						{
							switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
								}
						}	
							//$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
					}
				}
				break;
			case 5:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) $this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
					if($vContractID!="" && $vContractID!=NULL)
					{
						$this->mohr_lv0038->LV_LoadActivePre($vContractID);
						if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) 
						{
							switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									
								}
						}	
							//$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
					}
				}
				break;
			case 6:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) $this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
					if($vContractID!="" && $vContractID!=NULL)
					{
						$this->mohr_lv0038->LV_LoadActivePre($vContractID);
						if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) 
						{
							switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									
								}
						}	
							//$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
					}
				}
				break;
			case 7:
				if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) $this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,0,$vArrEmpPre);
				if($vArrEmpPre!=NULL)
				{
					$vContractID=$vArrEmpPre["$vEmployeeID"][0]['ContractID'];
					if($vContractID!="" && $vContractID!=NULL)
					{
						$this->mohr_lv0038->LV_LoadActivePre($vContractID);
						if($this->mohr_lv0038->lv022!=0 || $this->mohr_lv0038->lv023!=0 || $this->mohr_lv0038->lv025!=0 || $this->mohr_lv0038->lv033!=0 || $this->mohr_lv0038->lv013!=0) 
						{
							switch($this->mohr_lv0038->lv012)
								{
									case 0:
									case 1:
										$this->CaculateSalaryNone($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 2:
										$this->CaculateSalaryLamThem($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 3:
										$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;
									case 4:
										$this->CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 5:
										$this->CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 6:
										$this->CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
									case 7:
										$this->CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
										break;	
								}
						}	
							//$this->CaculateSalaryOneDay($vObjCal,$vEmployeeID,$this->mohr_lv0038->lv011,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus,1,$vArrEmpPre);
					}
				}
				break;
		}
	}
	function CalPITAgain($vObjCal,$vEmpID)
	{
		$vsql="select * from tc_lv0021 where lv002='".$vEmpID."' and lv060='".$vObjCal->lv001."' and lv063=0";
		$vresult=db_query($vsql);
		$vSumPIT=0;
		while($vrow=db_fetch_array($vresult))
		{
			//$this->lv070=$this->lv033-$this->lv044+$this->lv034-$this->lv043;
			//Cập nhật lại PIT;
		}
		//$this->lv045=$this->GetTax($this->lv070);
	}
	function CaculateSalaryTimeCal($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
		
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		$this->lv036=0;
		$this->lv037=0;
		$this->lv038=0;
		$this->lv040=0;
		$this->lv041=0;
		$this->lv042=0;
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
		}
		$this->lv039=0;
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=false;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=0;
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		///Tổng công làm việc
		$this->lv025=round($vTimeWork+$vTimeWorkCT-$this->lv019,2);
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
		//if($this->isRateTwo)
		//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		//else
			$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*($vABCPercen/100);
		//Tiền ăn ca
		$this->lv052=$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			$this->lv075=$this->mohr_lv0038->lv025;		
			//Phụ cấp công trình
			$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		//Check các ngày nghỉ.
		$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương thực tính
		$this->lv078=$this->mohr_lv0038->lv032;
		//Luong CN
		$this->lv028=$this->lv078*$this->lv019*2;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		
		//Tiền phép chưa nghỉ hết
		$this->lv029=0;
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		
		//Nghỉ lễ & Phép -----
		$this->lv023=0;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv079)*$this->lv025/$this->lv012,0);
//		echo "($this->lv079)*$vNgayCongTinh/$this->lv012";
		$this->lv024=ROUND(($this->lv078)*$this->lv025,0);
		//Phu cap ca dem
		//Tăng ca thường
		$this->lv020=ROUND($this->lv078*($this->lv015)/8*1.5,0);
		$this->lv020_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		//Tăng 200%
		$this->lv021=ROUND($this->lv078*($this->lv016)/8*2,0);
		$this->lv021_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		$this->lv022=ROUND($this->lv078*($this->lv017)/8*3,0);
		$this->lv022_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		//Adward Bonus	
		if($vPrev==0)
		{
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv027=0;			
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=0;
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_1_5H'];
			$this->lv092=$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$this->lv033=$this->lv092+$this->lv028+$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}
		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		if($this->lv070>0)
		{
			if($this->lv100!="VND") 
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
				$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
			}
			else
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
				$this->lv045=ROUND($this->GetTax($this->lv070),0);
			}
		}
		else
		{
			$this->lv045=0;
		}
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025+$this->lv019)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
	}
	function CaculateSalaryTimeCalTC1Le15($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
		
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		$this->lv036=0;
		$this->lv037=0;
		$this->lv038=0;
		$this->lv040=0;
		$this->lv041=0;
		$this->lv042=0;
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
		}
		$this->lv039=0;
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=false;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=0;
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		///Tổng công làm việc
		$this->lv025=round($vTimeWork+$vTimeWorkCT-$this->lv019,2);
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
		//if($this->isRateTwo)
		//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		//else
			$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*($vABCPercen/100);
		//Tiền ăn ca
		$this->lv052=$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			$this->lv075=$this->mohr_lv0038->lv025;		
			//Phụ cấp công trình
			$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		//Check các ngày nghỉ.
		$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương thực tính
		$this->lv078=$this->mohr_lv0038->lv032;
		//Luong CN
		$this->lv028=$this->lv078*$this->lv019*1;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		
		//Tiền phép chưa nghỉ hết
		$this->lv029=0;
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		
		//Nghỉ lễ & Phép -----
		$this->lv023=0;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv079)*$this->lv025/$this->lv012,0);
//		echo "($this->lv079)*$vNgayCongTinh/$this->lv012";
		$this->lv024=ROUND(($this->lv078)*$this->lv025,0);
		//Phu cap ca dem
		//Tăng ca thường
		$this->lv020=ROUND($this->lv078*($this->lv015)/8*1,0);
		$this->lv020_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		//Tăng 200%
		$this->lv021=ROUND($this->lv078*($this->lv016)/8*1,0);
		$this->lv021_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		$this->lv022=ROUND($this->lv078*($this->lv017)/8*1.5,0);
		$this->lv022_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		//Adward Bonus	
		if($vPrev==0)
		{
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv027=0;			
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=0;
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_1_5H'];
			$this->lv092=$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$this->lv033=$this->lv092+$this->lv028+$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}
		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			//echo "$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue=";
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		if($this->lv070>0)
		{
			if($this->lv100!="VND") 
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
				$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
			}
			else
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
				$this->lv045=ROUND($this->GetTax($this->lv070),0);
			}
		}
		else
		{
			$this->lv045=0;
		}
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025+$this->lv019)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
	}
	function CaculateSalaryTimeCalTC1($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
		
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		$this->lv036=0;
		$this->lv037=0;
		$this->lv038=0;
		$this->lv040=0;
		$this->lv041=0;
		$this->lv042=0;
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
		}
		$this->lv039=0;
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=false;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=0;
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		///Tổng công làm việc
		$this->lv025=round($vTimeWork+$vTimeWorkCT-$this->lv019,2);
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
		//if($this->isRateTwo)
		//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		//else
			$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*($vABCPercen/100);
		//Tiền ăn ca
		$this->lv052=$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			$this->lv075=$this->mohr_lv0038->lv025;		
			//Phụ cấp công trình
			$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		//Check các ngày nghỉ.
		$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương thực tính
		$this->lv078=$this->mohr_lv0038->lv032;
		//Luong CN
		$this->lv028=$this->lv078*$this->lv019*1;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		
		//Tiền phép chưa nghỉ hết
		$this->lv029=0;
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		
		//Nghỉ lễ & Phép -----
		$this->lv023=0;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv079)*$this->lv025/$this->lv012,0);
//		echo "($this->lv079)*$vNgayCongTinh/$this->lv012";
		$this->lv024=ROUND(($this->lv078)*$this->lv025,0);
		//Phu cap ca dem
		//Tăng ca thường
		$this->lv020=ROUND($this->lv078*($this->lv015)/8*1,0);
		$this->lv020_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		//Tăng 200%
		$this->lv021=ROUND($this->lv078*($this->lv016)/8*1,0);
		$this->lv021_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		$this->lv022=ROUND($this->lv078*($this->lv017)/8*1,0);
		$this->lv022_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		//Adward Bonus	
		if($vPrev==0)
		{
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv027=0;			
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=0;
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_1_5H'];
			$this->lv092=$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$this->lv033=$this->lv092+$this->lv028+$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}
		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			//echo "$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue=";
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		if($this->lv070>0)
		{
			if($this->lv100!="VND") 
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
				$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
			}
			else
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
				$this->lv045=ROUND($this->GetTax($this->lv070),0);
			}
		}
		else
		{
			$this->lv045=0;
		}
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025+$this->lv019)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
	}
	function CaculateSalaryTimeCalPercent($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
		
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		$this->lv036=0;
		$this->lv037=0;
		$this->lv038=0;
		$this->lv040=0;
		$this->lv041=0;
		$this->lv042=0;
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
		}
		$this->lv039=0;
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=false;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=0;
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		///Tổng công làm việc
		$this->lv025=round($vTimeWork+$vTimeWorkCT-$this->lv019,2);
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
		//if($this->isRateTwo)
		//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		//else
			$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*($vABCPercen/100);
		//Tiền ăn ca
		$this->lv052=$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			$this->lv075=$this->mohr_lv0038->lv025;		
			//Phụ cấp công trình
			$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		//Check các ngày nghỉ.
		$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương thực tính
		$this->lv078=$this->mohr_lv0038->lv032;
		//Luong CN
		$this->lv028=$this->lv078*$this->lv019*1;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		
		//Tiền phép chưa nghỉ hết
		$this->lv029=0;
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		
		//Nghỉ lễ & Phép -----
		$this->lv023=0;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv079)*$this->lv025/$this->lv012,0);
//		echo "($this->lv079)*$vNgayCongTinh/$this->lv012";
		$this->lv024=ROUND(($this->lv078)*$this->lv025,0);
		//Phu cap ca dem
		//Tăng ca thường
		$this->lv020=ROUND($this->lv078*($this->lv015)/8*1.5,0);
		$this->lv020_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		//Tăng 200%
		$this->lv021=ROUND($this->lv078*($this->lv016)/8*2,0);
		$this->lv021_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		$this->lv022=ROUND($this->lv078*($this->lv017)/8*3,0);
		$this->lv022_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		//Adward Bonus	
		if($vPrev==0)
		{
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv027=0;			
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=0;
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_1_5H'];
			$this->lv092=$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$this->lv033=$this->lv092+$this->lv028+$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}
		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			//echo "$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue=";
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		if($this->lv070>0)
		{
			if($this->lv100!="VND") 
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
				$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
			}
			else
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
				$this->lv045=ROUND($this->GetTax($this->lv070),0);
			}
		}
		else
		{
			$this->lv045=0;
		}
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025+$this->lv019)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
	}
	function CaculateSalaryOneDay($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
		
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		$this->lv036=0;
		$this->lv037=0;
		$this->lv038=0;
		$this->lv040=0;
		$this->lv041=0;
		$this->lv042=0;
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
		}
		$this->lv039=0;
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=false;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=0;
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		///Tổng công làm việc
		$this->lv025=round($vTimeWork+$vTimeWorkCT-$this->lv019,2);
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
		//if($this->isRateTwo)
		//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		//else
			$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*($vABCPercen/100);
		//Tiền ăn ca
		$this->lv052=$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			$this->lv075=$this->mohr_lv0038->lv025;		
			//Phụ cấp công trình
			$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		//Check các ngày nghỉ.
		$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương thực tính
		$this->lv078=$this->mohr_lv0038->lv032;
		//Luong CN
		$this->lv028=$this->lv078*$this->lv019*1.5;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		
		//Tiền phép chưa nghỉ hết
		$this->lv029=0;
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		
		//Nghỉ lễ & Phép -----
		$this->lv023=0;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv079)*$this->lv025/$this->lv012,0);
//		echo "($this->lv079)*$vNgayCongTinh/$this->lv012";
		$this->lv024=ROUND(($this->lv078)*$this->lv025,0);
		//Phu cap ca dem
		//Tăng ca thường
		$this->lv020=ROUND($this->lv078*($this->lv015)/8*1.5,0);
		$this->lv020_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		//Tăng 200%
		$this->lv021=ROUND($this->lv078*($this->lv016)/8*2,0);
		$this->lv021_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		$this->lv022=ROUND($this->lv078*($this->lv017)/8*3,0);
		$this->lv022_=0;//ROUND($this->lv078/$vNgayCongTC/8*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		//Adward Bonus	
		if($vPrev==0)
		{
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv027=0;			
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=0;
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_1_5H'];
			$this->lv092=$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		//Total Earning before Deduction
		//echo "$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$this->lv033=$this->lv092+$this->lv028+$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}
		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			//echo "$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue=";
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue;
		}
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		if($this->lv070>0)
		{
			if($this->lv100!="VND") 
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
				$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
			}
			else
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
				$this->lv045=ROUND($this->GetTax($this->lv070),0);
			}
		}
		else
		{
			$this->lv045=0;
		}
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025+$this->lv019)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
		}
	function GetSalary13TH($vObjCal,$vDateWork,$vBasicSalary)
	{
		$vYear=getyear($vDateWork);
		$vMonth=getmonth($vDateWork);
		$vday=(int)getday($vDateWork);
		if($vYear=$vObjCal->lv007)
		{
			for($i=(int)$vMonth;$i<=12;$i++)
			{
				$vnumdays=$vnumdays+GetDayInMonth($vYear,$i);
			}
			$vnumdays=$vnumdays-$vday+1;
			return $vBasicSalary*$vnumdays/365;
		}
		elseif($vYear<$vObjCal->lv007)
		{
			return $vBasicSalary;
		}
		return 0;
	}
	function LV_SPIManager($vEmployee,$vCalID,$vCongTHuc)
	{
		$vsql="select A.lv001 from hr_lv0020 A where A.lv042='$vEmployee'";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			if($vCongThuc1=="")
				$vCongThuc1=$this->LV_SPIForSaleReady($vrow['lv001'],$vCalID,$vCongTHuc);
			else
				$vCongThuc1=$vCongThuc1.'+'.$this->LV_SPIForSaleReady($vrow['lv001'],$vCalID,$vCongTHuc);
		}
		return $vCongThuc1;
	}
	function LV_SPIForSaleRun($vCongTHuc)
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
		//echo $vCongTHuc2;
		return $this->LV_CheckOperation($vCongTHuc2);
		
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
	function LV_DAYMORUN($vStr)
	{
		$vStr=substr($vStr,1,strlen($vStr)-2);
		return $this->LV_CheckOperation($vStr);
		
	}
	function LV_IFRUN($vStr)
	{	
		$vArStr=explode("(",$vStr,2);//lây IF
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
	function LV_SPIForSaleReady($vEmployee,$vCalID,$vCongThuc)
	{

			$vCongThuc=str_replace("\n\r","",$vCongThuc);
			$vCongThuc=str_replace("\n","",$vCongThuc);
			$vCongThuc=str_replace("\r","",$vCongThuc);
			$vCongThuc1=$vCongThuc;
			$vTimeArr=$this->LV_GetItemArr($vCongThuc,$vEmployee,$vCalID);
			for($i=0;$i<count($vTimeArr);$i++)
			{
				$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
			}
			return $vCongThuc1;
	}
	function LV_SPIForSale($vEmployee,$vCalID,$vTypeOT)
	{
		$vsql="select * from tc_lv0025 where lv002='$vCalID' and lv001='$vTypeOT'";
		$vresult=db_query($vsql);
		$strReturn="";
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vCongThuc=$vrow['lv005'];
			$vCongThuc=str_replace("\n\r","",$vCongThuc);
			$vCongThuc=str_replace("\n","",$vCongThuc);
			$vCongThuc=str_replace("\r","",$vCongThuc);
			
			if(strpos($vCongThuc,"[MANAGER]")===false)
			{
				$vCongThucTong="";
			}
			else
			{
				$vArrCT=explode("#",$vCongThuc,3);
				$vCongThucTong=$vArrCT[1];
				$vLongCongThuc="#".$vArrCT[1]."#";
			}
			if($vCongThucTong!="")
			{
				$vCtyEmp=$this->LV_SPIManager($vEmployee,$vCalID,$vCongThucTong);
				$vCongThuc=str_replace($vLongCongThuc,$vCtyEmp,$vCongThuc);
			}
			
			$vCongThuc1=$vCongThuc;
			$vTimeArr=$this->LV_GetItemArr($vCongThuc,$vEmployee,$vCalID);
			for($i=0;$i<count($vTimeArr);$i++)
			{
				$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
			}
		}
		return $vCongThuc1;
	}
	function LV_GetItemArr($vCongThuc,$vEmployee,$vCalID)
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
					if($vCTC[0]=='SUMQTY')
						{
							$vsql="select sum(lv004/lv010) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv006>0 ";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[SUMQTY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
						}
					else if($vCTC[0]=='SUMMONEY')
						{
							$vsql="select sum(lv004*lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID'  and lv006>0";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[SUMMONEY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
						}
					else if($vCTC[0]=='TARGETQTY')
					{					
							$vsql="select lv005 sumqty from tc_lv0035 where lv003='$vEmployee' and lv002='$vCalID' ";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[TARGETQTY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
					}
					else if($vCTC[0]=='TARGETAMOUNT')
					{					
							$vsql="select lv004 sumqty from tc_lv0035 where lv003='$vEmployee' and lv002='$vCalID' ";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[TARGETAMOUNT]';
							$vReturn[$i]['value']=$vrow['sumqty'];
					}
					else if($vCTC[0]=='DAYOFWORK')
					{
							$vReturn[$i]['name']='[DAYOFWORK]';
							$vReturn[$i]['value']=$this->lv018;
					}
					else
						{
							$vsql="select sum(lv004*lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vCTC[0]."'";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='['.$vCTC[0].']';
							$vReturn[$i]['value']=$vrow['sumqty'];
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
						$vsql="select lv004 sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "PRICE":
						$vsql="select (lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "MONEY":						
						$vsql="select (lv004*lv006) sumqty from sl_lv0014 where lv002='$vEmployee' and lv009='$vCalID' and lv003='".$vDivTC[0]."'";
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
	function LV_GetTimeCardArr($vCongThuc,$vEmployee,$vCalID,$vdaydiv,$vArrEmp)
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
					if($vCTC[0]=='DAYS')
						{
							$vReturn[$i]['name']='[DAYS]';
							$vReturn[$i]['value']=$vdaydiv;
						}
					else if($vCTC[0]=='X')
						{
							$vReturn[$i]['name']='[X]';
							$vReturn[$i]['value']=$this->lv018;
						}
					else if($vCTC[0]=='SUMMONEY')
						{
							$vsql="select sum(lv004*lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID'  and lv006>0";
							$vresult=db_query($vsql);
						
							$vrow=db_fetch_array($vresult);
							$vReturn[$i]['name']='[SUMMONEY]';
							$vReturn[$i]['value']=$vrow['sumqty'];
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
						$vsql="select lv004 sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "PRICE":
						$vsql="select (lv006) sumqty from sl_lv0014 where lv009='$vEmployee' and lv002='$vCalID' and lv003='".$vDivTC[0]."'";
						break;
					case "MONEY":						
						$vsql="select (lv004*lv006) sumqty from sl_lv0014 where lv002='$vEmployee' and lv009='$vCalID' and lv003='".$vDivTC[0]."'";
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
	function LV_TinhPetrol($vEmployee,$vCalID,$vCongThuc,$vdaydiv,$vArrEmp)
	{
			$vCongThuc1=$vCongThuc;
			$vTimeArr=$this->LV_GetTimeCardArr($vCongThuc,$vEmployee,$vCalID,$vdaydiv,$vArrEmp);
			for($i=0;$i<count($vTimeArr);$i++)
			{
				$vCongThuc1=str_replace($vTimeArr[$i]['name'],$vTimeArr[$i]['value'],$vCongThuc1);
			}
		return $this->LV_TinhPetrolRun($vCongThuc1);
	}
	function LV_TinhPetrolRun($vCongTHuc)
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
		//echo "<br>".'Petrol:'.$vCongTHuc2;
		//echo "=".$this->LV_CheckOperation($vCongTHuc2);
		return $this->LV_CheckOperation($vCongTHuc2);
		
	}
	function Get_PetrolParkingMobil($vCalID,$vEmployeeID,$vPetrol,$vdaydiv,$vArrEmp)
	{
		$vReturn=Array();
		if($this->vArrPetrol[$vPetrol]['state']!=true)
		{		
			$vsql="select * from tc_lv0047 where lv001='$vPetrol' and lv002='$vCalID'";
			$vresult=db_query($vsql);
			$vrow=db_fetch_array($vresult);
			if($vrow)		
			{
				$this->vArrPetrol[$vPetrol]['state']=true;
				$this->vArrPetrol[$vPetrol]['petrol']= $vrow['lv004'];
				$this->vArrPetrol[$vPetrol]['parking']= $vrow['lv005'];
				$this->vArrPetrol[$vPetrol]['mobil']= $vrow['lv006'];
			}
		}
		$vRetrun[0]=$this->LV_TinhPetrol($vEmployeeID,$vCalID,$this->vArrPetrol[$vPetrol]['petrol'],$vdaydiv,$vArrEmp);
		$vRetrun[1]=$this->LV_TinhPetrol($vEmployeeID,$vCalID,$this->vArrPetrol[$vPetrol]['parking'],$vdaydiv,$vArrEmp);
		$vRetrun[2]=$this->LV_TinhPetrol($vEmployeeID,$vCalID,$this->vArrPetrol[$vPetrol]['mobil'],$vdaydiv,$vArrEmp);
		return $vRetrun;
	}
	function LV_LoadPNQuy($vYear,$vMonth)
	{
		if($this->FNChuaNghi[0]==true) return;
		$vsql="select * from tc_lv0009 where lv005='$vMonth' and lv006='$vYear'";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$this->FNChuaNghi[$vrow['lv002']]=$vrow['lv029'];
		}
		$this->FNChuaNghi[0]=true;
	}
	function LV_CheckDayKhongLamKhongTru($vStartDate,$vEndDate)
	{
		if($this->NumKhongTru[$vEndDate][0]) return $this->NumKhongTru[$vEndDate][1];
		$this->NumKhongTru[$vEndDate][0]=true;
		$vsql="select count(*) NumDays from tc_lv0003 where lv004='休' and lv002>='$vStartDate' and lv002<='$vEndDate'";
		$vresult=db_query($vsql);
		$vrow=db_fetch_array($vresult);
		$this->NumKhongTru[$vEndDate][1]=$vrow['NumDays'];
		return $this->NumKhongTru[$vEndDate][1];
	}
	function LV_CheckSoNgayLe($vStartDate,$vEndDate)
	{
		$vArrLe=Array();
		$vsql="select lv002 from tc_lv0003 where (lv002>='$vStartDate 00:00:00' and lv002<='$vEndDate 23:59:59') and lv004='L'";
		$bResult=db_query($vsql);
		while($vrow = db_fetch_array ($bResult))
		{
			$vArrLe[$vrow['lv002']]=true;
		}
		return $vArrLe;
	}
	function LV_GetPercent_HR($vState,$vDateW,$vDateCal,$vStaffID)
	{
		if($vState==5)
		{
			if(getmonth($vDateW)==getmonth($vDateCal) &&  getyear($vDateW)==getyear($vDateCal))
			{
				$vDay=getday($vDateW);
				if($vDay<=5)
					$vPercent=100;
				elseif($vDay<=10)
					$vPercent=75;
				elseif($vDay<=14)
					$vPercent=50;
				elseif($vDay<=20)
					$vPercent=25;
				elseif($vDay>=21)
					$vPercent=0;
			}
			else
			{
				$vPercent=100;
				
			}
		}
		else
		{
			//Check hợp đồng thử việc.
			$vDateW=$this->LV_CheckHD_THUVIEC($vStaffID);
			if(getmonth($vDateW)==getmonth($vDateCal) &&  getyear($vDateW)==getyear($vDateCal))
			{
				$vDay=getday($vDateW);
				if($vDay<=5)
					$vPercent=100;
				elseif($vDay<=10)
					$vPercent=75;
				elseif($vDay<=14)
					$vPercent=50;
				elseif($vDay<=20)
					$vPercent=25;
				elseif($vDay>=21)
					$vPercent=0;
			}
			else
			{
				$vPercent=100;
				
			}
		}
		return $vPercent;
	}
	function LV_CheckHD_THUVIEC($vEmployeeID)
	{
		if($this->ArrHDTV["$vEmployeeID"][0]==true) return $this->ArrHDTV["$vEmployeeID"][1];
		$this->ArrHDTV["$vEmployeeID"][0]=true;
		$this->ArrHDTV["$vEmployeeID"][1]='';
		$vsql="select DATE_ADD(lv005, INTERVAL 1 DAY) NgayKT from hr_lv0038 where lv002='$vEmployeeID' and lv003 in (2,5)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			
			$this->ArrHDTV["$vEmployeeID"][1]=$vrow["NgayKT"];
		}
		return $this->ArrHDTV["$vEmployeeID"][1];
	}
	function CaculateSalaryNone($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001,$this->mohr_lv0038->lv011);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		if($this->lv006>0 && (($this->motc_lv0009->lv030!=1 && (($vArrEmp["$vEmployeeID"][0]['ISTS']==false) || ($vArrEmp["$vEmployeeID"][0]['ISTS']==true && $vArrEmp["$vEmployeeID"][0]['TINHTS']==true)))) || $this->motc_lv0009->lv030==3)
		{
			if($this->motc_lv0009->lv030==4)
			{
				
			}
			elseif($this->motc_lv0009->lv030==2)
			{
				$this->lv041=ROUND((float)$vObjCal->lv013*$this->lv006/100,0);
			}
			else
				{
				$this->lv040=ROUND((float)$vObjCal->lv012*$this->lv006/100,0);
				$this->lv041=ROUND((float)$vObjCal->lv013*$this->lv006/100,0);
				if($this->lv012>=$vObjCal->lv026)
				{
				
				$this->lv042=ROUND((float)$vObjCal->lv014*$this->lv012/100,0);
				$this->lv038=ROUND((float)$vObjCal->lv019*$this->lv012/100,0);
				}
				else
				{
				$this->lv042=ROUND((float)$vObjCal->lv014*$this->lv006/100,0);
				$this->lv038=ROUND((float)$vObjCal->lv019*$this->lv006/100,0);
				}
				$this->lv036=ROUND((float)$vObjCal->lv017*$this->lv006/100,0);
				$this->lv037=ROUND((float)$vObjCal->lv018*$this->lv006/100,0);
				//$this->lv035=(float)$vObjCal->lv016*$this->lv006/100;
				if($this->ArrUnionCompany[$vEmployeeID]==0)
				{
					$this->lv080=(float)$vObjCal->lv022*$this->lv006/100;
					$this->ArrUnionCompany[$vEmployeeID]=$this->lv080;
				}			
			}
			//Company pay 100%
			$this->lv064=ROUND($this->lv036+$this->lv037+$this->lv038+$this->lv040+$this->lv041+$this->lv042,0);
		}
		else
		{
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv035=0;

			//Company pay 100%
			$this->lv039=0;
		}
		if($this->mohr_lv0020->lv022!='VIETNAM')
		{
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv042=0;
			$this->lv035=0;
			if($this->lv006>0 && $this->motc_lv0009->lv030!=1)
				$this->lv037=$vObjCal->lv020;
			else
				$this->lv037=0;
			$this->lv038=0;
			//Company pay 100%
			$this->lv064=ROUND($this->lv036+$this->lv037+$this->lv038+$this->lv040+$this->lv041+$this->lv042,0);
		}
		if( $this->motc_lv0009->lv030!=1 && $this->mohr_lv0038->lv015==1) 
		{			
			//$this->lv035=(float)$vObjCal->lv016*$vObjCal->lv026/100;
			if($this->lv006==0)
			{
				$this->lv035=(float)$vObjCal->lv016*$this->lv008/100;
			}
			else
				$this->lv035=(float)$vObjCal->lv016*$this->lv006/100;
			//$this->lv080=(float)$vObjCal->lv022*$this->lv006/100;
		}
		else
		{
			$this->lv035=0;		
			if($this->motc_lv0009->lv030==1) $this->lv080=0;
		}		
		if($vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			if((int)$vArrEmp["$vEmployeeID"][0]['TS_NGAYTINH']<=25)
			{
				$this->lv035=0;
			}
			if((int)$vArrEmp["$vEmployeeID"][0]['TS_NGAYTINH']<=20)
			{
				$this->lv036=0;
				$this->lv037=0;
				$this->lv038=0;
				$this->lv040=0;
				$this->lv041=0;
				$this->lv042=0;
				$this->lv035=0;
			}
		}		
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
			$this->lv035_=$this->lv035;
		}
		else
		{
			if($this->lv035_>0) $this->lv035=0;
		}
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=true;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				//$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$isFullW=true;
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		if( $this->motc_lv0009->lv009==1)
			$vCongTruW=1;
		else
			$vCongTruW=0;
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=(int)$vArrEmp["$vEmployeeID"][0]['KH']+(int)$vArrEmp["$vEmployeeID"][0]['HL']+(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+(int)$vArrEmp["$vEmployeeID"][0]['L'];
		if($vCongTruW>0) 
		{
			if($this->lv018==0) $vCongTruW=0;
		}
		
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		if($vTimeDiv==0) $vTimeDiv=8;
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		
		$this->lv028=0;
		///Tổng công làm việc
		$this->lv093=(int)$vArrEmp["$vEmployeeID"][0]['B']+(float)$vArrEmp["$vEmployeeID"][0]['GioCong']/8;
		$this->lv093_pre=(int)$vArrEmpPre["$vEmployeeID"][0]['B']+(float)$vArrEmpPre["$vEmployeeID"][0]['GioCong']/8;
		$this->lv025=round($vTimeWork+$vTimeWorkCT+$this->lv093,2);
		$this->lv025_=round($vTimeWork+$vTimeWorkCT+$vTimeWorkPre+$vTimeWorkPreCT+$this->lv093+$this->lv093_pre,2);
		if($vPrev==0)
		{
			$this->lv019_=$vTimeWorkCN;
			$this->lv025__=round($vTimeWork+$vTimeWorkCT+$vTimeWorkPre+$vTimeWorkPreCT,2);
		}
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=$vArrEmp["$vEmployeeID"][0]['TC_NHO_2H'];
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_2H'];
			$this->lv092=$this->lv090*10000+$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		if($vPrev==0)
		{
			if($vTimeWorkPre==0)
			{
				if($this->lv025>$this->lv012)
				{
					//echo $this->mohr_lv0038->lv011;
					switch($this->mohr_lv0038->lv011)
					{
						case 13:
						case 0:	
							$this->lv026=0;
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;		
							break;
						case 11:
						case 10:
						case 12:
							if($isVuotCong==2)
							{
								$this->lv026=$this->lv025-$this->lv012;
								//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
								$this->lv025=$this->lv012;
								$vDayWorks=$this->lv012;	
							}
							break;
						default:
							$this->lv026=$this->lv025-$this->lv012;
							//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;	
							break;
					}
					/*switch($isVuotCong)
					{
						case 0:
						//Xách định CN làm vẫn ko tính công.
						//Xác định công vượt ưu tiên chọn công ưu tiên
							$this->lv026=0;
							//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;		
							break;
						case 1:
							break;
						case 2:
							$this->lv026=$this->lv025-$this->lv012;
							//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;		
							break;
					}	*/				
				}
			}
			else
			{
				if(($this->lv025+$vTimeWorkPre)>$this->lv012)
				{	
					switch($this->mohr_lv0038->lv011)
					{
						case 13:
						case 0:	
							$this->lv026=0;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;		
							break;
						case 11:
						case 10:
						case 12:
							if($isVuotCong==2)
							{
								$this->lv026=$this->lv025+$vTimeWorkPre-$this->lv012;
								$this->lv025=($this->lv012-($vTimeWorkPre));
								$vDayWorks=$this->lv025;
							}
							break;
						default:
							$this->lv026=$this->lv025+$vTimeWorkPre-$this->lv012;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;	
							break;
					}
					/*
					switch($isVuotCong)
					{
						case 0:
							$this->lv026=0;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;
							break;
						case 1:
							break;
						case 2:
							$this->lv026=$this->lv025+$vTimeWorkPre-$this->lv012;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;
							break;
					}	*/			
					//$vDayWorks=$this->lv012-(($this->lv025+$vTimeWorkPre)-$this->lv012);
					//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,$this->lv012-(($this->lv025+$vTimeWorkPre)));
					
				}
			}
		}
		else
		{
			//echo "$this->lv025__)>$this->lv012";
			if(($this->lv025__)>$this->lv012)
				{	
					switch($this->mohr_lv0038->lv011)
					{
						
						case 11:
						case 10:
						case 12:
							if($isVuotCong==2)
							{
								//echo "$this->lv025+$vTimeWorkPre-$this->lv012";
								$this->lv026=$this->lv025__-$this->lv012;
								$this->lv025=$this->lv012-($this->lv025__-$this->lv025);
								$vDayWorks=$this->lv025;
							}
							break;
						
					}
				}
		}
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);
		if($this->isSameHD==1)
		{
			$vABCPercen=100;
		}
		//Hiệu quả CV(ABC)
		if($this->isRateTwo)
		{
			//Chua
			if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
				$this->lv051=$this->mohr_lv0038->lv013*($vABCPercen/100)*($this->lv082/100)*$this->lv025/$this->lv012;
			else
				$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		}
		else
		{
			if($vPrev==0)
			{
				if($this->mohr_lv0038->lv013>0)
					$this->ACBPercentNext=100-$vABCPercen;
				else
					$this->ACBPercentNext=$vABCPercen;
				//if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
					$this->lv051=$this->mohr_lv0038->lv013*($vABCPercen/100)*($this->lv082/100);
				//else
				//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100);
			}
			else
			{
				//if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
					$this->lv051=$this->mohr_lv0038->lv013*($this->ACBPercentNext/100)*($this->lv082/100);
				//else
				//	$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100);
			}
			
			
		}
		$vPCCTPercent=$this->LV_GetPercenPCCT($this->mohr_lv0038->lv032,$this->mohr_lv0038->lv013,$this->mohr_lv0038->lv023);
		$vABCLech=$this->LV_GetChenhLechCT($vPCCTPercent,$this->mohr_lv0038->lv013,$this->lv051);
		//Tiền ăn ca
		$this->lv052=0;//$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=0;//$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=0;//$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=0;//$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=0;//$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			if($vPrev==0) 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
			else
				$this->lv075=0;
			if($this->lv075==0  && ((($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'")>0 && $vPrev==0) || $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'")==0))){
				if(($this->lv012-$this->lv025__)<=12)
					$this->lv075=$this->mohr_lv0038->lv025;
				else
					$this->lv075=$this->mohr_lv0038->lv025*($this->lv025)/$this->lv012;

			}			
			if($this->isPCCTTwo==true)
			{
				$this->lv076=($this->mohr_lv0038->lv023-$vABCLech)*$this->lv014/($this->lv012);//-(int)$vArrEmp["$vEmployeeID"][0]['L']
			}
			else
			{
				//Phụ cấp công trình
				if($vPrev==0) 
					$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				else
					$this->lv076=0;
				if($this->lv076==0 && ((($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'")>0 && $vPrev==0) || $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'")==0)))
				{
				//echo "<br/>".$vPre.":".$this->mohr_lv0038->lv023."*$this->lv014/$this->lv012=";
					if($this->lv014>=$this->lv012)
						 $this->lv076=$this->mohr_lv0038->lv023-$vABCLech;
					else
						 $this->lv076=($this->mohr_lv0038->lv023-$vABCLech)*$this->lv014/($this->lv012);
				}
			}
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		/*
		if($vObjCal->lv009==1)
		{
			if($vPrev==0)
			{ 
			//Phụ cấp trách nhiệm
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'")>0)
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
			else
				$this->lv075=$this->mohr_lv0038->lv025;		
			//Phụ cấp công trình
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'")>0)
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
			else
				$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
			//Phụ cấp khác 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'")>0)
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");		
			else
				$this->lv077=$this->mohr_lv0038->lv031;
			}
			else
			{
				$this->lv075=$this->mohr_lv0038->lv025;
				$this->lv076=$this->mohr_lv0038->lv023*$this->lv025/$this->lv012;
				$this->lv077=$this->mohr_lv0038->lv031;

			}

		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");	
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		*/
		//Check các ngày nghỉ.
		if($vObjCal->lv008==1)
		{	
			$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['L']+(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		}
		else
		{
			$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		}
		$vCongCongMot=0;
		if((int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5>0)
		{
			if((int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5>=1)
				$vCongCongMot=1;
			else
				$vCongCongMot=(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		}
		else
		{

			if($this->lv025_==$this->lv025)
			{
			//	echo "$this->lv012-$this->lv025-".(int)$vArrEmp["$vEmployeeID"][0]['L']."=";
				if(($this->lv012-$this->lv025-$this->lv018)<1) 
				{
					$vCongCongMot=($this->lv012-$this->lv025-$this->lv018);
				}
				else
					$vCongCongMot=1;
			}
			else
			{
				
				if(($this->lv012-$this->lv025_-$this->lv018)<1) 
				{
					$vCongCongMot=($this->lv012-$this->lv025_-$this->lv018);
				}
				else
					$vCongCongMot=1;
			}
			
		}
		if($vCongCongMot<0) $vCongCongMot=0;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương
		$this->lv078=$this->mohr_lv0038->lv032;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078/$this->lv012;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		
		//Tiền phép chưa nghỉ hết
		$this->lv029=ROUND(($this->lv078)*$this->lv026/$this->lv012*1.5,0);
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		$vCheckPecialCongTru1Cong=false;
		//echo "$isCongThem? ".$this->mohr_lv0038->lv034." ?";
		if($vPrev==0) 
		{

			$lMonthN=getmonth($this->mohr_lv0020->lv030);
			$lYearN=getyear($this->mohr_lv0020->lv030);
			$lDayN=getday($this->mohr_lv0020->lv030);
			$vMonthN=getmonth($this->mohr_lv0020->lv044);
			$vYearN=getyear($this->mohr_lv0020->lv044);
			if((int)$vYearN==(int)$vObjCal->lv007 && (int)$vMonthN==(int)$vObjCal->lv006 || ((int)$lYearN==(int)$vObjCal->lv007 && (int)$lMonthN==(int)$vObjCal->lv006 && $lDayN!=1))
				$vNgayCongTinh=$this->lv025;
			else
			{

				if($isCongThem)
				{
					if($this->mohr_lv0038->lv034==1)
					{
						 $vCongCongMot=0;
						$vNgayCongTinh=$this->lv025;
						if($vCongCongMot<1 && ((int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['L']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5)>=1)
						{
							$vCheckPecialCongTru1Cong=true;
						} 
					}
					else
					{
						if( $this->motc_lv0009->lv009==1 && $vCongTruW>0)
						{
							$vNgayCongTinh=$this->lv025;
							if($vCongCongMot<1 && ((int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['L']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5)>=1) $vCheckPecialCongTru1Cong=true;
						}
						else
						{
							$vNgayCongTinh=($this->lv025<$this->lv012)?(($this->lv025+$vCongCongMot>$this->lv012)?$this->lv012:$this->lv025+$vCongCongMot):$this->lv025;
							if($vCongCongMot<1 && ((int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['L']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5)>=1) $vCheckPecialCongTru1Cong=true;
						}
					}
				}
				else
				{
					$vNgayCongTinh=$this->lv025;
					/*$vCongCongMot=0;
					$vNgayCongTinh=($this->lv025<$this->lv012)?(($this->lv025+$vCongCongMot>$this->lv012)?$this->lv012:$this->lv025+$vCongCongMot):$this->lv025;
							if(((int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['L']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5)>=1) $vCheckPecialCongTru1Cong=true;*/

				}
			}
		}
		else
			$vNgayCongTinh=$this->lv025;
		$vNgayCongTC=26;
		if($isFullW==true) if($vNgayCongTC<$this->lv012) $vNgayCongTC=$this->lv012;
		//Nghỉ lễ & Phép -----
		$LuongCBNgay=0;
		if($this->mohr_lv0038->lv011!=11)
		{
			$this->lv023=ROUND(($this->lv008)*($this->lv018)/$vNgayCongTC,0);
		}
		else
		{
			$this->lv023=ROUND(($this->lv008)*($this->lv018)/26,0);
		}
		if($vCongTruW>0 || $vCheckPecialCongTru1Cong) $LuongCBNgay=$this->lv023/$this->lv018;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv078)*$this->lv025/$this->lv012,0);
		if($this->mohr_lv0038->lv017==1)
		{
			if($vCheckPecialCongTru1Cong)
			{
				$vStrTinh="($this->lv078)*($vNgayCongTinh)/$this->lv012";

				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012-$this->lv023,0);
			}
			else
			{
				$vStrTinh="($this->lv078)*($vNgayCongTinh)/$this->lv012";
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012-$this->lv023,0);
			}
		}
		else
		{
			//echo "ok $vCheckPecialCongTru1Cong ok";
			if($vCheckPecialCongTru1Cong)
			{
				$vStrTinh="($this->lv078)*($vNgayCongTinh)/$this->lv012";
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012,0);
			}
			else
			{
				$vStrTinh="($this->lv078)*($vNgayCongTinh)/$this->lv012";
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012,0);
			}
		}
		echo $vStrTinh;
		//Phu cap ca dem
		
		//Tăng ca thường
		//echo "$this->lv078/$vNgayCongTC/8*$this->lv015*1.5";
		$this->lv020=ROUND($this->lv078/$vNgayCongTC/$vTimeDiv*$this->lv015*1.5,0);
		$this->lv020_=ROUND($this->lv078/$vNgayCongTC/$vTimeDiv*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		
		//Tăng 200%
		$this->lv021=ROUND($this->lv078/$vNgayCongTC/$vTimeDiv*$this->lv016*2,0);
		$this->lv021_=ROUND($this->lv078/$vNgayCongTC/$vTimeDiv*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		//echo "$this->lv078/$vNgayCongTC/8*$this->lv017*3";
		$this->lv022=ROUND($this->lv078/$vNgayCongTC/$vTimeDiv*$this->lv017*3,0);
		$this->lv022_=ROUND($this->lv078/$vNgayCongTC/$vTimeDiv*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		
		
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		
		//Adward Bonus	
		if($vPrev==0)
		{
			
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			if($this->isTamUng>0)
				$this->lv027=$this->isTamUng;
			else
				$this->lv027=0;
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
			 
		//Total Earning before Deduction
		//echo "<br/>(float)$this->lv092+(float)$this->lv052+(float)$this->lv053+(float)$this->lv054+(float)$this->lv055+(float)$this->lv074+(float)$this->lv075+(float)$this->lv076+(float)$this->lv077+(float)$this->lv051+(float)$this->lv020+(float)$this->lv021+(float)$this->lv022+(float)$this->lv023+(float)$this->lv024+(float)$this->lv034+(float)$this->lv029+(float)$this->lv030+(float)$this->lv031=";
		$this->lv033=(float)$this->lv092+(float)$this->lv052+(float)$this->lv053+(float)$this->lv054+(float)$this->lv055+(float)$this->lv074+(float)$this->lv075+(float)$this->lv076+(float)$this->lv077+(float)$this->lv051+(float)$this->lv020+(float)$this->lv021+(float)$this->lv022+(float)$this->lv023+(float)$this->lv024+(float)$this->lv034+(float)$this->lv029+(float)$this->lv030+(float)$this->lv031;
		//$this->lv033=$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}

		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
			
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			//echo "$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue=";
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$vTotalTCGiamThue-$this->lv092+$this->lv035;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$vTotalTCGiamThue-$this->lv092+$this->lv035;
		}
		
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		
		if($this->lv070>0)
		{
			if($vPrev==0 && ($vTimeWorkPre+$vTimeWorkPreCT)>0)
			{
				$this->lv045=0;
			}
			else
			{
				if($this->lv100!="VND") 
				{
					if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
					$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
				}
				else
				{
					if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
					$this->lv045=ROUND($this->GetTax($this->lv070),0);
				}
			}
				
		}
		else
		{
			$this->lv045=0;
		}
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027+$this->lv028;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027+$this->lv028;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		if($this->lv049<0 && $this->lv027>0 && (-$this->lv049)<$this->lv027 )
		{
			
			$this->isTamUng=-$this->lv049;
			$this->lv027=$this->lv027-$this->isTamUng;
			//Total Deduction		
			if($this->mohr_lv0038->lv019==1)
				$this->lv048=$this->lv046+$this->lv027+$this->lv028;
			else
				$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027+$this->lv028;
			//Net pay
			$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		}
		
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal || $this->isTamUng>0))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
		
		//$this->GetSalaryhours($vCalculateTimesID,$vEmployeeID,$this->lv022,$vObjCal->lv004,$vObjCal->lv005,$vObjCal->lv007,$vObjCal->lv006);
	}
	function CaculateSalaryLamThem($vObjCal,$vEmployeeID,$vPara,$heso,$vrate,$vTypeCalculate,$vPetrol,$vStateBonus=0,$vPrev=0,&$vArrEmpPre=null)
	{
		$vDateCal=$vObjCal->lv004;
		$this->mohr_lv0020->LV_LoadFullIDCal($vEmployeeID,$vDateCal);
		
		$this->MaxLe=$this->LV_CheckSoNgayLe($vObjCal->lv004,$vObjCal->lv005);
		$vLong_DateW=(float)str_replace("-","",$this->mohr_lv0020->lv030);
		$vLongDateCal=(float)str_replace("-","",$vObjCal->lv005);
		$this->LV_LoadPNQuy($vObjCal->lv007,$vObjCal->lv006);
		//if($vLongDateCal<$vLong_DateW) return;
		$vArrDepartment=Array();
		$vDepartmentID=$this->mohr_lv0020->lv029;
		if($vPrev==0)
			$vArrEmpPre=$this->TinhCongTheoNgayVP_BV($vEmployeeID,$vObjCal->lv004,$vObjCal->lv005,$vrate,$vObjCal->lv001,$vArrEmp,$this->mohr_lv0038->lv001,$this->mohr_lv0038->lv011);
		else
			$vArrEmp["$vEmployeeID"]=$vArrEmpPre["$vEmployeeID"];
		$this->mohr_lv0038->LV_LoadID($vArrEmp["$vEmployeeID"][0]['ContractID']);
	///Salary belong to insurance anually
		//$this->lv006=$this->GetSalaryOpt($vEmployeeID,0);
		$this->lv006=$this->mohr_lv0038->lv021;
		//Luong CB
		$this->lv008=$this->mohr_lv0038->lv022;
		if($this->lv006>0 && $vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			$this->lv098=1;
		}
		else
		{
			$this->lv098=0;
		}
	///Deduction Of Loan
		if($vPrev==0)
		{
			$this->lv009=round((float)$this->GetSalaryOptLoan($vEmployeeID,3,$vObjCal->lv006,$vObjCal->lv007),-3)+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'CEP'");;	
		}
		else
			$this->lv009=0;
		
	///Get bonus automatic
		$this->lv010=round((float)$this->GetSalaryOptLoan($vEmployeeID,1,$vObjCal->lv006,$vObjCal->lv007),-3);	
	//////////Other bonus salary//////////
		
	/////////////////////////////////
		$vContractTypeID=$this->GetContract($vEmployeeID,'lv003');
		
		//$vArrEmp["$vEmployeeID"][0]['ISTS']=true;
		//$vArrEmp["$vEmployeeID"][0]['TINHTS']=true;
		
		if($this->lv006>0 && (($this->motc_lv0009->lv030!=1 && (($vArrEmp["$vEmployeeID"][0]['ISTS']==false) || ($vArrEmp["$vEmployeeID"][0]['ISTS']==true && $vArrEmp["$vEmployeeID"][0]['TINHTS']==true)))) || $this->motc_lv0009->lv030==3)
		{
			if($this->motc_lv0009->lv030==4)
			{
				
			}
			elseif($this->motc_lv0009->lv030==2)
			{
				$this->lv041=ROUND((float)$vObjCal->lv013*$this->lv006/100,0);
			}
			else
				{
				$this->lv040=ROUND((float)$vObjCal->lv012*$this->lv006/100,0);
				$this->lv041=ROUND((float)$vObjCal->lv013*$this->lv006/100,0);
				if($this->lv012>=$vObjCal->lv026)
				{
				
				$this->lv042=ROUND((float)$vObjCal->lv014*$this->lv012/100,0);
				$this->lv038=ROUND((float)$vObjCal->lv019*$this->lv012/100,0);
				}
				else
				{
				$this->lv042=ROUND((float)$vObjCal->lv014*$this->lv006/100,0);
				$this->lv038=ROUND((float)$vObjCal->lv019*$this->lv006/100,0);
				}
				$this->lv036=ROUND((float)$vObjCal->lv017*$this->lv006/100,0);
				$this->lv037=ROUND((float)$vObjCal->lv018*$this->lv006/100,0);
				//$this->lv035=(float)$vObjCal->lv016*$this->lv006/100;
				if($this->ArrUnionCompany[$vEmployeeID]==0)
				{
					$this->lv080=(float)$vObjCal->lv022*$this->lv006/100;
					$this->ArrUnionCompany[$vEmployeeID]=$this->lv080;
				}			
			}
			//Company pay 100%
			$this->lv064=ROUND($this->lv036+$this->lv037+$this->lv038+$this->lv040+$this->lv041+$this->lv042,0);
		}
		else
		{
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv035=0;

			//Company pay 100%
			$this->lv039=0;
		}
		if($this->mohr_lv0020->lv022!='VIETNAM')
		{
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv042=0;
			$this->lv035=0;
			if($this->lv006>0 && $this->motc_lv0009->lv030!=1)
				$this->lv037=$vObjCal->lv020;
			else
				$this->lv037=0;
			$this->lv038=0;
			//Company pay 100%
			$this->lv064=ROUND($this->lv036+$this->lv037+$this->lv038+$this->lv040+$this->lv041+$this->lv042,0);
		}
		if( $this->motc_lv0009->lv030!=1 && $this->mohr_lv0038->lv015==1) 
		{			
			//$this->lv035=(float)$vObjCal->lv016*$vObjCal->lv026/100;
			if($this->lv006==0)
			{
				$this->lv035=(float)$vObjCal->lv016*$this->lv008/100;
			}
			else
				$this->lv035=(float)$vObjCal->lv016*$this->lv006/100;
			//$this->lv080=(float)$vObjCal->lv022*$this->lv006/100;
		}
		else
		{
			$this->lv035=0;		
			if($this->motc_lv0009->lv030==1) $this->lv080=0;
		}		
		if($vArrEmp["$vEmployeeID"][0]['ISTS']==true)
		{
			if((int)$vArrEmp["$vEmployeeID"][0]['TS_NGAYTINH']<=25)
			{
				$this->lv035=0;
			}
			if((int)$vArrEmp["$vEmployeeID"][0]['TS_NGAYTINH']<=20)
			{
				$this->lv036=0;
				$this->lv037=0;
				$this->lv038=0;
				$this->lv040=0;
				$this->lv041=0;
				$this->lv042=0;
				$this->lv035=0;
			}
		}		
		if($vPrev==0)
		{
			$this->lv035=$this->lv035+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDLD'");
			$this->lv080=$this->lv080+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'")+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'PHICDCTY'");
			$this->lv036=$this->lv036+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHXHCTY'");
			$this->lv037=$this->lv037+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHYTCTY'");
			$this->lv038=$this->lv038+$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BHTNCTY'");
			$this->lv040=$this->lv040+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHXHLD'");
			$this->lv041=$this->lv041+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHYTLD'");
			$this->lv042=$this->lv042+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BHTNLD'");
		}
		//Company pay 100%
		$this->lv039=ROUND($this->lv036+$this->lv037+$this->lv038,0);
		$this->lv043=ROUND($this->lv040+$this->lv041+$this->lv042,0);
		$this->lv043=$this->lv043+$this->lv035;
		$vNumDay=GetDayWorkInMonths($vObjCal->lv007,$vObjCal->lv006,$vPara);
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		//Tổng công cộng thêm
		$vlv024_sum=$this->LV_GetTongHeCong($vObjCal);
		/////Người phụ thuộc
		$this->lv065=$this->mohr_lv0020->lv049;		
		$vdaydiv=22;
		$vdaydivoth=22;
		$isCongThem=true;
		$isFullW=false;
		switch($this->mohr_lv0038->lv011)
		{
			case 13:
				//$isCongThem=false;
			case 0:	
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 1:
				$vdaydiv=count($this->vArrDay)-(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 2:
				$vdaydiv=count($this->vArrDay)-0.5*(int)$this->ArrDaySpecial[0]['T7']-(int)$this->ArrDaySpecial[0]['CN'];
				break;
			case 3: 
				$vdaydiv=count($this->vArrDay)-6;
				break;
			case 4: 
				$vdaydiv=8;
				break;
			case 7: 
				$vdaydiv=22;
				break;
			case 8: 
				$vdaydiv=25;
				break;
			case 9: 
				$vdaydiv=24;
				break;
			case 10: 
				$vdaydiv=26;
				$isCongThem=false;
				break;
			case 11: 
				$isFullW=true;
				$vdaydiv=count($this->vArrDay);
				break;
			case 12: 
				$isFullW=true;
				$vdaydiv=30;
				$isCongThem=false;
				break;
			case 5: 
				$vdaydiv=count($this->vArrDay)-4;
				break;
		}
		if( $this->motc_lv0009->lv009==1)
			$vCongTruW=1;
		else
			$vCongTruW=0;		
		/*$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		$this->lv073=0;//(int)$vArrEmp["$vEmployeeID"][0]['休']+(int)$vArrEmp["$vEmployeeID"][0]['0.5休']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'休');;
		if($this->lv073>=$vNumNghiKhongTru)
			$this->lv012=$vdaydiv-$this->lv073;
		else
			$this->lv012=$vdaydiv-$vNumNghiKhongTru;*/
		$this->lv012=$vdaydiv;
		$vTaiNanLD=(int)$vArrEmp["$vEmployeeID"][0]['#']+(int)$vArrEmp["$vEmployeeID"][0]['±']+(int)$vArrEmp["$vEmployeeID"][0]['+'];
		////if($vObjCal->lv005<$this->mohr_lv0020->lv030 && $vObjCal->lv006>$this->mohr_lv0020->lv030)
		{
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv004,$vObjCal->lv005);
			//$vNumNghiKhongTru=(int)$this->LV_CheckDayKhongLamKhongTru($vObjCal->lv005,$this->mohr_lv0020->lv030);
		}
		//Ngày nghỉ lễ phép...
		$this->lv018=(int)$vArrEmp["$vEmployeeID"][0]['KH']+(int)$vArrEmp["$vEmployeeID"][0]['HL']+(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+(int)$vArrEmp["$vEmployeeID"][0]['L'];
		if($vCongTruW>0) 
		{
			if($this->lv018==0) $vCongTruW=0;
		}
		$vTimeWork=(float)$vArrEmp["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkPre=$vArrEmpPre["$vEmployeeID"][0]['RGTimeS'];
		$vTimeWorkCT=(float)$vArrEmp["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkCN=(float)$vArrEmp["$vEmployeeID"][0]['CNTimeS'];
		$vTimeWorkPreCT=(float)$vArrEmpPre["$vEmployeeID"][0]['PJTimeS'];
		$vTimeWorkPreCN=(float)$vArrEmpPre["$vEmployeeID"][0]['CNTimeS'];
		$vTimeDiv=$this->GetTime($this->mohr_lv0038->lv007);
		///Ngày làm VP
		$this->lv013=$vTimeWork;
		///Ngày làm CT
		$this->lv014=$vTimeWorkCT;
		///Ngày làm CN
		$this->lv019=$vTimeWorkCN;
		
		$this->lv028=0;
		///Tổng công làm việc
		$this->lv093=(int)$vArrEmp["$vEmployeeID"][0]['B']+(float)$vArrEmp["$vEmployeeID"][0]['GioCong']/8;
		$this->lv093_pre=(int)$vArrEmpPre["$vEmployeeID"][0]['B']+(float)$vArrEmpPre["$vEmployeeID"][0]['GioCong']/8;
		$this->lv025=round($vTimeWork+$vTimeWorkCT+$this->lv093,2);
		$this->lv025_=round($vTimeWork+$vTimeWorkCT+$vTimeWorkPre+$vTimeWorkPreCT+$this->lv093+$this->lv093_pre,2);
		if($vPrev==0)
		{
			$this->lv019_=$vTimeWorkCN;
			$this->lv025__=round($vTimeWork+$vTimeWorkCT+$vTimeWorkPre+$vTimeWorkPreCT,2);
		}
		//Tổng số giờ tăng ca thường.
		$this->lv015=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC150']);
		//Số giờ tăng ca đêm.
		$this->lv016=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC200']);
		//Tổng số giờ tăng ca thường.
		$this->lv017=$this->GetTime($vArrEmp["$vEmployeeID"][0]['TC300']);		
		$isSoLanTC=$this->LV_GetSoLanTC($vDepartmentID);
		if($isSoLanTC==1)
		{
			$this->lv090=$vArrEmp["$vEmployeeID"][0]['TC_NHO_2H'];
			$this->lv091=$vArrEmp["$vEmployeeID"][0]['TC_LON_2H'];
			$this->lv092=$this->lv090*10000+$this->lv091*20000;
		}
		else
		{
			$this->lv090=0;
			$this->lv091=0;
			$this->lv092=0;
		}
		$vDayWorks=$this->lv025;
		$this->lv026=0;
		$isVuotCong=$this->LV_GetVuotCong($vDepartmentID);
		if($vPrev==0)
		{
			if($vTimeWorkPre==0)
			{
				if($this->lv025>$this->lv012)
				{
					switch($this->mohr_lv0038->lv011)
					{
						case 13:
						case 0:	
							$this->lv026=0;
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;		
							break;
						case 11:
						case 10:
						case 12:
							if($isVuotCong==2)
							{
								$this->lv026=$this->lv025-$this->lv012;
								//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
								$this->lv025=$this->lv012;
								$vDayWorks=$this->lv012;	
							}
							break;
						default:
							$this->lv026=$this->lv025-$this->lv012;
							//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;	
							break;
					}
					/*switch($isVuotCong)
					{
						case 0:
						//Xách định CN làm vẫn ko tính công.
						//Xác định công vượt ưu tiên chọn công ưu tiên
							$this->lv026=0;
							//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;		
							break;
						case 1:
							break;
						case 2:
							$this->lv026=$this->lv025-$this->lv012;
							//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,($this->lv025-$this->lv012));
							$this->lv025=$this->lv012;
							$vDayWorks=$this->lv012;		
							break;
					}	*/				
				}
			}
			else
			{
				if(($this->lv025+$vTimeWorkPre)>$this->lv012)
				{	
					switch($this->mohr_lv0038->lv011)
					{
						case 13:
						case 0:	
							$this->lv026=0;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;		
							break;
						case 11:
						case 10:
						case 12:
							if($isVuotCong==2)
							{
								$this->lv026=$this->lv025+$vTimeWorkPre-$this->lv012;
								$this->lv025=($this->lv012-($vTimeWorkPre));
								$vDayWorks=$this->lv025;
							}
							break;
						default:
							$this->lv026=$this->lv025+$vTimeWorkPre-$this->lv012;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;	
							break;
					}
					/*
					switch($isVuotCong)
					{
						case 0:
							$this->lv026=0;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;
							break;
						case 1:
							break;
						case 2:
							$this->lv026=$this->lv025+$vTimeWorkPre-$this->lv012;
							$this->lv025=$this->lv025+($this->lv012-($this->lv025+$vTimeWorkPre));
							$vDayWorks=$this->lv025;
							break;
					}	*/			
					//$vDayWorks=$this->lv012-(($this->lv025+$vTimeWorkPre)-$this->lv012);
					//$this->motc_lv0009->LV_CongDu($vEmployeeID,$vObjCal->lv006,$vObjCal->lv007,$this->lv012-(($this->lv025+$vTimeWorkPre)));
					
				}
			}
		}
		else
		{
			//echo "$this->lv025__)>$this->lv012";
			if(($this->lv025__)>$this->lv012)
				{	
					switch($this->mohr_lv0038->lv011)
					{
						
						case 11:
						case 10:
						case 12:
							if($isVuotCong==2)
							{
								//echo "$this->lv025+$vTimeWorkPre-$this->lv012";
								$this->lv026=$this->lv025__-$this->lv012;
								$this->lv025=$this->lv012-($this->lv025__-$this->lv025);
								$vDayWorks=$this->lv025;
							}
						
					}
				}
		}
		$vDayWorks=round($vDayWorks,2);
		//PH
		$this->lv068=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5+$this->GetNightShift($vObjCal->lv001,$vEmployeeID,'P');
		//Số  phép năm chưa nghỉ hết
		//$this->lv026=(float)$this->FNChuaNghi["$vEmployeeID"];
		if($this->RateEmp[$vEmployeeID]==NULL) 
		{
			$this->lv081='';
			$this->lv082=0;
		}
		else
		{
			$this->lv081=$this->RateEmp[$vEmployeeID][1];
			$this->lv082=$this->RateEmp[$vEmployeeID][0];
		}
		//Hiệu quả CV(ABC)
		$vABCPercen=$this->LV_GetPercent_HR($this->mohr_lv0020->lv009,$this->mohr_lv0020->lv030,$vObjCal->lv004,$this->mohr_lv0020->lv001);

		//Hiệu quả CV(ABC)
		if($this->isRateTwo)
		{
			//Chua
			if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
				$this->lv051=$this->mohr_lv0038->lv013*($vABCPercen/100)*($this->lv082/100)*$this->lv025/$this->lv012;
			else
				$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100)*$this->lv025/$this->lv012;	
		}
		else
		{
			if($vPrev==0) 
			{
				if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
					$this->lv051=$this->mohr_lv0038->lv013*($vABCPercen/100)*($this->lv082/100);
				else
					$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100);
			}
			else
			{
				if($this->mohr_lv0038->lv003!=2 && $this->mohr_lv0038->lv003!=5)
					$this->lv051=$this->mohr_lv0038->lv013*($vABCPercen/100)*($this->lv082/100);
				else
					$this->lv051=$this->mohr_lv0038->lv013*($this->lv082/100);
			}
			
		}
		
		//Tiền ăn ca
		$this->lv052=$this->mohr_lv0038->lv014;
		//Trợ cấp điện thoại
		$this->lv053=$this->mohr_lv0038->lv026;
		//Trợ cấp nhà trọ
		$this->lv054=$this->mohr_lv0038->lv016;
		//Công tác phí
		$this->lv055=$this->mohr_lv0038->lv018;
		//Xăng xe
		$this->lv074=$this->mohr_lv0038->lv020;
		if($vObjCal->lv009==1)
		{
			//Phụ cấp trách nhiệm
			if($vPrev==0) 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
			else
				$this->lv075=0;
			if($this->lv075==0  && ((($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'")>0 && $vPrev==0) || $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'")==0))){
				if(($this->lv012-$this->lv025__)<=12)
					$this->lv075=$this->mohr_lv0038->lv025;
				else
					$this->lv075=$this->mohr_lv0038->lv025*($this->lv025)/$this->lv012;

			}			
			//Phụ cấp công trình
			if($vPrev==0) 
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
			else
				$this->lv076=0;
			if($this->lv076==0 && ((($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'")>0 && $vPrev==0) || $this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'")==0)))
			{
			//echo $this->mohr_lv0038->lv023."*$this->lv014/$this->lv012=";
				if($this->lv014>=$this->lv012)
					 $this->lv076=$this->mohr_lv0038->lv023;
				else
					 $this->lv076=$this->mohr_lv0038->lv023*$this->lv014/$this->lv012;
			}
			//Phụ cấp khác 
			$this->lv077=$this->mohr_lv0038->lv031;
		}
		else
		{
			if($vPrev==0)
			{ 
				$this->lv075=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCTN'");
				$this->lv076=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'PCCT'");
				$this->lv077=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'CONGKHAC'");
			}
			else
			{
				$this->lv075=0;
				$this->lv076=0;
				$this->lv077=0;
			}
		}
		//Check các ngày nghỉ.
		if($vObjCal->lv008==1)
		{	
			$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['L']+(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		}
		else
		{
			$vTotalNghi=(int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']+(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['O']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		}
		$vCongCongMot=0;
		if((int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5>0)
		{
			if((int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5>=1)
				$vCongCongMot=1;
			else
				$vCongCongMot=(int)$vArrEmp["$vEmployeeID"][0]['VR']+(int)$vArrEmp["$vEmployeeID"][0]['0.5VR']*0.5;
		}
		else
		{
			if($this->lv025_==$this->lv025)
			{
				if(($this->lv012-$this->lv025)<1) 
				{
					$vCongCongMot=($this->lv012-$this->lv025);
				}
				else
					$vCongCongMot=1;
			}
			else
			{
				if(($this->lv012-$this->lv025_)<1) 
				{
					$vCongCongMot=($this->lv012-$this->lv025_);
				}
				else
					$vCongCongMot=1;
			}
		}
		if($vCongCongMot<0) $vCongCongMot=0;
		$this->TotalNghi=$this->TotalNghi+$vTotalNghi;
		//Lương
		$this->lv078=$this->mohr_lv0038->lv032;
		//SeniorityPrevious
		//$vPreCalID=$vObjCal->LV_LoadPreMonth($vObjCal->lv006,$vObjCal->lv007);
		//Tổng lương
		$this->lv079=$this->mohr_lv0038->lv033;		
		//Lương ngày
		$this->lv011=$this->lv078/$this->lv012;
		//PC kinh nghiem
		$this->lv072=0;//$this->mohr_lv0038->lv034;
		//Tiền phép chưa nghỉ hết
		$this->lv029=ROUND(($this->lv078)*$this->lv026/$this->lv012*1.5,0);
		//Gross Salary
		//echo "($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077)*$this->lv025/($this->lv012*8)";
		$vCheckPecialCongTru1Cong=false;
		if($isCongThem && $vPrev==0) 
		{
			$lMonthN=getmonth($this->mohr_lv0020->lv030);
			$lYearN=getyear($this->mohr_lv0020->lv030);
			$lDayN=getday($this->mohr_lv0020->lv030);
			$vMonthN=getmonth($this->mohr_lv0020->lv044);
			$vYearN=getyear($this->mohr_lv0020->lv044);
			if((int)$vYearN==(int)$vObjCal->lv007 && (int)$vMonthN==(int)$vObjCal->lv006 || ((int)$lYearN==(int)$vObjCal->lv007 && (int)$lMonthN==(int)$vObjCal->lv006 && $lDayN!=1))
				$vNgayCongTinh=$this->lv025;
			else
			{
				//if($vTotalNghi>0)
				{
					if($this->mohr_lv0038->lv034==1)
					{
						$vNgayCongTinh=$this->lv025;
					}
					else
					{
						if( $this->motc_lv0009->lv009==1 && $vCongTruW>0)
							$vNgayCongTinh=$this->lv025;
						else
						{
							$vNgayCongTinh=($this->lv025<$this->lv012)?(($this->lv025+$vCongCongMot>$this->lv012)?$this->lv012:$this->lv025+$vCongCongMot):$this->lv025;
							if($vCongCongMot==0 && ((int)$vArrEmp["$vEmployeeID"][0]['P']+(int)$vArrEmp["$vEmployeeID"][0]['0.5P']*0.5)>=1) $vCheckPecialCongTru1Cong=true;
						}
					}
				}
				/*else
					$vNgayCongTinh=$this->lv025;*/
			}
		}
		else
			$vNgayCongTinh=$this->lv025;
		$vNgayCongTC=26;
		if($isFullW==true) if($vNgayCongTC<$this->lv012) $vNgayCongTC=$this->lv012;
		//Nghỉ lễ & Phép -----
		$LuongCBNgay=0;
		if($this->mohr_lv0038->lv011!=11)
		{
			$this->lv023=ROUND(($this->lv008)*($this->lv018)/$vNgayCongTC,0);
		}
		else
		{
			$this->lv023=ROUND(($this->lv008)*($this->lv018)/26,0);
		}
		if($vCongTruW>0 || $vCheckPecialCongTru1Cong) $LuongCBNgay=$this->lv023/$this->lv018;
		$this->lv023_=0;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TC---'")>0) $this->lv023=0;
		}
		//$this->lv024=ROUND(($this->lv078)*$this->lv025/$this->lv012,0);
		//echo "($this->lv078)*($vNgayCongTinh+$vCongTruW)/$this->lv012-$LuongCBNgay";
		if($this->mohr_lv0038->lv017==1)
		{
			if($vCheckPecialCongTru1Cong)
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012-$this->lv023,0);
			else
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012-$this->lv023,0);
		}
		else
		{
			if($vCheckPecialCongTru1Cong)
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012,0);
			else
				$this->lv024=ROUND(($this->lv078)*($vNgayCongTinh)/$this->lv012,0);
		}
		
		
		//Phu cap ca dem
		
		//Tăng ca thường
		//echo "$this->lv078/$vNgayCongTC/8*$this->lv015*1.5";
		$this->lv020=ROUND($this->lv078/$vNgayCongTC/8*$this->lv015*1.5,0);
		$this->lv020_=ROUND($this->lv078/$vNgayCongTC/8*$this->lv015,0);
		if($vPrev==0)
		{ 
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCTHUONG'")>0) $this->lv020=0;
		}
		
		//Tăng 200%
		$this->lv021=ROUND($this->lv078/$vNgayCongTC/8*$this->lv016*2,0);
		$this->lv021_=ROUND($this->lv078/$vNgayCongTC/8*$this->lv016,0);;
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCDEM'")>0) $this->lv021=0;
		}
		//Tăng ca 300%
		$this->lv022=ROUND($this->lv078/$vNgayCongTC/8*$this->lv017*3,0);
		$this->lv022_=ROUND($this->lv078/$vNgayCongTC/8*$this->lv017,0);
		if($vPrev==0)
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'");
		}
		else
		{
			if($this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'TCLE'")>0) $this->lv022=0;
		}
		
		
		$vTotalTCGiamThue=$this->lv020-$this->lv020_+$this->lv021-$this->lv021_+$this->lv022-$this->lv022_;
		//$vTotalTCGiamThue=0;
		$this->TotalTCGiamThue=$this->TotalTCGiamThue+$vTotalTCGiamThue;
		
		//Adward Bonus	
		if($vPrev==0)
		{
			
			//Tạm ứng lương
			$this->lv027=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'TAMUNG'");
			$this->lv071=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSNO'");//Tăng tiền
			$this->lv034=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS'");//Không tăng tiền
			$this->lv086=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUSTAXNO'");//Không tăng tiền
		}
		else
		{
			if($this->isTamUng>0)
				$this->lv027=$this->isTamUng;
			else
				$this->lv027=0;
			$this->lv086=0;
			$this->lv034=0;
			$this->lv071=0;
		}
		
		if($this->mohr_lv0038->lv024=="" || $this->mohr_lv0038->lv024==NULL)
			$this->lv100="VND";
		else
			$this->lv100=$this->mohr_lv0038->lv024;
		
		if($vPrev==0)
		{
			$this->lv031=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'ALLOWANCE'");
		}
		else
			$this->lv031=0;
			 
		//Total Earning before Deduction
		//echo "(float)$this->lv092+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031=";
		$this->lv033=(float)$this->lv092+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv075+$this->lv076+$this->lv077+$this->lv051+$this->lv020+$this->lv021+$this->lv022+$this->lv023+$this->lv024+$this->lv034+$this->lv029+$this->lv030+$this->lv031;
		
		/// Family-Per
		$this->lv065=$this->mohr_lv0020->lv049;
		// Family-amt
		//Currency	
		$this->lv059=$vObjCal->lv024;
		if($this->lv100!="VND")
		{
			if($this->lv059==0) $this->lv059=1;
			$this->lv066=$vObjCal->lv023*$this->lv065/$this->lv059;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015/$this->lv059;//Có xác đinh mức tính thue nguoi nuoc ngoai ko
		}
		else	
		{
			$this->lv066=$vObjCal->lv023*$this->lv065;			
			//Mốc tính thuế
			$this->lv067=$vObjCal->lv015;
		}

		if($vPrev==2)
		{
			$this->lv035=0;
			$this->lv036=0;
			$this->lv037=0;
			$this->lv038=0;
			$this->lv039=0;
			$this->lv040=0;
			$this->lv041=0;
			$this->lv042=0;
			$this->lv043=0;
		}
		//Lương T13
		if($vObjCal->lv021==1)
		{
			
				$this->lv083=($this->lv008+$this->lv051+$this->lv052+$this->lv053+$this->lv054+$this->lv055+$this->lv074+$this->lv077+$this->lv079+$this->lv072);
				$this->lv084=$this->lv083/30;
				$this->lv085=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'BONUS-T13'");
				$this->lv032=$this->lv084*$this->lv081+$this->lv085;
		}
		else
		{
			$this->lv081=0;
			$this->lv082='';
			$this->lv083=0;
			$this->lv084=0;
			$this->lv085=0;
			$this->lv032=0;
		}
		//Exemption		
		if($vPrev==0)
		{
			if($this->lv100!="VND") 
				$this->lv044=($vObjCal->lv015/$this->lv059+$this->lv066);
			else
				$this->lv044=($vObjCal->lv015+$this->lv066);
		}	
			
		else
			$this->lv044=0;
		if($vPrev==0)
		{
			//echo "$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$this->TotalTCGiamThue=";
			$this->lv070=$this->lv032+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$vTotalTCGiamThue-$this->lv092;
		}
		else
		{
			$this->lv070=$this->lv032+$this->lv070+$this->lv033-$this->lv044+$this->lv071-$this->lv043-$vTotalTCGiamThue-$this->lv092;
		}
		//if($this->lv070<0) $this->lv070=0;
		//Subject to Tax ( TNTT)
		
		/*if($this->lv070>0)
		{
			if($this->lv100!="VND") 
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070*$this->lv059,$vObjCal->lv099))/$this->lv059,2);
				$this->lv045=ROUND($this->GetTax($this->lv070*$this->lv059)/$this->lv059,0);
			}
			else
			{
				if($this->mohr_lv0038->lv019==1) $this->lv070=round($this->LV_SPIForSaleRun(str_replace($vObjCal->lv100,$this->lv070,$vObjCal->lv099)),0);
				$this->lv045=ROUND($this->GetTax($this->lv070),0);
			}
				
		}
		else
		{
			$this->lv045=0;
		}*/
		$this->lv045=0;
		$this->lv088=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'BONUS-DED'");//Trừ khác thưởng
		if($vPrev==0)
		{
			if($vTimeWorkPre>0) $this->lv045=0;
			//Other  deduction
			$this->lv046=$this->lv088+$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'OTHER-DED'");
			//Slry reimbursement
			$this->lv047=$this->GetExpensiveList($vEmployeeID,$vObjCal->lv001,"'SALARY-RE'");
			$this->lv087=$this->GetCostList($vEmployeeID,$vObjCal->lv001,"'DEDTAXNO'");//Không tăng tiền
		}
		else
		{
			$this->lv046=0;
			$this->lv047=0;
			$this->lv087=0;
		}
		//Total Deduction		
		if($this->mohr_lv0038->lv019==1)
			$this->lv048=$this->lv046+$this->lv027+$this->lv028;
		else
			$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027+$this->lv028;
		//Net pay
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		if($this->lv049<0 && $this->lv027>0 && (-$this->lv049)<$this->lv027 )
		{
			
			$this->isTamUng=-$this->lv049;
			$this->lv027=$this->lv027-$this->isTamUng;
			//Total Deduction		
			if($this->mohr_lv0038->lv019==1)
				$this->lv048=$this->lv046+$this->lv027+$this->lv028;
			else
				$this->lv048=$this->lv045+$this->lv046+ $this->lv043+$this->lv027+$this->lv028;
			//Net pay
			$this->lv049=$this->lv033-$this->lv048+$this->lv047+$this->lv086-$this->lv087-$this->lv009;
		}
		//Final Net Pay	
		$this->lv050=$this->lv049;
		$this->lv056=$this->mohr_lv0038->lv001;
		//Type Calculate
		$this->lv057=$this->mohr_lv0038->lv012;
		//DepartMent
		$this->lv058=$this->mohr_lv0020->lv029;
		//BankACount
		$this->lv061=$this->mohr_lv0020->lv014;
		//Brand bank
		$this->lv062=$this->mohr_lv0020->lv106;
		//Lương chính trước thuế
		$this->lv085=$this->lv033-$this->lv025;
		///Xét cập nhật thuế
		//0 PIT trừ Thuong,1 PIT trừ Luong CHinh, 2 PIT trừ luong cả hai
		
		//Tên Nhân Viên;
		$this->lv007=$vEmployeeID;
		$vclv101=0;
		$this->lv069=0;
		$this->lv001=$this->CheckExist($vObjCal->lv001,$vEmployeeID,$this->mohr_lv0038->lv001,$vclv101);
		$vIsCal=false;
		switch((int)$vObjCal->lv098)
		{
			case 2:
				$vIsCal=true;
				break; //Tất cả trường hợp;
			case 1:
				// Có công có lương hoặc thai sản hoặc nghỉ SL
				if((($this->lv049>0 && ($this->lv025)>0)|| $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				break;
			case 0:
				//Không công và không lương ngày làm và ngày nghỉ thì cho phép lên
				//năm tháng vào làm <= năm tháng tín lương 
				$vIsCal=true;
				//if(( $vArrEmp["$vEmployeeID"][0]['ISTS']==true || $vArrEmp["$vEmployeeID"][0]['ISSL']==true)) $vIsCal=true;
				if((float)str_replace("-","",$this->mohr_lv0020->lv030)>(float)str_replace("-","",$vObjCal->lv005)) $vIsCal=false;
				if((float)str_replace("-","",$this->mohr_lv0020->lv044)<(float)str_replace("-","",$vObjCal->lv004) && getyear($this->mohr_lv0020->lv044)>2014 ) $vIsCal=false;
				break;
		}
		if($this->lv001==-1 && ($vIsCal))
		{
			$this->LV_Insert();
		}
		else
			if($vclv101==0)		$this->LV_Update();
	}
	function Get_PercentTimecode($CalculateID,$TimeCode)
	{
		$lvsql="select lv004 from tc_lv0014 where lv002='$CalculateID' and lv003='$TimeCode'";
		$vReturn= db_query($lvsql);
		if($vReturn)
		{
			$vrow=db_fetch_array($vReturn);
			if($vrow['lv004']>0)
			{
			 return $vrow['lv004'];
			}
		}
		return 0;
	}
	function GetTime($vTime)
	{
		$vArrH=explode(":",$vTime);
			$vHours=(float)$vArrH[0] ;
			$vMinutes=(float)$vArrH[1];
			$vSecond=(float)$vArrH[2];
			$vMinutes=(int)($vSecond/60)+$vMinutes;
			$vSecond=$vSecond%60;
			$vHours=$vHours+(int)($vMinutes/60)+(($vMinutes%60)/60);	
			return $vHours;
	}

	function CheckExist($vCalculateTimesID,$vEmployeeID,$vPreCal,&$vlv001=0)
	{
		
		$lvsql="select lv001,lv063  from  tc_lv0021 Where lv002='$vEmployeeID' and lv060='$vCalculateTimesID' and lv056='$vPreCal'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			$vlv001=$vrow['lv063'];		
			return $vrow['lv001'];		
			
		}
		return -1;
	}
	function GetMoneyItem($vCalculateTimesID,$vEmployeeID)
	{
		$lvsql="select sum(A.lv006*(IF(ISNULL(B.lv004*D.lv003),0,B.lv004*D.lv003))*(IF(ISNULL(C.lv004),0,C.lv004)/100)) sumqty from  tc_lv0026 A left join tc_lv0015 B on A.lv005=B.lv003 and B.lv002=A.lv003 left join tc_lv0025 C on A.lv007=C.lv001 left join hr_lv0018 D on B.lv005=D.lv001  Where A.lv002='$vEmployeeID' and A.lv003='$vCalculateTimesID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetItemTimecard($vCalculateTimesID,$vEmployeeID)
	{
		$lvList='lv001,lv002,lv003,lv004,lv005,lv006,lv007';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"0","lv004"=>"1","lv005"=>"1","lv006"=>"1","lv007"=>"1");
		$lvOrderList='0,1,2,3,4,5,6';
		if($this->isRpt==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$lvTable="
		<div align=\"center\" class=lv0>".($this->ArrTime1CordPush[0])."</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		<tr class=\"lvlineboldtable\"><td colspan=6>".($this->ArrTime1CordPush[9])."</td><td>@#02</td></tr>
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
		$sqlS="select MP.lv001,MP.lv002,MP.lv003,sum(MP.lv004) lv004,MP.lv005,MP.lv006,sum(MP.lv007) lv007 from (select A.lv005 lv001,D.lv002 lv002,C.lv003 lv003,A.lv006 lv004,C.lv004 lv005,B.lv004*E.lv003 lv006,A.lv006*(IF(ISNULL(B.lv004*E.lv003),0,B.lv004*E.lv003))*(IF(ISNULL(C.lv004),0,C.lv004)/100) lv007 from  tc_lv0026 A left join tc_lv0015 B on A.lv005=B.lv003 and B.lv002=A.lv003 left join tc_lv0025 C on A.lv007=C.lv001 left join sl_lv0007 D on A.lv005=D.lv001 left join  hr_lv0018 E on B.lv005=E.lv001 Where A.lv002='$vEmployeeID' and A.lv003='$vCalculateTimesID') MP group by lv001,lv002,lv003,lv005,lv006";
		$vSumSalary=0;
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTime1CordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			 $vSumSalary= $vSumSalary+$vrow['lv006'];
			for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]]),$lvTd);
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
		
		
	}
	function GetQuantityItem($vCalculateTimesID,$vEmployeeID)
	{
		$lvsql="select sum(lv006) sumqty from  tc_lv0026 Where lv002='$vEmployeeID' and lv003='$vCalculateTimesID'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetNightShift($vCalculateTimesID,$vEmployeeID,$vTimeCode)
	{
		$lvsql="select sum(lv004) sumqty from  tc_lv0046 Where lv006='$vEmployeeID' and lv002='$vCalculateTimesID' and lv003='$vTimeCode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetNightShiftPrice($vCalculateTimesID,$vEmployeeID,$vTimeCode)
	{
		$lvsql="select sum(lv004*lv008) sumqty from  tc_lv0046 Where lv006='$vEmployeeID' and lv002='$vCalculateTimesID' and lv003='$vTimeCode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function GetNightShiftNum($vCalculateTimesID,$vEmployeeID,$vTimeCode)
	{
		$lvsql="select count(*) sumqty from  tc_lv0046 Where lv006='$vEmployeeID' and lv002='$vCalculateTimesID' and lv003='$vTimeCode'";
		$vresult=db_query($lvsql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['sumqty'];		
		}
		return 0;
	}
	function PreGetSalaryOpt($vEmployeeID,$vOpt,$vHDID)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where A.lv002='$vEmployeeID' and A.lv007='$vOpt' and A.lv003='$vHDID'";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetSalaryOpt($vEmployeeID,$vOpt)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where A.lv002='$vEmployeeID' and A.lv007='$vOpt' and A.lv003 in (select BB.lv001 from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetSalaryOptLoan($vEmployeeID,$vOpt,$vMonth,$vYear)
	{
		$vMonth=(int)$vMonth;
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where 1=1 AND CAST(concat(year(lv008),month(lv008)) as UNSIGNED)<=CAST('$vYear$vMonth'  as UNSIGNED) AND CAST(concat(year(lv009),month(lv009))  as UNSIGNED)>=CAST('$vYear$vMonth'  as UNSIGNED) AND A.lv002='$vEmployeeID' and A.lv007='$vOpt' and A.lv003 in (select BB.lv001 from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetSalaryBasic($vEmployeeID,$vBasic)
	{
		$vsql="select sum(lv005*B.lv003) TotalMoney from hr_lv0042 A inner join hr_lv0018 B on A.lv006=B.lv001  where A.lv002='$vEmployeeID' and A.lv004='$vBasic' and A.lv003 in (select BB.lv001 from  hr_lv0038 BB where BB.lv002='$vEmployeeID' and BB.lv009=1)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
		return 0;
	}
	function GetExpensive($vEmployeeID,$vCalculateTimesID)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from tc_lv0017 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID'  and A.lv003='$vCalculateTimesID' ";//and A.lv008='1' and A.lv003='$vCalculateTimesID' ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetExpensiveList($vEmployeeID,$vCalculateTimesID,$listCode)
	{
		$vsql="select sum(A.lv005*B.lv003) TotalMoney from tc_lv0017 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID'  and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";//and A.lv008='1' and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode) ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetCost($vEmployeeID,$vCalculateTimesID)
	{
		$vsql="select sum(lv005*B.lv003) TotalMoney from tc_lv0023 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID'  and A.lv003='$vCalculateTimesID'";//and A.lv008='1' and A.lv003='$vCalculateTimesID'";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetCostList($vEmployeeID,$vCalculateTimesID,$listCode)
	{
		$vsql="select sum(lv005*B.lv003) TotalMoney from tc_lv0023 A inner join hr_lv0018 B on A.lv006=B.lv001 where A.lv002='$vEmployeeID'  and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode)";//and A.lv008='1' and A.lv003='$vCalculateTimesID' and A.lv004 in($listCode)";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow['TotalMoney'];
		}
	}
	function GetCalculate($vCalculateTimesID,$vField)
	{
		$vsql="select $vField from tc_lv0013 where lv001='$vCalculateTimesID' ";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		
			return $vrow["$vField"];
		}
	}
	function LV_GetPrevCal($vEmployeeID,$vPreCalID,$vField)
	{
		$vsql="select $vField from tc_lv0021 where lv002='$vEmployeeID' and lv060='$vPreCalID'";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		   return $vrow["$vField"];
		}
	}
	function LV_GetPrevCalInYear($vEmployeeID,$vPreCalID,$vMonth,$vYear,$vField)
	{
		$vsql="select sum($vField) AllGet from tc_lv0021 where lv002='$vEmployeeID' and lv060='$vPreCalID' and YEAR(lv005)=$vYear and MONTH(lv005)<$vMonth";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		   return $vrow["AllGet"];
		}
	}
	function GetContract($vEmployeeID,$vField)
	{
		$vsql="select $vField from hr_lv0038 where lv002='$vEmployeeID' and lv009=1";
		$vresult=db_query($vsql);
		if($vresult)
		{$vrow=db_fetch_array($vresult);
		   return $vrow["$vField"];
		}
	}
	function LV_GetListCalendar($vListEmployeeID,$vField)
	{
		if($this->ArrCalendar[$vListEmployeeID][0]==true) $this->ArrCalendar[$vListEmployeeID][1];
		$vsql="select $vField from tc_lv0010 where lv002 in ($vListEmployeeID)";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
		}
		$this->ArrCalendar[$vListEmployeeID][0]=true;
		$this->ArrCalendar[$vListEmployeeID][1]=$strReturn;
		return $strReturn;

	}
	function GetBuilCalendar($vEmployeeID,$vField)
	{
		$vsql="select $vField from tc_lv0010 where lv002='$vEmployeeID'";
		$vresult=db_query($vsql);
		$strReturn="";
		if($vresult)
		{
			while($vrow=db_fetch_array($vresult))
			{
		   		if($strReturn=="") $strReturn="'".$vrow["$vField"]."'";
				else $strReturn=$strReturn.",'".$vrow["$vField"]."'";
			}
			return $strReturn;
		}
	}
	//Used sql server
	function Gethours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A ) PM) SM;";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
	}
	//Used mysql server	
	function Gethours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond  ) PM";
				else
				 $strTemp=$strTemp." Union select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond  ) PM";
				
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;			
		}
		return 0;
	}
	function GethoursPN($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select count(*) SumHours  from tc_lv0011 A1 where A1.lv100<>1 And  A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004' and A1.lv007='PN' and A1.lv002 in (".$calendar.")";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
	}
	//Used sql server
	function GetAllhours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,100 PerCent,(select sum(left(A1.lv005,2)) +sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A ) PM) SM;";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;	
	}
	//Used MySql
	function GetAllhours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv001']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) +sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond  ) PM ";
				else
				 $strTemp=$strTemp." Union  select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100),0,IF(PM.lv004=1,100,PM.PerCent)*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv005,2)) +sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM";
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;			
		}	
		return 0;		
	}
	function GetTimeCodehours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vTimeCode)
	{
		$calendar=$this->GetBuilCalendar($vEmployeeID,'lv001');
		if($calendar=="") $calendar="''";
		$lvList='lv001,lv002,lv003,lv004,lv005,lv006';
		$ArrView=array("lv001"=>"0","lv002"=>"0","lv003"=>"1","lv004"=>"1","lv005"=>"1","lv006"=>"1");
		$lvOrderList='0,1,2,3,4,5,6';
		if($this->isRpt==0) return false;
		$lstArr=explode(",",$lvList);
		$lstOrdArr=explode(",",$lvOrderList);
		$lstArr=$this->getsort($lstArr,$lstOrdArr);
		$lvTable="
		<div align=\"center\" class=lv0>".($this->ArrTimeCordPush[0])."</div>
		<table  align=\"center\" class=\"lvtable\" border=1 cellspacing=\"0\" cellpadding=\"0\">
		@#01
		<tr class=\"lvlineboldtable\"><td colspan=5 >".($this->ArrTimeCordPush[8])."</td><td>@#02</td></tr>
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
		 $sqlS="select VM.lv001,C.lv002 lv002,VM.lv003,VM.lv005,sum(VM.lv004) lv004,sum(VM.lv006) lv006 from(select PM.lv001 lv001,PM.PerCent lv003,(IF(ISNULL(PM.SumHour/100),0,PM.SumHour)) lv004,$vSalaryPerHours lv005, $vSalaryPerHours*(IF(ISNULL(PM.SumHour/100),0,PM.SumHour))*PM.PerCent/100 lv006 from (select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004!='1') PM
		UNION
		 select PM.lv001 lv001,PM.PerCent lv003,(IF(ISNULL(PM.SumHour/100),0,PM.SumHour) ) lv004,$vSalaryPerHours lv005, $vSalaryPerHours*(IF(ISNULL(PM.SumHour/100),0,PM.SumHour))*PM.PerCent/100 lv006 from (select A.lv001,A.lv002,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1') PM
		 UNION
		 select PM.lv001 lv001	,PM.PerCent lv003,(IF(ISNULL(PM.SumHour/100),0,PM.SumHour) ) lv004,$vSalaryPerHours lv005, $vSalaryPerHours*(IF(ISNULL(PM.SumHour/100),0,PM.SumHour))*PM.PerCent/100 lv006 from (select '$vTimeCode' lv001,A.lv002,A.lv004,100 PerCent,(select sum(left(A1.lv005,2))+sum(substr(A1.lv005,4,5))/60+sum(substr(A1.lv005,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A where A.lv004='1') PM) VM left join tc_lv0002 C on VM.lv001=C.lv001   GROUP BY lv001,lv003,lv005;";
		 $vSumSalary=0;
		$vorder=$curRow;
		$bResult = db_query($sqlS);
		if($bResult ) {
		$this->Count=db_num_rows($bResult);
		$strTrH="";
		$strTr="";
		for($i=0;$i<count($lstArr);$i++)
			{
				$vTemp=str_replace("@01","",$lvTdH);
				$vTemp=str_replace("@02",$this->ArrTimeCordPush[(int)$this->ArrGet[$lstArr[$i]]],$vTemp);
				$strH=$strH.$vTemp;
				
			}
			
		while ($vrow = db_fetch_array ($bResult)){
			$strL="";
			$vorder++;
			 $vSumSalary= $vSumSalary+$vrow['lv006'];
			for($i=0;$i<count($lstArr);$i++)
			{
				
				$vTemp=str_replace("@02",$this->FormatView($vrow[$lstArr[$i]],(int)$ArrView[$lstArr[$i]]),$lvTd);
				$strL=$strL.$vTemp;
			}


			$strTr=$strTr.str_replace("@#01",$strL,str_replace("@02",$vrow['lv001'],str_replace("@03",$vorder,str_replace("@01",$vorder%2,$lvTr))));
			if($vrow['lv011']==1)		$strTr=str_replace("@#04","lvlineapproval",$strTr);
			else	$strTr=str_replace("@#04","",$strTr);
			
		}
		}
		$strTrH=str_replace("@#01",$strH,$lvTrH);
		return str_replace("@#01",$strTrH.$strTr,$lvTable);
	}
	function GetOverHours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003=A.lv001) PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A  where A.lv004='$vopt') PM) SM;";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
	}	
	function GetOverHours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002 where lv004='$vopt'";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			else
				 $strTemp=$strTemp." Union  select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,(select A1.lv004 from tc_lv0014 A1 where A1.lv002='$vObjCal->lv001' and A1.lv003='".$vrow['lv001']."') PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;
			
		}	
		
		
	}
	
	function GetAllOverHours($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select * from tc_lv0002 where lv004='$vopt'";
		$vresult=db_query($vsql);
		if($vresult)
		{
			$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (";
			$strTemp="";																								
			while($vrow=db_fetch_array($vresult))
			{
				if($strTemp=="")
				$strTemp=" select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			else
				 $strTemp=$strTemp." Union  select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select '".$vrow['lv001']."' lv001,'".$vrow['lv004']."' lv004,100 PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 And A1.lv007='".$vrow['lv001']."' and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond ) PM ";
			}
		$vsql=$vsql.$strTemp.") SM;";
		$vresult1=db_query($vsql);
		if($vresult1)
		{
			$vrow1=db_fetch_array($vresult1);
			return $vrow1['SumHours'];
		}	
		else
			return 0;
		}
		return 0;
	}
	function GetAllOverHours_Old($vCalculateTimesID,$vEmployeeID,$vSalaryPerHours,$vObjCal,$vopt,$calendar)
	{
		$vsql="select SUM(SM.SumHourPercent+SM.SumMinutePercent+SM.SumSecondPercent) SumHours from (select PM.lv001,PM.lv004,PM.PerCent,IF(ISNULL(PM.PerCent*PM.SumHour/100),0,PM.PerCent*PM.SumHour/100) SumHourPercent,0 SumMinutePercent,0 SumSecondPercent  from (select A.lv001,A.lv004,100 PerCent,(select sum(left(A1.lv006,2))+sum(substr(A1.lv006,4,5))/60+sum(substr(A1.lv006,7,8))/360 from tc_lv0011 A1 where A1.lv100<>1 and A1.lv007=A.lv001 and A1.lv002 in (".$calendar.") and (A1.lv004<='$vObjCal->lv005' and A1.lv004>='$vObjCal->lv004') ) SumHour,0 SumMinute,0 SumSecond from tc_lv0002 A  where A.lv004='$vopt') PM) SM;";
	$vresult=db_query($vsql);
		if($vresult)
		{
			$vrow=db_fetch_array($vresult);
			return $vrow['SumHours'];
		}	
		else
			return 0;
		
		
	}
	function GetTax($vSalaray)//Get percent of tax
	{
		$vReturn=0;
		$i=0;
		$vFrom[0]=0;
		$vTo[0]=0;		
		$vPerCal[0]=0;
		$vsql="select * from  tc_lv0005 A where A.lv002<$vSalaray Order by lv004 ";
		$vresult=db_query($vsql);
		while($vrow=db_fetch_array($vresult))
		{
			$vFrom[$i]=$vrow['lv002'];
			$vTo[$i]=$vrow['lv003'];
			$vPerCal[$i]=$vrow['lv004'];
			$i=$i+1;			
			
		}				
		for($j=0;$j<$i;$j++)
		{
			if($j==$i-1)
			{
				$vReturn=$vReturn+($vSalaray-$vFrom[$j])*$vPerCal[$j]/100;		
			}
			else
			{
				$vReturn=$vReturn+($vTo[$j]-$vFrom[$j])*$vPerCal[$j]/100;		
			}
		}
		return $vReturn;
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
				$vsql="select lv001,concat(lv004,' ',lv003,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020";
				break;	
			case 'lv060':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013";
				break;
			case 'lv058':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002";
				break;
			case 'lv057':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032";
				break;
			case 'lv100':
				$vsql="select lv001,lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018";
				break;
			default:
				break;
		}
		return $vsql;
	}
	public  function getvaluelink($vFile,$vSelectID)
	{
		switch($vFile)
		{
			case 'lv007':
				$vsql="select lv001,concat(lv004,' ',lv003,' ',lv002) lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0020 where lv001='$vSelectID'";	//concat(lv004,' ',lv003,' ',lv002)
				break;
			case 'lv060':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0013 where lv001='$vSelectID'";	
				break;
			case 'lv058':
				$vsql="select lv001,lv003 lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0002 where lv001='$vSelectID'";	
				break;
			case 'lv057':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  tc_lv0032 where lv001='$vSelectID'";	
				break;
			case 'lv100':
				$vsql="select lv001, lv002,IF(lv001='$vSelectID',1,0) lv003 from  hr_lv0018 where lv001='$vSelectID'";	
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