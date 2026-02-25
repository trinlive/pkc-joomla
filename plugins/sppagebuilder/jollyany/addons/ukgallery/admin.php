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
defined('_JEXEC') or die('Restricted access');
use Jollyany\Helper\PageBuilder;
use Joomla\CMS\Language\Text;
if (file_exists(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'jollyany'. DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR .'jollyany' . DIRECTORY_SEPARATOR . 'Helper' . DIRECTORY_SEPARATOR. 'PageBuilder.php')) {
    SpAddonsConfig::addonConfig(
        array(
            'type' => 'repeatable',
            'addon_name' => 'ukgallery',
            'title' => Text::_('UK Gallery'),
            'desc' => Text::_('Create beautiful gallery with Masonry effect for the Grid and the Gallery element. The Masonry effect, as most of you know, allows you to have a gap-free multi-column layout even when grid cells have a different height. '),
            'icon' => JURI::root() . 'plugins/sppagebuilder/jollyany/addons/ukgallery/assets/images/icon.png',
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
                    'uk_gallery_item' => array(
                        'title' => Text::_('Items'),
                        'attr' => array(
                            'title' => array(
                                'type' => 'text',
                                'title' => Text::_('Title'),
                                'std' => 'Item',
                            ),
                            'media_item' => array(
                                'type' => 'media',
                                'title' => Text::_('Image'),
                                'placeholder' => 'http://www.example.com/my-photo.jpg',
                            ),
                            'media_item_thumb' => array(
                                'type' => 'media',
                                'title' => Text::_('Thumbnail'),
                                'placeholder' => 'http://www.example.com/my-photo.jpg',
                            ),
                            'image_alt' => array(
                                'type' => 'text',
                                'title' => Text::_('Image Alt'),
                                'std' => 'Image Alt',
                            ),
                            'meta' => array(
                                'type' => 'text',
                                'title' => Text::_('Meta'),
                            ),
                            'content' => array(
                                'type' => 'editor',
                                'title' => Text::_('Content'),
                            ),
                            'tag_name' => array(
                                'type' => 'text',
                                'title' => Text::_('Tag Name'),
                                'desc' => Text::_('Enter a comma-separated list of tags, for example: blue, white, black.'),
                                'std' => 'Home',
                            ),
                            'title_link' => array(
                                'type' => 'media',
                                'format' => 'attachment',
                                'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                                'placeholder' => 'http://www.example.com',
                                'std' => '',
                                'hide_preview' => true,
                            ),
                            'media_item_hover' => array(
                                'type' => 'media',
                                'title' => Text::_('Hover Image'),
                                'desc' => Text::_('Select an optional image that appears on hover.'),
                                'placeholder' => 'http://www.example.com/my-photo.jpg',
                            ),
                            'item_color' => array(
                                'type' => 'select',
                                'title' => Text::_('Text Color'),
                                'desc' => Text::_('Set a different text color for this item.'),
                                'values' => array(
                                    '' => Text::_('None'),
                                    'light' => Text::_('Light'),
                                    'dark' => Text::_('Dark'),
                                ),
                                'std' => '',
                            ),
                        ),
                    ),

                    'separator_gallery_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Gallery'),
                    ),
                    'masonry' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable masonry effect'),
                        'desc' => Text::_('The masonry effect creates a layout free of gap even if grid cell have different height.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'grid_parallax' => array(
                        'type' => 'slider',
                        'title' => Text::_('Parallax'),
                        'desc' => Text::_('To move single columns of a grid at different speeds while scrolling'),
                        'min' => 0,
                        'max' => 600,
                    ),
                    'grid_column_gap' => array(
                        'type' => 'select',
                        'title' => Text::_('Column Gap'),
                        'desc' => Text::_('Set the size of the gap between the grid columns.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            '' => Text::_('Default'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('None'),
                        ),
                        'std' => '',
                    ),
                    'grid_row_gap' => array(
                        'type' => 'select',
                        'title' => Text::_('Row Gap'),
                        'desc' => Text::_('Set the size of the gap between the grid rows.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            '' => Text::_('Default'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('None'),
                        ),
                        'std' => '',
                    ),
                    'divider' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Show dividers'),
                        'desc' => Text::_('Select this option to separate grid cells with lines.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                        'depends' => array(
                            array('grid_column_gap', '!=', 'collapse'),
                            array('grid_row_gap', '!=', 'collapse'),
                        ),
                    ),
                    'grid_column_align' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Center columns'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'grid_row_align' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Center rows'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'separator_grid_column_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Columns'),
                    ),
                    'phone_portrait' => array(
                        'type' => 'select',
                        'title' => Text::_('Phone Portrait'),
                        'desc' => Text::_('Set the number of grid columns for each breakpoint. Inherit refers to the number of columns on the next smaller screen size.'),
                        'values' => array(
                            '1' => Text::_('1 Columns'),
                            '2' => Text::_('2 Columns'),
                            '3' => Text::_('3 Columns'),
                            '4' => Text::_('4 Columns'),
                            '5' => Text::_('5 Columns'),
                            '6' => Text::_('6 Columns'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '1',
                    ),
                    'phone_landscape' => array(
                        'type' => 'select',
                        'title' => Text::_('Phone Landscape'),
                        'desc' => Text::_('Set the number of grid columns for each breakpoint. Inherit refers to the number of columns on the next smaller screen size.'),
                        'values' => array(
                            '' => Text::_('Inherit'),
                            '1' => Text::_('1 Columns'),
                            '2' => Text::_('2 Columns'),
                            '3' => Text::_('3 Columns'),
                            '4' => Text::_('4 Columns'),
                            '5' => Text::_('5 Columns'),
                            '6' => Text::_('6 Columns'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '',
                    ),
                    'tablet_landscape' => array(
                        'type' => 'select',
                        'title' => Text::_('Tablet Landscape'),
                        'desc' => Text::_('Set the number of grid columns for each breakpoint. Inherit refers to the number of columns on the next smaller screen size.'),
                        'values' => array(
                            '' => Text::_('Inherit'),
                            '1' => Text::_('1 Columns'),
                            '2' => Text::_('2 Columns'),
                            '3' => Text::_('3 Columns'),
                            '4' => Text::_('4 Columns'),
                            '5' => Text::_('5 Columns'),
                            '6' => Text::_('6 Columns'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '3',
                    ),
                    'desktop' => array(
                        'type' => 'select',
                        'title' => Text::_('Desktop'),
                        'desc' => Text::_('Set the number of grid columns for each breakpoint. Inherit refers to the number of columns on the next smaller screen size.'),
                        'values' => array(
                            '' => Text::_('Inherit'),
                            '1' => Text::_('1 Columns'),
                            '2' => Text::_('2 Columns'),
                            '3' => Text::_('3 Columns'),
                            '4' => Text::_('4 Columns'),
                            '5' => Text::_('5 Columns'),
                            '6' => Text::_('6 Columns'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '',
                    ),
                    'large_screens' => array(
                        'type' => 'select',
                        'title' => Text::_('Large Screens'),
                        'desc' => Text::_('Set the number of grid columns for each breakpoint. Inherit refers to the number of columns on the next smaller screen size.'),
                        'values' => array(
                            '' => Text::_('Inherit'),
                            '1' => Text::_('1 Columns'),
                            '2' => Text::_('2 Columns'),
                            '3' => Text::_('3 Columns'),
                            '4' => Text::_('4 Columns'),
                            '5' => Text::_('5 Columns'),
                            '6' => Text::_('6 Columns'),
                            'auto' => Text::_('Auto'),
                        ),
                        'std' => '',
                    ),
                    'separator_filter_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Filter'),
                    ),
                    'enable_filter' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable filter navigation'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 1,
                    ),
                    'filter_reverse' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Reverse order'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                        'depends' => array('enable_filter' => 1),
                    ),
                    'filter_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select the filter style. The pill and divider styles are only available for horizontal subnavs'),
                        'values' => array(
                            'tab' => Text::_('Tabs'),
                            'subnav-pill' => Text::_('Subnav Pill (Nav)'),
                            'subnav-divider' => Text::_('Subnav Divider (Nav)'),
                            'subnav' => Text::_('Subnav (Nav)'),
                        ),
                        'std' => 'tab',
                        'depends' => array('enable_filter' => 1),
                    ),
                    'all_control' => array(
                        'type' => 'text',
                        'std' => 'All',
                        'title' => Text::_('Replace All tag'),
                        'desc' => Text::_('Add your text to replace the \'All\' tag title'),
                        'depends' => array('enable_filter' => 1),
                    ),
                    'positions' => array(
                        'type' => 'select',
                        'title' => Text::_('Position'),
                        'desc' => Text::_('Position the navigation at the top, bottom, left or right. A larger style can be applied to left and right navigations.'),
                        'values' => array(
                            'top' => Text::_('Top'),
                            'left' => Text::_('Left'),
                            'right' => Text::_('Right'),
                        ),
                        'std' => 'top',
                        'depends' => array('enable_filter' => 1),
                    ),
                    'filter_style_primary' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Primary navigation'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                        'depends' => array(
                            array('enable_filter', '=', 1),
                            array('positions', '!=', 'top'),
                            array('filter_style', '=', 'subnav'),
                        ),
                    ),
                    'filter_alignment' => array(
                        'type' => 'select',
                        'title' => Text::_('Alignment'),
                        'desc' => Text::_('Align the navigation\'s items.'),
                        'values' => array(
                            'left' => Text::_('Left'),
                            'center' => Text::_('Center'),
                            'right' => Text::_('Right'),
                            'justify' => Text::_('Justify'),
                        ),
                        'std' => 'left',
                        'depends' => array(
                            array('positions', '!=', 'left'),
                            array('positions', '!=', 'right'),
                            array('enable_filter', '=', 1),
                        ),
                    ),
                    'filter_margin' => array(
                        'type' => 'select',
                        'title' => Text::_('Margin'),
                        'desc' => Text::_('Set the vertical margin.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            '' => Text::_('Default'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('positions', '=', 'top'),
                            array('enable_filter', '=', 1),
                        ),
                    ),
                    'grid_width' => array(
                        'type' => 'select',
                        'title' => Text::_('Grid Width'),
                        'desc' => Text::_('Define the width of the navigation. Choose between percent and fixed widths or expand columns to the width of their content'),
                        'values' => array(
                            'auto' => Text::_('Auto'),
                            '1-2' => Text::_('50%'),
                            '1-3' => Text::_('33%'),
                            '1-4' => Text::_('25%'),
                            '1-5' => Text::_('20%'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => 'auto',
                        'depends' => array(
                            array('positions', '!=', 'top'),
                            array('enable_filter', '=', 1),
                        ),
                    ),
                    'filter_grid_column_gap' => array(
                        'type' => 'select',
                        'title' => Text::_('Column Gap'),
                        'desc' => Text::_('Set the size of the gap between between the filter navigation and the content.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            '' => Text::_('Default'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('None'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('positions', '!=', 'top'),
                            array('enable_filter', '=', 1),
                        ),
                    ),
                    'filter_grid_row_gap' => array(
                        'type' => 'select',
                        'title' => Text::_('Row Gap'),
                        'desc' => Text::_('Set the size of the gap if the grid items stack.'),
                        'values' => array(
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            '' => Text::_('Default'),
                            'large' => Text::_('Large'),
                            'collapse' => Text::_('None'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('positions', '!=', 'top'),
                            array('enable_filter', '=', 1),
                        ),
                    ),
                    'grid_breakpoint' => array(
                        'type' => 'select',
                        'title' => Text::_('Grid Breakpoint'),
                        'desc' => Text::_('Set the breakpoint from which the navigation and content will stack.'),
                        'values' => array(
                            's' => Text::_('Small (Phone Landscape)'),
                            'm' => Text::_('Medium (Tablet Landscape)'),
                            'l' => Text::_('Large (Desktop)'),
                            'xl' => Text::_('X-Large (Large Screens)'),
                        ),
                        'std' => 'm',
                        'depends' => array(
                            array('positions', '!=', 'top'),
                            array('enable_filter', '=', 1),
                        ),
                    ),
                    'switcher_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.tz-filter>*>a { font-family: {{ VALUE }}; }',
                        )
                    ),
                    'separator_lightbox_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Lightbox'),
                    ),
                    'lightbox' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Enable lightbox gallery'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'show_lightbox_title' => array(
                        'type' => 'select',
                        'title' => Text::_('Show Title'),
                        'desc' => Text::_('Display the title inside the overlay, as the lightbox caption or both.'),
                        'values' => array(
                            '' => Text::_('Overlay + Lightbox'),
                            'title-ovl' => Text::_('Overlay only'),
                            'title-lightbox' => Text::_('Lightbox only'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('lightbox', '=', 1),
                        ),
                    ),
                    'show_lightbox_content' => array(
                        'type' => 'select',
                        'title' => Text::_('Show Content'),
                        'desc' => Text::_('Display the content inside the overlay, as the lightbox caption or both.'),
                        'values' => array(
                            '' => Text::_('Overlay + Lightbox'),
                            'content-ovl' => Text::_('Overlay only'),
                            'content-lightbox' => Text::_('Lightbox only'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('lightbox', '=', 1),
                        ),
                    ),
                    'separator_item_width_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Item'),
                    ),
                    'item_maxwidth' => array(
                        'type' => 'select',
                        'title' => Text::_('Max Width'),
                        'desc' => Text::_('Set the maximum width.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                            '2xlarge' => Text::_('2X-Large'),
                        ),
                        'std' => '',
                    ),
                    'separator_overlay_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Overlay'),
                    ),
                    'overlay_mode' => array(
                        'type' => 'select',
                        'title' => Text::_('Mode'),
                        'desc' => Text::_('When using cover mode, you need to set the text color manually'),
                        'values' => array(
                            'cover' => Text::_('Cover'),
                            'caption' => Text::_('Caption'),
                            'icon' => Text::_('Icon'),
                        ),
                        'std' => 'cover',
                    ),
                    'overlay_on_hover' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Display overlay on hover'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 1,
                    ),
                    'icon_text_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Icon color'),
                        'desc' => Text::_('Set light or dark color mode for icon.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'light' => Text::_('Light'),
                            'dark' => Text::_('Dark'),
                        ),
                        'std' => 'light',
                        'depends' => array(
                            array('overlay_mode', '=', 'icon'),
                        ),
                    ),
                    'overlay_transition_background' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Animate background only'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                            array('overlay_mode', '=', 'cover'),
                        ),
                    ),

                    'overlay_styles' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a style for the overlay.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'overlay-default' => Text::_('Overlay Default'),
                            'overlay-primary' => Text::_('Overlay Primary'),
                            'tile-default' => Text::_('Tile Default'),
                            'tile-muted' => Text::_('Tile Muted'),
                            'tile-primary' => Text::_('Tile Primary'),
                            'tile-secondary' => Text::_('Tile Secondary'),
                            'overlay-custom' => Text::_('Custom'),
                        ),
                        'std' => 'overlay-primary',
                    ),
                    'overlay_background' => array(
                        'type' => 'color',
                        'title' => Text::_('Background Color'),
                        'std' => '#ffd49b',
                        'depends' => array(
                            array('overlay_styles', '=', 'overlay-custom'),
                        ),
                    ),
                    'overlay_text_color' => array(
                        'type' => 'select',
                        'title' => Text::_('Text color'),
                        'desc' => Text::_('Set light or dark color mode for text, buttons and controls'),
                        'values' => array(
                            '' => Text::_('None'),
                            'uk-light' => Text::_('Light'),
                            'uk-dark' => Text::_('Dark'),
                        ),
                        'std' => 'uk-light',
                    ),
                    'text_color_hover' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Inverse the text color on hover'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 1,
                        'depends' => array(
                            array('overlay_mode', '=', 'cover'),
                            array('overlay_on_hover', '=', 1),
                            array('overlay_transition_background', '=', 1),
                        ),
                    ),
                    'overlay_padding' => array(
                        'type' => 'select',
                        'title' => Text::_('Padding'),
                        'desc' => Text::_('Set the padding between the overlay and its content.'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'large' => Text::_('Large'),
                            'remove' => Text::_('None'),
                        ),
                        'std' => '',
                    ),
                    'overlay_positions' => array(
                        'type' => 'select',
                        'title' => Text::_('Overlay Positions'),
                        'desc' => Text::_('A collection of utility classes to position content.'),
                        'values' => array(
                            'top' => Text::_('Top'),
                            'bottom' => Text::_('Bottom'),
                            'left' => Text::_('Left'),
                            'right' => Text::_('Right'),
                            'top-left' => Text::_('Top Left'),
                            'top-center' => Text::_('Top Center'),
                            'top-right' => Text::_('Top Right'),
                            'bottom-left' => Text::_('Bottom Left'),
                            'bottom-center' => Text::_('Bottom Center'),
                            'bottom-right' => Text::_('Bottom Right'),
                            'center' => Text::_('Center'),
                            'center-left' => Text::_('Center Left'),
                            'center-right' => Text::_('Center Right'),
                        ),
                        'std' => 'center',
                    ),
                    'overlay_margin' => array(
                        'type' => 'select',
                        'title' => Text::_('Margin'),
                        'desc' => Text::_('Apply a margin between the overlay and the image container.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => '',
                        'depends' => array(
                            array('overlay_styles', '!=', ''),
                        )
                    ),
                    'overlay_maxwidth' => array(
                        'type' => 'select',
                        'title' => Text::_('Max Width'),
                        'desc' => Text::_('Set the maximum content width.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                        ),
                        'std' => '',
                    ),
                    'overlay_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select a transition for the overlay when it appears on hover.'),
                        'values' => array(
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
                        'std' => 'fade',
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                        )
                    ),
                    'icon_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select a transition for the icon when it appears on hover.'),
                        'values' => array(
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
                        'std' => 'fade',
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                            array('overlay_mode', '=', 'icon'),
                        )
                    ),
                    'overlay_link' => array(
                        'type' => 'checkbox',
                        'title' => Text::_('Link Overlay'),
                        'desc' => Text::_('Link the whole overlay if a link exists.'),
                        'values' => array(
                            1 => Text::_('JYES'),
                            0 => Text::_('JNO'),
                        ),
                        'std' => 0,
                    ),
                    'separator_image_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Image'),
                    ),
                    'image_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select an image transition. If the hover image is set, the transition takes place between the two images. If <i>None</i> is selected, the hover image fades in.'),
                        'values' => array(
                            '' => Text::_('None (Fade if hover image)'),
                            'scale-up' => Text::_('Scale Up'),
                            'scale-down' => Text::_('Scale Down'),
                        ),
                        'std' => '',
                    ),
                    'box_shadow' => array(
                        'type' => 'select',
                        'title' => Text::_('Box Shadow'),
                        'desc' => Text::_('Select the image\'s box shadow size.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                        ),
                        'std' => '',
                    ),
                    'hover_box_shadow' => array(
                        'type' => 'select',
                        'title' => Text::_('Hover Box Shadow'),
                        'desc' => Text::_('Select the image\'s box shadow size on hover.'),
                        'values' => array(
                            '' => Text::_('None'),
                            'small' => Text::_('Small'),
                            'medium' => Text::_('Medium'),
                            'large' => Text::_('Large'),
                            'xlarge' => Text::_('X-Large'),
                        ),
                        'std' => '',
                    ),
                    'thumb_width' => array(
                        'type' => 'slider',
                        'title' => Text::_('Thumbnail Width'),
                        'placeholder' => 343,
                        'std' => '',
                        'max' => 900,
                    ),
                    'thumb_height' => array(
                        'type' => 'slider',
                        'title' => Text::_('Thumbnail Height'),
                        'placeholder' => 214,
                        'std' => '',
                        'max' => 900,
                    ),
                    'separator_title_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Title'),
                    ),
                    'title_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select a transition for the title when the overlay appears on hover.'),
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
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                            array('overlay_mode', '!=', 'icon'),
                        )
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
                        'desc' => Text::_('Decorate the title with a divider, bullet or a line that is vertically centered to the title'),
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
                    'meta_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select a transition for the meta text when the overlay appears on hover.'),
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
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                            array('overlay_mode', '!=', 'icon'),
                        )
                    ),

                    'meta_style' => array(
                        'type' => 'select',
                        'title' => Text::_('Style'),
                        'desc' => Text::_('Select a predefined meta text style, including color, size and font-family'),
                        'values' => array(
                            '' => Text::_('None'),
                            'text-meta' => Text::_('Meta'),
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
                        'std' => '',
                    ),
                    'meta_font_family' => array(
                        'type' => 'fonts',
                        'title' => Text::_('Font Family'),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.uk-meta { font-family: {{ VALUE }}; }',
                        )
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
                    'meta_alignment' => array(
                        'type' => 'select',
                        'title' => Text::_('Alignment'),
                        'desc' => Text::_('Align the meta text above or below the title.'),
                        'values' => array(
                            'top' => Text::_('Above Title'),
                            '' => Text::_('Below Title'),
                            'content' => Text::_('Below Content'),
                        ),
                        'std' => '',
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
                    'content_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select a transition for the content when the overlay appears on hover.'),
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
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                            array('overlay_mode', '!=', 'icon'),
                        )
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
                            'css' => '.uk-content { font-family: {{ VALUE }}; }',
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
                    'separator_link_style_options' => array(
                        'type' => 'separator',
                        'title' => Text::_('Link'),
                    ),
                    'button_title' => array(
                        'type' => 'text',
                        'title' => Text::_('Text'),
                        'placeholder' => 'Read more',
                        'std' => 'Read More',
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
                    'button_transition' => array(
                        'type' => 'select',
                        'title' => Text::_('Transition'),
                        'desc' => Text::_('Select a transition for the link when the overlay appears on hover.'),
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
                        'depends' => array(
                            array('overlay_on_hover', '=', 1),
                            array('overlay_mode', '!=', 'icon'),
                        )
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
                        )
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
                    'button_size' => array(
                        'type' => 'select',
                        'title' => Text::_('Button Size'),
                        'values' => array(
                            '' => Text::_('Default'),
                            'small' => Text::_('Small'),
                            'large' => Text::_('Large'),
                        ),
                        'std' => '',
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