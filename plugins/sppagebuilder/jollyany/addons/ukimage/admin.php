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
            'addon_name' => 'ukimage',
            'title' => Text::_('UK Image'),
            'desc' => Text::_('Create an image which comes in different styles.'),
            'icon'=>JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukimage/assets/images/icon.png',
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
                        'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT_DESC'),
                        'show_input' => true,
                        'std'=> array(
                            'src' => 'https://sppagebuilder.com/addons/image/image1.jpg',
                            'height' => '',
                            'width' => '',
                        )
                    ),
                    'image_webp_enable' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable WebP Type'),
                        'desc' => Text::_('Use WebP image type.'),
                        'std' => 0,
                    ),
                    'image_webp' => array(
                        'type' => 'media',
                        'title' => Text::_('Select WebP Image'),
                        'show_input' => true,
                        'depends' => array(array('image_webp_enable', '=', 1)),
                    ),
                    'alt_text' => array(
                        'type' => 'text',
                        'title' => Text::_('Image Alt'),
                        'placeholder' => 'Image Alt',
                        'depends' => array(
                            array('image', '!=', ''),
                        ),
                    ),
                    'separator_image_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Image'),
                    ),
                    'image_border' => array(
                        'type' => 'select',
                        'title' => Text::_('Border'),
                        'desc' => Text::_('Select the image\'s border style.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-border-circle' => Text::_('Circle'),
                            'uk-border-rounded' => Text::_('Rounded'),
                            'uk-border-pill' => Text::_('Pill'),
                        ),
                        'std' => '',
                        'depends' => array(array('image', '!=', ''), array('image_blend_modes', '=', '')),
                    ),
                    'box_shadow' => array(
                        'type' => 'select',
                        'title' => Text::_('Box Shadow'),
                        'desc' => Text::_('Select the image\'s box shadow size.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-box-shadow-small' => Text::_('Small'),
                            'uk-box-shadow-medium' => Text::_('Medium'),
                            'uk-box-shadow-large' => Text::_('Large'),
                            'uk-box-shadow-xlarge' => Text::_('X-Large'),
                        ),
                        'std' => '',
                        'depends' => array(array('image', '!=', '')),
                    ),
                    'hover_box_shadow' => array(
                        'type' => 'select',
                        'title' => Text::_('Hover Box Shadow'),
                        'desc' => Text::_('Select the image\'s box shadow size on hover.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-box-shadow-hover-small' => Text::_('Small'),
                            'uk-box-shadow-hover-medium' => Text::_('Medium'),
                            'uk-box-shadow-hover-large' => Text::_('Large'),
                            'uk-box-shadow-hover-xlarge' => Text::_('X-Large'),
                        ),
                        'std' => '',
                        'depends' => array(array('image', '!=', '')),
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
                    'blend_bg_color' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'std' => 'rgba(39,43,53,0.9)',
                        'desc'=>Text::_('Use the background color in combination with blend modes.'),
                        'depends'=>array(
                            array('image_panel', '=', 1)
                        ),
                    ),
                    'image_blend_modes' => array(
                        'type' => 'select',
                        'title' => Text::_('Blend modes'),
                        'desc' => Text::_('Determine how the image will blend with the background color.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-blend-multiply' => Text::_('Multiply'),
                            'uk-blend-screen' => Text::_('Screen'),
                            'uk-blend-overlay' => Text::_('Overlay'),
                            'uk-blend-darken' => Text::_('Darken'),
                            'uk-blend-lighten' => Text::_('Lighten'),
                            'uk-blend-color-dodge' => Text::_('Color Dodge'),
                            'uk-blend-color-burn' => Text::_('Color Burn'),
                            'uk-blend-hard-light' => Text::_('Hard Light'),
                            'uk-blend-soft-light' => Text::_('Soft Light'),
                            'uk-blend-difference' => Text::_('Difference'),
                            'uk-blend-exclusion' => Text::_('Exclusion'),
                            'uk-blend-hue' => Text::_('Hue'),
                            'uk-blend-color' => Text::_('Color'),
                            'uk-blend-luminosity' => Text::_('Luminosity'),
                        ),
                        'std' => '',
                        'depends'=>array(
                            array('image_panel', '=', 1),
                            array('blend_bg_color', '!=', '')
                        ),
                    ),
                    'media_overlay'=>array(
                        'type'=>'color',
                        'title'=>Text::_('Overlay Color'),
                        'desc'=>Text::_('Set an additional transparent overlay to soften the image.'),
                        'depends'=>array(
                            array('image_panel', '=', 1)
                        ),
                    ),
                    'hover_effect' => array(
                        'type' => 'select',
                        'title' => Text::_('Hover Effect'),
                        'values' => array(
                            '' => Text::_('None'),
                            'light-up' => Text::_('Light Up'),
                            'flash' => Text::_('Flash'),
                        ),
                        'std' => '',
                    ),
                    'image_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select the image\'s transition style.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'scale-up' => Text::_('Scales Up'),
                            'scale-down' => Text::_('Scales Down'),
                            'bob' => Text::_('Bob'),
                            'pulse' => Text::_('Pulse'),
                            'pulse-grow' => Text::_('Pulse Grow'),
                            'pulse-shrink' => Text::_('Pulse Shrink'),
                            'push' => Text::_('Push'),
                            'pop' => Text::_('Pop'),
                            'bounce-in' => Text::_('Bounce-in'),
                            'bounce-out' => Text::_('Bounce-out'),
                            'rotate' => Text::_('Rotate'),
                            'grow-rotate' => Text::_('Grow Rotate'),
                            'float' => Text::_('Float'),
                            'sink' => Text::_('Sink'),
                            'hang' => Text::_('Hang'),
                            'skew' => Text::_('Skew'),
                            'skew-forward' => Text::_('Skew Forward'),
                            'skew-backward' => Text::_('Skew Backward'),
                            'wobble-vertical' => Text::_('Wobble Vertical'),
                            'wobble-horizontal' => Text::_('Wobble Horizontal'),
                            'wobble-to-bottom-right' => Text::_('Wobble to Bottom-Right'),
                            'wobble-to-top-right' => Text::_('Wobble to Top-Right'),
                            'wobble-top' => Text::_('Wobble Top'),
                            'wobble-bottom' => Text::_('Wobble Bottom'),
                            'wobble-skew' => Text::_('Wobble Skew'),
                            'buzz' => Text::_('Buzz'),
                            'buzz-out' => Text::_('Buzz Out'),
                        ),
                        'std' => '',
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
                    'link_type' => array(
                        'type' => 'select',
                        'title' => Text::_('Link Type'),
                        'values' => array(
                            '' => Text::_('None'),
                            'use_link' => Text::_('Link'),
                            'use_modal' => Text::_('Modal'),
                        ),
                        'std' => '',
                        'depends' => array(array('image', '!=', '')),
                    ),

                    'title_link' => array(
                        'type' => 'media',
                        'format' => 'attachment',
                        'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                        'placeholder' => 'http://',
                        'std' => '',
                        'hide_preview' => true,
                        'depends' => array(array('link_type', '!=', '')),
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
                        'depends' => array(array('link_type', '=', 'use_link')),
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