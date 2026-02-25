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
defined('_JEXEC') or die('restricted aceess');
use Jollyany\Helper\PageBuilder;
use Joomla\CMS\Language\Text;
if (file_exists(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'jollyany'. DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR .'jollyany' . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR. 'PageBuilder.php')) {
    SpAddonsConfig::addonConfig(
        array(
            'type' => 'repeatable',
            'addon_name' => 'ukicon',
            'title' => Text::_('UK Icons'),
            'desc' => Text::_('Add inline icons for creating social profile link or any kind of group icons.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukicon/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => '',
                    ),

                    // Repeatable Item
                    'ukicon_items' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('Title'),
                            ),
                            'icon_type' => array(
                                'type' => 'select',
                                'title' => Text::_('Select Media Type'),
                                'values' => array(
                                    'uikit' => 'UIKit Icon',
                                    'fontawesome' => 'Font Awesome',
                                ),
                                'std' => 'uikit',
                            ),
                            'fontawesome_icon' => array(
                                'type' => 'icon',
                                'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_ICON_NAME'),
                                'std' => 'fa-cogs',
                                'depends' => array(
                                    array('icon_type', '=', 'fontawesome'),
                                ),
                            ),
                            'uikit_icon' => array(
                                'type' => 'select',
                                'title' => Text::_('Select an UI Kit Icon'),
                                'values' => PageBuilder::getUKIcon(),
                                'std' => '',
                                'depends' => array(
                                    array('icon_type', '=', 'uikit'),
                                ),
                            ),
                            'link' => array(
                                'type' => 'media',
                                'format' => 'attachment',
                                'title' => Text::_('Link'),
                                'desc' => Text::_('Enter or pick a link for icon.'),
                                'placeholder' => 'http://',
                                'hide_preview' => true,
                            ),
                        ),
                    ),
                    'separator_misc_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Misc Options'),
                    ),
                    'icon_size' => array(
                        'type' => 'slider',
                        'title' => Text::_('Icon Size'),
                        'min' => 0,
                        'max' => 400,
                        'desc' => Text::_('Enter a size for the popover in pixel'),
                        'placeholder' => '28',
                        'std' => array('md' => 28),
                        'responsive' => true,
                    ),
                    'icon_animation' => array(
                        'type' => 'select',
                        'title' => Text::_('Animation'),
                        'desc' => Text::_('Apply the animations effect to the icon on hover/click'),
                        'values' => array(
                            '' => Text::_('None'),
                            'fade' => Text::_('Fade'),
                            'scale-up' => Text::_('Scale Up'),
                            'scale-down' => Text::_('Scale Down'),
                            'slide-top-small' => Text::_('Slide Top Small'),
                            'slide-bottom-small' => Text::_('Slide Bottom Small'),
                            'slide-left-small' => Text::_('Slide Left Small'),
                            'slide-right-small' => Text::_('Slide Right Small'),
                            'slide-top-medium' => Text::_('Slide Top Medium'),
                            'slide-bottom-medium' => Text::_('Slide Bottom Medium'),
                            'slide-left-medium' => Text::_('Slide Left Medium'),
                            'slide-right-medium' => Text::_('Slide Right Medium'),
                            'slide-top' => Text::_('Slide Top 100%'),
                            'slide-bottom' => Text::_('Slide Bottom 100%'),
                            'slide-left' => Text::_('Slide Left 100%'),
                            'slide-right' => Text::_('Slide Right 100%'),
                        ),
                        'std' => '',
                    ),
                    'icon_gutter' => array(
                        'type' => 'select',
                        'title' => Text::_('Icon Gutter'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('Collapse'),
                        ),
                        'std' => ''
                    ),

                    'icon_divider' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Icon Divider'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),
                    'icon_button' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Icon Button'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),
                    'icon_background_size' => array(
                        'type' => 'slider',
                        'title' => Text::_('Icon Background Size'),
                        'min' => 0,
                        'max' => 400,
                        'desc' => Text::_('Enter a size for the popover in pixel'),
                        'placeholder' => '36',
                        'std' => array('md' => 36),
                        'responsive' => true,
                        'depends' => array(
                            array('icon_button', '=', 1),
                        )
                    ),
                    'icon_status' => array(
                        'type' => 'buttons',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
                        'std' => 'normal',
                        'values' => array(
                            array(
                                'label' => 'Normal',
                                'value' => 'normal'
                            ),
                            array(
                                'label' => 'Hover',
                                'value' => 'hover'
                            ),
                        ),
                        'tabs' => true,
                    ),
                    'background_color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_DESC'),
                        'std' => '',
                        'depends' => array(
                            array('icon_status', '=', 'normal'),
                        )
                    ),
                    'color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
                        'std' => '#666666',
                        'depends' => array(
                            array('icon_status', '=', 'normal'),
                        ),
                    ),
                    'background_color_hover' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER_DESC'),
                        'std' => '',
                        'depends' => array(
                            array('icon_status', '=', 'hover'),
                        )
                    ),
                    'color_hover' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER_DESC'),
                        'std' => '#333333',
                        'depends' => array(
                            array('icon_status', '=', 'hover'),
                        ),
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => '',
                    ),
                ),
                'options' => PageBuilder::general_options()
            ),
        )
    );
}