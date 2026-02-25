<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../class/class.GenericEasyPagination.php' ;
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
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
                <td align="right" class="arialVIO24B">NEWS</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?php include ("inc/inc_menu_panel.php") ?>
        <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
          <tr valign="top">
            <td width="166"><?php include ("inc/inc_menu_news.php") ?></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
                      <tr>
                        <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Delete News </span></td>
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
                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="2" cellpadding="0" bordercolor="#F7F7F7" align="center">
                                  <tr bgcolor="#1bb3b3">
                                    <td width="60" height="25" align="center" class="arialWH11B">NO.</td>
                                    <td align="center" class="arialWH11B">CATEGORY TYPE</td>
                                </tr>
                                  <tr>
                                    <td height="30" align="center" class="text_gray_normal">&nbsp;</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="1" colspan="2" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                    <tr>
                                          <td></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td height="20" align="center" class="text_gray_normal"><a  href="news_to_delete2.php?news_type=news" class="text_gray_normal">1</a></td>
                                    <td class="text_gray_normal">&nbsp;<a  href="news_to_delete2.php?news_type=news" class="text_violet_normal">ข่าวรวม</a></td>
                                  </tr>
                                  <tr>
                                    <td height="1" colspan="2" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                    <tr>
                                          <td></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td height="20" align="center" class="text_gray_normal"><a  href="news_to_delete2.php?news_type=news-cable" class="text_gray_normal">2</a></td>
                                    <td class="text_gray_normal">&nbsp;<a  href="news_to_delete2.php?news_type=news-cable" class="text_violet_normal">ข่าวเคเบิ้ลทีวี</a></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                    <tr>
                                          <td></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                    <tr>
                                    <td height="20" align="center" class="text_gray_normal"><a  href="news_to_delete2.php?news_type=news-security" class="text_gray_normal">3</a></td>
                                    <td class="text_gray_normal">&nbsp;<a  href="news_to_delete2.php?news_type=news-security" class="text_violet_normal">กิจกรรมของ รปภ</a></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                    <tr>
                                          <td></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                    <tr>
                                    <td height="20" align="center" class="text_gray_normal"><a  href="news_to_delete2.php?news_type=news-home" class="text_gray_normal">4</a></td>
                                    <td class="text_gray_normal">&nbsp;<a  href="news_to_delete2.php?news_type=news-home" class="text_violet_normal">ข่าวบ้านเอื้ออาทร</a></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                    <tr>
                                          <td></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                    <tr>
                                    <td height="20" align="center" class="text_gray_normal"><a  href="news_to_delete2.php?news_type=news-awards" class="text_gray_normal">5</a></td>
                                    <td class="text_gray_normal">&nbsp;<a  href="news_to_delete2.php?news_type=news-awards" class="text_violet_normal">ข่าวลงหนังสือพิมพ์</a></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                    <tr>
                                          <td></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
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