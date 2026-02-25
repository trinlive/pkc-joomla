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
 
?>
<?php 
#$db->debug = 1 ;
switch($_POST['MM_action']):
	//  save 
	case 'create' : 
		#	$db->debug=1;
			$getdata[imagetopic]="Add Images News";
				$gettmp[nid]=$_POST['nid'];
				#$gettmp[image]=$_FILES['image'];
				$gettmp[caption]= $_POST['caption'];
				$gettmp[image_active]=$_POST['image_active'];
				
				ADOdb_Active_Record::SetDatabaseAdapter($db);
					class news_image extends ADOdb_Active_Record{}
						$news_image = new news_image();
						$news_image->nid = $gettmp['nid'];
						$news_image->caption = $gettmp['caption'];
						$news_image->image_active = $gettmp['image_active'];

				$handle = new upload($_FILES['image2']);
				if ($handle->uploaded) :
					$handle->image_convert = 'jpg';
					$handle->file_name_body_add = '_imgnew';
					$handle->file_auto_rename = true;
					$handle->Process('../img_news/fullsize/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$news_image->image2 = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				###
				$thmhandle = new upload('../img_news/fullsize/'.$handle->file_dst_name);
	
				if ($thmhandle->uploaded) :
				$thmhandle->image_resize		= true;
				$thmhandle->image_x			= 90;
				$thmhandle->image_y			= 68;	
				$thmhandle->image_convert = 'jpg';
				$thmhandle->image_ratio = true;
				$thmhandle->file_auto_rename = true;
			//	$thmhandle->image_ratio_y = true;
			//	$thmhandle->image_ratio_x = true;
				$thmhandle->Process('../img_news/thumbnail/');
	
					if ($thmhandle->processed):
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$news_image->image = $new_imagename2 ;
		#			$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
				###				
				endif;
				 

	
 

		$imagecommit = $news_image->save();
		$id =  $news_image->id ; //product id
	if($imagecommit) : // 
			$getdata[msg]="Add Images News Completed !!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='image_news_new.php?nid=$gettmp[nid]'  class='arialVIO12B3'>Add Images News</a>";	
			saverecord('Add Images News');		
		else :
			$getdata[msg]="<span class=\"arialred12B\">Add Images News Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	break;

	case 'update' :
		$getdata[imagetopic]="Edit Images News";		
		$gettmp[news_cate]= '1' ;
		
		$nid = $_POST['nid'];
		
		$gettmp[id]= $_POST['id'];
		$gettmp[nid]= $_POST['nid'];
		$gettmp[caption]= $_POST['caption'] ;
		$gettmp[image_active]= $_POST['image_active'] ;
		
		$gettmp[pimage]=$_POST['pimage'];
		$gettmp[pimage2]=$_POST['pimage2'];      
			
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_image extends ADOdb_Active_Record{}
				$news_image = new news_image();
				$news_image->load("id=?", array($gettmp[id]));
				$news_image->nid = $gettmp[nid];
				$news_image->caption = $gettmp['caption'];
				$news_image->image_active = $gettmp['image_active'];
				$news_image->replace();
			//	$id = $news_image->id ; //image id
			
				$handle = new upload($_FILES['image2']);
				if ($handle->uploaded) :
					$handle->image_convert = 'jpg';
					$handle->file_name_body_add = '_imgnew';
					$handle->file_auto_rename = true;
					$handle->Process('../img_news/fullsize/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$news_image->image2 = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				####
				$thmhandle = new upload('../img_news/fullsize/'.$handle->file_dst_name);
	
				if ($thmhandle->uploaded) :
				$thmhandle->image_resize		= true;
				$thmhandle->image_x			= 90;
				$thmhandle->image_y			= 68;	
				$thmhandle->image_convert = 'jpg';
				$thmhandle->image_ratio = true;
				$thmhandle->file_auto_rename = true;
			//	$thmhandle->image_ratio_y = true;
			//	$thmhandle->image_ratio_x = true;
				$thmhandle->Process('../img_news/thumbnail/');
	
					if ($thmhandle->processed):
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$news_image->image = $new_imagename2 ;
		#			$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
				####	
				endif;
				 
				

		if($news_image->replace()):// 	
			$getdata[msg]="Update Images News Completed !!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='image_news_edit.php?id=$gettmp[id]&nid=$nid'  class='arialVIO12B3'>Edit Images News</a>";					
			saverecord('Edit Images News');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Data Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	
	break;

	case 'delete' : 
		$getdata[imagetopic]="Delete Image News";		
		$gettmp[news_cate]= '1' ;		
		$nid = $_POST['nid'];
		
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_image extends ADOdb_Active_Record{}
			$news_image = new news_image();
				foreach($_POST['chkbox'] as $row=>$gettmpid) :
				#	$gettemp[nid] = $_POST['nid'][$row];
					$SQLstr = "SELECT * FROM news_images WHERE id = '".$gettmpid."' ";
					$rs = $db->Execute($SQLstr);
	
					$gettmp[pimage]=$rs->fields['image'];
					$gettmp[pimage2]=$rs->fields['image2'];
	
					if ($gettmp[pimage] != "") :
						if(file_exists("../img_news/thumbnail/$gettmp[pimage]")) unlink("../img_news/thumbnail/$gettmp[pimage]");
					endif ;
					if ($gettmp[pimage2] != "") :
						if(file_exists("../img_news/fullsize/$gettmp[pimage2]")) unlink("../img_news/fullsize/$gettmp[pimage2]");
					endif ; 
					
					$news_image->load("id=?", array($gettmpid));
					$news_image->Delete();
				endforeach ;
		
		if($news_image) : // 
			$getdata[msg]="Delete Images News Completed !!<br>";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"5; URL=image_news_to_delete3.php?nid=$nid \">";	
			saverecord('Delete Images News');			
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Images News Not Completed !!</span><br>";
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
            <td><table width="100%" height="200"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#eeeeee" class="border_response">
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