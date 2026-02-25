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
<?php

 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page);
 
//$news_type = $_GET['news_type'] ;
$nid = $_GET['nid'] ;

$SQLstr = " SELECT `newses`.`subject`,`news_images`.`id`,`newses`.`nid`,`news_images`.`image`, `news_images`.`image_active` FROM `newses`Inner Join `news_images` ON `newses`.`nid` = `news_images`.`nid` AND `newses`.`nid` = `news_images`.`nid` where `newses`.`nid`= '$nid' ";
# $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Image News</span></td>
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
            <td><?php if (!$rs->EOF):?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="2">
                              <tr>
                                <td width="160" class="arialVIO11B">SUBJECT :</td>
                                <td class="text_gray_bold"><span class="arialVIO12B2"><?php echo $rs->fields['subject'] ?></span></td>
                              </tr>
                              
                            </table>
                              <table width="100%" border="0" cellspacing="2" cellpadding="0" bordercolor="#F7F7F7" align="center">
                                <tr bgcolor="#1bb3b3">
                                  <td width="60" height="25" align="center" class="arialWH11B"> ID</td>
                                  <td align="center" class="arialWH11B">IMAGES</td>
                                  <td width="80" align="center" class="arialWH11B">STATUS</td>
                                </tr>
                              </table>
				          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
							    <?php  while (!$rs->EOF): ?>
							  <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" align="center">
                                <tr>
                                  <td colspan="3" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
      <tr>
        <td></td>
      </tr>
    </table></td>
                                </tr>
                                <tr>
                                  <td width="60" height="52" align="center" class="text_gray_normal"><?php echo $rs->fields['id'] ?></td>
                                  <td class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="90"><a href="image_news_edit.php?id=<?php echo $rs->fields['id'] ?>&nid=<?php echo $rs->fields['nid'] ?>"><img src="../img_news/thumbnail/<?php echo $rs->fields['image']?>" border="0"></a></td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table></td>
                                  <td width="80" align="center" class="arialGREY11nor">
								  <?php if ($rs->fields['image_active'] == 'Active'):
				echo '<b><font color="#0000FF">SHOW</font></b>';
				else:
				echo '<b><font color="#FF0000">HIDE</font></b>';
				endif; ?></td>
                                </tr>
                              </table>
<?php $rs->MoveNext(); ?>
<?php endwhile; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
      <tr>
        <td></td>
      </tr>
    </table>
						    </td>
                          </tr>
                        </table>
              <?php else:?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="center" class="text_red_bold">Sorry ! I Can Find Nothing.</td>
                </tr>
              </table>
              <?php endif;?></td>
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