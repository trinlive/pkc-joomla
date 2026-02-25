<?php
/**
 * @copyright	Copyright (C) 2017 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * @license		GNU/GPL
 * */

defined('JPATH_PLATFORM') or die;

\Joomla\CMS\Form\FormHelper::loadFieldClass('hidden');

// custom class extension for J3 compatibility
if (class_exists('\Joomla\CMS\Form\Field\HiddenField')) {
	class JFormFieldMediaboxckinterfaceBase extends \Joomla\CMS\Form\Field\HiddenField {}
} else {
	class JFormFieldMediaboxckinterfaceBase extends JFormFieldHidden {}	
}

class JFormFieldMediaboxckinterface extends JFormFieldMediaboxckinterfaceBase
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 *
	 */
	protected $type = 'mediaboxckinterface';

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
		// loads the language files from the frontend
		$lang	= \Joomla\CMS\Factory::getLanguage();
//		$lang->load('com_mediaboxck', JPATH_SITE . '/components/com_mediaboxck', $lang->getTag(), false);
//		$lang->load('com_mediaboxck', JPATH_SITE, $lang->getTag(), false);

		if (version_compare(JVERSION, '4') >= 0) {
		$css = '.mediaboxck-field-suffix {
	display: inline-block;
	line-height: 25px;
	transform: translate(0, -50%);
	position: absolute;
	top: 20px;
	height: 25px;
	right: 20px;
}

.mediaboxck-field-icon {
	display: inline-block;
	vertical-align: top;
	margin-top: 10px;
	width: 20px;
}

.mediaboxck-field-icon + input,
.mediaboxck-field-icon + fieldset,
.mediaboxck-field-icon + select {
	display: inline-block;
	width: calc(100% - 30px);
}

.ckbutton-group input[type="text"] {
	min-height: 28px;
	box-sizing: border-box;
	font-size: 13px;
}';
		} else {
			$css = '.mediaboxck-field-icon {
	display: inline-block;
	vertical-align: top;
	margin-top: 4px;
	width: 20px;
}';
		}

		$doc = \Joomla\CMS\Factory::getDocument();
		$doc->addStyleDeclaration($css);

		return '';
	}
}
