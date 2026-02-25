<?php /* Smarty version 2.6.18, created on 2010-10-13 00:28:58
         compiled from faq_form_post.htm */ ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บริการเครื่องซักผ้าและตู้น้ำหยอดเหรียญ</title>
<script language="javascript" type="text/javascript" src="fdistrict.js" ></script>
<link href="css/sakulthiti_st.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script> 
<script type="text/javascript" src="js/jquery.pngFix.js"></script> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="ajax_captcha/captcha.js"></script>

<script language="javascript" type="text/javascript">
function refreshus(){
$("#captchaimage").load("recaptcha.php"); 
}

function checkForm(){
	with(document.multiform){
			if (contact.value=='') {
				alert('กรุณาเลือก  ฝ่ายที่ต้องการติดต่อ :');
				contact.focus();
				return false;
			}
			if (branch.value=='') {
				alert('กรุณาเลือก  สาขาที่ต้องการติดต่อ :');
				branch.focus();
				return false;
			}
			if (name.value=='') {
				alert('กรุณากรอก  ชื่อ-นามสกุล :');
				name.focus();
				return false;
			}
			if (email.value=='') {
				alert('กรุณากรอก  อีเมลล์แอดเดรส :');
				email.focus();
				return false;
			}
			if(email.value !== ''){
				if (email.value.indexOf ('@',0) == -1 || email.value.indexOf ('.',0) == -1){
     				alert("กรุณาตรวจสอบ  อีเมลล์แอดเดรส :");
      				email.focus();
      				return false;
  		  		}
			}
			if (question.value=='') {
				alert('กรุณากรอก  ข้อความหรือคำถาม  :');
				question.focus();
				return false;
			}
			if (code.value=='') {
				alert('กรุณากรอก  อักษรที่เห็น  :');
				code.focus();
				return false;
			}
			//SetAction('product_suggest_post.php?actions=submit');
		}
	}

</script>

</head>

<body  onload="refreshus();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="990" valign="top"><?php include("inc_menu_top.php");?>
      <table width="100%" height="308" border="0" cellpadding="0" cellspacing="0" style="background:url(images/bg_head.jpg) no-repeat top">
        <tr>
          <td width="31" height="308" valign="top">&nbsp;</td>
          <td width="230" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="200">&nbsp;</td>
  </tr>
  <tr>
    <td height="94" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30">&nbsp;</td>
      </tr>
    </table>
      <img src="images/head_left_faq.gif" width="230" height="82" /></td>
  </tr>
</table></td>
          <td width="390" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
                <td height="45">&nbsp;</td>
              </tr>
              <tr>
                <td width="36">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="25" valign="top"></td>
            </tr>
            <tr>
              <td height="98" valign="top"><table width="341" height="98" border="0" cellpadding="0" cellspacing="0">
                <tr valign="top">
                  <td width="317" align="right">&nbsp;</td>
                  <td width="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="184" valign="top"><table width="100%" height="38" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="17">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="261" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="31">&nbsp;</td>
                <td width="230"><?php include("inc_menu_left_faq.php");?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="14" style="background:url(images/gallery_vdo_bottom.gif) top no-repeat"></td>
                      </tr>
                </table></td>
              </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="56" valign="top">&nbsp;</td>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="position:relative;"><div style="margin-top:-32px; margin-left:410px; position:absolute; z-index:2"><img src="images/faq_topic.gif" width="201" height="42" /></div>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="top">
                                    <td width="18"><img src="images/coner_contact_tl.gif" width="18" height="19" /></td>
                                    <td background="images/coner_contact_top.gif">&nbsp;</td>
                                    <td width="18"><img src="images/coner_contact_tr.gif" width="18" height="19" /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="100%" height="150" border="0" cellpadding="0" cellspacing="0">
                                  <tr valign="top">
                                    <td width="15" style="background:url(images/coner_services2.5.gif) left repeat-y">&nbsp;</td>
                                    <td bgcolor="#def8f8">
						<form action="faq_post.php" method="post" name="multiform" id="multiform" style="margin:0;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="20"></td>
                    </tr>
        
                    <tr>
                      <td align="center" class="TxtGray11B01"><?php echo $this->_tpl_vars['msg']; ?>
</td>
                    </tr>
                    
           
                </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="30"></td>
                      </tr>
                    <tr>
                      <td height="10"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td height="2" bgcolor="#63cdcd"><img src="images/spacer.gif" width="1" height="1" /></td>
                            </tr>
                            <tr>
                              <td height="10">&nbsp;</td>
                            </tr>
                        </table></td>
                      </tr>
                    
                    
                </table></td>
              </tr>
            </table>
          </form></td>
                                    <td width="15" style="background:url(images/coner_services2.6.gif) right repeat-y">&nbsp;</td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr valign="top">
                                    <td width="18"><img src="images/coner_contact_bl.gif" width="18" height="20" /></td>
                                    <td background="images/coner_contact_bottom.gif">&nbsp;</td>
                                    <td width="18"><img src="images/coner_contact_br.gif" width="18" height="20" /></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                     </td>
                    </tr>
                </table></td>
                <td width="26" valign="top">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table></td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<?php include("inc_footer.php");?>	

</body>
</html>