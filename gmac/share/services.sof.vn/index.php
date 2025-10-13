<?php
header("Content-Type: application/json; charset=UTF-8");
include("config.php");
include("function.php");
include("lv_controler.php");
$vtable=$_GET['table'];//"hr_lv0020";
if($vtable=='' || $vtable==NULL) $vtable=$_POST['table'];
if($vtable=='') $vtable="hr_lv0020";
$vfun=$_GET['func'];
if($vfun=='' || $vfun==NULL) $vfun=$_POST['func'];
$vid=$_GET['id'];
if($vid=='' || $vid==NULL) $vid=$_POST['id'];
if($vid=='') $vid=$_GET['ID'];
if($vid=='' || $vid==NULL) $vid=$_POST['ID'];
$vlimit=$_GET['limit'];
if($vlimit=='' || $vlimit==NULL) $vlimit=$_POST['limit'];
if($vlimit=='') $vlimit="0,10";
$vOutput=Array();
switch($vtable)
{
	case 'hr_lv0020':
		include("hr_lv0020.php");
		switch($vfun)
		{
			case 'add':
			case 'edit':
			case 'delete':
			case 'apr':
			case 'unapr':
			case 'data':
				break;
			default:
				$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
				$lvhr_lv0020->lv001=$vid;
				$objEmp=$lvhr_lv0020->LV_LoadID($lvhr_lv0020->lv001);
				foreach($objEmp as $key => $value)
				{
					if(!is_numeric($key))
					{
						$vOutput[$key]=$value;
					}
				}
				break;
		}
		break;
		case 'tc_lv0011':
			include("tc_lv0011.php");
			$lvtc_lv0011=new tc_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
			switch($vfun)
			{
				case 'add':
				case 'edit':
				case 'delete':
				case 'apr':
				case 'unapr':
				case 'data':
					$lvtc_lv0011->month=$_GET['month'];
					$lvtc_lv0011->year=$_GET['year'];
					$lvtc_lv0011->lv002=$vid;
					//$lvtc_lv0011->lv021=$_GET['state'];
					$objEmps=$lvtc_lv0011->LV_LoadMobil();
					$i=0;
					foreach($objEmps as $objEmp)
					{
						$i++;
						foreach($objEmp as $key => $value)
						{
							if(!is_numeric($key))
							{
								$vOutput[$i][$key]=$value;
							}
						}
					}
					break;
				default:
					$lvtc_lv0011->lv001=$vid;
					$objEmp=$lvtc_lv0011->LV_LoadID($lvtc_lv0011->lv001);
					foreach($objEmp as $key => $value)
					{
						if(!is_numeric($key))
						{
							$vOutput[$key]=$value;
						}
					}
					break;
			}
			break;
	case 'tc_lv0020':
		include("tc_lv0020.php");
		$lvtc_lv0020=new tc_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
		switch($vfun)
		{
			case 'add':
			case 'edit':
			case 'delete':
			case 'apr':
			case 'unapr':
			case 'data':
				$lvtc_lv0020->month=$_GET['month'];
				$lvtc_lv0020->year=$_GET['year'];
				$lvtc_lv0020->lv002=$vid;
				//$lvtc_lv0020->lv021=$_GET['state'];
				$objEmps=$lvtc_lv0020->LV_LoadMobil();
				$i=0;
				foreach($objEmps as $objEmp)
				{
					$i++;
					foreach($objEmp as $key => $value)
					{
						if(!is_numeric($key))
						{
							$vOutput[$i][$key]=$value;
						}
					}
				}
				break;
			default:
				$lvtc_lv0020->lv001=$vid;
				$objEmp=$lvtc_lv0020->LV_LoadID($lvtc_lv0020->lv001);
				foreach($objEmp as $key => $value)
				{
					if(!is_numeric($key))
					{
						$vOutput[$key]=$value;
					}
				}
				break;
		}
		break;
	case 'jo_lv0004':
		include("jo_lv0004.php");
		$lvjo_lv0004=new jo_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0004');
		switch($vfun)
		{
			case 'add':
				if($_POST['lv015']!="" && $_POST['lv015']!=NULL)
				{
					$lvjo_lv0004->lv002=$_POST['lv002'];
					$lvjo_lv0004->lv003=$_POST['lv003'];
					$lvjo_lv0004->lv008=$_POST['lv008'];
					$lvjo_lv0004->lv015=$_POST['lv015'];
					$lvjo_lv0004->lv016=$_POST['lv016'];
					$lvjo_lv0004->lv017=$_POST['lv017'];
					$lvjo_lv0004->lv021=(int)$_POST['lv021'];
					$lvjo_lv0004->lv022=$_POST['lv022'];
				}
				else
				{
					$lvjo_lv0004->lv002=$_GET['lv002'];
					$lvjo_lv0004->lv003=$_GET['lv003'];
					$lvjo_lv0004->lv008=$_GET['lv008'];
					$lvjo_lv0004->lv015=$_GET['lv015'];
					$lvjo_lv0004->lv016=$_GET['lv016'];
					$lvjo_lv0004->lv017=$_GET['lv017'];
					$lvjo_lv0004->lv021=(int)$_GET['lv021'];
					$lvjo_lv0004->lv022=$_GET['lv022'];
				}
				$lvjo_lv0004->LV_Insert_NoID();
				break;
			case 'edit':
				if($_POST['lv001']!="" && $_POST['lv001']!=NULL)
				{
					$lvjo_lv0004->lv001=$_POST['lv001'];
					$lvjo_lv0004->lv002=$_POST['lv002'];
					$lvjo_lv0004->lv003=$_POST['lv003'];
					$lvjo_lv0004->lv008=$_POST['lv008'];
					$lvjo_lv0004->lv015=$_POST['lv015'];
					$lvjo_lv0004->lv016=$_POST['lv016'];
					$lvjo_lv0004->lv017=$_POST['lv017'];
					$lvjo_lv0004->lv021=(int)$_POST['lv021'];
					$lvjo_lv0004->lv022=$_POST['lv022'];
				}
				else
				{
					$lvjo_lv0004->lv001=$_GET['lv001'];
					$lvjo_lv0004->lv002=$_GET['lv002'];
					$lvjo_lv0004->lv003=$_GET['lv003'];
					$lvjo_lv0004->lv008=$_GET['lv008'];
					$lvjo_lv0004->lv015=$_GET['lv015'];
					$lvjo_lv0004->lv016=$_GET['lv016'];
					$lvjo_lv0004->lv017=$_GET['lv017'];
					$lvjo_lv0004->lv021=(int)$_GET['lv021'];
					$lvjo_lv0004->lv022=$_GET['lv022'];
				}
				$lvjo_lv0004->LV_Update();
				break;
			case 'delete':
			case 'apr':
			case 'unapr':
				break;
			case 'data':
				$lvjo_lv0004->month=$_GET['month'];
				$lvjo_lv0004->year=$_GET['year'];
				$lvjo_lv0004->lv015=$vid;
				$lvjo_lv0004->lv021=$_GET['state'];
				$objEmps=$lvjo_lv0004->LV_LoadMobil();
				$i=0;
				foreach($objEmps as $objEmp)
				{
					$i++;
					foreach($objEmp as $key => $value)
					{
						if(!is_numeric($key))
						{
							$vOutput[$i][$key]=$value;
						}
					}
				}
				break;
			default:
				$objEmp=$lvjo_lv0004->LV_LoadID($lvhr_lv0020->lv001);
				foreach($objEmp as $key => $value)
				{
					if(!is_numeric($key))
					{
						$vOutput[$key]=$value;
					}
				}
				break;
		}
		break;
	case 'tc_lv0004':
		include("tc_lv0004.php");
		$lvtc_lv0004=new tc_lv0004($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0004');
		switch($vfun)
		{
			case 'add':
			case 'edit':
			case 'delete':
			case 'apr':
			case 'unapr':
				break;
			case 'data':
				$objEmps=$lvtc_lv0004->LV_LoadMobil();
				$i=0;
				foreach($objEmps as $objEmp)
				{
					$i++;
					foreach($objEmp as $key => $value)
					{
						if(!is_numeric($key))
						{
							$vOutput[$i][$key]=$value;
						}
					}
				}
				break;
			default:
				$lvtc_lv0004->lv001=$vid;
				$objEmp=$lvtc_lv0004->LV_LoadID($lvtc_lv0004->lv001);
				foreach($objEmp as $key => $value)
				{
					if(!is_numeric($key))
					{
						$vOutput[$key]=$value;
					}
				}
				break;
		}
		break;
	case 'jo_lv0100':
		include("jo_lv0100.php");
		$lvjo_lv0100=new jo_lv0100($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Jo0100');
		switch($vfun)
		{
			case 'add':
			case 'edit':
			case 'delete':
			case 'apr':
			case 'unapr':
				break;
			case 'data':
				$objEmps=$lvjo_lv0100->LV_LoadMobil();
				$i=0;
				foreach($objEmps as $objEmp)
				{
					$i++;
					foreach($objEmp as $key => $value)
					{
						if(!is_numeric($key))
						{
							$vOutput[$i][$key]=$value;
						}
					}
				}
				break;
			default:
				$lvjo_lv0100->lv001=$vid;
				$objEmp=$lvjo_lv0100->LV_LoadID($lvjo_lv0100->lv001);
				foreach($objEmp as $key => $value)
				{
					if(!is_numeric($key))
					{
						$vOutput[$key]=$value;
					}
				}
				break;
		}
		break;
	case 'tc_lv0002':
		include("tc_lv0002.php");
		$lvtc_lv0002=new tc_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Tc0002');
		switch($vfun)
		{
			case 'add':
			case 'edit':
			case 'delete':
			case 'apr':
			case 'unapr':
				break;
			case 'data':
				$objEmp=$lvtc_lv0002->LV_LoadMobil();
				$i=0;
				foreach($objEmp as $objEmp)
				{
					$i++;
					foreach($objEmp as $key => $value)
					{
						if(!is_numeric($key))
						{
							$vOutput[$i][$key]=$value;
						}
					}
				}
				break;
			default:
				$lvtc_lv0002->lv001=$vid;
				$objEmp=$lvtc_lv0002->LV_LoadID($lvtc_lv0002->lv001);
				foreach($objEmp as $key => $value)
				{
					if(!is_numeric($key))
					{
						$vOutput[$key]=$value;
					}
				}
				break;
		}
		break;

}
if($vfun=='data')
{
	$i=1;
	echo "[";
	foreach($vOutput as $vData)
	{
		if($i>1) echo ",";
		
		echo json_encode($vData);
		
		$i++;
	}
	echo "]";
}
else
	echo json_encode($vOutput);
?>
