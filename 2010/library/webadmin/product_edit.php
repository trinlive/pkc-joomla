<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 ?>
 <?php 
 if($_GET[actions]=="del"):
	$gettmp[fileatt] = $_GET[fileatt];
		$SQLstr = " SELECT * FROM `products` WHERE `products`.`tid` =  '".$_GET['tid']."' ";
 		$rs = $db->Execute($SQLstr) ;
		$gettmp[fileatt] = $rs->fields['fileatt'];
		
	/*	$postdata[field]=array("fileatt");
		$postdata[value]=array("NULL");
		$getdata[updata]=update_mysql2("product",$postdata,"WHERE nid='".$gettmp[nid]."'")	; */
	#$db->debug=1;
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class product extends ADOdb_Active_Record{}
			$product = new product();
			$product->load("tid=?", array($_GET[tid]));
			$product->fileatt = '' ;
			$product->replace();
		//echo $gettmp[fileatt] ;//exit() ;
		if(file_exists("../img_pro/file/$gettmp[fileatt]")){ unlink("../img_pro/file/$gettmp[fileatt]");	}
	//saverecord('Delete link Category');
echo "<meta http-equiv=\"refresh\" content=\"0; URL=tips_edit.php?tid=$tid\">";
	exit();
	endif; // จบการลบข้อมูล 
?>
<?php
 $gettmp[tid] = $_GET[tid];
 $stmt = $db->Prepare('SELECT * FROM products WHERE products.tid =? ');
 $rs = $db->Execute($stmt,array($gettmp[tid])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['date_product']);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO.,LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
function showTable(elm){
if (elm == 'tips' ){
document.getElementById('image').style.display = 'none';  
}
if (elm == 'Event' ){
document.getElementById('image').style.display = 'block';  
}
}
</script>
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<!-- ST! Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- ST! Editor -->
<script language="javascript">
function checkForm(){
tinyMCE.triggerSave();
		with(this.form1){
			if(subject.value==""){
				alert(' Please Fill SUBJECT :');
				subject.focus();
				return false;
			}
			if(description.value==""){
				alert('Please Fill DESCRIPTION :');
				description.focus();
				return false;
			}
			if(detail.value==""){
				alert('Please Fill DETAIL :');
				return false;
			}
		}
		return true;
	}
