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
 if($_GET[actions]=="del"):
    $gettmp[book_id] = $_GET['book_id'];
	$gettmp[fileatt] = $_GET[fileatt];
		$SQLstr = " SELECT * FROM `book_libraries` WHERE `book_libraries`.`book_id` =  '".$_GET['book_id']."' ";
 		$rs = $db->Execute($SQLstr) ;
		$gettmp[fileatt] = $rs->fields['fileatt'];
		
	/*	$postdata[field]=array("fileatt");
		$postdata[value]=array("NULL");
		$getdata[updata]=update_mysql2("product",$postdata,"WHERE nid='".$gettmp[nid]."'")	; */
	#$db->debug=1;
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class book_librarie extends ADOdb_Active_Record{}
			$book_librarie = new book_librarie();
			$book_librarie->load("book_id=?", array($_GET[book_id]));
			$book_librarie->fileatt = '' ;
			$book_librarie->replace();
		//echo $gettmp[fileatt] ;//exit() ;
		if(file_exists("../img_book/thumbnail/$gettmp[fileatt]")){ unlink("../img_book/thumbnail/$gettmp[fileatt]");	}
	//saverecord('Delete link Category');
echo "<meta http-equiv=\"refresh\" content=\"0; URL=book_edit.php?book_id=$book_id\">";
	exit();
	endif; // จบการลบข้อมูล 
?>

<?php
 $gettmp[book_id] = $_GET[book_id];
 $stmt = $db->Prepare('SELECT * FROM book_libraries WHERE book_libraries.book_id =? ');
 $rs = $db->Execute($stmt,array($gettmp[book_id])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['book_date']);

?>
<?php
 $SQLtype = "SELECT * FROM categories ";
 $rscate = $db->Execute($SQLtype);
 //print_r($rstype);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ADMIN CONTROL PANEL PAKKRETCITY ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
