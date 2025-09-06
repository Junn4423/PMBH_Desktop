<?php
/*
Copy right sof.vn
No Edit
DateCreate:18/07/2005
*/
session_start();
//require_once("../../clsall/ml_lv0011.php");
$vDefaultPath="../../../images/logo/";
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ml_lv0011.php");
//////////////init object////////////////
$lvml_lv0011=new ml_lv0011($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0011');

/////////Get ID///////////////
$lvml_lv0011->DirLink="../";
$lvml_lv0011->lv001=($_GET['ID']);
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0002.txt",$plang);

$vFlag=(int)$_POST['txtFlag'];

$vStrMessage="";


if($vFlag==1)
{
		$lvml_lv0011->lv002=$_POST['txtlv002'];
		$lvml_lv0011->lv003=$_POST['txtlv003'];
		$lvml_lv0011->lv004=$_POST['txtlv004'];
		$lvml_lv0011->lv005=$_POST['txtlv005'];
		$lvml_lv0011->lv006=$_POST['txtlv006'];
		$lvml_lv0011->lv007=$_POST['txtlv007'];
		$lvml_lv0011->lv008=$_POST['txtlv008'];
		$lvml_lv0011->lv009=$_POST['txtlv009'];
		$lvml_lv0011->lv010=$_POST['txtlv010'];
		$lvml_lv0011->lv011=$_POST['txtlv011'];
		$lvml_lv0011->lv012=$_POST['txtlv012'];
		$lvml_lv0011->lv013=$_POST['txtlv013'];
		
		$vresult=$lvml_lv0011->LV_Update();
		if($vresult==true) {
			$vStrMessage=$vLangArr[14];
			$vFlag=1;
		} else{
			$vStrMessage=$vLangArr[15].sof_error();
			$vFlag=0;
		}

}

//$lvml_lv0011->LV_UpdateState();
$lvml_lv0011->LV_LoadID($lvml_lv0011->lv001);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
</head>
<script language="javascript">
function isphone(s){
	if(s!=""){
		var str="0123456789.()"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert('<?php echo $vLangArr[21];?>')	
					return false
				}	
			return true
		}	
		return true
}
	function Refresh()
	{
		var o=document.frm_mail;
		o.txtlv002.value='<?php echo $lvml_lv0011->lv002;?>';
		o.txtlv003.value='<?php echo $lvml_lv0011->lv003;?>';
		o.txtlv004.value='<?php echo $lvml_lv0011->lv004;?>';
		o.txtlv005.value='<?php echo $lvml_lv0011->lv005;?>';
		o.txtlv006.value='<?php echo $lvml_lv0011->lv006;?>';		
		o.txtlv007.value='<?php echo $lvml_lv0011->lv007;?>';		
		o.txtlv008.value='<?php echo $lvml_lv0011->lv008;?>';		
		o.txtlv009.value='<?php echo $lvml_lv0011->lv009;?>';	
		o.txtlv010.value='<?php echo $lvml_lv0011->lv010;?>';		
		o.txtlv011.value='<?php echo $lvml_lv0011->lv011;?>';	
		o.txtlv002.focus();
	}
	function Cancel()
	{
		var o=window.parent.document.getElementById('frmchoose');
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
		function Save()
	{
		var o=document.frm_mail;
		if(o.txtlv001.value=="")
			alert('<?php echo $vLangArr[16];?>');
		else if(!isphone(o.txtlv005.value)){
			o.txtlv005.focus();
			}
		else if(!isphone(o.txtlv006.value)){
			o.txtlv006.focus();
			}		
		else
		{
		o.txtFlag.value="1";
		o.submit();
		}
			
	}
</script>
<body   onkeyup="KeyPublicRun(event)">
<div id="content_child">
  <div class="story">
    <h3>
		
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form name="frm_mail" action="#" method="post" enctype="multipart/form-data">
					  <table width="680" border="0" align="left" id="table1">
							<tr>
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
							  <td width="535"  height="20"><?php echo $lvml_lv0011->lv001;?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv002;?></td>
					      </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv003;?></td>
						    </tr>
<tr>
							  <td  height="20"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><?php echo $lvml_lv0011->lv004;?>						      &nbsp;<?php echo $lvml_lv0011->lv014;?></td>
						  </tr>							  
							

							<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv006;?></td>
						    </tr>		
							<tr>
							  <td  height="20"><?php echo $vLangArr[21];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv007;?></td>
						    </tr>							
							<tr>
							  <td  height="20"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv008;?></td>
						    </tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv005;?></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><?php echo str_replace("\n","<br>",$lvml_lv0011->lv009);?></td>
						    </tr>	
							<tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
							  <td  height="20"><?php echo $lvml_lv0011->lv010;?></td>
						    </tr>
							<tr>
							  <td  height="20" colspan="2"><input name="txtFlagFw" type="hidden" id="txtFlagFw"  value="<?php echo $_POST['txtFlagFw'];?>"/><input name="txtFlag" type="hidden" id="txtFlag" /></td>
						  </tr>
					<tr>
							  <td  height="20" colspan="2">&nbsp;</td>
						  </tr>
					  </table>
					  	<input type="hidden" name="txtmail_lv006" id="txtmail_lv006"  value='<?php echo $lvml_lv0011->lv007;?>'/>
						<input type="hidden" name="txtmail_lv007" id="txtmail_lv007"  value='<?php echo $lvml_lv0011->lv006;?>'/>
						<input type="hidden" name="txtmail_lv008" id="txtmail_lv008" value='<?php echo $lvml_lv0011->lv008;?>'/>
						<input type="hidden" name="txtmail_lv005" id="txtmail_lv005" value='<?php echo $lvml_lv0011->lv005;?>'/>
						<input type="hidden" name="txtmail_lv010" id="txtmail_lv010" value='<?php echo $lvml_lv0011->lv010;?>'/>
						<input type="hidden" name="txtmail_lv013" id="txtmail_lv013" value='<?php echo $lvml_lv0011->lv013;?>'/>
						<input type="hidden" name="txtmail_lv009" id="txtmail_lv009" value='<?php echo str_replace("\"","'",$lvml_lv0011->lv009);?>'/>
					</form>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<script language="javascript">
	var o=document.frm_mail;
		o.txtlv002.select();
</script>
	<?php
	if($vFlag==1)
	{
	?>
	<script language="javascript">
	<!--
		Cancel();
	//-->
	</script>
	<?php
	}
	?>
</body>
</html>