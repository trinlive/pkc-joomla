<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ADMIN CONTROL PANEL SAKULTHITI CO.,LTD ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
function showTable(elm){

if (elm == 'News' ){
document.getElementById('image').style.display = 'none';  
document.getElementById('table1').style.display = 'block';  
}
if (elm == 'Event' ){
document.getElementById('image').style.display = 'block';  
document.getElementById('table1').style.display = 'none'; 
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
			if(image.value==""){
				alert('Please Fill INDEX IMAGE :');
				image.focus();
				return false;
			}
			if(image2.value==""){
				alert('Please Fill ALL IMAGE :');
				image2.focus();
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Add Product</span></td>
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
            <td width="8">&nbsp;</td>
            <td><form action="product_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0" onSubmit="return checkForm();">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="arialVIO11B"> PRODUCT NAME  : </td>
                  <td><input name="name_product" type="text" class="border_bg_violet" id="name_product" style="width:70%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td class="arialVIO11B">PRODUCT VERSION  : </td>
                  <td><input name="product_version" type="text" class="border_bg_violet" id="product_version" style="width:70%" /></td>
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
                  <td width="162" valign="top" class="text_black_bold"><span class="arialVIO11B">PRODUCT DETAIL  :</span></td>
                  <td class="text_black_bold"><img src="images/spacer.gif" width="300" height="1"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="arialVIO11B">
                            <textarea name="detail" rows="20" class="border_bg_gray" id="detail" style="width: 99%"></textarea></td>
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
                  <td class="arialVIO11B">PRODUCT PRICE  : </td>
                  <td><input name="product_price" type="text" class="border_bg_violet" id="product_price" style="width:70%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="arialVIO11B">  LIST IMAGE : </td>
                  <td valign="top" class="arialVIO11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
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
                  </table>                    </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
				 <tr>
                  <td class="arialVIO11B">  ALL IMAGE : </td>
                  <td valign="top" class="arialVIO11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                    <tr>
                      <td width="70%"><input name="file3" type="file" class="border_bg_violet" id="file3" style="width:100%" /></td>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialBL11">
                        <tr>
                          <td width="20"></td>
                          <td width="75">Fix (Product)</td>
                          <td>= 186 x 96 pixel</td>
                        </tr>
                      </table>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialBL11">
                          <tr>
                            <td width="20"></td>
                            <td width="75">&nbsp;</td>
                            <td>&nbsp;</td>
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
                <tr>
                  <td class="arialVIO11B">  FLASH : </td>
                  <td valign="top" class="arialVIO11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                    <tr>
                      <td width="70%"><input name="image" type="file" class="border_bg_violet" id="image" style="width:100%" /></td>
                      <td>&nbsp;</td>
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
                <tr>
                  <td valign="top" class="arialVIO11B">STATUS : </td>
                  <td valign="top" class="text_black_bold"><select name="product_active" class="border_bg_violet" id="product_active">
                    <option value="Active">SHOW</option>
                    <option value="Inactive">HIDE</option>
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
                  <td valign="top" class="text_black_bold">DATE :</td>
                  <td valign="top" class="text_black_bold"><?php echo list_day("postday","postday",date("d"),'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",date("m"),'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",date("Y"),'class="border_bg_violet"',"","en")?></td>
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
                  <td colspan="2" align="right" valign="top" class="text_black_bold"><p align="right">
                    <input type="image" src="images/but_save.gif" name="image"  align="middle">
                    <input type="hidden" name="MM_action" value="create" />
                  </p></td>
                </tr>
              </table>
            </form></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="50">&nbsp;</td>
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