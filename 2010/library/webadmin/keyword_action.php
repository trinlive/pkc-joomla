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
 $max_size = 4*1024*1024 ; // the max. size for uploading (~2MB)
define("MAX_SIZE", $max_size);
 $withapp = false ;
 $withapp2 = false ;
 #$db->debug=1;
?>
<?php
switch($_POST['MM_action']):
	//  save 
	case 'create' : 
		$getdata[imagetopic]="Add Page";		
		
		$gettmp['cate_page']= 1 ;
		
		$gettmp['url']= $_POST['url'] ;
		//$gettmp['en_url']= $_POST['en_url'] ;
		
		$gettmp['topic']= $_POST['topic'] ;
		//$gettmp['en_topic']= $_POST['en_topic'] ; 
		
		$gettmp['sdetail']= $_POST['sdetail'] ;
		//$gettmp['en_sdetail']= $_POST['en_sdetail'] ;

		$gettmp['keyword']= $_POST['keyword'] ;
		//$gettmp['en_keyword']= $_POST['en_keyword'] ;
		
		$gettmp['postday']=$_POST['postday'];
		$gettmp['postmonth']=$_POST['postmonth'];
		$gettmp['postyear']=$_POST['postyear'];
		$gettmp['date_page']=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp['page_active']=$_POST['page_active'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class page extends ADOdb_Active_Record{}
			$page = new page();
			
			$page->cate_page = $gettmp['cate_page'];
			
			$page->url = $gettmp['url'];
			//$page->en_url = $gettmp['en_url'];
			
			$page->caption = $gettmp['topic'];
			//$page->en_caption = $gettmp['en_topic'];
			
			$page->description = $gettmp['sdetail'];
			//$page->en_description = $gettmp['en_sdetail'];
			
			$page->keyword = $gettmp['keyword'];
			//$page->en_keyword = $gettmp['en_keyword'];
			
			$page->date_page = $gettmp['date_page'];
			$page->page_active = $gettmp['page_active'];
			
		if($page->save()) : // 
			$getdata[msg].="Add Page Completed !!";
		#	$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='link_new.php'  class='arialVIO12B3'>Add Link</a>";	
				saverecord('Add Page');		
			else :
				$getdata[msg].="<span class=\"arialred12B\">Add Page not Completed !!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;	
	
	 break;

	case 'update' :
		#$db->debug=1;
		$getdata['imagetopic']="Edit Page";		
		
		$gettmp['page_id']= $_POST['page_id'] ;
			
		$gettmp['cate_page']= 1 ;
		
		$gettmp['url']= $_POST['url'] ;
		//$gettmp['en_url']= $_POST['en_url'] ;
		
		$gettmp['topic']= $_POST['topic'] ;
		//$gettmp['en_topic']= $_POST['en_topic'] ; 
		
		$gettmp['sdetail']= $_POST['sdetail'] ;
		//$gettmp['en_sdetail']= $_POST['en_sdetail'] ;

		$gettmp['keyword']= $_POST['keyword'] ;
		//$gettmp['en_keyword']= $_POST['en_keyword'] ;
		
		$gettmp['postday']=$_POST['postday'];
		$gettmp['postmonth']=$_POST['postmonth'];
		$gettmp['postyear']=$_POST['postyear'];
		$gettmp['date_page']=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp['page_active']=$_POST['page_active'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class page extends ADOdb_Active_Record{}
			$page = new page();
			$page->load("page_id=?", array($gettmp['page_id']));
			$page->cate_page = $gettmp['cate_page'];
			$page->url = $gettmp['url'];
			//$page->en_url = $gettmp['en_url'];
			$page->caption = $gettmp['topic'];
			//$page->en_caption = $gettmp['en_topic'];
			$page->description = $gettmp['sdetail'];
			//$page->en_description = $gettmp['en_sdetail'];
			$page->keyword = $gettmp['keyword'];
			//$page->en_keyword = $gettmp['en_keyword'];
			$page->date_page = $gettmp['date_page'];
			$page->page_active = $gettmp['page_active'];
	
		if($page->replace()):// 	
			$getdata[msg]="Update Page Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='page_edit.php?page_id=$gettmp[page_id]' class=\"arialVIO12B3\">Edit Page</a>";					
			saverecord('Edit Page');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Page not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case 'delete' : 
		$getdata[imagetopic]="Delete Page";		
		
		
				foreach($_POST['chkbox'] as $row=>$gettmp['page_id']) :
				
	 $stmtdelpdf = $db->Prepare("DELETE pdf_pages FROM pdf_pages WHERE pdf_pages.page_id =? ");
 	 $rsdelpdf = $db->Execute($stmtdelpdf,array($gettmp['page_id'])) ;					
	
	 $stmtdelpage = $db->Prepare("DELETE pages FROM pages WHERE pages.page_id =? ");
 	 $rsdelpage = $db->Execute($stmtdelpage,array($gettmp['page_id'])) ;				

				endforeach ;
	
		if($rsdelpage):
			$getdata[msg]="Delete Page Completed !!";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=page_to_delete.php \">";	
			saverecord('Delete Page');				
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Page not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	break;
endswitch ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI  CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
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
                <td align="right" class="arialVIO24B">PAGE KEYWORD </td>
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
            <td width="233" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ; ?></span></td>
            <td width="321" align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
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
            <td><table width="100%" height="220"  border="0" align="center" cellpadding="0" cellspacing="0" class="border_response">
              <tr valign="middle">
                <td align="center" class="arialVIO12B2"><?php echo $getdata[msg]; ?></td>
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