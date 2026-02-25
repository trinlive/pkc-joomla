<?php

/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2021 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');
use Jollyany\Helper\PageBuilder;
use Joomla\CMS\Language\Text;
if (file_exists(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'jollyany'. DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR .'jollyany' . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR. 'PageBuilder.php')) {
    SpAddonsConfig::addonConfig(
        array(
            'type' => 'repeatable',
            'addon_name' => 'ukslider',
            'title' => Text::_('UK Slider'),
            'desc' => Text::_('Create a responsive carousel slider using UIKit.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukslider/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    // Repeatable Items
                    'ukslider_items' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'image' => array(
                                'type' => 'media',
                                'title' => Text::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT'),
                                'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT_DESC'),
                                'show_input' => true,
                                'std' => array(
                                    'src' => 'https://sppagebuilder.com/addons/image/image1.jpg',
                                    'height' => '',
                                    'width' => '',
                                )
                            ),
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('Title'),
                            ),
                            'content' => array(
                                'type' => 'textarea',
                                'title' => Text::_('Content'),
                            ),
                            'link' => array(
                                'type' => 'media',
                                'format' => 'attachment',
                                'title' => Text::_('Link'),
                                'std' => '',
                                'hide_preview' => true,
                            ),
                            'link_text' => array(
                                'type' => 'text',
                                'title' => Text::_('Link Text'),
                            ),
                            'uikit_icon' => array( // New Uikit Icon
                                'type' => 'select',
                                'title' => Text::_('Uikit Icon'),
                                'desc' => Text::_('Select an SVG icon from the list. Learn more <a href="https://getuikit.com/docs/icon#library" target="_blank">https://getuikit.com/docs/icon</a>'),
                                'values' => PageBuilder::getUKIcon(),
                            ),
                        ),
                    ),

                    'class' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                ),

                'misc' => array(
                    'separator_slider_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Slider'),
                    ),
                    'column_width_xl' => array(
                        'title' => Text::_('Column Large Desktop'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1 Column'),
                            '1-2' => Text::_('2 Columns'),
                            '1-3' => Text::_('3 Columns'),
                            '1-4' => Text::_('4 Columns'),
                            '1-5' => Text::_('5 Columns'),
                            '1-6' => Text::_('6 Columns'),
                        ),
                        'std' => '1-3',
                    ),
                    'column_width_l' => array(
                        'title' => Text::_('Column Desktop'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1 Column'),
                            '1-2' => Text::_('2 Columns'),
                            '1-3' => Text::_('3 Columns'),
                            '1-4' => Text::_('4 Columns'),
                            '1-5' => Text::_('5 Columns'),
                            '1-6' => Text::_('6 Columns'),
                        ),
                        'std' => '1-3',
                    ),
                    'column_width_m' => array(
                        'title' => Text::_('Column Laptop'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1 Column'),
                            '1-2' => Text::_('2 Columns'),
                            '1-3' => Text::_('3 Columns'),
                            '1-4' => Text::_('4 Columns'),
                            '1-5' => Text::_('5 Columns'),
                            '1-6' => Text::_('6 Columns'),
                        ),
                        'std' => '1-3',
                    ),
                    'column_width_s' => array(
                        'title' => Text::_('Column Tablet'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1 Column'),
                            '1-2' => Text::_('2 Columns'),
                            '1-3' => Text::_('3 Columns'),
                            '1-4' => Text::_('4 Columns'),
                            '1-5' => Text::_('5 Columns'),
                            '1-6' => Text::_('6 Columns'),
                        ),
                        'std' => '1-2',
                    ),
                    'column_width' => array(
                        'title' => Text::_('Column Mobile'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1 Column'),
                            '1-2' => Text::_('2 Columns'),
                            '1-3' => Text::_('3 Columns'),
                            '1-4' => Text::_('4 Columns'),
                            '1-5' => Text::_('5 Columns'),
                            '1-6' => Text::_('6 Columns'),
                        ),
                        'std' => '1-1',
                    ),

                    'column_gutter' => array(
                        'type' => 'select',
                        'title' => Text::_('Column Gutter'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('Collapse'),
                        ),
                        'std' => ''
                    ),

                    'column_divider' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Column Divider'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'enable_center' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Center Slider'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),
                    'loop' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Loop'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 1,
                    ),

                    'viewport_offset' => array(
                        'type' => 'slider',
                        'title' => Text::_('Viewport Offset %'),
                        'desc' => Text::_('Set to percent of the viewport height'),
                        'min' => 10,
                        'max' => 100,
                    ),

                    'min_height' => array(
                        'type' => 'slider',
                        'title' => Text::_('Min Height'),
                        'desc' => Text::_('Set the minimum height. This is useful if the content is too large on small devices.'),
                        'min' => 100,
                        'max' => 2000,
                    ),

                    'separator_items_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Items'),
                    ),

                    'overlay' => array(
                        'type' => 'color',
                        'title' => Text::_('Overlay Color'),
                        'desc' => Text::_('Set an additional transparent overlay to soften the image.'),
                    ),

                    'separator_title_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Title'),
                    ),

                    'heading_selector' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
                        'values' => array(
                            'h1' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
                            'h2' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
                            'h3' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
                            'h4' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
                            'h5' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
                            'h6' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
                        ),
                        'std' => 'h3',
                    ),
                    'title_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.sppb-addon-title { font-family: "{{ VALUE }}"; }'
                        )
                    ),
                    'title_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true
                    ),
                    'title_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true
                    ),
                    'title_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                    ),
                    'title_letterspace' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                        'values' => array(
                            '0' => 'Default',
                            '1px' => '1px',
                            '2px' => '2px',
                            '3px' => '3px',
                            '4px' => '4px',
                            '5px' => '5px',
                            '6px' => '6px',
                            '7px' => '7px',
                            '8px' => '8px',
                            '9px' => '9px',
                            '10px' => '10px'
                        ),
                        'std' => '0',
                    ),
                    'title_text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
                    ),
                    'title_margin_top' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
                        'placeholder' => '10',
                        'max' => 400,
                        'responsive' => true
                    ),
                    'title_margin_bottom' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
                        'placeholder' => '10',
                        'max' => 400,
                        'responsive' => true
                    ),
                    'separator_button_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Button Options'),
                    ),
                    'show_button' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Show Button'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
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
                    'button_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true
                    ),
                    'button_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true
                    ),
                    'button_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                    ),
                    'button_letterspace' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                        'values' => array(
                            '0' => 'Default',
                            '1px' => '1px',
                            '2px' => '2px',
                            '3px' => '3px',
                            '4px' => '4px',
                            '5px' => '5px',
                            '6px' => '6px',
                            '7px' => '7px',
                            '8px' => '8px',
                            '9px' => '9px',
                            '10px' => '10px'
                        ),
                        'std' => '0',
                    ),
                    'button_text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
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
                    ),
                ),
                'options' => PageBuilder::general_options()
            ),
        )
    );
}