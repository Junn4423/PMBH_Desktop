<?php
$vfunc=$_GET['childfunc'];
$vChildID=$_GET['ChildID'];
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
	case 'child':
		include('child.php');
		break;
	case 'rpt':
		include('report1.php');
		break;
	case 'rpten':
		include('report2.php');
		break;
	case 'rptall':
		include('report3.php');
		break;
	case 'rptretail':
		include('report4.php');
		break;
	case 'rptretailall':
		include('report5.php');
		break;
	case 'rptwork':
		include('report6.php');
		break;
	case 'rptnuoc':
		include('report7.php');
		break;
	case 'rptmonan':
		include('report8.php');
		break;
		
}
?>