<?php
 require_once '../function/sessionstart.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
# require_once '../class/class.upload.foto.php'; 
?>
<?php
switch($_POST['MM_action']):
	 
	case 'update' :
		$getdata[imagetopic]="Edit User";		
		$gettmp[news_cate]= '1' ;
		$gettemp[email_id]= $_POST['email_id'];
		
		$gettmp[email]= $_POST['email'] ;
		
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[last_date]=  $gettmp[postyear]."-".$gettmp[postmonth]."-".$gettmp[postday];	
		
		$gettmp[status]=$_POST['status'];
		
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class subscribe extends ADOdb_Active_Record{}
			$subscribe = new subscribe();
			$subscribe->load("email_id=?", array($gettemp[email_id]));
			$subscribe->email = $gettmp['email'];
			//$subscribe->ip = $gettmp['ip'];
			$subscribe->status = $gettmp['status'];
			$subscribe->last_date = $gettmp['last_date'];	
			$subscribe->replace();
			
		if($subscribe):// 	
			$getdata[msg]="Update User Completed!!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='mail_edit.php?email_id=$gettemp[email_id]' class='arialVIO12B3'>Edit User</a>";	
			//$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=mail_to_edit.php \">";					
			saverecord('Update User Mailing List');				
		else://
			$getdata[msg]="<span class=\"arialred12B\">Update User Not Completed!!</span><br>";
			$getdata[msg].=$config[err][database];		
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;		
		
	break;

case 'delete' :
		$getdata[imagetopic]="Delete User";		
		$gettmp[news_cate]= '1' ;
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class subscribe extends ADOdb_Active_Record{}
			$subscribe = new subscribe();
				foreach($_POST['chkbox'] as $row=>$gettmpemail_id) :
				#	$gettemp[email_id] = $_POST['email_id'][$row];
					$subscribe->load("email_id=?", array($gettmpemail_id));
					$subscribe->Delete();
				endforeach ;
				
		if($subscribe):
			$getdata[msg]="Delete User Completed!!!<br>";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=mail_to_delete.php \">";	
			saverecord('Delete User Mailing List');	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete User Not Completed!!</span><br>";
			$getdata[msg].=$config[err][database];		// šúѹ֡
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	
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