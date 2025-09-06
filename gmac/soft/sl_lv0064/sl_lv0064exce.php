<?php
session_start();
include("../paras.php");
include("../config.php");
include("../function.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/sl_lv0007.php");
$vlv002=$_GET['lv002'];	
$vlv003=$_GET['lv003'];	
///////////Init object ///////////////////////////////
$mosl_lv0007=new sl_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0064');
$mosl_lv0007->LV_LoadID($vlv002);
///Save object

if($mosl_lv0007->lv001!=NULL && $mosl_lv0007->lv001!="")
{
?>
div7 = document.getElementById('txtlv006');
div7.value='<?php echo $mosl_lv0007->lv004;?>';
<?php
}
db_close();
?>