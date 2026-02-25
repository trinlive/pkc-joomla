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
		'addon_name'=>'piechart',
		'title'=>JText::_('Pie Chart'),
		'desc'=>JText::_('Display Pie Chart with CSS'),
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
				'sp_pie_items'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_REOEATABLE_ITEMS'),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TITLE_DESC'),
							'std'=>'Pie Title',
						),
                        'color'=>array(
                            'type'=>'color',
                            'title'=>JText::_('Color'),
                            'std'=> '#cccccc'
                        ),
                        'value'=>array(
                            'type'=>'text',
                            'title'=>JText::_('Value'),
                            'desc'=>JText::_('Value should be number'),
                            'std'=>'',
                        ),
					) //attr
				), //Repeatable Items

                'unit'=>array(
                    'type'=>'text',
                    'title'=>JText::_('Unit'),
                    'desc'=>JText::_('Unit display in chart'),
                    'std'=>'',
                ),

                //Title
                'title_separator'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_OPTIONS'),
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
					