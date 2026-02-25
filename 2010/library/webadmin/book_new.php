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
 $SQLcate = "SELECT * FROM categories";
 $rscate = $db->Execute($SQLcate);
//print_r($rscate);
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ADMIN CONTROL PANEL PAKKRETCITY ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
function showTable(elm){

if (elm == 'News' ){
document.getElementById('image').style.display = 'none';  
document.getElementById('table1').style.display = 'block';  
}
if (elm == 'Event' ){
document.getElementById('image').style.display = 'block';  
document.getElementById('table1').style.display = 'none'; 
}
}
</script>
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<!-- AHA! Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- AHA! Editor -->
<script language="javascript">
function checkForm(){
tinyMCE.triggerSave();
		with(this.form1){
			if(subject.value==""){
				alert(' Please Fill SUBJECT :');
				subject.focus();
				return false;
			}
			if(description.value==""){
				alert('Please Fill DESCRIPTION :');
				description.focus();
				return false;
			}
			if(detail.value==""){
				alert('Please Fill DETAIL :');
				return false;
			}
			if(image.value==""){
				alert('Please Fill INDEX IMAGE :');
				image.focus();
				return false;
			}
			if(image2.value==""){
				alert('Please Fill ALL IMAGE :');
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
                <td align="right" class="arialVIO24B">BOOK</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_book.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Add BOOk</span></td>
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
            <td><form action="book_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0" onSubmit="return checkForm();">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                 <tr>
                  <td class="arialVIO11B">ลำดับ  : </td>
                  <td><input name="book_number" type="text" class="border_bg_violet" id="book_number" style="width:10%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td width="14%" class="arialVIO11B">ชื่อเรื่องหลัก : </td>
                  <td width="86%" valign="top" class="text_black_bold">
                 <select name="cate_book" class="border_bg_violet" id="cate_book">
                 <option value="">--กรุณาเลือกหัวข้อหลัก--</option>
                   <?php  while (!$rscate->EOF): ?> <option value="<?php echo $rscate->fields['cate_id'] ;?>"><?php echo $rscate->fields['cate_name'] ;?></option>               
                <?php $rscate->MoveNext();?>
				<?php endwhile ;?></select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
               
                 <tr>
                  <td class="arialVIO11B">หัวข้อย่อย  : </td>
                  <td><input name="subid_book" type="text" class="border_bg_violet" id="subid_book" style="width:10%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="arialVIO11B">ชื่อเรื่อง/รายละเอียด  : </td>
                  <td><input name="book_name" type="text" class="border_bg_violet" id="book_name" style="width:70%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                
				
               
               
                
                
                 <tr>
                  <td class="arialVIO11B">ชนิดเอกสาร : </td>
                  <td valign="top" class="text_black_bold"><select name="book_type" class="border_bg_violet" id="book_type">
                    <option value="book">หนังสือ</option>
                    <option value="copy">ถ่ายสำเนา</option>
                    <option value="promotion">เอกสารประชาสัมพันธ์</option>
                    <option value="cd">CD/FILE ข้อมูล</option>
                   
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
                  <td class="arialVIO11B">จำนวน  : </td>
                  <td><input name="book_num" type="text" class="border_bg_violet" id="book_num" style="width:10%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="arialVIO11B">ปีของเรื่อง : </td>
                  <td valign="top" class="text_black_bold"><select name="book_year" class="border_bg_violet" id="book_year">
                    <option value="ไม่ระบุ">ไม่ระบุ</option>
                    <option value="2530">2530</option>
                    <option value="2531">2531</option>
                    <option value="2532">2532</option>
                    <option value="2533">2533</option>
                    <option value="2534">2534</option>
                    <option value="2535">2535</option>
                    <option value="2536">2536</option>
                    <option value="2537">2537</option>
                    <option value="2538">2538</option>
                    <option value="2539">2539</option>
                    <option value="2540">2540</option>
                    <option value="2541">2541</option>
                    <option value="2542">2542</option>
                    <option value="2543">2543</option>
                    <option value="2544">2544</option>
                    <option value="2545">2545</option>
                    <option value="2546">2546</option>
                    <option value="2547">2547</option>
                    <option value="2548">2548</option>
                    <option value="2549">2549</option>
                    <option value="2550">2550</option>
                    <option value="2551">2551</option>
                    <option value="2552">2552</option>
                    <option value="2553">2553</option>
                    <option value="2554">2554</option>
                    <option value="2555">2555</option>
                    <option value="2556">2556</option>
                    <option value="2557">2557</option>
                    <option value="2558">2558</option>
                    <option value="2559">2559</option>
                    <option value="2560">2560</option>
                    <option value="2561">2561</option>
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
                
               <tr>
                  <td class="arialVIO11B">หน่วยงานเจ้าของเรื่อง  : </td>
                  <td><input name="book_ower" type="text" class="border_bg_violet" id="book_ower" style="width:70%" /></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                
               
               <tr>
                  <td class="arialVIO11B">รหัสตู้ : </td>
                  <td valign="top" class="text_black_bold"><select name="book_code" class="border_bg_violet" id="book_code">
                    <option value="1.1">1.1</option>
                    <option value="1.2">1.2</option>
                    <option value="1.3">1.3</option>
                    <option value="1.4">1.4</option>
                    <option value="1.5">1.5</option>
                    <option value="2.1">2.1</option>
                    <option value="2.2">2.2</option>
                    <option value="2.3">2.3</option>
                    <option value="2.4">2.4</option>
                    <option value="2.5">2.5</option>
                    <option value="3.1">3.1</option>
                    <option value="3.2">3.2</option>
                    <option value="3.3">3.3</option>
                    <option value="3.4">3.4</option>
                    <option value="4.1">4.1</option>
                    <option value="4.2">4.2</option>
                    <option value="4.3">4.4</option>
                    <option value="5.1">5.1</option>
                    <option value="5.2">5.3</option>
                    <option value="5.4">5.4</option>
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
                 <tr>
                  <td class="arialVIO11B">หมายเหตุ  : </td>
                  <td><textarea name="book_note" rows="5" class="border_bg_violet" id="book_note" style="width:70%"></textarea></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
               
                 
				               <tr>
                  <td class="arialVIO11B">  รูปหนังสือ : </td>
                  <td valign="top" class="arialVIO11"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialVIO11">
                    <tr>
                      <td width="70%"><input name="file2" type="file" class="border_bg_violet" id="file2" style="width:100%" /></td>
                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="arialBL11">
                        <tr>
                          <td width="20"></td>
                          <td width="75">Fix</td>
                          <td>= 280 x 373 pixel</td>
                        </tr>
                      </table></td>
                      </tr>
                  </table>                    </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
               
                <tr>
                  <td class="arialVIO11B">สถานะหนังสือ: </td>
                  <td valign="top" class="text_black_bold"><select name="book_now" class="border_bg_violet" id="book_now">
                    <option value="have">มีอยู่</option>
                    <option value="not">ถูกยืมไป</option>
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
                  <td valign="top" class="arialVIO11B">สถานะ : </td>
                  <td valign="top" class="text_black_bold"><select name="book_status" class="border_bg_violet" id="book_status">
                    <option value="Active">SHOW</option>
                    <option value="Inactive">HIDE</option>
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
                  <td valign="top" class="text_black_bold">วันที่ :</td>
                  <td valign="top" class="text_black_bold"><?php echo list_day("postday","postday",date("d"),'class="border_bg_violet"',"")?> <?php echo list_month("postmonth","postmonth",date("m"),'class="border_bg_violet"',"","en")?> <?php echo list_year("postyear","postyear",date("Y"),'class="border_bg_violet"',"","en")?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold">&nbsp;</td>
                  <td valign="top" class="text_black_bold">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="right" valign="top" class="text_black_bold"><p align="right">
                    <input type="image" src="images/but_save.gif" name="image"  align="middle">
                    <input type="hidden" name="MM_action" value="create" />
                  </p></td>
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
    <td height="55" valign="top"><?php include ("inc/inc_footer.php") ?></td>
  </tr>
</table>
</body>
</html>