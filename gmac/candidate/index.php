<?php
session_start(); 
include("config.php");
include("function.php");
$vFlag= $_POST['facFlag'];
if($vFlag==1)
{
	$prefix=$_POST['lv_prefix'];
					$update=true;
					$correct =(trim($prefix)!="" && $prefix==$_SESSION['rand_code'])?1:0;
					$lmessage='';
					if($facFlag==1 && $correct==0)
					{
							$_SESSION['rand_code']=NULL;
							$update=false;
							$lmessage='<font color=#FF0000>Xin vui long nhập mã bảo vệ lại!</font>';
					}
					$usrname=CheckUser_Login($_POST['lv_loginuser']);
					$usrname2=CheckUser_Login2($_POST['lv_loginuser']);
					$usrlogin=CheckUser_Login($_POST['lv_userdirect']);
					$usrloginadvance=CheckUser_Login($_POST['lv_user_advance']);
					if($usrlogin==1)
						{
							$count=CheckUser_AllTree($_POST['lv_userdirect']);
							if($count>=GetCount_Tree())
							{
								$update==false;
								$lmessage='<font color=#FF0000>Mã người giới thiệu đã đủ thành viên!</font>';
							}
							$update==false;
						}
					//$usremail=CheckEmail($_POST['lv_email']);
					if($update==false)
					{
						Showfac_content_dangky($result,$title_vn,$title_en,$title,$lmessage);
					}
					else
					{
						if($usrlogin==0 || $usremail>0 || $usrloginadvance==0 || ($usrname>0 || $usrname2>0))
						{
							if(($usrname>0 || $usrname2>0))
							{
								$lmessage=$lmessage. "<br><font color=#FF0000>Tên đăng đã tồn tại! Bạn vui lòng nhập lại tên đăng nhập.</font>";
							}
							if($usrlogin==0)
							{
								$lmessage=$lmessage. "<br><font color=#FF0000>Mã người giới thiệu không tồn tại! Bạn vui lòng nhập lại mã người giới thiệu.</font>";
							}
							
							if($usrloginadvance==0)
							{
								$lmessage=$lmessage. "<br><font color=#FF0000>Mã người chỉ định không tồn tại! Bạn vui lòng nhập lại mã người chỉ định</font>";
							}
						/*	if($usremail>0)
							{
								$lmessage=$lmessage."<br><font color=#FF0000>Email đã tồn tại! Bạn vui lòng chọn email khác hoặc vào phần quên mật khẩu.</font>";
							}*/
							$_SESSION['rand_code']=NULL;
						}
						else
						{
							$vresult=checksavegister();
							if($vresult)
							{
								$lmessage=$lmessage."<br><font color=#FF0000>Bạn đã đăng ký thành công!</font>";
							}						
							else
							{
								$_SESSION['rand_code']=NULL;
								$lmessage=$lmessage."<br><font color=#FF0000>Cập nhật dữ liệu không thành công. Xin vui long liên hệ với quản trị website để khắc phục sự cố này.</font>";
								
							}
						}
					}
}
if(isset($_GET['ajaxcheck']))
		{
			echo "[CHECKNAME]";
			$usrlogin=CheckUser_Login($_GET['namelogin']);
			$usrlogin1=CheckUser_Login2($_GET['namelogin']);
			if($usrlogin==0 && $usrlogin1==0)
				echo "<p>Tên đăng nhập này có thể sử dụng</p>";
			else
				echo "<p>Tên đăng nhập đã có. Xin vui lòng nhập tên khác.</p>";		
			echo "[ENDCHECKNAME]";	
			echo "[CITYCODE]";
			echo "[ENDCITYCODE]";
			exit(0);
		}
	if(isset($_GET['ajaxuser']))
		{
			echo "[CHECKUSER]";
			$usrlogin=CheckUser_Login($_GET['namelogin']);
			if($usrlogin==0)
				echo "<p>Mã không hợp lệ! Xin vui lòng nhập lại mã khác.</p>";
			else
			{
					
				if($_GET['opt']==1)
				{
					$count=CheckUser_AllTree($_GET['namelogin']);
					if($count<GetCount_Tree())
						echo "<p>Mã này hợp lệ.</p>";	
					else
						echo "<p>Mã này đã đủ thành viên.Bạn vui lòng nhập mã khác</p>";	
				}
				else
					echo "<p>Mã này hợp lệ.</p>";	
			}
			echo "[ENDCHECKUSER]";	
			echo "[CITYCODE]";
			echo "[ENDCITYCODE]";
			exit(0);
		}
		if(isset($_GET['ajaxemal']))
		{
			echo "[CHECKEMAIL]";
			$usrlogin=CheckEmail($_GET['emaillogin']);
			if($usrlogin>0)
				echo "<p>Email này được sử dụng bởi người dùng khác trong hệ thống. </p>
				<p>Chú ý: một email có thể sử dụng cho nhiều người dùng khác nhau</p>";
			else
				echo "<p>Email này bạn có thể sử dùng</p>";		
			echo "[ENDCHECKEMAIL]";	
			echo "[CITYCODE]";
			echo "[ENDCITYCODE]";
			exit(0);
		}
