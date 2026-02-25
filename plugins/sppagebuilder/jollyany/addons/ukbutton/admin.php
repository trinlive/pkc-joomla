<?php

/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2022 Jollyany
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
            'type' => 'general',
            'addon_name' => 'ukbutton',
            'title' => Text::_('UK Button'),
            'desc' => Text::_('Button style based UI Kit.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukbutton/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => '',
                    ),
                    'ui_list_buttons' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                                'std' => 'Learn More',
                            ),
                            'link' => array(
                                'type' => 'media',
                                'format' => 'attachment',
                                'title' => Text::_('Link'),
                                'desc' => Text::_('Enter or pick a link, an image or a video file.'),
                                'placeholder' => 'http://',
                                'hide_preview' => true,
                            ),
                            'link_title' => array(
                                'type' => 'text',
                                'title' => Text::_('Link Title'),
                                'desc' => Text::_('Enter an optional text for the title attribute of the link, which will appear on hover.'),
                            ),
                            'target' => array(
                                'type' => 'select',
                                'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                                'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
                                'values' => array(
                                    '' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                                    '_blank' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                                ),
                                'depends' => array(array('link', '!=', '')),
                            ),
                            'icon_type' => array(
                                'type' => 'select',
                                'title' => Text::_('Icon Type'),
                                'desc' => Text::_('Select icon type from the list'),
                                'values' => array(
                                    '' => Text::_('FontAwesome'),
                                    'uikit' => Text::_('Uikit'),
                                    'custom' => Text::_('Custom'),
                                ),
                                'std' => '',
                            ),
                            'btn_icon' => array(
                                'type' => 'icon',
                                'title' => Text::_('Icon'),
                                'depends' => array(
                                    array('icon_type', '!=', 'uikit'),
                                    array('icon_type', '!=', 'custom')
                                ),
                            ),
                            'custom_icon' => array(
                                'type' => 'text',
                                'title' => Text::_('Icon Class Name'),
                                'placeholder' => 'flaticon-check',
                                'depends' => array(
                                    array('icon_type', '=', 'custom'),
                                ),
                            ),
                            'uikit_icon' => array( // New Uikit Icon
                                'type' => 'select',
                                'title' => Text::_('Uikit Icon'),
                                'desc' => Text::_('Select an SVG icon from the list. Learn more <a href="https://getuikit.com/docs/icon#library" target="_blank">https://getuikit.com/docs/icon</a>'),
                                'values' => PageBuilder::getUKIcon(),
                                'std' => 'check',
                                'depends' => array(
                                    array('icon_type', '=', 'uikit'),
                                ),
                            ),
                            'icon_position' => array(
                                'type' => 'select',
                                'title' => Text::_('Icon Alignment'),
                                'desc' => Text::_('Choose the icon position.'),
                                'values' => array(
                                    '' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                                    'right' => Text::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                                ),
                                'std' => '',
                                'depends' => array(array('btn_icon', '!=', '')),
                            ),
                            'button_style' => array(
                                'type' => 'select',
                                'title' => Text::_('Style'),
                                'desc' => Text::_('Set the button style.'),
                                'values' => array(
                                    '' => Text::_('Default'),
                                    'primary' => Text::_('Primary'),
                                    'secondary' => Text::_('Secondary'),
                                    'danger' => Text::_('Danger'),
                                    'text' => Text::_('Text'),
                                    'link' => Text::_('Link'),
                                    'link-muted' => Text::_('Link Muted'),
                                    'link-text' => Text::_('Link Text'),
                                    'custom' => Text::_('Custom'),
                                ),
                                'std' => '',
                            ),
                            'button_shape' => array(
                                'type' => 'select',
                                'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
                                'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
                                'values' => array(
                                    'rounded' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
                                    'square' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
                                    'round' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
                                ),
                                'depends' => array(
                                    array('button_style', '!=', 'link'),
                                    array('button_style', '!=', 'link-muted'),
                                    array('button_style', '!=', 'link-text'),
                                    array('button_style', '!=', 'text'),
                                )
                            ),
                            'separator_button_custom_options' => array(
                                'type' => 'separator',
                                'title' => Text::_('Custom Button Style'),
                                'depends' => array(
                                    array('button_style', '=', 'custom'),
                                )
                            ),
                            'button_background' => array(
                                'type' => 'color',
                                'title' => Text::_('Background Color'),
                                'std' => '#1e87f0',
                                'depends' => array(
                                    array('button_style', '=', 'custom'),
                                )
                            ),
                            'button_color' => array(
                                'type' => 'color',
                                'title' => Text::_('Button Color'),
                                'depends' => array(
                                    array('button_style', '=', 'custom'),
                                )
                            ),
                            'button_background_hover' => array(
                                'type' => 'color',
                                'title' => Text::_('Hover Background Color'),
                                'std' => '#1e87f0',
                                'depends' => array(
                                    array('button_style', '=', 'custom'),
                                )
                            ),
                            'button_hover_color' => array(
                                'type' => 'color',
                                'title' => Text::_('Hover Button Color'),
                                'depends' => array(
                                    array('button_style', '=', 'custom'),
                                )
                            ),
                        ),
                    ),

                    'class' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => '',
                    ),
                ),
                'misc-settings' => array(
                    'font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-title { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'font_weight' => array(
                        'type' => 'select',
                        'title' => Text::_('Font weight'),
                        'desc' => Text::_('Add one of the following classes to modify the font weight of your text.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'light' => Text::_('Light'),
                            'normal' => Text::_('Normal'),
                            'bold' => Text::_('Bold'),
                            'lighter' => Text::_('Lighter'),
                            'bolder' => Text::_('Bolder'),
                        ),
                    ),
                    'button_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Button Size'),
                        'desc' => Text::_('Set the size for multiple buttons.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'large' => Text::_('Large'),
                        ),
                    ),
                    'grid_width' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Full width button'),
                        'std' => 0,
                    ),
                    'grid_column_gap' => array(
                        'type' => 'select',
                        'title' => Text::_('Column Gap'),
                        'desc' => Text::_('Set the size of the column gap between multiple buttons.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            '' => Text::_('Default'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => 'small',
                    ),
                    'grid_row_gap' => array(
                        'type' => 'select',
                        'title' => Text::_('Row Gap'),
                        'desc' => Text::_('Set the size of the row gap between multiple buttons.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            '' => Text::_('Default'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => 'small',
                    ),
                ),
                'options' => PageBuilder::general_options(),
            ),
        )
    );
}