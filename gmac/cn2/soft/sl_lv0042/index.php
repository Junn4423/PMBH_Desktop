<?php
$vfunc=$_GET['func'];
$vChildID=$_GET['ID'];
switch($vfunc)
{
	case 'add':
		include('add.php');
		break;
	case 'edit':
		include('edit.php');
		break;
	case 'filter':
		include('filter.php');
		break;
	case 'word':
		include('report.php');
		break;
	case 'excel':
		include('report.php');
		break;
	case 'pdf':
		include('report.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
}
?>