$TitleView=$title_vn;
	$l_user_direct="Mã người giới thiệu:";
	$l_user_direct2="Phải kiểm tra xem người giới thiệu có trong hệ thống không";
	$l_user_advance="Mã người chỉ định:";
	$l_user_advance2="Nếu không có người chỉ định, thì người chỉ định nhập giống mã người giới thiệu.<br>Phải kiểm tra xem người giới thiệu có trong hệ thống không";
	$l_fullname='Họ và tên:';
	$l_address='Địa chỉ:';
	$l_phone='Điện thoại';
	$l_loginuser='Chủ đề';
	$l_message='Nội dung';
	$l_send='Gửi thông tin';
	$l_register="Đăng ký thành viên";
	$l_phone="Di động:";
	$l_gender="Giới tính:";
	$l_birthday="Ngày sinh:";
	$l_email_add="Địa chỉ email:";
	$l_fullname="Tên đầy đủ:";
	$l_username="Tên đăng nhập:";
	$l_security_code="Mã bảo mật:";
	$l_check_name="Bạn nên bấm vào nút kiểm tra, để biết tên đăng nhập có được sử dụng không.";
	$l_test="Kiểm tra";
	$l_check_email1="Lưu ý:";
	$l_check_email2="Bạn sẽ phải xác nhận e-mail của bạn khi bạn hoàn tất đăng ký.";
	$l_check_email3="Bạn nên bấm vào nút kiểm tra, để biết tên email có được sử dụng không.";
	$l_agree="Đồng ý";
	$l_read="Tôi đã đọc các";
	$l_Terms="Điều khoản";
		define('mesage_thanks','Cảm ơn bạn đã gửi thông tin liên hệ.<br />
		Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
	define('message_fullname','Bạn vui lòng nhập họ tên');
	define('message_email','Bạn vui lòng nhập email.');
	define('message_phone','Bạn vui lòng nhập điện thoại di động.');	
	define('message_content','Bạn vui lòng nhập nội dung.');
		$l_cmnd="Số chứng minh thư:";
///////////////////////////////////////////////////////////////////////////////////////////////
function checksavegister()
{
		$vNow=GetServerDate();
		$lv_Id=InsertWithCheck('lv_lv0007', 'lv001', getyear($vNow)."".getmonth($vNow)."".getday($vNow)."",5);
		$lv_gender=$_POST['lv_gender'];
		$lv_birthday=$_POST['lv_birthday'];
		$lv_firstname=$_POST['lv_firstname'];
		$lv_userdirect=$_POST['lv_userdirect'];
		$lv_email=$_POST['lv_email'];	
		$lv_phone=$_POST['lv_phone'];		
		$lv_user_advance=$_POST['lv_user_advance'];
		$lv_address=$_POST['lv_address'];
		$lv_loginuser=$_POST['lv_loginuser'];
		$lv_cmnd=$_POST['lv_cmnd'];
		$sql="insert into all_gmacv3_0.lv_lv0007(lv001,lv002,lv003,lv004,lv005,lv006,lv007,lv008,lv009,lv010,lv011,lv012,lv013,lv014,lv015,lv016) 
		values('$lv_Id','Guest','','$lv_firstname','0','$lv_loginuser','$vNow','$lv_gender','$lv_email','$lv_address','$lv_phone','$lv_province',0,'$lv_userdirect','$lv_user_advance','$lv_cmnd')";
		$vresult=db_query($sql);
		return $vresult;
}
function CheckUser_AllTree($vUserLogin)
{
		$lv_table="hr_lv0020";	
		$sql="select count(*) num from $lv_table where lv042='$vUserLogin' and lv001<>lv042";
		$vresult=db_query($sql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['num'];
		}
		return 0;
}
function CheckUser_Login($vUserLogin)
{
		$lv_table="hr_lv0020";	
		$sql="select count(*) num from $lv_table where lv001='$vUserLogin'";
		$vresult=db_query($sql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['num'];
		}
		return 0;
}
function CheckUser_Login2($vUserLogin)
{
		$lv_table="lv_lv0007";	
		$sql="select count(*) num from $lv_table where lv006='$vUserLogin'";
		$vresult=db_query($sql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['num'];
		}
		return 0;
}
function GetCount_Tree()
{
		$lv_table="hr_lv0086";	
		$sql="select lv003 from $lv_table ";
		$vresult=db_query($sql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['lv003'];
		}
		return 0;
}
function CheckEmail($vEmail)
{
		global $wpdb;
		$lv_table="lv_lv0007";	
		$sql="select count(*) num from $lv_table where lv009='$vEmail'";
		$vresult=db_query($sql);
		$vrow=db_fetch_array($vresult);
		if($vrow)
		{
			return $vrow['num'];
		}
		return 0;
}

?>
<html>
<head>
<title>ERP SOF</title>
	<link href="logo.gif" rel="icon" type="image/gif"/>		
	<LINK REL="SHORTCUT ICON"  HREF="../../logo.ico" >
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="css/main.css" type="text/css">
</head>
	<script language="javascript">
	/*=======================================================================*/
	function setFocus(){
		document.loginForm.txtUserName.focus();
	}
	/*=======================================================================*/
	function Login(){
		var o = document.loginForm;
		o.txtFlag.value = 1;
	}
	/*=======================================================================*/
	</script>
<style>
	.required
	{
		background:url(sao.png) no-repeat right top;
		height:25px;
		margin:5px;
		margin-left:0px;
	}
</style>	
<body onload="callscreen1();">
		<center>
		<div id="sof">
			<div id="sof_left">
				<div class="sof_left_logo">
					<img  width="100%" src="logo.png"/>
				</div>
				<div class="sof_left_themes" style="v-align:bottom">
					<div class="text_home">
					SOF (c)2011 All Rights Reserved. <a href="http://sof.vn/lien-he-phan-mem-thiet-ke-website/"><strong>Email US</strong></a></br>
						<br/>
						<a href="http://sof.vn" target="_blank"><font color="#45a76b">Powered by</font><font color="red"> www.sof.vn</font> </a>
					</div>
				</div>
			</div>
			<div id="sof_pages">
				<div class="sof_pages_header">
					<div class="hd_title">
						<div class="hd_title_left" style="width:400px">
							CÔNG TY TNHH SX-TM VIỆT HƯƠNG
						</div>
					</div>
					<div class="hd_func">
						<div class="hd_func_left">
							Địa chỉ: 217 Phan Văn Hân, P.17, Q.Bình Thạnh, TP.HCM<br>
							Phone: 08-38406773 </br>
							Fax: 08-38406773
						</div>
					</div>
					<div class="hd_subtitle">
						<div class="lvtitle">
						ĐĂNG KÝ THÀNH VIÊN
						</div>
					</div>
				</div>
				<div class="sof_pages_content" style="overflow:hidden;">
					<center>
					<div>
					<div id="register_user">
								<div id="form_register">
									<div class="topbg_form_register"><?php echo $lmessage;?></div>
									<div id="register-wrapper">
										<form method="post" action="#" id="registerform" name="registerform" onsubmit="return false">
										<input type="hidden" name="facFlag" id="facFlag" value="0"/>
									<?php echo '	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tblregister">
										  <tr>
											<td class="spec" style="width:150px">'.$l_username.'<div style="height:46px;"></div></td>
											<td><input onblur="checkname_change(document.registerform.lv_loginuser.value)" type="text" name="lv_loginuser" id="lv_loginuser" value="'.$lv_loginuser.'" class="required" tabindex="2" style="width:480px;border: 1px solid #89B4D6;" /><!--<input type="button" value="'.$l_test.'" onclick="checkname_change(document.registerform.lv_loginuser.value)" style="width:85px"/>--><div id="textketquacheck"><p>'.$l_check_name.'<p></div></td>
										  </tr>
										  <tr>
											<td class="spec"><label for="fullname">'.$l_fullname.'</label></td>
											<td><input type="text" name="lv_firstname" id="lv_firstname" value="'.$lv_firstname.'"" class="required" tabindex="2" style="border: 1px solid #89B4D6;width:480px;"/></td>
										  </tr>
										  <tr>
											<td class="spec"><label for="pass">'.$l_gender.'</label></td>
											<td> Nam <input type="radio" name="lv_gender" id="lv_gender" value="1" checked="true" tabindex="4"/> Nữ <input type="radio" name="lv_gender" id="lv_gender" value="0" tabindex="4"/></td>
										  </tr>
										  <tr>
											<td class="spec"><label for="pass">'.$l_address.'</label></td>
											 <td><input type="text" name="lv_address" id="lv_address" value="'.$lv_address.'" class="required" tabindex="5" style="width:480px;border: 1px solid #89B4D6;" /></td>
										  </tr>
										   <tr>
											<td class="spec" style="width:150px">'.$l_phone.'</td>
											<td><input  type="text" name="lv_phone" id="lv_phone" value="'.$lv_phone.'" class="required" tabindex="5" style="width:480px;border: 1px solid #89B4D6;" /></td>
										  </tr>
										  <tr>
											<td class="spec"><label for="name">'.$l_email_add.'</label><div style="height:76px;"></td>
											<td>
												<input onblur="checkemail_change(document.registerform.lv_email.value)"  type="text" name="lv_email" id="lv_email" value="'.$lv_email.'"  class="required" tabindex="5" style="width:480px;border: 1px solid #89B4D6;" /><!--<input type="button" value="'.$l_test.'" onclick="checkemail_change(document.registerform.lv_email.value)" style="width:85px"/>-->
											<div id="textketquaemail"><p><span class="textstrong">'.$l_check_email1.'</span>'.$l_check_email2.'</p><p>'.$l_check_email3.'<p>
											</td>
										  </tr>
										 <tr>
											<td class="spec"><label for="name">'.$l_user_direct.'</label><div style="height:36px;"></td>
											<td>
												<input onblur="checkuserdirect_change(document.registerform.lv_userdirect.value,1)" type="text" name="lv_userdirect" id="lv_userdirect" value="'.$lv_userdirect.'"  class="required" tabindex="5" style="width:480px;border: 1px solid #89B4D6;" /><!--<input type="button" value="'.$l_test.'" onclick="checkuserdirect_change(document.registerform.lv_userdirect.value,1)" style="width:85px"/>-->
												<div id="textketquauserdirect"><p><span class="textstrong">'.$l_check_email1.' '.$l_user_direct2.'</span></p></div>
											</td>
										  </tr>
										  <tr>
											<td class="spec"><label for="name">'.$l_user_advance.'</label><div style="height:56px;"></td>
											<td>
												<input  onblur="checkuserdirect_change(document.registerform.lv_user_advance.value,0)" type="text" name="lv_user_advance" id="lv_user_advance" value="'.$lv_user_advance.'"  class="required" tabindex="5" style="width:480px;border: 1px solid #89B4D6;" /><!--<input type="button" value="'.$l_test.'" onclick="checkuserdirect_change(document.registerform.lv_user_advance.value,0)" style="width:85px"/>-->
											<div id="textketquaemailuseradvance"><p><span class="textstrong">'.$l_check_email1.'</span>'.$l_user_advance2.'</p></div>
											</td>
										  </tr>
										  <tr style="height:3px"></tr>
										   <tr>
												 <td class="spec"><label for="agreement">'.$l_security_code.'</label></td>
												 <td>
														<input class="codeput" type="text" name="lv_prefix" id="lv_prefix" value=""  tabindex="7" style="border: 1px solid #89B4D6;"/><img style="float:right;margin-right:321px;border: 1px solid #89B4D6;" src="captchar.php" border="1" /></td>
											
										  </tr>
										  <tr>
											<td class="spec" valign="top"><label for="agreement">'.$l_agree.' </label><p>&nbsp;</p></td>
											<td>
												<input id="agreement" name="agreement" value="agreement" type="checkbox" tabindex="8">
												<p>'.$l_read.' <a >'.$l_Terms.'</a></p>
												<textarea style="width:480px;text-align:left;" rows="10">Chào mừng khách hàng đến với website www.viethuongfood.com.vn . Khi truy cập vào www.viethuongfood.com.vn ("Website") để tham khảo hoặc mua thẻ, khách hàng đã chấp nhận và đồng ý ràng buộc vào bản Thoả Thuận Sử Dụng này. Nếu khách hàng không muốn bị ràng buộc vào bản Thỏa Thuận Sử Dụng này, hoặc không đồng ý với các điều khoản của bản Thỏa Thuận Sử Dụng này, vui lòng không truy cập Website và sử dụng dịch vụ của VIET HUONG FOOD. Nếu khách hàng có bất kỳ câu hỏi nào về bản Thoả Thuận Sử Dụng này, xin hãy liên lạc với chúng tôi qua email info@VIET HUONG FOOD.vn 

												Điều khoản sử dụng:
													  - Thẻ VIET HUONG FOOD chỉ có giá trị khi sử dụng tại những địa điểm chấp nhận thẻ được niêm yết trên Website. Việc sử dụng phải đúng với những điều kiện được quy định cho từng địa điểm - VIET HUONG FOOD có quyền thay đổi danh sách các địa điểm chấp nhận thẻ và điều kiện sử dụng tại bất kỳ đối tác nào mà không cần báo trước. Khách hàng có trách nhiệm tìm hiểu thông tin mới nhất trước khi sử dụng thẻ VIET HUONG FOOD.  - Nếu gặp khó khăn khi sử dụng thẻ VIET HUONG FOOD, phiếu giảm giá VIET HUONG FOOD tại địa điểm nào đó, khách hàng cần gọi điện thoại thông báo cho bộ phận chăm sóc khách hàng của VIET HUONG FOOD để bộ phần này phối hợp với đối tác giải quyết cho khách hàng. 
												Trách nhiệm, nghĩa vụ
													  - Khách hàng có trách nhiệm cung cấp các thông tin mới nhất, đầy đủ, trung thực và chính xác về bản thân khách hàng khi đặt thẻ và thanh toán tại Website. Đồng thời, khách hàng cam kết thanh toán đúng theo quy định của hình thức thanh toán mà khách hàng chọn lựa khi thực hiện đặt mua thẻ. 
													  - Trong trường hợp VIET HUONG FOOD xác nhận bất kỳ thông tin nào của khách hàng không phải là thông tin thật, không đầy đủ, hoặc không chính xác, chúng tôi có quyền đình chỉ hoặc từ chối phục vụ, giao thẻ mà không phải chịu bất cứ trách nhiệm nào đối với khách hàng. 
													  - Khách hàng hoàn toàn chấp nhận các chính sách của inCard và tuân thủ các quy định về giao nhận, vận chuyển, thanh toán, trả hàng đã được VIET HUONG FOOD đăng tải công khai tại Website
												</textarea>
																	</td>
																  </tr>
																 
																  <tr>
																	<td>&nbsp;</td>
																	<td>
																	<br>
																	<input class="submit" type="image" name="imageField" id="imageField" src="register_button.png" onclick="SaveRegister()" tabindex="9"/>
																	</td>
																  </tr>
																</table>
																<div id="alert" style="color:red;text-align:center;width:100%">'.$lmessage.'</div>
																</form>';
	?>
															</div>
														</div>
													</div>
												</div>	
													
					</div>
					</center>
				</div>
			</div>
		</div>
		</center>
	</body>	
	
	<form name="frmdatabaseload" method="post" >
		<input type="hidden" name="txtFlag" id="txtFlag" value="2">
		<input type="hidden" name="txtDatabase" id="txtDatabase" value="">
	</form>
<!-- End Footer -->
<!-- End ImageReady Slices -->
<script language="javascript">
function callscreen()
{
	var o=document.getElementById('header');
	var o1=document.getElementById('menu_header_my_logo');
	var o2=document.getElementById('content');
	var o4=document.getElementById('center_content');
	var o3=document.getElementById('td_screen_save');
	var o5=document.getElementById('header_my_logo');
	var o6=document.getElementById('left_content');
	var widthscreen=screen.width;
	if(widthscreen==800)
		{
		o.style.width="800px";
		o1.style.width="511px";
		o5.style.width="511px";
		o2.style.width="800px";
		o4.style.width="544px";
		o3.style.width="330px";
		}
	else if(widthscreen>800)
		{
		o.style.width=widthscreen+"px";
		o1.style.width=((widthscreen-800)+511)+"px";
		o5.style.width=((widthscreen-800)+511)+"px";
		o2.style.width=widthscreen+"px";
		o4.style.width=((widthscreen-800)+544)+"px";
		o3.style.width="412px";
		}
	else if(widthscreen<800 && widthscreen>350)
		{
		o6.style.width="100px";
		var o7=document.getElementById('header_company');
		o7.innerHTML='';
		o.style.width=widthscreen+"px";
		o1.style.width=((widthscreen-800)+511)+"px";
		o5.style.width=((widthscreen-800)+511)+"px";
		o2.style.width=widthscreen+"px";
		o4.style.width=((widthscreen-800)+544)+"px";
		o3.style.width="250px";
		}
	else
		{
		var o7=document.getElementById('header_company');
		o7.innerHTML='';
		widthscreen1=400;
		o.style.width=widthscreen1+"px";
		o1.style.width=((widthscreen1-800)+511)+"px";
		o5.style.width=((widthscreen1-800)+511)+"px";
		o2.style.width=widthscreen1+"px";
		o4.style.width=((widthscreen1-800)+544)+"px";
		o3.style.width="350px";
		}
}
	function callscreen1()
	{
		var heightscreen=screen.height;
		vsof_pages=document.getElementById('sof_pages');
		vsof_left=document.getElementById('sof_left');
		vsof_pages.style.height="630px";
		vsof_left.style.height=vsof_pages.style.height;
	}
	var o=document.loginForm;
		//o.txtUserName.focus();
	function LoadCustomer(customer)
	{
		var o=document.frmdatabaseload;
		o.txtDatabase.value=customer;
		o.submit();
	}
	
</script>
<script language="javascript">
	document.registerform.lv_loginuser.focus();
	function onlyNumbers(evt)
	{
		var e = evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	function checkname_change(value)
		{
			$xmlhttp=null;
			if(value=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?ajaxcheck=ajax_check"+"&namelogin="+value;
			url=url.replace("#","");
			xmlhttp.onreadystatechange=stateChangedUser;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
	function checkuserdirect_change(value,opt)
		{
			$xmlhttp=null;
			if(value=="") 
			{
			alert("Xin vui long nhap tên đăng nhập");
			return false;
			}
			xmlhttp=GetXmlHttpObject();
			if (xmlhttp==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?ajaxuser=ajax_check"+"&namelogin="+value+"&opt="+opt;
			url=url.replace("#","");
			if(opt==1)
				xmlhttp.onreadystatechange=stateChanged;
			else
				xmlhttp.onreadystatechange=stateChangedAdvance;
			xmlhttp.open("GET",url,true);
			xmlhttp.send(null);
		}
		function checkemail_change(value)
		{
			xmlhttp1=null;
			if(value=="") 
			{
			alert("Xin vui long nhap email");
			return false;
			}
			xmlhttp1=GetXmlHttpObject();
			if (xmlhttp1==null)
			{
				alert ("Your browser does not support AJAX!");
				return;
			}
			var url=document.location;
			url=url+"?ajaxemal=ajax_check"+"&emaillogin="+value;
			url=url.replace("#","");
			xmlhttp1.onreadystatechange=stateChangedEmail;
			xmlhttp1.open("GET",url,true);
			xmlhttp1.send(null);
		}		
		function stateChangedEmail()
		{
			if (xmlhttp1.readyState==4)
			{
				var startdomain=xmlhttp1.responseText.indexOf('[CHECKEMAIL]')+12;
				var enddomain=xmlhttp1.responseText.indexOf('[ENDCHECKEMAIL]');
				var domainid=xmlhttp1.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('textketquaemail').innerHTML=domainid;

			}
		}
		function stateChangedAdvance()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECKUSER]')+11;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECKUSER]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				document.getElementById('textketquaemailuseradvance').innerHTML=domainid;
			}
		}
		function stateChanged()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECKUSER]')+11;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECKUSER]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				//document.getElementById('lbketqua').innerHTML='<label for="name">Kết quả kiểm tra</label>';
				document.getElementById('textketquauserdirect').innerHTML=domainid;
			}
		}
		function stateChangedUser()
		{
			if (xmlhttp.readyState==4)
			{
				var startdomain=xmlhttp.responseText.indexOf('[CHECKNAME]')+11;
				var enddomain=xmlhttp.responseText.indexOf('[ENDCHECKNAME]');
				var domainid=xmlhttp.responseText.substr(startdomain,enddomain-startdomain);
				//document.getElementById('lbketqua').innerHTML='<label for="name">Kết quả kiểm tra</label>';
				document.getElementById('textketquacheck').innerHTML=domainid;
			}
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
function Check_CMND()
{
	var o=document.registerform;
	var str=o.lv_cmnd.value;
	if (str.length!=9)
	{
		if (str.length!=12)
		{
			alert ("Xin vui lòng nhập số chứng minh thư có 9 hoặc 12 số");
			o.lv_cmnd.focus();
			return false;
		}
	}
}		
function CheckSaveRegister()
{
	var o=document.registerform;
	var msg = document.getElementById("alert");
	if(o.lv_loginuser.value=="")
	{
		//alert ("Bạn vui lòng nhập tiêu đề");
		msg.innerHTML = '<?php echo 'Bạn vui lòng nhập tên đăng nhập';?>';
		o.lv_loginuser.focus();
		return false;
	}
	else if (o.lv_firstname.value == "")
	{
		//alert ("Bạn vui lòng nhập tiêu đề");
		msg.innerHTML = '<?php echo message_fullname;?>';
		o.lv_firstname.focus();
		return false;
	}
	else if(o.lv_gender.value=="")
	{
		msg.innerHTML = 'Mật mã không rỗng!';
		o.lv_gender.focus();
		return false;
	}
	else if(o.lv_address.value=="")
	{
		msg.innerHTML = 'Xin vuil lòng nhập địa chỉ!';
		o.lv_address.focus();
		return false;
	}
	else if (o.lv_phone.value == "")
	{
		//alert ("Bạn vui lòng nhập tiêu đề");
		msg.innerHTML = '<?php echo message_phone;?>';
		o.lv_phone.focus();
		return false;
	}
	else if((o.lv_email.value!="" && eLCheckThis(o.lv_email.value)!=true) ){
		msg.innerHTML = 'Email thì không hợp lệ!';
		o.lv_email.select();
		return false;
	}	
	else if(o.lv_email.value=="")
	{
		msg.innerHTML = 'Xin vui lòng! Nhập Email.';
		o.lv_email.focus();
		return false;
	}	
	else if(o.lv_userdirect.value=="")
	{
		msg.innerHTML = 'Người giới thiệu không được rỗng!';
		o.lv_userdirect.focus();
		return false;
	}
	else if(o.lv_user_advance.value=="")
	{
		msg.innerHTML = 'Người chỉ định không được rỗng!';
		o.lv_user_advance.focus();
		return false;
	}
	else if(o.agreement.checked==false)
	{
		msg.innerHTML = 'Bạn phải đồng ý các điều khoản.';
		o.agreement.focus();
		return false;
		
	}
	return true;
}

function SaveRegister()
{
		
	if(CheckSaveRegister()==true)
	{
		var o=document.registerform;
		o.facFlag.value = '1';
		o.target="_self";
		o.submit();
	}
}
function eLCheckThis(cbxEmail){
	var str=cbxEmail;
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
	   //alert("Invalid E-mail ID")
	   return false
	}
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
	   //alert("Invalid E-mail ID")
	   return false
	}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		//alert("Invalid E-mail ID")
		return false
	}
	if (str.indexOf(at,(lat+1))!=-1){
		//alert("Invalid E-mail ID")
		return false
	}
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		//alert("Invalid E-mail ID")
		return false
	}
	if (str.indexOf(dot,(lat+2))==-1){
		//alert("Invalid E-mail ID")
		return false
	}
	if (str.indexOf(" ")!=-1){
		//alert("Invalid E-mail ID")
		return false
	}
	return true					
}
</script>
</html>
<?php ob_end_flush();?>