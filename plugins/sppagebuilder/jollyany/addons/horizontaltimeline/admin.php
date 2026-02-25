<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2020 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('Restricted access');
SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'horizontaltimeline',
		'title'=>JText::_('Horizontal Timeline'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_DESC'),
		'category'=>'Jollyany',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				
				// Repeatable Items
				'sp_timeline_items'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_REOEATABLE_ITEMS'),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TITLE_DESC'),
							'std'=>'Timeline Item Title',
						),
						'content'=>array(
							'type'=>'editor',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
							'std'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						),
						'date'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TIMELINE_DATE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TIMELINE_DATE_DESC'),
							'std'=>'08 Feb 2013',
						),
					) //attr
				), //Repeatable Items

                'bar_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_BAR_COLOR'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_BAR_COLOR_DESC'),
                    'std'=> '#cccccc'
                ),

                'point_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_POINT_COLOR'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_POINT_COLOR_DESC'),
                    'std'=> '#ffffff'
                ),

                'timeline_badge_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('Badge Color'),
                ),

                'enable_arrow' => array(
                    'type' => 'checkbox',
                    'title' => JText::_('Enable Arrow Navigation.'),
                    'std' => 1
                ),

                'arrow_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_ARROW_COLOR'),
                    'std'=> '#cccccc',
                    'depends' => array(array('enable_arrow', '=', '1'))
                ),

                'arrow_color_hover'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_ARROW_COLOR_HOVER'),
                    'std'=> '#dddddd',
                    'depends' => array(array('enable_arrow', '=', '1'))
                ),

                'enable_bullets' => array(
                    'type' => 'checkbox',
                    'title' => JText::_('Enable Bullets Navigation.'),
                    'std' => 1
                ),

                'bullet_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_BULLET_COLOR'),
                    'std'=> '#cccccc',
                    'depends' => array(array('enable_bullets', '=', '1'))
                ),
                'bullet_border_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_BULLET_BORDER_COLOR'),
                    'std'=> '#cccccc',
                    'depends' => array(array('enable_bullets', '=', '1'))
                ),

                'bullet_color_hover'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_BULLET_COLOR_HOVER'),
                    'std'=> '#aaaaaa',
                    'depends' => array(array('enable_bullets', '=', '1'))
                ),
                'bullet_border_color_hover'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TIMELINE_BULLET_BORDER_COLOR_HOVER'),
                    'std'=> '#aaaaaa',
                    'depends' => array(array('enable_bullets', '=', '1'))
                ),

                //Title
                'title_separator'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_OPTIONS'),
                ),

                'heading_selector'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
                    'values'=>array(
                        'h1'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
                        'h2'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
                        'h3'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
                        'h4'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
                        'h5'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
                        'h6'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
                    ),
                    'std'=>'h3',
                ),

                'title_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                ),
                'title_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.sppb-addon-horizontal-timeline .timeline-item .title { font-family: "{{ VALUE }}"; }'
                    )
                ),
                'title_font_size'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                    'max'=>100,
                    'responsive'=> true,
                    'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
                ),
                'title_line_height'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                    'max'=>100,
                    'responsive'=> true,
                    'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
                ),
                'title_letterspace'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                    'values'=>array(
                        '-10px'=> '-10px',
                        '-9px'=>  '-9px',
                        '-8px'=>  '-8px',
                        '-7px'=>  '-7px',
                        '-6px'=>  '-6px',
                        '-5px'=>  '-5px',
                        '-4px'=>  '-4px',
                        '-3px'=>  '-3px',
                        '-2px'=>  '-2px',
                        '-1px'=>  '-1px',
                        '0px'=> 'Default',
                        '1px'=> '1px',
                        '2px'=> '2px',
                        '3px'=> '3px',
                        '4px'=> '4px',
                        '5px'=> '5px',
                        '6px'=>	'6px',
                        '7px'=>	'7px',
                        '8px'=>	'8px',
                        '9px'=>	'9px',
                        '10px'=> '10px'
                    ),
                    'std'=>'0px'
                ),
                'title_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                ),

                'title_margin_top'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
                    'placeholder'=>'10',
                    'max'=>400,
                    'responsive' => true
                ),

                'title_margin_bottom'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
                    'placeholder'=>'10',
                    'max'=>400,
                    'responsive' => true
                ),

                //Content
                'content_separator'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_OPTIONS'),
                ),
                'content_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CONTENT_COLOR'),
                ),
                'content_fontsize'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CONTENT_FONTSIZE'),
                    'max'=> 200,
                    'responsive'=> true,
                    'std'=> array('md'=>16, 'sm'=>16, 'xs'=>16),
                ),
                'content_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.sppb-addon-horizontal-timeline .timeline-item .details { font-family: "{{ VALUE }}"; }'
                    )
                ),
                'content_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CONTENT_FONTSTYLE'),
                ),
                'content_lineheight'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CONTENT_LINEHEIGHT'),
                    'max'=> 200,
                    'responsive'=> true,
                    'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
                ),
                'content_padding'=>array(
                    'type'=>'padding',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_PADDING'),
                    'responsive'=> true,
                ),
                'content_margin'=>array(
                    'type'=>'margin',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_MARGIN'),
                    'responsive'=> true
                ),

                //Date
                'date_separator'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_OPTIONS'),
                ),

                'date_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_TEXT_COLOR'),
                ),
                'date_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_FONT_FAMILY'),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.sppb-addon-horizontal-timeline .timeline-item .timeline-date { font-family: "{{ VALUE }}"; }'
                    )
                ),
                'date_font_size'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_FONT_SIZE'),
                    'max'=>100,
                    'responsive'=> true,
                    'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
                ),
                'date_line_height'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_LINE_HEIGHT'),
                    'max'=>100,
                    'responsive'=> true,
                    'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
                ),
                'date_letterspace'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                    'values'=>array(
                        '-10px'=> '-10px',
                        '-9px'=>  '-9px',
                        '-8px'=>  '-8px',
                        '-7px'=>  '-7px',
                        '-6px'=>  '-6px',
                        '-5px'=>  '-5px',
                        '-4px'=>  '-4px',
                        '-3px'=>  '-3px',
                        '-2px'=>  '-2px',
                        '-1px'=>  '-1px',
                        '0px'=> 'Default',
                        '1px'=> '1px',
                        '2px'=> '2px',
                        '3px'=> '3px',
                        '4px'=> '4px',
                        '5px'=> '5px',
                        '6px'=>	'6px',
                        '7px'=>	'7px',
                        '8px'=>	'8px',
                        '9px'=>	'9px',
                        '10px'=> '10px'
                    ),
                    'std'=>'0px'
                ),
                'date_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_FONT_STYLE'),
                ),

                'date_margin_top'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_MARGIN_TOP'),
                    'placeholder'=>'10',
                    'max'=>400,
                    'responsive' => true
                ),

                'date_margin_bottom'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATE_MARGIN_BOTTOM'),
                    'placeholder'=>'10',
                    'max'=>400,
                    'responsive' => true
                ),

                'class'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                    'std'=> ''
                ),
			),
		)
	)
);
					