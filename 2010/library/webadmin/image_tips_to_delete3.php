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
$tid = $_GET['tid'];
//ลบข้อมูล
if($_GET[actions]=="del"):
	$gettmp[id]=$_GET["id"];	
	
	$SQLstr = "SELECT * FROM tips_images WHERE id = '".$gettmp[id]."' ";
	$rs = $db->Execute($SQLstr);
	
	$gettmp[pimage1]=$rs->fields['image1'];
	$gettmp[pimage2]=$rs->fields['image2'];
	
	if ($gettmp[pimage1] != "") :
		if(file_exists("../img_tips/thumbnail/$gettmp[pimage1]")) unlink("../img_tips/thumbnail/$gettmp[pimage1]");
	endif ;
	if ($gettmp[pimage2] != "") :
		if(file_exists("../img_tips/fullsize/$gettmp[pimage2]")) unlink("../img_tips/fullsize/$gettmp[pimage2]");
	endif ;
	
	ADOdb_Active_Record::SetDatabaseAdapter($db);
	class tips_image extends ADOdb_Active_Record{}
	$tips_image = new tips_image();
	$tips_image->load("id=?", array($gettmp[id]));
	$tips_image->Delete();
	if($tips_image):
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=image_tips_to_delete3.php?tid=$tid\">";	
			saverecord('Delete tips Image');	
	endif ;	
endif ;
?>
<?php
 if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',20);
 define ('CURRENT_PAGE',$page); 

$tid = $_GET['tid'] ;

$SQLstr = "SELECT
`tips_images`.`id`,
`tips_images`.`tid`,
`tips_images`.`caption`,
`tips_images`.`image1`,
`tips_images`.`image2`,
`tips_images`.`image_active`,
`tips`.`subject`
FROM
`tips_images`
Inner Join `tips` ON `tips`.`tid` = `tips_images`.`tid` WHERE `tips_images`.`tid` = '".$tid."' ORDER BY tips_images.id  ";
# $db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO.,LTD. ::</title>
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
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head05.gif">
          <tr>
            <td width="228" height="29"><span class="arialWH18B" style="margin-left:8px;">Delete Image Tips</span></td>
            <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
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
            <td><form action="image_tips_action.php" method="post" name="form1" id="form1" style="margin:0" onSubmit="return checkForm();">
			<?php if (!$rs->EOF):?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="2" cellpadding="0" bordercolor="#F7F7F7" align="center">
                                <tr bgcolor="#1bb3b3">
                                  <td width="60" height="25" align="center" class="arialWH11B"><input type="checkbox" name="All" id="checkAll" onClick="checkBox(this);"></td>
                                  <td width="60" align="center" class="arialWH11B">ID</td>
                                  <td align="center" class="arialWH11B">IMAGES</td>
                                  <td width="80" align="center" class="arialWH11B">STATUS</td>
                                  <td width="35" align="center" class="arialWH11B">DEL</td>
                                </tr>
                              </table>
							    <table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
							    <?php  $i=1; while (!$rs->EOF): ?>
        <table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
          <tr>
            <td colspan="5" align="center" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#E5D9EC">
      <tr>
        <td></td>
      </tr>
    </table></td>
            </tr>
          
          <tr>
            <td width="60" align="center" valign="top" class="text_gray_normal"><input type="checkbox" name="chkbox[]" id="chkbox" value="<?php echo  $rs->fields['id'] ?>" onClick="swapCheckBox();" /></td>
              <td width="60" align="center" valign="top" class="text_gray_normal"><?php echo $i; ?></td>
              <td valign="top" class="text_gray_normal"><a href="image_tips_edit.php?id=<?php echo $rs->fields['id'] ?>" class="text_gray_normal"><img src="../img_tips/thumbnail/<?php echo $rs->fields['image1']?>" border="0"></a></td>
              <td width="80" align="center" class="arialGREY11nor"><?php if ($rs->fields['image_active'] == 'Active'):
				echo '<b><font color="#0000FF">SHOW</font></b>';
				else:
				echo '<b><font color="#FF0000">HIDE</font></b>';
				endif; ?></td>
              <td width="35" class="text_gray_normal" align="center"><a href="?actions=del&id=<?php echo $rs->fields['id'] ?>&tid=<?php echo $tid ?>" onClick="return  confirm('Do you want to delete? ');"><img src="images/del_button.gif" width="13" height="13" border="0"></a></td>
          </tr>
             </table>  
          <?php $rs->MoveNext(); $i++; ?>
          <?php endwhile; ?>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#E5D9EC">
  <tr>
    <td></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"><input type="hidden" name="MM_action" value="delete" />
      <input name="tid" type="hidden" id="tid" value="<?php echo $tid ?>" /></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
  <tr>
    <td height="16"></td>
  </tr>
</table>
          <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
                      <td colspan="5" class="text_gray_normal">
                          <input type="image" src="images/but_del_selected.gif" align="middle"  name="Deleteall" value="Delete Selected"></td>
  </tr>
</table>
</td></tr>
                        </table>
              <?php else:?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td align="center" class="text_red_bold">Sorry ! I Can Find Nothing.</td>
                </tr>
              </table>
              <?php endif;?></form></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="100">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td height="55" valign="top"><?php include ("inc/inc_footer.php") ?></td>
  </tr>
</table>
</body>
</html>