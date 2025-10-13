<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/hr_lv0018.php");
$vlv002=$_GET['lv002'];	
$vlv003=$_GET['lv003'];	
///////////Init object ///////////////////////////////
$mohr_lv0018=new hr_lv0018($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Hr0018');
$mohr_lv0018->LV_LoadID($vlv002);
///Save object

if($mohr_lv0018->lv001!=NULL && $mohr_lv0018->lv001!="")
{
?>
div7 = document.getElementById('txtlv812');
div7.value='<?php echo $mohr_lv0018->lv003;?>';
<?php
}
db_close();
?>