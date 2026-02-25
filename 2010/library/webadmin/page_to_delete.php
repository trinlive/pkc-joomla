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
//ลบข้อมูล
if($_GET[actions]=="del"):

#$db->debug=1;

	$gettmp['page_id']=$_GET["page_id"];	
	
	 $stmtdel3 = $db->Prepare("DELETE pdf_pages FROM pdf_pages WHERE pdf_pages.page_id =? ");
 	 $rsdel3 = $db->Execute($stmtdel3,array($gettmp['page_id'])) ;

	 $stmtdelnews = $db->Prepare("DELETE pages FROM pages WHERE pages.page_id =? ");
 	 $rsdelnews = $db->Execute($stmtdelnews,array($gettmp['page_id'])) ;

	endif ;
?>
<?php
 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page); 
 

$SQLstr = "SELECT * FROM pages ORDER BY page_id DESC";
# $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
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
<script  language="javascript" type="text/javascript" src="js/editcheck.js"></script>
<script  type="text/javascript" src="js/dhtmlgoodies_calendar.js?random=20060118"></script>
<link type="text/css" rel="stylesheet" href="js/dhtmlgoodies_calendar.css?random=20051112" media="screen">
<!-- ST Editor -->
<script language="javascript" type="text/javascript" src="editor/tinymce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="editor/tinymce/st_editor.js"></script>
<!-- ST Editor -->
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
                <td align="right" class="arialVIO24B">PAGE KEYWORD</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_keyword.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Delete Page</span></td>
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
                <td valign="top"><form action="keyword_action.php" style="margin:0" method="post"  name="form1" id="form1"onSubmit="return checkForm();">
                  <table width="100%" height="220"  border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td valign="top" bgcolor="#FFFFFF" class="text_black_bold"><?php if (!$rs->EOF):?>
                          
                          <table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                            <tr align="center" bgcolor="#1bb3b3" class="arialWH11B">
                              <td width="30" class="text_gray_normal"><input type="checkbox" name="checkAll" id="checkAll" onClick="checkBox(this);" /></td>
                              <td width="60" height="25">ID</td>
                              <td>SUBJECT</td>
                              <td width="80">STATUS</td>
                              <td width="35">DEL</td>
                            </tr>
                            <tr>
                              <td height="30" colspan="5">&nbsp;</td>
                              </tr>
                            <?php  while (!$rs->EOF): ?>
                            <tr>
                              <td height="1" colspan="5" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                  <tr>
                                    <td></td>
                                  </tr>
                              </table></td>
                            </tr>
                            
                            <tr>
                              <td width="30" align="center" class="text_gray_normal"><input type="checkbox" name="chkbox[]" id="chkbox" value="<?php echo  $rs->fields['page_id'] ?>" onClick="swapCheckBox();" /></td>
                              <td width="60" height="20" align="center" class="text_gray_normal"><?php echo $rs->fields['page_id'] ?></td>
                              <td><span class="text_gray_normal"><?php echo stripslashes($rs->fields['caption'])?></span></td>
                              <td width="80" align="center" class="arialGREY11nor"><?php if ($rs->fields['page_active'] == 'Active'):
				echo '<b><font color="#0000FF">SHOW</font></b>';
				else:
				echo '<b><font color="#FF0000">HIDE</font></b>';
				endif; ?></td>
                              <td width="35" class="text_gray_normal" align="center"><a href="?actions=del&page_id=<?php echo $rs->fields['page_id'] ?>" onClick="return  confirm('Do you want to delete? ');"><img src="images/del_button.gif" width="13" height="13" border="0" /></a></td>
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
                          <?php  while (!$rs->EOF): ?>
                          <?php $rs->MoveNext(); ?>
                          <?php endwhile; ?>
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
                  <td width="100"><input type="image" src="images/but_del_selected.gif" align="middle"  name="Deleteall" value="Delete Selected" ></td>
                  <td align="center" class="text_black12_bold"><?php echo $GenericEasyPagination->getNavigation_prev(); ?>
							<?php echo $GenericEasyPagination->getCurrentPages(); ?>
							<?php echo $GenericEasyPagination->getNavigation_next(); ?></td>
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
                      </tr>
                    </table>
                </form>
                    </td>
              </tr>
            </table></td>
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