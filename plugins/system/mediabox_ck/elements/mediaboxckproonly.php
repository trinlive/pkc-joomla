<?php
/**
 * @copyright	Copyright (C) 2017 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * */

defined('JPATH_PLATFORM') or die;

class JFormFieldMediaboxckproonly extends \Joomla\CMS\Form\FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 */
	protected $type = 'mediaboxckproonly';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 */
	protected function getLabel()
	{
		return '';
	}

	/**
	 * Method to get the field label markup.
	 *
	 * @return  string  The field label markup.
	 *
	 */
	protected function getInput()
	{
		if (file_exists(JPATH_SITE . '/plugins/system/mediabox_ck/pro/mediaboxck_pro.php')) return '';
		$html = '<div class="ckinfo">'
				. '<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"></path></svg>'
				. '<a href="https://www.joomlack.fr/en/joomla-extensions/mediabox-ck" target="_blank">' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_ONLY_PRO') . '</a></div>';

		return $html;
	}

	/*
	 * Get a variable from the manifest file
	 * 
	 * @return the current version
	 */
	public static function getCurrentVersion($file_url) {
		// get the version installed
		$installed_version = 'UNKOWN';
		if ($xml_installed = simplexml_load_file($file_url)) {
			$installed_version = (string)$xml_installed->version;
		}

		return $installed_version;
	}
}
