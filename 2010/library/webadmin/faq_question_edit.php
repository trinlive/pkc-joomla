<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.upload.foto.php'; 
?>
<?php
 $SQLstr = "SELECT * FROM faqs WHERE faq_id='".$_GET[qid]."'";
 $rs = $db->Execute($SQLstr);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
<script language="javascript">
	function chkActiveHot(val){
		this.form1.hot.length=0;
		switch(val){
			case "Inactive":{
				this.form1.hot.options[0]=new Option('+ NO +','N');
			}break;
			case "Active" :{
				this.form1.hot.options[0]=new Option('+ NO +','N');
				this.form1.hot.options[1]=new Option('+ YES +','Y');
			}break;
		}
		return true;
	}
</script>
<script language="javascript">
function checkForm(){
		with(this.form1){
			if(question.value==""){
				alert('Please Fill QUESTION (EN):');
				question.focus();
				return false;
			}
		}
		return true;
	}
</script>
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Question</span></td>
            <td width="446" align="right">&nbsp; &nbsp; </td>
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
            <td><form action="faq_question_action.php" method="POST"  name="form1" onSubmit="return checkForm();" style="margin:0;">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <?php if($rs->fields['name']!=NULL){ ?>
                <tr>
                  <td width="162" valign="top" class="arialVIO11B">NAME   :</td>
                  <td valign="top" class="text_black_bold"><?php echo stripslashes($rs->fields['name'])?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <?php } ?>
                <?php if($rs->fields['email']!=NULL){ ?>
                <tr>
                  <td valign="top" class="arialVIO11B">EMAIL   :</td>
                  <td valign="top" class="text_black_bold"><a href="mailto:<?php echo $rs->fields['email']?>" class="text_violet_bold"><?php echo $rs->fields['email']?></a></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <?php } ?>
                <?php if($rs->fields['ip']!=NULL){ ?>
                <tr>
                  <td valign="top" class="arialVIO11B">IP ADDRESS   : </td>
                  <td valign="top" class="text_black_bold"><?php echo $rs->fields['ip'] ?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <?php } ?>
                <?php if($rs->fields['comment']!=NULL){ ?>
                <tr>
                  <td valign="top" class="arialVIO11B">SUBJECT   : </td>
                  <td valign="top" class="text_black_bold"><?php echo $rs->fields['comment'] ?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <?php } ?>
                <tr>
                  <td width="163" valign="top" class="arialVIO11B">QUESTION   : </td>
                  <td valign="top" class="text_black_bold"><textarea name="question" cols="85" rows="7" class="border_bg_violet" id="question"><?php echo $rs->fields['question'] ; ?></textarea></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <?php $gettmp[postdate]=explode("-",$rs->fields['postdate']);?>
                <tr>
                  <td valign="top" class="arialVIO11B"> DATE : &nbsp; <span class="text_violet_bold"> </span></td>
                  <td valign="top" class="text_black_bold"><span class="text_violet_bold"><span class="font_ver11_brown_th">
                    <?=list_day("ndate","ndate",$gettmp[postdate][2],"class='border_bg_violet' ","")?>
                    <?=list_month("nmonth","nmonth",$gettmp[postdate][1],"class='border_bg_violet' ","","en")?>
                    <?=list_year("nyear","nyear",$gettmp[postdate][0],"class='border_bg_violet' ","","en")?>
                  </span> </span></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">ACTIVE : </td>
                  <td valign="top" class="text_black_bold"><select name="active" class="border_bg_violet02" id="active" style="width:75 px">
                      <option value="Active" <?php if($rs->fields['faq_active']=="Active"): echo "selected"; endif;?>>SHOW</option>
                      <option value="Inactive" <?php if($rs->fields['faq_active']=="Inactive"): echo "selected"; endif;?>>HIDE </option>
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
                  <td colspan="2" valign="top" class="text_black_bold"><br>
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="right"><input name="MM_action" type="hidden" id="MM_action" value="update">
              <input type="hidden" name="faq_id" value="<?php echo $rs->fields['faq_id'] ?>">
			  <input type=image src="images/but_update.gif" name="image"  align="middle"   ></td>
                        </tr>
                    </table></td>
                </tr>
              </table>
            </form></td>
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
