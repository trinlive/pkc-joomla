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
            'type' => 'content',
            'addon_name' => 'uktext',
            'title' => Text::_('UK Text'),
            'desc' => Text::_('Text addon based on UI Kit'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/uktext/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => '',
                    ),
                    'separator_title_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Title Options'),
                    ),
                    'title_addon' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                        'std' => '',
                    ),
                    'title_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-title { font-family: {{ VALUE }}; }',
                        )
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
                            'p' => 'p',
                            'span' => 'span',
                            'div' => 'div'
                        ),
                        'std' => 'h3',
                        'depends' => array(array('title_addon', '!=', '')),
                    ),
                    'title_heading_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Heading styles differ in font-size but may also come with a predefined color, size and font'),
                        'values' => array(
                            '' => Text::_('None'),
                            'heading-2xlarge' => Text::_('2XLarge'),
                            'heading-xlarge' => Text::_('XLarge'),
                            'heading-large' => Text::_('Large'),
                            'heading-medium' => Text::_('Medium'),
                            'heading-small' => Text::_('Small'),
                            'h1' => Text::_('H1'),
                            'h2' => Text::_('H2'),
                            'h3' => Text::_('H3'),
                            'h4' => Text::_('H4'),
                            'h5' => Text::_('H5'),
                            'h6' => Text::_('H6'),
                        ),
                        'std' => 'h3',
                        'depends' => array(array('title_addon', '!=', '')),
                    ),
                    'title_transform' => array(
                        'type' => 'select',
                        'title' => Text::_('Transform'),
                        'desc' => Text::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
                        'values' => array(
                            '' => Text::_('Inherit'),
                            'uppercase' => Text::_('Uppercase'),
                            'capitalize' => Text::_('Capitalize'),
                            'lowercase' => Text::_('Lowercase'),
                        ),
                        'std' => '',
                    ),
                    'title_heading_decoration' => array(
                        'type' => 'select',
                        'title' => Text::_('Decoration'),
                        'desc' => Text::_('Decorate the heading with a divider, bullet or a line that is vertically centered to the heading'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-heading-divider' => Text::_('Divider'),
                            'uk-heading-bullet' => Text::_('Bullet'),
                            'uk-heading-line' => Text::_('Line'),
                        ),
                        'std' => '',
                        'depends' => array(array('title_addon', '!=', '')),
                    ),
                    'title_heading_margin' => array(
                        'type' => 'select',
                        'title' => Text::_('Title Margin'),
                        'desc' => Text::_('Set the vertical margin for title.'),
                        'values' => array(
                            '' => Text::_('Keep existing'),
                            'uk-margin-small' => Text::_('Small'),
                            'uk-margin' => Text::_('Default'),
                            'uk-margin-medium' => Text::_('Medium'),
                            'uk-margin-large' => Text::_('Large'),
                            'uk-margin-xlarge' => Text::_('X-Large'),
                            'uk-margin-remove-vertical' => Text::_('None'),
                        ),
                        'std' => 'uk-margin',
                        'depends' => array(array('title_addon', '!=', '')),
                    ),
                    'title_heading_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Color'),
                        'desc' => Text::_('Select the text color. If the Background option is selected, styles that don\'t apply a background image use the primary color instead.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'text-muted' => Text::_('Muted'),
                            'text-emphasis' => Text::_('Emphasis'),
                            'text-primary' => Text::_('Primary'),
                            'text-secondary' => Text::_('Secondary'),
                            'text-success' => Text::_('Success'),
                            'text-warning' => Text::_('Warning'),
                            'text-danger' => Text::_('Danger'),
                        ),
                        'std' => '',
                        'depends' => array(array('title_addon', '!=', '')),
                    ),
                    'title_text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
                        'depends' => array(array('title_addon', '!=', '')),
                    ),
                    'separator_text_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Content Style'),
                    ),
                    'text' => array(
                        'type' => 'editor',
                        'title' => Text::_('Content'),
                        'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                    ),
                    'text_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY_DESC'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uktext { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'dropcap' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable drop cap'),
                        'desc' => Text::_('Display the first letter of the paragraph as a large initial'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'dropcap_color' => array(
                        'type' => 'color',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_DROPCAP_COLOR'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_DROPCAP_COLOR_DESC'),
                        'depends' => array(array('dropcap', '=', 1)),
                    ),

                    'text_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Text Style'),
                        'desc' => Text::_('Select a predefined text style, including color, size and font-family.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'lead' => Text::_('Lead'),
                            'meta' => Text::_('Meta'),
                            'custom' => Text::_('Custom'),
                        ),
                        'std' => '',
                    ),
                    'text_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Text Size'),
                        'desc' => Text::_('Select the text size.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'small' => Text::_('Small'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('text_style', '!=', 'lead'),
                            array('text_style', '!=', 'meta'),
                            array('text_style', '!=', 'custom'),
                        ),
                    ),
                    'text_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Text Color'),
                    ),
                    'text_fontsize' => array(
                        'type' => 'slider',
                        'title' => Text::_('Text Font Size'),
                        'std' => '',
                        'responsive' => true,
                        'max' => 400,
                        'depends' => array(
                            array('text_style', '=', 'custom'),
                        ),
                    ),

                    'text_lineheight' => array(
                        'type' => 'slider',
                        'title' => Text::_('Text Line Height'),
                        'std' => '',
                        'responsive' => true,
                        'max' => 400,
                        'depends' => array(
                            array('text_style', '=', 'custom'),
                        ),
                    ),

                    'text_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => Text::_('Text Font Style'),
                        'depends' => array(
                            array('text_style', '=', 'custom'),
                        ),
                    ),

                    'text_letterspace' => array(
                        'type' => 'select',
                        'title' => Text::_('Text Letter Space'),
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
                        'depends' => array(
                            array('text_style', '=', 'custom'),
                        ),
                    ),
                    'columns' => array(
                        'type' => 'select',
                        'title' => Text::_('Columns'),
                        'desc' => Text::_('Display your content in multiple text columns without having to split it in several containers.'),
                        'values' => array(
                            '' => Text::_('None'),
                            '1-2' => Text::_('Halves'),
                            '1-3' => Text::_('Thirds'),
                            '1-4' => Text::_('Quarters'),
                            '1-5' => Text::_('Fifths'),
                            '1-6' => Text::_('Sixths'),
                        ),
                        'std' => '',
                        'depends' => array(array('text', '!=', '')),
                    ),
                    'divider' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Divider'),
                        'desc' => Text::_('Show dividers between the text columns.'),
                        'std' => 0,
                        'depends' => array(array('columns', '!=', '')),
                    ),
                    'columns_breakpoint' => array(
                        'type' => 'select',
                        'title' => Text::_('Columns Breakpoint'),
                        'desc' => Text::_('Set the device width from which the text columns should apply. Note: For each breakpoint downward the number of columns will be reduced by one.'),
                        'values' => array(
                            '' => Text::_('Always'),
                            's' => Text::_('Small (Phone Landscape)'),
                            'm' => Text::_('Medium (Tablet Landscape)'),
                            'l' => Text::_('Large (Desktop)'),
                            'xl' => Text::_('X-Large (Large Screens)'),
                        ),
                        'std' => '',
                        'depends' => array(array('columns', '!=', '')),
                    ),
                    'content_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Content Style'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'light' => Text::_('Light'),
                            'dark' => Text::_('Dark'),
                        ),
                        'std' => '',
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