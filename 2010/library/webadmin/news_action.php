<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.upload.foto.php'; 
  require_once 'class/class.upload2.php'; 
?>
<?php
 $max_size = 2*1024*1024 ; // the max. size for uploading (~2MB)
define("MAX_SIZE", $max_size);
 $withapp = false ;
 $withapp2 = false ;
 $withapp3 = false ;
# $db->debug=1; 
?>
<?php
switch($_POST['MM_action']):
	//  save 
	case 'create' : 
		$getdata[imagetopic]="Add News";				
		$gettmp[subject]= $_POST['subject'] ;
		$gettmp[description]= $_POST['description'] ;
		$gettmp[detail]= $_POST['detail'] ;
		$gettmp[filerem]=$_POST['filerem'];
		$gettmp[news_active]=$_POST['news_active'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_news]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		$gettmp[news_type]= $_POST['news_type'] ;
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news extends ADOdb_Active_Record{}
			$news = new news();		
			$news->subject = $gettmp['subject'];
			$news->description = $gettmp['description'];
			$news->detail = $gettmp['detail'];
			$news->filerem = $gettmp['filerem'];		
			$news->date_news =$gettmp['date_news'];
			$news->news_active =$gettmp['news_active'];
			$news->news_type = $gettmp['news_type'];
	
			
				$handle2 = new upload($_FILES['image3']);
				$handle2->image_convert = 'jpg';
				$handle2->file_name_body_add = '_imgnew';
				$handle2->file_auto_rename = true;
				if ($handle2->uploaded) :
					$handle2->Process('../img_news/tiny/');
					if ($handle2->processed) :
					$new_imagename3 = $handle2->file_dst_name  ;
					$news->image3 = $new_imagename3 ;
					$handle2->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
			
				$handle = new upload($_FILES['image']);
				$handle->image_convert = 'jpg';
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					$handle->Process('../img_news/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$news->image = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
				 
				$thmhandle = new upload($_FILES['image2']);
				$issize = getimagesize($_FILES['image2'][tmp_name]);
				if ($thmhandle->uploaded) :
				if ($issize[0] > 542 ) :  
				$thmhandle->image_resize	= true;
				$thmhandle->image_x			= 542;
				$thmhandle->image_convert = 'jpg';
				$thmhandle->file_auto_rename = true;
				$thmhandle->image_ratio_y = true;
				endif ;
				$thmhandle->Process('../img_news/fullsize/');
	
					if ($thmhandle->processed):
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$news->image2 = $new_imagename2 ;
		#			$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
	
		if($news->save()) : // 
		$nid =  $news->nid ; 
				$getdata[msg].="Add News Completed !!";
				$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='image_news_new.php?nid=$nid'  class='arialVIO12B3'>Add Image News</a>";	
				saverecord('Add News &amp; Event');		
			else :
				$getdata[msg].="<span class=\"arialred12B\">Add News Not Completed !!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;	
	
	 break;

	case 'update' :
		$getdata[imagetopic]="Edit News";				
		$gettmp[nid]= $_POST['nid'];
		$gettmp[subject]= $_POST['subject'] ;
		$gettmp[description]= $_POST['description'] ;
		$gettmp[detail]= $_POST['detail'] ;
		$gettmp[filerem]=$_POST['filerem'];
		$gettmp[fileatt]=$_POST['fileatt'];
		$gettmp[news_active]=$_POST['news_active'];
		$gettmp[news_type]=$_POST['news_type'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_news]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp[pimage]=$_POST['pimage'];
		$gettmp[pimage2]=$_POST['pimage2'];   
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news extends ADOdb_Active_Record{}
			$news = new news();
			$news->load("nid=?", array($gettmp[nid]));
			$news->news_type = $gettmp['news_type'];
			$news->subject = $gettmp['subject'];
			$news->description = $gettmp['description'];
			$news->detail = $gettmp['detail'];
			$news->filerem = $gettmp['filerem'];
			$news->news_active = $gettmp['news_active'];
			$news->date_news =$gettmp['date_news'];	
			
			
							$handle2 = new upload($_FILES['image3']);
				$handle2->image_convert = 'jpg';
				$handle2->file_name_body_add = '_imgnew';
				$handle2->file_auto_rename = true;
				if ($handle2->uploaded) :
					if ($news->image3 != "") :
								if(file_exists("../img_news/tiny/".$news->image3)) unlink("../img_news/tiny/".$news->image3);
								endif ;
					$handle2->Process('../img_news/tiny/');
					if ($handle2->processed) :
					$new_imagename3 = $handle2->file_dst_name  ;
					$news->image3 = $new_imagename3 ;
					$handle2->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;


				$handle = new upload($_FILES['image']);
				$handle->image_convert = 'jpg';
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					if ($news->image != "") :
								if(file_exists("../img_news/thumbnail/".$news->image)) unlink("../img_news/thumbnail/".$news->image);
								endif ;
					$handle->Process('../img_news/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$news->image = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
				 
				$thmhandle = new upload($_FILES['image2']);
				$issize = getimagesize($_FILES['image2'][tmp_name]);
				if ($thmhandle->uploaded) :
				if ($issize[0] > 542 ) :  
				$thmhandle->image_resize		= true;
				$thmhandle->image_x			= 542;
				$thmhandle->image_convert = 'jpg';
				$thmhandle->file_auto_rename = true;
				$thmhandle->image_ratio_y = true;
				endif ;
				$thmhandle->Process('../img_news/fullsize/');
	
					if ($thmhandle->processed):
										if ($news->image2 != "") :
								if(file_exists("../img_news/fullsize/".$news->image2)) unlink("../img_news/fullsize/".$news->image2);
								endif ;
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$news->image2 = $new_imagename2 ;
		#			$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
		
		if($news->replace()):// 	
			$getdata[msg]="Update News Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='news_edit.php?nid=$gettmp[nid]' class=\"arialVIO12B3\">Edit News</a>";					
			saverecord('Edit News &amp; Event');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update News Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case 'delete' : 
		$getdata[imagetopic]="Delete News";		
		$news_type = $_POST['news_type'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news extends ADOdb_Active_Record{}
			$news = new news();
				foreach($_POST['chkbox'] as $row=>$gettmpnid) :
				#	$gettemp[nid] = $_POST['nid'][$row];	
				$SQLstr = " SELECT * FROM `newses` WHERE `newses`.`nid` =  '".$gettmpnid."' ";
 				$rsdel = $db->Execute($SQLstr) ;
					
					$pimage = $rsdel->fields['image'] ;
						if ($pimage != "") :
							if(file_exists("../img_news/thumbnail/$pimage")) unlink("../img_news/thumbnail/$pimage");
					 	endif ;
					$pimage2 = $rsdel->fields['image2'] ;
	  					if ($pimage2 != "") :
							if(file_exists("../img_news/fullsize/$pimage2")) unlink("../img_news/fullsize/$pimage2");
						endif ;
 					$pimage3 = $rsdel->fields['fileatt'] ;
	  					if ($pimage3 != "") :
							if(file_exists("../img_news/file/$pimage3")) unlink("../img_news/file/$pimage3");
	 					endif ;
					
				$SQLstr2 = " SELECT * FROM `news_images` WHERE `news_images`.`nid` =  '".$gettmpnid."' ";
 				$rsdel2 = $db->Execute($SQLstr2) ;
					while (!$rsdel2->EOF):
						$pic_pimage = $rsdel2->fields['image'] ;
						if ($pic_pimage != "") :
							if(file_exists("../img_news/thumbnail/$pic_pimage")) unlink("../img_news/thumbnail/$pic_pimage");
						endif ;	
						$pic_pimage2 = $rsdel2->fields['image2'] ;
						if ($pic_pimage2 != "") :
							if(file_exists("../img_news/fullsize/$pic_pimage2")) unlink("../img_news/fullsize/$pic_pimage2");
						endif ;
					
						$stmtdel2 = $db->Prepare('DELETE news_images FROM news_images WHERE news_images.id =? ');
 						$del2 = $db->Execute($stmtdel2,array($rsdel2->fields['id'])) ;
					$rsdel2->MoveNext(); 
                    endwhile; 
							
					$stmtdel = $db->Prepare('DELETE newses FROM newses WHERE newses.nid =? ');
 					$rsdel = $db->Execute($stmtdel,array($gettmpnid)) ;
				endforeach ;
	
		if($news):
			$getdata[msg]="Delete News Completed !!";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=news_to_delete2.php?news_type=$news_type \">";	
			saverecord('Delete News &amp; Event');				
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete News Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	break;
endswitch ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
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
                <td align="right" class="arialVIO24B">NEWS</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_news.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ; ?></span></td>
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