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
		$getdata[imagetopic]="Add Product";				
		$gettmp[name_product]= $_POST['name_product'] ;
		$gettmp[product_version]= $_POST['product_version'] ;
		$gettmp[description_product]= $_POST['description_product'] ;
		$gettmp[detail]= $_POST['detail'] ;
		$gettmp[product_price]= $_POST['product_price'] ;
		$gettmp[product_active]=$_POST['product_active'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_product]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];

		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class product extends ADOdb_Active_Record{}
			$product = new product();		
			$product->name_product = $gettmp['name_product'];
			$product->product_version = $gettmp['product_version'];
			$product->description_product = $gettmp['description_product'];
			$product->detail = $gettmp['detail'];
			$product->product_price = $gettmp['product_price'];
			$product->date_product =$gettmp['date_product'];
			$product->product_active =$gettmp['product_active'];
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
					$handle->Process('../img_pro/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$product->image1 = $new_imagename ;
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
					$product->image2 = $new_imagename2 ;
					$thmhandle->clean();
					else :
					echo 'error : ' . $thmhandle->error;
					endif ;
				endif ;
			endif ;
		if($product->save()) : // 
		$tid =  $product->tid ; 
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
		$getdata[imagetopic]="Edit Product";				
		$gettmp[tid]= $_POST['tid'];
		$gettmp[name_product]= $_POST['name_product'] ;
		$gettmp[product_version]= $_POST['product_version'] ;
		$gettmp[description_product]= $_POST['description_product'] ;
		$gettmp[detail]= $_POST['detail'] ;
		$gettmp[product_price]= $_POST['product_price'] ;
		$gettmp[product_active]=$_POST['product_active'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_product]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp[pimage1]=$_POST['pimage1'];
		$gettmp[pimage2]=$_POST['pimage2'];   
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class product extends ADOdb_Active_Record{}
			$product = new product();
			$product->load("tid=?", array($gettmp[tid]));
			$product->name_product = $gettmp['name_product'];
			$product->product_version = $gettmp['product_version'];
			$product->description_product = $gettmp['description_product'];
			$product->detail = $gettmp['detail'];
			$product->product_price = $gettmp['product_price'];
			$product->product_active = $gettmp['product_active'];
			$product->date_product =$gettmp['date_product'];	
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

		
				$tid = $gettmp['tid'] ;
			
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
								if(file_exists("../img_pro/thumbnail/".$product->image1)) unlink("../img_pro/thumbnail/".$product->image1);
								endif ;
					$handle->Process('../img_pro/thumbnail/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$pro->image1 = $new_imagename ;
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
		
		if($product->replace()):// 	
			$getdata[msg]="Update Product Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='product_edit.php?tid=$gettmp[tid]' class=\"arialVIO12B3\">Edit Product</a>";					
			saverecord('Edit Tips');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Product Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case 'delete' : 
		$getdata[imagetopic]="Delete Product";		
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class product extends ADOdb_Active_Record{}
			$product = new product();
				foreach($_POST['chkbox'] as $row=>$gettmpnid) :
				#	$gettemp[nid] = $_POST['nid'][$row];	
				$SQLstr = " SELECT * FROM `products` WHERE `products`.`tid` =  '".$gettmpnid."' ";
 				$rsdel = $db->Execute($SQLstr) ;
					
					$pimage = $rsdel->fields['image'] ;
						if ($pimage != "") :
							if(file_exists("../img_pro/flash/$pimage")) unlink("../img_pro/flash/$pimage");
					 	endif ;
					$pimage1 = $rsdel->fields['image1'] ;
						if ($pimage != "") :
							if(file_exists("../img_pro/thumbnail/$pimage1")) unlink("../img_pro/thumbnail/$pimage1");
					 	endif ;
					$pimage2 = $rsdel->fields['image2'] ;
	  					if ($pimage2 != "") :
							if(file_exists("../img_pro/fullsize/$pimage2")) unlink("../img_protips/fullsize/$pimage2");
						endif ;
 					$pimage3 = $rsdel->fields['fileatt'] ;
	  					if ($pimage3 != "") :
							if(file_exists("../img_pro/file/$pimage3")) unlink("../img_pro/file/$pimage3");
	 					endif ;
					
				$SQLstr2 = " SELECT * FROM `products_images` WHERE `products_images`.`tid` =  '".$gettmpnid."' ";
 				$rsdel2 = $db->Execute($SQLstr2) ;
					while (!$rsdel2->EOF):
						$pic_pimage1 = $rsdel2->fields['image1'] ;
						if ($pic_pimage1 != "") :
							if(file_exists("../img_pro/thumbnail/$pic_pimage1")) unlink("../img_pro/thumbnail/$pic_pimage1");
						endif ;	
						$pic_pimage2 = $rsdel2->fields['image2'] ;
						if ($pic_pimage2 != "") :
							if(file_exists("../img_pro/fullsize/$pic_pimage2")) unlink("../img_pro/fullsize/$pic_pimage2");
						endif ;
					
						$stmtdel2 = $db->Prepare('DELETE products_images FROM products_images WHERE products_images.id =? ');
 						$del2 = $db->Execute($stmtdel2,array($rsdel2->fields['id'])) ;
					$rsdel2->MoveNext(); 
                    endwhile; 
							
					$stmtdel = $db->Prepare('DELETE products FROM products WHERE products.tid =? ');
 					$rsdel = $db->Execute($stmtdel,array($gettmpnid)) ;
				endforeach ;
	
		if($product):
			$getdata[msg]="Delete Product Completed !!";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=product_to_delete.php \">";	
			saverecord('Delete product');				
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Product Not Completed !!</span><br>";
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
                <td align="right" class="arialVIO24B">PRODUCT</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_product.php") ?></td>
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