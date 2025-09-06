<?php
session_start();
//require_once("../../clsall/ml_lv0012.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/ml_lv0012.php");
//////////////init object////////////////
$lvml_lv0012=new ml_lv0012($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Ml0012');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","ML0025.txt",$plang);

$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
//$lvml_lv0012->lv001=InsertWithCheckExt('ml_lv0012', 'lv001', '',0);
$lvml_lv0012->lv002=$_SESSION['ERPSOFV2RUserID'];
$lvml_lv0012->lv003=$_POST['txtlv003'];
$lvml_lv0012->lv004=$_POST['txtlv004'];
$lvml_lv0012->lv005=$_POST['txtlv005'];
$lvml_lv0012->lv006=$_POST['txtlv006'];
$lvml_lv0012->lv007=$_POST['txtlv007'];

$data = array();
  
  function add_person( $lv001,$lv002,$lv003, $lv004, $lv005,$lv006,$lv007)
  {
  global $data;
  
  $data []= array(
  'lv001' => $lv001,
  'lv002' => $lv002,
  'lv003' => $lv003,
  'lv004' => $lv004,
  'lv005' => $lv005,
  'lv006' => $lv006,
  'lv007' => $lv007,
  );
  }
  function read_text_file($in_filename) {
		$file = fopen($in_filename, 'r') or exit("khong tim thay file can mo");
		
		$output = array();
		
		while (!feof($file)) {
			$buf = fgets($file);
			$output[] = $buf;
		}
		
		fclose($file);
		
		return $output;
	}  
if($vFlag==1)
{
		
		$vresult=$lvml_lv0012->LV_InsertAuto();
		if($vresult==true) {
			$vStrMessage=$vLangArr[9];
			$vFlag = 1;	
		} else{
			$vStrMessage=$vLangArr[10].sof_error();		
			$vFlag = 0;
		}
}
else if($vFlag==2)
{
	
	$lvNow=GetServerDate()." ".GetServerTime();
			 if ( $_FILES['file']['tmp_name'] )
  			{
	  				if($userfile_type=="xml")
	  				{
							  $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
							  $rows = $dom->getElementsByTagName( 'Row' );
							  $first_row = true;
							  foreach ($rows as $row)
							  {
								  if ( !$first_row )
								  {
									  $first = "";
									  $middle = "";
									  $last = "";
									  $email = "";
									  
									  $index = 1;
									  $cells = $row->getElementsByTagName( 'Cell' );
									  $lvml_lv0012->lv002=$_SESSION['ERPSOFV2RUserID'];
									  foreach( $cells as $cell )
									  { 
									  $ind = $cell->getAttribute( 'Index' );
									  if ( $ind != null ) $index = $ind;
									  
						  			  if ( $index == 1 ) $lvml_lv0012->lv003 = $cell->nodeValue;
									  if ( $index == 2 ) $lvml_lv0012->lv004 = $cell->nodeValue;
									  if ( $index == 3 ) $lvml_lv0012->lv005 = $cell->nodeValue;
									  if ( $index == 4 ) $lvml_lv0012->lv006 = $cell->nodeValue;
									  if ( $index == 5 ) $lvml_lv0012->lv007 = $cell->nodeValue;
									  
									  $index += 1;
								  }
								  if($lvml_lv0012->LV_CheckEmailValid_Exist($_SESSION['ERPSOFV2RUserID'],$lvml_lv0012->lv003 ))
									{
							  		$vresult=$lvml_lv0012->LV_InsertAuto();
									}
							  }
							  $first_row = false;
							  }
				  	}
				  	else
				  	{
				  		$data = read_text_file($_FILES['file']['tmp_name']);
						$numbreak=0;
						$lvml_lv0012->lv002=$_SESSION['ERPSOFV2RUserID'];
						$lvml_lv0012->lv004='';
						$lvml_lv0012->lv005='';
						$lvml_lv0012->lv006=1;
						foreach ($data as $string) {				
							$lvml_lv0012->lv003 = $string;
							$lvml_lv0012->lv007=$_POST['txtgroup']+$numbreak;
							$numbreak++;
							if($lvml_lv0012->LV_CheckEmailValid_Exist($_SESSION['ERPSOFV2RUserID'],$string))
							{
								$lvml_lv0012->lv001=$row['lv001'];
								$vresult=$lvml_lv0012->LV_InsertAuto();
							}
						}

				  	}
	  			}
			
				foreach( $data as $row )
				{
					$lvml_lv0012->LV_LoadID($row['lv001']);
					if($lvml_lv0012->lv001==NULL)
					{
					$lvml_lv0012->lv001=$row['lv001'];
					$lvml_lv0012->lv002=$row['lv002'];
					$lvml_lv0012->lv003=$row['lv003'];
					$lvml_lv0012->lv004=$row['lv004'];
					$lvml_lv0012->lv005=$row['lv005'];
					$lvml_lv0012->lv006=$row['lv006'];
					$lvml_lv0012->lv007=$row['lv007'];
					$vresult=$lvml_lv0012->LV_Insert();
					}
				}
					if($vresult==true) {
						$vStrMessage=$vLangArr[9];
						$vFlag = 1;
					} else{
						$vStrMessage=$vLangArr[10].sof_error();		
						$vFlag = 0;
					}
  		
}
else if($vFlag==3)
{
	global $fns,$numbreak	;
	$fns=array();
	// Hàm đọc nội dung của file	
	//Hàm lấy danh sách tên file
	function get_filenames($dir){
	    $files = array();
	    $directory = opendir($dir);
	    while($item = readdir($directory)){
	         if( ($item != ".") && ($item != "..") && !preg_match('/\.(html|php)$/i', $item) ){
	              $files[] = $item;
	        }
	    }
	    return $files;
	}
	function get_dirlist($dir)
	{
		global $fns;
		
		$directory = opendir($dir);
	    while($item = readdir($directory)){
	    	if($item!="." && $item!="..")
	    	{
		    	if(is_dir($dir."/".$item))	
		    	{	$numbreak++;
		    		get_dirlist($dir."/".$item);
		    	}  
		    	else  
		    		$fns[]=$dir."/".$item;	
	    	}
	    }
	    return ;
	}
	$dir = '../../mailmarketing';
	
	get_dirlist($dir);
		foreach ($fns as $fn)
		{
			
			$data = read_text_file($fn);
			$numbreak=0;
			$lvml_lv0012->lv002=$_SESSION['ERPSOFV2RUserID'];
			$lvml_lv0012->lv004='';
			$lvml_lv0012->lv005='';
			$lvml_lv0012->lv006=1;
			foreach ($data as $string) {				
				$lvml_lv0012->lv003 = $string;
				$lvml_lv0012->lv007=$_POST['txtgroup']+$numbreak;
				$numbreak++;
				if($lvml_lv0012->LV_CheckEmailValid_Exist($_SESSION['ERPSOFV2RUserID'],$string))
				{
					$lvml_lv0012->lv001=$row['lv001'];
					$vresult=$lvml_lv0012->LV_InsertAuto();
				}
			}
		}

		/*
		foreach( $data as $row )
				{
					$lvml_lv0012->LV_LoadID($row['lv001']);
					if($lvml_lv0012->lv001==NULL)
					{
					$lvml_lv0012->lv001=$row['lv001'];
					$lvml_lv0012->lv002=$row['lv002'];
					$lvml_lv0012->lv003=$row['lv003'];
					$lvml_lv0012->lv004=$row['lv004'];
					$lvml_lv0012->lv005=$row['lv005'];
					$lvml_lv0012->lv006=$row['lv006'];
					$lvml_lv0012->lv007=$row['lv007'];
					$vresult=$lvml_lv0012->LV_Insert();
					}
				}
					if($vresult==true) {
						$vStrMessage=$vLangArr[9];
						$vFlag = 1;
					} else{
						$vStrMessage=$vLangArr[10].sof_error();		
						$vFlag = 0;
					}
		*/
}
else if($vFlag==4)
{
	$maxlink=100;
	$linkhref=array();
	$content= file_get_contents($_POST['linkload']);
	$linkhref=get_href_website_link(str_replace("HREF","href",$content),$_POST['linkload']);
	$varr= get_email_from_website($content);
	insert_maillist($varr,$lvml_lv0012);
	get_linkcontent_href($linkhref,0,$lvml_lv0012);
	$vFlag=1;
}
function get_linkcontent_href($linkhref,$opt=0,$lvml_lv0012)
{
	if($opt>1) return;
	foreach($linkhref as $ref)
	{
		$content= file_get_contents($ref);
		$varr= get_email_from_website($content);
		insert_maillist($varr,$lvml_lv0012);
		if($opt==1) return;
		$linkhref1=get_href_website_link(str_replace("HREF","href",$content),$ref);
		get_linkcontent_href($linkhref1,1,$lvml_lv0012);
	}
}
function insert_maillist($varr,$lvml_lv0012)
{
	foreach($varr as $ar)
	{
		$lvml_lv0012->lv002=$_SESSION['ERPSOFV2RUserID'];
		$lvml_lv0012->lv004='';
		$lvml_lv0012->lv005='';
		$lvml_lv0012->lv006=1;				
		$lvml_lv0012->lv003 = $ar;
		if($lvml_lv0012->LV_CheckEmailValid_Exist($_SESSION['ERPSOFV2RUserID'],$ar))
		{
			$lvml_lv0012->lv001=$row['lv001'];
			$vresult=$lvml_lv0012->LV_InsertAuto();
		}
	}		
}
function get_href_website_link($vcontent,$vlinkparent)
{

 	$vtt=0;
 	$ArrWeb=explode('href="', $vcontent);
 	for($i=1;$i<count($ArrWeb);$i++)
 	{
 		$vsubstring=$ArrWeb[$i];
 		$vsubstring1=explode('"',$vsubstring);
 		if($vsubstring1[0]!="")
 		{	
 			if(strpos($vsubstring1[0],"javascript")===false)
 			{
	 			if(strpos($vsubstring1[0],"http")===false)
	 				$vLinkList[$vtt]= $vlinkparent."/".$vsubstring1[0];
	 			else
	 				$vLinkList[$vtt]= $vsubstring1[0];
	 			$vtt++;
 			}
 		}
 	}
 	return $vLinkList;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
<title>ERP SOF</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../../css/<?php echo getInfor($_SESSION['ERPSOFV2RUserID'],99);?>.css" type="text/css">
<link rel="stylesheet" href="../../css/responsive.css" type="text/css">
<link rel="stylesheet" href="../../css/popup.css" type="text/css">
<script language="javascript" src="../../javascript/lvscriptfunc.js"></script>
<script language="javascript" src="../../javascript/engine.js"></script>
</head>
<script language="javascript">
<!--
function isnumber(s){
	if(s!=""){
		var str="0123456789"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){
					alert("<?php echo $vLangArr[21];?>")	
					return false
				}	
			return true
		}	
		return true
}

	function Refresh()
	{
		var o=document.frmadd;
		o.txtlv001.value="";
		o.txtlv002.value="";
		o.txtlv003.value="";
		o.txtlv004.value="";
		o.txtlv005.value="";
		o.txtlv006.value="";
		o.txtlv007.value="";
		o.txtlv003.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		o.action="?func=<?php echo $_GET['func'];?>"+"&ID=<?php echo $_GET['ID']?>"+"&<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,13,0)?>";
		o.submit();
	}
	function Save()
	{
		var o=document.frmadd;
		if(o.txtlv003.value=="" ){
			alert("<?php echo $vLangArr[23];?>");
			o.txtlv003.select();
		}
		else if(!check_email(o.txtlv003.value)){
			alert("<?php echo $vLangArr[24];?>");
			o.txtlv003.select();
		}
		else
			{
				o.txtFlag.value="1";
				o.submit();
			}
		
	}
	function SaveLinkLoad()
	{
		var o=document.frmadd;
		o.txtFlag.value=4;
		o.submit();
	}
	function SaveMul()
	{
		var o=document.frmadd;
		o.txtFlag.value=2;
		o.submit();
	}
	function SaveMulDir()
	{
		var o=document.frmadd;
		o.txtFlag.value=3;
		o.submit();
	}
	function check_email(a)	
	{	
		myexp = /^[0-9a-zA-Z\-\.\_]+@[0-9a-zA-Z\-]+\.[0-9a-zA-Z\-\.]+$/;
		if (a.toString().match(myexp)) return true;
		return false;
	}

-->
</script>
<?php
if($lvml_lv0012->GetAdd()>0)
{
	$loadenter	=$_POST['load-enter'];
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#" method="post" enctype="multipart/form-data"   name="frmadd" id="frmadd" >
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
						 <input name="txtFlag" type="hidden" id="txtFlag"  />
						
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng email
							    </label>
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							      Nạp email từ tập tin
							    </label>
							     <label>
							      <input type="radio" name="load-enter" value="2" id="load-enter_1" <?php echo ($loadenter==2)?'checked':'';?> onClick="changestate(3)">
							      Nạp email từ thư mục
							    </label>
							    <br>
							     <label>
							      <input type="radio" name="load-enter" value="3" id="load-enter_1" <?php echo ($loadenter==3)?'checked':'';?> onClick="changestate(4)">
							      Lấy danh sách email từ liên kết web
							    </label>
							    <br>
						      </p></td>
						  </tr>
                         </table>
				<!---Load File-->      
						<div id="fileload" style="display:none">
                         <table width="100%" border="0" align="center" id="table1">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[31];?></td>
								<td width="178"  height="20px">
									<input type="file" name="file" />			</td>
							</tr>															
							<tr>
							  <td  height="20px" colspan="2"><a href="MAU_SANPHAM_TEMPLATE.zip" title="<?php echo $vLangArr[33];?>"><?php echo $vLangArr[32];?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveMul();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load File-->
<!---Enter New Line-->                      
                      <div id="enterline" style="display:block">                   
						<table width="100%" border="0" align="center" id="table2">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20px">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo $lvml_lv0012->lv001;?>" tabindex="5" maxlength="10" style="width:80%" onKeyPress="return CheckKey(event,7)" readonly="true"/>			</td>
							</tr>
<tr>
							  <td  height="20px"><?php echo $vLangArr[17];?></td>
				  <td  height="20px"><input  name="txtlv003"  id="txtlv003"  tabindex="7" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvml_lv0012->lv003;?>"/></td>
						  </tr>								
							<tr>
							  <td  height="20px"><?php echo $vLangArr[18];?></td>
							  <td  height="20px"><input  name="txtlv004" type="text" id="txtlv004" value="<?php echo $lvml_lv0012->lv004;?>" tabindex="8" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
							</tr>
						  
							<tr>
							  <td  height="20px"><?php echo $vLangArr[19];?></td>
							  <td  height="20px"><input name="txtlv005" type="text" id="txtlv005" style="width:80%" tabindex="9" value="<?php echo $lvml_lv0012->lv005;?>"></td>
						  </tr>
								<tr>
							  <td  height="20px"><?php echo $vLangArr[20];?></td>
							  <td  height="20px"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo (int)$lvml_lv0012->lv006;?>" tabindex="10" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								</tr>																			
							<tr>
							<tr>
							  <td  height="20px"><?php echo $vLangArr[21];?></td>
							  <td  height="20px"><input name="txtlv007" type="text" id="txtlv007" value="<?php echo (int)$lvml_lv0012->lv007;?>" tabindex="11" maxlength="50" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
								</tr>																			
							<tr>
							  <td  height="20px" colspan="2"></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save();" tabindex="16"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
					                         </div>
<!---End Enter New Line-->    
<!---Load Dir-->      
						<div id="dirload" style="display:none">
                         <table width="100%" border="0" align="center" id="table3">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Thư mục con';?></td>
								<td width="178"  height="20px">
									<input type="text" name="moredir" value=""/>			</td>
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Thứ tự nhóm';?></td>
								<td width="178"  height="20px">
									<input type="text" name="txtgroup" value="100"/>			</td>
							</tr>					
																	
							<tr>
							  <td  height="20px" colspan="2"><a href="MAU_SANPHAM_TEMPLATE.zip" title="<?php echo $vLangArr[33];?>"><?php echo $vLangArr[32];?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveMulDir();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load Dir-->
<!---Load Link-->      
						<div id="linkload" style="display:none">
                         <table width="100%" border="0" align="center" id="table3">
							<tr>
								<td colspan="2" height="100%" align="center">
								</font>
								<?php
									echo "<font color='#FF0066' face='Verdana, Arial, Helvetica, sans-serif'>".$vStrMessage."</font>";
								?>			</td>	
							</tr>
							<tr>
								<td width="166"  height="20px"><?php echo 'Nhập link:(http://www.sof.vn))';?></td>
								<td width="178"  height="20px">
									<input type="text" name="linkload" value=""/>			</td>
							</tr>
											
																	
							<tr>
							  <td  height="20px" colspan="2"><a href="MAU_SANPHAM_TEMPLATE.zip" title="<?php echo $vLangArr[33];?>"><?php echo $vLangArr[32];?></a></td>
							</tr>
							<tr>
							  <td  height="20px" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
                                        <TBODY>
                                        <TR vAlign=center align=middle>
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:SaveLinkLoad();" tabindex="16"><img src="../images/controlright/save_f2.png" 
                                            alt="Save" title="<?php echo $vLangArr[1];?>" 
                                            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
                                          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="17"><img src="../images/controlright/move_f2.png" 
                                            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
                                            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
                                          <TD nowrap="nowrap"><a class=lvtoolbar 
                                            href="javascript:Refresh();" tabindex="18"><img title="<?php echo $vLangArr[5];?>" 
                                            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
                                            name=remove> <?php echo $vLangArr[6];?></a></TD>
                                            </TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                      </div>
<!---End Load Dir-->
				  </form>	

				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
				</td></tr></table>
	</h3>
  </div>
</div>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../../javascript/ipopeng.php?lang=<?php echo $_GET['lang'];?>" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<script language="javascript">
function changestate(value)
{
	var o1=document.getElementById('fileload');
	var o2=document.getElementById('enterline');
	var o3=document.getElementById('dirload');
	var o4=document.getElementById('linkload');
	if(value==4)
	{
		o4.style.display="block";
		o2.style.display="none";
		o1.style.display="none";
		o3.style.display="none";
		
	}
	else if(value==2)
	{
		o1.style.display="block";
		o2.style.display="none";
		o3.style.display="none";
		o4.style.display="none";
		
	}
	else if (value==3)
	{
		o1.style.display="none";		
		o2.style.display="none";
		o3.style.display="block";
		o4.style.display="none";
	}
	else
	{
		o1.style.display="none";		
		o2.style.display="block";
		o3.style.display="none";
		o4.style.display="none";
	}
}
changestate(<?php echo (int)$loadenter+1;?>)

	var o=document.frmadd;
		o.txtlv002.focus();
</script>
<script language="javascript" src="../../javascript/menupopup.js"></script>
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
<?php
} else {
	include("../permit.php");
}
?>
</body>
</html>