</script>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><?php include ("inc/inc_head.php") ?>
      <table width="100%" height="40" border="0" cellpadding="0" cellspacing="0" bgcolor="#1bb3b3">
        <tr>
          <td colspan="3"><table width="100%" height="3" border="0" cellpadding="0" cellspacing="0" bgcolor="#63cdcd">
              <tr>
                <td></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="166">&nbsp;</td>
          <td><?php include ("inc/inc_menu_top.php") ?></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right" class="arialVIO24B">PRODUCT</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_product.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Products </span></td>
            <td width="446" align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="214">&nbsp; &nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td width="8"></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form action="product_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0" onSubmit="return checkForm();">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="156" valign="top" class="arialVIO11B">PRODUCT NAME  : </td>
                      <td width="596"><input style="width:70%" name="name_product" type="text" class="border_bg_violet" id="name_product" value="<?php echo stripslashes($rs->fields['name_product'])?>" /></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr>
					<tr>
                  <td class="arialVIO11B"><p>PRODUCT VERSION  :</p>                    </td>
                  <td><input style="width:70%" name="product_version" type="text" class="border_bg_violet" id="product_version" value="<?php echo stripslashes($rs->fields['product_version'])?>" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                
                 <tr>
                      <td colspan="2" valign="top" class="arialVIO11B">DESCRIPTION  :<br />
                          <textarea name="description_product" rows="15" class="border_bg_gray" id="description_product" style="width:99%"><?php echo stripslashes($rs->fields['description_product'])?></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr>
                 
                    <tr>
                      <td colspan="2" valign="top" class="arialVIO11B">PRODUCT DETAIL  :<br />
                          <textarea name="detail" rows="20" class="border_bg_gray" id="detail" style="width:99%"><?php echo stripslashes($rs->fields['detail'])?></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr><tr>
                  <td class="arialVIO11B"><p>PRODUCT PRICE  :</p>                    </td>
                  <td><input style="width:70%" name="product_price" type="text" class="border_bg_violet" id="product_price" value="<?php echo stripslashes($rs->fields['product_price'])?>" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                    <tr>
                      <td valign="top" class="arialVIO11B">&nbsp;</td>
                      <td valign="top" class="text_violet_normal03"><?php if ($rs->fields['image1'] != "") :?><img src="../img_pro/thumbnail/<?php echo $rs->fields['image1']?>" border="0" /><?php endif ; ?><input name="pimage2" type="hidden" id="pimage2" value="<?php echo $rs->fields['image1']?>"></td>
                    </tr>
                    
                    <tr>
                      <td class="arialVIO11B"> INDEX IMAGE : </td>
                      <td valign="top" class="text_violet_normal03"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                        <tr>
                          <td width="70%"><input name="file2" type="file" class="border_bg_violet" id="file2" style="width:100%" /></td>
                          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialBL11">
                              <tr>
                                <td width="20"></td>
                                <td width="75">Fix</td>
                                <td>= 186 x 96 pixel</td>
                              </tr>
                          </table></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr>
					<tr>
					  <td class="arialVIO11B">&nbsp;</td>
					  <td valign="top" class="arialVIO11"><?php if ($rs->fields['image2'] != "") :?><img src="../img_pro/fullsize/<?php echo $rs->fields['image2']?>" border="0" /><?php endif ; ?><input name="pimage2" type="hidden" id="pimage2" value="<?php echo $rs->fields['image2']?>"></td>
					  </tr>
					<tr>
                  <td class="arialVIO11B">  ALL IMAGE : </td>
                  <td valign="top" class="arialVIO11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                    <tr>
                      <td width="70%"><input name="file3" type="file" class="border_bg_violet" id="file3" style="width:100%" /></td>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialBL11">
                        <tr>
                          <td width="20"></td>
                          <td width="75">Fix (New)</td>
                          <td>= 186 x 96 pixel</td>
                        </tr>
                      </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialBL11">
                          <tr>
                            <td width="20"></td>
                            <td width="75">Fix (Activities)</td>
                            <td>= 217 x 112 pixel</td>
                          </tr>
                        </table></td>
                      </tr>
                  </table>                    </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                <td valign="top" height="145" class="arialVIO11B">&nbsp;</td>
                      <td valign="top" class="text_violet_normal03">
					  
					  <?php $list=explode(".",$rs->fields['image']); 
					  if($list[count($list)-1] == "jpg"):
					  	if ($rs->fields['image'] != "") :?><img src="../img_pro/flash/<?php echo $rs->fields['image']?>" border="0" width="200" /><?php endif ; ?>
					 <?php elseif($list[count($list)-1] == "swf"):?>
					 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="300" height=400">
                <param name="movie" value="../img_pro/flash/<?php echo $rs->fields['image']?>" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
              </object>
<?php endif;?>
					  </td>
                    </tr>
                    <tr>
                      <td class="arialVIO11B">  FLASH : </td>
                      <td valign="top" class="text_violet_normal03"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                        <tr>
                          <td width="70%"><input name="image" type="file" class="border_bg_violet" id="image" style="width:100%" /></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    <tr>
                      <td valign="top" class="arialVIO11B">STATUS : </td>
                      <td valign="top" class="text_black_bold"><select name="product_active" class="border_bg_violet" id="product_active">
                          <option value="Active" <?php if ($rs->fields['product_active'] == 'Active') echo 'selected="selected"'  ?> >SHOW</option>
                          <option value="Inactive" <?php if ($rs->fields['product_active'] == 'Inactive') echo 'selected="selected"'  ?>>HIDE</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td valign="top" class="arialVIO11B">DATE :</td>
                      <td valign="top" class="text_black_bold"><?php echo list_day("postday","postday",$getday,'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",$getmonth,'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",$getyear,'class="border_bg_violet"',"","en")?></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td valign="top" class="text_black_bold">&nbsp;</td>
                      <td valign="top" class="text_black_bold">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="right" valign="top">
                          <input type="image" src="images/but_update.gif" name="image"  align="middle">
                          <input type="hidden" name="tid" id="tid"  value="<?php echo $rs->fields['tid']?>"/>
                           <input type="hidden" name="MM_action" value="update" /></td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="100">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td height="55" valign="top"><?php include ("inc/inc_footer.php") ?></td>
  </tr>
</table>
</body>
</html>