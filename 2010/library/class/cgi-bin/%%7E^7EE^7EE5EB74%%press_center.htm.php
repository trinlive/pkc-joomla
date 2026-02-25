<?php /* Smarty version 2.6.18, created on 2010-09-26 23:28:02
         compiled from press_center.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'filesize_format', 'press_center.htm', 409, false),array('modifier', 'nl2br', 'press_center.htm', 435, false),)), $this); ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บริการเครื่องซักผ้าและตู้น้ำหยอดเหรียญ</title>
<script type="text/javascript" src="js/jquery-latest.pack.js"></script> 
<script type="text/javascript" src="js/jquery.pngFix.js"></script> 
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


<link href="css/sakulthiti.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" href="css/droppy.css" type="text/css" />
<script type='text/javascript' src='js/jquery.droppy.js'></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.fancybox.css" />
<script language="JavaScript" type="text/javascript" src="js/jquery.fancybox-1.2.1.js"></script>


<script type='text/javascript'>
(function($){ 
 $(function() {
    $('#nav').droppy();
  });
    $(function() {
		$('#gallery a').lightBox();	   
        $('#gallery2 a').lightBox();
		$('#orgchart').lightBox();
    });

	
	$(document).ready(function() {

	$('div.accordionButton').click(function() {
		$('div.accordionContent').slideUp('slow');	
		$(this).next().slideDown('normal');
	});

//	$("div.accordionContent").hide();

});
// displays hint text on any input element with the 'title' attribute set
$(document).ready(function() {
wireUpDisplayTextboxes();
wireUpDisplayTextArea();
});

function wireUpDisplayTextboxes() {
var el = $('input[Title]');

// show the display text
el.each(function(i) {
    $(this).attr('value', $(this).attr('title'));
});

// hook up the blur & focus
el.focus(function() {
    if ($(this).attr('value') == $(this).attr('title'))
        $(this).attr('value', '');
}).blur(function() {
    if ($(this).attr('value') == '')
        $(this).attr('value', $(this).attr('title'));
});
}

function wireUpDisplayTextArea() {
var el = $('textarea[Title]');

// show the display text
el.each(function(i) {
    $(this).attr('value', $(this).attr('title'));
});

// hook up the blur & focus
el.focus(function() {
    if ($(this).attr('value') == $(this).attr('title'))
        $(this).attr('value', '');
}).blur(function() {
    if ($(this).attr('value') == '')
        $(this).attr('value', $(this).attr('title'));
});
}


})(jQuery); 
</script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body onload="MM_preloadImages('images/menutop2_over.gif','images/menutop3_over.gif','images/menutop4_over.gif','images/menutop5_over.gif','images/menutop6_over.gif','images/menutop7_over.gif','images/menutop1_over.gif')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="990" valign="top"><?php include("inc_menu_top_presscenter.php");?>
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
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','267','height','306','src','flash/pro01','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/pro01' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="267" height="306">
                <param name="movie" value="flash/pro01.swf" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
                <embed src="flash/pro01.swf" width="267" height="306" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
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
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','317','height','99','src','flash/toppic_presscenter','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/toppic_presscenter' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="317" height="99">
                    <param name="movie" value="flash/toppic_presscenter.swf" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                    <embed src="flash/toppic_presscenter.swf" width="317" height="99" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
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
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','282','height','53','src','flash/topic_presscenter2','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/topic_presscenter2' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="282" height="53">
                      <param name="movie" value="flash/topic_presscenter2.swf" />
                      <param name="quality" value="high" />
                      <param name="wmode" value="transparent" />
                      <embed src="flash/topic_presscenter2.swf" width="282" height="53" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                    </object>
</noscript></td>
                    <td width="24">&nbsp;</td>
                  </tr>
                </table>              
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
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
                <td width="230"><!--<table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="4" style="background:url(images/border_vertical.gif) top repeat-y"></td>
              <td height="235" valign="top"  class="bg_MGC">
<div id="wrapper">
<div class="accordionButton"><img src="images/menu_left/menu_brand01.gif" width="226" height="23" border="0" /></div>
<div id= "thisactive" class="accordionContent">
<table width="220" border="0" align="center" cellpadding="1" cellspacing="0" >
                            <tr>
                              <td width="55"><a href="product_beverage.php" class="border_brand"><img src="images/menu_left/b1.gif" width="47" height="46" border="0" title="OISHI Green Tea" /></a></td>
                                <td width="55"><a href="product_blacktea.php" class="border_brand"><img src="images/menu_left/b4.gif" width="47" height="46" border="0" title="OISHI Black Tea" /></a></td>
                                <td width="55"><a href="product_beverage_amino.php" class="border_brand"><img src="images/menu_left/b2.gif" width="47" height="46" border="0" title="Amino Plus" /></a></td>
                                <td><a href="product_coffio.php" class="border_brand"><img src="images/menu_left/b5.gif" width="47" height="46" border="0" title="Coffio" /></a></td>
                  </tr>
                            <tr>
                              <td height="5"></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><a href="product_matcha_mineral.php" class="border_brand"><img src="images/menu_left/b32.gif" width="47" height="46" border="0" title="OISHI Matcha Mineral Water" /></a></td>
                              <td><a href="product_matcha_milktea.php" class="border_brand"><img src="images/menu_left/b33.gif" width="47" height="46" border="0" title="OISHI Matcha Milktea" /></a></td>
                            </tr>
                </table>
</div>
                           <table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineMenuLeft">
                <tr>
                  <td height="9"></td>
                </tr>
                <tr>
                  <td align="center"><img src="images/menu_left/menu_brand_line.gif" width="226" height="2" /></td>
                </tr>
              </table>   
<div class="accordionButton"><img src="images/menu_left/menu_brand02.gif" width="226" height="23" border="0" /></div>
<div  id= "thisactive2" class="accordionContent">
  <table width="220" border="0" align="center" cellpadding="1" cellspacing="0" >
    <tr>
      <td width="55"><a href="product_curry.php" class="border_brand"><img src="images/menu_left/b30.gif" width="47" height="46" border="0" title="OISHI Curry &amp; Soup" /></a></td>
      <td width="55"><a href="product_sandwich.php" class="border_brand"><img src="images/menu_left/b31.gif" width="47" height="46" border="0" title="Break & Fast Sandwich" /></a></td>
      <td width="55"><a href="product_kani.php" class="border_brand"><img src="images/menu_left/b29.gif" width="47" height="46" border="0" title="OISHI Kani" /></a></td>
      <td><a href="product_gyoza.php" class="border_brand"><img src="images/menu_left/b26.gif" width="47" height="46" border="0" title="OISHI Gyoza" /></a></td>
    </tr>
  </table>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineMenuLeft">
                <tr>
                  <td height="9"></td>
                </tr>
                <tr>
                  <td align="center"><img src="images/menu_left/menu_brand_line.gif" width="226" height="2" /></td>
                </tr>
              </table>

<div class="accordionButton"><img src="images/menu_left/menu_brand03.gif" width="226" height="23" border="0" class="imgPNG"/></div>                            
 <div  id= "thisactive3" class="accordionContent">
                    <table width="220" border="0" align="center" cellpadding="1" cellspacing="0" >
                      <tr>
                        <td width="55"><a href="product_grand.php" class="border_brand"><img src="images/menu_left/b6.gif" width="47" height="46" border="0" title="OISHI Grand" /></a></td>
                        <td width="55"><a href="product_express.php" class="border_brand"><img src="images/menu_left/b22.gif" width="47" height="46" border="0" title=" OISHI Express" /></a></td>
                        <td width="55"><a href="product_buffet.php" class="border_brand"><img src="images/menu_left/b27.gif" width="47" height="46" border="0" title="OISHI Buffet" /></a></td>
                        <td><a href="product_shabushi.php" class="border_brand"><img src="images/menu_left/b9.gif" width="47" height="46" border="0" title="Shabushi" /></a></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><a href="product_oksuki.php" class="border_brand"><img src="images/menu_left/b16.gif" width="47" height="46" border="0" title="OK Suki &amp; BBQ" /></a></td>
                        <td><a href="product_ramen.php" class="border_brand"><img src="images/menu_left/b20.gif" width="47" height="46" border="0" title="OISHI Ramen"/></a></td>
                        <td><a href="product_sushibar.php" class="border_brand"><img src="images/menu_left/b14.gif" width="47" height="46" border="0" title="OISHI Sushi bar" /></a></td>
                        <td><a href="product_loghome.php" class="border_brand"><img src="images/menu_left/b12.gif" width="47" height="46" border="0" title="Loghome" /></a></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><a href="product_chaitalay.php" class="border_brand"><img src="images/menu_left/b23.gif" width="47" height="46" border="0" title="Chaytalay" /></a></td>
                        <td><a href="product_thetepp.php" class="border_brand"><img src="images/menu_left/b28.gif" width="47" height="46" border="0" title="The Tepp" /></a></td>
                        <td><a href="product_in_out.php" class="border_brand"><img src="images/menu_left/b11.gif" width="47" height="46" border="0" title="IN &amp; OUT" /></a></td>
                        <td><a href="product_maido.php" class="border_brand"><img src="images/menu_left/b15.gif" width="47" height="46" border="0" title="Maido Ookini" /></a></td>
                      </tr>
                      <tr>
                        <td height="5"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>					  
					  <tr>
					    <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><a href="product_kazokutei.php" class="border_brand"><img src="images/menu_left/b35.gif" width="47" height="46" border="0" title="Kazokutei" /></a></td>
					  </tr>
                </table>
              </div>
              
              <table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineMenuLeft">
                <tr>
                  <td height="9"></td>
                </tr>
                <tr>
                  <td align="center"><img src="images/menu_left/menu_brand_line.gif" width="226" height="2" /></td>
                </tr>
              </table>
			  <div class="accordionButton"><img src="images/menu_left/menu_brand04.gif" border="0" /></div>
<div  id= "thisactive4"  class="accordionContent" >

  <table width="220" border="0" align="center" cellpadding="1" cellspacing="0" >
    <tr>
      <td width="55">&nbsp;</td>
      <td width="55">&nbsp;</td>
      <td width="55"><a href="product_delivery.php" class="border_brand"><img src="images/menu_left/b25.gif" width="47" height="46" border="0" title="OISHI Delivery" /></a></td>
      <td><a href="product_catering.php" class="border_brand"><img src="images/menu_left/b24.gif" width="47" height="46" border="0" title="OISHI Catering" /></a></td>
    </tr>
  </table>
</div>
			  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineMenuLeft">
                <tr>
                  <td height="9"></td>
                </tr>
                <tr>
                  <td align="center"><img src="images/menu_left/menu_brand_line.gif" width="226" height="2" /></td>
                </tr>
              </table>
			  <div class="accordionButton"><img src="images/menu_left/menu_brand04.gif" border="0" /></div>
<div  id= "thisactive5"  class="accordionContent" >
  <table width="220" border="0" align="center" cellpadding="1" cellspacing="0" >
    <tr>
      <td width="55">&nbsp;</td>
      <td width="55">&nbsp;</td>
      <td width="55"><a href="product_delivery.php" class="border_brand"><img src="images/menu_left/b25.gif" width="47" height="46" border="0" title="OISHI Delivery" /></a></td>
      <td><a href="product_catering.php" class="border_brand"><img src="images/menu_left/b24.gif" width="47" height="46" border="0" title="OISHI Catering" /></a></td>
    </tr>
  </table>
</div>
                     <table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineMenuLeft">
                <tr>
                  <td height="9"></td>
                </tr>
                <tr>
                  <td align="center"><img src="images/menu_left/menu_brand_line.gif" width="226" height="2" /></td>
                </tr>
              </table>
                            
</div>

</td>
              <td width="4" style="background:url(images/border_vertical.gif) top repeat-y"></td>
              <td width="2"></td>
            </tr>
          </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="14" style="background:url(images/gallery_vdo_bottom.gif) top no-repeat"></td>
                      </tr>
                </table> --></td>
              </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="57" valign="top">&nbsp;</td>
              <td width="633" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                  <td width="18" height="16"><img src="images/border_top_left.gif" alt="" width="18" height="16" /></td>
                  <td height="16" background="images/border_top.gif">&nbsp;</td>
                  <td width="18" height="16"><img src="images/border_top_right.gif" alt="" width="18" height="16" /></td>
                </tr>
                <tr>
                  <td valign="top" background="images/border_left.gif">&nbsp;</td>
                  <td height="200" valign="top"><table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="top">
              <td width="10"></td>
              <td><?php $_from = $this->_tpl_vars['rec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['actlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['actlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['RS']):
        $this->_foreach['actlist']['iteration']++;
?><?php if (($this->_foreach['actlist']['iteration'] <= 1)): ?><table width="100%" border="0" cellpadding="0" cellspacing="0" id="TableFirst">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr valign="top">
                          <td width="40"><img src="images/i<?php echo $this->_tpl_vars['RS']['filemarkup']; ?>
.gif" width="16" height="16" style="margin-left:5px" /></td>
                          <td><a href="presscenter_forcedownload.php?fileatt=<?php echo $this->_tpl_vars['RS']['fileatt']; ?>
" class="Textpress-center" ><?php echo $this->_tpl_vars['RS']['topic']; ?>
</a></td>
                          <td width="60" class="txtOrange11b01"></td>
                          <td width="1" align="center" class="TxtBlue11N05">|</td>
                          <td width="60" align="right" class="TxtSky11B01"><span style="margin-right:8px"><?php echo ((is_array($_tmp=$this->_tpl_vars['RS']['filesizes'])) ? $this->_run_mod_handler('filesize_format', true, $_tmp) : smarty_modifier_filesize_format($_tmp)); ?>
</span></td>
                        </tr>
                      </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="9"></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  
                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="1" valign="top" bgcolor="#63cdcd"><img src="images/spacer.gif" /></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="10">&nbsp;</td>
                          </tr>
                        </table>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="40">&nbsp;</td>
                            <td class="TxtGray11N02"><?php echo ((is_array($_tmp=$this->_tpl_vars['RS']['sdetail'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
                          </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="40"></td>
                          <td height="27"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="1" class="TextGray12N02" style="border-bottom: dashed 1px #95C4DB"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td height="8"></td>
                        </tr>
                    </table></td>
                  </tr>
                </table>
                  <?php else: ?><table width="100%" border="0" cellpadding="0" cellspacing="0" id="TableLoopFile">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr valign="top">
                            <td width="40"><img src="images/i<?php echo $this->_tpl_vars['RS']['filemarkup']; ?>
.gif" width="16" height="16" style="margin-left:5px" /></td>
                            <td><a href="presscenter_forcedownload.php?fileatt=<?php echo $this->_tpl_vars['RS']['fileatt']; ?>
" class="Textpress-center" ><?php echo $this->_tpl_vars['RS']['topic']; ?>
</a></td>
                            <td width="50" class="txtOrange11b01"></td>
                            <td width="1" align="center" class="TxtGreen11N04">|</td>
                            <td width="60" align="right" class="TxtGray11B05"><span style="margin-right:8px"><?php echo ((is_array($_tmp=$this->_tpl_vars['RS']['filesizes'])) ? $this->_run_mod_handler('filesize_format', true, $_tmp) : smarty_modifier_filesize_format($_tmp)); ?>
</span></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="40">&nbsp;</td>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="8"></td>
                            </tr>
                            <tr>
                              <td height="1" class="TextGray12N02" style="border-bottom: dashed 1px #95C4DB"></td>
                            </tr>
                            <tr>
                              <td height="8"></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table>
                      </td>
                    </tr>
                  </table><?php endif; ?><?php endforeach; endif; unset($_from); ?>
                </td>
            </tr>
          </table>
                 
                     
         
                    <table width="100%" height="64" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td valign="top" background="images/border_right.gif">&nbsp;</td>
                </tr>
                <tr valign="bottom">
                  <td width="18" height="16"><img src="images/border_bottom_left.gif" alt="" width="18" height="16" /></td>
                  <td background="images/border_bottom.gif">&nbsp;</td>
                  <td width="18" height="16"><img src="images/border_bottom_right.gif" alt="" width="18" height="16" /></td>
                </tr>
              </table>
                <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
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