<?php
/**
 * @copyright	Copyright (C) 2017 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * */

defined('JPATH_PLATFORM') or die;

class JFormFieldMediaboxckinfo extends \Joomla\CMS\Form\FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 */
	protected $type = 'mediaboxckinfo';

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
		$doc = \Joomla\CMS\Factory::getDocument();
		$styles = '.ckinfo {position:relative;background:#efefef;border: none;border-radius: px;color: #333;font-weight: normal;line-height: 24px;padding: 5px 5px 5px 35px;margin: 3px 0;text-align: left;text-decoration: none;}
.ckinfo svg {
	font-size: 15px;
	padding: 0;
	position: absolute;
	top: 8px;
	bottom: 0;
	left: 5px;
	line-height: 25px;
	width: 20px;
	height: 16px;
	text-align: center;
}
.ckinfo::before {
	position: absolute;
	top: 0;
	left: 0;
	height: 100%;
	width: 30px;
	content: "";
	background: rgba(0, 0, 0, 0.1);
	display: block;
}
.ckinfo img {margin: 0 10px 0 0;}
.control-label:empty, .controls:empty {display: none;}
.control-label:empty + .controls {margin: 0;}
';
		$doc->addStyleDeclaration($styles);

		// get the extension version
		$current_version = $this->getCurrentVersion(JPATH_SITE .'/plugins/system/mediabox_ck/mediabox_ck.xml');
		$html = '';

		$html .= '<div class="ckinfo"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="thumbs-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-thumbs-up fa-w-16 fa-3x"><path fill="currentColor" d="M104 224H24c-13.255 0-24 10.745-24 24v240c0 13.255 10.745 24 24 24h80c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24zM64 472c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zM384 81.452c0 42.416-25.97 66.208-33.277 94.548h101.723c33.397 0 59.397 27.746 59.553 58.098.084 17.938-7.546 37.249-19.439 49.197l-.11.11c9.836 23.337 8.237 56.037-9.308 79.469 8.681 25.895-.069 57.704-16.382 74.757 4.298 17.598 2.244 32.575-6.148 44.632C440.202 511.587 389.616 512 346.839 512l-2.845-.001c-48.287-.017-87.806-17.598-119.56-31.725-15.957-7.099-36.821-15.887-52.651-16.178-6.54-.12-11.783-5.457-11.783-11.998v-213.77c0-3.2 1.282-6.271 3.558-8.521 39.614-39.144 56.648-80.587 89.117-113.111 14.804-14.832 20.188-37.236 25.393-58.902C282.515 39.293 291.817 0 312 0c24 0 72 8 72 81.452z" class=""></path></svg>'
				.'<a href="https://extensions.joomla.org/extension/mediabox-ck/" target="_blank">' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_VOTE_JED') . '</a></div>';
		$html .= '<div class="ckinfo">'
				.'<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"></path></svg>'
				. '<b>MEDIABOX CK</b> - ' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_CURRENT_VERSION') . '</b> : <span class="label">' . $current_version . '</span></div>';
		$html .= '<div class="ckinfo">'
				.'<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-file-alt fa-w-12 fa-3x"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z" class=""></path></svg>'
				.'<a href="https://www.joomlack.fr/en/documentation/mediabox-ck" target="_blank">' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_DOCUMENTATION') . '</a></div>';

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
