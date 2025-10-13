<?php 
include("config.php");
include("configrun.php");
include("function.php");
function dickelinie($img,$start_x,$start_y,$end_x,$end_y,$color,$thickness)
{
    $angle=(atan2(($start_y - $end_y),($end_x - $start_x)));
    $dist_x=$thickness*(sin($angle));
    $dist_y=$thickness*(cos($angle));
   
    $p1x=ceil(($start_x + $dist_x));
    $p1y=ceil(($start_y + $dist_y));
    $p2x=ceil(($end_x + $dist_x));
    $p2y=ceil(($end_y + $dist_y));
    $p3x=ceil(($end_x - $dist_x));
    $p3y=ceil(($end_y - $dist_y));
    $p4x=ceil(($start_x - $dist_x));
    $p4y=ceil(($start_y - $dist_y));
   
    $array=array(0=>$p1x,$p1y,$p2x,$p2y,$p3x,$p3y,$p4x,$p4y);
    imagefilledpolygon ( $img, $array, (count($array)/2), $color );
}
// Example:
header ("Content-type: image/jpeg");
$img = ImageCreate (1366, 300) or die("Cannot Initialize new GD image stream ");

$backgroundcolor = ImageColorAllocate ($img, 241, 241, 241);
$orange = ImageColorAllocate($img, 252, 102, 4);
$blue = ImageColorAllocate($img, 21, 122, 214);
$green = ImageColorAllocate($img, 57, 181, 74);
$red= ImageColorAllocate($img, 251, 0, 1);
function builchar($img,$orange,$blue,$green,$red,$vPre=0,&$lvMaxTotal)
{
	$vMorePos=$vPre*10;
	$vNowStart=$_GET['saleYearS'];
	if($vNowStart=="" || $vNowStart==NULL)
	{
		$vNowStart=GetServerDate();
	}
	else
		$vNowStart=$vNowStart."-".$_GET['saleMonthS']."-01";
	//$vNowStart="2016-01-01";
	$vNow=$_GET['saleYear'];
	if($vNow=="" || $vNow==NULL)
		$vNow=GetServerDate();
	else
		$vNow=$vNow."-".$_GET['saleMonth']."-01";
	//Xác định số tháng từ đến.
	$vsql="SELECT TIMESTAMPDIFF(MONTH, '$vNowStart', '$vNow') LNums";
	$vresults=db_query($vsql);
	$vrows=db_fetch_array($vresults);
	$LNums=$vrows['LNums'];
	$vmonth=(int)getmonth($vNow);
	$vyear=(int)getyear($vNow)-$vPre;
	$vday=(int)getday($vNow);
	$vNow1[0]=$vNow;
	$vNow1[1]=$vyear."-".Fillnum($vmonth,2)."-01";
	$vlang=$_GET['lang'];
	if($vlang=='') $vlang='EN';
	$vDistanceW=300;
	if($LNums==0)
	{
		for($i=2;$i<=5;$i++)
		{
			if($vday==1)
			{
				$j=$i-1;
			}
			else
			{
				$j=$i;
			}
			$vmonth=$vmonth-1;
			if($vmonth==0)
			{
				$vmonth=12;
				$vyear=$vyear-1;
				$vNow1[$j]=$vyear."-".Fillnum($vmonth,2)."-01";
			}
			else 
			{
				$vNow1[$j]=$vyear."-".Fillnum($vmonth,2)."-01";
			}
		}
		//select (select sum(B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vNow1[0]') and month(A.lv004)=month('$vNow1[0]')) totalamount,1 thang,'$vNow1[0]' months 
			  //union 
			 $sql="select MP.* from (
			  select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vNow1[1]') and month(A.lv004)=month('$vNow1[1]')) totalamount,2 thang,'$vNow1[1]' months
			  union
			  select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vNow1[2]') and month(A.lv004)=month('$vNow1[2]')) totalamount,3 thang,'$vNow1[2]' months
			  union
			  select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vNow1[3]') and month(A.lv004)=month('$vNow1[3]')) totalamount,4 thang,'$vNow1[3]' months
			  union
			  select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vNow1[4]') and month(A.lv004)=month('$vNow1[4]')) totalamount,5 thang,'$vNow1[4]' months";
			 if($vday==1) 
				$sql=$sql.") MP order by thang desc";	
			 else
			   $sql=$sql."
			   union
			  select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vNow1[5]') and month(A.lv004)=month('$vNow1[5]')) totalamount,6 thang,'$vNow1[5]' months)  MP order by thang desc";	
		$vresult=db_query($sql);
	}
	else
	{
		$vDistanceW=1366/($LNums+1);
		if($vPre==1)
			$vDate=LV_DATE_ADD($vNowStart,-1,2);
		else
			$vDate=$vNowStart;
		for($i=1;$i<=$LNums+1;$i++)
		{
			if($vusql=="")
				$vusql="
			 select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vDate') and month(A.lv004)=month('$vDate')) totalamount,$i thang,'$vDate' months 
			";
			else
				$vusql=$vusql."
			 union select (select sum( B.lv004*B.lv006+B.lv004*B.lv006*B.lv008/100-B.lv004*B.lv006*B.lv011/100-(B.lv004*B.lv006)*A.lv022) from sl_lv0014 B inner join sl_lv0013 A  on A.lv001=B.lv002 where  year(A.lv004)=year('$vDate') and month(A.lv004)=month('$vDate')) totalamount,$i thang,'$vDate' months 
			";
			$vDate=LV_DATE_ADD($vDate,1,1);
		}
		$sql="select MP.* from (".$vusql.") MP order by thang asc";
		$vresult=db_query($sql); 
	}
	$next=0;
	// Path to our ttf font file
	$font_file = './arial.ttf';
	$black = imagecolorallocate($img, 0x00, 0x00, 0x00);
	$blackmo = imagecolorallocate($img, 0x77, 0x77, 0x77);
// Draw the text 'PHP Manual' using font size 13
	$lvArrayTotal=array();
	$lvArrayMonth=array();
	$i=0;
//	$lvMaxTotal=0;
	while($vrow=db_fetch_array($vresult))
	{
		if($lvMaxTotal<$vrow['totalamount']) $lvMaxTotal=$vrow['totalamount'];
		$lvArrayTotal[$i]=$vrow['totalamount'];
		$lvArrayMonth[$i]=$vrow['months'];
		$i++;
	}
	$i=0;
	if($lvMaxTotal==0) $lvMaxTotal=1;
	$lvScale=280/$lvMaxTotal;
	foreach($lvArrayTotal as $lineAmount)
	{
		if($next!=0)
		{
			dickelinie($img, 10+$next-$vDistanceW+$vMorePos,300-$vprevious ,10+$next+$vMorePos, 300-$lineAmount*$lvScale,($vPre==1)?$green:$blue,1);
			$vprevious=$lineAmount*$lvScale;
			dickelinie($img, 10+$next+$vMorePos,300,10+$next+$vMorePos, 300-$lineAmount*$lvScale,($vPre==1)?$green:$blue,4);
			imagefttext($img, 10, ($vPre==1)?90:0, $next+35, 300-$lineAmount*$lvScale-5+(($vPre==1)?90:0), ($vPre==1)?$green:$blue, $font_file, LCurrencys($lineAmount,$vlang));
			imagefttext($img, 10, 90, 25+$next+30, 300+(($vPre==1)?-60:0), ($vPre==1)?$green:$blue, $font_file, (($vPre==1)?' ~ ':'  ').substr(str_replace("/","-",formatdate($lvArrayMonth[$i],$vlang)),3,7));
		}
		else 
		{
			$vprevious=$lineAmount*$lvScale;
			dickelinie($img, 10+$vMorePos,300 ,10+$vMorePos, 300-$vprevious,($vPre==1)?$green:$blue,4);
			imagefttext($img, 10, ($vPre==1)?90:0, 35, 300-$vprevious-5+(($vPre==1)?90:0), ($vPre==1)?$green:$blue, $font_file, LCurrencys($lineAmount,$vlang));
			imagefttext($img, 10, 90, 25+30, 300+(($vPre==1)?-60:0), ($vPre==1)?$green:$blue, $font_file,(($vPre==1)?' ~ ':'  ').substr(str_replace("/","-",formatdate($lvArrayMonth[$i],$vlang)),3,7));
		}
		$next=$next+$vDistanceW;
		$i++;
	}
}
builchar($img,$orange,$blue,$green,$red,0,$lvMaxTotal);
builchar($img,$orange,$blue,$green,$red,1,$lvMaxTotal);
imagejpeg($img);  
ImageDestroy($img);

?>