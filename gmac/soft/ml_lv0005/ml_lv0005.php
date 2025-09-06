<?php
session_start();
$vDir="";
$pGetLengthFile=(int)$_GET['LengthFile'];
$pOrders=(int)$_GET['Orders'];
include($vDir."paras.php");
require_once($vDir."../clsall/lv_controler.php");
require_once($vDir."../clsall/ml_lv0001.php");
require_once($vDir."../clsall/ml_lv0101.php");
require_once($vDir."../clsall/ml_lv0009.php");
require_once($vDir."../clsall/ml_lv0008.php");
require_once($vDir."../clsall/class.pop3.php");
require_once($vDir."../clsall/ml_lv0102.php");
/////init object////////////////
$lvml_lv0101=new ml_lv0101();
$lvml_lv0009=new ml_lv0009($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0009');
$lvml_lv0008=new ml_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0008');
//Load object active////////////////
//Send mail
$lvml_lv0009->LV_LoadIMAP();
if($lvml_lv0009->lv001!="" && $lvml_lv0009->lv001!=null)
{
	$lvml_lv0008->LV_LoadRecieve($_SESSION['ERPSOFV2RUserID']);
	$lvml_lv0101->Dir=$vDir;
	$lvml_lv0101->UserID="admin";
	for($i=$pGetLengthFile;$i<$lvml_lv0008->Count;$i++)
	{
		$lvml_lv0101->CountSave=0;
		$vreturn=$lvml_lv0101->Login($lvml_lv0009->lv002,$lvml_lv0009->lv003,strtolower($lvml_lv0009->lv004) ,  	$lvml_lv0009->lv005, $lvml_lv0008->Email[$i], $lvml_lv0008->Pwd[$i]);
		if($vreturn==1)
		{
			$lvml_lv0101->GetMails();
			$lvml_lv0101->DeleteEmailsGet($lvml_lv0101->CountSave);	
		}
	}
	echo 'GET MAIL SUCCESSFULL!';
}
else
{
	$vGetOther=$_GET['userid'];
	if($vGetOther=="" || $vGetOther==NULL)
	{
		$vGetOther=$_SESSION['ERPSOFV2RUserID'];
	}
	$lvml_lv0009->LV_LoadPOP3();
	if($lvml_lv0009->lv001!="" && $lvml_lv0009->lv001!=null)
	{
		$lvml_lv0102=new ml_lv0102();
		$lvml_lv0008->LV_LoadRecieve($vGetOther);
		$lvml_lv0102->log_file=$lvml_lv0009->lv002;
		$lvml_lv0102->server=$lvml_lv0009->lv002;		
		$lvml_lv0102->lvml_lv0001->Dir=$vDir;
		$lvml_lv0102->lvml_lv0001->lv003=$vGetOther;
		for($i=$pGetLengthFile;$i<$lvml_lv0008->Count;$i++)
		{
			$lvml_lv0102->username=$lvml_lv0008->Email[$i];
			$lvml_lv0102->password=$lvml_lv0008->Pwd[$i];
			$vreturn=$lvml_lv0102->getmail();
			if($vreturn==1)
			{
				//$lvml_lv0102->getmail();
				//$lvml_lv0101->DeleteEmailsGet($lvml_lv0101->CountSave);	
			}
		}
		
		echo 'GET MAIL SUCCESSFULL!';
	}
	else
	{
		echo 'PLEASE!SET POP3 OR IMAP TO GET MAIL';
	}

}

?>
<?php
$lvml_lv0001=new ml_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0001');
$lvml_lv0001->LoadBox($_SESSION['ERPSOFV2RUserID']);
?>
<script language="javascript">
div1 = document.getElementById('idInbox');
div1.innerHTML='<?php echo $lvml_lv0001->Inbox;?>';	
div2 = document.getElementById('idOutbox');
div2.innerHTML='<?php echo $lvml_lv0001->Outbox;?>';
div3 = document.getElementById('idSendItem');
div3.innerHTML='<?php echo $lvml_lv0001->SendItem;?>';	
div4 = document.getElementById('idInboxDel1');
div4.innerHTML='<?php echo $lvml_lv0001->DeleteItem;?>';
</script>