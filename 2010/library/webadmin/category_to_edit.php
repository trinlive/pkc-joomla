<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../class/class.GenericEasyPagination.php' ;
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.upload.foto.php'; 
?>
<?php
 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page);
 
 $SQLstr = "SELECT * FROM  categories ORDER BY cate_id DESC ";

 $db->SetFetchMode(ADODB_FETCH_ASSOC);
 $rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
//print_r($rs); die();
 $recordsFound = $rs->_maxRecordCount;
 $GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
 $GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<title>:: ADMIN CONTROL PANEL PAKKRETCITY ::</title>
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
                <td align="right" class="arialVIO24B">category</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_category.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Category</span></td>
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
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                            <tr align="center" bgcolor="#1bb3b3" class="arialWH11B">
                              <td width="60" height="25">ID</td>
                              <td>CATEGORY</td>
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
                        <td><table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                            <tr>
                              <td colspan="3" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                  <tr>
                                    <td></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td width="60" align="center" class="text_gray_normal"><a  href="download_edit.php?press_id=<?php echo $rs->fields['press_id'] ?>" class="text_gray_normal"><?php echo $rs->fields['cate_id'] ?></a></td>
                              <td class="text_gray_normal"><a href="category_edit.php?cate_id=<?php echo $rs->fields['cate_id'] ?>" class="text_violet_normal"><?php echo $rs->fields['cate_name'] ?></a></td>
                              <td width="80" align="center" class="arialGREY11nor"><?php if ($rs->fields['cate_status'] == 'Active'):
				echo '<b><font color="#0000FF">SHOW</font></b>';
				else:
				echo '<b><font color="#FF0000">HIDE</font></b>';
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
                  <td width="80" align="center"><?php echo $recordsFound;?></td>
                </tr>
              </table>
              <?php else: ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="center" class="text_red_bold">Sorry ! I Can Find Nothing.</td>
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