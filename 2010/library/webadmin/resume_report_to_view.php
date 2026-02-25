<?php
include("inc/checksession.php");
require_once('../fnc/config.php');
require_once('../fnc/connect.php');
require_once('../fnc/function.php');
require_once('../fnc/mysql_function.php');
?>
<html>
<head>
<title>:: CONTROL PANEL - A.HA! WEB CREATION CO., TLD. ::</title>
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
</head>

<body>
<?php include ("inc/inc_head.php") ?>
<?php include ("inc/inc_menu_top.php") ?>
<table width="100%" height="53"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head03.gif">
  <tr>
    <td width="2%"><img src="images/line_left.gif" width="165" height="1"></td>
    <td align="left"><?php include ("inc/inc_menu_panel.php") ?></td>
    <td align="left"><img src="images/topic_page_career.gif" width="180" height="36"></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_black.gif" bgcolor="#FFFFFF">
  <tr>
    <td height="4"></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="images/line_main.gif">
  <tr valign="top">
    <td width="166" rowspan="2"><?php include ("inc/inc_menu_jobs.php") ?><img src="images/line_left.gif" width="166" height="1"><br></td><td colspan="2">
	<table width="100%" height="29"  border="0" cellpadding="0" cellspacing="0" background="images/bg_head04.gif">
      <tr>
        <td width="176" height="29"><img src="images/text_view.gif" width="155" height="15"></td>
        <td width="446" align="right" class="text_violet_bold">&nbsp; &nbsp;  </td>
        <td width="214">&nbsp; &nbsp;</td>
      </tr>
    </table>
	</td>
  </tr>
  <tr valign="top">

    <td width="770">     
      <table width="620" height="220"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8" valign="top">&nbsp;</td>
        <td width="606" valign="top"><br>
          <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="14%" valign="top"> 
              <?
				  
					$getdata[countrecord]=selectcount_mysql("resume_id","resumes","");
					$getpage=getpage($getdata[countrecord],$_GET[page],$config[showlist]);	
					
				  	$getdata[sql]="*";
					$getdata[tb]="resumes";
					$getdata[condition]="order by postdate desc limit ".$getpage[goto].",$config[showlist]";				  			  
				  	$getdata=list_data($getdata[sql],$getdata[tb],$getdata[condition]);
				  	if($getdata[rows]>0){
					?>
              <table width="98%" border="1" cellspacing="0" cellpadding="0" bordercolor="#F7F7F7" align="center">
                <tr bgcolor="#853A5A"> 
                  <td width="11%" align="center" bgcolor="#846E82" class="text_gray_normal"><b><font color="#FFFFFF">ID</font></b></td>
								    <td width="28%" bgcolor="#846E82" class="text_gray_normal"> 
								      <div align="center"><font color="#FFFFFF"><b> POSITION</b></font></div>                      </td>
								    <td width="27%" bgcolor="#846E82" class="text_gray_normal"> 
								      <div align="center"><font color="#FFFFFF"><b> FULLNAME</b></font></div>                      </td>					  
								    <td width="22%" bgcolor="#846E82" class="text_gray_normal"> 
								      <div align="center"><font color="#FFFFFF"><b>DATE</b></font></div>                      </td>			  
				                    <td width="12%" bgcolor="#846E82" class="text_gray_normal"><div align="center"><font color="#FFFFFF"><b>READ</b></font></div></td>
                </tr>
                <?
									for($loop=0; $loop<$getdata[rows]; $loop++){						 
								 ?>
                <tr> 
                  <td width="11%" align="center" class="text_gray_normal"><?=$getdata[data][$loop]["resume_id"]?></td>
								    <td width="28%" class="text_gray_normal"><a href="view_report_resume2.php?resume_id=<?=$getdata[data][$loop]["resume_id"]?>" target="_blank" class="text_gray_normal"><?php $getjob=list_data("job_position","job","WHERE job_id='".$getdata[data][$loop]["job_id"]."' ");echo $getjob[data][0]["job_position"]?></a></td>
								    <td width="27%" class="text_gray_normal"><a href="view_report_resume2.php?resume_id=<?=$getdata[data][$loop]["resume_id"]?>" target="_blank" class="text_gray_normal"><?=$getdata[data][$loop]["firstname"]?>&nbsp;&nbsp;<?=$getdata[data][$loop]["lastname"]?></a></td>
								    <td width="22%" align="center" class="text_gray_normal"><?=time_edit($getdata[data][$loop]["postdate"],1)?>	</td>
				                    <td width="12%" align="center" class="text_gray_normal"><?=$getdata[data][$loop]["readed"]?></td>
                </tr>
                <tr> 
                  <td colspan="5" align="center"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" bgcolor="#C0C0C0">
                      <tr> 
                        <td></td>
					      </tr>
                      </table>				      </td>
				    </tr>
                <? } ?>
                </table>
							    <? if($getpage[totalpage]>1){ ?>
              <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td align="center" class="text_gray_normal"><?=showpage($getpage[page],$getpage[totalpage],"text_gray_normal","")?></td>
				    </tr>
                </table>
							    <? } ?>
              <? }else{ ?>
              <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td align="center" class="text_violet_bold03"><br><br>data not found !!!</td>
				    </tr>
                </table>
                    <? } ?>
              <br>
              </td>
              </tr>
          </table>
          </td></tr>
    </table>      
    <br>
    <br>
    <br>
    <br>    <br>
    <br>    <br>    </td>
    <td width="39">&nbsp;</td>
  </tr>
</table>
<table width="100%" height="55"  border="0" cellpadding="0" cellspacing="0" background="images/bg_index_buttom.gif">
  <tr>
    <td width="27%"><img src="images/index_buttom01.gif" width="291" height="55"></td>
    <td width="73%" align="right"><img src="images/text_copyrights.gif" width="371" height="13"></td>
  </tr>
</table>
</body>
</html>
<?
	unset($getdata);
	unset($getpage);

	mysql_close(); 
?>
