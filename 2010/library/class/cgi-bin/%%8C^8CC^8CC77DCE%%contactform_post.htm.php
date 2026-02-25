<?php /* Smarty version 2.6.18, created on 2010-09-26 23:20:41
         compiled from contactform_post.htm */ ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บริการเครื่องซักผ้าและตู้น้ำหยอดเหรียญ</title>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script> 
<script type="text/javascript" src="js/jquery.pngFix.js"></script> 
<script type="text/javascript" src="js/crawler.js"></script><script type="text/javascript" src="js/unitpngfix.js"></script> 
<script type="text/JavaScript">
<!--
$(document).ready(function(){ 
        $(document).pngFix(); 
    });
	
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
//-->
</script>
<link href="css/sakulthiti_st.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	/*$(".accordion h3:first").addClass("active");
	$(".accordion p:not(:first)").hide();*/
	$(".accordion span").hide();
	$(".accordion h3").click(function(){
		$(this).next("span").slideToggle("middle")
		.siblings("span:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
		
	
	});

});
</script>

<style type="text/css">
.accordion {
	width: 539px;
}
.accordion h3 {
	background: url(images/bullet_faq.gif) no-repeat 3px -36px;
	padding: 14px 37px;
	margin: 0;
	padding-right:25px;
	font-size:12px;
	font-family: Tahoma, sans-serif, Arial, Verdana;
	font-weight:bold;
	border-bottom: dashed 1px #B4B4B4;
	/*border-bottom: none;*/
	cursor: pointer;
	color:#2A89B8;
}
/*.accordion h3:hover {
	background-color: #e3e2e2;
}*/
.accordion h3.active {
	background-position: 3px 11px;
	border-bottom: dashed 1px #A2BB19;
}
.accordion span {
	margin: 0;
	padding: 14px 40px 0px;
}
</style>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="ajax_captcha/captcha.js"></script>
<script language="javascript" type="text/javascript">
function refreshus(){
$("#captchaimage").load("recaptcha.php"); 
}
function checkForm(){
with(document.multiform){
			if(contact.value==""){
				alert('กรุณาเลือก ฝ่ายที่ต้องการติดต่อ :');
				contact.focus();
				return false;
			}
			if(name.value==""){
				alert('กรุณาระบุ ชื่อ-นามสกุล :');
				name.focus();
				return false;
			}
			if(tel.value==""){
				alert('กรุณาระบุ โทรศัพท์ :');
				tel.focus();
				return false;
			}
			if(email.value==""){
				alert('กรุณาระบุ อีเมลล์แอดเดรส :');
				email.focus();
				return false;
			}
			if (email.value.indexOf ('@',0) == -1 || email.value.indexOf ('.',0) == -1){
				alert("กรุณาตรวจสอบ อีเมลล์แอดเดรส :");
				email.focus();
				return false;
			}
			if(comment.value==""){
				alert('กรุณาระบุ ข้อความและรายละเอียด:');
				comment.focus();
				return false;
			}
			if(code.value==""){
				alert('กรุณาระบุ อักษรที่เห็น:');
				code.focus();
				return false;
			}
		}
		return true;
	}
</script>
</head>

<body onload="MM_preloadImages('images/menutop2_over.gif','images/menutop3_over.gif','images/menutop4_over.gif','images/menutop5_over.gif','images/menutop6_over.gif','images/menutop7_over.gif','images/menutop1_over.gif');refreshus();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="990" valign="top"><?php include("inc_menu_top_contact.php");?>
      <table width="100%" height="200" border="0" cellpadding="0" cellspacing="0" style="background:url(images/bg_head.jpg) no-repeat top">
        <tr>
          <td width="31" height="308" valign="top">&nbsp;</td>
          <td width="230" valign="top">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="200">&nbsp;</td>
  </tr>
  <tr>
    <td height="94" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30">&nbsp;</td>
      </tr>
    </table>
      <!--<img src="images/head_left_faq.gif" width="230" height="82" />--></td>
  </tr>
</table>

		  </td>
          <td width="390" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="36">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="20">&nbsp;</td>
              <td><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','471','height','325','src','flash/toppic_securitypro','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/toppic_securitypro' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="471" height="325">
                <param name="movie" value="flash/toppic_securitypro.swf" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <embed src="flash/toppic_securitypro.swf" width="471" height="325" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
              </object>
