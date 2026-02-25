<?php

/**
 * @copyright	Copyright (C) 2011-2019 Cedric KEIFLIN alias ced1870
 * https://www.joomlack.fr
 * @license		GNU/GPL
 * */
defined('JPATH_PLATFORM') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

// custom class extension for J3 compatibility
if (class_exists('\Joomla\CMS\Form\Field\ListField')) {
	class JFormFieldMediaboxcklistBase extends \Joomla\CMS\Form\Field\ListField {}
} else {
	class JFormFieldMediaboxcklistBase extends JFormFieldList {}	
}

class JFormFieldMediaboxcklist extends JFormFieldMediaboxcklistBase {

	protected $type = 'Mediaboxcklist';

	protected function getInput() {
		// Initialize some field attributes.
		$icon = $this->element['icon'];
		$suffix = $this->element['suffix'];

		$html = $icon ? '<div class="mediaboxck-field-icon" ' . ($suffix ? 'data-has-suffix="1"' : '') . '><img src="' . \Joomla\CMS\Uri\Uri::root(true) . '/plugins/system/mediabox_ck/assets' . '/images/' . $icon . '" style="margin-right:5px;" /></div>' : '<div style="display:inline-block;width:20px;"></div>';

		$html .= parent::getInput();
		if ($suffix)
			$html .= '<span class="mediaboxck-field-suffix">' . $suffix . '</span>';
		return $html;
	}

}
