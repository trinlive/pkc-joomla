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
            'addon_name' => 'ukcontent',
            'title' => Text::_('UK Content'),
            'desc' => Text::_('Create a flexible content using UIKit.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukcontent/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    'title' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                        'std' => ''
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
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'depends' => array(array('title', '!=', '')),
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
                        'depends' => array(array('title', '!=', '')),
                        'max' => 400,
                        'responsive' => true
                    ),
                    'title_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                        'std' => '',
                        'depends' => array(array('title', '!=', '')),
                        'max' => 400,
                        'responsive' => true
                    ),
                    'title_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                        'depends' => array(array('title', '!=', '')),
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
                        'std' => '0px',
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_margin_top' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
                        'placeholder' => '10',
                        'depends' => array(array('title', '!=', '')),
                        'max' => 400,
                        'responsive' => true
                    ),
                    'title_margin_bottom' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
                        'placeholder' => '10',
                        'depends' => array(array('title', '!=', '')),
                        'max' => 400,
                        'responsive' => true
                    ),
                    // Repeatable Items
                    'ukcontent_items' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'media_type' => array(
                                'type' => 'select',
                                'title' => Text::_('Select Media Type'),
                                'values' => array(
                                    'icon' => 'Icon',
                                    'image' => 'Image',
                                    'none' => 'None',
                                ),
                                'std' => 'icon',
                            ),
                            'image' => array(
                                'type' => 'media',
                                'title' => Text::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT'),
                                'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT_DESC'),
                                'show_input' => true,
                                'std' => array(
                                    'src' => 'https://sppagebuilder.com/addons/image/image1.jpg',
                                    'height' => '',
                                    'width' => '',
                                ),
                                'depends' => array(array('media_type', '=', 'image')),
                            ),
                            'icon_type' => array(
                                'type' => 'select',
                                'title' => Text::_('Select Media Type'),
                                'values' => array(
                                    'uikit' => 'UIKit Icon',
                                    'fontawesome' => 'Font Awesome',
                                    'linearicon' => 'Linear Icon',
                                    'custom' => 'Custom',
                                ),
                                'std' => 'uikit',
                                'depends' => array(array('media_type', '=', 'icon')),
                            ),
                            'fontawesome_icon' => array(
                                'type' => 'icon',
                                'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_ICON_NAME'),
                                'std' => 'fa-cogs',
                                'depends' => array(
                                    array('media_type', '=', 'icon'),
                                    array('icon_type', '=', 'fontawesome'),
                                ),
                            ),
                            'uikit_icon' => array(
                                'type' => 'select',
                                'title' => Text::_('Select an UI Kit Icon'),
                                'values' => PageBuilder::getUKIcon(),
                                'std' => '',
                                'depends' => array(
                                    array('media_type', '=', 'icon'),
                                    array('icon_type', '=', 'uikit'),
                                ),
                            ),
                            'linearicon'=>array(
                                'type'      =>  'select',
                                'title'     =>  JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_NAME'),
                                'desc'      =>  JText::_('COM_SPPAGEBUILDER_GLOBAL_LINEARICON_DESC'),
                                'values'    =>  PageBuilder::getLinearicon(),
                                'depends'   =>  array(
                                    array('media_type', '=', 'icon'),
                                    array('icon_type', '=', 'linearicon'),
                                ),
                            ),
                            'custom_icon' => array(
                                'type' => 'text',
                                'title' => Text::_('Custom Icon Class'),
                                'depends' => array(
                                    array('media_type', '=', 'icon'),
                                    array('icon_type', '=', 'custom'),
                                ),
                            ),
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('Title'),
                            ),
                            'meta' => array(
                                'type' => 'text',
                                'title' => Text::_('Meta'),
                            ),
                            'content' => array(
                                'type' => 'editor',
                                'title' => Text::_('Content'),
                                'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
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
                        'title' => Text::_('Grid Options'),
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
                        'std' => '1-1',
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

                    'row_gutter' => array(
                        'type' => 'select',
                        'title' => Text::_('Row Gutter'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('Collapse'),
                        ),
                        'std' => ''
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

                    'separator_items_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Items Options'),
                    ),

                    'card_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Card Style'),
                        'values' => array(
                            '' => Text::_('None'),
                            'default' => Text::_('Default'),
                            'primary' => Text::_('Primary'),
                            'secondary' => Text::_('Secondary'),
                            'custom' => Text::_('Custom'),
                        ),
                        'std' => ''
                    ),

                    'card_custom_style'=>array(
                        'type'=>'buttons',
                        'title'=>JText::_('Custom Style'),
                        'std'=>'normal_arrow',
                        'values'=>array(
                            array(
                                'label' => 'Normal Style',
                                'value' => 'normal_style'
                            ),
                            array(
                                'label' => 'Hover Style',
                                'value' => 'hover_style'
                            )
                        ),
                        'depends'=>array(
                            array('card_style', '=', 'custom'),
                        ),
                    ),

                    //Card custom normal
                    'card_custom_background' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'normal_style'),
                        )
                    ),

                    'card_custom_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Color'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'normal_style'),
                        )
                    ),

                    'card_custom_border_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Border Color'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'normal_style'),
                        )
                    ),

                    'card_custom_border_width' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'normal_style'),
                        ),
                    ),

                    'card_custom_border_style' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
                        'values' => array(
                            'none' => Text::_('None'),
                            'solid' => Text::_('Solid'),
                            'dashed' => Text::_('Dashed'),
                            'dotted' => Text::_('Dotted'),
                            'double' => Text::_('Double'),
                        ),
                        'std' => 'none',
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'normal_style'),
                        ),
                    ),

                    //Card custom hover
                    'card_custom_background_hover' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'hover_style'),
                        )
                    ),

                    'card_custom_color_hover' => array(
                        'type' => 'color',
                        'title' => Text::_('Color'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'hover_style'),
                        )
                    ),

                    'card_custom_border_color_hover' => array(
                        'type' => 'color',
                        'title' => Text::_('Border Color'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'hover_style'),
                        )
                    ),

                    'card_custom_border_width_hover' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'hover_style'),
                        ),
                    ),

                    'card_custom_border_style_hover' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
                        'values' => array(
                            'none' => Text::_('None'),
                            'solid' => Text::_('Solid'),
                            'dashed' => Text::_('Dashed'),
                            'dotted' => Text::_('Dotted'),
                            'double' => Text::_('Double'),
                        ),
                        'std' => 'none',
                        'depends' => array(
                            array('card_style', '=', 'custom'),
                            array('card_custom_style', '=', 'hover_style'),
                        ),
                    ),

                    'card_hover' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Card Hover'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'grid_match' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Grid Match'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'card_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Card Size'),
                        'values' => array(
                            'none' => Text::_('None'),
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => ''
                    ),

                    'card_border_radius' => array(
                        'type' => 'select',
                        'title' => Text::_('Card Border Radius'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'rounded' => Text::_('Rounded'),
                            'circle' => Text::_('Circle'),
                            'pill' => Text::_('Pill'),
                        ),
                        'std' => ''
                    ),

                    'media_position' => array(
                        'type' => 'select',
                        'title' => Text::_('Media Position'),
                        'values' => array(
                            'top' => Text::_('Top'),
                            'left' => Text::_('Left'),
                            'right' => Text::_('Right'),
                            'bottom' => Text::_('Bottom'),
                            'inside' => Text::_('Inside'),
                        ),
                        'std' => 'inside'
                    ),

                    'media_width_xl' => array(
                        'title' => Text::_('Image Width Large Desktop'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1-1'),
                            '1-2' => Text::_('1-2'),
                            '1-3' => Text::_('1-3'),
                            '2-3' => Text::_('2-3'),
                            '1-4' => Text::_('1-4'),
                            '3-4' => Text::_('3-4'),
                            '1-5' => Text::_('1-5'),
                            '2-5' => Text::_('2-5'),
                            '4-5' => Text::_('4-5'),
                            '1-6' => Text::_('1-6'),
                            '5-6' => Text::_('5-6'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '1-2',
                        'depends' => array(
                            array('media_position', '!=', 'top'),
                            array('media_position', '!=', 'inside'),
                            array('media_position', '!=', 'bottom'),
                        )
                    ),
                    'media_width_l' => array(
                        'title' => Text::_('Image Width Desktop'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1-1'),
                            '1-2' => Text::_('1-2'),
                            '1-3' => Text::_('1-3'),
                            '2-3' => Text::_('2-3'),
                            '1-4' => Text::_('1-4'),
                            '3-4' => Text::_('3-4'),
                            '1-5' => Text::_('1-5'),
                            '2-5' => Text::_('2-5'),
                            '4-5' => Text::_('4-5'),
                            '1-6' => Text::_('1-6'),
                            '5-6' => Text::_('5-6'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '1-2',
                        'depends' => array(
                            array('media_position', '!=', 'top'),
                            array('media_position', '!=', 'inside'),
                            array('media_position', '!=', 'bottom'),
                        )
                    ),
                    'media_width_m' => array(
                        'title' => Text::_('Image Width Laptop'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1-1'),
                            '1-2' => Text::_('1-2'),
                            '1-3' => Text::_('1-3'),
                            '2-3' => Text::_('2-3'),
                            '1-4' => Text::_('1-4'),
                            '3-4' => Text::_('3-4'),
                            '1-5' => Text::_('1-5'),
                            '2-5' => Text::_('2-5'),
                            '4-5' => Text::_('4-5'),
                            '1-6' => Text::_('1-6'),
                            '5-6' => Text::_('5-6'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '1-2',
                        'depends' => array(
                            array('media_position', '!=', 'top'),
                            array('media_position', '!=', 'inside'),
                            array('media_position', '!=', 'bottom'),
                        )
                    ),
                    'media_width_s' => array(
                        'title' => Text::_('Image Width Tablet'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1-1'),
                            '1-2' => Text::_('1-2'),
                            '1-3' => Text::_('1-3'),
                            '2-3' => Text::_('2-3'),
                            '1-4' => Text::_('1-4'),
                            '3-4' => Text::_('3-4'),
                            '1-5' => Text::_('1-5'),
                            '2-5' => Text::_('2-5'),
                            '4-5' => Text::_('4-5'),
                            '1-6' => Text::_('1-6'),
                            '5-6' => Text::_('5-6'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '1-1',
                        'depends' => array(
                            array('media_position', '!=', 'top'),
                            array('media_position', '!=', 'inside'),
                            array('media_position', '!=', 'bottom'),
                        )
                    ),
                    'media_width' => array(
                        'title' => Text::_('Image Width Mobile'),
                        'type' => 'select',
                        'values' => array(
                            '1-1' => Text::_('1-1'),
                            '1-2' => Text::_('1-2'),
                            '1-3' => Text::_('1-3'),
                            '2-3' => Text::_('2-3'),
                            '1-4' => Text::_('1-4'),
                            '3-4' => Text::_('3-4'),
                            '1-5' => Text::_('1-5'),
                            '2-5' => Text::_('2-5'),
                            '4-5' => Text::_('4-5'),
                            '1-6' => Text::_('1-6'),
                            '5-6' => Text::_('5-6'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '1-1',
                        'depends' => array(
                            array('media_position', '!=', 'top'),
                            array('media_position', '!=', 'inside'),
                            array('media_position', '!=', 'bottom'),
                        )
                    ),

                    'media_vertical_align' => array(
                        'title' => Text::_('Media Vertical Align'),
                        'type' => 'select',
                        'values' => array(
                            'top' => Text::_('Top'),
                            'middle' => Text::_('Middle'),
                            'bottom' => Text::_('Bottom'),
                        ),
                        'std' => 'middle',
                        'depends' => array(
                            array('media_position', '!=', 'top'),
                            array('media_position', '!=', 'inside'),
                            array('media_position', '!=', 'bottom'),
                        )
                    ),

                    'separator_icon_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Icon Options')
                    ),

                    'icon_size' => array(
                        'type' => 'slider',
                        'title' => Text::_('Icon Size'),
                        'min' => 10,
                        'max' => 200,
                        'std' => 60,
                    ),

                    'icon_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
                    ),

                    'icon_color_hover' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
                    ),

                    'separator_image_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Image Options')
                    ),

                    'enable_image_cover' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Image Cover'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'min_height' => array(
                        'type' => 'slider',
                        'title' => Text::_('Min Height'),
                        'min' => 100,
                        'max' => 1000,
                        'depends' => array(
                            array('enable_image_cover', '=', 1),
                        )
                    ),

                    'image_overlay_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Overlay Color'),
                        'depends' => array(
                            array('enable_image_cover', '=', 1),
                        )
                    ),

                    'enable_image_svg' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable SVG Image'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'svg_width' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
                        'depends' => array(
                            array('enable_image_svg', '=', 1),
                        ),
                    ),

                    'svg_height' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
                        'depends' => array(
                            array('enable_image_svg', '=', 1),
                        ),
                    ),

                    'preserve' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Preserve Color'),
                        'desc' => Text::_('SVGs will adapt the current color for their stroke and fill color. To prevent this behavior, you can use this option to add css class to the SVG itself or to elements inside the SVG.'),
                        'std' => 0,
                        'depends' => array(
                            array('enable_image_svg', '!=', 0),
                        ),
                    ),
                    'color' => array(
                        'type' => 'color',
                        'title' => Text::_('Fill Color Svg'),
                        'std' => '',
                        'depends' => array(
                            array('enable_image_svg', '!=', 0),
                            array('preserve', '!=', 0),
                        ),
                    ),

                    'separator_title_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_ADDON_TITLE_OPTIONS')
                    ),

                    'title_heading_selector' => array(
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
                            'css' => '.uk-title { font-family: "{{ VALUE }}"; }'
                        )
                    ),

                    'title_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
                        'std' => '',

                        'responsive' => true,
                        'max' => 400,
                    ),

                    'title_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                        'std' => '',

                        'responsive' => true,
                        'max' => 400,
                    ),

                    'title_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),

                    ),

                    'title_letterspace' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                        'values' => array(
                            '-10px' => '-10px',
                            '-9px' => '-9px',
                            '-8px' => '-8px',
                            '-7px' => '-7px',
                            '-6px' => '-6px',
                            '-5px' => '-5px',
                            '-4px' => '-4px',
                            '-3px' => '-3px',
                            '-2px' => '-2px',
                            '-1px' => '-1px',
                            '0px' => 'Default',
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
                        'std' => '0px',
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
                        'responsive' => true,
                        'max' => 400,
                    ),

                    'title_margin_bottom' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
                        'placeholder' => '10',
                        'responsive' => true,
                        'max' => 400,
                    ),

                    'link_title' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable link on title'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'enable_stroke_text' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable stroke Text'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'title_stroke_width' => array(
                        'type' => 'slider',
                        'title' => Text::_('Title Stroke Width'),
                        'std' => '1',
                        'max' => 50,
                        'depends' => array(
                            array('enable_stroke_text', '=', 1),
                        )
                    ),

                    'separator_meta_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Meta Options')
                    ),

                    'meta_heading_selector' => array(
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
                            'span' => Text::_('span'),
                            'div' => Text::_('div'),
                            'p' => Text::_('p'),
                        ),
                        'std' => 'div',
                    ),

                    'meta_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Meta Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-meta { font-family: "{{ VALUE }}"; }'
                        )
                    ),

                    'meta_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('Meta Font Size'),
                        'std' => '',
                        'responsive' => true,
                        'max' => 400,
                    ),

                    'meta_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('Meta Line Height'),
                        'std' => '',
                        'responsive' => true,
                        'max' => 400,
                    ),

                    'meta_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => Text::_('Meta Font Style'),
                    ),

                    'meta_letterspace' => array(
                        'type' => 'select',
                        'title' => Text::_('Meta Letter Space'),
                        'values' => array(
                            '-10px' => '-10px',
                            '-9px' => '-9px',
                            '-8px' => '-8px',
                            '-7px' => '-7px',
                            '-6px' => '-6px',
                            '-5px' => '-5px',
                            '-4px' => '-4px',
                            '-3px' => '-3px',
                            '-2px' => '-2px',
                            '-1px' => '-1px',
                            '0px' => 'Default',
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
                        'std' => '0px',
                    ),

                    'meta_text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Meta Color'),
                    ),

                    'meta_margin_top' => array(
                        'type' => 'slider',
                        'title' => Text::_('Meta Margin Top'),
                        'placeholder' => '10',
                        'responsive' => true,
                        'max' => 400,
                    ),

                    'meta_margin_bottom' => array(
                        'type' => 'slider',
                        'title' => Text::_('Meta Margin Bottom'),
                        'placeholder' => '10',
                        'responsive' => true,
                        'max' => 400,
                    ),

                    'meta_position' => array(
                        'type' => 'select',
                        'title' => Text::_('Meta Position'),
                        'values' => array(
                            'before' => 'Before Title',
                            'after' => 'After Title',
                        ),
                        'std' => 'before',
                    ),

                    'separator_content_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_ADDON_CONTENT_OPTIONS')
                    ),

                    'text_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY_DESC'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-desc { font-family: "{{ VALUE }}"; }'
                        )
                    ),

                    'text_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Predefined Color'),
                        'desc' => Text::_('Select the predefined meta text color.'),
                        'values' => array(
                            '' => Text::_('Custom'),
                            'muted' => Text::_('Muted'),
                            'emphasis' => Text::_('Emphasis'),
                            'primary' => Text::_('Primary'),
                            'secondary' => Text::_('Secondary'),
                            'success' => Text::_('Success'),
                            'warning' => Text::_('Warning'),
                            'danger' => Text::_('Danger'),
                        ),
                        'std' => '',
                    ),
                    'custom_text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Custom Color'),
                        'depends' => array(
                            array('text_color', '=', '')
                        ),
                    ),

                    'text_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_SIZE'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true
                    ),

                    'text_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_LINE_HEIGHT'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true
                    ),

                    'text_fontweight' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONTWEIGHT'),
                        'values' => array(
                            100 => 100,
                            200 => 200,
                            300 => 300,
                            400 => 400,
                            500 => 500,
                            600 => 600,
                            700 => 700,
                            800 => 800,
                            900 => 900,
                        ),
                        'std' => '',
                    ),

                    // Button
                    'btn_separator' => array(
                        'type' => 'separator',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_BUTTON_READMORE_OPTIONS')
                    ),

                    'enable_button' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Button'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'button_text' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
                        'std' => 'Read more',
                    ),

                    'button_type' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
                        'values' => array(
                            'default' => Text::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
                            'primary' => Text::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
                            'secondary' => Text::_('COM_SPPAGEBUILDER_GLOBAL_SECONDARY'),
                            'danger' => Text::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
                            'text' => Text::_('Text'),
                            'link' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                            'custom' => Text::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
                        ),
                        'std' => 'default'
                    ),

                    'button_size' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DESC'),
                        'values' => array(
                            '' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DEFAULT'),
                            'small' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_SMALL'),
                            'large' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_LARGE'),
                        ),
                        'std' => ''
                    ),

                    'button_border_radius' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
                        'values' => array(
                            '' => Text::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
                            'rounded' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
                            'circle' => Text::_('Circle'),
                            'pill' => Text::_('Pill'),
                        ),
                        'std' => ''
                    ),

                    'button_full_width' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Button Full Width'),
                        'values' => array(
                            1 => Text::_('COM_SPPAGEBUILDER_YES'),
                            0 => Text::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std' => 0,
                    ),

                    'button_margin' => array(
                        'type' => 'select',
                        'title' => Text::_('Button Margin'),
                        'desc' => Text::_('Set space between button and others'),
                        'values' => array(
                            '' => Text::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                            'remove' => Text::_('Remove'),
                        ),
                        'std' => 'default'
                    ),
                ),
                'options' => PageBuilder::general_options(),
            ),
        )
    );
}