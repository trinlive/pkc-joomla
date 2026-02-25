<?php /* Smarty version 2.6.18, created on 2010-06-08 17:23:41
         compiled from news_title.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="news_ticker/tickertape.css" rel="stylesheet" type="text/css" />

<script src="news_ticker/XMLHttpRequest-IE.js" language="javascript" type="text/javascript"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                  <td width="18" height="16">&nbsp;</td>
                  <td height="16" background="images/border_top.gif">&nbsp;</td>
                  <td width="18" height="16">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" background="images/border_left.gif">&nbsp;</td>
                  <td height="200" valign="top"><table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                   <?php $_from = $this->_tpl_vars['rec']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['faqlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['faqlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['RS']):
        $this->_foreach['faqlist']['iteration']++;
?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="top">
                        <td width="25">&nbsp;</td>
                        <td><div class="accordion">
                        <h3><?php echo $this->_tpl_vars['RS']['question']; ?>
</h3>
                        </td>
                        <td width="33">&nbsp;</td>
                      </tr>
                    </table>
                    
                    <script type="text/javascript" src="news_ticker/TickerTape.js@v101"></script>
<script type="text/javascript">var ticker = new TickerTape('news_title2.php', 'styledTickerTape', 5000);</script>
                     <?php endforeach; endif; unset($_from); ?>
                   
                    <table width="100%" height="64" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  <td valign="top" background="images/border_right.gif">&nbsp;</td>
                </tr>
                <tr valign="bottom">
                  <td width="18" height="16">&nbsp;</td>
                  <td background="images/border_bottom.gif">&nbsp;</td>
                  <td width="18" height="16">&nbsp;</td>
                </tr>
              </table>
</body>
</html>