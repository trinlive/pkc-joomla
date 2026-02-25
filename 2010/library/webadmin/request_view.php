<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<?php #$db->debug = 1 ;
 $gettmp[request_id] = $_GET[request_id];
 $stmt = $db->Prepare('SELECT * FROM request_informations WHERE request_id =? ');
 $rs = $db->Execute($stmt,array($gettmp[request_id])) ;
?>
<?php
ADOdb_Active_Record::SetDatabaseAdapter($db);
class request_information extends ADOdb_Active_Record{}
$request_information = new request_information();	
$request_information->load("request_id=?", array($gettmp[request_id]));
$request_information->reads_status = "Yes" ;
$request_information->replace();

if ($request_information) { ?>
<script language="JavaScript" type="text/JavaScript">
parent.opener.location.reload();
</script>
<?php }?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
      <table width="620" height="220"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8" valign="top">&nbsp;</td>
        <td colspan="2" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
            <tr>
              <td height="20" bgcolor="1bb3b3" class="arialWH11B">ข้อมูลผู้ขอคำแนะนำ</td>
            </tr>
            <tr>
              <td width="524" height="3"></td>
            </tr>
            <tr>
              <td width="524" height="1" background="images/line04.gif"></td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
          </table>
              <table width="100%" 
            border="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td width="159" valign="top" class="arialVIO11B" >NAME :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php echo $rs->fields['name'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >ADDRESS :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php echo nl2br($rs->fields['address']) ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >TELEPHONE :</td>
                    <td align="left" valign="top" class="text_gray_normal"><?php echo $rs->fields['tel'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >MOBILE :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php echo $rs->fields['mobile'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >E-MAILl :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php echo $rs->fields['email'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >IP ADDRESS  :</td>
                    <td  align="left" valign="top" class="text_gray_normal" ><?php echo $rs->fields['ip'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >POSTDATE :</td>
                    <td  align="left" valign="top" class="text_gray_normal" ><?php echo $rs->fields['request_date'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                </tbody>
              </table>
              <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
                <tr>
                  <td height="20" bgcolor="1bb3b3" class="arialWH11B">ขอคำแนะนำเพิ่มเติม/<span class="TaSky11N">คำถาม</span></td>
                </tr>
                <tr>
                  <td width="524" height="3"></td>
                </tr>
                <tr>
                  <td width="524" height="1" background="images/line04.gif"></td>
                </tr>
                <tr>
                  <td height="10"></td>
                </tr>
              </table>
          <table width="100%" 
            border="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td width="159" valign="top" class="arialVIO11B" >CONTACT TO  :</td>
                    <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text_violet_normal12">
                        <tr>
                          <td class="text_gray_normal"><?php echo $rs->fields['office'] ?></td>
                          <td class="text_gray_normal"><?php echo $rs->fields['office_detail'] ?></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text_violet_normal12">
                        <tr>
                          <td class="text_gray_normal"><?php echo $rs->fields['office2'] ?></td>
                          <td class="text_gray_normal"><?php echo $rs->fields['office_detail2'] ?></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text_violet_normal03">
                        <tr>
                          <td class="text_gray_normal"><?php echo $rs->fields['office3'] ?></td>
                          <td class="text_gray_normal"><?php echo $rs->fields['office_detail3'] ?></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >TOPIC :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php echo $rs->fields['topic'] ?><?php echo $rs->fields['topic_detail'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" > QUESTION :</td>
                    <td align="left" valign="top" class="text_gray_normal" ><?php echo nl2br($rs->fields['question']) ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >POSTDATE :</td>
                    <td  align="left" valign="top" class="text_gray_normal" ><?php echo $rs->fields['request_date'] ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                        <tr>
                          <td height="10"></td>
                        </tr>
                    </table></td>
                  </tr>
                </tbody>
              </table>
</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td height="100" align="right" valign="top"></td>
        <td valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="55" valign="top"><?php include ("inc/inc_footer.php") ?></td>
  </tr>
</table>
</body>
</html>
<?php
	unset($getdata);
	mysql_close();
?>