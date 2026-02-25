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
#$db->debug = 1 ;
switch($_POST[MM_action]){
	//  save 
	case "create" :{
		$getdata[imagetopic]="Add File News";
		$gettmp[topic]=$_POST[topic];
		$gettmp[filestatus]=$_POST[filestatus];
		$gettmp[nid]=$_POST[nid];
		$gettmp[ndate]=$_POST[ndate];
		$gettmp[nmonth]=$_POST[nmonth];
		$gettmp[nyear]=$_POST[nyear];
		$gettmp[press_date]=$gettmp[nyear]."-".$gettmp[nmonth]."-".$gettmp[ndate];	
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_file extends ADOdb_Active_Record{}
			$presscenter = new news_file();		
			$presscenter->topic = $gettmp['topic'];
			$presscenter->filestatus = $gettmp['filestatus'];
			$presscenter->press_date = $gettmp['press_date'];
			$presscenter->nid = $gettmp['nid'];			
					
			if (is_uploaded_file($_FILES['fileatt']['tmp_name'])) :
				$foto_upload = new Foto_upload;
				$foto_upload->upload_dir = "../img_news/file/"; // "files" is the folder for the uploaded files (you have to create these folder)
				$foto_upload->foto_folder ="../img_news/file/"; 
				$foto_upload->extensions = array(".pdf",".rtf",".doc",".xls",".ppt",".zip",".rar"); // specify the allowed extension(s) here
				$foto_upload->language = "en";
				$foto_upload->rename_file = true;
				$foto_upload->the_temp_file = $_FILES['fileatt']['tmp_name'];
				$foto_upload->the_file = $_FILES['fileatt']['name'];
				$foto_upload->http_error = $_FILES['fileatt']['error'];
					
				if ($foto_upload->upload()) :
					//	$foto_upload->process_image(false, false, true, 80); 
	 				$foto_upload->message[] = "Processed foto: ".$foto_upload->file_copy."!"; // "file_copy is the name of the foto"
					$imgnewname = $foto_upload->file_copy ;			
					$imgnewsize = $_FILES['fileatt']['size'];
					$imgnewtype = $_FILES['fileatt']['type'];
					$withapp = true ;
						
					$datatype = checkfile($imgnewname);
						
						$presscenter->fileatt = $imgnewname ;
						$presscenter->filesizes = $imgnewsize ;
						$presscenter->filemarkup = $datatype;
						
						#	$getdata[msg] = "Upload file complete!!!<br>";								
				endif ; 		
		endif;
			
		if ($presscenter->save()) :
			$getdata[msg]="Add File Completed !!";		
			saverecord('Insert File');				
		 else :
			$getdata[msg]="<span class=\"arialred12B\">Add File Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		//  
			$getdata[msg].="<br><a href='javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		 endif ;	
	}break;
	
	case "update" :{
		$getdata[imagetopic]="Edit File";
		$gettmp[fileid]=$_POST[fileid];
		$gettmp[nid]=$_POST[nid];
		$gettmp[topic]=$_POST[topic];
		$gettmp[fileatt]=$_POST[fileatt];
		$gettmp[filestatus]=$_POST[filestatus];
		
		$gettmp[ndate]=$_POST[ndate];
		$gettmp[nmonth]=$_POST[nmonth];
		$gettmp[nyear]=$_POST[nyear];
		$gettmp[press_date]=$gettmp[nyear]."-".$gettmp[nmonth]."-".$gettmp[ndate];	
		
		$gettmp[pfileatt] = $_POST['pfileatt'] ;
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_file extends ADOdb_Active_Record{}
			$presscenter = new news_file();	
			$presscenter->load("fileid=?", array($gettmp[fileid]));	
			$presscenter->topic = $gettmp['topic'];
			$presscenter->filestatus = $gettmp['filestatus'];
			$presscenter->press_date = $gettmp['press_date'];			
			
		
		if($presscenter) :  
			if (is_uploaded_file($_FILES['fileatt']['tmp_name'])) :
				$foto_upload = new Foto_upload;
				$foto_upload->upload_dir = "../img_news/file/"; // "files" is the folder for the uploaded files (you have to create these folder)
				$foto_upload->foto_folder ="../img_news/file/"; 
				$foto_upload->extensions = array(".pdf",".rtf",".doc",".xls",".ppt",".zip",".rar"); // specify the allowed extension(s) here
				$foto_upload->language = "en";
				$foto_upload->rename_file = true;
				$foto_upload->the_temp_file = $_FILES['fileatt']['tmp_name'];
				$foto_upload->the_file = $_FILES['fileatt']['name'];
				$foto_upload->http_error = $_FILES['fileatt']['error'];
					
				if ($foto_upload->upload()) :
					if ($presscenter->fileatt != "") :
						if(file_exists("../img_news/file/$presscenter->fileatt")) unlink("../img_news/file/$presscenter->fileatt");
					endif ;
					//	$foto_upload->process_image(false, false, true, 80); 
	 				$foto_upload->message[] = "Processed foto: ".$foto_upload->file_copy."!"; // "file_copy is the name of the foto"
					$imgnewname2 = $foto_upload->file_copy ;						
					$imgnewsize = $_FILES['fileatt']['size'];
					$imgnewtype = $_FILES['fileatt']['type'];
					$withapp = true ;
						
					$datatype = checkfile($imgnewname2);	
					
						$presscenter->fileatt = $imgnewname2 ;
						$presscenter->filesizes = $imgnewsize ;
						$presscenter->filemarkup = $datatype;
						
						#	$getdata[msg] = "Upload file complete!!!<br>";								
				endif ; 	
			endif;	
		endif;

		if($presscenter->replace()) : 
			$getdata[msg]="Update File Completed !!";
		 	$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='file_news_to_edit4.php?fileid=".$gettmp[fileid]."&nid=".$gettmp[nid]."'  class='arialVIO12B3'>Edit File</a>";
			saverecord('Update File');	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Update File Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		//  
			$getdata[msg].="<br><a href='javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	
	}break;
		
	case "delete" :{
		$getdata[imagetopic]="Delete File";

		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_file extends ADOdb_Active_Record{}
			$presscenter = new news_file();
				foreach($_POST[chkbox] AS $gettmp[fileid]) :
					#	$gettemp[nid] = $_POST['nid'][$row];	
					$SQLstr = " SELECT fileatt FROM `news_files` WHERE `fileid` =  '".$gettmp[fileid]."' ";
 					$rs = $db->Execute($SQLstr) ;
					
 					$fileatt = $rs->fields['fileatt'] ;
	  					if ($fileatt != "") :
							if(file_exists("../img_news/file/$fileatt")) unlink("../img_news/file/$fileatt");
	 					endif ;
					
					$presscenter->load("fileid=?", array($gettmp[fileid]));
					$presscenter->Delete();
				endforeach ;
		if ($presscenter) :	
			saverecord('Delete Press Center');	
			$getdata[msg]="Delete Press Center Completed !!<br>";
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=file_news_to_delete.php\">";	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Press Center Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;
	}break;
}
?>

<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
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
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head05.gif">
          <tr>
            <td width="185" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ;?></span></td>
            <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
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
            <td><table width="100%" height="200"  border="0" align="center" cellpadding="0" cellspacing="0" class="border_response">
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
    <td height="55"><?php include ("inc/inc_footer.php")?></td>
  </tr>
</table>
</body>
</html>