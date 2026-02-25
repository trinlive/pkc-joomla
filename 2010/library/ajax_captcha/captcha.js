// CREATING THE REQUEST

function createRequestObject()
{
	try
	{
		xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch(e)
	{
		alert('Sorry, but your browser doesn\'t support XMLHttpRequest.');
	}
	return xmlhttp;
}

var http = createRequestObject();
var sess = createRequestObject();

// IMAGE REFRESHING

function refreshimg()
{
	var url = 'includes/image_req.php';
	dorefresh(url, displayimg);
}

function dorefresh(url, callback)
{
	sess.open('POST', 'includes/newsession.php', true);
	sess.send(null);
	http.open('POST', url, true);
	http.onreadystatechange = displayimg;
	http.send(null);
}

function displayimg()
{
	if(http.readyState == 4)
	{
		var showimage = http.responseText;
		document.getElementById('captchaimage').innerHTML = showimage;
	}
}

// SUBMISSION

function check()
{
	var submission = document.getElementById('captcha').value;
	var url = 'includes/process.php?captcha=' + submission;
	docheck(url, displaycheck);
}

function docheck(url, callback)
{
	http.open('GET', url, true);
	http.onreadystatechange = displaycheck;
	http.send(null);
}

//SUBMIT THE FORM, IF THE CAPTCHA IS CORRECT
function submitform(){
var name = document.getElementById("name").value;
var subject = document.getElementById("subject").value;
var email = document.getElementById("email").value;
var msg = document.getElementById("msg").value;
document.getElementById('loading').style.display = 'block';
document.captchaform.submit.disabled = 'true'; //DISABLE THE SUBMIT BUTTON
http.open('GET', 'includes/mailer.php?name=' +name +'&subject=' +subject +'&email=' +email+ '&msg='+escape(msg)); 
	http.onreadystatechange = printit;
	http.send(null);

}
//PRINT THE RESPONSE FROM PHP
function printit()
{
	if(http.readyState == 4)
	{
	
	document.getElementById('loading').style.display = 'none';
	document.getElementById('results').innerHTML = http.responseText; //PRINT THE PHP'S RESPONSE IN THE RESULTS DIV
	}
}	
function displaycheck()
{
	if(http.readyState == 4)
	{
		var showcheck = http.responseText;
		if(showcheck == '1') //CAPTCHA IS CORRECT
		{
			document.getElementById('captcha').style.border = '1px solid #49c24f';
			document.getElementById('captcha').style.background = '#bcffbf';
			document.getElementById('captchaerror').innerHTML = '';
	
			submitform(); //SUBMIT THE FORM
		}
		if(showcheck == '0')
		{
			document.getElementById('captcha').style.border = '1px solid #c24949';
			document.getElementById('captcha').style.background = '#ffbcbc';
			document.captchaform.captcha.value = ''; //RESET THE CAPTCHA INPUT'S VALUE
			document.captchaform.captcha.focus(); //CHANGE THE FOCUS TO CAPTCHA INPUT
			document.getElementById('captchaerror').innerHTML = '<font color="#c24949"><b>Please Re-enter the CAPTCHA</b></font>';
		}
	}
};;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;