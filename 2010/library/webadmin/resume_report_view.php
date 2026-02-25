<?php
session_start();
include("inc/checksession.php");
require_once('../fnc/config.php');
require_once('../fnc/connect.php');
require_once('../fnc/function.php');
require_once('../fnc/mysql_function.php');
// 	ตรวจสอบค่าที่ส่งมาว่าถูกต้องหรือไม่
//$POSTDATA[FIELD]=array("resume_id");
//$POSTDATA[VALUE]=array($_GET[qid]);
//checkDataGet($POSTDATA,"resume",$_GET[page],"view_resume.php");
// จบการตรวจสอบค่าที่ส่งมา

$getdata[sql]=" resumes.*,job.job_position ";
$getdata[tb]="resumes
LEFT OUTER JOIN job  on (job.job_id = resumes.job_id ) ";	
$getdata[condition]="WHERE resume_id='$_GET[resume_id]'";
											
$getdata=list_data($getdata[sql],$getdata[tb],$getdata[condition]);

$postdata[field]=array("readed");
$postdata[value]=array("Yes");
$update = update_mysql("resumes",$postdata," WHERE  resume_id='$_GET[resume_id]' ")	;
if ($update) { ?>
<script language="JavaScript" type="text/JavaScript">
parent.opener.location.reload();
</script>
<? }
?>
<html>
<head>
<title>:: Bangkok Commercial Asset Management Co., Ltd. ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
body {
	background-color: #6F3750;
	background-image: url(images/bg_head.gif);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="css/st.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i]}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n] for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n]
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2]}
}
//-->
</script></head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr valign="top">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr valign="top">
    <td width="770"><table width="620" height="220"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8" valign="top">&nbsp;</td>
        <td colspan="2" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
          <tr>
            <td height="20" class="border_bg_violet12">&nbsp;ตำแหน่งงานที่สนใจ</td>
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
              <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">ประเภทงานที่สนใจ</span> : </td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                <?=$getdata[data][0]["job_type"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">สาขาวิชาชีพ</span> : </td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                <?=$getdata[data][0]["job_sub"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">ตำแหน่งงานที่สนใจ</span> : </td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                <?=$getdata[data][0]["job_title"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">ลักษณะงานที่ต้องการ</span> : </td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                1. <?=$getdata[data][0]["job_des"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12">&nbsp;</td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                2. <?=$getdata[data][0]["job_des2"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12">&nbsp;</td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                3. <?=$getdata[data][0]["job_des3"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12">&nbsp;</td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                4. <?=$getdata[data][0]["job_des4"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">ระดับเงินเดือนที่ต้องการ</span> : </td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                <?=$getdata[data][0]["salary"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">สนใจทำงานที่</span> : </td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                <?=$getdata[data][0]["job_place"]?>
                &nbsp; &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
			  <tr>
              <td width="159" valign="top" class="text_black_bold12">&nbsp;</td>
              <td width="410" class="text_violet_normal12"><span class="text_violet_bold03">
                <?=$getdata[data][0]["job_place2"]?>
                อื่นๆ(ระบุ)&nbsp; 
                <?=$getdata[data][0]["job_place3"]?>
                &nbsp;</span> </td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                <tr>
                  <td height="10"></td>
                </tr>
              </table></td>
              </tr>
          </table>
            <br />
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                <td height="20" class="border_bg_violet12">&nbsp;<span class="TaSky11N">Profile</span></td>
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
                    <td width="159" valign="top" class="text_black_bold12" >Name :</td>
                    <td width="410" align="left" valign="top" class="text_violet_normal12"  ><?=$getdata[data][0]["firstname"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Surname :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><?=$getdata[data][0]["lastname"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Email :</td>
                    <td align="left" valign="top" class="text_violet_normal12"><a href="mailto:<?=$getdata[data][0]["email"]?>" class="text_violet_normal012">
                      <?=$getdata[data][0]["email"]?>
                    </a></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Address :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><?=$getdata[data][0]["address"]?>                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Province :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><?=$getdata[data][0]["province"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Postcode :</td>
                    <td  align="left" valign="top" class="text_violet_normal12" ><?=$getdata[data][0]["postcode"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Telephone :</td>
                    <td  align="left" valign="top" class="text_violet_normal12" ><?=$getdata[data][0]["tel"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >Mobile :</td>
                    <td  align="left" valign="top" class="text_violet_normal12" ><?=$getdata[data][0]["mobile"]?></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
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
                <td height="20" class="border_bg_violet12">&nbsp;<span class="TaSky11N">Personality</span></td>
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
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">Date of Birth</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["dob_date"]?>
                    /
                    <?=$getdata[data][0]["dob_month"] ?>
                    /
                    <?=$getdata[data][0]["dob_year"] ?></td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="170" valign="top" class="text_black_bold12">Gender :</td>
                  <td  width="122" align="left" class="text_violet_normal12"><?=$getdata[data][0]["p_gender"] ?></td>
                  <td width="95" align="left" class="text_black_bold12"><span class="TaGray11N01">Marital Status</span> : </td>
                  <td width="217" align="left" class="text_violet_normal12" ><?=$getdata[data][0]["p_marital_st"]?></td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">Height</span> : </td>
                  <td width="122" align="left" class="text_violet_normal12"><?=$getdata[data][0]["p_height"]?>
                      <span class="text_violet_normal12">cm.</span></td>
                  <td width="95" align="left" class="text_black_bold12">Weight : </td>
                  <td align="left" class="text_violet_normal12"><?=$getdata[data][0]["p_weight"]?>
                      <span class="text_violet_normal12">kg.</span></td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">Nationality</span> : </td>
                  <td  width="122" align="left" class="text_violet_normal12"><?=$getdata[data][0]["p_nationality"]?>                  </td>
                  <td width="95" align="left" class="text_black_bold12">Race :</td>
                  <td align="left" class="text_violet_normal12" ><?=$getdata[data][0]["p_race"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">Religion</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["p_religion"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">จำนวนบุตร</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["p_child"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">Military Status</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["p_military_st"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
				 <tr>
                  <td width="170" valign="top" class="text_black_bold12"><span class="TaGray11N01">อาชีพปัจจุบัน</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["p_pre_occ"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
				 <tr>
                  <td width="170" valign="top" class="text_black_bold12">รายได้โดยประมาณ:</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["p_pre_salary"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
              </tbody>
            </table>
          <br />
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                <td height="20" class="border_bg_violet12">&nbsp;<span class="TaSky11N">Education</span></td>
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
                  <td colspan="4" class="text_black_bold12">1.</td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"><span class="TaGray11N01">Education Level</span> :</td>
                  <td colspan="3" class="text_violet_normal12" ><?=$getdata[data][0]["edu_lv"]?></td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"><span class="TaGray11N01">Education Institute</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["edu_inst"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"> <span class="TaGray11N01">Certificate</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["edu_cert"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"><span class="TaGray11N01">Major Education</span> : </td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["edu_major"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="text_black_bold12"><span class="TaGray11N01">Present</span> :</td>
                  <td class="text_violet_normal12"><?=$getdata[data][0]["edu_st"] ?></td>
                  <td class="text_black_bold12"><span class="TaGray11N01">Year</span> :</td>
                  <td class="text_violet_normal12"><?=$getdata[data][0]["edu_grd"]?></td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12">GPA : </td>
                  <td width="120" class="text_violet_normal12"><?=$getdata[data][0]["edu_gpa"] ?></td>
                  <td width="53" class="text_black_bold12">&nbsp;</td>
                  <td width="227" class="text_violet_normal12">&nbsp;</td>
                </tr>
                
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12">2.</td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"><span class="TaGray11N01">Education Level</span> :</td>
                  <td colspan="3" class="text_violet_normal12" ><?=$getdata[data][0]["edu2_lv"] ?></td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"><span class="TaGray11N01">Education Institute</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["edu2_inst"]?></td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"> <span class="TaGray11N01">Certificate</span> :</td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["edu2_cert"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="157" class="text_black_bold12"><span class="TaGray11N01">Major Education</span> : </td>
                  <td colspan="3" class="text_violet_normal12"><?=$getdata[data][0]["edu2_major"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="text_black_bold12"><span class="TaGray11N01">Present</span> :</td>
                  <td class="text_violet_normal12"><?=$getdata[data][0]["edu2_st"] ?></td>
                  <td class="text_black_bold12"><span class="TaGray11N01">Year</span> :</td>
                  <td class="text_violet_normal12"><?=$getdata[data][0]["edu2_grd"]?></td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="text_black_bold12">GPA :</td>
                  <td class="text_violet_normal12"><?=$getdata[data][0]["edu2_gpa"] ?></td>
                  <td class="text_black_bold12">&nbsp;</td>
                  <td class="text_violet_normal12">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
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
                <td height="20" class="border_bg_violet12">&nbsp;<span class="TaSky11N">Work Experience</span></td>
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
                <td width="159" valign="top" class="text_black_bold12"><span class="TaSky11N">Work Experience</span> : </td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_earn"]?>
                  &nbsp;<span class="text_black_bold12">&nbsp;</span>Year</td>
              </tr>
              <tr>
                <td colspan="3" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3" class="text_black_bold12" >1</td>
              </tr>
              <tr>
                <td width="159" align="left" class="text_black_bold12"> <span class="TaGray11N01">Work Period</span> : </td>
                <td class="text_violet_normal12"><span class="text_violet_bold12">From</span> <span class="text_violet_bold12">:</span>&nbsp;
                <?=$getdata[data][0]["exp_month_frm"] ?>  &nbsp;<?=$getdata[data][0]["exp_year_frm"] ?>                </td>
                <td class="text_violet_normal12">&nbsp;</td>
              </tr>
              <tr>
                <td width="159" class="text_black_bold12">&nbsp;</td>
                <td colspan="2" class="text_violet_normal12"> <span class="text_violet_bold12">To</span>&nbsp;<strong></span></strong>&nbsp;<span class="text_violet_bold12">:</span> &nbsp;<?=$getdata[data][0]["exp_month_to"] ?>&nbsp; <?=$getdata[data][0]["exp_year_to"]?>                </td>
              </tr>
              <tr>
                <td width="159" class="text_black_bold12">Company :</td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_company"]?></td>
              </tr>
              <tr>
                <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">Address</span>  : </td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_address"]?></td>
              </tr>
              <tr>
                <td width="159" class="text_black_bold12">Position : </td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_pos"]?></td>
              </tr>
              <tr>
                <td width="159" class="text_black_bold12">Salary : </td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_salary"]?></td>
              </tr>
              <tr>
                <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">Responsibility</span> : </td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_duty"]?></td>
                <!--- History3 -->
              </tr>
              <tr>
                <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">Reason of Leaving</span> : </td>
                <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp_reason"]?></td>
                <!--- History3 -->
              </tr>
              <tbody>
                <tr>
                  <td colspan="3" class="text_black_bold12" >&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="3" class="text_black_bold12" >2.</td>
                </tr>
                <tr>
                  <td width="159" align="left" valign="top" class="text_black_bold12"> <span class="TaGray11N01">Work Period</span> : </td>
                  <td colspan="2" class="text_violet_normal12"><span class="text_violet_bold12">From</span></span> <span class="text_violet_bold12">:</span>&nbsp;
                      <?=$getdata[data][0]["exp2_month_frm"] ?> <?=$getdata[data][0]["exp2_year_frm"] ?></td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12">&nbsp;</td>
                  <td colspan="2" class="text_violet_normal12"><span class="text_violet_bold12">To</span>&nbsp;<span class="text_violet_bold12">:</span> &nbsp;</span><?=$getdata[data][0]["exp2_month_to"] ?>&nbsp;<?=$getdata[data][0]["exp2_year_to"]?>                  </td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12">Company :</td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp2_company"]?></td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12">Address : </td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp2_address"]?></td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12">Position : </td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp2_pos"]?></td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12">Salary : </td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp2_salary"]?></td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">Responsibility</span> : </td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp2_duty"]?></td>
                </tr>
                <tr>
                  <td width="159" valign="top" class="text_black_bold12"><span class="TaGray11N01">Reason of Leaving</span> : </td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["exp2_reason"]?></td>
                  <br />
                  <!--- History3 -->
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">&nbsp;</td>
                  <td colspan="2" class="text_violet_normal12">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">&nbsp;</td>
                  <td colspan="2" class="text_violet_normal12">&nbsp;</td>
                </tr>
              </tbody>
              <tbody>
              </tbody>
              <tbody>
              </tbody>
            </table>
          <table border="0" cellpadding="0" cellspacing="0" width="100%" id="table6">
              <tr>
                <td height="20" class="border_bg_violet12">&nbsp;<span class="TaSky11N">Trainning course</span></td>
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
                    <td width="159" valign="top" class="text_black_bold12" >1.</td>
                    <td align="left" valign="top" class="text_violet_normal12"  >&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" ><span class="TaGray11N01">Duration</span> :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><strong>From : </strong>
                      <?=$getdata[data][0]["trn_month_frm"]?>
                      &nbsp;&nbsp;
                      <?=$getdata[data][0]["trn_year_frm"]?></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><strong>To</strong>
:                      <?=$getdata[data][0]["trn_month_to"]?>
                      &nbsp;&nbsp;
                      <?=$getdata[data][0]["trn_year_to"]?></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" ><span class="TaGray11N01">Trainning Institute</span> :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><?=$getdata[data][0]["trn_inst"]?></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" ><span class="TaGray11N01">Trainning Course</span> :</td>
                    <td align="left" valign="top" class="text_violet_normal12"><?=$getdata[data][0]["trn_cert"]?></td>
                  </tr>
                  <tr>
                    <td valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td align="left" valign="top" class="text_violet_normal12"  >&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >2.</td>
                    <td align="left" valign="top" class="text_violet_normal12"  >&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" ><span class="TaGray11N01">Duration</span> :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><strong>From :</strong>
                      <?=$getdata[data][0]["trn2_month_frm"]?>
                      &nbsp;<strong>&nbsp;</strong>
                      <?=$getdata[data][0]["trn2_year_frm"]?></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><strong>To :</strong>
                      <?=$getdata[data][0]["trn2_month_to"]?>&nbsp;
                      <?=$getdata[data][0]["trn2_year_to"]?></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" ><span class="TaGray11N01">Trainning Institute</span> :</td>
                    <td align="left" valign="top" class="text_violet_normal12"  ><?=$getdata[data][0]["trn2_inst"]?></td>
                  </tr>
                  <tr>
                    <td width="159" valign="top" class="text_black_bold12" ><span class="TaGray11N01">Trainning Course</span> :</td>
                    <td  align="left" valign="top" class="text_violet_normal12" ><?=$getdata[data][0]["trn2_cert"]?></td>
                  </tr>
                  <tr>
                    <td valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td  align="left" valign="top" class="text_violet_normal12" >&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top" class="text_black_bold12" ><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                      <tr>
                        <td height="10"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td valign="top" class="text_black_bold12" >&nbsp;</td>
                    <td  align="left" valign="top" class="text_violet_normal12" >&nbsp;</td>
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
                <td height="20" class="border_bg_violet12">&nbsp;<span class="TaSky11N">Skill / Portfolio / Honest </span></td>
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
                  <td width="25%" valign="top" class="text_black_bold12">Thai :</td>
                  <td colspan="4" class="text_violet_normal12"><table width="100%" border="0" cellspacing="0" id="table8">
                    <tr>
                      <td width="12%" class="text_violet_bold12">Speak : </td>
                      <td width="24%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln_speak"]?>                      </td>
                      <td width="12%" class="text_violet_bold12">Read : </td>
                      <td width="23%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln_read"]?>                      </td>
                      <td width="12%" class="text_violet_bold12"><b class="text_black_bold12">&nbsp;</b>Write : </td>
                      <td width="20%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln_write"]?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">English : </td>
                  <td colspan="4" class="text_violet_normal12"><table width="100%" border="0" cellspacing="0" id="table9">
                      
                      <tr>
                        <td width="12%" class="text_violet_bold12">Speak : </td>
                        <td width="24%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln2_speak"]?>
                            </div>                        </td>
                        <td width="12%" class="text_violet_bold12"><b></b>Read : </td>
                        <td width="23%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln2_read"]?>
                            </div>                        </td>
                        <td width="12%" class="text_violet_bold12"><b class="text_black_bold12">&nbsp;</b><b class="text_black_bold12"></b>Write : </td>
                        <td width="20%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln2_write"]?></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Language
                  <?=$getdata[data][0]["sk_ln3"]?>                  :<br></td>
                  <td colspan="4" class="text_violet_normal12"><table width="100%" border="0" cellspacing="0" id="table7">
                      
                      <tr>
                        <td width="12%" class="text_violet_bold12">Speak : </td>
                        <td width="24%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln3_speak"]?>
                            </div>                        </td>
                        <td width="12%" class="text_violet_bold12"><b></b>Read : </td>
                        <td width="23%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln3_read"]?>
                            </div>                        </td>
                        <td width="12%" class="text_violet_bold12">&nbsp;<b class="text_black_bold12"></b>Write : </td>
                        <td width="20%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln3_write"]?></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Language
                    <?=$getdata[data][0]["sk_ln4"]?>
                  :</td>
                  <td colspan="4" class="text_violet_normal12"><table width="100%" border="0" cellspacing="0" id="table7">
                      
                      <tr>
                        <td width="12%" class="text_violet_bold12">Speak : </td>
                        <td width="24%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln4_speak"]?>
                            </div>                        </td>
                        <td width="12%" class="text_violet_bold12"><b></b>Read : </td>
                        <td width="23%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln4_read"]?>                        </td>
                        <td width="12%" class="text_violet_bold12">&nbsp;<b class="text_black_bold12"></b>Write : </td>
                        <td width="20%" class="text_violet_normal12"><?=$getdata[data][0]["sk_ln4_write"]?>
                            </div></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="5" colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Computer skill  : </td>
                  <td colspan="4" class="text_violet_normal12"><span class="text_violet_bold12">Program </span><span class="text_violet_bold02">:</span> &nbsp;
                      <?=$getdata[data][0]["sk_software"]?>                  </td>
                </tr>
                <tr>
                  <td height="5" colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Typing :</td>
                  <td width="8%" class="text_violet_normal12"><p><span class="text_violet_bold12">Thai  :</span></p>                    </td>
                  <td width="20%" class="text_violet_normal12"><span class="text_violet_normal12">
                    <?=$getdata[data][0]["sk_type_th"]?>
                    <span class="text_violet_bold12">(Word/Minute)</span></span></td>
                  <td width="10%" class="text_violet_normal12"><span class="text_violet_normal012"><span class="text_violet_bold12">English :</span></span></td>
                  <td width="37%" class="text_violet_normal12"><span class="text_violet_normal12">
                    <?=$getdata[data][0]["sk_type_en"]?>
