<?php
 require_once '../function/sessionstart.php';
 require_once 'checksession.php';
 require_once '../adodb/adodb.inc.php';
 require_once '../adodb/adodb-active-record.inc.php';
 require_once '../class/class.GenericEasyPagination.php' ;
 require_once '../function/config.php' ; 
 require_once '../function/connect.php';
 require_once '../function/extension.php';
?>
<?php
#$db->debug=1;
$gettmp[resume_id] = $_GET[resume_id];

# $stmt = $db->Prepare('SELECT resumes.*, jobs.job_position FROM jobs Inner Join resumes ON jobs.job_id = resumes.job_id WHERE resume_id =? ');
$stmt = $db->Prepare('SELECT * FROM resumes  WHERE resume_id =? ');
 $rs = $db->Execute($stmt,array($gettmp[resume_id])) ;
 list($getyear, $getmonth, $getday,) = explode("-", $rs->fields['job_date']);
 
	ADOdb_Active_Record::SetDatabaseAdapter($db);
			class resume extends ADOdb_Active_Record{}
			$resume = new resume();
			$resume->load("resume_id=?", array($gettmp[resume_id]));
			$resume->readed = 'Yes';
			$resume->replace();
		


if ($resume): ?>
<script language="JavaScript" type="text/JavaScript">
parent.opener.location.reload();
</script>
<?php endif;
?>
<html>
<head>
<title>:: CONTROL PANEL - SAKULTHITI CO., LTD. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="css/st.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  height="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td width="770"><table width="620" height="220"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8" valign="top">&nbsp;</td>
        <td colspan="2" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
          <tr><td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B">&nbsp;ตำแหน่งงานที่สนใจ</td>
          </tr>
          <tr>
            <td width="524" height="3"></td>
          </tr>
          <tr>
            <td width="524" height="1" background="images/line04.gif"></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellspacing="0">
            <tr>
              <td width="159" valign="top" class="arialVIO12B3">ประเภทงานที่สนใจ : </td>
              <td width="410" class="text_gray_normal"><?php if ($rs->fields["job_type"] != "") {echo $rs->fields["job_type"]; }else{echo "-";}?></td>
            </tr>
          <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
          <tr>
            <td valign="top" class="arialVIO12B3">สาขาวิชาชีพ : </td>
            <td valign="top" class="text_gray_normal"><?php if ($rs->fields["job_sub"] != "") {echo $rs->fields["job_sub"]; }else{echo "-";}?>&nbsp;</td>
          </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
			    <td valign="top" class="arialVIO12B3">ตำแหน่งงาน : </td>
			    <td class="text_gray_normal"><?php if ($rs->fields["job_title"] != "") { echo $rs->fields["job_title"] ; }else {echo "-";}?></td>
		      </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO12B3">ลักษณะงานที่ต้องการ : </td>
              <td class="text_gray_normal">
                1. <?php if ($rs->fields["job_des"] == "") {echo "-";}else{ echo $rs->fields["job_des"]; } ?>
                &nbsp; &nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO11B">&nbsp;</td>
              <td class="text_gray_normal">
                2. <?php if($rs->fields["job_des2"] == "") { echo "-";} else { echo $rs->fields["job_des2"] ; }?>
                &nbsp; &nbsp; </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO11B">&nbsp;</td>
              <td class="text_gray_normal">
                3. <?php if ($rs->fields["job_des3"]== "") {echo "-";}else {echo $rs->fields["job_des3"];}?>
                &nbsp; &nbsp; </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO11B">&nbsp;</td>
              <td class="text_gray_normal">4. <?php if ($rs->fields["job_des4"] == "") { echo "-"; }else { echo $rs->fields["job_des4"];}?></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO11B"><span class="arialVIO12B3">ระดับเงินเดือนที่ต้องการ</span> :</td>
              <td class="text_gray_normal"><?php if ($rs->fields["salary"] == "") {echo "-";}else { echo $rs->fields["salary"] ; }?>                 บาท (ขึ้นไป)</td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO12B3">สนใจทำงานที่ : </td>
              <td class="text_gray_normal"><?php if ($rs->fields["job_place"] == "") {echo "-";}else{ echo $rs->fields["job_place"];}?></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="arialVIO11B">&nbsp;</td>
              <td class="text_gray_normal"><?php if ($rs->fields["job_place2"] == ""){echo "-";}else{echo $rs->fields["job_place2"];}?> &nbsp;&nbsp;<?php if($rs->fields["job_place3"] != ""){echo "อื่นๆ(ระบุ)&nbsp;&nbsp;".$rs->fields["job_place3"];}?></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
          </table>
            <br />
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
			  <td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B"> &nbsp;ประวัติส่วนบุคคล</td>
              </tr>
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <div align="center">
              <table width="100%" 
            border="0" cellspacing="0">
                <tbody>
                 <tr>
                   <td width="169" valign="top" class="arialVIO12B3" >ชื่อ-นามสกุล :</td>
                   <td width="439" valign="top" class="text_gray_normal" ><?php echo $rs->fields["prefix_name"]?><?php echo $rs->fields["firstname"]?>&nbsp;&nbsp;<?php echo $rs->fields["lastname"]?></td>
                 </tr>
                 <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    
                  </tr>
                  
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >อีเมลล์ :</td>
                    <td align="left" valign="top" class="text_gray_normal"><a href="mailto:<?php echo $rs->fields["email"]?>" class="text_gray_normal">
                      <?php if ($rs->fields["email"] == ""){echo "-";}else { echo $rs->fields["email"];}?>
                    </a></td>
                  </tr>
                  
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                   <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >บัตรประชาชนเลขที่ :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php if ($rs->fields["cardnumber"]==""){echo "-";}else{echo $rs->fields["cardnumber"] ; }?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >ออก ณ อำเภอ  :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php if ($rs->fields["cardplace"]==""){echo "-";}else{echo $rs->fields["cardplace"] ; }?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >ที่อยู่ :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php if ($rs->fields["address"]==""){echo "-";}else{echo nl2br($rs->fields["address"]) ; }?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >จังหวัด :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["province"]=="") {echo "-";}else{echo $rs->fields["province"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >รหัสไปรษณีย์ :</td>
                    <td  align="left" valign="top" class="text_gray_normal" ><?php if ($rs->fields["postcode"]=="") {echo "-";}else { echo $rs->fields["postcode"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO12B3" >ภูมิลำเนาเดิม : </td>
                    <td valign="top" class="text_gray_normal" ><?php echo $rs->fields["address2"]?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" ><span class="arialVIO12B3">จังหวัด :</span></td>
                    <td valign="top" class="text_gray_normal" ><?php echo $rs->fields["province2"]?>&nbsp;</td>
                  </tr>
                 <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                 <tr>
                   <td valign="top" class="arialVIO11B" ><span class="arialVIO12B3">รหัสไปรษณีย์ :</span></td>
                   <td valign="top" class="text_gray_normal" ><?php echo $rs->fields["postcode2"]?>&nbsp;</td>
                 </tr>
                <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >โทรศัพท์ที่บ้าน :</td>
                    <td  align="left" valign="top" class="text_gray_normal" ><?php if ($rs->fields["tel"]=="") { echo "-";}else {echo $rs->fields["tel"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >โทรศัพท์มือถือ :</td>
                    <td  align="left" valign="top" class="text_gray_normal" ><?php if ($rs->fields["mobile"]=="") {echo "-";}else {echo $rs->fields["mobile"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                </tbody>
              </table>
          </div>
          <br />
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                  <td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B">&nbsp;รายละเอียดส่วนบุคคล</td>
              </tr>
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <table width="100%" 
            border="0" align="center" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td width="171" valign="top" class="arialVIO12B3">วัน/เดือน/ปีเกิด :</td>
                  <td colspan="4" class="text_gray_normal"><?php echo $rs->fields["dob_date"]?>&nbsp;&nbsp;<?php echo $rs->fields["dob_month"] ?>&nbsp;&nbsp;<?php echo $rs->fields["dob_year"] ?></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="arialVIO12B3">อายุ : </td>
                  <td valign="top" class="text_gray_normal"><?php echo $rs->fields["old"]?>&nbsp;<span class="text_black_normal">ปี </span></td>
                  <td colspan="3" valign="top" class="arialVIO12B3">&nbsp;</td>
                </tr>
              <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="171" valign="top" class="arialVIO12B3">เพศ :</td>
                  <td colspan="2" align="left" class="text_gray_normal"><?php echo $rs->fields["p_gender"] ?></td>
                  <td width="64" align="left" class="arialVIO12B3">สถานภาพ : </td>
                  <td width="221" align="left" class="text_gray_normal" ><?php echo $rs->fields["p_marital_st"]?></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO12B3">ถ้าแต่งงานแล้ว : </td>
                </tr>
                 <tr>
            <td height="10"></td>
          </tr>
                
                <tr>
                  <td valign="top" class="arialVIO12B3">ชื่อสามี หรือ ภรรยา : </td>
                  <td colspan="4" valign="top" class="text_gray_normal"><?php if ($rs->fields["p_marital_name"]=="") {echo "-";}else {echo $rs->fields["p_marital_name"];}?>&nbsp;</td>
                </tr>
               <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
               <tr>
                 <td valign="top" class="arialVIO12B3">สถานที่ทำงาน : </td>
                 <td colspan="4" valign="top" class="text_gray_normal"><?php if ($rs->fields["p_marital_work"]=="") {echo "-";}else {echo $rs->fields["p_marital_work"];}?>&nbsp;</td>
                </tr>
             <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
             <tr>
               <td valign="top" class="arialVIO12B3">ที่อยู่ : </td>
               <td colspan="4" valign="top" class="text_gray_normal"><?php if ($rs->fields["p_marital_workadd"]=="") {echo "-";}else {echo $rs->fields["p_marital_workadd"];}?>&nbsp;</td>
               </tr>
             <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td width="171" valign="top" class="arialVIO12B3">ส่วนสูง: </td>
                  <td colspan="2" align="left" class="text_gray_normal"><?php echo $rs->fields["p_height"]?>
                      <span class="text_gray_normal">ซม.</span></td>
                  <td width="64" align="left" class="arialVIO12B3">น้ำหนัก : </td>
                  <td align="left" class="text_gray_normal"><?php echo $rs->fields["p_weight"]?>
                      <span class="text_gray_normal">กก.</span></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="171" valign="top" class="arialVIO12B3">สัญชาติ : </td>
                  <td colspan="2" align="left" class="text_gray_normal"><?php echo $rs->fields["p_nationality"]?>                  </td>
                  <td width="64" align="left" class="arialVIO12B3">เชื้อชาติ :</td>
                  <td align="left" class="text_gray_normal" ><?php if ($rs->fields["p_race"]=="") {echo "-";}else{echo $rs->fields["p_race"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="171" valign="top" class="arialVIO12B3">ศาสนา :</td>
                  <td colspan="4" class="text_gray_normal"><?php if ($rs->fields["p_religion"]=="") {echo "-";}else{ echo $rs->fields["p_religion"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td width="171" valign="top" class="arialVIO12B3">จำนวนบุตร :</td>
                  <td colspan="4" class="text_gray_normal"><?php if( $rs->fields["p_child"]=="") {echo "-";}else{echo $rs->fields["p_child"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="171" valign="top" class="arialVIO12B3">สถานภาพทางทหาร :</td>
                  <td colspan="4" class="text_gray_normal"><?php if ($rs->fields["p_military_st"]=="") {echo "-";}else {echo $rs->fields["p_military_st"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
				 <tr>
                  <td width="171" valign="top" class="arialVIO12B3">อาชีพปัจจุบัน :</td>
                  <td colspan="4" class="text_gray_normal"><?php if($rs->fields["p_pre_occ"]==""){echo "-";}else {echo $rs->fields["p_pre_occ"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">รายได้โดยประมาณ :</td>
				   <td colspan="4" class="text_gray_normal"><?php if($rs->fields["p_pre_salary"]==""){echo "-";}else{ echo $rs->fields["p_pre_salary"];}?> บาท/เดือน </td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">บิดาชื่อ :</td>
				   <td colspan="4" class="text_gray_normal"><?php if($rs->fields["p_father"]==""){echo "-";}else{ echo $rs->fields["p_father"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">อายุ : </td>
				   <td width="54" class="text_gray_normal"><?php if($rs->fields["p_fa_old"]==""){echo "-";}else{ echo $rs->fields["p_fa_old"];}?>&nbsp;<span class="text_gray_normal">ปี</span></td>
			       <td width="102" class="text_gray_normal">&nbsp;</td>
			       <td width="64" class="arialVIO12B3">อาชีพ : </td>
			       <td class="text_gray_normal"><?php if($rs->fields["p_fa_occ"]==""){echo "-";}else{ echo $rs->fields["p_fa_occ"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO11B">&nbsp;</td>
				   <td colspan="4" class="text_gray_normal"><?php if($rs->fields["p_fa_status"]==""){echo "-";}else{ echo $rs->fields["p_fa_status"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">มารดาชื่อ : </td>
				   <td colspan="4" class="text_gray_normal"><?php if($rs->fields["p_marther"]==""){echo "-";}else{ echo $rs->fields["p_marther"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">อายุ : </td>
				   <td width="54" class="text_gray_normal"><?php if($rs->fields["p_ma_old"]==""){echo "-";}else{ echo $rs->fields["p_ma_old"];}?>&nbsp;<span class="text_gray_normal">ปี</span></td>
			       <td width="102" class="text_gray_normal">&nbsp;</td>
			       <td width="64" class="text_gray_normal"><span class="arialVIO12B3">อาชีพ : </span></td>
			       <td class="text_gray_normal"><?php if($rs->fields["p_ma_occ"]==""){echo "-";}else{ echo $rs->fields["p_ma_occ"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO11B">&nbsp;</td>
				   <td colspan="4" class="text_gray_normal"><?php if($rs->fields["p_ma_status"]==""){echo "-";}else{ echo $rs->fields["p_ma_status"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">จำนวนพี่น้องทั้งหมด :</td>
				   <td class="text_gray_normal"><?php if($rs->fields["sister"]==""){echo "-";}else{ echo $rs->fields["sister"];}?>&nbsp;คน</td>
			       <td class="text_gray_normal">&nbsp;</td>
			       <td class="arialVIO11B">&nbsp;</td>
			       <td class="text_gray_normal">&nbsp;</td>
			    </tr>
				
				
				 
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td valign="top" class="arialVIO12B3">เป็นคนที่ : </td>
				   <td colspan="4" class="text_gray_normal"><?php if($rs->fields["sis_num"]==""){echo "-";}else{ echo $rs->fields["sis_num"];}?>&nbsp;</td>
			    </tr>
				 <tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				 <tr>
				   <td colspan="5" valign="top" class="arialVIO12B3">1.</td>
			    </tr>
				<tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				<tr>
				  <td valign="top" class="arialVIO12B3">ชื่อ-สกุลของพี่น้อง : </td>
			      <td colspan="4" valign="top" class="text_gray_normal">
				  <?php if($rs->fields["sis_name"] == "") : echo  "-"; else : echo $rs->fields["sis_name"]; endif ?>				  </td>
		        </tr>
				<tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				<tr>
				  <td valign="top" class="arialVIO12B3">อาชีพ : </td>
			      <td colspan="4" valign="top" class="text_gray_normal">
				  <?php if($rs->fields["sis_occ"] == "") : echo  "-"; else : echo $rs->fields["sis_occ"]; endif ?>				  </td>
		        </tr>
				<tr>
                  <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                  </table></td>
			    </tr>
		      <td colspan="5" valign="top" class="arialVIO12B3">2.</td>
			    </tr>
				<tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				<tr>
				  <td valign="top" class="arialVIO12B3">ชื่อ-สกุลของพี่น้อง : </td>
			      <td colspan="4" valign="top" class="text_gray_normal">
				  <?php if($rs->fields["sis_name2"] == "") : echo  "-"; else : echo $rs->fields["sis_name2"]; endif ?>				 </td>
		        </tr>
				<tr>
                   <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                       <tr>
                         <td height="10"></td>
                       </tr>
                   </table></td>
			    </tr>
				<tr>
				  <td valign="top" class="arialVIO12B3">อาชีพ : </td>
			      <td colspan="4" valign="top" class="text_gray_normal">
				  <?php if($rs->fields["sis_occ2"] == "") : echo  "-"; else : echo $rs->fields["sis_occ2"]; endif ?>				  </td>
            </table>
          <br />
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                  <td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B">&nbsp;ประวัติการศึกษาสูงสุด</td>
              </tr>
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <table width="100%" border="0" align="center" 
      cellspacing="0">
              <tbody>
                <tr>
                  <td colspan="4" class="arialVIO12B3">1. วุฒิการศึกษาที่ใช้ในการสมัครงาน </td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO12B3">ระดับการศึกษา :</td>
                  <td colspan="3" class="text_gray_normal" ><?php if($rs->fields["edu_lv"] == ""){echo "-";}else{echo $rs->fields["edu_lv"];}?></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO12B3">สถานศึกษา  :</td>
                  <td colspan="3" class="text_gray_normal"><?php if($rs->fields["edu_inst"]==""){echo "-";}else{echo $rs->fields["edu_inst"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO11B"> <span class="arialVIO12B3">วุฒิการศึกษา :</span></td>
                  <td colspan="3" class="text_gray_normal"><?php if($rs->fields["edu_cert"]==""){echo "-";}else{echo $rs->fields["edu_cert"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO12B3">สาขาวิชา : </td>
                  <td colspan="3" class="text_gray_normal"><?php if($rs->fields["edu_major"] == ""){echo "-";}else{echo $rs->fields["edu_major"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="arialVIO12B3">สำเร็จการศึกษา :</td>
                  <td class="text_gray_normal"><?php if($rs->fields["edu_st"]==""){echo "-";}else{echo $rs->fields["edu_st"];} ?></td>
                  <td class="arialVIO12B3">ปี :</td>
                  <td class="text_gray_normal"><?php if($rs->fields["edu_grd"]==""){echo "-";}else{echo $rs->fields["edu_grd"];}?></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO12B3">เกรดเฉลี่ย : </td>
                  <td width="153" class="text_gray_normal"><?php if($rs->fields["edu_gpa"]==""){echo "-";}else{echo $rs->fields["edu_gpa"];} ?></td>
                  <td width="19" class="arialVIO11B">&nbsp;</td>
                  <td width="263" class="text_gray_normal">&nbsp;</td>
                </tr>
                
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO12B3">2. วุฒิการศึกษา (ก่อนหน้า) </td>
                </tr>
             <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO11B"><span class="arialVIO12B3">ระดับการศึกษา :</span></td>
                  <td colspan="3" class="text_gray_normal" ><?php if($rs->fields["edu2_lv"]==""){echo "-";}else{echo $rs->fields["edu2_lv"];} ?></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO11B"><span class="arialVIO12B3">สถานศึกษา  :</span></td>
                  <td colspan="3" class="text_gray_normal"><?php if($rs->fields["edu2_inst"]==""){echo "-";}else{ echo $rs->fields["edu2_inst"];}?></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO11B"><span class="arialVIO12B3">วุฒิการศึกษา :</span></td>
                  <td colspan="3" class="text_gray_normal"><?php if($rs->fields["edu2_cert"]==""){echo "-";}else{echo $rs->fields["edu2_cert"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="169" class="arialVIO11B"><span class="arialVIO12B3">สาขาวิชา : </span></td>
                  <td colspan="3" class="text_gray_normal"><?php if($rs->fields["edu2_major"]==""){echo "-";}else{ echo $rs->fields["edu2_major"];}?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="arialVIO11B"><span class="arialVIO12B3">สำเร็จการศึกษา :</span></td>
                  <td class="text_gray_normal"><?php if($rs->fields["edu2_st"]==""){echo "-";}else{ echo $rs->fields["edu2_st"] ;}?></td>
                  <td width="19" class="arialVIO12B3">ปี :</td>
                  <td class="text_gray_normal"><?php if($rs->fields["edu2_grd"]==""){echo "-";}else{echo $rs->fields["edu2_grd"];}?></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="arialVIO12B3">เกรดเฉลี่ย : </td>
                  <td class="text_gray_normal"><?php if($rs->fields["edu2_gpa"]==""){echo "-";}else{echo $rs->fields["edu2_gpa"];} ?></td>
                  <td class="arialVIO11B">&nbsp;</td>
                  <td class="text_gray_normal">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                
                <!-- Second Grad -->
              </tbody>
            </table>
          </div>
            <br />
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                 <td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B">&nbsp;ประวัติการทำงาน</td>
              </tr>
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
              <tr>
                <td width="165" valign="top" class="arialVIO12B3">ประสบการณ์ทำงานรวม : </td>
                <td colspan="3" class="text_gray_normal"><?php if($rs->fields["exp_earn"]=="") {echo "-";}else{echo $rs->fields["exp_earn"];}?>
                  &nbsp;<span class="arialVIO11B">&nbsp;</span><span class="text_gray_normal">ปี</span></td>
              </tr>
              <tr>
                  <td height="10" colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td colspan="4" class="arialVIO12B3" >1. ประสบการณ์ทำงาน </td>
              </tr>
             <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td width="165" align="left" class="arialVIO11B"> <span class="arialVIO12B3">เริ่มจาก : </span></td>
                <td width="149" class="text_gray_normal"><?php if($rs->fields["exp_month_frm"]==""){echo "-";}else{echo $rs->fields["exp_month_frm"];} ?>  &nbsp;<?php if($rs->fields["exp_year_frm"]== ""){echo "-";}else{echo $rs->fields["exp_year_frm"] ;}?>                </td>
                <td width="26" class="text_gray_normal"><span class="arialVIO12B3">ถึง : </span></td>
                <td width="248" class="text_gray_normal">
                  <?php if($rs->fields["exp_month_to"]==""){echo "-";}else{echo $rs->fields["exp_month_to"];} ?>
                  &nbsp;
                  <?php if($rs->fields["exp_year_frm"]==""){echo "-";}else{echo $rs->fields["exp_year_frm"];}?></td>
              </tr>
             <tr>
                <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="165" class="arialVIO12B3">ชื่อบริษัท :</td>
                <td colspan="3" class="text_gray_normal"><?php if($rs->fields["exp_company"]==""){echo "-";}else{echo $rs->fields["exp_company"];}?></td>
              </tr>
             <tr>
                <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="165" valign="top" class="arialVIO12B3">ที่อยู่  : </td>
                <td colspan="3" valign="top" class="text_gray_normal"><?php if($rs->fields["exp_address"]==""){echo "-";}else{echo nl2br($rs->fields["exp_address"]);}?></td>
              </tr>
             <tr>
                <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="165" class="arialVIO12B3">ตำแหน่ง : </td>
                <td colspan="3" class="text_gray_normal"><?php if($rs->fields["exp_pos"]==""){echo "-";}else{echo $rs->fields["exp_pos"];}?></td>
              </tr>
            <tr>
                <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="165" class="arialVIO12B3">เงินเดือน : </td>
                <td colspan="3" class="text_gray_normal"><?php if($rs->fields["exp_salary"]==""){echo "-";}else{echo $rs->fields["exp_salary"];}?> บาท/เดือน </td>
              </tr>
            <tr>
                <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="165" valign="top" class="arialVIO12B3">หน้าที่ความรับผิดชอบ : </td>
                <td colspan="3" class="text_gray_normal"><?php if($rs->fields["exp_duty"]==""){echo "-";}else{echo nl2br($rs->fields["exp_duty"]);}?></td>
                <!--- History3 -->
              </tr>
             <tr>
                <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">สาเหตุที่ออก :</span> </td>
                <td colspan="3" class="text_gray_normal"><?php if($rs->fields["exp_reason"]==""){echo "-";}else{echo nl2br($rs->fields["exp_reason"]);}?></td>
                <!--- History3 -->
              </tr>
              <tbody>
                
                <tr>
                  <td colspan="4" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B" >2.<span class="arialVIO12B3"> ประสบการณ์ทำงาน </span></td>
                </tr>
              <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" align="left" valign="top" class="arialVIO11B"><span class="arialVIO12B3">เริ่มจาก : </span></td>
                  <td width="149" class="text_gray_normal"><?php if($rs->fields["exp2_month_frm"]==""){echo "-";}else{echo $rs->fields["exp2_month_frm"];} ?>
                    <?php if($rs->fields["exp2_year_frm"]==""){echo "-";}else{echo $rs->fields["exp2_year_frm"];} ?></td>
                  <td class="arialVIO12B3">ถึง : </td>
                  <td class="text_gray_normal">
                    <?php if($rs->fields["exp2_month_to"]==""){echo "-";}else{echo $rs->fields["exp2_month_to"];} ?>
                    &nbsp;
                    <?php if($rs->fields["exp2_year_to"]==""){echo "-";}else{echo $rs->fields["exp2_year_to"];}?></td>
                </tr>
                <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">ชื่อบริษัท :</span></td>
                  <td colspan="3" class="text_gray_normal"><?php  if($rs->fields["exp2_company"]==""){echo "-";}else{echo $rs->fields["exp2_company"];}?></td>
                </tr>
               <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">ที่อยู่  : </span></td>
                  <td colspan="3" class="text_gray_normal"><?php  if($rs->fields["exp2_address"]==""){echo "-";}else{echo $rs->fields["exp2_address"];}?></td>
                </tr>
              <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">ตำแหน่ง : </span></td>
                  <td colspan="3" class="text_gray_normal"><?php  if($rs->fields["exp2_pos"]==""){echo "-";}else{echo $rs->fields["exp2_pos"];}?></td>
                </tr>
               <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">เงินเดือน : </span></td>
                  <td colspan="3" class="text_gray_normal"><?php  if($rs->fields["exp2_salary"]==""){echo "-";}else{echo $rs->fields["exp2_salary"];}?></td>
                </tr>
               <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">หน้าที่ความรับผิดชอบ : </span></td>
                  <td colspan="3" class="text_gray_normal"><?php  if($rs->fields["exp2_duty"]==""){echo "-";}else{echo nl2br($rs->fields["exp2_duty"]);}?></td>
                </tr>
              <tr>
                  <td colspan="4" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="165" valign="top" class="arialVIO11B"><span class="arialVIO12B3">สาเหตุที่ออก :</span></td>
                  <td colspan="3" class="text_gray_normal"><?php  if($rs->fields["exp2_reason"]==""){echo "-";}else{echo nl2br($rs->fields["exp2_reason"]);}?></td>
                  <br />
                  <!--- History3 -->
                </tr>
              
                <tr>
                  <td colspan="4" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>                </tr>
                <tr>
                  <td valign="top" class="arialVIO11B">&nbsp;</td>
                  <td colspan="3" class="text_gray_normal">&nbsp;</td>
                </tr>
              </tbody>
              <tbody>
              </tbody>
              <tbody>
              </tbody>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                  <td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B"> &nbsp;ประวัติการฝึกอบรม</td>
              </tr>
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <div align="center">
              <table width="100%" 
            border="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >1.ประวัติการฝึกอบรม</td>
                    <td colspan="4" align="left" valign="top" class="text_gray_normal"  >&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >ระยะเวลา :</td>
                    <td align="left" valign="top" class="text_gray_normal"  ><span class="arialVIO12B3"><strong>จาก : </strong></span></td>
                    <td width="111" align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["trn_month_frm"]==""){echo "-";}else{echo $rs->fields["trn_month_frm"];}?>
&nbsp;&nbsp;
<?php if($rs->fields["trn_year_frm"]==""){echo "-";}else{echo $rs->fields["trn_year_frm"];}?></td>
                    <td width="29" align="left" valign="top" class="arialVIO12B3"  >ถึง : </td>
                    <td width="253" align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["trn_month_to"]==""){echo "-";}else{echo $rs->fields["trn_month_to"];}?>
&nbsp;&nbsp;
<?php if($rs->fields["trn_year_to"]==""){echo "-";}else{echo $rs->fields["trn_year_to"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="5" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >สถาบันอบรม :</td>
                    <td colspan="4" align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["trn_inst"]==""){echo "-";}else{echo $rs->fields["trn_inst"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="5" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO12B3" >หลักสูตร :</td>
                    <td colspan="4" align="left" valign="top" class="text_gray_normal"><?php if($rs->fields["trn_cert"]==""){echo "-";}else{echo $rs->fields["trn_cert"];}?></td>
                  </tr>
                 
                  <tr>
                    <td colspan="5" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO11B" >2. <span class="arialVIO12B3">ประวัติการฝึกอบรม</span></td>
                    <td colspan="4" align="left" valign="top" class="text_gray_normal"  >&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO11B" ><span class="arialVIO12B3">ระยะเวลา :</span></td>
                    <td width="40" align="left" valign="top" class="text_gray_normal"  ><span class="arialVIO12B3"><strong>จาก :</strong></span></td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["trn2_month_frm"]==""){echo "-";}else{echo $rs->fields["trn2_month_frm"];}?>
&nbsp;<strong>&nbsp;</strong>
<?php if($rs->fields["trn2_year_frm"]==""){echo "-";}else{echo $rs->fields["trn2_year_frm"];}?></td>
                    <td align="left" valign="top" class="text_gray_normal"  ><span class="arialVIO12B3"><strong>ถึง :</strong></span></td>
                    <td align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["trn2_month_to"]==""){echo "-";}else{echo $rs->fields["trn2_month_to"];}?>
                      &nbsp;
                      <?php if($rs->fields["trn2_year_to"]==""){echo "-";}else{echo $rs->fields["trn2_year_to"];}?></td>
                  </tr>
                  <tr>
                    <td colspan="5" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO11B" ><span class="arialVIO12B3">สถาบันอบรม :</span></td>
                    <td colspan="4" align="left" valign="top" class="text_gray_normal"  ><?php if($rs->fields["trn2_inst"]==""){echo "-";}else{echo $rs->fields["trn2_inst"];}?></td>
                  </tr>
                 <tr>
                    <td colspan="5" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="169" valign="top" class="arialVIO11B" ><span class="arialVIO12B3">หลักสูตร :</span></td>
                    <td colspan="4"  align="left" valign="top" class="text_gray_normal" ><?php if($rs->fields["trn2_cert"]==""){echo "-";}else{echo $rs->fields["trn2_cert"];}?></td>
                  </tr>
                  
                  <tr>
                    <td colspan="5" valign="top" class="arialVIO11B" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="arialVIO11B" >&nbsp;</td>
                    <td colspan="4"  align="left" valign="top" class="text_gray_normal" >&nbsp;</td>
                  </tr>
                </tbody>
              </table>
          </div>
          <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
			    <td height="20" colspan="2" bgcolor="#1bb3b3" class="arialWH12B"> &nbsp;ความสามารถ ผลงานต่างๆ </td>
              </tr>
              <tr>
                <td width="524" height="3"></td>
              </tr>
              <tr>
                <td width="524" height="1" background="images/line04.gif"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table>
          <table width="100%" 
            border="0" align="center" cellspacing="0">
            <tbody>
              <tr>
                <td width="169" valign="top" class="arialVIO12B3">ความสามารถทางภาษา : </td>
                <td colspan="4" class="text_gray_normal">&nbsp;</td>
              </tr>
              <tr>
                <td width="169" valign="top" class="arialVIO12B3">ภาษาไทย :</td>
                <td colspan="4" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" id="table8">
                    <tr>
                      <td width="12%" class="arialVIO12B3">พูด : </td>
                      <td width="24%" class="text_gray_normal"><?php if($rs->fields["sk_ln_speak"]==""){echo "-";}else{echo $rs->fields["sk_ln_speak"];}?>                      </td>
                      <td width="12%" class="arialVIO12B3">อ่าน : </td>
                      <td width="23%" class="text_gray_normal"><?php if($rs->fields["sk_ln_read"]==""){echo "-";}else{echo $rs->fields["sk_ln_read"];}?>                      </td>
                      <td width="12%" class="arialVIO11B"><span class="arialVIO12B3"><b class="arialVIO11B">เขียน</b> :</span> </td>
                      <td width="20%" class="text_gray_normal"><?php if($rs->fields["sk_ln_write"]==""){echo "-";}else{echo $rs->fields["sk_ln_write"];}?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">ภาษาอังกฤษ : </td>
                <td colspan="4" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" id="table9">
                    <tr>
                      <td width="12%" class="arialVIO11B"><span class="arialVIO12B3">พูด :</span></td>
                      <td width="24%" class="text_gray_normal"><?php if($rs->fields["sk_ln2_speak"]==""){echo "-";}else{echo $rs->fields["sk_ln2_speak"];}?>                      </td>
                      <td width="12%" class="arialVIO11B"><b></b><span class="arialVIO12B3">อ่าน :</span></td>
                      <td width="23%" class="text_gray_normal"><?php if($rs->fields["sk_ln2_read"]==""){echo "-";}else{echo $rs->fields["sk_ln2_read"];}?>                      </td>
                      <td width="12%" class="arialVIO11B"><span class="arialVIO12B3"><b class="arialVIO11B">เขียน</b> :</span></td>
                      <td width="20%" class="text_gray_normal"><?php if($rs->fields["sk_ln2_write"]==""){echo "-";}else{echo $rs->fields["sk_ln2_write"];}?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO11B"><span class="arialVIO12B3">ภาษา</span>
                    <?php if($rs->fields["sk_ln3"]==""){echo "-";}else{echo $rs->fields["sk_ln3"];}?>
                    <span class="arialVIO12B3">:</span><br></td>
                <td colspan="4" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" id="table7">
                    <tr>
                      <td width="12%" class="arialVIO11B"><span class="arialVIO12B3">พูด :</span></td>
                      <td width="24%" class="text_gray_normal"><?php if($rs->fields["sk_ln3_speak"]==""){echo "-";}else{echo $rs->fields["sk_ln3_speak"];}?>                      </td>
                      <td width="12%" class="arialVIO11B"><b></b><span class="arialVIO12B3">อ่าน :</span></td>
                      <td width="23%" class="text_gray_normal"><?php if($rs->fields["sk_ln3_read"]==""){echo "-";}else{echo $rs->fields["sk_ln3_read"];}?>                      </td>
                      <td width="12%" class="arialVIO11B">&nbsp;<b class="arialVIO11B"></b><span class="arialVIO12B3"><b class="arialVIO11B">เขียน</b> :</span></td>
                      <td width="20%" class="text_gray_normal"><?php if($rs->fields["sk_ln3_write"]==""){echo "-";}else{echo $rs->fields["sk_ln3_write"];}?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO11B"><span class="arialVIO12B3">ภาษา</span>
                    <?php if($rs->fields["sk_ln4"]==""){echo "-";}else{echo $rs->fields["sk_ln4"];}?>
                    <span class="arialVIO12B3"> :</span></td>
                <td colspan="4" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" id="table7">
                    <tr>
                      <td width="12%" class="arialVIO11B"><span class="arialVIO12B3">พูด :</span></td>
                      <td width="24%" class="text_gray_normal"><?php if($rs->fields["sk_ln4_speak"]==""){echo "-";}else{echo $rs->fields["sk_ln4_speak"];}?>                      </td>
                      <td width="12%" class="arialVIO11B"><b></b><span class="arialVIO12B3">อ่าน :</span></td>
                      <td width="23%" class="text_gray_normal"><?php if($rs->fields["sk_ln4_read"]==""){echo "-";}else{echo $rs->fields["sk_ln4_read"];}?>                      </td>
                      <td width="12%" class="arialVIO11B">&nbsp;<b class="arialVIO11B"></b><span class="arialVIO12B3"><b class="arialVIO11B">เขียน</b> :</span></td>
                      <td width="20%" class="text_gray_normal"><?php if($rs->fields["sk_ln4_write"]==""){echo "-";}else{echo $rs->fields["sk_ln4_write"];}?>                      </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5" colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">คอมพิวเตอร์  : </td>
                <td colspan="4" class="text_gray_normal"><span class="arialVIO12B3">โปรแกรม : </span><span class="text_violet_bold02">:</span> &nbsp;
                    <?php if($rs->fields["sk_software"]==""){echo "-";}else{echo $rs->fields["sk_software"];}?>                </td>
              </tr>
              
              <tr>
                <td height="5" colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">พิมพ์ดีด :</td>
                <td width="44" class="text_gray_normal"><p><span class="arialVIO12B3">ไทย  :</span></p></td>
                <td width="109" class="text_gray_normal"><?php if($rs->fields["sk_type_th"]==""){echo "-";}else{echo $rs->fields["sk_type_th"];}?>
                    <span class="arialVIO12B3">คำ/นาที</span></td>
                <td width="56" class="text_gray_normal"><span class="text_violet_normal012"><span class="arialVIO12B3">อังกฤษ  :</span></span></td>
                <td width="224" class="text_gray_normal"><?php if($rs->fields["sk_type_en"]==""){echo "-";}else{echo $rs->fields["sk_type_en"];}?>                  <span class="arialVIO12B3">คำ/นาที</span></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">มีใบอนุญาตขับขี่ : </td>
                <td colspan="2" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span class="arialVIO11B">รถจักรยานยนต์ :</span></td>
                      <td width="5">&nbsp;</td>
                      <td width="50" class="text_gray_normal"><?php if($rs->fields["sk_lsc_bike"]==""){echo "-";}else{echo $rs->fields["sk_lsc_bike"];}?></td>
                    </tr>
                </table></td>
                <td colspan="2" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5">&nbsp;</td>
                      <td width="50" class="text_gray_normal">&nbsp;</td>
                      <td width="5">&nbsp;</td>
                      <td class="arialVIO11B">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO11B">&nbsp;</td>
                <td colspan="2" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span class="arialVIO11B">รถยนต์ :</span> </td>
                      <td width="5">&nbsp;</td>
                      <td width="50" class="text_gray_normal"><?php if($rs->fields["sk_lsc_car"]==""){echo "-";}else{echo $rs->fields["sk_lsc_car"];}?></td>
                    </tr>
                </table></td>
                <td colspan="2" class="text_gray_normal"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5">&nbsp;</td>
                      <td width="50" class="text_gray_normal">&nbsp;</td>
                      <td width="5">&nbsp;</td>
                      <td class="arialVIO11B">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">มีพาหนะส่วนตัว :</td>
                <td colspan="4" class="text_gray_normal"><?php if($rs->fields["sk_lsc"]==""){echo "-";}else{echo $rs->fields["sk_lsc"];}?>                </td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">ทำงานต่างจังหวัด  :</td>
                <td colspan="2" class="text_gray_normal"><?php if($rs->fields["sk_upcountry"]==""){echo "-";}else{echo $rs->fields["sk_upcountry"];}?>
                  &nbsp; &nbsp;</td>
                <td colspan="2" class="text_gray_normal"><span class="arialVIO12B3">ทำงานเป็นกะ  :&nbsp;</span>
                    <?php if($rs->fields["sk_priod"]==""){echo "-";}else{echo $rs->fields["sk_priod"];}?></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">ความสามารถพิเศษอื่นๆ                      : </td>
                <td colspan="4" class="text_gray_normal">1.
                  <?php if($rs->fields["sk_01"]==""){echo "-";}else{echo $rs->fields["sk_01"];}?>
                    <b> <br />
                    </b>2.
                  <?php if($rs->fields["sk_02"]==""){echo "-";}else{echo $rs->fields["sk_02"];}?>
                    <b> <br />
                    </b>3<b>. </b>
                    <?php if($rs->fields["sk_03"]==""){echo "-";}else{echo $rs->fields["sk_03"];}?>
                    <b> <br />
                    </b>4.
                  <?php if($rs->fields["sk_04"]==""){echo "-";}else{echo $rs->fields["sk_04"];}?>
                    <b> <br />
                    </b>5.
                  <?php if($rs->fields["sk_05"]==""){echo "-";}else{echo $rs->fields["sk_05"];}?>
                    <b><br />
                  </b></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
                </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="370" class="arialVIO12B3">ท่านเคยเป็นสมาชิกชมรม,กรรมการสมาคมหรือสหภาพใดๆหรือไม่ : </td>
                    <td  colspan="4" class="text_gray_normal"><?php echo $rs->fields["member"]?>&nbsp;</td>
                  </tr>
                </table></td>
                </tr>
           
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO12B3">ถ้าเคยตำแหน่ง : </td>
                <td colspan="4" valign="top" class="text_gray_normal">
				<?php if($rs->fields["mem_yes"]==""){echo "-";}else{echo $rs->fields["mem_yes"];}?>				</td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
             <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td width="300" class="arialVIO12B3">ผลงาน โครงการ เกียรติประวัติ และประสบการณ์อื่นๆ : </td>
                    <td colspan="4" class="text_gray_normal"><table width="98%" border="0" cellpadding="0" cellspacing="0" class="text_gray_normal">
                      <tr>
                        <td><?php if($rs->fields["sk_other"]==""){echo "-";}else{echo nl2br($rs->fields["sk_other"]);}?></td>
                      </tr>
                    </table>										</td>
                  </tr>
                 <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
             
                </table></td>
                </tr>
              
              <tr>
                <td valign="top" class="arialVIO11B">บุคคลอ้างอิง 
                  :</td>
                <td colspan="4" valign="top" class="text_gray_normal"><?php if($rs->fields["sk_ref_person"]==""){echo "-";}else{echo $rs->fields["sk_ref_person"];}?></td>
              </tr>
              
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" class="arialVIO11B">แนบรูปถ่ายหรือประวัติ :</td>
                <td colspan="4" class="text_gray_normal"></td>
              </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><?php
				  $FilePdf="../img_resume_upload/file/".$rs->fields["enclose_withsize"];
				 // $SizeKbite = getfilesize($FilePdf,"k")."&nbsp;Kb." ;
				 $SizeKbite = number_format($rs->fields["enclose_withsize"]/1024,2)."&nbsp;Kb." ;
				  ?>
                    <?php 
				  if($rs->fields["enclose_with"]!=""){ 
				$fileatt="../img_resume_upload/file/".$rs->fields["enclose_with"];
				 list($name_pic,$type_pic)=explode(".",$rs->fields["enclose_with"]); 
				if(($type_pic=="jpg") OR ($type_pic=="gif")){
 					echo "&nbsp;&nbsp;<font color=#FF0000>มีไฟล์รูปภาพแนบมาด้วย</font>&nbsp; <a href=\"".$fileatt."\"    target=\"_blank\"><img src=\"images/ed_image_stock.gif\"  height=\"18\" border=0></a>";
					echo "&nbsp;&nbsp;[$SizeKbite]";
					echo "<br/><img src=\"$fileatt\"  border=0 >";
					
				}else if($type_pic=="doc"){
 					echo "&nbsp;&nbsp;<font color=#FF0000>มีไฟล์เอกสาร (*.doc) แนบมาด้วย&nbsp; <a href=\"".$fileatt."\"    target=\"_blank\"><img src=\"images/icon_word.gif\" height=\"16\" border=0></a>";
					echo "&nbsp;&nbsp;[$SizeKbite]";
				}else if($type_pic=="xls"){
 					echo "&nbsp;&nbsp;<font color=#FF0000>มีไฟล์เอกสาร (*.xls) แนบมาด้วย&nbsp; <a href=\"".$fileatt."\"    target=\"_blank\"><img src=\"images/icon_exel.gif\" height=\"16\" border=0></a>";
					echo "&nbsp;&nbsp;[$SizeKbite]";
				} else if($type_pic=="zip"){
 					echo "&nbsp;&nbsp;<font color=#FF0000>มีไฟล์เอกสาร (*.zip) แนบมาด้วย&nbsp; <a href=\"".$fileatt."\"    target=\"_blank\"><img src=\"images/icon_zip.gif\" height=\"16\" border=0></a>";
					echo "&nbsp;&nbsp;[$SizeKbite]";
				}else if($type_pic=="rar"){
 					echo "&nbsp;&nbsp;<font color=#FF0000>มีไฟล์เอกสาร (*.rar) แนบมาด้วย&nbsp; <a href=\"".$fileatt."\"    target=\"_blank\"><img src=\"images/icon_winrar.gif\" height=\"12\" border=0></a>";
					echo "&nbsp;&nbsp;[$SizeKbite]";
				}else{
 					echo "&nbsp;&nbsp;<font color=#FF0000>มีไฟล์เอกสาร (*.pdf) แนบมาด้วย&nbsp; <a href=\"".$fileatt."\"    target=\"_blank\"><img src=\"images/icon_pdf_s.gif\" height=\"16\" border=0></a>";
					echo "&nbsp;&nbsp;[$SizeKbite]";
				}
		}else{echo "-";}
		
		?>
                    </td>
                </tr>
              <tr>
                <td colspan="5" valign="top" class="arialVIO11B"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                </table></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td width="597" align="right" valign="top"><a href="javascript:window.print()"><img src="images/print_BAM.gif" width="112" height="31" border="0"></a></td>
        <td width="15" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td align="right" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
    </table>
      <br>    </td>
    <td width="39">&nbsp;</td>
  </tr>
</table>
<table width="100%" height="55"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="100%"><?php include ("inc/inc_footer.php") ?></td>
    
  </tr>
</table>
</body>
</html>