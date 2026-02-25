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
$gettmp[news_id] = $_GET[news_id];
 $stmt = $db->Prepare('SELECT * FROM news_letters WHERE news_letters.news_id =? ');
 $rs = $db->Execute($stmt,array($gettmp[news_id])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['date_news']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<script  type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>
<script language="JavaScript" type="text/JavaScript">
function checkForm(){
		with(this.multiform){
			if(subject.value==""){
				alert('Please Fill Subject:');
				subject.focus();
				return false;
			}
			if(detail.value==""){
				alert('Please Fill Detail:');
				return false;
			}
	
		}
		return true;
	}

</script>
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Newsletter</span></td>
            <td class="text_violet_bold"></td>
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
            <td><form action="letter_action.php" method="POST" enctype="multipart/form-data" name="multiform" onSubmit="return checkForm(); tinyMCE.triggerSave();" style="margin:0;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="arialVIO11B">SUBJECT  : </td>
                <td><input name="subject" type="text" class="border_bg_violet" id="subject" style="width:70%" value="<?php echo stripslashes($rs->fields['subject'])?>"></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td width="162" valign="top" class="arialVIO11B">DETAIL  :</td>
                <td valign="top" class="arialVIO11B"><img src="images/spacer.gif" width="300" height="1"></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><textarea name="detail" cols="93" rows="20" class="border_bg_gray" id="detail" style="width:99%"><?php echo stripslashes($rs->fields['detail'])?></textarea></td>
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
<?php echo list_day("postday","postday",$getday,'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",$getmonth,'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",$getyear,'class="border_bg_violet"',"","en")?></td>
    </tr>
              <tr>
                <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="16"></td>
                  </tr>
                </table></td>
              </tr><tr>
                <td valign="top" class="arialVIO11B">STATUS : </td>
                <td valign="top" class="text_black_bold"><select name="news_active" class="border_bg_violet" id="news_active">
<option value="Active" <?php if ($rs->fields['news_active'] == 'Active') echo 'selected="selected"'  ?> >SHOW</option>
<option value="Inactive" <?php if ($rs->fields['news_active'] == 'Inactive') echo 'selected="selected"'  ?>>HIDE</option>
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
                  <input type="hidden" name="news_id" id="news_id"  value="<?php echo $rs->fields['news_id']?>"/>
                  <input type="hidden" name="MM_action" value="update">
                  <input type=image src="images/but_update.gif" name="image"  align="middle" >
                </p></td>
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