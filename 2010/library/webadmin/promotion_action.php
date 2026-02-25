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
// $db->debug=1;
?>
<?php
switch($_POST['MM_action']):
	//  save 
	case 'create' : 
	//promotion_type topic url image promotion_status
		#$db->debug=1 ;
		$getdata['action_topic'] = "Add Promotion";
		$gettmp['topic'] = $_POST['topic'] ;
		$gettmp['promotion_type'] = $_POST['promotion_type'] ;
		$gettmp['url'] = $_POST['url'] ;		
		$gettmp['promotion_status'] = $_POST['promotion_status'] ;

		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class promotion extends ADOdb_Active_Record{}
			$promotion = new promotion();
		
			$promotion->topic = $gettmp['topic'];
			$promotion->promotion_type = $gettmp['promotion_type'];
			$promotion->url = $gettmp['url'];
			$promotion->promotion_status = $gettmp['promotion_status'];
			$list = explode("-",$_FILES['image']['type']);
				$handle = new upload($_FILES['image']);
				if($list[2] != "flash"):
					$handle->image_convert = 'jpg';
				endif;	
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					$handle->Process('../img_promotion/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$promotion->image = $new_imagename ;
					$handle->clean();
					else:
					echo 'error : ' . $handle->error;
					endif;
				endif;

					
			if($promotion->save()) : 
				$getdata[msg].="Add Promotion Completed !!";
				saverecord('Add Promotion');		
			else :
				$getdata[msg].="<span class=\"arialred12B\">Add Promotion Not Completed !!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;	

	 break;

	case 'update' :
		#$db->debug=1;
		$getdata['action_topic'] = "Update Promotion";
		$gettmp['promotion_id']=$_POST['promotion_id'];
		$gettmp['topic']= $_POST['topic'] ;
		$gettmp['promotion_type']= $_POST['promotion_type'] ;
		$gettmp['url']= $_POST['url'] ;		
		$gettmp['promotion_status']= $_POST['promotion_status'] ;
		$gettmp['promotion_id']= $_POST['promotion_id'] ;
	
		ADOdb_Active_Record::SetDatabaseAdapter($db);

			class promotion extends ADOdb_Active_Record{}
			$promotion = new promotion();
			$promotion->load("promotion_id=?", array($gettmp['promotion_id']));
			$promotion->topic = $gettmp['topic'];
			$promotion->promotion_type = $gettmp['promotion_type'];
			$promotion->url = $gettmp['url'];
			$promotion->promotion_status = $gettmp['promotion_status'];
				$list = explode("-",$_FILES['image']['type']);
				$handle = new upload($_FILES['image']);
				if($list[2] != "flash"):
				$handle->image_convert = 'jpg';
				endif;
				$handle->file_name_body_add = '_imgnew';
				$handle->file_auto_rename = true;
				if ($handle->uploaded) :
					if ($promotion->image != "") :
						if(file_exists('../img_promotion/'.$promotion->image)) unlink('../img_promotion/'.$promotion->image);
						endif ;
					$handle->Process('../img_promotion/');
					if ($handle->processed) :
					$new_imagename = $handle->file_dst_name  ;
					$promotion->image = $new_imagename ;
					$handle->clean();
					else:
						echo 'error : ' . $handle->error;
					endif;
				endif;

		
				$promotion_id = $gettmp['promotion_id'] ;
	
		if($promotion->replace()):// 	
			$getdata[msg]="Update promotion Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='promotion_edit.php?pid=$gettmp[promotion_id]' class=\"arialVIO12B3\">Edit promotion</a>";					
			saverecord('Edit Promotion');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update promotion Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;			
	break;

case 'delete' : 
//$db->debug=1;
		$getdata['action_topic'] ="Delete promotion";		
		//$gettmp[news_cate]= '1' ;
		//$promotion_id= $_POST['promotion_id'] ;
		/*print_r($_POST['chkbox']);
		foreach($_POST['chkbox'] as $row=>$gettmpnid) :
			echo "dddd".$gettmpnid." ";
		endforeach;
		$SQLstr = "SELECT * FROM promotions ";
 		$rsdel = $db->Execute($SQLstr) ;
		echo $rsdel->RecordCount();*/
				foreach($_POST['chkbox'] as $row=>$gettmpnid) :
				#	$gettemp[nid] = $_POST['nid'][$row];	
				//echo $gettmpnid;
				$SQLstr = "SELECT * FROM promotions WHERE promotion_id =  '".$gettmpnid."'";
 				$rsdel = $db->Execute($SQLstr) ;
					 $pimage = $rsdel->fields['image'] ;
						if ($pimage != "") :
							if(file_exists("../img_promotion/$pimage")) unlink("../img_promotion/$pimage");
					 	endif ;
					$stmtdel = $db->Prepare('DELETE FROM promotions WHERE promotion_id =? ');
 					$rsdel = $db->Execute($stmtdel,array($gettmpnid)) ;	
				endforeach ;
	
		if($rsdel):
			$getdata[msg]="Delete promotions Completed !!";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"0; URL=promotion_to_delete.php \">";	
			saverecord('Delete products');				
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
                <td align="right" class="arialVIO24B">PROMOTION</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_promotion.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata['action_topic'] ; ?></span></td>
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