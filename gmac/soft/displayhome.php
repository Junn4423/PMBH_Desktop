<div style="width:240px;height:320px" id="sof_quangcao" >
</div>
<script language="javascript">
function sof_quangcao()
	{
		var i=<?php echo rand(1,8);?>;
		sof_quangcao=document.getElementById('sof_quangcao');
		switch(i)
		{
		case 1:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/8/phan-mem-quan-ly-kho.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		case 2:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/16/phan-mem-quan-ly-ke-toan-doanh-nghiep.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		case 3:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/75/phan-mem-quan-ly-quan-cafe.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		case 4:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/23/phan-mem-quan-ly-ban-hang.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		case 5:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/19/phan-mem-kinh-doanh-da-cap.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		case 6:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/1/phan-mem-nhan-su-tien-luong.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		case 7:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/vi/phan-mem/9/phan-mem-quan-ly-khach-san.html" width="240" height="300" scrolling="auto"></iframe>';
			break;
		default:
			sof_quangcao.innerHTML='<br><iframe src="http://sof.vn/" width="240" height="300" scrolling="auto"></iframe>';
		break;
		}
	}
	setTimeout("sof_quangcao()",2000)
</script>