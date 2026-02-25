<?php session_start();		
$tmpsid = session_id();
	if (!isset($_SESSION['adminid'])) : 
		$login = false ;
	else :
		$login = true ;
	endif ;
?>