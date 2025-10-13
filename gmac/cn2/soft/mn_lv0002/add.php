<?php
session_start();
//require_once("../../clsall/mn_lv0002.php");
require_once("../config.php");
require_once("../configrun.php");
require_once("../function.php");
require_once("../paras.php");
require_once("../excfile.php");
require_once("../../clsall/lv_controler.php");
require_once("../../clsall/mn_lv0002.php");
//////////////init object////////////////
$lvmn_lv0002=new mn_lv0002($_SESSION['ERPSOFV2RRight'],$_SESSION['ERPSOFV2RUserID'],'Mn0002');
$psaveget=getsaveget($plang,$popt,$pitem,$plink,$pgroup,$pitemlst,$pchildlst,$plevel3lst,$pchild3lst);

if($plang=="") $plang="EN";
	$vLangArr=GetLangFile("../../","SL0015.txt",$plang);
$momn_lv0002->lang=strtoupper($plang);
$curPage=(int)$_POST['curPg'];	
$vFlag=(int)$_POST['txtFlag'];
$lvmn_lv0002->lv001=$_POST['txtlv001'];
$lvmn_lv0002->lv002=$_POST['txtlv002'];
$lvmn_lv0002->lv003=$_POST['txtlv003'];
$lvmn_lv0002->lv004=$_POST['txtlv004'];
$lvmn_lv0002->lv005=$_POST['txtlv005'];
$lvmn_lv0002->lv006=$_POST['txtlv006'];
$lvmn_lv0002->lv007=$_POST['txtlv007'];
$lvmn_lv0002->lv008=$_POST['txtlv008'];
$lvmn_lv0002->lv009=$_POST['txtlv009'];
$lvmn_lv0002->lv010=$_POST['txtlv010'];
$lvmn_lv0002->lv011=$_POST['txtlv011'];
$lvmn_lv0002->lv012=$_POST['txtlv012'];
$lvmn_lv0002->lv013=$_POST['txtlv013'];
$lvmn_lv0002->lv014=$_POST['txtlv014'];
$lvmn_lv0002->lv015=$_POST['txtlv015'];

