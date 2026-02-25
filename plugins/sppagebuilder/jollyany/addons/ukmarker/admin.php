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
            'addon_name' => 'ukmarker',
            'title' => Text::_('UK Marker'),
            'desc' => Text::_('Create a marker icon/image that can be displayed on top of images.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukmarker/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => '',
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
                        )
                    ),
                    'alt_text' => array(
                        'type' => 'text',
                        'title' => Text::_('Image Alt'),
                        'desc' => Text::_('Enter the image\'s alt attribute.'),
                        'std' => 'Image Alt',
                        'depends' => array(
                            array('image', '!=', ''),
                        ),
                    ),

                    // Repeatable Item
                    'ui_list_marker_item' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'left_space' => array(
                                'type' => 'slider',
                                'title' => Text::_('Left'),
                                'min' => 0,
                                'max' => 100,
                                'desc' => Text::_('Enter the horizontal position of the marker in percent'),
                                'std' => '50',
                            ),
                            'top_space' => array(
                                'type' => 'slider',
                                'title' => Text::_('Top'),
                                'min' => 0,
                                'max' => 100,
                                'desc' => Text::_('Enter the vertical position of the marker in percent.'),
                                'std' => '50',
                            ),
                            'use_animation' => array(
                                'type' => 'checkbox',
                                'title' => Text::_('Use Animation'),
                                'values' => array(
                                    1 => Text::_('COM_SPPAGEBUILDER_YES'),
                                    0 => Text::_('COM_SPPAGEBUILDER_NO'),
                                ),
                                'std' => 0,
                            ),
                            'delay' => array(
                                'type' => 'slider',
                                'title' => Text::_('Delay'),
                                'placeholder' => '10',
                                'max' => 5000,
                                'depends' => array(
                                    array('use_animation', '=', 1),
                                ),
                            ),
                            'repeat_animation' => array(
                                'type' => 'checkbox',
                                'title' => Text::_('Repeat Animation'),
                                'values' => array(
                                    1 => Text::_('COM_SPPAGEBUILDER_YES'),
                                    0 => Text::_('COM_SPPAGEBUILDER_NO'),
                                ),
                                'std' => 0,
                                'depends' => array(
                                    array('use_animation', '=', 1),
                                ),
                            ),
                            'marker_type' => array(
                                'type' => 'select',
                                'title' => Text::_('Make Type'),
                                'desc' => Text::_('Select a different type for this item.'),
                                'values' => array(
                                    '' => Text::_('Point'),
                                    'image' => Text::_('Image'),
                                ),
                                'std' => '',
                            ),
                            'marker_point_image' => array(
                                'type' => 'media',
                                'title' => Text::_('Select Point Image:'),
                                'show_input' => true,
                                'std' => array(
                                    'src' => 'https://sppagebuilder.com/addons/image/image1.jpg',
                                    'height' => '',
                                    'width' => '',
                                ),
                                'depends' => array(
                                    array('marker_type', '=', 'image'),
                                ),
                            ),
                            'marker_point_image_width' => array(
                                'type' => 'slider',
                                'title' => Text::_('Point Image Size'),
                                'placeholder' => '10',
                                'max' => 5000,
                                'depends' => array(
                                    array('marker_type', '=', 'image'),
                                ),
                            ),
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                            ),
                            'marker_meta' => array(
                                'type' => 'text',
                                'title' => Text::_('Meta'),
                            ),
                            'marker_content' => array(
                                'type' => 'editor',
                                'title' => Text::_('Content'),
                                'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                            ),
                            'marker_image' => array(
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
                            'marker_image_alt_text' => array(
                                'type' => 'text',
                                'title' => Text::_('Image Alt'),
                                'placeholder' => 'Beautiful Image',
                                'depends' => array(
                                    array('marker_image', '!=', ''),
                                ),
                            ),
                            'marker_position' => array(
                                'type' => 'select',
                                'title' => Text::_('Position'),
                                'desc' => Text::_('Select a different position for this item.'),
                                'values' => array(
                                    '' => Text::_('None'),
                                    'top-center' => Text::_('Top'),
                                    'bottom-center' => Text::_('Bottom'),
                                    'left-center' => Text::_('Left'),
                                    'right-center' => Text::_('Right'),
                                ),
                                'std' => '',
                            ),
                            'link' => array(
                                'type' => 'media',
                                'format' => 'attachment',
                                'title' => Text::_('Link'),
                                'desc' => Text::_('Enter or pick a link, an image or a video file.'),
                                'placeholder' => 'http://',
                                'hide_preview' => true,
                            ),
                            'button_title' => array(
                                'type' => 'text',
                                'title' => Text::_('Link Text'),
                                'std' => 'Read more',
                                'depends' => array(array('link', '!=', '')),
                            ),
                        ),
                    ),
                    'separator_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Popover'),
                    ),
                    'popover_mode' => array(
                        'type' => 'select',
                        'title' => Text::_('Mode'),
                        'desc' => Text::_('Display the popover on click or hover'),
                        'values' => array(
                            'hover' => Text::_('Hover'),
                            'click' => Text::_('Click'),
                        ),
                        'std' => 'hover'
                    ),
                    'popover_position' => array(
                        'type' => 'select',
                        'title' => Text::_('Position'),
                        'desc' => Text::_('Select the popover\'s alignment to its marker. If the popover doesn\'t fit its container, it will flip automatically.'),
                        'values' => array(
                            'top-center' => Text::_('Top'),
                            'bottom-center' => Text::_('Bottom'),
                            'left-center' => Text::_('Left'),
                            'right-center' => Text::_('Right'),
                        ),
                        'std' => 'top-center',
                    ),
                    'popover_width' => array(
                        'type' => 'slider',
                        'title' => Text::_('Width'),
                        'min' => 0,
                        'max' => 1000,
                        'desc' => Text::_('Enter a width for the popover in pixel'),
                        'placeholder' => '300',
                    ),
                    'popover_animation' => array(
                        'type' => 'select',
                        'title' => Text::_('Animation'),
                        'desc' => Text::_('Apply the animations effect to the dropdown on hover/click'),
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
                    'card_styles' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a card style.'),
                        'values' => array(
                            'default' => Text::_('Default'),
                            'primary' => Text::_('Primary'),
                            'secondary' => Text::_('Secondary'),
                        ),
                        'std' => 'default',
                    ),
                    'panel_link' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Link Card'),
                        'desc' => Text::_('Link the whole card if a link exists.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'card_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Padding'),
                        'desc' => Text::_('Define the card\'s size by selecting the padding between the card and its content.'),
                        'values' => array(
                            'uk-card-small' => Text::_('Small'),
                            '' => Text::_('Default'),
                            'uk-card-large' => Text::_('Large'),
                        ),
                        'std' => 'uk-card-small',
                    ),
                    'marker_background' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'std' => '#222222',
                    ),
                    'marker_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Marker Color'),
                        'std' => '#ffffff',
                    ),
                    'mobile_switcher' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable Mobile Switcher'),
                        'desc' => Text::_('Use switcher mode on mobile devices to navigate between maker items.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 1,
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
                    'heading_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Title styles differ in font-size but may also come with a predefined color, size and font.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'heading-small' => Text::_('Small'),
                            'h1' => Text::_('H1'),
                            'h2' => Text::_('H2'),
                            'h3' => Text::_('H3'),
                            'h4' => Text::_('H4'),
                            'h5' => Text::_('H5'),
                            'h6' => Text::_('H6'),
                        ),
                        'std' => '',
                    ),
                    'link_title' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Link Title'),
                        'desc' => Text::_('Link the title if a link exists.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'title_hover_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Hover Style'),
                        'desc' => Text::_('Set the hover style for a linked title.'),
                        'values' => array(
                            'reset' => Text::_('None'),
                            'heading' => Text::_('Heading Link'),
                            '' => Text::_('Default Link'),
                        ),
                        'std' => 'reset',
                        'depends' => array(
                            array('link_title', '=', 1)
                        ),
                    ),
                    'title_decoration' => array(
                        'type' => 'select',
                        'title' => Text::_('Decoration'),
                        'desc' => Text::_('Decorate the title with a divider, bullet or a line that is vertically centered to the heading.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-heading-divider' => Text::_('Divider'),
                            'uk-heading-bullet' => Text::_('Bullet'),
                            'uk-heading-line' => Text::_('Line'),
                        ),
                        'std' => '',
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
                    'heading_selector' => array(
                        'type' => 'select',
                        'title' => Text::_('HTML Element'),
                        'desc' => Text::_('Choose one of the six heading elements to fit your semantic structure.'),
                        'values' => array(
                            'h1' => Text::_('h1'),
                            'h2' => Text::_('h2'),
                            'h3' => Text::_('h3'),
                            'h4' => Text::_('h4'),
                            'h5' => Text::_('h5'),
                            'h6' => Text::_('h6'),
                            'div' => Text::_('div'),
                        ),
                        'std' => 'h3',
                    ),

                    'title_margin_top' => array(
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
                    'separator_meta_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Meta'),
                    ),
                    'meta_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.ui-meta { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'meta_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a predefined meta text style, including color, size and font-family.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'text-meta' => Text::_('Meta'),
                            'h1' => Text::_('H1'),
                            'h2' => Text::_('H2'),
                            'h3' => Text::_('H3'),
                            'h4' => Text::_('H4'),
                            'h5' => Text::_('H5'),
                            'h6' => Text::_('H6'),
                        ),
                        'std' => '',
                    ),
                    'meta_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Predefined Color'),
                        'desc' => Text::_('Select the predefined meta text color.'),
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
                    'custom_meta_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Custom Color'),
                        'depends' => array(
                            array('meta_color', '=', '')
                        ),
                    ),
                    'meta_text_transform' => array(
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
                    'meta_element' => array(
                        'type' => 'select',
                        'title' => Text::_('HTML Element'),
                        'desc' => Text::_('Choose one of the HTML elements to fit your semantic structure.'),
                        'values' => array(
                            'h1' => Text::_('h1'),
                            'h2' => Text::_('h2'),
                            'h3' => Text::_('h3'),
                            'h4' => Text::_('h4'),
                            'h5' => Text::_('h5'),
                            'h6' => Text::_('h6'),
                            'div' => Text::_('div'),
                        ),
                        'std' => 'div',
                    ),
                    'meta_alignment' => array(
                        'type' => 'select',
                        'title' => Text::_('Alignment'),
                        'desc' => Text::_('Align the meta text above or below the title.'),
                        'values' => array(
                            'top' => Text::_('Above Title'),
                            '' => Text::_('Below Title'),
                            'above' => Text::_('Above Content'),
                            'content' => Text::_('Below Content'),
                        ),
                        'std' => '',
                    ),
                    'meta_margin_top' => array(
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
                    'separator_content_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Content'),
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
                    'content_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a predefined text style, including color, size and font-family.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'text-lead' => Text::_('Lead'),
                            'text-meta' => Text::_('Meta'),
                        ),
                        'std' => '',
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
                    'separator_image_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Image'),
                    ),
                    'image_width' => array(
                        'type' => 'number',
                        'title' => Text::_('Width'),
                        'placeholder' => 'auto',
                    ),
                    'image_height' => array(
                        'type' => 'number',
                        'title' => Text::_('Height'),
                        'placeholder' => 'auto',
                    ),
                    'image_padding' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Align image without padding'),
                        'desc' => Text::_('Attach the image to the drop\'s edge.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 1,
                    ),
                    'image_border' => array(
                        'type' => 'select',
                        'title' => Text::_('Border'),
                        'desc' => Text::_('Select the image\'s border style.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'rounded' => Text::_('Rounded'),
                            'circle' => Text::_('Circle'),
                            'pill' => Text::_('Pill'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('image_padding', '=', 0),
                        )
                    ),
                    'image_link' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Link image'),
                        'desc' => Text::_('Link the image if a link exists.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'image_svg_inline' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Inline SVG'),
                        'desc' => Text::_('Inject SVG images into the page markup, so that they can easily be styled with CSS.'),
                        'std' => 0,
                    ),
                    'image_svg_color' => array(
                        'type' => 'select',
                        'title' => Text::_('SVG Color'),
                        'desc' => Text::_('Select the SVG color. It will only apply to supported elements defined in the SVG.'),
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
                        'depends' => array(
                            array('image_svg_inline', '=', 1)
                        ),
                    ),
                    'image_panel' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Blend Mode Settings'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'media_background' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'desc' => Text::_('Use the background color in combination with blend modes.'),
                        'depends' => array(
                            array('image_panel', '=', 1)
                        ),
                    ),
                    'media_blend_mode' => array(
                        'type' => 'select',
                        'title' => Text::_('Blend modes'),
                        'desc' => Text::_('Determine how the image will blend with the background color.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'multiply' => Text::_('Multiply'),
                            'screen' => Text::_('Screen'),
                            'overlay' => Text::_('Overlay'),
                            'darken' => Text::_('Darken'),
                            'lighten' => Text::_('Lighten'),
                            'color-dodge' => Text::_('Color Dodge'),
                            'color-burn' => Text::_('Color Burn'),
                            'hard-light' => Text::_('Hard Light'),
                            'soft-light' => Text::_('Soft Light'),
                            'difference' => Text::_('Difference'),
                            'exclusion' => Text::_('Exclusion'),
                            'hue' => Text::_('Hue'),
                            'color' => Text::_('Color'),
                            'luminosity' => Text::_('Luminosity'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('image_panel', '=', 1),
                            array('media_background', '!=', '')
                        ),
                    ),
                    'media_overlay' => array(
                        'type' => 'color',
                        'title' => Text::_('Overlay Color'),
                        'desc' => Text::_('Set an additional transparent overlay to soften the image.'),
                        'depends' => array(
                            array('image_panel', '=', 1)
                        ),
                    ),
                    'separator_button_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Link'),
                    ),
                    'all_button_title' => array(
                        'type' => 'text',
                        'title' => Text::_('Text'),
                        'std' => 'Read more',
                    ),
                    'link_new_tab' => array(
                        'type' => 'select',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
                        'values' => array(
                            '' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                            '_blank' => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                        ),
                    ),
                    'link_button_style' => array(
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
                            array('link_button_style', '=', 'custom'),
                        ),
                    ),
                    'button_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'depends' => array(
                            array('link_button_style', '=', 'custom'),
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
                            array('link_button_style', '=', 'custom'),
                        ),
                    ),
                    'button_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Button Color'),
                        'depends' => array(
                            array('link_button_style', '=', 'custom'),
                        ),
                    ),
                    'button_background_hover' => array(
                        'type' => 'color',
                        'title' => Text::_('Hover Background Color'),
                        'std' => '#0f7ae5',
                        'depends' => array(
                            array('link_button_style', '=', 'custom'),
                        ),
                    ),
                    'button_hover_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Hover Button Color'),
                        'depends' => array(
                            array('link_button_style', '=', 'custom'),
                        ),
                    ),
                    'link_button_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Button Size'),
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