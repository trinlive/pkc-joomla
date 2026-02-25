<?php
session_start();
if(!isset($_SESSION["admin_id"])){	// ไม่พบ session :admin
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
	exit();
}
?>