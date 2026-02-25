<?php /* Smarty version 2.6.18, created on 2010-06-10 16:02:29
         compiled from knowlage_car.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'knowlage_car.htm', 103, false),array('modifier', 'stripslashes', 'knowlage_car.htm', 114, false),array('modifier', 'substring', 'knowlage_car.htm', 114, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>บริษัท อาคเนย์แคปปิตอล จำกัด บริการรถเช่าและรถขนส่งขนาดใหญ่ มีบริการต่างๆ เช่น ชิ้นส่วนอะไหล่รถยนต์ รถจักรยานยนต์ และรถทุกชนิด</title>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.2.6.js"></script>
<link href="css/capital_aha.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
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
</head>

<body onload="MM_preloadImages('images/arrow_red.gif')">
<?php include("inc_head_knowlage.php");?>
<table width="100%" height="500" border="0" cellpadding="0" cellspacing="0" id="Content" style="background:url(images/bg_body1.gif) top left no-repeat">
  <tr>
    <td valign="top"><table width="1002" height="500" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr valign="top">
        <td width="226"><?php include("inc_submenu_knowlage_car.php");?></td>
        <td width="6"></td>
        <td><div style="position:relative">
          <div class="topic-page"></div>
        </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td></td>
                <td height="3"></td>
              </tr>
              <tr>
                <td width="3"></td>
                <td><img src="images/line_color45.gif" /></td>
              </tr>
              <tr>
                <td></td>
                <td height="8"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="TxtGray11N01"><a href="index.php" class="Txtsky11N">หน้าแรก</a><span class="Txtsky11N" style="margin:5px">/</span><span class="TxtGreen11N02">รอบรู้เรื่องรถ</span> </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td height="33">&nbsp;</td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/slogan_aboutus.gif" width="388" height="52" /></td>
              </tr>
              <tr>
                <td height="81" valign="top">ในปี 2548 ได้ขยายธุรกิจด้านการบริหารจัดการการใช้รถยนต์สำหรับองค์กร หรือ Operating Lease<br />
                  ภายใต้ชื่อ บริษัท อาคเนย์แคปปิตอล จำกัด เพื่อช่วยลดภาระการบริหาร และค่าใช้จ่ายด้านยานพาหนะ <br />
                  ขององค์การภาคเอกชน ราชการ และรัฐวิสาหกิจ ต่าง ๆ ในรูปแบบของการให้เช่าระยะยาว และการ<br />
                  บริหารจัดการการใช้รถยนต์อย่างครบวงจร</td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top"><?php $_from = $this->_tpl_vars['rec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['newslist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['newslist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['RS']):
        $this->_foreach['newslist']['iteration']++;
?>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="LoopNewsMain">
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="NewsContent">
                            <tr>
                              <td width="176" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" class="border_gray">
                                  <tr>
                                    <td align="center" width="168" height="90" style="background:url(images/bg_defaults.jpg) top center no-repeat"><?php if ($this->_tpl_vars['RS']['image1'] != NULL): ?><a href="knowledge_car_detail.php?/<?php echo $this->_tpl_vars['RS']['tid']; ?>
"><img src="img_tips/thumbnail/<?php echo $this->_tpl_vars['RS']['image1']; ?>
" width="168" height="90" border="0" />
									</a><?php endif; ?></td>
                                  </tr>
                              </table></td>
                              <td width="30">&nbsp;</td>
                              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="7"></td>
                                    <td></td>
                                    <td width="3"></td>
                                  </tr>
                                  <tr>
                                    <td width="11">&nbsp;</td>
                                    <td class="TxtGreen11B01"><?php echo ((is_array($_tmp=$this->_tpl_vars['RS']['date_tips'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%y") : smarty_modifier_date_format($_tmp, "%d-%m-%y")); ?>
</td>
                                    <td class="TxtGreen11B01">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="4"></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td><img src="images/spacer.gif" name="ArrowNews1" id="ArrowNews1" /></td>
                                    <td><a href="knowledge_car_detail.php?/<?php echo $this->_tpl_vars['RS']['tid']; ?>
" class="TxtNews" onmouseover="MM_swapImage('ArrowNews1','','images/arrow_red.gif',1)" onmouseout="MM_swapImgRestore()">
                                      <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['RS']['subject'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)))) ? $this->_run_mod_handler('substring', true, $_tmp, 1, 100) : smarty_modifier_substring($_tmp, 1, 100)); ?>

                                    </a></td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="9"></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td><div align="justify">
                                      <?php echo ((is_array($_tmp=$this->_tpl_vars['RS']['description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : smarty_modifier_stripslashes($_tmp)); ?>

                                    </div></td>
                                    <td>&nbsp;</td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="7"></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="LineNews">
                            <tr valign="top">
                              <td width="193"><img src="images/line_new.jpg" width="193" height="10" /></td>
                              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="1" valign="top" bgcolor="#bfd4e6"><img src="images/spacer.gif" /></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table>
                  <?php endforeach; endif; unset($_from); ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="40">&nbsp;</td>
                            </tr>
                          </table>
                            <?php if ($this->_tpl_vars['totalpage'] > 1): ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><?php if ($this->_tpl_vars['prevpage'] !== NULL): ?>
                                    <a href="news.php?/<?php echo $this->_tpl_vars['prevpage']; ?>
"><img src="images/next_l.gif" width="19" height="13" border="0" align="absmiddle" style="margin-right:15px" /></a>
                                    <?php endif; ?>
                                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['currentpage']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
                                    <a href="news.php?/<?php echo $this->_sections['i']['index']; ?>
" class="TxtGray11N02">
                                      <?php echo $this->_sections['i']['index']; ?>

                                  </a><span style="margin:5px">-</span>
                                    <?php endfor; endif; ?>
                                    <span class="TxtOrange11B01">
                                      <?php echo $this->_tpl_vars['currentpage']; ?>

                                  </span>
                                    <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['start'] = (int)$this->_tpl_vars['currentpage']+1;
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['totalpage']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
if ($this->_sections['j']['start'] < 0)
    $this->_sections['j']['start'] = max($this->_sections['j']['step'] > 0 ? 0 : -1, $this->_sections['j']['loop'] + $this->_sections['j']['start']);
else
    $this->_sections['j']['start'] = min($this->_sections['j']['start'], $this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] : $this->_sections['j']['loop']-1);
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = min(ceil(($this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] - $this->_sections['j']['start'] : $this->_sections['j']['start']+1)/abs($this->_sections['j']['step'])), $this->_sections['j']['max']);
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
                                    <span style="margin:5px">-</span><a href="news.php?/<?php echo $this->_sections['j']['index']; ?>
" class="TxtGray11N02">
                                      <?php echo $this->_sections['j']['index']; ?>

                                      </a>
                                    <?php endfor; endif; ?>
                                    <?php if ($this->_tpl_vars['nextpage'] != NULL): ?>
                                    <a href="news.php?/<?php echo $this->_tpl_vars['nextpage']; ?>
">
									<img src="images/next_r.gif" width="19" height="13" border="0" align="absmiddle" style="margin-left:15px" /></a>
                                    <?php endif; ?>
                                </td>
                              </tr>
                            </table>
                          <?php endif; ?>
                        </td>
                      </tr>
                  </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="50">&nbsp;</td>
                      </tr>
                    </table></td>
              </tr>
          </table></td>
        <td width="207">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include("inc_footer.php");?>
</body>
</html>