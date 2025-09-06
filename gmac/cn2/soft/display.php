<div id="maytinh">
<?php 
require_once("../clsall/lv_controler.php");
$plang=$_GET['lang'];
if($plang!="VN" || $plang=="")
$plang="EN";
$vNow=GetServerDate();
?>
<div id='lv_introduce'>
<script language="javascript">
function introvisible()
{
	var o=document.getElementById('lv_introduce_content');
	var o1=document.getElementById('seemore');
	if(o.style.display=='block')
	{
		o.style.display="none";
		<?php
		 if($plang=="EN")
		{	
		?>
		o1.innerHTML='See more';
		<?php
		 }
		 else 
		 {
		?>
		o1.innerHTML='Xem thêm';
		<?php 
		}?>
	}
	else
	{
		o.style.display="block";
		<?php
		 if($plang=="EN")
		{	
		?>
		o1.innerHTML='Close';
		<?php
		 }
		 else 
		 {
		?>
		o1.innerHTML='Đóng';
		<?php 
		}?>
	}
}
</script>
<?php

if($plang=="EN")
{		
?>
<div id='lv_introduce_header'>WELCOME TO ERP SOF V2.0 <a href="javascript:introvisible()" id='seemore'>See more</a></div>
<div id='lv_introduce_content' style="display:none"> 
<br />
<strong>Shortcuts:</strong>
<br/>
&nbsp;&nbsp;&nbsp;<strong>+ Keyboard Shortcuts section on the first function of the software (Menu Header):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Up : Hiding items on the header of the software<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Down : Visible items on the header of the software<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Left : Allow the item functions run on the left of the bar.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Right : Allows the entry function to run on the right of the bar.  <br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ The keyboard shortcuts to the left of the software (Left Menu):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- F9 : Toggle display monitors keystrokes and mouse<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + F9 : On/Off screen display function on the left<br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ The keyboard Shortcuts section of software to manipulate content (Content):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + L/l : Set the interface manipulating content (right click the first to manipulate the text)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + E/e : Edit the selected content<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + X/x : Delete the selected content.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + F/f : Content Filtering.  <br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + V/v : The directory the row and column operations (ECs to exit Press - Press Enter to save - Use the Tab or Shift + Tab keys to move up and down).<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + K/k : The directory the output data manipulation (ECs to exit Press - Press Enter to save - Use the Tab or Shift + Tab keys to move up and down).<br/>

<br />
<br />
About Company:
<br />
SOF CO., LTD
<br />
Add: 23 Nguyen Quang Bich Str., 13 Ward, Tan Binh Dist., Ho Chi Minh City
<br />
Phone: (848) 36.020.139    Fax: (848) 38.498.379
<br/>
Mobi: 0933 549 469
<br/>
Email:sales@sof.vn
<br />
Website: <a href="http://www.sof.vn" target="_blank">www.sof.vn</a>
<br />
</div>
<?php
}
else
{
?>
<div id='lv_introduce_header'>
SOF ERP V.2 là một hệ thống quản trị doanh nghiệp, được phát triển bởi CTY TNHH SOF. Hệ thống này chạy trên tất cả các hệ điều hành và là giải pháp dựa trên nền web. Vì vậy nó thật đơn giản đển bản triển khai và tránh bản quyền không cần thiết cho máy chủ và người dùng của máy con. <a href="javascript:introvisible()" id='seemore'>Xem thêm</a>
</div>
<div id='lv_introduce_content' style="display:none"> 
<br />
<strong>Các phím tắt:</strong>
<br/>
&nbsp;&nbsp;&nbsp;<strong>+ Phím tắt mục chức năng trên đầu của phần mềm (Menu Header):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Up : Ẩn mục chức năng trên cùng của phần mềm<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Down : Hiện mục chức năng trên cùng của phần mềm<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Left : Cho phép các mục chức năng chạy về trái của thanh.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + Right : Cho phép các mục chức năng chạy về phải của thanh.  <br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ Phím tắt mục chức năng bên trái của phần mềm (Menu Left):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- F9 : Chuyển đổi qua lại màn hình thao tác phím và màn hình dùng chuột<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ctrl + F9 : Tắt mở màn hình chức năng bên trái màn hình<br/><br/>
&nbsp;&nbsp;&nbsp;<strong>+ Phím tắt mục thao tác nội dụng phần mềm (Content):</strong><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + L/l : Chọn giao diện thao tác nội dung(phải nhấn đầu tiên khi muốn thao tác phần nội dung)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shift + E/e : Sửa dòng nội dung được chọn<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + X/x : Xóa dòng nội dung được chọn.<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + F/f : Lọc nội dung.  <br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + V/v : Hiện mục chức thao tác dòng và cột (Nhấn phím Ecs để thoát - Nhấn phím Enter để lưu - Sử dụng phím Tab hoặc Shift +Tab để di chuyển lên xuống).<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Shif + K/k : Hiện mục chức thao tác kết xuất dữ liệu (Nhấn phím Ecs để thoát - Nhấn phím Enter để lưu - Sử dụng phím Tab hoặc Shift +Tab để di chuyển lên xuống).<br/>

<br />
Về Công Ty:
<br />
CTY TNHH SOF
<br />
Địa chỉ: 23 đường Nguyễn Quang Bích, P. 13, Q. Tân Bình, Tp. HCM.
<br />
Điện thoại: (848) 36.020.139    Fax: (848) 38.498.379
Di động: 0933 549.469
<br />
Email:sales@sof.vn
<br />
Website: <a href="http://sof.vn" target="_blank">www.sof.vn</a>
<br />
</div>
<?php
}
$sqlS="select sum(data_length+index_length)/1024/1024 SIZEMB,(select A.lv003 from sofv3_0.lv_lv0099 A where A.lv001='".DB_DATABASE."' limit 0,1) SIZEBUY from information_schema.TABLES  where table_schema='".DB_DATABASE."'  group by table_schema ";
$bResult = db_query($sqlS);
$vrow = db_fetch_array ($bResult);
$vsizebuy=round($vrow['SIZEBUY'],3);
$vsize=round($vrow['SIZEMB'],3);
$vsizeG=round($vsize/1024,3);
$vsizeCL=$vsizebuy-0.3-$vsizeG;
$vsql="update sofv3_0.lv_lv0099 set lv004='".$vsizeCL."' where lv001='".DB_DATABASE."'";
db_query($vsql);
?>
<div ><hr></div>
<div id="alert_contact_30">
	
	<?php 
		   if($plang=="EN")
			{	
			echo '<div id="alert_contact_header" style="padding:4px"><strong>';
			 echo 'HOSTING CAPACITY';
			echo '</strong>
			</div>
			<div>
				<ul class="hostingcss">
					<li>Capacity Hosting: '.$vsizebuy.' GB</li>
					<li>Code: 0.3 GB</li>
					<li>Database: '.round($vsizeG,3).' GB</li>
					<li>The remaining capacity: '.($vsizebuy-0.3-$vsizeG).' GB</li>
				</ul>
			</div>'; 
			}
		   else
		   {
			echo '<div id="alert_contact_header" style="padding:4px"><strong>';
			 echo 'DUNG LƯỢNG HOSTING';
			echo '</strong>
			</div>
			<div>
				<ul  class="hostingcss">
					<li>Tổng Hosting: '.$vsizebuy.' GB</li>
					<li>Code: 0.3 GB</li>
					<li>Dữ liệu: '.round($vsizeG,3).' GB</li>
					<li>Còn lại: '.($vsizebuy-0.3-$vsizeG).' GB</li>
				</ul>
			</div>';  
		   }	
		   ?>
