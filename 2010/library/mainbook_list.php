<?ob_start();?> 
<?php
require_once 'function/sessionstatus.php';
require_once 'function/config.php';
require_once 'function/rewrite.php';
require_once 'adodb/adodb.inc.php';
require_once 'class/class.GenericEasyPagination.php'; 
require_once 'adodb/adodb-active-record.inc.php';
require_once 'function/connect.php';
require_once 'library/Smarty.class.php';
require_once 'function/extension.php';
?>

<?php
$SQLstr =  " SELECT * FROM `categories` WHERE `cate_status` = 'Active' ORDER BY `cate_id` desc";
$rs = $db->Execute($SQLstr);
?>
<?php
if ($_GET["page"]!=""):  $page = $_GET["page"]; else:    $page    = 1;        endif;
 define ('RECORDS_BY_PAGE',5);
 define ('CURRENT_PAGE',$page);
 
 $cate = $_GET['cate'];
 
$SQLstr_book =  " SELECT * FROM `book_libraries` WHERE `book_status` = 'Active' AND cate_book='$cate' ORDER BY `book_id` desc";
$db->SetFetchMode(ADODB_FETCH_ASSOC);
$rs_book = $db->PageExecute($SQLstr_book,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs_book->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
$GenericEasyPagination->getsVars = "cate=$cate" ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ศูนย์ข้อมูลข่าวสารเทศบาลนครปากเกร็ด</title>
<link href="css/pobsook.css" rel="stylesheet" type="text/css" /> 

</head>

    <body>


<div class="wrapper">
          <div class="container-top">
                <table width="975" height="351" border="0" align="center" cellpadding="0" cellspacing="0" class="table_top2">
                    <tr>
                        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <tr>
                                    <td width="9" height="88" valign="top">


<table width="975" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top"><a name="top" id="top"></a></td>
            <td height="6"></td>
            <td></td>
          </tr>
          <tr>
            <td width="11" valign="top"></td>
            <td width="259" height="88" valign="top"><div style="position:relative"><div style="position:absolute; top:1px; left:5px"><img src="images/logo.png" /></div>
            </div></td>
            <td valign="top">&nbsp;</td>
          </tr>
</table>
</td>
                                </tr>
                                <tr>
                                    <td height="30" valign="bottom">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="9"></td>
                                                <td width="262" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="52" style="position:relative"><span style="position:absolute; margin-left:160px; margin-top:3px;">
  
                </noscript>
                </span>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(images/left_menu_head.gif) left bottom no-repeat">
                  <tr>
                    <td width="21" height="52" style="position:relative">
                    <span style="position:absolute; margin-left:160px; margin-top:3px;"><img src="images/book_icon.png" /></span></td>
                    <td valign="bottom">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="78" valign="top" bgcolor="#E7ECF7" style="background:url(images/left_menu_top.gif) left top no-repeat"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="21" style="position:relative">
                    <span style="position:absolute; margin-left:30px; margin-top:-50px;"><img src="images/text_icon.png" /></span>
                    </td>
                    <td height="27"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td height="30"><img src="images/text_h.png" width="132" height="23" /></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td height="3"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="txtGray11N05" style="padding-left:2px">ศูนย์ค้นหาข้อมูลข่าวสารเทศบาลนครปากเกร็ด 
                   <br/>
                     ค้นหารวดเร็ว เอกสารครบถ้วน...</td>
                  </tr>
                </table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="position:relative">
    <div class="left_menu-float">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/left_menu_news2.gif">
  <tr>
    <td height="79" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9">&nbsp;</td>
    <td height="59">&nbsp;</td>
    <td width="12">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20">&nbsp;</td>
        <td><img src="images/text_doc.png" /></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
</table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/left_menu_news_c.gif">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    
      <tr>
        <td width="9">&nbsp;</td>
        <td>
        <?php if (!$rs->EOF):?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
     <td height="1" style="background:url(images/border_vertical.gif) repeat-x;" colspan="2"></td>
  </tr>
         <tr>
         <td>
		 <?php  $i=1; while (!$rs->EOF): ?>
         <table width="244" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20" align="center"><img src="images/bullet_green.gif" width="5" height="5" /></td>
    <td width="224" height="22"><a href="mainbook_list.php?cate=<?php echo $rs->fields['cate_id'] ?>" class="txtOrange11N02"><?php echo $rs->fields['cate_name'] ?></a></td>
  </tr>
  <tr>
     <td height="1" style="background:url(images/border_vertical.gif) repeat-x;" colspan="2"></td>
  </tr>
</table>

         <?php $rs->MoveNext(); $i++; ?>
                <?php endwhile; ?>
         </td>
         </tr>
        </table>
        
                <?php endif; ?>
</td>
        <td width="12">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<img src="images/left_menu_news3.gif" width="262" height="23" border="0"  />
     </div>
</td>
  </tr>
</table>

				</td>
              </tr>
              <tr>
                <td style="position:relative">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="position:relative"><div class="pic-float2"></div></td>
  </tr>
  <tr>
    <td style="position:relative"></td>
  </tr>
  <tr>
  <td style="position:relative"></td>
  </tr>
  <tr>
  <td style="position:relative"></td>
  </tr>
  <tr>
  <td style="position:relative"> </td>
  </tr>
</table>



</td>
              </tr>
            </table>
</td>
                                                <td width="31" height="218" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="37">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="154" bgcolor="#FAFEDA">&nbsp;</td>
                                                  </tr>
                                                    </table></td>
                                                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="37" valign="bottom" style="position:relative">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td height="22" style="position:relative">
                                                                        <span style="position:absolute; margin-left:-10px; margin-top:-160px;"><img src="images/head1.png" width="677" height="326" /></span>                                                                        </td>
                                                                    </tr>
                                                              </table></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="154" valign="bottom" bgcolor="#FAFEDA"></td>
                                                  </tr>
                                                        <tr>
                                                            <td height="51" valign="top" style="padding-top:37px">&nbsp;</td>
                                                  </tr>
                                              </table></td>
                                                <td width="4"></td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                    </tr>
                    
                </table>
                
            </div>
            <div class="container-mid">
                <table width="975" height="950" border="0" align="center" cellpadding="0" cellspacing="0" class="table_content">
                    <tr valign="top">
                        <td width="9"></td>
                        <td width="248">&nbsp;</td>
                        <td width="35">&nbsp;</td>
                        <td width="655"><table width="100%" height="15" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="txtBlue11b04"><a href="index.php" class="txtGray11B01">หน้าหลัก</a></td>
                          </tr>
                            </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="TableTopicNews">
                                <tr>
                                <td>&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" height="20" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                <td height="55">&nbsp;</td>
                                </tr>
                            </table>
              <table width="100%"  height="120" border="0" cellpadding="0" cellspacing="0">
                            
                                <tr valign="top">
                                    <td>
                                    <?php if (!$rs_book->EOF):?>
                                 <?php  $i=1; while (!$rs_book->EOF): ?>   
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="LoopNewsMain">
                  <tr>
                    <td>
                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="NewsContent">
                        <tr>
                          <td width="128" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="0" class="border_gray">
                              <tr>
                                <td align="center" width="120" height="159" style="background:url(images/bg_defaults.jpg) top center no-repeat">
                                <?php 
								$check_img = $rs_book->fields['book_images'];
								if($check_img!=''){
								
								?>
                                <a href="detail.php?book_id=<?php echo $rs_book->fields['book_id'] ?>"><img src="img_book/thumbnail/<?php echo $rs_book->fields['book_images'] ?>" width="120" height="159" border="0" /></a>
                                <?php
                                }else{
								?>
                                <a href="detail.php?book_id=<?php echo $rs_book->fields['book_id'] ?>">
                                <img src="img_book/thumbnail/default_image.jpg" width="120" height="159" border="0"/></a>                                <?php
                                }
								?>                                </td>
                              </tr>
                          </table></td>
                          <td width="30">&nbsp;</td>
                          <td valign="top"><table width="448" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="7"></td>
                                <td></td>
                                <td width="3"></td>
                              </tr>
                              <tr>
                                <td width="91">ปีของเรื่อง&nbsp;:&nbsp; </td>
                                <td class="txtBlue11N03"><?php echo $rs_book->fields['book_year'] ?></td>
                                <td class="TxtGreen11B01">&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="4"></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>ชื่อเรื่อง&nbsp;:&nbsp;</td>
                                <td><a href="detail.php?book_id=<?php echo $rs_book->fields['book_id'] ?>" class="txtBlue11b04" ><?php echo $rs_book->fields['book_name'] ?></a></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="9"></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>ชนิดเอกสาร&nbsp;:&nbsp;</td>
                                <td><div align="justify" class="txtBlue11N03"><?php
    $book_type = $rs_book->fields['book_type'];
	if($book_type =="book"){
	echo 'หนังสือ';
	}elseif($book_type =="copy"){
	echo 'สำเนาเอกสาร';
	}elseif($book_type =="promotion"){
	echo 'เอกสารประชาสัมพันธ์';
	}elseif($book_type =="cd"){
	echo 'cd/file';
	}	
	?></div></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="9"></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>เจ้าของเรื่อง&nbsp;:&nbsp;</td>
                                <td><div align="justify" class="txtBlue11N03"><?php echo $rs_book->fields['book_ower'] ?></div></td>
                                <td>&nbsp;</td>
                              </tr>
                          </table></td>
                        </tr>
                    </table>
                    
                    </td>
                  </tr>
                  <tr>
                    <td height="7"></td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td class="line"></td>
                              </tr>
                          </table></td>
                  </tr>
                  <tr>
                    <td height="10"></td>
                  </tr>
                </table>
                               <?php $rs_book->MoveNext(); $i++; ?>
                                <?php endwhile; ?>    
                              <?php endif; ?>      
                                  </td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="60" align="center" class="text_black12_bold">&nbsp;</td>
                            <td align="center" class="txtBlue11N02">
							<?php echo $GenericEasyPagination->getNavigation_prev(); ?>
				  <?php echo $GenericEasyPagination->getCurrentPages(); ?>
				  <?php echo $GenericEasyPagination->getNavigation_next(); ?>                            </td>
            </tr>
                          <tr>
                            <td width="60" align="center" class="text_black12_bold">&nbsp;</td>
                            <td align="center" class="text_black12_bold">&nbsp;</td>
                          </tr>
                        </table>
                            

                      </td>
                      
                        <td><table width="100%" height="47" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="254" height="134" valign="top">
</td>
                                </tr>
                            </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="18"></td>
                                </tr>
                          </table></td>
                    </tr>
                </table>
            </div>

<div class="container-bottom-wrap">
  <div class="container-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="71" bgcolor="#6F5215">&nbsp;</td>
    <td style="background: url(images/footer_bg.gif) left top repeat-x;"><table width="975" height="143" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="table_footer">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="9"></td>
            <td width="234" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="1"></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="14"></td>
                        </tr>
                    </table></td>
                </tr>
              </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr valign="middle">
                          <td width="50" height="12"><img src="images/logo3.png" width="250" height="150" /></td>
                          <td width="95" align="center">&nbsp;</td>
                          <td width="80" align="center">&nbsp;</td>
                          <td width="25">&nbsp;</td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            <td width="26">&nbsp;</td>
            <td valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"></td>
                    <td width="183" height="66" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="10"></td>
                        </tr>
                      </table>
                        
                        
                        </td>
                  </tr>
              </table></td>
            <td width="4"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="49" style="background: url(images/footer_bg.gif) left top repeat-x;">&nbsp;</td>
  </tr>
</table>
  </div>
</div>
        </div>

</body>
</html>