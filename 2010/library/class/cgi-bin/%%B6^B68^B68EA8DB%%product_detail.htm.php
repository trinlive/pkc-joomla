<?php /* Smarty version 2.6.18, created on 2010-08-30 13:59:38
         compiled from product_detail.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'product_detail.htm', 213, false),array('modifier', 'date_format', 'product_detail.htm', 219, false),array('modifier', 'filesize_format', 'product_detail.htm', 391, false),)), $this); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บริการเครื่องซักผ้าและตู้น้ำหยอดเหรียญ</title>

<script type="text/javascript" src="js/jquery-latest.pack.js"></script> 
<script type="text/javascript" src="js/jquery.pngFix.js"></script> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript">
 $(document).ready(function(){
   $(".lightbox").lightBox();
 }) </script>
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
</head>

<body onload="MM_preloadImages('images/menutop2_over.gif','images/menutop3_over.gif','images/menutop4_over.gif','images/menutop5_over.gif','images/menutop6_over.gif','images/menutop7_over.gif','images/menutop1_over.gif')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="990" valign="top"><?php include("inc_menu_top_product.php");?>
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
      </td>
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
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','471','height','324','src','flash/toppic_pro','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/toppic_pro' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="471" height="324">
                <param name="movie" value="flash/toppic_pro.swf" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <embed src="flash/toppic_pro.swf" width="471" height="324" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
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
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','317','height','99','src','flash/toppic_product','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/toppic_product' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="317" height="99">
                    <param name="movie" value="flash/toppic_product.swf" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                    <embed src="flash/toppic_product.swf" width="317" height="99" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                  </object>
</noscript></td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="184" valign="top"><table width="100%" height="140" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','282','height','53','src','flash/topic_about2','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/topic_about2' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="282" height="53">
                      <param name="movie" value="flash/topic_about2.swf" />
                      <param name="quality" value="high" />
                      <param name="wmode" value="transparent" />
                      <embed src="flash/topic_about2.swf" width="282" height="53" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                    </object>
</noscript></td>
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
                <td width="230"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="14"></td>
                      </tr>
                </table></td>
              </tr>
          </table></td>
          <td valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="13" height="13"><img src="images/balloon_curve1.gif" width="13" height="13" /></td>
                      <td style="background:url(images/balloon_curve_t.gif) repeat-x top"></td>
                      <td width="13"><img src="images/balloon_curve2.gif" width="13" height="13" /></td>
                    </tr>
                    <tr>
                      <td style="background: url(images/balloon_curve_t2.gif) repeat-y left"></td>
                      <td height="50" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td width="95"><img src="images/i.book.jpg" width="77" height="88" /></td>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="10" valign="top"></td>
                            </tr>
                            <tr>
                              <td height="24" valign="top" class="TextGreen18B01"><span id="TopicCaseStaudy"><?php echo ((is_array($_tmp=$this->_tpl_vars['topic'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['version'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
</span></td>
                            </tr>
                            <tr>
                              <td height="10" valign="top"></td>
                            </tr>
                            <tr>
                              <td valign="top"><strong>ข้อมูลวันที่ :</strong> <span class="TextGreenB01"><?php echo ((is_array($_tmp=$this->_tpl_vars['postdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%y") : smarty_modifier_date_format($_tmp, "%d.%m.%y")); ?>
</span></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                      <td style="background: url(images/balloon_curve_t2.gif) repeat-y right"></td>
                    </tr>
                    
                    <tr>
                      <td width="13" height="13"><img src="images/balloon_curve3.gif" width="13" height="13" /></td>
                      <td style="background:url(images/balloon_curve_t.gif) repeat-x bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="22"></td>
                          <td width="47" valign="bottom"><img src="images/balloon_curve_t4.gif" width="47" height="4" /></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                      <td width="13"><img src="images/balloon_curve4.gif" width="13" height="13" /></td>
                    </tr>
                  </table>
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            
              <td width="57" valign="top"><img src="images/balloon_curve_t3.gif" alt="" width="114" height="45" /><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> <?php if ($this->_tpl_vars['image'] != ""): ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                          <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="300" height="400">
                              <param name="movie" value="img_pro/flash/<?php echo $this->_tpl_vars['image']; ?>
" />
                              <param name="quality" value="high" />
                              <param name="wmode" value="transparent" />
                              <embed src="img_pro/flash/<?php echo $this->_tpl_vars['image']; ?>
" width="300" height="400" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                            </object></td>
                    </tr>
                    <tr>
                      <td height="46">&nbsp;</td>
                    </tr>
                  </table>
				  <?php endif; ?></td>
  </tr>
</table>
</td>
              <td width="633" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                  <td width="18" height="16">&nbsp;</td>
                  <td height="16" >&nbsp;</td>
                  <td width="18" height="16">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="9"></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineNews">
                          <tr valign="top">
                            
                            <td valign="top"></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                    </tr>
                  </table>
                  
				   
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                          <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="46">&nbsp;</td>
                    </tr>
                  </table>
				 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div align="justify"><?php echo ((is_array($_tmp=$this->_tpl_vars['detail'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
 </div></td>
                      <td width="10"></td>
                    </tr>
                  </table>
				  
			<?php if ($this->_tpl_vars['rscount'] > 0): ?>	  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="30"></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="2" valign="top" bgcolor="#7fa8cd"><img src="images/spacer.gif" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" id="TablePicNews">
                    <tr>
                      <td>
				  <?php $_from = $this->_tpl_vars['rec1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['newslist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['newslist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['RS1']):
        $this->_foreach['newslist']['iteration']++;
?>	  
				    <?php if ($this->_foreach['newslist']['iteration']%5 !== 0): ?>
					  <table width="109" border="0" cellpadding="0" cellspacing="0" id="PicNewsLoop1" style="float:left">
                          <tr>
                            <td width="100" align="center" valign="middle"><table width="100%" height="80" border="0" cellpadding="0" cellspacing="0" class="border_Green">
                                <tr>
                                  <td align="center" valign="middle"><a href="img_pro/fullsize/<?php echo $this->_tpl_vars['RS1']['image2']; ?>
"  title="<?php echo ((is_array($_tmp=$this->_tpl_vars['RS1']['caption'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
"   class="lightbox"><img src="img_pro/thumbnail/<?php echo $this->_tpl_vars['RS1']['image1']; ?>
"  border="0" /></a></td>
                                </tr>
                            </table></td>
                            <td>&nbsp;</td>
                            </tr>
                        <tr>
                            <td height="8"></td>
                            <td></td>
                          </tr>
                        </table>
						
					<?php else: ?>	
                          <table width="108" border="0" cellpadding="0" cellspacing="0" id="PicNewsLoop2">
                            <tr>
                              <td width="100" align="center" valign="middle"><table width="100%" height="80" border="0" cellpadding="0" cellspacing="0" class="border_Green">
                                  <tr>
                                    <td align="center" valign="middle"><a href="img_pro/thumbnail/<?php echo $this->_tpl_vars['RS1']['image2']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['RS1']['caption'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
"  class="lightbox"><img src="img_pro/thumbnail/<?php echo $this->_tpl_vars['RS1']['image']; ?>
"  border="0" /></a></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="8"></td>
                            </tr>
                          </table>
						<?php endif; ?>	  
					<?php endforeach; endif; unset($_from); ?>	  
                      </td>
                    </tr>
                  </table>
				  
				  <?php endif; ?>		
				  
				<?php if ($this->_tpl_vars['rscount2'] > 0): ?>	  	    
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="22"> </td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="2" valign="top" bgcolor="#7fa8cd"><img src="images/spacer.gif" /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" id="TableFileNews">
                    <tr>
                      <td>
				  <?php $_from = $this->_tpl_vars['rec2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['newslist2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['newslist2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['RS2']):
        $this->_foreach['newslist2']['iteration']++;
?>	  	  
					  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="TableLoopFileNews">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr valign="top">
                                  <td width="25"><img src="images/i<?php echo ((is_array($_tmp=$this->_tpl_vars['RS2']['filemarkup'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
.gif" width="16" height="16" /></td>
                                  <td><a href="tips_forcedownload.php?fileatt=<?php echo ((is_array($_tmp=$this->_tpl_vars['RS2']['fileatt'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
" class="TextGreen12B01"><?php echo ((is_array($_tmp=$this->_tpl_vars['RS2']['topic'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>
</a></td>
                                  <td width="15" class="txtOrange11b01"></td>
                                  <td width="1" class="TextGreen12N02">|</td>
                                  <td width="48" align="right" class="TextRed12N02"><?php echo ((is_array($_tmp=$this->_tpl_vars['RS2']['filesizes'])) ? $this->_run_mod_handler('filesize_format', true, $_tmp) : smarty_modifier_filesize_format($_tmp)); ?>
</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="8"></td>
                          </tr>
                        </table>
						<?php endforeach; endif; unset($_from); ?>	  
                      </td>
                    </tr>
                  </table>
				  
				   <?php endif; ?>		
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="7"></td>
                    </tr>
                    <tr>
                      <td height="1" background="images/dash01.gif"></td>
                    </tr>
                    <tr>
                      <td height="20"></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="28" valign="bottom"><a href="javascript:history.back()"><img src="images/next_l.gif" width="19" height="13" border="0" /></a></td>
                      <td><a href="javascript:history.back()" class="TextBlue14B01">ย้อนกลับ</a></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="50">&nbsp;</td>
                  </tr>
                </table></td>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr valign="bottom">
                  <td width="18" height="16">&nbsp;</td>
                  <td >&nbsp;</td>
                  <td width="18" height="16">&nbsp;</td>
                </tr>
              </table>
              
                
								</td>
              <td width="56" valign="top">&nbsp;</td>
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