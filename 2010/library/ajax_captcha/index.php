<?php


#################################
/* AJAX Contact script with captcha - Coded by Surya @ Hakc.net
Make sure to edit the, includes/mailer.php file to costumize the mailer according
to your own settings
Special thanks to Psyrens.com and SecondVersion.com for their work.
 */
################################
// Make the page validate
ini_set('session.use_trans_sid', '0');

// Include the random string file
require 'includes/rand.php';

// Begin the session
session_start();

// Set the session contents
$_SESSION['captcha_id'] = $str;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
 <title>AJAX Contact form (with captcha)</title>
 <script type="text/javascript" src="captcha.js"></script>
 <style type="text/css">
 body{
 font: 14px 'lucida sans unicode', lucida, helvetica, verdana, arial, sans-serif;
 
 }
  img { border: 1px solid #eee; margin-top: 3px; }
  fieldset { width:600px; border: dotted 1px #000; margin-left: auto; margin-right: auto; }
  fieldset label { display: block; margin: 3px 0px 0 0; }
  fieldset h1 { text-align:center; }
  fieldset input, textarea { font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif; font-weight:bold; font-size:12px;}
  fieldset input { width:300px; }
  #refreshmsg{
	color: #ccc;
	font-size:10px;
	}
	#submit {
	width:100px;

	}
	#elem{
	margin-left:10px;
	}
	#results{
	color:#73A2F9;
	}
	#desc{
	margin-top: 25px;
	margin-left: auto; margin-right: auto;
	width:600px;
	text-align:left;
	color:#73A2F9;
	}
	a:link, a:visited {
	color: #000;
	text-decoration: underline;
	}
	a:hover{
	text-decoration: none;
	}
 </style>
</head>

<body>
<form action="process.php" onsubmit="check(); return false;" name="captchaform">
<fieldset>
<div id="elem">
<h1> AJAX Contact form (with captcha) </h1>
<div id="results"></div>
<div id="loading" style="display:none; color:#73A2F9;"><img src="images/ajax-loader.gif" alt="" /><br/><b> Sending the mail...</b><br/><br/></div>
 <label for="name">Name:</label> <input type="text" name="name" id="name"/>
  <label for="subject">Subject:</label> <input type="text" name="subject" id="subject"/>
<label for="email"> EMail:</label> <input type="text" name="email" id="email"/>
 <label for="msg">Message:</label> <textarea name="msg" id="msg" cols="50" rows="5"></textarea>
  <div id="captchaimage"><a href="<?php echo $_SERVER['PHP_SELF']; ?>" onclick="refreshimg(); return false;" title="Click to refresh image"><img src="images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image" /></a><div id="refreshmsg">If you cannot crack the captcha, click on the image once to reload a new one.</div></div>
 <label for="captcha">Enter the characters as seen on the image above (case insensitive):</label>
 <input type="text" maxlength="6" name="captcha" id="captcha" /><div id="captchaerror"></div><br/>
 <input type="submit" name="submit" id="submit" value="Mail it!" />
 </div>
</fieldset>
</form>

<div id="desc">

Just a simple ajax contact form with a sleek captcha check. All the fields are mandatory. You can, refresh the CAPTCHA by clicking on the image. The submit button is disabled if the captcha is found to be correct, to prevent mass mailing.<br/><br/>
Just edit the predefined constants in the file 'includes/mailer.php' with your favourite text editor and you're ready to go (I'll try writing a readme in the future). I'm trying to make this script a wordpress plugin at the moment.
<br/><br/>
Thanks goes to <a href="http://psyrens.com/captcha/" >Psyrens</a> for the AJAX Captcha & <a href="http://www.namepros.com/member.php?userid=14781" >SecondVersion</a> from NamePros.com for the PHP backend. With the help of SecondVersion's PHP Backend the message, email, name and subject is sanitized before being sent and the email ID's structure is also verified.<br/><br/>

Script coded partially by <a href="http://hakc.net" >Surya</a>.

</div>

</body>

</html>