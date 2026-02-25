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
		$getdata[imagetopic]="Add Tips";				
		$gettmp[subject]= $_POST['subject'] ;
		$gettmp[description]= $_POST['description'] ;
		$gettmp[detail]= $_POST['detail'] ;
		$gettmp[tips_active]=$_POST['tips_active'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_tips]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];

		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class tip extends ADOdb_Active_Record{}
			$tip = new tip();		
			$tip->subject = $gettmp['subject'];
			$tip->description = $gettmp['description'];
			$tip->detail = $gettmp['detail'];
			$tip->date_tips =$gettmp['date_tips'];
			$tip->tips_active =$gettmp['tips_active'];

	
			if($_FILES['file2'] != ''):
				$handle = new upload($_FILES['file2']);
				$handle->image_convert = 'png';
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					$handle->Process('../img_tips/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$tip->image1 = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
				endif;
				if($_FILES['file3'] != ''):	 
				$thmhandle = new upload($_FILES['file3']);
				$issize = getimagesize($_FILES['file3'][tmp_name]);
				if ($thmhandle->uploaded) :
				if ($issize[0] > 542 ) :  
				$thmhandle->image_resize	= true;
				$thmhandle->image_x			= 542;
				$thmhandle->image_convert = 'jpg';
				$thmhandle->file_auto_rename = true;
				$thmhandle->image_ratio_y = true;
				endif ;
				$thmhandle->Process('../img_tips/fullsize/');
	
					if ($thmhandle->processed):
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$tip->image2 = $new_imagename2 ;
					$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
			endif ;
		if($tip->save()) : // 
		$tid =  $tip->tid ; 
				$getdata[msg].="Add Tips Completed !!";
				$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='image_tips_new.php?tid=$tid'  class='arialVIO12B3'>Add Image Tips</a>";	
				saverecord('Add Tips');		
			else :
				$getdata[msg].="<span class=\"arialred12B\">Add Tips Not Completed !!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;	
	
	 break;

	case 'update' :
		$getdata[imagetopic]="Edit Tips";				
		$gettmp[tid]= $_POST['tid'];
		$gettmp[subject]= $_POST['subject'] ;
		$gettmp[description]= $_POST['description'] ;
		$gettmp[detail]= $_POST['detail'] ;
		$gettmp[tips_active]=$_POST['tips_active'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_tips]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp[pimage1]=$_POST['pimage1'];
		$gettmp[pimage2]=$_POST['pimage2'];   
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class tip extends ADOdb_Active_Record{}
			$tip = new tip();
			$tip->load("tid=?", array($gettmp[tid]));
			$tip->subject = $gettmp['subject'];
			$tip->description = $gettmp['description'];
			$tip->detail = $gettmp['detail'];
			$tip->tips_active = $gettmp['tips_active'];
			$tip->date_tips =$gettmp['date_tips'];	
			
			
				$handle2 = new upload($_FILES['file1']);
				$handle2->image_convert = 'jpg';
				$handle2->file_name_body_add = '_imgnew';
				$handle2->file_auto_rename = true;
				if ($handle2->uploaded) :
					if ($tip->file1 != "") :
								if(file_exists("../img_tips/tiny/".$tip->image3)) unlink("../img_tips/tiny/".$tip->image3);
								endif ;
					$handle2->Process('../img_tips/tiny/');
					if ($handle2->processed) :
					$new_imagename3 = $handle2->file_dst_name  ;
					$tip->image3 = $new_imagename3 ;
					$handle2->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;


				$handle = new upload($_FILES['file2']);
				$handle->image_convert = 'png';
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					if ($tip->file2 != "") :
								if(file_exists("../img_tips/thumbnail/".$tip->image1)) unlink("../img_tips/thumbnail/".$tip->image1);
								endif ;
					$handle->Process('../img_tips/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$tip->image1 = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
				 
				$thmhandle = new upload($_FILES['file3']);
				$issize = getimagesize($_FILES['file3'][tmp_name]);
				if ($thmhandle->uploaded) :
				if ($issize[0] > 542 ) :  
				$thmhandle->image_resize		= true;
				$thmhandle->image_x			= 542;
				$thmhandle->image_convert = 'jpg';
				$thmhandle->file_auto_rename = true;
				$thmhandle->image_ratio_y = true;
				endif ;
				$thmhandle->Process('../img_tips/fullsize/');
	
					if ($thmhandle->processed):
										if ($tip->image2 != "") :
								if(file_exists("../img_tips/fullsize/".$tip->image2)) unlink("../img_tips/fullsize/".$tip->image2);
								endif ;
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$tip->image2 = $new_imagename2 ;
		#			$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
		
		if($tip->replace()):// 	
			$getdata[msg]="Update Tips Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='tips_edit.php?tid=$gettmp[tid]' class=\"arialVIO12B3\">Edit Tips</a>";					
			saverecord('Edit Tips');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Tips Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case 'delete' : 
		$getdata[imagetopic]="Delete Tips";		
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class tip extends ADOdb_Active_Record{}
			$tip = new tip();
				foreach($_POST['chkbox'] as $row=>$gettmpnid) :
				#	$gettemp[nid] = $_POST['nid'][$row];	
				$SQLstr = " SELECT * FROM `tips` WHERE `tips`.`tid` =  '".$gettmpnid."' ";
 				$rsdel = $db->Execute($SQLstr) ;
					
					$pimage1 = $rsdel->fields['image1'] ;
						if ($pimage != "") :
							if(file_exists("../img_tips/thumbnail/$pimage1")) unlink("../img_tips/thumbnail/$pimage1");
					 	endif ;
					$pimage2 = $rsdel->fields['image2'] ;
	  					if ($pimage2 != "") :
							if(file_exists("../img_tips/fullsize/$pimage2")) unlink("../img_tips/fullsize/$pimage2");
						endif ;
 					$pimage3 = $rsdel->fields['fileatt'] ;
	  					if ($pimage3 != "") :
							if(file_exists("../img_tips/file/$pimage3")) unlink("../img_tips/file/$pimage3");
	 					endif ;
					
				$SQLstr2 = " SELECT * FROM `tips_images` WHERE `tips_images`.`tid` =  '".$gettmpnid."' ";
 				$rsdel2 = $db->Execute($SQLstr2) ;
					while (!$rsdel2->EOF):
						$pic_pimage1 = $rsdel2->fields['image1'] ;
						if ($pic_pimage1 != "") :
							if(file_exists("../img_tips/thumbnail/$pic_pimage1")) unlink("../img_tips/thumbnail/$pic_pimage1");
						endif ;	
						$pic_pimage2 = $rsdel2->fields['image2'] ;
						if ($pic_pimage2 != "") :
							if(file_exists("../img_tips/fullsize/$pic_pimage2")) unlink("../img_tips/fullsize/$pic_pimage2");
						endif ;
					
						$stmtdel2 = $db->Prepare('DELETE tips_images FROM tips_images WHERE tips_images.id =? ');
 						$del2 = $db->Execute($stmtdel2,array($rsdel2->fields['id'])) ;
					$rsdel2->MoveNext(); 
                    endwhile; 
							
					$stmtdel = $db->Prepare('DELETE tips FROM tips WHERE tips.tid =? ');
 					$rsdel = $db->Execute($stmtdel,array($gettmpnid)) ;
				endforeach ;
	
		if($tip):
			$getdata[msg]="Delete Tips Completed !!";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=tips_to_delete.php \">";	
			saverecord('Delete Tips');				
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Tips Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	break;
endswitch ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ADMIN CONTROL PANEL SAKULTHITI CO.,LTD ::</title>
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