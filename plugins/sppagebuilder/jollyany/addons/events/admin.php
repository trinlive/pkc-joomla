<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('Restricted access');
SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_events',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_EVENT'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_EVENT_DESC'),
		'icon'=>JURI::root() . 'plugins/sppagebuilder/jollyany/addons/feature_section/assets/images/icon.png',
		'category'=>'Jollyany',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				
				'title'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std'=>  ''
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
					'depends'=>array(array('title', '!=', '')),
				),
				
				'title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'depends'=>array(array('title', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-title { font-family: "{{ VALUE }}"; }'
					),
				),
					
				'title_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
					'std'=>'',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),
				
				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),
				
				'title_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
					'depends'=>array(array('title', '!=', '')),
				),
				
				'title_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'values'=>array(
						'0'=> 'Default',
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
					'std'=>'0',
					'depends'=>array(array('title', '!=', '')),
				),
				
				'title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
					'depends'=>array(array('title', '!=', '')),
				),
				
				'title_margin_top'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
					'placeholder'=>'10',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),
				
				'title_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
					'placeholder'=>'10',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),

                'separator1'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_OPTIONS'),
                ),

                'finish_text'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_FINISHED_TEXT'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_FINISHED_TEXT_DESC'),
                    'placeholder'=>'Finally we are here',
                    'std'=> 'Finally we are here',
                ),

                'counter_height'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_HEIGHT'),
                    'placeholder'=>'',
                    'max'=>500,
                    'responsive'=>true,
                    'std'=> array('md'=>80)
                ),

                'counter_width'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_WIDTH'),
                    'placeholder'=>'',
                    'max'=>500,
                    'responsive'=>true,
                    'std'=> array('md'=>80)
                ),

                'counter_font_size'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_FONT_SIZE'),
                    'std'=> array('md'=>36),
                    'max'=>500,
                    'responsive'=>true
                ),

                'counter_text_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_TEXT_COLOR'),
                    'std'=>'#FFFFFF',
                ),

                'counter_text_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_TEXT_FONT_FAMILY'),
                    'selector'=>array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.sppb-countdown-number { font-family: "{{ VALUE }}"; }',
                    ),
                ),

                'counter_text_font_weight'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_TEXT_FONT_WEIGHT'),
                    'values'=>array(
                        100=>100,
                        200=>200,
                        300=>300,
                        400=>400,
                        500=>500,
                        600=>600,
                        700=>700,
                        800=>800,
                        900=>900,
                    ),
                ),

                'counter_background_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_BACKGROUND_COLOR'),
                    'std'=>'#0089e6',
                ),

                'counter_user_border'=>array(
                    'type'=>'checkbox',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_USE_BORDER'),
                    'std'=>0
                ),

                'counter_border_width'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
                    'std'=>array('md'=>1),
                    'depends'=>array('counter_user_border'=>1),
                    'max'=>500,
                    'responsive'=>true
                ),

                'counter_border_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
                    'std'=>'#E5E5E5',
                    'depends'=>array('counter_user_border'=>1)
                ),

                'counter_border_style'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
                    'values'=>array(
                        'none'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_NONE'),
                        'solid'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
                        'double'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOUBLE'),
                        'dotted'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
                        'dashed'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
                    ),
                    'std'=>'solid',
                    'depends'=>array('counter_user_border'=>1)
                ),

                'counter_border_radius'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
                    'std'=>array('md'=>4),
                    'max'=>500,
                    'responsive'=>true
                ),

                'label_font_size'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_FONT_SIZE'),
                    'std'=>array('md'=>14),
                    'max'=>500,
                    'responsive'=>true
                ),

                'label_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_COLOR'),
                    'std'=>'',
                ),

                'label_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_FONTFAMILY'),
                    'selector'=>array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.sppb-countdown-text { font-family: "{{ VALUE }}"; }',
                    ),
                ),

                'label_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_FONTSTYLE'),
                ),

                'label_margin'=>array(
                    'type'=>'margin',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_MARGIN'),
                    'responsive'=>true
                ),

                'separator2'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_EVENT_OPTIONS'),
                ),

                'title_event_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.event-title { font-family: "{{ VALUE }}"; }'
                    ),
                ),

                'title_event_fontsize'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
                    'std'=>'',
                    'responsive' => true,
                    'max'=> 400,
                ),

                'title_event_lineheight'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                    'std'=>'',
                    'responsive' => true,
                    'max'=> 400,
                ),

                'title_event_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                ),

                'title_event_letterspace'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                    'values'=>array(
                        '0'=> 'Default',
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
                    'std'=>'0',
                ),

                'title_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                    'std'=>'',
                ),

                // Meta style
                'separator3'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_META_OPTIONS'),
                ),

                'meta_event_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.metainfo { font-family: "{{ VALUE }}"; }'
                    ),
                ),

                'meta_event_fontsize'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_META_FONT_SIZE'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_META_FONT_SIZE_DESC'),
                    'std'=>'',
                    'responsive' => true,
                    'max'=> 400,
                ),

                'meta_event_lineheight'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_META_LINE_HEIGHT'),
                    'std'=>'',
                    'responsive' => true,
                    'max'=> 400,
                ),

                'meta_event_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_META_FONT_STYLE'),
                ),

                'location_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LOCATION_TEXT_COLOR'),
                    'std'=>'',
                ),

                'datetime_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DATETIME_TEXT_COLOR'),
                    'std'=>'',
                ),

                // Content style
                'separator4'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_OPTIONS'),
                ),

                'content_event_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.event-description { font-family: "{{ VALUE }}"; }'
                    ),
                ),

                'content_event_fontsize'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_SIZE'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_SIZE_DESC'),
                    'std'=>'',
                    'responsive' => true,
                    'max'=> 400,
                ),

                'content_event_lineheight'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_LINE_HEIGHT'),
                    'std'=>'',
                    'responsive' => true,
                    'max'=> 400,
                ),

                'content_event_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_STYLE'),
                ),

                'description_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_DESC_TEXT_COLOR'),
                    'std'=>'',
                ),

                'border_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BORDER_COLOR'),
                    'std'=>'',
                ),

                // Button style
                'separator5'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_OPTIONS'),
                ),
                'button_font_family' => array(
                    'type' => 'fonts',
                    'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
                    'selector' => array(
                        'type' => 'font',
                        'font' => '{{ VALUE }}',
                        'css' => '.sppb-btn { font-family: "{{ VALUE }}"; }'
                    )
                ),
                'button_font_style' => array(
                    'type' => 'fontstyle',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
                ),
                'button_letterspace' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
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
                    'std' => '0'
                ),
                'button_type' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
                    'values' => array(
                        'default' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
                        'primary' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
                        'secondary' => JText::_('COM_SPPAGEBUILDER_GLOBAL_SECONDARY'),
                        'success' => JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
                        'info' => JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
                        'warning' => JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
                        'danger' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
                        'dark' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DARK'),
                        'link' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                        'custom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
                    ),
                    'std' => 'default',
                ),
                'button_appearance' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_DESC'),
                    'values' => array(
                        '' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_FLAT'),
                        'gradient' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_GRADIENT'),
                        'outline' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_OUTLINE'),
                        '3d' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_3D'),
                    ),
                    'std' => '',
                    'depends' => array(
                        array('button_type', '!=', 'link'),
                    )
                ),
                'button_fontsize' => array(
                    'type' => 'slider',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
                    'std' => array('md' => 16),
                    'responsive' => true,
                    'max' => 400,
                    'depends' => array(
                        array('button_type', '=', 'custom'),
                    )
                ),
                'button_status' => array(
                    'type' => 'buttons',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
                    'std' => 'normal',
                    'values' => array(
                        array(
                            'label' => 'Normal',
                            'value' => 'normal'
                        ),
                        array(
                            'label' => 'Hover',
                            'value' => 'hover'
                        ),
                    ),
                    'tabs' => true,
                    'depends' => array(
                        array('button_type', '=', 'custom'),
                    )
                ),
                'button_background_color' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
                    'std' => '#03E16D',
                    'depends' => array(
                        array('appearance', '!=', 'gradient'),
                        array('button_type', '=', 'custom'),
                        array('button_status', '=', 'normal'),
                    )
                ),
                'button_background_gradient' => array(
                    'type' => 'gradient',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
                    'std' => array(
                        "color" => "#B4EC51",
                        "color2" => "#429321",
                        "deg" => "45",
                        "type" => "linear"
                    ),
                    'depends' => array(
                        array('appearance', '=', 'gradient'),
                        array('button_type', '=', 'custom'),
                        array('button_status', '=', 'normal'),
                    )
                ),
                'button_color' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
                    'std' => '#FFFFFF',
                    'depends' => array(
                        array('button_type', '=', 'custom'),
                        array('button_status', '=', 'normal'),
                    ),
                ),
                'button_background_color_hover' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
                    'std' => '#00E66E',
                    'depends' => array(
                        array('appearance', '!=', 'gradient'),
                        array('button_type', '=', 'custom'),
                        array('button_status', '=', 'hover'),
                    )
                ),
                'button_background_gradient_hover' => array(
                    'type' => 'gradient',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
                    'std' => array(
                        "color" => "#429321",
                        "color2" => "#B4EC51",
                        "deg" => "45",
                        "type" => "linear"
                    ),
                    'depends' => array(
                        array('appearance', '=', 'gradient'),
                        array('button_type', '=', 'custom'),
                        array('button_status', '=', 'hover'),
                    )
                ),
                'button_color_hover' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
                    'std' => '#FFFFFF',
                    'depends' => array(
                        array('button_type', '=', 'custom'),
                        array('button_status', '=', 'hover'),
                    ),
                ),
                //Link Button Style
                'link_button_status' => array(
                    'type' => 'buttons',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
                    'std' => 'normal',
                    'values' => array(
                        array(
                            'label' => 'Normal',
                            'value' => 'normal'
                        ),
                        array(
                            'label' => 'Hover',
                            'value' => 'hover'
                        ),
                    ),
                    'tabs' => true,
                    'depends' => array(
                        array('type', '=', 'link'),
                    )
                ),
                'link_button_color' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
                    'std' => '',
                    'depends' => array(
                        array('type', '=', 'link'),
                        array('link_button_status', '=', 'normal'),
                    )
                ),
                'link_button_border_width' => array(
                    'type' => 'slider',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
                    'max'=> 30,
                    'std' => '',
                    'depends' => array(
                        array('type', '=', 'link'),
                        array('link_button_status', '=', 'normal'),
                    )
                ),
                'link_border_color' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
                    'std' => '',
                    'depends' => array(
                        array('type', '=', 'link'),
                        array('link_button_status', '=', 'normal'),
                    )
                ),
                'link_button_padding_bottom' => array(
                    'type' => 'slider',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_PADDING_BOTTOM'),
                    'max'=>100,
                    'std' => '',
                    'depends' => array(
                        array('type', '=', 'link'),
                        array('link_button_status', '=', 'normal'),
                    )
                ),
                //Link Hover
                'link_button_hover_color' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
                    'std' => '',
                    'depends' => array(
                        array('type', '=', 'link'),
                        array('link_button_status', '=', 'hover'),
                    )
                ),
                'link_button_border_hover_color' => array(
                    'type' => 'color',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
                    'std' => '',
                    'depends' => array(
                        array('type', '=', 'link'),
                        array('link_button_status', '=', 'hover'),
                    )
                ),
                'button_padding' => array(
                    'type' => 'padding',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
                    'std' => '',
                    'depends' => array(
                        array('button_type', '=', 'custom'),
                    ),
                    'responsive' => true
                ),
                'button_size' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DESC'),
                    'values' => array(
                        '' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DEFAULT'),
                        'lg' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_LARGE'),
                        'xlg' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_XLARGE'),
                        'sm' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_SMALL'),
                        'xs' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_EXTRA_SAMLL'),
                    ),
                ),
                'button_shape' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
                    'values' => array(
                        'rounded' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
                        'square' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
                        'round' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
                    ),
                    'depends' => array(
                        array('type', '!=', 'link'),
                    )
                ),
                'button_block' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK_DESC'),
                    'values' => array(
                        '' => JText::_('JNO'),
                        'sppb-btn-block' => JText::_('JYES'),
                    ),
                    'depends' => array(
                        array('type', '!=', 'link'),
                    )
                ),
                'button_icon' => array(
                    'type' => 'icon',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
                    'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
                ),
                'button_icon_margin' => array(
                    'type' =>'margin',
                    'title' =>JText::_('COM_SPPAGEBUILDER_TAB_ICON_MARGIN'),
                    'responsive'=>true,
                    'std'=>'0px 0px 0px 0px',
                ),
                'button_icon_position' => array(
                    'type' => 'select',
                    'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
                    'values' => array(
                        'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                        'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                    ),
                    'std' => 'left',
                ),

                // Item style
                'separator6'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_OPTIONS'),
                ),
				
				// Repeatable Items
				'tz_event_items'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_REOEATABLE_ITEMS'),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_TITLE_DESC'),
							'std'=>'Event Title',
						),
                        'location'=>array(
                            'type'=>'text',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_LOCATION'),
                            'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ITEM_LOCATION_DESC'),
                            'std'=>'Event Location',
                        ),
						'content'=>array(
							'type'=>'editor',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
							'std'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						),
                        'date'=>array(
                            'type'=>'text',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_DATE'),
                            'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_DATE_DESC'),
                            'placeholder'=>'2025/9/18',
                            'std'=> '2025/9/18'
                        ),

                        'time'=>array(
                            'type'=>'text',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_TIME'),
                            'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_TIME_DESC'),
                            'placeholder'=>'20:23',
                            'std'=> '20:23',
                        ),
                        'button_text' => array(
                            'type' => 'text',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
                            'std' => 'Button',
                        ),
                        'button_url'=>array(
                            'type'=>'media',
                            'format'=>'attachment',
                            'hide_preview'=>true,
                            'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
                            'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
                            'placeholder' => 'http://',
                        ),
                        'target' => array(
                            'type' => 'select',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
                            'values' => array(
                                '' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                                '_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                            ),
                            'depends' => array(array('button_url', '!=', '')),
                        ),
					) //attr
				), //Repeatable Items

                'class'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                    'std'=> ''
                )
			),
		)
	)
);
					