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
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<script  type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>
<link type="text/css" rel="stylesheet" href="js/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<!-- ST Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- ST Editor -->
<script language="JavaScript" type="text/JavaScript">
function checkForm(){
tinyMCE.triggerSave();
		with(this.multiform){
			if (subject.value=='') {
				alert('Please fill Subject :');
				subject.focus();
				return false;
			}
			if (detail.value=='') {
				alert('Please fill Detail :');
				return false;
			}
		}
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
          <td width="270"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right" class="arialVIO24B">MAILING LIST</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_mail.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Add Newsletter</span></td>
            <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="50">&nbsp;</td>
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
            <td><form action="letter_action.php" method="POST" enctype="multipart/form-data" name="multiform" onSubmit="return checkForm();" style="margin:0;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td width="162" valign="top" class="arialVIO11B">SUBJECT  : </td>
                <td><input name="subject" type="text" class="border_bg_violet" id="subject" size="86"></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B">DETAIL  :<br>
                    <textarea name="detail" cols="93" rows="20" class="border_bg_gray" id="detail" style="width: 99%"></textarea></td>
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
                <td valign="top" class="arialVIO11B">DATE :</td>
                <td valign="top" class="text_black_bold">
<?php echo list_day("postday","postday",date("d"),'class="border_bg_violet"',"")?> 
<?php echo list_month("postmonth","postmonth",date("m"),'class="border_bg_violet"',"","en")?> 
<?php echo list_year("postyear","postyear",date("Y"),'class="border_bg_violet"',"","en")?></td>
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
                <td valign="top" class="text_black_bold"><select name="news_active" class="border_bg_violet" id="news_active">
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
                <td valign="top" class="text_black_bold">&nbsp;</td>
                <td valign="top" class="text_black_bold">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="right" valign="top" class="text_black_bold"><p align="right">
                  <input type=image src="images/but_save.gif" name="image"  align="middle" >
				  <input type="hidden" name="MM_action" value="create"></p></td>
              </tr>
            </table>
            </form></td>
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