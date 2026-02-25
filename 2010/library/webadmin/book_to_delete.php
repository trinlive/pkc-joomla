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
<?php //ลบ
if($_GET[actions]=="del"){
	$gettmp[book_id] = $_GET[book_id];
	$gettmp[fileatt] = $_GET['fileatt'];
	
	if ($gettmp[fileatt] != "") :
		if(file_exists("../img_book/thumbnail/$gettmp[fileatt]")) unlink("../img_book/thumbnail/$gettmp[fileatt]");
	endif ;
	
	ADOdb_Active_Record::SetDatabaseAdapter($db);
	class book_librarie extends ADOdb_Active_Record{}
	$book_librarie = new book_librarie();
	$book_librarie->load("book_id=?", array($gettmp[book_id]));
	$book_librarie->Delete();
	if($book_librarie):
		saverecord('Delete Press Center');	
		echo "<meta http-equiv=\"refresh\" content=\"2; URL=download_to_delete.php?page=".$_GET[page]."\">";
		exit();
	endif ;		
} // ลบ
?>
<?php
 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page);
 
$SQLstr = "SELECT * FROM book_libraries ORDER BY book_id DESC ";
$db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<title>:: ADMIN CONTROL PANEL PAKKRETCITY ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
<script language="javascript">
	function chkAllbox(){
		var chkstatus=0;
		var chktmp;
		var el_collection=eval("document.forms.form1.chkbox")	
		
		if(el_collection.length>1){					
			for (c=0;c<el_collection.length;c++){
				if(el_collection[c].checked) chkstatus++;
			}	
			if(chkstatus==el_collection.length) chktmp=true;
			else	chktmp=false;
		}else{
			chktmp=el_collection.checked;
		}	
		return chktmp;
	}
	
	function swapCheckBox(){		
		document.form1.checkAll.checked=chkAllbox();
	}	

	function checkBox(obj){
		var chk=obj.checked;
		var el_collection=eval("document.forms.form1.chkbox")
				
		if(el_collection.length>1){
			for (c=0;c<el_collection.length;c++)
			el_collection[c].checked=chk
		}else{
			el_collection.checked=chk
		}		
	}	
	
	function checkForm(){	
		var chkstatus=0;
		var el_collection=eval("document.forms.form1.chkbox");
				
		if(el_collection.length>1){
			for (c=0;c<el_collection.length;c++)
			if(el_collection[c].checked) chkstatus++;
		}else{
			if(el_collection.checked) chkstatus++;
		}		
		if(chkstatus<1){
			alert('Please Select CheckBox!!!');
			return false;
		}else{
			if(confirm('Do you want to delete? ')){
				document.form1.submit();
			}else{
				return false;
			}
		}
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
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head05.gif">
          <tr>
            <td width="185" height="29"><span class="arialWH18B" style="margin-left:8px;">Delete Book</span></td>
            <td align="right">&nbsp; &nbsp; </td>
            <td width="214">&nbsp; &nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14"></td>
      </tr>
      <tr>
        <td><form name="form1" method="post" action="book_action.php" onSubmit="return checkForm();">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td width="8">&nbsp;</td>
            <td><?php if (!$rs->EOF):?>
              <table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                <tr align="center" bgcolor="#1bb3b3" class="arialWH11B">
                  <td width="30" class="text_gray_normal"><input type="checkbox" name="checkAll" id="checkAll" onClick="checkBox(this);"></td>
                  <td width="60" height="25">ID</td>
                  <td>TOPIC</td>
                  <td width="80">STATUS</td>
                  <td width="35">DEL</td>
                </tr>
                <tr>
                  <td height="30" colspan="5">&nbsp;</td>
                </tr>
                <?php  while (!$rs->EOF): ?>
                <tr>
                  <td height="1" colspan="5" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                      <tr>
                        <td></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="30" align="center"><input type="checkbox" name="chkbox[<?php echo $rs->fields['book_id'] ?>]" id="chkbox" value="<?php echo $rs->fields['book_id'] ?>" onClick="swapCheckBox();"></td>
                  <td width="60" height="20" align="center" class="text_gray_normal"><a href="book_edit.php?book_id=<?php echo $rs->fields['book_id'] ?>"class="text_gray_normal"><?php echo $rs->fields['book_id'] ?></a></td>
                  <td><span class="text_gray_normal"><a href="book_edit.php?book_id=<?php echo $rs->fields['book_id'] ?>" class="text_violet_normal"><?php echo stripslashes($rs->fields['book_name'])?></a></span></td>
                  <td width="80" align="center" class="arialGREY11nor"><?php if ($rs->fields['book_status'] == 'Active'):
				echo '<b><font color="#0000FF">SHOW</font></b>';
				else:
				echo '<b><font color="#FF0000">HIDE</font></b>';
				endif; ?></td>
                  <td width="35" align="center"><a href="?actions=del&amp;book_id=<?php echo $rs->fields['book_id'] ?>&amp;fileatt=<?php echo $rs->fields['fileatt']?>" onClick="return  confirm('Do you want to delete? ');"><img src="images/del_button.gif" width="13" height="13" border="0" /></a></td>
                </tr>
                <?php $rs->MoveNext(); ?>
                <?php endwhile; ?>
                <tr>
                  <td colspan="6" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                      <tr>
                        <td></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="30"><input type="hidden" name="MM_action" value="delete" /></td>
                </tr>
              </table>
              <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="16"></td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="100"><input type="image" src="images/but_del_selected.gif" align="middle"  name="Deleteall" value="Delete Selected"></td>
                  <td align="center" class="text_black12_bold"><?php echo $GenericEasyPagination->getNavigation_prev(); ?> <?php echo $GenericEasyPagination->getCurrentPages(); ?> <?php echo $GenericEasyPagination->getNavigation_next(); ?></td>
                  <td width="80" align="center" class="text_black12_bold"><?php echo $recordsFound ?></td>
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
        </table>
		</form> </td>
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
<?php
	unset($getdata);
	unset($getpage);
	mysql_close(); 
?>