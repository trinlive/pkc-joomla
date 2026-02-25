<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.upload.foto.php'; 
?>
<?php
 $SQLstr = "SELECT faqs.*,  faq_ans.* FROM faqs, faq_ans  WHERE faqs.faq_id = faq_ans.faq_id AND faqs.faq_id='".$_GET[qid]."'";
 $rs = $db->Execute($SQLstr);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
<script language="javascript">
function checkForm(){
tinyMCE.triggerSave();
		with(this.form1){
			if(answer.value==""){
				alert('Please Fill ANSWER:');
				return false;
			}
		}
		return true;
	}
</script>
<!-- AHA! Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/aha_editor.js"></script>
<script src="lib/date-functions.js" type="text/javascript"></script>
<script src="lib/datechooser.js" type="text/javascript"></script>
<!-- AHA! Editor -->
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
                <td align="right" class="arialVIO24B">F.A.Q.</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_faq.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Answer </span></td>
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
            <td><form action="faq_answer_action.php" method="POST"  name="form1" onSubmit="return checkForm();" style="margin:0;">
              <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="147" valign="top" class="arialVIO11B">QUESTION   : </td>
                  <td width="560" valign="top" class="arialVIO12B2"><?php echo $rs->fields['question'];?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">ANSWER   : </td>
                  <td valign="top" class="text_black_bold">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><textarea name="answer" cols="77" rows="20" class="border_bg_gray" id="answer" style="width: 99%"><?php echo $rs->fields['answer'] ; ?></textarea>
                    <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="16"></td>
                        </tr>
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="right">
                            <input name="faq_id" type="hidden" id="faq_id" value="<?php echo $_GET[qid] ;?>">
                            <input name="MM_action" type="hidden" id="MM_action" value="update">
                            <input type="hidden" name="faq_ans_id" value="<?php echo $rs->fields['faq_ans_id'] ; ?>">
                            <input type=image src="images/but_save.gif" name="image"  align="middle"   ></td></tr>
                    </table></td>
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
    <td height="55"><?php include ("inc/inc_footer.php")?></td>
  </tr>
</table>
</body>
</html>
<?php
	unset($getdata);
	mysql_close();
?>