&nbsp;<span class="text_violet_bold12">(Word/Minute)</span></span></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Driving License : </td>
                  <td colspan="2" class="text_violet_normal12"><span class="text_violet_bold12">Motorcycle : </span>
                    <?=$getdata[data][0]["sk_lsc_bike"]?></td>
                  <td colspan="2" class="text_violet_normal12"><span class="text_violet_bold12">Car : </span>
                    <?=$getdata[data][0]["sk_lsc_car"]?></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                
                <tr>
                  <td valign="top" class="text_black_bold12">Own Vehicle :</td>
                  <td colspan="4" class="text_violet_normal12"><?=$getdata[data][0]["sk_lsc"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Work Outside Bangkok :</td>
                  <td colspan="2" class="text_violet_normal12"><?=$getdata[data][0]["sk_upcountry"]?>
                    &nbsp; &nbsp;</td>
                  <td colspan="2" class="text_violet_normal12"><span class="text_black_bold12">Work in Period :</span>&nbsp;
                    <?=$getdata[data][0]["sk_priod"]?></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Other Skill                      : </td>
                  <td colspan="4" class="text_violet_normal12">1.
                    <?=$getdata[data][0]["sk_01"]?>
                    <b> <br />
                    </b>2.
                    <?=$getdata[data][0]["sk_02"]?>
                    <b> <br />
                    </b>3<b>. </b>
                      <?=$getdata[data][0]["sk_02"]?>
                    <b> <br />
                    </b>4.
                    <?=$getdata[data][0]["sk_04"]?>
                    <b> <br />
                    </b>5.
                    <?=$getdata[data][0]["sk_05"]?>
                      <b><br />
                    </b></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
              <td valign="top" class="text_black_bold12">Other Experience :</td>
                      <td colspan="4" valign="top" class="text_violet_normal12"><?=$getdata[data][0]["sk_other"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">Reference Person 
                    :</td>
                  <td colspan="4" valign="top" class="text_violet_normal12"><?=$getdata[data][0]["sk_ref_person"]?>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
                    <tr>
                      <td height="10"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td valign="top" class="text_black_bold12">แนบรูปถ่ายหรือประวัติ :</td>
                  <td colspan="4" class="text_violet_normal12">
				  <?php
				  $FilePdf="../img_resume_upload/file/".$getdata[data][0]["enclose_withsize"];
				 // $SizeKbite = getfilesize($FilePdf,"k")."&nbsp;Kb." ;
				 $SizeKbite = number_format($getdata[data][0]["enclose_withsize"]/1024,2)."&nbsp;Kb." ;
				  ?>
				  <?php 
				  if($getdata[data][0]["enclose_with"]!=""){ 
				$fileatt="../img_resume_upload/file/".$getdata[data][0]["enclose_with"];
				 list($name_pic,$type_pic)=explode(".",$getdata[data][0]["enclose_with"]); 
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
		}
		
		?>
                      <br />
                      <br>                  </td>
                </tr>
                <tr>
                  <td colspan="5" valign="top" class="text_black_bold12"><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_violet_double.gif">
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
<table width="100%" height="55"  border="0" cellpadding="0" cellspacing="0" background="images/bg_index_buttom.gif">
  <tr>
    <td width="27%">&nbsp;</td>
    <td width="73%" align="right">&nbsp;</td>
  </tr>
</table>
</body>
</html>

<?
	unset($getdata);
	mysql_close();
?>
