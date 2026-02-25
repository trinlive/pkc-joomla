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
<?php #$db->debug = 1 ;
switch($_POST[MM_action]){
	//  save ข้อมูล
	case "create" :{
		$getdata[imagetopic]="Add Question";		
		$gettmp[question]=$_POST['question'];
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[postdate]=  $_POST['postyear']."-".$_POST['postmonth']."-".$_POST['postday'];
		
		$gettmp[active]=$_POST['active'];
		$gettmp[hot]=$_POST['hot'];
		$gettmp[statusnew]="Y";
		$gettmp[ip] = $_SERVER['REMOTE_ADDR'];
		
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class faq extends ADOdb_Active_Record{}
			$faq = new faq();		
			$faq->question = $gettmp['question'];
			$faq->status_new = $gettmp['statusnew'];
			$faq->hot = $gettmp['hot'];
			$faq->faq_active = $gettmp['active'];
			$faq->postdate = $gettmp[postdate];	
			$faq->ip = $gettmp['ip'] ;
			$faq->faq_cat = "c" ;
			$imagecommit = $faq->save();
			$faq_id =  $faq->faq_id ; 
		
		if($imagecommit) :// ทำการบันทึกข้อมูลเรียบร้อยแล้ว เข้ามาทำการ save รูปภาพ	
			$getdata[msg]="Add Question Completed !!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='faq_answer_new.php?qid=".$faq_id."'  class='arialVIO12B3'>Add Answer</a>";				
			saverecord('Add Question');			
		else :
			$getdata[msg]="<span class=\"arialred12B\">Add Question Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];		// ผลการบันทึกข้อมูลล้มเหลว
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;
	}break;	
	
	//  upnewdate ข้อมูล
	case "update" :{
		$getdata[imagetopic]="Edit Question";
		$gettmp[faq_id]=$_POST['faq_id'];
		$gettmp[question]=$_POST['question'];
		$gettmp[ndate]=$_POST['ndate'];
		$gettmp[nmonth]=$_POST['nmonth'];
		$gettmp[nyear]=$_POST['nyear'];
		$gettmp[postdate]=$gettmp[nyear]."-".$gettmp[nmonth]."-".$gettmp[ndate];	
			
		$gettmp[active]=$_POST['active'];
		$gettmp[hot]=$_POST['hot'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class faq extends ADOdb_Active_Record{}
			$faq = new faq();		
			$faq->load("faq_id=?", array($gettmp[faq_id]));	
			$faq->question = $gettmp['question'];
			$faq->hot = $gettmp['hot'];
			$faq->faq_active = $gettmp['active'];
			$faq->postdate = $gettmp[postdate];			
			$faq->replace();
		
		if($faq->replace()) : // ทำการบันทึกข้อมูลเรียบร้อยแล้ว เข้ามาทำการ save รูปภาพ
			$getdata[msg]="Edit Question Completed !!";
			$getdata[msg].="&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='faq_question_edit.php?qid=$gettmp[faq_id]'  class='arialVIO12B3'>Edit Question</a>";	
			saverecord('Edit Question');			
		else :
			$getdata[msg]="<span class=\"arialred12B\">Edit Question Not Complete !!</span><br>";
			$getdata[msg].=$config[err][database];		// ผลการบันทึกข้อมูลล้มเหลว
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	}break;

	//  delete ข้อมูล
	case "delete" :{
		$getdata[imagetopic]="Delete F.A.Q";
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class faq extends ADOdb_Active_Record{}
			$faq = new faq();
			
			class faq_an extends ADOdb_Active_Record{}
			$faq_an = new faq_an();
			
		foreach($_POST[chkbox] AS $gettmp[faqid]){
			$faq->load("faq_id=?", array($gettmp[faqid]));
			$faq->Delete();
			
			$faq_an->load("faq_id=?", array($gettmp[faqid]));
			$faq_an->Delete();
		}

		if ($faq) :	
			saverecord('Delete Question');	
			$getdata[msg]="Delete Question Completed !!<br>";
			echo "<meta http-equiv=\"refresh\" content=\"2; URL=faq_to_delete.php\">";	
		else :
			$getdata[msg]="<span class=\"arialred12B\">Delete Question Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;
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
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ;?></span></td>
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