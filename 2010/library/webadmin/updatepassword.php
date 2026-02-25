<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<?php
	$getdata[oldpassword]=$_POST["old_password"];
	$getdata[newpassword]=$_POST["new_password"];
	$getdata[repassword]=$_POST["new_repassword"];	
	//print_r($_SESSION);
//	echo "Old : session ->".$_SESSION['passwd']." ... ".$getdata[oldpassword]." / New ".$getdata[newpassword]." = ".$getdata[repassword]."<BR>";
	if($getdata[newpassword] != $getdata[repassword]){
		$errmsg="<b>New Password Incorrect<b>";
	}else{
		if($getdata[oldpassword] == $_SESSION['passwd']){
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class admin extends ADOdb_Active_Record{}
			$admin = new admin();
			$admin->load("admin_id=?", array($_SESSION['adminid']));
			$admin->passwd = $getdata[newpassword];
			$admin->replace();
		
			if($admin){
				saverecord("Update password") ;
				$_SESSION["passwd"] = $getdata[newpassword] ;
			}else{
				$errmsg="<b>Database Error<b>";
			}				
		}else{
			$errmsg="<b>Old Password Incorrect<b>";
		}
	}
	
	unset ($getdata);
	unset ($pd);
?>
<html>
<head>
<title>:: ADMIN CONTROL PANEL SAKULTHITI CO.,LTD ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/st.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><?php include ("inc/inc_head.php") ?>
      <table width="100%" height="40" border="0" cellpadding="0" cellspacing="0" bgcolor="#1bb3b3">
        <tr>
          <td colspan="3"><table width="100%" height="3" border="0" cellpadding="0" cellspacing="0" bgcolor="#63cdcd">
              <tr>
                <td></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td width="166">&nbsp;</td>
          <td><?php include ("inc/inc_menu_top.php") ?></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="right" class="arialVIO24B">ADMIN</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" background="images/line_main.gif">
  <tr>
    <td width="166" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="1"></td>
      </tr>
    </table>
        <?php include ("inc/inc_menu_admin.php") ?></td>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;">Admin</span></td>
            <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td>&nbsp; &nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8">&nbsp;</td>
            <td valign="top"><?php if($errmsg == ""){ ?>
              <table width="100%" height="200"align="center" cellpadding="5" cellspacing="0" class="border_response">
                <tr>
                  <td align="center" class="arialVIO12B2">Update Data Completed !!&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="editpassword.php" class="text_black_bold">Edit Data</a>
                  </td>
                </tr>
              </table>
              <?php }else{ ?>
              <table width="100%" height="200" align="center" cellpadding="5" cellspacing="0" class="border_response">
                <tr>
                  <td class="text_red_bold" align="center">Update Data Not Completed !!<br>
                              <br><span class="arialVIO11B"><?php echo $errmsg?></span>
							  <br>
                              <br>
                              <a href="javascript:history.back(1)" class="text_black12_bold">Back</a>						   
						    </td>
                </tr>
              </table>
              <?php } ?></td>
            <td width="50">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
	  		  <tr>
        <td height="100">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td height="55" valign="top"><?php include ("inc/inc_footer.php")?></td>
  </tr>
</table>
</body>
</html>
<?php mysql_close();?>