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
#$db->debug=1;
switch($_POST['MM_action']):
	//  save 
	case "create" :
		$getdata[imagetopic]="Add Job";		
	#	$gettmp[news_cate]= '1' ;
		
		$gettmp[job_position]= $_POST['job_position'] ;
		$gettmp[job_description]= $_POST['job_description'] ;
		$gettmp[job_detail]= $_POST['job_detail'] ;
		$gettmp[job_person] = $_POST['job_person'];		
		
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[job_date]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp[active]=$_POST['active'];
		
		ADOdb_Active_Record::SetDatabaseAdapter($db);
			class job extends ADOdb_Active_Record{}
			$job = new job();
			$job->job_id = $gettmp['job_id'];
			$job->job_position = $gettmp['job_position'];
			$job->job_description = $gettmp['job_description'];
			$job->job_detail = $gettmp['job_detail'];
			$job->job_person = $gettmp['job_person'];
			$job->job_date = $gettmp['job_date'];
			$job->job_status = $gettmp['active'];
			$job->save();
	
	
		if($job) : // 
			$getdata[msg]="Add Career Completed !!";
			saverecord('Add Career');		
		else :
			$getdata[msg]="<span class='arialred12B' >Add Job Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
	
	break;
	
	
	//  update 
	case "update" :
		$getdata[imagetopic]="Edit Job";		
	#	$gettmp[news_cate]= '1' ;
				
		$gettmp[job_id]= $_POST['job_id'] ;
		$gettmp[job_position]= $_POST['job_position'] ;
		$gettmp[job_description]= $_POST['job_description'] ;
		$gettmp[job_detail]= $_POST['job_detail'] ;
		$gettmp[job_person] = $_POST['job_person'];		
		
		$gettmp[postday]=$_POST['postday'];
		$gettmp[postmonth]=$_POST['postmonth'];
		$gettmp[postyear]=$_POST['postyear'];
		$gettmp[job_date]=  $gettmp['postyear']."-".$gettmp['postmonth']."-".$gettmp['postday'];
		
		$gettmp[active]=$_POST['active'];
		
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class job extends ADOdb_Active_Record{}
			$job = new job();
			$job->load("job_id=?", array($gettmp[job_id]));
			$job->job_id = $gettmp['job_id'];
			$job->job_position = $gettmp['job_position'];
			$job->job_description = $gettmp['job_description'];
			$job->job_detail = $gettmp['job_detail'];
			$job->job_person = $gettmp['job_person'];
			$job->job_date = $gettmp['job_date'];
			$job->job_status = $gettmp['active'];
			$job->replace();
		
		if($job) : // 
			$getdata[msg]="Update Career Completed !!&nbsp;&nbsp;&nbsp;&nbsp;<span class='arialGray12'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='jobs_edit.php?job_id=$gettmp[job_id]' class='arialVIO12B3' >Edit Job</a>";
			saverecord('Edit Career');		
		else :
			$getdata[msg]="<span class='arialred12B' >Update Career Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;	
			
	break;

	//  delete 
	case "delete" :
		$getdata[imagetopic]="Delete Jobs";		
		#$gettmp[news_cate]= '1' ;
			ADOdb_Active_Record::SetDatabaseAdapter($db);
			class job extends ADOdb_Active_Record{}
			$job = new job();
				foreach($_POST['chkbox'] as $row=>$gettmpjob_id) :
				#	$gettemp[news_id] = $_POST['news_id'][$row];
					$job->load("job_id=?", array($gettmpjob_id));
					$job->Delete();
				endforeach ;
		
		if($job):
			$getdata[msg]="Delete Career Completed !!<br>";
			$getdata[msg].="<meta http-equiv=\"refresh\" content=\"2; URL=jobs_to_delete.php \">";	
			saverecord('Delete Career');
		else :
			$getdata[msg]="<span class='arialred12B' >Delete Career Not Completed !!</span><br>";
			$getdata[msg].=$config[err][database];	
			$getdata[msg].="<br><a href='Javascript:history.back(1)'  class='arialBL12B'>Back</a>";
		endif ;		
	
	
	break;
	
	endswitch ;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<link href="css/st.css" rel="stylesheet" type="text/css" />
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
                <td align="right" class="arialVIO24B">CAREER</td>
                <td width="45">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
    <?php include ("inc/inc_menu_panel.php") ?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(images/line_main.gif) repeat-y">
  <tr valign="top">
    <td width="166"><?php include ("inc/inc_menu_jobs.php") ?></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head05.gif">
          <tr>
            <td width="176" height="29"><span class="arialWH18B" style="margin-left:8px;"><?php echo $getdata[imagetopic] ; ?></span></td>
            <td align="right" class="text_violet_bold">&nbsp; &nbsp; </td>
            <td width="50">&nbsp;</td>
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
            <td><table width="100%" height="220"  border="0" align="center" cellpadding="0" cellspacing="0" class="border_response">
              <tr valign="middle">
                <td align="center"><span  class="arialVIO12B2"><?=$getdata[msg] ?></span></td>
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
    <td height="55" valign="top"><?php include ("inc/inc_footer.php") ?></td>
  </tr>
</table>
</body>
</html>