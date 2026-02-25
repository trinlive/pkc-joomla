<?php
/**
 * @package Jollyany
 * @author TemPlaza http://www.templaza.com
 * @copyright Copyright (c) 2010 - 2022 Jollyany
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
            'addon_name' => 'ukimagegroup',
            'title' => Text::_('UK Image Group'),
            'desc' => Text::_('Image Group style based UI Kit.'),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukimagegroup/assets/images/icon.png',
            'category' => 'Jollyany',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => Text::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => '',
                    ),
                    'uk_list_images' => array(
                        'title' => Text::_('Images'),
                        'attr' => array(
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
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
                    'column_xl' => array(
                        'title' => JText::_( 'Large Desktop Columns' ),
                        'type' => 'select',
                        'values'       => array(
                            ''    => JText::_('Auto'),
                            '1'    => JText::_('1 Column'),
                            '2'    => JText::_('2 Columns'),
                            '3'    => JText::_('3 Columns'),
                            '4'    => JText::_('4 Columns'),
                            '5'    => JText::_('5 Columns'),
                            '6'    => JText::_('6 Columns'),
                        ),
                        'std'   => '',
                    ),

                    'column_l' => array(
                        'title' => JText::_( 'Desktop Columns' ),
                        'type' => 'select',
                        'values'       => array(
                            ''    => JText::_('Auto'),
                            '1'    => JText::_('1 Column'),
                            '2'    => JText::_('2 Columns'),
                            '3'    => JText::_('3 Columns'),
                            '4'    => JText::_('4 Columns'),
                            '5'    => JText::_('5 Columns'),
                            '6'    => JText::_('6 Columns'),
                        ),
                        'std'   => '',
                    ),

                    'column_m' => array(
                        'title' => JText::_( 'Laptop Columns' ),
                        'type' => 'select',
                        'values'       => array(
                            ''    => JText::_('Auto'),
                            '1'    => JText::_('1 Column'),
                            '2'    => JText::_('2 Columns'),
                            '3'    => JText::_('3 Columns'),
                            '4'    => JText::_('4 Columns'),
                            '5'    => JText::_('5 Columns'),
                            '6'    => JText::_('6 Columns'),
                        ),
                        'std'   => '',
                    ),

                    'column_s' => array(
                        'title' => JText::_( 'Tablet Columns' ),
                        'type' => 'select',
                        'values'       => array(
                            ''    => JText::_('Auto'),
                            '1'    => JText::_('1 Column'),
                            '2'    => JText::_('2 Columns'),
                            '3'    => JText::_('3 Columns'),
                            '4'    => JText::_('4 Columns'),
                            '5'    => JText::_('5 Columns'),
                            '6'    => JText::_('6 Columns'),
                        ),
                        'std'   => '',
                    ),
                    'column_xs' => array(
                        'title' => JText::_( 'Mobile Columns' ),
                        'type' => 'select',
                        'values'       => array(
                            ''    => JText::_('Auto'),
                            '1'    => JText::_('1 Column'),
                            '2'    => JText::_('2 Columns'),
                            '3'    => JText::_('3 Columns'),
                            '4'    => JText::_('4 Columns'),
                            '5'    => JText::_('5 Columns'),
                            '6'    => JText::_('6 Columns'),
                        ),
                        'std'   => '',
                    ),
                    'enable_divider'=>array(
                        'type'=>'checkbox',
                        'title'=>JText::_('Enable Divider'),
                        'desc'=>JText::_('Display divider in grid'),
                        'values'=>array(
                            1=>JText::_('COM_SPPAGEBUILDER_YES'),
                            0=>JText::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std'=>0,
                    ),
                    'use_slider'=>array(
                        'type'=>'checkbox',
                        'title'=>JText::_('Display Articles as Slider'),
                        'desc'=>JText::_('Display Articles as Carousel Slider'),
                        'values'=>array(
                            1=>JText::_('COM_SPPAGEBUILDER_YES'),
                            0=>JText::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std'=>0,
                    ),
                    'enable_slider_autoplay'=>array(
                        'type'=>'checkbox',
                        'title'=>JText::_('Auto Play'),
                        'desc'=>JText::_('Enable Auto Play'),
                        'values'=>array(
                            1=>JText::_('COM_SPPAGEBUILDER_YES'),
                            0=>JText::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std'=>1,
                        'depends'=>array('use_slider'=>'1')
                    ),

                    'slider_autoplay_interval'=>array(
                        'type'=>'number',
                        'title'=>JText::_('Auto Play Interval'),
                        'desc'=>JText::_('The delay between switching slides in autoplay mode.'),
                        'std'=>'7000',

                        'depends'=>array(
                            array('use_slider', '=', '1'),
                            array('enable_slider_autoplay'=>'1')
                        )
                    ),

                    'infinite_scrolling'=>array(
                        'type'=>'checkbox',
                        'title'=>JText::_('Infinite Scrolling'),
                        'values'=>array(
                            1=>JText::_('COM_SPPAGEBUILDER_YES'),
                            0=>JText::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std'=>1,
                        'depends'=>array('use_slider'=>'1')
                    ),

                    'enable_navigation'=>array(
                        'type'=>'checkbox',
                        'title'=>JText::_('Navigation'),
                        'desc'=>JText::_('Enable Navigation'),
                        'values'=>array(
                            1=>JText::_('COM_SPPAGEBUILDER_YES'),
                            0=>JText::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std'=>1,
                        'depends'=>array('use_slider'=>'1')
                    ),

                    'navigation_position'=>array(
                        'type'=>'select',
                        'title'=>JText::_('Navigation Position'),
                        'values'=>array(
                            ''=>JText::_('Outside'),
                            'inside'=>JText::_('Inside')
                        ),
                        'std'=>'',
                        'depends'=>array(
                            array('use_slider', '=', '1'),
                            array('enable_navigation' , '=', '1')
                        )
                    ),

                    'enable_dotnav'=>array(
                        'type'=>'checkbox',
                        'title'=>JText::_('Dot Navigation'),
                        'desc'=>JText::_('Enable Dot Navigation'),
                        'values'=>array(
                            1=>JText::_('COM_SPPAGEBUILDER_YES'),
                            0=>JText::_('COM_SPPAGEBUILDER_NO'),
                        ),
                        'std'=>1,
                        'depends'=>array('use_slider'=>'1')
                    ),

                    'dotnav_margin'=>array(
                        'type'=>'select',
                        'title'=>JText::_('Dot Navigation Margin'),
                        'values'=>array(
                            'uk-margin-small-top' => JText::_('Small'),
                            'uk-margin-top' => JText::_('Default'),
                            'uk-margin-medium-top' => JText::_('Medium'),
                        ),
                        'std' => 'uk-margin-top',
                        'depends'=>array(
                            array('use_slider', '=', '1'),
                            array('enable_dotnav' , '=', '1')
                        )
                    ),
                ),
                'options' => PageBuilder::general_options(),
            ),
        )
    );
}