<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.upload.foto.php'; 
 require_once 'class/class.upload2.php'; 
?>
<?php
			 $pid = $_GET['pid'] ; 
			 $SQLstr = "SELECT * FROM promotions WHERE promotions.promotion_id = {$pid} ORDER BY promotion_id DESC ";
			 $rs = $db->Execute($SQLstr);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript">
function checkForm(){
		with(this.form1){
			if(topic.value==""){
				alert(' Please Fill TOPIC :');
				topic.focus();
				return false;
			}
		}
		return true;
	}
</script>
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
                <td align="right" class="arialVIO24B">PROMOTION</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_promotion.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="183" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Promotion</span></td>
            <td width="252" align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="153">&nbsp; &nbsp;</td>
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
            <td><form action="promotion_action.php" method="POST" enctype="multipart/form-data" name="form1">
              <table width="99%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top" class="arialVIO11B">PROMOTION TYPE  : </td>
                  <td valign="top" class="text_black_bold">
                    <select name="promotion_type" class="border_bg_violet" id="promotion_type">
                      <option value="seic"<?php if ($rs->fields['promotion_type'] == "promotion"):?>selected="selected"<?php endif ; ?>>Promotion</option>					
                     
                    </select></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="162" valign="top" class="arialVIO11B">TOPIC  : </td>
                  <td valign="top" class="text_black_bold">
				  <input name="topic" type="text" class="border_bg_violet" id="topic" style="width:70%" value="<?php echo $rs->fields['topic'] ; ?>"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
				<tr>
                  <td width="162" valign="top" class="arialVIO11B">URL : </td>
                  <td valign="top" class="text_black_bold"><input name="url" type="text" class="border_bg_violet" id="url" style="width:70%" value="<?php echo $rs->fields['url'] ; ?>"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
				  <tr>
                      <td valign="top" height="145" class="arialVIO11B">&nbsp;</td>
                      <td valign="top" class="text_violet_normal03">
					  
					  <?php $list=explode(".",$rs->fields['image']); 
					  if($list[count($list)-1] == "jpg"):
					  	if ($rs->fields['image'] != "") :?><img src="../img_promotion/<?php echo $rs->fields['image']?>" border="0" width="200" /><?php endif ; ?>
					 <?php elseif($list[count($list)-1] == "swf"):?>
					 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="211" height="103">
                <param name="movie" value="../img_promotion/<?php echo $rs->fields['image']?>" />
                <param name="quality" value="high" />
                <param name="wmode" value="transparent" />
              </object>
<?php endif;?>
					  </td>
                    </tr>
                    <tr>
                      <td class="arialVIO11B">  IMAGE : </td>
                      <td valign="top" class="text_violet_normal03"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                        <tr>
                          <td width="70%"><input name="image" type="file" class="border_bg_violet" id="image" style="width:100%" /></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                          <tr>
                            <td height="16"></td>
                          </tr>
                      </table></td>
                    </tr>
			                <tr>
                  <td valign="top" class="arialVIO11B">STATUS : </td>
                  <td valign="top" class="text_black_bold"><select name="promotion_status" class="border_bg_violet" id="promotion_status">
                     <option value="Active" <?php if ($rs->fields['promotion_status'] == "Active" ) : ?>selected<?php endif ; ?>>SHOW</option>
                      <option value="Inactive" <?php if ($rs->fields['promotion_status'] == "Inactive" ) : ?>selected<?php endif ; ?>>HIDE</option>
                  </select></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" align="right" valign="top" class="text_black_bold">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="right" valign="top" class="text_black_bold">
                      <input type="hidden" name="promotion_id" value="<?php echo $rs->fields['promotion_id']; ?>">
                      <input type="hidden" name="MM_action" value="update">
					  <input type=image src="images/but_update.gif" name="image"  align="middle" >                      </td>
                </tr>
              </table>
            </form></td>
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