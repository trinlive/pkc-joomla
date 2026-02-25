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
		'type'=>'repeatable',
		'addon_name'=>'sp_tinyslider',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_DESC'),
        'icon'=>JURI::root() . 'plugins/sppagebuilder/jollyany/addons/tinyslider/assets/images/icon.png',
        'category' => 'Jollyany',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'interval'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_INTERVAL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_INTERVAL_DESC'),
					'std'=> 5
				),

                'overlay'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OVERLAY'),
                    'std'=>''
                ),

                'message_background'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_MESSAGE_BACKGROUND'),
                    'std'=>'#f7f7f7'
                ),

                'height'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_HEIGHT'),
                    'max'=>2000,
                    'responsive'=> true,
                    'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
                ),

                'controls'=>array(
                    'type'=>'checkbox',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS_DESC'),
                    'values'=>array(
                        1=>JText::_('JYES'),
                        0=>JText::_('JNO'),
                    ),
                    'std'=>1,
                ),

                'bullet_border_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BULLET_BACKGROUND_COLOR'),
                    'std'=>'',
                    'depends'=> array(
                        array('controls', '!=', 0),
                    )
                ),
                'bullet_active_bg_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_BULLET_BG_COLOR'),
                    'std'=>'',
                    'depends'=> array(
                        array('controls', '!=', 0),
                    )
                ),

                'bullet_position'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_BULLET_POSITION'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_BULLET_POSITION_DESC'),
                    'values'=>array(
                        'top-left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_TOP_LEFT'),
                        'top-center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_TOP_CENTER'),
                        'top-right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_TOP_RIGHT'),
                        'bottom-left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_BOTTOM_LEFT'),
                        'bottom-center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_BOTTOM_CENTER'),
                        'bottom-right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_BOTTOM_RIGHT'),
                    ),
                    'std'=>'bottom-center'
                ),

                'arrow_controls'=>array(
                    'type'=>'checkbox',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_SHOW_ARROWS'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_SHOW_ARROWS_DESC'),
                    'std'=>0,
                ),

                'arrow_background'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ARROW_BACKGROUND_COLOR'),
                    'std'=>'',
                    'depends'=> array(
                        array('arrow_controls', '=', 1)
                    )
                ),

                'arrow_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ARROW_COLOR'),
                    'std'=>'',
                    'depends'=> array(
                        array('arrow_controls', '=', 1),
                    )
                ),

                'arrow_hover_background'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ARROW_HOVER_BACKGROUND_COLOR'),
                    'std'=>'',
                    'depends'=> array(
                        array('arrow_controls', '=', 1)
                    )
                ),

                'arrow_hover_color'=>array(
                    'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ARROW_HOVER_COLOR'),
                    'std'=>'',
                    'depends'=> array(
                        array('arrow_controls', '=', 1),
                    )
                ),

				// Repeatable Items
				'sp_tinyslider_item'=>array(
					'title'=>JText::_('Testimonials'),
					'attr'=>array(
                        'image'=>array(
                            'type'=>'media',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TINYSLIDER_IMAGE'),
                            'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TINYSLIDER_IMAGE_DESC'),
                        ),

						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
							'std'=>'John Doe',
						),

						'message'=>array(
							'type'=>'editor',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ITEM_TEXT_DESC'),
							'std'=> 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
						),

                        'content_position'=>array(
                            'type'=>'select',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION'),
                            'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_DESC'),
                            'values'=>array(
                                'top-left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_TOP_LEFT'),
                                'top-center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_TOP_CENTER'),
                                'top-right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_TOP_RIGHT'),
                                'middle-left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_MIDDLE_LEFT'),
                                'middle-center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_MIDDLE_CENTER'),
                                'middle-right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_MIDDLE_RIGHT'),
                                'bottom-left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_BOTTOM_LEFT'),
                                'bottom-center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_BOTTOM_CENTER'),
                                'bottom-right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JOLLYANY_TINYSLIDER_CONTENT_POSITION_BOTTOM_RIGHT'),
                            ),
                            'std'=>'middle-center'
                        ),

                        'btn_text' => array(
                            'type' => 'text',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
                        ),

                        'btn_font_family' => array(
                            'type' => 'fonts',
                            'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
                            'selector' => array(
                                'type' => 'font',
                                'font' => '{{ VALUE }}',
                                'css' => '.sppb-btn { font-family: "{{ VALUE }}"; }'
                            ),
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_font_style' => array(
                            'type' => 'fontstyle',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),

                        'btn_letterspace' => array(
                            'type' => 'select',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
                            'values' => array(
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
                            'std' => '0px',
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_url' => array(
                            'type' => 'media',
                            'format' => 'attachment',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
                            'placeholder' => 'http://',
                            'hide_preview' => true,
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_target' => array(
                            'type' => 'select',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
                            'values' => array(
                                '' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                                '_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                            ),
                            'depends' => array(array('btn_url', '!=', '')),
                        ),
                        'btn_type' => array(
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
                            'std' => 'custom',
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_appearance' => array(
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
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_fontsize' => array(
                            'type' => 'slider',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
                            'std' => array('md' => 16),
                            'responsive' => true,
                            'max' => 400,
                            'depends' => array(
                                array('btn_type', '=', 'custom'),
                                array('btn_text', '!=', ''),
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
                                array('btn_type', '=', 'custom'),
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_background_color' => array(
                            'type' => 'color',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
                            'std' => '#0080FE',
                            'depends' => array(
                                array('btn_appearance', '!=', 'gradient'),
                                array('btn_type', '=', 'custom'),
                                array('button_status', '=', 'normal'),
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_background_gradient' => array(
                            'type' => 'gradient',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
                            'std' => array(
                                "color" => "#B4EC51",
                                "color2" => "#429321",
                                "deg" => "45",
                                "type" => "linear"
                            ),
                            'depends' => array(
                                array('btn_appearance', '=', 'gradient'),
                                array('btn_type', '=', 'custom'),
                                array('button_status', '=', 'normal'),
                            )
                        ),
                        'btn_color' => array(
                            'type' => 'color',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
                            'std' => '#FFFFFF',
                            'depends' => array(
                                array('btn_type', '=', 'custom'),
                                array('button_status', '=', 'normal'),
                                array('btn_text', '!=', ''),
                            ),
                        ),
                        'btn_background_color_hover' => array(
                            'type' => 'color',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
                            'std' => '#de6906',
                            'depends' => array(
                                array('btn_appearance', '!=', 'gradient'),
                                array('btn_type', '=', 'custom'),
                                array('button_status', '=', 'hover'),
                            )
                        ),
                        'btn_background_gradient_hover' => array(
                            'type' => 'gradient',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
                            'std' => array(
                                "color" => "#429321",
                                "color2" => "#B4EC51",
                                "deg" => "45",
                                "type" => "linear"
                            ),
                            'depends' => array(
                                array('btn_appearance', '=', 'gradient'),
                                array('btn_type', '=', 'custom'),
                                array('button_status', '=', 'hover'),
                            )
                        ),
                        'btn_color_hover' => array(
                            'type' => 'color',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
                            'std' => '#FFFFFF',
                            'depends' => array(
                                array('btn_type', '=', 'custom'),
                                array('button_status', '=', 'hover'),
                            ),
                        ),
                        'button_margin'=>array(
                            'type'=>'margin',
                            'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
                            'placeholder'=>'10px 10px 10px 10px',
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            ),
                            'responsive' => true,
                            'std' => '25px 0px 0px 0px',
                        ),
                        'button_padding' => array(
                            'type' => 'padding',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
                            'std'=>'',
                            'depends' => array(
                                array('btn_type', '=', 'custom'),
                                array('btn_text', '!=', ''),
                            ),
                            'responsive' => true,
                            'std' => '8px 22px 10px 22px',
                        ),
                        'btn_size' => array(
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
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            ),
                            'std'=>''
                        ),
                        'btn_shape' => array(
                            'type' => 'select',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
                            'values' => array(
                                'rounded' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
                                'square' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
                                'round' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
                            ),
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            ),
                            'std'=>'square'
                        ),
                        'btn_icon' => array(
                            'type' => 'icon',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
                            'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
                        'btn_icon_position' => array(
                            'type' => 'select',
                            'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
                            'values' => array(
                                'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                                'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                            ),
                            'std' => 'left',
                            'depends'=>array(
                                array('btn_text', '!=', ''),
                            )
                        ),
					),
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
                        'css'=>'.sppb-addon-testimonial-pro-client-name { font-family: "{{ VALUE }}"; }'
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
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_FONTSTYLE'),
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
						'css'=>'.sppb-testimonial-message { font-family: "{{ VALUE }}"; }'
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
					'std'=> array('md'=>'30px 30px 30px 30px', 'sm'=>'30px 30px 30px 30px', 'xs'=>'20px 20px 20px 20px'),
				),
                'content_margin'=>array(
                    'type'=>'margin',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_MARGIN'),
                    'responsive'=> true
                ),
				'content_alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=> 'center'
				),
				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=> ''
				),
			),
		),
	)
);