</div>
<?php
require_once("../clsall/sl_lv0024.php");
$mosl_lv0024=new sl_lv0024($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0024');
if($mosl_lv0024->GetView()==1)
{
?>
<div ><hr></div>
<div id="alert_contact_30">
	
	<div>
		<div style="clear:both">
				
	 <form name="frmhome" method="get">
	<div id="alert_contact_header" style="padding:4px"><strong>
	<?php 
		   if($plang=="EN")
			{	
			 echo 'CHAR BUSINESS RESULTS 5 MONTH RECENT: ';
			}
		   else
		   {
		   	 echo 'LƯỢC ĐỒ DANH THU 5 THÁNG GẦN ĐÂY: ';
		   }	
		   ?>
	</strong>
	
<?php	
$vNow=GetServerDate();		   
$saleMonthS=$_GET['saleMonthS'];		
if($vsaleDay=="" || $vsaleDay==NULL) $vsaleDay= getday($vNow);
$vsaleMonth=$_GET['saleMonth'];		   
if($vsaleMonth=="" || $vsaleMonth==NULL) $vsaleMonth= getmonth($vNow);
		   ?>
		   <input type="hidden" name="lang" value="<?php echo $_GET['lang'];?>"/>
		   <input type="hidden" name="opt" value="<?php echo $_GET['opt'];?>"/>
		   Từ tháng:
		  <select name="saleMonthS">
				<?php
				for($i=1;$i<=12;$i++)
				{
				echo '<option value="'.Fillnum($i,2).'" '.(($vsaleMonth==1)?'selected="selected"':'').'>'.(Fillnum($i,2)).'</option>';
				}
				?>
			</select>
		   <select name="saleYearS" >
				<?php
				$vsaleYearS=$_GET['saleYearS'];
				$vyear=(int)getyear($vNow);
				
				for($i=0;$i<=15;$i++)
				{
				echo '<option value="'.($vyear-$i).'" '.(($vsaleYearS==($vyear-$i))?'selected="selected"':'').'>'.($vyear-$i).'</option>';
				}
				?>
			</select>
			Đến tháng:
			 <select name="saleMonth">
				<?php
				for($i=1;$i<=12;$i++)
				{
				echo '<option value="'.Fillnum($i,2).'" '.(($vsaleMonth==$i)?'selected="selected"':'').'>'.(Fillnum($i,2)).'</option>';
				}
				?>
			</select>
		   <select name="saleYear" >
				<?php
				$vsaleYear=$_GET['saleYear'];
				$vyear=(int)getyear($vNow);
				
				for($i=0;$i<=15;$i++)
				{
				echo '<option value="'.($vyear-$i).'" '.(($vsaleYear==($vyear-$i))?'selected="selected"':'').'>'.($vyear-$i).'</option>';
				}
				?>
			</select>
			
			<input type="submit" value="Xem" onclick="document.frmhome.submit()"/>
		</form>
	</li>
					</div>			
		<img src="chartsl.php?lang=<?php echo $plang;?>&saleYear=<?php echo $_GET['saleYear'];?>&saleMonth=<?php echo $_GET['saleMonth'];?>&saleYearS=<?php echo $_GET['saleYearS'];?>&saleMonthS=<?php echo $_GET['saleMonthS'];?>" width="100%" />
		<br>
	</div>
</div>
<?php 
}
require_once("../clsall/sl_lv0001.php");
$mosl_lv0001=new sl_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0001');
if($mosl_lv0001->GetView()==1)
{
?>
<div ><hr></div>
<div id="alert_contact_30">
<table class="ftable" cellpadding="1" cellspacing="1" style="position:relative;">
	<tbody><tr>
	<td class="titlerow" style="color:#000;font-weight:bold">
	<div style="clear:both">
				<li class="home_title">
	<?php 
	$vStrLi='';
	$vStr='';
	$vStrPost='';
	$vCount=0;
	$slq="select * from (select A.lv001,A.lv002,A.lv003,A.lv017,A.lv100,DATEDIFF(concat(year(CURRENT_DATE()),'-',month(lv017),'-',day(lv017)),CURRENT_DATE()) DAYRE  from all_gmacv3_0.sl_lv0001 A  where  DATEDIFF(concat(year(CURRENT_DATE()),'-',month(lv017),'-',day(lv017)),CURRENT_DATE())>=0 and DATEDIFF(concat(year(CURRENT_DATE()),'-',month(lv017),'-',day(lv017)),CURRENT_DATE())<=7  ) MP order by MP.DAYRE asc";
$vResult=db_query($slq);
while($vrow=db_fetch_array($vResult))
{
	$vCount++;
			if($plang=="EN")
			{
				
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</a></td><td>".$vrow['lv003']."</a>"."</td><td>".$mosl_lv0001->FormatView($vrow['lv017'],2)."</td><td>".(($vrow['DAYRE']==0)?'Today':$vrow['DAYRE']." days")."</td><td>".$mosl_lv0001->FormatView($vrow['lv100'],10)."</td><tr>";
				$vStr=$vStr.$vrow['lv003']."(".$vrow['lv001']." - ExpireDate:".(($vrow['DAYRE']==0)?'Today':$vrow['DAYRE']." days")."(".$mosl_lv0001->FormatView($vrow['lv017'],2).") )&nbsp;&nbsp;&nbsp;";
			}
			else 
			{
				$vStrLi=$vStrLi."<tr class=\"lvlinehtable".($vCount%2)."\"><td>$vCount</td><td>".$vrow['lv001']."</a></td><td>"." ".$vrow['lv003']."</a>"."</td><td>".$mosl_lv0001->FormatView($vrow['lv017'],2)."</td><td>".(($vrow['DAYRE']==0)?'Hôm nay':$vrow['DAYRE']." ngày")."</td><td>".$mosl_lv0001->FormatView($vrow['lv100'],10)."</td><tr>";
				$vStr=$vStr.$vrow['lv003']."(".$vrow['lv001']." - Ngày còn lại:".(($vrow['DAYRE']==0)?'Hôm nay':$vrow['DAYRE']." ngày")."(".$mosl_lv0001->FormatView($vrow['lv017'],2)."))</a>&nbsp;&nbsp;&nbsp;";
			}
}
		  $vTitle=''; 
		  if($plang=="EN")
			{	
			 $vTitle= 'STAFF LIST BEFORE 7 DAYS BIRTHDAY ('.$vCount.')';
			 echo $vTitle.'<span style="cursor:pointer" onclick="SendCheckApr(3,\''.$vTitle.'\')">View</span>';
			}
		   else
		   {
		   	 $vTitle= 'DANH SÁCH KHÁCH HÀNG SẮP SINH NHẬT TRƯỚC 7 NGÀY ('.$vCount.')';
			 echo $vTitle.'<span style="cursor:pointer" onclick="SendCheckApr(3,\''.$vTitle.'\')">Xem</span>';
		   }	
?> <div id="calendarview_3" class="viewcalandar" style="width:600px;width:600px;display: none; clear: both; z-index: 99999;position:relative;clear:both">
					<!--<div style="float:left;width:400px">-->
					<p onclick="closepopcalendar('3')"><img width="20" src="../images/icon/close.png"></p>
						<table class="lvtable">
						<tr><td class="lvhtable">STT</td><td class="lvhtable">Mã</td><td class="lvhtable">Tên</td ><td class="lvhtable">Ngày Sinh</td ><td class="lvhtable">Ngày còn lại</td ><td class="lvhtable">Điểm</td ></tr>
						<?php echo $vStrLi;?>
						</table>
					<!--</div>
					<div style="float:right;width:20px;color:red;cursor:pointer;overflow:hidden;"><p onclick="closepopcalendar('3')"><img width="20" src="../images/icon/close.png"></p>--></div>
</li>
					</div>
				</td>
				</tr>
				<tr>
				  <td>      
				  <div style="width:100%">
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
?>
	</marquee>
	</div>
		</td>
		</tr>
		</tbody>
		</table>
		</div>
<?php 
}
/*
$vCount=0;
require_once("../clsall/wh_lv0008.php");
require_once("../clsall/wh_lv0010.php");
require_once("../clsall/wh_lv0001.php");
$mowh_lv0010=new wh_lv0010($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0011');
$mowh_lv0008=new wh_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0008');
$mowh_lv0001=new wh_lv0001($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0008');
if($mowh_lv0008->GetView()==1 || $mowh_lv0010->GetView()==1)
{
	$slq="select A.*,B.lv002 ItemName from wh_lv0012 A left join all_gmacv3_0.sl_lv0007 B on A.lv002=B.lv001 where A.lv004<0; ";
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
		if($vCount%2==0)
			$vStr=$vStr."<font color='green'>".$vrow['lv002']."(".$vrow['ItemName']." - ".$vrow['lv003']." - SL:".$vrow['lv004'].")</font> | ";
		else 
			$vStr=$vStr."".$vrow['lv002']."(".$vrow['ItemName']." - ".$vrow['lv003']." - SL:".$vrow['lv004'].") | ";
				
	}
?>
<hr>
<link rel="stylesheet" href="../css/popup.css" type="text/css">
<div id="alert_contact_30">
	<div id="alert_contact_header" style="padding:4px"><strong>
	<?php 
	
		   if($plang=="EN")
			{	
			 echo 'CHECK INVENTORY QUICKLY AND ALARM QUANTITY LESS THAN ZERO('.$vCount.")";
			}
		   else
		   {
		   	 echo 'KIỂM TRA SỐ LƯỢNG TỒN KHO NHANH VÀ CẢNH BÁO SỐ LƯỢNG ÂM CỦA SẢN PHẨM BÁN('.$vCount.")";
		   }	
		   ?>
	</strong>
	</div>
	<div>
		<div>
			<marquee onmouseover="this.stop()" onmouseout="this.start()">
			<?php
				echo $vStr;
			?>
			</marquee>
		</div>
		<div >
			<table width="80%"><tr><td width="300">
							  	<font color="red"><?php 
	
		   if($plang=="EN")
			{
				 echo 'Please!Enter ItemID, WarehoseID or Lots:<br><font style="font-size:9px">Note: Only Items was recieption to display</font></font>';	
			}
		   else
		   {
		   		echo 'Xin vui lòng nhập mã sản phẩm,mã kho hay lô:<br><font style="font-size:9px">Chú ý: Chỉ sản phẩm có nhập kho thì mới hiển thị</font></font>';
		   }	
		   ?>
							  </td>
							  <td>
								<ul lang="pop-nav1" onmouseover="ChangeName(this,1)" id="pop-nav"> <li class="menupopT">
							    <input type="text" tabindex="200" onfocus="LoadPopupParentWH(this,'txtlv007','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" onkeyup="LoadPopupParentWH(this,'txtlv007','wh_lv0020','concat(lv001,@! @!,lv002,@! @!,lv003,@! @!,lv004,@! @!,lv005,@! @!,lv006,@! @!,lv007,@! @!,lv008)')" style="width:100%" id="txtlvsearch1" name="txtlvsearch1" class="search_img_btn" autocomplete="off">
							    <div lang="lv_popup1" id="lv_popup"> </div>						  
						</li>
					</ul>
					</td></tr></table>
		</div>
		<script language="javascript" src="<?php echo $vDir;?>../javascript/menupopup.js"></script>
		
	</div>
</div>
<?php 
}
if($mowh_lv0010->GetView()==1)
{
	$vStr=$mowh_lv0010->LV_Get_MainPage($vNow,$numinvoice);
?>
<div><hr></div>
<div id="alert_contact_30">
	<div id="alert_contact_header" style="padding:4px"><strong>
	<?php 
		   if($plang=="EN")
			{	
			 echo 'LIST ORDERS OUTSTOCK IN TODAY ('.$numinvoice.")";
			}
		   else
		   {
		   	 echo 'DANH SÁCH CÁC PHIẾU XUẤT TRONG NGÀY('.$numinvoice.")";
		   }	
		   ?>
	</strong>
	</div>
	<div>
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
		echo $vStr;
	?>
	</marquee>
	</div>
</div>
<?php 
}

if($mowh_lv0008->GetView()==1 || $mowh_lv0010->GetView()==1)
{

	$vStr='';
	$vCount=0;
	$slq="select * from 
	(
	select A.lv001,A.lv002,A.lv003,A.lv004,A.lv007,A.lv009  from wh_lv0008 A where A.lv007=0
	UNION 
	select A.lv001,A.lv002,A.lv003,A.lv004,A.lv007,A.lv009  from wh_lv0010 A where A.lv007=0
	) MP ";
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
					$vStr=$vStr."InvoiceID:".$vrow['lv001']."(".$vrow['lv004']."-".$vrow['lv002']."-".$vrow['lv003']."-".$mowh_lv0008->FormatView($vrow['lv009'],2).") | ";
				
	}
?>
<div><hr></div>
<div id="alert_contact_30">
	<div id="alert_contact_header" style="padding:4px"><strong>
	<?php 
		   if($plang=="EN")
			{	
			 echo 'LIST INVOICES NOT APPROVAL ('.$vCount.")";
			}
		   else
		   {
		   	 echo 'DANH SÁCH CÁC PHIẾU CHƯA KHOÁ('.$vCount.")";
		   }	
		   ?>
	</strong>
	</div>
	<div>
	<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<?php
	
		echo $vStr;
	?>
	</marquee>
	</div>
</div>
<?php 
}
if($mowh_lv0008->GetView()==1 || $mowh_lv0010->GetView()==1)
{
	$mowh_lv0001->LV_Approval('NUOCUONG');
	if($plang=="EN")
			{	
	$vStrTableMin='<table class="lvtable" border="1" align="center">
	<tr class="lvhtable"><td>Order</td><td>ItemID</td><td>Item Name</td><td>WarehouseID</td><td>Min Banlace</td><td>Banlace</td></tr>
	@01
	</table>';
	$vStrTableMax='<table border="1" class="lvtable">
	<tr class="lvhtable"><td>Order</td><td>ItemID</td><td>Item Name</td><td>WarehouseID</td><td>Max Banlace</td><td>Banlace</td></tr>
	@01
	</table>';
	}
	else
	{
		$vStrTableMin='<table class="lvtable"  align="center">
	<tr class="lvhtable"><td>STT</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Kho</td><td>Số lượng min</td><td>Số lượng hiện tại</td></tr>
	@01
	</table>';
	$vStrTableMax='<table  class="lvtable">
	<tr class="lvhtable"><td>STT</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Kho</td><td>Số lượng max</td><td>Số lượng hiện tại</td></tr>
	@01
	</table>';
	}	
	$vCount=0;
	$slq="select A.*,(select sum(lv004) from wh_lv0012 BB where BB.lv002=A.lv001 and BB.lv003=A.lv016) Banlance from all_gmacv3_0.sl_lv0007 A";
	$str_min="";
	$str_max="";
	$alarmmax=false;
	$alarmmin=false;
	$str_td="<tr class='@#00'><td>@#01</td><td>@#02</td><td>@#03</td><td>@#04</td><td  align='right'><strong>@#05</strong></td><td align='right'><strong>@#06</strong></td></tr>";
	$vResult=db_query($slq);
	while($vrow=db_fetch_array($vResult))
	{
		$vCount++;
		$tmpstr_td=str_replace("@#01",$vCount,$str_td);
		$tmpstr_td=str_replace("@#02",$vrow['lv001'],$tmpstr_td);
		$tmpstr_td=str_replace("@#03",$vrow['lv002'],$tmpstr_td);
		$tmpstr_td=str_replace("@#04",$vrow['lv016'],$tmpstr_td);

		$tmpstr_td=str_replace("@#06",$mowh_lv0010->FormatView($vrow['Banlance'],10),$tmpstr_td);
		if($vrow['lv018']>0)
		{
			if($vrow['lv018']>$vrow['Banlance'])
			{
				$alarmmin=true;
				$tmpstr_td=str_replace("@#05",$mowh_lv0010->FormatView($vrow['lv018'],10),$tmpstr_td);
				$str_min=$str_min.$tmpstr_td;
			}
		}
		if($vrow['lv019']>0)
		{
			if($vrow['lv019']<$vrow['Banlance'])
			{
				$alarmmax=true;
				$tmpstr_td=str_replace("@#05",$mowh_lv0010->FormatView($vrow['lv019'],10),$tmpstr_td);
				$str_max=$str_max.$tmpstr_td;
			}
		}
		
					
				
	}
?>
<div><hr></div>
<div id="alert_contact_30">
	<div id="alert_contact_header" style="padding:4px"><strong>
	<?php 
		   if($plang=="EN")
			{	
			 echo 'LIST MIN-MAX BALANCE ALARM ('.$vCount.")";
			}
		   else
		   {
		   	 echo 'DANH SÁCH CÁC SẢN PHẨM DƯỚI VÀ TRÊN ĐỊNH MỨC('.$vCount.")";
		   }	
		   ?>
	</strong>
	</div>
	<div>
	<?php
		
		if($alarmmin) echo str_replace("@01",$str_min,$vStrTableMin)."<br/>";
		if($alarmmax)  echo str_replace("@01",$str_max,$vStrTableMax);
	?>
	</div>
</div>
<?php 
}
*/
?>
<script language="javascript">

		function SendCheckApr(codeid,vTitle)
		{
			var o=document.getElementById('calendarview_'+codeid);
			o.style.display="block";
		}
		function closepopcalendar(codeid)
		{
			var o=document.getElementById('calendarview_'+codeid);
			o.style.display="none";
		}
		function openWD(codeid,vTitle)
		{
			var myWindow = window.open("","MsgWindow"+codeid, "toolbar=yes, scrollbars=yes, resizable=yes, width=auto, height=auto");
			var strcss='<link rel="stylesheet" href="../css/<?php echo $themes;?>.css" type="text/css">';
			var o=document.getElementById('calendarview_'+codeid);
			
			myWindow.document.write(strcss);
			myWindow.document.write('<div class="lv0" align="center">'+vTitle+'</div>');
			myWindow.document.write(o.innerHTML);
		}
</script>
<style>
.home_title
{
	font-weight:bold;
	padding:10px;
	padding-left:20px;
	background:url(pointer.png) no-repeat;
	list-style:none;
}		
		table.ftable
{
	background-color:#fff;
	width:100%;
	text-align:left;
	margin:0 auto;
}
table.ftable tr
{

}
table.f_table tr:nth-child(even) 
{
	background-color:#f0f0f0;
}
table.ftable tr td
{
	padding:8px 15px 8px 15px;
}
table.sftable tr td
{
	padding:2px 10px 2px 10px;
}
table.f_table tr td
{
	padding:6px 15px 6px 15px;
}
table.ftable tr td.grey
{
	background-color:#f0f0f0;
}
.ftable table
{
	width:100%;
}
td.editor table tr td
{
	padding:0px !important;
}
td.titlerow,tr.titlerow
{
	background-color:#fff !important;
	border-bottom:1px #e5e5e5 solid;
}
#tab_notice li:hover
{
	color:#0485be !important;
}
#sof_pages  .sof_pages_content
{
	background:#fff;
	text-align:left;
	padding:10px;
	padding-left:0px;
	padding-right:0px;
}
</style>
</div>
</div>
</div>