<?php

/**
 * @copyright	Copyright (C) 2011 Cédric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class plgSystemMediabox_ck extends \Joomla\CMS\Plugin\CMSPlugin {

	function __construct(&$subject, $config) {
		parent :: __construct($subject, $config);
	}
	
	function onContentPrepareForm($form, $data) {
		// check that we are in the correct plugin
		if ( $form->getName() != 'com_plugins.plugin'
			|| ($data && $data->element != 'mediabox_ck')
			)
			return;

		// check that we have the pro version
		if (! file_exists(dirname(__FILE__) . '/pro/mediaboxck_pro.php')) {
			return;
		}

		\Joomla\CMS\Form\Form::addFormPath(JPATH_SITE . '/plugins/system/mediabox_ck/pro');

		// get the language
		$this->loadLanguage();

		// adds pro options
		$form->loadFile('mediaboxck_pro_options', false);
	}

	function onBeforeRender() {
		
		// get the language
		$this->loadLanguage();
		\Joomla\CMS\Language\Text::script('MEDIABOXCK_SHARE');
		\Joomla\CMS\Language\Text::script('MEDIABOXCK_EMAIL');

		$app = \Joomla\CMS\Factory::getApplication();
		$document = \Joomla\CMS\Factory::getDocument();
		$doctype = $document->getType();
		$input = new \Joomla\CMS\Input\Input();
		
		// si pas en frontend, on sort
		if ($app->isClient('administrator')) {
			return false;
		}

		// si pas HTML, on sort
		if ($doctype !== 'html') {
			return;
		}

		if ($input->get('layout') == 'edit' || $input->get('task') == 'edit' || $input->get('func') == 'edit' || $input->get('controller') == 'config.display.modules') {
			return;
		}

		// calls the pro file
		if (file_exists(dirname(__FILE__) . '/pro/mediaboxck_pro.php')) {
			include_once (dirname(__FILE__) . '/pro/mediaboxck_pro.php');
		}

		// recupere l'ID de la page
		// $id = JRequest::getInt('Itemid');
		$input = new \Joomla\CMS\Input\Input();
		$id = $input->get('Itemid', 'int');

		// charge les parametres
		$IDs = explode(",", $this->params->get('pageselect', '0'));

		// test, si on n'est pas bon on sort
		if (!in_array($id, $IDs) && $IDs[0] != 0)
			return false;

		$cornerradius = $this->params->get('cornerradius', '10');
		$shadowoffset = $this->params->get('shadowoffset', '5');
		$overlayopacity = $this->params->get('overlayopacity', '0.7');
		$bgcolor = $this->params->get('bgcolor', '#1a1a1a');
		$overlaycolor = $this->params->get('overlaycolor', '#000');
		$text1color = $this->params->get('text1color', '#999');
		$text2color = $this->params->get('text2color', '#fff');
		$resizeopening = $this->params->get('resizeopening', 'true');
		$resizeduration = $this->params->get('resizeduration', '240');
		$initialwidth = (int)$this->params->get('initialwidth', '320');
		$initialheight = (int)$this->params->get('initialheight', '180');
		$fullwidth = $this->params->get('fullwidth', '0');
		$defaultwidth = $this->params->get('defaultwidth', '640');
		$defaultheight = $this->params->get('defaultheight', '360');
		$showcaption = $this->params->get('showcaption', 'true');
		$showcounter = $this->params->get('showcounter', 'true');
		$attribtype = $this->params->get('attribtype', 'className');
		$attribname = $this->params->get('attribname', 'lightbox');
		$mobileForce = $this->params->get('mobile_enable', '1') && $this->params->get('mobile_force', '0');

        /* fin de la fonction */

		// loads jQuery
        \Joomla\CMS\HTML\HTMLHelper::_('jquery.framework',true);

        $document->addStyleSheet( 'plugins/system/mediabox_ck/assets/mediaboxck.css?ver=2.6.0' );
		$document->addStyleDeclaration("
			#mbCenter, #mbToolbar {
	background-color: ".$bgcolor.";
	-webkit-border-radius: ".$cornerradius."px;
	-khtml-border-radius: ".$cornerradius."px;
	-moz-border-radius: ".$cornerradius."px;
	border-radius: ".$cornerradius."px;
	-webkit-box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
	-khtml-box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
	-moz-box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
	box-shadow: 0px ".$shadowoffset."px 20px rgba(0,0,0,0.50);
	/* For IE 8 */
	-ms-filter: \"progid:DXImageTransform.Microsoft.Shadow(Strength=".$shadowoffset.", Direction=180, Color='#000000')\";
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=".$shadowoffset.", Direction=180, Color='#000000');
	}
	
	#mbOverlay {
		background-color: ".$overlaycolor.";
		" . ($this->params->get('overlaybgimage', '') ? "background-image: url(".$this->params->get('overlaybgimage', '').");" : "") . "
	}
	
	#mbCenter.mbLoading {
		background-color: ".$bgcolor.";
	}
	
	#mbBottom {
		color: ".$text1color.";
	}
	
	#mbTitle, #mbPrevLink, #mbNextLink, #mbCloseLink, #mbPlayLink, #mbPauseLink, #mbZoomMinus, #mbZoomValue, #mbZoomPlus {
		color: ".$text2color.";
	}
		");
	
		// add pro styles from settings by calling the pro method
		if (class_exists('plgSystemMediabox_ck_pro') && method_exists('plgSystemMediabox_ck_pro', 'createProCss')) {
			plgSystemMediabox_ck_pro::createProCss();
		}

		// set detection for mobiles
		if (!class_exists('Mediaboxck_Mobile_Detect')) {
			require_once dirname(__FILE__) . '/mediaboxck_mobile_detect.php';
		}
		$detect = new Mediaboxck_Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

		$debug = false;
		if ($debug === true) {
			$document->addScript(\Joomla\CMS\Uri\Uri::base(true)."/plugins/system/mediabox_ck/assets/mediaboxck.js?ver=2.7.1");
		} else {
		$document->addScript(\Joomla\CMS\Uri\Uri::base(true)."/plugins/system/mediabox_ck/assets/mediaboxck.min.js?ver=2.7.1");
		}

		$document->addScriptDeclaration("
						Mediabox.scanPage = function() {
							var links = jQuery('a').filter(function(i) {
								if ( jQuery(this).attr('".($attribtype == 'rel' ? 'rel' : 'class')."') 
										&& jQuery(this).data('mediaboxck_done') != '1') {
									var patt = new RegExp(/^" . $attribname . "/i);
									return patt.test(jQuery(this).attr('".($attribtype == 'rel' ? 'rel' : 'class')."'));
								}
							});
							if (! links.length) return false;

							new Mediaboxck(links, {
								overlayOpacity : 	".$overlayopacity.",
								resizeOpening : 	".$resizeopening.",
								resizeDuration : 	".$resizeduration.",
								initialWidth : 		".$initialwidth.",
								initialHeight : 	".$initialheight.",
								fullWidth : 		'".$fullwidth."',
								defaultWidth : 		'".$defaultwidth."',
								defaultHeight : 	'".$defaultheight."',
								showCaption : 		".$showcaption.",
								showCounter : 		".$showcounter.",
								loop : 				".$this->params->get('loop', 'false').",
								isMobileEnable: 	".$this->params->get('mobile_enable', '1').",
								// mobileDetection: 	'".$this->params->get('mobile_detectiontype', 'resolution')."',
								isMobile: 			". ( $mobileForce ? 'true' : ($deviceType != 'computer' ? 'true' : 'false') ) .",
								mobileResolution: 	'".$this->params->get('mobile_resolution', '640')."',
								attribType :		'".($attribtype == 'rel' ? 'rel' : 'class')."',
								showToolbar :		'".$this->params->get('showtoolbar', '0')."',
								diapoTime :			'".$this->params->get('diapotime', '3000')."',
								diapoAutoplay :		'".$this->params->get('diapoAutoplay', 'false')."',
								toolbarSize :		'".$this->params->get('toolbarsize', 'normal')."',
								medialoop :		false,
								showZoom :		".$this->params->get('showZoom', '0').",
								share :		".$this->params->get('showshare', '0').",
								theme :		'".$this->params->get('theme', 'default')."',
								counterText: '" . \Joomla\CMS\Language\Text::_('MEDIABOXCK_COUNTER_TEXT') . "',
							}, null, function(curlink, el) {
								var rel0 = curlink.".$attribtype.".replace(/[[]|]/gi,\" \");
								var relsize = rel0.split(\" \");
								return (curlink == el) || ((curlink.".$attribtype.".length > ".strlen($attribname).") && el.".$attribtype.".match(relsize[1]));
							});
						};
					jQuery(document).ready(function(){
						Mediabox.scanPage();
					});
");
	}

	/* Pro feature */
	public function onAfterRender() {
		$app = \Joomla\CMS\Factory::getApplication();
		$document = \Joomla\CMS\Factory::getDocument();
		$doctype = $document->getType();
		$input = new \Joomla\CMS\Input\Input();

		// stop if we are in admin
		if ($app->isClient('administrator') || $doctype !== 'html') {
			return;
		}
		
		if ($input->get('layout') == 'edit' || $input->get('task') == 'edit' || $input->get('func') == 'edit') {
			return;
		}

		if (! self::callProFile()) {
			return;
		}

		// call the pro method
		if (class_exists('plgSystemMediabox_ck_pro') && method_exists('plgSystemMediabox_ck_pro', 'replaceTag')) {
			plgSystemMediabox_ck_pro::replaceTag();
		}

		return;
	}
	
	function onAjaxMediabox_ck() {
		$app = \Joomla\CMS\Factory::getApplication();
		$input = $app->input;
		
		$method = $input->get('method');

		if (method_exists($this, $method)) {
			$results = call_user_func(array($this,$method));
		}
		
		return $results;
	}
	
	public function AjaxListFolders($path = '', $filter = '.', $level = 1) {
		$input = new \Joomla\CMS\Input\Input();
		$path = $path ? $path : JPATH_ROOT . '/images';
		$level = $level ? $level :  $input->get('level');
		$fhtml = '';
		$folders = \Joomla\CMS\Filesystem\Folder::folders($path, $filter);

		if (! count($folders)) return;
		if ($level > 1) {
			$labelfor = str_replace('\\', '', str_replace('/', '', str_replace(JPATH_ROOT, '', $path)));
			$fhtml .=  '<input type="checkbox" style="display: none;" name="' . $labelfor . '" id="' . $labelfor . '"/>';
			$fhtml .=  '<label class="cksubfoldertoggler" for="' . $labelfor . '">+</label>';
			$fhtml .=  '<div class="cksubfolder">';
		}

		foreach ($folders as $name)
		{
			$fullname = \Joomla\CMS\Filesystem\Path::clean($path . '/' . $name);
			$relname = str_replace(JPATH_ROOT, '', $fullname);

			$fhtml .= '<div class="ckfolderitem"><span style="display:inline-block;padding-left:' . ($level*20) . 'px"><img src="' . \Joomla\CMS\Uri\Uri::root(true) . '/plugins/editors-xtd/mediaboxckbutton/assets/images/folder.png" width="16" height="16" /></span>';
			// $fhtml .= '<span class="ckfoldername" data-foldername="' . $relname . '" onclick="selectfolderck(this, \'mediaboxck_popup_source_dir\');">' . $name . '</span>';
			$fhtml .= '<span class="ckfoldername" data-foldername="' . $relname . '" onclick="selectfolderck(this)">' . $name . '</span>';
			$fhtml .= '</div>';
			$fhtml .= self::AjaxListFolders($fullname, $filter, $level + 1);
		}
		if ($level > 1) {
			$fhtml .=  '</div>';
		}

		return $fhtml;
	}

	/**
	* Check updates for the component, module, or plugins
	*/
	public function check_update($name = 'maximenuck', $type='component', $folder='system') {
		$input = new \Joomla\CMS\Input\Input();

		// init values
		$name = $input->get('name','','string') ? $input->get('name','','string') : $name;
		$type = $input->get('type','','string') ? $input->get('type','','string') : $type;
		$folder = $input->get('folder','','string') ? $input->get('folder','','string') : $folder;

		switch ($type) {
			case 'module' :
				$file_url = JPATH_SITE .'/modules/mod_'.$name.'/mod_'.$name.'.xml';
				$http_url = 'http://update.joomlack.fr/mod_'.$name.'_update.xml'; 
				$prefix = 'mod_';
				break;
			case 'plugin' :
				$file_url = JPATH_SITE .'/plugins/'.$folder.'/'.$name.'/'.$name.'.xml';
				$http_url = 'http://update.joomlack.fr/plg_'.$name.'_update.xml'; 
				// $prefix = 'plg_';
				$prefix = '';
				break;
			case 'component' :
			default :
				$file_url = JPATH_SITE .'/administrator/components/com_'.$name.'/'.$name.'.xml';
				$http_url = 'http://update.joomlack.fr/com_'.$name.'_update.xml';
				$prefix = 'com_';
				break;
		}

		// $xml_latest = false;
		$installed_version = false;

		// get the version installed
		if (! $xml_installed = \Joomla\CMS\Factory::getXML($file_url)) {
			die;
		} else {
			$installed_version = (string)$xml_installed->version;
		}

		// get the latest available version
		// error_reporting(0); // needed because the udpater triggers some warnings in joomla 2.5
		jimport('joomla.updater.updater');
		$updater = \Joomla\CMS\Updater\Updater::getInstance();
		$updater->findUpdates(0, 600);

		$db = \Joomla\CMS\Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__updates')->where('element = \'' . $prefix . $name . '\'');
		$db->setQuery($query);

		if( $row = $db->loadObject() ) {
			$latest_version = $row->version;
		} else {
			die;
		}

		// return a message if there is an update
		if (VERSION_COMPARE($latest_version, $installed_version) > 0) {
			echo '<a target="_blank" href="'.$row->infourl.'"><span style="background-color: #d9534f;
    border-radius: 10px;
    color: #fff;
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    min-width: 10px;
    padding: 3px 7px;
    text-align: center;
    vertical-align: baseline;
	text-shadow: none;
    white-space: nowrap;">Update found : ' . $latest_version . '. Click here to go on http://www.joomlack.fr to download the latest version.</span></a>';
		}

		die;
	}
	
	/**
	 * Create the css properties
	 * @param \Joomla\Registry\Registry $params
	 * @param string $prefix the xml field prefix
	 *
	 * @return Array
	 */
	static function createCss($ID, $params, $prefix = 'image', $important = false, $itemid = '') {
		$css = Array();
		$important = ($important == true ) ? ' !important' : '';
		$csspaddingtop = ($params->get($prefix . 'paddingtop') != '') ? 'padding-top: ' . self::testUnit($params->get($prefix . 'paddingtop', '0')) . $important . ';' : '';
		$csspaddingright = ($params->get($prefix . 'paddingright') != '') ? 'padding-right: ' . self::testUnit($params->get($prefix . 'paddingright', '0')) . $important . ';' : '';
		$csspaddingbottom = ($params->get($prefix . 'paddingbottom') != '') ? 'padding-bottom: ' . self::testUnit($params->get($prefix . 'paddingbottom', '0')) . $important . ';' : '';
		$csspaddingleft = ($params->get($prefix . 'paddingleft') != '') ? 'padding-left: ' . self::testUnit($params->get($prefix . 'paddingleft', '0')) . $important . ';' : '';
		$css['padding'] = $csspaddingtop . $csspaddingright . $csspaddingbottom . $csspaddingleft;
		$cssmargintop = ($params->get($prefix . 'margintop') != '') ? 'margin-top: ' . self::testUnit($params->get($prefix . 'margintop', '0')) . $important . ';' : '';
		$cssmarginright = ($params->get($prefix . 'marginright') != '') ? 'margin-right: ' . self::testUnit($params->get($prefix . 'marginright', '0')) . $important . ';' : '';
		$cssmarginbottom = ($params->get($prefix . 'marginbottom') != '') ? 'margin-bottom: ' . self::testUnit($params->get($prefix . 'marginbottom', '0')) . $important . ';' : '';
		$cssmarginleft = ($params->get($prefix . 'marginleft') != '') ? 'margin-left: ' . self::testUnit($params->get($prefix . 'marginleft', '0')) . $important . ';' : '';
		$css['margin'] = $cssmargintop . $cssmarginright . $cssmarginbottom . $cssmarginleft;
		$bgcolor1 = ($params->get($prefix . 'bgcolor1') && $params->get($prefix . 'bgopacity') !== null && $params->get($prefix . 'bgopacity') !== '') ? self::hex2RGB($params->get($prefix . 'bgcolor1'), $params->get($prefix . 'bgopacity')) : $params->get($prefix . 'bgcolor1');
		$css['background'] = ($params->get($prefix . 'bgcolor1')) ? 'background: ' . $bgcolor1 . $important . ';' : '';
		$css['background'] .= ($params->get($prefix . 'bgcolor1')) ? 'background-color: ' . $bgcolor1 . $important . ';' : '';
		$css['background'] .= ( $params->get($prefix . 'bgimage')) ? 'background-image: url("' . \Joomla\CMS\Uri\Uri::ROOT() . $params->get($prefix . 'bgimage') . '")' . $important . ';' : '';
		$css['background'] .= ( $params->get($prefix . 'bgimage')) ? 'background-repeat: ' . $params->get($prefix . 'bgimagerepeat') . $important . ';' : '';
		$css['background'] .= ( $params->get($prefix . 'bgimage')) ? 'background-position: ' . ($params->get($prefix . 'bgpositionx')) . ' ' . ($params->get($prefix . 'bgpositiony')) . $important . ';' : '';

		$bgcolor2 = ($params->get($prefix . 'bgcolor2') && $params->get($prefix . 'bgopacity') !== '') ? self::hex2RGB($params->get($prefix . 'bgcolor2'), $params->get($prefix . 'bgopacity')) : $params->get($prefix . 'bgcolor2');
		$css['gradient'] = ($css['background'] AND $params->get($prefix . 'bgcolor2')) ?
				"background: -moz-linear-gradient(top,  " . $bgcolor1 . " 0%, " . $bgcolor2 . " 100%)" . $important . ";"
				. "background: -webkit-gradient(linear, left top, left bottom, color-stop(0%," . $bgcolor1 . "), color-stop(100%," . $bgcolor2 . "))" . $important . "; "
				. "background: -webkit-linear-gradient(top,  " . $bgcolor1 . " 0%," . $bgcolor2 . " 100%)" . $important . ";"
				. "background: -o-linear-gradient(top,  " . $bgcolor1 . " 0%," . $bgcolor2 . " 100%)" . $important . ";"
				. "background: -ms-linear-gradient(top,  " . $bgcolor1 . " 0%," . $bgcolor2 . " 100%)" . $important . ";"
				. "background: linear-gradient(top,  " . $bgcolor1 . " 0%," . $bgcolor2 . " 100%)" . $important . "; " : '';
//                . "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $params->get($prefix . 'bgcolor1', '#f0f0f0') . "', endColorstr='" . $params->get($prefix . 'bgcolor2', '#e3e3e3') . "',GradientType=0 );" : '';
		$css['borderradius'] = ($params->get($prefix . 'roundedcornerstl', '') != '' || $params->get($prefix . 'roundedcornerstr', '') != '' || $params->get($prefix . 'roundedcornersbr', '') != '' || $params->get($prefix . 'roundedcornersbl', '') != '') ?
				'-moz-border-radius: ' . self::testUnit($params->get($prefix . 'roundedcornerstl', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornerstr', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornersbr', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornersbl', '0')) . $important . ';'
				. '-webkit-border-radius: ' . self::testUnit($params->get($prefix . 'roundedcornerstl', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornerstr', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornersbr', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornersbl', '0')) . $important . ';'
				. 'border-radius: ' . self::testUnit($params->get($prefix . 'roundedcornerstl', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornerstr', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornersbr', '0')) . ' ' . self::testUnit($params->get($prefix . 'roundedcornersbl', '0')) . $important . ';' : '';
		$shadowinset = $params->get($prefix . 'shadowinset', 0) ? 'inset ' : '';
		$css['shadow'] = ($params->get($prefix . 'shadowcolor') AND $params->get($prefix . 'shadowblur') != '') ?
				'-moz-box-shadow: ' . $shadowinset . self::testUnit($params->get($prefix . 'shadowoffsetx', '0')) . ' ' . self::testUnit($params->get($prefix . 'shadowoffsety', '0')) . ' ' . self::testUnit($params->get($prefix . 'shadowblur', '')) . ' ' . self::testUnit($params->get($prefix . 'shadowspread', '0')) . ' ' . $params->get($prefix . 'shadowcolor', '') . $important . ';'
				. '-webkit-box-shadow: ' . $shadowinset . self::testUnit($params->get($prefix . 'shadowoffsetx', '0')) . ' ' . self::testUnit($params->get($prefix . 'shadowoffsety', '0')) . ' ' . self::testUnit($params->get($prefix . 'shadowblur', '')) . ' ' . self::testUnit($params->get($prefix . 'shadowspread', '0')) . ' ' . $params->get($prefix . 'shadowcolor', '') . $important . ';'
				. 'box-shadow: ' . $shadowinset . self::testUnit($params->get($prefix . 'shadowoffsetx', '0')) . ' ' . self::testUnit($params->get($prefix . 'shadowoffsety', '0')) . ' ' . self::testUnit($params->get($prefix . 'shadowblur', '')) . ' ' . self::testUnit($params->get($prefix . 'shadowspread', '0')) . ' ' . $params->get($prefix . 'shadowcolor', '') . $important . ';' :
				(($params->get($prefix . 'useshadow') && $params->get($prefix . 'shadowblur') == '0') ? '-moz-box-shadow: none' . $important . ';'
						. '-webkit-box-shadow: none' . $important . ';'
						. 'box-shadow: none' . $important . ';' : '');
		$borderstyle = $params->get($prefix . 'borderstyle', 'solid') ? $params->get($prefix . 'borderstyle', 'solid') : 'solid';
		$css['border'] = (($params->get($prefix . 'bordertopwidth') == '0') ? 'border-top: none' . $important . ';' : (($params->get($prefix . 'bordertopwidth') != '' AND $params->get($prefix . 'bordercolor')) ? 'border-top: ' . $params->get($prefix . 'bordercolor', '') . ' ' . self::testUnit($params->get($prefix . 'bordertopwidth', '')) . ' ' . $borderstyle . ' ' . $important . ';' : '') )
				. (($params->get($prefix . 'borderrightwidth') == '0') ? 'border-right: none' . $important . ';' : (($params->get($prefix . 'borderrightwidth') != '' AND $params->get($prefix . 'bordercolor')) ? 'border-right: ' . $params->get($prefix . 'bordercolor', '') . ' ' . self::testUnit($params->get($prefix . 'borderrightwidth', '')) . ' ' . $borderstyle . ' ' . $important . ';' : '') )
				. (($params->get($prefix . 'borderbottomwidth') == '0') ? 'border-bottom: none' . $important . ';' : (($params->get($prefix . 'borderbottomwidth') != '' AND $params->get($prefix . 'bordercolor')) ? 'border-bottom: ' . $params->get($prefix . 'bordercolor', '') . ' ' . self::testUnit($params->get($prefix . 'borderbottomwidth', '')) . ' ' . $borderstyle . ' ' . $important . ';' : '') )
				. (($params->get($prefix . 'borderleftwidth') == '0') ? 'border-left: none' . $important . ';' : (($params->get($prefix . 'borderleftwidth') != '' AND $params->get($prefix . 'bordercolor')) ? 'border-left: ' . $params->get($prefix . 'bordercolor', '') . ' ' . self::testUnit($params->get($prefix . 'borderleftwidth', '')) . ' ' . $borderstyle . ' ' . $important . ';' : '') );
		$css['fontsize'] = ($params->get($prefix . 'fontsize') != '') ?
				'font-size: ' . self::testUnit($params->get($prefix . 'fontsize')) . $important . ';' : '';
		$css['fontcolor'] = ($params->get($prefix . 'fontcolor') != '') ?
				'color: ' . $params->get($prefix . 'fontcolor') . $important . ';' : '';
		$css['fontweight'] = ($params->get($prefix . 'fontweight')  == 'bold') ?
				'font-weight: ' . $params->get($prefix . 'fontweight') . $important . ';' : '';
		$textshadowoffsetx = ($params->get($prefix . 'textshadowoffsetx', '0') == '') ? '0px' : self::testUnit($params->get($prefix . 'textshadowoffsetx', '0'));
		$textshadowoffsety = ($params->get($prefix . 'textshadowoffsety', '0') == '') ? '0px' : self::testUnit($params->get($prefix . 'textshadowoffsety', '0'));
		$css['textshadow'] = ($params->get($prefix . 'textshadowcolor') AND $params->get($prefix . 'textshadowblur')) ?
				'text-shadow: ' . $textshadowoffsetx . ' ' . $textshadowoffsety . ' ' . self::testUnit($params->get($prefix . 'textshadowblur', '')) . ' ' . $params->get($prefix . 'textshadowcolor', '') . $important . ';' :
				(($params->get($prefix . 'textshadowblur') == '0') ? 'text-shadow: none' . $important . ';' : '');
		$css['text-align'] = $params->get($prefix . 'textalign') ? 'text-align: ' . $params->get($prefix . 'textalign') . $important . ';' : ''; '';
		$css['text-transform'] = ($params->get($prefix . 'texttransform') && $params->get($prefix . 'texttransform') != 'default') ? 'text-transform: ' . $params->get($prefix . 'texttransform') . $important . ';' : ''; '';

		return $css;
	}

	/**
	 * Test if there is already a unit, else add the px
	 *
	 * @param string $value
	 * @return string
	 */
	static function testUnit($value) {
		if ((stristr($value, 'px')) OR (stristr($value, 'em')) OR (stristr($value, '%')) OR (stristr($value, 'auto')) ) {
			return $value;
		}

		if ($value == '') {
			$value = 0;
		}

		return $value . 'px';
	}

	/**
	 * Convert a hexa decimal color code to its RGB equivalent
	 *
	 * @param string $hexStr (hexadecimal color value)
	 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
	 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
	 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
	 */
	static function hex2RGB($hexStr, $opacity) {
		if ($opacity > 1) $opacity = $opacity/100;
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
		$rgbArray = array();
		if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false; //Invalid hex color code
		}
		$rgbacolor = "rgba(" . $rgbArray['red'] . "," . $rgbArray['green'] . "," . $rgbArray['blue'] . "," . $opacity . ")";

		return $rgbacolor;
	}
	
	/*
	 * Method to call the pro file if exists
	 */
	private static function callProFile() {
		if (file_exists(dirname(__FILE__) . '/pro/mediaboxck_pro.php')) {
			include_once (dirname(__FILE__) . '/pro/mediaboxck_pro.php');
			return true;
		} else {
			return false;
		}
	}

	public function onContentPrepare($context, &$item, &$params, $page = 0) {
		if ($context === 'com_finder.indexer') return '';
		if ($this->params->get('autoload', '0') !== '1') return '';

		// Replace anchor-tags
		$REGEX_ANCHOR = '#<a\s.*?>.*?</a>#is';
		$item->text = preg_replace_callback($REGEX_ANCHOR, array($this, "anchorReplacer"), $item->text);

		if ($this->params->get('autoload', '0') === '1') {
		// Replace img-tags
		$REGEX_IMG = '#<img.*?>#is';
		$item->text = preg_replace_callback($REGEX_IMG, array($this, "imageReplacer"), $item->text);
		}

		return '';
	}

	/**
	 * Replace anchor-tag
	 * 
	 * @param array $matches
	 * @return string
	 */
	public function anchorReplacer($matches)
	{   
		$anchorStr = is_array($matches) ? $matches[0] : $matches;
		// transform the image tag into list of attributes
		// $xml = simplexml_load_string($anchorStr);

		// if no image in the link, return the link
		if (strpos($anchorStr, '<img') === false) return $anchorStr;
		if (strpos($anchorStr, 'data-mediaboxck-haslink="1"') !== false) return $anchorStr;

		$html = str_replace('<img ', '<img data-mediaboxck-haslink="1" ', $anchorStr);

		return $html;
	}

	/**
	 * Replace img-tag
	 * 
	 * @param array $matches
	 * @return string
	 */
	public function imageReplacer($matches)
	{
		$imgStr = is_array($matches) ? $matches[0] : $matches;
		// return the image if the lightbox is already set
		if (strpos($imgStr, 'rel="lightbox"') !== false) return $imgStr;
		if (strpos($imgStr, 'data-mediaboxck-haslink="1"') !== false) return $imgStr;

		// fix html issue
		if (substr($imgStr, -2) !== '/>') {
			$imgStr = substr($imgStr, 0, -1) . '/>';
		}

		// transform the image tag into list of attributes
		$xml = @simplexml_load_string($imgStr);
		if ($xml === false) return $imgStr;

		$attribtype = $this->params->get('attribtype', 'className') === 'className' ? 'class' : 'rel';
		$attribname = $this->params->get('attribname', 'lightbox');
		$group = $this->params->get('autoload_group', '0');
		if ($group === '1') {
			$attribname = $attribname. '[mediaboxckautoload]';
		}
		$attrib = $attribtype . '="' . $attribname . '"';
		$src = false;
		$alt = false;
		$autoloadFilter = $this->params->get('autoload_filter', '0');
		$autoloadFilterClass = $this->params->get('autoload_filter_class', '');
		$addLightbox = true;
		$hasClass = false;
		foreach($xml->attributes() as $tag => $value) {
			$value = (string)$value;

			if ($tag === 'data-mediaboxck-haslink' && $value == '1') {
				// return the image if the lightbox is already set
				return $imgStr;
			}

			// only class
			if ($autoloadFilter === '1' && $tag === 'class' && $autoloadFilterClass) {
				if (strpos($value, $autoloadFilterClass) === false) $addLightbox = false;
			}
			// except class
			if ($autoloadFilter === '2' && $tag === 'class' && $autoloadFilterClass) {
				if (strpos($value, $autoloadFilterClass) !== false) return $imgStr;
			}

			if ($tag === 'src') {
				$src = $value;
			}
			if ($tag === 'class') {
				$hasClass = true;
			}
			if ($tag === 'alt') {
				$alt = $value;
			}
		}

		// if the image has no src tag
		if ($src === false) {
			return $imgStr;
		}

		if ($alt !== false && $alt) {
			$alt = ' title="' . $alt . '"';
		}

		// only class for images that has no class
		if ($autoloadFilter === '1' && $hasClass === false && $autoloadFilterClass) {
			return $imgStr;
		}

		$html = '<a ' . $attrib . $alt . ' href="' . $src . '">' . $imgStr . '</a>';

		return $addLightbox === true ? $html : $imgStr;
	}
}
