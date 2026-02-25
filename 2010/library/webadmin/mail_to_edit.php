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

$SQLstr = 'SELECT
`subscribes`.`email_id`,
`subscribes`.`email`,
`subscribes`.`ip`,
`subscribes`.`status`,
`subscribes`.`last_date`
FROM
`subscribes`
ORDER BY
`subscribes`.`email_id` DESC ';
# $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<script  type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>
<link type="text/css" rel="stylesheet" href="js/dhtmlgoodies_calendar.css?random=20051112" media="screen">
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
                <td align="right" class="arialVIO24B">MAILING LIST </td>
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
            <td width="172" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit User </span></td>
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
        &nbsp;
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td><table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
              <tr align="center" bgcolor="#1bb3b3" class="arialWH11B">
                <td width="60" height="25">ID</td>
                <td>EMAIL</td>
                <td width="80">STATUS</td>
              </tr>
            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30">&nbsp;</td>
                </tr>
              </table></td>
          </tr>
        </table>
        <?php  while (!$rs->EOF): ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td><table width="99%" border="0" cellspacing="2" cellpadding="0" align="center">
              <tr>
                <td colspan="3" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                    <tr>
                      <td></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td width="60" align="center" valign="top" class="text_gray_normal"><a  href="mail_edit.php?email_id=<?php echo $rs->fields['mail_id'] ?>" class="text_gray_normal"> <?php echo $rs->fields['email_id'] ?> </a></td>
                <td valign="top" class="text_gray_normal"><a  href="mail_edit.php?email_id=<?php echo $rs->fields['email_id'] ?>" class="text_gray_normal"> <?php echo $rs->fields['email'] ?> </a></td>
                <td width="80" align="center" class="text_gray_normal"><?php if ($rs->fields['status'] == 'Active'):
				echo '<b><font color="#0000FF">Active</font></b>';
				else:
				echo '<b><font color="#FF0000">Inactive</font></b>';
endif; ?></td>
              </tr>
            </table></td>
          </tr>
        </table>
        <?php $rs->MoveNext(); ?>
          <?php endwhile; ?>  
        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
            <tr>
              <td></td>
            </tr>
          </table>
          <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
            <tr>
              <td height="16"></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="text_black12_bold">
              <td align="center"><?php echo $GenericEasyPagination->getNavigation_prev(); ?><?php echo $GenericEasyPagination->getCurrentPages(); ?><?php echo $GenericEasyPagination->getNavigation_next(); ?></td>
              <td width="80" align="center"><?php echo $recordsFound ?></td>
            </tr>
          </table>
          <?php else: ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="text_red_bold">
          <tr>
            <td align="center">              Sorry ! I Can Find Nothing.</td>
            </tr>
          </table>
          <?php endif; ?></td>
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