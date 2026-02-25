<?php session_start();
$tmpuid = session_id();
	if (!isset($_SESSION['cus_id'])) : 
		$login = false ;
	else :
		$login = true ;
	endif ;
?>