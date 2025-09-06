<?php
class ac_lv0103 extends lv_controler{
public $lvobj=null;	
	var $vRowHeader="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"25%\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@06</b></td>
			</tr>
		@01
		</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var $vRowHeaderAll="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\">
				<td class=\"tdhprint\" width=\"10%\" align=\"center\"><b>@02</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@03</b></td>
				<td class=\"tdhprint\" width=\"*\" align=\"center\"><b>@04</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@05</b></td>
				<td class=\"tdhprint\" width=\"15%\" align=\"center\"><b>@06</b></td>
				<td class=\"tdhprint\" width=\"20%\" align=\"center\"><b>@07</b></td>
			</tr>
		@01
		</table>";
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
	function LV_Get_No_CoDauKy($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,$opt='',$lvobj)
	{
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="") 	
		{		
			$vAddCond2=$vAddCond2." AND B.lv009< '$vDateEnd'";			
			
		}		
		if($strlv005!="") 	$vAddCond2=$vAddCond2." AND A.lv005 = '$strlv005'";			
		if($strlv006!="") 	$vAddCond2=$vAddCond2." AND A.lv006 = '$strlv006'";
		
		$vCondition2 = $vAddCond2.$vAddCond;
		if($vDateStart!="") 	$vAddCond=$vAddCond." AND B.lv009< '$vDateStart'";			
		if($strlv005!="") 	{
			//$vAddCond=$vAddCond." AND ( A.lv005 like '".$strlv005."' OR A.lv006 like '".$strlv006."' )";
		}
		//if($opt!="") $vAddCond=$vAddCond." AND B.lv002=$opt ";	
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";

