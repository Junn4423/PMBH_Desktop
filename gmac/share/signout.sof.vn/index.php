<?php
//header("Content-Type: application/json; charset=UTF-8");
$lvIpClient=$_SERVER['REMOTE_ADDR'];
ob_start(); // Turn on output buffering
system('arp '.$lvIpClient.' -a'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer
ob_start();
include("config.php");
include("function.php");
$pmac = strpos($mycom, " ".$lvIpClient." "); // Find the position of Physical text
$lvmac=substr($mycom,($pmac+strlen($lvIpClient)+2),30); // Get Physical Address
$vArLogin=Array();
$vArLogin['code']='';
$vArLogin['token']='';

	$vUserName=$_POST['txtUserName'];
	$vToken=$_POST['txtToken'];
		if($vUserName=='' || $vUserName==NULL)
		{
			$vUserName=$_GET['txtUserName'];
            $vToken=$_GET['txtToken'];
		}
			$vMessage = "";
			$vnum=0;
			if($vUserName!="" && $vToken!="")
			{
				
				$vsql="select * from hr_lv0020 where (lv001='$vUserName' || lv040='$vUserName' || lv039='$vUserName')  and lv197='".$vToken."' and lv196=0 and lv009 not in (2,3)";
				$vresult=db_query($vsql);
				if($vresult)
				{
					$vnum=db_num_rows($vresult);
				}
				if($vnum>0)
				{
							$vsql="update hr_lv0020 set lv197='',lv198=' ' where lv001='$vUserName'";
							$vresult=db_query($vsql);
							
					
				} else {
					$vMessage = "Signout failed, please try again!";
					$vFlagSelect = 1;
				}
		} else if($vUserName==""){
			$vMessage = "Please enter your Signout Name!";
		} else if($$vPassword==""){
			$vMessage = "Please enter your Token!";
			$vFlagFocus = 1;
		}
echo json_encode($vArLogin);
 ob_end_flush();
 ?>
