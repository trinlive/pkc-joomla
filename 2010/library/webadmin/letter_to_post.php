<?php 
require_once 'function/config.php';
require_once 'function/rewrite.php';
require_once 'adodb/adodb.inc.php';
require_once 'class/class.GenericEasyPagination.php'; 
require_once 'library/Smarty.class.php';
require_once 'class/class.upload.foto.php'; 
require_once 'class/class.phpmailer.php';

$mail = new PHPMailer();

$withapp = false ;
$email = $_POST['email'];
$sender = $_POST['sender'];
$detail = $_POST['detail'];
$detail = nl2br($detail);
$fileatt ='';
$date = date('Y-m-d / H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

if ($_FILES['fileatt']['tmp_name']) {
	$withapp = true ; 
	//$fileatt = $_FILES['fileatt'] ;//$_FILES['fileatt']['tmp_name'] ;
	// echo $fileatt = "temp/".$_FILES['fileatt']['name'];
   copy($_FILES['fileatt']['tmp_name'], $fileatt);
}
$body = $mail->getFile('tmpl_newsletter.htm');
if ($body !== false) {
$body = eregi_replace("&email;",$email,$body);
$body = eregi_replace("&sender;",$sender,$body);
$body = eregi_replace("&detail;",$detail,$body);

$body = eregi_replace("&date;",$date,$body);
$body = eregi_replace("&ip;",$ip,$body);
$body = StripSlashes($body) ;
}
$mail->CharSet =  'utf-8'; 
$mail->From = "$email";
$mail->FromName = "$sender";
$mail->Subject = "Contact to PHIPHIISLANDVILLAGE";

$mail->MsgHTML($body);

$mail->AddAddress("yodjit2526@hotmail.com"); 
//$mail->AddBCC("yodjit2526@hotmail.com"); 

if ($withapp) :
	$mail->AddAttachment($fileatt); // attach files/invoice-user-1234.pdf, 
endif;

if(!$mail->Send()) {
	$msg = '<span class=class=Blue12B01><font color=#FF0000 size=2>You contact message<br>not completed. </font></span>';
	//echo "<meta http-equiv=\"refresh\" content=\"5; url=contactus.php\">";
} else {
	$msg = 'Your newsletter message send completed';
	//echo "<meta http-equiv=\"refresh\" content=\"5; url=index.php\">";
	if ($withapp) :
		$tempname = $_FILES['fileatt']['name'] ;
		if(file_exists("temp/$tempname")) unlink("temp/$tempname");	
	endif ;
}



$render = 'letter_to_post.htm' ;

	
$template = new Smarty;
$template->compile_check = true;
//$template->debugging = true;
$template->assign("cpage","contacus");
$template->assign("nxpage","tmpl_newsletter.php/".$where);

$template->assign('tpage','news_letter');
$template->assign('cpage','newsletter');

$template->assign('msg',$msg);
$template->display($render);
?>