<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
 require_once 'class/class.upload.foto.php'; 
?>
<?php
#$db->debug = 1 ;
switch($_POST[MM_action]){
	//  save 
	case "create" :{
		$getdata[imagetopic]="Add categorie";
		$gettmp[cate_name]=$_POST[cate_name];
		$gettmp[cate_status]=$_POST[cate_status];
	
		$gettmp[ndate]=$_POST[ndate];
		$gettmp[nmonth]=$_POST[nmonth];
		$gettmp[nyear]=$_POST[nyear];
		$gettmp[cate_date]=$gettmp[nyear]."-".$gettmp[nmonth]."-".$gettmp[ndate];	
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class categorie extends ADOdb_Active_Record{}
			$categorie = new categorie();		
			$categorie->cate_name = $gettmp['cate_name'];
			$categorie->cate_status = $gettmp['cate_status'];
			$categorie->cate_date = $gettmp['cate_date'];
			
						
		if ($categorie->save()) :
			$getdata[msg]="Add Press Center Completed !!";		
			saverecord('Insert Presscenetr');				
		 else :
			$getdata[msg]="<span class=\"arialred12B\">Add Press Center Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		//  
			$getdata[msg].="<br><a href='javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		 endif ;	
	}break;
	
	case "update" :{
		$getdata[imagetopic]="Edit Category";
		$gettmp[cate_id]=$_POST[cate_id];
		$gettmp[cate_name]=$_POST[cate_name];
		
		$gettmp[cate_status]=$_POST[cate_status];
	
		$gettmp[ndate]=$_POST[ndate];
		$gettmp[nmonth]=$_POST[nmonth];
		$gettmp[nyear]=$_POST[nyear];
		$gettmp[cate_date]=$gettmp[nyear]."-".$gettmp[nmonth]."-".$gettmp[ndate];	
		
		
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class categorie extends ADOdb_Active_Record{}
			$categorie = new categorie();	
			$categorie->load("cate_id=?", array($gettmp[cate_id]));	
			$categorie->cate_name = $gettmp['cate_name'];
			$categorie->cate_status = $gettmp['cate_status'];
			$categorie->cate_date = $gettmp['cate_date'];
						
			
		
		
		if($categorie->replace()) : 
			$getdata[msg]="Update Press Center Completed !!";
		 	$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='category_edit.php?cate_id=".$gettmp[cate_id]."'  class='arialVIO12B3'>Edit Press Center</a>";
		else :
			$getdata[msg]="<span class=\"arialred12B\">Update Press Center Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		//  
			$getdata[msg].="<br><a href='javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	
	}break;
		
	case "delete" :{
		$getdata[imagetopic]="Delete Press Center";

		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class categorie extends ADOdb_Active_Record{}
			$categorie = new categorie();
				foreach($_POST[chkbox] AS $gettmp[cate_id]) :
					#	$gettemp[nid] = $_POST['nid'][$row];	
					$SQLstr = " SELECT fileatt FROM `categories` WHERE `cate_id` =  '".$gettmp[cate_id]."' ";
 					$rs = $db->Execute($SQLstr) ;
					
 					$fileatt = $rs->fields['fileatt'] ;
	  					if ($fileatt != "") :
							if(file_exists("../img_categorie/file/$fileatt")) unlink("../img_categorie/file/$fileatt");
	 					endif ;
					
					$categorie->load("cate_id=?", array($gettmp[cate_id]));
					$categorie->Delete();
				endforeach ;
		if ($categorie) :	
			saverecord('Delete Press Center');	
			$getdata[msg]="Delete Press Center Completed !!<br>";
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=category_to_delete.php\">";	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Press Center Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;
	}break;
}
?>

<html>
<head>
<title>:: ADMIN CONTROL PANEL PAKKRETCITY ::</title>
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
                <td align="right" class="arialVIO24B">PRESS CENTER</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_category.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head05.gif">
          <tr>
            <td width="185" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ;?></span></td>
            <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="214">&nbsp; &nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14"></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="top">
            <td width="8">&nbsp;</td>
            <td><table width="100%" height="200"  border="0" align="center" cellpadding="0" cellspacing="0" class="border_response">
              <tr valign="middle">
                <td align="center" class="arialVIO12B2"><?php echo $getdata[msg]; ?></td>
              </tr>
            </table></td>
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
    <td height="55"><?php include ("inc/inc_footer.php")?></td>
  </tr>
</table>
</body>
</html>