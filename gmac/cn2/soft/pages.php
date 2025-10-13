<div id="mobil">
<?php 
require_once("../clsall/lv_controler.php");
require_once("../clsall/sl_lv0013.php");
$plang=$_GET['lang'];
if($plang!="VN" || $plang=="")
$plang="EN";
$vNow=GetServerDate();
?>
	<form name="frmchoose" action="#" method="post" class="wpcf7-form" novalidate="novalidate">
		<div id="dialog" class="web_dialog">
			<div class="modal-content">
				<div class="modal-header">
				   <a href="#" id="btnClose"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><font style="color:black">×</font></button></a>
				    <h4 class="modal-title"><div id="title_view">GÓI</div></h4>
				</div>
				<div class="modal-body" id="dialog_content">
				</div>
			</div>
							
		</div>
			<input type="hidden" name="txtItemId" id="txtItemId" value="">
			<input type="hidden" name="txtFlagView" id="txtFlagView" value="1">
	<?php
	require_once("../clsall/sl_lv0013.php");
	$lvsl_lv0013=new sl_lv0013($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0201');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0013->GetView())
	{
	?>		
		<div class="col" id="GMAC" onclick="RunBanHang()">
			<div class="small-box bg-p1" style="background:#3c8dbc !important">
				<div class="inner">
					<div class="price">BÁN HÀNG</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="GMAC_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_GMAC" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#3c8dbc !important">
					<div class="inner">
						<p id="name-package-GMAC">BÁN HÀNG</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
	<?php
	}
	require_once("../clsall/sl_lv0203.php");
	$lvsl_lv0203=new sl_lv0203($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0203');
	$lvsl_lv0206=new sl_lv0203($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0206');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0203->GetView() || $lvsl_lv0206->GetView())
	{
	?>
		<div class="col" id="BEPBAR" onclick="<?php echo ($_SESSION['ERPSOFV2RRight']!='admin')?(($lvsl_lv0203->GetView())?'RunBep()':'RunBar()'):'RunBepBar()'?>">
			<div class="small-box bg-p1" style="background:#000 !important">
				<div class="inner">
					<div class="price">BẾP/BAR</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="BEPBAR_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_BEPBAR" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#000 !important">
					<div class="inner">
						<p id="name-package-BEPBAR">QUẦY NƯỚC/QUẦY ĂN</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
	<?php
	}
	require_once("../clsall/wh_lv0008.php");
	$lvwh_lv0008=new wh_lv0008($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Wh0102');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvwh_lv0008->GetView())
	{
	?>
		<div class="col" id="KHO"  onclick="RunKho()">
			<div class="small-box bg-p1" style="background:#00c0ef !important">
				<div class="inner">
					<div class="price">KHO</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="KHO_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_KHO" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#00c0ef !important">
					<div class="inner">
						<p id="name-package-KHO">KHO</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
		<?php
	}
	require_once("../clsall/ac_lv0019.php");
	$lvac_lv0019=new ac_lv0019($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ac0275');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvac_lv0019->GetView())
	{
	?>		
		<div class="col" id="THUCHI" onclick="RunThuChi()">
			<div class="small-box bg-p1" style="background:#00a65a !important">
				<div class="inner">
					<div class="price">CHI KHÁC</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="THUCHI_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_GMAC" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#00a65a !important">
					<div class="inner">
						<p id="name-package-GMAC">CHI KHÁC</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
		<?php
	}
	require_once("../clsall/sl_lv0214.php");
	$lvsl_lv0214=new sl_lv0214($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Sl0214');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvsl_lv0214->GetView())
	{
	?>
		<div class="col" id="BAOCAO" onclick="RunBaoCao()">
			<div class="small-box bg-p1" style="background:#f39c12 !important">
				<div class="inner">
					<div class="price">BÁO CÁO</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="BAOCAO_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_BAOCAO" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#f39c12 !important">
					<div class="inner">
						<p id="name-package-BAOCAO">BÁO CÁO</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
		<?php
	}
	require_once("../clsall/hr_lv0020.php");
	$lvhr_lv0020=new hr_lv0020($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0003');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvhr_lv0020->GetView())
	{
	?>
		<div class="col" id="NHANSU" onclick="RunNhanSu()">
			<div class="small-box bg-p1" style="background:#f56954 !important">
				<div class="inner">
					<div class="price">NHÂN SỰ</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="NHANSU_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_NHANSU" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#f56954 !important">
					<div class="inner">
						<p id="name-package-NHANSU">NHÂN SỰ</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
	<?php
	}
	require_once("../clsall/lv_lv0007.php");
	$lvlv_lv0007=new lv_lv0007($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ad0012');
	if($_SESSION['ERPSOFV2RRight']=='admin' || $lvlv_lv0007->GetView())
	{
	?>
		<div class="col" id="QUANTRI" onclick="RunQuanTri()">
			<div class="small-box bg-p1" style="background:#ff5383 !important">
				<div class="inner">
					<div class="price">QUẢN TRỊ</div>
					<p></p>
					<h4> &nbsp;&nbsp;&nbsp;&nbsp;</h4>
				</div>
				<div class="icon"><i class="fa fa-shopping-cart"></i></div><a href="#" class="small-box-footer" id="QUANTRI_INFO">Thông tin thêm <i class="fa fa-arrow-circle-right"></i></a>
			</div>
			<div id="info_QUANTRI" style="display:none">
				<div class="small-box info-box bg-p1" style="background:#ff5383 !important">
					<div class="inner">
						<p id="name-package-QUANTRI">QUẢN TRỊ</p>
					</div>
					<div class="inner noti-update-paymethod">
						<div style="display: block">
							VUI LÒNG QUAY LẠI SAU!
						</div>
					</div>
						
					<div class="icon"><i class="fa fa-shopping-cart"></i></div>
				</div>
			</div>
		</div>
	<?php
	}
	?>	
		<script type="text/javascript">
		function RunBanHang()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjAxL3NsX2x2MDIwMS5waHA=','_self');
		}
		function RunBepBar()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjA2L3NsX2x2MDIwNi5waHA=','_self');
		}
		function RunBar()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjA2L3NsX2x2MDIwNi5waHA=','_self');
		}
		function RunBep()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjAzL3NsX2x2MDIwMy5waHA=','_self');
		}
		function RunKho()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=d2hfbHYwMTAyL3doX2x2MDEwMi5waHA=','_self');
		}
		function RunThuChi()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=YWNfbHYwMjc1L2FjX2x2MDI3NS5waHA=','_self');
		}
		function RunBaoCao()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=c2xfbHYwMjE0L3NsX2x2MDIxNC5waHA=','_self');
		}
		function RunQuanTri()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=bHZfbHYwMDA3L2x2X2x2MDAwNy5waHA=','_self');
		}
		function RunNhanSu()
		{
			window.open('?lang=<?php echo $plang;?>&opt=10&item=&link=aHJfbHYwMDIwL2hyX2x2MDAyMC5waHA=','_self');
		}
		function an_hien(optview)
		{
			document.getElementById('txtItemId').value=optview;
			var overlayHTML=document.getElementById('dialog_content');
			overlayHTML.innerHTML=document.getElementById("info_"+optview).innerHTML;
			document.getElementById('title_view').innerHTML=document.getElementById("name-package-"+optview).innerHTML;
		}
		
        function ShowDialog(modal)
        {
            $("#overlay").show();
            $("#dialog").fadeIn(300);

            if (modal)
            {
                $("#overlay").unbind("click");
            }
            else
            {
                $("#overlay").click(function (e)
                {
                    HideDialog();
                });
            }
        }

        function HideDialog()
        {
            $("#overlay").hide();
            $("#dialog").fadeOut(300);
        } 
        $(document).ready(function ()
        {
			$("#GMAC_INFO").click(function (e)
            {
				an_hien("GMAC");
                ShowDialog(false);
                e.preventDefault();
            });
			$("#BEPBAR_INFO").click(function (e)
            {
				an_hien("BEPBAR");
                ShowDialog(false);
                e.preventDefault();
            });
			$("#KHO_INFO").click(function (e)
            {
				an_hien("KHO");
                ShowDialog(false);
                e.preventDefault();
            });
			
			$("#THUCHI_INFO").click(function (e)
            {
				an_hien("THUCHI");
                ShowDialog(false);
                e.preventDefault();
            });
			
			$("#NHANSU_INFO").click(function (e)
            {
				an_hien("NHANSU");
                ShowDialog(false);
                e.preventDefault();
            });
			
			$("#BAOCAO_INFO").click(function (e)
            {
				an_hien("BAOCAO");
                ShowDialog(false);
                e.preventDefault();
            });
			
			$("#QUANTRI_INFO").click(function (e)
            {
				an_hien("QUANTRI");
                ShowDialog(false);
                e.preventDefault();
            });
			
            $("#btnSubmit").click(function (e)
            {
                var brand = $("#brands input:radio:checked").val();
                $("#output").html("<b>Your favorite mobile brand: </b>" + brand);
                HideDialog();
                e.preventDefault();
            });
		});
		</script>		</form>
</div>