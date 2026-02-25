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
 
 $SQLstr = "SELECT * FROM faqs ORDER BY faq_id DESC ";
 $db->SetFetchMode(ADODB_FETCH_ASSOC);
 $rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
 $recordsFound = $rs->_maxRecordCount;
 $GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
 $GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
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
                <td align="right" class="arialVIO24B">F.A.Q.</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_faq.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Add Answer </span></td>
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
                              <td bgcolor="#1bb3b3">QUESTION</td>
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
                  <?php  while (!$rs->EOF): 
				   	$SQLstrcount = "SELECT * FROM faq_ans WHERE faq_id='".$rs->fields['faq_id']."' ";
 					$rscount = $db->Execute($SQLstrcount);
					$numrows=$rscount->RecordCount(); 
					 if ($numrows == 1) :
					 	$gettmp[popupmsg]="href='faq_answer_edit.php?qid=".$rs->fields['faq_id']."&page=".$page."' onclick='return confirm(\"คำถามนี้มีคำตอบแล้ว คุณต้องการแก้ไขคำตอบ ?\");' ";
					 else :
					 	$gettmp[popupmsg]="href='faq_answer_new.php?qid=".$rs->fields['faq_id']."&page=".$page."' ";
					 endif ;
					 
					 if($rs->fields['status_new'] != "N"){
						$gettmp[imgnew]="<img src='images/new.gif' border='0'>";
					}else{
						$gettmp[imgnew]=" ";
					}
				  ?>
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
                              <td width="60" align="center" class="text_gray_normal"><?php echo $rs->fields['faq_id'] ?></td>
                              <td class="text_gray_normal"><a <?=$gettmp[popupmsg]?> class="text_violet_normal"><?php echo cuttext(250,$rs->fields['question']) ?></a>&nbsp;&nbsp;<?php echo $gettmp[imgnew]?></td>
                              <td width="80" align="center" class="arialGREY11nor"><?php if ($rs->fields['faq_active'] == 'Active'):
				echo '<b><font color="#0000FF">SHOW</font></b>';
				else:
				echo '<b><font color="#0000FF">HIDE</font></b>';
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
<?php mysql_close(); ?>