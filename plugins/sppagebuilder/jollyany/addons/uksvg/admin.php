<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2021 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
/**
 * @package Extra Addons SP Page Builder
 * @author WarpTheme https://warptheme.com
 * @copyright Copyright (c) 2015 - 2018 WarpTheme
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');
use Jollyany\Helper\PageBuilder;
use Joomla\CMS\Language\Text;
if (file_exists(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'jollyany'. DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR .'jollyany' . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR. 'PageBuilder.php')) {
    SpAddonsConfig::addonConfig(
        array(
            'type' => 'content',
            'addon_name' => 'uksvg',
            'title' => Text::_('UK Svg'),
            'desc' => Text::_('Inject inline SVG images into the page markup and style them with CSS.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/uksvg/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    'image' => array(
                        'type' => 'media',
                        'title' => Text::_('SVG File'),
                        'placeholder' => 'http://www.example.com/my-photo.svg',
                        'show_input' => true,
                        'std' => '',
                    ),

                    'alt_text' => array(
                        'type' => 'text',
                        'title' => Text::_('Image Alt'),
                        'std' => 'Alt Text',
                        'depends' => array(
                            array('image', '!=', ''),
                        ),
                    ),
                    'width' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
                        'std' => 40,
                        'depends' => array(
                            array('image', '!=', ''),
                        ),
                    ),

                    'height' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
                        'std' => 40,
                        'depends' => array(
                            array('image', '!=', ''),
                        ),
                    ),

                    'preserve' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Preserve Color'),
                        'desc' => Text::_('SVGs will adapt the current color for their stroke and fill color. To prevent this behavior, you can use this option to add css class to the SVG itself or to elements inside the SVG.'),
                        'std' => 0,
                        'depends' => array(
                            array('image', '!=', ''),
                        ),
                    ),
                    'color' => array(
                        'type' => 'color',
                        'title' => Text::_('Fill Color Svg'),
                        'std' => '',
                        'depends' => array(
                            array('image', '!=', ''),
                            array('preserve', '!=', 0),
                        ),
                    ),
                    'use_link' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Use Link'),
                        'desc' => Text::_('Check this option to insert the link for svg image.'),
                        'std' => 0
                    ),

                    'title_link' => array(
                        'type' => 'media',
                        'format' => 'attachment',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                        'placeholder' => 'http://www.example.com',
                        'std' => '',
                        'hide_preview' => true,
                        'depends' => array('use_link' => 1)
                    ),

                    'link_new_tab' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
                        'values' => array(
                            0 => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                            1 => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                        ),
                        'std' => 0,
                        'depends' => array('use_link' => 1)
                    ),

                    'target' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_DESC'),
                        'values' => array(
                            '' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                            '_blank' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                        ),
                        'depends' => array(
                            array('image', '!=', ''),
                            array('link', '!=', ''),
                            array('open_lightbox', '!=', 1),
                        ),
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                ),
                'options' => PageBuilder::general_options()
            ),
        )
    );
}