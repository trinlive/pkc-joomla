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
            'addon_name' => 'ukheading',
            'title' => Text::_('UK Heading'),
            'desc' => Text::_('Define different styles for headings based UI Kit.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukheading/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => '',
                    ),

                    'title' => array(
                        'type' => 'textarea',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                        'std' => 'This is title',
                    ),

                    'use_highlight' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Use Highlight'),
                        'desc' => Text::_('Use highlight effect'),
                        'std' => 0,
                    ),

                    'highlight_style' => array(
                        'type' => 'select',
                        'title' => JText::_('Highlight Effect'),
                        'desc' => JText::_('Create attractive headlines that help keep your visitors interested and engaged'),
                        'values' => array(
                            'circle' => JText::_('Circle'),
                            'curly-line' => JText::_('Curly Line'),
                            'double' => JText::_('Double'),
                            'double-line' => JText::_('Double Line'),
                            'zigzag' => JText::_('Zigzag'),
                            'diagonal' => JText::_('Diagonal'),
                            'underline' => JText::_('Underline'),
                            'delete' => JText::_('Delete'),
                            'strike' => JText::_('Strikethrough'),
                        ),
                        'std' => 'underline',
                        'depends' => array('use_highlight' => 1),
                    ),

                    'highlight_title' => array(
                        'type' => 'textarea',
                        'title' => Text::_('Highlight Title'),
                        'depends' => array('use_highlight' => 1),
                    ),

                    'title_after_highlight' => array(
                        'type' => 'textarea',
                        'title' => Text::_('After Title'),
                        'depends' => array('use_highlight' => 1),
                    ),

                    'use_link' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADING_USE_LINK'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_HEADING_USE_LINK_DESC'),
                        'std' => 0,
                    ),

                    'title_link' => array(
                        'type' => 'media',
                        'format' => 'attachment',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_DESC'),
                        'placeholder' => 'http://',
                        'std' => '',
                        'hide_preview' => true,
                        'depends' => array('use_link' => 1),
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
                        'depends' => array('use_link' => 1),
                    ),
                    'separator_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Style'),
                    ),
                    'heading_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-title { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'heading_selector' => array(
                        'type' => 'select',
                        'title' => Text::_('HTML Element'),
                        'desc' => Text::_('Choose one of the seven heading elements to fit your semantic structure.'),
                        'values' => array(
                            'h1' => Text::_('h1'),
                            'h2' => Text::_('h2'),
                            'h3' => Text::_('h3'),
                            'h4' => Text::_('h4'),
                            'h5' => Text::_('h5'),
                            'h6' => Text::_('h6'),
                            'div' => Text::_('div'),
                        ),
                        'std' => 'h1',
                    ),
                    'heading_style' => array(
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
                            'custom' => Text::_('Custom'),
                        ),
                        'std' => '',
                    ),
                    'heading_fontsize'=>array(
                        'type'=>'slider',
                        'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                        'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
                        'std'=>'',
                        'responsive' => true,
                        'max'=> 400,
                        'depends' => array(array('heading_style', '=', 'custom')),
                    ),
                    'heading_font_weight' => array(
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
                    'heading_letterspace' => array(
                        'type' => 'select',
                        'title' => Text::_('Heading Letter Space'),
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
                    'decoration' => array(
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
                    ),
                    'decoration_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Decoration Color'),
                        'depends' => array(array('decoration', '!=', '')),
                    ),
                    'decoration_width' => array(
                        'type' => 'slider',
                        'min' => 1,
                        'max' => 100,
                        'std' => 1,
                        'title' => Text::_('Decoration Width'),
                        'depends' => array(array('decoration', '!=', '')),
                    ),
                    'heading_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Predefined Color'),
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
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'custom_heading_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Custom Color'),
                        'depends' => array(
                            array('title', '!=', ''),
                            array('heading_color', '=', '')
                        ),
                    ),
                    'title_highlight_color' => array(
                        'type' => 'color',
                        'title' => JText::_('Highlight Color'),
                        'depends' => array('use_highlight' => 1),
                    ),
                    'shapes_width' => array(
                        'type' => 'slider',
                        'title' => JText::_('Shapes Width'),
                        'std' => '9',
                        'max' => 100,
                        'depends' => array('use_highlight' => 1),
                    ),
                    'shapes_color' => array(
                        'type' => 'color',
                        'title' => JText::_('Shapes Color'),
                        'depends' => array('use_highlight' => 1),
                    ),
                    'text_transform' => array(
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

                    'text_background' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Text Background'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'text_background_image' => array(
                        'type' => 'media',
                        'title' => JText::_('Image'),
                        'std' => '',
                        'depends' => array(array('text_background', '=', 1)),
                    ),
                    'text_background_image_size' => array(
                        'type' => 'select',
                        'title' => JText::_('Image Size'),
                        'desc' => JText::_('Determine whether the image will fit the section dimensions by clipping it or by filling the empty areas with the background color.'),
                        'values' => array(
                            '' => JText::_('Auto'),
                            'uk-background-cover' => JText::_('Cover'),
                            'uk-background-contain' => JText::_('Contain'),
                        ),
                        'std' => '',
                        'depends' => array(array('text_background', '=', 1)),
                    ),
                    'text_background_image_effect' => array(
                        'type' => 'select',
                        'title' => JText::_('Image Effect'),
                        'desc' => JText::_('Add a parallax effect or fix the background with regard to the viewport while scrolling.'),
                        'values' => array(
                            '' => JText::_('None'),
                            'parallax' => JText::_('Parallax'),
                            'fixed' => JText::_('Fixed'),
                        ),
                        'std' => 'parallax',
                        'depends' => array(array('text_background', '=', 1)),
                    ),
                    'text_background_horizontal_start' => array(
                        'type' => 'slider',
                        'title' => JText::_('Horizontal Start'),
                        'min' => -600,
                        'max' => 600,
                        'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
                        'depends' => array(
                            array('text_background', '=', 1),
                            array('text_background_image_effect', '=', 'parallax')
                        ),
                    ),
                    'text_background_horizontal_end' => array(
                        'type' => 'slider',
                        'title' => JText::_('Horizontal End'),
                        'min' => -600,
                        'max' => 600,
                        'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
                        'depends' => array(
                            array('text_background', '=', 1),
                            array('text_background_image_effect', '=', 'parallax')
                        ),
                    ),
                    'text_background_vertical_start' => array(
                        'type' => 'slider',
                        'title' => JText::_('Vertical Start'),
                        'min' => -600,
                        'max' => 600,
                        'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
                        'depends' => array(
                            array('text_background', '=', 1),
                            array('text_background_image_effect', '=', 'parallax')
                        ),
                    ),
                    'text_background_vertical_end' => array(
                        'type' => 'slider',
                        'title' => JText::_('Vertical End'),
                        'min' => -600,
                        'max' => 600,
                        'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
                        'depends' => array(
                            array('text_background', '=', 1),
                            array('text_background_image_effect', '=', 'parallax')
                        ),
                    ),
                    'text_background_easing' => array(
                        'type' => 'slider',
                        'title' => JText::_('Easing'),
                        'min' => -200,
                        'max' => 200,
                        'desc' => JText::_('Set the animation easing. Zero transitions at an even speed, a positive value starts off quickly while a negative value starts off slowly.'),
                        'depends' => array(
                            array('text_background', '=', 1),
                            array('text_background_image_effect', '=', 'parallax')
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