if($vFlag==1)
{
		
		$vresult=$lvmn_lv0002->LV_Insert();
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
		$data = array();
  
  function add_person( $lv001,$lv002,$lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv014,$lv015)
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
  'lv008' => $lv008,
  'lv009' => $lv009,
  'lv010' => $lv010,
  'lv011' => $lv011,
  'lv015' => $lv015,
  );
  }

	 $lvNow=GetServerDate()." ".GetServerTime();
	 if ( $_FILES['file']['tmp_name'] )
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
			  foreach( $cells as $cell )
			  { 
			  $ind = $cell->getAttribute( 'Index' );
			  if ( $ind != null ) $index = $ind;
  			  if ( $index == 1 ) $lv001 = $cell->nodeValue;
			  if ( $index == 2 ) $lv002 = $cell->nodeValue;
			  if ( $index == 3 ) $lv003 = $cell->nodeValue;
			  if ( $index == 4 ) $lv004 = $cell->nodeValue;
			  if ( $index == 5 ) $lv005 = $cell->nodeValue;
			  if ( $index == 6 ) $lv006 = $cell->nodeValue;
			  if ( $index == 7 ) $lv007 = $cell->nodeValue;
			  if ( $index == 8 ) $lv008 = $cell->nodeValue;
			  if ( $index == 9 ) $lv009 = $cell->nodeValue;
			  if ( $index == 10 ) $lv010 = $cell->nodeValue;
			  if ( $index == 11 ) $lv011 = $cell->nodeValue;
			  if ( $index == 12 ) $lv015 = $cell->nodeValue;
			  
			  
			  $index += 1;
		  }
	  	add_person( $lv001, $lv002, $lv003, $lv004, $lv005,$lv006,$lv007,$lv008,$lv009,$lv010,$lv011,$lv015);
	  }
	  $first_row = false;
	  }
  	}
	foreach( $data as $row )
	{
		$lvmn_lv0002->LV_LoadID($row['lv001']);
		if($lvmn_lv0002->lv001==NULL)
		{
		$lvmn_lv0002->lv001=$row['lv001'];
		$lvmn_lv0002->lv002=$row['lv002'];
		$lvmn_lv0002->lv003=$row['lv003'];
		$lvmn_lv0002->lv004=$row['lv004'];
		$lvmn_lv0002->lv005=$row['lv005'];
		$lvmn_lv0002->lv006=$row['lv006'];
		$lvmn_lv0002->lv007=$row['lv007'];
		$lvmn_lv0002->lv008=$row['lv008'];
		$lvmn_lv0002->lv009=$row['lv009'];
		$lvmn_lv0002->lv010=$row['lv010'];
		$lvmn_lv0002->lv011=$row['lv011'];
		$lvmn_lv0002->lv015=$row['lv015'];		
		$vresult=$lvmn_lv0002->LV_Insert();
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
function isphone(s){
	if(s!=""){
		var str="0123456789.()-"
			for(var j=0;j<s.length-1;j++)
				if(str.indexOf(s.charAt(j))==-1){	
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
		o.txtlv008.value="";
		o.txtlv009.value="";
		o.txtlv010.value="";
		o.txtlv001.focus();
	}
	function ThisFocus()//longersoft
	{	
		var o=document.frmadd;	
		o.txtlv001.focus();
	}
	function Cancel()
	{
	var o=window.parent.document.getElementById('frmchoose');
		o.action="?<?php echo getsaveget($plang,$popt,$pitem,$plink,$pgroup,0,0,0,0);?>";
		o.submit();
	}
	function Save(value)
	{
		var o=document.frmadd;
		if(o.txtlv003.value=="")
		{
			alert("<?php echo $vLangArr[30];?>");
			o.txtlv003.select();
		}
		else
			{
				o.txtFlag.value=value;
				o.submit();
			}
		
	}
-->
</script>
<?php
if($lvmn_lv0002->GetAdd()>0)
{
$loadenter	=$_POST['load-enter'];
?>
<body onkeyup="KeyPublicRun(event)"><div id="content_child" ><div class="story"><h2 id="pageName"><?php echo $vLangArr[0];?></h2><h3><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>
				<!--////////////////////////////////////Code add here///////////////////////////////////////////-->
					<form action="#"   name="frmadd" id="frmadd"  method="post" enctype="multipart/form-data">
						<input type="hidden" name="curPg" id="curPg" value="<?php echo  $curPage;?>"/>
                        <input name="txtFlag" type="hidden" id="txtFlag"  />
						<table width="100%" border="0" align="center" id="table">
							<tr>
							  <td colspan="2" height="100%" align="center"><p>
							    <label>
							      <input type="radio" name="load-enter" value="0" id="load-enter_0" <?php echo ($loadenter==0)?'checked':'';?> onClick="changestate(1)">
							      Nhập từng sản phẩm
							    </label>
							    
							    <label>
							      <input type="radio" name="load-enter" value="1" id="load-enter_1" <?php echo ($loadenter==1)?'checked':'';?> onClick="changestate(2)">
							      Nạp sản phẩm từ tập tin
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
                                              <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save(2);" tabindex="16"><img src="../images/controlright/save_f2.png" 
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
								<td width="166"  height="20"><?php echo $vLangArr[15];?></td>
								<td width="178"  height="20">
									<input name="txtlv001" type="text" id="txtlv001"  value="<?php echo ($lvmn_lv0002->lv001=="")?InsertWithCheckExt('mn_lv0002', 'lv001', 'LV',6):$lvmn_lv0002->lv001;?>" tabindex="5" maxlength="32" style="width:80%" onKeyPress="return CheckKey(event,7)"/>			</td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[16];?></td>
							  <td  height="20"><input name="txtlv002" type="text" id="txtlv002"  value="<?php echo $lvmn_lv0002->lv002;?>" tabindex="6" maxlength="225" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[17];?></td>
							  <td  height="20"><select name="txtlv003" id="txtlv003"   tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvmn_lv0002->LV_LinkField('lv003',$lvmn_lv0002->lv003);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav" lang="pop-nav1" onMouseOver="ChangeName(this,1)" onkeyup="ChangeName(this,1)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv003','*@*@*.sl_lv0006','lv002')" onFocus="LoadPopup(this,'txtlv003','*@*@*.sl_lv0006','lv002')" tabindex="200" >
							    <div id="lv_popup" lang="lv_popup1"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[18];?></td>
				  <td  height="20"><select name="txtlv004" id="txtlv004"   tabindex="7"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvmn_lv0002->LV_LinkField('lv004',$lvmn_lv0002->lv004);?>
							  </select>	<br><table><tr><td>
							  <ul id="pop-nav2" lang="pop-nav2" onMouseOver="ChangeName(this,2)" onkeyup="ChangeName(this,2)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch1" id="txtlvsearch1" style="width:200px" onKeyUp="LoadPopup(this,'txtlv004','sl_lv0005','lv002')" onFocus="LoadPopup(this,'txtlv004','sl_lv0005','lv002')" tabindex="200" >
							    <div id="lv_popup2" lang="lv_popup2"> </div>						  
						</li>
					</ul></td></tr></table></td>
						  </tr>							  
							<tr>
							  <td  height="20"><?php echo $vLangArr[19];?></td>
							  <td  height="20"><input name="txtlv005" type="text" id="txtlv005" value="<?php echo $lvmn_lv0002->lv005;?>" tabindex="9" maxlength="100" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
						    </tr>
								<tr>
							  <td  height="20"><?php echo $vLangArr[20];?></td>
							  <td  height="20"><input name="txtlv006" type="text" id="txtlv006" value="<?php echo $lvmn_lv0002->lv006;?>" tabindex="10" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"></td>
							  </tr>	
<tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[21];?></td>
								<td width="178"  height="20"><input name="txtlv007" id="txtlv007"   tabindex="11"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvmn_lv0002->lv007;?>" type="text"/>							 </td>
					      </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[22];?></td>
							  <td  height="20"><select name="txtlv008" id="txtlv008"   tabindex="12"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvmn_lv0002->LV_LinkField('lv008',$lvmn_lv0002->lv008);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav3" lang="pop-nav3" onMouseOver="ChangeName(this,3)" onkeyup="ChangeName(this,3)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch2" id="txtlvsearch2" style="width:200px" onKeyUp="LoadPopup(this,'txtlv008','hr_lv0018','lv002')" onFocus="LoadPopup(this,'txtlv008','hr_lv0018','lv002')" tabindex="200" >
							    <div id="lv_popup3" lang="lv_popup3"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20"><?php echo $vLangArr[23];?></td>
							  <td  height="20"><input type="text" name="txtlv009" id="txtlv009" tabindex="13" style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo $lvmn_lv0002->lv009;?>"></td>
						    </tr>
                          <tr>
							  <td  height="20"><?php echo $vLangArr[24];?></td>
				              <td  height="20"><input  name="txtlv010" type="text" id="txtlv010" value="<?php echo $lvmn_lv0002->lv010;?>" tabindex="14" maxlength="255" style="width:80%" onKeyPress="return CheckKey(event,7)"/></td>
                          </tr>	
						  <tr>
								<td width="166"  height="20" valign="top"><?php echo $vLangArr[25];?></td>
								<td width="178"  height="20"><input name="txtlv011" id="txtlv011"   tabindex="15"  style="width:80%" onKeyPress="return CheckKey(event,7)" value="<?php echo (float)$lvmn_lv0002->lv011;?>" type="text"/>							 </td>	</tr>
								<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[26];?></td>
							  <td  height="20"><select name="txtlv012" id="txtlv012"   tabindex="16"  style="width:80%" onkeypress="return CheckKey(event,7)"/>
							  <?php echo $lvmn_lv0002->LV_LinkField('lv012',$lvmn_lv0002->lv012);?>
							  </select><br>
							  <table><tr><td>
							  <ul id="pop-nav4" lang="pop-nav4" onMouseOver="ChangeName(this,4)" onkeyup="ChangeName(this,4)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch4" id="txtlvsearch4" style="width:200px" onKeyUp="LoadPopup(this,'txtlv012','ac_lv0003','lv002')" onFocus="LoadPopup(this,'txtlv012','ac_lv0003','lv002')" tabindex="200" >
							    <div id="lv_popup4" lang="lv_popup4"> </div>						  
						</li>
					</ul></td></tr></table></td></tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[27];?></td>
							  <td  height="20"><select name="txtlv013" id="txtlv013"   tabindex="17"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvmn_lv0002->LV_LinkField('lv013',$lvmn_lv0002->lv013);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav5" lang="pop-nav5" onMouseOver="ChangeName(this,5)" onkeyup="ChangeName(this,5)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch5" id="txtlvsearch5" style="width:200px" onKeyUp="LoadPopup(this,'txtlv013','ac_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv013','ac_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup5" lang="lv_popup5"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[28];?></td>
							  <td  height="20"><select name="txtlv014" id="txtlv014"   tabindex="18"  style="width:80%" onKeyPress="return CheckKey(event,7)"/>
							  <?php echo $lvmn_lv0002->LV_LinkField('lv014',$lvmn_lv0002->lv014);?>
							  </select><br><table><tr><td>
							  <ul id="pop-nav6" lang="pop-nav6" onMouseOver="ChangeName(this,6)" onkeyup="ChangeName(this,6)"> <li class="menupopT">
							    <input type="text" autocomplete="off" class="search_img_btn" name="txtlvsearch6" id="txtlvsearch6" style="width:200px" onKeyUp="LoadPopup(this,'txtlv014','ac_lv0002','lv002')" onFocus="LoadPopup(this,'txtlv014','ac_lv0002','lv002')" tabindex="200" >
							    <div id="lv_popup6" lang="lv_popup6"> </div>						  
						</li>
					</ul></td></tr></table></td>
						    </tr>		
							<tr>
							  <td  height="20" valign="top"><?php echo $vLangArr[29];?></td>
							  <td  height="20"><select name="txtlv015" id="txtlv015"   tabindex="19"  style="width:80%" onKeyPress="return CheckKey(event,7)">
							  <option value="0" <?php echo ((int)$lvmn_lv0002->lv014==0)?'selected="selected"':''?>>0</option>
							  <option value="1" <?php echo ((int)$lvmn_lv0002->lv014==1)?'selected="selected"':''?>>1</option>
							  </select>
							  </td>
							  </tr>		 			  							  																			
							<tr>
							  <td  height="20" colspan="2"></td>
							</tr>
							<tr>
							  <td  height="20" colspan="2"><TABLE id=lvtoolbar cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR vAlign=center align=middle>
	          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Save(1);" tabindex="47"><img src="../images/controlright/save_f2.png" 
            alt="Save" title="<?php echo $vLangArr[1];?>" 
            name="save" border="0" align="middle" id="save" /> <?php echo $vLangArr[2];?></a></TD>
          <TD nowrap="nowrap"><a class="lvtoolbar" href="javascript:Cancel();" tabindex="48"><img src="../images/controlright/move_f2.png" 
            alt="Cancel" name="cancel" title="<?php echo $vLangArr[3];?>" 
            border="0" align="middle" id="cancel" /><?php echo $vLangArr[4];?></a></TD>
          <TD nowrap="nowrap"><a class=lvtoolbar 
            href="javascript:Refresh();" tabindex="49"><img title="<?php echo $vLangArr[5];?>" 
            alt=Trash src="../images/controlright/reload.gif" align=middle border=0 
            name=remove> <?php echo $vLangArr[6];?></a></TD>
			</TR></TBODY></TABLE> </td>
						  </tr>
					  </table>
                       </div>
<!---End Enter New Line-->                         
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
		if(value==2)
		{
			o1.style.display="block";
			o2.style.display="none";
			
		}
		else
		{
			o1.style.display="none";
			o2.style.display="block";
		}
	}
	changestate(<?php echo (int)$loadenter;?>)
	var o=document.frmadd;
		o.txtlv001.focus();
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
	include("../mn_lv0002/permit.php");
}
?>
</body>
</html>