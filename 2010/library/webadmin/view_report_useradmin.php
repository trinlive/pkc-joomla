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
 
$SQLstr = "SELECT * FROM chk_logs ORDER BY id DESC";
# $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);					
?>
<html>
<head>
<title>:: ADMIN CONTROL PANEL SAKULTHITI CO.,LTD ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                <td align="right" class="arialVIO24B">ADMIN</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?php include ("inc/inc_menu_panel.php") ?>
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" background="images/line_main.gif">
        <tr>
          <td width="166" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="1"></td>
            </tr>
          </table>
          <?php include ("inc/inc_menu_admin.php") ?></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
                    <tr>
                      <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Admin</span></td>
                      <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
                      <td>&nbsp; &nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="14"></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="8">&nbsp;</td>
                      <td valign="top"><?php if (!$rs->EOF):?>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                          <tr>
                            <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF">
                              <tr bgcolor="#1bb3b3">
                                <td width="60" height="25" align="center" bgcolor="#63cdcd" class="text_gray_normal"><b><font color="#FFFFFF">ID</font></b></td>
                                <td width="250" bgcolor="#63cdcd" class="text_gray_normal"><div align="center"><font color="#FFFFFF"><b> User</b></font></div></td>
                                <td bgcolor="#63cdcd" class="text_gray_normal"><div align="center"><font color="#FFFFFF"><b> Detail</b></font></div></td>
                                <td width="150" bgcolor="#63cdcd" class="text_gray_normal"><div align="center"><font color="#FFFFFF"><b>Date</b></font></div></td>
                                <td width="120" bgcolor="#63cdcd" class="text_gray_normal"><div align="center"><font color="#FFFFFF"><b>IP Address</b></font></div></td>
                              </tr>
                              <tr bgcolor="#1bb3b3">
                                <td height="30" colspan="5" align="center" bgcolor="#FFFFFF" class="text_gray_normal">&nbsp;</td>
                              </tr>
                              <tr bgcolor="#1bb3b3">
                                <td height="1" colspan="5" align="center" bgcolor="#FFFFFF" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#d7ecec">
                                  <tr>
                                    <td></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <?php  while (!$rs->EOF): ?>
                              <tr>
                                <td width="60" align="center" class="text_gray_normal"><?php echo $rs->fields['id'] ?></td>
                                <td width="250" align="center" class="text_violet_normal">&nbsp;&nbsp;
                                    <?php 
$st = " SELECT * FROM admin_infos WHERE `admin_id` =  '".$rs->fields['user_id'] ."' ";
$stms = $db->Execute($st) ;?>
                                    <?php echo $stms->fields['name'] ?>&nbsp;&nbsp;<?php echo $stms->fields['surname'] ?></td>
                                <td class="text_violet_normal"><span style="margin-left:5px;"><?php echo $rs->fields['detail'] ?></td>
                                <td width="150" align="center" class="text_violet_normal"><?php echo date_edit_with_slash($rs->fields['sdate'],1) ; ?> </td>
                                <td width="120" align="center" class="text_violet_normal"><?php echo $rs->fields['ip'];?> </td>
                              </tr>
                              <tr>
                                <td colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#d7ecec">
                                    <tr>
                                      <td></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <?php $rs->MoveNext(); ?>
                              <?php endwhile; ?>
                            </table></td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td height="30" align="center" class="text_gray_normal">&nbsp;</td>
                          </tr>
                        </table>
                        <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="60" align="center" class="text_black12_bold">&nbsp;</td>
                            <td align="center" class="text_black12_bold"><?php echo $GenericEasyPagination->getNavigation_prev(); ?>
							<?php echo $GenericEasyPagination->getCurrentPages(); ?>
							<?php echo $GenericEasyPagination->getNavigation_next(); ?></td>
                            <td width="80" align="center" class="text_black12_bold"><?php echo $recordsFound ?></td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td align="right" class="text_gray_normal">&nbsp;</td>
                          </tr>
                        </table>
                        <?php else : ?>
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="text_red_bold">
                          <tr>
                            <td align="center">Sorry ! I Can Find Nothing.</td>
                          </tr>
                        </table>
                      <?php endif; ?></td>
                      <td width="50">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="50">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="55"><?php include ("inc/inc_footer.php")?></td>
  </tr>
</table>
</body>
</html>
<?php
	unset($getdata);
	unset($getpage);
	mysql_close(); 
?>