</noscript></td>
            </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td height="98" valign="top"><table width="100%" height="99" border="0" cellpadding="0" cellspacing="0">
                <tr valign="top">
                  <td width="317" align="right"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','319','height','99','src','flash/topicpage_contact','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/topicpage_contact' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="319" height="99">
                    <param name="movie" value="flash/topicpage_contact.swf" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                    <embed src="flash/topicpage_contact.swf" width="319" height="99" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                  </object>
</noscript></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="184" valign="top"><table width="100%" height="110" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>                
                <table width="341" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','282','height','53','src','flash/topic_contact2','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/topic_contact2' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="282" height="53">
                      <param name="movie" value="flash/topic_contact2.swf" />
                      <param name="quality" value="high" />
                      <param name="wmode" value="transparent" />
                      <embed src="flash/topic_contact2.swf" width="282" height="53" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                    </object>
</noscript></td>
                    <td width="24">&nbsp;</td>
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
                <td width="230"><!--<?php include("inc_menu_left_aboutus.php");?>-->
                    <!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="14" style="background:url(images/gallery_vdo_bottom.gif) top no-repeat"></td>
                      </tr>
                </table>--></td>
              </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="56" valign="top">&nbsp;</td>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                      <td>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="position:relative;"><div style="margin-top:-32px; margin-left:410px; position:absolute; z-index:2"><img src="images/contact_topic.gif" width="201" height="42" /></div>
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
                              <td><table width="100%" height="300" border="0" cellpadding="0" cellspacing="0">
                                  <tr valign="top">
                                    <td width="15" style="background:url(images/coner_services2.5.gif) left repeat-y">&nbsp;</td>
                                    <td bgcolor="#def8f8">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="3">&nbsp;</td>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td></td>
                    <td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="TxtBlue12B01">&nbsp;</td>
                        </tr>
                      <tr>
                        <td height="5"></td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="95" valign="top" class="TextGray12N02">ที่อยู่ติดต่อ : </td>
                          <td class="TextGray12N02">123 อาคารxxxxxxxxx ตำบลปากเกร็ด ถนนปากเกร็ด <br />
                             นนทบุรี 11120</td>
                        </tr>
                        <tr>
                          <td height="2" class="TextGray12N02"></td>
                          <td class="TextGray12N02"></td>
                        </tr>
                        <tr>
                          <td class="TextGray12N02">โทรศัพท์ : </td>
                          <td class="TextGray12N02">0-2123-4567 </td>
                        </tr>
                        <tr>
                          <td height="2" class="TextGray12N02"></td>
                          <td class="TextGray12N02"></td>
                        </tr>
                        <tr>
                          <td class="TextGray12N02">โทรสาร : </td>
                          <td class="TextGray12N02">0-2123-4567 </td>
                        </tr>
                        <tr>
                          <td height="3" class="TextGray12N02"></td>
                          <td class="TextGray12N02"></td>
                        </tr>
                        <tr>
                          <td class="TextGray12N02">Call Center : </td>
                          <td class="TextGray12N02">1234</td>
                        </tr>
                        <tr>
                          <td height="2" class="TextGray12N02"></td>
                          <td class="TextGray12N02"></td>
                        </tr>
                        <tr>
                          <td class="TextGray12N02">อีเมล์แอดเดรส : </td>
                          <td class="TextGray12N02"><a href="mailto:admin@sakulthiti.co.th" class="TextGray12N02">admin@sakulthiti.co.th</a> <span class="TextGray12N01">,</span> <a href="mailto:rawipong@seic.co.th" class="TextGray12N02">sakulthiti@sakulthiti.co.th </a></td>
                        </tr>
                        <tr>
                          <td height="8"></td>
                          <td></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
                  <table width="100%" height="20" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table> <form action="contactform_post.php" method="post" enctype="multipart/form-data" name="multiform" id="multiform" style="margin:0" onsubmit="return checkForm();">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="Topic">
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="50">&nbsp;</td>
                          </tr>
                        </table>
                          <table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td align="center" class="TxtRed11N01"><?php echo $this->_tpl_vars['msg']; ?>
&nbsp;</td>
                            </tr>
                        </table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="10"></td>
                            </tr>
                            <tr>
                              <td height="2" bgcolor="#bfd4e6"><img src="images/spacer.gif" width="1" height="1" /></td>
                            </tr>
                            <tr>
                              <td height="10">&nbsp;</td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
                </form>
                </td>
            </tr>
          </table>
						</td>
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