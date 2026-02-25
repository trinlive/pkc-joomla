<?
 ####################### Define Important Constants #######################
define('IN_SC', true);

// The email address form submissions will be sent to
define('EMAIL', 'johnsmit@an-example.net');

// Your site/domain name
define('SITE_NAME', 'domain.tld');



// This must be numeric, see www.php.net/wordwrap
define('MSG_WORD_WRAP', 75);

// ############################### Functions ################################
require_once('functions.php');

//sleep(3);
//print_r($_GET);
if (isset($_GET['name']))
{
    $name = sanitize($_GET['name']);
    $email = sanitize($_GET['email']);
	$subject = sanitize($_GET['subject']);
	
    $message = wordwrap(sanitize($_GET['msg'], false), MSG_WORD_WRAP);
 $message = str_replace("\n", '<br/>', $_GET['msg']);
    $ip = get_ip();

    if (empty($name) OR empty($email) OR empty($message) OR is_email_injection($name))
    {
        echo '<font color="#c24949"><b>One or more required fields left blank. Please try again.</b></font><br/>';
    }
    else if (!is_valid_email($email) OR is_email_injection($email))
    {
        echo '<font color="#c24949"><b>E-mail is invalid. Please try again.</b></font><br/>';
    }
    else
    {
        $headers = 'From: ' . $name . ' <' . $email . '>' . "\n";
        $headers .= 'Message-ID: <' . md5(uniqid(time())) . '@' . $_SERVER['HTTP_HOST'] . '>' . "\n";
        $headers .= 'MIME-Version: 1.0' . "\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
        $headers .= 'Content-transfer-encoding: 8bit' . "\n";
        $headers .= 'Date: ' . date('r', time()) . "\n";
        $headers .= 'X-Priority: 3' . "\n";
        $headers .= 'X-MSMail-Priority: Normal' . "\n";
        $headers .= 'X-Mailer: PHP/' . PHP_VERSION . "\n";
        $headers .= 'X-MimeOLE: Produced By SVs SimpContact v1.0.3' . "\n";

        $send = mail(EMAIL, $subject, "
<html>
<head>
<title>Email from $name</title>
</head>

<body>

<table align=\"center\" cellpadding=\"2\" cellspacing=\"1\">
<tr>
  <td colspan=\"2\">Someone from " . SITE_NAME . " has sent you a message, it is below.</td>
</tr>
<tr>
  <td><b>Sender's name:</b></td>
  <td>$name</td>
</tr>
<tr>
  <td><b>Sender's Email:</b></td>
  <td>$email</td>
</tr>
<tr>
  <td><b>Sender's IP:</b></td>
  <td>$ip</td>
</tr>
<tr>
  <td valign=\"top\"><b>Message:</b></td>
  <td>$message</td>
</tr>
</table>

</body>
</html>
", $headers);

        if ($send)
        {
            echo '<font color="#49c24f"><b>Voila, ' . $name . '... your message has been sent!</b></font><br/>';
        }
        else
        {
            echo '<font color="#c24949"><b>Uhh! Seems there\'s a problem sending the mail.</b></font><br/>';
        }
    }
}




?>
