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
switch($_POST[MM_action]){
	//  save ข้อมูล
	case "create" :{
		$getdata[imagetopic]="Add Answer";
		$gettmp[faq_id]=$_POST['faq_id'];
		$gettmp[answer]=$_POST['answer'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class faq_an extends ADOdb_Active_Record{}
			$faq_an = new faq_an();		
			$faq_an->faq_id = $gettmp[faq_id];
			$faq_an->answer = $gettmp[answer];		
			$imagecommit = $faq_an->save();	
		
		if($imagecommit){ // ทำการบันทึกข้อมูลเรียบร้อยแล้ว 		
		
			class faq extends ADOdb_Active_Record{}
			$faq = new faq();	
			$faq->load("faq_id=?", array($gettmp[faq_id]));	
			$faq->status_new = "N";
			$faq->replace();
			
			$getdata[msg]="Add Answer Completed !!<br>";			
			saverecord('Add Answer');				
		}else{
			$getdata[msg]="<span class=\"arialred12B\">Add Answer Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		// ผลการบันทึกข้อมูลล้มเหลว
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		}		
	}break;
	
	//  update ข้อมูล
	case "update" :{
		$getdata[imagetopic]="Edit Answer";
		$gettmp[faq_id]=$_POST['faq_id'] ;
		$gettmp[faq_ans_id]=$_POST['faq_ans_id'];
		$gettmp[answer]=$_POST['answer'];

		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class faq_an extends ADOdb_Active_Record{}
			$faq_an = new faq_an();	
			$faq_an->load("faq_ans_id=?", array($gettmp[faq_ans_id]));		
			$faq_an->answer = $gettmp[answer];		
			$faq_an->replace();	
		
		if($faq_an->replace()){ // ทำการบันทึกข้อมูลเรียบร้อยแล้ว 		
			$getdata[msg]="Edit Answer Completed !!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='faq_answer_edit.php?qid=".$gettmp[faq_id]."'  class='arialVIO12B3'>Edit Answer</a>";	
			saverecord('Edit Answer');					
		}else{
			$getdata[msg]="<span class=\"arialred12B\">Edit Answer Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		// ผลการบันทึกข้อมูลล้มเหลว
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		}	
	}break;
}
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., TLD. ::</title>
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
                <td align="right" class="arialVIO24B">F.A.Q.</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_faq.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ; ?></span></td>
            <td width="446" align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
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
        <td height="50">&nbsp;</td>
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
<?php mysql_close();?>