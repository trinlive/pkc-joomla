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
 #$db->debug=1; 
?>
<?php
switch($_POST['MM_action']):
	//  save 
	case 'create' : 
		$getdata[imagetopic]="Add Product Brand";				
		$gettmp[probrand]= $_POST['probrand'] ;
		$gettmp[subject]= $_POST['subject'] ;
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class pro_brand extends ADOdb_Active_Record{}
			$pro_brand = new pro_brand();		
			$pro_brand->protitle = $gettmp['subject'];
			$pro_brand->probrand = $gettmp['probrand'];
	
		
				$handle = new upload($_FILES['file']);
				$handle->image_convert = 'jpg';
				$handle->file_name_body_add = '_logo';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					$handle->Process('../img_pro/logo/');
					if ($handle->processed) :
					$new_logo = $handle->file_dst_name  ;
					$pro_brand->prologo = $new_logo ;
					$handle->clean();
					else:
					//echo 'error : ' . $handle->error;
					endif;
				endif;
				 
				
		if($pro_brand->save()) : // 
		$brand_id =  $pro_brand->brand_id ; 
				$getdata[msg].="Add Product Brand Completed !!";
				$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='image_probrand_new.php?brand_id=$brand_id'  class='arialVIO12B3'>Add Image Product Brand</a>";	
				saverecord('Add Product Brand');		
			else :
				$getdata[msg].="<span class=\"arialred12B\">Add Product Brand Not Completed !!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;	
	
	 break;

	case 'update' :
		$getdata[imagetopic]="Edit Product Brand";				
		$gettmp[probrand]= $_POST['probrand'] ;
		$gettmp[subject]= $_POST['subject'] ;	
		$gettmp[brand_id]=$_POST['brand_id'];

		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class pro_brand extends ADOdb_Active_Record{}
			$pro_brand = new pro_brand();
			$pro_brand->load("brand_id=?", array($gettmp[brand_id]));
			$pro_brand->protitle = $gettmp['subject'];
			$pro_brand->probrand = $gettmp['probrand'];
			

				$handle = new upload($_FILES['file']);
				$handle->image_convert = 'jpg';
				$handle->file_name_body_add = '_logo';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					if ($pro_brand->prologo != "") :
								if(file_exists("../img_pro/logo/".$pro_brand->prologo)) unlink("../img_pro/logo/".$pro_brand->prologo);
								endif ;
					$handle->Process('../img_pro/logo/');
					if ($handle->processed) :
					$new_logo = $handle->file_dst_name  ;
					$pro_brand->prologo = $new_logo ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;
			


		
		if($pro_brand->replace()):// 	
			$getdata[msg]="Update Product Brand Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='probrand_edit.php?brand_id=$gettmp[brand_id]' class=\"arialVIO12B3\">Edit Product Brand</a>";					
			saverecord('Edit Product Brand');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Product Brand Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case 'delete' : 
		$getdata[imagetopic]="Delete Product Brand";		
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class pro_brand extends ADOdb_Active_Record{}
			$pro_brand = new pro_brand();
				foreach($_POST['chkbox'] as $row=>$gettmpnid) :
				#	$gettemp[nid] = $_POST['nid'][$row];	
				$SQLstr = " SELECT * FROM `pro_brands` WHERE `pro_brands`.`brand_id` =  '".$gettmpnid."' ";
 				$rsdel = $db->Execute($SQLstr) ;
					
					$pimage1 = $rsdel->fields['prologo'] ;
						if ($pimage1 != "") :
							if(file_exists("../img_pro/logo/$pimage1")) unlink("../img_pro/logo/$pimage1");
					 	endif ;
					
				$SQLstr2 = " SELECT * FROM `pro_images` WHERE `pro_images`.`brand_id` =  '".$gettmpnid."' ";
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
					
						$stmtdel2 = $db->Prepare('DELETE pro_images FROM pro_images WHERE pro_images.id =? ');
 						$del2 = $db->Execute($stmtdel2,array($rsdel2->fields['id'])) ;
					$rsdel2->MoveNext(); 
                    endwhile; 
							
					$stmtdel = $db->Prepare('DELETE pro_brands FROM pro_brands WHERE pro_brands.brand_id =? ');
 					$rsdel = $db->Execute($stmtdel,array($gettmpnid)) ;
				endforeach ;
	
		if($news):
			$getdata[msg]="Delete Product Brand Completed !!";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=carbrand_to_delete.php \">";	
			saverecord('Delete Product Brand');				
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Product Brand Not Completed !!</span><br>";
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
                <td align="right" class="arialVIO24B">INNOVATION</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_pro.php") ?></td>
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