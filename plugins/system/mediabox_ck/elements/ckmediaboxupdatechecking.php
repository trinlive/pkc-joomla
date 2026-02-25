<?php

/**
 * @copyright	Copyright (C) 2015 Cedric KEIFLIN alias ced1870
 * https://www.joomlack.fr
 * @license		GNU/GPL
 * */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.form');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
// error_reporting(0);

class JFormFieldCkmediaboxupdatechecking extends \Joomla\CMS\Form\FormField {

	protected $type = 'ckmediaboxupdatechecking';

	protected function getLabel() {
		if (file_exists(JPATH_ROOT . '/plugins/system/mediabox_ck/pro/mediaboxck_pro.php')) {
			$ispro = true;
		} else {
			$ispro = false;
		}

		// get the version installed
		$installed_version = false;
		$file_url = JPATH_SITE .'/plugins/system/mediabox_ck/mediabox_ck.xml';
		if (! $xml_installed = simplexml_load_file($file_url)) {
			die;
		} else {
			$installed_version = (string)$xml_installed->version;
		}

		$imgpath = \Joomla\CMS\Uri\Uri::root(true) . '/plugins/system/mediabox_ck/elements/images/';

		$html = '';

		$version_text = $ispro ? \Joomla\CMS\Language\Text::_('MEDIABOXCK_VERSION_PRO') : '<a href="https://www.joomlack.fr/en/joomla-extensions/mediabox-ck" target="_blank">' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_VERSION_FREE') . '</a>';
		$icon = $ispro ? 'accept.png' : 'information.png';

		$html .= '<div style="background:#efefef;border: none;border-radius: 3px;color: #333;font-weight: normal;line-height: 24px;padding: 5px;margin: 3px 0;text-align: left;text-decoration: none;"><img style="margin: 0 10px 5px 5px;" src="' . $imgpath . $icon . '">' . $version_text . '</div>';
		$html .= '<div>' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_YOU_HAVE_VERSION') . ' : <span class="label">' . $installed_version . '</span></div>';
		$html .= '<hr />';
		// $html .= '<div id="updatealert"></div>';
		// $html .= '<div class="updatechecking"></div>';

		// $html .= $js_checking;
		return $html;
		// return '';
	}

	protected function getInput() {

		return '';
	}
}

