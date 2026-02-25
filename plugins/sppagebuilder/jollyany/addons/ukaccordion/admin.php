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
            'type' => 'repeatable',
            'addon_name' => 'ukaccordion',
            'title' => Text::_('UK Accordion'),
            'desc' => Text::_('Display an accordion with a list of items.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukaccordion/assets/images/icon.png',
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
                    'uk_accordion_item' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_TITLE'),
                                'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_TITLE_DESC'),
                                'std' => 'Item',
                            ),
                            'content' => array(
                                'type' => 'editor',
                                'title' => Text::_('Content'),
                                'desc' => Text::_('Defines the content part for each accordion item.'),
                                'std' => 'Guide to setup and configuration. You can present below a guide and a description of how your system configuration works and add some animated screens.'
                            ),

                            'link' => array(
                                'type' => 'media',
                                'format' => 'attachment',
                                'title' => Text::_('Link'),
                                'placeholder' => 'http://www.example.com',
                                'hide_preview' => true,
                            ),
                            'button_title' => array(
                                'type' => 'text',
                                'title' => Text::_('Link Text'),
                                'depends' => array(array('link', '!=', '')),
                            ),
                        ),
                    ),
                    'separator_accordion_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Accordion'),
                    ),
                    'multiple' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Allow multiple open items'),
                        'desc' => Text::_('To display multiple content sections at the same time without one collapsing when the other one is opened'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'closed' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Allow all items to be closed'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 1,
                    ),
                    'icon_align' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Left Icon Alignment'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'accordion_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a predefined style for accordion'),
                        'values' => array(
                            '' => Text::_('None'),
                            'default' => Text::_('Default'),
                            'muted' => Text::_('Muted'),
                            'primary' => Text::_('Primary'),
                            'secondary' => Text::_('Secondary'),
                            'hover' => Text::_('Hover'),
                        ),
                        'std' => '',
                    ),
                    'card_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Size'),
                        'desc' => Text::_('Define the card\'s size by selecting the padding between the card and its content.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'uk-card-small' => Text::_('Small'),
                            'uk-card-large' => Text::_('Large'),
                        ),
                        'std' => 'uk-card-small',
                        'depends' => array(array('accordion_style', '!=', '')),
                    ),
                    'separator_title_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Title'),
                    ),
                    'title_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-title { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'title_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Predefined Color'),
                        'desc' => Text::_('Select the predefined title text color.'),
                        'values' => array(
                            '' => Text::_('None'),
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
                    'custom_title_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Custom Color'),
                        'depends' => array(
                            array('title_color', '=', '')
                        ),
                    ),
                    'title_text_transform' => array(
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
                    'separator_content_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Content'),
                    ),
                    'content_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a predefined meta text style, including color, size and font-family'),
                        'values' => array(
                            '' => Text::_('None'),
                            'text-lead' => Text::_('Lead'),
                            'text-meta' => Text::_('Meta'),
                        ),
                        'std' => '',
                    ),
                    'content_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.ukcontent { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'content_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Color'),
                    ),
                    'content_text_transform' => array(
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
                    'content_dropcap' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Drop Cap'),
                        'desc' => Text::_('Display the first letter of the paragraph as a large initial.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'content_column' => array(
                        'type' => 'select',
                        'title' => Text::_('Columns'),
                        'desc' => Text::_('Set the number of text columns.'),
                        'values' => array(
                            '' => Text::_('None'),
                            '1-2' => Text::_('Halves'),
                            '1-3' => Text::_('Thirds'),
                            '1-4' => Text::_('Quarters'),
                            '1-5' => Text::_('Fifths'),
                            '1-6' => Text::_('Sixths'),
                        ),
                        'std' => '',
                    ),
                    'content_column_divider' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Show dividers'),
                        'desc' => Text::_('Show a divider between text columns.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                        'depends' => array(array('content_column', '!=', '')),
                    ),
                    'content_column_breakpoint' => array(
                        'type' => 'select',
                        'title' => Text::_('Columns Breakpoint'),
                        'desc' => Text::_('Set the device width from which the text columns should apply'),
                        'values' => array(
                            '' => Text::_('Always'),
                            's' => Text::_('Small (Phone Landscape)'),
                            'm' => Text::_('Medium (Tablet Landscape)'),
                            'l' => Text::_('Large (Desktop)'),
                            'xl' => Text::_('X-Large (Large Screens)'),
                        ),
                        'std' => 'm',
                        'depends' => array(array('content_column', '!=', '')),
                    ),
                    'content_margin_top' => array(
                        'type' => 'select',
                        'title' => Text::_('Margin Top'),
                        'desc' => Text::_('Set the top margin.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                            'remove' => Text::_('None'),
                        ),
                        'std' => '',
                    ),

                    'separator_button_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Link'),
                    ),
                    'all_button_title' => array(
                        'type' => 'text',
                        'title' => Text::_('Text'),
                        'placeholder' => 'Read more',
                        'std' => 'Read more',
                    ),
                    'target' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
                        'values' => array(
                            '' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                            '_blank' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                        ),
                    ),
                    'button_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Set the button style.'),
                        'values' => array(
                            '' => Text::_('Button Default'),
                            'primary' => Text::_('Button Primary'),
                            'secondary' => Text::_('Button Secondary'),
                            'danger' => Text::_('Button Danger'),
                            'text' => Text::_('Button Text'),
                            'link' => Text::_('Link'),
                            'link-muted' => Text::_('Link Muted'),
                            'link-text' => Text::_('Link Text'),
                            'custom' => Text::_('Custom'),
                        ),
                        'std' => '',
                    ),
                    'separator_button_custom_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Custom Button Style'),
                        'depends' => array(
                            array('button_style', '=', 'custom'),
                        ),
                    ),
                    'button_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'depends' => array(
                            array('button_style', '=', 'custom'),
                        ),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-button-custom { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'button_background' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'std' => '#1e87f0',
                        'depends' => array(
                            array('button_style', '=', 'custom'),
                        ),
                    ),
                    'button_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Button Color'),
                        'depends' => array(
                            array('button_style', '=', 'custom'),
                        ),
                    ),
                    'button_background_hover' => array(
                        'type' => 'color',
                        'title' => Text::_('Hover Background Color'),
                        'std' => '#0f7ae5',
                        'depends' => array(
                            array('button_style', '=', 'custom'),
                        ),
                    ),
                    'button_hover_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Hover Button Color'),
                        'depends' => array(
                            array('button_style', '=', 'custom'),
                        ),
                    ),
                    'button_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Button Size'),
                        'desc' => Text::_('Set the size for multiple buttons.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'uk-button-small' => Text::_('Small'),
                            'uk-button-large' => Text::_('Large'),
                        ),
                    ),
                    'button_margin_top' => array(
                        'type' => 'select',
                        'title' => Text::_('Margin Top'),
                        'desc' => Text::_('Set the top margin.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                            'remove' => Text::_('None'),
                        ),
                        'std' => '',
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