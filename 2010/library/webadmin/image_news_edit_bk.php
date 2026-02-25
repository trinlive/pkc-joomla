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
//$db->debug = 1 ;
$id = $_GET['id'] ;
$nid = $_GET['nid'] ;

$stmt = " SELECT
`news_images`.`id`,
`news_images`.`caption`,
`news_images`.`image1`,
`news_images`.`image2`,
`news_images`.`image_active`,
`newses`.`nid`,
`newses`.`subject` as newsubject
FROM
`newses`
Inner Join `news_images` ON `newses`.`nid` = `news_images`.`nid` where `news_images`.`id` = '$id' ";
$rs = $db->Execute($stmt) ;
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Image News </span></td>
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
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">
                  <form action="image_action.php" method="POST" enctype="multipart/form-data" name="form1" style="margin:0">
                      <table width="99%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="164" class="text_violet_bold03"><span class="arialVIO11B">SUBJECT  :</span></td>
                          <td valign="top" class="arialVIO12B2"><?php echo $rs->fields['newsubject']?></td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                              <tr>
                                <td height="16"></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td valign="top" class="arialVIO11B"> LARGE IMAGE  :</td>
                          <td valign="top" class="arialVIO11"><?php if($rs->fields['image2'] != "") :?><img src="../img_news/fullsize/<?php echo $rs->fields['image2']?>" width="450" height="338" border="0">
                            <input name="pimage2" type="hidden" id="pimage2" value="<?php echo $rs->fields['image2']?>">
                            <br><?php endif ; ?>
                            <input name="image2"  type="file" class="border_bg_violet" id="image2" style="width:70%" />
                            &nbsp;
                            (Dimension :   450 x 338 pixels)</td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                              <tr>
                                <td height="16"></td>
                              </tr>
                          </table></td>
                        </tr>
                        <td valign="top" class="arialVIO11B"> CAPTION  : </td>
              <td class="text_violet_normal03" ><input name="caption" type="text" class="border_bg_violet" id="caption" size="86" value="<?php echo stripslashes($rs->fields['caption'])?>">              </td>
                        </tr>
                        <tr>
                          <td colspan="2" class="text_gray_normal"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                            <tr>
                              <td height="16"></td>
                            </tr>
                          </table></td>
                        <tr>
                          <td valign="top" class="arialVIO11B">STATUS : </td>
                          <td valign="top" class="text_black_bold"><select name="image_active" class="border_bg_violet" id="image_active">
                            <option value="Active"  <?php if($rs->fields['image_active'] == 'Active'){echo 'selected';}?>>SHOW</option>
                            <option value="Inactive" <?php if($rs->fields['image_active'] == 'Inactive'){echo 'selected';}?>>HIDE</option>
                          </select>                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                            <tr>
                              <td height="16"></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top" class="text_black_bold">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2" align="right" valign="top" class="text_black_bold"><input name="MM_action" type="hidden" id="MM_action" value="update">
                            <input name="id" type="hidden" id="id" value="<?php echo $rs->fields['id'] ?>">
                            <input name="nid" type="hidden" id="nid" value="<?php echo $rs->fields['nid'] ?>">
<input type=image src="images/but_update.gif" name="image"  align="middle" ></td>
                        </tr>
                      </table>
                    </form></td>
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
