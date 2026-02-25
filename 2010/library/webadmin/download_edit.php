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
//ลบข้อมูล
if($_GET[actions]=="delfileatt"){
	$gettmp[press_id] = $_GET['press_id'];
	$gettmp[fileatt] = $_GET['fileatt'];
		
	if ($gettmp[fileatt] != "") :
		if(file_exists("../img_presscenter/file/$gettmp[fileatt]")) unlink("../img_presscenter/file/$gettmp[fileatt]");
	endif ;
	ADOdb_Active_Record::SetDatabaseAdapter($db);
		class presscenter extends ADOdb_Active_Record{}
		$presscenter = new presscenter();
		$presscenter->load("press_id=?", array($gettmp[press_id]));
		$presscenter->fileatt = NULL ;
		$presscenter->filesizes = NULL ;
		$presscenter->filemarkup = NULL ;
		$presscenter->replace();
	
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=download_edit.php?press_id=$gettmp[press_id]\">";
	exit();
} // จบการลบข้อมูล

 $gettmp[press_id] = $_GET['press_id'];
 $SQLstr = "SELECT * FROM presscenters WHERE press_id = '$gettmp[press_id]' ORDER BY press_id DESC ";
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
			if(sdetail.value==""){
				alert('Please Fill DESCRIPTION :');
				sdetail.focus();
				return false;
			}
			if(filerem.value==""){
				alert('Please Fill FILE TOPIC  :');
				filerem.focus();
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
                <td align="right" class="arialVIO24B">PRESS CENTER</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_download.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Press Center</span></td>
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
            <td><form action="download_action.php" method="POST" enctype="multipart/form-data" name="form1" onSubmit="return checkForm();">
              <table width="99%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="162" valign="top" class="arialVIO11B">TOPIC : </td>
                  <td class="text_violet_bold"><input name="topic" type="text" class="border_bg_violet" id="topic" style="width:70%" value="<?php echo $rs->fields['topic'] ?>"></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">DESCRIPTION : </td>
                  <td valign="top" class="text_black_bold"><textarea name="sdetail" style="width:70%" rows="5" class="border_bg_violet" id="sdetail"><?php echo $rs->fields['sdetail'] ?></textarea></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td valign="top"><?php if (!is_null($rs->fields['fileatt'])) {?>
                      <a href="../img_presscenter/file/<?php echo $rs->fields['fileatt'];?>" target="_blank" class="text_gray_normal" title="<?php echo $rs->fields['fileatt'];?>"><?php echo $rs->fields['fileatt'];?></a>&nbsp;
                      <input name="pfileatt" type="hidden" id="pfileatt" value="<?php echo $rs->fields['fileatt'] ;?>">
                              <?php } ?>                    </td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">FILE ATTACHMENT : </td>
                  <td valign="top" class="arialBL11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                    <tr>
                      <td width="70%"><input name="fileatt" type="file" class="border_bg_violet" id="fileatt" style="width=100%" /></td>
                      <td width="20" class="arialGREY11nor">&nbsp;</td>
                      <td width="50">&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                    (pdf,doc,xls,ppt,zip,rar,rtf)  2 MB size limitation </td>
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
                  <td valign="top" class="text_black_bold"><select name="download_status" class="border_bg_violet" id="download_status">
                      <option value="Active" <?php if($rs->fields['download_status'] == 'Active'){echo "selected";}?>>SHOW</option>
                      <option value="Inactive" <?php if($rs->fields['download_status'] == 'Inactive'){echo "selected";}?>>HIDE</option>
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
                  <td valign="top" class="arialVIO11B">DATE : </td>
                  <td valign="top" class="text_black_bold"><?php $gettmp[tmp_date_press]=explode("-",$rs->fields['press_date']); ?>
                      <?php echo list_day("ndate","ndate",$gettmp[tmp_date_press][2],"class='border_bg_violet ' " ,"")?>
                      <?php echo list_month("nmonth","nmonth",$gettmp[tmp_date_press][1],"class='border_bg_violet' ","","en")?>
                      <?php echo list_year("nyear","nyear",$gettmp[tmp_date_press][0],"class='border_bg_violet' ","","en")?>                  </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="16"></td>
                      </tr>
                    </table>
                  <tr>
                  <td colspan="2" align="right" valign="top" class="text_black_bold">&nbsp;</td>
                  </tr>
                <tr>
                  <td colspan="2" align="right" valign="top" class="text_black_bold">
                      <input name="press_id" type="hidden" id="press_id" value="<?php echo $rs->fields['press_id'];?>">
                      <input type="hidden" name="MM_action" value="update">
					  <input type=image src="images/but_update.gif" name="image"  align="middle" ></td>
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