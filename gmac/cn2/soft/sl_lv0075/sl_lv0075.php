<?php
session_start();
$vDir = "";
include($vDir."paras.php");
require_once("$vDir../clsall/lv_controler.php");
require_once("$vDir../clsall/sl_lv0013.php");
require_once("$vDir../clsall/sl_lv0014.php");
require_once("$vDir../clsall/sl_lv0070.php");
require_once("$vDir../clsall/wh_lv0010.php");
require_once("$vDir../clsall/wh_lv0011.php");
////////init object////////////////////
	$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0015');
$vNow=GetServerDate();	
if($lvsl_lv0013->GetAdd()>0)
{
if(isset($_GET['ajaxquantitysend']))
{
	//if($lvsl_lv0013->GetEdit()>0)
	{
	echo '[CHECKDONHANG]';
		$optqty=(int)$_GET['optqty'];
		if($optqty==2)
			$vsql="update sl_lv0014 set lv017='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
		else
			$vsql="update sl_lv0014 set lv004='".$_GET['qty']."' where lv001='".$_GET['chitietid']."' and (select A.lv011 from sl_lv0013 A where A.lv001=sl_lv0014.lv002)<=0";
		$vresult=db_query($vsql);	
		
		}
	exit;
}
}	
	
	$lvsl_lv0014=new sl_lv0014($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0016');
	$lvsl_lv0070=new sl_lv0070($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0070');
	$lvsl_lv0070->LV_Load();
	$lvsl_lv0013->obj_conf=$lvsl_lv0070;
if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("$vDir../","SL0049.txt",$plang);
	$vLangArr1=GetLangFile("$vDir../","SL0027.txt",$plang);
///Load user
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($lvsl_lv0013->GetAdd()>0)
{

}
$flagCtrl = (int)$_POST['txtFlag'];
//Lấy mã phiếu nhập kho
$lvsl_lv0013->lv001=$lvsl_lv0013->LV_Exist($_POST['txtlv807']);
if($_POST['txtdoibangid']==1) $lvsl_lv0013->lv001=$_POST['txtlv801'];



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$lvsl_lv0013->ArrPush[0]=$vLangArr1[17];
$lvsl_lv0013->ArrPush[1]=$vLangArr1[18];
$lvsl_lv0013->ArrPush[2]=$vLangArr1[19];
$lvsl_lv0013->ArrPush[3]=$vLangArr1[20];
$lvsl_lv0013->ArrPush[4]=$vLangArr1[21];
$lvsl_lv0013->ArrPush[5]=$vLangArr1[22];
$lvsl_lv0013->ArrPush[6]=$vLangArr1[23];
$lvsl_lv0013->ArrPush[7]=$vLangArr1[24];
$lvsl_lv0013->ArrPush[8]=$vLangArr1[25];
$lvsl_lv0013->ArrPush[9]=$vLangArr1[26];
$lvsl_lv0013->ArrPush[10]=$vLangArr1[27];
$lvsl_lv0013->ArrPush[11]=$vLangArr1[28];
$lvsl_lv0013->ArrPush[12]=$vLangArr1[29];
$lvsl_lv0013->ArrPush[13]=$vLangArr1[41];
$lvsl_lv0013->ArrPush[14]=$vLangArr1[40];
$lvsl_lv0013->ArrPush[15]=$vLangArr1[42];
$lvsl_lv0013->ArrPush[16]=$vLangArr1[45];
$lvsl_lv0013->ArrPush[17]=$vLangArr1[43];
$lvsl_lv0013->ArrPush[18]=$vLangArr1[44];
$lvsl_lv0013->ArrPush[19]=$vLangArr1[46];
$lvsl_lv0013->ArrPush[20]=$vLangArr1[47];
$lvsl_lv0013->ArrPush[21]=$vLangArr1[48];
$lvsl_lv0013->ArrPush[22]=$vLangArr1[49];
$lvsl_lv0013->ArrPush[23]=$vLangArr1[50];
$lvsl_lv0013->ArrPush[24]=$vLangArr1[51];
$lvsl_lv0013->ArrPush[25]=$vLangArr1[52];
$lvsl_lv0013->ArrPush[26]=$vLangArr1[53];
$vFieldList="lv001,lv002,lv003,lv010,lv023";
$strParent=$lvsl_lv0013->LV_BuilListReportMini($vFieldList,'document.frmchoose','chkAll','lvChk',0, 1000,1,$vOrderList,$vNow);
$strParent=str_replace("'","\'",$strParent);
$strParent=str_replace("
","",$strParent);
if((int)$isExists>=1){
//	$lvsl_lv0013->Load($lvsl_lv0013->ID);
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<style>
	.tblcaption
{
	color:#000099;
	font-weight:bold;
	background-color:#CFDDE9;
}
.bangleft
{
	height:80px !important;
	font-size:12px Arial;
}
.bt_setdefault
{
	height:25px;
	padding:2px;
	width:130px;
}
.defaultred
{
	color:red;
}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $vDir;?>../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="<?php echo $vDir;?>../css/popup.css" type="text/css">
<script language="javascript" src="<?php echo $vDir;?>../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="<?php echo $vDir;?>../javascript/engine.js"></script>
	<title><?php echo $vLangArr[17];?></title>
	<script>

	<!--
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv810.value=="")
		{
			alert("<?php echo 'Mã nhân viên không rỗng!';?>");
			o.txtlv810.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}		
	}
	function SetDefData(vTime,vRoomid)
	{
	var o=document.frmadd;
	o.txtlv807.value=vRoomid;
	o.txttyperent.value=vTime;
	
		if(o.txtlv810.value=="")
		{
			alert("<?php echo 'Mã nhân viên không rỗng!';?>");
			o.txtlv810.select();
		}
		else
			{
				o.txtFlag.value="10";
				o.submit();
			}
	}
	/*=============================================================================*/
	function Back() {
		
		opener.document.frmadd.submit();
		window.close();
	}
	/*=======================================================================================*/
	function isNumber(s){
		if(s!=""){
			var str=".,0123456789";
			for(var j=0;j<s.length;j++)
				if(str.indexOf(s.charAt(j))==-1)
					return false;
			return true;
		}	
		return true;
	}
	function RunFunction()
	{
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src=\"<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>\" class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
	}
	function AddProd(value)
	{
		var o=document.frmadd;
		var strvalue="&txtlv003="+value+"&txtlv009="+o.txtlv909.value+"&txtlv004=1&txtOpt=1";
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
	}
	function Add()
	{
		var o=document.frmadd;
		var strvalue="&txtlv003="+o.txtlv903.value+"&txtlv009="+o.txtlv909.value+"&txtlv004=1&txtOpt=1";
		var str="<br><iframe id='lvframefrm' height=900 marginheight=0 marginwidth=0 frameborder=0 src='<?php echo $vDir;?>sl_lv0032/sl_lv0032.php?&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0)?>"+strvalue+"' class=lvframe></iframe>";
		div = document.getElementById('lvloaddata');
		div.innerHTML=str;
		o.txtlv903.focus();
	}
	function LoadType(to)
	{

		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'RECONTRACT':
				LoadPopupParent(to,'txtlv806','sl_lv0013','lv003');
				break;
			case 'PO':
				LoadPopupParent(to,'txtlv806','wh_lv0021','lv003');
				break;
		}
	}
	function LoadItem()
	{
		var o=document.frmadd;
		ajax_do ('sl_lv0031/sl_lv0031exce.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv903.value,1);
		
	}
	function LoadSource()
	{
		var o=document.frmadd;
		var vo=o.txtlv805.value;
		switch(vo)
		{
			case 'CONTRACT':
				break;
			case 'RECONTRACT':
				break;
			case 'PO':
				ajax_do ('sl_lv0031/sl_lv0031excesource.php?&lang=<?php echo $plang;?>&childfunc=load'+'&lv002='+o.txtlv802.value	+'&lv005='+o.txtlv805.value+'&lv006='+o.txtlv806.value,1);
				window.setTimeout('RunFunction()',500);
				break;
		}		
	}
	function LoadHD(vobj,vreturn)
	{
		var vcondi="&contractid="+document.frmadd.txtlv801.value+"&startdate="+document.frmadd.txtlv804.value+"&enddate="+document.frmadd.txtlv805.value+"&parentid="+document.frmadd.txtlv817.value;
		LoadTextParentCond(vobj,vreturn,'sl_lv0016','lv003',document.frmadd.txtlv802.value,1,'<?php echo $plang;?>',vcondi);
	}
	function CalculateM()
	{
		var o=document.frmadd;
		o.txtlv911amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv911.value/100);
		o.txtlv908amount.value=parseFloat(o.txtlv904.value*o.txtlv906.value*o.txtlv908.value/100);
		o.txtlvallamount.value=-parseFloat(o.txtlv911amount.value)+parseFloat(o.txtlv908amount.value)+parseFloat(o.txtlv904.value*o.txtlv906.value);
		if(parseFloat(o.txtlvnumber.value)!=0) o.txtlv912.value=parseFloat(o.txtlv904.value)*parseFloat(o.txtlvscore.value)/parseFloat(o.txtlvnumber.value);
	}
	function viewmore()
	{
		var o=document.getElementById('morelistid');
		if(o.style.display=="block")
			o.style.display="none";
		else
			o.style.display="block";
	}
	function Report(vValue)
	{
		var o=document.frmprocess;
		o.target="_blank";
		o.action="<?php echo $vDir;?>sl_lv0013?func=<?php echo $_GET['func'];?>&childfunc=rptretail&ID="+vValue+"&lang=<?php echo $plang;?>";
		o.submit();
	}
	-->
	</script>
</head>
<?php
if($lvsl_lv0013->GetAdd()>0)
{
?>
<body  onkeyup="KeyPublicRun(event)">
<style>


</style>
<div style="font-size:16px;text-align:center;"><?php echo $vLangArr[70];?> <span id="curday"><?php echo $lvsl_lv0013->FormatView($vNow,2);?></span> <span style="color:black!important;font-size:25px" title="<?php echo GetServerTimeSec();?>" id="countdown">11</span></div>
<div class="hd_cafe">
	<ul class="qlycafe">
		<li><div id="cafetab_2" class="licafe" onclick="enablecokhach(13);setviewhere(2);curtab(2);"><?php echo $vLangArr[67];?></div></li>
		<li><div id="cafetab_3" class="licafe" onclick="setviewhere(2);setbancokhach(1);curtab(3);"><?php echo $vLangArr[68];?></div></li>
		<li><div id="cafetab_4" class="licafe" onclick="setviewhere(2);setbancokhach(2);curtab(4);"><?php echo $vLangArr[69];?></div></li>
		<li><div id="cafetab_5" class="licafe" onclick="setviewhere(2);setbancokhach(3);curtab(5);"><?php echo $vLangArr[86];?></div></li>
		<li><div class="licafe" onclick="setZoom(<?php echo (int)$_POST['allcreen'];?>)"><?php echo ((int)$_POST['allcreen']==1)?$vLangArr[72]:$vLangArr[71];?></div></li>
	</ul>
</div>
<!---------------Ban hang---------------------->
<div id="viewhere_1" style="display:none;">
	<div>
		<form   name="frmadd" id="frmadd"  id="frmadd" method="POST" action="?func=<?php echo $_GET['func'];?>&ID=<?php echo $_GET['ID']?>&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>" autocomplete="off">
											<input type="hidden" name="txtStrID" id="txtStrID" value="">
											<input type="hidden" name="txtFlag" id="txtFlag" value="0">
											<input type="hidden" name="txtContractID" id="txtContractID" value="0">
											<input type="hidden" name="txtgopbangid" id="txtgopbangid" value="0">
											<input type="hidden" name="txtdoibangid" id="txtdoibangid" value="0">
											<input type="hidden" name="txtlv801" id="txtlv801" value=""/>
											<input type="hidden" name="txttyperent" id="txttyperent" value=""/>
											<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
											<input type="hidden" name="curtabview" id="curtabview" value="<?php echo $_POST['curtabview'];?>"/>
											<input type="hidden" name="curtang" id="curtang" value="<?php echo $_POST['curtang'];?>"/>
		<table width="100%" style="background:#f2f2f2"><tr><td>		
												
												<?php if($vStrMessage!=""){ ?>
												<div class="message"><font color="#3366CC"><?php echo $vStrMessage;?></font></div>
												<?php }?>
												<div>
													<div style="clear:both;">
														<div style="background:#f2f2f2;float:left;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 5px 5px;height:25px">
															<select name="txtlv807" id="txtlv807"   tabindex="2"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
															<?php echo $lvsl_lv0013->LV_LinkField('lv007',$lvsl_lv0013->lv007);?>
															</select>
														 </div>
														 <div style="background:#f2f2f2;float:left;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 0px 0px;width:250px;height:25px;">
														  <table><tr><td><input name="txtlv802" type="text" id="txtlv802" onblur="if(this.value == '') {this.value = this.title;};" onfocus="if(this.value == this.title) {this.value = '';}" title="Mã khách hàng/CMND" value="Mã khách hàng/CMND" tabindex="2" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
														  </td>
														  <td>
																<ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
																<input type="text" autocomplete="off" class="search_img_btn" name="txtlv802_search" id="txtlv802_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv802','*@*@*.sl_lv0001','concat(lv002,@!:@!,lv009,@!, @!,lv007,@! - @!,lv001)')" onFocus="LoadPopupParent(this,'txtlv802','*@*@*.sl_lv0001','concat(lv002,@!:@!,lv009,@!, @!,lv007,@! - @!,lv001)')" tabindex="200" >
																<div id="lv_popup" lang="lv_popup1"> </div>						  
																</li>
																</ul>
														   </td>
														   </table>
														  </div>
														  <div style="background:#f2f2f2;float:left;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 0px 0px;width:150px;height:25px;">
														  <input name="txtlv803" type="text" id="txtlv803" onblur="if(this.value == '') {this.value = this.title;};" onfocus="if(this.value == this.title) {this.value = '';}" title="Tên khách hàng" value="Tên khách hàng" tabindex="2" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
														  
														  </div>
														  <div style="background:#f2f2f2;float:left;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 5px 5px;height:25px">
															<select name="txtlv814" id="txtlv814"   tabindex="2"  style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
															<option value="">.....Chọn loại khách.....</option>
															<option value="Khách quen">Khách quen</option>
															<option value="Khách VIP">Khách VIP</option>
															</select>
														 </div>
														 <div style="background:#f2f2f2;float:left;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 0px 0px;width:350px;height:25px;">
														  <input name="txtlv809" type="text" id="txtlv809" onblur="if(this.value == '') {this.value = this.title;};" onfocus="if(this.value == this.title) {this.value = '';}" title="Địa chỉ thường trú/tạm trú" value="Địa chỉ thường trú/tạm trú" tabindex="2" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
														  
														  </div>
														  <div style="background:#f2f2f2;float:left;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 0px 0px;width:150px;height:25px;">
														  <input name="txtlv813" type="text" id="txtlv813" onblur="if(this.value == '') {this.value = this.title;};" onfocus="if(this.value == this.title) {this.value = '';}" title="Ghi chú" value="Ghi chú" tabindex="2" maxlength="225" style="width:100%" onKeyPress="return CheckKeys(event,7,this)"/>
														  
														  </div>
														   <div style="background:#f2f2f2;float:right;padding:5px;border:1px #d2d2d2 solid;border-radius:0px 0px 0px 0px;width:220px;height:25px;position:relative;z-index:9999">
															<div style="float:left">
														   <?php
$isRun=1;
if($isRun==1)
{
?>														
														<img width="90" type="image" class="btAdd" name="save" onClick="Save();" 
															src="<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg" align="absmiddle"
															onMouseOut="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															onMouseOver="this.src='<?php echo $vDir;?>../images/iconcontrol/btn_save_02<?php echo ((strtolower($plang)=="vn")?"vn":"");?>.jpg';" 
															title="<?php echo $vLangArr[3];?>" onKeyUp="return CheckKey(event,1)" tabindex="66"/>
<?php
}												
?>																</div>
																<div style="float:right">
																	<div id="morelist1id" style="display:none" class="morelistid">
																		<div><div style="float:left"><span class="khungsptitle"><?php echo $vLangArr[28];?></span></div><div style="float:right"><img onclick="document.getElementById('morelist1id').style.display='none';document.getElementById('morelist1idmin').style.display='block'" width="20" src="images/icon/close.png"/></div></div>
																		<input  name="txtlv810" type="text" id="txtlv810" value="<?php echo $lvsl_lv0013->lv010;?>" tabindex="4" maxlength="15" style="width:100%" onKeyPress="return CheckKeys(event,7,this)" />
																			<ul id="pop-nav7" lang="pop-nav7" onMouseOver="ChangeName(this,7)" onkeyup="ChangeName(this,7)"> <li class="menupopT">
																					<input type="text" autocomplete="off" class="search_img_btn" name="txtlv810_search" id="txtlv810_search" style="width:100%" onKeyUp="LoadPopupParent(this,'txtlv810','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" onFocus="LoadPopupParent(this,'txtlv810','*@*@*.hr_lv0020','concat(lv004,@! @!,lv003,@! @!,lv002,@!-@!,lv001)')" tabindex="200" >
																					<div id="lv_popup7" lang="lv_popup7"> </div>						  
																					</li>
																			</ul>
																		<?php echo $vLangArr[38];?><div id="programid"><select name="txtlv909" id="txtlv909"   tabindex="111"  style="width:80%" onkeypress="return CheckKey(event,1)" onfocus="this.title='1';"/>
																	
																		</select>
																		</div>
																	</div>
																	<div id="morelist1idmin" class="morelist1idmin">
																		<div style="float:right"><img onclick="document.getElementById('morelist1id').style.display='block';document.getElementById('morelist1idmin').style.display='none'" width="20" src="images/icon/more.png"/></div>
																	</div>
																</div>
														   </div>
														   
													</div>
												</div>
													
														
												  
																										
		</td></tr></table>						

													
<!--////////////////////////////////////Code add here///////////////////////////////////////////-->			</td>
			
										</form>
			</div>
			<div id="lvloaddata"></div>
	</div>
	<form method="post" enctype="multipart/form-data" name="frmprocess" > 
						<input type="hidden" name="allcreen" value="<?php echo $_POST['allcreen'];?>"/>
				  		<input name="txtID" type="hidden" id="txtID" />
				  </form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo $vDir;?>../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
</div>
<!---------------Đơn hàng---------------------->
<!---------------Kiem tra tang---------------------->
<div id="viewhere_2" style="display:block;clear:both;">

<?php
echo $lvsl_lv0013->LV_getTangView($vLangArr);
?>
</div>

<!---------------Tâng---------------------->
</body>
<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
<script language="javascript">
window.setTimeout('RunFunction()',100);
div = document.getElementById('lvtitlelist');
div.innerHTML='<?php echo $vLangArr[61];?>';	
div2 = document.getElementById('lv_right_titlelist');
div2.innerHTML='<?php echo $strParent;?>';
changecategory_change(document.frmadd.txtlv903.value);
function viewthanhthu(stt)
{
	sum=parseInt(document.getElementById('txttongthanh').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('thanhthu_'+j);
		var vo=document.getElementById('thanhthus_'+j);
		if(stt==j) 
			{
				o.style.display="block";
				if(vo.className.indexOf('conactive')<=0) vo.className=vo.className+' conactive';
				
			}
		else 
			{
				o.style.display="none";
				if(vo.className.indexOf('conactive')>0) vo.className=vo.className.replace("conactive","");;
			}
			
		
	}
}
function ActiveGop(vthis,vDonHang,vTang)
{
	if(vDonHang=='') return;
	var o=document.getElementById('txtContractID');
	o.value=vDonHang;
	
	var o1=document.getElementById('txtgopbangid');
	if(o1.value=="0")
		{
			o1.value="1";
			ActiveTable(0);
			vthis.value="<?php echo $vLangArr[83];?>";
		}
	else
		{
			o1.value="0";
			ActiveTable(1);
			vthis.value="<?php echo $vLangArr[81];?>";
			document.frmadd.submit();
		}
}
function setDonHang(vDonHang)
{
	var o=document.getElementById('txtContractID');
	o.value=vDonHang;
}
function curtab(i)
{
	sum=4;
	var  vo=document.getElementById('curtabview');
	vo.value=i;
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('cafetab_'+j);
		if(i==j)
		{
			o.className="licafecur";
		}
		else
			o.className="licafe";
	}
}
function ActiveTable(vopt)
{
	sum=parseInt(document.getElementById('sumbangall').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('gopbang_'+j);
		if(vopt==1)
		{
			var vo=document.getElementById('gopbangcheck_'+j);
			var vbang=document.getElementById('bang_'+j);			
			if(vo.checked || vbang.className.indexOf('active')>0)
				o.style.display="block";
			else
			o.style.display="none";
		}
		else
		{
			o.style.display="block";
		}
	}	
}	
function setgopbang(o,bang)
{
			$xmlhttp4=null;
			if(bang=="") 
			{
			alert("No data");
			return false;
			}
			xmlhttp4=GetXmlHttpObject();
			if (xmlhttp4==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			donhang = document.getElementById('txtContractID').value;
			var url=document.location;
			url=url+"?&ajaxgopban=ajaxcheck"+"&bangid="+bang+"&donhangid="+donhang+"&delbang="+((o.checked)?'0':'1');
			url=url.replace("#","");
			xmlhttp4.onreadystatechange=stategopbangactive;
			xmlhttp4.open("GET",url,true);
			xmlhttp4.send(null);
}
function stategopbangactive()
{
	if (xmlhttp4.readyState==4)
		{
			var o1=document.getElementById('txtgopbangid');
			if(o1.value=="0") document.frmadd.submit();
		}
}


function loaddataactive(bangid)
{
			$xmlhttp5=null;
			if(bangid=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp5=GetXmlHttpObject();
			if (xmlhttp5==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?&ajaxbangid=ajaxcheck"+"&bangid="+bangid;
			url=url.replace("#","");
			xmlhttp5.onreadystatechange=stateactivebang;
			xmlhttp5.open("GET",url,true);
			xmlhttp5.send(null);
}	

		function GetXmlHttpObject()
		{
			if (window.XMLHttpRequest)
			{
			  // code for IE7+, Firefox, Chrome, Opera, Safari
				return new XMLHttpRequest();
			}
			if (window.ActiveXObject)
			{
			  // code for IE6, IE5
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			return null;
		}
</script>
<script language="javascript">
function setZoom(i)
{
	var o=document.frmadd;
	o.allcreen.value=((i==0)?"1":"0");
	o.submit();
}
function viewpopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="block";
}
function closepopcalendar(vstt)
{
	var o=document.getElementById("calendarview_"+vstt);
	o.style.display="none";
}
function setBang(vid,state)
{
	var o=document.getElementById('txtlv807');
	o.value=vid;
	if(state==1)	loaddataactive(vid);
}
function setbancokhach(opt)
{
	sum=parseInt(document.getElementById('sumtangall').value);
	viewfloorall(sum);
	enablecokhach(opt);
}
function enablecokhach(vopt)
{
	sum=parseInt(document.getElementById('sumbangall').value);
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('bang_'+j);
		if(vopt==13)
		{
			o.style.display="block";
		}
		else
		{
			if(o.className.indexOf('active')>0)
			{
				if(vopt==1)
					o.style.display="block";
				else
					o.style.display="none";
			}
			else if(o.className.indexOf('waiting')>0)
			{
				if(vopt==3)
					o.style.display="block";
				else
					o.style.display="none";
			}
			else
			{
				if(vopt==1)
					o.style.display="none";
				else if(vopt==3)
					o.style.display="none";
				else
					o.style.display="block";
			}
		}
	}	
}
function setviewhere(i)
{
	sum=2;
	
	for(j=1;j<=sum;j++)
	{	
		var o=document.getElementById('viewhere_'+j);
		if(i==j)
		{
			o.style.display="block";
		}
		else
			o.style.display="none";
	}
}
function setContractID(value)
{
	var o=document.getElementById('txtlv801');
	o.value=value;
	var vo=document.getElementById('txtdoibangid');
	vo.value="1";
	
}
function viewfloorall(sum)
{
	for(j=1;j<=sum;j++)
	{
		var o=document.getElementById('bangtang_'+j);
		o.style.display="block";
		var v=document.getElementById('litangleft_'+j);
		v.className=v.className.replace('current','');
	}
	var v=document.getElementById('litangleft_0');
	if(v.className.indexOf('current')<=0) v.className=v.className+' current';
	var curtang=document.getElementById('curtang');
	curtang.value=0;
}
function viewfloor(value,sum)
{
	
	for(j=0;j<=sum;j++)
	{
		if(j>0) var o=document.getElementById('bangtang_'+j);
		var v=document.getElementById('litangleft_'+j);
		if(j==value)
			{
				if(j>0)  o.style.display="block";
				if(v.className.indexOf('current')<=0)	v.className=v.className+' current';
				
			}
		else
			{
				v.className=v.className.replace('current','');
				if(j>0)  o.style.display="none";
			}
	}
	var curtang=document.getElementById('curtang');
	curtang.value=value;
	//var v=document.getElementById('litangleft_0');
	//v.className=v.className.replace('current','');
}
/* Timer */
setTimeout(setReload,<?php echo ($lvsl_lv0070->lv005==0)?60000:$lvsl_lv0070->lv005*1000;?>);
function setReload()
{
	var o=document.frmadd;
	o.submit();
}

runTimer();
setTimer();
function setTimer ()
{
		var othis=document.getElementById('countdown');
		var myTime=othis.title;
		if (parseInt(myTime)>=0)
		{
			var hour=parseInt(myTime/3600,10);
			var minute=parseInt((myTime%3600)/60,10);
			var second=(myTime%3600)%60;
			var str="";
			othis.innerHTML=(hour + ":" + minute + ":" + second);
			othis.title=parseInt(myTime)+1;
		}
	setTimeout(setTimer,1000);
}
function setTimerTwo (othis,orun,osub)
{
	
		var myTime=othis.title;
		if (parseInt(myTime)>=0)
		{
			var hour=parseInt(myTime/3600,10);
			var minute=parseInt((myTime%3600)/60,10);
			var second=(myTime%3600)%60;
			var str="";
			othis.innerHTML=(hour + ":" + minute + ":" + second);
			othis.title=parseInt(myTime)+<?php echo ($lvsl_lv0070->lv005==0)?60:$lvsl_lv0070->lv005;?>;
			
		}
}
function runTimer()
{
	
	sum=parseInt(document.getElementById('sumbang').value);
	
	for(j=1;j<=sum;j++)
	{
		var o=document.getElementById('bangtime_'+j);
		var v=document.getElementById('timedetailid_'+j);
		var t=document.getElementById('timesubtractid_'+j);
		setTimerTwo(o,v,t);		
	}
	setTimeout(runTimer,<?php echo ($lvsl_lv0070->lv005==0)?60000:$lvsl_lv0070->lv005*1000;?>);
}
runtabview(<?php echo (int)$_POST['curtabview'];?>,<?php echo (int)$_POST['curtang'];?>);
function runtabview(opt,curtang)
{
	var sumtangall=<?php echo $lvsl_lv0013->sumTang;?>;
	if(opt==0) opt=2;
	switch(opt)
	{
		case 1:
		setviewhere(1);		
			break;
		case  2:
			enablecokhach(13);setviewhere(2);
			break;
		case  3:
			setviewhere(2);setbancokhach(1);
			break;
		case  4:
			setviewhere(2);setbancokhach(2)		
			break;
		case  5:
			setviewhere(2);setbancokhach(3)		
			break;
	}
	curtab(opt)
	if(parseInt(curtang)==0)
		viewfloorall(sumtangall);
	else
		viewfloor(curtang,sumtangall)
	
}
/* End timer */
</script>
<?php
} else {
	include ("permit.php");
}	
?>
</html>