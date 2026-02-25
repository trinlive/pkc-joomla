<?ob_start();?> 
<?php 
 require_once '../function/sessionstart.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: ADMIN CONTROL PANEL PAKKRETCITY.GO.TH ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function dynamicElm()
{
 document.getElementById('pwd').style.display='none' ;
 document.getElementById('password').style.display='block' ;
 document.getElementById('password').focus();
}

//-->
</script>
<script language="javascript" type="text/javascript" src="js/editcheck.js"></script>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><?php include ("inc/inc_head.php") ?>
    <table width="100%" height="40" border="0" cellspacing="0" cellpadding="0" bgcolor="#1BB3B3">
  <tr>
    <td colspan="3"><table width="100%" height="3" border="0" cellspacing="0" cellpadding="0" bgcolor="#63cdcd">
  <tr>
    <td></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
  <td width="166">&nbsp;</td>
  <td>&nbsp;</td>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" class="arialVIO24B">ADMIN CONTROL PANEL</td>
    <td width="45">&nbsp;</td>
  </tr>
</table>
</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="4"></td>
  </tr>
</table>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" background="images/line_main.gif">
  <tr>
    <td width="166" valign="top"><img src="images/line_left.gif" width="166" height="1" /></td>
    <td align="center" valign="top"><table width="100%" height="29" border="0" cellspacing="0" cellpadding="0" background="images/bg_head04.gif">
  <tr>
    <td width="200" height="29"><span class="arialWH18B">&nbsp;&nbsp;Admin Log-in </span></td>
    <td class="text_violet_bold"><form name="form" method="post" action="login.php"  style= "margin:0px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="150"><input name="username" type="text" class="border_bg_violet" onFocus="this.value='';" value="- Username" size="30" ></td>
                <td width="10">&nbsp;</td>
                <td width="150"><input name="password" type="password" class="border_bg_violet" id="password" size="30"  style="display:none" ><input name="pwd" type="text" class="border_bg_violet" id="pwd" value="- Password" size="30" onFocus="dynamicElm()" ></td>
                <td width="15">&nbsp;</td>
                <td align="left"><input type="submit" name="Submit" value="Login" class="buttom">
                    <input name="MM_action" type="hidden" id="MM_action" value="login" /></td>
              </tr>
            </table>
          </form></td>
          <td width="50">&nbsp;</td>
  </tr>
</table>
<table width="100%" height="150" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><span class="text_eng_normal">
            <?php if (!empty($_REQUEST['msg'])) :?>
            <span class="text_red_bold"><?php echo urlsafe_b64decode($_REQUEST['msg'])?></span>
            <?php endif ; ?></span></td>
        </tr>
      </table>
</td>
<td width="50">&nbsp;</td>
  </tr>
</table>



</td>
</tr>
<tr>
<td height="55"><?php include ("inc/inc_footer.php")?></td>
</tr>
</table>

</body>
</html>
