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
$gettmp[email_id] = $_GET[email_id];
 $stmt = $db->Prepare('SELECT * FROM subscribes WHERE subscribes.email_id =? ');
 $rs = $db->Execute($stmt,array($gettmp[email_id])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['last_date']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function getIp(){
	
$ip_address=$_SERVER['HTTP_X_FORWARDED_FOR']; 
	
if ($ip_address==NULL){
$ip_address=$_SERVER[REMOTE_ADDR]; }
return $ip;
}

</script>
<script language="JavaScript" type="text/JavaScript">
function checkForm(){
		with(this.form1){
			if(email.value==""){
				alert('Please Fill E-Mail:');
				email.focus();
				return false;
			}
		}
		return true;
	}

</script>
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<script  type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>
<link type="text/css" rel="stylesheet" href="js/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<!-- ST Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- ST Editor -->
</head>
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
                <td align="right" class="arialVIO24B">MAILINGLIST</td>
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit User</span></td>
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
            <td><form action="mail_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return checkForm();">
                <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="162" valign="top" class="arialVIO11B">E-MAIL  : </td>
                    <td>
					<input name="email" type="text" class="border_bg_violet" id="subject" style="width:70%" value="<?php echo stripslashes($rs->fields['email'])?>" />					</td>
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
                    <td valign="top" class="arialVIO11B">STATUS : </td>
                    <td valign="top" class="text_black_bold"><select name="status" class="border_bg_violet" id="status">
                        <option value="Active" <?php if ($rs->fields['status'] == 'Active') echo 'selected="selected"'  ?> >Active</option>
                        <option value="Inactive" <?php if ($rs->fields['status'] == 'Inactive') echo 'selected="selected"'  ?>>Inactive</option>
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
                        <input type="image" src="images/but_update.gif" name="image"  align="middle">
                        <input type="hidden" name="email_id" id="email_id"  value="<?php echo $rs->fields['email_id']?>"/>
                        <input type="hidden" name="MM_action" value="update" />
                    </p></td>
                  </tr>
                </table>
              <p align="right">&nbsp;</p>
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
</table
></body>
</html>