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
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
<script language="javascript">
	function chkActiveHot(val){
		this.form1.hot.length=0;
		switch(val){
			case "N":{
				this.form1.hot.options[0]=new Option('+ NO +','N');
			}break;
			case "Y" :{
				this.form1.hot.options[0]=new Option('+ NO +','N');
				this.form1.hot.options[1]=new Option('+ YES +','Y');
			}break;
		}
		return true;
	}
</script>
<script language="javascript">
function checkForm(){
		with(this.form1){
			if(question.value==""){
				alert('Please Fill QUESTION :');
				question.focus();
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Add Question</span></td>
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
            <td><form action="faq_question_action.php" method="POST"  name="form1" onSubmit="return checkForm();" style="margin:0;">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="162" valign="top" class="arialVIO11B">QUESTION   :</td>
                  <td valign="top"><textarea name="question" style="width:70%" rows="7" class="border_bg_violet" id="question"></textarea></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B"> DATE : </td>
                  <td valign="top" class="arialVIO11B">
                    <?php echo list_day("postday","postday",date("d"),'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",date("m"),'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",date("Y"),'class="border_bg_violet"',"","en")?> </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">STATUS : </td>
                  <td valign="top" class="arialVIO11B"><select name="active" class="border_bg_violet02" id="active" style="width:75 px">
                      <option value="Active" selected>SHOW</option>
                      <option value="Inactive">HIDE</option>
                    </select>                  </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="right"><input type="hidden" name="MM_action" value="create">
                            <input type=image src="images/but_save.gif" name="image2"  align="middle"   ></td>
                        </tr>
                    </table></td>
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
    <td height="55"><?php include ("inc/inc_footer.php")?></td>
  </tr>
</table>
</body>
</html>

