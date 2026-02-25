<?ob_start();?> 
<?php
 require_once '../function/sessionstart.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<?php
//$db->debug = 1 ;
if (!empty($_REQUEST["MM_action"])) :
 $gettmp[username] = $_POST['username'] ;
 $gettmp[password] = $_POST['password'] ;
 $stmt = $db->Prepare('SELECT admins.admin_id, admins.username, admins.passwd, admins.admin_active FROM admins WHERE admins.username =? and admins.admin_active =?');
 $rs = $db->Execute($stmt,array($gettmp[username],'Active'));
 $numrows=$rs->RecordCount();
# echo $numrows ;
	if ($numrows == 1) :  
		if ($gettmp[password] == $rs->fields['passwd']) :
			$login = true ;	
			$_SESSION['adminid'] =  $rs->fields['admin_id']  ;	
				$mstmt = $db->Prepare('SELECT admins.username, admins.passwd, admins.admin_active, admin_infos.admin_id, admin_infos.last_date, st_members.st_member_detail, st_members.st_member, admin_infos.rules, admin_infos.name, admin_infos.surname FROM admins Inner Join admin_infos ON admin_infos.admin_id = admins.admin_id  Inner Join st_members ON st_members.st_member = admin_infos.st_member  WHERE admins.admin_id =? AND admins.admin_active =? ') ;			
	 			$mrs = $db->Execute($mstmt,array($rs->fields['admin_id'],'Active'));		
				$_SESSION['lastadmin'] = $mrs->fields['last_date'] ;
				$_SESSION['levelmember'] = $mrs->fields['st_member'];				
				$_SESSION['statusadmin'] = $mrs->fields['st_member_detail'];
				$_SESSION['nameadmin'] =  $mrs->fields['name']."  ".$mrs->fields['surname'];
				$_SESSION['ruleadmin'] =  $mrs->fields['rules'];
				$_SESSION['passwd'] =  $mrs->fields['passwd'];				
			$msg = urlsafe_b64encode('Successful.') ;
			$login = true ;
			$render = 'admin.php' ;
			saverecord('Login');
			updatestatus('Online');
		else :
			$msg = urlsafe_b64encode('The Username Or Password Is Incorrect. Please Try Again.') ;	
			$login = false ;
			$render = 'index.php' ;
		endif ;
	else :
		$msg = urlsafe_b64encode('The Username Or Password Is Incorrect. Please Try Again.') ;	
		$login = false ;
		$render = 'index.php' ;
	endif ;
endif ;
$db->close();
//echo $_SESSION['lastadmin']."<BR>Level ".$_SESSION['levelmember']."<BR>".$_SESSION['statusadmin']."<BR>".$_SESSION['nameadmin']."<BR>".$_SESSION['ruleadmin'];
echo "<meta http-equiv=\"refresh\" content=\"0;URL=$render?msg=$msg\" />" ;
exit();
?>