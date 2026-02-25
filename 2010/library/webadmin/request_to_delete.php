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
if($_GET[actions]=="del"){
	ADOdb_Active_Record::SetDatabaseAdapter($db);
	class request_information extends ADOdb_Active_Record{}
	$request_information = new request_information();
	$request_information->load("request_id=?", array($_GET[request_id]));
	$request_information->Delete();
	if($request_information):
		$getdata[msg].="<meta http-equiv=\"refresh\" content=\"0; URL=request_to_delete.php?page=".$_GET[page]."\">";	
		saverecord('Delete Suggestion');	
	endif ;	
} 
//
 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page);

$SQLstr = "SELECT * FROM request_informations ORDER BY request_id DESC ";
 $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);					
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
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
                <td align="right" class="arialVIO24B">SUGGESTION</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_request.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Delete Suggestion</span></td>
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
            <td><form name="form1" method="post" action="request_action.php" style="margin:0;" onSubmit="return checkForm();"><?php if (!$rs->EOF):?>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td><table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                      <tr align="center" bgcolor="#1bb3b3" class="arialWH11B">
                        <td width="30" height="25"><input type="checkbox" name="checkAll" id="checkAll" onClick="checkBox(this);"></td>
                        <td width="60">ID</td>
                        <td width="200">NAME</td>
                        <td>SUGGESTION</td>
                        <td width="80">READ</td>
                        <td width="80">DATE</td>
                        <td width="35">DEL</td>
                      </tr>
                    </table>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="30">&nbsp;</td>
                        </tr>
                    </table></td>
                </tr>
              </table>
  <?php  $i=1; while (!$rs->EOF): ?>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
                            <tr>
                              <td colspan="7" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                                  <tr>
                                    <td></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td width="30" align="center" class="text_gray_normal"><input type="checkbox" name="chkbox[<?php echo $rs->fields['request_id'] ?>]" id="chkbox" value="<?php echo $rs->fields['request_id'] ?>" onClick="swapCheckBox();"></td>
                              <td width="60" align="center" class="text_gray_normal"><a  href="request_view.php?request_id=<?php echo $rs->fields['request_id'] ?>" class="text_gray_normal">
							  <?php echo $i; ?></a></td>
                              <td width="200" class="text_gray_normal"><a href="request_view.php?request_id=<?php echo $rs->fields['request_id'] ?>" class="text_gray_normal" target="_blank"><?php echo $rs->fields['name'] ?></a></td>
                              <td class="text_gray_normal"><a href="request_view.php?request_id=<?php echo $rs->fields['request_id'] ?>" class="text_gray_normal" target="_blank"><?php echo $rs->fields['question'] ?></a></td>
                              <td width="80" align="center" class="text_gray_normal"><?php echo $rs->fields['reads_status'] ?></td>
                              <td width="80" align="center" class="arialGREY11nor"><?php echo time_edit($rs->fields['request_date'],1)?></td>
                              <td width="35" align="center" class="arialGREY11nor"><a href="?actions=del&request_id=<?php echo $rs->fields['request_id'] ?>&page=<?php echo $_GET["page"] ;?>" onClick="return  confirm('Do you want to delete? ');"><img src="images/del_button.gif" width="13" height="13" border="0"></a></td>
                            </tr>
                        </table></td>
                      </tr>
                    </table>
                  <?php $i++; $rs->MoveNext(); ?>
				  <?php  endwhile;?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#def8f8">
                <tr>
                  <td></td>
                </tr>
              </table>
              <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input type="hidden" name="MM_action" value="delete" /></td>
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
              <?php  else : ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td align="center" class="text_red_bold">Sorry ! I Can Find Nothing.</td>
    </tr>
  </table>
 <?php  endif; ?>
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
<?php
	unset($getdata);
	unset($getpage);
	mysql_close(); 
?>