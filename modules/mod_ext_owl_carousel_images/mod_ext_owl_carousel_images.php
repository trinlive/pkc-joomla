<?php 
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x - Joomla 4.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2020 Eco-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Eco-Joom.com
# Author: Makeev Vladimir
#Author email: v.v.makeev@icloud.com
# Websites:  http://eco-joom.com
# Date modified: 05/05/2020 - 13:00
# ------------------------------------------------------------------------
*/


// no direct access
defined('_JEXEC') or die;
$document 					= JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_owl_carousel_images/assets/css/owl.carousel.css');
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_owl_carousel_images/assets/css/owl.theme.css');
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_owl_carousel_images/assets/css/owl.transitions.css');

$moduleclass_sfx			= $params->get('moduleclass_sfx');
$ext_id 					= "mod_".$module->id;
$ext_jquery_ver				= $params->get('ext_jquery_ver', '1.10.2');
$ext_load_jquery			= (int)$params->get('ext_load_jquery', 1);
$ext_load_base				= (int)$params->get('ext_load_base', 1);


// Options Owl Carousel http://www.owlgraphic.com/owlcarousel/#customizing
//---------------------------------------------------------------------

//basic:
$ext_width_block			= (int)$params->get('ext_width_block', 600);
$ext_items 					= (int)$params->get('ext_items', 1);
$ext_navigation				= $params->get('ext_navigation', 'true');
$ext_pagination				= $params->get('ext_pagination', 'true');
$ext_paginationnumbers		= $params->get('ext_paginationnumbers', 'false');

//pro:
$ext_itemsdesktop			= $params->get('ext_itemsdesktop', 'false');
$ext_itemsdesktopsmall		= $params->get('ext_itemsdesktopsmall', 'false');
$ext_itemstablet			= $params->get('ext_itemstablet', 'false');
$ext_itemstabletsmall		= $params->get('ext_itemstabletsmall', 'false');
$ext_itemsmobile			= $params->get('ext_itemsmobile', 'false');
$ext_itemscustom			= $params->get('ext_itemscustom', 'false');
$ext_autoplay				= $params->get('ext_autoplay', 'false');
$ext_stoponhover			= $params->get('ext_stoponhover', 'false');
$ext_slidespeed				= (int)$params->get('ext_slidespeed', 200);
$ext_paginationspeed		= (int)$params->get('ext_paginationspeed', 800);
$ext_rewindspeed			= (int)$params->get('ext_rewindspeed', 1000);
$ext_navigationtext_prev	= trim( $params->get('ext_navigationtext_prev', 'prev') );
$ext_navigationtext_next	= trim( $params->get('ext_navigationtext_next', 'next') );
$ext_rewindnav				= $params->get('ext_rewindnav', 'true');
$ext_scrollperpage			= $params->get('ext_scrollperpage', 'false');
$ext_responsive				= $params->get('ext_responsive', 'true');
$ext_responsiverefreshrate	= (int)$params->get('ext_responsiverefreshrate', 200);
$ext_responsivebasewidth	= $params->get('ext_responsivebasewidth', 'window');
$ext_baseclass				= $params->get('ext_baseclass', 'owl-carousel');
$ext_theme					= $params->get('ext_theme', 'owl-theme');
$ext_lazyload				= $params->get('ext_lazyload', 'false');
$ext_lazyfollow				= $params->get('ext_lazyfollow', 'false');
$ext_lazyeffect				= $params->get('ext_lazyeffect', 'fade');
$ext_autoheight				= $params->get('ext_autoheight', 'false');
$ext_dragbeforeanimfinish	= $params->get('ext_dragbeforeanimfinish', 'true');
$ext_mousedrag				= $params->get('ext_mousedrag', 'true');
$ext_touchdrag				= $params->get('ext_touchdrag', 'true');
$ext_addclassactive			= $params->get('ext_addclassactive', 'false');
$ext_transitionstyle		= $params->get('ext_transitionstyle', 'false');
// Callbacks
$ext_beforeupdate			= $params->get('ext_beforeupdate', 'false');
$ext_afterupdate			= $params->get('ext_afterupdate', 'false');
$ext_beforeinit				= $params->get('ext_beforeinit', 'false');
$ext_afterinit				= $params->get('ext_afterinit', 'false');
$ext_beforemove				= $params->get('ext_beforemove', 'false');
$ext_aftermove				= $params->get('ext_aftermove', 'false');
$ext_afteraction			= $params->get('ext_afteraction', 'false');
$ext_startdragging			= $params->get('ext_startdragging', 'false');
$ext_afterlazyload			= $params->get('ext_afterlazyload', 'false');



	
// Load jQuery
//---------------------------------------------------------------------

$ext_script = <<<SCRIPT


var jQowlImg = false;
function initJQ() {
	if (typeof(jQuery) == 'undefined') {
		if (!jQowlImg) {
			jQowlImg = true;
			document.write('<scr' + 'ipt type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/$ext_jquery_ver/jquery.min.js"></scr' + 'ipt>');
		}
		setTimeout('initJQ()', 500);
	}
}
initJQ(); 
 
 if (jQuery) jQuery.noConflict();    
  
  
 

SCRIPT;

if ($ext_load_jquery  > 0) {
	$document->addScriptDeclaration($ext_script);		
}
if ($ext_load_base  > 0) { 
	$document->addCustomTag('<script type = "text/javascript" src = "'.JURI::root().'modules/mod_ext_owl_carousel_images/assets/js/owl.carousel.min.js"></script>'); 	
}

// Load img params
//---------------------------------------------------------------------

$names = array('img', 'alt', 'url', 'target', 'html');
$max = 10;
foreach($names as $name) {
    ${$name} = array();
    for($i = 1; $i <= $max; ++$i)
        ${$name}[] = $params->get($name . $i);
}	
require JModuleHelper::getLayoutPath('mod_ext_owl_carousel_images', $params->get('layout', 'default'));
?>