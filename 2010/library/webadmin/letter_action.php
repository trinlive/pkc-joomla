<?php
 require_once '../function/sessionstart.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once '../class/class.phpmailer.php';
 require_once '../library/Smarty.class.php';
 require_once '../class/class.upload.foto.php'; 
 
?>
<?php 
#$db->debug=1;
switch($_POST['MM_action']):	
	case 'create' : 
		$getdata[imagetopic]="Add Newsletter";
		$gettmp[subject]=$_POST['subject'];
		$gettmp[detail]=$_POST['detail'];
		
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_news]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp['news_active']=$_POST['news_active'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_letter extends ADOdb_Active_Record{}
			$news_letter = new news_letter();
			$news_letter->subject = $gettmp['subject'];
			$news_letter->detail = $gettmp['detail'];
			$news_letter->date_news =$gettmp['date_news'];	
			$news_letter->news_active =$gettmp['news_active'];
			$news_letter->save();
			
			if($news_letter) : // 
				$getdata[msg]="Add Newsletter Completed!!";
				saverecord('Add Newsletter');		
			else :
				$getdata[msg]="<span class=\"arialred12B\">Add Newsletter Not Completed!!</span><br>";
				$getdata[msg].=$config[err][database];	
				$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
			endif ;			
	break;	

case 'update' :
		$getdata[imagetopic]="Edit Newsletter";		
#		$gettmp[news_cate]= '1' ;
		$gettemp[news_id]= $_POST['news_id'];
		
		$gettmp[subject]= $_POST['subject'] ;
		$gettmp[detail]= $_POST['detail'] ;

		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[date_news]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp[news_active]=$_POST['news_active'];
		
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_letter extends ADOdb_Active_Record{}
			$news_letter = new news_letter();
			$news_letter->load("news_id=?", array($gettemp[news_id]));
			$news_letter->subject = $gettmp['subject'];
			$news_letter->detail = $gettmp['detail'];
			$news_letter->date_news =$gettmp['date_news'];	
			$news_letter->news_active =$gettmp['news_active'];
			$news_letter->replace();
			
		if($news_letter):// 	
			$getdata[msg]="Update Newsletter Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='letter_edit.php?news_id=$gettemp[news_id]'  class='arialVIO12B3'>Edit Newsletter</a>";					
			saverecord('Edit Newsletter');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update Newsletter Not Completed!!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;		
	break;
	
	case 'delete' :
	
		$getdata[imagetopic]="Delete Newsletter";		
		#$gettmp[news_cate]= '1' ;
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class news_letter extends ADOdb_Active_Record{}
			$news_letter = new news_letter();
				foreach($_POST['chkbox'] as $row=>$gettmpnews_id) :
				#	$gettemp[news_id] = $_POST['news_id'][$row];
					$news_letter->load("news_id=?", array($gettmpnews_id));
					$news_letter->Delete();
				endforeach ;
				
		if($news_letter):
			$getdata[msg]="Delete Newsletter Completed!!<br>";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=letter_to_delete.php \">";	
			saverecord('Delete Newsletter');	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Newsletter Not Completed!!</span><br>";
			$getdata[msg].=$config[err][database];		// šúѹ֡
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	break;
	
	case 'send' :
	
		$getdata[imagetopic]="Send Newsletter";
		$getsubject = stripslashes($_POST['subject']);
		$getsender = $_POST['sender'];
		$getdetail= StripSlashes($_POST['detail']);
		
		$getday=$_POST['postday'];
		$getmonth=$_POST['postmonth'];
		$getyear=$_POST['postyear'];
		$getdate = $getday.'-'.$getmonth.'-'.$getyear ;
			
		#	Shop	
		if($_POST['Subscribe'] != ''):
			$SQLstr = " SELECT * FROM subscribes WHERE subscribes.`status` =  'Active'  ";
 			$rs = $db->Execute($SQLstr) ;
			$numrecord=$rs->RecordCount();
			
			
 			list($getyear, $getmonth, $getday,) = explode("-", $gettemp[news_date]);
			$gettmp[news_date] = $getday.'-'.$getmonth.'-'.$getyear ;
			
			 if (!$rs->EOF):	
		 	 	while (!$rs->EOF):
				
		  		$mail = new PHPMailer();	
				$mail->IsSMTP();	
				 $body = $mail->getFile('tmpl_newsletter_cus.htm');
		 			if ($body !== false) :
						$body = eregi_replace("-subject-",$getsubject,$body);
						$body = eregi_replace("-detail-",$getdetail,$body);
						$body = eregi_replace("-news_date-",$getdate,$body);
						$body = stripslashes($body) ;
					endif;
				$body = eregi_replace('"','',$body);	
				$email_cus = $rs->fields['email'] ;
				$mail->Host = "10.9.1.4"; 
				$mail->Port = 25;
				$mail->CharSet =  'utf-8'; 
				$mail->From = "aha@aha.co.th";
				$mail->FromName = "$gettmp[sender]";
				$mail->Subject = "$getsubject";
				$mail->MsgHTML($body);
				$mail->AddAddress("$email_cus"); 
				$mail->AddBCC("crm_aha@aha.co.th");			
				
				$mail->Send();			
		
			sleep(1);	
				
				unset($mail);
				
				$rs->MoveNext();
			endwhile ;
			endif;
		endif;
		#Guest
		if($_POST[Member] != ''):
			$SQLstr01 = " SELECT * FROM  `webboard_members` WHERE `webboard_members`.`status` = 'Active' ";
 			$rs01 = $db->Execute($SQLstr01) ;
			$numrecord01=$rs01->RecordCount();
 			list($getyear, $getmonth, $getday,) = explode("-", $gettemp[news_date]);
			$gettmp[news_date] = $getday.'-'.$getmonth.'-'.$getyear ;
			
			 if (!$rs01->EOF):	
		 	 	while (!$rs01->EOF):
		  		$mail = new PHPMailer();		
				 $body = $mail->getFile('tmpl_newsletter_cus.htm');
		 			if ($body !== false) :
						$body = eregi_replace("-subject-",$getsubject,$body);
						$body = eregi_replace("-detail-",$getdetail,$body);
						$body = eregi_replace("-news_date-",$getdate,$body);
						$body = stripslashes($body) ;
					endif;
					echo $body ; 
					
				$body = eregi_replace('"','',$body);
				$mail->CharSet =  'utf-8'; 
				$mail->From = "aha@aha.co.th";
				$mail->FromName = "$gettmp[sender]";
				$mail->Subject = "NEWSLETTER HUMANTRAFFIC";
				$email_cus = $rs01->fields['email'] ;
				$mail->AddAddress($email_cus); 
				$mail->AddBCC("crm_aha@aha.co.th");			
				$mail->MsgHTML($body);
				$mail->IsHtml(true); 				
				$mail->IsSMTP();
				$mail->Host     = "localhost"; // your SMTP Server

				/*
				$mail->Mailer   = "smtp"; // SMTP Method
				$mail->SMTPAuth = true;  // Auth Type
				$mail->Username = "aha@aha.co.th";  // Auth Name
				$mail->Password = "0123";  // Auth Password
				*/
			
				$mail->Send();			
				sleep(1);	
				unset($mail);
				$rs01->MoveNext();
			endwhile ;
			endif;
		endif;		
		#if($mail):
			$getdata[msg]="Send Newsletter Completed!!";
			//$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=letter_to_send.php \">";	
			saverecord('Send Newsletter');	
		#else :
			#$getdata[msg]="<span class=\"arialred12B\">Send Newsletter Not Completed!!</span><br>";
			#$getdata[msg].=$config[err][database];	
			#$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		#endif; 
break;
endswitch ;
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
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
          <td width="270"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right" class="arialVIO24B">MAILINGLIST</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_mail.php") ?></td>
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
                <td align="center"><span  class="arialVIO12B2"><?php echo $getdata[msg]; ?></span></td>
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