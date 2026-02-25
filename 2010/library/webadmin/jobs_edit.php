<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<?php
#$db->debug = 1 ;
$gettmp[job_id] = $_GET[job_id];
 $stmt = $db->Prepare('SELECT * FROM `jobs` WHERE `jobs`.`job_id` =? ');
 $rs = $db->Execute($stmt,array($gettmp[job_id])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['job_date']);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
<script language="javascript">
function checkForm(){
tinyMCE.triggerSave();
		with(this.form){
			if(job_position.value==""){
				alert('Please Fill JOB POSITION:');
				job_position.focus();
				return false;
			}
			if(job_description.value==""){
				alert('Please Fill JOB DESCRIPTION:');
				return false;
			}
			if(job_detail.value==""){
				alert('Please Fill JOB DETAIL:');
				return false;
			}
			if(job_person.value==""){
				alert('Please Fill NUMBER OF PERSON :');
				job_person.focus();
				return false;
			}
		}
		return true;
	}
</script>
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
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
                <td align="right" class="arialVIO24B">CAREER</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_jobs.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Jobs </span></td>
            <td align="right">&nbsp; &nbsp; </td>
            <td width="50">&nbsp; &nbsp;</td>
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
            <td><form action="jobs_action.php" method="post" enctype="multipart/form-data"  name="form" style="margin:0;"  onSubmit="return checkForm();">
              <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="163" valign="top" class="arialVIO11B">JOB POSITION  : </td>
                  <td valign="top"><input name="job_position" type="text" class="border_bg_violet" id="job_position" style="width:70%" value="<?php echo $rs->fields['job_position'] ?>"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                  <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
				  <tr>
                  <td width="162" valign="top" class="arialVIO11B">JOB DESCRIPTION  :</td>
                  <td class="text_black_bold"><img src="images/spacer.gif" width="350" height="1"></td>
                </tr>
				  <tr>
				    <td colspan="2" valign="top" class="arialVIO11B"><textarea name="job_description" class="border_bg_gray" id="job_description" style="width:100%; height:200"><?php echo $rs->fields['job_description'] ?></textarea></td>
				    </tr>
					<tr>
                  <td colspan="2" valign="top" class="text_black_bold">&nbsp;</td>
                </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td width="162" valign="top" class="arialVIO11B">JOB DETAIL  :</td>
                      <td class="text_black_bold"><img src="images/spacer.gif" width="350" height="1"></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top" class="arialVIO11B"><textarea name="job_detail" class="border_bg_gray" id="job_detail" style="width:100%; height:200"><?php echo $rs->fields[job_detail] ?></textarea></td>
                    </tr>
					<tr>
                  <td colspan="2" valign="top" class="text_black_bold">&nbsp;</td>
                </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">NUMBER OF PERSON   :</td>
                  <td valign="top" class="text_black_bold"><input name="job_person" type="text" class="border_bg_violet" id="job_person" size="85" maxlength="100" value="<?php echo $rs->fields['job_person'] ?>"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
            
                <tr>
                  <td valign="top" class="arialVIO11B"> DATE : </td>
                  <td valign="top" class="text_black_bold">
                    <?php echo list_day("postday","postday",date("d"),'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",date("m"),'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",date("Y"),'class="border_bg_violet"',"","en")?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">STATUS : </td>
                  <td valign="top"><select name="active" class="border_bg_violet" id="active">
                    <option value="Active" <?php if($rs->fields['job_status'] == "Active"): echo "selected"; endif; ?>>SHOW</option>
                    <option value="Inactive" <?php if($rs->fields['job_status'] == "Inactive"): echo "selected"; endif; ?>>HIDE</option>
                  </select></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="right"><input type="hidden" name="MM_action" value="update">
                              <input type=image src="images/but_update.gif" name="image"  align="middle"  >
							  <input type="hidden" name="job_id" id="job_id"  value="<?php echo $gettmp[job_id];?>"/>                               </td>
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
    <td height="55" valign="top"><?php include ("inc/inc_footer.php") ?></td>
  </tr>
</table>
</body>
</html>