		if($vAddCond!="") $vCondition = $vCondition.$vAddCond;
		if($opt==0)
		{
			if($strlv005=="")
			{
				$sqldauky="select sum(lv003) sumdauky from ac_lv0148 where lv001 in (select A.lv005  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where  (B.lv017=0 or B.lv017=12) $vCondition2)";
			}
			else
			{
				$sqldauky="select sum(lv003) sumdauky from ac_lv0148 where lv001='$strlv005'";
			}
		$sqlS = "SELECT SUM(sumall) sumall FROM (select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004)) sumall from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv005 like '".$strlv005."')  AND B.lv017 in (8,7,0,12,13)  $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001 where (A.lv010 like '".$strlv005."' ) AND (A.lv011 not like '0%') AND B.lv017 in (1)  $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv018 not like '0%')  AND B.lv017 in (1) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001 where (A.lv010 like '".$strlv005."' ) AND (A.lv011 not like '0%') AND B.lv017 in (3)  $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv018 like '".$strlv005."') AND (A.lv011 not like '0%')  AND B.lv017 in (3) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall  from ac_lv0017 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv009 like '".$strlv005."') AND (A.lv010 not like '0%')  AND B.lv017 in (14) $vCondition 
		 ";
		$lvobj->lv008;
		  switch($lvobj->lv008)
		 {
			case 'BQGQ': $sqlS = $sqlS."
				UNION
			 		select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (9) AND B.lv002=0 $vCondition
				UNION
			 		select IF(ISNULL(sum(G.lv006*A.lv004)),0,sum(G.lv006*A.lv004))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  left join ac_lv0118 G on G.lv003=A.lv003 and G.lv004=A.lv009 and G.lv008=Year(B.lv009) and G.lv007=Month(B.lv009)   where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (9) AND B.lv002=1 $vCondition";
			 	break;
			case 'FIFO':
			case 'LIFO':
			case 'DIDA': $sqlS = $sqlS."
			UNION
		 		select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (9) AND B.lv002=0 $vCondition
			UNION
				select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004*IF(ISNULL((select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)),0,(select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1))))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (9) AND B.lv002=1 $vCondition";
				break;
		 } $sqlS = $sqlS.") MP";
		
		}
		else
		{
			if($strlv005=="")
			{
				$sqldauky="select sum(lv005) sumdauky from ac_lv0148 where lv001 in (select A.lv005  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where  (B.lv017=0 or B.lv017=12) $vCondition2)";
			}
			else
			{
				$sqldauky="select sum(lv005) sumdauky from ac_lv0148 where lv001='$strlv005'";
			}	
		$sqlS = "SELECT SUM(sumall) sumall FROM (select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004)) sumall from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv006 like '".$strlv005."')  AND B.lv017 in (8,7,0,12,13)   $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (1) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv018 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (1) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (3) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv018 not like '0%') AND B.lv017 in (3) $vCondition
		 UNION
		 select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall  from ac_lv0017 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv009 not like '0%')  AND B.lv017 in (14) $vCondition

		";
				switch($lvobj->lv008)
		 {
			case 'BQGQ':	
				$sqlS = $sqlS."
				UNION
					select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (9) AND B.lv002=0 $vCondition
				UNION
					select IF(ISNULL(sum(G.lv006*A.lv004)),0,sum(G.lv006*A.lv004))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  left join ac_lv0118 G on G.lv003=A.lv003 and G.lv004=A.lv009 and G.lv008=Year(B.lv009) and G.lv007=Month(B.lv009)   where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (9)  AND B.lv002=1 $vCondition";
			 	break;
			case 'FIFO':
			case 'LIFO':
			case 'DIDA':
				$sqlS = $sqlS."
				UNION
					select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (9) AND B.lv002=0 $vCondition
				UNION
				 	select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004*IF(ISNULL((select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)),0,(select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1))))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (9) AND B.lv002=1 $vCondition";
				break;
		 } $sqlS = $sqlS.") MP";
		}
		$bResultS = db_query($sqlS);
		$row=db_fetch_array($bResultS);
		$bResultS1 = db_query($sqldauky);
		$row1=db_fetch_array($bResultS1);
		return $row['sumall']+$row1['sumdauky'];
	}
	function LV_Get_No_CoPhatSinh($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,$opt='',$lvobj)
	{
		$vCondition="";
		$vAddCond=""; 
		if($vDateStart!="") 	$vAddCond=$vAddCond." AND B.lv009>= '$vDateStart'";		
		if($vDateEnd!="") 	$vAddCond=$vAddCond." AND B.lv009<= '$vDateEnd'";				
		if($strlv005!="") 	{
			//$vAddCond=$vAddCond." AND ( A.lv005 like '".$strlv005."' OR A.lv006 like '".$strlv006."' )";
		}
		//if($opt!="") $vAddCond=$vAddCond." AND B.lv002=$opt ";	
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition.$vAddCond;
		if($opt==0)
		{
		$sqlS = "SELECT SUM(sumall) sumall FROM (select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004)) sumall from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv005 like '".$strlv005."') AND B.lv017 in (8,7,0,12,13)  $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001 where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (1)  $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv018 not like '0%')  AND B.lv017 in (1) $vCondition
		 UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001 where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (3)  $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv018 like '".$strlv005."') AND (A.lv011 not like '0%')  AND B.lv017 in (3) $vCondition
		 UNION
		 select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall  from ac_lv0017 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv009 like '".$strlv005."') AND (A.lv010 not like '0%')  AND B.lv017 in (14) $vCondition
		";
		 switch($lvobj->lv008)
		 {
			case 'BQGQ': $sqlS = $sqlS."
					UNION
						select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%')  AND B.lv017 in (9) AND B.lv002=0 $vCondition
					UNION
		 				select IF(ISNULL(sum(G.lv006*A.lv004)),0,sum(G.lv006*A.lv004))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  left join ac_lv0118 G on G.lv003=A.lv003 and G.lv004=A.lv009 and G.lv008=Year(B.lv009) and G.lv007=Month(B.lv009)   where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (9) AND B.lv002=1 $vCondition";
			 	break;
			case 'FIFO':
			case 'LIFO':
			case 'DIDA': $sqlS = $sqlS."
					UNION
						select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%')  AND B.lv017 in (9) AND B.lv002=0 $vCondition
					UNION
					 	select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004*IF(ISNULL((select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)),0,(select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1))))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND B.lv017 in (9) AND B.lv002=1 $vCondition";
				break;
		 } $sqlS = $sqlS.") MP";
		}
		else
		{
		$sqlS = "SELECT SUM(sumall) sumall FROM (select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004)) sumall from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv006 like '".$strlv006."') AND B.lv017 in (8,7,0,12,13)   $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (1) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv018 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (1) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv009)),0,sum(A.lv009))  sumall from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."')  AND (A.lv010 not like '0%') AND B.lv017 in (3) $vCondition
 		UNION
		 select IF(ISNULL(sum(A.lv017)),0,sum(A.lv017))  sumall from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv018 not like '0%')  AND B.lv017 in (3) $vCondition
		UNION
		 select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall  from ac_lv0017 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv009 not like '0%')  AND B.lv017 in (14) $vCondition
		";
		switch($lvobj->lv008)
		 {
			case 'BQGQ':	
				$sqlS = $sqlS."UNION
					select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%')  AND B.lv017 in (9) AND B.lv002=0 $vCondition
				UNION
		 			select IF(ISNULL(sum(G.lv006*A.lv004)),0,sum(G.lv006*A.lv004))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  left join ac_lv0118 G on G.lv003=A.lv003 and G.lv004=A.lv009 and G.lv008=Year(B.lv009) and G.lv007=Month(B.lv009)   where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (9)  AND B.lv002=1 $vCondition";
			 	break;
			case 'FIFO':
			case 'LIFO':
			case 'DIDA':
				$sqlS = $sqlS."
				UNION
					select IF(ISNULL(sum(A.lv008)),0,sum(A.lv008))  sumall from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001  where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%')  AND B.lv017 in (9) AND B.lv002=0 $vCondition
				UNION
					select IF(ISNULL(sum(A.lv004)),0,sum(A.lv004*IF(ISNULL((select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)),0,(select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1))))  sumall  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001   where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND B.lv017 in (9) AND B.lv002=1 $vCondition";
				break;
		 } $sqlS = $sqlS.") MP";
		}
		$bResultS = db_query($sqlS);
		$row=db_fetch_array($bResultS);
		return $row['sumall'];
	}
	
