<?php

defined('_JEXEC') or die('Restricted access');
/*
	preflight which is executed before install and update
	install
	update
	uninstall
	postflight which is executed after install and update
	*/

class plgSystemMediabox_ckInstallerScript {

	function install($parent) {
		
	}
	
	function update($parent) {
		
	}
	
	function uninstall($parent) {
		
	}

	function preflight($type, $parent) {
		// check if a pro version already installed
		$xmlPath = JPATH_ROOT . '/plugins/system/mediabox_ck/mediabox_ck.xml';
		
		// if no file already exists
		if (! file_exists($xmlPath)) return true;

		$xmlData = $this->getXmlData($xmlPath);
		$isProInstalled = ((int)$xmlData->ckpro);
		
		if ($isProInstalled) {
			throw new RuntimeException('Mediabox CK Light cannot be installed over Mediabox CK Pro. Please install Mediabox CK Pro. To downgrade, please first uninstall Mediabox CK Pro.');
			// return false;
		}
		return true;
	}

	public function getXmlData($file) {
		if ( ! is_file($file))
		{
			return '';
		}

		$xml = simplexml_load_file($file);

		if ( ! $xml || ! isset($xml['version']))
		{
			return '';
		}

		return $xml;
	}

	// run on install and update
	function postflight($type, $parent) {
		// install modules and plugins
		$db = \Joomla\CMS\Factory::getDbo();
		$status = array();

		// auto enable the button plugin
		$db->setQuery("UPDATE #__extensions SET enabled = '1' WHERE `element` = 'mediabox_ck' AND `type` = 'plugin'");
		$result = $db->execute();
		$status[] = array('name'=>'Mediabox CK system - Plugin','type'=>'plugin', 'result'=>$result);

		foreach ($status as $statu) {
			if ($statu['result'] == true) {
				$alert = 'success';
				$icon = 'icon-ok';
				$text = 'Successful';
			} else {
				$alert = 'warning';
				$icon = 'icon-cancel';
				$text = 'Failed';
			}
			echo '<div class="alert alert-' . $alert . '"><i class="icon ' . $icon . '"></i>Installation and activation of the <b>' . $statu['type'] . ' ' . $statu['name'] . '</b> : ' . $text . '</div>';
		}

		return true;
	}
}
