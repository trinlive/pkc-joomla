<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../class/class.GenericEasyPagination.php' ;
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.phpmailer.php';
?>
<?php
 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page);
$gettmp[news_id] = $_GET[news_id];
$SQLstr = 'SELECT * FROM news_letters ORDER BY news_letters.news_id DESC';
 $rs = $db->Execute($stmt,array($gettmp[news_id])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['date_news']);
# $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript">
function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :");
		    return false;
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :");
		    return false;
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :");
		    return false;
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :");
		    return false;
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :");
		    return false;
		 }

 		 return true					
	}
	
function checkForm(){
		with(this.form){
			if(subject.value==""){
				alert('Please Fill Subject:');
				subject.focus();
				return false;
			}
			if ((sender.value=='')) {  
				alert('Please Fill Sender:');
				sender.focus();
				return false;
			}
			if (echeck(sender.value)==false){
				/*   alert("กรุณากรอก อีเมลล์ให้ถูกต้อง :");*/
      				sender.focus();
					 return false;
			}
			
			if(detail.value==""){
				alert('Please Fill Detail:');
				return false;
			}
			if(!Subscribe.checked) {
				alert('Please select RECEIVER at least one :');
				return false;
			}
		}
		return true;
	}
</script>
<link href="css/st.css" rel="stylesheet" type="text/css">
<!-- ST Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- ST Editor -->
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
            <td width="174" height="29"><span class="arialWH18B" style="margin-left:8px;">Send Newsletter</span></td>
            <td width="209" align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="135">&nbsp; &nbsp;</td>
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
            <td><form action="letter_action.php" method="POST" name="form" onSubmit="tinyMCE.triggerSave(); return checkForm();">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="162" class="arialVIO11B">SUBJECT  : </td>
                <td><input name="subject" type="text" class="border_bg_violet" id="subject" style="width:70%" value="<?php echo stripslashes($rs->fields['subject'])?>"></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
		              <tr>
                <td class="arialVIO11B">SENDER : </td>
                <td><input name="sender" type="text" class="border_bg_violet" id="sender" style="width:70%"></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td class="arialVIO11B">DETAIL  :</td>
                <td class="arialVIO11B"><span class="arialVIO11B"><img src="images/spacer.gif" width="300" height="1"></span></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><textarea name="detail" cols="93" rows="20" class="border_bg_gray" id="detail" style="width: 99%"><?php echo stripslashes($rs->fields['detail'])?></textarea></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td class="arialVIO11B">DATE : </td>
                <td valign="top" class="arialVIO11B">
<?php echo list_day("postday","postday",date("d"),'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",date("m"),'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",date("Y"),'class="border_bg_violet"',"","en")?></td>
              </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="16"></td>
                  </tr>
                </table></td>
              </tr>
			  <tr>
                <td class="arialVIO11B" valign="top">RECEIVER : </td>
                <td valign="top" class="arialVIO11">
<input name="Subscribe" type="checkbox" id="Subscribe" value="Subscribe" checked>				
Subscribe&nbsp;<BR>             </tr>
              <tr>
                <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="16"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO11B">&nbsp;</td>
                <td valign="top" class="arialVIO11B">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="right" valign="top" class="arialVIO11B"><p align="right">
				<input type="hidden" name="news_id" value="<?php echo $rs->fields['news_id']?>">
				<input type="hidden" name="MM_action" value="send">
                  <input type=image src="images/but_sendmail.gif" width="130" height="23" name="image"  align="middle" >
                </p>                  </td>
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