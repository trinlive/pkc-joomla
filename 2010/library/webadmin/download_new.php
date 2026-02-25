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
<script language="javascript">
function checkForm(){
		with(this.form1){
			if(topic.value==""){
				alert(' Please Fill TOPIC :');
				topic.focus();
				return false;
			}
			if(sdetail.value==""){
				alert('Please Fill DESCRIPTION :');
				sdetail.focus();
				return false;
			}
			if(filerem.value==""){
				alert('Please Fill FILE TOPIC  :');
				filerem.focus();
				return false;
			}
			if(fileatt.value==""){
				alert('Please Fill FILE ATTACHMENT  :');
				fileatt.focus();
				return false;
			}
		}
		return true;
	}
</script>
<link href="css/st.css" rel="stylesheet" type="text/css">
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
                <td align="right" class="arialVIO24B">PRESS CENTER</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_download.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Add Press Center</span></td>
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
            <td><form action="download_action.php" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return checkForm();">
              <table width="99%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="162" valign="top" class="arialVIO11B">TOPIC : </td>
                  <td valign="top" class="text_black_bold"><input name="topic" type="text" class="border_bg_violet" id="topic" style="width:70%"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">DESCRIPTION : </td>
                  <td valign="top" class="text_black_bold"><textarea name="sdetail" style="width:70%" rows="5" class="border_bg_violet" id="sdetail"></textarea></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td valign="top" class="arialVIO11B">FILE ATTACHMENT : </td>
                  <td valign="top" class="arialBL11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                    <tr>
                      <td width="70%"><input name="fileatt" type="file" class="border_bg_violet" id="fileatt" style="width=100%" /></td>
                      <td width="20" class="arialGREY11nor">&nbsp;</td>
                      <td width="50">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>(pdf,doc,xls,ppt,zip,rar,rtf)  2 MB size limitation </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">DATE : </td>
                  <td valign="top" class="text_black_bold"><?=list_day("ndate","ndate",date("d"),"class='border_bg_violet' ","")?>
                      <?=list_month("nmonth","nmonth",date("m"),"class='border_bg_violet' ","","en")?>
                      <?=list_year("nyear","nyear",date("Y"),"class='border_bg_violet' ","","en")?>
                  </td>
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
                  <td valign="top" class="text_black_bold"><select name="download_status" class="border_bg_violet" id="download_status">
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
                  <td colspan="2" align="right" valign="top" class="text_black_bold">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="right" valign="top" class="text_black_bold">
                      <input type="hidden" name="MM_action" value="create">
					  <input type=image src="images/but_save.gif" name="image"  align="middle" >
                      </td>
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