function PrintInOutPutInStockDetail($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,$lvobj)
	{
		$typeaccount=$this->LV_AccountType($strlv005);
		$CoDK=$this->LV_Get_No_CoDauKy($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"1",$lvobj);
		$NoDK=$this->LV_Get_No_CoDauKy($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"0",$lvobj);
		$CoPS=$this->LV_Get_No_CoPhatSinh($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"1",$lvobj);
		$NoPS=$this->LV_Get_No_CoPhatSinh($plang, $vArrLang,$vlv001,$vDateStart,$vDateEnd,$stropt,$strlv005,$strlv006,"0",$lvobj);
		if($CoPS==NULL) $CoPS=0;
		if($NoDK==NULL) $NoDK=0;
		if($CoDK==NULL) $CoDK=0;
		if($NoPS==NULL) $NoPS=0;		
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"30px\" class=\"tblcaption\">
				<td class=\"htable\" width=\"3%\" >@02</td>
				<td class=\"htable\" width=\"4%\" >@03</td>
				<td class=\"htable\" width=\"2%\" >@04</td>
				<td class=\"htable\" width=\"2%\" >@05</td>
				<td class=\"htable\" width=\"*%\" >@06</td>
				<td class=\"htable\" width=\"5%\" >@07</td>
				<td class=\"htable\" width=\"10%\" >@08</td>				
				<td class=\"htable\" width=\"*%\" >@09</td>
				<td class=\"htable\" width=\"4%\" >@10</td>
				<td class=\"htable\" width=\"6%\" >@12</td>
				<td class=\"htable\" width=\"6%\" >@13</td>
				<!--<td class=\"htable\" width=\"10%\" >@14</td>-->
				<td class=\"htable\" width=\"6%\" >@15</td>
				<td class=\"htable\" width=\"12%\" >@11</td>
			</tr>";

	$vHeaderReportInventory=$vHeaderReportInventory."			
			<tr>
				<td class=\"center_style\" colspan=7>&nbsp;</td>
				<td class=\"right_style\" >Số dư nợ đầu kỳ:</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >".(($typeaccount==1)?$this->FormatView($NoDK -$CoDK,10):"&nbsp;")."</td>
				<td class=\"right_style\" >".(($typeaccount==2)?$this->FormatView($CoDK-$NoDK,10):"&nbsp;")."</td>	
				<td class=\"right_style\" >&nbsp;</td>	
				<td class=\"right_style\" >&nbsp;</td>
			</tr>
";	
$vHeaderReportInventory=$vHeaderReportInventory."<tr>
				<td class=\"center_style\" colspan=7>&nbsp;</td>
				<td class=\"right_style\" >Tổng phát sinh trong kỳ:</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >".$this->FormatView($NoPS,10)."</td>	
				<td class=\"right_style\" >".$this->FormatView($CoPS,10)."</td>	
				<td class=\"right_style\" >&nbsp;</td>	
				<td class=\"right_style\" >&nbsp;</td>
			</tr>
";
if($typeaccount==1)
{
	$vMoneyNo=$NoDK -$CoDK+$NoPS-$CoPS;
	if($vMoneyNo<0)
	{
		$typeaccount=2;
		$vMoneyCo=-$vMoneyNo;
	}
	
}
else
{
	$vMoneyCo=$CoDK-$NoDK-$NoPS+$CoPS;
	if($vMoneyCo<0)
	{
		$typeaccount=1;
		$vMoneyNo=-$vMoneyCo;
	}
	
}
$vHeaderReportInventory=$vHeaderReportInventory."<tr>
				<td class=\"center_style\" colspan=7>&nbsp;</td>
				<td class=\"right_style\" >Số dư cuối kỳ:</td>
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >".(($typeaccount==1)?$this->FormatView($vMoneyNo,10):"&nbsp;")."</td>	
				<td class=\"right_style\" >".(($typeaccount==2)?$this->FormatView($vMoneyCo,10):"&nbsp;")."</td>	
				<td class=\"right_style\" >&nbsp;</td>
				<td class=\"right_style\" >&nbsp;</td>
			</tr>
";
$vHeaderReportInventory=$vHeaderReportInventory."
			@01
		</table>";		
		
		$vRowFirst="
			<tr>
				<td class=\"center_style\" >@02</td>
				<td class=\"left_style\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"left_style\" >@06</td>
				<td class=\"left_style\" >@07</td>
				<td class=\"left_style\" >@08</td>
				<td class=\"left_style\" >@09</td>	
				<td class=\"left_style\" >@10</td>		
				<td class=\"right_style\" >@12</td>	
				<td class=\"right_style\" >@13</td>	
				<!--<td class=\"right_style\" >@14</td>	-->
				<td class=\"left_style\" >@15</td>	
				<td class=\"left_style\" >@11</td>				
			</tr><!--
			<tr>
				<td colspan=\"13\">@20<td>
			</tr>-->
			";

		$vRowLightText="
			<tr>
				td class=\"center_style\" >@02</td>
				<td class=\"left_style\" >@03</td>
				<td class=\"left_style\" >@04</td>
				<td class=\"left_style\" >@05</td>
				<td class=\"right_style\" >@06</td>
				<td class=\"right_style\" >@07</td>
				<td class=\"right_style\" >@08</td>
				<td class=\"right_style\" >@09</td>	
				<td class=\"right_style\" >@10</td>	
				<td class=\"right_style\" >@12</td>	
				<td class=\"right_style\" >@13</td>	
				<!--<td class=\"right_style\" >@14</td>	-->
				<td class=\"right_style\" >@15</td>	
				<td class=\"right_style\" >@11</td>	
			</tr>";
		$vCondition="";
		$vAddCond=""; 
		$vAddCond1="";
		if($vDateStart!="") {
			$vAddCond=$vAddCond." AND B.lv009>= '$vDateStart'";	
			$vAddCond1=$vAddCond1." AND B.lv009>= '$vDateStart'";	
		}
		if($vDateEnd!="") {
			$vAddCond=$vAddCond." AND B.lv009<= '$vDateEnd'";	
			$vAddCond1=$vAddCond1." AND B.lv009<= '$vDateEnd'";	
		}
		if($strlv005!="") 	{
		//	$vAddCond=$vAddCond." AND ( A.lv005 like '".$strlv005."' OR A.lv006 like '".$strlv006."' )";
			//$vAddCond1=$vAddCond1." AND ( A.lv010 like '".$strlv005."' OR A.lv011 = '$strlv006' )";
		}		
//		if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";

		if($vAddCond!="") $vCondition = $vCondition.$vAddCond;
		$vConditionStock="";
		if($strlv003!="") $vConditionStock = "";	
		$sqlS = "SELECT * FROM(		    
			select A.lv001,A.lv002,A.lv003,A.lv004,A.lv006 Account,A.lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,0 TypeView  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv006=EE.lv001  where A.lv005 like '".$strlv005."' AND B.lv017 in (8,7,0,12,13) $vCondition																																																																																																																															 		  UNION																																																																																																																																  			select A.lv001,A.lv002,A.lv003,A.lv004,A.lv005 Account,A.lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,1 TypeView  from ac_lv0005 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv005=EE.lv001  where A.lv006 like '".$strlv006."' AND B.lv017 in (8,7,0,12,13) $vCondition																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																	
		  UNION
		  	select A.lv001,A.lv002,A.lv016 lv003,A.lv017 lv004,A.lv018 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,0 TypeView  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv018=EE.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv018 not like '0%') AND A.lv017<>0 AND B.lv017 in (1) $vAddCond1
		  UNION
		  	select A.lv001,A.lv002,A.lv016 lv003,A.lv017 lv004,A.lv010 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,1 TypeView  from ac_lv0006 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv010=EE.lv001  where (A.lv018 like '".$strlv005."') AND (A.lv010 not like '0%') AND A.lv017<>0 AND B.lv017 in (1) $vAddCond1
  		  UNION
		  	select A.lv001,A.lv002,A.lv004*A.lv006 lv003,A.lv008 lv004,A.lv009 Account,A.lv011 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,CC.lv014 CustomerID,B.lv007 Description,'' CustomerName,DD.lv002 SupplierName,1 TypeView  from ac_lv0017 A inner join ac_lv0004 B on A.lv002=B.lv001 left join ac_lv0014 CC on A.lv003=CC.lv001 left join wh_lv0003 DD on CC.lv014=DD.lv001 left join ac_lv0002 EE on A.lv010=EE.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv009 not like '0%') AND A.lv008>0 AND B.lv017 in (14) $vAddCond1	
		  UNION
		  	select A.lv001,A.lv002,A.lv004*A.lv006 lv003,A.lv008 lv004,A.lv010 Account,A.lv011 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,CC.lv014 CustomerID,B.lv007 Description,'' CustomerName,DD.lv002 SupplierName,0 TypeView  from ac_lv0017 A inner join ac_lv0004 B on A.lv002=B.lv001 left join ac_lv0014 CC on A.lv003=CC.lv001 left join wh_lv0003 DD on CC.lv014=DD.lv001 left join ac_lv0002 EE on A.lv010=EE.lv001  where (A.lv009 like '".$strlv005."') AND (A.lv010 not like '0%') AND A.lv008>0 AND B.lv017 in (14) $vAddCond1  
		  
		  ";
		 switch($lvobj->lv008)
		 {
			case 'BQGQ': $sqlS = $sqlS. " 
		  	 UNION
			  select A.lv001,A.lv002,A.lv004*A.lv006 lv003,A.lv008 lv004,A.lv011 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,0 TypeView  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv011=EE.lv001  where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND A.lv008>0 AND B.lv017 in (9) AND B.lv002=0  $vAddCond1
		  	UNION
		  	select A.lv001,A.lv002,A.lv004*(IF(ISNULL(G.lv006),0,G.lv006)) lv003,A.lv004*(IF(ISNULL(G.lv006),0,G.lv006)) lv004,A.lv010 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,1 TypeView  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv010=EE.lv001 left join ac_lv0118 G on G.lv003=A.lv003 and G.lv004=A.lv009 and G.lv008=Year(B.lv009) and G.lv007=Month(B.lv009) where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%') AND A.lv008>0 AND B.lv017 in (9) AND B.lv002=1 $vAddCond1";
			 	break;
			case 'FIFO':
			case 'LIFO':
			case 'DIDA': $sqlS = $sqlS. " 
		 	UNION
		  	select A.lv001,A.lv002,A.lv004*A.lv006 lv003,A.lv008 lv004,A.lv011 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,0 TypeView  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv011=EE.lv001 where (A.lv010 like '".$strlv005."') AND (A.lv011 not like '0%') AND A.lv008>0 AND B.lv017 in (9) AND B.lv002=0 $vAddCond1
		  	UNION
		  	select A.lv001,A.lv002,A.lv004*IF(ISNULL((select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)),0,(select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)) lv003,A.lv004*IF(ISNULL((select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)),0,(select G.lv006 from ac_lv0007 G where G.lv003=A.lv003 and G.lv009=A.lv009 and G.lv012=A.lv012 limit 0,1)) lv004,A.lv010 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,1 TypeView  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv010=EE.lv001 where (A.lv011 like '".$strlv005."') AND (A.lv010 not like '0%')  AND B.lv017 in (9) AND B.lv002=1 $vAddCond1";
				break;
		 } $sqlS = $sqlS. "
		 )
		  MP order by MP.lv002,MP.VoiceDate,MP.lv001,MP.lv004 desc ";
		/* select A.lv001,A.lv002,A.lv004*(IF(ISNULL(G.lv006),0,G.lv006)) lv003,A.lv004*(IF(ISNULL(G.lv006),0,G.lv006)) lv004,A.lv010 Account,A.lv012 lv007,EE.lv002 NameAccount,B.lv009 VoiceDate,B.lv015 InvoiceSoureID,B.lv001 InvoiceID,B.lv005 NameObj,B.lv004 CustomerID,B.lv007 Description,CC.lv002 CustomerName,DD.lv002 SupplierName,1 TypeView  from ac_lv0007 A inner join ac_lv0004 B on A.lv002=B.lv001 left join all_gmacv3_0.sl_lv0001 CC on B.lv004=CC.lv001 left join wh_lv0003 DD on B.lv004=DD.lv001 left join ac_lv0002 EE on A.lv010=EE.lv001 left join ac_lv0118 G on G.lv003=A.lv003 and G.lv004=A.lv009 and G.lv008=Year(B.lv009) and G.lv007=Month(B.lv009) where A.lv011 like '".$strlv005."' AND A.lv008>0 AND B.lv017 in (9) $vAddCond1*/
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv001']){
						$vOrder++;
						//$vtInventorylv001 = $arrS['lv001'];
						$vTitle = ($arrS['lv002']!="" || $arrS['lv002']!=NULL)?$arrS['lv002']:"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", $this->FormatView($arrS['VoiceDate'],2), $vLineRun);
						$vLineRun = str_replace("@03", ($arrS['InvoiceSoureID']!="" || $arrS['InvoiceSoureID']!=NULL)?$arrS['InvoiceSoureID']:"&nbsp;", $vLineRun);
						$ArrInvoiceID=split("-",$arrS['InvoiceID']);
						$vLineRun = str_replace("@04", $ArrInvoiceID[2], $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", "-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['NameObj'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['CustomerID'], $vLineRun);
				if($arrS['TypeView']=="0")
				{
					$vLineRun = str_replace("@08", $arrS['CustomerName']."&nbsp;", $vLineRun);	
					$vLineRun = str_replace("@10", $arrS['Account'], $vLineRun);
					$vLineRun = str_replace("@11", $arrS['NameAccount'], $vLineRun);
					$vLineRun = str_replace("@12", $this->FormatView($arrS['lv004'],10), $vLineRun);
					$vLineRun = str_replace("@13", "&nbsp;", $vLineRun);
				}
				else
				{
					$vLineRun = str_replace("@08", $arrS['SupplierName']."&nbsp;", $vLineRun);	
					$vLineRun = str_replace("@10", $arrS["Account"], $vLineRun);
					$vLineRun = str_replace("@11", $arrS["NameAccount"], $vLineRun);
					$vLineRun = str_replace("@12", "&nbsp;", $vLineRun);
					$vLineRun = str_replace("@13", $this->FormatView($arrS['lv004'],10), $vLineRun);					
				}
				
				$vLineRun = str_replace("@09", $arrS['Description']."&nbsp;", $vLineRun);
				
				
				$vLineRun = str_replace("@14","&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@15",$arrS['InvoiceID'], $vLineRun);	
				switch($stropt)
				{
					case 2:
						$vLineRun = str_replace("@20", '', $vLineRun);	
						break;
					default:
						$vLineRun = str_replace("@20", $this->GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$arrS['lv001'],$strlv006,$strlv007,$strlv008), $vLineRun);					
					break;
				}

				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} 
	//$sqlS = "select MP.lv005,MP.Unitlv002,ReReceiptQty,InReceiptQty,ReOutlv004 ,InOutlv004  from ac_lv0007 A left join sl_lv0005 B on A.lv004=B.lv001 where 1=1 and A.lv015=0 $vConditionStock) MP group by MP.lv005,MP.Unitlv002 ";		
	//	$strExpportAll=$strExpportAll.$this->SumSQLRun($sqlS,8,$vArrLang[14],$plang);	
		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Order
		$vHeader = str_replace("@02", $vArrLang[21], $vHeader);
		//lv003
		$vHeader = str_replace("@03", $vArrLang[22], $vHeader);
		//Stock lv002
		$vHeader = str_replace("@04", $vArrLang[23], $vHeader);
		//Unit
		$vHeader = str_replace("@05",$vArrLang[24], $vHeader);
		//Fist
		$vHeader = str_replace("@06", $vArrLang[25], $vHeader);
		//Input Mlv001dle
		$vHeader = str_replace("@07", $vArrLang[26], $vHeader);
		//Output Mlv001dle
		$vHeader = str_replace("@08",$vArrLang[27], $vHeader);
		//Last
		$vHeader = str_replace("@09",$vArrLang[28], $vHeader);		
		$vHeader = str_replace("@10",$vArrLang[29], $vHeader);	
		$vHeader = str_replace("@11",$vArrLang[30], $vHeader);	
		$vHeader = str_replace("@12",$vArrLang[31], $vHeader);	
		$vHeader = str_replace("@13",$vArrLang[32], $vHeader);	
		$vHeader = str_replace("@14",$vArrLang[33], $vHeader);	
		$vHeader = str_replace("@15",$vArrLang[34], $vHeader);	

		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);	
	
	}	
	function GetBuildTableInputOutput($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv006,$strlv007,$strlv008)
	{
		
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"5%\" >@02</td>
				<td class=\"htablerun\" width=\"10%\" >@03</td>
				<td class=\"htablerun\" width=\"8%\" >@04</td>
				<td class=\"htablerun\" width=\"15%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"5%\" >@09</td>												
				<td class=\"htablerun\" width=\"*%\" >@07</td>
				<td class=\"htablerun\" width=\"10%\" >@10</td>												
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>								
				<td class=\"left_style\" >@07</td>				
				<td class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>								
				<td class=\"left_style\" >@07</td>				
				<td class=\"left_style\" >@10</td>				
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 					
		//if($strNote!="") 	$vAddCond=$vAddCond." AND A.lv007 like '%$strNote%'";				
		//if($strContractlv001!="")
		//{
			//$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			//$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		// }		
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		//if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014 Lot=B1.lv014  $vAddCond";		
		 $sqlS = "select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,A.lv009 DateEnter,'N' CategoryPut,'' Title,A.lv007,A.lv012 Lot,A.lv013 Note from ac_lv0007 A   left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv009>='$vDateStart' and A.lv009<='$vDateEnd' and A.lv010='$strlv008'  
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,A.lv009 DateEnter,'X' CategoryPut,'' Title,A.lv007,A.lv012 Lot,A.lv013 Note from ac_lv0007 A   left join sl_lv0005 C on A.lv005=C.lv001 $vCondition where A.lv009>='$vDateStart' and A.lv009<='$vDateEnd' and A.lv011='$strlv008'
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv002']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv002'];
						$vTitle = ($arrS['DateEnter']!="" || $arrS['DateEnter']!=NULL)?formatdate($arrS['DateEnter'],$plang):"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@02",$arrS['CategoryPut'],str_replace("@01",$vtInventorylv001,$Href)), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['lv004']!="" || $arrS['lv004']!=NULL)?Lcurrency($arrS['lv004'],$plang)."(".$arrS['Unitlv002'].")":"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['CategoryPut'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['Title']."&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],$HrefLot))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['Note']!="" || $arrS['Note']!=NULL)?$arrS['Note']:"&nbsp;", $vLineRun);					
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[20], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[21], $vHeader);
		//Quanity
		$vHeader = str_replace("@05",$vArrLang[22], $vHeader);
		//Category N/X
		$vHeader = str_replace("@06", $vArrLang[23], $vHeader);
		//Title
		$vHeader = str_replace("@07", $vArrLang[25], $vHeader);
		//Source
		$vHeader = str_replace("@08", $vArrLang[26], $vHeader);
		//Reference
		$vHeader = str_replace("@11", $vArrLang[27], $vHeader);
		//Lot
		$vHeader = str_replace("@09", $vArrLang[24], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[28], $vHeader);		
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
//////////////////////////////////Purchase Order////////////////////////////
	function GetBuildTableInputOutputDetail($plang, $vArrLang,$vDateStart,$vDateEnd,$vlv003,$strlv006,$strlv007,$strlv008)
	{
	$vHeaderReportInventory="
		<table width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\" class=\"tblprint\">
			<tr height=\"5px\" class=\"tblRunChild\" >
				<td class=\"htablerun\" width=\"3%\" >@02</td>
				<td class=\"htablerun\" width=\"8%\" >@03</td>
				<td class=\"htablerun\" width=\"7%\" >@04</td>
				<td class=\"htablerun\" width=\"9%\" >@05</td>
				<td class=\"htablerun\" width=\"3%\" >@06</td>
				<td class=\"htablerun\" width=\"6%\" >@09</td>												
				<td class=\"htablerun\" width=\"6%\" >@11</td>	
				<td class=\"htablerun\" width=\"7%\" >@12</td>
				<td class=\"htablerun\" width=\"7%\" >@13</td>				
				<td class=\"htablerun\" width=\"7%\" >@15</td>														
				<td class=\"htablerun\" width=\"6%\" >@14</td>						
				<td class=\"htablerun\" width=\"*%\" >@07</td>
				<td class=\"htablerun\" width=\"5%\" >@08</td>	
				<td class=\"htablerun\" width=\"8%\" >@10</td>																																													
			</tr>
			@01
		</table>";			
		$vRowFirst="
			<tr>
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@02</td>			
				<td class=\"left_style\" rowspan=\"@01\" valign=\"top\" >@03</td>
				<td class=\"left_style\" rowspan=\"@01\">@04</td>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>				
				<td class=\"left_style\" >@11</td>				
				<td class=\"left_style\" >@12</td>				
				<td class=\"left_style\" >@13</td>		
				<td class=\"left_style\" >@15</td>						
				<td class=\"left_style\" >@14</td>																																		
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@10</td>				
			</tr>
			";
		$vRowLightText="
			<tr>
				<td class=\"right_style\" >@05</td>
				<td class=\"center_style\" >@06</td>
				<td class=\"left_style\" >@09</td>	
				<td class=\"left_style\" >@11</td>				
				<td class=\"left_style\" >@12</td>				
				<td class=\"left_style\" >@13</td>				
				<td class=\"left_style\" >@15</td>																				
				<td class=\"left_style\" >@14</td>												
				<td class=\"left_style\" >@07</td>				
				<td class=\"center_style\" >@08</td>
				<td class=\"left_style\" >@10</td>																											
			</tr>";
		$Href="<a href=\"javascript:ViewInfos('@01','@02')\" >@01</a>";		
		$HrefLot="<a href=\"javascript:ViewLot('@01','@02')\" >@01</a>";					
		$vCondition="";
		$vAddCond=""; 
		if($strlv014!="") 	$vAddCond=$vAddCond." AND B1.lv009 like '%$strlv014%'";		
		if($strTyles!="") 	$vAddCond=$vAddCond." AND B1.lv004 like '%$strTyles%'";
		if($strQuantiative!="") 	$vAddCond=$vAddCond." AND B1.lv005 like '$strQuantiative'";		
		if($strColor!="") 	$vAddCond=$vAddCond." AND B1.lv006 like '%$strColor%'";	
		if($strNote!="") 	 $vAddCond=$vAddCond." AND B1.lv007 like '%$strNote%'";		
		if($strContractlv001!="")
		{
			$vAddContractR=" AND B.lv006='".$strContractlv001."' and (B.lv005=4 or B.lv005=7) ";				
			$vAddContractO=" AND B.lv006='".$strContractlv001."' and B.lv005=4  ";						 
		 }			
		//if($vAddCond!="") $vCondition = $vCondition." AND lv003 IN ( select B.lv003 from wh_lv0020 B where 1=1 $vAddCond) AND Lot IN ( select B.lv014 from wh_lv0020 B where 1=1 $vAddCond)";
		if($vAddCond!="") $vCondition = $vCondition." inner join wh_lv0020 B1 on A.lv003=B1.lv003 AND A.lv014 Lot=B1.lv014  $vAddCond";		
		 $sqlS = "select A.lv001,A.lv002 ,A.lv004,C.lv002 Unitlv002,B.lv005,B.lv009 DateEnter,'N' CategoryPut,B.lv002 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002  from wh_lv0009 A inner join wh_lv0008 B on A.lv002=B.lv001 and (B.lv009>='$vDateStart' and B.lv009<='$vDateEnd') $vAddContractR  left join sl_lv0005 C on A.lv005=C.lv001 left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
				UNION
				select A.lv001, A.lv002,A.lv004,C.lv002 Unitlv002,B.lv005,B.lv009 DateEnter,'X' CategoryPut,B.lv002 Title,A.lv007,A.lv014 Lot,D.lv006,D.lv004,D.lv005,D.lv007 NoteLot,E.lv002VN Colorlv002 from wh_lv0011 A inner join wh_lv0010 B on A.lv002=B.lv001 and B.lv009>='$vDateStart' and B.lv009<='$vDateEnd' $vAddContractO left join sl_lv0005 C on A.lv005=C.lv001  left join wh_lv0020 D on D.lv014=A.lv014 Lot and D.lv003=A.lv003 left join  wh_color E on D.lv006=E.lv001 $vCondition where A.lv003='$vlv003' 
		";
		$bResultS = db_query($sqlS);
		$totalRows = db_num_rows($bResultS);
		$vLineRun = "";
		$strExpportAll = "";
		$vStockCategorylv001="";
		$vtInventorylv001='1111111111111111111111111111111111111';
		if($totalRows>0){
			while($arrS=db_fetch_array($bResultS)){
					if($vtInventorylv001 != $arrS['lv002']){
						$vOrder++;
						$vtInventorylv001 = $arrS['lv002'];
						$vTitle = ($arrS['DateEnter']!="" || $arrS['DateEnter']!=NULL)?formatdate($arrS['DateEnter'],$plang):"-";
						$vLineRun = $vRowFirst;
						$vLineRun = str_replace("@02", '', $vLineRun);
						$vLineRun = str_replace("@03",str_replace("@02",$arrS['CategoryPut'],str_replace("@01",$vtInventorylv001,$Href)), $vLineRun);
						$vLineRun = str_replace("@04", $vTitle, $vLineRun);
						$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
						$vNumline = 0;
					}
				$vNumline++;			
				$vLineRun = str_replace("@05", ($arrS['lv004']!="" || $arrS['lv004']!=NULL)?Lcurrency($arrS['lv004'],$plang)."(".$arrS['Unitlv002'].")":"-", $vLineRun);
				$vLineRun = str_replace("@06", $arrS['CategoryPut'], $vLineRun);
				$vLineRun = str_replace("@07", $arrS['Title']."&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@08", $arrS['lv005'], $vLineRun);
				$vLineRun = str_replace("@09", ($arrS['Lot']!="" || $arrS['Lot']!=NULL)?(str_replace("@02",$vlv003,str_replace("@01",$arrS['Lot'],$HrefLot))):"&nbsp;", $vLineRun);				
				$vLineRun = str_replace("@10",($arrS['Note']!="" || $arrS['Note']!=NULL)?$arrS['Note']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@11",($arrS['Color']!="" || $arrS['Color']!=NULL)?$arrS['Color']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@12",($arrS['Colorlv002']!="" || $arrS['Colorlv002']!=NULL)?$arrS['Colorlv002']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@13",($arrS['Tyles']!="" || $arrS['Tyles']!=NULL)?$arrS['Tyles']:"&nbsp;", $vLineRun);	
				$vLineRun = str_replace("@14",($arrS['NoteLot']!="" || $arrS['NoteLot']!=NULL)?$arrS['NoteLot']:"&nbsp;", $vLineRun);
				$vLineRun = str_replace("@15",($arrS['Quantitative']!="" || $arrS['Quantitative']!=NULL)?$arrS['Quantitative']:"&nbsp;", $vLineRun);																					
				$strExpportAll = $strExpportAll.$vLineRun;
				$vLineRun = $vRowLightText;
			}
		} else {
			return '';
		}

		$strExpportAll = str_replace("@01", $vNumline, $strExpportAll);
		///////////////////////////////////////////////////////////////
		$vHeader = $vHeaderReportInventory;
		//Space
		$vHeader = str_replace("@02", '', $vHeader);		
		//Invoice
		$vHeader = str_replace("@03", $vArrLang[39], $vHeader);
		//Title
		$vHeader = str_replace("@04", $vArrLang[44], $vHeader);
		//Quanity
		$vHeader = str_replace("@05",$vArrLang[41], $vHeader);
		//Category N/X
		$vHeader = str_replace("@06", $vArrLang[42], $vHeader);
		//Title
		$vHeader = str_replace("@07", $vArrLang[40], $vHeader);
		//lv005
		$vHeader = str_replace("@08", $vArrLang[43], $vHeader);
		//Lot
		$vHeader = str_replace("@09", $vArrLang[46], $vHeader);
		//Note
		$vHeader = str_replace("@10", $vArrLang[45], $vHeader);		
		//Colorlv001
		$vHeader = str_replace("@11", $vArrLang[47], $vHeader);				
		//Colorlv002
		$vHeader = str_replace("@12", $vArrLang[48], $vHeader);				
		//Tyles
		$vHeader = str_replace("@13", $vArrLang[50], $vHeader);				
		//Description
		$vHeader = str_replace("@14", $vArrLang[49], $vHeader);	
		//Quantitative
		$vHeader = str_replace("@15", $vArrLang[51], $vHeader);						
				
		$vTableAll = $vHeader;
		return str_replace("@01", $strExpportAll, $vTableAll);			
	}	
///////////////////////Xac dinh loai tai khoan////////////
	function LV_AccountType($lvaccount)
	{
		$lvaccount=trim($lvaccount);
		$FirstAccount=(int)substr($lvaccount,0,1);
		switch($FirstAccount)
		{
			case 1:
			case 2:
				return 1;
				break;
			case 3:
			case 4:
				return 2;
				break;
			default:
				return 0;
				break;
		}
	}
	function SumSQLRun($vSQL,$vColpan,$vLang,$plang)
	{
		$vtr="<tr onDblClick=\"this.innerHTML=''\" style=\"cursor:move;font-size:20px;font-weight:bold\"><td class=\"right_hr\" colspan=\"$vColpan\" valign=\"top\" >$vLang: @01</td></tr>";
		$bResultS = db_query($vSQL);
		$vValue="";
		while($arrS=db_fetch_array($bResultS)){		
			if($vValue=="") $vValue=Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
			else $vValue=$vValue." ; ".Lcurrency($arrS['SumQty'],$plang).$arrS['Unitlv002'];
		}
		if($vValue!="") return  str_replace("@01",$vValue,$vtr);
		return "";
	}
	public function LV_LinkField($vFile,$vSelectlv001)
	{
		return($this->CreateSelect($this->sqlcondition($vFile,$vSelectlv001),2));
	}
	private function sqlcondition($vFile,$vSelectID)
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
		}
		return $vsql;
	}
	private  function getvaluelink($vFile,$vSelectID)
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