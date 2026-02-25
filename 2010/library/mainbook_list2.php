<?php
require_once 'function/sessionstatus.php';
require_once 'function/config.php';
require_once 'function/rewrite.php';
require_once 'adodb/adodb.inc.php';
require_once 'class/class.GenericEasyPagination.php'; 

require_once 'function/connect.php';
require_once 'library/Smarty.class.php';


#$db->debug=1;

if ($where!=""):		$page	= $where ;	else:	$page	= 1;		endif;
		define ('RECORDS_BY_PAGE',3);
		define ('CURRENT_PAGE',$page);
		
$render = 'mainbook_list.tpl.php' ;
		
//block news
$SQLstr =  " SELECT * FROM `newses` WHERE `news_active` = 'Active' ORDER BY `nid` desc " ;
$rs = $db->PageExecute($SQLstr,RECORDS_BY_PAGE,CURRENT_PAGE);
$recordsFound = $rs->_maxRecordCount;
$GenericEasyPagination =& new GenericEasyPagination(CURRENT_PAGE,RECORDS_BY_PAGE,"eng");
$GenericEasyPagination->setTotalRecords($recordsFound);
$Npage = $GenericEasyPagination->getNpage();
//end block news

//block activities

	
$template = new Smarty;
$template->compile_check = true;
#$template->debugging = true;

$template->assign("currentpage",CURRENT_PAGE);
$template->assign("totalpage",$GenericEasyPagination->getPagesFound());
$template->assign("prevpage",$Npage['previous']);
$template->assign("nextpage",$Npage['next']);

$template->assign('rec',$rs->GetAssoc());

$template->display($render);
?>