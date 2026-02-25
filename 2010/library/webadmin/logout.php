<?php
 require_once '../function/sessionstart.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<?php
 $render = 'index.php' ;
saverecord('Logout');
updatestatus('Offline');
$db->close();
session_destroy();
echo "<meta http-equiv=\"refresh\" content=\"0;URL=$render\" />" ;
?>