function showTable(elm){
if (elm == 'tips' ){
document.getElementById('image').style.display = 'none';  
}
if (elm == 'Event' ){
document.getElementById('image').style.display = 'block';  
}
}
</script>
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<!-- ST! Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- ST! Editor -->
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
                <td align="right" class="arialVIO24B">PRODUCT</td>
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Edit Products </span></td>
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
            <td width="8"></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><form action="book_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1" style="margin:0" onSubmit="return checkForm();">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                  <td class="arialVIO11B">ลำดับ : </td>
                  <td><input name="book_number" type="text" class="border_bg_violet" id="book_number" style="width:20%" value="<?php echo $rs->fields['book_number'] ?>"></td>
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
				<option value="" >--------กรุณาเลือก----------</option>
				<?php  while (!$rscate->EOF): ?>
				<option value="<?php echo $rscate->fields['cate_id'] ?>" <?php if($rscate->fields['cate_id'] == $rs->fields['cate_book'] ) echo "selected";?>><?php echo $rscate->fields['cate_name'] ?></option>
				<?php $rscate->MoveNext(); ?>
                  <?php endwhile; ?></select>
		
               
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
                  <td class="arialVIO11B">หัวข้อย่อย : </td>
                  <td><input name="subid_book" type="text" class="border_bg_violet" id="subid_book" style="width:20%" value="<?php echo $rs->fields['subid_book'] ?>"></td>
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
                  <td><input name="book_name" type="text" class="border_bg_violet" id="book_name" style="width:70%" value="<?php echo $rs->fields['book_name'] ?>"></td>
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
                    <option value="book"<?php if($rs->fields['book_type'] == 'book'){echo "selected";}?>>หนังสือ</option>
                    <option value="copy"<?php if($rs->fields['book_type'] == 'copy'){echo "selected";}?>>ถ่ายสำเนา</option>
                    <option value="promotion"<?php if($rs->fields['book_type'] == 'promotion'){echo "selected";}?>>เอกสารประชาสัมพันธ์</option>
                    <option value="cd"<?php if($rs->fields['book_type'] == 'cd'){echo "selected";}?>>CD/FILE ข้อมูล</option>
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
                  <td><input name="book_num" type="text" class="border_bg_violet" id="book_num" style="width:20%" value="<?php echo $rs->fields['book_num'] ?>"></td>
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
                  <option value="ไม่ระบุ"<?php if($rs->fields['book_year'] == 'ไม่ระบุ'){echo "selected";}?>>ไม่ระบุ</option>
                    <option value="2530"<?php if($rs->fields['book_year'] == '2530'){echo "selected";}?>>2530</option>
                    <option value="2531"<?php if($rs->fields['book_year'] == '2531'){echo "selected";}?>>2531</option>
                    <option value="2532"<?php if($rs->fields['book_year'] == '2532'){echo "selected";}?>>2532</option>
                    <option value="2533"<?php if($rs->fields['book_year'] == '2533'){echo "selected";}?>>2533</option>
                    <option value="2534"<?php if($rs->fields['book_year'] == '2534'){echo "selected";}?>>2534</option>
                    <option value="2535"<?php if($rs->fields['book_year'] == '2535'){echo "selected";}?>>2535</option>
                    <option value="2536"<?php if($rs->fields['book_year'] == '2536'){echo "selected";}?>>2536</option>
                    <option value="2537"<?php if($rs->fields['book_year'] == '2537'){echo "selected";}?>>2537</option>
                    <option value="2538"<?php if($rs->fields['book_year'] == '2538'){echo "selected";}?>>2538</option>
                    <option value="2539"<?php if($rs->fields['book_year'] == '2539'){echo "selected";}?>>2539</option>
                    <option value="2540"<?php if($rs->fields['book_year'] == '2540'){echo "selected";}?>>2540</option>
                    <option value="2541"<?php if($rs->fields['book_year'] == '2541'){echo "selected";}?>>2541</option>
                    <option value="2542"<?php if($rs->fields['book_year'] == '2542'){echo "selected";}?>>2542</option>
                    <option value="2543"<?php if($rs->fields['book_year'] == '2543'){echo "selected";}?>>2543</option>
                    <option value="2544"<?php if($rs->fields['book_year'] == '2544'){echo "selected";}?>>2544</option>
                    <option value="2545"<?php if($rs->fields['book_year'] == '2545'){echo "selected";}?>>2545</option>
                    <option value="2546"<?php if($rs->fields['book_year'] == '2546'){echo "selected";}?>>2546</option>
                    <option value="2547"<?php if($rs->fields['book_year'] == '2547'){echo "selected";}?>>2547</option>
                    <option value="2548"<?php if($rs->fields['book_year'] == '2548'){echo "selected";}?>>2548</option>
                    <option value="2549"<?php if($rs->fields['book_year'] == '2549'){echo "selected";}?>>2549</option>
                    <option value="2550"<?php if($rs->fields['book_year'] == '2550'){echo "selected";}?>>2550</option>
                    <option value="2551"<?php if($rs->fields['book_year'] == '2551'){echo "selected";}?>>2551</option>
                    <option value="2552"<?php if($rs->fields['book_year'] == '2552'){echo "selected";}?>>2552</option>
                    <option value="2553"<?php if($rs->fields['book_year'] == '2553'){echo "selected";}?>>2553</option>
                    <option value="2554"<?php if($rs->fields['book_year'] == '2554'){echo "selected";}?>>2554</option>
                    <option value="2555"<?php if($rs->fields['book_year'] == '2555'){echo "selected";}?>>2555</option>
                    <option value="2556"<?php if($rs->fields['book_year'] == '2556'){echo "selected";}?>>2556</option>
                    <option value="2557"<?php if($rs->fields['book_year'] == '2557'){echo "selected";}?>>2557</option>
                    <option value="2558"<?php if($rs->fields['book_year'] == '2558'){echo "selected";}?>>2558</option>
                    <option value="2559"<?php if($rs->fields['book_year'] == '2559'){echo "selected";}?>>2559</option>
                    <option value="2560"<?php if($rs->fields['book_year'] == '2560'){echo "selected";}?>>2560</option>
                    <option value="2561"<?php if($rs->fields['book_year'] == '2561'){echo "selected";}?>>2561</option>
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
                  <td><input name="book_ower" type="text" class="border_bg_violet" id="book_ower" style="width:70%" value="<?php echo $rs->fields['book_ower'] ?>"></td>
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
                    <option value="1.1"<?php if($rs->fields['book_code'] == '1.1'){echo "selected";}?>>1.1</option>
                    <option value="1.2"<?php if($rs->fields['book_code'] == '1.2'){echo "selected";}?>>1.2</option>
                    <option value="1.3"<?php if($rs->fields['book_code'] == '1.3'){echo "selected";}?>>1.3</option>
                    <option value="1.4"<?php if($rs->fields['book_code'] == '1.4'){echo "selected";}?>>1.4</option>
                    <option value="1.5"<?php if($rs->fields['book_code'] == '1.5'){echo "selected";}?>>1.5</option>
                    <option value="2.1"<?php if($rs->fields['book_code'] == '2.1'){echo "selected";}?>>2.1</option>
                    <option value="2.2"<?php if($rs->fields['book_code'] == '2.2'){echo "selected";}?>>2.2</option>
                    <option value="2.3"<?php if($rs->fields['book_code'] == '2.3'){echo "selected";}?>>2.3</option>
                    <option value="2.4"<?php if($rs->fields['book_code'] == '2.4'){echo "selected";}?>>2.4</option>
                    <option value="2.5"<?php if($rs->fields['book_code'] == '2.5'){echo "selected";}?>>2.5</option>
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
                  <td><textarea name="book_note" rows="5" class="border_bg_violet" id="book_note" style="width:70%"><?php echo stripslashes($rs->fields['book_note'])?></textarea></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text_black_bold"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="16"></td>
                    </tr>
                  </table></td>
                </tr>
               
                 <tr>
                      <td valign="top" class="arialVIO11B">&nbsp;</td>
                      <td valign="top" class="text_violet_normal03"><?php if ($rs->fields['book_images'] != "") :?><img src="../img_book/thumbnail/<?php echo $rs->fields['book_images']?>" border="0" /><?php endif ; ?><input name="book_images" type="hidden" id="book_images" value="<?php echo $rs->fields['book_images']?>"></td>
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
                    <option value="have"<?php if($rs->fields['book_now'] == 'have'){echo "selected";}?>>มีอยู่</option>
                    <option value="not" <?php if($rs->fields['book_now'] == 'not'){echo "selected";}?>>ถูกยืมไป</option>
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
                    <option value="Active" <?php if($rs->fields['book_status'] == 'Active'){echo "selected";}?>>SHOW</option>
                      <option value="Inactive" <?php if($rs->fields['book_status'] == 'Inactive'){echo "selected";}?>>HIDE</option>
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
                  <td valign="top" class="text_black_bold"><?php $gettmp[tmp_date_book]=explode("-",$rs->fields['book_date']); ?>
                      <?php echo list_day("ndate","ndate",$gettmp[tmp_date_book][2],"class='border_bg_violet ' " ,"")?>
                      <?php echo list_month("nmonth","nmonth",$gettmp[tmp_date_book][1],"class='border_bg_violet' ","","en")?>
                      <?php echo list_year("nyear","nyear",$gettmp[tmp_date_book][0],"class='border_bg_violet' ","","en")?></td>
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
                   <input name="book_id" type="hidden" id="book_id" value="<?php echo $rs->fields['book_id'];?>">
                    <input type="image" src="images/but_save.gif" name="image"  align="middle">
                    <input type="hidden" name="MM_action" value="update" />
                  </p></td>
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