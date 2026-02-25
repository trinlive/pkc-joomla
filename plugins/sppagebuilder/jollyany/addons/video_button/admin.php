<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2022 Jollyany
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined ('_JEXEC') or die ('Restricted access');
use Jollyany\Helper\PageBuilder;
use Joomla\CMS\Language\Text;
if (file_exists(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'jollyany'. DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR .'jollyany' . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR. 'PageBuilder.php')) {
    SpAddonsConfig::addonConfig(
        array(
            'type' => 'content',
            'addon_name' => 'sp_video_button',
            'title' => Text::_('COM_SPPAGEBUILDER_ADDON_VIDEO_BUTTON'),
            'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_VIDEO_BUTTON_DESC'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/video_button/assets/images/icon.png',
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
                        'max' => 400,
                        'responsive' => true,
                        'depends' => array(array('title', '!=', '')),
                    ),

                    'title_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                        'std' => '',
                        'max' => 400,
                        'responsive' => true,
                        'depends' => array(array('title', '!=', '')),
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
                        'std' => '0',
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
                        'max' => 400,
                        'responsive' => true,
                        'depends' => array(array('title', '!=', '')),
                    ),

                    'title_margin_bottom' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
                        'placeholder' => '10',
                        'max' => 400,
                        'responsive' => true,
                        'depends' => array(array('title', '!=', '')),
                    ),

                    'video_url' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_VIDEO_BUTTON_URL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_VIDEO_BUTTON_URL_DESC'),
                        'std' => ''
                    ),

                    'video_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_VIDEO_ICON_SIZE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_VIDEO_ICON_SIZE'),
                        'std' => '',
                        'max' => 400,
                        'depends' => array(array('video_url', '!=', '')),
                    ),

                    'ripple_effect' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Ripple Effect'),
                        'std' => 0
                    ),

                    'ripple_color' => array(
                        'type' => 'color',
                        'title' => JText::_('Ripple Color'),
                        'depends' => array(array('ripple_effect', '!=', 0)),
                    ),

                    'width' => array(
                        'type' => 'slider',
                        'title' => Text::_('Width'),
                        'max' => 500,
                    ),

                    'height' => array(
                        'type' => 'slider',
                        'title' => Text::_('Height'),
                        'max' => 500,
                    ),

                    'use_border' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_USE_BORDER'),
                        'std' => 0
                    ),

                    'border_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
                        'depends' => array(array('use_border', '!=', '0')),
                    ),

                    'border_width' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
                        'placeholder' => '3',
                        'depends' => array(array('use_border', '!=', '0')),
                    ),

                    'border_radius' => array(
                        'type' => 'slider',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
                        'placeholder' => '5',
                        'max' => 500,
                        'depends' => array(array('use_border', '!=', '0')),
                    ),

                    'background_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
                    ),

                    'color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
                    ),

                    'background_color_hover' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER_DESC'),
                    ),
                    'color_hover' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER_DESC'),
                    ),

                    'alignment' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'uk-text-left' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                            'uk-text-center' => Text::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
                            'uk-text-right' => Text::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        ),
                        'std' => '',
                    ),

                    'align_breakpoint' => array(
                        'type' => 'select',
                        'title' => Text::_('Alignment Breakpoint'),
                        'desc' => Text::_('Display the alignment only on this device width and larger'),
                        'values' => array(
                            '' => Text::_('Always'),
                            's' => Text::_('Small (Phone Landscape)'),
                            'm' => Text::_('Medium (Tablet Landscape)'),
                            'l' => Text::_('Large (Desktop)'),
                            'xl' => Text::_('X-Large (Large Screens)'),
                        ),
                        'std' => '',
                        'depends' => array(array('alignment', '!=', '')),
                    ),

                    'alignment_fallback' => array(
                        'type' => 'select',
                        'title' => Text::_('Alignment Fallback'),
                        'desc' => Text::_('Define an alignment fallback for device widths below the breakpoint'),
                        'values' => array(
                            '' => Text::_('Inherit'),
                            'left' => Text::_('Left'),
                            'center' => Text::_('Center'),
                            'right' => Text::_('Right'),
                            'justify' => Text::_('Justify'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('alignment', '!=', ''),
                            array('align_breakpoint', '!=', '')
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