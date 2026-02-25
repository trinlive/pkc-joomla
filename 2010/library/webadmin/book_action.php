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
		$getdata[imagetopic]="Add catebook";		
		$gettmp[cate_book]= $_POST['cate_book'];
		$gettmp[book_number]= $_POST['book_number'];
		$gettmp[subid_book]= $_POST['subid_book'];
		$gettmp[book_name]= $_POST['book_name'];
		$gettmp[book_type]= $_POST['book_type'];
		$gettmp[book_num]= $_POST['book_num'];
		$gettmp[book_year]= $_POST['book_year'];
		$gettmp[book_ower]=$_POST['book_ower'];
		$gettmp[book_code]=$_POST['book_code'];
		$gettmp[book_note]=$_POST['book_note'];
		$gettmp[book_now]=$_POST['book_now'];
		$gettmp[book_status]=$_POST['book_status'];		
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[book_date]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];

		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class book_librarie extends ADOdb_Active_Record{}
			$book_librarie = new book_librarie();		
			$book_librarie->cate_book = $gettmp['cate_book'];
			$book_librarie->book_number = $gettmp['book_number'];
			$book_librarie->subid_book = $gettmp['subid_book'];
			$book_librarie->book_name = $gettmp['book_name'];
			$book_librarie->book_type = $gettmp['book_type'];
			$book_librarie->book_num = $gettmp['book_num'];
			$book_librarie->book_year = $gettmp['book_year'];
			$book_librarie->book_ower =$gettmp['book_ower'];
			$book_librarie->book_code =$gettmp['book_code'];
			$book_librarie->book_note =$gettmp['book_note'];
			$book_librarie->book_now =$gettmp['book_now'];
			$book_librarie->book_date =$gettmp['book_date'];
			$book_librarie->book_status =$gettmp['book_status'];
			
	    $list = explode("-",$_FILES['image']['type']);
				$handle = new upload($_FILES['image']);
				if($list[2] != "flash"):
					$handle->image_convert = 'jpg';
				endif;	
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					$handle->Process('../img_pro/flash/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$product->image = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
	
			if($_FILES['file2'] != ''):
				$handle = new upload($_FILES['file2']);
				$handle->image_convert = 'jpg';
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					$handle->Process('../img_book/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$book_librarie->book_images = $new_imagename ;
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
				$thmhandle->Process('../img_pro/fullsize/');
	
					if ($thmhandle->processed):
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$book_librarie->image2 = $new_imagename2 ;
					$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
			endif ;
		if($book_librarie->save()) : // 
		$book_id =  $book_librarie->book_id ; 
				$getdata[msg].="Add Product Completed !!";
				$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='image_product_new.php?tid=$tid'  class='arialVIO12B3'>Add Image Product</a>";	
				saverecord('Add Product');		
			else :
				$getdata[msg].="<span class=\"arialred12B\">Add Product Not Completed !!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;	
	
	 break;

	case 'update' :
	//print_r($_POST);
		$getdata[imagetopic]="Edit Book";				
		$gettmp[book_id]= $_POST['book_id'];
		$gettmp[book_number]= $_POST['book_number'];
		$gettmp[cate_book]= $_POST['cate_book'] ;
		$gettmp[subid_book]= $_POST['subid_book'] ;
		$gettmp[book_name]= $_POST['book_name'] ;
		$gettmp[book_type]= $_POST['book_type'] ;
		$gettmp[book_num]= $_POST['book_num'] ;
		$gettmp[book_year]= $_POST['book_year'] ;
		$gettmp[book_ower]=$_POST['book_ower'];
		$gettmp[book_code]=$_POST['book_code'];
		$gettmp[book_note]=$_POST['book_note'];
		$gettmp[book_now]=$_POST['book_now'];
		$gettmp[book_images]=$_POST['book_images'];
		$gettmp[book_date]=$_POST['book_date'];
		$gettmp[book_status]=$_POST['book_status'];
		$gettmp[ndate]=$_POST[ndate];
		$gettmp[nmonth]=$_POST[nmonth];
		$gettmp[nyear]=$_POST[nyear];
		$gettmp[book_date]=$gettmp[nyear]."-".$gettmp[nmonth]."-".$gettmp[ndate];
		
		$gettmp[pimage1]=$_POST['pimage1'];
		$gettmp[pimage2]=$_POST['pimage2'];   
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class book_librarie extends ADOdb_Active_Record{}
			$book_librarie = new book_librarie();
			$book_librarie->load("book_id=?", array($gettmp[book_id]));
			$book_librarie->cate_book = $gettmp['cate_book'];
			$book_librarie->book_number = $gettmp['book_number'];
			$book_librarie->subid_book = $gettmp['subid_book'];
			$book_librarie->book_name = $gettmp['book_name'];
			$book_librarie->book_type = $gettmp['book_type'];
			$book_librarie->book_num = $gettmp['book_num'];
			$book_librarie->book_year = $gettmp['book_year'];
			$book_librarie->book_ower = $gettmp['book_ower'];
			$book_librarie->book_code =$gettmp['book_code'];
			$book_librarie->book_note =$gettmp['book_note'];
			$book_librarie->book_now =$gettmp['book_now'];
			$book_librarie->book_images =$gettmp['book_images'];
			$book_librarie->book_date =$gettmp['book_date'];
			$book_librarie->book_status =$gettmp['book_status'];	
			$list = explode("-",$_FILES['image']['type']);
				$handle = new upload($_FILES['image']);
				if($list[2] != "flash"):
				$handle->image_convert = 'jpg';
				endif;
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					if ($product->image != "") :
						if(file_exists('../img_pro/flash/'.$product->image)) unlink('../img_pro/flash/'.$product->image);
						endif ;
					$handle->Process('../img_pro/flash/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$product->image = $new_imagename ;
					$handle->clean();
					else:
						echo 'error : ' . $handle->error;
					endif;
				endif;

		
				$book_id = $gettmp['book_id'] ;
			
				$handle2 = new upload($_FILES['file1']);
				$handle2->image_convert = 'jpg';
				$handle2->file_name_body_add = '_imgnew';
				$handle2->file_auto_rename = true;
				if ($handle2->uploaded) :
					if ($product->file1 != "") :
								if(file_exists("../img_pro/tiny/".$product->image3)) unlink("../img_pro/tiny/".$product->image3);
								endif ;
					$handle2->Process('../img_pro/tiny/');
					if ($handle2->processed) :
					$new_imagename3 = $handle2->file_dst_name  ;
					$product->image3 = $new_imagename3 ;
					$handle2->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;


				$handle = new upload($_FILES['file2']);
				$handle->image_convert = 'jpg';
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					if ($product->file2 != "") :
								if(file_exists("../img_book/thumbnail/".$book_librarie->book_images)) unlink("../img_book/thumbnail/".$book_librarie->book_images);
								endif ;
					$handle->Process('../img_book/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$book_librarie->book_images = $new_imagename ;
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
				$thmhandle->Process('../img_pro/fullsize/');
	
					if ($thmhandle->processed):
										if ($product->image2 != "") :
								if(file_exists("../img_pro/fullsize/".$product->image2)) unlink("../img_pro/fullsize/".$product->image2);
								endif ;
					$new_imagename2 =  $thmhandle->file_dst_name ; 
					$product->image2 = $new_imagename2 ;
		#			$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
		
		if($book_librarie->replace()):// 	
			$getdata[msg]="Update Book Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='book_edit.php?book_id=$gettmp[book_id]' class=\"arialVIO12B3\">Edit Product</a>";					
			saverecord('Edit Tips');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Product Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case "delete" :{
		$getdata[imagetopic]="Delete Press Center";

		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class book_librarie extends ADOdb_Active_Record{}
			$book_librarie = new book_librarie();
				foreach($_POST[chkbox] AS $gettmp[book_id]) :
					#	$gettemp[nid] = $_POST['nid'][$row];	
					$SQLstr = " SELECT book_images FROM `book_libraries` WHERE `book_id` =  '".$gettmp[book_id]."' ";
					//print_r($SQLstr);
 					$rs = $db->Execute($SQLstr) ;
					
 					$fileatt = $rs->fields['book_images'] ;
	  					if ($fileatt != "") :
							if(file_exists("../img_book/thumbnail/$fileatt")) unlink("../img_book/thumbnail/$fileatt");
	 					endif ;
					
					$book_librarie->load("book_id=?", array($gettmp[book_id]));
					$book_librarie->Delete();
				endforeach ;
		if ($book_librarie) :	
			saverecord('Delete Book');	
			$getdata[msg]="Delete Book Completed !!<br>";
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=book_to_delete.php\">";	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Book Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;
	}break;
endswitch ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ADMIN CONTROL PANEL PAKKRETCITY ::</title>
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