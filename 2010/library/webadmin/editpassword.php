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
<title>:: ADMIN CONTROL PANEL SAKULTHITI CO.,LTD ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
<SCRIPT language=JavaScript>
function checkForm(){
	if(this.form1.old_password.value == ""){
		alert("Please Insert  OLD PASSWORD :");
		this.form1.old_password.focus();
		return (false);
	}
	if(this.form1.new_password.value == ""){
		alert("Please Insert  NEW PASSWORD :");
		this.form1.new_password.focus();
		return (false);
	}
	if(this.form1.new_repassword.value == ""){
		alert("Please Insert  RE- ENTER NEW PASSOWRD :");
		this.form1.new_repassword.focus();
		return (false);
	}
	if(this.form1.new_password.value != this.form1.new_repassword.value){
		alert("NEW PASSOWRD <> RE- ENTER NEW PASSOWRD :");
		this.form1.new_repassword.focus();
		return (false);
	}
	return true;
}
</SCRIPT>
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
                <td align="right" class="arialVIO24B">ADMIN</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?php include ("inc/inc_menu_panel.php") ?>
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" background="images/line_main.gif">
        <tr>
          <td width="166" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="1"></td>
            </tr>
          </table>
          <?php include ("inc/inc_menu_admin.php") ?></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head05.gif">
                    <tr>
                      <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Admin</span></td>
                      <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
                      <td>&nbsp; &nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="14"></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8">&nbsp;</td>
                      <td valign="top"><table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="14%" valign="top" class="text_black_bold"><form  name="form1" action="updatepassword.php" method="post" onSubmit="return checkForm();" >
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="220" valign="top" class="arialVIO11B">OLD PASSWORD  : &nbsp;</td>
                                  <td valign="top" class="text_black_bold"><span class="text_violet_bold">
                                    <input name="old_password" type="password" class="border_bg_violet" id="old_password" maxlength="20" style="width:70%">
                                  </span></td>
                                </tr>
                                <tr>
                                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                                      <tr>
                                        <td height="16"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td valign="top" class="arialVIO11B">NEW PASSOWRD: &nbsp; </td>
                                  <td valign="top" class="text_black_bold"><span class="text_violet_bold">
                                    <input name="new_password" type="password" class="border_bg_violet" id="new_password" maxlength="20"style="width:70%">
                                  </span></td>
                                </tr>
                                <tr>
                                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                                      <tr>
                                        <td height="16"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td width="207" valign="top" class="arialVIO11B">RE- ENTER NEW PASSOWRD 
                                    : &nbsp;  </td>
                                  <td valign="top" class="text_black_bold"><span class="text_violet_bold">
                                    <input name="new_repassword" type="password" class="border_bg_violet" id="new_repassword" maxlength="20" style="width:70%">
                                  </span></td>
                                </tr>
                                <tr>
                                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                                      <tr>
                                        <td height="16"></td>
                                      </tr>
                                  </table></td>
                                </tr>
                                
                                <tr>
                                  <td colspan="2" valign="top" class="text_black_bold"><br>
                                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td align="right"><input name="image" type=image src="images/but_update.gif"  align="middle" width="143" height="23"  >                                          </td>
                                        </tr>
                                    </table></td>
                                </tr>
                              </table>
                          </form>
                              <span class="text_violet_bold"> </span> </td>
                        </tr>
                      </table></td>
                      <td width="50">&nbsp;</td>
                    </tr>
                </table></td>
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
