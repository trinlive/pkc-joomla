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

class JFormFieldCkmediaboxvote extends \Joomla\CMS\Form\FormField {

	protected $type = 'ckmediaboxvote';

	protected function getLabel() {

		$imgpath = \Joomla\CMS\Uri\Uri::root(true) . '/plugins/system/mediabox_ck/elements/images/';

		$styles = 'background:#efefef;';
		$styles .= 'border: none;';
		$styles .= 'border-radius: 3px;';
		$styles .= 'color: #333;';
		$styles .= 'font-weight: normal;';
		$styles .= 'line-height: 24px;';
		$styles .= 'padding: 5px;';
		$styles .= 'margin: 3px 0;';
		$styles .= 'text-align: left;';
		$styles .= 'text-decoration: none;';

		$html = '<div style="' . $styles . '"><img src="' . $imgpath . 'emoticon_smile.png" style="margin: 0 10px 0 0;" /><a href="http://extensions.joomla.org/extensions/extension/multimedia/multimedia-display/mediabox-ck" target="_blank">' . \Joomla\CMS\Language\Text::_('MEDIABOXCK_VOTE_JED') . '</a></div>';

		return $html;
	}

	protected function getInput() {

		return '';
	}
}

