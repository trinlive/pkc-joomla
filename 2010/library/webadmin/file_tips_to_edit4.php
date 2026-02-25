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
$gettmp[fileid] = $_GET[fileid];
$gettmp[tid] = $_GET[tid];
$SQLstr = "SELECT * FROM tips_files WHERE tips_files.tid = '".$gettmp[tid]."' AND tips_files.fileid =  '".$gettmp[fileid]."'";
$rs = $db->Execute($SQLstr) ;
$stmt = "SELECT * FROM tips WHERE tips.tid = '".$gettmp[tid]."' ";
$rs2 = $db->Execute($stmt) ;

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO.,LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function checkForm(){
		with(this.form1){
		/*if(image.value==""){
				alert(' Please Fill SMALL IMAGE :');
				image.focus();
				return false;
			}*/
			if(image2.value==""){
				alert('Please Fill LARGE IMAGE :');
				image2.focus();
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
        <td align="right" class="arialVIO24B">TIPS</td>
        <td width="45">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_tips.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit File  tips </span></td>
            <td width="446" align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="214">&nbsp; &nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14"></td>
      </tr>
      <tr>
        <td>
		<form action="file_tips_action.php" method="POST" enctype="multipart/form-data" name="form1" style="margin:0" onSubmit="return checkForm();">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td width="8">&nbsp;</td>
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#F7F7F7">
              <tr>
                <td class="arialVIO11B">SUBJECT  :</td>
                <td class="arialVIO12B2"> <?php echo stripslashes($rs2->fields['subject'])?> </td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
               <td width="162" valign="top" class="arialVIO11B">TOPIC : </td>
                  <td valign="top" class="text_black_bold"><input name="topic" type="text" class="border_bg_violet" id="topic" value="<?php echo stripslashes($rs->fields['topic'])?>" style="width:70%"></td>
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
                      <a href="../img_tips/file/<?php echo $rs->fields['fileatt'];?>" target="_blank" class="text_gray_normal" title="<?php echo $rs->fields['fileatt'];?>"><?php echo $rs->fields['fileatt'];?></a>&nbsp;
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
                  </table>(pdf,doc,xls,ppt,zip,rar,rtf)  2 MB size limitation </td>
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
                <td valign="top"><select name="filestatus" class="border_bg_violet" id="filestatus">
                    
					<option value="Active" <?php if($rs->fields['filestatus'] == 'Active'):?> selected<?php endif ;?>>SHOW</option>
                    <option value="Inactive"<?php if($rs->fields['filestatus'] == 'Inactive'):?> selected<?php endif ;?>>HIDE</option>
                </select></td>
              </tr>
			  
              <tr>
                <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                </table></td>
              </tr>
			  
                <td colspan="2" align="right"><input name="fileid" type="hidden" id="fileid" value="<?php echo $_GET['fileid'] ; ?>">
				<input name="tid" type="hidden" id="tid" value="<?php echo $_GET['tid'] ; ?>">
				<input name="MM_action" type="hidden" id="MM_action" value="update">
                <input name="Submit" type=image id="Submit" src="images/but_save.gif"  align="middle" width="143" height="23">                </td>
              </tr>
            </table></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table>
		</form>		</td>
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